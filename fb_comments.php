<?php

function get_fb_comments() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_comments = $prefix."fbs_comments";
	$idzamowienia = $_GET['comment'];
	$tresc = '';
	$tematid = '';

	$zamowienie = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	$status = $zamowienie->status;

	if (isset($_POST['addcomment'])) {
		$tresc = $_POST['content'];
		$tematid = $_POST['selecttopic'];
		if ($tresc != '') {
//			if ($tematid != '') {
				$user = $_SESSION['loggeduser'];
				$temat = $wpdb->get_row("SELECT * FROM `$fb_tablename_topic` WHERE id='$tematid'");
				$data = date('Y-m-d H:i:s');
//				$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$idzamowienia."', '".$temat->content."', '".$data."', '".$user->f_name."', '".$tresc."')");
				$tresc = addslashes($tresc);
				$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$idzamowienia."', '', '".$data."', '".$user->f_name."', '".$tresc."')");
				if ($dodawanie) { $tresc = ''; $tematid = ''; }
//			} else {
//				$view .= '<p>'._FB_CTOP.'</p>';
//			}
		} else {
			$view .= '<p>'._FB_CCON.'</p>';
		}
	}

	$topics = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` ORDER BY content ASC", ARRAY_A);


	if ($status!=5 && $status!=6 ) {
		$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i>  Accès client: Ecrire un Commentaire</h1><hr />';
		$view .= '<div id="comments">';
		$view .= '<div id="comment_left">';
		$view .= '<span class="comm_title">Ecrivez votre nouveau commentaire ou demande ci-dessous:</span>
	  <form name="topics" id="topics" action="" method="post"><input type="hidden" name="addcomment" />';
		$view .= '<textarea name="content" id="textareacomments" rows="20" cols="100">'.$tresc.'</textarea>';
		$view .= '<a href="'.get_bloginfo("url").'/vos-devis/?detail='.$idzamowienia.'" class="but_espace"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour Devis</a>';
		$view .= '<input class="but_envoyer" type="submit" value="Envoyer" /></form></div>';
	}else{
		$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i>  Accès client: Commentaires archivés</h1><hr />';
		$view .= '<div id="comments">';
		$view .= '<div id="comment_left">';
	}


	$comments = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` WHERE order_id = '$idzamowienia' ORDER BY date DESC", ARRAY_A);
	if ($comments) {
	$view .= '<div class="com_list">';

	foreach ($comments as $c) :
		$c[content] = stripslashes($c[content]);
		//$c[content]= htmlspecialchars($c[content]);
		$c[topic] = stripslashes($c[topic]);
		$c[topic] = htmlspecialchars($c[topic]);

		$fb = preg_match_all('/France Banderole/', $c[author], $result);
		$fb = count($result[0]);

		if ($fb >= 1) {
			$klasa = ' class="comment_right2"';
			$view .= '<div'.$klasa.'><span class="comm_title2">Date:</span>&nbsp;'.$c[data].'<span class="comm_title3">Expediteur:</span>&nbsp;'.$c[author].'<p class="sujet"><span class="comm_title2">Sujet:</span>&nbsp;'.$c[topic].'</p>'.nl2br($c[content]).'</div>';
		} else {
			$c[content]= htmlspecialchars($c[content]);
			$klasa = ' class="comment_right"';
			$view .= '<div'.$klasa.'><span class="comm_title2">Date:</span>&nbsp;'.$c[data].'<span class="comm_title3">Expediteur:</span>&nbsp;'.$c[author].'<p></p>'.nl2br($c[content]).'</div>';
		}
	endforeach;

	$view .= '</div>';
	}
	$view .= '</div>';
	return $view;
}

?>
