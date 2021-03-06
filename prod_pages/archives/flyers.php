<div id="prodApp">
	<div class="row">
		<div class="column" id="choicesContainer"> <!--bloc formulaire-->

			<h3>Votre devis en ligne flyers / dépliants</h3>

			<form class="vueForm" action="" method="post" name="vueForm" id="vueForm" accept-charset="utf-8">
				<div class="form-all">
					<ul class="formSection">

						<li class="formSelect">

							<button type="button" class="toggle" :class="reqProd" @click="toggleProd = !toggleProd">
								{{ choixProd }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleProd">

									<div @mouseover="hoTx(1,'flyer','Flyers')"        @mouseout="hout(1)" v-tooltip.bottom="$global.flyr" @click="reset(); selectProd('Flyers');">
										<img :src="$global.img+'/papier/fly.png'" /><span>Flyer</span>
									</div>
									<div @mouseover="hoTx(1,'depliant','Dépliants')"  @mouseout="hout(1)" v-tooltip.bottom="$global.depl" @click="reset(); selectProd('Depliants');">
										<img :src="$global.img+'/papier/dep.png'" /><span>Dépliant</span>
									</div>

								</div>
							</transition>

						</li>


						<li class="formSelect" id="id_signature" v-show="showSupp">

							<button type="button" class="toggle" :class="reqSupp" @click="toggleSupp = !toggleSupp">
								{{ choixSupp }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleSupp" >
									<div @mouseover="hoTx(1,'grammage','80g');"  @mouseout="hout(1)" v-tooltip.bottom="$global.p80g" @click="reset(); selectSupp('80g');">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>80g</span>
									</div>
									<div @mouseover="hoTx(1,'grammage','135g');" @mouseout="hout(1)" v-tooltip.bottom="$global.p135" @click="reset(); selectSupp('135g');">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>135g</span>
									</div>
									<div @mouseover="hoTx(1,'grammage','170g');" @mouseout="hout(1)" v-tooltip.bottom="$global.p170" @click="reset(); selectSupp('170g');">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>170g</span>
									</div>

									<div @mouseover="hoTx(1,'grammage','250g');" @mouseout="hout(1)" v-tooltip.bottom="$global.p250" @click="reset(); selectSupp('250g');" v-if="flyer">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>250g</span>
									</div>
									<div @mouseover="hoTx(1,'grammage','350g');" @mouseout="hout(1)" v-tooltip.bottom="$global.p350" @click="reset(); selectSupp('350g');" v-if="flyer">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>350g</span>
									</div>
									<div @mouseover="hoTx(1,'grammage','120µ');" @mouseout="hout(1)" v-tooltip.bottom="$global.i120" @click="reset(); selectSupp('120µ');" v-if="flyer">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>Indéchirable 120µ</span>
									</div>
									<div @mouseover="hoTx(1,'grammage','270µ');" @mouseout="hout(1)" v-tooltip.bottom="$global.i270" @click="reset(); selectSupp('270µ');" v-if="flyer">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>Indéchirable 270µ</span>
									</div>
									<div @mouseover="hoTx(1,'grammage','350µ');" @mouseout="hout(1)" v-tooltip.bottom="$global.i350" @click="reset(); selectSupp('350µ');" v-if="flyer">
										<img :src="$global.img+'/papier/weight.png'" /></i><span>Indéchirable 350µ</span>
									</div>

								</div>
							</transition>

						</li>

						<li class="formSelect" v-show="showLami">

							<button type="button" class="toggle" :class="reqLami" @click="toggleLami = !toggleLami">
								{{ choixLami }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleLami">

									<div @mouseover="hoPw(9,'Couché Brillant')" @mouseout="hout(9)" @click="reset(); selectLami('couché brillant')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Couché Brillant</span>
									</div>
			            <!--<div @mouseover="hoPw(9,'Couché Satiné')"   @mouseout="hout(9)" @click="reset(); selectLami('couché satiné')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Couché Satiné</span>
									</div>-->
									<div @mouseover="hoPw(9,'Couché Mat')"      @mouseout="hout(9)" @click="reset(); selectLami('couché mat')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Couché Mat</span>
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

									<div v-if="depli" @mouseover="hoTx(1,'format-papier','21x21cm ouvert -> 10,5x21cm fermé')" @mouseout="hout(1)" @click="reset(); selectSize('Din long')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>21x21 ouvert -> 10.5x21 fermé</span>
									</div>
			            <div v-if="depli" @mouseover="hoTx(1,'format-papier','A3 ouvert -> A4 fermé')" @mouseout="hout(1)" @click="reset(); selectSize('A3')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A3 ouvert -> A4 fermé</span>
									</div>
									<div v-if="depli" @mouseover="hoTx(1,'format-papier','A4 ouvert -> A5 fermé')" @mouseout="hout(1)" @click="reset(); selectSize('A4')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A4 ouvert -> A5 fermé</span>
									</div>
			            <div v-if="depli" @mouseover="hoTx(1,'format-papier','A4 3 volets')" @mouseout="hout(1)" @click="reset(); selectSize('A4 3 volets')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A4 3 volets</span>
									</div>
			            <div v-if="depli" @mouseover="hoTx(1,'format-papier','120x160cm (Abribus)')" @mouseout="hout(1)" @click="reset(); selectSize('A5')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A5 ouvert -> A6 fermé</span>
									</div>


									<div v-if="flyer" @mouseover="hoTx(1,'format-papier','A7')" @mouseout="hout(1)" @click="reset(); selectSize('A7')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A7 (7.4x10.5)</span>
									</div>
			            <div v-if="flyer" @mouseover="hoTx(1,'format-papier','A6')" @mouseout="hout(1)" @click="reset(); selectSize('A6')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A6 (10.5x14.8)</span>
									</div>
									<div v-if="flyer" @mouseover="hoTx(1,'format-papier','A5')" @mouseout="hout(1)" @click="reset(); selectSize('A5')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A5 (14.8x21)</span>
									</div>
			            <div v-if="flyer" @mouseover="hoTx(1,'format-papier','A4')" @mouseout="hout(1)" @click="reset(); selectSize('A4')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A4 (21x29.7)</span>
									</div>
									<div v-if="flyer" @mouseover="hoTx(1,'format-papier','A3')" @mouseout="hout(1)" @click="reset(); selectSize('A3')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>A3 (42x29.7)</span>
									</div>
			            <div v-if="flyer" @mouseover="hoTx(1,'format-papier','Din long')" @mouseout="hout(1)" @click="reset(); selectSize('Din long')">
										<i class="fa fa-expand" aria-hidden="true"></i><span>Din long (10.5x21)</span>
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

									<div @mouseover="hoPw(9,'Recto')"       @mouseout="hout(9)" @click="reset(); selectPrint('Recto')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Recto</span>
									</div>
			            <div @mouseover="hoPw(9,'Recto/Verso')" @mouseout="hout(9)" @click="reset(); selectPrint('Recto verso')">
										<i class="fa fa-sticky-note" aria-hidden="true"></i><span>Recto/Verso</span>
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


						<li class="formSelect" id="id_signature" v-show="showForm">

							<button type="button" class="toggle" :class="reqForm" @click="toggleForm = !toggleForm">
								{{ choixForm }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleForm" >
									<div @mouseover="hoPw(9,'portrait');" @mouseout="hout(9)" v-tooltip.bottom="$global.port" @click="reset(); selectForm('portrait');">
										<i class="fa fa-file-image-o" aria-hidden="true"></i><span>portrait</span>
									</div>
									<div @mouseover="hoPw(9,'paysage');" @mouseout="hout(9)" v-tooltip.bottom="$global.pays" @click="reset(); selectForm('paysage');">
										<i class="fa fa-photo" aria-hidden="true"></i><span>paysage</span>
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

						<li class="formSelect" id="id_signature" v-show="showQtte">

							<button type="button" class="toggle" :class="reqQtte" @click="toggleQtte = !toggleQtte">
								{{ choixQtte }} <i class="fa fa-caret-down"></i>
							</button>

							<transition name="slideDown">
								<div class="boutonsSelect" v-show="toggleQtte" >
									<div class="selectQte" @mouseover="hoPw(9,25);"     @mouseout="hout(9)" @click="reset(); selectQtte(25);">    <i class="num">25</i></div>
									<div class="selectQte" @mouseover="hoPw(9,50);"     @mouseout="hout(9)" @click="reset(); selectQtte(50);">    <i class="num">50</i></div>
									<div class="selectQte" @mouseover="hoPw(9,100);"    @mouseout="hout(9)" @click="reset(); selectQtte(100);">   <i class="num">100</i></div>
									<div class="selectQte" @mouseover="hoPw(9,250);"    @mouseout="hout(9)" @click="reset(); selectQtte(250);">   <i class="num">250</i></div>
									<div class="selectQte" @mouseover="hoPw(9,500);"    @mouseout="hout(9)" @click="reset(); selectQtte(500);">   <i class="num">500</i></div>
									<div class="selectQte" @mouseover="hoPw(9,1000);"   @mouseout="hout(9)" @click="reset(); selectQtte(1000);">  <i class="num">1000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,1250);"   @mouseout="hout(9)" @click="reset(); selectQtte(1250);">  <i class="num">1250</i></div>
									<div class="selectQte" @mouseover="hoPw(9,2000);"   @mouseout="hout(9)" @click="reset(); selectQtte(2000);">  <i class="num">2000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,2500);"   @mouseout="hout(9)" @click="reset(); selectQtte(2500);">  <i class="num">2500</i></div>
									<div class="selectQte" @mouseover="hoPw(9,5000);"   @mouseout="hout(9)" @click="reset(); selectQtte(5000);">  <i class="num">5000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,10000);"  @mouseout="hout(9)" @click="reset(); selectQtte(10000);"> <i class="num">10000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,15000);"  @mouseout="hout(9)" @click="reset(); selectQtte(15000);"> <i class="num">15000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,20000);"  @mouseout="hout(9)" @click="reset(); selectQtte(20000);"> <i class="num">20000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,25000);"  @mouseout="hout(9)" @click="reset(); selectQtte(25000);"> <i class="num">25000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,30000);"  @mouseout="hout(9)" @click="reset(); selectQtte(30000);"> <i class="num">30000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,35000);"  @mouseout="hout(9)" @click="reset(); selectQtte(35000);"> <i class="num">35000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,40000);"  @mouseout="hout(9)" @click="reset(); selectQtte(40000);"> <i class="num">40000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,45000);"  @mouseout="hout(9)" @click="reset(); selectQtte(45000);"> <i class="num">45000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,50000);"  @mouseout="hout(9)" @click="reset(); selectQtte(50000);"> <i class="num">50000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,75000);"  @mouseout="hout(9)" @click="reset(); selectQtte(75000);"> <i class="num">75000</i></div>
									<div class="selectQte" @mouseover="hoPw(9,100000);" @mouseout="hout(9)" @click="reset(); selectQtte(100000);"><i class="num">100000</i></div>
								</div>
							</transition>

						</li>

					</ul> <!-- fin listes déroulantes -->

					<ul class="optionsBlock" v-show="showOptions">

						<!--<li class="optLi optQuantite">

							<div class="qteContainer" :class="reqQtte">
								<label class="qteLabel" :class="reqQtte">quantité <span class="small">(par visuel)</span></label>
								<input type="number" min="1" class="qteInput" v-model="qte" @keyup.up="qtePlus" @keyup.down="qteMoins" @click="reset"  />

								<div class="qteBtn" :class="reqQtte">
									<button type="button" @click="reset(); qteMoins();"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
									<button type="button" @click="reset(); qtePlus();"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
								</div>
							</div>

						</li>-->

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
				<span v-html="inputDesc"></span><br />
				<span v-html="hauteur"></span> x <span v-html="largeur"></span>
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
				<a :href="$global.url+'/gabarit-papier/'" class="notice modal-link"  title="gabarits maquette">
					<i class="fa fa-object-group" aria-hidden="true"></i> <span class="textHide">Gabarits</span>
				</a>
			</div>

			<div id="previewImg">

				<transition name="slideDown">
					<ul id="slides" v-if="slideContainer">
						<li><img :src="$global.img+'/papier/flyerA5.png'" alt="flyer" /></li>
				  	<li><img :src="$global.img+'/papier/depliantA5.png'" alt="dépliant" /></li>
						<li><img :src="$global.img+'/slidedefault/1.png'" alt="commencez votre devis en ligne" /></li>
						<li><img :src="$global.img+'/slidedefault/2.png'" alt="commencez votre devis en ligne" /></li>
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
<script src="../wp-content/plugins/fbshop/prod_pages/vue.globals.js?v=3.0"></script>
<script src="../wp-content/plugins/fbshop/prod_pages/vue.flyers.js?v=3.0"></script>
