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

/**
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface DatabaseDriverInterface
{
    public function load(array $classes);

    public function getSupportedDriver();
}
