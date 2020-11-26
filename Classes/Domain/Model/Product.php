<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Domain\Model;

use Ps\Entity\Domain\Model\Entity;

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
 * Product
 */
class Product extends Entity
{

    /**
     * attributes
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $attributes = null;

    /**
     * variants
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Variant>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $variants = null;

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
        $this->variants = $this->variants ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Attribute
     * 
     * @param \Ps\EntityProduct\Domain\Model\Attribute $attribute
     * @return void
     */
    public function addAttribute(\Ps\EntityProduct\Domain\Model\Attribute $attribute)
    {
        $this->attributes->attach($attribute);
    }

    /**
     * Removes a Attribute
     * 
     * @param \Ps\EntityProduct\Domain\Model\Attribute $attributeToRemove The Attribute to be removed
     * @return void
     */
    public function removeAttribute(\Ps\EntityProduct\Domain\Model\Attribute $attributeToRemove)
    {
        $this->attributes->detach($attributeToRemove);
    }

    /**
     * Returns the attributes
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the attributes
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $attributes
     * @return void
     */
    public function setAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Adds a Variant
     * 
     * @param \Ps\EntityProduct\Domain\Model\Variant $variant
     * @return void
     */
    public function addVariant(\Ps\EntityProduct\Domain\Model\Variant $variant)
    {
        $this->variants->attach($variant);
    }

    /**
     * Removes a Variant
     * 
     * @param \Ps\EntityProduct\Domain\Model\Variant $variantToRemove The Variant to be removed
     * @return void
     */
    public function removeVariant(\Ps\EntityProduct\Domain\Model\Variant $variantToRemove)
    {
        $this->variants->detach($variantToRemove);
    }

    /**
     * Returns the variants
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Variant> $variants
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * Sets the variants
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Variant> $variants
     * @return void
     */
    public function setVariants(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $variants)
    {
        $this->variants = $variants;
    }
}
