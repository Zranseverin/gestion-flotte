<?php
include('includes/dbconnection.php');

if (isset($_POST['vehicule']) && isset($_POST['mois'])) {
    $vehicule = $_POST['vehicule'];
    $mois = $_POST['mois']; // Format: YYYY-MM

    // Requête pour récupérer les recettes du véhicule pour le mois sélectionné, triées par date croissante
    $sql = "SELECT date, recette, 
                   (SELECT SUM(recette) FROM vsmt_list WHERE CONCAT(imt, ' ', marque) = :vehicule AND DATE_FORMAT(date, '%Y-%m') = :mois) as total_recette 
            FROM vsmt_list 
            WHERE CONCAT(imt, ' ', marque) = :vehicule AND DATE_FORMAT(date, '%Y-%m') = :mois 
            ORDER BY date ASC";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicule', $vehicule, PDO::PARAM_STR);
    $query->bindParam(':mois', $mois, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Affichage des données sous forme de tableau
    if ($query->rowCount() > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>S.NO</th><th>Date</th><th>Recette (FCFA)</th></tr></thead>';
        echo '<tbody>';
        $cnt = 1;
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . $cnt . '</td>';
            echo '<td>' . htmlentities($row->date) . '</td>';
            echo '<td>' . number_format(htmlentities($row->recette), 2) . ' FCFA</td>';
            echo '</tr>';
            $cnt++;
        }
        echo '</tbody></table>';

        // Affichage de la somme totale des recettes
        $total_recette = $results[0]->total_recette;
        echo '<div><strong>Total des recettes: ' . number_format($total_recette, 2) . ' FCFA</strong></div>';
    } else {
        echo '<div class="alert alert-warning">Aucune recette trouvée pour ce véhicule pendant ce mois.</div>';
    }
}
?>
