<?php

(function () {

	// -------------------------------------------------------------------------------------------------------------------
	// Weitere Felder in Content
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
		'tx_entityproduct_keyfacts' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tt_content.tx_entityproduct_keyfacts',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_entityproduct_domain_model_keyfact',
				'foreign_field' => 'content',
				'foreign_sortby' => 'sorting',
				'foreign_label' => 'title',
				'maxitems' => 999,
				'appearance' => [
					'collapseAll' => 1,
					'expandSingle' => 1,
					'showAllLocalizationLink' => 1,
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showRemovedLocalizationRecords' => 1,
					'newRecordLinkAddTitle' => 1
				],
			]
		],
	]);

	// -------------------------------------------------------------------------------------------------------------------
	// Modul in TYPO3 tt_content registrieren
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
		array(
			'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:keyfact.title',
			'entityproduct_keyfacts',
			'entity-product-plugin'
		),
		'CType',
		'entity_product'
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Definition Content Element
	$GLOBALS['TCA']['tt_content']['types']['entityproduct_keyfacts']['showitem'] = \Ps14\Site\Service\TcaService::getShowitem(
		['general', 'appearance', 'language', 'access', 'categories', 'notes', 'extended'],
		[
			'general' => '--palette--;;general, --palette--;;headers, --palette--;;foundation_identifier, tx_entityproduct_keyfacts,'
		]
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Frontend Plugin Einstellungen
	// @todo v12
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_frontend'] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_frontend', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/Frontend.xml');

	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_keyfact'] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_keyfact', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/KeyFact.xml');

	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_teaser'] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_teaser', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/Teaser.xml');
})();
