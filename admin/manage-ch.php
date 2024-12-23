<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Vérification de la session
if (strlen($_SESSION['bpmsaid']) == 0) {  // Correction de la condition
    header('location:logout.php');
} else {

    // Suppression d'un chauffeur
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "DELETE FROM chauffeur_list WHERE chID = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_INT);
        $query->execute();
        
        echo "<script>alert('Suppression effectuée');</script>"; 
        echo "<script>window.location.href = 'manage-ch.php';</script>";     
    }

    // Changement de statut d'un chauffeur
    if (isset($_GET['changestatus'])) {
        $chID = intval($_GET['changestatus']);
        $newStatus = $_GET['status'];
    
        $sql = "UPDATE chauffeur_list SET status = :status WHERE chID = :chID";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $newStatus, PDO::PARAM_STR);
        $query->bindParam(':chID', $chID, PDO::PARAM_INT);
    
        if ($query->execute()) {
            echo "<script>alert('Statut modifié avec succès');</script>";
            echo "<script>window.location.href = 'manage-ch.php';</script>";
        } else {
            echo "<script>alert('Erreur lors du changement de statut');</script>";
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
   
    <title>gestion des flottes soumafe| liste des chauffeurs</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
a .fa-times-circle{
    color: red; 
}

</style>
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
                    <h1 class="page-header">Liste des chauffeurs</h1>
                </div>
                 <!-- end  page header -->
            </div>
             <!-- Boutons de filtrage -->
             <div class="row">
    <div class="col-lg-12">
        <button class="btn btn-success" onclick="loadChauffeurs('actif')">Afficher les chauffeurs actifs</button>
        <button class="btn btn-danger" onclick="loadChauffeurs('inactif')">Afficher les chauffeurs inactifs</button>
    </div>
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
                                            <th style="width: 40px;">N°</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th  style="width: 200px;">Domicile</th>
                                            <th>N° permis</th>                                          
                                            <th>Telephone1</th>
                                           
                                           
                                          
                                            <th>statut</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from chauffeur_list";
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
                  <td><?php  echo htmlentities($row->adresse);?></td>
                  <td><?php  echo htmlentities($row->permis);?></td>
                  <td><?php  echo htmlentities($row->telephone1);?></td>
                  
                 
                  <td>
    <?php if ($row->status == "Actif") { ?>
        <span class="badge badge-success"><i class="fas fa-check-circle"></i></span>
        <a href="manage-ch.php?changestatus=<?php echo htmlentities($row->chID); ?>&status=Inactif" class="btn btn-warning btn-sm">Rendre inactif</a>
    <?php } else { ?>
        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
        <a href="manage-ch.php?changestatus=<?php echo htmlentities($row->chID); ?>&status=Actif" class="btn btn-success btn-sm">Rendre actif</a>
    <?php } ?>
</td>
                  <td><a href="view-ch.php?viewid=<?php echo htmlentities ($row->chID);?>" ><i class="fas fa-eye"></i></a>  ||  <a href="edit-ch.php?editid=<?php echo htmlentities ($row->chID);?>"> <i class="fas fa-edit"></i></a> || <a href="manage-ch.php?delid=<?php echo ($row->chID);?>" onclick="return confirm('Voulez vous supprimer ?');"><i class="fas fa-trash-alt"></i></i></a></td>
                </tr>
               <?php $cnt=$cnt+1;}} ?>  
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            <a href="add-ch.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Enr
</a>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
           
        </div>
        <!-- end page-wrapper -->
<!-- Modal for displaying chauffeurs -->
<div class="modal fade" id="chauffeursModal" tabindex="-1" role="dialog" aria-labelledby="chauffeursModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chauffeursModalLabel">Chauffeurs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="chauffeurs-list" style="max-height: 400px; overflow-y: auto;">
                <!-- Dynamic content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
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
     <script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
    
    // Fonction pour charger la liste des chauffeurs via AJAX
    function loadChauffeurs(filter) {
        $.ajax({
            url: 'fetch_chauffeurs.php',
            method: 'POST',
            data: { filter: filter },
            success: function(response) {
                $('#chauffeurs-list').html(response);
                $('#chauffeursModal').modal('show'); // Show the modal after loading data
            }
        });
    }

    // Charger tous les chauffeurs par défaut au chargement de la page
    $(document).ready(function () {
        loadChauffeurs('');
    });
</script>

</body>

</html>
<?php }  ?>