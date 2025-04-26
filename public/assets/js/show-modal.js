// Script untuk menampilkan modal detail
document.addEventListener('DOMContentLoaded', function () {
    // Ambil semua tombol show berdasarkan prefix ID
    const showButtons = document.querySelectorAll('button[id^="showButton-"]');

    showButtons.forEach(button => {
        const id = button.id.split('-')[1]; // Ambil ID unik dari tombol
        const modal = document.getElementById(`modalShow-${id}`);
        const closeBtn = document.getElementById(`closeShowModal-${id}`);
        const modalContent = modal.querySelector('.relative');

        button.addEventListener('click', function (e) {
            e.preventDefault();
            if (modal && modalContent) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95');
                    modalContent.classList.add('scale-100');
                }, 10); // Delay untuk efek transisi                    
            }
        });

        if (closeBtn && modalContent) {
            closeBtn.addEventListener('click', function () {
                modal.classList.add('opacity-0');
                modalContent.classList.add('scale-100');
                modalContent.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            });
        }

        // Tutup modal jika klik di luar konten modal
        modal?.addEventListener('click', function (e) {
            if (e.target === modal && modalContent) {
                modal.classList.add('opacity-0');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        });
    });
});