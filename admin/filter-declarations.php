<?php
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier les valeurs envoyées par le formulaire
    $vehicle = $_POST['vehicle'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    try {
        $sql = "SELECT 
                    l.id_libelle, 
                    l.lib, 
                    l.dateR, 
                    l.description, 
                    d.dateD, 
                    d.heureD
                FROM 
                    libelle_list l
                JOIN 
                    declaration_list d ON l.id_declaration = d.id_declaration
                WHERE 
                    d.imt = :vehicle AND d.dateD BETWEEN :startDate AND :endDate";
        
        // Préparer la requête
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicle', $vehicle, PDO::PARAM_STR);
        $query->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $query->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $query->execute();

        // Vérifier si des résultats sont retournés
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            echo '<h1 class="page-header">Libellés des pannes pour l\'immatriculation : ' . htmlentities($vehicle) . '</h1>';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Libellé</th>';
            echo '<th>Description</th>';
            echo '<th>Date Déclaration</th>';
            echo '<th>Heure Déclaration</th>';
            echo '<th>Date Réparation</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            // Afficher les résultats dans le tableau
            foreach ($results as $row) {
                echo '<tr>';
                echo '<td>' . htmlentities($row->lib) . '</td>';
                echo '<td>' . htmlentities($row->description) . '</td>';
                echo '<td>' . (new DateTime($row->dateD))->format('d-m-y') . '</td>';
                echo '<td>' . htmlentities($row->heureD) . '</td>';
                echo '<td>' . (new DateTime($row->dateR))->format('d-m-y') . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucune déclaration trouvée pour les critères sélectionnés.</p>';
        }
    } catch (PDOException $e) {
        // En cas d'erreur de base de données
        echo '<p class="text-danger">Erreur de la base de données : ' . $e->getMessage() . '</p>';
    }
}
?>
