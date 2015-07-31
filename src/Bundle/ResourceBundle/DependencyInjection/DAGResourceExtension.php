<?php

/**
 * This file is part of The DAG Framework package.
 *
 * (c) University of Pennsylvania
 *
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
namespace DAG\Bundle\ResourceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use DAG\Bundle\ResourceBundle\DependencyInjection\Driver\DatabaseDriverFactory;

/**
 * DAG resource bundle extension.
 *
 * @author Frank Bardon Jr. <bardonf@upenn.edu>
 */
class DAGResourceExtension extends AbstractResourceExtension
{
    /**
     * {@inheritdoc}
     */
    protected $configFiles = array('services', 'twig');

    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $this->configure($config, new Configuration(), $container, self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS | self::CONFIGURE_VALIDATORS);

        $this->addClassesToCompile(array(
            'DAG\\Component\\Resource\\Model\\ResourceInterface',
            'DAG\\Component\\Resource\\Provider\\ProviderInterface',
            'DAG\\Component\\Resource\\Repository\\RepositoryInterface',
            'DAG\\Component\\Resource\\Model\\UserInterface',
            'DAG\\Component\\Resource\\Model\\User',
        ));
    }
}
