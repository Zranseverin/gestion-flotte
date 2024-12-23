<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $AdminName = $_POST['AdminName'];
    $MobileNumber = $_POST['MobileNumber'];

    // Vérifiez si l'utilisateur existe déjà
    $sql = "SELECT * FROM tbladmin WHERE UserName=:username OR Email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "<script>alert('Ce nom d\'utilisateur ou email existe déjà.');</script>";
    } else {
        // Insérez un nouvel utilisateur
        $sql = "INSERT INTO tbladmin (UserName,AdminName,MobileNumber, Password, Email) VALUES (:username,:AdminName,:MobileNumber, :password, :email)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':AdminName', $AdminName, PDO::PARAM_STR);
        $query->bindParam(':MobileNumber', $MobileNumber, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        if ($query->execute()) {
            echo "<script>alert('Inscription réussie. Vous pouvez maintenant vous connecter.');</script>";
            echo "<script type='text/javascript'> document.location ='index.php'; </script>";
        } else {
            echo "<script>alert('Quelque chose s\'est mal passé. Veuillez réessayer.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Gestion flotte soumafe | Inscription</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
</head>

<body class="body-Login-back">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
                <h3 style="color: white;">Système de gestion flotte VTC soumafe - Inscription</h3>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">S'inscrire</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" name="signup">
                            <fieldset>
                                <div class="form-group">
                                    <label for="signup-username">Nom d'utilisateur</label>
                                    <input type="text" class="form-control" name="username" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="signup-AdminName">Login</label>
                                    <input type="text" class="form-control" name="AdminName" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="signup-MobileNumber">Telephone</label>
                                    <input type="text" class="form-control" name="MobileNumber" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="signup-email">Email</label>
                                    <input type="email" class="form-control" name="email" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="signup-password">Mot de passe</label>
                                    <input type="password" class="form-control" name="password" required="true">
                                </div>
                                <input type="submit" value="S'inscrire" class="btn btn-lg btn-success btn-block" name="signup">
                            </fieldset>
                        </form>
                        <div>
                            <i class="fa fa-home" style="font-size: 30px" aria-hidden="true"></i>
                            <p><a href="index.php">Connexion</a></p>
                        </div>
                        <div>
                            <i class="fa fa-home" style="font-size: 30px" aria-hidden="true"></i>
                            <p><a href="../index.php">Accueil</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
</body>

</html>
