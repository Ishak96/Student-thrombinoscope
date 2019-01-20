<?php

	require_once "util.inc.php";
	
	/**
	*cette fonction nous retourn un formulaire (login) HTML composée de deux input un de type texte et l'autre de type password
	*@return $form (Formulaire HTML)
	*/
	
	function loginFomulaProf($verify) {
		$saut = "\n";
		$tab = "\t";
		
		$form = "<div class='login'>".$saut;
		
		$form.=$tab."<form method='post' action='./identificationprofsecret.php'>".$saut;
		
		$form.=$tab."<h2 style='text-align: center; border-bottom: 2px solid #570342;'>Login</h2>".$saut;
		
		if(!$verify){
			$form.=$tab.$tab."<div style='margin-bottom: 1%; margin-top: 5%;'>".$saut;
				
			$form.=$tab.$tab."<label for='username'>Identifiant :</label>".$saut;
			$form.=$tab.$tab."<input style='margin-left: 18px;' id='username' name='username' type='text' size='25' required />".$saut;
		
			$form.=$tab.$tab."</div>".$saut;
		}
		
		$form.=$tab.$tab."<div style='margin-bottom: 5%;'>".$saut;
		
		$form.=$tab.$tab."<label for='password'>Mot de passe :</label>".$saut;
		$form.=$tab.$tab."<input id='password' name='password' type='password' size='25' required />".$saut;

		$form.=$tab.$tab."</div>".$saut;

		$form.=$tab.$tab."<input style='margin-left: 40%;' type='submit' name='CONNECTER' value='SE CONNECTER'/>".$saut;
		
		$form.=$tab."<p style='border-bottom: 2px solid #570342; border-top: 2px solid #570342;'>Je suis étudiant.Rendez-vous sur la Foire Aux Questions de <a href='../index.html'> trombinoscope </a>('J'ai perdu mon mot de passe. Comment faire?')</p>".$saut;
		
		$form.=$tab."<p style='border-bottom: 2px solid #570342;'>Je suis <a href='mailto:ishakayad96@outlook.fr'>administratif / enseignant(e)</a></p>".$saut;


		$form.="</form>".$saut;

		$form.="</div>".$saut;
		
		return $form;
	}
	
	/**
	*cette fonction nous retourne un formulaire d'inscription HTML composée de cinq input 
	*trois de type texte et deux de type password
	*ce formulaire permette a un nouveaux utilisateur de saisir son ID + Mot de passe .....
	*@return $form (Formulaire HTML)
	*/
	
	function loginFomulaEtudiant($check) {
		$saut = "\n";
		$tab = "\t";
		
		$form = "<div class='login'>".$saut;
		$form.=$tab."<form method='post' action='identificationetudiants.php'>".$saut;
		
		$form.=$tab."<h2 style='text-align: center; border-bottom: 2px solid #570342;'>Login</h2>".$saut;
		
		$form.=$tab.$tab."<div style='margin-bottom: 1%; margin-top: 5%;'>".$saut;
				
		$form.=$tab.$tab."<label for='numero'>Numéro d'étudiant :</label>".$saut;
		$form.=$tab.$tab."<input style='margin-left: 18px;' id='numero' name='numero' type='text' size='25' required />".$saut;
		
		$form.=$tab.$tab."</div>".$saut;
		
		if(!$check){
			$form.=$tab.$tab."<div style='margin-bottom: 1%;'>".$saut;
		
			$form.=$tab.$tab."<label for='nom'>Nom :</label>".$saut;
			$form.=$tab.$tab."<input id='nom' name='nom' type='text' size='25' style='margin-left:27%;' required />".$saut;

			$form.=$tab.$tab."</div>".$saut;
		
			$form.=$tab.$tab."<div style='margin-bottom: 1%;'>".$saut;
		
			$form.=$tab.$tab."<label for='prenom'>Prénom :</label>".$saut;
			$form.=$tab.$tab."<input id='prenom' name='prenom' type='text' size='25' style='margin-left:22%;' required />".$saut;
	
			$form.=$tab.$tab."</div>".$saut;
		}		

		$form.=$tab.$tab."<div style='margin-bottom: 5%;'>".$saut;
		
		$form.=$tab.$tab."<label for='groupe'>identifiant du groupe :</label>".$saut;
		$form.=$tab.$tab."<input id='groupe' name='groupe' type='text' size='25' style='margin-left:1%;' required />".$saut;

		$form.=$tab.$tab."</div>".$saut;

		$form.=$tab.$tab."<input style='margin-left: 40%;' type='submit' name='CONNECTER' value='SE CONNECTER'/>".$saut;
		
		$form.=$tab."<p style='border-bottom: 2px solid #570342; border-top: 2px solid #570342;'>Je suis étudiant.Rendez-vous sur la Foire Aux Questions de <a href='../index.html'> trombinoscope </a>('J'ai perdu mon mot de passe. Comment faire?')</p>".$saut;
		
		$form.=$tab."<p style='border-bottom: 2px solid #570342;'>Je suis <a href='mailto:ishakayad96@outlook.fr'>administratif / enseignant(e)</a></p>".$saut;

		$form.="</form>".$saut;

		$form.="</div>".$saut;
		
		return $form;
	}
	
	/**
	*cette fonction parcours récursivement l'arborescence des fichiers et affiche sont contenue dans une liste HTML
	*@param $dir le chemin des fichiers
	*@param $abslut_path le chemin absolue des fichiers
	*/	

	function show_tree($dir,$abslut_path) {
		$saut = "\n";
		$tab = "\t"; 
	
		$folder = opendir ($dir);
		
			while ($file = readdir ($folder)) {
				if ($file != "." && $file != "..") {
					$pathfile = $dir.'/'.$file;
					$path = $abslut_path.'/'.rawurlencode($file);
					if(!strpos($file, ".")){
						if(strripos($file, "roupe") or strripos($file, "TD") or strripos($file, "TP")){
							echo $tab.$tab.$tab."<li style=' font-family: Arial, sans-serif;font-size: 100%;
  									color: black;display : list-item; margin-left:15%; margin-top:5%;
  									list-style-image : url(../../images/groupe.png)'>
  									<a href=$path>$file</a></li>".$saut;
  						}
  						else {							
							echo $tab.$tab.$tab."<li style=' font-family: Arial, sans-serif;font-size: 100%;
  									color: black;display : list-item; margin-top:5%;
  									list-style-image : url(../../images/folder.png)'>
  									<a href=$path>$file</a></li>".$saut;
  						}
					}
					else{
						$string = explode('.', $file);
						echo $tab.$tab.$tab."<li style=' font-family: Arial, sans-serif;font-size: 100%;
  								color: black;display : list-item; margin-left:30%; margin-top:5%;
  								list-style-image : url(../../images/etudiant.png)'>
  								<a href=$path>".$string[0]."</a></li>".$saut; 					
					}
	
					if(filetype($pathfile) == 'dir'){
						show_tree($pathfile,$path);
					} 
				} 
			} 
			closedir ($folder);
	}
	
	/**
	*cette fonction nous supprime un ensemble de fichiers
	*@param $strDirectory le chemin des fichiers
	*/	
	
	function rmAllDir($strDirectory){
		
    $handle = opendir($strDirectory);
    while(false !== ($entry = readdir($handle))){
    	
        if($entry != '.' && $entry != '..'){
        	
            if(is_dir($strDirectory.'/'.$entry)){
                rmAllDir($strDirectory.'/'.$entry);
            }
            elseif(is_file($strDirectory.'/'.$entry)){
                unlink($strDirectory.'/'.$entry);
            }
        }
    }
    rmdir($strDirectory.'/'.$entry);
    closedir($handle);
	}
	
	/**
	*cette fonction créé une clef du groupe.
	*@param $filier le nom de la filière
	*@param $groupe le nom du groupe
	*/	

	function creat_Groupe_ID($filier, $groupe) {
		$licence = substr($filier,0,2);
		$groupe_carac = substr($groupe,-1);
		
		$groupe_ID = $licence.'Trambino'.$groupe_carac;
		$listData = array($filier,$groupe,$groupe_ID);
		
		writeDataCSV("../dataGroupe_ID.csv",$listData);
	}

	/**
	*cette fonction vérifier si la clef du groupe sélectionnée est parmi celle créé.
	*@param $Groupe_ID le nom de la filière
	*/	
	
	function VerifyGroupe_ID($Groupe_ID) {
		$list_info_filier = null;
		
		if(file_exists("../admin/dataGroupe_ID.csv")){
			
			$file = fopen("../admin/dataGroupe_ID.csv",'r');
		
			while (!feof($file) && $list_info_filier == null) {
				$line=fgetcsv($file);
			
				if ($Groupe_ID==$line[2]) {
					$list_info_filier = array(1=>$line[0],$line[1]);
				}
			}
			fclose($file);
		}	
		return $list_info_filier;		
	}

	/**
	*cette fonction vérifier si un étudiant a correctement communiquer ces informations.
	*@param $numero le numéros de l'étudiant
	*@param $Groupe_ID le groupe de l'étudiant
	*@param $Nom le nom de l'étudiant
	*@param $Prenom le prénom de l'étudiant
	*@return un booléenne
	*/		
	
	function verifyEtudiant($numero,$Groupe_ID,$Nom,$Prenom) {
		$is_stu = false;
		$two_num = substr($numero,0,2);
		$list_info_filier = VerifyGroupe_ID($Groupe_ID);
		
		if(ctype_digit(intval($numero)) && strlen($numero) == 8 && ($two_num == 21 || $two_num == 20) && $numero[2] > 2 && $list_info_filier != null){
			$groupe = $list_info_filier[2];
			$filier = $list_info_filier[1];
			$listData = array($filier,$groupe,$numero,$Nom,$Prenom,'Non');
			if(!file_exists("../admin/dataEtudiant.csv") || !verify_groupe_etudiant($filier,$groupe,$Nom,$Prenom,$numero)){
				writeDataCSV("../admin/dataEtudiant.csv",$listData);
			}
			$is_stu = true;
		}
		return $is_stu;
	}
	
	/**
	*cette fonction vérifier si un étudiant a correctement communiquer ces informations.
	*@param $nom le nom de l'étudiant
	*@param $prenom le prénom de l'étudiant
	*@param $groupe le groupe de l'étudiant
	*@return un tableau PHP
	*/		

	function verify_pic_nom($nom,$prenom,$numero,$groupe){
		$file = fopen("../admin/dataEtudiant.csv",'r');
		
		$list_info_etu = array();
		$find = false;
		$groupe_liste = VerifyGroupe_ID($groupe);
		
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);

			if ($nom==$line[3] && $prenom==$line[4] && $numero==$line[2] && $groupe_liste[1] == $line[0] && $groupe_liste[2] == $line[1] && $line[5] != 'Non') {
				$find = true;				
				$list_info_etu = array($line[0],$line[1],$line[5],$line[6]);
			}
		}
		fclose($file);
		return $list_info_etu;
	}
	
	/**
	*cette fonction récupère les information d'un étudiant.
	*@param $nom le nom de l'étudiant
	*@param $prenom le prénom de l'étudiant
	*/

	function search_name($nom, $prenom){
		$file = fopen("../admin/dataEtudiant.csv",'r');
		$list_info_etu = null;
		
		while (!feof($file) && $list_info_etu == null) {
			$line=fgetcsv($file);

			if ($nom==$line[3] && $prenom==$line[4] && $line[5] != 'Non') {
				$list_info_etu = array($line[0],$line[1],$line[5],$line[6]);
			}
		}
		fclose($file);
		return $list_info_etu;
	}	

	/**
	*cette fonction vérifier si un étudiant a bien choisie son groupe.
	*@param $nom le nom de l'étudiant
	*@param $prenom le prénom de l'étudiant
	*@param $groupe le groupe de l'étudiant
	*@param $fillier la filière de l'étudiant
	*@param $numero le numéro de l'étudiant
	*@return un tableau HTML
	*/	
	
	function verify_groupe_etudiant($fillier,$groupe,$nom,$prenom,$numero){
		$file = fopen("../admin/dataEtudiant.csv",'r');
		$find = false;
		
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);

			if ($nom==$line[3] && $prenom==$line[4] && $numero==$line[2]) {
				if($fillier == $line[0] && $groupe == $line[1]){
					$find = true;
				}
			}
		}
		fclose($file);
		return $find;
	}
	
	/**
	*cette fonction charge plus d'information sur un étudiant la date du dépôt de l'image ....
	*@param $nom le nom de l'étudiant
	*@param $prenom le prénom de l'étudiant
	*@param $groupe le groupe de l'étudiant
	*@param $fillier la filière de l'étudiant
	*@param $date la date du dépôt
	*@param $destination_pic le chemin de l'image
	*/		

	function etudiant_upload_pic($nom,$prenom,$numero,$date,$destination_pic,$fillier) {
		$originFile = fopen('../admin/dataEtudiant.csv','r');
		$newFile = fopen('temp','w');
		
		$groupe_etudiant = explode('/', $fillier);
		
		while ( ($currentLine = fgetcsv($originFile)) !== false ){		
			
			if ($numero!=$currentLine[2] || $nom!=$currentLine[3] || $prenom!=$currentLine[4]) {
				fputcsv($newFile,$currentLine);
			}
			else if($numero==$currentLine[2] && $nom==$currentLine[3] && $prenom==$currentLine[4] && $currentLine[5] == 'Non') {
				
				incremat_effectif($groupe_etudiant[0],$groupe_etudiant[1]);
				
				$list_info_etu = array($currentLine[0],$currentLine[1],$numero,$nom,$prenom,$date,$destination_pic,"Ok");
				fputcsv($newFile,$list_info_etu);
			}
		}
		fclose($originFile);
		fclose($newFile);
		rename('temp','../admin/dataEtudiant.csv');
	}
	
	/**
	*cette fonction incrément les effectifs d'une filière et groupe
	*@param $fillier le nom de l'étudiant
	*@param $groupe le prénom de l'étudiant
	*/	

	function incremat_effectif($fillier,$groupe) {
		$originFile = fopen('../admin/dataEffectifs.csv','r');
		$newFile = fopen('temp_temp','w');
		
		while ( ($currentLine = fgetcsv($originFile)) !== false ){		
			if(count($currentLine) == 2){
				if ($fillier!=$currentLine[0]) {
					fputcsv($newFile,$currentLine);
				}
				else {
					$list_effectif = array($currentLine[0],$currentLine[1]+1);
					fputcsv($newFile,$list_effectif);
				}			
			}
			else{
				if ($fillier!=$currentLine[0] || $groupe!=$currentLine[1]) {
					fputcsv($newFile,$currentLine);
				}
				else if($groupe == $currentLine[1]) {
					$list_effectif = array($currentLine[0],$currentLine[1],$currentLine[2]+1);
					fputcsv($newFile,$list_effectif);
				}		
			}
		}
		
		fclose($originFile);
		fclose($newFile);
		rename('temp_temp','../admin/dataEffectifs.csv');
	}
	
	function Echec_login_etudiant($tentative,$nom,$prenom,$nombre_tentative=3){
		$saut = "\n";
		$tab = "\t";	
	
		$echec = $tab."<div class='info'>".$saut;
		
		$echec .= $tab.$tab."<div class='nomPrenom'>".$saut;
		$echec .= $tab.$tab.$tab."<p>Se connecter en tant que $nom $prenom</p>".$saut;
		$echec .= $tab.$tab."</div>".$saut;
				
		$echec .= $tab."<div class='error'>".$saut;
		
		if($tentative){
			$echec .= $tab.$tab."<div class='message1'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Veuillez attendre un moment.</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
			$echec .= $tab.$tab."<div class='message2'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Il semble que vous avez dépasser le nombre de tentative permis.
			mais nous vous demandons d'attendre un moment par raisons de sécurité.</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
				
			$echec .= $tab."</div>".$saut;
		
			$echec .= $tab."</div>".$saut;
		}
		else {
			$echec .= $tab.$tab."<div class='message1'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Veuillez confirmer le numéro d'étudiant</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
			$echec .= $tab.$tab."<div class='message2'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Il semble que vous ayez saisi un numéro d’étudiant ou un identifiant de groupe mal orthographiée. 
			mais nous vous demandons de saisir de nouveau votre mot de passe par sécurité.</p>".$saut;
			$echec .= $tab.$tab.$tab."<p>Attention il vous reste ".(3-$nombre_tentative)." tentatives</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
					
			$echec .= $tab."</div>".$saut;
		
			$echec .= $tab."</div>".$saut;	
		}
		
		return $echec;
	}
	
	function Echec_login_ProfsSecret($find,$nom=null,$prenom=null){
		$saut = "\n";
		$tab = "\t";	
	
		$echec = $tab."<div class='info'>".$saut;
		
		if($find){
			$echec .= $tab.$tab."<div class='nomPrenom'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Se connecter en tant que $nom $prenom</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
		}

		if($find){
			$echec .= $tab."<div class='error'>".$saut;			
		}
		else {
			$echec .= $tab."<div style='margin-top: 5%;' class='error'>".$saut;
		}
		
		$echec .= $tab.$tab."<div class='message1'>".$saut;
		$echec .= $tab.$tab.$tab."<p>Veuillez confirmer vos informations.</p>".$saut;
		$echec .= $tab.$tab."</div>".$saut;
		
		if($find){
			$echec .= $tab.$tab."<div class='message2'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Il semble que vous ayez saisi un mot de passe mal orthographiée. 
			mais nous vous demandons de saisir de nouveau votre mot de passe par sécurité.</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
		}
		else {
			$echec .= $tab.$tab."<div class='message2'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Il semble que vous ayez saisi un mot de passe ou un identifiant mal orthographiée. 
			mais nous vous demandons de saisir de nouveau votre mot de passe et votre identifiant par sécurité.</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
		}
			
		$echec .= $tab."</div>".$saut;
		
		$echec .= $tab."</div>".$saut;
		
		return $echec;	
	}
	
	function str_replace_espace($espace,$string) {
		if($espace){
			$str = str_replace(" ", "_", $string);		
		}
		else{
			$str = str_replace("_", " ", $string);			
		}
		return $str;
	}
	
	function liste_option($dir,$i,$fillier=null) {
		$saut = "\n";
		$tab = "\t";
		
		$folder = opendir ($dir);
		$fil = null;
			
			while ($file = readdir ($folder)) {
				if($file != "." && $file != ".." && !strpos($file, ".")){
					
					$op = str_replace_espace(false,$file);
					if($file[0] == "L"){
						if($i > 0) {
							echo $tab.$tab."</optgroup>".$saut;	
						}
						echo $tab.$tab."<optgroup label='".$op."'>".$saut;
						$fil = $file;
					}
					else{
						echo $tab.$tab."<option value='".$fillier."/".$file."'> ".$op." </option>".$saut;
					}
					
					$pathfile = $dir.'/'.$file;
					
					if(filetype($pathfile) == 'dir'){
						liste_option($pathfile,$i+1,$fil);
					}				
				}
			}
			closedir ($folder);	
	}
	
	function select($dir) {
		$saut="\n";
		$tab="\t";
		
			echo $tab."<table style='border-style: none; margin: 50px auto;'>".$saut;
								
			echo $tab.$tab."<tr>".$saut;
			echo $tab.$tab.$tab."<td><select style='margin-left: 22%;' name='filier' id='filier'>".$saut;
			echo $tab.$tab.$tab."<option disabled selected value> -- Filière/Groupe -- </option>".$saut;			
			
			echo liste_option($dir,0);
			
			echo $tab.$tab.$tab."</select></td>".$saut;
			
			echo $tab.$tab."</tr>".$saut;

			echo $tab.$tab."<tr>".$saut;			
			
			echo $tab.$tab.$tab."<td><label for='file' class='input-label'>Sélectionné votre photo</label></td>".$saut;
			echo $tab.$tab.$tab."<td><input class='champ' id='file' name='file' type='file' accept='image/*'/></td>".$saut;
			
			echo $tab.$tab."</tr>".$saut;
		
			echo $tab.$tab."<tr>".$saut;
		
			echo $tab.$tab.$tab."<td style='border-style: none;'><input style='background-color: bisque; width: 50%; margin-left: 25%;' type='submit' name='upload' value='Upload' /></td>".$saut;
		
			echo $tab.$tab."</tr>".$saut;

			echo $tab."</table>".$saut;	
	}
	
	function verify_login($fileNameCSV,$login){
		
		$file = fopen($fileNameCSV,'r');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2]){
				$find=true;
			}
		}
		fclose($file);
		return $find;
	}
	
	function get_name_surname($fileNameCSV,$login) {
		$file = fopen($fileNameCSV,'r');
		$infos = array();
		$find = false;
		
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2]){
				$infos = array("nom"=>$line[0],"prénom"=>$line[1]);
				$find=true;
			}
		}
		fclose($file);
		return $infos;	
	}

	function upload_image_error($has_uploaded,$error_type=null) {
		$saut="\n";
		$tab="\t";
				
		$echec = $tab."<div class='info'>".$saut;
		
		if($has_uploaded) {
			$echec .= $tab."<div class='check'>".$saut;
			
			$echec .= $tab.$tab."<div class='message1'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Votre photo a était bien charger</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
			$echec .= $tab.$tab."<div class='message2'>".$saut;
			$echec .= $tab.$tab.$tab."<p>Merci d'avoir charger votre photo sur le tambinoscope de votre groupe
			vous pouvez la modifier et la visualiser juste a coté.</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;	
		}
		else {
			$echec .= $tab."<div class='error'>".$saut;
			
			$echec .= $tab.$tab."<div class='message1'>".$saut;
			$echec .= $tab.$tab.$tab."<p>échec de chargement</p>".$saut;
			$echec .= $tab.$tab."</div>".$saut;
			if($error_type == "size"){
				$echec .= $tab.$tab."<div class='message2'>".$saut;
				$echec .= $tab.$tab.$tab."<p>Il semble que vous ayez saisi une photo de très grande taille
				veuillez changer de photo et recharger.</p>".$saut;
				$echec .= $tab.$tab."</div>".$saut;				
			}
			elseif($error_type == "ext") {
				$echec .= $tab.$tab."<div class='message2'>".$saut;
				$echec .= $tab.$tab.$tab."<p>Il semble que vous n'avez pas saisi une photo veuillez charger une photo s'il vous plait.</p>".$saut;
				$echec .= $tab.$tab."</div>".$saut;		
			}
			else {
				$echec .= $tab.$tab."<div class='message2'>".$saut;
				$echec .= $tab.$tab.$tab."<p>échec de chargement.</p>".$saut;
				$echec .= $tab.$tab."</div>".$saut;						
			}
		}
		
		$echec .= $tab."</div>".$saut;
		
		$echec .= $tab."</div>".$saut;
		
		return $echec;
	}	
	
	function upload_image($destination,$nom,$prenom,$numero,$file_ext,$file_destination,$file_error,$file_size,$file_tmp) {
		
		$groupe_etudiant = explode('/', $destination);
		$allowed = array("png","jpg","jpeg");		
	
		if(in_array($file_ext, $allowed)){
			if($file_error === 0){
				if($file_size <= 2097152){
					if(move_uploaded_file($file_tmp, $file_destination)){
						convertImage($file_destination, '200', '200', $file_ext);
						etudiant_upload_pic($nom,$prenom,$numero,date('l-j-m-Y G:m:s',time()),$file_destination,$destination);
						echo upload_image_error(true);		
					}
					else {
						echo upload_image_error(false);
					}			
				}
				else{
					echo upload_image_error(false,"size");
				}
			}
			else{
				echo upload_image_error(false);
			}
		}
		else{
			echo upload_image_error(false,"ext");
		}	
	}
	
	function convertImage($source, $width, $height, $ext) {
		
		$imageSize = getimagesize($source);
		
		switch($ext) {
			case 'png':
			$imageRessource = imagecreatefrompng($source);
				break;		
				
			case 'jpg':
			$imageRessource = imagecreatefromjpeg($source);
				break;
				
			case 'jpeg':
			$imageRessource = imagecreatefromjpeg($source);
				break;	
		}
		
		$imageFinal = imagecreatetruecolor($width, $height);
		
		$final = imagecopyresampled($imageFinal, $imageRessource, 0, 0, 0, 0, $width, $height, $imageSize[0], $imageSize[1]);
		
		switch($ext) {
			case 'png':
			imagepng($imageFinal, $source);
				break;
				
			case 'jpg':
			imagejpeg($imageFinal, $source);
				break;
				
			case 'jpeg':
			imagejpeg($imageFinal, $source);
				break;	
		}
	}
	
	function array_information_autocomplete($fileNameCSV) {
		$array = array();
		
		if(file_exists($fileNameCSV)) {
			$file = fopen($fileNameCSV,'r');
		
			while (!feof($file)) {
				$line=fgetcsv($file);
				if($line[3] != null and $line[4] != null){
					$id = $line[3].':'.str_replace('_', ' ', $line[4]);
					array_push($array, $id);
				}
			}
			fclose($file);
		}
		
		return $array;
	}
	
	function get_fillier_effectif($fileNameCSV, $fillier) {
		$effectif = 0;
		if(file_exists($fileNameCSV)) {
			$file = fopen($fileNameCSV,'r');
		
			while (!feof($file)) {
				$line=fgetcsv($file);
				if($line[0] == $fillier and count($line) == 2){
					$effectif = $line[1];
				}
			}
			fclose($file);
		}
		return $effectif;
	}
	
	function get_array_effectif($fileNameCSV, $fillier) {
		$effectif_fillier = array();
		
		if(file_exists($fileNameCSV)) {
			$effectif_total = get_fillier_effectif($fileNameCSV, $fillier);
			$file = fopen($fileNameCSV,'r');
		
			while (!feof($file)) {
				$line=fgetcsv($file);
				if($line[0] == $fillier and count($line) != 2){
					$effectif = ($line[2]*100)/$effectif_total;
					
					array_push($effectif_fillier, $effectif);
				}
			}
			fclose($file);
		}
		return $effectif_fillier;
	}
	
	function get_array_nameGroupe($fileNameCSV, $fillier) {
		$effectif_groupe = array();
		
		if(file_exists($fileNameCSV)) {
			$file = fopen($fileNameCSV,'r');
		
			while (!feof($file)) {
				$line=fgetcsv($file);
				if($line[0] == $fillier and count($line) != 2){
					$groupe = str_replace_espace(false,$line[1])." (%d)";
					
					array_push($effectif_groupe, $groupe);
				}
			}
			fclose($file);
		}
		return $effectif_groupe;
	}
	
	function get_fillier($dir,$array) {
		$folder = opendir ($dir);
		
		while ($file = readdir ($folder)) {
			if ($file != "." && $file != "..") {
				$pathfile = $dir.'/'.$file;
				if(!strpos($file, ".")){
					$file_str = str_replace('_', ' ', $file);
					array_push($array,$file_str);
				}
				
				if(filetype($pathfile) == 'dir'){
					get_fillier($pathfile,$array);
				} 
			}
		}
		closedir ($folder);
		return $array;
	}
	
	function get_groupe($fileNameCSV) {
		$total_groupe = array();
		
		if(file_exists($fileNameCSV)) {
			$file = fopen($fileNameCSV,'r');
		
			while (!feof($file)) {
				$line=fgetcsv($file);
				if(count($line) > 2){
					$groupe = str_replace_espace(false,$line[1]);
					if(!in_array($groupe,$total_groupe)){
						array_push($total_groupe, $groupe);
					}
				}
			}
			fclose($file);
		}
		return $total_groupe;
	}
	
	function get_effectif_groupe($fileNameCSV, $groupe) {
		$groupe = str_replace_espace(true,$groupe);
		$total_groupe_effectif = array();
		
		if(file_exists($fileNameCSV)) {
			$file = fopen($fileNameCSV,'r');
		
			while (!feof($file)) {
				$line=fgetcsv($file);
				if(count($line) > 2 and $line[1] == $groupe){
					$effectif = $line[2];
					$total_groupe_effectif[$line[0]] = $effectif;
				}
			}
			fclose($file);
		}
		return $total_groupe_effectif;
	}
?>