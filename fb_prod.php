<?php

function getTplPath($page = false) {
  if ($page) {
    return ABSPATH . 'wp-content/plugins/fbshop/prod_pages/' . $page;
  } else {
    return ABSPATH . 'wp-content/plugins/fbshop/prod_pages/';
  }
}

function recursive_array_search($needle,$haystack) {
  if (is_array($haystack) || is_object($haystack)) {
    foreach($haystack as $key=>$value) {
      $current_key=$key;
      /*if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
          return $current_key;
      }*/
    	if(@strpos( $value, $needle ) OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
        return $current_key;
      }
    }
  }
  return false;
}


//                                                     SCRIPTS AJOUTES AU HEADER
//==============================================================================

function fbshop_head() {

  //------------------------------------------------------- scripts relais colis
  if (is_page('votre-panier')){
  	$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);
   	if($relais_colis !== false){
  		echo '
      <script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/js/jquery.js"></script>
      <script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/js/jquery-ui.js"></script>
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
      <script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/js/relaisColis.js"></script>
      <link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/css/ui.tabs.css" type="text/css" />
      <link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/css/ui.dialog.css" type="text/css" />
      <link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/css/tntB2CRelaisColis.css" type="text/css" />
  	';
  	}
  }

  //--------------------------------------------------- jotform page inscription
  if (is_page('inscription') || is_page('order-inscription')) {
    echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
    <script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform_reg.js?v3" type="text/javascript"></script>';
    if (isset($_GET['goback'])) {
      echo '<script type="text/javascript">JotForm.init();</script>';
    } else {
      echo '<script type="text/javascript">JotForm.init();</script>
      <script src=\'https://www.google.com/recaptcha/api.js\'></script>
    ';
    }
  }

  //------------------------------------------------------- scripts additionnels
  echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/others.js" type="text/javascript"></script>';

} // fin header pages produits

//                                                         COMPTEUR ITEMS PANIER
//==============================================================================

function is_cart_not_empty() {
  $count = 0;
  if (isset($_SESSION['fbcart']) && is_array($_SESSION['fbcart'])) {
    foreach ($_SESSION['fbcart'] as $item)
      $count++;
    return $count;
  } else  return 0;
}

//                                                         GENERER PAGES PRODUIT
//==============================================================================
// génère le contenu des prod pages en fonction du shortcode placé dans les pages wordpress correspondantes

