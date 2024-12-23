<?php
session_start();
include('includes/dbconnection.php');

// Check if session exists
if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $permis = $_POST['permis'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $hd = $_POST['hd'];
        $ha = $_POST['ha'];
        $tth = $_POST['tth'];
        $dkm = $_POST['dkm'];
        $akm = $_POST['akm'];
        $totkm = $_POST['totkm'];
        $ob = $_POST['ob'];
        $ID = $_POST['ID'];
        $aID = $_POST['aID'];
        $eid = $_GET['editid'];  // Get the record's ID from the URL

        // Update query
        $sql = "UPDATE svi_list SET 
                imt = :imt, 
                marque = :marque, 
                model = :model,  
                permis = :permis, 
                nom = :nom, 
                prenom = :prenom, 
                date = :date, 
                hd = :hd, 
                ha= :ha, 
                tth = :tth, 
                dkm = :dkm, 
                akm = :akm,
                totkm = :totkm, 
                ob = :ob,
                ID = :ID,
                aID = :aID 
                WHERE kID = :eid";

        $query = $dbh->prepare($sql);

        // Bind parameters
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':permis', $permis, PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->bindParam(':hd', $hd, PDO::PARAM_STR);
        $query->bindParam(':ha', $ha, PDO::PARAM_STR);
        $query->bindParam(':tth', $tth, PDO::PARAM_STR);
        $query->bindParam(':dkm', $dkm, PDO::PARAM_STR);
        $query->bindParam(':akm', $akm, PDO::PARAM_STR);
        $query->bindParam(':totkm', $totkm, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);
        $query->bindParam(':ID', $ID, PDO::PARAM_STR);
        $query->bindParam(':aID', $aID, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);

        // Execute query
        $query->execute();

        // Provide user feedback and redirect
        echo '<script>alert("Record updated successfully.")</script>';
        echo "<script>window.location.href ='manage-svi.php'</script>";
    }

    // Retrieve existing record data to display in the form
    $eid = $_GET['editid'];
    $sql = "SELECT * FROM svi_list WHERE kID = :eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle Record</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <!-- Include header and sidebar -->
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Vehicle Record</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Details
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="imt">Immatriculation</label>
                                    <input type="text" name="imt" id="imt" class="form-control" value="<?php echo htmlentities($result->imt); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" class="form-control" value="<?php echo htmlentities($result->marque); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" value="<?php echo htmlentities($result->model); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="permis">Permis</label>
                                    <input type="text" name="permis" id="permis" class="form-control" value="<?php echo htmlentities($result->permis); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" value="<?php echo htmlentities($result->nom); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" value="<?php echo htmlentities($result->prenom); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="<?php echo htmlentities($result->date); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="hd">Heure de Départ</label>
                                    <input type="time" name="hd" id="hd" class="form-control" value="<?php echo htmlentities($result->hd); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="ha">Heure d'Arrivée</label>
                                    <input type="time" name="ha" id="ha" class="form-control" value="<?php echo htmlentities($result->ha); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="dkm">Km Départ</label>
                                    <input type="number" name="dkm" id="dkm" class="form-control" value="<?php echo htmlentities($result->dkm); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="akm">Km Arrivée</label>
                                    <input type="number" name="akm" id="akm" class="form-control" value="<?php echo htmlentities($result->akm); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="totkm">Total Kilométrage</label>
                                    <input type="text" name="totkm" id="totkm" class="form-control" value="<?php echo htmlentities($result->totkm); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" class="form-control" value="<?php echo htmlentities($result->ob); ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php } ?>
