// fonction globale : ----------------------------------------------------------calculs jours ouvrés
function AddBusinessDays(weekDaysToAdd) {
    var curdate = new Date();
    var realDaysToAdd = 0;
    for(i=0; i<weekDaysToAdd; i++){
      curdate.setDate(curdate.getDate()+1);
      var estdt1 = new Date(curdate);
      var n = curdate.getDay();
      if (n == '6' || n == '0') {
        weekDaysToAdd++;
      }
      realDaysToAdd++;
    }
    return realDaysToAdd;
}

// fonction globale : ----------------------------------------------------------conversion blob to base64 image
function saveBlobAsFile(blob, fileName) {
    return new Promise(function (resolve, reject) {
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onload = function () {
        return resolve(reader.result);
      };
      reader.onerror = function (error) {
        return reject(error);
      };
      return Promise.resolve(reader.result);
    });
}

// fonction globale : ----------------------------------------------------------inclure image produit b64 dans le panier
function sendData(cartData, base64) {
    cartData.innerHTML += '<input type="hidden" name="image" value="'+base64+'" />';
}

// Composants : ----------------------------------------------------------------
/*Vue.component('dimensions', {
    props: ['',''],
    template: '#'
})
*/
// --------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------- INSTANCE VUE.JS
// --------------------------------------------------------------------------------------------

