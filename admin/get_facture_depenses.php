<?php
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $factureNum = $_POST['factureNum'];

    // Sélection des dépenses avec libellé, quantité, montant unitaire et montant total
    $sql = "SELECT libelle_depenses AS libelle, 
                   quantite_depenses AS quantite, 
                   montant_depenses AS montant_unitaire, 
                   montant_total AS montant_total 
            FROM depenses 
            WHERE num_f = :factureNum";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':factureNum', $factureNum, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les résultats au format JSON
    echo json_encode(['depenses' => $results]);
}
?>
