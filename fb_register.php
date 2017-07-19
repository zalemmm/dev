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
				$header = 'From: FRANCE BANDEROLE <info@france-banderole.fr>';
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

				// if($_POST['email'] != "") {
				// $test_mail = $wpdb->get_results()
				// }
				//kolejka=file
				if (!empty($f_porte)) {
					$f_address = $f_address.'| '.$f_porte;
				}
				if (!empty($l_porte)) {
					$l_address = $l_address.'| '.$l_porte;
				}
				if ($_POST['pass'] != '') {
					$pass = sha1(md5($_POST['pass']));
					$kolejka = $wpdb->update($fb_tablename_users, array ( 'pass' => $pass, 'email' => $email, 'f_name' => $f_name, 'f_comp' => $f_comp, 'f_address' => $f_address, 'f_code' => $f_code, 'f_city' => $f_city, 'f_phone' => $f_phone, 'l_name' => $l_name, 'l_comp' => $l_comp, 'l_address' => $l_address, 'l_code' => $l_code, 'l_city' => $l_city, 'l_phone' => $l_phone ), array ('id' => $_POST['loggeduserid']) );
					//$kolejka = $wpdb->update($fb_tablename_users, array ( 'pass' => $pass, 'login' => $login, 'email' => $email, 'f_name' => $f_name, 'f_comp' => $f_comp, 'f_address' => $f_address, 'f_code' => $f_code, 'f_city' => $f_city, 'f_phone' => $f_phone, 'l_name' => $l_name, 'l_comp' => $l_comp, 'l_address' => $l_address, 'l_code' => $l_code, 'l_city' => $l_city, 'l_phone' => $l_phone ), array ('id' => $_POST['loggeduserid']) );
				} else {
					$kolejka = $wpdb->update($fb_tablename_users, array ( 'email' => $email, 'f_name' => $f_name, 'f_comp' => $f_comp, 'f_address' => $f_address, 'f_code' => $f_code, 'f_city' => $f_city, 'f_phone' => $f_phone, 'l_name' => $l_name, 'l_comp' => $l_comp, 'l_address' => $l_address, 'l_code' => $l_code, 'l_city' => $l_city, 'l_phone' => $l_phone ), array ('id' => $_POST['loggeduserid']) );
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
				$dodaj = $wpdb->query("INSERT INTO `$fb_tablename_users` VALUES (not null, '".$login."', '".$email."', '".$pass."', '".$f_name."', '".$f_comp."', '".$f_address."', '".$f_code."', '".$f_city."', '".$f_phone."', '".$l_name."', '".$l_comp."', '".$l_address."', '".$l_code."', '".$l_city."', '".$l_phone."', '1', '".$kod."', '')");
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

        		//	$letter = ""._FB_THANK.", ".$login."!\r\n\r\n"._FB_POTWIERDZENIE."\r\n".get_bloginfo('url')."/inscription/?verify=confirm&unique=".$kod."\r\n\r\nAmicalement,\r\nL’équipe FRANCE BANDEROLE";
		        //  mail($email, "france-banderole.com Inscription", $letter, "From: FRANCE BANDEROLE <info@france-banderole.fr>");
    	    	//	$view .= '<p>'._FB_TREG.'</p>';
    	    		$view .= get_acces_panel(2);
				    unset($_SESSION['fbreguser']);
				}
			}
		}

	} else {
		if (fb_is_logged()) {
			$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès Client: Edition profil</h1><hr />';
			//$view .= '<p>Note : La modification de votre adresse e-mail est impossible. En cas de changement de cette dernière, merci de contacter un administrateur.</p>';
		} else {
			$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès Client: Inscription</h1><hr />';
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
            	<li class="form-line" id="id_7a" style="display:none;">
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

		/*$view .= '
			<div class="acces_tab_content2">
        	<ul class="regiform">
            <li class="form-line" id="id_20" style="height:auto !important;padding-right:58px;">
            	<div style="position:relative;float:left;display:inline;width:100%;height:50px;">
                <label class="registerlabel"> <br />code sécurité :</label>
                <label style="float:right;display:inline;width:134px;height:50px;"><img alt="Captcha - Reload if it\'s not displayed" id="input_20_captcha" class="form-captcha-image" style="background:url(http://www.jotform.com/images/loader-big.gif) no-repeat center;" src="http://www.jotform.com/images/blank.gif" width="164" height="50" /></label>
                </div>
            </li>
			<div style="width:100%; position:relative; padding-left: 22px;">*
			<div class="g-recaptcha" data-sitekey="6Lf7hfkSAAAAABJmmvitwDK2d_n0rY4c65Xa3FYa"></div>
			<div style="width:80%; float:left">cliquez sur la flèche bleu pour faire aparaître le code </div>
<img src="http://www.jotform.com/images/reload.png" alt="Reload" style="float:left; width:22px; height:22px; cursor:pointer;" onclick="JotForm.reloadCaptcha(\'input_20\');" />
			</div>
            <li class="form-line">
                <div style="white-space:nowrap;">
                	<label class="registerlabel" id="label_20" for="input_20">retaper le code:</label>
                	<input type="text" id="input_20" class="registerinput" name="captcha" />
                    <input type="hidden" name="captcha_id" id="input_20_captcha_id" value="0" />
                </div>
             </li>
            	<li class="form-line" id="id_21">
            	    <div class="form-input-wide">
            	        <div class="pushButton">
            	            <button id="input_21" type="submit" class="register-button">CONTINUER</button>
            	        </div>
            	    </div>
            	</li>
           	 	<li style="display:none;">
           	    	Should be Empty:
                	<input type="text" name="website" value="" />
            	</li>
	        </ul>
			</div>
		</div>
		<script language="JavaScript" type="text/javascript">
			window.onload = JotForm.reloadCaptcha(\'input_20\');
		</script>
		';*/


		$view .= '
			<div class="acces_tab_content2">
        	<ul class="regiform">
            <li class="form-line" id="id_20">
            	<div class="antiSpam">
								ANTI-SPAM, merci de cocher la case ci-dessous:<br/>
               	<div class="g-recaptcha" data-sitekey="6LfnzAgTAAAAADWbNyD5geBFVGSQ_cp1NP1yiBV8"></div>
              </div>
            </li>';


			if(fb_is_logged()) {

			$view .= '
            	<li class="form-line" id="id_21">
            	    <div class="form-input-wide">
            	        <div class="pushButton">
            	            <button id="input_21" type="submit" class="edit-button">EDITER</button>
            	        </div>
            	    </div>
            	</li>
           	 	<li style="display:none;">
           	    	Should be Empty:
                	<input type="text" name="website" value="" />
            	</li>
	        </ul>
			</div>
		</div>
		';
			} else {
				$view .= '
            	<li class="form-line" id="id_21">
            	    <div class="form-input-wide">
            	        <div class="pushButton">
            	            <button id="input_21" type="submit" class="register-button">Inscription</button>
            	        </div>
            	    </div>
            	</li>
           	 	<li style="display:none;">
           	    	Should be Empty:
                	<input type="text" name="website" value="" />
            	</li>
	        </ul>
			</div>
		</div>
		';
			}

		} else {
		$view .= '
			<div id="fbcart_buttons">
        	<ul class="regiform">
            	<li class="form-line" id="id_21">
            	    <div class="form-input-wide">

            	            <button id="input_22" type="submit" class="register-button2">Modifier</button>

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

function get_inscription2() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_address = $prefix."fbs_address";
	$goback = $_GET['goback'];
	if ($goback == '') $goback = $_POST['orderid'];

	$isOwner = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$goback'");
	if (fb_is_logged() && ($isOwner->user == $_SESSION['loggeduser']->id)) {
		$user = $wpdb->get_row("SELECT * FROM `$fb_tablename_address` WHERE unique_id = '$goback'");

		if ($_POST['akcja'] == 'edit') {
			if (!empty($_POST['f_porte'])) {
				$_POST['f_address'] = $_POST['f_address'].'|'.$_POST['f_porte'];
			}
			if ($user) {
				$kolejka = $wpdb->update($fb_tablename_address, array (
																	   'l_name' => addslashes($_POST['f_name']),
																	   'l_comp' => addslashes($_POST['f_comp']),
																	   'l_address' => addslashes($_POST['f_address']),
																	   'l_code' => addslashes($_POST['f_code']),
																	   'l_city' => addslashes($_POST['f_city']),
																	   'l_phone' => addslashes($_POST['f_phone'])),
										 array ('unique_id' => addslashes($_POST['orderid'])) );
			} else {
				$dodaj = $wpdb->query("INSERT INTO `$fb_tablename_address` VALUES (not null, '".addslashes($_SESSION['loggeduser']->id)."', '".addslashes($_POST[orderid])."', '".addslashes($_POST[f_name])."', '".addslashes($_POST[f_comp])."', '".addslashes($_POST[f_address])."', '".addslashes($_POST[f_code])."', '".addslashes($_POST[f_city])."', '".addslashes($_POST[f_phone])."')");
			}
		}

		$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès Client: Livraison Nº '.$goback.'</h1><hr />';
		$action = '<input type="hidden" name="akcja" value="edit" /><input type="hidden" name="orderid" value="'.$goback.'" />';
		$goaction = get_bloginfo('url').'/vos-devis/?detail='.$_GET['goback'];

		$explode2 = explode('|', $user->l_address);
		$l_address = $explode2['0'];
		$l_porte = $explode2['1'];

		$view .= '
		<form action="'.$goaction.'" method="post" name="form_registerform" id="registerform" accept-charset="utf-8">
   		<input type="hidden" name="formID" value="registerform" />'.$action.'
		<div class="acces_left">
			<div class="acces_tab_name2">MODIFIER VOTRE ADRESSE DE LIVRAISON</div>
			<div class="acces_tab_content2">
        	<ul class="regiform2">
            	<li class="form-line" id="id_5">
            	    <label class="registerlabel" id="label_5" for="input_5">prénom et nom:</label>
            	    <input type="text" class="registerinput validate[required]" id="input_5" name="f_name" value="'.stripslashes($user->l_name).'" />
            	</li>
            	<li class="form-line" id="id_6">
            	    <label class="registerlabel" id="label_6" for="input_6">société:</label>
            	    <input type="text" class="registerinput" id="input_6" name="f_comp" value="'.stripslashes($user->l_comp).'" />
            	</li>
            	<li class="form-line" id="id_7">
            	    <label class="registerlabel" id="label_7" for="input_7">adresse <br />de livraison:</label>
            	    <input type="text" class="registerinput validate[required]" id="input_7" name="f_address" value="'.stripslashes($l_address).'" />
            	</li>
            	<li class="form-line" id="id_7a">
            	    <label class="registerlabel" id="label_7a" for="input_7a">code <br />porte/esc./etc:</label>
            	    <input type="text" class="registerinput validate[required]" id="input_7a" name="f_porte" value="'.stripslashes($l_porte).'" />
            	</li>
            	<li class="form-line" id="id_8">
            	    <label class="registerlabel" id="label_8" for="input_8">code postal:</label>
            	    <input type="text" class="registerinput validate[required]" id="input_8" name="f_code" value="'.stripslashes($user->l_code).'" />
            	</li>
            	<li class="form-line" id="id_9">
            	    <label class="registerlabel" id="label_9" for="input_9">ville:</label>
            	    <input type="text" class="registerinput validate[required]" id="input_9" name="f_city" value="'.stripslashes($user->l_city).'" />
            	</li>
            	<li class="form-line" id="id_10">
            	    <label class="registerlabel" id="label_10" for="input_10">tel. de contact:</label>
            	    <input type="text" class="registerinput" id="input_10" name="f_phone" value="'.stripslashes($user->l_phone).'" />
            	</li>
			</ul>
			</div>

			<div id="fbcart_buttons">
        	<ul class="regiform">
            	<li class="form-line" id="id_21">
            	    <div class="form-input-wide">
            	    	<a href="'.get_bloginfo("url").'/vos-devis/?detail='.$goback.'" id="but_retour2"><i class="fa fa-caret-left" aria-hidden="true"></i> Retour</a></a>
          	            <button id="input_22" type="submit" class="register-button2">Modifier</button>
            	    </div>
            	</li>
	        </ul>
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
//				$hasloodszyfrowane = uniqid(rand()); // création d'un nouveau mot de passe
		        $haslo = sha1(md5($hasloodszyfrowane)); // szyfrowanie hasła
				$wysylanie = $wpdb->query("UPDATE `$fb_tablename_users` SET pass = '$haslo' WHERE email = '$adresemail->email'");
				if ($wysylanie) {
	        		$letter = ""._FB_WELCOME.", votre nom d utilisateur est : ".$adresemail->login."\r\n\r\n"._FB_NPASS1." ".$hasloodszyfrowane."\r\n"._FB_NPASS2."\r\n\r\nAmicalement,\r\nL’équipe FRANCE BANDEROLE";
					$header = 'From: FRANCE BANDEROLE <info@france-banderole.fr>';
        			$header .= "\nContent-type: text/plain; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
			        //mail($adresemail->email, "nouveau mot de passe et nom d utilisateur", $letter, $header);
			        wp_mail($adresemail->email, "Nouveau mot de passe et nom d utilisateur", $letter);
    	    		$view .= '<p class="box_info">'._FB_NPASS3.'</p>';
    	    	} else {
    	    		$view .= '<p>'._FB_ERROR.'</p><p><a href="'.get_bloginfo('url').'/acces-client/?resend=pass">'._FB_COFNIJ.'</a></p>';
    	    	}
			} else {
				$view .= '<p>'._FB_PEMAIL.'</p>';
				$view .= get_pass_resend_form();
			}

		}
// mot de passe sous forme de rappel
		elseif ($_GET['resend'] == 'pass') {
			if (!isset($_SESSION['loggeduser'])) {
				$view .= get_pass_resend_form();
			} else {
				$view .= ''._FB_ULOGGED.'';
			}
		}
		elseif ($_POST['logme']=='logme') {
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
				$view .= get_acces_panel($p);
				$view .= '<p><span class="logerror">'._FB_BLH.'</span></p>';
			}
		}
	return $view;
}

