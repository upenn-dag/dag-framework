<?php
namespace DAGTest\Bundle\ResourceBundle\Exception;

/**
 * Unexpected Type Exception
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Exception\UnexpectedTypeException;
use DAG\Bundle\ResourceBundle\Test\Stub\Stub;

class UnexpectedTypeExceptionTest extends \Codeception\TestCase\Test
{
    public function testUnexpectedTypeExceptionFormatsMessageCorrectlyWhenObjectGiven()
    {
        $message = 'Expected argument of type "TYPE", "DAG\Bundle\ResourceBundle\Test\Stub\Stub" given';
        $stub = new Stub();

        $exception = new UnexpectedTypeException($stub, 'TYPE');

        $this->assertSame($message, $exception->getMessage());
    }

    public function testUnexpectedTypeExceptionFormatsMessageCorrectlyWhenStringGiven()
    {
        $message = 'Expected argument of type "TYPE", "string" given';

        $exception = new UnexpectedTypeException('STRING', 'TYPE');

        $this->assertSame($message, $exception->getMessage());
    }
}