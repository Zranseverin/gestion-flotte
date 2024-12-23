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
<option value="">Select Teacher</option>
<?php
foreach($results as $row)
{ 
?>
<option value="<?php  echo htmlentities($row->permis);?>"><?php  echo htmlentities($row->nom);?> <?php  echo htmlentities($row->prenom);?>(<?php  echo htmlentities($row->telephoneT);?>)</option><?php }}

//For Subject
if(!empty($_POST["imt"])) 
{
$imt=$_POST["imt"];
$query=$dbh->prepare("SELECT * FROM attr_list WHERE imt=:imt");
$query->bindParam(':imt',$imt,PDO::PARAM_STR);
$query->execute();
$resultss=$query->fetchAll(PDO::FETCH_OBJ);


?>
<option value="">Select Subject</option>
<?php
foreach($resultss as $rows)
{ 
?>
<option value="<?php  echo htmlentities($rows->permis);?>"><?php  echo htmlentities($rows->nom);?>(<?php  echo htmlentities($rows->prenom);?>)</option><?php }}




?>
 
