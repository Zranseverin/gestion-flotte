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
        $genres = $_POST['genres'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephoneT = $_POST['telephoneT'];
        $versement = $_POST['versement'];
        $pointage = $_POST['pointage'];
        $recette = $_POST['recette'];
        $date = $_POST['date'];
        $total_v = $_POST['total_v'];
        $total_p = $_POST['total_p'];
        $total_r = $_POST['total_r'];
        $total = $_POST['total'];
        $ob = $_POST['ob'];
        $jour = $_POST['jour'];
        $versements = $_POST['versements'];
        $recet = $_POST['recet'];

        $sql = "INSERT INTO vsmt_list(imt, genres, permis, marque, model, nom, prenom, date, jour,versement, pointage, recette, total_v, total_r, total_p, total, ob, telephoneT,versements,recet) 
                VALUES (:imt, :genres, :permis,:marque,:model, :nom, :prenom, :date,:jour,:versement, :pointage, :recette, :total_v, :total_r, :total_p, :total,:ob,:telephoneT,:versements,:recet)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genres', $genres, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':telephoneT', $telephoneT, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':versement', $versement, PDO::PARAM_STR);
        $query->bindParam(':pointage', $pointage, PDO::PARAM_STR);
        $query->bindParam(':recette', $recette, PDO::PARAM_STR);
        $query->bindParam(':total_v', $total_v, PDO::PARAM_STR);
        $query->bindParam(':total_r', $total_r, PDO::PARAM_STR);
        $query->bindParam(':total_p', $total_p, PDO::PARAM_STR);
        $query->bindParam(':total', $total, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);
        $query->bindParam(':jour', $jour, PDO::PARAM_STR);
        $query->bindParam(':versements', $versements, PDO::PARAM_STR);
        $query->bindParam(':recet', $recet, PDO::PARAM_STR);

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Versement detail has been added.")</script>';
            echo "<script>window.location.href ='add-vst.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | Ajouter un versement</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            margin-bottom: 10px;
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
                    <h1 class="page-header">Ajouter un versement</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="post" enctype="multipart/form-data">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                        $('#imt').change(function(){
                                            var imt = $(this).val();
                                            if(imt){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'vst-driver.php',
                                                    data: {imt: imt},
                                                    success: function(response){
                                                        var data = JSON.parse(response);
                                                        $('#marque').val(data.marque);
                                                        $('#model').val(data.model);
                                                       
                                                    }
                                                });
                                            }
                                        });

                                        $('#permis').change(function(){
                                            var permis = $(this).val();
                                            if(permis){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'get-vh.php',
                                                    data: {permis: permis},
                                                    success: function(response){
                                                        var data = JSON.parse(response);
                                                        $('#nom').val(data.nom);
                                                        $('#prenom').val(data.prenom);
                                                        $('#telephoneT').val(data.telephoneT);
                                                    }
                                                });
                                            }
                                        });

                                        $('#genres, #jour').change(calculerRecette);
                                    });

                                    const recettes = {
    yango: {
        ordinaire: 22000,
        ferie: 17000
    },
    taxi: {
        ordinaire: 22000,
        ferie: 17000
    }
};

const versements = {
    yango: {
        ordinaire: 24000,
        ferie: 17000
    },
    taxi: {
        ordinaire: 27000,
        ferie: 22000
    }
};

function calculerRecette() {
    const vehicule = document.getElementById('genres').value;
    const jour = document.getElementById('jour').value;
    const recetteInput = document.getElementById('recet');
    const versementInput = document.getElementById('versements');

    if (vehicule && jour) {
        // Calcul des recettes
        const recet = recettes[vehicule][jour];
        recetteInput.value = recet ? recet+ " francs CFA" : "";

        // Calcul des versements
        const versement = versements[vehicule][jour];
        versementInput.value = versement ? versement + " francs CFA" : "";
    } else {
        recetteInput.value = "";
        versementInput.value = "";
    }
}


                                    function calculerRecetteTotal() {
                                        const versement = parseFloat(document.getElementById('versement').value) || 0;
                                        const pointage = parseFloat(document.getElementById('pointage').value) || 0;

                                        const recette = versement - pointage;
                                        document.getElementById('recette').value = recette.toFixed(2);

                                        document.getElementById('total_v').value = versement.toFixed(2);
                                        document.getElementById('total_r').value = recette.toFixed(2);
                                        document.getElementById('total').value = versement.toFixed(2);
                                    }
                                    $(document).ready(function () {
        $('#imt').change(function () {
            var imt = $(this).val();
            if (imt) {
                $.ajax({
                    type: 'POST',
                    url: 'get-permis.php',
                    data: {imt: imt},
                    success: function (response) {
                        var data = JSON.parse(response);
                        
                        // Remplir le champ permis
                        $('#permis').val(data.permis);

                        // Remplir les champs nom et prénom
                        $('#nom').val(data.nom);
                        $('#prenom').val(data.prenom);
                    }
                });
            } else {
                // Réinitialiser les champs si aucune immatriculation n'est sélectionnée
                $('#permis').val('');
                $('#nom').val('');
                $('#prenom').val('');
            }
        });
    });
</script>
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
                                            echo '<option value="' . htmlentities($row->imt) . '">' . htmlentities($row->imt) . ' ' . htmlentities($row->marque) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" required readonly>
                                </div>

                              

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

                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="telephoneT">Téléphone</label>
                                    <input type="text" name="telephoneT" id="telephoneT" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date de Versement</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="genres">Véhicule</label>
                                    <select name="genre" id="genres" class="form-control" required>
                                        <option value="">Sélectionner le véhicule</option>
                                        <option value="yango">Yango</option>
                                        <option value="taxi">Taxi</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jour">Jour</label>
                                    <select name="jour" id="jour" class="form-control" required>
                                        <option value="">Sélectionner le jour</option>
                                        <option value="ferie"> Férié</option>
                                        <option value="ordinaire">Ordinaire</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="versements">versement prévu:</label>
                                    <input type="text" id="versements" name="versements" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recet">Recette prévue:</label>
                                    <input type="text" id="recet" name="recet" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="versement">Versement</label>
                                    <input type="text" id="versement" name="versement" class="form-control" required maxlength="10" pattern="[0-9]+" oninput="calculerRecetteTotal()">
                                </div>

                                <div class="form-group">
                                    <label for="pointage">Pointage</label>
                                    <input type="text" id="pointage" name="pointage" class="form-control" required maxlength="10" pattern="[0-9]+" oninput="calculerRecetteTotal()">
                                </div>

                                <div class="form-group">
                                    <label for="recette">Recette</label>
                                    <input type="text" id="recette" name="recette" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total_v">Total Versement</label>
                                    <input type="text" id="total_v" name="total_v" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total_r">Total Recette</label>
                                    <input type="text" id="total_r" name="total_r" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total">Total Global</label>
                                    <input type="text" id="total" name="total" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" class="form-control">
                                </div>

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