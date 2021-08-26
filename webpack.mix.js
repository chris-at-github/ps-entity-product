var mix = require('laravel-mix');

// Stopping at 95% emitting
// @see: https://github.com/JeffreyWay/laravel-mix/issues/1126
mix.setPublicPath('../../../');

// No Noise
// @see: https://laravel.com/docs/5.6/mix#notifications
mix.disableSuccessNotifications();

// Disable Process CSS Urls
// @see: https://laravel.com/docs/5.7/mix#working-with-stylesheets
mix.options({
	processCssUrls: false
});

mix.js('Resources/Public/Js/entity-product.js', 'assets/js/entity-product.js')
mix.sass('Resources/Public/Sass/product-frontend.scss', 'assets/css/modules/product-frontend.css')
	.sass('Resources/Public/Sass/product-keyfact.scss', 'assets/css/modules/product-keyfact.css')
	.options({
		postCss: [
			require('postcss-cachebuster'),
			require('postcss-combine-duplicated-selectors')({
				removeDuplicatedProperties: true
			})
		]
	}
);

if(mix.inProduction() === true) {
	mix.minify(['../../../assets/css/modules/product-frontend.css', '../../../assets/css/modules/product-keyfact.css']);
	mix.minify(['../../../assets/js/entity-product.js']);
}