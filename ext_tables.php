<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
	function() {

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
			'EntityProduct',
			'Frontend',
			'Product Frontend'
		);

		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attribute');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_variant');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attributevalue');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entityproduct_domain_model_attributeoption');
	}
);
