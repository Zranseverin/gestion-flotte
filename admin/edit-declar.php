<?php
session_start();
include('includes/dbconnection.php');

// Vérifier si la session existe
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupérer les données du formulaire
        $date_d = $_POST['date_d'];
        $heure_d = $_POST['heure_d'];
        $ID = $_POST['ID'];
        $imt = $_POST['imt'];
        $lib_pan = json_encode($_POST['lib_pan']); // Tableau de pannes converti en JSON
        $date_dia = $_POST['date_dia'];
        $obser = $_POST['obser'];
        $eid = $_GET['editid'];  // Récupérer l'ID du dossier à modifier depuis l'URL

        // Requête de mise à jour
        $sql = "UPDATE diagn SET 
                imt = :imt, 
                ID = :ID, 
                date_d = :date_d,  
                heure_d = :heure_d, 
                lib_pan = :lib_pan, 
                date_dia = :date_dia, 
                obser = :obser
                WHERE decid = :eid";

        $query = $dbh->prepare($sql);

        // Lier les paramètres
        $query->bindParam(':date_d', $date_d, PDO::PARAM_STR);
        $query->bindParam(':heure_d', $heure_d, PDO::PARAM_STR);
        $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':lib_pan', $lib_pan, PDO::PARAM_STR);
        $query->bindParam(':date_dia', $date_dia, PDO::PARAM_STR);
        $query->bindParam(':obser', $obser, PDO::PARAM_STR);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        // Exécuter la requête
        $query->execute();

        // Feedback à l'utilisateur et redirection
        echo '<script>alert("Information modifiée avec succès.")</script>';
        echo "<script>window.location.href ='manage-decl.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des flottes Soumafe | Enregistrement des dépenses</title>

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
                            <?php
                            $eid = $_GET['editid'];
                            $sql = "SELECT * FROM diagn WHERE decid = :eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                            ?>
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
                                                    foreach ($result2 as $v) { ?>
                                                        <option value="<?php echo htmlentities($v->ID); ?>"
                                                            <?php echo ($v->ID == $row->ID) ? 'selected' : ''; ?>>
                                                            <?php echo htmlentities($v->imt) . ' ' . htmlentities($v->marque); ?>
                                                        </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="imt">Immatriculation :</label>
                                            <input type="text" id="imt" name="imt" value="<?php echo htmlentities($row->imt); ?>" class="form-control" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_d">Date de la déclaration :</label>
                                            <input type="date" id="date_d" name="date_d" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="heure_d">Heure de la déclaration :</label>
                                            <input type="time" id="heure_d" name="heure_d" class="form-control" value="<?php echo date('H:i'); ?>" required>
                                        </div>
                                    </div>

                                    <div class="right">
                                        <div class="form-group">
                                            <label for="date_dia">Date de la reparation :</label>
                                            <input type="date" id="date_dia" name="date_dia" class="form-control" value="<?php echo date('Y-m-d'); ?>">
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
                            <?php } } ?> 
                            <p style="text-align: center;">
                                <button type="submit" class="btn btn-primary" name="submit" id="submit">Enregistrer</button>
                            </p>

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
                                                },
                                                error: function() {
                                                    alert('Failed to retrieve data. Please try again.');
                                                }
                                            });
                                        }
                                    });

                                    $('#addFacture').on('click', function () {
                                        const depensesDiv = $('<div class="depenses"><label for="libelle_depenses">Libellé panne :</label><input type="text" name="lib_pan[]" required><button type="button" class="removeDepense"><i class="fas fa-minus"></i></button></div>');
                                        $('#depensesContainer').append(depensesDiv);
                                    });

                                    $('#depensesContainer').on('click', '.removeDepense', function () {
                                        $(this).closest('.depenses').remove();
                                    });
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
</body>
</html>
<?php } ?>
