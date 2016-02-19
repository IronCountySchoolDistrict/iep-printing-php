var gulp = require('gulp'),
	elixir = require('laravel-elixir');

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
    mix.sass('app.scss')
      .sass('styles.scss');

    mix.scripts([
      'loading-modal.js',
      'iep.js'
    ]);

    mix.version(['css/app.css', 'css/styles.css', 'js/all.js']);
});
