<?php
// user reports doublon avec juste selection par ventes ////////////////////////

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
		//echo '<table class="widefat widecenter"><tr><th></th><th>N° DE COMMANDE</th><th>DESCRIPTION</th><th>DATE</th><th>CLIENT</th><th>FRAIS</th><th>TOTAL HT</th><th>TVA</th><th>TOTAL TTC</th><th>ETAT</th><th class="noprint">PRINT</th></tr>';
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


			echo '</td><td>'.$o->datamodyfikacji.'</td><td>'.$client->f_name.'<br />'.$client->f_comp.'</td><td>'.$o->frais.' &euro;</td><td>'.$o->totalht.' &euro;</td><td>'.$o->tva.' &euro;</td><td>'.$o->totalttc.' &euro;</td><td'.$stylstatusu.'>'.print_status($o->status).'</td><td class="noprint"><a href="'.get_bloginfo('url').'/wp-admin/admin.php?page=fbsh&fbinvoiceprint='.$o->unique_id.'" target="_blank"><img src="'.$imagespath.'but_p_fac.png" alt="" /></a></td></tr>';
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
?>
