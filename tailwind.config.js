import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {"50":"#eef2ff","100":"#e0e7ff","200":"#c7d2fe","300":"#a5b4fc","400":"#818cf8","500":"#6366f1","600":"#4f46e5","700":"#4338ca","800":"#3730a3","900":"#312e81","950":"#1e1b4b"}
                // primary: {"50":"#fef2f2","100":"#fee2e2","200":"#fecaca","300":"#fca5a5","400":"#f87171","500":"#ef4444","600":"#dc2626","700":"#b91c1c","800":"#991b1b","900":"#7f1d1d","950":"#450a0a"}
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
