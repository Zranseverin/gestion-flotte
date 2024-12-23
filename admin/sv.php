<?php
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $vehicle = trim($_POST['vehicle']);
    $month = trim($_POST['month']);

    if (empty($vehicle) || empty($month)) {
        echo '<p class="text-danger">Veuillez sélectionner un véhicule et un mois.</p>';
        exit;
    }

    try {
        // Requête SQL
        $sql = "SELECT 
                    date, 
                    hd AS heure_depart, 
                    ha AS heure_arrivee, 
                    dkm AS kilometrage_depart, 
                    akm AS kilometrage_arrivee, 
                    totkm AS kilometrage_parcourus, 
                    tth AS temps_total
                FROM svi_list 
                WHERE imt = :vehicle AND DATE_FORMAT(date, '%Y-%m') = :month";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicle', $vehicle, PDO::PARAM_STR);
        $query->bindParam(':month', $month, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $totalKilometrage = 0;
            $totalHeures = 0;

            echo '<table class="table table-striped table-bordered">';
            echo '<thead><tr>
                    <th>Date</th>
                    <th>Heure Départ</th>
                    <th>Heure Arrivée</th>
                    <th>KM Départ</th>
                    <th>KM Arrivée</th>
                    <th>KM Parcourus</th>
                    <th>Temps Total</th>
                  </tr></thead><tbody>';

            foreach ($results as $row) {
                $totalKilometrage += (float)$row->kilometrage_parcourus;
                $totalHeures += (float)$row->temps_total;

                echo '<tr>';
                echo '<td>' . htmlentities($row->date) . '</td>';
                echo '<td>' . htmlentities($row->heure_depart) . '</td>';
                echo '<td>' . htmlentities($row->heure_arrivee) . '</td>';
                echo '<td>' . htmlentities($row->kilometrage_depart) . '</td>';
                echo '<td>' . htmlentities($row->kilometrage_arrivee) . '</td>';
                echo '<td>' . htmlentities($row->kilometrage_parcourus) . '</td>';
                echo '<td>' . htmlentities($row->temps_total) . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
            echo '<p><strong>Total Kilométrage Parcouru :</strong> ' . $totalKilometrage . ' km</p>';
            echo '<p><strong>Total Temps Parcouru :</strong> ' . $totalHeures . ' heures</p>';
        } else {
            echo '<p class="text-warning">Aucune donnée trouvée pour ce véhicule et ce mois.</p>';
        }
    } catch (Exception $e) {
        echo '<p class="text-danger">Erreur : ' . $e->getMessage() . '</p>';
    }
}
?>
 <div class="container mt-5">
    <!-- Bouton pour afficher le modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
        Filtrer par véhicule et mois
    </button>

    <!-- Modal -->
    <div class="container mt-5">
        <h2 class="text-center">Filtrer Kilométrage par Véhicule et Mois</h2>
        <div class="form-group">
            <label for="vehicle">Véhicule (Immatriculation):</label>
            <select name="vehicle" id="vehicle" class="form-control" required>
                <option value="">Sélectionner un véhicule</option>
                <?php
               
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
        <button type="button" id="filterButton" class="btn btn-primary">Afficher Kilométrage</button>

        <!-- Résultats -->
        <div id="resultsSection" class="mt-4"></div>
    </div>

    <script>
        $(document).ready(function () {
            $('#filterButton').click(function () {
                const vehicle = $('#vehicle').val();
                const month = $('#month').val();

                if (vehicle && month) {
                    $.ajax({
                        url: 'filter_data.php', // Fichier PHP pour gérer la requête
                        type: 'POST',
                        data: { vehicle: vehicle, month: month },
                        success: function (response) {
                            $('#resultsSection').html(response); // Affiche les résultats dans la section dédiée
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
        // Crée une nouvelle instance de la date actuelle
        const currentDateForEnd = new Date();

        // Ajoute un mois à la date actuelle pour la date de fin
        currentDateForEnd.setMonth(currentDateForEnd.getMonth() - 1);

        // Formate la date au format 'YYYY-MM-DD'
        const formattedEndDate = currentDateForEnd.toISOString().split('T')[0];

        // Définit la valeur du champ de date de fin avec la date de 1 mois plus tard
        document.getElementById('date_fin').value = formattedEndDate;
    </script>