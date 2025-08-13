// Apply theme ke ikon
export function applyTheme() {
    const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
    const icons = document.querySelectorAll('.invert-icon img');

    icons.forEach(icon => {
        icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
    });
}
window.applyTheme = applyTheme;
