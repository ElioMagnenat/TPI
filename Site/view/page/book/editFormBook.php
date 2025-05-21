<div class="container mt-3 mb-3">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white py-2">
      <h5 class="mb-0">Modifier un livre</h5>
    </div>
    <div class="card-body py-3">
      <form id="formBook" method="post" action="?controller=book&action=updateBook&id=<?= $book[0]['id_book'] ?>" enctype="multipart/form-data">

        <div class="form-row">
          <div class="form-group col-md-6 mb-2">
            <label for="title">Titre*</label>
            <input class="form-control" name="title" id="title" value="<?= $book[0]['title'] ?>" placeholder="Titre du livre">
            <span id="errorTitle" class="invalid-feedback" style="display:none;">Veuillez entrer un titre</span>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="author">Auteur*</label>
            <input class="form-control" name="author" id="author" value="<?= $book[0]['author'] ?>" placeholder="Auteur du livre">
            <span id="errorAuthor" class="invalid-feedback" style="display:none;">Veuillez entrer un auteur</span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 mb-2">
            <label for="edition">Édition*</label>
            <input class="form-control" name="edition" id="edition" value="<?= $book[0]['edition'] ?>" placeholder="Maison d'édition">
            <span id="errorEdition" class="invalid-feedback" style="display:none;">Veuillez entrer une maison d'édition</span>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="category">Catégorie*</label>
            <select class="form-control" id="category" name="category">
              <option value="<?= $book[0]['id_category'] ?>"><?= $book[0]['category'] ?></option>
              <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id_category'] ?>" <?= $book[0]['category'] == $category['id_category'] ? 'selected' : '' ?>>
                  <?= $category['name'] ?>
                </option>
              <?php endforeach; ?>
            </select>
            <span id="errorCategory" class="invalid-feedback" style="display:none;">Veuillez sélectionner une catégorie</span>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6 mb-2">
            <label for="reference">Référence*</label>
            <input class="form-control" name="reference" id="reference" value="<?= $book[0]['reference'] ?>" placeholder="Ex: E5">
            <span id="errorReference" class="invalid-feedback" style="display:none;">Veuillez entrer une étagère</span>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="location">Emplacement*</label>
            <input class="form-control" name="location" id="location" value="<?= $book[0]['location'] ?>" placeholder="Ex: 1">
            <span id="errorLocation" class="invalid-feedback" style="display:none;">Veuillez entrer un rayon</span>
          </div>
        </div>

        <div class="form-group mb-2">
          <label for="comment">Remarque</label>
          <input class="form-control" name="comment" id="comment" value="<?= $book[0]['comment'] ?>" placeholder="Remarque (facultatif)">
        </div>

        <div class="form-group mb-2">
          <label for="picture">Photo (laisser vide pour conserver l’image actuelle)</label>
          <div class="input-group">
            <div class="custom-file">
              <input name="picture" type="file" class="custom-file-input" id="imageInput" accept=".png, .jpg, .jpeg, .webp, .gif">
              <label class="custom-file-label" for="picture">Changer la photo</label>
              <input type="hidden" name="cropped_picture" id="croppedPicture">
            </div>
            <button type="button" class="btn btn-outline-danger d-none" id="resetPicture">Retirer</button>
          </div>
          <span id="errorPicture" class="invalid-feedback" style="display:none;"></span>
        </div>

        <div class="form-group mb-2" id="imageCropContainer" style="display:none;">
          <img id="imagePreview" src="./ressources/img/book/<?= $book[0]['photo'] ?>" style="max-width: 100%;">
        </div>

        <div class="form-group mb-2" id="cropControls" style="display:none;">
          <label for="rotationRange" class="small mb-1">Rotation : <span id="rotationValue">0°</span></label>
          <input type="range" id="rotationRange" class="w-100" min="0" max="360" step="1" value="0">
        </div>

        <div class="form-check mb-2">
          <input type="checkbox" class="form-check-input" id="removeBook" name="removeBook" <?= $book[0]['status'] === "Retiré" ? 'checked' : '' ?>>
          <label class="form-check-label" for="removeBook">Retirer le livre</label>
        </div>

        <div class="text-right">
          <button type="submit" class="btn btn-outline-primary mt-2">Enregistrer les modifications</button>
        </div>

      </form>
    </div>
  </div>
</div>
