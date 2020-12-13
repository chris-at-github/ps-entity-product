<?php
return [
	'ctrl' => [
		'title' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute',
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
		'searchFields' => 'title,alternative_title,unit,prefix',
		'iconfile' => 'EXT:entity_product/Resources/Public/Icons/tx_entityproduct_domain_model_attribute.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, alternative_title, unit, prefix, data_type, options, group_type',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, alternative_title, unit, prefix, data_type, options, group_type, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
				'foreign_table' => 'tx_entityproduct_domain_model_attribute',
				'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_attribute}.{#pid}=###CURRENT_PID### AND {#tx_entityproduct_domain_model_attribute}.{#sys_language_uid} IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		't3ver_label' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
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
		'title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required'
			],
		],
		'alternative_title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.alternative_title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'unit' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.unit',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'prefix' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.prefix',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim'
			],
		],
		'data_type' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.data_type',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.data_type.string', 'string'],
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.data_type.int', 'int'],
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.data_type.float', 'float'],
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.data_type.boolean', 'boolean'],
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.data_type.select', 'select'],
				],
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required',
				'default' => 'string'
			],
		],
		'group_type' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.group_type',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.group_type.concat', 'concat'],
					['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.group_type.range', 'range'],
				],
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required',
				'default' => 'concat'
			],
		],
		'options' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_attribute.options',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_entityproduct_domain_model_attributeoptions',
				'foreign_field' => 'attribute',
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
	],
];
