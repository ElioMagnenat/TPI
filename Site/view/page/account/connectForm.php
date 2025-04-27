<?php
if (!isset($_SESSION["connectUser"]["errorConnection"])){
    $_SESSION["connectUser"]["errorConnection"] = "";
}
?>
<div class="mt-5 d-flex justify-content-center align-items-center flex-column">
<h3 class="m-0 font-weight-bold text-primary">Connexion </h3>
    <form id="connectForm" class="w-50" method="post" action="?controller=account&action=verifUserConnection">
    <div class="mb-3">
        <label for="username" class="form-label">Nom d'utilisateur</label>
        <input class="form-control" name="username" id="username" aria-describedby="emailHelp">
        <span id="errorUserName" class="alert-danger"></span>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
        <span id="errorPassword" class="alert-danger"></span>
        <span" class="alert-danger"> <?=$_SESSION["connectUser"]["errorConnection"]?></span>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
    <p><a class="link-opacity-50 " href="?controller=account&action=eduvaudConnection">Connectez-vous avec votre compte EduVaud</a></p>
    <p><a class="link-opacity-50 " href="?controller=account&action=createForm">Vous n'avez pas de compte ?</a></p>

    </form>
</div>


<script>
        document.getElementById("connectForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formIsOk = true;

            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value;

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

            if (formIsOk) {
                this.submit();
            }
        });
</script>