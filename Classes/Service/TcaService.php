<?php
namespace Ps\EntityProduct\Service;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class TcaService {

	/**
	 * @param array $configuration Current field configuration
	 * @throws \UnexpectedValueException
	 * @internal
	 */
	public function getProductAttributes(array &$configuration) {

		// Reset der bisherigen Eintraege
		$configuration['items'] = [];

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_attribute');
		$statement = $queryBuilder
			->select('uid', 'title')
			->from('tx_entityproduct_domain_model_attribute')
			->join(
				'tx_entityproduct_domain_model_attribute',
				'tx_entityproduct_product_attribute_mm',
				'tx_entityproduct_product_attribute_mm',
				$queryBuilder->expr()->eq('tx_entityproduct_product_attribute_mm.uid_foreign', $queryBuilder->quoteIdentifier('tx_entityproduct_domain_model_attribute.uid'))
			)
			->where(
				$queryBuilder->expr()->eq('tx_entityproduct_product_attribute_mm.uid_local', $queryBuilder->createNamedParameter($configuration['row']['uid'], Connection::PARAM_INT)),
				$queryBuilder->expr()->in('tx_entityproduct_domain_model_attribute.sys_language_uid', [0, -1])
			)
			->orderBy('tx_entityproduct_domain_model_attribute.title', 'ASC')
			->execute();

		while($row = $statement->fetch()) {
			$configuration['items'][] = [$row['title'], $row['uid']];
		}
	}
}