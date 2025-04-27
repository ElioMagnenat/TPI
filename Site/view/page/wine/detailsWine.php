<?php 
$vin = $_SESSION["vins"]["details"];
?>

<div class="container my-5">
    <div class="card shadow mx-auto detail-card">
        <div class="row g-0">
            <!-- Image -->
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <img src="<?= $vin['image'] ?>" alt="Image de la bouteille" class="img-fluid rounded-start detail-image">
            </div>

            <!-- Infos -->
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title mb-3"><?= $vin['nom'] ?></h2>

                    <p><strong>Cépage :</strong> <?= $vin['cepage'] ?></p>
                    <p><strong>Type :</strong> <?= $vin['fk_type'] ?></p>
                    <p><strong>Millésime :</strong> <?= (new DateTime($vin['date_millesime']))->format('Y') ?></p>
                    <p><strong>Date d'achat :</strong> <?= (new DateTime($vin['date_achat']))->format('d/m/Y') ?></p>
                    <p><strong>Prix :</strong> <?= $vin['prix'] ?>.-</p>
                    <p><strong>Quantité :</strong> <?= $vin['quantite'] ?> bouteilles</p>

                    <a href="?controller=wine&action=listeWine" class="btn btn-outline-primary mt-3">← Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
