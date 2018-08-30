<?php

function get_inscription() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$tb_nlet = $prefix."nlet_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	if ( $_GET['send'] == 'confirm' ) {
		$user = $_GET['user'];
		if ($user) {
			$czynieistnieje = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE login='$user' AND status=0");
			if ($czynieistnieje) {
				$kod = $czynieistnieje->confirm_link;
				$letter = ""._FB_THANK.", $login!\r\n\r\n"._FB_POTWIERDZENIE."\r\n".get_bloginfo('url')."/inscription/?verify=confirm&unique=".$kod."\r\n\r\nAmicalement,\r\nL’équipe FRANCE BANDEROLE";
				$header = 'From: France Banderole <information@france-banderole.com>';
				$header .= "\nContent-type: text/plain; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
				//mail($czynieistnieje->email, "france-banderole.com Inscription", $letter, $header);
				wp_mail($czynieistnieje->email, "Inscription France Banderole", $letter);
				$view .= '<p>'._FB_PRZESLANY.'</p>';
			}
		}

	} elseif ( $_GET['verify'] == 'confirm' ) {
		$weryfikuj = $wpdb->update($fb_tablename_users, array ( 'status' => '1'), array ( 'confirm_link' => $_GET['unique'] ) );
		if ($weryfikuj) {
			$view .= '<p>'._FB_ZWER.'</p><p>'._FB_CLICK.' <a href="'.get_bloginfo('url').'/acces-client/">'._FB_THERE.'</a>'._FB_TOLOG.'</p>';
		} else {
			$view .= '<p>'._FB_NZWER.'</p>';
		}

	} elseif ( ($_POST['formID'] == 'registerform') && (!isset($_SESSION['fbreguser'])) ) {
		$login = $_POST['login'];
		$email = $_POST['email'];
		$f_name = $_POST['f_name'];
		$f_comp = $_POST['f_comp'];
		$f_address = $_POST['f_address'];
		$f_porte = $_POST['f_porte'];
		$f_code = $_POST['f_code'];
		$f_city = $_POST['f_city'];
		$f_phone = $_POST['f_phone'];
		$f_siret = $_POST['f_siret'];
		$f_epub = $_POST['f_epub'];
		$f_group = $_POST['f_group'];
		$newslet = 0;

		$alertPostcode = '';
		if (substr($f_code, 0, 2) == '97' || substr($f_code, 0, 2) == '98')
		$alertPostcode = '<div class="alertRegister">
		Nous livrons en France métropolitaine et vous avez enregistré une adresse de facturation dans les DOM/TOM:
		Les devis exports doivent porter sur un minimum de 1200,00€ht de produits bruts hors frais de port conformement à nos C.G.V.
		Vous avez la possibilité de valider votre devis de 2 façons :
		Soit en fournissant une adresse de livraison en France métropolitaine (modifier mon compte ou ajouter une adresse de livraison), votre devis sera alors autorisé et vous serez facturé en ttc.
		Soit modifier le nombre de produits pour arriver au 1200,00€ht de commande hors frais de port.
		Dans l\'attente de vous lire,
		Cordialement,
		le service client.
		</div>';

		if (isset($_POST['news'])){
			$newslet = 1;
		}

		if ($_POST['input_11'] == 'true') { // vérifier l'adresse de livraison existe
			$l_name = $_POST['l_name'];
			$l_comp = $_POST['l_comp'];
			$l_address = $_POST['l_address'];
			$l_porte = $_POST['l_porte'];
			$l_code = $_POST['l_code'];
			$l_city = $_POST['l_city'];
			$l_phone = $_POST['l_phone'];

		} else {
			$l_name = "";
			$l_comp = "";
			$l_address = "";
			$l_porte = "";
			$l_code = "";
			$l_city = "";
			$l_phone = "";
		}

		//akcja=action
		if ($_POST['akcja'] == 'edit') {
			if (isset($_POST['loggeduserid']) && $_POST['akcja'] == 'edit') {

				if (!empty($f_porte)) {
					$f_address = $f_address.'| '.$f_porte;
				}
				if (!empty($l_porte)) {
					$l_address = $l_address.'| '.$l_porte;
				}
				if ($_POST['pass'] != '') {
					$pass = sha1(md5($_POST['pass']));
					$kolejka = $wpdb->update($fb_tablename_users, array ( 'pass' => $pass, 'email' => $email, 'f_name' => $f_name, 'f_comp' => $f_comp, 'f_address' => $f_address, 'f_code' => $f_code, 'f_city' => $f_city, 'f_phone' => $f_phone, 'l_name' => $l_name, 'l_comp' => $l_comp, 'l_address' => $l_address, 'l_code' => $l_code, 'l_city' => $l_city, 'l_phone' => $l_phone, 'newsletter' => $newslet ), array ('id' => $_POST['loggeduserid']) );

				} else {
					$kolejka = $wpdb->update($fb_tablename_users, array ( 'email' => $email, 'f_name' => $f_name, 'f_comp' => $f_comp, 'f_address' => $f_address, 'f_code' => $f_code, 'f_city' => $f_city, 'f_phone' => $f_phone, 'l_name' => $l_name, 'l_comp' => $l_comp, 'l_address' => $l_address, 'l_code' => $l_code, 'l_city' => $l_city, 'l_phone' => $l_phone, 'newsletter' => $newslet ), array ('id' => $_POST['loggeduserid']) );
				}

				//$new_user = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE email = '".$email."'");
				$new_user = $_POST['loggeduserid'];
				$add_group = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value = '$f_group' WHERE uid = '$new_user' AND att_name = 'client_groupe'");
				if (!empty($f_siret)) {
					$setup_siret = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value = '$f_siret' WHERE uid = '$new_user' AND att_name = 'client_siret'");
					if(!($setup_siret)) {
						$setup_siret = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$new_user."','client_siret','".$f_siret."')");
					}
				}
				if (!empty($f_epub)) {
					$setup_epub = $wpdb->query("UPDATE `$fb_tablename_users_cf` SET att_value = '$f_epub' WHERE uid = '$new_user' AND att_name = 'client_epub'");
					if(!($setup_epub)) {
						$setup_epub = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$new_user."','client_epub','".$f_epub."')");
					}
				}
				$view .= '<p class="box_info">'._FB_EDIT_OK.'</p>';
				$sprawdz = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '$new_user'");
				$_SESSION['loggeduser'] = $sprawdz;
				$_SESSION['loggeduser']->logme = "yes";

			} else {
				$view .= '<p>'._FB_ERROR.'</p>';
			}

		} else {
			$pass = sha1(md5($_POST['pass']));
			$czynieistnieje = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE login='$login' OR email='$email'");

			if ($czynieistnieje) {
				if ($czynieistnieje->login == $login) {
					$view .= '<p>'._FB_EXIS.'</p>';
				}
				if ($czynieistnieje->email == $email) {
					$view .= '<p>'._FB_EXISE.'</p>';
				}

			} else {
				$kod = uniqid(rand());
				$dodaj = $wpdb->query("INSERT INTO `$fb_tablename_users` VALUES (not null, '".$login."', '".$email."', '".$pass."', '".$f_name."', '".$f_comp."', '".$f_address."', '".$f_code."', '".$f_city."', '".$f_phone."', '".$l_name."', '".$l_comp."', '".$l_address."', '".$l_code."', '".$l_city."', '".$l_phone."', '1', '".$kod."', '', '".$newslet."')");

				if ($dodaj) { //dodaj=ajouter
					$nemail = addslashes($email);
					$nf_name = addslashes(f_name);
					$dodajnews = $wpdb->query("INSERT INTO `$tb_nlet` VALUES (not null, '".$nemail."', '".$nf_name."', '".time()."', 'new')");
					//Ajout traitement du groupe client
					$new_user = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE email = '".$email."'");
					$add_group = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$new_user->id."','client_groupe','".$f_group."')");

					if (!empty($f_siret)) {
						$setup_siret = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$new_user->id."','client_siret','".$f_siret."')");
					}

					if (!empty($f_epub)) {
						$setup_epub = $wpdb->query("INSERT INTO `$fb_tablename_users_cf` VALUES ('','".$new_user->id."','client_epub','".$f_epub."')");
					}

					$view .= get_acces_panel(2);
					unset($_SESSION['fbreguser']);
				}
			}
		}

	} else {

		if (fb_is_logged()) {
			$view .= '<h1><i class="fa fa-lock"></i> Accès Client: Modifier mon compte</h1><hr />';
			//$view .= '<p>Note : La modification de votre adresse e-mail est impossible. En cas de changement de cette dernière, merci de contacter un administrateur.</p>';

		} else {
			$view .= '<h1><i class="fa fa-lock"></i> Accès Client: Inscription</h1><hr />';
		}

		if (fb_is_logged()) {
			$user = $_SESSION['loggeduser'];
			$user_groupe = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '$user->id' AND att_name = 'client_groupe'");
			$user_epub = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '$user->id' AND att_name = 'client_epub'");
			$user_siret = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '$user->id' AND att_name = 'client_siret'");
			$action = '<input type="hidden" name="akcja" value="edit" /><input type="hidden" name="loggeduserid" value="'.$user->id.'" />';

			if ($user->l_name || $user->l_city || $_GET['liv'] == '1') {
				$islivraison = ' checked="checked"';
				$islivraisonvisible = 'style="visibility:visible"';
			}

			$passrequire = ""; //si vous modifiez vous ne devez pas changer le mot de passe
			$reginfo = ' style="display:none"';

		} else {
			$action = '';
			$user = '';
			$islivraison = '';
			$islivraisonvisible = '';
			$passrequire = "required, "; //si vous ne devez pas spécifier un mot de passe des modifications
			$reginfo = ' class="reg_info"';
		}

		$explode = explode('|', $user->f_address);
		$f_address = $explode['0'];
		$f_porte = $explode['1'];
		$explode2 = explode('|', $user->l_address);
		$l_address = $explode2['0'];
		$l_porte = $explode2['1'];

		$goaction = '';

		if (isset($_GET['goback'])) {
			$goaction = get_bloginfo('url').'/vos-devis/?detail='.$_GET['goback'];
		}

		$view .= '
		<form action="'.$goaction.'" method="post" name="form_registerform" id="registerform" accept-charset="utf-8">
		<input type="hidden" name="formID" value="registerform" />'.$action.'';

		if (!isset($_GET['goback'])) {

			$view .= '
			<div class="acces_left" >
			<div class="acces_tab_name">VOTRE COMPTE</div>
			<div class="acces_tab_content2">
			<ul class="regiform">';

			if(fb_is_logged()) {
				$view .= '<p id="mailOrigin" style="visibility: hidden; display: none;">'.$user->email.'</p>';
				$view .= '
				<li class="form-line" id="id_1">
				<label class="registerlabel" id="label_1" for="input_1">adresse e-mail:</label>
				<input type="text" class="registerinput validate[required, Email]" id="input_1" name="email" value="'.$user->email.'" />
				</li>
				<li class="form-line" id="id_2">
				<label class="registerlabel" id="label_2" for="input_2">nom d\'utilisateur:</label>
				<input type="text" class="registerinput v" id="input_2" name="login" value="'.$user->login.'" disabled />
				<span class="info_unique">uniquement chiffres et lettres</span>
				</li>';

			} else {
				$view .= '
				<li class="form-line" id="id_1">
				<label class="registerlabel" id="label_1" for="input_1">adresse e-mail:</label>
				<input type="text" class="registerinput validate[required, Email]" id="input_1" name="email" value="'.$user->email.'" />
				</li>
				<li class="form-line" id="id_2">
				<label class="registerlabel" id="label_2" for="input_2">nom d\'utilisateur:</label>
				<input type="text" class="registerinput validate[required, AlphaNumeric]" id="input_2" name="login" value="'.$user->login.'" />
				<span class="info_unique">uniquement chiffres et lettres</span>
				</li>';
			}
			$view .= '
			<li class="form-line" id="id_3">
			<label class="registerlabel" id="label_3" for="input_3">mot de passe:</label>
			<input type="password" class="registerinput validate['.$passrequire.'AlphaNumeric]" id="input_3" name="pass" />
			<span class="info_unique">uniquement chiffres et lettres</span>
			</li>
			<li class="form-line" id="id_4">
			<label class="registerlabel" id="label_4" for="input_4">confirmation<br />mot de passe:</label>
			<input type="password" class="registerinput validate['.$passrequire.'AlphaNumeric]" id="input_4" name="pass2" />
			</li>
			</ul>
			</div>

			<div class="acces_tab_name3">vos données personnelles</div>
			<div class="acces_tab_content2">
			<ul class="checkform">
			<li class="form-line ch" id="id_cgu">
			<p class="checklab">Accepter les <a href="'.get_bloginfo('url').'/cgu" class="modal-link">conditions générales d\'utilisation <i class="fa  fa-info-circle" aria-hidden="true"></i></a> :</p>
			<label class="switch checklabel" id="label_cgu" for="input_cgu">
			<input type="checkbox" class="registercheck  validate[required]" id="input_cgu" name="cgu" checked />
			<span class="slider round"></span>
			</label>
			</li>

			<li class="form-line ch" id="id_cook">
			<p class="checklab">Accepter les <a href="'.get_bloginfo('url').'/cookies" class="modal-link">cookies <i class="fa  fa-info-circle" aria-hidden="true"></i></a> :</p>
			<label class="switch checklabel" id="label_cook" for="input_cook">
			<input type="checkbox" class="registercheck validate[required]" id="input_cook" name="cook" checked />
			<span class="slider round"></span>
			</label>
			</li>

			<li class="form-line ch" id="id_news">
			<p class="checklab">Recevoir nos offres promotionnelles par mail :</p>
			<label class="switch checklabel" id="label_news" for="input_news">
			<input type="checkbox" class="registercheck" id="input_news" name="news" checked />
			<span class="slider round"></span>
			</label>
			</li>

			</ul>
			<p class="smallit" style="clear:both">France Banderole s’engage pour la protection de vos données personnelles en respectant le Règlement Général de la Protection des données (RGPD):<br />
			<span><a href="'.get_bloginfo('url').'/politique-de-confidentialite-france-banderole/" class="modal-link">Notre politque de confidentialité <i class="fa  fa-info-circle" aria-hidden="true"></i></a></span></p>

			</div>

			</div>';

		} else {
			$view .= '<input type="hidden" name="email" value="'.$user->email.'" /><input type="hidden" name="login" value="'.$user->login.'" />';
		}
		$view .= '
		<div class="acces_right">
		<div class="acces_tab_name2">VOTRE ADRESSE DE FACTURATION</div>
		<div class="acces_tab_content2">
		<ul class="regiform2">
		<li class="form-line" id="id_30">
		<label class="registerlabel" id="label_30" for="cl_group">vous êtes un(e)... ?</label>
		<select class="registerinput validate[required]" id="cl_group" name="f_group" onchange="champsReq();" />';
		if($user_groupe->att_value == 'PART') {
			$view .= '<option value="PART" selected>Particulier</option>';
		} else {
			$view .= '<option value="PART">Particulier</option>';
		}
		if($user_groupe->att_value == 'ASSO') {
			$view .= '<option value="ASSO" selected>Association</option>';
		} else {
			$view .= '<option value="ASSO">Association</option>';
		}
		if($user_groupe->att_value == 'COM') {
			$view .= '<option value="COM" selected>Agence de communication / publicité</option>';
		} else {
			$view .= '<option value="COM">Agence de communication / publicité</option>';
		}
		if($user_groupe->att_value == 'TPE') {
			$view .= '<option value="TPE" selected>TPE / Secteur privé</option>';
		} else {
			$view .= '<option value="TPE">TPE / Secteur privé</option>';
		}
		if($user_groupe->att_value == 'PME') {
			$view .= '<option value="PME" selected>PME / PMI</option>';
		} else {
			$view .= '<option value="PME">PME / PMI</option>';
		}
		if($user_groupe->att_value == 'EPUB') {
			$view .= '<option value="EPUB" selected>Etablissement public</option>';
		} else {
			$view .= '<option value="EPUB">Etablissement public</option>';
		}
		$view .= '
		</select>
		</li>';

		if($user_siret) {
			$view .= '<li class="form-line" id="siret_pick">
			<label class="registerlabel" id="label_32" for="input_32">n° SIRET:</label>
			<input type="text" class="registerinput validate[required, Numeric]" id="input_32" name="f_siret" value="'.stripslashes($user_siret->att_value).'" />
			</li>';

		} else {
			$view .= '<li class="form-line" id="siret_pick" style="visibility: hidden; display: none;>
			<label class="registerlabel" id="label_32" for="input_32">n° SIRET:</label>
			<input type="text" class="registerinput validate[required, Numeric]" id="input_32" name="f_siret" />
			</li>';
		}

		if($user_epub) {
			$view .= '<li class="form-line" id="epub_pick">
			<label class="registerlabel" id="label_33" for="input_33">Trésor public<br /> payeur:</label>
			<input type="text" class="registerinput validate[required]" id="input_33" name="f_epub" value="'.stripslashes($user_epub->att_value).'" />
			</li>';

		} else {
			$view .= '<li class="form-line" id="epub_pick" style="visibility: hidden; display: none;">
			<label class="registerlabel" id="label_33" for="input_33">Trésor public<br /> payeur:</label>
			<input type="text" class="registerinput validate[required]" id="input_33" name="f_epub" />
			</li>';
		}

		$view .= '
		<li class="form-line" id="id_5">
		<label class="registerlabel" id="label_5" for="input_5">prénom et nom:</label>
		<input type="text" class="registerinput validate[required]" id="input_5" name="f_name" value="'.stripslashes($user->f_name).'" />
		</li>
		<li class="form-line" id="id_6">
		<label class="registerlabel" id="label_6" for="input_6">société:</label>
		<input type="text" class="registerinput" id="input_6" name="f_comp" value="'.stripslashes($user->f_comp).'" />
		</li>

		<li class="form-line" id="id_7">
		<label class="registerlabel" id="label_7" for="input_7">adresse <br />de facturation:</label>
		<input type="text" class="registerinput validate[required]" id="input_7" name="f_address" value="'.stripslashes($f_address).'" />
		</li>
		<li class="form-line" id="id_7a">
		<label class="registerlabel" id="label_7a" for="input_7a">code <br />porte/esc./etc:</label>
		<input type="text" class="registerinput" id="input_7a" name="f_porte" value="'.stripslashes($f_porte).'" />
		</li>
		<li class="form-line" id="id_8">
		<label class="registerlabel" id="label_8" for="input_8">code postal:</label>
		<input type="text" class="registerinput validate[required]" id="input_8" name="f_code" value="'.stripslashes($user->f_code).'" />
		</li>
		<li class="form-line" id="id_9">
		<label class="registerlabel" id="label_9" for="input_9">ville:</label>
		<input type="text" class="registerinput validate[required]" id="input_9" name="f_city" value="'.stripslashes($user->f_city).'" />
		</li>
		<li class="form-line" id="id_10">
		<label class="registerlabel" id="label_10" for="input_10">tel. de contact:</label>
		<input type="text" class="registerinput validate[required]" id="input_10" name="f_phone" value="'.stripslashes($user->f_phone).'" />
		</li>
		<li class="form-line" id="id_11">
		<label class="registerWarning" for="input_11"><b>VOS ADRESSES DE LIVRAISON SONT GEREES DIRECTEMENT DANS VOS DEVIS ET COMMANDES ENREGISTREES.</b></label>
		<input style="position:absolute;bottom:5px;right:86px;visibility:hidden;" type="checkbox"'.$islavraison.' class="form-checkbox" id="sprawdzrejestr" name="input_11"'.$islivraison.' value="true" onclick="sprawdzrejestracje();" />
		</li>
		</ul>
		</div>';
		if (!isset($_GET['goback'])) {

			$view .= '
			<div class="acces_tab_content2" style="min-height:0;">
			<ul class="regiform">';

			if(fb_is_logged()) {

				$view .= '
				<li class="form-line" id="id_21">
				<div class="form-input-wide">
				<div class="pushButton">
				<button id="input_21" type="submit" class="edit-button" style="margin-top:0;"><i class="fa fa-save"></i> enregistrer</button>
				</div>
				</div>
				</li>
				<li style="display:none;">
				Should be Empty:
				<input type="text" name="website" value="" />
				</li>
				</ul>
				</div>
				</div>';

			} else {
				$view .= '
				<li class="form-line" id="id_20">
				<div class="antiSpam">
				ANTI-SPAM, merci de cocher la case ci-dessous:<br/>
				<div class="g-recaptcha" data-sitekey="6LfnzAgTAAAAADWbNyD5geBFVGSQ_cp1NP1yiBV8"></div>
				</div>
				</li>
				<li class="form-line" id="id_21">
				<div class="form-input-wide">
				<div class="pushButton">
				<button id="input_21" type="submit" class="register-button"><i class="fa fa-pencil-square-o"></i> Inscription</button>
				</div>
				</div>
				</li>
				<li style="display:none;">
				Should be Empty:
				<input type="text" name="website" value="" />
				</li>
				</ul>
				</div>
				</div>';
			}

		} else {
			$view .= '
			<div id="fbcart_buttons">
			<ul class="regiform">
			<li class="form-line" id="id_21">
			<div class="form-input-wide">

			<button id="input_22" type="submit" class="register-button2"><i class="fa fa-pencil-square-o"></i> Modifier</button>

			</div>
			</li>
			</ul>
			</div>
			</div>';
		}
		$view .= '
		<div class="acces_right" id="registerform_adresselivraison"'.$islivraisonvisible.'>
		<div class="acces_tab_name2">ADRESSE DE LIVRAISON</div>
		<div class="acces_tab_content2">
		<ul class="regiform2">
		<li class="form-line" id="id_12">
		<label class="registerlabel" id="label_12" for="input_12">prénom et nom:</label>
		<input type="text" class="registerinput" id="input_12" name="l_name" value="'.stripslashes($user->l_name).'" />
		</li>
		<li class="form-line" id="id_13">
		<label class="registerlabel" id="label_13" for="input_13">société:</label>
		<input type="text" class="registerinput" id="input_13" name="l_comp" value="'.stripslashes($user->l_comp).'" />
		</li>
		<li class="form-line" id="id_14">
		<label class="registerlabel" id="label_14" for="input_14">adresse <br />de livraison:</label>
		<input type="text" class="registerinput" id="input_14" name="l_address" value="'.stripslashes($l_address).'" />
		</li>
		<li class="form-line" id="id_14a">
		<label class="registerlabel" id="label_14a" for="input_14a">code<br />porte/esc./etc:</label>
		<input type="text" class="registerinput" id="input_14a" name="l_porte" value="'.stripslashes($l_porte).'" />
		</li>
		<li class="form-line" id="id_15">
		<label class="registerlabel" id="label_15" for="input_15">code postal:</label>
		<input type="text" class="registerinput" id="input_15" name="l_code" value="'.stripslashes($user->l_code).'" />
		</li>
		<li class="form-line" id="id_16">
		<label class="registerlabel" id="label_16" for="input_16">ville:</label>
		<input type="text" class="registerinput" id="input_16" name="l_city" value="'.stripslashes($user->l_city).'" />
		</li>
		<li class="form-line" id="id_17">
		<label class="registerlabel" id="label_17" for="input_17">tel. de contact:</label>
		<input type="text" class="registerinput" id="input_17" name="l_phone" value="'.stripslashes($user->l_phone).'" />
		</li>
		</ul>
		</div>
		</div>';

		if (!isset($_GET['goback'])) {
			$view .= '
			<input type="hidden" id="simple_spc" name="simple_spc" value="registerform" />
			<script type="text/javascript">
			document.getElementById("si" + "mple" + "_spc").value = "registerform-registerform";
			</script>';
		}
		$view .= '</form>';
	}
	return $view;
}

