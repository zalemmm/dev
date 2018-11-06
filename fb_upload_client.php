<?php
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
  }
?>
