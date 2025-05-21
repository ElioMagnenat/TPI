<?php include './view/Modal.php'; ?>
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 d-flex justify-content-between header-liste">
        <div>
            <h3 class="m-0 font-weight-bold text-primary">Élèves</h3>
            <small class="text-muted fst-italic d-block mt-1">
                Astuce : maintenez <strong>Shift</strong> pour combiner plusieurs tris et affiner votre recherche.
            </small>
        </div>
        <div>
            <button onclick="location.href='?controller=student&action=addFormStudent'" class="btn btn-outline-primary mt-3">Ajouter un élève</button>       
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date d'entrée</th>
                    <th>Date de validité</th>
                    <th>Etablissement</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $student): ?>
                <tr>
                    <td><?= $student['id_student'] ?></td>
                    <td><?= $student['lastname'] ?></td>
                    <td><?= $student['firstname'] ?></td>
                    <td><?= $student['entry_date'] ? (new DateTime($student['entry_date']))->format('d/m/Y') : '' ?></td>
                    <td><?= $student['validity_date'] ? (new DateTime($student['validity_date']))->format('d/m/Y') : '' ?></td>
                    <td><?= $student['institution'] ?></td>
                    <?php if(new DateTime($student['validity_date']) < new DateTime()) {?>
                        <td>Désactivé</td>
                    <?php } else { ?>
                        <td>Actif</td>
                    <?php }?>
                    <td class="text-center">
                        <div class="d-flex justify-content-around gap-2">
                            <a href="?controller=student&action=detailStudent&id=<?= $student['id_student'] ?>" title="Détail">
                                <i class="fas fa-eye text-primary fa-lg"></i>
                            </a>
                            <a href="?controller=student&action=editFormStudent&id=<?= $student['id_student'] ?>" title="Modifier">
                                <i class="fas fa-edit text-primary fa-lg"></i>
                            </a>
                            <a href="?controller=student&action=removeStudent&id=<?= $student['id_student'] ?>" title="Supprimer" onclick="return confirm('Supprimer cet élève ?');">
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
                filename: 'Liste_Eleves_BiblioSolidaire',
                extend: 'pdfHtml5',
                text: 'Exporter en PDF',
                className: 'export-pdf-btn',
                exportOptions: {
                    columns: ':not(:last-child)'
                }
            }
        ],
        columnDefs: [
            { type: 'date-euro', targets: [3, 4] } // Adapter selon tes colonnes date
        ],
        paging: true,
        searching: true,
        info: true,
        lengthChange: false,
        ordering: true,
        autoWidth: false,
        scrollX: true,
        language: {
            search: "Rechercher :",
            zeroRecords: "Aucun élève trouvé",
            lengthMenu: "Afficher _MENU_ entrées",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ élèves",
            infoFiltered: "(filtré à partir de _MAX_ élèves)",
            infoEmpty: "Aucune entrée disponible",
            paginate: {
                first: "Premier",
                last: "Dernier",
                next: "Suivant",
                previous: "Précédent"
            },
            select: {
                rows: {
                    _: "%d lignes sélectionnées",
                    0: "Cliquez sur une ligne pour la sélectionner",
                    1: "1 ligne sélectionnée"
                }
            }
        }
    });

    // Filtres initiaux (statuts à afficher)
    var activeFilters = ["Actif"];

    // Boutons de filtre personnalisés (Statut élève, colonne 5)
    const btnsHtml = `
        <span class="d-flex align-items-center text-muted">
            <i class="fas fa-filter me-2"></i>Filtres :
        </span>
        <button type="button" class="btn filter-btn active btn-primary" data-filter="Actif">Actif</button>
        <button type="button" class="btn filter-btn btn-outline-secondary" data-filter="Désactivé">Désactivé</button>
    `;
    $('.dataTables_filter').append(btnsHtml);

    // Appliquer le filtre initial
    table.column(6).search(activeFilters.join('|'), true, false).draw();

    // Interaction avec les filtres
    $(document).on('click', '.filter-btn', function () {
        var filter = $(this).data('filter');
        var index = activeFilters.indexOf(filter);
        if (index === -1) {
            activeFilters.push(filter);
            $(this).addClass('active btn-primary').removeClass('btn-outline-secondary');
        } else {
            activeFilters.splice(index, 1);
            $(this).removeClass('active btn-primary').addClass('btn-outline-secondary');
        }

        if (activeFilters.length > 0) {
            table.column(6).search(activeFilters.join('|'), true, false).draw();
        } else {
            table.column(6).search('').draw();
        }
    });
});
</script>

