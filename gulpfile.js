var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss')
       .browserify('app.js', null, null, { paths: 'vendor/laravel/spark/resources/assets/js' })
       .scripts([
            '../../../node_modules/jquery/dist/jquery.js',
            '../../../node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
            '../../../node_modules/highlightjs/highlight.pack.js',
            '../../../node_modules/sweetalert/dist/sweetalert.min.js',
       ], 'public/js/vendor.js');
});
