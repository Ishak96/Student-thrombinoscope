<?php

	/*
	cette fonction permet d'écrire des donées dans un fichier csv.
	*/

	function writeDataCSV($fileNameCSV,$listData){
		$file = fopen($fileNameCSV,'a+');
		fputcsv($file,$listData);
		fclose($file);
	}

	/*
	Cette fonction retourne TRUE si le login et le mot de passe passés comme parametres existent bien dans le fichier csv spécifié. Elle retourne FALSE sinon.
	*/

	function verify($fileNameCSV,$login,$password){
		$file = fopen($fileNameCSV,'r');
		$find = false;
		while (!feof($file) && !$find) {
			$line=fgetcsv($file);
			if ($login==$line[2] && password_verify($password,$line[3])) {
				$find=true;
			}
		}
		fclose($file);
		return $find;
	}

	/*
	Cette fonction permet de supprimer une ligne d'un fichier texte, si elle contient la liste de mots passée en parametres.Elle retourne TRUE si la ligne est bien supprimée, FALSE sinon.
	*/

	function deleteLineText($fileName,$listWords){
		$originFile = fopen($fileName,'r');
		$newFile = fopen('temp','w');
		$lineRemoved=false;
		while ( ($currentLine = fgetcsv($originFile)) !== false ){
			$findWord=true;
			if (count($listWords) <= count($currentLine)) {
				$i= 0;
				while ( $i < count($listWords) and $findWord) {
					if (strcmp($currentLine[$i],$listWords[$i]) !== 0) {
						$findWord=false;
					}
					$i++;
				}	
			}else{
				$findWord=false;
			}
			if(!$findWord){
				fputcsv($newFile,$currentLine);
			}else{
				$lineRemoved=true;
			}	
		}
		fclose($originFile);
		fclose($newFile);
		rename('temp',$fileName);
		return $lineRemoved;
	}

	/*
	Cette fonction permet d'afficher les photos rangées dans une arborescence de dossiers.
	*/
	function showPhotosRec($dir,$lineSize=5) {
		$dir=str_replace(' ','_',$dir);
		$folder = opendir ($dir);
		$list='';	 		
		while ($file = readdir ($folder)) {
			if ($file != "." && $file != ".."){ 
				$pathfile = $dir.'/'.$file;
				if (is_dir($pathfile)) {
					$list.="<li>";
					$list.=getPhotosTable($pathfile,$lineSize);
					$list.="</li>";
					showPhotosRec($pathfile);
				}
			}
		} 
		closedir ($folder);
		return $list;
	}

	/*
	Cette fonction retourne un tableau html contenant les photos stockées dans le dossier spécifié.
	*/
	function getPhotosTable($dir,$lineSize=5) {
		$dir=str_replace(' ','_',$dir);
    	$tabFiles = scandir($dir);
    	$k=0;

    	$groupe=substr($dir,strripos($dir,'Informatique'));
    	$groupe=substr($groupe,13);
    	$groupe=str_replace('_',' ',$groupe);

    	$table="<table class='photosTable'>\n";
    	$table.="<tr><th colspan=".$lineSize.">".$groupe."</th></tr>";
    	foreach($tabFiles as $file){
        	if ($file!= "." && $file!= ".."){
				if ($k==0) {
    				$table.="<tr>\n";
    			}
        		$path = $dir.'/'.$file;
        		$lastmod= "Uploaded on : ".date('F d Y ', filectime($path));
				if (is_file($path)) { 
					$image ="<figure>";
					$image.="<img src='".$path."' alt='".$file."' title='".$lastmod."'>";
					$studentName=substr_replace($file,'',strpos($file,'.'));
					$studentName=str_replace('_',' ', $studentName);
					$image.="<figcaption style='text-align:center;'>".$studentName."</figcaption>";
					$image.="</figure>";
					$table.="<td>$image</td>\n";
				}
				$k++;
				if($k==$lineSize) {
    				$table.="</tr>\n";
    				$k=0;
    			}
        	} 	
    	}
    	if ($k>0 && $k<$lineSize) {
    		while ($k<$lineSize) {
    			$table.="<td></td>\n";
    			$k++;
    		}
    		$table.="</tr>\n";
    	}
    	$table.="</table>\n";
    	return $table;
	}

	/*
	Cette fonction retourne une liste contenant des colonnes précises d'un fichier csv  
	*/
	function showListColumnsCSV($fileNameCSV,$listIndexColumns){
		$file = fopen($fileNameCSV,'r');
		$list="<ul style='text-align:center;font-weight: bold;
			font-size: 14pt;'>";
		while ($line=fgetcsv($file)) {
			$list.="<li>";
			foreach ($listIndexColumns as $index) {
				$list.="$line[$index] ";
			}
			$list.="</li>";
		}
		$list.="</ul>";
		fclose($file);
		return $list;
	}
	/*
	Cette vérifie si une ligne précise existe dans un fichier csv. 
	*/
	function existeLineCSV($fileName,$listWords){
		$File = fopen($fileName,'r');
		$exist=false;
		while (!$exist && ($currentLine = fgetcsv($File)) !== false){
			if (count($listWords) == count($currentLine)) {
				$i= 0;
				$equals=true;
				while ( $i < count($listWords) && $equals) {
					if (strcmp($currentLine[$i],$listWords[$i]) !== 0) {
						$equals=false;
					}
					$i++;
				}
				if ( $i >= count($listWords)) {
					$exist=true;
				}
			}
		}
		fclose($File);
		return $exist;
	}
	/*
	Cette fonction génére du code css pour l'affichage de trombinoscope 
	*/
	function generTrombinoCSS(){
		return
		'<style>
		.photosTable{
			margin: auto;
			background-color: #E6E6E6;
			border: 2px solid #570342;
			font-weight: bold;
			font-style: italic;
			color: #570342;
			font-size: 15pt;
			text-align: center;
			margin-bottom:20px;
		}
		.photosTable th{
 			border-bottom: 2px solid #570342;
 			font-size: 25pt;
 			padding: 0.2%;
		}
		li{
			list-style-type: none;
		}
		</style>';	
	}

	/*
	Cette fonction retourne une liste d'options permettant de choisir une filière
	*/
	function listOptionFilier($root){
		$filiers=scandir($root);
		$listOption='<label  for="filiere">Filiere :</label>';
		$listOption.='<select name="filiere" id="filiere">';
		foreach ($filiers as $value) {
			if ($value!='.' && $value!='..') {
				$listOption.='<option>'.str_replace('_',' ',$value).'</option>';
			}
		}
		$listOption.='</select>';
		return $listOption;
	}

?>