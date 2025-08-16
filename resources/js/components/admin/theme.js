export function applyTheme() {
    const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
    const icons = document.querySelectorAll('.invert-icon img');

    icons.forEach(icon => {
        icon.style.filter = theme === 'light' ? 'invert(1)' : 'invert(0)';
    });
}

export function initThemeToggle() {
    const themeToggleButton = document.getElementById('theme-toggle');
    if (themeToggleButton) {
        themeToggleButton.addEventListener('click', function() {
            document.body.classList.toggle('dark');
            applyTheme();
        });
    }
}

// supaya bisa dipanggil inline
window.initThemeToggle = initThemeToggle;