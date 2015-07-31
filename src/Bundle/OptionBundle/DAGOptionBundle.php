<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\OptionBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * DAG option bundle.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DAGOptionBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'DAG\Component\Option\Model\OptionInterface' => 'dag.model.option.class',
            'DAG\Component\Option\Model\OptionValueInterface' => 'dag.model.option_value.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('dag_option', $interfaces));

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DAG\Component\Option\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'dag_option.driver.doctrine/orm'
            )
        );
    }
}
