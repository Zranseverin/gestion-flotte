<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Flottes Soumafe | Enregistrement des Pannes et Factures</title>

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/plugins/pace/pace-theme-big-counter.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main-style.css">
    <link rel="stylesheet" href="style.css"> <!-- Assuming this contains custom styles -->
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            margin: 20px auto;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        legend {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 8px;
            border: 1px solid #ddd;
        }
        input[type="text"], input[type="date"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .signature-container {
            display: flex;
            justify-content: space-between;
        }
        .signature-pad {
            border: 1px solid #ccc;
            width: 100%;
            height: 100px;
            border-radius: 4px;
        }
        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #4cae4c;
        }
        input[type="submit"] {
            background-color: #0275d8;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .form-group {
        flex: 1; /* Make all items grow equally */
        margin-right: 10px; /* Add space between items */
    }
    .form-group:last-child {
        margin-right: 0; /* Remove margin from last item */
    }
    input[type="date"], input[type="text"] {
        width: calc(100% - 12px); /* Full width minus padding */
        padding: 6px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .form-group {
        flex: 1; /* Make all items grow equally */
        margin-right: 10px; /* Add space between items */
    }
    .form-group:last-child {
        margin-right: 0; /* Remove margin from last item */
    }
    input[type="date"], input[type="text"] {
        width: 100%; /* Full width */
        padding: 10px; /* Padding for input fields */
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Ensures padding is included in width */
        height: 40px; /* Set a fixed height for uniformity */
    }
    </style>
</head>
<body>
    <!-- Wrapper for Navbar and Page Content -->
    <div id="wrapper">
        <!-- Navbar and Sidebar -->
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Enregistrement des pannes et factures</h1>
                </div>
            </div>

            <!-- Form Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="container">
                            <h2><i class="fa fa-car"></i> Formulaire de Vérification de Voiture</h2>
<form id="verificationForm">
    <!-- General Information Section -->
    <fieldset class="form-section">
        <legend><i class="fa fa-info-circle"></i> Informations Générales</legend>
        
        <div class="form-row">
        <div class="left">
            <div class="form-group">
                <label>Date de vérification:</label>
                <input type="date" id="dateVerification" required>
            </div>
            <div class="form-group">
                <label>Immatriculation:</label>
                <input type="text" id="immatriculation" required>
                </div>
                <div class="form-group">
                <label>Date de derniere vidange:</label>
                <input type="text" id="datev" required>
                </div>
                <div class="form-group">
                <label>Date de prochain révision:</label>
                <input type="text" id="dater" required>
                </div>

<!-- Right Column -->

            </div>
        </div>
        <div class="right">
        <div class="form-group">
       
            <label>Conducteur:</label>
            <input type="text" id="conducteur" required>
        </div>

        <div class="form-group">
            <label>Logisticien:</label>
            <input type="text" id="logisticien" required>
        </div>

        <div class="form-group">
            <label>Véhicule:</label>
            <input type="text" id="vehicule" required>
        </div>
        <div class="form-group">
            <label>Kilomettrage actuel:</label>
            <input type="text" id="kl" required>
        </div>
        </div>
        </div>
    </fieldset>
</form>

                                    <!-- Interior Condition Section -->
                                    <fieldset class="form-section">
                                        <legend><i class="fa fa-cog"></i> Aspect Intérieur</legend>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Élément</th>
                                                    <th><i class="fa fa-star"></i> Neuf</th>
                                                    <th><i class="fa fa-thumbs-up"></i> Bon</th>
                                                    <th><i class="fa fa-thumbs-down"></i> Correct</th>
                                                    <th><i class="fa fa-times"></i> Mauvais</th>
                                                    <th><i class="fa fa-times"></i> commentaire</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tableau de bord</td>
                                                    <td><input type="radio" name="tableauDeBord" value="neuf" required></td>
                                                    <td><input type="radio" name="tableauDeBord" value="bon"></td>
                                                    <td><input type="radio" name="tableauDeBord" value="correct"></td>
                                                    <td><input type="radio" name="tableauDeBord" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Frein de secours</td>
                                                    <td><input type="radio" name="freinSecours" value="neuf" required></td>
                                                    <td><input type="radio" name="freinSecours" value="bon"></td>
                                                    <td><input type="radio" name="freinSecours" value="correct"></td>
                                                    <td><input type="radio" name="freinSecours" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Pédales</td>
                                                    <td><input type="radio" name="pedales" value="neuf" required></td>
                                                    <td><input type="radio" name="pedales" value="bon"></td>
                                                    <td><input type="radio" name="pedales" value="correct"></td>
                                                    <td><input type="radio" name="pedales" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Jauges de niveau</td>
                                                    <td><input type="radio" name="Jaugesdeniveau" value="neuf" required></td>
                                                    <td><input type="radio" name="Jaugesdeniveau" value="bon"></td>
                                                    <td><input type="radio" name="Jaugesdeniveau" value="correct"></td>
                                                    <td><input type="radio" name="Jaugesdeniveau" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Rétroviseur</td>
                                                    <td><input type="radio" name="Rétroviseur" value="neuf" required></td>
                                                    <td><input type="radio" name="Rétroviseur" value="bon"></td>
                                                    <td><input type="radio" name="Rétroviseur" value="correct"></td>
                                                    <td><input type="radio" name="Rétroviseur" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Compteur kilometrique</td>
                                                    <td><input type="radio" name="Compteurkilometrique" value="neuf" required></td>
                                                    <td><input type="radio" name="Compteurkilometrique" value="bon"></td>
                                                    <td><input type="radio" name="Compteurkilometrique" value="correct"></td>
                                                    <td><input type="radio" name="Compteurkilometrique" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Aspect des portières</td>
                                                    <td><input type="radio" name="aspectdesportieres" value="neuf" required></td>
                                                    <td><input type="radio" name="aspectdesportieres" value="bon"></td>
                                                    <td><input type="radio" name="aspectdesportieres" value="correct"></td>
                                                    <td><input type="radio" name="aspectdesportieres" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Etat des vitres</td>
                                                    <td><input type="radio" name="Etatdesvitres" value="neuf" required></td>
                                                    <td><input type="radio" name="Etatdesvitres" value="bon"></td>
                                                    <td><input type="radio" name="Etatdesvitres" value="correct"></td>
                                                    <td><input type="radio" name="Etatdesvitres" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Etat des tapis</td>
                                                    <td><input type="radio" name="Etatdestapis" value="neuf" required></td>
                                                    <td><input type="radio" name="Etatdestapis" value="bon"></td>
                                                    <td><input type="radio" name="Etatdestapis" value="correct"></td>
                                                    <td><input type="radio" name="Etatdestapis" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Ceinture de sécurité</td>
                                                    <td><input type="radio" name="Ceinturedesecurite" value="neuf" required></td>
                                                    <td><input type="radio" name="Ceinturedesecurite" value="bon"></td>
                                                    <td><input type="radio" name="Ceinturedesecurite" value="correct"></td>
                                                    <td><input type="radio" name="Ceinturedesecurite" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Siège</td>
                                                    <td><input type="radio" name="siege" value="neuf" required></td>
                                                    <td><input type="radio" name="siege" value="bon"></td>
                                                    <td><input type="radio" name="siege" value="correct"></td>
                                                    <td><input type="radio" name="siege" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Etat du plafond interieur</td>
                                                    <td><input type="radio" name="Etatduplafondinterieur" value="neuf" required></td>
                                                    <td><input type="radio" name="Etatduplafondinterieur" value="bon"></td>
                                                    <td><input type="radio" name="Etatduplafondinterieur" value="correct"></td>
                                                    <td><input type="radio" name="Etatduplafondinterieur" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Etat du rêtement du cofre </td>
                                                    <td><input type="radio" name="Etatduretementducofre" value="neuf" required></td>
                                                    <td><input type="radio" name="Etatduretementducofre" value="bon"></td>
                                                    <td><input type="radio" name="Etatduretementducofre" value="correct"></td>
                                                    <td><input type="radio" name="Etatduretementducofre" value="mauvais"></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </fieldset>
                                    <fieldset class="form-section">
                                        <legend><i class="fa fa-cog"></i> Aspect des Pneumatique</legend>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Élément</th>
                                                    <th><i class="fa fa-star"></i> Neuf</th>
                                                    <th><i class="fa fa-thumbs-up"></i> Bon</th>
                                                    <th><i class="fa fa-thumbs-down"></i> Correct</th>
                                                    <th><i class="fa fa-times"></i> Mauvais</th>
                                                    <th><i class="fa fa-times"></i> commentaire</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Paire de pneus avant</td>
                                                    <td><input type="radio" name="pairepneusavant" value="neuf" required></td>
                                                    <td><input type="radio" name="pairepneusavant" value="bon"></td>
                                                    <td><input type="radio" name="pairepneusavant" value="correct"></td>
                                                    <td><input type="radio" name="pairepneusavant" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Paire de pneus arrière</td>
                                                    <td><input type="radio" name="pairepneusarriere" value="neuf" required></td>
                                                    <td><input type="radio" name="pairepneusarriere" value="bon"></td>
                                                    <td><input type="radio" name="pairepneusarriere" value="correct"></td>
                                                    <td><input type="radio" name="pairepneusarriere" value="mauvais"></td>
                                                </tr>
                                                <tr>
                                                    <td>Etat de la roue de secours</td>
                                                    <td><input type="radio" name="rouesecours" value="neuf" required></td>
                                                    <td><input type="radio" name="rouesecours" value="bon"></td>
                                                    <td><input type="radio" name="rouesecours" value="correct"></td>
                                                    <td><input type="radio" name="rouesecours" value="mauvais"></td>
                                                </tr>
                                               
                                            </tbody>

                                        </table>
                                    </fieldset>

                                    <!-- Signature Section -->
                                    <fieldset class="form-section">
                                        <legend><i class="fa fa-pencil-square-o"></i> Signatures Numériques</legend>
                                        <div class="signature-container">
                                            <div>
                                                <h4>Signature Conducteur</h4>
                                                <canvas id="signature-pad-driver" class="signature-pad"></canvas>
                                                <button type="button" id="clear-driver">Effacer la signature</button>
                                            </div>
                                            <div>
                                                <h4>Signature Logisticien</h4>
                                                <canvas id="signature-pad-logisticien" class="signature-pad"></canvas>
                                                <button type="button" id="clear-logisticien">Effacer la signature</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Submit Button -->
                                    <input type="submit" value="Télécharger PDF">
                                </form>

                                <!-- Scripts -->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.0.0/signature_pad.min.js"></script>
                                <script>
                                    // Initialize signature pads
                                    const canvasDriver = document.getElementById('signature-pad-driver');
                                    const canvasLogisticien = document.getElementById('signature-pad-logisticien');
                                    const signaturePadDriver = new SignaturePad(canvasDriver);
                                    const signaturePadLogisticien = new SignaturePad(canvasLogisticien);

                                    // Clear signature pads
                                    document.getElementById('clear-driver').addEventListener('click', function() {
                                        signaturePadDriver.clear();
                                    });

                                    document.getElementById('clear-logisticien').addEventListener('click', function() {
                                        signaturePadLogisticien.clear();
                                    });

                                    // Generate PDF using jsPDF
                                   document.getElementById("verificationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const dateVerification = document.getElementById("dateVerification").value;
    const conducteur = document.getElementById("conducteur").value;
    const logisticien = document.getElementById("logisticien").value;
    const vehicule = document.getElementById("vehicule").value;
    const immatriculation = document.getElementById("immatriculation").value;
    const kilometrage = document.getElementById("kl").value; // Kilométrage actuel

    // Collect values from radio buttons for "Aspect Intérieur"
    const tableauDeBord = document.querySelector('input[name="tableauDeBord"]:checked')?.value || "Non évalué";
    const freinSecours = document.querySelector('input[name="freinSecours"]:checked')?.value || "Non évalué";
    const pedales = document.querySelector('input[name="pedales"]:checked')?.value || "Non évalué";
    const jaugesDeNiveau = document.querySelector('input[name="Jaugesdeniveau"]:checked')?.value || "Non évalué";
    const retroviseur = document.querySelector('input[name="Rétroviseur"]:checked')?.value || "Non évalué";
    const compteurKilometrique = document.querySelector('input[name="Compteurkilometrique"]:checked')?.value || "Non évalué";
    const aspectDesPortieres = document.querySelector('input[name="aspectdesportieres"]:checked')?.value || "Non évalué";
    const etatDesVitres = document.querySelector('input[name="Etatdesvitres"]:checked')?.value || "Non évalué";
    const etatDesTapis = document.querySelector('input[name="Etatdestapis"]:checked')?.value || "Non évalué";
    const ceintureDeSecurite = document.querySelector('input[name="Ceinturedesecurite"]:checked')?.value || "Non évalué";
    const siege = document.querySelector('input[name="siege"]:checked')?.value || "Non évalué";
    const etatDuPlafondInterieur = document.querySelector('input[name="Etatduplafondinterieur"]:checked')?.value || "Non évalué";
    const etatDuRetementDuCofre = document.querySelector('input[name="Etatduretementducofre"]:checked')?.value || "Non évalué";

    // Collect values from radio buttons for "Aspect des Pneumatiques"
    const paireDePneusAvant = document.querySelector('input[name="pairepneusavant"]:checked')?.value || "Non évalué";
    const paireDePneusArriere = document.querySelector('input[name="pairepneusarriere"]:checked')?.value || "Non évalué";
    const etatDeLaRoueDeSecours = document.querySelector('input[name="rouesecours"]:checked')?.value || "Non évalué";

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Add data to PDF
    doc.text("Fiche de Vérification de Voiture", 10, 10);
    doc.text(`Date de vérification: ${dateVerification}`, 10, 20);
    doc.text(`Conducteur: ${conducteur}`, 10, 30);
    doc.text(`Logisticien: ${logisticien}`, 10, 40);
    doc.text(`Véhicule: ${vehicule}`, 10, 50);
    doc.text(`Immatriculation: ${immatriculation}`, 10, 60);
    doc.text(`Kilométrage actuel: ${kilometrage}`, 10, 70);

    doc.text("Aspect intérieur:", 10, 90);
    doc.text(`- Tableau de bord: ${tableauDeBord}`, 10, 100);
    doc.text(`- Frein de secours: ${freinSecours}`, 10, 110);
    doc.text(`- Pédales: ${pedales}`, 10, 120);
    doc.text(`- Jauges de niveau: ${jaugesDeNiveau}`, 10, 130);
    doc.text(`- Rétroviseur: ${retroviseur}`, 10, 140);
    doc.text(`- Compteur kilométrique: ${compteurKilometrique}`, 10, 150);
    doc.text(`- Aspect des portières: ${aspectDesPortieres}`, 10, 160);
    doc.text(`- État des vitres: ${etatDesVitres}`, 10, 170);
    doc.text(`- État des tapis: ${etatDesTapis}`, 10, 180);
    doc.text(`- Ceinture de sécurité: ${ceintureDeSecurite}`, 10, 190);
    doc.text(`- Siège: ${siege}`, 10, 200);
    doc.text(`- État du plafond intérieur: ${etatDuPlafondInterieur}`, 10, 210);
    doc.text(`- État du revêtement du coffre: ${etatDuRetementDuCofre}`, 10, 220);

    doc.text("Aspect des Pneumatiques:", 10, 240);
    doc.text(`- Paire de pneus avant: ${paireDePneusAvant}`, 10, 250);
    doc.text(`- Paire de pneus arrière: ${paireDePneusArriere}`, 10, 260);
    doc.text(`- État de la roue de secours: ${etatDeLaRoueDeSecours}`, 10, 270);

    // Add signatures to PDF
    if (!signaturePadDriver.isEmpty()) {
        const imgDataDriver = signaturePadDriver.toDataURL('image/png');
        doc.addImage(imgDataDriver, 'PNG', 10, 300, 80, 40);
    } else {
        doc.text("Pas de signature du Conducteur", 10, 310);
    }

    if (!signaturePadLogisticien.isEmpty()) {
        const imgDataLogisticien = signaturePadLogisticien.toDataURL('image/png');
        doc.addImage(imgDataLogisticien, 'PNG', 10, 350, 80, 40);
    } else {
        doc.text("Pas de signature du Logisticien", 10, 360);
    }

    doc.save("fiche_verification.pdf");
});

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- External Scripts -->
    <script src="assets/plugins/jquery/jquery-1.10.2.min.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>
