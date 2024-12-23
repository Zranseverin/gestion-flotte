<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']) == 0) {
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
        $sexe = $_POST['sexe'];
        $adresse = $_POST['adresse'];
        $telephoneT = $_POST['telephoneT'];
        $telephone1 = $_POST['telephone1'];
        $date = $_POST['date'];
        $permis2 = $_POST['permis2'];
    $nom2 = $_POST['nom2'];
    $prenom2 = $_POST['prenom2'];
    $sexe2 = $_POST['sexe2'];
        $adresse2 = $_POST['adresse2'];
        $telephoneT2 = $_POST['telephoneT2'];
        
        $sql = "INSERT INTO attr_list (imt, genre, permis, nom, prenom, marque, date, sexe, adresse, telephoneT, telephone1, model,nom2,prenom2,permis2,telephoneT2,adresse2,sexe2) 
                VALUES (:imt, :genre, :permis, :nom, :prenom, :marque, :date, :sexe, :adresse, :telephoneT, :telephone1, :model,:nom2,:prenom2,:permis2,:telephoneT2,:adresse2,:sexe2)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':genre', $genre, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindParam(':telephoneT', $telephoneT, PDO::PARAM_STR);
        $query->bindParam(':telephone1', $telephone1, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':permis2', $permis2, PDO::PARAM_STR);
    $query->bindParam(':nom2', $nom2, PDO::PARAM_STR);
    $query->bindParam(':prenom2', $prenom2, PDO::PARAM_STR);
    $query->bindParam(':telephoneT2', $telephoneT2, PDO::PARAM_STR);
    $query->bindParam(':adresse2', $adresse2, PDO::PARAM_STR);
    $query->bindParam(':sexe2', $sexe2, PDO::PARAM_STR);

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Attribution effectuée.")</script>';
            echo "<script>window.location.href ='attr-vh.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>


<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flottes soumafe | Attribué des vehicules</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />



</head>

<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Attribution des vehicules</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data"> 
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#permis').change(function(){
        var permis = $(this).val();
        if(permis){
            $.ajax({
                type: 'POST',
                url: 'fetch_driver.php',
                data: {permis: permis},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#nom').val(data.nom);
                    $('#prenom').val(data.prenom);
                    $('#sexe').val(data.sexe);
                    $('#adresse').val(data.adresse);
                    $('#telephoneT').val(data.telephoneT);
                    $('#telephone1').val(data.telephone1);
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
    $(document).ready(function(){
      $('#imt').change(function(){
        var imt = $(this).val();
        if(imt){
            $.ajax({
                type: 'POST',
                url: 'attr_drive.php',
                data: {imt: imt},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#marque').val(data.marque);
                    $('#model').val(data.model);
                    $('#genre').val(data.genre);
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    
     });
    });


    $(document).ready(function(){
    $('#permis2').change(function(){
        var permis2 = $(this).val();
        if(permis2){
            $.ajax({
                type: 'POST',
                url: 'fetch_driver.php',
                data: {permis: permis2},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#nom2').val(data.nom);
                    $('#prenom2').val(data.prenom);
                    $('#adresse2').val(data.adresse);
                    $('#telephoneT2').val(data.telephoneT);
                    $('#sexe2').val(data.sexe);

                },
                error: function(){
                    alert('Erreur lors de la récupération des données');
                }
            });
        }
    });
});


</script>
         <h2>information du véhicule</h2>                           
<div class="form-group">
    <label for="exampleInputEmail1">Immatriculation</label>
    <select name="imt" id="imt" class="form-control" required>
        <option value="">Sélectionnez l'immatriculation</option>
        <?php 

$sql2 = "SELECT * from   vh_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->imt);?>"><?php echo htmlentities($row->imt);?></option>

 <?php } ?>
     </select></div>
<div class="form-group">
    <label for="exampleInputEmail1">marque</label>
    <input type="text" name="marque" id="marque" class="form-control" required readonly>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">model</label>
    <input type="text" name="model" id="model" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">genre</label>
    <input type="text" name="genre" id="genre" class="form-control" required readonly>
</div>
<h2>Information chauffeur</h2>
    <div class="form-group">
    <label for="exampleInputEmail1">permis</label>
    <select name="permis" id="permis" class="form-control" required>
        <option value="">Sélectionnez le N°permis</option>
        <?php 

$sql2 = "SELECT * from   chauffeur_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->permis);?>"><?php echo htmlentities($row->permis);?></option>
 <?php } ?>
     </select></div>
    
<div class="form-group">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text" name="nom" id="nom" class="form-control" required readonly>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Prénom</label>
    <input type="text" name="prenom" id="prenom" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">sexe</label>
    <input type="text" name="sexe" id="sexe" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">adresse</label>
    <input type="text" name="adresse" id="adresse" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">telephoneT</label>
    <input type="text" name="telephoneT" id="telephoneT" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">telephone personnel</label>
    <input type="text" name="telephone1" id="telephone1" class="form-control" required readonly>
</div>
<h2>Information chauffeur</h2>
<h2>Information deuxième chauffeur</h2>
<div class="form-group">
    <label for="permis2">Permis</label>
    <select name="permis2" id="permis2" class="form-control" required>
        <option value="">Sélectionnez le N°permis</option>
        <?php 
        $sql2 = "SELECT * from chauffeur_list";
        $query2 = $dbh -> prepare($sql2);
        $query2->execute();
        $result2=$query2->fetchAll(PDO::FETCH_OBJ);
        foreach($result2 as $row) { ?>  
            <option value="<?php echo htmlentities($row->permis);?>"><?php echo htmlentities($row->permis);?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="nom2">Nom</label>
    <input type="text" name="nom2" id="nom2" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="prenom2">Prénom</label>
    <input type="text" name="prenom2" id="prenom2" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="prenom2">sexe</label>
    <input type="text" name="sexe2" id="sexe2" class="form-control" required readonly>
</div>
<div class="form-group">
    <label for="adresse2">adresse</label>
    <input type="text" name="adresse2" id="adresse2" class="form-control" required readonly>
    <div class="form-group">
    <label for="prenom2">telephone</label>
    <input type="text" name="telephoneT2" id="telephoneT2" class="form-control" required readonly>
</div>
</div>

     <div class="form-group"> <label for="exampleInputEmail1">date d'Attribution</label> <input type="date" name="date" value="" class="form-control" required='true'> </div>
     
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button></p> </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
</body>

</html>
<?php }  ?>