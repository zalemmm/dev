<div id="buying">
  <h3>Votre devis en ligne</h3>
  <!-- <a href="http://www.france-banderole.com/enseignes/"><<< Retour enseignes</a> -->
  <form class="jotform-form" action="" method="post" name="form_1060900217" id="1060900217" accept-charset="utf-8" onsubmit="JKakemono.cal_PVC300microns(); return false;">
    <div class="form-all">
      <ul class="form-section">

        <li class="form-line select" id="id_1">
          <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir l'impression...</option>
            <option value="recto">Recto </option>
            <option value="rectoverso">Recto/Verso </option>
          </select>
        </li>

        <li class="form-line select" id="id_HD">
					<span class="helpButton"><img class="helpImg"  src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png"><span class="helpText" id="helpTextHD" style="visibility:hidden;">• <span class="highlight"><u><b>Impression akilux Haute définition :</b></u></span><br/>impression directe UV HD 1200x1200Dpi. Pour une impression akylux parfaite même de très près.<br />• <span class="highlight"><u><b>Impression akilux standard :</b></u></span><br/>impression directe UV 600x600Dpi. Pour une impression akilux pas cher de très bonne qualité à 1 mètre.<a href="http://www.france-banderole.com/wp-content/uploads/2016/12/impression-HD-panneaux-akylux-pas-cher-big.jpg" title="impression Haute définition panneaux akilux pas cher"><img class="" title="impressio HD panneaux akylux pas cher" alt="panneaux imprimés akilux pas cher" src="http://www.france-banderole.com/wp-content/uploads/2016/12/impression-HD-panneaux-akylux-pas-cher.jpg"></a><br/></span></span>
					<select class="form-dropdown validate[required]" id="input_HD" name="qHD_maquette" onclick="JKakemono.czyscpola(); ">
						<option value="">choisir qualité d'impression...</option>
						<option value="HD">Haute définition</option>
						<option value="standard">Standard</option>
					</select>
				</li>

        <li class="form-line select" id="id_2">
          <select class="form-dropdown validate[required]" id="input_2" name="2_usage" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir les fixations...</option>
            <option value="2oeillets">2 oeillets (en haut)</option>
            <option value="4oeillets">4 oeillets</option>
            <option value="sans">pas de fixations</option>
          </select>
        </li>

        <li class="form-line select" id="id_3">
          <span class="helpButton">
						<img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextmaquette" style="visibility:hidden;">
                        	<b>j’ai mon fichier, je ne souhaite pas de BAT :</b><br/>
							Après la réception de votre fichier et de votre paiement, la commande sera mise directement en production. Si votre fichier ne respecte pas nos spécifications, il sera automatiquement adapté par notre service infographie. Supprimer le BAT décharge France Banderole de toutes responsabilités en cas de non conformité de votre fichier (couleur, format, pixellisation, fond perdu, faute orthographique, etc).<br/>
							<b>j’ai mon fichier, je souhaite un BAT numérique +5,00€ :</b><br/>
							Vous envoyez votre propre fichier (une fois votre devis enregistré). Ce dernier sera contrôlé par notre service d'infographie et, un <span class="highlight"><b>BAT à valider</b></span> vous sera transmis dans votre accès client. Votre production commence après la validation de ce BAT numérique en ligne<br/>
							<b>Vous créez votre maquette en ligne +5,00€ :</b><br/>
							Dans le détail de votre commande vous aurez accès à notre outil de personnalisation en ligne. Simple et axé sur les fonctionnalités essentielles, il vous permettra de composer en quelques clics une maquette aux bonnes dimensions avec vos éléments personnels (logos, images...), du texte et un large choix de polices, couleurs, formes.<br />
							<b>France banderole crée votre fichier +19,00€ :</b><br/>
							Vous fournissez <span class="highlight"><b> de 1 à 6 éléments séparés</b></span> et un explicatif sur votre souhait. Notre équipe d'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.<br/>
                        </span>
					</span>
					</span>
					<select class="form-dropdown validate[required]" id="input_3" name="q3_maquette" onclick="JKakemono.czyscpola(); ">
						<option value="">fichier d'impression...</option>
						<option value="sansbat">j’ai mon fichier, je ne souhaite pas de BAT</option>
						<option value="user">j’ai mon fichier, je souhaite un BAT</option>
						<option value="config">je crée ma maquette en ligne</option>
                        <option value="fb">France banderole crée la mise en page</option>
					</select>
				</li>
                <li class="form-line select" id="id_signature">
                <span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsignature" style="visibility:hidden;">
                        	<b>Logo France Banderole</b><br/>
							Si vous choisissez l'option "produit signé" un petit logo sera imprimé en bas de votre visuel <br/>
                            <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/signature.png" alt="signature France Banderole">
                        </span>
					</span>
					<select class="form-dropdown validate[required] optionsignature" id="input_signature" name="qsignature_signature" onchange="JKakemono.czyscpola(); ">
						<option value="">logo France Banderole ?</option>
						<option value="signature FB">produit signé</option>
						<option value="sans signature">produit neutre +5,00 €</option>
					</select>
				</li>

        <li class="form-line optionsformline2" id="id_4" data-trigger="spinner">
          <label class="form-label-left label-highlight" id="label_4" for="input_4">quantité :<br /><span class="small">(par visuel)</span></label>
          <input type="text" class="form-textbox validate[required, Numeric]" id="input_4" name="q4_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); "  data-rule="quantity" />
					<div class="spinner-controls">
	   			 <a href="javascript:;" data-spin="up"><i class="fa fa-plus" aria-hidden="true"></i></a>
	   			 <a href="javascript:;" data-spin="down"><i class="fa fa-minus" aria-hidden="true"></i></a>
			  	</div>
        </li>

        <li id="id_5" class="form-line optionsformline2">
          <label class="form-label-left label-highlight" id="label_5" for="input_5">taille <strong><br /><span class="highlight small">(centimètres)</span></span></strong>:</label>
          <input type="text" class="form-textbox validate[required, Numeric]" placeholder="hauteur" id="input_5" name="q5_taile" size="20" value="1" onclick="JKakemono.czyscpola(); " /><span class="cmLeft highlight">CM</span><span class="heusepar">x</span><input type="text" class="form-textbox2 validate[required, Numeric]" placeholder="largeur" id="input_6" name="q6_taile" size="20" value="1" onclick="JKakemono.czyscpola(); " /><span class="cmRight highlight">CM</span><span class="cmLeft highlight">CM</span><span class="llar">[hauteur]</span><span class="lhau">[largeur]</span>
        </li>

        <li id="id_7" class="form-line optionsformline">
          <span class="title">OPTIONS DE LIVRAISON <span class="splitorhide">DISPONIBLES :</span> </span>

          <span class="options_single">

            <span class="optionsleft">
              <label class="form-label-left" id="label_adresse" for="adresse">Livré à l'adresse de votre choix</label>
              <input type="checkbox" class="form-checkbox" id="adresse" name="adresse[]" checked />
              <span class="helpButton">
                <span class="helpText" id="helpTextAdresse" style="visibility:hidden;">Pour être livré directement chez vous ou à votre adresse professionnelle. Par défaut votre adresse de facturation sera utilisée, mais vous pourrez spécifier une adresse de livraison dans votre accès client. </span>
              </span>
            </span>

            <span class="optionsleft">
              <label class="form-label-left" id="label_etiquette" for="etiquette">Retrait colis à l'Atelier</label>
              <input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onchange="JKakemono.czyscpola(); " />
              <span class="helpButton">
                <span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles. Vos frais de port seront supprimés de votre devis avant votre paiement.</span>
              </span>
            </span>

            <span class="optionsleft">
              <label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label>
              <input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onchange="JKakemono.relaisColischeckbox(); JKakemono.czyscpola(); " />
              <span class="helpButton">
                <span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span>
              </span>
            </span>

            <span class="optionsright">
              <label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
              <input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onchange="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
              <span class="helpButton">
                <span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span>
              </span>
            </span>

          </span>

          <div class="break-line"></div>

					<p id="production" >
						<h5 class="delivery-delay">Delai Production :</h5>
						<button class="production" text-value="4-5" id="p1"></button>
						<button class="production" text-value="2-3" id="p2"></button>
						<button class="production" text-value="1-1" id="p3"></button>
						<input type="hidden" id="production-value" value=""  onClick="" />
					</p>

					<div id="delivery-div" style='display:none;'>
						<p id="delivery" >
							<h5 class="delivery-delay">Delai Livraison :</h5>
							<button class="delivery" text-value="3-4" id="l1"></button>
							<button class="delivery" text-value="2-3" id="l2"></button>
							<button class="delivery" text-value="1-1" id="l3"></button>
							<input type="hidden" id="delivery-value" value="" />
						</p>
					</div>
      </li>

      <li class="form-line select" id="id_9a">
        <div class="form-input-wide">
          <button id="input_9" type="submit" class="form-submit-button" style="display: none;">Submit Form</button>
        </div>
      </li>

      <li style="display:none">
        Should be Empty:
        <input type="text" name="website" value="" />
      </li>

    </ul>
  </div>

  <input type="hidden" id="simple_spc" name="simple_spc" value="1060900217" />
  <script type="text/javascript">document.getElementById("simple_spc").value += "-1060900217";</script>

