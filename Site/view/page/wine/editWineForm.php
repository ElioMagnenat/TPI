<?php $vin = $_SESSION['vins']['details']; ?>
<div class="d-flex justify-content-center align-items-center">
    <form id="editForm" class="w-50 mt-3" method="post" action="?controller=wine&action=verifEditWine&wineId=<?= $_SESSION["vins"]["id"] ?>" enctype="multipart/form-data">
        <h2 class="text-primary font-weight-bold">Modifier la bouteille</h2>

        <input type="hidden" name="wineId" value="<?= $vin['vin_id'] ?>">

        <div class="mb-3">
            <label for="wineName" class="form-label">Nom</label>
            <input class="form-control" name="wineName" id="wineName" value="<?= htmlspecialchars($vin['nom']) ?>">
            <span id="errorwineName" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineType" class="form-label">Type</label>
            <select class="form-control" id="wineType" name="wineType">
                <option value="">-- Sélectionner un type --</option>
                <?php
                if (isset($_SESSION["vins"]["types"])) {
                    foreach ($_SESSION["vins"]["types"] as $type) {
                        $selected = ($vin['fk_type'] == $type['nom']) ? 'selected' : '';
                        echo '<option value="' . $type['type_id'] . '" ' . $selected . '>' . htmlspecialchars($type['nom']) . '</option>';
                    }
                }
                ?>
            </select>
            <span id="errorwineType" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineCepage" class="form-label">Cépage</label>
            <input class="form-control" id="wineCepage" name="wineCepage" value="<?= htmlspecialchars($vin['cepage']) ?>">
            <span id="errorwineCepage" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineMillesime" class="form-label">Millésime</label>
            <input class="form-control" id="wineMillesime" name="wineMillesime" type="number" value="<?= date('Y', strtotime($vin['date_millesime'])) ?>">
            <span id="errorwineMillesime" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineBuyDate" class="form-label">Date d'achat</label>
            <input type="date" class="form-control" id="wineBuyDate" name="wineBuyDate" value="<?= $vin['date_achat'] ?>">
            <span id="errorwineBuyDate" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="winePrice" class="form-label">Prix</label>
            <input class="form-control" id="winePrice" name="winePrice" step="0.01" min="0.00" max="999999.99" value="<?= htmlspecialchars($vin['prix']) ?>">
            <span id="errorwinePrice" class="alert-danger"></span>
        </div>

        <div class="mb-3">
            <label for="wineQuantity" class="form-label">Quantité</label>
            <input class="form-control" id="wineQuantity" name="wineQuantity" type="number" min="0" value="<?= htmlspecialchars($vin['quantite']) ?>">
            <span id="errorwineQuantity" class="alert-danger"></span>
        </div>

        <div class="mb-3">
        <label for="imageInput" class="form-label">Photo</label>
        <div class="custom-file">
            <input name="picture" type="file" class="custom-file-input" id="imageInput" accept=".png, .jpg, .jpeg, .webp, .gif">
            <label class="custom-file-label" for="imageInput">Modifier la photo</label>
            <span id="errorUserPicture" class="alert-danger"></span>
        </div>
        </div>

        <div class="mb-3">
        <!-- Zone de crop -->
        <div id="imageCropContainer" class="mb-3" style="display:none;">
            <img id="imagePreview" 
            <?php
            if(isset($vin["image"]) && $vin["image"]!=NULL){
                echo 'src="'.$vin["image"].'"';
            }
            ?>
            >
        </div>

        <div id="cropControls" class="mb-3" style="display: none; flex-direction: column;">
            <label for="rotationRange">Rotation : <span id="rotationValue">0°</span></label>
            <input type="range" id="rotationRange" min="0" max="360" step="1" value="0">
        </div>
    </div>

        <button type="submit" class="btn btn-outline-primary mt-3">Enregistrer les modifications</button>
    </form>
</div>
