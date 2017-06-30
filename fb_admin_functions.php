<?php
/*
Statuts des commandes:
	0>attente
	1>attente paiement
	2>payé
	3>traitement
	4>expédié
	5>cloturé
	6>annulées

Statuts des règlements:
	carte>Carte bleue
	cheque>Chèque
	bancaire>Vire bancaire
	administratif>Vire administratif
	espece>Espèce
	trente>Paiement sous 30 jours
	soixante>Paiement sous 60 jours
*/

////////////////////////////////////////////////////////////// status 2: payé //
////////////////////////////////////////////////////////////////////////////////

function passage_paiement_recu(){
	echo '
	<div class="statuspaction">
	<form name="frm_traitement" id="frm_traitement" action="" method="post">
	<input type="hidden" name="mode_traitement">
	<h3>Passer la commande en \'Traitement\'</h3>
	Mode de paiement utilisé: <br />
		<input type="radio" name="modpaiement" value="carte">Carte bleue<br>
		<input type="radio" name="modpaiement" value="cheque">Chèque<br>
		<input type="radio" name="modpaiement" value="bancaire">Vire bancaire<br>
		<input type="radio" name="modpaiement" value="espece">Espèces<br>
		<input type="radio" name="modpaiement" value="administratif">Vire administratif<br>
		<input type="radio" name="modpaiement" value="trente">Paiement à 30j<br>
		<input type="radio" name="modpaiement" value="soixante">Paiement à 60j<br>
		<p><input type="submit" value="VALIDER" style="margin:5px 0 0 8px;"></p>
	</form>
	</div>
	';
}

function traitement_passage_paiement_recu($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users){
	global $wpdb;
	/* Nouveau statut à 3 (traitement)*/
      $newstat = '3';
	$nowadata = date('Y-m-d H:i:s');
	$apdejt = $wpdb->update($fb_tablename_order, array ( 'status' => $newstat, 'date_modify' => $nowadata), array ( 'unique_id' => $number ) );


  /* Nouveau mode de paiement */
	$newplat = addslashes($_POST['modpaiement']);
	$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET payment='$newplat' WHERE unique_id='$number'");

  /* ENVOI du commentaire "RECU PAIEMENT XXX*/
	$wheresql = "RECU PAIEMENT ";
    if($newplat=="cheque") $wheresql .= "CHEQUE";
    if($newplat=="carte") $wheresql .= "CB";
    if($newplat=="bancaire") $wheresql .= "VIREMENT";
    if($newplat=="espece") $wheresql .= "ESPECES";
    if($newplat=="administratif") $wheresql .= "MANDAT ADMINISTRATIF";
    if($newplat=="trente") $wheresql .= "DIFFERE A 30 JOURS";
    if($newplat=="soixante") $wheresql .= "DIFFERE A 60 JOURS";

    $topics = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` WHERE topic LIKE '".$wheresql."%'ORDER BY content ASC", ARRAY_A);
    if ($topics) {
		foreach ($topics as $t) :
			$cont = stripslashes($t[content]);
			$cont= htmlspecialchars($cont);
			$topt = stripslashes($t[topic]);
			$topt = htmlspecialchars($topt);
		endforeach;
	}
	$tresc = addslashes($cont);
	$temat = addslashes($topt);
	$data = date('Y-m-d H:i:s');
	$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$number."', '".$temat."', '".$data."', 'France Banderole', '".$tresc."')");

	$dodawanie_new = $wpdb->query("INSERT INTO `$fb_tablename_comments_new` VALUES (not null, '".$number."', '1')");
	$sprawdzcf = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '".$number."'");
	if ($sprawdzcf) {
		$apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='fb' WHERE unique_id='".$number."' AND type='lastupdate'");
	} else {
		$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$number."', 'lastupdate', 'fb')");
	}

  /* ENVOI de l'email "Paiement de votre commande"*/
  $mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails` WHERE topic LIKE 'PAIEMENT DE VOTRE COMMANDE%'", ARRAY_A);
	foreach ($mails as $ma) :
		$con = stripslashes($ma[content]);
		$con = htmlspecialchars($con);
		$top = stripslashes($ma[topic]);
		$top = htmlspecialchars($top);
	endforeach;
	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
	$ktoryuser = $order->user;
	$uzyt = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$ktoryuser'");

	/* On remplace NNNNN dans le message par le no de comande */
	$con = str_replace("NNNNN",$number,$con);

	$temat = htmlspecialchars_decode($top);
	$zawar = htmlspecialchars_decode($con);
	$header = 'From: FRANCE BANDEROLE <information@france-banderole.com>';
      $header .= "\nContent-Type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";

	//echo "MAIL=".$uzyt->email;
	// EN PROD:
	mail($uzyt->email, stripslashes($temat), stripslashes($zawar), $header);
	//EN DEV: mail("contact@tempopasso.com", stripslashes($temat), stripslashes($zawar), $header);
}