function generate_page ($page, $pageid) {
  $plugin_url=get_bloginfo('url').'/wp-content/plugins/fbshop/';
  $view .= get_acces_client();

  if ($page=='inscription') {
  	$view = get_inscription();
  	return $view;
  }

  if ($page=='inscription2') {
  	$view = get_inscription2();
  	return $view;
  }

  if ($page=='accesclient') {
  	if (fb_is_logged()) {
  		if ( !(isset($_POST['logme'])) && !(isset($_GET['resend'])) ) {
  			$view .= 'Jesteś zalogowany!';
  		}
  	} else {
  		if ( !(isset($_GET['resend'])) ) {
  			$p = 1;
  			$view .= get_acces_panel($p);
  		}
  	}
  	return $view;
  }

  if ($page=='votre') {
  	$view .= get_votre();
  	return $view;
  }

  if ($page=='livredor') {
  	$view .= get_rating_page();
  	return $view;
  }

  if ($page=='Devis') {
  	$view .= get_devis();
  	return $view;
  }

  if ($page=='verification') {
  	$view .= get_verification();
  	return $view;
  }

  if ($page=='paiement') {
  	$view .= get_payement();
  	return $view;
  }

  if ($page=='plv') {
  	$view .= get_plv();
  	return $view;
  }

  if ($page=='plv_int') {
  	$view .= get_plv_int();
  	return $view;
  }

  if ($page=='acc') {
  	$view .= get_acc();
  	return $view;
  }

  if ($page=='newslett') {
  	$view .= get_newsletter_un();
  	return $view;
  }

  if ($page=="valider_BAT") {
  	$view .= get_valider_bat();
  	return $view;
  }

	if ($page=='flyers') {
		$h1name='Flyers pas cher, impression flyer meilleur prix, Prospectus, tracts, imprimer flyer rapidement papier PEFC et FSC';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f4';
		$info_title='Impression rapide flyers pas cher - prospectus - dépliant';
		$info_info='<span class="prezHide">Support de communication incontournable, du Flyers pas cher A5 au prospectus cartonné 350g couché brillant ou depliants 1 ou 2 plis, nos flyers au prix le plus bas sont disponibles en petite quantité. Flyers pas cher  A3 - A4 - A5 - A6 - A7. Impression rapide de flyers pas cher recto ou recto/verso. Nous étudions également toutes vos demandes spécifiques. Nous pouvons également réaliser des dimensions personnalisées pour des carte de voeux etc... <b>Livraison gratuite partout en France métropolitaine</b></span>';
		$formularz = get_flyers_form();
	}

	if ($page=='depliants') {
		$h1name='Depliant publicitaire pas cher leaflet pli portefeuille pli roulé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f13';
		$info_title='Dépliant leaflet personnalisés 1 ou 2 plis';
		$info_info='<span class="prezHide">Acheter des depliants 1 pli, 2 plis au meilleur prix et en petite quantité pour ne payer que ce dont vous avez besoin. Nos impressions numériques sur presses numériques et offset vous permettent aujourd\'hui de profiter de dépliant pas cher et d\'imprimer votre propre publicité et prospectus publicitaire au meilleur tarif.</span>';
		$formularz = get_depliants_form();
	}

	if ($page=='stand-parapluie') {
		$h1name='Stand parapluie meilleur prix - stand tissu tendu - Stand pas cher - stand a montage rapide - comptoir d\'accueil tissu ';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f11';
		$info_title='Stand parapluie - stand tissu tendu - comptoir d\'accueil';
		$info_info='<span class="prezHide">Le meilleur prix stand parapluie tissu et comptoir d\'accueil à montage rapide. Nos stands EasyQuick et Expo\'Bag ont été étudiés pour répondre aux besoins de chaque exposant en fonction de son budget.<br />La structure du stand tissu EasyQuick est en aluminium ce qui lui confèrent robustesse et légèreté pour assurer un montage rapide et facile. Fiabilité et qualité des matériaux assurent à nos stands le meilleur rapport qualité prix. <b>Stand tissu livré complet</b>, prêt à poser avec structure + visuel + sac de transport</span>';
		$formularz = get_parapluie_form();
	}

	if ($page=='panneaux-forex-dibond') {
		$h1name='meilleur prix panneau forex,  panneau dibond pas cher, panneau komacell, panneau komadur, enseigne publicitaire pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f12';
		$info_title='Panneaux Forex - komadur - panneau alu Dibond -  enseigne';
		$info_info='<span class="prezHide">Le meilleur prix sur panneaux forex, Kömadur ou alu-dibond pas cher chez France Banderole. Impression UV standard ou UV HD directement sur le support toutes dimensions jusqu\'à 300x200cm. Option lamination de protection anti-UV possible brillant / mat / anti-graffiti sur tous supports, toutes dimensions. délai de livraison rapide jusqu\'à 24/48h partout en France métropolitaine. <b>Panneaux livrés en mètre linéaire en standard. option livraison sur palette plein format possible jusqu à 300x200cm.</b></span>';
	}

	if ($page=='panneaux-akilux') {
		$h1name='meilleur prix panneaux akilux, panneau akylux pas cher, panneau alvéolaire publicitaire, panneau de chantier, permis de construire';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux1';
		$info_title='Le meilleur prix panneaux Akilux - panneaux akylux alvéolaire';
		$info_info='<span class="prezHide">L\'impression sur panneaux akilux 3mm - 3,5mm - 5mm est moins cher chez France Banderole car le panneaux akylux est imprimé directement en UV standard ou UV HD  dès 1 exemplaire jusqu\'aux dimensions personnalisées 150x200cm. Les panneaux akilux servent à réaliser des panneaux publicitaires pas cher, panneau de chantier, panneaux permis de construire, PLV extérieur pour point de vente, cache borne anti-vol pas cher. <b>Délai de livraison rapide jusqu\'à 24/48h partout en France métropolitaine</b></span>';
	}

	if ($page=='panneaux-akilux-3mm') {
		$h1name='panneaux akilux 3mm pas cher, panneau akylux meilleur prix, panneaux de chantier prix en ligne, Akilux 3mm Akilux 450g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux';
		$info_title='Panneaux Akilux pas cher 3mm - akilux 450g/m² - pancarte akylux';
		$info_info='<span class="prezHide">Les panneaux Akilux au meilleur prix sont fabriqués en Akilux 3mm ou 450g. Impression directe UV standard ou UV HD sur panneaux akilux sur mesure personnalisés toutes tailles de 20x20cm minimum, akylux 60X80cm ou 80X120cm, 120X160cm. Nos panneaux akilux pas cher sont livrés au choix avec oeillet, rainage, crochets, double face, pour réalisation de panneaux extérieur PLV, panneau de chantier, cache borne anti-vol pas cher, triptyque publicitaire, <b>publicité sur panneau pas cher et fabriqué en France !</b></span>';
		$formularz = get_akilux3mm_form();
	}

	if ($page=='panneaux-akilux-3_5mm') {
		$h1name='panneaux akilux 3,5mm pas cher, panneau akylux meilleur rapport qualité prix, affiche permis de construire, Akilux 3,5mm, Akylux 600g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux-3_5';
		$info_title='Panneaux akilux 3.5mm - Akylux 600g/m² - panneau akilux';
		$info_info='<span class="prezHide">Panneaux akylux au meilleur rapport qualité/prix fabriqués en Akilux 3,5mm ou 600g. Impression directe UV standard ou UV HD sur panneaux akilux 3.5mm sur mesure toutes tailles de 20x20cm minimum, akylux 60X80cm ou 80X120cm, jusqu\'à 150X200cm. Nos panneaux akilux 3,5mm sont livrés au choix avec oeillet, rainage, crochets, double face, pour réalisation de PLV de rue pas cher, panneau permis de contruire, <b>marquage sur panneau rigide pas cher et fabriqués en France !</b></span>';
		$formularz = get_akilux3_5mm_form();
	}

	if ($page=='panneaux-akilux-5mm') {
		$h1name='panneaux akilux, panneau akylux, panneaux de chantier, Akilux 5mm, Akilux 900g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux-5mm';
		$info_title='Panneaux akilux 5mm - Akylux 900g/m² - panneau akilux';
		$info_info='<span class="prezHide">Les panneaux akilux résistant au meilleur rapport qualité/prix sont fabriqués en akilux 5mm. nos panneaux akilux imprimés en UV standard ou UV HD sont fabriqués sur mesure avec une dimension minimum de 20x20cm pouvant aller jusqu\'à 120X160cm et des tailles personnalisées. Nos panneaux akilux au meilleur prix sont livrés au choix avec oeillet, rainage, crochets, double face... pour réaliser panneau permis de construire, <b>enseigne publicitaire rigide pas cher et fabriqué en France !</b></span>';
		$formularz = get_akilux5mm_form();
	}

	if ($page=='PVC-300-microns') {
		$h1name='PVC 300 microns, feuille semi rigide pvc impression PVC 300 Microns';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='PVC-300-microns';
		$info_title='PVC 300 microns semi-rigide anti-feu M1';
		$info_info='<span class="prezHide">Le PVC 300µ semi rigide anti-feu M1 imprimé par France banderole vous permet d\'acheter et de créer des PLV suspendues au meilleur prix, stop rayon, tête de gondole. Nous imprimons le PVC 300µ M1 en impression directe UV standard (PLV suspendue) ou UV HD (tête de rayon ou PLV point de vente) en recto ou PLV recto/verso pour obtenir le meilleur rapport qualité/prix. Nous vous proposons le PVC 300 microns avec perçage ou oeillet en finition standard et <b>livraison toujours gratuite en France métropolitaine.</b></span>';
		$formularz = get_PVC300microns_form();
	}

	if ($page=='tente-publicitaire-barnum') {
		$h1name='Tente publicitaire pliante - chapiteau personnalisé - barnum publicitaire - tente exposition personnalisée';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='tentes';
		$info_title='Tente publicitaire pas cher - chapiteau - barnum personnalisé';
		$info_info='<span class="prezHide">Meilleur prix tentes publicitaires personnalisées pliantes en 30 secondes, système EasyQuick. tente publicitaire professionnelle 2x2m au 4x6m personnalisable, couleurs au choix ou full graphique, choisissez tous les éléments de votre tente personnalisée, mur ou demi-mur, toit et fronton personnalisables au meilleur tarif pour une utilisation intensive lors de manifestation ou évènement sportif. Montage rapide et facile, <b>livrée complète prêt à installer, sac de transport sur roulette offert et livraison gratuite !</b></span>';
		$formularz = get_tente_exposition_form();
	}

  if ($page=='nappes-publicitaires') {
		$h1name='Nappe publicitaire personnalisée - tissu publicitaire - nappe imprimée pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='nappes';
		$info_title='Nappes publicitaires - nappe personnalisée - nappe imprimée';
		$info_info='<span class="prezHide">La nappe est un support publicitaire pas cher pour habiller vos tables lors de vos salons professionnels, expositions, séminaires, congrès ou aussi bien pour décorer votre intérieur. Imprimée sur du tissu en 220gr ou en 260gr, vous pouvez choisir sa forme ronde carrée ou rectangulaire. Nos nappes personnalisées imprimées au meilleur prix ont par défaut un ourlet avec une double surpiqûre.<br /> <b>livraison gratuite en France métropolitaine !</b></span>';
		$formularz = get_nappes_form();
	}

	if ($page=='panneaux-akilux-10mm') {
		$h1name='panneaux akilux rigide, panneau akylux, panneaux de chantier, Akilux 10mm, akylux 1800g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux-10mm';
		$info_title='Panneaux Akilux alvéolaire 10mm';
		$info_info='<span class="prezHide">Les panneaux Akilux en Akilux 10mm. Impression directe UV sur panneaux akilux. tailles de 60X40cm, 60X80cm, 80X120cm, 120X160cm et panneaux akilux personnalisés.<br />Nos panneaux akilux sont livrés au choix avec oeillet, rainage, crochets, double face... de 1 à 10.000 exemplaires fabriqués en France !</span>';
		$formularz = get_akilux10mm_form();
	}

	if ($page=='panneaux-forex-1mm') {
		$h1name='Forex 1mm, feuille semi rigide pvc impression forex';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='forex-1mm';
		$info_title='Forex 1mm semi-rigide';
		$info_info='<span class="prezHide">Les enseignes et panneaux France banderole sont fabriquées en Forex ou Alu-Dibond au choix, avec formes rectangulaires, carrées. la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe en UV, anti reflet, anti rayures pour une protection optimale.<br />Nos enseignes sont livrées en mètre linéaire, emballées et prêtes à monter (hors perçage).</span>';
		$formularz = get_forex1mm_form();
	}


	if ($page=='panneaux-komadur') {
		$h1name='Kömadur 2mm PVC rigide pour l\'affichage publicitaire sur panneau en intérieure ou extérieur';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='komadur';
		$info_title='Panneaux PVC rigide - panneau Kömadur 2mm green PVC rigide';
		$info_info='<span class="prezHide">Les enseignes et panneaux pas cher France banderole fabriqués en Kömadur sont au meilleur rapport qualité/prix. Fabriqué en PVC extrudé de surface lisse et satinée, le Kömadur est un produit haut de gamme qui bénéficie de toutes les avancées techniques et savoir-faire de KÖMMERLING. Impression directe UV, avec lamination anti-UV ou anti-graffiti possible pour une protection optimale. <b>Nos panneaux sont livrées en mètre linéaire, emballées et prêt à monter.</b> Option envoi en un seul panneau possible jusqu\'à 150x300cm</span>';
		$formularz = get_komadur_form();
	}

	if ($page=='panneaux-forex-3mm') {
		$h1name='Forex 3mm pour publicité intérieure tête de gondole, Plv suspendue - panneau photo';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='forex-3mm';
		$info_title='Forex 3mm semi-rigide pour ILV PLV - panneau forex';
		$info_info='<span class="prezHide">les panneaux Forex France banderole sont fabriquées en Forex 3mm, avec dimensions personnalisées au choix jusqu\'à 150x300cm . la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe UV, avec lamination anti-UV ou anti-graffiti possible pour une protection optimale. <b>Nos panneaux Forex 3mm sont livrés en mètre linéaire, emballés et prêts à monter</b>.<br /> Option envoi en un seul panneau possible jusqu\'à 150x300cm.</span>';
		$formularz = get_forex3mm_form();
	}

	if ($page=='panneaux-forex-5mm') {
		$h1name='Forex 5mm décor interieur plv suspendue rigide';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='forex-5mm';
		$info_title='Forex 5mm rigide - enseigne provisoire - panneau forex';
		$info_info='<span class="prezHide">les panneaux rigide Forex France banderole sont fabriquées en Forex 5mm, avec dimensions personnalisées au choix jusqu\'à 150x300cm . la durabilité en extérieur est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe UV, avec lamination anti-UV ou anti-graffiti possible pour une protection optimale. <b>Nos panneaux Forex 5mm sont livrés en mètre linéaire, emballés et prêts à monter</b>.<br /> Option envoi en un seul panneau possible jusqu\'à 150x300cm.</span>';
		$formularz = get_forex5mm_form();
	}

	if ($page=='panneaux-alu-dibond') {
		$h1name='Impression sur panneaux alu dibond, panneaux dibond 3mm panneau enseigne rigide';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='dibond';
		$info_title='panneaux alu dibond 3mm - enseigne publicitaire dibond pas cher';
		$info_info='<span class="prezHide">Les enseignes alu dibond et panneaux alu dibond imprimés par France banderole sont fabriqués en Alu Dibond 3mm, avec formes rectangulaires ou carrées. la durabilité est assurée par un choix de matériau de base ultra résistant ainsi qu\'une impression directe UV standard ou HD, avec lamination anti-UV ou anti-graffiti possible pour une protection optimale. <b>Nos enseignes panneaux alu dibond sont livrées en mètre linéaire, emballées et prêtes à monter.</b> L\'option envoi en un seul panneau est possible jusqu\'à 300x200cm</span>';
		$formularz = get_dibond_form();
	}

	if ($page=='affiches') {
		$h1name='Affiches, affiche publicitaire, affiche grand format, Poster, poster XXL';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f5';
		$info_title='Imprimer Affiches Posters petit & grand format';
		$info_info='<span class="prezHide">Imprimer rapidement 10 affiches A1 devient possible avec France Banderole. Nos presses numériques et offset vous permettent d\'acheter 1, 10 ou 10000 affiches ou posters grand format sur papier couché pour un résultat d\'impression avec des couleurs éclatantes. Acheter un poster personnalisé ou une affiche grand format unique pour vous assurer le meilleur prix.</span>';
		$formularz = get_affiches_form();
	}

	if ($page=='cartes') {
		$h1name='Cartes de visite pas cher haut de gamme indechirables - Carte restaurant - Sets de table indéchirable';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f6';
		$info_title='Cartes de Visite & cartes restaurant indéchirables';
		$info_info='<span class="prezHide">La carte de visite pas cher la plus vendue est au format cartes de visite 5,5x8,5cm. c\'est également la plus pratique à ranger dans les portefeuilles. Nous imprimons tous les formats de cartes de restaurant et set de table indéchirables. Les cartes de visite, cartes restaurant et sets de table sont disponibles en petite série dès 100 cartes de visites et 50 sets de table indéchirables. Acheter en petite quantité pour ne plus gâcher !</span>';
		$formularz = get_cartes_form();
	}

  if ($page=='Stand-expo-et-plv') {
    $h1name='PLV intérieur : tout pour les salons professionels stand tissu publicitaire exposition, foire, enseigne cadre nappe Kakemonos Roll-ups et totems';
    $imghead1='kakemonos1';
    $imghead2='kakemonos2';
    $imghead3='kakemonos3';
    $mini='bt-merge-int';
    $info_title='Gamme complète de PLV pour salon pro, exposition, décoration';
    $info_info='<span class="prezHide">Tous nos supports de communication en intérieur: du stand tissu pas cher en passant par le comptoir d\'accueil imprimé, du kakemono suspendu à la nappe tissu personnalisé, du roll-up à prix mini à l\'enseigne suspendue textile tissu tendu, du totem publicitaire à l\'oriflamme anti-feu et des cadres textiles slim ou rétro-éclairés au meilleur prix. tarif direct et devis en ligne. toutes nos impressions sont made in France. <br />
	<b>Livraison possible le jour même, en 24/48H ou 7/9 jours, en France métropolitaine</b></span>';
  }

  if ($page=='Signaletique-exterieur') {
    $h1name='Signalétique extérieur : publicité exterieur - enseigne dibond - panneaux forex - oriflammes & tentes publicitaires';
    $imghead1='kakemonos1';
    $imghead2='kakemonos2';
    $imghead3='kakemonos3';
    $mini='bt-merge-ext';
    $info_title='Signalétique extérieur - publicité extérieur - PLV - Panneaux';
    $info_info='<span class="prezHide">Fabricant de signalétique et communication en extérieur : du beachflag oriflamme windflag au meilleur prix, à l\'enseigne publicitaire en Dibond pas cher en passant par les panneaux akilux pour agences immobilières ou panneaux Forex, les tentes personnalisées, barnums publicitaires et PLV extérieur. Tarif direct et devis en ligne. Tous nos produits sont disponibles sur stock, toutes nos impressions sont made in France.<br />
	<b>Livraison possible le jour même, en 24/48H ou 7/9 jours, en France métropolitaine</b>.</span>';
  }

	if ($page=='Stickers') {
		$h1name='Autocollants - Stickers adhesifs - Magnets - Vitrophanie - Covering voiture - lettrage prédécoupé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f7';
		$info_title='Autocollants - Stickers - magnet - lettrage - sticker repositionnable';
		$info_info='<span class="prezHide">Les autocollants sont imprimés en quadri numérique haute définition et sont livrés prédécoupés en planche. Les stickers sont imprimés en quadri numérique haute définition et sont livrés coupés au format à l\'unité. Le lettrage adhésif est livré en planche. les vitrophanies sont livrées entières. les décorations murales (sticker repositionnable) sont livrées pré-découpées. Vous pouvez selectionner le matériau au choix, en fonction de votre utilisation (vitrine extérieur, vitrophanie, magnet pour véhicule, etc...)</span>';
	}

  if ($page=='Imprimerie-Papier') {
    $h1name='Imprimerie papier flyers prospectus dépliants carte visite affiches';
    $imghead1='kakemonos1';
    $imghead2='kakemonos2';
    $imghead3='kakemonos3';
    $mini='bt-merge-papier';
    $info_title='Imprimerie papier flyer pas cher dépliant AFfiches prospectus carte';
    $info_info='<span class="prezHide">Toutes nos impressions papier : Affiches, flyers pas cher, dépliants 1 ou 2 plis, brochures, prospectus et cartes de visite. Choisissez le type de produits puis les différentes options disponibles sur nos papiers, puis les quantités et laissez vous guider.<br />
	<b>Livraison possible le jour même, en 24/48H ou 7/9 jours, en France métropolitaine</b></span>';
  }


	if ($page=='Sticker-predecoupe') {
		$h1name='Stickers adhesifs prédécoupés - lettrage prédécoupé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='sticker-predecoupe';
		$info_title='Stickers prédécoupés';
		$info_info='<span class="prezHide">Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.</span>';
		$formularz = get_sticker_predecoupe_form();
	}

  if ($page=='Sticker-mural') {
    $h1name='Stickers et papier peint pour décoration murale';
    $imghead1='kakemonos1';
    $imghead2='kakemonos2';
    $imghead3='kakemonos3';
    $mini='sticker-mural';
    $info_title='Stickers repositionnables papier peint adhésif décoration murale';
    $info_info='<span class="prezHide">Les vinyles adhésifs muraux (stickytex) haut de gamme sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Il peuvent être retiré et repositionné sans endommager le mur ni laisser aucun résidu. Ne risque pas de déchirer et est imperméable à l\'eau.</span>';
    $formularz = get_sticker_mural_form();
  }

	if ($page=='Sticker-lettrage-predecoupe') {
		$h1name='Stickers adhesifs prédécoupés - lettrage prédécoupé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='sticker-lettrage';
		$info_title='Stickers lettrages prédécoupés';
		$info_info='<span class="prezHide">Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.</span>';
		$formularz = get_sticker_lettrage_predecoupe_form();
	}

	if ($page=='autocollant') {
		$h1name='Autocollants - Stickers adhesifs - Magnets';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='autocollant';
		$info_title='Autocollants';
		$info_info='<span  class="prezHide">Les vinyles adhésifs (autocollant) sont imprimés en quadri numérique haute définition et sont livrés prédécoupés en planche.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.</span>';
		$formularz = get_autocollant_form();
	}

	if ($page=='vitrophanie') {
		$h1name='Vitrophanie - Sticker transparent - Vinyle micro-perforé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='vitrophanie';
		$info_title='Vitrophanie';
		$info_info='<span class="prezHide">Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.</span>';
		$formularz = get_vitrophanie_form();
	}

	if ($page=='Oriflammes') {
		$h1name='Oriflamme meilleur prix - Beachflag - Windflag - Voile publicitaire pas cher - Drapeaux personnalisés manifestation - flying banner - oriflammes';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f3';
		$info_title='Oriflamme Windflag Beachflag, drapeaux et voile publicitaire';
		$info_info='<span class="prezHide">Fabricant Oriflamme publicitaire aile d\'avion, BeachFlag goutte d\'eau, Windflag rectangulaire et voile publicitaire personnalisée. Produit en france, conception robuste, nos oriflammes, drapeaux et voiles publicitaires se distinguent par une finition haut de gamme. Toujours au meilleur prix, les oriflammes s\'utilisent en INT (garantie anti-feu) ou EXT et sont un atout majeur pour vos manifestations, salons ou expositions. Production et livraison express possible en 48h/72H en France métropolitaine.</span>';
		$formularz = get_oriflammes_form();
	}

	if ($page=='Kakemonos') {
		$h1name='Kakemono Roll-up meilleur prix - Rollup enrouleur - kakemono rolup - kakemono enrouleur - roll-up pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f2';
		$info_title='Kakemono Roll-Up Enrouleur';
		$info_info='Le kakemono roll-up ou rollup, un support vertical intérieur de choix de par sa simplicité d’usage et son esthétisme. Son impact visuel fait du roll-up un vecteur de communication idéal pour vos manifestations, salons, expositions, communication interne (accueil, séminaires…). <b>Tous nos roll-up enrouleurs sont livrés GRATUITEMENT avec visuel monté, housse de protection, sac de transport et carton.</b>';
		$formularz = get_kakemonos_form();
	}

	if ($page=='roll-up' || $page=='test-roll-up') {
		$h1name='Kakemono Roll-up meilleur prix - Rollup enrouleur - kakemono rolup - kakemono enrouleur - roll-up pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='roll-up';
		$info_title='Kakemono Roll-Up Enrouleur rollup publicitaire';
		$info_info='<span class="prezHide">Le kakemono roll-up ou rollup, un support publicitaire vertical intérieur de choix de par sa simplicité d’usage et son esthétisme. Son impact visuel fait du roll-up un vecteur de communication idéal pour vos salons professionnels, expositions, communication interne (accueil, séminaires…). Chez France banderole, LE meilleur prix roll-up enrouleur et SANS surprise :<b>livré avec visuel imprimé et monté, <b>housse de protection, sac de transport et carton individuel !</b> (si si...)</b></span>';
		if ($page=='roll-up') $formularz = get_rollup_form();
    else if ($page=='test-roll-up') $formularz = get_test_rollup_form();
	}

	if ($page=='construction') {
		$h1name='construction';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='totem';
		$info_title='construction ';
		$info_info='construction';
		$formularz = get_construction_form();
	}

	if ($page=='totem') {
		$h1name='Kakemono - Totem - totem publicitaire - kakemono exterieur Blizzard - totem suspendu clip it - X-banner X-screen';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='t';
		$info_title='Totem publicitaire intérieur et extérieur ';
		$info_info='<span class="prezHide">Le totem publicitaire, un support de communication PLV à forte valeur ajoutée. l impact visuel vertical des totem publicitaires font d eux, un vecteur de communication parfait pour la publicité intérieur sur point de vente, salons professionnels, foire expo... Choisissez le type de totem au meileur prix qu il soit suspendu comme la gamme totem clipit, le totem X-banner ou en extérieur, le kakemono totem Blizzard.</span>';
		$formularz = get_totem_form();
	}

  if ($page=='Banderoles' || $page=='test-banderoles') {
		$h1name='Banderole - Banderoles - Banderole Publicitaire - banderole imprimée - impression banderole - bache publicitaire - bâche imprimée';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f1';
		$info_title='Banderole publicitaire - bâche imprimée - banderole géante ';
		$info_info='<span class="prezHide">France Banderole fabricant de banderoles publicitaires, impression numerique au meilleur prix. Les baches publicitaires s’adaptent à toutes vos communications : événementiel, exposition, échafaudage, foire ou salon… banderole pour intérieur (Anti-feu M2,M1), ou banderole spécial extérieur, la banderole se positionne facilement. Impression sur bache en qualité photo. Toutes nos banderoles sont fabriquées en France, et sont recyclables ou écologiques. Banderoles livrées le jour même chez vous ou au choix de 24/48H à 7/9 jours</span>';
		if ($page=='Banderoles') $formularz = get_banderoles_form();
    else if ($page=='test-banderoles') $formularz = get_test_banderoles_form();
	}

   if ($page=='cadre-tissu') {
		$h1name='cadre tissu - cadre textile - cadre tissu tendu - cadres textile tendu - cadre textile mural interieur';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='cadre-textile';
		$info_title='Cadre tissu stand publicitaire - cadre textile décoration intérieur';
		$info_info='<span class="prezHide">France Banderole fabricant de cadre textile tendu pour l’habillage de cloison de stand modulaire publicitaire. cadre tissu slim ou cadre rétro-éclairé, le cadre tissu vous permettra une décoration murale intérieur en magasin, entreprise, chez vous ou un habillage de cloison de stand modulaire. Dimensions entièrement sur mesure et fabrication express. Facilité de montage entre la structure et le visuel grâce au jonc spécial consu sur le tissu tendu. <b>Le cadre tissu tendu pas cher est livré complet, avec votre visuel prêt-à-installer.</b></span>';
		$formularz = get_cadre_form();
	}


	 if ($page=='enseigne-suspendue-textile') {
		$h1name='enseigne suspendue tissu pour stand - enseigne tissu suspendue géante - enseigne textile salon pro';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='enseigne-suspendue';
		$info_title='Enseigne suspendue textile pas cher - suspension tissu publicitaire';
		$info_info='<span class="prezHide">France Banderole fabricant d’enseigne suspendue textile géante au meilleur prix. L’enseigne textile suspendue embellit un stand et vous démarque sur un salon professionnel ou en magasin. Elle permet de vous localiser rapidement, et peut aussi agrémenter un hall d’entreprise. l’enseigne textile est fabriquée ronde, carrée, triangulaire ou sur mesure, et permet d’apporter la meilleure finition à un espace publicitaire. <b>Enseigne suspendue livrée complète, avec sac de transport + système de fixation, prêt à poser</b>. </span>';
		$formularz = get_enseigne_suspendue_form();
	}


  if ($page!=='azgeag') {
	  $wycena = '';
	} else {
    $wycena = '<div id="wycena">
  	<div id="wycena_nag"><span class="wycena_poz">PRIX UNITAIRE</span><span class="wycena_poz">OPTION</span><span class="wycena_poz">TOTAL H.T.</span></div>
  	<div id="wycena_suma"><span class="wycena_poz" id="prix_unitaire">-</span><span class="wycena_poz" id="option">-</span><span class="wycena_poz" id="total">-</span></div>
  	<div id="dodaj_koszyk">';

  	$wycena .= '<div id="livraisonrapide" style="display:none; float:left"><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/livraison_rapide/liv-rapide.jpg" alt="Impression et livraison le jour meme !" title="Imprimer et livrer le jour-même"/></div>';
    // ajout de l'affichage livraison comprise
    $wycena .= '<div id="livraisonComp" style="display:none"><span id="forfait"></span>Livraison comprise</div>';
  	$wycena .= '<form name="cart_form" id="cart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post"></form>';
    $wycena .= '<div id="form-button-error2"></div>';
    $wycena .= '<div id="form-button-error1"></div>';
  	$wycena .= '</div></div>';
  	$view .= '<h1 class="h1product">'.$h1name.'</h1><hr />';
  }

  $view .= '<div id="top_info"><div class="front"><img class="alignleft size-full" src="'.$plugin_url.'images/'.$mini.'.png" alt="" /></div><div id="top_info_info" class="back"><span class="info_nag">'.$info_title.'</span><br /><span class="prod-desc">'.$info_info.'</span></div></div>';
	$view .= $formularz;
	$view .= $wycena;

	return $view;

} // fin générer pages produits

