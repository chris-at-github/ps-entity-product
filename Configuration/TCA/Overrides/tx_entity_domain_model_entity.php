<?php

//$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity_product');

// ---------------------------------------------------------------------------------------------------------------------
// Neuer Extbase-Typ
if(isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']) === true) {
	$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']['config']['items'][] = ['LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tx_extbase_type.product', \Ps\EntityProduct\Domain\Model\Product::class];
}

// ---------------------------------------------------------------------------------------------------------------------
// Neue Paletten
$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['layout'] = [
	'showitem' => 'layout,',
];

//$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['attributes'] = [
//	'showitem' => 'attributes,'
//];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['variant'] = [
	'showitem' => 'variant_title, parent,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['air_consumption'] = [
	'showitem' => 'tx_chart_chart, --linebreak--, tx_chart_values, --linebreak--, air_consumption_data, --linebreak--, air_consumption_media, --linebreak--, air_consumption_fallback,'
];

//$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['variants'] = [
//	'showitem' => 'grouped_attributes, --linebreak--, variants,'
//];

//$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['configurator'] = [
//	'showitem' => 'show_configurator, --linebreak--, configurator_filter_attributes, --linebreak--, configurator_result_attributes,'
//];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['extended'] = [
	'showitem' => 'system_installation_media, --linebreak--, system_installation_legend, --linebreak--, technical_features, --linebreak--, technical_features_description, --linebreak--, options, --linebreak--, accesories_description,'
];

$GLOBALS['TCA']['tt_address']['palettes']['product_hidden'] = [
	'showitem' => 'tx_extbase_type',
	'isHiddenPalette' => 0
];
// ---------------------------------------------------------------------------------------------------------------------
// Neue Felder
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_entity_domain_model_entity', [
	'layout' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'onChange' => 'reload',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.layout',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
			'items' => [
				['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.layout.default', ''],
				['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.layout.accessories', 'accessories'],
				['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.layout.cleaning-machines', 'cleaning-machines'],
			],
			'size' => 1,
			'maxitems' => 1,
			'multiple' => 0,
		],
	],
	'technical_data' => [
		'exclude' => true,
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_data',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'ps14Default',
			'fieldControl' => [
				'fullScreenRichtext' => [
					'disabled' => false,
				],
			],
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim',
		],
	],
	'technical_drawings' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_drawings',
		'config' => [
			'type' => 'file',
			'maxitems' => 99,
			'appearance' => [
				'collapseAll' => true,
				'fileUploadAllowed' => false,
			],
			'overrideChildTca' => [
				'columns' => [
					'crop' => [
						'config' => [
							'cropVariants' => \Ps14\Site\Service\TcaService::getCropVariants(
								[
									'fullsize' => [
										'allowedAspectRatios' => ['NaN'],
										'selectedRatio' => 'NaN'
									],
									'thumbnail' => [
										'allowedAspectRatios' => ['NaN'],
										'selectedRatio' => 'NaN'
									],
								]
							)
						],
					]
				]
			],
			'behaviour' => [
				'allowLanguageSynchronization' => true
			],
			'allowed' => 'common-image-types',
		],
	],
	'applications' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.applications',
		'config' => [
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'foreign_table' => 'pages',
			'MM' => 'tx_entityproduct_product_applications_mm',
			'maxitems' => 999,
			'size' => 4,
		],
	],
	'technology' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technology',
		'config' => [
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'foreign_table' => 'pages',
			'maxitems' => 1,
			'size' => 1,
		],
	],
