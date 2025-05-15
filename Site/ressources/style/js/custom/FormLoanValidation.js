// Vérification du formulaire de retour
const formRestore = document.getElementById('formRestore');
if (formRestore) {
    formRestore.addEventListener('submit', function(event) {
        let isValid = true;

        const returnDate = document.getElementById('returnDate');
        const errorReturnDate = document.getElementById('errorReturnDate');

        // Réinitialise l'affichage des messages d'erreur
        errorReturnDate.style.display = 'none';

        // Vérifie si une date de retour est sélectionnée
        if (returnDate.value === '') {
            errorReturnDate.style.display = 'block';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
}

// Vérification du formulaire d'emprunt
const formLoan = document.getElementById('formLoan');
if (formLoan) {
    formLoan.addEventListener('submit', function(event) {
        let isValid = true;

        const studentId = document.getElementById('studentId');
        const startDate = document.getElementById('startDate');
        const expectedReturnDate = document.getElementById('expectedReturnDate');

        const errorStudentId = document.getElementById('errorStudentId');
        const errorStartDate = document.getElementById('errorStartDate');
        const errorExpectedReturnDate = document.getElementById('errorExpectedReturnDate');

        // Réinitialise l'affichage des messages d'erreur
        errorStudentId.style.display = 'none';
        errorStartDate.style.display = 'none';
        errorExpectedReturnDate.style.display = 'none';

        // Vérifie si un élève est sélectionné
        if (studentId.value === '') {
            errorStudentId.style.display = 'block';
            isValid = false;
        }

        // Vérifie si la date d'emprunt est remplie
        if (startDate.value === '') {
            errorStartDate.style.display = 'block';
            isValid = false;
        }

        // Vérifie si la date de retour est remplie
        if (expectedReturnDate.value === '') {
            errorExpectedReturnDate.style.display = 'block';
            isValid = false;
        }

        // Vérifie que la date de retour est après la date d'emprunt
        if (startDate.value && expectedReturnDate.value) {
            const start = new Date(startDate.value);
            const expected = new Date(expectedReturnDate.value);
            if (expected <= start) {
                errorExpectedReturnDate.style.display = 'block';
                isValid = false;
            }
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
}
