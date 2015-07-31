<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Component\Resource\Exception;

use Mockery;
use Codeception\TestCase\Test;
use DAG\Component\Resource\Exception\ImportTargetAlreadySetException;

/**
 * Import target already set exceptiontest.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportTargetAlreadySetExceptionTest extends Test
{
    public function _before()
    {
        $this->importTarget = Mockery::mock('DAG\Component\Resource\Model\ImportTargetInterface');
        $this->importSubject = Mockery::mock('DAG\Component\Resource\Model\ImportSubjectInterface');

        $this->exception = new ImportTargetAlreadySetException($this->importTarget, $this->importSubject);
    }

    public function testExceptionIsResourceException()
    {
        $this->assertInstanceOf(
            'DAG\Component\Resource\Exception\ResourceException',
            $this->exception
        );
    }

    public function testExceptionIsCorrectExceptionType()
    {
        $this->assertInstanceOf(
            'RuntimeException',
            $this->exception
        );
    }

    /**
     * @expectedException DAG\Component\Resource\Exception\ImportTargetAlreadySetException
     */
    public function testExceptionIsThrowable()
    {
        throw $this->exception;
    }

    public function testExceptionContainsClassOfBothArguements()
    {
        $this->assertAttributeContains(get_class($this->importTarget), 'message', $this->exception);
        $this->assertAttributeContains(get_class($this->importSubject), 'message', $this->exception);
    }
}
