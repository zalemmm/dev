<?php
////////////////////////////////////////////////////////////////////////////////
//                                                         INTEGRATION WORDPRESS
////////////////////////////////////////////////////////////////////////////////

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
}

function fbs_admin_menu() {
  add_menu_page('FB Shop', 'FB Shop', 1, 'fbsh', 'fb_admin_sales');

  add_submenu_page('fbsh', 'Sales', 'Sales', 1, 'fbsh', 'fb_admin_sales');
  add_submenu_page('fbsh', 'Sales', 'Old Sales', 1, 'fbsho', 'fb_admin_sales_old');
  add_submenu_page('fbsh', 'Sales', 'Shipped Sales', 1, 'fbship', 'fb_admin_sales_shipped');

  add_submenu_page('fbsh', 'Codes promo', 'Codes promo', 1, 'fb-promcodes', 'fb_admin_promocode');
  add_submenu_page('fbsh', 'Promotions', 'Promotions', 1, 'fb-prom', 'fb_admin_promo');
  add_submenu_page('fbsh', 'Accessoires', 'Accessoires', 1, 'fb-acc', 'fb_admin_acc');
  add_submenu_page('fbsh', 'PLV Ext', 'PLV Ext', 1, 'fb-plv', 'fb_admin_plv');
  add_submenu_page('fbsh', 'PLV Int', 'PLV Int', 1, 'fb-plv_int', 'fb_admin_plv_int');

  add_submenu_page('fbsh', 'Stock', 'Stock', 1, 'fb-stock', 'fb_admin_stock');
  add_submenu_page('fbsh', 'Fournisseurs', 'Fournisseurs', 1, 'fb-fournisseurs', 'fb_admin_fournisseurs');
  add_submenu_page('fbsh', 'Entrées/Sorties', 'Entrées/Sorties', 1, 'fb-entree', 'fb_admin_entree');

  add_submenu_page('fbsh', 'Users', 'Users', 1, 'fb-users', 'fb_admin_users2');
  add_submenu_page('fbsh', 'Last Comments', 'Last Comments', 1, 'fb-comments', 'fb_admin_ncomments');
  add_submenu_page('fbsh', 'Mails', 'Mails', 1, 'fb-mails', 'fb_admin_mails');
  add_submenu_page('fbsh', 'SMS', 'SMS', 1, 'fb-sms', 'fb_admin_sms');
  add_submenu_page('fbsh', 'Comments Topics', 'Comments Topics', 1, 'fb-topic', 'fb_admin_topic');

  add_submenu_page('fbsh', 'Ratings', 'Ratings', 1, 'fb-ratings', 'fb_admin_rating');
  add_submenu_page('fbsh', 'Reponses', 'Reponses', 1, 'fb-ratings-comments', 'fb_admin_ratings_comments');

  add_submenu_page('fbsh', 'Reports', 'Reports', 1, 'fb-reports', 'fb_admin_reports');
  add_submenu_page('fbsh', 'User Reports', 'User Reports', 1, 'fb-reports-users', 'fb_admin_reports_users');

	add_submenu_page('fbsh', 'Expédition Commandes', 'Expédition Commandes', 1, 'fb-expedition', 'fb_admin_expedition');
	add_submenu_page('fbsh', 'Groupes clients', 'Groupes clients', 1, 'fb_manage_groupes', 'fb_groupes');
	add_submenu_page('fbsh', 'Moyens de paiement', 'Moyens de paiement', 1, 'fb_manage_payment', 'fb_payment');
	add_submenu_page('fbsh', 'Relances clients', 'Relances clients', 1, 'fb_manage_relances', 'fb_relances');
	add_submenu_page('fbsh', 'Sync Mailjet', 'Synchronisation Mailjet', 1, 'fb_sync_mailjet', 'fb_mailjet');
}

////////////////////////////////////////////////////////////////////////////////
//                                                              AVIS COTE CLIENT
////////////////////////////////////////////////////////////////////////////////

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

  // Mise en cache des notes ///////////////////////////////////////////////////
  // (script récupéré depuis la page mise_cache.php) ///////////////////////////
  $moyenne = $wpdb->get_row("SELECT AVG(r.fir+r.sec+r.thi)/3 AS moy FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
  $total = $wpdb->get_row("SELECT COUNT(*) AS nb_avis FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
  $strmoyenne1 = round($moyenne->moy,2);
  $del_cache = $wpdb->query("DELETE FROM `$fb_tablename_cache_notes` WHERE code_parent = '$prod_family'");
  $mise_cache = $wpdb->query("INSERT INTO `$fb_tablename_cache_notes` VALUES ('','$prod_family','$strmoyenne1','$total->nb_avis')");
  if ($full_list) {
    //Mise en cache de la liste des avis
    $rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC", ARRAY_A);
    $cache_list = '';
    foreach ($rates as $r) {
    	$cache_list .= $r['id'].';';
    }
    $del_cache = $wpdb->query("DELETE FROM `$fb_tablename_cache_ratings` WHERE code_parent = '$prod_family'");
    $mise_cache = $wpdb->query("INSERT INTO `$fb_tablename_cache_ratings` VALUES('','$prod_family','$cache_list')");
  }

  /////////////////////////////////////////////////////////// affichage notes //
  $view = '<div style="clear: both;"></div>
  <div id="rating_livre" itemtype="http://schema.org/Review">
  <div id="vosavis"></div>';
	$view .= '<div itemscope itemtype="http://schema.org/AggregateRating" id="rating_general" itemprop="aggregateRating"><h2>Vos avis :</h2>';
	$notation = $wpdb->get_row("SELECT * FROM `$fb_tablename_cache_notes` WHERE code_parent = '$prod_family'");
	$strmoyenne1 = $notation->note;
	$strmoyenne2 = "/5 - ";
	$strmoyenne3 = $notation->nb_avis;
	$strmoyenne4 = " avis";

	$view .= '<span class="client_reviews_1" itemprop="ratingValue">'. $strmoyenne1 . '</span>';
  $view .= '<span class="client_reviews_1" >'. $strmoyenne2 . '</span>';
  $view .= '<span class="client_reviews_1" itemprop="ratingCount">'. $strmoyenne3 . '</span>';
  $view .= '<span class="client_reviews_1">'. $strmoyenne4 . '</span><br />';
	$view .= '<span class="star-note"><img src="'.get_bloginfo('url').'/wp-content/themes/fb/images/star-4_7.png" /></span><br />';
	$view .= 'pour les produits de type <span itemprop="itemReviewed">'.$display_name. '</span>';
	$view .= '</div>';

  ////////////////////////////// affichage des 2 derniers avis pages produits //
	$rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC LIMIT 2", ARRAY_A);

	$view .= '<table id="fbcart_rating" cellspacing="0"><tbody>';

	//$i = 0;
	foreach ($rates as $r) :
		$singlerate = (($r['fir'] + $r['sec'] + $r['thi'])/3); $singlerate = (round($singlerate, 0)) * 20;
		$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$r[unique_id]'");
		$prodname = $wpdb->get_row("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$r[unique_id]'");
		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$order->user'");
    if ($prodname->name == 'Kakemono'){$lienprod = get_bloginfo('url').'/roll-up';}
    elseif ($prodname->name == 'Banderole'){$lienprod = get_bloginfo('url').'/banderoles';}
    elseif ($prodname->name == 'Oriflamme'){$lienprod = get_bloginfo('url').'/oriflammes';}
		elseif (substr($prodname->name, 0, 9) === 'Depliants'){$lienprod = get_bloginfo('url').'/flyers';}
		elseif (substr($prodname->name, 0, 6) === 'Flyers'){$lienprod = get_bloginfo('url').'/flyers';}
    elseif (substr($prodname->name, 0, 8) === 'Affiches'){$lienprod = get_bloginfo('url').'/affiches';}
		elseif (substr($prodname->name, 0, 6) === 'Cartes 350g'){$lienprod = get_bloginfo('url').'/cartes';}
		elseif ($prodname->name == 'Enseigne'){$lienprod = get_bloginfo('url').'/enseignes';}
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
    elseif (substr($prodname->name, 0, 7) === 'Sticker'){$lienprod = get_bloginfo('url').'/stickers';}
    elseif (substr($prodname->name, 0, 5) === 'Tente'){$lienprod = get_bloginfo('url').'/tente-publicitaire-barnum';}
		elseif ($prodname->name == 'Nappe'){$lienprod = get_bloginfo('url').'/nappes-publicitaires';}
    elseif ($prodname->name == 'Stand Tissu'){$lienprod = get_bloginfo('url').'/stand-parapluie';}
    elseif ($prodname->name == 'Comptoir'){$lienprod = get_bloginfo('url').'/stand-parapluie';}
    elseif ($prodname->name == 'Valise'){$lienprod = get_bloginfo('url').'/stand-parapluie';}
    elseif ($prodname->name == 'Stand ExpoBag'){$lienprod = get_bloginfo('url').'/stand-parapluie';}
		elseif ($prodname->name == 'Cadre tissu'){$lienprod = get_bloginfo('url').'/cadre-tissu';}
    elseif ($prodname->name == 'Enseigne stand suspendue'){$lienprod = get_bloginfo('url').'/enseigne-suspendue-textile';}
    else {$lienprod = get_bloginfo('url').'/banderoles';};

    // séparer nom prénom et ne garder que l'initiale du nom--------------------
    $nomcomplet = trim($us->f_name);
    $nom = (strpos($nomcomplet, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $nomcomplet);
    $prenom = trim( preg_replace('#'.$nom.'#', '', $nomcomplet ) );
    $nom = substr($nom, 0, 1);
    //--------------------------------------------------------------------------

		$reponses = $wpdb->get_row("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_reponses` WHERE r_id='$r[id]'");
		if($reponses) {
		$view .= '<tr><td class="lefttd">par '.$prenom.' '.$nom.'<br />'.$r['data'].'
    <br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td><p>'.stripslashes($r['comment']).'</p><div class="review_answer"><p><strong>France Banderole, le '.$reponses->data.' :</strong><br />'.stripslashes($reponses->content).'</p></div></td></tr>';
		} else {
		$view .= '<tr><td class="lefttd">par '.$prenom.' '.$nom.'<br />'.$r['data'].'
    <br />ACHAT :<br /><a href= '.$lienprod.'>'.$prodname->name.'</a><br /></td><td class="lefttd2"><ul class="star-rating2"><li class="current-rating" style="width:'.$singlerate.'px;"></li><li><span class="one-star">1</span></li><li><span class="two-stars">2</span></li><li><span class="three-stars">3</span></li><li><span class="four-stars">4</span></li><li><span class="five-stars">5</span></li></ul></td><td>'.stripslashes($r['comment']).'</td></tr>';
		}

	endforeach;

	$view .= '</tbody></table>';
  $view .= '<a  class="comVoir" href="'.get_bloginfo('url').'/avis_france_banderole?prod_type='.$prod_family.'"><span class="comVoirContent"><i class="fa fa-plus" aria-hidden="true"></i> d\'avis sur ce type de produit</span></a>';
  $view .= '<div class="clear"></div></div>';

	return $view;
}

////////////////////////////////////////////////////////////////////////////////
//                                                               AVIS COTE ADMIN
////////////////////////////////////////////////////////////////////////////////

function fb_admin_rating() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_rating = $prefix."fbs_rating";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_reponses = $prefix."fbs_reponses";
	if (isset($_POST['publish'])) {
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_rating` SET exist='true' WHERE unique_id='$_POST[publish]'");
	}
	if (isset($_POST['unpublish'])) {
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_rating` SET exist='false' WHERE unique_id='$_POST[unpublish]'");
	}
	if (isset($_POST['delrating_act'])) {
		$apdejt = $wpdb->query("DELETE FROM `$fb_tablename_rating` WHERE unique_id='$_POST[delrating_act]'");
	}
	$rates = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` ORDER BY date DESC", ARRAY_A);
	if ($rates) {
		echo '<table class="widefat widecenter"><tr><th>N° DE COMMANDE</th><th>DATE</th><th>CLIENT</th><th>RAPPORT</th><th>COMMUNICATION</th><th>TEMPS</th><th>GENERAL</th><th>TEXT</th><th>PUBLIÉ?</th><th>ACTION</th><th>REPONSE</th><th>SUPPR</th></tr>';
		foreach ($rates as $r) :
			$general = ($r['fir']+$r['sec']+$r['thi'])/3;
			$general = round($general, 2);
			$unpu = '<form name="unpurating" action="" method="post">
			<input type="hidden" name="unpublish" value="'.$r['unique_id'].'" />
			<input type="submit" value="Dépublier" />
			</form>';
			$del = '<form name="delrating action="" method="post">
			<input type="hidden" name="delrating_act" value="'.$r['unique_id'].'" />
			<input type="submit" value="Supprimer" />
			</form>';
			$publ = '<form name="unpurating" action="" method="post">
			<input type="hidden" name="publish" value="'.$r['unique_id'].'" />
			<input type="submit" value="publish" />
			</form>';
			if ($r['exist'] == "true") {
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
			if ($r['exist'] == 'false') {
				$text='<span style="text-decoration:line-through">'.$r['comment'].'</span>';
				$exist='<span style="color:red">'.$r['exist'].'</span>';
			} else {
				$text = $r['comment'];
				$exist= $r['exist'];
			}
			$reponses = $wpdb->get_row("SELECT * FROM `$fb_tablename_reponses` WHERE r_id='$r[id]'");
			if($reponses) {
				$comment = '1 réponse';
			} else {
				$comment = '0 réponse';
			}
			echo '<tr><td><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbdet='.$r->unique_id.'" target="_blank">'.$r['unique_id'].'</a></td><td>'.$r['data'].'</td><td>'.$user.'</td><td style="text-align:center">'.$r['fir'].'</td><td style="text-align:center">'.$r['sec'].'</td><td style="text-align:center">'.$r['thi'].'</td><td style="text-align:center">'.$general.'</td><td>'.$text.'</td><td>'.$exist.'</td><td>'.$act.'</td><td><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fb-ratings-comments&r_id='.$r['id'].'">'.$comment.'</a></td><td>'.$del.'</tr>';
		endforeach;
		echo '</table>';
	}
}

///////////////////////////////////////////////////// réponse aux avis client //

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
		echo '<p>Bienvenue sur l\'administration des réponses aux clients. Pour rédiger une réponse, rendez-vous sur la page <a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fb-ratings">Ratings</a>.</p>';
	}
}

////////////////////////////////////////////////////////////////////////////////
//                                                                       GROUPES
////////////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////
//                                                                      PAIEMENT
////////////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////
  //                                                                    RELANCES
////////////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////
//                                                                       MAILJET
////////////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////
//                                                                      FACTURES
////////////////////////////////////////////////////////////////////////////////

function fbadm_invoice_print($number) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
  $fb_tablename_cf = $prefix."fbs_cf";
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

		$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;" colspan="2"><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2" /><div class="adresseFact"><b>CLIENT</b><br />'.$facture_add.'</div></td></tr><tr><td class="print-no">FACTURE NºF - '.$idzamowienia.'</td></tr><tr><td class="text-center">DATE - '.$query->datamodyfikacji.'</td></tr><tr><td class="print-title">Madame, Monsieur,<br />Veuillez trouver ci-dessous votre facture concernant la commande<br />ref: '.$idzamowienia.'<br />Dans l\'attente d\'une collaboration prochaine,<br />Veuillez agrèer, Madame, Monsieur, nos solutations respectueuses.</td></tr></table></div>';

		$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
		$view .= '<table id="fbcart_cart"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
		foreach ( $products as $products => $item ) {
			$view .= '<tr><td class="lefttd"><span class="name">'.$item['name'].'</span><br /><span class="therest">'.$item['description'].'</span></td><td>'.$item['quantity'].'</td><td>'.$item['prix'].'</td><td>'.$item['prix_option'].'</td><td>'.$item['remise'].'</td><td>'.$item['total'].'</td></tr>';
  	}
    // Afficher réduction supplémentaire //
		$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestrabat) {
			$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
		}
  	$view .= '</table>';

    //---------------------------------------vérifier s'il y a une remise client
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
		if ($exist_remise) {
  		$calculRemise = str_replace(',', '', number_format($exist_remise->remisenew, 2));
  		$cremisetd = '<tr><td class="toleft">REMISE ('.$exist_remise->percent.'%)</td><td class="toright">-'.$calculRemise.' &euro;</td></tr>';
		}
    //-------------------------------------------vérifier s'il y a un code promo
    $exist_code = $wpdb->get_row("SELECT promo FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");
    if ($exist_code->promo > 1) {
      $calculCode = str_replace(',', '', number_format($exist_code->promo, 2));
      $addtodevis ='<tr><td class="toleft">REMISE</td><td class="toright">-'.$calculCode.' &euro;</td></tr>';
    }
    //----------------------------------------------vérifier escompte commercial
    $esc = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='escompte' AND unique_id = '$idzamowienia'");
    if ($esc) {
      $calculEscompte =  str_replace(',', '', number_format($esc->value, 2));
      $addesc = '<tr><td class="toleft">SUPRRESSION ESCOMPTE COMMERCIAL</td><td class="toright">'.$calculEscompte.'</td></tr>';
    }
    //--------------------------------------------------------------------------
    $totalht = str_replace(',', '', $query->totalht);
    $totalht = $totalht-$calculRemise-$calculCode+$calculEscompte;
    //--------------------------------------------------------------------------
		$tfrais = str_replace(',', '', $query->frais).'&nbsp;&euro;';
		$ttotalht = str_replace(',', '', number_format($totalht, 2)).'&nbsp;&euro;';
		$ttva = str_replace(',', '', $query->tva).'&nbsp;&euro;';
		$ttotalttc = str_replace(',', '', $query->totalttc).'&nbsp;&euro;';
		$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$number."-tva'");
		if ($czyjesttva) {
			$procpod = $czyjesttva->remis;
		} else {
			$procpod = '20.0';
		}
		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr>'.$addtodevis.$cremisetd.$addesc.'<tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA ('.$procpod.'%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft total">TOTAL TTC</td><td class="toright total">'.$ttotalttc.'</td></tr></table></div>';

		if ($query->payment == 'cheque') { $method = 'CHEQUE'; }
		if ($query->payment == 'bancaire') { $method = 'VIREMENT BANCAIRE'; }
		if ($query->payment == 'carte') { $method = 'CARTE BLEUE'; }
		if ($query->payment == 'administratif') { $method = 'VIREMENT ADMINISTRATIF'; }
		if ($query->payment == 'espece') { $method = 'ESPECE'; }
		if ($query->payment == 'trente') { $method = 'PAIEMENT A 30 JOURS'; }
		if ($query->payment == 'soixante') { $method = 'PAIEMENT A 60 JOURS'; }

		$view .= '<div class="bottomfak onlyprint">FACTURE RÉGLÉE PAR '.$method.'<br /><br /><i>RCS: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 60.000,00 &euro;</i></div>';
		$view .= '<div id="fbcart_buttons3"><a href="javascript:window.print()" id="but_imprimerfacture"></a></div>';
		echo $view;
	}
}

////////////////////////////////////////////////////////////////////////////////
//                                                            FACTURES PRO FORMA
////////////////////////////////////////////////////////////////////////////////

function fbadm_invoice_proprint($number) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
  $fb_tablename_cf = $prefix."fbs_cf";
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

		$view .= '<div class="print_nag"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" /></td><td  class="adresseFact"><b>CLIENT</b><br />'.$facture_add.'</td></tr><tr><td colspan="2" style="padding:20px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">FACTURE PRO FORMA Nº - '.$idzamowienia.'</td></tr><tr><td colspan="2" style="padding:10px 0 0 0; text-align:center;font-weight:bold;font-size:13px;">DATE - '.$query->datamodyfikacji.'</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:12px;">Madame, Monsieur,<br />Veuillez trouver ci-dessous votre facture PRO FORMA concernant la commande<br />ref: '.$idzamowienia.'</td></tr></table></div>';

		$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
		$view .= '<table  id="fbcart_cart"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
		foreach ( $products as $products => $item ) {
			$view .= '<tr><td class="lefttd"><span class="name">'.$item['name'].'</span><br /><span class="therest">'.$item['description'].'</span></td><td>'.$item['quantity'].'</td><td>'.$item['prix'].'</td><td>'.$item['prix_option'].'</td><td>'.$item['remise'].'</td><td>'.$item['total'].'</td></tr>';
  	}
    // Afficher réduction supplémentaire //
		$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestrabat) {
			$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
		}

  	$view .= '</table>';
    //---------------------------------------vérifier s'il y a une remise client
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
		if ($exist_remise) {
	  	$calculRemise = str_replace(',', '', number_format($exist_remise->remisenew, 2));
	  	$cremisetd = '<tr><td class="toleft">REMISE ('.$exist_remise->percent.'%)</td><td class="toright">-'.$calculRemise.' &euro;</td></tr>';
		}
    //-------------------------------------------vérifier s'il y a un code promo
    $exist_code = $wpdb->get_row("SELECT promo FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");
    if ($exist_code->promo > 1) {
      $calculCode = str_replace(',', '', number_format($exist_code->promo, 2));
      $addtodevis ='<tr><td class="toleft">REMISE</td><td class="toright">-'.$calculCode.' &euro;</td></tr>';
    }
    //----------------------------------------------vérifier escompte commercial
    $esc = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='escompte' AND unique_id = '$idzamowienia'");
    if ($esc) {
      $calculEscompte =  str_replace(',', '', number_format($esc->value, 2));
      $addesc = '<tr><td class="toleft">SUPRRESSION ESCOMPTE COMMERCIAL</td><td class="toright">'.$calculEscompte.'</td></tr>';
    }
    //--------------------------------------------------------------------------
    $totalht = str_replace(',', '', $query->totalht);
    $totalht = $totalht-$calculRemise-$calculCode+$calculEscompte;
    //--------------------------------------------------------------------------
		$tfrais = str_replace(',', '', $query->frais).'&nbsp;&euro;';
    $ttotalht = str_replace(',', '', number_format($totalht, 2)).'&nbsp;&euro;';
		$ttva = str_replace(',', '', $query->tva).'&nbsp;&euro;';
		$ttotalttc = str_replace(',', '', $query->totalttc).'&nbsp;&euro;';
		$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$number."-tva'");
		if ($czyjesttva) {
			$procpod = $czyjesttva->remis;
		} else {
			$procpod = '20.0';
		}
		$view .= '<table id="fbcart_check" cellspacing="0"><tr><td class="toleft">FRAIS DE PORT</td><td class="toright">'.$tfrais.'</td></tr>'.$addtodevis.$cremisetd.$addesc.'<tr><td class="toleft">TOTAL HT</td><td class="toright">'.$ttotalht.'</td></tr><tr><td class="toleft">MONTANT TVA ('.$procpod.'%)</td><td class="toright">'.$ttva.'</td></tr><tr><td class="toleft total">TOTAL TTC</td><td class="toright total">'.$ttotalttc.'</td></tr></table></div>';

		if ($query->payment == 'cheque') { $method = 'CHEQUE'; }
		if ($query->payment == 'bancaire') { $method = 'VIREMENT BANCAIRE'; }
		if ($query->payment == 'carte') { $method = 'CARTE BLEUE'; }
		if ($query->payment == 'administratif') { $method = 'VIREMENT ADMINISTRATIF'; }
		if ($query->payment == 'espece') { $method = 'ESPECE'; }
		if ($query->payment == 'trente') { $method = 'PAIEMENT A 30 JOURS'; }
		if ($query->payment == 'soixante') { $method = 'PAIEMENT A 60 JOURS'; }

		$view .= '<div class="bottomfak onlyprint"><br /><br /><i>RCS: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 60.000,00 &euro;</i></div>';
	  $view .= '<div id="fbcart_buttons3"><a href="javascript:window.print()" id="but_imprimerfacture"></a></div>';
	 	echo $view;
	}
}

////////////////////////////////////////////////////////////////////////////////
//                                                              BON DE LIVRAISON
////////////////////////////////////////////////////////////////////////////////

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
	}elseif (( ($l_address != "") && ($f_address != $l_address) ) || ( ($user_liv_address->l_name != "") && ($us->f_name != $user_liv_address->l_name) )) {
    $livraison_add = $user_liv_address->l_name . '<br />' . $user_liv_address->l_comp . '<br />' . $l_address . '<br />' . $l_porte . $user_liv_address->l_code . '<br />' . $user_liv_address->l_city . '<br />' . $user_liv_address->l_phone;
		$boucle_if = 2;
  }else{
    $livraison_add = $facture_add;
		$boucle_if = 3;
  }

  $coliR = EstColieRevendeur($number);

  $hasPD = false;
	$hasBLXLS = false;
  if ($coliR) {
    $BLFile = il_y_a_fichier_bl($number);
    if ($BLFile != false) {
      $hasPD = $BLFile;
    }

  	$BLXLSFile = il_y_a_fichier_BLXLS($number);
    if ($BLXLSFile != false) {
      $hasBLXLS = $BLXLSFile;
    }

		$view .= '
			<div id="barSPLImg" style="width: 100%; height: 150px; position: relative;"></div>
			<div class="print_nag onlyprint">
				<table class="print_header">
					<tr>
						<td style="float:left;width:49%;">
							<p style="color: #000;">' . $livraison_add . '</p>
						</td>
						<td style="float:right;width:49%;text-align:right;">
						<img src="../wp-content/plugins/fbshop/barcodes_GkA32Bn09fKNxSL/' . basename(renvoiCodeBar($number)) . '" width="300" height="100" alt="code barre" class="onlyprint" />
						</td>
					</tr>
					<tr>
						<td class="print-no">BON DE LIVRAISON N° BL – ' . $idzamowienia . '</td>
					</tr>
				</table>
			</div>';

    } else {
    normal:
      $view .= '<div class="print_nag onlyprint">
                  <table class="print_header">
                      <tr>
                          <td style="float:left;">
                              <img src="' . $images_url . 'printlogo.jpg" alt="france banderole" class="logoprint2 onlyprint" />
                          </td>
                          <td">&nbsp;</td>
                      </tr>
                      <tr>
                          <td class="print-no">BON DE LIVRAISON N° BL – ' . $idzamowienia . '</td>
                      </tr>
                  </table>
              </div>';

      $view .= '
          <div class="cheque">
              <table id="fbcart_address">
                  <tr>
                      <th>ADRESSE DE LIVRAISON:</th>
                      <th></th>
                  </tr>
                  <tr>
                      <td>' . $livraison_add . '</td>
                      <td></td>
                  </tr>
              </table>';
      }

      $products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
      $view .= '<table  id="fbcart_cart"><tr><th class="leftth bigger">Description</th><th class="bigger">Quantité</th></tr>';
      foreach ($products as $products => $item) {
          $view .= '<tr><td class="bigger lefttd"><span class="name">' . $item['name'] . '</span><br /><span class="therest">' . $item['description'] . '</span></td><td>' . $item['quantity'] . '</td></tr>';
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
        	$view .= '<div class="bottomfak onlyprint">PAIEMENT PAR ' . $method . '<br /><br /><i>RCS: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 60.000,00 &euro;</i><br /><b><font color="red">CETTE COMMANDE A ÉTÉ CONTROLÉE PAR : OUI - NON</b>  - SIGNATURE : </font></div>';
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

////////////////////////////////////////////////////////////////////////////////
//                                                                  USER REPORTS
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////// PAGE USER REPORTS
function fb_admin_reports_users() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
  $fb_tablename_users_cr = $prefix."fbs_users_cr";
  $fb_tablename_users_co = $prefix."fbs_users_co";
	$acutalyear = date('Y');
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';
	$ptype=$_POST['type'];
	$ptime=$_POST['time'];

	$users_ids = $wpdb->get_col("SELECT DISTINCT user FROM `$fb_tablename_order` ORDER BY id ASC");
	$users_ids = implode(',', $users_ids);

  ///////////////////////////////////////////////////////////////// recherche //
	echo '<p><form name="reportusers" id="report"  class="noprint" action="" method="post">';
	echo '<input type="text" name="generic_search" placeholder="nom, e-mail, société, etc." /> Recherche par nom, prénom, e-mail, société, login, code postal<br />';
	echo '<input type="text" name="search_by_order" placeholder="n° de commande "/> Recherche par numéro de commande <br /><br />';

  ///////////////////////////////////////////////////////////////// sélection //
  //---------------------------------------------------------------------par nom
	echo '
	<select class="urs" name="user_name">
	<option value="">Select name</option>';

	$users_name = $wpdb->get_results("SELECT id, f_name FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY f_name ASC");
	$l = 0;

	foreach ($users_name as $un) :
		if ($un->f_name == '') continue;
		echo '<option value="'.$un->id.'">'.$un->f_name.'</option>';
	endforeach;
  //-------------------------------------------------------------------par login
	echo '
  </select> OR <select class="urs" name="user_login">
	<option value="">Select login</option>';

	$users_login = $wpdb->get_results("SELECT id, login FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY login ASC");
	foreach ($users_login as $ul) :
		if ($ul->login == '') continue;
		echo '<option value="'.$ul->id.'">'.$ul->login.'</option>';
	endforeach;
  //-----------------------------------------------------------------par société
	echo '
  </select> OR <select class="urs" name="user_company">
	<option value="">Select company</option>';

	$users_login = $wpdb->get_results("SELECT id, f_comp FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY f_comp ASC");
	foreach ($users_login as $ul) :
		if ($ul->f_comp == '') continue;
		echo '<option value="'.$ul->id.'">'.$ul->f_comp.'</option>';
	endforeach;
  //--------------------------------------------------------------------par mail
	echo '
  </select> OR <select class="urs" name="user_mail">
	<option value="">Select email</option>';

	$users_login = $wpdb->get_results("SELECT id, email FROM `$fb_tablename_users` WHERE id IN ($users_ids) ORDER BY email ASC");
	foreach ($users_login as $ul) :
		if ($ul->email == '') continue;
		echo '<option value="'.$ul->id.'">'.$ul->email.'</option>';
	endforeach;
  //------------------------------------------------------------------par ventes
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

  //-----------------------------------------------------------------form submit
	echo '<br /><input type="hidden" name="pokaztab" /><input type="submit" style="margin-top:10px;" value="Filter" />
  </form></p>';

  $licznik = 0;
  $liczmak = 0;
  $liczbezmak = 0;

  /////////////////////////////////////////////////////////// traitement form //
  if (isset($_POST['pokaztab']) && ($_POST['users_sales'] == '')) {
    //--------------------------------------------------------recherche générale
  	if($_POST['generic_search'] != "") {
  		fb_getUsersBySearch($_POST['generic_search']);
    //-------------------------------------------------recherche par no commande
  	} else if($_POST['search_by_order'] != "") {
  		fb_getUsersBySearchOrder($_POST['search_by_order']);
    //---------------------------------------------------recherche par sélection
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
      if (isset($_POST['user_code']) && $_POST['user_code']!='') {
        $where = $_POST['user_code'];
      }
    	if (isset($_POST['user_mail']) && $_POST['user_mail']!='') {
    		$where = $_POST['user_mail'];
    	}

    	$sumfrais = 0;
    	$sumtotalht = 0;
    	$sumtva = 0;
    	$sumtotalttc = 0;

      //---------------------------------------traitement remise générale client
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

      //---------------------------------------traitement remises par catégories
      if (!empty($_POST['saveByCat']) && $_POST['saveByCat'] == 'true'){
        $banderole = $_POST['banderole'];
        $rollup = $_POST['rollup'];
        $totem = $_POST['totem'];
        $stand = $_POST['stand'];
        $oriflamme = $_POST['oriflamme'];
        $forex = $_POST['forex'];
        $dibond = $_POST['dibond'];
        $akilux = $_POST['akilux'];
        $pvc = $_POST['pvc'];
        $tente = $_POST['tente'];
        $plvint = $_POST['plvint'];
        $plvext = $_POST['plvext'];
        $sticker = $_POST['sticker'];
        $affiche = $_POST['affiche'];
        $carte = $_POST['carte'];
        $nappe = $_POST['nappe'];
        $susp = $_POST['susp'];
        $cadre = $_POST['cadre'];
        $susp = $_POST['susp'];
        $carte = $_POST['carte'];
        $depliant = $_POST['depliant'];
        $flyer = $_POST['flyer'];

        $excat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid = ".$where."");

        if ($excat) {
          //$update = $wpdb->query("UPDATE `$fb_tablename_users_cr` SET Banderole='$banderole', Roll='$rollup', Totem='$totem', Stand='$stand', Oriflamme='$oriflamme', Forex='$forex', Dibond='$dibond' Akilux='$akilux', PVC='$pvc', Tente='$tente', PLVint='$plvint', PLVext='$plvext', Sticker='$sticker', Affiche='$affiche', Papier='$papier' WHERE uid = ".$where."");
          $wpdb->query("DELETE FROM `$fb_tablename_users_cr` WHERE uid='$where'");
          $ajouter = $wpdb->query("INSERT INTO `$fb_tablename_users_cr` VALUES (not null, '$where', '$banderole', '$rollup', '$totem', '$stand', '$oriflamme', '$forex', '$dibond', '$akilux', '$pvc', '$tente', '$plvint', '$plvext', '$sticker', '$affiche', '$carte', '$nappe', '$susp', '$cadre', '$depliant', '$flyer' )");
        } else {
          $ajouter = $wpdb->query("INSERT INTO `$fb_tablename_users_cr` VALUES (not null, '$where', '$banderole', '$rollup', '$totem', '$stand', '$oriflamme', '$forex', '$dibond', '$akilux', '$pvc', '$tente', '$plvint', '$plvext', '$sticker', '$affiche', '$carte', '$nappe', '$susp', '$cadre', '$depliant', '$flyer' )");
        }
      }

      //-------------------------------------------------------options revendeur

      if (!empty($_POST['saveRev']) && $_POST['saveRev'] == 'true'){
        $sign = $_POST['sign'];
        $coli = $_POST['coli'];
        $devi = $_POST['devi'];
        $exco = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_co` WHERE uid = ".$where."");
        // si le client n'est pas dans la base revendeur, on l'ajoute avec les options par défaut
        if (!$exco) {
          $addrev = $wpdb->query("INSERT INTO `$fb_tablename_users_co` VALUES (not null, '$where', '$sign', '$coli', '$devi')");
        }else{
          $uprev = $wpdb->query("UPDATE `$fb_tablename_users_co` SET sign='$sign', coli='$coli', devi='$devi' WHERE  uid = ".$where."");
        }
      }

      //--------------------------------------------traitement paiments différés
      $pdiff30 = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'pdiff30' AND uid = ".$where."");
      $pdiff60 = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'pdiff60' AND uid = ".$where."");
      $pdiffad = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'pdiffad' AND uid = ".$where."");

      if ( isset($_POST['p30']) || isset($_POST['p60']) || isset($_POST['pad']) ) {
        $p30 = $_POST['p30']; $p60 = $_POST['p60']; $pad = $_POST['pad'];
        if (!$pdiff30) {
          $add = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'pdiff30', '$p30')");
        }else{
          $up = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$p30' WHERE  att_name = 'pdiff30' AND uid = ".$where."");
        }
        if (!$pdiff60) {
          $add = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'pdiff60', '$p60')");
        }else{
          $up = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$p60' WHERE  att_name = 'pdiff60' AND uid = ".$where."");
        }
        if (!$pdiffad) {
          $add = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'pdiffad', '$pad')");
        }else{
          $up = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$pad' WHERE  att_name = 'pdiffad' AND uid = ".$where."");
        }
      }

      //------------------------------------------------- traitement annotations
      $exmemo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = ".$where." AND att_name = 'memo'");
      if (!empty($_POST['memotrue']) && $_POST['memotrue'] == 'true'){
        $memo = $_POST['memo'];
        if (!$exmemo) {
          $add = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$where', 'memo', '$memo')");
        }else{
          $up = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$memo' WHERE  att_name = 'memo' AND uid = ".$where."");
        }
      }

      //----------------------------------------------------------détails client
      //------------------------------------------------------------------------
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

        //-----------------------------------------------------------type compte
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

        //--------------------------------------------get valeur remise générale
    		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = ".$where."");
    		$r1 = '';
    		if (!empty($exist_remise->att_value)) {
    			$r1 = $exist_remise->att_value;
    		}

        //----------------------------------------------------get valeur couleur
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


        //----------------------------------------get valeurs options revendeurs
        $exco = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_co` WHERE uid = ".$where."");
        $cs0 = ''; $cs1 = ''; $cc0 = ''; $cc1 = ''; $cd0 = ''; $cd1 = '';
        if ($exco) {
          if ($exco->sign == 1) $cs1 = ' checked="checked"';
          if ($exco->sign == 0) $cs0 = ' checked="checked"';
          if ($exco->coli == 1) $cc1 = ' checked="checked"';
          if ($exco->coli == 0) $cc0 = ' checked="checked"';
          if ($exco->devi == 1) $cd1 = ' checked="checked"';
          if ($exco->devi == 0) $cd0 = ' checked="checked"';
        }else{
          $cs1 = ' checked="checked"';
          $cc1 = ' checked="checked"';
          $cd0 = ' checked="checked"';
        }

        //---------------------------------------- get valeurs paiments différés
        $pdiff30 = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'pdiff30' AND uid = ".$where."");
        if ($pdiff30->att_value == 1)  $p301 = ' checked="checked"';
        else  $p300 = ' checked="checked"';

        $pdiff60 = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'pdiff60' AND uid = ".$where."");
        if ($pdiff60->att_value == 1)  $p601 = ' checked="checked"';
        else  $p600 = ' checked="checked"';

        $pdiffad = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'pdiffad' AND uid = ".$where."");
        if ($pdiffad->att_value == 1)  $pad1 = ' checked="checked"';
        else  $pad0 = ' checked="checked"';

        //-------------------------------------------------affichage annotations
        $exmemo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = ".$where." AND att_name = 'memo'");
        $annotation = $exmemo->att_value;
        //-------------------------------------------------blocs adresses client

    		echo '<div class="reportTopBloc topBlocA">
          <h2>Adresse de facturation:</h2><br />
          <form name="fb_view_user" method="post" action="admin.php?page=fb-users">
            <input type="hidden" name="action" value="fb_view_user" />
            <input type="hidden" name="fb_view_user_id" value="'.$userinfo->id.'" />
            <input type="submit" name="fb_user_view" class="edit" value="'.$userinfo->login.'">
          </form><br />'
          .$userinfo->email.'<br />'
          .$userinfo->f_name.'<br />'
          .$userinfo->f_comp.'<br />'
          .$f_address.'<br />'.$f_porte.'<br />'
          .$userinfo->f_code.'<br />'
          .$userinfo->f_city.'<br />'
          .$userinfo->f_phone.'
        </div>';

    		echo '<div class="reportTopBloc topBlocA">
          <h2>Adresse de livraison:</h2><br />'
          .$userinfo->l_name.'<br />'
          .$userinfo->l_comp.'<br />'
          .$l_address.'<br />'
          .$l_porte.'<br />'
          .$userinfo->l_code.'<br />'
          .$userinfo->l_city.'<br />'
          .$userinfo->l_phone.'

          <h2>Annotations:</h2><br />
          <form method="post" action="" name="memoForm" style="clear:both;">
            <textarea name="memo">'.$annotation.'</textarea>
            <input type="hidden" name="memotrue" value="true" />
            <input type="hidden" name="pokaztab" value="" />
            <input type="hidden" name="user_name" value="'.$_POST["user_name"].'" />
            <input type="hidden" name="user_login" value="'.$_POST["user_login"].'" />
            <input type="submit" class="editAdBtn" value="enregistrer" style="" />
          </form>
        </div>';

        //-----------------------------------------bloc remise générale/couleurs
    		echo '<div class="reportTopBloc topBloc2">
      		<form name="client_remise_options" id="client_remise_options" method="post" action="" />
        		<div class="coll">
              <select name="client_type" id="typeCompte" style="width:98%; margin-top:-5px">
            		<option value=""'.$t1.'>type compte</option>
            		<option value="compte revendeur"'.$t2.'>compte revendeur</option>
            		<option value="client externe"'.$t3.'>client externe</option>
            		<option value="grand compte"'.$t4.'>grand compte</option>
          		</select>
            </div>
            <div class="colr">
              <label for="pourcentage">remise:</label>
              <input type="text" name="client_remise" id="pourcentage" value="'.$r1.'" size="4" />
            </div>

        		<div class="blocscouleur">
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
            </div>

            <div class="paydiff">
              <p>
                Paiement diff 30 &nbsp;&nbsp;&nbsp; oui  <input type="radio"  name="p30" value="1" class="checkbox" '.$p301.'>
                non <input type="radio" name="p30" value="0" class="checkbox" '.$p300.'>
              </p>
              <p>
                Paiement diff 60 &nbsp;&nbsp;&nbsp; oui <input type="radio" name="p60" value="1" class="checkbox" '.$p601.'>
                non <input type="radio" name="p60" value="0" class="checkbox" '.$p600.'>
              </p>
              <p>
                Paiement admin &nbsp;&nbsp;&nbsp; oui <input type="radio" name="pad" value="1" class="checkbox" '.$pad1.'>
                non <input type="radio" name="pad" value="0" class="checkbox" '.$pad0.'>
              </p>
            </div>


            <div class="userID">User ID : '.$where.'</div>

        	  <input type="submit" class="editAdBtn" value="enregistrer" /><input type="hidden" name="client_saveremise" value="true" /><input type="hidden" name="pokaztab" value="" /><input type="hidden" name="user_name" value="'.$_POST["user_name"].'" /><input type="hidden" name="user_login" value="'.$_POST["user_login"].'" />
      		</form>


    		</div>';

        //------------------------------------bloc remises par catégorie produit
        $cat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid = ".$where."");
        $bba = $cat->Banderole;
        $bro = $cat->Roll;
        $bto = $cat->Totem;
        $bst = $cat->Stand;
        $bor = $cat->Oriflamme;
        $bfx = $cat->Forex;
        $bdd = $cat->Dibond;
        $bak = $cat->Akilux;
        $bpv = $cat->PVC;
        $bte = $cat->Tente;
        $bpi = $cat->PLVint;
        $bpe = $cat->PLVext;
        $bsk = $cat->Sticker;
        $baf = $cat->Affiche;
        $bpa = $cat->Cartes;
        $bde = $cat->Depliant;
        $bfl = $cat->Flyer;
        $bna = $cat->Nappe;
        $bes = $cat->Enseigne;
        $bca = $cat->Cadre;

        echo '<div class="reportTopBloc topBloc3">
      		<form name="client_remisebycat" id="client_remisebycat" method="post" action="" />

        		<div class="coll">
              <label>banderole:</label> <input type="text" name="banderole" value="'.$bba.'" />
              <label>roll-up:</label> <input type="text" name="rollup" value="'.$bro.'"  />
              <label>totem:</label> <input type="text" name="totem" value="'.$bto.'" />
              <label>stand:</label> <input type="text" name="stand" value="'.$bst.'" />
              <label>oriflamme:</label> <input type="text" name="oriflamme" value="'.$bor.'"  />
              <label>forex:</label> <input type="text" name="forex" value="'.$bfx.'" />
              <label>dibond:</label> <input type="text" name="dibond" value="'.$bdd.'" />
              <label>akilux:</label> <input type="text" name="akilux" value="'.$bak.'"  />
              <label>pvc:</label> <input type="text" name="pvc" value="'.$bpv.'"  />
              <label>tente:</label> <input type="text" name="tente" value="'.$bte.'" />

            </div>

            <div class="colr">
              <label>plv-int:</label> <input type="text" name="plvint" value="'.$bpi.'" />
              <label>plv-ext:</label> <input type="text" name="plvext" value="'.$bpe.'" />
              <label>sticker:</label> <input type="text" name="sticker" value="'.$bsk.'" />
              <label>affiche:</label> <input type="text" name="affiche" value="'.$baf.'" />
              <label>carte:</label> <input type="text" name="carte" value="'.$bpa.'" />
              <label>dépliant:</label> <input type="text" name="depliant" value="'.$bde.'" />
              <label>flyer:</label> <input type="text" name="flyer" value="'.$bfl.'" />
              <label>nappe:</label> <input type="text" name="nappe" value="'.$bna.'" />
              <label>susp:</label> <input type="text" name="susp" value="'.$bes.'"  />
              <label>cadre:</label> <input type="text" name="cadre" value="'.$bca.'" />
            </div>

        		<input type="submit" class="editAdBtn" value="enregistrer" /><input type="hidden" name="saveByCat" value="true" /><input type="hidden" name="pokaztab" value="" /><input type="hidden" name="user_name" value="'.$_POST["user_name"].'" /><input type="hidden" name="user_login" value="'.$_POST["user_login"].'" />
      		</form>
    		</div>';
        $revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = ".$where."");
        if ($revendeur) {

          echo '<div class="reportTopBloc topBloc4">
        		<form name="revendeurf" id="revendeur" method="post" action="" />
              <p>
                <div class="left">produit signé offert</div>
                <div class="right">
                  oui <input type="radio" name="sign" value="1" class="checkbox" '.$cs1.'>
                  non <input type="radio" name="sign" value="0" class="checkbox" '.$cs0.'>
                </div>
              </p>

              <p>
                <div class="left">colis revendeur offert</div>
                <div class="right">
                  oui <input type="radio" name="coli" value="1" class="checkbox" '.$cc1.'>
                  non <input type="radio" name="coli" value="0" class="checkbox" '.$cc0.'>
                </div>
              </p>

              <p>
                <div class="left">export devis activé</div>
                <div class="right">
                  oui <input type="radio" name="devi" value="1" class="checkbox" '.$cd1.'>
                  non <input type="radio" name="devi" value="0" class="checkbox" '.$cd0.'>
                </div>
              </p>

          		<input type="submit" class="editAdBtn" value="enregistrer" /><input type="hidden" name="saveRev" value="true" /><input type="hidden" name="pokaztab" value="" /><input type="hidden" name="user_name" value="'.$_POST["user_name"].'" /><input type="hidden" name="user_login" value="'.$_POST["user_login"].'" />
        		</form>
      		</div>';
        }

    	}


      ///////////////////////////////////////////////////// tableau commandes //
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
    		<table id="userRep">
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

    		//echo '<table class="widefat widecenter"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th>ETAT</th><th class="noprint">PRINT</th></tr>';
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
          if ($o->status == 8) $stylstatusu = ' style="background:#6293de;"';

    			echo '</td><td>'.$o->datamodyfikacji.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td'.$stylstatusu.'>'.print_status($o->status).'</td><td class="noprint"><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
    			$sumfrais = $sumfrais+str_replace(',', '', $o->frais);
    			$sumtotalht = $sumtotalht+str_replace(',', '', $o->totalht);
    			$sumtva = $sumtva+str_replace(',', '', $o->tva);
    			$sumtotalttc = $sumtotalttc+str_replace(',', '', $o->totalttc);

    		endforeach;
    		echo '<tr><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">TOTAL</td><td style="vertical-align:middle;font-weight:bold;">'.$sumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalttc.' &euro;</td></tr>';
    		echo '</tbody></table>';
    		//echo '<script type="text/javascript">jQuery(document).ready(function () {jQuery("#userRep").dynatable();});</script>';
    		//END MODIF
    		echo "<p>France banderole crée la maquette: <b>".$liczmak."</b><br />j’ai déjà crée la maquette: <b>".$liczbezmak."</b></p>";
    	}
  	}
  }
  if ($_POST['users_sales'] != '') {
 	  fb_getUsersBySales($_POST['users_sales']);
  }
}

//------------------------------------------------------------------------



// user reports par total ventes ///////////////////////////////////////////////

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
	// echo '<table class="widefat widecenter">';
	// echo '<thead><tr><th width="5">Lp.</th><th width="5">ID</th><th>Login</th><th>Email</th><th>F. name</th><th>F. Company</th><th>F. Phone</th><th>Orders sum</th><th>Action</th></tr></thead>';

	echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table id="userRep">
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
	//echo '<script type="text/javascript">jQuery(document).ready(function () {jQuery("#userRep").dynatable();});</script>';
}

// user reports par recherche //////////////////////////////////////////////////

function fb_getUsersBySearch($search) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	// echo '<table class="widefat widecenter">';
	// echo '<thead><tr><th width="5">Lp.</th><th width="5">ID</th><th>Login</th><th>Email</th><th>F. name</th><th>F. Company</th><th>F. Phone</th><th>Orders sum</th><th>Action</th></tr></thead>';

	//$search_query("SELECT id, login, email, f_name, f_comp, f_phone FROM `$fb_tablename_users` WHERE login LIKE '%".$search."%' OR email LIKE '%".$search."%' OR f_name LIKE '%".$search."%' OR f_comp LIKE '%".$search."%' OR id IN (SELECT user FROM `$fb_tablename_order` WHERE unique_id = '".$search."')");

	$search_query = $wpdb->get_results("SELECT id, login, email, f_name, f_comp, f_code, f_phone FROM `$fb_tablename_users` WHERE login LIKE '%".$search."%' OR email LIKE '%".$search."%' OR f_name LIKE '%".$search."%' OR f_comp LIKE '%".$search."%' OR f_code LIKE '%".$search."%'");

	$licznik = 0;

	if($search_query) {

		echo '<div id="example-1" class="beautifulData" style="clear: both;">
		<table id="userRep">
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
	//echo '<script type="text/javascript">jQuery(document).ready(function () {jQuery("#userRep").dynatable();});</script>';
	} else {
		echo '<p>Aucun résultat de recherche trouvé pour la recherche "'.$search.'"</p>';
	}
}

// user reports par recherche (ordre) //////////////////////////////////////////

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
		<table id="userRep">
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
	//echo '<script type="text/javascript">jQuery(document).ready(function () {jQuery("#userRep").dynatable();});</script>';
	} else {
		echo '<p>Aucun résultat de recherche trouvé pour la recherche "'.$search.'"</p>';
	}
	}

}

////////////////////////////////////////////////////////////////////////////////
//                                                                 ADMIN REPORTS
////////////////////////////////////////////////////////////////////////////////

function fb_admin_reports() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$acutalyear = date('Y');
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
  		<table id="userRep">
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
  		//echo '<table class="widefat widecenter"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th class="noprint">PRINT</th></tr>';
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
  			echo '</td><td>'.$o->datamodyfikacji.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td class="noprint"><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
  			$sumfrais = $sumfrais+str_replace(',', '', $o->frais);
  			$sumtotalht = $sumtotalht+str_replace(',', '', $o->totalht);
  			$sumtva = $sumtva+str_replace(',', '', $o->tva);
  			$sumtotalttc = $sumtotalttc+str_replace(',', '', $o->totalttc);
  		endforeach;
  		echo '<tr><td></td><td></td><td></td><td></td><td style="text-align:center;height:40px;vertical-align:middle;font-weight:bold;">TOTAL</td><td style="vertical-align:middle;font-weight:bold;">'.$sumfrais.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalht.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtva.' &euro;</td><td style="vertical-align:middle;font-weight:bold;">'.$sumtotalttc.' &euro;</td></tr>';
  		echo '</tbody></table>';
  		//echo '<script type="text/javascript">jQuery(document).ready(function () {jQuery("#userRep").dynatable();});</script>';
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
  		<table id="userRep">
  		<thead>
  		<tr>
  		<th></th>
  		<th>N° COMMANDE</th>
  		<th>DESCRIPTION</th>
  		<th>DATE</th>
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
  		//echo '<table class="widefat widecenter"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE CREATE</th><th>ETAT</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th class="noprint">PRiNT</th></tr>';
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
  			echo '</td><td>'.$o->data.'</td><td>'.$status.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td class="noprint"><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
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
    		//echo '<script type="text/javascript">jQuery(document).ready(function () {jQuery("#userRep").dynatable();});</script>';
    		echo "<p>France banderole crée la maquette: <b>".$liczmak."</b><br />j’ai déjà crée la maquette: <b>".$liczbezmak."</b></p>";
    	}
  	}
  }
}

////////////////////////////////////////////////////////////////////////////////
//                                                                  HEADER ADMIN
////////////////////////////////////////////////////////////////////////////////

function fbs_admin_head() {
	echo '<link rel="stylesheet" href="'.get_bloginfo('url').'/wp-content/plugins/fbshop/admin.css" type="text/css" />';
	echo '<link rel="stylesheet" type="text/css" media="print" href="'.get_bloginfo('url').'/wp-content/plugins/fbshop/admin_print.css" />';
  echo '<link href="'.get_bloginfo('stylesheet_directory').'/css/font-awesome.min.css" rel="stylesheet">';
  echo '<script language="javascript" type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/fbshop/js/jquery.table2excel.js"></script>';
}

////////////////////////////////////////////////////////////////////////////////
//                                                                         MAILS
////////////////////////////////////////////////////////////////////////////////

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
  	echo '<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
  			<script type="text/javascript">
  				bkLib.onDomLoaded(function() {
  					new nicEditor({fullPanel : true}).panelInstance(\'incon\');
  				});
  			</script>';
  	echo '<textarea name="nmail_content" id="incon">'.stripslashes($simplemail->content).'</textarea><input type="submit" value="SAVE" class="savebutt3" />';
  	echo '</form>';
  } else {
    echo '<h1><a href="admin.php?page=fb-sms" class="stockbtn">SMS <a class="stockbtn" href="admin.php?page=fb-mails" style="background:#26a7d9">Mails</a> <a class="stockbtn" href="admin.php?page=fb-topic">Commentaires</a></h1>';
  	echo '<div class="form-wrap"><div id="col-container">';
  	echo '<div id="col-right" style="width:29%;margin-top:30px;">';
    /* emails -Ajouter */
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox" style="height:280px"><h3><span>Add new:</span></h3><div class="inside">';
  	echo '<form name="newmail" id="newmail" action="" method="post"><input type="hidden" name="addmail" />';
  	echo '<p>Topic: <input type="text" name="mail_topic" /></p>';
  	echo '<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
  			<script type="text/javascript">
  				bkLib.onDomLoaded(function() {
  					new nicEditor({fullPanel : true}).panelInstance(\'incon\');
  				});
  			</script>';
  	echo '<textarea name="mail_content" id="incon"></textarea><input type="submit" value="SAVE" class="savebutt3" />';
  	echo '</form>';
  	echo '</div></div></div></div>';
  	echo '<div id="col-left" style="width:70%;margin-top:30px;">';
  	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Topic</th><th>Content</th><th>Action</th></tr></thead>';
  	$mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails` ORDER BY topic ASC", ARRAY_A);
  	if ($mails) {
  		foreach ($mails as $m) :
  			$licz = strlen($m['content']);
  			if ($licz > 150) {
  				$tnij = substr(htmlspecialchars($m['content']),0,150);
  	    	    $txt = $tnij."...";
  			} else {
  				$txt = htmlspecialchars($m['content']);
  			}
  			$m['topic'] = stripslashes($m['topic']);
  			$txt = stripslashes($txt);
  			echo '<tr><td style="text-align:left">'.$m['topic'].'</td><td style="text-align:left">'.$txt.'</td><td>';
  			echo '<p><form name="form_edmail" id="form_edmail" method="post" action="">';
  			echo '<input type="hidden" name="fb_editmail" value="'.$m['id'].'" />';
  			echo '<input type="submit" name="fb_mail_edit" class="edit" value="EDIT" /></form></p>';
  			echo '<p><form name="form_delmail" id="form_delmail" method="post" action="">';
  			echo '<input type="hidden" name="fb_delmail" value="'.$m['id'].'" />';
  			echo '<input type="submit" name="fb_mail_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {this.form._wpnonce.value = "'.$bc_delete_nonce.'"; return true;} return false;\' /></form></p>';
  			echo '</td></tr>';
  		endforeach;
  	}
  	echo '</table>';
  	echo '</div></div>';
  }
}

