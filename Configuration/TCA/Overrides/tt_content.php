<?php

// ---------------------------------------------------------------------------------------------------------------------
// Weitere Felder in TT-Content
$tmpEnityProductTtContentColumns = [
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
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tmpEnityProductTtContentColumns);

// ---------------------------------------------------------------------------------------------------------------------
// Definition Content Element
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
	array(
		'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:tx_entity_product_keyfact.name',
		'entityproduct_keyfacts',
		'ps14-content-keyfacts'
	),
	'CType',
	'entity_product'
);

$GLOBALS['TCA']['tt_content']['types']['entityproduct_keyfacts'] = [
	'showitem' => '
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;xoHeader, tx_entityproduct_keyfacts,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
			--palette--;;hidden,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
			--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
		--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
	',
];

// ---------------------------------------------------------------------------------------------------------------------
// Frontend Plugin Einstellungen

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_frontend'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_frontend', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/Frontend.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_keyfact'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_keyfact', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/KeyFact.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_teaser'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_teaser', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/Teaser.xml');