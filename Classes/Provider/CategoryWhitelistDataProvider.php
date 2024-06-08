<?php

namespace Ps\EntityProduct\Provider;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class CategoryWhitelistDataProvider extends \Ps14\Site\Filter\DataProvider\AbstractDataProvider {

	/**
	 * @param array $data
	 * @param array $properties
	 * @return array
	 */
	public function provide($data, $properties) {
		$settings = $this->getFilter()->getSettings();
		$whitelist = [];
		$entities = [];

		if(isset($settings['productRange']) === true) {

			// Erstmal alle Produkte identifizieren, die mit dieser Produktgruppe verknuepft sind
			/** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder  $queryBuilder */
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_entity_domain_model_entity')->createQueryBuilder();
			$query = $queryBuilder->select('tx_entity_domain_model_entity.uid')
				->from('tx_entity_domain_model_entity')
				->innerJoin(
					'tx_entity_domain_model_entity',
					'sys_category_record_mm',
					'sys_category_record_mm',
					$queryBuilder->expr()->eq('sys_category_record_mm.uid_foreign', $queryBuilder->quoteIdentifier('tx_entity_domain_model_entity.uid'))
				)
				->where(
					$queryBuilder->expr()->in('tx_entity_domain_model_entity.sys_language_uid', [0, -1]),
					$queryBuilder->expr()->orX(
						$queryBuilder->expr()->eq('tx_entity_domain_model_entity.master_category', $queryBuilder->createNamedParameter($settings['productRange'], \PDO::PARAM_INT)),
						$queryBuilder->expr()->eq('sys_category_record_mm.uid_local', $queryBuilder->createNamedParameter($settings['productRange'], \PDO::PARAM_INT))
					)
				)
				->groupBy('tx_entity_domain_model_entity.uid');

			$statement = $query->execute();

			while($row = $statement->fetch()) {
				$entities[] = (int) $row['uid'];
			}

			// Jetzt alle Kategorien laden, die zu den Produkten passen
			if(empty($entities) === false) {

				/** @var \TYPO3\CMS\Core\Database\Query\QueryBuilder  $queryBuilder */
				$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_entity_domain_model_entity')->createQueryBuilder();
				$query = $queryBuilder->select('sys_category.parent', 'sys_category_record_mm.uid_local')
					->from('tx_entity_domain_model_entity')
					->innerJoin(
						'tx_entity_domain_model_entity',
						'sys_category_record_mm',
						'sys_category_record_mm',
						$queryBuilder->expr()->eq('sys_category_record_mm.uid_foreign', $queryBuilder->quoteIdentifier('tx_entity_domain_model_entity.uid'))
					)
					->innerJoin(
						'sys_category_record_mm',
						'sys_category',
						'sys_category',
						$queryBuilder->expr()->eq('sys_category.uid', $queryBuilder->quoteIdentifier('sys_category_record_mm.uid_local'))
					)
					->where(
						$queryBuilder->expr()->in('tx_entity_domain_model_entity.sys_language_uid', [0, -1]),
						$queryBuilder->expr()->eq('sys_category_record_mm.tablenames', $queryBuilder->createNamedParameter('tx_entity_domain_model_entity', \PDO::PARAM_STR)),
						$queryBuilder->expr()->eq('sys_category_record_mm.fieldname', $queryBuilder->createNamedParameter('categories', \PDO::PARAM_STR)),
						$queryBuilder->expr()->in('tx_entity_domain_model_entity.uid', $entities)
					);

				if(empty($settings['filterCategoryWhitelist']) === false) {
					$query->andWhere($queryBuilder->expr()->in('sys_category.parent', $settings['filterCategoryWhitelist']));
				}

				$statement = $query->execute();

				while($row = $statement->fetch()) {
					$whitelist[$row['parent']] = (int) $row['parent'];
					$whitelist[$row['uid_local']] = (int) $row['uid_local'];
				}
			}
		}

		return $whitelist;
	}
}