// Script untuk preview image saat create form
let selectedFiles = [];

function handleSingleImage(event) {
    const files = Array.from(event.target.files);
    if (files.length === 0) return;

    files.forEach(file => {
        if (file && file.type.startsWith('image/')) {
            selectedFiles.push(file);
        }
    });

    previewImages();
    updateHiddenFileInputs();

    // Hapus input lama
    event.target.remove();

    // Buat input file baru agar user bisa pilih lagi
    createNewInput();
}

function createNewInput() {
    const container = document.getElementById('inputContainer');
    const newInput = document.createElement('input');

    newInput.type = 'file';
    newInput.name = 'incident_photo[]';
    newInput.accept = 'image/*';
    newInput.multiple = false; // agar 1 per klik
    newInput.onchange = handleSingleImage;
    newInput.className = 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';

    container.appendChild(newInput);
}

function previewImages() {
    const previewContainer = document.getElementById('imgPreviewContainer');
    previewContainer.innerHTML = '';

    selectedFiles.forEach(file => {
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

function updateHiddenFileInputs() {
    const form = document.getElementById('reportForm');
    const existingInputs = document.querySelectorAll('.cloned-file');
    existingInputs.forEach(input => input.remove());

    selectedFiles.forEach(file => {
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
