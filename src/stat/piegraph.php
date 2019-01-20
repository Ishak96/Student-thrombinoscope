<?php // content="text/plain; charset=utf-8"
require_once ('./jpgraph/jpgraph.php');
require_once ('./jpgraph/jpgraph_pie.php');
require_once "../include/functions.inc.php";

session_start();
if (isset($_SESSION['trombinoPath'])) {
	
	$_SESSION['trombinoPath'] = str_replace_espace(true,$_SESSION['trombinoPath']);
	$string = explode('/', $_SESSION['trombinoPath']);	
	
	$fillier =$string[2].'_'.str_replace_espace(false,$string[3]);
	// Some data
	$data = get_array_effectif("../admin/dataEffectifs.csv", $string[3]);

	// Create the Pie Graph. 
	$graph = new PieGraph(850,550);

	// Set A title for the plot
	$graph->title->Set("Les statistiques de la filière : ".$fillier.".");
	$graph->SetBox(true);

	// Create
	$p1 = new PiePlot($data);
	$p1->SetLabelPos(0.6);
	$p1->SetLabelType(PIE_VALUE_ABS);

	$legends = get_array_nameGroupe("../admin/dataEffectifs.csv", $string[3]); 

	$p1->SetLegends($legends); 

	$graph->Add($p1);

	$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
	$graph->Stroke();
}
?>