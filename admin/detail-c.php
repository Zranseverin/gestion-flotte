<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buspassdb";

// Création de la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Requête pour calculer les sommes
$query = "
    SELECT  
        permis,
        nom,
        prenom,
        SUM(versement) AS total_versement,
        SUM(pointage) AS total_pointage,
        SUM(recette) AS total_recette
    FROM vsmt_list
    GROUP BY permis
";

$result = mysqli_query($conn, $query);

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
                    <h1 class="page-header">Versement de chaque chauffeurs</h1>
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
            <th>permis</th>
            <th>nom</th>
            <th>prenom</th>
            <th>Total Versement (FCFA)</th>
            <th>Total Pointage (FCFA)</th>
            <th>Total Recette (FCFA)</th>
        </tr>
        </thead>
        <?php 
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['permis']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['total_versement']) . "</td>";
                echo "<td>" . htmlspecialchars($row['total_pointage']) . "</td>";
                echo "<td>" . htmlspecialchars($row['total_recette']) . "</td>";
                echo'<td><a href="detail-v-c.php?permis='. htmlspecialchars($row['permis']).'&amp permis='. htmlspecialchars($row['permis']).'">Détail</a></td>';
                echo "</tr>";
				
	         print"</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Aucun résultat trouvé</td></tr>";
        }
        ?>
    </table>

    <?php mysqli_close($conn); ?>
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
