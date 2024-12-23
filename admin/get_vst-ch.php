<?php
include('includes/dbconnection.php');

if (isset($_POST['aID'])) {
    $aID = $_POST['aID'];

    $sql = "SELECT * FROM attr_list WHERE aID = :aID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':aID', $aID, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
