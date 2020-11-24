<?php

// ---------------------------------------------------------------------------------------------------------------------
// Frontend Plugin Einstellungen

// Flexform Address Plugin
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['entityproduct_frontend'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('entityproduct_frontend', 'FILE:EXT:entity_product/Configuration/FlexForms/Plugins/Frontend.xml');