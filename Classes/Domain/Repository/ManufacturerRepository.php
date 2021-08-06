<?php
namespace Mtm\MtmFertighausweltIntegration\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/***
 *
 * This file is part of the "Fertighauswelt Integration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Nico Storto <storto@matoma.de>, Matoma GmbH
 *
 ***/
/**
 * The repository for Manufacturers
 */
class ManufacturerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => QueryInterface::ORDER_ASCENDING];

    // Example for a function setup changing query settings
    /**
     * @param $customStoragePid
     */
	public function findAllManufacturer($customStoragePid) {

		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\Extbase\\Object\\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		$extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$storagePid = $extbaseFrameworkConfiguration;

		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($storagePid);

		$query = $this->createQuery();
		// add the pid constraint
		$query->getQuerySettings()->setRespectStoragePage(TRUE);
		$query->getQuerySettings()->setStoragePageIds(array($customStoragePid));
		// the same functions as shown in initializeObject can be applied.
		return $query->execute()->toArray();
	}
}
