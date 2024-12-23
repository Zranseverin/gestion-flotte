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
$eid=$_GET['editid'];
$sql = "UPDATE chauffeur_list 
                SET nom = :nom, 
                    prenom = :prenom, 
                    sexe = :sexe, 
                    dateN = :dateN, 
                    adresse = :adresse, 
                    permis = :permis, 
                    cni = :cni, 
                    date = :date, 
                    fin = :fin, 
                    ms = :ms, 
                    pp = :pp, 
                    ent = :ent, 
                    esp = :esp, 
                    nm = :nm, 
                    tel = :tel, 
                    email = :email, 
                    ft = :ft, 
                    rma = :rma, 
                    telephone1 = :telephone1, 
                    telephone2 = :telephone2, 
                    status = :status 
                WHERE chID = :eid";
$query=$dbh->prepare($sql);

$query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $query->bindParam(':dateN', $dateN, PDO::PARAM_STR);
        $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':cni', $cni, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':fin', $fin, PDO::PARAM_STR);
        $query->bindParam(':ms', $ms, PDO::PARAM_STR);
        $query->bindParam(':pp', $pp, PDO::PARAM_STR);
        $query->bindParam(':ent', $ent, PDO::PARAM_STR);
        $query->bindParam(':esp', $esp, PDO::PARAM_STR);
        $query->bindParam(':nm', $nm, PDO::PARAM_STR);
        $query->bindParam(':tel', $tel, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':ft', $ft, PDO::PARAM_STR);
        $query->bindParam(':rma', $rma, PDO::PARAM_STR);
        $query->bindParam(':telephone1', $telephone1, PDO::PARAM_STR);
        $query->bindParam(':telephone2', $telephone2, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();

  
         echo '<script>alert("chauffeur modifieé")</script>';
         echo '<script>window.location.href ="manage-ch.php"</script>';

  

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
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data">
                                   
                                    <?php
$eid=$_GET['editid'];
$sql="SELECT * from  chauffeur_list where chID=$eid";
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
  <div class="container">
                                        <div class="form-section">
                                              <div class="left">
 
    <div class="form-group"> <label for="exampleInputEmail1">Nom</label> <input type="text" name="nom" value="<?php  echo $row->nom;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Prenom</label> <input type="text" name="prenom" value="<?php  echo $row->prenom;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Sexe</label><select type="text" name="sexe" value="" class="form-control" required='true'>
<option value="<?php  echo $row->sexe;?>"><?php  echo $row->sexe;?></option>
<option value="M">M</option>
<option value="F">F</option>
     </select></div>
    <div class="form-group"> <label for="exampleInputEmail1">Date de naissance</label> <input type="date" name="dateN" value="<?php  echo $row->dateN;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Domicile</label> <input type="text" name="adresse" value="<?php  echo $row->adresse;?>" class="form-control" required='true'> </div>
    <div class="form-group">
                                            <label for="email">Email <span id="email-error" style="color: red; display: none;"></span></label>
                                            <input type="email" name="email" class="form-control"  value="<?php  echo $row->email;?>" placeholder="exemple@domaine.com" title="Veuillez entrer une adresse email valide." >
                                        </div>
                                        <div class="form-group"> <label for="exampleInputEmail1">permis</label> <input type="text" name="permis" value="<?php  echo $row->permis;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">N° cni</label> <input type="text" name="cni" value="<?php  echo $row->cni;?>" class="form-control" required='true'> </div>
    <div class="form-group">
                                            <label for="ms">Situation matrimoniale<span style="font-size:11px;color:red" >*</label>
                                            <input type="text" name="ms" class="form-control"  value="<?php  echo $row->ms;?>" placeholder="Exemple:Celibataire" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date de prise de service<span style="font-size:11px;color:red" >*</label>
                                            <input type="date" name="date" class="form-control"  value="<?php  echo $row->date;?>" required placeholder="Entrez la date" 
        max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>"
        value="<?php echo date('Y-m-d'); ?>"> </div>
        <div class="form-group">
                                            <label for="status">Statut du chauffeur</label>
                                            <input type="checkbox" name="status" value="Actif" 
                                               <?php if($row->status == "Actif") echo 'checked'; ?>> Actif
                                        </div>
                                        <div class="form-group">
     <label for="exampleInputEmail1">Pass Creation Date</label> <input type="text" value="<?php  echo $row->PasscreationDate;?>" class="form-control" readonly='true'> 
    </div>
                                         </div>
                                                   <div class="right">
   

        <div class="form-group">
                                            <label for="pp">Poste précédemment occupé</label>
                                            <input type="text" name="pp" class="form-control" value="<?php  echo $row->pp;?>" placeholder="Exemple:fonction">
                                        </div>
                                        <div class="form-group">
                                            <label for="ent">Nom de l'entreprise/Autre</label>
                                            <input type="text" name="ent" class="form-control" value="<?php  echo $row->ent;?>" placeholder="Exemple:smafe">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="esp">Expérience professionnelle</label>
                                            <input type="text" name="esp" class="form-control" value="<?php  echo $row->esp;?>" placeholder="Exemple:1 ans">
                                        </div>
                                        <div class="form-group">
                                            <label for="rma">Motivation</label>
                                            <input type="text" name="rma" class="form-control" value="<?php  echo $row->rma;?>" placeholder=" 22 lignes">
                                        </div>
                                        <div class="form-group">
                                            <label for="nm">Nom & Prénom d'un parent</label>
                                            <input type="text" name="nm" class="form-control" value="<?php  echo $row->nm;?>" placeholder="Exemple:demdander">
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Tél d'un parent</label>
                                            <input type="text" name="tel" class="form-control" value="<?php  echo $row->tel;?>" placeholder="Exemple:demander">
                                        </div>
                                        <div class="form-group">
                                            <label for="ft">Fonction du parent</label>
                                            <input type="text" name="ft" class="form-control" value="<?php  echo $row->ft;?>" placeholder="Exemplefonction">
                                        </div>
                                       
    
    <div class="form-group"> <label for="exampleInputEmail1">Cel</label> <input type="text" name="telephone1" value="<?php  echo $row->telephone1;?>" class="form-control" required='true' maxlength="10" pattern="[0-9]+"> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Tel</label> <input type="text" name="telephone2" value="<?php  echo $row->telephone2;?>" class="form-control"> </div>
    
    <div class="form-group"> <label for="exampleInputEmail1">Date de mise en servive</label> <input type="date" name="date" value="<?php  echo $row->date;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Fin de service</label> <input type="date" name="fin" value="<?php  echo $row->fin;?>" class="form-control"> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Photo</label> <img src="images/<?php echo $row->Photo;?>" width="70" height="70" value="<?php  echo $row->photo;?>">
<a href="changePhoto.php?editid=<?php echo $row->chID;?>"> &nbsp; Edit photo</a> </div>


<?php $cnt=$cnt+1;}} ?> 
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Modification</button></p> </form>
                                </div>
                                
                            </div>
                            <script>
                                     function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }

                                </script>
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