////////////////////////////////////////////////////////////////////////////////
//                             CARNET D'ADRESSES                              //
////////////////////////////////////////////////////////////////////////////////

// fonction pour sauvegarder les adresses dans les tables address2, address3 etc.
function saveAddress($table) {
	global $wpdb;
	$prefix = $wpdb->prefix;

	$wpdb->query("INSERT INTO `$table` VALUES (not null, '".$_SESSION['loggeduser']->id."', '".$_POST['orderid']."', '".$_POST['l_name']."', '".$_POST['l_comp']."', '".$_POST['l_address']."', '".$_POST['l_code']."', '".$_POST['l_city']."', '".$_POST['l_phone']."', '".$_POST['ad_name']."')");

	header('Location: '.$_SERVER['REQUEST_URI']);
	exit();
}

// fonction pour appliquer l'adresse de livraison sélectionnée si aucune autre n'était enregistrée avant
function saveAsNew($address) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_address = $prefix."fbs_address";

	$wpdb->query("INSERT INTO `$fb_tablename_address` VALUES (not null, '".$_SESSION['loggeduser']->id."', '".$_POST['orderid']."', '".addslashes($address->l_name)."', '".addslashes($address->l_comp)."', '".addslashes($address->l_address)."', '".addslashes($address->l_code)."', '".addslashes($address->l_city)."', '".addslashes($address->l_phone)."')");

	header('Location: '.$_SERVER['REQUEST_URI']);
	exit();
}

