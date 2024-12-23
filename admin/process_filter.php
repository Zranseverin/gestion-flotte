<?php
// Inclure la connexion à la base de données
require_once 'db_connection.php';

if (isset($_POST['vehicle']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $vehicle = $_POST['vehicle'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Requête SQL pour récupérer les données filtrées
    $sql = "SELECT * FROM declaration_list WHERE date BETWEEN :startDate AND :endDate";
    
    // Si un véhicule est sélectionné, ajouter un filtre
    if ($vehicle != '') {
        $sql .= " AND imt = :vehicle";
    }
    
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    
    if ($vehicle != '') {
        $stmt->bindParam(':vehicle', $vehicle);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Générer et afficher les résultats
    if ($results) {
        foreach ($results as $row) {
            echo '<div class="result">';
            echo '<p><strong>Véhicule:</strong> ' . htmlspecialchars($row['imt']) . '</p>';
            echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['date']) . '</p>';
            // Ajouter d'autres champs que vous souhaitez afficher
            echo '</div>';
        }
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }
}
?>
