<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\ResourceBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\ObjectToIdentifierServicePass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterImporterPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterImporterManagerPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\RegisterExpressionLanguagePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * DAG resource bundle.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DAGResourceBundle extends Bundle
{
    // Bundle driver list.
    const DRIVER_DOCTRINE_ORM         = 'doctrine/orm';
    const DRIVER_DOCTRINE_MONGODB_ODM = 'doctrine/mongodb-odm';
    const DRIVER_DOCTRINE_PHPCR_ODM   = 'doctrine/phpcr-odm';

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'DAG\Component\Resource\Model\LogInterface' => 'dag.model.log.class',
        );

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DAG\Component\Resource\Model',
        );

        $container->addCompilerPass(new ObjectToIdentifierServicePass());
        $container->addCompilerPass(new RegisterImporterPass());
        $container->addCompilerPass(new RegisterImporterManagerPass());
        $container->addCompilerPass(new RegisterExpressionLanguagePass());
        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('dag_resource', $interfaces));
        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'dag_resource.driver.doctrine/orm'
            )
        );
    }
}
