<?php
namespace Mtm\MtmFertighausweltIntegration\Controller;

use Mtm\MtmFertighausweltIntegration\Domain\Session\SessionHandler;
use Mtm\MtmFertighausweltIntegration\Utility\ApiBaseRequests;
use Mtm\MtmFertighausweltIntegration\Utility\ImportHouses;
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
 * HouseController
 */
class HouseController extends ActionController
{

    /**
     * Frontend- or Backend-Session
     * The type of session is set automatically in initializeAction().
     * 
     * @var \Mtm\MtmFertighausweltIntegration\Domain\Session\SessionHandler
     */
    protected $session = null;

    /**
     * houseRepository
     * 
     * @var \Mtm\MtmFertighausweltIntegration\Domain\Repository\HouseRepository
     * @inject
     */
    protected $houseRepository = null;

    /**
     * manufacturerRepository
     * 
     * @var \Mtm\MtmFertighausweltIntegration\Domain\Repository\ManufacturerRepository
     * @inject
     */
    protected $manufacturerRepository = null;

    /**
     * action initialize
     * 
     * @return void
     */
    public function initializeAction()
    {

        //create a new Session
        $this->session = new SessionHandler(TYPO3_MODE);

        //set SessionKey
        $this->session->setStorageKey($this->request->getControllerExtensionName() . 'Requestlist');
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $houses = $this->houseRepository->findAllHouses($this->settings['Stammordner']);
        foreach ($houses as $house) {
            if (!empty($house->getHouseManufacturer())) {
                $Manufacturer = $this->manufacturerRepository->findByUid($house->getHouseManufacturer());
	            if (!empty($Manufacturer)){
		            $houseManufacturer[$house->getHouseNumber()] = $Manufacturer->getManufacturerName();
	            } else{
		            $Manufacturer = "";
	            }
            }
        }

        //Das Ergebnis nach den Hausnummern sortieren
        $number = array();
        foreach ($houses as $key => $val) {
            $number[$key] = $val->getHouseNumber();
        }
        array_multisort($number, SORT_NATURAL, $houses);
        $this->view->assign('houses', $houses);
        $this->view->assign('housesManufacturer', $houseManufacturer);
    }

    /**
     * action show
     * 
     * @return void
     */
    public function showAction()
    {
        $Uid = $this->request->getArgument('id');
        $sessionData = $this->session->get($this->request->getControllerExtensionName() . 'Requestlist');
        $sessionArray = json_decode($sessionData, true);

        // Check if House is already on the Requestlist
        if (is_array($sessionArray) && array_key_exists($Uid, $sessionArray)) {
            $onRequestList = true;
        } else {
            $onRequestList = false;
        }
        if ($this->request->hasArgument('RequestListMessage')) {
            $RequestListMessage = $this->request->getArgument('RequestListMessage');
        }
        $house = $this->houseRepository->findByUid($Uid);
        $houseManufacturer = $this->manufacturerRepository->findByUid($house->getHouseManufacturer());
        if ($house->getHouseNumber() < 10) {
            $houseNumber = '0' . $house->getHouseNumber();
        } else {
            $houseNumber = $house->getHouseNumber();
        }

        //Check if house has V-Tour
        $url = 'https://' . $_SERVER['SERVER_NAME'] . '/fileadmin/data/sites/' . $GLOBALS["TSFE"]->rootLine[0]["title"] . '/v-rundgang/haeuser/' . $houseNumber;
        $requestHeaders = get_headers($url, 1);
        if (array_key_exists("Location", $requestHeaders)) {
            $vtour = $url;
        }
        $this->view->assign('house', $house);
        $this->view->assign('vtour', $vtour);
        $this->view->assign('requestlistmessage', $RequestListMessage);
        $this->view->assign('onRequestList', $onRequestList);
        $this->view->assign('manufacturer', $houseManufacturer);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\House $newHouse
     * @return void
     */
    public function createAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\House $newHouse)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->houseRepository->add($newHouse);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\House $house
     * @ignorevalidation $house
     * @return void
     */
    public function editAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\House $house)
    {
        $this->view->assign('house', $house);
    }

    /**
     * action update
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\House $house
     * @return void
     */
    public function updateAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\House $house)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->houseRepository->update($house);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\House $house
     * @return void
     */
    public function deleteAction(\Mtm\MtmFertighausweltIntegration\Domain\Model\House $house)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->houseRepository->remove($house);
        $this->redirect('list');
    }

    /**
     * action slider
     * 
     * @return void
     */
    public function sliderAction()
    {
        $houses = $this->houseRepository->findAllHouses($this->settings['Stammordner']);

        //Das Ergebnis nach den Hausnummern sortieren
        $number = array();
        foreach ($houses as $key => $val) {
            $number[$key] = $val->getHouseNumber();
        }
        array_multisort($number, SORT_NATURAL, $houses);
        
        $this->view->assign('houses', $houses);
    }

    /**
     * action sync
     * 
     * @return void
     */
    public function syncAction()
    {
        $Api = new ApiBaseRequests($this->settings['API-AuthString']);
        $ApiHouses = $Api->getAllHouses();
        foreach ($ApiHouses as $house) {
            $ExistingHouses = $this->houseRepository->findAllHouses($this->settings['Stammordner']);
            $checkAgainstHouses = array();
            foreach ($ExistingHouses as $loadedHouses) {
                $checkAgainstHouses[] = $loadedHouses->getHouseNumber();
            }

            if (array_search($house['parzelle'], $checkAgainstHouses) == TRUE) {

                //Haus kann geskipt werden, da er schon importiert ist!
	            $Updater = new ImportHouses();

	            //Get the local stored House
	            $localHouse = $this->houseRepository->findByHouseNumber($house['parzelle'])[0];

	            //Check for Changes
	            $changedHouse = $Updater->checkForChanges($localHouse, $house);

	            $this->houseRepository->update($changedHouse);

                continue;
            } else {

                //Importer initialisieren
                $Importer = new ImportHouses();

                //Haus Datensatz anhand des Models erstellen
                $houseId = $Importer->createHouse($this->settings['Stammordner'], $house);

                //Haus Bilder in FileSystem abspeichern
                $Images = $Importer->saveAllImagesFromHouse($house);

                // Haus Bilder zu Datensatz matchen
                $Importer->matchImages($houseId, $Images);
                continue;
            }
        }
        $this->addFlashMessage(
        "Es wurden alle Fertighäuser erfolgreich abgeglichen.", 
        $messageTitle = 'Fertighaus Synchronisation erfolgreich', 
        $severity = AbstractMessage::OK, 
        $storeInSession = TRUE
        );
        $this->redirect('list');
    }
}
