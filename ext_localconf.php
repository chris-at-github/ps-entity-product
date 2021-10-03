<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
	function() {

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
			'Ps.EntityProduct',
			'Frontend',
			[
				\Ps\EntityProduct\Controller\ProductController::class => 'listing, show'
			],
			// non-cacheable actions
			[
				\Ps\EntityProduct\Controller\ProductController::class => ''
			]
		);

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
			'Ps.EntityProduct',
			'KeyFact',
			[
				\Ps\EntityProduct\Controller\KeyFactController::class => 'listing'
			],
			// non-cacheable actions
			[
				\Ps\EntityProduct\Controller\KeyFactController::class => ''
			]
		);

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
			'Ps.EntityProduct',
			'Teaser',
			[
				\Ps\EntityProduct\Controller\ProductController::class => 'teaser'
			],
			// non-cacheable actions
			[
				\Ps\EntityProduct\Controller\ProductController::class => ''
			]
		);

		// PageTs
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
			'<INCLUDE_TYPOSCRIPT: source="FILE:EXT:entity_product/Configuration/TSConfig/Page.t3s">'
		);

		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		$iconRegistry->registerIcon(
			'entity_product-plugin-frontend',
			\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
			['source' => 'EXT:entity_product/Resources/Public/Icons/user_plugin_frontend.svg']
		);

		\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps\EntityProduct\Provider\VariantAttributeProvider::class);
		\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps\EntityProduct\Provider\ChartDataValueProvider::class);

		// Automatisches Setzen des Status von Neu auf in Bearbeitung
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][\Ps\EntityProduct\Service\VariantFlexformProcessingService::class] = \Ps\EntityProduct\Service\VariantFlexformProcessingService::class;
	}
);
