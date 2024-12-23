
    <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Vérification de la session
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // Code pour supprimer un produit
    if (isset($_GET['delid'])) {
        // Validation de l'ID (vérification que c'est un entier)
        $rid = intval($_GET['delid']);
        
        if ($rid > 0) {  // Si l'ID est valide
            try {
                $sql = "DELETE FROM declaration_list WHERE id_declaration = :rid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':rid', $rid, PDO::PARAM_INT); // Utilisation de PDO::PARAM_INT pour s'assurer qu'il s'agit d'un entier
                $query->execute();
                
                if ($query->rowCount() > 0) {
                    echo "<script>alert('Donnée supprimée avec succès');</script>";
                } else {
                    echo "<script>alert('Aucune donnée trouvée à supprimer');</script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Erreur : " . htmlspecialchars($e->getMessage()) . "');</script>";
            }

            echo "<script>window.location.href = 'manage-decl.php'</script>";
        } else {
            echo "<script>alert('ID invalide.');</script>";
            echo "<script>window.location.href = 'manage-decl.php'</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Flottes | Liste des Déclarations</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="wrapper">
        <!-- navbar top -->
        <?php include_once('includes/header.php'); ?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- end navbar side -->

        <!-- page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Liste des Déclarations de Pannes</h1>
                </div>
                <!-- end page header -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#filterModal">
                                    Recherche avec deux dates
                                </button>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px;">N°</th>
                                            <th>Véhicule</th>
                                            <th>Date de la Déclaration</th>
                                            <th>Heure</th>
                                            <th style="width: 100px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Code pour afficher les déclarations
                                        $sql = "SELECT id_declaration, imt, dateD, heureD FROM declaration_list";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($row->imt); ?></td>
                                                    <td><?php echo (new DateTime($row->dateD))->format('d-m-Y'); ?></td>
                                                    <td><?php echo htmlentities($row->heureD); ?></td>
                                                    <td>
                                                        <a href="view-pannes.php?id_declaration=<?php echo htmlentities($row->id_declaration); ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $cnt++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="add-declaration.php" class="btn btn-primary">
                        <i class="fas fa-edit"></i></a>
                            <a href="detail-declaration.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Detail de chaque véhicule
</a>
                    </div>
                </div>
            </div>

            <!-- Modal for filtering -->
            <div id="filterModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Filtrer les Déclarations</h4>
                        </div>
                        <div class="modal-body">
                            <form id="filterForm">
                                <div class="form-group">
                                    <label for="vehicle">Véhicule</label>
                                    <select id="vehicle" name="vehicle" class="form-control">
                                        <option value="">Sélectionner un véhicule</option>
                                        <?php
                                        // Remplir les options de véhicule depuis la base de données
                                        $sql = "SELECT DISTINCT imt FROM declaration_list";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $vehicles = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($vehicles as $vehicle) {
                                            echo '<option value="' . htmlentities($vehicle->imt) . '">' . htmlentities($vehicle->imt) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="startDate">Date de début</label>
                                    <input type="date" id="startDate" name="startDate" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="endDate">Date de fin</label>
                                    <input type="date" id="endDate" name="endDate" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Rechercher</button>
                            </form>
                            <hr>
                            <!-- Section pour afficher les résultats -->
                            <div id="filterResults" class="mt-4">
                                <!-- Les résultats de la recherche seront affichés ici -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end page-wrapper -->

    </div>

    <!-- Scripts -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

    <script>
       $(document).ready(function () {
    $('#filterForm').on('submit', function (e) {
        e.preventDefault(); // Empêche le rechargement de la page

        const vehicle = $('#vehicle').val();
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();

        if (vehicle && startDate && endDate) {
            $.ajax({
                url: 'filter-declarations.php', // Fichier PHP qui traite la requête
                type: 'POST',
                data: { vehicle, startDate, endDate },
                success: function (response) {
                    $('#filterResults').html(response); // Affiche les résultats dans la div
                },
                error: function () {
                    $('#filterResults').html('<p class="text-danger">Une erreur s\'est produite lors de la recherche.</p>');
                }
            });
        } else {
            alert("Veuillez remplir tous les champs.");
        }
    });
});
    </script>

</body>

</html>

<?php }  ?>
</body>
</html>