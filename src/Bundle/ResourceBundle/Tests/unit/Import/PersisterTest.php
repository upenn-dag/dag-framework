<?php
namespace DAGTest\Bundle\ResourceBundle\Import;

/**
 * Import Persister Test
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Import\Persister;
use Mockery;

class PersisterTest extends \Codeception\TestCase\Test
{
    protected function _before()
    {
        $this->persister = new Persister();
    }

    public function testPersisterAdheresToPersisterInterface()
    {
        $this->assertInstanceOf(
            'DAG\Bundle\ResourceBundle\Import\PersisterInterface',
            $this->persister
        );
    }

    public function testPersisterPersistImportDisablesSQLLoggerPersistsAndFlushesRecords()
    {
        $configuration = Mockery::mock()
            ->shouldReceive('setSQLLogger')->once()->with(null)
            ->getMock()
        ;

        $connection = Mockery::mock()
            ->shouldReceive('getConfiguration')->andReturn($configuration)
            ->getMock()
        ;

        $om = Mockery::mock()
            ->shouldReceive('getConnection')->andReturn($connection)
            ->shouldReceive('transactional')
            ->shouldReceive('persist')->twice()
            ->shouldReceive('flush')->twice()
            ->getMock()
        ;

        $target = Mockery::mock()->shouldReceive('getManager')->twice()->andReturn($om)
            ->getMock();

        $import = Mockery::mock()
            ->shouldReceive('setEndTimestamp')
            ->getMock()
        ;

        $event = Mockery::mock('DAG\Bundle\ResourceBundle\Event\ImportEvent')
            ->shouldReceive('getTarget')->andReturn($target)->twice()
            ->shouldReceive('getImport')->andReturn($import)
            ->shouldReceive('getRecords')->andReturn(array())
            ->getMock()
        ;

        $this->persister->persist($event);
    }

}