<?php
global $wpdb;
$prefix = $wpdb->prefix;
$fb_tablename_order = $prefix."fbs_order";
$fb_tablename_prods = $prefix."fbs_prods";
$fb_tablename_comments = $prefix."fbs_comments";
$fb_tablename_comments_new = $prefix."fbs_comments_new";
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
		// OK, Sauvegarde des champs de la rÈponse
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
			if ($setorder->status < '2') {
				$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='2' WHERE unique_id='$order_id'");
				if (!$apdejt) {
					echo 'Erreur appel response. Contactez l\'administrateur.';
				}
			}
		}
	}
	fwrite( $fp, "-------------------------------------------\n");
	fclose ($fp);
}

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


function has_uploaded_files($cmd, $userid) {
	$name=$_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$cmd;
	$fichiers="";
	if(file_exists($name))
	if ($dir = @opendir($name)) {
	    while(($file = readdir($dir))) {
			if(!is_dir($file) && !in_array($file, array(".",".."))) {
				$fichiers.=$file.'<br />';
			}
    	}
	    closedir($dir);
  	}
	return $fichiers;
}

function get_filesender($products) {
	$idzamowienia = $_GET['detail'];
	$user = $_SESSION['loggeduser'];
	$b = has_uploaded_files($idzamowienia, $user->login);

//if ($user->login == 'schizoos' || $user->login == 'pocalypse') {
//	if ($b=="") { $fiText = '<tr class="noFilesTr"><td class="lefttd_none"></td><td colspan="5">Transferer des fichiers! Vous pouvez faire glisser-déposer ici.</td></tr>'; } else { $fiText = ''; }
$view .= '
<form id="fileupload" class="noprint" action="'.get_bloginfo("url").'/uploaded/" method="post" enctype="multipart/form-data"><input type="hidden" id="cmdID" name="cmd" value="'.$idzamowienia.'" /><input type="hidden" name="usr" value="'.$user->login.'" />
				<div class="acces_tab_name2">Envoyer vos maquettes</div>
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <input type="checkbox" class="toggle" />
                <span class="btn btn-success fileinput-button fuselect">
                    <span><i class="fa fa-plus" aria-hidden="true"></i> Choisir le(s) fichier(s)</span>
                    <input type="file" name="files[]" multiple />
                </span>
                <button type="submit" class="btn btn-primary start fustart">
                    <span><i class="fa fa-upload" aria-hidden="true"></i> Envoyer le(s) fichier(s)</span>
                </button>
                <button type="reset" class="btn btn-warning cancel fucancel">
                    <span><i class="fa fa-times-circle" aria-hidden="true"></i> Annuler</span>
                </button>
                <button type="button" class="btn btn-danger delete fudelete">
                    <span><i class="fa fa-trash-o" aria-hidden="true"></i> Effacer</span>
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
		<thead><tr><th class="lefttd"></th><th class="tabname">FICHER</th><th class="tabsize">TAILLE</th><th class="tabprog">progrès</th><th class="tabstart">action</th><th class="tabdel"></th></tr></thead>
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
/*
} else {
	if ($b=="") {
		$view .= '<table id="fbcart_fileupload" border="0" cellspacing="0"><tr><th class="leftth">ETAT</th><th>télécharger</th><th class="nobackground"></th></tr><tr><td class="lefttd">Transferer des fichiers</td><td colspan="2">';
		$view .= '<a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/frmupload2.php?cmd='.$idzamowienia.'&usr='.$user->login.'&isemail='.$user->email.'&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=450&width=500&modal=true" class="thickbox but_telecharger"></a>';
		$view .= '</td></tr>';
		$view .= '</table>';
	} else {
		$view .= '<table id="fbcart_fileupload2" border="0" cellspacing="0"><tr><th class="leftth">ETAT</th><th class="leftth2">télécharger</th><th class="leftth3">Fichier(s) Reçu(s)</th><th class="nobackground"></th></tr><tr><td class="lefttd2">Transferer des fichiers</td><td class="lefttd3">';
		$view .= '<a href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/frmupload2.php?cmd='.$idzamowienia.'&usr='.$user->login.'&isemail='.$user->email.'&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=450&width=500&modal=true" class="thickbox but_telecharger"></a></td><td class="lefttd4" colspan="2">';
		$view .= $b;
		$view .= '</td></tr>';
		$view .= '</table>';
	}
}
*/

	return $view;
}

function get_details() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_rating = $prefix."fbs_rating";
	$user = $_SESSION['loggeduser'];
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

	if($need_act == 0) {
		$prolog .= '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p>Cette commande n\'attend pas de retours de votre part.</p></td></tr></table></div>';
	} else {
		$prolog .= '<div class="box_warning noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_warning.png" /></td><td><p><strong>CETTE COMMANDE ATTEND DES RETOURS DE VOTRE PART !</strong></p><p><ul>';
		if($to_pay == 1) {
			$prolog .= '<li>Vous n\'avez pas <strong>réglé cette commande</strong>.</li>';
		}
		if($upload == 1) {
			$prolog .= '<li>Vous n\'avez pas <strong>mis vos fichiers en ligne</strong>.</li>';
		}
		if($bat == 1) {
			$prolog .= '<li>Vous n\'avez pas <strong>validé votre BAT</strong>.</li>';
		}

		$prolog .= '</ul></p>';

		if($to_pay == 1) {
			$prolog .= '<form name="paye" id="payeTop" action="'.get_bloginfo('url').'/paiement/" method="get"><input type="hidden" name="pay" value="'.$idzamowienia.'" /><button id="but_payerTop" type="submit"><i class="fa fa-eur" aria-hidden="true"></i> Payer la commande</button></form>';
		}
		if($bat == 1) {
			//$prolog .= '<a rel="shadowbox" href="'.get_bloginfo("url").'/valider-mon-bat?uid='.$idzamowienia.'" id="but_bat"></a>';
			$prolog .= '<a rel="shadowbox" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/val_bat.php?uid='.$idzamowienia.'" id="but_voir_bat"><i class="fa fa-eye" aria-hidden="true"></i> Voir et valider votre BAT</a>';
		}

		$prolog .= '</td></tr></table></div>';

	}

	$prolog .= '<h1 class="noprint">Accès client: Devis detail (Nº '.$idzamowienia.')</h1><hr class="noprint" />';
	$prolog .= '<div class="acces_tab_name_devis noprint">MON DEVIS :<span>ETAT : '.print_status($zamowienie->status).'</span></div>';


