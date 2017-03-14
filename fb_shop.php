<?php
/*
Plugin Name: FB Shop
Plugin URI: http://denisedesign.ie/
Description: FB Shop for france-banderole.com.
Version: 2.5
Author: Wojciech Pydynkowski
Author URI: http://denisedesign.ie
*/

add_action( 'init', 'fbs_plugin_init' );
function fbs_plugin_init() {
	$siteurl = get_option('siteurl');
	define('FBSHOP_FOLDER', dirname(plugin_basename(__FILE__)));
	define('FBSHOP_URL', WP_PLUGIN_DIR . '/' . FBSHOP_FOLDER);
//	fbs_install();
	add_action('wp_head', 'fbshop_head');
	date_default_timezone_set(get_option('timezone_string'));
	include(FBSHOP_URL . '/fb_para_mailjet.php');
	include(FBSHOP_URL . '/fb_prod.php');
	include(FBSHOP_URL . '/fb_papier.php');
	include(FBSHOP_URL . '/fb_register.php');
	include(FBSHOP_URL . '/fb_admin.php');
	include(FBSHOP_URL . '/fb_order.php');
	include(FBSHOP_URL . '/fb_comments.php');
	include(FBSHOP_URL . '/fb_rating.php');
	include(FBSHOP_URL . '/fb_paye.php');
	include(FBSHOP_URL . '/fb_lang.php');
	fb_admin_init();
	register_cart();
	fb_is_logged();
}

