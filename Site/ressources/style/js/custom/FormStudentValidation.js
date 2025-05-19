document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formStudent");

    if (!form) return;

    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Réinitialisation
        clearError("lastname");
        clearError("firstname");
        clearError("entry_date");
        clearError("validity_date");
        clearError("picture");

        // Vérification : nom
        const lastname = document.getElementById("lastname");
        if (!lastname.value.trim()) {
            showError("lastname", "Le nom est requis.");
            isValid = false;
        }

        // Vérification : prénom
        const firstname = document.getElementById("firstname");
        if (!firstname.value.trim()) {
            showError("firstname", "Le prénom est requis.");
            isValid = false;
        }

        // Vérification : date d'entrée
        const entryDate = document.getElementById("entry_date");
        if (!entryDate.value.trim()) {
            showError("entry_date", "La date d'entrée est requise.");
            isValid = false;
        }

        // Vérification : date de validité
        const validityDate = document.getElementById("validity_date");
        if (!validityDate.value.trim()) {
            showError("validity_date", "La date de validité est requise.");
            isValid = false;
        }

        // Vérification : photo (obligatoire uniquement pour le formulaire d'ajout)
        const picture = document.getElementById("imageInput");
        const isModification = form.action.includes("updateStudent");
        if (!isModification && picture.files.length === 0) {
            showError("picture", "La photo est obligatoire.");
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(fieldId, message) {
        const span = document.getElementById("error" + capitalize(fieldId));
        if (span) {
            span.textContent = message;
            span.style.display = "block";
        }
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.add("is-invalid");
        }
    }

    function clearError(fieldId) {
        const span = document.getElementById("error" + capitalize(fieldId));
        if (span) {
            span.textContent = "";
            span.style.display = "none";
        }
        const field = document.getElementById(fieldId);
        if (field) {
            field.classList.remove("is-invalid");
        }
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
