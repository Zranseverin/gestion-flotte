<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    
?>

<!DOCTYPE html>
<html>

<head>
    
    <title>gestion flottes soumafe | view attribution</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="assets/css/style.css" rel="stylesheet" />
      <link href="assets/css/main-style.css" rel="stylesheet" />

<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=500,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>

</head>

<body>
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
                    <h1 class="page-header">detail attribution</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="row" id="divToPrint">
                                <div class="col-lg-12">
                                   <?php
$vid=$_GET['viewid'];
$sql="SELECT * from  attr_list where ID=$vid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<h3> Attribution des véhicules aux chauffeurs</h3>
                                    <table border="1" class="table table-bordered" > 
                                    <tr align="center">
<td colspan="6" style="font-size:20px;color:blue">
 IMMATRICULATION: <?php  echo ($row->imt);?>
 
<tr>
    <th scope style="font-size:20px;color:blue">model</th>
    <td colspan="3" style="font-size:20px;color:red"><?php  echo ($row->model);?></td>
    
  </tr>
  <tr>
    <th scope style="font-size:20px;color:blue">marque</th>
    <td colspan="3" style="font-size:20px;color:red"><?php  echo ($row->marque);?></td>
    
  </tr>
  <tr>
    <th scope style="font-size:20px;color:blue">genre</th>
    <td colspan="3" style="font-size:20px;color:red"><?php  echo ($row->genre);?></td>
    
  </tr>
  <tr>
   <tr>
	<th>
	<h2>information chauffeurs</h2>
	</th>
   </tr>
  </tr>
  <tr>
    
    <th scope>permis</th>
    <td style="font-size:20px;color:blue"><?php  echo ($row->permis);?></td>
    <th scope>permis</th>
    <td style="font-size:20px;color:blue"><?php  echo ($row->permis2);?></td>
  </tr>
<tr>
    <th scope>nom</th>
    <td><?php  echo ($row->nom);?></td>
    <th scope>nom</th>
    <td><?php  echo ($row->nom2);?></td>
    

  </tr>
  <tr>
  <th scope>prenom</th>
  <td><?php  echo ($row->prenom);?></td>
  <th scope>prenom</th>
  <td><?php  echo ($row->prenom2);?></td>
    
  </tr>

  <tr>
    
    <th scope>adresse</th>
    <td><?php  echo ($row->adresse);?></td>
    <th scope>date mise en service</th>
    <td><?php  echo ($row->date);?></td>
  </tr>
                                    
   <?php $cnt=$cnt+1;}} ?>
   </table>
   <p style="text-align: center;font-size: 20px;color: red">
  <input type="button" value="print" onclick="PrintDiv();" /></p>
    
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