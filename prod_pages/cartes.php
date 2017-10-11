<div id="buying">
  <h3>Votre devis en ligne</h3>
  <form class="jotform-form" action="" method="post" name="form_1060900221" id="1060900221" accept-charset="utf-8" onsubmit="JKakemono.cal_cartes();
  return false;">
  <input type="hidden" name="formID" value="1060900221" />
  <div class="form-all">
    <ul class="form-section">
      <li class="form-line" id="id_1">

        <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="getElementById('preview_info_ul').innerHTML = '';JKakemono.czyscpola();">
          <option value="">choisir l'épaisseur...</option>
          <option value="Cartes 350g">350g</option>
          <option value="Cartes 270µ">Indéchirable 270µ</option>
          <option value="Cartes 350µ">Indéchirable 350µ</option>
        </select>
      </li>

      <li class="form-line" id="id_21">

        <select class="form-dropdown validate[required]" id="input_21" name="q21_usage" onchange="getElementById('preview_info_ul').innerHTML = '';JKakemono.czyscpola();">
          <option value="">choisir le format...</option>
          <option value="1">Recto (85 mm x 54 mm) </option>
          <option value="2">Recto/Verso (85 mm x 54 mm) </option>
        </select>
      </li>

      <li class="form-line" id="id_22">

        <select class="form-dropdown validate[required]" id="input_22" name="q22_usage" onchange="getElementById('preview_info_ul').innerHTML = '';JKakemono.czyscpola();">
          <option value="">choisir le format...</option>
          <option value="1">Recto (85 mm x 54 mm) </option>
          <option value="2">Recto/Verso (85 mm x 54 mm) </option>
        </select>
      </li>

      <li class="form-line" id="id_23">

        <select class="form-dropdown validate[required]" id="input_23" name="q23_usage" onchange="getElementById('preview_info_ul').innerHTML = '';JKakemono.czyscpola();">
          <option value="">choisir le format...</option>
          <option value="1">Recto (85 mm x 54 mm) </option>
          <option value="2">Recto/Verso (85 mm x 54 mm) </option>
        </select>
      </li>

      <li class="form-line" id="id_3">

        <select class="form-dropdown validate[required]" id="input_3" name="q3_usage" onchange="getElementById('preview_info_ul').innerHTML = '';JKakemono.czyscpola();">
          <option value="">choisir le type de papier...</option>
          <option value="1">Couché Brillant </option>
          <option value="2">Couché Satiné</option>
          <option value="3">Couché Mat</option>
        </select>
      </li>

      <li class="form-line" id="id_4">

				<span class="helpButton" onmouseover="pokazt('helpTextmaquette');" onmouseout="ukryjt('helpTextmaquette');">
					<img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
					<span class="helpText" id="helpTextmaquette" style="visibility:hidden;">
						<b>France banderole crée votre fichier :</b><br/>
						Vous fournissez<span class="highlight"><b> de 1 à 6 éléments séparés</b></span> et un explicatif sur votre souhait. Notre équipe d'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.<br/>
						<b>Vous avez déjà crée la mise en page:</b><br/>Vous envoyez votre propre fichier PDF (une fois votre devis enregistré). Ce dernier sera vérifié gratuitement par notre service d'infographie et, un <span class="highlight"><b>BAT gratuit à valider</b></span> vous sera transmis dans votre accès client.<br/>
						<b>Vous créez votre maquette en ligne:</b><br/>
						Dans le détail de votre commande vous aurez accès à notre outil de personnalisation en ligne. Simple et axé sur les fonctionnalités essentielles, il vous permettra de composer en quelques clics une maquette aux bonnes dimensions avec vos éléments personnels (logos, images...), du texte et un large choix de polices, couleurs, formes.<br />
					</span>
				</span>
				<select class="form-dropdown validate[required]" id="input_4" name="q4_maquette41" onchange="JKakemono.czyscpola();">
					<option value="">fichier d'impression...</option>
					<option value="fb">France banderole crée la maquette</option>
					<option value="user">j’ai déjà crée la maquette </option>
					<option value="config">je crée ma maquette en ligne</option>
				</select>
			</li>

      <li class="form-line" id="id_5">

        <select class="form-dropdown quan validate[required]" id="input_5" name="q5_maquette5" onchange="JKakemono.czyscpola();">
          <option value="">quantité...</option>
          <option value="100">100 </option>
          <option value="250">250 </option>
          <option value="500">500 </option>
          <option value="1000">1000 </option>
          <option value="2500">2500 </option>
          <option value="5000">5000 </option>
        </select>
      </li>

      <li class="form-line optionsformline" id="id_101">
				<span class="title">OPTIONS DE LIVRAISON <span class="splitorhide">DISPONIBLES :</span> </span>

				<span class="options_single">

					<span class="optionsleft">
						<label class="form-label-left" id="label_adresse" for="adresse">Livré à l'adresse de votre choix</label>
						<input type="checkbox" class="form-checkbox" id="adresse" name="adresse[]" checked />
						<span class="helpButton" onmouseover="pokazt('helpTextAdresse');" onmouseout="ukryjt('helpTextAdresse');">
							<span class="helpText" id="helpTextAdresse" style="visibility:hidden;">Pour être livré directement chez vous ou à votre adresse professionnelle. Par défaut votre adresse de facturation sera utilisée, mais vous pourrez spécifier une adresse de livraison dans votre accès client. </span>
						</span>
					</span>

					<span class="optionsleft">
						<label class="form-label-left" id="label_etiquette" for="etiquette">Retrait colis à l'Atelier</label>
						<input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onclick="JKakemono.czyscpola();" />
						<span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');">
							<span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles.</span>
						</span>
					</span>

					<span class="optionsright">
						<label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label>
						<input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onclick="JKakemono.czyscpola(); JKakemono.relaisColischeckbox();" />
						<span class="helpButton" onmouseover="pokazt('helpTextrelais');" onmouseout="ukryjt('helpTextrelais');">
							<span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span>
						</span>
					</span>

					<span class="optionsright">
						<label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
						<input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onclick="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
						<span class="helpButton" onmouseover="pokazt('helpTextcolis');" onmouseout="ukryjt('helpTextcolis');">
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

      <li class="form-line" id="id_26a">
				<div class="form-input-wide">
					<div id="form-button-error2"></div>
					<button id="input_26" type="submit" class="form-submit-button" style="display: none;">Submit Form</button>
				</div>
			</li>

      <li style="display:none">
        Should be Empty:
        <input type="text" name="website" value="" />
      </li>

    </ul>
  </div>

  <input type="hidden" id="simple_spc" name="simple_spc" value="1060900221" />

  <script type="text/javascript"> document.getElementById("simple_spc").value += "-1060900221";</script>
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


