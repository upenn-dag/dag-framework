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
 * Registers expression language functions.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class RegisterExpressionLanguagePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('dag.expression_language')) {
            return;
        }

        $exprLang = $container->getDefinition('dag.expression_language');

        foreach ($container->findTaggedServiceIds('dag.expression_language_extension') as $id => $attributes) {
            $exprLang->addMethodCall('registerExtension', array(new Reference($id)));
        }
    }
}
