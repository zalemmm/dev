<?php
global $wpdb;
$prefix = $wpdb->prefix;
$fb_tablename_order = $prefix."fbs_order";
$fb_tablename_prods = $prefix."fbs_prods";
$fb_tablename_comments = $prefix."fbs_comments";
$fb_tablename_comments_new = $prefix."fbs_comments_new";
$fb_tablename_users = $prefix."fbs_users";
$fb_tablename_mails = $prefix."fbs_mails";
$fb_tablename_cf = $prefix."fbs_cf";

//////////////////////////////////////////////////////// Si paiement effectué //
if (isset($_GET['paid'])) {
	$logfile="/home/frbanderolecom/www/sherlock/log/logfile.log";
	// Ouverture du fichier de log en append
	$fp=fopen($logfile, "a");
	fwrite( $fp, "test_point_1: true\n");
	fwrite( $fp, "session_order_id: ".$_SESSION['fbcmd']."\n");
	fwrite( $fp, "-------------------------------------------\n");
	fclose ($fp);
}

if (isset($_GET['paid']) && isset($_POST[DATA])) {
	// RÈcupÈration de la variable cryptÈe DATA
	$message="message=".$_POST[DATA];

	// Initialisation du chemin du fichier de log (‡ modifier)
  //   ex :
  //    -> Windows : $logfile="c:\\repertoire\\log\\logfile.txt";
  //    -> Unix    : $logfile="/home/repertoire/log/logfile.txt";
  //
	$logfile="/home/frbanderolecom/www/sherlock/log/logfile.log";
	// Ouverture du fichier de log en append
	$fp=fopen($logfile, "a");
	fwrite( $fp, "test_point_1: true\n");

	// Initialisation du chemin du fichier pathfile (‡ modifier)
  //   ex :
  //    -> Windows : $pathfile="pathfile=c:\\repertoire\\pathfile"
  //    -> Unix    : $pathfile="pathfile=/home/repertoire/pathfile"

	$pathfile="pathfile=/home/frbanderolecom/www/sherlock/param/pathfile";
	fwrite( $fp, "test_point_2: true\n");

	//Initialisation du chemin de l'executable response (‡ modifier)
	//ex :
	//-> Windows : $path_bin = "c:\\repertoire\\bin\\response"
	//-> Unix    : $path_bin = "/home/repertoire/bin/response"
	//

	$path_bin = "/home/frbanderolecom/www/sherlock/bin/response";
	fwrite( $fp, "test_point_3: true\n");

	// Appel du binaire response
	$result=exec("$path_bin $pathfile $message");
	fwrite( $fp, "test_point_4: true\n");

	//	Sortie de la fonction : !code!error!v1!v2!v3!...!v29
	//		- code=0	: la fonction retourne les donnÈes de la transaction dans les variables v1, v2, ...
	//				: Ces variables sont dÈcrites dans le GUIDE DU PROGRAMMEUR
	//		- code=-1 	: La fonction retourne un message d'erreur dans la variable error

	//	on separe les differents champs et on les met dans une variable tableau
	$tableau = explode ("!", $result);
	fwrite( $fp, "test_point_5: true\n");

	$code = $tableau[1];
	$error = $tableau[2];
	$merchant_id = $tableau[3];
	$merchant_country = $tableau[4];
	$amount = $tableau[5];
	$transaction_id = $tableau[6];
	$payment_means = $tableau[7];
	$transmission_date= $tableau[8];
	$payment_time = $tableau[9];
	$payment_date = $tableau[10];
	$response_code = $tableau[11];
	$payment_certificate = $tableau[12];
	$authorisation_id = $tableau[13];
	$currency_code = $tableau[14];
	$card_number = $tableau[15];
	$cvv_flag = $tableau[16];
	$cvv_response_code = $tableau[17];
	$bank_response_code = $tableau[18];
	$complementary_code = $tableau[19];
	$complementary_info= $tableau[20];
	$return_context = $tableau[21];
	$caddie = $tableau[22];
	$receipt_complement = $tableau[23];
	$merchant_language = $tableau[24];
	$language = $tableau[25];
	$customer_id = $tableau[26];
	$order_id = $tableau[27];
	$customer_email = $tableau[28];
	$customer_ip_address = $tableau[29];
	$capture_day = $tableau[30];
	$capture_mode = $tableau[31];
	$data = $tableau[32];

	//  analyse du code retour
	if (( $code == "" ) && ( $error == "" )) {
	  fwrite($fp, "erreur appel response\n");
  	echo "executable response non trouve $path_bin\n";
		fwrite( $fp, "test_order_id: $order_id\n");
		fwrite( $fp, "session_order_id: ".$_SESSION['fbcmd']."\n");
 	} elseif ( $code != 0 ) {  //	Erreur, sauvegarde le message d'erreur
    fwrite($fp, " API call error.\n");
    fwrite($fp, "Error message :  $error\n");
		fwrite( $fp, "test_order_id: $order_id\n");
		fwrite( $fp, "session_order_id: ".$_SESSION['fbcmd']."\n");
 	} else {
		// OK, Sauvegarde des champs de la réponse
		fwrite( $fp, "test_order_id: $order_id\n");
		fwrite( $fp, "session_order_id: ".$_SESSION['fbcmd']."\n");
		fwrite( $fp, "merchant_id : $merchant_id\n");
		fwrite( $fp, "merchant_country : $merchant_country\n");
		fwrite( $fp, "amount : $amount\n");
		fwrite( $fp, "transaction_id : $transaction_id\n");
		fwrite( $fp, "transmission_date: $transmission_date\n");
		fwrite( $fp, "payment_means: $payment_means\n");
		fwrite( $fp, "payment_time : $payment_time\n");
		fwrite( $fp, "payment_date : $payment_date\n");
		fwrite( $fp, "response_code : $response_code\n");
		fwrite( $fp, "payment_certificate : $payment_certificate\n");
		fwrite( $fp, "authorisation_id : $authorisation_id\n");
		fwrite( $fp, "currency_code : $currency_code\n");
		fwrite( $fp, "card_number : $card_number\n");
		fwrite( $fp, "cvv_flag: $cvv_flag\n");
		fwrite( $fp, "cvv_response_code: $cvv_response_code\n");
		fwrite( $fp, "bank_response_code: $bank_response_code\n");
		fwrite( $fp, "complementary_code: $complementary_code\n");
		fwrite( $fp, "complementary_info: $complementary_info\n");
		fwrite( $fp, "return_context: $return_context\n");
		fwrite( $fp, "caddie : $caddie\n");
		fwrite( $fp, "receipt_complement: $receipt_complement\n");
		fwrite( $fp, "merchant_language: $merchant_language\n");
		fwrite( $fp, "language: $language\n");
		fwrite( $fp, "customer_id: $customer_id\n");
		fwrite( $fp, "order_id: $order_id\n");
		fwrite( $fp, "customer_email: $customer_email\n");
		fwrite( $fp, "customer_ip_address: $customer_ip_address\n");
		fwrite( $fp, "capture_day: $capture_day\n");
		fwrite( $fp, "capture_mode: $capture_mode\n");
		fwrite( $fp, "data: $data\n");
		if($bank_response_code=='00') {

			$setorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$order_id'");
			// si status attente/attente paiment ou paiement en traitement - passer au statut 2 payé
			if ($setorder->status < '2' || $setorder->status == '7') {
				$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='2' WHERE unique_id='$order_id'");
				$paydate = $payment_date.' '.$payment_time;
				//---------------------------------enregistrement de la date de paiement
				$adpd = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '$order_id', 'paydate', '$paydate')");

				if (!$apdejt) {
					echo 'Erreur appel response. Contactez l\'administrateur.';
				}
			}
		}
	}
	fwrite( $fp, "-------------------------------------------\n");
	fclose ($fp);
}

// ======================================================= vérifier présence BAT
function has_bat($cmd) {
	$name=$_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$cmd.'-projects';
	$has_bat=0;
	if(file_exists($name))
	if ($dir = @opendir($name)) {
	$x=0;

	    while(($file = readdir($dir))) {
			if(!is_dir($file) && !in_array($file, array(".",".."))) {
				if ($x<1) {
					$has_bat = 1;
					$x=1;
				}
			}
    	}
	    closedir($dir);
  	}
	return $has_bat;
}

