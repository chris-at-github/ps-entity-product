<?php

namespace Ps\EntityProduct\EventListener;

use Ps\Entity\Domain\Model\Entity;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
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

	/**
	 * @param int $uid
	 * @return Entity
	 */
	protected function getEntity($uid) {
		return GeneralUtility::makeInstance(ProductRepository::class)->findByUid($uid);
	}
}