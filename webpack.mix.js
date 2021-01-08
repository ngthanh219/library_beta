const mix = require('laravel-mix');
const { bindAll } = require('lodash');

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
    .js('resources/js/sweet-alert.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles('resources/css/all.css', 'public/css/all.css')
    .styles('resources/css/client.css', 'public/css/client.css')
    .js('resources/js/select2.js', 'public/js/select2.js')
    .js('resources/js/editor.js', 'public/js/editor.js')
    .js('resources/js/cate_popup.js', 'public/js/cate_popup.js')
    .js('resources/js/cate_popup_form.js', 'public/js/cate_popup_form.js')
    .js('resources/js/user_menu.js', 'public/js/user_menu.js')
    .js('resources/js/cart/add_cart.js', 'public/js/add_cart.js')
    .js('resources/js/cart/remove_cart.js', 'public/js/remove_cart.js')
    .js('resources/js/notification.js', 'public/js/notification.js')
    .js('resources/js/reaction/like_book.js', 'public/js/like_book.js');
