<?php
namespace Mtm\MtmFertighausweltIntegration\Tasks;

use Mtm\MtmFertighausweltIntegration\Controller\HouseController;
use Mtm\MtmFertighausweltIntegration\Controller\ManufacturerController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;


class UpdateDataFromFHW extends AbstractTask {

	/**
	 * An email address to be used during the process
	 *
	 * @var string $email
	 */
	public $email;

	/**
	 * Function executed from the Scheduler.
	 * Sends an email
	 *
	 * @return bool
	 */
	public function execute() {
		//Create an Instance from ConnectionPool to communicate with the Typo3 Database
		$HouseUpdate = GeneralUtility::makeInstance( HouseController::class)->syncAction();
		$ManufacturerUpdate = GeneralUtility::makeInstance( ManufacturerController::class)->syncAction();

		if($HouseUpdate && $ManufacturerUpdate){
			$success = true;
		} else{
			$success = false;
		}

		return $success;
	}
}