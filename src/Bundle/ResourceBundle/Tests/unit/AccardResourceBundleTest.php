<?php

/**
 * This file is part of the Accard package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAGTest\Bundle\ResourceBundle;

use Mockery;
use DAG\Bundle\ResourceBundle\AccardResourceBundle;
use DAG\Bundle\ResourceBundle\DependencyInjection\Compiler\ObjectToIdentifierServicePass;


class AccardResourceBundleTest extends \Codeception\TestCase\Test
{
    protected function _before()
    {
        $this->bundle = new AccardResourceBundle();
    }

    public function testBuildRegistersExpectedNumberOfBundles()
    {
        $container = Mockery::mock('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->shouldReceive('addCompilerPass')->times(6)
            ->getMock()
        ;

        $this->bundle->build($container);
    }
}
