<div class="d-flex justify-content-center align-items-center">
    <form id="addForm" class="w-50 mt-3" method="post" action="?controller=wine&action=verifCreateWine" enctype="multipart/form-data">
        <h2 class="text-primary font-weight-bold">Nouvelle bouteille</h2>
        <div class="mb-3">
            <label for="wineName" class="form-label">Nom</label>
            <input class="form-control" name="wineName" id="wineName">
            <span id="errorwineName" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineType" class="form-label">Type</label>
            <select class="form-control" id="wineType" name="wineType">
                <option value="">-- Sélectionner un type --</option>
                <?php
                if (isset($_SESSION["vins"]["types"])) {
                    foreach ($_SESSION["vins"]["types"] as $type) {
                        echo '<option value="' . $type['type_id'] . '">' . htmlspecialchars($type['nom']) . '</option>';
                    }
                }
                ?>
            </select>
            <span id="errorwineType" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineCepage" class="form-label">Cépage</label>
            <input class="form-control" id="wineCepage" name="wineCepage">
            <span id="errorwineCepage" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineMillesime" class="form-label">Millésime</label>
            <input class="form-control" id="wineMillesime" name="wineMillesime" type="number" placeholder="2025">
            <span id="errorwineMillesime" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineBuyDate" class="form-label">Date d'achat</label>
            <input type="date" class="form-control" id="wineBuyDate" name="wineBuyDate">
            <span id="errorwineBuyDate" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="winePrice" class="form-label">Prix</label>
            <input class="form-control" id="winePrice" name="winePrice" step="0.01" min="0.00" max="999999.99" placeholder="0.00">
            <span id="errorwinePrice" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineQuantity" class="form-label">Quantité</label>
            <input class="form-control" id="wineQuantity" name="wineQuantity" type="number" min="0">
            <span id="errorwineQuantity" class="alert-danger"></span>
        </div>

        <div class="mb-3">
        <label for="imageInput" class="form-label">Photo</label>
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

        <button type="submit" class="btn btn-outline-primary mt-3">Ajouter</button>
    </form>
</div>
