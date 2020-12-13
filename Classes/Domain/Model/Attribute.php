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
class Attribute extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $title = '';

	/**
	 * alternativeTitle
	 *
	 * @var string
	 */
	protected $alternativeTitle = '';

	/**
	 * unit
	 *
	 * @var string
	 */
	protected $unit = '';

	/**
	 * dataType
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $dataType = '';

	/**
	 * groupType
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $groupType = '';

	/**
	 * prefix
	 *
	 * @var string
	 */
	protected $prefix = '';

	/**
	 * options
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\AttributeOption>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $options = null;


	/**
	 * __construct
	 */
	public function __construct() {

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
	protected function initializeObject() {
		$this->options = $this->options ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the unit
	 *
	 * @return string $unit
	 */
	public function getUnit() {
		return $this->unit;
	}

	/**
	 * Sets the unit
	 *
	 * @param string $unit
	 * @return void
	 */
	public function setUnit($unit) {
		$this->unit = $unit;
	}

	/**
	 * Returns the dataType
	 *
	 * @return string $dataType
	 */
	public function getDataType() {
		return $this->dataType;
	}

	/**
	 * Sets the dataType
	 *
	 * @param string $dataType
	 * @return void
	 */
	public function setDataType($dataType) {
		$this->dataType = $dataType;
	}

	/**
	 * Returns the alternativeTitle
	 *
	 * @return string $alternativeTitle
	 */
	public function getAlternativeTitle() {
		return $this->alternativeTitle;
	}

	/**
	 * Sets the alternativeTitle
	 *
	 * @param string $alternativeTitle
	 * @return void
	 */
	public function setAlternativeTitle($alternativeTitle) {
		$this->alternativeTitle = $alternativeTitle;
	}

	/**
	 * Returns the groupType
	 *
	 * @return string $bundler
	 */
	public function getGroupType() {
		return $this->groupType;
	}

	/**
	 * Sets the groupType
	 *
	 * @param string $groupType
	 * @return void
	 */
	public function setGroupType($groupType) {
		$this->groupType = $groupType;
	}

	/**
	 * Returns the prefix
	 *
	 * @return string $prefix
	 */
	public function getPrefix() {
		return $this->prefix;
	}

	/**
	 * Sets the prefix
	 *
	 * @param string $prefix
	 * @return void
	 */
	public function setPrefix($prefix) {
		$this->prefix = $prefix;
	}

	/**
	 * Adds a AttributeOptions
	 *
	 * @param \Ps\EntityProduct\Domain\Model\AttributeOption $option
	 * @return void
	 */
	public function addOption(\Ps\EntityProduct\Domain\Model\AttributeOption $option) {
		$this->options->attach($option);
	}

	/**
	 * Removes a AttributeOptions
	 *
	 * @param \Ps\EntityProduct\Domain\Model\AttributeOption $optionToRemove The AttributeOptions to be removed
	 * @return void
	 */
	public function removeOption(\Ps\EntityProduct\Domain\Model\AttributeOption $optionToRemove) {
		$this->options->detach($optionToRemove);
	}

	/**
	 * Returns the options
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\AttributeOption> $options
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Sets the options
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\AttributeOption> $options
	 * @return void
	 */
	public function setOptions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $options) {
		$this->options = $options;
	}
}
