<?php
session_start();
include('includes/dbconnection.php');

// Check if session exists
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data safely
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $genres = $_POST['genres'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $dateN = $_POST['dateN'];
        $prenom = $_POST['prenom'];
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
        $recet = $_POST['recet'];
        $versements = $_POST['versements'];

        // Get the IDs
        $ID = $_POST['ID'];
        $aID = $_POST['aID'];
        $eid = $_GET['editid']; // Ensure this is passed securely

        // Update query
        $sql = "UPDATE vsmt_list SET 
                imt = :imt, 
                marque = :marque, 
                model = :model, 
                genres = :genres, 
                permis = :permis, 
                nom = :nom, 
                prenom = :prenom, 
                dateN = :dateN, 
                date = :date, 
                versement = :versement, 
                pointage = :pointage, 
                recette = :recette,
                total_v = :total_v,
                total_p = :total_p,
                total_r = :total_r,
                total = :total,
                jour = :jour,
                ob = :ob,
                versements = :versements,
                recet = :recet,
                ID = :ID,
                aID = :aID
                WHERE vID = :eid";

        $query = $dbh->prepare($sql);

        // Bind parameters
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genres', $genres, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':dateN', $dateN, PDO::PARAM_STR);
        $query->bindParam(':versement', $versement, PDO::PARAM_STR);
        $query->bindParam(':pointage', $pointage, PDO::PARAM_STR);
        $query->bindParam(':recette', $recette, PDO::PARAM_STR);
        $query->bindParam(':total_v', $total_v, PDO::PARAM_STR);
        $query->bindParam(':total_p', $total_p, PDO::PARAM_STR);
        $query->bindParam(':total_r', $total_r, PDO::PARAM_STR);
        $query->bindParam(':total', $total, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);
        $query->bindParam(':jour', $jour, PDO::PARAM_STR);
        $query->bindParam(':versements', $versements, PDO::PARAM_STR);
        $query->bindParam(':recet', $recet, PDO::PARAM_STR);
        $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':aID', $aID, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        // Execute the query and handle any errors
        try {
            $query->execute();
            echo '<script>alert("Information modifiée avec succès.")</script>';
            echo "<script>window.location.href ='manage-vst.php'</script>";
        } catch (PDOException $e) {
            echo '<script>alert("Erreur lors de la modification : ' . $e->getMessage() . '")</script>';
        }
    }

?>



<!DOCTYPE html>
<html>

<head>
    
    <title>gestion flottes soumafe | Edit  versement</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                        
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
                                </script>
                                <script>
    
