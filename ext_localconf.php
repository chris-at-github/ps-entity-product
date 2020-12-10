<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
	function() {

		\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
			'EntityProduct',
			'Frontend',
			[
				\Ps\EntityProduct\Controller\ProductController::class => 'list, show'
			],
			// non-cacheable actions
			[
				\Ps\EntityProduct\Controller\ProductController::class => ''
			]
		);

		// wizards
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
			'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        frontend {
                            iconIdentifier = entity_product-plugin-frontend
                            title = LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entity_product_frontend.name
                            description = LLL:EXT:entity_product/Resources/Private/Language/locallang_db.xlf:tx_entity_product_frontend.description
                            tt_content_defValues {
                                CType = list
                                list_type = entityproduct_frontend
                            }
                        }
                    }
                    show = *
                }
           }'
		);
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

		$iconRegistry->registerIcon(
			'entity_product-plugin-frontend',
			\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
			['source' => 'EXT:entity_product/Resources/Public/Icons/user_plugin_frontend.svg']
		);


		\FluidTYPO3\Flux\Core::registerConfigurationProvider(\Ps\EntityProduct\Provider\VariantAttributeProvider::class);

		// Automatisches Setzen des Status von Neu auf in Bearbeitung
		$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][\Ps\EntityProduct\Service\VariantFlexformProcessingService::class] = \Ps\EntityProduct\Service\VariantFlexformProcessingService::class;
	}
);
