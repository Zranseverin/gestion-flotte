<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if session exists
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Check if form has been submitted
    if (isset($_POST['submit'])) {

        // Retrieve form data
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
        $eid = $_GET['editid'];

        // Update query
        $sql = "UPDATE vh_list SET 
        imt = :imt, 
        marque = :marque, 
        model = :model, 
        cleur = :cleur, 
        genre = :genre, 
        carbt = :carbt, 
        car = :car, 
        serie = :serie,               
        dte = :dte, 
        imtP = :imtP,
        gr = :gr,
        pss = :pss,
        eqp = :eqp,
        cli = :cli,
        sA = :sA,
        capr = :capr,
        dr = :dr,
        pID = :pID,
        prenom = :prenom,
        concessionnaire = :concessionnaire,
        etat = :etat,
        nom = :nom
                WHERE ID = :eid";

        $query = $dbh->prepare($sql);

        // Bind parameters
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
$query->bindParam(':nom',$nom,PDO::PARAM_STR);
$query->bindParam(':etat',$etat,PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        // Execute query
        $query->execute();

        // Provide user feedback and redirect
        echo '<script>alert("Vehicule modifié")</script>';
        echo "<script>window.location.href ='manage-vh.php'</script>";
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
        if (pID) {
            $.ajax({
                type: 'POST',
                url: 'get-m.php',
                data: {pID: pID},
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#prenom').val(data.prenom);
                    $('#nom').val(data.nom);

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
                     <?php
$eid=$_GET['editid'];
$sql="SELECT * from  vh_list where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  <p colspan="6" style="font-size:20px;color:blue;text-align: center;">
 Pass ID: <?php  echo ($row->PassNumber);?></p>

 <div class="container">
                                        <div class="form-section">
                                              <div class="left">        
 <div class="form-group">
         <label for="imt">Immatriculation provisoire<span style="font-size:11px;color:red"></span></label> <input type="text" name="imtP" value="<?php  echo $row->imtP;?>" class="form-control"  placeholder="Ex: ZB-123-AD" 
        > </div>
    <div class="form-group"> <label for="exampleInputEmail1">Immatriculation</label> <input type="text" name="imt" value="<?php  echo $row->imt;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">Marque</label><select type="text" name="marque" value="" class="form-control" required='true'>
      <option value="<?php  echo $row->marque;?>"><?php  echo $row->marque;?></option>
<?php 

$sql2 = "SELECT * from   tblcategory";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->marque);?>"><?php echo htmlentities($row2->marque);?></option>
 <?php } ?>
     </select>
    </div>
    <div class="form-group"> <label for="exampleInputEmail1">model</label><select type="text" name="model" value="" class="form-control" required='true'>
      <option value="<?php  echo $row->model;?>"><?php  echo $row->model;?></option>
<?php 

$sql2 = "SELECT * from   model_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->model);?>"><?php echo htmlentities($row2->model);?></option>
 <?php } ?>
     </select>
    </div>
    <div class="form-group"> <label for="exampleInputEmail1">puissance<span style="font-size:11px;color:red"></span></label> <input type="text" name="pss" value="<?php  echo $row->pss;?>"class="form-control"  placeholder="Entrez la puissance "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">km depart<span style="font-size:11px;color:red">*</span></label> <input type="text" name="eqp"  value="<?php  echo $row->eqp;?>" class="form-control" required='true'  placeholder="Entrez kimometrage depart "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">climatisation<span style="font-size:11px;color:red"></span></label> <input type="text" name="cli" value="<?php  echo $row->cli;?>" class="form-control"   placeholder="Entrez "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">camera du recule<span style="font-size:11px;color:red"></span></label> <input type="text" name="sA"  value="<?php  echo $row->sA;?>" class="form-control"   placeholder="Entrez "> </div>
     <div class="form-group"> <label for="exampleInputEmail1">capacité de reservoire<span style="font-size:11px;color:red"></span></label> <input type="text" name="capr"  value="<?php  echo $row->capr;?>" class="form-control"  placeholder="Entrez ">
     </div>
     <div class="form-group"> 
        <label for="exampleInputEmail1">concessionnaire</label><select type="text" name="concessionnaire" value="" class="form-control" required='true'>
      <option value="<?php  echo $row->concessionnaire;?>"><?php  echo $row->concessionnaire;?></option>
<?php 

$sql2 = "SELECT * from   concessionnaire_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->concessionnaire);?>"><?php echo htmlentities($row2->concessionnaire);?></option>
 <?php } ?>
     </select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Nom du proprietaire <span style="font-size:11px;color:red">*</span></label>
    <select name="pID" id="pID" class="form-control" required>
       
        <option value="<?php echo $row->pID; ?>"><?php echo $row->nom; ?></option>
        <?php 
        $sql2 = "SELECT * FROM pr_list";
        $query2 = $dbh->prepare($sql2);
        $query2->execute();
        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

        foreach ($result2 as $owner) { // Changed $row to $owner
        ?>
            <option value="<?php echo htmlentities($owner->pID); ?>"><?php echo htmlentities($owner->nom); ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
     <label for="exampleInputEmail1"> Creation Date</label> <input type="text" value="<?php  echo $row->PasscreationDate;?>" class="form-control" readonly='true'>
     </div>

     </div>
     <div class="right">
     
     <div class="form-group"> <label for="exampleInputEmail1">couleur</label><select type="text" name="cleur" value="" class="form-control" required='true'>
<option value="<?php  echo $row->cleur;?>"><?php  echo $row->cleur;?></option>
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
    <label for="dr">Dernière révision<span style="font-size:11px;color:red">*</span></label>
    <input type="date" name="dr" id="dr" class="form-control" required placeholder="Entrez la date"  value="<?php  echo $row->dr;?>" max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
</div>

     <div class="form-group"> <label for="exampleInputEmail1">carrosserie</label> <input type="text" name="car" value="<?php  echo $row->car;?>" class="form-control" required='true'> </div>
     <div class="form-group"> <label for="exampleInputEmail1">serie</label> <input type="text" name="serie" value="<?php  echo $row->serie;?>" class="form-control" required='true'> </div>
     <div class="form-group"> <label for="exampleInputEmail1">date service</label> <input type="date" name="dte" value="<?php  echo $row->dte;?>" class="form-control" required='true'> </div>
     <div class="form-group"> <label for="exampleInputEmail1">genre</label><select type="text" name="genre" value="" class="form-control" required='true'>
<option value="<?php  echo $row->genre;?>"><?php  echo $row->genre;?></option>
<option value="Particulier">Particulier</option>
<option value="Taxi">Taxi</option>
<option value="Yango">Yango</option>

     </select>
     </div>
     
     
     <div class="form-group"> <label for="exampleInputEmail1">carburant</label><select type="text" name="carbt" value="" class="form-control" required='true'>
<option value="<?php  echo $row->carbt;?>"><?php  echo $row->carbt;?></option>
<option value="essence">essence</option>
<option value="gazoil">gazoil</option>

     </select></div>
     <div class="form-group">
         <label for="etat">Etat du véhicule<span style="font-size:11px;color:red">*</span></label><select type="text" name="etat" value="" class="form-control" required='true'>
         <option value="<?php  echo $row->etat;?>"><?php  echo $row->etat;?></option>
<option value="Neuf">Neuf</option>
<option value="Occasion"> Occasion</option>

     </select></div>

     <div class="form-group"> <label for="gr">Garentie<span style="font-size:11px;color:red">*</span></label> <input type="text" name="gr" value="<?php  echo $row->gr;?>" class="form-control" required='true'  placeholder=" Gantie du véhicule"> 
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Nom</label>
    <input type="text" name="nom" id="nom" value="<?php echo $row->nom; ?>" class="form-control" required readonly>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Prenom</label>
    <input type="text" name="prenom" id="prenom" value="<?php echo $row->prenom; ?>" class="form-control" required readonly>
</div>
<div class="form-group">
         <label for="exampleInputEmail1">Photo</label> <img src="images/<?php echo $row->photo;?>" width="100" height="100" value="<?php  echo $row->photo;?>">
<a href="changeVh.php?editid=<?php echo $row->ID;?>"> &nbsp; Edit photo</a>
 </div>
 <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="return confirmSubmission();">Modification</button>
     </div>

    


<?php $cnt=$cnt+1;}} ?> 
     <p style="padding-left: 450px"></p> </form>
                                </div>
                                <script>
                                     function confirmSubmission() {
            return confirm('Êtes-vous sûr de vouloir enregistrer ces informations ?');
        }

                                </script>
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