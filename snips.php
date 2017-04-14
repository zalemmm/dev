$numero_commande = $wpdb->get_row("SELECT tnt FROM `$fb_tablename_order` WHERE unique_id = '$number'");

<?php
  $dirname = "cards/";
  $images = glob($dirname."*.png");
  foreach($images as $image) {
  echo '<img src="'.$image.'" />';
  }
?>
