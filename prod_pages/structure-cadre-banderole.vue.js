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
      produit:    '',
      dimensions: '',
      structure:  '',
      projecteur: '',
      support:    '',
      option:     '',
      accroche:   '',
      maquette:   '',
      sign:       '',
      pied:       '',

      // valeurs par défaut (value) : autre champs
      choixProd: 'choisir votre cadre',
      choixStrc: '',
      choixSupp: '',
      choixAccr: '',
      choixProj: '',
      choixHaut: '',
      choixLarg: '',
      choixMaqt: '',
      choixSign: '',
      choixTopt: '',
      qte: 1,
      adresse: true,
      atelier: false,
      relais:  false,
      colis:   false,
      delaiprod: '',
      delailiv: '',

      // valeurs par défaut : classes
      reqProd: 'required',
      reqSupp: '',
      reqLarg: '',
      reqAccr: '',
      reqProj: '',
      reqMaqt: '',
      reqSign: '',
      reqQtte: '',
      reqEstm: '',
      reqStrc: '',
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
      toggleStrc: true,
      toggleSupp: true,
      toggleHaut: true,
      toggleLarg: true,
      toggleAccr: true,
      toggleProj: true,
      toggleMaqt: true,
      toggleSign: true,
      toggleTopt: true,

      showStrc: false,
      showSupp: false,
      showLarg: false,
      showAccr: false,
      showProj: false,
      showHaut: false,
      showMaqt: false,
      showSign: false,
      showOpt: false,
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

      mur: false,


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
	    inputHauteurB: '',
      inputLargeurB: '',
	    IPN: '',


      designation: '',
      details: '',
      modmaq: '',
	    Struct: '',
	    bacheType: '',
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
        this.showStrc = this.showSupp = this.showOpt = this.showMaqt = this.showSign = this.showOptions = false;
        this.optionSize = true;

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false; // slider désactivé
        this.pr0 = this.pr1 = true;  // calques bg et produit activés
        this.prH = this.pr2 = this.pr3 = this.pr4 = this.pr5 = false; // autres calques désactivés
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/fond.png)'};
        this.bg2 = {backgroundImage: 'none'}; //

        if (this.produit == 'cadre mural') {
          this.mur = true;
          this.pied = '';
          this.showOpt = false;
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/structure-banderole.png)'};

        } else {
          this.mur = false;
          this.pied = '-pied';
          this.showOpt = true;
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/structure-banderole-pied.png)'};
        }

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showStrc = true;
        this.reqStrc = 'required';
        this.toggleStrc = true;
        this.choixStrc = 'choisir la structure';

    }, // fin fonction choix produit

    // fonction affichage champs formulaire :         au choix dimensions validé
    //==========================================================================
    selectStrc: function(value) {
        this.structure = value;    // on attribue la valeur renvoyée par la fonction à la variable structure
        this.choixStrc = value;    // on attribue la valeur au champ de titre structure
        this.toggleStrc = false;   // on replie le menu à la sélection
        this.reqStrc = '';         // on rétablit les styles du champ à "non requis"

        // ----------------------------------------------------- STRUCTURE SEULE
        if (this.structure == 'Structure seule') {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/structure-seule'+this.pied+'.png)'};
          this.showSupp = false;
          this.showMaqt = false;
          this.showSign = false;

          // afficher le champ suivant et indiquer qu'il est requis :
          if (this.produit == 'cadre mural') {
            this.showAccr = true;
            this.reqAccr = 'required';
            this.toggleAccrt = true;
            this.choixAccr = 'choisir un type d\'accroche';

          } else {
            this.showProj = true;
            this.reqProj = 'required';
            this.toggleProj = true;
            this.choixProj = 'choisir une option projecteur';
          }

        // -----------------------------------------------------
        } else {

          // afficher/masquer les images
          this.bg1 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/structure-banderole'+this.pied+'.png)'};

          // afficher le champ suivant et indiquer qu'il est requis :
          this.showSupp = true;
          this.reqSupp = 'required';
          this.toggleSupp = true;
          this.choixSupp = 'choisir votre bâche';
        }
    }, // fin fonction choix dimensions


    // fonction affichage champs formulaire :          au choix structure validé
    //==========================================================================
    selectSupp: function(value) {
        this.support = value;      // on attribue la valeur renvoyée par la fonction à la variable support
        this.choixSupp = value;    // on attribue la valeur au champ de titre support
        this.toggleSupp = false;   // on replie le menu à la sélection
        this.reqSupp = '';        // on rétablit les styles du champ à "non requis"
        if (this.produit == 'cadre mural') {
          this.showAccr = true;
          this.reqAccr = 'required';
          this.toggleAccrt = true;
          this.choixAccr = 'choisir un type d\'accroche';

        } else {
          this.showProj = true;
          this.reqProj = 'required';
          this.toggleProj = true;
          this.choixProj = 'choisir une option projecteur';
        }

    },

    // fonction affichage champs formulaire:                     choix accroches
    //==========================================================================
    selectAccr: function(value) {
        this.accroche = value;
        this.choixAccr = value;
        this.toggleAccr = false;
        this.reqAccr = '';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showProj = true;
        this.reqProj = 'required';
        this.toggleProj = true;
        this.choixProj = 'choisir une option projecteurs';
    },

    // fonction affichage champs formulaire:           au choix épaisseur validé
    //==========================================================================
    selectProj: function(value) {
        this.projecteur = value;
        this.choixProj = value;
        this.toggleProj = false;
        this.reqProj = '';

        // ----------------------------------------------------- STRUCTURE SEULE
        if (this.structure == 'Structure seule') {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.reqQtte = 'required';
          this.showOptions = true;

        // -----------------------------------------------------
        } else {
          // afficher le champ suivant et indiquer qu'il est requis :
          this.showMaqt = true;
          this.reqMaqt = 'required';
          this.toggleMaqt = true;
          this.choixMaqt = 'votre maquette (fichier d\'impression)';
        }
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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/fond.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/structure-bache/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/structure-bache/fond.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/structure-bache/'+src+'.png)'};
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

    // fonction input hauteur :                               check remplissage
    //==========================================================================
    checkSize: function(input, value) {
      if (value < 1 || isNaN(value) || value == '' || value < 100) {
        this.reqHaut = 'required';
        this.errorSize = 'entrez une hauteur en cm supérieure à 100';
        this.showEsize = true;
      } else {
        this.reqHaut = '';
        this.errorSize = '';
        this.showEsize = false;
      }
    },

    // fonction input largeur :                                check remplissage
    //==========================================================================
    checkSize2: function(input, value) {
      if (value < 1 || isNaN(value) || value == '' || value < 100) {
        this.reqLarg = 'required';
        this.errorSize = 'entrez une largeur en cm supérieure à 100';
        this.showEsize = true;
      } else {
        this.reqLarg = '';
        this.errorSize = 'Cadre '+this.hauteur+' x '+value+' cm : votre banderole fera '+(this.hauteur-21)+' x '+(value-21)+' cm';
        this.showEsize = true;
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
		var structureachat          = 0;
        var fp                 = '';
        var tissu              = 0;
        var pmL                = 0;   // /prix au metre linéaire
        var pu                 = 0;
        var cena               = 0; 	var cena2      = 0; 		var prixunite  = 0;
        var rabat              = 0;	 	var rabat2     = 0;
        var suma               = 0; 	var suma2      = 0;
        var transport          = 0;
        var designation        = '';
        var optliv             = '';
        var prliv              = '';
        var option             = '';
		var prixbache			= '';    var prixstructure			= '';
		var plm               = 0; ////prix de la laize au M²
		var prixproduit 	  = 0;
		var oeillets = 0;
		var ourlets = 0;
		var tendeurs= 0;
		var largeurbache = 0; ///// taille du cadre -21cm + 5cm ourlet
		var hauteurbache = 0; ///// taille du cadre -21cm + 5cm ourlet

        //----------------------------------------------------------------------
        metraz                 = (this.largeur/100) * (this.hauteur/100);      // métrage
        metraz                 = fixstr(metraz);
        metrazzaokraglony1     = ((this.largeur/100) + (this.hauteur/100))*2;    // périmètre
        metrazzaokraglony      = Math.round(metrazzaokraglony1);
		largeurbache = this.largeur-16; ///// taille du cadre -21cm + 5cm ourlet
		hauteurbache = this.hauteur-16; ///// taille du cadre -21cm + 5cm ourlet

		  //------------------------- prix de la banderole en fonction de la laize

    		if (largeurbache <= 50)                         {l1=50; l2=050-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 51 && largeurbache <= 80) {l1=80; l2=080-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 81 && largeurbache <= 110) {l1=110; l2=110-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 111 && largeurbache <= 137) {l1=137; l2=137-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 138 && largeurbache <= 160) {l1=160; l2=160-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 161 && largeurbache <= 200) {l1=200; l2=200-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 201 && largeurbache <= 250) {l1=250; l2=250-largeurbache; perteL=l2*hauteurbache;};
    		if (largeurbache >= 251)                         {l1=largeurbache; perteL=largeurbache*hauteurbache;};

    		if (hauteurbache <= 50)                          {h1=50; h2=50-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 51 && hauteurbache <= 80) {h1=80; h2=80-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 81 && hauteurbache <= 110) {h1=110; h2=110-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 111 && hauteurbache <= 137) {h1=137; h2=137-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 138 && hauteurbache <= 160) {h1=160; h2=160-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 161 && hauteurbache <= 200) {h1=200; h2=200-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 201 && hauteurbache <= 250) {h1=250; h2=250-hauteurbache; perteH=h2*largeurbache;};
    		if (hauteurbache >= 251)                         {h1=hauteurbache; perteH=hauteurbache*largeurbache;};

    		if (perteH < perteL){
    			metrage = (largeurbache*h1)/10000;

    			////jet 550
    			if ((this.support == 'jet 550' ) && (h1<=100) ){plm =14.00 ;}
    			if ((this.support == 'jet 550' ) && ((h1>=101)&&(h1<=160)) ){plm =14.00 ;}
    			if ((this.support == 'jet 550' ) && ((h1>=161)&&(h1<=200))){plm =14.70 ;}
    			if ((this.support == 'jet 550' ) && ((h1>=201)&&(h1<=250))){plm =15.50 ;}
    			if ((this.support == 'jet 550' ) && (h1>=251)){plm =15.90 ;}


    			////jet 520 M1
    			if ((this.support == 'jet 520 M1' ) && (h1<=100) ){plm =16.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((h1>=101)&&(h1<=160)) ){plm =16.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((h1>=161)&&(h1<=200))){plm =17.50 ;}
    			if ((this.support == 'jet 520 M1' ) && ((h1>=201)&&(h1<=250))){plm =18.90 ;}
    			if ((this.support == 'jet 520 M1' ) && (h1>=251)){plm =19.50 ;}


    			////bache micro perforee M1
    			if ((this.support == 'bache micro perforee M1' ) && (h1<=100) ){plm =8.50 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((h1>=101)&&(h1<=160)) ){plm =8.50 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((h1>=161)&&(h1<=200))){plm =9.20 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((h1>=201)&&(h1<=250))){plm =9.99 ;}
    			if ((this.support == 'bache micro perforee M1' ) && (h1>=251)){plm =10.99 ;}



    			prixproduit = metrage*plm;
    		}

    		else if (perteH > perteL){
    			metrage = (hauteurbache*l1)/10000;

    			////jet 550
    			if ((this.support == 'jet 550' ) && (l1<=100) ){plm =14.00 ;}
    			if ((this.support == 'jet 550' ) && ((l1>=101)&&(l1<=160)) ){plm =14.00 ;}
    			if ((this.support == 'jet 550' ) && ((l1>=161)&&(l1<=200))){plm =14.70 ;}
    			if ((this.support == 'jet 550' ) && ((l1>=201)&&(l1<=250))){plm =15.50 ;}
    			if ((this.support == 'jet 550' ) && (l1>=251)){plm =15.90 ;}

    			////jet 520 M1
    			if ((this.support == 'jet 520 M1' ) && (l1<=100) ){plm =16.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=101)&&(l1<=160)) ){plm =16.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=161)&&(l1<=200))){plm =17.50 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=201)&&(l1<=250))){plm =18.90 ;}
    			if ((this.support == 'jet 520 M1' ) && (l1>=251)){plm =19.50 ;}

    			////bache micro perforee M1
    			if ((this.support == 'bache micro perforee M1' ) && (l1<=100) ){plm =8.50 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=101)&&(l1<=160)) ){plm =8.50 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=161)&&(l1<=200))){plm =9.20 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=201)&&(l1<=250))){plm =9.99 ;}
    			if ((this.support == 'bache micro perforee M1' ) && (l1>=251)){plm =10.99 ;}


    			prixproduit = metrage*plm;
    		}

    		else if(perteH == perteL){
    			metrage = (hauteurbache*l1)/10000;

    			////jet 550
    			if ((this.support == 'jet 550' ) && (l1<=100) ){plm =14.00 ;}
    			if ((this.support == 'jet 550' ) && ((l1>=101)&&(l1<=160)) ){plm =14.00 ;}
    			if ((this.support == 'jet 550' ) && ((l1>=161)&&(l1<=200))){plm =14.70 ;}
    			if ((this.support == 'jet 550' ) && ((l1>=201)&&(l1<=250))){plm =15.50 ;}
    			if ((this.support == 'jet 550' ) && (l1>=251)){plm =15.90 ;}

    			////jet 520 M1
    			if ((this.support == 'jet 520 M1' ) && (l1<=1.00) ){plm =16.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=101)&&(l1<=160)) ){plm =16.90 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=161)&&(l1<=200))){plm =17.50 ;}
    			if ((this.support == 'jet 520 M1' ) && ((l1>=201)&&(l1<=250))){plm =18.90 ;}
    			if ((this.support == 'jet 520 M1' ) && (l1>=251)){plm =19.50 ;}

    			////bache micro perforee M1
    			if ((this.support == 'bache micro perforee M1' ) && (l1<=100) ){plm =8.50 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=101)&&(l1<=160)) ){plm =8.50 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=161)&&(l1<=200))){plm =9.20 ;}
    			if ((this.support == 'bache micro perforee M1' ) && ((l1>=201)&&(l1<=250))){plm =9.99 ;}
    			if ((this.support == 'bache micro perforee M1' ) && (l1>=251)){plm =10.99 ;}

    			prixproduit = metrage*plm; //prix de la banderole
    		}

    		metragefinal = metrage*this.qte;
    		this.prixTotal = prixproduit*this.qte;

    		//---------- prix de l'ensemble de la commande en fonction metrage final





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
				this.bacheType = 'Jet 550gr'
				this.inputHauteurB= this.hauteur-21
				this.inputLargeurB= this.largeur-21
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
				this.bacheType = 'Jet 520gr M1'
				this.inputHauteurB= this.hauteur-21
				this.inputLargeurB= this.largeur-21
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
				this.bacheType = 'Micro perforée'
				this.inputHauteurB= this.hauteur-21
				this.inputLargeurB= this.largeur-21

    		}







        //---------------------------------------------------- PRIX TOTAL BACHES

    	prixbache = cenatotal;


		 //---------------------------------------------------- PRIX oeillets
		oeillets = ((metrazzaokraglony1+2)/0.25)*0.15;
		//---------------------------------------------------- PRIX ourlets
		ourlets = metrazzaokraglony1*2.00;
		//---------------------------------------------------- PRIX tendeurs
		tendeurs = ((metrazzaokraglony1+2)/0.25)*0.52;

        //-------------------------------------------------------- prix cadre



			if (metrazzaokraglony <=4.00){ structureachat=52.14;}
			if ((4.00< metrazzaokraglony) && (metrazzaokraglony <=5.00)){ structureachat=60.22;}
			if ((5.00< metrazzaokraglony) && (metrazzaokraglony <=6.00)){ structureachat=68.29;}
			if ((6.00< metrazzaokraglony) && (metrazzaokraglony <=7.00)){ structureachat=76.37;}
			if ((7.00< metrazzaokraglony) && (metrazzaokraglony <=8.00)){ structureachat=84.45;}
			if ((8.00< metrazzaokraglony) && (metrazzaokraglony <=9.00)){ structureachat=92.53;}
			if ((9.00< metrazzaokraglony) && (metrazzaokraglony <=10.00)){ structureachat=100.61;}
			if ((10.00< metrazzaokraglony) && (metrazzaokraglony <=11.00)){ structureachat=117.70;}
			if ((11.00< metrazzaokraglony) && (metrazzaokraglony <=12.00)){ structureachat=125.78;}
			if ((12.00< metrazzaokraglony) && (metrazzaokraglony <=13.00)){ structureachat=133.86;}
			if ((13.00< metrazzaokraglony) && (metrazzaokraglony <=14.00)){ structureachat=141.94;}
			if ((14.00< metrazzaokraglony) && (metrazzaokraglony <=15.00)){ structureachat=150.00;}
			if ((15.00< metrazzaokraglony) && (metrazzaokraglony <=16.00)){ structureachat=158.00;}
			if ((16.00< metrazzaokraglony) && (metrazzaokraglony <=17.00)){ structureachat=166.00;}
			if ((17.00< metrazzaokraglony) && (metrazzaokraglony <=18.00)){ structureachat=174.00;}
			if ((18.00< metrazzaokraglony) && (metrazzaokraglony <=19.00)){ structureachat=191.00;}
			if ((19.00< metrazzaokraglony) && (metrazzaokraglony <=20.00)){ structureachat=199.00;}
			if ((20.00< metrazzaokraglony) && (metrazzaokraglony <=21.00)){ structureachat=207.00;}
			if ((21.00< metrazzaokraglony) && (metrazzaokraglony <=22.00)){ structureachat=215.00;}
			if ((22.00< metrazzaokraglony) && (metrazzaokraglony <=23.00)){ structureachat=223.00;}
			if ((23.00< metrazzaokraglony) && (metrazzaokraglony <=24.00)){ structureachat=231.00;}
			if ((24.00< metrazzaokraglony) && (metrazzaokraglony <=25.00)){ structureachat=239.00;}
			if ((25.00< metrazzaokraglony) && (metrazzaokraglony <=26.00)){ structureachat=247.00;}
			if ((26.00< metrazzaokraglony) && (metrazzaokraglony <=28.00)){ structureachat=273.00;}
			if ((28.00< metrazzaokraglony) && (metrazzaokraglony <=30.00)){ structureachat=289.00;}
			if ((30.00< metrazzaokraglony) && (metrazzaokraglony <=32.00)){ structureachat=305.00;}
			if ((32.00< metrazzaokraglony) && (metrazzaokraglony <=34.00)){ structureachat=321.00;}
			if ((34.00< metrazzaokraglony) && (metrazzaokraglony <=36.00)){ structureachat=346.00;}
			if ((36.00< metrazzaokraglony) && (metrazzaokraglony <=38.00)){ structureachat=362.00;}
			if ((38.00< metrazzaokraglony) && (metrazzaokraglony <=40.00)){ structureachat=379.00;}
			if ((40.00< metrazzaokraglony) && (metrazzaokraglony <=42.00)){ structureachat=395.00;}
			if ((42.00< metrazzaokraglony) && (metrazzaokraglony <=43.00)){ structureachat=403.00;}
			if ((43.00< metrazzaokraglony) && (metrazzaokraglony <=44.00)){ structureachat=411.00;}
			if ((44.00< metrazzaokraglony) && (metrazzaokraglony <=45.00)){ structureachat=419.00;}
			if ((45.00< metrazzaokraglony) && (metrazzaokraglony <=46.00)){ structureachat=427.00;}
			if ((46.00< metrazzaokraglony) && (metrazzaokraglony <=47.00)){ structureachat=435.00;}
			if ((47.00< metrazzaokraglony) && (metrazzaokraglony <=48.00)){ structureachat=443.00;}


           prixstructure = structureachat*1.5;

		 //-------------------------------------------------------- type de cadre

        if (this.produit == 'cadre mural') {

		prixstructure *= 1 ;
        }

        if (this.produit == 'cadre sur pied') {
          prixstructure *= 1.5 ;
        }

        //----------------------------------------------- structure seule ou pas

        if (this.structure == 'Structure + bache') {
          cena = prixstructure + prixbache + ourlets+ oeillets + tendeurs ;
		  this.Struct = 'Structure + Bâche';
        }

        if (this.structure == 'Structure seule') {
          cena = prixstructure;
		  this.Struct = 'Structure';
        }



        //-------------------------------------------------------------- support

      /*  if (this.support == 'bache micro perforee M1') {
          cena += 1;
        }

        if (this.support == 'jet 520 M1') {
          cena += 3;
        }

        if (this.support == 'jet 550') {
          cena += 3;
        }*/

        //------------------------------------------------------ options lestage

        if (this.option == '2 ipn') {
          cena += 6;
		  this.IPN = 'Accroches pour 2 IPN';
        }

        if (this.option == '3 ipn') {
          cena += 9;
		  this.IPN = 'Accroches pour 3 IPN';
        }

        if (this.option == '4 ipn') {
          cena += 12;
		  this.IPN = 'Accroches pour 4 IPN';
        }

        if (this.option == '5 ipn') {
          cena += 15;
		  this.IPN = 'Accroches pour 5 IPN';
        }

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

        } else if (this.hauteur < 100 || this.largeur < 100) {
          this.errorMessage='<i class="fa fa-warning"></i> votre cadre doit faire au minimum 100x100 cm';
          this.erreurType=1; this.reqLarg = 'required';

		 } else if (this.produit == 'cadre sur pied' && this.largeur < 200) {
          this.errorMessage='<i class="fa fa-warning"></i>Largeur minimum 200 cm';
          this.erreurType=1; this.reqLarg = 'required';

        } else if (this.hauteur > 250) {
          this.errorMessage='<i class="fa fa-warning"></i> Hauteur maximum 250 cm';
          this.erreurType=1; this.reqLarg = 'required';

        } else if (this.produit == 'cadre mural' && this.largeur > 2000) {
          this.errorMessage='<i class="fa fa-warning"></i> Largeur maximum 2000 cm';
          this.erreurType=1; this.reqLarg = 'required';

        } else if (this.produit == 'cadre sur pied' && this.largeur > 1000) {
          this.errorMessage='<i class="fa fa-warning"></i> Largeur maximum 1000 cm';
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


          genImg(); // générer l'image produit et l'ajouter au formulaire

          // ---------------------------------------- données envoyées au panier
          var dprod = this.delaiprod;  if (this.delaiprod == '1-1') dprod = '1';
          var dliv  = this.delailiv;   if (this.delailiv  == '1-1') dliv  = '1';

          this.inputHauteur = this.hauteur;
          this.inputLargeur = this.largeur;

          if ((this.produit == 'cadre mural') && (this.structure == 'Structure seule')) {
            this.inputDesc = '- '+this.produit+'<br>- '+this.Struct+'<br />- H|'+this.inputHauteur+' x L|'+this.inputLargeur+'<br>- '+this.retrait+this.optliv+' <br>- P '+dprod+'J / L '+dliv+'J';

          } else if ((this.produit == 'cadre mural') && (this.structure == 'Structure + bache')) {
            this.inputDesc = '- '+this.produit+'<br>- '+this.Struct+'<br />- H|'+this.inputHauteur+' x L|'+this.inputLargeur+'<br />- Bâche: H|'+this.inputHauteurB+' x L|'+this.inputLargeurB+'<br>- '+this.bacheType+'<br>- '+this.modmaq+'<br>- '+this.retrait+this.optliv+' <br>- P '+dprod+'J / L '+dliv+'J';

          } else if ((this.produit == 'cadre sur pied') && (this.structure == 'Structure seule')) {
            this.inputDesc = '- '+this.produit+'<br>- '+this.Struct+'<br />- H|'+this.inputHauteur+' x L|'+this.inputLargeur+'<br>- '+this.IPN+'<br>- '+this.retrait+this.optliv+' <br>- P '+dprod+'J / L '+dliv+'J';

          } else if ((this.produit == 'cadre sur pied') && (this.structure == 'Structure + bache')) {
            this.inputDesc = '- '+this.produit+'<br>- '+this.Struct+'<br />- H|'+this.inputHauteur+' x L|'+this.inputLargeur+'<br />- Bâche: H|'+this.inputHauteurB+' x L|'+this.inputLargeurB+'<br>- '+this.bacheType+'<br>- '+this.modmaq+' <br>- '+this.IPN+' <br>- '+this.retrait+this.optliv+' <br>- P '+dprod+'J / L '+dliv+'J';
          }

          this.inputProd      = 'Structure Cadre Banderole';
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