// fonction pour appliquer l'adresse de livraison sélectionnée à la place d'une autre enregistrée avant
function editAddress($address) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_address = $prefix."fbs_address";

	$updateAddress = $wpdb->update($fb_tablename_address, array (
		'l_name' => $address->l_name,
		'l_comp' => $address->l_comp,
		'l_address' => $address->l_address,
		'l_code' => $address->l_code,
		'l_city' => $address->l_city,
		'l_phone' => $address->l_phone ),
		array ('unique_id' => $_POST['orderid'])
	);

	header('Location: '.$_SERVER['REQUEST_URI']);
	exit();
}

//------------------------------- fonction pour éditer les adresses enregistrées
function editFromBloc($table) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$ad_name = $_POST['ad_name'];
	$l_name = $_POST['l_name'];
	$l_comp = $_POST['l_comp'];
	$l_address = $_POST['l_address'];
	$l_code = $_POST['l_code'];
	$l_city = $_POST['l_city'];
	$l_phone = $_POST['l_phone'];
	$updateAddress = $wpdb->query("UPDATE `$table` SET l_name = '$l_name', l_comp = '$l_comp', l_address = '$l_address', l_code ='$l_code', l_city = '$l_city', l_phone = '$l_phone', ad_name = '$ad_name' WHERE `user` = '".$_SESSION['loggeduser']->id."'");

	header('Location: '.$_SERVER['REQUEST_URI']);
	exit();
}

