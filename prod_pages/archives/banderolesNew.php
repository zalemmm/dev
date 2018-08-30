<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer" :style="rowHeight"> <!--bloc formulaire-->

			<h3>Votre devis en ligne Banderole</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div v-show="toggleSupp">

									<div class="supCat">
										<div class="scat clEco" @click="swEco = true; swNml = swFeu = swTis = false">écologique <i class="fa fa-caret-down"></i></div>
										<div class="scat clNml" @click="swNml = true; swEco = swFeu = swTis = false">traditionnel <i class="fa fa-caret-down"></i></div>
										<div class="scat clFeu" @click="swFeu = true; swNml = swEco = swTis = false">anti-feu <i class="fa fa-caret-down"></i></div>
										<div class="scat clTis" @click="swTis = true; swNml = swEco = swFeu = false">tissu <i class="fa fa-caret-down"></i></div>
										<div class="scat clAll" @click="swNml = swEco = swFeu = swTis = true;">Tous <i class="fa fa-caret-down"></i></div>
									</div>

									<div class="boutonsSelect" >

										<div class="clEco" @mouseover="hoPw(1,'ecotoile')" @mouseout="hout(1)" v-tooltip.bottom="$global.ecotm2" @click="reset(); selectSupport('ecotoile');" v-if="swEco">
											<div class="corneco"><i class="fa fa-leaf" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/ecotoile.png'" /><span>Ecotoile 175g</span>
										</div>
										<div class="clEco" @mouseover="hoPw(1,'eco')"      @mouseout="hout(1)" v-tooltip.bottom="$global.becom2" @click="reset(); selectSupport('bache 100% écologique M1');" v-if="swEco || swFeu">
											<div class="corneco"><i class="fa fa-leaf" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/eco.png'" /><span>100% éco. 250g M1</span>
										</div>
										<div class="clEco" @mouseover="hoPw(1,'capotoile')"@mouseout="hout(1)" v-tooltip.bottom="$global.capom2" @click="reset(); selectSupport('capotoile');" v-if="swEco || swFeu">
											<div class="corneco"><i class="fa fa-leaf" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/capotoile.png'" /><span>Capotoile 280g M1 Ecocert</span>
										</div>

										<div class="clNml" @mouseover="hoPw(1,'440g')"     @mouseout="hout(1)" v-tooltip.bottom="$global.b440m2" @click="reset(); selectSupport('bache 440g');" v-if="swNml">
											<img :src="$global.img+'/banderole/440g.png'" /><span>bâche 440g</span>
										</div>
										<div class="clNml" @mouseover="hoPw(1,'550g')"     @mouseout="hout(1)" @click="reset(); selectSupport('jet 550 enduite');" v-if="swNml && swRvd"> <!-- cacher aux non revendeurs-->
											<img :src="$global.img+'/banderole/550g.png'" /><span>bâche 550g enduite</span>
										</div>
										<div class="clNml" @mouseover="hoPw(1,'jet550')"   @mouseout="hout(1)" v-tooltip.bottom="$global.b550m2" @click="reset(); selectSupport('jet 550');" v-if="swNml">
											<img :src="$global.img+'/banderole/jet550.png'" /><span>Dickson Jet 550g</span>
										</div>
										<div class="clNml" @mouseover="hoPw(1,'micro')"    @mouseout="hout(1)" v-tooltip.bottom="$global.microm2" @click="reset(); selectSupport('bache micro perforee M1');" v-if="swNml">
											<img :src="$global.img+'/banderole/micro.png'" /><span>micro perforée 300g</span>
										</div>
										<div class="clNml" @mouseover="hoPw(1,'150g')"     @mouseout="hout(1)" v-tooltip.bottom="$global.b150m2"  @click="reset(); selectSupport('bache nontisse 150g');" v-if="swNml">
											<img :src="$global.img+'/banderole/150g.png'" /><span>nontissé 150g</span>
										</div>

										<div class="clFeu" @mouseover="hoPw(1,'450g')"     @mouseout="hout(1)" @click="reset(); selectSupport('bache 450 M1');" v-if="swFeu && swRvd"> <!-- cacher aux non revendeurs -->
											<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/450g.png'" /><span>bâche 450g M1</span>
										</div>
										<div class="clFeu" @mouseover="hoPw(1,'jet520')"   @mouseout="hout(1)" v-tooltip.bottom="$global.b520m2" @click="reset(); selectSupport('jet 520 M1');" v-if="swFeu">
											<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/jet520.png'" /><span>Dickson Jet 520g M1</span>
										</div>
										<div class="clFeu" @mouseover="hoPw(1,'750g')"     @mouseout="hout(1)" v-tooltip.bottom="$global.lacom2" @click="reset(); selectSupport('lacopac');" v-if="swFeu">
											<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/750g.png'" /><span>Lacopac 680g M2/B1</span>
										</div>
										<div class="clFeu" @mouseover="hoPw(1,'750g')"     @mouseout="hout(1)" v-tooltip.bottom="$global.lacom2" @click="reset(); selectSupport('lacopac recto verso');" v-if="swFeu">
											<div class="cornfire"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i></div>
											<img :src="$global.img+'/banderole/750g.png'" /><span>Lacopac 680g recto/verso</span>
										</div>

										<div class="clTis" @mouseover="hoPw(1,'220g')"     @mouseout="hout(1)" v-tooltip.bottom="$global.t220m2" @click="reset(); selectSupport('tissu 220g');" v-if="swTis">
											<img :src="$global.img+'/banderole/220g.png'" /><span>tissu stretch léger 220g M1</span>
										</div>
										<div class="clTis" @mouseover="hoPw(1,'260g')"     @mouseout="hout(1)" v-tooltip.bottom="$global.t260m2" @click="reset(); selectSupport('tissu 260g');" v-if="swTis">
											<img :src="$global.img+'/banderole/260g.png'" /><span>tissu stretch dos noir 260g B1</span>
										</div>

									</div>
								</div>
							</transition>

						</li>

						<!-- =============================================================== déroulé spécial nontissé -->
						<li class="formSelect" v-show="showFini">

							<button type="button" class="toggle" :class="reqFini" @click="toggleFini = !toggleFini">
								{{ choixFini }} {{ choixFpce }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFini">
									<div @mouseover="hoPw(2,0)"            @mouseout="hout(2)" @click="reset(); selectFini('pas de finition');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>pas de finition</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletshb')" @mouseout="hout(2)" @click="reset(); selectFini('oeillets haut/bas');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>oeillets haut/bas</span>
									</div>
									<div @mouseover="hoPw(2,'fourreaux')"  @mouseout="hout(2)" @click="reset(); selectFini('fourreaux gauche/droite');">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i><span>fourreaux gauche/droite</span>
									</div>
								</div>
							</transition>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFpce">
									<div @click="reset(); selectFpace('tous les 100cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 100cm</span>
									</div>
									<div @click="reset(); selectFpace('tous les 50cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 50cm</span>
									</div>
									<div @click="reset(); selectFpace('tous les 25cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 25cm</span>
									</div>
									<div @click="reset(); selectFpace('tous les 10cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 10cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showFfix">

							<button type="button" class="toggle" :class="reqFfix" @click="toggleFfix = !toggleFfix">
								{{ choixFfix }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFfix">
									<div @mouseover="hoPw(5,0)"            @mouseout="hout(5)" @click="reset(); selectFfix('pas de fixation');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>pas de fixation</span>
									</div>
									<div @mouseover="hoPw(5,'tendeur')"    @mouseout="hout(5)" @click="reset(); selectFfix('tendeurs H/B tous les metres');" >
										<img :src="$global.img+'/fixation/tendeur.svg'" /><span>tendeurs tous les mètres</span>
									</div>
									<div @mouseover="hoPw(5,'tourillons')" @mouseout="hout(5)" @click="reset(); selectFfix('2 tourillons bois et sandows');">
										<img :src="$global.img+'/fixation/tourillon.svg'" /><span>2 tourillons + sandows</span>
									</div>
								</div>
							</transition>
						</li>
						<!-- =============================================================== fin déroulé spécial nontissé -->

						<li class="formSelect" v-show="showOeil">

							<button type="button" class="toggle" :class="reqOeil" @click="toggleOeil = !toggleOeil">
								{{ choixOeil }} {{ choixSpce }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleOeil">
									<div @mouseover="hoPw(2,0)"              @mouseout="hout(2)" @click="reset(); selectOeil('sans oeillets');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>sans oeillets</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletsc')"    @mouseout="hout(2)" @click="reset(); selectOeil('oeillets aux coins');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>oeillets aux coins</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletshb25')" @mouseout="hout(2)" @click="reset(); selectOeil('oeillets haut/bas');"       >
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>oeillets haut/bas</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletsgd25')" @mouseout="hout(2)" @click="reset(); selectOeil('oeillets gauche/droite');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>oeillets gauche/droite</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletsp')"    @mouseout="hout(2)" @click="reset(); selectOeil('oeillets tout le tour');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>oeillets tout le tour</span>
									</div>
								</div>
							</transition>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSpce">
									<div @mouseover="hoPw(2,'oeilletshb')"   @mouseout="hout(2)" @click="reset(); selectSpace('tous les 100cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 100cm</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletshb50')" @mouseout="hout(2)" @click="reset(); selectSpace('tous les 50cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 50cm</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletsp')"    @mouseout="hout(2)" @click="reset(); selectSpace('tous les 25cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 25cm</span>
									</div>
									<div @mouseover="hoPw(2,'oeilletsp10')"  @mouseout="hout(2)" @click="reset(); selectSpace('tous les 10cm');">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>tous les 10cm</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showOrlt">

							<button type="button" class="toggle" :class="reqOrlt" @click="toggleOrlt = !toggleOrlt">
								{{ choixOrlt }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleOrlt">
									<div @mouseover="hoPw(3,0)"           @mouseout="hout(3)" @click="reset(); selectOrlt('sans ourlet');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>sans ourlet</span>
									</div>
									<div @mouseover="hoPw(3,'ourletshb')" @mouseout="hout(3)" v-tooltip.bottom="$global.ourlhb" @click="reset(); selectOrlt('ourlet de renfort haut/bas');" v-show="ourletsHB">
										<i class="fa fa-ellipsis-h" aria-hidden="true"></i><span>ourlet de renfort haut/bas</span>
									</div>
									<div @mouseover="hoPw(3,'ourletsgd')" @mouseout="hout(3)" v-tooltip.bottom="$global.ourlgd" @click="reset(); selectOrlt('ourlet de renfort gauche/droite');" v-show="ourletsGD">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i><span>ourlet de renfort gauche/droite</span>
									</div>
									<div @mouseover="hoPw(3,'ourlets')"   @mouseout="hout(3)" v-tooltip.bottom="$global.ourlpr" @click="reset(); selectOrlt('ourlet de renfort perimetrique');"  v-show="ourletsP">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>ourlet de renfort perimetrique</span>
									</div>
								</div>
							</transition>
						</li>

						<li class="formSelect" v-show="showFour">

							<button type="button" class="toggle" :class="reqFour" @click="toggleFour = !toggleFour">
								{{ choixFour }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFour">
									<div @mouseover="hoPw(4,0)"             @mouseout="hout(4)" @click="reset(); selectFour('sans fourreaux');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>sans fourreaux</span>
									</div>
									<div @mouseover="hoPw(4,'fourreauxhb')" @mouseout="hout(4)" @click="reset(); selectFour('fourreaux haut/bas');" v-tooltip.bottom="$global.fourhb" v-show="fourreauxHB">
										<i class="fa fa-ellipsis-h" aria-hidden="true"></i><span>fourreaux haut/bas</span>
									</div>
									<div @mouseover="hoPw(4,'fourreaux')"   @mouseout="hout(4)" @click="reset(); selectFour('fourreaux gauche/droite');" v-tooltip.bottom="$global.fourgd" v-show="fourreauxGD">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i><span>fourreaux gauche/droite</span>
									</div>
								</div>
							</transition>
						</li>

						<li class="formSelect" v-show="showScra">

							<button type="button" class="toggle" :class="reqScra" @click="toggleScra = !toggleScra">
								{{ choixScra }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleScra">
									<div @mouseover="hoPw(3,0)"           @mouseout="hout(3)" @click="reset(); selectScra('sans scratch');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>sans scratch</span>
									</div>
									<div @mouseover="hoPw(3,'ourletshb')" @mouseout="hout(3)" @click="reset(); selectScra('scratch haut/bas');" v-tooltip.bottom="$global.scrahb">
										<i class="fa fa-ellipsis-h" aria-hidden="true"></i><span>scratch haut/bas</span>
									</div>
									<div @mouseover="hoPw(3,'ourletsgd')" @mouseout="hout(3)" @click="reset(); selectScra('scratch gauche/droite');" v-tooltip.bottom="$global.scragd">
										<i class="fa fa-ellipsis-v" aria-hidden="true"></i><span>scratch gauche/droite</span>
									</div>
									<div @mouseover="hoPw(3,'ourlets')"   @mouseout="hout(3)" @click="reset(); selectScra('scratch perimetrique');" v-tooltip.bottom="$global.scrapr">
										<i class="fa fa-circle-o" aria-hidden="true"></i><span>scratch perimetrique</span>
									</div>
								</div>
							</transition>
						</li>

						<li class="formSelect" v-show="showFixx">

							<button type="button" class="toggle" :class="reqFixx" @click="toggleFixx = !toggleFixx">
								{{ choixFixx }} {{ choixFxqt }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleFixx">
									<div @mouseover="hoPw(5,0)"            @mouseout="hout(5)" @click="reset(); selectFixx('pas de fixation');">
										<i class="fa fa-ban" aria-hidden="true"></i><span>pas de fixation</span>
									</div>
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

						<li class="optLi optSize">
							<div class="sizeContainer" :class="reqHaut">
								<label class="sizeLabel" :class="reqHaut">hauteur <span class="small">(en mètres)</span></label>
								<input type="text" placeholder="ex: 0.85" class="sizeInput" v-model.number="hauteur" @click="reset" @keyup="checkSize('hauteur', $event.target.value)"/>
							</div>

							<div class="sizeContainer" :class="reqLarg">
								<label class="sizeLabel" :class="reqLarg">largeur <span class="small">(en mètres)</span></label>
								<input type="text" placeholder="ex: 1.7" class="sizeInput" v-model.number="largeur" @click="reset" @keyup="checkSize('largeur', $event.target.value)"/>
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

								<span class="optCheck" v-show="showRoll">
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

		</div> <!-- fin bloc formulaire #buying -->

		<!--bloc preview-->
		<div class="column" id="previewContainer">
			<div id="previewImg">

				<transition name="slideDown">
					<div id="container" v-if="slideContainer">
						<ul id="slides">
							<li><img :src="$global.img+'/banderole/slide/banderole-1.jpg'" alt="banderole pas cher" title="bâche imprimée meilleur prix" /></li>
							<li><img :src="$global.img+'/banderole/slide/banderole-3.jpg'" alt="banderole sur mesure"  title="impression grand format pas cher"/></li>
							<li><img :src="$global.img+'/banderole/slide/banderole-4.jpg'" alt="bâche imprimée" title="banderoles évènements"/></li>
							<li><img :src="$global.img+'/banderole/slide/devis-en-ligne.png'" alt="commencez votre devis en ligne" title="devis impression grand format" /></li>
							<li><img :src="$global.img+'/banderole/slide/banderole-2.jpg'" alt="banderole sur mesure"  title="impression grand format pas cher"/></li>
							<li><img :src="$global.img+'/banderole/slide/banderole-0.jpg'" alt="bâche imprimée" title="banderoles évènements"/></li>
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

			</div>

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

		</div>  <!-- fin bloc image #previewContainer -->

	</div>
</div> <!-- fin bloc app  -->

<!--<script src="../wp-content/plugins/fbshop/js/vue.js"></script>-->
<script src="../wp-content/plugins/fbshop/js/vue.min.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=2.2"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.banderoles.js?v=2.4"></script>