// tylko komentarze od france banderole
//		$lastcomment = $wpdb->get_row("SELECT c.*, DATE_FORMAT(c.date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` as c, `$fb_tablename_order` as o WHERE c.order_id = '$idzamowienia' AND o.user = '$user->id' AND c.author='France Banderole' ORDER BY c.date DESC LIMIT 1");
// wszystkie ostatnie komentarze
		$lastcomment = $wpdb->get_row("SELECT c.*, DATE_FORMAT(c.date, '%d/%m/%Y') AS data FROM `$fb_tablename_comments` as c, `$fb_tablename_order` as o WHERE c.order_id = '$idzamowienia' AND o.user = '$user->id' ORDER BY c.date DESC LIMIT 1");
		if ($lastcomment) {
			if (strlen($lastcomment->content) > 250) {
				$ostcomment = substr($lastcomment->content, 0, 250).'...';
			} else {
				$ostcomment = $lastcomment->content;
			}
			$ostcomment = stripslashes($ostcomment);
			if ($lastcomment->author != 'France Banderole') {
				$ostcomment = htmlspecialchars($ostcomment);
			}
			$idostcomment = $lastcomment->order_id;
			$linkcomment = '<a href="'.get_bloginfo("url").'/vos-devis/?comment='.$idzamowienia.'">Lire la suite...</a>';
			$epilog .= '<table id="fbcart_lastcomment" border="0" cellspacing="0" class="noprint"><tr><th class="leftth">DATE</th><th class="leftth2">expéditeur</th><th class="leftth3">DERNIER COMMENTAIRE</th><th></th><th></th></tr>';
			if ($lastcomment->author == 'France Banderole') {
				$epilog .= '<tr><td class="lefttd">'.$lastcomment->data.'</td><td class="lefttd2">'.$lastcomment->author.'</td><td class="lefttd3">'.stripslashes($ostcomment).'</td><td class="lefttd4" colspan="2">'.$linkcomment.'</td></tr>';
			} else {
				$epilog .= '<tr><td class="lefttd">'.$lastcomment->data.'</td><td class="lefttd2a">'.$lastcomment->author.'</td><td class="lefttd3a">'.stripslashes($ostcomment).'</td><td class="lefttd4" colspan="2">'.$linkcomment.'</td></tr>';
			}
			$epilog .= '</table></div>';
		} else {
			$epilog .= '<div id="fbcart_lastcomment"></div>';
		}

	$epilog .= '<div id="fbcart_buttons" class="noprint">';
	$epilog .= '<a href="'.get_bloginfo("url").'/vos-devis/" id="but_retour"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour à vos devis</a>';
	if ($status<2) {
		$epilog .= '<form name="delfromvosdevis" id="delfromvosdevis" action="'.get_bloginfo('url').'/vos-devis/" method="post"><input type="hidden" name="annulervosdevis" value="'.$idzamowienia.'" /><button id="but_annulercommande" type="submit"><i class="fa fa-times-circle" aria-hidden="true"></i> Annuler la commande</button></form>';
	} elseif ($status>1) {
		$epilog .= '<span id="but_annulercommande" class="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i> Annuler la commande</span>';
	}
	if ($status!=3 && $status!=4 && $status!=5) {
		$epilog .= '<a href="javascript:window.print()" id="but_imprimer"><i class="fa fa-print" aria-hidden="true"></i> Imprimer ce devis</a>';
	} else {
		$epilog .= '<span id="but_imprimer" class="deactive"><i class="fa fa-print" aria-hidden="true"></i> Imprimer ce devis</span>';
	}
