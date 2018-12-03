<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne Roll-up</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(1, 'firstline-det1.jpg')"   @mouseout="hout(1)" v-tooltip.bottom="$global.firl" @click="reset(); selectProd('firstline');">
										<img :src="$global.img+'/roll-up/1first.png'" /><span>firstline</span>
									</div>
									<div @mouseover="hoPw(1,'2best.png')"    @mouseout="hout(1)" v-tooltip.bottom="$global.besl" @click="reset(); selectProd('bestline');">
										<img :src="$global.img+'/roll-up/2best.png'" /><span>bestline</span>
									</div>
									<div @mouseover="hoPw(1,'3lux.png')"     @mouseout="hout(1)" v-tooltip.bottom="$global.luxl" @click="reset(); selectProd('luxline');">
										<img :src="$global.img+'/roll-up/3lux.png'" /><span>luxline</span>
									</div>
									<div @mouseover="hoPw(1,'4double.png')"  @mouseout="hout(1)" v-tooltip.bottom="$global.dobl" @click="reset(); selectProd('double');">
										<img :src="$global.img+'/roll-up/4double.png'" /><span>double</span>
									</div>
									<div @mouseover="hoPw(1,'mini.png')"     @mouseout="hout(1)" v-tooltip.bottom="$global.mini" @click="reset(); selectProd('mini');">
										<img :src="$global.img+'/roll-up/mini.png'" /><span>mini</span>
									</div>
									<div @mouseover="hoPw(1,'6mistral.png')" @mouseout="hout(1)" v-tooltip.bottom="$global.mist" @click="reset(); selectProd('mistral');">
										<img :src="$global.img+'/roll-up/6mistral.png'" /><span>extérieur mistral</span>
									</div>
									<div @mouseover="hoPw(1,'visuel.png')"    @mouseout="hout(1)" v-tooltip.bottom="$global.visu" @click="reset(); selectProd('visuel');">
										<img :src="$global.img+'/roll-up/visuel.png'" /><span>remplacer visuel</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'60x160 cm');"  @mouseout="hout(9)"  @click="reset(); selectSize('60x160');"  v-show="best">
										<i class="fa fa-expand" aria-hidden="true"></i><span>60x160 cm</span>
									</div>
									<div @mouseover="hoPw(9,'60x200 cm');"  @mouseout="hout(9)"  @click="reset(); selectSize('60x200');"  v-show="best">
										<i class="fa fa-expand" aria-hidden="true"></i><span>60x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'80x200 cm');"  @mouseout="hout(9)"  @click="reset(); selectSize('80x200');"  v-show="best  || first || lux || double">
										<i class="fa fa-expand" aria-hidden="true"></i><span>80x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'85x200 cm');"  @mouseout="hout(9)"  @click="reset(); selectSize('85x200');"  v-show="best">
										<i class="fa fa-expand" aria-hidden="true"></i><span>85x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'100x200 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('100x200');" v-show="best || lux || double">
										<i class="fa fa-expand" aria-hidden="true"></i><span>100x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'120x200 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('120x200');" v-show="best || lux">
										<i class="fa fa-expand" aria-hidden="true"></i><span>120x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'150x200 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('150x200');" v-show="best || lux">
										<i class="fa fa-expand" aria-hidden="true"></i><span>150x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'200x200 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('200x200');" v-show="best || lux">
										<i class="fa fa-expand" aria-hidden="true"></i><span>200x200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'mini a4');"     @mouseout="hout(9)" @click="reset(); selectSize('A4');"      v-show="min">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Mini roll-up A4 (21x29cm)</span>
									</div>
									<div @mouseover="hoPw(9,'mini a3');"     @mouseout="hout(9)" @click="reset(); selectSize('A3');"      v-show="min">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Mini Roll-up A3 (29x42cm)</span>
									</div>
									<div @mouseover="hoPw(9,'80x200 1 visuel');"  @mouseout="hout(9)" @click="reset(); selectSize('80x200 1 visuel');"  v-show="mist">
										<i class="fa fa-expand" aria-hidden="true"></i><span>80x200 cm (Recto/verso 1 visuel)</span>
									</div>
									<div @mouseover="hoPw(9,'80x200 2 visuels');" @mouseout="hout(9)" @click="reset(); selectSize('80x200 2 visuels');" v-show="mist">
										<i class="fa fa-expand" aria-hidden="true"></i><span>80x200 cm (Recto/verso 2 visuels)</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="showSupp">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp" >
									<div @mouseover="hoPw(9,'bâche 440g');" @mouseout="hout(9)" v-tooltip.bottom="$global.b440" @click="reset(); selectSupport('440g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>bâche 440g</span>
									</div>
									<div @mouseover="hoPw(9,'bâche 450g M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.b450" @click="reset(); selectSupport('450 M1');" v-if="swRvd">
										<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
										<i class="fa fa-sticky-note fared" aria-hidden="true"></i><span>bâche 450g M1</span>
									</div>
									<div @mouseover="hoPw(9,'Dickson Jet 520 M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.b520" @click="reset(); selectSupport('jet 520 M1');" v-if="notfirst">
										<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
										<i class="fa fa-sticky-note fared" aria-hidden="true"></i><span>Dickson Jet 520 M1</span>
									</div>
									<div @mouseover="hoPw(9,'100% écologique M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.beco" @click="reset(); selectSupport('100% écologique M1');" v-if="notfirst && opeco">
										<div class="corneco"><i class="fa fa-leaf" aria-hidden="true"></i></div>
										<i class="fa fa-sticky-note fagreen" aria-hidden="true"></i><span>100% écologique M1</span>
									</div>
									<div @mouseover="hoPw(9,'Capotoile 320 M1 Ecocert');" @mouseout="hout(9)" v-tooltip.bottom="$global.capo" @click="reset(); selectSupport('capotoile');" v-if="notfirst && opcapo">
										<div class="corneco"><i class="fa fa-leaf" aria-hidden="true"></i></div>
										<i class="fa fa-sticky-note fagreen" aria-hidden="true"></i><span>Capotoile 320 M1 Ecocert</span>
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
									<label for="relais"><span class="noDisXS">Dépot en </span>Relais Colis</label>
									<input type="checkbox" id="relais" v-model="relais" @click="reset" @change="checkRelais" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.lre, offset: 5}"><i class="fa fa-question-circle"></i></span>
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
			<div class="helpMenu">
				<a :href="$global.url+'/aide-rollup/'" class="notice modal-link" title="aide produit">
					<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
				</a>
				<a :href="$global.url+'/notice-technique-roll-up/'" class="notice modal-link"  title="notices techniques">
					<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
				</a>
				<a :href="$global.url+'/gabarit-roll-up/'" class="notice modal-link"  title="gabarits maquette">
					<i class="fa fa-object-group" aria-hidden="true"></i> <span class="textHide">Gabarits</span>
				</a>
			</div>

			<div id="previewImg">

				<transition name="slideDown">
					<ul id="slides" v-if="slideContainer">
						<li><img :src="$global.img+'/roll-up/slide/rollup-5.jpg'" alt="roll-up pas cher" title="devis en ligne roll-up" /></li>
						<li><img :src="$global.img+'/roll-up/slide/rollup-4.jpg'" alt="kakemono roll-up" title="roll-up sur mesure" /></li>
						<li><img :src="$global.img+'/roll-up/slide/rollup-3.jpg'" alt="kakemono pas cher" title="kakemonos rollups promo" /></li>
						<li><img :src="$global.img+'/roll-up/slide/rollup-0.jpg'" alt="roll-up pas cher" title="devis en ligne roll-up" /></li>
						<li><img :src="$global.img+'/roll-up/slide/rollup-1.jpg'" alt="kakemono roll-up" title="roll-up sur mesure" /></li>
						<li><img :src="$global.img+'/roll-up/slide/rollup-2.jpg'" alt="kakemono pas cher" title="kakemonos rollups promo" /></li>
						<li><img :src="$global.img+'/banderole/slide/devis-en-ligne.png'" alt="commencez votre devis en ligne" title="devis impression grand format" /></li>
					</ul>
				</transition>

				<transition name="slideDown"><div class="preview_imag0" :style="bg0" v-show="pr0"></div></transition>
				<transition name="slideLeft" mode="out-in">
					<div class="preview_imag1" :style="bg1" v-show="pr1" >
						<video v-show="calqueVideo" width="100%" height="auto" ref="vidElm">
							<source :src="this.$global.img+'/roll-up/rollupmini.mp4'" type="video/mp4">
						</video>
						<img   v-show="calqueImage" :src="detImg" alt="détail rollup" id="zoomImg" style="cursor: zoom-in" />
					</div>
				</transition>
				<transition name="slideLeft"><div class="preview_imag2" :style="bg2" v-show="pr2"></div></transition>
				<transition name="slideLeft"><div class="preview_imag3" :style="bg3" v-show="pr3"></div></transition>
				<transition name="slideLeft"><div class="preview_imag4" :style="bg4" v-show="pr4"></div></transition>
				<transition name="slideLeft"><div class="preview_imag5" :style="bg5" v-show="pr5"></div></transition>
				<transition name="slideLeft"><div class="preview_imagH" :style="bgH" v-show="prH">
					<p v-show="calqueTexte"><span>{{ calqueContent }}</span></p>
				</div></transition>

				<div class="imgBar" v-show="selectFirst">
					<img :src="$global.img+'/roll-up/'+produit+'-det1.jpg'" alt="" @mouseover="selectImg('det1')">
					<img :src="$global.img+'/roll-up/'+produit+'-detv.jpg'" alt="" @mouseover="selectImg('detv')">
					<img :src="$global.img+'/roll-up/'+produit+'-det2.jpg'" alt="" @mouseover="selectImg('det2')">
					<img :src="$global.img+'/roll-up/'+produit+'-det3.jpg'" alt="" @mouseover="selectImg('det3')">
					<img :src="$global.img+'/roll-up/'+produit+'-det4.jpg'" alt="" @mouseover="selectImg('det4')">
				</div>

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
							<input type="hidden" name="hauteur"   v-model="hauteur" />
							<input type="hidden" name="largeur"   v-model="largeur" />
							<input type="hidden" name="reference" v-model="prodref" />

							<button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button>
						</form>
					</transition>

					<transition name="slideDown">
						<div class="formError" :class="errorColor" v-html="errorMessage" v-show="formError" :key="errorTrigger"></div>
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
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=3.0"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/test-roll-up.vue.js?v=3.0"></script>
