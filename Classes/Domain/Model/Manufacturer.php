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
 * Manufacturer
 */
class Manufacturer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * brochureEmail
     * 
     * @var string
     */
    protected $brochureEmail = '';

    /**
     * manufacturerName
     * 
     * @var string
     */
    protected $manufacturerName = '';

    /**
     * manufacturerSlogan
     * 
     * @var string
     */
    protected $manufacturerSlogan = '';

    /**
     * description
     * 
     * @var string
     */
    protected $description = '';

    /**
     * email
     * 
     * @var string
     */
    protected $email = '';

    /**
     * phone
     * 
     * @var string
     */
    protected $phone = '';

    /**
     * fax
     * 
     * @var string
     */
    protected $fax = '';

    /**
     * website
     * 
     * @var string
     */
    protected $website = '';

    /**
     * strasse
     * 
     * @var string
     */
    protected $strasse = '';

    /**
     * plz
     * 
     * @var string
     */
    protected $plz = '';

    /**
     * ort
     * 
     * @var string
     */
    protected $ort = '';

    /**
     * manufacturerLogo
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $manufacturerLogo = '';

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
    }

    /**
     * Returns the manufacturerName
     * 
     * @return string $manufacturerName
     */
    public function getManufacturerName()
    {
        return $this->manufacturerName;
    }

    /**
     * Sets the manufacturerName
     * 
     * @param string $manufacturerName
     * @return void
     */
    public function setManufacturerName($manufacturerName)
    {
        $this->manufacturerName = $manufacturerName;
    }

    /**
     * Returns the description
     * 
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the brochureemail
     * 
     * @return string $brochureEmail
     */
    public function getBrochureEmail()
    {
        return $this->brochureEmail;
    }

    /**
     * Sets the email
     * 
     * @param string $brochureEmail
     * @return void
     */
    public function setBrochureEmail($brochureEmail)
    {
        $this->brochureEmail = $brochureEmail;
    }

    /**
     * Returns the phone
     * 
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets the phone
     * 
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Returns the fax
     * 
     * @return string $fax
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Sets the fax
     * 
     * @param string $fax
     * @return void
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Returns the manufacturerLogo
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $manufacturerLogo
     */
    public function getManufacturerLogo()
    {
        return $this->manufacturerLogo;
    }

    /**
     * Sets the manufacturerLogo
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $manufacturerLogo
     * @return void
     */
    public function setManufacturerLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $manufacturerLogo)
    {
        $this->manufacturerLogo = $manufacturerLogo;
    }

    /**
     * Returns the manufacturerSlogan
     * 
     * @return string $manufacturerSlogan
     */
    public function getManufacturerSlogan()
    {
        return $this->manufacturerSlogan;
    }

    /**
     * Sets the manufacturerSlogan
     * 
     * @param string $manufacturerSlogan
     * @return void
     */
    public function setManufacturerSlogan($manufacturerSlogan)
    {
        $this->manufacturerSlogan = $manufacturerSlogan;
    }

    /**
     * Returns the website
     * 
     * @return string $website
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Sets the website
     * 
     * @param string $website
     * @return void
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Returns the strasse
     * 
     * @return string $strasse
     */
    public function getStrasse()
    {
        return $this->strasse;
    }

    /**
     * Sets the strasse
     * 
     * @param string $strasse
     * @return void
     */
    public function setStrasse($strasse)
    {
        $this->strasse = $strasse;
    }

    /**
     * Returns the plz
     * 
     * @return string $plz
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * Sets the plz
     * 
     * @param string $plz
     * @return void
     */
    public function setPlz($plz)
    {
        $this->plz = $plz;
    }

    /**
     * Returns the ort
     * 
     * @return string ort
     */
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * Sets the ort
     * 
     * @param string $ort
     * @return void
     */
    public function setOrt($ort)
    {
        $this->ort = $ort;
    }
}