//	'attributes' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.attributes',
//		'config' => [
//			'type' => 'select',
//			'renderType' => 'selectMultipleSideBySide',
//			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
//			'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_attribute}.{#sys_language_uid} IN (0, -1) ORDER BY tx_entityproduct_domain_model_attribute.title ASC',
//			'MM' => 'tx_entityproduct_product_attribute_mm',
//			'size' => 10,
//			'autoSizeMax' => 30,
//			'maxitems' => 999,
//			'multiple' => 0,
//			'fieldControl' => [
//				'editPopup' => [
//					'disabled' => false,
//				],
//				'addRecord' => [
//					'disabled' => false,
//				],
//				'listModule' => [
//					'disabled' => true,
//				],
//			],
//		],
//	],
//	'variants' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.variants',
//		'config' => [
//			'type' => 'inline',
//			'foreign_table' => 'tx_entityproduct_domain_model_variant',
//			'foreign_field' => 'product',
//			'maxitems' => 9999,
//			'appearance' => [
//				'collapseAll' => 1,
//				'levelLinksPosition' => 'top',
//				'showSynchronizationLink' => false,
//				'showPossibleLocalizationRecords' => false,
//				'showAllLocalizationLink' => false
//			],
//		],
//	],
	'variant_title' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.variant_title',
		'config' => [
			'type' => 'input',
			'size' => 40,
			'eval' => 'trim'
		],
	],
//	'accessories' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.accessories',
//		'config' => [
//			'type' => 'group',
//			'internal_type' => 'db',
//			'allowed' => 'tx_entity_domain_model_entity',
//			'foreign_table' => 'tx_entity_domain_model_entity',
//			'MM' => 'tx_entityproduct_product_accessories_mm',
//			'maxitems' => 999,
//			'size' => 4,
//		],
//	],
//	'show_configurator' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.show_configurator',
//		'config' => [
//			'type' => 'check',
//			'items' => [
//				'1' => [
//					'0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
//				]
//			],
//			'default' => 1,
//		]
//	],
//	'configurator_filter_attributes' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.configurator_filter_attributes',
//		'config' => [
//			'type' => 'select',
//			'renderType' => 'selectMultipleSideBySide',
//			'itemsProcFunc' => \Ps\EntityProduct\Service\TcaService::class . '->getProductAttributes',
//			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
//			'MM' => 'tx_entityproduct_product_configuratorfilter_attribute_mm',
//			'size' => 10,
//			'autoSizeMax' => 30,
//			'maxitems' => 9999,
//			'multiple' => 0,
//		],
//	],
//	'configurator_result_attributes' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.configurator_result_attributes',
//		'config' => [
//			'type' => 'select',
//			'renderType' => 'selectMultipleSideBySide',
//			'itemsProcFunc' => \Ps\EntityProduct\Service\TcaService::class . '->getProductAttributes',
//			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
//			'MM' => 'tx_entityproduct_product_configuratorresult_attribute_mm',
//			'size' => 10,
//			'autoSizeMax' => 30,
//			'maxitems' => 9999,
//			'multiple' => 0,
//		],
//	],
//	'grouped_attributes' => [
//		'exclude' => true,
//		'l10n_mode' => 'exclude',
//		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.grouped_attributes',
//		'config' => [
//			'type' => 'select',
//			'renderType' => 'selectMultipleSideBySide',
//			'itemsProcFunc' => \Ps\EntityProduct\Service\TcaService::class . '->getProductAttributes',
//			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
//			'MM' => 'tx_entityproduct_product_grouped_attribute_mm',
//			'size' => 10,
//			'autoSizeMax' => 30,
//			'maxitems' => 9999,
//			'multiple' => 0,
//		],
//	],
	'key_facts' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.key_facts',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_entityproduct_domain_model_keyfact',
			'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_keyfact}.{#sys_language_uid} IN (0, -1) AND content = 0 ORDER BY tx_entityproduct_domain_model_keyfact.sorting ASC',
			'MM' => 'tx_entityproduct_product_keyfact_mm',
			'default' => 0,
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
		],
	],
	'tx_chart_chart' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'onChange' => 'reload',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.tx_chart_chart',
		'config' => [
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_chart_domain_model_chart',
			'foreign_table' => 'tx_chart_domain_model_chart',
			'maxitems' => 1,
			'minitems' => 0,
			'size' => 1,
			'default' => 0,
		]
	],
	'tx_chart_values' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.tx_chart_values',
		'displayCond' => 'FIELD:tx_chart_chart:REQ:true',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_chart_domain_model_value',
			'foreign_field' => 'tx_entityproduct_product',
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
			'behaviour' => [
				'allowLanguageSynchronization' => true
			],
		]
	],
	'air_consumption_data' => [
		'exclude' => true,
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.air_consumption_data',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'ps14Default',
			'fieldControl' => [
				'fullScreenRichtext' => [
					'disabled' => false,
				],
			],
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim',
		],
	],
	'air_consumption_media' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.air_consumption_media',
		'config' => [
			'type' => 'file',
			'maxitems' => 1,
			'appearance' => [
				'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
				'collapseAll' => true,
				'fileUploadAllowed' => false,
			],
			'overrideChildTca' => [
				'columns' => [
					'crop' => [
						'config' => [
							'cropVariants' => \Ps14\Site\Service\TcaService::getCropVariants(
								[
									'default' => [
										'allowedAspectRatios' => ['16_9'],
										'selectedRatio' => '16_9'
									],
								]
							)
						],
					]
				]
			],
			'behaviour' => [
				'allowLanguageSynchronization' => true
			],
			'allowed' => 'common-image-types',
		],
	],
