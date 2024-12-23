<?php
session_start();
error_reporting(E_ALL); // Activer le rapport d'erreurs en phase de développement
include('includes/dbconnection.php');

// Vérifier si l'utilisateur est connecté
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    // Code pour supprimer un produit du panier
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']); // S'assurer que l'ID est un entier
        $sql = "DELETE FROM vsmt_list WHERE vID = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_INT); // Utilisation correcte de PDO::PARAM_INT

        // Gestion des erreurs
        if ($query->execute()) {
            echo "<script>alert('Données supprimées');</script>";
        } else {
            echo "<script>alert('Erreur lors de la suppression des données');</script>";
        }
        echo "<script>window.location.href = 'manage-vst.php'</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestion des flottes Soumafe | Liste des véhicules</title>
    <!-- Core CSS -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <style>
        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            margin-right: 10px;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        a i {
            margin-right: 5px;
            font-size: 16px;
            vertical-align: middle;
        }

        a .fa-eye { color: #28a745; }
        a .fa-edit { color: #ffc107; }
        a .fa-trash-alt { color: #dc3545; }

        a:hover i { transition: color 0.3s ease; }
       
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .left, .centre, .right {
            flex: 1;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], input[type="email"], input[type="file"], input[type="tel"], input[type="number"], input[type="time"], textarea, select {
            border: 2px solid #90EE90;
            border-radius: 4px;
            text-transform: uppercase;
        }
        input:focus, textarea:focus, select:focus {
            border-color: red;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .panel-body {
            padding: 20px;
        }
    
    </style>

    <div id="wrapper">
        <!-- Navbar -->
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <!-- Page Wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Liste Générale des Versements</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form id="versementForm" method="POST">
                                <div class="container">
                                    
                                    <!-- Left Section -->
                                    <div class="left">
                                    <div class="form-group">
                                        <label for="chauffeur">Chauffeur:</label>
                                        <select name="chauffeur" id="chauffeur" class="form-control" required>
                                            <?php
                                            $sql = "SELECT DISTINCT nom, prenom FROM vsmt_list";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $drivers = $query->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($drivers as $driver) {
                                                echo "<option value='{$driver->nom} {$driver->prenom}'>{$driver->nom} {$driver->prenom}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="button" id="showVersementsBtn" class="btn btn-primary"><i class="fas fa-arrow-down" style="font-size:10px; color:green;"></i></button>
                                    </div>
                               
                              
                               <div class="right">
                                    <div class="form-group">
                                        <label for="mois">Mois:</label>
                                        <input type="month" name="mois" id="mois" class="form-control" required>
                                    </div>
                                   

                                   
                                    </div>
                                    <div class="form-group">
                                   
    <label for="vehicule">Véhicule:</label>
    <select name="vehicule" id="vehicule" class="form-control" required>
        <?php
        $sql = "SELECT DISTINCT imt, marque FROM vsmt_list";
        $query = $dbh->prepare($sql);
        $query->execute();
        $vehicles = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($vehicles as $vehicle) {
            echo "<option value='{$vehicle->imt} {$vehicle->marque}'>{$vehicle->imt} {$vehicle->marque}</option>";
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label for="mois_vehicule">Mois:</label>
    <input type="month" name="mois_vehicule" id="mois_vehicule" class="form-control" required>
    <button type="button" id="showRecetteBtn" class="btn btn-primary"><i class="fas fa-arrow-up" style="font-size:10px; color:blue;"></i></button>

</div>


<div class="form-group">
    <label for="date_start">Date de début:</label>
    <input type="date" name="date_start" id="date_start" class="form-control" required>
</div>

<div class="form-group">
    <label for="date_end">Date de fin:</label>
    <input type="date" name="date_end" id="date_end" class="form-control" required>
    <button type="button" id="showVersementsByDateBtn" class="btn btn-primary"><i class="fas fa-search" style="margin-right: 10px;"></i></button>
</div>


</div>


                                    </div>
                                    </div>
                                </form>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Immatriculation</th>
                                            <th>Genre</th>
                                            <th>Permis</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Date Versement</th>
                                            <th>Versement</th>
                                            <th>Pointage</th>
                                            <th>Recette</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM vsmt_list";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;

                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($row->imt); ?></td>
                                                    <td><?php echo htmlentities($row->genres); ?></td>
                                                    <td><?php echo htmlentities($row->permis); ?></td>
                                                    <td><?php echo htmlentities($row->nom); ?></td>
                                                    <td><?php echo htmlentities($row->prenom); ?></td>
                                                    <td><?php echo htmlentities($row->date); ?></td>
                                                    <td><?php echo htmlentities($row->versement); ?></td>
                                                    <td><?php echo htmlentities($row->pointage); ?></td>
                                                    <td><?php echo htmlentities($row->recette); ?></td>
                                                    <td>
                                                        <a href="edit-vst.php?editid=<?php echo htmlentities($row->vID); ?>"><i class="fas fa-edit"></i></a> ||
                                                        <a href="manage-vst.php?delid=<?php echo htmlentities($row->vID); ?>" onclick="return confirm('Voulez-vous supprimer ?');"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $cnt++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                </div>
                            <a href="add-vsmt.php" class="btn btn-primary">
    <i class="fas fa-plus"></i> Ajouter un Versement
</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Fenêtre modale -->
        <div class="modal fade" id="versementsModal" tabindex="-1" role="dialog" aria-labelledby="versementsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="versementsModalLabel">Versements du chauffeur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="versementsContent"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" id="downloadPdfBtn" class="btn btn-success">Télécharger la fiche PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="recetteModal" tabindex="-1" role="dialog" aria-labelledby="recetteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recetteModalLabel">Recette du véhicule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Véhicule</th>
                            <th>Date</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody id="recetteTableBody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="downloadPdfVehiculeBtn" class="btn btn-success">Télécharger la fiche PDF</button></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fenêtre modale pour les versements par date -->
<div class="modal fade" id="versementsByDateModal" tabindex="-1" role="dialog" aria-labelledby="versementsByDateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="versementsByDateModalLabel">Versements du chauffeur par période</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody id="versementsByDateTableBody"></tbody>
                </table>
                <h4>Total: <span id="totalVersements"></span></h4>
            </div>
            <div class="modal-footer">
    <button type="button" id="downloadFileBtn" class="btn btn-success">Télécharger</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
</div>

            </div>
        </div>
    </div>
</div>


        <!-- Scripts -->
        <script src="assets/plugins/jquery-1.10.2.js"></script>
        <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
        <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="assets/plugins/pace/pace.js"></script>
        <script src="assets/scripts/siminta.js"></script>
        <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>

        <script>
            $(document).ready(function() {
                $('#dataTables-example').dataTable();

                $('#showVersementsBtn').on('click', function() {
                    var chauffeur = $('#chauffeur').val();
                    var mois = $('#mois').val();

                    if (chauffeur && mois) {
                        $.ajax({
                            url: 'get_versements.php',
                            type: 'POST',
                            data: { chauffeur: chauffeur, mois: mois },
                            success: function(data) {
                                $('#versementsContent').html(data);
                                $('#versementsModal').modal('show');
                            }
                        });
                    } else {
                        alert('Veuillez sélectionner un chauffeur et un mois.');
                    }
                });

                $('#downloadPdfBtn').on('click', function() {
                    var chauffeur = $('#chauffeur').val();
                    var mois = $('#mois').val();
                    window.location.href = 'generate_pdf.php?chauffeur=' + chauffeur + '&mois=' + mois;
                });
            });
        </script>
        <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();

        $('#showRecetteBtn').on('click', function() {
            var vehicule = $('#vehicule').val(); // Correcte variable pour le véhicule
            var mois = $('#mois_vehicule').val(); // Correcte variable pour le mois

            if (vehicule && mois) {
                $.ajax({
                    url: 'get_recette.php',
                    type: 'POST',
                    data: { vehicule: vehicule, mois: mois },
                    success: function(data) {
                        $('#recetteTableBody').html(data);
                        $('#recetteModal').modal('show');
                    },
                    error: function() {
                        alert('Erreur lors du chargement de la recette.');
                    }
                });
            } else {
                alert('Veuillez sélectionner un véhicule et un mois.');
            }
        });

        $('#downloadPdfVehiculeBtn').on('click', function() {
            var vehicule = $('#vehicule').val();
            var mois = $('#mois_vehicule').val();
            window.location.href = 'generation_pdf.php?vehicule=' + vehicule + '&mois=' + mois;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#showVersementsByDateBtn').on('click', function() {
            var chauffeur = $('#chauffeur').val();
            var dateStart = $('#date_start').val();
            var dateEnd = $('#date_end').val();

            if (chauffeur && dateStart && dateEnd) {
                $.ajax({
                    url: 'get_versements_by_date.php',
                    type: 'POST',
                    data: {
                        chauffeur: chauffeur,
                        date_start: dateStart,
                        date_end: dateEnd
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var tableContent = '';
                        var total = 0;

                        data.versements.forEach(function(versement) {
                            tableContent += '<tr><td>' + versement.date + '</td><td>' + versement.montant + '</td></tr>';
                            total += parseFloat(versement.montant);
                        });

                        $('#versementsByDateTableBody').html(tableContent);
                        $('#totalVersements').text(total.toFixed(2));
                        $('#versementsByDateModal').modal('show');
                    },
                    error: function() {
                        alert('Erreur lors de la récupération des données.');
                    }
                });
            } else {
                alert('Veuillez sélectionner un chauffeur, une date de début et une date de fin.');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#downloadFileBtn').on('click', function() {
            var chauffeur = $('#chauffeur').val();
            var dateStart = $('#date_start').val();
            var dateEnd = $('#date_end').val();

            if (chauffeur && dateStart && dateEnd) {
                // Créer un formulaire temporaire pour soumettre les données à `generate_versements_file.php`
                var form = $('<form action="generate_versements_file.php" method="POST" style="display: none;">');
                form.append('<input type="hidden" name="chauffeur" value="' + chauffeur + '">');
                form.append('<input type="hidden" name="date_start" value="' + dateStart + '">');
                form.append('<input type="hidden" name="date_end" value="' + dateEnd + '">');
                $('body').append(form);
                form.submit(); // Soumettre le formulaire pour télécharger le fichier
            } else {
                alert('Veuillez sélectionner un chauffeur, une date de début et une date de fin.');
            }
        });
    });
</script>
<script>
// Exemple de traitement côté client
fetch('manage-vst.php', {
    method: 'POST',
    body: new FormData(form) // Remplacer 'form' par votre formulaire
})
.then(response => response.json())
.then(data => {
    let versements = data.versements;
    versements.forEach(versement => {
        let versementElement = document.createElement('div');
        versementElement.textContent = `Date: ${versement.date}, Montant: ${versement.montant}`;
        versementElement.style.color = versement.color; // Appliquer la couleur
        document.body.appendChild(versementElement); // Ajouter à la page
    });
})
.catch(error => console.error('Erreur:', error));


</script>
    </div>
</body>
</html>
<?php } ?>
