<?php
include('includes/dbconnection.php');

if (isset($_POST['chID'])) {
    $chID = $_POST['chID'];

    $sql = "SELECT permis, nom,prenom,sexe,dateN FROM chauffeur_list WHERE chID = :chID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':chID', $chID, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
