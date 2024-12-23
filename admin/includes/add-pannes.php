<!DOCTYPE html>
   <html>
   <head>
       <title>Gestion des flottes soumafe | Enregistrement du véhicule</title>
       <!-- Core CSS - Include with every page -->
       <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
       <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
       <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
       <link href="assets/css/style.css" rel="stylesheet" />
       <link href="assets/css/main-style.css" rel="stylesheet" />
       <link rel="stylesheet" href="forme.css">
       <link rel="stylesheet" href="forme.css">
   </head>
   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <body>
   <style>
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
   border-color: red;;
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
</style>
       <div id="wrapper">
           <!-- navbar top -->
           <?php include_once('includes/header.php'); ?>
           <!-- end navbar top -->
   
           <!-- navbar side -->
           <?php include_once('includes/sidebar.php'); ?>
           <!-- end navbar side -->
   
           <!-- page-wrapper -->
           <div id="page-wrapper">
               <div class="row">
                   <!-- page header -->
                   <div class="col-lg-12">
                       <h1 class="page-header">Enregistrement des contrats des véhicules</h1>
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
                                       <div class="container">
                                      