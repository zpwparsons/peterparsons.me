import { toDarkMode, toLightMode, toSystemMode } from './components/theme';

window.toDarkMode = toDarkMode;
window.toLightMode = toLightMode;
window.toSystemMode = toSystemMode;

// Temporary solution for Livewire's "wire:navigate" keyboard input
document.addEventListener('keydown', (e) => {
    if (!e.target.hasAttribute('wire:navigate')) return;

    if (e.key.toLowerCase() === 'enter') {
        Alpine.navigate(e.target.href);
    }
});