//                                                                   CONTACT IMG
//==============================================================================
function contact_advert() {
	$plugin_url=get_bloginfo('url').'/wp-content/plugins/fbshop/';
	$view .= '<div id="contact_advert"><a href="tel:+33442401401"><img src="'.$plugin_url.'images/contact_info.jpg" alt="contact with us" /></a></div>';
	return $view;
}

//                                                                  RELAIS COLIS
//==============================================================================

function get_mode_de_livraison(){
	$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);
 	if($relais_colis !== false){
		$retour = '<div class="acces_tab_name_devis noprint">CHOISIR VOTRE RELAIS COLIS<sup><i class="fa fa-registered" aria-hidden="true"></i></sup></div>
			';
		$retour .= '<div id="tntB2CRelaisColis" class="exemplePresentation"></div>
		<div id="map_canvas" class="exemplePresentation"></div>';

		$retour .= '
		<form action="" method="post" name="form_adresse_relais_colis" id="form_adresse_relais_colis">
      <input type="hidden" id="tntRCSelectedCode" value=""/>
      <input type="hidden" id="tntRCSelectedNom" value=""/>
      <input type="hidden" id="tntRCSelectedAdresse" value=""/>
      <input type="hidden" id="tntRCSelectedCodePostal" value=""/>
      <input type="hidden" id="tntRCSelectedCommune" value=""/>
		</form>

    <div style="text-align: justify; font-family: arial,helvetica,sans-serif; font-size: 10pt; width: 600px;">
			<div id="exempleIntegration">
				<script type="text/javascript">
				  	function callbackSelectionRelais() {

				  		// Récupération des informations
				  		var codeRelais = $("#tntRCSelectedCode").val();
			  			var nom = $("#tntRCSelectedNom").val();
			  			var adresse = $("#tntRCSelectedAdresse").val();
			  			var codePostal = $("#tntRCSelectedCodePostal").val();
			  			var commune = $("#tntRCSelectedCommune").val();

				  		if (!codeRelais || codeRelais == "") {
				  			alert("Aucun relais n\'a été sélectionné !");
							return false;
				  		}else {
				  			//alert("Info relais sélectionné"+
				  			//	  "\nCode\t\t: " + codeRelais +
				  			//	  "\nNom\t\t: " + nom +
				  			//	  "\nAdresse\t\t: " + adresse +
				  			//	  "\nCode postal\t: " + codePostal +
				  			//	  "\nCommune\t\t: " + commune);

  							var formData = {
  								  codeRelais : codeRelais,
  								  nom : nom,
  								  adresse : adresse,
  								  codePostal : codePostal,
  								  commune : commune
  							}

						  	var request = $.ajax({
								  url: "/wp-content/plugins/fbshop/relais_colis_ajax.php",
								  type: "POST",
								  data : formData
					  		});
							return true;
				  		}
				  	}

				  	function callbackSelectionRelaisClick() {
						//alert("1ere instruction");
						if(callbackSelectionRelais()){
							//alert("2nde instruction: dans if");
				  		// Récupération des informations
				  		var codeRelais = $("#tntRCSelectedCode").val();
			  			var nom = $("#tntRCSelectedNom").val();
			  			var adresse = $("#tntRCSelectedAdresse").val();
			  			var codePostal = $("#tntRCSelectedCodePostal").val();
			  			var commune = $("#tntRCSelectedCommune").val();
				  			alert("Info relais sélectionné"+
				  				  "\nCode\t\t: " + codeRelais +
				  				  "\nNom\t\t: " + nom +
				  				  "\nAdresse\t\t: " + adresse +
				  				  "\nCode postal\t: " + codePostal +
				  				  "\nCommune\t\t: " + commune);

							var url2 = "'.get_bloginfo("url").'/verification/";
							$(location).attr(\'href\',url2);
						}else{
							//alert("211Aucun relais n\'a été sélectionné !");
							return false;
						}
					}
				</script>
			</div>
		</div>
		';
	}
	//else $retour = "Pas de relais colis";
	//$retour .= print_r($_SESSION,true);
	return $retour ;
} // fin relais colis

