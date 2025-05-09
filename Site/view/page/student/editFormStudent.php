<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Modifier un élève</h4>
        </div>
        <div class="card-body">
            <form id="editFormStudent" method="post" action="?controller=student&action=updateStudent&id=<?= $student[0]['id_student'] ?>" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom*</label>
                    <input class="form-control" name="lastname" id="lastname" value="<?= $student[0]['lastname'] ?>" placeholder="Nom de famille">
                    <span id="errorLastname" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom*</label>
                    <input class="form-control" name="firstname" id="firstname" value="<?= $student[0]['firstname'] ?>" placeholder="Prénom">
                    <span id="errorFirstname" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?= $student[0]['birthdate'] ?>">
                </div>

                <div class="mb-3">
                    <label for="institution" class="form-label">Etablissement/Employeur</label>
                    <input class="form-control" name="institution" id="institution" value="<?= $student[0]['institution'] ?>" placeholder="Établissement ou employeur">
                </div>

                <div class="mb-3">
                    <label for="entry_date" class="form-label">Date d'entrée*</label>
                    <input type="date" class="form-control" name="entry_date" id="entry_date" value="<?= $student[0]['entry_date'] ?>">
                    <span id="errorEntry_date" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="validity_date" class="form-label">Date de validité*</label>
                    <input type="date" class="form-control" name="validity_date" id="validity_date" value="<?= $student[0]['validity_date'] ?>">
                    <span id="errorValidity_date" class="invalid-feedback" style="display:none;"></span>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone de contact</label>
                    <input class="form-control" name="phone" id="phone" value="<?= $student[0]['phone'] ?>" placeholder="+22912345678">
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Remarque (infos supplémentaires)</label>
                    <input class="form-control" name="comment" id="comment" value="<?= $student[0]['comment'] ?>" placeholder="Remarque éventuelle">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Adresse</label>
                    <input class="form-control" name="address" id="address" value="<?= $student[0]['address'] ?>" placeholder="Rue, Quartier, BP, Arrondissement, Commune">
                </div>

                <div class="mb-3">
                    <label for="picture" class="form-label">Photo (laisser vide pour conserver la photo actuelle)</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="picture" type="file" class="custom-file-input" id="picture" accept=".png, .jpg, .jpeg, .webp, .gif">
                            <label class="custom-file-label" for="picture">Changer la photo</label>
                        </div>
                        <button type="button" class="btn btn-outline-danger d-none" id="resetPicture">Retirer</button>
                    </div>
                    <span id="errorPicture" class="invalid-feedback" style="display: none;"></span>
                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
