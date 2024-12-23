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
        $genre = $_POST['genre'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephoneT = $_POST['telephoneT'];
        $date = $_POST['date'];
        $hd = $_POST['hd'];
        $ha = $_POST['ha'];
        $tth = $_POST['tth'];
        $dkm = $_POST['dkm'];
        $akm = $_POST['akm'];
        $totkm = $_POST['totkm'];
        $ob = $_POST['ob'];

        $sql = "INSERT INTO svi_list(imt, genre, permis, marque, model, nom, prenom, date, hd,ha, tth, dkm, akm, totkm,ob, telephoneT) 
                VALUES (:imt, :genre, :permis,:marque,:model, :nom, :prenom, :date,:hd,:ha, :tth, :dkm, :akm, :totkm ,:ob,:telephoneT)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genre', $genre, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':telephoneT', $telephoneT, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':hd', $hd, PDO::PARAM_STR);
        $query->bindParam(':ha', $ha, PDO::PARAM_STR);
        $query->bindParam(':tth', $tth, PDO::PARAM_STR);
        $query->bindParam(':dkm', $dkm, PDO::PARAM_STR);
        $query->bindParam(':akm', $akm, PDO::PARAM_STR);
        $query->bindParam(':totkm', $totkm, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("suivi des vehicules detail has been added.")</script>';
            echo "<script>window.location.href ='add-svi.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | Ajouter des kilometrages</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ajouter d'un kilometrage</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="post" enctype="multipart/form-data">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#imt').change(function() {
                                            var imt = $(this).val();
                                            if (imt) {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'vst-driver.php',
                                                    data: { imt: imt },
                                                    success: function(response) {
                                                        var data = JSON.parse(response);
                                                        $('#marque').val(data.marque);
                                                        $('#model').val(data.model);
                                                        $('#genre').val(data.genre);
                                                    }
                                                });
                                            }
                                        });

                                        $('#permis').change(function() {
                                            var permis = $(this).val();
                                            if (permis) {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'get-vh.php',
                                                    data: { permis: permis },
                                                    success: function(response) {
                                                        var data = JSON.parse(response);
                                                        $('#nom').val(data.nom);
                                                        $('#prenom').val(data.prenom);
                                                        $('#telephoneT').val(data.telephoneT);
                                                    }
                                                });
                                            }
                                        });
                                    });

                                    function calculerResultats() {
                                        // Récupérer les valeurs d'entrée
                                        const hd = document.getElementById('hd').value;
                                        const ha = document.getElementById('ha').value;
                                        const dkm = parseFloat(document.getElementById('dkm').value);
                                        const akm = parseFloat(document.getElementById('akm').value);

                                        // Vérifier que toutes les valeurs sont valides
                                        if (!hd || !ha || isNaN(dkm) || isNaN(akm)) {
                                            return;
                                        }

                                        // Calcul de la différence d'heures
                                        const diffTemps = new Date(`1970-01-01T${ha}`) - new Date(`1970-01-01T${hd}`);
                                        const heures = Math.floor(diffTemps / 1000 / 60 / 60);
                                        const minutes = Math.floor((diffTemps / 1000 / 60) % 60);

                                        // Calcul de la différence de kilométrage
                                        const difftotkm = akm - dkm;

                                        // Afficher les résultats
                                        document.getElementById('tth').value = `${heures} heures et ${minutes} minutes`;
                                        document.getElementById('totkm').value = `${difftotkm} km`;
                                    }
                                </script>

                                <div class="form-group">
                                    <label for="imt">Immatriculation</label>
                                    <select name="imt" id="imt" class="form-control" required>
                                        <option value="">Sélectionnez l'immatriculation</option>
                                        <?php
                                        $sql2 = "SELECT * FROM attr_list";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($result2 as $row) {
                                            echo '<option value="' . htmlentities($row->imt) . '">' . htmlentities($row->imt) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Champ Marque -->
                                <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" class="form-control" required readonly>
                                </div>

                                <!-- Champ Modèle -->
                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" required readonly>
                                </div>

                                <!-- Champ Genre -->
                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <input type="text" name="genre" id="genre" class="form-control" required readonly>
                                </div>

                                <!-- Champ Permis -->
                                <div class="form-group">
                                    <label for="permis">Permis</label>
                                    <select name="permis" id="permis" class="form-control" required>
                                        <option value="">Sélectionnez permis</option>
                                        <?php
                                        $sql2 = "SELECT * FROM attr_list";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($result2 as $row) {
                                            echo '<option value="' . htmlentities($row->permis) . '">' . htmlentities($row->permis) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Champ Nom -->
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" required readonly>
                                </div>

                                <!-- Champ Prénom -->
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" required readonly>
                                </div>

                                <!-- Champ Téléphone -->
                                <div class="form-group">
                                    <label for="telephoneT">Téléphone</label>
                                    <input type="text" name="telephoneT" id="telephoneT" class="form-control" required readonly>
                                </div>

                                <!-- Champ Date -->
                                <div class="form-group">
                                    <label for="date">Date </label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>

                                <!-- Champ Heure de départ -->
                                <div class="form-group">
                                    <label for="hd">Heure de départ</label>
                                    <input type="time" id="hd" name="hd" class="form-control" oninput="calculerResultats();">
                                </div>

                                <!-- Champ Heure d'arrivée -->
                                <div class="form-group">
                                    <label for="ha">Heure d'arrivée</label>
                                    <input type="time" id="ha" name="ha" class="form-control" oninput="calculerResultats();">
                                </div>

                                <!-- Champ Km de départ -->
                                <div class="form-group">
                                    <label for="dkm">Km départ</label>
                                    <input type="number" id="dkm" name="dkm" class="form-control" oninput="calculerResultats();">
                                </div>

                                <!-- Champ Km d'arrivée -->
                                <div class="form-group">
                                    <label for="akm">Km d'arrivée</label>
                                    <input type="number" id="akm" name="akm" class="form-control" oninput="calculerResultats();">
                                </div>

                                <!-- Champ pour la durée calculée -->
                                <div class="form-group">
                                    <label for="tth">Durée</label>
                                    <input type="text" id="tth" name="tth" class="form-control" readonly>
                                </div>

                                <!-- Champ pour la distance parcourue calculée -->
                                <div class="form-group">
                                    <label for="totkm">Kilométrage parcouru</label>
                                    <input type="text" id="totkm" name="totkm" class="form-control" readonly>
                                </div>

                                <!-- Champ Observation -->
                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" class="form-control">
                                </div>

                                <!-- Bouton Ajouter -->
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>

<?php }  ?>