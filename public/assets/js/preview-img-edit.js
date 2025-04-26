// ========== BIKIN handleEditImages() DI LUAR ==========
const selectedEditFiles = {}; // Simpan file edit per id user

function handleSingleImageEdit(event, id) {
    if (!selectedEditFiles[id]) {
        selectedEditFiles[id] = [];
    }

    const files = Array.from(event.target.files);
    if (files.length === 0) return;

    files.forEach(file => {
        if (file && file.type.startsWith('image/')) {
            selectedEditFiles[id].push(file);
        }
    });

    previewImagesEdit(id);
    updateHiddenFileInputsEdit(id);

    // Hapus input lama
    event.target.remove();

    // Buat input file baru
    createNewInputEdit(id);
}

function createNewInputEdit(id) {
    const container = document.getElementById(`inputEditContainer-${id}`);
    const newInput = document.createElement('input');

    newInput.type = 'file';
    newInput.name = 'incident_photo[]';
    newInput.accept = 'image/*';
    newInput.multiple = false;
    newInput.onchange = function (event) {
        handleSingleImageEdit(event, id);
    };
    newInput.className = 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';

    container.appendChild(newInput);
}

function previewImagesEdit(id) {
    const previewContainer = document.getElementById(`imgEditPreviewContainer-${id}`);
    previewContainer.innerHTML = '';

    selectedEditFiles[id].forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
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