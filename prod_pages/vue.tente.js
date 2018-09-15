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
      murs: '',
      impression: '',
      maquette: '',
      sign: '',

      // valeurs par défaut (value) : autre champs
      choixProd : 'choisir la couleur',
      choixSize : '',
      choixMurs : '',
      choixMaqt : '',
      choixSign : '',
      choixPrint : '',
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
      reqMurs : '',
      reqMaqt : '',
      reqSign : '',
      reqQtte : '',
      reqEstm : '',
      reqPrint : '',

      btnP1: 'inactive',
      btnP2: 'inactive',
      btnP3: 'inactive',
      btnD1: 'inactive',
      btnD2: 'inactive',
      btnD3: 'inactive',

      // valeurs par défaut de visibilité des blocs :
      toggleProd: true,
      toggleSize: true,
      toggleMurs: true,
      togglePrint: true,
      toggleMaqt: true,
      toggleSign: true,

      showSize: false,
      showSupport: false,
      showPrint: false,

      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,
      showMurs: false,
      walls: false,
      nowalls: false,
      bgwall: true,

      dateLivraison: false,
      livraisonrapide: false,
      livraisonComp: false,
      formError: false,
      ajoutPanier: false,

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
        this.showMursort = this.suppPhotocall = this.suppValise = this.courbSize = this.droitSize = this.showAcce = false;
        this.details = '';

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = this.pr2 = true;  // calques bg et produit activés
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/ext.png)'};

        this.bg3 = this.bg5 = {backgroundImage: 'none'};

        // ---------------------------------------------------------------------
        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/tente/'+this.produit+'-fond.png)'};
        this.bg2 = {backgroundImage: 'url('+this.$global.img+'/tente/'+this.produit+'.png)'};

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

        this.bg3 = this.bg5 = {backgroundImage: 'none'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showMurs = true;
        this.reqMurs = 'required';
        this.toggleMurs = true;
        this.choixMurs = 'choisir les options';

    }, // fin fonction choix dimensions

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectMurs: function(value, value2) {
        this.murs = value2;   // on attribue la valeur renvoyée par la fonction à la variable dimension
        this.choixMurs = value;    // on attribue la valeur au champ de titre dimensions
        this.toggleMurs = false;   // on replie le menu à la sélection
        this.reqMurs = '';         // on rétablit les styles du champ à "non requis"

        this.pr4 = true;
        this.pr3 = this.pr5 = false;
        this.bg3 = this.bg5 = {backgroundImage: 'none'};

        this.bgwall = this.walls = this.nowalls = false;

        if (this.choixMurs == 'sans mur') this.nowalls = true;
        else if (this.choixMurs == 'sans option') this.bgwall = true;
        else this.bgwall = this.walls = true;

        if (this.choixMurs == 'sans mur') {
          this.bg1 = this.bg4 = {backgroundImage: 'none'};
        } else {
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/tente/'+this.produit+'-fond.png)'};
          this.pr4 = 'true';
          this.bg4 = {backgroundImage: 'url('+this.$global.img+'/tente/'+this.produit+'-'+value2+'.png)'};
        }

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showPrint = true;
        this.reqPrint = 'required';
        this.togglePrint = true;
        this.choixPrint = 'choisir une personnalisation';

    }, // fin fonction choix dimensions

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectPrint: function(value) {
        this.impression = value;   // on attribue la valeur renvoyée par la fonction à la variable dimension
        this.choixPrint = value;    // on attribue la valeur au champ de titre dimensions
        this.togglePrint = false;   // on replie le menu à la sélection
        this.reqPrint = '';         // on rétablit les styles du champ à "non requis"

        // réinitialiser les valeurs maquette et signatures cas retour sur option 'pas de personnalisation'
        this.showMaqt = false;
        this.showSign = false;

        if (this.impression == 'Mur de fond' || this.impression == 'Mur de fond R/V') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/tente/print-fd.png)'};
          this.bg5 = {backgroundImage: 'none'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

        } else if (this.impression == 'Murs et demi-murs' || this.impression == 'Murs et demi-murs R/V') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/tente/print-fd.png)'};
          this.bg5 = {backgroundImage: 'url('+this.$global.img+'/tente/print-'+this.murs+'.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

        } else if (this.impression == 'Fronton') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/tente/print-x.png)'};
          this.bg5 = {backgroundImage: 'none'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

        } else if (this.impression == 'Full Graphic'  || this.impression == 'Full Graphic R/V') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/tente/print-fd.png),url('+this.$global.img+'/tente/print-x.png)'};
          this.bg5 = {backgroundImage: 'url('+this.$global.img+'/tente/print-'+this.murs+'.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

        } else {
          this.bg3 = this.bg5 = {backgroundImage: 'none'};

          this.maquette = 'maquette client sans bat';
          this.modmaq = 'je ne souhaite pas de BAT';
          this.sign = 'signature France Banderole';
          this.reqQtte = 'required';
          this.showOptions = true;
        }

    }, // fin fonction choix dimensions


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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/ext.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/tente/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/ext.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/tente/'+src+'.png)'};
    },

    // fonctions hover :                                     HOVER double image
    //==========================================================================

    hoDb: function(calque, src, calque2, src2, src3) {
      this.slideContainer = false; // slider désactivé
      this.prH = this.pr0 = true;  // calques bg et préview activés

      // désactiver le calque sur lequel s'applique le hover
      if (calque == 1 || calque2 == 1) this.pr1 = false;
      if (calque == 2 || calque2 == 2) this.pr2 = false;
      if (calque == 3 || calque2 == 3) this.pr3 = false;
      if (calque == 4 || calque2 == 4) this.pr4 = false;
      if (calque == 5 || calque2 == 5) this.pr5 = false;

      this.bgH = {backgroundImage: 'url('+this.$global.img+'/tente/'+src+'.png),url('+this.$global.img+'/tente/'+src2+'.png),url('+this.$global.img+'/tente/'+src3+'.png)'};
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

        //------------------------------------------- variables de calcul panier
        var cena           = 0;    var cena2  = 0; var cena1 = 0; prixunite = 0;
        var suma           = 0;    var suma2  = 0;
        var rabat          = 0;    var rabat2 = 0;
        var transport      = 0;    var rodzaj = '';
      	var pers           = '';
      	var option         = '';
        var optliv         = '';
        var prliv          = '';
        var option2        = 0;

        ///////////////////////////////////////////////////// var x=coût+couture
        var structure;  var barredmA;        var barredmB;        var canopi;
        var mur;        var demimurA;        var demimurB;
        var murperso;   var demimurAperso;   var demimurBperso;   var frontonperso;
        var murpersorv; var demimurApersorv; var demimurBpersorv;

        if (this.dimensions == '2x2') {
          //-----------------------------------------------------------------2x2
          rodzaj = "Tente 2x2";
          this.prodref = "20170260";

          structure=160;        barredmA=25;              barredmB=25;            canopi=18.75;
          mur=14;	              demimurA=8;               demimurB=8;
          murperso=23.73+10;    demimurAperso=7.79+10;    demimurBperso=7.79+10;  frontonperso=14.36+10;
          murpersorv=47.46+15;  demimurApersorv=15.58+15; demimurBpersorv=15.58+15;

        } else if (this.dimensions == '2x3') {
          //-----------------------------------------------------------------2x3
          rodzaj = "Tente 2x3";
          this.prodref = "20170261";

          structure=208;        barredmA=25;              barredmB=25;            canopi=24;
          mur=21;	              demimurA=12;              demimurB=8;
          murperso=35.26+10;    demimurAperso=7.79+10;    demimurBperso=7.79+10;  frontonperso=18.40+10;
          murpersorv=70.52+15;  demimurApersorv=15.58+15; demimurBpersorv=15.58+15;

        } else if (this.dimensions == '3x3') {
          //-----------------------------------------------------------------3x3
          rodzaj = "Tente 3x3";
          this.prodref = "20170262";

          structure=220;        barredmA=25;              barredmB=25;            canopi=29.50;
          mur=21;	              demimurA=12;              demimurB=12;
          murperso=35.26+20;    demimurAperso=11.82+15;   demimurBperso=11.82+15; frontonperso=22.43+15;
          murpersorv=70.52+25;  demimurApersorv=23.64+20; demimurBpersorv=23.64+20;

        } else if (this.dimensions == '3x4') {
          //---------------------------------------------------------------3x4,5
          rodzaj = "Tente 3x4,5";
          this.prodref = "20170263";

          structure=253;        barredmA=28;              barredmB=25;            canopi=55;
          mur=49;	              demimurA=18.75;           demimurB=12;
          murperso=54.90+30;    demimurAperso=11.82+15;   demimurBperso=11.82+15; frontonperso=27.50+15;
          murpersorv=109.80+35; demimurApersorv=23.64+20; demimurBpersorv=23.64+20;

        } else if (this.dimensions == '3x6') {
          //-----------------------------------------------------------------3x6
          rodzaj = "Tente 3x6";
          this.prodref = "20170264";

          structure=341;        barredmA=50;              barredmB=25;            canopi=70;
          mur=42;	              demimurA=24;              demimurB=12;
          murperso=70.52+40;    demimurAperso=11.82+25;   demimurBperso=11.82+25; frontonperso=30.36+20;
          murpersorv=141+45;    demimurApersorv=23.64+30; demimurBpersorv=23.64+30;

        } else if (this.dimensions == '4x6') {
          //-----------------------------------------------------------------4x6
          rodzaj = "Tente 4x6";
          this.prodref = "20170265";

          structure=530;        barredmA=50;              barredmB=25;            canopi=155;
          mur=61;	              demimurA=24;              demimurB=12;
          murperso=70.52+50;    demimurAperso=15.58+30;   demimurBperso=15.58+30; frontonperso=33.51+20;
          murpersorv=141+55;    demimurApersorv=31.16+35; demimurBpersorv=31.16+35;
        }

        ///////////////////////////////////////////////////////////////// CALCUL
        //--------------------------------- prix de base: structure + mur + toit

        cena = (structure+canopi+mur)*1.5*this.qte;

        //------------------------------- prix structure en fonction des options

        if      (this.choixMurs == '1x Demi-mur')              cena+= (demimurA+barredmA)*1.5*this.qte;
        else if (this.choixMurs == '2x Demi-mur')              cena+= (demimurA+barredmA+demimurA+barredmB)*1.5*this.qte;
        else if (this.choixMurs == '1x Mur sup')               cena+= (mur)*1.5*this.qte;
        else if (this.choixMurs == '2x Mur sup')               cena+= (mur+mur)*1.5*this.qte;
        else if (this.choixMurs == '1x Mur sup + 1x Demi-mur') cena+= (mur+demimurA+barredmA)*1.5*this.qte;
        else if (this.choixMurs == 'sans mur')                 cena = (structure+canopi)*1.5*this.qte;

        //------------------------------------------------ prix impression recto

        if (this.impression == 'Mur de fond')                                                                 cena+= (murperso)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs' && this.choixMurs == '1x Demi-mur')                  cena+= (murperso+demimurAperso)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs' && this.choixMurs == '2x Demi-mur')                  cena+= (murperso+demimurAperso+demimurAperso)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs' && this.choixMurs == '1x Mur sup')                   cena+= (murperso+murperso)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs' && this.choixMurs == '2x Mur sup')                   cena+= (murperso+murperso+murperso)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs' && this.choixMurs == '1x Mur sup + 1x Demi-mur')     cena+= (murperso+murperso+demimurAperso)*2.5*this.qte;
        if (this.impression == 'Fronton')                                                             cena+= (frontonperso)*2.5*this.qte;
        if (this.impression == 'Full Graphic' && this.choixMurs == 'sans option')                     cena+= (frontonperso+murperso)*2.5*this.qte;
        if (this.impression == 'Full Graphic' && this.choixMurs == '1x Mur sup')                      cena+= (frontonperso+murperso+murperso)*2.5*this.qte;
        if (this.impression == 'Full Graphic' && this.choixMurs == '2x Mur sup')                      cena+= (frontonperso+murperso+murperso+murperso)*2.5*this.qte;
      	if (this.impression == 'Full Graphic' && this.choixMurs == '1x Demi-mur')       	            cena+= (frontonperso+murperso+demimurAperso)*2.5*this.qte;
        if (this.impression == 'Full Graphic' && this.choixMurs == '2x Demi-mur')                     cena+= (frontonperso+murperso+demimurAperso+demimurAperso)*2.5*this.qte;
        if (this.impression == 'Full Graphic' && this.choixMurs == '1x Mur sup + 1x Demi-mur')        cena+= (frontonperso+murperso+murperso+demimurAperso)*2.5*this.qte;

  		  //------------------------------------------ prix impression recto verso

        if (this.impression == 'Mur de fond R/V')                                                             cena+= (murpersorv)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs R/V' && this.choixMurs == '1x Demi-mur')       	      cena+= (murpersorv+demimurApersorv)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs R/V' && this.choixMurs == '2x Demi-mur')       	      cena+= (murpersorv+demimurApersorv+demimurApersorv)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs R/V' && this.choixMurs == '1x Mur sup')               cena+= (murpersorv+murpersorv)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs R/V' && this.choixMurs == '2x Mur sup')               cena+= (murpersorv+murpersorv+murpersorv)*2.5*this.qte;
        if (this.impression == 'Murs et demi-murs R/V' && this.choixMurs == '1x Mur sup + 1x Demi-mur') cena+= (murpersorv+murpersorv+demimurApersorv)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == 'sans mur')                    cena+= (frontonperso)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == 'sans option')        	        cena+= (frontonperso+murpersorv)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == '1x Mur sup')       	          cena+= (frontonperso+murpersorv+murpersorv)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == '2x Mur sup')       	          cena+= (frontonperso+murpersorv+murpersorv+murpersorv)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == '1x Demi-mur')        	        cena+= (frontonperso+murpersorv+demimurApersorv)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == '2x Demi-mur')        	        cena+= (frontonperso+murpersorv+demimurApersorv+demimurApersorv)*2.5*this.qte;
        if (this.impression == 'Full Graphic R/V' && this.choixMurs == '1x Mur sup + 1x Demi-mur')    cena+= (frontonperso+murpersorv+murpersorv+demimurApersorv)*2.5*this.qte;

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          cena += this.$global.maqFB3/this.qte;
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
        } else {
          cena+= 39*this.qte; // prix transport
        }

        if (this.relais == true) {
          cena += this.$global.livREL/this.qte;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= this.$global.livREV;}
          this.optliv = ' / colis revendeur';
        }

        // -------------------------------------------------------- PRIX PRODUIT
        prixunite = cena/this.qte;
        cena = prixunite*this.qte;
        prixunite = fixstr(prixunite);
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------ PRIX LIVRAISON

        if (this.delaiprod && this.delailiv){
          var ProdPercent = '';
          var DeliPercent = '';

          if      (this.delaiprod == '2-3') ProdPercent = 25;
          else if (this.delaiprod == '1-1') ProdPercent = 40;
          else                              ProdPercent = 0;

          if      (this.delailiv == '2-3')  DeliPercent = 25;
          else if (this.delailiv == '1-1')  DeliPercent = 40;
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

        } else if (this.choixMurs == 'choisir les options') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez les options';

        } else if (this.choixPrint == 'choisir une personnalisation') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une personnalisation';

        } else if (this.choixMaqt == 'votre maquette (fichier d\'impression)') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option maquette';

        }  else if (this.choixSign == 'logo france banderole ?') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option signature';

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
          var desc = '';
          if      (this.choixMurs == '1x Demi-mur')              desc = 'Mur fond + 1 demi-mur';
          else if (this.choixMurs == '2x Demi-mur')              desc = 'Mur fond + 2 demi-murs';
          else if (this.choixMurs == '1x Mur sup')               desc = 'Mur fond + 1 mur latéral';
          else if (this.choixMurs == '2x Mur sup')               desc = 'Mur fond + 2 murs latéraux';
          else if (this.choixMurs == '1x Mur sup + 1x Demi-mur') desc = 'Mur fond + 1 mur latéral + 1 demi-mur';
          else if (this.choixMurs == 'sans option')              desc = 'Mur fond seulement';
          else if (this.choixMurs == 'sans mur')                 desc = 'Aucun mur';

          // ---------------------------------------- données envoyées au panier
          var dprod = this.delaiprod;  if (this.delaiprod == '1-1') dprod = '1';
          var dliv  = this.delailiv;   if (this.delailiv  == '1-1') dliv  = '1';

          if (this.impression == 'Pas de personnalisation') {
            this.inputDesc = '- '+this.produit+'<br>- '+desc+'<br>- Personnalisation '+this.impression+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';
          } else {
            this.inputDesc = '- '+this.produit+'<br>- '+desc+'<br>- Personnalisation '+this.impression+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';
          }

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
