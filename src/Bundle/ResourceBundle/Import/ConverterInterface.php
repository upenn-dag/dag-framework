<?php
namespace DAG\Bundle\ResourceBundle\Import;

/**
 * Converter Interface
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Event\ImportEvent;

interface ConverterInterface
{
	public function convert(ImportEvent $event);
}