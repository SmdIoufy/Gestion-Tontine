const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/js')

   .sass('resources/sass/app.scss', 'public/css')
   .postCss('resources/css/app.css', 'public/css', [
    tailwindcss('./tailwind.config.js'),
   ]);

mix.js('resources/js/app.js', 'public/js')
    .copy('node_modules/chart.js/dist/chart.min.js', 'public/js');
