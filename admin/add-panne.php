<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $lib = $_POST['lib'];
        $date = $_POST['date'];
        

        // Check if the record already exists
        $ret = "SELECT lib, date
                FROM panne_list 
                WHERE lib=:lib AND date=:date";

        $query = $dbh->prepare($ret);
        $query->bindParam(':lib', $lib, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() == 0) {
            // Insert the new record
            $sql = "INSERT INTO panne_list(lib, date) 
                    VALUES (:lib, :date)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':lib', $lib, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
            $query->execute();

            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("parametrage panne enregistré.")</script>';
                echo '<script>window.location.href ="add-p.php"</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again")</script>';
            }
        } else {
            echo "<script>alert('panne existant . Ajouter autre ');</script>";
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flotte | Add  lib recette</title>
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
                    <h1 class="page-header">Ajouter une panne</h1>
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
                                    
    <div class="form-group"> <label for="exampleInputEmail1">libellé panne</label> <input type="text" name="lib" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">date</label> <input type="date" name="date" value="" class="form-control" required='true'> </div>
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Enregistrer</button></p> </form>
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