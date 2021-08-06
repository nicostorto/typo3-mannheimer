<?php
namespace Mtm\MtmFertighausweltIntegration\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Nico Storto <storto@matoma.de>
 */
class HouseControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Mtm\MtmFertighausweltIntegration\Controller\HouseController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Mtm\MtmFertighausweltIntegration\Controller\HouseController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllHousesFromRepositoryAndAssignsThemToView()
    {

        $allHouses = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $houseRepository = $this->getMockBuilder(\Mtm\MtmFertighausweltIntegration\Domain\Repository\HouseRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $houseRepository->expects(self::once())->method('findAll')->will(self::returnValue($allHouses));
        $this->inject($this->subject, 'houseRepository', $houseRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('houses', $allHouses);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenHouseToView()
    {
        $house = new \Mtm\MtmFertighausweltIntegration\Domain\Model\House();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('house', $house);

        $this->subject->showAction($house);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenHouseToHouseRepository()
    {
        $house = new \Mtm\MtmFertighausweltIntegration\Domain\Model\House();

        $houseRepository = $this->getMockBuilder(\Mtm\MtmFertighausweltIntegration\Domain\Repository\HouseRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $houseRepository->expects(self::once())->method('add')->with($house);
        $this->inject($this->subject, 'houseRepository', $houseRepository);

        $this->subject->createAction($house);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenHouseToView()
    {
        $house = new \Mtm\MtmFertighausweltIntegration\Domain\Model\House();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('house', $house);

        $this->subject->editAction($house);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenHouseInHouseRepository()
    {
        $house = new \Mtm\MtmFertighausweltIntegration\Domain\Model\House();

        $houseRepository = $this->getMockBuilder(\Mtm\MtmFertighausweltIntegration\Domain\Repository\HouseRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $houseRepository->expects(self::once())->method('update')->with($house);
        $this->inject($this->subject, 'houseRepository', $houseRepository);

        $this->subject->updateAction($house);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenHouseFromHouseRepository()
    {
        $house = new \Mtm\MtmFertighausweltIntegration\Domain\Model\House();

        $houseRepository = $this->getMockBuilder(\Mtm\MtmFertighausweltIntegration\Domain\Repository\HouseRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $houseRepository->expects(self::once())->method('remove')->with($house);
        $this->inject($this->subject, 'houseRepository', $houseRepository);

        $this->subject->deleteAction($house);
    }
}
