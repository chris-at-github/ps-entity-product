<?php

namespace Ps\EntityProduct\Provider;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use FluidTYPO3\Flux\Provider\ProviderInterface;
use FluidTYPO3\Flux\Form\Transformation\FormDataTransformer;
use FluidTYPO3\Flux\Service\WorkspacesAwareRecordService;
use FluidTYPO3\Flux\Builder\ViewBuilder;
use FluidTYPO3\Flux\Service\CacheService;
use FluidTYPO3\Flux\Service\TypoScriptService;

//class ChartDataValueProvider {
class ChartDataValueProvider extends \Ps14\Chart\Provider\DataValueProvider implements ProviderInterface {

	/**
	 * @var integer
	 */
	protected int $priority = 100;

	public function __construct(
		FormDataTransformer $formDataTransformer,
		WorkspacesAwareRecordService $recordService,
		ViewBuilder $viewBuilder,
		CacheService $cacheService,
		TypoScriptService $typoScriptService
	) {
		parent::__construct($formDataTransformer, $recordService, $viewBuilder, $cacheService, $typoScriptService);
	}

	/**
	 * @param array $row
	 * @return int
	 */
	protected function getChartUid(array $row): int {
		$uid = 0;

		if(isset($row['tx_entityproduct_product']) === false) {
			$request = GeneralUtility::_GP('ajax');

			// Content UID aus dem Ajax-Request auslesen
			if(isset($request[0]) === true && preg_match('/(.*)-(.*)-(\d+)-(.*)-(.*)$/', $request[0], $match)) {
				if($match[2] === 'tx_entity_domain_model_entity') {
					$row = [
						'tx_entityproduct_product' => (int) $match[3]
					];

				} elseif($match[2] === 'tt_content') {
					$row = [
						'content' => (int) $match[3]
					];
				}
			}
		}

		if(empty($row['tx_entityproduct_product']) === false) {
			$parent = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tx_entity_domain_model_entity', (int) $row['tx_entityproduct_product'], 'tx_chart_chart');

		} elseif(empty($row['content']) === false) {
			$parent = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tt_content', (int) $row['content'], 'tx_chart_chart');
		}

		if(empty($parent['tx_chart_chart']) === false) {
			$uid = (int) $parent['tx_chart_chart'];
		}

		return $uid;
	}
}