<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Component\Resource\Test\Stub;

use DAG\Component\Resource\Model\ResourceInterface;
use DAG\Component\Resource\Model\BlameableInterface;
use DAG\Component\Resource\Model\BlameableTrait;

/**
 * Blameable resource stub.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class BlameableResource implements ResourceInterface, BlameableInterface
{
    use BlameableTrait;
}
