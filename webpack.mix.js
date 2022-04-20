const mix = require('laravel-mix');
const webpackConfig = require('./webpack.config');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .webpackConfig(webpackConfig)
    .vue()
    .version();
