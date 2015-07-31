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
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class ObjectToIdentifierServicePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('doctrine')) {
            $definition = new DefinitionDecorator('dag.form.type.object_to_identifier');
            $definition->addArgument(new Reference('doctrine'));
            $definition->addArgument('dag_entity_to_identifier');
            $definition->addTag('form.type', array('alias' => 'dag_entity_to_identifier'));

            $container->setDefinition('dag_entity_to_identifier', $definition);
        }

        if ($container->hasDefinition('doctrine_mongodb')) {
            $definition = new DefinitionDecorator('dag.form.type.object_to_identifier');
            $definition->addArgument(new Reference('doctrine_mongodb'));
            $definition->addArgument('dag_document_to_identifier');
            $definition->addTag('form.type', array('alias' => 'dag_document_to_identifier'));

            $container->setDefinition('dag_document_to_identifier', $definition);

            if (!$container->hasDefinition('dag_entity_to_identifier')) {
                $container->setAlias('dag_entity_to_identifier', 'dag_document_to_identifier');
            }
        }

        if ($container->hasDefinition('doctrine_phpcr')) {
            $definition = new DefinitionDecorator('dag.form.type.object_to_identifier');
            $definition->addArgument(new Reference('doctrine_phpcr'));
            $definition->addArgument('dag_phpcr_document_to_identifier');
            $definition->addTag('form.type', array('alias' => 'dag_phpcr_document_to_identifier'));

            $container->setDefinition('dag_phpcr_document_to_identifier', $definition);

            if (!$container->hasDefinition('dag_entity_to_identifier')) {
                $container->setAlias('dag_entity_to_identifier', 'dag_phpcr_document_to_identifier');
            }
        }
    }
}
