// Script untuk menampilkan edit form & preview image saat edit form
document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua tombol edit berdasarkan prefix ID
    const editButtons = document.querySelectorAll('button[id^="editButton-"]');

    editButtons.forEach(button => {
        const id = button.id.split('-')[1]; // Ambil ID unik dari tombol

        const editFormDiv = document.getElementById(`editForm-${id}`);
        const closeEditBtn = document.getElementById(`closeEditButton-${id}`);
        const cancelEditBtn = document.getElementById(`cancelEditButton-${id}`);
        const editForm = document.getElementById(`editFormReport-${id}`);
        
        // Saat tombol Edit diklik: tampilkan div form edit
        button.addEventListener('click', () => {
            editFormDiv.classList.remove('hidden');
            editFormDiv.classList.add('animate-fade-in');
        });

        // Saat tombol Close diklik: sembunyikan form edit
        closeEditBtn.addEventListener('click', () => {
            editFormDiv.classList.remove('animate-fade-in');
            editFormDiv.classList.add('animate-fade-out');
            setTimeout(() => {
                editFormDiv.classList.add('hidden');
                editFormDiv.classList.remove('animate-fade-out');
            }, 300); // waktu sama kayak durasi animasi fade-out
        });

        // Saat tombol Cancel di form diklik: sembunyikan form edit
        cancelEditBtn.addEventListener('click', () => {
            editFormDiv.classList.remove('animate-fade-in');
            editFormDiv.classList.add('animate-fade-out');
            setTimeout(() => {
                editFormDiv.classList.add('hidden');
                editFormDiv.classList.remove('animate-fade-out');
            }, 300);
        });
    });
});