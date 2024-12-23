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
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $genre = $_POST['genre'];
        $g = $_POST['g'];
        $rg = $_POST['rg'];
        $lib = $_POST['lib'];
        $dd = $_POST['dd'];
        $dr = $_POST['dr'];
        $hr = $_POST['hr'];
        $ds = $_POST['ds'];
        $temps = $_POST['temps'];
        $ob = $_POST['ob'];
        $hd = $_POST['hd'];
        $hs = $_POST['hs'];
        $qt = $_POST['qt'];
        $mt = $_POST['mt'];
        $total = $_POST['total'];
        $eid = $_GET['editid'];

        // Update query
        $sql = "UPDATE pn_list SET 
                imt = :imt,
                marque = :marque, 
                model = :model,  
                genre = :genre, 
                g = :g, 
                dr = :dr, 
                hr = :hr, 
                lib= :lib, 
                rg = :rg, 
                dd = :dd,
                ds = :ds, 
                hd = :hd, 
                hs = :hs,
                ob = :ob,
                temps = :temps,
                total = :total,
                mt = :mt,
                qt = :qt
                WHERE ID = :eid";

        $query = $dbh->prepare($sql);

        // Bind parameters
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genre', $genre, PDO::PARAM_STR);
        $query->bindParam(':lib', $lib, PDO::PARAM_STR);
        $query->bindParam(':g', $g, PDO::PARAM_STR);
        $query->bindParam(':rg', $rg, PDO::PARAM_STR);
        $query->bindParam(':dd', $dd, PDO::PARAM_STR);
        $query->bindParam(':ds', $ds, PDO::PARAM_STR);
        $query->bindParam(':temps', $temps, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);
        $query->bindParam(':hd', $hd, PDO::PARAM_STR);
        $query->bindParam(':hs', $hs, PDO::PARAM_STR);
        $query->bindParam(':dr', $dr, PDO::PARAM_STR);
        $query->bindParam(':hr', $hr, PDO::PARAM_STR);
        $query->bindParam(':mt', $mt, PDO::PARAM_STR);
        $query->bindParam(':total', $total, PDO::PARAM_STR);
        $query->bindParam(':qt', $qt, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        // Execute query
        $query->execute();

        // Provide user feedback and redirect
        echo '<script>alert("panne modifié ")</script>';
        echo "<script>window.location.href ='manage-p.php'</script>";
    }

?>


<!DOCTYPE html>
<html>

<head>
    
    <title>gestion flottes soumafe | Edit  panne </title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />



</head>

<body>
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
                    <h1 class="page-header">Edit panne </h1>
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
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                        $('#imt').change(function(){
                                            var imt = $(this).val();
                                            if(imt){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'vst-driver.php',
                                                    data: {imt: imt},
                                                    success: function(response){
                                                        var data = JSON.parse(response);
                                                        $('#marque').val(data.marque);
                                                        $('#model').val(data.model);
                                                        $('#genre').val(data.genre);
                                                    }
                                                });
                                            }
                                        });

                                        $('#permis').change(function(){
                                            var permis = $(this).val();
                                            if(permis){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'get-vh.php',
                                                    data: {permis: permis},
                                                    success: function(response){
                                                        var data = JSON.parse(response);
                                                        $('#nom').val(data.nom);
                                                        $('#prenom').val(data.prenom);
                                                        $('#telephoneT').val(data.telephoneT);
                                                    }
                                                });
                                            }
                                        });
                                    });

                                    function calculerTotal() {
                                        const qt = parseFloat(document.getElementById('qt').value) || 0;
                                        const mt = parseFloat(document.getElementById('mt').value) || 0;

                                        const total = qt * mt;
                                        document.getElementById('total').value = total.toFixed(2);

                                        
                                    }

                                    function getvt(val) {
$.ajax({
type: "POST",
url: "get_vts.php",
data:'imt='+val,
success: function(data){
$("#imt").html(data);
}
});
   }



                                </script>
                                    <?php
$eid=$_GET['editid'];
$sql="SELECT * from  pn_list where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
  
  <div class="form-group">
                                    <label for="imt">immatriculation</label>
                                    <select name="imt" id="imt" class="form-control" required>
      <option value="<?php  echo $row->imt;?>"><?php  echo $row->imt;?></option>
<?php 

$sql2 = "SELECT * from   attr_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->imt);?>"><?php echo htmlentities($row2->imt);?></option>
 <?php } ?>
     </select></div>
    
     <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" value="<?php  echo $row->marque;?>" class="form-control" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" value="<?php  echo $row->model;?>" class="form-control" required readonly>
                                </div>

                                <!-- Champ Genre -->
                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <input type="text" name="genre" id="genre" value="<?php  echo $row->genre;?>" class="form-control" required readonly>
                                    
                                    <div class="form-group">
                                    <label for="dd">Date de la declaration </label>
                                    <input type="date" name="dd" id="dd" class="form-control" value="<?php  echo $row->dd;?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="dr">date d'entré </label>
                                    <input type="date" id="dr" name="dr" class="form-control" value="<?php  echo $row->dr;?>" required >
                                </div>
                                <div class="form-group">
                                    <label for="lib">Libellé panne</label>
                                    <select name="lib" id="lib" class="form-control" required>
      <option value="<?php  echo $row->lib;?>"><?php  echo $row->lib;?></option>
<?php 

$sql2 = "SELECT * from   panne_list";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
<option value="<?php echo htmlentities($row2->lib);?>"><?php echo htmlentities($row2->lib);?></option>
 <?php } ?>
     </select></div>
    
                                <div class="form-group">
                                    <label for="g"> nom du garage</label>
                                    <input type="text" name="g" id="g" class="form-control" value="<?php  echo $row->g;?>">
                                </div>
                                <div class="form-group">
                                    <label for="qt">Quantité</label>
                                    <input type="text" name="qt" id="qt" class="form-control" value="<?php  echo $row->qt;?>" oninput="calculerTotal()">
                                </div>

                                <div class="form-group">
                                    <label for="mt">Montant</label>
                                    <input type="text" name="mt" id="mt" class="form-control" value="<?php  echo $row->mt;?>" oninput="calculerTotal()" >
                                </div>
                                <div class="form-group">
                                    <label for="total">total</label>
                                    <input type="text" id="total" name="total" class="form-control" value="<?php  echo $row->total;?>" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="rg">responsable garage</label>
                                    <input type="rg" name="rg" id="rg" class="form-control" value="<?php  echo $row->rg;?>" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="ds">date de sortie </label>
                                    <input type="date" id="ds" name="ds" class="form-control" value="<?php  echo $row->ds;?>" required >
                                </div>
                                <div class="form-group">
                                    <label for="hd">heure declaration </label>
                                    <input type="time" id="hd" name="hd" class="form-control" value="<?php  echo $row->hd;?>" required >
                                </div>
                                
                                <div class="form-group">
                                    <label for="hr">heure d'entré </label>
                                    <input type="time" id="hr" name="hr" class="form-control" value="<?php  echo $row->hr;?>" required >
                                </div>
                                <div class="form-group">
                                    <label for="ds">heure de sortie </label>
                                    <input type="time" id="hs" name="hs" class="form-control" value="<?php  echo $row->hs;?>" required >
                                </div>

                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" value="<?php  echo $row->ob;?>" class="form-control">
                                </div>

<?php $cnt=$cnt+1;}} ?> 
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button></p> </form>
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