// wyswietlanie przycisku podgladu projektów
//$epilog .= '<a style="display: none;" rel="shadowbox[banderolesgallery]" href="http://localhost:8888/wp-content/uploads/2010/04/banderole-5.jpg"></a><a style="display: none;" rel="shadowbox[banderolesgallery]" href="http://localhost:8888/wp-content/uploads/2010/04/banderole-6.jpg"></a><a rel="shadowbox[kakemonosgallery]" href="http://localhost:8888/wp-content/uploads/2010/04/exkak3.jpg"></a>';
	$has_bat = 0;
	if (($zamowienie->status) > 0) {
	$name=$_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$idzamowienia.'-projects';
	if(file_exists($name))
	if ($dir = @opendir($name)) {
	$x=0;
	    while(($file = readdir($dir))) {
			if(!is_dir($file) && !in_array($file, array(".",".."))) {
				if ($x<1) {
					$epilog .= '<a rel="shadowbox[projectsgallery]" href="'.get_bloginfo("url").'/uploaded/'.$idzamowienia.'-projects/'.$file.'" class="but_voiremaquette"><i class="fa fa-eye" aria-hidden="true"></i> Voir maquette / BAT </a>';
					$has_bat = 1;
					$x=1;
				} else {
					$epilog .= '<a style="display: none;" rel="shadowbox[projectsgallery]" href="'.get_bloginfo("url").'/uploaded/'.$idzamowienia.'-projects/'.$file.'">asd</a>';
				}
			}
    	}
	    closedir($dir);
  	}
  }
	// commande annulée ou cloturé: désactivation du bouton écrire commentaire
  if ($status!=5 && $status!=6 ) {
		$epilog .= '<a href="'.get_bloginfo('url').'/vos-devis/?comment='.$idzamowienia.'" id="but_comment"><i class="fa fa-pencil" aria-hidden="true"></i> écrire un commentaire</a>';
	} else {
		$epilog .= '<span id="but_comment" class="deactive"><i class="fa fa-pencil" aria-hidden="true"></i> écrire un commentaire</span>';
	}
	if ($status<2) {
		$epilog .= '<form name="paye" id="paye" action="'.get_bloginfo('url').'/paiement/" method="get"><input type="hidden" name="pay" value="'.$idzamowienia.'" /><button id="but_payer" type="submit"><i class="fa fa-eur" aria-hidden="true"></i> Payer la commande</button></form>';
	} else {
		$epilog .= '<span id="but_payer" class="deactive"><i class="fa fa-eur" aria-hidden="true"></i> Payer la commande</span>';
	}
	if ($status>=4) {
		$ktoryshipping = $wpdb->get_row("SELECT * FROM `$fb_tablename_cf` WHERE type='shipping' AND unique_id = '$idzamowienia'");
		if (($ktoryshipping) && ($ktoryshipping->value != '0')) {
			if ($ktoryshipping->value == 'tnt') {
				$epilog .= '<a href="http://www.tnt.fr/public/suivi_colis/recherche/visubontransport.do?radiochoixrecherche=BT&bonTransport='.$zamowienie->tnt.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			} else if (strtolower($ktoryshipping->value) == 'fedex') {
				$epilog .= '<a href="https://france.fedex.com/te/webapp25?&trans=tesow350&action=recherche_complete&NUM_COLIS='.$idzamowienia.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			} else if ($ktoryshipping->value == 'autre') {
				$epilog .= '<a href="'.$zamowienie->tnt.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			}
			if ($ktoryshipping->value == 'ciblex') {
				$epilog .= '<a href="http://extranet.geodisciblex.com/extranet/client/corps.php?module=colis&colis='.$zamowienie->tnt.'" target="_blank" id="but_suivre"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</a>';
			}
		}
	} else {
		$epilog .= '<span id="but_suivre" class="deactive"><i class="fa fa-truck" aria-hidden="true"></i> Suivre le colis</span>';
	}
	if ($status==3 || $status==4 || $status==5) {
		$epilog .= '<a href="javascript:window.print()" id="but_imprimerfacture"><i class="fa fa-print" aria-hidden="true"></i> Imprimer la facture</a>';
	} else {
		$epilog .= '<span id="but_imprimerfacture" class="deactive"><i class="fa fa-print" aria-hidden="true"></i> Imprimer la facture</span>';
	}
	if ($status==4 || $status==5) {
		$czyoceniony = $wpdb->get_row("SELECT * FROM `$fb_tablename_rating` WHERE unique_id = '$idzamowienia' AND exist = 'true'");
		if (!$czyoceniony) {
			$epilog .= '<a href="'.get_bloginfo('url').'/vos-devis/?rating='.$idzamowienia.'" id="but_rating"><i class="fa fa-star" aria-hidden="true"></i> Noter France Banderole</a>';
		}
	} else {
		$epilog .= '<span id="but_rating" class="deactive"><i class="fa fa-star" aria-hidden="true"></i> Noter France Banderole</span>';
	}
	//if((($status == 1) or ($status == 2) or ($status == 7)) and ((has_bat($idzamowienia)) AND (!(is_bat_validated($idzamowienia))))) {
		//$epilog .= '<a rel="shadowbox" href="'.get_bloginfo("url").'/valider-mon-bat?uid='.$idzamowienia.'" id="but_bat"></a>';
		//$epilog .= '<a rel="shadowbox" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/val_bat.php?uid='.$idzamowienia.'" id="but_bat"></a>';
	//}


	$epilog .= '</div>';

	$view .= print_devis_details($products, $prolog, $epilog, $writable, $statuszamowienia);
	return $view;
}

function reorganize_votre($idzamowienia) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$kosztcalosci=0;
	$products = $wpdb->get_results("SELECT * FROM `$fb_tablename_prods` WHERE order_id='$idzamowienia' AND status='1'", ARRAY_A);
	if ($products) {
		foreach ( $products as $products => $item ) {
			$koszttotal = str_replace(',', '.', $item[total]);
			$kosztcalosci = $kosztcalosci + $koszttotal;
			$transportcalosci = $transportcalosci + $item[frais];
		}
//dodatkowy rabat
		$czyjestwtabeli = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestwtabeli) {
			if ( ($czyjestwtabeli->remis != '') && ($czyjestwtabeli->remis != '0') ) {
				$dodatkowyrabat = $czyjestwtabeli->remis;
				$dodatkowyrabat = str_replace(',', '.', $dodatkowyrabat);
				$kosztcalosci = $kosztcalosci + $dodatkowyrabat;
			}
		}
