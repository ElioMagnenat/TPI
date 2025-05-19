<div class="container my-5">
<div class="card shadow mx-auto detail-card">
    <div class="row g-0">
        <div class="card-body d-flex">
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <?php if(isset($student[0]['photo'])&& $student[0]['photo'] != NULL) { ?>
                    <img src="./ressources/img/student/<?= $student[0]['photo'] ?>" alt="Photo de l'élève" class="img-fluid rounded-start detail-image">
                <?php } else {?>
                    <img src="./ressources/style/img/defaultStudent.png" alt="Photo de l'élève" class="img-fluid rounded-start detail-image">
                <?php }?>
            </div>
            <div class="col-md-7 position-relative">
                <a href="" onclick="window.print()" class ="print-icon">
                    <img src="./ressources/style/img/print.png" alt="icone d'imprimante">
                </a>
                <h2 class="card-title mb-3"><?= $student[0]['firstname'] . " " . $student[0]['lastname'] ?></h2>
                <p><strong>Identifiant :</strong> <?= $student[0]['id_student'] ?></p>
                <p><strong>Date de naissance :</strong> <?= (new DateTime($student[0]['birthdate']))->format('d/m/Y') ?></p>
                <p><strong>Institution :</strong> <?= $student[0]['institution'] ?></p>
                <p><strong>Date d'entrée :</strong> <?= (new DateTime($student[0]['entry_date']))->format('d/m/Y') ?></p>
                <p><strong>Date de validité :</strong> <?= (new DateTime($student[0]['validity_date']))->format('d/m/Y') ?></p>
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
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 d-flex justify-content-between header-liste">
        <h3 class="m-0 font-weight-bold text-primary">Livres empruntés</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="studentLoanTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Titre</th>
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
                                <a href="?controller=book&action=detailBook&id=<?= urlencode($loan['fk_book']) ?>">
                                    <?= htmlspecialchars($loan['title']) ?>
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
<script>
    $(document).ready(function() {
        $('#studentLoanTable').DataTable({
            columnDefs: [
                { type: 'date-euro', targets: [1, 2, 3] }
            ],
            paging: true,
            searching: true,
            info: true,
            lengthChange: true,
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
