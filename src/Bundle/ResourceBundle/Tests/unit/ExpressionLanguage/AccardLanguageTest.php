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

        $accardLanguage = new AccardLanguage();
        $this->setExpectedException('InvalidArgumentException');

        $accardLanguage->createPrototypeDescription($resourceInterface);
    }

    public function testAccardLanguageGetExpressionLanguageReturnsExpressionLanguage()
    {
        $accardLanguage = new AccardLanguage();

        $this->assertInstanceOf(
            'DAG\Bundle\ResourceBundle\ExpressionLanguage\ExpressionLanguage',
            $accardLanguage->getExpressionLanguage());
    }
}