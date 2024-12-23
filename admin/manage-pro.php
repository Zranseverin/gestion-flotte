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
        $sql="delete from pr_list where pID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
         echo "<script>alert('suppression de donnée');</script>"; 
          echo "<script>window.location.href = 'manage-pro.php'</script>";     
        
        
        }
        


  ?>
<!DOCTYPE html>
<html>

<head>
   
    <title>gestion des flottes soumafe| liste des proprietaires</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>
    <style>
        /* General Styling for Action Buttons */
 a {
    text-decoration: none; /* Remove underline */
    color: #333; /* Default text color */
    font-weight: bold; /* Make text bold */
    margin: 0 10px; /* Add some space between buttons */
    transition: color 0.3s ease; /* Smooth transition for color change */
}

/* Specific Styles for Each Button */
 a i {
    margin-right: 10px; /* Add space between the icon and text */
}

.fas.fa-edit {
    color: #218838; /* Green color for 'Edit' */
}

.fas.fa-trash-alt {
    color: #c82333; 
}
.fas.fa-eye {
    color: #007bff; /* Blue color for 'View' */
}


/* Hover Effects */
.action-buttons a:hover {
    color: #000; /* Darken text on hover */
}

.action-buttons .btn-view:hover {
    color: #0056b3; /* Darker blue on hover */
}

.btn-edit:hover {
    color: #218838; /* Darker green on hover */
}

.btn-delete:hover {
    color: #c82333; /* Darker red on hover */
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
                 <!--  page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Liste des Proprietaires</h1>
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
                                            <th>Nom</th>
                                            <th>prenom</th>
                                            <th>Sexe</th>
                                            <th>Telephone</th>
                                            <th>email</th>
                                            <th>adresse</th>
                                            <th>Fonction</th>                              
                                            <th>N° de compte</th>                                         
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from pr_list";
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
                  <td><?php  echo htmlentities($row->nom);?></td>
                  <td><?php  echo htmlentities($row->prenom);?></td>
                  <td><?php  echo htmlentities($row->sexe);?></td>
                  <td><?php  echo htmlentities($row->tel);?></td>
                  <td><?php  echo htmlentities($row->email);?></td>
                  <td><?php  echo htmlentities($row->adres);?></td>
                  <td><?php  echo htmlentities($row->ft);?></td>
                  <td><?php  echo htmlentities($row->ncpt);?></td>
                  <td><?php  echo htmlentities($row->PasscreationDate);?></td>
                  <td><a href="view-pro.php?viewid=<?php echo htmlentities ($row->pID);?>"> <i class="fas fa-eye"></i></a><a href="edit-pro.php?editid=<?php echo htmlentities ($row->pID);?>"><i class="fas fa-edit"></i></a><a href="manage-pro.php?delid=<?php echo ($row->pID);?>" onclick="return confirm('Voulez vous supprimer ?');"><i class="fa fa-trash-alt"></i></a></td>
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