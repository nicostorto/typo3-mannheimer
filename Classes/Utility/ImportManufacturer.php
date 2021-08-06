<?php
namespace Mtm\MtmFertighausweltIntegration\Utility;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use Mtm\MtmFertighausweltIntegration\Domain\Model;
use Mtm\MtmFertighausweltIntegration\Domain\Repository;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

class ImportManufacturer extends ApiBaseRequests{

	public function __construct() {
		$this->mysqli = new \mysqli('localhost', 'dbu_mannheimer', 'T)t^iV4_w%@3M#+C', 'db_mannheimer');

		if($this->mysqli->connect_error){
			echo 'Die Verbindung zur Datenbank ist fehlgeschlagen...' . 'Error: ' . $this->mysqli->connect_errno . ' ' . $this->mysqli->connect_error;
			exit;
		} else {
			$this->mysqli->set_charset('utf-8');
		}
	}

	public function saveManufacturerLogo($manufacturerData, $manufacturerId) {

		$logoUrl = $manufacturerData["logo"]["src"];

		$absoluteImageStoragePath = '/var/www/vhosts/mannheimer.betacenter.net/httpdocs/fileadmin/data/sites/' . $GLOBALS["TSFE"]->rootLine[0]["title"] . '/Fertighaeuser/Importiert/Anbieterlogos/';
		$tempDir = '/var/www/vhosts/mannheimer.betacenter.net/httpdocs/fileadmin/data/sites/' . $GLOBALS["TSFE"]->rootLine[0]["title"] . '/Fertighaeuser/temp/';
		if (!is_dir($tempDir)) {
			mkdir( $tempDir, 0755, true );
		}

		if (!file_exists($absoluteImageStoragePath)) {
			mkdir($absoluteImageStoragePath, 0755, true);
		}

		$imageName = explode("/", $logoUrl);
		$imageName[4] = str_replace('%20', '_', $imageName[4]);

		$fp = fopen ($tempDir . $imageName[4], 'w+'); // open file handle
		if($fp === false){
			throw new Exception('Could not open: ' . $imageName[4]);
		}

		$ch = curl_init($logoUrl);

		//Required to be false
		curl_setopt($ch, CURLOPT_HEADER, 0);

		//Required to be true
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);

		curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

		curl_exec($ch);

		curl_close($ch); // closing curl handle
		fclose($fp);

		//Store the Image in the filestorage and make it accessable
		$resourceFactory = ResourceFactory::getInstance();

		//DFC Storage
		//$storage = $resourceFactory->getStorageObject(2);
		//Hausbaupark Storage
		$storage = $resourceFactory->getStorageObject(3);

		$newFile = $storage->addFile(
			$tempDir . $imageName[4],
			$storage->getFolder('Anbieterlogos/'),
			$imageName[4]
		);

		echo "Bild " . $imageName[4] . " importiert (uid " . $newFile->getUid() . ")</br>";

		$contentElement = BackendUtility::getRecord(
			'tx_mtmfertighausweltintegration_domain_model_manufacturer',
			(int)$manufacturerId
		);

		$newID = $newFile->getUid();
		$data = [];
		$data['sys_file_reference']['manufacturer_logo'] = [
			'table_local' => 'sys_file',
			'uid_local' => $newID,
			'tablenames' => 'tx_mtmfertighausweltintegration_domain_model_manufacturer',
			'uid_foreign' => $contentElement['uid'],
			'fieldname' => 'manufacturer_logo',
			'pid' => $contentElement['pid']
		];

		//debug($data);
		//continue;

		// Get an instance of the DataHandler and process the data
		/** @var DataHandler $dataHandler */
		$dataHandler = GeneralUtility::makeInstance( DataHandler::class);
		$dataHandler->start($data, []);
		$dataHandler->process_datamap();

