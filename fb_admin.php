<?php

include_once(ABSPATH . 'wp-content/plugins/fbshop/fb_admin_functions.php');

// on insère la fonction function fb_admin_expedition() {}
include_once("fb_admin_expedition.php");
include_once("class/PHPExcel.php");

//include_once("class/html2pdf/html2pdf.class.php");

function fb_admin_init() {
    global $wpdb;
    $prefix = $wpdb->prefix;

    add_action('admin_menu', 'fbs_admin_menu');
    add_action('admin_head', 'fbs_admin_head');


$resultaddcolumn = mysqli_query("SHOW COLUMNS FROM " . $prefix . "fbs_order LIKE 'poids'");
$existsaddcolumn = (mysqli_num_rows($resultaddcolumn)?true:false);
if(!$existsaddcolumn) {
	$sql = "ALTER TABLE `" . $prefix . "fbs_order` ADD COLUMN `poids` VARCHAR (100) NULL DEFAULT 0 AFTER `status`;";
    $wpdb->query($sql);
}
    //$sql = "ALTER TABLE `" . $prefix . "fbs_order` ADD COLUMN `poids` IF NOT EXISTS `poids` VARCHAR (100) NULL DEFAULT 0 AFTER `status`;";

}
function fbs_admin_menu() {
    add_menu_page('FB Shop', 'FB Shop', 1, 'fbsh', 'fb_admin_sales');
    add_submenu_page('fbsh', 'Sales', 'Sales', 1, 'fbsh', 'fb_admin_sales');
    add_submenu_page('fbsh', 'Sales', 'Old Sales', 1, 'fbsho', 'fb_admin_sales_old');
    add_submenu_page('fbsh', 'Promotions', 'Promotions', 10, 'fb-promotions', 'fb_admin_promotions');
    add_submenu_page('fbsh', 'PLV Managemenet', 'PLV Managemenet', 1, 'fb-plv', 'fb_admin_plv');
	add_submenu_page('fbsh', 'PLV Int', 'PLV Int', 1, 'fb-plv_int', 'fb_admin_plv_int');
	add_submenu_page('fbsh', 'Buraliste Managemenet', 'Buraliste Managemenet', 1, 'fb-buraliste', 'fb_admin_buraliste');
    add_submenu_page('fbsh', 'Accesoires Managemenet', 'Accesoires Managemenet', 1, 'fb-acc', 'fb_admin_acc');
	add_submenu_page('fbsh', 'MMA', 'MMA', 1, 'fb-mma', 'fb_admin_mma');
	add_submenu_page('fbsh', 'Accesoires2', 'Accesoires2', 1, 'fb-acc2', 'fb_admin_acc2');
    add_submenu_page('fbsh', 'Last Comments', 'Last Comments', 1, 'fb-comments', 'fb_admin_ncomments');
    add_submenu_page('fbsh', 'Mails', 'Mails', 1, 'fb-mails', 'fb_admin_mails');
    add_submenu_page('fbsh', 'Users', 'Users', 1, 'fb-users', 'fb_admin_users2');
    add_submenu_page('fbsh', 'Comments Topics', 'Comments Topics', 1, 'fb-topic', 'fb_admin_topic');
    add_submenu_page('fbsh', 'Ratings', 'Ratings', 1, 'fb-ratings', 'fb_admin_rating');
    add_submenu_page('fbsh', 'Reponses', 'Reponses', 1, 'fb-ratings-comments', 'fb_admin_ratings_comments');
    add_submenu_page('fbsh', 'Reports', 'Reports', 1, 'fb-reports', 'fb_admin_reports');
    add_submenu_page('fbsh', 'User Reports', 'User Reports', 1, 'fb-reports-users', 'fb_admin_reports_users');
	add_submenu_page('fbsh', 'adresse mail01', 'adresse mail01', 1, 'fb-adresse-mail01', 'fb_admin_adresse_mail01');
	add_submenu_page('fbsh', 'Expédition Commandes', 'Expédition Commandes', 1, 'fb-expedition', 'fb_admin_expedition');
	add_submenu_page('fbsh', 'Groupes clients', 'Groupes clients', 1, 'fb_manage_groupes', 'fb_groupes');
	add_submenu_page('fbsh', 'Moyens de paiement', 'Moyens de paiement', 1, 'fb_manage_payment', 'fb_payment');
	add_submenu_page('fbsh', 'Relances clients', 'Relances clients', 1, 'fb_manage_relances', 'fb_relances');
	add_submenu_page('fbsh', 'Sync Mailjet', 'Synchronisation Mailjet', 1, 'fb_sync_mailjet', 'fb_mailjet');
//    add_submenu_page('fbsh', 'Import', 'Import', 1, 'fb-import', 'fb_admin_import');
}

add_shortcode('FBRATINGS', 'get_ratings');
function get_ratings($type_prod, $nb_comment=2) {
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
	$prod_family = $type_prod['type_prod'];
	$prod_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_catprods` WHERE code_parent = '$prod_family'");
	$display_name = $prod_name->prod_parent;

	$view = '<div style="clear: both;">
		<div id="rating_livre">
			<div id="vosavis"></div>';

		$view .= '<div id="rating_general" style="text-align: center; font-size: 18px;"><br /><br /><br /><br />';
		$notation = $wpdb->get_row("SELECT * FROM `$fb_tablename_cache_notes` WHERE code_parent = '$prod_family'");
		$strmoyenne1 = $notation->note;
		// $moyenne = $wpdb->get_row("SELECT AVG(r.fir+r.sec+r.thi)/3 AS moy FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
		// $strmoyenne1 = round($moyenne->moy,2);
		$strmoyenne2 = "/5 - ";
		// $total = $wpdb->get_row("SELECT COUNT(*) AS nb_avis FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
		// $strmoyenne3 = $total->nb_avis;
		$strmoyenne3 = $notation->nb_avis;
		$strmoyenne4 = " avis";

		$view .= '<span class="client_reviews_1">'. $strmoyenne1 . '</span>'. $strmoyenne2 . $strmoyenne3 . $strmoyenne4. '<br />';
		$view .= '<span class="star-note"><img src="'.get_bloginfo("url").'/wp-content/themes/fb/images/star-4_7.png" /></span><br />';
		$view .= 'pour les produits de type '.$display_name;
		$view .= '</div></div></div>';

		//$rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC LIMIT 2", ARRAY_A);
		$rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_cache_comments` c WHERE r.exist = 'true' AND c.code_parent = '$prod_family' AND (r.id = c.comment1 OR r.id = c.comment2 OR r.id = c.comment3 OR r.id = c.comment4 OR r.id = c.comment5) ORDER BY r.date DESC LIMIT 2", ARRAY_A);
		$view .= '<h1>Vos commentaires:</h1><hr />';
		$view .= '<table id="fbcart_rating" cellspacing="0"><tbody>';
		$i = 0;

		foreach ($rates as $r) :

			// $i++;
			// if($i == 1) {
				// $mise_cache = $wpdb->query("INSERT INTO `$fb_tablename_cache_comments` VALUES ('','$prod_family','$r[id]',0)");
			// } else if($i == 2) {
				// $mise_cache = $wpdb->query("UPDATE `$fb_tablename_cache_comments` SET comment2 = '$r[id]' WHERE code_parent = '$prod_family'");
			// }


			$singlerate = (($r[fir] + $r[sec] + $r[thi])/3); $singlerate = (round($singlerate, 0)) * 20;
			$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$r[unique_id]'");
			$prodname = $wpdb->get_row("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$r[unique_id]'");
			$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$order->user'");
			if ($prodname->name == 'Kakemono'){$lienprod = "//www.france-banderole.com/kakemonos";}
			elseif ($prodname->name == 'Banderole'){$lienprod = "//www.france-banderole.com/banderoles";}
			elseif ($prodname->name == 'Adhésif / Sticker'){$lienprod = "//www.france-banderole.com/stickers";}
			elseif ($prodname->name == 'Cartes 350g'){$lienprod = "//www.france-banderole.com/cartes";}
			elseif ($prodname->name == 'Cartes 270µ'){$lienprod = "//www.france-banderole.com/cartes";}
			elseif ($prodname->name == 'Cartes 350µ'){$lienprod = "//www.france-banderole.com/cartes";}
			elseif ($prodname->name == 'Oriflamme'){$lienprod = "//www.france-banderole.com/oriflammes";}
			elseif ($prodname->name == 'depliants 80g'){$lienprod = "//www.france-banderole.com/depliants";}
			elseif ($prodname->name == 'depliants 135g'){$lienprod = "//www.france-banderole.com/depliants";}
			elseif ($prodname->name == 'depliants 170g'){$lienprod = "//www.france-banderole.com/depliants";}
			elseif ($prodname->name == 'depliants 250g'){$lienprod = "//www.france-banderole.com/depliants";}
			elseif ($prodname->name == 'Enseigne'){$lienprod = "//www.france-banderole.com/enseignes";}
			elseif ($prodname->name == 'Flyers 80g'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 135g'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 170g'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 250g'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 350g'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 120µ'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 270µ'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Flyers 350µ'){$lienprod = "//www.france-banderole.com/flyers";}
			elseif ($prodname->name == 'Affiches 135g'){$lienprod = "//www.france-banderole.com/affiches";}
			elseif ($prodname->name == 'PHOTOCALL 220x240'){$lienprod = "//www.france-banderole.com/plv-exterieur";}
			elseif ($prodname->name == 'Barrière délimitation'){$lienprod = "//www.france-banderole.com/plv-exterieur";}
			elseif ($prodname->name == 'Cadre extérieur 100x250cm'){$lienprod = "//www.france-banderole.com/plv-exterieur";}
			elseif ($prodname->name == 'Cadre extérieur 125x300cm'){$lienprod = "//www.france-banderole.com/plv-exterieur";}
			elseif ($prodname->name == 'Kit de Barrière supplémentaire'){$lienprod = "//www.france-banderole.com/plv-exterieur";}
			else {$lienprod = "//www.france-banderole.com";};

			$reponses = $wpdb->get_row("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_reponses` WHERE r_id='$r[id]'");
			if($reponses) {
			$view .= '<tr><td class="lefttd">par '.$us->f_name.'<br />'.$r[data].'
	<br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td><p>'.stripslashes($r[comment]).'</p><div style="background-color: #eee; margin-left: 12px; padding: 4px;"><p><strong>France Banderole, le '.$reponses->data.' :</strong><br />'.stripslashes($reponses->content).'</p></div></td></tr>';
			} else {
			$view .= '<tr><td class="lefttd">par '.$us->f_name.'<br />'.$r[data].'
	<br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td>'.stripslashes($r[comment]).'</td></tr>';
			}



		endforeach;

		$view .= '</tbody></table>';
		$view .= '<p><a href="'.get_bloginfo("url").'/avis?prod_type='.$prod_family.'">Voir les autres avis sur cette famille de produits</a></p>';

	return $view;
}

function fb_admin_rating() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_rating = $prefix."fbs_rating";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_reponses = $prefix."fbs_reponses";
	if (isset($_POST[publish])) {
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_rating` SET exist='true' WHERE unique_id='$_POST[publish]'");
	}
	if (isset($_POST[unpublish])) {
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_rating` SET exist='false' WHERE unique_id='$_POST[unpublish]'");
	}
	if (isset($_POST[delrating_act])) {
		$apdejt = $wpdb->query("DELETE FROM `$fb_tablename_rating` WHERE unique_id='$_POST[delrating_act]'");
	}
	$rates = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` ORDER BY date DESC", ARRAY_A);
	if ($rates) {
		echo '<table class="widefat"><tr><th>N° DE COMMANDE</th><th>DATE</th><th>CLIENT</th><th>RAPPORT</th><th>COMMUNICATION</th><th>TEMPS</th><th>GENERAL</th><th>TEXT</th><th>PUBLIÉ?</th><th>ACTION</th><th>REPONSE</th><th>SUPPR</th></tr>';
		foreach ($rates as $r) :
			$general = ($r[fir]+$r[sec]+$r[thi])/3;
			$general = round($general, 2);
			$unpu = '<form name="unpurating" action="" method="post">
			<input type="hidden" name="unpublish" value="'.$r[unique_id].'" />
			<input type="submit" value="Dépublier" />
			</form>';
			$del = '<form name="delrating action="" method="post">
			<input type="hidden" name="delrating_act" value="'.$r[unique_id].'" />
			<input type="submit" value="Supprimer" />
			</form>';
			$publ = '<form name="unpurating" action="" method="post">
			<input type="hidden" name="publish" value="'.$r[unique_id].'" />
			<input type="submit" value="publish" />
			</form>';
			if ($r[exist] == "true") {
				$act = $unpu;
			} else {
				$act = $publ;
			}
			$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$r[unique_id]'");
			$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$order->user'");
			$user = '
			<form name="fb_view_user" method="post" action="admin.php?page=fb-users">
			<input type="hidden" name="action" value="fb_view_user" />
			<input type="hidden" name="fb_view_user_id" value="'.$us->id.'" />
			<input type="submit" name="fb_user_view" class="edit" value="'.$us->f_name.'"  />
			</form>';
			if ($r[exist] == 'false') {
				$text='<span style="text-decoration:line-through">'.$r[comment].'</span>';
				$exist='<span style="color:red">'.$r[exist].'</span>';
			} else {
				$text = $r[comment];
				$exist= $r[exist];
			}
			$reponses = $wpdb->get_row("SELECT * FROM `$fb_tablename_reponses` WHERE r_id='$r[id]'");
			if($reponses) {
				$comment = '1 réponse';
			} else {
				$comment = '0 réponse';
			}
			echo '<tr><td><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbdet='.$r[unique_id].'" target="_blank">'.$r[unique_id].'</a></td><td>'.$r[data].'</td><td>'.$user.'</td><td style="text-align:center">'.$r[fir].'</td><td style="text-align:center">'.$r[sec].'</td><td style="text-align:center">'.$r[thi].'</td><td style="text-align:center">'.$general.'</td><td>'.$text.'</td><td>'.$exist.'</td><td>'.$act.'</td><td><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fb-ratings-comments&r_id='.$r[id].'">'.$comment.'</a></td><td>'.$del.'</tr>';
		endforeach;
		echo '</table>';
	}
}

function fb_admin_ratings_comments() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_rating = $prefix."fbs_rating";
	$fb_tablename_reponses = $prefix."fbs_reponses";
	if(isset($_GET['r_id'])) {
		$r_id = $_GET['r_id'];
		echo '<h2>Rédiger une réponse à un avis</h2>';
		$avis = $wpdb->get_row("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` WHERE id = '".$r_id."'");

		if($avis) {

			if(isset($_POST['reponse'])) {
				$reponse = $wpdb->get_row("SELECT * FROM `$fb_tablename_reponses` WHERE r_id='$avis->id'");
				if($reponse) {
					$reponse_up = $_POST['reponse'];
					$wpdb->update(
						$fb_tablename_reponses,
						array(
							'content' => $reponse_up,
						),
						array( 'r_id' => $avis->id)
					);
				} else {
					$reponse_up = $_POST['reponse'];
					$wpdb->insert(
						$fb_tablename_reponses,
						array(
							'content' => $reponse_up,
							'r_id' => $avis->id,
							'date' => current_time('mysql')
						)
					);
				}

				echo '<div class="updated">Réponse bien enregistrée</div>';
			}

			echo '<p><strong>Identifiant de la commande :</strong> '.$avis->unique_id.'</p>';
			echo '<p><strong>Texte de l\'avis :</strong></p>';
			echo '<div style="background-color: #ddd; max-width: 720px;"><p>'.$avis->comment.'</p></div>';

			$reponse = $wpdb->get_row("SELECT * FROM `$fb_tablename_reponses` WHERE r_id='$avis->id'");
			if($reponse) {
				echo '<p><strong>Réponse enregistrée :</strong></p>';
				echo '<div style="background-color: #ddd; max-width: 720px;"><p>'.stripslashes($reponse->content).'</p></div>';
				echo '<p><strong>Modifier la réponse :</strong></p>';
				echo '<form method="post"><textarea name="reponse" style="width: 720px;" rows=4>'.stripslashes($reponse->content).'</textarea><br />';
				echo '<input type="submit" value="Valider" /></form>';
			} else {
				echo '<p>Pas encore de réponse saisie pour cet avis</p>';
				echo '<p><strong>Saisir une réponse :</strong></p>';
				echo '<form method="post"><textarea name="reponse">Votre réponse ici</textarea><br />';
				echo '<input type="submit" value="Valider" /></form>';
			}


		} else {
			echo 'Erreur ! Aucun avis ne correspond à l\'identifiant renseigné.';
		}



	} else {
		echo '<p>Bienvenue sur l\'administration des réponses aux clients. Pour rédiger une réponse, rendez-vous sur la page <a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fb-ratings">Ratings</a>.</p>';
	}

}

function fb_groupes() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_paiement = $prefix."fbs_paiement";

	if(isset($_POST['paiement_sub'])) {
		$tbl_paiement_post = $wpdb->get_results("SELECT * FROM `$fb_tablename_paiement`");
		$code_erreur = 0;
		foreach ($tbl_paiement_post as $group_post) {
			$grp_desc = $_POST['desc_'.$group_post->code];
			if(isset($_POST['cb_'.$group_post->code])) {
				$grp_cb = 1;
			} else {
				$grp_cb = 0;
			}
			if(isset($_POST['cheque_'.$group_post->code])) {
				$grp_cheque = 1;
			} else {
				$grp_cheque = 0;
			}
			if(isset($_POST['virement_'.$group_post->code])) {
				$grp_virement = 1;
			} else {
				$grp_virement = 0;
			}
			if(isset($_POST['trente_'.$group_post->code])) {
				$grp_trente = 1;
			} else {
				$grp_trente = 0;
			}
			if(isset($_POST['soixante_'.$group_post->code])) {
				$grp_soixante = 1;
			} else {
				$grp_soixante = 0;
			}
			if(isset($_POST['mandat_'.$group_post->code])) {
				$grp_mandat = 1;
			} else {
				$grp_mandat = 0;
			}
			$req_grp = $wpdb->query("UPDATE `$fb_tablename_paiement` SET description='$grp_desc', cb='$grp_cb', cheque='$grp_cheque', virement='$grp_virement', trente='$grp_trente', soixante='$grp_soixante', mandat='$grp_mandat' WHERE code = '$group_post->code'");
			if(!($req_grp)) {
				$code_erreur = 1;
			}
		}
		if($code_erreur == 0) {
			echo '<div class="updated"><p>Mise à jour des groupes clients bien effectuée.</p></div>';
		} else {
			echo '<div class="error"><p>Erreur lors de la mise à jour des groupes clients.</p></div>';
		}
	}

	echo '<p>Bienvenue dans l\'administration des groupes France Banderole.</p>';

	$tbl_paiement = $wpdb->get_results("SELECT * FROM `$fb_tablename_paiement`");
	if($tbl_paiement) {
		echo '<form method="post">';
		echo '<table><tr><th>Code</th><th>Intitulé</th><th>CB</th><th>Chèque</th><th>Virement</th><th>30 jours</th><th>60 jours</th><th>Mandat adm.</th></tr>';

		foreach ($tbl_paiement as $group) {
			if ($group->cb != 0) {
				$td_cb = '<input type="checkbox" name="cb_'.$group->code.'" checked />';
			} else {
				$td_cb = '<input type="checkbox" name="cb_'.$group->code.'" />';
			}

			if ($group->cheque != 0) {
				$td_cheque = '<input type="checkbox" name="cheque_'.$group->code.'" checked />';
			} else {
				$td_cheque = '<input type="checkbox" name="cheque_'.$group->code.'" />';
			}

			if ($group->virement != 0) {
				$td_virement = '<input type="checkbox" name="virement_'.$group->code.'" checked />';
			} else {
				$td_virement = '<input type="checkbox" name="virement_'.$group->code.'" />';
			}

			if ($group->trente != 0) {
				$td_30j = '<input type="checkbox" name="trente_'.$group->code.'"checked />';
			} else {
				$td_30j = '<input type="checkbox" name="trente_'.$group->code.'" />';
			}

			if ($group->soixante != 0) {
				$td_60j = '<input type="checkbox" name="soixante_'.$group->code.'" checked />';
			} else {
				$td_60j = '<input type="checkbox" name="soixante_'.$group->code.'" />';
			}

			if ($group->mandat != 0) {
				$td_mandat = '<input type="checkbox" name="mandat_'.$group->code.'" checked />';
			} else {
				$td_mandat = '<input type="checkbox" name="mandat_'.$group->code.'" />';
			}

			echo '<tr><td style="min-width: 60px;">'.$group->code.'</td><td style="text-align: center;"><input type="text" name="desc_'.$group->code.'" value="'.$group->description.'" /></td><td style="text-align: center;">'.$td_cb.'</td><td style="text-align: center;">'.$td_cheque.'</td><td style="text-align: center;">'.$td_virement.'</td><td style="text-align: center;">'.$td_30j.'</td><td style="text-align: center;">'.$td_60j.'</td><td style="text-align: center;">'.$td_mandat.'</td></tr>';

		}
		echo '</table>';
		echo '<p><input type="submit" name="paiement_sub" value="Valider" /></p>';

	}



}

function fb_payment() {
	//Permet d'administrer les différents moyens de paiement et le pourcentage de surcôte appliqué

	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";

	if(isset($_POST['paiement_moy'])) {
		$tbl_paiement_moy_post = $wpdb->get_results("SELECT * FROM `$fb_tablename_paiement_moy`");
		$code_erreur = 0;
		foreach ($tbl_paiement_moy_post as $payment_post) {
			$pay_desc = $_POST['desc_'.$payment_post->pay_code];
			$pay_percent = $_POST['percent_'.$payment_post->pay_code];


			$req_pay = $wpdb->query("UPDATE `$fb_tablename_paiement_moy` SET pay_designation='$pay_desc', pay_percent_add='$pay_percent' WHERE pay_code = '$payment_post->pay_code'");
			if(!($req_pay)) {
				$code_erreur = 1;
			}
		}
		//if($code_erreur == 0) {
			echo '<div class="updated"><p>Mise à jour des groupes clients bien effectuée.</p></div>';

		// } else {
			// echo '<div class="error"><p>Erreur lors de la mise à jour des groupes clients.</p>';
			// echo '<p>'.$tmp.'</p></div>';
		// }
	}

	echo '<p>Bienvenue dans l\'administration des moyens de paiement France Banderole.</p>';
	echo '<p><strong>Note :</strong> Le champ "Intitulé" n\'est utilisé que pour la visualisation du nom du moyen de paiement en back-office, sur la page Sales.';

	$tbl_paiement_moy = $wpdb->get_results("SELECT * FROM `$fb_tablename_paiement_moy`");
	if($tbl_paiement_moy) {
		echo '<form method="post">';
		echo '<table><tr><th>Code</th><th>Intitulé</th><th>% de majoration</th></tr>';

		foreach ($tbl_paiement_moy as $moy_pay) {

			echo '<tr><td style="min-width: 60px;">'.$moy_pay->pay_code.'</td><td style="text-align: center;"><input type="text" name="desc_'.$moy_pay->pay_code.'" value="'.$moy_pay->pay_designation.'" size="36" /></td><td style="text-align: right;"><input type="text" name="percent_'.$moy_pay->pay_code.'" value="'.$moy_pay->pay_percent_add.'" size="6" /> %</td></tr>';

		}
		echo '</table>';
		echo '<p><input type="submit" name="paiement_moy" value="Valider" /></p>';

	}



}

