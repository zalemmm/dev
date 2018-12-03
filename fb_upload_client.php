<?php
  define( 'SHORTINIT', true );
  require( '../../../wp-load.php' );
  global $wpdb;
  global $current_user;
  $prefix = $wpdb->prefix;
  $fb_tablename_order = $prefix."fbs_order";
  $fb_tablename_prods = $prefix."fbs_prods";
  $fb_tablename_comments = $prefix."fbs_comments";
  $fb_tablename_comments_new = $prefix."fbs_comments_new";
  $fb_tablename_users = $prefix."fbs_users";
  $fb_tablename_mails = $prefix."fbs_mails";
  $fb_tablename_cf = $prefix."fbs_cf";

  //========================================================== envoi de fichiers
  if(isset($_POST['prodLine'])) {
      $orderId  = $_POST['orderId'];
      $prodLine = $_POST['prodLine'];
      $nbm      = $_POST['nbm'];

      // File upload configuration
      $targetDir = (__DIR__).'/../../../uploaded/'.$orderId.'/';
      $allowTypes = array('pdf','jpg','jpeg','png','svg','eps','ai','psd');

      // si une seule maquette, effacer le fichier précédent avant d'uploader le nouveau
      if($nbm == '1') {
        foreach (glob($targetDir.'prod'.$prodLine.'-*.*') as $filename) {
            unlink($filename);
        }
      }

      // créer le dossier commande s'il n'existe pas encore
      if (!is_dir($targetDir))  mkdir($targetDir, 0777, true);

      $image_name = $_FILES['images']['name'];
      $tmp_name   = $_FILES['images']['tmp_name'];
      $size       = $_FILES['images']['size'];
      $type       = $_FILES['images']['type'];
      $error      = $_FILES['images']['error'];

      // File upload path
      $fileName = 'prod'.$prodLine.'-'.basename($_FILES['images']['name']);
      $targetFilePath = $targetDir . strtolower($fileName);

      // Check whether file type is valid
      $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
      if(in_array($fileType, $allowTypes)){
        move_uploaded_file($_FILES['images']['tmp_name'],$targetFilePath);
      }

      // si fichier uploadé, passer au nouveau statut 8 'fichier en traitement'
			/*$nowadata = date('Y-m-d H:i:s');
			$upstat = $wpdb->update($fb_tablename_order, array ( 'status' => '8', 'date_modify' => $nowadata), array ( 'unique_id' => $orderId ) );
*/
  }
?>
