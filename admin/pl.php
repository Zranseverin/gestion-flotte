<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestion des Flottes | Ajouter un Modèle</title>
    
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Bootstrap JS (avec Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Navbar Top -->
        <?php include_once('includes/header.php'); ?>
        <!-- End Navbar Top -->

        <!-- Navbar Side -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- End Navbar Side -->

        <!-- Page Wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Ajouter une Déclaration de Panne</h1>
                </div>
                <!-- End Page Header -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container">
                                        <h2 class="text-center">Déclaration des Pannes</h2>
                                        <form method="post" action="">
                                            <!-- Sélection du véhicule -->
                                           <!-- Sélection du véhicule -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vhModal">Sélectionnez le véhicule</button>
<div class="form-group mt-3">
    <label for="imt">Immatriculation :</label>
    <input type="text" id="imt" name="imt" class="form-control" required readonly>
</div>

                                            <!-- Informations de la panne -->
                                            <div class="form-group mt-3">
                                                <label for="dateD">Date de la déclaration :</label>
                                                <input type="date" id="dateD" name="dateD" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="heureD">Heure de la déclaration :</label>
                                                <input type="time" id="heureD" name="heureD" class="form-control" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="Description">Observation :</label>
                                                <input type="text" id="Description" name="Description" class="form-control" required>
                                            </div>

                                            <!-- Pannes déclarées -->
                                            <h4 class="mt-4">Pannes déclarées</h4>
                                            <div id="depensesContainer">
                                                <div class="depenses">
                                                    <input type="text" name="lib[]" class="form-control" placeholder="Libellé de la panne" required>
                                                    <button type="button" id="addFacture"><i class="fas fa-plus"></i></button>
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="dateR">Date de la réparation :</label>
                                                    <input type="date" id="dateR" name="dateR" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                                </div>
                                            </div>

                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-success" name="submit">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Modal pour sélectionner le véhicule -->
                                   <!-- Modal pour sélectionner le véhicule -->
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


    <!-- Bootstrap JS (avec Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript dynamique -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gestion du clic sur "Sélectionner" dans le modal
            document.querySelectorAll('.select-client').forEach(button => {
                button.addEventListener('click', function () {
                    const Immatriculation = this.getAttribute('data-imt');
                    document.getElementById('imt').value = Immatriculation;

                    const modal = bootstrap.Modal.getInstance(document.getElementById('vhModal'));
                    modal.hide();
                });
            });

            // Ajouter de nouveaux libellés de panne
            const addFactureBtn = document.getElementById('addFacture');
            const depensesContainer = document.getElementById('depensesContainer');
            
            addFactureBtn.addEventListener('click', function () {
                const newDepense = document.createElement('div');
                newDepense.classList.add('depenses');
                newDepense.innerHTML = `<input type="text" name="lib[]" class="form-control" placeholder="Libellé de la panne" required>
                                        <button type="button" class="remove-btn"><i class="fas fa-trash"></i></button>`;
                depensesContainer.appendChild(newDepense);

                newDepense.querySelector('.remove-btn').addEventListener('click', function () {
                    depensesContainer.removeChild(newDepense);
                });
            });
        });
    </script>
</body>

</html>