//========================================================== vérifier BAT validé
function is_bat_validated($cmd) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_comments = $prefix."fbs_comments";

	$req_bat = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments` WHERE order_id = '$cmd' AND topic = 'VALIDATION BAT CLIENT'");
	if($req_bat) {
		return 1;
	} else {
		return 0;
	}
}

//=================================================== vérifier fichiers uploadés
function has_uploaded_files($cmd, $userid) {
	$name=$_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$cmd;
	$fichiers="";
	if(file_exists($name))
	if ($dir = @opendir($name)) {
		// ajout vérification extention pour ignorer le csv
		// ajout dans la boucle de la dernière condition  && !in_array(pathinfo($file, PATHINFO_EXTENSION), $excludeExtensions)
		$excludeExtensions = array(
		    'csv',
				'json'
		);

	  while(($file = readdir($dir))) {
			if(!is_dir($file) && !in_array($file, array(".","..")) && !in_array(pathinfo($file, PATHINFO_EXTENSION), $excludeExtensions)) {
				$fichiers.=$file.'<br />';
			}
    }
	    closedir($dir);
  }
	return $fichiers;
}

////////////////////////////////////////////////////////////////////////////////
//                           module upload de fichiers
////////////////////////////////////////////////////////////////////////////////

function get_filesender($products) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_cf = $prefix."fbs_cf";

	$idzamowienia = $_GET['detail'];
	$user = $_SESSION['loggeduser'];
	$b = has_uploaded_files($idzamowienia, $user->login);

	$maq = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='maquette' AND unique_id = '$idzamowienia'");

	if(($status == 0) OR ($status == 1)) {
		$to_pay = 1;
		$need_act = 1;
	}

	//--------------------------------------------------- warnings retour commande

	$upload = 0;
	if((!(has_uploaded_files($idzamowienia,$user->id))) AND ($status != 4) AND ($status != 5) AND ($status != 6)) {
		$upload = 1;
		$need_act = 1;
	}

	if($need_act == 0 || $maq) {
		$ftip = '';
	} else {

		if($upload == 1) {
			$ftip = '<div class="otip ftip noprint"><i class="fa fa-exclamation-triangle exclam" aria-hidden="true"></i><span class="alertText">Vous n\'avez pas <strong>mis vos<br /> fichiers en ligne</strong>.</span><span class="closeTip"><i class="ion-ios-close-empty" aria-hidden="true"></i></span></div>';
		}
	}
	//if ($user->login == 'schizoos' || $user->login == 'pocalypse') {
	//	if ($b=="") { $fiText = '<tr class="noFilesTr"><td class="lefttd_none"></td><td colspan="5">Transferer des fichiers! Vous pouvez faire glisser-déposer ici.</td></tr>'; } else { $fiText = ''; }
	$view .= '<div id="dropZone" class="fade noprint"><div class="dropin">Déposez vos fichiers ici ou cliquez sur sélectionner</div></div>
	<form id="fileupload" class="noprint" action="'.get_bloginfo("url").'/uploaded/" method="post" enctype="multipart/form-data"><input type="hidden" id="cmdID" name="cmd" value="'.$idzamowienia.'" /><input type="hidden" name="usr" value="'.$user->login.'" />

		<div class="acces_tab_name2">Envoyer vos fichiers</div>
    <div class="fileupload-buttonbar">
      <div class="span7">
        <input type="checkbox" class="toggle" />

        <span class="btn btn-success fileinput-button fuselect">
            <span><i class="fa fa-plus" aria-hidden="true"></i> <span class="disno960">sélectionner</span></span>
            <input type="file" name="files[]" multiple />'.$ftip.'
        </span>
        <button type="submit" class="btn btn-primary start fustart">
            <span><i class="fa fa-upload" aria-hidden="true"></i> <span class="disno960">Envoyer</span></span>
        </button>
        <button type="reset" class="btn btn-warning cancel fucancel">
            <span><i class="fa fa-times-circle" aria-hidden="true"></i> <span class="disno960">Annuler</span></span>
        </button>
        <button type="button" class="btn btn-danger delete fudelete">
            <span><i class="fa fa-trash-o" aria-hidden="true"></i> <span class="disno960">Effacer</span></span>
        </button>

      </div>
      <div class="span5 fileupload-progress fade">
        <div class="progress progress-success progress-striped active" aria-valuemin="0" aria-valuemax="100">
            <div class="bar" style="width:0%;"></div>
        </div>
        <div class="progress-extended">&nbsp;</div>
      </div>
    </div>
    <br />
    <table id="fbcart_fileupload3" class="table table-striped" cellpadding="0" cellspacing="0">
		<thead><tr><th class="lefttd"></th><th class="tabname">FICHIER</th><th class="tabsize">TAILLE</th><th class="tabprog">progrès</th><th class="tabstart">action</th><th class="tabdel"></th></tr></thead>
    <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
	</form>
	';

	$view .= '
	<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-upload fade">
	        <td class="lefttd"></td>
	        <td class="name tabname"><span>{%=file.name%}</span></td>
	        <td class="size tabsize"><span>{%=o.formatFileSize(file.size)%}</span></td>
	        {% if (file.error) { %}
	            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
	        {% } else if (o.files.valid && !i) { %}
	            <td class="tdprog"><div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div></td>
	            <td class="tdstart">{% if (!o.options.autoUpload) { %}
	                <button class="btn btn-primary start fustart">
	                    <span><i class="fa fa-upload" aria-hidden="true"></i> Envoyer</span>
	                </button>
	            {% } %}</td>
	        {% } else { %}
	            <td colspan="2"></td>
	        {% } %}
	        <td class="tabdel">{% if (!i) { %}
	            <button class="btn btn-warning cancel delbut">
	                <span>Cancel</span>
	            </button>
	        {% } %}</td>
	    </tr>
	{% } %}
	</script>
	<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-download fade">
	        {% if (file.error) { %}
	            <td class="lefttd"><input type="checkbox" name="delete" value="1" class="toggle" /></td>
	            <td class="name tabname"><span>{%=file.name%}</span></td>
	            <td class="size tabsize"><span>{%=o.formatFileSize(file.size)%}</span></td>
	            <td class="error" colspan="2"><span class="label label-important">Erreur</span> {%=file.error%}</td>
	        {% } else { %}
	            <td class="lefttd"><input type="checkbox" name="delete" value="1" class="toggle" /></td>
	            <td class="name tabname"><span>{%=file.name%}</span></td>
	            <td class="size tabsize"><span>{%=o.formatFileSize(file.size)%}</span></td>
	            <td></td>
	            <td class="tabwykrzyknik"></td>
	        {% } %}
	        <td class="tabdel">
	            <button class="btn btn-danger delete delbut" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields=\'{"withCredentials":true}\'{% } %}>
	                <span>Delete</span>
	            </button>
	        </td>
	    </tr>
	{% } %}
	</script>
	';
	$view .= '
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/vendor/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/tmpl.min.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/load-image.min.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/canvas-to-blob.min.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery.image-gallery.min.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery.fileupload-fp.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery.fileupload-ui.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/jquery.fileupload-jui.js"></script>
	<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/main.js?v3"></script>
	<!--[if gte IE 8]><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/juploader/js/cors/jquery.xdr-transport.js"></script><![endif]-->
	';

	return $view;
}

////////////////////////////////////////////////////////////////////////////////
// 											Afficher les détails de la commande
////////////////////////////////////////////////////////////////////////////////

function get_details() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_users_cr = $prefix."fbs_users_cr";
	$fb_tablename_users_co = $prefix."fbs_users_co";
	$fb_tablename_rating = $prefix."fbs_rating";
	$user = $_SESSION['loggeduser'];
	$uid = $_SESSION['loggeduser']->id;
	$idzamowienia = $_GET['detail'];

	$zamowienie = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	if (($zamowienie->status) < 2) {
		$writable = true;
		$statuszamowienia = $zamowienie->status;
	} else {
		$writable = false;
		$statuszamowienia = $zamowienie->status;
	}
	if ($writable && isset($_POST['delfromvotre'])) {
		$idusuwanego = $_POST['delfromvotre'];
		$usuwany = $wpdb->query("UPDATE `$fb_tablename_prods` SET status='0' WHERE id='$idusuwanego'");
		if ($usuwany) {
			$sprawdzpozostale = reorganize_votre($idzamowienia);
		}
	}
	$zamowienie = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
	$status = $zamowienie->status;

	$need_act = 0;
	$bat = 0;
	$to_pay = 0;
	$upload = 0;

	if((has_bat($idzamowienia)) AND (!(is_bat_validated($idzamowienia))) AND ($status != 4) AND ($status != 5) AND ($status != 6)) {
		$bat = 1;
		$need_act = 1;
	}
	if((!(has_uploaded_files($idzamowienia,$user->id))) AND ($status != 4) AND ($status != 5) AND ($status != 6)) {
		$upload = 1;
		$need_act = 1;
	}

	if(($status == 0) OR ($status == 1)) {
		$to_pay = 1;
		$need_act = 1;
	}

	//--------------------------------------------------- warnings retour commande
	if($need_act == 0) {
		$ptip = ''; $btip = '';
		//$prolog .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><p>Cette commande n\'attend pas de retours de votre part.</p></td></tr></table></div>';
	} else {

		if($to_pay == 1) {
			$ptip = '<div class="otip ptip noprint"><i class="fa fa-exclamation-triangle exclam" aria-hidden="true"></i><span class="alertText">Vous n\'avez pas <strong>réglé cette commande</strong>.</span><span class="closeTip"><i class="ion-ios-close-empty" aria-hidden="true"></i></span></div>';
		}

		if($bat == 1) {
			$btip = '<div class="otip btip noprint"><i class="fa fa-exclamation-triangle exclam" aria-hidden="true"></i><span class="alertText">Vous n\'avez pas <strong>validé votre BAT</strong>.</span><span class="closeTip"><i class="ion-ios-close-empty" aria-hidden="true"></i></span></div>';
		}

	}

	/*$prolog .= '<h1 class="noprint"><i class="fa fa-lock" aria-hidden="true"></i> Accès client: Devis detail (Nº '.$idzamowienia.')</h1><hr class="noprint" />';*/
	$prolog .= '
	<div class="acces_tab_name_devis noprint">MON DEVIS <span class="disno480">Nº '.$idzamowienia.'</span><span class="etat">'.print_status($zamowienie->status).'</span></div>';
	$prolog .= '<div id="expop" class="devisPop mfp-hide">
	'.export_devis_details($products, $prolog, $epilog, $writable, $statuszamowienia).'
	<button onclick="print(\'#expop\');" id="print" class="noprint" title="imprimer"><i class="fa fa-print"></i></button></div>';

	// récuprère le dernier commentaire de france banderole
	// $lastcomment = $wpdb->get_row("SELECT c.*, DATE_FORMAT(c.date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` as c, `$fb_tablename_order` as o WHERE c.order_id = '$idzamowienia' AND o.user = '$user->id' AND c.author='France Banderole' ORDER BY c.date DESC LIMIT 1");

	//------------------------------------------- récupérer le dernier commentaire

	$lastcomment = $wpdb->get_row("SELECT c.*, DATE_FORMAT(c.date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` as c, `$fb_tablename_order` as o WHERE c.order_id = '$idzamowienia' AND o.user = '$user->id' ORDER BY c.date DESC LIMIT 1");

	// si maquette enregistrée, envoi et affichage du message de confirmation ////
	$data = date('Y-m-d H:i:s');
	$tresc = "Bonjour,\r\n\r\nNous avons bien réceptionné votre maquette. Elle sera vérifiée dans les 4 heures maximum (horaires d’ouvertures, hors WE & jours fériés) par notre service infographie. Vous serez avertis par mail d’un changement de statut par rapport à votre commande.\r\nAmicalement,\r\nL'équipe France banderole.\r\n https://www.france-banderole.com";
	$tresc = addslashes($tresc);

	$exist = $wpdb->get_row("SELECT * FROM ".$fb_tablename_comments." WHERE order_id='".$idzamowienia."' && topic='Fichier(s)'");
	if ((!$exist) && (has_uploaded_files($idzamowienia,$user->id))) {
			$dodawanie = $wpdb->query("INSERT INTO ".$fb_tablename_comments." VALUES (not null, '".$idzamowienia."', 'Fichier(s)', '".$data."', 'France Banderole', '".$tresc."')");
			$epilog = '';
			$lastcomment = $wpdb->get_row("SELECT c.*, DATE_FORMAT(c.date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` as c WHERE c.order_id = '$idzamowienia' ORDER BY c.date DESC LIMIT 1");

			$sprawdzcf = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='lastupdate' AND unique_id = '$idzamowienia'");
			if ($sprawdzcf) {
				$apd = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='user' WHERE unique_id='".$idzamowienia."' AND type='lastupdate'");
			} else {
				$dodawanie = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$idzamowienia."', 'lastupdate', 'user')");
			}
	}

	//---------------------------------- récupérer le status manuel de la commande
	$checkitup = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	$reponse = $checkitup->status_check;
	$statusCheck = '';
	if ($reponse <= '1' ) {
		$statusCheck = '<span class="statusChecked statusAllright"><i class="fa fa-check-circle" aria-hidden="true" title="tout est OK !"></i> </span>';
	}
	if ($reponse == '2' ) {
		$statusCheck = '<span class="statusChecked statusNotgood"><i class="fa fa-exclamation-circle" aria-hidden="true" title="votre attention est requise !"></i> </span>';
	}
	if ($reponse == '3' ) {
		$statusCheck = '<span class="statusChecked statusVerybad"><i class="fa fa-exclamation-circle" aria-hidden="true" title="votre commande est bloquée !"></i> </span>';
	}

	//------------------------------------------- affichage du dernier commentaire
	if ($lastcomment) {
		if (strlen($lastcomment->content) > 250) {
			$ostcomment = substr($lastcomment->content, 0, 250).'...';
		} else {
			$ostcomment = $lastcomment->content;
		}
		$ostcomment = stripslashes($ostcomment);

		$fb = preg_match_all('/France Banderole/', $lastcomment->author, $result);
		$fb = count($result[0]);

		if ($fb >= 1) {
			$ostcomment = nl2br($ostcomment);
		}
		$idostcomment = $lastcomment->order_id;
		$linkcomment = '<a href="'.get_bloginfo("url").'/vos-devis/?comment='.$idzamowienia.'">Lire la suite...'.$statusCheck.'</a>';
		$epilog .= '<table id="fbcart_lastcomment" border="0" cellspacing="0" class="noprint"><tr><th class="leftth">DATE</th><th class="leftth2">expéditeur</th><th class="leftth3">DERNIER COMMENTAIRE</th><th></th><th></th></tr>';
		if ($fb >= 1) {
			$epilog .= '<tr><td class="lefttd">'.$lastcomment->data.'</td><td class="lefttd2">'.$lastcomment->author.'</td><td class="lefttd3">'.stripslashes($ostcomment).'</td><td class="lefttd4" colspan="2">'.$linkcomment.'</td></tr>';
		} else {
			$epilog .= '<tr><td class="lefttd">'.$lastcomment->data.'</td><td class="lefttd2a">'.$lastcomment->author.'</td><td class="lefttd3a">'.stripslashes($ostcomment).'</td><td class="lefttd4" colspan="2">'.$linkcomment.'</td></tr>';
		}
		$epilog .= '</table></div>';
	} else {
		$epilog .= '<div id="fbcart_lastcomment"></div>';
	}

	//============================================================= top button bar

	$epilog .= '<div id="fbcart_buttons" class="noprint">';
	//$epilog .= '<a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour</a>';

	//-------------------------------------------------- bouton écrire commentaire
  if ($status!=5 && $status!=6 ) {
		$epilog .= '<a href="'.get_bloginfo('url').'/vos-devis/?comment='.$idzamowienia.'" id="but_comment"><i class="fa fa-pencil" aria-hidden="true"></i> écrire un commentaire</a>';
	} else {
		$epilog .= '<span id="but_comment" class="deactive"><i class="fa fa-pencil" aria-hidden="true"></i> écrire un commentaire</span>';
	}

	//------------------------------------------------------------ bouton voir BAT
	$revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = '$uid'");
	if (!$revendeur) $rev = 0;
	else $rev = 1;

	if(has_bat($idzamowienia) AND is_bat_validated($idzamowienia)) {
		$epilog .= '<a data-lity href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/val_bat.php?valid=1&uid='.$idzamowienia.'&rev='.$rev.'" class="but_vumaquette"><i class="fa fa-eye" aria-hidden="true"></i> Voir BAT '.$btip.'</a>';
  }else	if(has_bat($idzamowienia) AND !is_bat_validated($idzamowienia)) {
		$epilog .= '<a data-lity href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/val_bat.php?valid=0&uid='.$idzamowienia.'&rev='.$rev.'" class="but_voiremaquette"><i class="fa fa-eye" aria-hidden="true"></i> Voir BAT '.$btip.'</a>';
  }else{
		$epilog .= '<a href="#" class="but_vumaquette deactive"><i class="fa fa-eye" aria-hidden="true"></i> Voir BAT '.$btip.'</a>';
	}

	//--------------------------------------------------- bouton payer la commande
	if ($status<2) {
		$epilog .= '<form name="paye" id="paye" action="'.get_bloginfo('url').'/paiement/" method="get"><input type="hidden" name="pay" value="'.$idzamowienia.'" /><button id="but_payer" type="submit"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Payer la commande </button>'.$ptip.'</form>';
	} else if ($status==7){
		$epilog .= '<form name="paye" id="paye" action="'.get_bloginfo('url').'/paiement/" method="get"><input type="hidden" name="pay" value="'.$idzamowienia.'" /><button id="but_payer" type="submit"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> changer méthode paiement </button>'.$ptip.'</form>';
	}else{
		$epilog .= '<div id="#paye"><button id="but_payer" class="deactive"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Payer la commande</button></div>';
	}

	//----------------------------------------------------- bouton suivre le colis
	if ($status>=4 && $status<=5 && $status!=7) {
		$ktoryshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='shipping' AND unique_id = '$idzamowienia'");
		if (($ktoryshipping) && ($ktoryshipping->value != '0')) {
			if ($ktoryshipping->value == 'tnt') {
				$epilog .= '<a href="http://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?radiochoixrecherche=BT&bonTransport='.$zamowienie->tnt.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			} else if (strtolower($ktoryshipping->value) == 'fedex') {
				$epilog .= '<a href="https://france.fedex.com/te/webapp25?&trans=tesow350&action=recherche_complete&NUM_COLIS='.$idzamowienia.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			} else if (strtolower($ktoryshipping->value) == 'dpd') {
				$epilog .= '<a href="http://e-trace.ils-consult.fr/dpd-webtrace/webtrace.aspx?sdg_landnr=250&sdg_mandnr=013&sdg_lfdnr='.$zamowienie->tnt.'&cmd=SDG_SEARCH" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			} else if ($ktoryshipping->value == 'autre') {
				$epilog .= '<a href="'.$zamowienie->tnt.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			}
			if ($ktoryshipping->value == 'ciblex') {
				$epilog .= '<a href="http://extranet.geodisciblex.com/extranet/client/corps.php?module=colis&colis='.$zamowienie->tnt.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			}
		}
	//------------------------------------------------ bouton adresse de livraison
	}else if ($status==0 || $status==1 || $status==2 || $status==7){
		$epilog .= '<a id="but_suivre" href="'.get_bloginfo("url").'/order-inscription/?goback='.$idzamowienia.'"><i class="fa fa-truck"></i> adresse de livraison</a>';
	}else{
		$epilog .= '<a id="but_suivre" class="deactive"  href="#"><i class="fa fa-truck"></i> adresse de livraison</a>';
	}

	if((($status == 1) or ($status == 2) or ($status == 7)) and ((has_bat($idzamowienia)) AND (!(is_bat_validated($idzamowienia))))) {
		//$epilog .= '<a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/val_bat.php?uid='.$idzamowienia.'" data-lity id="but_bat"><i class="fa fa-eye" aria-hidden="true"></i> Voir et valider votre BAT</a>';
		//$epilog .= '<a rel="shadowbox" href="'.get_bloginfo("url").'/valider-mon-bat?uid='.$idzamowienia.'" id="but_bat"></a>';
		//$epilog .= '<a rel="shadowbox" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/val_bat.php?uid='.$idzamowienia.'" id="but_bat"></a>';
	}

	$epilog .= '</div>'; // fin top button bar

	//========================================================== bottom button bar

	$bottombar .= '<div class="fbcart_buttons" class="noprint">';

	//-------------------------------------------------------------- bouton retour
	$bottombar .= '<a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour</a>';

	//------------------------------------------------------------- bouton annuler
	if ($status<2) {
		$bottombar .= '<form name="delfromvosdevis" id="delfromvosdevis" action="'.get_bloginfo('url').'/vos-devis/" method="post"><input type="hidden" name="annulervosdevis" value="'.$idzamowienia.'" /><button id="but_annulercommande" type="submit" class="noprint"><i class="fa fa-times-circle" aria-hidden="true"></i> Annuler la commande</button></form>';
	// status 1 attente paeiment bouton annuler
	} elseif ($status>1) {
		$bottombar .= '<span id="but_annulercommande" class="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i> Annuler la commande</span>';
	}

	$revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = '$uid'");
	$exco = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_co` WHERE uid = '$uid'");

	//------------------------------------------- bouton imprimer / exporter devis
	if ($status!=3 && $status!=4 && $status!=5) {
		if ($revendeur) {
			if ($exco->devi == 1) $bottombar .= '<a href="#expop" id="but_exporter" class="open-popup-link"><i class="fa fa-print" aria-hidden="true"></i> Exporter ce devis</a>';
			else $bottombar .= '<a href="#" id="but_exporter" class="deactive"><i class="fa fa-print" aria-hidden="true"></i> Exporter ce devis</a>';
		}
		$bottombar .= '<a href="javascript:window.print()" id="but_imprimer"><i class="fa fa-print" aria-hidden="true"></i> Imprimer ce devis</a>';

	} else {
		if ($revendeur) {
			if ($exco->devi == 1) $bottombar .= '<a href="#expop" id="but_exporter" class="open-popup-link"><i class="fa fa-print" aria-hidden="true"></i> Exporter ce devis</a>';
			else $bottombar .= '<a href="#" id="but_exporter" class="deactive"><i class="fa fa-print" aria-hidden="true"></i> Exporter ce devis</a>';
		}
	}

	//------------------------------------------------- bouton imprimer la facture
	if ($status==3 || $status==4 || $status==5) {
		$bottombar .= '<a href="javascript:window.print()" id="but_imprimerfacture"><i class="fa fa-print" aria-hidden="true"></i> Imprimer la facture</a>';
	}

	//---------------------------------------------- bouton noter france banderole
	if ($status==4 || $status==5) {
		$czyoceniony = $wpdb->get_row("SELECT * FROM `$fb_tablename_rating` WHERE unique_id = '$idzamowienia' AND exist = 'true'");
		if (!$czyoceniony) {
			$bottombar .= '<a href="'.get_bloginfo('url').'/vos-devis/?rating='.$idzamowienia.'" id="but_rating" class="noprint"><i class="fa fa-star" aria-hidden="true"></i> Noter France Banderole</a>';
		}
	} else {
		$bottombar .= '<span id="but_rating" class="deactive noprint"><i class="fa fa-star" aria-hidden="true"></i> Noter France Banderole</span>';
	}

	$bottombar .= '</div>'; // fin bottom button bar

	$view .= print_devis_details($products, $prolog, $epilog, $bottombar, $writable, $statuszamowienia);
	return $view;

}

//======================================== nouveaux calculs après modif commande

function reorganize_votre($idzamowienia) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$totalHT=0;

	$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1'", ARRAY_A);
	if ($products) {
		foreach ( $products as $products => $item ) {
			$totalItems = str_replace(',', '.', $item[total]);
			$totalHT = $totalHT + $totalItems;
			$fraisPort = $fraisPort + $item[frais];
		}
		//--------------------------------------------------------------------------
		$totalHT = $totalHT + $fraisPort;
		//----------------------------------------------------------vérifier remises
		$czyjestwtabeli = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestwtabeli) {
			if ( ($czyjestwtabeli->remis != '') && ($czyjestwtabeli->remis != '0') ) {
				$dodatkowyrabat = $czyjestwtabeli->remis;
				$dodatkowyrabat = str_replace(',', '.', $dodatkowyrabat);
				$totalHT = $totalHT + $dodatkowyrabat;
			}
		}

		//---------------------------------------vérifier s'il y a une remise client
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
		if ($exist_remise) {
			$newrabat = $exist_remise->percent / 100;
			$calculRemise = $totalHT * $newrabat;
			$totalHT = $totalHT - $calculRemise;
			$zmiana = $wpdb->update($fb_tablename_remisnew, array ( 'remisenew' => $calculRemise), array ( 'sku' => $idzamowienia ) );
		}

		//------------------------------------------------------------changement TVA
		$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$idzamowienia."-tva'");
		if ($czyjesttva) {
			if ($czyjesttva->remis == 0) {
				$calculTVA = 0;
			} elseif ($czyjesttva->remis == '') {
			  $calculTVA = $totalHT*0.200;
			} else {
				$tvapod = $czyjesttva->remis/100;
				$calculTVA = $totalHT*$tvapod;
			}
		} else {
		  	$calculTVA = $totalHT*0.200;
		}

		//--------------------------------------------------------------------------
	  $totalTTC = $totalHT+$calculTVA;
	  $totalHT = number_format($totalHT, 2);
		$fraisPort = number_format($fraisPort, 2);
		$calculTVA = number_format($calculTVA, 2);
	  $totalTTC = number_format($totalTTC, 2);
		//$nowadata = date('Y-m-d H:i:s');
		$zmiana = $wpdb->update($fb_tablename_order, array ( 'frais' => $fraisPort, 'totalht' => $totalHT, 'tva' => $calculTVA, 'promo'=>0, 'totalttc' => $totalTTC), array ( 'unique_id' => $idzamowienia ) );

	} else {
		$nowadata = date('Y-m-d H:i:s');
		$zmiana = $wpdb->update($fb_tablename_order, array ( 'status' => '6', 'date_modify' => $nowadata), array ( 'unique_id' => $idzamowienia ) );
	}
}

// fin calcul ==================================================================
//======================================================== afficher détail devis

function print_devis_details($products, $prolog, $epilog, $bottombar, $writable, $statuszamowienia) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_maquette = $prefix."fbs_maquette";

	$idzamowienia=$_GET['detail'];
	$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
	$user = $_SESSION['loggeduser'];
	$uid = $_SESSION['loggeduser']->id;
	$r = get_inscription2();

	$maq = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='maquette' AND unique_id = '$idzamowienia'");

	$mtip = '<div class="otip mtip noprint"><i class="fa fa-exclamation-triangle exclam" aria-hidden="true"></i><span class="alertText">Vous n\'avez pas <strong> finalisé votre</strong> (vos)<strong> maquette</strong>(s).</span><span class="closeTip"><i class="ion-ios-close-empty" aria-hidden="true"></i></span></div>';


	$ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8'); // détecter si on est sur internet explorer
	if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0; rv:11.0') !== false)) {
		$mtip = '<div class="otip mtip noprint"><i class="fa fa-exclamation-triangle exclam" aria-hidden="true"></i><span class="alertText">Pour créer votre maquette en ligne veuillez utiliser un <strong>navigateur récent</strong>: Chrome, Firefox ou Edge. (internet explorer n\'est pas supporté.)<span class="closeTip"><i class="ion-ios-close-empty" aria-hidden="true"></i></span></div>';
	}

	if (!$maq || has_uploaded_files($idzamowienia, $user->login)) {
		$mtip = '';
	}

	$newcomment = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments_new` WHERE order_id = '$idzamowienia'");
	if ($newcomment) {
		$wpdb->query("DELETE FROM `$fb_tablename_comments_new` WHERE value='1' AND order_id='$idzamowienia'");
	}

	// affichage du devis pour tous les status sauf traitement / expédié / clôturé

	if ($statuszamowienia != 3 && $statuszamowienia != 4 && $statuszamowienia != 5) {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$fb_tablename_order = $prefix."fbs_order";
		$fb_tablename_users = $prefix."fbs_users";
		$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
		$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
		$produkty = $products;
		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$query->user'");
		$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$us->f_address.'<br />'.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;

		$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
		$view .= $prolog;
		$view .= $epilog;
		$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2" /><div class="adresseFact"><b>CLIENT</b><br />'.$facture_add.'</div></td></tr><tr><td class="print-no">Devis Nº D - '.$idzamowienia.'</td></tr><tr><td class="text-center">DATE - '.$query->datamodyfikacji.'</td></tr></table></div>';



		if ($products) {
			$produkty = $products;

			if (($statuszamowienia < 3) OR ($statuszamowienia == 7)) {
				if (!$maq) $view .= get_filesender($produkty); // on affiche l'uploader en haut si pas de création maquette en ligne
			}

			$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th class="thqte"><th class="cartQte">Quantité</th><th>Prix  U.</th><th class="thopt">Option</th><th class="threm">Remise</th><th class="thtotal">Total'.$mtip.'</th><th></th></tr>';
			$licznik = 0;
			$totalHT = 0;

			//------------------------------------------------------------------------
			foreach ( $products as $products => $item ) {
				$licznik++;
				$ref = $item['ref'];
				$prodimg = '';
	      $reference = '';
				// --------------------------------- display img & ref only if available
	      if (!empty($item['img'])) {
	        $prodimg = '<div class="prodpic noprint"><img src="'.$item['img'].'" /></div>';
	      }
	      if (!empty($item['ref'])) {
	        $reference = '<br /><span  class="reference">réf: '.$ref.'</span>';
	      }

				$view .= '
				<tr><td class="lefttd">'.$prodimg.'<span class="name">'.$item['name'].'</span><br /><span class="therest">'.$item['description'].$reference.'</span></td><td class="tdqte"><span class="disMob0">Quantité : </span> '.$item['quantity'].'</td><td><span class="disMob0">Prix Unitaire : </span>'.$item['prix'].'</td><td class="tdopt"><span class="disMob0">Options : </span>'.$item['prix_option'].'</td><td class="tdrem"><span class="disMob0">Remise : </span>'.$item['remise'].'</td><td class="tdtotal"><span class="disMob0">Total : </span>'.$item['total'];

				// on recherche dans les descriptions produits les particularités liées à la création de maquette en ligne :

				$maquette = preg_match_all('/je crée ma maquette en ligne/', $item['description'], $resultat);
				$maquette = count($resultat[0]);

				$rectoverso = preg_match_all('/verso/', $item['description'], $resultat2);
				$rectoverso = count($resultat2[0]);

				$stand = preg_match_all('/tissu/i', $item['description'], $resultat3);
				$stand = count($resultat3[0]);

				$comptoir = preg_match_all('/Comptoir/', $item['description'], $resultat4);
				$comptoir = count($resultat4[0]);

				$valise = preg_match_all('/Valise/', $item['description'], $resultat5);
				$valise = count($resultat5[0]);

				$tente = preg_match_all('/Tente/', $item['name'], $resultatt);
				$tente = count($resultatt[0]);

				$depliant = preg_match_all('/Depliants/', $item['name'], $resultatd);
				$depliant = count($resultatd[0]);

				//--------------------------------------------------- lien configurateur
				$href = get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=0&ref='.$licznik.'&name='.$item['name'].'&desc='.$item['description'].'&hauteur='.$item['hauteur'].'&largeur='.$item['largeur'];

				// si le client a choisi créer la maquette en ligne, afficher le(s) bouton(s)

				if (($maquette >= 1) && ($statuszamowienia != 6)) {
					//------------------------------------------------------si recto verso
					if ($rectoverso >= 1 || $depliant >= 1) {
						$view .='<div class="maquetteRV">
						<a class="maquette" href="'.$href.'"><i class="ion-paintbrush" aria-hidden="true"></i> maquette recto</a><br />
						<a class="maquette" href="'.get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=1&ref='.$licznik.'&name='.$item['name'].'&desc='.$item['description'].'&hauteur='.$item['hauteur'].'&largeur='.$item['largeur'].'"><i class="ion-paintbrush" aria-hidden="true"></i> maquette verso</a></div>';

					// si c'est un stand + comptoir --------------------------------------
					}elseif (($item['name'] === 'Stand Tissu') && ($comptoir >= 1)) {
						$view .='<div class="maquetteRV">
						<a class="maquette" href="'.$href.'"><i class="ion-paintbrush" aria-hidden="true"></i> maquette stand</a><br />';
						$view .='<a class="maquette" href="'.get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=0&ref='.$licznik.'&name=Comptoir&desc='.$item['description'].'&hauteur=102&largeur=172"><i class="ion-paintbrush" aria-hidden="true"></i> comptoir</a></div>';

					// si c'est un stand + valise ----------------------------------------
					}elseif (($item['name'] === 'Stand Tissu') && ($valise >= 1)) {
						$view .='<div class="maquetteRV">
						<a class="maquette" href="'.$href.'"><i class="ion-paintbrush" aria-hidden="true"></i> maquette stand</a><br />';
						$view .='<a class="maquette" href="'.get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=0&ref='.$licznik.'&name=Valise&desc='.$item['description'].'&hauteur=90&largeur=174"><i class="ion-paintbrush" aria-hidden="true"></i> valise</a></div>';

					// si c'est un stand expobag -----------------------------------------
					}elseif ($item['name'] === 'Stand ExpoBag') {
						$view .='<div class="maquetteRV">
						<a class="maquette" href="'.get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=0&ref='.$licznik.'&name=Photocall&desc='.$item['description'].'&hauteur='.$item['hauteur'].'&largeur='.$item['largeur'].'"><i class="ion-paintbrush" aria-hidden="true"></i> Photocall</a><br />
						<a class="maquette" href="'.get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=0&ref='.$licznik.'&name=Valise&desc='.$item['description'].'&hauteur=90&largeur=174"><i class="ion-paintbrush" aria-hidden="true"></i> valise</a><br />
						<a class="maquette" href="'.get_bloginfo("template_url").'/config/index.php?number='.$idzamowienia.'&verso=0&ref='.$licznik.'&name=Rollup&desc=bestline&hauteur=200&largeur=80"><i class="ion-paintbrush" aria-hidden="true"></i> Roll-ups</a></div>';

					//---------- cas normal, affichage d'un seul bouton "créer la maquette"
					}else{
						// s'il existe une sauvegarde, afficher 'finir' au lieu de 'créer' la maquette
						$saveref = $idzamowienia.'-'.$item['name'].$item['hauteur'].'x'.$item['largeur'].'-0'.$licznik;
						$maquette = $wpdb->get_row("SELECT * FROM `$fb_tablename_maquette` WHERE item = '$saveref'");
						$from = (__DIR__).'/../../../uploaded/'.$idzamowienia.'/'.$saveref.'.json';
						if(!$maquette && !file_exists($from))
							$create = 'Créer';
						else
							$create = 'Finir';
						$view .= '<div class="maquetteRV">
						<a class="maquette" href="'.$href.'"><i class="ion-paintbrush" aria-hidden="true"></i> '.$create.' la maquette</a></div>';
					}
					$view .=' </td>';

				//-------------------------------- autrement, bouton télécharger gabarit

	      }else{
					//------cas particuliers produits meme structure / différents gabarits
					$bis = preg_match_all('/bis/', $item['description'], $resultatbis);
					$bis = count($resultatbis[0]);

					if ($bis >= 1) {
						$ref = $ref.'b';
					}

					//--------------------------------------------------------------------
					$rootpath = (__DIR__).'/gabarits/'.$ref.'.pdf'; // pour vérifier la présence des fichiers
					$gpath = get_bloginfo('url').'/wp-content/plugins/fbshop/gabarits/'.$ref.'.pdf'; // lien de téléchargement
					$lity = 'data-lity=""';

					//------------------------- cas particuliers plusieurs gabarits zippés
					if($tente >= 1 || $item['name'] === 'Stand ExpoBag') {
						$rootpath = (__DIR__).'/gabarits/'.$ref.'.zip';
						$gpath = get_bloginfo('url').'/wp-content/plugins/fbshop/gabarits/'.$ref.'.zip';
						$lity = '';
					}

					//-----------------------------affichage du bouton télécharger gabarit
					if (file_exists($rootpath)) {
						$view .= '<div class="gabaritRV">
						<a class="gabarit" title="télécharger le(s) gabarit(s)" href="'.$gpath.'" '.$lity.'><i class="fa fa-download" aria-hidden="true"></i> gabarit</a>';

						//------------------- cas particuliers avec 2 gabarits à télécharger
						if (($item['name'] === 'Stand Tissu') && ($comptoir >= 1)) {
								$view .= '<br /><a class="gabarit" title="télécharger le(s) gabarit(s)" href="'.get_bloginfo('url').'/wp-content/plugins/fbshop/gabarits/20170231.pdf" '.$lity.'><i class="fa fa-download" aria-hidden="true"></i> gabarit comptoir</a>';
						}
						if (($item['name'] === 'Stand Tissu') && ($valise >= 1)) {
								$view .= '<br /><a class="gabarit" title="télécharger le(s) gabarit(s)" href="'.get_bloginfo('url').'/wp-content/plugins/fbshop/gabarits/20170230.pdf" '.$lity.'><i class="fa fa-download" aria-hidden="true"></i> gabarit valise</a>';
						}
						$view .= '</div>';
					}
					$view .= '</td>';
	      }
				//-------------------------------------------------------- delete button
				if ($writable) {
					$view .= '<td class="noprint"><form name="delvotre_form" id="delvotre_form" action="" method="post"><input type="hidden" name="delfromvotre" value="'.$item['id'].'" /><input type="hidden" name="order_id" value="'.$item['order_id'].'" /><button id="delcart" type="submit" onclick=\'if (confirm("'.esc_js( "Etes-vous sûr de vouloir retirer ce produit de votre commande? Si vous aviez un code promotionnel, il ne sera plus appliqué. " ).'")) {return true;} return false;\'>DEL</button></form></td>';
				} else {
					$view .= '<td class="noprint"></td>';
				}
				$view .= '</tr>';
			} //-----------------------------------------------------------end foreach

			//-------------------------------------- Afficher réduction supplémentaire
			$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
			if ($czyjestrabat) {
				$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
			}
			//-------------------------------------- Afficher réduction supplémentaire
	  	$view .= '</table>';
			$kosztorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");

			$addtodevis = '';
			//-------------------------------------vérifier s'il y a une remise client
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
		  	$calculRemise = number_format($exist_remise->remisenew, 2);
				$cremisetd = '<tr><td class="toleft">REMISE générale ('.$exist_remise->percent.'%)</td><td class="toright">-'.$calculRemise.' &euro;</td></tr>';
			}
			//-----------------------------------------vérifier s'il y a un code promo
			$exist_code = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");
			if ($exist_code->promo > 1) {
				$calculCode = $exist_code->promo;
				$totalHT = $exist_code->totalht;
				$calculCode = number_format($calculCode, 2);
				$addtodevis ='<tr><td class="toleft">REMISE </td><td class="toright">-'.$calculCode.' &euro;</td></tr>';
			}
			//------------------------------------------------------------------------
		  $totalht = str_replace(',', '', $kosztorder->totalht);
			$totalht = $totalht-$calculRemise-$calculCode;
			$ttotalht = str_replace(',','', number_format($totalht, 2)).' &euro;';
			//------------------------------------------------------------------------

 	  	$tfrais = $kosztorder->frais.' &euro;';
	  	$ttva = $kosztorder->tva.' &euro;';
	  	$ttotalttc = str_replace(',', '', $kosztorder->totalttc).' &euro;';
			//------------------------------------------------------------------------

			$user = $_SESSION['loggeduser'];
			$explode = explode('|', $user->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $user->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';

			if ( ($l_name == '') && ($l_address == '') ) {
				$epilog_0 .= $user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city;

			} else {
				$epilog_0 .= $user->l_name.'<br />'.$user->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$user->l_code.'<br />'.$user->l_city;
			}

			$useraddress = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$idzamowienia'");

			if ($useraddress) {
				$explode2 = explode('|', $useraddress->l_address);
				$l_address = $explode2['0'];
				$l_porte = $explode2['1'].'<br />';
				$epilog_0 = $useraddress->l_name.'<br />'.$useraddress->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$useraddress->l_code.'<br />'.$useraddress->l_city;
			}

			// vérification code postal
			$checkPostFact  = substr($user->f_code, 0, 2);
			$checkPostLivr  = substr($useraddress->l_code, 0, 2);
			$check5digitsF  = strlen($user->f_code);
			$check5digitsL  = strlen($useraddress->l_code);

			// avertissement si code postal hors france métropolitaine
			if ($kosztorder->totalht < 1200) {  // si le montant est inférieur à 1200 ht
				// s'il n'y a pas d'adresse de livraison et que le code postal facturation ne contient pas 5 chiffres ou commence par 97 ou 98
				// ou s'il y a une adresse de livraison et que le code postal de livraison ne contient pas 5 chiffres ou commence par 97 ou 98 :
				if ( !$useraddress && ($checkPostFact == '97' || $checkPostFact == '98' || $check5digitsF !== 5) ) {

						$view .= '<a href="#alertCodepostal" class="open-popup-auto"></a>

						<div id="alertCodepostal" class="white-popup mfp-hide">
							<div class="modalContent">

								<h3>Votre code postal ne correspond pas à une adresse en france métropolitaine :</h3>

								<p>Les devis exports doivent porter sur un minimum de 1200€ HT de produits bruts hors frais de port conformement à nos C.G.V.
								Vous avez la possibilité de valider votre devis de 2 façons :</p>
								<ul>
									<li><a href="'.get_bloginfo("url").'/order-inscription/?goback='.$idzamowienia.'">en fournissant une adresse de livraison en France métropolitaine</a></li>
									<li><a href="'.get_bloginfo("url").'">en faisant un nouveau devis pour arriver à 1200€ HT de commande hors frais de port</a></li>
								</ul>
								<p>S\'il s\'agit d\'une erreur de saisie vous pouvez <a href="'.get_bloginfo("url").'/inscription/">corriger votre adresse de facturation ici</a></p>
							</div>
						</div>

						<script>
						jQuery(document).ready(function ($) {
							$("#but_payer").addClass("deactive").click(function(e) {
							  e.preventDefault();
							});
							$(".ptip .alertText").text("veuillez entrer une adresse en france métropolitaine pour valider ce devis");
							$(".open-popup-auto").magnificPopup({
								type:"inline",
								midClick: true
							});

							$(".open-popup-auto").click();
						});
						</script>';

				}
			}

			$epilog_1 .= $user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city;

			$view .= '<table id="fbcart_check" border="0" cellspacing="0">
			<tr><td class="toleft">Frais de port</td><td class="toright">'.$tfrais.'</td></tr>
			'.$addtodevis.'
			'.$cremisetd.'
			<tr><td class="toleft">Total ht</td><td class="toright">'.$ttotalht.'</td></tr>
			<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$ttva.'</td></tr>
			<tr><td class="toleft total">total ttc</td><td class="toright total">'.$ttotalttc.'</td></tr>
			</table>';

			$view .= '<table id="fbcart_address" class="noprint" border="0" cellspacing="0">
			<tr><th class="leftth =">Adresse de facturation</th><th>Adresse de livraison</th></tr>
			<tr><td class="lefttd">'.stripslashes($epilog_1).'</td><td>'.stripslashes($epilog_0).'</td></tr>
			</table>';

			$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i></div>'; // ajout devis

    	// ajout des conditions générales de ventes à l'impression du devis papier
			$revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = '$uid'");
			if (!$revendeur) {
			$cgv = file_get_contents('https://www.france-banderole.com/wp-content/plugins/fbshop/printCGV.html');
			$view .= $cgv;
			}

		} else {
			$view .= '<p style="position:relative;float:left;display:inline;width:100%;">'._FB_ANNUL.'</p>';
		}
		//	$view .= $epilog;
		//		$view .= '<div style="position:relative;float:left;display:inline;width:960px;">'.get_fb_comments().'</div>';

	//---------- affichage du devis pour les status traitement / expédié / clôturé

	} else {
		$view .= '<div class="noprint">'.$prolog.'</div>';
		$view .= '<div class="noprint">'.$epilog.'</div>';

		global $wpdb;
		$prefix = $wpdb->prefix;
		$fb_tablename_order = $prefix."fbs_order";
		$fb_tablename_users = $prefix."fbs_users";
		$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
		$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
		$produkty = $products;

		$us = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id='$query->user'");
		$facture_add = $us->f_name.'<br />'.$us->f_comp.'<br />'.$us->f_address.'<br />'.$us->f_code.'<br />'.$us->f_city.'<br />'.$us->f_phone;

		if ( ( ($us->l_address != "") && ($us->f_address != $us->l_address) ) || ( ($us->l_name != "") && ($us->f_name != $us->l_name) ) ) {
			$livraison_add = $us->l_name.'<br />'.$us->l_comp.'<br />'.$us->l_address.'<br />'.$us->l_code.'<br />'.$us->l_city.'<br />'.$us->l_phone;
		} else {
			$livraison_add = $facture_add;
		}
 		$view .= '';

		$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;" colspan="2"><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2" /><div class="adresseFact"><b>CLIENT</b><br />'.$facture_add.'</div></td></tr><tr><td class="print-no">FACTURE NºF - '.$idzamowienia.'</td></tr><tr><td class="text-center">DATE - '.$query->datamodyfikacji.'</td></tr><tr><td class="print-title">Madame, Monsieur,<br />Veuillez trouver ci-dessous votre facture concernant la commande<br />ref: '.$idzamowienia.'<br />Dans l\'attente d\'une collaboration prochaine,<br />Veuillez agrèer, Madame, Monsieur, nos solutations respectueuses.</td></tr></table></div>';

		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th class="cartQte">Quantité</th><th>Prix U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
		foreach ( $products as $products => $item ) {
			$licznik++;
			$view .= '
			<tr><td class="lefttd"><span class="name">'.$item['name'].'</span><br /><span class="therest">'.$item['description'].'</span></td><td class="tdqte"><span class="disMob0">Quantité : </span> '.$item['quantity'].'</td><td><span class="disMob0">Prix Unitaire : </span>'.$item['prix'].'</td><td class="tdopt"><span class="disMob0">Options : </span>'.$item['prix_option'].'</td><td class="tdrem"><span class="disMob0">Remise : </span>'.$item['remise'].'</td><td class="tdtotal"><span class="disMob0">Total : </span>'.$item['total'].'</td>';
			$view .= '</tr>';
			}
		// Afficher réduction supplémentaire //
		$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestrabat) {
			$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
		}
		// Afficher réduction supplémentaire //
		$view .= '</table>';

		$addtodevis = '';
		//---------------------------------------vérifier s'il y a une remise client
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
		if ($exist_remise) {
	  	$calculRemise = number_format($exist_remise->remisenew, 2);
			$cremisetd = '<tr><td class="toleft">REMISE générale ('.$exist_remise->percent.'%)</td><td class="toright">-'.$calculRemise.' &euro;</td></tr>';
		}
		//-------------------------------------------vérifier s'il y a un code promo
		$exist_code = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");
		if ($exist_code->promo > 1) {
			$calculCode = $exist_code->promo;
			$totalHT = $exist_code->totalht;
			$calculCode = number_format($calculCode, 2);
			$addtodevis ='<tr><td class="toleft">REMISE </td><td class="toright">-'.$calculCode.' &euro;</td></tr>';
		}

		//--------------------------------------------------------------------------
		$totalht = str_replace(',', '', $query->totalht);
		$totalht = $totalht-$calculRemise-$calculCode;
		$ttotalht = str_replace(',','', number_format($totalht, 2)).' &euro;';
		//--------------------------------------------------------------------------

		$tfrais = $query->frais.' &euro;';
		$ttva = $query->tva.' &euro;';
		$ttotalttc = str_replace(',', '', $query->totalttc).' &euro;';
		//--------------------------------------------------------------------------

		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
		<tr><td class="toleft">Frais de port</td><td class="toright">'.$tfrais.'</td></tr>
		'.$addtodevis.'
		'.$cremisetd.'
		<tr><td class="toleft">Total ht</td><td class="toright">'.$ttotalht.'</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$ttva.'</td></tr>
		<tr><td class="toleft total">total ttc</td><td class="toright total">'.$ttotalttc.'</td></tr>
		</table>';

		if ($query->payment == 'cheque') { $method = 'CHÉQUE'; }
		if ($query->payment == 'bancaire') { $method = 'VIREMENT BANCAIRE'; }
		if ($query->payment == 'carte') { $method = 'CARTE BLEUE'; }
		if ($query->payment == 'administratif') { $method = 'VIREMENT ADMINISTRATIF'; }
		if ($query->payment == 'espece') { $method = 'ESPÉCE'; }
		if ($query->payment == 'trente') { $method = 'PAIEMENT A 30 JOURS'; }
		if ($query->payment == 'soixante') { $method = 'PAIEMENT A 60 JOURS'; }
		$view .= '<div class="bottomfak onlyprint">FACTURE REGLÉE PAR '.$method.'<br /><br /><i>RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i></div>';

		// ajout des adresse facturation et livraison, mais sans le bouton modifier
		$user = $_SESSION['loggeduser'];
		$explode = explode('|', $user->f_address);
		$f_address = $explode['0'];
		$f_porte = $explode['1'].'<br />';
		$explode2 = explode('|', $user->l_address);
		$l_address = $explode2['0'];
		$l_porte = $explode2['1'].'<br />';

		if ( ($l_name == '') && ($l_address == '') ) {
			$epilog_0 .= $user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city;

		} else {
			$epilog_0 .= $user->l_name.'<br />'.$user->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$user->l_code.'<br />'.$user->l_city;
		}

		$useraddress = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$idzamowienia'");

		if ($useraddress) {
			$explode2 = explode('|', $useraddress->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$epilog_0 = $useraddress->l_name.'<br />'.$useraddress->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$useraddress->l_code.'<br />'.$useraddress->l_city;
		}

		$epilog_1 .= $user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city;

		$view .= '<table id="fbcart_address" class="noprint" border="0" cellspacing="0">
		<tr><th class="leftth">Adresse de facturation</th><th>Adresse de livraison</th></tr>
		<tr><td class="lefttd">'.stripslashes($epilog_1).'</td><td>'.stripslashes($epilog_0).'</td></tr>
		</table>';

		// ajout des conditions générales de ventes à l'impression de la facture papier
		$revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = '$uid'");
		if (!$revendeur) {
		$cgv = file_get_contents('https://www.france-banderole.com/wp-content/plugins/fbshop/printCGV.html');
		$view .= $cgv;
		}

	}

	if (($statuszamowienia < 3) OR ($statuszamowienia == 7)) {
		if ($maq) $view .= '<div class="clear"></div>'.get_filesender($produkty);
	}

	$view .= $bottombar;
	$view .= contact_advert();
	return $view;
}