<script>
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
  	////////////////////////////////////////////////////////////////////////////
  	jQuery('.delivery , .production').click(function(){
      var cena       = 0; var cena2=0; var cena1=0; var cenar=0; var cenarv=0;
      var suma       = 0; var suma2=0;
      var prixunite  = 0;
      var rabat      = 0;     var rabat2 = 0;
      var prliv      = '';
      var transport  = 0;
      var ilosc      = $('input_5').value;
      var opis       = '';
      var niepokazuj = 0;
      var option2    = 0;
      var largeur    = 85;
      var hauteur    = 54;
      var eBox       = document.getElementById('form-button-error2');
      eBox.innerHTML = '';

      //////////////////////////////////////////////////////////////////////////////
      if ($('input_1').value == 'Cartes 350g') {
        if ($('input_21').value == '1'){ opis += '- Recto (85 mm x 54 mm)';}
        if ($('input_21').value == '2'){ opis += '- Recto/verso (85 mm x 54 mm)';}
        if (($('input_21').value == '1') || ($('input_21').value == '2'))  {

          cenar=1.11
          cenarv=1.26
          if ($('input_21').value == '1'){ cena1=(ilosc/25)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
          if ($('input_21').value == '2'){ cena1=(ilosc/25)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
          if (ilosc == '100'){ cena1*=1.8;}
          if (ilosc == '250'){ cena1*=1.6;}
          if (ilosc == '500'){ cena1*=1.4;}
          if (ilosc == '1000'){ cena1*=1.2;}
          if (ilosc == '2500'){ cena1*=1;}
          if (ilosc == '5000'){ cena1*=0.95;}
        }
      }

      //////////////////////////////////////////////////////////////////////////////
      if ($('input_1').value == 'Cartes 270µ') {
        if ($('input_22').value == '1'){ opis += '- Recto (85 mm x 54 mm)';}
        if ($('input_22').value == '2'){ opis += '- Recto/verso (85 mm x 54 mm)';}
        if (($('input_22').value == '1') || ($('input_22').value == '2'))  {

          cenar=6.76
          cenarv=7.70
          if ($('input_22').value == '1'){ cena=(ilosc/20)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
          if ($('input_22').value == '2'){ cena=(ilosc/20)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
          if (ilosc == '100'){ cena*=1.8;}
          if (ilosc == '250'){ cena*=1.6;}
          if (ilosc == '500'){ cena*=1.4;}
          if (ilosc == '1000'){ cena*=1.2;}
          if (ilosc == '2500'){ cena*=1;}
          if (ilosc == '5000'){ cena*=0.95;}

        }
      }

      //////////////////////////////////////////////////////////////////////////////
      if ($('input_1').value == 'Cartes 350µ') {
        if ($('input_23').value == '1'){ opis += '- Recto (85 mm x 54 mm)';}
        if ($('input_23').value == '2'){ opis += '- Recto/verso (85 mm x 54 mm)';}
        if (($('input_23').value == '1') || ($('input_23').value == '2'))  {

          cenar=9.46
          cenarv=9.56
          if ($('input_23').value == '1'){ cena=(ilosc/20)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
          if ($('input_23').value == '2'){ cena=(ilosc/20)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
          if (ilosc == '100'){ cena*=1.8;}
          if (ilosc == '250'){ cena*=1.6;}
          if (ilosc == '500'){ cena*=1.4;}
          if (ilosc == '1000'){ cena*=1.2;}
          if (ilosc == '2500'){ cena*=1;}
          if (ilosc == '5000'){ cena*=0.95;}
        }
      }

      ////////////////////////////////////////////////////////////// choix papier //
      if ($('input_3').value == '1') {cena=cena1;
      opis += '<br />- couché brillant';
      }
      if ($('input_3').value == '2') {cena=cena1*1.04;
      opis += '<br />- satiné';
      }
      if ($('input_3').value == '3') {cena=cena1*1.08;
      opis += '<br />- couché mat';
      }
      opis += '<br />- '+ilosc+' Cartes';

      ///////////////////////////////////////////////// prix transport / quantité //

      if (ilosc == '100') {transport=7.9;}
      if (ilosc == '250') {transport=7.9;}
      if (ilosc == '500') {transport=7.9;}
      if (ilosc == '1000') {transport=7.9;}
      if (ilosc == '2500') {transport=8.9;}
      if (ilosc == '5000') {transport=10.9;}

      /////////////////////////////////////////////////// choix création maquette //
      var ktodaje;

      if ($('input_4').value == 'fb') {
        cena+=29;
        ktodaje = 'France banderole crée la maquette';
      }
      var ktodaje;
      if ($('input_4').value == 'user') {
        ktodaje = 'j’ai déjà crée la maquette';
      }
      var ktodaje;
      if ($('input_4').value == 'config') {
        cena+=5;
        ktodaje = 'je crée ma maquette en ligne';
      }
      
      opis += '<br />- '+ktodaje;

      /////////////////////////////////////////////////////////////////// options //

      var economique = $$('#economique').collect(function(e){ return e.checked; }).any();
      if (economique == true) {
        cena *= 0.70;
        opis += '<br />- Délai économique';
      }

      var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
      if (relais == true) {
        cena += 5.00;
        opis += '<br />- relais colis';
      }
      var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
      if (colis == true) {
        opis += '<br />- colis revendeur';
      }

      var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
      var etiqdesc = '';
      if (etiquette == true) {
        transport=0;
        opis += '<br />- retrait colis a l\'atelier';
      }

      //////////////////////////////////////////////////////////////////////////////

      prixunite = cena;

			var total = document.getElementById("total");
			var remise = document.getElementById("remise");

			prixunite=fixstr(prixunite);
			cena2 = prixunite.replace(".", ",");

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
					ProdPercent = 15;
					prliv += '<br />- P 2-3J';
				}else if(PorductType =='1-1'){
					ProdPercent = 40;
					prliv += '<br />- P 1J';
				}else{
					ProdPercent = 0;
					prliv += '<br />- P 4-5J';
				}

				if(DeliveryType == '2-3'){
					DeliPercent = 15;
					prliv += ' / L 2-3J';
				}else if(DeliveryType =='1-1'){
					DeliPercent = 40;
					prliv += ' / L 1J';
				}else{
					DeliPercent = 0;
					prliv += ' / L 3-4J';
				}

				var price_unit = parseFloat(prixunite);

				//var str = price_unit;
				//var totalPrice           = parseFloat(str.replace(',','.').replace(' ','').replace('&euro;',''));
				var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
				var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
				var finalPrice           = calculatedTotalPrice + price_unit;

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
					jQuery('#estdate_8').html('Date de livraison max : '+output+'  <a class="linkUppercase modal-link" href="http://www.france-banderole.com/etre-livre-rapidement/" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>');
				}

				var finalPrice1=fixstr(finalPrice);
				finalPrice2 = finalPrice1.replace(".", ",");

				jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
				jQuery('#remise').html(rabat2);
			}

			prixunite = finalPrice1;

			var niepokazuj = 0;

			if (niepokazuj==1) {
				prix.innerHTML='-';
				remise.innerHTML='-';
				total.innerHTML='-';
			}

			// livraison le jour même //
			if ((DeliveryType == '1-1') && (PorductType == '1-1')){
				livraisonrapide.style.display = 'block';
			}
			else {livraisonrapide.style.display = 'none';}


			//////////////////////////////////////////////////////////////////////////

			if ((niepokazuj==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){

      suma=prixunite;
			suma=fixstr(suma);
			suma2 = suma.replace(".", ",");

			total.innerHTML=suma2+' &euro;';


      var forfait = 15 - suma;
      if (forfait > 0) {
        forfait = fixstr(forfait);
        eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button>FORFAIT '+forfait+' &euro;<br />';
        var newoption = parseFloat(forfait);
        newoption=fixstr(newoption);
        newoption2 = newoption.replace(".", ",");
        option2 = newoption2;
        var newopt = document.getElementById("option");
        newopt.innerHTML=newoption2+' &euro;';
        suma = 15;
        suma=fixstr(suma);
        suma2 = suma.replace(".", ",");
        var newtotal = document.getElementById("total");
        newtotal.innerHTML=suma2+' &euro;';
      }


      var rodzaj = $('input_1').value;

      var dodajkoszyk = document.getElementById("cart_form");
      dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+prliv+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur+'" /><input type="hidden" name="largeur" value="'+largeur+'" /><button id="submit_cart" type="submit">Suivant <i class="fa fa-caret-right" aria-hidden="true"></i></button> ';
    }
  });
});
</script>