////////////////////////////////////////////////////////////////////////////////
//                                                                           SMS
////////////////////////////////////////////////////////////////////////////////

function fb_admin_sms() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_sms = $prefix."fbs_sms";

	if (isset($_POST['fb_delmail'])) {
		$ident = $_POST['fb_delmail'];
		$wpdb->query("DELETE FROM `$fb_tablename_sms` WHERE id='$ident'");
	}
	if (isset($_POST['addmail'])) {
		$temat = addslashes($_POST['mail_topic']);
		$content = addslashes($_POST['mail_content']);
		$wpdb->query("INSERT INTO `$fb_tablename_sms` VALUES (not null, '".$temat."', '".$content."')");
	}
	if (isset($_POST['editmail'])) {
		$ident = $_POST['editmail'];
		$temat = addslashes($_POST['nmail_topic']);
		$content = addslashes($_POST['nmail_content']);
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_sms` SET topic='$temat', content='$content' WHERE id='$ident'");
	}

  if (isset($_POST['fb_editmail'])) {
  	$ident = $_POST['fb_editmail'];
  	$simplemail = $wpdb->get_row("SELECT * FROM `$fb_tablename_sms` WHERE id = '$ident'");
  	echo '<form name="editmail" id="editmail" action="" method="post"><input type="hidden" name="editmail" value="'.$simplemail->id.'" />';
  	echo '<p>Topic: <input type="text" name="nmail_topic" value="'.stripslashes($simplemail->topic).'" /></p>';

  	echo '<textarea name="nmail_content" id="incon">'.stripslashes($simplemail->content).'</textarea><input type="submit" value="SAVE" class="savebutt3" />';
  	echo '</form>';
  } else {
    echo '<h1><a href="admin.php?page=fb-sms" class="stockbtn" style="background:#26a7d9">SMS <a class="stockbtn" href="admin.php?page=fb-mails">Mails</a> <a class="stockbtn" href="admin.php?page=fb-topic">Commentaires</a></h1>';
  	echo '<div class="form-wrap"><div id="col-container">';
  	echo '<div id="col-right" style="width:29%;margin-top:30px;">';
    /* emails -Ajouter */
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox" style="height:200px"><h3><span>Add new:</span></h3><div class="inside">';
  	echo '<form name="newmail" id="newmail" action="" method="post"><input type="hidden" name="addmail" />';
  	echo '<p>Topic: <input type="text" name="mail_topic" /></p>';

  	echo '<textarea name="mail_content" id="incon"></textarea><input type="submit" value="SAVE" class="savebutt3" />';
  	echo '</form>';
  	echo '</div></div></div></div>';
  	echo '<div id="col-left" style="width:70%;margin-top:30px;">';
  	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Topic</th><th>Content</th><th>Action</th></tr></thead>';
  	$mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_sms` ORDER BY topic ASC", ARRAY_A);
  	if ($mails) {
  		foreach ($mails as $m) :
  			$licz = strlen($m['content']);
  			if ($licz > 150) {
  				$tnij = substr(htmlspecialchars($m['content']),0,150);
  	    	    $txt = $tnij."...";
  			} else {
  				$txt = htmlspecialchars($m['content']);
  			}
  			$m['topic'] = stripslashes($m['topic']);
  			$txt = stripslashes($txt);
  			echo '<tr><td style="text-align:left">'.$m['topic'].'</td><td style="text-align:left">'.$txt.'</td><td>';
  			echo '<p><form name="form_edmail" id="form_edmail" method="post" action="">';
  			echo '<input type="hidden" name="fb_editmail" value="'.$m['id'].'" />';
  			echo '<input type="submit" name="fb_mail_edit" class="edit" value="EDIT" /></form></p>';
  			echo '<p><form name="form_delmail" id="form_delmail" method="post" action="">';
  			echo '<input type="hidden" name="fb_delmail" value="'.$m['id'].'" />';
  			echo '<input type="submit" name="fb_mail_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {this.form._wpnonce.value = "'.$bc_delete_nonce.'"; return true;} return false;\' /></form></p>';
  			echo '</td></tr>';
  		endforeach;
  	}
  	echo '</table>';
  	echo '</div></div>';
  }
}

////////////////////////////////////////////////////////////////////////////////
//                                                                  COMMENTAIRES
////////////////////////////////////////////////////////////////////////////////