function register_cart() {
	session_start();
	if(!isset($_SESSION['fbcart'])) {
		$_SESSION['fbcart'] = 0;
	}
	if( (isset($_SESSION['fbcart'])) && ($_GET['cart'] == 'clear') ) {
		$_SESSION['fbcart'] = 0;
	}
	if(isset($_POST['addtocart'])) {
		$products = $_SESSION['fbcart'];
    	if (!is_array($products)) {
			$products = array();
		}
		$product = array(rodzaj=>$_POST['rodzaj'], opis=>$_POST['opis'], ilosc=>$_POST['ilosc'], prix=>$_POST['prix'], option=>$_POST['option'], remise=>$_POST['remise'], total=>$_POST['total'], transport=>$_POST['transport']);
		array_push($products, $product);
		$_SESSION['fbcart'] = $products;
		header('location: ' . $SERVER['PHP_SELF'] . '?' . SID);
		exit;
	}
	if(isset($_POST['addtocart2'])) {
		$products = $_SESSION['fbcart'];
    	if (!is_array($products)) {
			$products = array();
		}
		if ($_POST['opis1'] != '') $opis .= '- '.$_POST['opis1'].'<br />';
		if ($_POST['opis2'] != '') $opis .= '- '.$_POST['opis2'].'<br />';
		if (isset($_POST['ceddre'])) {
			$prix = $_POST['prix'] + $_POST['ceddre'];
		} else {
			$prix = $_POST['prix'];		
		}
		if ($_POST['isplv'] == 'true') {
			if ($_POST['projectmak'] == 'fb') {
				$opis .= '- France banderole crée la maquette<br />';
				$prix = $prix + 40;
			}
			if ($_POST['projectmak'] == 'us') {
				$opis .= '- j’ai déjà crée la maquette<br />';				
			}
		}
		$ilosc = $_POST['ilosc'];
		$recycler = $_POST['recycler'];
		if (!empty($recycler)) {
			if ($ilosc == 1) {
				$prix = $prix + 40;
			}
			if ($ilosc > 1) {
				$prix = $prix + 4.9;
			}
			$opis .= '- recycler les bâches<br />';				
		}
		$colis = $_POST['colis'];
		if (!empty($colis)) {
			$opis .= '- colis revendeur<br />';				
		}
		$etiquette = $_POST['etiquette'];
		if (!empty($etiquette)) {
			if ($ilosc > 9) {
				$prix = $prix + (1.5 * $ilosc);
				$opis .= '- étiquette personnalisée<br />';				
			}
		}
		$rush24 = $_POST['rush24'];
		if (!empty($rush24)) {
			if ($ilosc == 1) {
				$prix = $prix + 59;
			}
			if ($ilosc == 2) {
				$prix = $prix + 49;
			}
			if ($ilosc > 2 && $ilosc < 6) {
				$prix = $prix + 39;
			}
			if ($ilosc > 5 && $ilosc < 9) {
				$prix = $prix + 29;
			}
			if ($ilosc > 8 && $ilosc < 21) {
				$prix = $prix + 19;
			}
			if ($ilosc > 20) {
				$prix = $prix + 19;
			}
			$opis .= '- délai rush 24/48H<br />';				
		}
		$rush72 = $_POST['rush72'];
		if (!empty($rush72)) {
			if ($ilosc == 1) {
				$prix = $prix + 49;
			}
			if ($ilosc == 2) {
				$prix = $prix + 39;
			}
			if ($ilosc > 2 && $ilosc < 6) {
				$prix = $prix + 29;
			}
			if ($ilosc > 5 && $ilosc < 9) {
				$prix = $prix + 19;
			}
			if ($ilosc > 8 && $ilosc < 21) {
				$prix = $prix + 9;
			}
			if ($ilosc > 20) {
				$prix = $prix + 9;
			}
			$opis .= '- délai rush 72H<br />';				
		}

		$total = $ilosc * $prix;
		$relais = $_POST['relais'];
		if (!empty($relais)) {
			$total = $total + 3;
			$opis .= '- relais colis<br />';				
		}
		$prix2 = number_format($prix, 2, '.', '').' &euro;';
		$total = number_format($total, 2, '.', '').' &euro;';
		$product = array(rodzaj=>$_POST['rodzaj'], opis=>$opis, ilosc=>$_POST['ilosc'], prix=>$prix2, option=>'-', remise=>'-', total=>$total, transport=>$_POST['transport']);
		array_push($products, $product);
		$_SESSION['fbcart'] = $products;
		header('location: ' . $SERVER['PHP_SELF'] . '?' . SID);
		exit;
	}
	
	
	if(isset($_POST['addtocartmma'])) {
		$products = $_SESSION['fbcart'];
    	if (!is_array($products)) {
			$products = array();
		}
		if ($_POST['opis1'] != '') $opis .= '- '.$_POST['opis1'].'<br />';
		if ($_POST['opis2'] != '') $opis .= '- '.$_POST['opis2'].'<br />';
		if (isset($_POST['ceddre'])) {
			$prix = $_POST['prix'] + $_POST['ceddre'];
		} else {
			$prix = $_POST['prix'];		
		}
		if ($_POST['ismma'] == 'true') {
		$_SESSION['ismma'] = 'true';
			if ($_POST['projectmak'] == 'fb') {
				$opis .= '- France banderole crée la maquette<br />';
				$prix = $prix + 40;
			}
			if ($_POST['projectmak'] == 'us') {
				$opis .= '- j’ai déjà crée la maquette<br />';				
			}
		}
		$ilosc = $_POST['ilosc'];
		$recycler = $_POST['recycler'];
		if (!empty($recycler)) {
			if ($ilosc == 1) {
				$prix = $prix + 40;
			}
			if ($ilosc > 1) {
				$prix = $prix + 4.9;
			}
			$opis .= '- recycler les bâches<br />';				
		}
		$colis = $_POST['colis'];
		if (!empty($colis)) {
			$opis .= '- colis revendeur<br />';				
		}
		$etiquette = $_POST['etiquette'];
		if (!empty($etiquette)) {
			if ($ilosc > 9) {
				$prix = $prix + (1.5 * $ilosc);
				$opis .= '- étiquette personnalisée<br />';				
			}
		}
		$rush24 = $_POST['rush24'];
		if (!empty($rush24)) {
			if ($ilosc == 1) {
				$prix = $prix + 59;
			}
			if ($ilosc == 2) {
				$prix = $prix + 49;
			}
			if ($ilosc > 2 && $ilosc < 6) {
				$prix = $prix + 39;
			}
			if ($ilosc > 5 && $ilosc < 9) {
				$prix = $prix + 29;
			}
			if ($ilosc > 8 && $ilosc < 21) {
				$prix = $prix + 19;
			}
			if ($ilosc > 20) {
				$prix = $prix + 19;
			}
			$opis .= '- délai rush 24/48H<br />';				
		}
		$rush72 = $_POST['rush72'];
		if (!empty($rush72)) {
			if ($ilosc == 1) {
				$prix = $prix + 49;
			}
			if ($ilosc == 2) {
				$prix = $prix + 39;
			}
			if ($ilosc > 2 && $ilosc < 6) {
				$prix = $prix + 29;
			}
			if ($ilosc > 5 && $ilosc < 9) {
				$prix = $prix + 19;
			}
			if ($ilosc > 8 && $ilosc < 21) {
				$prix = $prix + 9;
			}
			if ($ilosc > 20) {
				$prix = $prix + 9;
			}
			$opis .= '- délai rush 72H<br />';				
		}

		$total = $ilosc * $prix;
		$relais = $_POST['relais'];
		if (!empty($relais)) {
			$total = $total + 3;
			$opis .= '- relais colis<br />';				
		}
		$prix2 = number_format($prix, 2, '.', '').' &euro;';
		$total = number_format($total, 2, '.', '').' &euro;';
		$product = array(rodzaj=>$_POST['rodzaj'], opis=>$opis, ilosc=>$_POST['ilosc'], prix=>$prix2, option=>'-', remise=>'-', total=>$total, transport=>$_POST['transport']);
		array_push($products, $product);
		$_SESSION['fbcart'] = $products;
		header('location: ' . $SERVER['PHP_SELF'] . '?' . SID);
		exit;
	}
	
	
	if(isset($_POST['addtocart3'])) {
		$products = $_SESSION['fbcart'];
    	if (!is_array($products)) {
			$products = array();
		}
		if ($_POST['opis1'] != '') $opis .= '- '.$_POST['opis1'].'<br />';
		if ($_POST['opis2'] != '') $opis .= '- '.$_POST['opis2'].'<br />';
		if (isset($_POST['ceddre'])) {
			$prix = $_POST['prix'] + $_POST['ceddre'];
		} else {
			$prix = $_POST['prix'];		
		}
		if ($_POST['isburaliste'] == 'true') {
			$_SESSION['isburaliste'] = 'true';
			if ($_POST['projectmak'] == 'fb') {
				$opis .= '- Personalisation du Visuel<br />';
				$prix = $prix + 27.5;
			}
			if ($_POST['projectmak'] == 'us') {
				$opis .= '- Visuel Standard<br />';				
			}
		}
		
		$ilosc = $_POST['ilosc'];
		$total = $ilosc * $prix;
		$prix2 = number_format($prix, 2, '.', '').' &euro;';
		$total = number_format($total, 2, '.', '').' &euro;';
		$product = array(rodzaj=>$_POST['rodzaj'], opis=>$opis, ilosc=>$_POST['ilosc'], prix=>$prix2, option=>'-', remise=>'-', total=>$total, transport=>$_POST['transport']);
		array_push($products, $product);
		$_SESSION['fbcart'] = $products;
		header('location: ' . $SERVER['PHP_SELF'] . '?' . SID);
		exit;
	}
	
	if(isset($_POST['delfromcart'])) {
		$products = $_SESSION['fbcart'];
		$licznik = 0;
		foreach ( $products as $key => $item ) {
			$licznik++;
			if ( ($item[rodzaj] == $_POST['rodzaj']) && ($item[opis] == $_POST['opis']) && ($item[ilosc] == $_POST['ilosc']) && ($licznik=$_POST['licznik']) ){
				unset($products[$key]);
			}
		}
	    $_SESSION['fbcart'] = $products;
		header('location: ' . $SERVER['PHP_SELF'] . '?' . SID);
		exit;
	}
	if (isset($_SESSION['loggeduser']) && ($_GET["logout"] == "true")) {
	    unset($_SESSION['loggeduser']);
	    unset($_SESSION['fbcart']);
		header('location: / ' );
		exit;
	}
}


