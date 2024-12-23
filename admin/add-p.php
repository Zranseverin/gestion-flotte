<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    function logUserAction($dbh, $ID, $action, $description) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO tbluseractions (ID, action, description, ip_address) 
                VALUES (:ID, :action, :description, :ip_address)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
        $stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':ip_address', $ipAddress, PDO::PARAM_STR);
        $stmt->execute();
    }
    if (isset($_POST['submit'])) {
        // Fetch and sanitize form data
        $ID = filter_input(INPUT_POST, 'ID', FILTER_VALIDATE_INT);
        $numero_facture = strtoupper(filter_input(INPUT_POST, 'numero_facture', FILTER_SANITIZE_STRING));

        // Pannes data (arrays)
        $libelle_panne = $_POST['libelle_panne'];
        $decla = $_POST['decla'];
        $obser = $_POST['obser'];
        $sortie = $_POST['sortie'];
        $dateal = $_POST['dateal'];
        $gar = $_POST['gar'];
        $resp = $_POST['resp'];
        $temps = $_POST['temps'];

        // Factures data (arrays)
        $libelle_facture = $_POST['libelle_facture'];
        $quantite_facture = $_POST['quantite_facture'];
        $montant_facture = $_POST['montant_facture'];

        // Total amount of all factures
        $somme_total = filter_input(INPUT_POST, 'somme_total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        try {
            // Start transaction
            $dbh->beginTransaction();

            // Insert into the "pannes" table
            foreach ($libelle_panne as $i => $libelle) {
                $sql = "INSERT INTO pannes (ID, libelle_panne, decla, obser, gar, resp, dateal, sortie, temps) 
                        VALUES (:ID, :libelle_panne, :decla, :obser, :gar, :resp, :dateal, :sortie, :temps)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
                $stmt->bindParam(':libelle_panne', $libelle, PDO::PARAM_STR);
                $stmt->bindParam(':decla', $decla, PDO::PARAM_STR);
                $stmt->bindParam(':obser', $obser, PDO::PARAM_STR);
                $stmt->bindParam(':gar', $gar, PDO::PARAM_STR);
                $stmt->bindParam(':resp', $resp, PDO::PARAM_STR);
                $stmt->bindParam(':dateal', $dateal, PDO::PARAM_STR);
                $stmt->bindParam(':sortie', $sortie, PDO::PARAM_STR);
                $stmt->bindParam(':temps', $temps, PDO::PARAM_STR);
                $stmt->execute();
            }

            // Insert into the "factures" table
            foreach ($libelle_facture as $i => $libelle) {
                $montant_total = $quantite_facture[$i] * $montant_facture[$i];

                $sql = "INSERT INTO factures (ID, libelle_facture, quantite_facture, montant_facture, numero_facture, montant_total) 
                        VALUES (:ID, :libelle_facture, :quantite_facture, :montant_facture, :numero_facture, :montant_total)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
                $stmt->bindParam(':libelle_facture', $libelle, PDO::PARAM_STR);
                $stmt->bindParam(':quantite_facture', $quantite_facture[$i], PDO::PARAM_INT);
                $stmt->bindParam(':montant_facture', $montant_facture[$i], PDO::PARAM_STR);
                $stmt->bindParam(':numero_facture', $numero_facture, PDO::PARAM_STR);
                $stmt->bindParam(':montant_total', $montant_total, PDO::PARAM_STR);
                $stmt->execute();
            }

            // Insert into the "total_factures" table
            $sqlTotal = "INSERT INTO total_factures (ID, somme_total) VALUES (:ID, :somme_total)";
            $stmtTotal = $dbh->prepare($sqlTotal);
            $stmtTotal->bindParam(':ID', $ID, PDO::PARAM_INT);
            $stmtTotal->bindParam(':somme_total', $somme_total, PDO::PARAM_STR);
            $stmtTotal->execute();

            // Commit the transaction
            $dbh->commit();

            // Success message
            echo '<script>alert("pannes enregistré avec succès.")</script>';
            echo "<script>window.location.href ='add-p.php'</script>";
        } catch (Exception $e) {
            // Rollback in case of error
            $dbh->rollBack();
            echo '<script>alert("Erreur : ' . $e->getMessage() . '")</script>';
        }
    }

