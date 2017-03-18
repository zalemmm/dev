<?php
//$xlsfile = addslashes($_GET['file']);
$filename = addslashes($_GET['name']); 
$barcode = addslashes($_GET['barcode']);
$number = $_GET['number'];

$path = $_SERVER['DOCUMENT_ROOT'];

ob_start();

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

include_once("class/PHPExcel.php");
include_once("fonc/fonc_extraireBLXSL.php");
//include_once("fonc/fonc_barcode");



ob_end_clean();

ob_start();

$liste_elt_ok = "";
$liste_elt_ko = "";
$count_elt_ok = 0;
$count_elt_ko = 0;


if($liste_bl = extraireBLXLS($path . '/uploaded/' . $number . '/BL.xls')) {
	global $wpdb;
	$count_elt = count($liste_bl);
	foreach ($liste_bl AS $code_bl) {
		if($code_bl != 0) {			
			if($donnees_client = $wpdb->get_row("SELECT * FROM wp_retail WHERE retail_code = '" . $code_bl . "'")) {				
				echo "<page>";
				if(is_file(__DIR__.'/tpl/'.$donnees_client->retail_enseigne.'.jpg')) {
					echo "<img src='".__DIR__."/tpl/".$donnees_client->retail_enseigne.".jpg' />";
				} else {
					echo "<img src='".__DIR__."/tpl/defaut.jpg' width='100%' />";
				}								
								
				echo "<img style='margin-left: 75px; margin-right: 75px; margin-top: 75px; float: left;' src='".__DIR__ ."/" . $barcode . "' width='250' alt='code barre' />";
								
				echo "<p style='font-family: Arial; font-size: 24px; font-weight: bold;'>";				
				echo $donnees_client->retail_enseigne."<br />".$donnees_client->retail_contact."<br />".$donnees_client->retail_adresse."<br />".$donnees_client->retail_cp."&nbsp;".$donnees_client->retail_ville."<br /><br />TEL : ".$donnees_client->retail_tel;
				echo "</p></page>";
				
				$liste_elt_ok .= $code_bl.'<br />';
				$count_elt_ok++;
				
			} else {
				$liste_elt_ko .= $code_bl.'<br />';
				$count_elt_ko++;
			}
		} else {
			$liste_elt_ko .= $code_bl.'<br />';
			$count_elt_ko++;
		}
	}

}

	echo '<page><p>Impression des bons de livraison de la commande '. $number . '</p>';
	echo '<p>' . $count_elt . ' codes Point de vente fournis dans le fichier BL.xls.</p>';
	echo '<p>' . $count_elt_ok . ' bons de livraisons imprimés correspondant aux points de vente suivant :</p>';
	echo '<p>' . $liste_elt_ok . '</p>';
	echo '<p><strong>Attention !</strong> ' . $count_elt_ko . ' bons de livraisons n\'ont pas pu être imprimé pour cause de référence point de vente erronnée :</p>';
	echo '<p>' . $liste_elt_ko . '</p>'; 
	echo '</page>';


	$content = ob_get_clean();

    require_once(dirname(__FILE__).'/class/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','fr');
    $pdf->WriteHTML($content);
    $pdf->Output($filename.'.pdf');
?>

