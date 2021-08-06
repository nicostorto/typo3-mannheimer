<?php
namespace Mtm\MtmFertighausweltIntegration\Controller;

use Mtm\MtmFertighausweltIntegration\Utility\ApiBaseRequests;
use Mtm\MtmFertighausweltIntegration\Utility\ImportManufacturer;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

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
 * ManufacturerController
 */
class ManufacturerController extends ActionController
{

	/**
	 * manufacturerRepository
	 *
	 * @var \Mtm\MtmFertighausweltIntegration\Domain\Repository\ManufacturerRepository
	 *
	 */
    protected $manufacturerRepository = null;

	/**
	 * houseRepository
	 *
	 * @var \Mtm\MtmFertighausweltIntegration\Domain\Repository\HouseRepository
	 * @inject
	 */
	protected $houseRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction() {
        $manufacturers = $this->manufacturerRepository->findAllManufacturer($this->settings['Stammordner']);

	    $alphabetical = array();
	    foreach($manufacturers as $key => $val) {
		    $alphabetical[$key] = $val->getManufacturerName();
	    }
	    array_multisort($alphabetical, SORT_ASC, $manufacturers);

        $this->view->assign('manufacturers', $manufacturers);
    }

    /**
     * action show
     *
     * @return void
     */
    public function showAction() {
	    $Uid = $this->request->getArgument('id');

	    // Get the requested Manufacturer
	    $manufacturer = $this->manufacturerRepository->findByUid($Uid);
	    // Get all Houses related to this Manufacturer
		$houses = $this->houseRepository->findByManufacturer($this->settings['Stammordner'], $Uid);

        $this->view->assign('manufacturer', $manufacturer);
        $this->view->assign('houses', $houses);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction() {
    }

    /**
     * action create
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $newManufacturer
     * @return void
     */
    public function createAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $newManufacturer) {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->manufacturerRepository->add($newManufacturer);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $manufacturer
     * @ignorevalidation $manufacturer
     * @return void
     */
    public function editAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $manufacturer) {
        $this->view->assign('manufacturer', $manufacturer);
    }

    /**
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Repository\ManufacturerRepository $manufacturerRepository
     */
	public function injectManufacturerRepository( \Mtm\MtmFertighausweltIntegration\Domain\Repository\ManufacturerRepository $manufacturerRepository ) {
		$this->manufacturerRepository = $manufacturerRepository;
	}

	/**
     * action update
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $manufacturer
     * @return void
     */
    public function updateAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $manufacturer) {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->manufacturerRepository->update($manufacturer);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $manufacturer
     * @return void
     */
    public function deleteAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $manufacturer) {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->manufacturerRepository->remove($manufacturer);
        $this->redirect('list');
    }

    /**
     * action slider
     * 
     * @return void
     */
    public function sliderAction() {
	    $manufacturers = $this->manufacturerRepository->findAll($this->settings['Stammordner']);
	    $this->view->assign('manufacturers', $manufacturers);
    }

    /**
     * action sync
     * 
     * @return void
     */
    public function syncAction() {

	    $Api = new ApiBaseRequests($this->settings['API-AuthString']);
	    $ApiManufacturer = $Api->getAllManufacturer();

		foreach($ApiManufacturer as $manufacturer){
			$manufacturerCheck = explode('|', $manufacturer['name'])[0];
			$manufacturerCheck = trim($manufacturerCheck);

			//Get everytime the existing Manufacturer
			$ExistingManufacturer = $this->manufacturerRepository->findAllManufacturer($this->settings['Stammordner']);
			$checkAgainstManufacturers = array();
			foreach($ExistingManufacturer as $loadedManufacturer){
				$checkAgainstManufacturers[] = $loadedManufacturer->getManufacturerName();
			}

			/* DEBUG STATEMENTS
			\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($manufacturerCheck);
			\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($checkAgainstManufacturers);
			die();*/


			if(array_search($manufacturerCheck, $checkAgainstManufacturers) == TRUE){
				//Anbieter kann geskipt werden, da er schon importiert ist!
				$Updater = new ImportManufacturer();

				//Get the local stored House
				$localManufacturer = $this->manufacturerRepository->findByManufacturerName($manufacturerCheck)[0];

				//Check for Changes
				$changedManufacturer = $Updater->checkForChanges($localManufacturer, $manufacturer);

				$this->manufacturerRepository->update($changedManufacturer);

				continue;
			} else {
				//Importer initialisieren
				$Importer = new ImportManufacturer();
				//Anbieter Datensatz anhand des Models erstellen
				$manufacturerId = $Importer->createManufacturer($this->settings['Stammordner'], $manufacturer);
				//Anbieter Logo in FileSystem abspeichern und dann eine Referenz zum Datensatz herstellen
				$Importer->saveManufacturerLogo($manufacturer, $manufacturerId);
				continue;
			}
		}

	    $this->addFlashMessage(
		    "Es wurden alle Anbieter erfolgreich abgeglichen.",
		    $messageTitle = 'Anbieter Synchronisation erfolgreich',
		    $severity = AbstractMessage::OK,
		    $storeInSession = TRUE
	    );
	    $this->redirect('list');
    }
}
