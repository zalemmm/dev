$numero_commande = $wpdb->get_row("SELECT tnt FROM `$fb_tablename_order` WHERE unique_id = '$number'");
