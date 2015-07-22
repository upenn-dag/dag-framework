<?php
namespace DAGTest\Bundle\ResourceBundle\Exception\Driver;

/**
 * Unknown Driver Exception
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Exception\Driver\UnknownDriverException;

class UnknownDriverExceptionTest extends \Codeception\TestCase\Test
{
    public function testUnknownDriverExceptionFormatsMessageCorrectly()
    {
        $exception = new UnknownDriverException('DRIVER');

        $this->assertSame('Unknown driver "DRIVER"', $exception->getMessage());
    }

}