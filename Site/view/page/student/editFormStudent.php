<div class="container mt-3 mb-3">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white py-2">
      <h5 class="mb-0">Modifier un élève</h5>
    </div>
    <div class="card-body py-3">
      <form id="formStudent" method="post" action="?controller=student&action=updateStudent&id=<?= $student[0]['id_student'] ?>" enctype="multipart/form-data">

        <div class="form-row">
          <div class="form-group col-md-6 mb-2">
            <label for="lastname">Nom*</label>
            <input class="form-control" name="lastname" id="lastname" value="<?= $student[0]['lastname'] ?>" placeholder="Nom de famille">
            <span id="errorLastname" class="invalid-feedback" style="display:none;"></span>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="firstname">Prénom*</label>
            <input class="form-control" name="firstname" id="firstname" value="<?= $student[0]['firstname'] ?>" placeholder="Prénom">
            <span id="errorFirstname" class="invalid-feedback" style="display:none;"></span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 mb-2">
            <label for="birthdate">Date de naissance</label>
            <input type="date" class="form-control" name="birthdate" id="birthdate" value="<?= $student[0]['birthdate'] ?>">
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="phone">Téléphone</label>
            <input class="form-control" name="phone" id="phone" value="<?= $student[0]['phone'] ?>" placeholder="+22912345678">
          </div>
        </div>

        <div class="form-group mb-2">
          <label for="institution">Établissement / Employeur</label>
          <input class="form-control" name="institution" id="institution" value="<?= $student[0]['institution'] ?>" placeholder="Établissement ou employeur">
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 mb-2">
            <label for="entry_date">Date d'entrée*</label>
            <input type="date" class="form-control" name="entry_date" id="entry_date" value="<?= $student[0]['entry_date'] ?>">
            <span id="errorEntry_date" class="invalid-feedback" style="display:none;"></span>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="validity_date">Date de validité*</label>
            <input type="date" class="form-control" name="validity_date" id="validity_date" value="<?= $student[0]['validity_date'] ?>">
            <span id="errorValidity_date" class="invalid-feedback" style="display:none;"></span>
          </div>
        </div>

        <div class="form-group mb-2">
          <label for="address">Adresse</label>
          <input class="form-control" name="address" id="address" value="<?= $student[0]['address'] ?>" placeholder="Rue, Quartier, BP, Arrondissement, Commune">
        </div>

        <div class="form-group mb-2">
          <label for="comment">Remarque</label>
          <input class="form-control" name="comment" id="comment" value="<?= $student[0]['comment'] ?>" placeholder="Remarque éventuelle">
        </div>

        <div class="form-group mb-2">
          <label for="picture">Photo </label>
          <div class="input-group">
            <div class="custom-file">
              <input name="picture" type="file" class="custom-file-input" id="imageInput" accept=".png, .jpg, .jpeg, .webp, .gif">
              <label class="custom-file-label" for="picture">Changer la photo</label>
            </div>
            <button type="button" class="btn btn-outline-danger d-none" id="resetPicture">Retirer</button>
          </div>
          <span id="errorPicture" class="invalid-feedback" style="display:none;"></span>
        </div>

        <input type="hidden" name="cropped_picture" id="croppedPicture">

        <div class="form-group mb-2" id="imageCropContainer" style="display:none;">
          <img id="imagePreview" src="./ressources/img/student/<?= $student[0]['photo'] ?>" style="max-width: 100%;">
        </div>

        <div class="form-group mb-2" id="cropControls" style="display:none;">
          <label for="rotationRange" class="small mb-1">Rotation : <span id="rotationValue">0°</span></label>
          <input type="range" id="rotationRange" class="w-100" min="0" max="360" step="1" value="0">
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-outline-primary mt-2">Enregistrer les modifications</button>
        </div>
      </form>
    </div>
  </div>
</div>
