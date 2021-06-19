<?php

namespace Ps\EntityProduct\EventListener;

use Ps\Entity\Domain\Model\Entity;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CanonicalTagEventListener extends \Ps\Entity\EventListener\CanonicalTagEventListener {

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
	 * @return Entity|null
	 */
	protected function getEntity() {
		$uid = $this->getUid();

		if(empty($uid) === false) {
			return GeneralUtility::makeInstance(ProductRepository::class)->findByUid($uid);
		}

		return null;
	}
}