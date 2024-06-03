<?php
namespace Ps\EntityProduct\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class VariantFlexformProcessingService {

	/**
	 * @param int $variant
	 */
	protected function removeAttributeValues($variant) {
//
//		/** @var QueryBuilder $queryBuilder */
//		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_attributevalue');
//		$queryBuilder
//			->delete('tx_entityproduct_domain_model_attributevalue')
//			->where(
//				$queryBuilder->expr()->eq('variant', $queryBuilder->createNamedParameter($variant, \PDO::PARAM_INT))
//			)
//			->execute();
	}

	/**
	 * @param array $attribute
	 * @return int
	 */
	protected function insertAttributeValues($attribute): int {
//
//		/** @var Connection $connection */
//		$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_entityproduct_domain_model_attributevalue');
//		$connection->insert('tx_entityproduct_domain_model_attributevalue', $attribute);
//
//		return $connection->lastInsertId('tx_entityproduct_domain_model_attributevalue');
	}

	/**
	 * @param int $variant
	 * @param int $count
	 */
	protected function updateAttributeCount($variant, $count) {
//
//		// Die Anzahl der Attribute in der Variante pflegen
//		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_variant');
//		$queryBuilder
//			->update('tx_entityproduct_domain_model_variant')
//			->where(
//				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($variant, \PDO::PARAM_INT))
//			)
//			->set('attributes', $count, false)
//			->execute();
	}

	/**
	 * @param string $status
	 * @param string $table
	 * @param string $id
	 * @param array $fields
	 * @param $pObj
	 */
	function processDatamap_postProcessFieldArray($status, $table, $id, &$fields, &$cObject) {

//		if($table == 'tx_entityproduct_domain_model_variant' && isset($fields['pi_flexform']) === true) {
//
//			// Flexform Daten (Attribute-Uid, Attribut-Wert) aus dem Datensatz auslesen
//			/** @var FlexFormService $flexformService */
//			$flexformService = GeneralUtility::makeInstance(FlexFormService::class);
//			$flexformData = $flexformService->convertFlexFormContentToArray($fields['pi_flexform']);
//
//			$variant = BackendUtility::getRecord('tx_entityproduct_domain_model_variant', (int) $id);
//
//			// nur in der Hauptsprache durchfuehren -> Uebersetzungen werden hier gesteuert
//			if((int) $variant['sys_language_uid'] === 0) {
//
//				// Uebersetzungen auslesen
//				$translations = [];
//
//				/** @var QueryBuilder $queryBuilder */
//				$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_variant');
//				$statement = $queryBuilder
//					->select('uid', 'sys_language_uid')
//					->from('tx_entityproduct_domain_model_variant')
//					->where(
//						$queryBuilder->expr()->eq('l10n_parent', $queryBuilder->createNamedParameter((int) $id, \PDO::PARAM_INT))
//					)
//					->execute();
//
//				while($row = $statement->fetch()) {
//					$translations[(int) $row['sys_language_uid']] = (int) $row['uid'];
//				}
//
//				// bisherige Attribut-Werte aus der Datenbank loeschen
//				$this->removeAttributeValues($variant['uid']);
//
//				foreach($translations as $translation) {
//					$this->removeAttributeValues($translation);
//				}
//
//				// Die UIDs der Attribute auslesen die dem Hauptprodukt zugeordnet sind
//				$attributes = [];
//				$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_product_attribute_mm');
//				$statement = $queryBuilder
//					->select('uid_foreign AS uid')
//					->from('tx_entityproduct_product_attribute_mm')
//					->where(
//						$queryBuilder->expr()->eq('uid_local', $queryBuilder->createNamedParameter((int) $variant['product'], \PDO::PARAM_INT))
//					)
//					->orderBy('tx_entityproduct_product_attribute_mm.sorting', 'ASC')
//					->execute();
//
//				// Werte aus den Flexform-Daten in die Zwischentabelle schreiben
//				$count = 0;
//				while($attribute = $statement->fetch()) {
//					if(isset($flexformData[(int) $attribute['uid']]) === true) {
//						$count++;
//						$attributeValueId = $this->insertAttributeValues([
//							'pid' => (int) $variant['pid'],
//							'tstamp' => time(),
//							'crdate' => time(),
//							'cruser_id' => $GLOBALS['BE_USER']->user['uid'],
//							'sorting' => $count,
//							'variant' => (int) $variant['uid'],
//							'attribute' => (int) $attribute['uid'],
//							'value' => $flexformData[(int) $attribute['uid']]
//						]);
//
//						foreach($translations as $sysLanguageUid => $l10nParent) {
//							$this->insertAttributeValues([
//								'pid' => (int) $variant['pid'],
//								'tstamp' => time(),
//								'crdate' => time(),
//								'cruser_id' => $GLOBALS['BE_USER']->user['uid'],
//								'sorting' => $count,
//								'variant' => (int) $l10nParent,
//								'attribute' => (int) $attribute['uid'],
//								'value' => $flexformData[(int) $attribute['uid']],
//								'sys_language_uid' => (int) $sysLanguageUid,
//								'l10n_parent' => (int) $attributeValueId
//							]);
//						}
//					}
//				}
//
//				// Die Anzahl der Attribute in der Variante pflegen
//				$this->updateAttributeCount($variant['uid'], $count);
//
//				foreach($translations as $translation) {
//					$this->updateAttributeCount($translation, $count);
//				}
//			}
//		}
	}
}