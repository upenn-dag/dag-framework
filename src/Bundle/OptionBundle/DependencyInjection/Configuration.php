<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\OptionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * DAG option bundle configuration.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dag_option');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultValue('doctrine/orm')->cannotBeEmpty()->end()
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
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('option')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('dag'))
                        ->end()
                        ->arrayNode('option_value')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('dag'))
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
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('option')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('DAG\Component\Option\Model\Option')->end()
                                ->scalarNode('controller')->defaultValue('DAG\Bundle\OptionBundle\Controller\OptionController')->end()
                                ->scalarNode('repository')->defaultValue('DAG\Bundle\OptionBundle\Doctrine\ORM\OptionRepository')->end()
                                ->scalarNode('form')->defaultValue('DAG\Bundle\OptionBundle\Form\Type\OptionType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('option_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('DAG\Component\Option\Model\OptionValue')->end()
                                ->scalarNode('controller')->defaultValue('DAG\Bundle\ResourceBundle\Controller\ResourceController')->end()
                                ->scalarNode('repository')->defaultValue('DAG\Bundle\OptionBundle\Doctrine\ORM\OptionValueRepository')->end()
                                ->scalarNode('form')->defaultValue('DAG\Bundle\OptionBundle\Form\Type\OptionValueType')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
