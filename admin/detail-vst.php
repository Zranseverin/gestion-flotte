<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $imt=$_POST['imt'];
$nom=$_POST['nom'];
$permis=$_POST['permis'];
$prenom=$_POST['prenom'];
$versement=$_POST['versement'];
$genre=$_POST['genre'];
$pointage=$_POST['pointage'];
$recette=$_POST['recette'];
$date=$_POST['date'];
$total_v=$_POST['total_v'];
$total_p=$_POST['total_p'];
$total_r=$_POST['total_r'];
$total=$_POST['total'];

$sql="insert into vsmt_list(imt,genre,permis,nom,prenom,date,versement,pointage,recette,total_v,total_r,total_p,total)values(:imt,:genre,:permis,:nom,:prenom,:date,:versement,:pointage,:recette,:total_v,:total_r,:total_p,:total)";
$query=$dbh->prepare($sql);
$query->bindParam(':imt',$imt,PDO::PARAM_STR);
$query->bindParam(':permis',$permis,PDO::PARAM_STR);
$query->bindParam(':nom',$nom,PDO::PARAM_STR);
$query->bindParam(':prenom',$prenom,PDO::PARAM_STR);
$query->bindParam(':genre',$genre,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':versement',$versement,PDO::PARAM_STR);
$query->bindParam(':pointage',$pointage,PDO::PARAM_STR);
$query->bindParam(':recette',$recette,PDO::PARAM_STR);
$query->bindParam(':total_v',$total_v,PDO::PARAM_STR);
$query->bindParam(':total_r',$total_r,PDO::PARAM_STR);
$query->bindParam(':total_p',$total_p,PDO::PARAM_STR);
$query->bindParam(':total',$total,PDO::PARAM_STR);



 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("versement detail has been added.")</script>';
echo "<script>window.location.href ='add-vst.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  


}
?>
<!-- Created by TopStyle Trial - www.topstyle4.com -->
<!DOCTYPE html>
<html>
<head>
	<title>chcode_appli</title>
		<meta charset="utf8">
			<link rel="stylesheet" type="text/css" href="lestyle.css">
</head>

<body>
	<form action="" method="POST">
	<label><b>Matricule :</b></label>
	<input type="text" name="imt" value="<?php echo"$imt";?>" >
	<input type="submit" name="brech1" value="Chercher"><br><br>
	<label><b>Année :</b></label>
	<input type="text" name="permis">	
	<input type="submit" name="brech2" value="Chercher">

	</form>
	<br>
	<?php 
	$exe=mysqli_query($conn,"select sum(total) as mass from payement");
	if($qq=mysqli_fetch_assoc($exe)){
	$mass=$qq['mass'];
	echo"<b>Masse salariale : $mass FCFA</b><br><br>";
	}
	?>

	<?php 
	 //recherche paies

	 if(isset($_POST['brech1'])){
	   $rq=mysqli_query($conn,"select imt,nom,prenom,total,sum(versement) as total,
	    versement-sum(total) as m_recette,date from vh_list inner join payement
	    on salaires.matricule=payement.idsal where annee='$an' and mois='$mois'  group by matricule,annee,mois");
	print'<table border="1" class="tab"><tr><th>Matricule</th><th>Nom</th><th>Prenom</th>
	<th>Salaire mensuel (FCFA)</th><th>Montant perçu</th><th>Reste</th><th>Année</th><th>Mois</th></tr>';
	     while($rst=mysqli_fetch_assoc($rq)){
	     
	       
	         print"<tr>";
	         echo"<td>".$rst['matricule']."</td>";
	         echo"<td>".$rst['nom']."</td>";
	         echo"<td>".$rst['prenom']."</td>";
	         echo"<td>".$rst['t_mensuel']."</td>";
	         echo"<td>".$rst['sm_percu']."</td>";
	         echo"<td>".$rst['m_restant']."</td>";
	         echo"<td>".$rst['annee']."</td>";
	         echo"<td>".$rst['mois']."</td>";
	         echo'<td><a href="detail.php?MATRICULE='.$rst['matricule'].'&amp ANNEE='.$rst['annee'].'&amp MOIS='.$rst['mois'].'">Détail</a></td>';
	         print"</tr>";   
	     }
	   print'</table>';
	 $lrq=mysqli_query($conn,"select sum(m_percu) as percu from payement where annee='$an' and mois='$mois'");
	   if($rr=mysqli_fetch_assoc($lrq)){
	   $percu=$rr['percu'];
	   }
	   $np=$mass-$percu;
	echo"<br><b>Montant des salaires perçus : $percu FCFA</b>";
	echo"<br><b>Montant des salaires non payés : $np FCFA</b>";
	 }
	
	?>
	
	<?php 
	 //recherche paies 2

	 if(isset($_POST['brech1'])){
	   $rq=mysqli_query($conn,"select matricule,nom,prenom,t_mensuel,sum(m_percu) as sm_percu,
	    t_mensuel-sum(m_percu) as m_restant,annee,mois from salaires inner join payement
	    on salaires.matricule=payement.idsal where annee='$an' and mois='$mois' and matricule='$mat'  group by matricule,annee,mois");
	print'<table border="1" class="tab"><tr><th>Matricule</th><th>Nom</th><th>Prenom</th>
	<th>Taux mensuel (FCFA)</th><th>Montant perçu</th><th>Reste</th><th>Année</th><th>Mois</th></tr>';
	     while($rst=mysqli_fetch_assoc($rq)){
	     
	       
	         print"<tr>";
	         echo"<td>".$rst['matricule']."</td>";
	         echo"<td>".$rst['nom']."</td>";
	         echo"<td>".$rst['prenom']."</td>";
	         echo"<td>".$rst['t_mensuel']."</td>";
	          echo"<td>".$rst['sm_percu']."</td>";
	          echo"<td>".$rst['m_restant']."</td>";
	           echo"<td>".$rst['annee']."</td>";
	           echo"<td>".$rst['mois']."</td>";
	echo'<td><a href="detail.php?MATRICULE='.$rst['matricule'].'&amp ANNEE='.$rst['annee'].'&amp MOIS='.$rst['mois'].'">Détail</a></td>';
	         print"</tr>";   
	     }
	   print'</table>';
	 
	 }
	 
	 /*application réalisée du 03 au 07 Mai 2020 à N'djaména au Tchad par
Targoto Christian
Contact: 23560316682 / ct@chrislink.net */
	
	?>
	
	</div>

</body>
</html>
<?php }  ?>