//	'air_consumption_fallback' => [
//		'exclude' => true,
//		'displayCond' => 'FIELD:layout:!IN:accessories',
//		'label' => 'BASE64',
//		'config' => [
//			'type' => 'text',
//			'cols' => 40,
//			'rows' => 15,
//			'eval' => 'trim',
//		],
//	],
	'options' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.options',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'ps14Default',
			'fieldControl' => [
				'fullScreenRichtext' => [
					'disabled' => false,
				],
			],
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim',
		],
	],
	'system_installation_media' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.system_installation_media',
		'config' => [
			'type' => 'file',
			'maxitems' => 99,
			'appearance' => [
				'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
				'collapseAll' => true,
				'fileUploadAllowed' => false,
			],
			'overrideChildTca' => [
				'columns' => [
					'crop' => [
						'config' => [
							'cropVariants' => \Ps14\Site\Service\TcaService::getCropVariants(
								[
									'mobile' => [
										'allowedAspectRatios' => ['16_9', '4_3', 'NaN'],
										'selectedRatio' => '16_9'
									],
									'desktop' => [
										'allowedAspectRatios' => ['16_9', '4_3', 'NaN'],
										'selectedRatio' => '4_3'
									],
								]
							)
						],
					]
				]
			],
			'behaviour' => [
				'allowLanguageSynchronization' => true
			],
			'allowed' => 'common-image-types',
		],
	],
	'system_installation_legend' => [
		'exclude' => true,
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.system_installation_legend',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_foundation_domain_model_elements',
			'foreign_field' => 'foreign_uid',
			'foreign_sortby' => 'sorting',
			'foreign_label' => 'title',
			'foreign_match_fields' => [
				'foreign_field' => 'system_installation_legend',
			],
			'maxitems' => 999,
			'appearance' => [
				'collapseAll' => 1,
				'expandSingle' => 1,
				'showAllLocalizationLink' => 1,
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showRemovedLocalizationRecords' => 1,
				'newRecordLinkAddTitle' => 1
			]
		]
	],
	'technical_features' => [
		'exclude' => true,
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_features',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_foundation_domain_model_elements',
			'foreign_field' => 'foreign_uid',
			'foreign_sortby' => 'sorting',
			'foreign_label' => 'title',
			'foreign_match_fields' => [
				'foreign_field' => 'technical_features',
			],
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
	'technical_features_description' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_features_description',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'ps14Default',
			'fieldControl' => [
				'fullScreenRichtext' => [
					'disabled' => false,
				],
			],
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim',
		],
	],
	'accesories_description' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.accesories_description',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'ps14Default',
			'fieldControl' => [
				'fullScreenRichtext' => [
					'disabled' => false,
				],
			],
			'cols' => 40,
			'rows' => 15,
			'eval' => 'trim',
		],
	],
]);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'description', '--linebreak--, technical_data', 'after:long_description');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'media', '--linebreak--, technical_drawings', 'after:media');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'relation', '--linebreak--, key_facts, --linebreak--, accessories, --linebreak--, applications, --linebreak--, technology', 'after:related');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'category', '--linebreak--, categories', 'after:master_category');

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['showitem'] = '
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
	--palette--;;title,
	--palette--;;variant,
	--palette--;;layout,
	--palette--;;description,
	--palette--;;attributes,
	--palette--;;media,
	--palette--;;files,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
	--palette--;;extended,
