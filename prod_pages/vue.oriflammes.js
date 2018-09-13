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
      kit: '',
      maquette: '',
      sign: '',

      // valeurs par défaut (value) : autre champs
      choixProd : 'choisir votre modèle d\'oriflamme',
      choixSize : '',
      choixKit  : '',
      choixMaqt : '',
      choixSign : '',
      choixRecv : '',
      choixPied : '',
      qte: 1,
      adresse: true,
      atelier: false,
      relais: false,
      colis: false,
      antifeu: false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes
      reqProd: 'required',
      reqSize: '',
      reqKit: '',
      reqRecv: '',
      reqPied: '',
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
      toggleKit: true,
      toggleMaqt: true,
      toggleSign: true,
      toggleRecv: true,
      togglePied: true,

      smallSize: false,
      aileSize: false,
      beachSize: false,
      windSize: false,
      vertSize: false,
      horzSize: false,
      aileKit: false,
      goutteKit: false,

      showMaqt: false,
      showSign: false,
      showOptions: false,
      showLiv: false,
      showRecv: false,
      showPied: false,

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

        // champs masqués si l'utilisateur revient sur son choix produit :
        this.smallSize = this.aileSize = this.beachSize = this.windSize = this.vertSize = this.horzSize = this.showRecv = this.showPied = false;
        this.aileKit = this.goutteKit = false;

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/ext.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        // -------------------------------------------------------- AILE D'AVION
        if(this.produit == 'oriflamme') {
          // afficher/masquer les champs
          this.aileSize = true;
          this.smallSize = this.beachSize = this.windSize = this.vertSize = this.horzSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/aile2.png)'};

        // -------------------------------------------------------- GOUTTE D'EAU
        }else if (this.produit == 'beachflag') {
          // afficher/masquer les champs
          this.beachSize = true;
          this.smallSize = this.aileSize = this.windSize = this.vertSize = this.horzSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/goutte2.png)'};

        // ------------------------------------------------------------ WINDFLAG
        }else if (this.produit == 'windflag') {
          // afficher/masquer les champs
          this.windSize = true;
          this.smallSize = this.aileSize = this.beachSize = this.vertSize = this.horzSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/oriflamme-windflag.png)'};

        // --------------------------------------------------------- GF VERTICAL
        }else if (this.produit == 'grand format vertical') {
          // afficher/masquer les champs
          this.vertSize = true;
          this.smallSize = this.aileSize = this.beachSize = this.windSize = this.horzSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/gfvt2.png)'};

        // ------------------------------------------------------- GF HORIZONTAL
        }else if (this.produit == 'grand format horizontal') {
          // afficher/masquer les champs
          this.horzSize = true;
          this.smallSize = this.aileSize = this.beachSize = this.windSize = this.vertSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/gfhz.png)'};

        // ------------------------------------------------------------ DRAPEAUX
        }else if (this.produit == 'drapeaux') {
          // afficher/masquer les champs
          this.smallSize = true;
          this.aileSize = this.beachSize = this.windSize = this.vertSize = this.horzSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/drapeaux.png)'};
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

        this.showRecv = this.showPied = false;
        this.pr2 = true;           // calque dimensions activé

        if (this.produit == 'oriflamme') {
          // afficher/masquer les champs
          this.aileKit = true;
          this.goutteKit = false;

          // afficher le champ suivant et indiquer qu'il est requis :
          this.reqKit = 'required';
          this.toggleKit = true;
          this.choixKit = 'quels elements voulez-vous ?';

        }else if (this.produit == 'beachflag'){
          // afficher/masquer les champs
          this.aileKit = false;
          this.goutteKit = true;

          // afficher le champ suivant et indiquer qu'il est requis :
          this.reqKit = 'required';
          this.toggleKit = true;
          this.choixKit = 'quels elements voulez-vous ?';

        } else {
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    }, // fin fonction choix dimensions

    // fonction affichage champs formulaire :                au choix kit validé
    //==========================================================================
    selectKit: function(value) {

        this.kit = value;
        this.choixKit = value;
        this.toggleKit = false;
        this.reqKit = '';

        if(this.produit=='oriflamme' && this.kit=='kit complet') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/aile2.png)'};
        if(this.produit=='beachflag' && this.kit=='kit complet') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/goutte2.png)'};
        if(this.produit=='oriflamme' && this.kit=='structure et voile') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/aile2.png)'};
        if(this.produit=='beachflag' && this.kit=='structure et voile') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/goutte2.png)'};
        if(this.produit=='oriflamme' && this.kit=='voile seule') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/aile1.png)'};
        if(this.produit=='beachflag' && this.kit=='voile seule') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/goutte1.png)'};
        if(this.produit=='oriflamme' && this.kit=='structure seule') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/aile4.png)'};
        if(this.produit=='beachflag' && this.kit=='structure seule') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/goutte4.png)'};

        if (this.kit == 'structure seule') {
          this.pr2 = this.showRecv = this.showPied = this.showMaqt = this.showSign = false;

          this.maquette = 'maquette client sans bat';
          this.modmaq = 'je ne souhaite pas de BAT';
          this.sign = 'signature France Banderole';
          this.reqQtte = 'required';
          this.showOptions = true;

        } else {
          if (this.kit =='voile seule' || this.kit=='structure et voile'){
            this.pr2 = this.showPied = false; this.bg2 = {backgroundImage: 'none'};
          }

          this.showRecv = true;
          this.reqRecv = 'required';
          this.toggleRecv = true;
          this.choixRecv = 'quelle impression voulez-vous ?';
        }
    },

    // fonction affichage champs formulaire :        au choix recto verso validé
    //==========================================================================
    selectRecv: function(value) {

        this.choixRecv = value;
        this.toggleRecv = false;
        this.reqRecv = '';

        if(this.kit == 'kit complet') {
          this.showPied = true;
          this.reqPied = 'required';
          this.togglePied = true;
          this.choixPied = 'quel pied voulez-vous ?';

        }else{
          this.showPied = false;
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    },

    // fonction affichage champs formulaire :               au choix pied validé
    //==========================================================================
    selectPied: function(value) {

        this.choixPied = value;
        this.togglePied = false;
        this.reqPied = '';

        if(this.choixPied == 'Embase 8kg')           this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/pied8.png)'};
        if(this.choixPied == 'Embase carrée 13,5kg') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/pied13.png)'};
        if(this.choixPied == 'Pied 4 branches + bouée') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/pied4.png)'};
        if(this.choixPied == 'Pied piquet')          this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/piedPiquet.png)'};
        if(this.choixPied == 'Pied voiture')         this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/piedVoiture.png)'};
        if(this.choixPied == 'Pied à visser')        this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/piedVis.png)'};
        if(this.choixPied == 'Pied parasol 23L')     this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/piedPara.png)'};
        if(this.choixPied == 'Embase ciment 22kg')   this.bg2 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/piedPara.png)'};

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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/ext.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/oriflamme/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/oriflamme/ext.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/oriflamme/'+src+'.png)'};
    },

    // fonctions hover :    à la sortie de la souris, désactiver le calque hover
    //==========================================================================
    hout: function(calque) {
      this.prH = false; //
      this.calqueTexte = false;
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
        var cena               = 0; var cena2  = 0;  var prixunite = 0;
        var prixHT             = 0; var marge  = 0;  var composant = 0;
        var rabat              = 0; var rabat2 = 0;  var opis = '';
        var suma               = 0; var suma2  = 0;
        var transports         = 0;
        var structure          = 0;
        var impression         = 0;
        var prliv              = '';
        var date_panier        = '';
        var colisr             = '';
        var dodatkowaopcja     = '';
        var option2            = 0;
        var pied               = 0;
        var poidtotal          = 0; var p1 = 0; var p2 = 0; var p3 = 0;
        var option             = 0; var options1 = 0; var options2 = 0; var options3 = 0; var options4=0; maquette=0; var options5=0; var options6=0;
        var dodatkowytransport = 0;
        var optliv             = '';
        var formatProd         = '';
        var optionPied         = ''; var finalPrice; var finalPrice1; var finalPrice2;

        ////////////////////////////////////////////////////// drapeaux à agiter

        if (this.produit == 'drapeaux') {
          this.designation='Drapeaux';
          //--------------------------------------------------------------------
          if (this.dimensions == '25x35') {
            if (this.qte == 1) {
            prixHT = 44; }
            if ((this.qte > 1) && (this.qte <= 5)) {
            prixHT = 28;}
            if ((this.qte > 5) && (this.qte <= 9)) {
            prixHT = 21;}
            if ((this.qte > 9) && (this.qte <= 49)) {
            prixHT = 18;}
            if (this.qte > 49) {
            prixHT = 15.90;}

            this.hauteur = 25;
            this.largeur = 35;
            this.prodref = '20170930';
            formatProd = '25x35';
            composant='Mât 50cm';
          }
          //--------------------------------------------------------------------
          if (this.dimensions == '40x50') {
            if (this.qte == '1') {
            prixHT = 49;}
            if ((this.qte > 1) && (this.qte <= 5)) {
            prixHT = 32;}
            if ((this.qte > 5) && (this.qte <= 9)) {
            prixHT = 26;}
            if ((this.qte > 9) && (this.qte <= 49)) {
            prixHT = 22;}
            if (this.qte > 49) {
            prixHT = 19.90;}

            this.hauteur = 40;
            this.largeur = 50;
            this.prodref = '20170931';
            formatProd = '40x50';
            composant='Mât 75cm';
          }
          //--------------------------------------------------------------------
          if (this.dimensions == '75x100') {
            if (this.qte == 1) {
            prixHT = 62;}
            if ((this.qte > 1) && (this.qte <= 5)) {
            prixHT = 44;}
            if ((this.qte > 5) && (this.qte <= 9)) {
            prixHT = 36;}
            if ((this.qte > 9) && (this.qte <= 49)) {
            prixHT = 32;}
            if (this.qte > 49) {
            prixHT = 29.90;}

            this.hauteur = 75;
            this.largeur = 100;
            this.prodref = '20170932';
            formatProd = '75x100';
            composant='Mât 150cm';
          }
        }

        ////////////////////////////////////////////////// drapeaux grand format

        if (this.produit == 'grand format vertical' || this.produit == 'grand format horizontal') {
          this.designation='Drapeaux grand format';

          //------------------------------------------------------------vertical

          if (this.produit == 'grand format vertical' && (this.dimensions == '250x80')) {
            if (this.qte == 1) {
            prixHT = 44; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 42;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 38;}
            if (this.qte > 10) {
            prixHT = 32;}

            this.hauteur = 250;
            this.largeur = 80;
            this.prodref = '20170920';
            formatProd = 'vertical 250x80';
            p1=2;
          }
          //--------------------------------------------------------------------
          if (this.produit == 'grand format vertical' && (this.dimensions == '300x100')) {
            if (this.qte == 1) {
            prixHT = 53; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 51;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 47;}
            if (this.qte > 10) {
            prixHT = 45;}

            this.hauteur = 300;
            this.largeur = 100;
            this.prodref = '20170921';
            formatProd = 'vertical 300x100';
            p1=3;
          }
          //--------------------------------------------------------------------
          if (this.produit == 'grand format vertical' && (this.dimensions == '400x120')) {
            if (this.qte == 1) {
            prixHT = 67; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 65;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 59;}
            if (this.qte > 10) {
            prixHT = 57;}

            this.hauteur = 400;
            this.largeur = 120;
            this.prodref = '20170922';
            formatProd = 'vertical 400x120';
            p1=4.8;
          }
          //--------------------------------------------------------------------
          if (this.produit == 'grand format vertical' && (this.dimensions == '500x150')) {
            if (this.qte == 1) {
            prixHT = 88; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 86;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 78;}
            if (this.qte > 10) {
            prixHT = 76;}

            this.hauteur = 500;
            this.largeur = 150;
            this.prodref = '20170923';
            formatProd = 'vertical 500x150';
            p1=7.5;
          }

          //----------------------------------------------------------horizontal

          if (this.produit == 'grand format horizontal' && (this.dimensions == '80x120')) {
            if (this.qte == 1) {
            prixHT = 22; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 20;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 17;}
            if (this.qte > 10) {
            prixHT = 15;}

            this.hauteur = 80;
            this.largeur = 120;
            this.prodref = '20170924';
            formatProd = 'horizontal 80x120';
            p1=0.96;
          }

          //--------------------------------------------------------------------
          if (this.produit == 'grand format horizontal' && (this.dimensions == '100x150')) {
            if (this.qte == 1) {
            prixHT = 24; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 22;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 19;}
            if (this.qte > 10) {
            prixHT = 17;}

            this.hauteur = 100;
            this.largeur = 150;
            this.prodref = '20170925';
            formatProd = 'horizontal 100x150';
            p1=1.5;
          }
          //--------------------------------------------------------------------
          if (this.produit == 'grand format horizontal' && (this.dimensions == '120x180')) {
            if (this.qte == 1) {
            prixHT = 29; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 27;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 24;}
            if (this.qte > 10) {
            prixHT = 22;}

            this.hauteur = 120;
            this.largeur = 180;
            this.prodref = '20170926';
            formatProd = 'horizontal 120x180';
            p1=2.16;
          }
          //--------------------------------------------------------------------
          if (this.produit == 'grand format horizontal' && (this.dimensions == '150x225')) {
            if (this.qte == 1) {
            prixHT = 32; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 30;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 27;}
            if (this.qte > 10) {
            prixHT = 25;}

            this.hauteur = 150;
            this.largeur = 225;
            this.prodref = '20170927';
            formatProd = 'horizontal 150x225';
            p1=3.37;
          }
          //--------------------------------------------------------------------
          if (this.produit == 'grand format horizontal' && (this.dimensions == '200x300')) {
            if (this.qte == 1) {
            prixHT = 47; }
            if ((this.qte > 1) && (this.qte <= 6)) {
            prixHT = 45;}
            if ((this.qte > 6) && (this.qte <= 10)) {
            prixHT = 41;}
            if (this.qte > 10) {
            prixHT = 39;}

            this.hauteur = 200;
            this.largeur = 300;
            this.prodref = '20170928';
            formatProd = 'horizontal 200x300';
            p1=6;
          }
        }

        /////////////////////////////////////////////////////////// Aile d'avion

        if (this.produit == 'oriflamme') {
          this.designation='Oriflamme aile d’avion';

      		if (this.dimensions == '54x190') {
      			structure = 13;
      			p2=0.85;
            this.hauteur = 190;
            this.largeur = 54;
      		}

      		if (this.dimensions == '85x245') {
      			structure = 15;
      			p2=0.89;
            this.hauteur = 245;
            this.largeur = 85;
      		}

      		if (this.dimensions == '85x298') {
      			structure = 16;
      			p2=1.05;
            this.hauteur = 298;
            this.largeur = 85;
      		}

      		if (this.dimensions == '85x397') {
      			structure = 22;
      			p2=1.25;
            this.hauteur = 397;
            this.largeur = 60;
      		}

          //--------------------------------------------------------------------
          if (this.dimensions == '54x190' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 31;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 28;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 25.75;}
            if (this.qte >= 10) {
            impression = 23.15;}
            formatProd = '54x240 recto';
            p1=0.25;

            this.prodref = '20170900';
          }

          if (this.dimensions == '54x190' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 81;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 70;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 60.72;}
            if (this.qte >= 10) {
            impression = 54.65;}
            formatProd = '54x240 recto/verso';
            p1=0.4;

            this.prodref = '20170910';
          }

          //--------------------------------------------------------------------
          if (this.dimensions == '85x245' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 41;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 36;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 31.28;}
            if (this.qte >= 10) {
            impression = 28.15;}
            formatProd = '85x308 recto';
            p1=0.4;

            this.prodref = '20170901';
          }

          if (this.dimensions == '85x245' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 101;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 85;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 74.52;}
            if (this.qte >= 10) {
            impression = 67.07;}
            formatProd = '85x308 recto/verso';
            p1=0.8;

            this.prodref = '20170911';
          }

          //--------------------------------------------------------------------
          if (this.dimensions == '85x298' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 49;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 44;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 39.56;}
            if (this.qte >= 10) {
            impression = 35.60;}
            formatProd = '85x351 recto';
            p1=0.45;

            this.prodref = '20170902';
          }

          if (this.dimensions == '85x298' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 124;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 105;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 92.92;}
            if (this.qte >= 10) {
            impression = 83.63;}
            formatProd = '85x351 recto/verso';
            p1=0.95;

            this.prodref = '20170912';
          }

          //--------------------------------------------------------------------
          if (this.dimensions == '85x397' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 61;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 55;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 49.68;}
            if (this.qte >= 10) {
            impression = 44.71;}
            formatProd = '85x465 recto';
            p1=0.8;

            this.prodref = '20170903';
          }

          if (this.dimensions == '85x397' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 160;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 130;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 116.84;}
            if (this.qte >= 10) {
            impression = 105.16;}
            formatProd = '85x465 recto/verso';
            p1=1.2;

            this.prodref = '20170913';
          }
        }

        /////////////////////////////////////////////////////////// goutte d'eau
        if (this.produit == 'beachflag') {
          this.designation='Beachflag goutte d’eau';

      		if (this.dimensions == '72x156') {
      			structure = 13;
      			p2=0.85;
            this.hauteur = 156;
            this.largeur = 72;
      		}

      		if (this.dimensions == '75x213') {
      			structure = 15;
      			p2=0.9;
            this.hauteur = 213;
            this.largeur = 75;
      		}

      		if (this.dimensions == '106x257') {
      			structure = 16;
      			p2=1.05;
            this.hauteur = 257;
            this.largeur = 106;
      		}

      		if (this.dimensions == '125x402') {
      			structure = 22;
      			p2=1.25;
            this.hauteur = 402;
            this.largeur = 125;
      		}

          //--------------------------------------------------------------72x156
          if (this.dimensions == '72x156' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 34;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 29;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 25.76;}
            if (this.qte >= 10) {
            impression = 23.18;}
            formatProd = '72x203 recto';
            p1=0.1;

            this.prodref = '20170904';
          }

          if (this.dimensions == '72x156' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 76;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 69.00;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 60.72;}
            if (this.qte >= 10) {
            impression = 54.65;}
            formatProd = '72x203 recto/verso';
            p1=0.3;

            this.prodref = '20170914';
          }

          //--------------------------------------------------------------75x213
          if (this.dimensions == '75x213' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 42;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 37;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 34.96;}
            if (this.qte >= 10) {
            impression = 31.46;}
            formatProd = '75x254 recto';
            p1=0.15;

            this.prodref = '20170905';
          }

          if (this.dimensions == '75x213' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 86;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 77;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 67.16;}
            if (this.qte >= 10) {
            impression = 60.40;}
            formatProd = '75x254 recto/verso';
            p1=0.3;

            this.prodref = '20170915';
          }

          //-------------------------------------------------------------106x257
          if (this.dimensions == '106x257' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 55;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 49;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 44.16;}
            if (this.qte >= 10) {
            impression = 39.74;}
            formatProd = '106x323 recto';
            p1=0.25;

            this.prodref = '20170906';
          }

          if (this.dimensions == '106x257' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 114;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 110;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 88.32;}
            if (this.qte >= 10) {
            impression = 79.49;}
            formatProd = '106x323 recto/verso';
            p1=0.5;

            this.prodref = '20170916';
          }

          //-------------------------------------------------------------125x402
          if (this.dimensions == '125x402' && this.choixRecv == 'Recto/Verso par transparence') {

            if (this.qte == 1) {
            impression = 76;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 70;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 63.48;}
            if (this.qte >= 10) {
            impression = 57.13;}
            formatProd = '125x460 recto';
            p1=0.3;

            this.prodref = '20170907';
          }

          if (this.dimensions == '125x402' && this.choixRecv == 'Recto/Verso double voile') {

            if (this.qte == 1) {
            impression = 152;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 135;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 121.44;}
            if (this.qte >= 10) {
            impression = 109.30;}
            formatProd = '125x460 recto/verso';
            p1=0.6;

            this.prodref = '20170917';
          }
        }

        ///////////////////////////////////////////////// windflag rectangulaire

        if (this.produit == 'windflag') {
          this.designation='Windflag rectangulaire';

          //--------------------------------------------------------------------
          if (this.dimensions == '59x180') {
            structure = 22;
            if (this.qte == 1) {
            impression = 30;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 25;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 22.08;}
            if (this.qte >= 10) {
            impression = 19.87;}
            formatProd = '63x256';
            p1=0.15;
            p2=2.6;
            this.prodref = '20170940';
            this.hauteur = 180;
            this.largeur = 59;
          }
          //--------------------------------------------------------------------
          if (this.dimensions == '80x280') {
            structure = 85;
            if (this.qte == 1) {
            impression = 50;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 45;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 40.48;}
            if (this.qte >= 10) {
            impression = 36.43;}
            formatProd = '80x410';
            p1=0.25;
            p2=8;
            this.prodref = '20170941';
            this.hauteur = 280;
            this.largeur = 80;
          }
          //--------------------------------------------------------------------
          if (this.dimensions == '100x350') {
            structure = 115;
            if (this.qte == 1) {
            impression = 66;}
            if (this.qte == 2 || this.qte == 3 || this.qte == 4 || this.qte == 5) {
            impression = 60;}
            if (this.qte == 6 || this.qte == 7 || this.qte == 8 || this.qte == 9)
            {impression = 54.28;}
            if (this.qte >= 10) {
            impression = 48.85;}
            formatProd = '100x530';
            p1=0.45;
            p2=17.4;
            this.prodref = '20170942';
            this.hauteur = 350;
            this.largeur = 100;
          }
        }


        ////////////////////////////////////////////////////////////////// Pieds
        if (this.produit == 'beachflag' || this.produit == 'oriflamme') {

          if (this.choixPied == 'Embase 8kg') {
            pied=27;
            p3=8;
          }
          if (this.choixPied == 'Embase carrée 13,5kg') {
            pied=37;
            p3=13.5;
          }
          if (this.choixPied == 'Pied 4 branches + bouée') {
            pied=18;
            p3=0.2;
          }
          if (this.choixPied == 'Pied piquet') {
            pied=16;
            p3=1.3;
          }
          if (this.choixPied == 'Pied voiture') {
            pied=16;
            p3=1.65;
          }
          if (this.choixPied == 'Pied à visser') {
            pied=10;
            p3=0.75;
          }

          if (this.choixPied == 'Pied parasol 23L') {
            pied=14;
            p3=1.2;
          }
          if (this.choixPied == 'Embase ciment 22kg') {
            pied=52;
            p3=22;
          }

          /////////////////////////////////////////////////////////////////// Kits

          if (this.kit == 'kit complet') {
            prixHT=structure+impression+pied;
            composant='Kit complet';
          }
          if (this.kit == 'structure et voile') {
            prixHT=structure+impression;
            composant='Structure + voile';
          }
          if (this.kit == 'voile seule') {
            prixHT=impression;
            composant='Voile seule';
          }
          if (this.kit == 'structure seule') {
            prixHT=(structure*1.5);
            composant='Structure seule';
          }

        }else if (this.produit == 'windflag') {
          prixHT=structure+impression;
          composant='Structure + voile + pied';
        }

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          maquette = 29/this.qte;
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          maquette = 4/this.qte;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          maquette = 6/this.qte;
          this.modmaq = 'je crée ma maquette en ligne';
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}

        //---------------------------------------- TOTAUX avec marge et maquette

        if (this.produit == 'drapeaux') {
          prixunite = prixHT+maquette;
          cena=prixunite*this.qte;
        }
        if (this.produit == 'grand format vertical' || this.produit == 'grand format horizontal') {
          prixunite = (prixHT+maquette)*1.5;
          cena=prixunite*this.qte;
        }

        if (this.produit == 'beachflag' || this.produit == 'oriflamme' || this.produit == 'windflag') {
          //-------------------------------------------------------------- MARGE
          if (this.qte == 1)   marge = (prixHT*50)/100;
          if (this.qte >= 2 && this.qte <= 5) marge = (prixHT*47)/100;
          if (this.qte >= 6 && this.qte <= 9) marge = (prixHT*39)/100;
          if (this.qte >= 10)  marge = (prixHT*35)/100;

          prixunite = (prixHT+marge+maquette);
          cena=prixunite*this.qte;
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
          cena -= cena*6/100;
          this.retrait = 'retrait colis atelier';
        }

