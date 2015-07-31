<?php

/**
 * This file is part of The DAG Framework package.
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
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * DAG settings bundle definition.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DAGSettingsBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'DAG\Bundle\SettingsBundle\Model\ParameterInterface' => 'dag.model.parameter.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('dag_settings', $interfaces));
        $container->addCompilerPass(new RegisterSchemasPass());
        $container->addCompilerPass(new RegisterSchemaExtensionsPass());

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DAG\Bundle\SettingsBundle\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'dag_settings.driver.doctrine/orm'
            )
        );
    }
}
