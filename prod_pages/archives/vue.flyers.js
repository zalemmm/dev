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
      maquette: '',
      sign: '',

      // valeurs par défaut (value) : autre champs
      choixProd : 'choisir le produit',
      choixSize : '',
      choixSupp : '',
      choixForm : '',
      choixLami : '',
      choixMaqt : '',
      choixSign : '',
      choixPrint: '',
      choixQtte : '',
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
      reqLami : '',
      reqSupp : '',
      reqPrint: '',
      reqForm : '',
      reqMaqt : '',
      reqSign : '',
      reqQtte : '',
      reqEstm : '',

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
      toggleLami: true,
      togglePrint: true,
      toggleForm: true,
      toggleQtte: true,
      toggleMaqt: true,
      toggleSign: true,

      showSize: false,
      showSupp: false,
      showPrint: false,
      showLami: false,
      showForm: false,
      showQtte: false,

      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,

      dateLivraison: false,
      livraisonrapide: false,
      livraisonComp: false,
      formError: false,
      ajoutPanier: false,

      // valeurs par défaut : options individuelles
      flyer: true,
      depli: false,

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
        this.showSize = this.showPrint = this.showLami = this.showQtte = false;
        this.details = '';

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/papier/bg.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        if (this.produit == 'Flyers') {
          this.flyer = true;
          this.depli = false;

          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/papier/flyer.png)'};
        }
        if (this.produit == 'Depliants') {
          this.flyer = false;
          this.depli = true;

          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/papier/depliant.png)'};
        }

        this.showSupp = true;
        this.reqSupp = 'required';
        this.toggleSupp = true;
        this.choixSupp = 'choisir le grammage';

    }, // fin fonction choix produit

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectSupp: function(value) {
        this.support = value;
        this.choixSupp = value;
        this.toggleSupp = false;
        this.reqSupp = '';

        this.showLami = false;
        this.choixLami = '';

        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/papier/grammage.png)'};

        if (this.support == '135g' || this.support == '170g' || this.support == '250g' || this.support == '350g') {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showLami = true;
          this.reqLami = 'required';
          this.toggleLami = true;
          this.choixLami = 'type de papier';

        } else {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showSize = true;
          this.reqSize = 'required';
          this.toggleSize = true;
          this.choixSize = 'choisir les dimensions';
        }


    },

    // fonction affichage champs formulaire :             au choix papier validé
    //==========================================================================
    selectLami: function(value) {
        this.papier = value;
        this.choixLami = value;
        this.toggleLami = false;
        this.reqLami = '';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showSize= true;
        this.reqSize = 'required';
        this.toggleSize = true;
        this.choixSize = 'choisir les dimensions';
    },

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectSize: function(value) {
        this.dimensions = value;   // on attribue la valeur renvoyée par la fonction à la variable dimension
        this.choixSize = value;    // on attribue la valeur au champ de titre dimensions
        this.toggleSize = false;   // on replie le menu à la sélection
        this.reqSize = '';         // on rétablit les styles du champ à "non requis"

        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/papier/format-papier.png)'};

        if (this.produit == 'Flyers') {
          this.showPrint = true;
          this.reqPrint = 'required';
          this.togglePrint = true;
          this.choixPrint = 'choisir l\'impression';

        } else {
          this.showPrint = false;
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    },

    // fonction affichage champs formulaire :         au choix impression validé
    //==========================================================================
    selectPrint: function(value) {
        this.choixPrint = value;
        this.togglePrint = false;
        this.reqPrint = '';

        // afficher le champ suivant et indiquer qu'il est requis :
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

        if (this.produit == 'Flyers')    this.bg1 = {backgroundImage: 'url('+this.$global.img+'/papier/flyer.png)'};
        if (this.produit == 'Depliants') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/papier/depliant.png)'};

        if (this.maquette == 'maquette en ligne' && this.produit == 'Flyers') {
          this.showForm = true;
          this.reqForm = 'required';
          this.toggleForm = true;
          this.choixForm = 'choisir le format';

        } else {
          this.showForm = false;
          this.showSign = true;
          this.reqSign = 'required';
          this.toggleSign = true;
          this.choixSign = 'logo france banderole ?';
        }

    },

    // fonction affichage champs formulaire :             au choix format validé
    //==========================================================================
    selectForm: function(value) {
        this.choixForm = value;
        this.toggleForm = false;
        this.reqForm = '';

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

        this.showQtte = true;
        this.reqQtte = 'required';
        this.toggleQtte = true;
        this.choixQtte = 'choisir la quantité';
    },

    // fonction affichage champs formulaire :           au choix maquette validé
    //==========================================================================
    selectQtte: function(value) {
        this.qte = value;
        this.choixQtte = value;
        this.toggleQtte = false;
        this.reqQtte = '';

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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/papier/bg.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/papier/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/papier/bg.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/papier/'+src+'.png)'};
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
        this.erreurType = 0;
        this.warngMessage = '';
        this.errorMessage = '';
        this.formError = false;
        this.formWarng = false;
        this.forfait = '';
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

        //------------------------------------------- variables de calcul panier

        var cena        = 0;  var cena2  = 0; var cena1 =0 ; var cenar = 0; var cenarv = 0;
  			var suma        = 0;  var suma2  = 0;
  			var prixunite   = 0;
  			var rabat       = 0;  var rabat2 = 0;
  			var prliv       = '';
  			var transport   = 0;
  			var opis        = '';
  			var option2     = 0;
  			var clic        =0.05;
  			var cenaFB      ='';
  			var cenaFBfinal ='';
  			var gr          = ''; var p1  =''; var p2 ='';
  			var optliv      = ''; var pgr = 0;

  			//------------------------------------------------------------- gabarits
  			if (this.dimensions == 'A7')                                     this.prodref = '20171007';
  			if (this.dimensions == 'A6')                                     this.prodref = '20171006';
  			if (this.dimensions == 'A5')                                     this.prodref = '20171005';
  			if (this.dimensions == 'A4' || this.dimensions == 'A4 3 volets') this.prodref = '20171004';
  			if (this.dimensions == 'A3')                                     this.prodref = '20171003';
  			if (this.dimensions == 'Din long')                               this.prodref = '20171001';
        //----------------------------------------------------------------------

        //////////////////////////////////////////////////////////////////FLYERS
        if (this.produit == 'Flyers') {
          if (this.support == '80g' || this.support == '135g' || this.support == '170g' || this.support == '250g' || this.support == '350g') {
            /////////////////////////////////////////////////////////////////80g
            if (this.support == '80g') {
              if (this.dimensions == 'A7'){
                opis = '- A7 80gr | Quadri';
                if (this.qte == '25') { cena1=17.29;}
                if (this.qte == '50') { cena1=17.35;}
                if (this.qte == '100') { cena1=17.45;}
                if (this.qte == '250') { cena1=17.78;}
                if (this.qte == '500') { cena1=17.14;}
                if (this.qte == '1000') { cena1=19.43 ;}
                if (this.qte == '1250') { cena1=21.71;}
                if (this.qte == '2000') { cena1=21.75;}
                if (this.qte == '2500') { cena1=22.86;}
                if (this.qte == '5000') { cena1=28.32;}
                if (this.qte == '10000') { cena1=40.06;}
                if (this.qte == '15000') { cena1=45.89;}
                if (this.qte == '20000') { cena1=51.71;}
                if (this.qte == '25000') { cena1=62.02;}
                if (this.qte == '30000') { cena1=72.32;}
                if (this.qte == '35000') { cena1=82.62;}
                if (this.qte == '40000') { cena1=92.00;}
                if (this.qte == '45000') { cena1=103.00;}
                if (this.qte == '50000') { cena1=113.00;}
                if (this.qte == '75000') { cena1=171.00;}
                if (this.qte == '100000') { cena1=209.00;}
              }

              if (this.dimensions == 'A6') {
                opis = '- A6 80gr | Quadri';
                if (this.qte == '25') { cena1=18.43;}
                if (this.qte == '50') { cena1=18.49;}
                if (this.qte == '100') { cena1=18.63;}
                if (this.qte == '250') { cena1=19.03;}
                if (this.qte == '500') { cena1=19.72;}
                if (this.qte == '1000') { cena1=21.08;}
                if (this.qte == '1250') { cena1=23.97;}
                if (this.qte == '2000') { cena1=24.20;}
                if (this.qte == '2500') { cena1=25.42;}
                if (this.qte == '5000') { cena1=32.22;}
                if (this.qte == '10000') { cena1=47.02;}
                if (this.qte == '15000') { cena1=54.50;}
                if (this.qte == '20000') { cena1=61.93;}
                if (this.qte == '25000') { cena1=75.50;}
                if (this.qte == '30000') { cena1=89.02;}
                if (this.qte == '35000') { cena1=102.62;}
                if (this.qte == '40000') { cena1=116.18;}
                if (this.qte == '45000') { cena1=129.75;}
                if (this.qte == '50000') { cena1=143.00;}
                if (this.qte == '75000') { cena1=220.00;}
                if (this.qte == '100000') { cena1=272.00;}
              }

              if (this.dimensions == 'A5') {
                opis = '- A5 80gr | Quadri';
                if (this.qte == '25') { cena1=23.92;}
                if (this.qte == '50') { cena1=24.58;}
                if (this.qte == '100') { cena1=24.89;}
                if (this.qte == '250') { cena1=25.87 ;}
                if (this.qte == '500') { cena1=27.50;}
                if (this.qte == '1000') { cena1=30.76 ;}
                if (this.qte == '1250') { cena1=38.80;}
                if (this.qte == '2000') { cena1=39.80;}
                if (this.qte == '2500') { cena1=42.82;}
                if (this.qte == '5000') { cena1=59.13;}
                if (this.qte == '10000') { cena1=87.10;}
                if (this.qte == '15000') { cena1=108.44;}
                if (this.qte == '20000') { cena1=129.94;}
                if (this.qte == '25000') { cena1=159.91;}
                if (this.qte == '30000') { cena1=188.90;}
                if (this.qte == '35000') { cena1=218.88;}
                if (this.qte == '40000') { cena1=248.87;}
                if (this.qte == '45000') { cena1=278.85;}
                if (this.qte == '50000') { cena1=308.83;}
                if (this.qte == '75000') { cena1=487.76;}
                if (this.qte == '100000') { cena1=606.68;}
              }

              if (this.dimensions == 'A4') {
                opis = '- A4 80gr | Quadri';
                if (this.qte == '25') { cena1=26.34;}
                if (this.qte == '50') { cena1=26.01;}
                if (this.qte == '100') { cena1=27.33;}
                if (this.qte == '250') { cena1=30.42 ;}
                if (this.qte == '500') { cena1=32.58;}
                if (this.qte == '1000') { cena1=37.85 ;}
                if (this.qte == '1250') { cena1=49.54;}
                if (this.qte == '2000') { cena1=50.39;}
                if (this.qte == '2500') { cena1=55.34;}
                if (this.qte == '5000') { cena1=84.34;}
                if (this.qte == '10000') { cena1=135.11;}
                if (this.qte == '15000') { cena1=238.50;}
                if (this.qte == '20000') { cena1=310.16;}
                if (this.qte == '25000') { cena1=383.84;}
                if (this.qte == '30000') { cena1=457.91;}
                if (this.qte == '35000') { cena1=530.97;}
                if (this.qte == '40000') { cena1=604.74;}
                if (this.qte == '45000') { cena1=678.11;}
                if (this.qte == '50000') { cena1=751.68;}
                if (this.qte == '75000') { cena1=1153.03;}
                if (this.qte == '100000') { cena1=1420.00;}
              }

              if (this.dimensions == 'Din long') {
                opis = '- Din long 80gr | Quadri';
                if (this.qte == '25') { cena1=22.17;}
                if (this.qte == '50') { cena1=22.29;}
                if (this.qte == '100') { cena1=22.53;}
                if (this.qte == '250') { cena1=23.60;}
                if (this.qte == '500') { cena1=24.28;}
                if (this.qte == '1000') { cena1=27.42;}
                if (this.qte == '1250') { cena1=32.16;}
                if (this.qte == '2000') { cena1=32.80;}
                if (this.qte == '2500') { cena1=34.53;}
                if (this.qte == '5000') { cena1=46.65;}
                if (this.qte == '10000') { cena1=69.83;}
                if (this.qte == '15000') { cena1=89.90;}
                if (this.qte == '20000') { cena1=109.00;}
                if (this.qte == '25000') { cena1=132.00;}
                if (this.qte == '30000') { cena1=156.00;}
                if (this.qte == '35000') { cena1=179.00;}
                if (this.qte == '40000') { cena1=202.00;}
                if (this.qte == '45000') { cena1=225.09 ;}
                if (this.qte == '50000') { cena1=248.00 ;}
                if (this.qte == '75000') { cena1=385.00;}
                if (this.qte == '100000') { cena1=476.00 ;}
              }

              if (this.dimensions == 'A3') {
                opis = '- A3 80gr | Quadri';
                if (this.qte == '25') { cena1=39.92;}
                if (this.qte == '50') { cena1=32.34;}
                if (this.qte == '100') { cena1=38.26;}
                if (this.qte == '250') { cena1=51.56;}
                if (this.qte == '500') { cena1=54.33;}
                if (this.qte == '1000') { cena1=67.72 ;}
                if (this.qte == '1250') { cena1=96.91;}
                if (this.qte == '2000') { cena1=97.13;}
                if (this.qte == '2500') { cena1=110.81;}
                if (this.qte == '5000') { cena1=192.22;}
                if (this.qte == '10000') { cena1=350.75;}
                if (this.qte == '15000') { cena1=499.83;}
                if (this.qte == '20000') { cena1=656.38;}
                if (this.qte == '25000') { cena1=794.59;}
                if (this.qte == '30000') { cena1=933.81;}
                if (this.qte == '35000') { cena1=1058.04;}
                if (this.qte == '40000') { cena1=1184.26;}
                if (this.qte == '45000') { cena1=1309.48;}
                if (this.qte == '50000') { cena1=1434.70;}
                if (this.qte == '75000') { cena1=2211.80;}
                if (this.qte == '100000') { cena1=2729.90;}
              }

            } // fin 80g

            ////////////////////////////////////////////////////////////////135g
            if (this.support == '135g') {

              if (this.dimensions == 'A7'){
                opis = '- A7 135gr | Quadri';
                if (this.qte == '25') { cena1=14.16;}
                if (this.qte == '50') { cena1=14.89;}
                if (this.qte == '100') { cena1=15.65;}
                if (this.qte == '250') { cena1=16.38;}
                if (this.qte == '500') { cena1=17.14;}
                if (this.qte == '1000') { cena1=19.37 ;}
                if (this.qte == '1250') { cena1=19.82;}
                if (this.qte == '2000') { cena1=19.53;}
                if (this.qte == '2500') { cena1=19.41;}
                if (this.qte == '5000') { cena1=20.01;}
                if (this.qte == '10000') { cena1=26.88;}
                if (this.qte == '15000') { cena1=34.38;}
                if (this.qte == '20000') { cena1=42.53;}
                if (this.qte == '25000') { cena1=62.41;}
                if (this.qte == '30000') { cena1=69.60;}
                if (this.qte == '35000') { cena1=76.80;}
                if (this.qte == '40000') { cena1=83.99;}
                if (this.qte == '45000') { cena1=103.87;}
                if (this.qte == '50000') { cena1=111.06;}
                if (this.qte == '75000') { cena1=159.69;}
                if (this.qte == '100000') { cena1=208.34;}
              }

              if (this.dimensions == 'A6')  {
                opis = '- A6 135gr | Quadri';
                if (this.qte == '25') { cena1=16.24;}
                if (this.qte == '50') { cena1=17.09;}
                if (this.qte == '100') { cena1=17.94;}
                if (this.qte == '250') { cena1=18.79;}
                if (this.qte == '500') { cena1=19.66;}
                if (this.qte == '1000') { cena1=20.82;}
                if (this.qte == '1250') { cena1=24.58;}
                if (this.qte == '2000') { cena1=25.33;}
                if (this.qte == '2500') { cena1=25.79;}
                if (this.qte == '5000') { cena1=29.24;}
                if (this.qte == '10000') { cena1=43.62;}
                if (this.qte == '15000') { cena1=72.03;}
                if (this.qte == '20000') { cena1=89.12;}
                if (this.qte == '25000') { cena1=117.48;}
                if (this.qte == '30000') { cena1=132.54;}
                if (this.qte == '35000') { cena1=160.91;}
                if (this.qte == '40000') { cena1=175.96;}
                if (this.qte == '45000') { cena1=198.42;}
                if (this.qte == '50000') { cena1=219.39;}
                if (this.qte == '75000') { cena1=318.77;}
                if (this.qte == '100000') { cena1=423.63;}
              }

              if (this.dimensions == 'A5') {
                opis = '- A5 135gr | Quadri';
                if (this.qte == '25') { cena1=21.85;}
                if (this.qte == '50') { cena1=22.12;}
                if (this.qte == '100') { cena1=22.65;}
                if (this.qte == '250') { cena1=24.44 ;}
                if (this.qte == '500') { cena1=25.74;}
                if (this.qte == '1000') { cena1=30.13 ;}
                if (this.qte == '1250') { cena1=31.96;}
                if (this.qte == '2000') { cena1=34.70;}
                if (this.qte == '2500') { cena1=36.30;}
                if (this.qte == '5000') { cena1=45.18;}
                if (this.qte == '10000') { cena1=86.10;}
                if (this.qte == '15000') { cena1=129.44;}
                if (this.qte == '20000') { cena1=175.94;}
                if (this.qte == '25000') { cena1=212.91;}
                if (this.qte == '30000') { cena1=249.90;}
                if (this.qte == '35000') { cena1=296.88;}
                if (this.qte == '40000') { cena1=332.87;}
                if (this.qte == '45000') { cena1=368.85;}
                if (this.qte == '50000') { cena1=415.83;}
                if (this.qte == '75000') { cena1=606.76;}
                if (this.qte == '100000') { cena1=808.68;}
              }

              if (this.dimensions == 'A4') {
                opis = '- A4 135gr | Quadri';
                if (this.qte == '25') { cena1=25.34;}
                if (this.qte == '50') { cena1=26.01;}
                if (this.qte == '100') { cena1=27.33;}
                if (this.qte == '250') { cena1=31.42 ;}
                if (this.qte == '500') { cena1=36.58;}
                if (this.qte == '1000') { cena1=43.85 ;}
                if (this.qte == '1250') { cena1=47.54;}
                if (this.qte == '2000') { cena1=54.39;}
                if (this.qte == '2500') { cena1=58.34;}
                if (this.qte == '5000') { cena1=91.34;}
                if (this.qte == '10000') { cena1=174.11;}
                if (this.qte == '15000') { cena1=248.50;}
                if (this.qte == '20000') { cena1=338.16;}
                if (this.qte == '25000') { cena1=408.84;}
                if (this.qte == '30000') { cena1=479.91;}
                if (this.qte == '35000') { cena1=572.97;}
                if (this.qte == '40000') { cena1=640.74;}
                if (this.qte == '45000') { cena1=712.11;}
                if (this.qte == '50000') { cena1=805.68;}
                if (this.qte == '75000') { cena1=1179.03;}
                if (this.qte == '100000') { cena1=1573.87;}
              }

              if (this.dimensions == 'Din long') {
                opis = '- Din long 135gr | Quadri';
                if (this.qte == '25') { cena1=20.01;}
                if (this.qte == '50') { cena1=20.17;}
                if (this.qte == '100') { cena1=20.47;}
                if (this.qte == '250') { cena1=21.56;}
                if (this.qte == '500') { cena1=21.78;}
                if (this.qte == '1000') { cena1=25.19;}
                if (this.qte == '1250') { cena1=26.45;}
                if (this.qte == '2000') { cena1=27.97;}
                if (this.qte == '2500') { cena1=28.87;}
                if (this.qte == '5000') { cena1=34.35;}
                if (this.qte == '10000') { cena1=65.79;}
                if (this.qte == '15000') { cena1=96.96;}
                if (this.qte == '20000') { cena1=122.10;}
                if (this.qte == '25000') { cena1=155.04;}
                if (this.qte == '30000') { cena1=179.93;}
                if (this.qte == '35000') { cena1=208.22;}
                if (this.qte == '40000') { cena1=241.16;}
                if (this.qte == '45000') { cena1=263.89 ;}
                if (this.qte == '50000') { cena1=295.88 ;}
                if (this.qte == '75000') { cena1=430.83;}
                if (this.qte == '100000') { cena1=572.77;}
              }

              if (this.dimensions == 'A3') {
                opis = '- A3 135gr | Quadri';
                if (this.qte == '25') { cena1=30.92;}
                if (this.qte == '50') { cena1=32.34;}
                if (this.qte == '100') { cena1=35.13;}
                if (this.qte == '250') { cena1=43.56;}
                if (this.qte == '500') { cena1=54.33;}
                if (this.qte == '1000') { cena1=68.72 ;}
                if (this.qte == '1250') { cena1=75.91;}
                if (this.qte == '2000') { cena1=106.13;}
                if (this.qte == '2500') { cena1=113.81;}
                if (this.qte == '5000') { cena1=178.22;}
                if (this.qte == '10000') { cena1=339.75;}
                if (this.qte == '15000') { cena1=510.83;}
                if (this.qte == '20000') { cena1=694.38;}
                if (this.qte == '25000') { cena1=863.59;}
                if (this.qte == '30000') { cena1=1032.81;}
                if (this.qte == '35000') { cena1=1202.04;}
                if (this.qte == '40000') { cena1=1371.26;}
                if (this.qte == '45000') { cena1=1540.48;}
                if (this.qte == '50000') { cena1=1709.70;}
                if (this.qte == '75000') { cena1=2555.80;}
                if (this.qte == '100000') { cena1=3401.90;}
              }

            } // fin 135g

            ////////////////////////////////////////////////////////////////170g
            if (this.support == '170g') {
              if (this.dimensions == 'A7'){
                opis = '- A7 170gr | Quadri';
                if (this.qte == '25') { cena1=15.08;}
                if (this.qte == '50') { cena1=15.86;}
                if (this.qte == '100') { cena1=16.66;}
                if (this.qte == '250') { cena1=17.45;}
                if (this.qte == '500') { cena1=18.25;}
                if (this.qte == '1000') { cena1=20.63 ;}
                if (this.qte == '1250') { cena1=21.20;}
                if (this.qte == '2000') { cena1=21.17;}
                if (this.qte == '2500') { cena1=21.18;}
                if (this.qte == '5000') { cena1=22.48;}
                if (this.qte == '10000') { cena1=31.24;}
                if (this.qte == '15000') { cena1=40.77;}
                if (this.qte == '20000') { cena1=64.27;}
                if (this.qte == '25000') { cena1=73.45 ;}
                if (this.qte == '30000') { cena1=82.63;}
                if (this.qte == '35000') { cena1=104.99;}
                if (this.qte == '40000') { cena1=114.17 ;}
                if (this.qte == '45000') { cena1=123.35;}
                if (this.qte == '50000') { cena1=145.71;}
                if (this.qte == '75000') { cena1=204.79;}
                if (this.qte == '100000') { cena1=271.24;}
              }

              if (this.dimensions == 'A6') {
                opis = '- A6 170gr | Quadri';
                if (this.qte == '25') { cena1=17.56;}
                if (this.qte == '50') { cena1=18.49;}
                if (this.qte == '100') { cena1=19.41;}
                if (this.qte == '250') { cena1=20.34;}
                if (this.qte == '500') { cena1=21.26;}
                if (this.qte == '1000') { cena1=25.65;}
                if (this.qte == '1250') { cena1=26.85;}
                if (this.qte == '2000') { cena1=28.15;}
                if (this.qte == '2500') { cena1=28.94;}
                if (this.qte == '5000') { cena1=33.93;}
                if (this.qte == '10000') { cena1=59.98;}
                if (this.qte == '15000') { cena1=85.43;}
                if (this.qte == '20000') { cena1=114.95;}
                if (this.qte == '25000') { cena1=140.94;}
                if (this.qte == '30000') { cena1=164.93;}
                if (this.qte == '35000') { cena1=192.72;}
                if (this.qte == '40000') { cena1=218.51;}
                if (this.qte == '45000') { cena1=238.11;}
                if (this.qte == '50000') { cena1=263.89;}
                if (this.qte == '75000') { cena1=382.55;}
                if (this.qte == '100000') { cena1=508.40;}
              }

              if (this.dimensions == 'A5') {
                opis = '- A5 170gr | Quadri';
                if (this.qte == '25') { cena1=22.77;}
                if (this.qte == '50') { cena1=23.10;}
                if (this.qte == '100') { cena1=23.75;}
                if (this.qte == '250') { cena1=25.88 ;}
                if (this.qte == '500') { cena1=27.48;}
                if (this.qte == '1000') { cena1=33.45 ;}
                if (this.qte == '1250') { cena1=35.78;}
                if (this.qte == '2000') { cena1=39.68;}
                if (this.qte == '2500') { cena1=41.93;}
                if (this.qte == '5000') { cena1=67.10;}
                if (this.qte == '10000') { cena1=111.96;}
                if (this.qte == '15000') { cena1=157.94;}
                if (this.qte == '20000') { cena1=210.92;}
                if (this.qte == '25000') { cena1=260.90;}
                if (this.qte == '30000') { cena1=306.88;}
                if (this.qte == '35000') { cena1=361.86;}
                if (this.qte == '40000') { cena1=407.84;}
                if (this.qte == '45000') { cena1=453.82;}
                if (this.qte == '50000') { cena1=512.79;}
                if (this.qte == '75000') { cena1=755.70;}
                if (this.qte == '100000') { cena1=1004.60;}
              }

              if (this.dimensions == 'A4') {
                opis = '- A4 170gr | Quadri';
                if (this.qte == '25') { cena1=26.50;}
                if (this.qte == '50') { cena1=27.30;}
                if (this.qte == '100') { cena1=28.84;}
                if (this.qte == '250') { cena1=33.63 ;}
                if (this.qte == '500') { cena1=40.51;}
                if (this.qte == '1000') { cena1=49.90 ;}
                if (this.qte == '1250') { cena1=54.61;}
                if (this.qte == '2000') { cena1=63.83;}
                if (this.qte == '2500') { cena1=84.86;}
                if (this.qte == '5000') { cena1=122.40;}
                if (this.qte == '10000') { cena1=209.92;}
                if (this.qte == '15000') { cena1=306.88;}
                if (this.qte == '20000') { cena1=406.84;}
                if (this.qte == '25000') { cena1=503.80;}
                if (this.qte == '30000') { cena1=592.76;}
                if (this.qte == '35000') { cena1=701.72;}
                if (this.qte == '40000') { cena1=787.68;}
                if (this.qte == '45000') { cena1=882.65;}
                if (this.qte == '50000') { cena1=1002.60;}
                if (this.qte == '75000') { cena1=1482.41;}
                if (this.qte == '100000') { cena1=1972.21;}
              }

              if (this.dimensions == 'Din long') {
                opis = '- Din long 170gr | Quadri';
                if (this.qte == '25') { cena1=20.84;}
                if (this.qte == '50') { cena1=21.03;}
                if (this.qte == '100') { cena1=21.40;}
                if (this.qte == '250') { cena1=22.73;}
                if (this.qte == '500') { cena1=23.13;}
                if (this.qte == '1000') { cena1=27.64;}
                if (this.qte == '1250') { cena1=29.23;}
                if (this.qte == '2000') { cena1=31.53;}
                if (this.qte == '2500') { cena1=32.87;}
                if (this.qte == '5000') { cena1=40.46;}
                if (this.qte == '10000') { cena1=77.72;}
                if (this.qte == '15000') { cena1=117.16;}
                if (this.qte == '20000') { cena1=151.94;}
                if (this.qte == '25000') { cena1=186.93;}
                if (this.qte == '30000') { cena1=218.91;}
                if (this.qte == '35000') { cena1=257.90;}
                if (this.qte == '40000') { cena1=290.88;}
                if (this.qte == '45000') { cena1=321.87 ;}
                if (this.qte == '50000') { cena1=356.86 ;}
                if (this.qte == '75000') { cena1=528.79;}
                if (this.qte == '100000') { cena1=703.72 ;}
              }

              if (this.dimensions == 'A3') {
                opis = '- A3 170gr | Quadri';
                if (this.qte == '25') { cena1=32.48;}
                if (this.qte == '50') { cena1=34.14;}
                if (this.qte == '100') { cena1=37.39;}
                if (this.qte == '250') { cena1=47.23;}
                if (this.qte == '500') { cena1=61.35;}
                if (this.qte == '1000') { cena1=79.86;}
                if (this.qte == '1250') { cena1=106.60;}
                if (this.qte == '2000') { cena1=124.52;}
                if (this.qte == '2500') { cena1=150.29;}
                if (this.qte == '5000') { cena1=225.75;}
                if (this.qte == '10000') { cena1=433.06;}
                if (this.qte == '15000') { cena1=652.57;}
                if (this.qte == '20000') { cena1=888.05;}
                if (this.qte == '25000') { cena1=1105.24;}
                if (this.qte == '30000') { cena1=1322.42;}
                if (this.qte == '35000') { cena1=1539.61;}
                if (this.qte == '40000') { cena1=1756.80;}
                if (this.qte == '45000') { cena1=1973.99;}
                if (this.qte == '50000') { cena1=2191.17;}
                if (this.qte == '75000') { cena1=3277.11;}
                if (this.qte == '100000') { cena1=4363.03;}
              }
            } // fin 170g

            ////////////////////////////////////////////////////////////////250g
            if (this.support == '250g') {

              if (this.dimensions == 'A7') {
                opis = '- A7 250gr | Quadri';
                if (this.qte == '25') { cena1=16.22;}
                if (this.qte == '50') { cena1=17.06;}
                if (this.qte == '100') { cena1=17.92;}
                if (this.qte == '250') { cena1=18.77;}
                if (this.qte == '500') { cena1=19.62;}
                if (this.qte == '1000') { cena1=21.96;}
                if (this.qte == '1250') { cena1=22.79;}
                if (this.qte == '2000') { cena1=23.37;}
                if (this.qte == '2500') { cena1=23.74;}
                if (this.qte == '5000') { cena1=26.67;}
                if (this.qte == '10000') { cena1=39.42;}
                if (this.qte == '15000') { cena1=65.99;}
                if (this.qte == '20000') { cena1=81.20;}
                if (this.qte == '25000') { cena1=107.74;}
                if (this.qte == '30000') { cena1=116.85;}
                if (this.qte == '35000') { cena1=139.94;}
                if (this.qte == '40000') { cena1=153.23 ;}
                if (this.qte == '45000') { cena1=178.93;}
                if (this.qte == '50000') { cena1=189.82;}
                if (this.qte == '75000') { cena1=274.89;}
                if (this.qte == '100000') { cena1=350.86;}
              }

              if (this.dimensions == 'A6') {
                opis = '- A6 250gr | Quadri';
                if (this.qte == '25') { cena1=19.62;}
                if (this.qte == '50') { cena1=20.66;}
                if (this.qte == '100') { cena1=21.76;}
                if (this.qte == '250') { cena1=22.93;}
                if (this.qte == '500') { cena1=23.75;}
                if (this.qte == '1000') { cena1=28.44;}
                if (this.qte == '1250') { cena1=30.17;}
                if (this.qte == '2000') { cena1=30.57;}
                if (this.qte == '2500') { cena1=30.95;}
                if (this.qte == '5000') { cena1=32.69;}
                if (this.qte == '10000') { cena1=63.97;}
                if (this.qte == '15000') { cena1=100.26;}
                if (this.qte == '20000') { cena1=136.45;}
                if (this.qte == '25000') { cena1=172.73;}
                if (this.qte == '30000') { cena1=208.92;}
                if (this.qte == '35000') { cena1=245.20;}
                if (this.qte == '40000') { cena1=281.39;}
                if (this.qte == '45000') { cena1=317.67;}
                if (this.qte == '50000') { cena1=353.86;}
                if (this.qte == '75000') { cena1=509.30;}
                if (this.qte == '100000') { cena1=664.73;}
              }

              if (this.dimensions == 'A5') {
                opis = '- A5 250gr | Quadri';
                if (this.qte == '25') { cena1=23.02;}
                if (this.qte == '50') { cena1=23.47;}
                if (this.qte == '100') { cena1=24.34;}
                if (this.qte == '250') { cena1=27.12;}
                if (this.qte == '500') { cena1=29.59;}
                if (this.qte == '1000') { cena1=38.90;}
                if (this.qte == '1250') { cena1=42.30;}
                if (this.qte == '2000') { cena1=48.74;}
                if (this.qte == '2500') { cena1=52.45;}
                if (this.qte == '5000') { cena1=80.97;}
                if (this.qte == '10000') { cena1=144.94;}
                if (this.qte == '15000') { cena1=207.92;}
                if (this.qte == '20000') { cena1=271.89;}
                if (this.qte == '25000') { cena1=342.86;}
                if (this.qte == '30000') { cena1=406.84;}
                if (this.qte == '35000') { cena1=477.81;}
                if (this.qte == '40000') { cena1=539.78;}
                if (this.qte == '45000') { cena1=609.76;}
                if (this.qte == '50000') { cena1=672.73;}
                if (this.qte == '75000') { cena1=992.60;}
                if (this.qte == '100000') { cena1=1313.47;}
              }

              if (this.dimensions == 'A4') {
                opis = '- A4 250gr | Quadri';
                if (this.qte == '25') { cena1=27.01;}
                if (this.qte == '50') { cena1=28.03;}
                if (this.qte == '100') { cena1=30.03;}
                if (this.qte == '250') { cena1=36.15;}
                if (this.qte == '500') { cena1=45.72;}
                if (this.qte == '1000') { cena1=60.89;}
                if (this.qte == '1250') { cena1=67.76;}
                if (this.qte == '2000') { cena1=98.59;}
                if (this.qte == '2500') { cena1=106.06;}
                if (this.qte == '5000') { cena1=158.94;}
                if (this.qte == '10000') { cena1=275.89;}
                if (this.qte == '15000') { cena1=412.13;}
                if (this.qte == '20000') { cena1=535.79;}
                if (this.qte == '25000') { cena1=673.93;}
                if (this.qte == '30000') { cena1=794.68;}
                if (this.qte == '35000') { cena1=935.73;}
                if (this.qte == '40000') { cena1=1052.58;}
                if (this.qte == '45000') { cena1=1186.82;}
                if (this.qte == '50000') { cena1=1306.08;}
                if (this.qte == '75000') { cena1=1941.12;}
                if (this.qte == '100000') { cena1=2577.26;}
              }

              if (this.dimensions == 'Din long') {
                opis = '- Din long 250gr | Quadri';
                if (this.qte == '25') { cena1=21.01;}
                if (this.qte == '50') { cena1=21.29;}
                if (this.qte == '100') { cena1=21.81;}
                if (this.qte == '250') { cena1=23.58;}
                if (this.qte == '500') { cena1=24.64;}
                if (this.qte == '1000') { cena1=31.38;}
                if (this.qte == '1250') { cena1=33.70;}
                if (this.qte == '2000') { cena1=37.73;}
                if (this.qte == '2500') { cena1=40.07;}
                if (this.qte == '5000') { cena1=60.98;}
                if (this.qte == '10000') { cena1=99.96;}
                if (this.qte == '15000') { cena1=145.94;}
                if (this.qte == '20000') { cena1=191.92;}
                if (this.qte == '25000') { cena1=235.91;}
                if (this.qte == '30000') { cena1=279.89;}
                if (this.qte == '35000') { cena1=321.87;}
                if (this.qte == '40000') { cena1=365.85;}
                if (this.qte == '45000') { cena1=412.83;}
                if (this.qte == '50000') { cena1=456.82 ;}
                if (this.qte == '75000') { cena1=664.73;}
                if (this.qte == '100000') { cena1=874.65 ;}
              }

              if (this.dimensions == 'A3') {
                opis = '- A3 250gr | Quadri';
                if (this.qte == '25') { cena1=33.48;}
                if (this.qte == '50') { cena1=35.59;}
                if (this.qte == '100') { cena1=39.72;}
                if (this.qte == '250') { cena1=52.11;}
                if (this.qte == '500') { cena1=71.47;}
                if (this.qte == '1000') { cena1=118.83;}
                if (this.qte == '1250') { cena1=132.18;}
                if (this.qte == '2000') { cena1=176.27;}
                if (this.qte == '2500') { cena1=201.97;}
                if (this.qte == '5000') { cena1=332.88;}
                if (this.qte == '10000') { cena1=563.77;}
                if (this.qte == '15000') { cena1=827.67;}
                if (this.qte == '20000') { cena1=1091.56;}
                if (this.qte == '25000') { cena1=1354.46;}
                if (this.qte == '30000') { cena1=1618.35;}
                if (this.qte == '35000') { cena1=1881.25;}
                if (this.qte == '40000') { cena1=2144.14;}
                if (this.qte == '45000') { cena1=2385.05;}
                if (this.qte == '50000') { cena1=2625.95;}
                if (this.qte == '75000') { cena1=3902.44;}
                if (this.qte == '100000') { cena1=5170.93;}
              }
            } // fin 250g

            ////////////////////////////////////////////////////////////////350g
            if (this.support == '350g') {
              if (this.dimensions == 'A7'){
                opis = '- A7 350gr | Quadri';
                if (this.qte == '25') { cena1=20.13;}
                if (this.qte == '50') { cena1=25.29;}
                if (this.qte == '100') { cena1=30.56;}
                if (this.qte == '250') { cena1=35.42;}
                if (this.qte == '500') { cena1=40.87;}
                if (this.qte == '1000') { cena1=57.72;}
                if (this.qte == '1250') { cena1=63.69;}
                if (this.qte == '2000') { cena1=63.69;}
                if (this.qte == '2500') { cena1=66.68;}
                if (this.qte == '5000') { cena1=80.97;}
                if (this.qte == '10000') { cena1=111.63;}
                if (this.qte == '15000') { cena1=126.86;}
                if (this.qte == '20000') { cena1=142.00;}
                if (this.qte == '25000') { cena1=169.00;}
                if (this.qte == '30000') { cena1=193.93;}
                if (this.qte == '35000') { cena1=222.85;}
                if (this.qte == '40000') { cena1=249.00 ;}
                if (this.qte == '45000') { cena1=276.00;}
                if (this.qte == '50000') { cena1=303.00;}
                if (this.qte == '75000') { cena1=454.00;}
                if (this.qte == '100000') { cena1=554.00;}
              }

              if (this.dimensions == 'A6')  {
                opis = '- A6 350gr | Quadri';
                if (this.qte == '25') { cena1=25.35;}
                if (this.qte == '50') { cena1=30.56;}
                if (this.qte == '100') { cena1=35.97;}
                if (this.qte == '250') { cena1=37.23;}
                if (this.qte == '500') { cena1=39.32;}
                if (this.qte == '1000') { cena1=43.53;}
                if (this.qte == '1250') { cena1=45.74;}
                if (this.qte == '2000') { cena1=45.74;}
                if (this.qte == '2500') { cena1=46.65;}
                if (this.qte == '5000') { cena1=49.38;}
                if (this.qte == '10000') { cena1=103.25;}
                if (this.qte == '15000') { cena1=141.42;}
                if (this.qte == '20000') { cena1=179.59;}
                if (this.qte == '25000') { cena1=219.00;}
                if (this.qte == '30000') { cena1=258.00;}
                if (this.qte == '35000') { cena1=298.00;}
                if (this.qte == '40000') { cena1=338.00;}
                if (this.qte == '45000') { cena1=378.00;}
                if (this.qte == '50000') { cena1=417.00;}
                if (this.qte == '75000') { cena1=670.00;}
                if (this.qte == '100000') { cena1=838.00;}
              }

              if (this.dimensions == 'A5') {
                opis = '- A5 350gr | Quadri';
                if (this.qte == '25') { cena1=30.18;}
                if (this.qte == '50') { cena1=35.38;}
                if (this.qte == '100') { cena1=40.39;}
                if (this.qte == '250') { cena1=48.43;}
                if (this.qte == '500') { cena1=53.50;}
                if (this.qte == '1000') { cena1=63.86;}
                if (this.qte == '1250') { cena1=86.00;}
                if (this.qte == '2000') { cena1=87.00;}
                if (this.qte == '2500') { cena1=97.00;}
                if (this.qte == '5000') { cena1=133.00;}
                if (this.qte == '10000') { cena1=229.00;}
                if (this.qte == '15000') { cena1=304.00;}
                if (this.qte == '20000') { cena1=380.00;}
                if (this.qte == '25000') { cena1=478.00;}
                if (this.qte == '30000') { cena1=575.00;}
                if (this.qte == '35000') { cena1=673.00;}
                if (this.qte == '40000') { cena1=771.00;}
                if (this.qte == '45000') { cena1=868.00;}
                if (this.qte == '50000') { cena1=966.00;}
                if (this.qte == '75000') { cena1=1549.00;}
                if (this.qte == '100000') { cena1=1937.00;}
              }

              if (this.dimensions == 'A4') {
                opis = '- A4 350gr | Quadri';
                if (this.qte == '25') { cena1=35.00;}
                if (this.qte == '50') { cena1=40.00;}
                if (this.qte == '100') { cena1=45.00;}
                if (this.qte == '250') { cena1=53.00;}
                if (this.qte == '500') { cena1=61.00;}
                if (this.qte == '1000') { cena1=84.00;}
                if (this.qte == '1250') { cena1=127.00;}
                if (this.qte == '2000') { cena1=128.00;}
                if (this.qte == '2500') { cena1=147.00;}
                if (this.qte == '5000') { cena1=263.00;}
                if (this.qte == '10000') { cena1=424.00;}
                if (this.qte == '15000') { cena1=564.00;}
                if (this.qte == '20000') { cena1=704.00;}
                if (this.qte == '25000') { cena1=887.00;}
                if (this.qte == '30000') { cena1=1070.00;}
                if (this.qte == '35000') { cena1=1254.00;}
                if (this.qte == '40000') { cena1=1436.00;}
                if (this.qte == '45000') { cena1=1620.00;}
                if (this.qte == '50000') { cena1=1800.00;}
                if (this.qte == '75000') { cena1=2766.00;}
                if (this.qte == '100000') { cena1=3408.00;}
              }

              if (this.dimensions == 'Din long') {
                opis = '- Din long 350gr | Quadri';
                if (this.qte == '25') { cena1=34.00;}
                if (this.qte == '50') { cena1=38.22;}
                if (this.qte == '100') { cena1=40.95;}
                if (this.qte == '250') { cena1=44.20;}
                if (this.qte == '500') { cena1=46.29;}
                if (this.qte == '1000') { cena1=55.80;}
                if (this.qte == '1250') { cena1=70.24;}
                if (this.qte == '2000') { cena1=71.24;}
                if (this.qte == '2500') { cena1=77.46;}
                if (this.qte == '5000') { cena1=114.00;}
                if (this.qte == '10000') { cena1=184.00;}
                if (this.qte == '15000') { cena1=245.00;}
                if (this.qte == '20000') { cena1=307.00;}
                if (this.qte == '25000') { cena1=377.00;}
                if (this.qte == '30000') { cena1=447.00;}
                if (this.qte == '35000') { cena1=517.00;}
                if (this.qte == '40000') { cena1=587.00;}
                if (this.qte == '45000') { cena1=657.00;}
                if (this.qte == '50000') { cena1=726.00 ;}
                if (this.qte == '75000') { cena1=1144.00;}
                if (this.qte == '100000') { cena1=1422.00 ;}
              }

              if (this.dimensions == 'A3') {
                opis = '- A3 350gr | Quadri';
                if (this.qte == '25') { cena1=54.00;}
                if (this.qte == '50') { cena1=66.00;}
                if (this.qte == '100') { cena1=77.00;}
                if (this.qte == '250') { cena1=102.00;}
                if (this.qte == '500') { cena1=107.00;}
                if (this.qte == '1000') { cena1=169.00;}
                if (this.qte == '1250') { cena1=325.00;}
                if (this.qte == '2000') { cena1=330.00;}
                if (this.qte == '2500') { cena1=400.00;}
                if (this.qte == '5000') { cena1=332.88;}
                if (this.qte == '10000') { cena1=751.00;}
                if (this.qte == '15000') { cena1=1263.00;}
                if (this.qte == '20000') { cena1=2000.00;}
                if (this.qte == '25000') { cena1=2541.00;}
                if (this.qte == '30000') { cena1=3590.00;}
                if (this.qte == '35000') { cena1=4099.00;}
                if (this.qte == '40000') { cena1=4600.00;}
                if (this.qte == '45000') { cena1=5117.00;}
                if (this.qte == '50000') { cena1=5626.00;}
                if (this.qte == '75000') { cena1=8631.44;}
                if (this.qte == '100000') { cena1=10635.93;}
              }
            } // fin 350g

            //---------------------------------------------------------- PRIX FB

            if (this.support == '80g')  pgr = 0.04;
            if (this.support == '135g') pgr = 0.07;
            if (this.support == '170g') pgr = 0.08;
            if (this.support == '250g') pgr = 0.13;
            if (this.support == '350g') pgr = 0.18;

            if (this.dimensions == 'A7')       {cenaFB = (this.qte/16)*pgr; clic = (this.qte/16)*0.05;}
            if (this.dimensions == 'A6')       {cenaFB = (this.qte/8 )*pgr; clic = (this.qte/8)*0.05; }
            if (this.dimensions == 'A5')       {cenaFB = (this.qte/4 )*pgr; clic = (this.qte/4)*0.05; }
            if (this.dimensions == 'A4')       {cenaFB = (this.qte/2 )*pgr; clic = (this.qte/2)*0.05; }
            if (this.dimensions == 'A3')       {cenaFB = (this.qte/1 )*pgr; clic = (this.qte/1)*0.05; }
            if (this.dimensions == 'Din long') {cenaFB = (this.qte/6 )*pgr; clic = (this.qte/6)*0.05; }

            if (this.choixPrint == 'Recto')       {cenaFBfinal = cenaFB+clic;}
            if (this.choixPrint == 'Recto verso') {cenaFBfinal = cenaFB+(clic*2);}


            //------------------------------------------------------------ poids
            if (this.support == '350g') gr = 0.35;
            if (this.support == '250g') gr = 0.25;
            if (this.support == '170g') gr = 0.17;
            if (this.support == '135g') gr = 0.135;
            if (this.support == '80g')  gr = 0.08;

            if (this.dimensions == 'A7')       p1 = (this.qte/16)*gr*0.112;
            if (this.dimensions == 'A6')       p1 = (this.qte/8 )*gr*0.124;
            if (this.dimensions == 'A5')       p1 = (this.qte/4 )*gr*0.151;
            if (this.dimensions == 'A4')       p1 = (this.qte/2 )*gr*0.124;
            if (this.dimensions == 'A3')       p1 = (this.qte/1 )*gr*0.121;
            if (this.dimensions == 'Din long') p1 = (this.qte/6 )*gr*0.132;

            if (p1 <= 1)      p2 = 7;
            if (1 < p1 <= 4)  p2 = 9;
            if (4 < p1 <= 8)  p2 = 11;
            if (8 < p1 <= 12) p2 = 12;
            if (12 < p1)      p2 = 15;

            //------------------------------------------------------ prix  final
            if (cenaFBfinal < cena1) cena = (cenaFBfinal*1.8)+p2;
            if (cenaFBfinal > cena1) cena = (cena1*1.8)+7.00;

            //------------------------------------------------------ recto verso

            if (this.choixPrint == 'Recto verso' ) cena *= 1.2;

          //--------------------------------------------------------------------
          //             fin supports Flyers 80g || 135g || 170g || 250g || 350g
          } else { ///////////////////////////////////////////// AUTRES SUPPORTS

            if (this.support == '120µ' && this.choixPrint == 'Recto verso') pgr = 2.42;
            if (this.support == '120µ' && this.choixPrint == 'Recto')       pgr = 2.38;

            if (this.support == '270µ' && this.choixPrint == 'Recto verso') pgr = 3.85;
            if (this.support == '270µ' && this.choixPrint == 'Recto')       pgr = 3.38;

            if (this.support == '350µ' && this.choixPrint == 'Recto verso') pgr = 4.78;
            if (this.support == '350µ' && this.choixPrint == 'Recto')       pgr = 4.73;

            if (this.dimensions == 'A7')       cena1 = (this.qte/16)*pgr;
            if (this.dimensions == 'A6')       cena1 = (this.qte/8 )*pgr;
            if (this.dimensions == 'A5')       cena1 = (this.qte/4 )*pgr;
            if (this.dimensions == 'A4')       cena1 = (this.qte/2 )*pgr;
            if (this.dimensions == 'A3')       cena1 = (this.qte/1 )*pgr;
            if (this.dimensions == 'Din long') cena1 = (this.qte/6 )*pgr;

            if (this.qte == '25'    || this.qte == '50'   || this.qte == '100'  || this.qte == '250')  cena1 *= 1.15;
            if (this.qte == '500'   || this.qte == '1000' || this.qte == '1250' || this.qte == '2000') cena1 *= 1;
            if (this.qte == '5000'  || this.qte == '7500' || this.qte == '10000')                      cena1 *= 0.95;
            if (this.qte == '15000' || this.qte == '20000')                                            cena1 *= 0.90;
            if (this.qte == '25000' || this.qte == '30000')                                            cena1 *= 0.85;
            if (this.qte == '40000' || this.qte == '50000')                                            cena1 *= 0.80;
            if (this.qte == '75000' || this.qte == '100000')                                           cena1 *= 0.75;

            cena = cena1;
          }

          //--------------------------------------------------------- dimensions
          var petit = '';
          var grand = '';

          // -------------------------------------------------------------------
          if (this.dimensions == 'Din long') {
            petit = 10.5;
            grand = 21;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A3') {
            petit = 29.7;
            grand = 42;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A4') {
            petit = 21;
            grand = 29.7;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A5') {
            petit = 14.8;
            grand = 21;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A6') {
            petit = 10.5;
            grand = 14.8;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A7') {
            petit = 7.4;
            grand = 10.5;
          }

          // disposition -------------------------------------------------------
          this.hauteur = grand;
          this.largeur = petit;

          if (this.choixForm == 'paysage')  {
            this.hauteur = petit;
            this.largeur = grand;
          }

        } // fin flyers


        ////////////////////////////////////////////////////////////// DEPLIANTS

        if (this.produit == 'Depliants') {
          //-----------------------------------------------------------------80g
          if (this.support == '80g') {

            if (this.dimensions == 'A5'){
              opis = '- A5 ouvert -> A6 fermé <br>- 80gr | Quadri';
              if (this.qte == '25') { cena=33.18;}
              if (this.qte == '50') { cena=33.18;}
              if (this.qte == '100') { cena=33.18;}
              if (this.qte == '250') { cena=33.18;}
              if (this.qte == '500') { cena=32.77;}
              if (this.qte == '1000') { cena=33.78;}
              if (this.qte == '1250') { cena=45.93;}
              if (this.qte == '2000') { cena=51.15;}
              if (this.qte == '2500') { cena=54.42;}
              if (this.qte == '5000') { cena=70.81;}
              if (this.qte == '10000') { cena=112.05;}
              if (this.qte == '15000') { cena=154.19;}
              if (this.qte == '20000') { cena=202.87;}
              if (this.qte == '25000') { cena=245.02;}
              if (this.qte == '30000') { cena=287.17;}
              if (this.qte == '35000') { cena=341.35;}
              if (this.qte == '40000') { cena=388.19;}
              if (this.qte == '45000') { cena=420.15;}
              if (this.qte == '50000') { cena=474.33;}
              if (this.qte == '75000') { cena=685.19;}
              if (this.qte == '100000') { cena=913.57;}
            }

            if (this.dimensions == 'A4') {
              opis = '- A4 ouvert -> A5 fermé <br>- 80gr | Quadri';
              if (this.qte == '25') { cena=40.94;}
              if (this.qte == '50') { cena=40.94;}
              if (this.qte == '100') { cena=40.94;}
              if (this.qte == '250') { cena=40.94;}
              if (this.qte == '500') { cena=43.73;}
              if (this.qte == '1000') { cena=49.13;}
              if (this.qte == '1250') { cena=62.32;}
              if (this.qte == '2000') { cena=70.48;}
              if (this.qte == '2500') { cena=75.80;}
              if (this.qte == '5000') { cena=113.88;}
              if (this.qte == '10000') { cena=179.61;}
              if (this.qte == '15000') { cena=252.80;}
              if (this.qte == '20000') { cena=337.44;}
              if (this.qte == '25000') { cena=414.97;}
              if (this.qte == '30000') { cena=504.88;}
              if (this.qte == '35000') { cena=591.20;}
              if (this.qte == '40000') { cena=664.22;}
              if (this.qte == '45000') { cena=714.22;}
              if (this.qte == '50000') { cena=810.55;}
              if (this.qte == '75000') { cena=1180.23;}
              if (this.qte == '100000') { cena=1573.98;}
            }

            if (this.dimensions == 'A4 3 volets') {
              opis = '- A4 ouvert -> 3 volets 10x21cm fermé <br>- 80gr | Quadri';
              if (this.qte == '25') { cena=43.14;}
              if (this.qte == '50') { cena=43.14;}
              if (this.qte == '100') { cena=43.14;}
              if (this.qte == '250') { cena=43.14;}
              if (this.qte == '500') { cena=45.59;}
              if (this.qte == '1000') { cena=49.13;}
              if (this.qte == '1250') { cena=62.32;}
              if (this.qte == '2000') { cena=70.48;}
              if (this.qte == '2500') { cena=75.80;}
              if (this.qte == '5000') { cena=113.88;}
              if (this.qte == '10000') { cena=179.61;}
              if (this.qte == '15000') { cena=252.80;}
              if (this.qte == '20000') { cena=337.44;}
              if (this.qte == '25000') { cena=414.97;}
              if (this.qte == '30000') { cena=504.88;}
              if (this.qte == '35000') { cena=591.20;}
              if (this.qte == '40000') { cena=664.22;}
              if (this.qte == '45000') { cena=714.22;}
              if (this.qte == '50000') { cena=810.55;}
              if (this.qte == '75000') { cena=1180.23;}
              if (this.qte == '100000') { cena=1573.98;}
            }

            if (this.dimensions == 'Din long') {
              opis = '- 21x21cm ouvert -> 10,5x21cm fermé <br>- 80gr | Quadri';
              if (this.qte == '25') { cena=34.02;}
              if (this.qte == '50') { cena=34.02;}
              if (this.qte == '100') { cena=34.02;}
              if (this.qte == '250') { cena=34.02;}
              if (this.qte == '500') { cena=34.84;}
              if (this.qte == '1000') { cena=36.28;}
              if (this.qte == '1250') { cena=45.49;}
              if (this.qte == '2000') { cena=51.37;}
              if (this.qte == '2500') { cena=55.11;}
              if (this.qte == '5000') { cena=74.77;}
              if (this.qte == '10000') { cena=127.52;}
              if (this.qte == '15000') { cena=180.26;}
              if (this.qte == '20000') { cena=233.02;}
              if (this.qte == '25000') { cena=298.10;}
              if (this.qte == '30000') { cena=356.00;}
              if (this.qte == '35000') { cena=414.80;}
              if (this.qte == '40000') { cena=470.70;}
              if (this.qte == '45000') { cena=526.59;}
              if (this.qte == '50000') { cena=582.48 ;}
              if (this.qte == '75000') { cena=861.95;}
              if (this.qte == '100000') { cena=1141.41 ;}
            }

            if (this.dimensions == 'A3') {
              opis = '- A3 ouvert -> A4 fermé<br>- 80gr | Quadri';
              if (this.qte == '25') { cena=56.67;}
              if (this.qte == '50') { cena=56.67;}
              if (this.qte == '100') { cena=56.67;}
              if (this.qte == '250') { cena=56.67;}
              if (this.qte == '500') { cena=65.55;}
              if (this.qte == '1000') { cena=75.16;}
              if (this.qte == '1250') { cena=101.62;}
              if (this.qte == '2000') { cena=130.87;}
              if (this.qte == '2500') { cena=125.15;}
              if (this.qte == '5000') { cena=182.11;}
              if (this.qte == '10000') { cena=302.75;}
              if (this.qte == '15000') { cena=423.38;}
              if (this.qte == '20000') { cena=537.68;}
              if (this.qte == '25000') { cena=691.24;}
              if (this.qte == '30000') { cena=825.70;}
              if (this.qte == '35000') { cena=955.79;}
              if (this.qte == '40000') { cena=2144.14;}
              if (this.qte == '45000') { cena=1213.96;}
              if (this.qte == '50000') { cena=1343.04;}
              if (this.qte == '75000') { cena=1974.90;}
              if (this.qte == '100000') { cena=2613.55;}
            }
          }

          //----------------------------------------------------------------135g
          if (this.support == '135g') {

            if (this.dimensions == 'A5'){
              opis = '- A5 ouvert -> A6 fermé <br>- 135gr | Quadri';
              if (this.qte == '25') { cena=29.31;}
              if (this.qte == '50') { cena=29.35;}
              if (this.qte == '100') { cena=30.26;}
              if (this.qte == '250') { cena=32.44;}
              if (this.qte == '500') { cena=32.33;}
              if (this.qte == '1000') { cena=34.76;}
              if (this.qte == '1250') { cena=47.03;}
              if (this.qte == '2000') { cena=52.99;}
              if (this.qte == '2500') { cena=56.79;}
              if (this.qte == '5000') { cena=75.99;}
              if (this.qte == '10000') { cena=122.40;}
              if (this.qte == '15000') { cena=169.73;}
              if (this.qte == '20000') { cena=223.58;}
              if (this.qte == '25000') { cena=270.91;}
              if (this.qte == '30000') { cena=318.24;}
              if (this.qte == '35000') { cena=377.60;}
              if (this.qte == '40000') { cena=429.62;}
              if (this.qte == '45000') { cena=466.75;}
              if (this.qte == '50000') { cena=526.12;}
              if (this.qte == '75000') { cena=762.86;}
              if (this.qte == '100000') { cena=1017.14;}
            }

            if (this.dimensions == 'A4') {
              opis = '- A4 ouvert -> A5 fermé <br>- 135gr | Quadri';
              if (this.qte == '25') { cena=32.36;}
              if (this.qte == '50') { cena=32.95;}
              if (this.qte == '100') { cena=35.02;}
              if (this.qte == '250') { cena=40.35;}
              if (this.qte == '500') { cena=42.72;}
              if (this.qte == '1000') { cena=52.51;}
              if (this.qte == '1250') { cena=67.61;}
              if (this.qte == '2000') { cena=77.66;}
              if (this.qte == '2500') { cena=98.50;}
              if (this.qte == '5000') { cena=124.24;}
              if (this.qte == '10000') { cena=200.33;}
              if (this.qte == '15000') { cena=283.87;}
              if (this.qte == '20000') { cena=383.21;}
              if (this.qte == '25000') { cena=466.75;}
              if (this.qte == '30000') { cena=567.02;}
              if (this.qte == '35000') { cena=669.12;}
              if (this.qte == '40000') { cena=749.80;}
              if (this.qte == '45000') { cena=807.43;}
              if (this.qte == '50000') { cena=914.12;}
              if (this.qte == '75000') { cena=1335.59;}
              if (this.qte == '100000') { cena=1781.12;}
            }

            if (this.dimensions == 'A4 3 volets')  {
              opis = '- A4 ouvert -> 3 volets 10x21cm fermé <br>- 135gr | Quadri';
              if (this.qte == '25') { cena=34.64;}
              if (this.qte == '50') { cena=35.18;}
              if (this.qte == '100') { cena=37.23;}
              if (this.qte == '250') { cena=42.46;}
              if (this.qte == '500') { cena=45.38;}
              if (this.qte == '1000') { cena=50.82;}
              if (this.qte == '1250') { cena=61.15;}
              if (this.qte == '2000') { cena=70.95;}
              if (this.qte == '2500') { cena=73.33;}
              if (this.qte == '5000') { cena=124.24;}
              if (this.qte == '10000') { cena=200.33;}
              if (this.qte == '15000') { cena=283.87;}
              if (this.qte == '20000') { cena=383.21;}
              if (this.qte == '25000') { cena=466.75;}
              if (this.qte == '30000') { cena=567.02;}
              if (this.qte == '35000') { cena=669.12;}
              if (this.qte == '40000') { cena=749.80;}
              if (this.qte == '45000') { cena=807.43;}
              if (this.qte == '50000') { cena=914.12;}
              if (this.qte == '75000') { cena=1335.59;}
              if (this.qte == '100000') { cena=1781.12;}
            }

            if (this.dimensions == 'Din long') {
              opis = '- 21x21cm ouvert -> 10,5x21cm fermé <br>- 135gr | Quadri';
              if (this.qte == '25') { cena=28.73;}
              if (this.qte == '50') { cena=28.99;}
              if (this.qte == '100') { cena=30.32;}
              if (this.qte == '250') { cena=33.66;}
              if (this.qte == '500') { cena=34.94;}
              if (this.qte == '1000') { cena=35.57;}
              if (this.qte == '1250') { cena=47.67;}
              if (this.qte == '2000') { cena=54.59;}
              if (this.qte == '2500') { cena=59.11;}
              if (this.qte == '5000') { cena=93.64;}
              if (this.qte == '10000') { cena=151.16;}
              if (this.qte == '15000') { cena=211.45;}
              if (this.qte == '20000') { cena=283.87;}
              if (this.qte == '25000') { cena=345.17;}
              if (this.qte == '30000') { cena=403.61;}
              if (this.qte == '35000') { cena=479.71;}
              if (this.qte == '40000') { cena=551.21;}
              if (this.qte == '45000') { cena=597.62;}
              if (this.qte == '50000') { cena=671.87 ;}
              if (this.qte == '75000') { cena=984.71;}
              if (this.qte == '100000') { cena=1310.50 ;}
            }

            if (this.dimensions == 'A3') {
              opis = '- A3 ouvert -> A4 fermé<br>- 135gr | Quadri';
              if (this.qte == '25') { cena=38.96;}
              if (this.qte == '50') { cena=40.60;}
              if (this.qte == '100') { cena=44.92;}
              if (this.qte == '250') { cena=56.67;}
              if (this.qte == '500') { cena=64.65;}
              if (this.qte == '1000') { cena=84.05;}
              if (this.qte == '1250') { cena=121.14;}
              if (this.qte == '2000') { cena=139.11;}
              if (this.qte == '2500') { cena=141.79;}
              if (this.qte == '5000') { cena=215.09;}
              if (this.qte == '10000') { cena=362.27;}
              if (this.qte == '15000') { cena=509.46;}
              if (this.qte == '20000') { cena=656.66;}
              if (this.qte == '25000') { cena=844.03;}
              if (this.qte == '30000') { cena=1008.10;}
              if (this.qte == '35000') { cena=1175.09;}
              if (this.qte == '40000') { cena=1332.59;}
              if (this.qte == '45000') { cena=1490.08;}
              if (this.qte == '50000') { cena=1647.58;}
              if (this.qte == '75000') { cena=2435.04;}
              if (this.qte == '100000') { cena=3229.16;}
            }
          }

          //----------------------------------------------------------------170g
          if (this.support == '170g') {

            if (this.dimensions == 'A5') {
              opis = '- A5 ouvert -> A6 fermé <br>- 170gr | Quadri';
              if (this.qte == '25') { cena=30.54;}
              if (this.qte == '50') { cena=30.62;}
              if (this.qte == '100') { cena=31.66;}
              if (this.qte == '250') { cena=34.19;}
              if (this.qte == '500') { cena=34.37;}
              if (this.qte == '1000') { cena=37.95;}
              if (this.qte == '1250') { cena=51.18;}
              if (this.qte == '2000') { cena=59.19;}
              if (this.qte == '2500') { cena=64.41;}
              if (this.qte == '5000') { cena=100.78;}
              if (this.qte == '10000') { cena=168.10;}
              if (this.qte == '15000') { cena=233.38;}
              if (this.qte == '20000') { cena=306.82;}
              if (this.qte == '25000') { cena=372.10;}
              if (this.qte == '30000') { cena=437.38;}
              if (this.qte == '35000') { cena=518.98;}
              if (this.qte == '40000') { cena=590.38;}
              if (this.qte == '45000') { cena=641.38;}
              if (this.qte == '50000') { cena=722.98;}
              if (this.qte == '75000') { cena=1048.36;}
              if (this.qte == '100000') { cena=1397.20;}
            }

            if (this.dimensions == 'A4') {
              opis = '- A4 ouvert -> A5 fermé <br>- 170gr | Quadri';
              if (this.qte == '25') { cena=33.81;}
              if (this.qte == '50') { cena=34.51;}
              if (this.qte == '100') { cena=36.84;}
              if (this.qte == '250') { cena=42.88;}
              if (this.qte == '500') { cena=46.80;}
              if (this.qte == '1000') { cena=59.00;}
              if (this.qte == '1250') { cena=75.53;}
              if (this.qte == '2000') { cena=103.93;}
              if (this.qte == '2500') { cena=113.41;}
              if (this.qte == '5000') { cena=159.94;}
              if (this.qte == '10000') { cena=256.84;}
              if (this.qte == '15000') { cena=363.94;}
              if (this.qte == '20000') { cena=491.44;}
              if (this.qte == '25000') { cena=598.54;}
              if (this.qte == '30000') { cena=727.06;}
              if (this.qte == '35000') { cena=857.62;}
              if (this.qte == '40000') { cena=961.66;}
              if (this.qte == '45000') { cena=1035.10;}
              if (this.qte == '50000') { cena=1171.78;}
              if (this.qte == '75000') { cena=1712.38;}
              if (this.qte == '100000') { cena=2283.58;}
            }

            if (this.dimensions == 'A4 3 volets') {
              opis = '- A4 ouvert -> 3 volets 10x21cm fermé <br>- 170gr | Quadri';
              if (this.qte == '25') { cena=36.18;}
              if (this.qte == '50') { cena=36.82;}
              if (this.qte == '100') { cena=39.14;}
              if (this.qte == '250') { cena=45.07;}
              if (this.qte == '500') { cena=48.67;}
              if (this.qte == '1000') { cena=56.82;}
              if (this.qte == '1250') { cena=68.67;}
              if (this.qte == '2000') { cena=95.95;}
              if (this.qte == '2500') { cena=105.18;}
              if (this.qte == '5000') { cena=163.00;}
              if (this.qte == '10000') { cena=262.96;}
              if (this.qte == '15000') { cena=372.10;}
              if (this.qte == '20000') { cena=502.66;}
              if (this.qte == '25000') { cena=612.82;}
              if (this.qte == '30000') { cena=743.38;}
              if (this.qte == '35000') { cena=878.02;}
              if (this.qte == '40000') { cena=984.10;}
              if (this.qte == '45000') { cena=1059.58;}
              if (this.qte == '50000') { cena=1199.32;}
              if (this.qte == '75000') { cena=1752.16;}
              if (this.qte == '100000') { cena=2335.60;}
            }

            if (this.dimensions == 'Din long') {
              opis = '- 21x21cm ouvert -> 10,5x21cm fermé <br>- 170gr | Quadri';
              if (this.qte == '25') { cena=29.98;}
              if (this.qte == '50') { cena=30.30;}
              if (this.qte == '100') { cena=31.81;}
              if (this.qte == '250') { cena=35.63;}
              if (this.qte == '500') { cena=37.33;}
              if (this.qte == '1000') { cena=42.32;}
              if (this.qte == '1250') { cena=56.31;}
              if (this.qte == '2000') { cena=62.31;}
              if (this.qte == '2500') { cena=68.64;}
              if (this.qte == '5000') { cena=114.34;}
              if (this.qte == '10000') { cena=205.95;}
              if (this.qte == '15000') { cena=294.58;}
              if (this.qte == '20000') { cena=389.15;}
              if (this.qte == '25000') { cena=480.22;}
              if (this.qte == '30000') { cena=561.82;}
              if (this.qte == '35000') { cena=667.90;}
              if (this.qte == '40000') { cena=767.86;}
              if (this.qte == '45000') { cena=832.12;}
              if (this.qte == '50000') { cena=935.14 ;}
              if (this.qte == '75000') { cena=1370.68;}
              if (this.qte == '100000') { cena=1824.58 ;}
            }

            if (this.dimensions == 'A3') {
              opis = '- A3 ouvert -> A4 fermé<br>- 170gr | Quadri';
              if (this.qte == '25') { cena=40.86;}
              if (this.qte == '50') { cena=42.75;}
              if (this.qte == '100') { cena=47.58;}
              if (this.qte == '250') { cena=60.40;}
              if (this.qte == '500') { cena=71.47;}
              if (this.qte == '1000') { cena=108.99;}
              if (this.qte == '1250') { cena=136.49;}
              if (this.qte == '2000') { cena=176.63;}
              if (this.qte == '2500') { cena=170.73;}
              if (this.qte == '5000') { cena=277.55;}
              if (this.qte == '10000') { cena=486.27;}
              if (this.qte == '15000') { cena=695.00;}
              if (this.qte == '20000') { cena=903.73;}
              if (this.qte == '25000') { cena=1168.07;}
              if (this.qte == '30000') { cena=1391.08;}
              if (this.qte == '35000') { cena=1636.99;}
              if (this.qte == '40000') { cena=1860.33;}
              if (this.qte == '45000') { cena=2067.34;}
              if (this.qte == '50000') { cena=2313.78;}
              if (this.qte == '75000') { cena=3411.70;}
              if (this.qte == '100000') { cena=4553.90;}
            }
          } // fin 170g

          //--------------------------------------------------------------- coef

          if (this.qte == '25')  cena *= 1.1;
          if (this.qte == '50')  cena *= 1.2;
          if (this.qte == '100') cena *= 1.3;

          if ( (this.dimensions == 'A5' || this.dimensions == 'Din long' || this.dimensions == 'A4' || this.dimensions == 'A4 3 volets') && this.qte == '250' ) cena*=1.4;
          if (  this.dimensions == 'A3' && this.qte == '250' )  cena *= 1.5;

          if ( (this.dimensions == 'A5' || this.dimensions == 'Din long')                               && this.qte == '500' ) cena *= 1.5;
          if ( (this.dimensions == 'A4' || this.dimensions == 'A4 3 volets' || this.dimensions == 'A3') && this.qte == '500' ) cena *= 1.8;

          if (  this.dimensions == 'A5' && this.qte == '1000' ) cena *= 1.6;
          if ( (this.dimensions == 'Din long' || this.dimensions == 'A4' || this.dimensions == 'A4 3 volets' || this.dimensions == 'A3') && this.qte == '1000' ) cena *= 2;

          if ( this.qte >= 1250  ) cena *= 2;

          // -------------------------------------------------------------------
          if (this.dimensions == 'Din long') {
            this.hauteur = 21;
            this.largeur = 21;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A3') {
            this.hauteur = 29.7;
            this.largeur = 42;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A4' || this.dimensions == 'A4 3 volets') {
            this.hauteur = 21;
            this.largeur = 29.7;
          }
          // -------------------------------------------------------------------
          if (this.dimensions == 'A5') {
            this.hauteur = 14.8;
            this.largeur = 21;
          }

        } // fin dépliants

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          cena += 29; // prix spécial ?
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          cena += this.$global.maqBAT;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          cena += this.$global.maqONL;
          this.modmaq = 'je crée ma maquette en ligne / '+this.choixForm;
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}

        // ----------------------------------------------------------- SIGNATURE

        if (this.sign == 'sans signature') {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena+= this.$global.opSIGN;}
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
          cena += this.$global.livREL;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= this.$global.livREV;}
          this.optliv = ' / colis revendeur';
        }

        // -------------------------------------------------------- PRIX PRODUIT
        prixunite  = cena;
        prixunite  = fixstr(prixunite);
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------ PRIX LIVRAISON

        if (this.delaiprod && this.delailiv){
          var ProdPercent = '';
          var DeliPercent = '';

          if      (this.delaiprod == '2-3') ProdPercent = 45;
          else if (this.delaiprod == '1-1') ProdPercent = 99;
          else                              ProdPercent = 0;

          if      (this.delailiv == '2-3')  DeliPercent = 45;
          else if (this.delailiv == '1-1')  DeliPercent = 99;
          else                              DeliPercent = 0;

          var price_unit = parseFloat(prixunite);

          var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
          var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
          finalPrice               = (calculatedTotalPrice + price_unit);

          finalPrice1 = fixstr(finalPrice);
          finalPrice2 = finalPrice1.replace(".", ",");

          this.prixUnit = finalPrice2 +' €' ;
        }

        // ---------------------------------------------------------- PRIX TOTAL

        prixunite = finalPrice1;
        cena = prixunite;
        prixunite = fixstr(prixunite);
        this.transport = 0;
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis
        if (this.choixSupp == 'choisir le grammage') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir le grammage';

        } else if (this.choixLami == 'type de papier') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir le type de papier';

        } else if (this.choixSize == 'choisir les dimensions') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une dimension';

        } else if (this.choixPrint == 'choisir l\'impression') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir le mode d\'impression';

        } else if (this.choixMaqt == 'votre maquette (fichier d\'impression)') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option maquette';

        } else if (this.choixForm == 'choisir le format') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir un format';

        } else if (this.choixSign == 'logo france banderole ?') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option signature';

        } else if (this.choixQtte == 'choisir la quantité') {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir la quantité';
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

          // -------------------------------------------- forfait si prix < 19 €
          if ( suma < 19 ) {
            var forfait = 19 - suma;
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

              suma = 19;
              suma = fixstr(suma);
              this.suma2 = suma.replace(".", ",");

              this.prixTotal = this.suma2 +' €' ;

            } else {
              newoption = parseFloat(forfait);
              newoption = fixstr(newoption);
              newoption2 = newoption.replace(".", ",");
              option2 = newoption2;

              this.prixOption = newoption2 +' €' ;

              suma = 19;
              suma = fixstr(suma);
              this.suma2 = suma.replace(".", ",");

              this.prixTotal = this.suma2 +' €' ;
            }
          }

          genImg(); // générer l'image produit et l'ajouter au formulaire

          // ---------------------------------------- données envoyées au panier
          var dprod = this.delaiprod;  if (this.delaiprod == '1-1') dprod = '1';
          var dliv  = this.delailiv;   if (this.delailiv  == '1-1') dliv  = '1';

          this.inputDesc = opis+' '+this.choixPrint+'<br>- '+this.papier+'<br>- Quantité: '+this.qte+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = this.produit + ' ' +this.support;
          this.inputQte       = 1;
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
