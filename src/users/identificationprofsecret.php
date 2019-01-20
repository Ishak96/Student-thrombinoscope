<?php
	session_start ();
	require_once "../include/functions.inc.php";
	require_once "../include/util.inc.php";

	if (isset($_SESSION['username']) and isset($_SESSION['password'])) {
		if (verify("../admin/dataProf.csv",$_SESSION['username'],$_SESSION['password']) OR verify("../admin/dataSecret.csv",$_SESSION['username'],$_SESSION['password'])) {
			header('location: ./professeur_secretaire.php');
			exit();
		}		
	}
	
	$verify = true;       
	if(isset($_POST['CONNECTER'])){
		if(!empty($_POST['username'])){
			$_SESSION['username']=$_POST['username'];
		}
			if (verify("../admin/dataProf.csv",$_SESSION['username'],$_POST['password']) OR verify("../admin/dataSecret.csv",$_SESSION['username'],$_POST['password'])){
				$verify = true; 
				$_SESSION['password']=$_POST['password'];
				header('location: ./professeur_secretaire.php');
				exit();
      		}
      	else {
      		$verify = false;
      	}
 	 }  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<title>Central Authentification Service</title>
<meta charset="UTF-8"/>
<link rel="shortcut icon" href="../images/authentification.png" type="images/png" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../css/identificationcss.css" />
</head>
<body>
<header>
	<h1>Service Central d'authentifications</h1>
	<h2>trombinoscopes</h2>
	<h2 style="padding-top: 2%;">Universit&eacute; de Cergy-Pontoise</h2>
	<a href="https://www.u-cergy.fr/fr/index.html"><img src="../images/logo.jpg" alt="Cergy université" height="100" width="140"></a>
</header>
	<?php
		if(isset($_SESSION['username']) and (verify_login("../admin/dataProf.csv",$_SESSION['username']) || verify_login("../admin/dataSecret.csv",$_SESSION['username']))){
			
			$infos = get_name_surname("../admin/dataProf.csv",$_SESSION['username']);
			if($infos == null) {
				$infos = get_name_surname("../admin/dataSecret.csv",$_SESSION['username']);
			}
			
			echo Echec_login_ProfsSecret(true,$infos['nom'],$infos['prénom']);
			echo loginFomulaProf(true);
		}
		else if(isset($_SESSION['username']) and (!verify_login("../admin/dataProf.csv",$_SESSION['username'])|| !verify_login("../admin/dataSecret.csv",$_SESSION['username']))){
			echo Echec_login_ProfsSecret(false);
			echo loginFomulaProf(false);
		}
		else {
			echo loginFomulaProf(false);
		}
	?>
	<footer>
		<p>Site créé par HACHOUD Rassem et AYAD Ishak,le 25/Mars/2018</p>
	</footer>
</body>
</html>