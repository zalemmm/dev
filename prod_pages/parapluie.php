<div id="buying">
  <h3>Votre devis en ligne :</h3>
  <form class="jotform-form" action="" method="post" name="form_1060900217" id="1060900217" accept-charset="utf-8" onsubmit="JKakemono.cal_parapluie(); return false;">
    <input type="hidden" name="formID" value="1060900217" />
    <div class="form-all">
      <ul class="form-section">

        <li class="form-line" id="id_0">
          <select class="form-dropdown validate[required]" id="input_0" name="q0_usage" onchange="getElementById('preview_info_ul').innerHTML=''; JKakemono.czyscpola(); ">
            <option value="">choisir le type</option>
            <option value="Tissu">Stand Tissu Easy Quick</option>
            <option value="Stand ExpoBag">Stand Expo’Bag</option>
            <option value="Stand parapluie">Stand Parapluie Révolution avec Kit (valise + tablette + spot)</option>
          </select>
        </li>

        <li class="form-line" id="id_1">
          <select class="form-dropdown validate[required]" id="input_1" name="q1_option" onchange="getElementById('preview_info_ul').innerHTML=''; JKakemono.czyscpola(); ">
           <option value="">choisir les dimensions... </option>
            <optgroup label="Courbé avec kit complet*">
              <option value="1">Recto 3x2 </option>
              <option value="2">Recto 3x3 </option>
              <option value="3">Recto 3x4 </option>
              <option value="4">Recto Verso 3x3 </option>
              <option value="5">Recto Verso 3x4 </option>
            </optgroup>
            <optgroup label="Droit avec kit complet*">
              <option value="6">Recto 3x2 </option>
              <option value="7">Recto 3x3 </option>
              <option value="8">Recto 3x4 </option>
              <option value="9">Recto Verso 3x3 </option>
              <option value="10">Recto Verso 3x4 </option>
            </optgroup>
            <optgroup label="*(Valise comptoir imprimée et tablette + 2 spots)">
            </optgroup>
          </select>
        </li>

        <li class="form-line" id="id_2">
          <select class="form-dropdown validate[required]" id="input_2" name="q2_option" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir l'option... </option>
            <option value="1">2 spots hallogène 35w aluminium </option>
            <option value="0">non merci </option>
          </select>
        </li>

        <li class="form-line" id="id_50">
          <select class="form-dropdown validate[required]" id="input_50" name="q50_option" onChange="JKakemono.czyscpola(); ">
            <option value="">choisir les dimensions... </option>
            <optgroup label="Recto Avec Retour">
              <option value="1">Recto Avec Retour 3x1 </option>
              <option value="2">Recto Avec Retour 3x2 </option>
              <option value="3">Recto Avec Retour 3x3 </option>
              <option value="4">Recto Avec Retour 3x4 </option>
              <option value="5">Recto Avec Retour 3x5 </option>
            </optgroup>
            <optgroup label="Recto Verso">
              <option value="6">Recto Verso 3x1 </option>
              <option value="7">Recto Verso 3x2 </option>
              <option value="8">Recto Verso 3x3 </option>
              <option value="9">Recto Verso 3x4 </option>
              <option value="10">Recto Verso 3x5 </option>
            </optgroup>
          </select>
        </li>

        <li class="form-line" id="id_51">
          <select class="form-dropdown validate[required]" id="input_51" name="q51_option" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir l'option... </option>
            <option value="1">2 spots hallogène 150w noir </option>
            <option value="0">non merci </option>
          </select>
        </li>

        <li class="form-line" id="id_6">
          <select class="form-dropdown validate[required]" id="input_6" name="q6_option6" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir l'option... </option>
            <option value="41">Valise de transport / Comptoir accueil </option>
            <option value="0">non merci </option>
          </select>
        </li>

        <li class="form-line" id="id_7">
          <select class="form-dropdown validate[required]" id="input_7" name="q7_maquette7" onchange="JKakemono.czyscpola(); ">
            <option value="">choisir la mise en page... </option>
            <option value="fb">France banderole crée la maquette </option>
            <option value="user">j’ai déjà crée la maquette </option>
          </select>
        </li>

        <li class="form-line" id="id_8">
          <label class="form-label-left label-highlight" id="label_8" for="input_8">quantité :</label>
          <input type="text" class="form-textbox validate[required, Numeric]" id="input_8" name="q8_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); " />
        </li>

       <li id="id_16" class="form-line optionsformline">
               <span class="title">OPTIONS DE LIVRAISON DISPONIBLES :</span>

				<span class="options_single">
          <span class="optionsleft">
            <label class="form-label-left" id="label_adresse" for="adresse">Livré à l'adresse de votre choix</label>
            <input type="checkbox" class="form-checkbox" id="adresse" name="adresse[]" checked />
            <span class="helpButton" onmouseover="pokazt('helpTextAdresse');" onmouseout="ukryjt('helpTextAdresse');">
              <span class="helpText" id="helpTextAdresse" style="visibility:hidden;">Pour être livré directement chez vous ou à votre adresse professionnelle. Par défaut votre adresse de facturation sera utilisée, mais vous pourrez spécifier une adresse de livraison dans votre accès client. </span>
            </span>
          </span>

					<span class="optionsleft">
            <label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L'Atelier</label>
            <input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onclick="JKakemono.czyscpola(); JKakemono.relaisColischeckbox();" />
            <span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');">
              <span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles.</span>
            </span>
          </span>

          <span class="optionsleft">
            <label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label>
            <input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onclick="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " />
            <span class="helpButton" onmouseover="pokazt('helpTextcolis');" onmouseout="ukryjt('helpTextcolis');">
              <span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span>
            </span>
          </span>


				</span>
        <div class="nothing" />