// fonction pour récupérer le nom de l'adresse
function getAdname($address) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_address = $prefix."fbs_address";

	return	$address->ad_name;
}

//------------------------------fonction pour afficher les adresses enregistrées
// $address -> ex $address2
// $edit    -> ex edit2
// $del     -> ex del2
// $label   -> ex adresse 2
// $check   -> ex adresse2
function displayAd($address, $edit, $del, $label, $check) {
	global $wpdb;
	$prefix = $wpdb->prefix;

	$view = '<div class="blocAdresse blocA5">
	<button type="submit" title="modifier cette adresse" name="'.$edit.'" class="editAdresse" form="editAdresse"><i class="fa fa-pencil-square-o"></i></button>
	<button type="submit" title="supprimer cette adresse" name="'.$del.'" class="deleteAdresse" form="deleteAdresse"><i class="ion-android-delete"></i></button>
	<div class="titreAdresse">'.$label.' </div>
	'.$address->l_name.'<br />
	'.$address->l_comp.'<br />
	'.$address->l_address.'<br />
	'.$address->l_code.'<br />
	'.$address->l_city.'<br />
	'.$address->l_phone.'<br />
	<div class="blocAdresseSelect">envoyer à cette adresse :<label class="switch"><input type="radio" name="adresse" form="adresseCheck" value="'.$check.'" class="checkbox" /><span class="slider round"></span></label></div></div>';

	return $view;
}

// -------------fonction pour afficher le mode édition des adresses enregistrées
// $address -> ex $address2
// $edit    -> ex editSub2
// $id      -> ex addressForm2
// $modify  -> ex modifier2
function displayEd($address, $edit, $id, $modify) {
	global $wpdb;
	$prefix = $wpdb->prefix;

	$view = '<div class="blocAdresse blocA2">
	<form name="'.$edit.'" id="'.$id.'" action="" method="post"></form>
	<label class="cyan">Intitulé: <input type="text" form="'.$id.'" class="editAd" placeholder="ex: bureau, maison...." name="ad_name"    value="'.$address->ad_name.'" /></label>
	<label>Nom, prénom: <input type="text" form="'.$id.'" class="editAd" placeholder="nom, prénom" name="l_name"    value="'.$address->l_name.'" /></label>
	<label>Société: <input type="text" form="'.$id.'" class="editAd" placeholder="société"     name="l_comp"    value="'.$address->l_comp.'" /></label>
	<label>Adresse: <input type="text" form="'.$id.'" class="editAd" placeholder="adresse"     name="l_address" value="'.$address->l_address.'" /></label>
	<label>Code postal: <input type="text" form="'.$id.'" class="editAd" placeholder="code postal" name="l_code"    value="'.$address->l_code.'" /></label>
	<label>Ville: <input type="text" form="'.$id.'" class="editAd" placeholder="ville"       name="l_city"    value="'.$address->l_city.'" /></label>
	<label>Téléphone: <input type="text" form="'.$id.'" class="editAd" placeholder="téléphone"   name="l_phone"   value="'.$address->l_phone.'" /></label>
	<button type="submit" form="'.$id.'" class="editAdBtn" name="'.$modify.'"><i class="ion-checkmark"></i> Enregistrer</button>
	</div>';

	return $view;
}

////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////// page modifier adresse livraison //