function fb_admin_topic() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_topic = $prefix."fbs_topic";

	echo '<h1><a href="admin.php?page=fb-sms" class="stockbtn">SMS <a class="stockbtn" href="admin.php?page=fb-mails">Mails</a> <a class="stockbtn" href="admin.php?page=fb-topic" style="background:#26a7d9">Commentaires</a></h1>';

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
  	echo '<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor({fullPanel : true}).panelInstance(\'incon\');
				});
			</script>';

  	echo '<textarea name="nmail_content" id="incon">'.stripslashes($simplemail->content).'</textarea><input type="submit" value="SAVE" class="savebutt3" />';
  	echo '</form>';
  } else {
  	echo '<div class="form-wrap"><div id="col-container">';
  	echo '<div id="col-right" style="width:29%;margin-top:30px;">';
    /* emails -Ajouter */
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox" style="height:280px"><h3><span>Add new:</span></h3><div class="inside">';
  	echo '<form name="newmail" id="newmail" action="" method="post"><input type="hidden" name="addmail" />';
  	echo '<p>Topic: <input type="text" name="mail_topic" /></p>';
  	echo '<script type="text/javascript" src="'.get_bloginfo('url').'/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
			<script type="text/javascript">
				bkLib.onDomLoaded(function() {
					new nicEditor({fullPanel : true}).panelInstance(\'incon\');
				});
			</script>';
  	echo '<textarea name="mail_content" id="incon"></textarea><input type="submit" value="SAVE" class="savebutt3" />';
  	echo '</form>';
  	echo '</div></div></div></div>';
  	echo '<div id="col-left" style="width:70%;margin-top:30px;">';
  	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Topic</th><th>Content</th><th>Action</th></tr></thead>';
  	$mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` ORDER BY topic ASC", ARRAY_A);
  	if ($mails) {
  		foreach ($mails as $m) :
  			$licz = strlen($m['content']);
  			if ($licz > 150) {
  				$tnij = substr(htmlspecialchars($m['content']),0,150);
  	    	    $txt = $tnij."...";
  			} else {
  				$txt = htmlspecialchars($m['content']);
  			}
  			$m['topic'] = stripslashes($m['topic']);
  			$txt = stripslashes($txt);
  			echo '<tr><td style="text-align:left">'.$m['topic'].'</td><td style="text-align:left">'.$txt.'</td><td>';
  			echo '<p><form name="form_edmail" id="form_edmail" method="post" action="">';
  			echo '<input type="hidden" name="fb_editmail" value="'.$m['id'].'" />';
  			echo '<input type="submit" name="fb_mail_edit" class="edit" value="EDIT" /></form></p>';
  			echo '<p><form name="form_delmail" id="form_delmail" method="post" action="">';
  			echo '<input type="hidden" name="fb_delmail" value="'.$m['id'].'" />';
  			echo '<input type="submit" name="fb_mail_delete" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {this.form._wpnonce.value = "'.$bc_delete_nonce.'"; return true;} return false;\' /></form></p>';
  			echo '</td></tr>';
  		endforeach;
  	}
  	echo '</table>';
  	echo '</div></div>';
  }
}

////////////////////////////////////////////////////////////////////////////////
//                                                               EFFACER DOSSIER
////////////////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////////////////
//                                                                         SALES
////////////////////////////////////////////////////////////////////////////////

function fb_admin_sales() {
	global $wpdb;
  global $current_user;
  get_currentuserinfo();
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";
  $fb_tablename_maquette = $prefix."fbs_maquette";
	$fb_tablename_cf = $prefix."fbs_cf";
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';

  //---------------------------------------------------------------- suprression
	if (isset($_POST['delete_item'])) {
		$num = $_POST['delete_item'];
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$num."'");
		deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$num.'/');
		deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$num.'-projects/');
	}

  //---------------------------------------------------------------- bulk delete
  if (isset($_POST['del_selected'])) {
    foreach($_POST['del_selected'] as $num) :
      $deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$num."'");
      $deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE order_id='".$num."'");
      $deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$num."'");
      deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$num.'/');
      deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$num.'-projects/');
    endforeach;
  }

  //---------------------------------------------------------------------détails
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
  /* affichage */
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
    //$sortby = 'LEFT JOIN '.$fb_tablename_prods.' AS prod ON (unique_id = prod.order_id) WHERE (prod.description LIKE "%j’ai déjà crée la maquette%")';
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
 		$sortby = 'ORDER BY FIELD(o.status,8,0,1,2,3,7), date ASC';
 	}

	if ($_GET['sort'] == 'client') {
		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, CAST(REPLACE(o.totalttc,',','') AS DECIMAL(30,2)) AS sumorder, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o, `$fb_tablename_users` us WHERE us.id = o.user && (o.status < 4 OR o.status > 6) ORDER BY us.f_name");
	} else {
    $orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, CAST(REPLACE(o.totalttc,',','') AS DECIMAL(30,2)) AS sumorder, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H+2:%i') AS datamodyfikacji FROM `$fb_tablename_order` o WHERE o.status < 4 OR o.status > 6 ".$sortby."");
		/* , CAST(totalttc AS DECIMAL(30,2)) AS sumorder*/
	}

	if ($orders) {

		$order_link  = 'admin.php?page=fbsh&sort=number';
		$client_link = 'admin.php?page=fbsh&sort=client';
		$prix_link   = 'admin.php?page=fbsh&sort=totalttc';
		$date_link   = 'admin.php?page=fbsh&sort=datec';
		$etat_link   = 'admin.php?page=fbsh&sort=etat';

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

    echo '<div>';
    fb_stock_alert();
    echo '</div>';
    echo '<h1><a href="admin.php?page=fbsh" class="stockbtn" style="background:#26a7d9">Sales <a class="stockbtn" href="admin.php?page=fbship">Shipped</a> <a class="stockbtn" href="admin.php?page=fbsho">Old</a></h1>';
    echo '<div>';
    fb_tel_alert('0');
    echo '</div>';
    echo '<form id="del_selection" name="delsel" action="" method="post"></form>';

		echo '<table class="widefat widecenter"><tr><th><a href="'.$order_link.'">N° COMMANDE</a></th><th><a href="'.$client_link.'">CLIENT</a></th><th>DESCRIPTION</th><th><a href="'.$prix_link.'">PRIX</a></th><th><a href="'.$date_link.'">DATE</a></th><th><a href="'.$etat_link.'">ETAT</a></th><th>TYPE</th><th>FILES</th><th>LAST ACTION</th><th>COMMENTS</th><th></th><th></th></tr>';

    $totalinactive = '';

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

			$choixMaquette = 0;
			$rush = 0;

			foreach ($prods as $p) :
				if ($p->status == 0) {
					echo '<s style="color:red;">'.$p->name.' ('.$p->quantity.')</s><br />';
				} else {
					echo $p->name.' ('.$p->quantity.')<br />';
				}

			  //-------------------------------------------------vérification maquette
        $find1 = preg_match_all('/France banderole crée la mise en page/', $p->description, $resultat1);
        $maqfb = count($resultat1[0]);

        $find2 = preg_match_all('/je crée ma maquette en ligne/', $p->description, $resultat2);
        $maqol = count($resultat2[0]);

        if      ($maqfb >= 1) $choixMaquette = 1;
        else if ($maqol >= 1) $choixMaquette = 2;
        else                  $choixMaquette = 0;

        //-----------------------------------------si pas de BAT, texte en blanc
        $batcolor = '';
        $cherche3 = '/je ne souhaite pas de BAT/';
        $found3 = preg_match_all($cherche3, $p->description, $resultat3);
        $found23= count($resultat3[0]);
        if ($found3 >= 1) {
          $batcolor = 'nobat"';
        }

  			//-----------------------------------------------------vérification rush
  			if ($p->status == 1) {
  				if ($rush < 1) {
  					$wzorzec2 = '/1J/';
  					$wzorzec  = '/rush/';
  					$czyrush  = preg_match_all($wzorzec, $p->description, $wynikrush);
  					$czyrush2 = preg_match_all($wzorzec2, $p->description, $wynikrush2);
  					$czyrush2 = count($wynikrush2[0]);
  					$czyrush  = count($wynikrush[0]);
  					if ($czyrush >= 1) {
  						$rush = 1;
  					}
  					if ($czyrush2 >= 1) {
  						$rush = 1;

  					}
  				}
  			}
		  endforeach;

      $maktype = 'impression';
      if ($choixMaquette == 1) $maktype = 'creation';
      if ($choixMaquette == 2) $maktype = 'en ligne';

			$filepath='';
			$pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$o->unique_id.'/';

			if(file_exists($pathfiles)) {
				if ($dir = @opendir($pathfiles)) {
          // Ignorer fichiers xml csv & json
          $excludeExtensions = array('csv','xml','json');

			    while(($file = readdir($dir))) {
            if(!is_dir($file) && !in_array($file, array(".","..")) && !in_array(pathinfo($file, PATHINFO_EXTENSION), $excludeExtensions)) {
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

      $waitcolor = '#82ff7f';
      if ($rush == 1) $waitcolor = '#ff664f'; // couleur commandes rush en attente
      $paidcolor = '#f3a0ee';
      if ($rush == 1) $paidcolor = '#ff4ff4'; // couleur commandes rush payées

			$stylstatusu = '';
			if ($o->status == 0) $stylstatusu = ' style="background:'.$waitcolor.';"';
			if ($o->status == 1) $stylstatusu = ' style="background:#feca7f;"';
			if ($o->status == 2) $stylstatusu = ' style="background:'.$paidcolor.';"';
			if ($o->status == 3) $stylstatusu = ' style="background:#7edfff;"';
			if ($o->status == 4) $stylstatusu = ' style="background:#f6ff7e;"';
			if ($o->status == 5) $stylstatusu = ' style="background:#819ac3;"';
			if ($o->status == 6) $stylstatusu = ' style="background:#c4c4c4;"';
			if ($o->status == 7) $stylstatusu = ' style="background:#fbcfd0;"';
      if ($o->status == 8) {
        if($o->payment != '') { // si la commande est payée
					$stylstatusu = ' style="background:linear-gradient(left, '.$paidcolor.' 0%, #6293de 100%);
                             background:-moz-linear-gradient(left, '.$paidcolor.' 0%, #6293de 100%);
                          background:-webkit-linear-gradient(left, '.$paidcolor.' 0%, #6293de 100%)"';

				} else {
  				$stylstatusu = ' style="background:#6293de;"';
				}
      };

      $payday = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='paydate' AND unique_id = '$o->unique_id'");
      if ($payday && $o->status == 7) $stylstatusu = ' style="background:#ea2a6a;"';

      // cause le ralentissement après clôture commande ////////////////////////
			$czyjostatnikomentarz = '';
			$lastcomment = $wpdb->get_row("SELECT c.* FROM `$fb_tablename_comments` as c WHERE c.order_id = '$o->unique_id' AND topic != 'Fichier(s)' ORDER BY c.date DESC");
			if ($lastcomment) {
				if (strpos($lastcomment->author, 'France Banderole') !== false) {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
				} else {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
				}
			}
      //////////////////////////////////////////////////////////////////////////

			$czyjostatniruch = '';
			$lastaction = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '$o->unique_id'");
			if ($lastaction) {
				if ($o->status == 0 || 1 || 2 || 7 || 8 ) {
					if ($lastaction->value == 'fb') {
						$czyjostatniruch = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';

					} else {
						$czyjostatniruch = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
					}
				} else {
					$czyjostatniruch = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
				}
			}

      // récupérer le status manuel de la commande
    	$checkitup = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$o->unique_id'");
    	$reponse = $checkitup->status_check;
      $updater = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$o->unique_id'");

    	$statusCheck = '';
    	if ($reponse <= '1' ) {
    		$statusCheck = '<span class="statusChecked2 statusAllright"><i class="fa fa-check-circle" aria-hidden="true" title="status OK"></i> </span>';
    	}
    	if ($reponse == '2' ) {
    		$statusCheck = '<span class="statusChecked2 statusNotgood"><i class="fa fa-exclamation-circle" aria-hidden="true" title="action requise sur votre commande"></i> </span>';
    	}
    	if ($reponse == '3' ) {
    		$statusCheck = '<span class="statusChecked2 statusVerybad"><i class="fa fa-exclamation-circle" aria-hidden="true" title="problème sur votre commande"></i> </span>';
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
			echo '</td><td>'.$o->totalttc.' &euro;</td><td>'.$o->data.'</td><td'.$stylstatusu.'><span class="statuscol '.$batcolor.'">'.$status.$statusCheck.'</span><span class="updater">admin'.$updater->last_action.'</span></td><td>'.$maktype.'</td><td>'.$filepath.'</td>
			<td>'.$czyjostatniruch.'</td><td>'.$czyjostatnikomentarz.'</td>

			<td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="DETAILS"></form><br />
			<form id="delitem" name="delitem" action="" method="post"><input type="hidden" name="delete_item" value="'.$o->unique_id.'" /><input class="delete" type="submit" value="delete" onclick=\'if (confirm("'.esc_js( "Sûr? Ceci effacera la commande, les produits et commentaires associés" ).'")) {return true;} return false;\' /></form></td>
      <td><input form="del_selection"  type="checkbox" name="del_selected[]" class="checkbox" value="'.$o->unique_id.'"></td>
      </tr>';

      $totalinactive .= cancel_abandonned($o->user);
		endforeach;
		echo '</table>';

    echo '<input type="submit" form="del_selection" style="float:right;margin-top:5px" value="Supprimer les commandes sélectionnées" onclick=\'if (confirm("'.esc_js( "Sûr? Ceci effacera toutes les commandes sélectionnées, les produits et commentaires associés!" ).'")) {return true;} return false;\' />';

    echo '<form name="cancelinactive" action="" method="post">
    <input type="hidden" name="cancelinactive" value="" />
    <p>commandes inactives + de 7J (client sans autre commande active ni clôturée, avec + de 3 avis de relance, le dernier commentaire est un avis de relance et aucun fichier uploadé) :<br /> n°'.$totalinactive.'</p>
    <button>Annuler les commandes inactives</button>
    </form>';
	} else {
		echo 'There\'s nothing yet.';
	}
}
	echo $view;
}

////////////////////////////////////////////////////////////////////////////////
//                                                                       CLOTURE
////////////////////////////////////////////////////////////////////////////////

function fb_admin_sales_old() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_comments = $prefix."fbs_comments";
  $fb_tablename_mails = $prefix."fbs_mails";
  $fb_tablename_maquette = $prefix."fbs_maquette";
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';

  /* suppression item */
	if (isset($_POST['delete_item'])) {
		$num = $_POST['delete_item'];
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$num."'");
    //$deleting = $wpdb->query("DELETE FROM `$fb_tablename_maquette` WHERE order='".$num."'");
	}
  /* suppression des commandes annulées */
	if (isset($_POST['del_cancel'])) {
		$todel = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE status = 6");
		foreach ($todel as $td) :
			$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$td->unique_id."'");
			$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$td->unique_id."'");
      $deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE unique_id='".$td->unique_id."'");
      //$deleting = $wpdb->query("DELETE FROM `$fb_tablename_maquette` WHERE order='".$td->unique_id."'");
		endforeach;
  // $deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE status='6'");
	}

  /* détails */
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
  /* affichage */
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
      //$sortby = 'LEFT JOIN '.$fb_tablename_prods.' AS prod ON (unique_id = prod.order_id) WHERE (prod.description LIKE "%j’ai déjà crée la maquette%")';
      //AND prod.description LIKE "%j’ai déjà crée la maquette%"
      //WHERE unique_id = prod.order_id
		  }
  	} else {
   		$sortby = 'ORDER BY data DESC';
   	}
	$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$fb_tablename_order` o WHERE (o.status = 5 || o.status = 6)"));
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
		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o, `$fb_tablename_users` us WHERE us.id = o.user && (o.status = 5 || o.status = 6) ORDER BY us.f_name LIMIT $offset, $limit");
	} else {
		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o WHERE (o.status = 5 || o.status = 6) ".$sortby." LIMIT $offset, $limit");
	}
	if ($orders) {
		echo '<h1><a href="admin.php?page=fbsh" class="stockbtn">Sales <a class="stockbtn" href="admin.php?page=fbship">Shipped</a> <a class="stockbtn" href="admin.php?page=fbsho" style="background:#26a7d9">Old</a></h1>';

		echo '<form name="delete_calceled" action="" method="post"><input type="hidden" name="del_cancel" value="true" /><input class="canceled" type="submit" value="Delete canceled commands" onclick=\'if (confirm("'.esc_js( "Are you sure? You will delete this order, all products and all comments!" ).'")) {return true;} return false;\' /></form>';

		echo '<table class="widefat widecenter"><tr><th><a href="admin.php?page=fbsho&sort=number">N° DE COMMANDE</a></th><th><a href="admin.php?page=fbsho&sort=client">CLIENT</a></th><th>DESCRIPTION</th><th>PRIX</th><th><a href="admin.php?page=fbsho&sort=datec">DATE CREATE</a></th><th><a href="admin.php?page=fbsho&sort=datem">DATE MODIFY</a></th><th><a href="admin.php?page=fbsho&sort=etat">ETAT</a></th><th>TYPE</th><th>FILES</th><th>PRINT</th><th>COMMENTS</th><th></th></tr>';
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
			$choixMaquette = 0;

			foreach ($prods as $p) :
				if ($p->status == 0) {
					echo '<s style="color:red;">'.$p->name.' ('.$p->quantity.')</s><br />';
				} else {
					echo $p->name.' ('.$p->quantity.')<br />';
				}

			  //-------------------------------------------------vérification maquette
        $find1 = preg_match_all('/France banderole crée la mise en page/', $p->description, $resultat1);
        $maqfb = count($resultat1[0]);

        $find2 = preg_match_all('/je crée ma maquette en ligne/', $p->description, $resultat2);
        $maqol = count($resultat2[0]);

        if      ($maqfb >= 1) $choixMaquette = 1;
        else if ($maqol >= 1) $choixMaquette = 2;
        else                  $choixMaquette = 0;

			endforeach;

			$maktype = 'impression';
			if ($choixMaquette == 1) $maktype = 'creation';
      if ($choixMaquette == 2) $maktype = 'en ligne';
      //------------------------------------------------------------------------

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
      if ($o->status == 8) $stylstatusu = ' style="background:#6293de;"';

			$czyjostatnikomentarz = '';
			$lastcomment = $wpdb->get_row("SELECT c.* FROM `$fb_tablename_comments` as c WHERE c.order_id = '$o->unique_id' ORDER BY c.date DESC");
			if ($lastcomment) {
				if (($lastcomment->author == 'France Banderole') || ($lastcomment->author == 'France Banderole 1') || ($lastcomment->author == 'France Banderole 2') || ($lastcomment->author == 'France Banderole 3') || ($lastcomment->author == 'France Banderole 4') || ($lastcomment->author == 'France Banderole 5') || ($lastcomment->author == 'France Banderole FB EXPEDITION')) {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
				} else {
					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
				}
			}

			echo '</td><td>'.$o->totalttc.' &euro;</td><td>'.$o->data.'</td><td>'.$o->datamodyfikacji.'</td><td'.$stylstatusu.'>'.$status.'</td><td>'.$maktype.'</td><td>'.$filepath.'</td>
			<td><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td><td>'.$czyjostatnikomentarz.'</td>
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

function get_data($url) {
	$ch = curl_init();
	$timeout = 25;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

////////////////////////////////////////////////////////////////////////////////
//                                                            Page SHIPPED SALES
////////////////////////////////////////////////////////////////////////////////

function fb_admin_sales_shipped() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_comments = $prefix."fbs_comments";
  $fb_tablename_mails = $prefix."fbs_mails";
  $fb_tablename_cf = $prefix."fbs_cf";
  $fb_tablename_maquette = $prefix."fbs_maquette";
  $fb_tablename_address = $prefix . "fbs_address";
  $fb_tablename_topic = $prefix."fbs_topic";
  $fb_tablename_comments_new = $prefix."fbs_comments_new";
	$imagespath = get_bloginfo("url").'/wp-content/plugins/fbshop/images/';

  /* suppression item */
	if (isset($_POST['delete_item'])) {
		$num = $_POST['delete_item'];
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE order_id='".$num."'");
		$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$num."'");
    //$deleting = $wpdb->query("DELETE FROM `$fb_tablename_maquette` WHERE order='".$num."'");
	}

  /* détails */
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
  /* affichage */
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

	  	}
  	} else {
   		$sortby = 'ORDER BY data DESC';
   	}
  	$count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM `$fb_tablename_order` o WHERE o.status = 4"));
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
  		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o, `$fb_tablename_users` us WHERE us.id = o.user && o.status = 4 ORDER BY us.f_name LIMIT $offset, $limit");
  	} else {
  		$orders = $wpdb->get_results("SELECT o.*, DATE_FORMAT(o.date, '%d/%m/%Y<br />%H:%i') AS data, DATE_FORMAT(o.date_modify, '%d/%m/%Y<br />%H:%i') AS datamodyfikacji FROM `$fb_tablename_order` o WHERE o.status = 4 ".$sortby." LIMIT $offset, $limit");
  	}

    //----------------------------------- passage automatique expédié -> clôturé
    /*
    CONDITIONS:
    TRANSPORTEUR : a bien été selectionné x
    N° COLIS : a bien été renseigné
    statut : est bien en expédié
    paied : a bien un mode de reglement selectionné
    total commande HT : doit être inférieur à 500 €ht x
    + check status des colis chez les transporteurs (amorcé ci-dessous)
    Le colis est livré : autre
    Votre colis a été livré : tnt
    Le colis est livré : dpd
    */

  	if (isset($_POST['bulk_close'])) {
  		$toclose = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE status = 4");

  		foreach ($toclose as $tc) :
        $uid   = $tc->unique_id;
        $paid  = $tc->payment;
        $total = str_replace(',', '', $tc->totalht);
        //if (!empty($tc['payment'])) {

        if($total < 500 && ($paid == 'carte') ||  ($paid == 'cheque') ||  ($paid == 'bancaire') ||  ($paid == 'espece')) {

          $transp  = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type = 'shipping' AND unique_id = $uid");
          $shipper = $transp->value;
          $livred  = 0;
          $shipped = 0;

          echo '<div>';

          if ($shipper == 'tnt'){
            $href = 'https://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?btnSubmit=&radiochoixrecherche=BT&bonTransport='.$tc->tnt.'&radiochoixtypeexpedition=NAT';
            $url = get_data($href);
            $str = utf8_encode($url);

            $livred = preg_match_all('/Votre colis a (.*) livr/ui', $str, $result);
    				$livred = count($result[0]);
          }

          if($shipper == 'dpd') {
            $href = 'http://e-trace.ils-consult.fr/dpd-webtrace/webtrace.aspx?sdg_landnr=250&sdg_mandnr=013&sdg_lfdnr='.$tc->tnt.'&cmd=SDG_SEARCH';
            $url = get_data($href);
            $str = utf8_encode($url);

            $livred = preg_match_all('/Le colis est livr/ui', $str, $result);
    				$livred = count($result[0]);
          }

          /*if ($shipper == 'autre') {

          }*/

          if ($livred  >= 1) {
            $shipped = 1;
            echo $tc->tnt.' colis livré - clôture commande '.$uid.' total HT: '.$total.'€ transporteur: '.$shipper.' | <a href="'.$href.'" target="blank">CHECK</a>';

          }else{
            $shipped = 0;
            echo $tc->tnt.' colis en transit - stand by commande '.$uid.' total HT: '.$total.'€ transporteur: '.$shipper.' | <a href="'.$href.'" target="blank">CHECK</a>';
          }

          if($shipped == 1) {
            echo ' on peut passer en cloturé';
            traitement_passage_cloture($tc->unique_id,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address);
      			//$deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$tc->unique_id."'");
      			//$deleting = $wpdb->query("DELETE FROM `$fb_tablename_order` WHERE unique_id='".$tc->unique_id."'");
            //$deleting = $wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE unique_id='".$tc->unique_id."'");
            //$deleting = $wpdb->query("DELETE FROM `$fb_tablename_maquette` WHERE order='".$tc->unique_id."'");
          }

            echo '</div>';
        }

  		endforeach;
    // $deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE status='6'");
  	}

    //--------------------------------------------------------------------------
    echo '<h1><a href="admin.php?page=fbsh" class="stockbtn">Sales <a class="stockbtn" href="admin.php?page=fbship" style="background:#26a7d9">Shipped</a> <a class="stockbtn" href="admin.php?page=fbsho">Old</a></h1>';

  	if ($orders) {

      echo '<form name="bulk_shipped" action="" method="post"><input type="hidden" name="bulk_close" value="true" /><input class="canceled" type="submit" value="Clôturer les commandes livrées" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form>';

  		echo '<table class="widefat widecenter"><tr><th><a href="admin.php?page=fbship&sort=number">N° DE COMMANDE</a></th><th><a href="admin.php?page=fbship&sort=client">CLIENT</a></th><th>DESCRIPTION</th><th>PRIX</th><th><a href="admin.php?page=fbship&sort=datec">DATE CREATE</a></th><th><a href="admin.php?page=fbship&sort=datem">DATE MODIFY</a></th><th><a href="admin.php?page=fbship&sort=etat">ETAT</a></th><th>TYPE</th><th>FILES</th><th>PRINT</th><th>COMMENTS</th><th></th></tr>';
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
  			$choixMaquette = 0;

  			foreach ($prods as $p) :
  				if ($p->status == 0) {
  					echo '<s style="color:red;">'.$p->name.' ('.$p->quantity.')</s><br />';
  				} else {
  					echo $p->name.' ('.$p->quantity.')<br />';
  				}

  			  //-------------------------------------------------vérification maquette
          $find1 = preg_match_all('/France banderole crée la mise en page/', $p->description, $resultat1);
          $maqfb = count($resultat1[0]);

          $find2 = preg_match_all('/je crée ma maquette en ligne/', $p->description, $resultat2);
          $maqol = count($resultat2[0]);

          if      ($maqfb >= 1) $choixMaquette = 1;
          else if ($maqol >= 1) $choixMaquette = 2;
          else                  $choixMaquette = 0;

  			endforeach;

  			$maktype = 'impression';
  			if ($choixMaquette == 1) $maktype = 'creation';
        if ($choixMaquette == 2) $maktype = 'en ligne';
        //------------------------------------------------------------------------

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
        if ($o->status == 8) $stylstatusu = ' style="background:#6293de;"';

  			$czyjostatnikomentarz = '';
  			$lastcomment = $wpdb->get_row("SELECT c.* FROM `$fb_tablename_comments` as c WHERE c.order_id = '$o->unique_id' ORDER BY c.date DESC");
  			if ($lastcomment) {
  				if (($lastcomment->author == 'France Banderole') || ($lastcomment->author == 'France Banderole 1') || ($lastcomment->author == 'France Banderole 2') || ($lastcomment->author == 'France Banderole 3') || ($lastcomment->author == 'France Banderole 4') || ($lastcomment->author == 'France Banderole 5') || ($lastcomment->author == 'France Banderole FB EXPEDITION')) {
  					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik2.png" alt="" />';
  				} else {
  					$czyjostatnikomentarz = '<img src="'.$imagespath.'wykrzyknik.png" alt="" />';
  				}
  			}

  			echo '</td><td>'.$o->totalttc.' &euro;</td><td>'.$o->data.'</td><td>'.$o->datamodyfikacji.'</td><td'.$stylstatusu.'>'.$status.'</td><td>'.$maktype.'</td><td>'.$filepath.'</td>
  			<td><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td><td>'.$czyjostatnikomentarz.'</td>
  			<td><form id="viewdet" name="viewdet" action="" method="get"><input type="hidden" name="page" value="fbsh" /><input type="hidden" name="fbdet" value="'.$o->unique_id.'" /><input class="edit" type="submit" value="DETAILS"></form><br />
  			<form id="delitem" name="delitem" action="" method="post"><input type="hidden" name="delete_item" value="'.$o->unique_id.'" /><input class="delete" type="submit" value="delete" onclick=\'if (confirm("'.esc_js( "Are you sure? You will delete this order, all products and all comments!" ).'")) {return true;} return false;\' /></form></td></tr>';
  		endforeach;
  		echo("<tr><td colspan=8 >Page: ");
  		for($i=1;$i<=$pagenumber;$i++) {
  			$newpage=$limit*($i-1);
  			if($offset!=$newpage) {
  				echo '[<a href="admin.php?page=fbship&sort='.$_GET['sort'].'&offset='.$newpage.$p_ord.'">'.$i.'</a>]';
  			} else {
  				echo "[$i]";
  			}
  		}
  		echo '</table>';
  	} else {
  		echo 'Pas de commande en mode expédié.';
  	}
  }
	echo $view;
}

