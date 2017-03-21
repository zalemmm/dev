<div id="buying">
	<form class="jotform-form" action="" method="post" name="form_1060900216" id="1060900216" accept-charset="utf-8" onsubmit="JKakemono.cal_autocollant(); return false;">
		<input type="hidden" name="formID" value="1060900216" />
		<div class="form-all">
			<ul class="form-section">

				<li class="form-line" id="id_1">
					<span class="helpButton" onmouseover="pokazt('helpTextsupport');" onmouseout="ukryjt('helpTextsupport');"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png"><span class="helpText" id="helpTextsupport" style="visibility:hidden;">Support</span></span>
					<select class="form-dropdown validate[required]" id="input_1" name="q1_support1" onclick="JKakemono.czyscpola(); ">
						<option value="">Choisir le support </option>
						<option value="permanent">vinyle blanc permanent 95μ monomère 3 ans</option>
						<option value="semi-permanent">vinyle blanc semi-permanent 95μ monomère 2 ans</option>
						<option value="vinyle micro-perforè M1 dos noir">vinyle micro-perforé M1 dos noir 2 ans</option>
						<option value="permanent75μ">vinyle blanc permanent 75μ polymère 5 ans</option>
						<option value="vinyle magnètique">vinyle magnétique 500μ</option>
						<option value="vinyle transparent">vinyle transparent</option>
					</select>
				</li>

				<li class="form-line" id="id_6">
					<span class="helpButton" onmouseover="pokazt('helpTextmaquette');" onmouseout="ukryjt('helpTextmaquette');"><img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png"><span class="helpText" id="helpTextmaquette" style="visibility:hidden;">• <u><b>France banderole crée votre fichier </u>:</b><br/>Vous fournissez<span class="highlight"><b> de 1 à 6 éléments séparés</b></span> et un explicatif sur votre souhait. Notre équipe d'infographie crée votre maquette et vous envoie un premier BAT. Si vous souhaitez une composition plus complexe, une recherche graphique ou création de logo, contactez notre service commercial.<br/>• <u><b>Vous avez déjà crée la mise en page:</b></u><br/>Vous envoyez votre propre fichier PDF (une fois votre devis enregistré). Ce dernier sera vérifié gratuitement par notre service d'infographie et, un <span class="highlight"><b>BAT gratuit à valider</b></span> vous sera transmis dans votre accès client.<br/></span></span>
					<select class="form-dropdown validate[required]" id="input_6" name="q6_maquette6" onclick="JKakemono.czyscpola(); ">
						<option value="">Choisir le fichier</option>
						<option value="fb">France banderole crée la maquette</option>
						<option value="user">j’ai déjà crée la maquette </option>
					</select>
				</li>

				<li class="form-line optionsformline2" id="id_7">
					<label class="form-label-left label-highlight" id="label_7" for="input_7">quantité :<br /><span class="small">(par visuel)</span></label>
					<input type="text" class="form-textbox textboxPush validate[required, Numeric]" id="input_7" name="q7_quantite" size="20" value="1" onclick="JKakemono.czyscpola(); " />
				</li>

				<li class="form-line optionsformline2" id="id_8">
					<label class="form-label-left label-highlight" id="label_8" for="input_8">taille <strong><br /><span class="highlight small">(centimètres)</span></span></strong>:</label>
					<input type="text" class="form-textbox validate[required, Numeric]" id="input_8" name="q8_taile" size="20" onclick="JKakemono.czyscpola(); " /><span class="cmLeft highlight">CM</span><span class="heusepar">x</span><input type="text" class="form-textbox2 validate[required, Numeric]" id="input_9" name="q9_taile" size="20" onclick="JKakemono.czyscpola(); " /><span class="cmRight highlight">CM</span><span class="cmLeft highlight">CM</span><span class="llar">[hauteur]</span><span class="lhau">[largeur]</span>
				</li>

				<li class="form-line optionsformline" id="id_10">
					<span class="title">OPTIONS COMPLEMENTAIRES <span class="splitorhide">DISPONIBLES :</span> </span>
					<span class="options_single">
						<span class="optionsleft"><label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label><input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onclick="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextcolis');" onmouseout="ukryjt('helpTextcolis');"><span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
						<span class="optionsleft"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L'Atelier</label><input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onclick="JKakemono.czyscpola(); JKakemono.relaisColischeckbox();" /><span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');"><span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles.</span></span></span>
						<span class="optionsleft"><label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label><input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onclick="JKakemono.czyscpola(); JKakemono.relaisColischeckbox();" /><span class="helpButton" onmouseover="pokazt('helpTextrelais');" onmouseout="ukryjt('helpTextrelais');"><span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
					</span>

					<div class="break-line"></div>

					<p id="production" >
						<h5 class="delivery-delay">Delai Production:</h5>
						<button class="production" text-value="4-5" id="p1"></button>
						<button class="production" text-value="2-3" id="p2"></button>
						<button class="production" text-value="1-1" id="p3"></button>
						<input type="hidden" id="production-value" value=""  onClick="" />
					</p>
					<div id="delivery-div" style='display:none;'>
						<p id="delivery" >
							<h5 class="delivery-delay">Delai Livraison:</h5>
							<button class="delivery" text-value="3-4" id="l1"></button>
							<button class="delivery" text-value="2-3" id="l2"></button>
							<button class="delivery" text-value="1-1" id="l3"></button>
							<input type="hidden" id="delivery-value" value="" />
						</p>
						<p>
							<!--<span id="totaldays"></span>&nbsp;-->
							<span id="totalamt_10"></span>
							<span id='estdate_10' class="delivery-date"></span>
						</p>

					</div>
				</li>

				<li class="form-line" id="id_9a">
					<div class="form-input-wide">
						<div id="form-button-error2" style="top:30px"></div>
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




