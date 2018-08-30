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
      choixProd : 'choisir l\'impression',
      choixOpts : '',
      choixRain : '',
      choixMaqt : '',
      choixSign : '',
      choixPers : '',
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
      reqHaut: '',
      reqLarg: '',
      reqRain: '',
      reqMaqt: '',
      reqSign: '',
      reqQtte: '',
      reqEstm: '',
      reqOpts: '',
      reqPers: '',

      btnP1: 'inactive',
      btnP2: 'inactive',
      btnP3: 'inactive',
      btnD1: 'inactive',
      btnD2: 'inactive',
      btnD3: 'inactive',

      // valeurs par défaut de visibilité des blocs :
      toggleProd: true,
      toggleOpts: true,
      toggleRain: true,
      toggleMaqt: true,
      toggleSign: true,
      togglePers: true,

      showRain: false,
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
      rislans: false,
      faicon: 'fa-circle-o',

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
      calqueContent: '',

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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/akilux/bg.png)'};
        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/akilux/pvc.png)'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showOpts = true;
        this.reqOpts = 'required';
        this.toggleOpts = true;
        this.choixOpts = 'choisir une option';

    }, // fin fonction choix produit

    // fonction affichage champs formulaire :            au choix options validé
    //==========================================================================
    selectOpts: function(value) {
        this.choixOpts = value;
        this.toggleOpts = false;
        this.reqOpts = '';

        this.showPers  = this.showRain  = false;
        this.choixPers = this.choixRain = '';

        if (this.choixOpts == '2 oeillets') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/akilux/oeuil2.png)'};
        if (this.choixOpts == '4 oeillets') this.bg2 = {backgroundImage: 'url('+this.$global.img+'/akilux/oeuil4.png)'};

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showMaqt = true;
        this.reqMaqt = 'required';
        this.toggleMaqt = true;
        this.choixMaqt = 'votre maquette (fichier d\'impression)';

    }, // fin fonction choix options

    // fonction affichage champs formulaire :           au choix quantité validé
    //==========================================================================
    selectPers: function(value) {
        this.choixPers = value;
        this.togglePers = false;
        this.reqPers = '';

        // afficher le champ suivant et indiquer qu'il est requis :
        this.showRain = true;
        this.reqRain = 'required';
        this.toggleRain = true;
        this.choixRain = 'choisir le rainage';
    },

    // fonction affichage champs formulaire :            au choix support validé
    //==========================================================================
    selectRain: function(value, src) {
        this.choixRain = value;
        this.toggleRain = false;
        this.reqRain = '';

        this.bg1 = {backgroundImage: 'url('+this.$global.img+'/akilux/base'+src+'.png)'};

        // afficher le champ suivant et indiquer qu'il est requis :
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

        // afficher le champ suivant et indiquer qu'il est requis :
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

        // afficher le champ suivant et indiquer qu'il est requis :
        this.reqQtte = this.reqHaut = this.reqLarg = 'required';
        this.showOptions = true;
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
        this.bg0 = {backgroundImage: 'url('+this.$global.img+'/akilux/bg.png)'};
        this.bgH = {backgroundImage: 'url('+this.$global.img+'/akilux/logo.png),url('+this.$global.img+'/akilux/'+src+'.png)'};
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

      this.bg0 = {backgroundImage: 'url('+this.$global.img+'/akilux/bg.png)'};
      this.bgH = {backgroundImage: 'url('+this.$global.img+'/akilux/'+src+'.png)'};
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

      }/* else if  (value < 30) {
        if (input == 'hauteur')  {this.reqHaut = 'required'; this.errorSize = 'taille minimum : 20x30 cm'; this.showEsize = true;}
        if (input == 'largeur')  {this.reqLarg = 'required'; this.errorSize = 'taille minimum : 20x30 cm'; this.showEsize = true;}

      }*/ else {
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
        var cena           = 0; var cena2      = 0; var cena1     = 0;
  			var suma           = 0; var suma2      = 0; var prixunite = 0;
  			var rabat          = 0; var rabat2     = 0;
  			var transport      = 0;
  			var opis           = '';
  			var prliv          = '';
  			var option2        = 0;
  			var p1             = 0; var p2 = 0; var metragetotal = 0 ; var poidstotal = 0;
  			var coupe          = 0; var fixations = 0; var rainage = 0; var puoption = 0; var maquette = 0;

        //----------------------------------------------------------------------
        var metrage = (this.largeur/100)*(this.hauteur/100)*this.qte;

        if (this.produit == 'recto standard' || this.produit == 'recto hd') {

          if (metrage <= 0.03)                   p1=17*metrage;
      		if (metrage > 0.03 && metrage <= 0.05) p1=15*metrage;
      		if (metrage > 0.05 && metrage <= 0.08) p1=14*metrage;
      		if (metrage > 0.08 && metrage <= 0.12) p1=13*metrage;
      		if (metrage > 0.12 && metrage <= 0.20) p1=12*metrage;
      		if (0.20 < metrage)                    p1=11*metrage;
        }

        if (this.produit == 'recto/verso standard' || this.produit == 'recto/verso hd') {

          if (metrage <= 0.03)                   p1=(17+(17*0.4))*metrage; // +40%
      		if (metrage > 0.03 && metrage <= 0.05) p1=(15+(15*0.4))*metrage;
      		if (metrage > 0.05 && metrage <= 0.08) p1=(14+(14*0.4))*metrage;
      		if (metrage > 0.08 && metrage <= 0.12) p1=(13+(13*0.4))*metrage;
      		if (metrage > 0.12 && metrage <= 0.20) p1=(12+(12*0.4))*metrage;
      		if(0.20 < metrage)                     p1=(11+(11*0.4))*metrage;
        }

  			//------------------------------------------------------------- fixation

  			if (this.choixOpts == '2 oeillets')    fixations = 1*this.qte;
  			if (this.choixOpts == '4 oeillets')    fixations = 2*this.qte;



        // ------------------------------------------------------------ MAQUETTE

        if (this.maquette == 'mise en page france banderole') {
          maquette = 19;
          this.modmaq = 'France banderole crée la mise en page';
        }
        if (this.maquette == 'maquette client bat') {
          maquette = 5;
          this.modmaq = 'BAT en ligne';
        }
        if (this.maquette == 'maquette en ligne') {
          maquette = 5;
          this.modmaq = 'je crée ma maquette en ligne';
        }
        if (this.maquette == 'maquette client sans bat') {
  				this.modmaq = 'je ne souhaite pas de BAT';
  			}


  			//-------------------------------------------------------- total produit
        puoption = p1+fixations;
        puoption2 = (puoption+maquette)/this.qte;
      	cena = puoption+maquette;

        // -------------------------------------------------------------------HD
        if (this.produit == 'recto hd' || this.produit == 'recto/verso hd') {prixHD = cena*0.30; cena += prixHD;}

        // ----------------------------------------------------------- SIGNATURE

        if (this.sign == 'sans signature') {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena += 5*this.qte;}
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
          cena += 5.00;
          this.retrait = 'relais colis';
        }

        if (this.colis == true) {
          if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 2;}
          this.optliv = ' / colis revendeur';
        }

        var palet = '';
    		if (this.palette == true) {
          cena += 160;
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

        prixtransport2 = prixtransport*0.4;
    		transport = prixtransport + prixtransport2;

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


        if (this.hauteur + this.largeur >= 210 ) {
          if (this.palette == false) {
            this.warngMessage = '- Nos panneaux sont livrés en mètre linéaire, si vous souhaitez votre panneau en 1 seul morceau cochez l\'option "Grand format livré entier"';
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

        } else if (this.choixMaqt == 'votre maquette (fichier d\'impression)') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option maquette';

        }  else if (this.choixSign == 'logo france banderole ?') {
          this.erreurType=1; this.errorMessage='<i class="fa fa-warning"></i> veuillez une option signature';

        }else if (this.hauteur == '' || isNaN(this.hauteur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une hauteur';
          this.erreurType=1; this.reqHaut = 'required';

        } else if (this.largeur == '' || isNaN(this.largeur)) {
          this.errorMessage='<i class="fa fa-warning"></i> veuillez entrer une largeur';
          this.erreurType=1; this.reqLarg = 'required';

  			} else if ( this.largeur <= 0  || this.hauteur <= 0 ){
  				this.errorMessage = '<i class="fa fa-warning"></i> Merci de spécifier une taille en <u>centimètres</u>';
  				this.erreurType=1; this.reqHaut = this.reqLarg = 'required';

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

          // ----------------------------------------- forfait si prix < 29 €
          if ( suma < 29 ) {
            var forfait = 29 - suma;
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

              suma = 29;
              suma = fixstr(suma);
              this.suma2 = suma.replace(".", ",");

              this.prixTotal = this.suma2 +' €' ;

            } else {
              newoption = parseFloat(forfait);
              newoption = fixstr(newoption);
              newoption2 = newoption.replace(".", ",");
              option2 = newoption2;

              this.prixOption = newoption2 +' €' ;

              suma = 29;
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

          this.inputDesc = '- '+this.produit+' <br />- H|'+this.hauteur+' x L|'+this.largeur+' <br>- '+this.choixOpts+' <br>- '+this.modmaq+' <br>- '+this.sign+' <br>- '+this.retrait+this.optliv+palet+' <br>- P '+dprod+'J / L '+dliv+'J';

          this.inputProd      = 'PVC 300 microns';
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
