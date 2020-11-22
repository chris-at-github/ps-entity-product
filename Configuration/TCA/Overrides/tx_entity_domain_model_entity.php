<?php
defined('TYPO3_MODE') || die();


if (!isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['type'])) {
    // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
    $GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['type'] = 'tx_extbase_type';
    $tempColumnstx_entityproduct_tx_entity_domain_model_entity = [];
    $tempColumnstx_entityproduct_tx_entity_domain_model_entity[$GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['type']] = [
        'exclude' => true,
        'label'   => 'LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct.tx_extbase_type',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['',''],
                ['Product','Tx_EntityProduct_Product']
            ],
            'default' => 'Tx_EntityProduct_Product',
            'size' => 1,
            'maxitems' => 1,
        ]
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_entity_domain_model_entity', $tempColumnstx_entityproduct_tx_entity_domain_model_entity);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_entity_domain_model_entity',
    $GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['type'],
    '',
    'after:' . $GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['label']
);





/* inherit and extend the show items from the parent class */

if (isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['1']['showitem'])) {
    $GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Tx_EntityProduct_Product']['showitem'] = $GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['1']['showitem'];
} elseif(is_array($GLOBALS['TCA']['tx_entity_domain_model_entity']['types'])) {
    // use first entry in types array
    $tx_entity_domain_model_entity_type_definition = reset($GLOBALS['TCA']['tx_entity_domain_model_entity']['types']);
    $GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Tx_EntityProduct_Product']['showitem'] = $tx_entity_domain_model_entity_type_definition['showitem'];
} else {
    $GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Tx_EntityProduct_Product']['showitem'] = '';
}
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Tx_EntityProduct_Product']['showitem'] .= ',--div--;LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entityproduct_domain_model_product,';
$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Tx_EntityProduct_Product']['showitem'] .= '';


$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns'][$GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['type']]['config']['items'][] = ['LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entity_domain_model_entity.tx_extbase_type.Tx_EntityProduct_Product','Tx_EntityProduct_Product'];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
   'entity_product',
   'tx_entity_domain_model_entity'
);
