const mix = require("laravel-mix");

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

mix.browserSync({
    proxy: "http://127.0.0.1:8000",
    injectChanges: true,
});

mix.js("resources/js/app.js", "public/js")
    .vue()
    .copy("node_modules/datamaps/dist/datamaps.world.min.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
        require("autoprefixer"),
    ])
    .webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
    mix.version();
}