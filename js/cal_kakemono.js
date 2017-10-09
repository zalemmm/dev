JKakemono = {
czyscpola: function() {
	document.getElementById("prix_unitaire").innerHTML='-';
	document.getElementById("option").innerHTML='-';
	document.getElementById("remise").innerHTML='-';
	document.getElementById("total").innerHTML='-';
	var przycisk = document.getElementById("submit_cart");
	if (przycisk) {
		przycisk.style.visibility = "hidden";
	}

    /*if (document.getElementById("tnt").checked == false) {
        document.getElementById("fedex").checked = true;
    }*/

	jQuery('#etiquette').click(function() {
		if (document.getElementById('etiquette').checked) {
			document.getElementById('fedex').checked = false;
			document.getElementById('tnt').checked = false;
		}
	});

},
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
    relaisColischeckbox: function() {
        if (document.getElementById("relais").checked == true & document.getElementById("fedex").checked == true) {
			document.getElementById("fedex").checked = false;
			document.getElementById("tnt").checked = true;
		}

    },
    colisRevendeurcheckbox: function() {
        /*if (document.getElementById("fedex").checked == true) {
            document.getElementById("fedex").checked = false;
			document.getElementById("tnt").checked = true;
        }*/
    },
    changeThis: function(who, value) {
        if (document.getElementById(who)) {
            document.getElementById(who).checked = value;
        }
    },

//////CADRE/////
cal_cadre: function(){
var cena=0;
var prixunitaire=0;
var banderole=0;
var fixation=0;
var prixcadre=0;
var prixcouleur=0;
var couleur=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';
var niepokazuj = 0;
var option2=0;
var eBox = document.getElementById('form-button-error2-cadre');
eBox.innerHTML='';
if (($('input_01').value == 'Flexy-Tens') || ($('input_01').value == 'IX-Tens')){
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x200cm')) {
		if (ilosc == '1') {prixcadre=246;}
		if (1<ilosc<4) {prixcadre=246;}
		if (3<ilosc<6) {prixcadre=246;}
		if (5<ilosc<8) {prixcadre=246;}
		if (7<ilosc<10) {prixcadre=246;}
		if (9<ilosc<21) {prixcadre=246;}
		if (20<ilosc<51) {prixcadre=246;}
		if (50<ilosc<101) {prixcadre=246;}
		transport=72;
		opis += '<br />- Flexy\'Tens<br />- 60x200cm';
	}

	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x250cm')) {
		prixcadre=300;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 60x250cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x300cm')) {
		prixcadre=326;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 60x300cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x350cm')) {
		prixcadre=366;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 60x350cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x400cm')) {
		prixcadre=424;
		transport=98;
		opis += '<br />- Flexy\'Tens<br />- 60x400cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x450cm')) {
		prixcadre=450;
		transport=104;
		opis += '<br />- Flexy\'Tens<br />- 60x450cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '60x500cm')) {
		prixcadre=476;
		transport=104;
		opis += '<br />- Flexy\'Tens<br />- 60x500cm';
	}


	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x200cm')) {
		prixcadre=254;
		transport=72;
		opis += '<br />- Flexy\'Tens<br />- 80x200cm';
	}if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x250cm')) {
		prixcadre=316;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 80x250cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x300cm')) {
		prixcadre=342;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 80x300cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x350cm')) {
		prixcadre=381;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 80x350cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x400cm')) {
		prixcadre=442;
		transport=104;
		opis += '<br />- Flexy\'Tens<br />- 80x400cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x450cm')) {
		prixcadre=468;
		transport=111;
		opis += '<br />- Flexy\'Tens<br />- 80x450cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '80x500cm')) {
		prixcadre=494;
		transport=111;
		opis += '<br />- Flexy\'Tens<br />- 80x500cm';
	}


	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x200cm')) {
		prixcadre=267;
		transport=72;
		opis += '<br />- Flexy\'Tens<br />- 100x200cm';
	}if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x250cm')) {
		prixcadre=331;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 100x250cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x300cm')) {
		prixcadre=357;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 100x300cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x350cm')) {
		prixcadre=397;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 100x350cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x400cm')) {
		prixcadre=461;
		transport=104;
		opis += '<br />- Flexy\'Tens<br />- 100x400cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x450cm')) {
		prixcadre=487;
		transport=111;
		opis += '<br />- Flexy\'Tens<br />- 100x450cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '100x500cm')) {
		prixcadre=513;
		transport=117;
		opis += '<br />- Flexy\'Tens<br />- 100x500cm';
	}


	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x200cm')) {
		prixcadre=267;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 120x200cm';
	}if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x250cm')) {
		prixcadre=331;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 120x250cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x300cm')) {
		prixcadre=357;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 120x300cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x350cm')) {
		prixcadre=397;
		transport=91;
		opis += '<br />- Flexy\'Tens<br />- 120x350cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x400cm')) {
		prixcadre=461;
		transport=111;
		opis += '<br />- Flexy\'Tens<br />- 120x400cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x450cm')) {
		prixcadre=487;
		transport=117;
		opis += '<br />- Flexy\'Tens<br />- 120x450cm';
	}
	if (($('input_01').value == 'Flexy-Tens') && ($('input_120').value == '120x500cm')) {
		prixcadre=513;
		transport=117;
		opis += '<br />- Flexy\'Tens<br />- 120x500cm';
	}

////IX tens///
	if (($('input_01').value == 'IX-Tens') &&  ($('input_111').value == '60cm de hauteur')) {
		ilosc = $('input_4').value;
		if ($('input_4').value == '1') {prixcadre=768;}
		if (($('input_4').value > 1) && ($('input_4').value < 4)){prixcadre=720;}
		if (($('input_4').value > 3) && ($('input_4').value < 6)){prixcadre=696;}
		if (($('input_4').value > 5) && ($('input_4').value < 8)){prixcadre=672;}
		if (($('input_4').value > 7) && ($('input_4').value < 10)){prixcadre=648;}
		if (($('input_4').value > 9) && ($('input_4').value < 21)){prixcadre=560;}
		if (($('input_4').value > 20) && ($('input_4').value < 51)){prixcadre=532;}
		if (($('input_4').value > 50) && ($('input_4').value < 101)){prixcadre=513;}

		transport=72;
		opis += '<br />- IX\'Tens<br />- 60cm de hauteur';
	}

	if (($('input_01').value == 'IX-Tens') &&  ($('input_111').value == '80cm de hauteur')) {
		ilosc = $('input_4').value;
		if ($('input_4').value == '1') {prixcadre=816;}
		if (($('input_4').value > 1) && ($('input_4').value < 4)){prixcadre=768;}
		if (($('input_4').value > 3) && ($('input_4').value < 6)){prixcadre=720;}
		if (($('input_4').value > 5) && ($('input_4').value < 8)){prixcadre=696;}
		if (($('input_4').value > 7) && ($('input_4').value < 10)){prixcadre=672;}
		if (($('input_4').value > 9) && ($('input_4').value < 21)){prixcadre=580;}
		if (($('input_4').value > 20) && ($('input_4').value < 51)){prixcadre=551;}
		if (($('input_4').value > 50) && ($('input_4').value < 101)){prixcadre=532;}

		transport=72;
		opis += '<br />- IX\'Tens<br />- 80cm de hauteur';
	}

	if (($('input_01').value == 'IX-Tens') && ($('input_111').value == '100cm de hauteur')) {
		ilosc = $('input_4').value;
		if ($('input_4').value == '1') {prixcadre=896;}
		if (($('input_4').value > 1) && ($('input_4').value < 4)){prixcadre=879;}
		if (($('input_4').value > 3) && ($('input_4').value < 6)){prixcadre=840;}
		if (($('input_4').value > 5) && ($('input_4').value < 8)){prixcadre=812;}
		if (($('input_4').value > 7) && ($('input_4').value < 10)){prixcadre=784;}
		if (($('input_4').value > 9) && ($('input_4').value < 21)){prixcadre=681.50;}
		if (($('input_4').value > 20) && ($('input_4').value < 51)){prixcadre=652.50;}
		if (($('input_4').value > 50) && ($('input_4').value < 101)){prixcadre=630;}

		transport=72;
		opis += '<br />- IX\'Tens<br />- 100cm de hauteur';
	}

	if (($('input_01').value == 'IX-Tens') &&  ($('input_111').value == '120cm de hauteur')) {
		ilosc = $('input_4').value;
		if ($('input_4').value == '1') {prixcadre=952;}
		if (($('input_4').value > 1) && ($('input_4').value < 4)){prixcadre=896;}
		if (($('input_4').value > 3) && ($('input_4').value < 6)){prixcadre=840;}
		if (($('input_4').value > 5) && ($('input_4').value < 8)){prixcadre=812;}
		if (($('input_4').value > 7) && ($('input_4').value < 10)){prixcadre=784;}
		if (($('input_4').value > 9) && ($('input_4').value < 21)){prixcadre=681.50;}
		if (($('input_4').value > 20) && ($('input_4').value < 51)){prixcadre=652.50;}
		if (($('input_4').value > 50) && ($('input_4').value < 101)){prixcadre=630;}

		transport=91;
		opis += '<br />- IX\'Tens<br />- 120cm de hauteur';
	}

	if (($('input_01').value == 'IX-Tens') && ($('input_111').value == '140cm de hauteur')) {
		ilosc = $('input_4').value;
		if ($('input_4').value == '1') {prixcadre=1008;}
		if (($('input_4').value > 1) && ($('input_4').value < 4)){prixcadre=993.60;}
		if (($('input_4').value > 3) && ($('input_4').value < 6)){prixcadre=972;}
		if (($('input_4').value > 5) && ($('input_4').value < 8)){prixcadre=957.60;}
		if (($('input_4').value > 7) && ($('input_4').value < 10)){prixcadre=936;}
		if (($('input_4').value > 9) && ($('input_4').value < 21)){prixcadre=850.50;}
		if (($('input_4').value > 20) && ($('input_4').value < 51)){prixcadre=823.50;}
		if (($('input_4').value > 50) && ($('input_4').value < 101)){prixcadre=762.50;}

		transport=91;
		opis += '<br />- IX\'Tens<br />- 140cm de hauteur';
	}

	if (($('input_01').value == 'IX-Tens') && ($('input_111').value == '160cm de hauteur')) {
		ilosc = $('input_4').value;
		if ($('input_4').value == '1') {prixcadre=1080;}
		if (($('input_4').value > 1) && ($('input_4').value < 4)){prixcadre=1044;}
		if (($('input_4').value > 3) && ($('input_4').value < 6)){prixcadre=1029.60;}
		if (($('input_4').value > 5) && ($('input_4').value < 8)){prixcadre=1008;}
		if (($('input_4').value > 7) && ($('input_4').value < 10)){prixcadre=972;}
		if (($('input_4').value > 9) && ($('input_4').value < 21)){prixcadre=850.50;}
		if (($('input_4').value > 20) && ($('input_4').value < 51)){prixcadre=823.50;}
		if (($('input_4').value > 50) && ($('input_4').value < 101)){prixcadre=793;}

		transport=91;
		opis += '<br />- IX\'Tens<br />- 160cm de hauteur';
	}

