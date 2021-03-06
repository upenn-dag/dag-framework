<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\SettingsBundle\Manager;

use DAG\Bundle\SettingsBundle\Model\Settings;

/**
 * Settings manager interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface SettingsManagerInterface
{
    /**
     * Load settings within a namespace.
     *
     * @param string $namespace
     *
     * @return Settings
     */
    public function load($namespace);

    /**
     * Save settings within a namespace.
     *
     * @param string   $namespace
     * @param Settings $settings
     */
    public function save($namespace, Settings $settings);
}
