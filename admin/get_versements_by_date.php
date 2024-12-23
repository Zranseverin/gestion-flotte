<?php
session_start();
include('includes/dbconnection.php');

// Vérifier si l'utilisateur est connecté
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $chauffeur = $_POST['chauffeur'];
        $date_start = $_POST['date_start'];
        $date_end = $_POST['date_end'];

        // Requête SQL avec tri par date (ordre croissant)
        $sql = "SELECT date, versement FROM vsmt_list WHERE CONCAT(nom, ' ', prenom) = :chauffeur AND date BETWEEN :date_start AND :date_end ORDER BY date ASC";
        $query = $dbh->prepare($sql);
        $query->bindParam(':chauffeur', $chauffeur, PDO::PARAM_STR);
        $query->bindParam(':date_start', $date_start, PDO::PARAM_STR);
        $query->bindParam(':date_end', $date_end, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        $response = array();
        $response['versements'] = array();

        foreach ($results as $row) {
            // Définir la couleur si le versement est inférieur à 15 000
            $color = ($row->versement < 15000) ? 'red' : 'black';

            // Ajouter la date, le montant et la couleur au tableau de réponse
            $response['versements'][] = array(
                'date' => $row->date,
                'montant' => $row->versement,
                'color' => $color  // Ajouter la couleur
            );
        }

        // Retourner les données sous forme de JSON
        echo json_encode($response);
    }
}
