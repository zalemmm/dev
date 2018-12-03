<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne nappe publicitaire</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div v-show="toggleSupp">

									<div class="boutonsSelect" >

										<div @mouseover="hoPw(1,'220g')" @mouseout="hout(1)" v-tooltip.bottom="$global.t220m2" @click="reset(); selectSupport('tissu 220g');">
											<img :src="$global.img+'/banderole/220g.png'" /><span>tissu stretch léger 220g M1</span>
										</div>
										<div @mouseover="hoPw(1,'260g')" @mouseout="hout(1)" v-tooltip.bottom="$global.t260m2" @click="reset(); selectSupport('tissu 260g');">
											<img :src="$global.img+'/banderole/260g.png'" /><span>tissu stretch dos noir 260g B1</span>
										</div>

									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showShape">

							<button type="button" class="toggle" :class="reqShape" @click="toggleShape = !toggleShape">
								{{ choixShape }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleShape">
									<div @mouseover="hoPw(1,'napperond')" @mouseout="hout(1)"  @click="reset(); selectShape('ronde');">
										<img :src="$global.img+'/nappe/napperond.png'" alt=""><span>ronde</span>
									</div>
									<div @mouseover="hoPw(1,'nappecarre')" @mouseout="hout(1)" @click="reset(); selectShape('rectangulaire');">
										<img :src="$global.img+'/nappe/nappecarre.png'" alt=""><span>carrée ou rectangulaire</span>
									</div>
								</div>
							</transition>
						</li>

						<li class="formSelect  optSize" v-show="showRect">
							<div class="sizeContainer" :class="reqHaut">
								<label class="sizeLabel" :class="reqHaut">longueur <span class="small">plateau (en cm)</span></label>
								<input type="text" placeholder="LONGUEUR PLATEAU EN CM" class="sizeInput" v-model.number="hauteur" @click="reset" @keyup="checkSize('hauteur', $event.target.value)" />
							</div>

							<div class="sizeContainer" :class="reqLarg">
								<label class="sizeLabel" :class="reqLarg">largeur <span class="small">plateau (en cm)</span></label>
								<input type="text" placeholder="LARGEUR PLATEAU EN CM" class="sizeInput"  v-model.number="largeur" @click="reset" @keyup="checkSize('largeur', $event.target.value)" />
							</div>
						</li>

						<li class="formSelect  optSize" v-show="showRond">
							<div class="qteContainer" :class="reqDiam">
								<label class="sizeLabel" :class="reqDiam">diamètre <span class="small">plateau (en cm)</span></label>
								<input type="text" placeholder="DIAMETRE PLATEAU EN CM" class="sizeInput" v-model.number="diametre" @click="reset" @keyup="checkSize('diametre', $event.target.value)" />
							</div>
						</li>

						<transition name="slideLeft"><li class="formSelect fieldError" v-show="showEsize" style="margin-top:-5px">{{ errorSize }}</li></transition>

						<li class="optLi optReto" v-show="showSize">
							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(1,rondORrect);" @mouseout="hout(1)" @click="reset(); selectSize('0');">
										<img :src="$global.img+'/nappe/'+rondORrect+'.png'" alt=""><span>sans retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'1');" @mouseout="hout(1)" @click="reset(); selectSize('20');">
										<img :src="$global.img+'/nappe/'+rondORrect+'1.png'" alt=""><span>20cm de retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'2');" @mouseout="hout(1)" @click="reset(); selectSize('30');">
										<img :src="$global.img+'/nappe/'+rondORrect+'2.png'" alt=""><span>30cm de retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'3');" @mouseout="hout(1)" @click="reset(); selectSize('40');">
										<img :src="$global.img+'/nappe/'+rondORrect+'3.png'" alt=""><span>40cm de retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'4');" @mouseout="hout(1)" @click="reset(); selectSize('50');">
										<img :src="$global.img+'/nappe/'+rondORrect+'4.png'" alt=""><span>50cm de retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'5');" @mouseout="hout(1)" @click="reset(); selectSize('60');">
										<img :src="$global.img+'/nappe/'+rondORrect+'5.png'" alt=""><span>60cm de retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'6');" @mouseout="hout(1)" @click="reset(); selectSize('70');">
										<img :src="$global.img+'/nappe/'+rondORrect+'6.png'" alt=""><span>70cm de retombée</span>
									</div>
									<div @mouseover="hoPw(1,rondORrect+'7');" @mouseout="hout(1)" @click="reset(); selectSize('80');">
										<img :src="$global.img+'/nappe/'+rondORrect+'7.png'" alt=""><span>80cm de retombée</span>
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

					</ul>

					<ul class="optionsBlock" v-show="showOptions">

						<li class="optLi optQuantite">
							<div class="qteContainer" :class="reqQtte">
								<label class="qteLabel" :class="reqQtte">quantité <span class="small">(par visuel)</span></label>
								<input type="number" min="1" class="qteInput" v-model="qte" @keyup.up="qtePlus" @keyup.down="qteMoins" @click="reset"  />

								<div class="qteBtn" :class="reqQtte">
									<button type="button" @click="reset(); qteMoins();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
									<button type="button" @click="reset(); qtePlus();"> <i class="fa fa-plus-circle"  aria-hidden="true"></i></button>
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
				<a :href="$global.url+'/en-cours/'" class="notice modal-link" title="aide produit">
					<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
				</a>
				<a :href="$global.url+'/notice-en-cours/'" class="notice modal-link"  title="notices techniques">
					<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
				</a>
				<a :href="$global.url+'/gabarit-nappe-publicitaire/'" class="notice modal-link"  title="gabarits maquette">
					<i class="fa fa-object-group" aria-hidden="true"></i> <span class="textHide">Gabarits</span>
				</a>
			</div>

			<div id="previewImg">

				<transition name="slideDown">
					<ul id="slides" v-if="slideContainer">
						<li><img :src="$global.img+'/nappe/slide/nappe-publicitaire0.jpg'" alt="nappe publicitaire devis en ligne" title="nappe conférence meeting salons meilleur prix" /></li>
			      <li><img :src="$global.img+'/nappe/slide/nappe-publicitaire1.jpg'" alt="nappe publicitaire pas cher" title="nappe publicitaire pas cher" /></li>
						<li><img :src="$global.img+'/nappe/slide/nappe-publicitaire2.jpg'" alt="nappe publicitaire évènement" title="nappe imprimée" /></li>
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
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.1"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.nappes-publicitaires.js?v=2.2"></script>
