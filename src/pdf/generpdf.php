<?php
	use Dompdf\Dompdf;
	require_once './dompdf/autoload.inc.php';
	require_once "../include/util.inc.php";
	session_start();
	if (isset($_SESSION['trombinoPath'])  && $_SESSION['trombinoType'] ) {
		$cssContent=generTrombinoCSS();
		$htmlContent=null;
		if ($_SESSION['trombinoType']=='groupe') {
			$htmlContent=getPhotosTable($_SESSION['trombinoPath'],3);
		}elseif ($_SESSION['trombinoType']=='filiere') {
			$htmlContent=showPhotosRec($_SESSION['trombinoPath'],3);
		}
		$pdf = new Dompdf();
		$pdf->loadHtml($cssContent.$htmlContent);
		$pdf->set_paper(array(0,0,720,1200));
		//$pdf->setPaper('A4','landscape');
		$pdf->render();
		$pdf->stream("trombinoscope");
	}
?>