<?php
declare(strict_types=1);

namespace Ps\EntityProduct\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
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
 * The repository for KeyFacts
 */
class KeyFactRepository extends \Ps14\Foundation\Domain\Repository\Repository {

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param array $options
	 * @return array
	 */
	protected function getMatches($query, $options) {
		$matches = parent::getMatches($query, $options);

		// Inhalt
		if(isset($options['content']) === true) {
			$matches['content'] = $query->equals('content', (int) $options['content']);
		}

		return $matches;
	}
}
