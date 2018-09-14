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
      choixProd : 'choisir votre modèle de roll-up',
      choixSize : 'choisir les dimensions',
      choixSupp : 'choisir le support',
      choixMaqt : 'votre maquette (fichier d\'impression)',
      choixSign : 'logo france banderole ?',
      qte: 1,
      adresse: true,
      atelier: false,
      relais: false,
      colis: false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes
      reqProd: 'required',
      reqSize: '',
      reqSupp: '',
      reqMaqt: '',
      reqSign: '',
      reqQtte: '',
      reqEstm: '',

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
      toggleMaqt: true,
      toggleSign: true,

      firstSize: false,
      bestSize: false,
      luxSize: false,
      doubleSize: false,
      miniSize: false,
      mistralSize: false,
      choixSupport: false,

      selectFirst: false,

      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,

      // options individuelles
      notfirst: false,
      opeco: false,
      opcapo: false,

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
      calqueVideo: false,
      calqueImage: false,
      calqueContent: '',
      zi: '',
      ifvid: '',
      detImg: '',

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
      estdate: '',
      forfait: '',
      message: 'livraison comprise',
      erreurType: 0,
      errorMessage: '',
      errorColor: '',
      prixUnit: '-',
      prixOption: '-',
      prixTotal: '-',
      translateX: Number

  }, // fin DATA


  //---------------------------------------------------------------------------------------------//
  //              2-  MOUNTED (fonctions à passer avant modifications de la vue)                 //
  //---------------------------------------------------------------------------------------------//

  mounted: function () {
      //window.addEventListener('mousemove', this.panImg);

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
        this.dimensions = this.support = ''; // on réinitialise les valeurs liées support & size au changement de produit
        this.choixSupport = false;
        this.firstSize = this.bestSize = this.luxSize = this.doubleSize = this.miniSize = this.mistralSize = false;
        this.details = '';

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        //this.bg0 = {backgroundImage: 'url('+this.$global.img+'/roll-up/bg.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        // ----------------------------------------------------------- FIRSTLINE
        if (this.produit == 'firstline') {
          // afficher/masquer les champs
          this.firstSize = true;
          this.bestSize = this.luxSize = this.doubleSize = this.miniSize = this.mistralSize = false;

          // afficher/masquer les images

          this.calqueVideo = false;
          this.calqueImage = true;
          this.detImg = this.$global.img+'/roll-up/det1.jpg';

          this.selectFirst = true;


        // ------------------------------------------------------------ BESTLINE
        }else if(this.produit == 'bestline') {
          // afficher/masquer les champs
          this.bestSize = true;
          this.firstSize = this.luxSize = this.doubleSize = this.miniSize = this.mistralSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/2best.png)'};

        // ------------------------------------------------------------- LUXLINE
        }else if (this.produit == 'luxline') {
          // afficher/masquer les champs
          this.luxSize = true;
          this.firstSize = this.bestSize = this.doubleSize = this.miniSize = this.mistralSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/3lux.png)'};

        // -------------------------------------------------------------- DOUBLE
        }else if (this.produit == 'double') {
          // afficher/masquer les champs
          this.doubleSize = true;
          this.firstSize = this.bestSize = this.luxSize = this.miniSize = this.mistralSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/4double.png)'};

        // ---------------------------------------------------------------- MINI
        }else if (this.produit == 'mini') {
          // afficher/masquer les champs
          this.miniSize = true;
          this.firstSize = this.bestSize = this.luxSize = this.doubleSize = this.mistralSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/mini.png)'};

        // ------------------------------------------------------------- MISTRAL
        }else if (this.produit == 'mistral') {
          // afficher/masquer les champs
          this.mistralSize = true;
          this.firstSize = this.bestSize = this.luxSize = this.doubleSize = this.miniSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/mistral200.png)'};

        // -------------------------------------------------------------- VISUEL
        }else if (this.produit == 'visuel') {
          // afficher/masquer les champs
          this.bestSize = true; // mêmes options size que pour le bestilne
          this.firstSize = this.luxSize = this.doubleSize = this.miniSize = this.mistralSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/visuel.png)'};
        }

        // afficher le champ suivant et indiquer qu'il est requis :
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

        this.prH = false;          // cacher preview
        this.pr2 = true;           // calque dimensions activé

        if (this.produit == 'firstline') { // cas particulier firstline: 1 seul chois support et dimensions
          // afficher/masquer les champs
          this.choixSupport = true;
          this.notfirst = this.opeco = this.opcapo = false;

        }else if (this.produit == 'mini' || this.produit == 'mistral'){ // cas particulier mini & mistral : pas de choix support
          // afficher/masquer les champs
          this.support = 'na';
          this.choixSupport = false;
          this.showMaqt = true;

        }else{
          // afficher/masquer les champs
          this.choixSupport = true;
          this.notfirst = this.opeco = this.opcapo = true;

          // afficher/masquer les images
          if (this.dimensions == "100x200" || this.dimensions == "120x200" || this.dimensions == "150x200" || this.dimensions == "200x200") {
            if (this.produit == 'bestline') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/2best80.png)'};
            if (this.produit == 'luxline') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/3lux80.png)'};
            if (this.produit == 'double') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/4double80.png)'};

          }else{
            if (this.produit == 'bestline') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/2best.png)'};
            if (this.produit == 'luxline') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/3lux.png)'};
            if (this.produit == 'double') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/roll-up/4double.png)'};
          }

          if(this.dimensions == "150x200" || this.dimensions == "150x200") this.opcapo = false;
          if(this.dimensions == "200x200") this.opcapo = this.opeco = false;

        }

        // afficher le champ suivant et indiquer qu'il est requis :
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

    // fonction affichage détails images :
    //==========================================================================
    selectImg: function(value) {
      var v = this.$refs.vidElm;

      if (value == 'detv') {
        this.calqueImage = false;
        this.calqueVideo = true;
        v.play();

      } else {
        this.detImg = this.$global.img+'/roll-up/'+value+'.jpg';
        this.calqueImage = true;
        this.calqueVideo = false;
        v.pause();
      }

      this.pr2 = this.pr3 = this.pr4 = this.pr5 = false;
    },

    // fonction affichage détails images :
    //==========================================================================
    zoomIn: function() {
        this.zi = {
          transform: 'scale(2)',
          transition: '0.5s'
        };
    },

    // fonction affichage détails images :
    //==========================================================================
    zoomOut: function() {
        this.zi = {
          transform: 'scale(1)',
          top:  0,
          left: 0,
          transition: '0.5s'

        };
    },

    // fonction affichage détails images :
    //==========================================================================
    panImg: function(event) {
/*        x = event.clientX;
        y = event.clientY;
        console.log(x);
        console.log(y);

        var offsetElt = document.getElementById('zoomImg');
        offsetElt.style.top = (y + 20) + 'px';
        offsetElt.style.left = (x + 20) + 'px';*/
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
        //this.bg0 = {backgroundImage: 'url('+this.$global.img+'/roll-up/bg.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/roll-up/'+src+'.jpg)'};
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

      //this.bg0 = {backgroundImage: 'url('+this.$global.img+'/roll-up/bg.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/roll-up/'+src+'.png)'};
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
        var perteH             = 0; 	var perteL   = 0;
        var h1                 = 0; 	var h2       = 0;
        var l1                 = 0; 	var l2       = 0;
        var metragefinal       = 0;
        var cenatotal          = '';
        var metraz             = 0;   var image;
        var metrazzaokraglony  = 0;
        var metrazzaokraglony1 = 0;
        var poids              = '';  // poids total
        var p1                 = '';  // poids du support
        var p2                 = '';  // poids du structure
        var metrage            = 0;
        var structure          = 0;
        var fp                 = '';
        var pu              	 = 0;
        var cena               = 0;    var prixunite  = 0;
        var rabat              = 0;
        var suma               = 0;
        var finalPrice         = '';   var finalPrice1 = '';  var finalPrice2 = '';
        var option             = '';

        // ----------------------------------------------------------- FIRSTLINE

        if (this.produit == 'firstline') {
          if (this.qte < 7) {cena=24;}
          if (this.qte >= 7 && this.qte <= 24) {cena=24;}
          if (this.qte >= 25 && this.qte <= 48) {cena=24;}
          if (this.qte >= 49 && this.qte <= 108) {cena=23;}
          if (this.qte >= 109 && this.qte <= 216) {cena=22.5;}
          if (this.qte >= 217) {cena=22;}

          this.hauteur = 200;
          this.largeur = 80;
          this.prodref = '20170100';
        }

        // ------------------------------------------------------------ BESTLINE

        //----------------------------------------------------------------60x200
        if (this.produit == 'bestline' && this.dimensions == '60x200') {
          if (this.qte < 7) {cena=42;}
          if (this.qte >= 7 && this.qte <= 24) {cena=41;}
          if (this.qte >= 25 && this.qte <= 48) {cena=40;}
          if (this.qte >= 49 && this.qte <= 108) {cena=39;}
          if (this.qte >= 109 && this.qte <= 216) {cena=38;}
          if (this.qte >= 217) {cena=37;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 4;}
          if (this.support == '100% écologique M1') {cena += 11;}
          if (this.support == 'capotoile') {cena += 11*1.3;}

          this.hauteur = 200;
          this.largeur = 60;
          this.prodref = '20170102';
        }

        //----------------------------------------------------------------60x160
        if (this.produit == 'bestline' && this.dimensions == '60x160') {
          if (this.qte < 7) {cena=41;}
          if (this.qte >= 7 && this.qte <= 24) {cena=40;}
          if (this.qte >= 25 && this.qte <= 48) {cena=39;}
          if (this.qte >= 49 && this.qte <= 108) {cena=38;}
          if (this.qte >= 109 && this.qte <= 216) {cena=37;}
          if (this.qte >= 217) {cena=34;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 4;}
          if (this.support == '100% écologique M1') {cena += 10;}
          if (this.support == 'capotoile') {cena += 11*1.3;}

          this.hauteur = 160;
          this.largeur = 60;
          this.prodref = '20170101';
        }

        //----------------------------------------------------------------80x200
        if (this.produit == 'bestline' && this.dimensions == '80x200') {
          if (this.qte < 7) {cena=44;}
          if (this.qte >= 7 && this.qte <= 24) {cena=43;}
          if (this.qte >= 25 && this.qte <= 48) {cena=42;}
          if (this.qte >= 49 && this.qte <= 108) {cena=41;}
          if (this.qte >= 109 && this.qte <= 216) {cena=39;}
          if (this.qte >= 217) {cena=37;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 5;}
          if (this.support == '100% écologique M1') {cena += 12;}
          if (this.support == 'capotoile') {cena += 12*1.3;}

          this.hauteur = 200;
          this.largeur = 80;
          this.prodref = '20170103';
        }

        //----------------------------------------------------------------85x200
        if (this.produit == 'bestline' && this.dimensions == '85x200') {
          if (this.qte < 7) {cena=46;}
          if (this.qte >= 7 && this.qte <= 24) {cena=45;}
          if (this.qte >= 25 && this.qte <= 48) {cena=44;}
          if (this.qte >= 49 && this.qte <= 108) {cena=43;}
          if (this.qte >= 109 && this.qte <= 216) {cena=42;}
          if (this.qte >= 217) {cena=39;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 6;}
          if (this.support == '100% écologique M1') {cena += 12;}
          if (this.support == 'capotoile') {cena += 12*1.3;}

          this.hauteur = 200;
          this.largeur = 85;
          this.prodref = '20170103';
        }

        //---------------------------------------------------------------100x200
        if (this.produit == 'bestline' && this.dimensions == '100x200') {
          if (this.qte < 7) {cena=59;}
          if (this.qte >= 7 && this.qte <= 24) {cena=58;}
          if (this.qte >= 25 && this.qte <= 48) {cena=57;}
          if (this.qte >= 49 && this.qte <= 108) {cena=56;}
          if (this.qte >= 109 && this.qte <= 216) {cena=55;}
          if (this.qte >= 217) {cena=52;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 7;}
          if (this.support == '100% écologique M1') {cena += 13;}
          if (this.support == 'capotoile') {cena += 13*1.3;}

          this.hauteur = 200;
          this.largeur = 100;
          this.prodref = '20170105';
        }

        //---------------------------------------------------------------120x200
        if (this.produit == 'bestline' && this.dimensions == '120x200') {
          if (this.qte < 7) {cena=80;}
          if (this.qte >= 7 && this.qte <= 24) {cena=79;}
          if (this.qte >= 25 && this.qte <= 48) {cena=78;}
          if (this.qte >= 49 && this.qte <= 108) {cena=77;}
          if (this.qte >= 109 && this.qte <= 216) {cena=75;}
          if (this.qte >= 217) {cena=74;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 8;}
          if (this.support == '100% écologique M1') {cena += 16;}
          if (this.support == 'capotoile') {cena += 16*1.3;}

          this.hauteur = 200;
          this.largeur = 120;
          this.prodref = '20170106';
        }

        //---------------------------------------------------------------150x200
        if (this.produit == 'bestline' && this.dimensions == '150x200') {
          if (this.qte < 7) {cena=94;}
          if (this.qte >= 7 && this.qte <= 24) {cena=93;}
          if (this.qte >= 25 && this.qte <= 48) {cena=92;}
          if (this.qte >= 49 && this.qte <= 108) {cena=91;}
          if (this.qte >= 109 && this.qte <= 216) {cena=89;}
          if (this.qte >= 217) {cena=88;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 10;}
          if (this.support == '100% écologique M1') {cena += 18;}
          if (this.support == 'capotoile') {cena += 18*1.3;}

          this.hauteur = 200;
          this.largeur = 150;
          this.prodref = '20170107';
        }

        //---------------------------------------------------------------200x200
        if (this.produit == 'bestline' && this.dimensions == '200x200') {
          if (this.qte < 7) {cena=169;}
          if (this.qte >= 7 && this.qte <= 24) {cena=168;}
          if (this.qte >= 25 && this.qte <= 48) {cena=167;}
          if (this.qte >= 49 && this.qte <= 108) {cena=166;}
          if (this.qte >= 109 && this.qte <= 216) {cena=163;}
          if (this.qte >= 217) {cena=160;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 20;}

          this.hauteur = 200;
          this.largeur = 200;
          this.prodref = '20170108';
        }

        // ------------------------------------------------------------- LUXLINE

        //----------------------------------------------------------------80x200
        if (this.produit == 'luxline' && this.dimensions == '80x200'){
          if (this.qte < 7) {cena=84;}
          if (this.qte >= 7 && this.qte <= 24) {cena=83;}
          if (this.qte >= 25 && this.qte <= 48) {cena=82;}
          if (this.qte >= 49 && this.qte <= 108) {cena=81;}
          if (this.qte >= 109 && this.qte <= 216) {cena=79;}
          if (this.qte >= 217) {cena=78;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 4;}
          if (this.support == '100% écologique M1') {cena += 11;}
          if (this.support == 'capotoile') {cena += 11*1.3;}

          this.hauteur = 200;
          this.largeur = 80;
          this.prodref = '20170110';
        }

        //---------------------------------------------------------------100x200
        if (this.produit == 'luxline' && this.dimensions == '100x200'){
          if (this.qte < 7) {cena=104;}
          if (this.qte >= 7 && this.qte <= 24) {cena=103;}
          if (this.qte >= 25 && this.qte <= 48) {cena=102;}
          if (this.qte >= 49 && this.qte <= 108) {cena=101;}
          if (this.qte >= 109 && this.qte <= 216) {cena=99;}
          if (this.qte >= 217) {cena=98;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 5;}
          if (this.support == '100% écologique M1') {cena += 12;}
          if (this.support == 'capotoile') {cena += 12*1.3;}

          this.hauteur = 200;
          this.largeur = 100;
          this.prodref = '20170111';
        }

        //---------------------------------------------------------------120x200
        if (this.produit == 'luxline' && this.dimensions == '120x200'){
          if (this.qte < 7) {cena=126;}
          if (this.qte >= 7 && this.qte <= 24) {cena=125;}
          if (this.qte >= 25 && this.qte <= 48) {cena=124;}
          if (this.qte >= 49 && this.qte <= 108) {cena=123;}
          if (this.qte >= 109 && this.qte <= 216) {cena=122;}
          if (this.qte >= 217) {cena=121;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 8;}
          if (this.support == '100% écologique M1') {cena += 16;}
          if (this.support == 'capotoile') {cena += 16*1.3;}

          this.hauteur = 200;
          this.largeur = 120;
          this.prodref = '20170112';
        }

        //---------------------------------------------------------------150x200
        if (this.produit == 'luxline' && this.dimensions == '150x200'){
          if (this.qte < 7) {cena=165;}
          if (this.qte >= 7 && this.qte <= 24) {cena=164;}
          if (this.qte >= 25 && this.qte <= 48) {cena=163;}
          if (this.qte >= 49 && this.qte <= 108) {cena=162;}
          if (this.qte >= 109 && this.qte <= 216) {cena=161;}
          if (this.qte >= 217) {cena=160;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 12;}
          if (this.support == '100% écologique M1') {cena += 20;}
          if (this.support == 'capotoile') {cena += 20*1.3;}

          this.hauteur = 200;
          this.largeur = 150;
          this.prodref = '20170113';
        }

        //---------------------------------------------------------------200x200
        if (this.produit == 'luxline' && this.dimensions == '200x200'){
          if (this.qte < 7) {cena=219;}
          if (this.qte >= 7 && this.qte <= 24) {cena=218;}
          if (this.qte >= 25 && this.qte <= 48) {cena=217;}
          if (this.qte >= 49 && this.qte <= 108) {cena=216;}
          if (this.qte >= 109 && this.qte <= 216) {cena=215;}
          if (this.qte >= 217) {cena=214;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 40;}

          this.hauteur = 200;
          this.largeur = 200;
          this.prodref = '20170114';
        }

        // -------------------------------------------------------------- DOUBLE

        //----------------------------------------------------------------80x200
        if (this.produit == 'double' && this.dimensions == '80x200'){
          if (this.qte < 7) {cena=90;}
          if (this.qte >= 7 && this.qte <= 24) {cena=89;}
          if (this.qte >= 25 && this.qte <= 48) {cena=88;}
          if (this.qte >= 49 && this.qte <= 108) {cena=87;}
          if (this.qte >= 109 && this.qte <= 216) {cena=85;}
          if (this.qte >= 217) {cena=83;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 8;}
          if (this.support == '100% écologique M1') {cena += 20;}
          if (this.support == 'capotoile') {cena += 20*1.3;}

          this.hauteur = 200;
          this.largeur = 80;
          this.prodref = '20170120';
          this.details = 'recto-verso';
        }

        //----------------------------------------------------------------85x200
        if (this.produit == 'double' && this.dimensions == '85x200'){
          if (this.qte < 7) {cena=104;}
          if (this.qte >= 7 && this.qte <= 24) {cena=103;}
          if (this.qte >= 25 && this.qte <= 48) {cena=101;}
          if (this.qte >= 49 && this.qte <= 108) {cena=100;}
          if (this.qte >= 109 && this.qte <= 216) {cena=99;}
          if (this.qte >= 217) {cena=97;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 12;}
          if (this.support == '100% écologique M1') {cena += 22;}
          if (this.support == 'capotoile') {cena += 22*1.3;}

          this.hauteur = 200;
          this.largeur = 85;
          this.prodref = '20170120';
          this.details = 'recto-verso';
        }

        //---------------------------------------------------------------100x200
        if (this.produit == 'double' && this.dimensions == '100x200'){
          if (this.qte < 7) {cena=135;}
          if (this.qte >= 7 && this.qte <= 24) {cena=134;}
          if (this.qte >= 25 && this.qte <= 48) {cena=133;}
          if (this.qte >= 49 && this.qte <= 108) {cena=132;}
          if (this.qte >= 109 && this.qte <= 216) {cena=130;}
          if (this.qte >= 217) {cena=129;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena += 15;}
          if (this.support == '100% écologique M1') {cena += 28;}
          if (this.support == 'capotoile') {cena += 28*1.3;}

          this.hauteur = 200;
          this.largeur = 100;
          this.prodref = '20170121';
          this.details = 'recto-verso';
        }

        // ---------------------------------------------------------------- MINI

        if (this.dimensions == 'A4'){
          cena=24;
          this.hauteur = 29.7;
          this.largeur = 21;
          this.prodref = '20170115';
        }

        if (this.dimensions == 'A3'){
          cena=29;
          this.hauteur = 42;
          this.largeur = 29.7;
          this.prodref = '20170116';
        }

        // -------------------------------------------------------------- VISUEL

        //----------------------------------------------------------------60x160
        if ((this.produit == 'visuel') && (this.dimensions == '60x160')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=8.52;}
          if (this.qte >= 2 && this.qte <= 3) {cena=8.43;}
          if (this.qte >= 4 && this.qte <= 6) {cena=8.35;}
          if (this.qte >= 7 && this.qte <= 24) {cena=8.18;}
          if (this.qte >= 25 && this.qte <= 48) {cena=7.75;}
          if (this.qte >= 49 && this.qte <= 108) {cena=7.50;}
          if (this.qte >= 109 && this.qte <= 216) {cena=7.16;}
          if (this.qte >= 217) {cena=6.90;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 160;
          this.largeur = 60;
          this.prodref = '20170190';
        }
        //----------------------------------------------------------------60x200
        if ((this.produit == 'visuel') && (this.dimensions == '60x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=11.13;}
          if (this.qte >= 2 && this.qte <= 3) {cena=10.91;}
          if (this.qte >= 4 && this.qte <= 6) {cena=10.80;}
          if (this.qte >= 7 && this.qte <= 24) {cena=10.57;}
          if (this.qte >= 25 && this.qte <= 48) {cena=10.13;}
          if (this.qte >= 49 && this.qte <= 108) {cena=9.68;}
          if (this.qte >= 109 && this.qte <= 216) {cena=9.24;}
          if (this.qte >= 217) {cena=8.90;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 60;
          this.prodref = '20170191';
        }

        //----------------------------------------------------------------80x200
        if ((this.produit == 'visuel') && (this.dimensions == '80x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=11.35;}
          if (this.qte >= 2 && this.qte <= 3) {cena=11.24;}
          if (this.qte >= 4 && this.qte <= 6) {cena=11.01;}
          if (this.qte >= 7 && this.qte <= 24) {cena=10.78;}
          if (this.qte >= 25 && this.qte <= 48) {cena=10.22;}
          if (this.qte >= 49 && this.qte <= 108) {cena=9.76;}
          if (this.qte >= 109 && this.qte <= 216) {cena=9.42;}
          if (this.qte >= 217) {cena=9.08;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 80;
          this.prodref = '20170192';
        }

        //----------------------------------------------------------------85x200
        if ((this.produit == 'visuel') && (this.dimensions == '85x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=15.61;}
          if (this.qte >= 2 && this.qte <= 3) {cena=15.29;}
          if (this.qte >= 4 && this.qte <= 6) {cena=15.14;}
          if (this.qte >= 7 && this.qte <= 24) {cena=14.82;}
          if (this.qte >= 25 && this.qte <= 48) {cena=14.03;}
          if (this.qte >= 49 && this.qte <= 108) {cena=13.24;}
          if (this.qte >= 109 && this.qte <= 216) {cena=12.93;}
          if (this.qte >= 217) {cena=12.46;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 85;
          this.prodref = '20170193';
        }

        //---------------------------------------------------------------100x200
        if ((this.produit == 'visuel') && (this.dimensions == '100x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=16.22;}
          if (this.qte >= 2 && this.qte <= 3) {cena=15.89;}
          if (this.qte >= 4 && this.qte <= 6) {cena=15.73;}
          if (this.qte >= 7 && this.qte <= 24) {cena=15.40;}
          if (this.qte >= 25 && this.qte <= 48) {cena=14.42;}
          if (this.qte >= 49 && this.qte <= 108) {cena=13.76;}
          if (this.qte >= 109 && this.qte <= 216) {cena=13.27;}
          if (this.qte >= 217) {cena=12.78;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 100;
          this.prodref = '20170194';
        }

        //---------------------------------------------------------------120x200
        if ((this.produit == 'visuel') && (this.dimensions == '120x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=22.04;}
          if (this.qte >= 2 && this.qte <= 3) {cena=21.37;}
          if (this.qte >= 4 && this.qte <= 6) {cena=21.15;}
          if (this.qte >= 7 && this.qte <= 24) {cena=20.70;}
          if (this.qte >= 25 && this.qte <= 48) {cena=19.37;}
          if (this.qte >= 49 && this.qte <= 108) {cena=18.48;}
          if (this.qte >= 109 && this.qte <= 216) {cena=17.81;}
          if (this.qte >= 217) {cena=17.36;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 120;
          this.prodref = '20170195';
        }

        //---------------------------------------------------------------150x200
        if ((this.produit == 'visuel') && (this.dimensions == '150x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=23.59;}
          if (this.qte >= 2 && this.qte <= 3) {cena=22.64;}
          if (this.qte >= 4 && this.qte <= 6) {cena=22.40;}
          if (this.qte >= 7 && this.qte <= 24) {cena=21.92;}
          if (this.qte >= 25 && this.qte <= 48) {cena=20.49;}
          if (this.qte >= 49 && this.qte <= 108) {cena=19.78;}
          if (this.qte >= 109 && this.qte <= 216) {cena=19.06;}
          if (this.qte >= 217) {cena=18.59;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1') {cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 150;
          this.prodref = '20170196';
        }

        //---------------------------------------------------------------200x200
        if ((this.produit == 'visuel') && (this.dimensions == '200x200')) {
          this.details = '+ 10cm (marge technique)';
          if (this.qte < 2) {cena=30.62;}
          if (this.qte >= 2 && this.qte <= 3) {cena=29.68;}
          if (this.qte >= 4 && this.qte <= 6) {cena=29.37;}
          if (this.qte >= 7 && this.qte <= 24) {cena=28.48;}
          if (this.qte >= 25 && this.qte <= 48) {cena=26.24;}
          if (this.qte >= 49 && this.qte <= 108) {cena=25.62;}
          if (this.qte >= 109 && this.qte <= 216) {cena=24.68;}
          if (this.qte >= 217) {cena=24.37;}

          if (this.support == '440g') {cena += 0;}
          if (this.support == 'jet 520 M1'){cena *= 2.45;}
          if (this.support == '100% écologique M1') {cena *= 2.9;}
          if (this.support == 'capotoile') {cena *= 3.86;}

          this.hauteur = 200;
          this.largeur = 200;
          this.prodref = '20170197';
        }

        // ------------------------------------------------------------- MISTRAL

        if (this.produit == 'mistral'){
          this.details = 'recto-verso';
          // Laise mistral //
          this.largeur=0.8; this.hauteur=2;
          metraz = this.largeur * this.hauteur;
          metraz = fixstr(metraz);
          metrazzaokraglony1 = (this.largeur+this.hauteur)*2;
          metrazzaokraglony = Math.round(metrazzaokraglony1);

          if (this.largeur <= 0.50)                         {l1=0.5; l2=0.5-this.largeur; perteL=l2*this.hauteur;}
          if (this.largeur >= 0.51 && this.largeur <= 0.80) {l1=0.80; l2=0.80-this.largeur; perteL=l2*this.hauteur;}
          if (this.largeur >= 0.81 && this.largeur <= 1.10) {l1=1.10; l2=1.10-this.largeur; perteL=l2*this.hauteur;}
          if (this.largeur >= 1.11 && this.largeur <= 1.37) {l1=1.37; l2=1.37-this.largeur; perteL=l2*this.hauteur;}
          if (this.largeur >= 1.38 && this.largeur <= 1.60) {l1=1.60; l2=1.60-this.largeur; perteL=l2*this.hauteur;}
          if (this.largeur >= 1.61 && this.largeur <= 2)    {l1=2; l2=2-this.largeur; perteL=l2*this.hauteur;}
          if (this.largeur >= 2.01)                         {l1=this.largeur; perteL=this.largeur*this.hauteur;}

          if (this.hauteur <= 0.50){h1=0.5; h2=0.5-this.hauteur; perteH=h2*this.largeur;}
          if ((this.hauteur >= 0.51) && (this.hauteur <= 0.80)){h1=0.80; h2=0.80-this.hauteur; perteH=h2*this.largeur;}
          if ((this.hauteur >= 0.81) && (this.hauteur <= 1.10)){h1=1.10; h2=1.10-this.hauteur; perteH=h2*this.largeur;}
          if ((this.hauteur >= 1.11) && (this.hauteur <= 1.37)){h1=1.37; h2=1.37-this.hauteur; perteH=h2*this.largeur;}
          if ((this.hauteur >= 1.38) && (this.hauteur <= 1.60)){h1=1.60; h2=1.60-this.hauteur; perteH=h2*this.largeur;}
          if ((this.hauteur >= 1.61) && (this.hauteur <= 2)){h1=2; h2=2-this.hauteur; perteH=h2*this.largeur;}
          if (this.hauteur >= 2.01){h1=this.hauteur; perteH=this.hauteur*this.largeur;}

          if (perteH < perteL){metrage = this.largeur*h1;}
          else if (perteH > perteL){metrage = this.hauteur*l1;}
          else if(perteH == perteL){metrage = this.hauteur*l1;}

          metragefinal=metrage*this.qte;

          if (metragefinal < 1.99) {cenatotal = metragefinal*15.00;}
          if (metragefinal > 1.99 && metragefinal <= 3.99) {cenatotal = metragefinal*14.80;}
          if (metragefinal > 3.99 && metragefinal <= 5.99) {cenatotal = metragefinal*14.60;}
          if (metragefinal > 5.99 && metragefinal <= 7.99) {cenatotal = metragefinal*14.40;}
          if (metragefinal > 7.99 && metragefinal <= 9.99) {cenatotal = metragefinal*14.20;}
          if (metragefinal > 9.99 && metragefinal <= 13.99) {cenatotal = metragefinal*14.00;}
          if (metragefinal > 13.99 && metragefinal <= 17.99) {cenatotal = metragefinal*13.50;}
          if (metragefinal > 17.99 && metragefinal <= 23.99) {cenatotal = metragefinal*13.25;}
          if (metragefinal > 23.99 && metragefinal <= 29.99) {cenatotal = metragefinal*13.00;}
          if (metragefinal > 29.99 && metragefinal <= 39.99) {cenatotal = metragefinal*12.75;}
          if (metragefinal > 39.99 && metragefinal <= 49.99) {cenatotal = metragefinal*12.50;}
          if (metragefinal > 49.99 && metragefinal <= 59.99) {cenatotal = metragefinal*12.25;}
          if (metragefinal > 59.99 && metragefinal <= 69.99) {cenatotal = metragefinal*12.00;}
          if (metragefinal > 69.99 && metragefinal <= 79.99) {cenatotal = metragefinal*11.75;}
          if (metragefinal > 79.99 && metragefinal <= 89.99) {cenatotal = metragefinal*11.50;}
          if (metragefinal > 89.99 && metragefinal <= 99.99) {cenatotal = metragefinal*11.25;}
          if (metragefinal > 99.99 && metragefinal <= 149.99) {cenatotal = metragefinal*11;}
          if (metragefinal > 149.99 && metragefinal <= 199.99) {cenatotal = metragefinal*10.50;}
          if (metragefinal > 199.99 && metragefinal <= 249.99) {cenatotal = metragefinal*10.00;}
          if (metragefinal > 249.99 && metragefinal <= 299.99) {cenatotal = metragefinal*9.50;}
          if (metragefinal > 299.99 && metragefinal <= 399.99) {cenatotal = metragefinal*9.00;}
          if (metragefinal > 399.99 && metragefinal <= 499.99) {cenatotal = metragefinal*8.50;}
          if (metragefinal > 499.99) {cenatotal = metragefinal*8.00;}
          p1=(metraz*0.55)*this.qte;

          if (this.dimensions == '80x200 1 visuel') {
            structure=86.4*1.8;
            cena=structure+(cenatotal/this.qte);
            p2=3*this.qte;
          }

          if (this.dimensions == '80x200 2 visuels') {
            structure=86.4*1.8;
            cena=structure+((cenatotal*1.5)/this.qte);
            p2=3*this.qte;
          }

          this.hauteur = 200;
          this.largeur = 80;
          this.prodref = '20170122';

          // poids mistral //
          poids=(p1+p2);
          if (poids <= 1) {cena+=(4.80*1.5)/this.qte;}
          if (poids > 1 && poids <= 2) {cena+=(5.1*1.5)/this.qte;}
          if (poids > 2 && poids <= 3) {cena+=(5.67*1.5)/this.qte;}
          if (poids > 3 && poids <= 4) {cena+=(5.63*1.5)/this.qte;}
          if (poids > 4 && poids <= 5) {cena+=(6.88*1.5)/this.qte;}
          if (poids > 5 && poids <= 6) {cena+=(7.99*1.5)/this.qte;}
          if (poids > 6 && poids <= 7) {cena+=(7.99*1.5)/this.qte;}
          if (poids > 7 && poids <= 10) {cena+=(9.30*1.5)/this.qte;}
          if (poids > 10 && poids <= 15) {cena+=(11.93*1.5)/this.qte;}
          if (poids > 15 && poids <= 20) {cena+=(14.93*1.5)/this.qte;}
          if (poids > 20 && poids <= 25) {cena+=(18.82*1.5)/this.qte;}
          if (poids > 25 && poids <= 30) {cena+=(20.56*1.4)/this.qte;}
          if (poids > 30 && poids <= 40) {cena+=(25.64*1.3)/this.qte;}
          if (poids > 40 && poids <= 50) {cena+=(33.73*1.2)/this.qte;}
          if (poids > 50 && poids <= 60) {cena+=(42.14*1.2)/this.qte;}
          if (poids > 60 && poids <= 70) {cena+=(47.71*1.2)/this.qte;}
          if (poids > 70 && poids <= 80) {cena+=(55.26*1.2)/this.qte;}
          if (poids > 80 && poids <= 90) {cena+=(62.12*1.2)/this.qte;}
          if (poids > 90 && poids <= 100) {cena+=(68.54*1.2)/this.qte;}
          if (poids > 100) {cena+=(69.26*1.2)/this.qte;}
        }

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
          cena += 5.00/this.qte;
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

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis

        if     (this.produit    == '') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir un produit';}
        else if(this.dimensions == '') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une dimension';}
        else if(this.support    == '') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir un support';}
        else if(this.maquette   == '') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option maquette';}
        else if(this.sign       == '') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option signature';}
        else if(this.qte < 1 || isNaN(this.qte)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';
        } else {this.reqQtte = '';}

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

              this.prixOption = newoption2;

              suma = 14.90;
              suma = fixstr(suma);
              this.suma2 = suma.replace(".", ",");

              this.prixTotal = this.suma2 +' €' ;

            } else {
              newoption = parseFloat(forfait);
              newoption = fixstr(newoption);
              newoption2 = newoption.replace(".", ",");
              option2 = newoption2;

              this.prixOption = newoption2;

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

          if (this.produit == 'mini' || this.produit == 'mistral') {
            this.details = this.details;
          } else {
            this.details = '<br>- '+this.support+' '+this.details;
          }

          this.inputDesc = '- '+this.produit+' '+this.dimensions+' '+this.details+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'Roll-up';
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