</form>
</div>

<div id="preview">

    <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/arrow.png" alt="arrow" class="arrow" />

    <div id="container">

      <div id="slides">
        <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/slidedefault/1.png" alt="commencez votre devis en ligne" /></li>
        <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/slidedefault/2.png" alt="commencez votre devis en ligne" /></li>
        <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/slidedefault/3.png" alt="commencez votre devis en ligne" /></li>
      </div>
    </div>

    <div id="preview_imag"></div>
    <div id="preview_imag2"></div>
    <div id="preview_imag3"></div>
    <div id="preview_imag4"></div>
    <div id="preview_imag5"></div>

</div>

<div class="dateLivraison">
	<!--<span id="totaldays"></span>&nbsp;-->
	<span id="totalamt_8"></span>
	<span id='estdate_8' class="delivery-date"></span>
</div>

<div id="custom_price_unit" >

</div>

<script type="text/javascript">
  ////////////////////////////////////////////////////// checkboxes livraison //
  jQuery('#adresse').click(function() {
    if (document.getElementById('adresse').checked) {
      document.getElementById('relais').checked = false;
      document.getElementById('etiquette').checked = false;
    }
  });
  jQuery('#etiquette').click(function() {
    if (document.getElementById('etiquette').checked) {
      document.getElementById('relais').checked = false;
      document.getElementById('adresse').checked = false;
    }
  });
  jQuery('#relais').click(function() {
    if (document.getElementById('relais').checked) {
      document.getElementById('etiquette').checked = false;
      document.getElementById('adresse').checked = false;
    }
  });

  //////////////////////////////////////////////////////////////////////////////
	function Afficher() {
		divliv = document.getElementById('livraisonrapide');
		if (divliv.style.display == 'none')
		divliv.style.display = 'block';
	}
	function Afficher() {
		divInfo = document.getElementById('delivery-div');
		if (divInfo.style.display == 'none')
		divInfo.style.display = 'block';
	}
	function Masquer() {
		divInfo = document.getElementById('delivery-div');
		if (divInfo.style.display == 'block')
		divInfo.style.display = 'none';
	}

  /////////////////////////////////////////////////// calcul des jours ouvrés //
	function AddBusinessDays(weekDaysToAdd) {
	  // fonction jours ouvrés
	  var curdate = new Date();
	  var realDaysToAdd = 0;
	  for(i=0; i<weekDaysToAdd; i++){
	    curdate.setDate(curdate.getDate()+1);
	    var estdt1 = new Date(curdate);
	    var n = curdate.getDay();
	    if (n == '6' || n == '0') {
	      weekDaysToAdd++;
	    }
	    realDaysToAdd++;
	    //check if current day is business day
	  }
	  return realDaysToAdd;
	}

  //////////////////////////////////////////////////////////////////////////////
  jQuery(document).ready(function(){
    ////////////////////////////////////////////////////////////////////////////
  	jQuery('.delivery , .production').click(function(){

      var cena       = 0;     var cena2 = 0;    var cena1 = 0;  var cenar = 0;  var cenarv = 0;
      var suma       = 0;     var suma2 = 0;
      var prliv      = '';
      var transport  = 0;
      var ilosc      = 0;
      var opis       = '';
      var cedzik     = '';
      var niepokazuj = 0;
      var option2    = 0;
      var largeur    = 0;
      var hauteur    = 0;
      var rabat      = 0;     var rabat2 = 0;
      var HD         = 0;
      var p1         = 0;     var p2     = 0;   var fixations = 0;  var maquette = 0; var metrage = 0;
      var eBox       = document.getElementById('form-button-error2');
      eBox.innerHTML = '';
      var ilosc      = $('input_4').value;

      //////////////////////////////////////////////////////////////////////////
    	ilosc = $('input_4').value;
    	largeur = ($('input_6').value);
    	largeur = largeur.replace(',','.');
    	largeur = fixstr(largeur);
    	$('input_6').value = largeur;
    	hauteur = ($('input_5').value);
    	hauteur = hauteur.replace(',','.');
    	hauteur = fixstr(hauteur);
    	$('input_5').value = hauteur;

    	/////////////////////////////////////////////////////////////// métrage //
    	metrage = (largeur/100)*(hauteur/100)*ilosc

    	/////////////////////////////////////////////////////////////// PVC 300µ//
    	if ($('input_1').value == 'recto'){
    		if (metrage<=0.03){p1=17*metrage;}
    		if ((metrage > 0.03) && (metrage <= 0.05)){p1=15*metrage;}
    		if ((metrage > 0.05) && (metrage <= 0.08)){p1=14*metrage;}
    		if ((metrage > 0.08) && (metrage <= 0.12)){p1=13*metrage;}
    		if ((metrage > 0.12) && (metrage <= 0.20)){p1=12*metrage;}
    		if (0.20<metrage){p1=11*metrage;}
    		opis += '- PVC 300µ recto';
    	}

    	if ($('input_1').value == 'rectoverso'){
    		if (metrage<=0.03){p1=(17+(17*0.4))*metrage;}////// +40% /////
    		if ((metrage > 0.03) && (metrage <= 0.05)){p1=(15+(15*0.4))*metrage;}//// +40% /////
    		if ((metrage > 0.05) && (metrage <= 0.08)){p1=(14+(14*0.4))*metrage;}//// +40% /////
    		if ((metrage > 0.08) && (metrage <= 0.12)){p1=(13+(13*0.4))*metrage;}/// +40% /////
    		if ((metrage > 0.12) && (metrage <= 0.20)){p1=(12+(12*0.4))*metrage;}// +40% /////
    		if(0.20<metrage){p1=(11+(11*0.4))*metrage;}////// +40% /////
    		opis += '- PVC 300µ recto/verso';
    	}

    	////////////////////////////////////////////////////////////// fixations//
    	if ($('input_2').value == '2oeillets'){fixations=1*ilosc; opis += '<br />- 2 oeillets';}
    	if ($('input_2').value == '4oeillets'){fixations=2*ilosc; opis += '<br />- 4 oeillets';}
    	if ($('input_2').value == 'sans'){fixations=0; opis += '<br />- sans oeillet';}

    	////////////////////////////////////////////////////////////// maquette //
    	if ($('input_3').value == 'fb') {maquette=19; opis += '<br />- France banderole crée la maquette';}
    	if ($('input_3').value == 'user') {maquette=5; opis += '<br />- BAT en ligne';}
      	if ($('input_3').value == 'config') {maquette=5; opis += '<br />- je crée ma maquette en ligne';}
		if ($('input_3').value == 'sansbat') {opis += '<br />- je ne souhaite pas de BAT';}

    	//////////////////////////////////////////////////////// tarif unitaire //
    	puoption = p1+fixations+HD;

    	//////////////////////////////////////////////////////////////////// HD //
    	if ($('input_HD').value == 'HD') {HD = (puoption)*0.30; puoption+=HD; opis += '<br />- HD';}
    	if ($('input_HD').value == 'standard') {HD = 0; puoption+=HD; opis += '<br />- Standard';}

    	///////////////////////////////////////////////////////////////// total //
    	puoption2 = (puoption+maquette)/ilosc;
    	cena = puoption+maquette;

      /////////////////////////////////////////////////////////////// options //
      var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
      if (colis == true) {
        if ( !$('revendeur') && !$('revendeurRC') ) {cena+= 2}
        opis += '<br />- colis revendeur';
      }
      var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
      var etiqdesc = '';
      if (etiquette == true) {
        transport=0;
        etiqdesc = '<br />- retrait colis a l\'atelier';
        cena-= cena*3/100;
      }

      var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
      if (relais == true) {
        prixunite += 5.00;
        cena += 5.00;
        cedzik += '<br />- relais colis';
      }
	  //////////////////////////////////////////////////////signature
			if ($('input_signature').value == 'signature FB') {
				opis += '<br />- signature France Banderole';
			}
			if ($('input_signature').value == 'sans signature') {
				if ( !$('revendeur') && !$('revendeurRS') ) {cena+= 5*ilosc;};
				opis += '<br />- sans signature';
			}

      ///////////////////////////////////////////////////////////// transport //
      poidstotal = metrage*40;
    	if (poidstotal <= 1) {prixtransport=4.80;}
    	if ((poidstotal > 1) && (poidstotal <= 2)) {prixtransport=5.1;}
    	if ((poidstotal > 2) && (poidstotal <= 3)) {prixtransport=5.67;}
    	if ((poidstotal > 3) && (poidstotal <= 4)) {prixtransport=5.63;}
    	if ((poidstotal > 4) && (poidstotal <= 5)) {prixtransport=6.88;}
    	if ((poidstotal > 5) && (poidstotal <= 6)) {prixtransport=7.99;}
    	if ((poidstotal > 6) && (poidstotal <= 7)) {prixtransport=7.99;}
    	if ((poidstotal > 7) && (poidstotal <= 10)) {prixtransport=9.30;}
    	if ((poidstotal > 10) && (poidstotal <= 15)) {prixtransport=11.93;}
    	if ((poidstotal > 15) && (poidstotal <= 20)) {prixtransport=14.93;}
      if ((poidstotal > 20) && (poidstotal <= 25)) {prixtransport=18.82;}
    	if ((poidstotal > 25) && (poidstotal <= 30)) {prixtransport=20.56;}
    	if ((poidstotal > 30) && (poidstotal <= 40)) {prixtransport=25.64;}
    	if ((poidstotal > 40) && (poidstotal <= 50)) {prixtransport=33.73;}
      if ((poidstotal > 50) && (poidstotal <= 60)) {prixtransport=42.14;}
    	if ((poidstotal > 60) && (poidstotal <= 70)) {prixtransport=47.71;}
    	if ((poidstotal > 70) && (poidstotal <= 80)) {prixtransport=55.26;}
    	if ((poidstotal > 80) && (poidstotal <= 90)) {prixtransport=62.12;}
      if ((poidstotal > 90) && (poidstotal <= 100)) {prixtransport=68.54;}
    	if (poidstotal > 100) {prixtransport=69.26;}

    	prixtransport2 = prixtransport*0.4;
    	transport = prixtransport + prixtransport2;
    	// fin transport /////////////////////////////////////////////////////////

      ///////////////////////////////////////////////////////// total produit //
    	puoption2=fixstr(puoption2);
    	cena2 = puoption2.replace(".", ",");
    	var prix = document.getElementById("prix_unitaire");
    	prix.innerHTML=cena2+' &euro;';

      prixunite = cena;
			cena=prixunite*ilosc;

			prixunite=fixstr(prixunite);
			cena2 = prixunite.replace(".", ",");

      ///////////////////////////////////////////// affichage jours livraison //
      var myClass = jQuery(this).attr("class");
      var niepokazuj = 0;

      var n = myClass.search("production");
      if (n != -1) {
        jQuery('.production').prop("disabled",false);
        jQuery('.production').removeClass('active');
        jQuery(this).addClass('active');
        var production = jQuery(this).attr('onClick');
        jQuery('#production-value').val(Afficher());
        var production = jQuery(this).attr('text-value');
        jQuery('#production-value').val(production);
        jQuery(this).prop("disabled",true);
      }

      var m = myClass.search("delivery");
      if (m != -1) {
        jQuery('.delivery').prop("disabled",false);
        jQuery('.delivery').removeClass('active');
        jQuery(this).addClass('active');
        var delivery = jQuery(this).attr('text-value');
        jQuery('#delivery-value').val(delivery);
        jQuery(this).prop("disabled",true);


        jQuery(document).ready(function(){
          jQuery('.jotform-form select').click(function(){
            jQuery('#delivery-value').val(Masquer());
            jQuery('.delivery').prop("disabled",false);
            jQuery('.production').prop("disabled",false);
            jQuery('.production').removeClass('active');
            jQuery(this).addClass('');
            jQuery('.delivery').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(production-value).prop("disabled",false);
            jQuery(delivery-value).prop("disabled",true);
          });
        });

        jQuery(document).ready(function(){
          jQuery('.form-textbox').click(function(){
            jQuery('#delivery-value').val(Masquer());
            jQuery('.delivery').prop("disabled",false);
            jQuery('.production').prop("disabled",false);
            jQuery('.production').removeClass('active');
            jQuery(this).addClass('');
            jQuery('.delivery').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(production-value).prop("disabled",false);
            jQuery(delivery-value).prop("disabled",true);
          });
        });

        jQuery(document).ready(function(){
          jQuery('.form-textbox2').click(function(){
            jQuery('#delivery-value').val(Masquer());
            jQuery('.delivery').prop("disabled",false);
            jQuery('.production').prop("disabled",false);
            jQuery('.production').removeClass('active');
            jQuery(this).addClass('');
            jQuery('.delivery').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(production-value).prop("disabled",false);
            jQuery(delivery-value).prop("disabled",true);
          });
        });

        jQuery(document).ready(function(){
          jQuery('.form-checkbox').click(function(){
            jQuery('#delivery-value').val(Masquer());
            jQuery('.delivery').prop("disabled",false);
            jQuery('.production').prop("disabled",false);
            jQuery('.production').removeClass('active');
            jQuery(this).addClass('');
            jQuery('.delivery').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(production-value).prop("disabled",false);
            jQuery(delivery-value).prop("disabled",true);
          });
        });
      }

      var production      = jQuery('#production-value').val();
      var delivery        = jQuery('#delivery-value').val();

      if(production && delivery){
        // Calculate price
        var ProdPercent = '';
        var DeliPercent = '';
        var PorductType = jQuery('.production.active').attr('text-value');
        var DeliveryType = jQuery('.delivery.active').attr('text-value');
        if(PorductType == '2-3' ){
          ProdPercent = 20;
          prliv += '<br />- P 2-3J';
        }else if(PorductType =='1-1'){
          ProdPercent = 45;
          prliv += '<br />- P 1J';
        }else{
          ProdPercent = 0;
          prliv += '<br />- P 4-5J';
        }

        if(DeliveryType == '2-3'){
          DeliPercent = 20;
          prliv += ' / L 2-3J';
        }else if(DeliveryType =='1-1'){
          DeliPercent = 45;
          prliv += ' / L 1J';
        }else{
          DeliPercent = 0;
          prliv += ' / L 3-4J';
        }

        var price_unit = parseFloat(prixunite);
        var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
        var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
        var finalPrice           = (calculatedTotalPrice + price_unit)/ilosc;

        ////////////////////////////////////////////////////// Calculate Days //
        var prod_first_val  = parseInt(production[0]);
        var prod_second_val = parseInt(production[2]);
        var deli_first_val  = parseInt(delivery[0]);
        var deli_second_val = parseInt(delivery[2]);

        var totalProduction = prod_first_val + deli_first_val;
        var totalDelivery   = prod_second_val + deli_second_val;
        if(totalProduction == totalDelivery){
          jQuery('#totaldays').text("Total jours " + totalProduction);
          var days = totalProduction;
        }else{
          jQuery('#totaldays').text("Total jours "+totalProduction+'/'+totalDelivery);
          var days = totalDelivery;
        }

        var curdate = new Date();
        var curhour = curdate.getHours();
        // ajout 1 jour ouvré de délai sur commande après 12h
        if (curhour >= 12) {
          var daystoadd = AddBusinessDays(days+1);
        }else{
          var daystoadd = AddBusinessDays(days);
        }

        curdate.setDate(curdate.getDate()+daystoadd);
        var estdt = new Date(curdate);
        var month = estdt.getMonth()+1;
        var day = estdt.getDate();
        var output = day + '/' + (month<10 ? '0' : '') + month + '/' + (day<10 ? '' : '') + estdt.getFullYear();

        if(jQuery('#id_7').css('display') != 'none') {
          jQuery('#estdate_7').html('Date de livraison max : '+output+'  <a class="linkUppercase modal-link" href="//www.france-banderole.com/etre-livre-rapidement/" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>');
        }

        finalPrice1=fixstr(finalPrice);
        finalPrice2 = finalPrice1.replace(".", ",");


        jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
        jQuery('#remise').html(rabat2);
      }

      ////////////////////////////////////////////////////// prix avec délais //
      prixunite = finalPrice1;
      cena=prixunite*ilosc;

      //////////////////////////////////////////////////////////////// remise //
			var total = document.getElementById("total");
			var remise = document.getElementById("remise");

			prixunite=fixstr(prixunite);
      transport=0;

      //////////////////////////////////////////////////////////////////////////
      cena2 = prixunite.replace(".", ",");
      //////////////////////////////////////////////////////////////////////////

			var niepokazuj = 0;
			if (ilosc==''){niepokazuj=1;}
      if (niepokazuj==1) {
        prix.innerHTML='-';
        remise.innerHTML='-';
        total.innerHTML='-';
        finalPrice='0';
        $('submit_cart').style.display="none";
      }

      //////////////////////////////////////////////// livraison le jour même //
      if ((DeliveryType == '1-1') && (PorductType == '1-1')){
        livraisonrapide.style.display = 'block';
      }
      else {livraisonrapide.style.display = 'none';}

      /////////////////////////////////////////////////// messages d'erreur //
      if (ilosc.empty()){
        eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Merci de spécifier une quantité et une taille en centimètres';
        eBox.style.display="block";
      }
      if ( (hauteur > 160) && (largeur > 160) ) {
        eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Attention nos rouleaux ou panneaux font au maximum 160 cm !';
        eBox.style.display="block";
        niepokazuj=1;
      }
      if ( (hauteur < 20) || (largeur < 20) ) {
        eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Vos dimensions doivent être supérieures à 20x30cm!';
        eBox.style.display="block";
        niepokazuj=1;
      }
      if ( (hauteur < 30) && (largeur < 30) ) {
        eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Vos dimensions doivent être supérieures à 20x30cm!';
        eBox.style.display="block";
        niepokazuj=1;
      }

      ////////////////////////////////////////////////////// envoi formulaire //
      if ((niepokazuj==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){

      	suma=cena;
      	suma=fixstr(suma);
      	suma2 = suma.replace(".", ",");
      	var total = document.getElementById("total");
      	total.innerHTML=suma2+' &euro;';

      	var forfait = 29 - suma;
      	if (forfait > 0){

      		forfait = fixstr(forfait);
      		jQuery('#forfait').html('FORFAIT '+forfait+' &euro; - ');
      		var newoption = parseFloat(forfait);
      		newoption=fixstr(newoption);
      		newoption2 = newoption.replace(".", ",");
      		option2 = newoption2;
      		var newopt = document.getElementById("option");
      		newopt.innerHTML=newoption2+' &euro;';
      		suma = 29;
      		suma=fixstr(suma);
      		suma2 = suma.replace(".", ",");
      		var newtotal = document.getElementById("total");
      		newtotal.innerHTML=suma2+' &euro;';
      	}

      	var rodzaj = "PVC 300 microns";
      	var dodajkoszyk = document.getElementById("cart_form");
      	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'</br>- H|'+hauteur+' x L|'+largeur+' cm'+etiqdesc+prliv+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur+'" /><input type="hidden" name="largeur" value="'+largeur+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button> ';
      }else{
				suma='-';
				suma2 = '-';
				total.innerHTML=suma2;
				$('submit_cart').style.display = 'none';
				livraisonComp.style.display = 'none';
			}


    });
  });
  </script>
