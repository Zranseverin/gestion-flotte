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
    $dateN = $_POST['dateN'];
    $adresse = $_POST['adresse'];
    $permis = $_POST['permis'];
    $cni = $_POST['cni'];
    $date = $_POST['date'];
    $fin = $_POST['fin'];
    $ms = $_POST['ms'];
    $pp = $_POST['pp'];
    $ent = $_POST['ent'];
    $esp = $_POST['esp'];
    $nm = $_POST['nm'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $ft = $_POST['ft'];
    $rma = $_POST['rma'];
    $telephone1 = $_POST['telephone1'];
    $telephone2 = $_POST['telephone2'];
    
    // Gestion du statut Actif/Inactif
    $status = isset($_POST['status']) ? "Actif" : "Inactif";
    
    $passnum = mt_rand(100000000, 999999999);
    $photo = $_FILES["photo"]["name"];
    $extension = substr($photo, strlen($photo) - 4, strlen($photo));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    
    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Format de la photo invalide. Seuls jpg, png, gif sont autorisés.');</script>";
    } else {
      $photo = md5($photo).time().$extension;
      move_uploaded_file($_FILES["photo"]["tmp_name"], "images/".$photo);
      
      $sql = "INSERT INTO chauffeur_list(status, PassNumber, nom, prenom, sexe, dateN, adresse, permis, cni, date, fin, telephone1, telephone2, photo, fichier, ms, pp, ent, nm, tel, email, ft, rma, esp) 
              VALUES(:status, :passnum, :nom, :prenom, :sexe, :dateN, :adresse, :permis, :cni, :date, :fin, :telephone1, :telephone2, :photo, :fichier, :ms, :pp, :ent, :nm, :tel, :email, :ft, :rma, :esp)";
              
      $query = $dbh->prepare($sql);
      $query->bindParam(':status', $status, PDO::PARAM_STR);
      $query->bindParam(':passnum', $passnum, PDO::PARAM_STR);
      $query->bindParam(':nom', $nom, PDO::PARAM_STR);
      $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
      $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
      $query->bindParam(':dateN', $dateN, PDO::PARAM_STR);
      $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
      $query->bindParam(':permis', $permis, PDO::PARAM_STR);
      $query->bindParam(':cni', $cni, PDO::PARAM_STR);
      $query->bindParam(':date', $date, PDO::PARAM_STR);
      $query->bindParam(':fin', $fin, PDO::PARAM_STR);
      $query->bindParam(':telephone1', $telephone1, PDO::PARAM_STR);
      $query->bindParam(':telephone2', $telephone2, PDO::PARAM_STR);
      $query->bindParam(':photo', $photo, PDO::PARAM_STR);
      $query->bindParam(':fichier', $fichier, PDO::PARAM_STR);
      $query->bindParam(':ms', $ms, PDO::PARAM_STR);
      $query->bindParam(':pp', $pp, PDO::PARAM_STR);
      $query->bindParam(':ent', $ent, PDO::PARAM_STR);
      $query->bindParam(':nm', $nm, PDO::PARAM_STR);
      $query->bindParam(':tel', $tel, PDO::PARAM_STR);
      $query->bindParam(':email', $email, PDO::PARAM_STR);
      $query->bindParam(':ft', $ft, PDO::PARAM_STR);
      $query->bindParam(':rma', $rma, PDO::PARAM_STR);
      $query->bindParam(':esp', $esp, PDO::PARAM_STR);
      
      $query->execute();
      
      $LastInsertId = $dbh->lastInsertId();
      if ($LastInsertId > 0) {
        echo '<script>alert("Chauffeur enregistré.")</script>';
        echo "<script>window.location.href ='add-ch.php'</script>";
      } else {
        echo '<script>alert("Erreur. Veuillez réessayer.")</script>';
      }
    }
  }

?>


<!DOCTYPE html>
<html>

<head>
    <title>gestion des flottes soumafe | Enregistrement des chauffeurs</title>
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
        <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/footer.php');?>
        <!-- end navbar side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enregistrement des chauffeurs</h1>
                </div>
                <a href="manage-ch.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> voir liste