//dodatkowy rabat
//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
				$newrabat = $exist_remise->percent / 100;
				$wysokoscrabatu = $kosztcalosci * $newrabat;
				$kosztcalosci = $kosztcalosci - $wysokoscrabatu;
				$zmiana = $wpdb->update($fb_tablename_remisnew, array ( 'remisenew' => $wysokoscrabatu), array ( 'sku' => $idzamowienia ) );
			}
//koniec//
		$kosztcalosci = $kosztcalosci + $transportcalosci;
//zmiana podatku TVA
		$czyjesttva = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '".$idzamowienia."-tva'");
		if ($czyjesttva) {
			if ($czyjesttva->remis == 0) {
				$podatekcalosci = 0;
			} elseif ($czyjesttva->remis == '') {
			  	$podatekcalosci = $kosztcalosci*0.200;
			} else {
				$tvapod = $czyjesttva->remis/100;
				$podatekcalosci = $kosztcalosci*$tvapod;
			}
		} else {
		  	$podatekcalosci = $kosztcalosci*0.200;
		}
//zmiana podatku TVA
	  	$totalcalosci = $kosztcalosci+$podatekcalosci;
	  	$kosztcalosci = number_format($kosztcalosci, 2);
		$transportcalosci = number_format($transportcalosci, 2);
		$podatekcalosci = number_format($podatekcalosci, 2);
	  	$totalcalosci = number_format($totalcalosci, 2);
		//$nowadata = date('Y-m-d H:i:s');
		$zmiana = $wpdb->update($fb_tablename_order, array ( 'frais' => $transportcalosci, 'totalht' => $kosztcalosci, 'tva' => $podatekcalosci, 'totalttc' => $totalcalosci), array ( 'unique_id' => $idzamowienia ) );
	} else {
		$nowadata = date('Y-m-d H:i:s');
		$zmiana = $wpdb->update($fb_tablename_order, array ( 'status' => '6', 'date_modify' => $nowadata), array ( 'unique_id' => $idzamowienia ) );
	}
}

function print_devis_details($products, $prolog, $epilog, $writable, $statuszamowienia) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_remises = $prefix."fbs_remises";
	$fb_tablename_remisnew = $prefix."fbs_remisenew";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_comments_new = $prefix."fbs_comments_new";
	$fb_tablename_address = $prefix."fbs_address";
	$idzamowienia=$_GET['detail'];
	$query = $wpdb->get_row("SELECT *, DATE_FORMAT(date_modify, '%d/%m/%Y') AS datamodyfikacji FROM `$fb_tablename_order` WHERE unique_id='$idzamowienia'");

	$r = get_inscription2();

