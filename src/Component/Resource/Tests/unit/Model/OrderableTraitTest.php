<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Component\Resource\Model;

use Mockery;
use Codeception\TestCase\Test;
use DAG\Component\Resource\Test\Stub\OrderableResource;

/**
 * Orderable trait tests.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class OrderableTraitTests extends Test
{
    public function _before()
    {
        $this->orderable = new OrderableResource();
    }

    // Internal use only.
    public function testOrderableImplementsInterface()
    {
        $this->assertInstanceOf(
            'DAG\Component\Resource\Model\OrderableInterface',
            $this->orderable
        );
    }

    public function testOrderableOrderIsZeroOnCreation()
    {
        $this->assertAttributeSame(0, 'order', $this->orderable);
        $this->assertSame(0, $this->orderable->getOrder());
    }

    public function testOrderableOrderIsMutable()
    {
        $expected = 1;
        $this->orderable->setOrder($expected);
        $this->assertSame($expected, $this->orderable->getOrder());
    }

    public function testOrderableOrderIsFluent()
    {
        $this->assertSame($this->orderable, $this->orderable->setOrder(1));
    }
}
