<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $dteN = $_POST['dteN'];
    $cni = $_POST['cni'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];
    $ncpt = $_POST['ncpt'];
    $ft = $_POST['ft'];
    $cel = $_POST['cel'];
    $dte = $_POST['dte'];
$eid=$_GET['editid'];
$sql="update pr_list set nom=:nom,prenom=:prenom,sexe=:sexe,dteN=:dteN,adres=:adres,ncpt=:ncpt,cni=:cni,tel=:tel,ft=:ft,email=:email,dte=:dte where pID=:eid";
$query=$dbh->prepare($sql);

$query->bindParam(':nom', $nom, PDO::PARAM_STR);
            $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $query->bindParam(':dteN', $dteN, PDO::PARAM_STR);
            $query->bindParam(':adres', $adres, PDO::PARAM_STR);
            $query->bindParam(':tel', $tel, PDO::PARAM_STR);
            $query->bindParam(':ncpt', $ncpt, PDO::PARAM_STR);
            $query->bindParam(':cni', $cni, PDO::PARAM_STR);
            $query->bindParam(':dte', $dte, PDO::PARAM_STR);
            $query->bindParam(':ft', $ft, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();

  
         echo '<script>alert("Proprietaire modifié")</script>';
         echo '<script>window.location.href ="manage-pro.php"</script>';

  

}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flotte soumafe | Edit propritaire</title>
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
         
          border: 1px solid #90EE90;
          border-radius: 4px;
          text-transform: uppercase;
      }
      
      input[type="text"]:focus {
          border-color: red;;
          box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
          text-transform: uppercase;
      }
      
      small {
          color: red;
          font-size: 12px;
      }
      </style>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/footer.php');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Edit proprietaire</h1>
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
           
                                    <?php
$eid=$_GET['editid'];
$sql="SELECT * from  pr_list where pID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  <p colspan="6" style="font-size:20px;color:blue;text-align: center;">
  ID: <?php  echo ($row->PassNumber);?></p>
  <div class="form-section">
  <div class="left">
 
    <div class="form-group"> <label for="exampleInputEmail1">Nom</label> <input type="text" name="nom" value="<?php  echo $row->nom;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Prenom</label> <input type="text" name="prenom" value="<?php  echo $row->prenom;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Sexe</label><select type="text" name="sexe" value="" class="form-control" required='true'>
<option value="<?php  echo $row->sexe;?>"><?php  echo $row->sexe;?></option>
<option value="M">M</option>
<option value="F">F</option>
     </select></div>
    <div class="form-group"> <label for="exampleInputEmail1">Date de naissance</label> <input type="date" name="dteN" value="<?php  echo $row->dteN;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Adresse</label> <input type="text" name="adres" value="<?php  echo $row->adres;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Cel:</label> <input type="texe" name="cel" value="<?php  echo $row->cel;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Tel:</label> <input type="texe" name="tel" value="<?php  echo $row->tel;?>" class="form-control" required='true'> </div>
    </div>
    <div class="right">
    <div class="form-group"> <label for="exampleInputEmail1">Numero de compte</label> <input type="text" name="ncpt" value="<?php  echo $row->ncpt;?>" class="form-control" required='true' > </div>
    <div class="form-group"> <label for="exampleInputEmail1">N° cni</label> <input type="text" name="cni" value="<?php  echo $row->cni;?>" class="form-control" required='true'> </div>



    
    <div class="form-group"> <label for="exampleInputEmail1">Email</label> <input type="text" name="email" value="<?php  echo $row->email;?>"  class="form-control" placeholder="exemple@domaine.com"> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Fonction</label> <input type="text" name="ft" value="<?php  echo $row->ft;?>" class="form-control" required='true'> </div>
    
    <div class="form-group"> <label for="exampleInputEmail1">date signature</label> <input type="date" name="dte" value="<?php  echo $row->dte;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Photo</label> <img src="images/<?php echo $row->Photo;?>" width="50" height="50" value="<?php  echo $row->photo;?>">
<a href="changePhoto.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit photo</a> </div>
<div class="form-group"> <label for="exampleInputEmail1">Date d'ENREGISTREMENT</label> <input type="text" value="<?php  echo $row->PasscreationDate;?>" class="form-control" readonly='true'> </div>
<?php $cnt=$cnt+1;}} ?> 
<p style="margin: 0 auto; width: 100px;">
    <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Enregistrer</button>
</p>

<script>
        function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir modifier ces informations ?');
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

function validateForm() {
    const input = document.getElementById('cel');
    const errorMessage = document.getElementById('error-message');

    // Regex pour valider le format 0X-XX-XX-XX-XX
    const regex = /^[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}$/;

    // Vérification du format
    if (!regex.test(input.value)) {
        errorMessage.textContent = "Veuillez entrer un numéro valide au format 0X-XX-XX-XX-XX.";
        errorMessage.style.display = "block";
    } else {
        errorMessage.style.display = "none";
        alert("Numéro valide !");
        // Vous pouvez ici soumettre le formulaire si nécessaire
        // document.forms[0].submit(); // Décommentez pour soumettre le formulaire
    }
}
    </script>


    </div>
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

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
<?php }  ?>