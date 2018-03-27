JKakemono = {

// -------------------cache le prix lorsqu'on modifie un champ dans page produit
czyscpola: function() {

	jQuery('#prix_unitaire').html('-');
	jQuery('#option').html('-');
	jQuery('#remise').html('-');
	jQuery('#total').html('-');
	jQuery('#submit_cart').css('display', 'none');
	jQuery('#livraisonComp').css('display', 'none');
	//jQuery('#delivery-div').css('display', 'none');

},
//------------------------------------------------------------------------------
rushcheckbox24: function() {
	document.getElementById("prix_unitaire").innerHTML='-';
	document.getElementById("option").innerHTML='-';
	document.getElementById("remise").innerHTML='-';
	document.getElementById("total").innerHTML='-';
	var przycisk = document.getElementById("submit_cart");
	if (przycisk) {
		przycisk.style.visibility = "hidden";
	}

	var rush24 = $$('#rush24').collect(function(e){
		return e.checked;
	}).any();
	if (rush24) {
    JKakemono.changeThis("fedex", false);
		document.getElementById("fedex").checked = false;
		document.getElementById("tnt").checked = true;
		if (document.getElementById("rush72")) {document.getElementById("rush72").checked = false;}
		if (document.getElementById("economique")) {document.getElementById("economique").checked = false;}
		if (document.getElementById("ducro")) {document.getElementById("ducro").checked = false;}
	}
},
//------------------------------------------------------------------------------
rushcheckbox24p: function() {
	document.getElementById("prix_unitaire").innerHTML='-';
	document.getElementById("option").innerHTML='-';
	document.getElementById("remise").innerHTML='-';
	document.getElementById("total").innerHTML='-';
	var przycisk = document.getElementById("submit_cart");
	if (przycisk) {
		przycisk.style.visibility = "hidden";
	}

	var rush24p = $$('#rush24p').collect(function(e){
		return e.checked;
	}).any();
	if (rush24p) {
		JKakemono.changeThis("fedex", false);
		document.getElementById("fedex").checked = false;
		document.getElementById("tnt").checked = true;
		document.getElementById("economique").checked = false;
	}
},
//------------------------------------------------------------------------------
rushcheckbox72: function() {
	document.getElementById("prix_unitaire").innerHTML='-';
	document.getElementById("option").innerHTML='-';
	document.getElementById("remise").innerHTML='-';
	document.getElementById("total").innerHTML='-';
	var przycisk = document.getElementById("submit_cart");
	if (przycisk) {
		przycisk.style.visibility = "hidden";
	}

	var rush72 = $$('#rush72').collect(function(e){
		return e.checked;
	}).any();
	if (rush72) {
        JKakemono.changeThis("fedex", false);
		document.getElementById("fedex").checked = false;
		document.getElementById("tnt").checked = true;
		document.getElementById("rush24").checked = false;
		document.getElementById("ducro").checked = false;
	}
},
//------------------------------------------------------------------------------
rushcheckboxducro: function() {
	var ducro = $$('#ducro').collect(function(e){ return e.checked; }).any();

	if (ducro) {
		document.getElementById("rush24").checked = false;
		document.getElementById("rush72").checked = false;
	}
	},
	rushcheckboxeconomique: function() {
	var economique = $$('#economique').collect(function(e){
		return e.checked;
	}).any();
	if (economique) {
		if(document.getElementById("rush24p")) document.getElementById("rush24p").checked = false;
		if(document.getElementById("rush24")) document.getElementById("rush24").checked = false;
	}
},
//------------------------------------------------------------------------------
fedexcheckbox: function () {
    if (document.getElementById("fedex").checked == true) {
        /*JKakemono.changeThis("rush24p", false);
        JKakemono.changeThis("rush24", false);
        JKakemono.changeThis("rush72", false);
        JKakemono.changeThis("relais", false);
        JKakemono.changeThis("colis", false);*/
	document.getElementById("rush24p").checked = false;
	document.getElementById("rush24").checked = false;
	document.getElementById("rush72").checked = false;
	document.getElementById("relais").checked = false;
	/*document.getElementById("colis").checked = false;*/
	document.getElementById("etiquette").checked = false;
    }else{document.getElementById("fedex").checked = true;}
},
//------------------------------------------------------------------------------
relaisColischeckbox: function() {
    if (document.getElementById("relais").checked == true & document.getElementById("fedex").checked == true) {
	document.getElementById("fedex").checked = false;
	document.getElementById("tnt").checked = true;
}
//------------------------------------------------------------------------------
},
colisRevendeurcheckbox: function() {
    /*if (document.getElementById("fedex").checked == true) {
        document.getElementById("fedex").checked = false;
	document.getElementById("tnt").checked = true;
    }*/
},
//------------------------------------------------------------------------------
changeThis: function(who, value) {
    if (document.getElementById(who)) {
        document.getElementById(who).checked = value;    }
},
//------------------------------------------------------------------------------
//////CADRE/////
cal_cadre: function(){

},
//////FIN CADRE/////

//////FLYER/////
cal_flyers: function(){

},
//////FIN FLYER/////

//////DEPLIANT/////
cal_depliants: function(){

},
//////FIN DEPLIANT/////

//////AFFICHES/////
cal_affiches: function(){

},
//////FIN AFFICHE/////

//////CARTES/////
cal_cartes: function(){

},
//////FIN CARTES/////

//////ECLAIRAGE/////
cal_eclairage: function(){

},
//////FIN ECLAIRAGE/////

//////DEBUT BANDEROLE/////
cal_banderoles: function(){

},
//////FIN BANDEROLE/////

//////STICKERS/////
cal_stickers: function(){

},
//////FIN STICKERS/////
//////STICKERS-predecoupé/////
cal_sticker_predecoupe: function(){

},
//////FIN STICKERS-predecoupé/////

//////STICKERS lettrage-predecoupé/////
cal_sticker_lettrage_predecoupe: function(){

},
//////FIN STICKERS lettrage-predecoupé/////


//////AUTOCOLLANT/////
cal_autocollant: function(){

},
//////FIN AUTOCOLLANT/////
cal_enseigne_suspendue: function(){
},

//////vitrophanie/////
cal_vitrophanie: function(){

},
//////FIN vitrophanie/////
cal_oriflamme: function(){

},
//////ORIFLAMME/////

//////FIN ORIFLAMME/////

//////PARAPLUIE/////
cal_parapluie: function(){


},
//////FIN PARAPLUIE/////

//////KAKEMONO/////
cal_kakemono: function(){

},
//////FIN KAKEMONO/////

//////contruction/////
cal_construction: function(){

},
//////FIN construction/////


//////totem/////
cal_totem: function(){

},
//////FIN totem/////

//////rollup/////
cal_rollup: function(){

},
//////FIN rollup/////

///////DEBUT AKILUX 3mm///////////////

cal_akilux3mm: function(){

},

///////FIN AKILUX 3mm///////////////


///////DEBUT AKILUX 3,5mm///////////////

cal_akilux3_5mm: function(){

},

///////FIN AKILUX 3,5mm///////////////

///////DEBUT AKILUX 5mm///////////////

cal_akilux5mm: function(){

},

///////FIN AKILUX 5mm///////////////


///////DEBUT PVC 300µ///////////////

cal_PVC300microns: function(){

},
///////FIN PVC 300µ///////////////

///////DEBUT FOREX 1MM///////////////

cal_forex1mm: function(){

},

///////FIN FOREX 1MM///////////////


///////DEBUT FOREX 3MM///////////////

cal_forex3mm: function(){
},

///////FIN FOREX 3MM///////////////



///////DEBUT FOREX 5MM///////////////

cal_forex5mm: function(){

},

///////FIN FOREX 5MM///////////////


///////DEBUT Dibond///////////////

cal_dibond: function(){

},

///////FIN Dibond///////////////

///////DEBUT tente///////////////

cal_tente_exposition: function(){

},

cal_nappe: function(){

},

};
