<?php
$livres = [
    [
        'titre' => 'Le Petit Prince',
        'auteur' => 'Antoine de Saint-Exupéry',
        'edition' => 'Gallimard',
        'categorie' => 'Jeunesse',
        'reference' => 'B2',
        'emplacement' => '3',
        'statut' => 'En rayon'
    ],
    [
        'titre' => 'L\'étrange Noël de Monsieur Jack',
        'auteur' => 'Tim Burton',
        'edition' => 'Disney Press',
        'categorie' => 'Fantastique',
        'reference' => 'C1',
        'emplacement' => '2',
        'statut' => 'Emprunté'
    ],
    [
        'titre' => 'Contes d’Afrique',
        'auteur' => 'Alpha Diallo',
        'edition' => 'NEA',
        'categorie' => 'Culture africaine',
        'reference' => 'A5',
        'emplacement' => '1',
        'statut' => 'En retard'
    ],
    [
        'titre' => 'Les Fables de La Fontaine',
        'auteur' => 'Jean de La Fontaine',
        'edition' => 'Larousse',
        'categorie' => 'Classique',
        'reference' => 'D3',
        'emplacement' => '4',
        'statut' => 'En rayon'
    ],
    [
        'titre' => 'Maths Faciles CM1',
        'auteur' => 'Collectif',
        'edition' => 'Hachette Éducation',
        'categorie' => 'Scolaire',
        'reference' => 'E7',
        'emplacement' => '2',
        'statut' => 'Retiré'
    ],
    [
        'titre' => 'Le Lion',
        'auteur' => 'Joseph Kessel',
        'edition' => 'Gallimard Jeunesse',
        'categorie' => 'Roman',
        'reference' => 'B1',
        'emplacement' => '3',
        'statut' => 'En rayon'
    ],
    [
        'titre' => 'L’enfant noir',
        'auteur' => 'Camara Laye',
        'edition' => 'Éditions Présence Africaine',
        'categorie' => 'Roman africain',
        'reference' => 'F4',
        'emplacement' => '2',
        'statut' => 'Emprunté'
    ],
    [
        'titre' => 'Histoires pour s’endormir',
        'auteur' => 'Marie Aubinais',
        'edition' => 'Bayard Jeunesse',
        'categorie' => 'Petite enfance',
        'reference' => 'G1',
        'emplacement' => '1',
        'statut' => 'En rayon'
    ],
    [
        'titre' => 'Apprendre à lire',
        'auteur' => 'Julie Faure',
        'edition' => 'Belin Éducation',
        'categorie' => 'Scolaire',
        'reference' => 'H2',
        'emplacement' => '2',
        'statut' => 'En retard'
    ],
    [
        'titre' => 'Carnet de contes béninois',
        'auteur' => 'Assiba d’Almeida',
        'edition' => 'Éditions Ruisseaux d\'Afrique',
        'categorie' => 'Culture africaine',
        'reference' => 'I3',
        'emplacement' => '4',
        'statut' => 'En rayon'
    ]
];
?>
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 d-flex justify-content-between header-liste">
        <h3 class="m-0 font-weight-bold text-primary">Catalogue</h3>
        <div>
            <button onclick="location.href='?controller=wine&action=addWineForm'" class="btn btn-outline-primary mt-3">Ajouter une bouteille</button>       
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
                <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><?= $livre['titre'] ?></td>
                    <td><?= $livre['auteur'] ?></td>
                    <td><?= $livre['edition'] ?></td>
                    <td><?= $livre['categorie'] ?></td>
                    <td><?= $livre['reference'] ?></td>
                    <td><?= $livre['emplacement'] ?></td>
                    <td><?= $livre['statut'] ?></td>
                    <td class="d-flex justify-content-between">
                        <a href="voir.php?id=<?= $livre['reference'] ?>" title="">
                            <img class="action-icon" src="./ressources/style/img/borrow.png">
                        </a>
                        <a href="voir.php?id=<?= $livre['reference'] ?>" title="detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="modifier.php?id=<?= $livre['reference'] ?>" title="edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="supprimer.php?id=<?= $livre['reference'] ?>" title="delete" onclick="return confirm('Supprimer ce livre ?');">
                            <i class="fas fa-trash"></i>
                        </a>
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
            zeroRecords: "Aucun livre trouvé",
            lengthMenu: "Afficher _MENU_ entrées",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
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