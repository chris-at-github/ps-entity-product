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
class AirConsumptionFallbackController extends EntityController {

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
	 * @param \Ps\EntityProduct\Domain\Model\Product $product
	 * @param string $fallback
	 * @return boolean
	 */
	public function saveAction($product, string $fallback) {
//		if(empty($fallback) === false && (int) preg_match('/^data:image\/png;base64,.+/', trim($fallback)) === 1) {
			$product->setAirConsumptionFallback($fallback);
			$this->productRepository->update($product);
//		}

		return true;
	}
}
