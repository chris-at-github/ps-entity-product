<?php
namespace Ps\EntityProduct\Service;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FlexformService {

	/**
	 * @param array $configuration Current field configuration
	 * @throws \UnexpectedValueException
	 * @internal
	 */
	public function getProductRangeValues(array &$configuration) {

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
		$statement = $queryBuilder
			->select('uid', 'title')
			->from('sys_category')
			->where(
				$queryBuilder->expr()->in('parent', $queryBuilder->createNamedParameter(4, Connection::PARAM_INT))
			)
			->execute();

		while($row = $statement->fetch()) {
			$configuration['items'][] = [$row['title'], $row['uid']];
		}
	}
}