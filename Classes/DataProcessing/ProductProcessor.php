<?php

namespace Ps\EntityProduct\DataProcessing;

use Ps\EntityProduct\Domain\Model\Product;
use Ps\EntityProduct\Domain\Repository\ProductRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

class ProductProcessor extends \Ps\Xo\DataProcessing\ModuleProcessor implements DataProcessorInterface {

	/**
	 * @param ContentObjectRenderer $contentObject The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $contentObject, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) {

		// auf der Detailseite werden die Inhaltselemente nochmals selbst in Container-DIV Elemente eingeteilt
		$processedData['data']['tx_xo_no_frame'] = 1;

		// Produkt-Model laden
		$request = GeneralUtility::_GET('tx_entityproduct_frontend');
		if(empty($request) === false) {

			/** @var Product $product */
			$product = $this->objectManager->get(ProductRepository::class)->findByUid((int) $request['product']);

			// Technische Zeichnungen vorhanden?
			if(count($product->getTechnicalDrawings()) !== 0) {
				$this->addImportJsFiles(['/assets/js/libraries/tobii.js' => ['forceOnTop' => true]]);
				$this->addImportCssFiles(['/assets/css/libraries/tobii.css']);

				// Erst bei mehr als einer technischen Zeichnung werden Tabs benoetigt
				if(count($product->getTechnicalDrawings()) >= 2) {
					$this->addImportJsFiles(['/assets/js/components/tab.js']);
					$this->addImportCssFiles(['/assets/css/components/tab.css']);
				}
			}
		}

		return parent::process($contentObject, $contentObjectConfiguration, $processorConfiguration, $processedData);
	}
}