// fin affichage détails =======================================================
//============================================= fonction export devis revendeurs

function export_devis_details($products, $prolog, $epilog, $writable, $statuszamowienia) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";
	$fb_tablename_address = $prefix."fbs_address";
	$idzamowienia=$_GET['detail'];
	$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");

	//$r = get_inscription2();

	$view .= '<div class="modalDevis" id="modalDevis">';
	$view .= $epilog;

	if ($products) {

		$produkty = $products;

		$user = $_SESSION['loggeduser'];
		$explode = explode('|', $user->f_address);
		$f_address = $explode['0'];
		$f_porte = $explode['1'].'<br />';
		$explode2 = explode('|', $user->l_address);
		$l_address = $explode2['0'];
		$l_porte = $explode2['1'].'<br />';
		if ( ($l_name == '') && ($l_address == '') ) {
			$epilog_0 .= $user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city;
		} else {
			$epilog_0 .= $user->l_name.'<br />'.$user->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$user->l_code.'<br />'.$user->l_city;
		}
		$useraddress = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$idzamowienia'");
		if ($useraddress) {
			$explode2 = explode('|', $useraddress->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			$epilog_0 = $useraddress->l_name.'<br />'.$useraddress->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$useraddress->l_code.'<br />'.$useraddress->l_city;
		}
		$epilog_1 .= $user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city;

		$view .= '<table id="fbcart_address" style="width:100%" cellspacing="0">
		<tr><th class="leftth">émetteur</th><th>destinataire</th></tr>
		<tr><td class="lefttd">'.stripslashes($epilog_1).'</td><td>'.stripslashes($epilog_0).'<a id="order_inscription"  href="'.get_bloginfo("url").'/order-inscription/?goback='.$idzamowienia.'"><i class="fa fa-truck"></i> modifier destinataire</a></td></tr>
		</table>';

		$view .= '<div id="printable"><table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th class="thqte"><th class="cartQte">Quantité</th><th>Prix  U.</th><th class="thopt">Option</th><th class="thtotal">Total</th></tr>';
		$licznik = 0;
		$totalHT = 0;
		$items = 0;
		$remiseG = 0;

		// on vérifie s'il y a une remise générale et on récupère le pourcentage
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
		if ($exist_remise) {
	  	$remiseG = $exist_remise->percent/100;
		}

		foreach ( $products as $products => $item ) { // pour chaque produit
			$prixItem = $item['total']/$item['quantity']; // on récupère le prix unitaire après les remises par catégories
			$prixItem = $prixItem - ($prixItem*$remiseG); // on soustrait le % remise générale
			$prixItem = str_replace(',', '', number_format($prixItem, 2));
			$totalItem = $item['total']; // on récupère le total item
			$totalItem = $totalItem - ($totalItem*$remiseG); // on soustrait le % remise générale
			$totalItem = str_replace(',', '', number_format($totalItem, 2));
			$licznik++;
			$view .= '
			<tr class="produit"><td class="lefttd"><span class="name">'.$item['name'].'</span><br /><span class="therest">'.$item['description'].'</span></td><td class="tdqte"><span class="disMob0">Quantité : </span> <span class="qte" data-id="'.$item['quantity'].'">'.$item['quantity'].'</span></td><td><span class="disMob0">Prix Unitaire : </span><span class="prixu" data-id="'.$prixItem.'">'.$prixItem.'</span></td><td class="tdopt"><span class="disMob0">Options : </span>'.$item['prix_option'].'</td><td class="tdtotal"><span class="disMob0">Total : </span><span class="prixi">'.$totalItem.'</span></td>';
			$view .= '</tr>';
			$items += $totalItem;
		}

		$marge = 0;
		if (isset($_POST['amount'])) {
			$marge = $_POST['amount'];
		}
		$totalht = $items + ($items*$marge/100);
		$tva = $totalht*20/100;
		$ttotalttc = $totalht + $tva;

		$kosztorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");

	  $tfrais = str_replace(',', '', number_format($kosztorder->frais, 2)).' &euro;';
  	$ttotalht = str_replace(',', '', number_format($totalht, 2)).' &euro;';
  	$ttva = str_replace(',', '', number_format($tva, 2)).' &euro;';
  	$ttotalttc = str_replace(',', '', number_format($ttotalttc, 2)).' &euro;';

		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
		<tr><td class="toleft">Frais de port</td><td class="toright">'.$tfrais.'</td></tr>
		<tr><td class="toleft">Total ht</td><td class="toright" id="loadht">'.$ttotalht.'</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright" id="loadtva">'.$ttva.'</td></tr>
		<tr><td class="toleft total">total ttc</td><td class="toright total" id="loadttc">'.$ttotalttc.'</td></tr>

		</table>';

		$view .= '
		</div>

		<div style="clear:both;"></div>

		<div class="curseur noprint" id="curseurWrapper">

			<p>Ajustez votre marge :</p>
			<div id="curseur" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"></div>
			<div class="steps">
				<span class="tick">|<br>0%</span>
				<span class="tick" style="left: 10%;">|<br>10%</span>
				<span class="tick" style="left: 20%;">|<br>20%</span>
				<span class="tick" style="left: 30%;">|<br>30%</span>
				<span class="tick" style="left: 40%;">|<br>40%</span>
				<span class="tick" style="left: 50%;">|<br>50%</span>
				<span class="tick" style="left: 60%;">|<br>60%</span>
				<span class="tick" style="left: 70%;">|<br>70%</span>
				<span class="tick" style="left: 80%;">|<br>80%</span>
				<span class="tick" style="left: 90%;">|<br>90%</span>
				<span class="tick" style="left: 100%;">|<br>100%</span>
			</div>

			<form id="marge" name="ajustMarge" method="post" action="">

				<input type="text" id="amount" name="amount" /> %
				<input type="hidden" id="toutht" value="'.$ttotalht.'" />
				<button type="submit" class="btMarge" name="margeSubmit">Appliquer</button>
			</form>

			<div id="totalMarge"></div>

		</div>
		';

	} else {
		$view .= '<p style="position:relative;float:left;display:inline;width:100%;">'._FB_ANNUL.'</p>';
	}

	$view .= '</div>';
	return $view;
}

