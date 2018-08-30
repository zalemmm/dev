<div id="buying">
  <h3>Votre devis en ligne</h3>
  <form class="jotform-form" action="" method="post" name="form_1060900214" id="1060900214" accept-charset="utf-8" onsubmit="JKakemono.cal_cadre(); return false;">
    <input type="hidden" name="formID" value="1060900214" />

    <div class="form-all">
      <ul class="form-section">

        <li class="form-line select" id="id_1">
          <span class="helpButton">
            <img class="helpImg" src="../wp-content/plugins/fbshop/images/question.png">
            <span class="helpText" id="helpText1" style="visibility:hidden;">
              • <u><b>Cadre tissu standard</u>: <span class="highlight">Moins de 95,00 € livré</span></b><br/>Le cadre tissu standard est composé de la structure et du visuel imprimé.<br />
              • <u><b>cadre tissu lumineux </u>: <span class="highlight">Dès 510,00€</span></b><br/>Le cadre tissu lumineux est composé de la structure, du visuel imprimé et des LED.<br/>
              • <u><b>Cadre stucture seule</u>: <span class="highlight">Dès 61,00€</span></b><br/>Stucture avec connecteur<br />
              • <u><b>Visuel (tissu imprimé)</u>: <span class="highlight">Dès 12,00€</span></b><br/>Tissu imprimé avec jonc<br />
            </span>
          </span>
          <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onclick="JKakemono.czyscpola();  ">
            <option value="">choisir le type</option>
            <option value="Cadre tissu standard">Cadre tissu standard (structure + visuel)</option>
			      <option value="Cadre tissu lumineux">Cadre tissu lumineux (structure + visuel + led)</option>
            <option value="Cadre (structure seule)">Cadre (structure seule)</option>
            <option value="visuel (tissu imprimé)">visuel (tissu imprimé)</option>
          </select>
        </li>


        <!--taille cadre lumineux----------------------------------------------------------->
        <li class="form-line optionsformline4" id="id_21">
					<select class="form-dropdown validate[required]" id="input_21" name="q21_finition1" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir la hauteur...</option>
				  	<option value="0.5">Hauteur 50cm</option>
						<option value="1">Hauteur 100cm</option>
						<option value="1.8">Hauteur 180cm</option>
						<option value="2">Hauteur 200cm</option>
           				 <option value="2.5">Hauteur 250cm</option>
					</select>
		    </li>

        <li class="form-line optionsformline5" id="id_22">
					<select class="form-dropdown validate[required]" id="input_22" name="q22_finition1" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir la largeur...</option>
						<option value="0.8">Largeur 80cm</option>
						<option value="1">Largeur 100cm</option>
						<option value="1.5">Largeur 150cm</option>
						<option value="2">Largeur 200cm</option>
           				 <option value="3">Largeur 300cm</option>
					</select>
	    	</li>


 <li class="form-line select" id="id_couleur">

					<select class="form-dropdown validate[required]" id="input_couleur" name="q_couleur" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir la couleur du cadre</option>
						<option value="blanc">blanc</option>
						<option value="gris">gris</option>
                        <option value="noir">noir</option>
					</select>
		</li>


        <!--maquette----------------------------------------------------------->
				<li class="form-line select" id="id_maquette-led">
					<span class="helpButton"><img class="helpImg" src="../wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextmaquette" style="visibility:hidden;">
                        	<b>j’ai mon fichier, je ne souhaite pas de BAT:</b><br/>
							Après la réception de votre fichier et de votre paiement, la commande sera mise directement en production. Si votre fichier ne respecte pas nos spécifications, il sera automatiquement adapté par notre service infographie. Supprimer le BAT décharge France Banderole de toutes responsabilités en cas de non conformité de votre fichier (couleur, format, pixellisation, fond perdu, faute orthographique, etc).<br/>
							<b>j’ai mon fichier, je souhaite un BAT numérique +5,00€ :</b><br/>
							Vous envoyez votre propre fichier (une fois votre devis enregistré). Ce dernier sera contrôlé par notre service d'infographie et, un <span class="highlight"><b>BAT à valider</b></span> vous sera transmis dans votre accès client. Votre production commence après la validation de ce BAT numérique en ligne<br/>
							<b>Vous créez votre maquette en ligne +5,00€ :</b><br/>
							Dans le détail de votre commande vous aurez accès à notre outil de personnalisation en ligne. Simple et axé sur les fonctionnalités essentielles, il vous permettra de composer en quelques clics une maquette aux bonnes dimensions avec vos éléments personnels (logos, images...), du texte et un large choix de polices, couleurs, formes.<br />
							<b>France banderole crée votre fichier +19,00€ :</b><br/>
							Vous fournissez <span class="highlight"><b> de 1 à 6 éléments séparés</b></span> et un explicatif sur votre souhait. Notre équipe d'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.<br/>
                        </span>
					</span>
					<select class="form-dropdown validate[required]" id="input_maquette-led" name="q_maquette-led" onchange="JKakemono.czyscpola(); ">
						<option value="">fichier d'impression...</option>
						<option value="sansbat">j’ai mon fichier, je ne souhaite pas de BAT</option>
						<option value="user">j’ai mon fichier, je souhaite un BAT</option>
						<option value="config">je crée ma maquette en ligne</option>
                        <option value="fb">France banderole crée la mise en page</option>
					</select>
				</li>
                <li class="form-line select" id="id_6">
					<span class="helpButton"><img class="helpImg" src="../wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextmaquette" style="visibility:hidden;">
                        	<b>j’ai mon fichier, je ne souhaite pas de BAT:</b><br/>
							Après la réception de votre fichier et de votre paiement, la commande sera mise directement en production. Si votre fichier ne respecte pas nos spécifications, il sera automatiquement adapté par notre service infographie. Supprimer le BAT décharge France Banderole de toutes responsabilités en cas de non conformité de votre fichier (couleur, format, pixellisation, fond perdu, faute orthographique, etc).<br/>
							<b>j’ai mon fichier, je souhaite un BAT numérique +5,00€ :</b><br/>
							Vous envoyez votre propre fichier (une fois votre devis enregistré). Ce dernier sera contrôlé par notre service d'infographie et, un <span class="highlight"><b>BAT à valider</b></span> vous sera transmis dans votre accès client. Votre production commence après la validation de ce BAT numérique en ligne<br/>
							<b>Vous créez votre maquette en ligne +5,00€ :</b><br/>
							Dans le détail de votre commande vous aurez accès à notre outil de personnalisation en ligne. Simple et axé sur les fonctionnalités essentielles, il vous permettra de composer en quelques clics une maquette aux bonnes dimensions avec vos éléments personnels (logos, images...), du texte et un large choix de polices, couleurs, formes.<br />
							<b>France banderole crée votre fichier +19,00€ :</b><br/>
							Vous fournissez <span class="highlight"><b> de 1 à 6 éléments séparés</b></span> et un explicatif sur votre souhait. Notre équipe d'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.<br/>
                        </span>
					</span>
					<select class="form-dropdown validate[required]" id="input_6" name="q_6" onchange="JKakemono.czyscpola(); ">
						<option value="">fichier d'impression...</option>
						<option value="sansbat">j’ai mon fichier, je ne souhaite pas de BAT</option>
						<option value="user">j’ai mon fichier, je souhaite un BAT</option>
						<option value="config">je crée ma maquette en ligne</option>
                        <option value="fb">France banderole crée la mise en page</option>
					</select>
				</li>
		<!--signature----------------------------------------------------------->
        <li class="form-line select" id="id_signature-led">
        	<span class="helpButton">
						<img class="helpImg" src="../wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsignature" style="visibility:hidden;">
              <b>Logo France Banderole</b><br/>
						  Si vous choisissez l'option "produit signé" un petit logo sera imprimé en bas de votre visuel <br/>
              <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/signature.png" alt="signature France Banderole">
            </span>
					</span>
					<select class="form-dropdown validate[required]" id="input_signature-led" name="qsignature_signature-led" onchange="JKakemono.czyscpola(); ">
						<option value="">logo France Banderole ?</option>
						<option value="signature FB">produit signé</option>
						<option value="sans signature">produit neutre +5,00 €</option>
					</select>
		</li>
         <li class="form-line select" id="id_signature">
        	<span class="helpButton">
						<img class="helpImg" src="../wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsignature" style="visibility:hidden;">
              <b>Logo France Banderole</b><br/>
						  Si vous choisissez l'option "produit signé" un petit logo sera imprimé en bas de votre visuel <br/>
              <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/signature.png" alt="signature France Banderole">
            </span>
					</span>
					<select class="form-dropdown validate[required]" id="input_signature" name="qsignature_signature" onchange="JKakemono.czyscpola(); ">
						<option value="">logo France Banderole ?</option>
						<option value="signature FB">produit signé</option>
						<option value="sans signature">produit neutre +5,00 €</option>
					</select>
		</li>


              <!--taille cadre standard------------------------------------------------->
                <li id="id_23" class="form-line optionsformline2" style="nothing">
					<label class="form-label-left label-highlight" id="label_23" for="input_23">taille :<strong><span class="highlight small"><br />(Mètres)</span></strong></label>
					<input type="text" class="taille form-textbox validate[required, Numeric]" placeholder="hauteur" id="input_23" name="q23_taile" size="20" value="1" onclick="JKakemono.czyscpola();" />
					<span class="mLeft highlight">m</span><span class="heusepar">x</span>
					<input type="text" class="taille form-textbox2 validate[required, Numeric]" id="input_24" placeholder="largeur" name="q24_taile" size="20" value="1" onclick="JKakemono.czyscpola();" /><span class="mRight highlight">m</span>
				</li>


				<!--quantité------------------------------------------------->
				<li class="form-line optionsformline2" id="id_4" data-trigger="spinner">
					<label class="form-label-left label-highlight" id="label_4" for="input_4">quantité :<br /><span class="small">(par visuel)</span></label>
					<input type="text" class="form-textbox validate[required, Numeric]" id="input_4" name="q4_quantite" size="20" value="1" onclick="JKakemono.czyscpola(); " data-rule="quantity" />
					<div class="spinner-controls">
	   			 <a href="javascript:;" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
	   			 <a href="javascript:;" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
			  	</div>
				</li>

				<!--livraison---------------------------------------------------------->
				<li id="id_8" class="form-line optionsformline">
					<span class="title">OPTIONS DE LIVRAISON <span class="splitorhide">DISPONIBLES :</span> </span>

					<span class="options_single">

						<span class="optionsleft"><label class="form-label-left" id="label_adresse" for="adresse">Livré à l'adresse de votre choix</label>
							<input type="checkbox" class="form-checkbox" id="adresse" name="adresse[]" checked /><span class="helpButton">
								<span class="helpText" id="helpTextAdresse" style="visibility:hidden;">Pour être livré directement chez vous ou à votre adresse professionnelle. Par défaut votre adresse de facturation sera utilisée, mais vous pourrez spécifier une adresse de livraison dans votre accès client. </span>
							</span>
						</span>

						<span class="optionsleft"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L'Atelier</label>
							<input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onclick="JKakemono.czyscpola();" />
							<span class="helpButton">
								<span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles.</span>
							</span>
						</span>



						<span class="optionsright"><label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
							<input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onclick="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
							<span class="helpButton">
								<span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole. Vous pouvez également transmettre un bon de livraison personnalisé dans votre accès client</span>
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
							<!--<button class="delivery" text-value="1-1" id="l3"></button>-->
							<input type="hidden" id="delivery-value" value="" />
						</p>
					</div>

				</li>

				<li id="id_18" class="form-line id_18" style="top:14px">
					<div class="form-input-wide">

						<button id="input_18" type="submit" class="form-submit-button" style="display: none;">Submit Form</button>
					</div>
				</li>
				<li style="display:none">
					Should be Empty:
					<input type="text" name="website" value="" />
				</li>

			</ul>

		</div>

      <input type="hidden" id="simple_spc" name="simple_spc" value="1060900214" />

      <script type="text/javascript">
      document.getElementById("simple_spc").value += "-1060900214";
      </script>


    </form>
  </div>

  <div id="preview">

    <img src="../wp-content/plugins/fbshop/images/arrow.png" alt="arrow" class="arrow" />

    <div id="container">
      <div id="slides">
        	<li><img src="../wp-content/plugins/fbshop/images/cadre-tissu/slide/cadre-tissu-1.jpg" alt="fabricant cadre textile" title="impression cadre textile tissu tendu" /></li>
  			<li><img src="../wp-content/plugins/fbshop/images/cadre-tissu/slide/cadre-tissu-2.jpg" alt="impression cadre textile" title="cloison cadre textile stand professionnel"  /></li>
  			<li><img src="../wp-content/plugins/fbshop/images/cadre-tissu/slide/cadre-tissu-3.jpg" alt="cadre tissu tendu pas cher" title="cloison textile salon pro pas cher"  /></li>
            <li><img src="../wp-content/plugins/fbshop/images/cadre-tissu/slide/cadre-tissu-4.jpg" alt="mur textile tendu stand salon" title="cadre textile stand pro meilleur prix"  /></li>
             <li><img src="../wp-content/plugins/fbshop/images/cadre-tissu/slide/cadre-tissu-5.jpg" alt="habillage stand salon pro" title="habillage stand pro cadre textile tendu"  /></li>
  			<li><img src="../wp-content/plugins/fbshop/images/cadre-tissu/slide/devis-en-ligne.png" alt="commencez votre devis en ligne" title="devis impression grand format" /></li>
      </div>
    </div>

    <div id="preview_imag"></div>
    <div id="preview_imag2"></div>
    <div id="preview_imag3"></div>
    <div id="preview_imag4"></div>
    <div id="preview_imag5"></div>
    <div id="preview_imag6"></div>

  </div>

  <div class="dateLivraison">
    <!--<span id="totaldays"></span>&nbsp;-->
    <span id="totalamt_8"></span>
    <span id='estdate_8' class="delivery-date"></span>
  </div>

