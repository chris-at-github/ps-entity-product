<?php

namespace Ps\EntityProduct\Controller;


use Ps\Entity\Controller\EntityController;
use Ps\EntityProduct\Domain\Model\Product as Entity;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
 * ProductController
 */
class ProductController extends EntityController {

	/**
	 * productRepository
	 *
	 * @var ProductRepository
	 */
	protected $productRepository = null;

	/**
	 * @param ProductRepository $productRepository
	 */
	public function injectProductRepository(ProductRepository $productRepository) {
		$this->productRepository = $productRepository;
	}

	/**
	 * @param array $overwrite
	 * @return array
	 */
	protected function getDemand($overwrite = []) {
		$options = parent::getDemand($overwrite);

		if(empty($this->settings['productRange']) === false) {
			$options['masterCategory'] = (int)$this->settings['productRange'];
		}

		if(empty($overwrite['categories']) === false) {
			$options['categories'] = $overwrite['categories'];
		}

		return $options;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listingAction() {

		/** @var \Ps\Xo\Service\FilterService  $filter */
		$filter = $this->objectManager->get(\Ps\Xo\Service\FilterService::class, 'entityproduct', $this->request, $this->configurationManager->getContentObject(), $this->settings);
		$products = $this->productRepository->findAll($this->getDemand($filter->getArguments(true)));

		$this->view->assign('products', $products);
		$this->view->assign('record', $this->configurationManager->getContentObject()->data);
		$this->view->assign('filter', $filter->get());
	}

	/**
	 * action show
	 *
	 * @param \Ps\EntityProduct\Domain\Model\Product $product
	 * @return void
	 */
	public function showAction($product) {

		// Eltern Eigenschaften aufrufen z.B. Auswertung Meta-Tags, Title-Tag, ...
		parent::showAction($product);

		// Uebergabe an Template
		$this->view->assign('product', $product);
	}
}
