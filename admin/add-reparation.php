<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | Diagnostique et réparation des pannes</title>
    <!-- Core CSS -->
   
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="forme.css">
    <link rel="stylesheet" href="stule1.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Style pour les modales personnalisées */
        

        .modal-content {
            margin: auto;
            padding: 20px;
            background:#90EE90;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.14);
        }

        .close {
            float: right;
            font-size: 1.5em;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Diagnostique et réparation des pannes</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h2>Gestion des Véhicules</h2>
                            <button class="btn btn-primary" onclick="openModal('panneModal')">
                                <i class="fas fa-tools"></i> Réparation des pannes
                            </button>
                            <button class="btn btn-primary" onclick="openModal('diagnModal')">
                                <i class="fas fa-tools"></i> Diagnostiquer les pannes
                            </button>

                            <!-- Modale Déclarer une panne -->
                            <div id="panneModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('panneModal')">&times;</span>
                                    <h2>Réparation des pannes</h2>
                                    <form action="save_panne.php" method="POST">
                                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#vhModal">Sélectionnez le véhicule</button>
                            <div class="form-group">
                                <label for="imt">Immatriculation :</label>
                                <input type="text" id="imt" name="imt" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="dateD">Date de la déclaration :</label>
                                <input type="date" id="dateD" name="dateD" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">Date de la reparation :</label>
                                <input type="date" id="dateR" name="dateR" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="heureD">Heure de la déclaration :</label>
                                <input type="time" id="heureD" name="heureD" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">Heure de la reparation :</label>
                                <input type="date" id="heureR" name="heureR" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">garage :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">responsable :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">date de sortie :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">heure de sortie :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dateD">status :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Description">Observation :</label>
                                <input type="text" id="Description" name="Description" class="form-control" required>
                            </div>
                           
                                        <button type="submit" class="btn btn-success" onclick="return confirmSubmission();">
                                            <i class="fas fa-save"></i> Enregistrer
                                        </button>
                                    </form>
                                    <div class="modal fade" id="vhModal" tabindex="-1" aria-labelledby="vhModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vhModalLabel">Liste des Véhicules</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM declaration_list";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($row->imt); ?></td>
                                                    <td>
                                                        <button class="btn btn-success select-client" data-imt="<?php echo htmlentities($row->imt); ?>">Sélectionner</button>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
                            </div>
                            <!-- ---------------------------------------->
                            <div id="diagnModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal('diagnModal')">&times;</span>
                                    <h2>Diagnostique des pannes</h2>
                                    <form action="">
                                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#vihModal">Sélectionnez le véhicule</button>
                            <div class="form-group">
                                <label for="imt">Immatriculation :</label>
                                <input type="text" id="imt" name="imt" class="form-control" required readonly>
                            </div>
                                    <div class="form-group">
                                <label for="dateD">date de la dignostique :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="Description">resultat de la dignostique :</label>
                                <input type="text" id="Description" name="Description" class="form-control" required>
                            </div>
                           
                            <div class="form-group">
                                <label for="dateD">status :</label>
                                <input type="date" id="garage" name="garage" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                                   
                                        <button type="submit" class="btn btn-success" onclick="return confirmSubmission();">
                                            <i class="fas fa-save"></i> Enregistrer
                                        </button>
                                    </form>
                                    <div class="modal fade" id="vihModal" tabindex="-1" aria-labelledby="vihModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vihModalLabel">Liste des Véhicules</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM declaration_list";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($row->imt); ?></td>
                                                    <td>
                                                        <button class="btn btn-success select-client" data-imt="<?php echo htmlentities($row->imt); ?>">Sélectionner</button>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>
                            </div>

                            <!-- Modal pour sélectionner un véhicule -->
                            <div class="modal fade" id="vhModal" tabindex="-1" aria-labelledby="vhModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="vhModalLabel">Liste des Véhicules</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Immatriculation</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM declaration_list";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $row) { ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($row->imt); ?></td>
                                                                <td>
                                                                    <button class="btn btn-success select-client" data-imt="<?php echo htmlentities($row->imt); ?>">Sélectionner</button>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin Modal -->
                              <!-- Modal pour sélectionner un véhicule -->
                            <div class="modal fade" id="vihModal" tabindex="-1" aria-labelledby="vihModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="vihModalLabel">Liste des Véhicules</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Immatriculation</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM declaration_list";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $row) { ?>
                                                            <tr>
                                                                <td><?php echo htmlentities($row->imt); ?></td>
                                                                <td>
                                                                    <button class="btn btn-success select-client" data-imt="<?php echo htmlentities($row->imt); ?>">Sélectionner</button>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction de confirmation avant soumission
        function confirmSubmission() {
            return confirm("Êtes-vous sûr de vouloir enregistrer cette déclaration ?");
        }

        // Gestion des modales personnalisées
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Sélectionner un véhicule dans la liste
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.select-client').forEach(button => {
                button.addEventListener('click', () => {
                    const imt = button.dataset.imt;
                    document.getElementById('imt').value = imt;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('vhModal'));
                    modal.hide();
                });
            });
        });
        // Sélectionner un véhicule dans la liste
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.select-client').forEach(button => {
                button.addEventListener('click', () => {
                    const imt = button.dataset.imt;
                    document.getElementById('imt').value = imt;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('vihModal'));
                    modal.hide();
                });
            });
        });
        
    </script>
</body>

</html>
