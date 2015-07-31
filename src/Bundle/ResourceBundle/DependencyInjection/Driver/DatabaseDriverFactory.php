<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace DAG\Bundle\ResourceBundle\DependencyInjection\Driver;

use DAG\Bundle\ResourceBundle\Exception\Driver\UnknownDriverException;
use DAG\Bundle\ResourceBundle\DAGResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * DAG database driver factor.
 *
 * Allows for the segration of a resource from a specific type of Doctrine;
 * whether it be the ORM, ODM or PHP-CR.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DatabaseDriverFactory
{
    public static function get(
        $type = DAGResourceBundle::DRIVER_DOCTRINE_ORM,
        ContainerBuilder $container,
        $prefix,
        $resourceName,
        $templates = null
    ) {
        switch ($type) {
            case DAGResourceBundle::DRIVER_DOCTRINE_ORM:
                return new DoctrineORMDriver($container, $prefix, $resourceName, $templates);
            default:
                throw new UnknownDriverException($type);
        }
    }
}
