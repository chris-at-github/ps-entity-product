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
 * AttributeValue
 */
class AttributeValue extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * value
     * 
     * @var string
     */
    protected $value = '';

    /**
     * attribute
     * 
     * @var \Ps\EntityProduct\Domain\Model\Attribute
     */
    protected $attribute = null;

    /**
     * Returns the value
     * 
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the value
     * 
     * @param string $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the attribute
     * 
     * @return \Ps\EntityProduct\Domain\Model\Attribute $attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Sets the attribute
     * 
     * @param \Ps\EntityProduct\Domain\Model\Attribute $attribute
     * @return void
     */
    public function setAttribute(\Ps\EntityProduct\Domain\Model\Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
}
