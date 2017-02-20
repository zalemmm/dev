<?php
require('fpdf.php');
define('FPDF_FONTPATH','font/');  //definiuje katalog z czcionkami komponentu

$a = $_POST[a];
$b = $_POST[b];
$c = $_POST[c];
$d = $_POST[d];
$where = $_POST[e];
$connection = @mysql_connect($d, $b, $c) or die(); 
$db = @mysql_select_db($a, $connection) or die(); 

class PDF extends FPDF
{
//Page header
function Header()
{
    $this->Image('printlogo.jpg',10,8,85);
	$this->SetY(60);
}

}





//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
//$pdf->AddFont('fontpl','','fontpl.php');  //dodaje swoj± czcionkê arialpl do dokumentu
//$pdf->SetFont('fontpl','', 12);  //ustawia czcionkê arialpl, rozmiar 12

	$query = "SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `wp_fbs_order` WHERE status>=3 AND status<6".$where." ORDER BY date_modify DESC";
//	$query = "SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `wp_fbs_order` WHERE status>=3 AND status<6 ORDER BY date_modify DESC";
	$result = MYSQL_QUERY($query) or die(mysql_error());
	$wszystkie = mysql_numrows($result);

$x=0;
while ($x < $wszystkie) {
	$row = mysql_fetch_array($result);
	$pdf->AddPage();
    //Arial bold 15
    $pdf->SetY(20);
    $pdf->SetFont('Arial','BUI',8);
	$pdf->Cell(0,5,'CLIENT:',0,1,'R');
    $pdf->SetFont('Arial','I',8);
	$userquery = "SELECT * FROM `wp_fbs_users` WHERE id = '".$row[user]."'";
	$userresult = MYSQL_QUERY($userquery) or die(mysql_error());
	$singleuser = mysql_fetch_array($userresult);
			$explode = explode('|', $singleuser['f_address']);
			$f_address = $explode['0'];
			$f_porte = $explode['1'];
			$explode2 = explode('|', $singleuser['l_address']);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'];
	if ( ( ($l_address != "") && ($f_address != $l_address) ) || ( ($singleuser->l_name != "") && ($singleuser->f_name != $singleuser->l_name) ) ) {
		$pdf->Cell(0,4,$singleuser[l_name],0,1,'R');
		$pdf->Cell(0,4,$singleuser[l_comp],0,1,'R');
		$pdf->Cell(0,4,$l_address,0,1,'R');
		if (!empty($l_porte)) {
			$pdf->Cell(0,4,$l_porte,0,1,'R');
		}
		$pdf->Cell(0,4,$singleuser[l_code],0,1,'R');
		$pdf->Cell(0,4,$singleuser[l_city],0,1,'R');
		$pdf->Cell(0,4,$singleuser[l_phone],0,1,'R');
	} else {
		$pdf->Cell(0,4,$singleuser[f_name],0,1,'R');
		$pdf->Cell(0,4,$singleuser[f_comp],0,1,'R');
		$pdf->Cell(0,4,$f_address,0,1,'R');
		if (!empty($f_porte)) {
			$pdf->Cell(0,4,$f_porte,0,1,'R');
		}
		$pdf->Cell(0,4,$singleuser[f_code],0,1,'R');
		$pdf->Cell(0,4,$singleuser[f_city],0,1,'R');
		$pdf->Cell(0,4,$singleuser[f_phone],0,1,'R');
	}
	$pdf->SetY(60);
///////////
	$pdf->SetFont('Arial','BI',9);
	$pdf->Cell(0,6,'FACTURE N°F - '.$row[unique_id],0,1,'C');
	$pdf->Cell(0,6,'DATE - '.$row[datamodyfikacji],0,1,'C');
	$pdf->Cell(0,4,'Madame, Monsieur,',0,1,'C');
	$pdf->Cell(0,4,'Veuillez trouver ci-dessous votre facture concernant la commande ref: '.$row[unique_id],0,1,'C');
	$pdf->Cell(0,4,'Dans l\'attente d\'une collaboration prochaine, ',0,1,'C');
	$pdf->Cell(0,4,'Veuillez agréer, Madame, Monsieur, nos salutations respectueuses.',0,1,'C');
	$pdf->SetY(92);

    $w=array(50,28,28,28,28,28);
	$header=array('DESCRIPTION','QUANTITÉ','PRIX U.','OPTION','REMISE','TOTAL');
	$pdf->SetFont('Arial','B',7);
    for($i=0;$i<count($header);$i++) {
    	if($i==0) {
	        $pdf->Cell($w[$i],5,$header[$i],'TB',0,'L');
	    } else {
	        $pdf->Cell($w[$i],5,$header[$i],'TB',0,'C');
	    }
	}
    $pdf->Ln();
    //// listowanie produktów
	$query2 = "SELECT * FROM `wp_fbs_prods` WHERE order_id = '".$row[unique_id]."' ORDER BY id ASC";
	$data = MYSQL_QUERY($query2) or die(mysql_error());
	$all = mysql_numrows($data);
	$x2 = 0;
$speceuro = '';
	while ($x2 < $all) {
		$a = mysql_fetch_array($data);
		if ($speceuro == '') {
	        $speceuro = explode(' ',$a[frais]);
    	    $speceuro = $speceuro[1];
    	}
		$pdf->SetFont('Arial','B',7);
        $pdf->Cell($w[0],6,$a[name],'');
		$pdf->SetFont('Arial','',7);
		$a[prix] = str_replace('&euro;', $speceuro, $a[prix]);
		$a[prix_option] = str_replace('&euro;', $speceuro, $a[prix_option]);
		$a[remise] = str_replace('&euro;', $speceuro, $a[remise]);
		$a[total] = str_replace('&euro;', $speceuro, $a[total]);
        $pdf->Cell($w[1],6,$a[quantity],'',0,'C');
        $pdf->Cell($w[2],6,$a[prix],'',0,'C');
        $pdf->Cell($w[3],6,$a[prix_option],'',0,'C');
        $pdf->Cell($w[4],6,$a[remise],'',0,'C');
        $pdf->Cell($w[5],6,$a[total],'',0,'C');
        $pdf->Ln();
        $gdziejestem = $pdf->GetY();
        $pdf->SetY($gdziejestem-1);
	    $opis=explode('<br />',$a[description]);
	    $opis_all = count($opis);
	    for($i=0;$i<$opis_all;$i++) {
	    	if (($i+1 == $opis_all) && ($x2+1 != $all)) {
		        $pdf->Cell($w[0],4,$opis[$i],'');
	    	} else {
		        $pdf->Cell($w[0],4,$opis[$i],'');
		    }
    	    $pdf->Ln();
		}
        $gdziejestem = $pdf->GetY();
        $pdf->SetY($gdziejestem+2);
		if ( ($all > 1) && ($x2 < $all) ) {
			$pdf->Cell(array_sum($w),0,'','B');
			$pdf->Ln();
		}
		$x2++;
	}
 	$czyjestrabat = "SELECT * FROM `wp_fbs_remises` WHERE unique_id = '".$row[unique_id]."'";
	$czyrabat = MYSQL_QUERY($czyjestrabat) or die(mysql_error());
	$all3 = mysql_numrows($czyrabat);
	if ($all3 > 0) {
		$pdf->Cell(array_sum($w),0,'','B');
		$pdf->Ln();
		$x3 = 0;
		while ($x3 < $all3) {
			$a3 = mysql_fetch_array($czyrabat);
			$pdf->SetFont('Arial','B',7);
	        $pdf->Cell($w[0],6,$a3[reason],'B');
			$pdf->SetFont('Arial','',7);
	        $pdf->Cell($w[1],6,'','B',0,'C');
	        $pdf->Cell($w[1],6,'','B',0,'C');
	        $pdf->Cell($w[1],6,'','B',0,'C');
	        $pdf->Cell($w[1],6,'','B',0,'C');
	        $pdf->Cell($w[1],6,$a3[remis].' '.$speceuro,'B',0,'C');
	        $x3++;
		}
	} else {
		$pdf->Cell(array_sum($w),0,'','B');
	}
///// podsumowanie kwot
// rabat uzytkownika //
	$czyrabatuzytkownika = 0;
 	$czyjestremisenew = "SELECT * FROM `wp_fbs_remisenew` WHERE sku = '".$row[unique_id]."'";
	$czyremisenew = MYSQL_QUERY($czyjestremisenew);
	if ($czyremisenew) {
		$czyremisenew = mysql_fetch_array($czyremisenew);
		$remisenew_procent = $czyremisenew[percent];
		$remisenew_kwota = $czyremisenew[remisenew];
		$czyrabatuzytkownika = 1;
	}
//koniec//

 	$czyjesttva = "SELECT * FROM `wp_fbs_remises` WHERE unique_id = '".$row[unique_id]."-tva'";
	$czytva = MYSQL_QUERY($czyjesttva);
	if ($czytva) {
		$czytva = mysql_fetch_array($czytva);
		$procpod = $czytva[remis];
	} else {
		$procpod = '20.00';
	}
    $gdziejestem = $pdf->GetY();
	$pdf->SetY($gdziejestem+1);
    $pdf->Ln(); $pdf->SetX(157);    
    
    if ($czyrabatuzytkownika == 1) {
		$pdf->Cell(33,6,'REMISE ('.$remisenew_procent.'%)','B',0,'L');
		$remisenew_kwota = str_replace('.', ',', $remisenew_kwota);
		$pdf->Cell(10,6,$remisenew_kwota.' '.$speceuro,'B',0,'R');
	    $pdf->Ln(); $pdf->SetX(157);
    }
    
	$pdf->Cell(33,6,'FRAIS DE PORT','B',0,'L');
	$tfrais = str_replace('.', ',', $row[frais]);
	$pdf->Cell(10,6,$tfrais.' '.$speceuro,'B',0,'R');
    $pdf->Ln(); $pdf->SetX(157);

	$pdf->Cell(33,6,'TOTAL HT','B',0,'L');
	$ttotalht = str_replace('.', ',', $row[totalht]);
	$pdf->Cell(10,6,$ttotalht.' '.$speceuro,'B',0,'R');
    $pdf->Ln(); $pdf->SetX(157);
	$pdf->Cell(33,6,'MONTANT TVA ('.$procpod.'%)','B',0,'L');
	$ttva = str_replace('.', ',', $row[tva]);
	$pdf->Cell(10,6,$ttva.' '.$speceuro,'B',0,'R');
    $pdf->Ln(); $pdf->SetX(157);
	$pdf->Cell(33,8,'TOTAL TTC','B',0,'L');
	$pdf->SetFont('Arial','B',7);
	$ttotalttc = str_replace('.', ',', $row[totalttc]);
	$pdf->Cell(10,8,$ttotalttc.' '.$speceuro,'B',0,'R');
    $pdf->Ln();


/// footer
    $gdziejestem = $pdf->GetY();
	$pdf->SetY($gdziejestem+10);
    $pdf->SetFont('Arial','',8);
	$pdf->Cell(0,7,'FACTURE REGLÉE PAR '.$row[payment],0,1,'C');
    $pdf->SetFont('Arial','I',8);
	$pdf->Cell(0,4,'RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140',0,1,'C');
	$pdf->Cell(0,4,'Sas au capital de 15.000,00 '.$speceuro,0,1,'C');


	$x++;
}
$pdf->Output();
mysql_close();
?>