<?php
require_once('tcpdf/tcpdf.php');
include('includes/dbconnection.php');

if (isset($_GET['chauffeur']) && isset($_GET['mois'])) {
    // Sécuriser et valider les entrées
    $chauffeur = htmlspecialchars(trim($_GET['chauffeur']));
    $mois = htmlspecialchars(trim($_GET['mois']));

    // Nom et numéro de l'entreprise
    $nomEntreprise = "SOUMAFE SARL";
    $numeroEntreprise = "0706704833";
    $emailEntreprise = "direction@soumafe.com"; // Remplacez par le courriel réel de votre entreprise
    $adresse = "COCODY FAYA";
    $logoPath = 'includes/img/index.PNG'; // Chemin vers le logo de l'entreprise

    // Requête pour récupérer les versements
    $sql = "SELECT * FROM vsmt_list WHERE CONCAT(nom, ' ', prenom) = :chauffeur AND DATE_FORMAT(date, '%Y-%m') = :mois";
    $query = $dbh->prepare($sql);
    $query->bindParam(':chauffeur', $chauffeur, PDO::PARAM_STR);
    $query->bindParam(':mois', $mois, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Vérifier si des résultats ont été trouvés
    if (count($results) === 0) {
        echo "Aucun versement trouvé pour ce chauffeur et ce mois.";
        exit; // Arrêter le script si aucun résultat
    }

    // Calculer la somme totale des versements
    $sommeTotale = 0;
    foreach ($results as $row) {
        $sommeTotale += $row->versement; // Assurez-vous que 'versement' est un nombre
    }

    // Création du PDF
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Ajouter l'en-tête
    $pdf->Image($logoPath, 10, 10, 30, '', '', '', '', false, 300, '', false, false, 0, false, false, false); // Ajouter le logo
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(0, 10, $nomEntreprise, 0, 1, 'C');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, $numeroEntreprise, 0, 1, 'C');
    $pdf->Cell(0, 10, $emailEntreprise, 0, 1, 'C');
    $pdf->Cell(0, 10, $adresse, 0, 1, 'C');
    $pdf->Ln(5); // Ligne vide

    // Titre
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->Cell(0, 10, "Fiche de versements: $chauffeur ($mois)", 0, 1, 'C');

    // Tableau
    $pdf->SetFont('helvetica', '', 12);
    $tbl = '<table border="1" cellspacing="3" cellpadding="4">
        <tr>
            <th>S.NO</th>
            <th>Date</th>
            <th>Versement</th>
        </tr>';
    $cnt = 1;
    foreach ($results as $row) {
        $tbl .= '<tr>
                    <td>' . $cnt . '</td>
                    <td>' . htmlspecialchars($row->date) . '</td>
                    <td>' . htmlspecialchars($row->versement) . '</td>
                </tr>';
        $cnt++;
    }
    $tbl .= '</table>';
    $pdf->writeHTML($tbl, true, false, false, false, '');

    // Ajouter la somme totale des versements
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, "Somme Totale des Versements: " . htmlspecialchars($sommeTotale), 0, 1, 'C');

    // Ajouter le pied de page
    $pdf->SetY(-30); // Positionner le curseur à 30 mm du bas
    $pdf->SetFont('helvetica', '', 10);
    $dateActuelle = date('d/m/Y');
    $heureActuelle = date('H:i:s');
    $pdf->Cell(0, 10, "Abidjan, le $dateActuelle | Heure: $heureActuelle | id: " . uniqid(), 0, 0, 'C');

    // Output du PDF
    $pdf->Output('fiche_versements.pdf', 'D');
}
?>