function get_pass_resend_form() {
	$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès Client</h1><hr />';
	$view .= '<div class="acces_left">
	<div class="acces_tab_name">mot de passe oublié ?</div>
	<div class="acces_tab_content">
	<p>'._FB_ZGUBA.'</p>
	<form id="resendform" name="resendform" action="'.get_bloginfo('url').'/acces-client/?resend=resend" method="post">

	<input type="text" placeholder="votre email" name="resendaddress" class="logininputOubli" />
	<button id="resendbutton" class="resendbutton" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> envoyer</button>
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
	$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès Client</h1><hr /><img class="aligncenter size-full" title="" src="'.$plugin_url.'/images/accesclient-name.jpg" alt="Accès Client" width="706" height="46" style="margin-bottom: 11px" />';
	$view .= '<div class="acces_left">
	<div class="acces_tab_name">VERIFICATION DE VOS IDENTIFIANTS</div>
	<div class="acces_tab_content">
	<form id="loginform" name="loginform" action="'.$path.'" method="post">
	<input type="hidden" name="logme" value="logme" />
	<label class="loginlabel" for="loginname">nom d\'utilisateur:</label>
	<input type="text" name="loginname" class="logininput" />
	<label class="loginlabel" for="loginpass">mot de passe:</label>
	<input type="password" name="loginpass" class="logininput" />
	<button id="loginsubmit2" class="loginbutton2" type="submit">Se connecter</button>
	</form>
	<a href="'.get_bloginfo("url").'/acces-client/?resend=pass" class="forgetpass">Mot de passe oublié?</a>
	</div>
	</div>';
} else {
	$view .= '<h1><i class="fa fa-lock" aria-hidden="true"></i> Accès Client</h1><hr /><img class="aligncenter size-full" title="" src="'.$plugin_url.'/images/accesclient-name.jpg" alt="Accès Client" width="706" height="46" style="margin-bottom: 11px" />';
	$view .= '<div class="acces_left">
	<div class="acces_tab_name">DEJA INSCRIT?</div>
	<div class="acces_tab_content">
	<form id="loginform" name="loginform" action="'.$path.'" method="post">
	<input type="hidden" name="logme" value="logme" />
	<label class="loginlabel" for="loginname">nom d\'utilisateur:</label>
	<input type="text" name="loginname" class="logininput" />
	<label class="loginlabel" for="loginpass">mot de passe:</label>
	<input type="password" name="loginpass" class="logininput" />
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
