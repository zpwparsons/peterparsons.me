import preset from '../../../vendor/filament/filament/tailwind.config.preset.js'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
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
}
