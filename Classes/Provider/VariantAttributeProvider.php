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

				$title = $attribute->getTitle();
				if(empty($attribute->getUnit()) === false) {
					$title .= ' (' . $attribute->getUnit() . ')';
				}

				$field = $form->createField('input', $attribute->getUid(), $title);

				$form->add($field);
			}
		}

//		$product = $this->productRepository->findByUid($row['uid']);
//
//		if ($product) {
//			$productGroup = $product->getProductGroup();
//
//			// Create a sheet for each property group
//			foreach ($productGroup->getPropertyGroups() as $group) {
//				$sheet = $form->createContainer(
//					'Sheet',
//					'',
//					''
//				);
//
//				// Create a field for each property
//				foreach ($group->getProperties() as $property) {
//
//					// The property holds the field type, e.g. 'Input'
//					$field = $form->createField(
//						'Input',
//						'908432',
//						'Abmessungen'
//					);
//					$field->setValidate('trim,int');
//		$form->add($field);
////				}
////			}
////		}

		return $form;
	}
}