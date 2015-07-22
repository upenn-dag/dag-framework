<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Component\Resource\Exception;

use Mockery;
use Codeception\TestCase\Test;
use DAG\Component\Resource\Exception\ImportFailedException;

/**
 * Import failed exception tests.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ImportFailedExceptionTest extends Test
{
    public function _before()
    {
        $this->exception = new ImportFailedException();
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
     * @expectedException DAG\Component\Resource\Exception\ImportFailedException
     */
    public function testExceptionIsThrowable()
    {
        throw $this->exception;
    }
}
