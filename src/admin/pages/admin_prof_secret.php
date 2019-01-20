<?php
	require_once "../../include/functions.inc.php";
	require_once "../../include/util.inc.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Administration</title>
	<meta charset="UTF-8"/>
	<link rel="shortcut icon" href="../../images/admin.png" type="images/png" />
	<link rel="stylesheet" href="../../css/style.css" />
	<?php require_once"../../css/admincss.php"; ?>
</head>
<body>
<header>
	<h1 style="position: absolute; margin-left: 33%;margin-top: 3%;">Administration</h1>
	<a href="https://www.u-cergy.fr/fr/index.html"><img src="../../images/logo.jpg" alt="Cergy université"></a>
</header>
<nav>
	<ul>
		<li><a href="../../index.html">Accueil</a></li>
		<li><a href="./admin.php">Filières/Groupes</a></li>
		<li><a href="./admin_prof_secret.php">Professeurs/secrétaires</a></li>
	</ul>
</nav>
<section class="blockLeft" style="height: 520px;">
	<h2>Gestion des professeurs et sécritaires</h2>
		<form style="margin: auto; width: 60%; padding-bottom: 5%;" name="inscription" method="post" action="admin_prof_secret.php">
			<fieldset style="background-color: white; color: white;">
			<legend style="color: black;">Ajouter/supprimer :</legend>
			<ul class="listButtons">
				<li>Professeur<input type='radio' name='choix' value='Professeur' checked></li>
				<li>Sécritaire<input type='radio' name='choix' value='Secritaire'></li>
			</ul>
			<div>
			<label for="nom">Nom : </label>
			<input id="nom" style="width: 45%; font-weight: bold; margin-left: 17%; margin-bottom: 3%;" placeholder="nom du prof" type="text" name="nom" title="Chaine de caractères" required />
			</div>
			<div>
			<label for="prenom">Prénom : </label>
			<input id="prenom" style="width: 45%; font-weight: bold; margin-left: 12%; margin-bottom: 3%;" placeholder="prénom du prof" type="text" name="prenom" title="Chaine de caractères" required />
			</div>
			<div>
			<label for="id">ID : </label>
			<input id="id" style="width: 45%; font-weight: bold; margin-left: 20%; margin-bottom: 3%;" placeholder="identifiant" type="text" name="identifiant" title="Chaine de caractères" required />
			</div>
			<div>
			<label for="password">Mot de passe : </label>
			<input id="password" style="width: 45%; font-weight: bold; margin-left: 2%; margin-bottom: 3%;" placeholder="password" type="password" name="password" title="Chaine de caractères" required />
			</div>
			<ul class="listButtons">
				<li><input style="margin-left: 25%; background-color: bisque;" type="submit" name="ajouter" value="Ajouter"/></li>
				<li><input style="margin-left: 25%; background-color: bisque;" type="submit" name="supprimer" value="Supprimer"/></li>
			</ul>
			</fieldset>
		</form>
		<?php
			if(isset($_POST['identifiant']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['password']) && isset($_POST['choix'])){

				// Ajouter professeur/secritaire:

				if(isset($_POST['ajouter'])){
					$hashedPassWord=password_hash($_POST['password'],PASSWORD_DEFAULT);
					$listData = array($_POST["nom"],$_POST["prenom"],$_POST["identifiant"],$hashedPassWord);
					if ($_POST['choix']=='Professeur') {
						if(!existeLineCSV("../dataProf.csv",$listData)){
							writeDataCSV("../dataProf.csv",$listData);
							echo"<p style='margin-left:32%; color:green;'>Professeur ajouté avec succès!</p>\n";
						}else{
							echo"<p style='margin-left:32%; color:red;'>Ce professeur existe déjà!</p>\n";
						}
					}else{
						if(!existeLineCSV("../dataSecret.csv",$listData)){
							writeDataCSV("../dataSecret.csv",$listData);
							echo"<p style='margin-left:32%; color:green;'>Sécritaire ajouté avec succès!</p>\n";
						}else{
							echo"<p style='margin-left:32%; color:red;'>Ce sécritaire existe déjà!</p>\n";
						}			
					}	
				}

				// Supprimer professeur/sécritaire:

				if(isset($_POST['supprimer'])){
					$listWords = array($_POST['nom'],$_POST['prenom'],$_POST['identifiant']);
					if ($_POST['choix']=='Professeur') {
						$remove = deleteLineText("../dataProf.csv",$listWords);
						if($remove){
							echo"<p style='margin-left:32%; color:green;'>Professeur supprimé avec succès!</p>\n";
						}
						else {
							echo"<p style='margin-left:32%; color:red;'>Professeur inexistant!</p>\n";
						}
					}else{
						$remove = deleteLineText("../dataSecret.csv",$listWords);
						if($remove){
							echo"<p style='margin-left:32%; color:green;'>Sécritaire supprimé avec succès!</p>\n";
						}
						else {
							echo"<p style='margin-left:32%; color:red;'>Sécritaire inexistant!</p>\n";
						}						
					}						
				}

			}
		?>
</section>
<section class="blockRight" style="height: 520px;">
	<?php
		echo "<h2>Listes des professeurs:</h2>";
		echo showListColumnsCSV("../dataProf.csv",array(0,1));
		echo "<h2>Listes des sécritaires:</h2>";
		echo showListColumnsCSV("../dataSecret.csv",array(0,1));			
	?>
</section>
<footer style="margin-top:540px;">
	<p>Site créé par HACHOUD Rassem et AYAD Ishak,le 25/Mars/2018</p>
</footer>
</body>
</html>