<?php

if(defined('TYPO3') === false) {
	die('Access denied.');
}

(function () {

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'EntityProduct',
		'Frontend',
		[
			\Ps\EntityProduct\Controller\ProductController::class => 'listing, show',
//			\Ps\EntityProduct\Controller\AirConsumptionFallbackController::class => 'save'
		],
		[
			\Ps\EntityProduct\Controller\ProductController::class => '',
//			\Ps\EntityProduct\Controller\AirConsumptionFallbackController::class => 'save'
		]
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'EntityProduct',
		'KeyFact',
		[
			\Ps\EntityProduct\Controller\KeyFactController::class => 'listing'
		],
		[]
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'EntityProduct',
		'Teaser',
		[
			\Ps\EntityProduct\Controller\ProductController::class => 'teaser'
		],
		[]
	);

//	\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps\EntityProduct\Provider\VariantAttributeProvider::class);
//	\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps\EntityProduct\Provider\ChartDataValueProvider::class);
//
//	// Automatisches Setzen des Status von Neu auf in Bearbeitung
//	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][\Ps\EntityProduct\Service\VariantFlexformProcessingService::class] = \Ps\EntityProduct\Service\VariantFlexformProcessingService::class;
//
//	// Register custom indexer.
//	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['registerIndexerConfiguration'][] =	\Ps\EntityProduct\Indexer\ProductIndexer::class;
//	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['ke_search']['customIndexer'][] = \Ps\EntityProduct\Indexer\ProductIndexer::class;

})();