function fbs_install () {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";
	$fb_tablename_state = $prefix."fbs_state";
	$fb_tablename_promo = $prefix."fbs_promo";
	$fb_tablename_mails = $prefix."fbs_mails";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_rating = $prefix."fbs_rating";
	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_mails."'") != $fb_tablename_mails) {
		$mails_query = "CREATE TABLE ".$fb_tablename_mails." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		topic longtext NULL DEFAULT NULL,
		content longtext NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($mails_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_promo."'") != $fb_tablename_promo) {
		$promo_query = "CREATE TABLE ".$fb_tablename_promo." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		name longtext NULL DEFAULT NULL,
		subname longtext NULL DEFAULT NULL,
		description longtext NULL DEFAULT NULL,
		price varchar(100) NULL DEFAULT NULL,
		ceddre varchar(100) NULL DEFAULT NULL,
		photo varchar(255) NULL DEFAULT NULL,
		photo_mini varchar(255) NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($promo_query);
	}
	
	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_state."'") != $fb_tablename_state) {
		$state_query = "CREATE TABLE ".$fb_tablename_state." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		value bigint(20) NOT NULL,
		status varchar(100) NOT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($state_query);
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '0','attente')");
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '1','attente paiement')");
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '2','payé')");
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '3','traitement')");
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '4','expédié')");
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '5','cloturé')");
		$wpdb->query("INSERT INTO `$fb_tablename_state` VALUES (not null, '6','annulées')");
	}
	
	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_comments."'") != $fb_tablename_comments) {
		$comments_query = "CREATE TABLE ".$fb_tablename_comments." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		order_id varchar(100) NOT NULL,
		topic longtext NULL DEFAULT NULL,
		date datetime NOT NULL,
		author varchar(100) NOT NULL,
		content longtext NOT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($comments_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_comments_new."'") != $fb_tablename_comments_new) {
		$comments_new_query = "CREATE TABLE ".$fb_tablename_comments_new." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		order_id varchar(100) NOT NULL,
		value varchar(100) NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($comments_new_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_topic."'") != $fb_tablename_topic) {
		$topic_query = "CREATE TABLE ".$fb_tablename_topic." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		topic longtext NULL DEFAULT NULL,
		content longtext NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($topic_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_prods."'") != $fb_tablename_prods) {
		$prods_query = "CREATE TABLE ".$fb_tablename_prods." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		order_id varchar(100) NOT NULL,
		name varchar(100) NOT NULL,
		description longtext NOT NULL,
		quantity int(11) NOT NULL,
		prix varchar(100) NOT NULL,
		prix_option varchar(100) NOT NULL,
		remise varchar(100) NOT NULL,
		total varchar(100) NOT NULL,
		frais varchar(100) NOT NULL,
		filename varchar(255) NULL DEFAULT NULL,
		status int(11) NOT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($prods_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_order."'") != $fb_tablename_order) {
		$order_query = "CREATE TABLE ".$fb_tablename_order." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		unique_id varchar(100) NOT NULL,
		frais varchar(100) NOT NULL,
		totalht varchar(100) NOT NULL,
		tva varchar(100) NOT NULL,
		totalttc varchar(100) NOT NULL,
		date datetime NOT NULL,
		date_modify datetime NOT NULL,
		user int(11) NOT NULL,
		tnt varchar(100) NULL DEFAULT NULL,
		status int(11) NOT NULL,
		payment varchar(100) NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($order_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_remises."'") != $fb_tablename_remises) {
		$remises_query = "CREATE TABLE ".$fb_tablename_remises." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		unique_id varchar(100) NOT NULL,
		remis varchar(100) NULL DEFAULT NULL,
		reason longtext NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($remises_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_cf."'") != $fb_tablename_cf) {
		$cf_query = "CREATE TABLE ".$fb_tablename_cf." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		unique_id varchar(100) NOT NULL,
		type varchar(100) NULL DEFAULT NULL,
		value longtext NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($cf_query);
//		$import = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE tnt!='' ORDER BY id ASC", ARRAY_A);
//		foreach ($import as $import => $i) :
//			$dopisz = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$i[unique_id]."', 'shipping', 'tnt')");
//		endforeach;		
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_rating."'") != $fb_tablename_rating) {
		$rat_query = "CREATE TABLE ".$fb_tablename_rating." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		unique_id varchar(100) NOT NULL,
		exist varchar(100) NULL DEFAULT NULL,
		fir varchar(100) NULL DEFAULT NULL,
		sec varchar(100) NULL DEFAULT NULL,
		thi varchar(100) NULL DEFAULT NULL,
		comment longtext NULL DEFAULT NULL,
		date datetime NOT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($rat_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_address."'") != $fb_tablename_address) {
		$users_query = "CREATE TABLE ".$fb_tablename_address." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		user bigint(20) NOT NULL,
		unique_id varchar(100) NOT NULL,
		l_name varchar(100) NULL DEFAULT NULL,
		l_comp varchar(100) NULL DEFAULT NULL,
		l_address varchar(100) NULL DEFAULT NULL,
		l_code varchar(100) NULL DEFAULT NULL,
		l_city varchar(100) NULL DEFAULT NULL,
		l_phone varchar(100) NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($users_query);
	}

	if ($wpdb->get_var("SHOW TABLES LIKE '".$fb_tablename_users."'") != $fb_tablename_users) {
		$users_query = "CREATE TABLE ".$fb_tablename_users." (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		login varchar(100) NOT NULL,
		email varchar(100) NOT NULL,
		pass varchar(100) NOT NULL,
		f_name varchar(100) NOT NULL,
		f_comp varchar(100) NULL DEFAULT NULL,
		f_address varchar(100) NOT NULL,
		f_code varchar(100) NOT NULL,
		f_city varchar(100) NOT NULL,
		f_phone varchar(100) NOT NULL,
		l_name varchar(100) NULL DEFAULT NULL,
		l_comp varchar(100) NULL DEFAULT NULL,
		l_address varchar(100) NULL DEFAULT NULL,
		l_code varchar(100) NULL DEFAULT NULL,
		l_city varchar(100) NULL DEFAULT NULL,
		l_phone varchar(100) NULL DEFAULT NULL,
		status int(11) DEFAULT 0,
		confirm_link varchar(255) NULL DEFAULT NULL,
		PRIMARY KEY (id)
		) DEFAULT CHARSET=utf8;";
		$wpdb->query($users_query);
	}	
}


