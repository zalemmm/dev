//=================================================================================================
// plugin :   DONNEES GLOBALES récupérées pour toutes les prodpages dans /prod_pages/vue.globals.js
//=================================================================================================

shared.install = function () {
  Object.defineProperty(Vue.prototype, '$global', {
    get: function get() {
      return shared;
    }
  });
};

Vue.use(shared);

//================================================================================================//
//                                          INSTANCE VUE.JS                                       //
//================================================================================================//
// Chaque page produit est maintenant composée d'un template html et d'un fichier .js semblable à celui-ci qui en gère le comportement. Il n'y a plus d'autres dépendances  (telles que jotform, cal_kakemono etc.) excepté vue.globals.js qui rassemble les variables et fonctions communes à toutes les pages. l'application ci dessous se découpe ainsi :

// 0- EL: définit un <div> sur lequel cette application vue.js vient se greffer. Ici ce dernier (#prodApp) engloble tout le html de la page produit.
// 1- DATA: instancie et définit les valeurs par défaut des variables utilisées dans le template html via des attributs spéciaux (v-model, v-show et attributs commmençant par ':' ex. ':class')
// 2- MOUNTED: sorte de "document ready": une fois l'instance de vue créée et avant d'y apporter des modifications avec les methodes, on peut ici définir par ex un état de la vue en fonction d'une condition préalable. ex: client revendeur ou pas
// 3- METHODS: ce sont les fonctions permettant d'agir sur les DATA et d'en modifier la valeur. elles sont lancées DEPUIS LE HTML avec des directives (@click, @change etc.) Les méthodes sont déployées dans l'ordre de l'évolution du formulaire: des actions et animations à la sélection des options jusqu'au calcul des tarifs.

// IMPORTANT : une variable destinée au fonctionnement interne d'une fonction, (ex. metragefinal dans la méthode de calcul) peut être définie comme avant par un var maVariable = '';
// PAR CONTRE si une variable est destinée à être utilisée dans plusieurs fonctions de cette page, ou dans le html: ex les variables comme 'produit','dimensions' qui sont à la fois dans les méthodes select et calcul du panier, il faut les définir ci-dessous dans DATA. On accède aux variables définies dans data ainsi : 'this.maVariable' ici (ou juste 'maVariable' ds le html)
// des VARIABLES GLOBALES sont définies dans le fichier vue.globals.js, notamment pour les url et les textes d'aides (tooltips) qui sont ainsi centralisés : celles-ci sont accessibles depuis n'importe quelle page produit et sont appelées sous la forme 'this.$global.maVariable' ici (ou '$global.maVariable' dans le html)