<p id="production" >
	<h5>Delai Production:</h5>
	<button class="production" text-value="4-5" id="p1"></button>
	<button class="production" text-value="2-3" id="p2"></button>
    <button class="production" text-value="1-1" id="p3"></button>
	<input type="hidden" id="production-value" value=""  onClick="" />
</p>
<div id="delivery-div" style='display:none;'>

<p id="delivery" >
	<h5>Delai Livraison:</h5>
	<button class="delivery" text-value="3-4" id="l1"></button>
	<button class="delivery" text-value="2-3" id="l2"></button>
    <button class="delivery" text-value="1-1" id="l3" style="display: none; float:right"></button>
	<input type="hidden" id="delivery-value" value="" />
</p>

<p>
<!--<span id="totaldays"></span>&nbsp;-->
<span id="totalamt_16"></span>
<span id='estdate_16'></span>
</p>
</div>
            </li>




            <li id="id_18" class="form-line id_18" style="top:14px">
                <div class="form-input-wide">
                <div id="form-button-error2"></div>
                        <button id="input_18" type="submit" class="form-submit-button" style="display: none;">Submit Form</button>
                </div>
            </li>
            <li style="display:none">
                Should be Empty:
                <input type="text" name="website" value="" />
            </li>
        </ul>
    </div>
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
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/parapluie/slide/test-1.jpg" alt="commencez votre devis en ligne" /></li>
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/parapluie/slide/test-2.jpg" alt="commencez votre devis en ligne" /></li>
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/parapluie/slide/test-3.jpg" alt="commencez votre devis en ligne" /></li>
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/banderole/slide/test-3.png" alt="commencez votre devis en ligne" /></li>
    </div>
  </div>

  <div id="preview_imag"></div>
  <div id="preview_imag2"></div>
  <div id="preview_imag3"></div>
  <div id="preview_imag4"></div>
  <div id="preview_imag5"></div>

</div>

<div id="custom_price_unit" >

</div>
<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>

<script type="text/javascript">
  // checkboxes livraison
  jQuery('#adresse').click(function() {
    if (document.getElementById('adresse').checked) {
      document.getElementById('etiquette').checked = false;
    }
  });

  jQuery('#etiquette').click(function() {
    if (document.getElementById('etiquette').checked) {
      document.getElementById('adresse').checked = false;
    }
  });

</script>

<script type="text/javascript">
/* Voici la fonction javascript qui change la propriété "display"
pour afficher ou non le div selon que ce soit "none" ou "block". */

function Afficher()
{
divInfo = document.getElementById('delivery-div');

if (divInfo.style.display == 'none')
divInfo.style.display = 'block';


}
</script>


<script type="text/javascript">
/* Voici la fonction javascript qui change la propriété "display"
pour afficher ou non le div selon que ce soit "none" ou "block". */

function Afficher2()
{
	divInfo = document.getElementById('l3');
	if (divInfo.style.display == 'none')
	divInfo.style.display = 'block';
}
</script>


<script type="text/javascript">
/* Voici la fonction javascript qui change la propriété "display"
pour afficher ou non le div selon que ce soit "none" ou "block". */

function Masquer2()
{
	divInfo = document.getElementById('l3');
	if (divInfo.style.display == 'block')
	divInfo.style.display = 'none';
}
</script>


<script type="text/javascript">
/* Voici la fonction javascript qui change la propriété "display"
pour afficher ou non le div selon que ce soit "none" ou "block". */

function Masquer()
{
divInfo = document.getElementById('delivery-div');

if (divInfo.style.display == 'block')
divInfo.style.display = 'none';


}
</script>

<script type="text/javascript">

