document.addEventListener("DOMContentLoaded", function () {
    let cropper = null;
    let lastRotation = 0;

    const form = document.getElementById("formBook") ||
                 document.getElementById("formStudent");
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const cropContainer = document.getElementById('imageCropContainer');
    const cropControls = document.getElementById('cropControls');
    const rotationRange = document.getElementById('rotationRange');
    const rotationValue = document.getElementById('rotationValue');
    const resetBtn = document.getElementById('resetPicture');

    if (!form || !input || !preview) return;

 const initCropper = () => {
    if (cropper) {
        cropper.destroy();
    }

    preview.style.display = 'block';
    cropContainer.style.display = 'block';
    cropControls.style.display = 'flex';

    cropper = new Cropper(preview, {
        viewMode: 1, // Le crop ne peut pas dépasser le conteneur. L'image est restreinte à la zone visible.
        
        dragMode: 'move', // Permet de déplacer l'image (pas le cadre). Empêche la création d’un nouveau cadre.
        
        cropBoxMovable: false, // Le cadre de recadrage est fixe : l'utilisateur ne peut pas le déplacer.
        
        cropBoxResizable: false, // Le cadre ne peut pas être redimensionné. Sa taille reste constante.
        
        zoomable: true, // Active le zoom (molette, gestuelle, boutons).
        
        scalable: false, // Empêche le redimensionnement de l’image par redimensionnement proportionnel.
        
        aspectRatio: 2 / 3, // Définit un ratio fixe (largeur / hauteur) pour le cadre – ici format livre.
        
        background: true, // Affiche un fond (gris clair par défaut) derrière l’image, utile si elle est transparente.
        
        responsive: true, // Redimensionne le cropper automatiquement si la fenêtre change de taille.
        
        autoCropArea: 1, // Le cadre de recadrage occupe 100 % de la zone disponible à l'ouverture.
        
        movable: true, // Permet de déplacer l’image dans le cadre (utile si le cadre est fixe).
        
        rotatable: true, // Autorise la rotation de l’image.

        ready() {
            // Définition d'une taille fixe pour le cadre (300x450) en respectant le ratio 2:3
            const cropBoxWidth = 300;
            const cropBoxHeight = 450;

            // Récupère les dimensions du conteneur pour centrer le cadre
            const containerData = cropper.getContainerData();
            const left = (containerData.width - cropBoxWidth) / 2;
            const top = (containerData.height - cropBoxHeight) / 2;

            // Applique les dimensions et positionne le cadre au centre
            cropper.setCropBoxData({
                width: cropBoxWidth,
                height: cropBoxHeight,
                left: left,
                top: top
            });

            // Réinitialise la rotation à 0°
            lastRotation = 0;
            rotationRange.value = 0;
            rotationValue.textContent = '0°';
        }
    });

};
    if (preview && preview.src && !preview.src.includes('default.jpg')) {
        preview.addEventListener('load', initCropper);
        if (preview.complete) {
            initCropper();
        }
    }

    rotationRange.addEventListener('input', function () {
        const angle = parseInt(this.value);
        rotationValue.textContent = angle + '°';

        if (cropper) {
            const delta = angle - lastRotation;
            cropper.rotate(delta);
            lastRotation = angle;
        }
    });

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
                resetBtn.classList.remove("d-none");
            };
        };

        reader.readAsDataURL(file);
    });

    resetBtn.addEventListener("click", function () {
        input.value = "";
        preview.src = "";
        cropContainer.style.display = 'none';
        cropControls.style.display = 'none';
        resetBtn.classList.add("d-none");

        if (cropper) {
            cropper.destroy();
            cropper = null;
        }

        const label = input.nextElementSibling;
        if (label) {
            label.textContent = "Choisir une photo";
        }
    });

    form.addEventListener("submit", function () {
        const hiddenInput = document.getElementById("croppedPicture");
        if (cropper && hiddenInput) {
        const canvas = cropper.getCroppedCanvas({
            fillColor: '#ffffff'  // Remplit le fond avec du blanc
        });            
            if (canvas) {
                hiddenInput.value = canvas.toDataURL("image/jpeg");
            }
        }
    });
});
