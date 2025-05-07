document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addFormBook");

    const requiredFields = [
        "title",
        "author",
        "edition",
        "category",
        "reference",
        "location"
    ];

    // Masquer les erreurs au chargement de la page
    requiredFields.forEach((id) => {
        const span = document.getElementById("error" + capitalize(id));
        if (span) span.style.display = "none";
    });

    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Réinitialiser les messages
        requiredFields.forEach((id) => {
            const span = document.getElementById("error" + capitalize(id));
            if (span) span.style.display = "none";
        });

        // Vérifier chaque champ
        requiredFields.forEach((id) => {
            const field = document.getElementById(id);
            const span = document.getElementById("error" + capitalize(id));
            if (field && span && !field.value.trim()) {
                span.style.display = "inline";
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
});
