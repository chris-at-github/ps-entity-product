<?php
namespace Ps\EntityProduct\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Service\FlexFormService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class VariantFlexformProcessingService {

	/**
	 * @param string $status
	 * @param string $table
	 * @param string $id
	 * @param array $fields
	 * @param $pObj
	 */
	function processDatamap_postProcessFieldArray($status, $table, $id, &$fields, &$cObject) {

		if($table == 'tx_entityproduct_domain_model_variant' && isset($fields['pi_flexform']) === true) {

			$variant = BackendUtility::getRecord('tx_entityproduct_domain_model_variant', (int) $id);

			// Flexform Daten (Attribute-Uid, Attribut-Wert) aus dem Datensatz auslesen
			/** @var FlexFormService $flexformService */
			$flexformService = GeneralUtility::makeInstance(FlexFormService::class);
			$flexformData = $flexformService->convertFlexFormContentToArray($fields['pi_flexform']);

			// bisherige Attribut-Werte aus der Datenbank loeschen
			/** @var QueryBuilder $queryBuilder */
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_attributevalue');
			$statement = $queryBuilder
				->delete('tx_entityproduct_domain_model_attributevalue')
				->where(
					$queryBuilder->expr()->eq('variant', $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT))
				)
				->execute();

			// Die UIDs der Attribute auslesen die dem Hauptprodukt zugeordnet sind
			$attributes = [];
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_product_attribute_mm');
			$statement = $queryBuilder
				->select('uid_foreign AS uid')
				->from('tx_entityproduct_product_attribute_mm')
				->where(
					$queryBuilder->expr()->eq('uid_local', $queryBuilder->createNamedParameter((int) $variant['product'], \PDO::PARAM_INT))
				)
				->orderBy('tx_entityproduct_product_attribute_mm.sorting', 'ASC')
				->execute();

			// Attribute-Werte neue in die Linktabelle von Varianten und Attributen abspeichern
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_attributevalue');

			$count = 0;
			while($attribute = $statement->fetch()) {
				if(isset($flexformData[(int) $attribute['uid']]) === true) {

					$count++;
					$queryBuilder
						->insert('tx_entityproduct_domain_model_attributevalue')
						->values([
							'pid' => (int) $variant['pid'],
							'tstamp' => time(),
							'crdate' => time(),
							'cruser_id' => $GLOBALS['BE_USER']->user['uid'],
							'sorting' => $count,
							'variant' => (int) $variant['uid'],
							'attribute' => (int) $attribute['uid'],
							'value' => $flexformData[(int) $attribute['uid']]
						])
						->execute();
				}
			}

			// Die Anzahl der Attribute in der Variante pflegen
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_variant');
			$statement = $queryBuilder
				->update('tx_entityproduct_domain_model_variant')
				->where(
					$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT))
				)
				->set('attributes', $count, false)
				->execute();
		}
	}
}