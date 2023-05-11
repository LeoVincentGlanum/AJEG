const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Merriweather Sans', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'custom-white': '#FFFFFF',
            'custom-background': '#f9f9f9',
            'custom-card': '#ffffff',
            'custom-button': '#D1D5DB',
            'custom-light-text': '#9CA3AF',
            'custom-darker-button': '#6B7280',
            'custom-text': '#374151'
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
