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
                    <p><strong>Statut :</strong> <?= $book[0]['status']?></p>
                    <?php if (!empty($book[0]['comment'])){ ?>
                        <p><strong>Remarque :</strong> <?= nl2br($book[0]['comment']) ?></p>
                    <?php }?>

                    <a href="?controller=book&action=listBook" class="btn btn-outline-primary mt-3">← Retour au catalogue</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4 mt-4">
        <div class="card-header py-3 d-flex justify-content-between header-liste">
            <h3 class="m-0 font-weight-bold text-primary">Emprunts</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="loanTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Élève</th>
                            <th>Date d'emprunt</th>
                            <th>Rendu prévu</th>
                            <th>Date de rendu</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($loans as $loan): ?>
                            <tr>
                                <td>
                                    <a href="?controller=student&action=detailStudent&id=<?= urlencode($loan['id_student']) ?>">
                                        <?= htmlspecialchars($loan['firstname'] . ' ' . $loan['lastname']) ?>
                                    </a>
                                </td>
                                <td><?= (new DateTime($loan['start_date']))->format('d/m/Y') ?></td>
                                <td><?= (new DateTime($loan['expected_return_date']))->format('d/m/Y') ?></td>
                                <td><?= $loan['return_date'] ? (new DateTime($loan['return_date']))->format('d/m/Y') : '-' ?></td>
                                <td><?= htmlspecialchars($loan['comment']) ?: '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#loanTable').DataTable({
        paging: true,
        searching: true,
        info: true,
        lengthChange: false,
        ordering: true,
        autoWidth: false,
        scrollX: true,
        language: {
            search: "Rechercher :",
            zeroRecords: "Aucun emprunt trouvé",
            lengthMenu: "Afficher _MENU_ entrées",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ emprunts",
            infoFiltered: "(filtré à partir de _MAX_ entrées)",
            infoEmpty: "Aucune entrée disponible",
            paginate: {
                first: "Premier",
                last: "Dernier",
                next: "Suivant",
                previous: "Précédent"
            }
        }
    });
});
</script>
