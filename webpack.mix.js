const { mix } = require('laravel-mix');

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

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/bootstrap/dist/js/bootstrap.js'
], 'public/assets/js/app.js');

mix.styles([
    'resources/assets/css/google-font.css',
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/font-awesome/css/font-awesome.css'
], 'public/assets/css/app.css');

mix.copy('node_modules/bootstrap/dist/fonts', 'public/assets/fonts', false);
mix.copy('node_modules/font-awesome/fonts', 'public/assets/fonts', false);