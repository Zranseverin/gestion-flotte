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
        $eid = $_GET['editid']; // ID de l'élément à modifier

        // Validation des champs obligatoires non vides
        if (empty($garage) || empty($cel) || empty($email) || empty($adresse) || empty($responsable)) {
            echo '<script>alert("Tous les champs sont obligatoires.")</script>';
        } else {
            try {
                // Vérification si le numéro de téléphone existe déjà pour un autre garage
                $ret = "SELECT cel FROM garage WHERE cel = :cel";
                $query = $dbh->prepare($ret);
                $query->bindParam(':cel', $cel, PDO::PARAM_STR);
                // Exclure le garage en cours de modification
                $query->execute();

                if ($query->rowCount() == 0) {
                    // Mise à jour des données du garage
                    $sql = "UPDATE garage SET garage = :garage, num = :num, cel = :cel, email = :email, adresse = :adresse, responsable = :responsable WHERE gid = :eid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':garage', $garage, PDO::PARAM_STR);
                    $query->bindParam(':num', $num, PDO::PARAM_STR);
                    $query->bindParam(':cel', $cel, PDO::PARAM_STR);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->bindParam(':adresse', $adresse, PDO::PARAM_STR);
                    $query->bindParam(':responsable', $responsable, PDO::PARAM_STR);
                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);

                    if ($query->execute()) {
                        echo '<script>alert("Garage modifié avec succès.")</script>';
                        echo "<script>window.location.href ='manage-garage.php'</script>";
                    } else {
                        echo '<script>alert("Une erreur est survenue. Veuillez réessayer.")</script>';
                    }
                } else {
                    echo "<script>alert('Un garage avec ce numéro de téléphone existe déjà. Veuillez entrer un autre numéro.');</script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
            }
        }
    }

?>

       
            // Vérification si un garage avec le même numéro de téléphone existe déjà
          
               

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion des flotte | Enregistré une marque</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />



</head>

<body>
<style>
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            margin-bottom: 10px;
        }
      
        /* Global container */


/* Left section */



/* Centre section */
.centre {
    flex: 1;
    min-width: 280px;
}

/* Right section */

    input[type="text"] {
   
    border: 2px solid #90EE90;
    border-radius: 4px;
    text-transform: uppercase;
}

input[type="text"]:focus {
    border-color: red;;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    text-transform: uppercase;
}
input[type="date"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="date"]:focus {
   border-color: red;;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
input[type="email"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="email"]:focus {
   border-color: red;;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
input[type="file"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="file"]:focus {
   border-color: red;;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
input[type="tel"] {
   
   border: 2px solid #90EE90;
   border-radius: 4px;
   text-transform: uppercase;
}

input[type="tel"]:focus {
   border-color: red;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
select[type="text"]:focus{
    border: 2px solid chartreuse;
   border-radius: 4px;
   text-transform: uppercase;
}
select[type="text"]:focus{
    border-color: blue;
   box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   text-transform: uppercase;
}
small {
    color: red;
    font-size: 12px;
}
.form-group input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #007bff; /* Couleur de la case cochée */
    margin-right: 5px;
}

.form-group input[type="checkbox"]:checked {
    background-color: #007bff;
    border-color: #007bff;
}

.form-group input[type="checkbox"]:hover {
    border-color: #0056b3;
    background-color: #0056b3;
}

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .left, .centre, .right {
            flex: 1;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], input[type="email"], input[type="file"], input[type="tel"], input[type="number"], input[type="time"], textarea, select {
            border: 2px solid #90EE90;
            border-radius: 4px;
            text-transform: uppercase;
        }
        input:focus, textarea:focus, select:focus {
            border-color: red;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .panel-body {
            padding: 20px;
        }


    </style>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
      <?php include_once('includes/header.php');?>
        <!-- end navbar top -->

        <!-- navbar side -->
        <?php include_once('includes/sidebar.php');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
          <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Modification  des garage</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data"> 
                                    <?php
$eid=$_GET['editid'];
$sql="SELECT * from  garage where gid=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
      <div class="container">
                                    <!-- Left Section -->
                                    <div class="left">                                
    <div class="form-group">
         <label for="exampleInputEmail1"> Nom Garage</label> <input type="text" name="garage" value="<?php  echo $row->garage;?>" class="form-control" required='true'> 
</div>
<div class="form-group">
         <label for="exampleInputEmail1">Responsable du garage</label> <input type="text" name="responsable" value="<?php  echo $row->responsable;?>" class="form-control" required='true'> 
</div>

<div class="form-group">
         <label for="exampleInputEmail1">Cel</label> <input type="text" name="cel" value="<?php  echo $row->cel;?>" class="form-control" required='true'> 

</div>
</div>
                               

                               <!-- Center Section -->
                               <div class="centre"> 
                               <div class="form-group">
         <label for="exampleInputEmail1">Tel</label> <input type="text" name="num" value="<?php  echo $row->num;?>" class="form-control" required='true'> 
</div> 
<div class="form-group">
         <label for="exampleInputEmail1">email</label> <input type="text" name="email" value="<?php  echo $row->email;?>" class="form-control" required='true'> 
         
</div>
<div class="form-group">
         <label for="exampleInputEmail1">Adresse</label> <input type="text" name="adresse" value="<?php  echo $row->adresse;?>" class="form-control" required='true'> 
         
</div>
</div>
<div class="right">

<?php $cnt=$cnt+1;}} ?>  
      <p style="padding-left: 450px"><button type="submit" class="btn btn-primary" name="submit" id="submit">Modifier</button></p> </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
<?php }  ?>