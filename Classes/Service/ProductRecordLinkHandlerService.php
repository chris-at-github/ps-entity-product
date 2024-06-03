<?php
namespace Ps\EntityProduct\Service;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class ProductRecordLinkHandlerService {

	/**
	 * @var ContentObjectRenderer
	 */
	public ContentObjectRenderer $cObj;

	/**
	 * @param int $categoryUid
	 * @return int
	 */
	protected function getMasterCategoryPageUid(int $categoryUid): int {
//
//		/** @var QueryBuilder $queryBuilder */
//		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
//		$statement = $queryBuilder
//			->select('uid', 'tx_entity_page')
//			->from('sys_category')
//			->where(
//				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter((int) $categoryUid, Connection::PARAM_INT))
//			)
//			->execute();
//
//		$row = $statement->fetch();
//
//		if(empty($row) === false) {
//			return (int) $row['tx_entity_page'];
//		}

		return 0;
	}

	/**
	 * @param $entityUid
	 * @return array
	 */
	protected function getEntityRecord($entityUid) {
//
//		/** @var QueryBuilder $queryBuilder */
//		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entity_domain_model_entity');
//		$statement = $queryBuilder
//			->select('*')
//			->from('tx_entity_domain_model_entity')
//			->where(
//				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($entityUid, \PDO::PARAM_INT))
//			)
//			->execute();
//
//		return $statement->fetch();
	}

	/**
	 * @param array $configuration Current field configuration
	 * @param array $options Current field configuration
	 * @throws \UnexpectedValueException
	 * @see https://www.derhansen.de/2022/01/typo3-multiple-dynamic-typolink-parameters.html
	 */
	public function createProductLink(&$configuration, array $options) {
//		$productUid = (int) $this->cObj->cObjGetSingle($options['productUid'], $options['productUid.']);
//		$productRecord = $this->getEntityRecord($productUid);
//		$parameters = [
//			'parameter' => 1,
//			'returnLast' => 'url',
//		];
//
//		if(empty($productRecord) === false && empty($productRecord['master_category']) === false) {
//			$parameters['parameter'] = $this->getMasterCategoryPageUid($productRecord['master_category']);
//			$parameters['additionalParams'] = '&' . http_build_query([
//				'tx_entityproduct_frontend' => [
//					'controller' => 'Product',
//					'action' => 'show',
//					'product' => $productUid,
//				]
//			]);
//		}
//
//		return '<a href="' . $this->cObj->typoLink('', $parameters) . '">';
		return '';
	}
}