<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


    $lib = $_POST['lib'];
    $date = $_POST['date'];
    

$eid=$_GET['editid'];
$ret = "SELECT lib, date FROM panne_list WHERE lib = :lib AND date = :date";
 $query= $dbh -> prepare($ret);
 $query->bindParam(':lib', $lib, PDO::PARAM_STR);
 $query->bindParam(':date', $date, PDO::PARAM_STR);

$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
     if($query -> rowCount() == 0)
{
$sql="update panne_list set lib=:lib,date=:date where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':lib', $lib, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
       

$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();

   echo '<script>alert("modification effectuée")</script>';
   echo "<script>window.location.href ='manage-panne.php'</script>";
}
else
{

echo "<script>alert(panne Already Exist. Please try again');</script>";
echo "<script>window.location.href ='manage-panne.php'</script>";
}
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flottes  | Update panne</title>
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
                    <h1 class="page-header">Update panne</h1>
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
                                      <?php
$eid=$_GET['editid'];
$sql="SELECT * from  panne_list where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    
    <div class="form-group"> <label for="exampleInputEmail1">libellé panne </label> <input type="text" name="lib" value="<?php  echo $row->lib;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">date  </label> <input type="date" name="date" value="<?php  echo $row->date;?>" class="form-control" required='true'> </div>
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