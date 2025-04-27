document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let formIsOk = true;

        const wineName = document.getElementById("wineName").value.trim();
        const wineType = document.getElementById("wineType").value.trim();
        const wineCepage = document.getElementById("wineCepage").value.trim();
        const wineMillesime = document.getElementById("wineMillesime").value;
        const wineBuyDate = document.getElementById("wineBuyDate").value;
        const winePrice = document.getElementById("winePrice").value;
        const wineQuantity = document.getElementById("wineQuantity").value;

        if (!wineName) {
            formIsOk = false;
            document.getElementById("errorwineName").textContent = "Veuillez entrer un nom";
        } else {
            document.getElementById("errorwineName").textContent = "";
        }

        if (!wineType) {
            formIsOk = false;
            document.getElementById("errorwineType").textContent = "Veuillez choisir un type";
        } else {
            document.getElementById("errorwineType").textContent = "";
        }

        if (!wineCepage) {
            formIsOk = false;
            document.getElementById("errorwineCepage").textContent = "Veuillez entrer un cépage";
        } else {
            document.getElementById("errorwineCepage").textContent = "";
        }

        const currentYear = new Date().getFullYear();
        if (!wineMillesime || wineMillesime < 1800 || wineMillesime > currentYear + 1) {
            formIsOk = false;
            document.getElementById("errorwineMillesime").textContent = "Veuillez entrer un millésime valide";
        } else {
            document.getElementById("errorwineMillesime").textContent = "";
        }

        if (!wineBuyDate) {
            formIsOk = false;
            document.getElementById("errorwineBuyDate").textContent = "Veuillez entrer une date d'achat";
        } else {
            document.getElementById("errorwineBuyDate").textContent = "";
        }

        if (!winePrice || isNaN(winePrice) || winePrice <= 0) {
            formIsOk = false;
            document.getElementById("errorwinePrice").textContent = "Veuillez entrer un prix valide";
        } else {
            document.getElementById("errorwinePrice").textContent = "";
        }

        if (!wineQuantity || isNaN(wineQuantity) || wineQuantity < 0) {
            formIsOk = false;
            document.getElementById("errorwineQuantity").textContent = "Veuillez entrer une quantité valide";
        } else {
            document.getElementById("errorwineQuantity").textContent = "";
        }

        if (formIsOk) {
            form.submit();
        }
    });
});
