<?php
return [
	'ctrl' => [
		'title' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_keyfact',
		'label' => 'title',
		'label_alt' => 'description',
		'formattedLabel_userFunc' => Ps\Xo\Service\TcaService::class . '->getInlineLabel',
		'formattedLabel_userFunc_options' => [
			'label' => 'title',
			'label_alt' => 'description'
		],
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
		'security' => [
			'ignorePageTypeRestriction' => true,
		],
		'searchFields' => 'title,description',
		'iconfile' => 'EXT:entity_product/Resources/Public/Icons/tx_entityproduct_domain_model_keyfact.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
				'foreign_table' => 'tx_entityproduct_domain_model_keyfact',
				'foreign_table_where' => 'AND {#tx_entityproduct_domain_model_keyfact}.{#pid}=###CURRENT_PID### AND {#tx_entityproduct_domain_model_keyfact}.{#sys_language_uid} IN (-1,0)',
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
		'title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_keyfact.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_keyfact.description',
			'config' => [
				'type' => 'text',
				'enableRichtext' => true,
				'richtextConfiguration' => 'xoMinimal',
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

	],
];
