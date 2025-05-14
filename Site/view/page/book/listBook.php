<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 d-flex justify-content-between header-liste">
        <h3 class="m-0 font-weight-bold text-primary">Catalogue</h3>
        <div>
            <button onclick="location.href='?controller=book&action=addFormBook'" class="btn btn-outline-primary mt-3">Ajouter un livre</button>       
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Édition</th>
                    <th>Catégorie</th>
                    <th>Référence</th>
                    <th>Emplacement</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $book):?>
                <tr>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['edition'] ?></td>
                    <td><?= $book['category'] ?></td>
                    <td><?= $book['reference'] ?></td>
                    <td><?= $book['location'] ?></td>
                    <td><?= $book['status'] ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-around gap-2">
                        <?php if($book['status']=="En rayon"){ ?>
                            <a href="?controller=loan&action=loanFormBook&id=<?= $book['id_book'] ?>" title="Emprunt">
                                <img class="action-icon" src="./ressources/style/img/borrow.png">
                            </a>
                        <?php } if($book['status']=="Emprunté"||$book['status']=="En retard") { ?>
                            <a href="?controller=loan&action=restoreFormBook&id=<?= $book['id_book'] ?>" title="Rendu">
                                <img class="action-icon" src="./ressources/style/img/restore.png">
                            </a>
                        <?php } if($book['status']=="Retiré") { ?>
                            <a href="?controller=book&action=reinstate&id=<?= $book['id_book'] ?>" title="Ajouter" onclick="return confirm('Remettre ce livre dans les rayons ?');">
                                <img class="action-icon-add" src="./ressources/style/img/add.png">
                            </a>
                        <?php } ?>
                            <a href="?controller=book&action=detailBook&id=<?= $book['id_book'] ?>" title="Détail">
                                <i class="fas fa-eye text-primary fa-lg"></i>
                            </a>
                            <a href="?controller=book&action=editFormBook&id=<?=$book['id_book'] ?>" title="Modifier">
                                <i class="fas fa-edit text-primary fa-lg"></i>
                            </a>
                            <a href="?controller=book&action=removeBook&id=<?=$book['id_book'] ?>" title="Supprimer" onclick="return confirm('Supprimer ce livre ?');">
                                <i class="fas fa-trash text-primary fa-lg"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                text: 'Exporter en PDF',
                className: 'export-pdf-btn',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
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
            zeroRecords: "Aucun livre trouvé",
            lengthMenu: "Afficher _MENU_ entrées",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ livres",
            infoFiltered: "(filtré à partir de _MAX_ livres)",
            infoEmpty: "Aucune entrée disponible",
            paginate: {
                first: "Premier",
                last: "Dernier",
                next: "Suivant",
                previous: "Précédent"
            }
        }
    });

    var activeFilters = ["En rayon", "Emprunté", "En retard"];

    const btnsHtml = `
        <span class="d-flex align-items-center text-muted">
            <i class="fas fa-filter me-2"></i>Filtres :
        </span>
        <button type="button" class="btn filter-btn active btn-primary" data-filter="En rayon">En rayon</button>
        <button type="button" class="btn filter-btn active btn-primary" data-filter="Emprunté">Emprunté</button>
        <button type="button" class="btn filter-btn active btn-primary" data-filter="En retard">En retard</button>
        <button type="button" class="btn filter-btn btn-outline-secondary" data-filter="Retiré">Retiré</button>
    `;
    $('.dataTables_filter').append(btnsHtml);

    // Appliquer le filtre initial
    table.column(6).search(activeFilters.join('|'), true, false).draw();

    // Gestion des clics
    $(document).on('click', '.filter-btn', function () {
        var filter = $(this).data('filter');
        var index = activeFilters.indexOf(filter);

        // Toggle
        if (index === -1) {
            activeFilters.push(filter);
            $(this).addClass('active btn-primary').removeClass('btn-outline-secondary');
        } else {
            activeFilters.splice(index, 1);
            $(this).removeClass('active btn-primary').addClass('btn-outline-secondary');
        }

        // Appliquer le filtre combiné
        if (activeFilters.length > 0) {
            table.column(6).search(activeFilters.join('|'), true, false).draw();
        } else {
            table.column(6).search('').draw();
        }
    });
});
</script>