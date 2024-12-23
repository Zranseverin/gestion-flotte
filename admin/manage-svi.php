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
        $sql="delete from svi_list where kID=:rid";
        $query=$dbh->prepare($sql);
        $query->bindParam(':rid',$rid,PDO::PARAM_STR);
        $query->execute();
         echo "<script>alert('suppression de donnée');</script>"; 
          echo "<script>window.location.href = 'manage-svi.php'</script>";     
        
        
        }



  ?>
<!DOCTYPE html>
<html>

<head>
   
    <title>gestion des flottes soumafe | suvi des véhicules</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>

<body><style>


.custom-modal .modal-dialog {
    max-width: 3000%; /* Augmente la largeur de la modal */
}
    .table {
    width: 100%; /* Tableau plein écran */
    table-layout: auto; /* Ajuste la largeur des colonnes automatiquement */
}

th, td {
    padding: 15px;
    text-align: left;
    height: 70px; /* Hauteur accrue */
}

th:nth-child(8), td:nth-child(8) {
    width: 250px; /* Colonne Observation plus large */
}

.custom-modal .modal-dialog {
    max-width: 90%; /* Largeur accrue de la modal */
}

.modal-body {
    max-height: 600px; /* Hauteur maximum pour le contenu */
    overflow-y: auto; /* Barre de défilement verticale */
}



.modal-dialog.custom-modal {
            max-width: 90% !important;
            max-height: 90% !important;
            margin: auto !important;
        }

        .modal-dialog.custom-modal .modal-content {
            height: 100% !important;
            overflow-y: auto !important;
            padding: 20px !important;
        }
        /* Style général pour toutes les icônes */
i.fas {
    font-size: 20px;        /* Taille des icônes */
    margin: 0 10px;         /* Espacement entre les icônes */
    cursor: pointer;        /* Affiche le curseur de type "main" */
    transition: all 0.2s ease; /* Animation douce sur hover */
}

/* Icône de suppression (trash) */
i.fa-trash {
    color: #dc3545;         /* Couleur rouge danger par défaut */
}

i.fa-trash:hover {
    color: #a71d2a;         /* Rouge plus foncé au survol */
    transform : scale(1.2);
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
                    <h1 class="page-header">Liste des kilometrages</h1>
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
                                <div class="container mt-5">
    <!-- Titre de la page -->
    <h2 class="text-center">Kilométrage par Véhicule</h2>

    <!-- Boutons pour ouvrir les modals -->
    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModalMonth">
            Recherche pas mois
        </button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#filterModalDates">
            Recherche avec deux date
        </button>
    </div>
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                           <th>Immatriculation</th>
                                          
                                           
                                            <th>date</th>
                                            <th>heure depart</th>
                                            <th>heure d'arrivé</th>
                                            <th>parcouruis</th>
                                            <th>km depart</th>
                                            <th>km d'arrivé</th>
                                            <th>km parcouruis</th>
                                            <th>observation</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$sql="SELECT * from svi_list";
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
                  <td><?php  echo htmlentities($row->date);?></td>
                  <td><?php  echo htmlentities($row->hd);?></td>
                  <td><?php  echo htmlentities($row->ha);?></td>
                  <td><?php  echo htmlentities($row->tth);?></td>
                  <td><?php  echo htmlentities($row->dkm);?></td>
                  <td><?php  echo htmlentities($row->akm);?></td>
                  <td><?php  echo htmlentities($row->totkm);?></td>
                  <td><?php  echo htmlentities($row->ob);?></td>


                   
                  
                  <td> <a href="edit-svi.php?editid=<?php echo htmlentities ($row->kID);?>"><i class="fas fa-edit"></i></a>||<a href="manage-svi.php?delid=<?php echo ($row->kID);?>" onclick="return confirm('Voulez vous supprimer ?');"><i class="fas fa-trash text-danger"></i></a></td>
                </tr>
               <?php $cnt=$cnt+1;}} ?>  
                                       
                                        
                                    </tbody>
                                </table>
                                <!-- Modal pour Filtrer par Véhicule et Mois -->
