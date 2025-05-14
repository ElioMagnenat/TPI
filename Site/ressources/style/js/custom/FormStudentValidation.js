document.getElementById('formLoan').addEventListener('submit', function(event) {
    // Récupération des champs
    const studentId = document.getElementById('studentId');
    const startDate = document.getElementById('startDate');
    const expectedReturnDate = document.getElementById('expectedReturnDate');

    // Messages d'erreur
    const errorStudentId = document.getElementById('errorStudentId');
    const errorStartDate = document.getElementById('errorStartDate');
    const errorExpectedReturnDate = document.getElementById('errorExpectedReturnDate');

    // Réinitialisation
    errorStudentId.style.display = 'none';
    errorStartDate.style.display = 'none';
    errorExpectedReturnDate.style.display = 'none';

    let valid = true;

    // Vérifie qu’un élève est sélectionné
    if (studentId.value === '') {
        errorStudentId.style.display = 'block';
        valid = false;
    }

    // Vérifie que la date d’emprunt est remplie
    if (startDate.value === '') {
        errorStartDate.style.display = 'block';
        valid = false;
    }

    // Vérifie que la date de retour est remplie
    if (expectedReturnDate.value === '') {
        errorExpectedReturnDate.textContent = 'Veuillez indiquer une date de retour';
        errorExpectedReturnDate.style.display = 'block';
        valid = false;
    }

    // Vérifie que la date de retour est après la date d’emprunt
    if (startDate.value !== '' && expectedReturnDate.value !== '') {
        const start = new Date(startDate.value);
        const end = new Date(expectedReturnDate.value);

        if (end <= start) {
            errorExpectedReturnDate.textContent = 'La date de retour doit être après la date d\'emprunt';
            errorExpectedReturnDate.style.display = 'block';
            valid = false;
        }
    }

    if (!valid) {
        event.preventDefault(); // Empêche l'envoi si non valide
    }
});