////////////////////////////////////////////////////////////////////////////////
//                                                               COMPTES CLIENTS
////////////////////////////////////////////////////////////////////////////////

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
		    $haslo = sha1(md5($pass2)); // chiffrement de mot de passe
				$wysylanie = $wpdb->query("UPDATE `$fb_tablename_users` SET pass = '$haslo' WHERE id = '$passid'");
    		$letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour,<br />Vous pouvez vous connecter dans votre accès client avec les informations ci-dessous :<br /><br />MOT DE PASSE : ".$pass2."<br />NOM D’UTILISATEUR : ".$userlogin->login."<br /><br />Une fois connecté(e), vous pourrez modifier ces données si vous le souhaitez en cliquant sur le bouton \"modifier mon compte\".<br /><br />Amicalement,<br />L’équipe FRANCE BANDEROLE</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
				$header = 'From: France Banderole <information@france-banderole.com>';
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

			echo '<p><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fb-users">Go back</a></p>';
		} else {
			echo 'Error.<p><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fb-users">Go back</a></p>';
		}
	} else {
		if ($_POST['action'] == 'fb_del_user') {
			$userid = $_POST['fb_del_user_id'];
			$deleting = $wpdb->query("DELETE FROM `$fb_tablename_users` WHERE id='".$userid."'");
			if ($deleting) echo 'User deleted.';
		}

		$userscount = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `$fb_tablename_users`" ) );
		$offset=$_GET['offset'];
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
		echo '<table class="widefat widecenter">';
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

////////////////////////////////////////////////////////////////////////////////
//                                                                       DETAILS
////////////////////////////////////////////////////////////////////////////////

function fbadm_print_details($number) {
  global $wpdb;
  global $current_user;
  get_currentuserinfo();
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_state = $prefix."fbs_state";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_mails = $prefix."fbs_mails";
  $fb_tablename_sms = $prefix."fbs_sms";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_groupe_paiement = $prefix."fbs_paiement";
	$fb_tablename_paiement_moy = $prefix."fbs_paiement_moy";
  $fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_entree = $prefix."fbs_stock_entree";
  $fb_tablename_auto = $prefix."fbs_stock_auto";
  $fb_tablename_save = $prefix."fbs_save";
  $fb_tablename_promo = $prefix."fbs_codepromo";

  // alertes rappel téléphonique
  echo '<div>';
  fb_tel_alert($number);
  echo '</div>';

  //----------------------------------------------------------------------------
	$order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
	$ktoryuser = $order->user;
	$tntuser = $order->user;
  $wpuser = $current_user->display_name;

  //---------------------------------------------------------- ajout commentaire
	if (isset($_POST['addcomment'])) {
		$tresc = addslashes($_POST['content']);
		$temat = addslashes($_POST['addcomment']);
		$data = date('Y-m-d H:i:s');
		$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$number."', '".$temat."', '".$data."', 'France Banderole ".$wpuser."', '".$tresc."')");
		$dodawanie_new = $wpdb->query("INSERT INTO `$fb_tablename_comments_new` VALUES (not null, '".$number."', '1')");
		$sprawdzcf = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '".$number."'");
    $uporder = $wpdb->query("UPDATE `$fb_tablename_order` SET last_action='$wpuser' WHERE unique_id='$number'");
		if ($sprawdzcf) {
			$apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='fb' WHERE unique_id='".$number."' AND type='lastupdate'");
		} else {
			$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$number."', 'lastupdate', 'fb')");
		}
	}

  //-------------------------------------------------------- effacer commentaire
	if (isset($_POST['delcomment'])) {
		$ident = $_POST['delcomment'];
		$wpdb->query("DELETE FROM `$fb_tablename_comments` WHERE id='$ident' AND order_id='$number'");
	}

  //------------------------------- traitement au save shipping company & number
  if (isset($_POST['changingtnt'])) {
    $newtnt = $_POST['tntn'];
    $newcompany = $_POST['shippingcompany'];

    $apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET tnt='$newtnt' WHERE unique_id='$number'");
    $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='shipping' AND unique_id = '$number'");
    $exra = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='retrait atelier' AND unique_id = '$number'");

    // passer le colis en retrait atelier quand on insère 'ra' dans le champ no colis
    if ($newtnt == 'ra' || $newtnt == 'RA') {
      if ($exra) {
        $upra = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='yes' WHERE unique_id='$number' AND type='retrait atelier'");
      } else {
        $adra = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'retrait atelier', 'yes')");
      }
    }

    // changement transporteur
    if ($sprawdzshipping) {
      $apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='$newcompany' WHERE unique_id='$number' AND type='shipping'");
    } else {
      $dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'shipping', '" . $newcompany . "')");
    }
  }

  //---------------------------- tratitement au save nb colis poids et assurance
  if (isset($_POST['btnSavePoids'])) {
    $poidsColis = $_POST['poids_commende'];
    $hasPoids = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$number'");
    if ($hasPoids) {
      $a = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='" . $poidsColis . "' WHERE unique_id='" . $number . "' and type='poids'");
    } else {
      $b = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'poids', '" . $poidsColis . "')");
    }

    // enregistrement valeur assurance
    $assurance = $_POST['assurance'];
    $exas = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='assurance' AND unique_id = '$number'");
    if ($exas) {
      $upas = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='$assurance' WHERE unique_id='$number' AND type='assurance'");
    } else {
      $adas = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'assurance', '" . $assurance . "')");
    }

  }

  //------------------------------------------------------------------- paiement
	if (isset($_POST['zmianaplatnosci'])) {
		$newplat = $_POST['changeplatnosc'];
		$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET payment='$newplat' WHERE unique_id='$number'");
	}

  //----------------------------------------------------------------------status
	if (isset($_POST['changingstatus'])) {
		$newstat = $_POST['changestatus'];
		if ($newstat == 3) {
			$nowadata = date('Y-m-d H:i:s');
			$apdejt = $wpdb->update($fb_tablename_order, array ( 'status' => $newstat, 'date_modify' => $nowadata), array ( 'unique_id' => $number ) );
      // appel fonction retrait stock auto
      fb_stock_traitement($number);

		} else {
      $nowadata = date('Y-m-d H:i:s');
			$apdejt = $wpdb->update($fb_tablename_order, array ( 'status' => $newstat, 'date_modify' => $nowadata), array ( 'unique_id' => $number ) );
		}
	}

  //------------------------------------------------- Passage en mode traitement
  if (isset($_POST['mode_traitement'])) {
    traitement_passage_paiement_recu($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_sms,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users);
    // appel fonction retrait stock auto
    fb_stock_traitement($number);
  }

  //---------------------------------------------------- Passage en mode expedie
  if (isset($_POST['mode_expedie'])) {
    traitement_passage_expedie($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_sms,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address);
  }

  //---------------------------------------------------- Passage en mode cloturé
  if (isset($_POST['mode_cloture'])) {
    traitement_passage_cloture($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users,$fb_tablename_address);
  }

  //----------------------------------------------------- suppression images bat
	if (isset($_POST['projectfile']) && $_POST['projectfile']!='') {
		unlink($_POST['projectfile']);
	}

  //----------------------------------------génération des fichiers d'expédition
  if (isset($_POST['gettnt'])) {
    /* Nombre de colis */
    $nbcolis = $_POST['nbcolis'];
    $poidsColis = $_POST['poids_commende'];
    $assurance = $_POST['assurance'];

    $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$number'");
    if ($sprawdzshipping) {
      $apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='$nbcolis' WHERE unique_id='$number' AND type='nbcolis'");
    } else {
      $dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '" . $number . "', 'nbcolis', '" . $nbcolis . "')");
    }

    /* On détermine le transporteur pour l'appel de la bonne fonction de génération des fichiers d'expédition */
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
    }elseif('dpd' == strtolower($tnt_ou_fedex)) {
      getDPD($_POST['gettnt'], $_POST['tntuser']);
    }else{
      /* S'il n'y a pas de value, on fait rien */
    }
  }

	//-------------------------------------------------------Ajout nouveau produit
	if((isset($_POST['e_name_new1'])) AND ($_POST['e_name_new1'] != '')) {
		$e_name_new1 = $_POST['e_name_new1'];
		$e_description_new1 = $_POST['e_description_new1'];
		$e_quantity_new1 = $_POST['e_quantity_new1'];
		$e_prix_new1 = $_POST['e_prix_new1'];
		$e_option_new1 = $_POST['e_option_new1'];
		$e_remise_new1 = $_POST['e_remise_new1'];
		$e_total_new1 = $_POST['e_total_new1'];
		$e_frais_new1 = $_POST['e_frais_new1'];
		$add_prod = $wpdb->query("INSERT INTO `$fb_tablename_prods` VALUES('','$number','$e_name_new1','$e_description_new1','$e_quantity_new1','$e_prix_new1','$e_option_new1','$e_remise_new1','$e_total_new1','$e_frais_new1','',1,'','','','')");
	}

  //============================================================= éditer produit
  if (isset($_POST['editdet'])) {
    //----------------------------------------------------------Effacer produits
    if (isset($_POST['e_delete'])) {
      foreach($_POST['e_delete'] as $checked) :
        $deleting = $wpdb->query("DELETE FROM `$fb_tablename_prods` WHERE order_id='".$number."' AND id='".$checked."'");
      endforeach;
    }

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
      $e_frais = number_format((float)$e_frais, 2) . ' €';
      $apdejt = $wpdb->query("UPDATE `$fb_tablename_prods` SET name='$e_name', description='$e_description', quantity='$e_quantity', prix='$e_prix', prix_option='$e_option', remise='$e_remise', total='$e_total', frais='$e_frais' WHERE id='$ktory' AND order_id='$number'");

      // remise supplémentaire à la facture
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
      // remise supplémentaire à la facture
      // changement TVA
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
      // changement TVA
      reorganize($number);
    }
  }

  //------------------------------------------------ changement de groupe client
  $order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
  $uzyt = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$ktoryuser'");

	if (isset($_POST['set_group'])) {
		$new_group = $_POST['cl_group'];
		if($_POST['group_act'] == 'edit') {
			$edit_group = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value = '".$new_group."' WHERE uid = '".$ktoryuser."' AND att_name='client_groupe'");
		} else if($_POST['group_act'] == 'set') {
			$add_group = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$ktoryuser."','client_groupe','".$new_group."')");
		}
	}

  ///////////////////////////////////////////////////////////////////// GET DATA
  $statusy = $wpdb->get_results("SELECT * FROM `$fb_tablename_state` ORDER BY value ASC", ARRAY_A);
  $topics  = $wpdb->get_results("SELECT * FROM `$fb_tablename_topic` ORDER BY content ASC", ARRAY_A);
  $prod    = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id = '$number' ORDER BY id ASC", ARRAY_A);
  $mails   = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails`", ARRAY_A);
  $sms     = $wpdb->get_results("SELECT * FROM `$fb_tablename_sms`", ARRAY_A);

  //====================================== affichage blocs envoi mail com et sms
  echo '<div class="form-wrap"><div id="col-container">';
  echo '<div id="col-right">';

  //------------------------------------------------------------- envoyer un SMS
  echo '<div id="postsms" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>SMS</span></h3><div class="inside">';
  echo '<form name="sendsms" id="sendsms" action="" method="post"><input type="hidden" name="sendsms" /><input type="hidden" name="hiddentopic" value="" /><select name="selsmstopic" onchange="this.form.selsmscontent.innerHTML = this.value; this.form.hiddentopic.value = this.options[selectedIndex].text;" style="float:left;width:100%;"><option value="">choisir...</option>';

  foreach ($sms as $ma) :
    $con = stripslashes($ma['content']);
    $con = htmlspecialchars($con);
    $top = stripslashes($ma['topic']);
    $top = htmlspecialchars($top);
    $order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
    $con = str_replace("NNNNN",$number,$con);
    echo '<option value="' . $con . '">' . $top . '</option>';
  endforeach;

  echo '</select><textarea name="selsmscontent" id="incon"></textarea><input type="submit" value="SEND" class="savebutt3" /></form>';

  $checksms = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='sms' AND unique_id = '$number'");
  $getsms = $checksms->value;

  if (isset($_POST['sendsms'])) {

    $sms = stripslashes($_POST['selsmscontent']);
    echo send_sms($uzyt->f_phone, $sms);

    $lastsms = '<li>'.date('d-m-Y H:i'). ' ' .$_POST['hiddentopic'].'</li>';
    $allsms  = $lastsms.$getsms;
    if (!$checksms) {
      $addDB = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '$number','sms','$lastsms')");
    }else{
      $upDB = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='$allsms' WHERE type='sms' AND unique_id = '$number'");
    }

  }
  echo '<div class="histo">HISTORIQUE <button class="voirPlus2">+</button>/<button class="voirMoins2">-</button></div> <ul class="lastSms">'.$getsms.'</ul> ';
  echo '<div style="clear:both"></div></div></div></div>
  <script>
    jQuery("ul.lastSms li").hide();
    jQuery("ul.lastSms li").first().show();
    jQuery(".voirPlus2").on("click", function() {
      jQuery("ul.lastSms li").fadeIn();
    });
    jQuery(".voirMoins2").on("click", function(){
      jQuery("ul.lastSms li").fadeOut();
    });
  </script>';

  //------------------------------------------------------------ envoyer un mail
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>mail</span></h3><div class="inside">';
  echo '<form name="sendmail" id="sendmail" action="" method="post"><input type="hidden" name="sendmail" /><input type="hidden" name="hiddentopic" value="" /><select name="selmailtopic" onchange="this.form.selmailcontent.innerHTML = this.value; this.form.hiddentopic.value = this.options[selectedIndex].text;" style="float:left;width:100%;"><option value="">choisir...</option>';
  foreach ($mails as $ma) :
    $con = stripslashes($ma['content']);
    $con = htmlspecialchars($con);
    $top = stripslashes($ma['topic']);
    $top = htmlspecialchars($top);
    $order = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$number'");
    $con = str_replace("NNNNN",$number,$con);
    echo '<option value="' . $con . '">' . $top . '</option>';
  endforeach;

  echo '</select><textarea name="selmailcontent" id="incon"></textarea><input type="submit" value="SEND" class="savebutt3" /></form>';

  $checkmail = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$number'");
  $getmail = $checkmail->last_mail;

  if (isset($_POST['sendmail'])) {
    $lastmail = '<li>'.date('d-m-Y H:i'). ' ' .$_POST['hiddentopic'].'</li>';
    $adtodb = $wpdb->query("UPDATE `$fb_tablename_order` SET last_mail='$lastmail $getmail' WHERE unique_id='$number'");

    $temat = htmlspecialchars_decode($_POST['hiddentopic']);
    $zawar = htmlspecialchars_decode($_POST['selmailcontent']);
    $header = 'From: France Banderole <information@france-banderole.com>';
    $header .= "\nContent-type: text/html; charset=UTF-8\n" . "Content-Transfer-Encoding: 8bit\n";

    mail($uzyt->email, stripslashes($temat), stripslashes($zawar),$header);

  }
  echo '<div class="histo">HISTORIQUE <button class="voirPlus">+</button>/<button class="voirMoins">-</button></div> <ul class="lastMails">'.$getmail.'</ul> ';
  echo '<div style="clear:both"></div></div></div></div>
  <script>
    jQuery("ul.lastMails li").hide();
    jQuery("ul.lastMails li").first().show();
    jQuery(".voirPlus").on("click", function() {
      jQuery("ul.lastMails li").fadeIn();
    });
    jQuery(".voirMoins").on("click", function(){
      jQuery("ul.lastMails li").fadeOut();
    });
  </script>';


  //------------------------------------------------------ajouter un commentaire
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>commentaires</span></h3><div class="inside">';

  echo '<form name="newcomm" id="newcomm" action="" method="post"><input type="hidden" name="addcomment" />';
  if ($topics) {
    echo '<select name="selecttopic" id="seltopic" style="width:100%;" onchange="nicEditors.findEditor(\'incon2\').setContent(this.value); this.form.addcomment.value = this.options[selectedIndex].text;"><option value="">choisir...</option>';
    foreach ($topics as $t) :
      $cont = stripslashes($t['content']);
  		$cont = htmlspecialchars($cont);
  		$c_order   = array("\r\n", "\n", "\r");
  		$c_replace = '<br />';
  		$cont = str_replace($c_order, $c_replace, $cont);
      $topt = stripslashes($t['topic']);
      $topt = htmlspecialchars($topt);
      echo '<option value="' . $cont . '"' . $s . '>' . $topt . '</option>';
    endforeach;
    echo '</select>';
		echo '<br /><br />';
  }
?>

	<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/plugins/fbshop/js/nicEdit-latest.js"></script>
	<script type="text/javascript">
		bkLib.onDomLoaded(function() {
			new nicEditor({fullPanel : true}).panelInstance('incon2');
		});
	</script>

<?php
  echo '<textarea name="content" id="incon2"></textarea>';
  echo '<input type="submit" value="SAVE" class="savebutt3" />';
  echo '</form>';
  echo '<div style="clear:both"></div></div></div></div>';

  //------------------------------------------ afficher les commentaires publiés
  $comments = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y %H:%i') AS data FROM `$fb_tablename_comments` WHERE order_id = '$number' ORDER BY date DESC", ARRAY_A);

  if ($comments) {
    foreach ($comments as $c) :
      echo '<div class="comment_right"><span class="comm_title2">Date:</span>&nbsp;' . $c['data'] . '<span class="comm_title3">Expediteur:</span>&nbsp;' .$c['author']. '<p class="sujet"><span class="comm_title2">Sujet:</span>&nbsp;' . $c['topic'] . '</p>' . html_entity_decode(nl2br($c['content'])) . '';
      echo '<form name="delco" action="" method="post" style="text-align:right;margin-right:5px;"><input type="hidden" name="delcomment" value="' . $c['id'] . '" /><input type="submit" value="delete" onclick=\'if (confirm("' . esc_js("Are you sure?") . '")) {return true;} return false;\' /></form></div>';
    endforeach;
  }
  echo '</div>';

  /////////////////////////////////////////// affichage de la table de gauche //
  $explode = explode('|', $uzyt->f_address);
  $f_address = $explode['0'];
  $f_porte = $explode['1'];
  $explode2 = explode('|', $uzyt->l_address);
  $l_address = $explode2['0'];
  $l_porte = $explode2['1'];
  $adresdostawy = $uzyt->l_name . '<br />' . $uzyt->l_comp . '<br />' . $l_address . '<br />' . $l_porte . '<br />' . $uzyt->l_code . '<br />' . $uzyt->l_city . '<br />' . $uzyt->l_phone;
  $useraddress = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$number'");

  //-------------------------------------------modifier l'adresse de facturation
  if(isset($_POST['changeFactSubmit'])) {
    $l_mail = $_POST['l_mail'];
    $l_name = $_POST['l_name'];
    $l_comp = $_POST['l_comp'];
    $l_address = $_POST['l_address'];
    $l_code = $_POST['l_code'];
    $l_city = $_POST['l_city'];
    $l_phone = $_POST['l_phone'];
    $updateAddress = $wpdb->query("UPDATE `$fb_tablename_users` SET email = '$l_mail', f_name = '$l_name', f_comp = '$l_comp', f_address = '$l_address', f_code ='$l_code', f_city = '$l_city', f_phone = '$l_phone' WHERE id = '$ktoryuser'");
  }
  //---------------------------------------------modifier l'adresse de livraison
  if(isset($_POST['changeLivSubmit'])) {
    $l_name = $_POST['l_name'];
    $l_comp = $_POST['l_comp'];
    $l_address = $_POST['l_address'];
    $l_code = $_POST['l_code'];
    $l_city = $_POST['l_city'];
    $l_phone = $_POST['l_phone'];
    $updateAddress = $wpdb->query("UPDATE `$fb_tablename_address` SET l_name = '$l_name', l_comp = '$l_comp', l_address = '$l_address', l_code ='$l_code', l_city = '$l_city', l_phone = '$l_phone' WHERE unique_id = '$number'");
  }

  //--------------------------------------------- afficher l'adresse facturation

	echo '<div id="col-left"><p><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh" class="gobackBtn">Go back</a></p><div class="adresses"><div class="adsFact"><h2>Adresse de facturation</h2><br />';
  $user_siret = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$ktoryuser."' AND att_name = 'client_siret'");
  $user_epub = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$ktoryuser."' AND att_name = 'client_epub'");

  if(isset($_POST['modifFactSubmit'])) {
    echo '
    <form name="changeFactForm" id="changeFact" action="" method="post">
      <input type="text" class="editAd" placeholder="mail" name="l_mail" value="'.$uzyt->email.'" />
      <input type="text" class="editAd" placeholder="nom, prénom" name="l_name" value="'.$uzyt->f_name.'" />
      <input type="text" class="editAd" placeholder="société" name="l_comp" value="'.$uzyt->f_comp.'" />
      <input type="text" class="editAd" placeholder="adresse" name="l_address" value="'.$uzyt->f_address.'" />
      <input type="text" class="editAd" placeholder="code postal" name="l_code" value="'.$uzyt->f_code.'" />
      <input type="text" class="editAd" placeholder="ville" name="l_city" value="'.$uzyt->f_city.'" />
      <input type="text" class="editAd" placeholder="téléphone" name="l_phone" value="'.$uzyt->f_phone.'" />
      <button type="submit" class="editAdBtn" name="changeFactSubmit">Enregistrer</button>
    </form>
    </div>';
  }else{
    echo '<form method="post" action="admin.php?page=fb-reports-users" target="_blank"><input type="hidden" name="user_login" value="'.$ktoryuser.'" /><input type="hidden" name="pokaztab" /><input type="submit" class="edit" value="'.$uzyt->login.'"></form>';
    if ($user_siret->att_value != '') {
  		echo '<br />SIRET : '.$user_siret->att_value;
  	}
  	if($user_epub != '') {
  		echo '<br />Trésor public payeur : '.$user_epub->att_value;
  	}
    echo '<br />' . $uzyt->email . '<br />' . $uzyt->f_name . '<br />' . $uzyt->f_comp . '<br />' . $f_address . '<br />' . $f_porte . '<br />' . $uzyt->f_code . '<br />' . $uzyt->f_city .
    '<br />' .$uzyt->f_phone. '<br />
    <form name="editFactForm" id="editFact" action="" method="post">
    <button type="submit" title="éditer cette adresse" name="modifFactSubmit" class="editAdBtn">Modifier</button></form>
    </div>';
  }
  //---------------------------------------------afficher l'adresse de livraison

  if ($useraddress) {
    $explode2 = explode('|', $useraddress->l_address);
    $l_address = $explode2['0'];
    $l_porte = $explode2['1'] . '<br />';
    $adresdostawy = $useraddress->l_name . '<br />' . $useraddress->l_comp . '<br />' . $l_address . '<br />' . $l_porte . $useraddress->l_code . '<br />' . $useraddress->l_city . '<br />' . $useraddress->l_phone.'
    <form name="editLivForm" id="editLiv" action="" method="post">
    <button type="submit" title="éditer cette adresse" name="modifLivSubmit" class="editAdBtn">Modifier</button></form>
    ';

    if(isset($_POST['modifLivSubmit'])) {
      $adresdostawy = '
      <form name="changeLivForm" id="changeLiv" action="" method="post">
        <input type="text" class="editAd" placeholder="nom, prénom" name="l_name" value="'.$useraddress->l_name.'" />
        <input type="text" class="editAd" placeholder="société" name="l_comp" value="'.$useraddress->l_comp.'" />
        <input type="text" class="editAd" placeholder="adresse" name="l_address" value="'.$useraddress->l_address.'" />
        <input type="text" class="editAd" placeholder="code postal" name="l_code" value="'.$useraddress->l_code.'" />
        <input type="text" class="editAd" placeholder="ville" name="l_city" value="'.$useraddress->l_city.'" />
        <input type="text" class="editAd" placeholder="téléphone" name="l_phone" value="'.$useraddress->l_phone.'" />
        <button type="submit" class="editAdBtn" name="changeLivSubmit">Enregistrer</button>
      </form>
      ';
    }
  }

  echo '<div class="adsLivraison"><h2>Adresse de livraison</h2><br />' . $adresdostawy . '</div>';
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
    $user_epub = $user_epub->att_value.'<br /></div>';
  }

  //////////////////////////////////////////////////////// Bloc résumé client //
  echo '<div class="infosClient">';

	$ktoryuser = $order->user;
  //-----------------récupère la liste des commandes finalisées de l'utilisateur
  $closedorders = $wpdb->get_results("SELECT unique_id, user, date, totalht FROM `$fb_tablename_order` WHERE user = '$ktoryuser' AND status = '5' ORDER BY date ASC");

  //-------------------------------------affiche la date de la première commande
  $first = $closedorders[0]->date;
  if($first != NULL) {
    $firstc = date('d-m-Y',strtotime($first));
  }else{
    $firstc = 'n/a';
  }

  //-------------------------------------affiche la date de la dernière commande
  $last = $closedorders[count($closedorders) - 1]->date;
  if($last != NULL) {
    $lastc = date('d-m-Y',strtotime($last));
  }else{
    $lastc = 'n/a';
  }

  //----------------------------------------------calcule le total ht des ventes
  foreach ($closedorders as $o) {
    $total = $o->totalht;
    // formate le prix avant calcul de manière à supprimer la virgule entre les milliers :
    $total = str_replace(',', '', $total);
    $total = number_format($total, 2, '.', '');
    // additionne les prix de toutes les commandes
    $sum+= $total;
    // reformate le résultat après calcul pour ajouter un espace entre les milliers :
    $formattedSum = number_format($sum, 2, '.', ' ');
    //echo "<pre>";  echo print_r($total);  echo "</pre>";
  }

  //---------------------------------------------------------affiche le total ht
  if ($sum != NULL) {
    $formattedSum = $formattedSum;
  }else{
    $formattedSum = '0';
  }

  //---------------------------------------------------------------- annotations
  $exmemo = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '$ktoryuser' AND att_name = 'memo'");

  if (!empty($_POST['memotrue']) && $_POST['memotrue'] == 'true'){
    $memo = $_POST['memo'];
    if (!$exmemo) {
      $add = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES (not null, '$ktoryuser', 'memo', '$memo')");
    }else{
      $up = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value='$memo' WHERE  att_name = 'memo' AND uid = ".$ktoryuser."");
    }
  }

  //-------------------------------------------------------------------affichage
  echo '<div class="blocLeft">
    <h2>Résumé client</h2><br />
    <p>Commandes finalisées: <span class="hl">' .count($closedorders). '</span></p>
    <p>Première commande: <span class="hl">' .$firstc. '</span></p>
    <p>Dernière commande: <span class="hl">' .$lastc. '</span></p>
    <p>Total commandes HT: <span class="hl">' .$formattedSum. ' €</span></p>

    <form method="post" action="" name="memoForm" style="clear:both;margin-top:10px">
      <textarea name="memo" style="width:100%" placeholder="Remarques">'.$exmemo->att_value.'</textarea>
      <input type="hidden" name="memotrue" value="true" />
      <input type="submit" class="savebutt3" value="save" style="clear:both" />
    </form>
  </div>

  <div class="blocRight">
  <table class="widefat widecenter over" cellspacing="0">
  <thead>
    <tr>
      <th>Produit</th>
      <th>quantité</th>
      <th>total</th>
    </tr>
  </thead>';

  //-------------------------------------------------derniers produits commandés
  $orderuser = $wpdb->get_results("SELECT date, unique_id FROM `$fb_tablename_order` WHERE user = '$ktoryuser'  AND status = '5' ORDER BY date DESC LIMIT 10" );
  foreach ($orderuser as $o) {
    $produits = $wpdb->get_results("SELECT name, quantity, total FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id'");
    foreach ($produits as $p){
      echo '
        <tr>
          <td>'.$p->name.'</td>
          <td>'.$p->quantity.'</td>
          <td>'.$p->total.'</td>
        </tr>
      ';
    }
  }
  echo  '</table>';

  echo '</div>'; // fermeture div .blocRight

  //------------------------------------------------------gestion groupes client
  echo '<div style="clear:both"></div>
  <div class="groupes">';
  //Traitement des données de groupe
	$user_group = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$ktoryuser."' AND att_name = 'client_groupe'");


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

	echo '<br /><input type="submit" class="btnGroup" value="Sauvegarder" />';
  echo '</form>
  </div>'; // fermeture div .groupes

  //----------------------------------------------------------------------------
  echo '</div>'; //  fermeture div .infosClient


  // fin bloc résumé client

  //////////////////////////////////////////////// connexion au compte client //

  $user = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$ktoryuser'");
  $passw = sha1(md5('tempPass123'));

  $count1 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_save` WHERE login = '$user->login'");
  if ($count1==1) {
    $btnCreate = '<button class="btn1 desactive" type="button" disabled>Créer pass temporaire</button>';
    $btnAccess = '<button class="btn2" type="submit">Se connecter côté client</button>';
    $btnReset = '<button class="btn3" type="submit">Reset pass client</button>';
  }else{
    $btnCreate = '<button class="btn1" type="submit">Créer pass temporaire</button>';
    $btnAccess = '<button class="btn2 desactive" type="button" disabled>Se connecter côté client</button>';
    $btnReset = '<button class="btn3 desactive" type="button" disabled>Reset pass client</button>';
  }

  if ($_POST['createTemp']=='createTemp') {
    if ($count1==0) {
      $sauvegarde = $wpdb->query("INSERT INTO `$fb_tablename_save` VALUES ('','$user->login', '$user->pass')");
      $temppw = $wpdb->query("UPDATE `$fb_tablename_users` SET  pass = '$passw' WHERE id = '$ktoryuser'");
      $btnCreate = '<button class="btn1 desactive" type="button" disabled>Créer pass temporaire</button>';
      $btnAccess = '<button class="btn2" type="submit">Se connecter côté client</button>';
      $btnReset = '<button class="btn3" type="submit">Reset pass client</button>';
      $result = 'pass temporaire OK';
    }
  }

  if ($_POST['resetPw']=='resetPw') {
    $savedPw = $wpdb->get_row("SELECT * FROM `$fb_tablename_save` WHERE login = '$user->login'");
    $resetPw = $wpdb->query("UPDATE `$fb_tablename_users` SET  pass = '$savedPw->pass' WHERE login = '$savedPw->login'");
    $delPw = $wpdb->query("DELETE FROM `$fb_tablename_save` WHERE login = '$user->login'");
    $result = 'mot de passe client réinitialisé';
    $btnCreate = '<button class="btn1" type="submit">Créer pass temporaire</button>';
    $btnAccess = '<button class="btn2 desactive" type="button" disabled>Se connecter côté client</button>';
    $btnReset = '<button class="btn3 desactive" type="button" disabled>Reset pass client</button>';
  }

  if ($_POST['logme']=='logme') {
    $verifier = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE login='$user->login' AND pass='$user->pass'");
    /* connection utilisateur*/
    $_SESSION['loggeduser'] = $verifier;
    $_SESSION['loggeduser']->logme = "yes";
  }

  $path= get_bloginfo("url").'/vos-devis/?detail='.$number;
  $login = $user->login;

  echo '<div class="coteClient">
      <form id="createPw" name="createPw" action="" method="post">
    	<input type="hidden" name="createTemp" value="createTemp" />
    	'.$btnCreate.'
    	</form>

      <form id="loginform" name="loginform" action="'.$path.'" method="post" target="_blank">
    	<input type="hidden" name="logme" value="logme" />
    	<input type="hidden" name="loginname" class="logininput" value="'.$login.'" />
    	<input type="hidden" name="loginpass" class="logininput" value="tempPass123"/>
    	'.$btnAccess.'
    	</form>

      <form id="resetform" name="resetform" action="" method="post">
    	<input type="hidden" name="resetPw" value="resetPw" />
    	'.$btnReset.'
    	</form>
      <span class="logresult">'.$result.'</span>
    </div>
  </div>';


  ///////////////////////////////////////////////////// Bloc gestion commande //
  $dateCre = date_create($order->date);
  $dateMod = date_create($order->date_modify);;
  $dateCre = date_format($dateCre,"d/m/Y H:i:s");
  $dateMod = date_format($dateMod,"d/m/Y H:i:s");
  echo '<h1>N° DE COMMANDE: ' . $order->unique_id . '</h1>';
  echo '<p style="margin-bottom:10px;line-height:15px"><b>Date de création:</b>' . $dateCre . '<br />';
  echo '<b>Date de modification:</b>' . $dateMod . '</p>';

  $transporteur = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$number' AND type='shipping'");

  if ($transporteur && $transporteur->value != '0') {
		if (strtolower($transporteur->value) == 'tnt') {
      $ship1 = ' selected="selected" ';
      $ship2 = '';
      $ship3 = '';
			$ship4 = '';
      $lien_check_status = 'https://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?btnSubmit=&radiochoixrecherche=BT&bonTransport=' . $order->tnt . '&radiochoixtypeexpedition=NAT';
      $texte_check_status = "TNT";
    }
    if (strtolower($transporteur->value) == 'dpd') {
      $ship1 = '';
      $ship2 = ' selected="selected" ';
      $ship3 = '';
			$ship4 = '';
      $lien_check_status = '';
      $texte_check_status = "DPD";
      $lien_check_status = 'http://e-trace.ils-consult.fr/dpd-webtrace/webtrace.aspx?sdg_landnr=250&sdg_mandnr=013&sdg_lfdnr='.$order->tnt.'&cmd=SDG_SEARCH';
    }
    if (strtolower($transporteur->value) == 'fedex') {
      $ship1 = '';
      $ship2 = '';
      $ship3 = ' selected="selected" ';
			$ship4 = '';
      //$lien_check_status = 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber='.$order->tnt.'&cntry_code=fr';
      $lien_check_status = 'https://france.fedex.com/te/webapp25?&trans=tesow350&action=recherche_complete&NUM_COLIS=' .$order->tnt;
      $texte_check_status = "FEDEX";
    }
		if (strtolower($transporteur->value) == 'autre') {
      $ship1 = '';
      $ship2 = '';
      $ship3 = '';
			$ship4 = ' selected="selected" ';
      $lien_check_status = $order->tnt;
      $texte_check_status = "AUTRE";
    }
  }

  // Ajout des fonction d'optimisation d'admin /////////////////////////////////

  /* Commande en attente de paiement puis passage en paiement reçu*/

  if ($order->status == 2 || $order->status == 1 || ($order->status == 8 && $order->payment !== '')){
  	passage_paiement_recu();
  }
  if ($order->status==4){
  	passage_cloture();
  }
  // FIN Ajout des fonction d'optimisation d'admin

  //------------------------------------------------------------ Nombre de colis
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

  $exas = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='assurance' AND unique_id = '$order->unique_id'");
  if ($exas) {
    $assur = $exas->value;
  } else {
    $assur = 0; //str_replace(',', '', $order->totalttc);
  }

  //=================================================== select options livraison
	echo '<div class="statusp4">
  <form name="numertnt" id="numertnt" action="" method="post">
  <input type="hidden" name="changingtnt" />
    <p><label for="shippingcompany"><b>TRANSPORTEUR: </b></label>
      <select name="shippingcompany" id="shippingcompany">
        <option value="0">select...</option>
        <option value="tnt"' . $ship1 . '>TNT</option>
        <option value="dpd"' . $ship2 . '>DPD</option>
        <option value="Fedex"' . $ship3 . '>FEDEX</option>
				<option value="autre"' . $ship4 . '>AUTRE</option>
      </select>
    </p>
    <p>
      <label for="tntn"><b>N° COLIS: </b></label>
      <input type="text" name="tntn" id="tntn" value="'.$code_tnt_bon.'" />
      <!--<input type="submit" value="SAVE" class="savebutt4" />-->
    </p>
  <!--</form>
  <form name="gettntform" id="gettntform" action="" method="post">-->
    <input type="hidden" name="gettnt" value="'.$order->unique_id.'" /><input type="hidden" name="tntuser" value="'.$tntuser.'" />
    <!--<p>(valeur commande: '.str_replace(',', '', $order->totalttc).')</p>-->
    <p>
      <label for="nbcolis">
        <b>NB COLIS: </b> <input type="text" name="nbcolis" id="nbcolis" value="'.$nbcolis.'" maxlength="6" size="6" />
        <b class="assu">ASSURANCE:</b> <input type="text" name="assurance" id="assurance" value="'.$assur.'" maxlength="10" size="4" />
      </label>
    </p>

    <p style="margin: 5px auto; display: block;">
      <label for="poids_commende">
        <b>POIDS : </b>
        <input type="text" id="poids_commende" name="poids_commende" value="' . $pdColis . '"  maxlength="6" size="6"/>
        <input type="submit" class="btnSavePoids" name="btnSavePoids" value="Save" />
      </label>
    </p>
    <p style="text-align:center;"><a href="'.$lien_check_status.'" target="_blank" class="but_par checkSt">CHECK '.$texte_check_status.' STATUS</a></p>
    <p><input type="submit" value="IMPRIMER ETIQUETTE TRANSPORT" class="btnImpEtq" /></p>
  </form>
  </div>';

	echo '<div class="statusp"><form name="zmianastatusu" id="zmianastatusu" action="" method="post"><input type="hidden" name="changingstatus" /><label for="changestatus"><b>Status: </b></label><select name="changestatus" id="changestatus">';
	$i = 0;
	$select_pre = '';
	$select_post = '';
	$select_inter = '';
	foreach ($statusy as $stat) :
		$i++;
		if ($stat['value'] == $order->status) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		if($i == 8) {
			$select_inter .= '<option value="'.$stat['value'].'"'.$sel.'>'.$stat['status'].'</option>';
		} else if ($i <= 3) {
			$select_pre .= '<option value="'.$stat['value'].'"'.$sel.'>'.$stat['status'].'</option>';
		} else if ($i > 3) {
			$select_post .= '<option value="'.$stat['value'].'"'.$sel.'>'.$stat['status'].'</option>';
		}
	endforeach;
	echo $select_pre.$select_inter.$select_post;
	echo '</select><input type="submit" value="SAVE" class="savebutt2" /></form></div>';

  // fin select options livraison

  //========================================================== envoi de fichiers
  if(isset($_POST['sendImg'])) {
      // File upload configuration
      $targetDir = (__DIR__).'/../../../uploaded/'.$order->unique_id.'-projects/';
      $allowTypes = array('jpg','png','jpeg','gif','pdf','tiff');
      if (!is_dir($targetDir)) {
          mkdir($targetDir, 0777, true);
      }
      $images_arr = array();
      foreach($_FILES['images']['name'] as $key=>$val){
          $image_name = $_FILES['images']['name'][$key];
          $tmp_name   = $_FILES['images']['tmp_name'][$key];
          $size       = $_FILES['images']['size'][$key];
          $type       = $_FILES['images']['type'][$key];
          $error      = $_FILES['images']['error'][$key];

          // File upload path
          $fileName = basename($_FILES['images']['name'][$key]);
          $targetFilePath = $targetDir . $fileName;

          // Check whether file type is valid
          $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
          if(in_array($fileType, $allowTypes)){
              // Store images on the server
              if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                  $images_arr[] = $targetFilePath;
              }
          }
      }
  }

	echo '<div class="statusp2">

  <form id="batUpload" action="" method="POST" enctype="multipart/form-data">
    <div class="form-inline">
      <input type="hidden" name="sendImg" value="">
      <input class="form-control" type="file" name="images[]" multiple="multiple"/>
      <button id="batUpbtn">Upload</button>
    </div>
  </form>

  <script>
    jQuery("#batUpbtn").click(function() {
      jQuery("#batUpbtn").append(" <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>");
    });
  </script>';

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

  // fin envoi de fichiers

  //-------------------------------------------------- Commande en traitement //
  if($order->status==3 ){ // status 3 = traitement
    $wpdb->query("UPDATE `$fb_tablename_order` SET status_check='1' WHERE unique_id='$number'"); // check ok auto au passage en traitement
    passage_expedie();
  }

  //----------------------------------------------------- Commande en expédié //
  if($order->status==4 ){ // status 4 = expédié
    $wpdb->query("UPDATE `$fb_tablename_order` SET status_check='1' WHERE unique_id='$number'"); // check ok auto au passage en expédié
    // sms commande expédiée
    //send_sms($uzyt->f_phone, 'Votre commande n°'.$number.'a été expédiée. RDV sur france-banderole.com pour le suivi du colis.');
  }

  //======================================================= méthodes de paiement
	echo '<div class="statusp"><form name="formaplatnosci" id="formaplatnosci" action="" method="post"><input type="hidden" name="zmianaplatnosci" /><label for="changeplatnosc"><b>Paied: </b></label><select name="changeplatnosc" id="changeplatnosc">';
	$fplatnosci = array('carte'=>'Carte bleue', 'cheque'=>'Chèque', 'bancaire'=>'Vire bancaire', 'administratif'=>'Vire administratif', 'espece'=>'Espèce', 'trente'=>'Paiement à 30 jours', 'soixante'=>'Paiement LCR 30 jours fin de mois');
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

  //------------------------------------------------------ afficher mode paiment
  $pay_name = $wpdb->get_row("SELECT * FROM `$fb_tablename_paiement_moy` WHERE pay_code = '$order->payment_ch'");
	if(($order->payment_ch != '') AND ($order->status == 7)) {
		echo '<div class="statusp"><b>Moyen de paiement choisi: </b> '.$pay_name->pay_designation.'</div>';
	}

  //------------------------------------------------------------date paiement CB
  $payday = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='paydate' AND unique_id = '$number'");
  if($payday) {
    // on récupère et on affiche la date de paiement
    $date = date_create($payday->value);
    $paydate = date_format($date,"d/m/Y H:i:s");
    echo '<div class="statusp"> <b>Date paiement CB: </b> '.$paydate.'</div>';
  }

  // fin méthodes de paiement
  //----------------------------------------------------------- boutons imprimer

	echo '<div class="statusp"><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbbonprint='.$number.'" target="_blank" class="but_par">Imprimer BL</a><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$number.'" target="_blank" class="but_par">Imprimer facture</a><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceproprint='.$number.'" target="_blank" class="but_par">PRO</a></div>';


  //------------------------------------------------ foncion check status manuel

  if (isset($_POST['statusCheckSubmit'])) { // au check radio & save: update bdd du status manuel
    $checked = $_POST['statusCheck'];
    $wpdb->query("UPDATE `$fb_tablename_order` SET status_check='$checked', last_action='$wpuser' WHERE unique_id='$number'");
  }

  // on récupère la valeur du check sélectionné pour l'afficher
  $checkitup = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$number'");
  $reponse = $checkitup->status_check;
  $statusCheck = '';
  $radio1 = '<label class="statusAllright"><i class="fa fa-check-circle" aria-hidden="true"></i><input class="radioBtn" type="radio" name="statusCheck" value="1" /></label>';
  $radio2 = '<label class="statusNotgood"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><input  class="radioBtn" type="radio" name="statusCheck" value="2" /></label>';
  $radio3 = '<label class="statusVerybad"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><input  class="radioBtn" type="radio" name="statusCheck" value="3" /></label>';

  if ($reponse <= '1' ) {
    $statusCheck = '<span class="statusChecked statusAllright"><i class="fa fa-check-circle" aria-hidden="true"></i> </span>';
    $radio1 = '<label class="statusAllright"><i class="fa fa-check-circle" aria-hidden="true"></i><input class="radioBtn" type="radio" name="statusCheck" value="1" checked /></label>';
  }
  if ($reponse == '2' ) {
    $statusCheck = '<span class="statusChecked statusNotgood"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </span>';
    $radio2 = '<label class="statusNotgood"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><input  class="radioBtn" type="radio" name="statusCheck" value="2" checked /></label>';
  }
  if ($reponse == '3' ) {
    $statusCheck = '<span class="statusChecked statusVerybad"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </span>';
    $radio3 = '<label class="statusVerybad"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><input  class="radioBtn" type="radio" name="statusCheck" value="3" checked /></label>';
  }

  echo '<div class="statusCheck">
    <form name="statusCheckForm" id="statusCheck" action="" method="post">
      <div class="statusCheckButtons">
        '.$radio1.$radio2.$radio3.$statusCheck.'
      </div>
      <input type="submit" value="SAVE"  name="statusCheckSubmit" class="savebutt2" />
    </form>
  </div>';


  // fin check status manuel

  //================================================== Produits dans la commande

	echo '<form name="editdetails" id="editdetails" action="" method="post"><input type="hidden" name="editdet" value="'.$number.'" />';
	//echo '<p><small>Please note that:<br />Description lines should contain break lines marker &lt;br /&gt;<br />Total sum couldn\'t contain Frais de port cost.</small></p>';
	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th style="width:30px;"><i class="fa fa-times-circle" aria-hidden="true"></i></th><th>ITEM</th><th style="width:150px;">DESCRIPTION</th><th>QUANTITÉ</th><th>PRIX U.</th><th>OPTION</th><th>REMISE</th><th>TOTAL</th><th>FRAIS DE PORT</th><th>FILE(S)</th></tr></thead>';

	$licznik = 0;
  $maqol = $maqfb = $maqbt = $maqsb = 0;

	foreach ($prod as $p) :
		$licznik++;
    $i = $licznik;
    if ($licznik < 10) {
      $i = str_pad($licznik, 2, "0", STR_PAD_LEFT);
    }

    $find1 = preg_match_all('/France banderole crée la mise en page/', $p['description'], $resultat1);
    $maqfb += count($resultat1[0]);

    $find2 = preg_match_all('/je crée ma maquette en ligne/', $p['description'], $resultat2);
    $maqol += count($resultat2[0]);

    $find3 = preg_match_all('/BAT en ligne/', $p['description'], $resultat3);
    $maqbt += count($resultat3[0]);

    $find4 = preg_match_all('/pas de BAT/', $p['description'], $resultat4);
    $maqsb += count($resultat4[0]);

		echo '<input type="hidden" name="c'.$licznik.'" value="'.$p['id'].'" />';

    //---------------------------------------- lien maquette pour chaque produit
    $allfiles='';
		$filepath='';
		$pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/';
		if(file_exists($pathfiles)) {
	    if ($dir = @opendir($pathfiles)) {
        while(($file = readdir($dir))) {
          if(!is_dir($file)) {
            if(!in_array($file, array(".",".."))){
              // différencier les fichiers json & csv des fichiers maquette:
              $notimg='';
              $dn='';
              $filename = $file;
              $info = pathinfo(get_bloginfo('url').'/uploaded/'.$number.'/'.$file);
              if ($info["extension"] == "json")                      {$notimg='class="notimg"'; $filename = 'json';};
              if ($info["extension"] == "xml")                       {$notimg='class="notimg"'; $filename = 'xml';};
              if ($info["extension"] == "")                           $dn='style="display:none"';
              if (substr($info["filename"], 0, 7 ) != 'prod'.$i.'-')  $dn='style="display:none"';
              if ($info["extension"] != "") {
                $filepath .= '<a '.$notimg.' '.$dn.' href="'.get_bloginfo('url').'/uploaded/'.$number.'/'.$file.'" target="_blank">'.$filename.'</a>';
                $allfiles .= '<a '.$notimg.' href="'.get_bloginfo('url').'/uploaded/'.$number.'/'.$file.'" target="_blank">'.$filename.'</a> | ';
              }
            }
  				}
    		}
	    	closedir($dir);
  		}
    }
    //--------------------------------------------------------------------------

		$frais = str_replace(',', '', $p['frais']);
    $deleted = '';
    $isdeleted='';
		if ($p['status'] == 0) {
			$deleted = '<br /><span class="pink">supprimé!</span>';
			$isdeleted = ' style="background:#ccc;"';
		}

		echo '<tr'.$isdeleted.'>
    <td><input type="checkbox" name="e_delete[]" class="checkbox" value="'.$p['id'].'"></td>
    <td><input type="text" name="e_name'.$p['id'].'" value="'.$p['name'].'" />'.$deleted.'</td>
    <td><textarea cols="18" rows="7" name="e_description'.$p['id'].'" style="font-size:10px">'.$p['description'].'</textarea></td>
    <td><input type="text" name="e_quantity'.$p['id'].'" value="'.$p['quantity'].'" /></td>
    <td><input type="text" name="e_prix'.$p['id'].'" value="'.$p['prix'].'" /></td>
    <td><input type="text" name="e_option'.$p['id'].'" value="'.$p['prix_option'].'" /></td>
    <td><input type="text" name="e_remise'.$p['id'].'" value="'.$p['remise'].'" /></td>
    <td><input type="text" name="e_total'.$p['id'].'" value="'.$p['total'].'" /></td>
    <td><input type="text" name="e_frais'.$p['id'].'" value="'.$frais.'" /></td>
    <td class="clientfiles">'.$filepath.'</td>
    </tr>';

	endforeach;

  /////////////////////////////////////////////////////////////// générer csv //
  /*if(isset($_POST['inputCSV'])) {
    $chemin = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/'.$number.'.csv';
    $delimiteur = ',';

    // Création du fichier csv produits (le fichier est vide pour le moment)
    // w+ : consulter http://php.net/manual/fr/function.fopen.php

    if(!file_exists($chemin)) {
      $destination = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/';

      if (!is_dir($destination)) {
        mkdir($destination, 0777, true);
      }

      $fichier_csv = fopen($chemin, 'w+');

      // Si votre fichier a vocation a être importé dans Excel, pb accents
      fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));
      // Boucle foreach sur chaque ligne du tableau
      foreach($prod as $p){
        // chaque ligne en cours de lecture est insérée dans le fichier
        fputcsv($fichier_csv, $p, $delimiteur);
      }

      // fermeture du fichier csv
      fclose($fichier_csv);
    }
  }*/
  ///////////////////////////////////////////// zip des fichiers utilisateurs //

  $pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/';
  // retourne un array des fichiers
  $files = scandir($pathfiles);
  // nombre de fichiers dans le dossier client
  $num_files = count($files)-2;

  if(file_exists($pathfiles)) { // s'il y a plus de +d'1 fichiers dans le dossier client
    // calcul taille totale des fichiers client
    $totalSize = 0;
    foreach (new DirectoryIterator($pathfiles) as $file) {
      if ($file->isFile()) {
        $totalSize += $file->getSize();
      }
    }
    // conversion en Megabytes
    $totalSize = number_format($totalSize / 1048576, 2);

    // function to start the zip backup
    function zipData($source, $destination) {
      if (extension_loaded('zip')) {
        if (file_exists($source)) {
          $zip = new ZipArchive();
          if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
            $source = realpath($source);
            if (is_dir($source)) {
              $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
              foreach ($files as $file) {
                $file = realpath($file);
                if (is_dir($file)) {
                  $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file)) {
                  $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
              }
            } else if (is_file($source)) {
              $zip->addFromString(basename($source), file_get_contents($source));
            }
          }
          return $zip->close();
        }
      }
      return false;
    }
    $location = '/wp-admin/admin.php?page=fbsh&fbdet='.$number;
    $zipPath = $_SERVER['DOCUMENT_ROOT'].'/zip/'.$number.'.archive.zip';

    if (!file_exists($zipPath)) {
      $deactDL = $deactTR = 'deactive'; // boutons désactivés tant que l'archive n'est pas générée

    } else {
      $deactDL = '';                   // si le fichier zip existe déjà, bouton dl activé
      $deactTR = '';
      if ($maqbt == 0 && $maqol == 0) $deactTR = 'deactive';
    }

    if (isset($_POST['genzip'])) { // si le bouton générer est cliqué, générer l'archive
      zipData($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/', $_SERVER['DOCUMENT_ROOT'].'/zip/'.$number.'.archive.zip');
      $deactDL = '';
      $deactTR = '';
      if ($maqbt == 0 && $maqol == 0) $deactTR = 'deactive';
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
    }

    if (isset($_POST['fileTr'])) {
      traitement_passage_fichier_recu($number,$fb_tablename_order,$fb_tablename_topic,$fb_tablename_mails,$fb_tablename_sms,$fb_tablename_comments,$fb_tablename_comments_new,$fb_tablename_cf,$fb_tablename_users);
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
    }

    echo '<div class="statuspaction"><b>'.$num_files.'</b> FICHIERS CLIENT - taille totale : '.$totalSize.'MB <br />

    <form action="" method="POST"><input type="hidden" name="genzip" value="" />
      <button class="zipDownload" action="submit"><i class="fa fa-cogs"></i> Générer Zip</button>
    </form>

    <a href="'.get_bloginfo('url').'/zip/'.$number.'.archive.zip" class="zipDownload '.$deactDL.'"><i class="fa fa-file-archive-o" aria-hidden="true"></i> Download Zip</a>

    <form class="fileTr" action="" method="POST"><input type="hidden" name="fileTr" value="" />
      <button class="butdefault fileTr '.$deactTR.'" action="submit">fichier en traitement</button>
    </form>

    </div>';
  }
  // fin zip des fichiers utilisateur
  // fin fichiers utilisateur //////////////////////////////////////////////////

	// ajouter un produit à la commande //////////////////////////////////////////
	echo '<tr>
    <td colspan="9" style="text-align: left;">
      <span id="add_1"><a onClick=\'jQuery("#new_1").toggle("slow");jQuery("#add_1").toggle("slow");\' style="cursor: pointer;">Ajouter un produit à la commande</a></span>
    </td>
  </tr>';

	echo '<tr id="new_1" style="display: none;">
    <td></td>
    <td><input type="text" name="e_name_new1" /></td>
    <td><textarea cols="18" rows="7" name="e_description_new1" style="font-size:10px;" placeholder="Décrivez votre produit"></textarea></td>
    <td><input type="text" name="e_quantity_new1" /></td>
    <td><input type="text" name="e_prix_new1" /></td>
    <td><input type="text" name="e_option_new1" /></td>
    <td><input type="text" name="e_remise_new1"></td>
    <td><input type="text" name="e_total_new1" /></td>
    <td><input type="text" name="e_frais_new1" /></td>
    <td><a onClick=\'jQuery("#new_1").toggle("slow");jQuery("#add_1").toggle("slow");\' style="cursor: pointer;">Supprimer</a></td>
   </tr>';

  //-----------------------------vérifier s'il y a une remise pour l'utilisateur
	$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$number'");
	if ($exist_remise) {
  	$calculRemise = str_replace(',', '', number_format($exist_remise->remisenew, 2));
		echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">REMISE ('.$exist_remise->percent.'%):</td><td>-'.str_replace(',', '', $calculRemise).' &euro;</td></tr>';
	}
  //---------------------------------------------vérifier s'il y a un code promo
  $exist_code = $wpdb->get_row("SELECT promo FROM `$fb_tablename_order` WHERE unique_id = '$number'");

  if ($exist_code->promo > 1) {
    $codename = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE unique_id = '$number' AND type = 'codepromo'");
    if ($codename) $codevalue = '(code: '.$codename->value.')';
    else $codevalue = '';

    // si le code promo est un code SAV ou AVOIR, le supprimer de la bdd

    if (strpos(strtolower($codename->value), 'sav') !== false || strpos(strtolower($codename->value), 'avoir') !== false) {
      if (strpos(strtolower($codename->value), 'sav') !== false) $codevalue = '(code SAV: '.$codename->value.')';
      else                                                       $codevalue = '(code AVOIR: '.$codename->value.')';

      $wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE code='$codename->value'");
    }

    $calculCode = str_replace(',', '', number_format($exist_code->promo, 2));

    echo '<tr>
      <td colspan="6"></td>
      <td colspan="2" style="text-align:right">PROMO '.$codevalue.'</td>
      <td>-'.$calculCode.' &euro;</td>
    </tr>';


  }
  //------------------------------------------------vérifier escompte commercial
  $esc = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='escompte' AND unique_id = '$number'");

  if ($esc) {
    $calculEscompte =  str_replace(',', '', number_format($esc->value, 2));
    echo '<tr>
      <td colspan="6"></td>
      <td colspan="2" style="text-align:right">Suppression escompte</td>
      <td>'.$calculEscompte.' &euro;</td>
    </tr>';
  }
  //----------------------------------------------------------------------------
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">FRAIS DE PORT:</td><td colspan="1">'.str_replace(',', '', $order->frais).' &euro;</td></tr>';
	$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$number'");
	$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$number."-tva'");
	if ($czyjesttva) {
		$procpod = $czyjesttva->remis;
	} else {
		$procpod = '20.00';
	}
  //----------------------------------------------------------------------------
  $totalht = str_replace(',', '', $order->totalht);
  $totalht = $totalht-$calculRemise-$calculCode+$calculEscompte;
  //----------------------------------------------------------------------------
	echo '<tr><td colspan="5"></td><td colspan="3" style="text-align:right">DELAI RUSH OU DISCOUNT:</td><td colspan="1"><input name="totalht2after" type="text" value="'.$czyjestrabat->remis.'" width="5" /> &euro;</td></tr>';
	echo '<tr><td colspan="5"></td><td colspan="3" style="text-align:right">RAISON DELAI RUSH OU DISCOUNT:</td><td colspan="2"><input name="totalht2afterreason" type="text" value="'.$czyjestrabat->reason.'" style="width:170px;" /></td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">TVA %:</td><td colspan="1"><input name="tvaafterreason" type="text" value="'.$procpod.'" width="5" /> %</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">TOTAL HT:</td><td colspan="1">'.str_replace(',', '', number_format($totalht, 2)).' &euro;</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">MONTANT TVA ('.$procpod.'%):</td><td>'.str_replace(',', '', $order->tva).' &euro;</td></tr>';
	echo '<tr><td colspan="6"></td><td colspan="2" style="text-align:right">TOTAL TTC:</td><td colspan="1">'.str_replace(',', '', $order->totalttc).' &euro;</td></tr>
  <tr><td colspan="10"><span class="allfiles">Tous les fichiers : '.$allfiles.'</span></td></tr>';

	echo '</table>';
	echo '<input type="submit" value="SAVE" class="savebutt" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form>';
	echo '</div>';
	echo '</div>';
}

