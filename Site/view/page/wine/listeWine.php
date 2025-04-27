<!-- DataTales Example -->
<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 d-flex justify-content-between header-liste">
        <h3 class="m-0 font-weight-bold text-primary">Liste des vins</h3>
        <div>
            <div class="btn-group mt-3">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Exporter">
                    <i class="fas fa fa-download"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" id="exportCSVBtn">
                        Tout exporter en CSV
                    </a>
                    <a class="dropdown-item" href="#" id="exportPDFBtn">
                        Tout exporter en PDF
                    </a>
                </div>
            </div>
            <?php if(isset($_SESSION["user"]["roles"]["canAdd"])&& $_SESSION["user"]["roles"]["canAdd"]){?>
            <button onclick="location.href='?controller=wine&action=addWineForm'" class="btn btn-outline-primary mt-3">Ajouter une bouteille</button>
            <?php }?>       
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Cépage</th>
                        <th>Âge</th>
                        <th>Millésime</th>
                        <th>Date d'achat</th>
                        <th>Prix</th>
                        <th>Quantitié</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_SESSION["vins"]["liste"])) {
                foreach ($_SESSION["vins"]["liste"] as $vin) {
                ?>
                    <tr>
                        <td><?php echo $vin["nom"] ?></td>
                        <td><?php echo $vin["fk_type"] ?></td>
                        <td><?php echo $vin["cepage"] ?></td>
                        <td><?php echo date("Y") - date("Y", strtotime($vin["date_millesime"]))?></td>
                        <td><?php echo date('Y', strtotime($vin["date_millesime"])); ?></td>
                        <td><?php echo date("d/m/Y", strtotime($vin["date_achat"])); ?></td>
                        <td><?php echo number_format($vin["prix"],2,'.','')?></td>
                        <td><?php echo $vin["quantite"] ?></td>
                        <td class="d-flex justify-content-around">
                        <a href="?controller=wine&action=detailsWine&wineId=<?= $vin['vin_id'] ?>" title="Détails">
                            <i class="fas fa-eye"></i>
                        </a>
                        <?php if(isset($_SESSION["user"]["roles"]["canEdit"])&& $_SESSION["user"]["roles"]["canEdit"]){?>
                        <a href="?controller=wine&action=editWineForm&wineId=<?= $vin['vin_id'] ?>" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <?php }?>
                        <?php if(isset($_SESSION["user"]["roles"]["canRemove"])&& $_SESSION["user"]["roles"]["canRemove"]){?>
                        <a href="?controller=wine&action=removeWine&wineId=<?= $vin['vin_id'] ?>&image=<?= $vin['image'] ?>" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce vin ?')">
                            <i class="fas fa-trash"></i>
                        </a>
                        <?php }?>
                        </td>
                    </tr>
            <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // Initialiser DataTables
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "ordering": true,
            "autoWidth": false,
            "scrollX": true,
            "language": {
                "search": "Rechercher :",
                "zeroRecords": "Aucun vin trouvé",
                "lengthMenu": "Afficher _MENU_ entrées",
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "infoFiltered": "(filtré à partir de _MAX_ entrées)",
                "infoEmpty": "Aucune entrée disponible",
 
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },

        })
    })
</script>