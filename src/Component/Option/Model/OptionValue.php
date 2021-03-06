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

use BadMethodCallException;
use DAG\Component\Resource\Model\LockableTrait;
use DAG\Component\Resource\Model\OrderableTrait;

/**
 * Option value model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class OptionValue implements OptionValueInterface
{
    use LockableTrait;
    use OrderableTrait;

    /**
     * Option value id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Value.
     *
     * @var string
     */
    protected $value;

    /**
     * Option.
     *
     * @var OptionInterface
     */
    protected $option;


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(OptionInterface $option = null)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        if (null === $this->option) {
            throw new BadMethodCallException('Option proxy method access failed, not yet set.');
        }

        return $this->option->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        if (null === $this->option) {
            throw new BadMethodCallException('Option proxy method access failed, not yet set.');
        }

        return $this->option->getPresentation();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
