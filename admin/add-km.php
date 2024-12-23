<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $hd = $_POST['hd'];
        $ha = $_POST['ha'];
        $tth = $_POST['tth'];
        $dkm = $_POST['dkm'];
        $akm = $_POST['akm'];
        $totkm = $_POST['totkm'];
        $ob = $_POST['ob'];
        $ID = $_POST['ID'];
        $aID = $_POST['aID'];

        $sql = "INSERT INTO svi_list(imt, permis, marque, model, nom, prenom, date, hd,ha, tth, dkm, akm, totkm,ob, ID,aID) 
                VALUES (:imt, :permis,:marque,:model, :nom, :prenom, :date,:hd,:ha, :tth, :dkm, :akm, :totkm ,:ob,:ID,:aID)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':hd', $hd, PDO::PARAM_STR);
        $query->bindParam(':ha', $ha, PDO::PARAM_STR);
        $query->bindParam(':tth', $tth, PDO::PARAM_STR);
        $query->bindParam(':dkm', $dkm, PDO::PARAM_STR);
        $query->bindParam(':akm', $akm, PDO::PARAM_STR);
        $query->bindParam(':totkm', $totkm, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);
        $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':aID', $aID, PDO::PARAM_STR);

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("suivi Enregistré.")</script>';
            echo "<script>window.location.href ='add-km.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | Ajouter des kilométrages</title>
    <!-- Core CSS -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="forme.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Style for layout organization -->
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .left, .centre, .right {
            flex: 1;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], input[type="email"], input[type="file"], input[type="tel"], input[type="number"], input[type="time"], textarea, select {
            border: 2px solid #90EE90;
            border-radius: 4px;
            text-transform: uppercase;
        }
        input:focus, textarea:focus, select:focus {
            border-color: red;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .panel-body {
            padding: 20px;
        }
    </style>
    
    <script>
        // Functions for AJAX and form logic
        $(document).ready(function(){
            $('#ID').change(function(){
                var ID = $(this).val();
                if(ID){
                    $.ajax({
                        type: 'POST',
                        url: 'get_vr.php',
                        data: {ID: ID},
                        success: function(response){
                            var data = JSON.parse(response);
                            $('#imt').val(data.imt);
                            $('#marque').val(data.marque);
                            $('#model').val(data.model);
                        }
                    });
                }
            });

            $('#aID').change(function(){
                var aID = $(this).val();
                if(aID){
                    $.ajax({
                        type: 'POST',
                        url: 'get_ver.php',
                        data: {aID: aID},
                        success: function(response){
                            var data = JSON.parse(response);
                            $('#permis').val(data.permis);
                            $('#nom').val(data.nom);
                            $('#prenom').val(data.prenom);
                        }
                    });
                }
            });
        });

        function calculerResultats() {
            const hd = document.getElementById('hd').value;
            const ha = document.getElementById('ha').value;
            const dkm = parseFloat(document.getElementById('dkm').value);
            const akm = parseFloat(document.getElementById('akm').value);

            if (!hd || !ha || isNaN(dkm) || isNaN(akm)) return;

            const diffTemps = new Date(`1970-01-01T${ha}`) - new Date(`1970-01-01T${hd}`);
            const heures = Math.floor(diffTemps / 1000 / 60 / 60);
            const minutes = Math.floor((diffTemps / 1000 / 60) % 60);
            const difftotkm = akm - dkm;

            document.getElementById('tth').value = `${heures} heures et ${minutes} minutes`;
            document.getElementById('totkm').value = `${difftotkm} km`;
        }

        function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }

        window.onload = function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;
        };
    </script>
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enregistrement des kilométrages</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="container">
                                    <!-- Left Section -->
                                    <div class="left">
                                        <div class="form-group">
                                            <label>Véhicule</label>
                                            <select class="form-control" name="ID" id="ID" required>
                                                <option value="">Sélectionnez le véhicule</option>
                                                <?php
                                                $sql = "SELECT * from vh_list";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                if($query->rowCount() > 0) {
                                                    foreach($results as $row) { ?>
                                                        <option value="<?php echo htmlentities($row->ID);?>">
                                                            <?php echo htmlentities($row->imt); ?> | <?php echo htmlentities($row->model); ?>
                                                        </option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="imt">Immatriculation</label>
                                            <input type="text" name="imt" id="imt" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="marque">Marque</label>
                                            <input type="text" name="marque" id="marque" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="model">Modèle</label>
                                            <input type="text" name="model" id="model" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Chauffeur</label>
                                            <select class="form-control" name="aID" id="aID" required>
                                                <option value="">Sélectionnez le chauffeur</option>
                                                <!-- Options will be loaded via AJAX -->
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Center Section -->
                                    <div class="centre">
                                        <div class="form-group">
                                            <label for="permis">N° de permis</label>
                                            <input type="text" name="permis" id="permis" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nom">Nom</label>
                                            <input type="text" name="nom" id="nom" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="prenom">Prénom</label>
                                            <input type="text" name="prenom" id="prenom" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" id="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="hd">Heure de départ</label>
                                            <input type="time" id="hd" name="hd" class="form-control" oninput="calculerResultats();">
                                        </div>
                                    </div>

                                    <!-- Right Section -->
                                    <div class="right">
                                        <div class="form-group">
                                            <label for="ha">Heure d'arrivée</label>
                                            <input type="time" id="ha" name="ha" class="form-control" oninput="calculerResultats();">
                                        </div>
                                        <div class="form-group">
                                            <label for="dkm">Km départ</label>
                                            <input type="number" id="dkm" name="dkm" class="form-control" oninput="calculerResultats();">
                                        </div>
                                        <div class="form-group">
                                            <label for="akm">Km d'arrivée</label>
                                            <input type="number" id="akm" name="akm" class="form-control" oninput="calculerResultats();">
                                        </div>
                                        <div class="form-group">
                                            <label for="tth">Durée</label>
                                            <input type="text" id="tth" name="tth" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="totkm">Kilométrage parcouru</label>
                                            <input type="text" id="totkm" name="totkm" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" onclick="return confirmSubmission();">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



<?php }  ?>