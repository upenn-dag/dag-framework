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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * DAG prototype bundle configuration.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dag_prototype');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;

        $this->addClassesSection($rootNode);
        $this->addValidationGroupsSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds validation_groups section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addValidationGroupsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('validation_groups')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('prototype')
                                ->prototype('scalar')->end()
                                ->defaultValue(array('dag'))
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * Adds classes section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('subject')->end()
                            ->arrayNode('prototype')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue('DAG\Component\Prototype\Model\Prototype')->end()
                                    ->scalarNode('controller')->defaultValue('DAG\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                    ->scalarNode('repository')->defaultValue('DAG\Bundle\PrototypeBundle\Doctrine\ORM\PrototypeRepository')->end()
                                    ->scalarNode('form')->defaultValue('DAG\Bundle\PrototypeBundle\Form\Type\PrototypeType')->end()
                                ->end()
                            ->end()
                            ->arrayNode('field')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->end()
                                ->end()
                            ->end()
                            ->arrayNode('field_value')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