//============================================================== check row empty

function isRowEmpty($row){
  return true;
  foreach($row as $a){
    if(empty($a) || $a == 0){
      return false;
    }
  }

}

//                                      ACTIONS AU CHARGEMENT PAGE VOS COMMANDES
//==============================================================================

function get_votre() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";
  $promo = $_POST['codeProm'];

	if (fb_is_logged()) {

		if (isset($_POST['votrecompte']) && isset($_SESSION['fbcart'])) {

			add_to_db(); // enregistrement de la commande
			$view .= print_votre();

		} else {
			$view .= print_votre();
		}

	} else {

		if (!(isset($_POST['logme']))) {

      //si vous avez fait des paiements et l'utilisateur connecté hors cours
    	if (isset($_GET['paid']) && isset($_POST[DATA])) {
      	// RÈcupÈration de la variable cryptÈe DATA
      	$message="message=".$_POST[DATA];
      	$pathfile="pathfile=/home/frbanderolecom/www/sherlock/param/pathfile";
      	$path_bin = "/home/frbanderolecom/www/sherlock/bin/response";
      	$result=exec("$path_bin $pathfile $message");
      	$tableau = explode ("!", $result);

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
      	$logfile="/home/frbanderolecom/www/sherlock/log/logfile.log";
      	$fp=fopen($logfile, "a");

       	if (( $code == "" ) && ( $error == "" ) ) {
      	  fwrite($fp, "erreur appel response\n");
        	echo "executable response non trouve $path_bin\n";
       	} else if ( $code != 0 ){
          fwrite($fp, " API call error.\n");
          fwrite($fp, "Error message :  $error\n");
       	}	else {
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
      		fwrite( $fp, "-------------------------------------------\n");

      		fclose ($fp);
      		if($bank_response_code=='00') {
      			$setorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$order_id'");
      			if ($setorder->status == '1') {
      				$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='2' WHERE unique_id='$order_id'");
      				if (!$apdejt) {
      					$view .= 'Erreur appel response. Contactez l\'administrateur.';
      				} else {
      					$view .= 'Votre paiement est accepté. Merci de vous connecter à votre compte.';
      				}
      			}
      		}
      	}
    	}

			$view .= get_acces_panel(0);
		}
	}
	return $view;
}

//                                              ACTIONS A LA VERIFICATION PANIER
//==============================================================================

