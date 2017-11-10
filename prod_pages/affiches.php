<div id="buying">
  <h3>Votre devis en ligne</h3>
  <form class="jotform-form" action="" method="post" name="form_1060900222" id="1060900222" accept-charset="utf-8" onsubmit="JKakemono.cal_affiches(); return false;">
    <input type="hidden" name="formID" value="1060900222" />
    <div class="form-all">

      <ul class="form-section">

        <li class="form-line" id="id_1">

          <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
            <option value="">choisir l'épaisseur...</option>
            <option value="Affiches 130g">130g Dos bleu (à coller)</option>
            <option value="Affiches 150g">150g Dos blanc Mat</option>
            <option value="Affiches 220g">220g M1 ultra blanc</option>
          </select>
        </li>

        <li class="form-line" id="id_21">

          <select class="form-dropdown validate[required]" id="input_21" name="q21_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
            <option value="">choisir le format...</option>
            <option value="1">DIN A2 (42 x 60 cm) | Quadri </option>
            <option value="2">DIN A1 (60 x 84 cm) | Quadri </option>
            <option value="3">DIN A0 (84 x 120 cm) | Quadri </option>
            <option value="4">120 x 160 cm (Abribus)| Quadri </option>
            <option value="5">120 x 176 cm (Abribus)| Quadri </option>
            <option value="6">100 x 150 cm (Caisson lumineux/Abribus) | Quadri </option>
            <option value="7">150 x 200 cm (Caisson lumineux/Abribus) | Quadri </option>
          </select>
        </li>


        <li class="form-line" id="id_41">

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
          <select class="form-dropdown validate[required]" id="input_41" name="q41_maquette41" onchange="JKakemono.czyscpola();">
            <option value="">fichier d'impression...</option>
            <option value="fb">France banderole crée la maquette</option>
            <option value="user">j’ai déjà crée la maquette </option>
            <option value="config">je crée ma maquette en ligne</option>
          </select>
        </li>

        <li class="form-line" id="id_45">
          <span class="helpButton" onmouseover="pokazt('helpText45');" onmouseout="ukryjt('helpText45');">
            <img class="helpImg" src="http://www.france-banderole.com/wp-content/plugins/fbshop/images/question.png">
            <span class="helpText" id="helpText45" style="visibility:hidden;">
              Vous avez choisi de créer votre maquette en ligne, veuillez préciser si vous souhaitez voir s'afficher votre gabarit en mode portrait ou paysage.
            </span>
          </span>
          <select class="form-dropdown validate[required]" id="input_45" name="q45_maquette45" onchange="JKakemono.czyscpola();">
            <option value="">Portrait ou paysage...</option>
            <option value="portrait">Portrait</option>
            <option value="paysage">Paysage</option>
          </select>
        </li>

        <li class="form-line" id="id_5">

          <select class="form-dropdown quan validate[required]" id="input_5" name="q5_maquette5" onchange="JKakemono.czyscpola(); ">
            <option value="">quantité...</option>
            <option value="1">1 </option>
            <option value="5">5 </option>
            <option value="10">10 </option>
            <option value="25">25 </option>
            <option value="50">50 </option>
            <option value="100">100 </option>
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

        <li class="form-line" id="id_11a">
  				<div class="form-input-wide">

  					<button id="input_11" type="submit" class="form-submit-button" style="display: none;">Submit Form</button>
  				</div>
  			</li>

        <li style="display:none">
          Should be Empty:
          <input type="text" name="website" value="" />
        </li>

      </ul>
    </div>

    <input type="hidden" id="simple_spc" name="simple_spc" value="1060900222" />
    <script type="text/javascript">
      document.getElementById("simple_spc").value += "-1060900222";
    </script>

  </form>
</div>

