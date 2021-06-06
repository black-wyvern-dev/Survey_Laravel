const mix = require('laravel-mix')

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
mix.copyDirectory('resources/assets/css', 'public/css');
mix.copyDirectory('resources/assets/extra-libs', 'public/extra-libs');
mix.copyDirectory('resources/assets/libs', 'public/libs');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/images', 'public/images');
mix.copyDirectory('resources/assets/js', 'public/js');

