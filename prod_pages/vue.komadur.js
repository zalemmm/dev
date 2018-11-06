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
    choixProd : 'choisir l\'impression',
    choixOpts : '',
    choixLami : '',
    choixMaqt : '',
    choixSign : '',
    choixPers : '',
    choixPrint : '',

    qte: 1,
    adresse: true,
    atelier: false,
    relais: false,
    colis: false,
    palette: false,
    delaiprod: '',
    delailiv: '',

    // valeurs par défaut : classes
    reqProd: 'required',
    reqPrint: '',
    reqHaut: '',
    reqLarg: '',
    reqLami: '',
    reqMaqt: '',
    reqSign: '',
    reqQtte: '',
    reqEstm: '',
    reqOpts: '',
    reqPers: '',

    selectFirst: false,

    btnP1: 'inactive',
    btnP2: 'inactive',
    btnP3: 'inactive',
    btnD1: 'inactive',
    btnD2: 'inactive',
    btnD3: 'inactive',

    // valeurs par défaut de visibilité des blocs :
    toggleProd: true,
    togglePrint: true,
    toggleOpts: true,
    toggleLami: true,
    toggleMaqt: true,
    toggleSign: true,
    togglePers: true,

    showLami: false,
    showPrint: false,
    showOpts: false,
    showMaqt: false,
    showSign: false,
    showPers: false,
    showOptions: false,
    showLiv: false,
    showEsize: false,
    errorSize: false,
    optionSize: true,

    swRvd: false,
    nb: '',

    dateLivraison: false,
    livraisonrapide: false,
    livraisonComp: false,
    formError: false,
    formWarng: false,
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
    imgZoom: 'enseigne-impression-standard',

    // déclancheurs d'annimations :
    imgTrigger : false,
    hoverTrigger : false,
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
    prliv: '',
    cena2: 0,
    rabat2: 0,
    suma2: 0,
    transport: 0,
    hauteur: '',
    largeur: '',
    prodref: '',

    // valeurs par défaut bloc de droite :  prix et infos
    estdate: '',
    forfait: '',
    message: 'livraison comprise',
    erreurType: 0,
    errorMessage: '',
    warngMessage: '',
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

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/enseignes/bg.png)'};
        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/enseignes/dibond.svg)'};
        this.bg2 = {backgroundImage: 'none'};

        this.selectFirst = true;
        this.calqueVideo = false;
        this.calqueImage = true;

        if (this.produit == 'standard') this.imgZoom = 'enseigne-impression-standard';
        if (this.produit == 'uv hd')    this.imgZoom = 'enseigne-impression-uv-hd';
        if (this.produit == 'photo hd') this.imgZoom = 'enseigne-impression-photo-hd';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showPrint = true;
        this.reqPrint = 'required';
        this.togglePrint = true;
        this.choixPrint = 'choisir l\'impression';

    }, // fin fonction choix produit

    // fonction affichage champs formulaire :         au choix impression validé
    //==========================================================================
    selectPrint: function(value) {
        this.choixPrint = value;
        this.togglePrint = false;
        this.reqPrint = '';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showOpts = true;
        this.reqOpts = 'required';
        this.toggleOpts = true;
        this.choixOpts = 'choisir une option';
    },

    // fonction affichage champs formulaire :            au choix options validé
    //==========================================================================
    selectOpts: function(value) {
        this.choixOpts = value;
        this.toggleOpts = false;
        this.reqOpts = '';

        this.showPers  = this.showLami  = false;
        this.choixPers = this.choixLami = '';

        if (this.choixOpts == 'sans') {
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

          this.choixLami = 'sans lamination';
          this.nb = 'sans perçage';

        } else if (this.choixOpts == 'perçage') {
          this.showPers = true;
          this.reqPers = 'required';
          this.togglePers = true;

          this.choixPers = 'choisir le perçage';
          this.choixLami = 'sans lamination';

        } else {
          this.showLami = true;
          this.reqLami = 'required';
          this.toggleLami = true;

          this.choixLami = 'choisir le type de pelliculage';
          this.nb = 'sans perçage';
        }

    }, // fin fonction choix options


    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectLami: function(value, src) {
        this.choixLami = value;
        this.toggleLami = false;
        this.reqLami = '';

        this.bg2 = {backgroundImage: 'url('+this.$global.img+'/enseignes/'+src+'.svg)'};
        this.bg3 = {backgroundImage: 'url('+this.$global.img+'/enseignes/logo.svg)'};

        if (this.choixOpts == 'pelliculage et perçage') {
          this.showPers = true;
          this.reqPers = 'required';
          this.togglePers = true;
          this.choixPers = 'choisir le perçage';

        } else {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
    },

    // fonction affichage champs formulaire :            au choix perçage validé
    //==========================================================================
    selectPers: function(value) {
        this.choixPers = value;
        this.togglePers = false;
        this.reqPers = '';

        this.bg4 = {backgroundImage: 'url('+this.$global.img+'/enseignes/'+this.choixPers+'.svg)'}; //

        this.showMaqt = true;
        this.reqMaqt = 'required';
        this.toggleMaqt = true;
        this.choixMaqt = 'votre maquette (fichier d\'impression)';
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

        this.reqQtte = this.reqHaut = this.reqLarg = 'required';
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
        this.detImg = this.$global.img+'/enseignes/'+value+'.jpg';
        this.calqueImage = true;
        this.calqueVideo = false;
        v.pause();
      }

      this.pr2 = this.pr3 = this.pr4 = this.pr5 = false;
    },

    // fonctions hover :                                    HOVER texte OU image
    //==========================================================================
    // (calque) passe la valeur numérique du calque preview,
    // (src) passe soit le nom de l'image hover, soit le contenu texte pour le calque texte (9)

    hoPw: function(calque, src, src2) {
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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/enseignes/bg.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/enseignes/logo.svg),url('+this.$global.img+'/enseignes/'+src+'.svg)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/enseignes/bg.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/enseignes/'+src+'.jpg)'};
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
        this.atelier = false;
    },
    checkAtelier: function() {
        this.adresse = this.palette = false;
    },
    checkPalette: function() {
        this.atelier = false; this.adresse = true;
    },

    // fonctions input hauteur / largeur :                     check remplissage
    //==========================================================================
    checkSize: function(input, value) {
        if (value < 1 || isNaN(value) || value == '') {
          if (input == 'hauteur')  {this.reqHaut = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}
          if (input == 'largeur')  {this.reqLarg = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}

        } else if  (value < 30) {
          if (input == 'hauteur')  {this.reqHaut = 'required'; this.errorSize = 'taille minimum : 20x30 cm'; this.showEsize = true;}
          if (input == 'largeur')  {this.reqLarg = 'required'; this.errorSize = 'taille minimum : 20x30 cm'; this.showEsize = true;}

        } else {
          if (input == 'hauteur')  {this.reqHaut = ''; this.errorSize = ''; this.showEsize = false;}
          if (input == 'largeur')  {this.reqLarg = ''; this.errorSize = ''; this.showEsize = false;}
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

        this.ajoutPanier   = true;
        this.livraisonComp = true;
        this.dateTrigger   = !this.dateTrigger;

        //------------------------------------------- variables de calcul panier
        var cena           = 0;  var prixunite         = 0; var cena2 = 0;
        var suma           = 0;	 var suma2             = 0;
        var rabat          = 0;	 var rabat2            = 0;
        var transport      = 0;  var percage           = 0;
        var metraz 		     = 0;  var puoption          = 0;
        var prliv          = ''; var maquette          = 0;
        var Prixlamination = 0;  var tarifventouse     = 0;
        var nbtrou         = 0;  var fixationsventouse = 0;
        var option2        = 0;  var prixHD            = 0;
        var pu             = 0;  var fixations         = 0;
        var rectoverso     = 0;

        //----------------------------------------------------------------------
        metraz                 = this.largeur * this.hauteur;         // métrage
        metraz                 = fixstr(metraz);
        var metrazzaokraglony1 = (this.largeur + this.hauteur)*2;   // périmètre
        var metrazzaokraglony  = Math.round(metrazzaokraglony1);

        var hautbas            = this.largeur*2;
        var gauchedroite       = this.hauteur*2;

        //---------------------------------------------------------------- poids
        pu= 0.0030*metraz;

        poids = 1.6*metraz; // grammage x m²
        poidstotal = poids*this.qte;

        //---------------------------------------------------------- recto/verso
        if (this.choixPrint == 'Recto/Verso') {rectoverso = pu*0.5; pu += rectoverso;}

        //------------------------------------------------------------ fixations
        if (this.fixation == 'ventouse')    fixationsventouse=0.2;
        if (this.fixation == 'double face') fixations=0.3;

        //---------------------------------------------------------------perçage
        if (this.choixPers == '2')  {percage=0.4; nbtrou=2;  this.nb = '2 trous';}
        if (this.choixPers == '4')  {percage=0.8; nbtrou=4;  this.nb = '4 trous';}
        if (this.choixPers == '6')  {percage=1.2; nbtrou=6;  this.nb = '6 trous';}
        if (this.choixPers == '8')  {percage=1.6; nbtrou=8;  this.nb = '8 trous';}
        if (this.choixPers == '10') {percage=2;   nbtrou=10; this.nb = '10 trous';}

        tarifventouse = (fixationsventouse*nbtrou);

        //------------------------------------------------------------lamination

        if (this.choixLami == 'pelliculage brillant') {
          if (this.hauteur < 150  && this.largeur  < 150 && this.largeur <= this.hauteur) Prixlamination = 150*(this.largeur*0.0008);
          if (this.hauteur < 150  && this.largeur  < 150 && this.hauteur <= this.largeur) Prixlamination = 150*(this.hauteur*0.0008);
          if (this.hauteur < 150  && this.largeur >= 150)                                 Prixlamination = 150*(this.largeur*0.0008);
          if (this.largeur < 150  && this.hauteur >= 150)                                 Prixlamination = 150*(this.hauteur*0.0008);
          if (this.hauteur < 150  && this.largeur == 150)                                 Prixlamination = metraz*0.0008;
          if (this.largeur < 150  && this.hauteur == 150)                                 Prixlamination = metraz*0.0008;
          if (this.hauteur < 150  && this.largeur <  150 && this.hauteur <= this.largeur) Prixlamination = 150*(this.hauteur*0.0008);
          if (this.hauteur >= 150 && this.largeur >= 150)                                 Prixlamination = metraz*0.0008;
        }

        if (this.choixLami == 'pelliculage mat') {
          if (this.hauteur < 150  && this.largeur  < 150 && this.largeur <= this.hauteur) Prixlamination = 150*(this.largeur*0.0010);
          if (this.hauteur < 150  && this.largeur  < 150 && this.hauteur <= this.largeur) Prixlamination = 150*(this.hauteur*0.0010);
          if (this.hauteur < 150  && this.largeur >= 150)                                 Prixlamination = 150*(this.largeur*0.0010);
          if (this.largeur < 150  && this.hauteur >= 150)                                 Prixlamination = 150*(this.hauteur*0.0010);
          if (this.hauteur < 150  && this.largeur == 150)                                 Prixlamination = metraz*0.0010;
          if (this.largeur < 150  && this.hauteur == 150)                                 Prixlamination = metraz*0.0010;
          if (this.hauteur < 150  && this.largeur <  150 && this.hauteur <= this.largeur) Prixlamination = 150*(this.hauteur*0.0010);
          if (this.hauteur >= 150 && this.largeur >= 150)                                 Prixlamination = metraz*0.0010;
        }

        if (this.choixLami == 'pelliculage laqué anti graffiti') {
          if (this.hauteur < 150  && this.largeur  < 150 && this.largeur <= this.hauteur) Prixlamination = 150*(this.largeur*0.0018);
          if (this.hauteur < 150  && this.largeur  < 150 && this.hauteur <= this.largeur) Prixlamination = 150*(this.hauteur*0.0018);
          if (this.hauteur < 150  && this.largeur >= 150)                                 Prixlamination = 150*(this.largeur*0.0018);
          if (this.largeur < 150  && this.hauteur >= 150)                                 Prixlamination = 150*(this.hauteur*0.0018);
          if (this.hauteur < 150  && this.largeur == 150)                                 Prixlamination = metraz*0.0018;
          if (this.largeur < 150  && this.hauteur == 150)                                 Prixlamination = metraz*0.0018;
          if (this.hauteur < 150  && this.largeur <  150 && this.hauteur <= this.largeur) Prixlamination = 150*(this.hauteur*0.0018);
          if (this.hauteur >= 150 && this.largeur >= 150)                                 Prixlamination = metraz*0.0018;
        }

        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          maquette = this.$global.maqFB1;
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          maquette = this.$global.maqBAT;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          maquette = this.$global.maqONL;
          this.modmaq = 'je crée ma maquette en ligne';
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}

        //------------------------------------------------------- tarif unitaire
    		puoption = pu+fixations+percage+tarifventouse+Prixlamination;
    		puoption2 = puoption+(maquette/this.qte);

  			//-----------------------------------------------------------------total
  			cena = (puoption*this.qte)+maquette;

        // -------------------------------------------------------------------HD
        if (this.produit == 'uv hd'    || this.produit == 'uv hd')    {prixHD = cena*0.40; cena += prixHD;}
        if (this.produit == 'photo hd' || this.produit == 'photo hd') {prixHD = cena*0.90; cena += prixHD;}

        // ----------------------------------------------------------- SIGNATURE

        if (this.sign == 'sans signature') {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena+= this.$global.opSIGN*this.qte;}
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

        var palet = '';
    		if (this.palette == true) {
    			if (this.largeur+this.hauteur > 200 && this.largeur+this.hauteur <= 300) {cena += 99;}
    			if (this.largeur+this.hauteur > 300 && this.largeur+this.hauteur <= 400) {cena += 180;}
    			if (this.largeur+this.hauteur > 400) {cena += 240;}
    			palet = ' / forfait palettisation';
    		}

    		//------------------------------------------------------------ transport
    		if (poidstotal <= 1)                      prixtransport = 4.80;
    		if (poidstotal > 1  && poidstotal <= 2)   prixtransport = 5.1;
    		if (poidstotal > 2  && poidstotal <= 3)   prixtransport = 5.67;
    		if (poidstotal > 3  && poidstotal <= 4)   prixtransport = 5.63;
    		if (poidstotal > 4  && poidstotal <= 5)   prixtransport = 6.88;
    		if (poidstotal > 5  && poidstotal <= 6)   prixtransport = 7.99;
    		if (poidstotal > 6  && poidstotal <= 7)   prixtransport = 7.99;
    		if (poidstotal > 7  && poidstotal <= 10)  prixtransport = 9.30;
    		if (poidstotal > 10 && poidstotal <= 15)  prixtransport = 11.93;
    		if (poidstotal > 15 && poidstotal <= 20)  prixtransport = 14.93;
    		if (poidstotal > 20 && poidstotal <= 25)  prixtransport = 18.82;
    		if (poidstotal > 25 && poidstotal <= 30)  prixtransport = 20.56;
    		if (poidstotal > 30 && poidstotal <= 40)  prixtransport = 25.64;
    		if (poidstotal > 40 && poidstotal <= 50)  prixtransport = 33.73;
    		if (poidstotal > 50 && poidstotal <= 60)  prixtransport = 42.14;
    		if (poidstotal > 60 && poidstotal <= 70)  prixtransport = 47.71;
    		if (poidstotal > 70 && poidstotal <= 80)  prixtransport = 55.26;
    		if (poidstotal > 80 && poidstotal <= 90)  prixtransport = 62.12;
    		if (poidstotal > 90 && poidstotal <= 100) prixtransport = 68.54;
    		if (poidstotal > 100)                     prixtransport = 69.26;

    		prixtransport2 = prixtransport*0.5;
    		transport = prixtransport + prixtransport2;

    		var iloscmetrow1 = metraz*this.qte;
    		var iloscmetrow  = iloscmetrow1/10000;

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
          finalPrice               = (calculatedTotalPrice + price_unit)/this.qte;

          finalPrice1 = fixstr(finalPrice);
          finalPrice2 = finalPrice1.replace(".", ",");

          this.prixUnit = finalPrice2 +' €' ;
        }

        // ---------------------------------------------------------- PRIX TOTAL

        prixunite = finalPrice1;
        cena      = prixunite*this.qte;
        prixunite = fixstr(prixunite);
        this.transport = 0;
        this.cena2     = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS
        this.erreurType = 0;

        //                                       ERREURS TYPE 2 : AVERTISSEMENTS

        if (this.hauteur > 100 || this.largeur > 100 ) {
          if (this.palette == false) {
            this.warngMessage = '- Enseigne livrée découpée en mètre linéaire. Si vous souhaitez votre enseigne en 1 morceau, veuillez cocher l\'option "Grand format livré entier" (uniquement pour une enseigne inférieure à 150x300cm).';
  					this.erreurType = 2;
          }else{
            this.formWarng  = false;
            this.erreurType = 0;
          }
  			}

  			if ((this.hauteur > 150 && this.largeur > 300) || (this.hauteur > 300 && this.largeur > 150)) {
  					this.warngMessage = '- Votre enseigne est supérieure à 150x300cm, elle sera donc produite sur plusieurs plaques';
  					this.erreurType=2;
  			}

        //---------------------------- vérifier que les champs sont bien remplis

        if (this.choixOpts == 'choisir une option') {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir une option';
          this.erreurType=1;

        } else if (this.choixLami == 'choisir le type de pelliculage') {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir le type de pelliculage';
          this.erreurType=1;

        } else if (this.choixPers == 'choisir le perçage') {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir le perçage';
          this.erreurType=1;

        } else if (this.choixMaqt == 'votre maquette (fichier d\'impression)') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option maquette';

        } else if (this.choixSign == 'logo france banderole ?') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option signature';

        }else if (this.hauteur == '' || isNaN(this.hauteur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur';
          this.erreurType=1; this.reqHaut = 'required';

        } else if (this.largeur == '' || isNaN(this.largeur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une largeur';
          this.erreurType=1; this.reqLarg = 'required';

        } else if ((this.hauteur < 20  && this.largeur < 30 ) || (this.hauteur < 30  && this.largeur < 20)) {
  				this.errorMessage='<i class="fa fa-warning"></i> TAILLE MINIMALE 20x30cm !';
  				this.erreurType=1; this.reqHaut = this.reqLarg = 'required';

        } else if(this.qte < 1 || isNaN(this.qte)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';

        } else {this.reqQtte = '';}

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
        if (this.erreurType == 0 && this.delailiv == '1-1' && this.delaiprod == '1-1') this.livraisonrapide = true;
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

          this.inputHauteur = this.hauteur;
          this.inputLargeur = this.largeur;

          this.inputDesc = '- '+this.produit+' '+this.choixPrint+' <br />- H|'+this.hauteur+' x L|'+this.largeur+' <br>- '+this.choixLami+' <br>- '+this.nb+' <br>- '+this.modmaq+' <br>- '+this.sign+' <br>- '+this.retrait+this.optliv+palet+' <br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'Komadur';
          this.inputQte       = this.qte;
          this.inputPrix      = this.cena2;
          this.inputOption    = this.prixOption;
          this.inputRemise    = this.rabat2;
          this.inputTotal     = this.suma2;
          this.inputTransport = this.transport;

        }
    }, // fin fonction calculer
  }, // fin méthodes VUE
}); // fin instance VUE
