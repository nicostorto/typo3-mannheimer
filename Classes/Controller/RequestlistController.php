<?php


namespace Mtm\MtmFertighausweltIntegration\Controller;


use Mtm\MtmFertighausweltIntegration\Domain\Session\SessionHandler;
use Mtm\MtmFertighausweltIntegration\Utility\MailHandling;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class RequestlistController extends ActionController {

	/**
	 * Frontend- or Backend-Session
	 * The type of session is set automatically in initializeAction().
	 *
	 * @var  \Mtm\MtmFertighausweltIntegration\Domain\Session\SessionHandler
	 */
	protected $session;

	/**
	 * manufacturerRepository
	 *
	 * @var \Mtm\MtmFertighausweltIntegration\Domain\Repository\ManufacturerRepository
	 * @inject
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
	 * action initialize
	 *
	 * @return void
	 */
	public function initializeAction() {
		//create a new Session
		$this->session = new SessionHandler(TYPO3_MODE);
		//set SessionKey
		$this->session->setStorageKey( $this->request->getControllerExtensionName() . 'Requestlist' );
	}

	/**
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {

		$sessionData = $this->session->get( $this->request->getControllerExtensionName() . 'Requestlist');
		$sessionArray = json_decode($sessionData, true);

		$storedHouses = array();

		if(is_array($sessionArray) && !empty($sessionArray)){
			foreach($sessionArray as $requestedHouse){
				$house = $this->houseRepository->findByUid($requestedHouse['houseid']);
				//$manufacturer = $this->manufacturerRepository->findByUid($requestedHouse['manufacturerid']);
				$storedHouses[] = array('house' => $house, 'manufacturer' => $requestedHouse['manufacturername']);
			}

			$this->view->assign('storedHouses', $storedHouses);
		} elseif(!empty($this->request->hasArgument('RequestSend')) && $this->request->getArgument('RequestSend') == 'succeeded'){
			$this->addFlashMessage(
				"Ihre Anfrage wurde erfolgreich an die Hersteller versendet. Diese werden Sie per E-Mail kontaktieren.",
				$messageTitle = 'Vielen Dank für Ihre Anfrage',
				$severity = AbstractMessage::OK,
				$storeInSession = TRUE
			);
		} else {
			$this->addFlashMessage(
				"Es befinden sich momentan keine Fertighäuser auf Ihrer Merkliste. Setzen Sie mindestens ein Fertighaus auf Ihre Merkliste, um eine Anfrage abzusenden.",
				$messageTitle = 'Ihre Merkliste ist leer!',
				$severity = AbstractMessage::ERROR,
				$storeInSession = TRUE
			);
		}
	}

	/**
	 * action widget
	 *
	 * @return void
	 */
	public function widgetAction() {

		$sessionData = $this->session->get( $this->request->getControllerExtensionName() . 'Requestlist');
		$sessionArray = json_decode($sessionData, true);

		if(is_array($sessionArray) && !empty($sessionArray)){
			$countStoredHouses = count($sessionArray);
			$storedHouses = array();
			foreach($sessionArray as $requestedHouse){
				$house = $this->houseRepository->findByUid($requestedHouse['houseid']);
				$storedHouses[] = array('house' => $house, 'manufacturer' => $requestedHouse['manufacturername']);
			}
		} else {
			$this->addFlashMessage(
				"Es befinden sich momentan keine Fertighäuser auf Ihrer Merkliste. Setzen Sie mindestens ein Fertighaus auf Ihre Merkliste, um eine Anfrage abzusenden.",
				$messageTitle = 'Ihre Merkliste ist leer!',
				$severity = AbstractMessage::ERROR,
				$storeInSession = FALSE
			);
			$countStoredHouses = 0;
			$storedHouses = array();
		}

		$this->view->assign('countStoredHouses', $countStoredHouses);
		$this->view->assign('storedHouses', $storedHouses);
	}

	/**
	 * action addItem
	 *
	 * @return void
	 */
	public function additemAction() {
		$Uid = $this->request->getArgument('id');

		// get the sessionData
		$sessionData = $this->session->get( $this->request->getControllerExtensionName() . 'Requestlist');
		$sessionArray = json_decode($sessionData, true);

		if($sessionArray[$Uid]){
			$this->redirect('show', 'House', $this->extensionName, array('id' => $Uid, 'RequestListMessage' => 'Haus ist bereits auf der Merkliste!'));
		} else {

			$house = $this->houseRepository->findByUid($Uid);
			$manufacturer = $this->manufacturerRepository->findByUid($house->getHouseManufacturer());

			$storeData = array('houseid' => $house->getUid(), 'housename' => $house->getHouseName(), 'manufacturerid' => $manufacturer->getUid(), 'manufacturername' => $manufacturer->getManufacturerName());

			$sessionArray[$Uid] = $storeData;
			$this->session->store( $this->request->getControllerExtensionName() . 'Requestlist',  json_encode($sessionArray));
			$this->redirect('show', 'House', $this->extensionName, array('id' => $Uid, 'RequestListMessage' => 'Fertighaus zur Merkliste hinzugefügt'));
		}
	}

	/**
	 * action removeItem
	 *
	 * @return void
	 */
	public function removeitemAction() {
		$Uid = $this->request->getArgument('id');

		// get the sessionData
		$sessionData = $this->session->get( $this->request->getControllerExtensionName() . 'Requestlist');
		$sessionArray = json_decode($sessionData, true);

		// Delete data from session
		unset($sessionArray[$Uid]);

		// Replace the sessionData with updated Array
		$this->session->store( $this->request->getControllerExtensionName() . 'Requestlist',  json_encode($sessionArray));

		$this->redirect('show');
	}

	/**
	 *  action sendRequest
	 *
	 * @return void
	 */
	public function sendrequestAction() {

		$formData = $this->request->getArguments();

		$MailHandler = new MailHandling();

		// get the sessionData
		$sessionData = $this->session->get( $this->request->getControllerExtensionName() . 'Requestlist');
		$sessionArray = json_decode($sessionData, true);

		$manufacturerRequests = array();
		foreach($sessionArray as $requestedHouse){
			$manufacturerRequests[$requestedHouse['manufacturername']]['manufacturerdata'] = $this->manufacturerRepository->findByUid($requestedHouse['manufacturerid']);
			$manufacturerRequests[$requestedHouse['manufacturername']]['housedata'][] = array('hausnumber' => $this->houseRepository->findByUid($requestedHouse['houseid'])->getHouseNumber(),'hausname' => $requestedHouse['housename']);
		}

		//$MailHandler->createContactCSV($formData);
		$MailHandler->sendManufacturerMails($formData, $manufacturerRequests);
		$MailHandler->sendOperatorMail($formData, $manufacturerRequests);

		//Clear Requestlist after sending to manufacturer and Operator
		$this->session->delete( $this->request->getControllerExtensionName() . 'Requestlist');

		$this->redirect('show', NULL, NULL, array('RequestSend' => 'succeeded'));

		/* DEBUG STATEMENTS
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($formData);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($sessionArray);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($manufacturerRequests);
		die();
		*/
	}
}