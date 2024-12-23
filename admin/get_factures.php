<?php
include('includes/dbconnection.php');

if (isset($_POST['vehicule'])) {
    $vehicule = $_POST['vehicule'];

    // Requête SQL pour obtenir les factures correspondant au véhicule
    $sql = "SELECT num_f, libelle_depenses, quantite_depenses, montant_depenses, (quantite_depenses * montant_depenses) as montant_total
            FROM depenses
            WHERE imt = :vehicule";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicule', $vehicule, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        echo "<table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>Numéro de Facture</th>
                        <th>Libellé</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Montant Total</th>
                    </tr>
                </thead>
                <tbody>";
        
        $somme_totale = 0;
        foreach ($results as $row) {
            $somme_totale += $row->montant_total;
            echo "<tr>
                    <td>{$row->num_f}</td>
                    <td>{$row->libelle_depenses}</td>
                    <td>{$row->quantite_depenses}</td>
                    <td>{$row->montant_depenses}</td>
                    <td>{$row->montant_total}</td>
                  </tr>";
        }
        
        echo "<tr>
                <td colspan='4' style='text-align:right; font-weight:bold;'>Somme Totale:</td>
                <td style='font-weight:bold;'>{$somme_totale}</td>
              </tr>";
        
        echo "</tbody></table>";
    } else {
        echo "<p>Aucune facture trouvée pour ce véhicule.</p>";
    }
}
?>