/* nowy komentarz, jesli tak ustawiamy jako przeczytany */
	$newcomment = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments_new` WHERE order_id = '$idzamowienia'");
	if ($newcomment) {
		$wpdb->query("DELETE FROM `$fb_tablename_comments_new` WHERE value='1' AND order_id='$idzamowienia'");
	}

if ($statuszamowienia != 3 && $statuszamowienia != 4 && $statuszamowienia != 5) {
	$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
	$view .= $prolog;
	$view .= $epilog;
	$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" alt="france banderole" class="logoprint2" /></td></tr><tr><td class="print-no">Devis Nº D - '.$idzamowienia.'</td></tr><tr><td class="text-center">DATE - '.$query->datamodyfikacji.'</td></tr></table></div>';
	if ($products) {
		if ( ($statuszamowienia < 3) OR ($statuszamowienia == 7) ) { //jesli moze jeszcze dodac plik
			$view .= get_filesender($produkty);
		}

		$produkty = $products;
		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th class="thqte"><th>Quantité</th><th>Prix  U.</th><th class="thopt">Option</th><th class="threm">Remise</th><th class="thtotal">Total</th></tr>';
		$licznik = 0;
		$kosztcalosci = 0;
		foreach ( $products as $products => $item ) {
			$licznik++;
			$view .= '
			<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td class="tdqte"><span class="disMob0">Quantité : </span> '.$item[quantity].'</td><td><span class="disMob0">Prix Unitaire : </span>'.$item[prix].'</td><td class="tdopt"><span class="disMob0">Options : </span>'.$item[prix_option].'</td><td class="tdrem"><span class="disMob0">Remise : </span>'.$item[remise].'</td><td class="tdtotal"><span class="disMob0">Total : </span>'.$item[total].'</td>';
			if ($writable) {
				$view .= '<td class="noprint"><form name="delvotre_form" id="delvotre_form" action="" method="post"><input type="hidden" name="delfromvotre" value="'.$item[id].'" /><input type="hidden" name="order_id" value="'.$item[order_id].'" /><button id="delcart" type="submit" onclick=\'if (confirm("'.esc_js( "Etes-vous sûr de vouloir retirer ce produit de votre commande?" ).'")) {return true;} return false;\'>DEL</button></form></td>';
			} else {
				$view .= '<td class="noprint"></td>';
			}
			$view .= '</tr>';
		}

// dodatkowy rabat wyswietl //
		$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestrabat) {
			$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
		}
// dodatkowy rabat wyswietl //
  		$view .= '</table>';
		$kosztorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$idzamowienia'");
//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
		  		$wysokoscrabatu = str_replace('.', ',', number_format($exist_remise->remisenew, 2));
				$cremisetd = '<tr><td class="toleft">REMISE ('.$exist_remise->percent.'%)</td><td class="toright">'.$wysokoscrabatu.' &euro;</td></tr>';
			}
//koniec//

 	  	$tfrais = str_replace('.', ',', $kosztorder->frais).' &euro;';
	  	$ttotalht = str_replace('.', ',', $kosztorder->totalht).' &euro;';
	  	$ttva = str_replace('.', ',', $kosztorder->tva).' &euro;';
	  	$ttotalttc = str_replace('.', ',', $kosztorder->totalttc).' &euro;';

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

		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
		'.$cremisetd.'
		<tr><td class="toleft">Frais de port</td><td class="toright">'.$tfrais.'</td></tr>
		<tr><td class="toleft">Total ht</td><td class="toright">'.$ttotalht.'</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$ttva.'</td></tr>
		<tr><td class="toleft">total ttc</td><td class="toright"><b>'.$ttotalttc.'</b></td></tr>
		</table>';

		$view .= '<table id="fbcart_address" border="0" cellspacing="0">
		<tr><th class="leftth">Adresse de facturation</th><th>Adresse de livraison</th></tr>
		<tr><td class="lefttd">'.stripslashes($epilog_1).'</td><td>'.stripslashes($epilog_0).'<a id="order_inscription" href="'.get_bloginfo("url").'/order-inscription/?goback='.$idzamowienia.'">Modifier adresse</a></td></tr>
		</table>';

		$view .= '<div class="bottomfak onlyprint"><i>RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i></div>'; // ajout devis

		// ajout des conditions générales de ventes à l'impression du devis papier
		$cgv = file_get_contents('https://www.france-banderole.com/wp-content/plugins/fbshop/printCGV.html');
		$view .= $cgv;

	} else {
		$view .= '<p style="position:relative;float:left;display:inline;width:100%;">'._FB_ANNUL.'</p>';
	}
//	$view .= $epilog;
//		$view .= '<div style="position:relative;float:left;display:inline;width:960px;">'.get_fb_comments().'</div>';
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

		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th></tr>';
		foreach ( $products as $products => $item ) {
			$licznik++;
			$view .= '
			<tr><td class="lefttd"><span class="name">'.$item[name].'</span><br /><span class="therest">'.$item[description].'</span></td><td class="tdqte"><span class="disMob0">Quantité : </span> '.$item[quantity].'</td><td><span class="disMob0">Prix Unitaire : </span>'.$item[prix].'</td><td class="tdopt"><span class="disMob0">Options : </span>'.$item[prix_option].'</td><td class="tdrem"><span class="disMob0">Remise : </span>'.$item[remise].'</td><td class="tdtotal"><span class="disMob0">Total : </span>'.$item[total].'</td>';
			$view .= '</tr>';
  		}
// dodatkowy rabat wyswietl //
		$czyjestrabat = $wpdb->get_row("SELECT * FROM `$fb_tablename_remises` WHERE unique_id = '$idzamowienia'");
		if ($czyjestrabat) {
			$view .= '<tr><td class="lefttd" colspan="5"><span class="name">'.$czyjestrabat->reason.'</span></td><td>'.$czyjestrabat->remis.' &euro;</td></tr>';
		}
// dodatkowy rabat wyswietl //
  		$view .= '</table>';
//sprawdzanie czy jest rabat dla uzytkownika//
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_remisnew` WHERE sku = '$idzamowienia'");
			if ($exist_remise) {
		  		$wysokoscrabatu = str_replace('.', ',', number_format($exist_remise->remisenew, 2));
				$cremisetd = '<tr><td class="toleft">REMISE ('.$exist_remise->percent.'%)</td><td class="toright">'.$wysokoscrabatu.' &euro;</td></tr>';
			}
//koniec//
	  	$tfrais = str_replace('.', ',', $query->frais).' &euro;';
	  	$ttotalht = str_replace('.', ',', $query->totalht).' &euro;';
	  	$ttva = str_replace('.', ',', $query->tva).' &euro;';
	  	$ttotalttc = str_replace('.', ',', $query->totalttc).' &euro;';
		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
		'.$cremisetd.'
		<tr><td class="toleft">Frais de port</td><td class="toright">'.$tfrais.'</td></tr>
		<tr><td class="toleft">Total ht</td><td class="toright">'.$ttotalht.'</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$ttva.'</td></tr>
		<tr><td class="toleft"">total ttc</td><td class="toright"><b>'.$ttotalttc.'</b></td></tr>
		</table>';
		if ($query->payment == 'cheque') { $method = 'CHÉQUE'; }
		if ($query->payment == 'bancaire') { $method = 'VIREMENT BANCAIRE'; }
		if ($query->payment == 'carte') { $method = 'CARTE BLEUE'; }
		if ($query->payment == 'administratif') { $method = 'VIREMENT ADMINISTRATIF'; }
		if ($query->payment == 'espece') { $method = 'ESPÉCE'; }
		if ($query->payment == 'trente') { $method = 'PAIEMENT A 30 JOURS'; }
		if ($query->payment == 'soixante') { $method = 'PAIEMENT A 60 JOURS'; }
		$view .= '<div class="bottomfak onlyprint">FACTURE REGLÉE PAR '.$method.'<br /><br /><i>RCS Aix en Provence: 510.605.140 - TVA INTRA: FR65510605140<br />Sas au capital de 15.000,00 &euro;</i></div>';

		// ajout des conditions générales de ventes à l'impression de la facture papier
		$cgv = file_get_contents('https://www.france-banderole.com/wp-content/plugins/fbshop/printCGV.html');
		$view .= $cgv; // ajout CGV
}
$view .= contact_advert();
return $view;
}

