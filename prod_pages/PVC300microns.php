<div id="buying">
  <h3>Votre devis en ligne :</h3>
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
              <label class="form-label-left" id="label_etiquette" for="etiquette">Retrait colis a L'atelier</label>
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
              <label class="form-label-left" id="label_rush24" for="rush24">Production express</label>
              <input type="checkbox" class="form-checkbox" id="rush24" name="rush24[]" value="" onchange="JKakemono.rushcheckbox24(); JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTextRush24');" onmouseout="ukryjt('helpTextRush24');">
                <span class="helpText" id="helpTextRush24" style="visibility:hidden;">Pour toute commande passée et réglée avant midi, le colis sera livré 4 à 7 jours ouvrés par TNT Express à l’adresse indiquée par le client.</span>
              </span>
            </span>

            <span class="optionsright">
              <label class="form-label-left" id="label_tnt" for="tnt">Livraison payante 4 à 7 jours</label>
              <input type="checkbox" class="form-checkbox" id="tnt" name="tnt[]" value="" onchange=" JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTexttnt');" onmouseout="ukryjt('helpTexttnt');">
                <span class="helpText" id="helpTexttnt" style="visibility:hidden;">Livraison payante en 4 à 7 jours ouvrés (non compatible avec un colis hors-norme*)</span>
              </span>
            </span>

            <span class="optionsright">
              <label class="form-label-left" id="label_fedex" for="fedex">Livraison gratuite 7 à 9 jours</label>
              <input type="checkbox" class="form-checkbox" id="fedex" name="fedex[]" value="" onchange=" JKakemono.czyscpola(); " />
              <span class="helpButton" onmouseover="pokazt('helpTextfedex');" onmouseout="ukryjt('helpTextfedex');">
                <span class="helpText" id="helpTextfedex" style="visibility:hidden;">Livraison gratuite en 7 à 9 jours ouvrés (non compatible avec les délais Rush, et Relais colis).</span>
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

        </div>
      </li>


        <div class="form-input-wide">
          <div id="form-button-error2"></div>
          <button id="input_18" type="submit" class="form-submit-button"><i class="fa fa-calculator" aria-hidden="true"></i> Calculer</button>
        </div>


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
          <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/slidedefault/1.jpg" alt="commencez votre devis en ligne" /></li>
          <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/slidedefault/2.jpg" alt="commencez votre devis en ligne" /></li>
          <li><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/slidedefault/3.jpg" alt="commencez votre devis en ligne" /></li>
        </div>
      </div>

      <div id="preview_imag"></div>
      <div id="preview_imag2"></div>
      <div id="preview_imag3"></div>
      <div id="preview_imag4"></div>
      <div id="preview_imag5"></div>

  </div>

  <script type="text/javascript">
    // checkboxes livraison
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



    jQuery('#rush24').click(function() {
      if (document.getElementById('rush24').checked) {
        document.getElementById('tnt').checked = false;
        document.getElementById('fedex').checked = false;
      }
    });

    jQuery('#tnt').click(function() {
      if (document.getElementById('tnt').checked) {
        document.getElementById('rush24').checked = false;
        document.getElementById('fedex').checked = false;
      }
    });

    jQuery('#fedex').click(function() {
      if (document.getElementById('fedex').checked) {
        document.getElementById('rush24').checked = false;
        document.getElementById('tnt').checked = false;
      }
    });
  </script>

<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>
