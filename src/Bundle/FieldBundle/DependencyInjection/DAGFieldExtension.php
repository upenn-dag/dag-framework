<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\FieldBundle\DependencyInjection;

use DAG\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use DAG\Bundle\ResourceBundle\DAGResourceBundle;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * DAG field bundle extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DAGFieldExtension extends AbstractResourceExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configure($config, new Configuration(), $container, self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS | self::CONFIGURE_VALIDATORS);
    }

    /**
     * {@inheritdoc}
     */
    public function process(array $config, ContainerBuilder $container)
    {
        $convertedConfig = array();
        $subjects = array();
        $validationGroups = array();

        foreach ($config['classes'] as $subject => $parameters) {
            list($prefix, $subject) = $this->mapResourceName($subject);
            $subjects[$subject] = $parameters;
            unset($parameters['subject']);

            foreach ($parameters as $resource => $classes) {
                $convertedConfig[$prefix.':'.$subject.'_'.$resource] = $classes;
            }

            $this->createSubjectServices($container, $config['driver'], $subject, $prefix, $convertedConfig);

            // TODO: Remove
            if (!isset($config['validation_groups'][$prefix.':'.$subject]['prefix'])) {
                $config['validation_groups'][$prefix.':'.$subject]['prefix'] = $prefix;
            }

            if (!isset($config['validation_groups'][$prefix.':'.$subject]['field'])) {
                $config['validation_groups'][$prefix.':'.$subject]['field'] = array_unique(array($prefix, 'dag'));
            }
            if (!isset($config['validation_groups'][$prefix.':'.$subject]['field_value'])) {
                $config['validation_groups'][$prefix.':'.$subject]['field_value'] = array_unique(array($prefix, 'dag'));
            }
        }

        $container->setParameter('dag.field.subjects', $subjects);
        $config['classes'] = $convertedConfig;
        $convertedConfig = array();

        foreach ($config['validation_groups'] as $subject => $parameters) {
            list($groupPrefix, $subject) = $this->mapResourceName($subject);
            foreach ($parameters as $resource => $validationGroups) {
                $convertedConfig[$groupPrefix.':'.$subject.'_'.$resource] = $validationGroups;
            }
        }

        $config['validation_groups'] = $convertedConfig;

        return $config;
    }

    /**
     * Create services for every subject.
     *
     * @param ContainerBuilder $container
     * @param string           $driver
     * @param string           $subject
     * @param array            $config
     */
    private function createSubjectServices(ContainerBuilder $container, $driver, $subject, $prefix, array $config)
    {
        $fieldAlias = $subject.'_field';
        $fieldValueAlias = $subject.'_field_value';

        $fieldClasses = $config[$prefix.':'.$fieldAlias];
        $fieldValueClasses = $config[$prefix.':'.$fieldValueAlias];

        // Field repository.
        $repositoryClasses = array(
            DAGResourceBundle::DRIVER_DOCTRINE_ORM => 'DAG\Bundle\FieldBundle\Doctrine\ORM\FieldRepository',
        );
        $repositoryClass = sprintf('%s.repository.%s.class', $prefix, $fieldAlias);
        if (!$container->hasParameter($repositoryClass)) {
            $container->setParameter($repositoryClass, $repositoryClasses[$driver]);
        }

        // Field form.
        $fieldFormType = new Definition($fieldClasses['form']);
        $fieldFormType
            ->setArguments(array($subject, $prefix, $fieldClasses['model'], '%'.$prefix.'.validation_group.'.$fieldAlias.'%'))
            ->addTag('form.type', array('alias' => $prefix.'_'.$fieldAlias))
        ;

        $container->setDefinition($prefix.'.form.type.'.$fieldAlias, $fieldFormType);

        // Field form choice.
        $choiceTypeClasses = array(
            DAGResourceBundle::DRIVER_DOCTRINE_ORM => 'DAG\Bundle\FieldBundle\Form\Type\FieldEntityChoiceType'
        );

        $fieldChoiceFormType = new Definition($choiceTypeClasses[$driver]);
        $fieldChoiceFormType
            ->setArguments(array($subject, $prefix, $fieldClasses['model']))
            ->addTag('form.type', array('alias' => $prefix.'_'.$fieldAlias.'_choice'))
        ;

        $container->setDefinition($prefix.'.form.type.'.$fieldAlias.'_choice', $fieldChoiceFormType);

        // Field value form.
        $fieldValueFormType = new Definition($fieldValueClasses['form']);
        $fieldValueFormType
            ->setArguments(array($subject, $prefix, $fieldValueClasses['model'], '%'.$prefix.'.validation_group.'.$fieldValueAlias.'%'))
            ->addTag('form.type', array('alias' => $prefix.'_'.$fieldValueAlias))
        ;

        $container->setDefinition($prefix.'.form.type.'.$fieldValueAlias, $fieldValueFormType);

        // Field provider.
        $fieldProvider = new Definition('DAG\Component\Field\Provider\FieldProvider');
        $fieldProvider->addArgument(new Reference($prefix.'.repository.'.$fieldAlias));

        $container->setDefinition($prefix.'.provider.'.$fieldAlias, $fieldProvider);
    }
}
