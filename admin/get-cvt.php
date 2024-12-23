<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Récupération des informations du vehicule et des chauffeur associés
if (isset($_POST['ID'])) {
    $ID = $_POST['ID'];

    // Récupérer le imt marque 
    $sql = "SELECT imt, marque,model FROM vh_list WHERE ID = :ID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ID', $ID, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Envoyer les détails du propriétaire sous forme JSON
    echo json_encode($result);

    // Récupérer les véhicules associés au propriétaire
    $sql = $dbh->prepare("SELECT * FROM attr_list WHERE ID = :ID");
    $sql->bindParam(':ID', $ID, PDO::PARAM_STR);
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    
    // Afficher les véhicules sous forme d'options HTML
    echo '<option value="">Sélectionnez un véhicule</option>';
    foreach ($results as $row) {
        echo '<option value="' . htmlentities($row->aID) . '">'
            . htmlentities($row->permis) . ' ' 
            . htmlentities($row->nom) . ' |' 
            . htmlentities($row->prenom) . '|</option>';
    }
}



// Récupération des informations du véhicule
if (isset($_POST['aID'])) {
    $aID = $_POST['aID'];

    // Requête pour récupérer les informations du véhicule
    $sql = "SELECT permis, nom, prenom FROM attr_list WHERE aID = :aID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':aID', $aID, PDO::PARAM_STR);
    $query->execute();
    $vehicle = $query->fetch(PDO::FETCH_ASSOC);

    // Envoyer les détails du véhicule sous forme JSON
    echo json_encode($vehicle);
}
?>
