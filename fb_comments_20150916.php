<?php

function get_fb_comments() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";
	$idzamowienia = $_GET['comment'];
	$tresc = '';
	$tematid = '';
				
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
	$view .= '<h1>Accès client: Ecrire un Commentaire</h1><hr />';
	$view .= '<div id="comments">';
	$view .= '<div id="comment_left">
	<span class="comm_title">Ecrivez votre nouveau commentaire ou demande ci-dessous:</span>
	<form name="topics" id="topics" action="" method="post"><input type="hidden" name="addcomment" />';
/*
	if ($topics) {
		$view .= '<b>sujet:</b><select name="selecttopic"><option value="">choisir...</option>';
		foreach ($topics as $t) :
			if ($tematid == $t[id]) {
				$s = ' selected="selected"';
			} else {
				$s = '';			
			}
			$view .= '<option value="'.$t[id].'"'.$s.'>'.$t[content].'</option>';
		endforeach;
		$view .= '</select>';
	}
*/
	$view .= '<textarea name="content" id="textareacomments" rows="20" cols="10">'.$tresc.'</textarea>';
	$view .= '<input class="but_envoyer" type="submit" value="" />';
	$view .= '<a href="'.get_bloginfo("url").'/vos-devis/?detail='.$idzamowienia.'" class="but_espace">Retour Devis</a></form></div>';
	
	
	$comments = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` WHERE order_id = '$idzamowienia' ORDER BY date DESC", ARRAY_A);
	if ($comments) {
	$view .= '<div class="com_list">';
	foreach ($comments as $c) :	
		$c[content] = stripslashes($c[content]);
		$c[content]= htmlspecialchars($c[content]);
		$c[topic] = stripslashes($c[topic]);
		$c[topic] = htmlspecialchars($c[topic]);

		if ($c[author] == 'France Banderole') {
			$klasa = ' class="comment_right2"';
			$view .= '<div'.$klasa.'><span class="comm_title2">Date:</span>&nbsp;'.$c[data].'<span class="comm_title3">Expediteur:</span>&nbsp;'.$c[author].'<p class="sujet"><span class="comm_title2">Sujet:</span>&nbsp;'.$c[topic].'</p>'.nl2br($c[content]).'</div>';
		} else {
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