function get_inscription2() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users     = $prefix."fbs_users";
	$fb_tablename_order     = $prefix."fbs_order";
	$fb_tablename_address   = $prefix."fbs_address";
	$fb_tablename_address1  = $prefix."fbs_address1";
	$fb_tablename_address2  = $prefix."fbs_address2";
	$fb_tablename_address3  = $prefix."fbs_address3";
	$fb_tablename_address4  = $prefix."fbs_address4";
	$fb_tablename_address5  = $prefix."fbs_address5";
	$fb_tablename_address6  = $prefix."fbs_address6";
	$fb_tablename_address7  = $prefix."fbs_address7";
	$fb_tablename_address8  = $prefix."fbs_address8";
	$fb_tablename_address9  = $prefix."fbs_address9";
	$fb_tablename_address10 = $prefix."fbs_address10";
	$fb_tablename_address11 = $prefix."fbs_address11";
	$fb_tablename_address12 = $prefix."fbs_address12";
	$fb_tablename_address13 = $prefix."fbs_address13";
	$fb_tablename_address14 = $prefix."fbs_address14";
	$fb_tablename_address15 = $prefix."fbs_address15";
	$fb_tablename_address16 = $prefix."fbs_address16";
	$fb_tablename_address17 = $prefix."fbs_address17";
	$fb_tablename_address18 = $prefix."fbs_address18";
	$fb_tablename_address19 = $prefix."fbs_address19";
	$fb_tablename_address20 = $prefix."fbs_address20";

	$goback = $_GET['goback'];
	if ($goback == '') $goback = $_POST['orderid'];

	$isOwner = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$goback'");
	if (fb_is_logged() && ($isOwner->user == $_SESSION['loggeduser']->id)) {

		////////////////////////////////////////////////////////////////////////////
		// pour récupérer l'adresse de livraison depuis la table address origine:
		$user = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$goback'");

		// pour récupérer l'adresse de facturation depuis la table users:
		$usertable = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE id = '".$_SESSION['loggeduser']->id."'");

		// autres adresses enregistrées:
		$address1  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address1`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address2  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address2`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address3  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address3`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address4  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address4`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address5  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address5`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address6  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address6`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address7  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address7`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address8  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address8`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address9  = $wpdb->get_row("SELECT * FROM `$fb_tablename_address9`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address10 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address10` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address11 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address11` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address12 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address12` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address13 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address13` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address14 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address14` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address15 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address15` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address16 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address16` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address17 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address17` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address18 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address18` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address19 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address19` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$address20 = $wpdb->get_row("SELECT * FROM `$fb_tablename_address20` WHERE user = '".$_SESSION['loggeduser']->id."'");

		$count1  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address1`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count2  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address2`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count3  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address3`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count4  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address4`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count5  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address5`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count6  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address6`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count7  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address7`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count8  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address8`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count9  = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address9`  WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count10 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address10` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count11 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address11` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count12 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address12` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count13 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address13` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count14 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address14` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count15 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address15` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count16 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address16` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count17 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address17` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count18 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address18` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count19 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address19` WHERE user = '".$_SESSION['loggeduser']->id."'");
		$count20 = $wpdb->get_var("SELECT COUNT(*) FROM `$fb_tablename_address20` WHERE user = '".$_SESSION['loggeduser']->id."'");

		// -------------------------------------------formulaire ajouter une adresse
		if(isset($_POST['ajouterAdresse'])) {

			if (!empty($_POST['l_porte'])) {
				$_POST['l_address'] = $_POST['l_address'].' | '.$_POST['l_porte'];
			}

			//if ($user) { // s'il y a déjà une adresse de livraison enregistrée pour la commande

			// 1 - on sauvegarde l'adresse dans la 1ère table disponible.
			if($count1==0) {
				saveAddress($fb_tablename_address1);
			}else if($count2==0) {
				saveAddress($fb_tablename_address2);
			}else if($count3==0) {
				saveAddress($fb_tablename_address3);
			}else if($count4==0) {
				saveAddress($fb_tablename_address4);
			}else if($count5==0) {
				saveAddress($fb_tablename_address5);
			}else if($count6==0) {
				saveAddress($fb_tablename_address6);
			}else if($count7==0) {
				saveAddress($fb_tablename_address7);
			}else if($count8==0) {
				saveAddress($fb_tablename_address8);
			}else if($count9==0) {
				saveAddress($fb_tablename_address9);
			}else if($count10==0) {
				saveAddress($fb_tablename_address10);
			}else if($count11==0) {
				saveAddress($fb_tablename_address11);
			}else if($count12==0) {
				saveAddress($fb_tablename_address12);
			}else if($count13==0) {
				saveAddress($fb_tablename_address13);
			}else if($count14==0) {
				saveAddress($fb_tablename_address14);
			}else if($count15==0) {
				saveAddress($fb_tablename_address15);
			}else if($count16==0) {
				saveAddress($fb_tablename_address16);
			}else if($count17==0) {
				saveAddress($fb_tablename_address17);
			}else if($count18==0) {
				saveAddress($fb_tablename_address18);
			}else if($count19==0) {
				saveAddress($fb_tablename_address19);
			}else if($count20==0) {
				saveAddress($fb_tablename_address20);
			}

			// 2 - on récupère les données modifiées dans le formulaire et on les met à jour dans la table address origine
			/*$updateAddress = $wpdb->update($fb_tablename_address, array (
			'l_name' => $_POST['l_name'],
			'l_comp' => $_POST['l_comp'],
			'l_address' => $_POST['l_address'],
			'l_code' => $_POST['l_code'],
			'l_city' => $_POST['l_city'],
			'l_phone' => $_POST['l_phone']),
			array ('unique_id' => $_POST['orderid'])
		);

	} else { // s'il n'y a pas d'adresse de livraison enregistrée, on insère les données formulaire dans la table address origine et on sauvegarde dans address1
	//saveAddress($fb_tablename_address);
	saveAddress($fb_tablename_address1);
}*/
	}

	//------------------------------------------ formulaire sélectionner adresse
	if ($_POST['adresse'] == 'adresseFact') {

		if ($user) { // s'il y a déjà une adresse de livraison enregistrée pour la commande
			$updateAddress = $wpdb->update($fb_tablename_address, array (
				'l_name'    => $usertable->f_name,
				'l_comp'    => $usertable->f_comp,
				'l_address' => $usertable->f_address,
				'l_code'    => $usertable->f_code,
				'l_city'    => $usertable->f_city,
				'l_phone'   => $usertable->f_phone ),
				array ('unique_id' => $_POST['orderid'])
			);
		}else{
			$createAddress = $wpdb->query("INSERT INTO `$fb_tablename_address` VALUES (not null, '".$_SESSION['loggeduser']->id."', '".$_POST['orderid']."', '$usertable->f_name', '$usertable->f_comp', '$usertable->f_address', '$usertable->f_code', '$usertable->f_city', '$usertable->f_phone')");
		}
	} else if ($_POST['adresse'] == 'adresse0') {
		// adresse0 = user, c'est la table qu'on modifie ici donc dans ce cas précis on change rien

	} else if ($_POST['adresse'] == 'adresse1') {
		if ($user) {
			editAddress($address1);
		}else{
			saveAsNew($address1);
		}
	} else if ($_POST['adresse'] == 'adresse2') {
		if ($user) {
			editAddress($address2);
		}else{
			saveAsNew($address2);
		}
	} else if ($_POST['adresse'] == 'adresse3') {
		if ($user) {
			editAddress($address3);
		}else{
			saveAsNew($address3);
		}
	} else if ($_POST['adresse'] == 'adresse4') {
		if ($user) {
			editAddress($address4);
		}else{
			saveAsNew($address4);
		}
	} else if ($_POST['adresse'] == 'adresse5') {
		if ($user) {
			editAddress($address5);
		}else{
			saveAsNew($address5);
		}
	} else if ($_POST['adresse'] == 'adresse6') {
		if ($user) {
			editAddress($address6);
		}else{
			saveAsNew($address6);
		}
	} else if ($_POST['adresse'] == 'adresse7') {
		if ($user) {
			editAddress($address7);
		}else{
			saveAsNew($address7);
		}
	} else if ($_POST['adresse'] == 'adresse8') {
		if ($user) {
			editAddress($address8);
		}else{
			saveAsNew($address8);
		}
	} else if ($_POST['adresse'] == 'adresse9') {
		if ($user) {
			editAddress($address9);
		}else{
			saveAsNew($address9);
		}
	} else if ($_POST['adresse'] == 'adresse10') {
		if ($user) {
			editAddress($address10);
		}else{
			saveAsNew($address10);
		}
	} else if ($_POST['adresse'] == 'adresse11') {
		if ($user) {
			editAddress($address11);
		}else{
			saveAsNew($address11);
		}
	} else if ($_POST['adresse'] == 'adresse12') {
		if ($user) {
			editAddress($address12);
		}else{
			saveAsNew($address12);
		}
	} else if ($_POST['adresse'] == 'adresse13') {
		if ($user) {
			editAddress($address13);
		}else{
			saveAsNew($address13);
		}
	} else if ($_POST['adresse'] == 'adresse14') {
		if ($user) {
			editAddress($address14);
		}else{
			saveAsNew($address14);
		}
	} else if ($_POST['adresse'] == 'adresse15') {
		if ($user) {
			editAddress($address15);
		}else{
			saveAsNew($address15);
		}
	} else if ($_POST['adresse'] == 'adresse16') {
		if ($user) {
			editAddress($address16);
		}else{
			saveAsNew($address16);
		}
	} else if ($_POST['adresse'] == 'adresse17') {
		if ($user) {
			editAddress($address17);
		}else{
			saveAsNew($address17);
		}
	} else if ($_POST['adresse'] == 'adresse18') {
		if ($user) {
			editAddress($address18);
		}else{
			saveAsNew($address18);
		}
	} else if ($_POST['adresse'] == 'adresse19') {
		if ($user) {
			editAddress($address19);
		}else{
			saveAsNew($address19);
		}
	} else if ($_POST['adresse'] == 'adresse20') {
		if ($user) {
			editAddress($address20);
		}else{
			saveAsNew($address20);
		}
	}

	// ----------------------------------------------------supprimer une adresse
	if(isset($_POST['del1'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address1` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del2'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address2` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del3'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address3` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del4'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address4` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del5'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address5` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del6'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address6` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del7'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address7` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del8'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address8` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del9'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address9` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del10'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address10` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del11'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address11` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del12'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address12` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del13'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address13` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del14'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address14` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del15'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address15` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del16'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address16` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del17'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address17` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del18'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address18` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del19'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address19` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['del20'])) {
		$clear = $wpdb->query("DELETE FROM `$fb_tablename_address20` WHERE `user` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}

	// -----------------------------------------------------modifier une adresse
	if(isset($_POST['modifierFact'])) {
		$l_name = $_POST['l_name'];
		$l_comp = $_POST['l_comp'];
		$l_address = $_POST['l_address'];
		$l_code = $_POST['l_code'];
		$l_city = $_POST['l_city'];
		$l_phone = $_POST['l_phone'];
		$updateAddress = $wpdb->query("UPDATE `$fb_tablename_users` SET f_name = '$l_name', f_comp = '$l_comp', f_address = '$l_address', f_code ='$l_code', f_city = '$l_city', f_phone = '$l_phone' WHERE `id` = '".$_SESSION['loggeduser']->id."'");
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
	if(isset($_POST['modifier1'])) {
		editFromBloc($fb_tablename_address1);
	}
	if(isset($_POST['modifier2'])) {
		editFromBloc($fb_tablename_address2);
	}
	if(isset($_POST['modifier3'])) {
		editFromBloc($fb_tablename_address3);
	}
	if(isset($_POST['modifier4'])) {
		editFromBloc($fb_tablename_address4);
	}
	if(isset($_POST['modifier5'])) {
		editFromBloc($fb_tablename_address5);
	}
	if(isset($_POST['modifier6'])) {
		editFromBloc($fb_tablename_address6);
	}
	if(isset($_POST['modifier7'])) {
		editFromBloc($fb_tablename_address7);
	}
	if(isset($_POST['modifier8'])) {
		editFromBloc($fb_tablename_address8);
	}
	if(isset($_POST['modifier9'])) {
		editFromBloc($fb_tablename_address9);
	}
	if(isset($_POST['modifier10'])) {
		editFromBloc($fb_tablename_address10);
	}
	if(isset($_POST['modifier11'])) {
		editFromBloc($fb_tablename_address11);
	}
	if(isset($_POST['modifier12'])) {
		editFromBloc($fb_tablename_address12);
	}
	if(isset($_POST['modifier13'])) {
		editFromBloc($fb_tablename_address13);
	}
	if(isset($_POST['modifier14'])) {
		editFromBloc($fb_tablename_address14);
	}
	if(isset($_POST['modifier15'])) {
		editFromBloc($fb_tablename_address15);
	}
	if(isset($_POST['modifier16'])) {
		editFromBloc($fb_tablename_address16);
	}
	if(isset($_POST['modifier17'])) {
		editFromBloc($fb_tablename_address17);
	}
	if(isset($_POST['modifier18'])) {
		editFromBloc($fb_tablename_address18);
	}
	if(isset($_POST['modifier19'])) {
		editFromBloc($fb_tablename_address19);
	}
	if(isset($_POST['modifier20'])) {
		editFromBloc($fb_tablename_address20);
	}

	////////////////////////////////////////////// affichage carnet d'adresse //
	//--------------------------------------------------------------------------
	$view = '<h1><i class="fa fa-lock"></i> Accès client: Carnet d\'adresses</h1><hr />';
	$action = '<input type="hidden" form="registerform" name="orderid" value="'.$goback.'" />';
	$goaction = get_bloginfo('url').'/vos-devis/?detail='.$_GET['goback'];
	//$formAction = get_bloginfo('url').'/order-inscription/?goback='.$_GET['goback'];
	$explode2 = explode('|', $user->l_address);
	$l_address = $explode2['0'];
	$l_porte = $explode2['1'];

	//--------------------------------------------------------------------------
	$view .= '
	<div class="box_warning"><button class="closeButton"><i class="ion-ios-close-empty"></i></button>Nouveau! Votre carnet d\'adresses vous permet de sauvegarder jusqu\'à 20 adresses de livraison.</div>
	<div class="acces_tab_name2">Commande Nº '.$goback.': choisir une adresse de livraison </div>

	<div class="acces_tab_content2">
	<form name="deleteAdresseForm" id="deleteAdresse" action="" method="post"></form>
	<form name="editAdresseForm" id="editAdresse" action="" method="post"></form>
	<form name="addNewAdresseForm" id="addNewAdresse" action="" method="post"></form>
	<form name="adresseCheckForm" id="adresseCheck" action="'.$goaction.'" method="post"></form>

	<div class="adresses">
	<input type="hidden" name="adresseSelect" value="select" form="adresseCheck" /><input type="hidden" form="adresseCheck" name="orderid" value="'.$goback.'" />';

	// s'il y a une adresse de livraison enregistrée, on l'affiche avec l'adresse de facturation
	if($user) {
		$addressName = 'adresse sélectionnée:';

		//------------------------------------------------adresse active
		$view .= '
		<div class="blocAdresse blocSelect">
		<div class="adresseLiv"><i class="fa fa-truck" aria-hidden="true"></i></div>
		<div class="titreAdresse">'.$addressName.'</div>
		'.$user->l_name.'<br />
		'.$user->l_comp.'<br />
		'.$user->l_address.'<br />
		'.$user->l_code.'<br />
		'.$user->l_city.'<br />
		'.$user->l_phone.'<br />
		<div class="blocAdresseSelect headSelect">adresse actuelle<label class="switch"><input type="radio" name="adresse" form="adresseCheck" value="adresse0" class="checkbox" checked /><span class="slider round"></span>
		</label></div>
		</div>';

		//--------------------------------------- adresse de facturation
		if(isset($_POST['editf'])) {
			$view .= '
			<div class="blocAdresse">
			<form name="editFact" id="editFct" action="" method="post"></form>
			<label>Nom, prénom: <input type="text" form="editFct" class="editAd" placeholder="nom, prénom" name="l_name" value="'.$usertable->f_name.'" /></label>
			<label>Société: <input type="text" form="editFct" class="editAd" placeholder="société" name="l_comp" value="'.$usertable->f_comp.'" /></label>
			<label>Adresse: <input type="text" form="editFct" class="editAd" placeholder="adresse" name="l_address" value="'.$usertable->f_address.'" /></label>
			<label>Code postal: <input type="text" form="editFct" class="editAd" placeholder="code postal" name="l_code" value="'.$usertable->f_code.'" /></label>
			<label>Ville: <input type="text" form="editFct" class="editAd" placeholder="ville" name="l_city" value="'.$usertable->f_city.'" /></label>
			<label>Téléphone: <input type="text" form="editFct" class="editAd" placeholder="téléphone" name="l_phone" value="'.$usertable->f_phone.'" /></label>
			<button type="submit" form="editFct" class="editAdBtn" name="modifierFact"><i class="ion-checkmark"></i> Enregistrer</button>
			</div>';

		}else{
			$view .= '
			<div class="blocAdresse">
			<button type="submit" title="éditer cette adresse" name="editf" class="editAdresse" form="editAdresse"><i class="fa fa-pencil-square-o"></i></button>
			<div class="titreAdresse">adresse de facturation </div>
			'.$usertable->f_name.'<br />
			'.$usertable->f_comp.'<br />
			'.$usertable->f_address.'<br />
			'.$usertable->f_code.'<br />
			'.$usertable->f_city.'<br />
			'.$usertable->f_phone.'<br />
			<div class="blocAdresseSelect">envoyer à cette adresse : <label class="switch"><input type="radio" name="adresse" form="adresseCheck" value="adresseFact" class="checkbox" /><span class="slider round"></span></label></div>
			</div>';
		}

		// sinon on n'affiche que l'adresse de facturation et un message explicatif
	}else{
		$view .= '
		<div class="blocAdresse blocSpec">
		<div class="showDesc">Vous n\'avez pas sélectionné d\'adresse de livraison pour cette commande.<br />
		Sans modification de votre part, vous serez livré à votre adresse de facturation.</div>
		<div class="showRight"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
		</div>';

		if(isset($_POST['editf'])) {
			$view .= '
			<div class="blocAdresse">
			<form name="editFact" id="editFct" action="" method="post"></form>
			<label>nom, prénom: <input type="text" form="editFct" class="editAd" placeholder="nom, prénom" name="l_name" value="'.$usertable->f_name.'" /></label>
			<label>Société: <input type="text" form="editFct" class="editAd" placeholder="société" name="l_comp" value="'.$usertable->f_comp.'" /></label>
			<label>Adresse: <input type="text" form="editFct" class="editAd" placeholder="adresse" name="l_address" value="'.$usertable->f_address.'" /></label>
			<label>Code postal: <input type="text" form="editFct" class="editAd" placeholder="code postal" name="l_code" value="'.$usertable->f_code.'" /></label>
			<label>Ville: <input type="text" form="editFct" class="editAd" placeholder="ville" name="l_city" value="'.$usertable->f_city.'" /></label>
			<label>Téléphone: <input type="text" form="editFct" class="editAd" placeholder="téléphone" name="l_phone" value="'.$usertable->f_phone.'" /></label>
			<button type="submit" form="editFct" class="editAdBtn" name="modifierFact"><i class="ion-checkmark"></i> Enregistrer</button>
			</div>';
		}else{
			$view .= '
			<div class="blocAdresse blocSelect">
			<div class="adresseLiv"><i class="fa fa-truck" aria-hidden="true"></i></div>
			<div class="titreAdresse">adresse de facturation </div>
			'.$usertable->f_name.'<br />
			'.$usertable->f_comp.'<br />
			'.$usertable->f_address.'<br />
			'.$usertable->f_code.'<br />
			'.$usertable->f_city.'<br />
			'.$usertable->f_phone.'<br />
			<div class="blocAdresseSelect headSelect">livré à l\'adresse de facturation <label class="switch"><input type="radio" name="adresse" form="adresseCheck" value="adresseFact" class="checkbox" checked /><span class="slider round"></span></label></div>
			</div>';
		}
	}

	//////////////////////////////////////////////////////////////////
	//-------- affichage conditionnel des autres adresses enregistrées
	if($count1==1) {
		$adname = getAdname($address1);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 1';

		if(isset($_POST['edit1'])) {
			$view .= displayEd($address1, 'editSub1', 'addressForm1', 'modifier1');
		}else{
			$view .= displayAd($address1, 'edit1', 'del1', $adname, 'adresse1');
		}
	}
	//----------------------------------------------------------------
	if($count2==1) {
		$adname = getAdname($address2);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 2';

		if(isset($_POST['edit2'])) {
			$view .= displayEd($address2, 'editSub2', 'addressForm2', 'modifier2');
		}else{
			$view .= displayAd($address2, 'edit2', 'del2', $adname, 'adresse2');
		}
	}
	//----------------------------------------------------------------
	if($count3==1) {
		$adname = getAdname($address3);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 3';

		if(isset($_POST['edit3'])) {
			$view .= displayEd($address3, 'editSub3', 'addressForm3', 'modifier3');
		}else{
			$view .= displayAd($address3, 'edit3', 'del3', $adname, 'adresse3');
		}
	}
	//----------------------------------------------------------------
	if($count4==1) {
		$adname = getAdname($address4);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 4';

		if(isset($_POST['edit4'])) {
			$view .= displayEd($address4, 'editSub4', 'addressForm4', 'modifier4');
		}else{
			$view .= displayAd($address4, 'edit4', 'del4', $adname, 'adresse4');
		}
	}
	//----------------------------------------------------------------
	if($count5==1) {
		$adname = getAdname($address5);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 5';

		if(isset($_POST['edit5'])) {
			$view .= displayEd($address5, 'editSub5', 'addressForm5', 'modifier5');
		}else{
			$view .= displayAd($address5, 'edit5', 'del5', $adname, 'adresse5');
		}
	}
	//----------------------------------------------------------------
	if($count6==1) {
		$adname = getAdname($address6);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 6';

		if(isset($_POST['edit6'])) {
			$view .= displayEd($address6, 'editSub6', 'addressForm6', 'modifier6');
		}else{
			$view .= displayAd($address6, 'edit6', 'del6', $adname, 'adresse6');
		}
	}
	//----------------------------------------------------------------
	if($count7==1) {
		$adname = getAdname($address7);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 7';

		if(isset($_POST['edit7'])) {
			$view .= displayEd($address7, 'editSub7', 'addressForm7', 'modifier7');
		}else{
			$view .= displayAd($address7, 'edit7', 'del7', $adname, 'adresse7');
		}
	}
	//----------------------------------------------------------------
	if($count8==1) {
		$adname = getAdname($address8);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 8';

		if(isset($_POST['edit8'])) {
			$view .= displayEd($address8, 'editSub8', 'addressForm8', 'modifier8');
		}else{
			$view .= displayAd($address8, 'edit8', 'del8', $adname, 'adresse8');
		}
	}
	//----------------------------------------------------------------
	if($count9==1) {
		$adname = getAdname($address9);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 9';

		if(isset($_POST['edit9'])) {
			$view .= displayEd($address9, 'editSub9', 'addressForm9', 'modifier9');
		}else{
			$view .= displayAd($address9, 'edit9', 'del9', $adname, 'adresse9');
		}
	}
	//----------------------------------------------------------------
	if($count10==1) {
		$adname = getAdname($address10);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 10';

		if(isset($_POST['edit10'])) {
			$view .= displayEd($address10, 'editSub10', 'addressForm10', 'modifier10');
		}else{
			$view .= displayAd($address10, 'edit10', 'del10', $adname, 'adresse10');
		}
	}
	//----------------------------------------------------------------
	if($count11==1) {
		$adname = getAdname($address11);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 11';

		if(isset($_POST['edit11'])) {
			$view .= displayEd($address11, 'editSub11', 'addressForm11', 'modifier11');
		}else{
			$view .= displayAd($address11, 'edit11', 'del11', $adname, 'adresse11');
		}
	}
	//----------------------------------------------------------------
	if($count12==1) {
		$adname = getAdname($address12);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 12';

		if(isset($_POST['edit12'])) {
			$view .= displayEd($address12, 'editSub12', 'addressForm12', 'modifier12');
		}else{
			$view .= displayAd($address12, 'edit12', 'del12', $adname, 'adresse12');
		}
	}
	//----------------------------------------------------------------
	if($count13==1) {
		$adname = getAdname($address13);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 13';

		if(isset($_POST['edit13'])) {
			$view .= displayEd($address13, 'editSub13', 'addressForm13', 'modifier13');
		}else{
			$view .= displayAd($address13, 'edit13', 'del13', $adname, 'adresse13');
		}
	}
	//----------------------------------------------------------------
	if($count14==1) {
		$adname = getAdname($address14);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 14';

		if(isset($_POST['edit14'])) {
			$view .= displayEd($address14, 'editSub14', 'addressForm14', 'modifier14');
		}else{
			$view .= displayAd($address14, 'edit14', 'del14', $adname, 'adresse14');
		}
	}
	//----------------------------------------------------------------
	if($count15==1) {
		$adname = getAdname($address15);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 15';

		if(isset($_POST['edit15'])) {
			$view .= displayEd($address15, 'editSub15', 'addressForm15', 'modifier15');
		}else{
			$view .= displayAd($address15, 'edit15', 'del15', $adname, 'adresse15');
		}
	}
	//----------------------------------------------------------------
	if($count16==1) {
		$adname = getAdname($address16);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 16';

		if(isset($_POST['edit16'])) {
			$view .= displayEd($address16, 'editSub16', 'addressForm16', 'modifier16');
		}else{
			$view .= displayAd($address16, 'edit16', 'del16', $adname, 'adresse16');
		}
	}
	//----------------------------------------------------------------
	if($count17==1) {
		$adname = getAdname($address17);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 17';

		if(isset($_POST['edit17'])) {
			$view .= displayEd($address17, 'editSub17', 'addressForm17', 'modifier17');
		}else{
			$view .= displayAd($address17, 'edit17', 'del17', $adname, 'adresse17');
		}
	}
	//----------------------------------------------------------------
	if($count18==1) {
		$adname = getAdname($address18);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 18';

		if(isset($_POST['edit18'])) {
			$view .= displayEd($address18, 'editSub18', 'addressForm18', 'modifier18');
		}else{
			$view .= displayAd($address18, 'edit18', 'del18', $adname, 'adresse18');
		}
	}
	//----------------------------------------------------------------
	if($count19==1) {
		$adname = getAdname($address19);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 19';

		if(isset($_POST['edit19'])) {
			$view .= displayEd($address19, 'editSub19', 'addressForm19', 'modifier19');
		}else{
			$view .= displayAd($address19, 'edit19', 'del19', $adname, 'adresse19');
		}
	}
	//----------------------------------------------------------------
	if($count20==1) {
		$adname = getAdname($address20);
		if ($adname) $adname = $adname;
		else $adname = 'adresse 20';

		if(isset($_POST['edit20'])) {
			$view .= displayEd($address20, 'editSub20', 'addressForm20', 'modifier20');
		}else{
			$view .= displayAd($address20, 'edit20', 'del20', $adname, 'adresse20');
		}
	}
	//----------------------------------------- fin affichage adresses

	if($count1+$count2+$count3+$count4+$count5+$count6+$count7+$count8+$count9+$count10+$count11+$count12+$count13+$count14+$count15+$count16+$count17+$count18+$count19+$count20 < 20) {
		if(isset($_POST['addNew'])) {
			$view .= '
			<div class="blocAdresse">
			<form name="addLivr" id="addLiv" action="" method="post"></form>
			<label class="cyan">Intitulé (facultatif):<br/>
			<input type="text" form="addLiv" placeholder="ex: bureau, maison..." name="ad_name" /></label>
			<label>Nom, prénom:<input type="text" form="addLiv" class="editAd" placeholder="nom, prénom" name="l_name" /></label>
			<label>Société:<input type="text" form="addLiv" class="editAd" placeholder="société" name="l_comp" /></label>
			<label>Adresse:<input type="text" form="addLiv" class="editAd" placeholder="adresse" name="l_address" /></label>
			<label>code, porte, esc...: <input type="text" form="addLiv" class="editAd" placeholder="code, porte, esc..." name="l_porte" /></label>
			<label>Code postal: <input type="text" form="addLiv" class="editAd" placeholder="code postal" name="l_code" /></label>
			<label>Ville: <input type="text" form="addLiv" class="editAd" placeholder="ville" name="l_city" /></label>
			<label>Téléphone: <input type="text" form="addLiv" class="editAd" placeholder="téléphone" name="l_phone" /></label>
			<button type="submit" form="addLiv" class="editAdBtn" name="ajouterAdresse"><i class="ion-checkmark"></i> Enregistrer</button>
			</div>';
		}else{
			$view .= '
			<div class="blocAdresse blocSpec">
			<button type="submit" title="ajouter une adresse de livraison" name="addNew" class="addNew" form="addNewAdresse">
			<i class="fa fa-plus"></i>
			</button>
			<div class="blocAdresseSelect headNew">ajouter une adresse</div>
			</div>';
		}
	}

	//----------------------------------------------------------------------
	/*<div class="form-input-wide blocBtnBottom">
	<a href="'.get_bloginfo("url").'/vos-devis/?detail='.$goback.'" id="but_retour2"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour</a>
	<button type="submit" form="adresseCheck" id="but_save2"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>
	</div>*/
	$view .= '
	<a href="'.get_bloginfo("url").'/vos-devis/?detail='.$goback.'" id="but_retourCarnet"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour</a>

	</div>
	</div>';

	} else {
		$view .= 'You don\'t have permission to access this page!';
	}
	return $view;
}

function fb_is_logged() {
	if (isset($_SESSION['loggeduser']) && $_SESSION['loggeduser']->logme == "yes") {
		return true;
	} else {
		return false;
	}
}

function get_acces_client() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$plugin_url=get_bloginfo('url').'/wp-content/plugins/fbshop/';

	//	if (!isset($_SESSION['loggeduser'])) {
	// envoi de rappels mot de passe
	if ($_GET['resend'] == 'resend') {
		$podanyemail = $_POST['resendaddress'];
		$adresemail = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE email='$podanyemail'");
		if ($adresemail) {
			$chars = "abcdefghijklmnopqrstuw1234567890"; //jeu de caractères que vous pouvez vous-même fixer
			$hasloodszyfrowane = '';
			for ( $i = 0; $i <= 4; $i++ ) {
				$losowy = rand(0, strlen($chars) - 1);
				$hasloodszyfrowane .= $chars{$losowy};
			}
			//			$hasloodszyfrowane = uniqid(rand()); // création d'un nouveau mot de passe
			$haslo = sha1(md5($hasloodszyfrowane)); // szyfrowanie hasła
			$wysylanie = $wpdb->query("UPDATE `$fb_tablename_users` SET pass = '$haslo' WHERE email = '$adresemail->email'");
			if ($wysylanie) {
				$letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour,<br />Vous pouvez vous connecter dans votre accès client avec les informations ci-dessous :<br /><br />NOM D’UTILISATEUR : '.$adresemail->login.'<br />MOT DE PASSE : '.$hasloodszyfrowane.'<br /><br />Une fois connecté(e), vous pourrez modifier ces données si vous le souhaitez en cliquant sur le bouton "modifier mon compte".<br /><br />Amicalement,<br />L’équipe FRANCE BANDEROLE</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
					function wpse27856_set_content_type(){
						return "text/html";
					}
					add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
					$header = 'From: France Banderole <information@france-banderole.com>';
					$header .= "\nContent-type: text/plain; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
					//mail($adresemail->email, "nouveau mot de passe et nom d utilisateur", $letter, $header);
					wp_mail($adresemail->email, "Nouveau mot de passe et nom d utilisateur", $letter);
					remove_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
					$view .= '<p class="box_info">'._FB_NPASS3.'</p>';

			} else {
				$view .= '<p>'._FB_ERROR.'</p><p><a href="'.get_bloginfo('url').'/acces-client/?resend=pass">'._FB_COFNIJ.'</a></p>';
			}

		} else {
			$view .= '<p>'._FB_PEMAIL.'</p>';
			$view .= get_pass_resend_form();
		}

	}	elseif ($_GET['resend'] == 'pass') { // mot de passe sous forme de rappel
		if (!isset($_SESSION['loggeduser'])) {
			$view .= get_pass_resend_form();
		} else {
			$view .= ''._FB_ULOGGED.'';
		}

	} elseif ($_POST['logme']=='logme') {
		$login = addslashes($_POST['loginname']);
		$pass = sha1(md5($_POST['loginpass']));
		$sprawdz = $wpdb->get_row("SELECT * FROM `$fb_tablename_users` WHERE login='$login' AND pass='$pass'");
		if ($sprawdz) {
			$data = date('Y-m-d H:i:s');
			$apdejt = $wpdb->query("UPDATE `$fb_tablename_users` SET lastlogged = '$data' WHERE id = '$sprawdz->id'");
			if ($sprawdz->status == 0) {
				$view .= '<p>'._FB_NAKTYW.'</p>';
				$view .= '<p>'._FB_NOTR.' <a href="'.get_bloginfo('url').'/inscription/?send=confirm&user='.$login.'">'._FB_THERE.'</a>.</p>';
			}else if ($sprawdz->status == 1){
				/* fonction pour enregistrer l'adresse de livraison au relais colis: on sauve les variables mises en session avant initialisation connection utilisateur */
				if($_SESSION['loggeduser']->relais_colis == "yes"){
					$l_comp = $_SESSION['loggeduser']->l_comp;
					$l_name = $_SESSION['loggeduser']->l_name;
					$l_address = $_SESSION['loggeduser']->l_address;
					$l_code = $_SESSION['loggeduser']->l_code;
					$l_city = $_SESSION['loggeduser']->l_city;
					$code_relais_colis = $_SESSION['loggeduser']->code_relais_colis;
					$code_client_dest = $_SESSION['loggeduser']->code_client_dest;

					/* connection utilisateur*/
					$_SESSION['loggeduser'] = $sprawdz;
					$_SESSION['loggeduser']->logme = "yes";
					$view .= '<p>'._FB_LOGOK.'</p>';

					/* on restaure les vairables dans la session pour prise en compte dans la page de vérification de commande */
					$_SESSION['loggeduser']->l_comp = $l_comp;
					$_SESSION['loggeduser']->l_name = $l_name;
					$_SESSION['loggeduser']->l_address = $l_address;
					$_SESSION['loggeduser']->l_code = $l_code;
					$_SESSION['loggeduser']->l_city = $l_city;
					$_SESSION['loggeduser']->code_client_dest = $code_client_dest;
					//$_SESSION['loggeduser']->changement_relais_colis = "2nd_passage";
					$_SESSION['loggeduser']->code_relais_colis = $code_relais_colis;
					$_SESSION['loggeduser']->relais_colis = "yes";
					/*if($_SESSION['loggeduser']->l_name!="")
					$_SESSION['loggeduser']->changement_relais_colis_name = $_SESSION['loggeduser']->l_name;
					else
					$_SESSION['loggeduser']->changement_relais_colis_name = $_SESSION['loggeduser']->f_name;

					if($_SESSION['loggeduser']->l_phone!="")
					$_SESSION['loggeduser']->changement_relais_colis_tel = $_SESSION['loggeduser']->l_phone;
					else
					$_SESSION['loggeduser']->changement_relais_colis_tel = $_SESSION['loggeduser']->f_phone;
					*/
					if($_SESSION['loggeduser']->changement_relais_colis!="") $_SESSION['loggeduser']->relais_colis = "yes";
					//$_SESSION['loggeduser']->l_name = $l_name." ( ". $code_relais_colis." )";
				}else{
					/* connection utilisateur*/
					$_SESSION['loggeduser'] = $sprawdz;
					$_SESSION['loggeduser']->logme = "yes";
					$view .= '<p>'._FB_LOGOK.'</p>';
				}

			}
		} else {
			$view .= '<div class="logerror"><button class="closeButton"><i class="ion-ios-close-empty"></i></button><i class="fa fa-exclamation-triangle"></i> '._FB_BLH.'</div>';
			$view .= get_acces_panel($p);

		}
	}
	return $view;
}

