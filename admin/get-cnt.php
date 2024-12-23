<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Récupération des informations du propriétaire et des véhicules associés
if (isset($_POST['pID'])) {
    $pID = $_POST['pID'];

    // Récupérer le nom et prénom du propriétaire
    $sql = "SELECT nom, prenom FROM pr_list WHERE pID = :pID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pID', $pID, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // Envoyer les détails du propriétaire sous forme JSON
    echo json_encode($result);

    // Récupérer les véhicules associés au propriétaire
    $sql = $dbh->prepare("SELECT * FROM vh_list WHERE pID = :pID");
    $sql->bindParam(':pID', $pID, PDO::PARAM_STR);
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    
    // Afficher les véhicules sous forme d'options HTML
    echo '<option value="">Sélectionnez un véhicule</option>';
    foreach ($results as $row) {
        echo '<option value="' . htmlentities($row->ID) . '">'
            . htmlentities($row->imt) . ' ' 
            . htmlentities($row->marque) . ' |' 
            . htmlentities($row->genre) . '|</option>';
    }
}

// Récupération des matières associées à un cours
if (!empty($_POST["cid"])) {
    $cid = $_POST["cid"];
    $query = $dbh->prepare("SELECT * FROM tblsubject WHERE CourseID = :cid");
    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query->execute();
    $resultss = $query->fetchAll(PDO::FETCH_OBJ);

    // Afficher les matières sous forme d'options HTML
    echo '<option value="">Sélectionnez une matière</option>';
    foreach ($resultss as $rows) {
        echo '<option value="' . htmlentities($rows->ID) . '">'
            . htmlentities($rows->SubjectFullname) . ' (' 
            . htmlentities($rows->SubjectShortname) . ')</option>';
    }
}

// Récupération des informations du véhicule
if (isset($_POST['ID'])) {
    $ID = $_POST['ID'];

    // Requête pour récupérer les informations du véhicule
    $sql = "SELECT imt, marque, genre FROM vh_list WHERE ID = :ID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ID', $ID, PDO::PARAM_STR);
    $query->execute();
    $vehicle = $query->fetch(PDO::FETCH_ASSOC);

    // Envoyer les détails du véhicule sous forme JSON
    echo json_encode($vehicle);
}
?>
