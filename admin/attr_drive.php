<?php
include('includes/dbconnection.php');

if (isset($_POST['imt'])) {
    $imt = $_POST['imt'];

    $sql = "SELECT * FROM vh_list WHERE imt = :imt";
    $query = $dbh->prepare($sql);
    $query->bindParam(':imt', $imt, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
