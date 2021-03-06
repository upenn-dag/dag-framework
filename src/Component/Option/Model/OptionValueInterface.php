<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Component\Option\Model;

use DAG\Component\Resource\Model\ResourceInterface;
use DAG\Component\Resource\Model\LockableInterface;
use DAG\Component\Resource\Model\OrderableInterface;

/**
 * Option value interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface OptionValueInterface extends ResourceInterface, LockableInterface, OrderableInterface
{
    /**
     * Get option.
     *
     * @return OptionInterface
     */
    public function getOption();

    /**
     * Set option.
     *
     * @param OptionInterface $option
     */
    public function setOption(OptionInterface $option = null);

    /**
     * Get internal value.
     *
     * @return string
     */
    public function getValue();

    /**
     * Set internal value.
     *
     * @param string $value
     */
    public function setValue($value);

    /**
     * Proxy method to access the name of real option object.
     *
     * @return string The name of option
     */
    public function getName();

    /**
     * Proxy method to access the presentation of real option object.
     *
     * @return string The presentation of object
     */
    public function getPresentation();
}