////banderole IX'tens///

	if ($('input_21b').value == '60cm x 100cm'){
		banderole=20;
		opis += '<br />- Banderole 60x100cm';
	}
	if ($('input_21b').value == '60cm x 200cm'){
		banderole=36;
		opis += '<br />- Banderole 60x200cm';
	}
	if ($('input_21b').value == '60cm x 300cm'){
		banderole=51;
		opis += '<br />- Banderole 60x300cm';
	}
	if ($('input_21b').value == '60cm x 400cm'){
		banderole=66;
		opis += '<br />- Banderole 60x400cm';
	}
	if ($('input_21b').value == '60cm x 500cm'){
		banderole=81;
		opis += '<br />- Banderole 60x500cm';
	}
	if ($('input_21b').value == '60cm x 600cm'){
		banderole=96;
		opis += '<br />- Banderole 60x600cm';
	}


	if ($('input_22b').value == '80cm x 100cm'){
		banderole=28;
		opis += '<br />- Banderole 80x100cm';
	}
	if ($('input_22b').value == '80cm x 200cm'){
		banderole=48;
		opis += '<br />- Banderole 80x200cm';
	}
	if ($('input_22b').value == '80cm x 300cm'){
		banderole=68;
		opis += '<br />- Banderole 80x300cm';
	}
	if ($('input_22b').value == '80cm x 400cm'){
		banderole=88;
		opis += '<br />- Banderole 80x400cm';
	}
	if ($('input_22b').value == '80cm x 500cm'){
		banderole=108;
		opis += '<br />- Banderole 80x500cm';
	}
	if ($('input_22b').value == '80cm x 600cm'){
		banderole=128;
		opis += '<br />- Banderole 80x600cm';
	}


	if ($('input_23b').value == '100cm x 100cm'){
		banderole=35;
		opis += '<br />- Banderole 100x100cm';
	}
	if ($('input_23b').value == '100cm x 200cm'){
		banderole=60;
		opis += '<br />- Banderole 100x200cm';
	}
	if ($('input_23b').value == '100cm x 300cm'){
		banderole=85;
		opis += '<br />- Banderole 100x300cm';
	}
	if ($('input_23b').value == '100cm x 400cm'){
		banderole=110;
		opis += '<br />- Banderole 100x400cm';
	}
	if ($('input_23b').value == '100cm x 500cm'){
		banderole=135;
		opis += '<br />- Banderole 100x500cm';
	}
	if ($('input_23b').value == '100cm x 600cm'){
		banderole=160;
		opis += '<br />- Banderole 100x600cm';
	}


	if ($('input_24b').value == '120cm x 100cm'){
		banderole=42;
		opis += '<br />- Banderole 120x100cm';
	}
	if ($('input_24b').value == '120cm x 200cm'){
		banderole=72;
		opis += '<br />- Banderole 120x200cm';
	}
	if ($('input_24b').value == '120cm x 300cm'){
		banderole=102;
		opis += '<br />- Banderole 120x300cm';
	}
	if ($('input_24b').value == '120cm x 400cm'){
		banderole=132;
		opis += '<br />- Banderole 120x400cm';
	}
	if ($('input_24b').value == '120cm x 500cm'){
		banderole=162;
		opis += '<br />- Banderole 120x500cm';
	}
	if ($('input_24b').value == '120cm x 600cm'){
		banderole=192;
		opis += '<br />- Banderole 120x600cm';
	}


	if ($('input_25b').value == '120cm x 100cm'){
		banderole=49;
		opis += '<br />- Banderole 120x100cm';
	}
	if ($('input_25b').value == '120cm x 200cm'){
		banderole=84;
		opis += '<br />- Banderole 120x200cm';
	}
	if ($('input_25b').value == '120cm x 300cm'){
		banderole=119;
		opis += '<br />- Banderole 120x300cm';
	}
	if ($('input_25b').value == '120cm x 400cm'){
		banderole=154;
		opis += '<br />- Banderole 120x400cm';
	}
	if ($('input_25b').value == '120cm x 500cm'){
		banderole=189;
		opis += '<br />- Banderole 120x500cm';
	}
	if ($('input_25b').value == '120cm x 600cm'){
		banderole=224;
		opis += '<br />- Banderole 120x600cm';
	}

	if ($('input_26b').value == '120cm x 100cm'){
		banderole=56;
		opis += '<br />- Banderole 120x100cm';
	}
	if ($('input_26b').value == '120cm x 200cm'){
		banderole=96;
		opis += '<br />- Banderole 120x200cm';
	}
	if ($('input_26b').value == '120cm x 300cm'){
		banderole=136;
		opis += '<br />- Banderole 120x300cm';
	}
	if ($('input_26b').value == '120cm x 400cm'){
		banderole=176;
		opis += '<br />- Banderole 120x400cm';
	}
	if ($('input_26b').value == '120cm x 500cm'){
		banderole=216;
		opis += '<br />- Banderole 120x500cm';
	}
	if ($('input_26b').value == '120cm x 600cm'){
		banderole=256;
		opis += '<br />- Banderole 120x600cm';
	}





	if ($('input_21a').value == '60cm x 100cm'){
		opis += '<br />- Banderole 60x100cm';
	}
	if ($('input_21a').value == '60cm x 200cm'){
		opis += '<br />- Banderole 60x200cm';
	}
	if ($('input_21a').value == '60cm x 300cm'){
		opis += '<br />- Banderole 60x300cm';
	}
	if ($('input_21a').value == '60cm x 400cm'){
		opis += '<br />- Banderole 60x400cm';
	}
	if ($('input_21a').value == '60cm x 500cm'){
		opis += '<br />- Banderole 60x500cm';
	}
	if ($('input_21a').value == '60cm x 600cm'){
		opis += '<br />- Banderole 60x600cm';
	}


	if ($('input_22a').value == '80cm x 100cm'){
		opis += '<br />- Banderole 80x100cm';
	}
	if ($('input_22a').value == '80cm x 200cm'){
		opis += '<br />- Banderole 80x200cm';
	}
	if ($('input_22a').value == '80cm x 300cm'){
		opis += '<br />- Banderole 80x300cm';
	}
	if ($('input_22a').value == '80cm x 400cm'){
		opis += '<br />- Banderole 80x400cm';
	}
	if ($('input_22a').value == '80cm x 500cm'){
		opis += '<br />- Banderole 80x500cm';
	}
	if ($('input_22a').value == '80cm x 600cm'){
		opis += '<br />- Banderole 80x600cm';
	}


	if ($('input_23a').value == '100cm x 100cm'){
		opis += '<br />- Banderole 100x100cm';
	}
	if ($('input_23a').value == '100cm x 200cm'){
		opis += '<br />- Banderole 100x200cm';
	}
	if ($('input_23a').value == '100cm x 300cm'){
		opis += '<br />- Banderole 100x300cm';
	}
	if ($('input_23a').value == '100cm x 400cm'){
		opis += '<br />- Banderole 100x400cm';
	}
	if ($('input_23a').value == '100cm x 500cm'){
		opis += '<br />- Banderole 100x500cm';
	}
	if ($('input_23a').value == '100cm x 600cm'){
		opis += '<br />- Banderole 100x600cm';
	}


	if ($('input_24a').value == '120cm x 100cm'){
		opis += '<br />- Banderole 120x100cm';
	}
	if ($('input_24a').value == '120cm x 200cm'){
		opis += '<br />- Banderole 120x200cm';
	}
	if ($('input_24a').value == '120cm x 300cm'){
		opis += '<br />- Banderole 120x300cm';
	}
	if ($('input_24a').value == '120cm x 400cm'){
		opis += '<br />- Banderole 120x400cm';
	}
	if ($('input_24a').value == '120cm x 500cm'){
		opis += '<br />- Banderole 120x500cm';
	}
	if ($('input_24a').value == '120cm x 600cm'){
		opis += '<br />- Banderole 120x600cm';
	}


	if ($('input_25a').value == '120cm x 100cm'){
		opis += '<br />- Banderole 120x100cm';
	}
	if ($('input_25a').value == '120cm x 200cm'){
		opis += '<br />- Banderole 120x200cm';
	}
	if ($('input_25a').value == '120cm x 300cm'){
		opis += '<br />- Banderole 120x300cm';
	}
	if ($('input_25a').value == '120cm x 400cm'){
		opis += '<br />- Banderole 120x400cm';
	}
	if ($('input_25a').value == '120cm x 500cm'){
		opis += '<br />- Banderole 120x500cm';
	}
	if ($('input_25a').value == '120cm x 600cm'){
		opis += '<br />- Banderole 120x600cm';
	}

	if ($('input_26a').value == '120cm x 100cm'){
		opis += '<br />- Banderole 120x100cm';
	}
	if ($('input_26a').value == '120cm x 200cm'){
		opis += '<br />- Banderole 120x200cm';
	}
	if ($('input_26a').value == '120cm x 300cm'){
		opis += '<br />- Banderole 120x300cm';
	}
	if ($('input_26a').value == '120cm x 400cm'){
		opis += '<br />- Banderole 120x400cm';
	}
	if ($('input_26a').value == '120cm x 500cm'){
		opis += '<br />- Banderole 120x500cm';
	}
	if ($('input_26a').value == '120cm x 600cm'){
		opis += '<br />- Banderole 120x600cm';
	}



