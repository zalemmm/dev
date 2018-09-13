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
      choixProd : 'choisir le grammage',
      choixSize : '',
      choixForm : '',
      choixMaqt : '',
      choixSign : '',
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
      toggleForm: true,
      toggleQtte: true,
      toggleMaqt: true,
      toggleSign: true,

      showSize: false,
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
      fluo: true,

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
        this.showQtte = false;
        this.details = '';

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/papier/bg.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        if (this.produit == '120g fluo') this.fluo = false;
        else this.fluo = true;

        this.showSize = true;
        this.reqSize = 'required';
        this.toggleSize = true;
        this.choixSize = 'choisir les dimensions';

    }, // fin fonction choix produit

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectSize: function(value) {
        this.dimensions = value;   // on attribue la valeur renvoyée par la fonction à la variable dimension
        this.choixSize = value;    // on attribue la valeur au champ de titre dimensions
        this.toggleSize = false;   // on replie le menu à la sélection
        this.reqSize = '';         // on rétablit les styles du champ à "non requis"

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showMaqt = true;
        this.reqMaqt = 'required';
        this.toggleMaqt = true;
        this.choixMaqt = 'votre maquette (fichier d\'impression)';

    }, // fin fonction choix dimensions


    // fonction affichage champs formulaire :          au choix signature validé
    //==========================================================================
    selectMaqt: function(value) {
        this.maquette = value;
        this.choixMaqt = value;
        this.toggleMaqt = false;
        this.reqMaqt = '';

        if (this.maquette == 'maquette en ligne') {
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
        var cena        = 0; var cena2=0;
        var suma        = 0; var suma2=0;
        var prixunite   = 0;
    		var rabat       = 0;     var rabat2 = 0;
    		var prliv       = '';
        var transport   = 0;
        var largeur     = 0;
    		var hauteur     = 0;
    		var m2          = 0; // m²
    		var pm2         = 0; // prix m²
        var opis        = '';

        //----------------------------------------------------------------- 120g

        if (this.produit == 'Affiches 120g') {

          if (this.dimensions == 'DIN A2 (42x60cm) UV'){
            if (this.qte == '1')  { m2=1*0.25;   transport=7;}
    		    if (this.qte == '2')  { m2=2*0.25;   transport=7;}
            if (this.qte == '4')  { m2=4*0.25;   transport=9;}
    	     	if (this.qte == '6')  { m2=6*0.25;   transport=9;}
    		    if (this.qte == '8')  { m2=8*0.25;   transport=9;}
            if (this.qte == '10') { m2=10*0.25;  transport=11.9;}
            if (this.qte == '20') { m2=20*0.25;  transport=13.9;}
            if (this.qte == '50') { m2=50*0.25;  transport=15.9;}
            if (this.qte == '100'){ m2=100*0.25; transport=19.9;}
          }

          if (this.dimensions == 'DIN A1 (60x80cm) UV'){
            if (this.qte == '1')  { m2=1*0.5;   transport=7;}
  		      if (this.qte == '2')  { m2=2*0.5;   transport=7;}
            if (this.qte == '4')  { m2=4*0.5;   transport=9;}
  	      	if (this.qte == '6')  { m2=6*0.5;   transport=9;}
  	       	if (this.qte == '8')  { m2=8*0.5;   transport=9;}
            if (this.qte == '10') { m2=10*0.5;  transport=11.9;}
            if (this.qte == '20') { m2=20*0.5;  transport=13.9;}
            if (this.qte == '50') { m2=50*0.5;  transport=15.9;}
            if (this.qte == '100'){ m2=100*0.5; transport=19.9;}
          }

          if (this.dimensions == 'DIN A0 (80x120cm) UV'){
            if (this.qte == '1')  { m2=1*0.96;   transport=7;}
            if (this.qte == '2')  { m2=2*0.96;   transport=7;}
            if (this.qte == '4')  { m2=4*0.96;   transport=9;}
            if (this.qte == '6')  { m2=6*0.96;   transport=9;}
            if (this.qte == '8')  { m2=8*0.96;   transport=9;}
            if (this.qte == '10') { m2=10*0.96;  transport=11.9;}
            if (this.qte == '20') { m2=20*0.96;  transport=13.9;}
            if (this.qte == '50') { m2=50*0.96;  transport=15.9;}
            if (this.qte == '100'){ m2=100*0.96; transport=19.9;}
          }

          if (this.dimensions == '120x160cm (Abribus) UV'){
            if (this.qte == '1')  { m2=1*1.92;   transport=7;}
            if (this.qte == '2')  { m2=2*1.92;   transport=7;}
            if (this.qte == '4')  { m2=4*1.92;   transport=9;}
            if (this.qte == '6')  { m2=6*1.92;   transport=9;}
            if (this.qte == '8')  { m2=8*1.92;   transport=9;}
            if (this.qte == '10') { m2=10*1.92;  transport=11.9;}
            if (this.qte == '20') { m2=20*1.92;  transport=13.9;}
            if (this.qte == '50') { m2=50*1.92;  transport=15.9;}
            if (this.qte == '100'){ m2=100*1.92; transport=19.9;}
          }

          if (this.dimensions == '120x176cm (Abribus) UV'){
            if (this.qte == '1')  { m2=1*2.11;   transport=7;}
            if (this.qte == '2')  { m2=2*2.11;   transport=7;}
            if (this.qte == '4')  { m2=4*2.11;   transport=9;}
            if (this.qte == '6')  { m2=6*2.11;   transport=9;}
            if (this.qte == '8')  { m2=8*2.11;   transport=9;}
            if (this.qte == '10') { m2=10*2.11;  transport=11.9;}
            if (this.qte == '20') { m2=20*2.11;  transport=13.9;}
            if (this.qte == '50') { m2=50*2.11;  transport=15.9;}
            if (this.qte == '100'){ m2=100*2.11; transport=19.9;}
          }

          if (this.dimensions == '100x150cm (Abribus) UV'){
            if (this.qte == '1')  { m2=1*1.5;   transport=7;}
            if (this.qte == '2')  { m2=2*1.5;   transport=7;}
            if (this.qte == '4')  { m2=4*1.5;   transport=9;}
            if (this.qte == '6')  { m2=6*1.5;   transport=9;}
            if (this.qte == '8')  { m2=8*1.5;   transport=9;}
            if (this.qte == '10') { m2=10*1.5;  transport=11.9;}
            if (this.qte == '20') { m2=20*1.5;  transport=13.9;}
            if (this.qte == '50') { m2=50*1.5;  transport=15.9;}
            if (this.qte == '100'){ m2=100*1.5; transport=19.9;}
          }

          if (this.dimensions == '150x200cm (Abribus) UV'){
            if (this.qte == '1')  { m2=1*3;   transport=7;}
            if (this.qte == '2')  { m2=2*3;   transport=7;}
            if (this.qte == '4')  { m2=4*3;   transport=9;}
            if (this.qte == '6')  { m2=6*3;   transport=9;}
            if (this.qte == '8')  { m2=8*3;   transport=9;}
            if (this.qte == '10') { m2=10*3;  transport=11.9;}
            if (this.qte == '20') { m2=20*3;  transport=13.9;}
            if (this.qte == '50') { m2=50*3;  transport=15.9;}
            if (this.qte == '100'){ m2=100*3; transport=19.9;}
          }
        }

        //----------------------------------------------------------------- 150g

        if (this.produit == 'Affiches 150g') {

          if (this.dimensions == 'DIN A2 (42x60cm) UV'){
            if (this.qte == '1')  { m2=1*0.25;   transport=7;}
            if (this.qte == '2')  { m2=2*0.25;   transport=7;}
            if (this.qte == '4')  { m2=4*0.25;   transport=9;}
            if (this.qte == '6')  { m2=6*0.25;   transport=9;}
            if (this.qte == '8')  { m2=8*0.25;   transport=9;}
            if (this.qte == '10') { m2=10*0.25;  transport=11.9;}
            if (this.qte == '20') { m2=20*0.25;  transport=13.9;}
            if (this.qte == '50') { m2=50*0.25;  transport=15.9;}
            if (this.qte == '100'){ m2=100*0.25; transport=19.9;}
          }

          if (this.dimensions == 'DIN A1 (60x80cm) UV'){
            if (this.qte == '1')   { m2=1*0.5;   transport=7;}
            if (this.qte == '2')   { m2=2*0.5;   transport=7;}
            if (this.qte == '4')   { m2=4*0.5;   transport=9;}
            if (this.qte == '6')   { m2=6*0.5;   transport=9;}
            if (this.qte == '8')   { m2=8*0.5;   transport=9;}
            if (this.qte == '10')  { m2=10*0.5;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.5;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.5;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.5; transport=19.9;}
          }

          if (this.dimensions == 'DIN A0 (80x120cm) UV'){
            if (this.qte == '1')   { m2=1*0.96;   transport=7;}
            if (this.qte == '2')   { m2=2*0.96;   transport=7;}
            if (this.qte == '4')   { m2=4*0.96;   transport=9;}
            if (this.qte == '6')   { m2=6*0.96;   transport=9;}
            if (this.qte == '8')   { m2=8*0.96;   transport=9;}
            if (this.qte == '10')  { m2=10*0.96;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.96;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.96;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.96; transport=19.9;}
          }

          if (this.dimensions == '120x160cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*1.92;   transport=7;}
            if (this.qte == '2')   { m2=2*1.92;   transport=7;}
            if (this.qte == '4')   { m2=4*1.92;   transport=9;}
            if (this.qte == '6')   { m2=6*1.92;   transport=9;}
            if (this.qte == '8')   { m2=8*1.92;   transport=9;}
            if (this.qte == '10')  { m2=10*1.92;  transport=11.9;}
            if (this.qte == '20')  { m2=20*1.92;  transport=13.9;}
            if (this.qte == '50')  { m2=50*1.92;  transport=15.9;}
            if (this.qte == '100') { m2=100*1.92; transport=19.9;}
          }

          if (this.dimensions == '120x176cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*2.11;   transport=7;}
            if (this.qte == '2')   { m2=2*2.11;   transport=7;}
            if (this.qte == '4')   { m2=4*2.11;   transport=9;}
            if (this.qte == '6')   { m2=6*2.11;   transport=9;}
            if (this.qte == '8')   { m2=8*2.11;   transport=9;}
            if (this.qte == '10')  { m2=10*2.11;  transport=11.9;}
            if (this.qte == '20')  { m2=20*2.11;  transport=13.9;}
            if (this.qte == '50')  { m2=50*2.11;  transport=15.9;}
            if (this.qte == '100') { m2=100*2.11; transport=19.9;}
          }

          if (this.dimensions == '100x150cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*1.5;   transport=7;}
            if (this.qte == '2')   { m2=2*1.5;   transport=7;}
            if (this.qte == '4')   { m2=4*1.5;   transport=9;}
            if (this.qte == '6')   { m2=6*1.5;   transport=9;}
            if (this.qte == '8')   { m2=8*1.5;   transport=9;}
            if (this.qte == '10')  { m2=10*1.5;  transport=11.9;}
            if (this.qte == '20')  { m2=20*1.5;  transport=13.9;}
            if (this.qte == '50')  { m2=50*1.5;  transport=15.9;}
            if (this.qte == '100') { m2=100*1.5; transport=19.9;}
          }

          if (this.dimensions == '150x200cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*3;   transport=7;}
            if (this.qte == '2')   { m2=2*3;   transport=7;}
            if (this.qte == '4')   { m2=4*3;   transport=9;}
            if (this.qte == '6')   { m2=6*3;   transport=9;}
            if (this.qte == '8')   { m2=8*3;   transport=9;}
            if (this.qte == '10')  { m2=10*3;  transport=11.9;}
            if (this.qte == '20')  { m2=20*3;  transport=13.9;}
            if (this.qte == '50')  { m2=50*3;  transport=15.9;}
            if (this.qte == '100') { m2=100*3; transport=19.9;}
          }
        }

        //----------------------------------------------------------------- 220g

        if (this.produit == 'Affiches 220g') {

          if (this.dimensions == 'DIN A2 (42x60cm) UV'){
            if (this.qte == '1')   { m2=1*0.25;   transport=7;}
            if (this.qte == '2')   { m2=2*0.25;   transport=7;}
            if (this.qte == '4')   { m2=4*0.25;   transport=9;}
            if (this.qte == '6')   { m2=6*0.25;   transport=9;}
            if (this.qte == '8')   { m2=8*0.25;   transport=9;}
            if (this.qte == '10')  { m2=10*0.25;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.25;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.25;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.25; transport=19.9;}
          }

          if (this.dimensions == 'DIN A1 (60x80cm) UV'){
            if (this.qte == '1')   { m2=1*0.5;  transport=7;}
            if (this.qte == '2')   { m2=2*0.5;  transport=7;}
            if (this.qte == '4')   { m2=4*0.5;  transport=9;}
            if (this.qte == '6')   { m2=6*0.5;  transport=9;}
            if (this.qte == '8')   { m2=8*0.5;  transport=9;}
            if (this.qte == '10')  { m2=10*0.5; transport=11.9;}
            if (this.qte == '20')  { m2=20*0.5; transport=13.9;}
            if (this.qte == '50')  { m2=50*0.5; transport=15.9;}
            if (this.qte == '100') { m2=100*0.5; transport=19.9;}
          }

          if (this.dimensions == 'DIN A0 (80x120cm) UV'){
            if (this.qte == '1')   { m2=1*0.96;   transport=7;}
            if (this.qte == '2')   { m2=2*0.96;   transport=7;}
            if (this.qte == '4')   { m2=4*0.96;   transport=9;}
            if (this.qte == '6')   { m2=6*0.96;   transport=9;}
            if (this.qte == '8')   { m2=8*0.96;   transport=9;}
            if (this.qte == '10')  { m2=10*0.96;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.96;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.96;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.96; transport=19.9;}
          }

          if (this.dimensions == '120x160cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*1.92;   transport=7;}
            if (this.qte == '2')   { m2=2*1.92;   transport=7;}
            if (this.qte == '4')   { m2=4*1.92;   transport=9;}
            if (this.qte == '6')   { m2=6*1.92;   transport=9;}
            if (this.qte == '8')   { m2=8*1.92;   transport=9;}
            if (this.qte == '10')  { m2=10*1.92;  transport=11.9;}
            if (this.qte == '20')  { m2=20*1.92;  transport=13.9;}
            if (this.qte == '50')  { m2=50*1.92;  transport=15.9;}
            if (this.qte == '100') { m2=100*1.92; transport=19.9;}
          }

          if (this.dimensions == '120x176cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*2.11;   transport=7;}
            if (this.qte == '2')   { m2=2*2.11;   transport=7;}
            if (this.qte == '4')   { m2=4*2.11;   transport=9;}
            if (this.qte == '6')   { m2=6*2.11;   transport=9;}
            if (this.qte == '8')   { m2=8*2.11;   transport=9;}
            if (this.qte == '10')  { m2=10*2.11;  transport=11.9;}
            if (this.qte == '20')  { m2=20*2.11;  transport=13.9;}
            if (this.qte == '50')  { m2=50*2.11;  transport=15.9;}
            if (this.qte == '100') { m2=100*2.11; transport=19.9;}
          }

          if (this.dimensions == '100x150cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*1.5;   transport=7;}
            if (this.qte == '2')   { m2=2*1.5;   transport=7;}
            if (this.qte == '4')   { m2=4*1.5;   transport=9;}
            if (this.qte == '6')   { m2=6*1.5;   transport=9;}
            if (this.qte == '8')   { m2=8*1.5;   transport=9;}
            if (this.qte == '10')  { m2=10*1.5;  transport=11.9;}
            if (this.qte == '20')  { m2=20*1.5;  transport=13.9;}
            if (this.qte == '50')  { m2=50*1.5;  transport=15.9;}
            if (this.qte == '100') { m2=100*1.5; transport=19.9;}
          }

          if (this.dimensions == '150x200cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*3;   transport=7;}
            if (this.qte == '2')   { m2=2*3;   transport=7;}
            if (this.qte == '4')   { m2=4*3;   transport=9;}
            if (this.qte == '6')   { m2=6*3;   transport=9;}
            if (this.qte == '8')   { m2=8*3;   transport=9;}
            if (this.qte == '10')  { m2=10*3;  transport=11.9;}
            if (this.qte == '20')  { m2=20*3;  transport=13.9;}
            if (this.qte == '50')  { m2=50*3;  transport=15.9;}
            if (this.qte == '100') { m2=100*3; transport=19.9;}
          }
        }

        //-------------------------------------------------------------120g fluo

        if (this.produit == 'Affiches 120g fluo') {

          if (this.dimensions == 'DIN A2 (42x60cm) UV'){
            if (this.qte == '1')   { m2=1*0.25;   transport=7;}
            if (this.qte == '2')   { m2=2*0.25;   transport=7;}
            if (this.qte == '4')   { m2=4*0.25;   transport=9;}
            if (this.qte == '6')   { m2=6*0.25;   transport=9;}
            if (this.qte == '8')   { m2=8*0.25;   transport=9;}
            if (this.qte == '10')  { m2=10*0.25;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.25;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.25;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.25; transport=19.9;}
          }

          if (this.dimensions == 'DIN A1 (60x80cm) UV'){
            if (this.qte == '1')   { m2=1*0.5;   transport=7;}
            if (this.qte == '2')   { m2=2*0.5;   transport=7;}
            if (this.qte == '4')   { m2=4*0.5;   transport=9;}
            if (this.qte == '6')   { m2=6*0.5;   transport=9;}
            if (this.qte == '8')   { m2=8*0.5;   transport=9;}
            if (this.qte == '10')  { m2=10*0.5;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.5;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.5;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.5; transport=19.9;}
          }

          if (this.dimensions == 'DIN A0 (80x120cm) UV'){
            if (this.qte == '1')   { m2=1*0.96;   transport=7;}
            if (this.qte == '2')   { m2=2*0.96;   transport=7;}
            if (this.qte == '4')   { m2=4*0.96;   transport=9;}
            if (this.qte == '6')   { m2=6*0.96;   transport=9;}
            if (this.qte == '8')   { m2=8*0.96;   transport=9;}
            if (this.qte == '10')  { m2=10*0.96;  transport=11.9;}
            if (this.qte == '20')  { m2=20*0.96;  transport=13.9;}
            if (this.qte == '50')  { m2=50*0.96;  transport=15.9;}
            if (this.qte == '100') { m2=100*0.96; transport=19.9;}
          }

          if (this.dimensions == '120x160cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*1.92;   transport=7;}
            if (this.qte == '2')   { m2=2*1.92;   transport=7;}
            if (this.qte == '4')   { m2=4*1.92;   transport=9;}
            if (this.qte == '6')   { m2=6*1.92;   transport=9;}
            if (this.qte == '8')   { m2=8*1.92;   transport=9;}
            if (this.qte == '10')  { m2=10*1.92;  transport=11.9;}
            if (this.qte == '20')  { m2=20*1.92;  transport=13.9;}
            if (this.qte == '50')  { m2=50*1.92;  transport=15.9;}
            if (this.qte == '100') { m2=100*1.92; transport=19.9;}
          }

          if (this.dimensions == '120x176cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*2.11;   transport=7;}
            if (this.qte == '2')   { m2=2*2.11;   transport=7;}
            if (this.qte == '4')   { m2=4*2.11;   transport=9;}
            if (this.qte == '6')   { m2=6*2.11;   transport=9;}
            if (this.qte == '8')   { m2=8*2.11;   transport=9;}
            if (this.qte == '10')  { m2=10*2.11;  transport=11.9;}
            if (this.qte == '20')  { m2=20*2.11;  transport=13.9;}
            if (this.qte == '50')  { m2=50*2.11;  transport=15.9;}
            if (this.qte == '100') { m2=100*2.11; transport=19.9;}
          }

          if (this.dimensions == '100x150cm (Abribus) UV'){
            if (this.qte == '1')   { m2=1*1.5;   transport=7;}
            if (this.qte == '2')   { m2=2*1.5;   transport=7;}
            if (this.qte == '4')   { m2=4*1.5;   transport=9;}
            if (this.qte == '6')   { m2=6*1.5;   transport=9;}
            if (this.qte == '8')   { m2=8*1.5;   transport=9;}
            if (this.qte == '10')  { m2=10*1.5;  transport=11.9;}
            if (this.qte == '20')  { m2=20*1.5;  transport=13.9;}
            if (this.qte == '50')  { m2=50*1.5;  transport=15.9;}
            if (this.qte == '100') { m2=100*1.5; transport=19.9;}
          }
        }

    	  //----------------------------------------------------------------- 120g
    	  if ((m2<1) && (this.produit == 'Affiches 120g') ) {pm2=7;}
    	  if ((m2>=1) && (m2<2) && (this.produit == 'Affiches 120g') ) {pm2=6.5;}
    	  if ((m2>=2) && (m2<3) && (this.produit == 'Affiches 120g') ) {pm2=5.8;}
    	  if ((m2>=3) && (m2<6) && (this.produit == 'Affiches 120g') ) {pm2=5.5;}
    	  if ((m2>=6) && (m2<13) && (this.produit == 'Affiches 120g') ) {pm2=5.2;}
    	  if ((m2>=13) && (m2<25) && (this.produit == 'Affiches 120g') ) {pm2=4.9;}
    	  if ((m2>=25) && (m2<50) && (this.produit == 'Affiches 120g') ) {pm2=4.6;}
    	  if ((m2>=50) && (m2<100) && (this.produit == 'Affiches 120g') ) {pm2=4.3;}
    	  if ((m2>=100) && (m2<200) && (this.produit == 'Affiches 120g') ) {pm2=4;}
    	  if ((m2>=200) && (m2<300) && (this.produit == 'Affiches 120g') ) {pm2=3.5;}
    	  if ((m2>=300) && (this.produit == 'Affiches 120g') ) {pm2=3;}

    	   //---------------------------------------------------------------- 150g
    	  if ((m2<1) && (this.produit == 'Affiches 150g') ) {pm2=9;}
    	  if ((m2>=1) && (m2<2) && (this.produit == 'Affiches 150g') ) {pm2=8.5;}
    	  if ((m2>=2) && (m2<3) && (this.produit == 'Affiches 150g') ) {pm2=8;}
    	  if ((m2>=3) && (m2<6) && (this.produit == 'Affiches 150g') ) {pm2=7.5;}
    	  if ((m2>=6) && (m2<13) && (this.produit == 'Affiches 150g') ) {pm2=7;}
    	  if ((m2>=13) && (m2<25) && (this.produit == 'Affiches 150g') ) {pm2=6.5;}
    	  if ((m2>=25) && (m2<50) && (this.produit == 'Affiches 150g') ) {pm2=6;}
    	  if ((m2>=50) && (m2<100) && (this.produit == 'Affiches 150g') ) {pm2=5.5;}
    	  if ((m2>=100) && (m2<200) && (this.produit == 'Affiches 150g') ) {pm2=5;}
    	  if ((m2>=200) && (m2<300) && (this.produit == 'Affiches 150g') ) {pm2=4.5;}
    	  if ((m2>=300) && (this.produit == 'Affiches 150g') ) {pm2=4;}

    	   //---------------------------------------------------------------- 220g
    	  if ((m2<1) && (this.produit == 'Affiches 220g') ) {pm2=10;}
    	  if ((m2>=1) && (m2<2) && (this.produit == 'Affiches 220g') ) {pm2=9.5;}
    	  if ((m2>=2) && (m2<3) && (this.produit == 'Affiches 220g') ) {pm2=9;}
    	  if ((m2>=3) && (m2<6) && (this.produit == 'Affiches 220g') ) {pm2=8.5;}
    	  if ((m2>=6) && (m2<13) && (this.produit == 'Affiches 220g') ) {pm2=8;}
    	  if ((m2>=13) && (m2<25) && (this.produit == 'Affiches 220g') ) {pm2=7.5;}
    	  if ((m2>=25) && (m2<50) && (this.produit == 'Affiches 220g') ) {pm2=7;}
    	  if ((m2>=50) && (m2<100) && (this.produit == 'Affiches 220g') ) {pm2=6.5;}
    	  if ((m2>=100) && (m2<200) && (this.produit == 'Affiches 220g') ) {pm2=6;}
    	  if ((m2>=200) && (m2<300) && (this.produit == 'Affiches 220g') ) {pm2=5.5;}
    	  if ((m2>=300) && (this.produit == 'Affiches 220g') ) {pm2=5;}

    	   //---------------------------------------------------------------- 120g
    	  if ((m2<1) && (this.produit == 'Affiches 120g fluo') ) {pm2=9.5;}
    	  if ((m2>=1) && (m2<2) && (this.produit == 'Affiches 120g fluo') ) {pm2=9;}
    	  if ((m2>=2) && (m2<3) && (this.produit == 'Affiches 120g fluo') ) {pm2=8.5;}
    	  if ((m2>=3) && (m2<6) && (this.produit == 'Affiches 120g fluo') ) {pm2=8;}
    	  if ((m2>=6) && (m2<13) && (this.produit == 'Affiches 120g fluo') ) {pm2=7.5;}
    	  if ((m2>=13) && (m2<25) && (this.produit == 'Affiches 120g fluo') ) {pm2=7;}
    	  if ((m2>=25) && (m2<50) && (this.produit == 'Affiches 120g fluo') ) {pm2=6.5;}
    	  if ((m2>=50) && (m2<100) && (this.produit == 'Affiches 120g fluo') ) {pm2=6;}
    	  if ((m2>=100) && (m2<200) && (this.produit == 'Affiches 120g fluo') ) {pm2=5.5;}
    	  if ((m2>=200) && (m2<300) && (this.produit == 'Affiches 120g fluo') ) {pm2=5;}
    	  if ((m2>=300) && (this.produit == 'Affiches 120g fluo') ) {pm2=4.5;}

        //----------------------------------------------------------------------

    	  cena =  m2*pm2;
    	  cena += transport;

  			// ---------------------------------------------------------------------
  			if ((this.dimensions == 'DIN A2 (42x60cm) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 60;
  				this.largeur = 42;
  			}
  			if ((this.dimensions == 'DIN A2 (42x60cm) UV') &&  (this.choixForm == 'paysage')) {
  				this.hauteur = 42;
  				this.largeur = 60;
  			}
        // ---------------------------------------------------------------------
  			if ((this.dimensions == 'DIN A1 (60x80cm) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 84;
  				this.largeur = 60;
  			}
  			if ((this.dimensions == 'DIN A1 (60x80cm) UV') && (this.choixForm == 'paysage')) {
  				this.hauteur = 60;
  				this.largeur = 84;
  			}
        // ---------------------------------------------------------------------
  			if ((this.dimensions == 'DIN A0 (80x120cm) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 120;
  				this.largeur = 84;
  			}
  			if ((this.dimensions == 'DIN A0 (80x120cm) UV') && (this.choixForm == 'paysage')) {
  				this.hauteur = 84;
  				this.largeur = 120;
  			}
        // ---------------------------------------------------------------------
  			if ((this.dimensions == '120x160cm (Abribus) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 160;
  				this.largeur = 120;
  			}
  			if ((this.dimensions == '120x160cm (Abribus) UV') && (this.choixForm == 'paysage')) {
  				this.hauteur = 120;
  				this.largeur = 160;
  			}
        // ---------------------------------------------------------------------
  			if ((this.dimensions == '120x176cm (Abribus) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 176;
  				this.largeur = 120;
  			}
  			if ((this.dimensions == '120x176cm (Abribus) UV') && (this.choixForm == 'paysage')) {
  				this.hauteur = 120;
  				this.largeur = 176;
  			}
        // ---------------------------------------------------------------------
  			if ((this.dimensions == '100x150cm (Abribus) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 150;
  				this.largeur = 100;
  			}
  			if ((this.dimensions == '100x150cm (Abribus) UV') && (this.choixForm == 'paysage')) {
  				this.hauteur = 100;
  				this.largeur = 150;
  			}
        // ---------------------------------------------------------------------
  			if ((this.dimensions == '150x200cm (Abribus) UV') && (this.choixForm == 'portrait')) {
  				this.hauteur = 200;
  				this.largeur = 150;
  			}
  			if ((this.dimensions == '150x200cm (Abribus) UV') && (this.choixForm == 'paysage')) {
  				this.hauteur = 150;
  				this.largeur = 200;
  			}

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          cena += 22;
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          cena += 4;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          cena += 6;
          this.modmaq = 'je crée ma maquette en ligne / '+this.choixForm;
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}

        // ----------------------------------------------------------- SIGNATURE

        if (this.sign == 'sans signature') {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena+= 5*this.qte;}
        }

        // ------------------------------------------------------------- OPTIONS

        if (this.adresse == true) {
          this.retrait = 'livraison';
        }

        if (this.atelier == true) {
          cena-= cena*6/100;
          this.retrait = 'retrait colis atelier';
        }

        if (this.relais == true) {
          cena += 6.00;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 5;}
          this.optliv = ' / colis revendeur';
        }

        // -------------------------------------------------------- PRIX PRODUIT
        prixunite = cena;
        prixunite = fixstr(prixunite);
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------ PRIX LIVRAISON

        if (this.delaiprod && this.delailiv){
          var ProdPercent = '';
          var DeliPercent = '';

          if      (this.delaiprod == '2-3') ProdPercent = 25;
          else if (this.delaiprod == '1-1') ProdPercent = 45;
          else                              ProdPercent = 0;

          if      (this.delailiv == '2-3')  DeliPercent = 25;
          else if (this.delailiv == '1-1')  DeliPercent = 45;
          else                              DeliPercent = 0;

          var price_unit = parseFloat(prixunite);

          var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
          var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
          finalPrice               = (calculatedTotalPrice + price_unit)/this.qte;

          finalPrice1 = fixstr(finalPrice);
          finalPrice2 = finalPrice1.replace(".", ",");

          this.prixUnit = finalPrice2 +' €' ;
        }

        // ---------------------------------------------------------- PRIX TOTAL

        prixunite = finalPrice1;
        cena = prixunite*this.qte;
        prixunite = fixstr(prixunite);
        this.transport = 0;
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis
        if (this.choixSize == 'choisir les dimensions') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une dimension';

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

          this.inputDesc = '- '+this.dimensions+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = this.produit;
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
