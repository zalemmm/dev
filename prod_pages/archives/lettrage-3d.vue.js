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
      rowHeight: {height: '975px'},

      choix : true, // passer à true pour debug : affiche les modifications à la sélection des options

      // valeurs par défaut (value) : champs select tous produits
      produit: '',
      dimensions: '',
      support: '',
      finition: '',
      epaisseur: '',
      couleurLeds: '',
      couleur: '',
      texte: 'MA BOUTIQUE',
      maquette: '',
      sign: '',
      tx3d: '',

      // valeurs par défaut (value) : champs spéciaux au produit

      // valeurs par défaut (value) : champs titres sélect
      choixProd : 'choisir le type',
      choixSupp : '',
      choixFini : '',
      choixEpai : '',
      choixHaut : '',
      choixCled : '',
      choixText : '',
      choixCoul : '',
      choixTypo : '',

      qte: 1,
      adresse: true,
      atelier: false,
      relais:  false,
      colis:   false,
      roll:    false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes et autres attributs
      reqProd: 'required',
      reqSize: '',
      reqSupp: '',
      reqFini: '',
      reqHaut: '',
      reqCled: '',
      reqEpai: '',
      reqText: '',
      reqCoul: '',
      reqQtte: '',
      reqLarg: '',
      reqEstm: '',
      reqTypo: '',

      btnP1: 'inactive',
      btnP2: 'inactive',
      btnP3: 'inactive',
      btnD1: 'inactive',
      btnD2: 'inactive',
      btnD3: 'inactive',

      // valeurs par défaut de visibilité des blocs d'options :
      toggleProd: true,
      toggleCled: true,
      toggleFini: true,
      toggleSupp: true,
      toggleHaut: true,
      toggleEpai: true,
      toggleText: true,
      toggleCoul: true,
      toggleTypo: true,

      showSupp: false,
      showCled: false,
      showHaut: false,
      showFini: false,
      showEpai: false,
      showText: false,
      showCoul: false,
      showOptions: false,
      showLiv: false,
      showTypo: false,
      showTyping: false,

      dateLivraison: false,
      livraisonrapide: false,
      livraisonComp: false,
      formError: false,
      formWarng: false,
      ajoutPanier: false,

      // valeurs par défaut de visibilité des options individuelles :
      lumi: false,
      stand: true,
      pvc: false,
      plx: false,
      dib: false,

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

      // svg :
      layerCont:  '',
      layerText:  '',
      posx     :  '10',

      fsize:  '64px',
      filter: 'url(#slim)',
      fill:   '#fff',
      extru:  '#ccc',
      stroke: '#fff',
      typo:   'Patua One',
      opacity: '1',

      glow: 'url(#glow)',
      lightcolor: '#fff',
      coltransp:  'rgba(255,255,255,.3)',
      nbSignes: 0,

  }, // fin DATA

  //---------------------------------------------------------------------------------------------//
  //              2-  MOUNTED (fonctions à passer avant modifications de la vue)                 //
  //---------------------------------------------------------------------------------------------//

  mounted: function () {
      // si client revendeur : afficher les options supplémentaires
      if ( document.getElementById('rev') || document.getElementById('revendeur') || document.getElementById('revendeurRC') || document.getElementById('revendeurRS')) this.swRvd = true;
      else this.swRvd = false;

  },

  //---------------------------------------------------------------------------------------------//
  //                      3 - METHODS (fonctions pour modifier la VUE)                           //
  //---------------------------------------------------------------------------------------------//

  methods: {

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectProd: function(value) {
        this.prH = false; // cacher preview
        this.produit = value;     // on attribue la valeur à la variable support
        this.choixProd = value;   // on attribue la valeur au champ de titre support
        this.toggleProd = false;  // on replie le menu à la sélection
        this.reqProd = '';        // on rétablit les styles du champ à "non requis"

        // on réinitialise les champs suivants si c'est un retour sur option :
        this.showOeuil = this.showOrlt = this.showFour = this.showScra =  this.showHaut = false;// refermer le déroulé
        this.toggleFxqt = this.toggleSpce = this.toggleFpce = false; // refermer les sous-menus

        this.bg1 = {background: '#000'};

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = this.pr2 = true;  // calques bg et produit activés
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés

        this.fill       = '#fff';
        this.extru      = '#ccc';
        this.stroke     = '#fff';
        this.lightcolor = '#fff';
        this.filter     = 'url(#slim)';

        if (this.produit == 'Lettrage 3d lumineux') {
          this.lumi = true;  this.stand = false;
          this.filter = 'url(#medium)';

        } else {
          this.lumi = false; this.stand = true;
          this.filter = 'url(#slim)';
        }

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showSupp = true;
        this.reqSupp = 'required';
        this.toggleSupp = true;
        this.choixSupp = 'choisir le support';
    },


    hoverProd: function(value)  {
        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = this.pr2 = true;  // calques bg et produit activés
        this.prH = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés

        this.fill       = '#fff';
        this.extru      = '#ccc';
        this.stroke     = '#fff';
        this.lightcolor = '#fff';
        this.filter     = 'url(#slim)';

        if (value == 'Lettrage 3d lumineux') {
          this.lumi = true;  this.stand = false;
          this.filter = 'url(#medium)';
        } else {
          this.lumi = false; this.stand = true;
          this.filter = 'url(#slim)';
        }
    },

    outProd: function(value)  {
        this.fill       = '#fff';
        this.extru      = '#ccc';
        this.stroke     = '#fff';
        this.lightcolor = '#fff';

        if (this.produit == 'Lettrage 3d lumineux') {
          this.lumi = true;  this.stand = false;
          this.filter = 'url(#medium)';
        } else {
          this.lumi = false; this.stand = true;
          this.filter = 'url(#slim)';
        }
    },

    // fonction affichage champs formulaire:             au choix produit validé
    //==========================================================================
    selectSupport: function(value) {
        this.support = value;     // on attribue la valeur à la variable support
        this.choixSupp = value;
        this.toggleSupp = false;
        this.reqSupp = '';

        if (this.support == 'plexiglas') {
          this.plx    = true; this.dib = false; this.pvc = false;
          this.fill   = 'rgba(255,255,255,0.05)';
          this.extru  = 'rgba(255,255,255,0.5)';
          this.stroke = 'rgba(255,255,255,0.9)';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showEpai   = true;
          this.reqEpai    = 'required';
          this.toggleEpai = true;
          this.choixEpai  = 'épaisseur des lettres';

        } else if (this.support == 'pvc') {
          this.pvc    = true; this.dib = false; this.plx = false;
          this.fill   = '#fff';
          this.extru  = '#ccc';
          this.stroke = '#fff';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showEpai   = true;
          this.reqEpai    = 'required';
          this.toggleEpai = true;
          this.choixEpai  = 'épaisseur des lettres';

        } else if (this.support == 'dibond') {
          this.dib    = true; this.pvc = false; this.plx = false;
          this.fill   = 'url(#ptsteel)';
          this.extru  = '#333';
          this.stroke = '#333';
          this.filter = 'url(#xslim)';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showFini   = true;
          this.reqFini    = 'required';
          this.toggleFini = true;
          this.choixFini  = 'finition dibond';
        }
    },

    hoverSupport: function(value)  {
        if (value == 'plexiglas') {
          this.fill   = 'rgba(255,255,255,0.05)';
          this.extru  = 'rgba(255,255,255,0.5)';
          this.stroke = 'rgba(255,255,255,0.9)';
          this.filter = 'url(#slim)';
          this.dib    = false;

        } else if (value == 'pvc') {
          this.fill   = '#fff';
          this.extru  = '#ccc';
          this.stroke = '#fff';
          if(this.lumi == false) this.filter = 'url(#slim)';
          else                   this.filter = 'url(#medium)';
          this.dib   = false;

        } else if (value == 'dibond') {
          this.fill   = 'url(#ptsteel)';
          this.extru  = '#333';
          this.stroke = '#333';
          this.filter = 'url(#xslim)';
          this.dib    = true;
        }
    },

    outSupport: function() {
        if (this.support == 'plexiglas') {
          this.fill       = 'rgba(255,255,255,0.05)';
          this.extru      = 'rgba(255,255,255,0.5)';
          this.stroke     = 'rgba(255,255,255,0.9)';
          this.filter     = 'url(#slim)';
          this.dib        = false;

        } else if (this.support == 'pvc') {
          this.fill       = '#fff';
          this.extru      = '#ccc';
          this.stroke     = '#fff';
          if(this.lumi == false) this.filter = 'url(#slim)';
          else                   this.filter = 'url(#medium)';
          this.dib        = false;

        } else if (this.support == 'dibond') {
          this.fill       = 'url(#ptsteel)';
          this.extru      = '#333';
          this.stroke     = '#333';
          this.filter     = 'url(#xslim)';
          this.dib        = true;

        } else {
          this.fill       = '#fff';
          this.extru      = '#ccc';
          this.stroke     = '#fff';
          this.lightcolor = '#fff';
          if(this.lumi == false) this.filter = 'url(#slim)';
          else                   this.filter = 'url(#medium)';
          this.dib        = false;
        }
    },

    // fonction affichage champs formulaire:                     finition dibond
    //==========================================================================
    selectFinition: function(value) {
        this.finition   = value;
        this.choixFini  = value;
        this.toggleFini = false;
        this.reqFini    = '';

        if (this.finition == 'brossé') {
          this.fill   = 'url(#ptsteel)';
          this.extru  = '#333';
          this.stroke = '#333';
          this.filter = 'url(#xslim)';
        } else {
          this.fill   = "url(#mirror)";
          this.extru  = '#333';
          this.stroke = '#333';
          this.filter = 'url(#xslim)';
        }

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showEpai   = true;
        this.reqEpai    = 'required';
        this.toggleEpai = true;
        this.choixEpai  = 'épaisseur des lettres';
    },

    hoverFinition: function(value) {
      if (value == 'brossé') {
        this.fill   = 'url(#ptsteel)';
        this.extru  = '#333';
        this.stroke = '#333';
        this.filter = 'url(#xslim)';
      } else {
        this.fill   = "url(#mirror)";
        this.extru  = '#333';
        this.stroke = '#333';
        this.filter = 'url(#xslim)';
      }
    },

    outFinition: function(value) {
      if (this.finition == 'brossé') {
        this.fill   = 'url(#ptsteel)';
        this.extru  = '#333';
        this.stroke = '#333';
        this.filter = 'url(#xslim)';
      } else {
        this.fill   = "url(#mirror)";
        this.extru  = '#333';
        this.stroke = '#333';
        this.filter = 'url(#xslim)';
      }
    },

    // fonction affichage champs formulaire:             au choix support validé
    //==========================================================================
    selectEpaisseur: function(value) {
        this.epaisseur = value;
        this.choixEpai = value;
        this.toggleEpai = false;
        this.reqEpai = '';

        if (this.epaisseur == '3') {
          this.filter = 'url(#xslim)';
        } else if (this.epaisseur == '10') {
          this.filter = 'url(#slim)';
        } else if (this.epaisseur == '19' || this.epaisseur == '20') {
          this.filter = 'url(#medium)';
        } else if (this.epaisseur == '30') {
          this.filter = 'url(#large)';
        }

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showHaut = true;
        this.reqHaut = 'required';
        this.toggleHaut = true;
        this.choixHaut = 'hauteur des lettres';
    },

    hoverEpai: function(value) {
        if (value == '3') {
          this.filter = 'url(#xslim)';
        } else if (value == '10') {
          this.filter = 'url(#slim)';
        } else if (value == '19' || value == '20') {
          this.filter = 'url(#medium)';
        } else if (value == '30') {
          this.filter = 'url(#large)';
        }
    },

    outEpai: function() {
        if (this.epaisseur == '3') {
          this.filter = 'url(#xslim)';
        } else if (this.epaisseur == '10') {
          this.filter = 'url(#slim)';
        } else if (this.epaisseur == '19' || this.epaisseur == '20') {
          this.filter = 'url(#medium)';
        } else if (this.epaisseur == '30') {
          this.filter = 'url(#large)';
        } else {
          this.filter = 'url(#slim)';
        }
    },

    // fonction affichage champs formulaire:           au choix épaisseur validé
    //==========================================================================
    selectHaut: function(value) {
        this.hauteur = value;
        this.choixHaut = value;
        this.toggleHaut = false;
        this.reqHaut = '';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showText = true;
        this.reqText = 'required';
        this.toggleText = true;
        this.choixText = 'entrer le texte';
    },

    // fonction affichage champs formulaire :            au choix hauteur validé
    //==========================================================================
    selectText: function(value) {
        this.toggleText = false;
        this.reqText = '';

        this.showTypo = true;
        this.reqTypo = 'required';
        this.toggleTypo = true;
        this.choixTypo = 'choisir la typo';
    },

    // fonction affichage champs formulaire :            au choix hauteur validé
    //==========================================================================
    selectTypo: function(value) {
        this.typo = value;
        this.choixTypo = value;
        this.toggleTypo = false;
        this.reqTypo = '';

        this.showEsize = false;

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showCoul = true;
        this.reqCoul = 'required';
        this.toggleCoul = true;
        this.choixCoul = 'couleur des lettres';
    },

    hoverTypo: function(value) {
      this.typo = value;
    },

    outTypo: function() {
      if (this.choixTypo == 'choisir la typo') this.typo = 'Patua One';
      else this.typo = this.choixTypo;
    },

    // fonction affichage champs formulaire :              au choix texte validé
    //==========================================================================
    selectCoul: function(value) {
        this.couleur = value;
        this.choixCoul = value;
        this.toggleCoul = false;
        this.reqCoul = '';

        if (this.plx == false && this.dib == false){
          if (this.couleur == 'bleu') {
            this.fill   = '#504dd8';
            this.extru  = '#382eb8';
            this.stroke = '#504dd8';
          } else if (this.couleur == 'rouge') {
            this.fill   = '#d84d4d';
            this.extru  = '#c32929';
            this.stroke = '#d84d4d';
          } else if (this.couleur == 'vert') {
            this.fill   = '#37ba53';
            this.extru  = '#2a9441';
            this.stroke = '#37ba53';
          } else if (this.couleur == 'blanc') {
            this.fill   = '#fff';
            this.extru  = '#ccc';
            this.stroke = '#fff';
          }
        }

        if (this.plx == true) {
          if (this.couleur == 'bleu') {
            this.fill   = 'rgba(79,76,215,.3)';
            this.extru  = 'rgba(56,46,184,.5)';
            this.stroke = 'rgba(79,76,215,.5)';
          } else if (this.couleur == 'rouge') {
            this.fill   = 'rgba(215,76,76,.3)';
            this.extru  = 'rgba(195,41,41,.5)';
            this.stroke = 'rgba(215,76,76,.5)';
          } else if (this.couleur == 'vert') {
            this.fill   = 'rgba(55,186,83,.3)';
            this.extru  = 'rgba(42,148,65,.5)';
            this.stroke = 'rgba(55,186,83,.5)';
          } else if (this.couleur == 'blanc') {
            this.fill   = 'rgba(255,255,255,.3)';
            this.extru  = 'rgba(204,204,204,.5)';
            this.stroke = 'rgba(255,255,255,.5)';
          } else {
            this.fill   = 'rgba(255,255,255,0.05)';
            this.extru  = 'rgba(255,255,255,0.5)';
            this.stroke = 'rgba(255,255,255,0.4)';
          }
        }

        if (this.dib == true) {
          if (this.couleur == 'bleu') {
            this.coltransp   = 'rgba(79,76,215,.3)';
          } else if (this.couleur == 'rouge') {
            this.coltransp   = 'rgba(215,76,76,.3)';
          } else if (this.couleur == 'vert') {
            this.coltransp   = 'rgba(55,186,83,.3)';
          } else if (this.couleur == 'blanc') {
            this.coltransp   = 'rgba(255,255,255,.3)';
          }
        }

        if (this.produit == 'Lettrage 3d lumineux') {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showCled = true;
          this.reqCled = 'required';
          this.toggleCled = true;
          this.choixCled = 'couleur des leds';
        } else {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.reqQtte = 'required';
          this.reqHaut = this.reqLarg = 'required';
          this.showOptions = true;
        }
    },

    hoverCoul: function(value) {
        if (this.plx == false && this.dib == false){
          if (value== 'bleu') {
            this.fill   = '#504dd8';
            this.extru  = '#382eb8';
            this.stroke = '#504dd8';
          } else if (value== 'rouge') {
            this.fill   = '#d84d4d';
            this.extru  = '#c32929';
            this.stroke = '#d84d4d';
          } else if (value== 'vert') {
            this.fill   = '#37ba53';
            this.extru  = '#2a9441';
            this.stroke = '#37ba53';
          } else if (value== 'blanc') {
            this.fill   = '#fff';
            this.extru  = '#ccc';
            this.stroke = '#fff';
          }
        }

        if (this.plx == true) {
          if (value== 'bleu') {
            this.fill   = 'rgba(79,76,215,.3)';
            this.extru  = 'rgba(56,46,184,.5)';
            this.stroke = 'rgba(79,76,215,.5)';
          } else if (value== 'rouge') {
            this.fill   = 'rgba(215,76,76,.3)';
            this.extru  = 'rgba(195,41,41,.5)';
            this.stroke = 'rgba(215,76,76,.5)';
          } else if (value== 'vert') {
            this.fill   = 'rgba(55,186,83,.3)';
            this.extru  = 'rgba(42,148,65,.5)';
            this.stroke = 'rgba(55,186,83,.5)';
          } else if (value== 'blanc') {
            this.fill   = 'rgba(255,255,255,.3)';
            this.extru  = 'rgba(204,204,204,.5)';
            this.stroke = 'rgba(255,255,255,.5)';
          } else {
            this.fill   = 'rgba(255,255,255,0.05)';
            this.extru  = 'rgba(255,255,255,0.5)';
            this.stroke = 'rgba(255,255,255,0.4)';
          }
        }

        if (this.dib == true) {
          if (value== 'bleu') {
            this.coltransp   = 'rgba(79,76,215,.3)';
          } else if (value== 'rouge') {
            this.coltransp   = 'rgba(215,76,76,.3)';
          } else if (value== 'vert') {
            this.coltransp   = 'rgba(55,186,83,.3)';
          } else if (value== 'blanc') {
            this.coltransp   = 'rgba(255,255,255,.3)';
          }
        }
    },

    outCoul: function() {
        if (this.plx == false && this.dib == false){
          if (this.couleur == 'bleu') {
            this.fill   = '#504dd8';
            this.extru  = '#382eb8';
            this.stroke = '#504dd8';
          } else if (this.couleur == 'rouge') {
            this.fill   = '#d84d4d';
            this.extru  = '#c32929';
            this.stroke = '#d84d4d';
          } else if (this.couleur == 'vert') {
            this.fill   = '#37ba53';
            this.extru  = '#2a9441';
            this.stroke = '#37ba53';
          } else {
            this.fill   = '#fff';
            this.extru  = '#ccc';
            this.stroke = '#fff';
          }
        }

        if (this.plx == true) {
          if (this.couleur == 'bleu') {
            this.fill   = 'rgba(79,76,215,.4)';
            this.extru  = 'rgba(56,46,184,.5)';
            this.stroke = 'rgba(79,76,215,.9)';
          } else if (this.couleur == 'rouge') {
            this.fill   = 'rgba(215,76,76,.4)';
            this.extru  = 'rgba(195,41,41,.5)';
            this.stroke = 'rgba(215,76,76,.9)';
          } else if (this.couleur == 'vert') {
            this.fill   = 'rgba(55,186,83,.4)';
            this.extru  = 'rgba(42,148,65,.5)';
            this.stroke = 'rgba(55,186,83,.9)';
          } else if (this.couleur == 'blanc') {
            this.fill   = 'rgba(255,255,255,.4)';
            this.extru  = 'rgba(204,204,204,.5)';
            this.stroke = 'rgba(255,255,255,.9)';
          } else {
            this.fill   = 'rgba(255,255,255,0.05)';
            this.extru  = 'rgba(255,255,255,0.5)';
            this.stroke = 'rgba(255,255,255,0.9)';
          }
        }

        if (this.dib == true) {

          if (this.couleur == 'bleu') {
            this.coltransp   = 'rgba(79,76,215,.3)';
          } else if (this.couleur == 'rouge') {
            this.coltransp   = 'rgba(215,76,76,.3)';
          } else if (this.couleur == 'vert') {
            this.coltransp   = 'rgba(55,186,83,.3)';
          } else {
            this.coltransp   = 'rgba(255,255,255,.3)';
          }
        }
    },

    // fonction affichage champs formulaire :            au choix hauteur validé
    //==========================================================================
    selectCled: function(value) {
        this.couleurLeds = value;
        this.choixCled = value;
        this.toggleCled = false;
        this.reqCled = '';

        if (this.couleurLeds== 'bleu') {
          this.lightcolor =  '#504dd8';
        } else if (this.couleurLeds == 'rouge') {
          this.lightcolor =  '#d84d4d';
        } else if (this.couleurLeds == 'vert') {
          this.lightcolor =  '#37ba53';
        } else if (this.couleurLeds == 'blanc') {
          this.lightcolor =  '#fff';
        }

        this.reqQtte = 'required';
        this.reqHaut = this.reqLarg = 'required';
        this.showOptions = true;
    },

    hoverCled: function(value) {
        if (value== 'bleu') {
          this.lightcolor =  '#504dd8';
        } else if (value == 'rouge') {
          this.lightcolor =  '#d84d4d';
        } else if (value == 'vert') {
          this.lightcolor =  '#37ba53';
        } else if (value == 'blanc') {
          this.lightcolor =  '#fff';
        }
    },

    outCled: function() {
        if (this.couleurLeds== 'bleu') {
          this.lightcolor =  '#504dd8';
        } else if (this.couleurLeds == 'rouge') {
          this.lightcolor =  '#d84d4d';
        } else if (this.couleurLeds == 'vert') {
          this.lightcolor =  '#37ba53';
        } else if (this.couleurLeds == 'blanc') {
          this.lightcolor =  '#fff';
        } else {
          this.lightcolor =  '#fff';
        }
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
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

    // fonction input texte                                    check remplissage
    //==========================================================================
    checkSize: function(input, value) {
      this.showTyping = true;

      if (value == '') {
        this.reqText = 'required';
        this.nbSignes = 0;

      } else {
        this.reqText = '';
        this.showTypo = true;
        this.reqTypo = 'required';
        this.toggleTypo = true;
        this.choixTypo = 'choisir la typo';
        this.nbSignes = value.replace(/\s/g, "").length;

        if (this.nbSignes <= 11) {
          this.layerCont = {backgroundSize: '700px 700px', transition: '.5s'};
          this.layerText = {marginTop: '125px'};
          this.fsize     = '64px';
          this.posx      = '10';
        }
        if (this.nbSignes > 10) {
          this.layerCont = {backgroundSize: '500px 500px', transition: '.5s'};
          this.layerText = {marginTop: '75px'};
          this.fsize     = '48px';
          this.posx      = '10';
        }
        if (this.nbSignes > 14) {
          this.layerCont = {backgroundSize: 'contain', transition: '.5s'};
          this.layerText = {marginTop: '65px'};
          this.fsize     = '38px';
          this.posx      = '5';
        }
      }
    },

    // fonction input typo :                                          check typo
    //==========================================================================
    checkTypo: function(input, value) {
      if (value == '') {
        this.reqTypo   = 'required'; this.errorSize = 'entrez un nom de typo';
        this.showEsize = true;

      } else {
        this.reqTypo   = '';
        this.errorSize = 'pour la prévisualisation  il faut que la typo soit installée sur votre ordinateur (par ex: Georgia, Verdana, Courier New, Impact...)';
        this.showEsize = true;

        if (value.replace(/\s/g, "").length < 3) this.choixTypo = 'choisir la typo';
        else                                     this.choixTypo = value;

        this.showCoul = true;
        this.reqCoul = 'required';
        this.toggleCoul = true;
        this.choixCoul = 'couleur des lettres';
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
    		var prixproduit       = 0;  var prix 				= 0;
        //----------------------------------------------------------------------



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
        cena=prixunite*this.qte;
        prixunite=fixstr(prixunite);
        this.transport=0;
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        //                                       ERREURS TYPE 2 : AVERTISSEMENTS

        //                         ERREURS TYPE 1 : MAXIMUMS MINIMUMS DIMENSIONS

        /*if ( this.largeur > 250 && this.hauteur > 250 ) {
    			this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 250cm!';
    			this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
        }*/

        //---------------------------- vérifier que les champs sont bien remplis

        if (this.qte < 1)        {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';
          this.reqLarg = this.reqHaut = this.reqFixx = '';

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

          this.inputHauteur = 0;
          this.inputLargeur = 0;

          var color = '<br>- couleur lettrage: '+this.couleur;
          if (this.produit == 'Lettrage 3d lumineux')
            color = '<br>- couleur lettrage: '+this.couleur+'<br>- couleur leds: '+this.couleurLeds;

          this.nbSignes = this.texte.replace(/\s/g, "").length;

          this.inputDesc = '- '+this.support+'<br>- H|'+this.choixHaut+' <br>- texte: "'+this.texte+'" <br>-'+this.nbSignes+' signes <br>- typo: '+this.typo+''+color+'<br>- '+this.retrait+this.optliv+this.roule+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = this.choixProd;
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