//=========================================compter nombre d'items dans le panier

function getCartCount() {
	$ret = '0';
	if(!empty($_SESSION['fbcart'])) {
		$ret = count($_SESSION['fbcart']);
	}
	return $ret;
}

////////////////////////////////////////////////////////////////////////////////
//                       affiche la liste des commandes                       //
////////////////////////////////////////////////////////////////////////////////

function print_votre() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";

  if (isset($_POST['annulervosdevis'])) {
		$ident = $_POST['annulervosdevis'];
		$anulowany = $wpdb->query("UPDATE `$fb_tablename_order` SET status='6' WHERE unique_id='$ident'");
  }
  if (isset($_GET['detail'])) {
	 	$idz = $_GET['detail'];
		$user = $_SESSION['loggeduser'];
		$userid = $user->id;
		$existing = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idz' AND user='$userid'");
		if ($existing) {
			$view .= get_details();
		} else {
			$view .= '<p>'._FB_404.'</p>';
		}
  } elseif (isset($_GET['comment'])) {
	 	$idz = $_GET['comment'];
		$user = $_SESSION['loggeduser'];
		$userid = $user->id;
		$existing = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idz' AND user='$userid'");
		if ($existing) {
		 	$view .= get_fb_comments();
		} else {
			$view .= '<p>'._FB_404.'</p>';
		}
  } elseif (isset($_GET['rating'])) {
	 	$idz = $_GET['rating'];
		$user = $_SESSION['loggeduser'];
		$userid = $user->id;
		$existing = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idz' AND user='$userid'");
		if ($existing) {
		 	$view .= get_fb_rating();
		} else {
			$view .= '<p>'._FB_404.'</p>';
		}
  } else {
		$user = $_SESSION['loggeduser'];
		$order_list = $wpdb->get_results("SELECT * FROM `$fb_tablename_order` WHERE user='$user->id' AND status != 5");
		$count_pay = 0;
		$count_files = 0;
		$count_bat = 0;
		$total_count = 0;
		$alert_content = '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><p><strong>CERTAINES DE VOS COMMANDES ATTENDENT DES RETOURS DE VOTRE PART</strong></p><p><ul>';

		foreach($order_list AS $order_row) {
		$idzamowienia = $order_row->unique_id;
		$zamowienie = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");
		//$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1' ORDER BY id ASC", ARRAY_A);
		$status = $zamowienie->status;

		$need_act = 0;
		$bat = 0;
		$to_pay = 0;
		$upload = 0;

		if((has_bat($idzamowienia)) AND (!(is_bat_validated($idzamowienia))) AND ($status != 4) AND ($status != 5) AND ($status != 6)) {
			$bat = 1;
			$need_act = 1;
		}
		if((!(has_uploaded_files($idzamowienia,$user->id))) AND (($status <= 2) OR ($status == 7))) {
			$upload = 1;
			$need_act = 1;
		}

		if(($status == 0) OR ($status == 1)) {
			$to_pay = 1;
			$need_act = 1;
		}

		if($need_act == 1) {
			$alert_content .= '<li><a href="'.get_bloginfo("url").'/vos-devis/?detail='.$idzamowienia.'">Commande n°'.$idzamowienia.'</a></li>';
			$total_count++;
		}
	}

	if($total_count != 0) {
		$alert_content .= '</ul></td></tr></table></div>';
		$view .= $alert_content;
	}

	$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès client: Vos commandes et devis</h1><hr />';
	$user = $_SESSION['loggeduser'];

	//--------------------------------------------------Récupération des variables
	if ((isset($_GET['archive'])) AND ($_GET['archive'] == 1)) { $archive = 1;	} else { $archive = 0; 	}
	if (isset($_GET['pagination'])) { $page_act = $_GET['pagination'];	} else { $page_act = 1; }

	//-----------------------Récupération conditionnelle de la liste des commandes

	$count_old = 0; $count_curr = 0;

	//$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' ORDER BY date DESC");
	$orders_old = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE (user='$user->id') AND (status = 5 OR status = 6)");
	$count_old = $wpdb->num_rows;
	$orders_curr = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE (user='$user->id') AND (status != 5  AND status != 6) ORDER BY date DESC");
	$count_curr = $wpdb->num_rows;

	if ($archive) {
		$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE (user='$user->id') AND (status = 5 OR status = 6) ORDER BY date DESC");
		//$count_o = $wpdb->num_rows;
		if ($count_old > 15) {
			$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE (user='$user->id') AND (status = 5 OR status = 6) ORDER BY date DESC LIMIT ". 50*($page_act-1) .", 50");
		}
	} else {
		$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE (user='$user->id') AND (status != 5 AND status != 6) ORDER BY date DESC");
		//$count_o = $wpdb->num_rows;
		if ($count_curr > 15) {
			$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE (user='$user->id') AND (status != 5 AND status != 6) ORDER BY date DESC LIMIT ". 50*($page_act-1) .", 50");
			//$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status != 5 ORDER BY date DESC");
		}
	}

	if ($orders) {
		$view .= '<div id="votre"><div class="votre_tab_name">Bonjour, '.stripslashes($user->f_name).'!</div>
			<div class="votre_tab_content"><a href="'.get_bloginfo("url").'/inscription/" id="votre_mod"><i class="fa fa-wrench" aria-hidden="true"></i> Modifier mon compte</a>
			<a href="'.get_bloginfo("url").'/?logout=true" id="votre_dec"><i class="fa fa-times-circle" aria-hidden="true"></i>
 			Se déconnecter </a></div>';

		$view .= '</div>';
		$view .= '<div class="votre_tab_head">';

		if ($archive) {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_inactive">Devis & commandes en cours ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_active">Commandes clôturées ou annulées ('.$count_old.')</div></a>';
		} else {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_active">Devis & commandes en cours ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_inactive">Commandes clôturées ou annulées ('.$count_old.')</div></a>';
		}

		$view .= '<table id="fbcart_votre" cellspacing="0">';

		//--------------------------------------fonctionnalité spéciale pour CFACILE
		$checkttr = '';
		if (($_SESSION['loggeduser']->login == 'samrr') || ($_SESSION['loggeduser']->login == 'FABREGONMOULET1') || ($_SESSION['loggeduser']->login == 'malgoire2') || ($_SESSION['loggeduser']->login == 'pocalypse')) {
			$checkttr = '<th></th>';
		}

		//--------------------------------------------------------------------------

		$view .= '<tr><th class="leftth">Gérer</th><th class="tddesc">DESCRIPTION</th><th>N° DE COMMANDE</th><th>PRIX</th><th>DATE</th><th>état</th>'.$checkttr.'</tr>';

		$inc = 0;
		foreach ($orders as $o) :
			$inc++;
			$view .= '<tr>';
			$view .= '<td class="lefttd">';
			//if ($o->status != 6) {
				$view .= '<form name="detailinfo" id="detailinfo" action="" method="GET"><input type="hidden" name="detail" value="'.$o->unique_id.'" /><button class="but_details" title="Télécharger des fichiers, Envoyer et voir les commentaires, Voir les maquettes, Imprimer les factures..." type="submit">
 				<i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Gérer <span class="disno960">la commande</span></button></form>';
			//}
			$view .= '</td>';
			$view .= '<td class="tddesc"><div class="kontener">';
			if ($o->status != 6) {
				$status = print_status_form($o->status, $o->unique_id);
				$commande = $o->unique_id;

				// récupérer le status manuel de la commande
				$checkitup = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$commande'");
				$reponse = $checkitup->status_check;
				$statusCheck = '';
				if ($reponse <= '1' ) {
					$statusCheck = '<a class="statusChecked statusAllright" href="'.get_bloginfo("url").'/vos-devis/?detail='.$commande.'" title="tout est OK !"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
				}
				if ($reponse == '2' ) {
					$statusCheck = '<a class="statusChecked statusNotgood" href="'.get_bloginfo("url").'/vos-devis/?detail='.$commande.'" title="votre attention est requise !"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </a>';
				}
				if ($reponse == '3' ) {
					$statusCheck = '<a class="statusChecked statusVerybad" href="'.get_bloginfo("url").'/vos-devis/?detail='.$commande.'" title="votre commande est bloquée !"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> </a>';
				}

				$status = print_status_form($o->status, $o->unique_id).$statusCheck;
				$view .= '</div>';
			} else {
				$status = print_status($o->status);
			}
			$prods = $wpdb->get_results("SELECT name, status FROM `$fb_tablename_prods` WHERE order_id = '$o->unique_id' ORDER BY name ASC");
			foreach ($prods as $p) :
				if ($p->status == 0) {
					$view .= '<s style="color:red;">'.$p->name.'</s><br />';
				} else {
					$view .= $p->name.'<br />';
				}
			endforeach;

			$comment_new = '';
			$newcomment = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments_new` WHERE order_id = '$o->unique_id'");
			if ($newcomment) {
				$newcomment2 = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments` WHERE order_id = '$o->unique_id' AND author LIKE '%France Banderole%' ORDER BY date DESC LIMIT 1");
				if ($newcomment2) {
					$comment_new = '<br /><form name="detailinfo" id="detailinfo" action="" method="GET"><input type="hidden" name="detail" value="'.$commande.'" /><button class="comment_new"><i class="fa fa-envelope" aria-hidden="true"></i> NOUVEAU <span class="split">MESSAGE!</button></form></span>';
				}
			}

			$view .= '</div></td><td><span class="bolder">'.$o->unique_id.'</span></td><td>'.str_replace(',','', $o->totalttc).' &euro;</td><td>'.$o->data.'</td><td>'.$status.$comment_new.'</td>';

			//------------------------------------fonctionnalité spéciale pour CFACILE

			if (($_SESSION['loggeduser']->login == 'samrr') || ($_SESSION['loggeduser']->login == 'FABREGONMOULET1') || ($_SESSION['loggeduser']->login == 'malgoire2') || ($_SESSION['loggeduser']->login == 'pocalypse')) {

				if (isset($_POST['oid'])){
					if ($_POST['uchk'] == 'payed') {
						$oid = $_POST['oid'];
						$wpdb->query("UPDATE `$fb_tablename_order` SET user_check='1' WHERE unique_id='$oid'");
					} else if ($_POST['uchk'] != 'payed'){
						$oid = $_POST['oid'];
						$wpdb->query("UPDATE `$fb_tablename_order` SET user_check='0' WHERE unique_id='$oid'");
					}
					header('Location: '.$_SERVER['REQUEST_URI']);
					exit();
				}

				//echo $o->user_check.' | ';
				$checked = '';

				if ($o->user_check == 1){
					$checked = 'checked';
				}
				$view .= '<td><form id="ck'.$inc.'" method="post" action=""><input class="ckbox" type="checkbox" name="uchk" value="payed" '.$checked.' onChange="this.parentNode.submit();"><input type="hidden" name="oid" value="'.$o->unique_id.'"></form></td>';
			}

			//------------------------------------------------------------------------

			$view .= '</tr>';
		endforeach;

		$view .= '</table>';

		//----------------------------------------------------- Pagination si besoin

		if(($archive == 0) AND($count_curr > 50)) {

			$view .= '<div class="votre_pagi"> -';
			$nb_pages = intval($count_curr/50) + 1;
			for($i = 1; $i <= $nb_pages; $i++) {
				if($i == $page_act) {
					$view .= ' <a href="/vos-devis?archive='.$archive.'&pagination='.$i.'" class="href_page_act">'.$i.'</a> -';
				} else {
					$view .= ' <a href="/vos-devis?archive='.$archive.'&pagination='.$i.'" class="href_other">'.$i.'</a> -';
				}
			}
			$view .= '</div>';
		} else if(($archive == 1) AND($count_old > 50)) {

			$view .= '<div class="votre_pagi"> -';
			$nb_pages = intval($count_old/50) + 1;
			for($i = 1; $i <= $nb_pages; $i++) {
				if($i == $page_act) {
					$view .= ' <a href="/vos-devis?archive='.$archive.'&pagination='.$i.'" class="href_page_act">'.$i.'</a> -';
				} else {
					$view .= ' <a href="/vos-devis?archive='.$archive.'&pagination='.$i.'" class="href_other">'.$i.'</a> -';
				}
			}
			$view .= '</div>';
		}

	} else if (($count_curr != 0) OR ($count_old != 0)) {
		$view .= '<div id="votre"><div class="votre_tab_name">Bonjour, '.stripslashes($user->f_name).'!</div>
					<div class="votre_tab_content"><a href="'.get_bloginfo("url").'/inscription/" id="votre_mod"><i class="fa fa-wrench" aria-hidden="true"></i>Modifier mon compte</a><a href="'.get_bloginfo("url").'/?logout=true" id="votre_dec"><i class="fa fa-times-circle" aria-hidden="true"></i>Se deconnecter</a></div>';

		$view .= '</div>';

		$view .= '<div class="votre_tab_head">';

		if ($archive) {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_inactive">Devis & commandes en cours ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_active">Commandes clôturées ou annulées ('.$count_old.')</div></a>';
		} else {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_active">Devis & commandes en cours ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_inactive">Commandes clôturées ou annulées ('.$count_old.')</div></a>';
		}

		if ($archive) {
			$view .= '<p class="emptyCart"><i class="fa fa-shopping-cart" aria-hidden="true" style="visibility:hidden;"></i> Vous n\'avez aucune commande archivée.</p>';
		} else {
			$view .= '<p class="emptyCart"><i class="fa fa-shopping-cart" aria-hidden="true" style="visibility:hidden;"></i> Vous n\'avez aucune commande en cours.</p>';
		}

		$view .= '</div>';

	} else {
		$view .= '<div id="votre"><div class="votre_tab_name">Bonjour, '.$user->f_name.'!</div>
					<div class="votre_tab_content"><a href="'.get_bloginfo("url").'/inscription/" id="votre_mod"><i class="fa fa-wrench" aria-hidden="true"></i> Modifier mon compte</a><a href="'.get_bloginfo("url").'/?logout=true" id="votre_dec"><i class="fa fa-times-circle" aria-hidden="true"></i> Se deconnecter</a></div>
				  </div><div class="box_warning" style="clear:both;top:15px">'._FB_NZAM.'</div></div>';
	}
  }
  return $view;
}

