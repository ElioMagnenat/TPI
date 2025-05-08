<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Ajouter un élève</h4>
        </div>
        <div class="card-body">
            <form id="addFormStudent" method="post" action="?controller=student&action=addStudent" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input class="form-control" name="lastname" id="lastname" placeholder="Nom de famille">
                    <span id="errorLastname" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input class="form-control" name="firstname" id="firstname" placeholder="Prénom">
                    <span id="errorFirstname" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" name="birthdate" id="birthdate">
                </div>

                <div class="mb-3">
                    <label for="institution" class="form-label">Etablissement/Employeur</label>
                    <input class="form-control" name="institution" id="institution" placeholder="Établissement ou employeur">
                </div>

                <div class="mb-3">
                    <label for="entry_date" class="form-label">Date d'entrée</label>
                    <input type="date" class="form-control" name="entry_date" id="entry_date">
                    <span id="errorEntry_date" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="validity_date" class="form-label">Date de validité</label>
                    <input type="date" class="form-control" name="validity_date" id="validity_date">
                    <span id="errorValidity_date" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone de contact</label>
                    <input class="form-control" name="phone" id="phone" placeholder="+22912345678">
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Remarque (infos supplémentaires)</label>
                    <input class="form-control" name="comment" id="comment" placeholder="Remarque éventuelle">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input class="form-control" name="address" id="address" placeholder="Rue, Quartier, BP, Arrondissement, Commune">
                </div>

                <div class="mb-3">
                    <label for="picture" class="form-label">Photo</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="picture" type="file" class="custom-file-input" id="picture" accept=".png, .jpg, .jpeg, .webp, .gif">
                            <label class="custom-file-label" for="picture">Choisir une photo</label>
                        </div>
                        <button type="button" class="btn btn-outline-danger d-none" id="resetPicture">Retirer</button>
                    </div>
                    <span id="errorPicture" class="invalid-feedback"></span>
                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
