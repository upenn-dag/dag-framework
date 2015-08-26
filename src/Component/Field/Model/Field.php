<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Component\Field\Model;

use BadMethodCallException;
use DAG\Component\Option\Model\OptionInterface;
use DAG\Component\Option\Model\OptionOrder;

/**
 * Field model.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class Field implements FieldInterface
{
    /**
     * Fied type shortcut.
     *
     * This, technically, shouldn't exist. But it does anyway because of a weird
     * bug within Symfony's validator component where it is attempting to load
     * the FieldTypes class multiple times when called via XML. It's odd, but
     * it happens.
     *
     * @return array
     */
    public static function getFieldTypesForValidation()
    {
        return FieldTypes::getKeys();
    }

    /**
     * Field id.
     *
     * @var integer
     */
    protected $id;

    /**
     * Internal name.
     *
     * @var string
     */
    protected $name;

    /**
     * Field type.
     *
     * @param string
     */
    protected $type = FieldTypes::TEXT;

    /**
     * Field presentation.
     *
     * @var string
     */
    protected $presentation;

    /**
     * Field choice option.
     *
     * Only used when type is set to choice field.
     *
     * @var OptionInterface
     */
    protected $option;

    /**
     * Allow multiple choices.
     *
     * @var boolean
     */
    protected $allowMultiple = false;

    /**
     * Flag to indicate values can be added inline for this field
     *
     * @var boolean
     */
    protected $addable = false;

    /**
     * Field ordering type.
     *
     * @var string
     */
    protected $order = OptionOrder::DEFAULT_ORDER;

    /**
     * Field configuration.
     *
     * @var array
     */
    protected $configuration = array();
public static function getKeys()
{
    return FieldTypes::getKeys();
}

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * {@inheritdoc}
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

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
    public function getAllowMultiple()
    {
        return $this->allowMultiple;
    }

    /**
     * {@inheritdoc}
     */
    public function setAllowMultiple($allowMultiple)
    {
        $this->allowMultiple = (boolean) $allowMultiple;

        return $this;
    }

    /**
     * Indicate values can be added inline for this field
     *
     * @return boolean
     */
    public function isAddable()
    {
        return $this->addable;
    }

    /**
     * Set if values can be added inline for this field
     *
     * @param boolean $addable
     * @return FieldValueInterface
     */
    public function setAddable($addable)
    {
        $this->addable = (boolean) $addable;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->getName();
    }
}
