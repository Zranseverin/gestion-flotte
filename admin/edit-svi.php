<?php
session_start();
include('includes/dbconnection.php');

// Check if session exists
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data
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
        $eid = $_GET['editid'];  // Get the record's ID from the URL

        // Update query
        $sql = "UPDATE svi_list SET 
                imt = :imt, 
                marque = :marque, 
                model = :model,  
                permis = :permis, 
                nom = :nom, 
                prenom = :prenom, 
                date = :date, 
                hd = :hd, 
                ha= :ha, 
                tth = :tth, 
                dkm = :dkm, 
                akm = :akm,
                totkm = :totkm, 
                ob = :ob,
                ID = :ID,
                aID = :aID 
                WHERE kID = :eid";

        $query = $dbh->prepare($sql);

        // Bind parameters
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
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        // Execute query
        $query->execute();

        // Provide user feedback and redirect
        echo '<script>alert("Information modifié successfully.")</script>';
        echo "<script>window.location.href ='manage-svi.php'</script>";
    }

    
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion flottes soumafe | Edit  suivi </title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <link rel="stylesheet" href="forme.css">
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                               


</head>

<body>
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
                                    <?php
$eid=$_GET['editid'];
$sql="SELECT * from  svi_list where kID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  <div class="form-group">
                                    <label for="imt">immatriculation</label>
                                    <select name="imt" id="imt" class="form-control" required>
                                        
      <option value="<?php  echo $row->imt;?>"><?php  echo $row->imt;?></option>
<?php 

$sql2 = "SELECT * from   attr_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->imt);?>"><?php echo htmlentities($row2->imt);?></option>
 <?php } ?>
     </select></div>
    
     <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" value="<?php  echo $row->marque;?>" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" value="<?php  echo $row->model;?>" class="form-control" required readonly>
                                </div>
                                 <h2>kmmmm</h2>
                                 <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" value="<?php  echo $row->ob;?>" class="form-control" >
                                </div>
                                <!-- Champ Genre -->
                                <div class="form-group">
                                    <label for="totkm">Kilométrage parcouru</label>
                                    <input type="text" id="totkm" name="totkm" class="form-control" value="<?php  echo $row->totkm;?>" readonly>
                                </div>

                                </div>

                                    <!-- Center Section -->
                                    <div class="centre">
                                        
                                    <div class="form-group">
                                    <label for="permis">permis</label>
                                    <select name="permis" id="permis "  class="form-control"  required>
                                      
      <option value="<?php  echo $row->permis;?>"><?php  echo $row->permis;?></option>
<?php 

$sql2 = "SELECT * from   attr_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->permis);?>"><?php echo htmlentities($row2->permis);?></option>
 <?php } ?>
     </select></div>
     <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" value="<?php  echo $row->nom;?>" required readonly>
                                </div>

                                <!-- Champ Prénom -->
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" value="<?php  echo $row->prenom;?>" required readonly >
                                </div>
                                <h2>kmmmm</h2>

                                <div class="form-group">
                                    <label for="tth">Durée</label>
                                    <input type="text" id="tth" name="tth" class="form-control" value="<?php  echo $row->tth;?>" readonly>
                                </div>
                                
                                <div class="form-group"> <button type="submit" class="btn btn-primary"  onclick="return confirmSubmission();" name="submit" id="submit">Modifier</button></div>
                               
                                <!-- Champ Téléphone -->
                               
                                <!-- Champ Date -->
                                </div>
                               
                              
                               <div class="right">
                                <div class="form-group">
                                    <label for="date">Date </label>
                                    <input type="date" name="date" id="date" class="form-control" value="<?php  echo $row->date;?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="hd">Heure de départ</label>
                                    <input type="time" id="hd" name="hd" class="form-control" value="<?php  echo $row->hd;?>" oninput="calculerResultats();">
                                </div>

                                <!-- Champ Heure d'arrivée -->
                                <div class="form-group">
                                    <label for="ha">Heure d'arrivée</label>
                                    <input type="time" id="ha" name="ha" class="form-control" value="<?php  echo $row->ha;?>" oninput="calculerResultats();">
                                </div>
                                <h2>kmmmm</h2>
                                
                                <!-- Champ Km de départ -->
                                <div class="form-group">
                                    <label for="dkm">Km départ</label>
                                    <input type="number" id="dkm" name="dkm" class="form-control" value="<?php  echo $row->dkm;?>" oninput="calculerResultats();">
                                </div>

                                <!-- Champ Km d'arrivée -->
                                <div class="form-group">
                                    <label for="akm">Km d'arrivée</label>
                                    <input type="number" id="akm" name="akm" class="form-control" value="<?php  echo $row->akm;?>" oninput="calculerResultats();">
                                </div>
                                <label for="ID">ID</label>
    <input type="text" id="ID" name="ID" class="form-control" value="<?php echo $row->ID;?>">
</div>
<div class="form-group" style="display: none;">
    <label for="aID">aID</label>
    <input type="text" id="aID" name="aID" class="form-control" value="<?php echo $row->aID;?>">
</div>

                                <!-- Champ pour la durée calculée -->
                               

                                <!-- Champ pour la distance parcourue calculée -->
                               
                                <!-- Champ Observation -->
                               

<?php $cnt=$cnt+1;}} ?> 
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
<script>
     function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }
</script>
    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
<?php }  ?>