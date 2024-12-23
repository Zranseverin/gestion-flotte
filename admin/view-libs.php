<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Vérification de la session
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit;
}

if (isset($_GET['imt'])) {
    $imt = $_GET['imt']; // Récupérer l'immatriculation du véhicule

    // Requête pour obtenir tous les libellés associés à l'immatriculation
    $sql = "SELECT 
    l.id_libelle, 
    l.lib, 
    l.dateR, 
    l.Description, 
    d.dateD, 
    d.heureD
FROM 
    libelle_list l
JOIN 
    declaration_list d ON l.id_declaration = d.id_declaration
WHERE 
    d.imt = :imt;
";

    try {
        $query = $dbh->prepare($sql);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->execute();
        $libs = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $libCount = 1;
        } else {
            echo "<script>alert('Aucun libellé trouvé pour cette immatriculation');</script>";
            echo "<script>window.location.href = 'manage-decl.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erreur de base de données : " . $e->getMessage() . "');</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes | Libellés du véhicule</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- wrapper -->
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
                <div class="col-lg-12">
                    <h1 class="page-header">Libellés pour l'immatriculation : <?php echo htmlentities($imt); ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Libellé</th>
                                            <th>Date de Réparation</th>
                                            <th>Description</th>
                                            <th>Date de Déclaration</th>
                                            <th>Heure de Déclaration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($libs) && count($libs) > 0) {
                                            foreach ($libs as $lib) {
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($lib->lib); ?></td>
                                                <td><?php echo (new DateTime($row->dateR))->format('d-m-Y'); ?></td>
                                                <td><?php echo htmlentities($lib->Description); ?></td>
                                                <td><?php echo (new DateTime($row->dateD))->format('d-m-Y'); ?></td>
                                                <td><?php echo htmlentities($lib->heureD); ?></td>
                                            </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>Aucun libellé trouvé pour cette immatriculation.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <a href="manage-decl.php" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->
    </div>
    <!-- end wrapper -->

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
</body>

</html>