function fb_relances() {

	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_relance_opt = $prefix."fbs_relances";
	$fb_tablename_mails = $prefix."fbs_mails";
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";
	$fb_tablename_topics = $prefix."fbs_topic";
	$fb_tablename_rapport = $prefix."fbs_mail_report";

	if(isset($_POST['Rel_Cre'])) {
		$pay = $_POST['pay_create'];
		$seuil = $_POST['seuil_create'];
		$delai = $_POST['delai_create'];
		$mail = $_POST['mail_create'];
		$comment = $_POST['comment_create'];
		$create_relance = $wpdb->query("INSERT INTO `$fb_tablename_relance_opt` VALUES ('','$pay','$seuil','$delai','$mail','$comment')");
		if($create_relance) {
			echo '<div id="message" class="updated">La relance a bien été créée.</div>';
		} else {
			echo '<div id="message" class="error">Erreur de modification.</div>';

		}
	} else if(isset($_POST['Rel_Edit'])) {

		$edit_id = $_POST['edit_id'];
		$pay = $_POST['pay_'.$edit_id];
		$seuil = $_POST['seuil_'.$edit_id];
		$delai = $_POST['delai_'.$edit_id];
		$mail = $_POST['mail_'.$edit_id];
		$comment = $_POST['comment_'.$edit_id];

		$edit_relance = $wpdb->update($fb_tablename_relance_opt, array( 'moyen_paiement' => $pay, 'seuil_commande' => $seuil, 'delai_inactivite' => $delai, 'modele_mail' => $mail, 'modele_comment' => $comment), array( 'id' => $edit_id ) );
		if($edit_relance) {
			echo '<div id="message" class="updated">La relance a bien été modifiée.</div>';
		} else {
			echo '<div id="message" class="error">Erreur de modification.</div>';
		}

	} else if(isset($_POST['Rel_Suppr'])) {
		$del_id = $_POST['suppr_id'];
		$del_relance = $wpdb->delete($fb_tablename_relance_opt, array( 'id' => $del_id ) );
		if($del_relance) {
			echo '<div id="message" class="updated">La relance a bien été supprimée.</div>';
		} else {
			echo '<div id="message" class="error">Erreur de suppression.</div>';
		}
	}

	echo '<p>Bienvenue dans l\'administration des relances automatiques France Banderole.</p>';

	$tbl_relances = $wpdb->get_results("SELECT * FROM `$fb_tablename_relance_opt`");
	if($tbl_relances) {
		echo '<p><strong>Editer les relances existantes</strong></p>';
		echo '<table><tr><th>Moyen de paiement</th><th>Seuil de commande minimal</th><th>Délai d\'inactivité</th><th>Modèle e-mail</th><th>Modèle de commentaire</th><th>Enregistrer</th><th>Supprimer</th></tr>';

		foreach ($tbl_relances as $relance) {

			echo '<tr><td><form method="post">';
			echo '<select name="pay_'.$relance->id.'">';
			echo '<option value="0">Tous</option>';
			$list_pay = $wpdb->get_results("SELECT * FROM `$fb_tablename_paiement_moy`");
			foreach ($list_pay as $pay) {
				if($pay->id == $relance->moyen_paiement) {
					echo '<option value="'.$pay->id.'" selected>'.$pay->pay_designation.'</option>';
				} else {
					echo '<option value="'.$pay->id.'">'.$pay->pay_designation.'</option>';
				}
			}

			echo '</select></td><td><input type="text" name="seuil_'.$relance->id.'" value="'.$relance->seuil_commande.'" /> €</td>';
			echo '<td><input type="text" name="delai_'.$relance->id.'" value="'.$relance->delai_inactivite.'"/> jours</td><td>';
			echo '<select name="mail_'.$relance->id.'">';
			echo '<option value="0">Tous</option>';
			$list_mail = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails`");
			foreach ($list_mail as $mail) {
				if($mail->id == $relance->modele_mail) {
					echo '<option value="'.$mail->id.'" selected>'.$mail->topic.'</option>';
				} else {
					echo '<option value="'.$mail->id.'">'.$mail->topic.'</option>';
				}
			}
			echo '</select></td><td>';
			echo '<select name="comment_'.$relance->id.'">';
			echo '<option value="0">Tous</option>';
			$list_comment = $wpdb->get_results("SELECT * FROM `$fb_tablename_topics`");
			foreach ($list_comment as $comment) {
				if($comment->id == $relance->modele_comment) {
					echo '<option value="'.$comment->id.'" selected>'.$comment->topic.'</option>';
				} else {
					echo '<option value="'.$comment->id.'">'.$comment->topic.'</option>';
				}
			}
			echo '</select></td>';
			echo '<td><input type="hidden" name="edit_id" value="'.$relance->id.'" />';
			submit_button('Enregistrer','small','Rel_Edit', FALSE);
			echo '</form></td>';
			echo '<td><form method="post" onsubmit="return confirm(\'Voulez-vous vraiment supprimer cette relance ?\');"><input type="hidden" name="suppr_id" value="'.$relance->id.'" />';
			submit_button('Supprimer','small','Rel_Suppr', FALSE);


			echo '</form></td></tr>';
		}
		echo '</table>';

	}

	echo '<p><strong>Créer une relance</strong></p>';
	echo '<form method="post">';
	echo '<table><tr><th>Moyen de paiement</th><th>Seuil de commande minimal</th><th>Délai d\'inactivité</th><th>Modèle e-mail</th><th></th></tr>';

		echo '<tr><td>';
		echo '<select name="pay_create">';
		echo '<option value="0">Tous</option>';
		$list_pay = $wpdb->get_results("SELECT * FROM `$fb_tablename_paiement_moy`");
			foreach ($list_pay as $pay) {
				echo '<option value="'.$pay->id.'">'.$pay->pay_designation.'</option>';
			}

			echo '</select></td><td><input type="text" name="seuil_create" /> €</td>';
			echo '<td><input type="text" name="delai_create" /> jours</td><td>';
			echo '<select name="mail_create">';
			echo '<option value="0">Tous</option>';
			$list_mail = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails`");
			foreach ($list_mail as $mail) {
				echo '<option value="'.$mail->id.'">'.$mail->topic.'</option>';
			}
			echo '</select></td><td>';
			echo '<select name="comment_create">';
			echo '<option value="0">Tous</option>';
			$list_comment = $wpdb->get_results("SELECT * FROM `$fb_tablename_topics`");
			foreach ($list_comment as $comment) {
				echo '<option value="'.$comment->id.'">'.$comment->topic.'</option>';
			}
			echo '</select></td>';
			echo '<td>';
			submit_button('Créer','small','Rel_Cre', FALSE);
			echo '</td></tr>';

		echo '</table>';
		echo '</form>';

		echo '<p><strong>Résumé des 10 derniers envois</strong></p>';
		$list_rapport = $wpdb->get_results("SELECT R.*, M.topic FROM `$fb_tablename_rapport` R, `$fb_tablename_mails` M WHERE R.id_mail = M.id ORDER BY R.id DESC LIMIT 0,10");
		echo '<table><tr><th>Date d\'envoi</th><th>Id de campagne</th><th>Mail envoyé</th><th>Nb destinataires</th></tr>';
		foreach ($list_rapport as $rapport) {
			echo '<tr><td>'.$rapport->date_envoi.'</td><td>'.$rapport->id_relance.'</td><td>'.$rapport->topic.'</td><td>'.$rapport->nb_dest.'</td></tr>';
		}
		echo '</table>';

}

function fb_mailjet() {

	global $wpdb;
	$prefix = $wpdb->prefix;

	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	if(isset($_POST['mj_sync_bygroup'])) {

		$count_total = 0;
		$count_cat1 = 0;
		$count_cat2 = 0;
		$count_cat3 = 0;
		$count_cat4 = 0;
		$count_cat5 = 0;


		//On récupère l'ensemble des utilisateurs
		$data = $wpdb->get_results("SELECT *, SUM(CAST(REPLACE(totalht,',','') AS DECIMAL(30,2))) AS total FROM `$fb_tablename_order` ".$where." GROUP BY user ORDER BY total DESC LIMIT 0,100");

		//Boucle de parcours des utilisateurs
		foreach($data as $d) {
			$user_id = $d->user;
			$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$user_id."'");
			$user_mail = $user_data->email;

		//Si l'utilisateur n'est pas inscrit sur Mailjet, on crée sa fiche contact et on l'ajoute aux comptes génériques
			$count_total++;
			createContact($user_mail);
			$mj_list = getListId('Tous clients');
			$mj_user = getIdFromEmail($user_mail);
			abonnerListe($mj_user,$mj_list);

		//Ajout à la liste 800-1500
			if(($d->total > 800) AND ($d->total <= 1500)) {
				$count_cat1++;
				$mj_list = getListId('800-1500');
				$mj_user = getIdFromEmail($user_mail);
				abonnerListe($mj_user,$mj_list);
			}
		//Ajout à la liste 1500-2500
			else if(($d->total > 1500) AND ($d->total <= 2500)) {
				$count_cat2++;
				$mj_list = getListId('1500-2500');
				$mj_user = getIdFromEmail($user_mail);
				abonnerListe($mj_user,$mj_list);
			}
		//Ajout à la liste 2500-4000
			else if(($d->total > 2500) AND ($d->total <= 4000)) {
				$count_cat3++;
				$mj_list = getListId('2500-4000');
				$mj_user = getIdFromEmail($user_mail);
				abonnerListe($mj_user,$mj_list);
			}
		//Ajout à la liste 4000-6500
			else if(($d->total > 4000) AND ($d->total <= 6500)) {
				$count_cat4++;
				$mj_list = getListId('4000-6500');
				$mj_user = getIdFromEmail($user_mail);
				abonnerListe($mj_user,$mj_list);
			}
		//Ajout à la liste 6500+
			else if(($d->total > 6500)) {
				$count_cat5++;
				$mj_list = getListId('6500+');
				$mj_user = getIdFromEmail($user_mail);
				abonnerListe($mj_user,$mj_list);
			}
		}


	} else if(isset($_POST['mj_sync_create'])) {
		//On récupère l'ensemble des utilisateurs
		$data = $wpdb->get_results("SELECT *, SUM(CAST(REPLACE(totalht,',','') AS DECIMAL(30,2))) AS total FROM `$fb_tablename_order` ".$where." GROUP BY user ORDER BY total");
		$count_data = $wpdb->num_rows;

		echo '<p>'.$count_data.' clients à traiter.</p>';

		//Boucle de parcours des utilisateurs


		//Si l'utilisateur n'est pas inscrit sur Mailjet, on crée sa fiche contact et on l'ajoute aux comptes génériques


	}

	echo '<p>Cette interface vous permet de synchroniser la base utilisateurs France Banderole avec le compte Mailjet. Attention ! Cette opéation peut s\'avérer gourmande en ressources.</p>';
	echo '<p><form method="post"><input type="submit" name="mj_sync_bygroup" value="Synchroniser" /></form></p>';
	echo '<p><form method="post"><input type="submit" name="mj_sync_create" value="Simulation" /></form></p>';
	echo '<p><form method="post" action="mj-csv.php" target="_blank"><input type="submit" name="mj_sync_csv" value="Export CSV" /> : <select name="csv_group">
		<option value="csv_all">Tous les clients</option>
		<option value="csv_800">800-1500</option>
		<option value="csv_1500">1500-2500</option>
		<option value="csv_2500">2500-4000</option>
		<option value="csv_4000">4000-6500</option>
		<option value="csv_6500">6500+</option>
		</select></form></p>';

	if(isset($_POST['mj_sync_bygroup'])) {
		echo '<p>'.$count_total.' contacts parcourus. <br />';
		echo $count_cat1.' entre 800 et 1500.<br />';
		echo $count_cat2.' entre 1500 et 2500.<br />';
		echo $count_cat3.' entre 2500 et 4000.<br />';
		echo $count_cat4.' entre 4000 et 6500.<br />';
		echo $count_cat5.' à plus de 6500.<br />';

	}
}


function fbadm_invoice_print($number) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_prods = $prefix."fbs_prods";
	$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
 	$idzamowienia = $number;
	$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	$userid = $query->user;

	if ($query) {
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


			$view .= '<div class="print_nag"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2 onlyprint" /></td><td style="font-size:11px;text-align:right;margin-top:35px;"><b><u>CLIENT:</u></b><br />'.$facture_add.'</td></tr><tr><td colspan="2" style="padding:20px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">FACTURE NºF - '.$idzamowienia.'</td></tr><tr><td colspan="2" style="padding:10px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">DATE - '.$query->datamodyfikacji.'</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">Madame, Monsieur,<br />Veuillez trouver ci-dessous votre facture concernant la commande<br />ref: '.$idzamowienia.'<br />Dans l\'attente d\'une collaboration prochaine,<br />Veuillez agrèer, Madame, Monsieur, nos salutations respectueuses.</td></tr></table></div>';

			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table class="cheque_tab2" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
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
//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
		  		$wysokoscrabatu = str_replace('.', ',', number_format($exist_remise->remisenew, 2));
		  		$cremisetd = '<tr><td class="left">REMISE ('.$exist_remise->percent.'%)</td><td>'.$wysokoscrabatu.'</td></tr>';
			}
//koniec//
	  		$tfrais = str_replace('.', ',', $query->frais).'&nbsp;&euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).'&nbsp;&euro;';
	  		$ttva = str_replace('.', ',', $query->tva).'&nbsp;&euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).'&nbsp;&euro;';
			$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$number."-tva'");
			if ($czyjesttva) {
				$procpod = $czyjesttva->remis;
			} else {
				$procpod = '20.0';
			}
	  		$view .= '<table class="cheque_tab3" cellspacing="0">'.$cremisetd.'<tr><td class="left">FRAIS DE PORT</td><td>'.$tfrais.'</td></tr><tr><td class="left">TOTAL HT</td><td>'.$ttotalht.'</td></tr><tr><td class="left">MONTANT TVA ('.$procpod.'%)</td><td>'.$ttva.'</td></tr><tr><td class="lefttotal">TOTAL TTC</td><td class="righttotal">'.$ttotalttc.'</td></tr></table></div>';

		if ($query->payment == 'cheque') { $method = 'CHEQUE'; }
		if ($query->payment == 'bancaire') { $method = 'VIREMENT BANCAIRE'; }
		if ($query->payment == 'carte') { $method = 'CARTE BLEUE'; }
		if ($query->payment == 'administratif') { $method = 'VIREMENT ADMINISTRATIF'; }
		if ($query->payment == 'espece') { $method = 'ESPECE'; }
		if ($query->payment == 'trente') { $method = 'PAIEMENT A 30 JOURS'; }
		if ($query->payment == 'soixante') { $method = 'PAIEMENT A 60 JOURS'; }

		$view .= '<div class="bottomfak onlyprint">FACTURE RÉGLÉE PAR '.$method.'<br /><br /><i>RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3"><a href="javascript:window.print()" id="but_imprimerfacture"></a></div>';
	  		echo $view;
	}

}



function fbadm_invoice_proprint($number) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_prods = $prefix."fbs_prods";
	$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
 	$idzamowienia = $number;
	$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	$userid = $query->user;

	if ($query) {
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


			$view .= '<div class="print_nag"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2 onlyprint" /></td><td style="font-size:11px;text-align:right;margin-top:35px;"><b><u>CLIENT:</u></b><br />'.$facture_add.'</td></tr><tr><td colspan="2" style="padding:20px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">FACTURE PRO FORMA Nº - '.$idzamowienia.'</td></tr><tr><td colspan="2" style="padding:10px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">DATE - '.$query->datamodyfikacji.'</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">Madame, Monsieur,<br />Veuillez trouver ci-dessous votre facture PRO FORMA concernant la commande<br />ref: '.$idzamowienia.'</td></tr></table></div>';

			$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
			$view .= '<table class="cheque_tab2" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
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
//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
		  		$wysokoscrabatu = str_replace('.', ',', number_format($exist_remise->remisenew, 2));
		  		$cremisetd = '<tr><td class="left">REMISE ('.$exist_remise->percent.'%)</td><td>'.$wysokoscrabatu.'</td></tr>';
			}
//koniec//
	  		$tfrais = str_replace('.', ',', $query->frais).'&nbsp;&euro;';
	  		$ttotalht = str_replace('.', ',', $query->totalht).'&nbsp;&euro;';
	  		$ttva = str_replace('.', ',', $query->tva).'&nbsp;&euro;';
	  		$ttotalttc = str_replace('.', ',', $query->totalttc).'&nbsp;&euro;';
			$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$number."-tva'");
			if ($czyjesttva) {
				$procpod = $czyjesttva->remis;
			} else {
				$procpod = '20.0';
			}
	  		$view .= '<table class="cheque_tab3" cellspacing="0">'.$cremisetd.'<tr><td class="left">FRAIS DE PORT</td><td>'.$tfrais.'</td></tr><tr><td class="left">TOTAL HT</td><td>'.$ttotalht.'</td></tr><tr><td class="left">MONTANT TVA ('.$procpod.'%)</td><td>'.$ttva.'</td></tr><tr><td class="lefttotal">TOTAL TTC</td><td class="righttotal">'.$ttotalttc.'</td></tr></table></div>';

		if ($query->payment == 'cheque') { $method = 'CHEQUE'; }
		if ($query->payment == 'bancaire') { $method = 'VIREMENT BANCAIRE'; }
		if ($query->payment == 'carte') { $method = 'CARTE BLEUE'; }
		if ($query->payment == 'administratif') { $method = 'VIREMENT ADMINISTRATIF'; }
		if ($query->payment == 'espece') { $method = 'ESPECE'; }
		if ($query->payment == 'trente') { $method = 'PAIEMENT A 30 JOURS'; }
		if ($query->payment == 'soixante') { $method = 'PAIEMENT A 60 JOURS'; }

		$view .= '<div class="bottomfak onlyprint"><br /><br /><i>RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i></div>';
	  		$view .= '<div id="fbcart_buttons3"><a href="javascript:window.print()" id="but_imprimerfacture"></a></div>';
	  		echo $view;
	}

}


function fbadm_bon_print($number) {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $fb_tablename_order = $prefix . "fbs_order";
    $fb_tablename_remises = $prefix . "fbs_remises";
    $fb_tablename_users = $prefix . "fbs_users";
    $fb_tablename_prods = $prefix . "fbs_prods";
	$fb_tablename_address = $prefix . "fbs_address";
    $images_url = get_bloginfo('url') . '/wp-content/plugins/fbshop/images/';
    $idzamowienia = $number;
    $query = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
    $userid = $query->user;
    if ($query) {
		$user_liv_address = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id='$idzamowienia'");
		$explode2 = explode('|', $user_liv_address->l_address);
        $l_address = $explode2['0'];
        $l_porte = $explode2['1'] . '<br />';

        $us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
        $explode = explode('|', $us->f_address);
        $f_address = $explode['0'];
        $f_porte = $explode['1'] . '<br />';
        $facture_add = $us->f_name . '<br />' . $us->f_comp . '<br />' . $f_address . '<br />' . $f_porte . $us->f_code . '<br />' . $us->f_city . '<br />' . $us->f_phone;

		/* Recherche de relais colis dans les produits de la commande */
		$descriptionproduits = '';
		foreach( $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$number'") as $key => $row) {
			$descriptionproduits = $row->description;
		}
		$existe_relais_colis = strripos($descriptionproduits, "- relais colis");
		if($existe_relais_colis!== false){
			 $address_relais_colis = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id='$number'");
			 $livraison_add = $us->f_name . '<br />' . $address_relais_colis->l_name . '<br />' . $address_relais_colis->l_comp . '<br />' . $address_relais_colis->l_code . '<br />' . $address_relais_colis->l_city . '<br />' . $address_relais_colis->l_phone;
			 $boucle_if = 1;

		/*}elseif (( ($us->l_address != "") && ($f_address != $l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) )) {*/
		}elseif (( ($l_address != "") && ($f_address != $l_address) ) || ( ($user_liv_address->l_name != "") && ($us->f_name != $user_liv_address->l_name) )) {
            $livraison_add = $user_liv_address->l_name . '<br />' . $user_liv_address->l_comp . '<br />' . $l_address . '<br />' . $l_porte . $user_liv_address->l_code . '<br />' . $user_liv_address->l_city . '<br />' . $user_liv_address->l_phone;
			$boucle_if = 2;
        }else{
            $livraison_add = $facture_add;
			$boucle_if = 3;
        }

//			$view .= '<div class="print_nag"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td style="font-size:11px;float:right;text-align:right;margin-top:35px;"><b><u>CLIENT:</u></b><br />'.$facture_add.'</td></tr><tr><td colspan="2" style="padding:20px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">FACTURE NºF - '.$idzamowienia.'</td><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">Madame, Monsieur,<br />Veuillez trouver ci-dessous votre facture concernant la commande<br />ref: '.$idzamowienia.'<br />Dans l\'attente d\'une collaboration prochaine,<br />Veuillez agrèer, Madame, Monsieur, nos salutations respectueuses.</td></tr></table></div>';
//			$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2 onlyprint" /></td><td style="font-size:11px;float:right;text-align:right;margin-top:35px;">&nbsp;</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">Imprimez ce Bon de Commande et envoyez votre Règlement accompagné du Bon de Commande à l\'adresse suivante:<br />France Banderole Sarl<br />94 rue du Gal Leclerc<br />95210 Saint Gratien<br />Pour toutes questions n\'hésitez pas à nous contacter au 0981.610.901<br />BON DE COMMANDE N°BC – '.$idzamowienia.'</td></tr></table></div>';
        $coliR = EstColieRevendeur($number);
		/*$livraison_add .= "boucle_if=". $boucle_if . "coliR=".($coliR?"VRAI":"FAUX")."relais_colis=".$existe_relais_colis. "descriptionproduits=".$descriptionproduits. print_r($us,true). "f_address=".$f_address . "l_address=".$l_address . "query=". "SELECT * FROM `$fb_tablename_users` WHERE id='$userid'";*/
        $hasPD = false;
		$hasBLXLS = false;
        if ($coliR) {


            $BLFile = il_y_a_fichier_bl($number);
            if ($BLFile != false) {
                $hasPD = $BLFile;
                //goto normal;
				//goto colisre;
            }

			$BLXLSFile = il_y_a_fichier_BLXLS($number);
            if ($BLXLSFile != false) {
                $hasBLXLS = $BLXLSFile;
                //goto normal;
				//goto colisre;
            }


			//imprime l'actual en changent le header
			//colisre:
			$view .= '
				<div id="barSPLImg" style="width: 100%; height: 150px; position: relative;"></div>
				<div class="print_nag onlyprint">
					<table class="print_header">
						<tr>
							<td style="float:left;">
								<img src="../wp-content/plugins/fbshop/barcodes_GkA32Bn09fKNxSL/' . basename(renvoiCodeBar($number)) . '" width="300" height="100" alt="code barre" class="logoprint2 onlyprint" /><br/>
								<p style="color: #000;">' . $livraison_add . '</p>
							</td>
							<td style="font-size:11px;float:right;text-align:right;margin-top:35px;">
							&nbsp;
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">BON DE LIVRAISON N° BL – ' . $idzamowienia . '</td>
						</tr>
					</table>
				</div>';

        } else {
            normal:
			//mail("contact@tempopasso.com","GOTO NORMAL // EstColieRevendeur+HasPDF","coliR=".$coliR."BLFile=".$BLFile." // number=".$number." ///// ".print_r("",true));
            $view .= '<div class="print_nag onlyprint">
                        <table class="print_header">
                            <tr>
                                <td style="float:left;">
                                    <img src="' . $images_url . 'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2 onlyprint" />
                                </td>
                                <td style="font-size:11px;float:right;text-align:right;margin-top:35px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">BON DE LIVRAISON N° BL – ' . $idzamowienia . '</td>
                            </tr>
                        </table>
                    </div>';

            $view .= '
                <div class="cheque">
                    <table class="cheque_tab" cellspacing="5px">
                        <tr>
                            <th style="width:30%">ADRESSE DE LIVRAISON:</th>
                            <th style="border:none"></th>
                        </tr>
                        <tr>
                            <td>' . $livraison_add . '</td>
                            <td></td>
                        </tr>
                    </table>';
        }

        $products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
        $view .= '<table class="cheque_tab2" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th></tr>';
        foreach ($products as $products => $item) {
            $view .= '<tr><td class="lefttd"><span class="name">' . $item[name] . '</span><br /><span class="therest">' . $item[description] . '</span></td><td>' . $item[quantity] . '</td></tr>';
        }
        $view .= '</table>';
        if ($query->payment == 'cheque') {
            $method = 'CHEQUE';
        }
        if ($query->payment == 'bancaire') {
            $method = 'VIREMENT BANCAIRE';
        }
        if ($query->payment == 'carte') {
            $method = 'CARTE BLEUE';
        }
        if ($query->payment == 'administratif') {
            $method = 'VIREMENT ADMINISTRATIF';
        }
        if ($query->payment == 'espece') {
            $method = 'ESPECE';
        }
		if ($query->payment == 'trente') {
            $method = 'PAIEMENT A 30 JOURS';
        }
		if ($query->payment == 'soixante') {
            $method = 'PAIEMENT A 60 JOURS';
        }
		/* Si colis revendeur, on affiche par le RCS */
		if (!$coliR) {
        	$view .= '<div class="bottomfak onlyprint">PAIEMENT PAR ' . $method . '<br /><br /><i>RCS PONTOISE: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i><br /><b><font color="red">CETTE COMMANDE A ÉTÉ CONTROLÉE PAR : OUI - NON</b>  - SIGNATURE : </font></div>';
		}

		 $view .= '<div id="fbcart_buttons3"><p><a href="#" id="but_imprimerbon">Imprimer le bon de commande</a><br /></p></div>';

		  if ($hasPD != false) {
			$view .= '<div id="fbcart_buttons3"><p><a href="#" id="but_imprimerbon_client"><button>Imprimer le bon de livraison CLIENT (BL.PDF)</button></a><br /></p></div>';
		  }

		  if ($hasBLXLS != false) {
			$view .= '<div id="fbcart_buttons3"><p><a href="#" id="but_imprimerbon_clientxls"><button>Imprimer le BL.XLS</button></a><br /></p></div>';
		  }

        echo $view;
        if (!$coliR) {
			//echo "Dans IF 1 //";
            echo "<img id='barImg1' src='../wp-content/plugins/fbshop/barcodes_GkA32Bn09fKNxSL/" . basename(renvoiCodeBar($number)) . "' alt='' style='display: block; position: absolute; width: 300px; height: 100px; top: 0; right: 0;' />";
            echo "<img id='barImg2' src='../wp-content/plugins/fbshop/barcodes_GkA32Bn09fKNxSL/" . basename(renvoiCodeBar($number)) . "' alt='' style='visibility:hidden;display: block; position: absolute; width: 300px; height: 100px; top: 0px; right: 0px;' media='screen' />";
        } else {
			//echo "Dans ELSE 1 //";
            echo "<img id='barImg2' src='../wp-content/plugins/fbshop/barcodes_GkA32Bn09fKNxSL/" . basename(renvoiCodeBar($number)) . "' alt='' style='display: block; position: absolute; width: 300px; height: 100px; top: 0px; right: 0px;' media='screen' />";
        }
        if ($hasPD != false) {
			//echo "Dans IF 2 //";
           /* echo '
                    <script>
                        jQuery("#but_imprimerbon_client").click(function() {
                            window.open("/uploaded/' . $number . '/' . basename($hasPD) . '");
                            window.print();
                            return false;
                        });

                        jQuery("#but_imprimerbon").click(function() {
                            document.getElementById("barImg2").style.visibility = "hidden";
                            jQuery("#barSPLImg").hide();
                            window.print();
                            document.getElementById("barImg2").style.visibility = "visible";
                            jQuery("#barSPLImg").show();
                            return false;
                        });
                    </script>

                ';*/
            echo '
                    <script>
                        jQuery("#but_imprimerbon_client").click(function() {
                            window.open("/wp-content/plugins/fbshop/fb_print_BL_PDF.php?name=BL_' . $number . '&file=http://"+document.location.host+"/uploaded/' . $number . '/' . basename($hasPD) . '");
                            return false;
                        });

                        jQuery("#but_imprimerbon").click(function() {
                            document.getElementById("barImg2").style.visibility = "hidden";
                            jQuery("#barSPLImg").hide();
                            window.print();
                            document.getElementById("barImg2").style.visibility = "visible";
                            jQuery("#barSPLImg").show();
                            return false;
                        });
                    </script>

                ';
        } else {
			//echo "Dans ELSE 2 //";
            echo '
                    <script>
                        jQuery("#but_imprimerbon").click(function() {
                            document.getElementById("barImg2").style.visibility = "hidden";
                            jQuery("#barSPLImg").hide();
                            window.print();
                            document.getElementById("barImg2").style.visibility = "visible";
                            jQuery("#barSPLImg").show();
                            return false;
                        });
                    </script>
                ';
        }

		if ($hasBLXLS != false) {

            echo '
                    <script>
                        jQuery("#but_imprimerbon_clientxls").click(function() {
                            window.open("/wp-content/plugins/fbshop/fb_print_BL_XLS.php?name=BL_' . $number . '&number=' . $number . '&barcode=barcodes_GkA32Bn09fKNxSL/' . basename(renvoiCodeBar($number)) . '");
                            return false;
                        });

                        jQuery("#but_imprimerbon").click(function() {
                            document.getElementById("barImg2").style.visibility = "hidden";
                            jQuery("#barSPLImg").hide();
                            window.print();
                            document.getElementById("barImg2").style.visibility = "visible";
                            jQuery("#barSPLImg").show();
                            return false;
                        });
                    </script>

                ';
        } else {
			//echo "Dans ELSE 2 //";
            echo '
                    <script>
                        jQuery("#but_imprimerbon").click(function() {
                            document.getElementById("barImg2").style.visibility = "hidden";
                            jQuery("#barSPLImg").hide();
                            window.print();
                            document.getElementById("barImg2").style.visibility = "visible";
                            jQuery("#barSPLImg").show();
                            return false;
                        });
                    </script>
                ';
        }




    }
}

function fb_admin_reports_users() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$acutalyear = date(Y);
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';
	$ptype=$_POST['type'];
	$ptime=$_POST['time'];

	$users_ids = $wpdb->get_col("SELECT DISTINCT user FROM `$fb_tablename_order` ORDER BY id ASC");
	$users_ids = implode(',', $users_ids);

	echo '<p><form name="reportusers" id="report"  class="noprint" action="" method="post">';
	echo 'Chercher selon nom, prénom, e-mail, société, login : <input type="text" name="generic_search" /><br />';
	echo 'Chercher selon numéro de commande : <input type="text" name="search_by_order" /><br />';

	echo '
	<select name="user_name">
	<option value="">Select name</option>';
	$users_name = $wpdb->get_results("SELECT id, f_name FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY f_name ASC");
	$l = 0;
	foreach ($users_name as $un) :
		if ($un->f_name == '') continue;
		echo '<option value="'.$un->id.'">'.$un->f_name.'</option>';
	endforeach;
	echo '</select> OR <select name="user_login">
	<option value="">Select login</option>';
	$users_login = $wpdb->get_results("SELECT id, login FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY login ASC");
	foreach ($users_login as $ul) :
		if ($ul->login == '') continue;
		echo '<option value="'.$ul->id.'">'.$ul->login.'</option>';
	endforeach;
	echo '</select> OR <select name="user_company">
	<option value="">Select company</option>';
	$users_login = $wpdb->get_results("SELECT id, f_comp FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY f_comp ASC");
	foreach ($users_login as $ul) :
		if ($ul->f_comp == '') continue;
		echo '<option value="'.$ul->id.'">'.$ul->f_comp.'</option>';
	endforeach;
	echo '</select> OR <select name="user_mail">
	<option value="">Select email</option>';
	$users_login = $wpdb->get_results("SELECT id, email FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY email ASC");
	foreach ($users_login as $ul) :
		if ($ul->email == '') continue;
		echo '<option value="'.$ul->id.'">'.$ul->email.'</option>';
	endforeach;
	echo '</select> OR <select name="users_sales">
	<option value="">Select by sales</option>';
		echo '<option value="10">1 - 99</option>';
		echo '<option value="100">100 - 499</option>';
		echo '<option value="500">500 - 799</option>';
		echo '<option value="800">800 - 1500</option>';
		echo '<option value="1500">1500 - 2500</option>';
		echo '<option value="2500">2500 - 4000</option>';
		echo '<option value="4000">4000 - 6500</option>';
		echo '<option value="6500">6500 - more</option>';
	echo '</select>';
	echo '<br /><input type="hidden" name="pokaztab" /><input type="submit" style="margin-top:10px;" value="Filter" /></form></p>';
