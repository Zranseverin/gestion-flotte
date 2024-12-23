<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

    $eid=$_GET['editid'];
$photo=$_FILES["photo"]["name"];
$extension = substr($photo,strlen($photo)-4,strlen($photo));
$allowed_extensions = array(".jpg","jpeg",".png");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('photo  has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{

$photo=md5($photo).time().$extension;
 move_uploaded_file($_FILES["photo"]["tmp_name"],"images/".$photo);

    $query= "update chauffeur_list set photo=:photo where chID=:eid";
    $query = $dbh->prepare($query);
     $query->bindParam(':photo',$photo,PDO::PARAM_STR);
     $query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Photo has been updated")</script>';
echo "<script>window.location.href ='manage-ch.php'</script>";
  
}}
?>
<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flottes soumafe | Update photo</title>
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
                    <h1 class="page-header">Update photo</h1>
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
$sql="SELECT * from  chauffeur_list where chID=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                   <div class="form-group"> <label for="exampleInputEmail1">nom</label> <input type="text" name="nom" value="<?php  echo $row->nom;?>" class="form-control" readonly='true'> </div>                 
    <div class="form-group"> <label for="exampleInputEmail1"> Photo</label> <img src="images/<?php echo $row->photo;?>" width="100" height="100" value="<?php  echo $row->photo;?>"> </div>
   <div class="form-group"> <label for="exampleInputEmail1">New Photo</label> <input type="file" name="photo" accept="image/*"> </div>
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