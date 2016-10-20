var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.sass('app.scss');

    mix.stylesIn('resources/assets/css', 'public/css/fx.css');

    mix.scripts([
        "./node_modules/jquery/dist/jquery.min.js",
        // "./node_modules/jquery-ujs/src/rails.js",
        "./node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js",
       "js/app.js"
    ], 'public/js/app.js', 'resources/assets');

//    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

});