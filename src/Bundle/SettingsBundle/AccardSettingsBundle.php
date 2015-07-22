<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\SettingsBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use DAG\Bundle\SettingsBundle\DependencyInjection\Compiler\RegisterSchemasPass;
use DAG\Bundle\SettingsBundle\DependencyInjection\Compiler\RegisterSchemaExtensionsPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use DAG\Bundle\ResourceBundle\AccardResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Accard settings bundle definition.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AccardSettingsBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'DAG\Bundle\SettingsBundle\Model\ParameterInterface' => 'accard.model.parameter.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('accard_settings', $interfaces));
        $container->addCompilerPass(new RegisterSchemasPass());
        $container->addCompilerPass(new RegisterSchemaExtensionsPass());

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DAG\Bundle\SettingsBundle\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'accard_settings.driver.doctrine/orm'
            )
        );
    }
}
