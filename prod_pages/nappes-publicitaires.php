<div id="buying">
	<h3>Votre devis en ligne</h3>
	<form class="jotform-form" action="" method="post" name="form_1060900217" id="1060900217" accept-charset="utf-8" onsubmit="JKakemono.cal_nappe(); return false;">
		<input type="hidden" name="formID" value="1060900217" />
		<div class="form-all">
			<ul class="form-section">

				<!--support---------------------------------------------------------->
				<li class="form-line select" id="id_support">
					<span class="helpButton">
						<img class="helpImg" src="//www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsupport" style="visibility:hidden;">
							<b>tissu 220g B1</b>: tissu stretch léger 100% polyester 220g traité retardant au feu B1<br />
							<b>tissu 260g B1</b>: tissu extensible 100% polyester 260g traité retardant au feu B1.<br />
						</span>
					</span>
					<select class="form-dropdown validate[required]" id="input_support" name="qext_support" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir le support...</option>
            <option value="tissu 220g">tissu stretch léger 220g B1</option>
						<option value="tissu 260g">tissu stretch extensible 260g B1</option>
					</select>
				</li>


				<!--forme---------------------------------------------------->
				<li class="form-line select" id="id_forme">
					<span class="helpButton">
						<img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpText8" style="visibility:hidden;">
							Votre <b>nappe personnalisée</b> peut être de forme ronde, carrée ou rectangulaire
						</span>
					</span>
					<select class="form-dropdown validate[required]" id="input_forme" name="q41_finition1" onchange="JKakemono.czyscpola(); ">
						<option value="">Choisir la forme</option>
						<option value="ronde">ronde</option>
						<option value="rectangulaire">carrée ou rectangulaire</option>
					</select>
				</li>

				<!--maquette----------------------------------------------------------->
				<li class="form-line select" id="id_maquette1">
					<span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextmaquette" style="visibility:hidden;"></span>
					</span>
					<select class="form-dropdown validate[required]" id="input_maquette1" name="q6_maquette1" onchange="JKakemono.czyscpola(); ">
						<option value="">fichier d'impression...</option>
						<option value="sansbat">j’ai mon fichier, je ne souhaite pas de BAT</option>
						<option value="user">j’ai mon fichier, je souhaite un BAT</option>
						<option value="config">je crée ma maquette en ligne</option>
                        <option value="fb">France banderole crée la mise en page</option>
					</select>
				</li>

        <li class="form-line select" id="id_maquette2">
					<span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextmaquetteBis" style="visibility:hidden;"></span>
					</span>
					<select class="form-dropdown validate[required]" id="input_maquette2" name="q6_maquette2" onchange="JKakemono.czyscpola(); ">
						<option value="">fichier d'impression...</option>
						<option value="sansbat">j’ai mon fichier, je ne souhaite pas de BAT</option>
						<option value="user">j’ai mon fichier, je souhaite un BAT</option>
						<option value="config">je crée ma maquette en ligne</option>
                        <option value="fb">France banderole crée la mise en page</option>
					</select>
				</li>

        <li class="form-line select" id="id_signature1">
          <span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsignature" style="visibility:hidden;"></span>
					</span>
					<select class="form-dropdown validate[required] optionsignature" id="input_signature1" name="qsignature_signature1" onchange="JKakemono.czyscpola(); ">
						<option value="">logo France Banderole ?</option>
						<option value="signature FB">produit signé</option>
						<option value="sans signature">produit neutre +5,00 €</option>
					</select>
				</li>

        <li class="form-line select" id="id_signature2">
          <span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsignatureBis" style="visibility:hidden;"></span>
					</span>
					<select class="form-dropdown validate[required] optionsignature" id="input_signature2" name="qsignature_signature2" onchange="JKakemono.czyscpola(); ">
						<option value="">logo France Banderole ?</option>
						<option value="signature FB">produit signé</option>
						<option value="sans signature">produit neutre +5,00 €</option>
					</select>
				</li>

				<!--taille et quantité------------------------------------------------->
				<li class="form-line optionsformline2" id="id_13" data-trigger="spinner">
					<label class="form-label-left label-highlight" id="label_13" for="input_13">quantité :<br /><span class="small">(par visuel)</span></label>
					<input type="text" class="form-textbox validate[required, Numeric]" id="input_13" name="q13_quantite" size="20" value="1" onclick="JKakemono.czyscpola(); " data-rule="quantity" />
					<div class="spinner-controls">
	   			 <a href="javascript:;" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
	   			 <a href="javascript:;" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
			  	</div>
				</li>

				<li id="id_14" class="form-line optionsformline2" style="nothing">
					<label class="form-label-left label-highlight" id="label_14" for="input_14">taille :<strong><span class="highlight small"><br />(Mètres)</span></strong></label>
					<input type="text" class="taille form-textbox validate[required, Numeric]" placeholder="hauteur" id="input_14" name="q14_taile" size="20" value="1" onclick="JKakemono.czyscpola();" />
					<span class="mLeft highlight">m</span><span class="heusepar">x</span>
					<input type="text" class="taille form-textbox2 validate[required, Numeric]" id="input_15" placeholder="largeur" name="q15_taile" size="20" value="1" onclick="JKakemono.czyscpola();" /><span class="mRight highlight">m</span>
				</li>

				<li id="id_14rond" class="form-line optionsformline2" style="nothing">
					<label class="form-label-left label-highlight" id="label_14rond" for="input_14rond">diamètre :<strong><span class="highlight small"><br />(Mètres)</span></strong></label>
					<input type="text" class="taille form-textbox validate[required, Numeric]" placeholder="diamètre" id="input_14rond" name="q14rond_taile" size="20" value="1" onclick="JKakemono.czyscpola();" />
					<span class="mLeft highlight">m</span>
				</li>

				<!--livraison---------------------------------------------------------->
				<li id="id_16" class="form-line optionsformline">
					<span class="title">OPTIONS DE LIVRAISON <span class="splitorhide">DISPONIBLES :</span> </span>

					<span class="options_single">

						<span class="optionsleft"><label class="form-label-left" id="label_adresse" for="adresse">Livré à l'adresse de votre choix</label>
							<input type="checkbox" class="form-checkbox" id="adresse" name="adresse[]" checked /><span class="helpButton">
								<span class="helpText" id="helpTextAdresse" style="visibility:hidden;"></span>
							</span>
						</span>

						<span class="optionsleft"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L'Atelier</label>
							<input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onclick="JKakemono.czyscpola();" />
							<span class="helpButton">
								<span class="helpText" id="helpTextetiquette" style="visibility:hidden;"></span>
							</span>
						</span>

						<span class="optionsright"><label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label>
							<input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onclick="JKakemono.czyscpola(); JKakemono.relaisColischeckbox();" />
							<span class="helpButton">
								<span class="helpText" id="helpTextrelais" style="visibility:hidden;"></span>
							</span>
						</span>

						<span class="optionsright"><label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
							<input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onclick="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
							<span class="helpButton">
								<span class="helpText" id="helpTextcolis" style="visibility:hidden;"></span>
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
		<div style="clear:both; height:10px"></div>
		<input type="hidden" id="simple_spc" name="simple_spc" value="1060900217" />

		<script type="text/javascript">
			document.getElementById("simple_spc").value += "-1060900217";
		</script>

		</form>
	</div>

	<div id="preview">

	  <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/arrow.png" alt="arrow" class="arrow" />

		<div id="container">

	    <div id="slides">
				<li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/nappe/slide/nappe-publicitaire0.jpg" alt="nappe publicitaire devis en ligne" title="nappe conférence meeting salons meilleur prix" /></li>
	      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/nappe/slide/nappe-publicitaire1.jpg" alt="nappe publicitaire pas cher" title="nappe publicitaire pas cher" /></li>
				<li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/nappe/slide/nappe-publicitaire2.jpg" alt="nappe publicitaire évènement" title="nappe imprimée" /></li>
				<li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/banderole/slide/devis-en-ligne.png" alt="commencez votre devis en ligne" title="devis impression nappe publicitaire" /></li>
	    </div>
	  </div>

	  <div id="preview_imag"></div>
	  <div id="preview_imag2"></div>
	  <div id="preview_imag3"></div>
	  <div id="preview_imag4"></div>
	  <div id="preview_imag5"></div>

	</div>

	<div class="dateLivraison" >
			<!--<span id="totaldays"></span>&nbsp;-->
			<span id="totalamt_16"></span>
			<span id='estdate_16' class="delivery-date"></span>
	</div>

	<div id="custom_price_unit" >
