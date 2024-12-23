<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

    $ID=$_POST['ID'];
 $imt=$_POST['imt'];
$marque=$_POST['marque'];
$model=$_POST['model'];
$genre=$_POST['genre'];
$chID=$_POST['chID'];
$permis=$_POST['permis'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$sexe=$_POST['sexe'];
$dateN=$_POST['dateN'];
$date=$_POST['date'];

$sql = "INSERT INTO attr_list (ID,imt, genre, marque, model,chID,permis, nom, prenom, sexe, dateN, date) 
                VALUES (:ID,:imt, :genre,:marque, :model, :chID, :permis, :nom, :prenom, :sexe, :dateN, :date)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':genre', $genre, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':chID', $chID, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $query->bindParam(':dateN', $dateN, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Attribution effectuée.")</script>';
            echo "<script>window.location.href ='add-attr.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flottes soumafe | Attribution</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <link rel="stylesheet" href="forme.css">



</head>

<body>
<style>
    input[type="text"] {
   
    border: 2px solid #90EE90;
    border-radius: 4px;
    text-transform: uppercase;
}

input[type="text"]:focus {
    border-color: red;;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    text-transform: uppercase;
}
input[type="date"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="date"]:focus {
   border-color: red;;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
input[type="email"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="email"]:focus {
   border-color: red;;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
input[type="file"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="file"]:focus {
   border-color: red;;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
input[type="tel"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="tel"]:focus {
   border-color: red;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
select[type="text"]:focus{
    border: 2px solid chartreuse;
   border-radius: 4px;
   text-transform: uppercase;
}
select[type="text"]:focus{
    border-color: blue;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
small {
    color: red;
    font-size: 12px;
}
.form-group input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #007bff; /* Couleur de la case cochée */
    margin-right: 5px;
}

.form-group input[type="checkbox"]:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.form-group input[type="checkbox"]:hover {
    border-color: #0056b3;
    background-color: #0056b3;
}
</style>
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
                    <h1 class="page-header">Attribution</h1>
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
                                    <div class="container">
            <div class="form-section">
                <div class="left">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#ID').change(function(){
        var ID = $(this).val();
        if(ID){
            $.ajax({
                type: 'POST',
                url: 'get_attribution.php',
                data: {ID: ID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#imt').val(data.imt);
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
    $('#chID').change(function(){
        var chID = $(this).val();
        if(chID){
            $.ajax({
                type: 'POST',
                url: 'get-ch.php',
                data: {chID: chID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#permis').val(data.permis);
                    $('#nom').val(data.nom);
                    $('#prenom').val(data.prenom);
                    $('#sexe').val(data.sexe);
                    $('#dateN').val(data.dateN);
                    
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });


</script>
<div class="form-group"> <label for="ID"> Selectionnez le vehicule<span style="font-size:11px;color:red">*</span></label><select type="text" name="ID" id="ID" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   vh_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->ID);?>"><?php echo htmlentities($row->imt);?><?php echo htmlentities($row->marque);?></option>
 <?php } ?>
     </select></div>                                
    <div class="form-group">
         <label for="imt">Immatriculation du véhicule<span style="font-size:11px;color:red">*</span></label> <input type="text" name="imt" id="imt" value="" class="form-control" required 
        placeholder="Ex: AB-123-CD" required readonly> 
</div>
<div class="form-group">
         <label for="marque">Marque<span style="font-size:11px;color:red">*</span></label> <input type="text" name="marque" id="marque" value="" class="form-control" required 
        placeholder="Ex: ABCDF" required readonly> 
</div>
<div class="form-group">
         <label for="model">Model<span style="font-size:11px;color:red">*</span></label> <input type="text" name="model" id="model" value="" class="form-control" required 
        placeholder="Ex: ABCD" required readonly> 
</div> 
<div class="form-group">
         <label for="genre">Genre<span style="font-size:11px;color:red">*</span></label> <input type="text" name="genre" id="genre" value="" class="form-control" required 
        placeholder="Ex: ABCDD" required readonly> 
</div>
<div class="form-group">
         <label for="DateN">Date d'Attribution<span style="font-size:11px;color:red">*</span></label> <input type="date" name="date" id="date" value="" class="form-control" required 
        placeholder="JJ/MM/AA"> 
</div>
</div>
<div class="right">
<div class="form-group"> <label for="chID"> Selectionnez le chauffeur<span style="font-size:11px;color:red">*</span></label><select type="text" name="chID" id="chID" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * FROM chauffeur_list WHERE status = 'Actif'";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();
    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

    foreach ($result2 as $row) { ?>
        <option value="<?php echo htmlentities($row->chID); ?>">
            <?php echo htmlentities($row->permis) . ' ' . htmlentities($row->nom); ?>
        </option>
        <?php } ?>
     </select></div> 
     <div class="form-group">
         <label for="permis">N° de permis<span style="font-size:11px;color:red">*</span></label> <input type="text" name="permis" id="permis" value="" class="form-control" required 
        placeholder="Ex: Aabcdfg" required readonly> 
</div>                               
    <div class="form-group">
         <label for="nom">Nom<span style="font-size:11px;color:red">*</span></label> <input type="text" name="nom" id="nom" value="" class="form-control" required 
        placeholder="Ex: Aabcdfg" required readonly> 
</div>
<div class="form-group">
         <label for="prenom">Prénoms<span style="font-size:11px;color:red">*</span></label> <input type="text" name="prenom" id="prenom" value="" class="form-control" required 
        placeholder="Ex: ABCDF" required readonly> 
</div>
<div class="form-group">
         <label for="model">Sexe<span style="font-size:11px;color:red">*</span></label> <input type="text" name="sexe" id="sexe" value="" class="form-control" required 
        placeholder="M/F" required readonly> 
</div> 
<div class="form-group">
         <label for="DateN">Date de naissance<span style="font-size:11px;color:red">*</span></label> <input type="date" name="dateN" id="dateN" value="" class="form-control" required 
        placeholder="JJ/MM/AA" required readonly> 
</div>

</div>
</div>
<p style="margin: 0 auto; width: 100px;">
    <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Enregistrer</button>
</p>
<script>
        function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }

        window.onload = function () {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    
    var dateInput = document.getElementById('dte');
    if (dateInput) {
        dateInput.value = today;
    }
};


        function validatePhone(input) {
            if (!input.validity.valid) {
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        }
       
document.getElementById('serie').addEventListener('input', function () {
    var serie = this.value;
    if (serie.length !== 17) {
        this.setCustomValidity('Le N° doit comporter exactement 17 caractères.');
    } else {
        this.setCustomValidity('');
    }
});



    </script>
</form>

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