////couleur///

	if ($('input_03').value == 'structure') {opis += '<br />- Structure';}
	if ($('input_03').value == 'structure + banderole') {opis += '<br />- Structure + banderole';}
	if ($('input_03').value == 'banderole') {opis += '<br />- banderole';}



	if (($('input_31').value == 'rouge') || ($('input_33').value == 'rouge') || ($('input_34').value == 'rouge')) {
	opis += '<br />- rouge';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'jaune') || ($('input_33').value == 'jaune') || ($('input_34').value == 'jaune')) {
	opis += '<br />- jaune';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'vert') || ($('input_33').value == 'vert') || ($('input_34').value == 'vert')) {
	opis += '<br />- vert';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'orange') || ($('input_33').value == 'orange') || ($('input_34').value == 'orange')) {
	opis += '<br />- orange';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'bleu marine') || ($('input_33').value == 'bleu marine') || ($('input_34').value == 'bleu marine')) {
	opis += '<br />- bleu marine';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'bleu ciel') || ($('input_33').value == 'bleu ciel') || ($('input_34').value == 'bleu ciel')) {
	opis += '<br />- bleu ciel';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'noir') || ($('input_33').value == 'noir') || ($('input_34').value == 'noir')) {


	opis += '<br />- noir';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'blanc') || ($('input_33').value == 'blanc') || ($('input_34').value == 'blanc')) {
	opis += '<br />- blanc';
	prixcouleur	= (prixcadre*0.25)+prixcadre
	}

	if (($('input_31').value == 'aluminium') || ($('input_33').value == 'aluminium') || ($('input_34').value == 'aluminium')) {
	opis += '<br />- aluminium';
	prixcouleur	= prixcadre;
	}


	////banderole flexy'tens///

	if (($('input_121').value == '60x200cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x200cm'))){
		banderole=63;
		opis += '<br />- Banderole 60x200cm';
	}
	if (($('input_121').value == '60x250cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x250cm'))){
		banderole=78;
		opis += '<br />- Banderole 60x250cm';
	}
	if (($('input_121').value == '60x300cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x300cm'))){
		banderole=93;
		opis += '<br />- Banderole 60x300cm';
	}
	if (($('input_121').value == '60x350cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x350cm'))){
		banderole=108;
		opis += '<br />- Banderole 60x350cm';
	}
	if (($('input_121').value == '60x400cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x400cm'))){
		banderole=123;
		opis += '<br />- Banderole 60x400cm';
	}
	if (($('input_121').value == '60x450cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x450cm'))){
		banderole=135;
		opis += '<br />- Banderole 60x450cm';
	}
	if (($('input_121').value == '60x500cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '60x500cm'))){
		banderole=145;
		opis += '<br />- Banderole 60x500cm';
	}


	if (($('input_121').value == '80x200cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x200cm'))){
		banderole=79;
		opis += '<br />- Banderole 80x200cm';
	}
	if (($('input_121').value == '80x250cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x250cm'))){
		banderole=99;
		opis += '<br />- Banderole 80x250cm';
	}
	if (($('input_121').value == '80x300cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x300cm'))){
		banderole=118;
		opis += '<br />- Banderole 80x300cm';
	}
	if (($('input_121').value == '80x350cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x350cm'))){
		banderole=133;
		opis += '<br />- Banderole 80x350cm';
	}
	if (($('input_121').value == '80x400cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x400cm'))){
		banderole=152;
		opis += '<br />- Banderole 80x400cm';
	}
	if (($('input_121').value == '80x450cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x450cm'))){
		banderole=169;
		opis += '<br />- Banderole 80x450cm';
	}
	if (($('input_121').value == '80x500cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '80x500cm'))){
		banderole=190;
		opis += '<br />- Banderole 80x500cm';
	}


	if (($('input_121').value == '100x200cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x200cm'))){
		banderole=89;
		opis += '<br />- Banderole 100x200cm';
	}
	if (($('input_121').value == '100x250cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x250cm'))){
		banderole=110;
		opis += '<br />- Banderole 100x250cm';
	}
	if (($('input_121').value == '100x300cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x300cm'))){
		banderole=131;
		opis += '<br />- Banderole 100x300cm';
	}
	if (($('input_121').value == '100x350cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x350cm'))){
		banderole=152;
		opis += '<br />- Banderole 100x350cm';
	}
	if (($('input_121').value == '100x400cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x400cm'))){
		banderole=169;
		opis += '<br />- Banderole 100x400cm';
	}
	if (($('input_121').value == '100x450cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x450cm'))){
		banderole=189;
		opis += '<br />- Banderole 100x450cm';
	}
	if (($('input_121').value == '100x500cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '100x500cm'))){
		banderole=199;
		opis += '<br />- Banderole 100x500cm';
	}


	if (($('input_121').value == '120x200cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x200cm'))){
		banderole=108;
		opis += '<br />- Banderole 120x200cm';
	}
	if (($('input_121').value == '120x250cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x250cm'))){
		banderole=140;
		opis += '<br />- Banderole 120x250cm';
	}
	if (($('input_121').value == '120x300cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x300cm'))){
		banderole=172;
		opis += '<br />- Banderole 120x300cm';
	}
	if (($('input_121').value == '120x350cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x350cm'))){
		banderole=189;
		opis += '<br />- Banderole 120x350cm';
	}
	if (($('input_121').value == '120x400cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x400cm'))){
		banderole=216;
		opis += '<br />- Banderole 120x400cm';
	}
	if (($('input_121').value == '120x450cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x450cm'))){
		banderole=239;
		opis += '<br />- Banderole 120x450cm';
	}
	if (($('input_121').value == '120x500cm') || (($('input_03').value == 'structure + banderole') && ($('input_120').value == '120x500cm'))){
		banderole=259;
		opis += '<br />- Banderole 120x500cm';
	}

	////fixation ix'tens///

	if ($('input_5').value == 'Fixation murale'){
		fixation=0;
		opis += '<br />- Fixation murale';
	}

	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_21a').value == '60cm x 100cm')){
		fixation=299;
		opis += '<br />- Système fixation grillage 60cm x 100cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_21a').value == '60cm x 200cm')){
		fixation=349;
		opis += '<br />- Système fixation grillage 60cm x 200cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_21a').value == '60cm x 300cm')){
		fixation=399;
		opis += '<br />- Système fixation grillage 60cm x 300cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_21a').value == '60cm x 400cm')){
		fixation=449;
		opis += '<br />- Système fixation grillage 60cm x 400cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_21a').value == '60cm x 500cm')){
		fixation=499;
		opis += '<br />- Système fixation grillage 60cm x 500cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_21a').value == '60cm x 600cm')){
		fixation=569;
		opis += '<br />- Système fixation grillage 60cm x 600cm';
	}


	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_22a').value == '80cm x 100cm')){
		fixation=313;
		opis += '<br />- Système fixation grillage 80cm x 100cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_22a').value == '80cm x 200cm')){
		fixation=363;
		opis += '<br />- Système fixation grillage 80cm x 200cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_22a').value == '80cm x 300cm')){
		fixation=413;
		opis += '<br />- Système fixation grillage 80cm x 300cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_22a').value == '80cm x 400cm')){
		fixation=463;
		opis += '<br />- Système fixation grillage 80cm x 400cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_22a').value == '80cm x 500cm')){
		fixation=513;
		opis += '<br />- Système fixation grillage 80cm x 500cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_22a').value == '80cm x 600cm')){
		fixation=583;
		opis += '<br />- Système fixation grillage 80cm x 600cm';
	}


	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_23a').value == '100cm x 100cm')){
		fixation=327;
		opis += '<br />- Système fixation grillage 100cm x 100cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_23a').value == '100cm x 200cm')){
		fixation=377;
		opis += '<br />- Système fixation grillage 100cm x 200cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_23a').value == '100cm x 300cm')){
		fixation=427;
		opis += '<br />- Système fixation grillage 100cm x 300cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_23a').value == '100cm x 400cm')){
		fixation=477;
		opis += '<br />- Système fixation grillage 100cm x 400cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_23a').value == '100cm x 500cm')){
		fixation=527;
		opis += '<br />- Système fixation grillage 100cm x 500cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_23a').value == '100cm x 600cm')){
		fixation=597;
		opis += '<br />- Système fixation grillage 100cm x 600cm';
	}


	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_24a').value == '120cm x 100cm')){
		fixation=365;
		opis += '<br />- Système fixation grillage 120cm x 100cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_24a').value == '120cm x 200cm')){
		fixation=415;
		opis += '<br />- Système fixation grillage 120cm x 200cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_24a').value == '120cm x 300cm')){
		fixation=465;
		opis += '<br />- Système fixation grillage 120cm x 300cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_24a').value == '120cm x 400cm')){
		fixation=515;
		opis += '<br />- Système fixation grillage 120cm x 400cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_24a').value == '120cm x 500cm')){
		fixation=565;
		opis += '<br />- Système fixation grillage 120cm x 500cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_24a').value == '120cm x 600cm')){
		fixation=635;
		opis += '<br />- Système fixation grillage 120cm x 600cm';
	}

	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_25a').value == '140cm x 100cm')){
		fixation=383;
		opis += '<br />- Système fixation grillage 140cm x 100cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_25a').value == '140cm x 200cm')){
		fixation=433;
		opis += '<br />- Système fixation grillage 140cm x 200cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_25a').value == '140cm x 300cm')){
		fixation=483;
		opis += '<br />- Système fixation grillage 140cm x 300cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_25a').value == '140cm x 400cm')){
		fixation=533;
		opis += '<br />- Système fixation grillage 140cm x 400cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_25a').value == '140cm x 500cm')){
		fixation=583;
		opis += '<br />- Système fixation grillage 140cm x 500cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_25a').value == '140cm x 600cm')){
		fixation=653;
		opis += '<br />- Système fixation grillage 140cm x 600cm';
	}


	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_26a').value == '160cm x 100cm')){
		fixation=401;
		opis += '<br />- Système fixation grillage 160cm x 100cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_26a').value == '160cm x 200cm')){
		fixation=451;
		opis += '<br />- Système fixation grillage 160cm x 200cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_26a').value == '160cm x 300cm')){
		fixation=501;
		opis += '<br />- Système fixation grillage 160cm x 300cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_26a').value == '160cm x 400cm')){
		fixation=551;
		opis += '<br />- Système fixation grillage 160cm x 400cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_26a').value == '160cm x 500cm')){
		fixation=601;
		opis += '<br />- Système fixation grillage 160cm x 500cm';
	}
	if (($('input_5').value == 'Fixation sur grillage ou clôture') && ($('input_26a').value == '160cm x 600cm')){
		fixation=671;
		opis += '<br />- Système fixation grillage 160cm x 600cm';
	}


	if (($('input_5').value == 'Fixation sur poteaux aluminium') && (($('input_21a').value == '60cm x 100cm') || ($('input_22a').value == '80cm x 100cm') || ($('input_23a').value == '100cm x 100cm') || ($('input_24a').value == '120cm x 100cm') || ($('input_25a').value == '140cm x 100cm') || ($('input_26a').value == '160cm x 100cm'))){
		fixation=529;
		opis += '<br />- Fixation sur poteaux aluminium';
	}

	if (($('input_5').value == 'Fixation sur poteaux aluminium') && (($('input_21a').value == '60cm x 200cm') || ($('input_22a').value == '80cm x 200cm') || ($('input_23a').value == '100cm x 200cm') || ($('input_24a').value == '120cm x 200cm') || ($('input_25a').value == '140cm x 200cm') || ($('input_26a').value == '160cm x 200cm'))){
		fixation=589;
		opis += '<br />- Fixation sur poteaux aluminium';
	}

	if (($('input_5').value == 'Fixation sur poteaux aluminium') && (($('input_21a').value == '60cm x 300cm') || ($('input_22a').value == '80cm x 300cm') || ($('input_23a').value == '100cm x 300cm') || ($('input_24a').value == '120cm x 300cm') || ($('input_25a').value == '140cm x 300cm') || ($('input_26a').value == '160cm x 300cm'))){
		fixation=649;
		opis += '<br />- Fixation sur poteaux aluminium';
	}

	if (($('input_5').value == 'Fixation sur poteaux aluminium') && (($('input_21a').value == '60cm x 400cm') || ($('input_22a').value == '80cm x 400cm') || ($('input_23a').value == '100cm x 400cm') || ($('input_24a').value == '120cm x 400cm') || ($('input_25a').value == '140cm x 400cm') || ($('input_26a').value == '160cm x 400cm'))){
		fixation=719;
		opis += '<br />- Fixation sur poteaux aluminium';
	}
	if (($('input_5').value == 'Fixation sur poteaux aluminium') && (($('input_21a').value == '60cm x 500cm') || ($('input_22a').value == '80cm x 500cm') || ($('input_23a').value == '100cm x 500cm') || ($('input_24a').value == '120cm x 500cm') || ($('input_25a').value == '140cm x 500cm') || ($('input_26a').value == '160cm x 500cm'))){
		fixation=779;
		opis += '<br />- Fixation sur poteaux aluminium';
	}

	if (($('input_5').value == 'Fixation sur poteaux aluminium') && (($('input_21a').value == '60cm x 600cm') || ($('input_22a').value == '80cm x 600cm') || ($('input_23a').value == '100cm x 600cm') || ($('input_24a').value == '120cm x 600cm') || ($('input_25a').value == '140cm x 600cm') || ($('input_26a').value == '160cm x 600cm'))){
		fixation=839;
		opis += '<br />- Fixation sur poteaux aluminium';
	}


	ilosc = $('input_4').value;
	prixunitaire=prixcouleur+banderole+fixation+(prixcadre*0.25)
	cena=prixunitaire*ilosc

	var rush24 = $$('#rush24').collect(function(e){ return e.checked; }).any();
	if (rush24 == true) {
		prixunitaire += (prixunitaire*15)/100;
		cena += (cena*15)/100;
		opis += '<br />- Express 4 à 7 jours ouvrés';
	}

	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
	}

	var contact = $$('#contact').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (contact == true) {
		transport=0;
		opis += '<br />- Etre contacté pour pose';
	}


	prixunitaire=fixstr(prixunitaire);
	cena2 = prixunitaire.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var forfait = 19 - suma;
	if (forfait > 0) {
		forfait = fixstr(forfait);
		eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button>FORFAIT '+forfait+' &euro;<br />';
		var newoption = parseFloat(forfait);
		newoption=fixstr(newoption);
		newoption2 = newoption.replace(".", ",");
		option2 = newoption2;
		var newopt = document.getElementById("option");
		newopt.innerHTML=newoption2+' &euro;';
		suma = 19;
		suma=fixstr(suma);
		suma2 = suma.replace(".", ",");
		var newtotal = document.getElementById("total");
		newtotal.innerHTML=suma2+' &euro;';
	}



	var rodzaj = $('input_01').value;

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant</button> ';
}

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
var cena=0; var cena2=0; var cena1=0; var cenar=0; var cenarv=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';
var niepokazuj = 0;
var option2=0;
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';