function getCartCount() {
	$ret = '0';
	if(!empty($_SESSION['fbcart'])) {
		$ret = count($_SESSION['fbcart']);
	}
	return $ret;
}

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
	$alert_content = '<div class="box_info noprint"><table><tr><td><img src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/pict_info.png" /></td><td><p><strong>CERTAINES DE VOS COMMANDES ATTENDENT DES RETOURS DE VOTRE PART</strong></p><p><ul>';

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

	$view .= '<h1>Accès client: Votre compte et devis</h1><hr />';
	$user = $_SESSION['loggeduser'];

	//Récupération des variables
	if ((isset($_GET['archive'])) AND ($_GET['archive'] == 1)) { $archive = 1;	} else { $archive = 0; 	}
	if (isset($_GET['pagination'])) { $page_act = $_GET['pagination'];	} else { $page_act = 1; }

	//Récupération conditionnelle de la liste des commandes

	$count_old = 0; $count_curr = 0;

	//$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' ORDER BY date DESC");
	$orders_old = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status = 5");
	$count_old = $wpdb->num_rows;
	$orders_curr = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status != 5 ORDER BY date DESC");
	$count_curr = $wpdb->num_rows;

	if ($archive) {
		$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status = 5 ORDER BY date DESC");
		//$count_o = $wpdb->num_rows;
		if ($count_old > 15) {
			$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status = 5 ORDER BY date DESC LIMIT ". 50*($page_act-1) .", 50");
		}
	} else {
		$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status != 5 ORDER BY date DESC");
		//$count_o = $wpdb->num_rows;
		if ($count_curr > 15) {
			$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status != 5 ORDER BY date DESC LIMIT ". 50*($page_act-1) .", 50");
			//$orders = $wpdb->get_results("SELECT *, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM `$fb_tablename_order` WHERE user='$user->id' AND status != 5 ORDER BY date DESC");
		}
	}

	if ($orders) {
		$view .= '<div id="votre"><div class="votre_tab_name">Bonjour, '.stripslashes($user->f_name).'!</div>
					<div class="votre_tab_content"><a href="'.get_bloginfo("url").'/inscription/" id="votre_mod"><i class="fa fa-wrench" aria-hidden="true"></i> Modifier mon compte
</a><a href="'.get_bloginfo("url").'/?logout=true" id="votre_dec"><i class="fa fa-times-circle" aria-hidden="true"></i>
 Se deconnecter </a></div>';


		// $view .= '<div class="votre_tab_name2">MES DEVIS ET COMMANDES :</div>
				  // </div>';

		$view .= '</div>';

		$view .= '<div class="votre_tab_head">';

		if ($archive) {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_inactive">VOS COMMANDES EN COURS ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_active">VOS ANCIENNES COMMANDES ('.$count_old.')</div></a>';
		} else {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_active">VOS COMMANDES EN COURS ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_inactive">VOS ANCIENNES COMMANDES ('.$count_old.')</div></a>';
		}



//		$view .= '<div class="votre_detail_text"><b>CLIQUEZ pour voir les détails</b></div>';
/*		$lastcomment = $wpdb->get_row("SELECT c.* FROM `$fb_tablename_comments` as c, `$fb_tablename_order` as o WHERE c.order_id = o.unique_id AND o.user = '$user->id' AND c.author='France Banderole' ORDER BY c.date DESC LIMIT 1");
		if ($lastcomment) {
			if (strlen($lastcomment->content) > 250) {
				$ostcomment = substr($lastcomment->content, 0, 250).'...';
			} else {
				$ostcomment = $lastcomment->content;
			}
			$idostcomment = $lastcomment->order_id;
			$linkcomment = '<br /><a class="lastcommentlink" href="'.get_bloginfo("url").'/vos-devis/?comment='.$lastcomment->order_id.'">Lire la suite...</a>';
			$view .= '<div id="votre2"><div class="votre_tab_name">DEMIER COMMENTAIRE:</div>
						<div class="votre_tab_content">'.$ostcomment.$linkcomment.'</div>
					  </div>';
		}
*/

		//Switch Archive/Non Archive

		// if ($archive) {
			// $view .= '<p style="clear: both;"><a href="vos-devis?archive=0">Vos commandes en cours</a> | <strong>&middot; <a href="vos-devis?archive=1">Commandes archivées</a> &middot;</strong></p>';
		// } else {
			// $view .= '<p style="clear: both;"><strong>&middot; <a href="vos-devis?archive=0">Vos commandes en cours</a> &middot;</strong> | <a href="vos-devis?archive=1">Commandes archivées</a></p>';
		// }

		$view .= '<table id="fbcart_votre" cellspacing="0">';

		// $view .= '<tr><td colspan="6">HEADER</td></tr>';

		$view .= '<tr><th class="leftth">VOIR LE DEVIS<br />OU LA COMMANDE</th><th class="tddesc">DESCRIPTION</th><th>N° DE COMMANDE</th><th>PRIX</th><th>DATE</th><th>ETAT</th></tr>';
		foreach ($orders as $o) :
			$view .= '<tr>';
			$view .= '<td class="lefttd">';
			//if ($o->status != 6) {
				$view .= '<form name="detailinfo" id="detailinfo" action="" method="GET"><input type="hidden" name="detail" value="'.$o->unique_id.'" /><button class="but_details" title="Télécharger des fichiers, Envoyer et voir les commentaires, Voir les maquettes, Imprimer les factures..." type="submit">
 				<span class="split"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Gérer la</span> commande</button></form>';
			//}
			$view .= '</td>';
			$view .= '<td class="tddesc"><div class="kontener">';
			if ($o->status != 6) {
				$status = print_status_form($o->status, $o->unique_id);
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
//			if (($o->unique_id == $idostcomment)) {
//				$view .= '<a href="'.get_bloginfo("url").'/vos-devis/?detail='.$idostcomment.'" class="lcomment"></a>';
//			}

			$comment_new = '';
			$newcomment = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments_new` WHERE order_id = '$o->unique_id'");
			if ($newcomment) {
				$newcomment2 = $wpdb->get_row("SELECT * FROM `$fb_tablename_comments` WHERE order_id = '$o->unique_id' AND author='France Banderole' ORDER BY date DESC LIMIT 1");
				if ($newcomment2) {
					$comment_new = '<br /><span class="comment_new">NOUVEAU <span class="split">MESSAGE !</span></span>';
				}
			}

			$view .= '</div></td><td>'.$o->unique_id.'</td><td>'.$o->totalttc.' &euro;</td><td>'.$o->data.'</td><td>'.$status.$comment_new.'</td>';
			$view .= '</tr>';
		endforeach;
		$view .= '</table>';

		//Pagination au besoin

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


		// $view .= '<div class="votre_tab_name2">MES DEVIS ET COMMANDES :</div>
				  // </div>';

		$view .= '</div>';

		$view .= '<div class="votre_tab_head">';

		if ($archive) {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_inactive">VOS COMMANDES EN COURS ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_active">VOS ANCIENNES COMMANDES ('.$count_old.')</div></a>';
		} else {
			$view .= '<a href="vos-devis?archive=0"><div class="votre_tab_active">VOS COMMANDES EN COURS ('.$count_curr.')</div></a><a href="vos-devis?archive=1"><div class="votre_tab_inactive">VOS ANCIENNES COMMANDES ('.$count_old.')</div></a>';
		}

		if ($archive) {
			$view .= '<div style="float: left;"><p>Vous n\'avez aucune commande archivée.</p></div>';
		} else {
			$view .= '<div style="float: left;"><p>Vous n\'avez aucune commande en cours.</p></div>';
		}

		$view .= '</div>';




	} else {
		$view .= '<div id="votre"><div class="votre_tab_name">Bonjour, '.$user->f_name.'!</div>
					<div class="votre_tab_content"><a href="'.get_bloginfo("url").'/inscription/" id="votre_mod"><i class="fa fa-wrench" aria-hidden="true"></i> Modifier mon compte</a><a href="'.get_bloginfo("url").'/?logout=true" id="votre_dec"><i class="fa fa-times-circle" aria-hidden="true"></i> Se deconnecter</a></div>
				  </div><p style="position:relative;float:left;display:block;width:100%;padding-top:20px;">'._FB_NZAM.'</p></div>';
	}
  }
  return $view;
}

function print_status_form($status, $cmd) {
	$formatted .= '<form name="detailinfo" id="detailinfo" action="" method="GET"><input type="hidden" name="detail" value="'.$cmd.'" /><button class="stat'.$status.'" title="Télécharger des fichiers, Envoyer et voir les commentaires, Voir les maquettes, Imprimer les factures..." type="submit">';
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
	$formatted .= '</button></form>';
	return $formatted;
}

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

function add_to_db() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_prods = $prefix."fbs_prods";
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$fb_tablename_remisenew = $prefix."fbs_remisenew";
	$fb_tablename_cf = $prefix."fbs_cf";
	$fb_tablename_address = $prefix."fbs_address";

		if (is_cart_not_empty() && fb_is_logged()) {
			$products = $_SESSION['fbcart'];

			/* On teste que le cart contienne un produit colis revendeur*/
			$retrait_atelier = recursive_array_search("retrait colis a l", $_SESSION['fbcart']);


			/* On teste que le cart contienne un produit colis revendeur*/
			$colis_revendeur = recursive_array_search("colis revendeur", $_SESSION['fbcart']);


			/* On teste que le cart contienne bien un produit en relais colis*/
			$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);

			$user = $_SESSION['loggeduser'];
			foreach ( $products as $products => $item ) {
				$koszttotal = str_replace(',', '.', $item[total]);
				$kosztcalosci = $kosztcalosci + $koszttotal;
				$transportcalosci = $transportcalosci + $item[transport];
			}
//sprawdzanie czy jest rabat dla uzytkownika//
			$uid = $user->id;
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = '$uid'");
			if ($exist_remise) {
				$client_remise = $exist_remise->att_value;
				if (!empty($client_remise) && $client_remise != '0') {
					$newrabat = $client_remise / 100;
					$wysokoscrabatu = $kosztcalosci * $newrabat;
					$kosztcalosci = $kosztcalosci - $wysokoscrabatu;
				}
			}
//koniec//
			$kosztcalosci = $kosztcalosci + $transportcalosci;
	  		$podatekcalosci = $kosztcalosci*0.200;
	  		$totalcalosci = $kosztcalosci+$podatekcalosci;
	  		$kosztcalosci = number_format($kosztcalosci, 2);
	  		$transportcalosci = number_format($transportcalosci, 2);
	  		$podatekcalosci = number_format($podatekcalosci, 2);
	  		$totalcalosci = number_format($totalcalosci, 2);
	  		$unique_id = random_string();
			$data = date('Y-m-d H:i:s');
			$dodaj_zamowienie = $wpdb->query("INSERT INTO `$fb_tablename_order` VALUES (not null, '".$unique_id."', '".$transportcalosci."', '".$kosztcalosci."', '".$podatekcalosci."', '".$totalcalosci."', '".$data."', '".$data."', '".$user->id."', '', '0', '', '','')");
			//ICI PLACER L'AJOUT A MAILJET
			createContact($user->email);
			$mj_list = getListId('Tous clients');
			$mj_user = getIdFromEmail($user->email);
			abonnerListe($mj_user,$mj_list);



			if ($dodaj_zamowienie) {
				if (!empty($client_remise) && ($client_remise != '0')) {
					$dodaj_nowyrabat = $wpdb->query("INSERT INTO `$fb_tablename_remisenew` VALUES (not null, '".$unique_id."', '".$client_remise."', '".$wysokoscrabatu."')");
					if ($dodaj_nowyrabat) { }
				}
				$ktomakiete = 0;
				$czyfbrobimakiete = 0;
				$products = $_SESSION['fbcart'];
				foreach ( $products as $products => $item ) {
					$wzorzec = '/j’ai déjà crée la maquette/';
					$ktomak = preg_match_all($wzorzec, $item[description], $wynik);
					$ktomak = count($wynik[0]);
					if ($ktomak >= 1) {
						$ktomakiete = 0;
					} else {
						$ktomakiete = 1;
					}
					if ($ktomakiete == 1) $czyfbrobimakiete = 1;
					$dodaj_produkt = $wpdb->query("INSERT INTO `$fb_tablename_prods` VALUES (not null, '".$unique_id."', '".$item[rodzaj]."', '".$item[opis]."', '".$item[ilosc]."', '".$item[prix]."', '".$item[option]."', '".$item[remise]."', '".$item[total]."', '".$item[transport]."', '', '1')");
				}
				if ($dodaj_produkt) {
					unset($_SESSION['fbcart']);
				}
				if ($czyfbrobimakiete == 0) {
					$letter = "Bonjour et bienvenue sur France banderole !\r\n\r\nConservez soigneusement le nom d'utilisateur et mot de passe que vous avez choisi, ils vous serviront pour vous connecter à votre accès client et suivre en direct l'évolution de vos devis et commandes.\r\nEn cliquant sur GESTION DÉTAILLÉE dans vos devis, vous accédez à l'interface de communication, vous pouvez alors :\r\n- Envoyer vos fichiers ou explicatifs via le module de téléchargement (maximum 100mo). \r\n- Envoyer des commentaires directement au service d'infographie de France banderole et lire les réponses.\r\n- Visualiser votre ou vos maquette(s) de validation (BAT) avant de procéder à votre règlement.\r\n- Payer votre commande par carte bleue sécurisée en ligne, chèque ou virement bancaire.\r\n- Suivre l'expédition de votre colis et imprimer vos factures.\r\n\r\nLes délais de fabrication/livraison sont de 6 à 9 jours ouvrés maximum à compter de la réception de votre règlement.\r\nVous pouvez également contacter un conseiller commercial au 0442.401.401 pour mettre en place un délai Rush qui vous permet de faire passer votre commande en priorité. Elle sera alors fabriquée et expédiée en 24/48 ou 72H !\r\nDans l'espoir d'avoir répondu à vos premières questions, nous vous souhaitons une agréable navigation sur notre site web.\r\nAmicalement,\r\nL'équipe France banderole.\r\n http://www.france-banderole.com";
					$lettert = "Fonctionnement général de votre accès client";
				} else {
					$letter = "Bonjour et bienvenue sur France banderole !\r\n\r\nConservez soigneusement le nom d'utilisateur et mot de passe que vous avez choisi, ils vous serviront pour vous connecter à votre accès client et suivre en direct l'évolution de vos devis et commandes.\r\nEn cliquant sur GESTION DÉTAILLÉE dans vos devis, vous accédez à l'interface de communication, vous pouvez alors :\r\n- Envoyer vos fichiers ou explicatifs via le module de téléchargement (maximum 100mo). \r\n- Envoyer des commentaires directement au service d'infographie de France banderole et lire les réponses.\r\n- Visualiser votre ou vos maquette(s) de validation (BAT) avant de procéder à votre règlement.\r\n- Payer votre commande par carte bleue sécurisée en ligne, chèque ou virement bancaire.\r\n- Suivre l'expédition de votre colis et imprimer vos factures.\r\n\r\nLes délais de fabrication/livraison sont de 6 à 9 jours ouvrés maximum à compter de la réception de votre règlement.\r\nVous pouvez également contacter un conseiller commercial au 0442.401.401 pour mettre en place un délai Rush qui vous permet de faire passer votre commande en priorité. Elle sera alors fabriquée et expédiée en 24/48 ou 72H !\r\nDans l'espoir d'avoir répondu à vos premières questions, nous vous souhaitons une agréable navigation sur notre site web.\r\nAmicalement,\r\nL'équipe France banderole.\r\n http://www.france-banderole.com";
					$lettert = "Fonctionnement général de votre accès client";
				}
				$header = 'From: FRANCE BANDEROLE <information@france-banderole.com>';
        		$header .= "\nContent-type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
		        //mail($user->email, $lettert, $letter, $header);
		        wp_mail($user->email, $lettert, $letter);
			}


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

			/* Ajout de l'indicateur "relais" dans le champ "type" et numéro de relais dans le champ "Value" la table "fbs_cf" & ajout adresse du relais colis dans la table "fbs_address"
			et ajout de l'adresse de livraison dans la table "fbs_users */
			/*mail("contact@tempopasso.com","Session_Loggedusers dans add_to_db function",print_r($_SESSION,true)."REQ=".
								"SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$unique_id' AND user = '$uid'");
			*/

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
