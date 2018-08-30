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
      choixFixx : '',
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
      reqFixx: '',
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
      showFixx: false,
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
      ourletsHB: true,
      ourletsGD: true,
      ourletsP:  true,
      fourreauxGD: true,
      fourreauxHB: true,
      swRvd: false,
      swEco: true,
      swNml: true,
      swFeu: true,
      swTis: true,

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
        this.showFini = this.showFfix = false; // refermer le déroulé nontissé
        this.showOeuil = this.showOrlt = this.showFour = this.showScra =  this.showFixx = false;// refermer le déroulé normal
        this.toggleFxqt = this.toggleSpce = this.toggleFpce = false; // refermer les sous-menus
        //this.oeillets = this.ourlets = this.fourreaux = this.scratch = this.fixation = this.finition = this.ffixation = ''; // réinitialiser les variables

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = this.pr2 = true;  // calques bg et produit activés
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/banderole/banderole-ext.png)'};
        this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsc.png)'};

        // afficher/masquer les images
        if (this.support == 'ecotoile')            this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/ecotoile.png)'};
        if (this.support == 'bache 100% écologique M1') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/eco.png)'};
        if (this.support == 'capotoile')           this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/capotoile.png)'};
        if (this.support == 'bache 440g')          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/440g.png)'};
        if (this.support == 'jet 550 enduite')     this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/550g.png)'};
        if (this.support == 'jet 550')             this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/jet550.png)'};
        if (this.support == 'bache micro perforee M1') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/micro.png)'};
        if (this.support == 'bache nontisse 150g') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/150g.png)'};
        if (this.support == 'bache 450 M1')        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/450g.png)'};
        if (this.support == 'jet 520 M1')          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/jet520.png)'};
        if (this.support == 'lacopac')             this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/750g.png)'};
        if (this.support == 'lacopac recto verso') this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/750grvSup.png), url('+this.$global.img+'/banderole/750g.png)'};
        if (this.support == 'tissu 220g')          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/220g.png)'};
        if (this.support == 'tissu 260g')          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/260g.png)'};

        // si bache nontissé, déroulé spécial
        if (this.support == 'bache nontisse 150g') {
          this.oeillets = this.ourlets = this.fourreaux = this.scratch = this.fixation = ''; // réinitialiser les options baches normales
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showOeil = false;
          this.showFini = true;
          this.reqFini = 'required';
          this.toggleFini = true;
          this.choixFini = 'voulez-vous des finitions ?';
        // sinon déroulé normal vers option oeillets :
        }else {
          this.finition = this.ffixation = ''; // réinitialiser les options intissé
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showFini = false;
          this.showOeil = true;
          this.reqOeil = 'required';
          this.toggleOeil = true;
          this.choixOeil = 'voulez-vous des oeillets ?';
        }
    },

    // fonction affichage champs formulaire :            choix finition nontissé
    //==========================================================================
    selectFini: function(value) {

        this.finition = value;
        this.choixFini = value;

        // on réinitialise les champs postérieurs si c'est un retour sur option :
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.showFfix = false; // pour le déroulé nontissé
        this.ffixation = '';

        // si oeuillets show espacement
        if(this.finition == 'oeillets haut/bas'){
          this.toggleFini = false;
          this.toggleFpce = true;
          this.reqFini = 'required';
          this.choixFpce = '- combien ?';

          this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb.png)'};
        // sinon passage au champ suivant
        }else{
          this.pr5 = true;
          this.toggleFini = false;
          this.toggleFpce = false;
          this.choixFpce = '';
          this.reqFini = '';

          if (this.finition == 'fourreaux gauche/droite') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/fourreaux.png)'};
          else                                            this.bg2 = {backgroundImage: 'none'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showFfix = true;
          this.reqFfix = 'required';
          this.toggleFfix = true;
          this.choixFfix = 'voulez-vous des fixations ?';
        }
    },

    // fonction affichage champs formulaire: au choix espacement oeillets validé
    //==========================================================================
    selectFpace: function(value) {

        this.choixFpce = value;
        this.toggleFini = false;
        this.toggleFpce = false;
        this.reqFini = '';

        // affichage image oeillets en foncgtion de l'espacement
        if      (this.choixFpce == 'tous les 100cm') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb.png)'};
        else if (this.choixFpce == 'tous les 50cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb50.png)'};
        else if (this.choixFpce == 'tous les 25cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb25.png)'};
        else if (this.choixFpce == 'tous les 10cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb10.png)'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showFfix = true;
        this.reqFfix = 'required';
        this.toggleFfix = true;
        this.choixFfix = 'voulez-vous des fixations ?';
    },

    // fonction affichage champs formulaire:                        nontissé fin
    //==========================================================================
    selectFfix: function(value) {

        this.pr5 = true;
        this.ffixation = value;
        this.choixFfix = value;
        this.toggleFfix = false;
        this.toggleFpce = false;
        this.reqFfix = '';

        if      (this.choixFfix == 'tendeurs H/B tous les metres') this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/tendeur.png)'};
        else if (this.choixFfix == '2 tourillons bois et sandows') this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/tourillons.png)'};
        else                                                       this.bg5 = {backgroundImage: 'none'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showMaqt = true;
        this.reqMaqt = 'required';
        this.toggleMaqt = true;
        this.choixMaqt = 'votre maquette (fichier d\'impression)';
    },

    // fonction affichage champs formulaire :       au choix mod oeillets validé
    //==========================================================================
    selectOeil: function(value) {

        this.bg2 = {backgroundImage: 'none'};
        this.oeillets = value;
        this.choixOeil = value;

        // on réinitialise les champs postérieurs si c'est un retour sur option :
        this.prH = this.pr3 = this.pr4 = this.pr5 = false;
        this.showOrlt = this.showFour = this.showScra =  this.showFixx = false;
        this.toggleFxqt = this.toggleSpce = false; // refermer les sous-menus
        //this.ourlets = this.fourreaux = this.scratch = this.fixation = '';

        // si oui oeuillets, choix option espacement
        if(this.oeillets != 'sans oeillets'){
          this.toggleOeil = false;
          this.toggleSpce = true;
          this.reqOeil = 'required';
          this.choixSpce = '- combien ?';

          // afficher image oillets et cacher options ourlets en fonction de la répartition des oeillets :
          if(this.oeillets == 'oeillets haut/bas') {
            this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb25.png)'};
            this.ourletsHB = true; this.ourletsGD = this.ourletsP = false;

          } else if(this.oeillets == 'oeillets gauche/droite') {
            this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsgd25.png)'};
            this.ourletsGD = true; this.ourletsHB = this.ourletsP = false;

          } else if(this.oeillets == 'oeillets tout le tour') {
            this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsp.png)'};
            this.ourletsP = true; this.ourletsHB = this.ourletsGD = false;

          } else { // par défaut choix oeillets au coins : toutes option affichées
            this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsc.png)'};
            this.ourletsHB = this.ourletsGD = this.ourletsP = true;
            this.toggleSpce = false;
            this.reqOeil = '';
            this.choixSpce = '';

            // afficher le champ suivant et indiquer qu'il est requis :
            this.showOrlt = true;
            this.reqOrlt = 'required';
            this.toggleOrlt = true;
            this.choixOrlt = 'voulez-vous des ourlets ?';
          }

        // si pas d'oeillets, passage au champ fourreaux :
        }else{
          this.bg2 = {backgroundImage: ''};
          this.toggleOeil = false;
          this.toggleSpce = false;
          this.choixSpce = '';
          this.reqOeil = '';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showOrlt = false;
          this.showFour = true;
          this.reqFour = 'required';
          this.toggleFour = true;
          this.choixFour = 'voulez-vous des fourreaux ?';
          this.fourreauxGD = this.fourreauxHB = true;
        }
    },

    // fonction affichage champs formulaire: au choix espacement oeillets validé
    //==========================================================================
    selectSpace: function(value) {
        this.prH = false; // cacher preview
        this.choixSpce = value;
        this.toggleOeil = false;
        this.toggleSpce = false;
        this.reqOeil = '';

        // affichage image oeillets en foncgtion de l'espacement
        if(this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 100cm') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb.png)'};
        if(this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 50cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb50.png)'};
        if(this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 25cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb25.png)'};
        if(this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 10cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb10.png)'};

        if(this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 100cm') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsc.png)'};
        if(this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 50cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsgd.png)'};
        if(this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 25cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsgd25.png)'};
        if(this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 10cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsgd10.png)'};

        if(this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 100cm') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb.png)'};
        if(this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 50cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletshb50.png)'};
        if(this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 25cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsp.png)'};
        if(this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 10cm')  this.bg2 = {backgroundImage: 'url('+this.$global.img+'/banderole/oeilletsp10.png)'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showOrlt = true;
        this.reqOrlt = 'required';
        this.toggleOrlt = true;
        this.choixOrlt = 'voulez-vous des ourlets ?';
    },

    // fonction affichage champs formulaire:             au choix ourlets validé
    //==========================================================================
    selectOrlt: function(value) {

        this.bg3 = '';
        this.ourlets = value;
        this.choixOrlt = value;
        this.toggleOrlt = false;
        this.reqOrlt = '';

        // on réinitialise les champs postérieurs si c'est un retour sur option :
        this.prH = this.pr4 = this.pr5 = false;
        this.showFour = this.showScra =  this.showFixx = false;
        this.toggleFxqt = false; // refermer les sous-menus
        //this.fourreaux = this.scratch = this.fixation = '';

        // images et afficher masquer les options fourreaux en fonction du chois ourlet :
        if (this.ourlets == 'ourlet de renfort perimetrique') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourlets.png)'};

        } else if(this.ourlets == 'ourlet de renfort haut/bas') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourletshb.png)'};
          this.fourreauxGD = true; this.fourreauxHB = false;

        } else if(this.ourlets == 'ourlet de renfort gauche/droite') {
          this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourletsgd.png)'};
          this.fourreauxHB = true; this.fourreauxGD = false;

        } else if(this.ourlets == 'sans ourlet') {
          this.bg3 = {backgroundImage: 'none'};
          this.fourreauxGD = true; this.fourreauxHB = true;
        } // par défaut sans oeillets toutes les options actives

        // si pas d'ourlets perimetrique, choix fourreaux :
        if(this.ourlets !== 'ourlet de renfort perimetrique') {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showFour = true;
          this.reqFour = 'required';
          this.toggleFour = true;
          this.choixFour = 'voulez-vous des fourreaux ?';

        // si ourlet perimetrique, pas d'option fourreaux, passage au champ fixations
        }else{
          this.showFour = false;
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showFixx = true;
          this.reqFixx = 'required';
          this.toggleFixx = true;
          this.choixFixx = 'voulez-vous des fixations ?';
        }
    },

    // fonction affichage champs formulaire:           au choix fourreaux validé
    //==========================================================================
    selectFour: function(value) {
        this.prH = false; // cacher preview
        this.pr4 = true;
        this.fourreaux = value;
        this.choixFour = value;
        this.toggleFour = false;
        this.reqFour = '';

        // on réinitialise les champs postérieurs si c'est un retour sur option :
        this.pr5 = false;
        this.showScra =  this.showFixx = false;
        this.toggleFxqt = false; // refermer les sous-menus
        //this.scratch = this.fixation = '';

        // affichage image fourreaux
        if (this.fourreaux == 'fourreaux haut/bas')           this.bg4 = {backgroundImage: 'url('+this.$global.img+'/banderole/fourreauxhb.png)'};
        else if (this.fourreaux == 'fourreaux gauche/droite') this.bg4 = {backgroundImage: 'url('+this.$global.img+'/banderole/fourreaux.png)'};
        else                                                  this.bg4 = {backgroundImage: 'none'};

        // si ni oeillets ni fourreaux, afficher option scratch :
        if(this.oeillets == 'sans oeillets' && this.fourreaux == 'sans fourreaux') {
          // afficher le champ scratch et indiquer qu'il est requis :
          this.showScra = true;
          this.reqScra = 'required';
          this.toggleScra = true;
          this.choixScra = 'voulez-vous des scratches ?';

        // sinon passage au champ fixations
        }else{
          this.showScra = false;
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showFixx = true;
          this.reqFixx = 'required';
          this.toggleFixx = true;
          this.choixFixx = 'voulez-vous des fixations ?';
        }

    },

    // fonction affichage champs formulaire:             au choix scratch validé
    //==========================================================================
    selectScra: function(value) {
        this.prH = false; // cacher preview
        this.pr3 = true;
        this.scratch = value;
        this.choixScra = value;
        this.toggleScra = false;
        this.reqScra = '';

        // on réinitialise les champs postérieurs si c'est un retour sur option :
        this.showFixx = false;
        this.toggleFxqt = false; // refermer les sous-menus
        //this.fixation = '';

        // afficher image scratch
        if (this.scratch == 'scratch haut/bas')           this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourletshb.png)'};
        else if (this.scratch == 'scratch gauche/droite') this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourletsdg.png)'};
        else if (this.scratch == 'scratch perimetrique')  this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourlets.png)'};
        else                                              this.bg3 = {backgroundImage: 'none'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showFixx = true;
        this.reqFixx = 'required';
        this.toggleFixx = true;
        this.choixFixx = 'voulez-vous des fixations ?';
    },

    // fonction affichage champs formulaire :       au choix mod oeillets validé
    //==========================================================================
    selectFixx: function(value) {
        this.prH = false; // cacher preview
        this.pr5 = true;
        this.fixation = value;
        this.choixFixx = value;

        // images
        if (this.fixation == 'tendeurs')                  this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/tendeur.png)'};
        else if (this.fixation == 'rislans')              this.bg5 = {backgroundImage: 'url('+this.$global.img+'/banderole/rislan.png)'};
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
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
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
        this.reqHaut = this.reqLarg = 'required';
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

		//------------------------------prix banderole tissu en fonction de la laize
		if (this.support == 'tissu 260g' || this.support == 'tissu 220g'){
    		if (this.largeur  <= 1.55)                     {l1 = 1.55; l2 = 1.55-this.largeur;  perteL = l2*this.hauteur;}
    		if (this.largeur  >= 1.56 && this.largeur <= 2.60)  {l1 = 2.60; l2 = 2.60-this.largeur;  perteL = l2*this.hauteur;}
    		if (this.largeur  >= 2.61)                     {l1 = this.largeur; perteL = this.largeur*this.hauteur;}

    		if (this.hauteur <= 1.55)                     {h1 = 1.55; h2 = 1.55-this.hauteur; perteH = h2*this.largeur;}
    		if (this.hauteur >= 1.56 && this.hauteur <= 2.60)  {h1 = 2.60; h2 = 2.60-this.hauteur; perteH = h2*this.largeur;}
    		if (this.hauteur >= 2.61)                     {h1 = this.hauteur; perteH = this.hauteur*this.largeur;}
			
			
			
			if (perteH < perteL ) {

    			metrage = this.largeur*h1;

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

    		} else if (perteH > perteL) {

    			metrage = this.hauteur*l1;

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

    		} else if (perteH == perteL) {

    			metrage = this.hauteur*l1;

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

    			prixproduit = metrage*plm; // prix banderole tissu
    		}
			
		;}


        //------------------------- prix de la banderole en fonction de la laize (hors tissu)

    		if (this.largeur <= 0.50)                         {l1=0.5; l2=0.5-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 0.51 && this.largeur <= 0.80) {l1=0.80; l2=0.80-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 0.81 && this.largeur <= 1.10) {l1=1.10; l2=1.10-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 1.11 && this.largeur <= 1.37) {l1=1.37; l2=1.37-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 1.38 && this.largeur <= 1.60) {l1=1.60; l2=1.60-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 1.61 && this.largeur <= 2.00) {l1=2.00; l2=2.00-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 2.01 && this.largeur <= 2.50) {l1=2.50; l2=2.50-this.largeur; perteL=l2*this.hauteur;};
    		if (this.largeur >= 2.51)                         {l1=this.largeur; perteL=this.largeur*this.hauteur;};

    		if (this.hauteur <= 0.50)                          {h1=0.5; h2=0.5-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 0.51 && this.hauteur <= 0.80) {h1=0.80; h2=0.80-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 0.81 && this.hauteur <= 1.10) {h1=1.10; h2=1.10-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 1.11 && this.hauteur <= 1.37) {h1=1.37; h2=1.37-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 1.38 && this.hauteur <= 1.60) {h1=1.60; h2=1.60-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 1.61 && this.hauteur <= 2.00) {h1=2.00; h2=2.00-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 2.01 && this.hauteur <= 2.50) {h1=2.50; h2=2.50-this.hauteur; perteH=h2*this.largeur;};
    		if (this.hauteur >= 2.51)                         {h1=this.hauteur; perteH=this.hauteur*this.largeur;};

    		if (perteH < perteL){
    			metrage = this.largeur*h1;
    			////bache 440g
    			if ((this.support == 'bache 440g' ) && (h1<=1.00) ){plm =6.45 ;}
    			if ((this.support == 'bache 440g' ) && ((h1>=1.01)&&(h1<=1.60))){plm =6.77 ;}
    			if ((this.support == 'bache 440g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =7.10 ;}
    			if ((this.support == 'bache 440g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =7.42 ;}
    			if ((this.support == 'bache 440g' ) && (h1>=2.51)){plm =7.74 ;}
    			////bache nontisse 150g
    			if ((this.support == 'bache nontisse 150g' ) && (h1<=1.00) ){plm =6.45*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=1.01)&&(h1<=1.60))){plm =6.77*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =7.10*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =7.42*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && (h1>=2.51)){plm =7.74*1.05 ;}

    			////ecotoile
    			if ((this.support == 'ecotoile' ) && (h1<=1.00) ){plm =6.24 ;}
    			if ((this.support == 'ecotoile' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =6.55 ;}
    			if ((this.support == 'ecotoile' ) && ((h1>=1.61)&&(h1<=2.00))){plm =6.86 ;}
    			if ((this.support == 'ecotoile' ) && ((h1>=2.01)&&(h1<=2.50))){plm =7.18 ;}
    			if ((this.support == 'ecotoile' ) && (h1>=2.51)){plm =7.49 ;}
    			////jet 550
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && (h1<=1.00) ){plm =12.45 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((h1>=1.01)&&(h1<=1.60)) ){plm =13.07 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((h1>=1.61)&&(h1<=2.00))){plm =13.70 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((h1>=2.01)&&(h1<=2.50))){plm =14.32 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && (h1>=2.51)){plm =14.94 ;}
    			////450M1
    			if ((this.support == 'bache 450 M1') && (h1<=1.00)) {plm =12.45*0.8 ;} /////////////jet 550 -20%
    			if ((this.support == 'bache 450 M1') && ((h1>=1.01)&&(h1<=1.60))) {plm =13.07*0.8 ;}
    			if ((this.support == 'bache 450 M1')  && ((h1>=1.61)&&(h1<=2.00))){plm =13.70*0.8 ;}
    			if ((this.support == 'bache 450 M1')  &&((h1>=2.01)&&(h1<=2.50))){plm =14.32*0.8 ;}
    			if ((this.support == 'bache 450 M1')  && (h1>=2.51)){plm =14.94*0.8 ;}

    			////jet 520 M1
    			if ((this.support == 'jet 520 M1' ) && (h1<=1.00) ){plm =15.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =16.70 ;}
    			if ((this.support == 'jet 520 M1' ) && ((h1>=1.61)&&(h1<=2.00))){plm =17.49 ;}
    			if ((this.support == 'jet 520 M1' ) && ((h1>=2.01)&&(h1<=2.50))){plm =18.29 ;}
    			if ((this.support == 'jet 520 M1' ) && (h1>=2.51)){plm =19.08 ;}

    			////lacopac
    			if ((this.support == 'lacopac' ) && (h1<=1.00) ){plm =18.15 ;}
    			if ((this.support == 'lacopac' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =19.06 ;}
    			if ((this.support == 'lacopac' ) && ((h1>=1.61)&&(h1<=2.00))){plm =19.97 ;}
    			if ((this.support == 'lacopac' ) && ((h1>=2.01)&&(h1<=2.50))){plm =20.87 ;}
    			if ((this.support == 'lacopac' ) && (h1>=2.51)){plm =21.78 ;}
    			////lacopac recto verso
    			if ((this.support == 'lacopac recto verso' ) && (h1<=1.00) ){plm =24.15 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =25.36 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((h1>=1.61)&&(h1<=2.00))){plm =26.57 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((h1>=2.01)&&(h1<=2.50))){plm =27.77 ;}
    			if ((this.support == 'lacopac recto verso' ) && (h1>=2.51)){plm =28.98 ;}
    			////bache micro perforee M1
    			if ((this.support == 'bache micro perforee M1' ) && (h1<=1.00) ){plm =8.91 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =9.36 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((h1>=1.61)&&(h1<=2.00))){plm =9.80 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((h1>=2.01)&&(h1<=2.50))){plm =10.25 ;}
    			if ((this.support == 'bache micro perforee M1' ) && (h1>=2.51)){plm =10.69 ;}
    			////bache 100% écologique M1
    			if ((this.support == 'bache 100% écologique M1' ) && (h1<=1.00) ){plm =18.69 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =19.62 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((h1>=1.61)&&(h1<=2.00))){plm =20.56 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((h1>=2.01)&&(h1<=2.50))){plm =21.49 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && (h1>=2.51)){plm =22.43 ;}
    			////capotoile
    			if ((this.support == 'capotoile' ) && (h1<=1.00) ){plm =24.90 ;}
    			if ((this.support == 'capotoile' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =26.15 ;}
    			if ((this.support == 'capotoile' ) && ((h1>=1.61)&&(h1<=2.00))){plm =27.39 ;}
    			if ((this.support == 'capotoile' ) && ((h1>=2.01)&&(h1<=2.50))){plm =28.64 ;}
    			if ((this.support == 'capotoile' ) && (h1>=2.51)){plm =29.88 ;}
    			////tissu 220g
    			/*if ((this.support == 'tissu 220g' ) && (h1<=1.00) ){plm =19.50 ;}
    			if ((this.support == 'tissu 220g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =20.48 ;}
    			if ((this.support == 'tissu 220g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =21.45 ;}
    			if ((this.support == 'tissu 220g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =22.43 ;}
    			if ((this.support == 'tissu 220g' ) && (h1>=2.51)){plm =23.40 ;}*/
    			////tissu 260g
    			/*if ((this.support == 'tissu 260g' ) && (h1<=1.00) ){plm =31.50 ;}
    			if ((this.support == 'tissu 260g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =33.08 ;}
    			if ((this.support == 'tissu 260g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =34.65 ;}
    			if ((this.support == 'tissu 260g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =36.23 ;}
    			if ((this.support == 'tissu 260g' ) && (h1>=2.51)){plm =37.80 ;}*/

    			prixproduit = metrage*plm;
    		}

    		else if (perteH > perteL){
    			metrage = this.hauteur*l1;
    			////bache 440g
    			if ((this.support == 'bache 440g' ) && (l1<=1.00) ){plm =6.45 ;}
    			if ((this.support == 'bache 440g' ) && ((l1>=1.01)&&(l1<=1.60))){plm =6.77 ;}
    			if ((this.support == 'bache 440g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =7.10 ;}
    			if ((this.support == 'bache 440g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =7.42 ;}
    			if ((this.support == 'bache 440g' ) && (l1>=2.51)){plm =7.74 ;}
    			////bache nontisse 150g
    			if ((this.support == 'bache nontisse 150g' ) && (h1<=1.00) ){plm =6.45*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=1.01)&&(h1<=1.60))){plm =6.77*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =7.10*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =7.42*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && (h1>=2.51)){plm =7.74*1.05 ;}
    			////ecotoile
    			if ((this.support == 'ecotoile' ) && (l1<=1.00) ){plm =6.24 ;}
    			if ((this.support == 'ecotoile' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =6.55 ;}
    			if ((this.support == 'ecotoile' ) && ((l1>=1.61)&&(l1<=2.00))){plm =6.86 ;}
    			if ((this.support == 'ecotoile' ) && ((l1>=2.01)&&(l1<=2.50))){plm =7.18 ;}
    			if ((this.support == 'ecotoile' ) && (l1>=2.51)){plm =7.49 ;}
    			////jet 550
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && (l1<=1.00) ){plm =12.45 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((l1>=1.01)&&(l1<=1.60)) ){plm =13.07 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((l1>=1.61)&&(l1<=2.00))){plm =13.70 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((l1>=2.01)&&(l1<=2.50))){plm =14.32 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && (l1>=2.51)){plm =14.94 ;}
    			////450M1
    			if ((this.support == 'bache 450 M1') && (h1<=1.00)) {plm =12.45*0.8 ;} /////////////jet 550 -20%
    			if ((this.support == 'bache 450 M1') && ((h1>=1.01)&&(h1<=1.60))) {plm =13.07*0.8 ;}
    			if ((this.support == 'bache 450 M1')  && ((h1>=1.61)&&(h1<=2.00))){plm =13.70*0.8 ;}
    			if ((this.support == 'bache 450 M1')  &&((h1>=2.01)&&(h1<=2.50))){plm =14.32*0.8 ;}
    			if ((this.support == 'bache 450 M1')  && (h1>=2.51)){plm =14.94*0.8 ;}
    			////jet 520 M1
    			if ((this.support == 'jet 520 M1' ) && (l1<=1.00) ){plm =15.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =16.70 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=1.61)&&(l1<=2.00))){plm =17.49 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=2.01)&&(l1<=2.50))){plm =18.29 ;}
    			if ((this.support == 'jet 520 M1' ) && (l1>=2.51)){plm =19.08 ;}
    			////lacopac
    			if ((this.support == 'lacopac' ) && (l1<=1.00) ){plm =18.15 ;}
    			if ((this.support == 'lacopac' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =19.06 ;}
    			if ((this.support == 'lacopac' ) && ((l1>=1.61)&&(l1<=2.00))){plm =19.97 ;}
    			if ((this.support == 'lacopac' ) && ((l1>=2.01)&&(l1<=2.50))){plm =20.87 ;}
    			if ((this.support == 'lacopac' ) && (l1>=2.51)){plm =21.78 ;}
    			////lacopac recto verso
    			if ((this.support == 'lacopac recto verso' ) && (l1<=1.00) ){plm =24.15 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =25.36 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((l1>=1.61)&&(l1<=2.00))){plm =26.57 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((l1>=2.01)&&(l1<=2.50))){plm =27.77 ;}
    			if ((this.support == 'lacopac recto verso' ) && (l1>=2.51)){plm =28.98 ;}
    			////bache micro perforee M1
    			if ((this.support == 'bache micro perforee M1' ) && (l1<=1.00) ){plm =8.91 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =9.36 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=1.61)&&(l1<=2.00))){plm =9.80 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=2.01)&&(l1<=2.50))){plm =10.25 ;}
    			if ((this.support == 'bache micro perforee M1' ) && (l1>=2.51)){plm =10.69 ;}
    			////bache 100% écologique M1
    			if ((this.support == 'bache 100% écologique M1' ) && (l1<=1.00) ){plm =18.69 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =19.62 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((l1>=1.61)&&(l1<=2.00))){plm =20.56 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((l1>=2.01)&&(l1<=2.50))){plm =21.49 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && (l1>=2.51)){plm =22.43 ;}
    			////capotoile
    			if ((this.support == 'capotoile' ) && (l1<=1.00) ){plm =24.90 ;}
    			if ((this.support == 'capotoile' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =26.15 ;}
    			if ((this.support == 'capotoile' ) && ((l1>=1.61)&&(l1<=2.00))){plm =27.39 ;}
    			if ((this.support == 'capotoile' ) && ((l1>=2.01)&&(l1<=2.50))){plm =28.64 ;}
    			if ((this.support == 'capotoile' ) && (l1>=2.51)){plm =29.88 ;}
    			////tissu 220g
    			/*if ((this.support == 'tissu 220g' ) && (l1<=1.00) ){plm =19.50 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =20.48 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =21.45 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =22.43 ;}
    			if ((this.support == 'tissu 220g' ) && (l1>=2.51)){plm =23.40 ;}*/
    			////tissu 260g
    			/*if ((this.support == 'tissu 260g' ) && (l1<=1.00) ){plm =31.50 ;}
    			if ((this.support == 'tissu 260g' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =33.08 ;}
    			if ((this.support == 'tissu 260g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =34.65 ;}
    			if ((this.support == 'tissu 260g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =36.23 ;}
    			if ((this.support == 'tissu 260g' ) && (l1>=2.51)){plm =37.80 ;}
*/
    			prixproduit = metrage*plm;
    		}

    		else if(perteH == perteL){
    			metrage = this.hauteur*l1;
    			////bache 440g
    			if ((this.support == 'bache 440g' ) && (l1<=1.00) ){plm =6.45 ;}
    			if ((this.support == 'bache 440g' ) && ((l1>=1.01)&&(l1<=1.60))){plm =6.77 ;}
    			if ((this.support == 'bache 440g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =7.10 ;}
    			if ((this.support == 'bache 440g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =7.42 ;}
    			if ((this.support == 'bache 440g' ) && (l1>=2.51)){plm =7.74 ;}
    			////bache nontisse 150g
    			if ((this.support == 'bache nontisse 150g' ) && (h1<=1.00) ){plm =6.45*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=1.01)&&(h1<=1.60))){plm =6.77*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =7.10*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =7.42*1.05 ;}
    			if ((this.support == 'bache nontisse 150g' ) && (h1>=2.51)){plm =7.74*1.05;}

    			////ecotoile
    			if ((this.support == 'ecotoile' ) && (l1<=1.00) ){plm =6.24 ;}
    			if ((this.support == 'ecotoile' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =6.55 ;}
    			if ((this.support == 'ecotoile' ) && ((l1>=1.61)&&(l1<=2.00))){plm =6.86 ;}
    			if ((this.support == 'ecotoile' ) && ((l1>=2.01)&&(l1<=2.50))){plm =7.18 ;}
    			if ((this.support == 'ecotoile' ) && (l1>=2.51)){plm =7.49 ;}
    			////jet 550
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && (l1<=1.00) ){plm =12.45 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((l1>=1.01)&&(l1<=1.60)) ){plm =13.07 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((l1>=1.61)&&(l1<=2.00))){plm =13.70 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && ((l1>=2.01)&&(l1<=2.50))){plm =14.32 ;}
    			if ((this.support == 'jet 550' || this.support == 'jet 550 enduite') && (l1>=2.51)){plm =14.94 ;}
    			////450M1
    			if ((this.support == 'bache 450 M1') && (h1<=1.00)) {plm =12.45*0.8 ;} /////////////jet 550 -20%
    			if ((this.support == 'bache 450 M1') && ((h1>=1.01)&&(h1<=1.60))) {plm =13.07*0.8 ;}
    			if ((this.support == 'bache 450 M1')  && ((h1>=1.61)&&(h1<=2.00))){plm =13.70*0.8 ;}
    			if ((this.support == 'bache 450 M1')  &&((h1>=2.01)&&(h1<=2.50))){plm =14.32*0.8 ;}
    			if ((this.support == 'bache 450 M1')  && (h1>=2.51)){plm =14.94*0.8 ;}
    			////jet 520 M1
    			if ((this.support == 'jet 520 M1' ) && (l1<=1.00) ){plm =15.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =16.70 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=1.61)&&(l1<=2.00))){plm =17.49 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=2.01)&&(l1<=2.50))){plm =18.29 ;}
    			if ((this.support == 'jet 520 M1' ) && (l1>=2.51)){plm =19.08 ;}
    			////lacopac
    			if ((this.support == 'lacopac' ) && (l1<=1.00) ){plm =18.15 ;}
    			if ((this.support == 'lacopac' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =19.06 ;}
    			if ((this.support == 'lacopac' ) && ((l1>=1.61)&&(l1<=2.00))){plm =19.97 ;}
    			if ((this.support == 'lacopac' ) && ((l1>=2.01)&&(l1<=2.50))){plm =20.87 ;}
    			if ((this.support == 'lacopac' ) && (l1>=2.51)){plm =21.78 ;}
    			////lacopac recto verso
    			if ((this.support == 'lacopac recto verso' ) && (l1<=1.00) ){plm =24.15 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =25.36 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((l1>=1.61)&&(l1<=2.00))){plm =26.57 ;}
    			if ((this.support == 'lacopac recto verso' ) && ((l1>=2.01)&&(l1<=2.50))){plm =27.77 ;}
    			if ((this.support == 'lacopac recto verso' ) && (l1>=2.51)){plm =28.98 ;}
    			////bache micro perforee M1
    			if ((this.support == 'bache micro perforee M1' ) && (l1<=1.00) ){plm =8.91 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =9.36 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=1.61)&&(l1<=2.00))){plm =9.80 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=2.01)&&(l1<=2.50))){plm =10.25 ;}
    			if ((this.support == 'bache micro perforee M1' ) && (l1>=2.51)){plm =10.69 ;}
    			////bache 100% écologique M1
    			if ((this.support == 'bache 100% écologique M1' ) && (l1<=1.00) ){plm =18.69 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =19.62 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((l1>=1.61)&&(l1<=2.00))){plm =20.56 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && ((l1>=2.01)&&(l1<=2.50))){plm =21.49 ;}
    			if ((this.support == 'bache 100% écologique M1' ) && (l1>=2.51)){plm =22.43 ;}
    			////capotoile
    			if ((this.support == 'capotoile' ) && (l1<=1.00) ){plm =24.90 ;}
    			if ((this.support == 'capotoile' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =26.15 ;}
    			if ((this.support == 'capotoile' ) && ((l1>=1.61)&&(l1<=2.00))){plm =27.39 ;}
    			if ((this.support == 'capotoile' ) && ((l1>=2.01)&&(l1<=2.50))){plm =28.64 ;}
    			if ((this.support == 'capotoile' ) && (l1>=2.51)){plm =29.88 ;}
    			////tissu 220g
    			/*if ((this.support == 'tissu 220g' ) && (l1<=1.00) ){plm =19.50 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =20.48 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =21.45 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =22.43 ;}
    			if ((this.support == 'tissu 220g' ) && (l1>=2.51)){plm =23.40 ;}*/
    			////tissu 260g
    			/*if ((this.support == 'tissu 260g' ) && (l1<=1.00) ){plm =31.50 ;}
    			if ((this.support == 'tissu 260g' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =33.08 ;}
    			if ((this.support == 'tissu 260g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =34.65 ;}
    			if ((this.support == 'tissu 260g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =36.23 ;}
    			if ((this.support == 'tissu 260g' ) && (l1>=2.51)){plm =37.80 ;}*/

    			prixproduit = metrage*plm; //prix de la banderole
    		}

    		metragefinal = metrage*this.qte;
    		this.prixTotal = prixproduit*this.qte;

    		//---------- prix de l'ensemble de la commande en fonction metrage final

    		//----------------------------------------------------------------- 440g
    		if (this.support == 'bache 440g' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache 440g'
    		}

    		//-------------------------------------------------- bache nontisse 150g
    		if (this.support == 'bache nontisse 150g' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache nontisse 150g'
    		}

    		//--------------------------------------------------------------ecotoile
    		if (this.support == 'ecotoile' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- EcoToile'
    		}

    		//-------------------------------------------------------------- JET 550
    		if (this.support == 'jet 550' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache Jet 550'
    		}

    		//--------------------------------------------------------------- 450 M1
    		if (this.support == 'bache 450 M1' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache 450 M1'
    		}

    		//------------------------------------------------------ JET 550 enduite
    		if (this.support == 'jet 550 enduite' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			cenatotal = cenatotal-(cenatotal*20/100);
    			bacheType = '- bache 550g enduite'
    		}

    		//---------------------------------------------------------------JET 520
    		if (this.support == 'jet 520 M1' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache Jet 520 M1'
    		}

    		//------------------------------------------------------------------750g
    		if (this.support == 'lacopac' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache Lacopac M2/B1'
    		}

    		//---------------------------------------------------------------750g RV
    		if (this.support == 'lacopac recto verso' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache Lacopac M2/B1 recto verso'
    		}

    		//------------------------------------------------------- micro perforée
    		if (this.support == 'bache micro perforee M1' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache micro perforée'
    		}

    		//--------------------------------------------------------------100% éco
    		if (this.support == 'bache 100% écologique M1' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- bache 100% écologique M1'
    		}

    		//-------------------------------------------------------------capotoile
    		if (this.support == 'capotoile' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- Capotoile 320 M1 validé Ecocert Erts'
    		}

    		//----------------------------------------------------------- tissu 220g
    		if (this.support == 'tissu 220g' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- tissu stretch léger 220g B1'
    		}

    		//----------------------------------------------------------- tissu 260g
    		if (this.support == 'tissu 260g' ) {
    			if (metragefinal < 1.99) {cenatotal = this.prixTotal;}
    			if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = this.prixTotal*0.99;}
    			if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = this.prixTotal*0.98;}
    			if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = this.prixTotal*0.97;}
    			if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = this.prixTotal*0.96;}
    			if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = this.prixTotal*0.95;}
    			if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = this.prixTotal*0.94;}
    			if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = this.prixTotal*0.93;}
    			if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = this.prixTotal*0.92;}
    			if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = this.prixTotal*0.91;}
    			if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = this.prixTotal*0.90;}
    			if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = this.prixTotal*0.89;}
    			if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = this.prixTotal*0.88;}
    			if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = this.prixTotal*0.87;}
    			if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = this.prixTotal*0.86;}
    			if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = this.prixTotal*0.85;}
    			if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = this.prixTotal*0.84;}
    			if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = this.prixTotal*0.83;}
    			if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = this.prixTotal*0.82;}
    			if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = this.prixTotal*0.81;}
    			if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = this.prixTotal*0.80;}
    			if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = this.prixTotal*0.79;}
    			if (metragefinal > 499.99) {cenatotal = this.prixTotal*0.78;}
    			bacheType = '- tissu stretch extensible 260g B1'
    		}

        //---------------------------------------------------- PRIX TOTAL BACHES

    		cena = cenatotal/this.qte;
        console.log('cena:' +cena);

        //===============================================================OPTIONS

        if (this.support == 'bache nontisse 150g') {                 // nontissé

          if (this.finition  == 'fourreaux gauche/droite')                                 cena+= gauchedroite*3;
      		if (this.finition  == 'oeillets haut/bas' && this.choixFpce == 'tous les 100cm') cena+= ((hautbas+2)/1)*0.3;
      		if (this.finition  == 'oeillets haut/bas' && this.choixFpce == 'tous les 50cm')  cena+= ((hautbas+2)/0.5)*0.3;
      		if (this.finition  == 'oeillets haut/bas' && this.choixFpce == 'tous les 25cm')  cena+= ((hautbas+2)/0.25)*0.3;
      		if (this.finition  == 'oeillets haut/bas' && this.choixFpce == 'tous les 10cm')  cena+= ((hautbas+2)/0.1)*0.3;
          if (this.ffixation == 'tendeurs H/B tous les metres')                            cena+= (metrazzaokraglony+2)*0.75;
      		if (this.ffixation == '2 tourillons bois et sandows')                            cena+= 9.90;

        } else {                                                // autres baches

          //-------------------------------------------------------------oeilets
          var oeillets = 0;

      		if (this.oeillets == 'oeillets aux coins' ) oeillets = 0.00*4;

      		if (this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 100cm') oeillets = ((hautbas+2)/1)*0.00;
      		if (this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 50cm')  oeillets = ((hautbas+2)/0.5)*0.15;
      		if (this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 25cm')  oeillets = ((hautbas+2)/0.25)*0.15;
      		if (this.oeillets == 'oeillets haut/bas' && this.choixSpce == 'tous les 10cm')  oeillets = ((hautbas+2)/0.1)*0.15;

      		if (this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 100cm') oeillets = ((gauchedroite+2)/1)*0.00;
      		if (this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 50cm')  oeillets = ((gauchedroite+2)/0.5)*0.15;
      		if (this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 25cm')  oeillets = ((gauchedroite+2)/0.25)*0.15;
      		if (this.oeillets == 'oeillets gauche/droite' && this.choixSpce == 'tous les 10cm')  oeillets = ((gauchedroite+2)/0.1)*0.15;

      		if (this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 100cm') oeillets = ((metrazzaokraglony1+2)/1)*0.00;
      		if (this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 50cm')  oeillets = ((metrazzaokraglony1+2)/0.5)*0.15;
      		if (this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 25cm')  oeillets = ((metrazzaokraglony1+2)/0.25)*0.15;
      		if (this.oeillets == 'oeillets tout le tour' && this.choixSpce == 'tous les 10cm')  oeillets = ((metrazzaokraglony1+2)/0.1)*0.15;

          cena += oeillets;
          console.log('oeillets:' +oeillets);

      		//---------------------------------------------------------------ourlets

          var ourlets = 0;

      		if (this.ourlets == 'ourlet de renfort haut/bas')      ourlets = hautbas*2.00;
      		if (this.ourlets == 'ourlet de renfort gauche/droite') ourlets = gauchedroite*2.00;
      		if (this.ourlets == 'ourlet de renfort perimetrique')  ourlets = metrazzaokraglony1*2.00;

          cena += ourlets;
          console.log('ourlets:' +ourlets);

      		//-------------------------------------------------------------fourreaux

          var fourreaux = 0;

      		if (this.fourreaux == 'fourreaux haut/bas')      fourreaux = hautbas*3;
      		if (this.fourreaux == 'fourreaux gauche/droite') fourreaux = gauchedroite*3;

          cena += fourreaux;
          console.log('fourreaux:' +fourreaux);

      		//--------------------------------------------------------------scratchs

          var scratch = 0;

      		if (this.scratch == 'scratch haut/bas')      scratch = hautbas*6;
      		if (this.scratch == 'scratch gauche/droite') scratch = gauchedroite*6;
      		if (this.scratch == 'scratch perimetrique')  scratch = metrazzaokraglony1*6;

          cena += scratch;
          console.log('scratch:' +scratch);

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
        }

    		// ajout 30% si this.hauteur et this.largeur supérieurs à 2.5m //
    		if ( this.largeur > 2.5 && this.hauteur > 2.5 ) {
    			cena *= 1.3;
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
          cena += 5/this.qte;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 2;}
          this.optliv = ' / colis revendeur';
        }

        if (this.roll == true) {
    			cena += 20/this.qte;
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

        //                                       ERREURS TYPE 2 : AVERTISSEMENTS

        //-------------------------------------- recommandation livraison roulée
        if ( (this.hauteur > 1.99 && this.hauteur < 3.21 && this.largeur > 1.99) || (this.largeur > 1.99 && this.largeur < 3.21 && this.hauteur > 1.99) ) {
          if (this.roll == false) {
            this.warngMessage += '- livraison roulée recommandée (pas de pli visible)<br />';
            this.erreurType = 2;
            this.showRoll = true;
          }else{
            this.erreurType = 0;
            this.showRoll = true;
          }
        }else{
          this.showRoll = false;
        }
        //------------------------------------------------ reommandation ourlets
        if ( this.ourlets == 'sans ourlet' && (this.largeur*this.hauteur) > 2.4 ) {
          this.warngMessage += '- ourlet de renfort recommandé dès 2,5m² Ext ou 4m² Int !<br />';
          this.erreurType = 2;
        }
  			//-------------------------------------avertissement tourillons /piquets
  			if ( this.fixation == '2 tourillons bois et sandows' && this.hauteur > 1 ) {
  				this.warngMessage += '- les tourillons font 1m DE HAUT, êtes-vous sûr ?<br />';
          this.erreurType = 2;
  			} else if ( this.fixation == '2 piquets de bois' && this.hauteur > 1.1 ) {
  				this.warngMessage += '- les piquets font 1,35m de haut, êtes-vous sûr ?<br />';
          this.erreurType = 2;
  			}
        //---------------------------------------------------------thermosoudure
        if ( this.largeur > 2.5 && this.hauteur > 2.5 ){
          this.warngMessage += '- Votre banderole comportera une thermosoudure invisible à + de 2m<br />';
          this.erreurType = 2;
        }
        //------------------------------------------------------------- + de 50m
        if ( this.largeur >= 50 || this.hauteur >= 50 ) {
          this.warngMessage += '- la taille doit être entrée en mètres, êtes-vous sûr de vos dimensions ?<br />';
          this.erreurType = 2; this.reqHaut = this.reqLarg = 'required';
        }
        //------------------------------------------------------------ fourreaux
        if ( this.fourreaux != 'fourreaux gauche/droite' && this.fixation == '2 tourillons bois et sandows' ) {
  				this.warngMessage += '- tourillons sans finition fourreau G/D. êtes-vous sûr ?<br />';
          this.erreurType = 2;
  			}
  			if ( this.fourreaux != 'fourreaux gauche/droite' && this.fixation == '2 piquets de bois' ) {
  				this.warngMessage += '- piquets sans finition fourreau G/D. êtes-vous sûr ?<br />';
          this.erreurType = 2;
  			}
  			//-----------------------------------------------------tendeurs oeillets
  			if ( this.fixation == 'tendeurs' && this.oeillets == 'sans oeillets' ) {
  				this.warngMessage += '- tendeurs sans oeillets, êtes-vous sûr ?<br />';
          this.erreurType = 2;
  			}
  			//-------------------------------------------------------rislan oeillets
  			if ( this.fixation == 'rislans' && this.oeillets == 'sans oeillets' ) {
  				this.warngMessage += '- rislans sans oeillets, êtes-vous sûr ?<br />';
          this.erreurType = 2;
  			}
  			//------------------------------------------------------drisse fourreaux
  			if ( (this.fixation == 'drisse fourreaux H/B' ) && (this.fourreaux != 'fourreaux haut/bas') ) {
  				this.warngMessage += '- drisse H/B sans finition fourreaux H/B, êtes-vous sûr ?<br />';
  				this.erreurType = 2;
  			}
  			//-------------------------------------------------------drisse oeillets
  			if ( (this.fixation == 'drisse perimetrique' ) && (this.oeillets != 'oeillets tout le tour') ) {
  				this.warngMessage += '- drisse perimetrique sans oeillets tout le tour, êtes-vous sûr ?<br />';
  				this.erreurType = 2;
  			}

        //                         ERREURS TYPE 1 : MAXIMUMS MINIMUMS DIMENSIONS

        //---------------------------------------------------bache nontisse 150g
  			if ( this.support == 'bache nontisse 150g' && this.largeur > 0.8 && this.hauteur > 0.8 ) {
  				this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 0.8m!';
  				this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
  			}
        else if ( this.support == 'bache nontisse 150g' && (this.largeur < 0.15 || this.hauteur < 0.15) ) {
  				this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être supérieur à 0.15m!';
  				this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
  			}
        //-------------------------------------------------------------capotoile
  			else if ( this.support == 'capotoile' && this.largeur > 1.35 && this.hauteur > 1.35 ) {
  				this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 1.35m!';
  				this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
  			}
        //--------------------------------------------------------------ecotoile
  			else if ( this.support == 'ecotoile' && this.largeur > 1.6 && this.hauteur > 1.6 ) {
  				this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 1.6m!';
  				this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
  			}
  			//-------------------------------------------------------100% écologique
  			else if ( this.support == 'bache 100% écologique M1' && this.largeur > 1.6 && this.hauteur > 1.6 ) {
  				this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 1.6m!';
  				this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
  			}
        //-------------------------------------------------------jet 550 enduite
        else if ( this.support == 'jet 550 enduite' && (this.largeur*this.hauteur)*this.qte < 29.99) {
  				this.errorMessage = '<i class="fa fa-warning"></i> bache 550g minimum 30m²';
  				this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
  			}
        //-----------------------------------------------  MAXIMUM autres bâches
        else if ( this.largeur > 5 && this.hauteur > 5 ) {
    			this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 5m!';
    			this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
        }

        //---------------------------- vérifier que les champs sont bien remplis

        if (this.qte < 1)        {
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

          this.inputHauteur = (this.hauteur*100).toFixed(0);
          this.inputLargeur = (this.largeur*100).toFixed(0);

          if (this.support == 'bache nontisse 150g') { // affichage des options nontissé dans détails
            this.details = this.finition+' '+this.choixFpce+' <br>- '+this.ffixation;

          }else{ // si autre bache, affichage des finitions :

            this.details = this.oeillets+' '+this.choixSpce+' <br>- '+this.ourlets+'  <br>- '+this.fourreaux+' '+this.scratch+' <br>- '+this.fixation+' '+this.choixFxqt;
          }

          this.inputDesc = '- '+this.support+'<br>- H|'+this.inputHauteur+'cm x L|'+this.inputLargeur+'cm <br>- '+this.details+' <br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+this.roule+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd   = 'Banderole';
          this.inputQte    = this.qte;
          this.inputPrix   = this.cena2;
          this.inputOption = '-';
          this.inputRemise = this.rabat2;
          this.inputTotal  = this.suma2;
          this.inputTransport = this.transport;

        }
    }, // fin fonction calucler
  }, // fin méthodes VUE
}); // fin instance VUE
