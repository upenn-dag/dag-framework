<?php
namespace DAG\Bundle\ResourceBundle\Import;

/**
 * Persister Interface
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Event\ImportEvent;

interface PersisterInterface
{
	public function persist(ImportEvent $event);
}