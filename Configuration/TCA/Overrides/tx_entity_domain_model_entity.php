<?php
defined('TYPO3_MODE') || die();

if(isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']) === true) {
    $GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']['config']['items'][] = ['LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tx_extbase_type.product','Ps\EntityProduct\Domain\Model\Product'];
}




$tmp_entity_product_columns = [


    'attributes' => [
        'exclude' => true,
        'label' => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product.attributes',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'foreign_table' => 'tx_entityproduct_domain_model_attribute',
            'MM' => 'tx_entityproduct_product_attribute_mm',
            'size' => 10,
            'autoSizeMax' => 30,
            'maxitems' => 9999,
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
                'collapseAll' => 0,
                'levelLinksPosition' => 'top',
                'showSynchronizationLink' => 1,
                'showPossibleLocalizationRecords' => 1,
                'showAllLocalizationLink' => 1
            ],
        ],
            
        
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_entity_domain_model_entity', $tmp_entity_product_columns);


$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['showitem'] = 'sys_language_uid, l10n_parent, l10n_diffsource, 
    tx_extbase_type, title, slug, master_category, attributes, variants,
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, hidden, starttime, endtime';