new Vue({

  //---------------------------------------------------------------------------------------------//
  //                0 - EL (élément html sur lequel agit le code ci dessous)                     //
  //---------------------------------------------------------------------------------------------//

  el: '#prodApp',

  //---------------------------------------------------------------------------------------------//
  //                1 - DATA ( variables et valeurs par défaut de la VUE)                        //
  //---------------------------------------------------------------------------------------------//
  data: {
      rowHeight: {height: '975px'},

      choix : false, // passer à true pour debug : affiche les modifications à la sélection des options

      // valeurs par défaut (value) : champs select tous produits
      produit: '',
      dimensions: '',
      support: '',
      maquette: '',
      sign: '',

      // valeurs par défaut (value) : champs spéciaux au produit
      oeillets: '',
      ourlets: '',
      fourreaux: '',
      scratch: '',
      fixation: '',
      finition: '',     // nontissé
      ffixation: '',    // nontissé

      // valeurs par défaut (value) : champs titres sélect
      choixProd : '',
      choixSupp : 'choisir le support',
      choixOeil : '',
      choixSpce : '',
      choixOrlt : '',
      choixFour : '',
      choixScra : '',
      choixFixx : 'Choisir une fixation',
      choixFxqt : '',
      choixFini : '',   // nontissé
      choixFpce : '',   // nontissé
      choixFfix : '',   // nontissé
      choixMaqt : '',
      choixSign : '',

      qte: 1,
      adresse: true,
      atelier: false,
      relais:  false,
      colis:   false,
      roll:    false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes et autres attributs
      reqProd: '',
      reqSize: '',
      reqSupp: 'required',

      reqOeil: '',
      reqOrlt: '',
      reqFour: '',
      reqScra: '',
      reqFixx: 'required',
      reqFini: '', // nontissé
      reqFfix: '', // nontissé

      reqMaqt: '',
      reqSign: '',
      reqQtte: '',
      reqHaut: '',
      reqLarg: '',
      reqEstm: '',

      btnP1: 'inactive',
      btnP2: 'inactive',
      btnP3: 'inactive',
      btnD1: 'inactive',
      btnD2: 'inactive',
      btnD3: 'inactive',

      tendORrisl: '',

      // valeurs par défaut de visibilité des blocs d'options :
      toggleProd: true,
      toggleSize: true,
      toggleSupp: true,

      toggleOeil: true,
      toggleSpce: false,
      toggleOrlt: true,
      toggleFour: true,
      toggleScra: true,
      toggleFixx: true,
      toggleFxqt: false,
      toggleFini: false,
      toggleFpce: false, // nontissé
      toggleFfix: false, // nontissé

      toggleMaqt: true,
      toggleSign: true,

      showOeil: false,
      showOrlt: false,
      showFour: false,
      showScra: false,
      showFixx: true,
      showFini: false,
      showFfix: false,
      showRoll: false,

      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,


      dateLivraison: false,
      livraisonrapide: false,
      livraisonComp: false,
      formError: false,
      formWarng: false,
      ajoutPanier: false,

      // valeurs par défaut de visibilité des options individuelles :
      drisse: false,
      typeQte: true,
      piquets: false,

      // valeurs par défaut : calques images
      slideContainer: true,
      bg0: {backgroundImage: 'none'},
      bg1: {backgroundImage: 'none'},
      bg2: {backgroundImage: 'none'},
      bg3: {backgroundImage: 'none'},
      bg4: {backgroundImage: 'none'},
      bg5: {backgroundImage: 'none'},
      bgH: {backgroundImage: 'none'},
      pr0: false,
      pr1: false,
      pr2: false,
      pr3: false,
      pr4: false,
      pr5: false,
      prH: false,
      calqueTexte: false,
      calqueContent: '',

      // déclancheurs d'annimations :
      imgTrigger : false,
      dateTrigger: false,
      errorTrigger: false,
      warngTrigger: false,

      // valeurs par défaut variables destinées au panier :
      inputProd : '',
      inputDesc: '',
      inputQte: '',
      inputPrix: '',
      inputOption: '',
      inputRemise: '',
      inputTotal: '',
      inputTransport: '',
      inputHauteur: '',
      inputLargeur: '',

      designation: '',
      details: '',
      modmaq: '',
      optliv: '',
      retrait: '',
      roule: '',
      prliv: '',
      cena2: 0,
      rabat2: 0,
      suma2: 0,
      transport: 0,
      hauteur: '',
      largeur: '',
      prodref: '',

      showEsize: false,
      errorSize: '',

      // valeurs par défaut bloc de droite :  prix et infos
      estdate: '',
      forfait: '',
      message: 'livraison comprise',
      erreurType: 0,
      errorMessage: '',
      warngMessage: '',
      prixUnit: '-',
      prixOption: '-',
      prixTotal: '-',

  }, // fin DATA

  //---------------------------------------------------------------------------------------------//
  //              2-  MOUNTED (fonctions à passer avant modifications de la vue)                 //
  //---------------------------------------------------------------------------------------------//

  mounted: function () {
      // si client revendeur : afficher les options supplémentaires
      if ( document.getElementById('rev') || document.getElementById('revendeur') || document.getElementById('revendeurRC') || document.getElementById('revendeurRS')) this.swRvd = true;
      else this.swRvd = false;
  },

  //---------------------------------------------------------------------------------------------//
  //                      3 - METHODS (fonctions pour modifier la VUE)                           //
  //---------------------------------------------------------------------------------------------//

  methods: {

    // fonction affichage champs formulaire :                choix des fixations
    //==========================================================================
    selectFixx: function(value) {
        this.prH = false; // cacher preview
        this.pr5 = true;
        this.fixation = value;
        this.choixFixx = value;

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = this.pr2 = true;  // calques bg et produit activés
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/banderole/banderole-ext.png)'};
        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/base.png)'};


        this.drisse = false;
        if (this.fixation == 'drisse perimetrique' || this.fixation == 'drisse fourreaux H/B') this.drisse = true;
        this.typeQte = true;
        if (this.fixation == 'tendeurs' || this.fixation == 'rislans') this.typeQte = false;
        this.piquets = false;
        if (this.fixation == '2 tourillons bois et sandows' || this.fixation == '2 piquets de bois') this.piquets = true;

        // images
        if (this.fixation == 'tendeurs')                  {
          this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/tendeur.png)'};
          this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsc.png)'};
        }
        else if (this.fixation == 'rislans')              {
          this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/rislan.png)'};
          this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsc.png)'};
        }
        else if (this.fixation == '2 tourillons bois et sandows') this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/tourillons.png)'};
        else if (this.fixation == '2 piquets de bois')    this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/piquets.png)'};
        else if (this.fixation == 'drisse perimetrique')  this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/drissep.png)'};
        else if (this.fixation == 'drisse fourreaux H/B') this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/drisse.png)'};
        else                                              this.bg5 = {backgroundImage: 'none'};

        // si tendeurs ou rislans show quantité
        if(this.fixation == 'tendeurs' || this.fixation == 'rislans'){
          // variable src image :
          if(this.fixation == 'tendeurs') this.tendORrisl = this.$global.img+'/fixation/tendeur.svg';
          if(this.fixation == 'rislans')  this.tendORrisl = this.$global.img+'/fixation/rislan.svg';
          this.toggleFixx = false;
          this.toggleFxqt = true;
          this.reqFixx = 'required';
          this.choixFxqt = '- combien ?';

        // sinon passage au champ suivant
        }else{
          this.toggleFixx = false;
          this.toggleFxqt = false;
          this.choixFxqt = '';
          this.reqFixx = '';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.reqQtte = 'required';
          this.reqHaut = this.reqLarg = 'required';
          this.showOptions = true;
        }
    },

    // fonction affichage champs formulaire:   au choix quantité fixation validé
    //==========================================================================
    selectFxqt: function(value) {
        this.choixFxqt = value;
        this.toggleFixx = false;
        this.toggleFxqt = false;
        this.reqFixx = '';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.reqQtte = 'required';
        this.reqHaut = this.reqLarg = 'required';
        this.showOptions = true;
    },


    // fonctions hover :                                    HOVER texte OU image
    //==========================================================================
    // (calque) passe la valeur numérique du calque preview,
    // (src) passe soit le nom de l'image hover, soit le contenu texte pour le calque texte (9)

    hoPw: function(calque, src) {
      this.slideContainer = false; // slider désactivé
      this.prH = this.pr0 = this.pr1 = true;  // calques bg et préview activés
      this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/base.png)'};
      // désactiver le calque sur lequel s'applique le hover
      if (calque == 1) this.pr1 = false;
      if (calque == 2) this.pr2 = false;
      if (calque == 3) this.pr3 = false;
      if (calque == 4) this.pr4 = false;
      if (calque == 5) this.pr5 = false;

      if (calque == 9) { // hover texte
        this.pr1 = this.pr2 = this.pr3 = this.pr4 = this.pr5 = true;
        this.calqueTexte = true;
        this.calqueContent = src;
        this.bgH = {backgroundImage: 'none'};
      } else {           // hover image
        this.calqueTexte = false;
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/banderole/banderole-ext.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/banderole/'+src+'.png)'};
      }
    },

    // fonctions hover :                                    HOVER texte ET image
    //==========================================================================
    // (calque) passe la valeur numérique du calque preview,
    // (src) passe le nom de l'image, (txt) le contenu texte

    hoTx: function(calque, src, txt) {
      this.slideContainer = false; // slider désactivé
      this.prH = this.pr0 = true;  // calques bg et préview activés

      // désactiver le calque sur lequel s'applique le hover
      if (calque == 1) this.pr1 = false;
      if (calque == 2) this.pr2 = false;
      if (calque == 3) this.pr3 = false;
      if (calque == 4) this.pr4 = false;
      if (calque == 5) this.pr5 = false;

      this.calqueTexte = true;
      this.calqueContent = txt;

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/banderole/banderole-ext.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/banderole/'+src+'.png)'};
    },

    // fonctions hover :    à la sortie de la souris, désactiver le calque hover
    //==========================================================================
    hout: function(calque) {
      this.prH = false; //
      if (calque == 1) this.pr1 = true;
      if (calque == 2) this.pr1 = this.pr2 = true;
      if (calque == 3) this.pr1 = this.pr2 = this.pr3 = true;
      if (calque == 4) this.pr1 = this.pr2 = this.pr3 = this.pr4 = true;
      if (calque == 5 || calque == 9) this.pr1 = this.pr2 = this.pr3 = this.pr4 = this.pr5 = true;
    },

    // fonctions boutons +-  :                               boutons +- quantité
    //==========================================================================
    qtePlus: function() {
        this.qte++;
        this.reqQtte = '';
    },
    qteMoins: function() {
        if (this.qte > 1) {
          this.qte--;
        }
        this.reqQtte = '';
    },

    // fonctions checkboxes :              au check, décocher les autres options
    //==========================================================================
    checkAdresse: function() {
        this.atelier = this.relais = false;
    },
    checkAtelier: function() {
        this.adresse = this.relais = false;
    },
    checkRelais: function() {
        this.atelier = this.adresse = this.roll = false;
    },
    checkRoll: function() {
        this.relais = false;
    },

    // fonctions input hauteur / largeur :                     check remplissage
    //==========================================================================
    checkSize: function(input, value) {
        if (value < 1 || isNaN(value) || value == '' || value >= 50) {
        if (input == 'hauteur') {this.reqHaut = 'required'; this.errorSize = 'entrez une valeur numérique en mètres (ex: 0.75)'; this.showEsize = true;}
        if (input == 'largeur') {this.reqLarg = 'required'; this.errorSize = 'entrez une valeur numérique en mètres (ex: 2.5)'; this.showEsize = true;}

      } else {
        this.reqQtte = '';
        if (input == 'hauteur') {this.reqHaut = ''; this.errorSize = ''; this.showEsize = false;}
        if (input == 'largeur') {this.reqLarg = ''; this.errorSize = ''; this.showEsize = false;}
      }
    },

    // fonctions input hauteur / largeur :
    //==========================================================================
    htoFx: function() {
      this.hauteur = this.hauteur.toFixed(2);
    },

    ltoFx: function() {
      this.largeur = this.largeur.toFixed(2);
    },


    // fonction reset :      vider champs prix / cacher bouton ajouter au panier
    //==========================================================================
    reset: function() {
        this.prixUnit = '-';
        this.prixOption =  '-';
        this.prixTotal = '-';
        this.dateLivraison = false;
        this.showLiv = false;
        this.livraisonComp = false;
        this.ajoutPanier = false;
        this.btnP1 = 'inactive';
        this.btnP2 = 'inactive';
        this.btnP3 = 'inactive';
        this.btnD1 = 'inactive';
        this.btnD2 = 'inactive';
        this.btnD3 = 'inactive';
        this.erreurType = 0;
        this.warngMessage = '';
        this.errorMessage = '';
        this.formError = false;
        this.formWarng = false;
    },

    // fonction calcul délais :            calcul et affichage délais livraision
    //==========================================================================
    dateEstim: function() {

        this.dateLivraison = true;
        var prod_first_val  = parseInt(this.delaiprod[0]);
				var prod_second_val = parseInt(this.delaiprod[2]);
				var deli_first_val  = parseInt(this.delailiv[0]);
				var deli_second_val = parseInt(this.delailiv[2]);
        var days;
        var daystoadd;
				var totalProduction = prod_first_val + deli_first_val;
				var totalDelivery   = prod_second_val + deli_second_val;
        var curdate = new Date();
				var curhour = curdate.getHours();

				if(totalProduction == totalDelivery) days = totalProduction;
				else days = totalDelivery;
        // ajout 1 jour ouvré de délai sur commande après 12h
				if (curhour >= 12) daystoadd = AddBusinessDays(days+1);
				else daystoadd = AddBusinessDays(days);

				curdate.setDate(curdate.getDate()+daystoadd);
				var estdt = new Date(curdate);
				var month = estdt.getMonth()+1;
				var day = estdt.getDate();
				var output = day + '/' + (month<10 ? '0' : '') + month + '/' + (day<10 ? '' : '') + estdt.getFullYear();

				this.estdate = output;
    }, // fin fonction délais livraision

    // fonction boutons délais :                    boutons délais de production
    //==========================================================================
    selectDeliv: function(value) {
        this.reqQtte = this.reqSize = '';
        // récupérer les valeurs délais production, activer les boutons délais de livraison :
        this.delaiprod = value;
        if (this.delaiprod == '4-5') { this.btnP1 = 'active'; this.btnP2 = 'inactive'; this.btnP3 = 'inactive';}
        if (this.delaiprod == '2-3') { this.btnP1 = 'inactive'; this.btnP2 = 'active'; this.btnP3 = 'inactive';}
        if (this.delaiprod == '1-1') { this.btnP1 = 'inactive'; this.btnP2 = 'inactive'; this.btnP3 = 'active';}
        this.showLiv = true;
    },

    // fonction principale :                                 CALCUL PRIX PRODUIT
    //==========================================================================
    calculer: function(value) {

        // récupèrer les valeurs délais de livraison, activer le bouton ajouter au panier :
        this.delailiv = value;
        if (this.delailiv == '3-4') { this.btnD1 = 'active'; this.btnD2 = 'inactive'; this.btnD3 = 'inactive';}
        if (this.delailiv == '2-3') { this.btnD1 = 'inactive'; this.btnD2 = 'active'; this.btnD3 = 'inactive';}
        if (this.delailiv == '1-1') { this.btnD1 = 'inactive'; this.btnD2 = 'inactive'; this.btnD3 = 'active';}

        this.ajoutPanier = true;
        this.livraisonComp = true;
        this.dateTrigger = !this.dateTrigger;

        //------------------------------------------- variables de calcul panier
        var ktorytyp          = '';
    		var prliv             = '';
    		var date_panier       = '';
    		var dodatkowaopcja    = '';
    		var prixunite         = 0;
    		var cena              = 0; 	var cena2   		= 0;
    		var rabat             = 0; 	var rabat2  		= 0;  var rabatp 	  = 0;
    		var suma              = 0; 	var suma2   		= 0;
    		var transport         = 0;
    		var metraz            = 0;
    		var metrazzaokraglony = 0;  var newopt;
    		var finition          = 0; 	var option 			= 0;
    		var optliv            = ''; var remisik 		= '';
    		var erreurType        = 0;
    		var perteH            = 0; 	var perteL 			= 0;
    		var h1                = 0; 	var h2      		= 0;
    		var l1                = 0; 	var l2      		= 0;
    		var opis              = ''; var bacheType   = '';
    		var metragefinal      = 0;
    		var cenatotal         = 0;
    		var metrage           = 0;
    		var plm               = 0; ////prix de la laize au M²
    		var prixproduit       = 0;  var prix 				= 0;

        // ------------------------------------------------- conversion h/l ????

    		/*this.largeur          = this.largeur.replace(',','.');
    		this.largeur          = fixstr(this.largeur);

    		this.hauteur          = this.hauteur.replace(',','.');
    		this.hauteur          = fixstr(this.hauteur);

    		this.largeur          = parseFloat(this.largeur);
    		this.hauteur          = parseFloat(this.hauteur);*/

        /*this.largeur = this.largeur.toFixed(2);
        this.hauteur = this.hauteur.toFixed(2);*/

        // ------------------------------------------------------ calcul métrage
        metraz                 = this.largeur * this.hauteur;
        var metrazzaokraglony1 = (this.largeur+this.hauteur)*2;
        metrazzaokraglony      = Math.round(metrazzaokraglony1);
        var hautbas            = this.largeur*2;
        var gauchedroite       = this.hauteur*2;


    		//-------------------------------------------------------------fixations

        var fixation  = 0;

    		if (this.fixation == 'tendeurs')      		           fixation = parseInt(this.choixFxqt)*0.75;
    		if (this.fixation == 'rislans')       		 	         fixation = parseInt(this.choixFxqt)*0.05;
    		if (this.fixation == '2 tourillons bois et sandows') fixation = 9.90;
    		if (this.fixation == '2 piquets de bois')            fixation = 9.90;
    		if (this.fixation == 'drisse perimetrique')          fixation = (this.hauteur+this.largeur)*2*1.5;
    		if (this.fixation == 'drisse fourreaux H/B')         fixation = (this.largeur+this.largeur)*3*1.0;

        cena += fixation;
        console.log('fixation:' +fixation);


        // ------------------------------------------------------------- OPTIONS

        if (this.adresse == true) {
          this.retrait = 'livraison';
        }

        if (this.atelier == true) {
          cena-= cena*this.$global.livRAT;
          this.retrait = 'retrait colis atelier';
        }

        if (this.relais == true) {
          cena += this.$global.livREL/this.qte;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= this.$global.livREV;}
          this.optliv = ' / colis revendeur';
        }

        if (this.roll == true) {
    			cena += this.$global.livROL/this.qte;
    			this.roule = ' /  livrée roulée';
    		}

        // -------------------------------------------------------- PRIX PRODUIT

        prixunite = cena;
        cena = prixunite*this.qte;
        prixunite = fixstr(prixunite);
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------ PRIX LIVRAISON

        if (this.delaiprod && this.delailiv){
          var ProdPercent = '';
          var DeliPercent = '';

          if      (this.delaiprod == '2-3') ProdPercent = this.$global.prodA23;
          else if (this.delaiprod == '1-1') ProdPercent = this.$global.prodA11;
          else                              ProdPercent = 0;

          if      (this.delailiv == '2-3')  DeliPercent = this.$global.livrA23;
          else if (this.delailiv == '1-1')  DeliPercent = this.$global.livrA11;
          else                              DeliPercent = 0;

          var price_unit = parseFloat(prixunite);

          var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
          var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
          finalPrice               = calculatedTotalPrice + price_unit;

          finalPrice1 = fixstr(finalPrice);
          finalPrice2 = finalPrice1.replace(".", ",");

          this.prixUnit = finalPrice2 +' €' ;
        }

        // ---------------------------------------------------------- PRIX TOTAL

        prixunite = finalPrice1;
        cena=prixunite*this.qte;
        prixunite=fixstr(prixunite);
        this.transport=0;
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        //                                       ERREURS TYPE 2 : AVERTISSEMENTS



        //---------------------------- vérifier que les champs sont bien remplis

        /*if (this.qte < 1)        {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';
          this.reqLarg = this.reqHaut = this.reqFixx = '';

        } else if (this.hauteur  == '' || isNaN(this.hauteur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur en mètres (ex: 0.7)';
          this.erreurType=1; this.reqHaut = 'required';
          this.reqLarg = this.reqQtte = '';

        } else if (this.largeur  == '' || isNaN(this.largeur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une largeur en mètres (ex: 1.4)';
          this.erreurType=1; this.reqLarg = 'required';
          this.reqHaut = this.reqQtte = '';

        } else {
          this.reqLarg = this.reqHaut = this.reqQtte = '';
        }*/

        //----------------------------------------------------------------------

        if (this.erreurType == 2) {
          this.formWarng     = true;
          this.warngTrigger  = !this.warngTrigger;
        }

        if (this.erreurType == 1) {
          this.prixUnit      = '-';
          this.prixOption    = '-';
          this.prixTotal     = '-';
          this.ajoutPanier   = false;
          this.livraisonComp = false;
          this.formError     = true;
          this.formWarng     = false;
          this.errorTrigger  = !this.errorTrigger;
          this.reqEstm       = 'required';
        } else {
          this.reqEstm       = 'validate';
        }

        // ------------------------------------------ affichage livraison rapide
        if ((this.erreurType == 0 || this.erreurType == 2) && this.delailiv == '1-1' && this.delaiprod == '1-1') this.livraisonrapide = true;
        else this.livraisonrapide = false;

        // --------------------------------------------------- PREPARATION ENVOI

        if ((this.erreurType == 0 || this.erreurType == 2) && (this.delailiv == '2-3' || this.delailiv == '1-1' || this.delailiv == '3-4')){
          suma=cena-rabat;
          suma=fixstr(suma);
          this.suma2 = suma.replace(".", ",");
          this.prixTotal = this.suma2  +' €' ;

          genImg(); // générer l'image produit et l'ajouter au formulaire

          // ---------------------------------------- données envoyées au panier
          var dprod = this.delaiprod;  if (this.delaiprod == '1-1') dprod = '1';
          var dliv  = this.delailiv;   if (this.delailiv  == '1-1') dliv  = '1';

          this.inputHauteur = (this.hauteur*100).toFixed(0);
          this.inputLargeur = (this.largeur*100).toFixed(0);

          if (this.support == 'bache nontisse 150g') { // affichage des options nontissé dans détails
            this.details = this.finition+' '+this.choixFpce+' <br>- '+this.ffixation;

          }else{ // si autre bache, affichage des finitions :

            this.details = this.oeillets+' '+this.choixSpce+' <br>- '+this.ourlets+'  <br>- '+this.fourreaux+' <br>- '+this.scratch+' <br>- '+this.fixation+' '+this.choixFxqt;
          }

          this.inputDesc = '- '+this.support+'<br>- H|'+this.inputHauteur+'cm x L|'+this.inputLargeur+'cm <br>- '+this.details+' <br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+this.roule+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'Banderole';
          this.inputQte       = this.qte;
          this.inputPrix      = this.cena2;
          this.inputOption    = this.prixOption;
          this.inputRemise    = this.rabat2;
          this.inputTotal     = this.suma2;
          this.inputTransport = this.transport;

        }
    }, // fin fonction calucler
  }, // fin méthodes VUE
}); // fin instance VUE
