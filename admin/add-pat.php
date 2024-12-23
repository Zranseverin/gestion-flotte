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
        $ref = $_POST['ref'];
        $mt = $_POST['mt'];
        $dte = $_POST['dte'];
        $heure = $_POST['heure'];
        $fin = $_POST['fin'];
         // Correction de la variable $dte au lieu de $tel pour la date

        // Gestion de la photo
        $photo = $_FILES["photo"]["name"];
        $extension = substr($photo, strlen($photo) - 4, strlen($photo));
        $allowed_extensions = array( ".pdf");

        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Format de photo invalide. Seuls les formats jpg/jpeg/png/pdf sont autorisés.');</script>";
        } else {
            // Téléchargement de la photo
            $photo = md5($photo) . time() . $extension;
            move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $photo);

            // Requête SQL
            $sql = "INSERT INTO patente_list(imt, marque, ref, mt, dte, heure,fin,photo)
                    VALUES (:imt, :marque, :ref, :mt, :heure, :fin, :dte, :photo)";

            $query = $dbh->prepare($sql);
            $query->bindParam(':imt', $imt, PDO::PARAM_STR);
            $query->bindParam(':marque', $marque, PDO::PARAM_STR);
            $query->bindParam(':ref', $ref, PDO::PARAM_STR);
            $query->bindParam(':mt', $mt, PDO::PARAM_STR);
            $query->bindParam(':dte', $dte, PDO::PARAM_STR);
            $query->bindParam(':heure', $heure, PDO::PARAM_STR);
            $query->bindParam(':fin', $fin, PDO::PARAM_STR);
            $query->bindParam(':photo', $photo, PDO::PARAM_STR);

            // Exécution de la requête
            $query->execute();

            // Vérification de l'insertion
            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("patente ajouté avec succès.")</script>';
                echo "<script>window.location.href ='add-pat.php'</script>";
            } else {
                echo '<script>alert("Une erreur est survenue. Veuillez réessayer.")</script>';
            }
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | patente</title>
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
                    <h1 class="page-header">Ajouter patente</h1>
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
                                    });

                                    function calculerRecetteTotal() {
                                        const versement = parseFloat(document.getElementById('versement').value) || 0;
                                        const pointage = parseFloat(document.getElementById('pointage').value) || 0;

                                        const recette = versement - pointage;
                                        document.getElementById('recette').value = recette.toFixed(2);

                                        document.getElementById('total_v').value = versement.toFixed(2);
                                        document.getElementById('total_r').value = recette.toFixed(2);
                                        document.getElementById('total').value = versement.toFixed(2);
                                    }

                                    function getvt(val) {
$.ajax({
type: "POST",
url: "get_vts.php",
data:'imt='+val,
success: function(data){
$("#imt").html(data);
}
});
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
                                            echo '<option value="' . htmlentities($row->imt) . '">' . htmlentities($row->imt) . '' . htmlentities($row->marque) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" class="form-control" required readonly>
                                </div>

                               

                               

                                <div class="form-group">
                                    <label for="ref">Reference</label>
                                    <input type="text" name="ref" id="ref" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="mt"> moontant</label>
                                    <input type="text" name="mt" id="mt" class="form-control" required >
                                </div>

                                <div class="form-group">
                                    <label for="dte">date </label>
                                    <input type="date" name="dte" id="dte" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="heure">heure</label>
                                    <input type="time" name="heure" id="heure" class="form-control" required >
                                </div>

                                <div class="form-group">
                                    <label for="cle"> fin </label>
                                    <input type="date" name="fin" id="fin" class="form-control" required >
                                </div>
                               
                                <div class="form-group"> <label for="exampleInputEmail1">photo </label> <input type="file" name="photo" id="photo"  value="" class="form-control" required='true'> </div>
                               

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Enregistrer</button>
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