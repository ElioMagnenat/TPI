<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 d-flex justify-content-between header-liste">
        <h3 class="m-0 font-weight-bold text-primary">Élèves</h3>
        <div>
            <button onclick="location.href='?controller=student&action=addFormStudent'" class="btn btn-outline-primary mt-3">Ajouter un élève</button>       
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date d'entrée</th>
                    <th>Date de validité</th>
                    <th>Etablissement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $student): ?>
                <tr>
                    <td><?= $student['lastname'] ?></td>
                    <td><?= $student['firstname'] ?></td>
                    <td><?= $student['entry_date'] ? (new DateTime($student['entry_date']))->format('d/m/Y') : '' ?></td>
                    <td><?= $student['validity_date'] ? (new DateTime($student['validity_date']))->format('d/m/Y') : '' ?></td>
                    <td><?= $student['institution'] ?></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-around gap-2">
                            <a href="voir.php?id=<?= $student['id_student'] ?>" title="Détail">
                                <i class="fas fa-eye text-primary fa-lg"></i>
                            </a>
                            <a href="?controller=book&action=editFormBook&id=<?= $student['id_student'] ?>" title="Modifier">
                                <i class="fas fa-edit text-primary fa-lg"></i>
                            </a>
                            <a href="supprimer.php?id=<?= $student['id_student'] ?>" title="Supprimer" onclick="return confirm('Supprimer ce livre ?');">
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
    // Initialiser DataTables
    $(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'pdfHtml5',
            text: 'Exporter en PDF',
            className: 'export-pdf-btn',
            exportOptions: {
                columns: ':not(:last-child)'
            },
            paging: true,  // Enable pagination
            lengthMenu: [5, 10, 25, 50, 100],  // Options for the number of rows per page
            pageLength: 10,  // Default number of rows per page
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
            zeroRecords: "Aucun élève trouvé",
            lengthMenu: "Afficher _MENU_ entrées",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ élèves",
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