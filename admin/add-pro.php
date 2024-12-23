<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
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
        $dte = $_POST['dte']; // Correction de la variable $dte au lieu de $tel pour la date
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
            $sql = "INSERT INTO pr_list(PassNumber, nom, prenom, sexe, dteN, adres, tel, cni, dte, ft, ncpt, photo, email,cel)
                    VALUES (:passnum, :nom, :prenom, :sexe, :dteN, :adres, :tel, :cni, :dte, :ft, :ncpt, :photo, :email,:cel)";

            $query = $dbh->prepare($sql);
            $query->bindParam(':passnum', $passnum, PDO::PARAM_STR);
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
            $query->bindParam(':cel', $cel, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':photo', $photo, PDO::PARAM_STR);

            // Exécution de la requête
            $query->execute();

            // Vérification de l'insertion
            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Propriétaire ajouté avec succès.")</script>';
                echo "<script>window.location.href ='add-pro.php'</script>";
            } else {
                echo '<script>alert("Une erreur est survenue. Veuillez réessayer.")</script>';
            }
        }
    }

?>


<!DOCTYPE html>
<html>

<head>
    
    <title>gestion  des flottes soumafe | Ajouter propritaire</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <link rel="stylesheet" href="forme.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

      



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
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><span style="font-size:11px;color:red"></span>Enregistrement du propriétaire de véhicule<span style="font-size:11px;color:red"></h1>
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
                                    <form method="post"enctype="multipart/form-data"> 
                                    <div class="container">
            <div class="form-section">
                <div class="left">
                                    
    <div class="form-group"> <label for="nom">Nom <span style="font-size:11px;color:red">*</span></label> <input type="text" name="nom" value="" class="form-control" required='true' placeholder="Entrez Nom du propritaire"> </div>
    <div class="form-group"> <label for="prenom">Prenoms<span style="font-size:11px;color:red">*</label> <input type="text" name="prenom" value="" class="form-control" required='true' placeholder="Entrez prenoms du propritaire"> </div>
    <div class="form-group"> <label for="sexe">Sexe<span style="font-size:11px;color:red">*</label><select type="text" name="sexe" value="" class="form-control" required='true'>
<option value="">selectionnez le sexe</option>
<option value="M">M</option>
<option value="F">F</option>
     </select></div>
     
     
     <div class="form-group"> <label for="dateN">date de naissance<span style="font-size:11px;color:red">*</label> <input type="date" name="dteN" value="" class="form-control" required='true' required placeholder="Entrez la date" max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>"> </div>
     <div class="form-group"> <label for="adres">Domicile<span style="font-size:11px;color:red">*</label> <input type="text" name="adres" value="" class="form-control" required='true' placeholder="Entrez Adresse du propritaire"> </div>
     <div class="form-group"> <label for="cel">Cellulaire:<span style="font-size:11px;color:red">*</label> <input type="tel" name="cel" value=""  class="form-control"  placeholder="0X-XX-XX-XX-XX"
       pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
       title="Le N° doit comporter exactement 14 caractères au format 0X-XX-XX-XX-XX" maxlength="17" required>
    </div>
     <div class="form-group"> <label for="tel">Téléphone<span style="font-size:11px;color:red">*</label> <input type="text" name="tel" value="" class="form-control" placeholder="0X-XX-XX-XX-XX"
       pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
       title="Le N° doit comporter exactement 14 caractères au format 0X-XX-XX-XX-XX" maxlength="17" required> </div>

     </div>
     <div class="right">
     <div class="form-group"> <label for="exampleInputEmail1">Email</label> <input type="email" name="email" value="" class="form-control" placeholder="exemple@domaine.com" 
        required 
        title="Veuillez entrer une adresse email valide."> </div>
     <div class="form-group"> <label for="exampleInputEmail1">N°cni/Attestation<span style="font-size:11px;color:red">*</label> <input type="text" name="cni" value="" class="form-control" required='true'placeholder="Entrez le numero CNIdu propritaire"> </div>
     <div class="form-group"> <label for="exampleInputEmail1">N° de compte Bancaire</label> <input type="text" name="ncpt" value="" class="form-control" required='true' placeholder="Entrez Numero de compte Bancaire du propritaire"> </div>
     <div class="form-group"> <label for="exampleInputEmail1">Fonction</label> <input type="text" name="ft" value="" class="form-control" placeholder="Entrez la fonction du propritaire" > </div>
     <div class="form-group"> <label for="exampleInputEmail1"><span style="font-size:11px;color:red">*date signature</label> <input type="date" name="dte" id="dte" class="form-control" required='true'>
    </div>
    <div class="form-group"> <label for="exampleInputEmail1">photo Identité<span style="font-size:11px;color:red"> format jpg/png* </label> <input type="file" name="photo" value="" class="form-control" required='true' placeholder="Entrez la photo d'identité(format png,jpg)"> </div>
    <div class="form-group"> <label for="exampleInputEmail1">photocopie de cni</label> <input type="file" name="fichier" value="" class="form-control" placeholder="Entrez photocopie de cni (format pdf)"> </div>
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