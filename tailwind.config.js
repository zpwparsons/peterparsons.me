/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                mirage: '#141d2c',
                'black-pearl': '#1a2333',
                madison: '#2b3b54',
                vulcan: '#0b121f',
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