if (($('input_1').value == '130-200cm') || ($('input_1').value == '201-300cm') || ($('input_1').value == '300-399cm') || ($('input_1').value == '400-499cm') || ($('input_1').value == '500-599cm') || ($('input_1').value == '600-699cm')){

	if ($('input_1').value == '130-200cm') {
		if ($('input_2').value == 'blanc'){ opis += '- blanc'; cenar=295;}
		if ($('input_2').value == 'rouge'){ opis += '- rouge'; cenar=387;}
		if ($('input_2').value == 'jaune'){ opis += '- jaune'; cenar=387;}
		if ($('input_2').value == 'vert'){ opis += '- vert'; cenar=387;}
		if ($('input_2').value == 'orange'){ opis += '- orange'; cenar=387;}
		if ($('input_2').value == 'bleu'){ opis += '- bleu'; cenar=387;}
		if ($('input_2').value == 'noir'){ opis += '- noir'; cenar=387;}

	}

	if ($('input_1').value == '201-300cm') {
		if ($('input_2').value == 'blanc'){ opis += '- blanc'; cenar=404;}
		if ($('input_2').value == 'rouge'){ opis += '- rouge'; cenar=516;}
		if ($('input_2').value == 'jaune'){ opis += '- jaune'; cenar=516;}
		if ($('input_2').value == 'vert'){ opis += '- vert'; cenar=516;}
		if ($('input_2').value == 'orange'){ opis += '- orange'; cenar=516;}
		if ($('input_2').value == 'bleu'){ opis += '- bleu'; cenar=516;}
		if ($('input_2').value == 'noir'){ opis += '- noir'; cenar=516;}

	}

	if ($('input_1').value == '300-399cm') {
		if ($('input_2').value == 'blanc'){ opis += '- blanc'; cenar=449;}
		if ($('input_2').value == 'rouge'){ opis += '- rouge'; cenar=568;}
		if ($('input_2').value == 'jaune'){ opis += '- jaune'; cenar=568;}
		if ($('input_2').value == 'vert'){ opis += '- vert'; cenar=568;}
		if ($('input_2').value == 'orange'){ opis += '- orange'; cenar=568;}
		if ($('input_2').value == 'bleu'){ opis += '- bleu'; cenar=568;}
		if ($('input_2').value == 'noir'){ opis += '- noir'; cenar=568;}

	}

	if ($('input_1').value == '400-499cm') {
		if ($('input_2').value == 'blanc'){ opis += '- blanc'; cenar=575;}
		if ($('input_2').value == 'rouge'){ opis += '- rouge'; cenar=714;}
		if ($('input_2').value == 'jaune'){ opis += '- jaune'; cenar=714;}
		if ($('input_2').value == 'vert'){ opis += '- vert'; cenar=714;}
		if ($('input_2').value == 'orange'){ opis += '- orange'; cenar=714;}
		if ($('input_2').value == 'bleu'){ opis += '- bleu'; cenar=714;}
		if ($('input_2').value == 'noir'){ opis += '- noir'; cenar=714;}

	}
	if ($('input_1').value == '500-599cm') {
		if ($('input_2').value == 'blanc'){ opis += '- blanc'; cenar=701;}
		if ($('input_2').value == 'rouge'){ opis += '- rouge'; cenar=859;}
		if ($('input_2').value == 'jaune'){ opis += '- jaune'; cenar=859;}
		if ($('input_2').value == 'vert'){ opis += '- vert'; cenar=859;}
		if ($('input_2').value == 'orange'){ opis += '- orange'; cenar=859;}
		if ($('input_2').value == 'bleu'){ opis += '- bleu'; cenar=859;}
		if ($('input_2').value == 'noir'){ opis += '- noir'; cenar=859;}

	}

	if ($('input_1').value == '600-699cm') {
		if ($('input_2').value == 'blanc'){ opis += '- blanc'; cenar=819;}
		if ($('input_2').value == 'rouge'){ opis += '- rouge'; cenar=996;}
		if ($('input_2').value == 'jaune'){ opis += '- jaune'; cenar=996;}
		if ($('input_2').value == 'vert'){ opis += '- vert'; cenar=996;}
		if ($('input_2').value == 'orange'){ opis += '- orange'; cenar=996;}
		if ($('input_2').value == 'bleu'){ opis += '- bleu'; cenar=996;}
		if ($('input_2').value == 'noir'){ opis += '- noir'; cenar=996;}

	}


	ilosc = $('input_4').value;
	cena = cenar*ilosc;


	var rush24p = $$('#rush24p').collect(function(e){ return e.checked; }).any();
	if (rush24p == true) {
		cena *= 1.5;
		opis += '<br />- Délai rush24';
	}




            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                opis += "<br />- Livraison gratuite avec FEDEX";
                transport = 0;
            }
			if (document.getElementById('tnt') && document.getElementById('tnt').checked == true) {
                    etiqdesc += '<br />- Livraison Payante';
       		}









	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}

	cenar=fixstr(cenar);
	cena2 = cenar.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';


	var forfait = 15 - suma;
	if (forfait > 0) {
		forfait = fixstr(forfait);
		eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button>FORFAIT '+forfait+' &euro;<br />';
		var newoption = parseFloat(forfait);
		newoption=fixstr(newoption);
		newoption2 = newoption.replace(".", ",");
		option2 = newoption2;
		var newopt = document.getElementById("option");
		newopt.innerHTML=newoption2+' &euro;';
		suma = 15;
		suma=fixstr(suma);
		suma2 = suma.replace(".", ",");
		var newtotal = document.getElementById("total");
		newtotal.innerHTML=suma2+' &euro;';
	}




	var rodzaj = $('input_1').value;

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant</button> ';
}

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
var cena=0; var cena2=0; var cenapojedyncza=0;
var rabat=0; var rabat2=0;
var suma=0; var suma2=0;
var transport=0;
var ktorytyp='';
var cedzik='';
var dodatkowaopcja='';
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';
var ax1 = document.getElementById("id_5");
var ax2 = document.getElementById("id_10");
if (ax1) {
	ax1.style.background="none";
	ax1.style.border="none";
	//ax1.style.borderBottom="1px solid #9fa3a8";
}
if (ax2) {
	ax2.style.background="none";
	ax2.style.border="none";
	//ax2.style.borderBottom="1px solid #9fa3a8";
}

