<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $concessionnaire = $_POST['concessionnaire'];
        $responsable = $_POST['responsable'];
        $adresse = $_POST['adresse'];
        $telephone1 = $_POST['telephone1'];
        $telephone2 = $_POST['telephone2'];
        $email = $_POST['email'];

        // Check if the record already exists
        $ret = "SELECT concessionnaire, responsable, adresse, telephone1, telephone2, email 
                FROM concessionnaire_list 
                WHERE concessionnaire=:concessionnaire AND responsable=:responsable 
                AND adresse=:adresse AND telephone1=:telephone1 AND telephone2=:telephone2 AND email=:email";

        $query = $dbh->prepare($ret);
        $query->bindParam(':concessionnaire', $concessionnaire, PDO::PARAM_STR);
        $query->bindParam(':responsable', $responsable, PDO::PARAM_STR);
        $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $query->bindParam(':telephone1', $telephone1, PDO::PARAM_STR);
        $query->bindParam(':telephone2', $telephone2, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() == 0) {
            // Insert the new record
            $sql = "INSERT INTO concessionnaire_list(concessionnaire, responsable, adresse, telephone1, telephone2, email) 
                    VALUES (:concessionnaire, :responsable, :adresse, :telephone1, :telephone2, :email)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':concessionnaire', $concessionnaire, PDO::PARAM_STR);
            $query->bindParam(':responsable', $responsable, PDO::PARAM_STR);
            $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $query->bindParam(':telephone1', $telephone1, PDO::PARAM_STR);
            $query->bindParam(':telephone2', $telephone2, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();

            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Concessionnaire has been added.")</script>';
                echo '<script>window.location.href ="add_concessionnaire.php"</script>';
            } else {
                echo '<script>alert("Something went wrong. Please try again")</script>';
            }
        } else {
            echo "<script>alert('Concessionnaire already exists. Please try again');</script>";
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flotte | Add concessionnaire</title>
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
                    <h1 class="page-header">Ajouter un concessionnaire</h1>
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
                                    
    <div class="form-group"> <label for="exampleInputEmail1">concessionnaire</label> <input type="text" name="concessionnaire" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">responsable</label> <input type="text" name="responsable" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">telephone1</label> <input type="text" name="telephone1" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">telephone2</label> <input type="text" name="telephone2" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">email</label> <input type="text" name="email" value="" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">adresse</label> <input type="text" name="adresse" value="" class="form-control" required='true'> </div>
     
     <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button></p> </form>
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