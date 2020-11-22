<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Controller;


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
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * productRepository
     * 
     * @var \Ps\EntityProduct\Domain\Repository\ProductRepository
     */
    protected $productRepository = null;

    /**
     * @param \Ps\EntityProduct\Domain\Repository\ProductRepository $productRepository
     */
    public function injectProductRepository(\Ps\EntityProduct\Domain\Repository\ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $products = $this->productRepository->findAll();
        $this->view->assign('products', $products);
    }

    /**
     * action show
     * 
     * @param \Ps\EntityProduct\Domain\Model\Product $product
     * @return void
     */
    public function showAction(\Ps\EntityProduct\Domain\Model\Product $product)
    {
        $this->view->assign('product', $product);
    }
}
