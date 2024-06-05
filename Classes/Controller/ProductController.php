<?php

namespace Ps\EntityProduct\Controller;


use Ps\Entity\Controller\EntityController;
use Ps\EntityProduct\Domain\Model\Product;
use Ps\EntityProduct\Domain\Model\Product as Entity;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use Ps\EntityProduct\Provider\LineChartDataProvider;
use Ps14\Site\Service\FilterService;
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

		if(empty($overwrite['categories-tree']) === false) {
			$options['categories-tree'] = $overwrite['categories-tree'];
		}

		if(empty($overwrite['technology']) === false) {
			$options['technology'] = (int) $overwrite['technology'];
		}

		if(empty($overwrite['application']) === false) {
			$options['application'] = (int) $overwrite['application'];
		}

		if(empty($overwrite['records']) === false) {
			$options['records'] = GeneralUtility::intExplode(',', $overwrite['records']);
		}

		// keine Varianten
		// TODO: eventuell als Option im Flexform
		$options['parent'] = 0;

		return $options;
	}

	/**
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function listingAction() {

		/** @var FilterService $filter */
		$filter = GeneralUtility::makeInstance(\Ps14\Site\Service\FilterService::class, 'entityproduct', $this->request, $this->request->getAttribute('currentContentObject'), $this->settings['filter']);
		$products = $this->productRepository->findAllByOption($this->getDemand($filter->getArguments(true)));

		$this->view->assign('products', $products);
		$this->view->assign('record', $this->request->getAttribute('currentContentObject')->data);
		$this->view->assign('filter', $filter->get());

		return $this->htmlResponse();
	}

	/**
	 * @param \Ps\EntityProduct\Domain\Model\Product $product
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function showAction($product) {

		// Aufruf als PDF
		$isScreenContext = true;
		if(empty((int) GeneralUtility::_GET('type')) === false) {
			$isScreenContext = false;
		}
		$this->view->assign('isScreenContext', $isScreenContext);
//
//		// Eltern Eigenschaften aufrufen z.B. Auswertung Meta-Tags, Title-Tag, ...
//		parent::showAction($product);
//
		// Uebergabe an Template
		$this->view->assign('product', $product);
//		$this->view->assign('variants', $this->getProductVariants($product));
//
//		// keine Anzeige der Box individuelles Produkt
//		$this->settings['hideIndividualProduct'] = 1;
//		$this->view->assign('settings', $this->settings);
//
//		if($product->getChart() !== null) {
//
//			/** @var LineChartDataProvider $chartDataProvider */
//			$chartDataProvider = GeneralUtility::makeInstance(LineChartDataProvider::class);
//			$this->view->assign('chart', $chartDataProvider->provide(['chart' => $product->getChart(), 'values' => $product->getChartValues()]));
//		}

		return $this->htmlResponse();
	}

	/**
	 * @return void
	 */
	public function teaserAction() {
//		if($this->settings['source'] === 'technology') {
//			unset($this->settings['categories']);
//			unset($this->settings['products']);
//			unset($this->settings['application']);
//			unset($this->settings['records']);
//
//		} elseif($this->settings['source'] === 'categories') {
//			unset($this->settings['technology']);
//			unset($this->settings['products']);
//			unset($this->settings['application']);
//			unset($this->settings['records']);
//
//		} elseif($this->settings['source'] === 'application') {
//			unset($this->settings['technology']);
//			unset($this->settings['products']);
//			unset($this->settings['categories']);
//			unset($this->settings['records']);
//
//		} elseif($this->settings['source'] === 'records') {
//			unset($this->settings['application']);
//			unset($this->settings['technology']);
//			unset($this->settings['products']);
//			unset($this->settings['categories']);
//		}
//
//		$this->settings['xo'] = $this->objectManager->get(\TYPO3\CMS\Extbase\Configuration\ConfigurationManager::class)->getConfiguration(
//			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
//			'xo'
//		);
//
//		// keine Anzeige der Box individuelles Produkt
//		$this->settings['hideIndividualProduct'] = 1;
//
//		$demand = $this->getDemand($this->settings);
//		$products = $this->productRepository->findAll($demand);
//
//		if(empty($demand['records']) === false) {
//			$products = \Ps\Xo\Utilities\GeneralUtility::sortIterableByField($products, $demand['records'], function($value) {
//				if($value instanceof Product) {
//					return $value->getUid();
//				}
//
//				return null;
//			});
//		}
//
//		$this->view->assign('record', $this->configurationManager->getContentObject()->data);
//		$this->view->assign('products', $products);
//		$this->view->assign('settings', $this->settings);
	}


	/**
	 * @param \Ps\EntityProduct\Domain\Model\Product $product
	 * @return array
	 */
	protected function getProductVariants(Entity $product) {
//		$variants = [];
//
//		// moeglicherweise selbst das Elternelement
//		if($product->getParent() === null) {
//			$products = $this->productRepository->findAll(['parent' => $product->getUid()]);
//
//			// gibt es Varianten zu diesem Product?
//			if($products->count() !== 0) {
//
//				// Eltern-Produkt ebenfalls hinzufuegen
//				$variants[] = $product;
//
//				// weitere Unter-Produkte hinzufuegen
//				foreach($products as $value) {
//					$variants[] = $value;
//				}
//			}
//
//		// Produkt ist selbst eine Variante
//		} else {
//
//			// Eltern-Produkt ebenfalls hinzufuegen
//			$variants[] = $product->getParent();
//
//			// alle Unter-Produkte identifizieren und hinzufuegen
//			foreach($this->productRepository->findAll(['parent' => $product->getParent()->getUid()]) as $value) {
//				$variants[] = $value;
//			}
//		}
//
//		return $variants;
	}
}
