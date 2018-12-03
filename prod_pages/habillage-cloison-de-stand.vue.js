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
      choixSupp : 'choisir le matériau',
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
      if ( document.getElementById('rev') || document.getElementById('revendeur') || document.getElementById('revendeurRC') || document.getElementById('revendeurRS')) this.swRvd = true;
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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/totem/int.png)'};
        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/banderole/220g.png)'};
        this.bg2 = {backgroundImage: 'none'};


        // afficher le champ suivant et indiquer qu'il est requis :
        this.showScra = true;
        this.reqScra = 'required';
        this.toggleScra = true;
        this.choixScra = 'choisissez votre finition';
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

        // afficher image scratch
        if (this.scratch == 'scratch haut/bas')           this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourletshb.png)'};
        else if (this.scratch == 'scratch gauche/droite') this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourletsdg.png)'};
        else if (this.scratch == 'scratch perimetrique')  this.bg3 = {backgroundImage: 'url('+this.$global.img+'/banderole/ourlets.png)'};
        else                                              this.bg3 = {backgroundImage: 'none'};

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

    // fonctions input hauteur / largeur :                     check remplissage
    //==========================================================================
    checkSize: function(input, value) {
      if (value < 1 || isNaN(value) || value == '') {
        if (input == 'hauteur')  {this.reqHaut = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}
        if (input == 'largeur')  {this.reqLarg = 'required'; this.errorSize = 'entrez une valeur numérique entière en cm'; this.showEsize = true;}

      } else {
        if (input == 'hauteur')  {this.reqHaut = ''; this.errorSize = ''; this.showEsize = false;}
        if (input == 'largeur')  {this.reqLarg = ''; this.errorSize = ''; this.showEsize = false;}
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

        metraz                 = this.largeur/100 * this.hauteur/100;
        var metrazzaokraglony1 = (this.largeur/100 + this.hauteur/100)*2;
        metrazzaokraglony      = Math.round(metrazzaokraglony1);
        var hautbas            = this.largeur/100*2;
        var gauchedroite       = this.hauteur/100*2;

        //------------------------- prix de la banderole en fonction de la laize

    		if (this.largeur/100 <= 0.50)                             {l1=0.5;  l2=0.5 -this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 0.51 && this.largeur/100 <= 0.80) {l1=0.80; l2=0.80-this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 0.81 && this.largeur/100 <= 1.10) {l1=1.10; l2=1.10-this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 1.11 && this.largeur/100 <= 1.37) {l1=1.37; l2=1.37-this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 1.38 && this.largeur/100 <= 1.60) {l1=1.60; l2=1.60-this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 1.61 && this.largeur/100 <= 2.00) {l1=2.00; l2=2.00-this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 2.01 && this.largeur/100 <= 2.50) {l1=2.50; l2=2.50-this.largeur/100; perteL=l2*this.hauteur/100;};
    		if (this.largeur/100 >= 2.51)                             {l1=this.largeur/100; perteL=this.largeur/100*this.hauteur/100;};

    		if (this.hauteur/100 <= 0.50)                             {h1=0.5;  h2=0.5- this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 0.51 && this.hauteur/100 <= 0.80) {h1=0.80; h2=0.80-this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 0.81 && this.hauteur/100 <= 1.10) {h1=1.10; h2=1.10-this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 1.11 && this.hauteur/100 <= 1.37) {h1=1.37; h2=1.37-this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 1.38 && this.hauteur/100 <= 1.60) {h1=1.60; h2=1.60-this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 1.61 && this.hauteur/100 <= 2.00) {h1=2.00; h2=2.00-this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 2.01 && this.hauteur/100 <= 2.50) {h1=2.50; h2=2.50-this.hauteur/100; perteH=h2*this.largeur/100;};
    		if (this.hauteur/100 >= 2.51)                             {h1=this.hauteur/100; perteH=this.hauteur/100*this.largeur/100;};

    		if (perteH < perteL){
    			metrage = this.largeur/100*h1;
    			////tissu 220g
    			if ((this.support == 'tissu 220g' ) && (h1<=1.00) ){plm =25.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((h1>=1.01)&&(h1<=1.60)) ){plm =24.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((h1>=1.61)&&(h1<=2.00))){plm =23.00;}
    			if ((this.support == 'tissu 220g' ) && ((h1>=2.01)&&(h1<=2.50))){plm =22.00 ;}
    			if ((this.support == 'tissu 220g' ) && (h1>=2.51)){plm =25.00 ;}

    			prixproduit = metrage*plm;
    		}

    		else if (perteH > perteL){
    			metrage = this.hauteur/100*l1;
    			////tissu 220g
    			if ((this.support == 'tissu 220g' ) && (l1<=1.00) ){plm =25.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =24.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =23.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =22.00 ;}
    			if ((this.support == 'tissu 220g' ) && (l1>=2.51)){plm =25.00 ;}

    			prixproduit = metrage*plm;
    		}

    		else if(perteH == perteL){
    			metrage = this.hauteur/100*l1;
    			////tissu 220g
    			if ((this.support == 'tissu 220g' ) && (l1<=1.00) ){plm =25.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.01)&&(l1<=1.60)) ){plm =24.00 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=1.61)&&(l1<=2.00))){plm =23.000 ;}
    			if ((this.support == 'tissu 220g' ) && ((l1>=2.01)&&(l1<=2.50))){plm =22.00 ;}
    			if ((this.support == 'tissu 220g' ) && (l1>=2.51)){plm =25.00 ;}

    			prixproduit = metrage*plm; //prix de la banderole
    		}

    		metragefinal = metrage*this.qte;
    		this.prixTotal = prixproduit*this.qte;

    		//---------- prix de l'ensemble de la commande en fonction metrage final

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


        //---------------------------------------------------- PRIX TOTAL BACHES

    		cena = cenatotal/this.qte;
        console.log('cena:' +cena);

        //===============================================================OPTIONS

    		//--------------------------------------------------------------scratchs

        var scratch = 0;

    		if (this.scratch == 'scratch haut/bas')      scratch = hautbas*6;
    		if (this.scratch == 'scratch gauche/droite') scratch = gauchedroite*6;
    		if (this.scratch == 'scratch perimetrique')  scratch = metrazzaokraglony1*6;

        cena += scratch;
        console.log('scratch:' +scratch);

    		// ajout 30% si this.hauteur et this.largeur supérieurs à 2.5m //
    		if ( this.largeur/100 > 2.5 && this.hauteur/100 > 2.5 ) {
    			cena *= 1.3;
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

        if (this.roll == true) {
    			cena += this.$global.livROL/this.qte;
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

        if ( this.largeur > 250 && this.hauteur > 250 ) {
    			this.errorMessage = '<i class="fa fa-warning"></i> Hauteur ou Largeur doit être inférieure à 250cm!';
    			this.erreurType = 1; this.reqHaut = this.reqLarg = 'required';
        }

        //---------------------------- vérifier que les champs sont bien remplis

        if (this.qte < 1)        {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une quantité';
          this.erreurType=1; this.reqQtte = 'required';
          this.reqLarg = this.reqHaut = this.reqFixx = '';

        } else if (this.hauteur  == '' || isNaN(this.hauteur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur en centimètres';
          this.erreurType=1; this.reqHaut = 'required';
          this.reqLarg = this.reqQtte = '';

        } else if (this.largeur  == '' || isNaN(this.largeur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une largeur en centimètres';
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

          this.inputHauteur = this.hauteur;
          this.inputLargeur = this.largeur;

          this.inputDesc = '- '+this.support+'<br>- H|'+this.inputHauteur+'cm x L|'+this.inputLargeur+'cm <br>- '+this.scratch+' <br>- '+this.modmaq+'<br>- '+this.sign+'<br>- '+this.retrait+this.optliv+this.roule+'<br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'Cloison tissu';
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
