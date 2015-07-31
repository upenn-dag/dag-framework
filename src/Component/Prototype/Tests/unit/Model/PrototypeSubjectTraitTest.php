<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Component\Prototype\Model;

use DAG\Component\Prototype\Test\Stub\PrototypeSubject;
use DAG\Component\Prototype\Test\PrototypeTest;

/**
 * Prototype trait tests.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PrototypeSubjectTraitTest extends \Codeception\TestCase\Test
{
    use PrototypeTest;

    protected function _before()
    {
        $this->prototypeSubject = new PrototypeSubject();
    }
}
