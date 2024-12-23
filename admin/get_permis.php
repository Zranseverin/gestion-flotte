<?php
include('includes/dbconnection.php');

if (isset($_POST['imt'])) {
    $imt = $_POST['imt'];

    $sql = "SELECT permis, nom, FROM attr_list WHERE imt = :imt";
    $query = $dbh->prepare($sql);
    $query->bindParam(':imt', $imt, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        // Retourne les données en format JSON
        echo json_encode([
            'permis' => $result->permis,
            'nom' => $result->nom,
            'prenom' => $result->prenom
        ]);
    } else {
        echo json_encode([
            'permis' => '',
            'nom' => '',
            'prenom' => ''
        ]);
    }
}
?>
