<?php

namespace Ps\EntityProduct\EventListener;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class HrefLangTagEventListener extends \Ps\Entity\EventListener\HrefLangTagEventListener {

	/**
	 * @return int|null
	 */
	protected function getUid(): ?int {
		$request = GeneralUtility::_GET('tx_entityproduct_frontend');

		if(isset($request['product']) === true) {
			return (int) $request['product'];
		}

		return null;
	}
}