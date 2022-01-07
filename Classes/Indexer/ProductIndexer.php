<?php
// Set you own vendor name.
// Adjust the extension name part of the namespace to your extension key.
namespace Ps\EntityProduct\Indexer;

use Tpwd\KeSearch\Domain\Repository\IndexRepository;
use Tpwd\KeSearch\Domain\Repository\TtNewsRepository;
use Tpwd\KeSearch\Indexer\IndexerBase;
use Tpwd\KeSearch\Indexer\IndexerRunner;
use Tpwd\KeSearch\Lib\SearchHelper;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

// Set you own class name.
class ProductIndexer extends IndexerBase {

	// Set a key for your indexer configuration.
	// Add this key to the $GLOBALS[...] array in Configuration/TCA/Overrides/tx_kesearch_indexerconfig.php, too!
	// It is recommended (but no must) to use the name of the table you are going to index as a key because this
	// gives you the "original row" to work with in the result list template.
	const KEY = 'tx_entity_domain_model_entity';

	/**
	 * @var array
	 */
	protected $masterCategories = [];

//	/**
//	 * @param $pObj
//	 */
//	public function __construct($pObj) {
//		parent::__construct($pObj);
//	}

	/**
	 * @param int $categoryUid
	 * @return int
	 * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
	 * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
	 */
	protected function getMasterCategoryPage(int $categoryUid): int {
		if(empty($this->masterCategories) === true) {
			$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity_product');

			/** @var QueryBuilder $queryBuilder */
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
			$statement = $queryBuilder
				->select('uid', 'tx_entity_page')
				->from('sys_category')
				->where(
					$queryBuilder->expr()->eq('parent', $queryBuilder->createNamedParameter((int)$extensionConfiguration['parentMasterProductCategory'], Connection::PARAM_INT)),
					$queryBuilder->expr()->in('sys_language_uid', [0, -1])
				)
				->execute();

			while($row = $statement->fetch()) {
				$this->masterCategories[(int)$row['uid']] = (int) $row['tx_entity_page'];
			}
		}

		if(array_key_exists($categoryUid, $this->masterCategories) === true) {
			return $this->masterCategories[$categoryUid];
		}

		return 0;
	}

	/**
	 * @param string $value
	 * @return string
	 */
	protected function cleanFieldValue(string $value): string {
		// following lines prevents having words one after the other like: HelloAllTogether
		$value = str_replace('<td', ' <td', $value);
		$value = str_replace('<br', ' <br', $value);
		$value = str_replace('<p', ' <p', $value);
		$value = str_replace('<li', ' <li', $value);

		// remove script and style tags
		// thanks to the wordpress project
		// https://core.trac.wordpress.org/browser/tags/5.3/src/wp-includes/formatting.php#L5178
		$value = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $value);

		// remove other tags
		$value = strip_tags($value);

