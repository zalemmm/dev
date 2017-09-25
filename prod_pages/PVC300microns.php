<div id="buying">
  <h3>Votre devis en ligne</h3>
  <!-- <a href="http://www.france-banderole.com/enseignes/"><<< Retour enseignes</a> -->
  <form class="jotform-form" action="" method="post" name="form_1060900217" id="1060900217" accept-charset="utf-8" onsubmit="JKakemono.cal_PVC300microns(); return false;">
    <div class="form-all">
      <ul class="form-section">

        <li class="form-line" id="id_1">
          <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir l'impression...</option>
            <option value="recto">Recto </option>
            <option value="rectoverso">Recto/Verso </option>
          </select>
        </li>

        <li class="form-line" id="id_HD">
					<span class="helpButton" onmouseover="pokazt('helpTextHD');" onmouseout="ukryjt('helpTextHD');"><img class="helpImg"  src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png"><span class="helpText" id="helpTextHD" style="visibility:hidden;">• <span class="highlight"><u><b>Impression akilux Haute définition :</b></u></span><br/>impression directe UV HD 1200x1200Dpi. Pour une impression akylux parfaite même de très près.<br />• <span class="highlight"><u><b>Impression akilux standard :</b></u></span><br/>impression directe UV 600x600Dpi. Pour une impression akilux pas cher de très bonne qualité à 1 mètre.<a href="http://www.france-banderole.com/wp-content/uploads/2016/12/impression-HD-panneaux-akylux-pas-cher-big.jpg" title="impression Haute définition panneaux akilux pas cher"><img class="" title="impressio HD panneaux akylux pas cher" alt="panneaux imprimés akilux pas cher" src="http://www.france-banderole.com/wp-content/uploads/2016/12/impression-HD-panneaux-akylux-pas-cher.jpg"></a><br/></span></span>
					<select class="form-dropdown validate[required]" id="input_HD" name="qHD_maquette" onclick="JKakemono.czyscpola(); ">
						<option value="">choisir qualité d'impression...</option>
						<option value="HD">Haute définition</option>
						<option value="standard">Standard</option>
					</select>
				</li>

        <li class="form-line" id="id_2">
          <select class="form-dropdown validate[required]" id="input_2" name="2_usage" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir les fixations...</option>
            <option value="2oeillets">2 oeillets (en haut)</option>
            <option value="4oeillets">4 oeillets</option>
            <option value="sans">pas de fixations</option>
          </select>
        </li>

        <li class="form-line" id="id_3">
          <select class="form-dropdown validate[required]" id="input_3" name="q3_maquette" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir la mise en page...</option>
            <option value="fb">France banderole crée la mise en page</option>
            <option value="user">j’ai déjà crée la maquette </option>
          </select>
        </li>

        <li class="form-line optionsformline2" id="id_4">
          <label class="form-label-left label-highlight" id="label_4" for="input_4">quantité :<br /><span class="small">(par visuel)</span></label>
          <input type="text" class="form-textbox validate[required, Numeric]" id="input_4" name="q4_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); " />
        </li>

        <li id="id_5" class="form-line optionsformline2" style="nothing">
          <label class="form-label-left label-highlight" id="label_5" for="input_5">taille :<span class="highlight small"><br />(Mètres)</span></label>

          <input type="text" class="form-textbox validate[required, Numeric]" placeholder="hauteur" id="input_5" name="q5_taile" size="20" onchange="JKakemono.czyscpola();" />  <span class="mLeft highlight">M</span> <span class="heusepar">x</span><input type="text" class="form-textbox2 validate[required, Numeric]" id="input_6" placeholder="largeur" name="q6_taile" size="20" value="1" onclick="JKakemono.czyscpola();" /><span class="mRight highlight">M</span>
          </li>
        </li>

        <li id="id_7" class="form-line optionsformline">
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
              <input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onchange="JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');">
                <span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles. Vos frais de port seront supprimés de votre devis avant votre paiement.</span>
              </span>
            </span>

            <span class="optionsleft">
              <label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label>
              <input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onchange="JKakemono.relaisColischeckbox(); JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTextrelais');" onmouseout="ukryjt('helpTextrelais');">
                <span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span>
              </span>
            </span>

            <span class="optionsright">
              <label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
              <input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onchange="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
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

      <li class="form-line" id="id_9a">
        <div class="form-input-wide">
          <div id="form-button-error2"></div>
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
      var szerokosc  = 0;
      var wysokosc   = 0;
      var rabat      = 0;     var rabat2 = 0;
      var HD         = 0;
      var p1         = 0;     var p2     = 0;   var fixations = 0;  var maquette = 0; var metrage = 0;
      var eBox       = document.getElementById('form-button-error2');
      eBox.innerHTML = '';
      var ax1        = document.getElementById("id_5");
      var ax2        = document.getElementById("id_6");

      //////////////////////////////////////////////////////////////////////////
    	ilosc = $('input_4').value;
    	szerokosc = ($('input_6').value);
    	szerokosc = szerokosc.replace(',','.');
    	szerokosc = fixstr(szerokosc);
    	$('input_6').value = szerokosc;
    	wysokosc = ($('input_5').value);
    	wysokosc = wysokosc.replace(',','.');
    	wysokosc = fixstr(wysokosc);
    	$('input_5').value = wysokosc;

    	/////////////////////////////////////////////////////////////// métrage //
    	metrage = szerokosc*wysokosc*ilosc

    	/////////////////////////////////////////////////////////////// PVC 300µ//
    	if ($('input_1').value == 'recto'){
    		if (metrage<=3){p1=17*metrage;}
    		if ((metrage > 3) && (metrage <= 5)){p1=15*metrage;}
    		if ((metrage > 5) && (metrage <= 8)){p1=14*metrage;}
    		if ((metrage > 8) && (metrage <= 12)){p1=13*metrage;}
    		if ((metrage > 12) && (metrage <= 20)){p1=12*metrage;}
    		if (20<metrage){p1=11*metrage;}
    		opis += '<br />- PVC 300µ recto';
    	}

    	if ($('input_1').value == 'rectoverso'){
    		if (metrage<=3){p1=(17+(17*0.3))*metrage;}////// +30% /////
    		if ((metrage > 3) && (metrage <= 5)){p1=(15+(15*0.3))*metrage;}//// +30% /////
    		if ((metrage > 5) && (metrage <= 8)){p1=(14+(14*0.3))*metrage;}//// +30% /////
    		if ((metrage > 8) && (metrage <= 12)){p1=(13+(13*0.3))*metrage;}/// +30% /////
    		if ((metrage > 12) && (metrage <= 20)){p1=(12+(12*0.3))*metrage;}// +30% /////
    		if(20<metrage){p1=(11+(11*0.3))*metrage;}////// +30% /////
    		opis += '<br />- PVC 300µ recto/verso';
    	}

    	////////////////////////////////////////////////////////////// fixations//
    	if ($('input_2').value == '2oeillets'){fixations=1*ilosc; opis += '<br />- 2 oeillets';}
    	if ($('input_2').value == '4oeillets'){fixations=2*ilosc; opis += '<br />- 4 oeillets';}
    	if ($('input_2').value == 'sans'){fixations=0; opis += '<br />- sans oeillet';}

    	////////////////////////////////////////////////////////////// maquette //
    	if ($('input_3').value == 'fb') {maquette=29; opis += '<br />- France banderole crée la maquette';}
    	if ($('input_3').value == 'user') {maquette=0; opis += '<br />- j’ai déjà crée la maquette';}

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
        cena += 2.00;
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
        cenapojedyncza += 5.00;
        cena += 5.00;
        cedzik += '<br />- relais colis';
      }

      ///////////////////////////////////////////////////////////// transport //
      poidstotal = metrage*0.4;
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


    	puoption2=fixstr(puoption2);
    	cena2 = puoption2.replace(".", ",");
    	var prix = document.getElementById("prix_unitaire");
    	prix.innerHTML=cena2+' &euro;';

      cenapojedyncza = cena;

			ilosc=$('input_4').value;
			if ($('input_4').value) {
				cena=cenapojedyncza*ilosc;
			}

			var total = document.getElementById("total");
			var remise = document.getElementById("remise");

			cenapojedyncza=fixstr(cenapojedyncza);
			cena2 = cenapojedyncza.replace(".", ",");

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

				var price_unit = parseFloat(cenapojedyncza);

				//var str = price_unit;
				//var totalPrice           = parseFloat(str.replace(',','.').replace(' ','').replace('&euro;',''));
				var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
				var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
				var finalPrice           = (calculatedTotalPrice + price_unit)/ilosc;

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

				finalPrice1=fixstr(finalPrice);
				finalPrice2 = finalPrice1.replace(".", ",");

				jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
				jQuery('#remise').html(rabat2);
			}

			cenapojedyncza = finalPrice1;

			ilosc=$('input_4').value;
			if ($('input_4').value) {
				cena=cenapojedyncza*ilosc;
			}

			if (ilosc.empty()){
				eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Merci de spécifier une quantité et une taille en centimètres';
				eBox.style.display="block";
			}

			var total = document.getElementById("total");
			var remise = document.getElementById("remise");

			cenapojedyncza=fixstr(cenapojedyncza);
			cena2 = cenapojedyncza.replace(".", ",")

			/* koszty transportu */

			transport=0;

			var niepokazuj = 0;
			if (ilosc==''){niepokazuj=1;}
			if (niepokazuj==1) {
				prix.innerHTML='-';
				remise.innerHTML='-';
				total.innerHTML='-';
				finalPrice='0';
				var forfait = 0 ;
			}

			///////////livraison le jour même////////
			if ((DeliveryType == '1-1') && (PorductType == '1-1')){
				livraisonrapide.style.display = 'block';
			}
			else {livraisonrapide.style.display = 'none';}
			/////////////////////////////////////////

      if ((niepokazuj==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){

      	suma=cena;
      	suma=fixstr(suma);
      	suma2 = suma.replace(".", ",");
      	var total = document.getElementById("total");
      	total.innerHTML=suma2+' &euro;';

      	var forfait = 29 - suma;
      	if (forfait > 0){

      		forfait = fixstr(forfait);
      		eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button>FORFAIT '+forfait+' &euro;<br />';
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



        ///////////////////////////////// avertissements, messages d'erreur //
        if ( (wysokosc > 1.4) || (szerokosc > 1.4) ) {
          eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Attention nos panneaux font au maximum 160x120cm!';
          eBox.style.display="block";
          niepokazuj=1;
        }

        if ( (wysokosc > 1) && (szerokosc > 1) ) {
          eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Attention nos panneaux font au maximum 160x120cm!';
          eBox.style.display="block";
          niepokazuj=1;
        }
        
        if ( (wysokosc < 0.2) || (szerokosc < 0.2) ) {
          eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Vos dimensions doivent être supérieures à 0,2x0,3m !';
          eBox.style.display="block";
          niepokazuj=1;
        }

        if ( (wysokosc < 0.3) && (szerokosc < 0.3) ) {
          eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button><img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Vos dimensions doivent être supérieures à 0,2x0,3m !';
          eBox.style.display="block";
          niepokazuj=1;
        }

        ////////////////////////////////////////////////// envoi formulaire //
      	var rodzaj = "PVC 300 microns";
      	var dodajkoszyk = document.getElementById("cart_form");
      	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'</br>- '+szerokosc+' x '+wysokosc+'m'+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant</button> ';

      }
    });
  });
  </script>