</div>

<script type="text/javascript">
	//////////////////////////////////////////////////////////////////////////////
	function Afficher()	{
		divliv = document.getElementById('livraisonrapide');
		if (divliv.style.display == 'none')
		divliv.style.display = 'block';
	}
	function Afficher()	{
		divInfo = document.getElementById('delivery-div');
		if (divInfo.style.display == 'none')
		divInfo.style.display = 'block';
	}
	function Masquer(){
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
			document.getElementById('roll').checked = false;
		}
	});
	jQuery('#roll').click(function() {
		if (document.getElementById('roll').checked) {
			document.getElementById('etiquette').checked = false;
			document.getElementById('relais').checked = false;
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
		////////////////////////////////////////////////////////////////////////////
		jQuery('.delivery , .production').click(function(){

		var ktorytyp          = '';
		var prliv             = '';
		var date_panier       = '';
		var dodatkowaopcja    = '';
		var prixunite         = 0;
		var cena              = 0; 	var cena2   		= 0;
		var rabat             = 0; 	var rabat2  		= 0;  var rabatp 	  = 0;
		var suma              = 0; 	var suma2   		= 0;
		var transport         = 0;
		var metraz            = 0;
		var metrazzaokraglony = 0;
		var largeur       	  = 0;
		var hauteur        	  = 0;
		var diametre          = 0;
		var finition          = 0; 	var option 			= 0; 	var fixation  = 0;
		var optliv            = ''; var remisik 		= '';
		var erreurType        = 0;
		var perteH            = 0; 	var perteL 			= 0;
		var h1                = 0; 	var h2      		= 0;
		var l1                = 0; 	var l2      		= 0;
		var oeillets          = 0; 	var optoeillets = 0;
		var opis              = ''; var bacheType   = '';
		var metragefinal      = 0;
		var cenatotal         = 0;
		var metrage           = 0;
		var plm               = 0; ////prix de la laize au M²
		var prixproduit       = 0;  var prix 				= 0;
		var prixtotal      	  = 0;
		var aBox              = document.getElementById('form-button-error1');
		var eBox              = document.getElementById('form-button-error2');
		aBox.innerHTML='';		eBox.innerHTML='';

		////////////////////////////////////////////////////////////////////////////
		largeur              = $('input_15').value ;
		largeur              = largeur.replace(',','.');
		largeur              = fixstr(largeur);
		$('input_15').value = largeur;
		hauteur               = $('input_14').value;
		hauteur               = hauteur.replace(',','.');
		hauteur               = fixstr(hauteur);
		$('input_14').value	 = hauteur;

		diametre               = $('input_14rond').value;
		diametre               = diametre.replace(',','.');
		diametre               = fixstr(diametre);
		$('input_14rond').value	 = diametre;

		diametre              = parseFloat(diametre);
		largeur               = parseFloat(largeur);
		hauteur               = parseFloat(hauteur);
		metraz = largeur*hauteur ;                   // métrage
		metraz = fixstr(metraz);
		var metrazzaokraglony1 = (largeur+hauteur)*2;               // périmètre
		metrazzaokraglony      = Math.round(metrazzaokraglony1);
		var hautbas            = largeur*2;
		var gauchedroite       = hauteur*2;
		var ilosc              = $('input_13').value;
		var laize = 0;

		/////////////////////////////////////////////////////////////////// prix de la banderole en fonction de la laize //

		if (largeur <= 1.55){l1=1.55; l2=1.55-largeur; perteL=l2*hauteur;};
		if ((largeur >= 1.56) && (largeur <= 2.60)){l1=2.6; l2=2.6-largeur; perteL=l2*hauteur;};
		if (largeur >= 2.61){l1=largeur; perteL=largeur*hauteur;};

		if (hauteur <= 1.55){h1=1.55; h2=1.55-hauteur; perteH=h2*largeur;};
		if ((hauteur >= 1.56) && (hauteur <= 2.60)){h1=2.60; h2=2.60-hauteur; perteH=h2*largeur;};
		if (hauteur >= 2.61){h1=hauteur; perteH=hauteur*largeur;};

		if (diametre <= 1.55){laize=1.55;};
		if ((diametre >= 1.56) && (diametre <= 2.60)){laize=2.60;};


		if ((perteH < perteL) && ($('input_forme').value == 'rectangulaire')){
			metrage = largeur*h1;

			////tissu 220g
			if (($('input_support').value == 'tissu 220g' ) && (h1<=1.00) ){plm =19.50 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =20.48 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =21.45 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =22.43 ;}
			if (($('input_support').value == 'tissu 220g' ) && (h1>=2.51)){plm =23.40 ;}
			////tissu 260g
			if (($('input_support').value == 'tissu 260g' ) && (h1<=1.00) ){plm =31.50 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =33.08 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =34.65 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =36.23 ;}
			if (($('input_support').value == 'tissu 260g' ) && (h1>=2.51)){plm =37.80 ;}

			prixproduit = metrage*plm;
			opis += '<br />- forme rectangulaire';
		}

		else if ((perteH > perteL) && ($('input_forme').value == 'rectangulaire')){
			metrage = hauteur*l1;

			////tissu 220g
			if (($('input_support').value == 'tissu 220g' ) && (h1<=1.00) ){plm =19.50 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =20.48 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =21.45 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =22.43 ;}
			if (($('input_support').value == 'tissu 220g' ) && (h1>=2.51)){plm =23.40 ;}
			////tissu 260g
			if (($('input_support').value == 'tissu 260g' ) && (h1<=1.00) ){plm =31.50 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =33.08 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =34.65 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =36.23 ;}
			if (($('input_support').value == 'tissu 260g' ) && (h1>=2.51)){plm =37.80 ;}

			prixproduit = metrage*plm;
			opis += '<br />- forme rectangulaire';
		}

		else if((perteH == perteL) && ($('input_forme').value == 'rectangulaire')){
			metrage = hauteur*l1;

			////tissu 220g
			if (($('input_support').value == 'tissu 220g' ) && (h1<=1.00) ){plm =19.50 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =20.48 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =21.45 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =22.43 ;}
			if (($('input_support').value == 'tissu 220g' ) && (h1>=2.51)){plm =23.40 ;}
			////tissu 260g
			if (($('input_support').value == 'tissu 260g' ) && (h1<=1.00) ){plm =31.50 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =33.08 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =34.65 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =36.23 ;}
			if (($('input_support').value == 'tissu 260g' ) && (h1>=2.51)){plm =37.80 ;}

			prixproduit = metrage*plm;////prix de la banderole
			opis += '<br />- forme rectangulaire';
		}

		if($('input_forme').value == 'ronde'){

			metrage = laize*diametre;
			opis += '<br />- forme ronde';

			////tissu 220g
			if (($('input_support').value == 'tissu 220g' ) && (h1<=1.00) ){plm =19.50 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =20.48 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =21.45 ;}
			if (($('input_support').value == 'tissu 220g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =22.43 ;}
			if (($('input_support').value == 'tissu 220g' ) && (h1>=2.51)){plm =23.40 ;}
			////tissu 260g
			if (($('input_support').value == 'tissu 260g' ) && (h1<=1.00) ){plm =31.50 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =33.08 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =34.65 ;}
			if (($('input_support').value == 'tissu 260g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =36.23 ;}
			if (($('input_support').value == 'tissu 260g' ) && (h1>=2.51)){plm =37.80 ;}

			hauteur = diametre;
			largeur = diametre;

			prixproduit = metrage*plm;////prix de la banderole
		}

		metragefinal=metrage*ilosc;
		prixtotal=prixproduit*ilosc;

		////////////////////////////////////////////////////////////////////////////

		// prix de l'ensemble de la commande en fonction metrage final /////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////// 440g //

		////////////////////////////////////////////////////////////// tissu 220g //
		if ($('input_support').value == 'tissu 220g' ) {
			if (metragefinal < 1.99) {cenatotal = prixtotal;}
			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = prixtotal*0.99;}
			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = prixtotal*0.98;}
			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = prixtotal*0.97;}
			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = prixtotal*0.96;}
			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = prixtotal*0.95;}
			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = prixtotal*0.94;}
			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = prixtotal*0.93;}
			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = prixtotal*0.92;}
			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = prixtotal*0.91;}
			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = prixtotal*0.90;}
			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = prixtotal*0.89;}
			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = prixtotal*0.88;}
			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = prixtotal*0.87;}
			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = prixtotal*0.86;}
			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = prixtotal*0.85;}
			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = prixtotal*0.84;}
			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = prixtotal*0.83;}
			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = prixtotal*0.82;}
			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = prixtotal*0.81;}
			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = prixtotal*0.80;}
			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = prixtotal*0.79;}
			if (metragefinal > 499.99) {cenatotal = prixtotal*0.78;}
			bacheType = '- tissu stretch léger 220g B1'
		}
		////////////////////////////////////////////////////////////// tissu 260g //
		if ($('input_support').value == 'tissu 260g' ) {
			if (metragefinal < 1.99) {cenatotal = prixtotal;}
			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = prixtotal*0.99;}
			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = prixtotal*0.98;}
			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = prixtotal*0.97;}
			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = prixtotal*0.96;}
			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = prixtotal*0.95;}
			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = prixtotal*0.94;}
			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = prixtotal*0.93;}
			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = prixtotal*0.92;}
			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = prixtotal*0.91;}
			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = prixtotal*0.90;}
			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = prixtotal*0.89;}
			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = prixtotal*0.88;}
			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = prixtotal*0.87;}
			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = prixtotal*0.86;}
			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = prixtotal*0.85;}
			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = prixtotal*0.84;}
			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = prixtotal*0.83;}
			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = prixtotal*0.82;}
			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = prixtotal*0.81;}
			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = prixtotal*0.80;}
			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = prixtotal*0.79;}
			if (metragefinal > 499.99) {cenatotal = prixtotal*0.78;}
			bacheType = '- tissu stretch extensible 260g B1'
		}
		// fin prix des bâches /////////////////////////////////////////////////////


		// ourlet /////////////////////////////////////////////////////
		var ourlet =0;
		var perimetrerond = diametre*3.14
		var perimetrecarre = gauchedroite + hautbas;
		if($('input_forme').value == 'ronde'){ourlet=4.5*perimetrerond;}
		if($('input_forme').value == 'rectangulaire'){ourlet=4.5*perimetrecarre;}

		// prix bâche+ourlet /////////////////////////////////////////////////////
		var transport = 5;
		cena=(cenatotal+ourlet+transport)/ilosc;

		//////////////////////////////////////////////////////////////// maquette //

		var maquette='';
		if ($('input_maquette1').value == 'fb') {
			cena += 19/ilosc;
			maquette = '<br />- France banderole crée la mise en page';
		}
		if ($('input_maquette1').value == 'user') {
			cena+= 5/ilosc;
			maquette = '<br />- BAT en LIGNE';
		}
		if ($('input_maquette1').value == 'config') {
			cena+= 5/ilosc;
			maquette = '<br />- je crée ma maquette en ligne';
		}
		if ($('input_maquette1').value == 'sansbat') {
			maquette = '<br />- je ne souhaite pas de BAT';
		}

		if ($('input_maquette2').value == 'fb') {
			cena += 19/ilosc;
			maquette = '<br />- France banderole crée la mise en page';
		}
		if ($('input_maquette2').value == 'user') {
			cena+= 5/ilosc;
			maquette = '<br />- BAT en LIGNE';
		}
		if ($('input_maquette2').value == 'config') {
			cena+= 5/ilosc;
			maquette = '<br />- je crée ma maquette en ligne';
		}
		if ($('input_maquette2').value == 'sansbat') {
			maquette = '<br<strong></strong> />- je ne souhaite pas de BAT';
		}

		if ($('input_signature1').value == 'sans signature') {
			if ( !$('revendeur') && !$('revendeurRS') ) {cena+= 5;}
			opis += '<br />- sans signature';
		}
		if ($('input_signature1').value == 'signature FB') {
			opis += '<br />- signature France Banderole';
		}
		if ($('input_signature2').value == 'sans signature') {
			if ( !$('revendeur') && !$('revendeurRS') ) {cena+= 5;}
			opis += '<br />- sans signature';
		}
		if ($('input_signature2').value == 'signature FB') {
			opis += '<br />- signature France Banderole';
		}

		/////////////////////////////////////////////////////////// options colis //
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
					jQuery('.form-textbox2').click(function(){
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

			///////////////////////////////////////////////////// calcul des délais //
			var production      = jQuery('#production-value').val();
			//alert(production);
			var delivery        = jQuery('#delivery-value').val();

			if(production && delivery){
				// Calculate price
				//alert('click');
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

				//var str = price_unit;
				//var totalPrice         = parseFloat(str.replace(',','.').replace(' ','').replace('&euro;',''));
				var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
				var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
				var finalPrice           = (calculatedTotalPrice + price_unit);

				// Calculate Days
				var prod_first_val  = parseInt(production[0]);
				var prod_second_val = parseInt(production[2]);
				var deli_first_val  = parseInt(delivery[0]);
				var deli_second_val = parseInt(delivery[2]);

				var totalProduction = prod_first_val + deli_first_val;
				var totalDelivery   = prod_second_val + deli_second_val;

				if(totalProduction == totalDelivery){
					jQuery('#totaldays').text("Total jours " + totalProduction);
					var days = totalProduction;
				} else {
					jQuery('#totaldays').text("Total jours "+totalProduction+'/'+totalDelivery);
					var days = totalDelivery;
				}

				var curdate = new Date();
				var curhour = curdate.getHours();
				// ajout 1 jour ouvré de délai sur commande après 12h
				if (curhour >= 12) {
					// + 1 jour pour l'option livré roulé
					if (jQuery('#roll').is(':checked')) {
						var daystoadd = AddBusinessDays(days+2);
					}else{
						var daystoadd = AddBusinessDays(days+1);
					}
				} else {
					// + 1 jour pour l'option livré roulé
					if (jQuery('#roll').is(':checked')) {
						var daystoadd = AddBusinessDays(days+1);
					}else{
						var daystoadd = AddBusinessDays(days);
					}
				}

				curdate.setDate(curdate.getDate()+daystoadd);
				var estdt = new Date(curdate);
				var month = estdt.getMonth()+1;
				var day = estdt.getDate();
				var output = day + '/' + (month<10 ? '0' : '') + month + '/' + (day<10 ? '' : '') + estdt.getFullYear();

				if(jQuery('#id_16').css('display') != 'none')	{
					jQuery('#estdate_16').html('Date de livraison max : '+output+'  <a class="linkUppercase modal-link" href="//www.france-banderole.com/etre-livre-rapidement/" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>');
				}

				var finalPrice1=fixstr(finalPrice);
				finalPrice2 = finalPrice1.replace(".", ",");

				jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
				//jQuery('#remise').html(rabat2);
			}

			////////////////////////////////////////////////////// prix avec délais //
			prixunite = finalPrice1;
			cena=prixunite*ilosc;

			//////////////////////////////////////////////////////////////// remise //
			var total = document.getElementById("total");
			var remise = document.getElementById("remise");

			rabat=fixstr(rabat);
			rabat2 = rabat.replace(".", ",");
			if (rabat2 != 0) {rabat2 = rabat2+' &euro;'}
			if (rabat2 == 0) {rabat2 = '-'}
			//remise.innerHTML=rabat2;

			prixunite=fixstr(prixunite);
			/* koszty transportu */
			transport=0;

			//////////////////////////////////////////////////////////////////////////
	  	cena2 = prixunite.replace(".", ",")
	    //////////////////////////////////////////////////////////////////////////
			aBox.style.display="none";
			//////////////////////////////////// 	avertissements, messages d'erreur //



			//----------------------------------------------------------------- + de 50m
			if ((largeur >= 50) && ($('input_forme').value == 'rectangulaire')) {
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> la largeur ne doit pas dépasser 50m';
				eBox.style.display="block";
				erreurType=1;
			}

			//----------------------------------------------------------------- + de 2.59m
			if ((hauteur >= 2.59) && ($('input_forme').value == 'rectangulaire')) {
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> la hauteur ne doit pas dépasser 2,59m!';
				eBox.style.display="block";
				erreurType=1;
			}
			//----------------------------------------------------------------- + de 2.59m
			if ($('input_forme').value == 'ronde'){
			if (($('input_14rond').value <= 0.49) ||  ($('input_14rond').value >= 2.59)){
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> le diamètre doit être compris entre 0,5m et 2,59m';
				eBox.style.display="block";
				erreurType=1;
			}}


			//-----------------------------------------------------------------------nul
			if ( ((largeur <= 0 ) || (hauteur <= 0 )) && ($('input_forme').value == 'rectangulaire')){
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> SPÉCIFIEZ LES TAILLES EN MÈTRE !';
				eBox.style.display="block";
				erreurType=1;
			}
			//-----------------------------------------------------------------------nul
			if ( (diametre <= 0 ) && ($('input_forme').value == 'ronde')){
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> SPÉCIFIEZ LES TAILLES EN MÈTRE !';
				eBox.style.display="block";
				erreurType=1;
			}
			//----------------------------------------------------------------------vide
			if (ilosc.empty()){
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Merci de spécifier une quantité';
				eBox.style.display="block";
				erreurType=1;
			}

			// fin avertissements //////////////////////////////////////////////////////
			////////////////////////////// formulaire cas particulier erreurType==1 //

			if (erreurType==1) {
				aBox.style.display="none";
				jQuery('#submit_cart').css('display', 'none');
				jQuery('#prix_unitaire').html('-');
				//remise.innerHTML='-';
				var opt = document.getElementById("option");
				prix.innerHTML='-';
				opt.innerHTML='-';
				total.innerHTML='-';
				var newtotal = document.getElementById("total");
				newtotal.innerHTML='-';
				newopt.innerHTML='-';
				rabat2='-';
			}

			////////////////////////////////////////////////// livraison le jour même //

			if ((DeliveryType == '1-1') && (PorductType == '1-1')){
				livraisonrapide.style.display = 'block';
			}
			else {livraisonrapide.style.display = 'none';}

			//////////////////////////////////////////////// si aucun cas particulier //

			if ((erreurType==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))) {
				suma=cena-rabat;
				suma=fixstr(suma);
				suma2 = suma.replace(".", ",");
				total.innerHTML=suma2+' &euro;';

				var blad = document.getElementById("id_14");
				blad.style.background = "none";

				if (option>0) {
					option=fixstr(option);
					option2 = option.replace(".", ",");
					var opt = document.getElementById("option");
					opt.innerHTML=option2+' &euro;';
				}
				if (option==0) {
					option2 = '-';
					var opt = document.getElementById("option");
					opt.innerHTML='-';
				}

				var erreurType = 0;
				if ( suma < 14.90 ) {
					var forfait = 14.90 - suma;
					forfait = fixstr(forfait);
					jQuery('#forfait').html('FORFAIT '+forfait+' &euro; - ');
					if (option>0) {
						var newoption = parseFloat(option) + parseFloat(forfait);
						newoption=fixstr(newoption);
						newoption2 = newoption.replace(".", ",");
						option2 = newoption2;
						var newopt = document.getElementById("option");
						newopt.innerHTML=newoption2+' &euro;';
						suma = 14.90;
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
						suma = 14.90;
						suma=fixstr(suma);
						suma2 = suma.replace(".", ",");
						var newtotal = document.getElementById("total");
						newtotal.innerHTML=suma2+' &euro;';
					}
				}

				////////////////////////////////////////////////////// envoi formulaire //

				var rodzaj = "Nappe";
				if($('input_forme').value == 'rectangulaire'){
				var dodajkoszyk = document.getElementById("cart_form");
				// largeur et hauteur x100 pour un affichage en cm côté admin
				dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+bacheType+'</br>- H|'+(hauteur*100).toFixed(0)+' x L|'+(largeur*100).toFixed(0)+' cm'+opis+maquette+optliv+prliv+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur*100+'" /><input type="hidden" name="largeur" value="'+largeur*100+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button> ';
				livraisonComp.style.display = 'block';
				}
				if($('input_forme').value == 'ronde'){
				var dodajkoszyk = document.getElementById("cart_form");
				// largeur et hauteur x100 pour un affichage en cm côté admin
				dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+bacheType+'</br>- &empty;|'+(diametre*100).toFixed(0)+' cm'+opis+maquette+optliv+prliv+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur*100+'" /><input type="hidden" name="largeur" value="'+largeur*100+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button> ';
				livraisonComp.style.display = 'block';
				}
			}

		});  // fin prod/delivery click function

	});  // fin jq doc ready

	</script>