$(document).ready(function(){
    $('#aID').change(function(){
        var aID = $(this).val();
        if (aID) {
            $.ajax({
                type: 'POST',
                url: 'get_vsment.php',
                data: {aID: aID},
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#permis').val(data.permis);
                    $('#prenom').val(data.prenom);
                    $('#nom').val(data.nom);
                    $('#dateN').val(data.dateN);

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
<script>
    
$(document).ready(function(){
    $('#ID').change(function(){
        var ID = $(this).val();
        if (ID) {
            $.ajax({
                type: 'POST',
                url: 'get_vestvh.php',
                data: {ID: ID},
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#imt').val(data.imt);
                    $('#marque').val(data.marque);
                    $('#model').val(data.model);
                   

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


    <!--  wrapper -->
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modification des versements</h1>
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
$sql="SELECT * from  vsmt_list where vID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  
  <div class="form-group">
    <label for="exampleInputEmail1">véhicule <span style="font-size:11px;color:red">*</span></label>
    <select name="ID" id="ID" class="form-control" required>
       
        <option value="<?php echo $row->ID; ?>"><?php echo $row->imt; ?></option>
        <?php 
        $sql2 = "SELECT * FROM vh_list";
        $query2 = $dbh->prepare($sql2);
        $query2->execute();
        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

        foreach ($result2 as $owner) { // Changed $row to $owner
        ?>
            <option value="<?php echo htmlentities($owner->ID); ?>"><?php echo htmlentities($owner->imt); ?><?php echo $row->marque; ?></option>
        <?php } ?>
    </select>
</div>
    <div class="form-group">
                                    <label for="imt">Immatriculation</label>
                                    <input type="text" name="imt" id="imt" class="form-control" value="<?php  echo $row->imt;?>" required readonly>
                                </div>
     <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" class="form-control" value="<?php  echo $row->marque;?>" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" value="<?php  echo $row->model;?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="genres">Genre</label>
                                    <select name="genres" id="genres" class="form-control" required>
                                    <option value="<?php  echo $row->genres;?>"><?php  echo $row->genres;?></option>
                                        <option value="yango">Yango</option>
                                        <option value="taxi">Taxi</option>
                                    </select>
                                </div>
                                <h4>Informations</h4>
                                <div class="form-group">
                                    <label for="jour">Jour</label>
                                    <select name="jour" id="jour" class="form-control"  required>
                                    <option value="<?php  echo $row->jour;?>"><?php  echo $row->jour;?></option>
                                        <option value="ferie">Férié</option>
                                        <option value="ordinaire">Ordinaire</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="versement">Versement</label>
                                    <input type="text" id="versement" name="versement" class="form-control" value="<?php  echo $row->versement;?>" required maxlength="10" pattern="[0-9]+" oninput="calculerRecetteTotal()">
                                </div>
                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" value="<?php  echo $row->ob;?>" class="form-control">
                                </div>
                                </div>
                               

<!-- Center Section -->
<div class="centre">
    
<div class="form-group">
    <label for="exampleInputEmail1">Chauffeur<span style="font-size:11px;color:red">*</span></label>
    <select name="aID" id="aID" class="form-control" required>
       
        <option value="<?php echo $row->aID; ?>"><?php echo $row->permis; ?></option>
        <?php 
        $sql2 = "SELECT * FROM attr_list";
        $query2 = $dbh->prepare($sql2);
        $query2->execute();
        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

        foreach ($result2 as $owner) { // Changed $row to $owner
        ?>
            <option value="<?php echo htmlentities($owner->aID); ?>"><?php echo htmlentities($owner->permis); ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
                                    <label for="permis">N° de permis</label>
                                    <input type="text" name="permis" id="permis" class="form-control" value="<?php  echo $row->permis;?>" required readonly>
                                </div>
     <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" value="<?php  echo $row->nom;?>" required readonly>
                                </div>

                                <!-- Champ Prénom -->
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" value="<?php  echo $row->prenom;?>" required readonly >
                                </div>
                                <div class="form-group">
                                    <label for="dateN">date naissance</label>
                                    <input type="date" name="dateN" id="dateN" class="form-control" value="<?php  echo $row->dateN;?>" required readonly >
                                </div>
                                <h4>Informations</h4>
                                <div class="form-group">
                                    <label for="date">Date de Versement</label>
                                    <input type="date" name="date" id="date" class="form-control" value="<?php  echo $row->date;?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="pointage">Pointage</label>
                                    <input type="text" id="pointage" name="pointage" class="form-control" value="<?php  echo $row->pointage;?>" required maxlength="10" pattern="[0-9]+" oninput="calculerRecetteTotal()">
                                </div>
                                <button type="submit" class="btn btn-primary"  onclick="return confirmSubmission();" name="submit" id="submit">Modifier</button>
                                </div>
                               
                              
                               <div class="right">
                                <!-- Champ Téléphone -->
                               

                                <div class="form-group">
                                    <label for="recette">Recette</label>
                                    <input type="text" id="recette" name="recette" value="<?php  echo $row->recette;?>" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total_v">Total Versement</label>
                                    <input type="text" id="total_v" name="total_v" class="form-control" value="<?php  echo $row->total_v;?>" readonly>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="versements">versement prévu:</label>
                                    <input type="text" id="versements" name="versements" value="<?php  echo $row->versements;?>" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recet">Recette prévue:</label>
                                    <input type="text" id="recet" name="recet" value="<?php  echo $row->recet;?>" class="form-control" readonly>
                                </div>
                                
                               
                                <div class="form-group">
                                    <label for="total_P">Total POintage</label>
                                    <input type="text" id="total_P" name="total_P" class="form-control" value="<?php  echo $row->total_P;?>" readonly>
                                </div>
                                <h4>Informations</h4>
                              
                                <div class="form-group">
                                    <label for="total_r">Total Recette</label>
                                    <input type="text" id="total_r" name="total_r" class="form-control" value="<?php  echo $row->total_r;?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="total">Total Global</label>
                                    <input type="text" id="total" name="total" class="form-control" value="<?php  echo $row->total;?>" readonly>
                                </div>
                               

                                

<?php $cnt=$cnt+1;}} ?> 
     <p style="padding-left: 450px"></form>
                                </div> </div>
                                
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->
        <script>
     function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }
</script>
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