$licznik = 0;
$liczmak = 0;
$liczbezmak = 0;
 if (isset($_POST['pokaztab']) && ($_POST['users_sales'] == '')) {

	if($_POST['generic_search'] != "") {
		fb_getUsersBySearch($_POST['generic_search']);
	} else if($_POST['search_by_order'] != "") {
		fb_getUsersBySearchOrder($_POST['search_by_order']);
	} else {
	if (isset($_POST['user_name']) && $_POST['user_name']!='') {
		$where = $_POST['user_name'];
	}
	if (isset($_POST['user_login']) && $_POST['user_login']!='') {
		$where = $_POST['user_login'];
	}
	if (isset($_POST['user_company']) && $_POST['user_company']!='') {
		$where = $_POST['user_company'];
	}
	if (isset($_POST['user_mail']) && $_POST['user_mail']!='') {
		$where = $_POST['user_mail'];
	}
	$sumfrais = 0;
	$sumtotalht = 0;
	$sumtva = 0;
	$sumtotalttc = 0;

 	if (!empty($_POST['client_saveremise']) && $_POST['client_saveremise'] == 'true'){
		$client_type = $_POST['client_type'];
		$exist_type = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_type' AND uid = ".$where."");
		if ($exist_type) {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$client_type' WHERE  att_name = 'client_type' AND uid = ".$where."");
		} else {
			$add_col = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'client_type', '$client_type')");
		}
		$client_remise = $_POST['client_remise'];
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = ".$where."");
		if ($exist_remise) {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$client_remise' WHERE  att_name = 'client_remise' AND uid = ".$where."");
		} else {
			$add_col = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'client_remise', '$client_remise')");
		}
		$client_color = $_POST['client_color'];
		$exist_color = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = ".$where."");
		if ($exist_color) {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$client_color' WHERE  att_name = 'client_color' AND uid = ".$where."");
		} else {
			$add_col = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'client_color', '$client_color')");
		}
 	}

	$userinfo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = ".$where."");
	if ($userinfo) {
		$explode = explode('|', $userinfo->f_address);
		$f_address = $explode['0'];
		$f_porte = $explode['1'];
		$explode2 = explode('|', $userinfo->l_address);
		$l_address = $explode2['0'];
		$l_porte = $explode2['1'];
		$exist_type = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_type' AND uid = ".$where."");
            $t1 = '';
            $t2 = '';
            $t3 = '';
            $t4 = '';
		if (!empty($exist_type->att_value)) {
			if ($exist_type->att_value == '')
				$t1 = ' selected="selected"';
			if ($exist_type->att_value == 'compte revendeur')
				$t2 = ' selected="selected"';
			if ($exist_type->att_value == 'client externe')
				$t3 = ' selected="selected"';
			if ($exist_type->att_value == 'grand compte')
				$t4 = ' selected="selected"';
		}
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = ".$where."");
		$r1 = '';
		if (!empty($exist_remise->att_value)) {
			$r1 = $exist_remise->att_value;
		}
		$exist_color = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = ".$where."");
		$c1 = ''; $c2 = ''; $c3 = ''; $c4 = ''; $c5 = ''; $c6 = ''; $c7 = ''; $c8 = ''; $c9 = ''; $c10 = '';
		if (!empty($exist_color->att_value)) {
			if ($exist_color->att_value == 'd3ffde') $c1 = ' checked="checked"';
			if ($exist_color->att_value == 'fbcfd0') $c2 = ' checked="checked"';
			if ($exist_color->att_value == 'd3ccff') $c3 = ' checked="checked"';
			if ($exist_color->att_value == 'eeffbb') $c4 = ' checked="checked"';
			if ($exist_color->att_value == 'ffe7bb') $c5 = ' checked="checked"';
			if ($exist_color->att_value == 'fbcff0') $c6 = ' checked="checked"';
			if ($exist_color->att_value == 'c9f8fe') $c7 = ' checked="checked"';
			if ($exist_color->att_value == 'b9dbfe') $c8 = ' checked="checked"';
			if ($exist_color->att_value == 'd1ffb4') $c9 = ' checked="checked"';
			if ($exist_color->att_value == 'e1ceb0') $c10 = ' checked="checked"';
			if ($exist_color->att_value == '929395') $c11 = ' checked="checked"';
		}
		echo '<div style="float:left;display:inline;width:30%;padding:5px;height:150px;border:1px solid #ccc;margin:10px 0 10px 0;font-size:11px;line-height:14px;"><b>Adresse de facturation:</b><br /><form name="fb_view_user" method="post" action="admin.php?page=fb-users"><input type="hidden" name="action" value="fb_view_user" /><input type="hidden" name="fb_view_user_id" value="'.$userinfo->id.'" /><input type="submit" name="fb_user_view" class="edit" value="'.$userinfo->login.'"></form>'.$userinfo->email.'<br />'.$userinfo->f_name.'<br />'.$userinfo->f_comp.'<br />'.$f_address.'<br />'.$f_porte.'<br />'.$userinfo->f_code.'<br />'.$userinfo->f_city.'<br />'.$userinfo->f_phone.'</div>';
		echo '<div style="float:left;display:inline;padding:5px;width:30%;height:150px;border:1px solid #ccc;margin:10px 0 10px 10px;font-size:11px;line-height:14px;"><b>Adresse de livraison:</b><br />'.$userinfo->l_name.'<br />'.$userinfo->l_comp.'<br />'.$l_address.'<br />'.$l_porte.'<br />'.$userinfo->l_code.'<br />'.$userinfo->l_city.'<br />'.$userinfo->l_phone.'</div>';
		echo '<div style="float:left;display:inline;padding:5px;width:30%;height:150px;border:1px solid #ccc;margin:10px 0 10px 10px;font-size:11px;line-height:14px;">
		<form name="client_remise_options" id="client_remise_options" method="post" action="" />
		<b>type client:</b> <select name="client_type" style="margin:0 15px 0 0;">
		<option value=""'.$t1.'>select</option>
		<option value="compte revendeur"'.$t2.'>compte revendeur</option>
		<option value="client externe"'.$t3.'>client externe</option>
		<option value="grand compte"'.$t4.'>grand compte</option>
		</select><b>remise:</b> <input type="text" name="client_remise" value="'.$r1.'" size="4" /> %<br /><br />
		<b>code couleur:</b><br /><br />
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="d3ffde"'.$c1.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#d3ffde;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="fbcfd0"'.$c2.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#fbcfd0;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="d3ccff"'.$c3.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#d3ccff;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="eeffbb"'.$c4.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#eeffbb;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="ffe7bb"'.$c5.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#ffe7bb;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="fbcff0"'.$c6.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#fbcff0;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="c9f8fe"'.$c7.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#c9f8fe;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="b9dbfe"'.$c8.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#b9dbfe;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="d1ffb4"'.$c9.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#d1ffb4;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="e1ceb0"'.$c10.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#e1ceb0;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="929395"'.$c11.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#929395;"></span></div>
		<br /><br /><br /><br /><input type="submit" value="save changes" /><input type="hidden" name="client_saveremise" value="true" /><input type="hidden" name="pokaztab" value="" /><input type="hidden" name="user_name" value="'.$_POST["user_name"].'" /><input type="hidden" name="user_login" value="'.$_POST["user_login"].'" />
		</form>
		</div>';
	}

	// $limit_high = 0;
	// $limit_low = 100;
	// $req_count = get_row("SELECT COUNT (*) AS nb_res FROM `$fb_tablename_order` WHERE user = ".$where." DESC LIMIT 0, ".$limit);
	// $order_count = $req_count->nb_res;
	$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE user = ".$where." ORDER BY date DESC");
	if ($orders) {
		//Modif START

		//echo '<p>Rechercher : <input type="text" id="txt_search" name="search"></p>';

		echo '<p></p>';

		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th></th>
		<th>N° DE COMMANDE</th>
		<th>DESCRIPTION</th>
		<th>DATE</th>
		<th>CLIENT</th>
		<th>FRAIS</th>
		<th>TOTAL HT</th>
		<th>TVA</th>
		<th>TOTAL TTC</th>
		<th>ETAT</th>
		<th>PRINT</th>
		</tr>
		</thead>
		<tbody>';

		//echo '<table class="widefat"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th>ETAT</th><th class="noprint">PRINT</th></tr>';
		foreach ($orders as $o) :
			$licznik++;
			echo '<tr><td>'.$licznik.'</td><td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="'.$o->unique_id.'"></form></td><td>';
			$status = print_status($o->status);
			$prods = $wpdb->get_results("SELECT name, description, quantity, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' AND status=1 ORDER BY name ASC");
			foreach ($prods as $p) :
				echo $p->name.' ('.$p->quantity.')<br />';
				$wzorzec = '/ai déjà crée la maquette/';
				$wzorzec2 = '/France banderole crée la maquette/';
				$czymak = preg_match_all($wzorzec, $p->description, $wynik);
				$czymak2 = preg_match_all($wzorzec2, $p->description, $wynik2);
				$ktomak = count($wynik[0]);
				$ktomak2 = count($wynik2[0]);
				if ($ktomak >= 1) {
					$liczbezmak++;
				}
				if ($ktomak2 >= 1) {
					$liczmak++;
				}
			endforeach;
			$client = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$o->user'");

			$stylstatusu = '';
			if ($o->status == 0) $stylstatusu = ' style="background:#82ff7f;"';
			if ($o->status == 1) $stylstatusu = ' style="background:#feca7f;"';
			if ($o->status == 2) $stylstatusu = ' style="background:#f3a0ee;"';
			if ($o->status == 3) $stylstatusu = ' style="background:#7edfff;"';
			if ($o->status == 4) $stylstatusu = ' style="background:#f6ff7e;"';
			if ($o->status == 5) $stylstatusu = ' style="background:#819ac3;"';
			if ($o->status == 6) $stylstatusu = ' style="background:#c4c4c4;"';
			if ($o->status == 7) $stylstatusu = ' style="background:#fbcfd0;"';


			echo '</td><td>'.$o->datamodyfikacji.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td'.$stylstatusu.'>'.print_status($o->status).'</td><td class="noprint"><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
			$sumfrais = $sumfrais+str_replace(',', '', $o->frais);
			$sumtotalht = $sumtotalht+str_replace(',', '', $o->totalht);
			$sumtva = $sumtva+str_replace(',', '', $o->tva);
			$sumtotalttc = $sumtotalttc+str_replace(',', '', $o->totalttc);
		endforeach;
		echo '<tr><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">TOTAL</td><td style="vertical-align:middle;font-weight:bold;">'.$sumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalttc.' &euro;</td></tr>';
		echo '</tbody></table>';
		echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';
		//END MODIF
		echo "<p>France banderole crée la maquette: <b>".$liczmak."</b><br />j’ai déjà crée la maquette: <b>".$liczbezmak."</b></p>";
	}
	}
 }
 if ($_POST['users_sales'] != '') {
 	fb_getUsersBySales($_POST['users_sales']);
 }
}

function fb_admin_adresse_mail01() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$acutalyear = date(Y);
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';
	$ptype=$_POST['type'];
	$ptime=$_POST['time'];
	$users_ids = $wpdb->get_col("SELECT DISTINCT user FROM `$fb_tablename_order` ORDER BY id ASC");
	$users_ids = implode(',', $users_ids);

	echo '<p><form name="reportusers" id="report"  class="noprint" action="" method="post">
	<select name="users_sales">
	<option value="">Select by sales</option>';
		echo '<option value="10">1 - 99</option>';
		echo '<option value="100">100 - 499</option>';
		echo '<option value="500">500 - 799</option>';
		echo '<option value="800">800 - 1500</option>';
		echo '<option value="1500">1500 - 2500</option>';
		echo '<option value="2500">2500 - 4000</option>';
		echo '<option value="4000">4000 - 6500</option>';
		echo '<option value="6500">6500 - more</option>';
	echo '</select>';
	echo '<br /><input type="hidden" name="pokaztab" /><input type="submit" style="margin-top:10px;" value="Filter" /></form></p>';
$licznik = 0;
$liczmak = 0;
$liczbezmak = 0;
 if (isset($_POST['pokaztab']) && ($_POST['users_sales'] == '')) {
	if (isset($_POST['user_name']) && $_POST['user_name']!='') {
		$where = $_POST['user_name'];
	}
	if (isset($_POST['user_login']) && $_POST['user_login']!='') {
		$where = $_POST['user_login'];
	}
	if (isset($_POST['user_company']) && $_POST['user_company']!='') {
		$where = $_POST['user_company'];
	}
	if (isset($_POST['user_mail']) && $_POST['user_mail']!='') {
		$where = $_POST['user_mail'];
	}
	$sumfrais = 0;
	$sumtotalht = 0;
	$sumtva = 0;
	$sumtotalttc = 0;

 	if (!empty($_POST['client_saveremise']) && $_POST['client_saveremise'] == 'true'){
		$client_type = $_POST['client_type'];
		$exist_type = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_type' AND uid = ".$where."");
		if ($exist_type) {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$client_type' WHERE  att_name = 'client_type' AND uid = ".$where."");
		} else {
			$add_col = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'client_type', '$client_type')");
		}
		$client_remise = $_POST['client_remise'];
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = ".$where."");
		if ($exist_remise) {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$client_remise' WHERE  att_name = 'client_remise' AND uid = ".$where."");
		} else {
			$add_col = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'client_remise', '$client_remise')");
		}
		$client_color = $_POST['client_color'];
		$exist_color = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = ".$where."");
		if ($exist_color) {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$client_color' WHERE  att_name = 'client_color' AND uid = ".$where."");
		} else {
			$add_col = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'client_color', '$client_color')");
		}
 	}


	$userinfo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = ".$where."");
	if ($userinfo) {
		$explode = explode('|', $userinfo->f_address);
		$f_address = $explode['0'];
		$f_porte = $explode['1'];
		$explode2 = explode('|', $userinfo->l_address);
		$l_address = $explode2['0'];
		$l_porte = $explode2['1'];
		$exist_type = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_type' AND uid = ".$where."");
		$t1 = ''; $t2 = ''; $t3 = ''; $t4 = '';
		if (!empty($exist_type->att_value)) {
			if ($exist_type->att_value == '') $t1 = ' selected="selected"';
			if ($exist_type->att_value == 'compte revendeur') $t2 = ' selected="selected"';
			if ($exist_type->att_value == 'client externe') $t3 = ' selected="selected"';
			if ($exist_type->att_value == 'grand compte') $t4 = ' selected="selected"';
		}
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = ".$where."");
		$r1 = '';
		if (!empty($exist_remise->att_value)) {
			$r1 = $exist_remise->att_value;
		}
		$exist_color = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = ".$where."");
		$c1 = ''; $c2 = ''; $c3 = ''; $c4 = ''; $c5 = ''; $c6 = ''; $c7 = ''; $c8 = ''; $c9 = ''; $c10 = '';
		if (!empty($exist_color->att_value)) {
			if ($exist_color->att_value == 'd3ffde') $c1 = ' checked="checked"';
			if ($exist_color->att_value == 'fbcfd0') $c2 = ' checked="checked"';
			if ($exist_color->att_value == 'd3ccff') $c3 = ' checked="checked"';
			if ($exist_color->att_value == 'eeffbb') $c4 = ' checked="checked"';
			if ($exist_color->att_value == 'ffe7bb') $c5 = ' checked="checked"';
			if ($exist_color->att_value == 'fbcff0') $c6 = ' checked="checked"';
			if ($exist_color->att_value == 'c9f8fe') $c7 = ' checked="checked"';
			if ($exist_color->att_value == 'b9dbfe') $c8 = ' checked="checked"';
			if ($exist_color->att_value == 'd1ffb4') $c9 = ' checked="checked"';
			if ($exist_color->att_value == 'e1ceb0') $c10 = ' checked="checked"';
			if ($exist_color->att_value == '929395') $c11 = ' checked="checked"';
		}
		echo '<div style="float:left;display:inline;width:30%;padding:5px;height:150px;border:1px solid #ccc;margin:10px 0 10px 0;font-size:11px;line-height:14px;"><b>Adresse de facturation:</b><br /><form name="fb_view_user" method="post" action="admin.php?page=fb-users"><input type="hidden" name="action" value="fb_view_user" /><input type="hidden" name="fb_view_user_id" value="'.$userinfo->id.'" /><input type="submit" name="fb_user_view" class="edit" value="'.$userinfo->login.'"></form>'.$userinfo->email.'<br />'.$userinfo->f_name.'<br />'.$userinfo->f_comp.'<br />'.$f_address.'<br />'.$f_porte.'<br />'.$userinfo->f_code.'<br />'.$userinfo->f_city.'<br />'.$userinfo->f_phone.'</div>';
		echo '<div style="float:left;display:inline;padding:5px;width:30%;height:150px;border:1px solid #ccc;margin:10px 0 10px 10px;font-size:11px;line-height:14px;"><b>Adresse de livraison:</b><br />'.$userinfo->l_name.'<br />'.$userinfo->l_comp.'<br />'.$l_address.'<br />'.$l_porte.'<br />'.$userinfo->l_code.'<br />'.$userinfo->l_city.'<br />'.$userinfo->l_phone.'</div>';
		echo '<div style="float:left;display:inline;padding:5px;width:30%;height:150px;border:1px solid #ccc;margin:10px 0 10px 10px;font-size:11px;line-height:14px;">
		<form name="client_remise_options" id="client_remise_options" method="post" action="" />
		<b>type client:</b> <select name="client_type" style="margin:0 15px 0 0;">
		<option value=""'.$t1.'>select</option>
		<option value="compte revendeur"'.$t2.'>compte revendeur</option>
		<option value="client externe"'.$t3.'>client externe</option>
		<option value="grand compte"'.$t4.'>grand compte</option>
		</select><b>remise:</b> <input type="text" name="client_remise" value="'.$r1.'" size="4" /> %<br /><br />
		<b>code couleur:</b><br /><br />
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="d3ffde"'.$c1.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#d3ffde;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="fbcfd0"'.$c2.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#fbcfd0;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="d3ccff"'.$c3.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#d3ccff;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="eeffbb"'.$c4.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#eeffbb;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="ffe7bb"'.$c5.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#ffe7bb;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="fbcff0"'.$c6.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#fbcff0;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="c9f8fe"'.$c7.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#c9f8fe;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="b9dbfe"'.$c8.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#b9dbfe;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="d1ffb4"'.$c9.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#d1ffb4;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="e1ceb0"'.$c10.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#e1ceb0;"></span></div>
		<div style="float:left;display:block;width:30px;height:20px;line-height:20px;"><input type="radio" name="client_color" value="929395"'.$c11.' /> <span style="display:block;width:20px;height:20px;margin:5px 0 0 0;background:#929395;"></span></div>
		<br /><br /><br /><br /><input type="submit" value="save changes" /><input type="hidden" name="client_saveremise" value="true" /><input type="hidden" name="pokaztab" value="" /><input type="hidden" name="user_name" value="'.$_POST["user_name"].'" /><input type="hidden" name="user_login" value="'.$_POST["user_login"].'" />
		</form>
		</div>';
	}

	$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE user = ".$where." ORDER BY date DESC");
	if ($orders) {
		//echo '<table class="widefat"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th>ETAT</th><th class="noprint">PRINT</th></tr>';
		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th></th>
		<th>N° DE COMMANDE</th>
		<th>DESCRIPTION</th>
		<th>DATE</th>
		<th>CLIENT</th>
		<th>FRAIS</th>
		<th>TOTAL HT</th>
		<th>TVA</th>
		<th>TOTAL TTC</th>
		<th>ETAT</th>
		<th>PRINT</th>
		</tr>
		</thead>
		<tbody>';

		foreach ($orders as $o) :
			$licznik++;
			echo '<tr><td>'.$licznik.'</td><td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="'.$o->unique_id.'"></form></td><td>';
			$status = print_status($o->status);
			$prods = $wpdb->get_results("SELECT name, description, quantity, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' AND status=1 ORDER BY name ASC");
			foreach ($prods as $p) :
				echo $p->name.' ('.$p->quantity.')<br />';
				$wzorzec = '/ai déjà crée la maquette/';
				$wzorzec2 = '/France banderole crée la maquette/';
				$czymak = preg_match_all($wzorzec, $p->description, $wynik);
				$czymak2 = preg_match_all($wzorzec2, $p->description, $wynik2);
				$ktomak = count($wynik[0]);
				$ktomak2 = count($wynik2[0]);
				if ($ktomak >= 1) {
					$liczbezmak++;
				}
				if ($ktomak2 >= 1) {
					$liczmak++;
				}
			endforeach;
			$client = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$o->user'");

			$stylstatusu = '';
			if ($o->status == 0) $stylstatusu = ' style="background:#82ff7f;"';
			if ($o->status == 1) $stylstatusu = ' style="background:#feca7f;"';
			if ($o->status == 2) $stylstatusu = ' style="background:#f3a0ee;"';
			if ($o->status == 3) $stylstatusu = ' style="background:#7edfff;"';
			if ($o->status == 4) $stylstatusu = ' style="background:#f6ff7e;"';
			if ($o->status == 5) $stylstatusu = ' style="background:#819ac3;"';
			if ($o->status == 6) $stylstatusu = ' style="background:#c4c4c4;"';
			if ($o->status == 7) $stylstatusu = ' style="background:#fbcfd0;"';


			echo '</td><td>'.$o->datamodyfikacji.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td'.$stylstatusu.'>'.print_status($o->status).'</td><td class="noprint"><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
			$sumfrais = $sumfrais+str_replace(',', '', $o->frais);
			$sumtotalht = $sumtotalht+str_replace(',', '', $o->totalht);
			$sumtva = $sumtva+str_replace(',', '', $o->tva);
			$sumtotalttc = $sumtotalttc+str_replace(',', '', $o->totalttc);
		endforeach;
		echo '<tr><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">TOTAL</td><td style="vertical-align:middle;font-weight:bold;">'.$sumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalttc.' &euro;</td></tr>';
		echo '</tbody></table>';
		echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';
		echo "<p>France banderole crée la maquette: <b>".$liczmak."</b><br />j’ai déjà crée la maquette: <b>".$liczbezmak."</b></p>";
	}

 }
 if ($_POST['users_sales'] != '') {
 	fb_getUsersBySales2($_POST['users_sales']);
 }
}


function fb_getUsersBySales2($sum) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	if ($sum == '10') { $va = '10'; $vb = '99.99'; }
	if ($sum == '100') { $va = '100'; $vb = '499.99'; }
	if ($sum == '500') { $va = '500'; $vb = '799.99'; }
	if ($sum == '800') { $va = '800'; $vb = '1499.99'; }
	if ($sum == '1500') { $va = '1500'; $vb = '2499.99'; }
	if ($sum == '2500') { $va = '2500'; $vb = '3999.99'; }
	if ($sum == '4000') { $va = '4000'; $vb = '6499.99'; }
	if ($sum == '6500') { $va = '6500'; }

	$data = $wpdb->get_results("SELECT *, SUM(CAST(REPLACE(totalht,',','') AS DECIMAL(30,2))) AS total FROM `$fb_tablename_order` ".$where." GROUP BY user ORDER BY total DESC");
	// echo '<table class="widefat">';
	// echo '<thead><tr><th width="5">Lp.</th><th width="5">ID</th><th>Login</th><th>adresse</th><th>F. name</th><th>F. Company</th><th>F. Phone</th><th>Orders sum</th><th>Action</th></tr></thead>';

	echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th>Lp.</th>
		<th>ID</th>
		<th>Login</th>
		<th>adresse</th>
		<th>F. name</th>
		<th>F. Company</th>
		<th>F. Phone</th>
		<th>Orders sum</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>';


	$licznik = 0;
	foreach ($data as $d) :
		if (!empty($vb)) {
			if ($d->total > $va && $d->total <= $vb) {
				$licznik++;
				$userinfo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = ".$d->user."");
				$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$d->user'");
				$style = '';
				if (!empty($exist_color)) {
					$style = ' style="background:#'.$exist_color.'"';
				}
				echo '<tr><td><span '.$style.'>'.$licznik.'</td><td><span '.$style.'>'.$d->user.'</span></td><td><span '.$style.'>'.$userinfo->login.'</span></td><td><span '.$style.'>'.$userinfo->f_adress.'</span></td><td><span '.$style.'>'.$userinfo->f_name.'</span></td><td><span '.$style.'>'.$userinfo->f_comp.'</span></td><td><span '.$style.'>'.$userinfo->f_phone.'</span></td><td><span '.$style.'>'.$d->total.' &euro;</span></td><td><form name="us_'.$d->user.'" action="" method="post"><input type="hidden" name="user_name" value="'.$d->user.'" /><input type="hidden" name="pokaztab" value="true" /><input type="submit" value="View details" class="edit" /></form></td></tr>';
			}
		} else {
			if ($d->total > $va) {
				$licznik++;
				$userinfo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = ".$d->user."");
				$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$d->user'");
				$style = '';
				if (!empty($exist_color)) {
					$style = ' style="background:#'.$exist_color.'"';
				}

			echo '<table>
			<tr><td colspan="2" style="font-weight:bold;padding-top:20px;">ADRESSE DE FACTURATION:</td></tr>
			<tr><td>prénom et nom:</td><td>'.$user->f_name.'</td></tr>
			<tr><td>société:</td><td>'.$user->f_comp.'</td></tr>
			<tr><td>adresse:</td><td>'.$f_address.'</td></tr>
			<tr><td>code porte/esc./etc:</td><td>'.$f_porte.'</td></tr>
			<tr><td>code postal:</td><td>'.$user->f_code.'</td></tr>
			<tr><td>ville:</td><td>'.$user->f_city.'</td></tr>
			<tr><td>phone:</td><td>'.$user->f_phone.'</td></tr>
			<tr><td colspan="2" style="font-weight:bold;padding-top:20px;">ADRESSE DE LIVRAISON:</td></tr>
			<tr><td>prénom et nom:</td><td>'.$user->l_name.'</td></tr>
			<tr><td>société:</td><td>'.$user->l_comp.'</td></tr>
			<tr><td>adresse:</td><td>'.$l_address.'</td></tr>
			<tr><td>code porte/esc./etc:</td><td>'.$l_porte.'</td></tr>
			<tr><td>code postal:</td><td>'.$user->l_code.'</td></tr>
			<tr><td>ville:</td><td>'.$user->l_city.'</td></tr>
			<tr><td>phone:</td><td>'.$user->l_phone.'</td></tr>
			</table>';


			}
		}
	endforeach;
	echo '</tbody></table>';
	echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';

}









function fb_getUsersBySales($sum) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	if ($sum == '10') { $va = '10'; $vb = '99.99'; }
	if ($sum == '100') { $va = '100'; $vb = '499.99'; }
	if ($sum == '500') { $va = '500'; $vb = '799.99'; }
	if ($sum == '800') { $va = '800'; $vb = '1499.99'; }
	if ($sum == '1500') { $va = '1500'; $vb = '2499.99'; }
	if ($sum == '2500') { $va = '2500'; $vb = '3999.99'; }
	if ($sum == '4000') { $va = '4000'; $vb = '6499.99'; }
	if ($sum == '6500') { $va = '6500'; }

	$data = $wpdb->get_results("SELECT *, SUM(CAST(REPLACE(totalht,',','') AS DECIMAL(30,2))) AS total FROM `$fb_tablename_order` ".$where." GROUP BY user ORDER BY total DESC");
	// echo '<table class="widefat">';
	// echo '<thead><tr><th width="5">Lp.</th><th width="5">ID</th><th>Login</th><th>Email</th><th>F. name</th><th>F. Company</th><th>F. Phone</th><th>Orders sum</th><th>Action</th></tr></thead>';

	echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th>Lp.</th>
		<th>ID</th>
		<th>Login</th>
		<th>adresse</th>
		<th>F. name</th>
		<th>F. Company</th>
		<th>F. Phone</th>
		<th>Orders sum</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>';

	$licznik = 0;
	foreach ($data as $d) :
		if (!empty($vb)) {
			if ($d->total > $va && $d->total <= $vb) {
				$licznik++;
				$userinfo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = ".$d->user."");
				$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$d->user'");
				$style = '';
				if (!empty($exist_color)) {
					$style = ' style="background:#'.$exist_color.'; width: 100%; padding:0;"';
				}
				echo '<tr><td><span '.$style.'>'.$licznik.'</span></td><td><span '.$style.'>'.$d->user.'</span></td><td><span '.$style.'>'.$userinfo->login.'</span></td><td><span '.$style.'>'.$userinfo->email.'</span></td><td><span '.$style.'>'.$userinfo->f_name.'</span></td><td><span '.$style.'>'.$userinfo->f_comp.'</span></td><td><span '.$style.'>'.$userinfo->f_phone.'</span></td><td><span '.$style.'>'.$d->total.' &euro;</span></td><td><form name="us_'.$d->user.'" action="" method="post"><input type="hidden" name="user_name" value="'.$d->user.'" /><input type="hidden" name="pokaztab" value="true" /><input type="submit" value="View details" class="edit" /></form></td></tr>';
			}
		} else {
			if ($d->total > $va) {
				$licznik++;
				$userinfo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = ".$d->user."");
				$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$d->user'");
				$style = '';
				if (!empty($exist_color)) {
					$style = ' style="background:#'.$exist_color.'; width: 100%; padding:0;"';
				}
				echo '<tr'.$style.'><td><span '.$style.'>'.$licznik.'</span></td><td><span '.$style.'>'.$d->user.'</span></td><td><span '.$style.'>'.$userinfo->login.'</span></td><td><span '.$style.'>'.$userinfo->email.'</span></td><td><span '.$style.'>'.$userinfo->f_name.'</span></td><td><span '.$style.'>'.$userinfo->f_comp.'</span></td><td><span '.$style.'>'.$userinfo->f_phone.'</td><td><span '.$style.'>'.$d->total.' &euro;</td><td><form name="us_'.$d->user.'" action="" method="post"><input type="hidden" name="user_name" value="'.$d->user.'" /><input type="hidden" name="pokaztab" value="true" /><input type="submit" value="View details" class="edit" /></form></td></tr>';
			}
		}
	endforeach;
	echo '</tbody></table>';
	echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';

}

function fb_getUsersBySearch($search) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";



	// echo '<table class="widefat">';
	// echo '<thead><tr><th width="5">Lp.</th><th width="5">ID</th><th>Login</th><th>Email</th><th>F. name</th><th>F. Company</th><th>F. Phone</th><th>Orders sum</th><th>Action</th></tr></thead>';

	//$search_query("SELECT id, login, email, f_name, f_comp, f_phone FROM `$fb_tablename_users` WHERE login LIKE '%".$search."%' OR email LIKE '%".$search."%' OR f_name LIKE '%".$search."%' OR f_comp LIKE '%".$search."%' OR id IN (SELECT user FROM `$fb_tablename_order` WHERE unique_id = '".$search."')");

	$search_query = $wpdb->get_results("SELECT id, login, email, f_name, f_comp, f_phone FROM `$fb_tablename_users` WHERE login LIKE '%".$search."%' OR email LIKE '%".$search."%' OR f_name LIKE '%".$search."%' OR f_comp LIKE '%".$search."%'");

	$licznik = 0;

	if($search_query) {

		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th>Lp.</th>
		<th>ID</th>
		<th>Login</th>
		<th>adresse</th>
		<th>F. name</th>
		<th>F. Company</th>
		<th>F. Phone</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>';

	foreach ($search_query as $s) {
		$licznik++;
		$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$s->id'");
		$style = '';
			if (!empty($exist_color)) {
				$style = ' style="background:#'.$exist_color.'; width: 100%; padding:0;"';
			}
			echo '<tr><td><span '.$style.'>'.$licznik.'</span></td><td><span '.$style.'>'.$s->id.'</span></td><td><span '.$style.'>'.$s->login.'</span></td><td><span '.$style.'>'.$s->email.'</span></td><td><span '.$style.'>'.$s->f_name.'</span></td><td><span '.$style.'>'.$s->f_comp.'</span></td><td><span '.$style.'>'.$s->f_phone.'</span></td><td><form name="us_'.$s->id.'" action="" method="post"><input type="hidden" name="user_name" value="'.$s->id.'" /><input type="hidden" name="pokaztab" value="true" /><input type="submit" value="View details" class="edit" /></form></td></tr>';
	}

	echo '</tbody></table>';
	echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';
	} else {
		echo '<p>Aucun résultat de recherche trouvé pour la recherche "'.$search.'"</p>';
	}

}

