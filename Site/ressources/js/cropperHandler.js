document.addEventListener("DOMContentLoaded", function () {
    let cropper = null;
    let lastRotation = 0;

    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const cropContainer = document.getElementById('imageCropContainer');
    const cropControls = document.getElementById('cropControls');
    const rotationRange = document.getElementById('rotationRange');
    const rotationValue = document.getElementById('rotationValue');

    const form = document.getElementById("editForm") ||
                 document.getElementById("addForm") ||
                 document.getElementById("createForm");

    if (!form || !input || !preview) return;

    const initCropper = () => {
        if (cropper) {
            cropper.destroy();
        }

        preview.style.display = 'block';
        cropContainer.style.display = 'block';
        cropControls.style.display = 'flex';

        cropper = new Cropper(preview, {
            aspectRatio:  1 ,
            viewMode: 1, // Empêche de sortir du cadre
            autoCropArea: 1, // Utilise toute la zone visible
            movable: true,
            zoomable: true,
            rotatable: true,
            scalable: true,
            responsive: true,
            background: true,
            ready() {
                lastRotation = 0;
            }
        });
    };

    rotationRange.addEventListener('input', function () {
        const angle = parseInt(this.value);
        rotationValue.textContent = angle + '°';

        if (cropper) {
            const delta = angle - lastRotation;
            cropper.rotate(delta);
            lastRotation = angle;
        }
    });

    // Initialisation si image déjà présente
    if (preview && preview.src && !preview.src.includes('default.jpg')) {
        preview.addEventListener('load', () => {
            initCropper();
        });

        if (preview.complete) {
            initCropper();
        }
    }

    // Lorsqu’on sélectionne un nouveau fichier
    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const label = input.nextElementSibling;
        if (label) {
            label.textContent = file.name;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;

            preview.onload = function () {
                initCropper();
            };
        };

        reader.readAsDataURL(file);
    });
});
