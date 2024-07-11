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
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                flashFade: {
                    "0%": { transform: "translateX(180px)", opacity: 0 },
                    "20%": { transform: "translateX(0)", opacity: 1 },
                    "80%": { transform: "translateX(0)", opacity: 1 },
                    "100%": { transform: "translateX(180px)", opacity: 0 },
                },
            },
            animation: {
                flash: "flashFade 7.0s forwards",
            },
        },
    },

    plugins: [forms, typography],
};
