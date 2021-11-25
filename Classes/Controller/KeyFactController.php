<?php

namespace Ps\EntityProduct\Controller;


use Ps\Entity\Controller\EntityController;
use Ps\EntityProduct\Domain\Model\KeyFact;
use Ps\EntityProduct\Domain\Model\Product as Entity;
use Ps\EntityProduct\Domain\Repository\KeyFactRepository;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use Ps\EntityProduct\Provider\LineChartDataProvider;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/***
 *
 * This file is part of the "Product" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Christian Pschorr <pschorr.christian@gmail.com>
 *
 ***/

/**
 * KeyFactsController
 */
class KeyFactController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController{

	/**
	 * @var KeyFactRepository
	 */
	protected $keyFactRepository = null;

	/**
	 * @param ProductRepository $productRepository
	 */
	public function injectKeyFactRepository(KeyFactRepository $keyFactRepository) {
		$this->keyFactRepository = $keyFactRepository;
	}

	/**
	 * @param array $overwrite
	 * @return array
	 */
	protected function getDemand($overwrite = []) {
		$options = [
			'records' => []
		];

		if(empty($this->settings['keyFacts']) === false) {
			$options['records'] = GeneralUtility::intExplode(',', $this->settings['keyFacts']);
		}

		return $options;
	}

	/**
	 * @return void
	 */
	public function listingAction() {
		$demand = $this->getDemand();
		$keyFacts = null;

		if(empty($demand['records']) === false) {
			$keyFacts = \Ps\Xo\Utilities\GeneralUtility::sortIterableByField($this->keyFactRepository->findAll($demand), $demand['records'], function($value) {
				if($value instanceof KeyFact) {
					return $value->getUid();
				}

				return null;
			});
		}

		$this->view->assign('keyFacts', $keyFacts);
	}
}