function fb_getUsersBySearchOrder($search) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	$too_short = 0;

	if(strlen($search) < 4) {
		$search = '000'.$search;
		$too_short = 1;
	}
	$search_query = $wpdb->get_results("SELECT u.id, u.login, u.email, u.f_name, u.f_comp, u.f_phone FROM `$fb_tablename_users` u, `$fb_tablename_order` o WHERE o.unique_id LIKE '%".$search."%' AND o.user = u.id");

	$licznik = 0;

	if($too_short) {
		echo '<div class="error">Erreur ! Merci de saisir au moins 4 caractères pour votre recherche.</div>';
	} else {

	if($search_query) {

		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th>Lp.</th>
		<th>ID</th>
		<th>Login</th>
		<th>adresse</th>
		<th>F. name</th>
		<th>F. Company</th>
		<th>F. Phone</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>';

	foreach ($search_query as $s) {
		$licznik++;
		$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$s->id'");
		$style = '';
			if (!empty($exist_color)) {
				$style = ' style="background:#'.$exist_color.'; width: 100%; padding:0;"';
			}
			echo '<tr><td><span '.$style.'>'.$licznik.'</span></td><td><span '.$style.'>'.$s->id.'</span></td><td><span '.$style.'>'.$s->login.'</span></td><td><span '.$style.'>'.$s->email.'</span></td><td><span '.$style.'>'.$s->f_name.'</span></td><td><span '.$style.'>'.$s->f_comp.'</span></td><td><span '.$style.'>'.$s->f_phone.'</span></td><td><form name="us_'.$s->id.'" action="" method="post"><input type="hidden" name="user_name" value="'.$s->id.'" /><input type="hidden" name="pokaztab" value="true" /><input type="submit" value="View details" class="edit" /></form></td></tr>';
	}

	echo '</tbody></table>';
	echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';
	} else {
		echo '<p>Aucun résultat de recherche trouvé pour la recherche "'.$search.'"</p>';
	}
	}

}




function fb_admin_reports() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$acutalyear = date(Y);
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';
	$pdfpath = get_bloginfo("url").'/wp-content/plugins/fbshop/js/fpdf16/';
	$ptype=$_POST['type'];
	$ptime=$_POST['time'];
	$pannualday=$_POST['annualday'];
	$pannualmonth=$_POST['annualmonth'];
	$pannualyear=$_POST['annualyear'];
	$pannualday2=$_POST['annualday2'];
	$pannualmonth2=$_POST['annualmonth2'];
	$pannualyear2=$_POST['annualyear2'];
	echo '<script type="text/javascript">
	function pokazTime() {
		var a=document.getElementById(\'selecttime\');
		if (a.value==\'annualy\') {
			var e=document.getElementById(\'annualselect\');
			if (e) e.style.display="inline";
		}
		if (a.value!=\'annualy\') {
			var e=document.getElementById(\'annualselect\');
			if (e) e.style.display="none";
		}
	}
	</script>';
	echo '<p><form name="report" id="report"  class="noprint" action="" method="post">
	<select name="type">
	<option>Select</option>
	<option value="sales"'; if ($ptype=='sales') echo ' selected="selected"'; echo '>Total sales</option>
	<option value="orders"'; if ($ptype=='orders') echo ' selected="selected"'; echo '>Total Orders</option>
	</select>
	<select name="time" id="selecttime" onchange="pokazTime()">
	<option>Select</option>
	<option value="monthly"'; if ($ptime=='monthly') echo ' selected="selected"'; echo '>Last 30 days</option>
	<option value="daily"'; if ($ptime=='daily') echo ' selected="selected"'; echo '>Daily</option>
	<option value="annualy"'; if ($ptime=='annualy') echo ' selected="selected"'; echo '>Annualy</option>
	</select>';
	if ( ($_POST['time']) == 'annualy') $pokazannual = ' style="display:inline"';
	echo '<span id="annualselect"'.$pokazannual.'><select name="annualday" id="selectannual">';
	for ($x=1; $x<32; $x++) {
		if ($x == $pannualday) { $sel=' selected="selected"'; } else { $sel=''; }
		echo '<option value="'.$x.'"'.$sel.'>'.$x.'</option>';
	}
	echo '</select>
	<select name="annualmonth" id="selectannual">';
	for ($x=1; $x<13; $x++) {
		if ($x == $pannualmonth) { $sel=' selected="selected"'; } else { $sel=''; }
		echo '<option value="'.$x.'"'.$sel.'>'.$x.'</option>';
	}
	echo '</select>
	<select name="annualyear" id="selectannual">';
	for ($x=2010; $x<=$acutalyear; $x++) {
		if ($x == $pannualyear) { $sel=' selected="selected"'; } else { $sel=''; }
		echo '<option value="'.$x.'"'.$sel.'>'.$x.'</option>';
	}
	echo '</select> -
	<select name="annualday2" id="selectannual">';
	for ($x=1; $x<32; $x++) {
		if ($x == $pannualday2) { $sel=' selected="selected"'; } else { $sel=''; }
		echo '<option value="'.$x.'"'.$sel.'>'.$x.'</option>';
	}
	echo '</select>
	<select name="annualmonth2" id="selectannual">';
	for ($x=1; $x<13; $x++) {
		if ($x == $pannualmonth2) { $sel=' selected="selected"'; } else { $sel=''; }
		echo '<option value="'.$x.'"'.$sel.'>'.$x.'</option>';
	}
	echo '</select>
	<select name="annualyear2" id="selectannual">';
	for ($x=2010; $x<=$acutalyear; $x++) {
		if ($x == $pannualyear2) { $sel=' selected="selected"'; } else { $sel=''; }
		echo '<option value="'.$x.'"'.$sel.'>'.$x.'</option>';
	}
	echo '</select></span>
	<br /><input type="hidden" name="pokaztab" /><input type="submit" style="margin-top:10px;" value="Filter" />
	</form></p>';
$licznik = 0;
$liczmak = 0;
$liczbezmak = 0;
if (isset($_POST['pokaztab'])) {
  if ($_POST['type'] == 'sales') {
	if ($_POST['time'] == 'monthly') {
		$filter = date('m')-1;
		$filterdate = date('Y-'.$filter.'-d 00:00:00');
		$where = ' AND date_modify >= \''.$filterdate.'\'';
	}
	if ($_POST['time'] == 'daily') {
		$filterdate = date('Y-m-d 00:00:00');
		$where = ' AND date_modify >= \''.$filterdate.'\'';
	}
	if ($_POST['time'] == 'annualy') {
		$fromdate = date("Y-m-d", mktime(0, 0, 0, $_POST['annualmonth'], $_POST['annualday'], $_POST['annualyear']));
		$todate = date("Y-m-d", mktime(0, 0, 0, $_POST['annualmonth2'], $_POST['annualday2'], $_POST['annualyear2']));
		$where = ' AND date_modify >= \''.$fromdate.'\' AND date_modify <= \''.$todate.'\'';
	}
	$sumfrais = 0;
	$sumtotalht = 0;
	$sumtva = 0;
	$sumtotalttc = 0;
	$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE status>=3 AND status<6".$where." ORDER BY date DESC");
	if ($orders) {
		echo '<p><form name="pdf_print_form" action="'.$pdfpath.'pdfer.php" method="post" target="_blank"><input type="hidden" name="e" value="'.$where.'" /><input type="hidden" name="a" value="'.DB_NAME.'" /><input type="hidden" name="b" value="'.DB_USER.'" /><input type="hidden" name="c" value="'.DB_PASSWORD.'" /><input type="hidden" name="d" value="'.DB_HOST.'" /><input type="submit" value="PRINT PDF" /></form></p>';
		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th></th>
		<th>N° DE COMMANDE</th>
		<th>DESCRIPTION</th>
		<th>DATE</th>
		<th>CLIENT</th>
		<th>FRAIS</th>
		<th>TOTAL HT</th>
		<th>TVA</th>
		<th>TOTAL TTC</th>
		<th>PRINT</th>
		</tr>
		</thead>
		<tbody>';
		//echo '<table class="widefat"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th class="noprint">PRINT</th></tr>';
		foreach ($orders as $o) :
			$licznik++;
			echo '<tr><td>'.$licznik.'</td><td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="'.$o->unique_id.'"></form></td><td>';
			$status = print_status($o->status);
			$prods = $wpdb->get_results("SELECT name, description, quantity, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' AND status=1 ORDER BY name ASC");
			foreach ($prods as $p) :
				echo $p->name.' ('.$p->quantity.')<br />';
				$wzorzec = '/ai déjà crée la maquette/';
				$wzorzec2 = '/France banderole crée la maquette/';
				$czymak = preg_match_all($wzorzec, $p->description, $wynik);
				$czymak2 = preg_match_all($wzorzec2, $p->description, $wynik2);
				$ktomak = count($wynik[0]);
				$ktomak2 = count($wynik2[0]);
				if ($ktomak >= 1) {
					$liczbezmak++;
				}
				if ($ktomak2 >= 1) {
					$liczmak++;
				}
			endforeach;
			$client = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$o->user'");
			echo '</td><td>'.$o->datamodyfikacji.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td class="noprint"><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
			$sumfrais = $sumfrais+str_replace(',', '', $o->frais);
			$sumtotalht = $sumtotalht+str_replace(',', '', $o->totalht);
			$sumtva = $sumtva+str_replace(',', '', $o->tva);
			$sumtotalttc = $sumtotalttc+str_replace(',', '', $o->totalttc);
		endforeach;
		echo '<tr><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">TOTAL</td><td style="vertical-align:middle;font-weight:bold;">'.$sumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalttc.' &euro;</td></tr>';
		echo '</tbody></table>';
		echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';
		echo "<p>France banderole crée la maquette: <b>".$liczmak."</b><br />j’ai déjà crée la maquette: <b>".$liczbezmak."</b></p>";
	}
	}
	if ($_POST['type'] == 'orders') {
	if ($_POST['time'] == 'monthly') {
		$filter = date('m')-1;
		$filterdate = date('Y-'.$filter.'-d 00:00:00');
		$where = ' WHERE date >= \''.$filterdate.'\'';
	}
	if ($_POST['time'] == 'daily') {
		$filterdate = date('Y-m-d 00:00:00');
		$where = ' WHERE date >= \''.$filterdate.'\'';
	}
	if ($_POST['time'] == 'annualy') {
		$fromdate = date("Y-m-d", mktime(0, 0, 0, $_POST['annualmonth'], $_POST['annualday'], $_POST['annualyear']));
		$todate = date("Y-m-d", mktime(0, 0, 0, $_POST['annualmonth2'], $_POST['annualday2'], $_POST['annualyear2']));
		$where = ' WHERE date >= \''.$fromdate.'\' AND date_modify <= \''.$todate.'\'';
	}
	$sumfrais = 0;
	$sumtotalht = 0;
	$sumtva = 0;
	$sumtotalttc = 0;
	$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order`".$where." ORDER BY date DESC");
	if ($orders) {
		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table>
		<thead>
		<tr>
		<th></th>
		<th>N° DE COMMANDE</th>
		<th>DESCRIPTION</th>
		<th>DATE CREATE</th>
		<th>ETAT</th>
		<th>CLIENT</th>
		<th>FRAIS</th>
		<th>TOTAL HT</th>
		<th>TVA</th>
		<th>TOTAL TTC</th>
		<th>PRINT</th>
		</tr>
		</thead>
		<tbody>';
		//echo '<table class="widefat"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE CREATE</th><th>ETAT</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th class="noprint">PRiNT</th></tr>';
		foreach ($orders as $o) :
			$licznik++;
			echo '<tr><td>'.$licznik.'</td><td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="'.$o->unique_id.'"></form></td><td>';
			$status = print_status($o->status);
			$prods = $wpdb->get_results("SELECT name, description, quantity, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' AND status=1 ORDER BY name ASC");
			foreach ($prods as $p) :
				echo $p->name.' ('.$p->quantity.')<br />';
				$wzorzec = '/ai déjà crée la maquette/';
				$wzorzec2 = '/France banderole crée la maquette/';
				$czymak = preg_match_all($wzorzec, $p->description, $wynik);
				$czymak2 = preg_match_all($wzorzec2, $p->description, $wynik2);
				$ktomak = count($wynik[0]);
				$ktomak2 = count($wynik2[0]);
				if ($ktomak >= 1) {
					$liczbezmak++;
				}
				if ($ktomak2 >= 1) {
					$liczmak++;
				}
			endforeach;
			$client = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$o->user'");
			echo '</td><td>'.$o->data.'</td><td>'.$status.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td class="noprint"><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
			$sumfrais = $sumfrais+str_replace(',', '', $o->frais);
			$sumtotalht = $sumtotalht+str_replace(',', '', $o->totalht);
			$sumtva = $sumtva+str_replace(',', '', $o->tva);
			$sumtotalttc = $sumtotalttc+str_replace(',', '', $o->totalttc);
		endforeach;
		$mediumfrais = round($sumfrais/$licznik, 2);
		$mediumtotalht = round($sumtotalht/$licznik, 2);
		$mediumtva = round($sumtva/$licznik, 2);
		$mediumtotalttc = round($sumtotalttc/$licznik, 2);
		echo '<tr><td></td><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">TOTAL</td><td style="vertical-align:middle;font-weight:bold;">'.$sumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalttc.' &euro;</td></tr>';
		echo '<tr><td></td><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">Medium amount of an order:</td><td style="vertical-align:middle;font-weight:bold;">'.$mediumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$mediumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$mediumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$mediumtotalttc.' &euro;</td></tr>';
		echo '</tbody></table>';
		echo '<script type="text/javascript">
			jQuery(function() {
			jQuery("#example-1").beautify({
			pageSize : 100000,
				pagerSize : 7
			});
			jQuery("#txt_search").keyup(function() {
				jQuery("#example-1").beautify("rebuild", { globalFilter : jQuery("#txt_search").val() });
			});
			});
	</script>';
		echo "<p>France banderole crée la maquette: <b>".$liczmak."</b><br />j’ai déjà crée la maquette: <b>".$liczbezmak."</b></p>";
	}
	}
}
}




function fbs_admin_head() {
	echo '<link rel="stylesheet" href="//dev.france-banderole.com/wp-content/plugins/fbshop/admin.css" type="text/css" />';
	echo '<link rel="stylesheet" type="text/css" media="print" href="//dev.france-banderole.com/wp-content/plugins/fbshop/admin_print.css" />';
	if (isset($_GET['fbdet'])) {
/*	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/thickbox/thickbox.css" /><script language="javascript" type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/thickbox/jquery-latest.js"></script><script language="javascript" type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/thickbox/thickbox.js"></script>';*/
	}
}

function fb_admin_mails() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_mails = $prefix."fbs_mails";

	if (isset($_POST['fb_delmail'])) {
		$ident = $_POST['fb_delmail'];
		$wpdb->query("DELETE FROM `$fb_tablename_mails` WHERE id='$ident'");
	}
	if (isset($_POST['addmail'])) {
		$temat = addslashes($_POST['mail_topic']);
		$content = addslashes($_POST['mail_content']);
		$wpdb->query("INSERT INTO `$fb_tablename_mails` VALUES (not null, '".$temat."', '".$content."')");
	}
	if (isset($_POST['editmail'])) {
		$ident = $_POST['editmail'];
		$temat = addslashes($_POST['nmail_topic']);
		$content = addslashes($_POST['nmail_content']);
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_mails` SET topic='$temat', content='$content' WHERE id='$ident'");
	}

if (isset($_POST['fb_editmail'])) {
	$ident = $_POST['fb_editmail'];
	$simplemail = $wpdb->get_row("SELECT * FROM `$fb_tablename_mails` WHERE id = '$ident'");
	echo '<form name="editmail" id="editmail" action="" method="post"><input type="hidden" name="editmail" value="'.$simplemail->id.'" />';
	echo '<p>Topic: <input type="text" name="nmail_topic" value="'.stripslashes($simplemail->topic).'" /></p>';
	echo '<script type="text/javascript" src="//dev.france-banderole.com/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor().panelInstance(\'incon\');
				});
			</script>';
	echo '<textarea name="nmail_content" id="incon">'.stripslashes($simplemail->content).'</textarea><input type="submit" value="SAVE" class="savebutt3" />';
	echo '</form>';
} else {
	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';
/* maile -dodawanie */
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new:</span></h3><div class="inside">';
	echo '<form name="newmail" id="newmail" action="" method="post"><input type="hidden" name="addmail" />';
	echo '<p>Topic: <input type="text" name="mail_topic" /></p>';
	echo '<script type="text/javascript" src="//dev.france-banderole.com/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor().panelInstance(\'incon\');
				});
			</script>';
	echo '<textarea name="mail_content" id="incon"></textarea><input type="submit" value="SAVE" class="savebutt3" />';
	echo '</form>';
	echo '</div></div></div></div>';
	echo '<div id="col-left" style="width:70%;margin-top:30px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Topic</th><th>Content</th><th>Action</th></tr></thead>';
	$mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails` ORDER BY topic ASC", ARRAY_A);
	if ($mails) {
		foreach ($mails as $m) :
			$licz = strlen($m[content]);
			if ($licz > 150) {
				$tnij = substr(htmlspecialchars($m[content]),0,150);
	    	    $txt = $tnij."...";
			} else {
				$txt = htmlspecialchars($m[content]);
			}
			$m[topic] = stripslashes($m[topic]);
			$txt = stripslashes($txt);
			echo '<tr><td style="text-align:left">'.$m[topic].'</td><td style="text-align:left">'.$txt.'</td><td>';
			echo '<p><form name="form_edmail" id="form_edmail" method="post" action="">';
			echo '<input type="hidden" name="fb_editmail" value="'.$m[id].'" />';
			echo '<input type="submit" name="fb_mail_edit" class="edit" value="EDIT" /></form></p>';
			echo '<p><form name="form_delmail" id="form_delmail" method="post" action="">';
			echo '<input type="hidden" name="fb_delmail" value="'.$m[id].'" />';
			echo '<input type="submit" name="fb_mail_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {this.form._wpnonce.value = "'.$bc_delete_nonce.'"; return true;} return false;\' /></form></p>';
			echo '</td></tr>';
		endforeach;
	}
	echo '</table>';
	echo '</div></div>';
}
}


function fb_admin_topic() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_topic = $prefix."fbs_topic";
/*
	if (isset($_POST['newtopicname'])) {
		$wpdb->query("INSERT INTO `$fb_tablename_topic` VALUES (not null, '".$_POST['newtopicname']."', '')");
	}
	if (isset($_POST['fb_deltopic'])) {
		$delid = $_POST['fb_deltopic'];
		$wpdb->query("DELETE FROM `$fb_tablename_topic` WHERE id='$delid'");
	}
	echo '<h1>Comments topics</h1>';
	echo '<p><form name="addtopic" id="addtopic" action="" method="post"><label for="newtopicname">Insert new topic: </label><input type="text" name="newtopicname" id="newtopicname" /><input type="submit" value="submit" /></form></p>';
	// wyswietlanie kategorii z bazy danych
	$topics = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` ORDER BY content ASC", ARRAY_A);
	echo '<table class="widefat">';
	echo '<thead><tr><th>Topic:</th><th>Action:</th></tr></thead>';
	foreach ($topics as $t) :
		echo '<tr><td>'.$t[content].'</td><td>';
		//deleting
		echo '<form name="topicdelete" method="post" action="">';
		echo '<input type="hidden" name="fb_deltopic" value="'.$t[id].'" />';
		echo '<input type="submit" name="fb_top_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form>';
		echo '</td></tr>';
	endforeach;
	echo '</table>';
*/
	echo '<h1>Comments topics</h1>';

	if (isset($_POST['fb_delmail'])) {
		$ident = $_POST['fb_delmail'];
		$wpdb->query("DELETE FROM `$fb_tablename_topic` WHERE id='$ident'");
	}
	if (isset($_POST['addmail'])) {
		$temat = addslashes($_POST['mail_topic']);
		$content = addslashes($_POST['mail_content']);
		$wpdb->query("INSERT INTO `$fb_tablename_topic` VALUES (not null, '".$temat."', '".$content."')");
	}
	if (isset($_POST['editmail'])) {
		$ident = $_POST['editmail'];
		$temat = addslashes($_POST['nmail_topic']);
		$content = addslashes($_POST['nmail_content']);
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_topic` SET topic='$temat', content='$content' WHERE id='$ident'");
	}

if (isset($_POST['fb_editmail'])) {
	$ident = $_POST['fb_editmail'];
	$simplemail = $wpdb->get_row("SELECT * FROM `$fb_tablename_topic` WHERE id = '$ident'");
	echo '<form name="editmail" id="editmail" action="" method="post"><input type="hidden" name="editmail" value="'.$simplemail->id.'" />';
	echo '<p>Topic: <input type="text" name="nmail_topic" value="'.stripslashes($simplemail->topic).'" /></p>';
	echo '<script type="text/javascript" src="//dev.france-banderole.com/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor().panelInstance(\'incon\');
				});
			</script>';

	echo '<textarea name="nmail_content" id="incon">'.stripslashes($simplemail->content).'</textarea><input type="submit" value="SAVE" class="savebutt3" />';
	echo '</form>';
} else {
	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';
/* maile -dodawanie */
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new:</span></h3><div class="inside">';
	echo '<form name="newmail" id="newmail" action="" method="post"><input type="hidden" name="addmail" />';
	echo '<p>Topic: <input type="text" name="mail_topic" /></p>';
	echo '<script type="text/javascript" src="//dev.france-banderole.com/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor().panelInstance(\'incon\');
				});
			</script>';
	echo '<textarea name="mail_content" id="incon"></textarea><input type="submit" value="SAVE" class="savebutt3" />';
	echo '</form>';
	echo '</div></div></div></div>';
	echo '<div id="col-left" style="width:70%;margin-top:30px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Topic</th><th>Content</th><th>Action</th></tr></thead>';
	$mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` ORDER BY topic ASC", ARRAY_A);
	if ($mails) {
		foreach ($mails as $m) :
			$licz = strlen($m[content]);
			if ($licz > 150) {
				$tnij = substr(htmlspecialchars($m[content]),0,150);
	    	    $txt = $tnij."...";
			} else {
				$txt = htmlspecialchars($m[content]);
			}
			$m[topic] = stripslashes($m[topic]);
			$txt = stripslashes($txt);
			echo '<tr><td style="text-align:left">'.$m[topic].'</td><td style="text-align:left">'.$txt.'</td><td>';
			echo '<p><form name="form_edmail" id="form_edmail" method="post" action="">';
			echo '<input type="hidden" name="fb_editmail" value="'.$m[id].'" />';
			echo '<input type="submit" name="fb_mail_edit" class="edit" value="EDIT" /></form></p>';
			echo '<p><form name="form_delmail" id="form_delmail" method="post" action="">';
			echo '<input type="hidden" name="fb_delmail" value="'.$m[id].'" />';
			echo '<input type="submit" name="fb_mail_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {this.form._wpnonce.value = "'.$bc_delete_nonce.'"; return true;} return false;\' /></form></p>';
			echo '</td></tr>';
		endforeach;
	}
	echo '</table>';
	echo '</div></div>';
}
}

function deleteDirectory($dirPath) {
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
	        if ($object != "." && $object != "..") {
                 unlink($dirPath."/".$object);
	        }
	    }
        reset($objects);
        rmdir($dirPath);
    }
}

function fb_admin_sales() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";
	$fb_tablename_cf = $prefix."fbs_cf";
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';

/* usuwanie */
	if (isset($_POST['delete_item'])) {
		$num = $_POST['delete_item'];
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$num."'");
		deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$num.'/');
		deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$num.'-projects/');
	}

