<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace Stub;

use DAG\Component\Field\Model\FieldSubjectTrait;
use DAG\Component\Field\Model\FieldSubjectInterface;

/**
 * Field subject stub.
 *
 * This stubs job is ONLY to create a base representation of a field subject
 * so we're able to test. At some point, I think we should move this into the
 * main repository in the Test/ folder so we may use it elsewhere?
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class FieldSubject implements FieldSubjectInterface
{
    use FieldSubjectTrait;

    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }
}