var gulp = require('gulp'),
	elixir = require('laravel-elixir'),
	sftp = require('gulp-sftp')
	config = require('./config.json');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');
});

gulp.task('sftp', function() {
	gulp.src("app/Http/Controllers/HomeController.php")
		.pipe(sftp({
			host: config.sftp.host,
	    	user: config.sftp.user,
	    	pass: config.sftp.pass,
	    	remotePath: config.sftp.remotePath
			}))

});

gulp.task('sftp-watch', function() {
  gulp.watch("app/Http/Controllers/HomeController.php", ['sftp']);
});