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

use DAG\Bundle\ResourceBundle\DependencyInjection\DoctrineTargetEntitiesResolver;
use DAG\Bundle\ResourceBundle\DAGResourceBundle;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Resolves given target entities with container parameters.
 * Usable only with *doctrine/orm* driver.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface
{
    /**
     * @var array $interfaces
     */
    private $interfaces;

    /**
     * @var string $bundlePrefix
     */
    private $bundlePrefix;

    /**
     * Constructor.
     *
     * @param string $bundlePrefix
     * @param array $interfaces
     */
    public function __construct($bundlePrefix, array $interfaces)
    {
        $this->bundlePrefix = $bundlePrefix;
        $this->interfaces = $interfaces;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (DAGResourceBundle::DRIVER_DOCTRINE_ORM === $this->getDriver($container)) {
            $resolver = new DoctrineTargetEntitiesResolver();
            $resolver->resolve($container, $this->interfaces);
        }
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return string
     */
    private function getDriver(ContainerBuilder $container)
    {
        return $container->getParameter(sprintf('%s.driver', $this->bundlePrefix));
    }
}
