<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\PrototypeBundle\DependencyInjection;

use DAG\Bundle\ResourceBundle\DependencyInjection\AbstractResourceExtension;
use DAG\Bundle\ResourceBundle\DAGResourceBundle;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * DAG prototype bundle extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DAGPrototypeExtension extends AbstractResourceExtension
{
    /**
     * {@inheritDoc}
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

        foreach ($config['classes'] as $subject => $parameters) {
            list($prefix, $subject) = $this->mapResourceName($subject);
            $subjects[$subject] = $parameters;
            unset($parameters['subject']);

            foreach ($parameters as $resource => $classes) {
                $convertedConfig[$prefix.':'.$subject.'_'.$resource] = $classes;
            }

            $this->createSubjectServices($container, $config['driver'], $subject, $prefix, $convertedConfig);

            // TODO: Remove
            if (!isset($config['validation_groups'][$subject]['prefix'])) {
                $config['validation_groups'][$subject]['prefix'] = $prefix;
            }
            if (!isset($config['validation_groups'][$subject]['prototype'])) {
                $config['validation_groups'][$subject]['prototype'] = array_unique(array($prefix, 'dag'));
            }
        }

        $container->setParameter('dag.prototype.subjects', $subjects);

        $config['classes'] = $convertedConfig;
        $convertedConfig = array();

        foreach ($config['validation_groups'] as $subject => $parameters) {
            $groupPrefix = $parameters['prefix'];
            unset($parameters['prefix']);
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
        $prototypeAlias = $subject.'_prototype';
        $prototypeClasses = $config[$prefix.':'.$prototypeAlias];

        // Form type.
        $prototypeFormType = new Definition($prototypeClasses['form']);
        $prototypeFormType
            ->setArguments(array($subject, $prefix, $prototypeClasses['model'], '%'.$prefix.'.validation_group.'.$prototypeAlias.'%'))
            ->addTag('form.type', array('alias' => $prefix.'_'.$prototypeAlias))
        ;

        $container->setDefinition($prefix.'.form.type.'.$prototypeAlias, $prototypeFormType);

        // Choice form type.
        $choiceFormType = new Definition('DAG\Bundle\PrototypeBundle\Form\Type\PrototypeChoiceType');
        $choiceFormType
            ->setArguments(array($subject, $prefix, new Reference($prefix.'.provider.'.$prototypeAlias)))
            ->addTag('form.type', array('alias' => $prefix.'_'.$prototypeAlias.'_choice'))
        ;

        $container->setDefinition($prefix.'.form.type.'.$prototypeAlias.'_choice', $choiceFormType);

        // Provider.
        $prototypeProvider = new Definition('DAG\Component\Prototype\Provider\PrototypeProvider');
        $prototypeProvider->addArgument(new Reference($prefix.'.repository.'.$prototypeAlias));

        $container->setDefinition($prefix.'.provider.'.$prototypeAlias, $prototypeProvider);
    }
}
