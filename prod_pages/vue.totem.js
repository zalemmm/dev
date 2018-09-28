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
      choixProd : 'choisir votre modèle de totem',
      choixSize : '',
      choixSupp : '',
      choixMaqt : '',
      choixSign : '',
      choixTopt : '',
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
      reqHaut: '',
      reqTopt: '',

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
      toggleTopt: true,

      xscreenSize: false,
      clipitSize: false,
      tissuSize: false,
      blizzardSize: false,
      photoSize: false,
      mistralSize: false,
      firstSupport: false,
      tissuSupport: false,
      totemOption: false,

      showHaut: false,
      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,
      showEsize: false,
      errorSize: false,

      // options individuelles
      shClip: false,
      optClip: false,
      opeco: true,

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
      hauteur: '',
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
        this.dimensions = this.support = ''; // on réinitialise les valeurs liées support & size au changement de produit
        this.firstSupport = this.tissuSupport = false;
        this.xscreenSize = this.clipitSize = this.tissuSize = this.blizzardSize = this.photoSize = this.mistralSize = this.showHaut = this.totemOption = false;
        this.hauteur = '';
        this.details = '';

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        // ----------------------------------------------------------- x-screen
        if (this.produit == 'x-screen') {
          // afficher/masquer les champs
          this.xscreenSize = true;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/x-screen180.png)'};
          this.choixSize = 'choisir les dimensions';

        // ------------------------------------------------------------ clipit
        }else if(this.produit == 'clipit') {
          // afficher/masquer les champs
          this.clipitSize = true;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/clipit1.png)'};
          this.choixSize = 'choisir la largeur';

        // ------------------------------------------------------------- LUXLINE
        }else if (this.produit == 'Kakemono Tissu') {
          // afficher/masquer les champs
          this.tissuSize = true;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/kakemono-tissu.png)'};
          this.choixSize = 'choisir les dimensions';

        // -------------------------------------------------------------- DOUBLE
        }else if (this.produit == 'Photocall') {
          // afficher/masquer les champs
          this.photoSize = true;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/photocall.png)'};
          this.choixSize = 'choisir les dimensions';

        // -------------------------------------------------------------- VISUEL
        }else if (this.produit == 'Blizzard') {
          // afficher/masquer les champs
          this.blizzardSize = true;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/blizzard200.png)'};
          this.choixSize = 'choisir les dimensions';

        // ---------------------------------------------------------------- MINI
        }else if (this.produit == 'Mistral') {
          // afficher/masquer les champs
          this.mistralSize = true;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/mistral200.png)'};
          this.choixSize = 'choisir les dimensions';

        // -------------------------------------------------------------- VISUEL
        }

        // afficher le champ suivant et indiquer qu'il est requis :

        // afficher le champ suivant et indiquer qu'il est requis :
        this.reqSize = 'required';
        this.toggleSize = true;


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

        if (this.produit == 'x-screen') { // cas particulier x-screen: 1 seul chois support et dimensions

          if (this.dimensions == '60x160') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/x-screen160.png)'};
          if (this.dimensions == '60x180') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/x-screen180.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.firstSupport = true; this.tissuSupport = false;
          this.reqSupp = 'required';
          this.toggleSupp = true;
          this.choixSupp = 'choisir le support';

        } else if (this.produit == 'clipit') { // cas particulier mini & mistral : pas de choix support

          if (this.dimensions == '180' || this.dimensions == '200') this.opeco = false;
          else this.opeco = true;

          // afficher  hauteur personnalisée
          this.firstSupport = false; this.tissuSupport = false;
          this.showHaut = true;
          this.reqHaut = 'required';

        } else if (this.produit == 'Kakemono Tissu') {

          // afficher le champ suivant et indiquer qu'il est requis :
          this.firstSupport = false; this.tissuSupport = true;
          this.reqSupp = 'required';
          this.toggleSupp = true;
          this.choixSupp = 'choisir le support';

        } else if (this.produit == 'Blizzard') {

          if (this.dimensions == '60x160') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/blizzard160.png)'};
          if (this.dimensions == '80x200') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/totem/blizzard200.png)'};

          this.optClip = false;
          this.totemOption = true;
          this.reqTopt = 'required';
          this.toggleTopt = true;
          this.choixTopt = 'choisir une option';

        } else {

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }

    }, // fin fonction choix dimensions


    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectSupport: function(value) {
        this.support = value;     // on attribue la valeur à la variable support
        this.choixSupp = value;   // on attribue la valeur au champ de titre support
        this.toggleSupp = false;  // on replie le menu à la sélection
        this.reqSupp = '';        // on rétablit les styles du champ à "non requis"

        if (this.produit == 'clipit') {
          this.optClip = true;
          this.totemOption = true;
          this.reqTopt = 'required';
          this.toggleTopt = true;
          this.choixTopt = 'choisir une option';

        } else {
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    },

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectOpt: function(value) {
        this.choixTopt = value;
        this.toggleTopt = false;
        this.reqTopt = '';

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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/totem/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/totem/'+src+'.png)'};
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

        this.firstSupport = true;
        this.shClip = true;
        this.reqSupp = 'required';
        this.toggleSupp = true;
        this.choixSupp = 'choisir le support';
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

        this.ajoutPanier   = true;
        this.livraisonComp = true;
        this.dateTrigger   = !this.dateTrigger;

        //------------------------------------------- variables de calcul panier
        var metrage            = 0;
        var structure          = 0;
        var cena               = 0;     var cena2   = 0;     var prixunite   = 0;
        var rabat              = 0;
        var suma               = 0;     var suma2   = 0;
        var transport          = 0;
        var designation        = '';    var produit = '';    var details     = '';
        var optliv             = '';
        var prliv              = '';
        var option             = '';
        var perteH             = 0;    var perteL  = 0;
        var h1                 = 0;    var h2      = 0;
        var l1                 = 0;    var l2      = 0;
        var metragefinal       = 0;
        var cenatotal          = '';
        var metraz             = 0;
        var metrazzaokraglony  = 0;
        var metrazzaokraglony1 = 0;
        var largeur            = 0;
        var hauteur            = 0;
        var prixsupport        = 0;
        var poids              = '';                                           ////poids total
        var p1                 = '';                                           ////poids du support
        var p2                 = '';                                           ////poids du structure
        var prixproduit        = 0;
        var prixtotal          = 0;
        var imp		             = 0;//// prix impression
        var m2		             = 0;//// m2
        var pm2		             = 0; ////prix m2
        var tissu		           = 0;
        var pa		             = 0;

        ////////////////////////////////////////////////////////////////// Laize

        if (this.dimensions == '60x160')  {largeur = 0.6; hauteur = 1.6;}
        if (this.dimensions == '80x200')  {largeur = 0.8; hauteur = 2;}
        if (this.dimensions == '60x160')  {largeur = 0.6; hauteur = 1.6;}
        if (this.dimensions == '80x180')  {largeur = 0.8; hauteur = 1.8;}
        if (this.produit    == 'Mistral') {largeur = 0.8; hauteur = 2;}
        if (this.produit    == 'clipit')   largeur = this.dimensions/100;
        if (this.produit    == 'clipit')   hauteur = this.hauteur/100;

        metraz = largeur * hauteur;
        metraz = fixstr(metraz);
        metrazzaokraglony1 = (largeur+hauteur)*2;
        metrazzaokraglony = Math.round(metrazzaokraglony1);

        if (largeur <= 0.50) {l1=0.5; l2=0.5-largeur; perteL=l2*hauteur;}
        if (largeur >= 0.51 && largeur <= 0.80) {l1=0.80; l2=0.80-largeur; perteL=l2*hauteur;}
        if (largeur >= 0.81 && largeur <= 1.10) {l1=1.10; l2=1.10-largeur; perteL=l2*hauteur;}
        if (largeur >= 1.11 && largeur <= 1.37) {l1=1.37; l2=1.37-largeur; perteL=l2*hauteur;}
        if (largeur >= 1.38 && largeur <= 1.60) {l1=1.60; l2=1.60-largeur; perteL=l2*hauteur;}
        if (largeur >= 1.61 && largeur <= 2)    {l1=2; l2=2-largeur; perteL=l2*hauteur;}
        if (largeur >= 2.01) {l1=largeur; perteL=largeur*hauteur;}

        if (hauteur <= 0.50) {h1=0.5; h2=0.5-hauteur; perteH=h2*largeur;}
        if (hauteur >= 0.51 && hauteur <= 0.80) {h1=0.80; h2=0.80-hauteur; perteH=h2*largeur;}
        if (hauteur >= 0.81 && hauteur <= 1.10) {h1=1.10; h2=1.10-hauteur; perteH=h2*largeur;}
        if (hauteur >= 1.11 && hauteur <= 1.37) {h1=1.37; h2=1.37-hauteur; perteH=h2*largeur;}
        if (hauteur >= 1.38 && hauteur <= 1.60) {h1=1.60; h2=1.60-hauteur; perteH=h2*largeur;}
        if (hauteur >= 1.61 && hauteur <= 2)    {h1=2; h2=2-hauteur; perteH=h2*largeur;}
        if (hauteur >= 2.01) {h1=hauteur; perteH=hauteur*largeur;}

        if (perteH < perteL) {metrage = largeur*h1;}
        else if (perteH > perteL) {metrage = hauteur*l1;}
        else if(perteH == perteL) {metrage = hauteur*l1;}

        metragefinal=metrage*this.qte;

        ////////////////////////////////////////////////////////////////// 440gr
        if (this.support == 'bache 440g') {

          if ( metragefinal < 1.99)   {cenatotal = metragefinal*10.75;}
          if ((metragefinal > 1.99)   && (metragefinal <= 3.99))   {cenatotal = metragefinal*10.50;}
          if ((metragefinal > 3.99)   && (metragefinal <= 5.99))   {cenatotal = metragefinal*10.25;}
          if ((metragefinal > 5.99)   && (metragefinal <= 7.99))   {cenatotal = metragefinal*10.00;}
          if ((metragefinal > 7.99)   && (metragefinal <= 9.99))   {cenatotal = metragefinal*9.80;}
          if ((metragefinal > 9.99)   && (metragefinal <= 13.99))  {cenatotal = metragefinal*9.70;}
          if ((metragefinal > 13.99)  && (metragefinal <= 17.99))  {cenatotal = metragefinal*9.60;}
          if ((metragefinal > 17.99)  && (metragefinal <= 23.99))  {cenatotal = metragefinal*9.50;}
          if ((metragefinal > 23.99)  && (metragefinal <= 29.99))  {cenatotal = metragefinal*9.40;}
          if ((metragefinal > 29.99)  && (metragefinal <= 39.99))  {cenatotal = metragefinal*9.30;}
          if ((metragefinal > 39.99)  && (metragefinal <= 49.99))  {cenatotal = metragefinal*9.20;}
          if ((metragefinal > 49.99)  && (metragefinal <= 59.99))  {cenatotal = metragefinal*9.00;}
          if ((metragefinal > 59.99)  && (metragefinal <= 69.99))  {cenatotal = metragefinal*8.50;}
          if ((metragefinal > 69.99)  && (metragefinal <= 79.99))  {cenatotal = metragefinal*8.40;}
          if ((metragefinal > 79.99)  && (metragefinal <= 89.99))  {cenatotal = metragefinal*8.30;}
          if ((metragefinal > 89.99)  && (metragefinal <= 99.99))  {cenatotal = metragefinal*8.20;}
          if ((metragefinal > 99.99)  && (metragefinal <= 149.99)) {cenatotal = metragefinal*8;}
          if ((metragefinal > 149.99) && (metragefinal <= 199.99)) {cenatotal = metragefinal*7.75;}
          if ((metragefinal > 199.99) && (metragefinal <= 249.99)) {cenatotal = metragefinal*7.50;}
          if ((metragefinal > 249.99) && (metragefinal <= 299.99)) {cenatotal = metragefinal*7.25;}
          if ((metragefinal > 299.99) && (metragefinal <= 399.99)) {cenatotal = metragefinal*7;}
          if ((metragefinal > 399.99) && (metragefinal <= 499.99)) {cenatotal = metragefinal*6.75;}
          if ( metragefinal > 499.99) {cenatotal = metragefinal*6.5;}

          p1=(metraz*0.44)*this.qte;
        }

        ///////////////////////////////////////////////////////////// jet 520 M1
        if(this.support == 'jet 520 M1') {

          if (  metragefinal < 1.99)   {cenatotal = metragefinal*21.00;}
          if ( (metragefinal > 1.99)   && (metragefinal <= 3.99))    {cenatotal = metragefinal*20.00;}
          if ( (metragefinal > 3.99)   && (metragefinal <= 5.99) )   {cenatotal = metragefinal*19.75;}
          if ( (metragefinal > 5.99)   && (metragefinal <= 7.99) )   {cenatotal = metragefinal*19.50;}
          if ( (metragefinal > 7.99)   && (metragefinal <= 9.99) )   {cenatotal = metragefinal*19.25;}
          if ( (metragefinal > 9.99)   && (metragefinal <= 13.99) )  {cenatotal = metragefinal*19.00;}
          if ( (metragefinal > 13.99)  && (metragefinal <= 17.99) )  {cenatotal = metragefinal*18.75;}
          if ( (metragefinal > 17.99)  && (metragefinal <= 23.99) )  {cenatotal = metragefinal*18.50;}
          if ( (metragefinal > 23.99)  && (metragefinal <= 29.99) )  {cenatotal = metragefinal*18.25;}
          if ( (metragefinal > 29.99)  && (metragefinal <= 39.99) )  {cenatotal = metragefinal*18.00;}
          if ( (metragefinal > 39.99)  && (metragefinal <= 49.99) )  {cenatotal = metragefinal*17.75;}
          if ( (metragefinal > 49.99)  && (metragefinal <= 59.99) )  {cenatotal = metragefinal*17.50;}
          if ( (metragefinal > 59.99)  && (metragefinal <= 69.99) )  {cenatotal = metragefinal*17.25;}
          if ( (metragefinal > 69.99)  && (metragefinal <= 79.99) )  {cenatotal = metragefinal*17.00;}
          if ( (metragefinal > 79.99)  && (metragefinal <= 89.99) )  {cenatotal = metragefinal*16.90;}
          if ( (metragefinal > 89.99)  && (metragefinal <= 99.99) )  {cenatotal = metragefinal*16.75;}
          if ( (metragefinal > 99.99)  && (metragefinal <= 149.99) ) {cenatotal = metragefinal*16.50;}
          if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = metragefinal*16.00;}
          if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = metragefinal*15.50;}
          if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = metragefinal*15.00;}
          if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = metragefinal*14.50;}
          if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = metragefinal*14.00;}
          if (  metragefinal > 499.99) {cenatotal = metragefinal*13.50;}

          p1=(metraz*0.47)*this.qte;
        }

        /////////////////////////////////////////////////////////////// 100% eco
        if (this.support == 'bache 100% écologique M1') {

          if (  metragefinal < 1.99)   {cenatotal = metragefinal*29.00;}
          if ( (metragefinal > 1.99)   && (metragefinal <= 3.99))    {cenatotal = metragefinal*28.00;}
          if ( (metragefinal > 3.99)   && (metragefinal <= 5.99) )   {cenatotal = metragefinal*27.75;}
          if ( (metragefinal > 5.99)   && (metragefinal <= 7.99) )   {cenatotal = metragefinal*27.50;}
          if ( (metragefinal > 7.99)   && (metragefinal <= 9.99) )   {cenatotal = metragefinal*27.25;}
          if ( (metragefinal > 9.99)   && (metragefinal <= 13.99) )  {cenatotal = metragefinal*27.00;}
          if ( (metragefinal > 13.99)  && (metragefinal <= 17.99) )  {cenatotal = metragefinal*26.75;}
          if ( (metragefinal > 17.99)  && (metragefinal <= 23.99) )  {cenatotal = metragefinal*26.50;}
          if ( (metragefinal > 23.99)  && (metragefinal <= 29.99) )  {cenatotal = metragefinal*26.25;}
          if ( (metragefinal > 29.99)  && (metragefinal <= 39.99) )  {cenatotal = metragefinal*26.00;}
          if ( (metragefinal > 39.99)  && (metragefinal <= 49.99) )  {cenatotal = metragefinal*25.75;}
          if ( (metragefinal > 49.99)  && (metragefinal <= 59.99) )  {cenatotal = metragefinal*25.50;}
          if ( (metragefinal > 59.99)  && (metragefinal <= 69.99) )  {cenatotal = metragefinal*25.25;}
          if ( (metragefinal > 69.99)  && (metragefinal <= 79.99) )  {cenatotal = metragefinal*25.00;}
          if ( (metragefinal > 79.99)  && (metragefinal <= 89.99) )  {cenatotal = metragefinal*24.90;}
          if ( (metragefinal > 89.99)  && (metragefinal <= 99.99) )  {cenatotal = metragefinal*24.75;}
          if ( (metragefinal > 99.99)  && (metragefinal <= 149.99) ) {cenatotal = metragefinal*24.50;}
          if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = metragefinal*22.00;}
          if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = metragefinal*21.50;}
          if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = metragefinal*21.00;}
          if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = metragefinal*20.50;}
          if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = metragefinal*20.00;}
          if (  metragefinal > 499.99) {cenatotal = metragefinal*19.50;}

          p1=(metraz*0.4)*this.qte;
        }

        //////////////////////////////////////////////////////// PVC 300 microns
        if (this.support == 'PVC 300 mircons') {

          if ( metraz <= 3) {cenatotal=17*metraz;}
          if ((metraz >  3) && (metraz <= 5))  {cenatotal=15*metraz;}
          if ((metraz >  5) && (metraz <= 8))  {cenatotal=14*metraz;}
          if ((metraz >  8) && (metraz <= 12)) {cenatotal=13*metraz;}
          if ((metraz > 12) && (metraz <= 20)) {cenatotal=12*metraz;}
          if (20<metrage)  {cenatotal=11*metrage;}

          p1=(metraz*0.3)*this.qte;
        }

        //////////////////////////////////////////// PVC 300 microns recto/verso

        if (this.support == 'Recto/verso PVC 300µ') {
          if ( metraz <= 3)  {cenatotal=(17+(17*0.3))*metraz;} // +30% //
          if ((metraz >  3)  && (metraz <= 5))  {cenatotal=(15+(15*0.3))*metraz;} // +30% //
          if ((metraz >  5)  && (metraz <= 8))  {cenatotal=(14+(14*0.3))*metraz;} // +30% //
          if ((metraz >  8)  && (metraz <= 12)) {cenatotal=(13+(13*0.3))*metraz;} // +30% //
          if ((metraz >  12) && (metraz <= 20)) {cenatotal=(12+(12*0.3))*metraz;} // +30% //
          if (20<metraz)    {cenatotal=(11+(11*0.3))*metraz;} // +30% //
          p1=(metraz*0.31)*this.qte;
        }

        /////////////////////////////////////////////////////////////// BLIZZARD
        if (this.produit == 'Blizzard') {

          produit = 'Blizzard';

          if (  metragefinal < 1.99)   {cenatotal = metragefinal*15.00;}
          if ( (metragefinal > 1.99)   && (metragefinal <= 3.99))    {cenatotal = metragefinal*14.80;}
          if ( (metragefinal > 3.99)   && (metragefinal <= 5.99) )   {cenatotal = metragefinal*14.60;}
          if ( (metragefinal > 5.99)   && (metragefinal <= 7.99) )   {cenatotal = metragefinal*14.40;}
          if ( (metragefinal > 7.99)   && (metragefinal <= 9.99) )   {cenatotal = metragefinal*14.20;}
          if ( (metragefinal > 9.99)   && (metragefinal <= 13.99) )  {cenatotal = metragefinal*14.00;}
          if ( (metragefinal > 13.99)  && (metragefinal <= 17.99) )  {cenatotal = metragefinal*13.50;}
          if ( (metragefinal > 17.99)  && (metragefinal <= 23.99) )  {cenatotal = metragefinal*13.25;}
          if ( (metragefinal > 23.99)  && (metragefinal <= 29.99) )  {cenatotal = metragefinal*13.00;}
          if ( (metragefinal > 29.99)  && (metragefinal <= 39.99) )  {cenatotal = metragefinal*12.75;}
          if ( (metragefinal > 39.99)  && (metragefinal <= 49.99) )  {cenatotal = metragefinal*12.50;}
          if ( (metragefinal > 49.99)  && (metragefinal <= 59.99) )  {cenatotal = metragefinal*12.25;}
          if ( (metragefinal > 59.99)  && (metragefinal <= 69.99) )  {cenatotal = metragefinal*12.00;}
          if ( (metragefinal > 69.99)  && (metragefinal <= 79.99) )  {cenatotal = metragefinal*11.75;}
          if ( (metragefinal > 79.99)  && (metragefinal <= 89.99) )  {cenatotal = metragefinal*11.50;}
          if ( (metragefinal > 89.99)  && (metragefinal <= 99.99) )  {cenatotal = metragefinal*11.25;}
          if ( (metragefinal > 99.99)  && (metragefinal <= 149.99) ) {cenatotal = metragefinal*11;}
          if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = metragefinal*10.50;}
          if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = metragefinal*10.00;}
          if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = metragefinal*9.50;}
          if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = metragefinal*9.00;}
          if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = metragefinal*8.50;}
          if (  metragefinal > 499.99) {cenatotal = metragefinal*8.00;}

          p1=(metraz*0.55)*this.qte;

          //--------------------------------------------------------------------
          if (this.dimensions == '60x160') {
            structure=35*3.6;
            cena = structure+(cenatotal/this.qte);
            designation = this.dimensions;
            p2=2*this.qte;
            this.prodref = '20170130';
            this.hauteur = 160;
            this.largeur = 60;
          }
          //--------------------------------------------------------------------
          if (this.dimensions == '80x200') {
            structure=35*3.6;
            cena = structure+(cenatotal/this.qte);
            designation = this.dimensions +' (ref:bis)';
            p2=2*this.qte;
            this.prodref = '20170130';
            this.hauteur = 200;
            this.largeur = 80;
          }
          //--------------------------------------------------------------------
          if (this.choixTopt == 'sac') {
            cena+=22;
            details = this.choixTopt;
          }
        }

        //////////////////////////////////////////////////////////////// MISTRAL
        if (this.produit == 'Mistral') {

          produit = 'Mistral';

          if (  metragefinal < 1.99)   {cenatotal = metragefinal*15.00;}
          if ( (metragefinal > 1.99)   && (metragefinal <= 3.99))    {cenatotal = metragefinal*14.80;}
          if ( (metragefinal > 3.99)   && (metragefinal <= 5.99) )   {cenatotal = metragefinal*14.60;}
          if ( (metragefinal > 5.99)   && (metragefinal <= 7.99) )   {cenatotal = metragefinal*14.40;}
          if ( (metragefinal > 7.99)   && (metragefinal <= 9.99) )   {cenatotal = metragefinal*14.20;}
          if ( (metragefinal > 9.99)   && (metragefinal <= 13.99) )  {cenatotal = metragefinal*14.00;}
          if ( (metragefinal > 13.99)  && (metragefinal <= 17.99) )  {cenatotal = metragefinal*13.50;}
          if ( (metragefinal > 17.99)  && (metragefinal <= 23.99) )  {cenatotal = metragefinal*13.25;}
          if ( (metragefinal > 23.99)  && (metragefinal <= 29.99) )  {cenatotal = metragefinal*13.00;}
          if ( (metragefinal > 29.99)  && (metragefinal <= 39.99) )  {cenatotal = metragefinal*12.75;}
          if ( (metragefinal > 39.99)  && (metragefinal <= 49.99) )  {cenatotal = metragefinal*12.50;}
          if ( (metragefinal > 49.99)  && (metragefinal <= 59.99) )  {cenatotal = metragefinal*12.25;}
          if ( (metragefinal > 59.99)  && (metragefinal <= 69.99) )  {cenatotal = metragefinal*12.00;}
          if ( (metragefinal > 69.99)  && (metragefinal <= 79.99) )  {cenatotal = metragefinal*11.75;}
          if ( (metragefinal > 79.99)  && (metragefinal <= 89.99) )  {cenatotal = metragefinal*11.50;}
          if ( (metragefinal > 89.99)  && (metragefinal <= 99.99) )  {cenatotal = metragefinal*11.25;}
          if ( (metragefinal > 99.99)  && (metragefinal <= 149.99) ) {cenatotal = metragefinal*11;}
          if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = metragefinal*10.50;}
          if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = metragefinal*10.00;}
          if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = metragefinal*9.50;}
          if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = metragefinal*9.00;}
          if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = metragefinal*8.50;}
          if (  metragefinal > 499.99) {cenatotal = metragefinal*8.00;}

          p1=(metraz*0.55)*this.qte;

          //------------------------------------------------------------------------
          if (this.dimensions == '80x200 1 visuel') {
            structure=86.4*1.8;
            cena = structure+(cenatotal/this.qte);
            designation = '80x200 <br />- 1 visuel';

            p2=3*this.qte;
            this.prodref = '20170122';
            this.hauteur = 200;
            this.largeur = 80;
          }
          //------------------------------------------------------------------------
          if (this.dimensions == '80x200 2 visuels') {
            structure=86.4*1.8;
            cena = structure+((cenatotal*1.5)/this.qte);
            designation = '80x200 <br />- 2 visuels recto-verso';

            p2=3*this.qte;
            this.prodref = '20170122';
            this.hauteur = 200;
            this.largeur = 80;
          }
        }

        ///////////////////////////////////////////////////////////////// XSREEN
        if (this.produit == 'x-screen') {

          produit = 'x-screen';

          //----------------------------------------------------------------------
          if (this.dimensions == '60x160') {
            if ((this.qte > 0) && (this.qte < 30)){structure=(2.5*2.5);}
            if ((this.qte > 29) && (this.qte < 50)){structure=(2.5*2.1);}
            if (this.qte > 49){structure=(2.5*1.9);}
            p2=0.7*this.qte;

            prixsupport = cenatotal/this.qte;
            cena = structure+prixsupport;
            designation = this.dimensions;
            details = this.support;
            this.prodref = '20170123';
            this.hauteur = 160;
            this.largeur = 60;
          }
          //----------------------------------------------------------------------
          if (this.dimensions == '80x180') {
            if ((this.qte > 0) && (this.qte < 30)){structure=(5*2.0);}
            if ((this.qte > 29) && (this.qte < 50)){structure=(5*1.9);}
            if (this.qte > 49){structure=(5*1.7);}
            p2=0.8*this.qte;

            prixsupport = cenatotal/this.qte;
            cena = structure+prixsupport;
            designation = this.dimensions;
            details = this.support;
            this.prodref = '20170124';
            this.hauteur = 180;
            this.largeur = 80;
          }
        }

        ///////////////////////////////////////////////////////////////// CLIPIT
        if (this.produit == 'clipit') {

          if (this.dimensions==30)  {structure=(3.55*3);  p2=0.3*this.qte;  produit = 'clipit 30cm';  this.prodref='20170250';}
          if (this.dimensions==42)  {structure=(4.45*3);  p2=0.42*this.qte; produit = 'clipit 42cm';  this.prodref='20170251';}
          if (this.dimensions==50)  {structure=(5.20*3);  p2=0.5*this.qte;  produit = 'clipit 50cm';  this.prodref='20170252';}
          if (this.dimensions==60)  {structure=(5.75*3);  p2=0.6*this.qte;  produit = 'clipit 60cm';  this.prodref='20170252';}
          if (this.dimensions==70)  {structure=(6.20*3);  p2=0.7*this.qte;  produit = 'clipit 70cm';  this.prodref='20170252';}
          if (this.dimensions==85)  {structure=(7.10*3);  p2=0.85*this.qte; produit = 'clipit 85cm';  this.prodref='20170253';}
          if (this.dimensions==100) {structure=(7.95*3);  p2=1.00*this.qte; produit = 'clipit 100cm'; this.prodref='20170254';}
          if (this.dimensions==120) {structure=(8.90*3);  p2=1.20*this.qte; produit = 'clipit 120cm'; this.prodref='20170255';}
          if (this.dimensions==150) {structure=(11.20*3); p2=1.50*this.qte; produit = 'clipit 150cm'; this.prodref='20170256';}
          if (this.dimensions==160) {structure=(17.00*3); p2=1.60*this.qte; produit = 'clipit 160cm'; this.prodref='20170257';}
          if (this.dimensions==180) {structure=(20.00*3); p2=1.80*this.qte; produit = 'clipit 180cm'; this.prodref='20170257';}
          if (this.dimensions==200) {structure=(24.00*3); p2=2.00*this.qte; produit = 'clipit 200cm'; this.prodref='20170257';}

          this.hauteur = this.hauteur;
          this.largeur = this.dimensions;

          prixsupport = cenatotal/this.qte;
          cena = structure+prixsupport;
          details = this.support+' <br />- '+this.largeur+'x'+this.hauteur+'cm (Largeur x Hauteur)';

          if (this.choixTopt == 'ventouse') {
            details = this.support+' <br />- '+this.largeur+'x'+this.hauteur+'cm (Largeur x Hauteur) <br />- Ventouse super adhesive 65mm';
            cena += 5.7;
          }
        }

        //////////////////////////////////////////////////////// kakemono  tissu
        if (this.produit == 'Kakemono Tissu') {

          produit = 'Totem Tissu';

          if (this.support    == 'tissu 220g')          {pm2 = 2.90;}
          if (this.support    == 'tissu 260g')          {pm2 = 4.50;}

          if (this.dimensions == '60x230 recto')        {structure = 38; m2 =(0.612*2.28)*1.5; p1=6.85;  this.hauteur = 230; this.largeur = 60;  this.prodref = '20170600';}
          if (this.dimensions == '60x230 recto/verso')  {structure = 38; m2 =(0.612*2.28)*2;   p1=6.85;  this.hauteur = 230; this.largeur = 60;  this.prodref = '20170600';}
          if (this.dimensions == '80x230 recto')        {structure = 56.50; m2 =(0.917*2.28)*1.5; p1=7.6;  this.hauteur = 230; this.largeur = 80;  this.prodref = '20170601';}
          if (this.dimensions == '80x230 recto/verso')  {structure = 56.50; m2 =(0.917*2.28)*2;   p1=7.6;  this.hauteur = 230; this.largeur = 80;  this.prodref = '20170601';}
          if (this.dimensions == '100x230 recto')       {structure = 64.50; m2 =(1.202*2.28)*1.5; p1=8.8;    this.hauteur = 230; this.largeur = 100; this.prodref = '20170605';}
    		  if (this.dimensions == '100x230 recto')       {structure = 64.50; m2 =(1.202*2.28)*1.5; p1=8.8;    this.hauteur = 230; this.largeur = 100; this.prodref = '20170605';}
          if (this.dimensions == '120x230 recto')       {structure = 73; m2 =(1.222*2.28)*1.5; p1=11;    this.hauteur = 230; this.largeur = 120; this.prodref = '20170602';}
          if (this.dimensions == '120x230 recto/verso') {structure = 73; m2 =(1.222*2.28)*2;   p1=11;    this.hauteur = 230; this.largeur = 120; this.prodref = '20170602';}
          if (this.dimensions == '150x230 recto')       {structure = 79; m2 =(1.526*2.28)*1.5; p1=13.60; this.hauteur = 230; this.largeur = 150; this.prodref = '20170603';}
          if (this.dimensions == '150x230 recto/verso') {structure = 79; m2 =(1.526*2.28)*2;   p1=13.60; this.hauteur = 230; this.largeur = 150; this.prodref = '20170603';}

          imp=(3*m2)+15; // impresion + couture
          tissu=pm2*m2;  // tissu

          pa=structure+imp+tissu; // prix d'achat
          if ((this.qte > 0) && (this.qte < 2)){cena = pa*2.80;}
          if ((this.qte > 1) && (this.qte < 4)){cena = pa*2.75;}
          if ((this.qte > 3) && (this.qte < 6)){cena = pa*2.70;}
          if (this.qte > 5){cena = pa*2.65;}

          designation = this.dimensions;
          details = this.support;
          p=p1*this.qte;
        }
        ////////////////////////////////////////////////////////////// photocall
        if (this.produit == 'Photocall') {

          if (this.dimensions == 'tissu 220g') {
            structure=45; pm2 = 20.9; this.hauteur = 220; this.largeur = 200; p1=8*this.qte; m2=4.4;
            details=' L220 x H240cm / textile 220gr B1 (ref:bis)';
          }
          if (this.dimensions == 'PVC') {
            structure=45; pm2 = 23;   this.hauteur = 240; this.largeur = 220; p1=8*this.qte; m2=5.28;
            details=' L200 x H220cm / toile PVC M1';
          }

          cenatotal = (m2*pm2)+(structure*2.09);
          cena = (cenatotal);
          designation = 'Photocall' ;
          this.prodref = '20170232';
        }

        ////////////////////////////////////////////////////////// prix tansport
        poids=(p1+p2);

        if ( poids <= 1) {cena+=(4.80*1.5)/this.qte;}
        if ((poids > 1)  && (poids <= 2))  {cena+=(5.1*1.5)/this.qte;}
        if ((poids > 2)  && (poids <= 3))  {cena+=(5.67*1.5)/this.qte;}
        if ((poids > 3)  && (poids <= 4))  {cena+=(5.63*1.5)/this.qte;}
        if ((poids > 4)  && (poids <= 5))  {cena+=(6.88*1.5)/this.qte;}
        if ((poids > 5)  && (poids <= 6))  {cena+=(7.99*1.5)/this.qte;}
        if ((poids > 6)  && (poids <= 7))  {cena+=(7.99*1.5)/this.qte;}
        if ((poids > 7)  && (poids <= 10)) {cena+=(9.30*1.5)/this.qte;}
        if ((poids > 10) && (poids <= 15)) {cena+=(11.93*1.5)/this.qte;}
        if ((poids > 15) && (poids <= 20)) {cena+=(14.93*1.5)/this.qte;}
        if ((poids > 20) && (poids <= 25)) {cena+=(18.82*1.5)/this.qte;}
        if ((poids > 25) && (poids <= 30)) {cena+=(20.56*1.4)/this.qte;}
        if ((poids > 30) && (poids <= 40)) {cena+=(25.64*1.3)/this.qte;}
        if ((poids > 40) && (poids <= 50)) {cena+=(33.73*1.2)/this.qte;}
        if ((poids > 50) && (poids <= 60)) {cena+=(42.14*1.2)/this.qte;}
        if ((poids > 60) && (poids <= 70)) {cena+=(47.71*1.2)/this.qte;}
        if ((poids > 70) && (poids <= 80)) {cena+=(55.26*1.2)/this.qte;}
        if ((poids > 80) && (poids <= 90)) {cena+=(62.12*1.2)/this.qte;}
        if ((poids > 90) && (poids <= 100)) {cena+=(68.54*1.2)/this.qte;}
        if ( poids > 100) {cena+=(69.26*1.2)/this.qte;}

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          cena += this.$global.maqFB1/this.qte;
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
          cena += this.$global.livREL/this.qte;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= this.$global.livREV;}
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
        cena = prixunite*this.qte;
        prixunite=fixstr(prixunite);
        this.transport=0;
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis
        if (this.choixSize == "choisir les dimensions" || this.dimensions == "choisir la largeur") {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir les dimensions';
          this.erreurType=1;

        } else if (this.hauteur < 1 || isNaN(this.hauteur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur';
          this.erreurType=1;

        } else if (this.choixSupp == "choisir le support") {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir le support';
          this.erreurType=1;

        } else if(this.qte < 1 || isNaN(this.qte)) {
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

          this.inputDesc = '- '+produit+' '+designation+'<br>- '+details+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'Totem';
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
