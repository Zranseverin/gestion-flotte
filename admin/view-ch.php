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
    
    <title>gestion des flotte soumafe | </title>
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
                    <h1 class="page-header">chauffeurs Details</h1>
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
$sql="SELECT * from  chauffeur_list where chID=$vid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<p style="text-align: center;font-size: 20px;color: red">
<input type="button" value="print" onclick="PrintDiv();" /></p>
                                    <table border="1" class="table table-bordered" > 
                                    <tr align="center">
                                    <tr>
    <th scope>Photo</th>
    <td colspan="4"><img src="images/<?php  echo ($row->photo);?>" width="100" height="100"></td>

  </tr>
<td colspan="6" style="font-size:20px;color:blue">
  ID: <?php  echo ($row->PassNumber);?></td></tr>
   <tr>
        <th scope>Nom</th>
    <td colspan="3"><?php  echo ($row->nom);?></td>
  </tr>
<tr>
    <th scope>Prenom</th>
    <td colspan="3"><?php  echo ($row->prenom);?></td>
    
  </tr>
  <tr>
    <th scope>sexe</th>
    <td colspan="3"><?php  echo ($row->sexe);?></td>
    
  </tr>
  <tr>
    <th scope>date de naissance</th>
    <td colspan="3"><?php  echo ($row->dateN);?></td>
    
  </tr>
 

  <tr>
    <th scope>domicile</th>
    <td><?php  echo ($row->adresse);?></td>
    <th scope>telephone bureau</th>
    <td><?php  echo ($row->telephoneT);?></td>
  </tr>
<tr>
    <th scope>permis</th>
    <td><?php  echo ($row->permis);?></td>
    <th scope>cni</th>
    <td><?php  echo ($row->cni);?></td>

  </tr>
  <tr>
    <th scope>telephone 1</th>
    <td><?php  echo ($row->telephone1);?></td>
    <th scope>telephone 2</th>
    <td><?php  echo ($row->telephone2);?></td>
  </tr>
<tr>
    <th scope>date mise en service</th>
    <td><?php  echo ($row->date);?></td>
    <th scope>fin de service</th>
    <td><?php  echo ($row->fin);?></td>
  </tr>
  <tr>
    
    
    <th scope> Status</th>
    <td><?php  echo ($row->status);?></td>
  </tr>
                                    
   <?php $cnt=$cnt+1;}} ?>
   </table>
   
    
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