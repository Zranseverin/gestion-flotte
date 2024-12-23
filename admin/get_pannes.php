<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php'); // Assurez-vous que ce fichier contient bien les informations de connexion à la base de données

try {
    // Vérifier si la date est bien envoyée via POST
    if (isset($_POST['date_d'])) {
        // Récupérer la date sélectionnée
        $date_d = $_POST['date_d'];
        
        // Préparer la requête SQL pour récupérer les pannes en fonction de la date
        $stmt = $pdo->prepare("SELECT lib_pan FROM diagn WHERE date_d = ?");
        
        // Exécuter la requête
        $stmt->execute([$date_d]);
        
        // Récupérer les résultats sous forme de tableau associatif
        $pannes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Retourner les résultats au format JSON
        echo json_encode($pannes);
    }
} catch (Exception $e) {
    // Gérer les erreurs potentielles
    echo json_encode(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
}
?>
