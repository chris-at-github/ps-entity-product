<?php

// ---------------------------------------------------------------------------------------------------------------------
// Frontend Plugin Einstellungen

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_frontend'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_frontend', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/Frontend.xml');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_keyfact'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_keyfact', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/KeyFact.xml');