function get_verification() {
	if (fb_is_logged()) {
		$prolog = '<h1><i class="fa fa-lock" aria-hidden="true"></i> Votre devis: Verification de la commande</h1><hr />';
		if (is_cart_not_empty() || isset($_GET['share'])) {

			$products = $_SESSION['fbcart'];
			$user = $_SESSION['loggeduser'];
      $promo = $_POST['codeProm'];

			$prolog .= '<div class="acces_tab_name_devis">VOTRE COMMANDE</div>';
			$epilog_a .= '<a href="'.get_bloginfo("url").'/votre-panier/?cart=clear" id="but_annuler"><i class="fa fa-times-circle" aria-hidden="true"></i> Annuler la commande</a>';
			$epilog_b .= '<a href="'.get_bloginfo("url").'/votre-panier/" id="but_modifier"><i class="fa fa-wrench" aria-hidden="true"></i> Modifier le devis</a>';
			$epilog_c .= '<form name="validerdevis" id="validerdevis" action="'.get_bloginfo('url').'/vos-devis/" method="post"><input type="hidden" name="votrecompte" /><input type="hidden" name="codeProm" value="'.$promo.'" /><button id="but_validerdevis" type="submit">Continuer <i class="fa fa-caret-right" aria-hidden="true"></i></button></form>';
			$epilog_d .= contact_advert();
			$epilog_0 .= '<div id="addresses"><div class="address_tab_name">ADRESSE DE LIVRAISON</div><div class="address_tab_name">ADRESSE DE FACTURATION</div>';
			$explode = explode('|', $user->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $user->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			if ( ($l_name == '') && ($l_address == '') ) {
				$epilog_0 .= '<div class="address_tab_content">'.$user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city.'</div>';
			} else {
				$epilog_0 .= '<div class="address_tab_content">'.$user->l_name.'<br />'.$user->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$user->l_code.'<br />'.$user->l_city.'</div>';
			}
			$epilog_0 .= '<div class="address_tab_content">'.$user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city.'</div></div>';
		}

		if($_SESSION['isburaliste']){
			$lien_catalogue = get_bloginfo("url") . "/buralistes";
		}
		elseif($_SESSION['ismma']){
			$lien_catalogue = get_bloginfo("url") . "/mma";
		}else{
			$lien_catalogue = get_bloginfo("url") . "#tarifs";
		}

		/*$epilog .= $epilog_0.'<div id="fbcart_buttons2">'.$epilog_a.'<a href="'.get_bloginfo("url").'#tarifs" id="but_ajouter"></a>'.$epilog_b.$epilog_c.'</div>'.$epilog_d;*/
		$epilog .= $epilog_0.'<div id="fbcart_buttons2">'.$epilog_a.'<a href="'.$lien_catalogue.'" id="but_ajouter"><i class="fa fa-plus-square" aria-hidden="true"></i> Ajouter un article</a>'.$epilog_b.$epilog_c.'</div>'.$epilog_d;
		$view .= print_devis_verification($products, $prolog, $epilog);

	} else {
		if (!(isset($_POST['logme']))) {
			$view .= get_acces_panel($p);
		}
	}

	return $view;
}

//                                            AFFICHAGE PAGE VERIFICATION PANIER
//==============================================================================

function print_devis_verification($products, $prolog, $epilog) {
  if(isset($_GET['share'])){ // si les données panier viennent de l'url (share)
    $string= urldecode($_GET['share']); // on décode les données de l'url
    parse_str($string, $output); // on extrait le tableau des commandes
    //print_r($output['Array']);
    $products = $output['Array'];
  }else{
    //print_r($products);
    $products = $_SESSION['fbcart'];
  }

  global $wpdb;
  $prefix = $wpdb->prefix;
  $fb_tablename_users = $prefix."fbs_users";
  $fb_tablename_users_cf = $prefix."fbs_users_cf";
  $fb_tablename_users_cr = $prefix."fbs_users_cr";
  $fb_tablename_promo = $prefix."fbs_codepromo";

	$view .= $prolog;
	if (is_cart_not_empty() || isset($_GET['share'])) {
    $view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2" /></td><td style="font-size:11px;float:right;text-align:right;margin-top:35px;">&nbsp;</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:13px;">Votre devis: Inscription</td></tr></table></div>';
		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th class="cartQte">Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th><th></th></tr>';
		$licznik = 0;
		$totalHT = 0;
    $fraisPort = 0;

    /////////////////////////////////////////////////////// display items panier
    foreach ( $products as $products => $item ) {
      $calculCat  = '-';
      $totalItem  = str_replace(',', '.', $item['total']);
      $prixUnit   = str_replace(',', '.', $item['prix']);
      $prixOption = str_replace(',', '.', $item['option']);

      $prixOption = str_replace('€', '', $prixOption);

      //----------------------------------------------si l'utilisateur est loggé
      if (!empty($_SESSION['loggeduser'])) {
  			$uid = $_SESSION['loggeduser']->id;
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
      }
			$licznik++;
      $prodimg = '';
      $ref = '';
      if (!empty($item['image'])) {
        $prodimg = '<div class="prodpic"><img src="'.$item['image'].'" /></div>';
      }
      if (!empty($item['reference'])) {
        $ref = '<br /><span  class="reference">réf: '.$item['reference'].'</span>';
      }
			$view .= '
			<tr>
        <td class="lefttd">
          '.$prodimg.'
          <span class="name">'.$item['rodzaj'].'</span><br />
          <span class="therest">'.stripslashes($item['opis']).$ref.'</span>
        </td>
        <td><span class="disMob0">Quantité : </span>'.$item['ilosc'].'</td>
        <td><span class="disMob0">Prix unitaire : </span>'.$prixUnit.'</td>
        <td><span class="disMob0">Option : </span>'.str_replace(',', '.', $item['option']).'</td>
        <td><span class="disMob0">Remise : </span>'.$calculCat.'</td><td><span class="disMob0">Total : </span>'.$totalItem.'</td>
        <td>
          <form name="adcart_form" id="adcart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post">
            <input type="hidden" name="adfromcart" value="adfromcart" />
            <input type="hidden" name="rodzaj" value="'.$item['rodzaj'].'" />
            <input type="hidden" name="opis" value="'.$item['opis'].'" />
            <input type="hidden" name="ilosc" value="'.$item['ilosc'].'" />
            <input type="hidden" name="prix" value="'.number_format($prixUnit, 2, '.', '').'" />
            <input type="hidden" name="option" value="'.$item['option'].'" />
            <input type="hidden" name="remise" value="'.$calculCat.'" />
            <input type="hidden" name="total" value="'.number_format((float)$prixUnit*$item['ilosc']+(float)$prixOption, 2, '.', '').'" />
            <input type="hidden" name="largeur" value="'.$item['largeur'].'" />
            <input type="hidden" name="hauteur" value="'.$item['hauteur'].'" />
            <input type="hidden" name="reference" value="'.$item['reference'].'" />
            <input type="hidden" name="image" value="'.$item['image'].'" />
            <input type="hidden" name="licznik" value="'.$licznik.'" />
            <button id="adcart" type="submit" title="dupliquer cet article"><i class="fa fa-files-o" aria-hidden="true"></i> Dupliquer</button>
          </form>

          <form name="delcart_form" id="delcart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post">
            <input type="hidden" name="delfromcart" value="delfromcart" />
            <input type="hidden" name="rodzaj" value="'.$item['rodzaj'].'" />
            <input type="hidden" name="opis" value="'.$item['opis'].'" />
            <input type="hidden" name="ilosc" value="'.$item['ilosc'].'" />
            <input type="hidden" name="licznik" value="'.$licznik.'" />
            <button id="delcart" type="submit" title="supprimer cet article du panier">DEL</button>
    			</form>
        </td>
      </tr>';

			$totalHT = $totalHT + $totalItem;
			$fraisPort = $fraisPort + $item['transport'];
  	}
  	$view .= '</table>';

    //--------------------------------------------------------------------------
    $addtodevis ='';
    $calculRemise = 0;
    $calculCode = 0;
    $totalHT = $totalHT + $fraisPort;
    $calculTVA = $totalHT*0.200;
    $totalTTC = $totalHT+$calculTVA;

    //--------------------------------------------------------------------------

    $uid = $_SESSION['loggeduser']->id;
    $exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = '$uid'");
    $cat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid =  '$uid'");
    $client_remise = $exist_remise->att_value;
    $revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = '$uid'");

    //------------------------------------------------vérification remise client
		if (!empty($_SESSION['loggeduser']) && $exist_remise && !empty($client_remise) && $client_remise != 0) {

				$newrabat = $client_remise / 100;
				$calculRemise = ($totalHT-$calculCode) * $newrabat;
				$cremisetd = '<tr><td class="toleft">REMISE générale ('.$client_remise.'%)</td><td class="toright">-'.str_replace('.', ',', number_format($calculRemise, 2)).' &euro;</td></tr>';

		}

    $checkcode = '';
    $checkRem = '';

    //---------------------------------------------------------Remises intégrées

    if (!empty($_SESSION['loggeduser']) && (($exist_remise && $client_remise != 0) || $revendeur)) {

      // si l'utilisateur est connecté et bénéficie déjà d'une remise, pas de remises intégrées
      // sinon :
    }else{

      if ($totalHT < 50)   $calculCode = 0;
      if ($totalHT >= 50)  $calculCode = ($totalHT)*(3/100);
      if ($totalHT > 100)  $calculCode = 10;
      if ($totalHT > 200)  $calculCode = 20;
      if ($totalHT > 400)  $calculCode = 30;
      if ($totalHT > 600)  $calculCode = 40;
      if ($totalHT > 800)  $calculCode = 50;
      if ($totalHT > 1000) $calculCode = 60;

      if ($calculCode != 0)
      $addtodevis ='<tr><td class="toleft">REMISE</td><td class="toright">-'.number_format($calculCode, 2).' &euro;</td></tr>';

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

            }else{ //------------------------------------ si le code est valide:

              if($promoCat !== ('Tous')){ // si la réduction s'applique à une catégorie de produits:
                $prixItem = 0;
                $reducEu = 0;
                foreach ( $products as $products => $item ) {
                  $prixUnit = str_replace(',', '.', $item[prix]);
          				$prodCat = $item['rodzaj'];
                  $find = '/'.$promoCat.'/';
          				$trouve = preg_match_all($find, $prodCat, $resultat);
          				$trouve = count($resultat[0]);

                  if($trouve >= 1){
                    $prixItem += $prixUnit*$item[ilosc];
                    $reducEu = $reduction->reduction;
                  }
                }

                if($reduction->remise != 0) // si la remise est en pourcentage
                $calculCode += ($prixItem)*($reduction->remise/100); // calcule le % sur le total HT des produits de la catégorie
                else // si la remise est en euros
                $calculCode += $reduction->reduction; // applique la réduction en euros


              }else{ //----------si la réduction s'applique à tous les produits:
                if($reduction->remise != 0) // si la remise est en pourcentage
                $calculCode += ($totalHT)*($reduction->remise/100); // calcule le % sur le montant HT moins l'éventuelle remise
                else // si la remise est en euros
                $calculCode += $reducEu; // applique la réduction en euros
              }

              if ($totalHT < 50)
              $addtodevis ='<tr><td class="toleft">CODE PROMO</td><td class="toright">-'.str_replace('.', ',', number_format($calculCode, 2)).' &euro;</td></tr>';

              else if ($totalHT >= 50)
              $addtodevis ='<tr><td class="toleft">REMISE + CODE PROMO</td><td class="toright">-'.str_replace('.', ',', number_format($calculCode, 2)).' &euro;</td></tr>';
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
		$totalHT = str_replace(',', '', number_format($totalHTdeduit, 2));
		$fraisPort = str_replace(',', '', number_format($fraisPort, 2));
		$calculTVA = str_replace(',', '', number_format($calculTVA, 2));
		$totalTTC = str_replace(',', '', number_format($totalTTC, 2));

    //--------------------------------------------------------------------------

		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
    <tr><td class="toleft">Frais de port</td><td class="toright">'.$fraisPort.' &euro;</td></tr>
    '.$addtodevis.'
    '.$cremisetd.'
    <tr><td class="toleft">Total ht</td><td class="toright">'.$totalHT.' &euro;</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$calculTVA.' &euro;</td></tr>
    <tr><td class="toleft total">total ttc</td><td class="toright total">'.$totalTTC.' &euro;</td></tr>
		</table>';
		$view .= '<div class="bottomfak onlyprint"><i>Ce devis n\'est donné qu\'à titre indicatif. Il ne saurait se substituer à un devis complet et validé par nos services.<br />Les tarifs applicables sont toujours ceux des devis validés sur notre site web www.france-banderole.com.<br />Si vous souhaitez continuer ce devis gratuit et profiter de ce tarif, merci de bien vouloir vous enregistrer.</i></div>

    <div class="blocPromo"><p>'.$checkcode.'</p></div>
    ';

	} else {
		$view .= '<p class="emptyCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Votre panier est vide !</p>';
	}
	$view .= $epilog;
	return $view;
}

//                                                           ACTIONS PAGE PANIER
//==============================================================================

function get_devis() {
	$products = $_SESSION['fbcart'];

  $promo = $_POST['codeProm'];
  $_SESSION['codeProm'] = $promo;

	$prolog = '<h1 class="noprint"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Votre panier / devis</h1><hr class="noprint" />';
	$prolog .= get_mode_de_livraison();

	if (is_cart_not_empty() || isset($_GET['share'])) {
		$prolog .= '<div class="acces_tab_name_devis noprint">MON DEVIS :</div>';
	}
	$epilog = '<div id="fbcart_buttons" class="noprint">';

	if (is_cart_not_empty() || isset($_GET['share'])) {
		$epilog .= '<a href="'.get_bloginfo("url").'/votre-panier/?cart=clear" id="but_supprimer"><i class="fa fa-times-circle" aria-hidden="true"></i>
    Vider le panier</a><a href="javascript:window.print()" id="but_imprimer"><i class="fa fa-print" aria-hidden="true"></i> Imprimer ce devis</a>';
	}

		if($_SESSION['isburaliste']){
			$lien_catalogue = get_bloginfo("url") . "/buralistes";
		}
		elseif($_SESSION['ismma']){
			$lien_catalogue = get_bloginfo("url") . "/mma";
		}else{
			$lien_catalogue = get_bloginfo("url") . "#tarifs";
		}
	/*$epilog .= '<a href="'.get_bloginfo("url").'#tarifs" id="but_ajouter"></a>';*/

	$epilog .= '<a href="'.$lien_catalogue.'" id="but_ajouter"><i class="fa fa-plus-square" aria-hidden="true"></i> Ajouter un article</a>';

	if (is_cart_not_empty() || isset($_GET['share'])) {
		//$epilog .= '<a href="'.get_bloginfo("url").'/verification/" id="but_continuer"></a>';
		$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);

 		if($relais_colis !== false){
			$epilog .= '<a href="#" id="but_continuer" onclick="callbackSelectionRelaisClick();return false;">Continuer <i class="fa fa-caret-right" aria-hidden="true"></i></a>';

		}else{
      // soit l'utilisateur est connecté et il enregistre son panier directement(1),
      // soit il n'est pas connecté et après connexion il est redirigé vers la vérification de la commande(2):
      //1 $epilog .= '<form name="validerdevis" id="validerdevis" action="'.get_bloginfo('url').'/vos-devis/" method="post"><input type="hidden" name="votrecompte" /><button id="but_validerdevis" type="submit">Enregistrer le panier <i class="fa fa-caret-right" aria-hidden="true"></i></button></form>';
      //2 $epilog .= '<a href="'.get_bloginfo("url").'/verification/" id="but_continuer">Continuer <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
      if (!empty($_SESSION['loggeduser'])) {
        $epilog .= '<form name="validerdevis" id="validerdevis" action="'.get_bloginfo('url').'/vos-devis/" method="post"><input type="hidden" name="votrecompte" />
        <input type="hidden" name="codeProm" value="'.$promo.'" />
        <button id="but_validerdevis" type="submit">Continuer <i class="fa fa-caret-right" aria-hidden="true"></i></button></form>';
      }else{
        $epilog .= '<form name="validerdevis" id="validerdevis" action="'.get_bloginfo('url').'/verification/" method="post"><input type="hidden" name="votrecompte" />
        <input type="hidden" name="codeProm" value="'.$promo.'" />
        <button id="but_validerdevis" type="submit">Continuer <i class="fa fa-caret-right" aria-hidden="true"></i></button></form>';
      }

		}
	}
	$epilog .= '</div>';
	$epilog .= contact_advert();
	$view .= print_devis($products, $prolog, $epilog);
	return $view;
}


//                                                         AFFICHAGE PAGE PANIER
//==============================================================================

function print_devis($products, $prolog, $epilog) {

  if(isset($_GET['share'])){ // si des données panier viennent de l'url (share)
    $string= urldecode($_GET['share']); // on décode les données de l'url
    parse_str($string, $output); // on extrait le tableau des produits dans l'url
    //print_r($output['Array']);
    if (is_cart_not_empty()) { // si le panier contient déjà des produits
      $_SESSION['fbcart'] = array_merge($_SESSION['fbcart'], $output['Array']); // on rajoute à la session panier les produits dans l'url
    }else{ // sinon le panier ne contient que les produits de l'url
      $_SESSION['fbcart'] = $output['Array'];
    }
  }

  //print_r($products);
  $products = $_SESSION['fbcart'];

	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
  $fb_tablename_users_cr = $prefix."fbs_users_cr";
  $fb_tablename_promo = $prefix."fbs_codepromo";
  $fb_tablename_shorturl = $prefix."fbs_shorturl";
	$view .= $prolog;
	$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';

	if (is_cart_not_empty() || isset($_GET['share'])) {

		$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2" /></td><td style="font-size:11px;float:right;text-align:right;margin-top:35px;">&nbsp;</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:13px;">Votre devis: Inscription</td></tr></table></div>';
		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th class="cartQte">Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th><th></th></tr>';
		$licznik = 0;
		$totalHT = 0;
    $fraisPort = 0;

    /////////////////////////////////////////////////////// display items panier
		foreach ( $products as $products => $item ) {
      $calculCat  = '-';
      $totalItem  = str_replace(',', '.', $item['total']);
      $prixUnit   = str_replace(',', '.', $item['prix']);
      $prixOption = str_replace(',', '.', $item['option']);

      $prixOption = str_replace('€', '', $prixOption);

      $checkRem   = '';

      //----------------------------------------------si l'utilisateur est loggé
      if (!empty($_SESSION['loggeduser'])) {
  			$uid = $_SESSION['loggeduser']->id;
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
      }
			$licznik++;
      $prodimg = '';
      $ref = '';
      if (!empty($item['image'])) {
        $prodimg = '<div class="prodpic"><img src="'.$item['image'].'" /></div>';
      }
      if (!empty($item['reference'])) {
        $ref = '<br /><span  class="reference">réf: '.$item['reference'].'</span>';
      }

			$view .= '
			<tr>
        <td class="lefttd">
          '.$prodimg.'
          <span class="name">'.$item['rodzaj'].'</span><br />
          <span class="therest">'.stripslashes($item['opis']).$ref.'</span>
        </td>
        <td><span class="disMob0">Quantité : </span>'.$item['ilosc'].'</td>
        <td><span class="disMob0">Prix unitaire : </span>'.$prixUnit.'</td>
        <td><span class="disMob0">Option : </span>'.$prixOption.'</td>
        <td><span class="disMob0">Remise : </span>'.$calculCat.'</td><td><span class="disMob0">Total : </span>'.$totalItem.'</td>

        <td>
          <form name="adcart_form" id="adcart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post">
            <input type="hidden" name="adfromcart" value="adfromcart" />
            <input type="hidden" name="rodzaj" value="'.$item['rodzaj'].'" />
            <input type="hidden" name="opis" value="'.$item['opis'].'" />
            <input type="hidden" name="ilosc" value="'.$item['ilosc'].'" />
            <input type="hidden" name="prix" value="'.number_format($prixUnit, 2, '.', '').'" />
            <input type="hidden" name="option" value="'.$item['option'].'" />
            <input type="hidden" name="remise" value="'.$calculCat.'" />
            <input type="hidden" name="total" value="'.number_format((float)$prixUnit*$item['ilosc']+(float)$prixOption, 2, '.', '').'" />
            <input type="hidden" name="largeur" value="'.$item['largeur'].'" />
            <input type="hidden" name="hauteur" value="'.$item['hauteur'].'" />
            <input type="hidden" name="reference" value="'.$item['reference'].'" />
            <input type="hidden" name="image" value="'.$item['image'].'" />
            <input type="hidden" name="licznik" value="'.$licznik.'" />
            <button id="adcart" type="submit" title="dupliquer cet article"><i class="fa fa-files-o" aria-hidden="true"></i> Dupliquer</button>
          </form>

          <form name="delcart_form" id="delcart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post">
            <input type="hidden" name="delfromcart" value="delfromcart" />
            <input type="hidden" name="rodzaj" value="'.$item['rodzaj'].'" />
            <input type="hidden" name="opis" value="'.$item['opis'].'" />
            <input type="hidden" name="ilosc" value="'.$item['ilosc'].'" />
            <input type="hidden" name="licznik" value="'.$licznik.'" />
            <button id="delcart" type="submit" title="supprimer cet article du panier">DEL</button>
    			</form>
        </td>

      </tr>';

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

    $uid = $_SESSION['loggeduser']->id;
    $exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = '$uid'");
    $cat = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cr` WHERE uid =  '$uid'");
    $client_remise = $exist_remise->att_value;
    $revendeur = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_value = 'compte revendeur' AND uid = '$uid'");

    //------------------------------------------------si l'utilisateur est loggé
		if (!empty($_SESSION['loggeduser'])) {
      // si remise client existe et différente de 0
			if ($exist_remise && !empty($client_remise) && $client_remise != 0) {
					$newrabat = $client_remise / 100;
					$calculRemise = ($totalHT-$calculCode) * $newrabat;
					$cremisetd = '<tr><td class="toleft">REMISE Générale ('.$client_remise.'%)</td><td class="toright">-'.number_format($calculRemise, 2).' &euro;</td></tr>';
			}
		}

    //---------------------------------------------------------Remises intégrées

    if (!empty($_SESSION['loggeduser']) && (($exist_remise && $client_remise != 0) || $revendeur)) {

      // si l'utilisateur est connecté et bénéficie déjà d'une remise, aucune remise intégrée ni code promo
      if(isset($_POST['codeProm'] )) {
        $checkcode = '<div class="box_warning">Vous bénéficiez déjà d\'un tarif préférenciel, ce code ne peut pas s\'appliquer.</div>';
      }

      // sinon :
    }else{

      if ($totalHT < 50) {
        $calculCode = 0;
        $miss = 50-$totalHT;
        $checkRem = 'Quel dommage ! il manque juste <strong>' .number_format($miss, 2).'€</strong> à votre commande pour bénéficier de <strong>3%</strong> de réduction!';
      }
      if ($totalHT >= 50) {
        $calculCode = ($totalHT)*(3/100);
        $miss = 100-$totalHT;
        $checkRem = 'Félicitations, vous avez franchi le premier palier et bénéficiez maintenant d\'une remise de <strong>3%</strong> sur cette commande ! <br />
        Ajoutez seulement <strong>' .number_format($miss, 2).'€</strong> à cette commande pour obtenir <strong>10€</strong> de réduction !';
      }
      if ($totalHT > 100) {
        $calculCode = 10;
        $miss = 200-$totalHT;
        $checkRem = 'Bravo ! Vous bénéficiez déjà d\'une remise de <strong>10€</strong> sur cette commande ! <br />
        Plus que <strong>' .number_format($miss, 2).' € </strong>pour gagner <strong>20€</strong> de réduction !';
      }
      if ($totalHT > 200) {
        $calculCode = 20;
        $miss = 400-$totalHT;
        $checkRem = 'c\'est fait ! Vous avez obtenu une remise de <strong>20€</strong> sur cette belle commande ! <br />
        Il manque seulement <strong>' .number_format($miss, 2).'€</strong> pour arriver à  <strong>30€</strong> de réduction !<br />
		    Rien d\'autre à commander ?';
      }
      if ($totalHT > 400) {
        $calculCode = 30;
        $miss = 600-$totalHT;
        $checkRem = 'Félicitations, vous bénéficiez maintenant d\'une remise de <strong>30€</strong> sur votre commande ! <br />
        Seulement <strong>' .number_format($miss, 2).'€</strong> de plus et vous bénéficierez de <strong>40€</strong> de réduction !';
      }
      if ($totalHT > 600) {
        $calculCode = 40;
        $miss = 800-$totalHT;
        $checkRem = 'C\'est cadeau ! Vous avez déjà gagné une remise de <strong>40€</strong> sur cette belle commande ! <br />
        Encore 1 article à <strong>' .number_format($miss, 2).'€</strong> pour avoir <strong>50€</strong> de réduction !';
      }
      if ($totalHT > 800) {
        $calculCode = 50;
        $miss = 1000-$totalHT;
        $checkRem = 'Bravo ! Vous atteignez la remise de <strong>50€</strong> sur votre commande ! <br />
        Ajoutez encore  <strong>' .number_format($miss, 2).'€</strong> à ce panier pour atteindre <strong>60€</strong> de réduction !';
      }
      if ($totalHT > 1000) {
        $calculCode = 60;
        $checkRem = 'Félicitations !! Vous bénéficiez de <strong>60€</strong> de remise sur cette commande !';
      }

      if ($calculCode != 0)
      $addtodevis ='<tr><td class="toleft">REMISE</td><td class="toright">-'.number_format($calculCode, 2).' &euro;</td></tr>';

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
                $checkcode = '<div class="box_warning">Code expiré le ' .date("d/m/Y", strtotime("$reduction->date")).'</div>';

              }else{ //------------------------------------ si le code est valide:

                if($promoCat !== ('Tous')){ // si la réduction s'applique à une catégorie de produits:
                  $prixItem = 0;
                  $reducEu = 0;
                  foreach ( $products as $products => $item ) {
                    $prixUnit = str_replace(',', '.', $item[prix]);
                    $prodCat = $item['rodzaj'];
                    $find = '/'.$promoCat.'/';
                    $trouve = preg_match_all($find, $prodCat, $resultat);
                    $trouve = count($resultat[0]);

                    if($trouve >= 1){
                      $prixItem += $prixUnit*$item[ilosc];
                      $reducEu = $reduction->reduction;
                    }
                  }

                  if($reduction->remise != 0) { // si la remise est en pourcentage
                    $calculCode += ($prixItem)*($reduction->remise/100); // calcule le % sur le total HT des produits de la catégorie
                    $checkcode = '<div class="box_info">Ce code applique une réduction de <strong>'.$reduction->remise.'%</strong> sur les produits de type <strong>'.$promoCat.'</strong>, vous économisez en tout <strong>'.number_format($calculCode, 2).' &euro;</strong> sur cette commande!</div>';

                  } else { // si la remise est en euros
                    $calculCode += $reducEu; // applique la réduction en euros
                    $checkcode = '<div class="box_info">Ce code applique une réduction de <strong>'.$reduction->reduction.' €</strong> sur les produits de type <strong>'.$promoCat.'</strong>, vous économisez en tout <strong>'.$calculCode.' &euro;</strong> sur cette commande!</div>';
                  }

                }else{ // si la réduction s'applique à tous les produits:
                  if($reduction->remise != 0) { // si la remise est en pourcentage
                    $calculCode += ($totalHT)*($reduction->remise/100); // calcule le % sur le montant HT moins l'éventuelle remise
                    $checkcode = '<div class="box_info">Ce code applique une réduction de <strong>'.$reduction->remise.'%</strong> sur l\'ensemble de votre commande, vous économisez enn tout <strong>'.number_format($calculCode, 2).'&euro;</strong>!</div>';

                  } else {  // si la remise est en euros
                    $calculCode += $reduction->reduction; // applique la réduction en euros
                    $checkcode = '<div class="box_info">Ce code applique une réduction de <strong>'.$reduction->reduction.' €</strong> sur l\'ensemble de votre commande.</div>, vous économisez enn tout <strong>'.number_format($calculCode, 2).'&euro;</strong>!</div>';
                  }
                }
                if ($totalHT < 50)
                $addtodevis ='<tr><td class="toleft">CODE PROMO</td><td class="toright">-'.str_replace('.', ',', number_format($calculCode, 2)).' &euro;</td></tr>';

                else if ($totalHT >= 50)
                $addtodevis ='<tr><td class="toleft">REMISE + CODE PROMO</td><td class="toright">-'.str_replace('.', ',', number_format($calculCode, 2)).' &euro;</td></tr>';

                $checkRem = '';
              }

            }else{ // si le code est inférieur au minimum d'achat:
              $checkcode = '<div class="box_warning">Ce code s\'applique à partir de '.$reduction->mini.'&euro; d\'achat!</div>';
            }

          }else{ // si le code n'est pas dans la bdd:
            $checkcode = '<div class="box_warning">Code non valide</div>';
          }

      }
    }




    //--------------------------------------------------------------------------

    $view .= '</table>
    <div class="checkRem">'.$checkRem.'</div>';

    //--------------------------------------------------------------------------

    $totalHTdeduit = $totalHT - $calculRemise - $calculCode;
    $calculTVA = $totalHTdeduit*0.200;
    $totalTTC = $totalHTdeduit+$calculTVA;

    $calculRemise = str_replace(',', '', number_format($calculRemise, 2));
    $calculCode   = str_replace(',', '', number_format($calculCode, 2));
		$totalHT      = str_replace(',', '', number_format($totalHTdeduit, 2));
		$fraisPort    = str_replace(',', '', number_format($fraisPort, 2));
		$calculTVA    = str_replace(',', '', number_format($calculTVA, 2));
		$totalTTC     = str_replace(',', '', number_format($totalTTC, 2));

		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
    <tr><td class="toleft">Frais de port</td><td class="toright">'.$fraisPort.' &euro;</td></tr>
    '.$addtodevis.'
    '.$rebyprod.'
    '.$cremisetd.'
    <tr><td class="toleft">Total ht</td><td class="toright">'.$totalHT.' &euro;</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$calculTVA.' &euro;</td></tr>
    <tr><td class="toleft total">total ttc</td><td class="toright total">'.$totalTTC.' &euro;</td></tr>
		</table>';
		$view .= '<div class="bottomfak onlyprint"><i>Ce devis n\'est donné qu\'à titre indicatif. Il ne saurait se substituer à un devis complet et validé par nos services.<br />Les tarifs applicables sont toujours ceux des devis validés sur notre site web www.france-banderole.com.<br />Si vous souhaitez continuer ce devis gratuit et profiter de ce tarif, merci de bien vouloir vous enregistrer.</i></div>

    <div class="blocPromo noprint">
      <p><form name="codePromoForm" id="codePromo" action="'.get_bloginfo('url').'/votre-panier/" method="post">
        <input type="text" name="codeProm" class="promoInput" placeholder="CODE PROMO" /><button type="submit" name="submitCode" class="codePromo"><i class="fa fa-check" aria-hidden="true"></i> Appliquer</button>
      </form></p>
      <p>'.$checkcode.'</p>';

    if (!empty($_SESSION['loggeduser'])){
      //shorten url
      //$urlinput=mysqli_real_escape_string($full);
      // désactiver l'image pour pas l'intégrer dans l'url
      $prods = $_SESSION['fbcart'];
      foreach(array_keys($prods) as $key) {
         unset($prods[$key]['image']);
      }
      $data = array('Array' => $prods );

      //print_r($data);
      $query = http_build_query($data);
      $url = urlencode($query);
      $full = 'votre-panier?share='.$url;

      $id=rand(10000,99999);
      $shorturl=base_convert($id,20,36);


      $login= $_SESSION['loggeduser']->login;
      if($login =='pocalypse' || $login =='malgoire2' || $login =='samrr' || $login =='qzefr' || $login =='test' || $login =='chrismilan'){
        $result = $wpdb->get_row("SELECT * FROM `$fb_tablename_shorturl` where url='$full'");
        if (!$result)
        $wpdb->query("INSERT INTO `$fb_tablename_shorturl` VALUES ('$id','$full','$shorturl')");
        else $shorturl = $result->short;
        $view .= '<p>
        <input type="text" class="promoInput" id="to-copy" value="'.get_bloginfo("url").'/'.$shorturl.'" /><button  class="codePromo" id="copy" type="button"><i class="fa fa-files-o" aria-hidden="true"></i> Copier URL panier<span class="copiedtext" aria-hidden="true">Copié</span></button>
        </p>';
      }

      if(isset($_POST['submitMail'])) {
        $result = $wpdb->get_row("SELECT * FROM `$fb_tablename_shorturl` where url='$full'");
        if (!$result)
        $wpdb->query("INSERT INTO `$fb_tablename_shorturl` VALUES ('$id','$full','$shorturl')");
        else $shorturl = $result->short;

        $username=$_SESSION['loggeduser']->f_name;
        $maildest=$_POST['maildest'];
        $titre= 'Devis France Banderole';
        if($login =='pocalypse' || $login =='malgoire2' || $login =='samrr' || $login =='qzefr' || $login =='test' || $login =='chrismilan') {
          $letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour,<br /><br />'.$username.' souhaite partager avec vous un devis enregistré sur notre site. Pour le visualiser, cliquez sur le lien ci-dessous :<br /><br /><a href="'.get_bloginfo("url").'/'.$shorturl.'">'.get_bloginfo("url").'/'.$shorturl.'</a><br /><br />Si ce dernier retient votre attention, enregistrez-le et créez votre accès client si vous n\'en possedez pas déjà un. Suivez la procédure et en cas de doute, n\'hésitez pas à nous contacter.<br /><br /> Amicalement,<br />L\'équipe France banderole.<br />https://www.france-banderole.com</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 401 401" width="432px" /></div>';
        }else{
          $letter = '<div style="font-family:calibri"><a href="https://www.france-banderole.com" title="entete-france-banderole" target=""><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailHeader.png" alt="entete-france-banderole" width="100%" align="none"></a><br></div><div style="font-family:calibri">Bonjour,<br /><br />'.$username.' souhaite partager avec vous un devis enregistré sur notre site. Pour le visualiser, cliquez sur le lien ci-dessous :<br /><br /><a href="'.get_bloginfo("url").'/'.$shorturl.'">'.get_bloginfo("url").'/'.$shorturl.'</a><br /><br />Amicalement,<br />L\'équipe France banderole.<br />https://www.france-banderole.com</div><br /><div style="font-family:calibri;font-size:10px">NB : ce mail est un mail généré automatiquement. Merci de ne pas y répondre directement.<br /><img src="https://www.france-banderole.com/wp-content/plugins/fbshop/images/mailFooterGeneral.png" alt="information@france-banderole.com - 0442 40401" width="432px" /></div>';
        }

        function wpse27856_set_content_type(){
  			  return "text/html";
  			}

  			add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
  			$header = 'From: France Banderole <information@france-banderole.com>';
    		$header .= "\nContent-type: text/html; charset=UTF-8\n" ."Content-Transfer-Encoding: 8bit\n";
        wp_mail($maildest, $titre, $letter);
  			remove_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
      }

      $view .='<button href="#sharepop" name="shareURL" class="open-popup-link shareURL"><i class="fa fa-share-alt" aria-hidden="true"></i> Partager ce devis</button>
      <div id="sharepop" class="sharePop mfp-hide">
        <form name="shareCart" id="shareCart" action="'.get_bloginfo("url").'/votre-panier/" method="post">
          <p>Vous pouvez partager un lien vers ce devis: en cliquant dessus le destinataire accèdera au contenu de ce panier et pourra, s\'il le souhaite, passer la commande. </p>
          <input type="email" name="maildest" id="maildest" class="promoInput" placeholder="MAIL DESTINATAIRE" /><button type="submit" name="submitMail" class="codePromo"><i class="fa fa-paper-plane"></i>  Envoyer</button>
        </form>
        <a  class="shareFacebook" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_bloginfo("url").'/'.$shorturl).'"><i class="fa fa-facebook-official" aria-hidden="true"></i> partager sur facebook</a>
      </div>';

    }
    $view .= '</div>';
	} else { // si le panier est vide
		$view .= '<p class="emptyCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Votre panier est vide !</p>';
	}
	$view .= $epilog;
	return $view;
}

////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////// plv extérieur //

function get_plv() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_plv";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1 class="h1product">PLV Exterieur - Intérieur - Stop trottoir - Chevalet - Accessoires pose - Cadre Alu</h1><hr />';
	$view .= '<div id="top_info"><div class="front"><img class="alignleft" src="'.$plugin_url.'images/f10.png" alt="" /></div><div id="top_info_info2"><span class="info_nag">PLV Exterieur - Intérieur - Accessoires</span><br />Toutes les PLV extérieures et intérieur de France banderole ont été sélectionnées pour leur simplicité d\'utilisation et leur robustesse.<br />Nos PLV sont livrées complètes et prêtes à monter, avec vos visuels imprimés en quadri haute définition compris dans nos tarifs.</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
  <script type="text/javascript">
  function rushcheckbox24($type) {
    var rush24 = document.getElementById("rush24"+$type);
    var rush72 = document.getElementById("rush72"+$type);
    if (rush72.checked == true) {
      rush72.checked = false;
    }
  }
  function rushcheckbox72($type) {
    var rush24 = document.getElementById("rush24"+$type);
    var rush72 = document.getElementById("rush72"+$type);
    if (rush24.checked == true) {
      rush24.checked = false;
    }
  }
  </script>
	';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p['price'], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p['ceddre']).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p['photo_mini']) {
			if ($p['photo']) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/'.$p['photo'].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" />';
			}
		}
    $path = get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		if ($p['ceddre'] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p['ceddre'].'" /></div>';
		}
		if ($p['subname'] != '') {
			$p['subname'] = str_replace('"', '&ldquo;', $p['subname']);
			$subtitle = '<span class="subtitle">'.$p['subname'].'<br /></span>';
			$sname = $p['subname'].'<br />';
		}

		$view .=
    '<form name="cart_form' . $licznik . '" data-cartform="'.$licznik.'" class="prom_form" action="' . get_bloginfo("url") . '/votre-panier/" method="post" onsubmit="return czyilosc(' . $licznik . ')">
      <tr>
        <td class="lefttd"><span class="prom_title"><b>' . $p['name'] . '</b></span><br /><span id="desc' . $licznik . '" class="prom_therest">' . stripslashes($subtitle . $p['description']) . '</span></td>
        <td class="imgtd">' . $viewmini . '<span class="prom_price">a partir de ' . $n_price . '</span></td>
        <td class="optionstd">
          <span>OPTIONS:</span>
          <input type="hidden" name="addtocart2" value="addtocart2" />
          <input type="hidden" name="rodzaj" value="PLVEXT ' . $p['name'] . '" />

          <div class="">
          </div>
          <div class="plvoptions">
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="colis' . $licznik . '" name="colis" value="1" onchange="colisrevendeurclick(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_colis' . $licznik . '" for="colis' . $licznik . '">Colis revendeur</label><span class="helpButton"><span class="helpText" id="helpTextcolis' . $licznik . '" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush24' . $licznik . '" name="rush24" value="1" onchange="rushcheckbox24(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush24' . $licznik . '" for="rush24' . $licznik . '">Délai Rush 24/48H</label><span class="helpButton"><span class="helpText" id="helpTextRush24' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush72' . $licznik . '" name="rush72" value="1" onchange="rushcheckbox72(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush72' . $licznik . '" for="rush72' . $licznik . '">Délai Rush 72H</label><span class="helpButton"><span class="helpText" id="helpTextrush72' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span>
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="relais' . $licznik . '" name="relais" value="1" onchange="relaisColischeckbox15(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_relais' . $licznik . '" for="relais' . $licznik . '">Dépot en relais colis</label><span class="helpButton"><span class="helpText" id="helpTextrelais' . $licznik . '" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
          </div>
        </td>

        <td class="righttd">
          <div class="plvmakcon"><div class="plvmak"><input type="radio" name="projectmak" value="fb" /> France banderole crée la maquette</div><div class="plvmak1"><input type="radio" name="projectmak" value="us" checked="checked" /> j’ai déjà crée la maquette</div></div>
          <div class="pilosc"  data-trigger="spinner">
            <b>Quantité:</b><input type="text" name="ilosc" id="nummo' . $licznik . '" class="inp_ilosc" value="" data-rule="quantity" />
            <div class="spinner-controls plvpromo">
  	   			 <a href="#" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
  	   			 <a href="#" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
  			  	</div>
          </div>
          <input type="hidden" name="isplv" value="true" />
          <input type="hidden" name="opis1" value="' . $p['subname'] . '" /><input type="hidden" name="opis2" value="' . $p['description'] . '" /><input type="hidden" name="prix" value="' . $p['price'] . ' &euro;" />' . $cedd . '<input type="hidden" name="transport" value="' . $p['frais'] . ' &euro;" /><input type="hidden" name="image" value="'.$base64.'" />
          <button data-cartbtn="'.$licznik.'" type="submit" class="prom_sub"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ajouter</button>
        </td>
      </tr>
    </form>';

	endforeach;
	$view .= '</table>';
	return $view;
}

////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////// plv intérieur //

function get_plv_int() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_plv_int";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1 class="h1product">PLV Exterieur - Intérieur - Stop trottoir - Chevalet - Accessoires pose - Cadre Alu</h1><hr />';
	$view .= '<div id="top_info"><div class="front"><img class="alignleft" src="'.$plugin_url.'images/f22.png" alt="" /></div><div id="top_info_info2"><span class="info_nag">PLV Intérieur - Accessoires</span><br />Toutes les PLV intérieur de France banderole ont été sélectionnées pour leur simplicité d\'utilisation et leur robustesse.<br />Nos PLV sont livrées complètes et prêtes à monter, avec vos visuels imprimés en quadri haute définition compris dans nos tarifs.</div></div>';
	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
  <script type="text/javascript">
  function rushcheckbox24($type) {
    var rush24 = document.getElementById("rush24"+$type);
    var rush72 = document.getElementById("rush72"+$type);
    if (rush72.checked == true) {
      rush72.checked = false;
    }
  }
  function rushcheckbox72($type) {
    var rush24 = document.getElementById("rush24"+$type);
    var rush72 = document.getElementById("rush72"+$type);
    if (rush24.checked == true) {
      rush24.checked = false;
    }
  }
  </script>
	';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p['price'], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p['ceddre']).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p['photo_mini']) {
			if ($p['photo']) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/'.$p['photo'].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" />';
			}
		}
    $path = get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p['photo_mini'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		/*if ($p['ceddre'] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p['ceddre'].'" /></div>';
		}*/
		if ($p['subname'] != '') {
			$p['subname'] = str_replace('"', '&ldquo;', $p['subname']);
			$subtitle = '<span class="subtitle">'.$p['subname'].'<br /></span>';
			$sname = $p['subname'].'<br />';
		}
		$view .= '<form name="cart_form'.$licznik.'"  data-cartform="'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')">
    <tr>
      <td class="lefttd"><span class="prom_title"><b>'.$p['name'].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p['description']).'</span></td>
  		<td class="imgtd">'.$viewmini.'<span class="prom_price">a partir de '.$n_price.'</span></td>
  		<td class="optionstd">
    		<span>OPTIONS:</span>
    		<input type="hidden" name="addtocart2" value="addtocart2" />
    		<input type="hidden" name="rodzaj" value="PLVint '.$p['name'].'" />
    		<div class="plvoptions">
          <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="colis' . $licznik . '" name="colis" value="1" onchange="colisrevendeurclick(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_colis' . $licznik . '" for="colis' . $licznik . '">Colis revendeur</label><span class="helpButton"><span class="helpText" id="helpTextcolis' . $licznik . '" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
          <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush24' . $licznik . '" name="rush24" value="1" onchange="rushcheckbox24(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush24' . $licznik . '" for="rush24' . $licznik . '">Délai Rush 24/48H</label><span class="helpButton"><span class="helpText" id="helpTextRush24' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
          <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush72' . $licznik . '" name="rush72" value="1" onchange="rushcheckbox72(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush72' . $licznik . '" for="rush72' . $licznik . '">Délai Rush 72H</label><span class="helpButton"><span class="helpText" id="helpTextrush72' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span>
          <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="relais' . $licznik . '" name="relais" value="1" onchange="relaisColischeckbox15(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_relais' . $licznik . '" for="relais' . $licznik . '">Dépot en relais colis</label><span class="helpButton"><span class="helpText" id="helpTextrelais' . $licznik . '" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>

    		</div>
    		</td>
    		<td class="righttd">
    		<div class="plvmakcon">
    			<div class="plvmak"><input type="radio" name="projectmak" value="fb" /> France banderole crée la maquette</div>
    			<div class="plvmak1"><input type="radio" name="projectmak" value="us" checked="checked" /> j’ai déjà crée la maquette</div>
    		</div>
        <div class="pilosc"  data-trigger="spinner">
          <b>Quantité:</b><input type="text" name="ilosc" id="nummo' . $licznik . '" class="inp_ilosc" value="" data-rule="quantity" />
          <div class="spinner-controls plvpromo">
           <a href="#" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
           <a href="#" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
          </div>
        </div>
    		<input type="hidden" name="isplv" value="true" />
    		<input type="hidden" name="opis1" value="'.$p['subname'].'" /><input type="hidden" name="opis2" value="'.$p['description'].'" />
    		<input type="hidden" name="prix" value="'.$p['price'].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p['frais'].'" /><input type="hidden" name="image" value="'.$base64.'" />
    		<button data-cartbtn="'.$licznik.'" type="submit" class="prom_sub"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ajouter</button>
  		</td>
    </tr></form>';

	endforeach;
	$view .= '</table>';
	return $view;
}

function Change() {
	if (document.getElementById("fb").checked) {
	'document.getElementById("madiv").style.display="block"';
	}
	else {
	'document.getElementById("madiv").style.display="none"';
	}
	if (document.getElementById("us").checked) {
	'document.getElementById("madiv").style.display="none"';
	}
}

///////////////////////////////////////////////////////////////////// promotions

function get_acc() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>Promotions kit banderole publicitaire et mini banderole</h1><hr />';
	$view .= '<div id="top_info"><div class="front"><img class="alignleft" src="'.$plugin_url.'images/facc.png" alt="" /></div><div id="top_info_info2"><span class="info_nag">PROMOTIONS</span><br />Les offres promotionnelles présentées ont été étudiées pour répondre à vos besoins de communication à petite et grande échelle. Nous avons selectionnés les produits correspondants aux demandes récurrentes de nos clients dans le meilleur rapport qualité/prix. toutes les offres sont entendues : imprimées quadri recto.</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
		<script type="text/javascript">
		function rushcheckbox24($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush72.checked == true) {
				rush72.checked = false;
			}
		}
		function rushcheckbox72($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush24.checked == true) {
				rush24.checked = false;
			}
		}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p['price'], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p['ceddre']).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p['photo_mini']) {
			if ($p['photo']) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/'.$p['photo'].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" />';
			}
		}
    $path = get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		if ($p['ceddre'] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p['ceddre'].'" /></div>';
		}
		if ($p['subname'] != '') {
			$p['subname'] = str_replace('"', '&ldquo;', $p['subname']);
			$subtitle = '<span class="subtitle">'.$p['subname'].'<br /></span>';
			$sname = $p['subname'].'<br />';
		}
		$view .= '
    <tr>
      <td class="lefttd2"><span class="prom_title"><b>'.$p['name'].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p['description']).'</span></td>
  		<td class="imgtd">'.$viewmini.'<span class="prom_price">Tarif : '.$n_price.'</span></td>
  		<td class="optionstd">
    		<form name="cart_form'.$licznik.'"  data-cartform="'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')">
          <span>OPTIONS:</span>
          <input type="hidden" name="addtocart2" value="addtocart2" />
          <input type="hidden" name="rodzaj" value="'.$p['name'].'" />
          <div class="plvoptions">
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="colis' . $licznik . '" name="colis" value="1" onchange="colisrevendeurclick(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_colis' . $licznik . '" for="colis' . $licznik . '">Colis revendeur</label><span class="helpButton"><span class="helpText" id="helpTextcolis' . $licznik . '" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush24' . $licznik . '" name="rush24" value="1" onchange="rushcheckbox24(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush24' . $licznik . '" for="rush24' . $licznik . '">Délai Rush 24/48H</label><span class="helpButton"><span class="helpText" id="helpTextRush24' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush72' . $licznik . '" name="rush72" value="1" onchange="rushcheckbox72(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush72' . $licznik . '" for="rush72' . $licznik . '">Délai Rush 72H</label><span class="helpButton"><span class="helpText" id="helpTextrush72' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span>
            <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="relais' . $licznik . '" name="relais" value="1" onchange="relaisColischeckbox15(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_relais' . $licznik . '" for="relais' . $licznik . '">Dépot en relais colis</label><span class="helpButton"><span class="helpText" id="helpTextrelais' . $licznik . '" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>

          </div>
          </td>
          <td class="righttd">
          <div class="plvmakcon">
            <div class="plvmak"><input type="radio" name="projectmak" value="fb" /> France banderole crée la maquette</div>
            <div class="plvmak1"><input type="radio" name="projectmak" value="us" checked="checked" /> j’ai déjà crée la maquette</div>
          </div>
          <div class="pilosc"  data-trigger="spinner">
            <b>Quantité:</b><input type="text" name="ilosc" id="nummo' . $licznik . '" class="inp_ilosc" value="" data-rule="quantity" />
            <div class="spinner-controls plvpromo">
             <a href="#" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
             <a href="#" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
            </div>
          </div>
          <input type="hidden" name="isplv" value="true" />
          <input type="hidden" name="opis1" value="'.$p['subname'].'" /><input type="hidden" name="opis2" value="'.$p['description'].'" />
          <input type="hidden" name="prix" value="'.$p['price'].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p['frais'].' &euro;" /><input type="hidden" name="image" value="'.$base64.'" />

      		<button data-cartbtn="'.$licznik.'" type="submit" class="prom_sub"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ajouter</button>
    		</form>
      </td>
    </tr>';

		endforeach;

	$view .= '</table>';

	return $view;
}

///////////////////////////////////////////////////////////////////// accessoires

function get_accessoires($cat) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc2";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';

	$view .= '<div id="explode">';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` WHERE cat='$cat' ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p['price'], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p['ceddre']).' &euro;';
		$viewmini = '';
		$subtitle = '';
		$sname = '';

		if ($p['photo_mini']) {
      $viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'].'" alt="'.$p['name'].'" />';
		}
    $path = get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p['photo_mini'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		if ($p['subname'] != '') {
			$p['subname'] = str_replace('"', '&ldquo;', $p['subname']);
			$subtitle = '<span class="subtitle">'.$p['subname'].'<br /></span>';
			$sname = $p['subname'].'<br />';
		}
		$view .= '
    <div class="explode">
      <div class="accname prom_title">'.$p['name'].'</div>
      <div class="accmini">'.$viewmini.'</div>
      <div class="accdesc prom_therest" id="desc'.$licznik.'">'.stripslashes($subtitle.$p['description']).'</div>
  		<div class="accprice prom_price">'.$n_price.'</div>
      <div class="accadd">
        <form name="cart_form'.$licznik.'"  data-cartform="'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')">
          <div class="pilosc"  data-trigger="spinner">
            <input type="text" name="ilosc" id="nummo' . $licznik . '" class="inp_ilosc" value="" data-rule="quantity" />
            <div class="spinner-controls plvpromo">
             <a href="#" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
             <a href="#" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
            </div>
          </div>
          <input type="hidden" name="addtocart2" value="addtocart2" />
          <input type="hidden" name="rodzaj" value="'.$p['name'].'" />
          <input type="hidden" name="isplv" value="true" />
          <input type="hidden" name="opis1" value="'.$p['subname'].'" /><input type="hidden" name="opis2" value="'.$p['description'].'" />
          <input type="hidden" name="prix" value="'.$p['price'].'" /><input type="hidden" name="transport" value="'.$p['frais'].' &euro;" /> <input type="hidden" name="reference" value="'.$p['ref'].'" /><input type="hidden" name="image" value="'.$base64.'" />
      		<button data-cartbtn="'.$licznik.'" type="submit" class="prom_sub"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ajouter</button>
    		</form>
      </div>
    </div>';

		endforeach;

	$view .= '</div>';

	return $view;
}
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////// validation BAT //

function get_valider_bat() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_catprods = $prefix."fbs_catprods";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	$order_id = $_GET['uid'];

	if(isset($_GET['accepte'])) {
	// On enregistre le message
  	$mess_obj = $wpdb->get_row("SELECT * FROM `$fb_tablename_topic` WHERE id = 56");
  	$sujet = $mess_obj->topic;
  	$message = $mess_obj->content;
  	$date = date('Y-m-d H:i:s');
  	$user = $_SESSION['loggeduser'];
  	$user_name = $user->f_name;

  	$order_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$order_id'");
  	$user_type = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$user->id."' AND att_name = 'client_type' AND att_value = 'grand compte'");

  	$wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$order_id."', '".$sujet."', '".$date."', '".$user_name."', '".$message."')");

  	// Selon le statut de la commande ou le type d'utilisateur, on redirige soit sur la page de paiement, soit sur la page de récapitulatif de commande
  	if (($user_type) OR ($order_data->status == 2) OR ($order_data->status == 3) OR ($order_data->status == 7)) {
  		echo '<script type="text/javascript">
  				window.location.replace("'.get_bloginfo("url").'/vos-devis/?detail='.$order_id.'");
  			</script>';
  	} else {
  		echo '<script type="text/javascript">
  				window.location.replace("'.get_bloginfo("url").'/paiement/?pay='.$order_id.'");
  			</script>';
  	}
	}

	$view .= '<h1>Validation de mon BAT - Commande n°'.$order_id.'</h1>';
	$view .= '<div id="valid_bat">';
	$view .= '<div id="valid_bat_left"><div id="valid_bat_left_tit">Valider mon BAT</div>
	<div id="valid_bat_left_con"><form method="post"><input type="checkbox" name="accepte" id="bat_confirm" /><label for="accepte" class="checkbox2">En cochant cette case, je reconnais avoir visualisé mon ou mes BAT et demande le lancement de la production</label><button id="suivant_reg" type="submit">Suivant</button></form></div>
	</div></div>';
}

