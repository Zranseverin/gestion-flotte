<?php
include('includes/dbconnection.php');

if (isset($_POST['pID'])) {
    $pID = $_POST['pID'];

    $sql = "SELECT nom,prenom FROM pr_list WHERE pID = :pID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pID', $pID, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
