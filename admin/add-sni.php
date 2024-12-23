<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit']))
     {
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $genre = $_POST['genre'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephoneT = $_POST['telephoneT'];
        $date = $_POST['date'];
        $photo=$_FILES["photo"]["name"];
$extension = substr($photo,strlen($photo)-4,strlen($photo));
$allowed_extensions = array(".pdf");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('photo existant ,  format invalid. Only pdf format allowed');</script>";
}
else
{

$photo=md5($photo).time().$extension;
 move_uploaded_file($_FILES["photo"]["tmp_name"],"images/".$photo);
        

        $sql = "INSERT INTO sni_list(imt, genre, permis, marque, model, nom, prenom, date,photo,telephoneT) 
                VALUES (:imt, :genre, :permis,:marque,:model, :nom, :prenom, :date,:photo,:telephoneT)";
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
        $query->bindParam(':photo',$photo,PDO::PARAM_STR);

        $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("sinistre enregistré .")</script>';
echo "<script>window.location.href ='add-sni.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | Ajoutersnistre</title>
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
                    <h1 class="page-header">Ajouter un snistre</h1>
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
                                                        $('#genre').val(data.genre);
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
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <input type="text" name="genre" id="genre" class="form-control" required readonly>
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
                                    <label for="date">date</label>
                                    <input type="date" name="date" id="date" class="form-control" required >
                                </div>
                                <div class="form-group"> <label for="exampleInputEmail1">photo </label> <input type="file" name="photo" id="photo"  value="" class="form-control" required='true'> </div>
                               

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