<div class="modal fade" id="filterModalMonth" tabindex="-1" role="dialog" aria-labelledby="filterModalLabelMonth" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabelMonth">Filtrer par Véhicule et Mois</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="vehicle">Véhicule (Immatriculation):</label>
                    <select name="vehicle" id="vehicleMonth" class="form-control" required>
                        <option value="">Sélectionner un véhicule</option>
                        <?php
                        // Récupération des véhicules depuis la base de données
                        include('includes/dbconnection.php');
                        $sql = "SELECT DISTINCT imt FROM svi_list";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $vehicles = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($vehicles as $vehicle) {
                            echo '<option value="' . htmlentities($vehicle->imt) . '">' . htmlentities($vehicle->imt) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="month">Mois:</label>
                    <input type="month" name="month" id="month" class="form-control" required>
                </div>
                <button type="button" id="filterButton" class="btn btn-primary">Afficher Kilométrages</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour Filtrer par Véhicule et Dates -->
<div class="modal fade" id="filterModalDates" tabindex="-1" role="dialog" aria-labelledby="filterModalLabelDates" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabelDates">Recherch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="vehicle">Véhicule (Immatriculation):</label>
                    <select name="vehicle" id="vehicleDates" class="form-control" required>
                        <option value="">Sélectionner un véhicule</option>
                        <?php
                        foreach ($vehicles as $vehicle) {
                            echo '<option value="' . htmlentities($vehicle->imt) . '">' . htmlentities($vehicle->imt) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
    <label for="date_debut">Date de début:</label>
    <input type="date" name="date_debut" id="date_debut" class="form-control" required>
    <script>
        // Crée une nouvelle instance de la date actuelle
        const currentDateForEnd = new Date();

        // Ajoute un mois à la date actuelle pour la date de fin
        currentDateForEnd.setMonth(currentDateForEnd.getMonth() - 1);

        // Formate la date au format 'YYYY-MM-DD'
        const formattedEndDate = currentDateForEnd.toISOString().split('T')[0];

        // Définit la valeur du champ de date de fin avec la date de 1 mois plus tard
        document.getElementById('date_debut').value = formattedEndDate;
    </script>
</div>

<div class="form-group">
    <label for="date_fin">Date de fin:</label>
    <input type="date" name="date_fin" id="date_fin" class="form-control" required>
    <script>
        // Récupère la date actuelle au format 'YYYY-MM-DD'
        const currentDate = new Date().toISOString().split('T')[0];

        // Définit la valeur par défaut du champ de date de début avec la date actuelle
        document.getElementById('date_fin').value = currentDate;
    </script>
</div>


                <button type="button" id="dateFilterButton" class="btn btn-primary">Afficher Données</button>
            </div>
        </div>
    </div>
</div>


        <!-- Résultats Modal -->
        <div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="resultsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resultsModalLabel">Résultats Kilométrage</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="resultsSection"></div> <!-- Les résultats seront injectés ici -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="resultsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultsModalLabel">Résultats</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Section où les résultats par deux dates seront affichés -->
                <div id="resultsSection"></div>
            </div>
        </div>
    </div>
</div>
<!-- Modal: Résultats -->
<div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="resultsModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultsModalLabel">Résultats Kilométrage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenu -->
            </div>
        </div>
    </div>
</div>
    <script>
       $(document).ready(function () {
    $('#filterButton').click(function () {
        const vehicle = $('#vehicleMonth').val();
        const month = $('#month').val();

        if (vehicle && month) {
            $.ajax({
                url: 'filter_data.php', 
                type: 'POST',
                data: { vehicle: vehicle, month: month },
                success: function (response) {
                    $('#resultsSection').html(response);
                    $('#filterModalMonth').modal('hide');
                    $('#resultsModal').modal('show');
                },
                error: function () {
                    alert("Erreur lors de la requête.");
                }
            });
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    });
});
    </script>
    <script>
   document.getElementById('dateFilterButton').addEventListener('click', function() {
    const vehicle = document.getElementById('vehicleDates').value;
    const dateDebut = document.getElementById('date_debut').value;
    const dateFin = document.getElementById('date_fin').value;

    if (vehicle && dateDebut && dateFin) {
        const url = `filter_results.php?vehicle=${vehicle}&date_debut=${dateDebut}&date_fin=${dateFin}`;
        
        // Utilisation d'AJAX pour récupérer les résultats
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('resultsSection').innerHTML = data;
                $('#resultsModal').modal('show'); // Afficher le modal avec les résultats
            })
            .catch(error => {
                alert("Erreur de récupération des données.");
            });
    } else {
        alert("Veuillez remplir tous les champs !");
    }
});


</script>

    
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