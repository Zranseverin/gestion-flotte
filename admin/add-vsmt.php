<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $ID = $_POST['ID'];
        $aID = $_POST['aID'];
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $genres = $_POST['genres'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateN = $_POST['dateN'];
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

        $sql = "INSERT INTO vsmt_list(aID,ID,imt, genres, permis, marque, model, nom, prenom, date, jour,versement, pointage, recette, total_v, total_r, total_p, total, ob,dateN,versements,recet) 
                VALUES (:aID,:ID,:imt, :genres, :permis,:marque,:model, :nom, :prenom, :date,:jour,:versement, :pointage, :recette, :total_v, :total_r, :total_p, :total,:ob,:versements,:recet,:dateN)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':aID', $aID, PDO::PARAM_STR);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genres', $genres, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':dateN', $dateN, PDO::PARAM_STR);
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
            echo '<script>alert("Versement enregistré.")</script>';
            echo "<script>window.location.href ='add-vsmt.php'</script>";
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
    <link rel="stylesheet" href="forme.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <script>


   function getvr(val) {
       $.ajax({
           type: "POST",
           url: "get_vr.php",
           data: 'ID=' + val,
           success: function(data) {
               $("#aID").html(data);
           }
       });
   }
   
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

                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
 $(document).ready(function(){
    $('#ID').change(function(){
        var ID = $(this).val();
        if(ID){
            $.ajax({
                type: 'POST',
                url: 'get_vrs.php',
                data: {ID: ID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#imt').val(data.imt);
                    $('#marque').val(data.marque);
                    $('#model').val(data.model);

                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
 $(document).ready(function(){
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
                    $('#dateN').val(data.dateN);
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });

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
        recetteInput.value = recet ? recet+ " " : "";

        // Calcul des versements
        const versement = versements[vehicule][jour];
        versementInput.value = versement ? versement + " " : "";
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

                                    //autre fonction//
                                                   

                                    
   </script>
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            margin-bottom: 10px;
        }
      
        /* Global container */


/* Left section */



/* Centre section */
.centre {
    flex: 1;
    min-width: 280px;
}

/* Right section */

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
   
</head>

<body>
<div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enregistrement des versements</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="post" name="vehicule_form" enctype="multipart/form-data">
                                <div class="container">
                                    <!-- Left Section -->
                                    <div class="left">

                               
                                <div class="form-group">
                                                       <label>Véhicule</label>
                                                       <select class="form-control" name="ID" id="ID" onChange="getvr(this.value);" required>
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
                                    <input type="text" name="imt" id="imt" class="form-control" required readonly>
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
                                    <label for="genres">Genre</label>
                                    <select name="genres" id="genres" class="form-control" required>
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
                                <h4>Informations</h4>
                                <div class="form-group">
                                    <label for="total_v">Total Versement</label>
                                    <input type="text" id="total_v" name="total_v" class="form-control" readonly>
                                </div>
                                </div>
                               

                               <!-- Center Section -->
                               <div class="centre">                     
                                <div class="form-group">
    <label> chauffeur</label>
    <select class="form-control" name="aID" id="aID" required>
        <option value="">Sélectionnez le chauffeur</option>
        <!-- Options seront chargées via AJAX -->
    </select>
</div>
<div class="form-group">
                                    <label for="nom">N° de permis</label>
                                    <input type="text" name="permis" id="permis" class="form-control" required readonly>
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
                                    <label for="date">Date de naissance</label>
                                    <input type="date" name="dateN" id="dateN" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" class="form-control">
                                </div>
                                <h4>Informations</h4>
                                <div class="form-group">
                                    <label for="total_r">Total Recette</label>
                                    <input type="text" id="total_r" name="total_r" class="form-control" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Enregistrer</button>
                                </div>
                                <div class="form-section">
                                <div class="centre">                             
                               
                                <div class="form-group">
                                    <label for="date">Date de Versement</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
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
                                    <label for="versements">versement prévu:</label>
                                    <input type="text" id="versements" name="versements" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recet">Recette prévue:</label>
                                    <input type="text" id="recet" name="recet" class="form-control" readonly>
                                </div>
                                <h4>Information</h4>
                                <div class="form-group">
                                    <label for="total">Total Global</label>
                                    <input type="text" id="total" name="total" class="form-control" readonly>
                                </div>
                                </div>
                               
                              
                               <div class="right">
                               
                               
                               
                               

                                <p style="margin: 0 auto; width: 100px;">
    <div> </div>
    </p>
</div>
<script>
     function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }
</script>
                             
                                </div>
                               
                                <div class="form-section">
                                <div class="right">
                                
                               
                                

                               

                               

                              
                                
                                
                     </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       </div>
                            <a href="manage-vst.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Voir versements
</a>
                       <!-- End Form Elements -->
                   </div>
               </div>
           </div>
           <!-- end page-wrapper -->
       </div>
       <!-- end wrapper -->
   
       <!-- Core Scripts -->
       <script src="assets/plugins/jquery-1.10.2.js"></script>
       <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
       <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
       <script src="assets/plugins/pace/pace.js"></script>
       <script src="assets/scripts/siminta.js"></script>
   
       <script>
           window.onload = function () {
               var today = new Date();
               var dd = String(today.getDate()).padStart(2, '0');
               var mm = String(today.getMonth() + 1).padStart(2, '0');
               var yyyy = today.getFullYear();
               today = yyyy + '-' + mm + '-' + dd;
   
               var dateInput = document.getElementById('date');
               if (dateInput) {
                   dateInput.value = today;
               }
           };
          

document.getElementById('renum').addEventListener('input', function (e) {
    var value = e.target.value.replace(/\D/g, ''); // Supprime tout sauf les chiffres
    var amount = parseFloat(value) / 100; // Divise par 100 pour gérer les décimales
    
    if (!isNaN(amount)) {
        e.target.value = amount.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } else {
        e.target.value = '0,00';
    }
});
document.getElementById('tel').addEventListener('input', function (e) {
    var value = e.target.value.replace(/\D/g, ''); // Supprime tout sauf les chiffres
    var formattedValue = '';
    
    if (value.length > 0) formattedValue = value.substring(0, 2);
    if (value.length > 2) formattedValue += '-' + value.substring(2, 4);
    if (value.length > 4) formattedValue += '-' + value.substring(4, 6);
    if (value.length > 6) formattedValue += '-' + value.substring(6, 8);
    if (value.length > 8) formattedValue += '-' + value.substring(8, 10);
   
    
    e.target.value = formattedValue;
});

       </script>
   </body>
   </html>
   


<?php }  ?>