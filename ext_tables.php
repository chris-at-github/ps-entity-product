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


    }
);
