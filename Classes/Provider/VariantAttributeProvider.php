<?php

namespace Ps\EntityProduct\Provider;

use FluidTYPO3\Flux\Provider\AbstractProvider;
use FluidTYPO3\Flux\Provider\ProviderInterface;
use Ps\EntityProduct\Domain\Model\Attribute;
use Ps\EntityProduct\Domain\Model\Product;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class VariantAttributeProvider extends AbstractProvider implements ProviderInterface {

	/**
	 * @var string
	 */
	protected $tableName = 'tx_entityproduct_domain_model_variant';

	/**
	 * @var string
	 */
	protected $fieldName = 'pi_flexform';

	/**
	 * @var ObjectManager
	 */
	protected $objectManager;

	/**
	 * @return void
	 */
	public function __construct()	{
		$this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
	}

	/**
	 * @param array $row
	 * @return \FluidTYPO3\Flux\Form\FormInterface|\FluidTYPO3\Flux\Form\Form|null
	 */
	public function getForm(array $row) {
		$form = \FluidTYPO3\Flux\Form::create();

		/** @var Product $product */
		$product = $this->objectManager->get(ProductRepository::class)->findByUid((int) $row['product']);

		if(empty($product) === false) {

			/** @var Attribute $attribute */
			foreach($product->getAttributes() as $attribute) {
				$field = $form->createField(
					$this->getFieldType($attribute),
					$attribute->getUid(),
					$this->getFieldLabel($attribute)
				);

				$field->setValidate($this->getFieldValidation($attribute));

				$form->add($field);
			}
		}

		return $form;
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldType(Attribute $attribute) {
		$type = '';

		if($attribute->getDataType() === 'string' || $attribute->getDataType() === 'int' || $attribute->getDataType() === 'float') {
			$type = 'input';
		}

		if($attribute->getDataType() === 'boolean') {
			$type = 'checkbox';
		}

		return $type;
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldLabel(Attribute $attribute) {
		$label = $attribute->getTitle();

		if(empty($attribute->getUnit()) === false) {
			$label .= ' (' . $attribute->getUnit() . ')';
		}

		return $label;
	}

	/**
	 * @param Attribute $attribute
	 * @return string
	 */
	protected function getFieldValidation(Attribute $attribute) {
		$validation = 'trim';

		if($attribute->getDataType() === 'int') {
			$validation = ',int';
		}

		if($attribute->getDataType() === 'float') {
			$validation = ',Ps\Xo\Evaluation\FloatEvaluation';
		}

		return $validation;
	}
}