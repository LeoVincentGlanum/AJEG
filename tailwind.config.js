const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'custom-background': '#F3F4F6',
            'custom-button': '#D1D5DB',
            'custom-text': '#374151',
            'custom-card': '#E5E7EB',
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
