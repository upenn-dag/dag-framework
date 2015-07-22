<?php
namespace DAG\Bundle\ResourceBundle\Import;

/**
 * Initializer Interface
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Event\ImportEvent;

interface InitializerInterface
{
	public function initialize(ImportEvent $event);
}