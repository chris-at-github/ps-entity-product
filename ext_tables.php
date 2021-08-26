<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
	function() {

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
			'EntityProduct',
			'Frontend',
			'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:tx_entity_product_frontend.name'
		);

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
			'EntityProduct',
			'KeyFact',
			'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:tx_entity_product_keyfact.name'
		);

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attribute');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_variant');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attributevalue');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attributeoption');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_keyfact');
	}
);