//                                                           GET PRODPAGES FORMS
//==============================================================================

function get_affiches_form() {
    $form = file_get_contents(getTplPath('affiches.php'));
    return $form;
}

function get_akilux3mm_form() {
    $form = file_get_contents(getTplPath('akilux3mm.php'));
    return $form;
}
function get_akilux3_5mm_form() {
    $form = file_get_contents(getTplPath('akilux3_5mm.php'));
    return $form;
}
function get_akilux5mm_form() {
    $form = file_get_contents(getTplPath('akilux5mm.php'));
    return $form;
}
function get_akilux10mm_form() {
    $form = file_get_contents(getTplPath('akilux10mm.php'));
    return $form;
}

function get_PVC300microns_form() {
    $form = file_get_contents(getTplPath('PVC300microns.php'));
    return $form;
}

function get_forex1mm_form() {
    $form = file_get_contents(getTplPath('forex1mm.php'));
    return $form;
}

function get_forex3mm_form() {
    $form = file_get_contents(getTplPath('forex3mm.php'));
    return $form;
}

function get_forex5mm_form() {
    $form = file_get_contents(getTplPath('forex5mm.php'));
    return $form;
}

function get_dibond_form() {
    $form = file_get_contents(getTplPath('dibond.php'));
    return $form;
}

