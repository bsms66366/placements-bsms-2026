const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.js('resources/js/app.js', 'public/js')
//    .postCss('resources/css/app.css', 'public/css', [
//        //
//    ]);
//let mix = require('laravel-mix');
require('laravel-mix-svg-sprite');
require("./nova.mix");

mix
  .setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .vue({ version: 3 })
  .css('resources/css/tool.css', 'css')
  .nova('vendor/package')
//
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

//mix
//    .js('src', 'output')
//    .sass('src', 'output')
//    .svgSprite(
//        'src/icons', // The directory containing your SVG files
//        'output/sprite.svg', // The output path for the sprite
//        [loaderOptions], // Optional, see //https://github.com/kisenka/svg-sprite-loader#configuration
//        [pluginOptions] // Optional, see //https://github.com/kisenka/svg-sprite-loader#configuration
//    );
