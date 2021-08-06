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
class ImportHouses extends ApiBaseRequests {

	//TODO: Get Database Connection from Typo3 intead off new connecction with credentials
	public function __construct() {
		$this->mysqli = new \mysqli('localhost', 'dbu_mannheimer', 'T)t^iV4_w%@3M#+C', 'db_mannheimer');

		if($this->mysqli->connect_error){
			echo 'Die Verbindung zur Datenbank ist fehlgeschlagen...' . 'Error: ' . $this->mysqli->connect_errno . ' ' . $this->mysqli->connect_error;
			exit;
		} else {
			$this->mysqli->set_charset('utf-8');
		}
	}

	public function saveAllImagesFromHouse($houseData) {
		$absoluteImageStoragePath = '/pages/51/21/d0012242/home/htdocs/fileadmin/data/sites/' . $GLOBALS["TSFE"]->rootLine[0]["title"] . '/Fertighaeuser/Importiert/' . $houseData["parzelle"] . '/';
		$tempDir = '/pages/51/21/d0012242/home/htdocs/fileadmin/data/sites/' . $GLOBALS["TSFE"]->rootLine[0]["title"] . '/Fertighaeuser/temp/' . $houseData['parzelle'] . '/';

		/*var_dump($absoluteImageStoragePath);
		var_dump($tempDir);
		var_dump($GLOBALS);
		die();*/
		if (!is_dir($tempDir)) {
			mkdir( $tempDir, 0755, true );
		}

		if (!file_exists($absoluteImageStoragePath)) {
			mkdir($absoluteImageStoragePath, 0755, true);
		}

		$imagePathsArray = array('layout_basement' => $houseData['grundriss_keller']['src'],
		                         'layout_ground_floor' => $houseData['grundriss_eg']['src'],
		                         'layout_upstairs' => $houseData['grundriss_og']['src'],
		                         'layout_attic' => $houseData['grundriss_dg']['src']);
		$imagePathsArray = array_filter($imagePathsArray);
		foreach($houseData['bilder'] as $ImageData){
			$imagePathsArray['sliderImages'][] = $ImageData['src'];
		}

		$houseFileReferenceArray = array();

		foreach($imagePathsArray as $imagePlace => $imageDownloadPath){

			if($imagePlace == 'sliderImages'){
				foreach($imageDownloadPath as $singleImage){
					$imageName = explode("/", $singleImage);
					$imageName[4] = str_replace('%20', '_', $imageName[4]);

					$fp = fopen ($tempDir . $imageName[4], 'w+'); // open file handle
					if($fp === false){
						throw new Exception('Could not open: ' . $imageName[4]);
					}

					$ch = curl_init($singleImage);

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
						$storage->getFolder($houseData['parzelle']. '/'),
						$imageName[4]
					);

					$houseFileReferenceArray[$imagePlace][] = $newFile;

					echo "Bild " . $imageName[4] . " importiert (uid " . $newFile->getUid() . ")</br>";
				}
			} else{
				$imageName = explode("/", $imageDownloadPath);
				$imageName[4] = str_replace('%20', '_', $imageName[4]);

				$fp = fopen ($tempDir . $imageName[4], 'w+'); // open file handle
				if($fp === false){
					throw new Exception('Could not open: ' . $imageName[4]);
				}

				$ch = curl_init($imageDownloadPath);

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
					$storage->getFolder($houseData['parzelle']. '/'),
					$imageName[4]
				);

				$houseFileReferenceArray[$imagePlace] = $newFile;

				echo "Bild " . $imageName[4] . " importiert (uid " . $newFile->getUid() . ")</br>";
			}
		}
		return $houseFileReferenceArray;
	}

	public function createHouse($pid, $houseData) {

		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$HouseRepository = $objectManager->get(Repository\HouseRepository::class);
		$ManufacturerRepository = $objectManager->get(Repository\ManufacturerRepository::class);

		$house = new Model\House();

		/*Modify Output*/

		//Modify Name to display without Slogan
		$houseData["hersteller"]["name"] = explode('|', $houseData["hersteller"]["name"])[0];

		//Get manufacturer
		$manufacturer = $ManufacturerRepository->findByManufacturerName($houseData["hersteller"]["name"]);
		$manufacturerObject = $manufacturer->toArray()[0];

		//Output in square meters
		$houseData["wohnflaeche_gesamt"] = number_format($houseData["wohnflaeche_gesamt"] / 10000, 2, ',', '.');
		$houseData["wohnflaeche_keller"] = number_format($houseData["wohnflaeche_keller"] / 10000, 2, ',', '.');
		$houseData["wohnflaeche_eg"] = number_format($houseData["wohnflaeche_eg"] / 10000, 2, ',', '.');
		$houseData["wohnflaeche_og"] = number_format($houseData["wohnflaeche_og"] / 10000, 2, ',', '.');
		$houseData["wohnflaeche_dg"] = number_format($houseData["wohnflaeche_dg"] / 10000, 2, ',', '.');

		//Modify Haustyp to uppercase the first Char
		$houseData["haustyp"] = ucfirst($houseData["haustyp"]);

		//Modify Output replace "_"  with " " and uppercase every first char
		$houseData["energetischer_standard"] = ucwords(str_replace('_', ' ', $houseData["energetischer_standard"]));

		$house->setHouseNumber($houseData["parzelle"]);
		$house->setHouseName($houseData["name"]);
		$house->setHouseManufacturer($manufacturerObject);
		$house->setHouseDescription($houseData["beschreibung"]);

		$house->setArchitectialStyle($houseData["haustyp"]);
		$house->setNumberOfRooms($houseData["zimmeranzahl"]);
		$house->setLivingSpace($houseData["wohnflaeche_gesamt"]);
		$house->setEnergeticStandard($houseData["energetischer_standard"]);

		$house->setLivingSpaceBasement($houseData["wohnflaeche_keller"]);
		$house->setLivingSpaceGroundFloor($houseData["wohnflaeche_eg"]);
		$house->setLivingSpaceUpstairs($houseData["wohnflaeche_og"]);
		$house->setLivingSpaceAttic($houseData["wohnflaeche_dg"]);

		$house->setPid($pid);

		$HouseRepository->add($house);
		$objectManager->get(PersistenceManagerInterface::class)->persistAll();

		$houseId = $house->getUid();

		echo "Haus ID " . $houseId . "</br>";
		echo $houseData["name"] . "hinzugefügt!";

		return $houseId;
	}

	public function matchImages($houseId, $ImageReferenceArray){
		foreach($ImageReferenceArray as $key => $fileObject){

			$contentElement = BackendUtility::getRecord(
				'tx_mtmfertighausweltintegration_domain_model_house',
				(int)$houseId
			);

			if(is_array($fileObject)){
				foreach($fileObject as $image){


					// Assemble DataHandler data
					$newID = $image->getUid();
					$data = [];
					$data['sys_file_reference'][$key] = [
						'table_local' => 'sys_file',
						'uid_local' => $newID,
						'tablenames' => 'tx_mtmfertighausweltintegration_domain_model_house',
						'uid_foreign' => $contentElement['uid'],
						'fieldname' => $key,
						'pid' => $contentElement['pid']
					];
					/*$data['tx_mtmfertighausweltintegration_domain_model_house'][$contentElement['uid']] = [
						$key => $newID
					];*/

					// Get an instance of the DataHandler and process the data
					/** @var DataHandler $dataHandler */
					$dataHandler = GeneralUtility::makeInstance( DataHandler::class);
					$dataHandler->start($data, []);
					$dataHandler->admin = true;
					$dataHandler->process_datamap();

					echo "</br> Bild " . $image->getUid() . " zu Feld " . $key . " zugewiesen!";

				}

			} else {
				// Assemble DataHandler data
				$newID = $fileObject->getUid();
				$data = [];
				$data['sys_file_reference'][$key] = [
					'table_local' => 'sys_file',
					'uid_local' => $newID,
					'tablenames' => 'tx_mtmfertighausweltintegration_domain_model_house',
					'uid_foreign' => $contentElement['uid'],
					'fieldname' => $key,
					'pid' => $contentElement['pid']
				];
				/*$data['tx_mtmfertighausweltintegration_domain_model_house'][$contentElement['uid']] = [
					$key => $newID
				];*/

				//debug($data);
				//continue;

				// Get an instance of the DataHandler and process the data
				/** @var DataHandler $dataHandler */
				$dataHandler = GeneralUtility::makeInstance( DataHandler::class);
				$dataHandler->start($data, []);
				$dataHandler->admin = true;
				$dataHandler->process_datamap();

				echo "</br> Bild " . $fileObject->getUid() . " zu Feld " . $key . " zugewiesen!";
			}
		}

		echo "</br>" . "Bilder erfolgreich zugeordnet!";
	}

	public function checkForChanges($localHouse, $apiHouse){

		//Output in square meters
		$apiHouse["wohnflaeche_gesamt"] = ($apiHouse["wohnflaeche_gesamt"] > 0 ? number_format($apiHouse["wohnflaeche_gesamt"] / 10000, 2, ',', '.') : 0);
		$apiHouse["wohnflaeche_keller"] = ($apiHouse["wohnflaeche_keller"] > 0 ? number_format($apiHouse["wohnflaeche_keller"] / 10000, 2, ',', '.') : 0);
		$apiHouse["wohnflaeche_eg"] = ($apiHouse["wohnflaeche_eg"] > 0 ? number_format($apiHouse["wohnflaeche_eg"] / 10000, 2, ',', '.') : 0);
		$apiHouse["wohnflaeche_og"] = ($apiHouse["wohnflaeche_og"] > 0 ? number_format($apiHouse["wohnflaeche_og"] / 10000, 2, ',', '.') : 0);
		$apiHouse["wohnflaeche_dg"] = ($apiHouse["wohnflaeche_dg"] > 0 ? number_format($apiHouse["wohnflaeche_dg"] / 10000, 2, ',', '.') : 0);

		//Modify Haustyp to uppercase the first Char
		$apiHouse["haustyp"] = ucfirst($apiHouse["haustyp"]);

		//Modify Output replace "_"  with " " and uppercase every first char
		$apiHouse["energetischer_standard"] = ucwords(str_replace('_', ' ', $apiHouse["energetischer_standard"]));

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($apiHouse);
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($localHouse);

		if ($localHouse->getHouseName() != $apiHouse['name']){
			echo "name sind nicht gleich!";
			$localHouse->setHouseName($apiHouse['name']);
		}
		if ($localHouse->getHouseDescription() != $apiHouse['beschreibung']){
			echo "beschreibung sind nicht gleich!";
			$localHouse->setHouseDescription($apiHouse['beschreibung']);
		}
		if ($localHouse->getArchitectialStyle() != $apiHouse['haustyp']){
			echo "hausart sind nicht gleich!";
			$localHouse->setArchitectialStyle($apiHouse['haustyp']);
		}
		if ($localHouse->getEnergeticStandard() != $apiHouse['energetischer_standard']){
			echo "energetischer_standard sind nicht gleich!";
			$localHouse->setEnergeticStandard($apiHouse['energetischer_standard']);
		}
		if ($localHouse->getNumberOfRooms() != $apiHouse['zimmeranzahl']){
			echo "zimmeranzahl sind nicht gleich!";
			$localHouse->setNumberOfRooms($apiHouse['zimmeranzahl']);
		}
		if ($localHouse->getLivingSpace() != $apiHouse['wohnflaeche_gesamt']){
			echo "wohnflaeche_gesamt sind nicht gleich!";
			$localHouse->setLivingSpace($apiHouse['wohnflaeche_gesamt']);
		}
		if ($localHouse->getLivingSpaceBasement() != $apiHouse['wohnflaeche_keller']){
			echo "wohnflaeche_keller sind nicht gleich!";
			$localHouse->setLivingSpaceBasement($apiHouse['wohnflaeche_keller']);
		}
		if ($localHouse->getLivingSpaceGroundFloor() != $apiHouse['wohnflaeche_eg']){
			echo "wohnflaeche_eg sind nicht gleich!";
			$localHouse->setLivingSpaceGroundFloor($apiHouse['wohnflaeche_eg']);
		}
		if ($localHouse->getLivingSpaceUpstairs() != $apiHouse['wohnflaeche_og']){
			echo "wohnflaeche_og sind nicht gleich!";
			$localHouse->setLivingSpaceUpstairs($apiHouse['wohnflaeche_og']);
		}
		if ($localHouse->getLivingSpaceAttic() != $apiHouse['wohnflaeche_dg']){
			echo "wohnflaeche_dg sind nicht gleich!";
			$localHouse->setLivingSpaceAttic($apiHouse['wohnflaeche_dg']);
		}

		return $localHouse;
	}

}