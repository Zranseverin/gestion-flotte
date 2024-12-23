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

// Vérifier si un permis a été passé en paramètre
if (isset($_GET['permis'])) {
    $permis = mysqli_real_escape_string($conn, $_GET['permis']);
}

// Requête pour obtenir les détails pour un chauffeur spécifique
$query = "
    SELECT 
        nom,
        prenom,
        permis,
        date,
        imt,
        versement,
        pointage,
        recette,
        CreationDate
    FROM vsmt_list
    WHERE permis = '$permis'
";

$result = mysqli_query($conn, $query);

// Afficher un message d'erreur si la requête échoue
if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion flottes soumafe | view vehicules</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=500,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>

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
                    <h1 class="page-header">Detail du versement</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="row" id="divToPrint">
                                <div class="col-lg-12">
                                <table border="1" class="table table-bordered" > 
                                <tr align="center">
        
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Permis</th>
                <th>vehicule</th>
                <th>date</th>
                <th >Versement (FCFA)</th>
                <th>Pointage (FCFA)</th>
                <th>Recette (FCFA)</th>
                
            </tr>
        
        <tbody>
            <?php 
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['permis']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['imt']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['versement']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['pointage']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['recette']) . "</td>";
                   
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucun résultat trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php mysqli_close($conn); ?>
    <a href="#" class="print-button" onclick="window.print(); return false;">Imprimer</a>
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
