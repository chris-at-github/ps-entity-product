<?php

if(defined('TYPO3') === false) {
	die('Access denied.');
}

(function () {

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'EntityProduct',
		'Frontend',
		'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:frontend.title',
		'entity-product-plugin'
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'EntityProduct',
		'KeyFact',
		'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:keyfact.title',
		'entity-product-plugin'
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'EntityProduct',
		'Teaser',
		'LLL:EXT:entity_product/Resources/Private/Language/locallang_plugin.xlf:teaser.title',
		'entity-product-plugin'
	);

})();