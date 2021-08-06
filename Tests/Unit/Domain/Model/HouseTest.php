<?php
namespace Mtm\MtmFertighausweltIntegration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Nico Storto <storto@matoma.de>
 */
class HouseTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Mtm\MtmFertighausweltIntegration\Domain\Model\House
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mtm\MtmFertighausweltIntegration\Domain\Model\House();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getHouseNumberReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getHouseNumber()
        );
    }

    /**
     * @test
     */
    public function setHouseNumberForIntSetsHouseNumber()
    {
        $this->subject->setHouseNumber(12);

        self::assertAttributeEquals(
            12,
            'houseNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHouseNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getHouseName()
        );
    }

    /**
     * @test
     */
    public function setHouseNameForStringSetsHouseName()
    {
        $this->subject->setHouseName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'houseName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHouseManufacturerReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getHouseManufacturer()
        );
    }

    /**
     * @test
     */
    public function setHouseManufacturerForIntSetsHouseManufacturer()
    {
        $this->subject->setHouseManufacturer(12);

        self::assertAttributeEquals(
            12,
            'houseManufacturer',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHouseDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getHouseDescription()
        );
    }

    /**
     * @test
     */
    public function setHouseDescriptionForStringSetsHouseDescription()
    {
        $this->subject->setHouseDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'houseDescription',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getArchitectialStyleReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getArchitectialStyle()
        );
    }

    /**
     * @test
     */
    public function setArchitectialStyleForStringSetsArchitectialStyle()
    {
        $this->subject->setArchitectialStyle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'architectialStyle',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getNumberOfRoomsReturnsInitialValueForInt()
    {
        self::assertSame(
            0,
            $this->subject->getNumberOfRooms()
        );
    }

    /**
     * @test
     */
    public function setNumberOfRoomsForIntSetsNumberOfRooms()
    {
        $this->subject->setNumberOfRooms(12);

        self::assertAttributeEquals(
            12,
            'numberOfRooms',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLivingSpaceReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLivingSpace()
        );
    }

    /**
     * @test
     */
    public function setLivingSpaceForStringSetsLivingSpace()
    {
        $this->subject->setLivingSpace('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'livingSpace',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEnergeticStandardReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEnergeticStandard()
        );
    }

    /**
     * @test
     */
    public function setEnergeticStandardForStringSetsEnergeticStandard()
    {
        $this->subject->setEnergeticStandard('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'energeticStandard',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getSliderImagesReturnsInitialValueForFileReference()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getSliderImages()
        );
    }

    /**
     * @test
     */
    public function setSliderImagesForFileReferenceSetsSliderImages()
    {
        $sliderImage = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $objectStorageHoldingExactlyOneSliderImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneSliderImages->attach($sliderImage);
        $this->subject->setSliderImages($objectStorageHoldingExactlyOneSliderImages);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneSliderImages,
            'sliderImages',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addSliderImageToObjectStorageHoldingSliderImages()
    {
        $sliderImage = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $sliderImagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $sliderImagesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($sliderImage));
        $this->inject($this->subject, 'sliderImages', $sliderImagesObjectStorageMock);

        $this->subject->addSliderImage($sliderImage);
    }

    /**
     * @test
     */
    public function removeSliderImageFromObjectStorageHoldingSliderImages()
    {
        $sliderImage = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $sliderImagesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $sliderImagesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($sliderImage));
        $this->inject($this->subject, 'sliderImages', $sliderImagesObjectStorageMock);

        $this->subject->removeSliderImage($sliderImage);
    }

    /**
     * @test
     */
    public function getLayoutBasementReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getLayoutBasement()
        );
    }

    /**
     * @test
     */
    public function setLayoutBasementForFileReferenceSetsLayoutBasement()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLayoutBasement($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'layoutBasement',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLivingSpaceBasementReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLivingSpaceBasement()
        );
    }

    /**
     * @test
     */
    public function setLivingSpaceBasementForStringSetsLivingSpaceBasement()
    {
        $this->subject->setLivingSpaceBasement('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'livingSpaceBasement',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLayoutGroundFloorReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getLayoutGroundFloor()
        );
    }

    /**
     * @test
     */
    public function setLayoutGroundFloorForFileReferenceSetsLayoutGroundFloor()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLayoutGroundFloor($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'layoutGroundFloor',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLivingSpaceGroundFloorReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLivingSpaceGroundFloor()
        );
    }

    /**
     * @test
     */
    public function setLivingSpaceGroundFloorForStringSetsLivingSpaceGroundFloor()
    {
        $this->subject->setLivingSpaceGroundFloor('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'livingSpaceGroundFloor',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLayoutUpstairsReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getLayoutUpstairs()
        );
    }

    /**
     * @test
     */
    public function setLayoutUpstairsForFileReferenceSetsLayoutUpstairs()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLayoutUpstairs($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'layoutUpstairs',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLivingSpaceUpstairsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLivingSpaceUpstairs()
        );
    }

    /**
     * @test
     */
    public function setLivingSpaceUpstairsForStringSetsLivingSpaceUpstairs()
    {
        $this->subject->setLivingSpaceUpstairs('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'livingSpaceUpstairs',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLayoutAtticReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getLayoutAttic()
        );
    }

    /**
     * @test
     */
    public function setLayoutAtticForFileReferenceSetsLayoutAttic()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setLayoutAttic($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'layoutAttic',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLivingSpaceAtticReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLivingSpaceAttic()
        );
    }

    /**
     * @test
     */
    public function setLivingSpaceAtticForStringSetsLivingSpaceAttic()
    {
        $this->subject->setLivingSpaceAttic('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'livingSpaceAttic',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getContactDataReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getContactData()
        );
    }

    /**
     * @test
     */
    public function setContactDataForStringSetsContactData()
    {
        $this->subject->setContactData('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'contactData',
            $this->subject
        );
    }
}