		return $value;
	}

	/**
	 * @param $record
	 * @return string
	 */
	protected function getKeyFacts($record) {

		$keyFacts = '';

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_product_keyfact_mm');
		$statement = $queryBuilder
			->select('uid_foreign')
			->from('tx_entityproduct_product_keyfact_mm')
			->where(
				$queryBuilder->expr()->eq('uid_local', $queryBuilder->createNamedParameter($record['uid'], Connection::PARAM_INT))
			)
			->execute();

		while($row = $statement->fetch()) {
			$mm[] = (int) $row['uid_foreign'];
		}

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entityproduct_domain_model_keyfact');
		$statement = $queryBuilder
			->select('*')
			->from('tx_entityproduct_domain_model_keyfact')
			->where(
				$queryBuilder->expr()->in('l10n_parent', $mm),
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter((int) $record['sys_language_uid'], Connection::PARAM_INT))
			)
			->execute();

		while($row = $statement->fetch()) {
			$keyFacts .= ' ' . $this->cleanFieldValue($row['title']);
			$keyFacts .= ' ' . $this->cleanFieldValue($row['description']);
		}

		return $keyFacts;
	}

	/**
	 * @param array $record
	 * @param string $foreignField
	 * @return string
	 */
	protected function getElementRecords($record, $foreignField) {

		$elements = '';

		/** @var QueryBuilder $queryBuilder */
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_xo_domain_model_elements');
		$statement = $queryBuilder
			->select('*')
			->from('tx_xo_domain_model_elements')
			->where(
				$queryBuilder->expr()->in('foreign_uid', $queryBuilder->createNamedParameter($record['uid'], Connection::PARAM_INT)),
				$queryBuilder->expr()->eq('foreign_field', $queryBuilder->createNamedParameter($foreignField, Connection::PARAM_STR)),
				$queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter((int) $record['sys_language_uid'], Connection::PARAM_INT))
			)
			->execute();

		while($row = $statement->fetch()) {
			$elements .= ' ' . $this->cleanFieldValue($row['title']);
			$elements .= ' ' . $this->cleanFieldValue($row['description']);
		}

		return $elements;
	}

	/**
	 * Adds the custom indexer to the TCA of indexer configurations, so that
	 * it's selectable in the backend as an indexer type, when you create a
	 * new indexer configuration.
	 *
	 * @param array $params
	 * @param object $pObj
	 */
	public function registerIndexerConfiguration(&$params, $pObj)	{

		// Set a name and an icon for your indexer.
		$productIndexer = array(
			'Product-Indexer (ext:entity_product)',
			ProductIndexer::KEY,
			'EXT:ke_search_hooks/customnews-indexer-icon.gif'
		);
		$params['items'][] = $productIndexer;
	}

	/**
	 * @param array $indexerConfig Configuration from TYPO3 Backend.
	 * @param IndexerRunner $indexerObject Reference to indexer class.
	 * @return string Message containing indexed elements.
	 */
	public function startIncrementalIndexing(array &$indexerConfig, IndexerRunner &$indexerObject): string {
		$content = '';

		$this->indexingMode = self::INDEXING_MODE_INCREMENTAL;

		$content .= $this->customIndexer($indexerConfig, $indexerObject);
		$content .= $this->removeDeleted($indexerConfig);

		return $content;
	}

	/**
	 * @param   array $indexerConfig Configuration from TYPO3 Backend.
	 * @param   IndexerRunner $indexerObject Reference to indexer class.
	 * @return  string Message containing indexed elements.
	 */
	public function customIndexer(array &$indexerConfig, IndexerRunner &$indexerObject): string {
		if($indexerConfig['type'] == ProductIndexer::KEY) {

			// Doctrine DBAL using Connection Pool.
			/** @var Connection $connection */
			$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_entity_domain_model_entity');
			$queryBuilder = $connection->createQueryBuilder();

			// Handle restrictions.
			// Don't fetch hidden or deleted elements, but the elements
			// with frontend user group access restrictions or time (start / stop)
			// restrictions in order to copy those restrictions to the index.
			$queryBuilder
				->getRestrictions()
				->removeAll()
				->add(GeneralUtility::makeInstance(DeletedRestriction::class))
				->add(GeneralUtility::makeInstance(HiddenRestriction::class));

			$folders = GeneralUtility::intExplode(',', $indexerConfig['sysfolder']);
			$queryBuilder
				->select('*')
				->from('tx_entity_domain_model_entity')
				->where(
					$queryBuilder->expr()->in( 'pid', $folders),
					$queryBuilder->expr()->eq('tx_extbase_type', $queryBuilder->createNamedParameter(\Ps\EntityProduct\Domain\Model\Product::class, \PDO::PARAM_STR))
				);

			// in incremental mode get only news which have been modified since last indexing time
			if($this->indexingMode == self::INDEXING_MODE_INCREMENTAL) {
				$queryBuilder->andWhere($queryBuilder->expr()->gte('tstamp', $this->lastRunStartTime));
			}

			$statement = $queryBuilder->execute();

			// Loop through the records and write them to the index.
			$counter = 0;

			while ($record = $statement->fetch()) {

				// -------------------------------------------------------------------------------------------------------------
				// Title
				$title = strip_tags($record['title']);

				if(empty($record['parent']) === false && empty($record['variant_title']) === false) {
					$title .= ' / ' . strip_tags($record['variant_title']);
				}

				// -------------------------------------------------------------------------------------------------------------
				// Texts
				$abstract = '';
				$fullContent = '';

				foreach(['subtitle', 'long_description', 'options'] as $fieldName) {
					if(empty($record[$fieldName]) === false) {
						$fullContent .= ' ' . $this->cleanFieldValue($record[$fieldName]);
					}
				}

				// -------------------------------------------------------------------------------------------------------------
				// Key Facts
				if(empty($record['key_facts']) === false) {
					$fullContent .= $this->getKeyFacts($record);
				}

				// -------------------------------------------------------------------------------------------------------------
				// Technical Features
				if(empty($record['technical_features']) === false) {
					$fullContent .= $this->getElementRecords($record, 'technical_features');
				}

				// -------------------------------------------------------------------------------------------------------------
				// Technical Features
				if(empty($record['system_installation_legend']) === false) {
					$fullContent .= $this->getElementRecords($record, 'system_installation_legend');
				}

				// -------------------------------------------------------------------------------------------------------------
				// Target Link
				$params = '&tx_entityproduct_frontend[product]=' . $record['uid']
					. '&tx_entityproduct_frontend[controller]=Product&tx_entityproduct_frontend[action]=show';

				$targetPid = $this->getMasterCategoryPage($record['master_category']);

				// -------------------------------------------------------------------------------------------------------------
				// Tags
				$tags = '';

				// -------------------------------------------------------------------------------------------------------------
				// Additional Fields
				$additionalFields = array(
					'orig_uid' => $record['uid'],
					'orig_pid' => $record['pid'],
					'sortdate' => $record['tstamp'],
				);

				// -------------------------------------------------------------------------------------------------------------
				// Sorting
				$additionalFields['mysorting'] = $record['sorting'];

				// -------------------------------------------------------------------------------------------------------------
				// Store
				$indexerObject->storeInIndex(
					$indexerConfig['storagepid'],   // storage PID
					$title,            							// record title
					ProductIndexer::KEY,			// content type
					$targetPid,    									// target PID: where is the single view?
					$fullContent,                   // indexed content, includes the title (linebreak after title)
					$tags,                          // tags for faceted search
					$params,                        // typolink params for singleview
					$abstract,                      // abstract; shown in result list if not empty
					$record['sys_language_uid'],    // language uid
					$record['starttime'],           // starttime
					$record['endtime'],             // endtime
					$record['fe_group'],            // fe_group
					false,               // debug
					$additionalFields               // additionalFields
				);

				$counter++;
			}

			return $counter . ' Products have been indexed.';
		}

		return '';
	}

	/**
	 * @param array $indexerConfig Configuration from TYPO3 Backend.
	 * @return string
	 */
	public function removeDeleted($indexerConfig): string {

		/** @var IndexRepository $indexRepository */
		$indexRepository = GeneralUtility::makeInstance(IndexRepository::class);

		// Doctrine DBAL using Connection Pool.
		/** @var Connection $connection */
		$connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_entity_domain_model_entity');
		$queryBuilder = $connection->createQueryBuilder();

		$queryBuilder
			->getRestrictions()
			->removeAll();

		$folders = GeneralUtility::intExplode(',', $indexerConfig['sysfolder']);
		$statement = $queryBuilder
			->select('*')
			->from('tx_entity_domain_model_entity')
			->where(
				$queryBuilder->expr()->in('pid', $folders),
				$queryBuilder->expr()->eq('tx_extbase_type', $queryBuilder->createNamedParameter(\Ps\EntityProduct\Domain\Model\Product::class, \PDO::PARAM_STR)),
				$queryBuilder->expr()->gte('tstamp', $this->lastRunStartTime),
				 $queryBuilder->expr()->orX(
					 $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
					 $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT))
				 )
			)->execute();

		// Loop through the records and write them to the index.
		$counter = 0;

		while($record = $statement->fetch()) {
			$counter++;
			$indexRepository->deleteByUniqueProperties($record['uid'], $indexerConfig['storagepid'], ProductIndexer::KEY, $record['sys_language_uid']);
		}

		return LF . 'Found ' . $counter . ' deleted and hidden record(s).';
	}
}