<div id="buying">
<form class="jotform-form" action="" method="post" name="form_1060900217" id="1060900217" accept-charset="utf-8" onsubmit="JKakemono.cal_eclairage(); return false;">
    <div class="form-all">
    <ul class="form-section">
            <li class="form-line" id="id_1">Taille:
                    <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="130-200cm">130 à 200cm</option>
						<option value="201-300cm">201 à 300cm </option>
						<option value="300-399cm">300 à 399cm </option>
						<option value="400-499cm">400 à 499cm </option>
						<option value="500-599cm">500 à 599cm </option>
						<option value="600-699cm">600 à 699cm </option>
                    </select>
            </li>
			<li class="form-line" id="id_2">Couleur structure:
                    <select class="form-dropdown validate[required]" id="input_2" name="q2_usage" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="blanc">standard (blanc)</option>
						<option value="rouge">rouge</option>
                        <option value="jaune">jaune</option>
						<option value="vert">vert</option>
						<option value="orange">orange</option>
						<option value="bleu">bleu</option>
						<option value="noir">noir</option>
                    </select>
            </li>

			
			
			
			 <li class="form-line" id="id_4">
Quantité:
                    <input type="text" class="form-textbox validate[required, Numeric]" style="width:30px" id="input_4" name="q4_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); " />
            </li>
			
            
            <li id="id_7" class="form-line optionsformline">
				<span class="title">OPTIONS COMPLEMENTAIRES DISPONIBLES :</span>
				<span class="options_single">
	
                
				<span class="options_single">
					<span class="optionsleft"><label class="form-label-left" id="label_etiquette" for="etiquette">Retrait Colis a L\'Atelier</label><input type="checkbox" class="form-checkbox" id="etiquette" name="etiquette[]" value="" onchange="JKakemono.czyscpola(); " /><span class="helpButton" onmouseover="pokazt(\'helpTextetiquette\');" onmouseout="ukryjt(\'helpTextetiquette\');"><span class="helpText" id="helpTextetiquette" style="visibility:hidden;">Retrait de votre commande à l\'atelier de Vitrolles. Vos frais de port seront supprimés de votre devis avant votre paiement.</span></span></span>
				</span>

                    <div class="nothing" style="width: 376px; height: 1px; border-bottom: 1px solid #9FA3A8; display: inline-block; margin-top: 5px;" />
                    <span class="options_single" style="margin-top: 14px;">
                        <span class="optionsleft" style="border: 1px solid #9FA3A8; font-weight: bold; width: 48%;">
                            <img src="/img/star2.png" alt="fedex" style="width: 16px; padding: 2px; display: inline-block; float: left;" />
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
			
			
			
			 <li class="form-line" id="id_26a">
                <div class="form-input-wide">
                <div id="form-button-error2"></div>
                        <button id="input_26" type="submit" class="form-submit-button">Submit Form</button>
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
<div id="previewe_con">
<div id="preview">
<span id="preview_name">ECLAIRAGE sélectionné:</span>
<div id="preview_imag"></div><div id="preview_info"><div id="preview_info_title"></div><ul id="preview_info_ul"><li style="display:none"></li></ul></div>
</div>
<script type='text/javascript' src='/wp-content/plugins/fbshop/prod_pages/gestion_checkbox_expedition.js'></script>
