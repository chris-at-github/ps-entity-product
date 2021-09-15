<?php
defined('TYPO3_MODE') || die();

$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity_product');

// ---------------------------------------------------------------------------------------------------------------------
// Neuer Extbase-Typ
if(isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']) === true) {
	$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']['config']['items'][] = ['LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tx_extbase_type.product', 'Ps\EntityProduct\Domain\Model\Product'];
}

// ---------------------------------------------------------------------------------------------------------------------
// Neue Paletten
$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['layout'] = [
	'showitem' => 'layout,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['attributes'] = [
	'showitem' => 'attributes,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['variant'] = [
	'showitem' => 'variant_title, parent,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['chart'] = [
	'showitem' => 'tx_chart_chart, --linebreak--, tx_chart_values,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['variants'] = [
	'showitem' => 'grouped_attributes, --linebreak--, variants,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['configurator'] = [
	'showitem' => 'show_configurator, --linebreak--, configurator_filter_attributes, --linebreak--, configurator_result_attributes,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['extended'] = [
	'showitem' => 'system_installation_media, --linebreak--, system_installation_legend, --linebreak--, technical_features, --linebreak--, options,'
];

$GLOBALS['TCA']['tt_address']['palettes']['productHidden'] = [
	'showitem' => 'tx_extbase_type',
	'isHiddenPalette' => 0
];
// ---------------------------------------------------------------------------------------------------------------------
// Neue Spalten
$tmpEntityProductColumns = [
	'technical_data' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_data',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'xoDefault',
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
		'l10n_mode' => 'exclude',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_drawings',
		'config' =>
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'technical_drawings',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
						'collapseAll' => 1,
					],
					'foreign_match_fields' => [
						'fieldname' => 'technical_drawings',
						'tablenames' => 'tx_entity_domain_model_entity',
						'table_local' => 'sys_file',
					],
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
						],
						'columns' => [
							'crop' => [
								'config' => [
									'cropVariants' => [
										'fullsize' => [
											'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.fullsize',
											'allowedAspectRatios' => [
												'NaN' => [
													'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
													'value' => 0.0
												],
											],
											'selectedRatio' => 'NaN',
										],
										'thumbnail' => [
											'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.thumbnail',
											'allowedAspectRatios' => [
												'NaN' => [
													'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
													'value' => 0.0
												],
											],
											'selectedRatio' => 'NaN',
										],
									]
								]
							]
						]
					],
					'maxitems' => 99
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
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
	'attributes' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.attributes',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
			'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_attribute}.{#sys_language_uid} IN (0, -1) ORDER BY tx_entityproduct_domain_model_attribute.title ASC',
			'MM' => 'tx_entityproduct_product_attribute_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 999,
			'multiple' => 0,
			'fieldControl' => [
				'editPopup' => [
					'disabled' => false,
				],
				'addRecord' => [
					'disabled' => false,
				],
				'listModule' => [
					'disabled' => true,
				],
			],
		],
	],
	'variants' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.variants',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_entityproduct_domain_model_variant',
			'foreign_field' => 'product',
			'maxitems' => 9999,
			'appearance' => [
				'collapseAll' => 1,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => false,
				'showPossibleLocalizationRecords' => false,
				'showAllLocalizationLink' => false
			],
		],
	],
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
	'accessories' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.accessories',
		'config' => [
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'tx_entity_domain_model_entity',
			'foreign_table' => 'tx_entity_domain_model_entity',
			'MM' => 'tx_entityproduct_product_accessories_mm',
			'maxitems' => 999,
			'size' => 4,
		],
	],
	'show_configurator' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.show_configurator',
		'config' => [
			'type' => 'check',
			'items' => [
				'1' => [
					'0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
				]
			],
			'default' => 1,
		]
	],
	'configurator_filter_attributes' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.configurator_filter_attributes',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'itemsProcFunc' => \Ps\EntityProduct\Service\TcaService::class . '->getProductAttributes',
			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
			'MM' => 'tx_entityproduct_product_configuratorfilter_attribute_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
		],
	],
	'configurator_result_attributes' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.configurator_result_attributes',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'itemsProcFunc' => \Ps\EntityProduct\Service\TcaService::class . '->getProductAttributes',
			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
			'MM' => 'tx_entityproduct_product_configuratorresult_attribute_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
		],
	],
	'grouped_attributes' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.grouped_attributes',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'itemsProcFunc' => \Ps\EntityProduct\Service\TcaService::class . '->getProductAttributes',
			'foreign_table' => 'tx_entityproduct_domain_model_attribute',
			'MM' => 'tx_entityproduct_product_grouped_attribute_mm',
			'size' => 10,
			'autoSizeMax' => 30,
			'maxitems' => 9999,
			'multiple' => 0,
		],
	],
	'key_facts' => [
		'exclude' => true,
		'l10n_mode' => 'exclude',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.key_facts',
		'config' => [
			'type' => 'select',
			'renderType' => 'selectMultipleSideBySide',
			'foreign_table' => 'tx_entityproduct_domain_model_keyfact',
			'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_keyfact}.{#sys_language_uid} IN (0, -1) ORDER BY tx_entityproduct_domain_model_keyfact.sorting ASC',
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
		]
	],
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
			],
			'size' => 1,
			'maxitems' => 1,
			'multiple' => 0,
		],
	],
	'options' => [
		'exclude' => true,
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.options',
		'config' => [
			'type' => 'text',
			'enableRichtext' => true,
			'richtextConfiguration' => 'xoDefault',
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
		'config' =>
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'system_installation_media',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
						'collapseAll' => 1,
					],
					'foreign_match_fields' => [
						'fieldname' => 'system_installation_media',
						'tablenames' => 'tx_entity_domain_model_entity',
						'table_local' => 'sys_file',
					],
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
						],
						'columns' => [
							'crop' => [
								'config' => [
									'cropVariants' => [
										'default' => [
											'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
											'allowedAspectRatios' => [
												'NaN' => [
													'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
													'value' => 0.0
												],
											],
											'selectedRatio' => 'NaN',
										],
									]
								]
							]
						]
					],
					'maxitems' => 99
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
	],
	'system_installation_legend' => [
		'exclude' => true,
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.system_installation_legend',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_xo_domain_model_elements',
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
			],
		]
	],
	'technical_features' => [
		'exclude' => true,
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.technical_features',
		'displayCond' => 'FIELD:layout:!IN:accessories',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_xo_domain_model_elements',
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
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_entity_domain_model_entity', $tmpEntityProductColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'description', '--linebreak--, technical_data', 'after:long_description');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'media', '--linebreak--, technical_drawings', 'after:media');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'relation', '--linebreak--, key_facts, --linebreak--, accessories, --linebreak--, applications, --linebreak--, technology', 'after:related');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'category', '--linebreak--, categories', 'after:master_category');

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['showitem'] = '
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
	--palette--;;title,
	--palette--;;layout,
	--palette--;;variant,
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
--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entityproduct_domain_model_product.tab.chart,
	--palette--;;chart,
--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entityproduct_domain_model_product.tab.configurator,
	--palette--;;configurator,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.seo,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoGeneral;seoGeneral,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoRobots;seoRobots,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoCanonical;seoCanonical,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoSitemap;seoSitemap,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.socialmedia,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmediaOg;socialmediaOg,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmediaTwitter;socialmediaTwitter,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
	--palette--;;language,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
	--palette--;;access,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
	--palette--;;category,
	--palette--;;productHidden,
';

// ---------------------------------------------------------------------------------------------------------------------
// Konfigurationsanpassungen Global fuer dieses Projekt
// Uebersetzungs-Mode ueber columnsOverride ist nicht moeglich: https://docs.typo3.org/m/typo3/reference-tca/master/en-us/Types/Properties/ColumnsOverrides.html
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['image']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['media']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['related']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['twitter_image']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['og_image']['l10n_mode'] = 'exclude';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['parent']['displayCond'] = 'FIELD:layout:!IN:accessories';

// ---------------------------------------------------------------------------------------------------------------------
// Konfigurationsanpassungen von bestehenden Spalten
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['master_category']['config'] = [
	'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) and sys_category.parent = ' . (int) $extensionConfiguration['parentMasterProductCategory'] . ' ORDER BY sys_category.sorting ASC',
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['parent']['label'] = 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.parent';

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['image']['label'] = 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.image';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['image']['config']['maxitems'] = 999;
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants'] = [
	'hero' => [
		'title' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.image.crop.hero',
		'allowedAspectRatios' => [
			'16_9' => [
				'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
				'value' => 16 / 9
			],
		],
		'selectedRatio' => '16_9',
	],
	'thumbnail' => [
		'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.thumbnail',
		'allowedAspectRatios' => [
			'16_9' => [
				'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
				'value' => 16 / 9
			],
		],
		'selectedRatio' => '16_9',
	],
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['system_installation_legend']['config']['overrideChildTca'] = [
	'columns' => [
		'record_type' => [
			'config' => [
				'items' => [
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_xo_domain_model_elements.record_type.technical_features', 'system_installation_legend'],
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

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['technical_features']['config']['overrideChildTca'] = [
	'columns' => [
		'record_type' => [
			'config' => [
				'items' => [
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_xo_domain_model_elements.record_type.technical_features', 'technical_features'],
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

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['columnsOverrides']['technical_features']['config']['overrideChildTca']['columns']['media']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']  = [
	'mobile' => [
		'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.mobile',
		'allowedAspectRatios' => [
			'16_9' => [
				'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
				'value' => 16 / 9
			],
		],
		'selectedRatio' => '16_9',
	],
	'desktop' => [
		'title' => 'LLL:EXT:xo/Resources/Private/Language/locallang_tca.xlf:tx_xo_crop_variant.desktop',
		'allowedAspectRatios' => [
			'4_3' => [
				'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
				'value' => 4 / 3
			],
		],
		'selectedRatio' => '4_3',
	],
];
