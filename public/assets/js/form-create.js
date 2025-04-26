// Script untuk menampilkan create form dan preview image saat create
const createButton = document.getElementById('createButton');
const createForm = document.getElementById('createForm');
const cancelButton = document.getElementById('cancelButton');
const exitButton = document.getElementById('exitButton');
const reportForm = document.getElementById('reportForm');

// Tampilkan form saat tombol Create diklik
createButton.addEventListener('click', () => {
    createForm.classList.remove('hidden');
    createForm.classList.remove('animate-fade-out'); // Jika ada animasi keluar sebelumnya
    createForm.classList.add('animate-fade-in');
});
// Sembunyikan form dengan animasi fade-out
cancelButton.addEventListener('click', () => {
    createForm.classList.remove('animate-fade-in');
    createForm.classList.add('animate-fade-out');
    setTimeout(() => {
        createForm.classList.add('hidden');
    }, 200); // Waktu sesuai dengan durasi animasi
});
exitButton.addEventListener('click', () => {
    createForm.classList.remove('animate-fade-in');
    createForm.classList.add('animate-fade-out');
    setTimeout(() => {
        createForm.classList.add('hidden');
    }, 200); // Waktu sesuai dengan durasi animasi
});
// Form submit handling
reportForm.addEventListener('submit', () => {
    createForm.classList.remove('animate-fade-in');
    createForm.classList.add('animate-fade-out');
    setTimeout(() => {
        createForm.classList.add('hidden');
    }, 300);
});
