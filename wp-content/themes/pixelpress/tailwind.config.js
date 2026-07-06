/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './**/*.php',
        './src/**/*.{js,ts,jsx,tsx}',
        './blocks/**/*.{js,json}'
    ],
    theme: {
        extend: {
            screens: {
                '2xl': '1500px',
                '3xl': '1940px',
            },            
        }
    },
    plugins: []
};