//================================================================== status form

function print_status_form($status, $cmd) {
	$formatted .= '<div class="stat">';
	if ($status == 0) {
		$formatted .= 'attente';
	}
	if ($status == 1) {
		$formatted .= 'attente paiement';
	}
	if ($status == 2) {
		$formatted .= 'payé';
	}
	if ($status == 3) {
		$formatted .= 'traitement';
	}
	if ($status == 4) {
		$formatted .= 'expédié';
	}
	if ($status == 5) {
		$formatted .= 'cloturé';
	}
	if ($status == 6) {
		$formatted .= 'annulé';
	}
	if ($status == 7) {
		$formatted .= 'paiement en traitement';
	}
	//$formatted .= '</button></form>';
	return $formatted;
}

//================================================================= print status

function print_status($status) {
	$formatted .= '<span class="stat'.$status.'">';
	if ($status == 0) {
		$formatted .= 'attente';
	}
	if ($status == 1) {
		$formatted .= 'attente paiement';
	}
	if ($status == 2) {
		$formatted .= 'payé';
	}
	if ($status == 3) {
		$formatted .= 'traitement';
	}
	if ($status == 4) {
		$formatted .= 'expédié';
	}
	if ($status == 5) {
		$formatted .= 'cloturé';
	}
	if ($status == 6) {
		$formatted .= 'annulé';
	}
	if ($status == 7) {
		$formatted .= 'paiement en traitement';
	}
	$formatted .= '</span>';
	return $formatted;
}

