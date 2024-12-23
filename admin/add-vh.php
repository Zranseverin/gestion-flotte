<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $imt=$_POST['imt'];
$marque=$_POST['marque'];
$model=$_POST['model'];
$cleur=$_POST['cleur'];
$genre=$_POST['genre'];
$carbt=$_POST['carbt'];
$car=$_POST['car'];
$serie=$_POST['serie'];
$dte=$_POST['dte'];
$imtP=$_POST['imtP'];
$gr=$_POST['gr'];
$pss=$_POST['pss'];
$eqp=$_POST['eqp'];
$cli=$_POST['cli'];
$sA=$_POST['sA'];
$capr=$_POST['capr'];
$dr=$_POST['dr'];
$pID=$_POST['pID'];
$prenom=$_POST['prenom'];
$concessionnaire=$_POST['concessionnaire'];
$etat=$_POST['etat'];
$nom=$_POST['nom'];

$photo=$_FILES["photo"]["name"];
$extension = substr($photo,strlen($photo)-4,strlen($photo));
$allowed_extensions = array(".jpg","jpeg",".png");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('format invalid. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$photo=md5($photo).time().$extension;
 move_uploaded_file($_FILES["photo"]["tmp_name"],"images/".$photo);
$sql="insert into vh_list(imt,marque,model,cleur,genre,carbt,car,serie,dte,concessionnaire,photo,fichier,pID,prenom,imtP,gr,pss,eqp,cli,sA,capr,dr,nom,etat)values(:imt,:marque,:model,:cleur,:genre,:carbt,:serie,:car,:dte,:concessionnaire,:photo,:fichier,:pID,:prenom,:imtP,:gr,:pss,:eqp,:cli,:sA,:capr,:dr,:nom,:etat)";
$query=$dbh->prepare($sql);
$query->bindParam(':imt',$imt,PDO::PARAM_STR);
$query->bindParam(':marque',$marque,PDO::PARAM_STR);
$query->bindParam(':model',$model,PDO::PARAM_STR);
$query->bindParam(':cleur',$cleur,PDO::PARAM_STR);
$query->bindParam(':genre',$genre,PDO::PARAM_STR);
$query->bindParam(':carbt',$carbt,PDO::PARAM_STR);
$query->bindParam(':car',$car,PDO::PARAM_STR);
$query->bindParam(':dte',$dte,PDO::PARAM_STR);
$query->bindParam(':serie',$serie,PDO::PARAM_STR);
$query->bindParam(':concessionnaire',$concessionnaire,PDO::PARAM_STR);
$query->bindParam(':imtP',$imtP,PDO::PARAM_STR);
$query->bindParam(':pID',$pID,PDO::PARAM_STR);
$query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
$query->bindParam(':gr',$gr,PDO::PARAM_STR);
$query->bindParam(':pss',$pss,PDO::PARAM_STR);
$query->bindParam(':eqp',$eqp,PDO::PARAM_STR);
$query->bindParam(':cli',$cli,PDO::PARAM_STR);
$query->bindParam(':sA',$sA,PDO::PARAM_STR);
$query->bindParam(':capr',$capr,PDO::PARAM_STR);
$query->bindParam(':dr',$dr,PDO::PARAM_STR);
$query->bindParam(':photo',$photo,PDO::PARAM_STR);
$query->bindParam(':fichier',$fichier,PDO::PARAM_STR);
$query->bindParam(':nom',$nom,PDO::PARAM_STR);
$query->bindParam(':etat',$etat,PDO::PARAM_STR);

 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("véhicule enregistré.")</script>';
echo "<script>window.location.href ='add-vh.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  

}
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flottes soumafe | Enregistrement du véhicule</title>
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
                               
                                    <form method="post" enctype="multipart/form-data"> 
                                    <div class="container">
            <div class="form-section">
                <div class="left">
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#pID').change(function(){
        var pID = $(this).val();
        if(pID){
            $.ajax({
                type: 'POST',
                url: 'get-m.php',
                data: {pID: pID},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#prenom').val(data.prenom);
                    $('#nom').val(data.nom);
                    
                    // Ajoutez d'autres champs à remplir automatiquement
                }
            });
        }
    });
 });
    $(document).ready(function(){
      $('#imt').change(function(){
        var imt = $(this).val();
        if(imt){
            $.ajax({
                type: 'POST',
                url: 'attr_drive.php',
                data: {imt: imt},
                success: function(response){
                    var data = JSON.parse(response);
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
    $('#permis2').change(function(){
        var permis2 = $(this).val();
        if(permis2){
            $.ajax({
                type: 'POST',
                url: 'fetch_driver.php',
                data: {permis: permis2},
                success: function(response){
                    var data = JSON.parse(response);
                    $('#nom2').val(data.nom);
                    $('#prenom2').val(data.prenom);
                    $('#adresse2').val(data.adresse);
                    $('#telephoneT2').val(data.telephoneT);
                    $('#sexe2').val(data.sexe);

                },
                error: function(){
                    alert('Erreur lors de la récupération des données');
                }
            });
        }
    });
});


</script>
                                    
    <div class="form-group">
         <label for="imt">Immatriculation provisoire<span style="font-size:11px;color:red"></span></label> <input type="text" name="imtP" value="" class="form-control"  placeholder="Ex: ZB-123-AD" 
        > </div>
    <div class="form-group">
         <label for="imt">Immatriculation<span style="font-size:11px;color:red">*</span></label> <input type="text" name="imt" value="" class="form-control" required 
        placeholder="Ex: AB-123-CD"> 
</div>
    <div class="form-group"> <label for="marque">marque<span style="font-size:11px;color:red">*</span></label><select type="text" name="marque" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->marque);?>"><?php echo htmlentities($row->marque);?></option>
 <?php } ?>
     </select></div>
     <div class="form-group"> <label for="model">model</label><select type="text" name="model" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   model_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->model);?>"><?php echo htmlentities($row->model);?></option>
 <?php } ?>
     </select></div>
     <div class="form-group"> <label for="cleur">couleur<span style="font-size:11px;color:red">*</span></label><select type="text" name="cleur" value="" class="form-control" required='true'>
<option value="">Selectionner la couleur</option>
<option value="blanche">blanche</option>
<option value="orange">orange</option>
<option value="rouge">rouge</option>
<option value="grise">grise</option>
<option value="noir">noir</option>
<option value="jaune">jaune</option>
<option value="verte">verte</option>
<option value="marron">marron</option>
     </select></div>
     <div class="form-group">
         <label for="etat">Etat du véhicule<span style="font-size:11px;color:red">*</span></label><select type="text" name="etat" value="" class="form-control" required='true'>
<option value="">Selectionner l'etat du véhicule</option>
<option value="Neuf">Neuf</option>
<option value="Occasion"> Occasion</option>

     </select></div>
    
     <div class="form-group"> <label for="car">carrosserie<span style="font-size:11px;color:red"></span></label> <input type="text" name="car" value="" class="form-control"   placeholder="5HGCM82633A123456" > </div>
     <div class="form-group"> <label for="serie">N° de serie<span style="font-size:11px;color:red"></span></label> <input type="text" name="serie" value="" class="form-control" placeholder="1HGCM82633A123456" > </div>

    
    
     <div class="form-group">
    <label for="dte">Date d'acquisition <span style="font-size:11px;color:red">*</span></label>
    <input type="date" id="dte" name="dte" class="form-control" required="true">
</div>

    <div class="form-group"> <label for="genre">genre<span style="font-size:11px;color:red">*</span></label><select type="text" name="genre" value="" class="form-control" required='true'  placeholder="Entrez Nom du propritaire">
<option value="">Selectionner le genre</option>
<option value="blanche">particulier</option>
<option value="Taxi">Taxi</option>
<option value="Yango">Yango</option>
<option value="Autres">Autres</option>

     </select></div>
      
     <div class="form-group"> <label for="carbt">carburant<span style="font-size:11px;color:red">*</span></label><select type="text" name="carbt" value="" class="form-control" required='true'  placeholder="Entrez Nom du propritaire">
<option value="">Selectionner </option>
<option value="essence">essence</option>
<option value="gazoil">gazoil</option>

     </select></div>
     <div class="form-group"> <label for="gr">Garentie<span style="font-size:11px;color:red">*</span></label> <input type="text" name="gr" value="" class="form-control" required='true'  placeholder=" Gantie du véhicule"> </div>
     </div>
     <div class="right">
      
     
      
     <div class="form-group"> <label for="exampleInputEmail1">puissance<span style="font-size:11px;color:red"></span></label> <input type="text" name="pss" value="" class="form-control"  placeholder="Entrez la puissance "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">km depart<span style="font-size:11px;color:red">*</span></label> <input type="text" name="eqp" value="" class="form-control" required='true'  placeholder="Entrez kimometrage depart "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">climatisation<span style="font-size:11px;color:red"></span></label> <input type="text" name="cli" value="" class="form-control"   placeholder="Entrez "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">camera du recule<span style="font-size:11px;color:red"></span></label> <input type="text" name="sA" value="" class="form-control"   placeholder="Entrez "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">capacité de reservoire<span style="font-size:11px;color:red"></span></label> <input type="text" name="capr" value="" class="form-control"  placeholder="Entrez "> </div>
     <div class="form-group"> 
     <div class="form-group"> 
    <label for="dr">Dernière révision<span style="font-size:11px;color:red">*</span></label>
    <input type="date" name="dr" id="dr" class="form-control" required placeholder="Entrez la date" max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
</div>

    </div>

    
     <div class="form-group"> <label for="exampleInputEmail1">concessionnaire<span style="font-size:11px;color:red">*</span></label><select type="text" name="concessionnaire" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   concessionnaire_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->concessionnaire);?>"><?php echo htmlentities($row->concessionnaire);?></option>
 <?php } ?>
     </select></div>
     <div class="form-group"> 
        <label for="exampleInputEmail1"> Nom du proprietaire<span style="font-size:11px;color:red">*</span></label><select type="text" name="pID" id="pID" value="" class="form-control" required='true'>
<?php 

$sql2 = "SELECT * from   pr_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row)
{          
    ?>  
<option value="<?php echo htmlentities($row->pID);?>"><?php echo htmlentities($row->nom);?></option>
 <?php } ?>
     </select></div>
     <div class="form-group"> <label for="exampleInputEmail1">Nom</label> <input type="text" name="nom" id="nom" value="" class="form-control" required readonly> </div>
     <div class="form-group"> <label for="exampleInputEmail1">Prenom</label> <input type="text" name="prenom" id="prenom" value="" class="form-control" required readonly> </div>
     <div class="form-group"> <label for="exampleInputEmail1">Photo du véhicule<span style="font-size:11px;color:red">format jpg/png*</span></label> <input type="file" name="photo" value="" class="form-control" required='true'> </div>
<div class="form-group"> <label for="exampleInputEmail1">fichier  du véhicule<span style="font-size:11px;color:red">format pdf en un fichier</span> </label> <input type="file" name="fichier" value="" class="form-control"> </div>
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