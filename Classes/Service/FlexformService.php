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

//		$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity_product');
//		$configuration['items'] = $this->getCategoriesByParent((int) $extensionConfiguration['parentMasterProductCategory']);
	}

	/**
	 * @param array $configuration Current field configuration
	 * @throws \UnexpectedValueException
	 * @internal
	 */
	public function getFilterCategoryWhitelistValues(array &$configuration) {

//		$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity_product');
//		$configuration['items'] = $this->getCategoriesByParent((int) $extensionConfiguration['parentFilterCategory']);
	}

	/**
	 * @param int $parent
	 * @return array
	 */
	protected function getCategoriesByParent(int $parent): array {
//		$items = [];
//
//		/** @var QueryBuilder $queryBuilder */
//		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
//		$statement = $queryBuilder
//			->select('uid', 'title')
//			->from('sys_category')
//			->where(
//				$queryBuilder->expr()->eq('parent', $queryBuilder->createNamedParameter((int) $parent, Connection::PARAM_INT)),
//				$queryBuilder->expr()->in('sys_language_uid', [0, -1])
//			)
//			->orderBy('sorting', 'ASC')
//			->execute();
//
//		while($row = $statement->fetch()) {
//			$items[] = [$row['title'], $row['uid'], 'mimetypes-x-sys_category'];
//		}
//
//		return $items;
	}
}