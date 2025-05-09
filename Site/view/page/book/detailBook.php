<div class="container my-5">
    <div class="card shadow mx-auto detail-card">
        <div class="row g-0">
            <div class="card-body d-flex">
                <div class="col-md-5 d-flex align-items-center justify-content-center">
                <?php if (!empty($book[0]['photo'])){ ?>
                    <img src="./ressources/img/book/<?= $book[0]['photo'] ?>" alt="Photo du livre" class="img-fluid rounded-start detail-image">
                <?php }else{?>
                    <img  src="./ressources/style/img/defaultBook.png" alt="icone d'imprimante" class="img-fluid rounded-start detail-image">
                <?php }?>
                </div>
                <div class="col-md-7 position-relative">
                    <h2 class="card-title mb-3"><?= $book[0]['title'] ?></h2>
                    <p><strong>Auteur :</strong> <?= $book[0]['author'] ?></p>
                    <p><strong>Édition :</strong> <?= $book[0]['edition']?></p>
                    <p><strong>Catégorie :</strong> <?= $book[0]['category'] ?></p>
                    <p><strong>Référence :</strong> <?= $book[0]['reference'] ?></p>
                    <p><strong>Emplacement :</strong> <?= $book[0]['location']?></p>

                    <?php if (!empty($book[0]['comment'])){ ?>
                        <p><strong>Remarque :</strong> <?= nl2br($book[0]['comment']) ?></p>
                    <?php }?>

                    <a href="?controller=book&action=listBook" class="btn btn-outline-primary mt-3">← Retour au catalogue</a>
                </div>
            </div>
        </div>
    </div>
</div>
