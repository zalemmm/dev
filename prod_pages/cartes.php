<div id="buying">
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

        <select class="form-dropdown validate[required]" id="input_4" name="q4_maquette4" onchange="JKakemono.czyscpola();">
          <option value="">fichier d'impression...</option>
          <option value="fb">France banderole crée la maquette</option>
          <option value="user">j’ai déjà crée la maquette </option>
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

      <li id="id_101" class="form-line optionsformlineOld">
        <span class="title">OPTIONS DE LIVRAISON <span class="splitorhide">DISPONIBLES :</span> </span>
        <span class="options_single">
          <span class="optionsright"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L'Atelier</label><input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onchange="JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');"><span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l'atelier de Vitrolles. Vos frais de port seront supprimés de votre devis avant votre paiement.</span></span></span>
          <span class="optionsleft"><label class="form-label-left" id="label_rush24" for="rush24">Délai Rush 24/48H</label><input type="checkbox" class="form-checkbox" id="rush24" name="rush24[]" value="" onchange="JKakemono.rushcheckbox24(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextRush24');" onmouseout="ukryjt('helpTextRush24');"><span class="helpText" id="helpTextRush24" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
        </span>

        <span class="options_single">
          <span class="optionsright"><label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label><input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onchange="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextcolis');" onmouseout="ukryjt('helpTextcolis');"><span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
          <!--<span class="optionsright"><label class="form-label-left" id="label_rush72" for="rush72">Délai Rush 72H</label><input type="checkbox" class="form-checkbox" id="rush72" name="rush72[]" value="" onchange="JKakemono.rushcheckbox72(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextrush72');" onmouseout="ukryjt('helpTextrush72');"><span class="helpText" id="helpTextrush72" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span> -->
        </span>

        <span class="options_single">
          <span class="optionsleft"><label class="form-label-left" id="label_economique" for="economique">Délai économique 6 à 8 jours ouvrés</label><input type="checkbox" class="form-checkbox" id="economique" name="economique[]" value="" onchange="JKakemono.rushcheckboxeconomique();; JKakemono.czyscpola(); "><span class="helpButton" onmouseover="pokazt('helpTextRush72');" onmouseout="ukryjt('helpTextRush72');"><span class="helpText" id="helpTextRush72" style="visibility: hidden;">Vous n’êtes pas pressé et souhaitez économiser 30%, vos délais de livraison seront de 6 à 8 jours ouvrés.</span></span></span>
          <span class="optionsright"><label class="form-label-left" id="label_relais" for="relais">Dépot en relais colis</label><input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onchange="JKakemono.relaisColischeckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextrelais');" onmouseout="ukryjt('helpTextrelais');"><span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
        </span>


        <span class="options_single">
          <span class="optionsleft">
            <label class="form-label-left" id="label_fedex" for="fedex">Livraison gratuite 7 à 9 jours</label>
            <input type="checkbox" class="form-checkbox" id="fedex" name="fedex[]" value="" onchange=" JKakemono.czyscpola(); " />
            <span class="helpButton" onmouseover="pokazt('helpTextfedex');" onmouseout="ukryjt('helpTextfedex');">
              <span class="helpText" id="helpTextfedex" style="visibility:hidden;">Livraison gratuite en 7 à 9 jours ouvrés (non compatible avec les délais Rush, et Relais colis).</span>
            </span>
          </span>
          <span class="optionsright">
            <label class="form-label-left" id="label_tnt" for="tnt">Livraison payante 4 à 7 jours</label>
            <input type="checkbox" class="form-checkbox" id="tnt" name="tnt[]" value="" onchange=" JKakemono.czyscpola(); " />
            <span class="helpButton" onmouseover="pokazt('helpTexttnt');" onmouseout="ukryjt('helpTexttnt');">
              <span class="helpText" id="helpTexttnt" style="visibility:hidden;">Livraison payante en 4 à 7 jours ouvrés (non compatible avec un colis hors-norme*)</span>
            </span>
          </span>
        </span>
      </li>

      <li class="form-line" id="id_26a" style="margin-top: 33px;">
        <div class="form-input-wide">
          <div id="form-button-error2"></div>
          <button id="input_26" type="submit" class="form-submit-button"><i class="fa fa-calculator" aria-hidden="true"></i> Calculer</button>
        </div>
      </li>
      <li style="display:none">
        Should be Empty:
        <input type="text" name="website" value="" />
      </li>
    </ul>
  </div>
  <input type="hidden" id="simple_spc" name="simple_spc" value="1060900221" />
  <script type="text/javascript">
  document.getElementById("simple_spc").value += "-1060900221";
  </script>
</form>
</div>

<div id="preview">
  <span id="preview_name">Cartes de Visites</span>
  <div id="preview_imag"></div><div id="preview_info"><div id="preview_info_title"></div><ul id="preview_info_ul"><span id="lista1"><li style="display:none"></li></span></ul></div>
</div>
<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>
