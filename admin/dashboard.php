<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    
  ?>
<!DOCTYPE html>
<html>

<head>
    
    <title>gestion flotte| Dashboard</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />
      <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

</head>

<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/footer.php');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--end page header -->
            </div>

            <div class="row">
                <!--quick info section -->
                <div class="col-lg-4">
                     
                    <div class="alert alert-danger text-center">
                        <?php 
$sql ="SELECT ID from vh_list ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalcat=$query->rowCount();
?><div class="panel-body red">
                        <i class="fa fa-calendar fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo htmlentities($totalcat);?> </b><a href="manage-vh.php">vehicules</a> 
</div>

                    </div>
                </div>
                <div class="col-lg-4">
                     
                     <div class="alert alert-danger text-center">
                         <?php 
 $sql ="SELECT ID from chauffeur_list ";
 $query = $dbh -> prepare($sql);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 $totalcat=$query->rowCount();
 ?><div class="panel-body red">
                         <i class="fa fa-calendar fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo htmlentities($totalcat);?> </b><a href="manage-ch.php">chauffeurs</a> 
 </div>
 
                     </div>
                 </div>
                <div class="col-lg-4">
                    
                    <div class="alert alert-success text-center">
                        <?php 
$sql ="SELECT ID from chauffeur_list";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalpass=$query->rowCount();
?><div class="panel-body yellow">
                        <i class="fa  fa-beer fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo htmlentities($totalch);?></b><a href="manage-ch.php"> Total chauffeur</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-info text-center">
 <?php 
//todays Pass Generated
 

$sql ="SELECT ID from chauffeur_list where date(PasscreationDate)=CURDATE()";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$today_pass=$query->rowCount();
?>
 <div class="panel-body red">
                        <i class="fa fa-pencil-square-o fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo htmlentities($today_chauffeur);?></b> <a href="todays-pass.php">chauffeur Created Today</a>
</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-warning text-center">
                       <?php 
//Yesterday Pass Generated
 

$sql ="SELECT ID from chauffeur_list where date(PasscreationDate)=CURDATE()-1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$yes_pass=$query->rowCount();
?><div class="panel-body yellow">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo htmlentities($yes_chauffeur);?></b> <a href="yesterdays-pass.php">chauffeur Created Yesterday </a>
                    </div>
                    </div>
                </div>
                  <div class="col-lg-4">
                    <div class="alert alert-info text-center">
                       <?php 
//7 days Pass Generated
 

$sql ="SELECT ID from chauffeur_list where date(PasscreationDate)>=(DATE(NOW()) - INTERVAL 7 DAY)";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$seven_pass=$query->rowCount();
?><div class="panel-body green">
                        <i class="fa  fa-pencil fa-3x"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo htmlentities($seven_chauffeur);?></b> <a href="last-7days-pass.php">chauffeur Created in Seven Days</a>
</div>
                    </div>
                </div>
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
        marque,
        imt,
        SUM(versement) AS total_versement,
        SUM(pointage) AS total_pointage,
        SUM(recette) AS total_recette
    FROM vsmt_list
    GROUP BY imt
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Flottes Soumafe | Liste des Chauffeurs</title>
    
</head>
<body>
    <div id="wrapper">
        <!-- Navbar top -->
        <?php include_once('includes/header.php'); ?>
        
        <!-- Navbar side -->
        <?php include_once('includes/sidebar.php'); ?>

        <!-- Page wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Versement de chaque véhicule</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                
                            </div>
                            
                            <!-- Ajout des graphiques -->
                            <canvas id="barChart"></canvas>
                            <canvas id="lineChart" style="margin-top: 40px;"></canvas>

                            <script>
                                var labels = [];
                                var versements = [];
                                
                                var recettes = [];

                                <?php 
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "labels.push('". htmlspecialchars($row['imt']) ."');";
                                        echo "versements.push(". htmlspecialchars($row['total_versement']) .");";
                                        
                                        echo "recettes.push(". htmlspecialchars($row['total_recette']) .");";
                                    }
                                }
                                ?>

                                // Diagramme en bande (Bar Chart)
                                var ctxBar = document.getElementById('barChart').getContext('2d');
                                var barChart = new Chart(ctxBar, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [
                                            {
                                                label: 'Versement (FCFA)',
                                                data: versements,
                                                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                borderWidth: 1
                                            },
                                            
                                            {
                                                label: 'Recette (FCFA)',
                                                data: recettes,
                                                backgroundColor: 'rgba(255, 159, 64, 0.5)',
                                                borderColor: 'rgba(255, 159, 64, 1)',
                                                borderWidth: 1
                                            }
                                        ]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

                                // Courbe d'évolution (Line Chart)
                                var ctxLine = document.getElementById('lineChart').getContext('2d');
                                var lineChart = new Chart(ctxLine, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [
                                            {
                                                label: 'Versement (FCFA)',
                                                data: versements,
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                fill: false,
                                                tension: 0.1
                                            },
                                            {
                                                label: 'Pointage (FCFA)',
                                                data: pointages,
                                                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                                borderColor: 'rgba(153, 102, 255, 1)',
                                                fill: false,
                                                tension: 0.1
                                            },
                                            {
                                                label: 'Recette (FCFA)',
                                                data: recettes,
                                                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                                borderColor: 'rgba(255, 159, 64, 1)',
                                                fill: false,
                                                tension: 0.1
                                            }
                                        ]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });


                                
                            </script>
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
        marque,
        imt,
        (tth) AS tth,
        (totkm) AS totkm
    FROM svi_list
    GROUP BY imt
";
$result = mysqli_query($conn, $query);
?>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                
                            </div>
                            
                            <!-- Ajout des graphiques -->
                            <canvas id="barChart"></canvas>
                            <canvas id="lineChart" style="margin-top: 40px;"></canvas>
                            <script>
document.addEventListener("DOMContentLoaded", function() {
    // Récupérer les données des lignes dans la table
    var labels = [];
    var totKm = [];

    <?php 
    // Utiliser les données extraites pour remplir les labels et les kilomètres totaux
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "labels.push('" . $row['date'] . "');";
            echo "totKm.push(" . $row['totkm'] . ");";
        }
    }
    ?>

    // Création du diagramme circulaire
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels, // Les dates
            datasets: [{
                label: 'Kilométrage total',
                data: totKm, // Les totaux des kilomètres
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
});
</script>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Scripts -->
        
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
        </script>
        
    </div>
                <!--end quick info section -->
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

</body>
</html>

<?php mysqli_close($conn); ?>

</html>
<?php }  ?>