/* szczegoly */
if (isset($_GET['fbdet'])) {
	$number = $_GET['fbdet'];
	fbadm_print_details($number);
} else if(isset($_GET['fbbonprint'])) {
	$number = $_GET['fbbonprint'];
	fbadm_bon_print($number);
} else if(isset($_GET['fbinvoiceprint'])) {
	$number = $_GET['fbinvoiceprint'];
	fbadm_invoice_print($number);
} else if(isset($_GET['fbinvoiceproprint'])) {
	$number = $_GET['fbinvoiceproprint'];
	fbadm_invoice_proprint($number);
} else {
/* wyswietlanie */
	if (isset($_GET['sort'])) {
		if ($_GET['sort'] == 'number') {
	 		$sortby = 'ORDER BY unique_id';
		}
		if ($_GET['sort'] == 'totalttc') {
	 		$sortby = 'ORDER BY sumorder';
		}
		if ($_GET['sort'] == 'datec') {
	 		$sortby = 'ORDER BY o.date';
		}
		if ($_GET['sort'] == 'datem') {
	 		$sortby = 'ORDER BY o.date_modify';
		}
		if ($_GET['sort'] == 'etat') {
	 		$sortby = 'ORDER BY status';
		}
		if ($_GET['sort'] == 'type') {
//	 		$sortby = 'LEFT JOIN '.$fb_tablename_prods.' AS prod ON (unique_id = prod.order_id) WHERE (prod.description LIKE "%j’ai déjà crée la maquette%")';
//AND prod.description LIKE "%j’ai déjà crée la maquette%"
//WHERE unique_id = prod.order_id
		}
		if(isset($_GET['asc'])) {
			$asc = $_GET['asc'];
			$sortby .= ' '.$asc;
		} else {
			$sortby .= ' ASC';
		}
	} else {
 		$sortby = 'ORDER BY status ASC';
 	}
	if ($_GET['sort'] == 'client') {
		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, CAST(REPLACE(o.totalttc,',','') AS DECIMAL(30,2)) AS sumorder, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o, `$fb_tablename_users` us WHERE us.id = o.user && (o.status < 5 OR o.status > 6) ORDER BY us.f_name");
	} else {

        $orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, CAST(REPLACE(o.totalttc,',','') AS DECIMAL(30,2)) AS sumorder, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H+2:%i') AS datamodyfikacji FROM `$fb_tablename_order` o WHERE o.status < 5 OR o.status > 6 ".$sortby."");

		/* , CAST(totalttc AS DECIMAL(30,2)) AS sumorder*/
	}
	if ($orders) {
		//echo '<table class="widefat"><tr><th><a href="admin.php?page=fbsh&sort=number">N° DE COMMANDE</a></th><th><a href="admin.php?page=fbsh&sort=client">CLIENT</a></th><th>DESCRIPTION</th><th><a href="admin.php?page=fbsh&sort=totalttc">PRIX</a></th><th><a href="admin.php?page=fbsh&sort=datec">DATE CREATE</a></th><th><a href="admin.php?page=fbsh&sort=etat">ETAT</a></th><th>TYPE</th><th>FILES</th><th>LAST ACTION</th><th>COMMENTS</th><th></th></tr>';
		$order_link = 'admin.php?page=fbsh&sort=number';
		$client_link = 'admin.php?page=fbsh&sort=client';
		$prix_link = 'admin.php?page=fbsh&sort=totalttc';
		$date_link = 'admin.php?page=fbsh&sort=datec';
		$etat_link = 'admin.php?page=fbsh&sort=etat';

		if (isset($_GET['sort'])) {
			if(isset($_GET['asc'])) {
				$asc = $_GET['asc'];
				if($asc=='ASC') {
					$asc_link = '&asc=DESC';
				} else {
					$asc_link = '&asc=ASC';
				}
			} else {
				$asc_link = '&asc=DESC';
			}

			if ($_GET['sort'] == 'number') {
				$order_link .= $asc_link;
			}
			if ($_GET['sort'] == 'totalttc') {
				$prix_link .= $asc_link;
			}
			if ($_GET['sort'] == 'datec') {
				$date_link .= $asc_link;
			}
			if ($_GET['sort'] == 'etat') {
				$etat_link .= $asc_link;
			}
		}

		echo '<table class="widefat"><tr><th><a href="'.$order_link.'">N° DE COMMANDE</a></th><th><a href="'.$client_link.'">CLIENT</a></th><th>DESCRIPTION</th><th><a href="'.$prix_link.'">PRIX</a></th><th><a href="'.$date_link.'">DATE CREATE</a></th><th><a href="'.$etat_link.'">ETAT</a></th><th>TYPE</th><th>FILES</th><th>LAST ACTION</th><th>COMMENTS</th><th></th></tr>';




		foreach ($orders as $o) :
			$client = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$o->user'");
			$style = '';
			$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$o->user'");
			if (!empty($exist_color)) {
				$style = ' style="background:#'.$exist_color.'"';
			}
			echo '<tr'.$style.'><td>'.$o->unique_id.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>';
			$status = print_status($o->status);
			$prods = $wpdb->get_results("SELECT name, description, quantity, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' ORDER BY name ASC");
				$ktomakiete = 0;
				$czyfbrobimakiete = 0;
				$kolorujstatus = 0;
			foreach ($prods as $p) :
				if ($p->status == 0) {
					echo '<s style="color:red;">'.$p->name.' ('.$p->quantity.')</s><br />';
				} else {
					echo $p->name.' ('.$p->quantity.')<br />';
				}
			//sprawdzanie dla kolumny type // vérifie le type de colonne
				$wzorzec = '/j’ai déjà crée la maquette/';
				$ktomak = preg_match_all($wzorzec, $p->description, $wynik);
				$ktomak = count($wynik[0]);
				if ($ktomak >= 1) {
					$ktomakiete = 0;
				} else {
					$ktomakiete = 1;
				}
				if ($ktomakiete == 1) $czyfbrobimakiete = 1;
			//sprawdzanie dla kolumny type // vérifie le type de colonne

				// SPRAWDZANIE CZY OPIS ZAWIERA RUSH24 // VERIFICATION OU DESCRIPTION CONTIENT RUSH24
				if ($p->status == 1) {
					if ($kolorujstatus<1) {
						$wzorzec2 = '/1J/';
						$wzorzec = '/rush/';
						$czyrush = preg_match_all($wzorzec, $p->description, $wynikrush);
						$czyrush2 = preg_match_all($wzorzec2, $p->description, $wynikrush2);
						$czyrush2 = count($wynikrush2[0]);
						$czyrush = count($wynikrush[0]);
						if ($czyrush >= 1) {
							$kolorujstatus = 1;
						}
						if ($czyrush2 >= 1) {
							$kolorujstatus = 1;

						}
					}
				}
				// SPRAWDZANIE CZY OPIS ZAWIERA RUSH24 // VERIFICATION OU DESCRIPTION CONTIENT RUSH24
			endforeach;
			$maktype = 'impression';
			if ($czyfbrobimakiete == 1) $maktype = 'creation';
///
			$filepath='';
			$pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$o->unique_id.'/';
			if(file_exists($pathfiles)) {
				if ($dir = @opendir($pathfiles)) {
				    while(($file = readdir($dir))) {
						if(!is_dir($file) && !in_array($file, array(".",".."))) {
					  		$filepath = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
						}
		    		}
			    	closedir($dir);
			    	if ($filepath == '') {
				  		$filepath = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
			    	}
		  		} else {
			  		$filepath = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
		  		}
		  	} else {
		  		$filepath = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
		  	}

			$stylstatusu = '';
			if ($o->status == 0) {
				if ($kolorujstatus == 1) {
					$stylstatusu = ' style="background:red"';
				} else {
					$stylstatusu = ' style="background:#82ff7f;"';
				}
			}
			if ($o->status == 1) $stylstatusu = ' style="background:#feca7f;"';
			if ($o->status == 2) $stylstatusu = ' style="background:#f3a0ee;"';
			if ($o->status == 3) $stylstatusu = ' style="background:#7edfff;"';
			if ($o->status == 4) $stylstatusu = ' style="background:#f6ff7e;"';
			if ($o->status == 5) $stylstatusu = ' style="background:#819ac3;"';
			if ($o->status == 6) $stylstatusu = ' style="background:#c4c4c4;"';
			if ($o->status == 7) $stylstatusu = ' style="background:#fbcfd0;"';

			$czyjostatnikomentarz = '';
			$lastcomment = $wpdb->get_row("SELECT c.* FROM `$fb_tablename_comments` as c WHERE c.order_id = '$o->unique_id' AND topic != 'Fichier(s)' ORDER BY c.date DESC");
			if ($lastcomment) {
				if ($lastcomment->author == 'France Banderole') {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
				} else {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
				}
			}

			$czyjostatniruch = '';
			$lastaction = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '$o->unique_id'");
			if ($lastaction) {
				if ($o->status == 0 || 1 || 2 || 7 ) {
					if ($lastaction->value == 'fb') {
						$czyjostatniruch = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
					} else {
						$czyjostatniruch = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
					}
				} else {
					$czyjostatniruch = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
				}
			}


			if ($o->status == 7) {
				if((isset($o->payment)) AND ($o->payment != '')) {
					$pay_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement_moy` WHERE pay_code = '$o->payment'");
					$status = $status.'<br />'.$pay_name->pay_designation;
				} else {
					$pay_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement_moy` WHERE pay_code = '$o->payment_ch'");
					$status = $status.'<br />'.$pay_name->pay_designation;
				}
			}
			echo '</td><td>'.$o->totalttc.' &euro;</td><td>'.$o->data.'</td><td'.$stylstatusu.'>'.$status.'</td><td>'.$maktype.'</td><td>'.$filepath.'</td>
			<td>'.$czyjostatniruch.'</td><td>'.$czyjostatnikomentarz.'</td>

			<td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="DETAILS"></form><br />
			<form id="delitem" name="delitem" action="" method="post"><input type="hidden" name="delete_item" value="'.$o->unique_id.'" /><input class="delete" type="submit" value="delete" onclick=\'if (confirm("'.esc_js( "Are you sure? You will delete this order, all products and all comments!" ).'")) {return true;} return false;\' /></form></td></tr>';
		endforeach;
		echo '</table>';
	} else {
		echo 'There\'s nothing yet.';
	}
}
	echo $view;
}

function fb_admin_sales_old() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_comments = $prefix."fbs_comments";
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';

/* usuwanie */
	if (isset($_POST['delete_item'])) {
		$num = $_POST['delete_item'];
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$num."'");
	}
/* usuwanie anulowanych */
	if (isset($_POST['del_cancel'])) {
		$todel = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE status = 6");
		foreach ($todel as $td) :
			$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$td->unique_id."'");
			$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$td->unique_id."'");
		endforeach;
//		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE status='6'");
	}

/* szczegoly */
if (isset($_GET['fbdet'])) {
	$number = $_GET['fbdet'];
	fbadm_print_details($number);
} else if(isset($_GET['fbbonprint'])) {
	$number = $_GET['fbbonprint'];
	fbadm_bon_print($number);
} else if(isset($_GET['fbinvoiceprint'])) {
	$number = $_GET['fbinvoiceprint'];
	fbadm_invoice_print($number);
} else if(isset($_GET['fbinvoiceproprint'])) {
	$number = $_GET['fbinvoiceproprint'];
	fbadm_invoice_proprint($number);
} else {
/* wyswietlanie */
	if (isset($_GET['sort'])) {
		if ($_GET['sort'] == 'number') {
	 		$sortby = 'ORDER BY unique_id ASC';
		}
		if ($_GET['sort'] == 'datec') {
	 		$sortby = 'ORDER BY o.date ASC';
		}
		if ($_GET['sort'] == 'datem') {
	 		$sortby = 'ORDER BY o.date_modify ASC';
		}
		if ($_GET['sort'] == 'etat') {
	 		$sortby = 'ORDER BY status ASC';
		}
		if ($_GET['sort'] == 'type') {
//	 		$sortby = 'LEFT JOIN '.$fb_tablename_prods.' AS prod ON (unique_id = prod.order_id) WHERE (prod.description LIKE "%j’ai déjà crée la maquette%")';
//AND prod.description LIKE "%j’ai déjà crée la maquette%"
//WHERE unique_id = prod.order_id
		}
	} else {
 		$sortby = 'ORDER BY data DESC';
 	}
	$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$fb_tablename_order` o WHERE o.status >= 5"));
	$offset=$_GET['offset'];
	if($offset =='') {
		$offset = 0;
	}
	$limit = 300;
	$pagenumber = intval($count/$limit);
	if($count%$limit) {
		$pagenumber++;
	}
	if($limit > $count) {
		$limit = $count;
	}
	if ($_GET['sort'] == 'client') {
		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o, `$fb_tablename_users` us WHERE us.id = o.user && o.status >= 5 ORDER BY us.f_name LIMIT $offset, $limit");
	} else {
		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o WHERE o.status >= 5 ".$sortby." LIMIT $offset, $limit");
	}
	if ($orders) {
		echo '<p>Old Sales</p>';
		echo '<form name="delete_calceled" action="" method="post"><input type="hidden" name="del_cancel" value="true" /><input type="submit" value="Delete canceled commands" onclick=\'if (confirm("'.esc_js( "Are you sure? You will delete this order, all products and all comments!" ).'")) {return true;} return false;\' /></form>';
		echo '<table class="widefat"><tr><th><a href="admin.php?page=fbsho&sort=number">N° DE COMMANDE</a></th><th><a href="admin.php?page=fbsho&sort=client">CLIENT</a></th><th>DESCRIPTION</th><th>PRIX</th><th><a href="admin.php?page=fbsho&sort=datec">DATE CREATE</a></th><th><a href="admin.php?page=fbsho&sort=datem">DATE MODIFY</a></th><th><a href="admin.php?page=fbsho&sort=etat">ETAT</a></th><th>TYPE</th><th>FILES</th><th>PRINT</th><th>COMMENTS</th><th></th></tr>';
		foreach ($orders as $o) :
			$client = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$o->user'");
			$style = '';
			$exist_color = $wpdb->get_var("SELECT att_value FROM `$fb_tablename_users_cf` WHERE att_name = 'client_color' AND uid = '$o->user'");
			if (!empty($exist_color)) {
				$style = ' style="background:#'.$exist_color.'"';
			}
			echo '<tr'.$style.'><td>'.$o->unique_id.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>';
			$status = print_status($o->status);
			$prods = $wpdb->get_results("SELECT name, description, quantity, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' ORDER BY name ASC");
				$ktomakiete = 0;
				$czyfbrobimakiete = 0;
			foreach ($prods as $p) :
				if ($p->status == 0) {
					echo '<s style="color:red;">'.$p->name.' ('.$p->quantity.')</s><br />';
				} else {
					echo $p->name.' ('.$p->quantity.')<br />';
				}
			//sprawdzanie dla kolumny type //
				$wzorzec = '/j’ai déjà crée la maquette/';
				$ktomak = preg_match_all($wzorzec, $p->description, $wynik);
				$ktomak = count($wynik[0]);
				if ($ktomak >= 1) {
					$ktomakiete = 0;
				} else {
					$ktomakiete = 1;
				}
				if ($ktomakiete == 1) $czyfbrobimakiete = 1;
			//sprawdzanie dla kolumny type //
			endforeach;
			$maktype = 'impression';
			if ($czyfbrobimakiete == 1) $maktype = 'creation';
///
			$filepath='';
			$pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$o->unique_id.'/';
			if(file_exists($pathfiles)) {
				if ($dir = @opendir($pathfiles)) {
				    while(($file = readdir($dir))) {
						if(!is_dir($file) && !in_array($file, array(".",".."))) {
					  		$filepath = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
						}
		    		}
			    	closedir($dir);
			    	if ($filepath == '') {
				  		$filepath = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
			    	}
		  		} else {
			  		$filepath = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
		  		}
		  	} else {
		  		$filepath = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
		  	}

			$stylstatusu = '';
			if ($o->status == 0) $stylstatusu = ' style="background:#82ff7f;"';
			if ($o->status == 1) $stylstatusu = ' style="background:#feca7f;"';
			if ($o->status == 2) $stylstatusu = ' style="background:#f3a0ee;"';
			if ($o->status == 3) $stylstatusu = ' style="background:#7edfff;"';
			if ($o->status == 4) $stylstatusu = ' style="background:#f6ff7e;"';
			if ($o->status == 5) $stylstatusu = ' style="background:#819ac3;"';
			if ($o->status == 6) $stylstatusu = ' style="background:#c4c4c4;"';
			if ($o->status == 7) $stylstatusu = ' style="background:#fbcfd0;"';

			$czyjostatnikomentarz = '';
			$lastcomment = $wpdb->get_row("SELECT c.* FROM `$fb_tablename_comments` as c WHERE c.order_id = '$o->unique_id' ORDER BY c.date DESC");
			if ($lastcomment) {
				if ($lastcomment->author == 'France Banderole') {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
				} else {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
				}
			}

			echo '</td><td>'.$o->totalttc.' &euro;</td><td>'.$o->data.'</td><td>'.$o->datamodyfikacji.'</td><td'.$stylstatusu.'>'.$status.'</td><td>'.$maktype.'</td><td>'.$filepath.'</td>
			<td><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td><td>'.$czyjostatnikomentarz.'</td>
			<td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="DETAILS"></form><br />
			<form id="delitem" name="delitem" action="" method="post"><input type="hidden" name="delete_item" value="'.$o->unique_id.'" /><input class="delete" type="submit" value="delete" onclick=\'if (confirm("'.esc_js( "Are you sure? You will delete this order, all products and all comments!" ).'")) {return true;} return false;\' /></form></td></tr>';
		endforeach;
		echo("<tr><td colspan=8 >Page: ");
		for($i=1;$i<=$pagenumber;$i++) {
			$newpage=$limit*($i-1);
			if($offset!=$newpage) {
				echo '[<a href="admin.php?page=fbsho&sort='.$_GET['sort'].'&offset='.$newpage.$p_ord.'">'.$i.'</a>]';
			} else {
				echo "[$i]";
			}
		}
		echo '</table>';
	} else {
		echo 'There\'s nothing yet.';
	}
}
	echo $view;
}

function fb_admin_users2() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";

	if ($_POST['action'] == 'fb_view_user') {
		if (isset($_POST['changePassId'])) {
			$passid = $_POST['changePassId'];
			$userlogin = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$passid'");
			$pass = $_POST['newpass'];
			$pass2 = $_POST['newpass2'];
			if ($pass == $pass2) {
		        $haslo = sha1(md5($pass2)); // szyfrowanie hasła
				$wysylanie = $wpdb->query("UPDATE `$fb_tablename_users` SET pass = '$haslo' WHERE id = '$passid'");
	        		$letter = "Bonjour,\r\nVous pouvez vous connecter dans votre accès client avec les informations ci-dessous :\r\n\r\nMOT DE PASSE : ".$pass2."\r\nNOM D’UTILISATEUR : ".$userlogin->login."\r\n\r\nUne fois connecté(e), vous pourrez modifier ces données si vous le souhaitez en cliquant sur le bouton \"modifier mon compte\".\r\n\r\nAmicalement,\r\nL’équipe FRANCE BANDEROLE";
					$header = 'From: FRANCE BANDEROLE <info@france-banderole.fr>';
        			$header .= "\nContent-type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
			        //mail($userlogin->email, "france-banderole.com", $letter, $header);
			        wp_mail($userlogin->email, "France Banderole", $letter);
					echo '<p style="font-weight:bold;">OK, password has been changed!</p>';
			} else {
				echo '<p style="color:red;font-weight:bold;">ERROR! Password is incorrect!</p>';
			}
		}

		echo '<h2>User Detail Info</h2>';
		$userid = $_POST['fb_view_user_id'];
		$user = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$userid'");
		if ($user->status == 0) $uconf='no';
		if ($user->status == 1) $uconf='yes';
		if ($user) {
			$explode = explode('|', $user->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'];
			$explode2 = explode('|', $user->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'];
			echo '<table>
			<tr><td style="width:130px">Login:</td><td>'.$user->login.'</td></tr>
			<tr><td>Email:</td><td>'.$user->email.'</td></tr>
			<tr><td>Confirmed?</td><td>'.$uconf.'</td></tr>
			<tr><td colspan="2" style="font-weight:bold;padding-top:20px;">ADRESSE DE FACTURATION:</td></tr>
			<tr><td>prénom et nom:</td><td>'.$user->f_name.'</td></tr>
			<tr><td>société:</td><td>'.$user->f_comp.'</td></tr>
			<tr><td>adresse:</td><td>'.$f_address.'</td></tr>
			<tr><td>code porte/esc./etc:</td><td>'.$f_porte.'</td></tr>
			<tr><td>code postal:</td><td>'.$user->f_code.'</td></tr>
			<tr><td>ville:</td><td>'.$user->f_city.'</td></tr>
			<tr><td>phone:</td><td>'.$user->f_phone.'</td></tr>
			<tr><td colspan="2" style="font-weight:bold;padding-top:20px;">ADRESSE DE LIVRAISON:</td></tr>
			<tr><td>prénom et nom:</td><td>'.$user->l_name.'</td></tr>
			<tr><td>société:</td><td>'.$user->l_comp.'</td></tr>
			<tr><td>adresse:</td><td>'.$l_address.'</td></tr>
			<tr><td>code porte/esc./etc:</td><td>'.$l_porte.'</td></tr>
			<tr><td>code postal:</td><td>'.$user->l_code.'</td></tr>
			<tr><td>ville:</td><td>'.$user->l_city.'</td></tr>
			<tr><td>phone:</td><td>'.$user->l_phone.'</td></tr>
			</table>';

			echo '<form method="post" action="">
			<input type="hidden" name="changePassId" value="'.$user->id.'" />
			<input type="hidden" name="action" value="fb_view_user" />
			<input type="hidden" name="fb_view_user_id" value="'.$user->id.'" />
			<table>
			<tr><td colspan="2" style="font-weight:bold;padding-top:20px;">CHANGE USER PASSWORD:</td></tr>
			<tr><td><label>New Password: </label></td><td><input type="password" name="newpass" /></td></tr>
			<tr><td><label>Repeat Password: </label></td><td><input type="password" name="newpass2" /></td></tr>
			<tr><td></td><td><input type="submit" name="save" value="SAVE" /></td></tr>
			</table>
			</form>';

			echo '<p><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fb-users">Go back</a></p>';
		} else {
			echo 'Error.<p><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fb-users">Go back</a></p>';
		}
	} else {
		if ($_POST['action'] == 'fb_del_user') {
			$userid = $_POST['fb_del_user_id'];
			$deleting = $wpdb->query("DELETE FROM `$fb_tablename_users` WHERE id='".$userid."'");
			if ($deleting) echo 'User deleted.';
		}

		$userscount = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `$fb_tablename_users`" ) );
		$offset=$_GET[offset];
		if($offset =='')
			$offset = 0;
		$limit = 300;
		$pagenumber = intval($userscount/$limit);
		if(count($users)%$limit) {
			$pagenumber++;
		}
		if($limit > $userscount) {
			$limit = $userscount;
		}

		$users = $wpdb->get_results("SELECT * FROM `$fb_tablename_users` ORDER BY email ASC LIMIT $offset, $limit");

		$lp = $offset;
		$liv_add = 'no';
		_e('<h2>Users</h2>');
		echo '<table class="widefat">';
		echo '<thead><tr><th width="5">Lp.</th><th width="5">ID</th><th>Login</th><th>Email</th><th>F. name</th><th>F. Company</th><th>F. Phone</th><th>Other addres for livraison?</th><th>Confirmed?</th><th>Action</th></tr></thead>';
		foreach ($users as $u) :
			if ($u->status == 0) $confirmed='no';
			if ($u->status == 1) $confirmed='yes';
			if ( ($u->l_name != '') || ($u->l_address != '') ) {
				$liv_add='yes';
			} else {
				$liv_add='no';
			}
			$fb_delete_nonce = wp_create_nonce( 'fb-delete_' . $current );
			echo '<tr>
			<form name="fb_view_user" method="post" action="">
			<input type="hidden" name="action" value="fb_view_user" />
			<input type="hidden" name="fb_view_user_id" value="'.$u->id.'" />
			<td>'.$lp++.'</td><td>'.$u->id.'</td><td><input type="submit" name="fb_user_view" class="edit" value="'.$u->login.'"  /></td><td>'.$u->email.'</td><td>'.$u->f_name.'</td><td>'.$u->f_comp.'</td><td>'.$u->f_phone.'</td><td>'.$liv_add.'</td><td>'.$confirmed.'</td>
			<td>
			<input type="submit" name="fb_user_view" class="edit" value="View detail info"  />
			</form>
			<form name="fb_del_user" method="post" action="">
			<input type="hidden" name="action" value="fb_del_user" />
			<input type="hidden" name="fb_del_user_id" value="'.$u->id.'" />
			<input type="submit" name="fb_user_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {this.form._wpnonce.value = "'.$fb_delete_nonce.'"; return true;} return false;\' />
			</form></td>
			</tr>';
		endforeach;
		//paging
		echo("<tr><td colspan=8 >Page: ");
		for($i=1;$i<=$pagenumber;$i++) {
			$newpage=$limit*($i-1);
			if($offset!=$newpage) {
				echo '[<a href="admin.php?page=fb-users&type='.$_GET['type'].'&offset='.$newpage.$p_ord.'">'.$i.'</a>]';
			} else {
				echo "[$i]";
			}
		}
		echo '</table>';
	}
}

function fbadm_print_details($number) {
	global $wpdb;
	$prefix = $wpdb->prefix;
$resultaddcolumn = mysqli_query("SHOW COLUMNS FROM " . $prefix . "fbs_order LIKE 'poids'");
$existsaddcolumn = mysqli_num_rows($resultaddcolumn)?true:false;
if(!$existsaddcolumn) {
	$sql = "ALTER TABLE `" . $prefix . "fbs_order` ADD COLUMN `poids` VARCHAR (100) NULL DEFAULT 0 AFTER `status`;";
    $wpdb->query($sql);
}

    //$wpdb->query("ALTER TABLE `" . $prefix . "fbs_order` ADD COLUMN `poids` IF NOT EXISTS `poids` VARCHAR (100) NULL DEFAULT 0 AFTER `status`;");
   // mail("contact@tempopasso.com","SQL ALTER TABLE ligne 1873 ","ALTER TABLE `" . $prefix . "fbs_order` ADD COLUMN `poids` IF NOT EXISTS `poids` VARCHAR (100) NULL DEFAULT 0 AFTER `status`;");

	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_state = $prefix."fbs_state";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_mails = $prefix."fbs_mails";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_groupe_paiement = $prefix."fbs_paiement";
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";
	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
	$ktoryuser = $order->user;
	$tntuser = $order->user;

	if (isset($_POST['addcomment'])) {
		$tresc = addslashes($_POST['content']);
		$temat = addslashes($_POST['addcomment']);
		$data = date('Y-m-d H:i:s');
		$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$number."', '".$temat."', '".$data."', 'France Banderole', '".$tresc."')");
		$dodawanie_new = $wpdb->query("INSERT INTO `$fb_tablename_comments_new` VALUES (not null, '".$number."', '1')");
		$sprawdzcf = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '".$number."'");
		if ($sprawdzcf) {
			$apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='fb' WHERE unique_id='".$number."' AND type='lastupdate'");
		} else {
			$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$number."', 'lastupdate', 'fb')");
		}
	}
	if (isset($_POST['delcomment'])) {
		$ident = $_POST['delcomment'];
		$wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE id='$ident' AND order_id='$number'");
	}

    if (isset($_POST['changingtnt'])) {
        $newtnt = $_POST['tntn'];
        $newcompany = $_POST['shippingcompany'];

        $apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET tnt='$newtnt' WHERE unique_id='$number'");
        $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='shipping' AND unique_id = '$number'");
        if ($sprawdzshipping) {
            $apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='$newcompany' WHERE unique_id='$number' AND type='shipping'");
        } else {
            $dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'shipping', '" . $newcompany . "')");
        }
    }

    if (isset($_POST['btnSavePoids'])) {
        $poidsColis = $_POST['poids_commende'];
        $hasPoids = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$number'");
        if ($hasPoids) {
            $a = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='" . $poidsColis . "' WHERE unique_id='" . $number . "' and type='poids'");
        } else {
            //die ("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'poids', '" . $poidsColis . "')");
            $b = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'poids', '" . $poidsColis . "')");
        }
    }


	if (isset($_POST['zmianaplatnosci'])) {
		$newplat = $_POST['changeplatnosc'];
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET payment='$newplat' WHERE unique_id='$number'");
	}
	if (isset($_POST['changingstatus'])) {
		$newstat = $_POST['changestatus'];
		if ($newstat == 3) {
			$nowadata = date('Y-m-d H:i:s');
			$apdejt = $wpdb->update($fb_tablename_order, array ( 'status' => $newstat, 'date_modify' => $nowadata), array ( 'unique_id' => $number ) );
		} else {
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='$newstat' WHERE unique_id='$number'");
		}
	}





/* Passage en mode traitement */
if (isset($_POST['mode_traitement'])) {
traitement_passage_paiement_recu($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users);

    }
/* FIN Passage en mode traitement */


/* Passage en mode expedie */
if (isset($_POST['mode_expedie'])) {
traitement_passage_expedie($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address);

    }
/* FIN Passage en mode expedie */

/* Passage en mode cloturé */
if (isset($_POST['mode_cloture'])) {
traitement_passage_cloture($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address);

    }
/* FIN Passage en mode cloturé */


//usuwanie projektow
	if (isset($_POST['projectfile']) && $_POST['projectfile']!='') {
		unlink($_POST['projectfile']);
	}
    //usuwanie projektow
    if (isset($_POST['gettnt'])) {
        /* Nombre de colis */
        $nbcolis = $_POST['nbcolis'];
        $poidsColis = $_POST['poids_commende'];
        $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$number'");
        if ($sprawdzshipping) {
            $apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='$nbcolis' WHERE unique_id='$number' AND type='nbcolis'");
        } else {
            $dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'nbcolis', '" . $nbcolis . "')");
        }



        //$ttPoids = $wpdb->query("UPDATE `" . $prefix . "` SET poids='' where unique_id='$number'");

        /* On détermine si l'envoi est Fedex ou TNT pour l'appel de la bonne fonction de génération des fichiers d'expédition */
        $tnt_ou_fedex = $wpdb->get_var("SELECT value FROM `$fb_tablename_cf` WHERE type='shipping' AND unique_id = '$number'");
        if('tnt' == strtolower($tnt_ou_fedex)) {
		$BLXLSFile = il_y_a_fichier_BLXLS($number);
		if ($BLXLSFile != false) {
			$hasBLXLS = $BLXLSFile;
		} else {
			$hasBLXLS = false;
		}

		if($hasBLXLS != false) {
			include_once("fonc/fonc_extraireBLXSL.php");
			$path = $_SERVER['DOCUMENT_ROOT'];
			if($liste_bl = extraireBLXLS($path . '/uploaded/' . $number . '/BL.xls')) {
				getTnt_ZIP($_POST['gettnt'], $_POST['tntuser'],$liste_bl);
			}


		} else {
			getTnt($_POST['gettnt'], $_POST['tntuser']);
		}

        }elseif('fedex' == strtolower($tnt_ou_fedex)) {
            getFedex($_POST['gettnt'], $_POST['tntuser']);
        }else{
	        /* S'il n'y a pas de value, on fait rien */
        }

    }

	//Ajout nouveau produit
			if((isset($_POST['e_name_new1'])) AND ($_POST['e_name_new1'] != '')) {
				$e_name_new1 = $_POST['e_name_new1'];
				$e_description_new1 = $_POST['e_description_new1'];
				$e_quantity_new1 = $_POST['e_quantity_new1'];
				$e_prix_new1 = $_POST['e_prix_new1'];
				$e_option_new1 = $_POST['e_option_new1'];
				$e_remise_new1 = $_POST['e_remise_new1'];
				$e_total_new1 = $_POST['e_total_new1'];
				$e_frais_new1 = $_POST['e_frais_new1'];
				$add_prod = $wpdb->query("INSERT INTO `$fb_tablename_prods` VALUES('','$number','$e_name_new1','$e_description_new1','$e_quantity_new1','$e_prix_new1','$e_option_new1','$e_remise_new1','$e_total_new1','$e_frais_new1','',1)");

			}


    if (isset($_POST['editdet'])) {
        $count = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_prods` WHERE order_id = '$number'");
        for ($i = 1; $i < $count + 1; $i++) {
            $ktory = $_POST['c' . $i];
            $e_name = $_POST['e_name' . $ktory];
            $e_description = $_POST['e_description' . $ktory];
            $e_quantity = $_POST['e_quantity' . $ktory];
            $e_prix = $_POST['e_prix' . $ktory];
            $e_option = $_POST['e_option' . $ktory];
            $e_remise = $_POST['e_remise' . $ktory];
            $e_total = $_POST['e_total' . $ktory];
            $e_frais = $_POST['e_frais' . $ktory];
            $e_frais = str_replace(',', '.', $e_frais);
            $e_frais = number_format($e_frais, 2) . ' €';
            $apdejt = $wpdb->query("UPDATE `$fb_tablename_prods` SET name='$e_name', description='$e_description', quantity='$e_quantity', prix='$e_prix', prix_option='$e_option', remise='$e_remise', total='$e_total', frais='$e_frais' WHERE id='$ktory' AND order_id='$number'");
/// dodatkowy rabat do faktury

			$dodatkowyrabat = $_POST['totalht2after'];
            $dodatkowyrabatprzyczyna = $_POST['totalht2afterreason'];
            $czyjestwtabeli = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$number'");
            if ($czyjestwtabeli) {
                $zmienrabat = $wpdb->query("UPDATE `$fb_tablename_remises` SET remis='$dodatkowyrabat', reason='$dodatkowyrabatprzyczyna' WHERE unique_id='$number'");
            } else {
                if ($dodatkowyrabat != '') {
                    $dodajrabat = $wpdb->query("INSERT INTO `$fb_tablename_remises` VALUES (not null, '" . $number . "', '" . $dodatkowyrabat . "', '" . $dodatkowyrabatprzyczyna . "')");
                }
            }
/// dodatkowy rabat do faktury
/// zmiana podatku TVA
            if (isset($_POST['tvaafterreason']) && !($_POST['tvaafterreason'] == '')) {
                $zmianatva = $_POST['tvaafterreason'];
            } else {
                $zmianatva = '20.00';
            }
            $czytvajestwtabeli = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '" . $number . "-tva'");
            if ($czytvajestwtabeli) {
                $zmientva = $wpdb->query("UPDATE `$fb_tablename_remises` SET remis='$zmianatva', reason='tva' WHERE unique_id='" . $number . "-tva'");
            } else {
                $dodajtva = $wpdb->query("INSERT INTO `$fb_tablename_remises` VALUES (not null, '" . $number . "-tva', '" . $zmianatva . "', 'tva')");
            }
/// zmiana podatku TVA
            reorganize_votre($number);
        }
    }

	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
    $uzyt = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$ktoryuser'");
    if (isset($_POST['sendmail'])) {
        $temat = htmlspecialchars_decode($_POST['hiddentopic']);
        $zawar = htmlspecialchars_decode($_POST['selmailcontent']);
        $header = 'From: FRANCE BANDEROLE <info@france-banderole.fr>';
        $header .= "\nContent-type: text/html; charset=UTF-8\n" . "Content-Transfer-Encoding: 8bit\n";
        //mail($uzyt->email, stripslashes($temat), stripslashes($zawar), $header);
        //mail("contact@tempopasso.com", "ESSAI ENVOI MAIL=".stripslashes($temat), stripslashes($zawar), $header);
        //wp_mail($uzyt->email, stripslashes($temat), stripslashes($zawar),$header);
        mail($uzyt->email, stripslashes($temat), stripslashes($zawar),$header);
        //mail('floroux.int@gmail.com', stripslashes($temat), stripslashes($zawar),$header);
    }

	//Traitement du changement de groupe
	if (isset($_POST['set_group'])) {
		$new_group = $_POST['cl_group'];
		if($_POST['group_act'] == 'edit') {
		//Edition du groupe
			$edit_group = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value = '".$new_group."' WHERE uid = '".$ktoryuser."' AND att_name='client_groupe'");
			if($edit_group) {
				$group_ret = '<p><strong>Le groupe a bien été édité avec succès.</strong></p>';
			}
		} else if($_POST['group_act'] == 'set') {
		//Initialisation du group
			$add_group = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$ktoryuser."','client_groupe','".$new_group."')");
			if($add_group) {
				$group_ret = '<p><strong>Le groupe a bien été édité avec succès.</strong></p>';
			}
		}


	}

    $statusy = $wpdb->get_results("SELECT * FROM `$fb_tablename_state` ORDER BY value ASC", ARRAY_A);
    $topics = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` ORDER BY content ASC", ARRAY_A);
    $prod = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id = '$number'", ARRAY_A);
    $mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails`", ARRAY_A);
    echo '<div class="form-wrap"><div id="col-container">';
    echo '<div id="col-right" style="width:29%;margin-top:30px;">';

	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Définir le groupe utilisateur:</span></h3><div class="inside">';
    //Traitement des données de groupe


	$user_group = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$ktoryuser."' AND att_name = 'client_groupe'");
	if (isset($group_ret)) {
		echo $group_ret;
	}
	if($user_group) {
		$group_desc = $wpdb->get_row("SELECT * FROM `$fb_tablename_groupe_paiement` WHERE code = '".$user_group->att_value."'");
		echo '<p>Le client appartient au groupe <strong>'.$group_desc->description.'</strong>.</p>';
	} else {
		echo '<p>Le client n\'est associé à aucun groupe.</p>';
	}
	echo '<form name="set_group" id="set_group" action="" method="post"><input type="hidden" name="set_group" />';
	if($user_group) {
		echo '<input type="hidden" name="group_act" value="edit" />';
	} else {
		echo '<input type="hidden" name="group_act" value="set" />';
	}

	echo '<select name="cl_group">';
		$group_list = $wpdb->get_results("SELECT * FROM `$fb_tablename_groupe_paiement`");
		foreach ($group_list as $group) {
			if(($user_group) AND ($user_group->att_value == $group->code)) {
				echo '<option value="'.$group->code.'" selected>'.$group->description.'</option>';
			} else {
				echo '<option value="'.$group->code.'">'.$group->description.'</option>';
			}
		}

	echo '</select>';
	echo '<br /><input type="submit" value="Sauvegarder" />';
    echo '</form>';

    echo '<div style="clear:both"></div></div></div></div>';



    echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Send mail for user:</span></h3><div class="inside">';
    echo '<form name="sendmail" id="sendmail" action="" method="post"><input type="hidden" name="sendmail" /><input type="hidden" name="hiddentopic" value="" /><select name="selmailtopic" onchange="this.form.selmailcontent.innerHTML = this.value; this.form.hiddentopic.value = this.options[selectedIndex].text;" style="float:left"><option value="">choisir...</option>';
    foreach ($mails as $ma) :
        $con = stripslashes($ma[content]);
        $con = htmlspecialchars($con);
        $top = stripslashes($ma[topic]);
        $top = htmlspecialchars($top);
        echo '<option value="' . $con . '">' . $top . '</option>';
    endforeach;
    echo '</select><textarea name="selmailcontent" id="incon"></textarea><input type="submit" value="SEND" class="savebutt3" /></form>';
    echo '<div style="clear:both"></div></div></div></div>';
    /* komentarze -dodawanie */
    echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new comment:</span></h3><div class="inside">';

    echo '<form name="newcomm" id="newcomm" action="" method="post"><input type="hidden" name="addcomment" />';
    if ($topics) {
        echo '<select name="selecttopic" id="seltopic" onchange="nicEditors.findEditor(\'incon2\').setContent(this.value); this.form.addcomment.value = this.options[selectedIndex].text;"><option value="">choisir...</option>';
        foreach ($topics as $t) :
            $cont = stripslashes($t[content]);
			$cont = htmlspecialchars($cont);
			$c_order   = array("\r\n", "\n", "\r");
			$c_replace = '<br />';
			$cont = str_replace($c_order, $c_replace, $cont);

            $topt = stripslashes($t[topic]);
            $topt = htmlspecialchars($topt);
            echo '<option value="' . $cont . '"' . $s . '>' . $topt . '</option>';
        endforeach;
        echo '</select>';
		echo '<br /><br />';
    }
	?>


		<script type="text/javascript" src="//dev.france-banderole.com/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor().panelInstance('incon2');
				});
			</script>


	<?php



    echo '<textarea name="content" id="incon2"></textarea>';
    echo '<input type="submit" value="SAVE" class="savebutt3" />';
    echo '</form>';
    echo '<div style="clear:both"></div></div></div></div>';
    /* wyswietlanie komentarzy */
    $comments = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y %H:%i') AS data FROM `$fb_tablename_comments` WHERE order_id = '$number' ORDER BY date DESC", ARRAY_A);
    if ($comments) {
        foreach ($comments as $c) :
            echo '<div class="comment_right"><span class="comm_title2">Date:</span>&nbsp;' . $c[data] . '<span class="comm_title3">Expediteur:</span>&nbsp;' . $c[author] . '<p class="sujet"><span class="comm_title2">Sujet:</span>&nbsp;' . $c[topic] . '</p>' . nl2br($c[content]) . '';
            echo '<form name="delco" action="" method="post" style="text-align:right;margin-right:5px;"><input type="hidden" name="delcomment" value="' . $c[id] . '" /><input type="submit" value="delete" onclick=\'if (confirm("' . esc_js("Are you sure?") . '")) {return true;} return false;\' /></form></div>';
        endforeach;
    }
    echo '</div>';
    /* wyswietlanie lewej tabeli */
    $explode = explode('|', $uzyt->f_address);
    $f_address = $explode['0'];
    $f_porte = $explode['1'];
    $explode2 = explode('|', $uzyt->l_address);
    $l_address = $explode2['0'];
    $l_porte = $explode2['1'];
    $adresdostawy = $uzyt->l_name . '<br />' . $uzyt->l_comp . '<br />' . $l_address . '<br />' . $l_porte . '<br />' . $uzyt->l_code . '<br />' . $uzyt->l_city . '<br />' . $uzyt->l_phone;
    $useraddress = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$number'");
    if ($useraddress) {
        $explode2 = explode('|', $useraddress->l_address);
        $l_address = $explode2['0'];
        $l_porte = $explode2['1'] . '<br />';
        $adresdostawy = $useraddress->l_name . '<br />' . $useraddress->l_comp . '<br />' . $l_address . '<br />' . $l_porte . $useraddress->l_code . '<br />' . $useraddress->l_city . '<br />' . $useraddress->l_phone;
    }
    /* mail("contact@tempopasso.com","TEST fb_admin adresse LIV","SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$number'".print_r($useraddress,true)."///adresdostawy=".$adresdostawy); */
    //Rajouter le bon formulaire pour lien vers fb-user-report

	echo '<div id="col-left" style="width:70%;"><div style="float:right;display:inline;margin-left:20px;padding:5px;width:30%;height:180px;border:1px solid #ccc;margin-top:60px;font-size:11px;line-height:14px;"><b>Adresse de livraison:</b><br />' . $adresdostawy . '</div>';
	$user_siret = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$ktoryuser."' AND att_name = 'client_siret'");
	$user_epub = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$ktoryuser."' AND att_name = 'client_epub'");
	if(!($user_siret)) {
		$user_siret = '';
	} else {
		$user_siret = $user_siret->att_value.'<br />';
	}
	if(!($user_epub)) {
		$user_epub = '';
	} else {
		$user_epub = $user_epub->att_value.'<br />';
	}


	echo '<div style="float:right;display:inline;width:30%;padding:5px;height:180px;border:1px solid #ccc;margin-top:60px;font-size:11px;line-height:14px;"><b>Adresse de facturation:</b><br /><form method="post" action="admin.php?page=fb-reports-users" target="_blank"><input type="hidden" name="user_login" value="'.$ktoryuser.'" /><input type="hidden" name="pokaztab" /><input type="submit" class="edit" value="'.$uzyt->login.'"></form>';
	if($user_siret != '') {
		echo 'SIRET : '.$user_siret.'<br />';
	}
	if($user_epub != '') {
		echo 'Trésor public payeur : <br />'.$user_epub.'<br />';
	}

	echo $uzyt->email . '<br />' . $uzyt->f_name . '<br />' . $uzyt->f_comp . '<br />' . $f_address . '<br />' . $f_porte . '<br />' . $uzyt->f_code . '<br />' . $uzyt->f_city . '<br />' . $uzyt->f_phone . '</div>';
    echo '<h3>N° DE COMMANDE: ' . $order->unique_id . '</h3>';
    echo '<p style="margin-bottom:20px"><b>Date created: </b>' . $order->date . '<br />';
    if (($order->status > 2) AND ($order->status < 7)) {
        echo '<b>Date on invoice: </b>' . $order->date_modify . '</p>';
    }
    //$ktoryshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$number'");
    $ktoryshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$number' AND type='shipping'");
	//mail("contact@tempopasso.com","Record Shipping Company // ","requete="."SELECT * FROM ".$fb_tablename_cf." WHERE unique_id = ".$number."  ");
    if (($ktoryshipping) && ($ktoryshipping->value != '0')) {

		if (strtolower($ktoryshipping->value) == 'tnt') {
            $ship1 = ' selected="selected" ';
            $ship2 = '';
            $ship3 = '';
			$ship4 = '';
            $lien_check_status = 'https://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?btnSubmit=&radiochoixrecherche=BT&bonTransport=' . $order->tnt . '&radiochoixtypeexpedition=NAT';
            $texte_check_status = "TNT";

        }
        if (strtolower($ktoryshipping->value) == 'ciblex') {
            $ship1 = '';
            $ship2 = ' selected="selected" ';
            $ship3 = '';
			$ship4 = '';
        }
        if (strtolower($ktoryshipping->value) == 'fedex') {
            $ship1 = '';
            $ship2 = '';
            $ship3 = ' selected="selected" ';
			$ship4 = '';
            //$lien_check_status = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber='.$order->tnt.'&cntry_code=fr';
            $lien_check_status = 'https://france.fedex.com/te/webapp25?&trans=tesow350&action=recherche_complete&NUM_COLIS=' .$number;
            $texte_check_status = "FEDEX";
        }
		if (strtolower($ktoryshipping->value) == 'autre') {
            $ship1 = '';
            $ship2 = '';
            $ship3 = '';
			$ship4 = ' selected="selected" ';
            $lien_check_status = $order->tnt;
            $texte_check_status = "AUTRE";
        }
    }