////////////////////////////////////////////////////////////////////////////////
//                                                                       PLV EXT
////////////////////////////////////////////////////////////////////////////////

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
      $copie = copy($f['tmp_name'], $path.$f['name']);
      if (!$copie) {
        $rand = rand(0, 100);
        $copie = copy($f['tmp_name'], $path.$rand.$f['name']);
      }
      if ($fmini && ($fmini != '')) {
        $imagem = new SimpleImage();
        $imagem->load($_FILES['uploadfilemini']['tmp_name']);
        $largeur = $imagem->getWidth();
        $hauteur = $imagem->getHeight();
        if ( ($largeur > 151) || ($hauteur > 76) ) {
          if ($largeur > $hauteur) {
            $imagem->resizeToWidth(151);
            $hauteur = $imagem->getHeight();
            if ($hauteur > 76) {
              $imagem->resizeToHeight(76);
            }
          } else {
            $imagem->resizeToHeight(76);
            $szerom = $imagem->getWidth();
            if ($hauteur > 76) {
              $imagem->resizeToWidth(151);
            }
          }
          $imagem->save($path_mini.$rand.$fmini['name']);
          $thumbName = $rand.$fmini['name'];
        } else {
          $copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
          $thumbName = $rand.$fmini['name'];
        }
      }
      $fileName = $rand.$f['name'];
    }
    $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$fileName."', '".$thumbName."', '".$p_order."')");
  }

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$thumbName = '';
		$fileName = '';
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
				$copie = copy($f['tmp_name'], $path.$f['name']);
				if (!$copie) {
					$rand = rand(0, 100);
					$copie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$fileName = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$fileName' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 		$imagem = new SimpleImage();
      		$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$largeur = $imagem->getWidth();
					$hauteur = $imagem->getHeight();
					if ( ($largeur > 400) || ($hauteur > 200) ) {
						if ($largeur > $hauteur) {
			    	  $imagem->resizeToWidth(400);
							$hauteur = $imagem->getHeight();
							if ($hauteur > 200) {
					      $imagem->resizeToHeight(200);
							}
						} else {
	    			  $imagem->resizeToHeight(200);
							$szerom = $imagem->getWidth();
							if ($hauteur > 200) {
					      $imagem->resizeToWidth(400);
							}
						}
			      $imagem->save($path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					} else {
						$copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$thumbName' WHERE id='$edytuj_id'");
				}
			}
		}

		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

  if (isset($_POST['editplv'])) {
  	$editid = $_POST['editplv'];
  	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit plv:</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
  	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
  	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
  	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';

  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
  	echo '</div></div></div>';

  } else {
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new plv:</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
  	echo '<p>Name: <input type="text" name="prom_name" /></p>';

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
  	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
  	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';

  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
  	echo '</div></div></div>';
  }

	echo '</div>';
	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);

	foreach ($promotions as $p) :
		$n_price = str_replace(',', '', $p['price']).' &euro;';
		$n_frais = str_replace(',', '', $p['frais']).' &euro;';
		if ($p['ceddre']) {
			$n_ceddre = str_replace(',', '', $p['ceddre']).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p['photo']) {
			$viewmini = '<img src="'.get_bloginfo('url').'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'].'" alt="" />';
		}
		echo '
      <tr><td>'.$p['name'].'</td><td>'.$p['subname'].'<br/><small>'.$p['description'].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p['order'].'</td><td>
      <form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p['id'].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editplv" value="'.$p['id'].'" /><input type="submit" class="delete" value="Edit" /></form>
  		</td></tr>
    ';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}

////////////////////////////////////////////////////////////////////////////////
//                                                                       PLV INT
////////////////////////////////////////////////////////////////////////////////

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
      $copie = copy($f['tmp_name'], $path.$f['name']);
      if (!$copie) {
        $rand = rand(0, 100);
        $copie = copy($f['tmp_name'], $path.$rand.$f['name']);
      }
      if ($fmini && ($fmini != '')) {
        $imagem = new SimpleImage();
        $imagem->load($_FILES['uploadfilemini']['tmp_name']);
        $largeur = $imagem->getWidth();
        $hauteur = $imagem->getHeight();
        if ( ($largeur > 151) || ($hauteur > 76) ) {
          if ($largeur > $hauteur) {
            $imagem->resizeToWidth(151);
            $hauteur = $imagem->getHeight();
            if ($hauteur > 76) {
              $imagem->resizeToHeight(76);
            }
          } else {
            $imagem->resizeToHeight(76);
            $szerom = $imagem->getWidth();
            if ($hauteur > 76) {
              $imagem->resizeToWidth(151);
            }
          }
          $imagem->save($path_mini.$rand.$fmini['name']);
          $thumbName = $rand.$fmini['name'];
        } else {
          $copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
          $thumbName = $rand.$fmini['name'];
        }
      }
      $fileName = $rand.$f['name'];
    }
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$fileName."', '".$thumbName."', '".$p_order."')");
	}

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$thumbName = '';
		$fileName = '';
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
				$copie = copy($f['tmp_name'], $path.$f['name']);
				if (!$copie) {
					$rand = rand(0, 100);
					$copie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$fileName = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$fileName' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 		$imagem = new SimpleImage();
      		$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$largeur = $imagem->getWidth();
					$hauteur = $imagem->getHeight();
					if ( ($largeur > 400) || ($hauteur > 200) ) {
						if ($largeur > $hauteur) {
			    	  $imagem->resizeToWidth(400);
							$hauteur = $imagem->getHeight();
							if ($hauteur > 200) {
					      $imagem->resizeToHeight(200);
							}
						} else {
	    			  $imagem->resizeToHeight(200);
							$szerom = $imagem->getWidth();
							if ($hauteur > 200) {
					      $imagem->resizeToWidth(400);
							}
						}
			      $imagem->save($path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					} else {
						$copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$thumbName' WHERE id='$edytuj_id'");
				}
			}
		}

		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET name='$p_name', description='$p_desc', price='$p_price', ceddre='$p_ceddre', frais='$p_frais', `order` = '$p_order' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

  if (isset($_POST['editplv'])) {
  	$editid = $_POST['editplv'];
  	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE id='$editid'");
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit plv:</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
  	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
  	echo '<p>Price: <input type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
  	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';

  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
  	echo '</div></div></div>';

  } else {
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Add new plv:</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
  	echo '<p>Name: <input type="text" name="prom_name" /></p>';

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="closedorders"></textarea></p>';
  	echo '<p>Price: <input type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
  	echo '<p>Frais de port: <input type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';

  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
  	echo '</div></div></div>';
  }
	echo '</div>';
	echo '<div id="col-left" style="width:70%;margin-top:40px;">';
	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);

	foreach ($promotions as $p) :
		$n_price = str_replace(',', '', $p['price']).' &euro;';
		$n_frais = str_replace(',', '', $p['frais']).' &euro;';
		if ($p['ceddre']) {
			$n_ceddre = str_replace(',', '', $p['ceddre']).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p['photo']) {
			$viewmini = '<img src="'.get_bloginfo('url').'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'].'" alt="" />';
		}
		echo '<tr><td>'.$p['name'].'</td><td>'.$p['subname'].'<br /><small>'.$p['description'].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p['order'].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p['id'].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editplv" value="'.$p['id'].'" /><input type="submit" class="delete" value="Edit" /></form></td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}

////////////////////////////////////////////////////////////////////////////////
//                                                                        PROMOS
////////////////////////////////////////////////////////////////////////////////

