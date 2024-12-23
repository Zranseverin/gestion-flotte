php
Copier le code
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
        $genre = $_POST['genre'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
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

        $passnum = mt_rand(100000000, 999999999);

        // Gestion de la photo
        $photo = $_FILES["photo"]["name"];
        $extension = substr($photo, strlen($photo) - 4, strlen($photo));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('photo existant. format invalid allowed');</script>";
        } else {
            $photo = md5($photo) . time() . $extension;
            move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $photo);

            // Requête SQL
            $sql = "INSERT INTO vsmt_list(aID,ID,imt, genre, permis, marque, model, nom, prenom, date, jour,versement, pointage, recette, total_v, total_r, total_p, total, ob, sexe,dateN,versements,recet) 
            VALUES (:aID,:ID,:imt, :genre, :permis,:marque,:model, :nom, :prenom, :date,:jour,:versement, :pointage, :recette, :total_v, :total_r, :total_p, :total,:ob,:versements,:recet,:sexe,:dateN)";

            $query = $dbh->prepare($sql);
            $query->bindParam(':passnum', $passnum, PDO::PARAM_STR);
            $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':aID', $aID, PDO::PARAM_STR);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genre', $genre, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
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

            try {
                $query->execute();
                $LastInsertId = $dbh->lastInsertId();
                if ($LastInsertId > 0) {
                    echo '<script>alert("chauffeur enregistré.")</script>';
                    echo "<script>window.location.href ='add-cont.php'</script>";
                } else {
                    echo '<script>alert("Something Went Wrong. Please try again")</script>';
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>
   <!DOCTYPE html>
   <html>
   <head>
       <title>Gestion des flottes soumafe | Enregistrement du véhicule</title>
       <!-- Core CSS - Include with every page -->
       <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
       <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
       <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
       <link href="assets/css/style.css" rel="stylesheet" />
       <link href="assets/css/main-style.css" rel="stylesheet" />
       <link rel="stylesheet" href="forme.css">
       <link rel="stylesheet" href="forme.css">
   </head>
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });

   </script>
   
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
   border-color: red;;
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
       <div id="wrapper">
           <!-- navbar top -->
           <?php include_once('includes/header.php'); ?>
           <!-- end navbar top -->
   
           <!-- navbar side -->
           <?php include_once('includes/sidebar.php'); ?>
           <!-- end navbar side -->
   
           <!-- page-wrapper -->
           <div id="page-wrapper">
               <div class="row">
                   <!-- page header -->
                   <div class="col-lg-12">
                       <h1 class="page-header">Enregistrement des contrats des véhicules</h1>
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
                                       <div class="container">
                                           <form method="post" name="vehicule_form" enctype="multipart/form-data">
                                           <div class="container">
                                        <div class="form-section">
                                              <div class="left">
                                                   <div class="form-group">
                                                       <label>Nom & prenoms proprietaire</label>
                                                       <select class="form-control" name="ID" id="ID" onChange="getvr(this.value);" required>
                                                           <option value="">Sélectionnez proprietaire du véhicule</option>
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
                                                       <label>imt<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="imt" id="imt" class="form-control" required placeholder="Entrez le nom" required readonly>
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>model<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="model" id="model" class="form-control" required placeholder="Entrez le prénom" required readonly>
                                                   </div>
                                                  
                                                  
                                                   <div class="form-group">
    <label>Rémunération<span style="font-size:11px;color:red">*</span></label>
    <input type="text" name="renum" id="renum" class="form-control" required placeholder="Entrez la rémunération">
    <small id="renumError"></small>
</div>

                                                   <H1><span style=" font-size:11px;color:red">Informations concerant la signation du contrat</span></H1>
                                                   <div class="form-group">
                                                       <label>Date de signature contrat<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="date" name="date" id="date" class="form-control" required>
                                                   </div>
                                                   <div class="form-group">
                                                       <label>Nom & prenoms de temoin<span style="font-size:11px;color:red" >*</span></label>
                                                       <input type="text" name="tm" id="tm" class="form-control" required placeholder="Entrez le nom et prenom" required>
                                                   </div>
                                                   <div class="form-group">
                                                       <label>Fichier de contrat<span style="font-size:11px;color:red"> (formats acceptés en un fichier: pdf)</span></label>
                                                       <input type="file" name="photo" class="form-control" required>
                                                   </div>
                                                   </div>
                                                   <div class="right">
                                                   <div class="form-group">
    <label> Véhicule</label>
    <select class="form-control" name="aID" id="aID" required>
        <option value="">Sélectionnez un véhicule</option>
        <!-- Options seront chargées via AJAX -->
    </select>
</div>

<div class="form-group">
    <label>permis<span style="font-size:11px;color:red">*</span></label>
    <input type="text" name="permis" id="permis" class="form-control" required placeholder="Entrez le N° de permis"required readonly>
</div>

<div class="form-group">
    <label>Nom<span style="font-size:11px;color:red">*</span></label>
    <input type="text" name="nom" id="nom" class="form-control" required placeholder="Entrez le nom"required readonly>
</div>

<div class="form-group">
    <label>Prénom<span style="font-size:11px;color:red">*</span></label>
    <input type="text" name="prenom" id="prenom" class="form-control" required placeholder="Entrez le prenom"required readonly>
</div>
<H1><span style=" font-size:11px;color:red">Informations concerant la signation du contrat</span></H1>

   
                                                   <div class="form-group">
                                                       <label>Durée de contrat<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="dure" id="dure" class="form-control" required placeholder="Entrez la durée du contrat" required>
                                                     </div>
                                                     <div class="form-group">
    <label>Téléphone <span style="font-size:11px;color:red">facultatif</span></label>
    <input type="text" name="tel" id="tel" class="form-control" placeholder="0X-XX-XX-XX-XX"
       pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
       title="Le N° doit comporter exactement 14 caractères au format 0X-XX-XX-XX-XX" maxlength="17">

           
</div>

                                                   <div class="form-group">
                                                       <label>N° de CNI/temoin<span style="font-size:11px;color:red">facultatif</span></label>
                                                       <input type="text" name="cni" id="cni" class="form-control" required placeholder="Entrez le numero de la carte d'Identié" required>
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
</script>
                                               </div>
                                           </form>
                                       </div>
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