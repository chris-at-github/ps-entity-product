(function () {
	'use strict';

	xna.on('documentLoaded', function() {

		// -----------------------------------------------------------------------------------------------------------------
		// Filter
		if(document.querySelector('.product-listing') !== null) {
			let productFilter = new filter(document.querySelector('.product-listing'), {
				ajax: true,
				pageType: 1548191072,
				containerSelector: '.product-listing--container',
				itemsSelector: '.product-listing--container > li'
			});
		}
	});
})();