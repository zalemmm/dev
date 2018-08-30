<div id="buying">
	<h3>Votre devis en ligne</h3>
	<form class="jotform-form" action="" method="post" name="form_1060900216" id="1060900216" accept-charset="utf-8" onsubmit="JKakemono.cal_stickers(); return false;">
		<input type="hidden" name="formID" value="1060900216" />
		<div class="form-all">
			<ul class="form-section">

				<li class="form-line select" id="id_1">
					<span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsupport" style="visibility:hidden;">
							• <b><u>Stickytex</u></b>: Support indéchirable et imperméable pouvant être retiré et repositionné sans endommager le mur ni laisser aucun résidu.
						</span>
					</span>
					<select class="form-dropdown validate[required]" id="input_1" name="q1_support1" onclick="JKakemono.czyscpola(); ">
						<option value="">Choisir le support </option>
						<option value="stickytex">Stickytex</option>
						<!--<option value="papier peint">Papier peint adhérant</option>-->
					</select>
				</li>

				<li class="form-line select" id="id_5">
					<span class="helpButton">
						<img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpText5" style="visibility:hidden;">
							• <b><u>Découpe simple</u>: <span class="highlight">Dès 60€/m²</span></b> votre sticker est prédécoupé suivant une forme simple, carrée ou rectangulaire.<br />
							• <b><u>Découpe contour</u>: <span class="highlight">Dès 75€/m²</span></b> votre sticker est prédécoupé suivant le contour du motif.<br />
						</span>
					</span>
					<select class="form-dropdown validate[required]" id="input_5" name="q5_support5" onclick="JKakemono.czyscpola(); ">
						<option value="">Choisir la découpe</option>
						<option value="decoupe simple">Découpe simple</option>
						<option value="decoupe contour">Découpe contour</option>
					</select>
				</li>

				<li class="form-line select" id="id_4">
					<span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png"><span class="helpText" id="helpTextoption" style="visibility:hidden;"></span></span>
					<select class="form-dropdown validate[required]" id="input_4" name="q4_support4" onclick="JKakemono.czyscpola(); ">
						<option value="">Choisir l'option pose facile</option>
						<option value="tape">Film de pose facile (Tape)</option>
						<option value="Pas de film de pose">Pas de film de pose facile</option>
					</select>
				</li>

				<li class="form-line select" id="id_6">
					<span class="helpButton">
						<img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextmaquette" style="visibility:hidden;"></span>
					</span>
					<select class="form-dropdown validate[required]" id="input_6" name="q6_maquette6" onclick="JKakemono.czyscpola(); ">
            <option value="">fichier d'impression...</option>
						<option value="sansbat">j’ai mon fichier, je ne souhaite pas de BAT</option>
						<option value="user">j’ai mon fichier, je souhaite un BAT</option>
						<option value="config">je crée ma maquette en ligne</option>
            <option value="fb">France banderole crée la mise en page</option>
					</select>
				</li>

				<li class="form-line select" id="id_signature">
          <span class="helpButton"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
						<span class="helpText" id="helpTextsignature" style="visibility:hidden;"></span>
					</span>
					<select class="form-dropdown validate[required] optionsignature" id="input_signature" name="qsignature_signature" onchange="JKakemono.czyscpola(); ">
						<option value="">logo France Banderole ?</option>
						<option value="signature FB">produit signé</option>
						<option value="sans signature">produit neutre +5,00 €</option>
					</select>
				</li>

				<li class="form-line optionsformline2" id="id_7" data-trigger="spinner">
					<label class="form-label-left label-highlight" id="label_7" for="input_7">quantité :<br /><span class="small">(par visuel)</span></label>
					<input type="text" class="form-textbox textboxPush validate[required, Numeric]" id="input_7" name="q7_quantite" size="20" value="1" onclick="JKakemono.czyscpola(); " data-rule="quantity" />
					<div class="spinner-controls">
					 <a href="javascript:;" data-spin="up" onclick="JKakemono.czyscpola();"><i class="fa fa-plus" aria-hidden="true"></i></a>
					 <a href="javascript:;" data-spin="down" onclick="JKakemono.czyscpola();"><i class="fa fa-minus" aria-hidden="true"></i></a>
					</div>
				</li>

				<li class="form-line optionsformline2" id="id_8">
					<label class="form-label-left label-highlight" id="label_8" for="input_8">taille <strong><br /><span class="highlight small">(centimètres)</span></span></strong>:</label>
					<input type="text" class="form-textbox validate[required, Numeric]" placeholder="hauteur" id="input_8" name="q8_taile" size="20" onclick="JKakemono.czyscpola(); " /><span class="cmLeft highlight">CM</span><span class="heusepar">x</span><input type="text" class="form-textbox2 validate[required, Numeric]" placeholder="largeur" id="input_9" name="q9_taile" size="20" onclick="JKakemono.czyscpola(); " /><span class="cmRight highlight">CM</span><span class="cmLeft highlight">CM</span><span class="llar">[hauteur]</span><span class="lhau">[largeur]</span>
				</li>

				<li class="form-line optionsformline" id="id_10">
					<span class="title">OPTIONS DE LIVRAISON <span class="split">DISPONIBLES :</span> </span>

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
							<input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onclick="JKakemono.czyscpola();" />
							<span class="helpButton">
								<span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles.</span>
							</span>
						</span>

						<span class="optionsright">
							<label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label>
							<input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onclick="JKakemono.czyscpola(); JKakemono.relaisColischeckbox();" />
							<span class="helpButton">
								<span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span>
							</span>
						</span>

						<span class="optionsright">
							<label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
							<input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onclick="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
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
						<button id="input_9a" type="submit" class="form-submit-button" style="display: none;">Submit Form</button>
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
	<span id="totalamt_10"></span>
	<span id='estdate_10' class="delivery-date"></span>
