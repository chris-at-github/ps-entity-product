<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Controller;


use Ps\Entity\Controller\EntityController;
use Ps\EntityProduct\Domain\Model\Product;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
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
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$products = $this->productRepository->findAll();
		$this->view->assign('products', $products);
	}

	/**
	 * action show
	 *
	 * @param Product $product
	 * @return void
	 */
	public function showAction(Product $product) {
		$this->view->assign('product', $product);
	}
}
