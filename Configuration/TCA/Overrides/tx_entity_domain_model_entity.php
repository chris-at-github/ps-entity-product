<?php
defined('TYPO3_MODE') || die();

if(isset($GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']) === true) {
	$GLOBALS['TCA']['tx_entity_domain_model_entity']['columns']['tx_extbase_type']['config']['items'][] = ['LLL:EXT:entity_product/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tx_extbase_type.product','Ps\EntityProduct\Domain\Model\Product'];
}

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['Ps\EntityProduct\Domain\Model\Product']['showitem'] = 'sys_language_uid, l10n_parent, l10n_diffsource, tx_extbase_type, title, slug, master_category, 
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, hidden, starttime, endtime';