/////////////////////////////////////////////////////////// status 4: expédié //
////////////////////////////////////////////////////////////////////////////////

function passage_expedie(){
	echo '
	<div class="statuspaction">
	<form name="frm_traitement" id="frm_traitement" action="" method="post">
	<input type="hidden" name="mode_expedie">
	<h3>Passer la commande en \'EXPÉDIÉE\'</h3>
		<p><input type="submit" value="COMMANDE EXPÉDIÉE" style="margin:5px 0 0 8px;"></p>
	</form>
	</div>
	';
}

function traitement_passage_expedie($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address){
	global $wpdb;
	/* On détermine si on est en relais colis, expédition TNT ou retrait atelier */
	$type_expedition = "";
	$wheresql = "0";
	$adresse_relais_colis ="";
	$unique_id_commande_tmp = $number;
	$reqtype_expedition = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$number'");

	foreach ($reqtype_expedition as $single) :
		$type = $single->type;
		$valeur = $single->value;
		if($type == 'shipping' && $valeur == 'tnt'){
			$type_expedition = 'tnt';
			$wheresql = "COLIS EXPEDIE TNT + SUIVI";
			break;
		}elseif($type == 'shipping' && strtolower($valeur) == 'fedex'){
			$type_expedition = 'fedex';
			$wheresql = "COLIS EXPEDIE FEDEX + SUIVI";
			break;
		}elseif($type == 'relais' && $valeur != ''){
			$type_expedition = 'relais';
			$wheresql = "COLIS RELAIS COLIS";
			break;
		}elseif($type == 'retrait atelier' && $valeur == 'yes'){
			$type_expedition = 'retrait';
			$wheresql = "COLIS RETRAIT ATELIER";
			break;
		}elseif($type == 'shipping' && $valeur == 'autre') {
			$type_expedition = 'autre';
			$wheresql = "COLIS EXPEDIE AUTRE";
		}else{
			$type_expedition = 'autre';
		}
	endforeach;

	if($type_expedition == 'relais'){
		/*Récupération de l'adresse du relais colis*/
		$userZZ = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$number'");
		$adresse_relais_colis = '
								'.$userZZ->l_name .'
								'.$userZZ->l_comp .'
								'.$userZZ->l_address .'
								'.$userZZ->l_code .'
								'.$userZZ->l_city;
	}

	/* Récupration du numéro du relais colis si disponible */
	if($type_expedition == 'relais' || $type_expedition == 'tnt' || strtolower($type_expedition) == 'fedex' || $type_expedition == 'autre'){
		$numberTNT_commande = $wpdb->get_row("SELECT tnt FROM `$fb_tablename_order` WHERE unique_id = '$number'");
		if($numberTNT_commande->tnt !="" && (strtolower($type_expedition) == 'tnt' || $type_expedition == 'relais') ){
			$adresse_relais_colis .='
			Vous pourrez suivre son acheminement dès ce soir en cliquant sur ce lien ou en recopiant cette adresse dans votre navigateur:
			http://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?btnSubmit=&radiochoixrecherche=BT&bonTransport='.$numberTNT_commande->tnt.'&radiochoixtypeexpedition=NAT
			';
		}elseif($numberTNT_commande->tnt !="" && strtolower($type_expedition) == 'fedex'){
			$adresse_relais_colis .='
			Vous pourrez suivre son acheminement dès ce soir en cliquant sur ce lien ou en recopiant cette adresse dans votre navigateur:
			https://france.fedex.com/te/webapp25?&trans=tesow350&action=recherche_complete&NUM_COLIS='.$number.'
			';
		}
	}

	/* Nouveau statut à 4 (expedie)*/
  $newstat = '4';
	$nowadata = date('Y-m-d H:i:s');
	$apdejt = $wpdb->update($fb_tablename_order, array ( 'status' => $newstat ), array ( 'unique_id' => $number ) );

  /* ENVOI du commentaire d'expedition */
	//$wheresql = "COLIS RELAIS COLIS";

  $topics = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` WHERE topic LIKE '".$wheresql."%' ORDER BY content ASC", ARRAY_A);
  if ($topics) {
		foreach ($topics as $t) :
			$cont = stripslashes($t[content]);
			$cont= htmlspecialchars($cont);
			$topt = stripslashes($t[topic]);
			$topt = htmlspecialchars($topt);
		endforeach;
	}
	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
	$tresc = $cont;
	/* On remplace XXXXX dans le message par l'adresse du relais colis */
	$tresc = str_replace("XXXXX",$adresse_relais_colis,$tresc);

	if(strtolower($type_expedition) == 'fedex') $tresc = str_replace("YYYYY",$number,$tresc); else $tresc = str_replace("YYYYY",$numberTNT_commande->tnt,$tresc);
	$temat = addslashes($topt);
	$data = date('Y-m-d H:i:s');
	$tresc = addslashes($tresc);
	$number = addslashes($number);
	$temat = addslashes($temat);
	$data = addslashes($data);
	$number = $unique_id_commande_tmp;
	$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$number."', '".$temat."', '".$data."', 'France Banderole', '".$tresc."')");

	$dodawanie_new = $wpdb->query("INSERT INTO `$fb_tablename_comments_new` VALUES (not null, '".$number."', '1')");
	$sprawdzcf = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '".$number."'");
	if ($sprawdzcf) {
		$apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='fb' WHERE unique_id='".$number."' AND type='lastupdate'");
	} else {
		$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$number."', 'lastupdate', 'fb')");
	}

  /* ENVOI de l'email "Colis expédié"*/
  $mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails` WHERE topic LIKE '".$wheresql."%'", ARRAY_A);
	foreach ($mails as $ma) :
		$con = stripslashes($ma[content]);
		$con = htmlspecialchars($con);
		$top = stripslashes($ma[topic]);
		$top = htmlspecialchars($top);
	endforeach;
	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
	$ktoryuser = $order->user;
	$uzyt = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$ktoryuser'");

	/* On remplace XXXXX dans le message par l'adresse du relais colis, YYYYY par le numéro de suivi, NNNNN par le n° de commande */
	$con = str_replace("XXXXX",$adresse_relais_colis,$con);
	$con = str_replace("YYYYY",$numberTNT_commande->tnt,$con);
	$con = str_replace("NNNNN",$number,$con);

	//$temat = htmlspecialchars_decode($_POST['hiddentopic']);
	//$zawar = htmlspecialchars_decode($_POST['selmailcontent']);
	$temat = htmlspecialchars_decode($top);
	$zawar = htmlspecialchars_decode($con);
	$header = 'From: FRANCE BANDEROLE <information@france-banderole.com>';
  $header .= "\nContent-Type: text/html; charset=UTF-88\n" ."Content-Transfer-Encoding: 8bit\n";

	//echo "MAIL=".$uzyt->email;
	// EN PROD:
	mail($uzyt->email, stripslashes($temat), stripslashes($zawar), $header);
}