--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entityproduct_domain_model_product.tab.variants,
	--palette--;;variants,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.relation,
	--palette--;;relation,
--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entityproduct_domain_model_product.tab.air-consumption,
	--palette--;;air_consumption,
--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entityproduct_domain_model_product.tab.configurator,
	--palette--;;configurator,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.seo,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_general;seo_general,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_robots;seo_robots,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_canonical;seo_canonical,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_sitemap;seo_sitemap,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.socialmedia,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmedia_og;socialmedia_og,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmedia_twitter;socialmedia_twitter,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
	--palette--;;language,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
	--palette--;;access,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
	--palette--;;category,
	--palette--;;product_hidden,
';

// ---------------------------------------------------------------------------------------------------------------------
// Konfigurationsanpassungen Global fuer dieses Projekt
// Uebersetzungs-Mode ueber columnsOverride ist nicht moeglich: https://docs.typo3.org/m/typo3/reference-tca/master/en-us/Types/Properties/ColumnsOverrides.html
//$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['image']['l10n_mode'] = 'exclude';
//$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['media']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['related']['l10n_mode'] = 'exclude';
//$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['twitter_image']['l10n_mode'] = 'exclude';
//$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['og_image']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['parent']['displayCond'] = 'FIELD:layout:!IN:accessories';

// ---------------------------------------------------------------------------------------------------------------------
// Konfigurationsanpassungen von bestehenden Spalten
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['master_category']['config'] = [
	'itemsProcConfig' => [
		'identifier' => 'entity-product-main',
		'filter' => true,
	],
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['parent']['label'] = 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.parent';

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['image']['label'] = 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.image';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['image']['config']['maxitems'] = 999;
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
	[
		'default' => [
			'allowedAspectRatios' => ['16_9'],
			'selectedRatio' => '16_9'
		],
	]
);

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['media']['config']['maxitems'] = 1;
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
	[
		'default' => [
			'allowedAspectRatios' => ['16_9'],
			'selectedRatio' => '16_9'
		],
	]
);

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['system_installation_legend']['config']['overrideChildTca'] = [
	'columns' => [
		'record_type' => [
			'config' => [
				'items' => [
					[
						'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_foundation_domain_model_elements.record_type.system_installation_legend',
						'value' => 'system_installation_legend'
					],
				],
				'default' => 'system_installation_legend'
			]
		],
	],
	'types' => [
		'system_installation_legend' => [
			'showitem' => '
				l10n_diffsource, record_type, --palette--;;header, description,
				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
				--palette--;;visibility,
				--palette--;;access',
		],
	]
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['technical_features']['config']['overrideChildTca'] = [
	'columns' => [
		'record_type' => [
			'config' => [
				'items' => [
					[
						'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_foundation_domain_model_elements.record_type.technical_features',
						'value' => 'technical_features'
					],
				],
				'default' => 'technical_features'
			]
		],
	],
	'types' => [
		'technical_features' => [
			'showitem' => '
				l10n_diffsource, record_type, --palette--;;header, description, media,
				--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
				--palette--;;visibility,
				--palette--;;access',
		],
	]
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types'][\Ps\EntityProduct\Domain\Model\Product::class]['columnsOverrides']['technical_features']['config']['overrideChildTca']['columns']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = \Ps14\Site\Service\TcaService::getCropVariants(
	[
		'mobile' => [
			'allowedAspectRatios' => ['16_9'],
			'selectedRatio' => '16_9'
		],
		'desktop' => [
			'allowedAspectRatios' => ['4_3'],
			'selectedRatio' => '4_3'
		],
	]
);
