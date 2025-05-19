<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Ajouter un livre</h4>
        </div>
        <div class="card-body">
            <form id="formBook" method="post" action="?controller=book&action=addBook" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input class="form-control" name="title" id="title" placeholder="Titre du livre">
                    <span id="errorTitle" class="invalid-feedback" style="display: none;"> Veuillez entrer un titre </span>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Auteur</label>
                    <input class="form-control" name="author" id="author" placeholder="Auteur du livre">
                    <span id="errorAuthor" class="invalid-feedback" style="display: none;">Veuillez entrer un auteur</span>
                </div>

                <div class="mb-3">
                    <label for="edition" class="form-label">Édition</label>
                    <input class="form-control" name="edition" id="edition" placeholder="Maison d'édition">
                    <span id="errorEdition" class="invalid-feedback" style="display: none;">Veuillez entrer une maison d'édition</span>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php 
                        foreach ($categories as $category){
                            echo '<option value="' . $category['id_category'] . '">' . $category['name'] . '</option>';
                        }
                        ?>
                    </select>
                    <span id="errorCategory" class="invalid-feedback" style="display: none;">Veuillez sélectionner une catégorie</span>
                </div>

                <div class="mb-3">
                    <label for="reference" class="form-label">Référence</label>
                    <input class="form-control" name="reference" id="reference" placeholder="Ex: E5">
                    <span id="errorReference" class="invalid-feedback" style="display: none;">Veuiller entrer une étagère</span>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Emplacement</label>
                    <input class="form-control" name="location" id="location" placeholder="Ex: 1">
                    <span id="errorLocation" class="invalid-feedback" style="display: none;">Veuillez entrer un rayon </span>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Remarque</label>
                    <input class="form-control" name="comment" id="comment" placeholder="Remarque (facultatif)">
                </div>

                <div class="mb-3">
                    <label for="imageInput" class="form-label">Photo</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="picture" type="file" class="custom-file-input" id="imageInput" accept=".png, .jpg, .jpeg, .webp, .gif">
                            <label class="custom-file-label" for="imageInput">Choisir une photo</label>
                        </div>
                        <button type="button" class="btn btn-outline-danger d-none" id="resetPicture">Retirer</button>
                    </div>
                    <span id="errorPicture" class="invalid-feedback d-block"></span>
                    <span id="errorUserPicture" class="alert-danger d-block"></span>
                </div>
                    <input type="hidden" name="cropped_picture" id="croppedPicture">
                <!-- Zone de crop -->
                <div class="mb-3">
                    <div id="imageCropContainer" class="mb-3" style="display:none;">
                        <img id="imagePreview" style="max-width: 100%;">
                    </div>

                    <div id="cropControls" class="mb-3" style="display: none; flex-direction: column;">
                        <label for="rotationRange">Rotation : <span id="rotationValue">0°</span></label>
                        <input type="range" id="rotationRange" min="0" max="360" step="1" value="0">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Ajouter</button>
                </div>

            </form>
        </div>
    </div>
</div>