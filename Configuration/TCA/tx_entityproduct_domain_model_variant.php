<?php
return [
	'ctrl' => [
		'title' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'versioningWS' => true,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'model,title,article_number,type_code',
		'iconfile' => 'EXT:entity_product/Resources/Public/Icons/tx_entityproduct_domain_model_variant.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, model, article_number, file, pi_flexform, attributes,',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, model, article_number, file, pi_flexform, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
	],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'default' => 0,
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_entityproduct_domain_model_variant',
				'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_variant}.{#pid}=###CURRENT_PID### AND {#tx_entityproduct_domain_model_variant}.{#sys_language_uid} IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		'hidden' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
						'invertStateDisplay' => true
					]
				],
			],
		],
		'starttime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'endtime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'range' => [
					'upper' => mktime(0, 0, 0, 1, 1, 2038)
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'model' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant.model',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required',
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant.title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required',
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'article_number' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant.article_number',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required',
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'file' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant.file',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'file',
				[
					'appearance' => [
						'collapseAll' => 1,
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
					],
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;basicoverlayPalette,
									--palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;basicoverlayPalette,
									--palette--;;filePalette'
							],
						],
					],
					'foreign_match_fields' => [
						'fieldname' => 'file',
						'tablenames' => 'tx_entityproduct_domain_model_variant',
						'table_local' => 'sys_file',
					],
					'maxitems' => 1,
					'behaviour' => [
						'allowLanguageSynchronization' => true
					]
				]
			),
		],
		'attributes' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant.attributes',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_entityproduct_domain_model_attributevalue',
				'foreign_field' => 'variant',
				'maxitems' => 9999,
			],
		],
		'product' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		'pi_flexform' => [
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_variant.attributes',
			'config' => [
				'type' => 'flex',
				'renderType' => 'flexNoTab',
				'ds' => [
					'default' => '<T3DataStructure><ROOT><el></el></ROOT></T3DataStructure>'
				],
			],
		],
	],
];