/*        if (this.relais == true) {
          cena += 5/this.qte;
          this.retrait = 'relais colis';
        }*/

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 5*this.qte;}
          this.optliv = ' / colis revendeur';
        }

        if (this.antifeu == true) {
          cena += (cena*40)/100;
          options4 = (cena*40)/100;
          this.optliv = ' / Voile anti-feu';
        }

        //------------------------------------------------------------ transport
        poidtotal=(p1+p2+p3)*this.qte;

        if ((poidtotal>=0) && (poidtotal<=10.00)) {transports=12;}
        if ((poidtotal>=10.01) && (poidtotal<=30.00)) {transports=19;}
        if ((poidtotal>=30.01) && (poidtotal<=45.00)) {transports=28;}
        if ((poidtotal>=45.01) && (poidtotal<=60.00)) {transports=37;}
        if ((poidtotal>=60.01) && (poidtotal<=75.00)) {transports=46;}
        if ((poidtotal>=75.01) && (poidtotal<=90.00)) {transports=55;}
        if ((poidtotal>=90.01) && (poidtotal<=150.00)) {transports=91;}
        if ((poidtotal>=150.01) && (poidtotal<=200.00)) {transports=107;}
        if ((poidtotal>=200.01) && (poidtotal<=300.00)) {transports=152;}
        if ((poidtotal>=300.01) && (poidtotal<=400.00)) {transports=194;}
        if ((poidtotal>=400.01) && (poidtotal<=500.00)) {transports=234;}
        if ((poidtotal>=500.01) && (poidtotal<=600.00)) {transports=276;}
        if ((poidtotal>=600.01) && (poidtotal<=700.00)) {transports=315;}
        if ((poidtotal>=700.01) && (poidtotal<=800.00)) {transports=353;}
        if ((poidtotal>=800.01) && (poidtotal<=900.00)) {transports=392;}
        if (poidtotal>=900.01) {transports=400;}


        // -------------------------------------------------------- PRIX PRODUIT
        cena+= transports;
      	this.transport=0;

        prixunite = cena;
        prixunite = fixstr(prixunite);
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------ PRIX LIVRAISON

        if (this.delaiprod && this.delailiv){
          var ProdPercent = '';
          var DeliPercent = '';

          if      (this.delaiprod == '2-3') ProdPercent = 25;
          else if (this.delaiprod == '1-1') ProdPercent = 60;
          else                              ProdPercent = 0;

          if      (this.delailiv == '2-3')  DeliPercent = 25;
          else if (this.delailiv == '1-1')  DeliPercent = 60;
          else                              DeliPercent = 0;

          var price_unit = parseFloat(prixunite);

          var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
          var calculatedTotalPrice = (price_unit) * (totalPercente)/100;
          finalPrice               = (calculatedTotalPrice + price_unit)/this.qte; // !!!!!

          finalPrice1 = fixstr(finalPrice);
          finalPrice2 = finalPrice1.replace(".", ",");

          this.prixUnit = finalPrice2 +' €' ;
        }

        // ---------------------------------------------------------- PRIX TOTAL

        prixunite = finalPrice1;
        cena=prixunite*this.qte;
        prixunite=fixstr(prixunite);
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis

        if     (this.produit   == 'choisir votre modèle d\'oriflamme') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir un produit';}
        else if(this.choixSize == 'choisir les dimensions') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une dimension';}
        else if(this.choixKit  == 'quels elements voulez-vous ?') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir vos elements';}
        else if(this.choixRecv == 'quelle impression voulez-vous ?') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option impression';}
        else if(this.choixPied == 'quel pied voulez-vous ?') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir un pied';}
        else if(this.choixMaqt == 'votre maquette (fichier d\'impression)') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option maquette';}
        else if(this.choixSign == 'logo france banderole ?') {this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option signature';}
        else if(this.qte < 1 || isNaN(this.qte)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';
        } else {this.reqQtte = '';}

        if (this.erreurType == 1) {
          this.prixUnit      = '-';
          this.prixOption    = '-';
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
          suma=cena;
          suma=fixstr(suma);
          this.suma2 = suma.replace(".", ",");
          this.prixTotal = this.suma2  +' €' ;

          genImg(); // générer l'image produit et l'ajouter au formulaire

          if ((this.produit == 'oriflamme' || this.produit == 'beachflag') && this.kit == 'kit complet') {
            this.details = formatProd+'<br />- '+composant+'<br />- '+this.choixPied;
          } else {
            this.details = formatProd+'<br />- '+composant;
          }

          // ---------------------------------------- données envoyées au panier
          var dprod = this.delaiprod;  if (this.delaiprod == '1-1') dprod = '1';
          var dliv  = this.delailiv;   if (this.delailiv  == '1-1') dliv  = '1';

          if (this.kit == 'structure seule') {
            this.inputDesc = '- '+this.designation+' '+this.details+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';
          } else {
            this.inputDesc = '- '+this.designation+' '+this.details+'<br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+'<br>- P '+dprod+'J / L '+dliv+'J';
          }

          this.inputProd      = 'Oriflamme';
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