function get_pass_resend_form() {
	$view .= '<h1><i class="fa fa-lock"></i> Accès Client</h1><hr />';
	$view .= '<div class="acces_left">
	<div class="acces_tab_name">mot de passe oublié ?</div>
	<div class="acces_tab_content">
	<p>'._FB_ZGUBA.'</p>
	<form id="resendform" name="resendform" action="'.get_bloginfo('url').'/acces-client/?resend=resend" method="post">

	<input type="text" placeholder="votre email" name="resendaddress" class="logininputOubli" />
	<button id="resendbutton" class="resendbutton" type="submit"><i class="fa fa-paper-plane"></i> envoyer</button>
	</form>
	</div>
	</div>';
	return $view;
}

function get_acces_panel($p) {
	$plugin_url=get_bloginfo('url').'/wp-content/plugins/fbshop/';
	if ($p == 1) { $path=get_bloginfo("url").'/vos-devis/'; } else { $path=''; }
	if ($p == 2) { $path=get_bloginfo("url").'/verification/'; } else { $path=''; }
	if ($p == 2) {

		$promo = $_POST['codeProm'];

		$view .= '<h1><i class="fa fa-lock"></i> Accès Client</h1><hr /><img class="aligncenter size-full" title="" src="'.$plugin_url.'/images/accesclient-name.jpg" alt="Accès Client" width="706" height="46" style="margin-bottom: 11px" />';
		$view .= '<div class="acces_left">
		<div class="acces_tab_name">VERIFICATION DE VOS IDENTIFIANTS</div>
		<div class="acces_tab_content">
		<form id="loginform" name="loginform" action="'.$path.'" method="post">
		<input type="hidden" name="logme" value="logme" />
		<label class="loginlabel" for="loginname">nom d\'utilisateur:</label>
		<input type="text" name="loginname" class="logininput" />
		<label class="loginlabel" for="loginpass">mot de passe:</label>
		<input type="password" name="loginpass" class="logininput" />
		<input type="hidden" name="codeProm" value="'.$promo.'" />
		<button id="loginsubmit2" class="loginbutton2" type="submit">Se connecter</button>
		</form>
		<a href="'.get_bloginfo("url").'/acces-client/?resend=pass" class="forgetpass">Mot de passe oublié?</a>
		</div>
		</div>';
	} else {

		$promo = $_POST['codeProm'];

		$view .= '<h1><i class="fa fa-lock"></i> Accès Client</h1><hr /><img class="aligncenter size-full" title="" src="'.$plugin_url.'/images/accesclient-name.jpg" alt="Accès Client" width="706" height="46" style="margin-bottom: 11px" />';
		$view .= '<div class="acces_left">
		<div class="acces_tab_name">DEJA INSCRIT?</div>
		<div class="acces_tab_content">
		<form id="loginform" name="loginform" action="'.$path.'" method="post">
		<input type="hidden" name="logme" value="logme" />
		<label class="loginlabel" for="loginname">nom d\'utilisateur:</label>
		<input type="text" name="loginname" class="logininput" />
		<label class="loginlabel" for="loginpass">mot de passe:</label>
		<input type="password" name="loginpass" class="logininput" />
		<input type="hidden" name="codeProm" value="'.$promo.'" />
		<button id="loginsubmit" class="loginbutton" type="submit">Se connecter</button>
		</form>
		<a href="'.get_bloginfo("url").'/acces-client/?resend=pass" class="forgetpass">Mot de passe oublié?</a>
		</div>
		</div>
		<div class="acces_right">
		<div class="acces_tab_name">PAS ENCORE INSCRIT?</div>
		<div class="acces_tab_content"><span id="notregistered"><font color="red">Je m\'enregistre pour continuer mon devis et télécharger mes fichiers</font color></span><a href="'.get_bloginfo('url').'/inscription/" class="pleaseregister">S\'ENREGISTRER</a></div>
		</div>';
	}

	return $view;
}
