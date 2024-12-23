<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    // Code for deleting product from cart
        if(isset($_GET['delid']))
        {
        $rid=intval($_GET['delid']);
        $sql="delete from attr_list where ID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
         echo "<script>alert('Data deleted');</script>"; 
          echo "<script>window.location.href = 'manage-attr.php'</script>";     
        
        
        }



  ?>
<!DOCTYPE html>
<html>

<head>
   
    <title>gestion des flottes soumafe | attribution</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

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
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Liste des vehicules a attribué</h1>
                </div>
                 <!-- end  page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                      
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                           <th>Immatriculation</th>
                                            <th>Marque</th>
                                            <th>Model</th>
                                            <th>genre</th>
                                            <th>permis</th>
                                            <th>nom</th>
                                            <th>prenom</th>
                                            <th>permis</th>
                                            <th>nom</th>
                                            <th>prenom</th>
                                            
                                            <th>date d'attribution</th>

                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from attr_list";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                       <tr>
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php  echo htmlentities($row->imt);?></td>
                  <td><?php  echo htmlentities($row->marque);?></td>
                  <td><?php  echo htmlentities($row->model);?></td>
                  <td><?php  echo htmlentities($row->genre);?></td>
                  <td><?php  echo htmlentities($row->permis);?></td>
                  <td><?php  echo htmlentities($row->nom);?></td>
                  <td><?php  echo htmlentities($row->prenom);?></td>
                  <td><?php  echo htmlentities($row->permis2);?></td>
                  <td><?php  echo htmlentities($row->nom2);?></td>
                  <td><?php  echo htmlentities($row->prenom2);?></td>
                  <td><?php  echo htmlentities($row->date);?></td>
                   
                  <td><?php  echo htmlentities($row->PostingDate);?></td>
                  <td><a href="view-attr.php?viewid=<?php echo htmlentities ($row->ID);?>">View</a>|| <a href="manage-attr.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Voulez vous supprimer ?');">supp</i></a></td>
                </tr>
               <?php $cnt=$cnt+1;}} ?>  
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>

</html>
<?php }  ?>