/* Ajout des fonction d'optimisation d'admin */

/* Commande en attente de paiement puis passage en paiement reçu*/
//if(($order->status==2 && $order->payment=="carte") || $order->status==1 ){
if($order->status==2 || $order->status==1 ){
	passage_paiement_recu();
}


if($order->status==4){
	passage_cloture();
}




/* FIN Ajout des fonction d'optimisation d'admin */
    /* Nombre de colis */
    $nbcolis = "1";
    $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$order->unique_id'");
    if ($sprawdzshipping) {
        $nbcolis = $sprawdzshipping->value;
    } else {
        $nbcolis = "1";
    }

    $pdColis = "0";
    $pColis = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$order->unique_id'");
    if ($pColis) {
        $pdColis = $pColis->value;
    } else {
        $pdColis = "0";
    }

    $code_tnt_bon = "";
    $code_tnt_bon = $order->tnt;
    if ($code_tnt_bon == "") {
        $code_tnt_bon = substr(($useraddress->l_code == "" ? $uzyt->f_code : $useraddress->l_code), 0, 2) . "48904205";
    }

	echo '<div class="statusp4"><form name="numertnt" id="numertnt" action="" method="post"><input type="hidden" name="changingtnt" />
<p><label for="shippingcompany"><b>Shipping company: </b></label>
                    <select name="shippingcompany" id="shippingcompany">
                        <option value="0">select...</option>
                        <option value="tnt"' . $ship1 . '>TNT</option>
                        <option value="Fedex"' . $ship3 . '>FEDEX</option>
						<option value="autre"' . $ship4 . '>AUTRE</option>
                    </select></p>





<p><label for="tntn"><b>Number: </b></label>
<input type="text" name="tntn" id="tntn" value="'.$code_tnt_bon.'" />
<input type="submit" value="SAVE" class="savebutt4" /></p></form>
<form name="gettntform" id="gettntform" action="" method="post"><input type="hidden" name="gettnt" value="'.$order->unique_id.'" /><input type="hidden" name="tntuser" value="'.$tntuser.'" />
<p><label for="nbcolis"><b>NB COLIS: </b><input type="text" name="nbcolis" id="nbcolis" value="'.$nbcolis.'" maxlength="4" size="4" /></label></p>
                <p style="width:100%;display:block;text-align:center;"><a href="'.$lien_check_status.'" target="_blank" style="margin:0 auto;padding:1px 3px;background-color: white;font-size: 12px;color: black;height: 14px;font-style:normal;text-decoration:none;">CHECK '.$texte_check_status.' STATUS</a></p>
                <p style="margin: 5px auto; display: block;">
                    <label for="poids_commende">
                        <b>POIDS : </b>
                        <input style="width: 124px;" type="text" id="poids_commende" name="poids_commende" value="' . $pdColis . '" />
                        <input type="submit" name="btnSavePoids" value="Save" />
                    </label>
                </p>
<p><input type="submit" value="IMPRIMER ETIQUETTE TRANSPORT" style="margin:5px 0 0 8px;" /></p>
</form>
</div>';
	echo '<div class="statusp"><form name="zmianastatusu" id="zmianastatusu" action="" method="post"><input type="hidden" name="changingstatus" /><label for="changestatus"><b>Status: </b></label><select name="changestatus" id="changestatus">';
	$i = 0;
	$select_pre = '';
	$select_post = '';
	$select_inter = '';
	foreach ($statusy as $stat) :
		$i++;
		if ($stat[value] == $order->status) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		if($i == 8) {
			$select_inter .= '<option value="'.$stat[value].'"'.$sel.'>'.$stat[status].'</option>';
		} else if ($i <= 3) {
			$select_pre .= '<option value="'.$stat[value].'"'.$sel.'>'.$stat[status].'</option>';
		} else if ($i > 3) {
			$select_post .= '<option value="'.$stat[value].'"'.$sel.'>'.$stat[status].'</option>';
		}
	endforeach;
	echo $select_pre.$select_inter.$select_post;
	echo '</select><input type="submit" value="SAVE" class="savebutt2" /></form></div>';
// wysylanie plikow
	echo '<div class="statusp2">Upload <a href="//dev.france-banderole.com/wp-content/plugins/fbshop/frmupload2.php?cmd='.$order->unique_id.'&usr='.$uzyt->login.'&isproject=true&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=450&width=500&modal=true" class="thickbox but_par">PARCOURIR</a><br />';
	$name=$_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$order->unique_id.'-projects';
	$fichiers="";
	if(file_exists($name))
	if ($dir = @opendir($name)) {
	    while(($file = readdir($dir))) {
			if(!is_dir($file) && !in_array($file, array(".",".."))) {
				$fichiers.='<span class="singlefile">'.$file.'</span><form name="deleteproject" class="deleteproject" action="" method="post"><input type="hidden" name="projectfile" value="'.$name.'/'.$file.'" /><input type="submit" class="deleteprojectfile" value=""  onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br />';
			}
    	}
	    closedir($dir);
  	}
	echo $fichiers;
	echo '</div>';
// wysylanie plikow


/* Commande en traitement puis passage en expédié */
if($order->status==3 ){
	passage_expedie();
}


