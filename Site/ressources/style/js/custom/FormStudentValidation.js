document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("addFormStudent");

  form.addEventListener("submit", function (event) {
    let isValid = true;

    // Réinitialise les messages d'erreur
    clearError("lastname");
    clearError("firstname");
    clearError("entry_date");
    clearError("validity_date");
    clearError("picture");

    // Vérifie le nom
    const lastname = document.getElementById("lastname");
    if (!lastname.value.trim()) {
      showError("lastname", "Le nom est requis.");
      isValid = false;
    } else if (!isOnlyLetters(lastname.value)) {
      showError("lastname", "Le nom doit contenir seulement des lettres.");
      isValid = false;
    }

    // Vérifie le prénom
    const firstname = document.getElementById("firstname");
    if (!firstname.value.trim()) {
      showError("firstname", "Le prénom est requis.");
      isValid = false;
    } else if (!isOnlyLetters(firstname.value)) {
      showError("firstname", "Le prénom doit contenir seulement des lettres.");
      isValid = false;
    }

    // Vérifie la date d'entrée
    const entryDate = document.getElementById("entry_date");
    if (!entryDate.value) {
      showError("entry_date", "Date d'entrée requise.");
      isValid = false;
    }

    // Vérifie la date de validité
    const validityDate = document.getElementById("validity_date");
    if (!validityDate.value) {
      showError("validity_date", "Date de validité requise.");
      isValid = false;
    }

    // Vérifie la photo
    const picture = document.getElementById("picture");
    if (!picture.value) {
      showError("picture", "Une photo est requise.");
      isValid = false;
    }

    if (!isValid) {
      event.preventDefault();
    }
  });

  function isOnlyLetters(str) {
    return /^[a-zA-ZÀ-ÿ\s'-]+$/.test(str);
  }

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