<div id="preview">

  <img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/arrow.png" alt="arrow" class="arrow" />

  <div id="container">

    <div id="slides">
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/affiches/slide/test-2.jpg" alt="commencez votre devis en ligne" /></li>
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/affiches/slide/test-1.jpg" alt="commencez votre devis en ligne" /></li>
      <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/banderole/slide/test-3.png" alt="commencez votre devis en ligne" /></li>
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
      var cena        = 0; var cena2=0;
      var suma        = 0; var suma2=0;
      var prixunite   = 0;
  		var rabat       = 0;     var rabat2 = 0;
  		var prliv       = '';
      var transport   = 0;
      var ilosc       = $('input_5').value;
      var largeur     = 0;
  		var hauteur     = 0;
      var opis        = '';

      //////////////////////////////////////////////////////////////////////////

      if ($('input_1').value == 'Affiches 130g') {
        if ($('input_21').value == '1'){

        if (ilosc == '1') { cena=1*0.25*18; transport=11.9;}
        if (ilosc == '5') { cena=5*0.25*16; transport=11.9;}
        if (ilosc == '10') { cena=10*0.25*14; transport=11.9;}
        if (ilosc == '25') { cena=25*0.25*12; transport=14.9;}
        if (ilosc == '50') { cena=50*0.25*10; transport=14.9;}
        if (ilosc == '100') { cena=100*0.25*8; transport=26.9;}
        opis += '<br />- DIN A2 (42 x 60 cm) | Quadri';
        }

        if ($('input_21').value == '2'){

        if (ilosc == '1') { cena=1*0.5*18; transport=11.9;}
        if (ilosc == '5') { cena=5*0.5*16; transport=11.9;}
        if (ilosc == '10') { cena=10*0.5*14; transport=11.9;}
        if (ilosc == '25') { cena=25*0.5*12; transport=14.9;}
        if (ilosc == '50') { cena=50*0.5*10; transport=14.9;}
        if (ilosc == '100') { cena=100*0.5*8; transport=26.9;}
        opis += '<br />- DIN A1 (60 x 84 cm) | Quadri';
        }

        if ($('input_21').value == '3'){

        if (ilosc == '1') { cena=1*1*18; transport=11.9;}
        if (ilosc == '5') { cena=5*1*16; transport=11.9;}
        if (ilosc == '10') { cena=10*1*14; transport=11.9;}
        if (ilosc == '25') { cena=25*1*12; transport=14.9;}
        if (ilosc == '50') { cena=50*1*10; transport=14.9;}
        if (ilosc == '100') { cena=100*1*8; transport=26.9;}
        opis += '<br />- DIN A0 (84 x 120 cm) | Quadri';
        }

        if ($('input_21').value == '4'){

        if (ilosc == '1') { cena=1*1.92*18; transport=11.9;}
        if (ilosc == '5') { cena=5*1.92*16; transport=11.9;}
        if (ilosc == '10') { cena=10*1.92*14; transport=11.9;}
        if (ilosc == '25') { cena=25*1.92*12; transport=14.9;}
        if (ilosc == '50') { cena=50*1.92*10; transport=14.9;}
        if (ilosc == '100') { cena=100*1.92*8; transport=26.9;}
        opis += '<br />- 120 x 160 cm | Quadri';
        }

        if ($('input_21').value == '5'){

        if (ilosc == '1') { cena=1*2.11*18; transport=11.9;}
        if (ilosc == '5') { cena=5*2.11*16; transport=11.9;}
        if (ilosc == '10') { cena=10*2.11*14; transport=11.9;}
        if (ilosc == '25') { cena=25*2.11*12; transport=14.9;}
        if (ilosc == '50') { cena=50*2.11*10; transport=14.9;}
        if (ilosc == '100') { cena=100*2.11*8; transport=26.9;}
        opis += '<br />- 120 x 176 cm | Quadri';
        }

        if ($('input_21').value == '6'){

        if (ilosc == '1') { cena=1*1.50*18; transport=11.9;}
        if (ilosc == '5') { cena=5*1.50*16; transport=11.9;}
        if (ilosc == '10') { cena=10*1.50*14; transport=11.9;}
        if (ilosc == '25') { cena=25*1.50*12; transport=14.9;}
        if (ilosc == '50') { cena=50*1.50*10; transport=14.9;}
        if (ilosc == '100') { cena=100*1.50*8; transport=26.9;}
        opis += '<br />- 100 x 150 cm | Quadri';
        }

        if ($('input_21').value == '7'){

        if (ilosc == '1') { cena=1*3*18; transport=11.9;}
        if (ilosc == '5') { cena=5*3*16; transport=11.9;}
        if (ilosc == '10') { cena=10*3*14; transport=11.9;}
        if (ilosc == '25') { cena=25*3*12; transport=14.9;}
        if (ilosc == '50') { cena=50*3*10; transport=14.9;}
        if (ilosc == '100') { cena=100*3*8; transport=26.9;}
        opis += '<br />- 150 x 200 cm | Quadri';
        }
      }

      if ($('input_1').value == 'Affiches 150g') {
        if ($('input_21').value == '1'){

        if (ilosc == '1') { cena=1*0.25*20; transport=11.9;}
        if (ilosc == '5') { cena=5*0.25*18; transport=11.9;}
        if (ilosc == '10') { cena=10*0.25*16; transport=11.9;}
        if (ilosc == '25') { cena=25*0.25*14; transport=14.9;}
        if (ilosc == '50') { cena=50*0.25*12; transport=14.9;}
        if (ilosc == '100') { cena=100*0.25*10; transport=26.9;}
        opis += '<br />- DIN A2 (42 x 60 cm) | Quadri';
        }

        if ($('input_21').value == '2'){

        if (ilosc == '1') { cena=1*0.5*20; transport=11.9;}
        if (ilosc == '5') { cena=5*0.5*18; transport=11.9;}
        if (ilosc == '10') { cena=10*0.5*16; transport=11.9;}
        if (ilosc == '25') { cena=25*0.5*14; transport=14.9;}
        if (ilosc == '50') { cena=50*0.5*12; transport=14.9;}
        if (ilosc == '100') { cena=100*0.5*10; transport=26.9;}
        opis += '<br />- DIN A1 (60 x 84 cm) | Quadri';
        }

        if ($('input_21').value == '3'){

        if (ilosc == '1') { cena=1*1*20; transport=11.9;}
        if (ilosc == '5') { cena=5*1*18; transport=11.9;}
        if (ilosc == '10') { cena=10*1*16; transport=11.9;}
        if (ilosc == '25') { cena=25*1*14; transport=14.9;}
        if (ilosc == '50') { cena=50*1*12; transport=14.9;}
        if (ilosc == '100') { cena=100*1*10; transport=26.9;}
        opis += '<br />- DIN A0 (84 x 120 cm) | Quadri';
        }

        if ($('input_21').value == '4'){

        if (ilosc == '1') { cena=1*1.92*20; transport=11.9;}
        if (ilosc == '5') { cena=5*1.92*18; transport=11.9;}
        if (ilosc == '10') { cena=10*1.92*16; transport=11.9;}
        if (ilosc == '25') { cena=25*1.92*14; transport=14.9;}
        if (ilosc == '50') { cena=50*1.92*12; transport=14.9;}
        if (ilosc == '100') { cena=100*1.92*10; transport=26.9;}
        opis += '<br />- 120 x 160 cm | Quadri';
        }

        if ($('input_21').value == '5'){

        if (ilosc == '1') { cena=1*2.11*20; transport=11.9;}
        if (ilosc == '5') { cena=5*2.11*18; transport=11.9;}
        if (ilosc == '10') { cena=10*2.11*16; transport=11.9;}
        if (ilosc == '25') { cena=25*2.11*14; transport=14.9;}
        if (ilosc == '50') { cena=50*2.11*12; transport=14.9;}
        if (ilosc == '100') { cena=100*2.11*10; transport=26.9;}
        opis += '<br />- 120 x 176 cm | Quadri';
        }

        if ($('input_21').value == '6'){

        if (ilosc == '1') { cena=1*1.50*20; transport=11.9;}
        if (ilosc == '5') { cena=5*1.50*18; transport=11.9;}
        if (ilosc == '10') { cena=10*1.50*16; transport=11.9;}
        if (ilosc == '25') { cena=25*1.50*14; transport=14.9;}
        if (ilosc == '50') { cena=50*1.50*12; transport=14.9;}
        if (ilosc == '100') { cena=100*1.50*10; transport=26.9;}
        opis += '<br />- 100 x 150 cm | Quadri';
        }

        if ($('input_21').value == '7'){

        if (ilosc == '1') { cena=1*3*20; transport=11.9;}
        if (ilosc == '5') { cena=5*3*18; transport=11.9;}
        if (ilosc == '10') { cena=10*3*16; transport=11.9;}
        if (ilosc == '25') { cena=25*3*14; transport=14.9;}
        if (ilosc == '50') { cena=50*3*12; transport=14.9;}
        if (ilosc == '100') { cena=100*3*10; transport=26.9;}
        opis += '<br />- 150 x 200 cm | Quadri';
        }
      }

      if ($('input_1').value == 'Affiches 220g') {
        if ($('input_21').value == '1'){

        if (ilosc == '1') { cena=1*0.25*25; transport=11.9;}
        if (ilosc == '5') { cena=5*0.25*23; transport=11.9;}
        if (ilosc == '10') { cena=10*0.25*19; transport=11.9;}
        if (ilosc == '25') { cena=25*0.25*18; transport=14.9;}
        if (ilosc == '50') { cena=50*0.25*17; transport=14.9;}
        if (ilosc == '100') { cena=100*0.25*15; transport=26.9;}
        opis += '<br />- DIN A2 (42 x 60 cm) | Quadri';
        }

        if ($('input_21').value == '2'){

        if (ilosc == '1') { cena=1*0.5*25; transport=11.9;}
        if (ilosc == '5') { cena=5*0.5*23; transport=11.9;}
        if (ilosc == '10') { cena=10*0.5*19; transport=11.9;}
        if (ilosc == '25') { cena=25*0.5*18; transport=14.9;}
        if (ilosc == '50') { cena=50*0.5*17; transport=14.9;}
        if (ilosc == '100') { cena=100*0.5*15; transport=26.9;}
        opis += '<br />- DIN A1 (60 x 84 cm) | Quadri';
        }

        if ($('input_21').value == '3'){

        if (ilosc == '1') { cena=1*1*25; transport=11.9;}
        if (ilosc == '5') { cena=5*1*23; transport=11.9;}
        if (ilosc == '10') { cena=10*1*19; transport=11.9;}
        if (ilosc == '25') { cena=25*1*18; transport=14.9;}
        if (ilosc == '50') { cena=50*1*17; transport=14.9;}
        if (ilosc == '100') { cena=100*1*15; transport=26.9;}
        opis += '<br />- DIN A0 (84 x 120 cm) | Quadri';
        }

        if ($('input_21').value == '4'){

        if (ilosc == '1') { cena=1*1.92*25; transport=11.9;}
        if (ilosc == '5') { cena=5*1.92*23; transport=11.9;}
        if (ilosc == '10') { cena=10*1.92*19; transport=11.9;}
        if (ilosc == '25') { cena=25*1.92*18; transport=14.9;}
        if (ilosc == '50') { cena=50*1.92*17; transport=14.9;}
        if (ilosc == '100') { cena=100*1.92*15; transport=26.9;}
        opis += '<br />- 120 x 160 cm | Quadri';
        }

        if ($('input_21').value == '5'){

        if (ilosc == '1') { cena=1*2.11*25; transport=11.9;}
        if (ilosc == '5') { cena=5*2.11*23; transport=11.9;}
        if (ilosc == '10') { cena=10*2.11*19; transport=11.9;}
        if (ilosc == '25') { cena=25*2.11*18; transport=14.9;}
        if (ilosc == '50') { cena=50*2.11*17; transport=14.9;}
        if (ilosc == '100') { cena=100*2.11*15; transport=26.9;}
        opis += '<br />- 120 x 176 cm | Quadri';
        }

        if ($('input_21').value == '6'){

        if (ilosc == '1') { cena=1*1.50*25; transport=11.9;}
        if (ilosc == '5') { cena=5*1.50*23; transport=11.9;}
        if (ilosc == '10') { cena=10*1.50*19; transport=11.9;}
        if (ilosc == '25') { cena=25*1.50*18; transport=14.9;}
        if (ilosc == '50') { cena=50*1.50*17; transport=14.9;}
        if (ilosc == '100') { cena=100*1.50*15; transport=26.9;}
        opis += '<br />- 100 x 150 cm | Quadri';
        }

        if ($('input_21').value == '7'){

        if (ilosc == '1') { cena=1*3*25; transport=11.9;}
        if (ilosc == '5') { cena=5*3*23; transport=11.9;}
        if (ilosc == '10') { cena=10*3*19; transport=11.9;}
        if (ilosc == '25') { cena=25*3*18; transport=14.9;}
        if (ilosc == '50') { cena=50*3*17; transport=14.9;}
        if (ilosc == '100') { cena=100*3*15; transport=26.9;}
        opis += '<br />- 150 x 200 cm | Quadri';
        }
      }

      opis += '<br />- '+ilosc+' Affiches(s)';

      //////////////////////////////////////////////////////// format gabarit //
			if ($('input_45').value == 'portrait') {
				opis += '<br />- portrait';
			}
			if ($('input_45').value == 'paysage') {
				opis += '<br />- paysage';
			}
			// -----------------------------------------------------------------------
			if (($('input_21').value == '1') && ($('input_45').value == 'portrait')) {
				hauteur = 60;
				largeur = 42;
			}
			if (($('input_21').value == '1') &&  ($('input_45').value == 'paysage')) {
				hauteur = 42;
				largeur = 60;
			}
      // -----------------------------------------------------------------------
			if (($('input_21').value == '2') && ($('input_45').value == 'portrait')) {
				hauteur = 84;
				largeur = 60;
			}
			if (($('input_21').value == '2') && ($('input_45').value == 'paysage')) {
				hauteur = 60;
				largeur = 84;
			}
      // -----------------------------------------------------------------------
			if (($('input_21').value == '3') && ($('input_45').value == 'portrait')) {
				hauteur = 120;
				largeur = 84;
			}
			if (($('input_21').value == '3') && ($('input_45').value == 'paysage')) {
				hauteur = 84;
				largeur = 120;
			}
      // -----------------------------------------------------------------------
			if (($('input_21').value == '4') && ($('input_45').value == 'portrait')) {
				hauteur = 160;
				largeur = 120;
			}
			if (($('input_21').value == '4') && ($('input_45').value == 'paysage')) {
				hauteur = 120;
				largeur = 160;
			}
      // -----------------------------------------------------------------------
			if (($('input_21').value == '5') && ($('input_45').value == 'portrait')) {
				hauteur = 176;
				largeur = 120;
			}
			if (($('input_21').value == '5') && ($('input_45').value == 'paysage')) {
				hauteur = 120;
				largeur = 176;
			}
      // -----------------------------------------------------------------------
			if (($('input_21').value == '6') && ($('input_45').value == 'portrait')) {
				hauteur = 150;
				largeur = 100;
			}
			if (($('input_21').value == '6') && ($('input_45').value == 'paysage')) {
				hauteur = 100;
				largeur = 150;
			}
      // -----------------------------------------------------------------------
			if (($('input_21').value == '7') && ($('input_45').value == 'portrait')) {
				hauteur = 200;
				largeur = 150;
			}
			if (($('input_21').value == '7') && ($('input_45').value == 'paysage')) {
				hauteur = 150;
				largeur = 200;
			}

      //////////////////////////////////////////////////////// choix maquette //
      var ktodaje;

      if (($('input_41').value == 'fb')) {
        cena+=29;
        ktodaje = 'France banderole crée la maquette';
      }
      if (($('input_41').value == 'user')) {
        ktodaje = 'j’ai déjà crée la maquette';
      }
      if (($('input_41').value == 'config')) {
        cena+=5;
        ktodaje = 'je crée ma maquette en ligne';
      }

      opis += '<br />- '+ktodaje;

      /////////////////////////////////////////////////////////////// options //
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
      if (etiquette == true) {
        cena-= cena*3/100;
        opis += '<br />- retrait colis a l\'atelier';
      }

      //////////////////////////////////////////////////////////////////////////

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
					jQuery('#estdate_8').html('Date de livraison max : '+output+'  <a class="linkUppercase modal-link" href="//www.france-banderole.com/etre-livre-rapidement/" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>');
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
      cena2 = prixunite.replace(".", ",");
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

			//////////////////////////////////////////////////////////////////////////

			if ((niepokazuj==0) && ((DeliveryType == '2-3') || (DeliveryType == '1-1') || (DeliveryType == '3-4'))){

			suma=prixunite;
			suma=fixstr(suma);
			suma2 = suma.replace(".", ",");

			total.innerHTML=suma2+' &euro;';

      var rodzaj = $('input_1').value;

      var dodajkoszyk = document.getElementById("cart_form");

      dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+prliv+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur+'" /><input type="hidden" name="largeur" value="'+largeur+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button> ';
    }
  });
});
</script>
