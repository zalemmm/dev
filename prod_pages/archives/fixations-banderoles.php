<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne fixations banderole</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect" v-show="showFixx">

							<button type="button" class="toggle" :class="reqFixx" @click="toggleFixx = !toggleFixx">
								{{ choixFixx }} {{ choixFxqt }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFixx">
									<div @mouseover="hoPw(5,'tendeur')"    @mouseout="hout(5)" @click="reset(); selectFixx('tendeurs');">
										<img :src="$global.img+'/fixation/tendeur.svg'" /><span>tendeurs</span>
									</div>
									<div @mouseover="hoPw(5,'rislan')"     @mouseout="hout(5)" @click="reset(); selectFixx('rislans');">
										<img :src="$global.img+'/fixation/rislan.svg'" /><span>rislans</span>
									</div>
									<div @mouseover="hoPw(5,'tourillons')" @mouseout="hout(5)" @click="reset(); selectFixx('2 tourillons bois et sandows');">
										<img :src="$global.img+'/fixation/tourillon.svg'" /></i><span>2 tourillons + sandows</span>
									</div>
									<div @mouseover="hoPw(5,'piquets')"    @mouseout="hout(5)" @click="reset(); selectFixx('2 piquets de bois');">
										<img :src="$global.img+'/fixation/piquet.svg'" /></i><span>2 piquets de bois</span>
									</div>
									<div @mouseover="hoPw(5,'drissep')"    @mouseout="hout(5)" @click="reset(); selectFixx('drisse perimetrique');">
										<img :src="$global.img+'/banderole/drissed.png'" /><span>drisse perimetrique</span>
									</div>
									<div @mouseover="hoPw(5,'drisse')"     @mouseout="hout(5)" @click="reset(); selectFixx('drisse fourreaux H/B');">
										<img :src="$global.img+'/fixation/drisse.svg'" /><span>drisse fourreaux H/B</span>
									</div>
								</div>
							</transition>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFxqt">
									<div @click="reset(); selectFxqt(4);">
										<img :src="tendORrisl" /><span>4</span>
									</div>
									<div @click="reset(); selectFxqt('6');">
										<img :src="tendORrisl" /><span>6</span>
									</div>
									<div @click="reset(); selectFxqt('8');">
										<img :src="tendORrisl" /></i><span>8</span>
									</div>
									<div @click="reset(); selectFxqt('10');">
										<img :src="tendORrisl" /></i><span>10</span>
									</div>
									<div @click="reset(); selectFxqt('14');">
										<img :src="tendORrisl" /></i><span>14</span>
									</div>
									<div @click="reset(); selectFxqt('18');">
										<img :src="tendORrisl" /></i><span>18</span>
									</div>
									<div @click="reset(); selectFxqt('24');">
										<img :src="tendORrisl" /></i><span>24</span>
									</div>
									<div @click="reset(); selectFxqt('30');">
										<img :src="tendORrisl" /></i><span>30</span>
									</div>
								</div>
							</transition>
						</li>

					</ul>

					<ul class="optionsBlock" v-show="showOptions">

						<li class="optLi optQuantite" v-show="typeQte">
							<div class="qteContainer" :class="reqQtte">
								<label class="qteLabel" :class="reqQtte">quantité <span class="small" v-show="piquets">(par paire)</span></label>
								<input type="number" min="1" class="qteInput" v-model="qte" @keyup.up="qtePlus" @keyup.down="qteMoins" @click="reset"  />

								<div class="qteBtn" :class="reqQtte">
									<button type="button" @click="reset(); qteMoins();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
									<button type="button" @click="reset(); qtePlus();"> <i class="fa fa-plus-circle"  aria-hidden="true"></i></button>
								</div>
							</div>
						</li>

						<li class="optLi optQuantite" v-show="drisse">
							<div class="qteContainer" :class="reqHaut">
								<label class="sizeLabel" :class="reqHaut">longueur <span class="small">(en mètres)</span></label>
								<input type="text" placeholder="ex: 0.85" class="sizeInput" v-model.number="hauteur" @click="reset" @keyup="checkSize('hauteur', $event.target.value)"/>
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
									<label for="relais"><span class="noDisXS">Dépot en </span>Relais Colis</label>
									<input type="checkbox" id="relais" v-model="relais" @click="reset" @change="checkRelais" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.lre, offset: 5}"><i class="fa fa-question-circle"></i></span>
							  </span>

								<span class="optCheck">
									<label for="colis">Colis revendeur</label>
									<input type="checkbox" id="colis" v-model="colis" @click="reset" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.crv, offset: 5}"><i class="fa fa-question-circle"></i></span>
							  </span>

								<span class="optCheck high" v-show="showRoll">
									<label for="roll">Livrée roulée</label>
									<input type="checkbox" id="roll" v-model="roll" @click="reset"  @change="checkRoll" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.roll, offset: 5}"><i class="fa fa-question-circle"></i></span>
							  </span>

							</div>

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
				<span>- produit : {{ produit }}</span><br />
				<span>- dimensions : {{ dimensions }}</span><br />
				<span>- support : {{ support }} </span><br />
				<span>- maquette : {{ maquette }} </span><br />
				<span>- signature : {{ sign }} </span><br />
				<span>- quantité : {{ qte }} </span><br />
				<span>- domicile : {{ adresse }} | atelier : {{ atelier }} | relais : {{ relais }} | colis rev : {{ colis }}</span><br />
				<span>- production : {{ delaiprod }} | livraision : {{ delailiv}} </span><br />
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
						<li><img :src="$global.img+'/banderole/slide/banderole-1.jpg'" alt="banderole pas cher" title="bâche imprimée meilleur prix" /></li>
						<li><img :src="$global.img+'/banderole/slide/banderole-3.jpg'" alt="banderole sur mesure"  title="impression grand format pas cher"/></li>
						<li><img :src="$global.img+'/banderole/slide/banderole-4.jpg'" alt="bâche imprimée" title="banderoles évènements"/></li>
						<li><img :src="$global.img+'/banderole/slide/devis-en-ligne.png'" alt="commencez votre devis en ligne" title="devis impression grand format" /></li>
						<li><img :src="$global.img+'/banderole/slide/banderole-2.jpg'" alt="banderole sur mesure"  title="impression grand format pas cher"/></li>
						<li><img :src="$global.img+'/banderole/slide/banderole-0.jpg'" alt="bâche imprimée" title="banderoles évènements"/></li>
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
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=3.0"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.fixations-banderoles.js?v=3.0"></script>
