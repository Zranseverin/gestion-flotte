<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buspassdb";

// Créer la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialiser la variable $permis
$permis = '';

// Vérifier si le formulaire a été soumis
if (isset($_POST['permis'])) {
    $permis = mysqli_real_escape_string($conn, $_POST['permis']);
}

// Exécuter la requête seulement si $permis est défini
if ($permis !== '') {
    // Requête pour obtenir les sommes pour un chauffeur spécifique
    $query = "
        SELECT 
            nom,
            prenom,
            permis,
            SUM(CAST(versement AS DECIMAL(10, 2))) AS total_versement,
            SUM(CAST(pointage AS DECIMAL(10, 2))) AS total_pointage,
            SUM(CAST(recette AS DECIMAL(10, 2))) AS total_recette
        FROM vsmt_list
        WHERE permis = '$permis'
        GROUP BY permis
    ";

    $result = mysqli_query($conn, $query);

    // Afficher un message d'erreur si la requête échoue
    if (!$result) {
        die("Erreur dans la requête : " . mysqli_error($conn));
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
                            <div class="search-box">
        <form action="" method="POST">
            <label for="permis">Permis :</label>
            <input type="text" id="permis" name="permis" value="<?php echo htmlspecialchars($permis); ?>" required>
            <input type="submit" value="Rechercher">
        </form>
    </div>
                            <?php if ($permis !== '' && isset($result)): ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

    

   
       
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Permis</th>
                    <th>Total Versement (FCFA)</th>
                    <th>Total Pointage (FCFA)</th>
                    <th>Total Recette (FCFA)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['permis']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_versement']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_pointage']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_recette']) . "</td>";
                        echo'<td><a href="detail-v-c.php?permis='. htmlspecialchars($row['permis']).'&amp permis='. htmlspecialchars($row['permis']).'">Détail</a></td>';
                        echo "</tr>";
                       
	         print"</tr>";  
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucun résultat trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>

    <?php endif; ?>

    <?php mysqli_close($conn); ?>
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
