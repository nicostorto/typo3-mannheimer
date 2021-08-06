<?php
namespace Mtm\MtmFertighausweltIntegration\Domain\Model;


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
 * House
 */
class House extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * houseNumber
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $houseNumber = '';

    /**
     * houseName
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $houseName = '';

    /**
     * houseManufacturer
     * 
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $houseManufacturer = null;

    /**
     * houseDescription
     * 
     * @var string
     */
    protected $houseDescription = '';

    /**
     * architectialStyle
     * 
     * @var string
     */
    protected $architectialStyle = '';

    /**
     * numberOfRooms
     * 
     * @var int
     */
    protected $numberOfRooms = 0;

    /**
     * livingSpace
     * 
     * @var string
     */
    protected $livingSpace = 0;

    /**
     * energeticStandard
     * 
     * @var string
     */
    protected $energeticStandard = '';

    /**
     * sliderImages
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $sliderImages = NULL;

    /**
     * layoutBasement
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $layoutBasement = null;

    /**
     * livingSpaceBasement
     * 
     * @var string
     */
    protected $livingSpaceBasement = 0;

    /**
     * layoutGroundFloor
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $layoutGroundFloor = null;

    /**
     * livingSpaceGroundFloor
     * 
     * @var string
     */
    protected $livingSpaceGroundFloor = 0;

    /**
     * layoutUpstairs
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $layoutUpstairs = null;

    /**
     * livingSpaceUpstairs
     * 
     * @var string
     */
    protected $livingSpaceUpstairs = 0;

    /**
     * layoutAttic
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $layoutAttic = null;

    /**
     * livingSpaceAttic
     * 
     * @var string
     */
    protected $livingSpaceAttic = 0;

    /**
     * contactData
     * 
     * @var string
     */
    protected $contactData = '';

	/**
	 * youtubeData
	 *
	 * @var string
	 */
	protected $youtubeData = '';

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->sliderImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the houseName
     * 
     * @return string $houseName
     */
    public function getHouseName()
    {
        return $this->houseName;
    }

    /**
     * Sets the houseName
     * 
     * @param string $houseName
     * @return void
     */
    public function setHouseName($houseName)
    {
        $this->houseName = $houseName;
    }

    /**
     * Returns the houseDescription
     * 
     * @return string $houseDescription
     */
    public function getHouseDescription()
    {
        return $this->houseDescription;
    }

    /**
     * Sets the houseDescription
     * 
     * @param string $houseDescription
     * @return void
     */
    public function setHouseDescription($houseDescription)
    {
        $this->houseDescription = $houseDescription;
    }

    /**
     * Returns the architectialStyle
     * 
     * @return string $architectialStyle
     */
    public function getArchitectialStyle()
    {
        return $this->architectialStyle;
    }

    /**
     * Sets the architectialStyle
     * 
     * @param string $architectialStyle
     * @return void
     */
    public function setArchitectialStyle($architectialStyle)
    {
        $this->architectialStyle = $architectialStyle;
    }

    /**
     * Returns the numberOfRooms
     * 
     * @return int $numberOfRooms
     */
    public function getNumberOfRooms()
    {
        return $this->numberOfRooms;
    }

	/**
	 * Sets the numberOfRooms
	 *
	 * @param int $numberOfRooms
	 *
	 * @return void
	 */
    public function setNumberOfRooms( int $numberOfRooms)
    {
        $this->numberOfRooms = $numberOfRooms;
    }

    /**
     * Returns the energeticStandard
     * 
     * @return string $energeticStandard
     */
    public function getEnergeticStandard()
    {
        return $this->energeticStandard;
    }

	/**
	 * Sets the energeticStandard
	 *
	 * @param string $energeticStandard
	 *
	 * @return void
	 */
    public function setEnergeticStandard( string $energeticStandard)
    {
        $this->energeticStandard = $energeticStandard;
    }

    /**
     * Returns the layoutBasement
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutBasement
     */
    public function getLayoutBasement()
    {
        return $this->layoutBasement;
    }

    /**
     * Sets the layoutBasement
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutBasement
     * @return void
     */
    public function setLayoutBasement( \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutBasement)
    {
        $this->layoutBasement = $layoutBasement;
    }

    /**
     * Returns the layoutGroundFloor
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutGroundFloor
     */
    public function getLayoutGroundFloor()
    {
        return $this->layoutGroundFloor;
    }

    /**
     * Sets the layoutGroundFloor
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutGroundFloor
     * @return void
     */
    public function setLayoutGroundFloor( \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutGroundFloor)
    {
        $this->layoutGroundFloor = $layoutGroundFloor;
    }

    /**
     * Returns the layoutUpstairs
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutUpstairs
     */
    public function getLayoutUpstairs()
    {
        return $this->layoutUpstairs;
    }

    /**
     * Sets the layoutUpstairs
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutUpstairs
     * @return void
     */
    public function setLayoutUpstairs( \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutUpstairs)
    {
        $this->layoutUpstairs = $layoutUpstairs;
    }

    /**
     * Returns the layoutAttic
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutAttic
     */
    public function getLayoutAttic()
    {
        return $this->layoutAttic;
    }

    /**
     * Sets the layoutAttic
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutAttic
     * @return void
     */
    public function setLayoutAttic( \TYPO3\CMS\Extbase\Domain\Model\FileReference $layoutAttic)
    {
        $this->layoutAttic = $layoutAttic;
    }

    /**
     * Returns the houseNumber
     * 
     * @return string houseNumber
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

	/**
	 * Sets the houseNumber
	 *
	 * @param string $houseNumber
	 *
	 * @return void
	 */
    public function setHouseNumber( string $houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * Returns the livingSpace
     * 
     * @return string livingSpace
     */
    public function getLivingSpace()
    {
        return $this->livingSpace;
    }

	/**
	 * Sets the livingSpace
	 *
	 * @param int $livingSpace
	 *
	 * @return void
	 */
    public function setLivingSpace( int $livingSpace)
    {
        $this->livingSpace = $livingSpace;
    }

    /**
     * Returns the livingSpaceBasement
     * 
     * @return string livingSpaceBasement
     */
    public function getLivingSpaceBasement()
    {
        return $this->livingSpaceBasement;
    }

	/**
	 * Sets the livingSpaceBasement
	 *
	 * @param int $livingSpaceBasement
	 *
	 * @return void
	 */
    public function setLivingSpaceBasement( int $livingSpaceBasement)
    {
        $this->livingSpaceBasement = $livingSpaceBasement;
    }

    /**
     * Returns the livingSpaceGroundFloor
     * 
     * @return string livingSpaceGroundFloor
     */
    public function getLivingSpaceGroundFloor()
    {
        return $this->livingSpaceGroundFloor;
    }

	/**
	 * Sets the livingSpaceGroundFloor
	 *
	 * @param int $livingSpaceGroundFloor
	 *
	 * @return void
	 */
    public function setLivingSpaceGroundFloor( int $livingSpaceGroundFloor)
    {
        $this->livingSpaceGroundFloor = $livingSpaceGroundFloor;
    }

    /**
     * Returns the livingSpaceUpstairs
     * 
     * @return string livingSpaceUpstairs
     */
    public function getLivingSpaceUpstairs()
    {
        return $this->livingSpaceUpstairs;
    }

	/**
	 * Sets the livingSpaceUpstairs
	 *
	 * @param int $livingSpaceUpstairs
	 *
	 * @return void
	 */
    public function setLivingSpaceUpstairs( int $livingSpaceUpstairs)
    {
        $this->livingSpaceUpstairs = $livingSpaceUpstairs;
    }

    /**
     * Returns the livingSpaceAttic
     * 
     * @return string livingSpaceAttic
     */
    public function getLivingSpaceAttic()
    {
        return $this->livingSpaceAttic;
    }

	/**
	 * Sets the livingSpaceAttic
	 *
	 * @param int $livingSpaceAttic
	 *
	 * @return void
	 */
    public function setLivingSpaceAttic( int $livingSpaceAttic)
    {
        $this->livingSpaceAttic = $livingSpaceAttic;
    }

    /**
     * Returns the sliderImages
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $sliderImages
     */
    public function getSliderImages()
    {
        return $this->sliderImages;
    }

    /**
     * Sets the sliderImages
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $sliderImages
     * @return void
     */
    public function setSliderImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $sliderImages)
    {
        $this->sliderImages = $sliderImages;
    }

    /**
     * Returns the houseManufacturer
     *
     * @return int houseManufacturer
     */
    public function getHouseManufacturer()
    {
        return $this->houseManufacturer;
    }

    /**
     * Sets the houseManufacturer
     *
     * @param \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $houseManufacturer
     * @return void
     */
    public function setHouseManufacturer(\Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer $houseManufacturer)
    {
        $this->houseManufacturer = $houseManufacturer;
    }

    /**
     * Returns the contactData
     * 
     * @return string $contactData
     */
    public function getContactData()
    {
        return $this->contactData;
    }

    /**
     * Sets the contactData
     * 
     * @param string $contactData
     * @return void
     */
    public function setContactData($contactData)
    {
        $this->contactData = $contactData;
    }

	/**
	 * Returns the youtubeData
	 *
	 * @return string $youtubeData
	 */
	public function getYoutubeData()
	{
		return $this->youtubeData;
	}

	/**
	 * Sets the youtubeData
	 *
	 * @param string $youtubeData
	 * @return void
	 */
	public function setYoutubeData($youtubeData)
	{
		$this->youtubeData = $youtubeData;
	}
}