function fb_admin_promo() {
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
      $copie = copy($f['tmp_name'], $path.$f['name']);
      if (!$copie) {
        $rand = rand(0, 100);
        $copie = copy($f['tmp_name'], $path.$rand.$f['name']);
      }
      if ($fmini && ($fmini != '')) {
        $imagem = new SimpleImage();
        $imagem->load($_FILES['uploadfilemini']['tmp_name']);
        $largeur = $imagem->getWidth();
        $hauteur = $imagem->getHeight();
        if ( ($largeur > 151) || ($hauteur > 76) ) {
          if ($largeur > $hauteur) {
            $imagem->resizeToWidth(151);
            $hauteur = $imagem->getHeight();
            if ($hauteur > 76) {
              $imagem->resizeToHeight(76);
            }
          } else {
            $imagem->resizeToHeight(76);
            $szerom = $imagem->getWidth();
            if ($hauteur > 76) {
              $imagem->resizeToWidth(151);
            }
          }
          $imagem->save($path_mini.$rand.$fmini['name']);
          $thumbName = $rand.$fmini['name'];
        } else {
          $copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
          $thumbName = $rand.$fmini['name'];
        }
      }
      $fileName = $rand.$f['name'];
    }
    $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_ceddre."', '".$p_frais."', '".$fileName."', '".$thumbName."', '".$p_order."')");
  }

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_ceddre = $_POST['prom_ceddre'];
		$p_order = $_POST['prom_order'];
		$thumbName = '';
		$fileName = '';
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
				$copie = copy($f['tmp_name'], $path.$f['name']);
				if (!$copie) {
					$rand = rand(0, 100);
					$copie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$fileName = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo='$fileName' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 		$imagem = new SimpleImage();
      		$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$largeur = $imagem->getWidth();
					$hauteur = $imagem->getHeight();
					if ( ($largeur > 400) || ($hauteur > 200) ) {
						if ($largeur > $hauteur) {
			    	  		$imagem->resizeToWidth(400);
							$hauteur = $imagem->getHeight();
							if ($hauteur > 200) {
					      		$imagem->resizeToHeight(200);
							}
						} else {
	    			  	$imagem->resizeToHeight(200);
							$szerom = $imagem->getWidth();
							if ($hauteur > 200) {
					      $imagem->resizeToWidth(400);
							}
						}
			      $imagem->save($path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					} else {
						$copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_promo` SET photo_mini='$thumbName' WHERE id='$edytuj_id'");
				}
			}
		}

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

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
  	echo '<p>Price: <input class="alignR" type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
  	echo '<p>Frais de port: <input class="alignR" type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';

  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
  	echo '</div></div></div>';

  } else {
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Nouvelle promo</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
  	echo '<p>Name: <input type="text" name="prom_name" /></p>';

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
  	echo '<p>Price: <input class="alignR" type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
  	echo '<p>Frais de port: <input class="alignR" type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';

  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
  	echo '</div></div></div>';
  }

	echo '</div>';
	echo '<div id="col-left" style="width:70%;margin-top:-7px;">';
  echo '<h1>Promotions</h1>';
	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>CEDDRE</th><th>Order</th><th>Action</th></tr></thead>';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);

	foreach ($promotions as $p) :
		$n_price = str_replace(',', '', $p['price']).' &euro;';
		$n_frais = str_replace(',', '', $p['frais']).' &euro;';
		if ($p['ceddre']) {
			$n_ceddre = str_replace(',', '', $p['ceddre']).' &euro;';
		} else {
			$n_ceddre = '-';
		}
		$viewmini ='';
		if ($p['photo']) {
			$viewmini = '<img src="'.get_bloginfo('url').'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'].'" alt="" />';
		}
		echo '<tr><td>'.$p['name'].'</td><td>'.$p['subname'].'<br /><small>'.$p['description'].'</small></td><td>'.$viewmini.'</td><td>'.$n_price.'</td><td>'.$n_frais.'</td><td>'.$n_ceddre.'</td><td>'.$p['order'].'</td><td><form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p['id'].'" /><input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' /></form><br /><br /><form name="editpromotion" action="" method="post"><input type="hidden" name="editacc" value="'.$p['id'].'" /><input type="submit" class="delete" value="Edit" /></form></td></tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}

////////////////////////////////////////////////////////////////////////////////
//                                                                   ACCESSOIRES
////////////////////////////////////////////////////////////////////////////////

function fb_admin_acc() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_acc = $prefix."fbs_acc2";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/acc/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/acc/mini/';
	$rand = '';

	if (isset($_POST['delpromo'])) {
		$ajdi = $_POST['delpromo'];
		$wpdb->query("DELETE FROM `$fb_tablename_acc` WHERE id='$ajdi'");
	}
  if (isset($_POST['duplacc'])) {
		$dupid = $_POST['duplacc'];
		$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_acc` WHERE id='$dupid'");
    $wpdb->query("INSERT INTO `$fb_tablename_acc` VALUES ('', '$ed->name', '$ed->subname', '$ed->description', '$ed->price', '$ed->cat','$ed->frais', '$ed->photo', '$ed->photo_mini', '$ed->order', '$ed->ref') ");
	}

  if (isset($_POST['addpromotion'])) {
    $p_name = $_POST['prom_name'];
    $p_subname = $_POST['prom_subname'];
    $p_desc = addslashes($_POST['prom_content']);
    $p_price = $_POST['prom_price'];
    $p_frais = $_POST['prom_frais'];
    $p_cat = $_POST['prom_cat'];
    $p_order = $_POST['prom_order'];
    $p_ref = $_POST['prom_ref'];

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
      $copie = copy($f['tmp_name'], $path.$f['name']);
      if (!$copie) {
        $rand = rand(0, 100);
        $copie = copy($f['tmp_name'], $path.$rand.$f['name']);
      }
      if ($fmini && ($fmini != '')) {
        $imagem = new SimpleImage();
        $imagem->load($_FILES['uploadfilemini']['tmp_name']);

        $copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
        $thumbName = $rand.$fmini['name'];
      }
      $fileName = $rand.$f['name'];
    }

    $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_acc` VALUES (not null, '".$p_name."', '".$p_subname."', '".$p_desc."', '".$p_price."', '".$p_cat."', '".$p_frais."', '".$fileName."', '".$thumbName."', '".$p_order."', '".$p_ref."')");
  }

	if (isset($_POST['editpromotion'])) {
		$p_name = $_POST['prom_name'];
		$p_subname = $_POST['prom_subname'];
		$p_desc = addslashes($_POST['prom_content']);
		$p_price = $_POST['prom_price'];
		$p_frais = $_POST['prom_frais'];
		$p_cat = $_POST['prom_cat'];
		$p_order = $_POST['prom_order'];
    $p_ref = $_POST['prom_ref'];
		$thumbName = '';
		$fileName = '';
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
				$copie = copy($f['tmp_name'], $path.$f['name']);
				if (!$copie) {
					$rand = rand(0, 100);
					$copie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$fileName = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_acc` SET photo='$fileName' WHERE id='$edytuj_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 		$imagem = new SimpleImage();
      		$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$largeur = $imagem->getWidth();
					$hauteur = $imagem->getHeight();

					$copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$thumbName = $rand.$fmini['name'];

					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_acc` SET photo_mini='$thumbName' WHERE id='$edytuj_id'");
				}
			}
		}

		$updateowanie = $wpdb->query("UPDATE `$fb_tablename_acc` SET name='$p_name', description='$p_desc', price='$p_price', cat='$p_cat', frais='$p_frais', `order` = '$p_order', `ref` = '$p_ref' WHERE id='$edytuj_id'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:29%;margin-top:30px;">';

  if (isset($_POST['editacc'])) {
  	$editid = $_POST['editacc'];
  	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_acc` WHERE id='$editid'");
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Edit acc:</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editpromotion" value="'.$editid.'" />';
  	echo '<p>Name: <input type="text" name="prom_name" value="'.$ed->name.'" /></p>';

  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon">'.stripslashes($ed->description).'</textarea></p>';
  	echo '<p>Price: <input class="alignR" type="text" size="10" name="prom_price" value="'.$ed->price.'" />&euro;</p>';
  	echo '<p>Frais de port: <input class="alignR" type="text" size="10" name="prom_frais" value="'.$ed->frais.'" />&euro;</p>';
    echo '<p>Référence: <input class="alignR" type="text" size="10" name="prom_ref" value="'.$ed->ref.'" /></p>';
    echo '<p>Catégorie: <select class="alignR" name="prom_cat">
      <option value="Tous">Tous les produits</option>
      <option value="Banderole">Banderole</option>
      <option value="Roll">Roll-up</option>
      <option value="Totem">Totem</option>
      <option value="Stand">Stand</option>
      <option value="Oriflamme">Oriflamme</option>
      <option value="Forex">Forex</option>
      <option value="Dibond">Dibond</option>
      <option value="Akilux">Akilux</option>
      <option value="PVC">PVC</option>
      <option value="Tente">Tente</option>
      <option value="PLVint">PLV-int</option>
      <option value="PLVext">PLV-ext</option>
      <option value="Affiche">Affiche</option>
      <option value="Depliant">Depliant</option>
      <option value="Flyer">Flyer</option>
      <option value="Cartes">Cartes</option>
      <option value="Sticker">Stickers</option>
      <option value="Nappe">Nappe</option>
      <option value="Cadre">Cadre Tissu</option>
      <option value="Enseigne">Enseigne Suspendue</option>
    </select></p>';
  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /> '.$ed->photo_mini.'&nbsp;<span style="color:red">choosing new = delete old file!</span></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="'.$ed->order.'" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /> or <a href="">CLOSE</a></form>';
  	echo '</div></div></div>';

  } else {
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Nouvel accessoire</span></h3><div class="inside">';
  	echo '<form name="newprom" id="newprom" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addpromotion" />';
  	echo '<p>Name: <input type="text" name="prom_name" /></p>';
  	echo '<p>Description: <small>(Separate lines with &lt;br /&gt;)</small><br /><textarea name="prom_content" id="incon"></textarea></p>';
  	echo '<p>Price: <input class="alignR" type="text" size="10" name="prom_price" value="0.00" />&euro;</p>';
  	echo '<p>Frais de port: <input class="alignR" type="text" size="10" name="prom_frais" value="0.00" />&euro;</p>';
    echo '<p>Référence: <input class="alignR" type="text" size="10" name="prom_ref" value="" /></p>';
    echo '<p>Catégorie: <select class="alignR" name="prom_cat">
      <option value="Tous">Tous les produits</option>
      <option value="Banderole">Banderole</option>
      <option value="Roll">Roll-up</option>
      <option value="Totem">Totem</option>
      <option value="Stand">Stand</option>
      <option value="Oriflamme">Oriflamme</option>
      <option value="Forex">Forex</option>
      <option value="Dibond">Dibond</option>
      <option value="Akilux">Akilux</option>
      <option value="PVC">PVC</option>
      <option value="Tente">Tente</option>
      <option value="PLVint">PLV-int</option>
      <option value="PLVext">PLV-ext</option>
      <option value="Affiche">Affiche</option>
      <option value="Depliant">Depliant</option>
      <option value="Flyer">Flyer</option>
      <option value="Cartes">Cartes</option>
      <option value="Sticker">Stickers</option>
      <option value="Nappe">Nappe</option>
      <option value="Cadre">Cadre Tissu</option>
      <option value="Enseigne">Enseigne Suspendue</option>
    </select></p>';
  	echo '<p>PDF: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
  	echo '<p>Thumbnail: <small>(max 151x76px)</small><br /><input type="file" name="uploadfilemini" /></p>';
  	echo '<p>Order: <input type="text" size="5" name="prom_order" value="1" /></p>';
  	echo '<input type="submit" value="SAVE" class="savebutt3" /></form>';
  	echo '</div></div></div>';
  }

	echo '</div>';

  echo '<div id="col-left" style="width:70%;margin-top:-7px;">';
  echo '<h1>Accessoires</h1>';
	echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th>Name</th><th style="width:150px;">Description</th><th>Image</th><th>Price</th><th>Frais de Port</th><th>Catégorie</th><th>Référence</th><th>Order</th><th>Action</th></tr></thead>';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_acc` ORDER BY `order` ASC", ARRAY_A);
	foreach ($promotions as $p) :
		$n_price = str_replace(',', '', $p['price']).' &euro;';
		$n_frais = str_replace(',', '', $p['frais']).' &euro;';

		$viewmini ='';
		if ($p['photo']) {
			$viewmini = '<img src="'.get_bloginfo('url').'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'].'" alt="" />';
		}
		echo '<tr>
      <td>'.$p['name'].'</td>
      <td>'.$p['subname'].'<br /><small>'.$p['description'].'</small></td>
      <td>'.$viewmini.'</td>
      <td>'.$n_price.'</td>
      <td>'.$n_frais.'</td>
      <td>'.$p['cat'].'</td>
      <td>'.$p['ref'].'</td>
      <td>'.$p['order'].'</td>
      <td>
        <form name="delpromotion" action="" method="post"><input type="hidden" name="delpromo" value="'.$p['id'].'" />
        <input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' />
        </form><br />
        <form name="dupl" action="" method="post"><input type="hidden" name="duplacc" value="'.$p['id'].'" /><input type="submit" class="delete" value="Dupliquer" />
        </form><br />
        <form name="editpromotion" action="" method="post"><input type="hidden" name="editacc" value="'.$p['id'].'" /><input type="submit" class="delete" value="Edit" />
        </form>
      </td>
    </tr>';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}

////////////////////////////////////////////////////////////////////////////////
//                                                               SHORT FUNCTIONS
////////////////////////////////////////////////////////////////////////////////

