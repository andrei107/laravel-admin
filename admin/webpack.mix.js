const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/js/app.js', 'public/js')
    .js('resources/assets/js/main.js', 'public/js')
    .js('resources/assets/js/cms/receipt/receipt.js', 'public/js')
    .js('resources/assets/js/cms/menu/menu.js', 'public/js')
    .js('resources/assets/js/cms/create-filter/create-filter.js', 'public/js')
    .js('resources/assets/js/cms/advice/advice.js', 'public/js')
    .js('resources/assets/js/general.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/mainStyle.scss', 'public/css')
    .sourceMaps();