if ( ($('input_1').value) && ( ($('input_31').value) || ($('input_32').value) || ($('input_33').value) || ($('input_34').value) || ($('input_35').value) || ($('input_36').value) || ($('input_51').value) || ($('input_52').value) || ($('input_53').value) || ($('input_54').value) && ($('input_16').value)) && ($('input_6').value || $('input_61').value) && ($('input_7').value) ) {
	if ($('input_1').value == 'roll-up') {
		if ($('input_31').value == '80x200') {
			cena=55;
		}
		if ($('input_31').value == '60x160') {
			cena=49;
		}
		if ($('input_31').value == '60x200') {
			cena=54;
		}
		if ($('input_31').value == '85x200') {
			cena=57;
		}
		if ($('input_31').value == '100x200') {
			cena=89;
		}
		if ($('input_31').value == '120x200') {
			cena=109;
		}
		if ($('input_31').value == '150x200') {
			cena=119;
		}
		if ($('input_31').value == '200x200') {
			cena=225;
		}
		if ($('input_31').value == '150x300') {
			cena=235;
		}
		if ($('input_31').value == '80x200double') {
			cena=139;
		}
		if ($('input_31').value == '85x200double') {
			cena=149;
		}
		if ($('input_31').value == 'minia4') {
			cena=24;
		}
		if ($('input_31').value == 'minia3') {
			cena=29;
		}
		if ($('input_51').value == '100% écologique M1') {
			cena+=20;
		}
		if ($('input_55').value == '100% écologique M1') {
			cena+=20;
		}
		if ($('input_11').value == 'spot') {
			cena+=21;
		}
		ktorytyp=$('input_31').value;
		dodatkowaopcja='<br />- '+$('input_55').value;
		if ($('input_11').value != '') {
			dodatkowaopcja += '<br />- '+$('input_11').value;
		}
	}
	if ($('input_1').value == 'blizzard') {
		if ($('input_34').value == '60x160') {
			cena=149;
			ktorytyp=$('input_34').value;
		}
		if ($('input_34').value == '80x200') {
			cena=169;
			ktorytyp=$('input_34').value;
		}
		if ($('input_16').value == 'sac') {
			cena+=22;
		}
		dodatkowaopcja='<br />- '+$('input_16').value;
	}
	if ($('input_1').value == 'x-screen') {
		if ($('input_32').value == '60x160') {
			cena=34;
			ktorytyp=$('input_32').value;
		}
		if ($('input_51').value == '100% écologique M1') {
			cena+=20;
		}
		dodatkowaopcja='<br />- '+$('input_51').value;
	}
	if ($('input_1').value == 'clipit') {
		if ($('input_33').value == '60x100') {
			if ($('input_52').value == '470g M1') {
				cena=33.6;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=33.6;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=40.2;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '60x120') {

			if ($('input_52').value == '470g M1') {
				cena=39.95;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=39.95;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=44.9;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '60x160') {

			if ($('input_52').value == '470g M1') {
				cena=43.7;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=43.7;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=54.25;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '80x100') {

			if ($('input_52').value == '470g M1') {
				cena=40.35;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=40.35;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=53.6;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '80x120') {
			if ($('input_52').value == '470g M1') {
				cena=49.3;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=49.3;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=59.85;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '80x160') {

			if ($('input_52').value == '470g M1') {
				cena=58.25;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=58.25;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=73.35;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '80x200') {

			if ($('input_52').value == '470g M1') {
				cena=67.2;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=67.2;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=84.8;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '80x250') {

			if ($('input_52').value == '470g M1') {
				cena=78.4;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=78.4;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=100.4;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '80x300') {

			if ($('input_52').value == '470g M1') {
				cena=89.6;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=89.6;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=116;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '100x100') {

			if ($('input_52').value == '470g M1') {
				cena=56;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=56;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=67;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '100x120') {

			if ($('input_52').value == '470g M1') {
				cena=61.6;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=61.6;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=74.8;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '100x160') {

			if ($('input_52').value == '470g M1') {
				cena=72.8;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=72.8;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=90.4;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '100x200') {

			if ($('input_52').value == '470g M1') {
				cena=84;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=84;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=106;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '100x250') {

			if ($('input_52').value == '470g M1') {
				cena=98;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=98;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=125.5;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '100x300') {

			if ($('input_52').value == '470g M1') {
				cena=112;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=112;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=145;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '120x160') {

			if ($('input_52').value == '470g M1') {
				cena=86.8;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=86.8;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=104.9;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '120x200') {

			if ($('input_52').value == '470g M1') {
				cena=97.2;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=97.2;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=123.6;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '120x250') {

			if ($('input_52').value == '470g M1') {
				cena=114;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=114;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=147;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '120x300') {

			if ($('input_52').value == '470g M1') {
				cena=131;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=131;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=171;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '160x200') {

			if ($('input_52').value == '470g M1') {
				cena=141;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=141;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=181;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '160x250') {

			if ($('input_52').value == '470g M1') {
				cena=152;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=152;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=192;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '160x300') {

			if ($('input_52').value == '470g M1') {
				cena=175;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=175;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=215;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '160x350') {

			if ($('input_52').value == '470g M1') {
				cena=197;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=197;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=237;
			}
			ktorytyp=$('input_33').value;
		}
		if ($('input_33').value == '160x400') {

			if ($('input_52').value == '470g M1') {
				cena=220;
			}
			if ($('input_52').value == '440g M1 RECTO VERSO') {
				cena=220;
				var cena60p = cena*0.6;
				cena = cena + cena60p;
			}
			if ($('input_52').value == '100% écologique M1') {
				cena=260;
			}
			ktorytyp=$('input_33').value;
		}
		dodatkowaopcja='<br />- '+$('input_52').value;
		if ($('input_111').value == 'ventouse') {
			dodatkowaopcja+='<br />- Ventouse super adhesive 65mm';
			cena+=5.7;
		}
	}

	if ($('input_1').value == 'L-Banner-Light') {
		if ($('input_35').value == '80x200') {
			cena=55;
		}
		if ($('input_35').value == '100x200') {
			cena=59;
		}
		if ($('input_53').value == '100% écologique M1') {
			cena+=23;
		}
		if ($('input_11').value == 'spot') {
			cena+=29;
		}
		ktorytyp=$('input_35').value;
		dodatkowaopcja='<br />- '+$('input_53').value;
		if ($('input_11').value != '') {
			dodatkowaopcja += '<br />- '+$('input_11').value;
		}
	}
	if ($('input_1').value == 'L-Banner-Prestige') {
		if ($('input_36').value == '60x200') {
			cena=69;
		}
		if ($('input_36').value == '80x200') {
			cena=79;
		}
		if ($('input_36').value == '100x200') {
			cena=94;
		}
		if ($('input_53').value == '100% écologique M1') {
			cena+=23;
		}
		if ($('input_11').value == 'spot') {
			cena+=29;
		}
		ktorytyp=$('input_36').value;
		dodatkowaopcja='<br />- '+$('input_53').value;
		if ($('input_11').value != '') {
			dodatkowaopcja += '<br />- '+$('input_11').value;
		}
	}

	var ktodaje;
	if ($('input_6').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_6').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}

	if ($('input_61').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_61').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}


	cenapojedyncza = cena;

	ilosc=$('input_7').value;
	if ($('input_7').value) {
		cena=cenapojedyncza*ilosc;
	}

	var total = document.getElementById("total");
	var remise = document.getElementById("remise");
	if (ilosc>=2) {
		if ((ilosc>=2) && (ilosc<=4)) {
			rabat=cena*0.02;
		}
		if ((ilosc>=5) && (ilosc<=9)) {
			rabat=cena*0.03;
		}
		if ((ilosc>=10) && (ilosc<=20)) {
			rabat=cena*0.05;
		}
		if ((ilosc>=21) && (ilosc<=49)) {
			rabat=cena*0.08;
		}
		if (ilosc>=50) {
			rabat=cena*0.10;
		}
		rabat=fixstr(rabat);
		rabat2 = rabat.replace(".", ",");
		if (rabat2 != 0) {rabat2 = rabat2+' &euro;'}
		if (rabat2 == 0) {rabat2 = '-'}
		remise.innerHTML=rabat2;
	}

///////
	var recycler = $$('#recycler').collect(function(e){ return e.checked; }).any();
	if (recycler == true) {
		if (ilosc == 1) {
			cenapojedyncza += 9.50;
			cena += 9.50;
		}
		if (ilosc > 1) {
			cenapojedyncza += 4.90;
			cena += 4.90 * ilosc;
		}
		cedzik += '<br />- recycler les bâches';
	}
	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		cedzik += '<br />- colis revendeur';
	}
	var rush24 = $$('#rush24').collect(function(e){ return e.checked; }).any();
	if (rush24 == true) {
		if (ilosc == 1) {
			cenapojedyncza += 59.00;
			cena += 59.00;
		}
		if (ilosc == 2) {
			cenapojedyncza += 49.00;
			cena += 49.00 * ilosc;
		}
		if (ilosc > 2 && ilosc < 6) {
			cenapojedyncza += 39;
			cena += 39 * ilosc;
		}
		if (ilosc > 5 && ilosc < 9) {
			cenapojedyncza += 29;
			cena += 29 * ilosc;
		}
		if (ilosc > 8 && ilosc < 21) {
			cenapojedyncza += 19;
			cena += 19 * ilosc;
		}
		if (ilosc > 20) {
			cenapojedyncza += 19;
			cena += 19 * ilosc;
		}

		cedzik += '<br />- délai rush 24/48H';
	}
	var rush72 = $$('#rush72').collect(function(e){ return e.checked; }).any();
	if (rush72 == true) {
		if (ilosc == 1) {
			cenapojedyncza += 49.00;
			cena += 49.00;
		}
		if (ilosc == 2) {
			cenapojedyncza += 39.00;
			cena += 39.00 * ilosc;
		}
		if (ilosc > 2 && ilosc < 6) {
			cenapojedyncza += 29;
			cena += 29 * ilosc;
		}
		if (ilosc > 5 && ilosc < 9) {
			cenapojedyncza += 19;
			cena += 19 * ilosc;
		}
		if (ilosc > 8 && ilosc < 21) {
			cenapojedyncza += 9;
			cena += 9 * ilosc;
		}
		if (ilosc > 20) {
			cenapojedyncza += 19;
			cena += 9 * ilosc;
		}
		cedzik += '<br />- délai rush 72H';
	}
	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		cenapojedyncza += 5.00;
		cena += 5.00;
		cedzik += '<br />- relais colis';
	}
/////////

	cenapojedyncza=fixstr(cenapojedyncza);
	cena2 = cenapojedyncza.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';


/* koszty transportu */
	if (ilosc==1) {	transport=13.9; }
	if ((ilosc>=2) && (ilosc<=4)) {	transport=19.5; }
	if ((ilosc>=5) && (ilosc<=7)) {	transport=25.2; }
	if ((ilosc>=8) && (ilosc<=10)) { transport=29.9; }
	if ((ilosc>=11) && (ilosc<=13)) { transport=35.9; }
	if ((ilosc>=14) && (ilosc<=16)) { transport=39.9; }
	if ((ilosc>=17) && (ilosc<=19)) { transport=45.9; }
	if (ilosc>=20) { transport=0; }
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		etiqdesc = '<br />- retrait colis a l\'atelier';
	}


            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                etiqdesc += '<br />- Livraison gratuite';
                transport = 0;
            }
			if (document.getElementById('tnt') && document.getElementById('tnt').checked == true) {
                    etiqdesc += '<br />- Livraison Payante';
       		}


/* /koszty transportu */

	var niepokazuj = 0;

if (niepokazuj==1) {
	prix.innerHTML='-';
	remise.innerHTML='-';
	total.innerHTML='-';
}
if (niepokazuj==0) {
	suma=cena-rabat;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Kakemono" /><input type="hidden" name="opis" value="- '+$('input_1').value+'<br />- '+ktorytyp+dodatkowaopcja+'<br />- '+ktodaje+cedzik+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant</button> ';
}

}

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
var cena=0; var cena2=0; var cena1=0; var cenar=0; var cenarv=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';
var niepokazuj = 0;
var option2=0;
var szerokosc=0;
var wysokosc=0;
var pu=0; var fixations=0; var percage=0; var puoption=0; var maquette=0; var tarifventouse=0; var fixationsventouse=0; nbtrou=0;
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';


if (($('input_0').value == 'recto') || ($('input_0').value == 'rectoverso')) {

	ilosc = $('input_32').value;
	szerokosc = ($('input_10').value);
	szerokosc = szerokosc.replace(',','.');
	szerokosc = fixstr(szerokosc);
	$('input_10').value = szerokosc;
	wysokosc = ($('input_9').value);
	wysokosc = wysokosc.replace(',','.');
	wysokosc = fixstr(wysokosc);
	$('input_9').value = wysokosc;


	///// Forex 1mm recto 50x20 UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == '50x20')){
		opis += '<br />- Forex 1mm recto <br />- 50x20cm <br />- UV';
		if ($('input_32').value == '6'){pu=2.80; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=2.40; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=2.40; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=2.00; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=2.00; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=1.80; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=1.80; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=1.80; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=1.60; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=1.60; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=1.60; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=1.60; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=1.36; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=1.36; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=1.28; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=1.28; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=1.20; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=1.20; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=1.20; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=1.20; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=1.20; opis += '<br />- 10000 exemplaires';}
		poids = 1.6*0.10; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso 50x20 UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == '50x20')){
		opis += '<br />- Forex 1mm recto/verso <br />- 50x20cm <br />- UV';
		if ($('input_32').value == '6'){pu=3.85; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=3.30; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=3.30; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=2.75; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=2.75; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=2.48; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=2.48; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=2.48; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=2.20; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=2.20; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=2.20; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=2.20; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=1.87; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=1.87; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=1.76; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=1.76; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=1.65; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=1.65; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=1.65; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=1.65; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=1.65; opis += '<br />- 10000 exemplaires';}
		poids = 1.6*0.10; ////grammage x m²///
		poidstotal = poids*ilosc;
	}

	///// Forex 1mm recto 75x50 UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == '75x50')){
		opis += '<br />- Forex 1mm recto <br />- 75x50cm <br />- UV';
		if ($('input_32').value == '6'){pu=9.00; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=7.50; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=6.75; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=6.45; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=6.00; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=5.70; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=5.40; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=5.10; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=5.10; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=4.80; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=4.80; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=4.50; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=4.50; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=4.50; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=4.20; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=4.20; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=4.20; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=3.90; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=3.90; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=3.60; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=3.60; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*0.37; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso 75x50 UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == '75x50')){
		opis += '<br />- Forex 1mm recto/verso <br />- 75x50cm <br />- UV';
		if ($('input_32').value == '6'){pu=12.38; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=10.31; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=9.28; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=8.87; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=8.25; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=7.84; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=7.43; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=7.01; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=7.01; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=6.60; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=6.60; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=6.19; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=6.19; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=6.19; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=5.78; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=5.78; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=5.78; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=5.36; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=5.36; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=4.95; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=4.95; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*0.37; ////grammage x m²///

		poidstotal = poids*ilosc;
	}

	///// Forex 1mm recto 150x50 UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == '150x50')){
		opis += '<br />- Forex 1mm recto <br />- 150x50cm <br />- UV';
		if ($('input_32').value == '6'){pu=18.00; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=15.00; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=13.50; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=12.90; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=12.00; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=11.40; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=10.80; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=10.20; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=10.20; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=9.60; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=9.60; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=9.00; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=9.00; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=9.00; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=8.40; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=8.40; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=8.40; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=7.80; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=7.80; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=7.20; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=7.20; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*0.75; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso 150x50 UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == '150x50')){
		opis += '<br />- Forex 1mm recto/verso <br />- 150x50cm <br />- UV';
		if ($('input_32').value == '6'){pu=24.75; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=20.63; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=18.56; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=17.74; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=16.50; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=15.68; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=14.85; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=14.03; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=14.03; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=13.20; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=13.20; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=12.38; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=12.38; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=12.38; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=11.55; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=11.55; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=11.55; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=10.73; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=10.73; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=9.90; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=9.90; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*0.75; ////grammage x m²///
		poidstotal = poids*ilosc;
	}

	///// Forex 1mm recto 200x75 UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == '200x75')){
		opis += '<br />- Forex 1mm recto <br />- 200x75cm <br />- UV';
		if ($('input_32').value == '6'){pu=31.80; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=25.80; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=24.60; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=24.00; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=21.60; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=21.00; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=20.40; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=19.80; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=19.20; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=18.60; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=18.00; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=17.40; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=16.80; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=16.20; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=15.60; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=15.00; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=15.00; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=14.40; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=14.40; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=13.80; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=13.80; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*1.5; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso 200x75 UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == '200x75')){
		opis += '<br />- Forex 1mm recto/verso <br />- 200x75cm <br />- UV';
		if ($('input_32').value == '6'){pu=43.73; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=35.48; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=33.83; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=33.00; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=29.70; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=28.88; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=28.05; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=27.23; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=26.40; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=25.58; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=24.75; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=23.93; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=23.10; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=22.28; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=21.45; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=20.63; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=20.63; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=19.80; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=19.80; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=18.98; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=18.98; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*1.5; ////grammage x m²///
		poidstotal = poids*ilosc;
	}

	///// Forex 1mm recto 250x100 UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == '250x100')){
		opis += '<br />- Forex 1mm recto <br />- 250x100cm <br />- UV';
		if ($('input_32').value == '6'){pu=53.00; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=43.00; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=41.00; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=40.00; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=36.00; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=35.00; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=34.00; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=33.00; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=32.00; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=31.00; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=30.00; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=29.00; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=28.00; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=27.00; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=26.00; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=25.00; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=25.00; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=24.00; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=24.00; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=23.00; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=23.00; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*2.5; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso 250x100 UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == '250x100')){
		opis += '<br />- Forex 1mm recto/verso <br />- 250x100cm <br />- UV';
		if ($('input_32').value == '6'){pu=72.88; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=59.13; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=56.38; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=55.00; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=49.50; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=48.13; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=46.75; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=45.38; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=44.00; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=42.63; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=41.25; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=39.88; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=38.50; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=37.13; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=35.75; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=34.38; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=34.38; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=33.00; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=33.00; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=31.63; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=31.63; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*2.5; ////grammage x m²///
		poidstotal = poids*ilosc;
	}

	///// Forex 1mm recto 300x150 UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == '300x150')){
		opis += '<br />- Forex 1mm recto <br />- 300x150cm <br />- UV';
		if ($('input_32').value == '6'){pu=90.00; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=72.00; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=70.20; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=68.40; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=63.00; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=59.40; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=57.60; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=54.00; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=50.40; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=50.40; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=45.00; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=45.00; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=43.20; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=43.20; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=39.60; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=39.60; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=37.80; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=37.80; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=36.00; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=36.00; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=36.00; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*4.5; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso 300x150 UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == '300x150')){
		opis += '<br />- Forex 1mm recto/verso <br />- 300x150cm <br />- UV';
		if ($('input_32').value == '6'){pu=123.75; opis += '<br />- 6 exemplaires';}
		if ($('input_32').value == '12'){pu=99.00; opis += '<br />- 12 exemplaires';}
		if ($('input_32').value == '20'){pu=96.53; opis += '<br />- 20 exemplaires';}
		if ($('input_32').value == '40'){pu=94.05; opis += '<br />- 40 exemplaires';}
		if ($('input_32').value == '60'){pu=86.63; opis += '<br />- 60 exemplaires';}
		if ($('input_32').value == '80'){pu=81.68; opis += '<br />- 80 exemplaires';}
		if ($('input_32').value == '100'){pu=79.20; opis += '<br />- 100 exemplaires';}
		if ($('input_32').value == '150'){pu=74.25; opis += '<br />- 150 exemplaires';}
		if ($('input_32').value == '200'){pu=69.30; opis += '<br />- 200 exemplaires';}
		if ($('input_32').value == '300'){pu=69.30; opis += '<br />- 300 exemplaires';}
		if ($('input_32').value == '400'){pu=61.88; opis += '<br />- 400 exemplaires';}
		if ($('input_32').value == '500'){pu=61.88; opis += '<br />- 500 exemplaires';}
		if ($('input_32').value == '750'){pu=59.40; opis += '<br />- 750 exemplaires';}
		if ($('input_32').value == '1000'){pu=59.40; opis += '<br />- 1000 exemplaires';}
		if ($('input_32').value == '1500'){pu=54.45; opis += '<br />- 1500 exemplaires';}
		if ($('input_32').value == '2000'){pu=54.45; opis += '<br />- 2000 exemplaires';}
		if ($('input_32').value == '3000'){pu=51.98; opis += '<br />- 3000 exemplaires';}
		if ($('input_32').value == '4000'){pu=51.98; opis += '<br />- 4000 exemplaires';}
		if ($('input_32').value == '5000'){pu=49.50; opis += '<br />- 5000 exemplaires';}
		if ($('input_32').value == '7500'){pu=49.50; opis += '<br />- 7500 exemplaires';}
		if ($('input_32').value == '10000'){pu=49.50; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*4.5; ////grammage x m²///
		poidstotal = poids*ilosc;
	}

	///// Forex 1mm recto personnalisée UV/////
	if (($('input_0').value == 'recto') && ($('input_1').value == 'personnalisée')){
		opis += '<br />- Forex 1mm recto <br />- UV <br />- Taille Personnalisée';
		if ($('input_32perso').value == '6'){pu=0; opis += '<br />- 6 exemplaires';}
		if ($('input_32perso').value == '12'){pu=0; opis += '<br />- 12 exemplaires';}
		if ($('input_32perso').value == '20'){pu=0; opis += '<br />- 20 exemplaires';}
		if ($('input_32perso').value == '40'){pu=0; opis += '<br />- 40 exemplaires';}
		if ($('input_32perso').value == '60'){pu=0; opis += '<br />- 60 exemplaires';}
		if ($('input_32perso').value == '80'){pu=0; opis += '<br />- 80 exemplaires';}
		if ($('input_32perso').value == '100'){pu=0; opis += '<br />- 100 exemplaires';}
		if ($('input_32perso').value == '150'){pu=0; opis += '<br />- 150 exemplaires';}
		if ($('input_32perso').value == '200'){pu=0; opis += '<br />- 200 exemplaires';}
		if ($('input_32perso').value == '300'){pu=0; opis += '<br />- 300 exemplaires';}
		if ($('input_32perso').value == '400'){pu=0; opis += '<br />- 400 exemplaires';}
		if ($('input_32perso').value == '500'){pu=0; opis += '<br />- 500 exemplaires';}
		if ($('input_32perso').value == '750'){pu=0; opis += '<br />- 750 exemplaires';}
		if ($('input_32perso').value == '1000'){pu=0; opis += '<br />- 1000 exemplaires';}
		if ($('input_32perso').value == '1500'){pu=0; opis += '<br />- 1500 exemplaires';}
		if ($('input_32perso').value == '2000'){pu=0; opis += '<br />- 2000 exemplaires';}
		if ($('input_32perso').value == '3000'){pu=0; opis += '<br />- 3000 exemplaires';}
		if ($('input_32perso').value == '4000'){pu=0; opis += '<br />- 4000 exemplaires';}
		if ($('input_32perso').value == '5000'){pu=0; opis += '<br />- 5000 exemplaires';}
		if ($('input_32perso').value == '7500'){pu=0; opis += '<br />- 7500 exemplaires';}
		if ($('input_32perso').value == '10000'){pu=0; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*0; ////grammage x m²///
		poidstotal = poids*ilosc;
	}
	///// Forex 1mm recto/verso personnalisée UV/////
	if (($('input_0').value == 'rectoverso') && ($('input_1').value == 'personnalisée')){
		opis += '<br />- Forex 1mm recto/verso <br />- UV <br />- Taille Personnalisée';
		if ($('input_32perso').value == '6'){pu=0; opis += '<br />- 6 exemplaires';}
		if ($('input_32perso').value == '12'){pu=0; opis += '<br />- 12 exemplaires';}
		if ($('input_32perso').value == '20'){pu=0; opis += '<br />- 20 exemplaires';}
		if ($('input_32perso').value == '40'){pu=0; opis += '<br />- 40 exemplaires';}
		if ($('input_32perso').value == '60'){pu=0; opis += '<br />- 60 exemplaires';}
		if ($('input_32perso').value == '80'){pu=0; opis += '<br />- 80 exemplaires';}
		if ($('input_32perso').value == '100'){pu=0; opis += '<br />- 100 exemplaires';}
		if ($('input_32perso').value == '150'){pu=0; opis += '<br />- 150 exemplaires';}
		if ($('input_32perso').value == '200'){pu=0; opis += '<br />- 200 exemplaires';}
		if ($('input_32perso').value == '300'){pu=0; opis += '<br />- 300 exemplaires';}
		if ($('input_32perso').value == '400'){pu=0; opis += '<br />- 400 exemplaires';}
		if ($('input_32perso').value == '500'){pu=0; opis += '<br />- 500 exemplaires';}
		if ($('input_32perso').value == '750'){pu=0; opis += '<br />- 750 exemplaires';}
		if ($('input_32perso').value == '1000'){pu=0; opis += '<br />- 1000 exemplaires';}
		if ($('input_32perso').value == '1500'){pu=0; opis += '<br />- 1500 exemplaires';}
		if ($('input_32perso').value == '2000'){pu=0; opis += '<br />- 2000 exemplaires';}
		if ($('input_32perso').value == '3000'){pu=0; opis += '<br />- 3000 exemplaires';}
		if ($('input_32perso').value == '4000'){pu=0; opis += '<br />- 4000 exemplaires';}
		if ($('input_32perso').value == '5000'){pu=0; opis += '<br />- 5000 exemplaires';}
		if ($('input_32perso').value == '7500'){pu=0; opis += '<br />- 7500 exemplaires';}
		if ($('input_32perso').value == '10000'){pu=0; opis += '<br />- 10000 exemplaires';}
		poids = 0.68*0; ////grammage x m²///
		poidstotal = poids*ilosc;
	}




	////fixations/////

	if (($('input_4').value == 'ventouse') || ($('input_4perso').value == 'ventouse')){fixationsventouse=0.2; opis += '<br />- ventouse + perçage';} ////prix 1 ventouse/////
	if (($('input_4').value == 'crochets') || ($('input_4perso').value == 'crochets')){fixations=0.4; opis += '<br />- crochets invisbles (2 en haut)';}
	if (($('input_4').value == 'double face') || ($('input_4perso').value == 'double face')){fixations=0.3; opis += '<br />- double face';}
	////perçage/////
	if (($('input_5').value == '2') || ($('input_5perso').value == '2')){percage=0.4; nbtrou=2; opis += '<br />- 2 trous';}
	if (($('input_5').value == '4') || ($('input_5perso').value == '4')){percage=0.8; nbtrou=4; opis += '<br />- 4 trous';}
	if (($('input_5').value == '6') || ($('input_5perso').value == '6')){percage=1.2; nbtrou=6; opis += '<br />- 6 trous';}
	if (($('input_5').value == '8') || ($('input_5perso').value == '8')){percage=1.6; nbtrou=8; opis += '<br />- 8 trous';}
	if (($('input_5').value == '10') || ($('input_5perso').value == '10')){percage=2; nbtrou=10; opis += '<br />- 10 trous';}

	tarifventouse = (fixationsventouse*nbtrou) ////prix x ventouses/////

	////maquette/////
	if ($('input_6').value == 'fb') {maquette=29; opis += '<br />- France banderole crée la maquette';}
	if ($('input_6perso').value == 'fb') {opis += '<br />- France banderole crée la maquette';}
	if (($('input_6').value == 'user') || ($('input_6perso').value == 'user')) {opis += '<br />- j’ai déjà crée la maquette';}



	////tarif unitaire/////
	puoption = pu+fixations+percage+tarifventouse;
	puoption2 = puoption+(maquette/ilosc);
	////total/////
	cena = (puoption*ilosc)+maquette;


	///// options/////
	var rush24 = $$('#rush24').collect(function(e){ return e.checked; }).any();
	if (rush24 == true) {
			rush = 0.3*cena;
			puoption2 += rush/ilosc;
			cena += rush;
			opis += '<br />- délai express';
	}

	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		puoption2 += 5.00/ilosc;
		cena += 5.00;
		opis += '<br />- relais colis';
	}

	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		opis += '<br />- colis revendeur';
	}
	////fin d'options///


	///transport///



	 if (poidstotal <= 1) {prixtransport=4.80;}
	 if ((poidstotal > 1) && (poidstotal <= 2)) {prixtransport=5.1;}
	 if ((poidstotal > 2) && (poidstotal <= 3)) {prixtransport=5.67;}
	 if ((poidstotal > 3) && (poidstotal <= 4)) {prixtransport=5.63;}
	 if ((poidstotal > 4) && (poidstotal <= 5)) {prixtransport=6.88;}
	 if ((poidstotal > 5) && (poidstotal <= 6)) {prixtransport=7.99;}
	 if ((poidstotal > 6) && (poidstotal <= 7)) {prixtransport=7.99;}
	 if ((poidstotal > 7) && (poidstotal <= 10)) {prixtransport=9.30;}
	 if ((poidstotal > 10) && (poidstotal <= 15)) {prixtransport=11.93;}
	 if ((poidstotal > 15) && (poidstotal <= 20)) {prixtransport=14.93;}
     if ((poidstotal > 20) && (poidstotal <= 25)) {prixtransport=18.82;}
	 if ((poidstotal > 25) && (poidstotal <= 30)) {prixtransport=20.56;}
	 if ((poidstotal > 30) && (poidstotal <= 40)) {prixtransport=25.64;}
	 if ((poidstotal > 40) && (poidstotal <= 50)) {prixtransport=33.73;}
     if ((poidstotal > 50) && (poidstotal <= 60)) {prixtransport=42.14;}
	 if ((poidstotal > 60) && (poidstotal <= 70)) {prixtransport=47.71;}
	 if ((poidstotal > 70) && (poidstotal <= 80)) {prixtransport=55.26;}
	 if ((poidstotal > 80) && (poidstotal <= 90)) {prixtransport=62.12;}
     if ((poidstotal > 90) && (poidstotal <= 100)) {prixtransport=68.54;}
	 if (poidstotal > 100) {prixtransport=69.26;}
	 prixtransport2 = prixtransport*0.4;
	 transport = prixtransport + prixtransport2;
	 if($('input_1').value == 'personnalisée') {transport = 0};

	 var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		etiqdesc += '<br />- retrait colis a l\'atelier';
	}

    if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                    etiqdesc += '<br />- Livraison gratuite.';
                    transport = 0;
     }
	 if (document.getElementById('tnt') && document.getElementById('tnt').checked == true) {
                    etiqdesc += '<br />- Livraison Payante';
       		}

	///fin transport///

	puoption2=fixstr(puoption2);
	cena2 = puoption2.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';



	var forfait = 29 - suma;
	if (forfait > 0){
		if($('input_1').value != 'personnalisée') {
		forfait = fixstr(forfait);
		eBox.innerHTML = '<button class="closeButton"><i class="ion-ios-close-empty" aria-hidden="true"></i></button>FORFAIT '+forfait+' &euro;<br />';
		var newoption = parseFloat(forfait);
		newoption=fixstr(newoption);
		newoption2 = newoption.replace(".", ",");
		option2 = newoption2;
		var newopt = document.getElementById("option");
		newopt.innerHTML=newoption2+' &euro;';
		suma = 29;
		suma=fixstr(suma);
		suma2 = suma.replace(".", ",");
		var newtotal = document.getElementById("total");
		newtotal.innerHTML=suma2+' &euro;';
		}
		if($('input_1').value == 'personnalisée') {
		forfait = fixstr(forfait);
		puoption2=fixstr(puoption2);
		cena2 = puoption2.replace(".", ",");
		var prix = document.getElementById("prix_unitaire");
		prix.innerHTML='Tarif personnalisé';

		suma = 0;
		suma=fixstr(suma);
		suma2 = suma.replace(".", ",");
		var newtotal = document.getElementById("total");
		newtotal.innerHTML='Enregistrez votre Demande de devis';
		}
	}





	var rodzaj = "Forex 1mm";

	var dodajkoszyk = document.getElementById("cart_form");
	if($('input_1').value == 'personnalisée') {
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'<br />- '+szerokosc+' x '+wysokosc+' m <span style="+color:#F00+">ENREGISTRER VOTRE DEMANDE DE DEVIS POUR UNE REPONSE DANS LES 12H MAX</span> <input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="REPONSE DANS LES 12H MAX" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="ENREGISTREZ VOTRE DEVIS" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant</button> ';
	};
	if($('input_1').value != 'personnalisée') {
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Suivant</button> ';
	};

}
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



};
