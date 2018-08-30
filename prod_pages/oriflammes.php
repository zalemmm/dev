<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne Oriflammes</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(1,'aile3')"    @mouseout="hout(1)" v-tooltip.bottom="$global.aile" @click="reset(); selectProd('oriflamme');">
										<img :src="$global.img+'/oriflamme/aile3.png'" /><span>Oriflamme aile d’avion</span>
									</div>
									<div @mouseover="hoPw(1,'goutte3')"  @mouseout="hout(1)" v-tooltip.bottom="$global.gout" @click="reset(); selectProd('beachflag');">
										<img :src="$global.img+'/oriflamme/goutte3.png'" /><span>Beachflag goutte d’eau</span>
									</div>
									<div @mouseover="hoPw(1,'oriflamme-windflag')" @mouseout="hout(1)" v-tooltip.bottom="$global.wind" @click="reset(); selectProd('windflag');">
										<img :src="$global.img+'/oriflamme/oriflamme-windflag.png'" /><span>windflag rectangulaire</span>
									</div>
									<div @mouseover="hoPw(1,'gfvt2')"    @mouseout="hout(1)" v-tooltip.bottom="$global.gfvt" @click="reset(); selectProd('grand format vertical');">
										<img :src="$global.img+'/oriflamme/gfvt2.png'" /><span>drapeau grand format vertical</span>
									</div>
									<div @mouseover="hoPw(1,'gfhz')"     @mouseout="hout(1)" v-tooltip.bottom="$global.gfhz" @click="reset(); selectProd('grand format horizontal');">
										<img :src="$global.img+'/oriflamme/gfhz.png'" /><span>drapeau grand format horizontal</span>
									</div>
									<div @mouseover="hoPw(1,'drapeaux')" @mouseout="hout(1)" v-tooltip.bottom="$global.drap" @click="reset(); selectProd('drapeaux');">
										<img :src="$global.img+'/oriflamme/drapeaux.png'" /><span>drapeau à agiter</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="aileSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoTx(2,'a2','voile: 54x190 cm monté: 54x240 cm');" @mouseout="hout(2)" @click="reset(); selectSize('54x190');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 54x190 Monté: 54x240</span>
									</div>
									<div @mouseover="hoTx(2,'a4','voile: 85x245 cm monté: 85x245 cm');" @mouseout="hout(2)" @click="reset(); selectSize('85x245');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 85x245 Monté: 85x308</span>
									</div>
									<div @mouseover="hoTx(2,'a5','voile: 85x289 cm monté: 85x351 cm');" @mouseout="hout(2)" @click="reset(); selectSize('85x298');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 85x289 Monté: 85x351</span>
									</div>
									<div @mouseover="hoTx(2,'a6','voile: 85x397 cm monté: 85x465 cm');" @mouseout="hout(2)" @click="reset(); selectSize('85x397');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 85x397 Monté: 85x465</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="beachSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoTx(2,'a2','Voile: 70x155 cm Monté: 72x203 cm');"   @mouseout="hout(2)" @click="reset(); selectSize('72x156');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 70x155 Monté: 72x203</span>
									</div>
									<div @mouseover="hoTx(2,'a4','Voile: 75x213 cm Monté: 75x254 cm');"   @mouseout="hout(2)" @click="reset(); selectSize('75x213');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 75x213 Monté: 75x254</span>
									</div>
									<div @mouseover="hoTx(2,'a5','voile: 106x257 cm Monté: 106x323 cm');"  @mouseout="hout(2)" @click="reset(); selectSize('106x257');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 106x257 Monté: 106x323</span>
									</div>
									<div @mouseover="hoTx(2,'a6','Voile: 125x402 cm Monté: 125x460 cm');" @mouseout="hout(2)" @click="reset(); selectSize('125x402');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile: 125x402 Monté: 125x460</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="windSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoTx(2,'a2','Voile: 59x180 cm Monté: 63x256 cm');"  @mouseout="hout(2)" @click="reset(); selectSize('59x180');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile 59x180 Monté 63x256</span>
									</div>
									<div @mouseover="hoTx(2,'a5','Voile: 80x280 cm Monté: 80x410 cm');"  @mouseout="hout(2)" @click="reset(); selectSize('80x280');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile 80x280 Monté 80x410</span>
									</div>
									<div @mouseover="hoTx(2,'a6','voile: 100x350 cm Monté: 100x530 cm');" @mouseout="hout(2)" @click="reset(); selectSize('100x350');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Voile 100x350 Monté 100x530</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="vertSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'H|250 x L|80 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('250x80');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|250 x L|80 cm</span>
									</div>
									<div @mouseover="hoPw(9,'H|300 x L|100 cm');" @mouseout="hout(9)" @click="reset(); selectSize('300x100');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|300 x L|100 cm</span>
									</div>
									<div @mouseover="hoPw(9,'H|400 x L|120 cm');" @mouseout="hout(9)" @click="reset(); selectSize('400x120');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|400 x L|120 cm</span>
									</div>
									<div @mouseover="hoPw(9,'H|500 x L|150 cm');" @mouseout="hout(9)" @click="reset(); selectSize('500x150');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|500 x L|150 cm</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="horzSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'H|80 x L|120 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('80x120');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|80 x L|120 cm</span>
									</div>
									<div @mouseover="hoPw(9,'H|100 x L|150 cm');" @mouseout="hout(9)" @click="reset(); selectSize('100x150');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|100 x L|150 cm</span>
									</div>
									<div @mouseover="hoPw(9,'H|120 x L|180 cm');" @mouseout="hout(9)" @click="reset(); selectSize('120x180');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|120 x L|180 cm</span>
									</div>
									<div @mouseover="hoPw(9,'H|200 x L|300 cm');" @mouseout="hout(9)" @click="reset(); selectSize('200x300');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|200 x L|300 cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="smallSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoTx(1,'drapeauxsmall','H| 25 x L|35cm');" @mouseout="hout(1)" @click="reset(); selectSize('25x35');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H| 25 x L|35cm + mât 50cm</span>
									</div>
									<div @mouseover="hoTx(1,'drapeauxmedium','H|40 x L|50cm');" @mouseout="hout(1)" @click="reset(); selectSize('40x50');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|40 x L|50cm + mât 75cm</span>
									</div>
									<div @mouseover="hoTx(1,'drapeaux','H|75 x L|100cm');"      @mouseout="hout(1)" @click="reset(); selectSize('75x100');">
										<i class="fa fa-expand" aria-hidden="true"></i><span>H|75 x L|100cm + mât 150cm</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="aileKit">

							<button type="button" class="toggle" :class="reqKit" @click="toggleKit = !toggleKit">
								{{ choixKit }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleKit" >
									<div @mouseover="hoPw(1,'aile3');" @mouseout="hout(1)" @click="reset(); selectKit('kit complet');">
										<img :src="$global.img+'/oriflamme/aile3.png'" /><span>Kit complet: structure + voile + pied</span>
									</div>
									<div @mouseover="hoPw(1,'aile2');" @mouseout="hout(1)" @click="reset(); selectKit('structure et voile');">
										<img :src="$global.img+'/oriflamme/aile2.png'" /><span>Structure + Voile</span>
									</div>
									<div @mouseover="hoPw(1,'aile1');" @mouseout="hout(1)" @click="reset(); selectKit('voile seule');">
										<img :src="$global.img+'/oriflamme/aile1.png'" /><span>Voile seule</span>
									</div>
									<div @mouseover="hoPw(1,'aile4');" @mouseout="hout(1)" @click="reset(); selectKit('structure seule');">
										<img :src="$global.img+'/oriflamme/aile4.png'" /><span>Structure seule</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="goutteKit">

							<button type="button" class="toggle" :class="reqKit" @click="toggleKit = !toggleKit">
								{{ choixKit }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleKit" >
									<div @mouseover="hoPw(1,'goutte3');" @mouseout="hout(1)" @click="reset(); selectKit('kit complet');">
										<img :src="$global.img+'/oriflamme/goutte3.png'" /><span>Kit complet: structure + voile + pied</span>
									</div>
									<div @mouseover="hoPw(1,'goutte2');" @mouseout="hout(1)" @click="reset(); selectKit('structure et voile');">
										<img :src="$global.img+'/oriflamme/goutte2.png'" /><span>Structure + Voile</span>
									</div>
									<div @mouseover="hoPw(1,'goutte1');" @mouseout="hout(1)" @click="reset(); selectKit('voile seule');">
										<img :src="$global.img+'/oriflamme/goutte1.png'" /><span>Voile seule</span>
									</div>
									<div @mouseover="hoPw(1,'goutte4');" @mouseout="hout(1)" @click="reset(); selectKit('structure seule');">
										<img :src="$global.img+'/oriflamme/goutte4.png'" /><span>Structure seule</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showRecv">

							<button type="button" class="toggle" :class="reqRecv" @click="toggleRecv = !toggleRecv">
								{{ choixRecv }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleRecv">
									<div @mouseover="hoPw(9,'Recto/Verso par transparence');"       @mouseout="hout(9)" v-tooltip.bottom="$global.rect" @click="reset(); selectRecv('Recto/Verso par transparence');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Recto/Verso par transparence</span>
									</div>
									<div @mouseover="hoPw(9,'Recto/Verso double voile');" @mouseout="hout(9)" v-tooltip.bottom="$global.recv" @click="reset(); selectRecv('Recto/Verso double voile');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Recto/Verso double voile</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showPied">

							<button type="button" class="toggle" :class="reqKit" @click="togglePied = !togglePied">
								{{ choixPied }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="togglePied" >
									<div @mouseover="hoPw(2,'pied8');" @mouseout="hout(2)" @click="reset(); selectPied('Embase 8kg');">
										<img :src="$global.img+'/oriflamme/p1.png'" /><span>Embase 8kg</span>
									</div>
									<div @mouseover="hoPw(2,'pied13');" @mouseout="hout(2)" @click="reset(); selectPied('Embase carrée 13,5kg');">
										<img :src="$global.img+'/oriflamme/p2.png'" /><span>Embase carrée 13,5kg</span>
									</div>
									<div @mouseover="hoPw(2,'pied4');" @mouseout="hout(2)" @click="reset(); selectPied('Pied 4 branches + bouée');">
										<img :src="$global.img+'/oriflamme/p3.png'" /><span>Pied 4 branches + bouée</span>
									</div>
									<div @mouseover="hoPw(2,'piedPiquet');" @mouseout="hout(2)" @click="reset(); selectPied('Pied piquet');">
										<img :src="$global.img+'/oriflamme/p4.png'" /><span>Pied piquet</span>
									</div>
									<div @mouseover="hoPw(2,'piedVoiture');" @mouseout="hout(2)" @click="reset(); selectPied('Pied voiture');">
										<img :src="$global.img+'/oriflamme/p5.png'" /><span>Pied voiture</span>
									</div>
									<div @mouseover="hoPw(2,'piedVis');" @mouseout="hout(2)" @click="reset(); selectPied('Pied à visser');">
										<img :src="$global.img+'/oriflamme/p6.png'" /><span>Pied à visser</span>
									</div>
									<div @mouseover="hoPw(2,'piedPara');" @mouseout="hout(2)" @click="reset(); selectPied('Pied parasol 23L');">
										<img :src="$global.img+'/oriflamme/p7.png'" /><span>Pied parasol 23L</span>
									</div>
									<div @mouseover="hoPw(2,'piedPara');" @mouseout="hout(2)" @click="reset(); selectPied('Embase ciment 22kg');">
										<img :src="$global.img+'/oriflamme/p7.png'" /><span>Embase ciment 22kg</span>
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

							<h5 class="optionsTitle">OPTIONS DISPONIBLES :</h5>

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

								<span class="optCheck">
									<label for="relais">Voile anti-feu B1</label>
									<input type="checkbox" id="antifeu" v-model="antifeu" @click="reset" />
									<span  class="opHelp" v-tooltip.bottom="{content: $global.feu, offset: 5}"><i class="fa fa-question-circle"></i></span>
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
				<span>- choixRecv : {{ choixRecv }} </span><br />
				<span>- kit : {{ kit }} </span><br />
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
							<li><img :src="$global.img+'/oriflamme/slide/oriflamme-1.jpg'" alt="oriflamme pas cher" title="beachflag pas cher" /></li>
		          <li><img :src="$global.img+'/oriflamme/slide/oriflamme-2.jpg'" alt="beachflag personnalisé" title="devis oriflamme" /></li>
		          <li><img :src="$global.img+'/oriflamme/slide/oriflamme-3.jpg'" alt="windflag pas cher" title="oriflamme devis en ligne" /></li>
		          <li><img :src="$global.img+'/banderole/slide/devis-en-ligne.png'" alt="commencez votre devis en ligne" title="devis impression grand format" /></li>
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
					<a :href="$global.url+'/aide-oriflamme/'" class="notice modal-link" title="aide produit">
						<i class="fa fa-lightbulb-o"  aria-hidden="true"></i> <span class="textHide">Aide</span>
					</a>
					<a :href="$global.url+'/notice-technique-oriflamme/'" class="notice modal-link"  title="notices techniques">
						<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
					</a>
					<a :href="$global.url+'/gabarit-oriflamme/'" class="notice modal-link"  title="gabarits maquette">
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
					<span class="estimationData" id="prix_unitaire">{{  prixUnit  }} </span>
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
			</div>
		</div>  <!-- fin bloc image #previewContainer -->

	</div>
</div> <!-- fin bloc app  -->

<!--<script src="../wp-content/plugins/fbshop/js/vue.js"></script>-->
<script src="../wp-content/plugins/fbshop/js/vue.min.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.4"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.oriflammes.js?v=2.4"></script>
