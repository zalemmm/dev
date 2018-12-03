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

      // valeurs par défaut (value) : champs select
      produit: '',
      dimensions: '',
      support: '',
      support2: '',
      maquette: '',
      sign: '',
      accessoire: '',

      // valeurs par défaut (value) : autre champs
      choixProd : 'choisir votre modèle de stand',
      choixSize : '',
      choixSupp : '',
      choixSupp2: '',
      choixMaqt : '',
      choixSign : '',
      choixAcce : '',
      qte: 1,
      adresse: true,
      atelier: false,
      relais: false,
      colis: false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes
      reqProd : 'required',
      reqSize : '',
      reqSupp : '',
      reqSupp2:'',
      reqMaqt : '',
      reqSign : '',
      reqQtte : '',
      reqEstm : '',
      reqAcce : '',

      btnP1: 'inactive',
      btnP2: 'inactive',
      btnP3: 'inactive',
      btnD1: 'inactive',
      btnD2: 'inactive',
      btnD3: 'inactive',

      // valeurs par défaut de visibilité des blocs :
      toggleProd: true,
      toggleSize: true,
      toggleSupp: true,
      toggleSupp2: true,
      toggleMaqt: true,
      toggleSign: true,
      toggleAcce: true,

      courbSize: false,
      droitSize: false,

      showSupport: false,
      showSupport2: false,

      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,
      showAcce: false,

      dateLivraison: false,
      livraisonrapide: false,
      livraisonComp: false,
      formError: false,
      ajoutPanier: false,

      // valeurs par défaut : options individuelles
      suppPhotocall: false,
      suppValise: false,
      suppComptoir: false,
      optsupValise: false,
      valiseSeule: false,

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
      hoverTrigger : false,
      dateTrigger: false,
      errorTrigger: false,

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
      prliv: '',
      cena2: 0,
      rabat2: 0,
      suma2: 0,
      transport: 0,
      hauteur: 0,
      largeur: 0,
      prodref: '',

      // valeurs par défaut bloc de droite :  prix et infos
      //cartData: '',
      estdate: '',
      forfait: '',
      message: 'livraison comprise',
      erreurType: 0,
      errorMessage: '',
      errorColor: '',
      prixUnit: '-',
      prixOption: '-',
      prixTotal: '-'

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

    // fonction affichage champs formulaire :            au choix produit validé
    //==========================================================================
    selectProd: function(value) {

        this.produit = value;     // on attribue la valeur renvoyée par la fonction à la variable produit
        this.choixProd = value;   // on attribue la valeur au champ de titre produit
        this.toggleProd = false;  // on replie le menu à la sélection
        this.reqProd = '';        // on rétablit les styles du champ à "non requis"

        // champs réinitialisés + masqués si l'utilisateur revient sur son choix produit :
        this.showSupport = this.suppPhotocall = this.suppValise = this.courbSize = this.droitSize = this.showAcce = false;
        this.details = '';

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/parapluie/bg.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        // -------------------------------------------------------- TISSU COURBE
        if (this.produit == 'Tissu courbe') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/courbe.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.courbSize = true;
          this.reqSize = 'required';
          this.toggleSize = true;
          this.choixSize = 'choisir les dimensions';

        // --------------------------------------------------------- TISSU DROIT
        } else if (this.produit == 'Tissu droit') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.droitSize = true;
          this.reqSize = 'required';
          this.toggleSize = true;
          this.choixSize = 'choisir les dimensions';

        // ------------------------------------------------------------- EXPOBAG
        } else if (this.produit == 'Stand ExpoBag') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/standexpo.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.suppPhotocall = true;
          this.reqSupp = 'required';
          this.toggleSupp = true;
          this.choixSupp = 'choisir le support mur d\'images';

        // ------------------------------------------------------------ COMPTOIR
        } else if (this.produit == 'Comptoir Easy Quick') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/comptoir.png)'};

          // afficher/masquer les champs
          this.showSupport = true;
          this.reqSupp = 'required';
          this.toggleSupp = true;
          this.choixSupp = 'choisir le support';

        // -------------------------------------------------------------- VALISE
        }else if (this.produit == 'valise') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/valise.png)'};

          // afficher/masquer les champs
          this.suppValise = true;
          this.valiseSeule = true;
          this.reqSupp2 = 'required';
          this.toggleSupp2 = true;
          this.choixSupp2 = 'choisir le support';
        }


    }, // fin fonction choix produit

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectSize: function(value) {
        this.dimensions = value;   // on attribue la valeur renvoyée par la fonction à la variable dimension
        this.choixSize = value;    // on attribue la valeur au champ de titre dimensions
        this.toggleSize = false;   // on replie le menu à la sélection
        this.reqSize = '';         // on rétablit les styles du champ à "non requis"

        // afficher/masquer les images
        if (this.produit == 'Tissu courbe' && this.dimensions == '3x3') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/courbe3.png)'};
        if (this.produit == 'Tissu courbe' && this.dimensions == '3x4') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/courbe4.png)'};
        if (this.produit == 'Tissu droit') {
          if (this.dimensions.indexOf('3x1') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand1.png)'};
          if (this.dimensions.indexOf('3x2') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand2.png)'};
          if (this.dimensions.indexOf('3x3') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand3.png)'};
          if (this.dimensions.indexOf('3x4') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand4.png)'};
          if (this.dimensions.indexOf('3x5') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand5.png)'};
          if (this.dimensions.indexOf('3x6') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand6.png)'};
          if (this.dimensions.indexOf('3x7') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand7.png)'};
          if (this.dimensions.indexOf('3x8') !== -1) this.bg1 = {backgroundImage: 'url('+this.$global.img+'/parapluie/stand8.png)'};
        }

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showSupport = true;
        this.reqSupp = 'required';
        this.toggleSupp = true;
        this.choixSupp = 'choisir le support';

    }, // fin fonction choix dimensions

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectSupport: function(value) {
        this.support = value;     // on attribue la valeur à la variable support
        this.choixSupp = value;   // on attribue la valeur au champ de titre support
        this.toggleSupp = false;  // on replie le menu à la sélection
        this.reqSupp = '';        // on rétablit les styles du champ à "non requis"

        if (this.produit == 'Stand ExpoBag') {
          this.suppValise = true;
          this.valiseSeule = false;
          this.reqSupp2 = 'required';
          this.toggleSupp2 = true;
          this.choixSupp2 = 'choisir le support impression valise';

        } else if (this.produit == 'Tissu courbe' || this.produit == 'Tissu droit') {
          this.showAcce = true;
          this.reqAcce = 'required';
          this.toggleAcce = true;
          this.choixAcce = 'choisir une option';

        } else {
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    },

    // fonction affichage champs formulaire :     au choix support valise validé
    //==========================================================================
    selectSupport2: function(value) {
        this.support2 = value;     // on attribue la valeur à la variable support
        this.choixSupp2 = value;   // on attribue la valeur au champ de titre support
        this.toggleSupp2 = false;  // on replie le menu à la sélection
        this.reqSupp2 = '';        // on rétablit les styles du champ à "non requis"

        this.showMaqt = true;
        this.reqMaqt = 'required';
        this.toggleMaqt = true;
        this.choixMaqt = 'votre maquette (fichier d\'impression)';
    },

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectAcce: function(value) {
        this.accessoire = value;  // on attribue la valeur à la variable accessoire
        this.choixAcce = value;   // on attribue la valeur au champ de titre accessoire
        this.toggleAcce = false;  // on replie le menu à la sélection
        this.reqAcce = '';        // on rétablit les styles du champ à "non requis"

        this.pr2 = true;
        if (this.accessoire == 'Comptoir Easy Quick')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/parapluie/comptoir.png)'};
        if (this.accessoire == 'Valise transformable') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/parapluie/valise.png)'};

        this.showMaqt = true;
        this.reqMaqt = 'required';
        this.toggleMaqt = true;
        this.choixMaqt = 'votre maquette (fichier d\'impression)';
    },

    // fonction affichage champs formulaire :          au choix signature validé
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

    // fonction affichage champs formulaire :           au choix maquette validé
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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/parapluie/bg.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/parapluie/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/parapluie/bg.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/parapluie/'+src+'.png)'};
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
        this.atelier = this.adresse = false;
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
        this.reqQtte = '';
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

        var cena           = 0;   var cena2    = 0;
        var rabat          = 0;   var rabat2   = 0;
        var suma           = 0;   var suma2    = 0;
        var tissu220       = 0;   var tissu260 = 0;
        var scratch        = 0;
        var optliv         = '';  var rodzaj   = '';
        var designation    = '';  var support  = '';
        var tissu          = '';  var accss    = '';
        var structure      = '';  var pied     = 0;
        var trans          = '';
        var prliv          = '';
        var date_panier    = '';

        /// stand tissu droit //////////////////////////////////////////////////////

        if (this.produit == 'Tissu droit' || this.produit == 'Tissu courbe') {
          trans = 15;
          rodzaj = "Stand Tissu";
          //////////////////////////////////////////////////////////// recto simple //
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x1 Recto' ) {
            scratch = 7;
        		structure = 75;
            tissu220 = 35;
            tissu260 = 39;
        		designation = 'recto 3x1 Droit';
            this.prodref = '20170200';
            this.hauteur = 227;
            this.largeur = 79;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x2 Recto' ) {
            structure = 85;
            scratch = 9;
            tissu220 = 40;
            tissu260 = 56;
        		designation = 'recto 3x2 Droit';
            this.prodref = '20170201';
            this.hauteur = 227;
            this.largeur = 152;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x3 Recto' ) {
        		structure = 88;
            scratch = 10;
            tissu220 = 39;
            tissu260 = 65;
        		designation = 'recto 3x3 Droit';
            this.prodref = '20170202';
            this.hauteur = 227;
            this.largeur = 227;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x4 Recto' ) {
        		structure = 119;
            scratch = 12;
            tissu220 = 51;
            tissu260 = 68;
        		designation = 'recto 3x4 Droit';
            this.prodref = '20170203';
            this.hauteur = 227;
            this.largeur = 300;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x5 Recto' ) {
            pied = 30;
        		structure = 145;
            scratch = 15;
            tissu220 = 62;
            tissu260 = 82;
        		designation = 'recto 3x5 Droit';
            this.prodref = '20170204';
            this.hauteur = 227;
            this.largeur = 373;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x6 Recto' ) {
            pied = 30;
        		structure = 310;
            scratch = 20;
            tissu220 = 71;
            tissu260 = 95;
        		designation = 'recto 3x6 Droit';
            this.prodref = '20170205';
            this.hauteur = 227;
            this.largeur = 446;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x7 Recto' ) {
            pied = 30;
        		structure = 360;
            scratch = 24;
            tissu220 = 82;
            tissu260 = 109;
        		designation = 'recto 3x7 Droit';
            this.prodref = '20170206';
            this.hauteur = 227;
            this.largeur = 520;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x8 Recto' ) {
            pied = 30;
        		structure = 420;
            scratch = 30;
            tissu220 = 92;
            tissu260 = 123;
        		designation = 'recto 3x8 Droit';
            this.prodref = '20170207';
            this.hauteur = 227;
            this.largeur = 594;
        	}

          /////////////////////////////////////////////////////////// recto verso //
        	if (this.dimensions == '3x1 Recto Verso' ) {
        		structure = 125;
            scratch = 14;
            tissu220 = 33.12;
            tissu260 = 44.16;
        		designation = 'Recto Verso 3x1 Droit';
            this.prodref = '20170210';
            this.hauteur = 227;
            this.largeur = 79;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x2 Recto Verso' ) {
        		structure = 150;
            scratch = 16.9;
            tissu220 = 53.13;
            tissu260 = 70.84;
        		designation = 'Recto Verso 3x2 Droit';
            this.prodref = '20170211';
            this.hauteur = 227;
            this.largeur = 152;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x3 Recto Verso' ) {
        		structure = 170;
            scratch = 19.8;
            tissu220 = 73.14;
            tissu260 = 97.52;
        		designation = 'Recto Verso 3x3 Droit';
            this.prodref = '20170212';
            this.hauteur = 227;
            this.largeur = 227;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x4 Recto Verso' ) {
        		structure = 220;
            scratch = 22.6;
            tissu220 = 92.46;
            tissu260 = 123.28;
        		designation = 'Recto Verso 3x4 Droit';
            this.prodref = '20170213';
            this.hauteur = 227;
            this.largeur = 300;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x5 Recto Verso' ) {
            pied = 30;
        		structure = 270;
            scratch = 25.6;
            tissu220 = 113.16;
            tissu260 = 150.88;
        		designation = 'Recto Verso 3x5 Droit';
            this.prodref = '20170214';
            this.hauteur = 227;
            this.largeur = 373;
        	}
          //------------------------------------------------------------------------
          if (this.dimensions == '3x6 Recto Verso' ) {
            pied = 30;
            structure = 375;
            scratch = 28.6;
            tissu220 = 133.86;
            tissu260 = 178.48;
            designation = 'Recto Verso 3x6 Droit';
            this.prodref = '20170215';
            this.hauteur = 227;
            this.largeur = 446;
          }
          //------------------------------------------------------------------------
          if (this.dimensions == '3x7 Recto Verso' ) {
            pied = 30;
            structure = 440;
            scratch = 31.5;
            tissu220 = 153.87;
            tissu260 = 205.16;
            designation = 'Recto Verso 3x7 Droit';
            this.prodref = '20170216';
            this.hauteur = 227;
            this.largeur = 520;
          }
          //------------------------------------------------------------------------
          if (this.dimensions == '3x8 Recto Verso' ) {
            pied = 30;
            structure = 485;
            scratch = 34.5;
            tissu220 = 174.57;
            tissu260 = 232.76;
            designation = 'Recto Verso 3x8 Droit';
            this.prodref = '20170217';
            this.hauteur = 227;
            this.largeur = 594;
          }

          // stand tissu courbé ////////////////////////////////////////////////////
        	if (this.dimensions == '3x3' ) {
        		structure = 135;
            scratch = 10.2;
            tissu220 = 38.64;
            tissu260 = 51.52;
        		designation = 'recto 3x3 Courbé';
            this.prodref = '20170220';
            this.hauteur = 227;
            this.largeur = 209;
        	}
          //------------------------------------------------------------------------
        	if (this.dimensions == '3x4' ) {
        		structure = 180;
            scratch = 11.6;
            tissu220 = 48.3;
            tissu260 = 64.4;
        		designation = 'recto 3x4 Courbé';
            this.prodref = '20170221';
            this.hauteur = 227;
            this.largeur = 278;
        	}

          ////////////////////////////////////////////// total selon tissu choisi //
          if (this.support == 'tissu 220g' ) {
            cena = (tissu220+structure+scratch+pied)*1.75+trans;
            support = 'tissu 220g';
          }
          if (this.support == 'tissu 260g' ) {
            cena = (tissu260+structure+scratch+pied)*1.95+trans;
            support = 'tissu 260g';
          }

        	// ---------------------------------------------------prix stand tissu
        	// cena= (tissu+structure+trans)*1.40;


         	if (this.accessoire == 'Valise transformable' ) {
        		cena += 259+18; // PV + transport
        		accss = 'Valise ATLAS + Tablette (réf: 20170230)';
        	}
        	if (this.accessoire == 'Comptoir Easy Quick' ) {
        		cena += ((70+40)*1.70)+10; // struture+impression X coef + transport;
        		accss = 'Comptoir Easy Quick (réf: 20170231)';
        	}
          if (this.accessoire == 'sans option' ) {
        		accss = 'Sans option';
        	}
        }

        //--------------------------------------------- Comptoir Easy Quick seul
        if (this.produit == 'Comptoir Easy Quick') {

          rodzaj = "Comptoir";
          designation = 'Comptoir Easy Quick';

    		  if (this.support == 'tissu 220g' ) {
        		tissu = 25*3;//3=coeff //
        		support = 'Tissu 220g';
        	}
    		  if (this.support == 'tissu 260g' ) {
        		tissu =35*3;//prix du site x coeff //
        		support = 'Tissu 260g';
        	}

          this.prodref = '20170231';
          structure = 70*1.90;//1.80 = coeff //
          trans = 10;
          cena = tissu + structure + trans + scratch;
          this.hauteur = 102.4;
          this.largeur = 172;
        }

        //--------------------------------------------------------- valise seule
        if (this.produit == 'valise') {

          rodzaj = "Valise";
          designation = 'Valise ATLAS + Tablette';

      	  if (this.support2 == 'tissu 220g' ) {
        		tissu = 25.00*4;//4=coeff //
        		support = 'Tissu 220g';
        	}
      		if (this.support2 == 'tissu 260g' ) {
        		tissu = 30.00*4;//4=coeff //
        		support = 'Tissu 260g';
        	}
      		if (this.support2 == 'PVC 300µ' ) {
        		tissu = 15.00*2;//2=coeff //
        		support = 'PVC 300µ';
        	}
      		if (this.support2 == 'sans visuel' ) {
        		tissu = 0;//2=coeff //
        		support = 'Sans Impression';
        	}

          scratch = 5.5;
      	  trans = 20;
      	  structure = 142*1.40;
      	  cena = tissu + structure + trans + scratch;
          this.prodref = '20170230';
          this.hauteur = 90;
          this.largeur = 174;
        }

        //------------------------------------------------------- Stand expo bag
        if (this.produit == 'Stand ExpoBag') {

          rodzaj = "Stand ExpoBag";
          var rollup = 90; var portedocument = 35; var spot = 0; var photocall = 0; var valise = 0;

          if (this.support == 'jet 520 M1' ) {
            photocall = 190;
            designation = 'Mur d\'image en bâche 520g M1';
          }
          if (this.support == 'tissu 220g' ) {
            photocall = 205;
            designation = 'Mur d\'image en tissu 220g M1';
          }

          if (this.support2 == 'tissu 220g' ) {
            valise = 260;
            support = 'Visuel de la valise en tissu 220g M1';
          }
          if (this.support2 == 'PVC 300µ' ) {
            valise = 240;
            support = 'Visuel de la valise en PVC 300µ';
          }
          if (this.support2 == 'sans impression' ) {
            valise = 215;
            support = 'Valise sans impression';
          }

          cena = rollup+portedocument+photocall+valise+spot;
          this.prodref = '20170232';
          this.hauteur = 220;
          this.largeur = 240;
        }


        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          cena += this.$global.maqFB2/this.qte;
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          cena += this.$global.maqBAT/this.qte;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          cena += this.$global.maqONL/this.qte;
          this.modmaq = 'je crée ma maquette en ligne';
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}

        // ----------------------------------------------------------- SIGNATURE

        if (this.sign == 'sans signature') {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena+= 10;}
        }

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
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 10;}
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

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis
        if (this.choixSize == 'choisir les dimensions') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une dimension';

        } else if (this.choixSupp.indexOf('choisir le support') !== -1 || this.choixSupp2.indexOf('choisir le support') !== -1) {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir un support';

        } else if (this.qte < 1 || isNaN(this.qte)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';

        } else {
          this.reqQtte = '';
        }

        if (this.erreurType == 1) {
          this.prixUnit      = '-';
          this.prixOption    =  '-';
          this.prixTotal     = '-';
          this.ajoutPanier   = false;
          this.livraisonComp = false;
          this.formError     = true;
          this.errorTrigger  = !this.errorTrigger;
          this.reqEstm       = 'required';
        } else {
          this.formError     = false;
          this.reqEstm       = 'validate';
        }

        // ------------------------------------------ affichage livraison rapide
        if (this.erreurType == 0 && this.delailiv == '1-1' && this.delaiprod == '1-1') this.livraisonrapide = true;
        else this.livraisonrapide = false;

        // --------------------------------------------------- PREPARATION ENVOI

        if (this.erreurType==0 && (this.delailiv == '2-3' || this.delailiv == '1-1' || this.delailiv == '3-4')){
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

          if (this.produit == 'Tissu droit' || this.produit == 'Tissu courbe') this.details = designation+'<br>- '+support+'<br>- '+accss;
          else this.details = designation+'<br>- '+support;

          this.inputDesc = '- '+this.details+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = rodzaj;
          this.inputQte       = this.qte;
          this.inputPrix      = this.cena2;
          this.inputOption    = this.prixOption;
          this.inputRemise    = this.rabat2;
          this.inputTotal     = this.suma2;
          this.inputTransport = this.transport;
          this.inputHauteur   = this.hauteur;
          this.inputLargeur   = this.largeur;

        }
    }, // fin fonction calucler
  }, // fin méthodes VUE
}); // fin instance VUE
