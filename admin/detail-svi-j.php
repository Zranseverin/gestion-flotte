<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buspassdb";

// Créer la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialiser les variables
$imt = '';
$date_debut = '';
$date_fin = '';

// Vérifier si un permis a été passé en paramètre
if (isset($_GET['imt'])) {
    $imt = mysqli_real_escape_string($conn, $_GET['imt']);
}

// Initialiser les variables de date
$date_debut = '';
$date_fin = '';

// Vérifier si les dates ont été passées en paramètres
if (isset($_GET['date_debut']) && isset($_GET['date_fin'])) {
    $date_debut = mysqli_real_escape_string($conn, $_GET['date_debut']);
    $date_fin = mysqli_real_escape_string($conn, $_GET['date_fin']);
}

// Requête pour obtenir les totaux
$query_totaux = "
    SELECT 
        SUM(dkm) AS total_km,
        SUM(tth) AS total_heures,
        COUNT(DISTINCT date) AS total_jours
    FROM svi_list
    WHERE imt = '$imt' AND date BETWEEN '$date_debut' AND '$date_fin'
";

$result_totaux = mysqli_query($conn, $query_totaux);

// Récupérer les résultats
$totaux = mysqli_fetch_assoc($result_totaux);

// Requête pour obtenir les détails pour un chauffeur spécifique
$query = "
    SELECT 
        nom,
        prenom,
        permis,
        date,
        imt,
        ha,
        hd,
        tth,
        dkm,
        akm,
        totkm,
        ob,
        CreationDate
    FROM svi_list
    WHERE imt = '$imt'
    ORDER BY date ASC
";

$result = mysqli_query($conn, $query);

// Afficher un message d'erreur si la requête échoue
if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion Flottes Soumafe | Vue Véhicules</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />

    <!-- Inclure jsPDF depuis un CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <script type="text/javascript">
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Convertir la div HTML en PDF
            doc.html(document.getElementById('divToPrint'), {
                callback: function (doc) {
                    doc.save('Detail_Kilometrages.pdf');
                },
                x: 10,
                y: 10,
                width: 180, // Largeur de la page pour adapter le contenu
            });
        }
        
        // Fonction pour afficher les totaux dans la modale
        function afficherTotaux() {
            // Récupérer les dates saisies
            var dateDebut = document.getElementById("dateDebut").value;
            var dateFin = document.getElementById("dateFin").value;

            // Rediriger vers la même page avec les paramètres de date
            window.location.href = `?imt=<?php echo $imt; ?>&date_debut=${dateDebut}&date_fin=${dateFin}`;
        }
    </script>
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Détail des Kilométrages</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row" id="divToPrint">
                                <div class="col-lg-12">
                                    <table border="1" class="table table-bordered">
                                        <thead>
                                            <tr align="center">
                                                <th>Date</th>
                                                <th>Départ</th>
                                                <th>Arrivée</th>
                                                <th>Parc (h/min)</th>
                                                <th>KM Départ</th>
                                                <th>KM Fin</th>
                                                <th>Par (KM)</th>
                                                <th>Observation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['hd']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['ha']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['tth']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['dkm']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['akm']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['totkm']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['ob']) . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='8'>Aucun résultat trouvé</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php mysqli_close($conn); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="#" class="btn btn-primary" onclick="PrintDiv(); return false;">Imprimer</a>
                <a href="#" class="btn btn-success" onclick="downloadPDF(); return false;">Télécharger en PDF</a>
                <!-- Bouton pour ouvrir la modale -->
                <button class="btn btn-info" data-toggle="modal" data-target="#modalKilometrages">Afficher Kilométrages</button>
            </div>

            <!-- Fenêtre modale -->
            <div class="modal fade" id="modalKilometrages" tabindex="-1" role="dialog" aria-labelledby="modalKilometragesLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalKilometragesLabel">Kilométrages d'une Période</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="dateDebut">Date de Début:</label>
                                <input type="date" id="dateDebut" class="form-control" value="<?php echo htmlspecialchars($date_debut); ?>">
                            </div>
                            <div class="form-group">
                                <label for="dateFin">Date de Fin:</label>
                                <input type="date" id="dateFin" class="form-control" value="<?php echo htmlspecialchars($date_fin); ?>">
                            </div>
                            <button class="btn btn-primary" onclick="afficherTotaux()">Afficher Totaux</button>

                            <hr>
                            <p><strong>Total Kilométrages:</strong> <?php echo htmlspecialchars($totaux['total_km']); ?> km</p>
                            <p><strong>Total Heures:</strong> <?php echo htmlspecialchars($totaux['total_heures']); ?> heures</p>
                            <p><strong>Total Jours:</strong> <?php echo htmlspecialchars($totaux['total_jours']); ?> jours</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
</body>
</html>