add_shortcode('FBSHOP', 'wywolaj');
function wywolaj($page, $pageid) {
	return generate_page($page['page'], $page['pageid']);
}

function get_newsletter_un() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$nlet = $prefix."nlet_users";
	if (isset($_POST[potw]) && $_POST[potw] != 'no') {
		$usun = $wpdb->query("DELETE FROM `$nlet` WHERE email='$_POST[potw]'");
		if ($usun) {
			_e('Vous avez bien été désinscrit de notre newsletter, veuillez nous excuser de la gêne occasionnée.');
		}
	} elseif (isset($_GET[unsubscribe])) {
		$czyistnieje = $wpdb->get_row("SELECT * FROM `$nlet` WHERE email = '".str_replace('3214a8', '@', $_GET[unsubscribe])."'");
		if ($czyistnieje) {
			echo '<p>Etes-vous sûr(e) de vouloir vous désinscrire ?</p><div style="float:left;display:inline;margin-right:10px;"><form name="form" id="formuns" method="post" action=""><input type="hidden" name="potw" value="'.str_replace('3214a8', '@', $_GET[unsubscribe]).'" /><input type="submit" value="OUI" /></form></div><div style="float:left;display:inline;"><form name="form" id="formuns2" method="post" action="'.get_bloginfo("url").'"><input type="hidden" name="potw" value="no" /><input type="submit" value="NON" /></form></div>';
		} else {
			_e('Sorry, no posts matched your criteria.1');
		}
	} else {
		_e('Sorry, no posts matched your criteria.');
	}
}
?>
