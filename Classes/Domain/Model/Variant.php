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
 * Variant
 */
class Variant extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * articleNumber
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $articleNumber = '';

    /**
     * files
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $files = null;

    /**
     * attributes
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\AttributeValue>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $attributes = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initializeObject()
    {
        $this->attributes = $this->attributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

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
     * Returns the articleNumber
     * 
     * @return string $articleNumber
     */
    public function getArticleNumber()
    {
        return $this->articleNumber;
    }

    /**
     * Sets the articleNumber
     * 
     * @param string $articleNumber
     * @return void
     */
    public function setArticleNumber($articleNumber)
    {
        $this->articleNumber = $articleNumber;
    }

    /**
     * Returns the files
     * 
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Sets the files
     * 
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $files
     * @return void
     */
    public function setFiles(\TYPO3\CMS\Extbase\Domain\Model\FileReference $files)
    {
        $this->files = $files;
    }

    /**
     * Adds a AttributeValue
     * 
     * @param \Ps\EntityProduct\Domain\Model\AttributeValue $attribute
     * @return void
     */
    public function addAttribute(\Ps\EntityProduct\Domain\Model\AttributeValue $attribute)
    {
        $this->attributes->attach($attribute);
    }

    /**
     * Removes a AttributeValue
     * 
     * @param \Ps\EntityProduct\Domain\Model\AttributeValue $attributeToRemove The AttributeValue to be removed
     * @return void
     */
    public function removeAttribute(\Ps\EntityProduct\Domain\Model\AttributeValue $attributeToRemove)
    {
        $this->attributes->detach($attributeToRemove);
    }

    /**
     * Returns the attributes
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\AttributeValue> $attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the attributes
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\AttributeValue> $attributes
     * @return void
     */
    public function setAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attributes)
    {
        $this->attributes = $attributes;
    }
}
