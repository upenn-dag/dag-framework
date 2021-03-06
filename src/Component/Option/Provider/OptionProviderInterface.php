<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Component\Option\Provider;

use DAG\Component\Option\Model\OptionInterface;
use DAG\Component\Option\Exception\OptionNotFoundException;

/**
 * Option provider interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface OptionProviderInterface
{
    /**
     * Test for presence of option.
     *
     * @param integer $optionId
     * @return boolean
     */
    public function hasOption($optionId);

    /**
     * Get option.
     *
     * @param integer $optionId
     * @return OptionInterface|null
     * @throws OptionNotFoundException When option can not be located.
     */
    public function getOption($optionId);

    /**
     * Test for presence of option by name.
     *
     * @param integer $optionId
     * @return boolean
     */
    public function hasOptionByName($optionName);

    /**
     * Get option by name.
     *
     * @param string $optionName
     * @return OptionInterface|null
     * @throws OptionNotFoundException When option can not be located.
     */
    public function getOptionByName($optionName);
}
