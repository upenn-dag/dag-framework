<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\FieldBundle\Doctrine\ORM;

use DAG\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use DAG\Component\Field\Repository\FieldRepositoryInterface;

/**
 * Field repository.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FieldRepository extends EntityRepository implements FieldRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'field';
    }
}
