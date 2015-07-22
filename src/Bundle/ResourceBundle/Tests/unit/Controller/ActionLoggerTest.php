<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Bundle\ResourceBundle\Controller;

use Mockery;
use DAG\Bundle\ResourceBundle\Controller\ActionLogger;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller action logger tests.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class ActionLoggerTest extends \Codeception\TestCase\Test
{
    protected function _before()
    {
        // Mocking the request is tedius, I know this is bad practice but we're
        // using the actual object anyway.
        $request = new Request();

        $configuration = Mockery::mock('DAG\Bundle\ResourceBundle\Controller\Configuration')
            ->shouldReceive('getRequest')->zeroOrMoreTimes()->andReturn($request)
            ->shouldReceive('getResourceName')->zeroOrMoreTimes()->andReturn('RESOURCE_NAME')
            ->getMock();

        $user = Mockery::mock('DAG\Component\Resource\Model\UserInterface');

        // This complex mock is required to allow the ->transactional() call to be
        // recorded in code coverage. Else, it will never hit the inside of the
        // transaction closure.
        $objectManager = Mockery::mock('Doctrine\Common\Persistence\ObjectManager')
            ->shouldReceive('persist')->zeroOrMoreTimes()->andReturn(null)
            ->shouldReceive('transactional')->once()->with(Mockery::on(
                function(&$runner) {
                    $runner(Mockery::self()); // Run the closure.
                    return true;
                }
            ))->andReturn(null)
            ->getMock();

        $this->actionLogger = new ActionLogger($configuration, $user, $objectManager);
    }

    public function testActionLoggerCreatesLogWithIndexAction()
    {
        $log = $this->actionLogger->indexLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('index', $log->getAction());
    }

    public function testActionLoggerCreatesLogWithShowAction()
    {
        $log = $this->actionLogger->showLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('show', $log->getAction());
    }

    public function testActionLoggerCreatesLogWithNewAction()
    {
        $log = $this->actionLogger->newLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('new', $log->getAction());
    }

    public function testActionLoggerCreatesLogWithCreateAction()
    {
        $log = $this->actionLogger->createLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('create', $log->getAction());
    }

    public function testActionLoggerCreatesLogWithEditAction()
    {
        $log = $this->actionLogger->editLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('edit', $log->getAction());
    }

    public function testActionLoggerCreatesLogWithUpdateAction()
    {
        $log = $this->actionLogger->updateLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('update', $log->getAction());
    }

    public function testActionLoggerCreatesLogWithDeleteAction()
    {
        $log = $this->actionLogger->deleteLog();
        $this->assertInstanceOf('DAG\Component\Resource\Model\LogInterface', $log);
        $this->assertSame('delete', $log->getAction());
    }
}
