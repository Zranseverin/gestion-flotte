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
        $sql = "DELETE FROM depenses WHERE feid = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_INT); // Utilisation correcte de PDO::PARAM_INT

        // Gestion des erreurs
        if ($query->execute()) {
            echo "<script>alert('Données supprimées');</script>";
        } else {
            echo "<script>alert('Erreur lors de la suppression des données');</script>";
        }
        echo "<script>window.location.href = 'manage-depenses.php'</script>";
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
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery et Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
       


    
    </style>

    <div id="wrapper">
        <!-- Navbar -->
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <!-- Page Wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Liste Générale des dépenses</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                               
                            <button type="button" class="btn btn-primary mt-3" id="openFactureSearchModalBtn" data-toggle="modal" data-target="#factureSearchModal">
    Rechercher par numéro de facture
</button>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>véhicule</th>
                                            <th>numero de facture</th>
                                            <th>libellé</th>
                                            <th>Qte</th>
                                            <th>Prix.U</th>
                                            
                                            <th>motant total</th>
                                            <th>date</th>
                                           
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM depenses";
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
                                                    <td><?php echo htmlentities($row->num_f); ?></td>
                                                    <td><?php echo htmlentities($row->libelle_depenses); ?></td>
                                                    <td><?php echo htmlentities($row->quantite_depenses); ?></td>
                                                    <td><?php echo htmlentities($row->montant_depenses); ?></td>
                                                   
                                                    <td><?php echo htmlentities($row->montant_total); ?>
                                                    <td><?php echo htmlentities($row->date); ?></td>
                                                </td>
                                                   
                                                    <td>
                                                        <a href="edit-vst.php?editid=<?php echo htmlentities($row->feid); ?>"><i class="fas fa-edit"></i></a> ||
                                                        <a href="manage-depenses.php?delid=<?php echo htmlentities($row->feid); ?>" onclick="return confirm('Voulez-vous supprimer ?');"><i class="fas fa-trash-alt"></i></a>
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
                                <!-- Fenêtre modale pour la recherche des factures -->
<div class="modal fade" id="factureSearchModal" tabindex="-1" role="dialog" aria-labelledby="factureSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="factureSearchModalLabel">Recherche par numéro de facture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="factureNumModal">Numéro de facture :</label>
                    <input type="text" id="factureNumModal" class="form-control" placeholder="Entrez le numéro de facture">
                </div>

                <!-- Table pour afficher les libellés et montants -->
                <table class="table">
                    <thead>
                        <tr>
                        <th>Libellé Dépense</th>
            <th>Qt</th>
            <th>Prix Unitaire (FCFA)</th>
            <th>Montant (FCFA)</th>
                        </tr>
                    </thead>
                    <tbody id="factureDepensesTableModal"></tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total :</strong></td>
                            <td><strong id="factureTotalModal">0 FCFA</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="searchFactureModalBtn">Rechercher</button>
                <button type="button" id="downloadFactureBtn" class="btn btn-success" data-facture-num="<?php echo htmlentities($row->num_f); ?>">
    Télécharger la Facture
</button>
            </div>
        </div>
    </div>
</div>

                            <a href="add-dp.php" class="btn btn-primary">
    <i class="fas fa-plus"></i> Ajouter une dépenses
</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Fenêtre modale -->
       


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
        $('#searchFacturesBtn').on('click', function() {
            var vehicule = $('#vehiculeRecherche').val(); // Obtenir le véhicule sélectionné

            if (vehicule) {
                $.ajax({
                    url: 'get_factures.php', // Fichier PHP pour gérer la requête
                    type: 'POST',
                    data: { vehicule: vehicule },
                    success: function(data) {
                        $('#facturesResult').html(data); // Afficher les résultats dans la div du modal
                    },
                    error: function() {
                        alert('Erreur lors du chargement des factures.');
                    }
                });
            } else {
                alert('Veuillez sélectionner un véhicule.');
            }
        });
    });
</script>
<script>
   $(document).ready(function() {
    $('#searchFactureModalBtn').on('click', function() {
        var factureNum = $('#factureNumModal').val(); // Numéro de facture depuis la modale

        if (factureNum) {
            $.ajax({
                url: 'get_facture_depenses.php', // URL du script PHP pour traiter la recherche
                type: 'POST',
                data: { factureNum: factureNum },
                success: function(response) {
                    var data = JSON.parse(response); // Supposons que la réponse soit en JSON

                    // Effacer les anciens résultats
                    $('#factureDepensesTableModal').empty();
                    var total = 0;

                    // Parcourir les résultats et les afficher dans la table
                    data.depenses.forEach(function(depense) {
                        $('#factureDepensesTableModal').append('<tr><td>' + depense.libelle + '</td><td>' + depense.montant + '</td></tr>');
                        total += parseFloat(depense.montant); // Ajouter au total
                    });

                    // Afficher le total dans le pied de table
                    $('#factureTotalModal').text(total.toFixed(2) + ' FCFA');
                },
                error: function() {
                    alert('Erreur lors de la recherche des dépenses.');
                }
            });
        } else {
            alert('Veuillez entrer un numéro de facture.');
        }
    });
});


</script>
<script>
$(document).ready(function() {
    $('#searchFactureModalBtn').on('click', function() {
        var factureNum = $('#factureNumModal').val(); // Numéro de facture depuis la modale

        if (factureNum) {
            $.ajax({
                url: 'get_facture_depenses.php', // URL du script PHP pour traiter la recherche
                type: 'POST',
                data: { factureNum: factureNum },
                success: function(response) {
                    var data = JSON.parse(response); // Supposons que la réponse soit en JSON

                    // Effacer les anciens résultats
                    $('#factureDepensesTableModal').empty();
                    var total = 0;

                    // Parcourir les résultats et les afficher dans la table
                    data.depenses.forEach(function(depense) {
                        $('#factureDepensesTableModal').append('<tr><td>' + depense.libelle + '</td><td>' + depense.quantite + '</td><td>' + depense.montant_unitaire + '</td><td>' + depense.montant_total + '</td></tr>');
                        total += parseFloat(depense.montant_total); // Ajouter au total
                    });

                    // Afficher le total dans le pied de table
                    $('#factureTotalModal').text(total.toFixed(2) + ' FCFA');
                },
                error: function() {
                    alert('Erreur lors de la recherche des dépenses.');
                }
            });
        } else {
            alert('Veuillez entrer un numéro de facture.');
        }
    });
});


</script>
<script>
    $(document).ready(function() {
    $('#downloadFactureBtn').on('click', function() {
        var factureNum = $(this).data('facture-num'); // Obtenez le numéro de facture du bouton
        window.location.href = 'download_facture.php?factureNum=' + factureNum; // Redirige vers le script de téléchargement
    });
});

</script>




    </div>
</body>
</html>
<?php } ?>
