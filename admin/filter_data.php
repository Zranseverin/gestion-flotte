<?php
include('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle = trim($_POST['vehicle']);
    $month = trim($_POST['month']);

    if (empty($vehicle) || empty($month)) {
        echo '<p class="text-danger">Veuillez sélectionner un véhicule et un mois.</p>';
        exit;
    }

    try {
        $sql = "SELECT 
                    date, 
                    hd AS heure_depart, 
                    ha AS heure_arrivee, 
                    dkm AS kilometrage_depart, 
                    akm AS kilometrage_arrivee, 
                    totkm AS kilometrage_parcourus, 
                    tth AS temps_total,
                    ob AS observation,
                    kID AS id
                FROM svi_list 
                WHERE imt = :vehicle AND DATE_FORMAT(date, '%Y-%m') = :month";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicle', $vehicle, PDO::PARAM_STR);
        $query->bindParam(':month', $month, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $totalKilometrage = 0;
            $totalHeures = 0;
            $totaldepart = 0;
            $totalarrivee = 0;

            echo '<table class="table table-striped table-bordered">';
            echo '<thead><tr>
                    <th>Date</th>
                    <th>Heure Départ</th>
                    <th>Heure Arrivée</th>
                    <th>KM Départ</th>
                    <th>KM Arrivée</th>
                    <th>KM Parcourus</th>
                    <th>Temps Total</th>
                    <th>Observation</th>
                     <th>Action</th>
                  </tr></thead><tbody>';

            foreach ($results as $row) {
                $totalKilometrage += (float)$row->kilometrage_parcourus;
                $totalHeures += (float)$row->temps_total;
                $totaldepart += (float)$row->kilometrage_depart;
                $totalarrivee += (float)$row->kilometrage_arrivee;

                // Déterminer la couleur de la cellule en fonction du kilométrage parcouru
                $colorClass = 'normal';  // valeur par défaut
                $kmParcourus = (float)$row->kilometrage_parcourus;

                if ($kmParcourus > 350) {
                    $colorClass = 'red';
                } elseif ($kmParcourus < 250) {
                    $colorClass = 'green';
                }
                   
                $formattedDate = (new DateTime($row->date))->format('d-m-Y');

                echo '<tr>';
                echo '<td>' . htmlentities($formattedDate) . '</td>';  // Afficher la date formatée
                echo '<td>' . htmlentities($row->heure_depart) . '</td>';
                echo '<td>' . htmlentities($row->heure_arrivee) . '</td>';
                echo '<td>' . htmlentities($row->kilometrage_depart) . '</td>';
                echo '<td>' . htmlentities($row->kilometrage_arrivee) . '</td>';
                echo '<td class="' . $colorClass . '">' . htmlentities($row->kilometrage_parcourus) . '</td>'; // Appliquer la couleur ici
                echo '<td>' . htmlentities($row->temps_total) . '</td>';
                echo '<td>' . htmlentities($row->observation) . '</td>';
                echo '<td>
                        <a href="edit-svi.php?editid=' . htmlentities($row->id) . '"><i class="fas fa-edit"></a> || 
                        <a href="manage-svi.php?delid=' . htmlentities($row->id) . '" onclick="return confirm(\'Voulez-vous supprimer ?\');"><i class="fas fa-trash text-danger"></i></a>
                      </td>';
                echo '</tr>';
                
                echo '</tr>';
            }

            echo '</tbody></table>';
            echo '<p><strong>Total Kilométrage Parcouru :</strong> ' . number_format($totalKilometrage, 2) . ' km</p>';
            echo '<p><strong>Total Temps Parcouru :</strong> ' . number_format($totalHeures, 2) . ' heures</p>';
            echo '<p><strong>Total Kilométrage Départ :</strong> ' . number_format($totaldepart, 2) . ' km</p>';
            echo '<p><strong>Total Kilométrage Arrivée :</strong> ' . number_format($totalarrivee, 2) . ' km</p>';
        } else {
            echo '<p class="text-warning">Aucune donnée trouvée pour ce véhicule et ce mois.</p>';
        }
    } catch (Exception $e) {
        echo '<p class="text-danger">Erreur : ' . $e->getMessage() . '</p>';
    }
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .normal {
        background-color: white; /* Cellule normale */
    }

    .red {
        background-color: lightcoral; /* Cellule rouge claire */
    }

    .green {
        background-color: lightgreen; /* Cellule verte */
    }
      /* Style général pour toutes les icônes */
i.fas {
    font-size: 20px;        /* Taille des icônes */
    margin: 0 10px;         /* Espacement entre les icônes */
    cursor: pointer;        /* Affiche le curseur de type "main" */
    transition: all 0.2s ease; /* Animation douce sur hover */
}

/* Icône de suppression (trash) */
i.fa-trash {
    color: #dc3545;         /* Couleur rouge danger par défaut */
}

i.fa-trash:hover {
    color: #a71d2a;         /* Rouge plus foncé au survol */
    transform : scale(1.2);
}
</style>
