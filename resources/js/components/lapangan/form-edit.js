// =======================
// FORM EDIT
// =======================
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('button[id^="editButton-"]').forEach(button => {
        const id = button.id.split('-')[1];
        const editFormDiv = document.getElementById(`editForm-${id}`);
        const closeEditBtn = document.getElementById(`closeEditButton-${id}`);
        const cancelEditBtn = document.getElementById(`cancelEditButton-${id}`);

        button.addEventListener('click', () => {
            editFormDiv?.classList.remove('hidden');
            editFormDiv?.classList.add('animate-fade-in');
        });

        [closeEditBtn, cancelEditBtn].forEach(btn => {
            btn?.addEventListener('click', () => {
                editFormDiv?.classList.remove('animate-fade-in');
                editFormDiv?.classList.add('animate-fade-out');
                setTimeout(() => {
                    editFormDiv?.classList.add('hidden');
                    editFormDiv?.classList.remove('animate-fade-out');
                }, 300);
            });
        });
    });
});

// =======================
// PREVIEW IMAGE EDIT
// =======================
const selectedEditFiles = {};
export function handleSingleImageEdit(event, id) {
    if (!selectedEditFiles[id]) selectedEditFiles[id] = [];

    const files = Array.from(event.target.files);
    if (files.length === 0) return;

    files.forEach(file => {
        if (file && file.type.startsWith('image/')) {
            selectedEditFiles[id].push(file);
        }
    });

    previewImagesEdit(id);
    updateHiddenFileInputsEdit(id);
    event.target.remove();
    createNewInputEdit(id);
}
window.handleSingleImageEdit = handleSingleImageEdit;

function createNewInputEdit(id) {
    const container = document.getElementById(`inputEditContainer-${id}`);
    if (!container) return;

    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'incident_photo[]';
    newInput.accept = 'image/*';
    newInput.multiple = false;
    newInput.onchange = e => handleSingleImageEdit(e, id);
    newInput.className = 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';
    container.appendChild(newInput);
}

function previewImagesEdit(id) {
    const previewContainer = document.getElementById(`imgEditPreviewContainer-${id}`);
    if (!previewContainer) return;
    previewContainer.innerHTML = '';

    selectedEditFiles[id].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('w-24', 'h-auto', 'rounded-md', 'shadow', 'border');
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function updateHiddenFileInputsEdit(id) {
    const form = document.getElementById(`editFormReport-${id}`);
    if (!form) return;
    const existingInputs = form.querySelectorAll('.cloned-file');
    existingInputs.forEach(input => input.remove());

    selectedEditFiles[id].forEach(file => {
        const dt = new DataTransfer();
        dt.items.add(file);

        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'incident_photo[]';
        newInput.files = dt.files;
        newInput.classList.add('hidden', 'cloned-file');
        form.appendChild(newInput);
    });
}
