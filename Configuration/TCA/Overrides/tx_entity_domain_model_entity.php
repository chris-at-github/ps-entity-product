<?php
defined('TYPO3_MODE') || die();

if(isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']) === true) {
	$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']['config']['items'][] = ['LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tx_extbase_type.product', 'Ps\EntityProduct\Domain\Model\Product'];
}

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['attributes'] = [
	'showitem' => 'attributes,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['variants'] = [
	'showitem' => 'variants,'
];

$tmpEntityProductColumns = [
	'technical_drawings' => [
		'exclude' => true,
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
					],
					'maxitems' => 99
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
	],
	'applications' => [
		'exclude' => true,
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
	'attributes' => [
		'exclude' => true,
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
		'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.variants',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_entityproduct_domain_model_variant',
			'foreign_field' => 'product',
			'maxitems' => 9999,
			'appearance' => [
				'collapseAll' => 1,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 1,
				'showPossibleLocalizationRecords' => 1,
				'showAllLocalizationLink' => 1
			],
		],
	],
	'accessories' => [
		'exclude' => true,
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
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_entity_domain_model_entity', $tmpEntityProductColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'media', '--linebreak--, technical_drawings', 'after:media');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tx_entity_domain_model_entity', 'relation', '--linebreak--, accessories, --linebreak--, applications', 'after:related');

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['showitem'] = '
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
	--palette--;;title,
	--palette--;;description,
	--palette--;;attributes,
	--palette--;;media,
	--palette--;;files,
--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entityproduct_domain_model_product.tab.variants,
	--palette--;;variants,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.relation,
	--palette--;;relation,
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
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
	tx_extbase_type,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
	--palette--;;category,	
';
