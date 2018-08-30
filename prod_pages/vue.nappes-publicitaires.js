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

      choix : false, // passer à true pour debug : affiche les modifications à la sélection des options

      // valeurs par défaut (value) : champs select tous produits
      produit: '',
      dimensions: '',
      support: '',
      shape: '',
      maquette: '',
      sign: '',

      // valeurs par défaut (value) : champs titres sélect
      choixProd : '',

      choixSupp : 'choisir le support',
      choixShape : '',
      choixRect : '',
      choixRond : '',
      choixSize : '',

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

      reqSupp: 'required',
      reqRect: '',
      reqShape: '',
      reqRond: '',
      reqSize: '',

      reqMaqt: '',
      reqSign: '',
      reqQtte: '',
      reqHaut: '',
      reqLarg: '',
      reqDiam: '',
      reqEstm: '',

      btnP1: 'inactive',
      btnP2: 'inactive',
      btnP3: 'inactive',
      btnD1: 'inactive',
      btnD2: 'inactive',
      btnD3: 'inactive',

      rondORrect: 'nappecarre',

      tendORrisl: '',

      // valeurs par défaut de visibilité des blocs d'options :
      toggleProd: true,

      toggleSupp: true,
      toggleShape: true,
      toggleRect: true,
      toggleRond: true,
      toggleSize: true,

      toggleMaqt: true,
      toggleSign: true,

      showShape: false,
      showRect: false,
      showRond: false,
      showSize: false,

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
      inputDiametre: '',

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
      diametre: '',
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
      if ( document.getElementById('revendeur')) this.swRvd = true;
      else this.swRvd = false;
  },

  //---------------------------------------------------------------------------------------------//
  //                      3 - METHODS (fonctions pour modifier la VUE)                           //
  //---------------------------------------------------------------------------------------------//

  methods: {

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectSupport: function(value) {
        this.prH = false; // cacher preview
        this.support = value;     // on attribue la valeur à la variable support
        this.choixSupp = value;   // on attribue la valeur au champ de titre support
        this.toggleSupp = false;  // on replie le menu à la sélection
        this.reqSupp = '';        // on rétablit les styles du champ à "non requis"

        // on réinitialise les champs suivants si c'est un retour sur option :
        this.showShape = this.showSize = false;
        this.showRond = this.showRect = false;

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = this.pr2 = true;  // calques bg et produit activés
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
        this.bg2 = {backgroundImage: 'none'};

        // afficher/masquer les images
        if (this.support == 'tissu 220g') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/220g.png)'};
        if (this.support == 'tissu 260g') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/260g.png)'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showShape = true;
        this.reqShape = 'required';
        this.toggleShape = true;
        this.choixShape = 'choisir la forme';
    },

    // fonction affichage champs formulaire:               au choix forme validé
    //==========================================================================
    selectShape: function(value) {
        this.choixShape = value;
        this.toggleShape = false;
        this.reqShape = '';

        // on réinitialise les champs suivants si c'est un retour sur option :
        this.showSize = false;
        this.showRond = this.showRect = false;

        if (this.choixShape == 'rectangulaire'){
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/nappecarre.png)'};
          this.rondORrect = 'nappecarre';

          this.showRond = false;
          this.showRect = true;

          this.reqDiam = 'required';
          this.reqHaut = this.reqLarg = 'required';
        }
        if (this.choixShape == 'ronde'){
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/napperond.png)'};
          this.rondORrect = 'napperond';

          this.showRond = true;
          this.showRect = false;

          this.reqDiam = 'required';
          this.reqHaut = this.reqLarg = '';
        }

        // afficher le champ suivant et indiquer qu'il est requis :

        this.showSize = true;
        this.reqSize = 'required';
        this.toggleSize = true;
        this.choixSize = 'retombée';
    },

    // fonction affichage champs formulaire :           au choix retombée validé
    //==========================================================================
    selectSize: function(value) {
        this.dimensions = value;
        this.choixSize = value;
        this.toggleSize = false;
        this.reqSize = '';

        if (this.choixShape == 'rectangulaire') this.rondORrect = 'nappecarre';
        if (this.choixShape == 'ronde') this.rondORrect = 'napperond';

        if (this.dimensions == 20) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'1.png)'};
        if (this.dimensions == 30) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'2.png)'};
        if (this.dimensions == 40) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'3.png)'};
        if (this.dimensions == 50) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'4.png)'};
        if (this.dimensions == 60) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'5.png)'};
        if (this.dimensions == 70) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'6.png)'};
        if (this.dimensions == 80) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'7.png)'};
        if (this.dimensions == 90) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/nappe/'+this.rondORrect+'8.png)'};

        if (this.choixShape == 'rectangulaire' && ((this.dimensions*2+this.largeur) >= 259))  {
          this.reqLarg = 'required';
          this.errorSize = 'largeur totale: '+(this.dimensions*2+this.largeur)+'  max: 259 cm';
          this.showEsize = this.toggleSize = true;
          this.showSign = this.showOptions = this.showMaqt = false;

        } else  if (this.choixShape == 'ronde' && ((this.dimensions*2+this.diametre) <= 59 || (this.dimensions*2+this.diametre) >= 259))  {
          this.reqDiam = 'required';
          this.errorSize = 'diamètre total minimum: 59 cm / max: 259 cm';
          this.showEsize = this.toggleSize = true;
          this.showSign = this.showOptions = this.showMaqt = false;

        } else {
          this.reqLarg = this.reqDiam = this.errorSize = ''; this.showEsize = false;

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    },

    // fonction affichage champs formulaire :           au choix maquette validé
    //==========================================================================
    selectMaqt: function(value) {
        this.maquette = value;
        this.choixMaqt = value;
        this.toggleMaqt = false;
        this.reqMaqt = '';

        this.showSign = true;
        this.reqSign = 'required';
        this.toggleSign = true;
        this.choixSign = 'logo france banderole ?';
    },

    // fonction affichage champs formulaire :          au choix signature validé
    //==========================================================================
    selectSign: function(value) {
        this.sign = value;
        this.choixSign = value;
        this.toggleSign = false;
        this.reqSign = '';

        this.reqQtte = 'required';
        this.showOptions = true;
    },

    // fonctions hover :                                    HOVER texte OU image
    //==========================================================================
    // (calque) passe la valeur numérique du calque preview,
    // (src) passe soit le nom de l'image hover, soit le contenu texte pour le calque texte (9)

    hoPw: function(calque, src) {
      this.slideContainer = false; // slider désactivé
      this.prH = this.pr0 = true;  // calques bg et préview activés

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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/nappe/'+src+'.png)'};
      }
    },

    // fonctions hover :                                    HOVER texte ET image
    //==========================================================================
    // (calque) passe la valeur numérique du calque preview,
    // (src) passe le nom de l'image, txt le contenu texte

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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/nappe/'+src+'.png)'};
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

    // fonctions input hauteur / largeur :                     check remplissage
    //==========================================================================
    checkSize: function(input, value) {
      if (value < 1 || isNaN(value) || value == '') {
        if (input == 'hauteur')  {this.reqHaut = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}
        if (input == 'largeur')  {this.reqLarg = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}
        if (input == 'diametre') {this.reqDiam = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}

      } else {
        if (input == 'hauteur')  {this.reqHaut = ''; this.errorSize = ''; this.showEsize = false;}
        if (input == 'largeur')  {this.reqLarg = ''; this.errorSize = ''; this.showEsize = false;}
        if (input == 'diametre') {this.reqDiam = ''; this.errorSize = ''; this.showEsize = false;}
      }
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

        this.ajoutPanier   = true;
        this.livraisonComp = true;
        this.dateTrigger   = !this.dateTrigger;

        //------------------------------------------- variables de calcul panier
    		var prliv             = '';
    		var prixunite         = 0;
    		var cena              = 0; 	var cena2   		= 0;
    		var rabat             = 0;
    		var suma              = 0; 	var suma2   		= 0;
    		var transport         = 0;
    		var metraz            = 0;
    		var metrazzaokraglony = 0;
    		var option 		      	= 0;
    		var optliv            = '';
    		var perteH            = 0; 	var perteL 			= 0;
    		var h1                = 0; 	var h2      		= 0;
    		var l1                = 0; 	var l2      		= 0;
    		var opis              = ''; var bacheType   = '';
    		var metragefinal      = 0;  var laize       = 0;
    		var cenatotal         = 0;
    		var metrage           = 0;
    		var plm               = 0;  // prix de la laize au M²
    		var prixproduit       = 0;  var prix 				= 0;
    		var prixtotal      	  = 0;

        // -----------------------------------------------------------dimensions

        var longueursite = this.hauteur;
        var largeursite  = this.largeur;
    		var diametresite = this.diametre;
        var retombee     = this.dimensions;
    		var rajout       = retombee/100 ;

    		diametresite = parseFloat(diametresite)/100 ;
    		largeursite  = parseFloat(largeursite)/100 ;
    		longueursite = parseFloat(longueursite)/100 ;

    		var largeur  = largeursite +(rajout*2);
    		var longueur = longueursite+(rajout*2);
        var diametre = diametresite+(rajout*2);

        // ------------------------------------------------------ calcul métrage

    		metraz   = largeur*longueur ;                   // métrage
    		metraz   = fixstr(metraz);
    		var metrazzaokraglony1 = (largeur+longueur)*2;  // périmètre
    		metrazzaokraglony      = Math.round(metrazzaokraglony1);
    		var hautbas            = largeur*2;
    		var gauchedroite       = longueur*2;

    		//------------------------------prix de la nappe en fonction de la laize

    		if (largeur  <= 1.55)                     {l1 = 1.55; l2 = 1.55-largeur;  perteL = l2*longueur;}
    		if (largeur  >= 1.56 && largeur  <= 2.60) {l1 = 2.60; l2 = 2.60-largeur;  perteL = l2*longueur;}
    		if (largeur  >= 2.61)                     {l1 = largeur;                  perteL = largeur*longueur;}

    		if (longueur <= 1.55)                     {h1 = 1.55; h2 = 1.55-longueur; perteH = h2*largeur;}
    		if (longueur >= 1.56 && longueur <= 2.60) {h1 = 2.60; h2 = 2.60-longueur; perteH = h2*largeur;}
    		if (longueur >= 2.61)                     {h1 = longueur;                 perteH = longueur*largeur;}

    		if (diametre <= 1.55)                     {h1 = 1.55;}
    		if (diametre >= 1.56 && diametre <= 2.60) {h1 = 2.60;}

        //------------------------------------------------ NAPPES RECTANGULAIRES

    		if (perteH < perteL && this.choixShape == 'rectangulaire') {

    			metrage = largeur*h1;

    			// tissu 220g
    			if (this.support == 'tissu 220g' && (h1<=1.00))             {plm =15.50 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.01 && h1<=1.60)) {plm =16.48 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.61 && h1<=2.00)) {plm =17.45 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.01 && h1<=2.50)) {plm =18.43 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.51))             {plm =19.40 ;}
    			// tissu 260g
    			if (this.support == 'tissu 260g' && (h1<=1.00))             {plm =25.50 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.01 && h1<=1.60)) {plm =28.08 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.61 && h1<=2.00)) {plm =29.65 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.01 && h1<=2.50)) {plm =30.23 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.51))             {plm =31.80 ;}

    			prixproduit = metrage*plm;

    		} else if (perteH > perteL && this.choixShape == 'rectangulaire') {

    			metrage = longueur*l1;

    			// tissu 220g
    			if (this.support == 'tissu 220g' && (h1<=1.00))             {plm =15.50 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.01 && h1<=1.60)) {plm =16.48 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.61 && h1<=2.00)) {plm =17.45 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.01 && h1<=2.50)) {plm =18.43 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.51))             {plm =19.40 ;}
    			// tissu 260g
    			if (this.support == 'tissu 260g' && (h1<=1.00))             {plm =25.50 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.01 && h1<=1.60)) {plm =28.08 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.61 && h1<=2.00)) {plm =29.65 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.01 && h1<=2.50)) {plm =30.23 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.51))             {plm =31.80 ;}

    			prixproduit = metrage*plm;

    		} else if (perteH == perteL && this.choixShape == 'rectangulaire') {

    			metrage = longueur*l1;

    			// tissu 220g
    			if (this.support == 'tissu 220g' && (h1<=1.00))             {plm =15.50 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.01 && h1<=1.60)) {plm =16.48 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.61 && h1<=2.00)) {plm =17.45 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.01 && h1<=2.50)) {plm =18.43 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.51))             {plm =19.40 ;}
    			// tissu 260g
    			if (this.support == 'tissu 260g' && (h1<=1.00))             {plm =25.50 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.01 && h1<=1.60)) {plm =28.08 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.61 && h1<=2.00)) {plm =29.65 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.01 && h1<=2.50)) {plm =30.23 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.51))             {plm =31.80 ;}

    			prixproduit = metrage*plm; // prix de la nappe
    		}

        //-------------------------------------------------------- NAPPES RONDES

        if (this.choixShape == 'ronde') {

    			metrage = diametre*h1;

    			// tissu 220g
    			if (this.support == 'tissu 220g' && (h1<=1.00))             {plm =15.50 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.01 && h1<=1.60)) {plm =16.48 ;}
    			if (this.support == 'tissu 220g' && (h1>=1.61 && h1<=2.00)) {plm =17.45 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.01 && h1<=2.50)) {plm =18.43 ;}
    			if (this.support == 'tissu 220g' && (h1>=2.51))             {plm =19.40 ;}

    			// tissu 260g
    			if (this.support == 'tissu 260g' && (h1<=1.00))             {plm =25.50 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.01 && h1<=1.60)) {plm =28.08 ;}
    			if (this.support == 'tissu 260g' && (h1>=1.61 && h1<=2.00)) {plm =29.65 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.01 && h1<=2.50)) {plm =30.23 ;}
    			if (this.support == 'tissu 260g' && (h1>=2.51))             {plm =31.80 ;}

    			prixproduit = metrage*plm; // prix de la nappe
    		}

    		metragefinal = metrage*this.qte;
    		prixtotal    = prixproduit*this.qte;

    		//---------- prix de l'ensemble de la commande en fonction metrage final

    		//----------------------------------------------------------- tissu 220g
    		if (this.support == 'tissu 220g' ) {
    			if (  metragefinal < 1.99 )                               {cenatotal = prixtotal;}
    			if ( (metragefinal > 1.99)   && (metragefinal <= 3.99) )  {cenatotal = prixtotal*0.99;}
    			if ( (metragefinal > 3.99)   && (metragefinal <= 5.99) )  {cenatotal = prixtotal*0.98;}
    			if ( (metragefinal > 5.99)   && (metragefinal <= 7.99) )  {cenatotal = prixtotal*0.97;}
    			if ( (metragefinal > 7.99)   && (metragefinal <= 9.99) )  {cenatotal = prixtotal*0.96;}
    			if ( (metragefinal > 9.99)   && (metragefinal <= 13.99) ) {cenatotal = prixtotal*0.95;}
    			if ( (metragefinal > 13.99)  && (metragefinal <= 17.99) ) {cenatotal = prixtotal*0.94;}
    			if ( (metragefinal > 17.99)  && (metragefinal <= 23.99) ) {cenatotal = prixtotal*0.93;}
    			if ( (metragefinal > 23.99)  && (metragefinal <= 29.99) ) {cenatotal = prixtotal*0.92;}
    			if ( (metragefinal > 29.99)  && (metragefinal <= 39.99) ) {cenatotal = prixtotal*0.91;}
    			if ( (metragefinal > 39.99)  && (metragefinal <= 49.99) ) {cenatotal = prixtotal*0.90;}
    			if ( (metragefinal > 49.99)  && (metragefinal <= 59.99) ) {cenatotal = prixtotal*0.89;}
    			if ( (metragefinal > 59.99)  && (metragefinal <= 69.99) ) {cenatotal = prixtotal*0.88;}
    			if ( (metragefinal > 69.99)  && (metragefinal <= 79.99) ) {cenatotal = prixtotal*0.87;}
    			if ( (metragefinal > 79.99)  && (metragefinal <= 89.99) ) {cenatotal = prixtotal*0.86;}
    			if ( (metragefinal > 89.99)  && (metragefinal <= 99.99) ) {cenatotal = prixtotal*0.85;}
    			if ( (metragefinal > 99.99)  && (metragefinal <= 149.99)) {cenatotal = prixtotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99)) {cenatotal = prixtotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99)) {cenatotal = prixtotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99)) {cenatotal = prixtotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99)) {cenatotal = prixtotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99)) {cenatotal = prixtotal*0.79;}
    			if (  metragefinal > 499.99)                              {cenatotal = prixtotal*0.78;}
    			bacheType = 'tissu stretch léger 220g M1';
    		}

    		//----------------------------------------------------------- tissu 260g
    		if (this.support == 'tissu 260g' ) {
    			if (  metragefinal < 1.99 )                               {cenatotal = prixtotal;}
    			if ( (metragefinal > 1.99)   && (metragefinal <= 3.99) )  {cenatotal = prixtotal*0.99;}
    			if ( (metragefinal > 3.99)   && (metragefinal <= 5.99) )  {cenatotal = prixtotal*0.98;}
    			if ( (metragefinal > 5.99)   && (metragefinal <= 7.99) )  {cenatotal = prixtotal*0.97;}
    			if ( (metragefinal > 7.99)   && (metragefinal <= 9.99) )  {cenatotal = prixtotal*0.96;}
    			if ( (metragefinal > 9.99)   && (metragefinal <= 13.99) ) {cenatotal = prixtotal*0.95;}
    			if ( (metragefinal > 13.99)  && (metragefinal <= 17.99) ) {cenatotal = prixtotal*0.94;}
    			if ( (metragefinal > 17.99)  && (metragefinal <= 23.99) ) {cenatotal = prixtotal*0.93;}
    			if ( (metragefinal > 23.99)  && (metragefinal <= 29.99) ) {cenatotal = prixtotal*0.92;}
    			if ( (metragefinal > 29.99)  && (metragefinal <= 39.99) ) {cenatotal = prixtotal*0.91;}
    			if ( (metragefinal > 39.99)  && (metragefinal <= 49.99) ) {cenatotal = prixtotal*0.90;}
    			if ( (metragefinal > 49.99)  && (metragefinal <= 59.99) ) {cenatotal = prixtotal*0.89;}
    			if ( (metragefinal > 59.99)  && (metragefinal <= 69.99) ) {cenatotal = prixtotal*0.88;}
    			if ( (metragefinal > 69.99)  && (metragefinal <= 79.99) ) {cenatotal = prixtotal*0.87;}
    			if ( (metragefinal > 79.99)  && (metragefinal <= 89.99) ) {cenatotal = prixtotal*0.86;}
    			if ( (metragefinal > 89.99)  && (metragefinal <= 99.99) ) {cenatotal = prixtotal*0.85;}
    			if ( (metragefinal > 99.99)  && (metragefinal <= 149.99)) {cenatotal = prixtotal*0.84;}
    			if (( metragefinal > 149.99) && (metragefinal <= 199.99)) {cenatotal = prixtotal*0.83;}
    			if (( metragefinal > 199.99) && (metragefinal <= 249.99)) {cenatotal = prixtotal*0.82;}
    			if (( metragefinal > 249.99) && (metragefinal <= 299.99)) {cenatotal = prixtotal*0.81;}
    			if (( metragefinal > 299.99) && (metragefinal <= 399.99)) {cenatotal = prixtotal*0.80;}
    			if (( metragefinal > 399.99) && (metragefinal <= 499.99)) {cenatotal = prixtotal*0.79;}
    			if (  metragefinal > 499.99)                              {cenatotal = prixtotal*0.78;}
    			bacheType = 'tissu stretch extensible 260g M1';
    		}

    		//--------------------------------------------------------------- ourlet
    		var ourletourlet = 0;
    		var perimetrerond  = diametre*3.14
    		var perimetrecarre = gauchedroite + hautbas;
    		if(this.choixShape == 'ronde')         ourlet = 4.5*perimetrerond;
    		if(this.choixShape == 'rectangulaire') ourlet = 4.5*perimetrecarre;

    		//----------------------------------------------- prix total avec ourlet
    		transport = 5;
    		cena = (cenatotal+ourlet+transport)/this.qte;

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          cena += 19/this.qte;
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          cena += 5/this.qte;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          cena += 5/this.qte;
          this.modmaq = 'je crée ma maquette en ligne';
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}

        // ----------------------------------------------------------- SIGNATURE

        if (this.sign == 'sans signature') {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena+= 5;}
        }

        // ------------------------------------------------------------- OPTIONS

        if (this.adresse == true) {
          this.retrait = 'livraison';
        }

        if (this.atelier == true) {
          cena-= cena*3/100;
          this.retrait = 'retrait colis atelier';
        }

        if (this.relais == true) {
          cena += 5/this.qte;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 2;}
          this.optliv = ' / colis revendeur';
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

          if      (this.delaiprod == '2-3') ProdPercent = 20;
          else if (this.delaiprod == '1-1') ProdPercent = 45;
          else                              ProdPercent = 0;

          if      (this.delailiv == '2-3')  DeliPercent = 20;
          else if (this.delailiv == '1-1')  DeliPercent = 45;
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

        //---------------------------- vérifier que les champs sont bien remplis
        if (this.choixShape == 'choisir la forme') {
          this.erreurType=1; this.reqShape = 'required';
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une forme';

        } else if (this.qte < 1 || isNaN(this.qte))        {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';
          this.reqLarg = this.reqHaut = this.reqDiam = '';

        } else if (this.choixShape == 'rectangulaire' && longueur*100 >= 5000) {
          this.errorMessage='<i class="fa fa-warning"></i> longueur max 5000 cm';
          this.erreurType=1; this.reqHaut = 'required';
          this.reqLarg = this.reqQtte = '';

        } else if (this.choixShape == 'rectangulaire' && largeur*100 >= 259) {
          this.errorMessage='<i class="fa fa-warning"></i> largeur + retombée dépasse le maximum de 259 cm';
          this.erreurType=1; this.reqLarg = 'required';
          this.reqHaut = this.reqQtte = '';

        } else if (this.choixShape == 'ronde' && diametre*100 <= 49 ) {
          this.errorMessage='<i class="fa fa-warning"></i> diamètre minimum 49cm';
          this.erreurType=1; this.reqDiam = 'required';
          this.reqQtte = '';

        } else if (this.choixShape == 'ronde' && diametre*100 >= 259) {
          this.errorMessage='<i class="fa fa-warning"></i> diamètre + retombée dépasse le maximum de 259cm';
          this.erreurType=1; this.reqDiam = 'required';
          this.reqQtte = '';

        } else if (this.choixShape == 'rectangulaire' && (this.hauteur  == '' || isNaN(this.hauteur))) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur en cm';
          this.erreurType=1; this.reqHaut = 'required'; this.reqDiam = '';
          this.reqLarg = this.reqQtte = '';

        } else if (this.choixShape == 'rectangulaire' && (this.largeur  == '' || isNaN(this.largeur))) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une largeur en cm';
          this.erreurType=1; this.reqLarg = 'required'; this.reqDiam = '';
          this.reqHaut = this.reqQtte = '';

        } else if (this.choixShape == 'ronde' && (this.diametre  == '' || isNaN(this.diametre))) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer un diamètre en cm';
          this.erreurType=1; this.reqLarg = ''; this.reqDiam = 'required';
          this.reqHaut = this.reqQtte = '';

        } else if(this.choixSize  == 'retombée') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir la retombée';}
          else if(this.choixRecv == 'quelle impression voulez-vous ?') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option impression';

        } else {
          this.reqLarg = this.reqHaut = this.reqQtte = '';
        }

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

          // ----------------------------------------- forfait si prix < 14.90 €
          if ( suma < 14.90 ) {
            var forfait = 14.90 - suma;
            var newoption;
            var newoption2;
            forfait = fixstr(forfait);
            this.forfait = 'FORFAIT '+ forfait +' € - ';

            if (option > 0) {
              newoption = parseFloat(option) + parseFloat(forfait);
              newoption = fixstr(newoption);
              newoption2 = newoption.replace(".", ",");
              option2 = newoption2;

              this.prixOption = newoption2 +' €' ;

              suma = 14.90;
              suma = fixstr(suma);
              this.suma2 = suma.replace(".", ",");

              this.prixTotal = this.suma2 +' €' ;

            } else {
              newoption = parseFloat(forfait);
              newoption = fixstr(newoption);
              newoption2 = newoption.replace(".", ",");
              option2 = newoption2;

              this.prixOption = newoption2 +' €' ;

              suma = 14.90;
              suma = fixstr(suma);
              this.suma2 = suma.replace(".", ",");

              this.prixTotal = this.suma2 +' €' ;
            }
          }

          genImg(); // générer l'image produit et l'ajouter au formulaire

          // ---------------------------------------- données envoyées au panier
          var dprod = this.delaiprod;  if (this.delaiprod == '1-1') dprod = '1';
          var dliv  = this.delailiv;   if (this.delailiv  == '1-1') dliv  = '1';

          if (this.choixShape == 'ronde') {
            this.inputDiametre = (diametre*100).toFixed(0);
            this.details = bacheType+'<br>- '+this.choixShape+' &empty;|'+this.inputDiametre+' cm <br>- dont '+this.choixSize+' cm de retombée';
            this.inputHauteur = this.inputLargeur = this.inputDiametre;
          }else{
            this.inputHauteur = (longueur*100).toFixed(0);
            this.inputLargeur = (largeur*100).toFixed(0);
            this.details = bacheType+'<br>- '+this.choixShape+' L|'+this.inputHauteur+'cm x l|'+this.inputLargeur+' cm <br>- dont '+this.choixSize+' cm de retombée';
          }

          this.inputDesc = '- '+this.details+' <br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'Nappe';
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
