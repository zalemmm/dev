<?php
  session_start();
  define( 'SHORTINIT', true );
  require( '../../../wp-load.php' );
  global $wpdb;
  $prefix = $wpdb->prefix;
  $fb_tablename_order = $prefix."fbs_order";
  $fb_tablename_prods = $prefix."fbs_prods";
  $fb_tablename_comments = $prefix."fbs_comments";
  $fb_tablename_comments_new = $prefix."fbs_comments_new";
  $fb_tablename_users = $prefix."fbs_users";
  $fb_tablename_mails = $prefix."fbs_mails";
  $fb_tablename_cf = $prefix."fbs_cf";
  //$site_url = $_SERVER['HTTP_REFERER'].'/wordpress';
  $site_url = 'https://dev.france-banderole.com';
  //$site_url = 'https://www.france-banderole.com';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reçu paiement</title>
  <base target="_parent">
  <style type="text/css" media="screen">@import url( <?php echo $site_url ?>/wp-content/themes/fb/css/style.css?v=2.92 );</style>
  <script>
    function printContent(el){
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
      console.log('print');
    }
  </script>
</head>
<body id="#body">
<div id="top">
  <?php
    $data = $_POST['Data'];
    $seal = $_POST['Seal'];
    //$encode = $_POST['Encode'];
    //$interfaceVersion = $_POST['InterfaceVersion'];

    $dat = preg_split('/(\||=)/', $data,-1, PREG_SPLIT_NO_EMPTY); // split received data
    echo '<pre>'; echo print_r($dat); echo '</pre>';

    $merchantId           = $dat[7];
    $responseCode         = $dat[11]; // 00 = paiement accepté / 05 = refusé / 34 = fraude / 75 = nb max tentatives /
                                      // 90 = service temp indisponible / 97 = delai expiré / 99 = pb temp serveur scillius
    $acquirerReponseCode  = $dat[19];
    $guaranteeIndicator   = $dat[25];
    $transactionDateTime  = $dat[13];
    $transactionReference = $dat[15];
    $amount               = $dat[21];
    $authorisationId      = $dat[23];
    $card                 = $dat[41];
    $orderId              = $dat[43];
    $userMail             = $dat[35];
    $montant = substr_replace($amount,',',-2,0);

    //------------------------------------------------------vérification signature

    // Tout d’abord vous devez vérifier la sécurité du message retourné en recalculant le Seal selon la même méthode que celle utilisée pour la requête. Ensuite, comparez le champ Seal calculé avec celui de la réponse Scellius.

    //$key = '002001000000002_KEY1';                      // clé test
    $key = 'IR8-7bNnndylXdh9iybVvndxUkbPcFpBA8Cflwsci4w'; // clé prod
    $sign = hash_hmac('sha256', $data, $key);

    // Si les Seal sont identiques, vous poursuivez en traitant la réponse de paiement contenue dans le champ Data.
    if ($sign == $seal) {
      //echo 'le seal correspond <br/>';

      if ($responseCode == '00') { // si le paiement est validé, passer au status payé

        echo '
        <div class="box_info"><h2><i class="fa fa-check"></i> Paiement validé, merci pour votre commande !</h2>
        <span>Suivez son statut, envoyez vos fichiers ou créez votre maquette depuis votre accès client:</span>
        <a class="btnRet" href="'.$site_url.'/vos-devis/?detail='.$orderId.'">Retour à votre commande</a> </div>

        <h2 class="recTitle">Votre Reçu : <button class="printr" onclick="printContent(\'receipt\')"><i class="fa fa-print"></i> Imprimer</button></h2>
        <div id="receipt">
          <p><span class="rtt">Reçu paiement CB @france-banderole.com :</span></p>
          <p><span class="rlabel">Date de transaction : </span><span class="rdata">'.$transactionDateTime.'</span></p>
          <p><span class="rlabel">Montant : </span><span class="rdata">'.$montant.' €</span></p>
          <p><span class="rlabel">Numéro de carte : </span><span class="rdata">'.$card.'</span></p>
          <p><span class="rlabel">Référence de transaction : </span><span class="rdata">'.$transactionReference.'</span></p>
          <p><span class="rlabel">Numéro de commande : </span><span class="rdata">'.$orderId.'</span></p>
          <p><span class="rlabel">Identifiant du commerçant : </span><span class="rdata">'.$merchantId.'</span></p>
          <p><span class="rlabel">Numéro d’autorisation :  </span><span class="rdata">'.$authorisationId.'</span></p>
          <p class="rmail">Ce reçu vous a été envoyé par mail à '.$userMail.'</p>
        </div>';
        $setorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$orderId'");

        if ($setorder->status < '2' || $setorder->status == '7') {
          // si status attente/attente paiment ou paiement en traitement - passer au statut 2 payé
          $apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='2' WHERE unique_id='$orderId'");
          // enregistrement de la date de paiement
          $adpd = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '$orderId', 'paydate', '$transactionDateTime')");
        }

      } else if ($responseCode == '90' || $responseCode == '97' || $responseCode == '99') { // si erreur serveur banque
        echo '
        <div class="box_warning"><span><i class="fa fa-warning"></i> Le service de paiement de la Banque Postale est momentanément indisponible ou a rencontré une erreur. Votre carte n\'a pas été débitée. Veuillez renouveler l\'opération.</span> <a class="btnRet" href="'.$site_url.'/vos-devis/?detail='.$orderId.'">Retour à votre commande</a> </div>';

      } else { // autres cas: carte qui passe pas, erreur de saisie...
        echo '
        <div class="box_warning"><h2><i class="fa fa-warning"></i> Le paiement a été refusé par votre établissement bancaire</h2>
        <span>Les informations saisies ne sont peut-être pas correctes, veuillez réessayer ou choisir un autre moyen de paiement.</span>
        <a class="btnRet" href="'.$site_url.'/vos-devis/?detail='.$orderId.'">Retour à votre commande</a> </div>';
      }

    //Dans le cas contraire (seal != $sign), vous devez stopper le traitement, vérifier la clé secrète et/ou l’algorithme utilisés et si besoin contacter le support technique.
    } else {
      echo '
      <div class="box_warning"><h2><i class="fa fa-warning"></i> Le paiement n\'a pas fonctionné !</h2>
      <span>Les informations saisies ne sont peut-être pas correctes, veuillez réessayer ou choisir un autre moyen de paiement.</span>
      <a class="btnRet" href="'.$site_url.'/vos-devis/?detail='.$orderId.'">Retour à votre commande</a> </div>';
    }

  ?>
</div>

</body>
</html>
