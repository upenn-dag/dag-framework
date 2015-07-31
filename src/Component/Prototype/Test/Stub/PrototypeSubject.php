<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Component\Prototype\Test\Stub;

use DAG\Component\Field\Model\FieldSubjectInterface;
use DAG\Component\Field\Model\FieldSubjectTrait;
use DAG\Component\Prototype\Model\PrototypeSubjectInterface;
use DAG\Component\Prototype\Model\PrototypeSubjectTrait;

/**
 * Prototype subject stub.
 *
 * This class is used as a base prototype subject, used in tests to simulate
 * using an actual prototype subject.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class PrototypeSubject implements PrototypeSubjectInterface, FieldSubjectInterface
{
    use PrototypeSubjectTrait;
    use FieldSubjectTrait;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
