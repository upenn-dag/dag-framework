<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\OptionBundle\Controller;

use Symfony\Component\Routing\Exception\RouteNotFoundException;
use DAG\Bundle\ResourceBundle\Controller\ResourceController;
use DAG\Component\Option\Provider\OptionProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Option controller.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class OptionController extends ResourceController
{
    /**
     * Forwards you to named option update.
     *
     * @param Request $request
     * @param string $name
     */
    public function redirectNameAction(Request $request, $name)
    {
        if (!$route = $this->config->getRedirectRoute(null)) {
            throw new RouteNotFoundException('Option redirect route must be configured with _dag.redirect parameter.');
        }

        $option = $this->getOptionProvider()->getOptionByName($name);

        return $this->redirect($this->generateUrl($route, array('id' => $option->getId())));
    }

    /**
     * Get option repository.
     *
     * @return OptionProviderInterface
     */
    private function getOptionProvider()
    {
        return $this->get('dag.provider.option');
    }
}
