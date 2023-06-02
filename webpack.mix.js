const mix = require('laravel-mix');

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
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
mix.copy('resources/images/admin.jpg', 'public/images/admin.jpg');
mix.copy('resources/images/teacher.jpg', 'public/images/teacher.jpg');
mix.copy('resources/images/student.jpg', 'public/images/student.jpg');
mix.copy('resources/images/meeting.jpg', 'public/images/meeting.jpg');
mix.copy('resources/images/logo.png', 'public/images/logo.png');