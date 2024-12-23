<?php 
require_once('tcpdf/tcpdf.php'); 
include('includes/dbconnection.php'); 

try { 
    if (isset($_GET['vehicule']) && isset($_GET['mois'])) { 
        // Sécuriser et valider les entrées 
        $vehicule = htmlspecialchars(trim($_GET['vehicule'])); 
        $mois = htmlspecialchars(trim($_GET['mois']));
        
        // Nom, numéro de l'entreprise et adresse 
        $nomEntreprise = "SOUMAFE SARL"; 
        $numeroEntreprise = "0706704833"; 
        $email = "direction@soumafe.com"; 
        $adresse = "COCODY"; 
        $logoPath = 'includes/img/index.PNG'; 
        $signature = 'htdocs/flotte/admin/includes/img/index.PNG'; 
        
        // Requête pour récupérer les versements, triés par date croissante 
        $sql = "SELECT * FROM vsmt_list WHERE CONCAT(imt, ' ', marque) = :vehicule AND DATE_FORMAT(date, '%Y-%m') = :mois ORDER BY date ASC"; 
        $query = $dbh->prepare($sql); 
        $query->bindParam(':vehicule', $vehicule, PDO::PARAM_STR); 
        $query->bindParam(':mois', $mois, PDO::PARAM_STR); 
        $query->execute(); 
        $results = $query->fetchAll(PDO::FETCH_OBJ); 
        
        // Vérifier si les résultats ont été trouvés 
        if (count($results) === 0) { 
            echo "Aucune recette trouvée pour ce véhicule et ce mois."; 
            exit; // Arrêter le script si aucun résultat 
        } 
        
        // Calculer la somme totale des recettes 
        $sommeTotale = 0; 
        foreach ($results as $row) { 
            $sommeTotale += $row->recette; 
        } 
        
        // Création du PDF 
        $pdf = new TCPDF(); 
        $pdf->AddPage(); 
        
        // --- EN-TÊTE --- 
        // Ajouter le logo (en haut à gauche) 
        if (file_exists($logoPath)) { 
            $pdf->Image($logoPath, 10, 10, 30, 0, 'PNG'); 
        } 
        
        // Espacement en fonction de la taille du logo 
        $pdf->SetY(15); // Ajuste la position après le logo 
        
        // Ajout des informations de l'entreprise 
        $pdf->SetFont('helvetica', 'B', 16); 
        $pdf->Cell(0, 10, $nomEntreprise, 0, 1, 'C'); 
        $pdf->SetFont('helvetica', '', 14); 
        $pdf->Cell(0, 10, $numeroEntreprise, 0, 1, 'C'); 
        $pdf->Cell(0, 10, $email, 0, 1, 'C'); 
        $pdf->Cell(0, 10, $adresse, 0, 1, 'C'); 
        
        // Ligne de séparation 
        $pdf->SetY(40); // Ajuster la position après les informations de l'entreprise 
        $pdf->Line(10, 45, 200, 45); // Ligne horizontale 
        
        // Titre du rapport 
        $pdf->SetY(50); // Ajuste la position après la ligne 
        $pdf->SetFont('helvetica', 'B', 20); 
        $pdf->Cell(0, 10, "Fiche de recette: $vehicule ($mois)", 0, 1, 'C'); 
        
        // --- CONTENU DU PDF --- 
        // Tableau des recettes 
        $pdf->SetFont('helvetica', '', 12); 
        $tbl = '<table border="1" cellspacing="3" cellpadding="4"> <tr> <th width="30">S.NO</th> <th>Date</th> <th>Recette (FCFA)</th> </tr>'; 
        $cnt = 1; 
        
        foreach ($results as $row) { 
            $recette = htmlspecialchars($row->recette); 
            $recetteFormatted = number_format($recette, 2) . ' '; 
            // Condition pour afficher la recette en rouge si elle est inférieure à 10 000 
            $color = $recette < 10000 ? 'red' : 'black'; 
            $tbl .= '<tr> <td>' . $cnt . '</td> <td>' . htmlspecialchars($row->date) . '</td> <td style="color: ' . $color . ';">' . $recetteFormatted . '</td> </tr>'; 
            $cnt++; 
        } 
        
        $tbl .= '</table>'; 
        $pdf->writeHTML($tbl, true, false, false, false, ''); 
        
        // Ajouter la somme totale des recettes 
        $pdf->SetFont('helvetica', 'B', 14); 
        $pdf->Cell(0, 10, "Somme Totale des recettes : " . number_format(htmlspecialchars($sommeTotale), 2) . ' FCFA', 0, 1, 'C'); 
        
        // --- PIED DE PAGE --- 
        // Ajouter la date et l'heure actuelle 
        $pdf->SetFont('helvetica', '', 12); 
        $pdf->Cell(0, 10, "Abidjan, le " . date('d/m/Y H:i:s'), 0, 1, 'C'); 
        
        // Ligne de séparation 
        $pdf->Line(10, $pdf->GetY() + 10, 200, $pdf->GetY() + 10); 
        $pdf->SetY($pdf->GetY() + 15); 
        
        // Numéro automatique de téléchargement du fichier 
        $pdf->Cell(0, 10, "id: " . uniqid(), 0, 1, 'C'); 
        
        // Ajouter la signature de l'entreprise 
        if (file_exists($signature)) { 
            $pdf->Image($signature, 10, $pdf->GetY() + 10, 50, 0, 'PNG'); 
        } 
        
        $pdf->Ln(20); 
        
        // Sortie du PDF 
        $pdf->Output('fiche_recette_' . date('Ymd_His') . '.pdf', 'D'); // Ajout de la date et de l'heure dans le nom du fichier 
    } else { 
        echo "Les paramètres sont manquants."; 
    } 
} catch (Exception $e) { 
    // Gérer les erreurs et afficher un message 
    echo "Une erreur s'est produite: " . $e->getMessage(); 
} 
?>
