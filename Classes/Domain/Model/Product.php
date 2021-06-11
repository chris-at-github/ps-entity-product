<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Domain\Model;

use Ps\Entity\Domain\Model\Entity;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
class Product extends Entity {

	/**
	 * @var string
	 */
	protected $technicalData = '';

	/**
	 * technicalDrawings
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $technicalDrawings = null;

	/**
	 * applications
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\Xo\Domain\Model\Page>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $applications = null;

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
	 * accessories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Product>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $accessories = null;

	/**
	 * showConfigurator
	 *
	 * @var bool
	 */
	protected $showConfigurator = false;

	/**
	 * configuratorFilterAttributes
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $configuratorFilterAttributes = null;

	/**
	 * configuratorResultAttributes
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $configuratorResultAttributes = null;

	/**
	 * groupedAttributes
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $groupedAttributes = null;

	/**
	 * keyFacts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\KeyFact>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $keyFacts = null;

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
		parent::initializeObject();
		$this->technicalDrawings = $this->technicalDrawings ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->attributes = $this->attributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->variants = $this->variants ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->accessories = $this->accessories ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->configuratorFilterAttributes = $this->configuratorFilterAttributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->configuratorResultAttributes = $this->configuratorResultAttributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->groupedAttributes = $this->groupedAttributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->keyFacts = $this->keyFacts ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $attribute
	 * @return void
	 */
	public function addAttribute(\Ps\EntityProduct\Domain\Model\Attribute $attribute) {
		$this->attributes->attach($attribute);
	}

	/**
	 * Removes a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $attributeToRemove The Attribute to be removed
	 * @return void
	 */
	public function removeAttribute(\Ps\EntityProduct\Domain\Model\Attribute $attributeToRemove) {
		$this->attributes->detach($attributeToRemove);
	}

	/**
	 * Returns the attributes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $attributes
	 */
	public function getAttributes() {
		return $this->attributes;
	}

