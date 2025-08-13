// =======================
// FORM CREATE
// =======================
document.addEventListener('DOMContentLoaded', () => {
    const createButton = document.getElementById('createButton');
    const createForm = document.getElementById('createForm');
    const cancelButton = document.getElementById('cancelButton');
    const exitButton = document.getElementById('exitButton');
    const reportForm = document.getElementById('reportForm');

    if (createButton && createForm) {
        createButton.addEventListener('click', () => {
            createForm.classList.remove('hidden', 'animate-fade-out');
            createForm.classList.add('animate-fade-in');
        });
    }

    [cancelButton, exitButton].forEach(btn => {
        if (btn && createForm) {
            btn.addEventListener('click', () => {
                createForm.classList.remove('animate-fade-in');
                createForm.classList.add('animate-fade-out');
                setTimeout(() => createForm.classList.add('hidden'), 200);
            });
        }
    });

    if (reportForm && createForm) {
        reportForm.addEventListener('submit', () => {
            createForm.classList.remove('animate-fade-in');
            createForm.classList.add('animate-fade-out');
            setTimeout(() => createForm.classList.add('hidden'), 300);
        });
    }
});

// =======================
// PREVIEW IMAGE CREATE
// =======================
let selectedFiles = [];
export function handleSingleImage(event) {
    const files = Array.from(event.target.files);
    if (files.length === 0) return;

    files.forEach(file => {
        if (file && file.type.startsWith('image/')) {
            selectedFiles.push(file);
        }
    });

    previewImages();
    updateHiddenFileInputs();
    event.target.remove();
    createNewInput();
}
window.handleSingleImage = handleSingleImage;

function createNewInput() {
    const container = document.getElementById('inputContainer');
    if (!container) return;

    const newInput = document.createElement('input');
    newInput.type = 'file';
    newInput.name = 'incident_photo[]';
    newInput.accept = 'image/*';
    newInput.multiple = false;
    newInput.onchange = handleSingleImage;
    newInput.className = 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';
    container.appendChild(newInput);
}

function previewImages() {
    const previewContainer = document.getElementById('imgPreviewContainer');
    if (!previewContainer) return;
    previewContainer.innerHTML = '';

    selectedFiles.forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('w-24', 'h-24', 'object-cover', 'aspect-square', 'rounded-md', 'shadow', 'border');
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function updateHiddenFileInputs() {
    const form = document.getElementById('reportForm');
    if (!form) return;
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

