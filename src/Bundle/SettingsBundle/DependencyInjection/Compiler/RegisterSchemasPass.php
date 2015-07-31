<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\SettingsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use InvalidArgumentException;

/**
 * Registers all settings schemas.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class RegisterSchemasPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('dag.settings.schema_registry')) {
            return;
        }

        $registry = $container->getDefinition('dag.settings.schema_registry');

        foreach ($container->findTaggedServiceIds('dag.settings_schema') as $id => $attributes) {
            if (!array_key_exists('namespace', $attributes[0])) {
                throw new InvalidArgumentException(sprintf(
                    'Service "%s" must define the "namespace" attribute on "dag.settings_schema" tags.',
                    $id
                ));
            }

            $namespace = $attributes[0]['namespace'];
            $registry->addMethodCall('registerSchema', array($namespace, new Reference($id)));
        }
    }
}
