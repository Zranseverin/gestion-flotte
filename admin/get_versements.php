<?php
include('includes/dbconnection.php');

if (isset($_POST['chauffeur']) && isset($_POST['mois'])) {
    $chauffeur = $_POST['chauffeur'];
    $mois = $_POST['mois']; // Format: YYYY-MM

    // Requête pour récupérer les versements du chauffeur pour le mois sélectionné, triés par date croissante
    $sql = "SELECT * FROM vsmt_list WHERE CONCAT(nom, ' ', prenom) = :chauffeur AND DATE_FORMAT(date, '%Y-%m') = :mois ORDER BY date ASC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':chauffeur', $chauffeur, PDO::PARAM_STR);
    $query->bindParam(':mois', $mois, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Affichage des données sous forme de tableau
    if ($query->rowCount() > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>S.NO</th><th>Date</th><th>Versement</th></tr></thead>';
        echo '<tbody>';
        $cnt = 1;
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $cnt . '</td>';
            echo '<td>' . htmlentities($row->date) . '</td>';
            echo '<td>' . htmlentities($row->versement) . '</td>';
            echo '</tr>';
            $cnt++;
        }
        echo '</tbody></table>';

        // Calcul de la somme totale des versements
        $sql_sum = "SELECT SUM(versement) as total_versement FROM vsmt_list WHERE CONCAT(nom, ' ', prenom) = :chauffeur AND DATE_FORMAT(date, '%Y-%m') = :mois";
        $query_sum = $dbh->prepare($sql_sum);
        $query_sum->bindParam(':chauffeur', $chauffeur, PDO::PARAM_STR);
        $query_sum->bindParam(':mois', $mois, PDO::PARAM_STR);
        $query_sum->execute();
        $sum_result = $query_sum->fetch(PDO::FETCH_OBJ);
        $total_versement = $sum_result->total_versement;

        echo '<div><strong>Total des versements: ' . number_format($total_versement, 2) . ' FCFA</strong></div>';
    } else {
        echo '<div class="alert alert-warning">Aucun versement trouvé pour ce chauffeur pendant ce mois.</div>';
    }
}
?>
