<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Component\Resource;

use Mockery;
use Codeception\TestCase\Test;

/**
 * Tests for presence of resource interfaces required by the API.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class InterfaceTest extends Test
{
    public function testResourceBuilderInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Builder\BuilderInterface'));
    }

    public function testResourceExceptionInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Exception\ResourceException'));
    }

    public function testStateExceptionInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Exception\StateException'));
    }

    public function testResourceBlameableModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\BlameableInterface'));
    }

    public function testResourceImportModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\ImportInterface'));
    }

    public function testResourceImportSubjectModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\ImportSubjectInterface'));
    }

    public function testResourceImportTargetModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\ImportTargetInterface'));
    }

    public function testResourceLockableModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\LockableInterface'));
    }

    public function testResourceLogModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\LogInterface'));
    }

    public function testResourceModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\ResourceInterface'));
    }

    public function testResourceTimestampableModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\TimestampableInterface'));
    }

    public function testResourceUserModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\UserInterface'));
    }

    public function testResourceVersionableModelInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Model\VersionableInterface'));
    }

    public function testResourceProviderInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Provider\ProviderInterface'));
    }

    public function testResourceRepositoryInterfaceExists()
    {
        $this->assertTrue(interface_exists('DAG\Component\Resource\Repository\RepositoryInterface'));
    }
}
