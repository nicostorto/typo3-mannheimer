<?php
namespace Mtm\MtmFertighausweltIntegration\Controller;


use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ImagemapController  extends ActionController {

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
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {
		$houses = $this->houseRepository->findAllHouses($this->settings['Stammordner']);

		foreach($houses as $house){
			if(!empty($house->getHouseManufacturer())){
				$Manufacturer = $this->manufacturerRepository->findByUid($house->getHouseManufacturer());
				if (!empty($Manufacturer)){
		            $houseManufacturer[$house->getHouseNumber()] = $Manufacturer->getManufacturerName();
	            } else{
		            $Manufacturer = "";
	            }
			}
		}

		$this->view->assign('houses', $houses);
		$this->view->assign('housesManufacturer', $houseManufacturer);
	}
}