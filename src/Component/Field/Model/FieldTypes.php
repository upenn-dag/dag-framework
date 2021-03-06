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

/**
 * Default field types.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FieldTypes
{
    const CHECKBOX = 'checkbox';
    const CHOICE = 'choice';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const NUMBER = 'number';
    const PERCENTAGE = 'percent';
    const TEXT = 'text';
    const MULTICHOICE = 'choice';

    /**
     * Get field type choices.
     *
     * @return array
     */
    public static function getChoices()
    {
        return array(
            self::CHECKBOX => 'Checkbox',
            self::CHOICE => 'Choice',
            self::DATE => 'Date',
            self::DATETIME => 'Datetime',
            self::NUMBER => 'Number',
            self::PERCENTAGE => 'Percentage',
            self::TEXT => 'Text',
            self::MULTICHOICE => 'Choice',
        );
    }

    /**
     * Get field type keys.
     *
     * @return array
     */
    public static function getKeys()
    {
        return array_keys(static::getChoices());
    }
}
