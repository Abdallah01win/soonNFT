const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'myDark': {
                    100: "#181818ff",
                    200: "#0f0f0fff",
                    300: "#0a0a0aff",
                    400: "#0D0D0D",
                },
                'myBlack':{
                    100: '#101010',
                    200:'#1c1c1c',
                    300:'#030303',
                },
                'myGray': '#656565',
                'myPurple' :{
                    300: "#3930cf",
                    400: "#5e45ff"
                }
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
