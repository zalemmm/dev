<div id="buying">
  <form class="jotform-form" action="" method="post" name="form_1060900214" id="1060900214" accept-charset="utf-8" onsubmit="JKakemono.cal_parapluie(); return false;">
    <input type="hidden" name="formID" value="1060900214" />
    <div class="form-all">
      <ul class="form-section">

        <li class="form-line" id="id_0">
          <select class="form-dropdown validate[required]" id="input_0" name="q0_usage" onchange="getElementById('preview_info_ul').innerHTML=''; JKakemono.czyscpola(); ">
            <option value="">choisir le type</option>
            <option value="Tissu">Tissu Easy quick</option>
            <option value="Stand ExpoBag">Stand Expo’Bag</option>
            <option value="PLV carton">PLV carton pliable</option>
          </select>
        </li>

        <li class="form-line" id="id_1">
          <select class="form-dropdown validate[required]" id="input_1" name="q1_option" onchange="getElementById('preview_info_ul').innerHTML=''; JKakemono.czyscpola(); ">
            <option value="">choisir l'option...</option>
            <option value="1b">Totem oval (154x50cm)</option>
            <option value="2b">Totem oval (190x63cm)</option>
            <option value="3b">Comptoir (69x99cm) </option>
            <option value="4b">Arche 2 colonnes (190x63cm) et 1 top (200x50cm)</option>
            <option value="5b">Pack 1 (2 Petits Totems + Comptoir + Arche)</option>
            <option value="6b">Pack 2 (2 Grands Totems + Comptoir + Arche)</option>
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
            <option value="">choisir la mise en page...</option>
            <option value="fb">France banderole crée la maquette</option>
            <option value="user">j’ai déjà crée la maquette </option>
          </select>
        </li>

        <li class="form-line" id="id_8">
          <label class="form-label-left" id="label_8" for="input_8">quantité:</label>
          <input type="text" class="form-textbox validate[required, Numeric]" id="input_8" name="q8_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); " />
        </li>

        <li id="id_100" class="form-line optionsformline">
          <span class="title">OPTIONS COMPLEMENTAIRES DISPONIBLES :</span>

          <span class="options_single">
            <span class="optionsright"><label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label><input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onchange="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextcolis');" onmouseout="ukryjt('helpTextcolis');"><span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>

          </span>
          <span class="options_single">
            <span class="optionsleft"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L'Atelier</label><input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onchange="JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');"><span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles. Vos frais de port seront supprimés de votre devis avant votre paiement.</span></span></span>
            <span class="optionsleft"><label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label><input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onchange="JKakemono.relaisColischeckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextrelais');" onmouseout="ukryjt('helpTextrelais');"><span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
          </span>
          <div class="break-line"></div>
          <span class="options_single marginTop">
            <span class="optionsleft livraison-gratuite">
              <img src="http://www.france-banderole.com/img/star2.png" alt="fedex" class="starImg" />
              <label class="form-label-left" id="label_fedex" for="fedex">Livraison gratuite<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7 à 9 jours</label>
              <input type="checkbox" class="form-checkbox" id="fedex" name="fedex[]" value="" onchange=" JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTextfedex');" onmouseout="ukryjt('helpTextfedex');">
                <span class="helpText" id="helpTextfedex" style="visibility:hidden;">Livraison gratuite en 7 à 9 jours ouvrés (non compatible avec les délais Rush, et Relais colis).</span>
              </span>
            </span>
            <span class="optionsright">
              <label class="form-label-left" id="label_tnt" for="tnt">Livraison payante &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br> 4 à 7 jours</label>
              <input type="checkbox" class="form-checkbox" id="tnt" name="tnt[]" value="" onchange=" JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTexttnt');" onmouseout="ukryjt('helpTexttnt');">
                <span class="helpText" id="helpTexttnt" style="visibility:hidden;">Livraison payante en 4 à 7 jours ouvrés (non compatible avec un colis hors-norme*)</span>
              </span>
            </span>
          </span>
        </div>
      </li>

      

      <li class="form-line" id="id_9a">
        <div class="form-input-wide">
          <div id="form-button-error2"></div>
          <button id="input_9" type="submit" class="form-submit-button">Submit Form</button>
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
  <span id="preview_name">STAND PARAPLUIE sélectionné:</span>
  <div id="preview_imag"></div><div id="preview_info"><div id="preview_info_title"></div><ul id="preview_info_ul"><li style="display:none"></li></ul></div>
</div>

<script>
/*    jQuery(function() {
jQuery('.OptionTNT').hide();
jQuery('.OptionFedex').hide();
jQuery('#id_9').removeAttr('style').css({ height: '200px !important' });
document.getElementById('lt1').checked = true;

jQuery('#lt2').change(function() {
if (document.getElementById('lt2').checked == true) {
jQuery('.OptionFedex').hide();
jQuery('.OptionTNT').show();
jQuery('#id_9').css({ height: '200px !important' });
document.getElementById('rush72').checked = false;
document.getElementById('rush24').checked = false;
document.getElementById('relais').checked = false;
}
});

jQuery('#lt1').change(function() {
if (document.getElementById('lt1').checked == true) {
jQuery('.OptionTNT').hide();
jQuery('#id_9').css({ height: '80px !important' });
jQuery('.OptionFedex').show().html('');
}
});

jQuery('#lt1').change();
});
*/
</script>
<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>
