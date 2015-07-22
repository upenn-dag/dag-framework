<?php
namespace DAGTest\Bundle\ResourceBundle\ExpressionLanguage;

/**
 * Resource Extension
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\ExpressionLanguage\ResourceExtension;

class ResourceExtensionTest extends \Codeception\TestCase\Test
{
    protected function _before()
    {
        $this->resourceExtension = new ResourceExtension();
    }

    // tests
    public function testExpressionLanguageGetFunctionsReturnsArray()
    {
        $this->assertNotEmpty($this->resourceExtension->getFunctions());
    }

}