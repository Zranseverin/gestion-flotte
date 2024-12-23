<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Vérifier si l'utilisateur est connecté
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
    exit;
}

// Vérifier si l'ID est passé dans l'URL et s'il est valide
if (isset($_GET['id_declaration']) && is_numeric($_GET['id_declaration'])) {
    $id_declaration = intval($_GET['id_declaration']);
    
    // Requête pour récupérer les détails de la déclaration de panne
    $sql = "SELECT * FROM declaration_list WHERE id_declaration = :id_declaration";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id_declaration', $id_declaration, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    // Vérifier si la déclaration a été trouvée
    if (!$result) {
        echo "<script>alert('Déclaration de la panne non trouvée.');</script>";
        echo "<script>window.location.href = 'manage-decl.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID invalide ou manquant.');</script>";
    echo "<script>window.location.href = 'manage-decl.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des flottes | Détails de la déclaration</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

<body>
    <!--  wrapper -->
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
                    <h1 class="page-header">Détails de la déclaration de panne</h1>
                </div>
                <!-- end page header -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Identifiant</th>
                                            <th>Immatriculation</th>
                                            <th>Date</th>
                                            
                                            <th>Heure</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo htmlentities($result->id_declaration); ?></td>
                                            <td><?php echo htmlentities($result->imt); ?></td>
                                            <td><?php echo (new DateTime($row->dateD))->format('d-m-Y'); ?></td>
                                            <td><?php echo htmlentities($result->heureD); ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h3>Détails de la panne</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Libellé Panne</th>
                                            <th>Observation</th>
                                            <th>Date de Réparation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Récupérer les détails des pannes associées à cette déclaration
                                        $sql2 = "SELECT * FROM libelle_list WHERE id_declaration = :id_declaration";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->bindParam(':id_declaration', $id_declaration, PDO::PARAM_INT);
                                        $query2->execute();
                                        $details = $query2->fetchAll(PDO::FETCH_OBJ);

                                        if ($query2->rowCount() > 0) {
                                            foreach ($details as $detail) {
                                        ?>
                                                <tr>
                                                    <td><?php echo htmlentities($detail->lib); ?></td>
                                                    <td><?php echo htmlentities($detail->description); ?></td>
                                                    <td><?php echo htmlentities($detail->dateR); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>Aucun détail trouvé pour cette déclaration de panne.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                               
                            </div>

                            <a href="add-decl.php" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Enregistrer
                            </a>
                        </div>
                    </div>
                    <!-- End Advanced Tables -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
</body>

</html>
