import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'pos-gradient': 'linear-gradient(90deg, #3424B2 0%, #7136FA 100%)',
                'pos-gradient-hover': 'linear-gradient(90deg, #7136FA 0%, #3424B2 100%)',
                'login-svg': "url('../images/login-bg.svg')",
            },
            backgroundSize: {
                '100': '100%',
              },
            colors: {
                primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"},
                'oxford-blue': '#0A194A',
                'pastel-blue': '#889CDE',
                'space-cadet': '#1B2956',
                'dark-cornflower-blue': '#2C4081',
                'eerie-midnight': '#161A23',
                'gunmetal': '#2D2F39',
                'old-rose': '#CC8889',
                'mist-gray': '#F4F6F8',
                'pale-blue-gray': '#D4D8DD',
                'cool-gray': '#919EAB',
                'neutral-gray': '#808080',
                'vivid-sky-blue': '#24A0ED',
                'deep-indigo-blue': '#3424B2',
                'vivid-amethyst': '#7136FA',
                'royal-indigo': '#3926B8',
                'grey-200': '#eeeeee',
                'soft-gray': '#CACACA',
                'yankees-blue': '#1E293B',
                'dark-sapphire': '#1E3273'
            },
        },
    },
    // module.exports = {
    //     plugins: [
    //         require('flowbite/plugin')
    //     ]

    // }
    plugins: [ require('flowbite/plugin'), forms, typography],
};
