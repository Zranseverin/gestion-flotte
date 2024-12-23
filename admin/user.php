<?php
session_start();
include('includes/dbconnection.php');

// Assurez-vous que seul un administrateur peut accéder à cette page
if (strlen($_SESSION['bpmsaid'] == 0)) {
    header('location:logout.php');
} else {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="forme.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <meta charset="UTF-8">
    <title>Historique des actions des utilisateurs</title>
    <!-- Inclure les CSS ici -->
</head>
<body>

    <style>
        /* Custom styles for the page */
body {
    background-color: #f8f9fa;
    font-family: 'Arial', sans-serif;
}

#wrapper {
    margin-top: 20px;
}

h1.page-header {
    color: #007bff;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;
}

.panel {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    background-color: #ffffff;
}

.panel-body {
    padding: 20px;
}

.table {
    width: 100%;
    margin-bottom: 20px;
    background-color: #ffffff;
    border-collapse: collapse;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
}

.table thead th {
    background-color: #007bff;
    color: #ffffff;
    font-weight: bold;
}

.table tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

.table tbody tr:hover {
    background-color: #e9ecef;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

/* Style the buttons in the header */
.header-btn {
    margin-bottom: 15px;
    text-align: right;
}

/* Custom styles for responsiveness */
@media (max-width: 768px) {
    h1.page-header {
        font-size: 24px;
    }

    .table thead {
        display: none;
    }

    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }

    .table tr {
        margin-bottom: 15px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        font-weight: bold;
        text-transform: uppercase;
    }
}

    </style>
    <div id="wrapper">
        <!-- Navbar top et sidebar inclus ici -->
        <?php include_once('includes/header.php'); ?>
        <?php include_once('includes/sidebar.php'); ?>
        
        <!-- Page wrapper -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Historique des actions des utilisateurs</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th>Nom d'utilisateur</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Date de l'action</th>
                                        <th>Adresse IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT a.AdminName, ua.action, ua.description, ua.action_date, ua.ip_address 
                                            FROM tbluseractions ua 
                                            JOIN tbladmin a ON ua.ID = a.ID
                                            ORDER BY ua.action_date DESC";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($result->AdminName); ?></td>
                                                <td><?php echo htmlentities($result->action); ?></td>
                                                <td><?php echo htmlentities($result->description); ?></td>
                                                <td><?php echo htmlentities($result->action_date); ?></td>
                                                <td><?php echo htmlentities($result->ip_address); ?></td>
                                            </tr>
                                    <?php } } else { ?>
                                        <tr>
                                            <td colspan="5">Aucune action enregistrée.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Inclure les scripts JS -->
    <script src="assets/plugins/jquery/jquery-1.10.2.min.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
</body>
</html>

<?php } ?>
