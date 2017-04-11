<?php

function getPaiementDroits($customer_id) {

	$droits_tbl = array('cb' => 1, 'cheque' => 1, 'virement' => 1, 'trente' => 0, 'soixante' => 0, 'administratif' => 0);
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_paiement = $prefix."fbs_paiement";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	$user_group = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$customer_id."' AND att_name = 'client_groupe'");
	if($user_group) {
		$group_paiement = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement` WHERE code = '".$user_group->att_value."'");
		$droits_tbl['cb'] = $group_paiement->cb;
		$droits_tbl['cheque'] = $group_paiement->cheque;
		$droits_tbl['virement'] = $group_paiement->virement;
		$droits_tbl['trente'] = $group_paiement->trente;
		$droits_tbl['soixante'] = $group_paiement->soixante;
		$droits_tbl['administratif'] = $group_paiement->mandat;
	}
	return $droits_tbl;
}

function calcOrder($uid) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$kosztcalosci=0;
	$idzamowienia = $uid;

	$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$uid' AND status='1'", ARRAY_A);
	if ($products) {
		foreach ( $products as $products => $item ) {
			$koszttotal = str_replace(',', '.', $item[total]);
			$kosztcalosci = $kosztcalosci + $koszttotal;
			$transportcalosci = $transportcalosci + $item[frais];
		}
//dodatkowy rabat
		$czyjestwtabeli = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestwtabeli) {
			if ( ($czyjestwtabeli->remis != '') && ($czyjestwtabeli->remis != '0') ) {
				$dodatkowyrabat = $czyjestwtabeli->remis;
				$dodatkowyrabat = str_replace(',', '.', $dodatkowyrabat);
				$kosztcalosci = $kosztcalosci + $dodatkowyrabat;
			}
		}
//dodatkowy rabat
//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
				$newrabat = $exist_remise->percent / 100;
				$wysokoscrabatu = $kosztcalosci * $newrabat;
				$kosztcalosci = $kosztcalosci - $wysokoscrabatu;
				$zmiana = $wpdb->update($fb_tablename_remisnew, array ( 'remisenew' => $wysokoscrabatu), array ( 'sku' => $idzamowienia ) );
			}
//koniec//
		$kosztcalosci = $kosztcalosci + $transportcalosci;
//zmiana podatku TVA
		$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$idzamowienia."-tva'");
		if ($czyjesttva) {
			if ($czyjesttva->remis == 0) {
				$podatekcalosci = 0;
			} elseif ($czyjesttva->remis == '') {
			  	$podatekcalosci = $kosztcalosci*0.200;
			} else {
				$tvapod = $czyjesttva->remis/100;
				$podatekcalosci = $kosztcalosci*$tvapod;
			}
		} else {
		  	$podatekcalosci = $kosztcalosci*0.200;
		}
//zmiana podatku TVA
	  	$totalcalosci = $kosztcalosci+$podatekcalosci;
	  	$kosztcalosci = number_format($kosztcalosci, 2);
		$transportcalosci = number_format($transportcalosci, 2);
		$podatekcalosci = number_format($podatekcalosci, 2);
	  	$totalcalosci = number_format($totalcalosci, 2);
		//$nowadata = date('Y-m-d H:i:s');
		$zmiana = $wpdb->update($fb_tablename_order, array ( 'frais' => $transportcalosci, 'totalht' => $kosztcalosci, 'tva' => $podatekcalosci, 'totalttc' => $totalcalosci), array ( 'unique_id' => $idzamowienia ) );
	}

}


function setPaiementFinProd($uid,$pay_method) {

	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";


	$has_pay_prod = $wpdb->get_row("SELECT * FROM `$fb_tablename_prods` WHERE order_id = '$uid' AND name = 'Suppression de l\'escompte commercial'");
	if($has_pay_prod) {
		$pay_percent = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement_moy` WHERE pay_code = '$pay_method'");
		if($pay_percent->pay_percent_add > 0) {
			$wpdb->delete($fb_tablename_prods, array('order_id' => $uid, 'name' => 'Suppression de l\'escompte commercial'));
			calcOrder($uid);
			$order_tmp = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$uid'");
			$montant_cmd = str_replace(',','',$order_tmp->totalttc);
			$prod_total = (($pay_percent->pay_percent_add * $montant_cmd) / 100)/1.20;
			$prod_insert = str_replace('.', ',',number_format($prod_total, 2)) . ' €';
			$wpdb->query("INSERT INTO `$fb_tablename_prods` VALUES (not null, '$uid', 'Suppression de l\'escompte commercial', 'Suppression de l\'escompte commercial France Banderole suite au choix du moyen de paiement','1','$prod_insert','-','-','$prod_insert','0.00 €','','1')");
			calcOrder($uid);
		} else {
			$wpdb->delete($fb_tablename_prods, array('order_id' => $uid, 'name' => 'Suppression de l\'escompte commercial'));
			calcOrder($uid);
		}

	} else {
		$pay_percent = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement_moy` WHERE pay_code = '$pay_method'");
		if($pay_percent->pay_percent_add > 0) {
			$order_tmp = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$uid'");
			$montant_cmd = str_replace(',','',$order_tmp->totalttc);
			$prod_total = (($pay_percent->pay_percent_add * $montant_cmd) / 100)/1.20;
			$prod_insert = str_replace('.', ',',number_format($prod_total, 2)) . ' €';
			$wpdb->query("INSERT INTO `$fb_tablename_prods` VALUES (not null, '$uid', 'Suppression de l\'escompte commercial', 'Suppression de l\'escompte commercial France Banderole suite au choix du moyen de paiement','1','$prod_insert','-','-','$prod_insert','0.00 €','','1')");
			calcOrder($uid);
		}
	}
}


function get_payement() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_paiement = $prefix."fbs_paiement";
	$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
 	$idzamowienia = $_GET['pay'];
	$uid = $_GET['pay'];
	$user = $_SESSION['loggeduser'];
	$userid = $user->id;
	$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");

if ($query) {
	if (isset($_POST['addpayment'])) {
		$metoda = $_POST['paymentmetod'];

		$set_payment = $wpdb->query("UPDATE `$fb_tablename_order` SET payment_ch = '$metoda' WHERE unique_id='$idzamowienia' AND user='$userid'");
		if($metoda != 'carte') {
			$set_statut = $wpdb->query("UPDATE `$fb_tablename_order` SET status = 7 WHERE unique_id='$idzamowienia' AND user='$userid'");
		}


	 	if ($metoda == 'virement') {
	 		setPaiementFinProd($uid,'virement');
			$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");
			$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
			$explode = explode('|', $us->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $us->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;
			if ( ( ($us->l_address != "") && ($f_address != $l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) ) ) {
				$livraison_add = $us->l_name.'<br />'.$us->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$us->l_code.'<br />'.$us->l_city.'<br />'.$us->l_phone;
			} else {
				$livraison_add = $facture_add;
			}
			$view .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p>Votre commande a bien été validée ! Merci de suivre les instructions ci-dessous pour procéder au paiement.</p></td></tr></table></div>';
			$view .= '<div class="noprint">';
	 		$view .= '<h1>Accès client: Paiement</h1><hr />';
			$view .= '<div class="cheque_tab_name">Paiement comptant par virement bancaire</div>';
			$view .= '<div class="cheque_tab_con">Veuillez trouver ci-dessous un récapitulatif de votre commande. Cliquez sur le bouton "Imprimer le RIB" pour obtenir nos coordonnées bancaires et effectuer votre règlement. Dès réception effective de votre règlement, votre commande passera en production.<br />Pour toutes questions n\'hesitez pas à nous contacter au 0442.401.401</div>';
			$view .= '</div>';
//			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td>24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles<br />TelÂ : 0981.610.901<br />FaxÂ : 0957.045.045<br /><span class="mini">www.france-banderole.com<br />info@france-banderole.fr</span></td><td style="float:right;"><img src="'.$images_url.'logoprint.png" alt="france banderole" class="logoprint2" /></td></tr><tr><td colspan="2" class="print_header_name">Paiement par chècque Bancaire</td></tr></table></div>';
			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td ><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td>&nbsp;</td></tr><tr><td><p class="print-info">Imprimez ce Bon de Commande et envoyez votre Règlement accompagné du Bon de Commande à l\'adresse suivante:</p><p class="print-adress">France Banderole Sas<br />24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles</p> <p class="text-center">Pour toutes questions n\'hésitez pas à nous contacter au 0442.401.401 </p> <p class="print-no">BON DE COMMANDE N°'.$idzamowienia.'</p></td></tr></table></div>';



			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
			foreach ( $products as $products => $item ) {
				$view .= '<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td>'.$item[quantity].'</td><td>'.$item[prix].'</td><td>'.$item[prix_option].'</td><td>'.$item[remise].'</td><td>'.$item[total].'</td></tr>';
	  		}
// dodatkowy rabat wyswietl //
			$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
			if ($czyjestrabat) {
				$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
			}
/////////////
	  		$view .= '</table>';

				$view .= '<table id="fbcart_address" cellspacing="0"><tr><th class="leftth">ADDRESSE DE FACTURATION:</th><th>ADDRESSE DE LIVRAISON:</th></tr><tr><td class="lefttd">'.$facture_add.'</td><td>'.$livraison_add.'</td></tr></table>';

	  		$tfrais = str_replace('.', ',', $query->frais).' &euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).' &euro;';
	  		$ttva = str_replace('.', ',', $query->tva).' &euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).' &euro;';
	  		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr><tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA (20%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft">TOTAL TTC</td><td class="toright">'.$ttotalttc.'</td></tr></table>';

			$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en provence: 510.605.140 - TVA INTRA: FR65510605140<br />SAS au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3" class="noprint"><a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour à vos devis</a><a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/RIB-FB.pdf" target="_blank" id="but_imprimer_rib"><i class="fa fa-print" aria-hidden="true"></i> Imprimer le RIB</a></div>';






			// $view .= '<h1>France Banderole</h1><hr />';
	 		// $view .= 'sas au capital de 15 000 €';
	 		// $view .= '<p style="margin-top:20px;"><b>Siège social :</b></p><p>24 avenue de Bruxelles<br />13127 VITROLLES<br />tel : 0442.401.401</p><p style="margin-top:20px;">RCS Pontoise : 510.605.140<br />SIRET : 510.605.140.00019<br />APE : 7311Z<br />TVA INT : FR 65.510.605.140</p>';
	 		// $view .= '<p style="margin-top:20px;text-align:center;"><b>RIB</b></p>';
	 		// $view .= '<table cellspacing="0" class="virement_payement"><tr><td class="lefttd">Banque</td><td>Indicatif</td><td>Numéro de compte</td><td>Clé RIB</td><td>Domiciliation</td></tr><tr><td class="lefttd">30002</td><td>00858</td><td>0000005793J</td><td>03</td><td>CL EAUBONNE CTRE EUROPE (00858)</td></tr></table>';
	 		// $view .= '<p style="margin-top:20px;text-align:center;"><b>IDENTIFICATION INTERNATIONALE :</b></p>';
	 		// $view .= '<table cellspacing="0" class="virement_payement"><tr><td class="lefttd">IBAN</td><td>FR76 3000 2008 5800 0000 5793 J03</td></tr><tr><td class="lefttd">Code B.I.C.</td><td>CRLYFRPP</td></tr></table>';
	 		// $view .= '<p style="margin-top:20px;text-align:center;"><b>TITULAIRE DU COMPTE : FRANCE BANDEROLE</b></p>';
		}
		if ($metoda == 'trente') {
			setPaiementFinProd($uid,'trente');
	 		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
			$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");
			$explode = explode('|', $us->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $us->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;
			if ( ( ($us->l_address != "") && ($f_address != $l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) ) ) {
				$livraison_add = $us->l_name.'<br />'.$us->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$us->l_code.'<br />'.$us->l_city.'<br />'.$us->l_phone;
			} else {
				$livraison_add = $facture_add;
			}
			$view .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p>Votre commande a bien été validée ! Merci de suivre les instructions ci-dessous pour procéder au paiement.</p></td></tr></table></div>';
			$view .= '<div class="noprint">';
	 		$view .= '<h1>Accès client: Paiement</h1><hr />';
			$view .= '<div class="paydiff_tab_name">Paiement différé à 30 jours net</div>';
			$view .= '<div class="paydiff_tab_con">Veuillez trouver ci-dessous un récapitulatif de votre commande. Ce mode de paiement implique la suppression de l\'escompte commercial de 5% appliqués sur nos tarifs en ligne pour paiement comptant. Cliquez sur le bouton "Imprimer le RIB" pour obtenir nos coordonnées bancaires et effectuer votre règlement sous 30 jours par virement bancaire. Dès validation de votre commande par notre service Comptabilité / Expert Risque / Factor, votre commande passera en production.<br />Pour toutes questions n\'hesitez pas à nous contacter au 0442.401.401</div>';
			$view .= '</div>';
//			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td>24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles<br />TelÂ : 0981.610.901<br />FaxÂ : 0957.045.045<br /><span class="mini">www.france-banderole.com<br />info@france-banderole.fr</span></td><td style="float:right;"><img src="'.$images_url.'logoprint.png" alt="france banderole" class="logoprint2" /></td></tr><tr><td colspan="2" class="print_header_name">Paiement par chècque Bancaire</td></tr></table></div>';
			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td ><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td>&nbsp;</td></tr><tr><td><p class="print-info">Imprimez ce Bon de Commande et envoyez votre Règlement accompagné du Bon de Commande à l\'adresse suivante:</p><p class="print-adress">France Banderole Sas<br />24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles</p> <p class="text-center">Pour toutes questions n\'hésitez pas à nous contacter au 0442.401.401 </p> <p class="print-no">BON DE COMMANDE N°'.$idzamowienia.'</p></td></tr></table></div>';



			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
			foreach ( $products as $products => $item ) {
				$view .= '<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td>'.$item[quantity].'</td><td>'.$item[prix].'</td><td>'.$item[prix_option].'</td><td>'.$item[remise].'</td><td>'.$item[total].'</td></tr>';
	  		}
			// dodatkowy rabat wyswietl //
			$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
			if ($czyjestrabat) {
				$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
			}

	  		$view .= '</table>';
				$view .= '<table id="fbcart_address" cellspacing="0"><tr><th class="leftth">ADDRESSE DE FACTURATION:</th><th>ADDRESSE DE LIVRAISON:</th></tr><tr><td class="lefttd">'.$facture_add.'</td><td>'.$livraison_add.'</td></tr></table>';


	  		$tfrais = str_replace('.', ',', $query->frais).' &euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).' &euro;';
	  		$ttva = str_replace('.', ',', $query->tva).' &euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).' &euro;';
	  		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr><tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA (20%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft">TOTAL TTC</td><td class="toright">'.$ttotalttc.'</td></tr></table>';

			$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en provence: 510.605.140 - TVA INTRA: FR65510605140<br />SAS au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3" class="noprint" style="background:#FBCFD0;"><a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour à vos devis</a><a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/RIB-FB.pdf" target="_blank" id="but_imprimer_rib"><i class="fa fa-print" aria-hidden="true"></i> Imprimer le RIB</a></div>';
		}
		if ($metoda == 'soixante') {
			setPaiementFinProd($uid,'soixante');
			$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");
			$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
			$explode = explode('|', $us->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $us->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;
			if ( ( ($us->l_address != "") && ($f_address != $l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) ) ) {
				$livraison_add = $us->l_name.'<br />'.$us->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$us->l_code.'<br />'.$us->l_city.'<br />'.$us->l_phone;
			} else {
				$livraison_add = $facture_add;
			}
			$view .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p>Votre commande a bien été validée ! Merci de suivre les instructions ci-dessous pour procéder au paiement.</p></td></tr></table></div>';
			$view .= '<div class="noprint">';
	 		$view .= '<h1>Accès client: Paiement</h1><hr />';
			$view .= '<div class="paydiff_tab_name">Paiement différé à 60 jours net</div>';
			$view .= '<div class="paydiff_tab_con">Veuillez trouver ci-dessous un récapitulatif de votre commande. Ce mode de paiement implique la suppression de l\'escompte commercial de 5% appliqués sur nos tarifs en ligne pour paiement comptant. Cliquez sur le bouton "Imprimer le RIB" pour obtenir nos coordonnées bancaires et effectuer votre règlement sous 60 jours par virement bancaire. Dès validation de votre commande par notre service Comptabilité / Expert Risque / Factor, votre commande passera en production.<br />Pour toutes questions n\'hesitez pas à nous contacter au 0442.401.401</div>';
			$view .= '</div>';
//			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td>24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles<br />TelÂ : 0981.610.901<br />FaxÂ : 0957.045.045<br /><span class="mini">www.france-banderole.com<br />info@france-banderole.fr</span></td><td style="float:right;"><img src="'.$images_url.'logoprint.png" alt="france banderole" class="logoprint2" /></td></tr><tr><td colspan="2" class="print_header_name">Paiement par chècque Bancaire</td></tr></table></div>';
			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td ><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td>&nbsp;</td></tr><tr><td><p class="print-info">Imprimez ce Bon de Commande et envoyez votre Règlement accompagné du Bon de Commande à l\'adresse suivante:</p><p class="print-adress">France Banderole Sas<br />24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles</p> <p class="text-center">Pour toutes questions n\'hésitez pas à nous contacter au 0442.401.401 </p> <p class="print-no">BON DE COMMANDE N°'.$idzamowienia.'</p></td></tr></table></div>';



			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
			foreach ( $products as $products => $item ) {
				$view .= '<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td>'.$item[quantity].'</td><td>'.$item[prix].'</td><td>'.$item[prix_option].'</td><td>'.$item[remise].'</td><td>'.$item[total].'</td></tr>';
	  		}
			// dodatkowy rabat wyswietl //
			$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
			if ($czyjestrabat) {
				$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
			}

	  		$view .= '</table>';
				$view .= '<table id="fbcart_address" cellspacing="0"><tr><th class="leftth">ADDRESSE DE FACTURATION:</th><th>ADDRESSE DE LIVRAISON:</th></tr><tr><td class="lefttd">'.$facture_add.'</td><td>'.$livraison_add.'</td></tr></table>';

	  		$tfrais = str_replace('.', ',', $query->frais).' &euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).' &euro;';
	  		$ttva = str_replace('.', ',', $query->tva).' &euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).' &euro;';
	  		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr><tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA (20%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft">TOTAL TTC</td><td class="toright">'.$ttotalttc.'</td></tr></table>';

			$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en provence: 510.605.140 - TVA INTRA: FR65510605140<br />SAS au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3" class="noprint" style="background:#FBCFD0;"><a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour à vos devis</a><a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/RIB-FB.pdf" target="_blank" id="but_imprimer_rib"><i class="fa fa-print" aria-hidden="true"></i> Imprimer le RIB</a></div>';
		}
		if ($metoda == 'administratif') {
			setPaiementFinProd($uid,'administratif');
			$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");
	 		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
			$explode = explode('|', $us->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $us->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;
			if ( ( ($us->l_address != "") && ($f_address != $l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) ) ) {
				$livraison_add = $us->l_name.'<br />'.$us->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$us->l_code.'<br />'.$us->l_city.'<br />'.$us->l_phone;
			} else {
				$livraison_add = $facture_add;
			}
			$view .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p>Votre commande a bien été validée ! Merci de suivre les instructions ci-dessous pour procéder au paiement.</p></td></tr></table></div>';
			$view .= '<div class="noprint">';
	 		$view .= '<h1>Accès client: Paiement</h1><hr />';
			$view .= '<div class="paydiff_tab_name">Paiement différé par mandat administratif</div>';
			$view .= '<div class="paydiff_tab_con">Veuillez trouver ci-dessous un récapitulatif de votre commande. Ce mode de paiement implique la suppression de l\'escompte commercial de 5% appliqués sur nos tarifs en ligne pour paiement comptant. <br />
		Cliquez sur le bouton "Imprimer le formulaire de commande administrative", complétez-le et envoyez votre bon de commande interne et le formulaire complété par mail à paiement@france-banderole.fr ou par fax au 0957.045.045. Dès validation de votre commande par notre service Comptabilité / Expert Risque / Factor, votre commande passera en production.<br />Pour toutes questions n\'hesitez pas à nous contacter au 0442.401.401</div>';
			$view .= '</div>';
//			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td>24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles<br />TelÂ : 0981.610.901<br />FaxÂ : 0957.045.045<br /><span class="mini">www.france-banderole.com<br />info@france-banderole.fr</span></td><td style="float:right;"><img src="'.$images_url.'logoprint.png" alt="france banderole" class="logoprint2" /></td></tr><tr><td colspan="2" class="print_header_name">Paiement par chècque Bancaire</td></tr></table></div>';
			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td ><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td>&nbsp;</td></tr><tr><td><p class="print-info">Imprimez ce Bon de Commande et envoyez votre Règlement accompagné du Bon de Commande à l\'adresse suivante:</p> <p class="print-adress">France Banderole Sas<br />24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles</p> <p class="text-center">Pour toutes questions n\'hésitez pas à nous contacter au 0442.401.401 </p> <p class="print-no">BON DE COMMANDE N°'.$idzamowienia.'</p></td></tr></table></div>';



			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
			foreach ( $products as $products => $item ) {
				$view .= '<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td>'.$item[quantity].'</td><td>'.$item[prix].'</td><td>'.$item[prix_option].'</td><td>'.$item[remise].'</td><td>'.$item[total].'</td></tr>';
	  		}
			// dodatkowy rabat wyswietl //
			$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
			if ($czyjestrabat) {
				$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
			}

	  		$view .= '</table>';
				$view .= '<table id="fbcart_address" cellspacing="0"><tr><th class="leftth">ADDRESSE DE FACTURATION:</th><th>ADDRESSE DE LIVRAISON:</th></tr><tr><td class="lefttd">'.$facture_add.'</td><td>'.$livraison_add.'</td></tr></table>';

	  		$tfrais = str_replace('.', ',', $query->frais).' &euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).' &euro;';
	  		$ttva = str_replace('.', ',', $query->tva).' &euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).' &euro;';
	  		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr><tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA (20%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft">TOTAL TTC</td><td class="toright">'.$ttotalttc.'</td></tr></table>';

			$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en provence: 510.605.140 - TVA INTRA: FR65510605140<br />SAS au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3" class="noprint" style="background:#FBCFD0;"><a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/form-adm-FB.pdf" target="_blank" id="but_imprimer_form"></a><a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour à vos devis</a></div>';
		}
	 	if ($metoda == 'carte') {
			setPaiementFinProd($uid,'carte');
			$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");
//			if(!isset($_SESSION['fbcartsum'])) {
				$sumaplatnosci = str_replace(",", "", $query->totalttc);
				$_SESSION['fbcartsum'] = $sumaplatnosci;
//			}
				$_SESSION['fbcmd'] = $idzamowienia;
//	 		require('/var/www/vhosts/france-banderole.com/cgi-bin/sherlock/call_request.php');
	 		require('./sherlock/paiement_f_sherlok.php');
 		}
	 	if ($metoda == 'cheque') {
			setPaiementFinProd($uid,'cheque');
			$query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia' AND user='$userid'");
			$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
			$explode = explode('|', $us->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $us->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;
			if ( ( ($us->l_address != "") && ($f_address != $l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) ) ) {
				$livraison_add = $us->l_name.'<br />'.$us->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$us->l_code.'<br />'.$us->l_city.'<br />'.$us->l_phone;
			} else {
				$livraison_add = $facture_add;
			}
			$view .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p>Votre commande a bien été validée ! Merci de suivre les instructions ci-dessous pour procéder au paiement.</p></td></tr></table></div>';
			$view .= '<div class="noprint">';
	 		$view .= '<h1>Accès client: Paiement</h1><hr />';
			$view .= '<div class="cheque_tab_name">Paiement comptant par chèque Bancaire</div>';
			$view .= '<div class="cheque_tab_con">Imprimez ce Bon de Commande et envoyez votre Reglement accompagné du Bon de Commande à l\'adresse suivante:<br /><br /><span class="colblue">France Banderole Sas<br />24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles</span><br /><br />Dès réception effective de votre règlement, votre commande passera en production.<br />Pour toutes questions n\'hesitez pas à nous contacter au 0442.401.401</div>';
			$view .= '</div>';
//			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td>24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles<br />TelÂ : 0981.610.901<br />FaxÂ : 0957.045.045<br /><span class="mini">www.france-banderole.com<br />info@france-banderole.fr</span></td><td style="float:right;"><img src="'.$images_url.'logoprint.png" alt="france banderole" class="logoprint2" /></td></tr><tr><td colspan="2" class="print_header_name">Paiement par chècque Bancaire</td></tr></table></div>';
			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td ><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td>&nbsp;</td></tr><tr><td><p class="print-info">Imprimez ce Bon de Commande et envoyez votre Règlement accompagné du Bon de Commande à l\'adresse suivante:</p><p class="print-adress">France Banderole Sas<br />24 avenue de Bruxelles<br />ZI les Estroublans<br />13127 Vitrolles</p> <p class="text-center">Pour toutes questions n\'hésitez pas à nous contacter au 0442.401.401 </p> <p class="print-no">BON DE COMMANDE N°'.$idzamowienia.'</p></td></tr></table></div>';


			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
			foreach ( $products as $products => $item ) {
				$view .= '<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td>'.$item[quantity].'</td><td>'.$item[prix].'</td><td>'.$item[prix_option].'</td><td>'.$item[remise].'</td><td>'.$item[total].'</td></tr>';
	  		}
// dodatkowy rabat wyswietl //
			$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
			if ($czyjestrabat) {
				$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
			}
/////////////
	  		$view .= '</table>';

				$view .= '<table id="fbcart_address" cellspacing="0"><tr><th class="leftth">ADDRESSE DE FACTURATION:</th><th>ADDRESSE DE LIVRAISON:</th></tr><tr><td class="lefttd">'.$facture_add.'</td><td>'.$livraison_add.'</td></tr></table>';

	  		$tfrais = str_replace('.', ',', $query->frais).' &euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).' &euro;';
	  		$ttva = str_replace('.', ',', $query->tva).' &euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).' &euro;';
	  		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr><tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA (20%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft">TOTAL TTC</td><td class="toright">'.$ttotalttc.'</td></tr></table>';

			$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en provence: 510.605.140 - TVA INTRA: FR65510605140<br />SAS au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3" class="noprint"><a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour à vos devis</a><a href="javascript:window.print()" id="but_imprimerbon"><i class="fa fa-print" aria-hidden="true"></i> Imprimer le Bon de commande</a></div>';
 		}
	} else {


	if (isset($_GET['pay'])) {
		$chec = '';
		$styl = '';
		$regconf = $_POST['regconf'];
		if ($regconf) {
			$chec = ' checked="checked"';
			$styl = ' style="visibility:visible"';
			$view .= '<p>'._FB_RPLAT.'</p>';
		}
		$view .= '<h1>Accès client: Paiement de la commande</h1><hr />';
		$view .= '<div id="paiements">';
		$view .= '<div id="paiements_left"><div id="paiements_left_tit">acceder aux méthodes de paiement</div>
		<div id="paiements_left_con"><form name="regulamin" id="regulamin" action="" method="post" onsubmit="potwierdzregulamin(); return false;"><input type="checkbox" name="accepte" id="reg_confirm" value="prawda"'.$chec.' /><label for="accepte" class="checkbox2"> En cochant cette case, je reconnais avoir lu et <a href="'.get_bloginfo("url").'/cgv/" target="_blank" class="conditio">accepter les conditions</a> générales de vente.</label><button id="suivant_reg" type="submit">Suivant <i class="fa fa-caret-right" aria-hidden="true"></i>
</button></form></div>
		</div>';
		$view .= '<div id="paiements_right"'.$styl.'><div id="paiements_right_tit">choisissez une méthode de paiement</div>
		<form id="paymetod" name="paymetod" action="" method="post">
		<input type="hidden" name="regconf" value="true" />
		<input type="hidden" name="addpayment" />
		<input type="hidden" name="cmd" vakue="'.$idzamowienia.'" />';

		$paiement_tbl = getPaiementDroits($userid);
		if($paiement_tbl['cb']) {
			$view .= '<div class="paiements_right_con">
			<input type="radio" name="paymentmetod" value="carte" checked="checked" /> <span class="payement_underline">Paiement comptant sécurisé par carte bleue avec LCL</span>
			<span class="pay_image"><img src="'.$images_url.'pay_carte.png" alt="Carte" /></span>
			<span class="pay_carte_info">Vous utilisez le formulaire sécurisé standard SSL <img src="'.$images_url.'pay_klodka.png" alt="SSL" /></span>
			</div>';
		}
		if($paiement_tbl['cheque']) {
			$view .= '<div class="paiements_right_con">
			<input type="radio" name="paymentmetod" value="cheque" /> <span class="payement_underline">Paiement comptant par chèque bancaire ou postal</span>
			<span class="pay_image"><img src="'.$images_url.'pay_cheque.png" alt="Cheque" /></span>
			</div>';
		}
		if($paiement_tbl['virement']) {
			$view .= '<div class="paiements_right_con">
			<input type="radio" name="paymentmetod" value="virement" /> <span class="payement_underline">Paiement comptant par virement bancaire</span>
			<span class="pay_image2"><img src="'.$images_url.'pay_virement.png" alt="Virement" /></span>
			</div>';
		}
		if($paiement_tbl['trente']) {
			$view .= '<div class="paiements_right_con_diff">
			<input type="radio" name="paymentmetod" value="trente" /> <span class="payement_underline">Paiement différé à 30 jours net date de facture</span>
			<span class="pay_image"><img src="'.$images_url.'pay_diff.png" alt="Paiement 30 jours" /></span>
			<span class="pay_carte_info">Ce mode de paiement implique la suppression de l\'escompte commercial de 5% sur nos tarifs en ligne.</span>
			</div>';
		}
		if($paiement_tbl['soixante']) {
			$view .= '<div class="paiements_right_con_diff">
			<input type="radio" name="paymentmetod" value="soixante" /> <span class="payement_underline">Paiement différé à 60 jours net date de facture</span>
			<span class="pay_image"><img src="'.$images_url.'pay_diff.png" alt="Paiement 60 jours" /></span>
			<span class="pay_carte_info">Ce mode de paiement implique la suppression de l\'escompte commercial de 5% sur nos tarifs en ligne.</span>
			</div>';
		}
		if($paiement_tbl['administratif']) {
			$view .= '<div class="paiements_right_con_diff">
			<input type="radio" name="paymentmetod" value="administratif" /> <span class="payement_underline">Paiement différé par mandat administratif 25 jours</span>
			<span class="pay_image"><img src="'.$images_url.'pay_diff.png" alt="Mandat administratif" /></span>
			<span class="pay_carte_info">Ce mode de paiement implique la suppression de l\'escompte commercial de 5% sur nos tarifs en ligne.</span>
			</div>';
		}


		$view .= '<div class="paiements_right_con2"><button id="but_conf_pay" type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i> Payer</button></div>
		</form>
		</div>';

		$view .= '</div>';
	  }
	  }
} else {
  	$view .= ''._FB_404.'';
}
return $view;
}

?>
