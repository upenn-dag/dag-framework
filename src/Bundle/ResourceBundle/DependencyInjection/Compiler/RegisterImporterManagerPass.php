<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\ResourceBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Registers all importer managers.
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
class RegisterImporterManagerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('dag.import.manager_registry')) {
            return;
        }

        $registry = $container->getDefinition('dag.import.manager_registry');

        foreach ($container->findTaggedServiceIds('dag.manager') as $id => $attributes) {
            $registry->addMethodCall('registerManager', array($attributes[0]['manager'], $id));
        }
    }
}