		echo "</br> Bild " . $newID . " zu Feld \"manufacturer_logo\" zugewiesen!";

	}

	public function createManufacturer($pid, $manufacturerData) {

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$ManufacturerRepository = $objectManager->get(Repository\ManufacturerRepository::class);

		$manufacturer = new Model\Manufacturer();

		//Modify Name to display without Slogan && trim spacings
		$manufacturerData['name'] = explode('|', $manufacturerData['name'])[0];
		$manufacturerData['name'] = trim($manufacturerData['name']);

		$manufacturer->setManufacturerName($manufacturerData['name']);
		$manufacturer->setManufacturerSlogan($manufacturerData['headline']);
		$manufacturer->setDescription($manufacturerData['text']);

		$manufacturer->setEmail($manufacturerData['eMailAdresse']);
		$manufacturer->setPhone($manufacturerData['telefonnummer']);
		$manufacturer->setFax($manufacturerData['telefaxnummer']);
		$manufacturer->setWebsite($manufacturerData['website']);

		$manufacturer->setStrasse($manufacturerData['adresse']['strasse']);
		$manufacturer->setPlz($manufacturerData['adresse']['plz']);
		$manufacturer->setOrt($manufacturerData['adresse']['ort']);

		$manufacturer->setPid($pid);

		$ManufacturerRepository->add($manufacturer);
		$objectManager->get(PersistenceManagerInterface::class)->persistAll();

		$manufacturerId = $manufacturer->getUid();

		echo "Hersteller ID " . $manufacturerId . "</br>";
		echo $manufacturerData["name"] . "hinzugefügt!";

		return $manufacturerId;
	}

	public function checkForChanges($localManufacturer, $apiManufacturer){

		//Modify Name to display without Slogan && trim spacings
		$apiManufacturer['name'] = explode('|', $apiManufacturer['name'])[0];
		$apiManufacturer['name'] = trim($apiManufacturer['name']);


		if ($localManufacturer->getManufacturerName() != $apiManufacturer['name']){
			echo "name sind nicht gleich!";
			$localManufacturer->setManufacturerName($apiManufacturer['name']);
		}
		if ($localManufacturer->getManufacturerSlogan() != $apiManufacturer['headline']){
			echo "headline sind nicht gleich!";
			$localManufacturer->setManufacturerSlogan($apiManufacturer['headline']);
		}
		if ($localManufacturer->getDescription() != $apiManufacturer['text']){
			echo "text sind nicht gleich!";
			$localManufacturer->setDescription($apiManufacturer['text']);
		}
		if ($localManufacturer->getEmail() != $apiManufacturer['eMailAdresse']){
			echo "eMailAdresse sind nicht gleich!";
			$localManufacturer->setEmail($apiManufacturer['eMailAdresse']);
		}
		if ($localManufacturer->getPhone() != $apiManufacturer['telefonnummer']){
			echo "telefonnummer sind nicht gleich!";
			$localManufacturer->setPhone($apiManufacturer['telefonnummer']);
		}
		if ($localManufacturer->getFax() != $apiManufacturer['telefaxnummer']){
			echo "telefaxnummer sind nicht gleich!";
			$localManufacturer->setFax($apiManufacturer['telefaxnummer']);
		}
		if ($localManufacturer->getWebsite() != $apiManufacturer['website']){
			echo "website sind nicht gleich!";
			$localManufacturer->setWebsite($apiManufacturer['website']);
		}
		if ($localManufacturer->getStrasse() != $apiManufacturer['adresse']['strasse']){
			echo "strasse sind nicht gleich!";
			$localManufacturer->setStrasse($apiManufacturer['adresse']['strasse']);
		}
		if ($localManufacturer->getPlz() != $apiManufacturer['adresse']['plz']){
			echo "plz sind nicht gleich!";
			$localManufacturer->setPlz($apiManufacturer['adresse']['plz']);
		}
		if ($localManufacturer->getOrt() != $apiManufacturer['adresse']['ort']){
			echo "ort sind nicht gleich!";
			$localManufacturer->setOrt($apiManufacturer['adresse']['ort']);
		}

		return $localManufacturer;
	}

}