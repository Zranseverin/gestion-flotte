<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $bpmsaid=$_SESSION['bpmsaid'];
    $pID=$_POST['pID'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $imt=$_POST['imt'];
    $marque=$_POST['marque'];
    $genre=$_POST['genre'];
    $renum=$_POST['renum'];
    $date=$_POST['date'];
    $dure=$_POST['dure'];
    $vehicule_id=$_POST['vehicule_id'];

    $passnum = mt_rand(100000000, 999999999);
    
    
    // Gestion de la photo
    $photo = $_FILES["photo"]["name"];
    $extension = substr($photo, strlen($photo) - 4, strlen($photo));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Format de photo invalide. Seuls les formats jpg/jpeg/png/gif sont autorisés.');</script>";
    } else {
        // Téléchargement de la photo
        $photo = md5($photo) . time() . $extension;
        move_uploaded_file($_FILES["photo"]["tmp_name"], "images/" . $photo);
        // Requête SQL
        $sql = "INSERT INTO cnt_list(PassNumber, nom, prenom, imt, date, pID, vehicule_id, photo, genre, dure, renum, marque)
        VALUES (:passnum, :nom, :prenom, :imt, :date, :pID, :vehicule_id, :photo, :genre, :dure, :renum, :marque)";

   
   $query=$dbh->prepare($sql);
   $query->bindParam(':passnum', $passnum, PDO::PARAM_STR);
      $query->bindParam(':nom', $nom, PDO::PARAM_STR);
      $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $query->bindParam(':imt', $imt, PDO::PARAM_STR); 
      $query->bindParam(':date', $date, PDO::PARAM_STR);
      $query->bindParam(':pID', $pID, PDO::PARAM_STR);
      $query->bindParam(':vehicule_id', $vehicule_id, PDO::PARAM_STR);
      $query->bindParam(':photo', $photo, PDO::PARAM_STR);
      $query->bindParam(':genre', $genre, PDO::PARAM_STR);
      $query->bindParam(':dure', $dure, PDO::PARAM_STR);
      $query->bindParam(':renum', $renum, PDO::PARAM_STR);
      $query->bindParam(':marque', $marque, PDO::PARAM_STR);
   // Assurez-vous que vous définissez correctement les autres variables
   
    $query->execute();
   
      $LastInsertId=$dbh->lastInsertId();
      if ($LastInsertId>0) {
       echo '<script>alert("Subject allocation has been done.")</script>';
   echo "<script>window.location.href ='subject-allocation.php'</script>";
     }
     else
       {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
  }
   ?><!DOCTYPE html>
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
   </head>
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
   function getcnt(val) {
       $.ajax({
           type: "POST",
           url: "get-cnt.php",
           data: 'pID=' + val,
           success: function(data) {
               $("#vehicule_id").html(data);
           }
       });
   }
   
   $(document).ready(function(){
    $('#pID').change(function(){
        var pID = $(this).val();
        if(pID){
            $.ajax({
                type: 'POST',
                url: 'get-cnt.php',
                data: {pID: pID},
                success: function(response){
                    // Convertir la réponse JSON
                    var data = JSON.parse(response);
                    // Remplir les champs nom et prénom
                    $('#nom').val(data.nom);
                    $('#prenom').val(data.prenom);
                },
                error: function(){
                    alert('Erreur lors de la récupération des données.');
                }
            });
        }
    });
});

   </script>
   
   <body>
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
                       <h1 class="page-header">Enregistrement du véhicule</h1>
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
                                               <div class="basic-form m-t-20">
                                                   <div class="form-group">
                                                       <label>Course</label>
                                                       <select class="form-control" name="pID" id="pID" onChange="getcnt(this.value);" required>
                                                           <option value="">Sélectionnez une course</option>
                                                           <?php
                                                           $sql = "SELECT * from pr_list";
                                                           $query = $dbh->prepare($sql);
                                                           $query->execute();
                                                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                           if($query->rowCount() > 0) {
                                                               foreach($results as $row) { ?>
                                                                   <option value="<?php echo htmlentities($row->pID);?>">
                                                                       <?php echo htmlentities($row->nom); ?> | <?php echo htmlentities($row->prenom); ?>
                                                                   </option>
                                                           <?php }} ?>
                                                       </select>
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Nom<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="nom" id="nom" class="form-control" required placeholder="Entrez le nom">
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Prénom<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="prenom" id="prenom" class="form-control" required placeholder="Entrez le prénom">
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Véhicule</label>
                                                       <select class="form-control" name="vehicule_id" id="vehicule_id" required>
                                                           <!-- Options seront chargées via AJAX -->
                                                       </select>
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Immatriculation<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="imt" id="imt" class="form-control" required placeholder="Entrez l'immatriculation">
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Marque<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="marque" id="marque" class="form-control" required placeholder="Entrez la marque">
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Genre<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="genre" id="genre" class="form-control" required placeholder="Entrez le genre">
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Durée<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="text" name="dure" id="dure" class="form-control" required placeholder="Entrez la durée">
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Date<span style="font-size:11px;color:red">*</span></label>
                                                       <input type="date" name="date" id="date" class="form-control" required>
                                                   </div>
   
                                                   <div class="form-group">
                                                       <label>Photo d'identité<span style="font-size:11px;color:red"> (formats acceptés: jpg/png)</span></label>
                                                       <input type="file" name="photo" class="form-control" required>
                                                   </div>
   
                                                   <button type="submit" class="btn btn-primary" name="submit" onclick="return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');">Enregistrer</button>
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
       </script>
   </body>
   </html>
   
<?php }  ?>