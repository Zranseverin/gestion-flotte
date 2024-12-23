<?php
include('includes/dbconnection.php');

if (isset($_POST['permis'])) {
    $permis = $_POST['permis'];

    $sql = "SELECT nom, prenom,dateN FROM attr_list WHERE permis = :permis";
    $query = $dbh->prepare($sql);
    $query->bindParam(':permis', $permis, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
