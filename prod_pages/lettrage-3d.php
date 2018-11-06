<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne lettrage 3d</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(1,'lettrage3d-standard')" @mouseout="hout(1)" v-tooltip.bottom="$global.l3ds" @click="reset(); selectProd('Lettrage 3d standard');">
										<img :src="$global.img+'/enseignes/lettrage3d-standard.png'" /><span>Lettrage 3d standard</span>
									</div>
									<div @mouseover="hoPw(1,'lettrage3d-lumineux')" @mouseout="hout(1)" v-tooltip.bottom="$global.l3dl" @click="reset(); selectProd('Lettrage 3d lumineux');">
										<img :src="$global.img+'/enseignes/lettrage3d-lumineux.png'" /><span>Lettrage 3d lumineux</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showSupp">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div  class="boutonsSelect" v-show="toggleSupp">

										<div class="clTis" @mouseover="hoPw(9,'PVC (19mm / 30mm)')"             @mouseout="hout(1)" v-tooltip.bottom="$global.lpvc" @click="reset(); selectSupport('pvc');"       v-if="lumi">
											<img :src="$global.img+'/enseignes/__.png'" /><span>PVC (19mm / 30mm)</span>
										</div>
										<div class="clTis" @mouseover="hoPw(9,'PVC (10mm / 19mm / 30mm)')"      @mouseout="hout(1)" v-tooltip.bottom="$global.lpvc" @click="reset(); selectSupport('pvc');"       v-if="stand">
											<img :src="$global.img+'/enseignes/__.png'" /><span>PVC (10mm / 19mm / 30mm)</span>
										</div>
										<div class="clTis" @mouseover="hoPw(9,'Plexiglas (3mm / 10mm / 20mm)')" @mouseout="hout(1)" v-tooltip.bottom="$global.plexi" @click="reset(); selectSupport('plexiglas');" v-if="stand">
											<img :src="$global.img+'/enseignes/__.png'" /><span>Plexiglas (3mm / 10mm / 20mm)</span>
										</div>
										<div class="clTis" @mouseover="hoPw(9,'Dibond (3mm)')"                  @mouseout="hout(1)" v-tooltip.bottom="$global.ldib" @click="reset(); selectSupport('dibond');"    v-if="stand">
											<img :src="$global.img+'/enseignes/__.png'" /><span>Dibond (3mm)</span>
										</div>

								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="showHaut">

							<button type="button" class="toggle" :class="reqHaut" @click="toggleHaut = !toggleHaut">
								{{ choixHaut }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleHaut" >
									<div class="selectQte" @mouseover="hoPw(9,'10 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('10 cm');"> <i class="num">10 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'15 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('15 cm');"> <i class="num">15 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'20 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('20 cm');"> <i class="num">20 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'25 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('25 cm');"> <i class="num">25 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'30 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('30 cm');"> <i class="num">30 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'35 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('35 cm');"> <i class="num">35 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'40 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('40 cm');"> <i class="num">40 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'45 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('45 cm');"> <i class="num">45 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'50 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('50 cm');"> <i class="num">10 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'55 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('55 cm');"> <i class="num">55 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'60 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('60 cm');"> <i class="num">60 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'70 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('70 cm');"> <i class="num">70 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'80 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('80 cm');"> <i class="num">80 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'90 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('90 cm');"> <i class="num">90 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'100 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('100 cm');"> <i class="num">100 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'110 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('110 cm');" v-if="stand"> <i class="num">110 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'120 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('120 cm');" v-if="stand"> <i class="num">120 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'130 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('130 cm');" v-if="stand"> <i class="num">130 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'140 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('140 cm');" v-if="stand"> <i class="num">140 cm</i></div>
									<div class="selectQte" @mouseover="hoPw(9,'150 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('150 cm');" v-if="stand"> <i class="num">150 cm</i></div>

								</div>
							</transition>
						</li>

						<li class="formSelect" v-show="showPers && lumi">

							<button type="button" class="toggle" :class="reqPers" @click="togglePers = !togglePers">
								{{ choixPers }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="togglePers" >

									<div @mouseover="hoPw(9,'rouge');"  @mouseout="hout(4)" @click="reset(); selectPers('rouge');">
										<i class="fa fa-circle" style="color:red"></i><span>Rouge</span>
									</div>
									<div @mouseover="hoPw(9,'bleu');"  @mouseout="hout(4)" @click="reset(); selectPers('bleu');">
										<i class="fa fa-circle" style="color:blue"></i><span>Bleu</span>
									</div>
									<div @mouseover="hoPw(9,'vert');"  @mouseout="hout(4)" @click="reset(); selectPers('vert');">
										<i class="fa fa-circle" style="color:green"></i><span>Vert</span>
									</div>
									<div @mouseover="hoPw(9,'blanc');"  @mouseout="hout(4)" @click="reset(); selectPers('blanc');">
										<i class="fa fa-circle" style="color:white"></i><span>Blanc</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect  optSize" v-show="showMaqt">
							<div class="qteContainer" :class="reqMaqt">
								<label class="sizeLabel" :class="reqMaqt">Saisir le texte:</label>
								<input type="text" placeholder="Saisir le texte" class="sizeInput" v-model="texte" @click="reset" @keyup="checkSize('texte', $event.target.value)" />
							</div>
						</li>


						<li class="formSelect" id="id_signature" v-show="showSign">

							<button type="button" class="toggle" :class="reqSign" @click="toggleSign = !toggleSign">
								{{ choixSign }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">

								<div class="boutonsSelect" v-show="toggleSign" >
									<div @mouseover="hoPw(9,'rouge');"  @mouseout="hout(4)" @click="reset(); selectSign('rouge');">
										<i class="fa fa-circle" style="color:red"></i><span>Rouge</span>
									</div>
									<div @mouseover="hoPw(9,'bleu');"  @mouseout="hout(4)" @click="reset(); selectSign('bleu');">
										<i class="fa fa-circle" style="color:blue"></i><span>Bleu</span>
									</div>
									<div @mouseover="hoPw(9,'vert');"  @mouseout="hout(4)" @click="reset(); selectSign('vert');">
										<i class="fa fa-circle" style="color:green"></i><span>Vert</span>
									</div>
									<div @mouseover="hoPw(9,'blanc');"  @mouseout="hout(4)" @click="reset(); selectSign('blanc');">
										<i class="fa fa-circle" style="color:white"></i><span>Blanc</span>
									</div>
									<div @mouseover="hoPw(9,'Brut (plexiglas)');"  @mouseout="hout(4)" @click="reset(); selectSign('Brut (plexiglas)');">
										<i class="fa fa-circle" style="color:white"></i><span>Brut (plexiglas)</span>
									</div>
								</div>
							</transition>

						</li>

					</ul>

					<ul class="optionsBlock" v-show="showOptions">

						<li class="optLi optQuantite">
							<div class="qteContainer" :class="reqHaut">
								<label class="qteLabel" :class="reqHaut">quantité <span class="small">(par texte)</span></label>
								<input type="number" min="1" class="qteInput" v-model="qte" @keyup.up="qtePlus" @keyup.down="qteMoins" @click="reset"  />

								<div class="qteBtn" :class="reqHaut">
									<button type="button" @click="reset(); qteMoins();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
									<button type="button" @click="reset(); qtePlus();"> <i class="fa fa-plus-circle"  aria-hidden="true"></i></button>
								</div>
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
				<a :href="$global.url+'/banderole/'" class="notice modal-link" title="aide produit">
					<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
				</a>
				<a :href="$global.url+'/choisir-sa-bache/'" class="notice modal-link"  title="notices techniques">
					<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
				</a>
				<a :href="$global.url+'/gabarit-banderole/'" class="notice modal-link"  title="gabarits maquette">
					<i class="fa fa-object-group" aria-hidden="true"></i> <span class="textHide">Gabarits</span>
				</a>
			</div>

			<div id="previewImg">

				<transition name="slideDown">
					<ul id="slides" v-if="slideContainer">
						<li><img :src="$global.img+'/slidedefault/1.png'" alt="commencez votre devis habillage stand exposition" /></li>
			      <li><img :src="$global.img+'/slidedefault/2.png'" alt="commencez votre devis en ligne cloison stand tissu" /></li>
					</ul>
				</transition>

				<transition name="slideDown"><div class="preview_imag0" :style="bg0" v-show="pr0"></div></transition>
				<transition name="slideLeft"><div class="preview_imag1" :style="bg1" v-show="pr1">
					<span class="letter3d"><span :style="tx3d">{{ texte }}</div></span>
				</div></transition>
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
<script src="../wp-content/plugins/fbshop/js/vue.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.6"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.lettrage3d.js?v=2.6"></script>
