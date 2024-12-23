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
        $sql="delete from vh_list where ID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
         echo "<script>alert('Data deleted');</script>"; 
          echo "<script>window.location.href = 'manage-vh.php'</script>";     
        
        
        }



  ?>
<!DOCTYPE html>
<html>

<head>
   
    <title>gestion des flottes soumafe | Liste des vehicules</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body>
    <style>
      
    /* Style for the icons and links */
a {
    text-decoration: none; /* Remove underline from links */
    color: #007bff; /* Change the color of the text */
    font-weight: bold; /* Make the text bold */
    margin-right: 10px; /* Add some spacing between the links */
}

a:hover {
    color: #0056b3; /* Darker color on hover */
    text-decoration: underline; /* Add underline on hover */
}

/* Style the icons */
a i {
    margin-right: 5px; /* Add space between icon and text */
    font-size: 16px; /* Adjust the size of the icons */
    vertical-align: middle; /* Align icons with text */
}

/* Add color to specific icons */
a .fa-eye {
    color: #28a745; /* Green for the view icon */
}

a .fa-edit {
    color: #ffc107; /* Yellow for the edit icon */
}

a .fa-trash-alt {
    color: #dc3545; /* Red for the delete icon */
}

/* Optional: Add a transition for smooth color change on hover */
a:hover i {
    transition: color 0.3s ease;
}
.fa-clipboard {
    color: red; /* Green for the view icon */
}
.fa-user-shield {
    color: red; /* Green for the view icon */
}
.fa-calendar-alt {
    color: #ff4c33; /* Green for the view icon */
}
.fa-user {
    color: red; /* Green for the view icon */
}
.fa-trademark {
    color: #007bff; /* Green for the view icon */
}
.fa-tasks {
    color: #007bff; /* Green for the view icon */
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
                    <h1 class="page-header">Liste des vehicules</h1>
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
                                           <th><i class="fas fa-clipboard"></i>Immatriculation</th>
                                            <th><i class="fas fa-trademark"></i>Marque</th>
                                            <th><i class="fas fa-tasks"></i>Model</th>                                         
                                            <th><i class="fas fa-calendar-alt"></i>date service</th>
                                            <th><i class="fas fa-user"></i>Nom du proprietaire</th>
                                            <th><i class="fas fa-user-shield"></i>prenom du proprietaire</th>
                                           
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from vh_list";
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
                  <td><?php  echo htmlentities($row->dte);?></td>
                  <td><?php  echo htmlentities($row->nom);?></td>
                  <td><?php  echo htmlentities($row->prenom);?></td>                
                  
                   
                  <td><?php  echo htmlentities($row->PasscreationDate);?></td>
                  <td><a href="view-vh.php?viewid=<?php echo htmlentities ($row->ID);?>"><i class="fas fa-eye"></i></a>  ||  <a href="edit-vh.php?editid=<?php echo htmlentities ($row->ID);?>"><i class="fas fa-edit"></i></a>|| <a href="manage-vh.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Voulez vous supprimer ?');"><i class="fas fa-trash-alt"></i></i></a></td>
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