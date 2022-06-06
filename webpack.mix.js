const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
 

 

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard/dashboard.js', 'public/js')

    .postCss('resources/css/auth.css', 'public/css', {}, [tailwindcss(  'resources/css/tailwind.auth.config.js' )])
    .postCss('resources/css/dashboard.css', 'public/css', {}, [tailwindcss(  'resources/css/tailwind.dashboard.config.js' )])

