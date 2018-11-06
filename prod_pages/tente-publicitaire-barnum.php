<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne tente publicitaire</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(2,'Blanc1')" @mouseout="hout(2)" v-tooltip.bottom="$global.tent" @click="reset(); selectProd('Blanc');">
										<img :src="$global.img+'/tente/Blanc1.png'" /><span>Blanc</span>
									</div>
									<div @mouseover="hoPw(2,'Noir1')"  @mouseout="hout(2)" v-tooltip.bottom="$global.tent" @click="reset(); selectProd('Noir');">
										<img :src="$global.img+'/tente/Noir1.png'" /><span>Noir</span>
									</div>
									<div @mouseover="hoPw(2,'Rouge1')" @mouseout="hout(2)" v-tooltip.bottom="$global.tent" @click="reset(); selectProd('Rouge');">
										<img :src="$global.img+'/tente/Rouge1.png'" /><span>Rouge</span>
									</div>
									<div @mouseover="hoPw(2,'Bleu1')"  @mouseout="hout(2)" v-tooltip.bottom="$global.tent" @click="reset(); selectProd('Bleu');">
										<img :src="$global.img+'/tente/Bleu1.png'" /><span>Bleu</span>
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
									<div @mouseover="hoTx(3,'2m','2x2 m');"  @mouseout="hout(3)" @click="reset(); selectSize('2x2');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Tente 2x2 m</span>
									</div>
									<div @mouseover="hoTx(3,'2m','2x3 m');"  @mouseout="hout(3)" @click="reset(); selectSize('2x3');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Tente 2x3 m</span>
									</div>
									<div @mouseover="hoTx(3,'3m','3x3 m');"  @mouseout="hout(3)" @click="reset(); selectSize('3x3');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Tente 3x3 m</span>
									</div>
									<div @mouseover="hoTx(3,'3m','3x4.5 m');"@mouseout="hout(3)" @click="reset(); selectSize('3x4');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Tente 3x4.5 m</span>
									</div>
									<div @mouseover="hoTx(3,'3m','3x6 m');"  @mouseout="hout(3)" @click="reset(); selectSize('3x6');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Tente 3x6 m</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showMurs">

							<button type="button" class="toggle" :class="reqMurs" @click="toggleMurs = !toggleMurs">
								{{ choixMurs }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleMurs">

									<div @mouseover="hoPw(4,produit+'-b')"  @mouseout="hout(4)"  v-tooltip.bottom="$global.mur1" @click="reset(); selectMurs('1x Demi-mur','b');">
										<img :src="$global.img+'/tente/'+produit+'-b.png'" /><span>1 Demi-mur supplémentaire</span>
									</div>
									<div @mouseover="hoPw(4,produit+'-bb')" @mouseout="hout(4)"  v-tooltip.bottom="$global.mur1" @click="reset(); selectMurs('2x Demi-mur','bb');">
										<img :src="$global.img+'/tente/'+produit+'-bb.png'" /><span>2 Demi-murs supplémentaires</span>
									</div>
									<div @mouseover="hoPw(4,produit+'-a')"  @mouseout="hout(4)"  v-tooltip.bottom="$global.mur2" @click="reset(); selectMurs('1x Mur sup','a');">
										<img :src="$global.img+'/tente/'+produit+'-a.png'" /><span>1 Mur supplémentaire</span>
									</div>
									<div @mouseover="hoPw(4,produit+'-aa')"  @mouseout="hout(4)" v-tooltip.bottom="$global.mur2" @click="reset(); selectMurs('2x Mur sup','aa');">
										<img :src="$global.img+'/tente/'+produit+'-aa.png'" /><span>2 Murs supplémentaires</span>
									</div>
									<div @mouseover="hoPw(4,produit+'-ab')" @mouseout="hout(4)"  v-tooltip.bottom="$global.mur3" @click="reset(); selectMurs('1x Mur sup + 1x Demi-mur','ab');">
										<img :src="$global.img+'/tente/'+produit+'-ab.png'" /><span>1 Mur + 1 Demi-mur</span>
									</div>
									<div @mouseover="hoPw(1,'')" @mouseout="hout(1)" v-tooltip.bottom="$global.murx" @click="reset(); selectMurs('sans mur','x');">
										<i class="fa fa-times" aria-hidden="true"></i><span>Supprimer le mur de fond</span>
									</div>
									<div @mouseover="hoPw(4,'')" @mouseout="hout(4)" v-tooltip.bottom="$global.murf" @click="reset(); selectMurs('sans option','fd');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>Sans option</span>
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
									<div @mouseover="hoPw(3,'print-x')"   @mouseout="hout(3)" v-tooltip.bottom="$global.pfro" @click="reset(); selectPrint('Fronton');">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Fronton</span>
									</div>

									<div @mouseover="hoPw(3,'print-fd')"  @mouseout="hout(3)" v-tooltip.bottom="$global.pmfd" @click="reset(); selectPrint('Mur de fond');" v-if="bgwall">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Mur de fond</span>
									</div>
									<div @mouseover="hoDb(3,'print-fd',5,'print-'+murs);" @mouseout="hout(3);" v-tooltip.bottom="$global.pmdm" @click="reset(); selectPrint('Murs et demi-murs');"  v-if="walls">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Mur(s) et demi-mur(s)</span>
									</div>
									<div @mouseover="hoDb(3,'print-fd',5,'print-'+murs,'print-x');" @mouseout="hout(3);" v-tooltip.bottom="$global.pful" @click="reset(); selectPrint('Full Graphic');" v-if="bgwall">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Full Graphic</span>
									</div>

									<div @mouseover="hoPw(3,'print-fd')"   @mouseout="hout(3)" v-tooltip.bottom="$global.gmfd" @click="reset(); selectPrint('Mur de fond R/V');" v-if="bgwall">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Mur de fond Int/Ext</span>
									</div>
									<div @mouseover="hoDb(3,'print-fd',5,'print-'+murs);" @mouseout="hout(3);" v-tooltip.bottom="$global.gmdm" @click="reset(); selectPrint('Murs et demi-murs R/V');" v-if="walls">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Mur(s) et demi-mur(s) Int/Ext</span>
									</div>
									<div @mouseover="hoDb(3,'print-fd',5,'print-'+murs,'print-x');" @mouseout="hout(3);" v-tooltip.bottom="$global.gful" @click="reset(); selectPrint('Full Graphic R/V');" v-if="bgwall">
										<i class="fa fa-paint-brush" aria-hidden="true"></i><span>Full Graphic Int/Ext</span>
									</div>

									<div @mouseover="hoPw(3,'')" @mouseout="hout(3)" v-tooltip.bottom="$global.pnop" @click="reset(); selectPrint('Pas de personnalisation');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>Pas d'impression</span>
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
									<!--<div @mouseover="hoPw(9,'maquette en ligne');" @mouseout="hout(9)" v-tooltip.bottom="$global.enl" @click="reset(); selectMaqt('maquette en ligne');">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span class="smalls">je crée ma maquette en ligne</span>
									</div>-->
									<div @mouseover="hoPw(9,'maquette france banderole');" @mouseout="hout(9)" v-tooltip.bottom="$global.mfb2" @click="reset(); selectMaqt('mise en page france banderole');">
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
									<button type="button" v-model="delaiprod" class="dclic desactive" :class="btnP3">
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
				<a :href="$global.url+'/aide-tente-publicitair/'" class="notice modal-link" title="aide produit">
					<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
				</a>
				<a :href="$global.url+'/notice-technique-tente-publicitaire/'" class="notice modal-link"  title="notices techniques">
					<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
				</a>
				<a :href="$global.url+'/gabarit-tente-publicitaire/'" class="notice modal-link"  title="gabarits maquette">
					<i class="fa fa-object-group" aria-hidden="true"></i> <span class="textHide">Gabarits</span>
				</a>
			</div>

			<div id="previewImg">

				<transition name="slideDown">
					<ul id="slides" v-if="slideContainer">

			      <li><img :src="$global.img+'/tente/slide/tente-barnum-0.jpg'" alt="tente forum association" title="tente pub économique" /></li>
						<li><img :src="$global.img+'/tente/slide/tente-barnum-4.jpg'" alt="tente forum association" title="tente pub économique" /></li>
			      <li><img :src="$global.img+'/tente/slide/tente-barnum-1.jpg'" alt="tente publicitaire pas cher" title="tente pub économique" /></li>
			      <li><img :src="$global.img+'/tente/slide/tente-barnum-3.jpg'" alt="tente barnum pas cher" title="barnum bas prix" /></li>
			      <li><img :src="$global.img+'/tente/slide/tente-barnum-2.jpg'" alt="barnum tente plublicitaire pas cher" title="tente publicitaire discount" /></li>
			      <li><img :src="$global.img+'/banderole/slide/devis-en-ligne'.png" alt="commencez votre devis en ligne" title="devis impression grand format" /></li>
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
							<input type="hidden" name="hauteur"   v-model="hauteur" />
							<input type="hidden" name="largeur"   v-model="largeur" />
							<input type="hidden" name="reference" v-model="prodref" />

							<button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button>
						</form>
					</transition>

					<transition name="slideDown">
						<div class="formError" :class="errorColor" v-html="errorMessage" v-show="formError" :key="errorTrigger"></div>
					</transition>

				</div>
			</div> <!-- fin bloc estimation -->
		</div>  <!-- fin bloc image #previewContainer -->

	</div>
</div> <!-- fin bloc app  -->

<!--<script src="../wp-content/plugins/fbshop/js/vue.js"></script>-->
<script src="../wp-content/plugins/fbshop/js/vue.min.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.5"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.tente.js?v=2.7"></script>
