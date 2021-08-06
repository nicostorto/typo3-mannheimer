<?php
namespace Mtm\MtmFertighausweltIntegration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Nico Storto <storto@matoma.de>
 */
class ManufacturerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Mtm\MtmFertighausweltIntegration\Domain\Model\Manufacturer();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getManufacturerNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getManufacturerName()
        );
    }

    /**
     * @test
     */
    public function setManufacturerNameForStringSetsManufacturerName()
    {
        $this->subject->setManufacturerName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'manufacturerName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getManufacturerSloganReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getManufacturerSlogan()
        );
    }

    /**
     * @test
     */
    public function setManufacturerSloganForStringSetsManufacturerSlogan()
    {
        $this->subject->setManufacturerSlogan('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'manufacturerSlogan',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDescriptionReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription()
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'description',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPhoneReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPhone()
        );
    }

    /**
     * @test
     */
    public function setPhoneForStringSetsPhone()
    {
        $this->subject->setPhone('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'phone',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFaxReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFax()
        );
    }

    /**
     * @test
     */
    public function setFaxForStringSetsFax()
    {
        $this->subject->setFax('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'fax',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getWebsiteReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getWebsite()
        );
    }

    /**
     * @test
     */
    public function setWebsiteForStringSetsWebsite()
    {
        $this->subject->setWebsite('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'website',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getStrasseReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getStrasse()
        );
    }

    /**
     * @test
     */
    public function setStrasseForStringSetsStrasse()
    {
        $this->subject->setStrasse('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'strasse',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPlzReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPlz()
        );
    }

    /**
     * @test
     */
    public function setPlzForStringSetsPlz()
    {
        $this->subject->setPlz('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'plz',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOrtReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getOrt()
        );
    }

    /**
     * @test
     */
    public function setOrtForStringSetsOrt()
    {
        $this->subject->setOrt('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'ort',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getManufacturerLogoReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getManufacturerLogo()
        );
    }

    /**
     * @test
     */
    public function setManufacturerLogoForFileReferenceSetsManufacturerLogo()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setManufacturerLogo($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'manufacturerLogo',
            $this->subject
        );
    }
}
