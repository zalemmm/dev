<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne akilux 5mm</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoTx(1,'enseigne-impression-standard','impression Directe UV Standard')" @mouseout="hout(9)" v-tooltip.bottom="$global.fxsd" @click="reset(); selectProd('standard');">
										<img :src="$global.img+'/enseignes/dibond.svg'" /><span>Directe UV Standard</span>
									</div>
									<div @mouseover="hoTx(1,'enseigne-impression-uv-hd','impression Directe uv hd')" @mouseout="hout(9)" v-tooltip.bottom="$global.fxhd" @click="reset(); selectProd('uv hd');">
										<img :src="$global.img+'/enseignes/dibond.svg'" /><span>Directe UV HD</span>
									</div>
									<div @mouseover="hoTx(1,'enseigne-impression-photo-hd','impression photo hd')" @mouseout="hout(9)" v-tooltip.bottom="$global.fxph" @click="reset(); selectProd('photo hd');">
										<img :src="$global.img+'/enseignes/dibond.svg'" /><span>Photo HD</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showPrint">

							<button type="button" class="toggle" :class="reqPrint" @click="togglePrint = !togglePrint">
								{{ choixPrint }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="togglePrint">

									<div @mouseover="hoPw(9,'Recto')"       @mouseout="hout(9)" @click="reset(); selectPrint('Recto')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Recto</span>
									</div>
									<div @mouseover="hoPw(9,'Recto/Verso')" @mouseout="hout(9)" @click="reset(); selectPrint('Recto/Verso')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Recto/Verso</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showOpts">

							<button type="button" class="toggle" :class="reqOpts" @click="toggleOpts = !toggleOpts">
								{{ choixOpts }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleOpts">
									<div @mouseover="hoPw(9,'sans option');" @mouseout="hout(9)" @click="reset(); selectOpts('sans option');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>pas de fixations</span>
									</div>
									<div @mouseover="hoPw(9,'oeillets');"    @mouseout="hout(9)" v-tooltip.bottom="$global.oeil" @click="reset(); selectOpts('oeillets');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>oeillets nickels</span>
									</div>
									<div @mouseover="hoPw(9,'crochets');"    @mouseout="hout(9)" v-tooltip.bottom="$global.croc" @click="reset(); selectOpts('crochets');">
										<i class="fa fa-quote-right fa-rotate-90" aria-hidden="true"></i><span>crochets invisbles</span>
									</div>
									<div @mouseover="hoPw(9,'rislans');"     @mouseout="hout(9)" v-tooltip.bottom="$global.risl" @click="reset(); selectOpts('rislans');">
										<img :src="$global.img+'/fixation/rislan.svg'" /><span>rislans</span>
									</div>
									<div @mouseover="hoPw(9,'double face');" @mouseout="hout(9)" v-tooltip.bottom="$global.tape" @click="reset(); selectOpts('double face');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>double face (4 adhésifs)</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="showPers">

							<button type="button" class="toggle" :class="reqPers" @click="togglePers = !togglePers">
								{{ choixPers }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="togglePers" >

									<div @mouseover="hoPw(9,'2 '+choixOpts);"  @mouseout="hout(9)" @click="reset(); selectPers('2');">
										<img :src="$global.img+'/fixation/rislan.svg'" v-if="rislans" /><i class="fa" :class="faicon" aria-hidden="true" v-else></i><span>2 {{choixOpts}}</span>
									</div>
									<div @mouseover="hoPw(9,'4 '+choixOpts);"  @mouseout="hout(9)" @click="reset(); selectPers('4');">
										<img :src="$global.img+'/fixation/rislan.svg'" v-if="rislans" /><i class="fa" :class="faicon" aria-hidden="true" v-else></i><span>4 {{choixOpts}}</span>
									</div>
									<div @mouseover="hoPw(9,'6 '+choixOpts);"  @mouseout="hout(9)" @click="reset(); selectPers('6');">
										<img :src="$global.img+'/fixation/rislan.svg'" v-if="rislans" /><i class="fa" :class="faicon" aria-hidden="true" v-else></i><span>6 {{choixOpts}}</span>
									</div>
									<div @mouseover="hoPw(9,'8 '+choixOpts);"  @mouseout="hout(9)" @click="reset(); selectPers('8');">
										<img :src="$global.img+'/fixation/rislan.svg'" v-if="rislans" /><i class="fa" :class="faicon" aria-hidden="true" v-else></i><span>8 {{choixOpts}}</span>
									</div>
									<div @mouseover="hoPw(9,'10 '+choixOpts);" @mouseout="hout(9)" @click="reset(); selectPers('10');">
										<img :src="$global.img+'/fixation/rislan.svg'" v-if="rislans" /><i class="fa" :class="faicon" aria-hidden="true" v-else></i><span>10 {{choixOpts}}</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showRain">

							<button type="button" class="toggle" :class="reqRain" @click="toggleRain = !toggleRain">
								{{ choixRain }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleRain">
									<div @mouseover="hoPw(1,'base');"  @mouseout="hout(1)" v-tooltip.bottom="$global.rai1+$global.rain" @click="reset(); selectRain('sans rainage','');">
										<i class="fa fa-ban"></i><span>sans rainage</span>
									</div>
									<div @mouseover="hoPw(1,'base1');" @mouseout="hout(1)" v-tooltip.bottom="$global.rai1+$global.rain" @click="reset(); selectRain('1 rainage',1);">
										<img :src="$global.img+'/akilux/base1.png'" /><span>1 rainage par panneau</span>
									</div>
									<div @mouseover="hoPw(1,'base2');" @mouseout="hout(1)" v-tooltip.bottom="$global.rai2+$global.rain" @click="reset(); selectRain('2 rainages',2);">
										<img :src="$global.img+'/akilux/base2.png'" /><span>2 rainages par panneau</span>
									</div>
									<div @mouseover="hoPw(1,'base3');" @mouseout="hout(1)" v-tooltip.bottom="$global.rai3+$global.rain" @click="reset(); selectRain('3 rainages',3);">
										<img :src="$global.img+'/akilux/base3.png'" /></i><span>3 rainages par panneau</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" id="id_maquette" v-show="showMaqt">

							<button type="button" class="toggle" :class="reqMaqt" @click="toggleMaqt = !toggleMaqt">
								{{ choixMaqt }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleMaqt" >
									<div @mouseover="hoPw(9,'sans BAT');" @mouseout="hout(9)" v-tooltip.bottom="$global.btn" @click="reset(); selectMaqt('maquette client sans bat');">
										<i class="bat"><strike>BAT</strike></i> <span class="smalls">j’envoie mon fichier, je ne veux pas de BAT</span>
									</div>
									<div @mouseover="hoPw(9,'BAT numérique');" @mouseout="hout(9)" v-tooltip.bottom="$global.bty" @click="reset(); selectMaqt('maquette client bat');">
										<i class="bat">BAT</i> <span class="smalls">j’envoie mon fichier, je veux un BAT</span>
									</div>
									<div @mouseover="hoPw(9,'maquette en ligne');" @mouseout="hout(9)" v-tooltip.bottom="$global.enl" @click="reset(); selectMaqt('maquette en ligne');">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="smalls">je crée ma maquette en ligne</span>
									</div>
									<div @mouseover="hoPw(9,'maquette france banderole');" @mouseout="hout(9)" v-tooltip.bottom="$global.mfb" @click="reset(); selectMaqt('mise en page france banderole');">
										<i class="fa fa-paint-brush" aria-hidden="true"></i> <span class="smalls">mise en page par france banderole</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" id="id_signature" v-show="showSign">

							<button type="button" class="toggle" :class="reqSign" @click="toggleSign = !toggleSign">
								{{ choixSign }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSign" >
									<div @mouseover="hoPw(9,'signature france banderole');" @mouseout="hout(9)" v-tooltip.bottom="$global.psi" @click="reset(); selectSign('signature France Banderole');">
										<i class="fa fa-pencil" aria-hidden="true"></i><span>produit signé</span>
									</div>
									<div @mouseover="hoPw(9,'sans signature');" @mouseout="hout(9)" v-tooltip.bottom="$global.pne" @click="reset(); selectSign('sans signature');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>produit neutre</span>
									</div>
								</div>
							</transition>

						</li>
					</ul> <!-- fin listes déroulantes -->

					<ul class="optionsBlock" v-show="showOptions">

						<li class="optLi optQuantite">

							<div class="qteContainer" :class="reqQtte">
								<label class="qteLabel" :class="reqQtte">quantité <span class="small">(par visuel)</span></label>
								<input type="number" min="1" class="qteInput" v-model="qte" @keyup.up="qtePlus" @keyup.down="qteMoins" @click="reset"  />

								<div class="qteBtn" :class="reqQtte">
									<button type="button" @click="reset(); qteMoins();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
									<button type="button" @click="reset(); qtePlus();"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
								</div>
							</div>

						</li>

						<li class="optLi optSize" v-show="optionSize">
							<div class="sizeContainer" :class="reqHaut">
								<label class="sizeLabel" :class="reqHaut">hauteur <span class="small">(en cm)</span></label>
								<input type="text" placeholder="ex: 150" class="sizeInput" v-model.number="hauteur" @click="reset" @keyup="checkSize('hauteur', $event.target.value)"/>
							</div>

							<div class="sizeContainer" :class="reqLarg">
								<label class="sizeLabel" :class="reqLarg">largeur <span class="small">(en cm)</span></label>
								<input type="text" placeholder="ex: 80" class="sizeInput" v-model.number="largeur" @click="reset" @keyup="checkSize('largeur', $event.target.value)"/>
							</div>
						</li>

						<transition name="slideLeft"><li class="formSelect fieldError" v-show="showEsize">{{ errorSize }}</li></transition>

						<li class="optLi optionLivraison">

							<h5 class="optionsTitle">OPTIONS DE LIVRAISON <span class="noDisXS">DISPONIBLES :</span> </h5>

							<div class="optionsCheck">

								<span class="optCheck">
									<label for="adresse">Livré à votre adresse</label>
									<input type="checkbox" id="adresse" v-model="adresse" @click="reset" @change="checkAdresse" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.lad, offset: 5}"><i class="fa fa-question-circle"></i></span>
								</span>

								<span class="optCheck">
									<label for="etiquette">Retrait <span class="noDisXS">colis à l'</span>atelier</label>
									<input type="checkbox" id="etiquette" v-model="atelier" @click="reset" @change="checkAtelier"/>
									<span  class="opHelp" v-tooltip.bottom="{content: $global.lat, offset: 5}"><i class="fa fa-question-circle"></i></span>
							  </span>

								<span class="optCheck">
									<label for="relais">Grand format livré entier</label>
									<input type="checkbox" id="relais" v-model="palette" @click="reset" @change="checkPalette" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.gfe, offset: 5}"><i class="fa fa-question-circle"></i></span>
							  </span>

								<span class="optCheck">
									<label for="colis">Colis revendeur</label>
									<input type="checkbox" id="colis" v-model="colis" @click="reset" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.crv, offset: 5}"><i class="fa fa-question-circle"></i></span>
							  </span>

							</div> <!-- fin bloc check options -->


							<div class="delaisBloc">

								<h5 class="delaisTitle"><span class="noDisXS">choisir un </span>délai de Production :</h5>
								<div class="delaisBtn">
									<button type="button" v-model="delaiprod" class="dclic" :class="btnP1" @click="reset(); selectDeliv('4-5');">
										Normal 4/5 jours
									</button>
									<button type="button" v-model="delaiprod" class="dclic" :class="btnP2" @click="reset(); selectDeliv('2-3');">
										Rapide 2/3 jours
									</button>
									<button type="button" v-model="delaiprod" class="dclic" :class="btnP3" @click="reset(); selectDeliv('1-1');">
										Express 1 jour
									</button>
								</div>

								<transition name="slideDown">
									<div class="delaisBloc" v-show="showLiv">
										<h5 class="delaisTitle"><span class="noDisXS">choisir un </span>délai de Livraison :</h5>
										<div class="delaisBtn">
											<button type="button" v-model="delailiv" class="dclic" :class="btnD1" @click="calculer('3-4'); dateEstim();">
												Normal 3/4 jours
											</button>
											<button type="button" v-model="delailiv" class="dclic" :class="btnD2" @click="calculer('2-3'); dateEstim();">
												Rapide 2/3 jours
											</button>
											<button type="button" v-model="delailiv" class="dclic" :class="btnD3" @click="calculer('1-1'); dateEstim();">
												Express 1 jour
											</button>
										</div>
									</div>
								</transition>

							</div> <!-- fin bloc boutons délais -->
						</li> <!-- fin options livraison -->
					</ul> <!-- fin bloc options -->
				</div> <!-- fin wrapper form -->

			</form>

			<div v-if="choix"> <!-- debug -->
				<span v-html="inputDesc"></span>
			</div>

			<transition name="slideLeft">
				<div class="delivBlock" v-show="dateLivraison" :key="dateTrigger">
					<span class="delivDate">
						Livraison prévue avant le {{ estdate }}
						<a class="linkUppercase modal-link" :href="$global.url+'/etre-livre-rapidement/'" target="_blank"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
					</span>
				</div>
			</transition>

		</div> <!-- fin bloc formulaire #buying -->

		<!--bloc preview-->
		<div class="column" id="previewContainer">
			<div id="previewImg">

				<transition name="slideDown">
					<ul id="slides" v-if="slideContainer">
						<li><img :src="$global.img+'/akilux/slide/test-1.jpg'" alt="commencez votre devis en ligne" /></li>
			      <li><img :src="$global.img+'/akilux/slide/test-2.jpg'" alt="commencez votre devis en ligne" /></li>
			     	<li><img :src="$global.img+'/banderole/slide/test-3.png'" alt="commencez votre devis en ligne" /></li>
					</ul>
				</transition>

				<transition name="slideDown"><div class="preview_imag0" :style="bg0" v-show="pr0"></div></transition>
				<transition name="slideLeft"><div class="preview_imag1" :style="bg1" v-show="pr1"></div></transition>
				<transition name="slideLeft"><div class="preview_imag2" :style="bg2" v-show="pr2"></div></transition>
				<transition name="slideLeft"><div class="preview_imag3" :style="bg3" v-show="pr3"></div></transition>
				<transition name="slideLeft"><div class="preview_imag4" :style="bg4" v-show="pr4"></div></transition>
				<transition name="slideLeft"><div class="preview_imag5" :style="bg5" v-show="pr5"></div></transition>
				<transition name="slideLeft"><div class="preview_imagH" :style="bgH" v-show="prH">
					<p v-show="calqueTexte"><span>{{ calqueContent }}</span></p>
				</div></transition>

			</div>



			<div id="estimation" :class="reqEstm">

				<div id="estimationTitre" :class="reqEstm">
					<span class="estimationData">PRIX UNITAIRE</span>
					<span class="estimationData">OPTION</span>
					<span class="estimationData">TOTAL H.T.</span>
				</div>
				<div id="estimationPrix">
					<span class="estimationData" id="prix_unitaire">{{ prixUnit   }} </span>
					<span class="estimationData" id="option">       {{ prixOption }} </span>
					<span class="estimationData" id="total">        {{ prixTotal  }} </span>
				</div>

				<div id="estimationInfos">
					<div id="livraisonrapide" v-show="livraisonrapide">
						<img :src="$global.img+'/livraison_rapide/liv-rapide.jpg'" alt="Impression et livraison le jour meme !" title="Imprimer et livrer le jour-même"/>
					</div>

					<div id="livraisonComp" v-show="livraisonComp">
						<span id="forfait">{{ forfait }}</span>
						<span v-html="message"></span>
					</div>

					<transition name="slideDown">
						<form name="cartData" id="cartData" action="../votre-panier/" method="post" v-show="ajoutPanier">
							<input type="hidden" name="addtocart" value="addtocart" />
							<input type="hidden" name="rodzaj"    v-model="inputProd" />
							<input type="hidden" name="opis"      v-model="inputDesc" />
							<input type="hidden" name="ilosc"     v-model="inputQte" />
							<input type="hidden" name="prix"      v-model="inputPrix" />
							<input type="hidden" name="option"    v-model="inputOption" />
							<input type="hidden" name="remise"    v-model="inputRemise" />
							<input type="hidden" name="total"     v-model="inputTotal" />
							<input type="hidden" name="transport" v-model="inputTransport" />
							<input type="hidden" name="hauteur"   v-model="inputHauteur" />
							<input type="hidden" name="largeur"   v-model="inputLargeur" />
							<input type="hidden" name="reference" v-model="prodref" />

							<button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button>
						</form>
					</transition>

					<transition name="slideDown">
						<div class="formError" v-html="errorMessage" v-show="formError" :key="errorTrigger"></div>
					</transition>
					<transition name="slideDown">
						<div class="formWarng" v-html="warngMessage" v-show="formWarng" :key="warngTrigger"></div>
					</transition>

				</div>
			</div>
		</div>  <!-- fin bloc image #previewContainer -->

	</div>
</div> <!-- fin bloc app  -->

<!--<script src="../wp-content/plugins/fbshop/js/vue.js"></script>-->
<script src="../wp-content/plugins/fbshop/js/vue.min.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.6"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.akilux5.js?v=2.6"></script>
