<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\OptionBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use DAG\Bundle\ResourceBundle\AccardResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Accard option bundle.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class AccardOptionBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'DAG\Component\Option\Model\OptionInterface' => 'accard.model.option.class',
            'DAG\Component\Option\Model\OptionValueInterface' => 'accard.model.option_value.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('accard_option', $interfaces));

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DAG\Component\Option\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createYamlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'accard_option.driver.doctrine/orm'
            )
        );
    }
}
