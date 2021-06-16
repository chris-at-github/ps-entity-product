<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Domain\Repository;

use Ps\Entity\Domain\Repository\EntityRepository;
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
 * The repository for Products
 */
class ProductRepository extends EntityRepository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param array $options
	 * @return array
	 */
	protected function getMatches($query, $options) {
		$matches = parent::getMatches($query, $options);

		// Kategorien ist ein verschachteltes Array categories[group][<int>]
		if(isset($options['categories']) === true) {
			foreach($options['categories'] as $categories) {
				$or = [];

				foreach($categories as $category) {
					$or[] = $query->contains('categories', (int) $category);
				}

				if(empty($or) === false) {
					$matches[] = $query->logicalOr($or);
				}
			}
		}

		return $matches;
	}
}
