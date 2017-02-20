<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

$prefix = $wpdb->prefix;
$fb_tablename_rating = $prefix."fbs_rating";
$fb_tablename_users = $prefix."fbs_users";
$fb_tablename_order = $prefix."fbs_order";
$fb_tablename_prods = $prefix."fbs_prods";
$fb_tablename_catprods = $prefix."fbs_catprods";
$fb_tablename_cache_notes = $prefix."fbs_cache_notes";
$fb_tablename_cache_comments = $prefix."fbs_cache_prodratings";
$fb_tablename_cache_ratings = $prefix."fbs_cache_ratings";

$prod_family = htmlentities(addslashes($_GET['prod']));
$full_list = htmlentities(addslashes($_GET['list']));


//Mise en cache des 2 premiers commentaires	
	
$rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC LIMIT 5", ARRAY_A);
$del_cache = $wpdb->query("DELETE FROM `$fb_tablename_cache_comments` WHERE code_parent = '$prod_family'");
$i=0;
foreach ($rates as $r) {
 $i++;
			if($i == 1) {
				$mise_cache = $wpdb->query("INSERT INTO `$fb_tablename_cache_comments` VALUES ('','$prod_family','$r[id]',0,0,0,0)");
			} else if($i == 2) {
				$mise_cache = $wpdb->query("UPDATE `$fb_tablename_cache_comments` SET comment2 = '$r[id]' WHERE code_parent = '$prod_family'");
			} else if($i == 3) {
				$mise_cache = $wpdb->query("UPDATE `$fb_tablename_cache_comments` SET comment3 = '$r[id]' WHERE code_parent = '$prod_family'");
			} else if($i == 4) {
				$mise_cache = $wpdb->query("UPDATE `$fb_tablename_cache_comments` SET comment4 = '$r[id]' WHERE code_parent = '$prod_family'");
			} else if($i == 5) {
				$mise_cache = $wpdb->query("UPDATE `$fb_tablename_cache_comments` SET comment5 = '$r[id]' WHERE code_parent = '$prod_family'");
			}
}
			
//Mise en cache des notations

$moyenne = $wpdb->get_row("SELECT AVG(r.fir+r.sec+r.thi)/3 AS moy FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
$total = $wpdb->get_row("SELECT COUNT(*) AS nb_avis FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family'");
$strmoyenne1 = round($moyenne->moy,2);
$del_cache = $wpdb->query("DELETE FROM `$fb_tablename_cache_notes` WHERE code_parent = '$prod_family'");
$mise_cache = $wpdb->query("INSERT INTO `$fb_tablename_cache_notes` VALUES ('','$prod_family','$strmoyenne1','$total->nb_avis')");
if ($full_list) {
//Mise en cache de la liste des commentaires

$rates = $wpdb->get_results("SELECT r.*, DATE_FORMAT(r.date, '%d/%m/%Y') AS data FROM `$fb_tablename_rating` r, `$fb_tablename_prods` p, `$fb_tablename_order` o, `$fb_tablename_catprods` c WHERE r.exist = 'true' AND r.unique_id = o.unique_id AND p.order_id = o.unique_id AND p.name = c.nom_produit AND c.code_parent = '$prod_family' ORDER BY r.date DESC", ARRAY_A);
$cache_list = '';
foreach ($rates as $r) {
	$cache_list .= $r[id].';';
}
$del_cache = $wpdb->query("DELETE FROM `$fb_tablename_cache_ratings` WHERE code_parent = '$prod_family'");
$mise_cache = $wpdb->query("INSERT INTO `$fb_tablename_cache_ratings` VALUES('','$prod_family','$cache_list')");

}