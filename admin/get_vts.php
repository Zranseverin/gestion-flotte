<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// For techaer
if(!empty($_POST["imt"])) 
{
$imt=$_POST["imt"];
$sql=$dbh->prepare("SELECT * FROM attr_list WHERE imt=:imt");
$sql->bindParam(':imt',$imt,PDO::PARAM_STR);
$sql->execute();
$results=$sql->fetchAll(PDO::FETCH_OBJ);
?>
<option value="">Select vehicule</option>
<?php
foreach($results as $row)
{ 
?>
<option value="<?php  echo htmlentities($row->permis);?>"><?php  echo htmlentities($row->nom);?> <?php  echo htmlentities($row->prenom);?>(<?php  echo htmlentities($row->EmpID);?>)</option><?php }}



?>
 