	/**
	 * Sets the attributes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $attributes
	 * @return void
	 */
	public function setAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attributes) {
		$this->attributes = $attributes;
	}

	/**
	 * Adds a Variant
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Variant $variant
	 * @return void
	 */
	public function addVariant(\Ps\EntityProduct\Domain\Model\Variant $variant) {
		$this->variants->attach($variant);
	}

	/**
	 * Removes a Variant
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Variant $variantToRemove The Variant to be removed
	 * @return void
	 */
	public function removeVariant(\Ps\EntityProduct\Domain\Model\Variant $variantToRemove) {
		$this->variants->detach($variantToRemove);
	}

	/**
	 * Returns the variants
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Variant> $variants
	 */
	public function getVariants() {
		return $this->variants;
	}

	/**
	 * Sets the variants
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Variant> $variants
	 * @return void
	 */
	public function setVariants(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $variants) {
		$this->variants = $variants;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $technicalDrawing
	 * @return void
	 */
	public function addTechnicalDrawing(\TYPO3\CMS\Extbase\Domain\Model\FileReference $technicalDrawing) {
		$this->technicalDrawings->attach($technicalDrawing);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $technicalDrawingToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeTechnicalDrawing(\TYPO3\CMS\Extbase\Domain\Model\FileReference $technicalDrawingToRemove) {
		$this->technicalDrawings->detach($technicalDrawingToRemove);
	}

	/**
	 * Returns the technicalDrawings
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $technicalDrawings
	 */
	public function getTechnicalDrawings() {
		return $this->technicalDrawings;
	}

	/**
	 * Sets the technicalDrawings
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $technicalDrawings
	 * @return void
	 */
	public function setTechnicalDrawings(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $technicalDrawings) {
		$this->technicalDrawings = $technicalDrawings;
	}

	/**
	 * Adds a Product
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Product $accessory
	 * @return void
	 */
	public function addAccessory(\Ps\EntityProduct\Domain\Model\Product $accessory) {
		$this->accessories->attach($accessory);
	}

	/**
	 * Removes a Product
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Product $accessoryToRemove The Product to be removed
	 * @return void
	 */
	public function removeAccessory(\Ps\EntityProduct\Domain\Model\Product $accessoryToRemove) {
		$this->accessories->detach($accessoryToRemove);
	}

	/**
	 * Returns the accessories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Product> $accessories
	 */
	public function getAccessories() {
		return $this->accessories;
	}

	/**
	 * Sets the accessories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Product> $accessories
	 * @return void
	 */
	public function setAccessories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $accessories) {
		$this->accessories = $accessories;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getApplications(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage {
		return $this->applications;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $applications
	 */
	public function setApplications(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $applications): void {
		$this->applications = $applications;
	}

	/**
	 * @return string
	 */
	public function getTechnicalData(): string {
		return $this->technicalData;
	}

	/**
	 * @param string $technicalData
	 */
	public function setTechnicalData(string $technicalData): void {
		$this->technicalData = $technicalData;
	}

	/**
	 * @return array
	 */
	protected function getLinkArguments() {
		return [
			'extension' => 'EntityProduct',
			'controller' => 'Product',
			'action' => 'show',
			'plugin' => 'Frontend',
			'arguments' => [
				'product' => $this->getUid()
			]
		];
	}

	/**
	 * Returns the showConfigurator
	 *
	 * @return bool $showConfigurator
	 */
	public function getShowConfigurator() {
		return $this->showConfigurator;
	}

	/**
	 * Sets the showConfigurator
	 *
	 * @param bool $showConfigurator
	 * @return void
	 */
	public function setShowConfigurator($showConfigurator) {
		$this->showConfigurator = $showConfigurator;
	}

	/**
	 * Returns the boolean state of showConfigurator
	 *
	 * @return bool
	 */
	public function isShowConfigurator() {
		return $this->showConfigurator;
	}

	/**
	 * Adds a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $configuratorFilterAttribute
	 * @return void
	 */
	public function addConfiguratorFilterAttribute(\Ps\EntityProduct\Domain\Model\Attribute $configuratorFilterAttribute) {
		$this->configuratorFilterAttributes->attach($configuratorFilterAttribute);
	}

	/**
	 * Removes a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $configuratorFilterAttributeToRemove The Attribute to be removed
	 * @return void
	 */
	public function removeConfiguratorFilterAttribute(\Ps\EntityProduct\Domain\Model\Attribute $configuratorFilterAttributeToRemove) {
		$this->configuratorFilterAttributes->detach($configuratorFilterAttributeToRemove);
	}

	/**
	 * Returns the configuratorFilterAttributes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $configuratorFilterAttributes
	 */
	public function getConfiguratorFilterAttributes() {
		return $this->configuratorFilterAttributes;
	}

	/**
	 * Sets the configuratorFilterAttributes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $configuratorFilterAttributes
	 * @return void
	 */
	public function setConfiguratorFilterAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $configuratorFilterAttributes) {
		$this->configuratorFilterAttributes = $configuratorFilterAttributes;
	}

	/**
	 * Adds a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $configuratorResultAttribute
	 * @return void
	 */
	public function addConfiguratorResultAttribute(\Ps\EntityProduct\Domain\Model\Attribute $configuratorResultAttribute) {
		$this->configuratorResultAttributes->attach($configuratorResultAttribute);
	}

	/**
	 * Removes a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $configuratorResultAttributeToRemove The Attribute to be removed
	 * @return void
	 */
	public function removeConfiguratorResultAttribute(\Ps\EntityProduct\Domain\Model\Attribute $configuratorResultAttributeToRemove) {
		$this->configuratorResultAttributes->detach($configuratorResultAttributeToRemove);
	}

	/**
	 * Returns the configuratorResultAttributes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $configuratorResultAttributes
	 */
	public function getConfiguratorResultAttributes() {
		return $this->configuratorResultAttributes;
	}

	/**
	 * Sets the configuratorResultAttributes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $configuratorResultAttributes
	 * @return void
	 */
	public function setConfiguratorResultAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $configuratorResultAttributes) {
		$this->configuratorResultAttributes = $configuratorResultAttributes;
	}

	/**
	 * Adds a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $groupedAttribute
	 * @return void
	 */
	public function addGroupedAttribute(\Ps\EntityProduct\Domain\Model\Attribute $groupedAttribute) {
		$this->groupedAttributes->attach($groupedAttribute);
	}

	/**
	 * Removes a Attribute
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Attribute $groupedAttributeToRemove The Attribute to be removed
	 * @return void
	 */
	public function removeGroupedAttribute(\Ps\EntityProduct\Domain\Model\Attribute $groupedAttributeToRemove) {
		$this->groupedAttributes->detach($groupedAttributeToRemove);
	}

	/**
	 * Returns the groupedAttributes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $groupedAttributes
	 */
	public function getGroupedAttributes() {
		return $this->groupedAttributes;
	}

	/**
	 * Sets the groupedAttributes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Attribute> $groupedAttributes
	 * @return void
	 */
	public function setGroupedAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $groupedAttributes) {
		$this->groupedAttributes = $groupedAttributes;
	}

	/**
	 * @param \Ps\EntityProduct\Domain\Model\KeyFact $keyFact
	 * @return void
	 */
	public function addKeyFact(\Ps\EntityProduct\Domain\Model\KeyFact $keyFact) {
		$this->keyFacts->attach($keyFact);
	}

	/**
	 * @param \Ps\EntityProduct\Domain\Model\KeyFact $keyFact
	 * @return void
	 */
	public function removeKeyFact(\Ps\EntityProduct\Domain\Model\KeyFact $keyFact) {
		$this->keyFacts->detach($keyFact);
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\KeyFact> $keyFacts
	 */
	public function getKeyFacts() {
		return $this->keyFacts;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\KeyFact> $keyFacts
	 * @return void
	 */
	public function setKeyFacts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $keyFacts) {
		$this->keyFacts = $keyFacts;
	}
}
