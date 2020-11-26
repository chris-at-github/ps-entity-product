<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'EntityProduct',
            'Frontend',
            'Product Frontend'
        );



        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('entity_product', 'Configuration/TypoScript', 'Product');


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_entityproduct_domain_model_attribute', 'EXT:entity_product/Resources/Private/Language/locallang_csh_tx_entityproduct_domain_model_attribute.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attribute');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_entityproduct_domain_model_variant', 'EXT:entity_product/Resources/Private/Language/locallang_csh_tx_entityproduct_domain_model_variant.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_variant');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_entityproduct_domain_model_attributevalue', 'EXT:entity_product/Resources/Private/Language/locallang_csh_tx_entityproduct_domain_model_attributevalue.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attributevalue');

    }
);
