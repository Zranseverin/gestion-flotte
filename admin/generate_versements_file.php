<?php
session_start();
include('includes/dbconnection.php');
require_once('tcpdf/tcpdf.php'); // Inclure TCPDF

// Vérifier si l'utilisateur est connecté
if (strlen($_SESSION['bpmsaid']) == 0) {
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

        // Calculer la somme totale
        $somme_totale = 0;
        foreach ($results as $row) {
            $somme_totale += $row->versement;
        }

        // Créer un nouveau document PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SOUMAFE SARL');
        $pdf->SetTitle('Versements du chauffeur');

        // Définir les informations d'en-tête
        $header_title = 'SOUMAFE SARL';
        $header_info = "Email : contact@soumafe.com\nNuméro : 0706704833\nAdresse : Cocody, Abidjan";
        $header_dates = "Du : " . htmlspecialchars($date_start) . " Au : " . htmlspecialchars($date_end);
        
        $pdf->SetHeaderData('includes/img/index.PNG', 20, $header_title, $header_info . "\n" . $header_dates);

        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10, 40, 10); // Ajuster la marge supérieure pour faire de la place pour l'en-tête
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->AddPage();

        // Contenu HTML
        $html = '<h1>Versements pour ' . htmlspecialchars($chauffeur) . '</h1>';
        $html .= '<table border="1" cellpadding="4">';
        $html .= '<tr><th>Date</th><th>Montant</th></tr>';

        foreach ($results as $row) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row->date) . '</td>';
            $html .= '<td>' . htmlspecialchars($row->versement) . '</td>';
            $html .= '</tr>';
        }

        // Ajouter la somme totale avec couleur et message conditionnel
        if ($somme_totale > 200000) {
            $html .= '<tr><td><strong style="color: blue;">Somme Totale</strong></td><td><strong style="color: blue;">' . htmlspecialchars($somme_totale) . '</strong></td></tr>';
            $html .= '<tr><td colspan="2" style="color: blue; text-align: center;"><strong>Félicitations !</strong></td></tr>';
        } else {
            $html .= '<tr><td><strong style="color: red;">Somme Totale</strong></td><td><strong style="color: red;">' . htmlspecialchars($somme_totale) . '</strong></td></tr>';
            $html .= '<tr><td colspan="2" style="color: red; text-align: center;"><strong>Attention !</strong></td></tr>';
        }

        $html .= '</table>';

        // Écrire le contenu HTML au PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Définir le pied de page
        $pdf->SetY(-15); // Positionner à 15 mm du bas
        $pdf->SetFont('helvetica', 'I', 8);
        // Obtenir la date et l'heure actuelles
        $date_aujourd_hui = date('d/m/Y');
        $heure_actuelle = date('H:i:s');
        $num_telechargement = uniqid(); // Générer un numéro de téléchargement unique

        // Définir le contenu du pied de page
        $footer_text = 'Chauffeur : ' . htmlspecialchars($chauffeur) . 
                       ' | ID : ' . $num_telechargement . 
                       ' | Date : ' . $date_aujourd_hui . 
                       ' | Heure : ' . $heure_actuelle . 
                       ' | Position actuelle : [Insérez votre position ici]';

        // Afficher le pied de page
        $pdf->Cell(0, 10, $footer_text, 0, false, 'C', 0, '', 0, false, 'T', 'M');

        // Sortir le PDF
        $pdf->Output('versements.pdf', 'D'); // 'D' pour forcer le téléchargement
    }
}
?>
