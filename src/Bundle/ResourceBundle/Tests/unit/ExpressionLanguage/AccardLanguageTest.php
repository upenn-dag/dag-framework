<?php
namespace DAGTest\Bundle\ResourceBundle\ExpressionLanguage;

/**
 * Accard Language
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\ExpressionLanguage\AccardLanguage;
use Mockery;

class AccardLanguageTest extends \Codeception\TestCase\Test
{
    public function testAccardLanguageCanSetExpressionLanguage()
    {
        $exrLanguage = Mockery::mock('DAG\Bundle\ResourceBundle\ExpressionLanguage\ExpressionLanguage');
        $this->assertEmpty(AccardLanguage::setExpressionLanguage($exrLanguage));
    }

    public function testAccardLanguageCanGetInstance()
    {
        $this->assertInstanceOf(
            'DAG\Bundle\ResourceBundle\ExpressionLanguage\AccardLanguage',
            AccardLanguage::getInstance()
        );
    }

    public function testAccardLanguageCreatePrototypeDescriptionThrowsExceptionWhenNonPrototypeSubjectInterfaceGiven()
    {
        $resourceInterface = Mockery::mock('DAG\Component\Resource\Model\ResourceInterface');

        $dagLanguage = new AccardLanguage();
        $this->setExpectedException('InvalidArgumentException');

        $dagLanguage->createPrototypeDescription($resourceInterface);
    }

    public function testAccardLanguageGetExpressionLanguageReturnsExpressionLanguage()
    {
        $dagLanguage = new AccardLanguage();

        $this->assertInstanceOf(
            'DAG\Bundle\ResourceBundle\ExpressionLanguage\ExpressionLanguage',
            $dagLanguage->getExpressionLanguage());
    }
}