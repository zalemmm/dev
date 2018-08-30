<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne Kakemono Totem</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">
									<div @mouseover="hoPw(1,'x-screen180')" @mouseout="hout(1)" v-tooltip.bottom="$global.xscr" @click="reset(); selectProd('x-screen');">
										<img :src="$global.img+'/totem/x-screen180.png'" /><span>Kakemono X-Screen</span>
									</div>
									<div @mouseover="hoPw(1,'clipit1')"     @mouseout="hout(1)" v-tooltip.bottom="$global.clip" @click="reset(); selectProd('clipit');">
										<img :src="$global.img+'/totem/clipit1.png'" /><span>Kakemono Clip'it</span>
									</div>
									<div @mouseover="hoPw(1,'kakemono-tissu')" @mouseout="hout(1)" v-tooltip.bottom="$global.kakt" @click="reset(); selectProd('Kakemono Tissu');">
										<img :src="$global.img+'/totem/kakemono-tissu.png'" /><span>Kakemono Tissu</span>
									</div>
									<div @mouseover="hoPw(1,'photocall')"   @mouseout="hout(1)" v-tooltip.bottom="$global.phto" @click="reset(); selectProd('Photocall');">
										<img :src="$global.img+'/totem/photocall.png'" /><span>Photocall</span>
									</div>
									<div @mouseover="hoPw(1,'blizzard200')" @mouseout="hout(1)" v-tooltip.bottom="$global.bliz" @click="reset(); selectProd('Blizzard');">
										<img :src="$global.img+'/totem/blizzard200.png'" /><span>kakemono extérieur Blizzard</span>
									</div>
									<div @mouseover="hoPw(1,'mistral200')"  @mouseout="hout(1)" v-tooltip.bottom="$global.mist" @click="reset(); selectProd('Mistral');">
										<img :src="$global.img+'/totem/mistral200.png'" /><span>kakemono extérieur mistral</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="xscreenSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'60x160 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('60x160');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>60x160 cm</span>
									</div>
									<div @mouseover="hoPw(9,'80x180 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('80x180');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>80x180 cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="clipitSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'Largeur 30 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('30');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 30 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 42 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('42');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 42 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 50 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('50');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 50 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 60 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('60');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 60 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 70 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('70');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 70 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 85 cm');"  @mouseout="hout(9)" @click="reset(); selectSize('85');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 85 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 100 cm');" @mouseout="hout(9)" @click="reset(); selectSize('100');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 100 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 120 cm');" @mouseout="hout(9)" @click="reset(); selectSize('120');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 120 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 150 cm');" @mouseout="hout(9)" @click="reset(); selectSize('150');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 150 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 160 cm');" @mouseout="hout(9)" @click="reset(); selectSize('160');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 160 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 180 cm');" @mouseout="hout(9)" @click="reset(); selectSize('180');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 180 cm</span>
									</div>
									<div @mouseover="hoPw(9,'Largeur 200 cm');" @mouseout="hout(9)" @click="reset(); selectSize('200');">
										<i class="fa fa-arrows-h" aria-hidden="true"></i><span>Largeur 200 cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect optSize" v-show="showHaut" >
							<div class="qteContainer" :class="reqHaut">
								<label class="sizeLabel" :class="reqHaut">hauteur <span class="small">personnalisée (en cm)</span></label>
								<input type="text" placeholder="Hauteur en cm" class="sizeInput" v-model.number="hauteur" @click="reset" @keyup="checkSize('hauteur', $event.target.value)" />
							</div>
						</li>

						<transition name="slideLeft"><li class="formSelect fieldError" v-show="showEsize" style="margin:-5px 0 15px">{{ errorSize }}</li></transition>

						<li class="formSelect" v-show="tissuSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'60x230 recto');"  @mouseout="hout(9)" @click="reset(); selectSize('60x230 recto');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>60x230 cm recto</span>
									</div>
									<div @mouseover="hoPw(9,'90x230 recto');"  @mouseout="hout(9)" @click="reset(); selectSize('90x230 recto');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>90x230 cm recto</span>
									</div>
									<div @mouseover="hoPw(9,'120x230 recto');" @mouseout="hout(9)" @click="reset(); selectSize('120x230 recto');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>120x230 cm recto</span>
									</div>
									<div @mouseover="hoPw(9,'150x230 recto');" @mouseout="hout(9)" @click="reset(); selectSize('150x230 recto');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>150x230 cm recto</span>
									</div>

									<div @mouseover="hoPw(9,'60x230 recto/verso');"  @mouseout="hout(9)" @click="reset(); selectSize('60x230 recto/verso');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>60x230 cm recto/verso</span>
									</div>
									<div @mouseover="hoPw(9,'90x230 recto/verso');"  @mouseout="hout(9)" @click="reset(); selectSize('90x230 recto/verso');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>90x230 cm recto/verso</span>
									</div>
									<div @mouseover="hoPw(9,'120x230 recto/verso');" @mouseout="hout(9)" @click="reset(); selectSize('120x230 recto/verso');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>120x230 cm recto/verso</span>
									</div>
									<div @mouseover="hoPw(9,'150x230 recto/verso');" @mouseout="hout(9)" @click="reset(); selectSize('150x230 recto/verso');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>150x230 cm recto/verso</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="photoSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'220x240 cm tissu 220g m1');" @mouseout="hout(9)" @click="reset(); selectSize('tissu 220g');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>220x240cm avec textile 220g M1</span>
									</div>
									<div  @mouseover="hoPw(9,'200x220 cm toile pvc m1');" @mouseout="hout(9)" @click="reset(); selectSize('PVC');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>200x220cm avec toile PVC M1</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="blizzardSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'60x160 cm');"   @mouseout="hout(9)" @click="reset(); selectSize('60x160');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>60x160 cm</span>
									</div>
									<div  @mouseover="hoPw(9,'80x200 cm');" @mouseout="hout(9)" @click="reset(); selectSize('80x200');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>80x200 cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="mistralSize">

							<button type="button" class="toggle" :class="reqSize" @click="toggleSize = !toggleSize">
								{{ choixSize }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSize">
									<div @mouseover="hoPw(9,'80x200 1 visuel');" @mouseout="hout(9)" @click="reset(); selectSize('80x200 1 visuel');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>80x200 cm (Recto/verso 1 visuel)</span>
									</div>
									<div @mouseover="hoPw(9,'80x200 2 visuels');" @mouseout="hout(9)" @click="reset(); selectSize('80x200 2 visuels');">
										<i class="fa fa-expand" aria-hidden="true"></i></i><span>80x200 cm (Recto/verso 2 visuels)</span>
									</div>
								</div>
							</transition>

						</li>


						<li class="formSelect" v-show="firstSupport">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp" >

									<div @mouseover="hoPw(9,'bâche 440g');" @mouseout="hout(9)" v-tooltip.bottom="$global.b440" @click="reset(); selectSupport('bache 440g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>bâche 440g</span>
									</div>
									<div @mouseover="hoPw(9,'Dickson Jet 520 M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.b520" @click="reset(); selectSupport('jet 520 M1');">
										<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
										<i class="fa fa-sticky-note fared" aria-hidden="true"></i><span>Dickson Jet 520 M1</span>
									</div>
									<div @mouseover="hoPw(9,'100% écologique M1');" @mouseout="hout(9)" v-tooltip.bottom="$global.beco" @click="reset(); selectSupport('bache 100% écologique M1');" v-if="opeco">
										<div class="corneco"><i class="fa fa-leaf" aria-hidden="true"></i></div>
										<i class="fa fa-sticky-note fagreen" aria-hidden="true"></i><span>100% écologique M1</span>
									</div>
									<div @mouseover="hoPw(9,'PVC 300 microns');" @mouseout="hout(9)" v-tooltip.bottom="$global.b300" @click="reset(); selectSupport('PVC 300 mircons');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>PVC 300 microns</span>
									</div>
									<div @mouseover="hoPw(9,'PVC 300 microns');" @mouseout="hout(9)" v-tooltip.bottom="$global.b300" @click="reset(); selectSupport('Recto/verso PVC 300µ');" v-show="shClip">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>RECTO/ VERSO PVC 300 microns</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="tissuSupport">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp" >

									<div @mouseover="hoPw(9,'tissu 220g');" @mouseout="hout(9)" v-tooltip.bottom="$global.s220" @click="reset(); selectSupport('tissu 220g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu stretch léger 220g M1</span>
									</div>
									<div @mouseover="hoPw(9,'tissu 260g');" @mouseout="hout(9)" v-tooltip.bottom="$global.s260" @click="reset(); selectSupport('tissu 260g');">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>tissu stretch dos noir 260g B1</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="totemOption">

							<button type="button" class="toggle" :class="reqTopt" @click="toggleTopt = !toggleTopt">
								{{ choixTopt }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleTopt" >

									<div @mouseover="hoPw(9,'sans option');" @mouseout="hout(9)" @click="reset(); selectOpt('sans option');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>sans option</span>
									</div>
									<div @mouseover="hoPw(9,'ventouse');" @mouseout="hout(9)" @click="reset(); selectOpt('ventouse');" v-if="optClip">
										<i class="fa fa-check-circle-o" aria-hidden="true"></i><span>Ventouse super adhesive 65mm</span>
									</div>
									<div @mouseover="hoPw(9,'sac de transport');" @mouseout="hout(9)" @click="reset(); selectOpt('sac');" v-else>
										<i class="fa fa-check-circle-o" aria-hidden="true"></i><span>sac de transport noir</span>
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

							<li><img :src="$global.img+'/totem/slide/totem-5.jpg'" alt="kakemono totem pas cher" title="totem publicitaire impression" /></li>
				      <li><img :src="$global.img+'/totem/slide/totem-1.jpg'" alt="kakemono totem pas cher" title="totem publicitaire impression" /></li>
				      <li><img :src="$global.img+'/totem/slide/totem-4.jpg'" alt="kakemono totem pas cher" title="totem publicitaire impression" /></li>
				      <li><img :src="$global.img+'/totem/slide/totem-0.jpg'" alt="plv kakemono" title="totem kakemono meilleur prix"  /></li>
				      <li><img :src="$global.img+'/totem/slide/totem-2.jpg'" alt="totem plv imprimé" title="totem publicitaire pas cher"  /></li>

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
					<a :href="$global.url+'/notice-technique-totem-meilleur-prix/'" class="notice modal-link"  title="notices techniques">
						<i class="fa fa-wrench"       aria-hidden="true"></i> <span class="textHide">Notices</span>
					</a>
					<a :href="$global.url+'/gabarit-totem-gabarit-kakemono-tissu/'" class="notice modal-link"  title="gabarits maquette">
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
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.2"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.totem.js?v=2.3"></script>
