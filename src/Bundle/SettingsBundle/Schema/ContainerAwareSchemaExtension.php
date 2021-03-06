<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\SettingsBundle\Schema;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Abstract, container aware schema extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
abstract class ContainerAwareSchemaExtension extends SchemaExtension implements SchemaExtensionInterface, ContainerAwareInterface
{
    /**
     * Service container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
