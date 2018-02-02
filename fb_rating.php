<?php

function get_rating_home() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_rating = $prefix."fbs_rating";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$rates = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` WHERE exist = 'true' ORDER BY date DESC LIMIT 2", ARRAY_A);
	foreach ($rates as $r) :
		$licz = strlen($r[comment]);
	    if ($licz>=120) {
			$tnij = substr($r[comment],0,90);
        	$txt = $tnij."...";
        } else {
			$txt = $r[comment];
		}
		$singlerate = (($r[fir] + $r[sec] + $r[thi])/3); $singlerate = (round($singlerate, 0)) * 12;
		echo '<div class="singlerate">
		<div class="singlerate_content">'.stripslashes($txt).'</div>
		<div class="singlerate_rate">
			<ul class="star-rating4"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul>
		</div>
		<div class="singlerate_date">'.$r[data].'</div>
		</div>';
	endforeach;
}

function get_rating_page() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_rating = $prefix."fbs_rating";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_reponses = $prefix."fbs_reponses";
	$fb_tablename_catprods = $prefix."fbs_catprods";
	$fb_tablename_cache_notes = $prefix."fbs_cache_notes";
	$fb_tablename_cache_comments = $prefix."fbs_cache_prodratings";

	if((isset($_GET['prod_type'])) AND ($_GET['prod_type'] != 'all')) {

			$prod_family = $_GET['prod_type'];


		if (isset($_POST['addrating'])) {
			$czyoceniony = $wpdb->get_row("SELECT * FROM `$fb_tablename_rating` WHERE unique_id = '$_POST[addrating]'");
			if (!$czyoceniony) {
				$data = date('Y-m-d H:i:s');
				$tresc = $_POST['content'];
				$tresc = addslashes($tresc);
				$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_rating` VALUES (not null, '".$_POST[addrating]."', 'true', '".$_POST[rafir]."', '".$_POST[rasec]."', '".$_POST[rathr]."', '".$tresc."', '".$data."')");
			}
		}
		//$rates = $wpdb->get_results("SELECT *, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC", ARRAY_A);
		// $licznik = 0;
		// $fir = 0;
		// $sec = 0;
		// $thi = 0;
		// foreach ($rates as $r) :
			// $licznik++;
			// $fir = $fir + $r[fir];
			// $sec = $sec + $r[sec];
			// $thi = $thi + $r[thi];
		// endforeach;
		// $gen = ((($fir + $sec + $thi)/$licznik)/3); $gen = (round($gen, 0)) *30;
		// $fir = ($fir / $licznik); $fir = (round($fir, 0)) *20;
		// $sec = ($sec / $licznik); $sec = (round($sec, 0)) *20;
		// $thi = ($thi / $licznik); $thi = (round($thi, 0)) *20;

		//Select pour la famille
		$view .= '<p><form method="get" action="">Voir les avis pour une famille de produits : <select name="prod_type">';
		$prodcat_list = $wpdb->get_results("SELECT DISTINCT code_parent, prod_parent FROM `$fb_tablename_catprods` ORDER BY prod_parent");
		$view .= '<option value="all">-- Tous --</option>';
		foreach ($prodcat_list as $prodcat) {
		$view .= '<option value="'.$prodcat->code_parent.'"';
		if($prodcat->code_parent == $prod_family) {
		$view .= ' selected';
		}
		$view .= '>'.$prodcat->prod_parent.'</option>';
		}
		$view .= '</select>&nbsp;<input type="submit" value="Valider"></form></p>';

		$view .= '
		<div id="rating_livre">
			<div id="vosavis"></div>';

		// $view .= '<div id="rating_general" style="text-align: center; font-size: 18px;"><br /><br /><br /><br />';
		// $moyenne = $wpdb->get_row("SELECT AVG(r.fir+r.sec+r.thi)/3 AS moy FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
		// $strmoyenne1 = round($moyenne->moy,2);
		// $strmoyenne2 = "/5 - ";
		// $total = $wpdb->get_row("SELECT COUNT(*) AS nb_avis FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
		// $strmoyenne3 = $total->nb_avis;
		// $strmoyenne4 = " avis";
		// $prod_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_catprods` WHERE code_parent = '$prod_family'");
		// $display_name = $prod_name->prod_parent;

		$view .= '<div id="rating_general"><h2>Vos avis :</h2>';
		$prod_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_catprods` WHERE code_parent = '$prod_family'");
		$display_name = $prod_name->prod_parent;
		$notation = $wpdb->get_row("SELECT * FROM `$fb_tablename_cache_notes` WHERE code_parent = '$prod_family'");
		$strmoyenne1 = $notation->note;
		$strmoyenne2 = "/5 - ";
		$strmoyenne3 = $notation->nb_avis;
		$licznik = $notation->nb_avis;
		$strmoyenne4 = " avis";

		$view .= '<span class="client_reviews_1">'. $strmoyenne1 . '</span>'. $strmoyenne2 . $strmoyenne3 . $strmoyenne4. '<br />';
		$view .= '<span class="star-note"><img src="'.get_bloginfo("url").'/wp-content/themes/fb/images/star-4_7.png" /></span><br />';
		$view .= 'pour les produits de type '.$display_name;
		$view .= '</div></div>';

		$subpage = $_GET['page_num'];
		$perPage = 30;
		if (!empty($_GET['subpage']) && (is_numeric($_GET['subpage']))) {
			$subpage = (int) $_GET['subpage'];
		}
		if ($subpage < 1) {
			$subpage = 1;
		}
		$start = ($subpage - 1) * $perPage;

		$rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC LIMIT $start, $perPage", ARRAY_A);

		$view .= '<table id="fbcart_rating" cellspacing="0"><tbody>';

		foreach ($rates as $r) :

			$singlerate = (($r[fir] + $r[sec] + $r[thi])/3); $singlerate = (round($singlerate, 0)) * 20;
			$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$r[unique_id]'");
			$prodname = $wpdb->get_row("SELECT * FROM `$fb_tablename_prods` p, `$fb_tablename_catprods` c WHERE p.order_id='$r[unique_id]' AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
			$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$order->user'");
			if ($prodname->name == 'Kakemono'){$lienprod = get_bloginfo('url').'/roll-up';}
	    elseif ($prodname->name == 'Banderole'){$lienprod = get_bloginfo('url').'/banderoles';}
	    elseif ($prodname->name == 'Cartes 350g'){$lienprod = get_bloginfo('url').'/cartes';}
	    elseif ($prodname->name == 'Cartes 270µ'){$lienprod = get_bloginfo('url').'/cartes';}
	    elseif ($prodname->name == 'Cartes 350µ'){$lienprod = get_bloginfo('url').'/cartes';}
	    elseif ($prodname->name == 'Oriflamme'){$lienprod = get_bloginfo('url').'/oriflammes';}
	    elseif ($prodname->name == 'depliants 80g'){$lienprod = get_bloginfo('url').'/depliants';}
	    elseif ($prodname->name == 'depliants 135g'){$lienprod = get_bloginfo('url').'/depliants';}
	    elseif ($prodname->name == 'depliants 170g'){$lienprod = get_bloginfo('url').'/depliants';}
	    elseif ($prodname->name == 'depliants 250g'){$lienprod = get_bloginfo('url').'/depliants';}
	    elseif ($prodname->name == 'Enseigne'){$lienprod = get_bloginfo('url').'/enseignes';}
	    elseif ($prodname->name == 'Flyers 80g'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 135g'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 170g'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 250g'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 350g'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 120µ'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 270µ'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Flyers 350µ'){$lienprod = get_bloginfo('url').'/flyers';}
	    elseif ($prodname->name == 'Affiches 135g'){$lienprod = get_bloginfo('url').'/affiches';}
	    elseif ($prodname->name == 'PHOTOCALL 220x240'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
	    elseif ($prodname->name == 'Barrière délimitation'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
	    elseif ($prodname->name == 'Cadre extérieur 100x250cm'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
	    elseif ($prodname->name == 'Cadre extérieur 125x300cm'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
	    elseif ($prodname->name == 'Kit de Barrière supplémentaire'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
	    elseif ($prodname->name == 'Roll-up'){$lienprod = get_bloginfo('url').'/roll-up';}
	    elseif ($prodname->name == 'Totem'){$lienprod = get_bloginfo('url').'/totem';}
	    elseif ($prodname->name == 'Akilux 3mm'){$lienprod = get_bloginfo('url').'/panneaux-akilux-3mm';}
	    elseif ($prodname->name == 'Akilux 3,5mm'){$lienprod = get_bloginfo('url').'/panneaux-akilux-3_5mm';}
	    elseif ($prodname->name == 'Akilux 5mm'){$lienprod = get_bloginfo('url').'/panneaux-akilux-5mm';}
	    elseif ($prodname->name == 'Forex 3mm'){$lienprod = get_bloginfo('url').'/panneaux-forex-3mm';}
	    elseif ($prodname->name == 'Forex 5mm'){$lienprod = get_bloginfo('url').'/panneaux-forex-5mm';}
	    elseif ($prodname->name == 'Dibond'){$lienprod = get_bloginfo('url').'/panneaux-dibond';}
	    elseif ($prodname->name == 'Vinyles Stickers'){$lienprod = get_bloginfo('url').'/stickers';}
	    elseif ($prodname->name == 'Tente'){$lienprod = get_bloginfo('url').'/tente-publicitaire-barnum';}
			elseif ($prodname->name == 'Nappe'){$lienprod = get_bloginfo('url').'/nappes-publicitaires';}
	    else {$lienprod = get_bloginfo('url').'/banderoles';};

			// séparer nom prénom et ne garder que l'initiale du nom------------------
			$nomcomplet = trim($us->f_name);
	    $nom = (strpos($nomcomplet, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $nomcomplet);
	    $prenom = trim( preg_replace('#'.$nom.'#', '', $nomcomplet ) );
			$nom = substr($nom, 0, 1);
			//------------------------------------------------------------------------

			$reponses = $wpdb->get_row("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_reponses` WHERE r_id='$r[id]'");
			if($reponses) {
			$view .= '<tr><td class="lefttd">par '.$prenom.' '.$nom.'<br />'.$r[data].'
	<br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td><p>'.stripslashes($r[comment]).'</p><div class="review_answer"><p><strong>France Banderole, le '.$reponses->data.' :</strong><br />'.stripslashes($reponses->content).'</p></div></td></tr>';
			} else {
			$view .= '<tr><td class="lefttd">par '.$prenom.' '.$nom.'<br />'.$r[data].'
	<br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td>'.stripslashes($r[comment]).'</td></tr>';
			}

		endforeach;

		$view .= '</tbody></table>';
		$view .= '<div id="rating_pagination">'.pagination($licznik, $perPage, "id", $subpage, 10,$prod_family).'</div>';

	} else {

	if (isset($_POST['addrating'])) {
		$czyoceniony = $wpdb->get_row("SELECT * FROM `$fb_tablename_rating` WHERE unique_id = '$_POST[addrating]'");
		if (!$czyoceniony) {
			$data = date('Y-m-d H:i:s');
			$tresc = $_POST['content'];
			$tresc = addslashes($tresc);
			$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_rating` VALUES (not null, '".$_POST[addrating]."', 'true', '".$_POST[rafir]."', '".$_POST[rasec]."', '".$_POST[rathr]."', '".$tresc."', '".$data."')");
		}
	}
	$rates = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` WHERE exist = 'true' ORDER BY date DESC", ARRAY_A);
	$licznik = 0;
	$fir = 0;
	$sec = 0;
	$thi = 0;
	foreach ($rates as $r) :
		$licznik++;
		$fir = $fir + $r[fir];
		$sec = $sec + $r[sec];
		$thi = $thi + $r[thi];
	endforeach;
	$gen = ((($fir + $sec + $thi)/$licznik)/3); $gen = (round($gen, 0)) *30;
	$fir = ($fir / $licznik); $fir = (round($fir, 0)) *20;
	$sec = ($sec / $licznik); $sec = (round($sec, 0)) *20;
	$thi = ($thi / $licznik); $thi = (round($thi, 0)) *20;

	//Select pour la famille
	$view .= '<p><form method="get" action="">Voir les avis pour une famille de produits : <select name="prod_type">';
	$prodcat_list = $wpdb->get_results("SELECT DISTINCT code_parent, prod_parent FROM `$fb_tablename_catprods` ORDER BY prod_parent");
	$view .= '<option value="all">-- Tous --</option>';
	foreach ($prodcat_list as $prodcat) {
	$view .= '<option value="'.$prodcat->code_parent.'">'.$prodcat->prod_parent.'</option>';
	}
	$view .= '</select>&nbsp;<input type="submit" value="Valider"></form></p>';

	$view .= '
	<div id="rating_livre">
		<div id="vosavis"></div>';

	$view .= '<div id="rating_general"><h2>Vos avis :</h2>';
	$moyenne = $wpdb->get_row("SELECT AVG((fir+sec+thi)/3) AS moy FROM `$fb_tablename_rating`");
	$strmoyenne1 = round($moyenne->moy,2);
	$strmoyenne2 = "/5 - ";
	$total = $wpdb->get_row("SELECT COUNT(*) AS nb_avis FROM `$fb_tablename_rating` WHERE exist='true'");
	$strmoyenne3 = $total->nb_avis;
	$strmoyenne4 = " avis";

	$view .= '<span class="client_reviews_1">'. $strmoyenne1 . '</span>'. $strmoyenne2 . $strmoyenne3 . $strmoyenne4. '<br />';
	$view .= '<span class="star-note"><img src="'.get_bloginfo("url").'/wp-content/themes/fb/images/star-4_7.png" /></span><br />	';
	$view .= '</div></div>';

	$subpage = $_GET['page_num'];
	$perPage = 30;
	if (!empty($_GET['subpage']) && (is_numeric($_GET['subpage']))) {
		$subpage = (int) $_GET['subpage'];
	}
	if ($subpage < 1) {
		$subpage = 1;
	}
	$start = ($subpage - 1) * $perPage;

	$rates = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` WHERE exist = 'true' ORDER BY date DESC LIMIT $start, $perPage", ARRAY_A);

	$view .= '<table id="fbcart_rating" cellspacing="0"><tbody>';

	foreach ($rates as $r) :

		$singlerate = (($r[fir] + $r[sec] + $r[thi])/3); $singlerate = (round($singlerate, 0)) * 20;
		$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$r[unique_id]'");
		$prodname = $wpdb->get_row("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$r[unique_id]'");
		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$order->user'");
		if ($prodname->name == 'Kakemono'){$lienprod = get_bloginfo('url').'/roll-up';}
    elseif ($prodname->name == 'Banderole'){$lienprod = get_bloginfo('url').'/banderoles';}
    elseif ($prodname->name == 'Cartes 350g'){$lienprod = get_bloginfo('url').'/cartes';}
    elseif ($prodname->name == 'Cartes 270µ'){$lienprod = get_bloginfo('url').'/cartes';}
    elseif ($prodname->name == 'Cartes 350µ'){$lienprod = get_bloginfo('url').'/cartes';}
    elseif ($prodname->name == 'Oriflamme'){$lienprod = get_bloginfo('url').'/oriflammes';}
    elseif ($prodname->name == 'depliants 80g'){$lienprod = get_bloginfo('url').'/depliants';}
    elseif ($prodname->name == 'depliants 135g'){$lienprod = get_bloginfo('url').'/depliants';}
    elseif ($prodname->name == 'depliants 170g'){$lienprod = get_bloginfo('url').'/depliants';}
    elseif ($prodname->name == 'depliants 250g'){$lienprod = get_bloginfo('url').'/depliants';}
    elseif ($prodname->name == 'Enseigne'){$lienprod = get_bloginfo('url').'/enseignes';}
    elseif ($prodname->name == 'Flyers 80g'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 135g'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 170g'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 250g'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 350g'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 120µ'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 270µ'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Flyers 350µ'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif ($prodname->name == 'Affiches 135g'){$lienprod = get_bloginfo('url').'/affiches';}
    elseif ($prodname->name == 'PHOTOCALL 220x240'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
    elseif ($prodname->name == 'Barrière délimitation'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
    elseif ($prodname->name == 'Cadre extérieur 100x250cm'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
    elseif ($prodname->name == 'Cadre extérieur 125x300cm'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
    elseif ($prodname->name == 'Kit de Barrière supplémentaire'){$lienprod = get_bloginfo('url').'/plv-exterieur';}
    elseif ($prodname->name == 'Roll-up'){$lienprod = get_bloginfo('url').'/roll-up';}
    elseif ($prodname->name == 'Totem'){$lienprod = get_bloginfo('url').'/totem';}
    elseif ($prodname->name == 'Akilux 3mm'){$lienprod = get_bloginfo('url').'/panneaux-akilux-3mm';}
    elseif ($prodname->name == 'Akilux 3,5mm'){$lienprod = get_bloginfo('url').'/panneaux-akilux-3_5mm';}
    elseif ($prodname->name == 'Akilux 5mm'){$lienprod = get_bloginfo('url').'/panneaux-akilux-5mm';}
    elseif ($prodname->name == 'Forex 3mm'){$lienprod = get_bloginfo('url').'/panneaux-forex-3mm';}
    elseif ($prodname->name == 'Forex 5mm'){$lienprod = get_bloginfo('url').'/panneaux-forex-5mm';}
    elseif ($prodname->name == 'Dibond'){$lienprod = get_bloginfo('url').'/panneaux-dibond';}
    elseif ($prodname->name == 'Vinyles Stickers'){$lienprod = get_bloginfo('url').'/stickers';}
    elseif ($prodname->name == 'Tente'){$lienprod = get_bloginfo('url').'/tente-publicitaire-barnum';}
		elseif ($prodname->name == 'Nappe'){$lienprod = get_bloginfo('url').'/nappes-publicitaires';}
    else {$lienprod = get_bloginfo('url').'/banderoles';};

		// séparer nom prénom et ne garder que l'initiale du nom------------------
		$nomcomplet = trim($us->f_name);
		$nom = (strpos($nomcomplet, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $nomcomplet);
		$prenom = trim( preg_replace('#'.$nom.'#', '', $nomcomplet ) );
		$nom = substr($nom, 0, 1);
		//------------------------------------------------------------------------

		$reponses = $wpdb->get_row("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_reponses` WHERE r_id='$r[id]'");
		if($reponses) {
		$view .= '<tr><td class="lefttd">par '.$prenom.' '.$nom.'<br />'.$r[data].'
<br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td><p>'.stripslashes($r[comment]).'</p><div class="review_answer"><p><strong>France Banderole, le '.$reponses->data.' :</strong><br />'.stripslashes($reponses->content).'</p></div></td></tr>';
		} else {
		$view .= '<tr><td class="lefttd">par '.$prenom.' '.$nom.'<br />'.$r[data].'
<br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td>'.stripslashes($r[comment]).'</td></tr>';
		}



	endforeach;

	$view .= '</tbody></table>';

	$view .= '<div id="rating_pagination">'.pagination($licznik, $perPage, "id", $subpage, 10,'all').'</div>';

	}

	return $view;


}


function get_fb_rating() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_rating = $prefix."fbs_rating";
	$fb_tablename_order = $prefix."fbs_order";
	$idzamowienia = $_GET['rating'];
	$czyoceniony = $wpdb->get_row("SELECT * FROM `$fb_tablename_rating` WHERE unique_id = '$idzamowienia'");
	if (!$czyoceniony) {
		$view = '<h1>Donnez Votre Avis</h1><hr />';
		$view .= '<div id="rating"><form name="ratingform" id="ratingform" action="'.get_bloginfo("url").'/avis/" method="post"><input type="hidden" name="addrating" value="'.$idzamowienia.'" />';

		$view .= '<div class="rating_element" id="raele1">
			<div class="rating_elcol1">Evaluez le rapport<br />qualité / prix de vos achats:</div>
			<div class="rating_elcol2">
				<input type="hidden" name="rafir" value="0" id="ratin1" />
				<ul id="rafir" class="star-rating"><li class="current-rating" style="width:0px;"></li><li><a href="#" class="one-star">1</a></li><li><a href="#" class="two-stars">2</a></li><li><a href="#" class="three-stars">3</a></li><li><a href="#" class="four-stars">4</a></li><li><a href="#" class="five-stars">5</a></li></ul>
			</div>
			</div>';
		$view .= '<div class="rating_element" id="raele2">
			<div class="rating_elcol1">Evaluez la communication<br />avec l\'équipe de France Banderole:</div>
			<div class="rating_elcol2">
				<input type="hidden" name="rasec" value="0" id="ratin2" />
				<ul id="rasec" class="star-rating"><li class="current-rating" style="width:0px;"></li><li><a href="#" class="one-star">1</a></li><li><a href="#" class="two-stars">2</a></li><li><a href="#" class="three-stars">3</a></li><li><a href="#" class="four-stars">4</a></li><li><a href="#" class="five-stars">5</a></li></ul>
			</div>
			</div>';
		$view .= '<div class="rating_element" id="raele3">
			<div class="rating_elcol1">Evaluez le temps de traitement<br />de votre commande et sa livraison:</div>
			<div class="rating_elcol2">
				<input type="hidden" name="rathr" value="0" id="ratin3" />
				<ul id="rathr" class="star-rating"><li class="current-rating" style="width:0px;"></li><li><a href="#" class="one-star">1</a></li><li><a href="#" class="two-stars">2</a></li><li><a href="#" class="three-stars">3</a></li><li><a href="#" class="four-stars">4</a></li><li><a href="#" class="five-stars">5</a></li></ul>
			</div>
			</div>';
		$view .= '<div class="rating_element2">
				<span>Laissez un commentaire:</span>
				<textarea name="content" id="textarearating" rows="10" cols="10">'.$tresc.'</textarea>
				<input class="but_ratingsubmit" type="submit" onclick="return validaterating();" value="donnez votre avis" />
			</div>';
		$view .= '<div class="form-error-message-rating"><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" align="left" style="margin-right:5px;"> Veuillez remplir tous les champs du formulaire.</div>';
		$view .= '</form></div>';
		$view .= '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/rating.js" type="text/javascript"></script>';
	} else {
		$view = "";
	}
	return $view;
}





