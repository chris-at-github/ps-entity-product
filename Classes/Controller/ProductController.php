<?php

namespace Ps\EntityProduct\Controller;


use Ps\Entity\Controller\EntityController;
use Ps\EntityProduct\Domain\Model\Product as Entity;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use Ps\EntityProduct\Provider\LineChartDataProvider;
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
			$options['masterCategory'] = (int) $this->settings['productRange'];
		}

		if(empty($overwrite['categories']) === false) {
			$options['categories'] = $overwrite['categories'];
		}

		if(empty($overwrite['technology']) === false) {
			$options['technology'] = (int) $overwrite['technology'];
		}

		// keine Varianten
		// TODO: eventuell als Option im Flexform
		$options['parent'] = 0;

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
	 * @param \Ps\EntityProduct\Domain\Model\Product $product
	 * @return void
	 */
	public function showAction($product) {

		// Eltern Eigenschaften aufrufen z.B. Auswertung Meta-Tags, Title-Tag, ...
		parent::showAction($product);

		// Uebergabe an Template
		$this->view->assign('product', $product);
		$this->view->assign('variants', $this->getProductVariants($product));

		if($product->getChart() !== null) {

			/** @var LineChartDataProvider $chartDataProvider */
			$chartDataProvider = GeneralUtility::makeInstance(LineChartDataProvider::class);
			$this->view->assign('chart', $chartDataProvider->provide(['chart' => $product->getChart(), 'values' => $product->getChartValues()]));
		}
	}

	/**
	 * @return void
	 */
	public function teaserAction() {
		if($this->settings['source'] === 'technology') {
			unset($this->settings['categories']);
			unset($this->settings['products']);
			unset($this->settings['application']);
		}

		$this->settings['xo'] = $this->objectManager->get(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::class)->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
			'xo'
		);

		$this->view->assign('products', $this->productRepository->findAll($this->getDemand($this->settings)));
		$this->view->assign('settings', $this->settings);
	}


	/**
	 * @param \Ps\EntityProduct\Domain\Model\Product $product
	 * @return array
	 */
	protected function getProductVariants(Entity $product) {
		$variants = [];

		// moeglicherweise selbst das Elternelement
		if($product->getParent() === null) {
			$products = $this->productRepository->findAll(['parent' => $product->getUid()]);

			// gibt es Varianten zu diesem Product?
			if($products->count() !== 0) {

				// Eltern-Produkt ebenfalls hinzufuegen
				$variants[] = $product;

				// weitere Unter-Produkte hinzufuegen
				foreach($products as $value) {
					$variants[] = $value;
				}
			}

		// Produkt ist selbst eine Variante
		} else {

			// Eltern-Produkt ebenfalls hinzufuegen
			$variants[] = $product->getParent();

			// alle Unter-Produkte identifizieren und hinzufuegen
			foreach($this->productRepository->findAll(['parent' => $product->getParent()->getUid()]) as $value) {
				$variants[] = $value;
			}
		}

		return $variants;
	}
}
