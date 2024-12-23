<?php
include('includes/dbconnection.php');

if (isset($_POST['ID'])) {
    $ID = $_POST['ID'];

    $sql = "SELECT imt,marque,model FROM vh_list WHERE ID = :ID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ID', $ID, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
