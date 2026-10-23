<?php

namespace Ps\EntityProduct\EventListener;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Configuration\Event\AfterFlexFormDataStructureIdentifierInitializedEvent;
use TYPO3\CMS\Core\Configuration\Event\BeforeFlexFormDataStructureParsedEvent;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Baut das FlexForm der Druckluftdaten (tx_chart_domain_model_value.pi_flexform) dynamisch auf:
 * ein Feld fuer die X-Achse und je Datenreihe des Diagramms am Produkt ein Feld fuer die Y-Achse.
 *
 * Ersetzt den frueheren flux-Provider. Blatt- und Feldnamen (options, valueAxisX, Datenreihen-Uid) muessen gleich
 * bleiben, damit die gespeicherten Werte weiterhin gelesen werden.
 */
class ChartValueFlexFormEventListener {

	protected const TABLE = 'tx_chart_domain_model_value';
	protected const FIELD = 'pi_flexform';
	protected const IDENTIFIER_TYPE = 'entityproduct-chart-value';

	/**
	 * Kennung mit der Uid des Diagramms anreichern -> das Diagramm haengt am Produkt (tx_entityproduct_product)
	 *
	 * @param AfterFlexFormDataStructureIdentifierInitializedEvent $event
	 * @return void
	 */
	public function setIdentifier(AfterFlexFormDataStructureIdentifierInitializedEvent $event): void {
		if($event->getTableName() !== self::TABLE || $event->getFieldName() !== self::FIELD) {
			return;
		}

		$event->setIdentifier([
			'type' => self::IDENTIFIER_TYPE,
			'tableName' => self::TABLE,
			'fieldName' => self::FIELD,
			'chart' => $this->getChartUid($event->getRow()),
		]);
	}

	/**
	 * @param BeforeFlexFormDataStructureParsedEvent $event
	 * @return void
	 */
	public function setDataStructure(BeforeFlexFormDataStructureParsedEvent $event): void {
		$identifier = $event->getIdentifier();

		if(($identifier['type'] ?? '') !== self::IDENTIFIER_TYPE) {
			return;
		}

		$event->setDataStructure($this->getDataStructure((int) ($identifier['chart'] ?? 0)));
	}

	/**
	 * @param array $row
	 * @return int
	 */
	protected function getChartUid(array $row): int {
		$productUid = (int) ($row['tx_entityproduct_product'] ?? 0);

		if($productUid === 0) {
			return 0;
		}

		$product = BackendUtility::getRecord('tx_entity_domain_model_entity', $productUid, 'tx_chart_chart');

		return (int) ($product['tx_chart_chart'] ?? 0);
	}

	/**
	 * @param int $chartUid
	 * @return array
	 */
	protected function getDataStructure(int $chartUid): array {
		$elements = [];
		$chart = $chartUid > 0 ? BackendUtility::getRecord('tx_chart_domain_model_chart', $chartUid, 'label_axis_x, data_type_axis_x, data_type_axis_y') : null;

		if(empty($chart) === false) {
			$elements['valueAxisX'] = [
				'label' => $chart['label_axis_x'],
				'config' => $this->getFieldConfiguration((string) $chart['data_type_axis_x']),
			];

			foreach($this->getDatasets($chartUid) as $dataset) {
				$elements[$dataset['uid']] = [
					'label' => $dataset['title'],
					'config' => $this->getFieldConfiguration((string) $chart['data_type_axis_y']),
				];
			}
		}

		return [
			'sheets' => [
				'options' => [
					'ROOT' => [
						'type' => 'array',
						'el' => $elements,
					],
				],
			],
		];
	}

	/**
	 * @param int $chartUid
	 * @return array
	 */
	protected function getDatasets(int $chartUid): array {
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_chart_domain_model_dataset');
		$queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

		return $queryBuilder
			->select('uid', 'title')
			->from('tx_chart_domain_model_dataset')
			->where(
				$queryBuilder->expr()->eq('chart', $queryBuilder->createNamedParameter($chartUid, Connection::PARAM_INT))
			)
			->orderBy('sorting')
			->executeQuery()
			->fetchAllAssociative();
	}

	/**
	 * @param string $dataType
	 * @return array
	 */
	protected function getFieldConfiguration(string $dataType): array {
		if($dataType === 'int') {
			return ['type' => 'number', 'size' => 40];
		}

		if($dataType === 'float') {
			return ['type' => 'input', 'size' => 40, 'eval' => \Ps14\Chart\Evaluation\FloatEvaluation::class];
		}

		return ['type' => 'input', 'size' => 40, 'eval' => 'trim'];
	}
}