<div id="custom_price_unit" >

</div>


<script type="text/javascript">
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
		jQuery('.delivery , .production').click(function(){
			//alert(cena);
			var perteH             = 0; 	var perteL   = 0;
		  var h1                 = 0; 	var h2       = 0;
		  var l1                 = 0; 	var l2       = 0;
		  var metragefinal       = 0;		var details  = '';
		  var cenatotal          = '';  var opis     = '';
		  var metraz             = 0;
		  var metrazzaokraglony  = 0;
		  var metrazzaokraglony1 = 0;
		  var largeur            = 0;
		  var hauteur            = 0;
		  var prixsupport        = 0;
		  var poids              = '';                                           ////poids total
		  var p1                 = '';                                           ////poids du support
		  var p2                 = '';                                           ////poids du structure
		  var metrage            = 0;
		  var structure          = 0;
		  var fp                 = '';
		  var tissu              = 0;   var jonc              = 0;
		  var pmL              = 0; ///////////prix au metre linéaire
	    var pu                 = 0;
			var cena               = 0; 	var cena2      = 0; 		var prixunite  = 0;
			var rabat              = 0;	 	var rabat2     = 0;
			var suma               = 0; 	var suma2      = 0;
			var transport          = 0;
			var designation        = '';
			var optliv             = '';
			var prliv              = '';
			var date_panier        = '';
			var option     = '';
			var ilosc              = $('input_4').value;



	  ////////////////////////////////////////////////////////////////////////////
		largeur                = ($('input_24').value);       // largeur = largeur
		largeur                = largeur.replace(',','.');
		largeur                = fixstr(largeur);
		$('input_24').value    = largeur;
		hauteur                = ($('input_23').value);        // hauteur = hauteur
		hauteur                = hauteur.replace(',','.');
		hauteur                = fixstr(hauteur);
		$('input_23').value    = hauteur;
		largeur                = parseFloat(largeur);
		hauteur                = parseFloat(hauteur);
		metraz                 = largeur * hauteur;                    // métrage
		metraz                 = fixstr(metraz);
		var metrazzaokraglony1 = (largeur+hauteur)*2;                // périmètre
		metrazzaokraglony      = Math.round(metrazzaokraglony1);



    if (($('input_1').value == 'Cadre tissu standard')) {

		if (metraz <= 0.5) {pmL=14;}
		if (metraz > 0.5) {pmL=9;}
		tissu = metraz*23
		jonc = metrazzaokraglony1*1.18*2 ////////1.18 prix au m²
		structure = metrazzaokraglony1*pmL*2
		//////////////// prix Cadre tissu standard
		cena = structure+tissu+jonc;
		poids = metrazzaokraglony1*0.320;
		var produit ='Cadre tissu standard';

    }


	 if (($('input_1').value == 'Cadre (structure seule)')) {

		if (metraz <= 0.5) {pmL=14;}
		if (metraz > 0.5) {pmL=9;}
		tissu = metraz*23
		jonc = metrazzaokraglony1*1.18*2.25 ////////1.18 prix au m²
		structure = metrazzaokraglony1*pmL*2.25
		//////////////// prix Cadre tissu standard
		cena = structure;
		var produit ='structure seule';

    }

	 if (($('input_1').value == 'visuel (tissu imprimé)')) {

		if (metraz <= 0.5) {pmL=14;}
		if (metraz > 0.5) {pmL=9;}
		tissu = metraz*23
		jonc = metrazzaokraglony1*1.18*3 ////////1.18 prix au m²
		structure = metrazzaokraglony1*pmL*3
		//////////////// prix Cadre tissu standard
		cena = tissu+jonc;
		var produit ='visuel (tissu imprimé)';

    }


	 if (($('input_1').value == 'Cadre tissu lumineux')) {
      	////////////////////structure
		if (($('input_21').value == '0.5') && ($('input_22').value == '0.8')) {structure=220;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '1')) {structure=226;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '1.5')) {structure=325;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '2')) {structure=382;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '3')) {structure=NUL;}

		if (($('input_21').value == '1') && ($('input_22').value == '0.8')) {structure=241;}
		if (($('input_21').value == '1') && ($('input_22').value == '1')) {structure=250;}
		if (($('input_21').value == '1') && ($('input_22').value == '1.5')) {structure=349;}
		if (($('input_21').value == '1') && ($('input_22').value == '2')) {structure=407;}
		if (($('input_21').value == '1') && ($('input_22').value == '3')) {structure=571;}

		if (($('input_21').value == '1.8') && ($('input_22').value == '0.8')) {structure=272;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '1')) {structure=282;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '1.5')) {structure=369;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '2')) {structure=425;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '3')) {structure=590;}

		if (($('input_21').value == '2') && ($('input_22').value == '0.8')) {structure=292;}
		if (($('input_21').value == '2') && ($('input_22').value == '1')) {structure=306;}
		if (($('input_21').value == '2') && ($('input_22').value == '1.5')) {structure=403;}
		if (($('input_21').value == '2') && ($('input_22').value == '2')) {structure=458;}
		if (($('input_21').value == '2') && ($('input_22').value == '3')) {structure=624;}

		if (($('input_21').value == '2.5') && ($('input_22').value == '0.8')) {structure=311;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '1')) {structure=327;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '1.5')) {structure=424;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '2')) {structure=479;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '3')) {structure=643;}

		////////////////////visuel backlite + DOS OCCULTANT
		if (($('input_21').value == '0.5') && ($('input_22').value == '0.8')) {tissu=50+30;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '1')) {tissu=50+30;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '1.5')) {tissu=50+30;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '2')) {tissu=50+30;}
		if (($('input_21').value == '0.5') && ($('input_22').value == '3')) {tissu=NUL;}

		if (($('input_21').value == '1') && ($('input_22').value == '0.8')) {tissu=50+30;}
		if (($('input_21').value == '1') && ($('input_22').value == '1')) {tissu=50+30;}
		if (($('input_21').value == '1') && ($('input_22').value == '1.5')) {tissu=70+45;}
		if (($('input_21').value == '1') && ($('input_22').value == '2')) {tissu=90+60;}
		if (($('input_21').value == '1') && ($('input_22').value == '3')) {tissu=130+90;}

		if (($('input_21').value == '1.8') && ($('input_22').value == '0.8')) {tissu=68+43;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '1')) {tissu=82+54;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '1.5')) {tissu=118+81;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '2')) {tissu=154+108;}
		if (($('input_21').value == '1.8') && ($('input_22').value == '3')) {tissu=226+162;}

		if (($('input_21').value == '2') && ($('input_22').value == '0.8')) {tissu=74+48;}
		if (($('input_21').value == '2') && ($('input_22').value == '1')) {tissu=90+60;}
		if (($('input_21').value == '2') && ($('input_22').value == '1.5')) {tissu=130+90;}
		if (($('input_21').value == '2') && ($('input_22').value == '2')) {tissu=170+120;}
		if (($('input_21').value == '2') && ($('input_22').value == '3')) {tissu=250+180;}

		if (($('input_21').value == '2.5') && ($('input_22').value == '0.8')) {tissu=90+60;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '1')) {tissu=110+75;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '1.5')) {tissu=160+112;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '2')) {tissu=210+150;}
		if (($('input_21').value == '2.5') && ($('input_22').value == '3')) {tissu=310+225;}

		//////////////prix Cadre tissu lumineux
		cena= (tissu+structure)*1.70
		var produit ='Cadre tissu lumineux';
		largeur = ($('input_22').value);
		hauteur = ($('input_21').value);
    }

    ////////////////////////////////////////////////////////// choix maquette //
    var maquette;
    if (($('input_6').value == 'fb')){
     cena+=19/ilosc;
     maquette = 'France banderole crée la maquette';
    }
    if (($('input_6').value == 'user')) {
     maquette = 'BAT en ligne';
    cena+=5/ilosc;
    }
    if (($('input_6').value == 'sansbat')) {
     maquette = 'je ne souhaite pas de BAT';
    }
    if  (($('input_6').value == 'config')){
     cena+=5/ilosc;
     maquette = 'je crée ma maquette en ligne';
    }


	 if (($('input_maquette-led').value == 'fb')){
     cena+=19/ilosc;
     maquette = 'France banderole crée la maquette';
    }
    if (($('input_maquette-led').value == 'user')) {
     maquette = 'BAT en ligne';
    cena+=5/ilosc;
    }
    if (($('input_maquette-led').value == 'sansbat')) {
     maquette = 'je ne souhaite pas de BAT';
    }
    if  (($('input_maquette-led').value == 'config')){
     cena+=5/ilosc;
     maquette = 'je crée ma maquette en ligne';
    }

	  /////////////////////////////////////////////////////////////// signature //
	  if ($('input_signature').value == 'signature FB') {
  				opis += '<br />- signature France Banderole';
  			}
	  if ($('input_signature-led').value == 'signature FB') {
			opis += '<br />- signature France Banderole';
		}
	  if ($('input_signature').value == 'sans signature') {
			opis += '<br />- sans signature';
			if ( !$('revendeur') && !$('revendeurRS') ) {cena+= 5;}
		}
	  if ($('input_signature-led').value == 'sans signature') {
			opis += '<br />- sans signature';
			if ( !$('revendeur') && !$('revendeurRS') ) {cena+= 5;}
		}

    ///////////////////////////////////////////////////////////////// options //
    var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
    if (colis == true) {
     if ( !$('revendeur') && !$('revendeurRC') ) {cena+= 2;}
     optliv += '<br />- colis revendeur';
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
     cena += 5.00/ilosc;
     optliv += '<br />- relais colis';
    }

    /////////////////////////////////////////////////////////// total produit //
    prixunite = cena;
    cena=prixunite*ilosc;
    prixunite=fixstr(prixunite);
    cena2 = prixunite.replace(".", ",");

    /////////////////////////////////////////////// affichage jours livraison //
    var myClass = jQuery(this).attr("class");
    var erreurType = 0;

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
          jQuery('#production-value').prop("disabled",false);
          jQuery('#delivery-value').prop("disabled",true);
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
          jQuery('#production-value').prop("disabled",false);
          jQuery('#delivery-value').prop("disabled",true);
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
          jQuery('#production-value').prop("disabled",false);
          jQuery('#delivery-value').prop("disabled",true);
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

      var price_unit           = parseFloat(prixunite);
      var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
      var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
      var finalPrice           = calculatedTotalPrice + price_unit;

      //////////////////////////////////////////////////////// Calculate Days //
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
      if(jQuery('#id_8').css('display') != 'none') {
        jQuery('#estdate_8').html('Date de livraison max : '+output+'  <a class="linkUppercase modal-link" href="//www.france-banderole.com/etre-livre-rapidement/" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>');
      }

      var finalPrice1=fixstr(finalPrice);
      finalPrice2 = finalPrice1.replace(".", ",");

      jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
      jQuery('#remise').html(rabat2);

    }

    //////////////////////////////////////////////////////// prix avec délais //
    prixunite = finalPrice1;
    cena=prixunite*ilosc;

    ////////////////////////////////////////////////////////////////// remise //
    var total = document.getElementById("total");
    var remise = document.getElementById("remise");

    prixunite=fixstr(prixunite);
    transport=0;

    ////////////////////////////////////////////////////////////////////////////
    cena2 = prixunite.replace(".", ",")
    ////////////////////////////////////////////////////////////////////////////

    var erreurType = 0;

    ////////////////////////////////////////////////// livraison le jour même //

    ////////////////////////////////////////////////////////////////// alerte //
    if (($('input_1').value == '')){
      eBox.innerHTML = '<button type="button" class="closeButton" name="button"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Merci de choisir la largeur de votre clipit';
      eBox.style.display="block";
      prix.innerHTML='-';
      remise.innerHTML='-';
      total.innerHTML='-';
    }

    //////////////////////////////////////////////////////// envoi formulaire //
    if ((erreurType==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){
			suma=cena-rabat;
			suma=fixstr(suma);
			suma2 = suma.replace(".", ",");
			total.innerHTML=suma2+' &euro;';

			if (option==0) {
				option2 = '-';
				var opt = document.getElementById("option");
				opt.innerHTML='-';
			}
			var erreurType = 0;
			if ( suma < 29 ) {
				var forfait = 29 - suma;
				forfait = fixstr(forfait);
				jQuery('#forfait').html('FORFAIT '+forfait+' &euro; - ');
				if (option>0) {
					var newoption = parseFloat(option) + parseFloat(forfait);
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
				} else {
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
      }

      var dodajkoszyk = document.getElementById("cart_form");
      var base64;

      jQuery('#preview .arrow').hide();

      if(!document.documentMode){ // ne pas charger ce script sous IE
        domtoimage.toBlob(document.getElementById('preview')).then(function (blob) {
          saveBlobAsFile(blob, "XX.png").then(function (data) {
            base64 = data;
            sendData();
          });
        });

        // this function is to convert blob to base64 img
        function saveBlobAsFile(blob, fileName) {
          return new Promise(function (resolve, reject) {
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onload = function () {
              return resolve(reader.result);
            };
            reader.onerror = function (error) {
              return reject(error);
            };
            return Promise.resolve(reader.result);
          });
        }

        function sendData() {
          dodajkoszyk.innerHTML += '<input type="hidden" name="image" value="'+base64+'" />';
        }
      }

      dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Cadre tissu" /><input type="hidden" name="opis" value="- '+produit+' '+designation+details+'<br />- H|'+(hauteur*100).toFixed(0)+' x L|'+(largeur*100).toFixed(0)+' cm<br />- '+maquette+optliv+opis+etiqdesc+prliv+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur*100+'" /><input type="hidden" name="largeur" value="'+largeur*100+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button> ';
      livraisonComp.style.display = 'block';
    }
  });
});
</script>
