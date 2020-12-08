<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Domain\Model;


/***
 *
 * This file is part of the "Product" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Christian Pschorr <pschorr.christian@gmail.com>
 *
 ***/
/**
 * Attribute
 */
class Attribute extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * unit
     * 
     * @var string
     */
    protected $unit = '';

    /**
     * dataType
     * 
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $dataType = 0;

    /**
     * alternativeTitle
     * 
     * @var string
     */
    protected $alternativeTitle = '';

    /**
     * bundler
     * 
     * @var int
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $bundler = 0;

    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the unit
     * 
     * @return string $unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Sets the unit
     * 
     * @param string $unit
     * @return void
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * Returns the dataType
     * 
     * @return int $dataType
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Sets the dataType
     * 
     * @param int $dataType
     * @return void
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * Returns the alternativeTitle
     * 
     * @return string $alternativeTitle
     */
    public function getAlternativeTitle()
    {
        return $this->alternativeTitle;
    }

    /**
     * Sets the alternativeTitle
     * 
     * @param string $alternativeTitle
     * @return void
     */
    public function setAlternativeTitle($alternativeTitle)
    {
        $this->alternativeTitle = $alternativeTitle;
    }

    /**
     * Returns the bundler
     * 
     * @return int $bundler
     */
    public function getBundler()
    {
        return $this->bundler;
    }

    /**
     * Sets the bundler
     * 
     * @param int $bundler
     * @return void
     */
    public function setBundler($bundler)
    {
        $this->bundler = $bundler;
    }
}
