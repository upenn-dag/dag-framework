<?php
namespace DAGTest\Bundle\ResourceBundle\Controller;

/**
 * Resource Domain Manager Test
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Controller\DomainManager;
use Mockery;

class DomainManagerTest extends \Codeception\TestCase\Test
{

    protected function _before()
    {
        $this->objectManager = Mockery::mock('Doctrine\Common\Persistence\ObjectManager');
        $this->eventDispatcher = Mockery::mock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->flashHelper = Mockery::mock('DAG\Bundle\ResourceBundle\Controller\FlashHelper');
        $this->config = Mockery::mock('DAG\Bundle\ResourceBundle\Controller\Configuration')
            ->shouldReceive('getEventName')
            ->getMock()
        ;

        $this->domainManager = new DomainManager($this->objectManager, $this->eventDispatcher, $this->flashHelper, $this->config);
    }

    public function testDomainManagerDoesNotSetFlashMessagesFromResourceEventWhenEventStillPropagating()
    {
        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(false)
            ->getMock()
        ;

        $this->eventDispatcher->shouldReceive('dispatch')->andReturn($resourceEvent);
        $this->flashHelper->shouldReceive('setFlash')->with('success', 'create');

        $this->objectManager
            ->shouldReceive('persist')->zeroOrMoreTimes()
            ->shouldReceive('flush')->zeroOrMoreTimes()
            ->getMock();

        $resource = Mockery::mock('DAG\Component\Resource\Model\Resource');
        $resource->shouldReceive('getName');

        $this->domainManager->create($resource);
    }

    public function testDomainManagerSetsFlashMessagesFromResourceEventWhenEventIsStopped()
    {
        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(true)
            ->shouldReceive('getMessageType')->andReturn('TYPE')
            ->shouldReceive('getMessage')->andReturn('MESSAGE')
            ->shouldReceive('getMessageParameters')->andReturn('PARAMETERS')
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')
            ->andReturn($resourceEvent)
        ;
        $this->flashHelper
            ->shouldReceive('setFlash')
            ->with('TYPE', 'MESSAGE', 'PARAMETERS')
        ;

        $resource = Mockery::mock('DAG\Component\Resource\Model\Resource');
        $resource
            ->shouldReceive('getName')
        ;

        $this->domainManager->create($resource);
    }

    public function testDomainManagerDoesNotPersistResourceWhenResourceEventIsStopped()
    {
        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(true)
            ->shouldReceive('getMessageType')->andReturn('TYPE')
            ->shouldReceive('getMessage')->andReturn('MESSAGE')
            ->shouldReceive('getMessageParameters')->andReturn('PARAMETERS')
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')
            ->andReturn($resourceEvent)
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')
            ->with('TYPE', 'MESSAGE', 'PARAMETERS')
        ;

        $resource = Mockery::mock()
            ->shouldReceive('getName')
            ->getMock()
        ;

        $this->domainManager->create($resource);
    }

    public function testDomainManagerUpdateMethodFlashMessageIsSetToUpdateByDefault()
    {
        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(false)
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')
            ->andReturn($resourceEvent)
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')
            ->with('success', 'update')
        ;

        $resource = Mockery::mock()
            ->shouldReceive('getName')
            ->getMock()
        ;

        $this->objectManager
            ->shouldReceive('persist')->zeroOrMoreTimes()
            ->shouldReceive('flush')->zeroOrMoreTimes()
            ->getMock();

        $this->domainManager->update($resource);
    }

    public function testDomainManagerUpdateMethodFlashMessageIsMutable()
    {
        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(false)
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')
            ->andReturn($resourceEvent)
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')
            ->with('success', 'UPDATE')
        ;

        $resource = Mockery::mock()
            ->shouldReceive('getName')
            ->getMock()
        ;

        $this->objectManager
            ->shouldReceive('persist')->zeroOrMoreTimes()
            ->shouldReceive('flush')->zeroOrMoreTimes()
            ->getMock();

        $this->domainManager->update($resource, 'UPDATE');
    }

    public function testDomainManagerUpdateMethodDoesNotPersistWhenEventStopped()
    {
        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(true)
            ->shouldReceive('getMessageType')->andReturn('TYPE')
            ->shouldReceive('getMessage')->andReturn('MESSAGE')
            ->shouldReceive('getMessageParameters')->andReturn('PARAMETERS')
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')
            ->andReturn($resourceEvent)
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')
            ->with('TYPE', 'MESSAGE', 'PARAMETERS')
        ;

        $resource = Mockery::mock()
            ->shouldReceive('getName')
            ->getMock()
        ;

        $this->objectManager
            ->shouldReceive('persist')->never()
            ->shouldReceive('flush')->never()
            ->getMock();

        $this->domainManager->update($resource, 'UPDATE');
    }

    public function testDomainManagerMoveWorks()
    {
        $resource = new \DAG\Bundle\ResourceBundle\Test\Stub\Stub();

        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(false)
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')->zeroOrMoreTimes()->andReturn($resourceEvent)
        ;

        $this->config
            ->shouldReceive('getSortablePosition')->once()->andReturn('sort')
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')->once()
        ;

        $this->objectManager
            ->shouldReceive('persist')->once()
            ->shouldReceive('flush')->once()
        ;

        $this->domainManager->move($resource, 1);
    }

    public function testDomainManagerDeleteRemovesResourceWhenResourceEventIsPropagating()
    {
        $resource = new \DAG\Bundle\ResourceBundle\Test\Stub\Stub();

        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(false)
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')->twice()->andReturn($resourceEvent)
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')->once()
        ;

        $this->objectManager
            ->shouldReceive('remove')->once()
            ->shouldReceive('flush')->once()
        ;

        $this->domainManager->delete($resource);
    }

    public function testDomainManagerDoesNotDeleteResourceWhenResourceEventIsStopped()
    {
        $resource = new \DAG\Bundle\ResourceBundle\Test\Stub\Stub();

        $resourceEvent = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ResourceEvent')
            ->shouldReceive('isStopped')->andReturn(true)
            ->shouldReceive('getMessageType')->once()
            ->shouldReceive('getMessage')->once()
            ->shouldReceive('getMessageParameters')->once()
            ->getMock()
        ;

        $this->eventDispatcher
            ->shouldReceive('dispatch')->once()->andReturn($resourceEvent)
        ;

        $this->flashHelper
            ->shouldReceive('setFlash')->once()
        ;

        $this->objectManager
            ->shouldReceive('remove')->never()
            ->shouldReceive('flush')->never()
        ;

        $this->domainManager->delete($resource);
    }

}