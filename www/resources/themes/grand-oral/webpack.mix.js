let mix = require('laravel-mix');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const path = require('path');

mix.webpackConfig({plugins: [new CleanWebpackPlugin()], output: {path: path.resolve(process.cwd(), 'public')}})
    .setPublicPath("public")
    .setResourceRoot('/themes/default');

mix.js('js/app.js', 'public/js').sourceMaps().version();
mix.sass('sass/app.scss', 'public/css').sourceMaps().version();
