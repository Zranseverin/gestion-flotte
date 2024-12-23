<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Vérification de session
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Si le formulaire est soumis
    if (isset($_POST['submit'])) {
        $garage = $_POST['garage'];
        $responsable = $_POST['responsable'];
        $num = $_POST['num'];
        $cel = $_POST['cel'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];

        // Vérification des champs vides
        if (empty($garage) || empty($responsable) || empty($num) || empty($cel) || empty($email) || empty($adresse)) {
            echo '<script>alert("Veuillez remplir tous les champs.")</script>';
        } else {
            try {
                // Vérification si le garage existe déjà
                $ret = "SELECT garage FROM garage WHERE garage = :garage";
                $query = $dbh->prepare($ret);
                $query->bindParam(':garage', $garage, PDO::PARAM_STR);
                $query->execute();

                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() == 0) {
                    // Insertion des données
                    $sql = "INSERT INTO garage(garage, num, cel, email, adresse, responsable)
                            VALUES (:garage, :num, :cel, :email, :adresse, :responsable)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':garage', $garage, PDO::PARAM_STR);
                    $query->bindParam(':num', $num, PDO::PARAM_STR);
                    $query->bindParam(':cel', $cel, PDO::PARAM_STR);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
                    $query->bindParam(':responsable', $responsable, PDO::PARAM_STR);

                    $query->execute();
                    $LastInsertId = $dbh->lastInsertId();
                    if ($LastInsertId > 0) {
                        echo '<script>alert("Garage enregistré avec succès.")</script>';
                        echo "<script>window.location.href ='add-garage.php'</script>";
                    } else {
                        echo '<script>alert("Une erreur est survenue. Veuillez réessayer.")</script>';
                    }
                } else {
                    echo "<script>alert('Ce garage existe déjà. Veuillez saisir une autre marque.');</script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
            }
        }
    }

?>


<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes | Enregistrer un Garage</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <style>
        /* Styles pour les inputs et formulaires */
        input[type="text"], input[type="email"], input[type="tel"], textarea, select {
            border: 2px solid #90EE90;
            border-radius: 4px;
            text-transform: uppercase;
            padding: 10px;
            width: 100%;
        }

        input:focus, textarea:focus, select:focus {
            border-color: red;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .alert {
            padding: 10px;
            color: white;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #f44336;
        }

        .alert-success {
            background-color: #4CAF50;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .left, .centre, .right {
            flex: 1;
        }
    </style>
</head>

<body>

<div id="wrapper">
    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/sidebar.php'); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Enregistrement des Garages</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" id="garageForm">
                            <div class="container">
                                <!-- Left Section -->
                                <div class="left">
                                    <div class="form-group">
                                        <label>Nom du Garage</label>
                                        <input type="text" name="garage" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Responsable du Garage</label>
                                        <input type="text" name="responsable" required>
                                    </div>
                                </div>

                                <!-- Center Section -->
                                <div class="centre">
                                    <div class="form-group">
                                        <label>Numéro de Téléphone (Cel)</label>
                                        <input type="tel" name="cel" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" required>
                                    </div>
                                </div>

                                <!-- Right Section -->
                                <div class="right">
                                    <div class="form-group">
                                        <label>Adresse</label>
                                        <input type="text" name="adresse" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Numéro de Téléphone (Fixe)</label>
                                        <input type="tel" name="num" required>
                                    </div>
                                </div>
                            </div>

                            <p style="text-align: center;">
                                <button type="submit" class="btn btn-primary" name="submit" id="submit">
                                    <i class="fas fa-save"></i> Enregistrer
                                </button>
                            </p>
                        </form>

                        <a href="manage-garage.php" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Voir la Liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/plugins/jquery-1.10.2.js"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/plugins/pace/pace.js"></script>
<script src="assets/scripts/siminta.js"></script>

<!-- Validation JS -->
<script>
document.getElementById('submit').addEventListener('click', function(event) {
    var cel = document.querySelector('input[name="cel4"]').value;
    var email = document.querySelector('input[name="email"]').value;

    if (!/^[0-9]{10}$/.test(cel)) {
        alert('Le numéro de téléphone doit contenir exactement 10 chiffres.');
        event.preventDefault(); // Empêche l'envoi du formulaire
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Format de l\'email incorrect.');
        event.preventDefault(); // Empêche l'envoi du formulaire
    }
});
</script>

</body>
</html>

<?php } ?>
