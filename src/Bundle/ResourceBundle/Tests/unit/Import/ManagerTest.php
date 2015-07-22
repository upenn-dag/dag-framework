<?php
namespace DAGTest\Bundle\ResourceBundle\Import;

/**
 * Import Manager Test
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Import\Manager;
use Mockery;

class ManagerTest extends \Codeception\TestCase\Test
{
    protected function _before()
    {
        $this->event = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ImportEvent');
        $this->initializer = Mockery::mock('DAG\Bundle\ResourceBundle\Import\InitializerInterface');
        $this->converter = Mockery::mock('DAG\Bundle\ResourceBundle\Import\ConverterInterface');
        $this->persister = Mockery::mock('DAG\Bundle\ResourceBundle\Import\PersisterInterface');

        $this->manager = new Manager($this->initializer, $this->converter, $this->persister);
    }

    public function testManagerImplementsManagerInterface()
    {
        $this->assertInstanceOf(
            'DAG\Bundle\ResourceBundle\Import\ManagerInterface',
            $this->manager
        );
    }

    public function testManagerInitializeCallsInitialize()
    {
        $this->initializer->shouldReceive('initialize')->once();

        $this->assertEmpty($this->manager->initialize($this->event));
    }

    public function testManagerConvertCallsConvert()
    {
        $this->converter->shouldReceive('convert')->once();

        $this->assertEmpty($this->manager->convert($this->event));
    }

    public function testManagerPersistCallsPersist()
    {
        $this->persister->shouldReceive('persist')->once();

        $this->assertEmpty($this->manager->persist($this->event));
    }

    public function testManagerSetDryRunOptionIsFluentAndMutable()
    {
        $this->assertSame($this->manager, $this->manager->setDryRunOption(true));

        $this->assertEquals(true, $this->manager->getDryRunOption());

    }

    public function testManagerInitializerIsFluentAndMutable()
    {
        $initializer = Mockery::mock('DAG\Bundle\ResourceBundle\Import\InitializerInterface');

        $this->assertSame($this->manager, $this->manager->setInitializer($initializer));

        $this->assertSame($initializer, $this->manager->getInitializer());
    }

    public function testManagerConverterIsFluentAndMutable()
    {
        $converter = Mockery::mock('DAG\Bundle\ResourceBundle\Import\ConverterInterface');

        $this->assertSame($this->manager, $this->manager->setConverter($converter));

        $this->assertSame($converter, $this->manager->getConverter());
    }

    public function testManagerPersisterIsFluentAndMutable()
    {
        $persister = Mockery::mock('DAG\Bundle\ResourceBundle\Import\PersisterInterface');

        $this->assertSame($this->manager, $this->manager->setPersister($persister));

        $this->assertSame($persister, $this->manager->getPersister());
    }
}