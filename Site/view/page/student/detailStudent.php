<div class="container my-5">
<div class="card shadow mx-auto detail-card">
    <div class="row g-0">
        <div class="card-body d-flex">
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <img src="./ressources/img/student/<?= $student[0]['photo'] ?>" alt="Photo de l'élève" class="img-fluid rounded-start detail-image">
            </div>
            <div class="col-md-7 position-relative">
                <a href="" onclick="window.print()" class ="print-icon">
                    <img src="./ressources/style/img/print.png" alt="icone d'imprimante">
                </a>
                <h2 class="card-title mb-3"><?= $student[0]['firstname'] . " " . $student[0]['lastname'] ?></h2>
                <p><strong>Date de naissance :</strong> <?= (new DateTime($student[0]['birthdate']))->format('d/m/Y') ?></p>
                <p><strong>Institution :</strong> <?= $student[0]['institution'] ?></p>
                <p><strong>Date d'entrée :</strong> <?= (new DateTime($student[0]['entry_date']))->format('d/m/Y') ?></p>
                <p><strong>Date de validation :</strong> <?= (new DateTime($student[0]['validity_date']))->format('d/m/Y') ?></p>
                <p><strong>Téléphone :</strong> <?= $student[0]['phone'] ?></p>
                <p><strong>Adresse :</strong> <?= nl2br($student[0]['address']) ?></p>

                <?php if (!empty($student[0]['comment'])){ ?>
                    <p><strong>Remarques :</strong> <?= nl2br($student[0]['comment']) ?></p>
                <?php } ?>

                <a href="?controller=student&action=listStudent" class="btn btn-outline-primary mt-3">← Retour à la liste</a>
            </div>
        </div>        
    </div>
</div>