//============================ fonction ajouter la commande à la base de données

function add_to_db() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_users_cr = $prefix."fbs_users_cr";
	$fb_tablename_remisenew = $prefix."fbs_remisenew";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_address = $prefix."fbs_address";
	$fb_tablename_promo = $prefix."fbs_codepromo";

	$promo = $_POST['codeProm'];

	if (is_cart_not_empty() && fb_is_logged()) {
		$products = $_SESSION['fbcart'];

		// On teste si le panier contient un retrait à l'atelier
		$retrait_atelier = recursive_array_search("retrait colis a l", $_SESSION['fbcart']);

		// On teste si le panier contient un produit colis revendeur
		$colis_revendeur = recursive_array_search("colis revendeur", $_SESSION['fbcart']);

		// On teste si le panier contient un produit en relais colis
		$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);

		// On teste si le panier contient une maquette en ligne
		$maqtt = recursive_array_search("je crée ma maquette", $_SESSION['fbcart']);

		$user = $_SESSION['loggeduser'];
    $uid = $_SESSION['loggeduser']->id;
		$cat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid =  '$uid'");

		foreach ( $products as $products => $item ) {
			$calculCat = '-';
			$totalItem = str_replace(',', '.', $item['total']);
      $prixUnit = str_replace(',', '.', $item['prix']);
      $totalItem = str_replace('€', '', $totalItem);
      $prixUnit = str_replace('€', '', $prixUnit);

			//--------------------------------------vérification remise par catégories
			if ($cat) { // s'il existe des remises par catégorie pour ce client
				foreach($cat as $key => $value) : // pour chaque catégorie
					if (!empty($value) && $value != '0') { // si valeur différente de 0 existe
						$prixItem = 0;
						$prodCat = $item['rodzaj'];
						$find = '/'.$key.'/'; // on recherche le nom de la catégorie dans le panier
						$trouve = preg_match_all($find, $prodCat, $resultat);
						$trouve = count($resultat[0]);
						if($trouve >= 1){ // si on trouve la catégorie, on applique la remise
							$prixItem += $prixUnit*$item['ilosc'];
							$calculCat = ($prixItem)*($value/100); // calcule la réduction sur le total HT produit x quantité
							$totalItem = $totalItem-$calculCat;
							$calculCat = number_format($calculCat, 2);
							$totalItem = number_format($totalItem, 2);
							$totalItem = str_replace(',', '', $totalItem);
						}
					}
				endforeach;
			}

			$totalHT = $totalHT + $totalItem;
			$fraisPort = $fraisPort + $item['transport'];
		}

		//--------------------------------------------------------------------------
    $addtodevis ='';
    $calculRemise = 0;
    $calculCode = 0;
    $totalHT = $totalHT + $fraisPort;
    $calculTVA = $totalHT*0.200;
    $totalTTC = $totalHT+$calculTVA;
		$codepromo = '';

		//------------------------------------------------vérification remise client
		$uid = $user->id;
		$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = '$uid'");
		$client_remise = $exist_remise->att_value;

		if ($exist_remise && $client_remise != 0) {
			$newrabat = $client_remise / 100;
			$calculRemise = ($totalHT-$calculCode) * $newrabat;
		}

		$cat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid =  '$uid'");

		//-------------------------------------------s'il n'y a pas de remise client
		if ((!$exist_remise || $client_remise == 0) && isRowEmpty($cat)) {

			//-------------------------------------------------------Remises intégrées

      if ($totalHT < 50)   $calculCode = 0;
      if ($totalHT >= 50)  $calculCode = ($totalHT)*(3/100);
      if ($totalHT > 100)  $calculCode = 10;
      if ($totalHT > 200)  $calculCode = 20;
      if ($totalHT > 400)  $calculCode = 30;
      if ($totalHT > 600)  $calculCode = 40;
      if ($totalHT > 800)  $calculCode = 50;
      if ($totalHT > 1000) $calculCode = 60;

			//-------------------------------------------------vérification code promo

			if(isset($_POST['codeProm'] )) {

	      $products = $_SESSION['fbcart'];
	      $codepromo = $_POST['codeProm'] ;
	      $codeisindb = $wpdb->get_row("SELECT code FROM `$fb_tablename_promo` WHERE code='$codepromo'");
	      $reduction = $wpdb->get_row("SELECT * FROM `$fb_tablename_promo` WHERE code='$codepromo'");
	      $curdate = date("Y-m-d");
	      $promoCat = $reduction->categorie;

	      if($codeisindb) { // si le code entré est bien dans la bdd:
	        if($totalHT >= $reduction->mini) { // si le total TTC est supérieur ou égal au minimum d'achat:
	          if($curdate > $reduction->date) { // si le code a expiré:

	          }else{ //-------------------------------------- si le code est valide:

	            if($promoCat !== ('Tous')){ // si la réduction s'applique à une catégorie de produits:
	              $prixItem = 0;
								$reducEu = 0;
	              foreach ( $products as $products => $item ) {
	        				$prodCat = $item['rodzaj'];
	                $find = '/'.$promoCat.'/';
	        				$trouve = preg_match_all($find, $prodCat, $resultat);
	        				$trouve = count($resultat[0]);

	                if($trouve >= 1){
	                  $prixItem += $item['prix']*$item['ilosc'];
										$reducEu = $reduction->reduction;
	                }
	              }

								if($reduction->remise != 0) // si la remise est en pourcentage
                $calculCode += ($prixItem)*($reduction->remise/100); // calcule le % sur le total HT des produits de la catégorie
                else // si la remise est en euros
                $calculCode += $reducEu; // applique la réduction en euros

	            }else{ //--------------si la réduction s'applique à tous les produits:
								if($reduction->remise != 0) // si la remise est en pourcentage
	              $calculCode += ($totalHT)*($reduction->remise/100); // calcule le % sur le montant HT moins l'éventuelle remise client
								else // si la remise est en euros
                $calculCode += $reduction->reduction; // applique la réduction en euros
	            }

	          }
	        }
	      }
	    }
		}

		//--------------------------------------------------------------------------

    $totalHTdeduit = $totalHT - $calculRemise - $calculCode;
    $calculTVA = $totalHTdeduit*0.200;
    $totalTTC = $totalHTdeduit+$calculTVA;

		$calculRemise = str_replace(',', '', number_format($calculRemise, 2));
    $calculCode = str_replace(',', '', number_format($calculCode, 2));
		$totalHT = str_replace(',', '', number_format($totalHT, 2));
		$totalHTdeduit = str_replace(',', '', number_format($totalHTdeduit, 2));
		$fraisPort = str_replace(',', '', number_format($fraisPort, 2));
		$calculTVA = str_replace(',', '', number_format($calculTVA, 2));
		$totalTTC = str_replace(',', '', number_format($totalTTC, 2));

    //--------------------------------------------------------------------------

		$unique_id = random_string();
		$_SESSION['orderid'] = $unique_id;
		$data = date('Y-m-d H:i:s');
		$dodaj_zamowienie = $wpdb->query("INSERT INTO `$fb_tablename_order` VALUES (not null, '".$unique_id."', '".$fraisPort."', '".$totalHT."', '".$calculTVA."', '".$calculCode."', '".$totalTTC."', '".$data."', '".$data."', '".$user->id."', '', '0', '', '','','','','','')");

		if(isset($_POST['codeProm'] )) $savecode = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$unique_id."', 'codepromo', '".$_POST['codeProm']."')");

		//ICI PLACER L'AJOUT A MAILJET
		createContact($user->email);
		$mj_list = getListId('Tous clients');
		$mj_user = getIdFromEmail($user->email);
		abonnerListe($mj_user,$mj_list);

		if ($dodaj_zamowienie) {
			if (!empty($client_remise) && ($client_remise != '0')) {
				$dodaj_nowyrabat = $wpdb->query("INSERT INTO `$fb_tablename_remisenew` VALUES (not null, '".$unique_id."', '".$client_remise."', '".$calculRemise."')");
				if ($dodaj_nowyrabat) { }
			}
			$ktomakiete = 0;
			$czyfbrobimakiete = 0;
			$products = $_SESSION['fbcart'];

			foreach ( $products as $products => $item ) {
				$calculCat = '-';
				$totalItem = str_replace(',', '.', $item['total']);
	      $prixUnit = str_replace(',', '.', $item['prix']);
	      $totalItem = str_replace('€', '', $totalItem);
	      $prixUnit = str_replace('€', '', $prixUnit);
				$cat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid =  '$uid'");

				//------------------------------------vérification remise par catégories
				if ($cat) { // s'il existe des remises par catégorie pour ce client
					foreach($cat as $key => $value) : // pour chaque catégorie
						if (!empty($value) && $value != '0') { // si valeur différente de 0 existe
							$prixItem = 0;
							$prodCat = $item['rodzaj'];
							$find = '/'.$key.'/'; // on recherche le nom de la catégorie dans le panier
							$trouve = preg_match_all($find, $prodCat, $resultat);
							$trouve = count($resultat[0]);
							if($trouve >= 1){ // si on trouve la catégorie, on applique la remise
								$prixItem += $prixUnit*$item['ilosc'];
								$calculCat = ($prixItem)*($value/100); // calcule la réduction sur le total HT produit x quantité
								$totalItem = $totalItem-$calculCat;
								$calculCat = number_format($calculCat, 2);
								$totalItem = number_format($totalItem, 2);
								$totalItem = str_replace(',', '', $totalItem);
							}
						}
					endforeach;
				}
				$wzorzec = '/j’ai déjà crée la maquette/';
				$ktomak = preg_match_all($wzorzec, $item['description'], $wynik);
				$ktomak = count($wynik[0]);

				$find = '/je crée ma maquette en ligne/';
				$maquette = preg_match_all($find, $item['description'], $resultat);
				$maquette = count($resultat[0]);

				if ($ktomak >= 1) {
					$ktomakiete = 0;
				}else if ($maquette >= 1) {
					$ktomakiete = 2;
				}else {
					$ktomakiete = 1;
				}
				if ($ktomakiete == 1) $czyfbrobimakiete = 1;
				if ($ktomakiete == 2) $czyfbrobimakiete = 2;

				$dodaj_produkt = $wpdb->query("INSERT INTO `$fb_tablename_prods` VALUES (not null, '".$unique_id."', '".$item['rodzaj']."', '".$item['opis']."', '".$item['ilosc']."', '".$prixUnit."', '".str_replace(',', '.', $item['option'])."', '".$calculCat."', '".$totalItem."', '".$item['transport']."', '', '1', '".$item['hauteur']."', '".$item['largeur']."', '".$item['reference']."', '".$item['image']."')");
			}

			if ($dodaj_produkt) {
				unset($_SESSION['fbcart']);
			}
			if ($czyfbrobimakiete == 0) {
				$letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour et bienvenue sur France banderole !<br /><br />Conservez soigneusement le nom d\'utilisateur et mot de passe que vous avez choisi, ils vous serviront pour vous connecter à votre accès client et suivre en direct l\'évolution de vos devis et commandes.<br />En cliquant sur GERER VOTRE COMMANDE dans votre accès client, vous accédez à l\'interface de communication, vous pouvez alors :<br />- Envoyer vos fichiers ou explicatifs via le module de téléchargement (maximum 100mo). <br />- Envoyer des commentaires directement au service d\'infographie de France banderole et lire les réponses.<br />- Visualiser votre ou vos maquette(s) de validation (BAT) avant de procéder à votre règlement.<br />- Payer votre commande par carte bleue sécurisée en ligne, chèque ou virement bancaire.<br />- Suivre l\'expédition de votre colis et imprimer vos factures.<br /><br />Les délais de fabrication/livraison sont de 6 à 9 jours ouvrés maximum à compter de la réception de votre règlement.<br />Vous pouvez également contacter un conseiller commercial au 0442.401.401 pour mettre en place un délai Rush qui vous permet de faire passer votre commande en priorité. Elle sera alors fabriquée et expédiée en 24/48 ou 72H !<br />Dans l\'espoir d\'avoir répondu à vos premières questions, nous vous souhaitons une agréable navigation sur notre site web.<br /><br />Amicalement,<br />L\'équipe France banderole.<br />https://www.france-banderole.com</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
				$lettert = "Fonctionnement général de votre accès client";
			} elseif  ($czyfbrobimakiete == 2){
				$letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour et bienvenue sur France banderole !<br /><br />Conservez soigneusement le nom d\'utilisateur et mot de passe que vous avez choisi, ils vous serviront pour vous connecter à votre accès client et suivre en direct l\'évolution de vos devis et commandes.<br />En cliquant sur GERER VOTRE COMMANDE dans votre accès client, vous accédez à l\'interface de communication, vous pouvez alors :<br />- Créer votre maquette grâce à notre application en ligne. <br />- Envoyer des commentaires directement au service d\'infographie de France banderole et lire les réponses.<br />- Visualiser votre ou vos maquette(s) de validation (BAT) avant de procéder à votre règlement.<br />- Payer votre commande par carte bleue sécurisée en ligne, chèque ou virement bancaire.<br />- Suivre l\'expédition de votre colis et imprimer vos factures.<br /><br />Les délais de fabrication/livraison sont de 6 à 9 jours ouvrés maximum à compter de la réception de votre règlement.<br />Vous pouvez également contacter un conseiller commercial au 0442.401.401 pour mettre en place un délai Rush qui vous permet de faire passer votre commande en priorité. Elle sera alors fabriquée et expédiée en 24/48 ou 72H !<br />Dans l\'espoir d\'avoir répondu à vos premières questions, nous vous souhaitons une agréable navigation sur notre site web.<br /><br />Amicalement,<br />L\'équipe France banderole.<br />https://www.france-banderole.com</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
				$lettert = "Fonctionnement général de votre accès client";
			} else {
				$letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour et bienvenue sur France banderole !<br /><br />Conservez soigneusement le nom d\'utilisateur et mot de passe que vous avez choisi, ils vous serviront pour vous connecter à votre accès client et suivre en direct l\'évolution de vos devis et commandes.<br />En cliquant sur GERER VOTRE COMMANDE dans votre accès client, vous accédez à l\'interface de communication, vous pouvez alors :<br />- Envoyer vos fichiers ou explicatifs via le module de téléchargement (maximum 100mo). <br />- Envoyer des commentaires directement au service d\'infographie de France banderole et lire les réponses.<br />- Visualiser votre ou vos maquette(s) de validation (BAT) avant de procéder à votre règlement.<br />- Payer votre commande par carte bleue sécurisée en ligne, chèque ou virement bancaire.<br />- Suivre l\'expédition de votre colis et imprimer vos factures.<br /><br />Les délais de fabrication/livraison sont de 6 à 9 jours ouvrés maximum à compter de la réception de votre règlement.<br />Vous pouvez également contacter un conseiller commercial au 0442.401.401 pour mettre en place un délai Rush qui vous permet de faire passer votre commande en priorité. Elle sera alors fabriquée et expédiée en 24/48 ou 72H !<br />Dans l\'espoir d\'avoir répondu à vos premières questions, nous vous souhaitons une agréable navigation sur notre site web.<br /><br />Amicalement,<br />L\'équipe France banderole.<br />https://www.france-banderole.com</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
				$lettert = "Fonctionnement général de votre accès client";
			}
			function wpse27856_set_content_type(){
			  return "text/html";
			}
			add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
			$header = 'From: France Banderole <information@france-banderole.com>';
  		$header .= "\nContent-type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
      //mail($user->email, $lettert, $letter, $header);
      wp_mail($user->email, $lettert, $letter);
			remove_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
		}

		//ajout header mail <a href=\'https://www.france-banderole.com\'><img src=\'https://www.france-banderole.com/wp-content/plugins/fbshop/images/printlogo.jpg\'></a>

		/* Ajout de l'indicateur "retrait atelier" dans le champ "type" et "yes" dans le champ value de la table "fbs_cf" */
		if($retrait_atelier !== false){
			$requeteretrait_atelier = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='retrait atelier' AND unique_id = '$unique_id'");
			if ($requeteretrait_atelier) {
				$requeteretrait_atelier1 = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='".$code_relais_colis."' WHERE unique_id='".$unique_id."' AND type='retrait atelier'");
			} else {
				$requeteretrait_atelier2 = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$unique_id."', 'retrait atelier', 'yes')");
			}
		}

		/* Ajout de l'indicateur "revendeur" dans le champ "type" et "yes" dans le champ value de la table "fbs_cf" */
		if($colis_revendeur !== false){
			$requetecolis_revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='revendeur' AND unique_id = '$unique_id'");
			if ($requetecolis_revendeur) {
				$requetecolis_revendeur1 = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='".$code_relais_colis."' WHERE unique_id='".$unique_id."' AND type='revendeur'");
			} else {
				$requetecolis_revendeur2 = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$unique_id."', 'revendeur', 'yes')");
			}
		}

		/* Ajout de l'indicateur "maquette" dans le champ "type" et "yes" dans le champ value de la table "fbs_cf" */
		if($maqtt !== false){
			$maq = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='maquette' AND unique_id = '$unique_id'");
			if ($maq) {
				$maqup = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='yes' WHERE unique_id='".$unique_id."' AND type='maquette'");
			} else {
				$maqad = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$unique_id."', 'maquette', 'yes')");
			}
		}

		/* Ajout de l'indicateur "relais" dans le champ "type" et numéro de relais dans le champ "Value" la table "fbs_cf" & ajout adresse du relais colis dans la table "fbs_address"
		et ajout de l'adresse de livraison dans la table "fbs_users */
		if(!($relais_colis !== false)) $_SESSION['loggeduser']->relais_colis == "no!";

		if($_SESSION['loggeduser']->relais_colis == "yes" && $_SESSION['loggeduser']->code_relais_colis != ""){
			$code_relais_colis = $_SESSION['loggeduser']->code_relais_colis;
			$selectrelaiscolis = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='relais' AND unique_id = '$unique_id'");
			if ($selectrelaiscolis) {
				$requeterelais1 = $wpdb->query("UPDATE `$fb_tablename_cf` SET value='".$code_relais_colis."' WHERE unique_id='".$unique_id."' AND type='relais'");
			} else {
				$requeterelais2 = $wpdb->query("INSERT INTO `$fb_tablename_cf` VALUES (not null, '".$unique_id."', 'relais', '".$code_relais_colis."')");
			}

			$userZZ = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$unique_id' AND user = '$uid'");
			if ($userZZ) {
				$kolejka = $wpdb->update($fb_tablename_address, array (
							'l_name' => addslashes($_SESSION['loggeduser']->l_name),
							'l_comp' => addslashes($_SESSION['loggeduser']->l_comp),
							'l_address' => addslashes($_SESSION['loggeduser']->l_address),
							'l_code' => addslashes($_SESSION['loggeduser']->l_code),
							'l_city' => addslashes($_SESSION['loggeduser']->l_city),
							'l_phone' => addslashes($_SESSION['loggeduser']->f_phone)),
							array ('unique_id' => $unique_id) );
			}else{
				$dodaj = $wpdb->query("INSERT INTO `$fb_tablename_address` VALUES (not null, '".
							$uid."', '".
							$unique_id."', '".
							addslashes($_SESSION['loggeduser']->l_name)."', '".
							addslashes($_SESSION['loggeduser']->l_comp)."', '".
							addslashes($_SESSION['loggeduser']->l_address)."', '".
							addslashes($_SESSION['loggeduser']->l_code)."', '".
							addslashes($_SESSION['loggeduser']->l_city)."', '".
							addslashes($_SESSION['loggeduser']->l_phone)."')");
			}
			/* Enregistrement de l'adresse du relais colis dans l'adresse de livraison utilisateur*/
			/*$updateuserZZ = $wpdb->query("UPDATE `$fb_tablename_users` SET
							l_name = '".$_SESSION['loggeduser']->l_name."',
							l_comp = '".$_SESSION['loggeduser']->l_comp."',
							l_address = '".$_SESSION['loggeduser']->l_address."',
							l_code = '".$_SESSION['loggeduser']->l_code."',
							l_city = '".$_SESSION['loggeduser']->l_city."',
							l_phone = '".$_SESSION['loggeduser']->f_phone."'
								   WHERE id = '$uid'");
			*/
		}
		/* FIN Ajout de l'indicateur "relaiscolis" dans la table  "fbs_cf" & ajout adresse du relais colis dans la table "fbs_address" */

		/* On efface les données de session relatives à la livraison */
		unset($_SESSION['loggeduser']->code_client_dest);
		unset($_SESSION['loggeduser']->l_name);
    unset($_SESSION['loggeduser']->l_address);
		unset($_SESSION['loggeduser']->l_comp);
    unset($_SESSION['loggeduser']->l_code);
    unset($_SESSION['loggeduser']->l_phone);
    unset($_SESSION['loggeduser']->l_city);
		unset($_SESSION['loggeduser']->l_country);
		unset($_SESSION['loggeduser']->changement_relais_colis);
		unset($_SESSION['loggeduser']->relais_colis);
		unset($_SESSION['loggeduser']->code_relais_colis);
		/* FIN effacement données session */
	}
}

//============================================================ get browser width
function screenWidth(){
	$screenWidth='<script type="text/javascript">
		document.write(""+screen.width+"");
	</script>';
	return $screenWidth;
}

//=================================================== générer numéro de commande

function random_string() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$los = rand(0, 999999);
	$los = '00'.$los;
	while ($wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id='$los'")) {
		$los = rand(0, 999999);
		$los = '00'.$los;
	}
	return $los;
}

?>
