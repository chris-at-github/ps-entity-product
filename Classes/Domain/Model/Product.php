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
	protected $layout = '';

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $images = null;

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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps14\Teaser\Domain\Model\Page>
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
	 * @var string
	 */
	protected $variantTitle = '';

	/**
	 * accessories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Product>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $accessories = null;

	/**
	 * accessories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\EntityProduct\Domain\Model\Product>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $related = null;

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
	 * @var \Ps\EntityProduct\Domain\Model\Product
	 */
	protected $parent = null;

	/**
	 * @var \Ps14\Chart\Domain\Model\Chart
	 */
	protected $chart = null;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps14\Chart\Domain\Model\Value>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $chartValues = null;

	/**
	 * @var string
	 */
	protected $airConsumptionData = '';

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $airConsumptionMedia = null;

	/**
	 * @var string
	 */
	protected $airConsumptionFallback = '';

	/**
	 * @var \Ps14\Teaser\Domain\Model\Page
	 */
	protected $technology = null;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $systemInstallationMedia = null;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\Xo\Domain\Model\Element>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $systemInstallationLegend = null;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\Xo\Domain\Model\Element>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $technicalFeatures = null;

	/**
	 * @var string
	 */
	protected $options = '';

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
		$this->images = $this->images ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->technicalDrawings = $this->technicalDrawings ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->attributes = $this->attributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->variants = $this->variants ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->accessories = $this->accessories ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->configuratorFilterAttributes = $this->configuratorFilterAttributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->configuratorResultAttributes = $this->configuratorResultAttributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->groupedAttributes = $this->groupedAttributes ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->keyFacts = $this->keyFacts ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->systemInstallationLegend = $this->systemInstallationLegend ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->technicalFeatures = $this->technicalFeatures ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
	 */
	public function getMasterImage() {
		$image = null;

		if($this->images->count() !== 0) {
			$image = $this->images->current();
		}

		return $image;
	}

	/**
	 * Returns the media
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the media
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images) {
		$this->images = $images;
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
	 * @return string
	 */
	public function getVariantTitle(): string {
		return $this->variantTitle;
	}

	/**
	 * @param string $variantTitle
	 */
	public function setVariantTitle(string $variantTitle): void {
		$this->variantTitle = $variantTitle;
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

//		// alle Tabellen sammeln
//		if(preg_match_all('/<(table.*?)>(.*?)<\/table>/', $this->technicalData, $tables) !== false) {
//			for($i = 0; $i < count($tables[0]); $i++) {
//
//				// erste Zeile jeder Tabelle ausparsen
//				if(preg_match('/<tr>(.*?)<\/tr>/', $tables[2][$i], $row) !== false) {
//
//					// Anzahl der Spalten identifizieren
//					if(isset($row[0]) === true && preg_match_all('/.*?<\/(td|th)>.*?/', $row[0], $cols) !== false) {
//						DebuggerUtility::var_dump($cols);
//					}
//				}
//			}
//		}

		return $this->technicalData;
	}

	/**
	 * @param string $technicalData
	 */
	public function setTechnicalData(string $technicalData): void {
		$this->technicalData = $technicalData;
	}

	/**
	 * @return \Ps14\Chart\Domain\Model\Chart
	 */
	public function getChart(): ?\Ps14\Chart\Domain\Model\Chart {
		return $this->chart;
	}

	/**
	 * @param \Ps14\Chart\Domain\Model\Chart $chart
	 */
	public function setChart(?\Ps14\Chart\Domain\Model\Chart $chart): void {
		$this->chart = $chart;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getChartValues(): ?\TYPO3\CMS\Extbase\Persistence\ObjectStorage {
		return $this->chartValues;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $chartValues
	 */
	public function setChartValues(?\TYPO3\CMS\Extbase\Persistence\ObjectStorage $chartValues): void {
		$this->chartValues = $chartValues;
	}

	/**
	 * @return \Ps14\Teaser\Domain\Model\Page
	 */
	public function getTechnology(): ?\Ps14\Teaser\Domain\Model\Page {
		return $this->technology;
	}

	/**
	 * @param \Ps14\Teaser\Domain\Model\Page $technology
	 */
	public function setTechnology(?\Ps14\Teaser\Domain\Model\Page $technology): void {
		$this->technology = $technology;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getSystemInstallationMedia(): ?\TYPO3\CMS\Extbase\Domain\Model\FileReference {
		return $this->systemInstallationMedia;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $systemInstallationMedia
	 */
	public function setSystemInstallationMedia(?\TYPO3\CMS\Extbase\Domain\Model\FileReference $systemInstallationMedia): void {
		$this->systemInstallationMedia = $systemInstallationMedia;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getSystemInstallationLegend(): ?\TYPO3\CMS\Extbase\Persistence\ObjectStorage {
		return $this->systemInstallationLegend;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $systemInstallationLegend
	 */
	public function setSystemInstallationLegend(?\TYPO3\CMS\Extbase\Persistence\ObjectStorage $systemInstallationLegend): void {
		$this->systemInstallationLegend = $systemInstallationLegend;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getTechnicalFeatures(): ?\TYPO3\CMS\Extbase\Persistence\ObjectStorage {
		return $this->technicalFeatures;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $technicalFeatures
	 */
	public function setTechnicalFeatures(?\TYPO3\CMS\Extbase\Persistence\ObjectStorage $technicalFeatures): void {
		$this->technicalFeatures = $technicalFeatures;
	}

	/**
	 * @return string
	 */
	public function getOptions(): string {
		return $this->options;
	}

	/**
	 * @param string $options
	 */
	public function setOptions(string $options): void {
		$this->options = $options;
	}

	/**
	 * @return string
	 */
	public function getLayout(): string {
		return $this->layout;
	}

	/**
	 * @param string $layout
	 */
	public function setLayout(string $layout): void {
		$this->layout = $layout;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	public function getAirConsumptionMedia(): ?\TYPO3\CMS\Extbase\Domain\Model\FileReference {
		return $this->airConsumptionMedia;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $airConsumptionMedia
	 */
	public function setAirConsumptionMedia(?\TYPO3\CMS\Extbase\Domain\Model\FileReference $airConsumptionMedia): void {
		$this->airConsumptionMedia = $airConsumptionMedia;
	}

	/**
	 * @return string
	 */
	public function getAirConsumptionData(): string {
		return $this->airConsumptionData;
	}

	/**
	 * @param string $airConsumptionData
	 */
	public function setAirConsumptionData(string $airConsumptionData): void {
		$this->airConsumptionData = $airConsumptionData;
	}

	/**
	 * @return string
	 */
	public function getAirConsumptionFallback(): string {
		return $this->airConsumptionFallback;
	}

	/**
	 * @param string $airConsumptionFallback
	 */
	public function setAirConsumptionFallback(string $airConsumptionFallback): void {
		$this->airConsumptionFallback = $airConsumptionFallback;
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
