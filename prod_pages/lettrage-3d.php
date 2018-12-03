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
									<div @mouseover="hoverProd('Lettrage 3d standard');" @mouseout="outProd()" v-tooltip.bottom="$global.l3ds" @click="reset(); selectProd('Lettrage 3d standard');">
										<i class="l3d">S</i> <span>Lettrage 3d standard</span>
									</div>
									<div @mouseover="hoverProd('Lettrage 3d lumineux');" @mouseout="outProd()" v-tooltip.bottom="$global.l3dl" @click="reset(); selectProd('Lettrage 3d lumineux');">
										<i class="l3d" style="text-shadow: 1px 1px #777,2px 2px #777,3px 3px #777,-.6px -.6px 12px #777;">L</i> <span>Lettrage 3d lumineux</span>
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
									<div @mouseover="hoverSupport('pvc');"      @mouseout="outSupport()"  v-tooltip.bottom="$global.lpvc" @click="reset(); selectSupport('pvc');">
										<i class="l3d">PVC</i> <span>PVC</span>
									</div>
									<div @mouseover="hoverSupport('plexiglas')" @mouseout="outSupport()" v-tooltip.bottom="$global.plexi" @click="reset(); selectSupport('plexiglas');" v-if="stand">
										<i class="l3d">PLX</i> <span>Plexiglas</span>
									</div>
									<div @mouseover="hoverSupport('dibond');"   @mouseout="outSupport()" v-tooltip.bottom="$global.ldib" @click="reset(); selectSupport('dibond');" v-if="stand">
										<i class="l3d">DIB</i>	</i> <span>Dibond</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showFini && dib">

							<button type="button" class="toggle" :class="reqFini" @click="toggleFini = !toggleFini">
								{{ choixFini }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div  class="boutonsSelect" v-show="toggleFini">
									<div @mouseover="hoverFinition('blanc');"  @mouseout="outFinition()" @click="reset(); selectFinition('blanc');">
										<i class="l3d">B</i> <span>Blanc</span>
									</div>
									<div @mouseover="hoverFinition('brossé');" @mouseout="outFinition()" @click="reset(); selectFinition('brossé');">
										<i class="l3d">B</i> <span>Brossé</span>
									</div>
									<div @mouseover="hoverFinition('mirroir')" @mouseout="outFinition()" @click="reset(); selectFinition('mirroir');" v-if="stand">
										<i class="l3d">M</i> <span>Mirroir</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showEpai">

							<button type="button" class="toggle" :class="reqEpai" @click="toggleEpai = !toggleEpai">
								{{ choixEpai }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div  class="boutonsSelect" v-show="toggleEpai">
									<div @mouseover="hoverEpai('3')"  @mouseout="outEpai()" @click="reset(); selectEpaisseur('3');"  v-if="plx || dib">
										<i class="l3d h03">3</i> <span>3 mm</span>
									</div>
									<div @mouseover="hoverEpai('10')" @mouseout="outEpai()" @click="reset(); selectEpaisseur('10');" v-if="(pvc || plx) && !lumi">
										<i class="l3d h10">10</i> <span>10 mm</span>
									</div>
									<div @mouseover="hoverEpai('19')" @mouseout="outEpai()" @click="reset(); selectEpaisseur('19');" v-if="pvc">
										<i class="l3d h20">19</i> <span>19 mm</span>
									</div>
									<div @mouseover="hoverEpai('20')" @mouseout="outEpai()" @click="reset(); selectEpaisseur('20');" v-if="plx">
										<i class="l3d h20">20</i> <span>20 mm</span>
									</div>
									<div @mouseover="hoverEpai('30')" @mouseout="outEpai()" @click="reset(); selectEpaisseur('30');" v-if="pvc">
										<i class="l3d h30">30</i> <span>30 mm</span>
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
									<div class="selectQte" @mouseover="hoPw(9,'10 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('10 cm');"><i class="fa fa-arrows-v"></i> <span>10 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'15 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('15 cm');"><i class="fa fa-arrows-v"></i> <span>15 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'20 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('20 cm');"><i class="fa fa-arrows-v"></i> <span>20 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'25 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('25 cm');"><i class="fa fa-arrows-v"></i> <span>25 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'30 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('30 cm');"> <i class="fa fa-arrows-v"></i> <span>30 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'40 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('40 cm');"> <i class="fa fa-arrows-v"></i> <span>40 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'50 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('50 cm');"> <i class="fa fa-arrows-v"></i> <span>50 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'60 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('60 cm');"> <i class="fa fa-arrows-v"></i> <span>60 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'70 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('70 cm');"> <i class="fa fa-arrows-v"></i> <span>70 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'80 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('80 cm');"> <i class="fa fa-arrows-v"></i> <span>80 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'90 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('90 cm');"> <i class="fa fa-arrows-v"></i> <span>90 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'100 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('100 cm');"> <i class="fa fa-arrows-v"></i> <span>100 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'110 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('110 cm');" v-if="stand"> <i class="fa fa-arrows-v"></i> <span>110 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'120 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('120 cm');" v-if="stand"> <i class="fa fa-arrows-v"></i> <span>120 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'130 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('130 cm');" v-if="stand"> <i class="fa fa-arrows-v"></i> <span>130 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'140 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('140 cm');" v-if="stand"> <i class="fa fa-arrows-v"></i> <span>140 cm</span></div>
									<div class="selectQte" @mouseover="hoPw(9,'150 cm');" @mouseout="hout(9)" @click="reset(); selectHaut('150 cm');" v-if="stand"> <i class="fa fa-arrows-v"></i> <span>150 cm</span></div>

								</div>
							</transition>
						</li>


						<li class="formSelect  optSize" v-show="showText">
							<div class="qteContainer" :class="reqText">
								<label class="sizeLabel" :class="reqText">Saisir le texte: <br/><small v-show="showTyping">({{ nbSignes }} signes)</small></label>
								<input type="text" placeholder="Saisir le texte" class="sizeInput" v-model="texte" @click="reset" @keyup="checkSize('texte', $event.target.value)" />
							</div>
						</li>

						<li class="formSelect" v-show="showTypo">

							<button type="button" class="toggle" :class="reqTypo" @click="toggleTypo = !toggleTypo">
								{{ choixTypo }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div v-show="toggleTypo">
									<div class="boutonsSelect" >
										<div class="selectQte" @mouseover="hoverTypo('Arial')"           @mouseout="outTypo()" @click="reset(); selectTypo('Arial');">
											<i class="l3d sm arial">A</i> <span>Arial</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Times new roman')" @mouseout="outTypo()" @click="reset(); selectTypo('Times new roman');">
											<i class="l3d sm times">A</i> <span>Times new roman</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Sansation')"       @mouseout="outTypo()" @click="reset(); selectTypo('Sansation');">
											<i class="l3d sm sansation">A</i> <span>Sansation</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Exo')"             @mouseout="outTypo()" @click="reset(); selectTypo('Exo');">
											<i class="l3d sm exo">A</i> <span>Exo</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Montserrat')"      @mouseout="outTypo()" @click="reset(); selectTypo('Montserrat');">
											<i class="l3d sm mont">A</i> <span>Montserrat</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Patua One')"       @mouseout="outTypo()" @click="reset(); selectTypo('Patua One');">
											<i class="l3d sm patua">A</i> <span>Patua One</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Krub')"            @mouseout="outTypo()" @click="reset(); selectTypo('Krub');">
											<i class="l3d sm krub">A</i> <span>Krub</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Russo One')"       @mouseout="outTypo()" @click="reset(); selectTypo('Russo One');">
											<i class="l3d sm russo">A</i> <span>Russo One</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Bangers')"         @mouseout="outTypo()" @click="reset(); selectTypo('Bangers');">
											<i class="l3d sm bangers">A</i> <span>Bangers</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Boogaloo')"        @mouseout="outTypo()" @click="reset(); selectTypo('Boogaloo');">
											<i class="l3d sm boogaloo">A</i> <span>Boogaloo</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Concert One')"     @mouseout="outTypo()" @click="reset(); selectTypo('Concert One');">
											<i class="l3d sm concert">A</i> <span>Concert One</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Fugaz One')"       @mouseout="outTypo()" @click="reset(); selectTypo('Fugaz One');">
											<i class="l3d sm fugaz">A</i> <span>Fugaz One</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Inconsolata')"     @mouseout="outTypo()" @click="reset(); selectTypo('Inconsolata');">
											<i class="l3d sm inco">A</i> <span>Inconsolata</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Sigmar One')"      @mouseout="outTypo()" @click="reset(); selectTypo('Sigmar One');">
											<i class="l3d sm sigmar">A</i> <span>Sigmar One</span>
										</div>
										<div class="selectQte" @mouseover="hoverTypo('Suez One')"        @mouseout="outTypo()" @click="reset(); selectTypo('Suez One');">
											<i class="l3d sm suez">A</i> <span>Suez One</span>
										</div>
									</div>

									<div class="qteContainer">
										<label class="sizeLabel">Ou entrez un nom de typo:</label>
										<input type="text" placeholder="ex: Arial" class="sizeInput" v-model="typo" @click="reset" @keyup="checkTypo('typo', $event.target.value)" />
									</div>

								</div>
							</transition>
						</li>

						<transition name="slideLeft"><li class="formSelect fieldError" v-show="showEsize" style="margin-top:-5px; margin-bottom: 15px;">{{ errorSize }}</li></transition>

						<li class="formSelect" v-show="showCoul && neutral">

							<button type="button" class="toggle" :class="reqCoul" @click="toggleCoul = !toggleCoul">
								{{ choixCoul }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">

								<div class="boutonsSelect" v-show="toggleCoul" >
									<div @mouseover="hoverCoul('rouge');" @mouseout="outCoul()" @click="reset(); selectCoul('rouge');">
										<i class="l3d" style="color:#d84d4d;text-shadow:1px 1px #c32929,2px 2px #c32929,3px 3px #c32929,-.1px -.1px 1px #c32929;">R</i><span>Rouge</span>
									</div>
									<div @mouseover="hoverCoul('bleu');"  @mouseout="outCoul()" @click="reset(); selectCoul('bleu');">
										<i class="l3d" style="color:#504dd8;text-shadow:1px 1px #382eb8,2px 2px #382eb8,3px 3px #382eb8,-.1px -.1px 1px #382eb8;">B</i><span>Bleu</span>
									</div>
									<div @mouseover="hoverCoul('vert');"  @mouseout="outCoul()" @click="reset(); selectCoul('vert');">
										<i class="l3d" style="color:#37ba53;text-shadow:1px 1px #2a9441,2px 2px #2a9441,3px 3px #2a9441,-.1px -.1px 1px #2a9441;">V</i><span>Vert</span>
									</div>
									<div @mouseover="hoverCoul('blanc');" @mouseout="outCoul()" @click="reset(); selectCoul('blanc');">
										<i class="l3d">B</i><span>Blanc</span>
									</div>
									<div @mouseover="hoverCoul('Brut');"  @mouseout="outCoul()" @click="reset(); selectCoul('Brut');" v-if="plx">
										<i class="l3d">B</i><span>Brut</span>
									</div>
								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showCled && lumi">

							<button type="button" class="toggle" :class="reqCled" @click="toggleCled = !toggleCled">
								{{ choixCled }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleCled" >

									<div @mouseover="hoverCled('rouge');" @mouseout="outCled()" @click="reset(); selectCled('rouge');">
										<i class="fa fa-circle" style="color:#d84d4d;text-shadow:-.6px -.6px 12px #c32929;"></i><span>Rouge</span>
									</div>
									<div @mouseover="hoverCled('bleu');"  @mouseout="outCled()" @click="reset(); selectCled('bleu');">
										<i class="fa fa-circle" style="color:#504dd8;text-shadow:-.6px -.6px 12px #382eb8;"></i><span>Bleu</span>
									</div>
									<div @mouseover="hoverCled('vert');"  @mouseout="outCled()" @click="reset(); selectCled('vert');">
										<i class="fa fa-circle" style="color:#37ba53;text-shadow:-.6px -.6px 12px #2a9441;"></i><span>Vert</span>
									</div>
									<div @mouseover="hoverCled('blanc');" @mouseout="outCled()" @click="reset(); selectCled('blanc');">
										<i class="fa fa-circle" style="color:#ffffff;text-shadow:-.6px -.6px 12px #cccccc;"></i><span>Blanc</span>
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
					<span class="letter3d" :style="layerCont">

							<span :style="layerText">
								<svg height="1000px" width="1000px" viewBox="0 0 1000 1000" shape-rendering="geometricPrecision">
									<defs>
										<filter id="glow" x="-30%" y="-30%" width="160%" height="160%">
							        <feGaussianBlur stdDeviation="5 5" result="glow"/>
							        <feMerge>
							          <feMergeNode in="glow" />
							          <feMergeNode in="glow" />
							          <feMergeNode in="glow" />
							        </feMerge>
							      </filter>

										<filter id="xslim">
							        <feComposite id="diff-composite" operator="arithmetic" k1="0" k3="1" in="difflight" in2="scatter-text" result="post-diffuse"></feComposite>
							        <feComposite operator="in" in="shinylight" in2="post-diffuse" result="just-shine"></feComposite>
							        <feComposite id="shine-composite" operator="arithmetic" k2="0" k3="1" in="just-shine" in2="post-diffuse" result="post-spec"></feComposite>

							        <feOffset id="offset-1"  in="post-spec" dx="0" dy="1" result="off1"></feOffset>
											<feOffset id="offset-2"  in="post-spec" dx="0" dy="2" result="off2"></feOffset>
											<feOffset id="offset-3"  in="post-spec" dx="0" dy="3" result="off3"></feOffset>

							        <feMerge result="pre-color-extru">
		                    <feMergeNode in="off1"></feMergeNode>
		                    <feMergeNode in="off2"></feMergeNode>
		                    <feMergeNode in="off3"></feMergeNode>
							        </feMerge>

							        <feFlood id="extru-RGBA" :flood-color="extru" flood-opacity="1"></feFlood>
							        <feComposite operator="in" in2="pre-color-extru" result="colored-extru"></feComposite>

							         <feImage id="texture-extr" width="500" height="500" xlink:href="https://www.france-banderole.com/wp-content/themes/fb/images/txtsteel.png"></feImage>

							        <feBlend id="texture-blend-extr" mode="multiply" in2="colored-extru"></feBlend>
							        <feComposite operator="in" in2="colored-extru" result="textured-extru"></feComposite>

							        <feMerge>
							          <feMergeNode in="textured-extru"></feMergeNode>
							          <feMergeNode in="post-spec"></feMergeNode>
							        </feMerge>
									  </filter>

									  <filter id="slim">
							        <feComposite id="diff-composite" operator="arithmetic" k1="0" k3="1" in="difflight" in2="scatter-text" result="post-diffuse"></feComposite>
							        <feComposite operator="in" in="shinylight" in2="post-diffuse" result="just-shine"></feComposite>
							        <feComposite id="shine-composite" operator="arithmetic" k2="0" k3="1" in="just-shine" in2="post-diffuse" result="post-spec"></feComposite>

							        <feOffset id="offset-1"  in="post-spec" dx="0" dy="1" result="off1"></feOffset>
											<feOffset id="offset-2"  in="post-spec" dx="0" dy="2" result="off2"></feOffset>
											<feOffset id="offset-3"  in="post-spec" dx="0" dy="3" result="off3"></feOffset>
											<feOffset id="offset-4"  in="post-spec" dx="0" dy="4" result="off4"></feOffset>
											<feOffset id="offset-5"  in="post-spec" dx="0" dy="5" result="off5"></feOffset>

							        <feMerge result="pre-color-extru">
		                    <feMergeNode in="off1"></feMergeNode>
		                    <feMergeNode in="off2"></feMergeNode>
		                    <feMergeNode in="off3"></feMergeNode>
		                    <feMergeNode in="off4"></feMergeNode>
		                    <feMergeNode in="off5"></feMergeNode>
							        </feMerge>

							        <feFlood id="extru-RGBA" :flood-color="extru" flood-opacity="1"></feFlood>
							        <feComposite operator="in" in2="pre-color-extru" result="colored-extru"></feComposite>

							        <feImage id="texture-extr" width="500" height="500" xlink:href="https://www.france-banderole.com/wp-content/themes/fb/images/txtsteel.png"></feImage>

							        <feBlend id="texture-blend-extr" mode="multiply" in2="colored-extru"></feBlend>
							        <feComposite operator="in" in2="colored-extru" result="textured-extru"></feComposite>

							        <feMerge>
							          <feMergeNode in="textured-extru"></feMergeNode>
							          <feMergeNode in="post-spec"></feMergeNode>
							        </feMerge>
									  </filter>

										<filter id="medium">
											<feColorMatrix in="SourceGraphic" type="matrix" values="0 0 0 0 1  0 0 0 0 1  0 0 0 0 1  0 0 0 1 0" result="SourceWhite"></feColorMatrix>

							        <feComposite id="diff-composite" operator="arithmetic" k1="0" k3="1" in="difflight" in2="scatter-text" result="post-diffuse"></feComposite>
							        <feComposite operator="in" in="shinylight" in2="post-diffuse" result="just-shine"></feComposite>
							        <feComposite id="shine-composite" operator="arithmetic" k2="0" k3="1" in="just-shine" in2="post-diffuse" result="post-spec"></feComposite>

							        <feOffset id="offset-1"  in="post-spec" dx="0" dy="1" result="off1"></feOffset>
											<feOffset id="offset-2"  in="post-spec" dx="0" dy="2" result="off2"></feOffset>
											<feOffset id="offset-3"  in="post-spec" dx="0" dy="3" result="off3"></feOffset>
											<feOffset id="offset-4"  in="post-spec" dx="0" dy="4" result="off4"></feOffset>
											<feOffset id="offset-5"  in="post-spec" dx="0" dy="5" result="off5"></feOffset>
											<feOffset id="offset-6"  in="post-spec" dx="0" dy="6" result="off6"></feOffset>
											<feOffset id="offset-7"  in="post-spec" dx="0" dy="7" result="off7"></feOffset>

							        <feMerge result="pre-color-extru">
		                    <feMergeNode in="off1"></feMergeNode>
		                    <feMergeNode in="off2"></feMergeNode>
		                    <feMergeNode in="off3"></feMergeNode>
		                    <feMergeNode in="off4"></feMergeNode>
		                    <feMergeNode in="off5"></feMergeNode>
		                    <feMergeNode in="off6"></feMergeNode>
		                    <feMergeNode in="off7"></feMergeNode>
							        </feMerge>

							        <feFlood id="extru-RGBA" :flood-color="extru" flood-opacity="1"></feFlood>
							        <feComposite operator="in" in2="pre-color-extru" result="colored-extru"></feComposite>

							        <feImage id="texture-extr" width="500" height="500" xlink:href="https://www.france-banderole.com/wp-content/themes/fb/images/txtsteel.png"></feImage>

							        <feBlend id="texture-blend-extr" mode="multiply" in2="colored-extru"></feBlend>
							        <feComposite operator="in" in2="colored-extru" result="textured-extru"></feComposite>

							        <feMerge>
							          <feMergeNode in="textured-extru"></feMergeNode>
							          <feMergeNode in="post-spec"></feMergeNode>
							        </feMerge>
									  </filter>

										<filter id="large">
							        <feComposite id="diff-composite" operator="arithmetic" k1="0" k3="1" in="difflight" in2="scatter-text" result="post-diffuse"></feComposite>
							        <feComposite operator="in" in="shinylight" in2="post-diffuse" result="just-shine"></feComposite>
							        <feComposite id="shine-composite" operator="arithmetic" k2="0" k3="1" in="just-shine" in2="post-diffuse" result="post-spec"></feComposite>

							        <feOffset id="offset-1"  in="post-spec" dx="0" dy="1" result="off1"></feOffset>
											<feOffset id="offset-2"  in="post-spec" dx="0" dy="2" result="off2"></feOffset>
											<feOffset id="offset-3"  in="post-spec" dx="0" dy="3" result="off3"></feOffset>
											<feOffset id="offset-4"  in="post-spec" dx="0" dy="4" result="off4"></feOffset>
											<feOffset id="offset-5"  in="post-spec" dx="0" dy="5" result="off5"></feOffset>
											<feOffset id="offset-6"  in="post-spec" dx="0" dy="6" result="off6"></feOffset>
											<feOffset id="offset-7"  in="post-spec" dx="0" dy="7" result="off7"></feOffset>
											<feOffset id="offset-8"  in="post-spec" dx="0" dy="8" result="off8"></feOffset>
											<feOffset id="offset-9"  in="post-spec" dx="0" dy="0" result="off9"></feOffset>
											<feOffset id="offset-10" in="post-spec" dx="0" dy="0" result="off10"></feOffset>
											<feOffset id="offset-11" in="post-spec" dx="0" dy="0" result="off11"></feOffset>
											<feOffset id="offset-12" in="post-spec" dx="0" dy="0" result="off12"></feOffset>

							        <feMerge result="pre-color-extru">
		                    <feMergeNode in="off1"></feMergeNode>
		                    <feMergeNode in="off2"></feMergeNode>
		                    <feMergeNode in="off3"></feMergeNode>
		                    <feMergeNode in="off4"></feMergeNode>
		                    <feMergeNode in="off5"></feMergeNode>
		                    <feMergeNode in="off6"></feMergeNode>
		                    <feMergeNode in="off7"></feMergeNode>
		                    <feMergeNode in="off8"></feMergeNode>
		                    <feMergeNode in="off9"></feMergeNode>
		                    <feMergeNode in="off10"></feMergeNode>
		                    <feMergeNode in="off11"></feMergeNode>
		                    <feMergeNode in="off12"></feMergeNode>
							        </feMerge>

							        <feFlood id="extru-RGBA" :flood-color="extru" flood-opacity="1"></feFlood>
							        <feComposite operator="in" in2="pre-color-extru" result="colored-extru"></feComposite>

							        <feImage id="texture-extr" width="500" height="500" xlink:href="https://www.france-banderole.com/wp-content/themes/fb/images/txtsteel.png"></feImage>

							        <feBlend id="texture-blend-extr" mode="multiply" in2="colored-extru"></feBlend>
							        <feComposite operator="in" in2="colored-extru" result="textured-extru"></feComposite>

							        <feMerge>
							          <feMergeNode in="textured-extru"></feMergeNode>
							          <feMergeNode in="post-spec"></feMergeNode>
							        </feMerge>
									  </filter>

										<linearGradient id="mirror">
							         <stop offset="0%"   stop-color="#777" />
											 <stop offset="50%"  stop-color="#fff" />
							         <stop offset="100%" stop-color="#777" />
							      </linearGradient>
									</defs>

								  <pattern id="ptsteel" patternUnits="userSpaceOnUse" viewBox="0 0 1000 625" width="1000" height="625">
								    <image xlink:href="https://www.france-banderole.com/wp-content/themes/fb/images/txtsteel.png" width="1000" height="625"/>
								  </pattern>

									<!--calque texte effet lumineux-->
									<text :filter="glow" :fill="lightcolor" :x="posx" y="50" :font-size="fsize" :font-family="typo" v-if="lumi" dominant-baseline="central">
								    {{ texte }}
								  </text>

									<!--calque texte principal-->
									<text :filter="filter" :x="posx" y="48" :font-size="fsize" :fill="fill" :stroke="stroke" stroke-width="1px" stroke-linecap="butt"  stroke-linejoin="miter" stroke-opacity="0.7" :font-family="typo" dominant-baseline="central">
								    {{ texte }}
								  </text>


								</svg>
							</span>


					</span>
				</div></transition>
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

<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>

<script src="../wp-content/plugins/fbshop/js/vue.min.js"></script>
<script src="../wp-content/plugins/fbshop/js/vue.v-tooltip.min.js"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=3.0"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/lettrage-3d.vue.js?v=3.0"></script>
<script>

	var fontsToLoad = ['Open Sans:700', 'Exo:900', 'Monstserrat:700', 'Russo One', 'Krub:700', 'Patua One', 'Bangers', 'Boogaloo', 'Concert One', 'Fugaz One', 'Inconsolata', 'Sigmar One', 'Suez One'];

	WebFont.load({
		google: {
		  families: fontsToLoad
		}
	});

</script>
