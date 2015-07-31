<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Model;

use DAG\Component\Field\Test\FieldSubjectTest;
use DAG\Component\Field\Test\Stub\FieldSubject;

/**
 * Field subject trait tests.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FieldSubjectTraitTest extends \Codeception\TestCase\Test
{
    use FieldSubjectTest;

    protected function _before()
    {
        $this->fieldSubject = new FieldSubject();
    }
}
