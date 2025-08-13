// Scroll ke atas dengan smooth
export function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
window.scrollToTop = scrollToTop; // supaya bisa dipanggil inline
