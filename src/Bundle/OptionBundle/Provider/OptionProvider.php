<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\OptionBundle\Provider;

use DAG\Component\Option\Model\OptionInterface;
use DAG\Component\Option\Provider\OptionProviderInterface;
use DAG\Component\Option\Repository\OptionRepositoryInterface;
use DAG\Component\Option\Exception\OptionNotFoundException;

/**
 * Option provider.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class OptionProvider implements OptionProviderInterface
{
    /**
     * Option repository.
     *
     * @var OptionRepositoryInterface
     */
    protected $optionRepository;


    /**
     * Constructor.
     *
     * @param OptionRepositoryInterface $optionRepository
     */
    public function __construct(OptionRepositoryInterface $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption($optionId)
    {
        try {
            $this->getOption($optionId);

            return true;
        } catch (OptionNotFoundException $e) {}

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($optionId)
    {
        $option = $this->optionRepository->find($optionId);

        if (!$option instanceof OptionInterface) {
            throw new OptionNotFoundException($optionId);
        }

        return $option;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOptionByName($optionName)
    {
        try {
            $this->getOptionByName($optionName);

            return true;
        } catch (OptionNotFoundException $e) {}

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionByName($optionName)
    {
        $option = $this->optionRepository->findOneByName(array('name' => $optionName));

        if (!$option instanceof OptionInterface) {
            throw new OptionNotFoundException($optionName);
        }

        return $option;
    }
}
