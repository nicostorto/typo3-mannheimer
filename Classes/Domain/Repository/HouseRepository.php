<?php
namespace Mtm\MtmFertighausweltIntegration\Domain\Repository;


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
 * The repository for Houses
 */
class HouseRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

    // Example for a function setup changing query settings
    /**
     * @param $customStoragePid
     */
	public function findAllHouses($customStoragePid) {

		$query = $this->createQuery();
		// add the pid constraint
		$query->getQuerySettings()->setRespectStoragePage(TRUE);
		$query->getQuerySettings()->setStoragePageIds(array($customStoragePid));
		// the same functions as shown in initializeObject can be applied.
		return $query->execute()->toArray();
	}

    /**
     * @param $customStoragePid
     * @param $manufacturerID
     */
	public function findByManufacturer($customStoragePid, $manufacturerID) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(TRUE);
		$query->getQuerySettings()->setStoragePageIds(array($customStoragePid));
		$query->matching($query->equals('house_manufacturer', $manufacturerID));
		return $query->execute()->toArray();

	}
}
