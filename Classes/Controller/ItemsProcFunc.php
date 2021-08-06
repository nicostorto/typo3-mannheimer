<?php
namespace Mtm\MtmFertighausweltIntegration\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ItemsProcFunc
 */

class ItemsProcFunc {
	/**
	 * @var object
	 */
	private $objectManager;

	private $manufacturerRepository;

	/**
	 * action select
	 *
	 * @return array
	 */
	public function select(array &$config) {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->manufacturerRepository = $this->objectManager->get('Mtm\MtmFertighausweltIntegration\Domain\Repository\ManufacturerRepository');

		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump();

		$data = $this->manufacturerRepository->findAllManufacturer('325');

		foreach($data as $key => $value){
			$config['items'][] = array(
				$value->getManufacturerName(),
				$value->getUid()
			);
		}

		return $config;
	}
	

}