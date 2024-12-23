<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $imt = $_POST['imt'];
        $marque = $_POST['marque'];
        $model = $_POST['model'];
        $genre = $_POST['genre'];
        $g = $_POST['g'];
        $rg = $_POST['rg'];
        $lib = $_POST['lib'];
        $dd = $_POST['dd'];
        $ds = $_POST['ds'];
        $temps = $_POST['temps'];
        $ob = $_POST['ob'];
        $hd = $_POST['hd'];
        $hs = $_POST['hs'];
        $hr = $_POST['hr'];
        $dr = $_POST['dr'];
        $total = $_POST['total'];
        $qt= $_POST['qt'];
        $mt = $_POST['mt'];
        
        $sql = "INSERT INTO pn_list(imt, genre, marque, model,lib, g, rg, dd, ds, temps, ob,hd,hs,hr,dr,total,mt,qt) 
                VALUES (:imt, :genre, :marque, :model,:lib, :g, :rg, :dd, :ds, :temps, :ob,:hd,:hs,:hr,:dr,:total,:mt,:qt)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':imt', $imt, PDO::PARAM_STR);
        $query->bindParam(':marque', $marque, PDO::PARAM_STR);
        $query->bindParam(':model', $model, PDO::PARAM_STR);
        $query->bindParam(':genre', $genre, PDO::PARAM_STR);
        $query->bindParam(':lib', $lib, PDO::PARAM_STR);
        $query->bindParam(':g', $g, PDO::PARAM_STR);
        $query->bindParam(':rg', $rg, PDO::PARAM_STR);
        $query->bindParam(':dd', $dd, PDO::PARAM_STR);
        $query->bindParam(':ds', $ds, PDO::PARAM_STR);
        $query->bindParam(':temps', $temps, PDO::PARAM_STR);
        $query->bindParam(':ob', $ob, PDO::PARAM_STR);
        $query->bindParam(':hd', $hd, PDO::PARAM_STR);
        $query->bindParam(':hs', $hs, PDO::PARAM_STR);
        $query->bindParam(':hr', $hr, PDO::PARAM_STR);
        $query->bindParam(':dr', $dr, PDO::PARAM_STR);
        $query->bindParam(':total', $total, PDO::PARAM_STR);
        $query->bindParam(':qt', $qt, PDO::PARAM_STR);
        $query->bindParam(':mt', $mt, PDO::PARAM_STR);
        

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("pannes enregistré .")</script>';
            echo "<script>window.location.href ='add-p.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Gestion des Flottes Soumafe | pannes</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Panne</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="post" enctype="multipart/form-data">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function(){
                                        $('#imt').change(function(){
                                            var imt = $(this).val();
                                            if(imt){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'vst-driver.php',
                                                    data: {imt: imt},
                                                    success: function(response){
                                                        var data = JSON.parse(response);
                                                        $('#marque').val(data.marque);
                                                        $('#model').val(data.model);
                                                        $('#genre').val(data.genre);
                                                    }
                                                });
                                            }
                                        });

                                        $('#permis').change(function(){
                                            var permis = $(this).val();
                                            if(permis){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'get-vh.php',
                                                    data: {permis: permis},
                                                    success: function(response){
                                                        var data = JSON.parse(response);
                                                        $('#nom').val(data.nom);
                                                        $('#prenom').val(data.prenom);
                                                        $('#telephoneT').val(data.telephoneT);
                                                    }
                                                });
                                            }
                                        });
                                    });

                                    function calculerTotal() {
                                        const qt = parseFloat(document.getElementById('qt').value) || 0;
                                        const mt = parseFloat(document.getElementById('mt').value) || 0;

                                        const total = qt * mt;
                                        document.getElementById('total').value = total.toFixed(2);

                                        
                                    }

                                    function getvt(val) {
$.ajax({
type: "POST",
url: "get_vts.php",
data:'imt='+val,
success: function(data){
$("#imt").html(data);
}
});
   }
   function calculerResultats() {
                                        // Récupérer les valeurs d'entrée
                                        const hd = document.getElementById('hd').value;
                                        const hs = document.getElementById('hs').value;
                                        

                                        // Vérifier que toutes les valeurs sont valides
                                        if (!hd || !hs ) {
                                            return;
                                        }

                                        // Calcul de la différence d'heures
                                        const diffTemps = new Date(`1970-01-01T${hs}`) - new Date(`1970-01-01T${hd}`);
                                        const heures = Math.floor(diffTemps / 1000 / 60 / 60);
                                        const minutes = Math.floor((diffTemps / 1000 / 60) % 60);

                                        // Calcul de la différence de kilométrage
                                        

                                        // Afficher les résultats
                                        document.getElementById('temps').value = `${heures} heures et ${minutes} minutes`;
                                        
                                    }



                                </script>

                                <div class="form-group">
                                    <label for="imt">Immatriculation</label>
                                    <select name="imt" id="imt" class="form-control" required>
                                        <option value="">Sélectionnez l'immatriculation</option>
                                        <?php
                                        $sql2 = "SELECT * FROM attr_list";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($result2 as $row) {
                                            echo '<option value="' . htmlentities($row->imt) . '">' . htmlentities($row->imt) . '' . htmlentities($row->marque) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="marque">Marque</label>
                                    <input type="text" name="marque" id="marque" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="model">Modèle</label>
                                    <input type="text" name="model" id="model" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <input type="text" name="genre" id="genre" class="form-control" required readonly>
                                </div>

                                <div class="form-group">
                                    <label for="dd">date declaration</label>
                                    <input type="date" name="dd" id="dd" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="hd">heure declaration</label>
                                    <input type="time" name="hd" id="hd" class="form-control" required oninput="calculerResultats();">
                                </div>
                                <div class="form-group">
                                    <label for="dr">date d'entré</label>
                                    <input type="date" name="dr" id="dr" class="form-control" required oninput="calculerResultats();">
                                </div>
                                <div class="form-group">
                                    <label for="hr">heure d'entré</label>
                                    <input type="time" name="hr" id="hr" class="form-control" required oninput="calculerResultats();">
                                </div>

                                <div class="form-group">
                                    <div><p><a href="add-panne.php">lib</a></p></div>
                                    <label for="lib">libellé panne</label>
                                    <select name="lib" id="lib" class="form-control" required>
                                        <option value="">Sélectionnez la panne</option>
                                        <?php
                                        $sql2 = "SELECT * FROM panne_list";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->execute();
                                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                        foreach ($result2 as $row) {
                                            echo '<option value="' . htmlentities($row->lib) . '">' . htmlentities($row->lib) . '' . htmlentities($row->marque) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ds">date de sortie</label>
                                    <input type="date" name="ds" id="ds" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="dte">heure de  sortie</label>
                                    <input type="time" name="hs" id="hs" class="form-control" required oninput="calculerResultats();">
                                </div>

                                <div class="form-group">
                                    <label for="temps">temps</label>
                                    <input type="time" name="temps" id="temps" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="g">garage</label>
                                    <input type="text" id="g" name="g" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="rg">responsable garage</label>
                                    <input type="text" id="rg" name="rg" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Quantités</label>
                                    <input type="text" name="qt" id="qt" class="form-control"   oninput="calculerTotal()">
                                </div>

                                <div class="form-group">
                                    <label for="telephoneT">Prix.U</label>
                                    <input type="text" name="mt" id="mt" class="form-control" oninput="calculerTotal()" >
                                </div>
                                <div class="form-group">
                                    <label for="versement">total</label>
                                    <input type="text" id="total" name="total" class="form-control" required readonly>
                                </div>

                               
                               

                                <div class="form-group">
                                    <label for="ob">Observation</label>
                                    <input type="text" name="ob" id="ob" class="form-control">
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Enregistrer</button>
                                </div>
                            </form>
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

<?php }  ?>