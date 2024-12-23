<?php
include('includes/dbconnection.php');
require_once('tcpdf/tcpdf.php');

// Définir les constantes si elles ne sont pas définies
define('PDF_FONT_NAME_MAIN', 'helvetica');
define('PDF_FONT_SIZE_MAIN', 10);
define('PDF_FONT_STYLE_MAIN', '');
define('PDF_FONT_NAME_DATA', 'helvetica');
define('PDF_FONT_SIZE_DATA', 8);
define('PDF_FONT_STYLE_DATA', '');

if (isset($_GET['factureNum'])) {
    $factureNum = filter_input(INPUT_GET, 'factureNum', FILTER_SANITIZE_STRING); // Validation

    // Sélection des dépenses pour le numéro de facture
    $sql = "SELECT libelle_depenses AS libelle, 
                   quantite_depenses AS quantite, 
                   montant_depenses AS montant_unitaire, 
                   montant_total AS montant_total 
            FROM depenses 
            WHERE num_f = :factureNum";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':factureNum', $factureNum, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des résultats ont été trouvés
    if (empty($results)) {
        echo "Aucune dépense trouvée pour le numéro de facture " . htmlspecialchars($factureNum);
        exit;
    }

    // Créer un nouveau document PDF
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Soumafe');
    $pdf->SetTitle('Facture: ' . $factureNum);
    $pdf->SetHeaderData('', 0, 'Facture ' . $factureNum, 'Détails des dépenses');

    // Configuration de l'en-tête et des marges
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, PDF_FONT_SIZE_MAIN, PDF_FONT_STYLE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, PDF_FONT_SIZE_DATA, PDF_FONT_STYLE_DATA));
    $pdf->SetMargins(15, 40, 15);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->AddPage();

    // Ajouter un logo (chemin à ajuster selon votre structure de dossier)
    $pdf->Image('includes/img/index.PNG', 15, 10, 30, '', '', '', '', false, 300, '', false, false, 0, false, false, false);

    // Contenu du PDF
    $html = '<h1 style="text-align:center;">Détails des Dépenses</h1>';
    $html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse:collapse;">';
    $html .= '<tr style="background-color:#f2f2f2;">
                <th>Libellé</th>
                <th>Quantité</th>
                <th>Montant Unitaire</th>
                <th>Montant Total</th>
              </tr>';

    foreach ($results as $row) {
        $html .= '<tr>
                    <td>' . htmlspecialchars($row['libelle']) . '</td>
                    <td>' . htmlspecialchars($row['quantite']) . '</td>
                    <td>' . htmlspecialchars($row['montant_unitaire']) . '</td>
                    <td>' . htmlspecialchars($row['montant_total']) . '</td>
                  </tr>';
    }

    $html .= '</table>';

    // Écrire le contenu HTML dans le PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Fermer et générer le PDF
    $pdf->Output('facture_' . $factureNum . '.pdf', 'D'); // 'D' pour le téléchargement
    exit;
} else {
    echo "Numéro de facture non spécifié.";
}
?>
