
<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | Diagnostique et reparation des pannes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   
    <title>Gestion des flottes Soumafe | Enregistrement des pannes declarées</title>

<!-- Core CSS - Include with every page -->

<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href="assets/css/main-style.css" rel="stylesheet" />
<link rel="stylesheet" href="forme.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="s.css">
   
    
    <!-- Style for layout organization -->
   
       
    </style>
    
   
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Diagnostique et reparation des pannes</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <h1>Gestion des Véhicules</h1>
        <button class="btn" onclick="openModal('panneModal')">Déclarer une panne</button>
        
                            <!-- Modale Déclarer une panne -->
    <div id="panneModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('panneModal')">&times;</span>
            <h2>Déclarer une Panne</h2>
            <form action="save_panne.php" method="POST">
            <div class="col-md-6">
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
                                <label for="heureD">Heure de la déclaration :</label>
                                <input type="time" id="heureD" name="heureD" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Description">Observation :</label>
                                <input type="text" id="Description" name="Description" class="form-control" required>
                            </div>
                        </div>
                <div class="form-group">
                                            <button type="submit" class="btn btn-primary" onclick="return confirmSubmission();">Enregistrer</button>
                                        </div>
            </form>
             <!-- Modal -->
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
                                        $sql = "SELECT * FROM attr_list";
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sélection véhicule
            document.querySelectorAll('.select-client').forEach(button => {
                button.addEventListener('click', () => {
                    const imt = button.dataset.imt;
                    document.getElementById('imt').value = imt;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('vhModal'));
                    modal.hide();
                });
            });

            // Ajouter libellé panne
            document.getElementById('depensesContainer').addEventListener('click', event => {
                if (event.target.id === 'addFacture') {
                    const newPanne = document.createElement('div');
                    newPanne.className = 'depenses d-flex mb-2';
                    newPanne.innerHTML = `
                        <input type="text" name="lib[]" class="form-control me-2" placeholder="Libellé de la panne" required>
                        <button type="button" class="btn btn-danger remove-btn">-</button>;
                        <input type="date" name="dateR[]" class="form-control me-2" placeholder="date de la reparation" required>
                        <button type="button" class="btn btn-danger remove-btn">-</button>`;
                        
                    event.currentTarget.appendChild(newPanne);
                }

                if (event.target.classList.contains('remove-btn')) {
                    event.target.closest('.depenses').remove();
                }
            });
        });
    </script>
    <script>
        // Ouvrir une modale
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        // Fermer une modale
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }
    </script>
</body>

</html>