function AddBusinessDays(weekDaysToAdd) {
		//alert(weekDaysToAdd);
      var curdate = new Date();
      var realDaysToAdd = 0;
      for(i=0; i<weekDaysToAdd; i++){
        curdate.setDate(curdate.getDate()+1);
		var estdt1 = new Date(curdate);
		//alert('date->'+estdt1);
		var n = curdate.getDay();
		//alert(n);
        if (n == '6' || n == '0') {
          weekDaysToAdd++;
        }
        realDaysToAdd++;
        //check if current day is business day
      }
	  	//alert(realDaysToAdd);

      return realDaysToAdd;

    }

	jQuery(document).ready(function(){

		jQuery('.delivery , .production').click(function(){

var cena=0; var cena2=0;
var rabat=0; var rabat2=0;
var suma=0; var suma2=0;
var transport=0;
var ktorytyp='';
var cedzik='';
var dodatkowaopcja='';
var prliv='';
var date_panier='';
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';

if ( ($('input_0').value) && ((($('input_2').value) && ($('input_7').value) && ($('input_8').value)) || (($('input_1').value) && ($('input_7').value) && ($('input_8').value)) || (($('input_50').value) && ($('input_51').value) && ($('input_6').value) && ($('input_7').value) && ($('input_8').value))) ) {
  if ($('input_0').value == 'Tissu') {
	transport = 49;
	if ($('input_50').value == '1' ) {
		cena = 439;
		dodatkowaopcja += '<br />- Recto simple 3x1';
	}
	if ($('input_50').value == '2' ) {
		cena = 529;
		dodatkowaopcja += '<br />- Recto simple 3x2';
	}
	if ($('input_50').value == '3' ) {
		cena = 599;
		dodatkowaopcja += '<br />- Recto simple 3x3';
	}
	if ($('input_50').value == '4' ) {
		cena = 774;
		dodatkowaopcja += '<br />- Recto simple 3x4';
	}
	if ($('input_50').value == '5' ) {
		cena = 969;
		dodatkowaopcja += '<br />- Dimensions 3x5';
	}
	if ($('input_50').value == '6' ) {
		cena = 609;
		dodatkowaopcja += '<br />- Recto Verso 3x1';
	}
	if ($('input_50').value == '7' ) {
		cena = 794;
		dodatkowaopcja += '<br />- Recto Verso 3x2';
	}
	if ($('input_50').value == '8' ) {
		cena = 979;
		dodatkowaopcja += '<br />- Recto Verso 3x3';
	}
	if ($('input_50').value == '9' ) {
		cena = 1224;
		dodatkowaopcja += '<br />- Recto Verso 3x4';
	}
	if ($('input_50').value == '10' ) {
		cena = 1504;
		dodatkowaopcja += '<br />- Recto Verso 3x5';
	}
	if ($('input_51').value == '1' ) {
		cena += 66;
		dodatkowaopcja += '<br />- 2 spots hallogène 150w';
	}
	if ($('input_51').value == '0' ) {
		dodatkowaopcja += '<br />- non merci';
	}

 	if ($('input_6').value == '41' ) {
		cena += 299;
		transport += 18;
		dodatkowaopcja += '<br />- Valise de transport / Comptoir accueil';
	}
	if ($('input_6').value == '0' ) {
		dodatkowaopcja += '<br />- non merci';
	}

	var ktodaje;
	if ($('input_7').value == 'fb') {
		cena+=40;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_7').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
}




////
 if ($('input_0').value == 'Stand ExpoBag') {
	cena = 649;
	transport = 29;
	if ($('input_2').value == '1' ) {
		cena = cena+80;
		dodatkowaopcja += '<br />- 2 spots hallogene 35w aluminium';
	}
	/*var ktodaje;
	if ($('input_7').value == 'fb') {
		cena+=40;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_7').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}*/



 }
////
var cenapojedyncza = cena;

	ilosc=$('input_8').value;


if ($('input_0').value == 'Stand parapluie') {


	if ($('input_1').value == '1' ) {
		cena = 597.6;
		dodatkowaopcja += '<br />- 3x2-courbé recto<br />- 2225(h)x1600(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '2' ) {
		cena = 655.7;
		dodatkowaopcja += '<br />- 3x3-courbé recto<br />- 2225(h)x2520(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '3' ) {
		cena = 730.4;
		dodatkowaopcja += '<br />- 3x4-courbé recto<br />- 2225(h)x3010(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '4' ) {
		cena = 796.8;
		dodatkowaopcja += '<br />- 3x3-courbé recto verso<br />- 2225(h)x2520(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '5' ) {
		cena = 929.6;
		dodatkowaopcja += '<br />- 3x4-courbé recto verso<br />- 2225(h)x3010(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	///////

	if ($('input_1').value == '6' ) {
		cena = 597.6;
		dodatkowaopcja += '<br />- 3x2-droit recto<br />- 2225(h)x1513(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '7' ) {
		cena = 655.7;
		dodatkowaopcja += '<br />- 3x3-droit recto<br />- 2225(h)x2243(l) <br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '8' ) {
		cena = 730.4;
		dodatkowaopcja += '<br />- 3x4-droit recto<br />- 2225(h)x2973(l) <br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '9' ) {
		cena = 796.8;
		dodatkowaopcja += '<br />- 3x3-droit recto verso<br />- 2225(h)x2243(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}

	if ($('input_1').value == '10' ) {
		cena = 929.6;
		dodatkowaopcja += '<br />- 3x4-droit recto verso<br />- 2225(h)x2973(l)<br />- la valise comptoir imprimée et sa tablette<br />- 2 spots halogène 150w';
	}


}

if ($('input_0').value == 'Stand ExpoBag') {javascript: Afficher2();}
if ($('input_0').value == 'Tissu') {javascript: Masquer2();}
if ($('input_0').value == 'Stand parapluie') {javascript: Masquer2();}



	var ktodaje;
	if ($('input_7').value == 'fb') {
		cena+=40;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_7').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}

						//////////

						var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
						var etiqdesc = '';
						if (etiquette == true) {
							transport=0;
							etiqdesc = '<br />- retrait colis a l\'atelier';
							cena-= cena*3/100;
						}
						if (etiquette == false) {
							transport=0;
							cena+= 29.00;
						}

						///////////
						var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
						if (colis == true) {
								cena += 5.00;
								cedzik += '<br />- colis revendeur';
						}


 }

	var cenapojedyncza = cena;

		ilosc=$('input_8').value;
			if ($('input_8').value) {
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


					});});


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

						});});


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

							});});
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
							var daystoadd = AddBusinessDays(days);
							curdate.setDate(curdate.getDate()+daystoadd);
							var estdt = new Date(curdate);
							var month = estdt.getMonth()+1;
							var day = estdt.getDate();
							var output = day + '/' + (month<10 ? '0' : '') + month + '/' + (day<10 ? '' : '') + estdt.getFullYear();
							//jQuery('#custom_price_unit').html('<div id="wycena_nag"><span class="wycena_poz">PRIX UNITAIRE</span><span class="wycena_poz">OPTION</span><span class="wycena_poz">REMISE</span><span class="wycena_poz">TOTAL H.T.</span></div><div id="wycena_suma"><span class="wycena_poz prix_class" id="prix_unitaire">'+finalPrice+'</span><span class="wycena_poz" id="option">-</span><span class="wycena_poz" id="remise">-</span><span class="wycena_poz" id="total">-</span><div id="dodaj_koszyk"><form name="cart_form" id="cart_form" action="votre-panier/" method="post"></form></div></div>');
							if(jQuery('#id_16').css('display') != 'none')
							{
								//jQuery('#totalamt_8').text("Total Amount:  "+finalPrice);
								//jQuery('#prix_unitaire').text(finalPrice);
								jQuery('#estdate_16').html('Date de livraison : '+output+' <a class="linkUppercase" href="http://www.france-banderole.com/etre-livre-rapidement/" target="_blank">(*)</a>');

							}

							finalPrice1=fixstr(finalPrice);
							finalPrice2 = finalPrice1.replace(".", ",");

							jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
							jQuery('#remise').html(rabat2);

						}

						cenapojedyncza = finalPrice1;

						ilosc=$('input_8').value;
						if ($('input_8').value) {
							cena=cenapojedyncza*ilosc;
						}

						var total = document.getElementById("total");
						var remise = document.getElementById("remise");

						cenapojedyncza=fixstr(cenapojedyncza);
						cena2 = cenapojedyncza.replace(".", ",")



						transport=0;

						var niepokazuj = 0;

						if (niepokazuj==1) {
							prix.innerHTML='-';
							remise.innerHTML='-';
							total.innerHTML='-';
						}

						///////////livraison le jour même////////
						if ((DeliveryType == '1-1') && (PorductType == '1-1')){
							livraisonrapide.style.display = 'block';
						}
						else {livraisonrapide.style.display = 'none';}
						/////////////////////////////////////////

						 if ((niepokazuj==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){
                    suma=cena-rabat;
                    suma=fixstr(suma);
                    suma2 = suma.replace(".", ",");
                    total.innerHTML=suma2+' &euro;';


                    if (ilosc.empty()){
                      eBox.innerHTML = '<img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> Merci de spécifier une quantité';
                    }

                      var rodzaj = "Stand";
	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Stand" /><input type="hidden" name="opis" value="- '+$('input_0').value+dodatkowaopcja+'<br />- '+ktodaje+cedzik+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant <i class="fa fa-caret-right" aria-hidden="true"></i></button> ';


					}
				});
			});

			</script>