/////////////////////////////////////////////////////////// status 5: clôturé //
////////////////////////////////////////////////////////////////////////////////

function passage_cloture(){
	echo '
	<div class="statuspaction">
	<form name="frm_cloture" id="frm_cloture" action="" method="post">
	<input type="hidden" name="mode_cloture">
	<h3>CLOTURER la commande</h3>
		<p><input type="submit" value="CLOTURER COMMANDE" style="margin:5px 0 0 8px;"></p>
	</form>
	</div>
	';
}

function traitement_passage_cloture($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address){
	global $wpdb;

	/* Nouveau statut à 5 (cloturé)*/
  $newstat = '5';
	$nowadata = date('Y-m-d H:i:s');
	$apdejt = $wpdb->update($fb_tablename_order, array ( 'status' => $newstat ), array ( 'unique_id' => $number ) );

  /* ENVOI du commentaire "COLIS RECU*/
	$wheresql = "COLIS RECU";

  $topics = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` WHERE topic LIKE '".$wheresql."%' ORDER BY content ASC", ARRAY_A);
  if ($topics) {
		foreach ($topics as $t) :
			$cont = stripslashes($t[content]);
			$cont= htmlspecialchars($cont);
			$topt = stripslashes($t[topic]);
			$topt = htmlspecialchars($topt);
		endforeach;
	}
	$tresc = addslashes($cont);
	$temat = addslashes($topt);
	//$tresc = $cont;
	//$temat = $topt;

	$data = date('Y-m-d H:i:s');
	$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$number."', '".$temat."', '".$data."', 'France Banderole', '".$tresc."')");

	$dodawanie_new = $wpdb->query("INSERT INTO `$fb_tablename_comments_new` VALUES (not null, '".$number."', '1')");
	$sprawdzcf = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '".$number."'");
	if ($sprawdzcf) {
		$apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='fb' WHERE unique_id='".$number."' AND type='lastupdate'");
	} else {
		$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$number."', 'lastupdate', 'fb')");
	}

  /* ENVOI de l'email "Votre avis sur FB"*/
  $wheresql = "VOTRE AVIS SUR FRANCE BANDEROLE";
	$mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails` WHERE topic LIKE '".$wheresql."%'", ARRAY_A);
	foreach ($mails as $ma) :
		$con = stripslashes($ma[content]);
		$con = htmlspecialchars($con);
		$top = stripslashes($ma[topic]);
		$top = htmlspecialchars($top);
	endforeach;
	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
	$ktoryuser = $order->user;
	$uzyt = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$ktoryuser'");

	// remplace nnnnn par le n° de commande :
	$con = str_replace("NNNNN",$number,$con);

	$temat = htmlspecialchars_decode($top);
	$zawar = htmlspecialchars_decode($con);
	$header = 'From: FRANCE BANDEROLE <information@france-banderole.com>';
  $header .= "\nContent-Type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";

	//Sync Mailjet
	$where = 'WHERE user = '.$ktoryuser;
	$data = $wpdb->get_results("SELECT *, SUM(CAST(REPLACE(totalht,',','') AS DECIMAL(30,2))) AS total FROM `$fb_tablename_order` ".$where." GROUP BY user ORDER BY total");

	createContact($uzyt->email);

	$mj_800 = getListId('800-1500');
	$mj_1500 = getListId('1500-2500');
	$mj_2500 = getListId('2500-4000');
	$mj_4000 = getListId('4000-6500');
	$mj_6400 = getListId('6500+');
	$mj_user = getIdFromEmail($uzyt->email);

	foreach ($data as $d) {

		if(($d->total > 800) AND ($d->total <= 1500)) {
			abonnerListe($mj_user,$mj_800);
			desabonnerListe($mj_user,$mj_1500);
			desabonnerListe($mj_user,$mj_2500);
			desabonnerListe($mj_user,$mj_4000);
			desabonnerListe($mj_user,$mj_6500);
		}
	//Ajout à la liste 1500-2500
		else if(($d->total > 1500) AND ($d->total <= 2500)) {
			desabonnerListe($mj_user,$mj_800);
			abonnerListe($mj_user,$mj_1500);
			desabonnerListe($mj_user,$mj_2500);
			desabonnerListe($mj_user,$mj_4000);
			desabonnerListe($mj_user,$mj_6500);
		}
	//Ajout à la liste 2500-4000
		else if(($d->total > 2500) AND ($d->total <= 4000)) {
			desabonnerListe($mj_user,$mj_800);
			desabonnerListe($mj_user,$mj_1500);
			abonnerListe($mj_user,$mj_2500);
			desabonnerListe($mj_user,$mj_4000);
			desabonnerListe($mj_user,$mj_6500);
		}
	//Ajout à la liste 4000-6500
		else if(($d->total > 4000) AND ($d->total <= 6500)) {
			desabonnerListe($mj_user,$mj_800);
			desabonnerListe($mj_user,$mj_1500);
			desabonnerListe($mj_user,$mj_2500);
			abonnerListe($mj_user,$mj_4000);
			desabonnerListe($mj_user,$mj_6500);
		}
	//Ajout à la liste 6500+
		else if(($d->total > 6500)) {
			desabonnerListe($mj_user,$mj_800);
			desabonnerListe($mj_user,$mj_1500);
			desabonnerListe($mj_user,$mj_2500);
			desabonnerListe($mj_user,$mj_4000);
			abonnerListe($mj_user,$mj_6500);
		}

	}
	//echo "MAIL=".$uzyt->email;
	// EN PROD:
	//mail('floroux.int@gmail.com', stripslashes($temat), stripslashes($zawar), $header);
	mail($uzyt->email, stripslashes($temat), stripslashes($zawar), $header);
	// EN DEV: mail("contact@tempopasso.com", stripslashes($temat), stripslashes($zawar), $header);

}

?>
