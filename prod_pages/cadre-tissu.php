<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne cadre tissu</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(1,'cadre-standard')" @mouseout="hout(1)" v-tooltip.bottom="$global.cstd" @click="reset(); selectProd('Cadre tissu standard');">
										<img :src="$global.img+'/cadre-tissu/cadre-standard.png'" /><span>Cadre tissu standard</span>
									</div>
									<div @mouseover="hoPw(1,'cadre-lumineux')" @mouseout="hout(1)" v-tooltip.bottom="$global.clum" @click="reset(); selectProd('Cadre tissu lumineux');">
										<img :src="$global.img+'/cadre-tissu/cadre-lumineux.png'" /><span>Cadre tissu lumineux</span>
									</div>
									<div @mouseover="hoPw(1,'cadre')" @mouseout="hout(1)" v-tooltip.bottom="$global.cstr" @click="reset(); selectProd('Cadre (structure seule)');">
										<img :src="$global.img+'/cadre-tissu/cadre.png'" /><span>structure seule</span>
									</div>
									<div @mouseover="hoPw(1,'tissu')"   @mouseout="hout(1)" v-tooltip.bottom="$global.ctis" @click="reset(); selectProd('visuel (tissu imprimé)');">
										<img :src="$global.img+'/cadre-tissu/tissu.png'" /><span>tissu imprimé seul</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="showHaut">

							<button type="button" class="toggle" :class="reqHaut" @click="toggleHaut = !toggleHaut">
								{{ choixHaut }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleHaut">
									<div @mouseover="hoPw(9,'Hauteur 50 cm');"   @mouseout="hout(9)" @click="reset(); selectHaut('50');">
										<i class="fa fa-arrows-v" aria-hidden="true"></i><span>Hauteur 50 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Hauteur 100 cm');"  @mouseout="hout(9)" @click="reset(); selectHaut('100');">
										<i class="fa fa-arrows-v" aria-hidden="true"></i><span>Hauteur 100 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Hauteur 180 cm');"  @mouseout="hout(9)" @click="reset(); selectHaut('180');">
										<i class="fa fa-arrows-v" aria-hidden="true"></i><span>Hauteur 180 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Hauteur 200 cm');"  @mouseout="hout(9)" @click="reset(); selectHaut('200');">
										<i class="fa fa-arrows-v" aria-hidden="true"></i><span>Hauteur 200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Hauteur 250 cm');"  @mouseout="hout(9)" @click="reset(); selectHaut('250');">
										<i class="fa fa-arrows-v" aria-hidden="true"></i><span>Hauteur 250 cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showLarg">

							<button type="button" class="toggle" :class="reqLarg" @click="toggleLarg = !toggleLarg">
								{{ choixLarg }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleLarg">
									<div @mouseover="hoPw(9,'Largeur 80 cm');"   @mouseout="hout(9)" @click="reset(); selectLarg('80');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 80 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 100 cm');"  @mouseout="hout(9)" @click="reset(); selectLarg('100');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 100 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 150 cm');"  @mouseout="hout(9)" @click="reset(); selectLarg('150');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 150 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 200 cm');"  @mouseout="hout(9)" @click="reset(); selectLarg('200');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 200 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 300 cm');"  @mouseout="hout(9)" @click="reset(); selectLarg('300');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 300 cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showCouleur">

							<button type="button" class="toggle" :class="reqTopt" @click="toggleTopt = !toggleTopt">
								{{ choixTopt }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleTopt" >

									<div @mouseover="hoPw(1,'blanc'+'/'+hauteur+'x'+largeur);" @mouseout="hout(1)" @click="reset(); selectOpt('blanc');">
										<img :src="$global.img+'/cadre-tissu/cadre-blanc.png'" /><span>blanc</span>
									</div>
									<div @mouseover="hoPw(1,'gris'+'/'+hauteur+'x'+largeur);"  @mouseout="hout(1)" @click="reset(); selectOpt('gris');">
										<img :src="$global.img+'/cadre-tissu/cadre-lumineux.png'" /><span>gris</span>
									</div>
									<div @mouseover="hoPw(1,'noir'+'/'+hauteur+'x'+largeur);"  @mouseout="hout(1)"  @click="reset(); selectOpt('noir');">
										<img :src="$global.img+'/cadre-tissu/cadre-noir.png'" /><span>noir</span>
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
											<button type="button" v-model="delailiv" class="dclic desactive" :class="btnD3">
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
					<div id="container" v-if="slideContainer">
						<ul id="slides">

							<li><img :src="$global.img+'/cadre-tissu/slide/cadre-tissu-1.jpg'" alt="fabricant cadre textile" title="impression cadre textile tissu tendu" /></li>
			  			<li><img :src="$global.img+'/cadre-tissu/slide/cadre-tissu-2.jpg'" alt="impression cadre textile" title="cloison cadre textile stand professionnel"  /></li>
			  			<li><img :src="$global.img+'/cadre-tissu/slide/cadre-tissu-3.jpg'" alt="cadre tissu tendu pas cher" title="cloison textile salon pro pas cher"  /></li>
			        <li><img :src="$global.img+'/cadre-tissu/slide/cadre-tissu-4.jpg'" alt="mur textile tendu stand salon" title="cadre textile stand pro meilleur prix"  /></li>
			        <li><img :src="$global.img+'/cadre-tissu/slide/cadre-tissu-5.jpg'" alt="habillage stand salon pro" title="habillage stand pro cadre textile tendu"  /></li>

						</ul>
					</div>
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

				<div class="helpMenu">
					<a :href="$global.url+'/en-cours/'" class="notice modal-link" title="aide produit">
						<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
					</a>
					<a :href="$global.url+'/notice-technique-cadre-textile/'" class="notice modal-link"  title="notices techniques">
						<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
					</a>
					<a :href="$global.url+'/gabarit-cadre-tissu/'" class="notice modal-link"  title="gabarits maquette">
						<i class="fa fa-object-group" aria-hidden="true"></i> <span class="textHide">Gabarits</span>
					</a>
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
							<input type="hidden" name="hauteur"   v-model="inputHauteur" />
							<input type="hidden" name="largeur"   v-model="inputLargeur" />
							<input type="hidden" name="reference" v-model="prodref" />

							<button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button>
						</form>
					</transition>

					<transition name="slideDown">
						<div class="formError" :class="errorColor" v-html="errorMessage" v-show="formError" :key="errorTrigger"></div>
					</transition>

				</div>
			</div>
		</div>  <!-- fin bloc image #previewContainer -->

	</div>
</div> <!-- fin bloc app  -->

<!--<script src="../wp-content/plugins/fbshop/js/vue.js"></script>-->
<script src="../wp-content/plugins/fbshop/js/vue.min.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.4"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.cadre-tissu.js?v=2.4"></script>