// forma platnosci
	echo '<div class="statusp"><form name="formaplatnosci" id="formaplatnosci" action="" method="post"><input type="hidden" name="zmianaplatnosci" /><label for="changeplatnosc"><b>Paied: </b></label><select name="changeplatnosc" id="changeplatnosc">';
	$fplatnosci = array('carte'=>'Carte bleue', 'cheque'=>'Chèque', 'bancaire'=>'Vire bancaire', 'administratif'=>'Vire administratif', 'espece'=>'Espèce', 'trente'=>'Paiement à 30 jours', 'soixante'=>'Paiement à 60 jours');
		echo '<option value="">CHOIX</option>';
	foreach ($fplatnosci as $plat=>$key) :
		if ($plat == $order->payment) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		echo '<option value="'.$plat.'"'.$sel.'>'.$key.'</option>';
	endforeach;
	echo '</select><input type="submit" value="SAVE" class="savebutt2" /></form></div>';

	if(($order->payment_ch != '') AND ($order->status == 7)) {
		$pay_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement_moy` WHERE pay_code = '$order->payment_ch'");
		echo '<div class="statusp"><b>Moyen de paiement choisi: </b><br />'.$pay_name->pay_designation.'</div>';

	}




	echo '<div class="statusp"><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbbonprint='.$number.'" target="_blank" class="but_par">Imprimer BL</a><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$number.'" target="_blank" class="but_par">Imprimer facture</a><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbinvoiceproprint='.$number.'" target="_blank" class="but_par">PRO</a></div>';

// forma platnosci

	echo '<form name="editdetails" id="editdetails" action="" method="post"><input type="hidden" name="editdet" value="'.$number.'" />';
	echo '<p><small>Please note that:<br />Description lines should contain break lines marker &lt;br /&gt;<br />Total sum couldn\'t contain Frais de port cost.</small></p>';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>ITEM</th><th style="width:150px;">DESCRIPTION</th><th>QUANTITÉ</th><th>PRIX U.</th><th>OPTION</th><th>REMISE</th><th>TOTAL</th><th>FRAIS DE PORT</th><th>FILE(S)</th></tr></thead>';
	$ilosc=0;
	foreach ($prod as $p) :
		$ilosc++;
		echo '<input type="hidden" name="c'.$ilosc.'" value="'.$p[id].'" />';
		$isdeleted='';
		$filepath='';
		$pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/';
		if(file_exists($pathfiles))
		if ($dir = @opendir($pathfiles)) {
		    while(($file = readdir($dir))) {
				if(!is_dir($file) && !in_array($file, array(".",".."))) {
					$filepath .= '<a href="'.get_bloginfo("url").'/uploaded/'.$number.'/'.$file.'" target="_blank">'.$file.'</a><br />';
				}
    		}
	    	closedir($dir);
  		}
		$frais = str_replace('.', ',', $p[frais]);
		if ($p[status] == 0) {
			$p[name] = '<s style="color:red;">'.$p[name].'</s><br /><small><b>deleted by user!</b></small>';
			$isdeleted = ' style="background:#ccc;"';
		}
		echo '<tr'.$isdeleted.'><td><input type="text" name="e_name'.$p[id].'" value="'.$p[name].'" /></td><td><textarea cols="18" rows="7" name="e_description'.$p[id].'" style="font-size:10px">'.$p[description].'</textarea></td><td><input type="text" name="e_quantity'.$p[id].'" value="'.$p[quantity].'" /></td><td><input type="text" name="e_prix'.$p[id].'" value="'.$p[prix].'" /></td><td><input type="text" name="e_option'.$p[id].'" value="'.$p[prix_option].'" /></td><td><input type="text" name="e_remise'.$p[id].'" value="'.$p[remise].'" /></td><td><input type="text" name="e_total'.$p[id].'" value="'.$p[total].'" /></td><td><input type="text" name="e_frais'.$p[id].'" value="'.$frais.'" /></td><td>'.$filepath.'</td></tr>';
	endforeach;

	//Début du formulaire d'ajout de produit

	echo '<tr><td colspan="9" style="text-align: left;"><span id="add_1"><a onClick=\'jQuery("#new_1").toggle("slow");jQuery("#add_1").toggle("slow");\' style="cursor: pointer;">Ajouter un produit à la commande</a></span></td></tr>';
	echo '<tr id="new_1" style="display: none;"><td><input type="text" name="e_name_new1" /></td><td><textarea cols="18" rows="7" name="e_description_new1" style="font-size:10px;" placeholder="Décrivez votre produit"></textarea></td><td><input type="text" name="e_quantity_new1" /></td><td><input type="text" name="e_prix_new1" /></td><td><input type="text" name="e_option_new1" /></td><td><input type="text" name="e_remise_new1"></td><td><input type="text" name="e_total_new1" /></td><td><input type="text" name="e_frais_new1" /></td><td><a onClick=\'jQuery("#new_1").toggle("slow");jQuery("#add_1").toggle("slow");\' style="cursor: pointer;">Supprimer</a></td></tr>';

	// echo '<tr><td colspan="9" style="text-align: left;"><span id="add_1"><a onClick=\'jQuery("#new_1").toggle("slow");jQuery("#add_1").toggle("slow");jQuery("#add_2").toggle("slow");\'>Ajouter un produit à la commande</a></span></td></tr>';
	// echo '<tr id="new_1" style="display: none;"><td><input type="text" name="e_name_new1" /></td><td><textarea cols="18" rows="7" name="e_description_new1" style="font-size:10px;" placeholder="Décrivez votre produit"></textarea></td><td><input type="text" name="e_quantity_new1" /></td><td><input type="text" name="e_prix_new1" /></td><td><input type="text" name="e_option_new1" /></td><td><input type="text" name="e_remise_new1"></td><td><input type="text" name="e_total_new1" /></td><td><input type="text" name="e_frais_new1" /></td><td></td></tr>';
	// echo '<tr><td colspan="9" style="text-align: left;"><span id="add_2" style="display: none;"><a onClick=\'jQuery("#new_2").toggle("slow");jQuery("#add_2").toggle("slow");jQuery("#add_3").toggle("slow");\'>Ajouter un produit à la commande</a></span></td></tr>';
	// echo '<tr id="new_2" style="display: none;"><td><input type="text" name="e_name_new2" /></td><td><textarea cols="18" rows="7" name="e_description_new2" style="font-size:10px;" placeholder="Décrivez votre produit"></textarea></td><td><input type="text" name="e_quantity_new2" /></td><td><input type="text" name="e_prix_new2" /></td><td><input type="text" name="e_option_new2" /></td><td><input type="text" name="e_remise_new2"></td><td><input type="text" name="e_total_new2" /></td><td><input type="text" name="e_frais_new2" /></td><td></td></tr>';
	// echo '<tr><td colspan="9" style="text-align: left;"><span id="add_3" style="display: none;"><a onClick=\'jQuery("#new_3").toggle("slow");jQuery("#add_3").toggle("slow");\'>Ajouter un produit à la commande</a></span></td></tr>';
	// echo '<tr id="new_3" style="display: none;"><td><input type="text" name="e_name_new3" /></td><td><textarea cols="18" rows="7" name="e_description_new3" style="font-size:10px;" placeholder="Décrivez votre produit"></textarea></td><td><input type="text" name="e_quantity_new3" /></td><td><input type="text" name="e_prix_new3" /></td><td><input type="text" name="e_option_new3" /></td><td><input type="text" name="e_remise_new3"></td><td><input type="text" name="e_total_new3" /></td><td><input type="text" name="e_frais_new3" /></td><td></td></tr>';

//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$number'");
			if ($exist_remise) {
		  		$wysokoscrabatu = str_replace('.', ',', number_format($exist_remise->remisenew, 2));
//				$cremisetd = '<tr><td class="toleft">REMISE ('.$.'%)</td><td class="toright">'.$wysokoscrabatu.' &euro;</td></tr>';
				echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">REMISE ('.$exist_remise->percent.'%):</td><td>'.str_replace('.', ',', $wysokoscrabatu).' &euro;</td></tr>';
			}
//koniec//
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">FRAIS DE PORT:</td><td colspan="1">'.str_replace('.', ',', $order->frais).' &euro;</td></tr>';
	$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$number'");
	$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$number."-tva'");
	if ($czyjesttva) {
		$procpod = $czyjesttva->remis;
	} else {
		$procpod = '20.00';
	}
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">DELAI RUSH OR DISCOUNT (INSERT POSITIVE OR NEGATIVE VALUE):</td><td colspan="1"><input name="totalht2after" type="text" value="'.$czyjestrabat->remis.'" width="5" /> &euro;</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="1" style="text-align:right">THE REASON OF ADDING DELAI RUSH OR DISCOUNT:</td><td colspan="2"><input name="totalht2afterreason" type="text" value="'.$czyjestrabat->reason.'" style="width:200px;" /></td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">TVA %:</td><td colspan="1"><input name="tvaafterreason" type="text" value="'.$procpod.'" width="5" /> %</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">TOTAL HT:</td><td colspan="1">'.str_replace('.', ',', $order->totalht).' &euro;</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">MONTANT TVA ('.$procpod.'%):</td><td>'.str_replace('.', ',', $order->tva).' &euro;</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">TOTAL TTC:</td><td colspan="1">'.str_replace('.', ',', $order->totalttc).' &euro;</td></tr>';
	echo '</table>';
	echo '<input type="submit" value="SAVE" class="savebutt" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form>';
	echo '</div>';
	echo '</div><p><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh">Go back</a></p>';
}

function fb_admin_promotions() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_promo";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'wp-content/uploads/shopfiles/promotions/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'wp-content/uploads/shopfiles/promotions/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = $_POST['prom_content'];
		$p_price = $_POST['prom_price'];
		$p_ceddre = $_POST['prom_ceddre'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 147) || ($wysm > 50) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(147);
						$wysom = $imagem->getHeight();
						if ($wysom > 50) {
				      		$imagem->resizeToHeight(50);
						}
					} else {
	    		  		$imagem->resizeToHeight(50);
						$szerom = $imagem->getWidth();
						if ($wysom > 50) {
				      		$imagem->resizeToWidth(147);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				} else {
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				}
			} else {
     			$image = new SimpleImage();
      			$image->load($_FILES['uploadfile']['tmp_name']);
				$szer = $image->getWidth();
				$wyso = $image->getHeight();
				if ( ($szer > 147) || ($wys > 50) ) {
					if ($szer > $wys) {
		    	  		$image->resizeToWidth(147);
						$wyso = $image->getHeight();
						if ($wyso > 50) {
				      		$image->resizeToHeight(50);
						}
					} else {
	    		  		$image->resizeToHeight(50);
						$szero = $image->getWidth();
						if ($wyso > 50) {
				      		$image->resizeToWidth(147);
						}
					}
		      		$image->save($path_mini.$rand.$f['name']);
					$nazwaplikumini = $rand.$f['name'];
				} else {
					$f = $_FILES['uploadfile'];
					$kopiowanie = copy($f['tmp_name'], $path_mini.$rand.$f['name']);
					$nazwaplikumini = $rand.$f['name'];
				}
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$nazwapliku."', '".$nazwaplikumini."')");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';
/* promocje -dodawanie */
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new promotion:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>Image: <small>(JPEG/PNG/GIF)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 145x50px, if no thumbnail we\'ll create it automatically)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div></div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>CEDDRE</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo`", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/promotions/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_ceddre.'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form></td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}








function fb_admin_plv() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_plv";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/plv/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/plv/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 151) || ($wysm > 76) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(151);
						$wysom = $imagem->getHeight();
						if ($wysom > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($wysom > 76) {
				      		$imagem->resizeToWidth(151);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				} else {
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				}
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '".$p_order."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$nazwaplikumini = '';
		$nazwapliku = '';
		$edytuj_id = $_POST['editpromotion'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if ( !empty($f['name']) || $f['name'] != '') {
				$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
				if (!$kopiowanie) {
					$rand = rand(0, 100);
					$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$nazwapliku = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$nazwapliku' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 			$imagem = new SimpleImage();
      				$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$szerm = $imagem->getWidth();
					$wysom = $imagem->getHeight();
					if ( ($szerm > 151) || ($wysm > 76) ) {
						if ($szerm > $wysm) {
			    	  		$imagem->resizeToWidth(151);
							$wysom = $imagem->getHeight();
							if ($wysom > 76) {
					      		$imagem->resizeToHeight(76);
							}
						} else {
	    			  		$imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($wysom > 76) {
					      		$imagem->resizeToWidth(151);
							}
						}
			      		$imagem->save($path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					} else {
						$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$nazwaplikumini' WHERE id='$edytuj_id'");
				}
			}
		}
//		$updateowanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '1')");
		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

if (isset($_POST[editplv])) {
	$editid = $_POST[editplv];
	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit plv:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" value="'.$ed->subname.'" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" value="'.$ed->ceddre.'" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
	echo '</div></div></div>';

/* promocje -dodawanie */
} else {
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new plv:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div>';
}

	echo '</div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		$n_frais = str_replace('.', ',', $p[frais]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p[order].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editplv" value="'.$p[id].'" /><input type="submit" class="delete" value="Edit" /></form>
		</td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}




function fb_admin_plv_int() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_plv_int";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/plv/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/plv/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 151) || ($wysm > 76) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(151);
						$wysom = $imagem->getHeight();
						if ($wysom > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($wysom > 76) {
				      		$imagem->resizeToWidth(151);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				} else {
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				}
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '".$p_order."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$nazwaplikumini = '';
		$nazwapliku = '';
		$edytuj_id = $_POST['editpromotion'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if ( !empty($f['name']) || $f['name'] != '') {
				$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
				if (!$kopiowanie) {
					$rand = rand(0, 100);
					$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$nazwapliku = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$nazwapliku' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 			$imagem = new SimpleImage();
      				$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$szerm = $imagem->getWidth();
					$wysom = $imagem->getHeight();
					if ( ($szerm > 151) || ($wysm > 76) ) {
						if ($szerm > $wysm) {
			    	  		$imagem->resizeToWidth(151);
							$wysom = $imagem->getHeight();
							if ($wysom > 76) {
					      		$imagem->resizeToHeight(76);
							}
						} else {
	    			  		$imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($wysom > 76) {
					      		$imagem->resizeToWidth(151);
							}
						}
			      		$imagem->save($path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					} else {
						$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$nazwaplikumini' WHERE id='$edytuj_id'");
				}
			}
		}
//		$updateowanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '1')");
		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

if (isset($_POST[editplv])) {
	$editid = $_POST[editplv];
	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit plv:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" value="'.$ed->subname.'" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" value="'.$ed->ceddre.'" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
	echo '</div></div></div>';

/* promocje -dodawanie */
} else {
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new plv:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div>';
}

	echo '</div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		$n_frais = str_replace('.', ',', $p[frais]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p[order].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editplv" value="'.$p[id].'" /><input type="submit" class="delete" value="Edit" /></form>
		</td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}




function fb_admin_buraliste() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_buraliste";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/buraliste/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/buraliste/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];

		/* Ajout du champ Réduction: reduc*/
        $p_reduc = $_POST['prom_reduc'];
		/* Ajout du champ Ruban: ruban_couleur*/
        $p_ruban_couleur = $_POST['prom_ruban_couleur'];
		/* Ajout du champ Ruban: ruban_texte*/
        $p_ruban_texte = $_POST['prom_ruban_texte'];

		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);

                /*$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 151) || ($wysm > 76) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(151);
						$wysom = $imagem->getHeight();
						if ($wysom > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($wysom > 76) {
				      		$imagem->resizeToWidth(151);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				} else {*/
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				/*}*/
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '".$p_order."', '".$p_reduc."', '".$p_ruban_couleur."', '".$p_ruban_texte."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];

		/* Ajout du champ Réduction: reduc */
        $p_reduc = $_POST['prom_reduc'];
		/* Ajout du champ Ruban: ruban_couleur */
        $p_ruban_couleur = $_POST['prom_ruban_couleur'];
		/* Ajout du champ Ruban: ruban_texte */
        $p_ruban_texte = $_POST['prom_ruban_texte'];

		$nazwaplikumini = '';
		$nazwapliku = '';
		$edytuj_id = $_POST['editpromotion'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if ( !empty($f['name']) || $f['name'] != '') {
				$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
				if (!$kopiowanie) {
					$rand = rand(0, 100);
					$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$nazwapliku = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$nazwapliku' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 			$imagem = new SimpleImage();
      				$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					/*$szerm = $imagem->getWidth();
					$wysom = $imagem->getHeight();
					if ( ($szerm > 151) || ($wysm > 76) ) {
						if ($szerm > $wysm) {
			    	  		$imagem->resizeToWidth(151);
							$wysom = $imagem->getHeight();
							if ($wysom > 76) {
					      		$imagem->resizeToHeight(76);
							}
						} else {
	    			  		$imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($wysom > 76) {
					      		$imagem->resizeToWidth(151);
							}
						}
			      		$imagem->save($path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					} else {*/
						$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					/*}*/
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$nazwaplikumini' WHERE id='$edytuj_id'");
				}
			}
		}
//		$updateowanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '1')");
		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order', `reduc` = '$p_reduc', `ruban_couleur` = '$p_ruban_couleur', `ruban_texte` = '$p_ruban_texte' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

if (isset($_POST[editburaliste])) {
	$editid = $_POST[editburaliste];
	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit buraliste:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />
    <input type="hidden" name="prom_type" value="'.$fb_tablename_promo.'" />
    ';
	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" value="'.$ed->subname.'" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" value="'.$ed->ceddre.'" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Réduction: <input type="text" size="10" name="prom_reduc" value="'.$ed->reduc.'" />&euro; (laisser vide si non utilisé)</p>';
	//print_r($ed);
	echo '<p>Ruban: <select name="prom_ruban_couleur">
    					<option value="" '.($ed->ruban_couleur==""?"selected=selected":"").' >Aucun ruban</option>
    					<option value="ribbon-yellow" '.($ed->ruban_couleur=="ribbon-yellow"?"selected=selected":"").'>Jaune</option>
    					<option value="ribbon-green" '.($ed->ruban_couleur=="ribbon-green"?"selected=selected":"").'>Vert</option>
    					<option value="ribbon-orange" '.($ed->ruban_couleur=="ribbon-orange"?"selected=selected":"").'>Orange</option>
    					<option value="ribbon-red" '.($ed->ruban_couleur=="ribbon-red"?"selected=selected":"").'>Rouge</option>
    					<option value="ribbon-blue-light" '.($ed->ruban_couleur=="ribbon-blue-light"?"selected=selected":"").'>Bleu ciel</option>
    					<option value="ribbon-blue" '.($ed->ruban_couleur=="ribbon-blue"?"selected=selected":"").'>Bleu</option>
    					<option value="ribbon-blue-mms" '.($ed->ruban_couleur=="ribbon-blue-mms"?"selected=selected":"").'>Bleu foncé</option>
    					<option value="ribbon-purple" '.($ed->ruban_couleur=="ribbon-purple"?"selected=selected":"").'>Violet</option>
    					<option value="ribbon-pink" '.($ed->ruban_couleur=="ribbon-pink"?"selected=selected":"").'>Rose</option>
    					<option value="ribbon-black" '.($ed->ruban_couleur=="ribbon-black"?"selected=selected":"").'>Noir</option>
                    </select>
    ';
    echo '<p>Texte du ruban: <input type="text" name="prom_ruban_texte" value="'.$ed->ruban_texte.'" /></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
	echo '</div></div></div>';

/* promocje -dodawanie */
} else {
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new buraliste:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<p>Réduction: <input type="text" size="10" name="prom_reduc" value="" />&euro; (laisser vide si non utilisé)</p>';
	echo '<p>Ruban: <select name="prom_ruban_couleur">
    					<option value="" selected="selected" >Aucun ruban</option>
    					<option value="ribbon-yellow">Jaune</option>
    					<option value="ribbon-green">Vert</option>
    					<option value="ribbon-orange">Orange</option>
    					<option value="ribbon-red">Rouge</option>
    					<option value="ribbon-blue-light">Bleu ciel</option>
    					<option value="ribbon-blue">Bleu</option>
    					<option value="ribbon-blue-mms">Bleu foncé</option>
    					<option value="ribbon-purple">Violet</option>
    					<option value="ribbon-pink">Rose</option>
    					<option value="ribbon-black">Noir</option>
                    </select>
    ';
    echo '<p>Texte du ruban: <input type="text" name="prom_ruban_texte" value="1" /></p>';
    echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div>';
}

	echo '</div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		$n_frais = str_replace('.', ',', $p[frais]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p[order].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editburaliste" value="'.$p[id].'" /><input type="submit" class="delete" value="Edit" /></form>
		</td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}






function fb_admin_acc() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/acc/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/acc/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];

		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 151) || ($wysm > 76) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(151);
						$wysom = $imagem->getHeight();
						if ($wysom > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($wysom > 76) {
				      		$imagem->resizeToWidth(151);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				} else {
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				}
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '".$p_order."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$nazwaplikumini = '';
		$nazwapliku = '';
		$edytuj_id = $_POST['editpromotion'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if ( !empty($f['name']) || $f['name'] != '') {
				$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
				if (!$kopiowanie) {
					$rand = rand(0, 100);
					$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$nazwapliku = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$nazwapliku' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 			$imagem = new SimpleImage();
      				$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$szerm = $imagem->getWidth();
					$wysom = $imagem->getHeight();
					if ( ($szerm > 151) || ($wysm > 76) ) {
						if ($szerm > $wysm) {
			    	  		$imagem->resizeToWidth(151);
							$wysom = $imagem->getHeight();
							if ($wysom > 76) {
					      		$imagem->resizeToHeight(76);
							}
						} else {
	    			  		$imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($wysom > 76) {
					      		$imagem->resizeToWidth(151);
							}
						}
			      		$imagem->save($path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					} else {
						$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$nazwaplikumini' WHERE id='$edytuj_id'");
				}
			}
		}
//		$updateowanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '1')");
		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

if (isset($_POST['editacc'])) {
	$editid = $_POST['editacc'];
	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit acc:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" value="'.$ed->subname.'" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" value="'.$ed->ceddre.'" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
	echo '</div></div></div>';

/* promocje -dodawanie */
} else {
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new acc:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div>';
}

	echo '</div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		$n_frais = str_replace('.', ',', $p[frais]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p[order].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editacc" value="'.$p[id].'" /><input type="submit" class="delete" value="Edit" /></form>
		</td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}


function fb_admin_mma() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_mma";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/mma/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/mma/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];

		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 151) || ($wysm > 76) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(151);
						$wysom = $imagem->getHeight();
						if ($wysom > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($wysom > 76) {
				      		$imagem->resizeToWidth(151);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];

				} else {
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				}
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '".$p_order."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$nazwaplikumini = '';
		$nazwapliku = '';
		$edytuj_id = $_POST['editpromotion'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if ( !empty($f['name']) || $f['name'] != '') {
				$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
				if (!$kopiowanie) {
					$rand = rand(0, 100);
					$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$nazwapliku = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$nazwapliku' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 			$imagem = new SimpleImage();
      				$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$szerm = $imagem->getWidth();
					$wysom = $imagem->getHeight();
					if ( ($szerm > 151) || ($wysm > 76) ) {
						if ($szerm > $wysm) {
			    	  		$imagem->resizeToWidth(151);
							$wysom = $imagem->getHeight();
							if ($wysom > 76) {
					      		$imagem->resizeToHeight(76);
							}
						} else {
	    			  		$imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($wysom > 76) {
					      		$imagem->resizeToWidth(151);
							}
						}
			      		$imagem->save($path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					} else {
						$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$nazwaplikumini' WHERE id='$edytuj_id'");
				}
			}
		}
//		$updateowanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '1')");
		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

if (isset($_POST['editmma'])) {
	$editid = $_POST['editmma'];
	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit mma:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" value="'.$ed->subname.'" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" value="'.$ed->ceddre.'" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
	echo '</div></div></div>';

/* promocje -dodawanie */
} else {
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new mma:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div>';
}

	echo '</div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		$n_frais = str_replace('.', ',', $p[frais]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/mma/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p[order].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editmma" value="'.$p[id].'" /><input type="submit" class="delete" value="Edit" /></form>
		</td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}


function fb_admin_acc2() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc2";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/acc2/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/acc2/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE id='$ajdi'");
	}

	if (isset($_POST['addpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];

		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
			if (!$kopiowanie) {
				$rand = rand(0, 100);
				$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$szerm = $imagem->getWidth();
				$wysom = $imagem->getHeight();
				if ( ($szerm > 151) || ($wysm > 76) ) {
					if ($szerm > $wysm) {
		    	  		$imagem->resizeToWidth(151);
						$wysom = $imagem->getHeight();
						if ($wysom > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($wysom > 76) {
				      		$imagem->resizeToWidth(151);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				} else {
					$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$nazwaplikumini = $rand.$fmini['name'];
				}
			}
			$nazwapliku = $rand.$f['name'];
		}
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '".$p_order."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$nazwaplikumini = '';
		$nazwapliku = '';
		$edytuj_id = $_POST['editpromotion'];
		if (isset($_FILES['uploadfile'])) {
			$f = $_FILES['uploadfile'];
			$fmini = $_FILES['uploadfilemini'];
			if (!is_dir($path)) {
				if (!mkdir($path, 0777, true)) {
					echo 'Failed to create folders...';
				}
			}
			if (!is_dir($path_mini)) {
				if (!mkdir($path_mini, 0777, true)) {
					$view .= 'Failed to create folders...';
				}
			}
			if ( !empty($f['name']) || $f['name'] != '') {
				$kopiowanie = copy($f['tmp_name'], $path.$f['name']);
				if (!$kopiowanie) {
					$rand = rand(0, 100);
					$kopiowanie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$nazwapliku = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$nazwapliku' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 			$imagem = new SimpleImage();
      				$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$szerm = $imagem->getWidth();
					$wysom = $imagem->getHeight();
					if ( ($szerm > 151) || ($wysm > 76) ) {
						if ($szerm > $wysm) {
			    	  		$imagem->resizeToWidth(151);
							$wysom = $imagem->getHeight();
							if ($wysom > 76) {
					      		$imagem->resizeToHeight(76);
							}
						} else {
	    			  		$imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($wysom > 76) {
					      		$imagem->resizeToWidth(151);
							}
						}
			      		$imagem->save($path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					} else {
						$kopiowanie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$nazwaplikumini = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$nazwaplikumini' WHERE id='$edytuj_id'");
				}
			}
		}
//		$updateowanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$nazwapliku."', '".$nazwaplikumini."', '1')");
		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

if (isset($_POST['editacc2'])) {
	$editid = $_POST['editacc2'];
	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit acc2:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" value="'.$ed->subname.'" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" value="'.$ed->ceddre.'" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
	echo '</div></div></div>';

/* promocje -dodawanie */
} else {
	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new acc2:</span></h3><div class="inside">';
	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
	echo '<p>Name: <input type="text" name="prom_name" /></p>';
//	echo '<p>Subtitle: <input type="text" name="prom_subname" /><small>(larger font, eg. "Solde!Solde!Solde! You can leave it empty.)</small></p>';
	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
//	echo '<p>Ceddre: <input type="text" size="10" name="prom_ceddre" />&euro; <small> (If no CEDDRE leave empty)</small></p>';
	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
	echo '</div></div></div>';
}

	echo '</div>';

	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace('.', ',', $p[price]).' &euro;';
		$n_frais = str_replace('.', ',', $p[frais]).' &euro;';
		if ($p[ceddre]) {
			$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p[photo]) {
			$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc2/mini/'.$p[photo_mini].'" alt="" />';
		}
		echo '<tr><td>'.$p[name].'</td><td>'.$p[subname].'<br /><small>'.$p[description].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p[order].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p[id].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editacc2" value="'.$p[id].'" /><input type="submit" class="delete" value="Edit" /></form>
		</td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}




function fb_admin_ncomments() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";

	echo '<div id="col-left" style="width:70%;">';
	echo '<h3>Last 50 comments</h3>';
	echo '<p><small>Click on the order number to see details.</small></p>';
	echo '<table class="widefat fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Topic</th><th>Content</th><th>Date</th><th>Author</th><th>Order number</th></tr></thead>';
	$comments = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` ORDER BY date DESC LIMIT 50", ARRAY_A);
	foreach ($comments as $c) :
		$licz = strlen($c[content]);
		if ($licz > 40) {
			$tnij = substr($c[content],0,40);
	        $txt = $tnij."...";
		} else {
			$txt = $c[content];
		}
		echo '<tr><td>'.$c[topic].'</td><td>'.$txt.'</td><td>'.$c[data].'</td><td>'.$c[author].'</td><td><a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbdet='.$c[order_id].'">'.$c[order_id].'</a></td></tr>';
	endforeach;
	echo '</table>';
	echo '</div>';
}

function convertToNumber($string) {
	$num = ereg_replace("[^0-9]", "", $string );
	return $num;
}

function convertToClean($string) {
//	$string = str_replace('/', '', $string);
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$string = str_replace($search, $replace, $string);
//	$num = preg_replace('[\w .-]', '', $string);
	$num = ereg_replace("[^a-zA-Z0-9\-\ ]", "", $string );
//	$num = str_replace('/', ' ', $num);
//	$num = ereg_replace("/^[a-zàâçéèêëîïôûùüÿñæœ .-]*$/i", "", $string );

//	$num = ereg_replace("^([a-zA-Zŕ-üŔ-Ü0-9 \.\!\?\'\-]+)$", "", $string );
//	$num = ereg_replace("[^a-zA-Z0-9\.\-\ ]", "", $string );
//	$num = ereg_replace("[^a-zA-Z0-9\xBF-\xFF\.\-\ ]+$/", "", $string );
	return $num;
}

function convertSA($string, $count) {
	$licz = iconv_strlen($string, "UTF-8");
	if ($licz > $count) {
		$txt = substr($string,0,$count);
	} elseif ($licz < $count) {
		$max = $count-$licz;
		$txt = $string;
		for ($x=0; $x<$max;$x++) {
			$txt .= ' ';
		}
	} else {
		$txt = $string;
	}
//	echo $string.' '.iconv_strlen($txt, "UTF-8").'<br />';
	return $txt;
}


function convertN($string, $count) {
    $licz = iconv_strlen($string, "UTF-8");
    if ($licz > $count) {
        $txt = substr($string, 0, $count);
    } elseif ($licz < $count) {
        $max = $count - $licz;
        $txt = $string;
        for ($x = 0; $x < $max; $x++) {
            $txt = '0'.$txt;
        }
    } else {
        $txt = $string;
    }
//	echo $string.' '.iconv_strlen($txt, "UTF-8").'<br />';
    return $txt;
}

function convertSAAddress($string, $count) {
	$licz = iconv_strlen($string, "UTF-8");
	if ($licz > $count) {
		$run = true;
        while($run) {
            $wskaznik = (isset($spacja)) ? $spacja : 0; // ustalamy wskaźnik, przy pierwszym uruchomieniu 0, dalej jest to ostatnia spacja na której skończyliśmy cięcie
            $s_string = substr($string,$wskaznik,$count); // pierwsze cięcie

            $spacja = strrpos($s_string,' '); // wyszukiwanie ostatniej spacji w wyniku pierwszego cięcia
            if(strlen($string) > $wskaznik+$count) $s_string = substr($s_string,0,$spacja); // sprawdza czy fragment którym się zajmujemy nie wystaje za nasz ciąg znaków, jeśli nie przycina wynik pierwszego ciecia do spacji
	            else $run = false; // jeśli tak, nie przycina już do ostatniej spacji i każe zakończyć pętla
                $txt[] = trim($s_string);
                $spacja += $wskaznik; // pozycja spacji dla całego stringu
        }
	} elseif ($licz < $count) {
		$max = $count-$licz;
		$txt = $string;
		for ($x=0; $x<$max;$x++) {
			$txt .= ' ';
		}
		$new[] = $txt;
		$txt = $new;
	} else {
		$txt = $string;
		$new[] = $txt;
		$txt = $new;
	}
//	echo $txt.'<br />';
	return $txt;
}

function getTnt($id, $user) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_cf = $prefix."fbs_cf";
	$exadd = false;
	$suser = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$user'");
	$exuser = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$id'");
	if ($exuser) {
		$exadd = true;
	}
    //echo "///USER=";print_r($suser);
    //echo "///EXUSER=";print_r($exuser);


    $relais_colis = false;
    $relais_number = "";
    $commande_relais = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$id'");
	foreach ($commande_relais as $UN_commande_relais) :
		$relais = $UN_commande_relais->type;
		if ($relais == "relais") {
			$relais_colis = true;
            $relais_number = $UN_commande_relais->value;
            break;
		}
	endforeach;

    $colis_revendeur = false;
    $commande_relais = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$id'");
	foreach ($commande_relais as $UN_commande_relais) :
		$relais = $UN_commande_relais->type;
		if ($relais == "revendeur" && $UN_commande_relais->value == "yes") {
			$colis_revendeur = true;
            break;
		}
	endforeach;

     /* Nombre de colis */
	$sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$id'");
		if ($sprawdzshipping) {
			$nbcolis = $sprawdzshipping->value;
		}else {
			$nbcolis = "1";
        }

	$v340 = "";

	$v1 = convertSA('08904205', 9);
	$v10 = convertSA($id, 18);
	$v28 = convertSA('', 9);


    if($relais_colis && $relais_number != ""){
    	$v37 = convertSA('JD', 3);
        $v70 = convertSA('0', 11);
        $v340 = convertSA($relais_number, 10);
    }else{
		$v37 = convertSA('J', 3);
		$v70 = convertSA('', 11);
		$v340 = convertSA('', 10);
    }

    /* Pas sur de ce champ: je le mets à 0*/
    $v70 = '';

	$v40 = convertSA('', 16);
	$v56 = convertSA('0.0', 11);
	$v67 = convertSA('', 17);
	$v84 = convertSA($nbcolis, 2);
	$v86 = convertSA('0001.000', 8);
	$v94 = convertSA('', 7);
	$v101 = convertSA(date('Ymd'), 8);
	$v109 = convertSA('', 30);
//	$v139 = convertSA('APPELER CLIENT SI BESOIN MERCI', 30); // ???

	if ($exadd == true) {
		$v169 = convertSA(convertToNumber($exuser->l_phone), 30); // phone
	} else {
		if (!empty($suser->l_phone)) {
			$v169 = convertSA(convertToNumber($suser->l_phone), 30); // phone
		} else {
			$v169 = convertSA(convertToNumber($suser->f_phone), 30); // phone
		}
	}

    if($relais_colis && $relais_number != ""){
    	$v169 = convertSA(convertToNumber($suser->f_phone), 30); // phone
    	//$v169 = convertSA('1234567890123456789012345678901234567890', 30); // phone
    }

	$v199 = convertSA('', 85);
	$v284 = convertSA('C', 1);
	/* Vu que l'on rajoute le champ v340 de 10 char, on enlève 10 à v285:
    $v285 = convertSA('', 65);*/
	$v285 = convertSA('', 55);

	if ($exadd == true) {
		$v139 = convertSA(convertToClean($exuser->l_name), 30);
	} else {
		if (!empty($suser->l_name)) {
			$v139 = convertSA(convertToClean($suser->l_name), 30);
		} elseif (!empty($suser->f_name)) {
			$v139 = convertSA(convertToClean($suser->f_name), 30);
		} else {
			$v139 = convertSA(convertToClean('Name'), 30);
		}
	}

    if($relais_colis && $relais_number != ""){
        $v139 = convertSA(convertToClean($suser->f_name), 30);
    }


	if ($exadd == true) {
		$v350 = convertSA(convertToClean($exuser->l_comp), 30);
	} else {
		if (!empty($suser->l_phone)) {
			$v350 = convertSA(convertToClean($suser->l_comp), 30);
		} else {
			$v350 = convertSA(convertToClean($suser->f_comp), 30);
		}
	}

    if($relais_colis && $relais_number != ""){
        $v350 = convertSA('RELAIS COLIS', 30);
    }

	if ($exadd == true) {
		$explode = explode('|', $exuser->l_address);
		$v380line = convertSAAddress(convertToClean($explode[0]), 30);
		$v380 = convertSA($v380line[0], 30);

		$v410 = convertSA($v380line[1].convertToClean($explode[1]), 30);
	} else {
		if (!empty($suser->l_phone)) {
			$explode = explode('|', $suser->l_address);
			$v380line = convertSAAddress(convertToClean($explode[0]), 30);
			$v380 = convertSA($v380line[0], 30);
			$v410 = convertSA($v380line[1].convertToClean($explode[1]), 30);
		} else {
			$explode = explode('|', $suser->f_address);
			$v380line = convertSAAddress(convertToClean($explode[0]), 30);
			$v380 = convertSA($v380line[0], 30);

			$v410 = convertSA($v380line[1].convertToClean($explode[1]), 30);
		}
	}



	$v440 = convertSA('', 30);

	if ($exadd == true) {
		$v470 = convertSA(convertToNumber($exuser->l_code), 9);
	} else {
		if (!empty($suser->l_phone)) {
			$v470 = convertSA(convertToNumber($suser->l_code), 9);
		} else {
			$v470 = convertSA(convertToNumber($suser->f_code), 9);
		}
	}

	if ($exadd == true) {
		$v479 = convertSA(convertToClean($exuser->l_city), 30);
	} else {
		if (!empty($suser->l_phone)) {
			$v479 = convertSA(convertToClean($suser->l_city), 30);
		} else {
			$v479 = convertSA(convertToClean($suser->f_city), 30);
		}
	}

    if($relais_colis && $relais_number != ""){
        $v380 = convertSA(convertToClean(strtoupper($exuser->l_address)), 30);
        $v410 = convertSA(convertToClean($exuser->l_comp), 30);
		$v470 = convertSA(convertToNumber($exuser->l_code), 9);
        $v479 = convertSA(convertToClean($exuser->l_city), 30);
    }

	$v509 = convertSA('', 30);
	$v539 = convertSA('FR', 3);
    if($colis_revendeur){
    	/* Saisie de l'adresse de facturation du client dans les champs expéditeur pour les envois en colis revendeur */
		$v542 = convertSA('', 53);
		$v595 = convertSA(convertToClean($suser->f_name), 30);
        if(trim($suser->f_comp) == ""){
				$v625 = convertSA(convertToClean($suser->f_address), 60);
				$v655 = "";
        }else{
				$v625 = convertSA(convertToClean($suser->f_comp), 30);
				$v655 = convertSA(convertToClean($suser->f_address), 30);
        }
        $v685 = convertSA('', 30);
		$v715 = convertSA(convertToNumber($suser->f_code), 9);
		$v724 = convertSA(convertToClean($suser->f_city), 30);
		$v754 = convertSA('', 30);
		$v784 = convertSA('FR', 3);
		$v787 = convertSA('', 22);
		$v809 = convertSA(convertToClean($suser->f_phone), 16);
        $v825 = convertSA('',386);

        $v542 = $v542 . $v595 . $v625 . $v655 . $v685 . $v715 . $v724 . $v754 . $v784 . $v787 . $v809 . $v825;
    }else{
        $v542 = convertSA('', 669);
    }

	//$sum = $v1.$v10.$v28.$v37.$v40.$v56.$v67.$v84.$v86.$v94.$v101.$v109.$v139.$v169.$v199.$v284.$v285.$v350.$v380.$v410.$v440.$v470.$v479.$v509.$v539.$v542;
	$sum = $v1.$v10.$v28.$v37.$v40.$v56.$v67.$v70.$v84.$v86.$v94.$v101.$v109.$v139.$v169.$v199.$v284.$v285.$v340.$v350.$v380.$v410.$v440.$v470.$v479.$v509.$v539.$v542;
	$sum = str_ireplace('cedex', '     ', $sum);
//	echo $sum;

$myFile = 'tnt/'.$id.".txt";
//echo 'myFile='.$myFile;
$fh = fopen($myFile, 'w') or die("1can't open file");
fwrite($fh, $sum);
fclose($fh);
$myFile2 = 'tnt/'.$id.".tem";
$fh2 = fopen($myFile2, 'w') or die("2can't open file");
//fwrite($fh2, $sum);
fclose($fh2);
//echo '<div id="downFiles"><a target="_blank" href="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.txt" id="downTXT">Download txt</a><br />';
//echo '<a target="_blank" href="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem" id="downTEM">Download tem</a></div>';

$BLXLSFile = il_y_a_fichier_BLXLS($id);
if ($BLXLSFile != false) {
   $hasBLXLS = $BLXLSFile;
} else {
	$hasBLXLS = false;
}
if($hasBLXLS != false) {
echo '<div id="downFiles">
<a href="download.php?filename='.$id.'" id="downZIPTXT">Download ZIP TXT</a><br />
<a href="download2.php?filename='.$id.'" id="downZIPTEM">Download ZIP TEM</a></div>';
} else {
echo '<div id="downFiles">
<a href="download.php?filename='.$id.'" id="downTXT">Download txt</a><br />
<a href="download2.php?filename='.$id.'" id="downTEM">Download tem</a></div>';
}


//echo '<a href="download.php?filename='.$id.'">Download</a>';


?>
    <script type="text/javascript">
/*		$(document).ready(function(){

        	$.ajax({
			    type: "GET",
			    url: "http://"+document.location.host+"/wp-admin/download2.php",
			    data: "filename=".$id,
                success:function(response){
                    alert('ok-'+response);
                    alert("Details saved successfully!!!");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
			});
 //			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.txt','Download')",100);
// 			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.tem','Downloadtem')",200);
//			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.tem','Download')",1010);
        });
*/
    </script>
<?php

/*
<script type="text/javascipt">
setTimeout("window.open(\''.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem\',\'Download\')",500);


function startDownload() {
alert();
var url="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem";
window.open(url,"Download");
setTimeout("startDownload()",500);
}
*/

}

function getTnt_ZIP($id, $user, $liste) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_cf = $prefix."fbs_cf";
	$exadd = false;
	$suser = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$user'");
	$exuser = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$id'");
	if ($exuser) {
		$exadd = true;
	}
    //echo "///USER=";print_r($suser);
    //echo "///EXUSER=";print_r($exuser);


    $relais_colis = false;
    $relais_number = "";
    $commande_relais = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$id'");
	foreach ($commande_relais as $UN_commande_relais) :
		$relais = $UN_commande_relais->type;
		if ($relais == "relais") {
			$relais_colis = true;
            $relais_number = $UN_commande_relais->value;
            break;
		}
	endforeach;

    $colis_revendeur = false;
    $commande_relais = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$id'");
	foreach ($commande_relais as $UN_commande_relais) :
		$relais = $UN_commande_relais->type;
		if ($relais == "revendeur" && $UN_commande_relais->value == "yes") {
			$colis_revendeur = true;
            break;
		}
	endforeach;

     /* Nombre de colis */
	$sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$id'");
		if ($sprawdzshipping) {
			$nbcolis = $sprawdzshipping->value;
		}else {
			$nbcolis = "1";
        }

	$zip_txt = new ZipArchive();
	$zip_tem = new ZipArchive();

	 if($zip_txt->open('tnt/'.$id.'.txt.zip', ZipArchive::CREATE) == FALSE) {
			die;
       }

	 if($zip_tem->open('tnt/'.$id.'.tem.zip', ZipArchive::CREATE) == FALSE) {
			die;
       }

	$incr_id = 0;

foreach ($liste AS $code) {

	$incr_id++;

	if($code != 0) {
		if($donnees_client = $wpdb->get_row("SELECT * FROM wp_retail WHERE retail_code = '" . $code . "'")) {


	$v340 = "";

	$v1 = convertSA('08904205', 9);
	$v10 = convertSA($id, 18);
	$v28 = convertSA('', 9);


    if($relais_colis && $relais_number != ""){
    	$v37 = convertSA('JD', 3);
        $v70 = convertSA('0', 11);
        $v340 = convertSA($relais_number, 10);
    }else{
		$v37 = convertSA('J', 3);
		$v70 = convertSA('', 11);
		$v340 = convertSA('', 10);
    }

    /* Pas sur de ce champ: je le mets à 0*/
    $v70 = '';

	$v40 = convertSA('', 16);
	$v56 = convertSA('0.0', 11);
	$v67 = convertSA('', 17);
	$v84 = convertSA($nbcolis, 2);
	$v86 = convertSA('0001.000', 8);
	$v94 = convertSA('', 7);
	$v101 = convertSA(date('Ymd'), 8);
	$v109 = convertSA('', 30);
//	$v139 = convertSA('APPELER CLIENT SI BESOIN MERCI', 30); // ???


	if ($donnees_client->retail_tel != '') {
		$v169 = convertSA(convertToNumber($donnees_client->retail_tel), 30); // phone
	} else {
		if ($exadd == true) {
			$v169 = convertSA(convertToNumber($exuser->l_phone), 30); // phone
		} else {
			if (!empty($suser->l_phone)) {
				$v169 = convertSA(convertToNumber($suser->l_phone), 30); // phone
			} else {
				$v169 = convertSA(convertToNumber($suser->f_phone), 30); // phone
			}
		}
    }

    if($relais_colis && $relais_number != ""){
    	$v169 = convertSA(convertToNumber($suser->f_phone), 30); // phone
    	//$v169 = convertSA('1234567890123456789012345678901234567890', 30); // phone
    }

	$v199 = convertSA('', 85);
	$v284 = convertSA('C', 1);
	/* Vu que l'on rajoute le champ v340 de 10 char, on enlève 10 à v285:
    $v285 = convertSA('', 65);*/
	$v285 = convertSA('', 55);

	if ($donnees_client->retail_contact != '') {
		$v139 = convertSA(convertToClean($donnees_client->retail_contact), 30);
	} else {
		if ($exadd == true) {
			$v139 = convertSA(convertToClean($exuser->l_name), 30);
		} else {
			if (!empty($suser->l_name)) {
				$v139 = convertSA(convertToClean($suser->l_name), 30);
			} elseif (!empty($suser->f_name)) {
				$v139 = convertSA(convertToClean($suser->f_name), 30);
			} else {
				$v139 = convertSA(convertToClean('Name'), 30);
			}
		}
    }

    if($relais_colis && $relais_number != ""){
        $v139 = convertSA(convertToClean($suser->f_name), 30);
    }


	if ($exadd == true) {
		$v350 = convertSA(convertToClean($exuser->l_comp), 30);
	} else {
		if (!empty($suser->l_phone)) {
			$v350 = convertSA(convertToClean($suser->l_comp), 30);
		} else {
			$v350 = convertSA(convertToClean($suser->f_comp), 30);
		}
	}

    if($relais_colis && $relais_number != ""){
        $v350 = convertSA('RELAIS COLIS', 30);
    }

	if ($donnees_client->retail_adresse != '') {
		$v380 = convertSA(convertToClean($donnees_client->retail_enseigne), 30);
		$v410 = convertSA(convertToClean($donnees_client->retail_adresse),30);
		$v350 = $v380;
	}

	else {

	if ($exadd == true) {
		$explode = explode('|', $exuser->l_address);
		$v380line = convertSAAddress(convertToClean($explode[0]), 30);
		$v380 = convertSA($v380line[0], 30);

		$v410 = convertSA($v380line[1].convertToClean($explode[1]), 30);
	} else {
		if (!empty($suser->l_phone)) {
			$explode = explode('|', $suser->l_address);
			$v380line = convertSAAddress(convertToClean($explode[0]), 30);
			$v380 = convertSA($v380line[0], 30);
			$v410 = convertSA($v380line[1].convertToClean($explode[1]), 30);
		} else {
			$explode = explode('|', $suser->f_address);
			$v380line = convertSAAddress(convertToClean($explode[0]), 30);
			$v380 = convertSA($v380line[0], 30);

			$v410 = convertSA($v380line[1].convertToClean($explode[1]), 30);
		}
	}
    }


	$v440 = convertSA('', 30);

	if ($donnees_client->retail_cp != '') {
		$v470 = convertSA(convertToNumber($donnees_client->retail_cp), 9);
	} else {

	if ($exadd == true) {
		$v470 = convertSA(convertToNumber($exuser->l_code), 9);
	} else {
		if (!empty($suser->l_phone)) {
			$v470 = convertSA(convertToNumber($suser->l_code), 9);
		} else {
			$v470 = convertSA(convertToNumber($suser->f_code), 9);
		}
	}
	}

	if ($donnees_client->retail_ville != '') {
		$v479 = convertSA(convertToClean($donnees_client->retail_ville), 30);
	} else {

	if ($exadd == true) {
		$v479 = convertSA(convertToClean($exuser->l_city), 30);
	} else {
		if (!empty($suser->l_phone)) {
			$v479 = convertSA(convertToClean($suser->l_city), 30);
		} else {
			$v479 = convertSA(convertToClean($suser->f_city), 30);
		}
	}
	}

    if($relais_colis && $relais_number != ""){
        $v380 = convertSA(convertToClean(strtoupper($exuser->l_address)), 30);
        $v410 = convertSA(convertToClean($exuser->l_comp), 30);
		$v470 = convertSA(convertToNumber($exuser->l_code), 9);
        $v479 = convertSA(convertToClean($exuser->l_city), 30);
    }

	$v509 = convertSA('', 30);
	$v539 = convertSA('FR', 3);
    if($colis_revendeur){
    	/* Saisie de l'adresse de facturation du client dans les champs expéditeur pour les envois en colis revendeur */
		$v542 = convertSA('', 53);
		$v595 = convertSA(convertToClean($suser->f_name), 30);
        if(trim($suser->f_comp) == ""){
				$v625 = convertSA(convertToClean($suser->f_address), 60);
				$v655 = "";
        }else{
				$v625 = convertSA(convertToClean($suser->f_comp), 30);
				$v655 = convertSA(convertToClean($suser->f_address), 30);
        }
        $v685 = convertSA('', 30);
		$v715 = convertSA(convertToNumber($suser->f_code), 9);
		$v724 = convertSA(convertToClean($suser->f_city), 30);
		$v754 = convertSA('', 30);
		$v784 = convertSA('FR', 3);
		$v787 = convertSA('', 22);
		$v809 = convertSA(convertToClean($suser->f_phone), 16);
        $v825 = convertSA('',386);

        $v542 = $v542 . $v595 . $v625 . $v655 . $v685 . $v715 . $v724 . $v754 . $v784 . $v787 . $v809 . $v825;
    }else{
        $v542 = convertSA('', 669);
    }

	//$sum = $v1.$v10.$v28.$v37.$v40.$v56.$v67.$v84.$v86.$v94.$v101.$v109.$v139.$v169.$v199.$v284.$v285.$v350.$v380.$v410.$v440.$v470.$v479.$v509.$v539.$v542;
	$sum = $v1.$v10.$v28.$v37.$v40.$v56.$v67.$v70.$v84.$v86.$v94.$v101.$v109.$v139.$v169.$v199.$v284.$v285.$v340.$v350.$v380.$v410.$v440.$v470.$v479.$v509.$v539.$v542;
	$sum = str_ireplace('cedex', '     ', $sum);
//	echo $sum;

$myFile = "tnt/".substr($id,2).str_pad($incr_id, 2, '0', STR_PAD_LEFT).".txt";
//echo 'myFile='.$myFile;
$fh = fopen($myFile, 'w') or die("1can't open file");
fwrite($fh, $sum);
fclose($fh);
$zip_txt->addFile($myFile);
$myFile2 = "tnt/".substr($id,2).str_pad($incr_id, 2, '0', STR_PAD_LEFT).".tem";
$fh2 = fopen($myFile2, 'w') or die("2can't open file");
//fwrite($fh2, $sum);
fclose($fh2);
$zip_tem->addFile($myFile2);
//echo '<div id="downFiles"><a target="_blank" href="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.txt" id="downTXT">Download txt</a><br />';
//echo '<a target="_blank" href="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem" id="downTEM">Download tem</a></div>';


			}
		}

}

$zip_txt->close();
$zip_tem->close();


$BLXLSFile = il_y_a_fichier_BLXLS($id);
if ($BLXLSFile != false) {
   $hasBLXLS = $BLXLSFile;
} else {
	$hasBLXLS = false;
}
if($hasBLXLS != false) {
echo '<div id="downFiles">
<a href="download.php?filename='.$id.'&zip=1" id="downZIPTXT">Download ZIP TXT</a><br />
<a href="download2.php?filename='.$id.'&zip=1" id="downZIPTEM">Download ZIP TEM</a></div>';
} else {
echo '<div id="downFiles">
<a href="download.php?filename='.$id.'" id="downTXT">Download txt</a><br />
<a href="download2.php?filename='.$id.'" id="downTEM">Download tem</a></div>';
}


//echo '<a href="download.php?filename='.$id.'">Download</a>';


?>
    <script type="text/javascript">
/*		$(document).ready(function(){

        	$.ajax({
			    type: "GET",
			    url: "http://"+document.location.host+"/wp-admin/download2.php",
			    data: "filename=".$id,
                success:function(response){
                    alert('ok-'+response);
                    alert("Details saved successfully!!!");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
			});
 //			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.txt','Download')",100);
// 			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.tem','Downloadtem')",200);
//			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.tem','Download')",1010);
        });
*/
    </script>
<?php

/*
<script type="text/javascipt">
setTimeout("window.open(\''.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem\',\'Download\')",500);


function startDownload() {
alert();
var url="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem";
window.open(url,"Download");
setTimeout("startDownload()",500);
}
*/

}



function getFedex($id, $user) {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $fb_tablename_order = $prefix . "fbs_order";
    $fb_tablename_users = $prefix . "fbs_users";
    $fb_tablename_address = $prefix . "fbs_address";
    $fb_tablename_cf = $prefix . "fbs_cf";
    $exadd = false;
    $suser = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$user'");
    $exuser = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$id'");
    if ($exuser) {
        $exadd = true;
    }
    //echo "///USER=";print_r($suser);
    //echo "///EXUSER=";print_r($exuser);
	//$query_poids = "SELECT poids FROM `$fb_tablename_cf` WHERE unique_id = '$id'";
	$query_poids = "SELECT value FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$id'";
	$poids = $wpdb->get_var($query_poids);

    $relais_colis = false;
    $relais_number = "";
    $commande_relais = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$id'");
    foreach ($commande_relais as $UN_commande_relais) :
        $relais = $UN_commande_relais->type;
        if ($relais == "relais") {
            $relais_colis = true;
            $relais_number = $UN_commande_relais->value;
            break;
        }
    endforeach;

    $colis_revendeur = false;
    $commande_relais = $wpdb->get_results("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$id'");
    foreach ($commande_relais as $UN_commande_relais) :
        $relais = $UN_commande_relais->type;
        if ($relais == "revendeur" && $UN_commande_relais->value == "yes") {
            $colis_revendeur = true;
            break;
        }
    endforeach;

    /* Nombre de colis */
    $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$id'");
    if ($sprawdzshipping) {
        $nbcolis = round($sprawdzshipping->value);
		/* On appelle récursivement cette fonction pour imprimer le nombre d'étiquettes nécessaires au nombre de colis */
		/* FIn appel récursif A FAIRE */

    } else {
        $nbcolis = "1";
    }


	/* Construction Fichier plat */

	/* Compte client */
	$v1 = convertN('0440949', 7);

	/* REF A Constante à définir */
	/* Envois en marque blanche */
	if($colis_revendeur) {
		$v8 = convertSA('FB  ', 4);
	} else {
		$v8 = convertSA('01  ', 4);
	}

	/* Réf 1: référence expéditeur. N° de commande  */
	$v12 = convertSA($id, 16);

	/* Identifiant destinataire ID USER */
	$v28 = convertSA($user, 16);

	/* Réf C, 16AN, N° unique de colis XXXXXX (si disponible): exemple 1, 2, 3 ou 4 pour une commande a 4 colis   */
	$v44 = convertSA('', 16);

	/* Réf 3, 16AN, Référence supplémentaire    */

	if($nbcolis == 0 || $nbcolis==false) $nbcolis = 1;
	$v60 = convertN('', 13) . convertN($nbcolis, 3);

	/* N° de colis FedEx Express France, 10 N, Calculé selon l’algorithme en vigueur // LAISSÉ VIDE CAR CALCUL2 PAR FEDEX  */
	$v76 = convertN('', 10);

	/* Poids du colis en hg */
	$v86 = convertN(convertToNumber(round(($poids*10),0,PHP_ROUND_HALF_UP)), 6);

	/* Volume du colis du colis en dm3 si disponible */
	$v92 = convertN('', 10);

	/* Date édition AAAAMMJJ */
	$v102 = convertSA(date('Ymd'), 8);

	/* Heure édition HHMM */
	$v110 = convertSA(date('hi'), 4);

	/* N° acheminement, 10N, tel que fourni dans le fichier plan de transport  // LAISSÉ VIDE CAR CALCUL2 PAR FEDEX  */
	$v114 = convertN('', 10);

	/* Code acheminement, 7AN, tel qu’imprimé sur l’étiquette  // LAISSÉ VIDE CAR CALCUL2 PAR FEDEX  */
	$v124 = convertSA('', 7);

	/* Nom destinataire */
	if ($exadd == true) {
        $v132 = convertSA(convertToClean($exuser->l_name), 32);
    } else {
        if (!empty($suser->l_name)) {
            $v132 = convertSA(convertToClean($suser->l_name), 32);
        } elseif (!empty($suser->f_name)) {
            $v132 = convertSA(convertToClean($suser->f_name), 32);
        } else {
            $v132 = convertSA(convertToClean('Name'), 32);
        }
    }

	/* Adresse 1*/
    if ($exadd == true) {
        $v164 = convertSA(convertToClean($exuser->l_comp), 32);
    } else {
        if (!empty($suser->l_phone)) {
            $v164 = convertSA(convertToClean($suser->l_comp), 32);
        } else {
            $v164 = convertSA(convertToClean($suser->f_comp), 32);
        }
    }

	/*Adresse 2 et 3*/
    if ($exadd == true) {
        $explode = explode('|', $exuser->l_address);
        $v380line = convertSAAddress(convertToClean($explode[0]), 32);
		if(trim($v164)=="") {$v164 = convertSA($v380line[0], 32);$v198 = convertSA('', 32);}
		else $v198 = convertSA($v380line[0], 32);
        $v230 = convertSA($v380line[1] . convertToClean($explode[1]), 32);
    } else {
        if (!empty($suser->l_phone)) {
            $explode = explode('|', $suser->l_address);
            $v380line = convertSAAddress(convertToClean($explode[0]), 32);
			if(trim($v164)=="") {$v164 = convertSA($v380line[0], 32);$v198 = convertSA('', 32);}
			else $v198 = convertSA($v380line[0], 32);
            $v230 = convertSA($v380line[1] . convertToClean($explode[1]), 32);
        } else {
            $explode = explode('|', $suser->f_address);
            $v380line = convertSAAddress(convertToClean($explode[0]), 32);
            if(trim($v164)==""){ $v164 = convertSA($v380line[0], 32);$v198 = convertSA('', 32);}
			else $v198 = convertSA($v380line[0], 32);
            $v230 = convertSA($v380line[1] . convertToClean($explode[1]), 32);
        }
    }

	/*Adresse 4*/
    $v262 = convertSA('', 32);

	/*Code PAys: 2AN, blanc pour la France  */
	$v294 = convertSA('  ', 2);


	/*Codepostal */
    if ($exadd == true) {
        $v296 = convertSA(convertToNumber($exuser->l_code), 7);
    } else {
        if (!empty($suser->l_phone)) {
            $v296 = convertSA(convertToNumber($suser->l_code), 7);
        } else {
            $v296 = convertSA(convertToNumber($suser->f_code), 7);
        }
    }

	/* VILLE 25AN*/
    if ($exadd == true) {
        $v303 = convertSA(convertToClean($exuser->l_city), 25);
    } else {
        if (!empty($suser->l_phone)) {
            $v303 = convertSA(convertToClean($suser->l_city), 25);
        } else {
            $v303 = convertSA(convertToClean($suser->f_city), 25);
        }
    }

	/* Informations de livraison, 20AN*/
	$v328 = convertSA('', 20);

	/* Téléphone */
    if ($exadd == true) {
        $v348 = convertSA(convertToNumber($exuser->l_phone), 16); // phone
    } else {
        if (!empty($suser->l_phone)) {
            $v348 = convertSA(convertToNumber($suser->l_phone), 16); // phone
        } else {
            $v348 = convertSA(convertToNumber($suser->f_phone), 16); // phone
        }
    }

	/* Champ Produit: Choix du Fedex@Home 'O' ou Optimum ' ' */
	$v349 = convertSA(' ', 1);
	/* Service Blanc pour NON Samedi et 'O' pour SAMEDI */
	$v350 = convertSA(' ', 1);
	/*Montant Ce*/
	$v351 = convertN('', 10);
	/*Devise */
	$v361 = convertSA('EUR', 3);
	/*Tel Mobile, 16AN, Obligatoire pour le produit FedEx@Home*/
	$v364 = $v348;
	/* Email, 80AN */
	$v380 = convertSA($suser->email, 80);
	/* Blanc, 26AN */
	$v460 = convertSA('', 26);
	/* Non Contact , 32AN */
	$v486 = convertSA('', 32);
	/* Montant Vd , 10N */
	$v544 = convertN('', 10);
	/* Devise Vd , 3AN */
	$v554 = convertSA('EUR', 3);
	/* Longueur, largeur, hauteur, 10AN chaque */
	$v557 = convertN('', 10);
	$v567 = convertN('', 10);
	$v577 = convertN('', 10);
	/* Code Article, 16AN */
	$v587 = convertSA('', 16);
	/* Désignation 255AN */
	$v603 = convertSA('', 255);
	/* Filler, 17AN */
	$v858 = convertSA('', 17);
	/* DEEE, 1AN */
	$v875 = convertSA('N', 1);

	$sum = $v1 . $v8 . $v12 . $v28 . $v44 . $v60 . $v76 . $v86 . $v92 . $v102 . $v110 . $v114 . $v124 . $v132 . $v164 . $v198 . $v230 . $v262 . $v294 . $v296 . $v303 . $v328 . $v348 . $v349 . $v350 . $v351 . $v361 . $v364 . $v380 . $v460 . $v486 . $v544 . $v554 . $v557 . $v567 . $v577 . $v587 . $v603 . $v858 . $v875;

	/* FIN Construction fichier plat */

    $sum = str_ireplace('cedex', '     ', $sum);
    //	echo $sum;

    $myFile = 'tnt/tedip_' . $id . ".csv";
    //echo 'myFile='.$myFile;
    $fh = fopen($myFile, 'w') or die("1can't open file");
    fwrite($fh, $sum);
    fclose($fh);
    //$myFile2 = 'tnt/' . $id . ".tem";
    //$fh2 = fopen($myFile2, 'w') or die("2can't open file");
    //fwrite($fh2, $sum);
    //fclose($fh2);
    //echo '<div id="downFiles"><a target="_blank" href="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.txt" id="downTXT">Download txt</a><br />';
    //echo '<a target="_blank" href="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem" id="downTEM">Download tem</a></div>';
    echo '<div id="downFiles">
<a href="download.php?filename=tedip_' . $id . '.csv" id="downTXT">Download txt</a><br />';


//echo '<a href="download.php?filename='.$id.'">Download</a>';
    ?>
    <script type="text/javascript">
        /*		$(document).ready(function(){

         $.ajax({
         type: "GET",
         url: "http://"+document.location.host+"/wp-admin/download2.php",
         data: "filename=".$id,
         success:function(response){
         alert('ok-'+response);
         alert("Details saved successfully!!!");
         },
         error: function (request, status, error) {
         alert(request.responseText);
         }
         });
         //			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.txt','Download')",100);
         // 			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.tem','Downloadtem')",200);
         //			setTimeout("window.open('/wp-admin/tnt/<?php echo $id; ?>.tem','Download')",1010);
         });
         */
    </script>
    <?php
    /*
      <script type="text/javascipt">
      setTimeout("window.open(\''.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem\',\'Download\')",500);


      function startDownload() {
      alert();
      var url="'.get_bloginfo("url").'/wp-admin/tnt/'.$id.'.tem";

      window.open(url,"Download");
      setTimeout("startDownload()",500);
      }
     */
}

/**
 * Cette fonction retourne TRUE si il y a un enregistrement si non FALSE
 * @global type $wpdb
 * @param type $idorder
 * @return boolean
 */
function EstColieRevendeur($idorder) {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $sql = "select id from " . $prefix . "fbs_prods where order_id='" . $idorder . "' and description like '%colis revendeur%'";
    try {
        $id = $wpdb->get_var($sql);
		//mail("contact@tempopasso.com","TEST EstColieRevendeur","sql=".$sql." // id=".$id." ///// ".print_r("",true));
        if ($id) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
        return false;
    }
}

/**
 * Verifier si un fichier BL.PDF exits et renvoit le chemin, sinon FALSE
 * @param type $idorder
 * @return boolean
 */
function il_y_a_fichier_bl($idorder) {
    $base = ABSPATH;
    if (@file_exists($base . 'uploaded/' . $idorder . '/BL.PDF')) {
        return $base . 'uploaded/' . $idorder . '/BL.PDF';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/bl.pdf')) {
        return $base . 'uploaded/' . $idorder . '/bl.pdf';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/Bl.PDF')) {
        return $base . 'uploaded/' . $idorder . '/Bl.PDF';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/Bl.pdf')) {
        return $base . 'uploaded/' . $idorder . '/Bl.pdf';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/BL.pdf')) {
        return $base . 'uploaded/' . $idorder . '/BL.pdf';
    } else {
        return false;
    }
}

/**
 * Verifier si un fichier BL.PDF exits et renvoit le chemin, sinon FALSE
 * @param type $idorder
 * @return boolean
 */
function il_y_a_fichier_BLXLS($idorder) {
    $base = ABSPATH;
    if (@file_exists($base . 'uploaded/' . $idorder . '/BL.XLS')) {
        return $base . 'uploaded/' . $idorder . '/BL.XLS';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/bl.xls')) {
        return $base . 'uploaded/' . $idorder . '/bl.xls';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/Bl.XLS')) {
        return $base . 'uploaded/' . $idorder . '/Bl.XLS';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/Bl.xls')) {
        return $base . 'uploaded/' . $idorder . '/Bl.xls';
    } elseif (@file_exists($base . 'uploaded/' . $idorder . '/BL.xls')) {
        return $base . 'uploaded/' . $idorder . '/BL.xls';
    } else {
        return false;
    }
}

/**
 * Genere un code barre en contenant le numero de la commande
 * et renvoi le lien de l'image qui contient le code a barre
 * @param type $idorder
 */
function renvoiCodeBar($idorder) {
    include_once ABSPATH . 'wp-includes/php-barcode.php';

    $fontSize = 20;   // GD1 in px ; GD2 in point
    $marge = 0;   // between barcode and hri in pixel
    $x = 150;  // barcode center
    $y = 40;  // barcode center
    $height = 83;   // barcode height in 1D ; module size in 2D
    $width = 3;    // barcode height in 1D ; not use in 2D
    $angle = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation

    $code = $idorder; // barcode, of course ;)
    $type = 'int25';
    //$type = 'code93';
    $font = 5;
    $im = imagecreatetruecolor(300, 100);
    $black = ImageColorAllocate($im, 0x00, 0x00, 0x00);
    $white = ImageColorAllocate($im, 0xff, 0xff, 0xff);
    $red = ImageColorAllocate($im, 0xff, 0x00, 0x00);
    $blue = ImageColorAllocate($im, 0x00, 0x00, 0xff);
    imagefilledrectangle($im, 0, 0, 300, 300, $white);

    $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code' => $code,'crc' => false), $width, $height);

	/*
	$im     = imagecreatetruecolor(300, 300);
$black  = ImageColorAllocate($im,0x00,0x00,0x00);
$white  = ImageColorAllocate($im,0xff,0xff,0xff);
imagefilledrectangle($im, 0, 0, 300, 300, $white);
$type = "code128";
$data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

*/
    imagestring($im, 5, $x-100, $y+46, formatStringForCodeBarre($idorder), 0);



    //imageline($im, $x, 0, $x, 250, $red);
    //imageline($im, 0, $y, 250, $y, $red);

    for ($i = 1; $i < 5; $i++) {
        //drawCross($im, $blue, $data['p' . $i]['x'], $data['p' . $i]['y']);
    }
    $imgPath = __DIR__ . "/barcodes_GkA32Bn09fKNxSL/". $idorder . "_" . uniqid() . ".png";
    //imagepng($image)
    imagepng($im, $imgPath);
    imagedestroy($im);

    return $imgPath;
}

/**
 * fonction pour envadrer le code a barre
 * @param type $im
 * @param type $color
 * @param type $x
 * @param type $y
 */
function drawCross($im, $color, $x, $y) {
    imageline($im, $x - 10, $y, $x + 10, $y, $color);
    imageline($im, $x, $y - 10, $x, $y + 10, $color);
}

/**
 * Renvoi la ligne qui contient l'addresse du client de la commande ($numero)
 * Sinon il renvoi FALSE
 * @global type $wpdb
 * @param type $numero
 * @return boolean
 */
function renvoiAdresseClient($numero) {
    global $wpdb;
    $prefix = $wpdb->prefix;
    $sql = "SELECT * FROM " . $prefix . "fbs_users a left join " . $prefix . "fbs_order b on (b.`user` = a.id) left join " . $prefix . "fbs_prods c on (c.order_id = b.unique_id) where c.order_id = '" . $numero . "';";
    if ($row = $wpdb->get_row($sql)) {
        return $row;
    } else {
        return false;
    }
}

function formatStringForCodeBarre($string) {
    $s = "";
    for($i=0; $i<=strlen($string); $i++) {
        $s .= $string[$i] . "  ";
    }
    return $s;
}


?>