</a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data">
                                    <div class="container">
                                        <div class="form-section">
                                              <div class="left">
                                        <div class="form-group">
                                            <label for="nom">Nom<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="nom" class="form-control" placeholder="exempletext"  required
           pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" 
           title="Le nom doit contenir uniquement des lettres et des espaces.">
                                        </div>
                                        <div class="form-group">
                                            <label for="prenom">Prénoms<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="prenom" class="form-control" placeholder="exempltest1" required
           pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" 
           title="Le prénoms doit contenir uniquement des lettres et des espaces.">
                                        </div>
                                        <div class="form-group">
                                            <label for="sexe">Sexe</label>
                                            <select name="sexe" class="form-control" required>
                                                <option value="">Sélectionnez</option>
                                                <option value="M">M</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dateN">Date de naissance<span style="font-size:11px;color:red" >*</label>
                                            <input type="date" name="dateN" class="form-control" required max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="center">
                                        <div class="form-group">
                                            <label for="adresse">Domicile<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="adresse" class="form-control" placeholder="Exemple:COCODY" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" 
                                            title="Le domicile doit contenir uniquement des lettres et des espaces.">
                                        </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email">Email <span id="email-error" style="color: red; display: none;"></span></label>
                                            <input type="email" name="email" class="form-control" placeholder="exemple@domaine.com" title="Veuillez entrer une adresse email valide." >
                                        </div>
                                        <div class="form-group">
                                            <label for="telephone1">Cel<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="telephone1" class="form-control" placeholder="Exemple:0x-xx-xx-xx-xx" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="telephone2">Tél</label>
                                            <input type="text" name="telephone2" placeholder="Exemple:0x-xx-xx-xx-xx" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="ms">Situation matrimoniale<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="ms" class="form-control" placeholder="Exemple:Celibataire" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cni">N° de CNI<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="cni" class="form-control" placeholder="Exemple:CI000565000" required>
                                        </div>
                                      
                                       <div class="form-group">
                                            <label for="photo">Photo d'identité<span style="font-size:11px;color:red" >format png,jpg*</label>
                                            <input type="file" name="photo" class="form-control" required>
                                        </div>
                                        
                                        </div>
                                                   <div class="right">
                                        <div class="form-group">
                                            <label for="permis">N° de permis<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="permis" class="form-control" placeholder="Exemple:math01-22-24233873t" required>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="date">Date de prise de service<span style="font-size:11px;color:red" >*</label>
                                            <input type="date" name="date" class="form-control" required placeholder="Entrez la date" 
        max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>"
        value="<?php echo date('Y-m-d'); ?>">
    
                                        </div>
                                        <div class="form-group">
                                            <label for="fin">Fin de service</label>
                                            <input type="date" name="fin" class="form-control">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="pp">Poste précédemment occupé</label>
                                            <input type="text" name="pp" class="form-control" placeholder="Exemple:fonction">
                                        </div>
                                        <div class="form-group">
                                            <label for="ent">Nom de l'entreprise/Autre</label>
                                            <input type="text" name="ent" class="form-control" placeholder="Exemple:smafe">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="esp">Expérience professionnelle</label>
                                            <input type="text" name="esp" class="form-control" placeholder="Exemple:1 ans">
                                        </div>
                                        <div class="form-group">
                                            <label for="rma">Motivation</label>
                                            <input type="text" name="rma" class="form-control"placeholder=" 22 lignes">
                                        </div>
                                        <div class="form-group">
                                            <label for="nm">Nom & Prénom d'un parent</label>
                                            <input type="text" name="nm" class="form-control" placeholder="Exemple:demdander">
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Téléphone d'un parent</label>
                                            <input type="text" name="tel" class="form-control" placeholder="Exemple:demander">
                                        </div>
                                        <div class="form-group">
                                            <label for="ft">Fonction du parent</label>
                                            <input type="text" name="ft" class="form-control" placeholder="Exemplefonction">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="fichier">piéce justificative/format pdf<span style="font-size:11px;color:red" >en un fichier</label>
                                            <input type="file" name="fichier" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Statut du chauffeur</label>
                                            <input type="checkbox" name="status" value="Actif"> Actif
                                        </div>
                                       
                                        </div></div>
                                                    <p style="margin: 0 auto; width: 100px;">
    <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Enregistrer</button>
</p>
<script>
     function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer le chauffeur ?');
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
document.getElementById('telephone1').addEventListener('input', function (e) {
    var value = e.target.value.replace(/\D/g, ''); // Supprime tout sauf les chiffres
    var formattedValue = '';
    
    if (value.length > 0) formattedValue = value.substring(0, 2);
    if (value.length > 2) formattedValue += '-' + value.substring(2, 4);
    if (value.length > 4) formattedValue += '-' + value.substring(4, 6);
    if (value.length > 6) formattedValue += '-' + value.substring(6, 8);
    if (value.length > 8) formattedValue += '-' + value.substring(8, 10);
   
    
    e.target.value = formattedValue;
});

    // Définir la date actuelle au format AAAA-MM-JJ
    let today = new Date().toISOString().split('T')[0];
    document.getElementById('dateN').setAttribute('max', today);
    
function validateEmail() {
    const emailInput = document.getElementById('email');
    const errorMessage = document.getElementById('email-error');

    // Expression régulière pour valider le format de l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Vérification du format de l'email
    if (!emailRegex.test(emailInput.value)) {
        errorMessage.textContent = "Veuillez entrer une adresse email valide.";
        errorMessage.style.display = "block";
    } else {
        errorMessage.style.display = "none";
        alert("Adresse email valide !");
        
    }
}

       </script>
   </body>
   </html>

<?php }  ?>