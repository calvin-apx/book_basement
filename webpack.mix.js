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
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/js/products.js', 'public/js/products.js')
    .copy('resources/js/appointments.js', 'public/js/appointments.js')
    .copy('resources/css/rating.css', 'public/css/rating.css')
    .copy('resources/css/datatable_custom.css', 'public/css/datatable_custom.css');