function fb_admin_ncomments() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";

  $start_from = 0;
  $limit = 500;

  $aut = $_POST['auteur'];
  $dat = $_POST['date'];

	echo '<div id="col-left" style="width:70%;">';
	echo '<h1>Derniers commentaires</h1>';

  echo '<form method="post" action="">
  <select name="auteur">
    <option value="">Tous</option>
    <option value="clients">commentaires clients seulement</option>
    <option value="France Banderole Tous">commentaires FB seulement</option>
    <option value="France Banderole 1">France Banderole 1</option>
    <option value="France Banderole 2">France Banderole 2</option>
    <option value="France Banderole 3">France Banderole 3</option>
    <option value="France Banderole 4">France Banderole 4</option>
    <option value="France Banderole 5">France Banderole 5</option>
    <option value="France Banderole FB EXPEDITION">France Banderole FB EXPEDITION</option>

  </select>
  <strong>ET/OU</strong> Date: <input type="text" name="date" id="datepicker">
  <button type="submit">Filtrer</button>
  </form>';

  //---------------------------------------------------------------------FILTRES
  if ($aut == '' && $dat == '') {         //----------------------- aucun filtre
                                         $req = '';

  } else if ($aut !== '' && $dat == '') { //------------ filtre auteur seulement

    if ($aut == 'France Banderole Tous') $req = 'WHERE author like "France Banderole%"';     // fb seulement
    else if ($aut == 'clients')          $req = 'WHERE author not like "France Banderole%"'; // clients seulement
    else                                 $req = 'WHERE author = "'.$aut.'"';                 // par auteur

    echo 'résultats pour <strong>AUTEUR =</strong> ' .$aut;

  } else if ($aut == '' && $dat !== '') { //-------------- filtre date seulement
                                         $req = 'WHERE  DATE_FORMAT(date, "%d/%m/%Y") like "'.$dat.'"';

    echo 'résultats pour <strong>DATE =</strong> ' .$dat;

  } else if ($aut !== '' && $dat !== '') { //-------------- filtre auteur + date
    if ($aut == 'France Banderole Tous') $req = 'WHERE author like "France Banderole%" AND DATE_FORMAT(date, "%d/%m/%Y") like "'.$dat.'"';
    else if ($aut == 'clients')          $req = 'WHERE author not like "France Banderole%" AND DATE_FORMAT(date, "%d/%m/%Y") like "'.$dat.'"';
    else                                 $req = 'WHERE author = "'.$aut.'" AND DATE_FORMAT(date, "%d/%m/%Y") like "'.$dat.'"';

    echo 'résultats pour <strong>AUTEUR =</strong> ' .$aut . ' <strong>ET DATE =</strong> ' .$dat;
  }

  $comments = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` $req ORDER BY date DESC LIMIT $start_from, $limit", ARRAY_A);

  echo '<table class="widefat widecenter fixed" id="mywidefat" cellspacing="0"><thead><tr><th width="20px">N</th><th>Topic</th><th>Content</th><th>Date</th><th>Author</th><th>Order number</th></tr></thead>';
  $i = 0;
	foreach ($comments as $c) :
    $i++;
		$licz = strlen($c['content']);
		if ($licz > 40) {
			$tnij = substr($c['content'],0,40);
	    $txt = $tnij."...";
		} else {
			$txt = $c['content'];
		}
		echo '<tr><td>'.$i.'</td><td>'.$c['topic'].'</td><td>'.$txt.'</td><td>'.$c['data'].'</td><td>'.$c['author'].'</td><td><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbdet='.$c['order_id'].'">'.$c['order_id'].'</a></td></tr>';
	endforeach;

	echo '</table>';
	echo '</div>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    } );
  </script>';
}

////////////////////////////////////////////////////////////////////////////////

function convertToNumber($string) {
	$num = ereg_replace("[^0-9]", "", $string );
	return $num;
}

////////////////////////////////////////////////////////////////////////////////

function convertToClean($string) {
	$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
	$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
	$string = str_replace($search, $replace, $string);
	$num = ereg_replace("[^a-zA-Z0-9\-\ ]", "", $string );
	return $num;
}

////////////////////////////////////////////////////////////////////////////////

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
	return $txt;
}

////////////////////////////////////////////////////////////////////////////////

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
  return $txt;
}

////////////////////////////////////////////////////////////////////////////////

function convertSAAddress($string, $count) {
	$licz = iconv_strlen($string, "UTF-8");
	if ($licz > $count) {
		$run = true;
    while($run) {
      $wskaznik = (isset($spacja)) ? $spacja : 0; // nous fixons le taux, la première fois 0, alors il est le dernier espace où nous avons terminé la coupe
      $s_string = substr($string,$wskaznik,$count); // première coupe
      $spacja = strrpos($s_string,' '); // le dernier espace de recherche à la suite de la première coupe
      if(strlen($string) > $wskaznik+$count) $s_string = substr($s_string,0,$spacja); // vérifie si la pièce que nous ne font pas saillie derrière notre chaîne, sinon le résultat de la première coupe pour couper les espaces
      else $run = false; // le cas échéant, ne coupez pas déjà le dernier espace et fait boucle complète
      $txt[] = trim($s_string);
      $spacja += $wskaznik; // l'espace d'entrée pour la chaîne entière
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
	return $txt;
}

////////////////////////////////////////////////////////////////////////////////
//                                                                           TNT
////////////////////////////////////////////////////////////////////////////////

function getTnt($id, $user) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users   = $prefix."fbs_users";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_cf      = $prefix."fbs_cf";
	$exadd  = false;
	$suser  = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$user'");
	$exuser = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$id'");
	if ($exuser) {
		$exadd = true;
	}

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

  $query_assurance = "SELECT value FROM `$fb_tablename_cf` WHERE type='assurance' AND unique_id = '$id'";
  $query_poids = "SELECT value FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$id'";
  $poids = $wpdb->get_var($query_poids);
  $assu = $wpdb->get_var($query_assurance);
  $assurance = number_format($assu, 2, '.', '');

  /* Nombre de colis */
  $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$id'");
  if ($sprawdzshipping) {
    $nbcolis = $sprawdzshipping->value;
  }else {
    $nbcolis = "1";
  }

	$v340 = "";
	$v1  = convertSA('08904205', 9);
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

  // valeur assurée Format '99999999.99' ---------------------------------------
  if     ($assurance < 10)     $zeros = '0000000'; // si nb à 1 chiffre
  elseif ($assurance < 100)    $zeros = '000000';  // si nb à 2 chiffres
  elseif ($assurance < 1000)   $zeros = '00000';   //...      3
  elseif ($assurance < 10000)  $zeros = '0000';    //...      4
  elseif ($assurance < 100000) $zeros = '000';     //...      5
  $as = $zeros.$assurance;
  $v56 = convertSA($as, 11);

  //----------------------------------------------------------------------------
  $v57 = convertSA('EUR', 3); // devise
  $v67 = convertSA('', 14);
  $v84 = convertSA($nbcolis, 2);

  // poids: Format '9999.999' en Kg---------------------------------------------
  if ($poids < 10) $pt = '0'.$poids;
  else             $pt = $poids;
  $v86 = convertSA('00'.$pt.'.000', 8);
  //----------------------------------------------------------------------------

	$v94 = convertSA('', 7);
	$v101 = convertSA(date('Ymd'), 8);
	$v109 = convertSA('', 30);

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
  }

	$v199 = convertSA('', 25);
  $v224 = convertSA(trim($suser->email), 40); // mail user
  $v264 = convertSA('', 20); // TVA

	$v284 = convertSA('C', 1);
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

  $sum = $v1.$v10.$v28.$v37.$v40.$v56.$v57.$v67.$v70.$v84.$v86.$v94.$v101.$v109.$v139.$v169.$v199.$v224.$v264.$v284.$v285.$v340.$v350.$v380.$v410.$v440.$v470.$v479.$v509.$v539.$v542;
	$sum = str_ireplace('cedex', '     ', $sum);

  $myFile = 'tnt/'.$id.".txt";
  $fh = fopen($myFile, 'w') or die("1can't open file");
  fwrite($fh, $sum);
  fclose($fh);

  $BLXLSFile = il_y_a_fichier_BLXLS($id);
  if ($BLXLSFile != false) {
     $hasBLXLS = $BLXLSFile;
  } else {
  	$hasBLXLS = false;
  }
  if($hasBLXLS != false) {
  echo '<div id="downFiles">
  <a href="download.php?filename='.$id.'" id="downZIPTXT">Download ZIP TXT</a><br />';
  } else {
  echo '<div id="downFiles">
  <a href="download.php?filename='.$id.'" id="downTXT">Download txt</a><br />';
  }
}

////////////////////////////////////////////////////////////////////////////////
//                                                                       TNT ZIP
////////////////////////////////////////////////////////////////////////////////

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
        $query_assurance = "SELECT value FROM `$fb_tablename_cf` WHERE type='assurance' AND unique_id = '$id'";
        $query_poids = "SELECT value FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$id'";
        $poids = $wpdb->get_var($query_poids);
        $assu = $wpdb->get_var($query_assurance);
        $assurance = number_format($assu, 2, '.', '');

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

        // valeur assurée Format '99999999.99' ---------------------------------

        if     ($assurance < 10)     $zeros = '0000000'; // si nb à 1 chiffre
        elseif ($assurance < 100)    $zeros = '000000';  // si nb à 2 chiffres
        elseif ($assurance < 1000)   $zeros = '00000';   //...      3
        elseif ($assurance < 10000)  $zeros = '0000';    //...      4
        elseif ($assurance < 100000) $zeros = '000';     //...      5
        $as = $zeros.$assurance;
        $v56 = convertSA($as, 11);

        //----------------------------------------------------------------------
        $v57 = convertSA('EUR', 3); // devise
      	$v67 = convertSA('', 14);
      	$v84 = convertSA($nbcolis, 2);

        // poids: Format '9999.999' en Kg---------------------------------------

        if ($poids < 10) $pt = '0'.$poids;
        else             $pt = $poids;
      	$v86 = convertSA('00'.$pt.'.000', 8);
        //----------------------------------------------------------------------

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

        $v199 = convertSA('', 25);
        $v224 = convertSA(trim($suser->email), 40); // mail user
        $v264 = convertSA('', 20); // TVA

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

      	$sum = $v1.$v10.$v28.$v37.$v40.$v56.$v57.$v67.$v70.$v84.$v86.$v94.$v101.$v109.$v139.$v169.$v199.$v224.$v264.$v284.$v285.$v340.$v350.$v380.$v410.$v440.$v470.$v479.$v509.$v539.$v542;
      	$sum = str_ireplace('cedex', '     ', $sum);

        $myFile = "tnt/".substr($id,2).str_pad($incr_id, 2, '0', STR_PAD_LEFT).".txt";
        $fh = fopen($myFile, 'w') or die("1can't open file");
        fwrite($fh, $sum);
        fclose($fh);
        $zip_txt->addFile($myFile);

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
  <a href="download.php?filename='.$id.'&zip=1" id="downZIPTXT">Download ZIP TXT</a>';
  } else {
  echo '<div id="downFiles">
  <a href="download.php?filename='.$id.'" id="downTXT">Download txt</a><br />';
  }
}

////////////////////////////////////////////////////////////////////////////////
//                                                                         FEDEX
////////////////////////////////////////////////////////////////////////////////

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
  $fh = fopen($myFile, 'w') or die("1can't open file");
  fwrite($fh, $sum);
  fclose($fh);
  echo '<div id="downFiles">
  <a href="download.php?filename=tedip_' . $id . '.csv" id="downTXT">Download txt</a><br />';
}

////////////////////////////////////////////////////////////////////////////////
//                                                                           DPD
////////////////////////////////////////////////////////////////////////////////

function getDPD($id, $user) {
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

	$query_poids = "SELECT value FROM `$fb_tablename_cf` WHERE type='poids' AND unique_id = '$id'";
	$poids = $wpdb->get_var($query_poids);

  $query_assurance = "SELECT value FROM `$fb_tablename_cf` WHERE type='assurance' AND unique_id = '$id'";
	$assurance = $wpdb->get_var($query_assurance);

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

  //------------------------------------------------------------ Nombre de colis
  $sprawdzshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='nbcolis' AND unique_id = '$id'");
  if ($sprawdzshipping) {
    $nbcolis = round($sprawdzshipping->value);
	/* On appelle récursivement cette fonction pour imprimer le nombre d'étiquettes nécessaires au nombre de colis */
	/* FIn appel récursif A FAIRE */
  } else {
    $nbcolis = "1";
  }

	//================================================== Construction Fichier plat
  //-------------------------------------------------------------------- fillers
  $fill01 = convertSA('', 1);
  $fill02 = convertSA('', 2);
  $fill08 = convertSA('', 8);
  $fill10 = convertSA('', 10);
  $fill15 = convertSA('', 15);
  $fill18 = convertSA('', 18);
  $fill20 = convertSA('', 20);
  $fill25 = convertSA('', 25);
  $fill29 = convertSA('', 29);
  $fill35 = convertSA('', 35);
  $fill96 = convertSA('', 96);
  $fill113 = convertSA('', 113);
  $fill200 = convertSA('', 200);
	//---------------------------------------------- réf client 1 (no de commande)
	$cid = convertSA($id, 35);
  // no client dpd fb : '01317019'
	//------------------------------------------------------- Poids du colis en dg
	$poids = convertN(convertToNumber(round(($poids*100),0,PHP_ROUND_HALF_UP)), 8);

	//----------------------------------------------------------- Nom destinataire
  if ($exadd == true) {
    $name = convertSA(convertToClean($exuser->l_name), 35);
  } else {
    if (!empty($suser->l_name)) {
      $name = convertSA(convertToClean($suser->l_name), 35);
    } elseif (!empty($suser->f_name)) {
      $name = convertSA(convertToClean($suser->f_name), 35);
    } else {
      $name = convertSA(convertToClean('Name'), 35);
    }
  }

  //------------------------------------------------------------------ Adresse 1
  if ($exadd == true) {
    $ad1 = convertSA(convertToClean($exuser->l_comp), 35);
  } else {
    if (!empty($suser->l_phone)) {
      $ad1 = convertSA(convertToClean($suser->l_comp), 35);
    } else {
      $ad1 = convertSA(convertToClean($suser->f_comp), 35);
    }
  }

  //------------------------------------------------------------- Adresse 2 et 3
  if ($exadd == true) {
    $explode = explode('|', $exuser->l_address);
    //print_r($explode);
    $v380line = convertSAAddress(convertToClean($explode[0]), 35);
    $ad2 = convertSA($v380line[0], 35);
    $ad3 = convertSA($v380line[1] . convertToClean($explode[1]), 35);
  } else {
    if (!empty($suser->l_phone)) {
      $explode = explode('|', $suser->l_address);
      //print_r($explode);
      $v380line = convertSAAddress(convertToClean($explode[0]), 35);
      $ad2 = convertSA($v380line[0], 35);
      $ad3 = convertSA($v380line[1] . convertToClean($explode[1]), 35);
    } else {
      $explode = explode('|', $suser->f_address);
      //print_r($explode);
      $v380line = convertSAAddress(convertToClean($explode[0]), 35);
      $ad2 = convertSA($v380line[0], 35);
      $ad3 = convertSA($v380line[1] . convertToClean($explode[1]), 35);
    }
  }

	//------------------------------------------------------------- Adresse 4 et 5
  $ad4 = convertSA('', 35);
  $ad5 = convertSA('', 35);

  //----------------------------------------------------------------- Codepostal
  if ($exadd == true) {
    $cp = convertSA(convertToNumber($exuser->l_code), 10);
  } else {
    if (!empty($suser->l_phone)) {
      $cp = convertSA(convertToNumber($suser->l_code), 10);
    } else {
      $cp = convertSA(convertToNumber($suser->f_code), 10);
    }
  }

  //---------------------------------------------------------------------- Ville
  if ($exadd == true) {
    $ville = convertSA(convertToClean($exuser->l_city), 35);
  } else {
    if (!empty($suser->l_phone)) {
      $ville = convertSA(convertToClean($suser->l_city), 35);
    } else {
      $ville = convertSA(convertToClean($suser->f_city), 35);
    }
  }

  //------------------------------------------------------------------ Code Pays
	$pays = convertSA('FR', 3);

  //------------------------------------------------------------------ Téléphone
  if ($exadd == true) {
    $tel = convertSA(convertToNumber($exuser->l_phone), 20); // phone
  } else {
    if (!empty($suser->l_phone)) {
      $tel = convertSA(convertToNumber($suser->l_phone), 20); // phone
    } else {
      $tel = convertSA(convertToNumber($suser->f_phone), 20); // phone
    }
  }

  //----------------------Infos expéditeur en fonction de colis revendeur ou non
  if ($colis_revendeur == false) {
    $expname = convertSA('France Banderole', 35);
    $expad = convertSA('ZI les Estroublans', 35);
    $expcp = convertSA('13127', 10);
    $expville = convertSA('Vitrolles', 35);
    $exprue = convertSA('24-26 avenue de Bruxelles', 35);
    $exptel = convertSA('0442401401', 20);
    $exptel2 = convertSA('0442401401', 30);
    $mailexp = convertSA('information@france-banderole.com', 80);
    $gsmexp = convertSA('', 35);
    //--------------------------------------- N° de compte chargeur colis normal
    $compte = convertN('00017019', 8);
  } else {
    $expname = convertSA('Votre expediteur', 35);
    $expad = convertSA('10 rue de Ponthieu', 35);
    $expcp = convertSA('75008', 10);
    $expville = convertSA('Paris', 35);
    $exprue = convertSA('10 rue de Ponthieu', 35);
    $exptel = convertSA('', 20);
    $exptel2 = convertSA('', 30);
    $mailexp = convertSA('', 80);
    $gsmexp = convertSA('', 35);
    //-------------------------------- N° de compte chargeur DPD colis revendeur
    $compte = convertN('00017033', 8);
  }

  //--------------------------------------------------------------- Commentaires
  $com = convertSA('', 35);
  //------------------------------------------------------------ Date expédition
	$date = convertSA(date('d/m/Y'), 10);

  //----------------------------------------------------------------- code barre
  $code = convertSA('', 35);
  //-------------------------------------------------------- refs client 2,3 & 4
  $ref = convertSA('', 35);
  //------------------------------------------------------------------ assurance
  $valeur = convertN($assurance, 9);

  //---------------------------------------------------------------------contact
  $maildst = convertSA($suser->email, 80);
  $gsmdst = convertSA($tel, 35);

  //------------------------------------------------------------ id point relais
  $ptr = convertSA('', 8);
  //---------------------------------------------------- consolidation type/attr
  $cons = convertSA('', 2);
  //--------------------- option sms au destinataire (inscrire "+" pour activer)
  $sms = convertSA('', 1);
  //-------------------------------------------------------- digicode / intercom
  $digi = convertSA('', 10);
  //------------------------------------------ retour relais (service à activer)
  $ret = convertN('2', 1); // 2 pour inversé, 3 pour sur demande, 4 pour préparé (?)
  //------------------------------------------------------- fin d'enregistrement
  $fin = convertSA("\r\n", 2);

	$sum = $cid . $fill02 . $poids . $fill15 . $name . $ad1 . $ad2 . $ad3 . $ad4 . $ad5 . $cp . $ville . $fill10 . $ad2 . $fill10 . $pays . $tel . $fill25 . $expname . $expad . $fill35 . $fill35 . $fill35 . $fill35 . $expcp . $expville . $fill10 . $exprue . $fill10  . $pays . $exptel . $fill10 . $com . $com . $com . $com . $date . $compte . $code . $ref . $fill29 . $valeur . $fill08 . $ref . $fill01 . $cid . $fill10 . $mailexp . $gsmexp . $maildst . $gsmdst . $fill96 . $ptr . $fill113 . $cons . $cons . $fill01 . $sms . $name . $digi . $digi . $digi . $fill200 . $ret . $fill15 . $expname . $expad . $fill35 . $fill35 . $fill35 . $fill35 . $expcp . $expville . $fill10 . $exprue . $fill10 . $pays . $exptel2. $fill18 . $ref . $fin;

  //--------------------------------------------------------------- nombre colis
  if($nbcolis == 0 || $nbcolis == false) $nbcolis = 1;
  else $sum = str_repeat($sum, $nbcolis);

	//============================================== FIN Construction fichier plat

  $sum = str_ireplace('cedex', '     ', $sum);
  //	echo $sum;

  $myFile = 'tnt/tedip_' . $id . ".txt";
  //echo 'myFile='.$myFile;
  $fh = fopen($myFile, 'w') or die("1can't open file");
  fwrite($fh, $sum);
  fclose($fh);

  echo '<div id="downFiles">
  <a href="download.php?filename=tedip_' . $id . '.txt" id="downTXT">Download txt</a><br />';
}

//////////////////////////////////////////////////// check si colis revendeur //

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

///////////////////////////////////////////////////////// check si BL présent //

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
 * Verifier si un fichier BL.XLS exits et renvoit le chemin, sinon FALSE
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

///////////////////////////////////////////////// générer code barre commande //

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

  imagestring($im, 5, $x-100, $y+46, formatStringForCodeBarre($idorder), 0);

  for ($i = 1; $i < 5; $i++) {
      //drawCross($im, $blue, $data['p' . $i]['x'], $data['p' . $i]['y']);
  }
  $imgPath = __DIR__ . "/barcodes_GkA32Bn09fKNxSL/". $idorder . "_" . uniqid() . ".png";
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

////////////////////////////////////////////////////////////////////////////////
//                                                                         STOCK
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////// page produits
function fb_admin_stock() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_famille = $prefix."fbs_stock_fam";
  $fb_tablename_place = $prefix."fbs_stock_place";
  $fb_tablename_auto = $prefix."fbs_stock_auto";
  $fb_tablename_fournisseurs = $prefix."fbs_stock_fournisseurs";
	include(FBSHOP_URL . '/fb_simpleimage.php');
	$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/stock/';
	$path_mini = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/stock/mini';
	$rand = '';


  //-------------------------------------------------------------effacer produit
  if (isset($_POST['delstock'])) {
		$prodid = $_POST['delstock'];
		$wpdb->query("DELETE FROM `$fb_tablename_stock` WHERE id='$prodid'");
	}
  //---------------------------------------------------------------------ajouter
	if (isset($_POST['addstock'])) {
		$s_famille = $_POST['s_famille'];
		$s_code = $_POST['s_code'];
		$s_ref = $_POST['s_ref'];
		$s_designation = $_POST['s_designation'];
		$s_fournisseur = $_POST['s_fournisseur'];
		$s_quantite = $_POST['s_quantite'];
    $s_mini = $_POST['s_mini'];
		$s_place = $_POST['s_place'];
    $s_volume = $_POST['s_volume'];
		$s_poids = $_POST['s_poids'];
		$s_PUA = $_POST['s_PUA'];
    $s_PTA = $s_PUA*$s_quantite;
    $s_PUV = $_POST['s_PUV'];
    $s_PTV = $s_PUV*$s_quantite;

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
			$copie = copy($f['tmp_name'], $path.$f['name']);
			if (!$copie) {
				$rand = rand(0, 100);
				$copie = copy($f['tmp_name'], $path.$rand.$f['name']);
			}
			if ($fmini && ($fmini != '')) {
     			$imagem = new SimpleImage();
      			$imagem->load($_FILES['uploadfilemini']['tmp_name']);
				$largeur = $imagem->getWidth();
				$hauteur = $imagem->getHeight();
				if ( ($largeur > 76) || ($hauteur > 76) ) {
					if ($largeur > $hauteur) {
		    	  		$imagem->resizeToWidth(76);
						$hauteur = $imagem->getHeight();
						if ($hauteur > 76) {
				      		$imagem->resizeToHeight(76);
						}
					} else {
	    		  		$imagem->resizeToHeight(76);
						$szerom = $imagem->getWidth();
						if ($hauteur > 76) {
				      		$imagem->resizeToWidth(76);
						}
					}
		      		$imagem->save($path_mini.$rand.$fmini['name']);
					$thumbName = $rand.$fmini['name'];
				} else {
					$copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
					$thumbName = $rand.$fmini['name'];
				}
			}
			$fileName = $rand.$f['name'];
		}

    $checked = $_POST['gestionAuto'];
    if ($checked == '1') { // au check radio gestion auto on ajoute la désignation produit la bdd auto
      $add_auto = $wpdb->query("INSERT INTO `$fb_tablename_auto` VALUES ('', '$s_designation', '$s_code', '' ) ");
    }
		$wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_stock` VALUES ('', '$thumbName', '$s_famille', '$s_code', '$s_ref', '$s_designation', '$s_fournisseur', '$s_quantite', '$s_mini', '$s_place','$s_volume', '$s_poids', '$s_PUA', '$s_PTA', '$s_PUV', '$s_PTV' ) ");
	}

  //----------------------------------------------------------------------éditer
	if (isset($_POST['editstock'])) {
    $s_famille = $_POST['s_famille'];
    $s_code = $_POST['s_code'];
    $s_ref = $_POST['s_ref'];
    $s_designation = $_POST['s_designation'];
    $s_fournisseur = $_POST['s_fournisseur'];
    $s_quantite = $_POST['s_quantite'];
    $s_mini = $_POST['s_mini'];
    $s_place = $_POST['s_place'];
    $s_volume = $_POST['s_volume'];
		$s_poids = $_POST['s_poids'];
    $s_PUA = $_POST['s_PUA'];
    $s_PTA = $s_PUA*$s_quantite;
    $s_PUV = $_POST['s_PUV'];
    $s_PTV = $s_PUV*$s_quantite;

    $thumbName = '';
		$fileName = '';
		$edit_id = $_POST['editstock'];
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
				$copie = copy($f['tmp_name'], $path.$f['name']);
				if (!$copie) {
					$rand = rand(0, 100);
					$copie = copy($f['tmp_name'], $path.$rand.$f['name']);
				}
				$fileName = $rand.$f['name'];
				$updateowanie = $wpdb->query("UPDATE `$fb_tablename_stock` SET photo='$fileName' WHERE id='$edit_id'");
			}
			if ( !empty($fmini['name']) || $fmini['name'] != '') {
				if ($fmini && ($fmini != '')) {
    	 		$imagem = new SimpleImage();
      		$imagem->load($_FILES['uploadfilemini']['tmp_name']);
					$largeur = $imagem->getWidth();
					$hauteur = $imagem->getHeight();
					if ( ($largeur > 76) || ($hauteur > 76) ) {
						if ($largeur > $hauteur) {
			    	  $imagem->resizeToWidth(76);
							$hauteur = $imagem->getHeight();
							if ($hauteur > 76) {
					      $imagem->resizeToHeight(76);
							}
						} else {
	    			  $imagem->resizeToHeight(76);
							$szerom = $imagem->getWidth();
							if ($hauteur > 76) {
					      $imagem->resizeToWidth(76);
							}
						}
			      $imagem->save($path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					} else {
						$copie = copy($fmini['tmp_name'], $path_mini.$rand.$fmini['name']);
						$thumbName = $rand.$fmini['name'];
					}
					$updateowanie = $wpdb->query("UPDATE `$fb_tablename_stock` SET photo='$thumbName' WHERE id='$edit_id'");
				}
			}
		}
    $checked = $_POST['gestionAuto'];
    $checkedornot = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_auto` WHERE designation='$s_designation'");
    if ($checked == '1') { // au check radio auto on ajoute la désignation à la bdd auto si elle n'y est pas déjà
      if ($checkedornot!=1){
        $add_auto = $wpdb->query("INSERT INTO `$fb_tablename_auto` VALUES ('', '$s_designation', '$s_code', '' ) ");
      }
    }else{
      if ($checkedornot==1){ // au check non on efface la désignation produit de la bdd auto
        $wpdb->query("DELETE FROM `$fb_tablename_auto` WHERE designation='$s_designation'");
      }
    }
    if(isset($_POST['modifier'])){
      $updateowanie = $wpdb->query("UPDATE `$fb_tablename_stock` SET famille='$s_famille', code='$s_code', ref='$s_ref', designation='$s_designation', fournisseur='$s_fournisseur', quantite= '$s_quantite', mini= '$s_mini', place= '$s_place', volume= '$s_volume', poids= '$s_poids', PUA= '$s_PUA', PTA= '$s_PTA', PUV= '$s_PUV', PTV= '$s_PTV' WHERE id='$edit_id'");
    }else if(isset($_POST['dupliquer'])){
      $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_stock` VALUES ('', '$thumbName', '$s_famille', '$s_code', '$s_ref', '$s_designation', '$s_fournisseur', '$s_quantite', '$s_mini', '$s_place','$s_volume', '$s_poids', '$s_PUA', '$s_PTA', '$s_PUV', '$s_PTV' ) ");
    }

	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:22%;margin-top:38px;">';

  //-----------------------------------------------------------formulaire éditer
  if (isset($_POST['editprod'])) {
  	$editid = $_POST['editprod'];
  	$ed = $wpdb->get_row("SELECT * FROM `$fb_tablename_stock` WHERE id='$editid'");
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Modifier</span></h3><div class="inside">';
  	echo '<form name="newprod" id="newprod" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editstock" value="'.$editid.'" />';

    echo '<p>Famille: <select class="alignR" name="s_famille"><option value="'.$ed->famille.'">'.$ed->famille.'</option>';
    $list_fam = $wpdb->get_results("SELECT * FROM `$fb_tablename_famille` ORDER BY famille ASC");
		foreach ($list_fam as $fam) {
			echo '<option value="'.$fam->famille.'">'.$fam->famille.'</option>';
		}
    echo '</select></p>';
    echo '<p>Code barre: <input class="alignR" type="text" name="s_code" value="'.$ed->code.'" /></p>';
    echo '<p>Référence: <input class="alignR" type="text" name="s_ref" value="'.$ed->ref.'" /></p>';
    echo '<p>Désignation: <input class="alignR" type="text" name="s_designation" value="'.$ed->designation.'" /></p>';
    echo '<p>Fournisseur: <select class="alignR" name="s_fournisseur"><option value="'.$ed->fournisseur.'">'.$ed->fournisseur.'</option>';
    $list_fr = $wpdb->get_results("SELECT * FROM `$fb_tablename_fournisseurs` ORDER BY nom ASC");
    foreach ($list_fr as $fr) {
      echo '<option value="'.$fr->nom.'">'.$fr->nom.'</option>';
    }
    echo '</select></p>';
    echo '<p>Quantité: <input class="alignR" type="text" size="10" name="s_quantite" value="'.$ed->quantite.'" /></p>';
    echo '<p>Mini: <input class="alignR" type="text" size="10" name="s_mini" value="'.$ed->mini.'" /></p>';
    echo '<p>Emplacement: <select class="alignR" name="s_place"><option value="'.$ed->place.'">'.$ed->place.'</option>';
    $list_place = $wpdb->get_results("SELECT * FROM `$fb_tablename_place` ORDER BY place ASC");
    foreach ($list_place as $pl) {
      echo '<option value="'.$pl->place.'">'.$pl->place.'</option>';
    }
    echo '</select></p>';
    echo '<p>Volume: <input class="alignR" type="text" name="s_volume" value="'.$ed->volume.'" /></p>';
  	echo '<p>Poids <input class="alignR" type="text" size="10" name="s_poids" value="'.$ed->poids.'" /></p>';
  	echo '<p>PUA: <input class="alignR" type="text" size="10" name="s_PUA" value="'.$ed->PUA.'" /></p>';
    echo '<p>PUV: <input class="alignR" type="text" size="10" name="s_PUV" value="'.$ed->PUV.'" /></p>';
    $checkedornot = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_auto` WHERE designation='$ed->designation'");
    if ($checkedornot==1){
      echo '<p>Gestion automatique: <input class="radioBtn" type="radio" name="gestionAuto" value="1" checked />Oui <input class="radioBtn" type="radio" name="gestionAuto" value="0" />Non</p>';
    }else{
      echo '<p>Gestion automatique: <input class="radioBtn" type="radio" name="gestionAuto" value="1" />Oui <input class="radioBtn" type="radio" name="gestionAuto" value="0" checked />Non</p>';
    }

  	echo '<p style="display:none;">Photo: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /> '.$ed->photo.'</p>';
  	echo '<p>Thumbnail: <br /><input type="file" name="uploadfilemini" /> '.$ed->photo.'</p>';

  	echo '<input type="submit" name="modifier" value="modifier" class="savebutt5" /> <input type="submit" name="dupliquer" value="dupliquer" class="savebutt6" /> <a href="" class="close">CLOSE</a></form>';
  	echo '</div></div></div>';

  //----------------------------------------------------------formulaire ajouter
  } else {
  	echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Ajouter Produit</span></h3><div class="inside">';
  	echo '<form name="newprod" id="newprod" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addstock" />';
    echo '<p>Famille: <select class="alignR" name="s_famille">';
    $list_fam = $wpdb->get_results("SELECT * FROM `$fb_tablename_famille` ORDER BY famille ASC");
		foreach ($list_fam as $fam) {
			echo '<option value="'.$fam->famille.'">'.$fam->famille.'</option>';
		}
    echo '</select></p>';
    echo '<p>Code barre: <input class="alignR" type="text" name="s_code" placeholder="code barre" /></p>';
    echo '<p>Référence: <input class="alignR" type="text" name="s_ref" placeholder="référence" /></p>';
    echo '<p>Désignation: <input class="alignR" type="text" name="s_designation" placeholder="désignation" /></p>';
    echo '<p>Fournisseur: <select class="alignR" name="s_fournisseur">';
    $list_fr = $wpdb->get_results("SELECT * FROM `$fb_tablename_fournisseurs` ORDER BY nom ASC");
    foreach ($list_fr as $fr) {
      echo '<option value="'.$fr->nom.'">'.$fr->nom.'</option>';
    }
    echo '</select></p>';
    echo '<p>Quantité: <input class="alignR" type="text" size="10" name="s_quantite" placeholder="1" /></p>';
    echo '<p>Mini: <input class="alignR" type="text" size="10" name="s_mini" placeholder="1" /></p>';
    echo '<p>Emplacement: <select class="alignR" name="s_place">';
    $list_place = $wpdb->get_results("SELECT * FROM `$fb_tablename_place` ORDER BY place ASC");
    foreach ($list_place as $pl) {
      echo '<option value="'.$pl->place.'">'.$pl->place.'</option>';
    }
    echo '</select></p>';
    echo '<p>Volume: <input class="alignR" type="text" name="s_volume" placeholder="HxLxP cm" /></p>';
  	echo '<p>Poids <input class="alignR" type="text" size="10" name="s_poids" placeholder="poids kg" /></p>';
  	echo '<p>PUA: <input class="alignR" type="text" size="10" name="s_PUA" placeholder="PUA &euro;" /></p>';
    echo '<p>PUV: <input class="alignR" type="text" size="10" name="s_PUV" placeholder="PUV &euro;" /></p>';
    echo '<p>Gestion automatique: <input class="radioBtn" type="radio" name="gestionAuto" value="1" />Oui <input class="radioBtn" type="radio" name="gestionAuto" value="0" checked />Non</p>';
  	echo '<p style="display:none;">Photo: <small>(or other external file)</small><br /><input type="file" name="uploadfile" /></p>';
  	echo '<p>Thumbnail: <br /><input type="file" name="uploadfilemini" /></p>';

  	echo '<input type="submit" value="ajouter" class="savebutt5" /></form>';
  	echo '</div></div></div>';
  }

  //--------------------------------------------------formulaire ajouter famille
  if (isset($_POST['addfam'])) {
    $famname = $_POST['famname'];
    $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_famille` VALUES ('', '$famname') ");
  }
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Ajouter famille</span></h3><div class="inside">';
  echo '<form name="newfam" id="newfam" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addfam" value="" />';
  echo '<p>Nom: <input class="alignR" type="text" name="famname" placeholder="nom" /></p>';
  echo '<input type="submit" value="ajouter" class="savebutt5" /></form>';
  echo '</div></div></div>';

  //----------------------------------------------formulaire ajouter fournisseur
  if (isset($_POST['addfr'])) {
    $frname = $_POST['frname'];
    $frcontact = $_POST['frcontact'];
    $frtel = $_POST['frtel'];
    $frtel2 = $_POST['frtel2'];
    $frmail = $_POST['frmail'];
    $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_fournisseurs` VALUES ('', '$frname', '$frcontact', '$frtel', '$frtel2', '$frmail') ");
  }
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Ajouter fournisseur</span></h3><div class="inside">';
  echo '<form name="newfr" id="newfr" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addfr" value="" />';
  echo '<p>Nom: <input class="alignR" type="text" name="frname" placeholder="nom" /></p>';
  echo '<p>Contact: <input class="alignR" type="text" name="frcontact" placeholder="contact" /></p>';
  echo '<p>Tel: <input class="alignR" type="text" name="frtel" placeholder="téléphone" /></p>';
  echo '<p>Tel2: <input class="alignR" type="text" name="frtel2" placeholder="téléphone" /></p>';
  echo '<p>Mail: <input class="alignR" type="text" name="frmail" placeholder="mail" /></p>';
  echo '<input type="submit" value="ajouter" class="savebutt5" /></form>';
  echo '</div></div></div>';

  //----------------------------------------------formulaire ajouter emplacement
  if (isset($_POST['addplace'])) {
    $plname = $_POST['plname'];
    $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_place` VALUES ('', '$plname') ");
  }
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Ajouter emplacement</span></h3><div class="inside">';
  echo '<form name="newplace" id="newplace" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addplace" value="" />';
  echo '<p>Nom: <input class="alignR" type="text" name="plname" placeholder="nom" /></p>';
  echo '<input type="submit" value="ajouter" class="savebutt5" /></form>';
  echo '</div></div></div>';

  //----------------------------------------------------------------------------
	echo '</div>';

  //------------------------------------------------------------------classement

  $fam_link = 'admin.php?page=fb-stock&sort=fam';
  $code_link = 'admin.php?page=fb-stock&sort=code';
  $ref_link = 'admin.php?page=fb-stock&sort=ref';
  $fr_link = 'admin.php?page=fb-stock&sort=fr';
  $pl_link = 'admin.php?page=fb-stock&sort=pl';
  $qte_link = 'admin.php?page=fb-stock&sort=qte';
  $des_link = 'admin.php?page=fb-stock&sort=des';
  $kg_link = 'admin.php?page=fb-stock&sort=kg';
  $vol_link = 'admin.php?page=fb-stock&sort=vol';
  $min_link = 'admin.php?page=fb-stock&sort=min';


  if (isset($_GET['sort'])) {
    $class_link = '&asc=1';

    if ($_GET['sort'] == 'fam') {
      $sortby = 'ORDER BY famille';
      $fam_link .= $class_link;
    }
    if ($_GET['sort'] == 'code') {
      $sortby = 'ORDER BY code';
      $code_link .= $class_link;
    }
    if ($_GET['sort'] == 'ref') {
      $sortby = 'ORDER BY ref';
      $ref_link .= $class_link;
    }
    if ($_GET['sort'] == 'fr') {
      $sortby = 'ORDER BY fournisseur';
      $fr_link .= $class_link;
    }
    if ($_GET['sort'] == 'pl') {
      $sortby = 'ORDER BY place';
      $pl_link .= $class_link;
    }
    if ($_GET['sort'] == 'qte') {
      $sortby = 'ORDER BY quantite';
      $qte_link .= $class_link;
    }
    if ($_GET['sort'] == 'des') {
      $sortby = 'ORDER BY designation';
      $des_link .= $class_link;
    }
    if ($_GET['sort'] == 'kg') {
      $sortby = 'ORDER BY poids';
      $kg_link .= $class_link;
    }
    if ($_GET['sort'] == 'vol') {
      $sortby = 'ORDER BY volume';
      $vol_link .= $class_link;
    }
    if ($_GET['sort'] == 'min') {
      $sortby = 'ORDER BY mini';
      $min_link .= $class_link;
    }

    $asc = $_GET['asc'];
    if($asc=='1') {
      $sortby .= ' DESC';
    }

  } else {
    $sortby = 'ORDER BY famille ASC';
  }

	$stock = $wpdb->get_results("SELECT * FROM `$fb_tablename_stock` $sortby", ARRAY_A);

  //-----------------------------------------------------------affichage tableau

  echo '<button id="exportStock"><i class="fa fa-save"></i> export</button>';
  echo '<h1>Gestion de stock <a class="stockbtn" href="admin.php?page=fb-stock" style="background:#26a7d9">Produits</a> <a class="stockbtn" href="admin.php?page=fb-fournisseurs">Fournisseurs</a> <a class="stockbtn" href="admin.php?page=fb-entree">Entrées/Sorties</a></h1>';
	echo '<div id="col-left" style="width:77%;margin-top:13px;">';
	echo '<table class="widefat widecenter fixed nopad" id="stock" cellspacing="0"><thead><tr>
    <th class="noExl">Photo</th>
    <th><a href="'.$fam_link.'">Famille</a></th>
    <th><a href="'.$code_link.'">Code</a></th>
    <th><a href="'.$ref_link.'">Reference</a></th>
    <th><a href="'.$des_link.'">Designation</a></th>
    <th><a href="'.$fr_link.'">Fournisseur</a></th>
    <th class="noExl">Tel</th>
    <th style="width:25px"><a href="'.$qte_link.'">Qté</a></th>
    <th style="width:25px"><a href="'.$min_link.'">Min</a></th>
    <th><a href="'.$pl_link.'">Place</a>
    </th><th><a href="'.$vol_link.'">Volume</a></th>
    <th style="width:45px"><a href="'.$kg_link.'">Poids</a></th>
    <th class="hideEditor" style="width:50px">PUA</th>
    <th class="hideEditor" style="width:50px">PTA</th>
    <th class="hideEditor" style="width:50px">PUV</th>
    <th class="hideEditor" style="width:50px">PTV</th>
    <th class="noExl" style="width:15px">A</th>
    <th class="noExl" style="width:55px">Modifier</th>
  </tr></thead>';

	foreach ($stock as $s) :
		//$n_price = str_replace(',', '', $s[price]).' &euro;';
		//$n_frais = str_replace(',', '', $s[frais]).' &euro;';
    $auto = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_auto` WHERE code='$s[code]'");
    $fr = $wpdb->get_row("SELECT * FROM `$fb_tablename_fournisseurs` WHERE nom='$s[fournisseur]'");
    $arr = explode('x', $s['volume']);
    $vol = ((int)$arr[0]*(int)$arr[1]*(int)$arr[2])/1000000;
		$viewmini = '';
		if ($s['photo']) {
			$viewmini = '<img src="'.get_bloginfo('url').'/wp-content/uploads/stock/mini'.$s['photo'].'" alt="" />';
		}
		echo '
      <tr>
        <td class="noExl">'.$viewmini.'</td>
        <td class="colalt">'.$s['famille'].'</td>
        <td>'.$s['code'].'</td>
        <td class="colalt">'.$s['ref'].'</td>
        <td>'.$s['designation'].'</td>
        <td class="colalt">'.$s['fournisseur'].'</td>
        <td class="noExl">'.$fr->tel.'</td>';
        if ($s['quantite'] < $s['mini']) {
          echo '<td class="colalert">'.$s['quantite'].'</td>';
        }else if ($s['quantite'] == $s['mini']){
          echo '<td class="colwarn">'.$s['quantite'].'</td>';
        }else{
          echo '<td class="colalt">'.$s['quantite'].'</td>';
        }
    echo '
        <td>'.$s['mini'].'</td>
        <td class="colalt">'.$s['place'].'</td>
        <td>'.$s['volume'].'</td>
        <td class="colalt">'.$s['poids'].'</td>
        <td class="hideEditor">'.$s['PUA'].'</td>
        <td class="hideEditor colalt">'.$s['PTA'].'</td>
        <td class="hideEditor">'.$s['PUV'].'</td>
        <td class="hideEditor colalt">'.$s['PTV'].'</td>';
        if ($auto==1){
          echo '<td class="hideEditor noExl">1</td>';
        }else{
          echo '<td class="hideEditor noExl">0</td>';
        }
    echo '
        <td class="noExl">
          <form name="delstock" action="" method="post">
            <input type="hidden" name="delstock" value="'.$s['Id'].'" />
            <input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' />
          </form>
          <form name="editstock" action="" method="post">
            <input type="hidden" name="editprod" value="'.$s['Id'].'" />
            <input type="submit" class="delete" value="Edit" />
          </form>
    		</td>
      </tr>
    ';

    $sumvol += $vol;
    $sumqte += $s['quantite'];
    $summin += $s['mini'];
    $sumpoi += $s['poids'];
    $sumpua += $s['PUA'];
    $sumpta += $s['PTA'];
    $sumpuv += $s['PUV'];
    $sumptv += $s['PTV'];
	endforeach;

  //--------------------------------------------------------------------- totaux

  echo '<tr>
    <th>TOTAUX:</th>
    <th class="noExl"></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th class="noExl"></th>
    <th>'.$sumqte.'</th>
    <th>'.$summin.'</th>
    <th></th>
    <th>'.number_format($sumvol, 2).' m&sup3;</th>
    <th>'.str_replace(',', '', number_format($sumpoi, 0)).' kg</th>
    <th>'.str_replace(',', '', number_format($sumpua, 0)).' €</th>
    <th>'.str_replace(',', '', number_format($sumpta, 0)).' €</th>
    <th>'.str_replace(',', '', number_format($sumpuv, 0)).' €</th>
    <th>'.str_replace(',', '', number_format($sumptv, 0)).' €</th>
    <th class="noExl"></th>
    <th class="noExl"></th>
  </tr>';
	echo '</table>';
	echo '</div></div>';

  // --------------------------------------------------------------export excell
  echo '<script>
    jQuery("#exportStock").click(function(){
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1;
      var yyyy = today.getFullYear();
      var hh = today.getHours();
      var mn = today.getMinutes();
      if(dd<10) {
          dd = "0"+dd
      }
      if(mm<10) {
          mm = "0"+mm
      }
      today = dd + "-" + mm + "-" + yyyy + "." + hh + "h" + mn;

      jQuery("#stock").table2excel({
        exclude: ".noExl",
        name: "Stock",
        filename: "stock."+today+".xls"
      });
    });
  </script>
  ';
}

////////////////////////////////////////////////////////////// page fournisseurs

function fb_admin_fournisseurs() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_famille = $prefix."fbs_stock_fam";
  $fb_tablename_place = $prefix."fbs_stock_place";
  $fb_tablename_fournisseurs = $prefix."fbs_stock_fournisseurs";


  //---------------------------------------------------------effacer fournisseur
  if (isset($_POST['delfr'])) {
		$frid = $_POST['delfr'];
		$wpdb->query("DELETE FROM `$fb_tablename_fournisseurs` WHERE id='$frid'");
	}
  //----------------------------------------------------------éditer fournisseur
  if (isset($_POST['editfr'])) {
    $frid = $_POST['editfr'];
    $frname = $_POST['frname'];
    $frcontact = $_POST['frcontact'];
    $frtel = $_POST['frtel'];
    $frtel2 = $_POST['frtel2'];
    $frmail = $_POST['frmail'];
    $updateowanie = $wpdb->query("UPDATE `$fb_tablename_fournisseurs` SET nom='$frname', contact='$frcontact', tel='$frtel', tel2='$frtel2', mail='$frmail' WHERE id='$frid'");
  }

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:22%;margin-top:38px;">';

  //-----------------------------------------------------------formulaire éditer
  if (isset($_POST['edit'])) {
    $frid = $_POST['edit'];
    $fr = $wpdb->get_row("SELECT * FROM `$fb_tablename_fournisseurs` WHERE id='$frid'");

    echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Modifier fournisseur</span></h3><div class="inside">';
    echo '<form name="edfr" id="edfr" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="editfr" value="'.$frid.'" />';
    echo '<p>Nom: <input class="alignR" type="text" name="frname" value="'.$fr->nom.'" /></p>';
    echo '<p>Contact: <input class="alignR" type="text" name="frcontact" value="'.$fr->contact.'" /></p>';
    echo '<p>Tel: <input class="alignR" type="text" name="frtel" value="'.$fr->tel.'" /></p>';
    echo '<p>Tel2: <input class="alignR" type="text" name="frtel2" value="'.$fr->tel2.'" /></p>';
    echo '<p>Mail: <input class="alignR" type="text" name="frmail" value="'.$fr->mail.'" /></p>';
    echo '<input type="submit" value="modifier" class="savebutt5" /></form>';
    echo '</div></div></div>';

  //----------------------------------------------------------formulaire ajouter
  } else {
    if (isset($_POST['addfr'])) {
      $frname = $_POST['frname'];
      $frcontact = $_POST['frcontact'];
      $frtel = $_POST['frtel'];
      $frtel2 = $_POST['frtel2'];
      $frmail = $_POST['frmail'];
      $wysylanie = $wpdb->query("INSERT INTO `$fb_tablename_fournisseurs` VALUES ('', '$frname', '$frcontact', '$frtel', '$frtel2', '$frmail') ");
    }
    echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Ajouter fournisseur</span></h3><div class="inside">';
    echo '<form name="newfr" id="newfr" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addfr" value="" />';
    echo '<p>Nom: <input class="alignR" type="text" name="frname" placeholder="nom" /></p>';
    echo '<p>Contact: <input class="alignR" type="text" name="frcontact" placeholder="contact" /></p>';
    echo '<p>Tel: <input class="alignR" type="text" name="frtel" placeholder="téléphone" /></p>';
    echo '<p>Tel2: <input class="alignR" type="text" name="frtel2" placeholder="téléphone" /></p>';
    echo '<p>Mail: <input class="alignR" type="text" name="frmail" placeholder="mail" /></p>';
    echo '<input type="submit" value="ajouter" class="savebutt5" /></form>';
    echo '</div></div></div>';
  }

  //----------------------------------------------------------------------------
	echo '</div>';

  //------------------------------------------------------------------classement

	$fourniss = $wpdb->get_results("SELECT * FROM `$fb_tablename_fournisseurs` ORDER BY nom ASC", ARRAY_A);

  //-----------------------------------------------------------affichage tableau
  echo '<h1>Gestion de stock <a class="stockbtn" href="admin.php?page=fb-stock">Produits</a> <a class="stockbtn" href="admin.php?page=fb-fournisseurs" style="background:#26a7d9">Fournisseurs</a> <a class="stockbtn" href="admin.php?page=fb-entree">Entrées/Sorties</a></h1>';
	echo '<div id="col-left" style="width:77%;margin-top:13px;">';
	echo '<table class="widefat widecenter fixed nopad" id="mywidefat" cellspacing="0"><thead><tr>
    <th>Nom</th>
    <th>Contact</th>
    <th>Tel</th>
    <th>Tel2</th>
    <th>Mail</th>
    <th style="width:55px">Modifier</th>
  </tr></thead>';

	foreach ($fourniss as $f) :
		echo '
      <tr>
        <td>'.$f['nom'].'</td>
        <td class="colalt">'.$f['contact'].'</td>
        <td>'.$f['tel'].'</td>
        <td class="colalt">'.$f['tel2'].'</td>
        <td>'.$f['mail'].'</td>
        <td>
          <form name="delfr" action="" method="post">
            <input type="hidden" name="delfr" value="'.$f['id'].'" />
            <input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' />
          </form>
          <form name="editfr" action="" method="post">
            <input type="hidden" name="edit" value="'.$f['id'].'" />
            <input type="submit" class="delete" value="Edit" />
          </form>
    		</td>
      </tr>
    ';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}

/////////////////////////////////////////////////////////// page entrées/sorties

function fb_admin_entree() {

	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_entree = $prefix."fbs_stock_entree";

  echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:22%;margin-top:65px;">';

  //----------------------------------------------------formulaire entrée simple
  if (isset($_POST['ajouter'])) {
    $codeErr = '';
    if (empty($_POST["encode"])) {
      $codeErr = "Code barre requis";
    } else {
      $encode = $_POST['encode'];
      $enqte = $_POST['enqte'];
      $encom = $_POST['encom'];

      $type = '';
      if ($enqte < 1) {
        $type = 'Sortie manuelle';
      }else{
        $type = 'Entrée manuelle';
      }

      fb_stock_auto($encode, $enqte, $type, $encom);
    }
  }
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Stock + / -</span></h3><div class="inside">';
  echo '<form name="addst" id="addst" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="ajouter" value="" />';

  echo '<p>Code: <input class="alignR" type="text" name="encode" placeholder="code barre" /><span class="error">* '.$codeErr.'</span></p>';
  echo '<p>Quantité: <input class="alignR" type="text" name="enqte" value="1" /></p>';
  echo '<p>Com: <input class="alignR" type="text" name="encom" placeholder="commentaire" /></p>';

  echo '<input type="submit" value="save" class="savebutt5" /></form>';
  echo '</div></div></div>';
  //echo '<script>jQuery("#enqte").increment({ minVal: -100, maxVal: 100 });</script>';

  //--------------------------------------------------formulaire entrée multiple
  if (isset($_POST['multiple'])) {
    $codeErr = '';
    if (empty($_POST["multi"])) {
      $codeErr = "Code barre requis";
    } else {
      // on sépare chaque ligne dans une rangée tableau
      $text = trim($_POST['multi']);
      $text = explode ("\n", $text);
      $text = array_unique($text, SORT_REGULAR);
      array_pop($text);

      //print_r($text);
      // on crée un tableau où pour chaque ligne arr[0] = I/O soit Entrée ou Sortie, arr[1] = code barre, arr[2] = quantité
      foreach ($text as $line) {
        $arr = explode(';', $line);
        //print_r($arr);
        $mvt = 0;
        if ($arr[0] == I) {
          $type = 'Entrée scan';
          $mvt = $arr[2];
        }else{
          $type = 'Sortie scan';
          $mvt = -$arr[2];
        }

        fb_stock_auto($arr[1], $mvt, $type, '-');
      }
    }
  }
  echo '<div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Scan Log</span></h3><div class="inside">';
  echo '<form name="addst" id="addst" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="multiple" value="" />';

  echo '<p><textarea name="multi" placeholder="Scan Log" rows="10" style="width:100%"/></textarea>';

  echo '<input type="submit" value="save" class="savebutt5" /></form>';
  echo '</div></div></div>';

  //----------------------------------------------------------------------------
	echo '</div>';

  $selcur=''; $sel=''; $sel1=''; $sel2=''; $sel3=''; $sel4=''; $sel5=''; $sel6=''; $sel7=''; $sel8=''; $sel9=''; $sel10=''; $sel11=''; $sel12='';
  $monthSelected = date('M Y');
  //------------------------------------------------------------------classement
  if (isset($_POST['gomonth']) && $_POST['mois'] == 'cur') {
    $monthSelected = date('M Y'); $selcur='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = (MONTH(NOW())) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins1') {
    $monthSelected = date('M Y', strtotime('-1 month')); $sel1='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 1 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins2') {
    $monthSelected = date('M Y', strtotime('-2 month')); $sel2='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 2 MONTH))  ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins3') {
    $monthSelected = date('M Y', strtotime('-3 month')); $sel3='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 3 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins4') {
    $monthSelected = date('M Y', strtotime('-4 month')); $sel4='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 4 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins5') {
    $monthSelected = date('M Y', strtotime('-5 month')); $sel5='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 5 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins6') {
    $monthSelected = date('M Y', strtotime('-6 month')); $sel6='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 6 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins7') {
    $monthSelected = date('M Y', strtotime('-7 month')); $sel7='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 7 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins8') {
    $monthSelected = date('M Y', strtotime('-8 month')); $sel8='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 8 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins9') {
    $monthSelected = date('M Y', strtotime('-9 month')); $sel9='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 9 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins10') {
    $monthSelected = date('M Y', strtotime('-10 month')); $sel10='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 10 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else if (isset($_POST['gomonth']) && $_POST['mois'] == 'moins11') {
    $monthSelected = date('M Y', strtotime('-11 month')); $sel11='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = MONTH(DATE_SUB(NOW(),INTERVAL 11 MONTH)) ORDER BY date DESC", ARRAY_A);
  }else{
    $monthSelected = date('M Y'); $selcur='selected="selected"';
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE MONTH(date) = (MONTH(NOW())) ORDER BY date DESC", ARRAY_A);
  }

  if (isset($_POST['gocat'])){
    $catvalue = $_POST['cate'];
    $entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE code=$catvalue ORDER BY date DESC", ARRAY_A);
  }
  //$entree = $wpdb->get_results("SELECT * FROM `$fb_tablename_entree` WHERE date BETWEEN (CURRENT_DATE() - INTERVAL 12 MONTH) AND (CURRENT_DATE()) ORDER BY date DESC", ARRAY_A);
  //$months = $wpdb->get_results("SELECT EXTRACT(MONTH FROM date) FROM `$fb_tablename_entree`");

  //-----------------------------------------------------------affichage tableau
  echo '<button id="exportJournal"><i class="fa fa-save"></i> export</button>';
  echo '<h1>Gestion de stock <a class="stockbtn" href="admin.php?page=fb-stock">Produits</a> <a class="stockbtn" href="admin.php?page=fb-fournisseurs">Fournisseurs</a> <a class="stockbtn" style="background:#26a7d9" href="admin.php?page=fb-entree">Entrées/Sorties</a><br />
  <form class="formin" name="selectmonth" type="" method="post">
  <select name="mois" id="mois">';
  echo '
    <option value="cur" '.$selcur.'>'.date('M Y').'</option>
    <option value="moins1" '.$sel1.'>'.date('M Y', strtotime('-1 month')).'</option>
    <option value="moins2" '.$sel2.'>'.date('M Y', strtotime('-2 month')).'</option>
    <option value="moins3" '.$sel3.'>'.date('M Y', strtotime('-3 month')).'</option>
    <option value="moins4" '.$sel4.'>'.date('M Y', strtotime('-4 month')).'</option>
    <option value="moins5" '.$sel5.'>'.date('M Y', strtotime('-5 month')).'</option>
    <option value="moins6" '.$sel6.'>'.date('M Y', strtotime('-6 month')).'</option>
    <option value="moins7" '.$sel7.'>'.date('M Y', strtotime('-7 month')).'</option>
    <option value="moins8" '.$sel8.'>'.date('M Y', strtotime('-8 month')).'</option>
    <option value="moins9" '.$sel9.'>'.date('M Y', strtotime('-9 month')).'</option>
    <option value="moins10" '.$sel10.'>'.date('M Y', strtotime('-10 month')).'</option>
    <option value="moins11" '.$sel11.'>'.date('M Y', strtotime('-11 month')).'</option>
    ';
  echo '
  </select>
  <button class="gostock" type="submit" name="gomonth">go</button>';
  //echo '<button type="submit" class="stockbtn prevnext" name="prevmonth" value="'.$i.'" style=""><i class="fa fa-caret-left"></i> Mois précédent</button>';
  //echo $nextm;
  echo '</form>
  <form class="formin" name="selectmonth" type="" method="post">
  <select name="cate" id="cate">
  <option value="produit">produit</option>';

  $stock = $wpdb->get_results("SELECT * FROM `$fb_tablename_stock` ORDER BY designation");
  foreach ($stock as $s) {
    echo '<option value="'.$s->code.'">'.$s->designation.'</option>';
  }

  echo '
  </select>
  <button class="gostock" type="submit" name="gocat">go</button>
  </form>
  </h1>';
	echo '<div id="col-left" style="width:77%;margin-top:0;">';
  echo '<table class="widefat widecenter fixed nopad" id="journal" cellspacing="0"><thead><tr>
    <th style="width:60px">Date</th>
    <th>Famille</th>
    <th>Designation</th>
    <th>Fournisseur</th>
    <th>Code</th>
    <th>Type</th>
    <th style="width:40px">Qté</th>
    <th style="width:160px">Commentaire</th>
    <th style="width:80px">Stock avant</th>
    <th style="width:80px">Stock actualisé</th>
  </tr></thead>';

  foreach ($entree as $e) :

    $s = $wpdb->get_row("SELECT * FROM `$fb_tablename_stock` WHERE code = '$e[code]'");

		echo '
      <tr>
        <td>'.$e['date'].'</td>
        <td class="colalt">'.$s->famille.'</td>
        <td>'.$s->designation.'</td>
        <td class="colalt">'.$s->fournisseur.'</td>
        <td>'.$e['code'].'</td>';
        if (strpos($e['type'], 'Sortie') !== false) {
          echo '<td class="colalert">'.$e['type'].'</td>';
        }else{
          echo '<td class="colgood">'.$e['type'].'</td>';
        }
        if ($e['mvt'] < 0) {
          echo '<td class="colalert">'.$e['mvt'].'</td>';
        }else{
          echo '<td class="colgood">'.$e['mvt'].'</td>';
        }
    echo '
        <td class="colalt">'.$e['com'].'</td>
        <td>'.$e['oldqte'].'</td>
        <td class="colalt">'.$e['newqte'].'</td>
      </tr>
    ';
	endforeach;

	echo '</table>';
	echo '</div></div>';

  // --------------------------------------------------------------export excell
  echo '<script>
    jQuery("#exportJournal").click(function(){
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1;
      var yyyy = today.getFullYear();
      var hh = today.getHours();
      var mn = today.getMinutes();
      if(dd<10) {
          dd = "0"+dd
      }
      if(mm<10) {
          mm = "0"+mm
      }
      today = dd + "-" + mm + "-" + yyyy + "." + hh + "h" + mn;

      jQuery("#journal").table2excel({
        exclude: ".noExl",
        name: "Journal",
        filename: "journal."+today+".xls"
      });
    });
  </script>
  ';
}

///////////////////////////////////////////// maj stock au passage en traitement
function fb_stock_traitement($number) {
  global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_prods = $prefix."fbs_prods";
  $fb_tablename_auto = $prefix."fbs_stock_auto";
  $produits = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$number' AND status='1'");

  $view = '<div class="retrait"><h3>mise à jour stock</h3><button class="closeButton"><i class="fa fa-times" aria-hidden="true"></i></button>';
  // on scanne la description de chaque produit dans la commande
  foreach($produits as $p) {
    $ref = $p->ref;
    $nameprod = $p->name;
    $descprod = $p->description;
    $qte = $p->quantity;
    $codebarre = '';
    $type = 'Sortie auto';
    // on extrait de la description la première ligne qui doit correspondre à la désignation produit dans la base stock_auto
    $text = trim($descprod);
    $text = str_replace('- ', '', $descprod);
    $arr = explode("<br />", $text);
    $desc = $arr[0];
    $ga = $wpdb->get_results("SELECT * FROM `$fb_tablename_auto` WHERE designation='$desc'");

    //------------------------------------------- s'il y a une référence produit
    if(!empty($ref)) {
      // cas particulier promo 2 rollups
      if ($desc == "2 roll-up Bestline Mosquito") $qte = $qte*2;

      // cas particuliers stand + valise ou Comptoir / expobag
      $comptoir = preg_match_all('/20170231/', $descprod, $resultat4);
      $comptoir = count($resultat4[0]);
      $valise = preg_match_all('/20170230/', $descprod, $resultat5);
      $valise = count($resultat5[0]);

      if ($comptoir >= 1) {
        $view .= '-'.$qte.' 20170231 Comptoir Easy Quick <br />';
        fb_stock_auto('20170231', -$qte, $type, $number);
      }
      if ($valise >= 1) {
        $view .= '-'.$qte.' 20170230 Valise ATLAS + Tablette <br />';
        fb_stock_auto('20170230', -$qte, $type, $number);
      }
      if ($nameprod == 'Stand ExpoBag') {
        $rollqte = $qte*2;
        $view .= '-'.$qte.' 20170230 Valise ATLAS + Tablette <br />';
        fb_stock_auto('20170230', -$qte, $type, $number);
        $view .= '-'.$qte.' 20170233 Présentoir 4 poches <br />';
        fb_stock_auto('20170233', -$qte, $type, $number);
        $view .= '-'.$rollqte.' 20170103 best-line 80x200 <br />';
        fb_stock_auto('20170103', -$rollqte, $type, $number);
      }

      // on retire la quantité de la référence désignée
      $view .= '-'.$qte.' '.$ref.' '.$desc.'<br />';
      fb_stock_auto($ref, -$qte, $type, $number);

    //------------------ s'il n'y a pas de référence on récupère la desc produit
    }else{
      // pour chaque description qui matche avec la base stock_auto, on récupère le code barre et on enlève la qté correspondante au stock
      foreach($ga as $g){
        $codebarre = $g->code;
        $view .= '-'.$qte.' '.$codebarre.' '.$desc.'<br />'; //test affichage description produit
        fb_stock_auto($codebarre, -$qte, $type, $number);
      }
    }

    //--------------------------------------------------------------------------
  } // fin foreach produit
  $view .= '</div>';
  echo $view;
  //----------------------------------------------------------------close alerts
  echo '<script>
    jQuery(document).on("click", ".closeButton", function() {
      jQuery(this).parent().fadeOut();
    });
  </script>';
//------------------------------------------------------------------------------
}

///////////////////////////////////////////////////////////// fonction maj stock
function fb_stock_auto($barcode, $mvt, $type, $com) {
  global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_entree = $prefix."fbs_stock_entree";
  // on récupère les données produit dans la base en fonction du code barre
  $getstock = $wpdb->get_row("SELECT * FROM `$fb_tablename_stock` WHERE code='$barcode'");
  $bddqte = $getstock->quantite;
  $bddpua = $getstock->PUA;
  $bddpuv = $getstock->PUV;
  // on met à jour la quantité et les valeurs qui en dépendent
  $qte = $bddqte+$mvt;
  $pta = $bddpua*$qte;
  $ptv = $bddpuv*$qte;
  $curDate = date('Y-m-d H:i:s');
  $upd_stock = $wpdb->query("UPDATE `$fb_tablename_stock` SET quantite='$qte', PTA='$pta', PTV='$ptv' WHERE code='$barcode'");
  $upd_entree = $wpdb->query("INSERT INTO `$fb_tablename_entree` VALUES ('', '$curDate', '$type', '$mvt', '$com', '$barcode', '$bddqte', '$qte') ");
}

///////////////////////////////////////////////////////// fonction alertes stock
function fb_stock_alert() {
  global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_stock = $prefix."fbs_stock_prods";
  $fb_tablename_entree = $prefix."fbs_stock_entree";

  $stock = $wpdb->get_results("SELECT * FROM `$fb_tablename_stock` ORDER BY famille", ARRAY_A);

  //-------------------------------------------------------------------affichage
  foreach ($stock as $s){
    if ($s['quantite'] < $s['mini']) {
      echo '<div class="stockAlert"><h2><i class="fas fa-archive"></i> Stock<br /> <span class="code">'.$s['code'].'</span></h2><button class="closeButton"><i class="fa fa-times" aria-hidden="true"></i></button>';
      //$en = $wpdb->get_row("SELECT * FROM `$fb_tablename_entree` WHERE code='$s['code']'");
  		echo '
      <li>
        <span>'.$s['famille'].'</span>
        <span>'.$s['designation'].'</span><br />
        <span>'.$s['fournisseur'].'</span>

      </li>
      <div class="qte">
        <span class="comm">Reste: '.$s['quantite'].'</span><br />
        <span class="comm">Min: '.$s['mini'].'</span>
      </div>

      ';
  	echo '</div>';
    }
  }
  //----------------------------------------------------------------close alerts
  echo '<script>
    jQuery(document).on("click", ".closeButton", function() {
      jQuery(this).parent().fadeOut();
    });
  </script>';
}
// fin gestion stock ///////////////////////////////////////////////////////////

//////////////////////////////////////////////////////// fonction alertes rappel
function fb_tel_alert($oid) {
  global $wpdb;
  global $current_user;
  $wpuser = $current_user->display_name;
	$prefix = $wpdb->prefix;
	$fb_tablename_tel = $prefix."fbs_tel";
  $now = date('d-m-Y');
  $tel = $wpdb->get_results("SELECT * FROM  `$fb_tablename_tel` ORDER BY id desc", ARRAY_A);

  if ($oid == 0) { // si l'appel à la fonction vient de la page sales, on redirige sur la page sales après avoir pris l'appel
    $location = '/wp-admin/admin.php?page=fbsh';
    $url = get_bloginfo('url').'/wp-admin/admin.php?page=fbsh';
  }else{ // si l'appel à la fonction vient d'une page détail commande, on redirige sur la page de la commande
    $location = '/wp-admin/admin.php?page=fbsh&fbdet='.$oid;
    $url = get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbdet='.$oid;
  }

  if(isset($_POST['subcall'])){
    $telid = $_POST['telid'];
    $wpuser = $_POST['wpuser'];
    $taken = 'Pris par admin '.$wpuser.'';
    $wpdb->query("UPDATE `$fb_tablename_tel` SET com='$taken' WHERE id='$telid'");

    if( !headers_sent() ){
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
    }else{
      ?>
      <script type="text/javascript">
      document.location.href="<?php echo $url; ?>";
      </script>
      <?php
    }
  }
  if(isset($_POST['subdone'])){
    $telid = $_POST['telid'];
    $wpdb->query("DELETE FROM `$fb_tablename_tel` WHERE id='$telid'");

    if( !headers_sent() ){
      header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
    }else{
      ?>
      <script type="text/javascript">
      document.location.href="<?php echo $url; ?>";
      </script>
      <?php
    }
  }
  //-------------------------------------------------------------------affichage
  $i = 0;
  foreach ($tel as $t){
    $i++;
    $time = strtotime($t['date']);
    $heure = date('H:i', $time);
    $find = preg_match_all('/admin/', $t['com'], $result);
    $find = count($result[0]);
    echo '<div class="stockAlert phoneAlert">
      <h2><i class="fas fa-phone-volume"></i> Appel<br /><span class="code">'.$heure.'</span></h2>
      <audio src="'.get_bloginfo('url').'/wp-content/themes/fb/sms.mp3" autoplay="autoplay"></audio>
      <li>
        <span>Un utilisateur souhaite être rappelé au</span>
        <span class="comm">'.$t['tel'].'</span><br />
        <span class="comm">'.$t['com'].'</span>
      </li>
      <div class="qte">';

      if ($find >= 1) {

      }else{
        echo '
        <form method="post" action="" name="call" data-call="'.$i.'">
          <input type="hidden" name="wpuser" value="'.$wpuser.'" />
          <input type="hidden" name="telid" value="'.$t['id'].'" />
          <input type="submit" name="subcall" value="prendre" class="phoneBtn" />
        </form>';
      }

      echo'
      <form method="post" action="" name="done" data-done="'.$i.'">
        <input type="hidden" name="telid" value="'.$t['id'].'" />
        <input type="submit" name="subdone" value="effectué" class="phoneBtn" />
      </form>
      </div>
    </div>';
  }
  //----------------------------------------------------------------close alerts


}


////////////////////////////////////////////////////////////////////////////////
//                                                                   CODES PROMO
////////////////////////////////////////////////////////////////////////////////

function fb_admin_promocode() {
	global $wpdb;
	$prefix = $wpdb->prefix;
  $fb_tablename_promo = $prefix."fbs_codepromo";

  //---------------------------------------------------------effacer fournisseur
  if (isset($_POST['delfr'])) {
		$prid = $_POST['delfr'];
		$wpdb->query("DELETE FROM `$fb_tablename_promo` WHERE code='$prid'");
	}

	echo '<div class="form-wrap"><div id="col-container">';
	echo '<div id="col-right" style="width:22%;margin-top:38px;">';

  //----------------------------------------------------------formulaire ajouter

  if (isset($_POST['addfr'])) {
    $prcode = $_POST['prcode'];
    $pramount = $_POST['pramount'];
    $prprice = $_POST['prprice'];
    $prcat = $_POST['prcat'];
    $prmini = $_POST['prmini'];
    $prdate = $_POST['prdate'];
    $addtodb = $wpdb->query("INSERT INTO `$fb_tablename_promo` VALUES ('$prcode', '$pramount', '$prprice', '$prcat', '$prmini','$prdate') ");
  }
  echo '
  <div id="poststuff" class="metabox-holder has-right-sidebar"><div class="postbox"><h3><span>Ajouter code promo</span></h3><div class="inside">';
  echo '<form name="newfr" id="newfr" action="" enctype="multipart/form-data" method="post"><input type="hidden" name="addfr" value="" />';
  echo '<p>Code: <input class="alignR" type="text" name="prcode" placeholder="code promo" /></p>';
  echo '<p>Réduction (%): <input class="alignR" type="text" name="pramount" placeholder="réduction en pourcentage" /></p>';
  echo '<p>Réduction (€): <input class="alignR" type="text" name="prprice" placeholder="ou réduction eu euros" /></p>';
  echo '<p>Catégorie: <select class="alignR" name="prcat">
    <option value="Tous">Tous les produits</option>
    <option value="Banderole">Banderole</option>
    <option value="Roll">Roll-up</option>
    <option value="Totem">Totem</option>
    <option value="Stand">Stand</option>
    <option value="Oriflamme">Oriflamme</option>
    <option value="Forex">Forex</option>
    <option value="Dibond">Dibond</option>
    <option value="Akilux">Akilux</option>
    <option value="PVC">PVC</option>
    <option value="Tente">Tente</option>
    <option value="PLVint">PLV-int</option>
    <option value="PLVext">PLV-ext</option>
    <option value="Affiche">Affiche</option>
    <option value="Depliant">Depliant</option>
    <option value="Flyer">Flyer</option>
    <option value="Cartes">Cartes</option>
    <option value="Sticker">Stickers</option>
    <option value="Nappe">Nappe</option>
    <option value="Cadre">Cadre Tissu</option>
    <option value="Enseigne">Enseigne Suspendue</option>
  </select></p>';
  echo '<p>Minimum d\'achat: <input class="alignR" type="text" name="prmini" placeholder="minimum d\'achat HT" /></p>';
  echo '<p>Date d\'expiration: <input class="alignR" type="text" name="prdate" placeholder="AAAA-MM-JJ" id="datepicker" /></p>';
  echo '<input type="submit" value="ajouter" class="savebutt5" /></form>';
  echo '</div></div></div>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $( function() {
      $( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
    } );
  </script>
  ';

  //----------------------------------------------------------------------------
	echo '</div>';

  //------------------------------------------------------------------classement

	$prcodes = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY code ASC", ARRAY_A);

  //-----------------------------------------------------------affichage tableau
  echo '<h1>Codes promo</h1>';
	echo '<div id="col-left" style="width:77%;margin-top:13px;">';
	echo '<table class="widefat widecenter fixed nopad" id="mywidefat" cellspacing="0"><thead><tr>
    <th>Code</th>
    <th>Réduction (%)</th>
    <th>Réduction (€)</th>
    <th>Catégorie</th>
    <th>Minimum d\'achat (€)</th>
    <th>Date d\'expiration</th>
    <th>Supprimer</th>
  </tr></thead>';

  $curdate = date("Y-m-d");
	foreach ($prcodes as $p) :
    if($curdate > $p['date']) {
      echo '<tr class="grized">';
    }else{
      echo '<tr>';
    }
    echo '
        <td>'.$p['code'].'</td>
        <td>'.$p['remise'].'</td>
        <td>'.$p['reduction'].'</td>
        <td>'.$p['categorie'].'</td>
        <td>'.$p['mini'].'</td>
        <td>'.$p['date'].'</td>
        <td>
          <form name="delfr" action="" method="post">
            <input type="hidden" name="delfr" value="'.$p['code'].'" />
            <input type="submit" class="delete" value="Delete" onclick=\'if (confirm("'.esc_js( "Are you sure?" ).'")) {return true;} return false;\' />
          </form>
    		</td>
      </tr>
    ';
	endforeach;
	echo '</table>';
	echo '</div></div>';
}

// ANNULATION DES DEVIS SANS ACTION DEPUIS +7J

function cancel_abandonned($uid) {

  /*le client est un nouveau client,
  il n' a pas téléchargé de fichier,
  n'a pas d'ancienne commande dans son compte,
  n'a pas payé sa commande,
  il a déjà reçu 3 relances pour un devis inactif,
  ==> dans ce cas, la commande passe en statut "annulé" et on envoie le mail "votre devis a été annulé*/

  global $wpdb;
  $prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
  $fb_tablename_mails = $prefix."fbs_mails";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_cf = $prefix."fbs_cf";

  $us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$uid'");

  $active = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE user = '$uid' AND status > 1 AND status != 6");
  $num_active = count($active);
  $inactive = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE user = '$uid' AND status < 2");
  $num_inactive = count($inactive);
  /*echo '<br/><br/>'.$num_active. ' commandes actives ou cloturées pour le client '.$o->user .'<br/>';
  echo '<br/><br/>'.$num_inactive. ' commandes en attente pour le client '.$o->user .'<br/>';*/

  // pour chaque commande de ce client
  $i = 0;
  $rt = '';
  foreach ($inactive as $c) :
    // vérifier s'il y a des fichiers uploadés dans la commande
    $cid = $c->unique_id;
    $pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$cid.'/';
    $files = scandir($pathfiles);
    $num_files = count($files)-1;
    /*echo 'il y a ' .$num_files. ' fichiers dans le dossier commande no ' .$cid.'<br/>';
    echo 'status: ' .$c->status.' <br>';*/

    // vérifier s'il y a des relances (recherche titre commentaire "attention 7 jours")
    $comments = $wpdb->get_results("SELECT * FROM `$fb_tablename_comments` WHERE order_id = '$cid' AND topic like 'ATTENTION 7 JOURS'");
    $num_com = count($comments);
    /*echo 'il y a ' .$num_com. ' relances devis inactif pour la commande no ' .$cid.'<br/>';*/

    // vérifier que le dernier commentaire soit un avis de relance
    $lastcomment = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments` WHERE order_id = '$cid' ORDER BY date DESC");

    // s'il n'y a pas de fichier ni de commandes actives ou cloturées, et qu'il y a plus de 2 relances, passage au statut 'annulé'
    if ($lastcomment->topic == 'ATTENTION 7 JOURS' && $num_active == 0 && $num_files < 1 && $num_com > 2) {
      $i++;
      // on ajoute un lien vers les commandes concernées
      $rt .= '<a href="'.get_bloginfo("url").'/wp-admin/admin.php?page=fbsh&fbdet='.$cid.'">'.$cid.'</a> | ';

      $date = date('Y-m-d H:i:s');
      // au clic sur annuler on passe les commandes au statut annulé et on envoie un mail au client
      if(isset($_POST['cancelinactive'])) {
    	  $cancel = $wpdb->update($fb_tablename_order, array ( 'status' => 6, 'date_modify' => $date), array ( 'unique_id' => $cid ));

        // ENVOI de l'email 'Votre devis a été annulé'
        $mails = $wpdb->get_results("SELECT * FROM `$fb_tablename_mails` WHERE topic LIKE 'Votre devis a été annulé'", ARRAY_A);
      	foreach ($mails as $ma) :
      		$con = stripslashes($ma['content']);
      		$con = htmlspecialchars($con);
      		$top = stripslashes($ma['topic']);
      		$top = htmlspecialchars($top);
      	endforeach;

      	/* On remplace NNNNN dans le message par le no de comande */
      	$con = str_replace("NNNNN",$cid,$con);

      	$temat = htmlspecialchars_decode($top);
      	$zawar = htmlspecialchars_decode($con);
      	$header = 'From: France Banderole <information@france-banderole.com>';
        $header .= "\nContent-Type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";

      	mail($us->email, stripslashes($temat), stripslashes($zawar), $header);
      }
    }
  endforeach;
  return $rt;
}
?>
