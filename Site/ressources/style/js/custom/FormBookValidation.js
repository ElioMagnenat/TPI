document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formBook");
  
    form.addEventListener("submit", function (event) {
      let isValid = true;
  
      // Réinitialisation
      clearError("title");
      clearError("author");
      clearError("edition");
      clearError("category");
      clearError("reference");
      clearError("location");
  
      // Vérification des champs
      const title = document.getElementById("title");
      if (!title.value.trim()) {
        showError("title", "Le titre est requis.");
        isValid = false;
      }
  
      const author = document.getElementById("author");
      if (!author.value.trim()) {
        showError("author", "L’auteur est requis.");
        isValid = false;
      }
  
      const edition = document.getElementById("edition");
      if (!edition.value.trim()) {
        showError("edition", "L’édition est requise.");
        isValid = false;
      }
  
      const category = document.getElementById("category");
      if (!category.value.trim()) {
        showError("category", "La catégorie est requise.");
        isValid = false;
      }
  
      const reference = document.getElementById("reference");
      if (!reference.value.trim()) {
        showError("reference", "La référence est requise.");
        isValid = false;
      }
  
      const location = document.getElementById("location");
      if (!location.value.trim()) {
        showError("location", "L’emplacement est requis.");
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
      document.getElementById(fieldId).classList.add("is-invalid");
    }
  
    function clearError(fieldId) {
      const span = document.getElementById("error" + capitalize(fieldId));
      if (span) {
        span.textContent = "";
        span.style.display = "none";
      }
      document.getElementById(fieldId).classList.remove("is-invalid");
    }
  
    function capitalize(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    }
  });
  