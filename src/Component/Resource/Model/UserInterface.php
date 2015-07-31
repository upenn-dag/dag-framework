<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Component\Resource\Model;

use Serializable;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User interface.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
interface UserInterface extends AdvancedUserInterface, ResourceInterface, Serializable
{
    /**
     * Get user id.
     *
     * @return integer
     */
    public function getId();

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username);

    /**
     * Set user is enabled.
     *
     * @param boolean $enabled
     * @return UserInterface
     */
    public function setEnabled($enabled);
}
