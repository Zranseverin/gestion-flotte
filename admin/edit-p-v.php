<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


    $jr = $_POST['jr'];
    $vp = $_POST['vp'];
    $rp = $_POST['rp'];

$eid=$_GET['editid'];
$ret = "SELECT jr, vp, rp FROM lib_list WHERE jr = :jr AND vp = :vp AND rp = :rp";
 $query= $dbh -> prepare($ret);
 $query->bindParam(':jr', $jr, PDO::PARAM_STR);
 $query->bindParam(':vp', $vp, PDO::PARAM_STR);
 $query->bindParam(':rp', $rp, PDO::PARAM_STR);

$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
     if($query -> rowCount() == 0)
{
$sql="update lib_list set jr=:jr,vp=:vp,rp=:rp where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':jr', $jr, PDO::PARAM_STR);
        $query->bindParam(':vp', $vp, PDO::PARAM_STR);
        $query->bindParam(':rp', $rp, PDO::PARAM_STR);

$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();

   echo '<script>alert("modification effectuée")</script>';
   echo "<script>window.location.href ='manage-recette.php'</script>";
}
else
{

echo "<script>alert('marque Already Exist. Please try again');</script>";
echo "<script>window.location.href ='manage-recette.php'</script>";
}
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flottes  | Update recette</title>
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
                    <h1 class="page-header">Update recette</h1>
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
$sql="SELECT * from  lib_list where ID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    
    <div class="form-group"> <label for="exampleInputEmail1">jour </label> <input type="text" name="jr" value="<?php  echo $row->jr;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">versement prevu </label> <input type="text" name="vp" value="<?php  echo $row->vp;?>" class="form-control" required='true'> </div>
    <div class="form-group"> <label for="exampleInputEmail1">recette prevue </label> <input type="text" name="rp" value="<?php  echo $row->rp;?>" class="form-control" required='true'> </div>
   
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