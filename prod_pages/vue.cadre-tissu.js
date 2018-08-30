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
      choixProd : 'choisir votre cadre tissu',
      choixHaut : '',
      choixLarg : '',
      choixMaqt : '',
      choixSign : '',
      choixTopt : 'gris',
      qte: 1,
      adresse: true,
      atelier: false,
      relais: false,
      colis: false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes
      reqProd: 'required',
      reqLarg: '',
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
      toggleHaut: true,
      toggleLarg: true,
      toggleMaqt: true,
      toggleSign: true,
      toggleTopt: true,

      showLarg: false,
      showHaut: false,
      showMaqt: false,
      showSign: false,
      showCouleur: false,
      showOptions: false,
      showLiv: false,
      showEsize: false,
      errorSize: false,
      optionSize: true ,


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
        this.hauteur = this.largeur = ''; // on réinitialise les valeurs liées support & size au changement de produit
        this.showHaut = this.showLarg = this.showCouleur = this.showMaqt = this.showSign = this.showOptions = false;
        this.optionSize = true;

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/fond.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        // ------------------------------------------------------ CADRE STANDARD
        if (this.produit == 'Cadre tissu standard') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/cadre-standard.png)'};
          this.choixSize = 'choisir les dimensions';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

        // ------------------------------------------------------ CADRE LUMINEUX
        }else if(this.produit == 'Cadre tissu lumineux') {
          this.optionSize = false;

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/cadre-lumineux.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showHaut = true;
          this.reqHaut = 'required';
          this.toggleHaut = true;
          this.choixHaut = 'choisir la hauteur';

        // ----------------------------------------------------- STRUCTURE SEULE
        }else if (this.produit == 'Cadre (structure seule)') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/cadre.png)'};
          this.choixSize = 'choisir les dimensions';

          this.reqHaut = this.reqLarg = 'required';
          this.maquette = 'maquette client sans bat';
          this.modmaq = 'je ne souhaite pas de BAT';
          this.sign = 'signature France Banderole';
          this.reqQtte = 'required';
          this.showOptions = true;

        // -------------------------------------------------------------- VISUEL
        }else if (this.produit == 'visuel (tissu imprimé)') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/tissu.png)'};
          this.choixSize = 'choisir les dimensions';

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';

        }

    }, // fin fonction choix produit

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectHaut: function(value) {
        this.hauteur = value;   // on attribue la valeur renvoyée par la fonction à la variable dimension
        this.choixHaut = value;    // on attribue la valeur au champ de titre dimensions
        this.toggleHaut = false;   // on replie le menu à la sélection
        this.reqHaut = '';         // on rétablit les styles du champ à "non requis"

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showLarg = true;
        this.reqLarg = 'required';
        this.toggleLarg = true;
        this.choixLarg = 'choisir la largeur';

    }, // fin fonction choix dimensions


    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectLarg: function(value) {
        this.largeur = value;     // on attribue la valeur à la variable support
        this.choixLarg = value;   // on attribue la valeur au champ de titre support
        this.toggleLarg = false;  // on replie le menu à la sélection
        this.reqLarg = '';        // on rétablit les styles du champ à "non requis"

        this.pr2 = true;
        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/gris/'+this.hauteur+'x'+this.largeur+'.png)'};
        //this.bg2 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/man.png)'};

        this.optClip = true;
        this.showCouleur = true;
        this.reqTopt = 'required';
        this.toggleTopt = true;
        this.choixTopt = 'choisir la couleur du cadre';
    },

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectOpt: function(value) {
        this.choixTopt = value;
        this.toggleTopt = false;
        this.reqTopt = '';

        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/'+this.choixTopt+'/'+this.hauteur+'x'+this.largeur+'.png)'};

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

        if (this.produit !== 'Cadre tissu lumineux') this.reqHaut = this.reqLarg = 'required';
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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/fond.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/fond.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/cadre-tissu/'+src+'.png)'};
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
        var perteH             = 0; 	var perteL   = 0;
        var h1                 = 0; 	var h2       = 0;
        var l1                 = 0; 	var l2       = 0;
        var metragefinal       = 0;		var details  = '';
        var cenatotal          = '';  var opis     = '';
        var metraz             = 0;
        var metrazzaokraglony  = 0;
        var metrazzaokraglony1 = 0;
        var prixsupport        = 0;
        var poids              = '';  // poids total
        var p1                 = '';  // poids du support
        var p2                 = '';  // poids du structure
        var metrage            = 0;
        var structure          = 0;
        var fp                 = '';
        var tissu              = 0;   var jonc              = 0;
        var pmL                = 0;   // /prix au metre linéaire
        var pu                 = 0;
        var cena               = 0; 	var cena2      = 0; 		var prixunite  = 0;
        var rabat              = 0;	 	var rabat2     = 0;
        var suma               = 0; 	var suma2      = 0;
        var transport          = 0;
        var designation        = '';
        var optliv             = '';
        var prliv              = '';
        var date_panier        = '';
        var option             = '';

        //----------------------------------------------------------------------
        metraz                 = (this.largeur/100) * (this.hauteur/100);      // métrage
        metraz                 = fixstr(metraz);
        metrazzaokraglony1     = (this.largeur/100 + this.hauteur/100)*2;    // périmètre
        metrazzaokraglony      = Math.round(metrazzaokraglony1);

        //----------------------------------------------------------------------

        if (this.produit == 'Cadre tissu standard') {
          if (metraz <= 0.5) {pmL=14;}
          if (metraz > 0.5) {pmL=9;}
          tissu = metraz*23;
          jonc = metrazzaokraglony1*1.18*2; // 1.18 prix au m²
          structure = metrazzaokraglony1*pmL*2;
          // prix Cadre tissu standard
          cena = structure+tissu+jonc;
          poids = metrazzaokraglony1*0.320;
        }

        if (this.produit == 'Cadre (structure seule)') {
          if (metraz <= 0.5) {pmL=14;}
          if (metraz > 0.5) {pmL=9;}
          tissu = metraz*23;
          jonc = metrazzaokraglony1*1.18*2.25; // 1.18 prix au m²
          structure = metrazzaokraglony1*pmL*2.25;
          // prix Cadre tissu standard
          cena = structure;
        }

        if (this.produit == 'visuel (tissu imprimé)') {
          if (metraz <= 0.5) {pmL=14;}
          if (metraz > 0.5) {pmL=9;}
          tissu = metraz*23;
          jonc = metrazzaokraglony1*1.18*3; // 1.18 prix au m²
          structure = metrazzaokraglony1*pmL*3;
          // prix Cadre tissu standard
          cena = tissu+jonc;
        }

        if (this.produit == 'Cadre tissu lumineux') {

          //---------------------------------------------------------- structure
          if ((this.hauteur == '50') && (this.largeur == '80'))   {structure=220;}
          if ((this.hauteur == '50') && (this.largeur == '100'))  {structure=226;}
          if ((this.hauteur == '50') && (this.largeur == '150'))  {structure=325;}
          if ((this.hauteur == '50') && (this.largeur == '200'))  {structure=382;}
          if ((this.hauteur == '50') && (this.largeur == '300'))  {structure=NUL;}

          if ((this.hauteur == '100') && (this.largeur == '80'))  {structure=241;}
          if ((this.hauteur == '100') && (this.largeur == '100')) {structure=250;}
          if ((this.hauteur == '100') && (this.largeur == '150')) {structure=349;}
          if ((this.hauteur == '100') && (this.largeur == '200')) {structure=407;}
          if ((this.hauteur == '100') && (this.largeur == '300')) {structure=571;}

          if ((this.hauteur == '180') && (this.largeur == '80'))  {structure=272;}
          if ((this.hauteur == '180') && (this.largeur == '100')) {structure=282;}
          if ((this.hauteur == '180') && (this.largeur == '150')) {structure=369;}
          if ((this.hauteur == '180') && (this.largeur == '200')) {structure=425;}
          if ((this.hauteur == '180') && (this.largeur == '300')) {structure=590;}

          if ((this.hauteur == '200') && (this.largeur == '80'))  {structure=292;}
          if ((this.hauteur == '200') && (this.largeur == '100')) {structure=306;}
          if ((this.hauteur == '200') && (this.largeur == '150')) {structure=403;}
          if ((this.hauteur == '200') && (this.largeur == '200')) {structure=458;}
          if ((this.hauteur == '200') && (this.largeur == '300')) {structure=624;}

          if ((this.hauteur == '250') && (this.largeur == '80'))  {structure=311;}
          if ((this.hauteur == '250') && (this.largeur == '100')) {structure=327;}
          if ((this.hauteur == '250') && (this.largeur == '150')) {structure=424;}
          if ((this.hauteur == '250') && (this.largeur == '200')) {structure=479;}
          if ((this.hauteur == '250') && (this.largeur == '300')) {structure=643;}

          //------------------------------------ visuel backlite + DOS OCCULTANT
          if ((this.hauteur == '50')  && (this.largeur == '80'))  {tissu=50+30;}
          if ((this.hauteur == '50')  && (this.largeur == '100')) {tissu=50+30;}
          if ((this.hauteur == '50')  && (this.largeur == '150')) {tissu=50+30;}
          if ((this.hauteur == '50')  && (this.largeur == '200')) {tissu=50+30;}
          if ((this.hauteur == '50')  && (this.largeur == '300')) {tissu=NUL;}

          if ((this.hauteur == '100') && (this.largeur == '80'))  {tissu=50+30;}
          if ((this.hauteur == '100') && (this.largeur == '100')) {tissu=50+30;}
          if ((this.hauteur == '100') && (this.largeur == '150')) {tissu=70+45;}
          if ((this.hauteur == '100') && (this.largeur == '200')) {tissu=90+60;}
          if ((this.hauteur == '100') && (this.largeur == '300')) {tissu=130+90;}

          if ((this.hauteur == '180') && (this.largeur == '80'))  {tissu=68+43;}
          if ((this.hauteur == '180') && (this.largeur == '100')) {tissu=82+54;}
          if ((this.hauteur == '180') && (this.largeur == '150')) {tissu=118+81;}
          if ((this.hauteur == '180') && (this.largeur == '200')) {tissu=154+108;}
          if ((this.hauteur == '180') && (this.largeur == '300')) {tissu=226+162;}

          if ((this.hauteur == '200') && (this.largeur == '80'))  {tissu=74+48;}
          if ((this.hauteur == '200') && (this.largeur == '100')) {tissu=90+60;}
          if ((this.hauteur == '200') && (this.largeur == '150')) {tissu=130+90;}
          if ((this.hauteur == '200') && (this.largeur == '200')) {tissu=170+120;}
          if ((this.hauteur == '200') && (this.largeur == '300')) {tissu=250+180;}

          if ((this.hauteur == '250') && (this.largeur == '80'))  {tissu=90+60;}
          if ((this.hauteur == '250') && (this.largeur == '100')) {tissu=110+75;}
          if ((this.hauteur == '250') && (this.largeur == '150')) {tissu=160+112;}
          if ((this.hauteur == '250') && (this.largeur == '200')) {tissu=210+150;}
          if ((this.hauteur == '250') && (this.largeur == '300')) {tissu=310+225;}

          //------------------------------------------ prix Cadre tissu lumineux
          cena= (tissu+structure)*1.70;
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
        cena = prixunite*this.qte;
        prixunite=fixstr(prixunite);
        this.transport=0;
        this.cena2 = prixunite.replace(".", ",");

        // ------------------------------------------------------------- ERREURS

        this.erreurType = 0;
        //---------------------------- vérifier que les champs sont bien remplis
        if (this.choixHaut == "choisir la hauteur") {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir la hauteur';
          this.erreurType=1;

        } else if (this.choixLarg == "choisir la largeur") {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez choisir la largeur';
          this.erreurType=1;

        } else if (this.hauteur < 1 || this.hauteur == '' || isNaN(this.hauteur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur en cm';
          this.erreurType=1; this.reqHaut = 'required';

        } else if (this.largeur < 1 ||this.largeur == '' || isNaN(this.largeur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une largeur en cm';
          this.erreurType=1; this.reqLarg = 'required';

        } else if (this.hauteur < 20 || this.largeur < 20) {
          this.errorMessage='<i class="fa fa-warning"></i> votre cadre doit faire au minimum 20x30 cm';
          this.erreurType=1; this.reqLarg = 'required';

        } else if (this.hauteur < 30 && this.largeur < 30) {
          this.errorMessage='<i class="fa fa-warning"></i> votre cadre doit faire au minimum 20x30 cm';
          this.erreurType=1; this.reqLarg = 'required';

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

          this.inputHauteur = this.hauteur;
          this.inputLargeur = this.largeur;

          if (this.produit == 'Cadre (structure seule)') {
            this.inputDesc = '- '+this.produit+' <br />- H|'+this.inputHauteur+' x L|'+this.inputLargeur+' <br>- '+this.retrait+this.optliv+' <br>- P '+dprod+'J / L '+dliv+'J';
          } else {
            this.inputDesc = '- '+this.produit+' <br />- H|'+this.inputHauteur+' x L|'+this.inputLargeur+' <br>- '+this.modmaq+' <br>- '+this.sign+' <br>- '+this.retrait+this.optliv+' <br>- P '+dprod+'J / L '+dliv+'J';
          }

          this.inputProd      = 'Cadre tissu';
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