new Vue({

  el: '#prodApp',
  //----------------------------------------------------------------------------DATA (valeurs par défaut VUE)
  data: {
      choix : true, //affiche les sélections en développment, passer en false en prod.
      // valeurs par défaut (value) : ------------------------------------------champs select
      produit: 'choisir',
      dimensions: 'choisir',
      support: 'choisir',
      maquette: 'choisir',
      sign: 'choisir',
      // valeurs par défaut (value) : ------------------------------------------autre champs
      qte: 1,
      adresse: true,
      atelier: false,
      relais: false,
      colis: false,
      delaiprod: '',
      delailiv: '',
      // valeurs par défaut (classe) -------------------------------------------classes
      btnP1: 'production',
      btnP2: 'production',
      btnP3: 'production',
      btnD1: 'delivery',
      btnD2: 'delivery',
      btnD3: 'delivery',
      // valeurs par défaut de visibilité des blocs : --------------------------blocs select produit
      firstSize: false,
      bestSize: false,
      luxSize: false,
      doubleSize: false,
      miniSize: false,
      mistralSize: false,
      changementSize: false,
      firstSupport: false,
      autreSupport: false,
      // valeurs par défaut de visibilité des blocs : --------------------------blocs communs tous produits
      choixMaqt: false,
      choixSign: false,
      choixOptions: false,
      choixLiv: false,
      // valeurs par défaut de visibilité des blocs : --------------------------boutons et date livraison
      dateLivraison: false,
      livraisonrapide: false,
      livraisonComp: false,
      ajoutPanier: false,
      // valeurs par défaut: ---------------------------------------------------images
      slideContainer: true,
      bg1: {backgroundImage: 'none'},
      bg2: {backgroundImage: 'none'},
      bg3: {backgroundImage: 'none'},
      bg4: {backgroundImage: 'none'},
      bg5: {backgroundImage: 'none'},
      pr1: false,
      pr2: false,
      pr3: false,
      pr4: false,
      pr5: false,
      // valeurs par défaut bloc prix : ----------------------------------------wycena
      cartData: '',
      estdate: '',
      forfait: '',
      prixUnit: '-',
      prixOption: '-',
      prixTotal: '-'
    },

    //------------------------------------------------------------------------- METHODS (fonctions VUE)
    methods: {
      // fonction afficher/masquer champs formulaire : -------------------------au choix produit validé
      selectProd: function() {
        // champs réinitialisés + masqués si on change de produit :
        this.support = 'choisir'; this.dimensions = 'choisir';
        this.firstSupport = false; this.autreSupport = false;

        // masquer le slider pour afficher le produit choisi :
        this.slideContainer = false;
        this.pr1 = true;
        this.pr2 = true;
        this.bg1 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/bg.png)'};

        //----------------------------------------------------------------------FIRSTLINE
        if (this.produit == 'first-line') {
          // afficher/masquer les champs
          this.firstSize = true; this.bestSize = false; this.luxSize = false; this.doubleSize = false;
          this.miniSize = false; this.mistralSize = false; this.changementSize = false;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/1first.png)'};

        //----------------------------------------------------------------------BESTLINE
        }else if(this.produit == 'best-line') {
          // afficher/masquer les champs
          this.firstSize = false; this.bestSize = true; this.luxSize = false; this.doubleSize = false;
          this.miniSize = false; this.mistralSize = false; this.changementSize = false;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/2best.png)'};

        //----------------------------------------------------------------------LUXLINE
        }else if (this.produit == 'lux-line') {
          // afficher/masquer les champs
          this.firstSize = false; this.bestSize = false; this.luxSize = true; this.doubleSize = false;
          this.miniSize = false; this.mistralSize = false; this.changementSize = false;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/3lux.png)'};

        //----------------------------------------------------------------------DOUBLE
        }else if (this.produit == 'double') {
          // afficher/masquer les champs
          this.firstSize = false; this.bestSize = false; this.luxSize = false; this.doubleSize = true;
          this.miniSize = false; this.mistralSize = false; this.changementSize = false;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/4double.png)'};

        //----------------------------------------------------------------------MINI
        }else if (this.produit == 'mini') {
          // afficher/masquer les champs
          this.firstSize = false; this.bestSize = false; this.luxSize = false; this.doubleSize = false;
          this.miniSize = true; this.mistralSize = false; this.changementSize = false;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/mini.png)'};

        //----------------------------------------------------------------------MISTRAL
        }else if (this.produit == 'Mistral') {
          // afficher/masquer les champs
          this.firstSize = false; this.bestSize = false; this.luxSize = false; this.doubleSize = false;
          this.miniSize = false; this.mistralSize = true; this.changementSize = false;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/totem/mistral200.png)'};

        //----------------------------------------------------------------------VISUEL
        }else if (this.produit == 'Changement visuel') {
          // afficher/masquer les champs
          this.firstSize = false; this.bestSize = false; this.luxSize = false; this.doubleSize = false;
          this.miniSize = false; this.mistralSize = false; this.changementSize = true;

          // afficher/masquer les images
          this.bg2 = {backgroundImage: 'url(../wp-content/plugins/fbshop/images/roll-up/2best.png)'};

        }
      },

      // fonction afficher/masquer champs formulaire : -------------------------au choix dimensions validé
      selectSize: function() {
        if (this.produit == 'first-line') {
          this.firstSupport = true; this.autreSupport = false;
        }else if(this.produit == 'mini'){
          this.firstSupport = false; this.autreSupport = false;
          this.choixMaqt = true;
        }else{
          this.firstSupport = false; this.autreSupport = true;
        }
      },

      // fonction afficher/masquer champs formulaire : -------------------------au choix support validé
      selectSupport: function() {
        this.choixMaqt = true;
      },

      // fonction afficher/masquer champs formulaire : --------------------------au choix signature validé
      selectMaqt: function() {
        this.choixSign = true;
      },

      // fonction afficher/masquer champs formulaire : -------------------------choix maquette validé
      selectSign: function() {
        this.choixOptions = true;
      },

      // fonction boutons +-  : ------------------------------------------------boutons +- quantité
      qtePlus: function() {
        this.qte++;
      },

      qteMoins: function() {
        if (this.qte > 1) { this.qte--; }
      },

      // fonction checkboxes : -------------------------------------------------cocher/décocher livraison
      checkOptions: function(){

      },

      // fonction reset : ------------------------------------------------------vider champs prix / cacher bouton ajouter au panier
      reset: function(){
        this.prixUnit = '-';
        this.prixOption =  '-';
        this.prixTotal = '-';
        this.choixLiv = false;
        this.livraisonComp = false;
        this.ajoutPanier = false;
        this.btnP1 = 'production';
        this.btnP2 = 'production';
        this.btnP3 = 'production';
        this.btnD1 = 'delivery';
        this.btnD2 = 'delivery';
        this.btnD3 = 'delivery';
      },

      resetProd: function(){
        this.pr2 = false;
      },

      // fonction délais : -----------------------------------------------------boutons délais de production
      selectDeliv: function(value){
        this.delaiprod = value;
        if (this.delaiprod == '4-5') { this.btnP1 = 'active'; this.btnP2 = 'production'; this.btnP3 = 'production';}
        if (this.delaiprod == '2-3') { this.btnP1 = 'production'; this.btnP2 = 'active'; this.btnP3 = 'production';}
        if (this.delaiprod == '1-1') { this.btnP1 = 'production'; this.btnP2 = 'production'; this.btnP3 = 'active';}
        this.choixLiv = true;
      },

      // fonction calcul délais : ----------------------------------------------calcul délais livraision
      dateEstim: function(){

        this.dateLivraison = true;
        var prod_first_val  = parseInt(this.delaiprod[0]);
				var prod_second_val = parseInt(this.delaiprod[2]);
				var deli_first_val  = parseInt(this.delailiv[0]);
				var deli_second_val = parseInt(this.delailiv[2]);
        var days;
        var daystoadd;

				var totalProduction = prod_first_val + deli_first_val;
				var totalDelivery   = prod_second_val + deli_second_val;
				if(totalProduction == totalDelivery){
					days = totalProduction;
				}else{
					days = totalDelivery;
				}
        var curdate = new Date();
				var curhour = curdate.getHours();
				// ajout 1 jour ouvré de délai sur commande après 12h

				if (curhour >= 12) {
					daystoadd = AddBusinessDays(days+1);
				}else{
					daystoadd = AddBusinessDays(days);
				}

				curdate.setDate(curdate.getDate()+daystoadd);
				var estdt = new Date(curdate);
				var month = estdt.getMonth()+1;
				var day = estdt.getDate();
				var output = day + '/' + (month<10 ? '0' : '') + month + '/' + (day<10 ? '' : '') + estdt.getFullYear();

				this.estdate = 'Date de livraison max : '+output;

      },

      // fonction principale : -------------------------------------------------calcul prix produit
      calculer: function(value) {
        this.delailiv = value;
        this.ajoutPanier = true;

        if (this.delailiv == '3-4') { this.btnD1 = 'active'; this.btnD2 = 'delivery'; this.btnD3 = 'delivery';}
        if (this.delailiv == '2-3') { this.btnD1 = 'delivery'; this.btnD2 = 'active'; this.btnD3 = 'delivery';}
        if (this.delailiv == '1-1') { this.btnD1 = 'delivery'; this.btnD2 = 'delivery'; this.btnD3 = 'active';}

            var perteH             = 0; 	var perteL   = 0;
            var h1                 = 0; 	var h2       = 0;
            var l1                 = 0; 	var l2       = 0;
            var metragefinal       = 0;		var details  = '';
            var cenatotal          = '';  var opis     = '';
            var metraz             = 0;   var image;   var ref;
            var metrazzaokraglony  = 0;
            var metrazzaokraglony1 = 0;
            var largeur            = 0;
            var hauteur            = 0;
            var prixsupport        = 0;
            var poids              = '';                                           ////poids total
            var p1                 = '';                                           ////poids du support
            var p2                 = '';                                           ////poids du structure
            var metrage            = 0;
            var structure          = 0;
            var fp                 = '';
            var pu              	 = 0;
            var cena               = 0; 	var cena2      = 0; 		var prixunite  = 0;
            var rabat              = 0;	 	var rabat2     = 0;
            var suma               = 0; 	var suma2      = 0;
            var transport          = 0;   var finalPrice = '';    var finalPrice1 = '';  var finalPrice2 = '';
            var designation        = '';
            var optliv             = '';
            var prliv              = '';
            var date_panier        = '';
            var option             = '';

            //////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////// first-line //

            if (this.produit == 'first-line') {
              if (this.qte<7) {cena=24;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=24;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=24;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=23;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=22.5;}
              if (this.qte>=217 ) {cena=22;}
              if ((this.dimensions == '80x200') && (this.firstSupport == '440g')) {
                cena += 0;
              }

              if ((this.dimensions == '80x200') && (this.firstSupport == '300µ M1')) {
                cena += 3;
              }

              hauteur = 200;
              largeur = 80;
              ref = '20170100';

              designation=this.dimensions;
              details='<br />- '+this.firstSupport;
            }

            // fin first-line ////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////  best-line //

            //------------------------------------------------------------------60x200
            if ((this.produit == 'best-line') && (this.dimensions == '60x200')) {
              if (this.qte<7) {cena=42;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=41;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=40;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=39;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=38;}
              if (this.qte>=217 ) {cena=37;}
              if (this.support == '440g') {cena += 0;}

              if (this.support == 'jet 520 M1') {cena += 4;}
              if (this.support == '100% écologique M1') {cena += 11;}
              if (this.support == 'capotoile') {cena += 11*1.3;}

              hauteur = 200;
              largeur = 60;
              ref = '20170102';
              designation=this.dimensions;
              details='<br />- '+ this.support;
            }
            //------------------------------------------------------------------60x160
            if ((this.produit == 'best-line') && (this.dimensions == '60x160')) {
              if (this.qte<7) {cena=41;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=40;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=39;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=38;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=37;}
              if (this.qte>=217 ) {cena=34;}
              if (this.support == '440g') {cena += 0;}

              if (this.support == 'jet 520 M1') {cena += 4;}
              if (this.support == '100% écologique M1') {cena += 10;}
              if (this.support == 'capotoile') {cena += 11*1.3;}

              hauteur = 160;
              largeur = 60;
              ref = '20170101';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //------------------------------------------------------------------80x200
            if ((this.produit == 'best-line') && (this.dimensions == '80x200')) {
              if (this.qte<7) {cena=44;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=43;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=42;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=41;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=39;}
              if (this.qte>=217 ) {cena=37;}
              if (this.support == '440g') {cena += 0;}

              if (this.support == 'jet 520 M1') {cena += 5;}
              if (this.support == '100% écologique M1') {cena += 12;}
              if (this.support == 'capotoile') {cena += 12*1.3;}

              hauteur = 200;
              largeur = 80;
              ref = '20170103';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //------------------------------------------------------------------85x200
            if ((this.produit == 'best-line') && (this.dimensions == '85x200')) {
              if (this.qte<7) {cena=46;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=45;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=44;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=43;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=42;}
              if (this.qte>=217 ) {cena=39;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 4;}
              if (this.support == 'jet 520 M1') {cena += 6;}
              if (this.support == '100% écologique M1') {cena += 12;}
              if (this.support == 'capotoile') {cena += 12*1.3;}

              hauteur = 200;
              largeur = 85;
              ref = '20170103';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------100x200
            if ((this.produit == 'best-line') && (this.dimensions == '100x200')) {
              if (this.qte<7) {cena=59;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=58;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=57;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=56;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=55;}
              if (this.qte>=217 ) {cena=52;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 4;}
              if (this.support == 'jet 520 M1') {cena += 7;}
              if (this.support == '100% écologique M1') {cena += 13;}
              if (this.support == 'capotoile') {cena += 13*1.3;}

              hauteur = 200;
              largeur = 100;
              ref = '20170105';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------120x200
            if ((this.produit == 'best-line') && (this.dimensions == '120x200')) {
              if (this.qte<7) {cena=80;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=79;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=78;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=77;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=75;}
              if (this.qte>=217 ) {cena=74;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 6;}
              if (this.support == 'jet 520 M1') {cena += 8;}
              if (this.support == '100% écologique M1') {cena += 16;}
              if (this.support == 'capotoile') {cena += 16*1.3;}

              hauteur = 200;
              largeur = 120;
              ref = '20170106';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------150x200
            if ((this.produit == 'best-line') && (this.dimensions == '150x200')) {
              if (this.qte<7) {cena=94;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=93;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=92;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=91;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=89;}
              if (this.qte>=217 ) {cena=88;}

              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 9;}
              if (this.support == 'jet 520 M1') {cena += 10;}
              if (this.support == '100% écologique M1') {cena += 18;}
              if (this.support == 'capotoile') {cena += 18*1.3;}

              hauteur = 200;
              largeur = 150;
              ref = '20170107';
              designation = this.dimensions;
              details = '<br />- '+ this.support;

            }
            //-----------------------------------------------------------------200x200
            if ((this.produit == 'best-line') && (this.dimensions == '200x200')) {
              if (this.qte<7) {cena=169;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=168;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=167;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=166;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=163;}
              if (this.qte>=217 ) {cena=160;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == 'jet 520 M1') {cena += 20;}

              hauteur = 200;
              largeur = 200;
              ref = '20170108';
              designation=this.dimensions;
              details='<br />- '+ this.support;
              details='<br />- '+ this.support;

            }

            // fin best-line /////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////// lux-line //

            //------------------------------------------------------------------80x200
            if ((this.produit == 'lux-line') && (this.dimensions == '80x200')){
              if (this.qte<7) {cena=84;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=83;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=82;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=81;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=79;}
              if (this.qte>=217 ) {cena=78;}
              if (this.support == '440g') {cena += 0;}

              if (this.support == 'jet 520 M1') {cena += 4;}
              if (this.support == '100% écologique M1') {cena += 11;}
              if (this.support == 'capotoile') {cena += 11*1.3;}

              hauteur = 200;
              largeur = 80;
              ref = '20170110';
              designation = this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------100x200
            if ((this.produit == 'lux-line') && (this.dimensions == '100x200')){
              if (this.qte<7) {cena=104;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=103;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=102;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=101;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=99;}
              if (this.qte>=217 ) {cena=98;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 4;}
              if (this.support == 'jet 520 M1') {cena += 5;}
              if (this.support == '100% écologique M1') {cena += 12;}
              if (this.support == 'capotoile') {cena += 12*1.3;}

              hauteur = 200;
              largeur = 100;
              ref = '20170111';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------120x200
            if ((this.produit == 'lux-line') && (this.dimensions == '120x200')){
              if (this.qte<7) {cena=126;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=125;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=124;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=123;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=122;}
              if (this.qte>=217 ) {cena=121;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 6;}
              if (this.support == 'jet 520 M1') {cena += 8;}
              if (this.support == '100% écologique M1') {cena += 16;}
              if (this.support == 'capotoile') {cena += 16*1.3;}

              hauteur = 200;
              largeur = 120;
              ref = '20170112';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------150x200
            if ((this.produit == 'lux-line') && (this.dimensions == '150x200')){
              if (this.qte<7) {cena=165;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=164;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=163;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=162;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=161;}
              if (this.qte>=217 ) {cena=160;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 9;}
              if (this.support == 'jet 520 M1') {cena += 12;}
              if (this.support == '100% écologique M1') {cena += 20;}
              if (this.support == 'capotoile') {cena += 20*1.3;}

              hauteur = 200;
              largeur = 150;
              ref = '20170113';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }
            //-----------------------------------------------------------------200x200
            if ((this.produit == 'lux-line') && (this.dimensions == '200x200')){
              if (this.qte<7) {cena=219;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=218;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=217;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=216;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=215;}
              if (this.qte>=217 ) {cena=214;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == 'jet 520 M1') {cena += 40;}

              hauteur = 200;
              largeur = 200;
              ref = '20170114';
              designation=this.dimensions;
              details='<br />- '+ this.support;

            }

            // fin lux-line //////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////// double //

            //------------------------------------------------------------------80x200
            if ((this.produit == 'double') && (this.dimensions == '80x200')){
              if (this.qte<7) {cena=90;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=89;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=88;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=87;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=85;}
              if (this.qte>=217 ) {cena=83;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 6;}
              if (this.support == 'jet 520 M1') {cena += 8;}
              if (this.support == '100% écologique M1') {cena += 20;}
              if (this.support == 'capotoile') {cena += 20*1.3;}

              hauteur = 200;
              largeur = 80;
              ref = '20170120';
              designation=this.dimensions;
              details='<br />- '+ this.support;
              opis += '<br />- recto-verso';

            }
            //------------------------------------------------------------------85x200
            if ((this.produit == 'double') && (this.dimensions == '85x200')){
              if (this.qte<7) {cena=104;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=103;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=101;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=100;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=99;}
              if (this.qte>=217 ) {cena=97;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 10;}
              if (this.support == 'jet 520 M1') {cena += 12;}
              if (this.support == '100% écologique M1') {cena += 22;}
              if (this.support == 'capotoile') {cena += 22*1.3;}

              hauteur = 200;
              largeur = 85;
              ref = '20170120';
              designation=this.dimensions;
              details='<br />- '+ this.support;
              opis += '<br />- recto-verso';

            }
            //-----------------------------------------------------------------100x200
            if ((this.produit == 'double') && (this.dimensions == '100x200')){
              if (this.qte<7) {cena=135;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=134;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=133;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=132;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=130;}
              if (this.qte>=217 ) {cena=129;}
              if (this.support == '440g') {cena += 0;}
              if (this.support == '300µ M1') {cena += 12;}
              if (this.support == 'jet 520 M1') {cena += 15;}
              if (this.support == '100% écologique M1') {cena += 28;}
              if (this.support == 'capotoile') {cena += 28*1.3;}

              hauteur = 200;
              largeur = 100;
              ref = '20170121';
              designation=this.dimensions;
              details='<br />- '+ this.support;
              opis += '<br />- recto-verso';

            }

            // fin double ////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////// mini //

            if (this.dimensions == 'A4'){
              hauteur = 29.7;
              largeur = 21;
              ref = '20170115';
              cena=24;
              designation=this.dimensions;
            }
            if (this.dimensions == 'A3'){
              hauteur = 42;
              largeur = 29.7;
              ref = '20170116';
              cena=29;
              designation=this.dimensions;
            }

            // fin mini //////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////// changement de visuel //


            //------------------------------------------------------------------60x160
            if ((this.produit == 'Changement visuel') && (this.dimensions == '60x160')) {
              opis += '<br />- 60x160cm + 10cm (marge technique)';
              if (this.qte<2) {cena=8.52;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=8.43;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=8.35;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=8.18;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=7.75;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=7.50;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=7.16;}
              if (this.qte>=217 ) {cena=6.90;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 160;
              largeur = 60;
              ref = '20170190';
            }
            //------------------------------------------------------------------60x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '60x200')) {
              opis += '<br />- 60x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=11.13;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=10.91;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=10.80;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=10.57;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=10.13;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=9.68;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=9.24;}
              if (this.qte>=217 ) {cena=8.90;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 60;
              ref = '20170191';
            }


            //------------------------------------------------------------------80x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '80x200')) {
              opis += '<br />- 80x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=11.35;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=11.24;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=11.01;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=10.78;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=10.22;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=9.76;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=9.42;}
              if (this.qte>=217 ) {cena=9.08;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 80;
              ref = '20170192';
            }
            //------------------------------------------------------------------85x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '85x200')) {
              opis += '<br />- 85x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=15.61;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=15.29;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=15.14;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=14.82;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=14.03;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=13.24;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=12.93;}
              if (this.qte>=217 ) {cena=12.46;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 85;
              ref = '20170193';
            }
            //------------------------------------------------------------------100x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '100x200')) {
              opis += '<br />- 100x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=16.22;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=15.89;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=15.73;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=15.40;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=14.42;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=13.76;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=13.27;}
              if (this.qte>=217 ) {cena=12.78;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 100;
              ref = '20170194';
            }

            //------------------------------------------------------------------120x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '120x200')) {
              opis += '<br />- 120x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=22.04;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=21.37;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=21.15;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=20.70;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=19.37;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=18.48;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=17.81;}
              if (this.qte>=217 ) {cena=17.36;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 120;
              ref = '20170195';
            }

            //------------------------------------------------------------------150x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '150x200')) {
              opis += '<br />- 150x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=23.59;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=22.64;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=22.40;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=21.92;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=20.49;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=19.78;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=19.06;}
              if (this.qte>=217 ) {cena=18.59;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1') {cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 150;
              ref = '20170196';
            }
            //------------------------------------------------------------------200x200
            if ((this.produit == 'Changement visuel') && (this.dimensions == '200x200')) {
              opis += '<br />- 200x200cm + 10cm (marge technique)';
              if (this.qte<2) {cena=30.62;}
              if ((this.qte>=2) && (this.qte<=3)) {cena=29.68;}
              if ((this.qte>=4) && (this.qte<=6)) {cena=29.37;}
              if ((this.qte>=7) && (this.qte<=24)) {cena=28.48;}
              if ((this.qte>=25) && (this.qte<=48)) {cena=26.24;}
              if ((this.qte>=49) && (this.qte<=108)) {cena=25.62;}
              if ((this.qte>=109) && (this.qte<=216)) {cena=24.68;}
              if (this.qte>=217 ) {cena=24.37;}
              if (this.support == '440g') {cena += 0; opis += '<br />- 440gr';}
              if (this.support == 'jet 520 M1'){cena *= 2.45; opis += '<br />- jet 520 M1';}
              if (this.support == '100% écologique M1') {cena *= 2.9; opis += '<br />- 100% écologique M1';}
              if (this.support == 'capotoile') {cena *= 3.86; opis += '<br />- capotoile';}

              hauteur = 200;
              largeur = 200;
              ref = '20170197';
            }

            //Fin changement de visuel //////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////// mistral //

            if (this.produit == 'Mistral'){
              // Laise mistral //
              largeur=0.8; hauteur=2;
              metraz = largeur * hauteur;
              metraz = fixstr(metraz);
              metrazzaokraglony1 = (largeur+hauteur)*2;
              metrazzaokraglony = Math.round(metrazzaokraglony1);

              if (largeur <= 0.50){l1=0.5; l2=0.5-largeur; perteL=l2*hauteur;}
              if ((largeur >= 0.51) && (largeur <= 0.80)){l1=0.80; l2=0.80-largeur; perteL=l2*hauteur;}
              if ((largeur >= 0.81) && (largeur <= 1.10)){l1=1.10; l2=1.10-largeur; perteL=l2*hauteur;}
              if ((largeur >= 1.11) && (largeur <= 1.37)){l1=1.37; l2=1.37-largeur; perteL=l2*hauteur;}
              if ((largeur >= 1.38) && (largeur <= 1.60)){l1=1.60; l2=1.60-largeur; perteL=l2*hauteur;}
              if ((largeur >= 1.61) && (largeur <= 2)){l1=2; l2=2-largeur; perteL=l2*hauteur;}
              if (largeur >= 2.01){l1=largeur; perteL=largeur*hauteur;}

              if (hauteur <= 0.50){h1=0.5; h2=0.5-hauteur; perteH=h2*largeur;}
              if ((hauteur >= 0.51) && (hauteur <= 0.80)){h1=0.80; h2=0.80-hauteur; perteH=h2*largeur;}
              if ((hauteur >= 0.81) && (hauteur <= 1.10)){h1=1.10; h2=1.10-hauteur; perteH=h2*largeur;}
              if ((hauteur >= 1.11) && (hauteur <= 1.37)){h1=1.37; h2=1.37-hauteur; perteH=h2*largeur;}
              if ((hauteur >= 1.38) && (hauteur <= 1.60)){h1=1.60; h2=1.60-hauteur; perteH=h2*largeur;}
              if ((hauteur >= 1.61) && (hauteur <= 2)){h1=2; h2=2-hauteur; perteH=h2*largeur;}
              if (hauteur >= 2.01){h1=hauteur; perteH=hauteur*largeur;}

              if (perteH < perteL){metrage = largeur*h1;}
              else if (perteH > perteL){metrage = hauteur*l1;}
              else if(perteH == perteL){metrage = hauteur*l1;}

              metragefinal=metrage*this.qte;

              if (metragefinal < 1.99) {cenatotal = metragefinal*15.00;}
              if ((metragefinal > 1.99) && (metragefinal <= 3.99)) {cenatotal = metragefinal*14.80;}
              if ( (metragefinal > 3.99) && (metragefinal <= 5.99) ) {cenatotal = metragefinal*14.60;}
              if ( (metragefinal > 5.99) && (metragefinal <= 7.99) ) {cenatotal = metragefinal*14.40;}
              if ( (metragefinal > 7.99) && (metragefinal <= 9.99) ) {cenatotal = metragefinal*14.20;}
              if ( (metragefinal > 9.99) && (metragefinal <= 13.99) ) {cenatotal = metragefinal*14.00;}
              if ( (metragefinal > 13.99) && (metragefinal <= 17.99) ) {cenatotal = metragefinal*13.50;}
              if ( (metragefinal > 17.99) && (metragefinal <= 23.99) ) {cenatotal = metragefinal*13.25;}
              if ( (metragefinal > 23.99) && (metragefinal <= 29.99) ) {cenatotal = metragefinal*13.00;}
              if ( (metragefinal > 29.99) && (metragefinal <= 39.99) ) {cenatotal = metragefinal*12.75;}
              if ( (metragefinal > 39.99) && (metragefinal <= 49.99) ) {cenatotal = metragefinal*12.50;}
              if ( (metragefinal > 49.99) && (metragefinal <= 59.99) ) {cenatotal = metragefinal*12.25;}
              if ( (metragefinal > 59.99) && (metragefinal <= 69.99) ) {cenatotal = metragefinal*12.00;}
              if ( (metragefinal > 69.99) && (metragefinal <= 79.99) ) {cenatotal = metragefinal*11.75;}
              if ( (metragefinal > 79.99) && (metragefinal <= 89.99) ) {cenatotal = metragefinal*11.50;}
              if ( (metragefinal > 89.99) && (metragefinal <= 99.99) ) {cenatotal = metragefinal*11.25;}
              if ( (metragefinal > 99.99) && (metragefinal <= 149.99) ) {cenatotal = metragefinal*11;}
              if ( (metragefinal > 149.99) && (metragefinal <= 199.99) ) {cenatotal = metragefinal*10.50;}
              if ( (metragefinal > 199.99) && (metragefinal <= 249.99) ) {cenatotal = metragefinal*10.00;}
              if ( (metragefinal > 249.99) && (metragefinal <= 299.99) ) {cenatotal = metragefinal*9.50;}
              if ( (metragefinal > 299.99) && (metragefinal <= 399.99) ) {cenatotal = metragefinal*9.00;}
              if ( (metragefinal > 399.99) && (metragefinal <= 499.99) ) {cenatotal = metragefinal*8.50;}
              if (metragefinal > 499.99) {cenatotal = metragefinal*8.00;}
              p1=(metraz*0.55)*this.qte;

              if (this.dimensions == '80x200 1 visuel') {
                structure=86.4*1.8;
                cena=structure+(cenatotal/this.qte);
                designation='80x200 <br />- 1 visuel';
                p2=3*this.qte;
              }

              if (this.dimensions == '80x200 2 visuels') {
                structure=86.4*1.8;
                cena=structure+((cenatotal*1.5)/this.qte);
                designation='80x200 <br />- 2 visuels recto-verso';
                p2=3*this.qte;
              }

              hauteur = 200;
              largeur = 80;
              ref = '20170122';

              // poids mistral //
              poids=(p1+p2);
              if (poids <= 1) {cena+=(4.80*1.5)/this.qte;}
              if ((poids > 1) && (poids <= 2)) {cena+=(5.1*1.5)/this.qte;}
              if ((poids > 2) && (poids <= 3)) {cena+=(5.67*1.5)/this.qte;}
              if ((poids > 3) && (poids <= 4)) {cena+=(5.63*1.5)/this.qte;}
              if ((poids > 4) && (poids <= 5)) {cena+=(6.88*1.5)/this.qte;}
              if ((poids > 5) && (poids <= 6)) {cena+=(7.99*1.5)/this.qte;}
              if ((poids > 6) && (poids <= 7)) {cena+=(7.99*1.5)/this.qte;}
              if ((poids > 7) && (poids <= 10)) {cena+=(9.30*1.5)/this.qte;}
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
              if (poids > 100) {cena+=(69.26*1.2)/this.qte;}
            }

            // fin mistral ///////////////////////////////////////////////////////////

            ////////////////////////////////////////////////////////////// maquette //
            var maquette;
            if (this.maquette == 'fb') {
              cena+=19/this.qte;
              maquette = 'France banderole crée la mise en page';
            }
            if (this.maquette == 'user') {
              cena+=5/this.qte;
              maquette = 'BAT en ligne';
            }
            if (this.maquette == 'config') {
              cena+=5/this.qte;
              maquette = 'je crée ma maquette en ligne';
            }
            if (this.maquette == 'sansbat') {
              maquette = 'je ne souhaite pas de BAT';
            }
            ///////////////////////////////////////////////////////////// signature //
            if (this.sign == 'signature FB') {
              opis += '<br />- signature France Banderole';
            }
            if (this.sign == 'sans signature') {
              if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRS') ) {cena+= this.$global.opSIGN;}
              opis += '<br />- sans signature';
            }

            // --------------------------------------------------------- options
            var etiqdesc = '';

            if (this.colis) {
              if ( !document.getElementById('revendeur') && !document.getElementById('revendeurRC') ) {cena+= 2;}
              optliv += '<br />- colis revendeur';
            }

            if (this.atelier == true) {
              etiqdesc = '<br />- retrait colis atelier';
              cena-= cena*3/100;
            }
            if (this.relais == true) {
              cena += 5.00/this.qte;
              optliv += '<br />- relais colis';
            }

            // --------------------------------------------------- total produit
            prixunite = cena;
            cena = prixunite*this.qte;
            prixunite = fixstr(prixunite);
            cena2 = prixunite.replace(".", ",");

            // --------------------------- calcul du prix en fonction des délais

            if(this.delaiprod && this.delailiv) {
              // Calculate price
              //alert('click');
              var ProdPercent = '';
              var DeliPercent = '';

              if(this.delaiprod == '2-3' ){
                ProdPercent = 20;
                prliv += '<br />- P 2-3J';
              }else if(this.delaiprod =='1-1'){
                ProdPercent = 45;
                prliv += '<br />- P 1J';
              }else{
                ProdPercent = 0;
                prliv += '<br />- P 4-5J';
              }

              if(this.delailiv == '2-3'){
                DeliPercent = 20;
                prliv += ' / L 2-3J';
              }else if(this.delailiv =='1-1'){
                DeliPercent = 45;
                prliv += ' / L 1J';
              }else{
                DeliPercent = 0;
                prliv += ' / L 3-4J';
              }

              var price_unit           = parseFloat(prixunite);
              var totalPercente        = parseInt(DeliPercent) + parseInt(ProdPercent);
              var calculatedTotalPrice = (price_unit) * (totalPercente)/100;

              finalPrice  = calculatedTotalPrice + price_unit;
              finalPrice1 = fixstr(finalPrice);
              finalPrice2 = finalPrice1.replace(".", ",");

              this.prixUnit = finalPrice2 +' €' ;
            }

            ////////////////////////////////////////////////////// prix avec délais //
            prixunite = finalPrice1;
            cena = prixunite*this.qte;
            prixunite = fixstr(prixunite);
            transport = 0;
            cena2 = prixunite.replace(".", ",");
            //////////////////////////////////////////////////////////////////////////

            var erreurType = 0;

            if (erreurType==1) {
              this.prixUnit = '-';
              this.prixOption =  '-';
              this.prixTotal = '-';
            }

            // affichage image livraison le jour même
            if ((this.delailiv == '1-1') && (this.delaiprod == '1-1'))  this.livraisonrapide = true;
            else this.livraisonrapide = false;

            // si pas d'erreur, calculer forfait si total < 14.9 et ajouter les données au panier
            if ((erreurType==0) && ((this.delailiv == '2-3') || (this.delailiv == '1-1') || (this.delailiv == '3-4'))){
              suma=cena-rabat;
              suma=fixstr(suma);
              suma2 = suma.replace(".", ",");
              this.prixTotal = suma2  +' €' ;

              var niepokazuj = 0;
              var newoption;
              var newoption2;
              var forfait;

              if ( suma < 14.90 ) {
                forfait = 14.90 - suma;
                forfait = fixstr(forfait);
                this.forfait = 'FORFAIT '+forfait+' € - ';

                if (option > 0) {
                  newoption = parseFloat(option) + parseFloat(forfait);
                  newoption = fixstr(newoption);
                  newoption2 = newoption.replace(".", ",");
                  option2 = newoption2;

                  this.prixOption = newoption2;

                  suma = 14.90;
                  suma=fixstr(suma);
                  suma2 = suma.replace(".", ",");

                  this.prixTotal = suma2 +' €' ;

                } else {
                  newoption = parseFloat(forfait);
                  newoption = fixstr(newoption);
                  newoption2 = newoption.replace(".", ",");
                  option2 = newoption2;

                  this.prixOption = newoption2;

                  suma = 14.90;
                  suma = fixstr(suma);
                  suma2 = suma.replace(".", ",");

                  this.prixTotal = suma2 +' €' ;
                }
              }

              // création de l'image produit et insertion dans le panier
              var cartData = document.getElementById("cart_form");
              var base64;
              //$('#preview .arrow').hide();

              if(!document.documentMode){ // ne pas charger ce script sous IE
                domtoimage.toBlob(document.getElementById('preview')).then(function (blob) {
                  saveBlobAsFile(blob, "XX.png").then(function (data) {
                    base64 = data;
                    sendData(cartData, base64);
                  });
                });
              }

              // envoi des données au panier
              this.cartData = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Roll-up" /><input type="hidden" name="opis" value="- '+this.produit+' '+designation+details+'<br />- '+maquette+opis+optliv+etiqdesc+prliv+'" /><input type="hidden" name="this.qte" value="'+this.qte+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><input type="hidden" name="hauteur" value="'+hauteur+'" /><input type="hidden" name="largeur" value="'+largeur+'" /><input type="hidden" name="reference" value="'+ref+'" /><button id="submit_cart" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> ajouter au panier</button>';
              this.livraisonComp = true;
            }

      }
    },



});
