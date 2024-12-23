<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the session is valid
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {

    // Define the logUserAction function outside the form processing block
    function logUserAction($dbh, $ID, $action, $description) {
        // Récupérer l'adresse IP de l'utilisateur
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        // Préparer la requête pour insérer dans la table des actions
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
        $num_f = strtoupper(filter_input(INPUT_POST, 'num_f', FILTER_SANITIZE_STRING));

        // Factures data (arrays)
        $libelle_depenses = $_POST['libelle_depenses'];
        $quantite_depenses = $_POST['quantite_depenses'];
        $montant_depenses = $_POST['montant_depenses'];
        $date = $_POST['date'];
        $imt = $_POST['imt'];

        // Total amount of all factures
        $somme_total = filter_input(INPUT_POST, 'somme_total', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
        try {
            // Start transaction
            $dbh->beginTransaction();

            // Insert into the "factures" table
            foreach ($libelle_depenses as $i => $libelle) {
                $montant_total = $quantite_depenses[$i] * $montant_depenses[$i];

                $sql = "INSERT INTO depenses (ID, libelle_depenses, quantite_depenses, montant_depenses, num_f, montant_total, date,imt) 
                        VALUES (:ID, :libelle_depenses, :quantite_depenses, :montant_depenses, :num_f, :montant_total, :date,:imt)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':ID', $ID, PDO::PARAM_INT);
                $stmt->bindParam(':libelle_depenses', $libelle, PDO::PARAM_STR);
                $stmt->bindParam(':quantite_depenses', $quantite_depenses[$i], PDO::PARAM_INT);
                $stmt->bindParam(':montant_depenses', $montant_depenses[$i], PDO::PARAM_STR);
                $stmt->bindParam(':num_f', $num_f, PDO::PARAM_STR);
                $stmt->bindParam(':montant_total', $montant_total, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':imt', $imt, PDO::PARAM_STR);
                $stmt->execute();
            }

            // Insert into the "total_factures" table
            $sqlTotal = "INSERT INTO total_dp (ID,imt, somme_total) VALUES (:ID,:imt, :somme_total)";
            $stmtTotal = $dbh->prepare($sqlTotal);
            $stmtTotal->bindParam(':ID', $ID, PDO::PARAM_INT);
            $stmtTotal->bindParam(':imt', $imt, PDO::PARAM_INT);
            $stmtTotal->bindParam(':somme_total', $somme_total, PDO::PARAM_STR);
            $stmtTotal->execute();

            // Commit the transaction
            $dbh->commit();

            // Log the action
            logUserAction($dbh, $_SESSION['bpmsaid'], 'Ajout de dépenses', 'Dépenses enregistrées avec numéro de facture ' . $numero_facture);

            // Success message
            echo '<script>alert("Dépenses enregistrées avec succès.")</script>';
            echo "<script>window.location.href ='add-dp.php'</script>";
        } catch (Exception $e) {
            // Rollback in case of error
            $dbh->rollBack();
            echo '<script>alert("Erreur : ' . $e->getMessage() . '")</script>';
        }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des flottes soumafe | Enregistrement des dépenses</title>

    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="forme.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
$(document).ready(function(){
    $('#ID').change(function(){
        var ID = $(this).val();
        if (ID) {
            $.ajax({
                type: 'POST',
                url: 'get_add_pannes.php',
                data: {ID: ID},
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#imt').val(data.imt);
                   

                    // Add other fields to be auto-filled if needed
                },
                error: function() {
                    alert('Failed to retrieve data. Please try again.');
                }
            });
        }
    });
});
</script>

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

        .removePanne, .removedepenses {
            background-color: #dc3545;
        }

        .removePanne:hover, .removedepenses:hover {
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
                <h1 class="page-header">Enregistrement des depenses</h1>
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
                                            <label for="imt">Immatriculation :</label>
                                            <input type="text" id="imt" name="imt" class="form-control" required  readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="num_f">N° de facture<span style="font-size:11px;color:red">*</span></label>
                                            <select name="num_f" id="num_f" class="form-control" required>
                                                <?php 
                                                    $sql2 = "SELECT * FROM detail_panne";
                                                    $query2 = $dbh->prepare($sql2);
                                                    $query2->execute();
                                                    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                    foreach ($result2 as $row) { ?>
                                                        <option value="<?php echo htmlentities($row->num_f); ?>">
                                                            <?php echo htmlentities($row->num_f) . ' ' . htmlentities($row->num_f); ?>
                                                        </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">date de la dépense :</label>
                                            <input type="date" id="date" name="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="somme_total">Somme totale (Factures) :</label>
                                        <input type="number" id="somme_total" name="somme_total" step="0.01" required readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="obser">Observation :</label>
                                        <input type="text" id="obser" name="obser" class="form-control" required>
                                    </div>
                                    </div>

                                    <!-- Factures Section -->
                                    <div class="right">
                                        <h3>Factures</h3>
                                        <div id="depensesContainer">
                                            <div class="depenses">
                                                <label for="libelle_depenses">Libellé depenses :</label>
                                                <input type="text" name="libelle_depenses[]" required>
                                                <label for="quantite_depenses">Quantité :</label>
                                                <input type="number" name="quantite_depenses[]" required oninput="updatedepensesMontantTotal(this)">
                                                <label for="montant_depenses">Montant :</label>
                                                <input type="number" name="montant_depenses[]" step="0.01" required oninput="updatedepensesMontantTotal(this)">
                                                <label for="montant_total_depenses">Montant total :</label>
                                                <input type="number" name="montant_total[]" step="0.01" required readonly>
                                                <button type="button" class="removedepenses"><i class="fa fa-trash"></i></button> <button type="button" id="addFacture"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>

                                <!-- Total Pannes and Factures Section -->
                                <div class="form-section">
                                   


                                    <!-- Submit Button -->
                                    <p style="text-align: center;">
                                        <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Enregistrer</button>
                                    </p>
                                </div>

                                <script>
                                    function confirmSubmission() {
                                        return confirm('Êtes-vous sûr de vouloir enregistrer?');
                                    }

                                    // Dynamic addition/removal and calculation functions
                                    document.getElementById('addFacture').addEventListener('click', function () {
                                        const depensesDiv = document.createElement('div');
                                        depensesDiv.className = 'depenses';
                                        depensesDiv.innerHTML = `
                                            <label for="libelle_depenses">Libellé depenses :</label>
                                            <input type="text" name="libelle_depenses[]" required>
                                            <label for="quantite_depenses">Quantité :</label>
                                            <input type="number" name="quantite_depenses[]" required oninput="updatedepensesMontantTotal(this)">
                                            <label for="montant_depenses">Montant :</label>
                                            <input type="number" name="montant_depenses[]" step="0.01" required oninput="updatedepensesMontantTotal(this)">
                                            <label for="montant_total_depenses">Montant total :</label>
                                            <input type="number" name="montant_total[]" step="0.01" required readonly>
                                            <button type="button" class="removedepenses"><i class="fa fa-trash"></i></button>
                                        `;
                                        document.getElementById('depensesContainer').appendChild(depensesDiv);
                                    });

                                    // Event delegation for removing factures
                                    document.getElementById('depensesContainer').addEventListener('click', function (event) {
                                        if (event.target.classList.contains('removedepenses')) {
                                            event.target.parentElement.remove();
                                            calculateTotaldepenses();
                                        }
                                    });

                                    // Calculate total for factures
                                    function updatedepensesMontantTotal(element) {
                                        const depensesDiv = element.closest('.depenses');
                                        const quantite = depensesDiv.querySelector('input[name="quantite_depenses[]"]').value || 0;
                                        const montant = depensesDiv.querySelector('input[name="montant_depenses[]"]').value || 0;
                                        const montantTotalInput = depensesDiv.querySelector('input[name="montant_total[]"]');
                                        const montantTotal = quantite * montant;
                                        montantTotalInput.value = montantTotal.toFixed(2);
                                        calculateTotaldepenses();
                                    }

                                    // Calculate total factures
                                    function calculateTotaldepenses() {
                                        let totaldepenses = 0;
                                        const depensesTotalInputs = document.querySelectorAll('input[name="montant_total[]"]');

                                        depensesTotalInputs.forEach(input => {
                                            if (input.value) {
                                                totaldepenses += parseFloat(input.value);
                                            }
                                        });

                                        document.getElementById('somme_total').value = totaldepenses.toFixed(2);
                                    }
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="manage-depenses.php" class="btn btn-primary">
    <i class="fas fa-plus"></i> voir la liste
</a>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="assets/plugins/jquery/jquery-1.10.2.min.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>


<?php }  ?>