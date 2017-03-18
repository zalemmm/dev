<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

global $wpdb;
$prefix = $wpdb->prefix;	
$fb_tablename_order = $prefix."fbs_order";
$fb_tablename_users = $prefix."fbs_users";

$cat = $_POST['csv_group'];

$data = $wpdb->get_results("SELECT *, SUM(CAST(REPLACE(totalht,',','') AS DECIMAL(30,2))) AS total FROM `$fb_tablename_order` ".$where." GROUP BY user ORDER BY total");
$list = array();

if($cat == 'csv_all') {

	foreach ($data AS $d) {
								
		$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$d->user."'");
		$user_mail = $user_data->email;
		$tmp = array($user_mail);
		array_push($list, $tmp);
		
	}

} else if($cat == 'csv_800') {

	foreach ($data AS $d) {
								
		if(($d->total > 800) AND ($d->total <= 1500)) {						
			$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$d->user."'");
			$user_mail = $user_data->email;
			$tmp = array($user_mail);
			array_push($list, $tmp);
		}
	}
} else if($cat == 'csv_1500') {

	foreach ($data AS $d) {
								
		if(($d->total > 1500) AND ($d->total <= 2500)) {						
			$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$d->user."'");
			$user_mail = $user_data->email;
			$tmp = array($user_mail);
			array_push($list, $tmp);
		}
	}
} else if($cat == 'csv_2500') {
	
	foreach ($data AS $d) {
									
		if(($d->total > 2500) AND ($d->total <= 4000)) {						
			$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$d->user."'");
			$user_mail = $user_data->email;
			$tmp = array($user_mail);
			array_push($list, $tmp);
		}
	}
} else if($cat == 'csv_4000') {

	foreach ($data AS $d) {
								
		if(($d->total > 4000) AND ($d->total <= 6500)) {						
			$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$d->user."'");
			$user_mail = $user_data->email;
			$tmp = array($user_mail);
			array_push($list, $tmp);
		}
	}
} else if($cat == 'csv_6500') {

	foreach ($data AS $d) {
								
		if($d->total > 6500) {						
			$user_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$d->user."'");
			$user_mail = $user_data->email;
			$tmp = array($user_mail);
			array_push($list, $tmp);
		}
	}
}


header( 'Content-Type: text/csv' );
header( 'Content-Disposition: attachment;filename=export_'.$cat.'_'.date('Y-m-d').'.csv');
$out = fopen('php://output', 'w');

foreach ($list as $fields) {
    fputcsv($out, $fields);
}

fclose($out);

?>