function get_komadur_form() {
    $form = file_get_contents(getTplPath('komadur.php'));
    return $form;
}


function get_banderoles_form() {
    $form = file_get_contents(getTplPath('banderoles.php'));
    return $form;
}

function get_cartes_form() {
    $form = file_get_contents(getTplPath('cartes.php'));
    return $form;
}

function get_depliants_form() {
    $form = file_get_contents(getTplPath('depliants.php'));
    return $form;
}

function get_enseignes_form() {
    $form = file_get_contents(getTplPath('enseignes.php'));
    return $form;
}

function get_flyers_form() {
    $form = file_get_contents(getTplPath('flyers.php'));
    return $form;
}

function get_kakemonos_form() {
    $form = file_get_contents(getTplPath('kakemonos.php'));
    return $form;
}

function get_construction_form() {
    $form = file_get_contents(getTplPath('construction.php'));
    return $form;
}

function get_totem_form() {
    $form = file_get_contents(getTplPath('totem.php'));
    return $form;
}

function get_parapluie_form() {
    $form = file_get_contents(getTplPath('parapluie.php'));
    return $form;
}

function get_stickers_form() {
    $form = file_get_contents(getTplPath('stickers.php'));
    return $form;
}

function get_sticker_predecoupe_form() {
    $form = file_get_contents(getTplPath('sticker-predecoupe.php'));
    return $form;
}

