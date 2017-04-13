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
	$view .= '<h1>Livre d\'Or</h1><hr />';
	$view .= '
	<div id="rating_livre">
		<div id="vosavis"></div>
		<div id="rating_general">
			<table cellpadding="0" cellspacing="0"><tbody>
				<tr><td class="rfirst">Rapport qualité / prix<br />de vos achats:</td><td><ul class="star-rating2"><li class="current-rating" style="width:'.$fir.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td></tr>
				<tr><td class="rfirst">Communication avec l\'équipe <br />de france banderole:</td><td><ul class="star-rating2"><li class="current-rating" style="width:'.$sec.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td></tr>
				<tr><td class="rfirst">Temps de traitement de votre<br />commande et sa livraison:</td><td><ul class="star-rating2"><li class="current-rating" style="width:'.$thi.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td></tr>
				<tr><td class="rfirst2">Note GloBALE des clients:</td><td class="rsecond2"><ul class="star-rating3"><li class="current-rating" style="width:'.$gen.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td></tr>
			</tbody></table>
		</div>
	</div>
	';

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
	$view .= '<h1>Vos commentaires:</h1><hr />';
	$view .= '<table id="fbcart_rating" cellspacing="0"><tbody>';
	foreach ($rates as $r) :
		$singlerate = (($r[fir] + $r[sec] + $r[thi])/3); $singlerate = (round($singlerate, 0)) * 20;
		$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$r[unique_id]'");
		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$order->user'");
		$view .= '<tr><td class="lefttd">par '.$us->f_name.'<br />'.$r[data].'</td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td>'.stripslashes($r[comment]).'</td></tr>';
	endforeach;
	$view .= '</tbody></table>';

	$view .= '<div id="rating_pagination">'.pagination($licznik, $perPage, "id", $subpage, 10).'</div>';

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
		$view .= '<div id="rating"><form name="ratingform" id="ratingform" action="'.get_bloginfo("url").'/livre-dor/" method="post"><input type="hidden" name="addrating" value="'.$idzamowienia.'" />';

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
				<input class="but_ratingsubmit" type="submit" onclick="return validaterating();" value="" />
			</div>';
		$view .= '<div class="form-error-message-rating"><img src="http://v3.jotform.com/images/exclamation-octagon.png" align="left" style="margin-right:5px;"> Veuillez remplir tous les champs du formulaire.</div>';
		$view .= '</form></div>';
		$view .= '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/rating.js" type="text/javascript"></script>';
	} else {
		$view = "";
	}
	return $view;
}





function pagination_link($id, $page_num){
	return '?page_num='.$page_num;
}
function pagination($num_of_items, $items_per_page, $id, $page_num, $max_links){
	$total_pages = ceil($num_of_items/$items_per_page);
	$ret = '<span class="ratingpagpage">PAGES:</span>';
	if($page_num) {
		if($page_num >1){
			$prev = '<a href="'.pagination_link($id, ($page_num -1 )).'">&laquo; Précédent</a>';
//			$first = '<a href="'.pagination_link($id, 1).'">First Page &lt;&lt;</a>';
		}
	}
	if($page_num <$total_pages){
		$next = '<a href="'.pagination_link($id, ($page_num+1)).'">Suivant &raquo;</a>';
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
			$ret .= '<a href="'.pagination_link($id, ($page_counter)).'">'.$page_counter.'</a>';
		}
		$page_counter++; $current_page=($page_counter+1);
		$loop++;
	} while ($max_links > $loop);
	$ret .= $next;
//	$ret .= $last;
	return $ret;
}

?>