</form>
</div>
<div id="preview">
	<div id="preview_imag"></div>
</div>

<div id="custom_price_unit" >

</div>
<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>

<script type="text/javascript">
/* Voici la fonction javascript qui change la propriété "display"
livraison le jour même */

function Afficher()
{
	divliv = document.getElementById('livraisonrapide');

	if (divliv.style.display == 'none')
	divliv.style.display = 'block';


}
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

function Masquer()
{
	divInfo = document.getElementById('delivery-div');

	if (divInfo.style.display == 'block')
	divInfo.style.display = 'none';


}
</script>

<script type="text/javascript">
jQuery('#etiquette').click(function() {
	if (document.getElementById('etiquette').checked) {
		document.getElementById('relais').checked = false;
	}
});

jQuery('#relais').click(function() {
	if (document.getElementById('relais').checked) {
		document.getElementById('etiquette').checked = false;
	}
});
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

		var cena=0; var cena2=0; var cenapojedyncza=0;
		var rabat=0; var rabat2=0;
		var suma=0; var suma2=0;
		var transport=0;
		var ktorytyp='';
		var cedzik='';
		var prliv='';
		var date_panier='';
		var dodatkowaopcja='';
		var metraz=0;
		var szerokosc=0;
		var wysokosc=0;
		var option2=0;
		var cedzik = '';
		var niepokazuj = 0;
		var eBox = document.getElementById('form-button-error2');
		eBox.innerHTML='';
		var ax1 = document.getElementById("id_1");
		var ax2 = document.getElementById("id_8");
		var ax3 = document.getElementById("id_14");
		if (ax1) {
			ax1.style.background="none";
			ax1.style.border="none";
			ax1.style.borderBottom="";
		}
		if (ax2) {
			ax2.style.background="none";
			ax2.style.border="none";
			// ax2.style.borderBottom="1px solid #9fa3a8";
		}
		if (ax3) {
			ax3.style.background="none";
			ax3.style.border="none";
			// ax3.style.borderBottom="1px solid #9fa3a8";
		}

		if ( ($('input_1').value) &&   ($('input_6').value) && ($('input_7').value) && ($('input_8').value) && ($('input_9').value) ) {
			var ktorytyp='';
			var ktorapodstawa='';
			var tape='';

			szerokosc = ($('input_8').value);
			szerokosc = szerokosc.replace(',','.');
			szerokosc = fixstr(szerokosc);
			$('input_8').value = szerokosc;
			wysokosc = ($('input_9').value);
			wysokosc = wysokosc.replace(',','.');
			wysokosc = fixstr(wysokosc);
			$('input_9').value = wysokosc;
			metraz = szerokosc * wysokosc;
			metraz = fixstr(metraz);


			if ( ($('input_1').value == 'permanent') ) {
				ktorytyp='Autocollant (carré/rectangulaire)';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.002;
			}

			if ( ($('input_1').value == 'semi-permanent')) {
				ktorytyp='Autocollant (carré/rectangulaire)';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0020;
			}

			if ( ($('input_1').value == 'vinyle micro-perforè M1 dos noir') ) {
				ktorytyp='Autocollant (carré/rectangulaire)';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0035;
			}

			if ( ($('input_1').value == 'permanent75μ') ) {
				ktorytyp='Autocollant (carré/rectangulaire)';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0055;
			}

			if ( ($('input_1').value == 'vinyle magnètique') ) {
				ktorytyp='Autocollant (carré/rectangulaire)';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0055;
			}
			if ( ($('input_1').value == 'vinyle transparent') ) {
				ktorytyp='Autocollant (carré/rectangulaire)';
				ktorapodstawa = ($('input_1').value);
				cena = metraz*0.0055;
			}

			///////

			ilosc=$('input_7').value;

			var ktodaje;
			if ($('input_6').value == 'fb') {
				cena+=29;
				ktodaje = 'France banderole crée la maquette';
			}
			if ($('input_6').value == 'user') {
				ktodaje = 'j’ai déjà crée la maquette';
			}


			////reszta
			var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
			if (colis == true) {
				cena += cena*3/100;
				cedzik += '<br />- colis revendeur';
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
				cenapojedyncza += 5.00/ilosc;
				cena += 5.00/ilosc;
				cedzik += '<br />- relais colis';
			}

			cenapojedyncza = cena;
			var iloscmetrow1=metraz*ilosc;

			if (ilosc) {
				cena=cenapojedyncza*ilosc;
				iloscmetrow=iloscmetrow1/10000;
			}

			//////////

			///////
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
								ProdPercent = 30;
								prliv += '<br />- P 1J';
							}else{
								ProdPercent = 0;
								prliv += '<br />- P 4-5J';
							}

							if(DeliveryType == '2-3'){
								DeliPercent = 15;
								prliv += ' / L 2-3J';
							}else if(DeliveryType =='1-1'){
								DeliPercent = 30;
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
							if(jQuery('#id_10').css('display') != 'none')
							{
								//jQuery('#totalamt_8').text("Total Amount:  "+finalPrice);
								//jQuery('#prix_unitaire').text(finalPrice);
								jQuery('#estdate_10').html('Date de livraison : '+output+' <a class="linkUppercase" href="http://www.france-banderole.com/etre-livre-rapidement/" target="_blank">(*)</a>');

							}

							finalPrice1=fixstr(finalPrice);
							finalPrice2 = finalPrice1.replace(".", ",");


							jQuery('#prix_unitaire').html(finalPrice2+' &euro;');
							jQuery('#remise').html(rabat2);

						}

						cenapojedyncza = finalPrice1;

						ilosc=$('input_7').value;
						if ($('input_7').value) {
							cena=cenapojedyncza*ilosc;
						}

						var total = document.getElementById("total");
						var remise = document.getElementById("remise");

						cenapojedyncza=fixstr(cenapojedyncza);
						cena2 = cenapojedyncza.replace(".", ",")

						/* koszty transportu */

						transport=0;

						var niepokazuj = 0;

						if (niepokazuj==1) {
							prix.innerHTML='-';
							remise.innerHTML='-';
							total.innerHTML='-';
						}

						if ( (szerokosc > 160) && (wysokosc > 160) ) {
							var blad = document.getElementById("id_1");
							var blad2 = document.getElementById("id_8");
							blad.style.background = "#FFAAAA";
							blad.style.border = "1px solid #FFAAAA";
							blad2.style.background = "#FFAAAA";
							blad2.style.border = "1px solid #FFAAAA";
							eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 160cm!';
							niepokazuj=1;
						}

						if ( ($('input_1').value == 'vinyle magnètique') && (szerokosc > 60) ) {
							var blad = document.getElementById("id_1");
							var blad2 = document.getElementById("id_8");
							blad.style.background = "#FFAAAA";
							blad.style.border = "1px solid #FFAAAA";
							blad2.style.background = "#FFAAAA";
							blad2.style.border = "1px solid #FFAAAA";
							eBox.innerHTML = 'Largeur doit être inférieure à 60cm!';
							niepokazuj=1;
						}

						if ( ((szerokosc < 10) || (wysokosc < 10)) ) {

							eBox.innerHTML = 'Hauteur et Largeur supérieur ou égal à 10cm!';
							niepokazuj=1;
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

							var forfait = 29 - suma;
							if (forfait > 0) {
								forfait = fixstr(forfait);
								eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
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
							dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Autocollant" /><input type="hidden" name="opis" value="- '+$('input_1').value+'<br />- '+ktorytyp+dodatkowaopcja+'<br />- '+ktodaje+cedzik+etiqdesc+prliv+'</br>- '+szerokosc+' x '+wysokosc+' cm" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant <i class="fa fa-caret-right" aria-hidden="true"></i></button> ';

						}
					}
				});
			});

			</script>
