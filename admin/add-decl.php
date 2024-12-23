<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        // Récupération des données du formulaire
        $date_d = $_POST['date_d'];
        $heure_d = $_POST['heure_d'];
        $ID = $_POST['ID'];
        $imt = $_POST['imt'];
        $lib_pan = $_POST['lib_pan']; // Tableau de pannes
        $date_dia = $_POST['date_dia'];
        $obser = $_POST['obser'];

        // Parcourir chaque panne et l'insérer dans la base de données
        foreach ($lib_pan as $panne) {
            if (!empty($panne)) {
                // Vérification de l'existence de la panne pour le même véhicule
                $ret = "SELECT lib_pan FROM diagn WHERE lib_pan=:lib_pan AND ID=:ID";
                $query = $dbh->prepare($ret);
                $query->bindParam(':lib_pan', $panne, PDO::PARAM_STR);
                $query->bindParam(':ID', $ID, PDO::PARAM_STR);
                $query->execute();

                if ($query->rowCount() == 0) {
                    // Insertion de la panne dans la base de données
                    $sql = "INSERT INTO diagn(date_d, heure_d, ID, lib_pan, date_dia, obser,imt)
                            VALUES (:date_d, :heure_d, :ID, :lib_pan, :date_dia, :obser,:imt)";
                    $insertQuery = $dbh->prepare($sql);
                    $insertQuery->bindParam(':date_d', $date_d, PDO::PARAM_STR);
                    $insertQuery->bindParam(':heure_d', $heure_d, PDO::PARAM_STR);
                    $insertQuery->bindParam(':ID', $ID, PDO::PARAM_STR);
                    $insertQuery->bindParam(':lib_pan', $panne, PDO::PARAM_STR);
                    $insertQuery->bindParam(':date_dia', $date_dia, PDO::PARAM_STR);
                    $insertQuery->bindParam(':obser', $obser, PDO::PARAM_STR);
                    $insertQuery->bindParam(':imt', $imt, PDO::PARAM_STR);
                    $insertQuery->execute();

                    $LastInsertId = $dbh->lastInsertId();
                    if ($LastInsertId > 0) {
                        echo '<script>alert("Panne déclarée avec succès.")</script>';
                    } else {
                        echo '<script>alert("Une erreur est survenue. Veuillez réessayer.")</script>';
                    }
                } else {
                    echo "<script>alert('Cette panne existe déjà pour ce véhicule.')</script>";
                }
            }
        
        echo "<script>window.location.href ='add-decl.php'</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des flottes Soumafe | Enregistrement des pannes declarée</title>

    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="forme.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
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
        .form-group {
            margin-bottom: 15px;
        }
        input[type="text"], input[type="date"], input[type="time"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
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
</head>
<body>
<div id="wrapper">
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Déclaration de la pannes</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container">
                            <form method="post" action="">

                                <div class="form-section">
                                    <div class="left">
                                        <div class="form-group">
                                            <label for="ID">Sélectionnez le véhicule</label>
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
                                            <input type="imt" id="imt" name="imt" class="form-control" required  readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_d">Date de la déclaration :</label>
                                            <input type="date" id="date_d" name="date_d" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="heure_d">Heure de la déclaration :</label>
                                            <input type="time" id="heure_d" name="heure_d" class="form-control" required>
                                        </div>

                                       

                                      
                                    </div>

                                    <div class="right">
                                    <div class="form-group">
                                            <label for="date_dia">Date de la reparation :</label>
                                            <input type="date" id="date_dia" name="date_dia" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
                                        </div>
                                    <div class="form-group">
                                            <label for="obser">Observation :</label>
                                            <input type="text" id="obser" name="obser" class="form-control" required>
                                        </div>
                                        <h3>Panne déclarée</h3>
                                        <div id="depensesContainer">
                                            <div class="depenses">
                                                <label for="libelle_depenses">Libellé panne :</label>
                                                <input type="text" name="lib_pan[]" required>
                                                <button type="button" id="addFacture"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p style="text-align: center;">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Enregistrer</button>
                                </p>

                                <script>
                                    document.getElementById('addFacture').addEventListener('click', function () {
                                        const depensesDiv = document.createElement('div');
                                        depensesDiv.className = 'depenses';
                                        depensesDiv.innerHTML = `
                                            <label for="libelle_depenses">Libellé panne :</label>
                                            <input type="text" name="lib_pan[]" required>
                                            <button type="button" class="removedepenses"><i class="fa fa-trash"></i></button>
                                        `;
                                        document.getElementById('depensesContainer').appendChild(depensesDiv);
                                    });

                                    document.getElementById('depensesContainer').addEventListener('click', function (event) {
                                        if (event.target.classList.contains('removedepenses')) {
                                            event.target.parentElement.remove();
                                        }
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Fonction pour formater une date en jj-mm-aa
    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = String(date.getFullYear()).slice(-2);
        return `${day}-${month}-${year}`;
    }

    // Fonction pour obtenir la date actuelle au format aaaa-mm-jj pour l'input type="date"
    function getCurrentDate() {
        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();
        return `${year}-${month}-${day}`; // Format aaaa-mm-jj pour input[type=date]
    }

    // Affichage de la date actuelle dans le champ input de texte formaté
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date_d');
        const currentDate = getCurrentDate();  // Date actuelle au format aaaa-mm-jj
        const formattedDate = formatDate(new Date(currentDate));  // Date formatée jj-mm-aa
        
        // Fixe la valeur par défaut du champ date avec la date du jour
        dateInput.value = currentDate;
        
        // Affiche la date formatée en jj-mm-aa dans l'autre champ
        document.getElementById('formatted_date').value = formattedDate;
    });

    // Mettre à jour la date formatée lors du changement de la date
    document.getElementById('date_d').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const formattedDate = formatDate(selectedDate);
        document.getElementById('formatted_date').value = formattedDate;
    });
</script>
<script>
    // Fonction pour obtenir l'heure actuelle au format hh:mm
    function getCurrentTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`; // Format hh:mm pour input[type=time]
    }

    // Affichage de l'heure actuelle dans le champ input time lors du chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        const timeInput = document.getElementById('heure_d');
        timeInput.value = getCurrentTime(); // Définit l'heure actuelle par défaut
    });
</script>
<script src="assets/plugins/jquery/jquery-1.10.2.min.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>

<?php }  ?>
