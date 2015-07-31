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
use DAG\Component\Resource\Test\Stub\BlameableResource;

/**
 * Blameable trait resource tests.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class BlameableTraitTest extends Test
{
    public function _before()
    {
        $this->user = Mockery::mock('DAG\Component\Resource\Model\UserInterface');
        $this->blameable = new BlameableResource();
    }

    // This is for internal testing, otherwise it's useless
    public function testBlameableImplementsBlameableInterface()
    {
        $this->assertInstanceOf(
            'DAG\Component\Resource\Model\BlameableInterface',
            $this->blameable
        );
    }

    public function testBlameableCreatedByIsNullOnCreation()
    {
        $this->assertAttributeSame(null, 'createdBy', $this->blameable);
        $this->assertNull($this->blameable->getCreatedBy());
    }

    public function testBlameableCreatedByIsMutable()
    {
        $this->blameable->setCreatedBy($this->user);
        $this->assertAttributeSame($this->user, 'createdBy', $this->blameable);
    }

    public function testBlameableUpdatedByIsNullOnCreation()
    {
        $this->assertAttributeSame(null, 'updatedBy', $this->blameable);
        $this->assertNull($this->blameable->getUpdatedBy());
    }

    public function testBlameableUpdatedByIsMutable()
    {
        $this->blameable->setUpdatedBy($this->user);
        $this->assertAttributeSame($this->user, 'updatedBy', $this->blameable);
    }
}
