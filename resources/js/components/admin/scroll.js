export function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// supaya bisa dipanggil inline
window.scrollToTop = scrollToTop; 