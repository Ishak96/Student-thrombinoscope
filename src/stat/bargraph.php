<?php
require_once ('./jpgraph/jpgraph.php');
require_once ('./jpgraph/jpgraph_bar.php');
require_once "../include/functions.inc.php";

// Create the graph. These two calls are always required
	$graph = new Graph(650,350,'auto');
	$graph->SetScale("textlin");	

	$graph->SetBox(false);
	
	$array_fillier = array();
	$array_fillier = get_fillier('../admin/Informatique',$array_fillier);
	$groupe = get_groupe("../admin/dataEffectifs.csv");

	$graph->xaxis->SetTickLabels($array_fillier);
	$graph->SetMargin(40,10,50,80);

$array = array();
	for($i=0; $i< count($groupe); $i++){
		${'data'.$i} = array();
		$array_groupe = get_effectif_groupe("../admin/dataEffectifs.csv",$groupe[$i]);
		
		for($j=0; $j< count($array_fillier); $j++){
			$fil = str_replace(' ', '_', $array_fillier[$j]);
			if(array_key_exists($fil,$array_groupe)){
				array_push(${'data'.$i}, $array_groupe[$fil]);
			}
			else {
				array_push(${'data'.$i}, 0);
			}
		}
		${'plot'.$i} = new BarPlot(${'data'.$i});
		${'plot'.$i}->SetAbsWidth(17);
		array_push($array, ${'plot'.$i});
	}
	
	$gbplot = new GroupBarPlot($array);
	$graph->Add($gbplot);
	$graph->title->Set("Les statistiques des filière");


	for($i=0; $i< count($groupe); $i++){
		${'plot'.$i}->SetLegend($groupe[$i]);
	}
	
	$graph->legend->SetFrameWeight(1);
	$graph->legend->SetColumns(6);
	$graph->legend->SetColor('#4E4E4E','#00A78A');

	$graph->Stroke();
?>	