</div>

<div id="custom_price_unit" >

</div>


<script type="text/javascript">
	//////////////////////////////////////////////////////////////////////////////
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

  // checkboxes livraison //////////////////////////////////////////////////////
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

	// calcul des jours ouvrés ///////////////////////////////////////////////////
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
			var cena           = 0; 		var cena2   = 0; 		var prixunite=0;
			var rabat          = 0; 		var rabat2  = 0;
			var suma           = 0; 		var suma2   = 0;
			var transport      = 0;
			var designation    = '';
			var cedzik         = '';
			var prliv          = '';
			var date_panier    = '';
			var metraz         = 0;
			var largeur        = 0;
			var hauteur        = 0;
			var option2        = 0;
			var niepokazuj     = 0;
			var eBox           = document.getElementById('form-button-error2');
			eBox.innerHTML    = '';
			var ktorapodstawa = '';
			var tape          = '';
			var ilosc          = $('input_7').value;

			//////////////////////////////////////////////////////////////////////////
			hauteur = ($('input_8').value);
			hauteur = hauteur.replace(',','.');
			hauteur = fixstr(hauteur);
			$('input_8').value = hauteur;

			largeur = ($('input_9').value);
			largeur = largeur.replace(',','.');
			largeur = fixstr(largeur);
			$('input_9').value = largeur;

			metraz = largeur * hauteur;
			metraz = fixstr(metraz);
			//------------------------------------------------------------------------
			if ( ($('input_5').value == 'decoupe simple') ) {
				designation='Sticker mural';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0060;
				cedzik += '<br />- Découpe simple';
			}
			//------------------------------------------------------------------------
			if ( ($('input_5').value == 'decoupe contour') ) {
				designation='Sticker mural';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0075;
				cedzik += '<br />- Découpe contour';
			}
			//------------------------------------------------------------------------
			if ( ($('input_5').value == 'decoupe contour') && ($('input_4').value == 'Pas de film de pose') ) {
				tape = ($('input_4').value);
				cena += metraz*0;
				cedzik += '<br />- Pas de film de pose';
			}
			//------------------------------------------------------------------------
			if ( ($('input_5').value == 'decoupe contour') && ($('input_4').value == 'tape') ) {
				tape = ($('input_4').value);
				cena += metraz*0.0015;
				cedzik += '<br />- Tape';
			}

			////////////////////////////////////////////////////////////// maquette //
			var maquette;
			if ($('input_6').value == 'fb') {
				cena+=19/ilosc;
				maquette = 'France banderole crée la mise en page';
			}
			if ($('input_6').value == 'user') {
				cena+=5/ilosc;
				maquette = 'BAT en ligne';
			}
			if ($('input_6').value == 'config') {
				cena+=5/ilosc;
				maquette = 'je crée ma maquette en ligne';
			}
			if ($('input_6').value == 'sansbat') {
				maquette = 'je ne souhaite pas de BAT';
			}
			///////////////////////////////////////////////////////////// signature //
			if ($('input_signature').value == 'signature FB') {
				cedzik += '<br />- signature France Banderole';
			}
			if ($('input_signature').value == 'sans signature') {
				if ( !$('revendeur') && !$('revendeurRS') ) {cena+= 5/ilosc;}
				cedzik += '<br />- sans signature';
			}

			/////////////////////////////////////////////////////////////// options //
			var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
			if (colis == true) {
				if ( !$('revendeur') && !$('revendeurRC') ) {cena += cena*3/100};
				cedzik += '<br />- colis revendeur';
			}
			var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
			var etiqdesc = '';
			if (etiquette == true) {
				etiqdesc = '<br />- retrait colis a l\'atelier';
				cena-= cena*3/100;
			}
			var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
			if (relais == true) {
				cena += 5/ilosc;
				cedzik += '<br />- relais colis';
			}

			/////////////////////////////////////////////////////////// total produit //
			prixunite = cena;
			var iloscmetrow1=metraz*ilosc;
			iloscmetrow=iloscmetrow1/10000;
			cena=prixunite*ilosc;
			prixunite=fixstr(prixunite);
			cena2 = prixunite.replace(".", ",");

			/////////////////////////////////////////////// affichage jours livraison //
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

				var price_unit = parseFloat(prixunite);
				var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
				var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
				var finalPrice           = calculatedTotalPrice + price_unit;

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
				if(jQuery('#id_10').css('display') != 'none') {
					jQuery('#estdate_10').html('Date de livraison max : '+output+'  <a class="linkUppercase modal-link" href="//www.france-banderole.com/etre-livre-rapidement/" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>');
				}

				var finalPrice1=fixstr(finalPrice);
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
			cena2 = prixunite.replace(".", ",")
			//////////////////////////////////////////////////////////////////////////

			var niepokazuj = 0;

			if (niepokazuj==1) {
				prix.innerHTML='-';
				remise.innerHTML='-';
				total.innerHTML='-';
			}

			//////////////////////////////////////////////// livraison le jour même //
			if ((DeliveryType == '1-1') && (PorductType == '1-1')){
				livraisonrapide.style.display = 'block';
			}
			else {livraisonrapide.style.display = 'none';}

			/////////////////////////////////// avertissements, messages d'erreur //
			if ( (largeur > 130) && (hauteur > 130) ) {
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Hauteur ou Largeur doit être inférieure à 130cm!';
				niepokazuj=1;
			}

			if ( ((largeur < 10) || (hauteur < 10)) ) {
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Hauteur et Largeur doit être supérieur ou égal à 10cm!';
				niepokazuj=1;
			}

			//////////////////////////////////////////////////// envoi formulaire //
			if ((niepokazuj==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){
				suma=cena-rabat;
				suma=fixstr(suma);
				suma2 = suma.replace(".", ",");
				total.innerHTML=suma2+' &euro;';

				var forfait = 29 - suma;
				if (forfait > 0) {
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


				var dodajkoszyk = document.getElementById("cart_form");
				dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Sticker mural" /><input type="hidden" name="opis" value="- '+designation+'<br />- '+$('input_1').value+'<br />- '+maquette+cedzik+etiqdesc+prliv+'<br />- H|'+hauteur+' x L|'+largeur+' cm" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><input type="hidden" name="largeur" value="'+largeur+'" /><input type="hidden" name="hauteur" value="'+hauteur+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button> ';
				livraisonComp.style.display = 'block';
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
