var elixir = require('laravel-elixir');

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
    mix.scripts([
         './jquery/dist/jquery.min.js',
         './bootstrap/dist/js/bootstrap.min.js',
     ], 'public/js/app.js', 'resources/assets/bower');
    mix.scripts([
         './moment/min/moment.min.js',
         './eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
     ], 'public/js/vendor.js', 'resources/assets/bower');
    mix.styles([
        './eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
    ], 'public/css/vendor.css', 'resources/assets/bower');
});
