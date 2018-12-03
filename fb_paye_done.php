<?php
  session_start();
  require( '../../../wp-load.php' );
  define( 'SHORTINIT', true );

  global $wpdb;
  $prefix = $wpdb->prefix;
  $fb_tablename_order = $prefix."fbs_order";
  $fb_tablename_prods = $prefix."fbs_prods";
  $fb_tablename_comments = $prefix."fbs_comments";
  $fb_tablename_comments_new = $prefix."fbs_comments_new";
  $fb_tablename_users = $prefix."fbs_users";
  $fb_tablename_mails = $prefix."fbs_mails";
  $fb_tablename_cf = $prefix."fbs_cf";
  $site_url = get_bloginfo('url');
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

    // création d'un tableau de correspondance des données renvoyées par la banque
    preg_match_all("/([^|= ]+)=([^|= ]+)/", $data, $r);
    $dat = array_combine($r[1], $r[2]);
    // debug :
    //echo $data;
    //echo '<pre>'; echo print_r($dat); echo '</pre>';

    // données renvoyées
    $merchantId           = $dat['merchantId'];
    $responseCode         = $dat['responseCode']; // 00 = paiement accepté / 05 = refusé / 34 = fraude / 75 = nb max tentatives /
                                                  // 90 = service temp indisponible / 97 = delai expiré / 99 = pb temp serveur scillius
    $acquirerReponseCode  = $dat['acquirerResponseCode'];
    $guaranteeIndicator   = $dat['guaranteeIndicator '];
    $transactionDateTime  = $dat['transactionDateTime'];
    $transactionReference = $dat['transactionReference'];
    $amount               = $dat['amount'];
    $authorisationId      = $dat['authorisationId'];
    $card                 = $dat['maskedPan'];
    $customerEmail        = $dat['customerEmail'];

    $montant              = substr_replace($amount,',',-2,0);
    $date                 = date_create($transactionDateTime);
    $paydate              = date_format($date,"d/m/Y H:i:s");

    // données session
    $orderId              = $_SESSION['fbcmd'];
    $userMail             = $_SESSION['fbmail'];
    $paiement             = $_SESSION['fbcartsum'];

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
          <p><span class="rlabel">Date de transaction : </span><span class="rdata">'.$paydate.'</span></p>
          <p><span class="rlabel">Montant : </span><span class="rdata">'.$paiement.' €</span></p>
          <p><span class="rlabel">Numéro de carte : </span><span class="rdata">'.$card.'</span></p>
          <p><span class="rlabel">Référence de transaction : </span><span class="rdata">'.$transactionReference.'</span></p>
          <p><span class="rlabel">Numéro de commande : </span><span class="rdata">'.$orderId.'</span></p>
          <p><span class="rlabel">Identifiant du commerçant : </span><span class="rdata">218000016820001</span></p>
          <p><span class="rlabel">Numéro d’autorisation :  </span><span class="rdata">'.$authorisationId.'</span></p>
          <p class="rmail">Ce reçu vous a été envoyé par mail à '.$customerEmail.'</p>
        </div>';

        $setorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$orderId'");

        if ($setorder->status < '2' || $setorder->status > '6') {
          // si status attente/attente paiment ou paiement en traitement - passer au statut 2 payé
          $apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='2' WHERE unique_id='$orderId'");
          // enregistrement de la date de paiement
          $adpd = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '$orderId', 'paydate', '$transactionDateTime')");
        }

        $letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour,<br /><br />Votre paiement par carte bancaire pour France Banderole a bien été enregistré. Voici votre reçu :<br /><br />
        <div id="receipt">
          Date de transaction : '.$paydate.'<br />
          Montant : '.$paiement.' €<br />
          Numéro de carte : '.$card.'<br />
          Référence de transaction : '.$transactionReference.'<br />
          Numéro de commande : '.$orderId.'<br />
          Identifiant du commerçant : 218000016820001 <br />
          Numéro d’autorisation : '.$authorisationId.'<br />
        </div>
        <br />Amicalement,<br />L’équipe FRANCE BANDEROLE</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
				$header = 'From: France Banderole <information@france-banderole.com>';
  			$header .= "\nContent-type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
        wp_mail($customerEmail, 'Reçu paiement pour France Banderole', stripslashes($letter),$header);

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
