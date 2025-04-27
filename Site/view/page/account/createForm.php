<?php
if (!isset($_SESSION["createUser"]["errorUserName"])){
    $_SESSION["createUser"]["errorUserName"] = "";
}
?>
<div class="mt-5 d-flex justify-content-center align-items-center flex-column">
<h3 class="m-0 font-weight-bold text-primary">Nouveau compte</h3>
    <form id="createForm" class="w-50" method="post" action="?controller=account&action=verifCreateUser" enctype="multipart/form-data" data-cropper>
    <div class="mb-3">
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <input class="form-control" id="username" name="username" aria-describedby="emailHelp">
        <span id="errorUserName" class="alert-danger"></span>
        <span class="alert-danger"><?=$_SESSION["createUser"]["errorUserName"]?></span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
        <span id="errorPassword" class="alert-danger"></span>
    </div>
    <div class="mb-3">
        <label for="passwordVerify" class="form-label">Entrez le mot de passe à nouveau</label>
        <input type="password" class="form-control" id="passwordVerify" name="passwordVerify">
        <span id="errorPasswordVerify" class="alert-danger"></span>
    </div>
    <div class="mb-3">
        <label for="imageInput" class="form-label">Photo de profil (optionnel)</label>
        <div class="custom-file">
            <input name="picture" type="file" class="custom-file-input" id="imageInput" accept=".png, .jpg, .jpeg, .webp, .gif">
            <label class="custom-file-label" for="imageInput">Choisir une photo</label>
            <span id="errorUserPicture" class="alert-danger"></span>
        </div>
        </div>

        <div class="mb-3">
        <!-- Zone de crop -->
        <div id="imageCropContainer" class="mb-3" style="display:none;">
            <img id="imagePreview">
        </div>

        <div id="cropControls" class="mb-3" style="display: none; flex-direction: column;">
            <label for="rotationRange">Rotation : <span id="rotationValue">0°</span></label>
            <input type="range" id="rotationRange" min="0" max="360" step="1" value="0">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Créer le compte</button>
    <p><a class="link-opacity-50 " href="?controller=account&action=connectForm">Vous avez déjà un compte ?</a></p>
    </form>
</div>
<script>
        document.getElementById("createForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formIsOk = true;

            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value;
            const passwordVerify = document.getElementById("passwordVerify").value;

            // Vérification nom d'utilisateur
            if (!username) {
                formIsOk = false;
                document.getElementById("errorUserName").textContent = "Veuillez entrer un nom d'utilisateur";
            } else {
                document.getElementById("errorUserName").textContent = "";
            }

            // Vérification mot de passe
            if (!password) {
                formIsOk = false;
                document.getElementById("errorPassword").textContent = "Veuillez entrer un mot de passe";
            } else {
                document.getElementById("errorPassword").textContent = "";
            }

            // Vérification confirmation mot de passe
            if (!passwordVerify) {
                formIsOk = false;
                document.getElementById("errorPasswordVerify").textContent = "Veuillez réécrire votre mot de passe";
            } else {
                document.getElementById("errorPasswordVerify").textContent = "";
            }

            // Vérification correspondance des mots de passe
            if (formIsOk && password !== passwordVerify) {
                formIsOk = false;
                document.getElementById("errorPasswordVerify").textContent = "Les mots de passe ne correspondent pas";
            }

            if (formIsOk) {
                this.submit();
            }
        });
</script>
