<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Modifier un livre</h4>
        </div>
        <div class="card-body">
            <form id="formBook" method="post" action="?controller=book&action=updateBook&id=<?= $book[0]['id_book'] ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input class="form-control" name="title" id="title" value="<?= $book[0]['title']?>" placeholder="Titre du livre">
                    <span id="errorTitle" class="invalid-feedback" style="display: none;">Veuillez entrer un titre</span>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Auteur</label>
                    <input class="form-control" name="author" id="author" value="<?= $book[0]['author'] ?>" placeholder="Auteur du livre">
                    <span id="errorAuthor" class="invalid-feedback" style="display: none;">Veuillez entrer un auteur</span>
                </div>

                <div class="mb-3">
                    <label for="edition" class="form-label">Édition</label>
                    <input class="form-control" name="edition" id="edition" value="<?= $book[0]['author']  ?>" placeholder="Maison d'édition">
                    <span id="errorEdition" class="invalid-feedback" style="display: none;">Veuillez entrer une maison d'édition</span>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">-- Sélectionner une catégorie --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id_category'] ?>" <?= $book[0]['fk_category'] == $category['id_category'] ? 'selected' : '' ?>>
                                <?= $category['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="errorCategory" class="invalid-feedback" style="display: none;">Veuillez sélectionner une catégorie</span>
                </div>

                <div class="mb-3">
                    <label for="reference" class="form-label">Référence</label>
                    <input class="form-control" name="reference" id="reference" value="<?= $book[0]['reference'] ?>" placeholder="Ex: E5">
                    <span id="errorReference" class="invalid-feedback" style="display: none;">Veuillez entrer une étagère</span>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">Emplacement</label>
                    <input class="form-control" name="location" id="location" value="<?= $book[0]['location'] ?>" placeholder="Ex: 1">
                    <span id="errorLocation" class="invalid-feedback" style="display: none;">Veuillez entrer un rayon</span>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Remarque</label>
                    <input class="form-control" name="comment" id="comment" value="<?= $book[0]['comment'] ?>" placeholder="Remarque (facultatif)">
                </div>

                <div class="mb-3">
                    <label for="picture" class="form-label">Photo (Laisser vide pour conserver l’image actuelle)</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="picture" type="file" class="custom-file-input" id="picture" accept=".png, .jpg, .jpeg, .webp, .gif">
                            <label class="custom-file-label" for="picture">Changer la photo</label>
                        </div>
                        <button type="button" class="btn btn-outline-danger d-none" id="resetPicture">Retirer</button>
                    </div>
                    <span id="errorPicture" class="invalid-feedback" style="display: none;"></span>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="removeBook" name="removeBook">
                    <label class="form-check-label" for="removeBook">Retirer le livre</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