?><?php
// Assume a connection to the database has already been established
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des flottes soumafe | Enregistrement du véhicule</title>

    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="forme.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        /* Form Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        /* Input and Form Group */
        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], input[type="number"], input[type="date"], input[type="datetime-local"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border 0.3s;
        }

        input:focus {
            border-color: #007BFF;
            outline: none;
        }

        /* Buttons */
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .removePanne, .removeFacture {
            background-color: #dc3545;
        }

        .removePanne:hover, .removeFacture:hover {
            background-color: #c82333;
        }

        /* Special Input */
        #somme_total, #pannes_total {
            font-weight: bold;
            background: #e2e2e2;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <!-- Navbar top -->
    <?php include_once('includes/header.php'); ?>

    <!-- Navbar side -->
    <?php include_once('includes/sidebar.php'); ?>

    <!-- Page wrapper -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Enregistrement des pannes et factures</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container">
                            <form id="pannesForm" method="post" action="">

                                <!-- Vehicle and General Details Section -->
                                <div class="form-section">
                                    <!-- Left Column -->
                                    <div class="left">
                                        <div class="form-group">
                                            <label for="ID">Sélectionnez le véhicule<span style="font-size:11px;color:red">*</span></label>
                                            <select name="ID" id="ID" class="form-control" required>
                                                <?php 
                                                    $sql2 = "SELECT * FROM vh_list";
                                                    $query2 = $dbh->prepare($sql2);
                                                    $query2->execute();
                                                    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                    foreach ($result2 as $row) { ?>
                                                        <option value="<?php echo htmlentities($row->ID); ?>">
                                                            <?php echo htmlentities($row->imt) . ' ' . htmlentities($row->marque); ?>
                                                        </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="numero_facture">Numéro Facture :</label>
                                            <input type="text" id="numero_facture" name="numero_facture" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="decla">Date de déclaration :</label>
                                            <input type="date" id="decla" name="decla" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="dateal">Date d'aller au garage :</label>
                                            <input type="date" id="dateal" name="dateal" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="gar">Garage :</label>
                                            <input type="text" id="gar" name="gar" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="right">
                                        <div class="form-group">
                                            <label for="resp">Garage Responsable :</label>
                                            <input type="text" id="resp" name="resp" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sortie">Date de sortie :</label>
                                            <input type="date" id="sortie" name="sortie" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="temps">Temps de sortie :</label>
                                            <input type="text" id="temps" name="temps" class="form-control" required>
                                        </div>
                                        <div id="pannesContainer">
                                            <div class="panne">
                                                <label for="libelle_panne">Libellé Panne :</label>
                                                <input type="text" name="libelle_panne[]" required>
                                                <button type="button" class="removePanne"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <button type="button" id="addPanne"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>

                                <!-- Factures Section -->
                                <div class="form-section">
                                    <div class="left">
                                        <h3>Factures</h3>
                                        <div id="facturesContainer">
                                            <div class="facture">
                                                <label for="libelle_facture">Libellé Facture :</label>
                                                <input type="text" name="libelle_facture[]" required>
                                                <label for="quantite_facture">Quantité :</label>
                                                <input type="number" name="quantite_facture[]" required oninput="updateFactureMontantTotal(this)">
                                                <label for="montant_facture">Montant :</label>
                                                <input type="number" name="montant_facture[]" step="0.01" required oninput="updateFactureMontantTotal(this)">
                                                <label for="montant_total_facture">Montant total :</label>
                                                <input type="number" name="montant_total[]" step="0.01" required readonly>
                                                <button type="button" class="removeFacture"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                        <button type="button" id="addFacture"><i class="fas fa-plus"></i></button>
                                    </div>

                                    <!-- Total Pannes and Factures Section -->
                                    <div class="right">
                                        <div class="form-group">
                                            <label for="somme_total">Somme totale (Factures) :</label>
                                            <input type="number" id="somme_total" name="somme_total" step="0.01" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="pannes_total">Total Pannes :</label>
                                            <input type="number" id="pannes_total" name="pannes_total" step="0.01" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="obser">Observation :</label>
                                            <input type="text" id="obser" name="obser" class="form-control" required>
                                        </div>

                                        <!-- Submit Button -->
                                        <p style="text-align: center;">
                                            <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Enregistrer</button>
                                        </p>

                                        <script>
                                            function confirmSubmission() {
                                                return confirm('Êtes-vous sûr de vouloir enregistrer?');
                                            }

                                            // Functions for dynamic addition/removal and calculation
                                            document.getElementById('addPanne').addEventListener('click', function () {
                                                const panneDiv = document.createElement('div');
                                                panneDiv.className = 'panne';
                                                panneDiv.innerHTML = `
                                                    <label for="libelle_panne">Libellé Panne :</label>
                                                    <input type="text" name="libelle_panne[]" required>
                                                    <button type="button" class="removePanne"><i class="fa fa-trash"></i></button>
                                                `;
                                                document.getElementById('pannesContainer').appendChild(panneDiv);
                                            });

                                            document.getElementById('addFacture').addEventListener('click', function () {
                                                const factureDiv = document.createElement('div');
                                                factureDiv.className = 'facture';
                                                factureDiv.innerHTML = `
                                                    <label for="libelle_facture">Libellé Facture :</label>
                                                    <input type="text" name="libelle_facture[]" required>
                                                    <label for="quantite_facture">Quantité :</label>
                                                    <input type="number" name="quantite_facture[]" required oninput="updateFactureMontantTotal(this)">
                                                    <label for="montant_facture">Montant :</label>
                                                    <input type="number" name="montant_facture[]" step="0.01" required oninput="updateFactureMontantTotal(this)">
                                                    <label for="montant_total_facture">Montant total :</label>
                                                    <input type="number" name="montant_total[]" step="0.01" required readonly>
                                                    <button type="button" class="removeFacture"><i class="fa fa-trash"></i></button>
                                                `;
                                                document.getElementById('facturesContainer').appendChild(factureDiv);
                                            });

                                            // Event delegation for removing pannes
                                            document.getElementById('pannesContainer').addEventListener('click', function (event) {
                                                if (event.target.classList.contains('removePanne')) {
                                                    event.target.parentElement.remove();
                                                    calculateTotalPannes();
                                                }
                                            });

                                            // Event delegation for removing factures
                                            document.getElementById('facturesContainer').addEventListener('click', function (event) {
                                                if (event.target.classList.contains('removeFacture')) {
                                                    event.target.parentElement.remove();
                                                    calculateTotalFactures();
                                                }
                                            });

                                            // Calculate total for invoices
                                            function updateFactureMontantTotal(element) {
                                                const factureDiv = element.closest('.facture');
                                                const quantite = factureDiv.querySelector('input[name="quantite_facture[]"]').value || 0;
                                                const montant = factureDiv.querySelector('input[name="montant_facture[]"]').value || 0;
                                                const montantTotalInput = factureDiv.querySelector('input[name="montant_total[]"]');
                                                const montantTotal = quantite * montant;
                                                montantTotalInput.value = montantTotal.toFixed(2);
                                                calculateTotalFactures();
                                            }

                                            // Calculate total factures
                                            function calculateTotalFactures() {
                                                let totalFactures = 0;
                                                const factureTotalInputs = document.querySelectorAll('input[name="montant_total[]"]');

                                                factureTotalInputs.forEach(input => {
                                                    if (input.value) {
                                                        totalFactures += parseFloat(input.value);
                                                    }
                                                });

                                                document.getElementById('somme_total').value = totalFactures.toFixed(2);
                                            }

                                            // Calculate total pannes
                                            function calculateTotalPannes() {
                                                let totalPannes = 0;
                                                const panneTotalInputs = document.querySelectorAll('input[name="libelle_panne[]"]'); // Adjust as necessary for panne calculations

                                                panneTotalInputs.forEach(input => {
                                                    if (input.value) {
                                                        totalPannes += parseFloat(input.value); // Change this line based on how you want to calculate pannes
                                                    }
                                                });

                                                document.getElementById('pannes_total').value = totalPannes.toFixed(2);
                                            }

                                            // Call this function on input change for pannes if necessary
                                        </script>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="assets/plugins/jquery/jquery-1.10.2.min.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>

<?php }  ?>