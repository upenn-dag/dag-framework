<?php
namespace DAGTest\Bundle\ResourceBundle\Exception;

/**
 * Resource Not Subject Exception
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */

use DAG\Bundle\ResourceBundle\Exception\ResourceNotSubjectException;
use DAG\Bundle\ResourceBundle\Test\Stub\ImportStub;

class ResourceNotSubjectExceptionTest extends \Codeception\TestCase\Test
{
    public function testResourceNotSubjectExceptionFormatsMessageCorrectly()
    {
        $stub = new ImportStub();
        $exception = new ResourceNotSubjectException($stub);
        $message = 'Object of class DAG\Bundle\ResourceBundle\Test\Stub\ImportStub must be registered as a subject.';

        $this->assertSame($exception->getMessage(), $message);
    }

}