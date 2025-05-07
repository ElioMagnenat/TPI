document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("picture");
    const resetBtn = document.getElementById("resetPicture");

    if (!fileInput || !resetBtn) return;

    const label = fileInput.nextElementSibling;

    fileInput.addEventListener("change", function (e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            label.innerText = fileName;
            resetBtn.classList.remove("d-none");
        }
    });

    resetBtn.addEventListener("click", function () {
        fileInput.value = "";
        label.innerText = "Choisir une photo";
        resetBtn.classList.add("d-none");
    });
});
