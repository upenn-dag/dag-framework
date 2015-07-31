<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\OptionBundle\Templating\Helper;

use InvalidArgumentException;
use DAG\Component\Option\Model\OptionInterface;
use DAG\Component\Option\Provider\OptionProviderInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Option template helper.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class OptionHelper extends Helper
{
    /**
     * Option manager.
     *
     * @var OptionProviderInterface
     */
    private $optionProvider;


    /**
     * Constructor.
     *
     * @param OptionProviderInterface $optionProvider
     */
    public function __construct(OptionProviderInterface $optionProvider)
    {
        $this->optionProvider = $optionProvider;
    }

    /**
     * Get option.
     *
     * @param string $optionName
     * @return OptionInterface
     */
    public function getOption($optionName)
    {
        return $this->optionProvider->getOptionByName($optionName);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'dag_option';
    }
}