function get_sticker_mural_form() {
    $form = file_get_contents(getTplPath('sticker-mural.php'));
    return $form;
}

function get_sticker_lettrage_predecoupe_form() {
    $form = file_get_contents(getTplPath('sticker-lettrage-predecoupe.php'));
    return $form;
}

function get_autocollant_form() {
    $form = file_get_contents(getTplPath('autocollant.php'));
    return $form;
}

function get_vitrophanie_form() {
    $form = file_get_contents(getTplPath('vitrophanie.php'));
    return $form;
}

function get_rollup_form() {
    $form = file_get_contents(getTplPath('roll-up.php'));
    return $form;
}

function get_test_rollup_form() {
    $form = file_get_contents(getTplPath('test-roll-up.php'));
    return $form;
}

function get_test_banderoles_form() {
    $form = file_get_contents(getTplPath('test-banderoles.php'));
    return $form;
}

function get_oriflammes_form() {
	$form = file_get_contents(getTplPath('oriflammes.php'));
	return $form;
}

function get_tente_exposition_form() {
    $form = file_get_contents(getTplPath('tente-publicitaire-barnum.php'));
    return $form;
}
function get_nappes_form() {
    $form = file_get_contents(getTplPath('nappes-publicitaires.php'));
    return $form;
}

function get_cadre_form() {
    $form = file_get_contents(getTplPath('cadre-tissu.php'));
    return $form;
}

function get_enseigne_suspendue_form() {
    $form = file_get_contents(getTplPath('enseigne-suspendue-textile.php'));
    return $form;
}



?>
