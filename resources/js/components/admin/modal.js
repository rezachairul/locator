export function initModal() {
    const modalToggleBtns = document.querySelectorAll('[data-modal-toggle]');
    const modalHideBtns = document.querySelectorAll('[data-modal-hide]');

    modalToggleBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('data-modal-toggle');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.toggle('hidden');
            } else {
                console.error(`Modal with ID ${modalId} not found`);
            }
        });
    });

    modalHideBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const modalId = btn.getAttribute('data-modal-hide');
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
            }

            const form = modal.querySelector('form');
            if (form) form.reset();
        });
    });
}

export function submitForm() {
    const modal = document.getElementById('defaultModal');
    if (modal) modal.classList.add('hidden');

    document.getElementById('defaultModalButton')?.click();
    document.getElementById('deleteButton')?.click();
    document.getElementById('updateProductButton')?.click();
}

// supaya bisa dipanggil inline
window.initModal = initModal;