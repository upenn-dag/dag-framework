<?php
namespace DAG\Bundle\ResourceBundle\Import;

/**
 * Import Initializer
 *
 * @author Dylan Pierce <piercedy@upenn.edu>
 */
use DAG\Bundle\ResourceBundle\Event\ImportEvent;

class Initializer implements InitializerInterface
{
	/**
     * Initialize the import object.
     *
     * Figure out criteria to use...
     *
     * @param ImportEvent $event
     */
    public function initialize(ImportEvent $event)
    {
        $import = $event->getImport();
        $history = $event->getHistory();
        $importer = $event->getImporter();
        $criteria = array();

        if (empty($history)) {
            $criteria = $importer->getDefaultCriteria();
        }

        if (empty($criteria)) {
            $criteria = $importer->getCriteria($history);
        }

        $import->setImporter($importer->getName());
        $import->setCriteria($criteria);
    }

}