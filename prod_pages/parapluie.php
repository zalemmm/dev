<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne stand</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(1,'stand')"     @mouseout="hout(1)" v-tooltip.bottom="$global.stdd" @click="reset(); selectProd('Tissu droit');">
										<img :src="$global.img+'/parapluie/stand.png'" /><span>stand tissu easy quick droit</span>
									</div>
									<div @mouseover="hoPw(1,'courbe')"    @mouseout="hout(1)" v-tooltip.bottom="$global.stdc" @click="reset(); selectProd('Tissu courbe');">
										<img :src="$global.img+'/parapluie/courbe.png'" /><span>stand tissu easy quick courbé</span>
									</div>
									<div @mouseover="hoPw(1,'standexpo')" @mouseout="hout(1)" v-tooltip.bottom="$global.stde" @click="reset(); selectProd('Stand ExpoBag');">
										<img :src="$global.img+'/parapluie/standexpo2.png'" /><span>stand expo’bag</span>
									</div>
									<div @mouseover="hoPw(1,'comptoir')"  @mouseout="hout(1)" v-tooltip.bottom="$global.comp" @click="reset(); selectProd('Comptoir Easy Quick');">
										<img :src="$global.img+'/parapluie/comptoir2.png'" /><span>comptoir tissu easy quick</span>
									</div>
									<div @mouseover="hoPw(1,'valise')"    @mouseout="hout(1)" v-tooltip.bottom="$global.vali" @click="reset(); selectProd('valise');">
										<img :src="$global.img+'/parapluie/valise2.png'" /><span>valise / bank d'accueil</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="courbSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(1,'courbe3');"  @mouseout="hout(1)" v-tooltip.bottom="'227x209 cm'" @click="reset(); selectSize('3x3');">
										<img :src="$global.img+'/parapluie/courbe3.png'" /><span>Recto Avec Retour 3x3</span>
									</div>
									<div @mouseover="hoPw(1,'courbe4');"  @mouseout="hout(1)" v-tooltip.bottom="'227x278 cm'" @click="reset(); selectSize('3x4');">
										<img :src="$global.img+'/parapluie/courbe4.png'" /><span>Recto Avec Retour 3x4</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="droitSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(1,'stand1');" @mouseout="hout(1)" v-tooltip.bottom="'226x79 cm'" @click="reset(); selectSize('3x1 Recto');">
										<img :src="$global.img+'/parapluie/stand1.png'" /><span>Recto Avec Retour 3x1</span>
									</div>
									<div @mouseover="hoPw(1,'stand2');" @mouseout="hout(1)" v-tooltip.bottom="'226x152 cm'" @click="reset(); selectSize('3x2 Recto');">
										<img :src="$global.img+'/parapluie/stand2.png'" /><span>Recto Avec Retour 3x2</span>
									</div>
									<div @mouseover="hoPw(1,'stand3');" @mouseout="hout(1)" v-tooltip.bottom="'226x226 cm'" @click="reset(); selectSize('3x3 Recto');">
										<img :src="$global.img+'/parapluie/stand3.png'" /><span>Recto Avec Retour 3x3</span>
									</div>
									<div @mouseover="hoPw(1,'stand4');" @mouseout="hout(1)" v-tooltip.bottom="'226x300 cm'" @click="reset(); selectSize('3x4 Recto');">
										<img :src="$global.img+'/parapluie/stand4.png'" /><span>Recto Avec Retour 3x4</span>
									</div>
									<div @mouseover="hoPw(1,'stand5');" @mouseout="hout(1)" v-tooltip.bottom="'226x373 cm'" @click="reset(); selectSize('3x5 Recto');">
										<img :src="$global.img+'/parapluie/stand5.png'" /><span>Recto Avec Retour 3x5</span>
									</div>
									<div @mouseover="hoPw(1,'stand6');" @mouseout="hout(1)" v-tooltip.bottom="'226x446 cm'" @click="reset(); selectSize('3x6 Recto');">
										<img :src="$global.img+'/parapluie/stand6.png'" /><span>Recto Avec Retour 3x6</span>
									</div>
									<div @mouseover="hoPw(1,'stand7');" @mouseout="hout(1)" v-tooltip.bottom="'226x520 cm'" @click="reset(); selectSize('3x7 Recto');">
										<img :src="$global.img+'/parapluie/stand7.png'" /><span>Recto Avec Retour 3x7</span>
									</div>
									<div @mouseover="hoPw(1,'stand8');" @mouseout="hout(1)" v-tooltip.bottom="'226x594 cm'" @click="reset(); selectSize('3x8 Recto');">
										<img :src="$global.img+'/parapluie/stand8.png'" /><span>Recto Avec Retour 3x8</span>
									</div>

									<div @mouseover="hoPw(1,'stand1');" @mouseout="hout(1)" v-tooltip.bottom="'226x79 cm'" @click="reset(); selectSize('3x1 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand1.png'" /><span>Recto Verso 3x1</span>
									</div>
									<div @mouseover="hoPw(1,'stand2');" @mouseout="hout(1)" v-tooltip.bottom="'226x152 cm'" @click="reset(); selectSize('3x2 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand2.png'" /><span>Recto Verso 3x2</span>
									</div>
									<div @mouseover="hoPw(1,'stand3');" @mouseout="hout(1)" v-tooltip.bottom="'226x226 cm'" @click="reset(); selectSize('3x3 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand3.png'" /><span>Recto Verso 3x3</span>
									</div>
									<div @mouseover="hoPw(1,'stand4');" @mouseout="hout(1)" v-tooltip.bottom="'226x300 cm'" @click="reset(); selectSize('3x4 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand4.png'" /><span>Recto Verso 3x4</span>
									</div>
									<div @mouseover="hoPw(1,'stand5');" @mouseout="hout(1)" v-tooltip.bottom="'226x373 cm'" @click="reset(); selectSize('3x5 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand5.png'" /><span>Recto Verso 3x5</span>
									</div>
									<div @mouseover="hoPw(1,'stand6');" @mouseout="hout(1)" v-tooltip.bottom="'226x446 cm'" @click="reset(); selectSize('3x6 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand6.png'" /><span>Recto Verso 3x6</span>
									</div>
									<div @mouseover="hoPw(1,'stand7');" @mouseout="hout(1)" v-tooltip.bottom="'226x520 cm'" @click="reset(); selectSize('3x7 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand7.png'" /><span>Recto Verso 3x7</span>
									</div>
									<div @mouseover="hoPw(1,'stand8');" @mouseout="hout(1)" v-tooltip.bottom="'226x594 cm'" @click="reset(); selectSize('3x8 Recto Verso');">
										<img :src="$global.img+'/parapluie/stand8.png'" /><span>Recto Verso 3x8</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="showSupport">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp" >
									<div @mouseover="hoPw(9,'tissu stretch léger 220g M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.s220" @click="reset(); selectSupport('tissu 220g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu stretch léger 220g M1</span>
									</div>
									<div @mouseover="hoPw(9,'tissu stretch défroissable 260g M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.s260" @click="reset(); selectSupport('tissu 260g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu stretch dos noir 260g B1</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="suppPhotocall">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								Support photocall : {{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp" >
									<div @mouseover="hoPw(9,'bâche PVC 520g M1 / visuel 200x220cm');" @mouseout="hout(9)" v-tooltip.bottom="$global.b520" @click="reset(); selectSupport('jet 520 M1');" v-show="suppPhotocall">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>bâche PVC 520g M1 / visuel 200x220cm</span>
									</div>
									<div @mouseover="hoPw(9,'tissu 220g M1 / visuel 220x240cm');" @mouseout="hout(9)" v-tooltip.bottom="$global.t220" @click="reset(); selectSupport('tissu 220g');" v-show="suppPhotocall">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu 220g M1 / visuel 220x240cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="suppValise">

							<button type="button" class="toggle" :class="reqSupp2" @click="toggleSupp2 = !toggleSupp2">
								Support valise : {{ choixSupp2 }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp2" >
									<div @mouseover="hoPw(9,'PVC 300µ / visuel 140x85cm');" @mouseout="hout(9)" v-tooltip.bottom="$global.p300" @click="reset(); selectSupport2('PVC 300µ');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>PVC 300µ / visuel 140x85cm</span>
									</div>
									<div @mouseover="hoPw(9,'tissu 220g M1 / visuel 178x85cm');" @mouseout="hout(9)" v-tooltip.bottom="$global.s220" @click="reset(); selectSupport2('tissu 220g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu 220g M1 / visuel 178x85cm</span>
									</div>

									<div @mouseover="hoPw(9,'tissu 220g M1 / visuel 178x85cm');" @mouseout="hout(9)" v-tooltip.bottom="$global.s260" @click="reset(); selectSupport2('tissu 260g');" v-show="valiseSeule">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu 260g B1 / visuel 178x85cm</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="showAcce">

							<button type="button" class="toggle" :class="reqAcce" @click="toggleAcce = !toggleAcce">
								{{ choixAcce }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleAcce">
									<div @mouseover="hoPw(2,'');" @mouseout="hout(2)" @click="reset(); selectAcce('sans option');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>sans options</span>
									</div>
									<div @mouseover="hoPw(2,'comptoir');" @mouseout="hout(2)" @click="reset(); selectAcce('Comptoir Easy Quick');">
										<img :src="$global.img+'/parapluie/comptoir2.png'" /><span>comptoir tissu easy quick</span>
									</div>
									<div @mouseover="hoPw(2,'valise');"   @mouseout="hout(2)" @click="reset(); selectAcce('Valise transformable');">
										<img :src="$global.img+'/parapluie/valise2.png'" /><span>valise / bank d'accueil</span>
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
					<div id="container" v-if="slideContainer">
						<ul id="slides">

							<li><img :src="$global.img+'/parapluie/slide/standexpo-0.jpg'" alt="stand exposition salon" title="stand expo pas cher" /></li>
				      <li><img :src="$global.img+'/parapluie/slide/standexpo-2.jpg'" alt="devis en ligne stand expo" title="stand parapluie devis" /></li>
				      <li><img :src="$global.img+'/parapluie/slide/standexpo-3.jpg'" alt="stand parapluie pas cher" title="stand exposition personnalisé" /></li>

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
					<a :href="$global.url+'/aide-stand-parapluie/'" class="notice modal-link" title="aide produit">
						<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
					</a>
					<a :href="$global.url+'/notice-technique-stand-parapluie-tissu-expo/'" class="notice modal-link"  title="notices techniques">
						<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
					</a>
					<a :href="$global.url+'/gabarit-stand-parapluie-tissu/'" class="notice modal-link"  title="gabarits maquette">
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
<script src="../wp-content/plugins/fbshop/prod_pages/vue.parapluie.js?v=2.5"></script>