function pagination_link($id, $page_num,$prod_family){
	if ($prod_family == 'all') {
		return '?page_num='.$page_num;
	} else {
		return '?page_num='.$page_num.'&prod_type='.$prod_family;
	}
}
function pagination($num_of_items, $items_per_page, $id, $page_num, $max_links, $prod_family){
	$total_pages = ceil($num_of_items/$items_per_page);
	$ret = '<span class="ratingpagpage">PAGES:</span>';
	if($page_num) {
		if($page_num >1){
			$prev = '<a href="'.pagination_link($id, ($page_num -1 ),$prod_family).'">&laquo; Précédent</a>';
//			$first = '<a href="'.pagination_link($id, 1).'">First Page &lt;&lt;</a>';
		}
	}
	if($page_num <$total_pages){
		$next = '<a href="'.pagination_link($id, ($page_num+1),$prod_family).'">Suivant &raquo;</a>';
//		$last = '<a href="'.pagination_link($id, $total_pages).'"> LAST PAGE &gt;&gt;</a>';
	}
//	$ret .= $first;
	$ret .= $prev;
	$loop = 0;
	if($page_num >= $max_links) {
		$page_counter = ceil($page_num - ($max_links-1));
	} else {
		$page_counter = 1;
	}
	if($total_pages < $max_links){
		$max_links = $total_pages;
	}
	do{
		if($page_counter == $page_num) {
			$ret .= '<span>'.$page_counter.'</span>';
		} else {
			$ret .= '<a href="'.pagination_link($id, ($page_counter),$prod_family).'">'.$page_counter.'</a>';
		}
		$page_counter++; $current_page=($page_counter+1);
		$loop++;
	} while ($max_links > $loop);
	$ret .= $next;
//	$ret .= $last;
	return $ret;
}

?>
