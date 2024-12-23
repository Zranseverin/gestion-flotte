<?php
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle = $_POST['vehicle'];
    $month = $_POST['month'];

    $sql = "SELECT date, dkm, akm, totkm FROM svi_list WHERE imt = :vehicle AND DATE_FORMAT(date, '%Y-%m') = :month";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicle', $vehicle, PDO::PARAM_STR);
    $query->bindParam(':month', $month, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Date</th><th>KM Départ</th><th>KM Arrivée</th><th>KM Parcourus</th></tr></thead><tbody>';
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . htmlentities($row->date) . '</td>';
            echo '<td>' . htmlentities($row->dkm) . '</td>';
            echo '<td>' . htmlentities($row->akm) . '</td>';
            echo '<td>' . htmlentities($row->totkm) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>Aucune donnée trouvée pour ce véhicule et ce mois.</p>';
    }
}
?>
