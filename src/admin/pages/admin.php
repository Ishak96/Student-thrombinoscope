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
		<li><a href="./admin_prof_secret.php">Professeurs/Sécritaires</a></li>
	</ul>
</nav>
<section class="blockLeft" style="height: 450px;">
	<h2>Gestion des filières et groupes</h2>
		<form style="margin: auto; width: 60%; padding-bottom: 5%;" name="inscription" method="post" action="admin.php">	
			<fieldset style="background-color: white; color: white;">
			<legend style="color: black;">Ajouter/supprimer :</legend>			
			<div>
			<label for="filieres">Filières : </label>
			<input id="filieres" style="width: 45%; font-weight: bold; margin-left: 16%; margin-bottom: 3%;" placeholder="filière" type="text" name="filier" title="Chaine de caractères" pattern="^L(.*)$" required />
			</div>			
			<div>
			<label for="groupe">Groupe TD/TP : </label>
			<input id="groupe" style="width: 45%; font-weight: bold; margin-left: 3%; margin-bottom: 3%;" placeholder="groupe" type="text" name="groupe" title="Chaine de caractères" />
			</div>
			<ul class="listButtons">
				<li><input style="margin-left: 40%; background-color: bisque;" type="submit" name="ajouter" value="Ajouter"/></li>
				<li><input style="margin-left: 40%; background-color: bisque;" type="submit" name="supprimer" value="Supprimer"/></li>
			</ul>
			</fieldset>
		</form>
		<?php 
			if(isset($_POST['filier']) AND isset($_POST['groupe'])){

				// Ajouter filière/groupe:

				if (isset($_POST['ajouter'])) {
					$groupe = str_replace_espace(true,$_POST['groupe']);
					$filier = str_replace_espace(true,$_POST['filier']);
					$directory='../Informatique/'.$filier.'/'.$groupe;
					$directory_Filier = '../Informatique/'.$filier;
				
					if (!file_exists($directory) AND !empty($_POST['groupe'])) {
						
						$listData = array($filier,$groupe,0);
						$listData2 = array($filier,0);
						
						if(!file_exists($directory_Filier)){							
							writeDataCSV("../dataEffectifs.csv",$listData2);
						}
						writeDataCSV("../dataEffectifs.csv",$listData);
						creat_Groupe_ID($filier,$groupe);
						mkdir($directory,0777,true);		
						echo "<p style='color:green;text-align:center'>Groupe ajouté avec succès</p>";
					}
					elseif(!file_exists($directory_Filier) AND empty($_POST['groupe'])){
							mkdir($directory_Filier,0777,true);
							$listData = array($filier,0);
							writeDataCSV("../dataEffectifs.csv",$listData);
							echo "<p style='color:green;text-align:center'>Filière ajoutée avec succès</p>";
					}	
					else{
						echo "<p style='color:red;text-align:center'>Ce repertoire existe déja!</p>\n";
					}
				}

				// Supprimer filière/groupe:

				if(isset($_POST['supprimer'])){
					$groupe = str_replace_espace(true,$_POST['groupe']);
					$filier = str_replace_espace(true,$_POST['filier']);
					if (!empty($_POST['filier']) AND !empty($_POST['groupe'])) {
						$directory='../Informatique/'.$filier.'/'.$groupe;
						if (file_exists($directory)) {
							$listWords = array($filier,$groupe);
							if(file_exists('../dataEtudiant.csv')){
								deleteLineText("../dataEtudiant.csv",$listWords);
							}
							deleteLineText("../dataGroupe_ID.csv",$listWords);
							deleteLineText("../dataEffectifs.csv",$listWords);
							rmAllDir($directory);
							echo "<p style='color:green;text-align:center'>Groupe supprimé avec succès!</p>";
						}else{
							echo "<p style='color:red;text-align:center'>Le groupe que vous souhaitez supprimer n'existe pas!</p>";
						}
					}
					elseif(!empty($_POST['filier']) AND empty($_POST['groupe'])) {
						$directory='../Informatique/'.$filier;
						if (file_exists($directory)) {
							$listWords = array($filier);
							if(file_exists('../dataEtudiant.csv')){
								deleteLineText("../dataEtudiant.csv",$listWords);
							}
							deleteLineText("../dataGroupe_ID.csv",$listWords);
							deleteLineText("../dataEffectifs.csv",$listWords);
							rmAllDir($directory);
							echo "<p style='color:green;text-align:center'>Filière supprimé avec succès!</p>";
						}else{
							echo "<p style='color:red;text-align:center'>La filière que vous souhaitez supprimer n'existe pas!</p>";
						}
					}
				}
			}
		?>
</section>
<section class="blockRight" style="height: 450px;">
	<h2>Liste des groupes TD</h2>
		<ul class="folder" style="margin: auto;overflow:auto;height:300px;width: 50%;">
			<?php show_tree("../Informatique","../Informatique"); ?>
		</ul>
</section>
<footer style="margin-top: 470px;">
	<p>Site créé par HACHOUD Rassem et AYAD Ishak,le 25/Mars/2018</p>
</footer>
</body>
</html>