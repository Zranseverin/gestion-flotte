<?php
include('includes/dbconnection.php');

$filter = isset($_POST['filter']) ? $_POST['filter'] : '';

// Initialize the output variable
$output = '';

// Only execute SQL query if a filter is applied
if ($filter) {
    try {
        if ($filter == 'actif') {
            $sql = "SELECT * FROM chauffeur_list WHERE status = 'Actif'";
        } elseif ($filter == 'inactif') {
            $sql = "SELECT * FROM chauffeur_list WHERE status = 'Inactif'";
        } else {
            $output = ''; // No valid filter provided
        }

        // Prepare and execute the query
        if (!empty($sql)) {
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            // Check if there are results and generate the table
            if ($query->rowCount() > 0) {
                // Start the table
                $output .= '
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 40px;">N°</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Domicile</th>
                                <th>N° permis</th>
                                <th>Telephone</th>
                                <th>Statut</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                ';

                $cnt = 1;
                foreach ($results as $row) {
                    $output .= '
                        <tr>
                            <td>' . htmlentities($cnt) . '</td>
                            <td>' . htmlentities($row->nom) . '</td>
                            <td>' . htmlentities($row->prenom) . '</td>
                            <td>' . htmlentities($row->adresse) . '</td>
                            <td>' . htmlentities($row->permis) . '</td>
                            <td>' . htmlentities($row->telephone1) . '</td>
                            <td>';
                    if ($row->status == "Actif") {
                        $output .= '<span class="badge badge-success">Actif</span>';
                    } else {
                        $output .= '<span class="badge badge-danger">Inactif</span>';
                    }
                    $output .= '</td>
                            <td>
                                <a href="view-ch.php?viewid=' . htmlentities($row->chID) . '" title="View Details"><i class="fas fa-eye"></i></a> ||
                                <a href="edit-ch.php?editid=' . htmlentities($row->chID) . '" title="Edit"><i class="fas fa-edit"></i></a> ||
                                <a href="manage-ch.php?delid=' . htmlentities($row->chID) . '" onclick="return confirm(\'Voulez-vous supprimer ?\');" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    ';
                    $cnt++;
                }

                $output .= '
                        </tbody>
                    </table>
                ';
            } else {
                $output = '<div class="alert alert-info" role="alert">Aucun chauffeur trouvé.</div>'; // Message if no chauffeurs found
            }
        }
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger" role="alert">Erreur : ' . $e->getMessage() . '</div>';
    }
}

// Output the results
echo $output;
?>
