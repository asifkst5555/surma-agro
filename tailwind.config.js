import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                forest: {
                    50: '#f0f7f4',
                    100: '#dcece4',
                    200: '#bcd9cd',
                    300: '#8fbeb0',
                    400: '#5f9e8d',
                    500: '#3d826e',
                    600: '#2d6a58',
                    700: '#1a3c34',
                    800: '#143028',
                    900: '#0e241e',
                    950: '#081511',
                },
                earth: {
                    50: '#fdf8f0',
                    100: '#f9eddb',
                    200: '#f2d9b5',
                    300: '#e8be85',
                    400: '#dda055',
                    500: '#d4883a',
                    600: '#b86d2f',
                    700: '#8B6914',
                    800: '#6e4f1a',
                    900: '#5a4116',
                },
                cream: '#fafaf7',
                'warm-light': '#f5f5f0',
                'warm-gray': '#e8e5df',
            },
        },
    },

    plugins: [forms],
};
