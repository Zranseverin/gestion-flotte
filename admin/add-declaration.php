<?php
session_start();
include('includes/dbconnection.php');

// Vérifier si la session est active
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_POST['submit'])) {
    try {
        // Validation des entrées obligatoires
        if (empty($_POST['dateD']) || empty($_POST['heureD']) || empty($_POST['imt']) || empty($_POST['Description'])) {
            throw new Exception("Tous les champs obligatoires doivent être remplis.");
        }

        // Récupérer les valeurs
        $imt = htmlspecialchars(trim($_POST['imt']));
        $dateD = htmlspecialchars(trim($_POST['dateD']));
        $heureD = htmlspecialchars(trim($_POST['heureD']));
        $description = htmlspecialchars(trim($_POST['Description']));
        
        // Filtrer les libellés valides
        $libelles = array_filter($_POST['lib'] ?? [], function ($lib) {
            return !empty(trim($lib));
        });

        // Vérifier les dates
        $dateR = $_POST['dateR'] ?? [];

        if (empty($libelles)) {
            throw new Exception("Liste des libellés vide ou non valide.");
        }
        if (empty($dateR)) {
            throw new Exception("Liste des dates vide ou non valide.");
        }

        // Démarrer une transaction
        $dbh->beginTransaction();

        // Insertion de la déclaration
        $sql_decla = "INSERT INTO declaration_list (imt, dateD, heureD) VALUES (:imt, :dateD, :heureD)";
        $stmt = $dbh->prepare($sql_decla);
        $stmt->execute([
            ':imt' => $imt,
            ':dateD' => $dateD,
            ':heureD' => $heureD
        ]);

        // Récupérer l'ID de la dernière déclaration insérée
        $id = $dbh->lastInsertId();

        // Insertion des détails
        $sql_detail = "INSERT INTO libelle_list (lib, dateR, description, id_declaration, imt) VALUES (:lib, :dateR, :description, :id_declaration, :imt)";
        $query_detail = $dbh->prepare($sql_detail);

        // Assurez-vous que chaque dateR est traitée individuellement
        foreach ($libelles as $index => $lib) {
            if (isset($dateR[$index]) && !empty($dateR[$index])) {
                $query_detail->execute([
                    ':id_declaration' => $id,
                    ':lib' => htmlspecialchars(trim($lib)),
                    ':dateR' => htmlspecialchars(trim($dateR[$index])),  // Applique trim sur chaque dateR individuellement
                    ':description' => $description,
                    ':imt' => $imt
                ]);
            }
        }

        // Valider la transaction
        $dbh->commit();
        echo "<script>alert('Panne declarée  avec succès.');</script>";
        echo "<script>window.location.href ='view-pannes.php?id_declaration=" . $id_declaration . "';</script>";
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        error_log("Erreur : " . $e->getMessage());
        echo "<script>alert('Une erreur est survenue : " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   
    <title>Gestion des flottes Soumafe | Enregistrement des pannes declarées</title>

<!-- Core CSS - Include with every page -->

<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href="assets/css/main-style.css" rel="stylesheet" />
<link rel="stylesheet" href="forme.css">
<link rel="stylesheet" href="style.css">
   
</head>

<body>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
               
</head>
<body>
<div id="wrapper">
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Déclaration de la panne</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container">

                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Sélection véhicule -->
                        <div class="col-md-6">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#vhModal">Sélectionnez le véhicule</button>
                            <div class="form-group">
                                <label for="imt">Immatriculation :</label>
                                <input type="text" id="imt" name="imt" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="dateD">Date de la déclaration :</label>
                                <input type="date" id="dateD" name="dateD" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="heureD">Heure de la déclaration :</label>
                                <input type="time" id="heureD" name="heureD" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Description">Observation :</label>
                                <input type="text" id="Description" name="Description" class="form-control" required>
                            </div>
                        </div>

                        <!-- Pannes -->
                        <div class="col-md-6">
                            <h4>Pannes déclarées</h4>
                            <div id="depensesContainer">
                                <div class="depenses d-flex mb-2">
                                    <input type="text" name="lib[]" class="form-control me-2" placeholder="Libellé de la panne" required>
                                    <input type="date"  name="dateR[]" class="form-control" placeholder="date de la reparation" required>
                                    <button type="button" id="addFacture" class="btn btn-success">+</button>
                                </div>
                            </div>
                          
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary" name="submit" onclick="return confirm('Êtes-vous sûr de vouloir enregistrer ?');">Enregistrer</button>
                        <a href="manage-decl.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> 
</a>
                    </div>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="vhModal" tabindex="-1" aria-labelledby="vhModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vhModalLabel">Liste des Véhicules</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM attr_list";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($row->imt); ?></td>
                                                    <td>
                                                        <button class="btn btn-success select-client" data-imt="<?php echo htmlentities($row->imt); ?>">Sélectionner</button>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modal -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sélection véhicule
            document.querySelectorAll('.select-client').forEach(button => {
                button.addEventListener('click', () => {
                    const imt = button.dataset.imt;
                    document.getElementById('imt').value = imt;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('vhModal'));
                    modal.hide();
                });
            });

            // Ajouter libellé panne
            document.getElementById('depensesContainer').addEventListener('click', event => {
                if (event.target.id === 'addFacture') {
                    const newPanne = document.createElement('div');
                    newPanne.className = 'depenses d-flex mb-2';
                    newPanne.innerHTML = `
                        <input type="text" name="lib[]" class="form-control me-2" placeholder="Libellé de la panne" required>
                        <button type="button" class="btn btn-danger remove-btn">-</button>;
                        <input type="date" name="dateR[]" class="form-control me-2" placeholder="date de la reparation" required>
                        <button type="button" class="btn btn-danger remove-btn">-</button>`;
                        
                    event.currentTarget.appendChild(newPanne);
                }

                if (event.target.classList.contains('remove-btn')) {
                    event.target.closest('.depenses').remove();
                }
            });
        });
    </script>
    <!-- Scripts -->
<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/plugins/pace/pace.js"></script>
<script src="assets/scripts/siminta.js"></script>

</body>

</html>
