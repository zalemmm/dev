<div id="buying">
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
          <label class="form-label-left label-highlight" id="label_4" for="input_4">quantité :<br /><span class="small">(par visuel)</span> (par visuel):</label>
          <input type="text" class="form-textbox validate[required, Numeric]" id="input_4" name="q4_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); " />
        </li>

        <li id="id_5" class="form-line optionsformline2" style="nothing"">
          <label class="form-label-left label-highlight" id="label_5" for="input_5">taille <span  class="highlight">(en Mètres)</span>:</label>
          <input type="text" class="form-textbox validate[required, Numeric]" id="input_5" name="q5_taile" size="20" onchange="JKakemono.czyscpola(); " style="margin-left:18px/>
		<span class="highlight" style="color:red;">M</span> <span class="heusepar" style="left:185px;">x</span><input type="text" class="form-textbox2 validate[required, Numeric]" id="input_6" name="q6_taile" size="20" value="1" onclick="JKakemono.czyscpola(); " style="top:12px; left:200px;" /><span class="highlight" style="position:absolute; top:16px; left:255px">M</span> <span class="llar" style="left:100px;">[hauteur]</span><span class="lhau" style="left:203px;">[largeur]</span></li>
        </li>

        <li id="id_7" class="form-line optionsformline">
          <span class="title">OPTIONS DE LIVRAISON <span class="splitorhide">DISPONIBLES :</span> </span>

          <span class="options_single">
            <span class="optionsleft"><label class="form-label-left" id="label_colis" for="colis">Colis revendeur</label><input type="checkbox" class="form-checkbox" id="colis" name="colis[]" value="" onchange="JKakemono.colisRevendeurcheckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextcolis');" onmouseout="ukryjt('helpTextcolis');"><span class="helpText" id="helpTextcolis" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
            <span class="optionsright"><label class="form-label-left" id="label_rush24" for="rush24">Production express</label><input type="checkbox" class="form-checkbox" id="rush24" name="rush24[]" value="" onchange="JKakemono.rushcheckbox24(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextRush24');" onmouseout="ukryjt('helpTextRush24');"><span class="helpText" id="helpTextRush24" style="visibility:hidden;">Pour toute commande passée et réglée avant midi, le colis sera livré 4 à 7 jours ouvrés par TNT Express à l’adresse indiquée par le client.</span></span></span>
          </span>

          <span class="options_single">
            <span class="optionsleft"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L\'Atelier</label><input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onchange="JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextetiquette');" onmouseout="ukryjt('helpTextetiquette');"><span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l\'atelier de Vitrolles. Vos frais de port seront supprimés de votre devis avant votre paiement.</span></span></span>

            <span class="optionsright"><label class="form-label-right" id="label_relais" for="relais">Dépot en relais colis</label><input type="checkbox" class="form-checkbox" id="relais" name="relais[]" value="" onchange="JKakemono.relaisColischeckbox(); JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt('helpTextrelais');" onmouseout="ukryjt('helpTextrelais');"><span class="helpText" id="helpTextrelais" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
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

      <li id="id_18" class="form-line id_18">
        <div class="form-input-wide">
          <div id="form-button-error2"></div>
          <button id="input_18" type="submit" class="form-submit-button">Submit Form</button>
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

<div id="preview_con">
  <div id="preview">
    <span id="preview_name">Forex 1 mm:</span>
    <div id="preview_imag"></div><div id="preview_info"><div id="preview_info_title"></div><ul id="preview_info_ul"><li id="iden1"></li><li id="iden2"></li></ul></div>
  </div>

  <div id="preview2">
    <span id="preview_name2"></span>
    <div id="preview_imag2"></div><div id="preview_info2"><div id="preview_info_title2"></div><ul id="preview_info_ul2"><li style="display:none"></li></ul></div>
  </div>
</div>

<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>
