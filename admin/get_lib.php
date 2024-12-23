<?php
include('includes/dbconnection.php');

if (isset($_POST['decid'])) {
    $decid = $_POST['decid'];

    $sql = "SELECT lib_pan FROM diagn WHERE decid = :decid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':decid', $decid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>
