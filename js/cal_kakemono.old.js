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
	
    if (document.getElementById("tnt").checked == false) {
        document.getElementById("fedex").checked = true;
    }
	
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
			document.getElementById("colis").checked = false;
			document.getElementById("etiquette").checked = false;
        }else{document.getElementById("fedex").checked = true;}
    },
    relaisColischeckbox: function() {
        if (document.getElementById("fedex").checked == true) {
            document.getElementById("fedex").checked = false;
			document.getElementById("tnt").checked = true;			
        }
    },
    colisRevendeurcheckbox: function() {
        if (document.getElementById("fedex").checked == true) {
            document.getElementById("fedex").checked = false;
			document.getElementById("tnt").checked = true;			
        }
    },
    changeThis: function(who, value) {
        if (document.getElementById(who)) {
            document.getElementById(who).checked = value;
        }
    },
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
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'jaune') || ($('input_33').value == 'jaune') || ($('input_34').value == 'jaune')) {
	opis += '<br />- jaune';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'vert') || ($('input_33').value == 'vert') || ($('input_34').value == 'vert')) {
	opis += '<br />- vert';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'orange') || ($('input_33').value == 'orange') || ($('input_34').value == 'orange')) {
	opis += '<br />- orange';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'bleu marine') || ($('input_33').value == 'bleu marine') || ($('input_34').value == 'bleu marine')) {
	opis += '<br />- bleu marine';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'bleu ciel') || ($('input_33').value == 'bleu ciel') || ($('input_34').value == 'bleu ciel')) {
	opis += '<br />- bleu ciel';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'noir') || ($('input_33').value == 'noir') || ($('input_34').value == 'noir')) {


	opis += '<br />- noir';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
	}
	
	if (($('input_31').value == 'blanc') || ($('input_33').value == 'blanc') || ($('input_34').value == 'blanc')) {
	opis += '<br />- blanc';	
	prixcouleur	= (prixcadre*0.2)+prixcadre	
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
	prixunitaire=prixcouleur+banderole+fixation
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
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
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
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},

cal_flyers: function(){  
var cena=0; var cena2=0; var cena1=0; var cenar=0; var cenarv=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';
var niepokazuj = 0;
var option2=0;
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';

if (($('input_1').value == 'Flyers 80g') || ($('input_1').value == 'Flyers 135g') || ($('input_1').value == 'Flyers 170g') || ($('input_1').value == 'Flyers 250g') || ($('input_1').value == 'Flyers 350g') || ($('input_1').value == 'Flyers 120µ') || ($('input_1').value == 'Flyers 270µ') || ($('input_1').value == 'Flyers 350µ')){
	if ($('input_1').value == 'Flyers 80g') {
		if ($('input_21').value == '1'){ opis += '- A7';}
		if ($('input_21').value == '2'){ opis += '- A7';}
		if ($('input_21').value == '3'){ opis += '- A6';}
		if ($('input_21').value == '4'){ opis += '- A6';}
		if ($('input_21').value == '5'){ opis += '- A5';}
		if ($('input_21').value == '6'){ opis += '- A5';}
		if ($('input_21').value == '7'){ opis += '- A4';}
		if ($('input_21').value == '8'){ opis += '- A4';}
		if ($('input_21').value == '9'){ opis += '- Din long';}
		if ($('input_21').value == '10'){ opis += '- Din long';}
		if ($('input_21').value == '11'){ opis += '- A3';}
		if ($('input_21').value == '12'){ opis += '- A3';}
		if (($('input_21').value == '1') || ($('input_21').value == '3') || ($('input_21').value == '5') || ($('input_21').value == '7') || ($('input_21').value == '9') || ($('input_21').value == '2') || ($('input_21').value == '4') || ($('input_21').value == '6') || ($('input_21').value == '8') || ($('input_21').value == '10') || ($('input_21').value == '11') || ($('input_21').value == '12')) {
			ilosc = $('input_5').value;
			cenar=0.17
			cenarv=0.22
			if ($('input_21').value == '1'){ cena=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 80g | Quadri';}
			if ($('input_21').value == '2'){ cena=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri';}
			if ($('input_21').value == '3'){ cena=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 80g | Quadri';}
			if ($('input_21').value == '4'){ cena=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri';}
			if ($('input_21').value == '5'){ cena=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 80g | Quadri';}
			if ($('input_21').value == '6'){ cena=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri';}
			if ($('input_21').value == '7'){ cena=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 80g | Quadri';}
			if ($('input_21').value == '8'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri';}
			if ($('input_21').value == '9'){ cena=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 80g | Quadri';}
			if ($('input_21').value == '10'){ cena=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri';}
			if ($('input_21').value == '11'){ cena=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 80g | Quadri';}
			if ($('input_21').value == '12'){ cena=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 135g') {
		if ($('input_22').value == '1'){ opis += '- A7';}
		if ($('input_22').value == '2'){ opis += '- A7';}
		if ($('input_22').value == '3'){ opis += '- A6';}
		if ($('input_22').value == '4'){ opis += '- A6';}
		if ($('input_22').value == '5'){ opis += '- A5';}
		if ($('input_22').value == '6'){ opis += '- A5';}
		if ($('input_22').value == '7'){ opis += '- A4';}
		if ($('input_22').value == '8'){ opis += '- A4';}
		if ($('input_22').value == '9'){ opis += '- Din long';}
		if ($('input_22').value == '10'){ opis += '- Din long';}
		if ($('input_22').value == '11'){ opis += '- A3';}
		if ($('input_22').value == '12'){ opis += '- A3';}
		if (($('input_22').value == '1') || ($('input_22').value == '3') || ($('input_22').value == '5') || ($('input_22').value == '7') || ($('input_22').value == '9') || ($('input_22').value == '2') || ($('input_22').value == '4') || ($('input_22').value == '6') || ($('input_22').value == '8') || ($('input_22').value == '10') || ($('input_22').value == '11') || ($('input_22').value == '12')) {
			ilosc = $('input_5').value;
			cenar=0.22
			cenarv=0.27
			if ($('input_22').value == '1'){ cena1=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 135g | Quadri';}
			if ($('input_22').value == '2'){ cena1=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '3'){ cena1=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 135g | Quadri';}
			if ($('input_22').value == '4'){ cena1=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '5'){ cena1=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 135g | Quadri';}
			if ($('input_22').value == '6'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '7'){ cena1=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 135g | Quadri';}
			if ($('input_22').value == '8'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '9'){ cena1=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 135g | Quadri';}
			if ($('input_22').value == '10'){ cena1=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '11'){ cena1=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 135g | Quadri';}
			if ($('input_22').value == '12'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 170g') {
		if ($('input_23').value == '1'){ opis += '- A7';}
		if ($('input_23').value == '2'){ opis += '- A7';}
		if ($('input_23').value == '3'){ opis += '- A6';}
		if ($('input_23').value == '4'){ opis += '- A6';}
		if ($('input_23').value == '5'){ opis += '- A5';}
		if ($('input_23').value == '6'){ opis += '- A5';}
		if ($('input_23').value == '7'){ opis += '- A4';}
		if ($('input_23').value == '8'){ opis += '- A4';}
		if ($('input_23').value == '9'){ opis += '- Din long';}
		if ($('input_23').value == '10'){ opis += '- Din long';}
		if ($('input_23').value == '11'){ opis += '- A3';}
		if ($('input_23').value == '12'){ opis += '- A3';}
		if (($('input_23').value == '1') || ($('input_23').value == '3') || ($('input_23').value == '5') || ($('input_23').value == '7') || ($('input_23').value == '9') || ($('input_23').value == '2') || ($('input_23').value == '4') || ($('input_23').value == '6') || ($('input_23').value == '8') || ($('input_23').value == '10') || ($('input_23').value == '11') || ($('input_23').value == '12')) {
			ilosc = $('input_5').value;
			cenar=0.27
			cenarv=0.32
			if ($('input_23').value == '1'){ cena1=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 170g | Quadri';}
			if ($('input_23').value == '2'){ cena1=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '3'){ cena1=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 170g | Quadri';}
			if ($('input_23').value == '4'){ cena1=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '5'){ cena1=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 170g | Quadri';}
			if ($('input_23').value == '6'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 170 | Quadri';}
			if ($('input_23').value == '7'){ cena1=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 170g | Quadri';}
			if ($('input_23').value == '8'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '9'){ cena1=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 170g | Quadri';}
			if ($('input_23').value == '10'){ cena1=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '11'){ cena1=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 170g | Quadri';}
			if ($('input_23').value == '12'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 250g') {
		if ($('input_24').value == '1'){ opis += '- A7';}
		if ($('input_24').value == '2'){ opis += '- A7';}
		if ($('input_24').value == '3'){ opis += '- A6';}
		if ($('input_24').value == '4'){ opis += '- A6';}
		if ($('input_24').value == '5'){ opis += '- A5';}
		if ($('input_24').value == '6'){ opis += '- A5';}
		if ($('input_24').value == '7'){ opis += '- A4';}
		if ($('input_24').value == '8'){ opis += '- A4';}
		if ($('input_24').value == '9'){ opis += '- Din long';}
		if ($('input_24').value == '10'){ opis += '- Din long';}
		if ($('input_24').value == '11'){ opis += '- A3';}
		if ($('input_24').value == '12'){ opis += '- A3';}
		if (($('input_24').value == '1') || ($('input_24').value == '3') || ($('input_24').value == '5') || ($('input_24').value == '7') || ($('input_24').value == '9') || ($('input_24').value == '2') || ($('input_24').value == '4') || ($('input_24').value == '6') || ($('input_24').value == '8') || ($('input_24').value == '10') || ($('input_24').value == '11') || ($('input_24').value == '12')) {
			ilosc = $('input_5').value;
			cenar=0.32
			cenarv=0.37
			if ($('input_24').value == '1'){ cena1=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 250g | Quadri';}
			if ($('input_24').value == '2'){ cena1=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '3'){ cena1=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 250g | Quadri';}
			if ($('input_24').value == '4'){ cena1=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '5'){ cena1=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 250g | Quadri';}
			if ($('input_24').value == '6'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '7'){ cena1=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 250g | Quadri';}
			if ($('input_24').value == '8'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '9'){ cena1=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 250g | Quadri';}
			if ($('input_24').value == '10'){ cena1=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '11'){ cena1=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 250g | Quadri';}
			if ($('input_24').value == '12'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 350g') {
		if ($('input_25').value == '1'){ opis += '- A7';}
		if ($('input_25').value == '2'){ opis += '- A7';}
		if ($('input_25').value == '3'){ opis += '- A6';}
		if ($('input_25').value == '4'){ opis += '- A6';}
		if ($('input_25').value == '5'){ opis += '- A5';}
		if ($('input_25').value == '6'){ opis += '- A5';}
		if ($('input_25').value == '7'){ opis += '- A4';}
		if ($('input_25').value == '8'){ opis += '- A4';}
		if ($('input_25').value == '9'){ opis += '- Din long';}
		if ($('input_25').value == '10'){ opis += '- Din long';}
		if ($('input_25').value == '11'){ opis += '- A3';}
		if ($('input_25').value == '12'){ opis += '- A3';}
		if (($('input_25').value == '1') || ($('input_25').value == '3') || ($('input_25').value == '5') || ($('input_25').value == '7') || ($('input_25').value == '9') || ($('input_25').value == '2') || ($('input_25').value == '4') || ($('input_25').value == '6') || ($('input_25').value == '8') || ($('input_25').value == '10') || ($('input_25').value == '11') || ($('input_25').value == '12')) {
			ilosc = $('input_5').value;
			cenar=0.37
			cenarv=0.42
			if ($('input_25').value == '1'){ cena1=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_25').value == '2'){ cena1=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if ($('input_25').value == '3'){ cena1=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_25').value == '4'){ cena1=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if ($('input_25').value == '5'){ cena1=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_25').value == '6'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if ($('input_25').value == '7'){ cena1=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_25').value == '8'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if ($('input_25').value == '9'){ cena1=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_25').value == '10'){ cena1=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if ($('input_25').value == '11'){ cena1=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_25').value == '12'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 120µ') {
		if ($('input_26').value == '1'){ opis += '- A7';}
		if ($('input_26').value == '2'){ opis += '- A7';}
		if ($('input_26').value == '3'){ opis += '- A6';}
		if ($('input_26').value == '4'){ opis += '- A6';}
		if ($('input_26').value == '5'){ opis += '- A5';}
		if ($('input_26').value == '6'){ opis += '- A5';}
		if ($('input_26').value == '7'){ opis += '- A4';}
		if ($('input_26').value == '8'){ opis += '- A4';}
		if ($('input_26').value == '9'){ opis += '- Din long';}
		if ($('input_26').value == '10'){ opis += '- Din long';}
		if ($('input_26').value == '11'){ opis += '- A3';}
		if ($('input_26').value == '12'){ opis += '- A3';}
		if (($('input_26').value == '1') || ($('input_26').value == '3') || ($('input_26').value == '5') || ($('input_26').value == '7') || ($('input_26').value == '9') || ($('input_26').value == '2') || ($('input_26').value == '4') || ($('input_26').value == '6') || ($('input_26').value == '8') || ($('input_26').value == '10') || ($('input_26').value == '11') || ($('input_26').value == '12')) {
			ilosc = $('input_5').value;
			cenar=2.38
			cenarv=2.42
			if ($('input_26').value == '1'){ cena=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 120µ | Quadri';}
			if ($('input_26').value == '2'){ cena=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 120µ | Quadri';}
			if ($('input_26').value == '3'){ cena=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 120µ | Quadri';}
			if ($('input_26').value == '4'){ cena=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 120µ | Quadri';}
			if ($('input_26').value == '5'){ cena=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 120µ | Quadri';}
			if ($('input_26').value == '6'){ cena=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 120µ | Quadri';}
			if ($('input_26').value == '7'){ cena=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 120µ | Quadri';}
			if ($('input_26').value == '8'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 120µ | Quadri';}
			if ($('input_26').value == '9'){ cena=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 120µ | Quadri';}
			if ($('input_26').value == '10'){ cena=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 120µ | Quadri';}
			if ($('input_26').value == '11'){ cena=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 120µ | Quadri';}
			if ($('input_26').value == '12'){ cena=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 120µ | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 270µ') {
		if ($('input_27').value == '1'){ opis += '- A7';}
		if ($('input_27').value == '2'){ opis += '- A7';}
		if ($('input_27').value == '3'){ opis += '- A6';}
		if ($('input_27').value == '4'){ opis += '- A6';}
		if ($('input_27').value == '5'){ opis += '- A5';}
		if ($('input_27').value == '6'){ opis += '- A5';}
		if ($('input_27').value == '7'){ opis += '- A4';}
		if ($('input_27').value == '8'){ opis += '- A4';}
		if ($('input_27').value == '9'){ opis += '- Din long';}
		if ($('input_27').value == '10'){ opis += '- Din long';}
		if ($('input_27').value == '11'){ opis += '- A3';}
		if ($('input_27').value == '12'){ opis += '- A3';}
		if (($('input_27').value == '1') || ($('input_27').value == '3') || ($('input_27').value == '5') || ($('input_27').value == '7') || ($('input_27').value == '9') || ($('input_27').value == '2') || ($('input_27').value == '4') || ($('input_27').value == '6') || ($('input_27').value == '8') || ($('input_27').value == '10') || ($('input_27').value == '11') || ($('input_27').value == '12')) {
			ilosc = $('input_5').value;
			cenar=3.38
			cenarv=3.85
			if ($('input_27').value == '1'){ cena=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_27').value == '2'){ cena=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if ($('input_27').value == '3'){ cena=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_27').value == '4'){ cena=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if ($('input_27').value == '5'){ cena=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_27').value == '6'){ cena=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if ($('input_27').value == '7'){ cena=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_27').value == '8'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if ($('input_27').value == '9'){ cena=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_27').value == '10'){ cena=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if ($('input_27').value == '11'){ cena=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_27').value == '12'){ cena=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena*=0.75;}
		}
	}
	
	if ($('input_1').value == 'Flyers 350µ') {
		if ($('input_28').value == '1'){ opis += '- A7';}
		if ($('input_28').value == '2'){ opis += '- A7';}
		if ($('input_28').value == '3'){ opis += '- A6';}
		if ($('input_28').value == '4'){ opis += '- A6';}
		if ($('input_28').value == '5'){ opis += '- A5';}
		if ($('input_28').value == '6'){ opis += '- A5';}
		if ($('input_28').value == '7'){ opis += '- A4';}
		if ($('input_28').value == '8'){ opis += '- A4';}
		if ($('input_28').value == '9'){ opis += '- Din long';}
		if ($('input_28').value == '10'){ opis += '- Din long';}
		if ($('input_28').value == '11'){ opis += '- A3';}
		if ($('input_28').value == '12'){ opis += '- A3';}
		if (($('input_28').value == '1') || ($('input_28').value == '3') || ($('input_28').value == '5') || ($('input_28').value == '7') || ($('input_28').value == '9') || ($('input_28').value == '2') || ($('input_28').value == '4') || ($('input_28').value == '6') || ($('input_28').value == '8') || ($('input_28').value == '10') || ($('input_28').value == '11') || ($('input_28').value == '12')) {
			ilosc = $('input_5').value;
			cenar=4.73
			cenarv=4.78
			if ($('input_28').value == '1'){ cena=(ilosc/16)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_28').value == '2'){ cena=(ilosc/16)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if ($('input_28').value == '3'){ cena=(ilosc/8)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_28').value == '4'){ cena=(ilosc/8)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if ($('input_28').value == '5'){ cena=(ilosc/4)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_28').value == '6'){ cena=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if ($('input_28').value == '7'){ cena=(ilosc/2)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_28').value == '8'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if ($('input_28').value == '9'){ cena=(ilosc/6)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_28').value == '10'){ cena=(ilosc/6)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if ($('input_28').value == '11'){ cena=(ilosc/1)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_28').value == '12'){ cena=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena*=0.75;}
		}
	}
	

	if ($('input_32').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_32').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_32').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}
	if ($('input_33').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_33').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_33').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}
	if ($('input_34').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_34').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_34').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}
	if ($('input_35').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_35').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_35').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}

	opis += '<br />- '+ilosc+' flyers';

	var ktodaje;
	if ($('input_41').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_41').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_42').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_42').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_43').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_43').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_44').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_44').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	
	
	var rush24p = $$('#rush24p').collect(function(e){ return e.checked; }).any();
	if (rush24p == true) {
		cena *= 1.5;
		opis += '<br />- Délai rush24';
	}
	var economique = $$('#economique').collect(function(e){ return e.checked; }).any();
	if (economique == true) {
		cena *= 0.70;
		opis += '<br />- Délai économique';
	}
	
	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		cena += 5.00;
		opis += '<br />- relais colis';
	}
	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		opis += '<br />- colis revendeur';
	}
	
	
	
	if (ilosc == '10') {transport=7.5;}
	if (ilosc == '25') {transport=7.5;}
	if (ilosc == '50') {transport=7.5;}
	if (ilosc == '100') {transport=7.5;}
	if (ilosc == '250') {transport=7.5;}
	if (ilosc == '500') {transport=7.5;}
	if (ilosc == '1000') {transport=7.5;}
	if (ilosc == '1500') {transport=7.5;}
	if (ilosc == '2000') {transport=7.5;}
	if (ilosc == '2500') {transport=7.5;}
	if (ilosc == '3000') {transport=7.5;}
	if (ilosc == '5000') {transport=7.5;}
	if (ilosc == '7500') {transport=7.5;}
	if (ilosc == '10000') {transport=9.5;}
	if (ilosc == '15000') {transport=9.5;}
	if (ilosc == '20000') {transport=11.5;}
	if (ilosc == '25000') {transport=11.5;}
	if (ilosc == '30000') {transport=13.5;}
	if (ilosc == '40000') {transport=15.5;}
	if (ilosc == '50000') {transport=17.5;}
	if (ilosc == '75000') {transport=19.5;}
	if (ilosc == '100000') {transport=23.5;}
	
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
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
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
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
	
	
	

	var rodzaj = $('input_1').value;

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},

cal_depliants: function(){  
var cena=0; var cena2=0; var cena1=0; var cenar=0; var cenarv=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';
var niepokazuj = 0;
var option2=0;
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';

	if (($('input_1').value == 'depliants 80g') || ($('input_1').value == 'depliants 135g') || ($('input_1').value == 'depliants 170g') || ($('input_1').value == 'depliants 250g')){
	if ($('input_1').value == 'depliants 80g') {
		if ($('input_21').value == '1'){ opis += '- 19,8x21cm ouvert -> 9,9x21cm fermé';}
		if ($('input_21').value == '2'){ opis += '- A3 ouvert -> A4 fermé';}
		if ($('input_21').value == '3'){ opis += '- A4 ouvert -> A5 fermé';}
		if ($('input_21').value == '4'){ opis += '- A4 ouvert -> 3 volets 10x21cm fermé';}
		if ($('input_21').value == '5'){ opis += '- A5 ouvert -> A6 fermé';}

		if (($('input_21').value == '1') || ($('input_21').value == '2') || ($('input_21').value == '3') || ($('input_21').value == '4') || ($('input_21').value == '5')) {
			ilosc = $('input_5').value;
			cenar=0.17
			cenarv=0.22
			if ($('input_21').value == '1'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri<br />- Couché Mat';}
			if ($('input_21').value == '2'){ cena=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri<br />- Couché Mat';}
			if ($('input_21').value == '3'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri<br />- Couché Mat';}
			if ($('input_21').value == '4'){ cena=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri<br />- Couché Mat';}
			if ($('input_21').value == '5'){ cena=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 80g | Quadri<br />- Couché Mat';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena*=0.75;}
		}
	}
	
	if ($('input_1').value == 'depliants 135g') {
		if ($('input_22').value == '1'){ opis += '- Double DIN long plié (19,8 x 21 cm ouvert)';}
		if ($('input_22').value == '2'){ opis += '- DIN A3 plié en Din A4';}
		if ($('input_22').value == '3'){ opis += '- A4 ouvert -> A5 fermé';}
		if ($('input_22').value == '4'){ opis += '- A4 ouvert -> 3 volets 10x21cm fermé';}
		if ($('input_22').value == '5'){ opis += '- A5 ouvert -> A6 fermé';}
		if (($('input_22').value == '1') || ($('input_22').value == '2') || ($('input_22').value == '3') || ($('input_22').value == '4') || ($('input_22').value == '5')) {
			ilosc = $('input_5').value;
			cenar=0.22
			cenarv=0.27
			if ($('input_22').value == '1'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '2'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '3'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '4'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ($('input_22').value == '5'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 135g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	if ($('input_1').value == 'depliants 170g') {
		if ($('input_23').value == '1'){ opis += '- Double DIN long plié (19,8 x 21 cm ouvert)';}
		if ($('input_23').value == '2'){ opis += '- DIN A3 plié en Din A4';}
		if ($('input_23').value == '3'){ opis += '- A4 ouvert -> A5 fermé';}
		if ($('input_23').value == '4'){ opis += '- A4 ouvert -> 3 volets 10x21cm fermé';}
		if ($('input_23').value == '5'){ opis += '- A5 ouvert -> A6 fermé';}
		if (($('input_23').value == '1') || ($('input_23').value == '2') || ($('input_23').value == '3') || ($('input_23').value == '4') || ($('input_23').value == '5')) {
			ilosc = $('input_5').value;
			cenar=0.27
			cenarv=0.32
			if ($('input_23').value == '1'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '2'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '3'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '4'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ($('input_23').value == '5'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 170g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	if ($('input_1').value == 'depliants 250g') {
		if ($('input_24').value == '1'){ opis += '- Double DIN long plié (19,8 x 21 cm ouvert)';}
		if ($('input_24').value == '2'){ opis += '- DIN A3 plié en Din A4';}
		if ($('input_24').value == '3'){ opis += '- A4 ouvert -> A5 fermé';}
		if ($('input_24').value == '4'){ opis += '- A4 ouvert -> 3 volets 10x21cm fermé';}
		if ($('input_24').value == '5'){ opis += '- A5 ouvert -> A6 fermé';}
		if (($('input_24').value == '1') || ($('input_24').value == '2') || ($('input_24').value == '3') || ($('input_24').value == '4') || ($('input_24').value == '5')) {
			ilosc = $('input_5').value;
			cenar=0.32
			cenarv=0.37
			if ($('input_24').value == '1'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '2'){ cena1=(ilosc/1)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '3'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '4'){ cena1=(ilosc/2)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ($('input_24').value == '5'){ cena1=(ilosc/4)*cenarv; opis += '<br />- Recto/Verso<br />- 250g | Quadri';}
			if ((ilosc == '10') || (ilosc == '25') || (ilosc == '50') || (ilosc == '100') || (ilosc == '250')){ cena1*=1.15;}
			if ((ilosc == '5000') || (ilosc == '7500') || (ilosc == '10000')){ cena1*=0.95;}
			if ((ilosc == '15000') || (ilosc == '20000')){ cena1*=0.90;}
			if ((ilosc == '25000') || (ilosc == '30000')){ cena1*=0.85;}
			if ((ilosc == '40000') || (ilosc == '50000')){ cena1*=0.80;}
			if ((ilosc == '75000') || (ilosc == '100000')){ cena1*=0.75;}
		}
	}
	
	
	if ($('input_32').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_32').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_32').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}
	if ($('input_33').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_33').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_33').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}
	if ($('input_34').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_34').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_34').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}


	opis += '<br />- '+ilosc+' depliants';

	var ktodaje;
	if ($('input_41').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_41').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_42').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_42').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	
	
	var rush24p = $$('#rush24p').collect(function(e){ return e.checked; }).any();
	if (rush24p == true) {
		cena *= 1.5;
		opis += '<br />- Délai rush24';
	}
	var economique = $$('#economique').collect(function(e){ return e.checked; }).any();
	if (economique == true) {
		cena *= 0.70;
		opis += '<br />- Délai économique';
	}
	
	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		cena += 5.00;
		opis += '<br />- relais colis';
	}
	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		opis += '<br />- colis revendeur';
	}
	var colis = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		opis += '<br />- relais colis';
		cena += 5.00;
	}
	

	
	if (ilosc == '10') {transport=7.5;}
	if (ilosc == '25') {transport=7.5;}
	if (ilosc == '50') {transport=7.5;}
	if (ilosc == '100') {transport=7.5;}
	if (ilosc == '250') {transport=7.5;}
	if (ilosc == '500') {transport=7.5;}
	if (ilosc == '1000') {transport=7.5;}
	if (ilosc == '1500') {transport=7.5;}
	if (ilosc == '2000') {transport=7.5;}
	if (ilosc == '2500') {transport=7.5;}
	if (ilosc == '3000') {transport=7.5;}
	if (ilosc == '5000') {transport=7.5;}
	if (ilosc == '7500') {transport=7.5;}
	if (ilosc == '10000') {transport=9.5;}
	if (ilosc == '15000') {transport=9.5;}
	if (ilosc == '20000') {transport=11.5;}
	if (ilosc == '25000') {transport=11.5;}
	if (ilosc == '30000') {transport=13.5;}
	if (ilosc == '40000') {transport=15.5;}
	if (ilosc == '50000') {transport=17.5;}
	if (ilosc == '75000') {transport=19.5;}
	if (ilosc == '100000') {transport=23.5;}
	
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}

    if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
           opis += "<br />- Livraison gratuite avec FEDEX";
           transport = 0;
    }
	
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
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
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
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
	
	
	

	var rodzaj = $('input_1').value;

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},



cal_papier: function(){  
var cena=0; var cena2=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';

if ( 
( ($('input_1').value) && ( ($('input_2').value) || ($('input_3').value) ) && ($('input_4').value) ) 
|| ( ($('input_001').value) && ($('input_002').value) && ( ($('input_003').value) || ($('input_004').value) || ($('input_005').value) ) )
|| ( ($('input_221').value) && ($('input_222').value) && ( ($('input_223').value) || ($('input_224').value) || ($('input_225').value) || ($('input_226').value) || ($('input_227').value) || ($('input_228').value) || ($('input_229').value) || ($('input_2210').value) ) )
)
{
if ($('input_1').value == 'Affiches') {
	opis = '- Quadri Recto<br />- CB. 135g<br />- Coupe';
	if ($('input_221').value == '1') {
		ilosc = $('input_223').value;
		if (ilosc == '100') { cena=112.05; transport=12.9;}
		if (ilosc == '200') { cena=118.8; transport=12.9;}
		if (ilosc == '300') { cena=121.5; transport=12.9;}
		if (ilosc == '400') { cena=129.6; transport=12.9;}
		if (ilosc == '500') { cena=135; transport=15.9;}
		if (ilosc == '600') { cena=143.1; transport=15.9;}
		if (ilosc == '700') { cena=152.55; transport=15.9;}
		if (ilosc == '800') { cena=156.6; transport=15.9;}
		if (ilosc == '900') { cena=159.3; transport=15.9;}
		if (ilosc == '1000') { cena=163.35; transport=17.5;}
		if (ilosc == '1500') { cena=187.65; transport=17.5;}
		if (ilosc == '2000') { cena=218.7; transport=18.9;}
		if (ilosc == '2500') { cena=286.2; transport=18.9;}
		if (ilosc == '3000') { cena=297; transport=18.9;}
		if (ilosc == '3500') { cena=317.25; transport=18.9;}
		if (ilosc == '4000') { cena=344.25; transport=20.5;}
		if (ilosc == '5000') { cena=409.05; transport=21.5;}
		if (ilosc == '10000') { cena=540; transport=38.1;}
		if (ilosc == '15000') { cena=742.5; transport=41;}
		opis += '<br />- 17 x 50 cm';
	}
	if ($('input_221').value == '2') {
		ilosc = $('input_224').value;
		if (ilosc == '1000') { cena=191.7; transport=17.5;}
		if (ilosc == '2000') { cena=232.2; transport=18.9;}
		if (ilosc == '3000') { cena=272.7; transport=18.9;}
		if (ilosc == '4000') { cena=364.5; transport=20.5;}
		if (ilosc == '5000') { cena=388.8; transport=21.5;}
		if (ilosc == '10000') { cena=561.6; transport=38.1;}
		if (ilosc == '15000') { cena=772.2; transport=41;}
		if (ilosc == '20000') { cena=1074.6; transport=41;}
		if (ilosc == '30000') { cena=1482.3; transport=41;}
		opis += '<br />- A4 (21 x 29.7 cm)';
	}
	if ($('input_221').value == '3') {
		ilosc = $('input_225').value;
		if (ilosc == '100') { cena=135; transport=12.9;}
		if (ilosc == '200') { cena=144.45; transport=12.9;}
		if (ilosc == '300') { cena=151.2; transport=12.9;}
		if (ilosc == '400') { cena=157.95; transport=12.9;}
		if (ilosc == '500') { cena=163.35; transport=15.9;}
		if (ilosc == '600') { cena=172.8; transport=15.9;}
		if (ilosc == '700') { cena=180.9; transport=15.9;}
		if (ilosc == '800') { cena=187.95; transport=15.9;}
		if (ilosc == '900') { cena=190.35; transport=15.9;}
		if (ilosc == '1000') { cena=203.85; transport=17.5;}
		if (ilosc == '2000') { cena=278.1; transport=17.5;}
		if (ilosc == '2500') { cena=315.9; transport=18.9;}
		if (ilosc == '3000') { cena=353.7; transport=18.9;}
		if (ilosc == '3500') { cena=391.5; transport=18.9;}
		if (ilosc == '4000') { cena=429.3; transport=18.9;}
		if (ilosc == '5000') { cena=481.95; transport=20.5;}
		if (ilosc == '10000') { cena=722.25; transport=21.5;}
		if (ilosc == '15000') { cena=978.75; transport=38.1;}
		opis += '<br />- A3 (29.7 x 42 cm)';
	}
	if ($('input_221').value == '4') {
		ilosc = $('input_226').value;
		if (ilosc == '100') { cena=149.85; transport=12.9;}
		if (ilosc == '200') { cena=157.95; transport=12.9;}
		if (ilosc == '300') { cena=163.35; transport=12.9;}
		if (ilosc == '400') { cena=174.15; transport=12.9;}
		if (ilosc == '500') { cena=180.9; transport=15.9;}
		if (ilosc == '600') { cena=190.35; transport=15.9;}
		if (ilosc == '700') { cena=199.8; transport=15.9;}
		if (ilosc == '800') { cena=207.9; transport=15.9;}
		if (ilosc == '900') { cena=217.35; transport=15.9;}
		if (ilosc == '1000') { cena=225.45; transport=17.5;}
		if (ilosc == '1500') { cena=268.65; transport=17.5;}
		if (ilosc == '2000') { cena=313.2; transport=18.9;}
		if (ilosc == '2500') { cena=357.75; transport=18.9;}
		if (ilosc == '3000') { cena=400.95; transport=18.9;}
		if (ilosc == '3500') { cena=445.5; transport=18.9;}
		if (ilosc == '4000') { cena=488.7; transport=20.5;}
		if (ilosc == '5000') { cena=540; transport=21.5;}
		if (ilosc == '10000') { cena=776.25; transport=38.1;}
		if (ilosc == '15000') { cena=1066.5; transport=41;}
		opis += '<br />- 35 x 50 cm';
	}
	if ($('input_221').value == '5') {
		ilosc = $('input_227').value;
		if (ilosc == '100') { cena=217.35; transport=12.9;}
		if (ilosc == '200') { cena=245.7; transport=12.9;}
		if (ilosc == '300') { cena=259.2; transport=12.9;}
		if (ilosc == '400') { cena=267.3; transport=12.9;}
		if (ilosc == '500') { cena=270; transport=15.9;}
		if (ilosc == '600') { cena=294.3; transport=15.9;}
		if (ilosc == '700') { cena=307.8; transport=15.9;}
		if (ilosc == '800') { cena=328.05; transport=15.9;}
		if (ilosc == '900') { cena=334.8; transport=15.9;}
		if (ilosc == '1000') { cena=341.55; transport=17.5;}
		if (ilosc == '2000') { cena=491.4; transport=17.5;}
		if (ilosc == '2500') { cena=546.75; transport=18.9;}
		if (ilosc == '3000') { cena=610.2; transport=18.9;}
		if (ilosc == '3500') { cena=683.1; transport=18.9;}
		if (ilosc == '4000') { cena=751.95; transport=18.9;}
		if (ilosc == '5000') { cena=789.75; transport=20.5;}
		if (ilosc == '10000') { cena=1151.55; transport=21.5;}
		if (ilosc == '15000') { cena=1678.05; transport=38.1;}
		opis += '<br />- A2 (40 x 60 cm)';
	}
	if ($('input_221').value == '6') {
		ilosc = $('input_228').value;
		if (ilosc == '100') { cena=249.75; transport=12.9;}
		if (ilosc == '200') { cena=283.5; transport=12.9;}
		if (ilosc == '300') { cena=297; transport=12.9;}
		if (ilosc == '400') { cena=310.5; transport=12.9;}
		if (ilosc == '500') { cena=317.25; transport=15.9;}
		if (ilosc == '600') { cena=351; transport=15.9;}
		if (ilosc == '700') { cena=364.5; transport=15.9;}
		if (ilosc == '800') { cena=371.25; transport=15.9;}
		if (ilosc == '900') { cena=384.75; transport=15.9;}
		if (ilosc == '1000') { cena=391.5; transport=17.5;}
		if (ilosc == '1500') { cena=479.25; transport=17.5;}
		if (ilosc == '2000') { cena=540; transport=18.9;}
		if (ilosc == '2500') { cena=600.75; transport=18.9;}
		if (ilosc == '3000') { cena=668.25; transport=18.9;}
		if (ilosc == '4000') { cena=830.25; transport=18.9;}
		if (ilosc == '5000') { cena=924.75; transport=20.5;}
		if (ilosc == '10000') { cena=1377; transport=21.5;}
		if (ilosc == '15000') { cena=2033.1; transport=38.1;}
		opis += '<br />- 50 x 70 cm';
	}
	if ($('input_221').value == '7') {
		ilosc = $('input_229').value;
		if (ilosc == '100') { cena=391.5; transport=12.9;}
		if (ilosc == '200') { cena=418.5; transport=12.9;}
		if (ilosc == '300') { cena=452.25; transport=12.9;}
		if (ilosc == '400') { cena=472.5; transport=12.9;}
		if (ilosc == '500') { cena=499.5; transport=15.9;}
		if (ilosc == '600') { cena=526.5; transport=15.9;}
		if (ilosc == '700') { cena=567; transport=15.9;}
		if (ilosc == '800') { cena=607.5; transport=15.9;}
		if (ilosc == '900') { cena=621; transport=15.9;}
		if (ilosc == '1000') { cena=648; transport=17.5;}
		if (ilosc == '1500') { cena=783; transport=17.5;}
		if (ilosc == '2000') { cena=904.5; transport=18.9;}
		if (ilosc == '2500') { cena=1039.5; transport=18.9;}
		if (ilosc == '3000') { cena=1188; transport=18.9;}
		if (ilosc == '3500') { cena=1485; transport=18.9;}
		if (ilosc == '4000') { cena=1498.5; transport=20.5;}
		if (ilosc == '5000') { cena=1694.25; transport=21.5;}
		if (ilosc == '10000') { cena=2578.5; transport=38.1;}
		if (ilosc == '15000') { cena=3836.7; transport=41;}
		opis += '<br />- A1 (60 x 80 cm)';
	}
	if ($('input_221').value == '8') {
		ilosc = $('input_2210').value;
		if (ilosc == '100') { cena=479.25; transport=15.9;}
		if (ilosc == '200') { cena=500.85; transport=15.9;}
		if (ilosc == '300') { cena=546.75; transport=15.9;}
		if (ilosc == '400') { cena=569.7; transport=15.9;}
		if (ilosc == '500') { cena=603.45; transport=17.5;}
		if (ilosc == '600') { cena=648; transport=17.5;}
		if (ilosc == '700') { cena=669.6; transport=18.9;}
		if (ilosc == '800') { cena=700.65; transport=18.9;}
		if (ilosc == '900') { cena=735.75; transport=18.9;}
		if (ilosc == '1000') { cena=756; transport=18.9;}
		if (ilosc == '2000') { cena=988.2; transport=20.5;}
		if (ilosc == '3000') { cena=1433.7; transport=21.5;}
		if (ilosc == '4000') { cena=1661.85; transport=38.1;}
		if (ilosc == '5000') { cena=1888.65; transport=41;}
		opis += '<br />- 70 x 100cm';
	}
	opis += '<br />- '+ilosc+'pc';

	var ktodaje;
	if ($('input_222').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_222').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	
	if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
		opis += "<br />- Livraison gratuite avec FEDEX";
		transport = 0;
	}	
	
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Affiches" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

if ($('input_1').value == 'Cartes') {
	if ($('input_001').value == '1') {
		ilosc = $('input_003').value;
		if (ilosc == '1000') {
			cena=47.25;
		}
		if (ilosc == '2000') {
			cena=87.75;
		}
		if (ilosc == '3000') {
			cena=121.5;
		}
		if (ilosc == '5000') {
			cena=175.5;
		}
		opis = '- Recto Coupe<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}
	if ($('input_001').value == '2') {
		ilosc = $('input_004').value;
		if (ilosc == '1000') {
			cena=49.95;
		}
		if (ilosc == '2000') {
			cena=90.45;
		}
		if (ilosc == '3000') {
			cena=121.5;
		}
		opis = '- Recto/Verso Coupe<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}
	if ($('input_001').value == '3') {
		ilosc = $('input_005').value;
		if (ilosc == '1000') {
			cena=81.00;
		}
		if (ilosc == '2000') {
			cena=155.25;
		}
		if (ilosc == '5000') {
			cena=243.00;
		}
		opis = '- Recto/Verso Coupe<br />- Pelliculage<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}

	var ktodaje;
	if ($('input_002').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_002').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';


/* koszty transportu */	
	if (ilosc=='1000') { transport=12.9; }
	if (ilosc=='2000') { transport=15.9; }
	if (ilosc=='3000') { transport=15.9; }
	if (ilosc=='5000') { transport=18.9; }
/* /koszty transportu */	

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Cartes de Visites" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

if ( ($('input_1').value == 'depliants') || ($('input_1').value == 'Dépliants') ){

if ($('input_1').value == 'depliants') {
	if ($('input_2').value == '1') {
		ilosc = $('input_5').value;
		if (ilosc == '1000') { cena=108; transport=12.9;}
		if (ilosc == '2500') { cena=110.7; transport=12.9;}
		if (ilosc == '5000') { cena=135; transport=15.9;}
		if (ilosc == '10000') { cena=216; transport=15.9;}
		if (ilosc == '15000') { cena=283.5; transport=15.9;}
		if (ilosc == '20000') { cena=364.5; transport=18.9;}
		if (ilosc == '25000') { cena=405; transport=18.9;}
		if (ilosc == '30000') { cena=513; transport=21;}
		if (ilosc == '50000') { cena=594; transport=27.5;}
		if (ilosc == '75000') { cena=911.25; transport=38.1;}
		if (ilosc == '100000') { cena=1181.25; transport=41;}
		opis += '- Recto<br />- CB. 135g. Coupe<br />- Quadri<br />- A6 (10 x 15 cm)';
	}
	if ($('input_2').value == '2') {
		ilosc = $('input_6').value;
		if (ilosc == '1000') { cena=94.5; transport=12.9;}
		if (ilosc == '2000') { cena=101.25; transport=12.9;}
		if (ilosc == '3000') { cena=126.9; transport=12.9;}
		if (ilosc == '4000') { cena=130.95; transport=15.9;}
		if (ilosc == '5000') { cena=137.7; transport=15.9;}
		if (ilosc == '6000') { cena=172.8; transport=15.9;}
		if (ilosc == '7000') { cena=187.65; transport=17.1;}
		if (ilosc == '8000') { cena=202.5; transport=17.1;}
		if (ilosc == '9000') { cena=213.3; transport=18.9;}
		if (ilosc == '10000') { cena=222.75; transport=18.9;}
		if (ilosc == '11000') { cena=248.4; transport=18.9;}
		if (ilosc == '12000') { cena=263.25; transport=18.9;}
		if (ilosc == '13000') { cena=283.5; transport=21;}
		if (ilosc == '14000') { cena=290.25; transport=21;}
		if (ilosc == '15000') { cena=297; transport=21;}
		if (ilosc == '16000') { cena=330.75; transport=21;}
		if (ilosc == '17000') { cena=348.3; transport=22;}
		if (ilosc == '18000') { cena=364.5; transport=22;}
		if (ilosc == '19000') { cena=373.95; transport=23;}
		if (ilosc == '20000') { cena=384.75; transport=25.5;}
		if (ilosc == '25000') { cena=418.5; transport=26;}
		if (ilosc == '30000') { cena=519.75; transport=27.5;}
		if (ilosc == '35000') { cena=567; transport=28;}
		if (ilosc == '40000') { cena=607.5; transport=28.5;}
		if (ilosc == '45000') { cena=654.75; transport=31.1;}
		if (ilosc == '50000') { cena=715.5; transport=33;}
		opis += '- Recto/Verso<br />- CB. 135g. Coupe<br />- Quadri<br />- A6 (10 x 15 cm)';
	}	
	if ($('input_2').value == '3') {
		ilosc = $('input_7').value;
		if (ilosc == '500') { cena=87.75; transport=12.9;}
		if (ilosc == '1000') { cena=105.3; transport=12.9;}
		if (ilosc == '2000') { cena=128.25; transport=12.9;}
		if (ilosc == '3000') { cena=162; transport=15.9;}
		if (ilosc == '4000') { cena=182.25; transport=15.9;}
		if (ilosc == '5000') { cena=209.25; transport=17.5;}
		if (ilosc == '7000') { cena=290.25; transport=17.5;}
		if (ilosc == '10000') { cena=403.65; transport=18.9;}
		if (ilosc == '20000') { cena=638.55; transport=21;}
		if (ilosc == '25000') { cena=737.1; transport=24;}
		if (ilosc == '50000') { cena=1228.5; transport=28.9;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Quadri<br />- A6 (10 x 15 cm)';
	}
	if ($('input_2').value == '4') {
		ilosc = $('input_8').value;
		if (ilosc == '1000') { cena=112.05; transport=12.9;}
		if (ilosc == '2000') { cena=152.55; transport=12.9;}
		if (ilosc == '3000') { cena=182.25; transport=12.9;}
		if (ilosc == '4000') { cena=220.05; transport=15.9;}
		if (ilosc == '5000') { cena=236.25; transport=15.9;}
		if (ilosc == '7000') { cena=310.5; transport=17.5;}
		if (ilosc == '10000') { cena=459; transport=17.5;}
		if (ilosc == '15000') { cena=621; transport=18.9;}
		if (ilosc == '20000') { cena=769.5; transport=21;}
		if (ilosc == '25000') { cena=904.5; transport=24;}
		if (ilosc == '50000') { cena=1620; transport=28.9;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Pelliculage<br />- Quadri<br />- A6 (10 x 15 cm)';
	}
	if ($('input_2').value == '5') {
		ilosc = $('input_9').value;
		if (ilosc == '1000') { cena=110.7; transport=12.9;}
		if (ilosc == '2000') { cena=133.65; transport=12.9;}
		if (ilosc == '3000') { cena=155.25; transport=12.9;}
		if (ilosc == '4000') { cena=178.2; transport=15.9;}
		if (ilosc == '5000') { cena=199.8; transport=15.9;}
		if (ilosc == '6000') { cena=221.4; transport=15.9;}
		if (ilosc == '7000') { cena=241.65; transport=17.1;}
		if (ilosc == '8000') { cena=259.2; transport=17.1;}
		if (ilosc == '9000') { cena=282.15; transport=18.9;}
		if (ilosc == '10000') { cena=291.6; transport=18.9;}
		if (ilosc == '11000') { cena=322.65; transport=18.9;}
		if (ilosc == '12000') { cena=344.25; transport=18.9;}
		if (ilosc == '13000') { cena=365.85; transport=21;}
		if (ilosc == '14000') { cena=379.35; transport=21;}
		if (ilosc == '15000') { cena=387.45; transport=21;}
		if (ilosc == '16000') { cena=425.25; transport=21;}
		if (ilosc == '17000') { cena=442.8; transport=22;}
		if (ilosc == '18000') { cena=457.65; transport=22;}
		if (ilosc == '19000') { cena=472.5; transport=23;}
		if (ilosc == '20000') { cena=499.5; transport=25.5;}
		if (ilosc == '25000') { cena=519.75; transport=26;}
		if (ilosc == '30000') { cena=641.25; transport=27.5;}
		opis += '- Recto<br />- CB. 135g. Coupe<br />- Quadri<br />- 10 x 20 cm';
	}	
	if ($('input_2').value == '6') {
		ilosc = $('input_10').value;
		if (ilosc == '2500') { cena=159.3; transport=15.9;}
		if (ilosc == '3000') { cena=163.35; transport=15.9;}
		if (ilosc == '5000') { cena=186.3; transport=17.5;}
		if (ilosc == '10000') { cena=256.5; transport=17.5;}
		if (ilosc == '15000') { cena=341.55; transport=18.9;}
		if (ilosc == '20000') { cena=403.65; transport=21;}
		if (ilosc == '25000') { cena=479.25; transport=24;}
		if (ilosc == '30000') { cena=523.8; transport=28.9;}
		if (ilosc == '50000') { cena=796.5; transport=31;}
		if (ilosc == '100000') { cena=1424.25; transport=38.1;}
		opis += '- Recto/Verso<br />- CB. 135g. Coupe<br />- Quadri<br />- 10 x 20 cm';
	}
	if ($('input_2').value == '7') {
		ilosc = $('input_11').value;
		if (ilosc == '1000') { cena=128.25; transport=12.9;}
		if (ilosc == '2000') { cena=155.25; transport=15.9;}
		if (ilosc == '3000') { cena=222.75; transport=15.9;}
		if (ilosc == '4000') { cena=283.5; transport=17.5;}
		if (ilosc == '5000') { cena=317.25; transport=18.9;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Quadri<br />- 10 x 20 cm';
	}
	if ($('input_2').value == '8') {
		ilosc = $('input_12').value;
		if (ilosc == '1000') { cena=182.25; transport=12.9;}
		if (ilosc == '2000') { cena=209.25; transport=15.9;}
		if (ilosc == '3000') { cena=263.25; transport=15.9;}
		if (ilosc == '4000') { cena=364.5; transport=17.5;}
		if (ilosc == '5000') { cena=425.25; transport=18.9;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Pelliculage<br />- Quadri<br />- 10 x 20 cm';
	}
	if ($('input_2').value == '9') {
		ilosc = $('input_13').value;
		if (ilosc == '1000') { cena=120.15; transport=12.9;}
		if (ilosc == '2500') { cena=168.75; transport=14;}
		if (ilosc == '4000') { cena=209.25; transport=14.5;}
		if (ilosc == '5000') { cena=216; transport=14.5;}
		if (ilosc == '7000') { cena=283.5; transport=15;}
		if (ilosc == '10000') { cena=344.25; transport=15.9;}
		if (ilosc == '15000') { cena=461.7; transport=15.9;}
		if (ilosc == '20000') { cena=526.5; transport=17.5;}
		if (ilosc == '25000') { cena=587.25; transport=17.5;}
		if (ilosc == '30000') { cena=688.5; transport=18.9;}
		if (ilosc == '35000') { cena=796.5; transport=21;}
		if (ilosc == '40000') { cena=843.75; transport=24;}
		if (ilosc == '45000') { cena=1005.75; transport=28.9;}
		if (ilosc == '50000') { cena=1066.5; transport=31;}
		if (ilosc == '100000') { cena=1950.75; transport=38.1;}
		opis += '- Recto<br />- CB. 135g. Coupe<br />- Quadri<br />- A5 (15 x 21 cm)';
	}
	if ($('input_2').value == '10') {
		ilosc = $('input_14').value;
		if (ilosc == '1000') { cena=148.5; transport=12.9;}
		if (ilosc == '2000') { cena=182.25; transport=12.9;}
		if (ilosc == '3000') { cena=202.5; transport=12.9;}
		if (ilosc == '4000') { cena=218.7; transport=15.9;}
		if (ilosc == '5000') { cena=234.9; transport=15.9;}
		if (ilosc == '6000') { cena=283.5; transport=15.9;}
		if (ilosc == '7000') { cena=311.85; transport=17.1;}
		if (ilosc == '8000') { cena=341.55; transport=17.1;}
		if (ilosc == '9000') { cena=371.25; transport=18.9;}
		if (ilosc == '10000') { cena=384.75; transport=18.9;}
		if (ilosc == '11000') { cena=422.55; transport=18.9;}
		if (ilosc == '12000') { cena=446.85; transport=18.9;}
		if (ilosc == '13000') { cena=469.8; transport=21;}
		if (ilosc == '14000') { cena=492.75; transport=21;}
		if (ilosc == '15000') { cena=523.8; transport=21;}
		if (ilosc == '16000') { cena=537.3; transport=21;}
		if (ilosc == '17000') { cena=562.95; transport=22;}
		if (ilosc == '18000') { cena=584.55; transport=22;}
		if (ilosc == '19000') { cena=591.3; transport=23;}
		if (ilosc == '20000') { cena=608.85; transport=25.5;}
		if (ilosc == '25000') { cena=622.35; transport=26;}
		if (ilosc == '30000') { cena=807.3; transport=27.5;}
		opis += '- Recto/Verso<br />- CB. 135g. Coupe<br />- Quadri<br />- A5 (15 x 21 cm)';
	}
	if ($('input_2').value == '11') {
		ilosc = $('input_15').value;
		if (ilosc == '1000') { cena=160.65; transport=12.9;}
		if (ilosc == '2000') { cena=195.75; transport=13.5;}
		if (ilosc == '3000') { cena=276.75; transport=14.5;}
		if (ilosc == '4000') { cena=309.15; transport=15.9;}
		if (ilosc == '5000') { cena=365.85; transport=15.9;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Quadri<br />- A5 (15 x 21 cm)';
	}
	if ($('input_2').value == '12') {
		ilosc = $('input_16').value;
		if (ilosc == '1000') { cena=189; transport=12.9;}
		if (ilosc == '2000') { cena=243; transport=13.5;}
		if (ilosc == '3000') { cena=297; transport=14.5;}
		if (ilosc == '4000') { cena=351; transport=15.9;}
		if (ilosc == '5000') { cena=432; transport=15.9;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Pelliculage<br />- Quadri<br />- A5 (15 x 21 cm)';
	}
	if ($('input_2').value == '13') {
		ilosc = $('input_17').value;
		if (ilosc == '2500') { cena=255.15; transport=14.9;}
		if (ilosc == '5000') { cena=307.8; transport=15.9;}
		if (ilosc == '10000') { cena=452.25; transport=18.1;}
		if (ilosc == '15000') { cena=573.75; transport=21;}
		if (ilosc == '20000') { cena=688.5; transport=22.9;}
		if (ilosc == '25000') { cena=762.75; transport=24;}
		if (ilosc == '30000') { cena=911.25; transport=28.1;}
		if (ilosc == '50000') { cena=1410.75; transport=31;}
		if (ilosc == '75000') { cena=1532.25; transport=37.9;}
		if (ilosc == '100000') { cena=1923.75; transport=41;}
		opis += '- Recto/Verso<br />- CB. 135g. Coupe<br />- Quadri<br />- 20 x 20 cm';
	}
	if ($('input_2').value == '14') {
		ilosc = $('input_18').value;
		if (ilosc == '1000') { cena=228.15; transport=12.9;}
		if (ilosc == '2000') { cena=324; transport=15.9;}
		if (ilosc == '3000') { cena=398.25; transport=16.9;}
		if (ilosc == '4000') { cena=479.25; transport=18.1;}
		if (ilosc == '5000') { cena=567; transport=21;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Quadri<br />- 20 x 20 cm';
	}
	if ($('input_2').value == '15') {
		ilosc = $('input_19').value;
		if (ilosc == '1000') { cena=270; transport=12.9;}
		if (ilosc == '2000') { cena=391.5; transport=15.9;}
		if (ilosc == '3000') { cena=513; transport=16.9;}
		if (ilosc == '4000') { cena=634.5; transport=18.1;}
		if (ilosc == '5000') { cena=729; transport=21;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Pelliculage<br />- Quadri<br />- 20 x 20 cm';
	}
	if ($('input_2').value == '16') {
		ilosc = $('input_20').value;
		if (ilosc == '1000') { cena=191.7; transport=12.9;}
		if (ilosc == '2000') { cena=232.2; transport=12.9;}
		if (ilosc == '3000') { cena=272.7; transport=12.9;}
		if (ilosc == '4000') { cena=364.5; transport=15.9;}
		if (ilosc == '5000') { cena=388.8; transport=15.9;}
		if (ilosc == '6000') { cena=405; transport=15.9;}
		if (ilosc == '7000') { cena=423.9; transport=17.1;}
		if (ilosc == '8000') { cena=483.3; transport=17.1;}
		if (ilosc == '9000') { cena=522.45; transport=18.9;}
		if (ilosc == '10000') { cena=561.6; transport=18.9;}
		if (ilosc == '11000') { cena=603.45; transport=18.9;}
		if (ilosc == '12000') { cena=645.3; transport=18.9;}
		if (ilosc == '13000') { cena=687.15; transport=21;}
		if (ilosc == '14000') { cena=697.95; transport=21;}
		if (ilosc == '15000') { cena=772.2; transport=21;}
		if (ilosc == '16000') { cena=931.5; transport=21;}
		if (ilosc == '17000') { cena=980.1; transport=22;}
		if (ilosc == '18000') { cena=1027.35; transport=22;}
		if (ilosc == '19000') { cena=1044.9; transport=23;}
		if (ilosc == '20000') { cena=1074.6; transport=25.5;}
		if (ilosc == '25000') { cena=1171.8; transport=26;}
		if (ilosc == '30000') { cena=1482.3; transport=27.5;}
		opis += '- Recto<br />- CB. 135g. Coupe<br />- Quadri<br />- A4 (21 x 29.7 cm)';
	}
	if ($('input_2').value == '17') {
		ilosc = $('input_21').value;
		if (ilosc == '1000') { cena=256.5; transport=12.9;}
		if (ilosc == '2500') { cena=290.25; transport=13.9;}
		if (ilosc == '5000') { cena=371.25; transport=15.5;}
		if (ilosc == '7000') { cena=511.65; transport=16.5;}
		if (ilosc == '10000') { cena=549.45; transport=18.1;}
		if (ilosc == '15000') { cena=803.25; transport=21;}
		if (ilosc == '20000') { cena=946.35; transport=23;}
		if (ilosc == '25000') { cena=1075.95; transport=25.5;}
		if (ilosc == '30000') { cena=1190.7; transport=27.5;}
		if (ilosc == '35000') { cena=1318.95; transport=29;}
		if (ilosc == '40000') { cena=1478.25; transport=31;}
		if (ilosc == '45000') { cena=1606.5; transport=33;}
		if (ilosc == '50000') { cena=1687.5; transport=38;}
		if (ilosc == '75000') { cena=2686.5; transport=39.5;}
		if (ilosc == '100000') { cena=3098.25; transport=41;}
		opis += '- Recto/Verso<br />- CB. 135g. Coupe<br />- Quadri<br />- A4 (21 x 29.7 cm)';
	}
	if ($('input_2').value == '18') {
		ilosc = $('input_22').value;
		if (ilosc == '1000') { cena=263.25; transport=12.9;}
		if (ilosc == '2000') { cena=364.5; transport=15.9;}
		if (ilosc == '3000') { cena=459; transport=16.9;}
		if (ilosc == '4000') { cena=553.5; transport=18.1;}
		if (ilosc == '5000') { cena=654.75; transport=21;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Quadri<br />- A4 (21 x 29.7 cm)';
	}
	if ($('input_2').value == '19') {
		ilosc = $('input_23').value;
		if (ilosc == '1000') { cena=310.5; transport=12.9;}
		if (ilosc == '2000') { cena=459; transport=15.9;}
		if (ilosc == '3000') { cena=594; transport=16.9;}
		if (ilosc == '4000') { cena=742.5; transport=18.1;}
		if (ilosc == '5000') { cena=864; transport=21;}
		opis += '- Recto/Verso<br />- CB. 350g. Coupe<br />- Pelliculage<br />- Quadri<br />- A4 (21 x 29.7 cm)';
	}
}
if ($('input_1').value == 'Dépliants') {
	if ($('input_3').value == '1') {
		ilosc = $('input_24').value;
		if (ilosc == '100') { cena=101.25; transport=12.9;}
		if (ilosc == '200') { cena=102.6; transport=12.9;}
		if (ilosc == '300') { cena=103.95; transport=14.5;}
		if (ilosc == '400') { cena=105.3; transport=14.5;}
		if (ilosc == '500') { cena=106.65; transport=15.9;}
		if (ilosc == '1000') { cena=108; transport=15.9;}
		if (ilosc == '2000') { cena=175.5; transport=16.5;}
		if (ilosc == '3000') { cena=216; transport=16.5;}
		if (ilosc == '4000') { cena=243; transport=17.1;}
		if (ilosc == '5000') { cena=222.75; transport=17.1;}
		if (ilosc == '6000') { cena=310.5; transport=18.5;}
		if (ilosc == '7000') { cena=330.75; transport=18.5;}
		if (ilosc == '8000') { cena=371.25; transport=19.5;}
		if (ilosc == '9000') { cena=405; transport=21;}
		if (ilosc == '10000') { cena=378; transport=22;}
		if (ilosc == '15000') { cena=519.75; transport=23;}
		if (ilosc == '20000') { cena=661.5; transport=24;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 135g. / 4 pages<br />- A5 (15 x 21 cm)';
	}
	if ($('input_3').value == '2') {
		ilosc = $('input_25').value;
		if (ilosc == '100') { cena=147.15; transport=12.9;}
		if (ilosc == '200') { cena=148.5; transport=12.9;}
		if (ilosc == '300') { cena=149.85; transport=14.5;}
		if (ilosc == '400') { cena=151.2; transport=14.5;}
		if (ilosc == '500') { cena=152.55; transport=15.9;}
		if (ilosc == '600') { cena=153.9; transport=15.9;}
		if (ilosc == '700') { cena=155.25; transport=16.5;}
		if (ilosc == '800') { cena=156.6; transport=16.5;}
		if (ilosc == '900') { cena=157.95; transport=17.1;}
		if (ilosc == '1000') { cena=159.3; transport=17.1;}
		if (ilosc == '2000') { cena=202.5; transport=18.5;}
		if (ilosc == '3000') { cena=243; transport=18.5;}
		if (ilosc == '4000') { cena=276.75; transport=19.5;}
		if (ilosc == '5000') { cena=351; transport=21;}
		if (ilosc == '6000') { cena=364.5; transport=22;}
		if (ilosc == '7000') { cena=391.5; transport=23;}
		if (ilosc == '8000') { cena=432; transport=24;}
		if (ilosc == '9000') { cena=438.75; transport=25;}
		if (ilosc == '10000') { cena=445.5; transport=27.5;}
		if (ilosc == '15000') { cena=540; transport=31.9;}
		if (ilosc == '20000') { cena=722.25; transport=38.1;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 170g. / 4 pages<br />- A5 (15 x 21 cm)';
	}
	if ($('input_3').value == '3') {
		ilosc = $('input_26').value;
		if (ilosc == '100') { cena=155.25; transport=12.9;}
		if (ilosc == '200') { cena=160.65; transport=12.9;}
		if (ilosc == '300') { cena=164.7; transport=14.5;}
		if (ilosc == '400') { cena=172.8; transport=14.5;}
		if (ilosc == '500') { cena=175.5; transport=15.9;}
		if (ilosc == '1000') { cena=189; transport=15.9;}
		if (ilosc == '2000') { cena=243; transport=16.5;}
		if (ilosc == '3000') { cena=297; transport=16.5;}
		if (ilosc == '4000') { cena=303.75; transport=17.1;}
		if (ilosc == '5000') { cena=378; transport=17.1;}
		if (ilosc == '6000') { cena=445.5; transport=18.5;}
		if (ilosc == '7000') { cena=499.5; transport=18.5;}
		if (ilosc == '8000') { cena=519.75; transport=19.5;}
		if (ilosc == '9000') { cena=540; transport=21;}
		if (ilosc == '10000') { cena=546.75; transport=22;}
		if (ilosc == '15000') { cena=742.5; transport=23;}
		if (ilosc == '20000') { cena=945; transport=24;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 135g. / 4 pages<br />- 20 x 20 cm';
	}
	if ($('input_3').value == '4') {
		ilosc = $('input_27').value;
		if (ilosc == '100') { cena=180.9; transport=12.9;}
		if (ilosc == '200') { cena=182.25; transport=12.9;}
		if (ilosc == '300') { cena=183.6; transport=14.5;}
		if (ilosc == '400') { cena=184.95; transport=14.5;}
		if (ilosc == '500') { cena=186.3; transport=15.9;}
		if (ilosc == '600') { cena=191.7; transport=15.9;}
		if (ilosc == '700') { cena=197.1; transport=16.5;}
		if (ilosc == '800') { cena=202.5; transport=16.5;}
		if (ilosc == '900') { cena=205.2; transport=17.1;}
		if (ilosc == '1000') { cena=207.9; transport=17.1;}
		if (ilosc == '2000') { cena=270; transport=18.5;}
		if (ilosc == '3000') { cena=330.75; transport=18.5;}
		if (ilosc == '4000') { cena=405; transport=19.5;}
		if (ilosc == '5000') { cena=472.5; transport=21;}
		if (ilosc == '6000') { cena=526.5; transport=22;}
		if (ilosc == '7000') { cena=594; transport=23;}
		if (ilosc == '8000') { cena=661.5; transport=24;}
		if (ilosc == '9000') { cena=675; transport=25;}
		if (ilosc == '10000') { cena=715.5; transport=27.5;}
		if (ilosc == '15000') { cena=918; transport=31.9;}
		if (ilosc == '20000') { cena=1161; transport=35;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 170g. / 4 pages<br />- 20 x 20 cm';
	}
	if ($('input_3').value == '5') {
		ilosc = $('input_28').value;
		if (ilosc == '100') { cena=121.5; transport=12.9;}
		if (ilosc == '200') { cena=141.75; transport=12.9;}
		if (ilosc == '300') { cena=155.25; transport=14.5;}
		if (ilosc == '400') { cena=168.75; transport=14.5;}
		if (ilosc == '500') { cena=182.25; transport=15.9;}
		if (ilosc == '1000') { cena=187.65; transport=15.9;}
		if (ilosc == '2000') { cena=249.75; transport=16.5;}
		if (ilosc == '2500') { cena=263.25; transport=16.5;}
		if (ilosc == '3000') { cena=283.5; transport=17.1;}
		if (ilosc == '4000') { cena=364.5; transport=17.1;}
		if (ilosc == '5000') { cena=405; transport=18.5;}
		if (ilosc == '6000') { cena=472.5; transport=18.5;}
		if (ilosc == '7000') { cena=519.75; transport=19.5;}
		if (ilosc == '8000') { cena=553.5; transport=21;}
		if (ilosc == '9000') { cena=560.25; transport=22;}
		if (ilosc == '10000') { cena=567; transport=23;}
		if (ilosc == '15000') { cena=776.25; transport=24;}
		if (ilosc == '20000') { cena=985.5; transport=25;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 135g. / 4 pages<br />- A4 (21 x 29.7 cm)';
	}
	if ($('input_3').value == '6') {
		ilosc = $('input_29').value;
		if (ilosc == '100') { cena=184.95; transport=12.9;}
		if (ilosc == '200') { cena=186.3; transport=12.9;}
		if (ilosc == '300') { cena=186.3; transport=14.5;}
		if (ilosc == '400') { cena=187.65; transport=14.5;}
		if (ilosc == '500') { cena=189; transport=15.9;}
		if (ilosc == '600') { cena=191.7; transport=15.9;}
		if (ilosc == '700') { cena=194.4; transport=16.5;}
		if (ilosc == '800') { cena=197.1; transport=16.5;}
		if (ilosc == '900') { cena=199.8; transport=17.1;}
		if (ilosc == '1000') { cena=201.15; transport=17.1;}
		if (ilosc == '2000') { cena=276.75; transport=18.5;}
		if (ilosc == '3000') { cena=337.5; transport=18.5;}
		if (ilosc == '4000') { cena=398.25; transport=19.5;}
		if (ilosc == '5000') { cena=438.75; transport=21;}
		if (ilosc == '6000') { cena=519.75; transport=22;}
		if (ilosc == '7000') { cena=580.5; transport=23;}
		if (ilosc == '8000') { cena=648; transport=24;}
		if (ilosc == '9000') { cena=668.25; transport=25;}
		if (ilosc == '10000') { cena=675; transport=26;}
		if (ilosc == '15000') { cena=918; transport=31;}
		if (ilosc == '20000') { cena=1167.75; transport=35;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 170g. / 4 pages<br />- A4 (21 x 29.7 cm)';
	}
	if ($('input_3').value == '7') {
		ilosc = $('input_30').value;
		if (ilosc == '100') { cena=189; transport=12.9;}
		if (ilosc == '200') { cena=224.1; transport=12.9;}
		if (ilosc == '300') { cena=263.25; transport=14.5;}
		if (ilosc == '400') { cena=297; transport=14.5;}
		if (ilosc == '500') { cena=310.5; transport=15.9;}
		if (ilosc == '1000') { cena=351; transport=15.9;}
		if (ilosc == '2000') { cena=459; transport=16.5;}
		if (ilosc == '3000') { cena=560.25; transport=16.5;}
		if (ilosc == '4000') { cena=661.5; transport=17.1;}
		if (ilosc == '5000') { cena=729; transport=17.1;}
		if (ilosc == '6000') { cena=810; transport=18.5;}
		if (ilosc == '7000') { cena=904.5; transport=18.5;}
		if (ilosc == '8000') { cena=999; transport=19.5;}
		if (ilosc == '9000') { cena=1093.5; transport=21;}
		if (ilosc == '10000') { cena=1188; transport=22;}
		if (ilosc == '15000') { cena=1620; transport=23;}
		if (ilosc == '20000') { cena=2092.5; transport=24;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 135g. / 4 pages<br />- A3 (29.7 x 42 cm)';
	}
	if ($('input_3').value == '8') {
		ilosc = $('input_31').value;
		if (ilosc == '100') { cena=270; transport=12.9;}
		if (ilosc == '200') { cena=283.5; transport=12.9;}
		if (ilosc == '300') { cena=297; transport=14.5;}
		if (ilosc == '400') { cena=310.5; transport=14.5;}
		if (ilosc == '500') { cena=317.25; transport=15.9;}
		if (ilosc == '1000') { cena=371.25; transport=15.9;}
		if (ilosc == '2000') { cena=486; transport=16.5;}
		if (ilosc == '3000') { cena=607.5; transport=16.5;}
		if (ilosc == '4000') { cena=722.25; transport=17.1;}
		if (ilosc == '5000') { cena=837; transport=17.1;}
		if (ilosc == '6000') { cena=958.5; transport=18.5;}
		if (ilosc == '7000') { cena=1080; transport=18.5;}
		if (ilosc == '8000') { cena=1188; transport=19.5;}
		if (ilosc == '9000') { cena=1309.5; transport=21;}
		if (ilosc == '10000') { cena=1424.5; transport=22;}
		if (ilosc == '15000') { cena=1998; transport=23;}
		if (ilosc == '20000') { cena=2571.75; transport=24;}
		opis += '- Quadri Recto/Verso Pliage<br />- CB. 170g. / 4 pages<br />- A3 (29.7 x 42 cm)';
	}
}

	opis += '<br />- '+ilosc+'pc';

	var ktodaje;
	if ($('input_4').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_4').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var rodzaj = $('input_1').value;

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

}

},




cal_affichescartes: function(){  
var cena=0; var cena2=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';

if ( ($('input_0').value == 'affiches') && ($('input_1').value) && ($('input_2').value) && ( ($('input_3').value) || ($('input_4').value) || ($('input_5').value) || ($('input_6').value) || ($('input_7').value) || ($('input_8').value) || ($('input_9').value) || ($('input_10').value) ) ) {
	opis = '- Quadri Recto<br />- CB. 135g<br />- Coupe';
	if ($('input_1').value == '1') {
		ilosc = $('input_3').value;
		if (ilosc == '100') { cena=112.05; transport=12.9;}
		if (ilosc == '200') { cena=118.8; transport=12.9;}
		if (ilosc == '300') { cena=121.5; transport=12.9;}
		if (ilosc == '400') { cena=129.6; transport=12.9;}
		if (ilosc == '500') { cena=135; transport=15.9;}
		if (ilosc == '600') { cena=143.1; transport=15.9;}
		if (ilosc == '700') { cena=152.55; transport=15.9;}
		if (ilosc == '800') { cena=156.6; transport=15.9;}
		if (ilosc == '900') { cena=159.3; transport=15.9;}
		if (ilosc == '1000') { cena=163.35; transport=17.5;}
		if (ilosc == '1500') { cena=187.65; transport=17.5;}
		if (ilosc == '2000') { cena=218.7; transport=18.9;}
		if (ilosc == '2500') { cena=286.2; transport=18.9;}
		if (ilosc == '3000') { cena=297; transport=18.9;}
		if (ilosc == '3500') { cena=317.25; transport=18.9;}
		if (ilosc == '4000') { cena=344.25; transport=20.5;}
		if (ilosc == '5000') { cena=409.05; transport=21.5;}
		if (ilosc == '10000') { cena=540; transport=38.1;}
		if (ilosc == '15000') { cena=742.5; transport=41;}
		opis += '<br />- 17 x 50 cm';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '2') {
		ilosc = $('input_4').value;
		if (ilosc == '1000') { cena=191.7; transport=17.5;}
		if (ilosc == '2000') { cena=232.2; transport=18.9;}
		if (ilosc == '3000') { cena=272.7; transport=18.9;}
		if (ilosc == '4000') { cena=364.5; transport=20.5;}
		if (ilosc == '5000') { cena=388.8; transport=21.5;}
		if (ilosc == '10000') { cena=561.6; transport=38.1;}
		if (ilosc == '15000') { cena=772.2; transport=41;}
		if (ilosc == '20000') { cena=1074.6; transport=41;}
		if (ilosc == '30000') { cena=1482.3; transport=41;}
		opis += '<br />- A4 (21 x 29.7 cm)';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '3') {
		ilosc = $('input_5').value;
		if (ilosc == '100') { cena=135; transport=12.9;}
		if (ilosc == '200') { cena=144.45; transport=12.9;}
		if (ilosc == '300') { cena=151.2; transport=12.9;}
		if (ilosc == '400') { cena=157.95; transport=12.9;}
		if (ilosc == '500') { cena=163.35; transport=15.9;}
		if (ilosc == '600') { cena=172.8; transport=15.9;}
		if (ilosc == '700') { cena=180.9; transport=15.9;}
		if (ilosc == '800') { cena=187.95; transport=15.9;}
		if (ilosc == '900') { cena=190.35; transport=15.9;}
		if (ilosc == '1000') { cena=203.85; transport=17.5;}
		if (ilosc == '2000') { cena=278.1; transport=17.5;}
		if (ilosc == '2500') { cena=315.9; transport=18.9;}
		if (ilosc == '3000') { cena=353.7; transport=18.9;}
		if (ilosc == '3500') { cena=391.5; transport=18.9;}
		if (ilosc == '4000') { cena=429.3; transport=18.9;}
		if (ilosc == '5000') { cena=481.95; transport=20.5;}
		if (ilosc == '10000') { cena=722.25; transport=21.5;}
		if (ilosc == '15000') { cena=978.75; transport=38.1;}
		opis += '<br />- A3 (29.7 x 42 cm)';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '4') {
		ilosc = $('input_6').value;
		if (ilosc == '100') { cena=149.85; transport=12.9;}
		if (ilosc == '200') { cena=157.95; transport=12.9;}
		if (ilosc == '300') { cena=163.35; transport=12.9;}
		if (ilosc == '400') { cena=174.15; transport=12.9;}
		if (ilosc == '500') { cena=180.9; transport=15.9;}
		if (ilosc == '600') { cena=190.35; transport=15.9;}
		if (ilosc == '700') { cena=199.8; transport=15.9;}
		if (ilosc == '800') { cena=207.9; transport=15.9;}
		if (ilosc == '900') { cena=217.35; transport=15.9;}
		if (ilosc == '1000') { cena=225.45; transport=17.5;}
		if (ilosc == '1500') { cena=268.65; transport=17.5;}
		if (ilosc == '2000') { cena=313.2; transport=18.9;}
		if (ilosc == '2500') { cena=357.75; transport=18.9;}
		if (ilosc == '3000') { cena=400.95; transport=18.9;}
		if (ilosc == '3500') { cena=445.5; transport=18.9;}
		if (ilosc == '4000') { cena=488.7; transport=20.5;}
		if (ilosc == '5000') { cena=540; transport=21.5;}
		if (ilosc == '10000') { cena=776.25; transport=38.1;}
		if (ilosc == '15000') { cena=1066.5; transport=41;}
		opis += '<br />- 35 x 50 cm';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '5') {
		ilosc = $('input_7').value;
		if (ilosc == '100') { cena=217.35; transport=12.9;}
		if (ilosc == '200') { cena=245.7; transport=12.9;}
		if (ilosc == '300') { cena=259.2; transport=12.9;}
		if (ilosc == '400') { cena=267.3; transport=12.9;}
		if (ilosc == '500') { cena=270; transport=15.9;}
		if (ilosc == '600') { cena=294.3; transport=15.9;}
		if (ilosc == '700') { cena=307.8; transport=15.9;}
		if (ilosc == '800') { cena=328.05; transport=15.9;}
		if (ilosc == '900') { cena=334.8; transport=15.9;}
		if (ilosc == '1000') { cena=341.55; transport=17.5;}
		if (ilosc == '2000') { cena=491.4; transport=17.5;}
		if (ilosc == '2500') { cena=546.75; transport=18.9;}
		if (ilosc == '3000') { cena=610.2; transport=18.9;}
		if (ilosc == '3500') { cena=683.1; transport=18.9;}
		if (ilosc == '4000') { cena=751.95; transport=18.9;}
		if (ilosc == '5000') { cena=789.75; transport=20.5;}
		if (ilosc == '10000') { cena=1151.55; transport=21.5;}
		if (ilosc == '15000') { cena=1678.05; transport=38.1;}
		opis += '<br />- A2 (40 x 60 cm)';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '6') {
		ilosc = $('input_8').value;
		if (ilosc == '100') { cena=249.75; transport=12.9;}
		if (ilosc == '200') { cena=283.5; transport=12.9;}
		if (ilosc == '300') { cena=297; transport=12.9;}
		if (ilosc == '400') { cena=310.5; transport=12.9;}
		if (ilosc == '500') { cena=317.25; transport=15.9;}
		if (ilosc == '600') { cena=351; transport=15.9;}
		if (ilosc == '700') { cena=364.5; transport=15.9;}
		if (ilosc == '800') { cena=371.25; transport=15.9;}
		if (ilosc == '900') { cena=384.75; transport=15.9;}
		if (ilosc == '1000') { cena=391.5; transport=17.5;}
		if (ilosc == '1500') { cena=479.25; transport=17.5;}
		if (ilosc == '2000') { cena=540; transport=18.9;}
		if (ilosc == '2500') { cena=600.75; transport=18.9;}
		if (ilosc == '3000') { cena=668.25; transport=18.9;}
		if (ilosc == '4000') { cena=830.25; transport=18.9;}
		if (ilosc == '5000') { cena=924.75; transport=20.5;}
		if (ilosc == '10000') { cena=1377; transport=21.5;}
		if (ilosc == '15000') { cena=2033.1; transport=38.1;}
		opis += '<br />- 50 x 70 cm';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '7') {
		ilosc = $('input_9').value;
		if (ilosc == '100') { cena=391.5; transport=12.9;}
		if (ilosc == '200') { cena=418.5; transport=12.9;}
		if (ilosc == '300') { cena=452.25; transport=12.9;}
		if (ilosc == '400') { cena=472.5; transport=12.9;}
		if (ilosc == '500') { cena=499.5; transport=15.9;}
		if (ilosc == '600') { cena=526.5; transport=15.9;}
		if (ilosc == '700') { cena=567; transport=15.9;}
		if (ilosc == '800') { cena=607.5; transport=15.9;}
		if (ilosc == '900') { cena=621; transport=15.9;}
		if (ilosc == '1000') { cena=648; transport=17.5;}
		if (ilosc == '1500') { cena=783; transport=17.5;}
		if (ilosc == '2000') { cena=904.5; transport=18.9;}
		if (ilosc == '2500') { cena=1039.5; transport=18.9;}
		if (ilosc == '3000') { cena=1188; transport=18.9;}
		if (ilosc == '3500') { cena=1485; transport=18.9;}
		if (ilosc == '4000') { cena=1498.5; transport=20.5;}
		if (ilosc == '5000') { cena=1694.25; transport=21.5;}
		if (ilosc == '10000') { cena=2578.5; transport=38.1;}
		if (ilosc == '15000') { cena=3836.7; transport=41;}
		opis += '<br />- A1 (60 x 80 cm)';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	if ($('input_1').value == '8') {
		ilosc = $('input_10').value;
		if (ilosc == '100') { cena=479.25; transport=15.9;}
		if (ilosc == '200') { cena=500.85; transport=15.9;}
		if (ilosc == '300') { cena=546.75; transport=15.9;}
		if (ilosc == '400') { cena=569.7; transport=15.9;}
		if (ilosc == '500') { cena=603.45; transport=17.5;}
		if (ilosc == '600') { cena=648; transport=17.5;}
		if (ilosc == '700') { cena=669.6; transport=18.9;}
		if (ilosc == '800') { cena=700.65; transport=18.9;}
		if (ilosc == '900') { cena=735.75; transport=18.9;}
		if (ilosc == '1000') { cena=756; transport=18.9;}
		if (ilosc == '2000') { cena=988.2; transport=20.5;}
		if (ilosc == '3000') { cena=1433.7; transport=21.5;}
		if (ilosc == '4000') { cena=1661.85; transport=38.1;}
		if (ilosc == '5000') { cena=1888.65; transport=41;}
		opis += '<br />- 70 x 100cm';
		var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	}
	opis += '<br />- '+ilosc+'pc';

	var ktodaje;
	if ($('input_2').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_2').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;

            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                opis += "<br />- Livraison gratuite avec FEDEX";
                transport = 0;
            }
	
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Affiches" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

if ( ($('input_0').value == 'cartes') && ($('input_12').value) && ($('input_13').value) && ( ($('input_14').value) || ($('input_15').value) || ($('input_16').value) ) ) {
	if ($('input_12').value == '1') {
		ilosc = $('input_14').value;
		if (ilosc == '1000') {
			cena=47.25;
		}
		if (ilosc == '2000') {
			cena=87.75;
		}
		if (ilosc == '3000') {
			cena=121.5;
		}
		if (ilosc == '5000') {
			cena=175.5;
		}
		opis = '- Recto Coupe<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}
	if ($('input_12').value == '2') {
		ilosc = $('input_15').value;
		if (ilosc == '1000') {
			cena=49.95;
		}
		if (ilosc == '2000') {
			cena=90.45;
		}
		if (ilosc == '3000') {
			cena=121.5;
		}
		opis = '- Recto/Verso Coupe<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}
	if ($('input_12').value == '3') {
		ilosc = $('input_16').value;
		if (ilosc == '1000') {
			cena=81.00;
		}
		if (ilosc == '2000') {
			cena=155.25;
		}
		if (ilosc == '5000') {
			cena=243.00;
		}
		opis = '- Recto/Verso Coupe<br />- Pelliculage<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}

	var ktodaje;
	if ($('input_13').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_13').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';


/* koszty transportu */	
	if (ilosc=='1000') { transport=12.9; }
	if (ilosc=='2000') { transport=15.9; }
	if (ilosc=='3000') { transport=15.9; }
	if (ilosc=='5000') { transport=18.9; }
/* /koszty transportu */	

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Cartes de Visites" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},

cal_affiches: function(){  
var cena=0; var cena2=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';

if (($('input_1').value == 'Affiches 130g') || ($('input_1').value == 'Affiches 150g') || ($('input_1').value == 'Affiches 220g')){
	if ($('input_1').value == 'Affiches 130g') {
		if ($('input_21').value == '1'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*0.25*18; transport=11.9;}
		if (ilosc == '5') { cena=5*0.25*16; transport=11.9;}
		if (ilosc == '10') { cena=10*0.25*14; transport=11.9;}
		if (ilosc == '25') { cena=25*0.25*12; transport=14.9;}
		if (ilosc == '50') { cena=50*0.25*10; transport=14.9;}
		if (ilosc == '100') { cena=100*0.25*8; transport=26.9;}
		opis += '<br />- DIN A2 (42 x 60 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_21').value == '2'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*0.5*18; transport=11.9;}
		if (ilosc == '5') { cena=5*0.5*16; transport=11.9;}
		if (ilosc == '10') { cena=10*0.5*14; transport=11.9;}
		if (ilosc == '25') { cena=25*0.5*12; transport=14.9;}
		if (ilosc == '50') { cena=50*0.5*10; transport=14.9;}
		if (ilosc == '100') { cena=100*0.5*8; transport=26.9;}
		opis += '<br />- DIN A1 (60 x 84 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_21').value == '3'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1*18; transport=11.9;}
		if (ilosc == '5') { cena=5*1*16; transport=11.9;}
		if (ilosc == '10') { cena=10*1*14; transport=11.9;}
		if (ilosc == '25') { cena=25*1*12; transport=14.9;}
		if (ilosc == '50') { cena=50*1*10; transport=14.9;}
		if (ilosc == '100') { cena=100*1*8; transport=26.9;}
		opis += '<br />- DIN A0 (84 x 120 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_21').value == '4'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1.92*18; transport=11.9;}
		if (ilosc == '5') { cena=5*1.92*16; transport=11.9;}
		if (ilosc == '10') { cena=10*1.92*14; transport=11.9;}
		if (ilosc == '25') { cena=25*1.92*12; transport=14.9;}
		if (ilosc == '50') { cena=50*1.92*10; transport=14.9;}
		if (ilosc == '100') { cena=100*1.92*8; transport=26.9;}
		opis += '<br />- 120 x 160 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_21').value == '5'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*2.11*18; transport=11.9;}
		if (ilosc == '5') { cena=5*2.11*16; transport=11.9;}
		if (ilosc == '10') { cena=10*2.11*14; transport=11.9;}
		if (ilosc == '25') { cena=25*2.11*12; transport=14.9;}
		if (ilosc == '50') { cena=50*2.11*10; transport=14.9;}
		if (ilosc == '100') { cena=100*2.11*8; transport=26.9;}
		opis += '<br />- 120 x 176 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_21').value == '6'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1.50*18; transport=11.9;}
		if (ilosc == '5') { cena=5*1.50*16; transport=11.9;}
		if (ilosc == '10') { cena=10*1.50*14; transport=11.9;}
		if (ilosc == '25') { cena=25*1.50*12; transport=14.9;}
		if (ilosc == '50') { cena=50*1.50*10; transport=14.9;}
		if (ilosc == '100') { cena=100*1.50*8; transport=26.9;}
		opis += '<br />- 100 x 150 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_21').value == '7'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*3*18; transport=11.9;}
		if (ilosc == '5') { cena=5*3*16; transport=11.9;}
		if (ilosc == '10') { cena=10*3*14; transport=11.9;}
		if (ilosc == '25') { cena=25*3*12; transport=14.9;}
		if (ilosc == '50') { cena=50*3*10; transport=14.9;}
		if (ilosc == '100') { cena=100*3*8; transport=26.9;}
		opis += '<br />- 150 x 200 cm | Couché Brillant | Quadri';
		}
	}
	
	if ($('input_1').value == 'Affiches 150g') {
		if ($('input_22').value == '1'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*0.25*20; transport=11.9;}
		if (ilosc == '5') { cena=5*0.25*18; transport=11.9;}
		if (ilosc == '10') { cena=10*0.25*16; transport=11.9;}
		if (ilosc == '25') { cena=25*0.25*14; transport=14.9;}
		if (ilosc == '50') { cena=50*0.25*12; transport=14.9;}
		if (ilosc == '100') { cena=100*0.25*10; transport=26.9;}
		opis += '<br />- DIN A2 (42 x 60 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_22').value == '2'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*0.5*20; transport=11.9;}
		if (ilosc == '5') { cena=5*0.5*18; transport=11.9;}
		if (ilosc == '10') { cena=10*0.5*16; transport=11.9;}
		if (ilosc == '25') { cena=25*0.5*14; transport=14.9;}
		if (ilosc == '50') { cena=50*0.5*12; transport=14.9;}
		if (ilosc == '100') { cena=100*0.5*10; transport=26.9;}
		opis += '<br />- DIN A1 (60 x 84 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_22').value == '3'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1*20; transport=11.9;}
		if (ilosc == '5') { cena=5*1*18; transport=11.9;}
		if (ilosc == '10') { cena=10*1*16; transport=11.9;}
		if (ilosc == '25') { cena=25*1*14; transport=14.9;}
		if (ilosc == '50') { cena=50*1*12; transport=14.9;}
		if (ilosc == '100') { cena=100*1*10; transport=26.9;}
		opis += '<br />- DIN A0 (84 x 120 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_22').value == '4'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1.92*20; transport=11.9;}
		if (ilosc == '5') { cena=5*1.92*18; transport=11.9;}
		if (ilosc == '10') { cena=10*1.92*16; transport=11.9;}
		if (ilosc == '25') { cena=25*1.92*14; transport=14.9;}
		if (ilosc == '50') { cena=50*1.92*12; transport=14.9;}
		if (ilosc == '100') { cena=100*1.92*10; transport=26.9;}
		opis += '<br />- 120 x 160 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_22').value == '5'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*2.11*20; transport=11.9;}
		if (ilosc == '5') { cena=5*2.11*18; transport=11.9;}
		if (ilosc == '10') { cena=10*2.11*16; transport=11.9;}
		if (ilosc == '25') { cena=25*2.11*14; transport=14.9;}
		if (ilosc == '50') { cena=50*2.11*12; transport=14.9;}
		if (ilosc == '100') { cena=100*2.11*10; transport=26.9;}
		opis += '<br />- 120 x 176 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_22').value == '6'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1.50*20; transport=11.9;}
		if (ilosc == '5') { cena=5*1.50*18; transport=11.9;}
		if (ilosc == '10') { cena=10*1.50*16; transport=11.9;}
		if (ilosc == '25') { cena=25*1.50*14; transport=14.9;}
		if (ilosc == '50') { cena=50*1.50*12; transport=14.9;}
		if (ilosc == '100') { cena=100*1.50*10; transport=26.9;}
		opis += '<br />- 100 x 150 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_22').value == '7'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*3*20; transport=11.9;}
		if (ilosc == '5') { cena=5*3*18; transport=11.9;}
		if (ilosc == '10') { cena=10*3*16; transport=11.9;}
		if (ilosc == '25') { cena=25*3*14; transport=14.9;}
		if (ilosc == '50') { cena=50*3*12; transport=14.9;}
		if (ilosc == '100') { cena=100*3*10; transport=26.9;}
		opis += '<br />- 150 x 200 cm | Couché Brillant | Quadri';
		}
	}
	
	if ($('input_1').value == 'Affiches 220g') {
		if ($('input_23').value == '1'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*0.25*25; transport=11.9;}
		if (ilosc == '5') { cena=5*0.25*23; transport=11.9;}
		if (ilosc == '10') { cena=10*0.25*19; transport=11.9;}
		if (ilosc == '25') { cena=25*0.25*18; transport=14.9;}
		if (ilosc == '50') { cena=50*0.25*17; transport=14.9;}
		if (ilosc == '100') { cena=100*0.25*15; transport=26.9;}
		opis += '<br />- DIN A2 (42 x 60 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_23').value == '2'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*0.5*25; transport=11.9;}
		if (ilosc == '5') { cena=5*0.5*23; transport=11.9;}
		if (ilosc == '10') { cena=10*0.5*19; transport=11.9;}
		if (ilosc == '25') { cena=25*0.5*18; transport=14.9;}
		if (ilosc == '50') { cena=50*0.5*17; transport=14.9;}
		if (ilosc == '100') { cena=100*0.5*15; transport=26.9;}
		opis += '<br />- DIN A1 (60 x 84 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_23').value == '3'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1*25; transport=11.9;}
		if (ilosc == '5') { cena=5*1*23; transport=11.9;}
		if (ilosc == '10') { cena=10*1*19; transport=11.9;}
		if (ilosc == '25') { cena=25*1*18; transport=14.9;}
		if (ilosc == '50') { cena=50*1*17; transport=14.9;}
		if (ilosc == '100') { cena=100*1*15; transport=26.9;}
		opis += '<br />- DIN A0 (84 x 120 cm) | Couché Brillant | Quadri';
		}
		
		if ($('input_23').value == '4'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1.92*25; transport=11.9;}
		if (ilosc == '5') { cena=5*1.92*23; transport=11.9;}
		if (ilosc == '10') { cena=10*1.92*19; transport=11.9;}
		if (ilosc == '25') { cena=25*1.92*18; transport=14.9;}
		if (ilosc == '50') { cena=50*1.92*17; transport=14.9;}
		if (ilosc == '100') { cena=100*1.92*15; transport=26.9;}
		opis += '<br />- 120 x 160 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_23').value == '5'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*2.11*25; transport=11.9;}
		if (ilosc == '5') { cena=5*2.11*23; transport=11.9;}
		if (ilosc == '10') { cena=10*2.11*19; transport=11.9;}
		if (ilosc == '25') { cena=25*2.11*18; transport=14.9;}
		if (ilosc == '50') { cena=50*2.11*17; transport=14.9;}
		if (ilosc == '100') { cena=100*2.11*15; transport=26.9;}
		opis += '<br />- 120 x 176 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_23').value == '6'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*1.50*25; transport=11.9;}
		if (ilosc == '5') { cena=5*1.50*23; transport=11.9;}
		if (ilosc == '10') { cena=10*1.50*19; transport=11.9;}
		if (ilosc == '25') { cena=25*1.50*18; transport=14.9;}
		if (ilosc == '50') { cena=50*1.50*17; transport=14.9;}
		if (ilosc == '100') { cena=100*1.50*15; transport=26.9;}
		opis += '<br />- 100 x 150 cm | Couché Brillant | Quadri';
		}
		
		if ($('input_23').value == '7'){
		ilosc = $('input_5').value;
		if (ilosc == '1') { cena=1*3*25; transport=11.9;}
		if (ilosc == '5') { cena=5*3*23; transport=11.9;}
		if (ilosc == '10') { cena=10*3*19; transport=11.9;}
		if (ilosc == '25') { cena=25*3*18; transport=14.9;}
		if (ilosc == '50') { cena=50*3*17; transport=14.9;}
		if (ilosc == '100') { cena=100*3*15; transport=26.9;}
		opis += '<br />- 150 x 200 cm | Couché Brillant | Quadri';
		}
	}

	opis += '<br />- '+ilosc+' Affiches(s)';

	var ktodaje;
	if ($('input_41').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_41').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_42').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_42').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_43').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_43').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	
	var rush;
	if ($('input_100').value == 'express') {
		cena*=1.9;
		rush = 'rush 24/48H';
	}
	if ($('input_100').value == 'rapide') {
		cena*=1.5;
		rush = 'rush 72h';
	}
	if ($('input_100').value == 'standard') {
		cena*=1;
		rush = 'délai standard';
	}
	opis += '<br />- '+rush;
	
	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		cena += 5.00;
		opis += '<br />- relais colis';
	}
	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		opis += '<br />- colis revendeur';
	}
	
            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                opis += "<br />- Livraison gratuite avec FEDEX";
                transport = 0;
            }   
				
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var rodzaj = $('input_1').value;

	var dodajkoszyk = document.getElementById("cart_form");

	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},

cal_cartes: function(){  
var cena=0; var cena2=0; var cena1=0; var cenar=0; var cenarv=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';
var niepokazuj = 0;
var option2=0;
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';

if (($('input_1').value == 'Cartes 350g') || ($('input_1').value == 'Cartes 270µ') || ($('input_1').value == 'Cartes 350µ')){
	
	if ($('input_1').value == 'Cartes 350g') {
		if ($('input_21').value == '1'){ opis += '- Recto (85 mm x 54 mm)';}
		if ($('input_21').value == '2'){ opis += '- Recto/Verso (85 mm x 54 mm)';}
		if (($('input_21').value == '1') || ($('input_21').value == '2'))  {
			ilosc = $('input_5').value;
			cenar=1.11
			cenarv=1.26
			if ($('input_21').value == '1'){ cena1=(ilosc/25)*cenar; opis += '<br />- Recto<br />- 350g | Quadri';}
			if ($('input_21').value == '2'){ cena1=(ilosc/25)*cenarv; opis += '<br />- Recto/Verso<br />- 350g | Quadri';}
			if (ilosc == '100'){ cena1*=1.8;}
			if (ilosc == '250'){ cena1*=1.6;}
			if (ilosc == '500'){ cena1*=1.4;}
			if (ilosc == '1000'){ cena1*=1.2;}
			if (ilosc == '2500'){ cena1*=1;}
			if (ilosc == '5000'){ cena1*=0.95;}
		}
	}
	
	if ($('input_1').value == 'Cartes 270µ') {
		if ($('input_22').value == '1'){ opis += '- Recto (85 mm x 54 mm)';}
		if ($('input_22').value == '2'){ opis += '- Recto/Verso (85 mm x 54 mm)';}
		if (($('input_22').value == '1') || ($('input_22').value == '2'))  {
			ilosc = $('input_5').value;
			cenar=6.76
			cenarv=7.70
			if ($('input_22').value == '1'){ cena=(ilosc/20)*cenar; opis += '<br />- Recto<br />- 270µ | Quadri';}
			if ($('input_22').value == '2'){ cena=(ilosc/20)*cenarv; opis += '<br />- Recto/Verso<br />- 270µ | Quadri';}
			if (ilosc == '100'){ cena*=1.8;}
			if (ilosc == '250'){ cena*=1.6;}
			if (ilosc == '500'){ cena*=1.4;}
			if (ilosc == '1000'){ cena*=1.2;}
			if (ilosc == '2500'){ cena*=1;}
			if (ilosc == '5000'){ cena*=0.95;}

		}
	}
	
	if ($('input_1').value == 'Cartes 350µ') {
		if ($('input_23').value == '1'){ opis += '- Recto (85 mm x 54 mm)';}
		if ($('input_23').value == '2'){ opis += '- Recto/Verso (85 mm x 54 mm)';}
		if (($('input_23').value == '1') || ($('input_23').value == '2'))  {
			ilosc = $('input_5').value;
			cenar=9.46
			cenarv=9.56
			if ($('input_23').value == '1'){ cena=(ilosc/20)*cenar; opis += '<br />- Recto<br />- 350µ | Quadri';}
			if ($('input_23').value == '2'){ cena=(ilosc/20)*cenarv; opis += '<br />- Recto/Verso<br />- 350µ | Quadri';}
			if (ilosc == '100'){ cena*=1.8;}
			if (ilosc == '250'){ cena*=1.6;}
			if (ilosc == '500'){ cena*=1.4;}
			if (ilosc == '1000'){ cena*=1.2;}
			if (ilosc == '2500'){ cena*=1;}
			if (ilosc == '5000'){ cena*=0.95;}
		}
	}
	

	if ($('input_3').value == '1') {cena=cena1;
	opis += '<br />- couché brillant';
	}
	if ($('input_3').value == '2') {cena=cena1*1.04;
	opis += '<br />- satiné';
	}
	if ($('input_3').value == '3') {cena=cena1*1.08;
	opis += '<br />- couché mat';
	}
	

	opis += '<br />- '+ilosc+' Cartes';

	
	
	var rush24p = $$('#rush24p').collect(function(e){ return e.checked; }).any();
	if (rush24p == true) {
		cena *= 1.5;
		opis += '<br />- Délai rush24';
	}
	var economique = $$('#economique').collect(function(e){ return e.checked; }).any();
	if (economique == true) {
		cena *= 0.70;
		opis += '<br />- Délai économique';
	}
	
	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		cena += 5.00;
		opis += '<br />- relais colis';
	}
	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		opis += '<br />- colis revendeur';
	}
	
	var ktodaje;
	if ($('input_4').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
		opis += '<br />- '+ktodaje;
	}
	
	var ktodaje;
	if ($('input_4').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
		opis += '<br />- '+ktodaje;
	}
	

	
	
	
	
	if (ilosc == '100') {transport=7.9;}
	if (ilosc == '250') {transport=7.9;}
	if (ilosc == '500') {transport=7.9;}
	if (ilosc == '1000') {transport=7.9;}
	if (ilosc == '2500') {transport=8.9;}
	if (ilosc == '5000') {transport=10.9;}

            
            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                opis += "<br />- Livraison gratuite avec FEDEX";
                transport = 0;
            }
	
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
		var etiqdesc = '';
		if (etiquette == true) {
		transport=0;
		opis += '<br />- retrait colis a l\'atelier';
		}
	
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
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
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
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
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},



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
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
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
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},



/*cal_cartes: function(){  
var cena=0; var cena2=0;
var suma=0; var suma2=0;
var transport=0;
var ilosc=0;
var opis='';

if ( ($('input_1').value) && ($('input_2').value) && ( ($('input_3').value) || ($('input_4').value) || ($('input_5').value) ) ) {
	if ($('input_1').value == '1') {
		ilosc = $('input_3').value;
		if (ilosc == '1000') {
			cena=47.25;
		}
		if (ilosc == '2000') {
			cena=87.75;
		}
		if (ilosc == '3000') {
			cena=121.5;
		}
		if (ilosc == '5000') {
			cena=175.5;
		}
		opis = '- Recto Coupe<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}
	if ($('input_1').value == '2') {
		ilosc = $('input_4').value;
		if (ilosc == '1000') {
			cena=49.95;
		}
		if (ilosc == '2000') {
			cena=90.45;
		}
		if (ilosc == '3000') {
			cena=121.5;
		}
		opis = '- Recto/Verso Coupe<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}
	if ($('input_1').value == '3') {
		ilosc = $('input_5').value;
		if (ilosc == '1000') {
			cena=81.00;
		}
		if (ilosc == '2000') {
			cena=155.25;
		}
		if (ilosc == '5000') {
			cena=243.00;
		}
		opis = '- Recto/Verso Coupe<br />- Pelliculage<br />- Quadri<br />- CM. 350g<br />- Quantité: '+ilosc+'pc';
	}

	var ktodaje;
	if ($('input_2').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_2').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	opis += '<br />- '+ktodaje;
	cena=fixstr(cena);
	cena2 = cena.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';


	if (ilosc=='1000') { transport=12.9; }
	if (ilosc=='2000') { transport=15.9; }
	if (ilosc=='3000') { transport=15.9; }
	if (ilosc=='5000') { transport=18.9; }

	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Cartes de Visites" /><input type="hidden" name="opis" value="'+opis+'" /><input type="hidden" name="ilosc" value="1" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},*/




cal_banderoles: function(){  
var cena=0; var cena2=0;
var rabat=0; var rabat2=0; var rabatp=0;
var suma=0; var suma2=0;
var transport=0;
var metraz=0;
var metrazzaokraglony=0;
var szerokosc=0;
var wysokosc=0;
var finition=0; var option=0; var fixation=0;
var cedzik=''; var remisik='';


var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';
var ax1 = document.getElementById("id_3");
var ax2 = document.getElementById("id_11");
var ax3 = document.getElementById("id_14");
if (ax1) { 
	ax1.style.background="none";
	ax1.style.border="none";
	ax1.style.borderBottom="1px solid #9fa3a8";
}
if (ax2) { 
	ax2.style.background="none";
	ax2.style.border="none";
	ax2.style.borderBottom="1px solid #9fa3a8";
}
if (ax3) { 
	ax3.style.background="none";
	ax3.style.border="none";
	ax3.style.borderBottom="1px solid #9fa3a8";
}
//if ( ($('input_1').value) && ( ($('input_3').value) || ($('input_4').value) || ($('input_5').value) ) && ( ($('input_6').value) || ($('input_7').value) || ($('input_8').value) ) && ($('input_9').value) && ( ($('input_10').value) || ($('input_11').value) ) && ($('input_7').value) && ($('input_12').value) && ($('input_13').value) && ($('input_14').value) && ($('input_15').value) ) {
	szerokosc = ($('input_14').value);
	szerokosc = szerokosc.replace(',','.');
	szerokosc = fixstr(szerokosc);
	$('input_14').value = szerokosc;
	wysokosc = ($('input_15').value);
	wysokosc = wysokosc.replace(',','.');
	wysokosc = fixstr(wysokosc);
	$('input_15').value = wysokosc;
	szerokosc = parseFloat(szerokosc);
	wysokosc = parseFloat(wysokosc);
	metraz = szerokosc * wysokosc;
	metraz = fixstr(metraz);
	var metrazzaokraglony1 = (szerokosc+wysokosc)*2;
	metrazzaokraglony = Math.round(metrazzaokraglony1);


if ($('input_1').value == 'extérieur') {
	if ($('input_3').value == 'bache 440g' ) {
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.09) && (wysokosc > 1.09) ) {
			metraz = wysokosc*1.10;
			}
			if ( ( (szerokosc > 1.09) && (szerokosc <= 1.60) ) && ( (wysokosc <= 1.09) || (wysokosc > 1.60) ) ) {
			metraz = wysokosc*1.60;
			}
		}
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.09) && (wysokosc <= 1.09) ) {
			metraz = szerokosc*1.10;
			}
			if ( (szerokosc > 1.09) && (szerokosc <= 1.60) && (wysokosc > 1.09) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.09) && (szerokosc > 1.09) ) {
			metraz = szerokosc*1.10;
			}
			if ( ( (wysokosc > 1.09) && (wysokosc <= 1.60) ) && ( (szerokosc <= 1.09) || (szerokosc > 1.60) ) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.09) && (szerokosc <= 1.09) ) {
			metraz = wysokosc*1.10;
			}
			if ( (wysokosc > 1.09) && (wysokosc <= 1.60) && (szerokosc > 1.09) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.60;
			}
        }
		if (metraz <= 5.00) {
		cena = metraz*12.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
		cena = metraz*10.00;
		}
		if (metraz > 10.00) {
		cena = metraz*9.00;
		}	
	}
	
	
	if ($('input_3').value == 'bache 150g' ) {
		
		if (metraz <= 60.00) {
		cena = metraz*11.00;
		}
		if ( (metraz > 60.00) && (metraz <= 99.00) ) {
		cena = metraz*9.50;
		}
		if (metraz > 99.00) {
		cena = metraz*8.50;
		}	
	}
	
	
	if ($('input_3').value == 'bache 550g' ) {
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ((szerokosc <= 1.05) && (wysokosc > 1.05)){
			metraz = wysokosc*1.06;
			}
			if ( ( (szerokosc > 1.05) && (szerokosc <= 1.36) ) && ( (wysokosc <= 1.05) || (wysokosc > 1.36) ) ) {
			metraz = wysokosc*1.37;
			}
			if ( ( (szerokosc > 1.36) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.36) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.59) && (szerokosc <= 1.86) ) && ( (wysokosc <= 1.59) || (wysokosc > 1.86) ) ) {
			metraz = wysokosc*1.91;
			}
			if ( ( (szerokosc > 1.86) && (szerokosc <= 2.07) ) && ( (wysokosc <= 1.86) || (wysokosc > 2.07) ) ) {
			metraz = wysokosc*2.12;
			}
			if ( ( (szerokosc > 2.07) && (szerokosc <= 2.20) ) && ( (wysokosc <= 2.07) || (wysokosc > 2.20) ) ) {
			metraz = wysokosc*2.25;
			}
			if ( ( (szerokosc > 2.20) && (szerokosc <= 2.40) ) && ( (wysokosc <= 2.20) || (wysokosc > 2.40) ) ) {
			metraz = wysokosc*2.45;
			}
			if ( ( (szerokosc > 2.40) && (szerokosc <= 2.61) ) && ( (wysokosc <= 2.40) || (wysokosc > 2.61) ) ) {
			metraz = wysokosc*2.66;
			}
			if ( ( (szerokosc > 2.61) && (szerokosc <= 2.92) ) && ( (wysokosc <= 2.61) || (wysokosc > 2.92) ) ) {
			metraz = wysokosc*2.97;
			}
			if ( ( (szerokosc > 2.92) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.92) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ((szerokosc <= 1.05) && (wysokosc <= 1.05)){
			metraz = szerokosc*1.06;
			}
			if ( (szerokosc > 1.05) && (szerokosc <= 1.36) && (wysokosc > 1.05) && (wysokosc <= 1.36) ) {
			metraz = szerokosc*1.37;
			}
			if ( (szerokosc > 1.36) && (szerokosc <= 1.59) && (wysokosc > 1.36) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.59) && (szerokosc <= 1.86) && (wysokosc > 1.59) && (wysokosc <= 1.86) ) {
			metraz = szerokosc*1.91;
			}
			if ( (szerokosc > 1.86) && (szerokosc <= 2.07) && (wysokosc > 1.86) && (wysokosc <= 2.07) ) {
			metraz = szerokosc*2.12;
			}
			if ( (szerokosc > 2.07) && (szerokosc <= 2.20) && (wysokosc > 2.07) && (wysokosc <= 2.20) ) {
			metraz = szerokosc*2.25;
			}
			if ( (szerokosc > 2.20) && (szerokosc <= 2.40) && (wysokosc > 2.20) && (wysokosc <= 2.40) ) {
			metraz = szerokosc*2.45;
			}
			if ( (szerokosc > 2.40) && (szerokosc <= 2.61) && (wysokosc > 2.40) && (wysokosc <= 2.61) ) {
			metraz = szerokosc*2.66;
			}
			if ( (szerokosc > 2.61) && (szerokosc <= 2.92) && (wysokosc > 2.61) && (wysokosc <= 2.92) ) {
			metraz = szerokosc*2.97;
			}
			if ( (szerokosc > 2.92) && (szerokosc <= 3.20) && (wysokosc > 2.92) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ((szerokosc <= 1.05) && (wysokosc > 1.05)){
			metraz = szerokosc*1.06;
			}
			if ( ( (wysokosc > 1.05) && (wysokosc <= 1.36) ) && (( szerokosc <= 1.05) || (szerokosc > 1.36) ) ) {
			metraz = szerokosc*1.37;
			}
			if ( ( (wysokosc > 1.36) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.36) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.59) && (wysokosc <= 1.86) ) && ( (szerokosc <= 1.59) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*1.91;
			}
			if ( ( (wysokosc > 1.86) && (wysokosc <= 2.07) ) && ( (szerokosc <= 1.86) || (szerokosc > 2.07) ) ) {
			metraz = szerokosc*2.12;
			}
			if ( ( (wysokosc > 2.07) && (wysokosc <= 2.20) ) && ( (szerokosc <= 2.07) || (szerokosc > 2.20) ) ) {
			metraz = szerokosc*2.25;
			}
			if ( ( (wysokosc > 2.20) && (wysokosc <= 2.40) ) && ( (szerokosc <= 2.20) || (szerokosc > 2.40) ) ) {
			metraz = szerokosc*2.45;
			}
			if ( ( (wysokosc > 2.40) && (wysokosc <= 2.61) ) && ( (szerokosc <= 2.40) || (szerokosc > 2.61) ) ) {
			metraz = szerokosc*2.66;
			}
			if ( ( (wysokosc > 2.61) && (wysokosc <= 2.92) ) && ( (szerokosc <= 2.61) || (szerokosc > 2.92) ) ) {
			metraz = szerokosc*2.97;
			}
			if ( ( (wysokosc > 2.92) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.92) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ((szerokosc <= 1.05) && (wysokosc <= 1.05)){
			metraz = wysokosc*1.06;
			}
			if ( (wysokosc > 1.05) && (wysokosc <= 1.36) && (szerokosc > 1.05) && (szerokosc <= 1.36) ) {
			metraz = wysokosc*1.37;
			}
			if ( (wysokosc > 1.36) && (wysokosc <= 1.59) && (szerokosc > 1.36) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.59) && (wysokosc <= 1.86) && (szerokosc > 1.59) && (szerokosc <= 1.86) ) {
			metraz = wysokosc*1.91;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.07) && (szerokosc > 1.86) && (szerokosc <= 2.07) ) {
			metraz = wysokosc*2.12;
			}
			if ( (wysokosc > 2.07) && (wysokosc <= 2.20) && (szerokosc > 2.07) && (szerokosc <= 2.20) ) {
			metraz = wysokosc*2.25;
			}
			if ( (wysokosc > 2.20) && (wysokosc <= 2.40) && (szerokosc > 2.20) && (szerokosc <= 2.40) ) {
			metraz = wysokosc*2.45;
			}
			if ( (wysokosc > 2.40) && (wysokosc <= 2.61) && (szerokosc > 2.40) && (szerokosc <= 2.61) ) {
			metraz = wysokosc*2.66;
			}
			if ( (wysokosc > 2.61) && (wysokosc <= 2.92) && (szerokosc > 2.61) && (szerokosc <= 2.92) ) {
			metraz = wysokosc*2.97;
			}
			if ( (wysokosc > 2.92) && (wysokosc <= 3.20) && (szerokosc > 2.92) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		if (metraz <= 5.00) {
			cena = metraz*19.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*18.00;
		}
		if (metraz > 10.00) {
			cena = metraz*16.00;
		}
	}

	
	if ($('input_3').value == 'bache 510g OP M1' ) {
		if (metraz <= 5.00) {
			cena = metraz*30;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*26;
		}
		if (metraz > 10.00) {
			cena = metraz*24;
		}	
	}
	
	if ($('input_3').value == 'bache 450g M1' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.89) && (wysokosc > 0.89) ) {
			metraz = wysokosc*0.90;
			}
			if ( ( (szerokosc > 0.89) && (szerokosc <= 1.07) ) && ( (wysokosc <= 0.89) || (wysokosc > 1.07) ) ) {
			metraz = wysokosc*1.08;
			}
			if ( ( (szerokosc > 1.07) && (szerokosc <= 1.60) ) && ( (wysokosc <= 1.07) || (wysokosc > 1.60) ) ) {
			metraz = wysokosc*1.62;
			}
			if ( ( (szerokosc > 1.60) && (szerokosc <= 1.93) ) && ( (wysokosc <= 1.60) || (wysokosc > 1.93) ) ) {
			metraz = wysokosc*1.98;
			}
			if ( ( (szerokosc > 1.93) && (szerokosc <= 2.11) ) && ( (wysokosc <= 1.93) || (wysokosc > 2.11) ) ) {
			metraz = wysokosc*2.16;
			}
			if ( ( (szerokosc > 2.11) && (szerokosc <= 2.47) ) && ( (wysokosc <= 2.11) || (wysokosc > 2.47) ) ) {
			metraz = wysokosc*2.52;
			}
			if ( ( (szerokosc > 2.47) && (szerokosc <= 2.65) ) && ( (wysokosc <= 2.47) || (wysokosc > 2.65) ) ) {
			metraz = wysokosc*2.70;
			}
			if ( ( (szerokosc > 2.65) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.65) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.24;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.89) && (wysokosc <= 0.89) ) {
			metraz = szerokosc*0.90;
			}
			if ( (szerokosc > 0.89) && (szerokosc <= 1.07) && (wysokosc > 0.89) && (wysokosc <= 1.07) ) {
			metraz = szerokosc*1.08;
			}
			if ( (szerokosc > 1.07) && (szerokosc <= 1.60) && (wysokosc > 1.07) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.62;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 1.93) && (wysokosc > 1.60) && (wysokosc <= 1.93) ) {
			metraz = szerokosc*1.98;
			}
			if ( (szerokosc > 1.93) && (szerokosc <= 2.11) && (wysokosc > 1.93) && (wysokosc <= 2.11) ) {
			metraz = szerokosc*2.16;
			}
			if ( (szerokosc > 2.11) && (szerokosc <= 2.47) && (wysokosc > 2.11) && (wysokosc <= 2.47) ) {
			metraz = szerokosc*2.52;
			}
			if ( (szerokosc > 2.47) && (szerokosc <= 2.65) && (wysokosc > 2.47) && (wysokosc <= 2.65) ) {
			metraz = szerokosc*2.70;
			}
			if ( (szerokosc > 2.65) && (szerokosc <= 3.20) && (wysokosc > 2.65) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.24;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.89) && (szerokosc > 0.89) ) {
			metraz = szerokosc*0.90;
			}
			if ( ( (wysokosc > 0.89) && (wysokosc <= 1.07) ) && ( (szerokosc <= 0.89) || (szerokosc > 1.07) ) ) {
			metraz = szerokosc*1.08;
			}
			if ( ( (wysokosc > 1.07) && (wysokosc <= 1.60) ) && ( (szerokosc <= 1.07) || (szerokosc > 1.60) ) ) {
			metraz = szerokosc*1.62;
			}
			if ( ( (wysokosc > 1.60) && (wysokosc <= 1.93) ) && (( szerokosc <= 1.60) || (szerokosc > 1.93) ) ) {
			metraz = szerokosc*1.98;
			}
			if ( ( (wysokosc > 1.93) && (wysokosc <= 2.11) ) && ( (szerokosc <= 1.93) || (szerokosc > 2.11) ) ) {
			metraz = szerokosc*2.16;
			}
			if ( ( (wysokosc > 2.11) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.11) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.52;
			}
			if ( ( (wysokosc > 2.47) && (wysokosc <= 2.65) ) && ( (szerokosc <= 2.47) || (szerokosc > 2.65) ) ) {
			metraz = szerokosc*2.70;
			}
			if ( ( (wysokosc > 2.65) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.65) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.24;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.89) && (szerokosc <= 0.89) ) {
			metraz = wysokosc*0.90;
			}
			if ( (wysokosc > 0.89) && (wysokosc <= 1.07) && (szerokosc > 0.89) && (szerokosc <= 1.07) ) {
			metraz = wysokosc*1.08;
			}
			if ( (wysokosc > 1.07) && (wysokosc <= 1.60) && (szerokosc > 1.07) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.62;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 1.93) && (szerokosc > 1.60) && (szerokosc <= 1.93) ) {
			metraz = wysokosc*1.98;
			}
			if ( (wysokosc > 1.93) && (wysokosc <= 2.11) && (szerokosc > 1.93) && (szerokosc <= 2.11) ) {
			metraz = wysokosc*2.16;
			}
			if ( (wysokosc > 2.11) && (wysokosc <= 2.47) && (szerokosc > 2.11) && (szerokosc <= 2.47) ) {
			metraz = wysokosc*2.52;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.65) && (szerokosc > 1.86) && (szerokosc <= 2.65) ) {
			metraz = wysokosc*2.70;
			}
			if ( (wysokosc > 2.65) && (wysokosc <= 3.20) && (szerokosc > 2.65) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.24;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*24.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*22.00;
		}
		if (metraz > 10.00) {
			cena = metraz*21.00;
		}	
	}
	

	
	
	if ($('input_3').value == 'bache 750g M2/B1' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc > 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( ( (szerokosc > 1.04) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.04) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.59) && (szerokosc <= 1.80) ) && ( (wysokosc <= 1.59) || (wysokosc > 1.80) ) ) {
			metraz = wysokosc*1.85;
			}
			if ( ( (szerokosc > 1.80) && (szerokosc <= 2.05) ) && ( (wysokosc <= 1.80) || (wysokosc > 2.05) ) ) {
			metraz = wysokosc*2.10;
			}
			if ( ( (szerokosc > 2.05) && (szerokosc <= 2.35) ) && ( (wysokosc <= 2.05) || (wysokosc > 2.35) ) ) {
			metraz = wysokosc*2.40;
			}
			if ( ( (szerokosc > 2.35) && (szerokosc <= 2.60) ) && ( (wysokosc <= 2.35) || (wysokosc > 2.60) ) ) {
			metraz = wysokosc*2.65;
			}
			if ( ( (szerokosc > 2.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc <= 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( (szerokosc > 1.04) && (szerokosc <= 1.59) && (wysokosc > 1.04) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.59) && (szerokosc <= 1.80) && (wysokosc > 1.59) && (wysokosc <= 1.80) ) {
			metraz = szerokosc*1.85;
			}
			if ( (szerokosc > 1.80) && (szerokosc <= 2.05) && (wysokosc > 1.80) && (wysokosc <= 2.05) ) {
			metraz = szerokosc*2.10;
			}
			if ( (szerokosc > 2.05) && (szerokosc <= 2.35) && (wysokosc > 2.05) && (wysokosc <= 2.35) ) {
			metraz = szerokosc*2.40;
			}
			if ( (szerokosc > 2.35) && (szerokosc <= 2.60) && (wysokosc > 2.35) && (wysokosc <= 2.60) ) {
			metraz = szerokosc*2.65;
			}
			if ( (szerokosc > 2.60) && (szerokosc <= 3.20) && (wysokosc > 2.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc > 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( ( (wysokosc > 1.04) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.04) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.59) && (wysokosc <= 1.80) ) && (( szerokosc <= 1.59) || (szerokosc > 1.80) ) ) {
			metraz = szerokosc*1.85;
			}
			if ( ( (wysokosc > 1.80) && (wysokosc <= 2.05) ) && ( (szerokosc <= 1.80) || (szerokosc > 2.05) ) ) {
			metraz = szerokosc*2.10;
			}
			if ( ( (wysokosc > 2.05) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.05) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.40;
			}
			if ( ( (wysokosc > 2.35) && (wysokosc <= 2.60) ) && ( (szerokosc <= 2.35) || (szerokosc > 2.60) ) ) {
			metraz = szerokosc*2.65;
			}
			if ( ( (wysokosc > 2.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc <= 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( (wysokosc > 1.04) && (wysokosc <= 1.59) && (szerokosc > 1.04) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.59) && (wysokosc <= 1.80) && (szerokosc > 1.59) && (szerokosc <= 1.80) ) {
			metraz = wysokosc*1.85;
			}
			if ( (wysokosc > 1.80) && (wysokosc <= 2.05) && (szerokosc > 1.80) && (szerokosc <= 2.05) ) {
			metraz = wysokosc*2.10;
			}
			if ( (wysokosc > 2.05) && (wysokosc <= 2.35) && (szerokosc > 2.05) && (szerokosc <= 2.35) ) {
			metraz = wysokosc*2.40;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.60) && (szerokosc > 1.86) && (szerokosc <= 2.60) ) {
			metraz = wysokosc*2.65;
			}
			if ( (wysokosc > 2.60) && (wysokosc <= 3.20) && (szerokosc > 2.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*28.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*26.00;
		}
		if (metraz > 10.00) {
			cena = metraz*24.00;
		}	
	}
	
	if ($('input_3').value == 'bache 750g M2/B1 recto verso' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc > 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( ( (szerokosc > 1.04) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.04) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.59) && (szerokosc <= 1.80) ) && ( (wysokosc <= 1.59) || (wysokosc > 1.80) ) ) {
			metraz = wysokosc*1.85;
			}
			if ( ( (szerokosc > 1.80) && (szerokosc <= 2.05) ) && ( (wysokosc <= 1.80) || (wysokosc > 2.05) ) ) {
			metraz = wysokosc*2.10;
			}
			if ( ( (szerokosc > 2.05) && (szerokosc <= 2.35) ) && ( (wysokosc <= 2.05) || (wysokosc > 2.35) ) ) {
			metraz = wysokosc*2.40;
			}
			if ( ( (szerokosc > 2.35) && (szerokosc <= 2.60) ) && ( (wysokosc <= 2.35) || (wysokosc > 2.60) ) ) {
			metraz = wysokosc*2.65;
			}
			if ( ( (szerokosc > 2.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc <= 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( (szerokosc > 1.04) && (szerokosc <= 1.59) && (wysokosc > 1.04) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.59) && (szerokosc <= 1.80) && (wysokosc > 1.59) && (wysokosc <= 1.80) ) {
			metraz = szerokosc*1.85;
			}
			if ( (szerokosc > 1.80) && (szerokosc <= 2.05) && (wysokosc > 1.80) && (wysokosc <= 2.05) ) {
			metraz = szerokosc*2.10;
			}
			if ( (szerokosc > 2.05) && (szerokosc <= 2.35) && (wysokosc > 2.05) && (wysokosc <= 2.35) ) {
			metraz = szerokosc*2.40;
			}
			if ( (szerokosc > 2.35) && (szerokosc <= 2.60) && (wysokosc > 2.35) && (wysokosc <= 2.60) ) {
			metraz = szerokosc*2.65;
			}
			if ( (szerokosc > 2.60) && (szerokosc <= 3.20) && (wysokosc > 2.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc > 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( ( (wysokosc > 1.04) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.04) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.59) && (wysokosc <= 1.80) ) && (( szerokosc <= 1.59) || (szerokosc > 1.80) ) ) {
			metraz = szerokosc*1.85;
			}
			if ( ( (wysokosc > 1.80) && (wysokosc <= 2.05) ) && ( (szerokosc <= 1.80) || (szerokosc > 2.05) ) ) {
			metraz = szerokosc*2.10;
			}
			if ( ( (wysokosc > 2.05) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.05) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.40;
			}
			if ( ( (wysokosc > 2.35) && (wysokosc <= 2.60) ) && ( (szerokosc <= 2.35) || (szerokosc > 2.60) ) ) {
			metraz = szerokosc*2.65;
			}
			if ( ( (wysokosc > 2.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc <= 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( (wysokosc > 1.04) && (wysokosc <= 1.59) && (szerokosc > 1.04) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.59) && (wysokosc <= 1.80) && (szerokosc > 1.59) && (szerokosc <= 1.80) ) {
			metraz = wysokosc*1.85;
			}
			if ( (wysokosc > 1.80) && (wysokosc <= 2.05) && (szerokosc > 1.80) && (szerokosc <= 2.05) ) {
			metraz = wysokosc*2.10;
			}
			if ( (wysokosc > 2.05) && (wysokosc <= 2.35) && (szerokosc > 2.05) && (szerokosc <= 2.35) ) {
			metraz = wysokosc*2.40;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.60) && (szerokosc > 1.86) && (szerokosc <= 2.60) ) {
			metraz = wysokosc*2.65;
			}
			if ( (wysokosc > 2.60) && (wysokosc <= 3.20) && (szerokosc > 2.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*36.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*34.00;
		}
		if (metraz > 10.00) {
			cena = metraz*32.00;
		}	
	}
	if ($('input_3').value == 'bache micro perforée M1/B1' ) {
			if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.60) && (wysokosc > 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 1.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.60) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 3.20) && (wysokosc > 1.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.60) && (szerokosc > 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 1.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.60) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 3.20) && (szerokosc > 1.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		if (metraz <= 5.00) {
			cena = metraz*20.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*19.00;
		}
		if (metraz > 10.00) {
			cena = metraz*17.00;
		}	
	}
	if ($('input_3').value == 'bache 100% écologique M1' ) {
		
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.99) && (wysokosc > 0.99) ) {
			metraz = wysokosc*1.00;
			}
			if ( ( (szerokosc > 0.99) && (szerokosc <= 1.36) ) && ( (wysokosc <= 0.99) || (wysokosc > 1.36) ) ) {
			metraz = wysokosc*1.37;
			}
			if ( ( (szerokosc > 1.36) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.36) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
		}
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.99) && (wysokosc <= 0.99) ) {
			metraz = szerokosc*1.00;
			}
			if ( (szerokosc > 0.99) && (szerokosc <= 1.36) && (wysokosc > 0.99) && (wysokosc <= 1.36) ) {
			metraz = szerokosc*1.37;
			}
			if ( (szerokosc > 1.36) && (szerokosc <= 1.59) && (wysokosc > 1.36) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.99) && (szerokosc > 0.99) ) {
			metraz = szerokosc*1.00;
			}
			if ( ( (wysokosc > 0.99) && (wysokosc <= 1.36) ) && ( (szerokosc <= 0.99) || (szerokosc > 1.36) ) ) {
			metraz = szerokosc*1.37;
			}
			if ( ( (wysokosc > 1.36) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.36) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.99) && (szerokosc <= 0.99) ) {
			metraz = wysokosc*1.00;
			}
			if ( (wysokosc > 0.99) && (wysokosc <= 1.36) && (szerokosc > 0.99) && (szerokosc <= 1.36) ) {
			metraz = wysokosc*1.37;
			}
			if ( (wysokosc > 1.36) && (wysokosc <= 1.59) && (szerokosc > 1.36) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
        }
		if (metraz <= 5.00) {
			cena = metraz*30.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*29.00;
		}
		if (metraz > 10.00) {
			cena = metraz*27.00;
		}	
	}
}

if ($('input_1').value == 'interieur') {
	if ($('input_4').value == 'bache 510g OP M1' ) {
		if (metraz <= 5.00) {
			cena = metraz*30;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*26;
		}
		if (metraz > 10.00) {
			cena = metraz*24;
		}	
	}
	
	if ($('input_4').value == 'bache 150g' ) {
		
		if (metraz <= 60.00) {
		cena = metraz*12.00;
		}
		if ( (metraz > 60.00) && (metraz <= 99.00) ) {
		cena = metraz*10.50;
		}
		if (metraz > 99.00) {
		cena = metraz*9.50;
		}	
	}
	
	if ($('input_4').value == 'bache 450g M1' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.89) && (wysokosc > 0.89) ) {
			metraz = wysokosc*0.90;
			}
			if ( ( (szerokosc > 0.89) && (szerokosc <= 1.07) ) && ( (wysokosc <= 0.89) || (wysokosc > 1.07) ) ) {
			metraz = wysokosc*1.08;
			}
			if ( ( (szerokosc > 1.07) && (szerokosc <= 1.60) ) && ( (wysokosc <= 1.07) || (wysokosc > 1.60) ) ) {
			metraz = wysokosc*1.62;
			}
			if ( ( (szerokosc > 1.60) && (szerokosc <= 1.93) ) && ( (wysokosc <= 1.60) || (wysokosc > 1.93) ) ) {
			metraz = wysokosc*1.98;
			}
			if ( ( (szerokosc > 1.93) && (szerokosc <= 2.11) ) && ( (wysokosc <= 1.93) || (wysokosc > 2.11) ) ) {
			metraz = wysokosc*2.16;
			}
			if ( ( (szerokosc > 2.11) && (szerokosc <= 2.47) ) && ( (wysokosc <= 2.11) || (wysokosc > 2.47) ) ) {
			metraz = wysokosc*2.52;
			}
			if ( ( (szerokosc > 2.47) && (szerokosc <= 2.65) ) && ( (wysokosc <= 2.47) || (wysokosc > 2.65) ) ) {
			metraz = wysokosc*2.70;
			}
			if ( ( (szerokosc > 2.65) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.65) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.24;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.89) && (wysokosc <= 0.89) ) {
			metraz = szerokosc*0.90;
			}
			if ( (szerokosc > 0.89) && (szerokosc <= 1.07) && (wysokosc > 0.89) && (wysokosc <= 1.07) ) {
			metraz = szerokosc*1.08;
			}
			if ( (szerokosc > 1.07) && (szerokosc <= 1.60) && (wysokosc > 1.07) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.62;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 1.93) && (wysokosc > 1.60) && (wysokosc <= 1.93) ) {
			metraz = szerokosc*1.98;
			}
			if ( (szerokosc > 1.93) && (szerokosc <= 2.11) && (wysokosc > 1.93) && (wysokosc <= 2.11) ) {
			metraz = szerokosc*2.16;
			}
			if ( (szerokosc > 2.11) && (szerokosc <= 2.47) && (wysokosc > 2.11) && (wysokosc <= 2.47) ) {
			metraz = szerokosc*2.52;
			}
			if ( (szerokosc > 2.47) && (szerokosc <= 2.65) && (wysokosc > 2.47) && (wysokosc <= 2.65) ) {
			metraz = szerokosc*2.70;
			}
			if ( (szerokosc > 2.65) && (szerokosc <= 3.20) && (wysokosc > 2.65) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.24;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.89) && (szerokosc > 0.89) ) {
			metraz = szerokosc*0.90;
			}
			if ( ( (wysokosc > 0.89) && (wysokosc <= 1.07) ) && ( (szerokosc <= 0.89) || (szerokosc > 1.07) ) ) {
			metraz = szerokosc*1.08;
			}
			if ( ( (wysokosc > 1.07) && (wysokosc <= 1.60) ) && ( (szerokosc <= 1.07) || (szerokosc > 1.60) ) ) {
			metraz = szerokosc*1.62;
			}
			if ( ( (wysokosc > 1.60) && (wysokosc <= 1.93) ) && (( szerokosc <= 1.60) || (szerokosc > 1.93) ) ) {
			metraz = szerokosc*1.98;
			}
			if ( ( (wysokosc > 1.93) && (wysokosc <= 2.11) ) && ( (szerokosc <= 1.93) || (szerokosc > 2.11) ) ) {
			metraz = szerokosc*2.16;
			}
			if ( ( (wysokosc > 2.11) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.11) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.52;
			}
			if ( ( (wysokosc > 2.47) && (wysokosc <= 2.65) ) && ( (szerokosc <= 2.47) || (szerokosc > 2.65) ) ) {
			metraz = szerokosc*2.70;
			}
			if ( ( (wysokosc > 2.65) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.65) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.24;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.89) && (szerokosc <= 0.89) ) {
			metraz = wysokosc*0.90;
			}
			if ( (wysokosc > 0.89) && (wysokosc <= 1.07) && (szerokosc > 0.89) && (szerokosc <= 1.07) ) {
			metraz = wysokosc*1.08;
			}
			if ( (wysokosc > 1.07) && (wysokosc <= 1.60) && (szerokosc > 1.07) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.62;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 1.93) && (szerokosc > 1.60) && (szerokosc <= 1.93) ) {
			metraz = wysokosc*1.98;
			}
			if ( (wysokosc > 1.93) && (wysokosc <= 2.11) && (szerokosc > 1.93) && (szerokosc <= 2.11) ) {
			metraz = wysokosc*2.16;
			}
			if ( (wysokosc > 2.11) && (wysokosc <= 2.47) && (szerokosc > 2.11) && (szerokosc <= 2.47) ) {
			metraz = wysokosc*2.52;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.65) && (szerokosc > 1.86) && (szerokosc <= 2.65) ) {
			metraz = wysokosc*2.70;
			}
			if ( (wysokosc > 2.65) && (wysokosc <= 3.20) && (szerokosc > 2.65) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.24;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*24.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*22.00;
		}
		if (metraz > 10.00) {
			cena = metraz*21.00;
		}	
	}
	if ($('input_4').value == 'bache 750g M2/B1' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc > 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( ( (szerokosc > 1.04) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.04) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.59) && (szerokosc <= 1.80) ) && ( (wysokosc <= 1.59) || (wysokosc > 1.80) ) ) {
			metraz = wysokosc*1.85;
			}
			if ( ( (szerokosc > 1.80) && (szerokosc <= 2.05) ) && ( (wysokosc <= 1.80) || (wysokosc > 2.05) ) ) {
			metraz = wysokosc*2.10;
			}
			if ( ( (szerokosc > 2.05) && (szerokosc <= 2.35) ) && ( (wysokosc <= 2.05) || (wysokosc > 2.35) ) ) {
			metraz = wysokosc*2.40;
			}
			if ( ( (szerokosc > 2.35) && (szerokosc <= 2.60) ) && ( (wysokosc <= 2.35) || (wysokosc > 2.60) ) ) {
			metraz = wysokosc*2.65;
			}
			if ( ( (szerokosc > 2.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc <= 1.04) )  {
			metraz = szerokosc*1.05;
			}
			if ( (szerokosc > 1.04) && (szerokosc <= 1.59) && (wysokosc > 1.04) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.59) && (szerokosc <= 1.80) && (wysokosc > 1.59) && (wysokosc <= 1.80) ) {
			metraz = szerokosc*1.85;
			}
			if ( (szerokosc > 1.80) && (szerokosc <= 2.05) && (wysokosc > 1.80) && (wysokosc <= 2.05) ) {
			metraz = szerokosc*2.10;
			}
			if ( (szerokosc > 2.05) && (szerokosc <= 2.35) && (wysokosc > 2.05) && (wysokosc <= 2.35) ) {
			metraz = szerokosc*2.40;
			}
			if ( (szerokosc > 2.35) && (szerokosc <= 2.60) && (wysokosc > 2.35) && (wysokosc <= 2.60) ) {
			metraz = szerokosc*2.65;
			}
			if ( (szerokosc > 2.60) && (szerokosc <= 3.20) && (wysokosc > 2.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc > 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( ( (wysokosc > 1.04) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.04) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.59) && (wysokosc <= 1.80) ) && (( szerokosc <= 1.59) || (szerokosc > 1.80) ) ) {
			metraz = szerokosc*1.85;
			}
			if ( ( (wysokosc > 1.80) && (wysokosc <= 2.05) ) && ( (szerokosc <= 1.80) || (szerokosc > 2.05) ) ) {
			metraz = szerokosc*2.10;
			}
			if ( ( (wysokosc > 2.05) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.05) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.40;
			}
			if ( ( (wysokosc > 2.35) && (wysokosc <= 2.60) ) && ( (szerokosc <= 2.35) || (szerokosc > 2.60) ) ) {
			metraz = szerokosc*2.65;
			}
			if ( ( (wysokosc > 2.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (szerokosc <= 1.04)  &&  (wysokosc <= 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( (wysokosc > 1.04) && (wysokosc <= 1.59) && (szerokosc > 1.04) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.59) && (wysokosc <= 1.80) && (szerokosc > 1.59) && (szerokosc <= 1.80) ) {
			metraz = wysokosc*1.85;
			}
			if ( (wysokosc > 1.80) && (wysokosc <= 2.05) && (szerokosc > 1.80) && (szerokosc <= 2.05) ) {
			metraz = wysokosc*2.10;
			}
			if ( (wysokosc > 2.05) && (wysokosc <= 2.35) && (szerokosc > 2.05) && (szerokosc <= 2.35) ) {
			metraz = wysokosc*2.40;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.60) && (szerokosc > 1.86) && (szerokosc <= 2.60) ) {
			metraz = wysokosc*2.65;
			}
			if ( (wysokosc > 2.60) && (wysokosc <= 3.20) && (szerokosc > 2.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*28.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*26.00;
		}
		if (metraz > 10.00) {
			cena = metraz*24.00;
		}	
	}
	if ($('input_4').value == 'bache 750g M2/B1 recto verso' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.79) && (wysokosc > 0.79) ) {
			metraz = wysokosc*0.80;
			}
			if ( ( (szerokosc > 0.79) && (szerokosc <= 1.04) ) && ( (wysokosc <= 0.79) || (wysokosc > 1.04) ) ) {
			metraz = wysokosc*1.05;
			}
			if ( ( (szerokosc > 1.04) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.04) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.59) && (szerokosc <= 1.80) ) && ( (wysokosc <= 1.59) || (wysokosc > 1.80) ) ) {
			metraz = wysokosc*1.85;
			}
			if ( ( (szerokosc > 1.80) && (szerokosc <= 2.05) ) && ( (wysokosc <= 1.80) || (wysokosc > 2.05) ) ) {
			metraz = wysokosc*2.10;
			}
			if ( ( (szerokosc > 2.05) && (szerokosc <= 2.35) ) && ( (wysokosc <= 2.05) || (wysokosc > 2.35) ) ) {
			metraz = wysokosc*2.40;
			}
			if ( ( (szerokosc > 2.35) && (szerokosc <= 2.60) ) && ( (wysokosc <= 2.35) || (wysokosc > 2.60) ) ) {
			metraz = wysokosc*2.65;
			}
			if ( ( (szerokosc > 2.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.79) && (wysokosc <= 0.79) ) {
			metraz = szerokosc*0.80;
			}
			if ( (szerokosc > 0.79) && (szerokosc <= 1.04) && (wysokosc > 0.79) && (wysokosc <= 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( (szerokosc > 1.04) && (szerokosc <= 1.59) && (wysokosc > 1.04) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.59) && (szerokosc <= 1.80) && (wysokosc > 1.59) && (wysokosc <= 1.80) ) {
			metraz = szerokosc*1.85;
			}
			if ( (szerokosc > 1.80) && (szerokosc <= 2.05) && (wysokosc > 1.80) && (wysokosc <= 2.05) ) {
			metraz = szerokosc*2.10;
			}
			if ( (szerokosc > 2.05) && (szerokosc <= 2.35) && (wysokosc > 2.05) && (wysokosc <= 2.35) ) {
			metraz = szerokosc*2.40;
			}
			if ( (szerokosc > 2.35) && (szerokosc <= 2.60) && (wysokosc > 2.35) && (wysokosc <= 2.60) ) {
			metraz = szerokosc*2.65;
			}
			if ( (szerokosc > 2.60) && (szerokosc <= 3.20) && (wysokosc > 2.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.79) && (szerokosc > 0.79) ) {
			metraz = szerokosc*0.80;
			}
			if ( ( (wysokosc > 0.79) && (wysokosc <= 1.04) ) && ( (szerokosc <= 0.79) || (szerokosc > 1.04) ) ) {
			metraz = szerokosc*1.05;
			}
			if ( ( (wysokosc > 1.04) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.04) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.59) && (wysokosc <= 1.80) ) && (( szerokosc <= 1.59) || (szerokosc > 1.80) ) ) {
			metraz = szerokosc*1.85;
			}
			if ( ( (wysokosc > 1.80) && (wysokosc <= 2.05) ) && ( (szerokosc <= 1.80) || (szerokosc > 2.05) ) ) {
			metraz = szerokosc*2.10;
			}
			if ( ( (wysokosc > 2.05) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.05) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.40;
			}
			if ( ( (wysokosc > 2.35) && (wysokosc <= 2.60) ) && ( (szerokosc <= 2.35) || (szerokosc > 2.60) ) ) {
			metraz = szerokosc*2.65;
			}
			if ( ( (wysokosc > 2.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.79) && (szerokosc <= 0.79) ) {
			metraz = wysokosc*0.80;
			}
			if ( (wysokosc > 0.79) && (wysokosc <= 1.04) && (szerokosc > 0.79) && (szerokosc <= 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( (wysokosc > 1.04) && (wysokosc <= 1.59) && (szerokosc > 1.04) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.59) && (wysokosc <= 1.80) && (szerokosc > 1.59) && (szerokosc <= 1.80) ) {
			metraz = wysokosc*1.85;
			}
			if ( (wysokosc > 1.80) && (wysokosc <= 2.05) && (szerokosc > 1.80) && (szerokosc <= 2.05) ) {
			metraz = wysokosc*2.10;
			}
			if ( (wysokosc > 2.05) && (wysokosc <= 2.35) && (szerokosc > 2.05) && (szerokosc <= 2.35) ) {
			metraz = wysokosc*2.40;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.60) && (szerokosc > 1.86) && (szerokosc <= 2.60) ) {
			metraz = wysokosc*2.65;
			}
			if ( (wysokosc > 2.60) && (wysokosc <= 3.20) && (szerokosc > 2.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*36.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*34.00;
		}
		if (metraz > 10.00) {
			cena = metraz*32.00;
		}	
	}
	if ($('input_4').value == 'bache 800g M1/B1' ) {
		if (metraz <= 5.00) {
			cena = metraz*75;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*73;
		}
		if (metraz > 10.00) {
			cena = metraz*71;
		}	
	}
	if ($('input_4').value == 'bache 800g M1/B1 recto verso' ) {
		if (metraz <= 5.00) {
			cena = metraz*95;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*90;
		}
		if (metraz > 10.00) {
			cena = metraz*88;
		}	
	}
	if ($('input_4').value == 'bache micro perforée M1/B1' ) {
			if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.60) && (wysokosc > 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 1.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.60) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 3.20) && (wysokosc > 1.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.60) && (szerokosc > 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 1.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.60) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 3.20) && (szerokosc > 1.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		if (metraz <= 5.00) {
			cena = metraz*20.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*19.00;
		}
		if (metraz > 10.00) {
			cena = metraz*17.00;
		}	
	}
	if ($('input_4').value == 'bache 100% écologique M1' ) {
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.99) && (wysokosc > 0.99) ) {
			metraz = wysokosc*1.00;
			}
			if ( ( (szerokosc > 0.99) && (szerokosc <= 1.36) ) && ( (wysokosc <= 0.99) || (wysokosc > 1.36) ) ) {
			metraz = wysokosc*1.37;
			}
			if ( ( (szerokosc > 1.36) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.36) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
		}
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.99) && (wysokosc <= 0.99) ) {
			metraz = szerokosc*1.00;
			}
			if ( (szerokosc > 0.99) && (szerokosc <= 1.36) && (wysokosc > 0.99) && (wysokosc <= 1.36) ) {
			metraz = szerokosc*1.37;
			}
			if ( (szerokosc > 1.36) && (szerokosc <= 1.59) && (wysokosc > 1.36) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.99) && (szerokosc > 0.99) ) {
			metraz = szerokosc*1.00;
			}
			if ( ( (wysokosc > 0.99) && (wysokosc <= 1.36) ) && ( (szerokosc <= 0.99) || (szerokosc > 1.36) ) ) {
			metraz = szerokosc*1.37;
			}
			if ( ( (wysokosc > 1.36) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.36) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.99) && (szerokosc <= 0.99) ) {
			metraz = wysokosc*1.00;
			}
			if ( (wysokosc > 0.99) && (wysokosc <= 1.36) && (szerokosc > 0.99) && (szerokosc <= 1.36) ) {
			metraz = wysokosc*1.37;
			}
			if ( (wysokosc > 1.36) && (wysokosc <= 1.59) && (szerokosc > 1.36) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
        }
		if (metraz <= 5.00) {
			cena = metraz*30.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*29.00;
		}
		if (metraz > 10.00) {
			cena = metraz*27.00;
		}	
	}
}

if ($('input_1').value == 'int/ext') {
	if ($('input_5').value == 'bache 510g OP M1' ) {
		if (metraz <= 5.00) {
			cena = metraz*30;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*26;
		}
		if (metraz > 10.00) {
			cena = metraz*24;
		}	
	}
	
	if ($('input_5').value == 'bache 150g' ) {
		
		if (metraz <= 60.00) {
		cena = metraz*12.00;
		}
		if ( (metraz > 60.00) && (metraz <= 99.00) ) {
		cena = metraz*10.50;
		}
		if (metraz > 99.00) {
		cena = metraz*9.50;
		}	
	}
	
	if ($('input_5').value == 'bache 450g M1' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.89) && (wysokosc > 0.89) ) {
			metraz = wysokosc*0.90;
			}
			if ( ( (szerokosc > 0.89) && (szerokosc <= 1.07) ) && ( (wysokosc <= 0.89) || (wysokosc > 1.07) ) ) {
			metraz = wysokosc*1.08;
			}
			if ( ( (szerokosc > 1.07) && (szerokosc <= 1.60) ) && ( (wysokosc <= 1.07) || (wysokosc > 1.60) ) ) {
			metraz = wysokosc*1.62;
			}
			if ( ( (szerokosc > 1.60) && (szerokosc <= 1.93) ) && ( (wysokosc <= 1.60) || (wysokosc > 1.93) ) ) {
			metraz = wysokosc*1.98;
			}
			if ( ( (szerokosc > 1.93) && (szerokosc <= 2.11) ) && ( (wysokosc <= 1.93) || (wysokosc > 2.11) ) ) {
			metraz = wysokosc*2.16;
			}
			if ( ( (szerokosc > 2.11) && (szerokosc <= 2.47) ) && ( (wysokosc <= 2.11) || (wysokosc > 2.47) ) ) {
			metraz = wysokosc*2.52;
			}
			if ( ( (szerokosc > 2.47) && (szerokosc <= 2.65) ) && ( (wysokosc <= 2.47) || (wysokosc > 2.65) ) ) {
			metraz = wysokosc*2.70;
			}
			if ( ( (szerokosc > 2.65) && (szerokosc <= 3.20) ) && ( (wysokosc <= 2.65) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.24;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.89) && (wysokosc <= 0.89) ) {
			metraz = szerokosc*0.90;
			}
			if ( (szerokosc > 0.89) && (szerokosc <= 1.07) && (wysokosc > 0.89) && (wysokosc <= 1.07) ) {
			metraz = szerokosc*1.08;
			}
			if ( (szerokosc > 1.07) && (szerokosc <= 1.60) && (wysokosc > 1.07) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.62;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 1.93) && (wysokosc > 1.60) && (wysokosc <= 1.93) ) {
			metraz = szerokosc*1.98;
			}
			if ( (szerokosc > 1.93) && (szerokosc <= 2.11) && (wysokosc > 1.93) && (wysokosc <= 2.11) ) {
			metraz = szerokosc*2.16;
			}
			if ( (szerokosc > 2.11) && (szerokosc <= 2.47) && (wysokosc > 2.11) && (wysokosc <= 2.47) ) {
			metraz = szerokosc*2.52;
			}
			if ( (szerokosc > 2.47) && (szerokosc <= 2.65) && (wysokosc > 2.47) && (wysokosc <= 2.65) ) {
			metraz = szerokosc*2.70;
			}
			if ( (szerokosc > 2.65) && (szerokosc <= 3.20) && (wysokosc > 2.65) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.24;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.89) && (szerokosc > 0.89) ) {
			metraz = szerokosc*0.90;
			}
			if ( ( (wysokosc > 0.89) && (wysokosc <= 1.07) ) && ( (szerokosc <= 0.89) || (szerokosc > 1.07) ) ) {
			metraz = szerokosc*1.08;
			}
			if ( ( (wysokosc > 1.07) && (wysokosc <= 1.60) ) && ( (szerokosc <= 1.07) || (szerokosc > 1.60) ) ) {
			metraz = szerokosc*1.62;
			}
			if ( ( (wysokosc > 1.60) && (wysokosc <= 1.93) ) && (( szerokosc <= 1.60) || (szerokosc > 1.93) ) ) {
			metraz = szerokosc*1.98;
			}
			if ( ( (wysokosc > 1.93) && (wysokosc <= 2.11) ) && ( (szerokosc <= 1.93) || (szerokosc > 2.11) ) ) {
			metraz = szerokosc*2.16;
			}
			if ( ( (wysokosc > 2.11) && (wysokosc <= 1.86) ) && ( (szerokosc <= 2.11) || (szerokosc > 1.86) ) ) {
			metraz = szerokosc*2.52;
			}
			if ( ( (wysokosc > 2.47) && (wysokosc <= 2.65) ) && ( (szerokosc <= 2.47) || (szerokosc > 2.65) ) ) {
			metraz = szerokosc*2.70;
			}
			if ( ( (wysokosc > 2.65) && (wysokosc <= 3.20) ) && ( (szerokosc <= 2.65) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.24;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.89) && (szerokosc <= 0.89) ) {
			metraz = wysokosc*0.90;
			}
			if ( (wysokosc > 0.89) && (wysokosc <= 1.07) && (szerokosc > 0.89) && (szerokosc <= 1.07) ) {
			metraz = wysokosc*1.08;
			}
			if ( (wysokosc > 1.07) && (wysokosc <= 1.60) && (szerokosc > 1.07) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.62;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 1.93) && (szerokosc > 1.60) && (szerokosc <= 1.93) ) {
			metraz = wysokosc*1.98;
			}
			if ( (wysokosc > 1.93) && (wysokosc <= 2.11) && (szerokosc > 1.93) && (szerokosc <= 2.11) ) {
			metraz = wysokosc*2.16;
			}
			if ( (wysokosc > 2.11) && (wysokosc <= 2.47) && (szerokosc > 2.11) && (szerokosc <= 2.47) ) {
			metraz = wysokosc*2.52;
			}
			if ( (wysokosc > 1.86) && (wysokosc <= 2.65) && (szerokosc > 1.86) && (szerokosc <= 2.65) ) {
			metraz = wysokosc*2.70;
			}
			if ( (wysokosc > 2.65) && (wysokosc <= 3.20) && (szerokosc > 2.65) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.24;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*24.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*22.00;
		}
		if (metraz > 10.00) {
			cena = metraz*21.00;
		}	
	}
	if ($('input_5').value == 'bache 750g M2/B1' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if (szerokosc <= 0.79) {
			metraz = wysokosc*0.80;
			}
			if ( (szerokosc > 0.79) && (szerokosc <= 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( (szerokosc > 1.04) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 1.80) ) {
			metraz = wysokosc*1.85;
			}
			if ( (szerokosc > 1.80) && (szerokosc <= 2.05) ) {
			metraz = wysokosc*2.10;
			}
			if ( (szerokosc > 2.05) && (szerokosc <= 2.35) ) {
			metraz = wysokosc*2.40;
			}
			if ( (szerokosc > 2.35) && (szerokosc <= 2.60) ) {
			metraz = wysokosc*2.65;
			}
			if (szerokosc > 2.60) {
			metraz = wysokosc*3.20;
			}
		}
		
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if (wysokosc <= 0.79) {
			metraz = szerokosc*0.80;
			}
			if ( (wysokosc > 0.79) && (wysokosc <= 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( (wysokosc > 1.04) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 1.80) ) {
			metraz = szerokosc*1.85;
			}
			if ( (wysokosc > 1.80) && (wysokosc <= 2.05) ) {
			metraz = szerokosc*2.10;
			}
			if ( (wysokosc > 2.05) && (wysokosc <= 2.35) ) {
			metraz = szerokosc*2.40;
			}
			if ( (wysokosc > 2.35) && (wysokosc <= 2.60) ) {
			metraz = szerokosc*2.65;
			}
			if (wysokosc > 2.60) {
			metraz = szerokosc*3.20;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*28.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*26.00;
		}
		if (metraz > 10.00) {
			cena = metraz*24.00;
		}	
	}
	if ($('input_5').value == 'bache 750g M2/B1 recto verso' ) {
		
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ){
			if (szerokosc <= 0.79) {
			metraz = wysokosc*0.80;
			}
			if ( (szerokosc > 0.79) && (szerokosc <= 1.04) ) {
			metraz = wysokosc*1.05;
			}
			if ( (szerokosc > 1.04) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 1.80) ) {
			metraz = wysokosc*1.85;
			}
			if ( (szerokosc > 1.80) && (szerokosc <= 2.05) ) {
			metraz = wysokosc*2.10;
			}
			if ( (szerokosc > 2.05) && (szerokosc <= 2.35) ) {
			metraz = wysokosc*2.40;
			}
			if ( (szerokosc > 2.35) && (szerokosc <= 2.60) ) {
			metraz = wysokosc*2.65;
			}
			if (szerokosc > 2.60) {
			metraz = wysokosc*3.20;
			}
		}
		
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if (wysokosc <= 0.79) {
			metraz = szerokosc*0.80;
			}
			if ( (wysokosc > 0.79) && (wysokosc <= 1.04) ) {
			metraz = szerokosc*1.05;
			}
			if ( (wysokosc > 1.04) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 1.80) ) {
			metraz = szerokosc*1.85;
			}
			if ( (wysokosc > 1.80) && (wysokosc <= 2.05) ) {
			metraz = szerokosc*2.10;
			}
			if ( (wysokosc > 2.05) && (wysokosc <= 2.35) ) {
			metraz = szerokosc*2.40;
			}
			if ( (wysokosc > 2.35) && (wysokosc <= 2.60) ) {
			metraz = szerokosc*2.65;
			}
			if (wysokosc > 2.60) {
			metraz = szerokosc*3.20;
			}
		}
		
		if (metraz <= 5.00) {
			cena = metraz*36.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*34.00;
		}
		if (metraz > 10.00) {
			cena = metraz*32.00;
		}	
	}
	if ($('input_5').value == 'bache micro perforée M1/B1' ) {
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.60) && (wysokosc > 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( ( (szerokosc > 1.60) && (szerokosc <= 3.20) ) && ( (wysokosc <= 1.60) || (wysokosc > 3.20) ) ) {
			metraz = wysokosc*3.20;
			}
		}
		if ( (szerokosc <= 3.20) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 1.60) && (wysokosc <= 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( (szerokosc > 1.60) && (szerokosc <= 3.20) && (wysokosc > 1.60) && (wysokosc <= 3.20) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.60) && (szerokosc > 1.60) ) {
			metraz = szerokosc*1.60;
			}
			if ( ( (wysokosc > 1.60) && (wysokosc <= 3.20) ) && ( (szerokosc <= 1.60) || (szerokosc > 3.20) ) ) {
			metraz = szerokosc*3.20;
			}
		}
		if ( (wysokosc <= 3.20) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 1.60) && (szerokosc <= 1.60) ) {
			metraz = wysokosc*1.60;
			}
			if ( (wysokosc > 1.60) && (wysokosc <= 3.20) && (szerokosc > 1.60) && (szerokosc <= 3.20) ) {
			metraz = wysokosc*3.20;
			}
		}
		if (metraz <= 5.00) {
			cena = metraz*20.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*19.00;
		}
		if (metraz > 10.00) {
			cena = metraz*17.00;
		}	
	}
	if ($('input_5').value == 'bache 100% écologique M1' ) {
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.99) && (wysokosc > 0.99) ) {
			metraz = wysokosc*1.00;
			}
			if ( ( (szerokosc > 0.99) && (szerokosc <= 1.36) ) && ( (wysokosc <= 0.99) || (wysokosc > 1.36) ) ) {
			metraz = wysokosc*1.37;
			}
			if ( ( (szerokosc > 1.36) && (szerokosc <= 1.59) ) && ( (wysokosc <= 1.36) || (wysokosc > 1.59) ) ) {
			metraz = wysokosc*1.60;
			}
		}
		if ( (szerokosc <= 1.60) && (szerokosc <= wysokosc) ) {
			if ( (szerokosc <= 0.99) && (wysokosc <= 0.99) ) {
			metraz = szerokosc*1.00;
			}
			if ( (szerokosc > 0.99) && (szerokosc <= 1.36) && (wysokosc > 0.99) && (wysokosc <= 1.36) ) {
			metraz = szerokosc*1.37;
			}
			if ( (szerokosc > 1.36) && (szerokosc <= 1.59) && (wysokosc > 1.36) && (wysokosc <= 1.59) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.99) && (szerokosc > 0.99) ) {
			metraz = szerokosc*1.00;
			}
			if ( ( (wysokosc > 0.99) && (wysokosc <= 1.36) ) && ( (szerokosc <= 0.99) || (szerokosc > 1.36) ) ) {
			metraz = szerokosc*1.37;
			}
			if ( ( (wysokosc > 1.36) && (wysokosc <= 1.59) ) && ( (szerokosc <= 1.36) || (szerokosc > 1.59) ) ) {
			metraz = szerokosc*1.60;
			}
		}
		if ( (wysokosc <= 1.60) && (wysokosc <= szerokosc) ) {
			if ( (wysokosc <= 0.99) && (szerokosc <= 0.99) ) {
			metraz = wysokosc*1.00;
			}
			if ( (wysokosc > 0.99) && (wysokosc <= 1.36) && (szerokosc > 0.99) && (szerokosc <= 1.36) ) {
			metraz = wysokosc*1.37;
			}
			if ( (wysokosc > 1.36) && (wysokosc <= 1.59) && (szerokosc > 1.36) && (szerokosc <= 1.59) ) {
			metraz = wysokosc*1.60;
			}
        }
		if (metraz <= 5.00) {
			cena = metraz*30.00;
		}
		if ( (metraz > 5.00) && (metraz <= 10.00) ) {
			cena = metraz*29.00;
		}
		if (metraz > 10.00) {
			cena = metraz*27.00;
		}	
	}
}

////finition
if ($('input_6').value) { var fin = $('input_6').value; }
if ($('input_7').value) { var fin = $('input_7').value; }
if ($('input_8').value) { var fin = $('input_8').value; }
if ($('input_81').value) { var fin = $('input_81').value; }
	if (fin == 'pas de finition') {
		finition = metrazzaokraglony*1;
		cena = cena;
	}
	if (fin == 'oeillets+ourlets de renforts') {
		finition = metrazzaokraglony*1.5;
		cena = cena+finition;
	}
	if (fin == 'ourlet de renfort périmétrique') {
		finition = metrazzaokraglony*3.5;
		cena = cena+finition;
	}
	if (fin == 'oeillets+ourlets de renforts+fourreaux G/D') {
		finition = metrazzaokraglony*4;
		cena = cena+finition;
	}
	if (fin == 'fourreaux H/B+oeillets') {
		finition = metrazzaokraglony*4.5;
		cena = cena+finition;
	}
	if (fin == 'fourreaux G/D') {
		finition = 3.00;
		cena = cena+finition;
	}
	if (fin == 'oeillets/mètres') {
		finition = metrazzaokraglony*0.35;
		cena = cena+finition;
	}
	if (fin == 'nouettes') {
		finition = metrazzaokraglony*0.35;
		cena = cena+finition;
	}

////option de finition
	if ($('input_9').value == 'oeillets supplémentaires tous les 50 cm') { 
		option = metrazzaokraglony*0.80;
	}
	if ($('input_9').value == 'oeillets supplémentaires tous les 25 cm') { 
		option = metrazzaokraglony*1.60;
	}
	if ($('input_91').value == 'oeillets supplémentaires tous les 50 cm') { 
		option = metrazzaokraglony*0.80;
	}
	if ($('input_91').value == 'oeillets supplémentaires tous les 25 cm') { 
		option = metrazzaokraglony*1.60;
	}
	if ($('input_91').value == 'nouettes supplémentaires tous les 50 cm') { 
		option = metrazzaokraglony*0.80;
	}
	if ($('input_91').value == 'nouettes supplémentaires tous les 25 cm') { 
		option = metrazzaokraglony*1.60;
	}
////fixation
if ($('input_10').value) { var fix = $('input_10').value; }
if ($('input_11').value) { var fix = $('input_11').value; }
if ($('input_101').value) { var fix = $('input_101').value; }
	if (fix == 'tendeurs H/B tous les mètres') {
		fixation = (metrazzaokraglony+2)*.80;
		cena += fixation;
	}
	if (fix == '2 tourillons bois et sandows') {
		fixation = 9.90;
		cena += fixation;
	}
	if (fix == '2 piquets de bois') {
		fixation = 12.90;
		cena += fixation;
	}
	if (fix == 'drisse périmétrique') {
		fixation = (wysokosc+szerokosc)*2*1.5;
		cena += fixation;
	}
	if (fix == 'drisse fourreaux H/B') {
		fixation = (szerokosc+szerokosc)*3*1.0;
		cena += fixation;
	}
	var cenapojedyncza = cena;
	ilosc=$('input_13').value;
	cena += option;
	cena = cena*ilosc;
////rabaty
	if (ilosc>=2) {	
		if ((ilosc>=2) && (ilosc<=4)) {
			rabat=0.02;
		}
		if ((ilosc>=5) && (ilosc<=9)) {
			rabat=0.03;
		}
		if ((ilosc>=10) && (ilosc<=20)) {
			rabat=0.05;
		}
		if ((ilosc>=21) && (ilosc<=49)) {
			rabat=0.08;
		}
		if (ilosc>=50) {
			rabat=0.10;
		}
	}
	rabat = cena*rabat;
	rabat = fixstr(rabat);
	rabat2 = rabat.replace(".", ",");
	if (rabat != 0) {rabat2 = rabat2+' &euro;'}
	if (rabat == 0) {rabat2 = '-'}
	var remise = document.getElementById("remise");
	remise.innerHTML=rabat2;
	
////reszta
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
	var ducro = $$('#ducro').collect(function(e){ return e.checked; }).any();
	if (ducro == true) {
		cenapojedyncza += 35.00;
		cena += 35.00 * ilosc;
		cedzik += '<br />- Livraison sans plis';
	}

	var ktodaje;
	if ($('input_12').value == 'fb') {
		cenapojedyncza+=29;
		cena += 29*ilosc;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_12').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	if ($('input_121').value == 'fb') {
		cenapojedyncza+=29;
		cena += 29*ilosc;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_121').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}

	cenapojedyncza=fixstr(cenapojedyncza);
	cenapojedyncza2 = cenapojedyncza.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cenapojedyncza2+' &euro;';

	if (option>0) {
		option=fixstr(option);
		option2 = option.replace(".", ",");
		var opt = document.getElementById("option");
		opt.innerHTML=option2+' &euro;';
	}
	if (option==0) {
		option2 = '-';
		var opt = document.getElementById("option");
		opt.innerHTML='-';
	}

	suma=cena-rabat;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';	
	//jesli mniejsze niz 49 euro - forfait
var niepokazuj = 0;
	if ( suma < 29 ) {
		var forfait = 29 - suma;
		forfait = fixstr(forfait);
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
		if (option>0) {
			var newoption = parseFloat(option) + parseFloat(forfait);
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
		} else {
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
		
//		niepokazuj=2;
	}
	
	if ( (szerokosc >= 2) && (wysokosc >= 2) && ($('input_4').value != 'bache 150g') && ($('input_3').value != 'bache 150g') ) {		
		eBox.innerHTML = '<div style="color:#008ec0">"Livraison sans plis" idéal pour les banderoles supérieur ou égal à 2 M de hauteur</div>';
		niepokazuj=0;
	}
	if ( ($('input_3').value == 'bache 100% écologique M1') && (szerokosc > 1.6) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache 100% écologique M1') && (szerokosc > 1.6) ) {
		var blad = document.getElementById("id_4");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_5').value == 'bache 100% écologique M1') && (szerokosc > 1.6) ) {
		var blad = document.getElementById("id_5");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_3').value == 'bache 440g') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_3').value == 'bache micro perforée M1/B1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache micro perforée M1/B1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_4");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_5').value == 'bache micro perforée M1/B1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_5");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_3').value == 'bache 150g') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache 150g') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_4");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	
	
	if ( ($('input_5').value == 'bache 150g') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_5");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_3').value == 'bache 150g') && (metraz*ilosc < 50.00)) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Commande minimum de 50m²!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache 150g') && (metraz*ilosc < 50.00)) {
		var blad = document.getElementById("id_4");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Commande minimum de 50m²!';
		niepokazuj=1;
	}
	if ( ($('input_5').value == 'bache 150g') && (metraz*ilosc < 50.00)) {
		var blad = document.getElementById("id_5");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Commande minimum de 50m²!';
		niepokazuj=1;
	}
	
	
	if ( ($('input_3').value == 'bache 550g') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_3').value == 'bache 450g M1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache 450g M1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_5').value == 'bache 450g M1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	
	if ( ($('input_3').value == 'bache 750g M2/B1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache 750g M2/B1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;

	}
	if ( ($('input_5').value == 'bache 750g M2/B1') && (szerokosc > 3.2) && (wysokosc > 3.2) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 3.20m!';
		niepokazuj=1;
	}
	
	if ( ($('input_3').value == 'bache 750g M2/B1 recto verso') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'bache 750g M2/B1 recto verso') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	if ( ($('input_5').value == 'bache 750g M2/B1 recto verso') && (szerokosc > 1.6) && (wysokosc > 1.6) ) {
		var blad = document.getElementById("id_3");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou  Largeur doit être inférieure à 1.60m!';
		niepokazuj=1;
	}
	


	if ( ($('input_11').value == '2 tourillons bois et sandows') && (szerokosc > 1.05) ) {
		var blad = document.getElementById("id_11");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.05m!';
		niepokazuj=1;
	}
	if ( ($('input_11').value == '2 piquets de bois') && (szerokosc > 1.55) ) {
		var blad = document.getElementById("id_11");		
		var blad2 = document.getElementById("id_14");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.55m!';
		niepokazuj=1;
	}
if (niepokazuj==1) {
	prix.innerHTML='-';
	opt.innerHTML='-';
	remise.innerHTML='-';
	total.innerHTML='-';
}
if (niepokazuj==2) {
}
if (niepokazuj==0) {
/////transport
	var metraztransport = metraz*ilosc;
	if (metraztransport <= 2) { transport=9.90; }
	if ( (metraztransport > 2) && (metraztransport <= 4) ) { transport=11.90; }
	if ( (metraztransport > 4) && (metraztransport <= 7) ) { transport=14.20; }
	if ( (metraztransport > 7) && (metraztransport <= 15) ) { transport=19.50; }
	if ( (metraztransport > 15) && (metraztransport <= 30) ) { transport=26.90; }
	if ( (metraztransport > 30) && (metraztransport <= 50) ) { transport=33.10; }
	if ( (metraztransport > 50) && (metraztransport <= 100) ) { transport=48.00; }
	if ( (metraztransport > 100) && (metraztransport <= 200) ) { transport=68.00; }
	if (metraztransport > 200) { transport=0; }
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		etiqdesc = '<br />- retrait colis a l\'atelier';
	}
            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                etiqdesc = etiqdesc + "<br />- Livraison gratuite avec FEDEX";
                transport = 0;
            }
/////koszyk	
	var dodajkoszyk = document.getElementById("cart_form");
	if ($('input_3').value) { var ktorytyp=$('input_3').value; }
	if ($('input_4').value) { var ktorytyp=$('input_4').value; }
	if ($('input_5').value) { var ktorytyp=$('input_5').value; }
	if ($('input_6').value) { var ktorefinition=$('input_6').value; }
	if ($('input_7').value) { var ktorefinition=$('input_7').value; }
	if ($('input_8').value) { var ktorefinition=$('input_8').value; }
	if ($('input_81').value) { var ktorefinition=$('input_81').value; }
	if ($('input_10').value) { var ktorefixation=$('input_10').value; }
	if ($('input_101').value) { var ktorefixation=$('input_101').value; }
	if ($('input_11').value) { var ktorefixation=$('input_11').value; }

	var opiskoszyka = '- '+$('input_1').value+'<br />- '+ktorytyp+'<br />- '+ktorefinition+'<br />- '+$('input_9').value+'  '+$('input_91').value+'<br />- '+ktorefixation+'<br /> - '+ktodaje+cedzik+remisik+'<br />';
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Banderole" /><input type="hidden" name="opis" value="'+opiskoszyka+'- '+szerokosc+' x '+wysokosc+'m'+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cenapojedyncza2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

//}


},


cal_stickers: function(){  
var cena=0; var cena2=0;
var rabat=0; var rabat2=0;
var suma=0; var suma2=0;
var transport=0;
var metraz=0;
var szerokosc=0;
var wysokosc=0;
var option2=0;
var cedzik = '';
var niepokazuj = 0;
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';
var ax1 = document.getElementById("id_1");
var ax2 = document.getElementById("id_8");
var ax3 = document.getElementById("id_14");
if (ax1) { 
	ax1.style.background="none";
	ax1.style.border="none";
	ax1.style.borderBottom="1px solid #9fa3a8";
}
if (ax2) { 
	ax2.style.background="none";
	ax2.style.border="none";
	ax2.style.borderBottom="1px solid #9fa3a8";
}
if (ax3) { 
	ax3.style.background="none";
	ax3.style.border="none";
	ax3.style.borderBottom="1px solid #9fa3a8";
}

if ( ($('input_1').value) && ( ($('input_21').value) || ($('input_22').value) || ($('input_23').value) || ($('input_24').value) || ($('input_25').value) ) && ( ($('input_4').value) || ($('input_3').value) || ($('input_33').value) ) && ($('input_6').value) && ($('input_7').value) && ($('input_8').value) && ($('input_9').value) ) {
	var ktorytyp='';
	var ktorapodstawa='';
	var ktorapodstawa='';
	var lam='';
	var tape='';

	szerokosc = ($('input_8').value);
	szerokosc = szerokosc.replace(',','.');
	szerokosc = fixstr(szerokosc);
	$('input_8').value = szerokosc;
	wysokosc = ($('input_9').value);
	wysokosc = wysokosc.replace(',','.');
	wysokosc = fixstr(wysokosc);
	$('input_9').value = wysokosc;
	metraz = szerokosc * wysokosc;
	metraz = fixstr(metraz);


	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'permanent') && ($('input_33').value == 'pas de lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.002;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'permanent') && ($('input_33').value == 'lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.003;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'semi-permanent') && ($('input_33').value == 'pas de lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.002;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'semi-permanent') && ($('input_33').value == 'lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.003;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'vinyle micro-perforè M1 dos noir') && ($('input_33').value == 'pas de lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.0035;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'vinyle micro-perforè M1 dos noir') && ($('input_33').value == 'lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.0045;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'permanent75μ') && ($('input_33').value == 'pas de lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.0055;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'permanent75μ') && ($('input_33').value == 'lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.0065;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'vinyle magnètique') && ($('input_33').value == 'pas de lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.0055;
		}
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'vinyle magnètique') && ($('input_33').value == 'lamination') ) {
		ktorytyp='Autocollant (carré/rectangulaire)';
		ktorapodstawa = ($('input_21').value);
		lam = ($('input_33').value);
				cena = metraz*0.0065;
		}		
	
	
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0030;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0045;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0040;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0055;
		}
	
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'semi-permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0030;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'semi-permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0045;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'semi-permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0040;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'semi-permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0055;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0065;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.008;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0075;
		}
	if ( ($('input_1').value == 'predecoupe') && ($('input_22').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Sticker prédécoupé / Forme personnalisée';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0090;
		}	
		
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0025;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.004;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0035;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.005;
		}
	
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'semi-permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0025;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'semi-permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.004;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'semi-permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0035;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'semi-permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.005;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.006;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0075;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.007;
		}
	if ( ($('input_1').value == 'lettrage-blanc') && ($('input_23').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage blanc prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0085;
		}	
	
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.003;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0045;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.004;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0055;
		}
	
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'semi-permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.003;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'semi-permanent') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0045;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'semi-permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.004;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'semi-permanent') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0055;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0065;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.008;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0075;
		}
	if ( ($('input_1').value == 'lettrage-couleur') && ($('input_24').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Lettrage couleur prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.009;
		}
	

	if ( ($('input_1').value == 'covering') && ($('input_25').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Covering coulé prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.007;
		}
	if ( ($('input_1').value == 'covering') && ($('input_25').value == 'permanent75μ') && ($('input_3').value == 'pas de lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Covering coulé prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0085;
		}
	if ( ($('input_1').value == 'covering') && ($('input_25').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'Pas de film de pose') ) {
		ktorytyp='Covering coulé prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.008;
		}
	if ( ($('input_1').value == 'covering') && ($('input_25').value == 'permanent75μ') && ($('input_3').value == 'lamination') && ($('input_4').value == 'tape') ) {
		ktorytyp='Covering coulé prédécoupé';
		ktorapodstawa = ($('input_22').value);
		lam = ($('input_3').value);
		tape = ($('input_4').value);
				cena = metraz*0.0095;
		}
		
///////	
	
	

ilosc=$('input_7').value;





	var ktodaje;
	if ($('input_6').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_6').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}

	var cenapojedyncza = cena;
	var iloscmetrow1=metraz*ilosc;

	if (ilosc) {
		cena=cenapojedyncza*ilosc;
		iloscmetrow=iloscmetrow1/10000;
	}
	

///////

	var colis = $$('#colis').collect(function(e){ return e.checked; }).any();
	if (colis == true) {
		cedzik += '<br />- colis revendeur';
		
	}
	var metre=(metraz/10000)*ilosc;
	var rush24 = $$('#rush24').collect(function(e){ return e.checked; }).any();
	if (rush24 == true) {
		if (metre <= 1) {
			cenapojedyncza += (59.00/ilosc);
			cena += 59.00;
		}
		if ((metre > 1) && (metre <= 2)) {
			cenapojedyncza += (98.00/ilosc);
			cena += 98.00;
		}
		if ((metre > 2) && (metre <= 3)) {
			cenapojedyncza += (117.00/ilosc);
			cena += 117.00;
		}
		if ((metre > 3) && (metre <= 4)) {
			cenapojedyncza += (156.00/ilosc);
			cena += 156.00;
		}
		if ((metre > 4) && (metre <= 5)) {
			cenapojedyncza += (195.00/ilosc);
			cena += 195.00;
		}
		if ((metre > 5) && (metre <= 6)) {
			cenapojedyncza += (174.00/ilosc);
			cena += 174.00;
		}
		if ((metre > 6) && (metre <= 7)) {
			cenapojedyncza += (203.00/ilosc);
			cena += 203.00;
		}
		if ((metre > 7) && (metre <= 8)) {
			cenapojedyncza += (232.00/ilosc);
			cena += 232.00;
		}
		if ((metre > 8) && (metre <= 9)) {
			cenapojedyncza += (171.00/ilosc);
			cena += 171.00;
		}
		if ((metre > 9) && (metre <= 10)) {
			cenapojedyncza += (190.00/ilosc);
			cena += 190.00;
		}
		if ((metre > 10) && (metre <= 11)) {
			cenapojedyncza += (209.00/ilosc);
			cena += 209.00;
		}
		if ((metre > 11) && (metre <= 12)) {
			cenapojedyncza += (228.00/ilosc);
			cena += 228.00;
		}
		if ((metre > 12) && (metre <= 13)) {
			cenapojedyncza += (247.00/ilosc);
			cena += 247.00;
		}
		if ((metre > 13) && (metre <= 14)) {
			cenapojedyncza += (266.00/ilosc);
			cena += 266.00;
		}
		if ((metre > 14) && (metre <= 15)) {
			cenapojedyncza += (285.00/ilosc);
			cena += 285.00;
		}
		if ((metre > 15) && (metre <= 16)) {
			cenapojedyncza += (304.00/ilosc);
			cena += 304.00;
		}
		if ((metre > 16) && (metre <= 17)) {
			cenapojedyncza += (323.00/ilosc);
			cena += 323.00;
		}
		if ((metre > 17) && (metre <= 18)) {
			cenapojedyncza += (342.00/ilosc);
			cena += 342.00;
		}
		if ((metre > 18) && (metre <= 19)) {
			cenapojedyncza += (361.00/ilosc);
			cena += 361.00;
		}
		if ((metre > 19) && (metre <= 20)) {
			cenapojedyncza += (380.00/ilosc);
			cena += 380.00;
		}
		
		cedzik += '<br />- délai rush 24/48H';
	}
	var rush72 = $$('#rush72').collect(function(e){ return e.checked; }).any();
	if (rush72 == true) {
		if (metre <= 1) {
			cenapojedyncza += (49.00/ilosc);
			cena += 49.00;
		}
		if ((metre > 1) && (metre <= 2)) {
			cenapojedyncza += (78.00/ilosc);
			cena += 78.00;
		}
		if ((metre > 2) && (metre <= 3)) {
			cenapojedyncza += (87.00/ilosc);
			cena += 87.00;
		}
		if ((metre > 3) && (metre <= 4)) {
			cenapojedyncza += (116.00/ilosc);
			cena += 116.00;
		}
		if ((metre > 4) && (metre <= 5)) {
			cenapojedyncza += (145.00/ilosc);
			cena += 145.00;
		}
		if ((metre > 5) && (metre <= 6)) {
			cenapojedyncza += (114.00/ilosc);
			cena += 114.00;
		}
		if ((metre > 6) && (metre <= 7)) {
			cenapojedyncza += (133.00/ilosc);
			cena += 133.00;
		}
		if ((metre > 7) && (metre <= 8)) {
			cenapojedyncza += (152.00/ilosc);
			cena += 152.00;
		}
		if ((metre > 8) && (metre <= 9)) {
			cenapojedyncza += (81.00/ilosc);
			cena += 81.00;
		}
		if ((metre > 9) && (metre <= 10)) {
			cenapojedyncza += (90.00/ilosc);
			cena += 90.00;
		}
		if ((metre > 10) && (metre <= 11)) {
			cenapojedyncza += (99.00/ilosc);
			cena += 99.00;
		}
		if ((metre > 11) && (metre <= 12)) {
			cenapojedyncza += (108.00/ilosc);
			cena += 108.00;
		}
		if ((metre > 12) && (metre <= 13)) {
			cenapojedyncza += (117.00/ilosc);
			cena += 117.00;
		}
		if ((metre > 13) && (metre <= 14)) {
			cenapojedyncza += (126.00/ilosc);
			cena += 126.00;
		}
		if ((metre > 14) && (metre <= 15)) {
			cenapojedyncza += (135.00/ilosc);
			cena += 135.00;
		}
		if ((metre > 15) && (metre <= 16)) {
			cenapojedyncza += (144.00/ilosc);
			cena += 144.00;
		}
		if ((metre > 16) && (metre <= 17)) {
			cenapojedyncza += (153.00/ilosc);
			cena += 153.00;
		}
		if ((metre > 17) && (metre <= 18)) {
			cenapojedyncza += (162.00/ilosc);
			cena += 162.00;
		}
		if ((metre > 18) && (metre <= 19)) {
			cenapojedyncza += (171.00/ilosc);
			cena += 171.00;
		}
		if ((metre > 19) && (metre <= 20)) {
			cenapojedyncza += (180.00/ilosc);
			cena += 180.00;
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
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	if (etiquette == true) {
		transport=0;
		cenapojedyncza += 0;
		cena += 0;
		cedzik += '<br />- retrait colis a l\'atelier';
	}


	if ((etiquette == false) && (iloscmetrow<=2)) { transport=9.9; }
	if ((etiquette == false) && (iloscmetrow>2) && (iloscmetrow<=4)) { transport=12.9; }
	if ((etiquette == false) && (iloscmetrow>4) && (iloscmetrow<=7)) { transport=16.2; }
	if ((etiquette == false) && (iloscmetrow>7) && (iloscmetrow<=15)) {	transport=22.5; }
	if ((etiquette == false) && (iloscmetrow>15) && (iloscmetrow<=30)) { transport=29.9; }
	if ((etiquette == false) && (iloscmetrow>30) && (iloscmetrow<=50)) { transport=36.1; }
	if (iloscmetrow>50) { transport=0; }
	/*var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	if (etiquette == true) {
		transport=0;
		cedzik += '<br />- retrait colis a l\'atelier';
	}	 */		
/* koszty transportu */	
	var niepokazuj = 0;

                if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                    cedzik += "<br />- Livraison gratuite avec FEDEX";
                    transport = 0;
                }
				
				
	suma=cena-rabat;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';

	var forfait = 45 - suma;
	if (forfait > 0) {
		forfait = fixstr(forfait);
		eBox.innerHTML = 'FORFAIT '+forfait+' &euro;<br />';
		var newoption = parseFloat(forfait);
		newoption=fixstr(newoption);
		newoption2 = newoption.replace(".", ",");
		option2 = newoption2;
		var newopt = document.getElementById("option");
		newopt.innerHTML=newoption2+' &euro;';
		suma = 45;
		suma=fixstr(suma);
		suma2 = suma.replace(".", ",");
		var newtotal = document.getElementById("total");
		newtotal.innerHTML=suma2+' &euro;';
	}
	 
	
	
	
		var dodajkoszyk = document.getElementById("cart_form");
		dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Vinyles Stickers" /><input type="hidden" name="opis" value="- '+ktorytyp+'<br />- '+ktorapodstawa+'<br />- '+lam+'<br />- '+tape+'<br />- '+ktodaje+'<br />- '+szerokosc+' x '+wysokosc+'cm'+cedzik+'<br />- '+ilosc+' exemplaire(s)" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="'+option2+'" /><input type="hidden" name="remise" value="-" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
		
			
	if ( ($('input_1').value == 'Formes') && (szerokosc > 160) && (wysokosc > 160) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 160cm!';
		niepokazuj=1;
	}
	
	if ( ($('input_1').value == 'Formes') && ($('input_21').value == 'vinyle magnètique') && (szerokosc > 60) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");
		var blad3 = document.getElementById("id_21");
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		blad3.style.background = "#FFAAAA";
		blad3.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Largeur doit être inférieure à 60cm!';
		niepokazuj=1;
	}
	
	if ( ($('input_1').value == 'predecoupe') && (szerokosc > 103) && (wysokosc > 103) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 103cm!';
		niepokazuj=1;
	}
	
	if ( ($('input_1').value == 'predecoupe') && ((szerokosc < 10) || (wysokosc < 10)) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur et Largeur supérieur ou égal à 10cm!';
		niepokazuj=1;
	}
	if ( ($('input_1').value == 'Formes') && ((szerokosc < 10) || (wysokosc < 10)) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur et Largeur supérieur ou égal à 10cm!';
		niepokazuj=1;
	}
	if ( ($('input_1').value == 'lettrage-blanc') && ((szerokosc < 10) || (wysokosc < 10)) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur et Largeur supérieur ou égal à 10cm!';
		niepokazuj=1;
	}
	if ( ($('input_1').value == 'covering') && ((szerokosc < 10) || (wysokosc < 10)) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur et Largeur supérieur ou égal à 10cm!';
		niepokazuj=1;
	}
	
	if ( ($('input_1').value == 'lettrage-couleur') && ((szerokosc < 10) || (wysokosc < 10)) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur et Largeur supérieur ou égal à 10cm!';
		niepokazuj=1;
	}
	
	
	
	if ( ($('input_1').value == 'lettrage-blanc') && (szerokosc > 103) && (wysokosc > 103) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 103cm!';
		niepokazuj=1;
	}
	if ( ($('input_1').value == 'lettrage-couleur') && (szerokosc > 103) && (wysokosc > 103) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 103cm!';
		niepokazuj=1;
	}
	if ( ($('input_1').value == 'covering') && (szerokosc > 103) && (wysokosc > 103) ) {
		var blad = document.getElementById("id_1");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 103cm!';
		niepokazuj=1;
	}
	if ( ($('input_4').value == 'tape') && (szerokosc > 103) && (wysokosc > 103) ) {
		var blad = document.getElementById("id_4");		
		var blad2 = document.getElementById("id_8");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		blad2.style.background = "#FFAAAA";
		blad2.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'Hauteur ou Largeur doit être inférieure à 103cm!';
		niepokazuj=1;
	}
	if (niepokazuj==1) {
	prix.innerHTML='-';
	remise.innerHTML='-';
	option.innerHTML='-';
	total.innerHTML='-';
	dodajkoszyk.innerHTML='-';
	}			
			
			
			
} 


	
},


cal_oriflamme: function(){  
var cena=0; var cena2=0;
var prixHT=0; var marge=0; var composant=0;
var rabat=0; var rabat2=0;
var suma=0; var suma2=0;
var transport=0;
var structure=0;
var impression=0;
var pied=0;	
var option=0; var options1=0; var options2=0; var options3=0; var options4=0; maquette=0;		
var dodatkowytransport = 0;
var cedzik = '';
var eBox = document.getElementById('form-button-error2');
eBox.innerHTML='';

if ( ($('input_1').value) ) {
	var ktorytyp='';
	var ktorywymiar ='';
	var ktorapodstawa='';
	
	if ($('input_1').value == 'drapeaux') {
		ktorytyp='Drapeaux';
		ilosc = $('input_9').value;
		if ($('input_20').value == '25x35') {
			if ($('input_9').value == 1) {
			prixHT = 44;}
			if (($('input_9').value > 1) && ($('input_9').value <= 5)) {
			prixHT = 28;}
			if (($('input_9').value > 5) && ($('input_9').value <= 9)) {
			prixHT = 21;}
			if (($('input_9').value > 9) && ($('input_9').value <= 49)) {
			prixHT = 18;}
			if ($('input_9').value > 49) {
			prixHT = 15.90;}
			
			ktorywymiar = '25x35';
		}
		if ($('input_20').value == '40x50') {
			if ($('input_9').value == '1') {
			prixHT = 49;}
			if (($('input_9').value > 1) && ($('input_9').value <= 5)) {
			prixHT = 32;}
			if (($('input_9').value > 5) && ($('input_9').value <= 9)) {
			prixHT = 26;}
			if (($('input_9').value > 9) && ($('input_9').value <= 49)) {
			prixHT = 22;}
			if ($('input_9').value > 49) {
			prixHT = 19.90;}
			
			ktorywymiar = '40x50';
		}
		if ($('input_20').value == '75x100') {
			if ($('input_9').value == 1) {
			prixHT = 62;}
			if (($('input_9').value > 1) && ($('input_9').value <= 5)) {
			prixHT = 44;}
			if (($('input_9').value > 5) && ($('input_9').value <= 9)) {
			prixHT = 36;}
			if (($('input_9').value > 9) && ($('input_9').value <= 49)) {
			prixHT = 32;}
			if ($('input_9').value > 49) {
			prixHT = 29.90;}
			
			ktorywymiar = '75x100';
		}
		
	}
	if ($('input_1').value == 'oriflamme') {
		ktorytyp='Oriflamme aile d’avion';
		ilosc=$('input_9').value;
		if ($('input_21').value == 'oriflamme-54x190') {
			structure = 13;
			if ($('input_9').value =='1') {
			impression = 41;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value== '5') {
			impression = 34;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 29;}
			if ($('input_9').value >= 10) {
			impression = 28;}
			cena=structure+impression;
			ktorywymiar = '54x240';
		}
		if ($('input_21').value == 'oriflamme-85x245') {
			structure = 13;
			if ($('input_9').value =='1') {
			impression = 49;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 41;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 36;}
			if ($('input_9').value >= 10) {
			impression = 34;}
			ktorywymiar = '85x308';
		}
		if ($('input_21').value == 'oriflamme-85x298') {
			structure = 15;
			if ($('input_9').value =='1') {
			impression = 56;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 49;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 44;}
			if ($('input_9').value >= 10) {
			impression = 43;}
			ktorywymiar = '85x351';
		}
		if ($('input_21').value == 'oriflamme-85x397') {
			structure = 22;
			if ($('input_9').value =='1') {
			impression = 69;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 61;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 55;}
			if ($('input_9').value >= 10) {
			impression = 54;}
			ktorywymiar = '85x465';
		}
	}
	
	
		if ($('input_1').value == 'beachflag') {
		ktorytyp='Beachflag goutte d’eau';
		ilosc=$('input_9').value;
		if ($('input_22').value == 'beachflag-72x156') {
			structure = 15;
			if ($('input_9').value =='1') {
			impression = 41;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value== '5') {
			impression = 34;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 29;}
			if ($('input_9').value >= 10) {
			impression = 28;}
			cena=structure+impression;
			ktorywymiar = '72x203';
		}
		if ($('input_22').value == 'beachflag-75x213') {
			structure = 15;
			if ($('input_9').value =='1') {
			impression = 49;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 42;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 37;}
			if ($('input_9').value >= 10) {
			impression = 36;}
			ktorywymiar = '75x254';
		}
		if ($('input_22').value == 'beachflag-106x257') {
			structure = 19;
			if ($('input_9').value =='1') {
			impression = 62;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 55;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 49;}
			if ($('input_9').value >= 10) {
			impression = 48;}
			ktorywymiar = '106x323';
		}
		if ($('input_22').value == 'beachflag-125x402') {
			structure = 24;
			if ($('input_9').value =='1') {
			impression = 85;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 76;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 70;}
			if ($('input_9').value >= 10) {
			impression = 69;}
			ktorywymiar = '125x460';
		}
	}
	
	if ($('input_1').value == 'windflag') {
		ktorytyp='Windflag rectangulaire';
		ilosc=$('input_9').value;
		if ($('input_23').value == 'windflag-59x180') {
			structure = 22;
			if ($('input_9').value =='1') {
			impression = 37;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value== '5') {
			impression = 30;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 25;}
			if ($('input_9').value >= 10) {
			impression = 24;}
			cena=structure+impression;
			ktorywymiar = '63x256';
		}
		if ($('input_23').value == 'windflag-80x280') {
			structure = 85;
			if ($('input_9').value =='1') {
			impression = 58;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 50;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 45;}
			if ($('input_9').value >= 10) {
			impression = 44;}
			ktorywymiar = '80x410';
		}
		if ($('input_23').value == 'windflag-100x350') {
			structure = 115;
			if ($('input_9').value =='1') {
			impression = 74;}
			if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
			impression = 66;}
			if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') 					
			{impression = 60;}
			if ($('input_9').value >= 10) {
			impression = 59;}
			ktorywymiar = '100x530';
		}
	}
	

	if ($('input_6').value == 'Embase 8kg') {
			pied=32;	
			ktorapodstawa='Embase 8kg';
		}
	if ($('input_6').value == 'Embase carrée 13,5kg') {
			pied=42;	
			ktorapodstawa='Embase carrée 13,5kg';

		}
	if ($('input_6').value == 'Pied 4 branches + bouée') {
			pied=18;	
			ktorapodstawa='Pied 4 branches + bouée';
		}
	if ($('input_6').value == 'Pied piquet') {
			pied=16;	
			ktorapodstawa='Pied piquet';
		}
	if ($('input_6').value == 'Pied voiture') {
			pied=16;	
			ktorapodstawa='Pied voiture';
		}
	if ($('input_6').value == 'Pied à visser') {
			pied=10;	
			ktorapodstawa='Pied à visser';
		}
		
	if ($('input_6').value == 'Pied parasol 23L') {
			pied=14;	
			ktorapodstawa='Pied parasol 23L';
		}

	
	if ($('input_3').value == 'Kit complet') {
		prixHT=structure+impression+pied;
		composant='Kit complet'
		}
	if ($('input_3').value == 'Structure + Voile') {
		prixHT=structure+impression;
		composant='Structure + Voile'
		}
	if ($('input_3').value == 'Voile seule') {
		prixHT=impression;
		composant='Voile seule'
		}
	if ($('input_3').value == 'Structure seule') {
		prixHT=structure;
		composant='Structure seule'
		}
	if ($('input_1').value == 'windflag') {
		prixHT=structure+impression;
		}
		
	/* marge*/		
	if ($('input_9').value =='1') {
		marge = (prixHT*50)/100;}
	if ($('input_9').value == '2' || $('input_9').value == '3' || $('input_9').value == '4' || $('input_9').value == '5') {
		marge = (prixHT*46)/100;}
	if ($('input_9').value == '6' || $('input_9').value == '7' || $('input_9').value == '8' || $('input_9').value == '9') { 					
		marge = (prixHT*42)/100;}
	if ($('input_9').value >= 10) {
		marge = (prixHT*39)/100;}
	/* maquette*/	
	var ktodaje = '';
	
		if ($('input_8').value == 'fb') {
			maquette=29;
			options1=(29*ilosc);
			ktodaje = '<br />- France banderole crée la maquette';
		}
		if ($('input_8').value == 'user') {
			ktodaje = '<br />- j’ai déjà crée la maquette';
		}
		
	/* cena*/
		
	if ($('input_1').value == 'beachflag' || $('input_1').value == 'oriflamme') {
	var cenapojedyncza = (prixHT+marge+maquette);
	ilosc=$('input_9').value;
	cena=cenapojedyncza*ilosc;
	}
	
	if ($('input_1').value == 'windflag') {
	var cenapojedyncza = (prixHT+marge+maquette);
	ilosc=$('input_9').value;
	cena=cenapojedyncza*ilosc;
	}
	
	if ($('input_1').value == 'drapeaux') {
	var cenapojedyncza = prixHT+maquette;
	ilosc=$('input_9').value;
	cena=cenapojedyncza*ilosc;
	}
	
	

	

////////////
	
	

///////
	var relais = $$('#relais').collect(function(e){ return e.checked; }).any();
	if (relais == true) {
		cenapojedyncza += 5.00/ilosc;
		cena += 5.00;
		options2=5.00;
		cedzik += '<br />- relais colis';
	}
	
	var rush24 = $$('#rush24').collect(function(e){ return e.checked; }).any();
	if (rush24 == true) {
		cenapojedyncza += (cenapojedyncza*15)/100;
		cena += (cena*15)/100;
		options3 = (cena*15)/100;
		cedzik += '<br />- Express 4 à 7 jours ouvrés';
	}
	
	var antifeu = $$('#antifeu').collect(function(e){ return e.checked; }).any();
	if (antifeu == true) {
		/* cenapojedyncza += (cenapojedyncza*20)/100;*/
		cena += (cena*20)/100;
		options4 = (cena*20)/100;
		cedzik += '<br />- Voile anti-feu';
	}
/////////
	var pu = (cena)/ilosc;	
	pu=fixstr(pu);
	cena2 = pu.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';
	
/* option 
option = options1+options2+options3+options4;	
if (option>0) {
		option=fixstr(option);
		option2 = option.replace(".", ",");
		var opt = document.getElementById("option");
		opt.innerHTML=option2+' &euro;';
	}
	if (option==0) {
		option2 = '-';
		var opt = document.getElementById("option");
		opt.innerHTML='-';
	}*/	
		
/* koszty transportu */	
	if (ilosc==1) {	transport=11,9; }
	if ((ilosc>=2) && (ilosc<=5)) {	transport=24,9; }
	if ((ilosc>=6) && (ilosc<=9)) {	transport=46,9; }
	if (ilosc>=10) { transport=95,0; }

	transport = transport + dodatkowytransport;
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		etiqdesc = '<br />- retrait colis a l\'atelier';
	}
	
            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                etiqdesc += '<br />- Livraison gratuite avec Fedex.'
                transport = 0;
            }
				
/* /koszty transportu */	


	suma=cena;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';
	

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Oriflamme" /><input type="hidden" name="opis" value="- '+ktorytyp+' '+ktorywymiar+'<br />- '+composant+'<br />- '+ktorapodstawa+ktodaje+cedzik+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

},


cal_parapluie: function(){  
var cena=0; var cena2=0;
var rabat=0; var rabat2=0;
var suma=0; var suma2=0;
var transport=0;	
var ktorytyp='';
var cedzik='';
var dodatkowaopcja='';

if ( ($('input_0').value) && ((($('input_2').value) && ($('input_7').value) && ($('input_8').value)) || (($('input_1').value) && ($('input_7').value) && ($('input_8').value)) || (($('input_50').value) && ($('input_51').value) && ($('input_6').value) && ($('input_7').value) && ($('input_8').value))) ) {
  if ($('input_0').value == 'Tissu') {
	transport = 49;
	if ($('input_50').value == '1' ) {
		cena = 439;
		dodatkowaopcja += '<br />- Recto simple 3x1';
	}
	if ($('input_50').value == '2' ) {
		cena = 529;
		dodatkowaopcja += '<br />- Recto simple 3x2';
	}
	if ($('input_50').value == '3' ) {
		cena = 599;
		dodatkowaopcja += '<br />- Recto simple 3x3';
	}
	if ($('input_50').value == '4' ) {
		cena = 774;
		dodatkowaopcja += '<br />- Recto simple 3x4';
	}
	if ($('input_50').value == '5' ) {
		cena = 969;
		dodatkowaopcja += '<br />- Dimensions 3x5';
	}
	if ($('input_50').value == '6' ) {
		cena = 609;
		dodatkowaopcja += '<br />- Recto Verso 3x1';
	}
	if ($('input_50').value == '7' ) {
		cena = 794;
		dodatkowaopcja += '<br />- Recto Verso 3x2';
	}
	if ($('input_50').value == '8' ) {
		cena = 979;
		dodatkowaopcja += '<br />- Recto Verso 3x3';
	}
	if ($('input_50').value == '9' ) {
		cena = 1224;
		dodatkowaopcja += '<br />- Recto Verso 3x4';
	}
	if ($('input_50').value == '10' ) {
		cena = 1504;
		dodatkowaopcja += '<br />- Recto Verso 3x5';
	}
	if ($('input_51').value == '1' ) {
		cena += 66;
		dodatkowaopcja += '<br />- 2 spots hallogène 150w';
	}
	if ($('input_51').value == '0' ) {
		dodatkowaopcja += '<br />- non merci';
	}

 	if ($('input_6').value == '41' ) {
		cena += 299;
		transport += 18;
		dodatkowaopcja += '<br />- Valise de transport / Comptoir accueil';
	}
	if ($('input_6').value == '0' ) {
		dodatkowaopcja += '<br />- non merci';
	}

	var ktodaje;
	if ($('input_7').value == 'fb') {
		cena+=40;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_7').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}	
}




////
 if ($('input_0').value == 'Stand ExpoBag') {
	cena = 649;
	transport = 29;
	if ($('input_2').value == '1' ) {
		cena = cena+80;
		dodatkowaopcja += '<br />- 2 spots hallogene 35w aluminium';
	}
	var ktodaje;
	if ($('input_7').value == 'fb') {
		cena+=40;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_7').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	var filled = $$('#id_003 input').collect(function(e){ return e.checked; }).any();
	if (filled == true) {
		if ($('input_8').value == 1) {
			cena += 9.50;
		}
		if ($('input_8').value > 1) {
			cena += 4.90;
		}
		cedzik = '<br />- La CEDDRE';
	}
	
 }
////
var cenapojedyncza = cena;
	
	ilosc=$('input_8').value;
	

 if ($('input_0').value == 'PLV carton') {
	if ($('input_1').value == '1b' ) {
		if (ilosc <= 4) {
		cena = 135;
		transport = 29;
		dodatkowaopcja += '<br />- Totem oval (154x50cm)';
		}
		if ((ilosc > 4) && (ilosc <= 10)) {
		cena = 105;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (154x50cm)';
		}
		if ((ilosc > 10) && (ilosc <= 20)) {
		cena = 95;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (154x50cm)';
		}
		if ((ilosc > 20) && (ilosc <= 50)) {
		cena = 85;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (154x50cm)';
		}
		if ((ilosc > 50) && (ilosc <= 100)) {
		cena = 45;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (154x50cm)';
		}
		if (ilosc > 100) {
		cena = 39;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (154x50cm)';
		}
	}
	
	if ($('input_1').value == '2b' ) {
		if (ilosc <= 4) {
		cena = 155;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (190x63cm)';
		}
		if ((ilosc > 4) && (ilosc <= 10)) {
		cena = 135;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (190x63cm)';
		}
		if ((ilosc > 10) && (ilosc <= 20)) {
		cena = 129;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (190x63cm)';
		}
		if ((ilosc > 20) && (ilosc <= 50)) {
		cena = 109;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (190x63cm)';
		}
		if ((ilosc > 50) && (ilosc <= 100)) {
		cena = 79;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (190x63cm)';
		}
		if (ilosc > 100) {
		cena = 45;
		transport = 0;
		dodatkowaopcja += '<br />- Totem oval (190x63cm)';
		}
	}
	
	if ($('input_1').value == '3b' ) {
		if (ilosc <= 4) {
		cena = 145;
		transport = 0;
		dodatkowaopcja += '<br />- Comptoir (69x99cm)';
		}
		if ((ilosc > 4) && (ilosc <= 10)) {
		cena = 125;
		transport = 0;
		dodatkowaopcja += '<br />- Comptoir (69x99cm)';
		}
		if ((ilosc > 10) && (ilosc <= 20)) {
		cena = 105;
		transport = 0;
		dodatkowaopcja += '<br />- Comptoir (69x99cm)';
		}
		if ((ilosc > 20) && (ilosc <= 50)) {
		cena = 90;
		transport = 0;
		dodatkowaopcja += '<br />- Comptoir (69x99cm)';
		}
		if ((ilosc > 50) && (ilosc <= 100)) {
		cena = 75;
		transport = 0;
		dodatkowaopcja += '<br />- Comptoir (69x99cm)';
		}
		if (ilosc > 100) {
		cena = 65;
		transport = 0;
		dodatkowaopcja += '<br />- Comptoir (69x99cm)';
		}
	}
	if ($('input_1').value == '4b' ) {
		if (ilosc <= 4) {
		cena = 379;
		transport = 0;
		dodatkowaopcja += '<br />- Arche 2 colonnes (190x63cm) et 1 top (200x50cm)';
		}
		if ((ilosc > 4) && (ilosc <= 10)) {
		cena = 355;
		transport = 0;
		dodatkowaopcja += '<br />- Arche 2 colonnes (190x63cm) et 1 top (200x50cm)';
		}
		if ((ilosc > 10) && (ilosc <= 20)) {
		cena = 335;
		transport = 0;
		dodatkowaopcja += '<br />- Arche 2 colonnes (190x63cm) et 1 top (200x50cm)';
		}
		if ((ilosc > 20) && (ilosc <= 50)) {
		cena = 270;
		transport = 0;
		dodatkowaopcja += '<br />- Arche 2 colonnes (190x63cm) et 1 top (200x50cm)';
		}
		if ((ilosc > 50) && (ilosc <= 100)) {
		cena = 235;
		transport = 0;
		dodatkowaopcja += '<br />- Arche 2 colonnes (190x63cm) et 1 top (200x50cm)';
		}
		if (ilosc > 100) {
		cena = 169;
		transport = 0;
		dodatkowaopcja += '<br />- Arche 2 colonnes (190x63cm) et 1 top (200x50cm)';
		}
	}
	
	if ($('input_1').value == '5b' ) {
		if (ilosc <= 4) {
		cena = 699;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Petits Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 4) && (ilosc <= 10)) {
		cena = 672;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Petits Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 10) && (ilosc <= 20)) {
		cena = 644;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Petits Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 20) && (ilosc <= 50)) {
		cena = 616;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Petits Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 50) && (ilosc <= 100)) {
		cena = 558;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Petits Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if (ilosc > 100) {
		cena = 525;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Petits Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
	}
	if ($('input_1').value == '6b' ) {
		if (ilosc <= 4) {
		cena = 739;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Grands Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 4) && (ilosc <= 10)) {
		cena = 710;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Grands Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 10) && (ilosc <= 20)) {
		cena = 680;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Grands Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 20) && (ilosc <= 50)) {
		cena = 651;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Grands Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if ((ilosc > 50) && (ilosc <= 100)) {
		cena = 621;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Grands Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
		if (ilosc > 100) {
		cena = 555;
		transport = 0;
		dodatkowaopcja += '<br />- Pack1 / 2 Grands Totems (154x50cm) + Comptoir (69x99cm) + Arche 2 colonnes (190x63cm) et 1 top (200x50cm) ';
		}
	}

	
	var ktodaje;
	if ($('input_7').value == 'fb') {
		cena+=40;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_7').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}	
 }
	
	var cenapojedyncza = cena;
	
	ilosc=$('input_8').value;
	if ($('input_8').value) {
		cena=cenapojedyncza*ilosc;
	}

	var total = document.getElementById("total");
	var remise = document.getElementById("remise");	
	if (($('input_0').value == 'Stand ExpoBag') || ($('input_0').value == 'Tissu')) {
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
	}}

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
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		cedzik += '<br />- retrait colis a l\'atelier';
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

            if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                cedzik += '<br />- Livraison gratuite avec Fedex.';
                transport = 0;
            }
			
				
/////////

	cenapojedyncza=fixstr(cenapojedyncza);
	cena2 = cenapojedyncza.replace(".", ",");
	var prix = document.getElementById("prix_unitaire");
	prix.innerHTML=cena2+' &euro;';
	
/* koszty transportu */	
	if (ilosc>1) { transport=transport*ilosc; }
/* /koszty transportu */	

	suma=cena-rabat;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	total.innerHTML=suma2+' &euro;';

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Stand Parapluie" /><input type="hidden" name="opis" value="- '+$('input_0').value+dodatkowaopcja+'<br />- '+ktodaje+cedzik+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';

}

},


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
	ax1.style.borderBottom="1px solid #9fa3a8";
}
if (ax2) { 
	ax2.style.background="none";
	ax2.style.border="none";
	ax2.style.borderBottom="1px solid #9fa3a8";
}

if ( ($('input_1').value) && ( ($('input_31').value) || ($('input_32').value) || ($('input_33').value) || ($('input_34').value) || ($('input_35').value) || ($('input_36').value) || ($('input_51').value) || ($('input_52').value) || ($('input_53').value) || ($('input_54').value) && ($('input_16').value)) && ($('input_6').value) && ($('input_7').value) ) {
	if ($('input_1').value == 'roll-up') {
		if ($('input_31').value == '80x200') {
			cena=52;		
		}
		if ($('input_31').value == '60x160') {
			cena=45;
		}
		if ($('input_31').value == '60x200') {
			cena=49;
		}
		if ($('input_31').value == '85x200') {
			cena=55;		
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
		if ($('input_31').value == '150x300') {
			cena=199;		
		}
		if ($('input_31').value == '80x200double') {
			cena=149;	
		}
		if ($('input_31').value == '85x200double') {
			cena=159;	
		}
		if ($('input_31').value == 'minia4') {
			cena=21;	
		}
		if ($('input_31').value == 'minia3') {
			cena=29;	
		}
		if ($('input_51').value == '100% écologique M1') {
			cena+=23;
		}
		if ($('input_55').value == '100% écologique M1') {
			cena+=23;
		}
		if ($('input_11').value == 'spot') {
			cena+=24;
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
			cena=179;
			ktorytyp=$('input_34').value;
		}
		if ($('input_16').value == 'sac') {
			cena+=19;
		}
		dodatkowaopcja='<br />- '+$('input_16').value;
	}
	if ($('input_1').value == 'x-screen') {
		if ($('input_32').value == '60x160') {
			cena=29;
			ktorytyp=$('input_32').value;
		}
		if ($('input_51').value == '100% écologique') {
			cena+=23;
		}
		dodatkowaopcja='<br />- '+$('input_51').value;
	}
	if ($('input_1').value == 'clipit') {
		if ($('input_33').value == '60x100') {
			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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
			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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
	
			if ($('input_52').value == '450g M1') {
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
			
			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1 satine') {
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
	
			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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
		
			if ($('input_52').value == '450g M1') {
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

			if ($('input_52').value == '450g M1') {
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
                etiqdesc += '<br />- Livraison gratuite avec Fedex.';
                transport = 0;
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
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="Kakemono" /><input type="hidden" name="opis" value="- '+$('input_1').value+'<br />- '+ktorytyp+dodatkowaopcja+'<br />- '+ktodaje+cedzik+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}

}

},


cal_enseignes: function(){  
var cena=0; var cena2=0;
var rabat=0; var rabat2=0;
var suma=0; var suma2=0;
var transport=0;
var metraz=0;
var dev='';
var szerokosc=0;
var wysokosc=0;
var cedzik = '';
var niepokazuj = 0;
var rozmiar = '';
var ktorytyp='';
var ktorapodstawa='';

	var eBox = document.getElementById('form-button-error2');
	eBox.innerHTML = '';
	var ax1 = document.getElementById("id_6");
	if (ax1) { 
		ax1.style.background="none";
		ax1.style.border="none";
		ax1.style.borderBottom="1px solid #9fa3a8";
	}	

ilosc=$('input_5').value;

if ( ($('input_0').value) && (($('input_1').value) && ($('input_31').value) && ($('input_32').value) && ($('input_4').value) && ($('input_5').value) && ($('input_6').value) && ($('input_7').value)) || (($('input_10').value)) ) {
 if ($('input_0').value == 'enseigne') {
 var rodzaj = 'Enseigne';
		szerokosc = ($('input_7').value);
		szerokosc = szerokosc.replace(',','.');
		szerokosc = fixstr(szerokosc);
		$('input_7').value = szerokosc;
		wysokosc = ($('input_6').value);
		wysokosc = wysokosc.replace(',','.');
		wysokosc = fixstr(wysokosc);
		$('input_6').value = wysokosc;
		metraz = fixstr(metraz);
		dev = Math.round(szerokosc*100)/100 + Math.round(wysokosc*100)/100;
		dev = fixstr(dev);
		if ((szerokosc<1.51) && (szerokosc>wysokosc)){
			metraz = wysokosc * 1.5;
			}
		else { metraz = szerokosc * 1.5;
			}
		if (($('input_1').value == 'forex3mm') && ($('input_31').value == 'recto')) {
			ktorytyp='Forex 3mm  Recto';
			cena = metraz*50;
		}
		if (($('input_1').value == 'forex3mm') && ($('input_31').value == 'rectoverso')) {
			ktorytyp='Forex 3mm  Recto/Verso';
			cena = metraz*70;
		}
		if (($('input_1').value == 'forex5mm') && ($('input_31').value == 'recto')) {
			ktorytyp='Forex 5mm  Recto';
			cena = metraz*70;
		}
		if (($('input_1').value == 'forex5mm') && ($('input_31').value == 'rectoverso')) {
			ktorytyp='Forex 5mm  Recto/Verso';
			cena = metraz*85;
		}
		if (($('input_1').value == 'dibond') && ($('input_31').value == 'recto')) {
			ktorytyp='dibond  Recto';
			cena = metraz*90;
		}
		if (($('input_1').value == 'dibond') && ($('input_31').value == 'rectoverso')) {
			ktorytyp='dibond  Recto/Verso';
			cena = metraz*110;
		}
		
		if ($('input_32').value == '2') {
			ktorapodstawa='2 trous';
			cena += 2;
		}
		if ($('input_32').value == '4') {
			ktorapodstawa='4 trous';
			cena += 4;
		}
		if ($('input_32').value == '6') {
			ktorapodstawa='6 trous';
			cena += 6;
		}
		if ($('input_32').value == '8') {
			ktorapodstawa='8 trous';
			cena += 8;
		}
		if ($('input_32').value == '10') {
			ktorapodstawa='10 trous';
			cena += 10;
		}
		if ($('input_32').value == 'Pas de perçage') {
			ktorapodstawa='Pas de perçage';
			cena += 0;
		}
		
		
	if (wysokosc > 1.5) {
		var blad = document.getElementById("id_6");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.50m!';
		niepokazuj=1;
	} 
	if (wysokosc < 0.5) {
		var blad = document.getElementById("id_6");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur minimale est 0.50m!';
		niepokazuj=1;
	} 
	
	var ktodaje;
	if ($('input_4').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_4').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	rozmiar = '<br />- '+szerokosc+' x '+wysokosc+'m';	
 }	
 
 
 if ($('input_0').value == 'panneau' && $('input_10').value == 'akilux') {
 var rodzaj = 'Panneau';
	if ($('input_11').value == 'recto') {
		if ($('input_12').value == '40x40') {
			cena += 26;
			if ($('input_13').value == 'oeillets') {
				cena += 6;
			}
		}
		if ($('input_12').value == '40x120') {
			cena += 24;
			if ($('input_13').value == 'oeillets') {
				cena += 2;
			}
		}
		if ($('input_12').value == '60x40') {
			cena += 24;
			if ($('input_13').value == 'oeillets') {
				cena += 4;
			}
		}
		if ($('input_12').value == '60x80') {
			cena += 24;
			if ($('input_13').value == 'oeillets') {
				cena += 2;
			}
		}
		if ($('input_12').value == '80x120') {
			cena += 22;
			if ($('input_13').value == 'oeillets') {
				cena += 1;
			}
		}
	}
	if ($('input_11').value == 'rectoverso') {
		if ($('input_12').value == '40x40') {
			cena += 38;
			if ($('input_13').value == 'oeillets') {
				cena += 6;
			}
		}
		if ($('input_12').value == '40x120') {
			cena += 36;
			if ($('input_13').value == 'oeillets') {
				cena += 2;
			}
		}
		if ($('input_12').value == '60x40') {
			cena += 36;
			if ($('input_13').value == 'oeillets') {
				cena += 4;
			}
		}
		if ($('input_12').value == '60x80') {
			cena += 36;
			if ($('input_13').value == 'oeillets') {
				cena += 2;
			}
		}
		if ($('input_12').value == '80x120') {
			cena += 34;
			if ($('input_13').value == 'oeillets') {
				cena += 1;
			}
		}
	}
	var ktodaje;	
	if ($('input_14').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_14').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	rozmiar = '<br />- '+szerokosc+' x '+wysokosc+'m';	
	ktorytyp = 'Akilux 3mm<br />- '+$('input_11').value;
	ktorapodstawa = ''+$('input_12').value+'<br />- '+$('input_13').value;
		
 }
 
 if ($('input_0').value == 'panneau' && $('input_10').value == 'forex1mm') {
 var rodzaj = 'Panneau';
 	 	szerokosc = ($('input_7').value);
		szerokosc = szerokosc.replace(',','.');
		szerokosc = fixstr(szerokosc);
		$('input_7').value = szerokosc;
		wysokosc = ($('input_6').value);
		wysokosc = wysokosc.replace(',','.');
		wysokosc = fixstr(wysokosc);
		$('input_6').value = wysokosc;
		metraz = szerokosc * wysokosc;
		metraz = fixstr(metraz);
		dev = Math.round(szerokosc*100)/100 + Math.round(wysokosc*100)/100;
		dev = fixstr(dev);
		
	if (wysokosc > 1.22) {
		var blad = document.getElementById("id_6");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 1.22m!';
		niepokazuj=1;
	} 
	
	if (szerokosc > 3.05) {
		var blad = document.getElementById("id_6");		
		blad.style.background = "#FFAAAA";
		blad.style.border = "1px solid #FFAAAA";
		eBox.innerHTML = 'La hauteur maximale est 3.05m!';
		niepokazuj=1;
	} 	
		
	if ($('input_11bis').value == 'recto') {
		if (metraz <= 1.00 ) {
		cena = metraz*35.00;
		}
		if (metraz > 1.00 ) {
		cena = metraz*30.00;
		}
		if ($('input_13bis').value == 'oeillets') {
				cena += 1;
			}
	}
	
	if ($('input_11bis').value == 'rectoverso') {
		if (metraz <= 1.00 ) {
		cena = ((metraz*35.00)*40/100)+(metraz*35.00);
		}
		if (metraz > 1.00 ) {
		cena = ((metraz*30.00)*40/100)+(metraz*30.00);
		}
		if ($('input_13bis').value == 'oeillets') {
				cena += 1;
			}
	}
	var ktodaje;
	if ($('input_14bis').value == 'fb') {
		cena+=29;
		ktodaje = 'France banderole crée la maquette';
	}
	if ($('input_14bis').value == 'user') {
		ktodaje = 'j’ai déjà crée la maquette';
	}
	ktorytyp = 'Forex 1mm<br />- '+$('input_11bis').value;
	ktorapodstawa = ' '+$('input_13bis').value;
	rozmiar = '<br />- '+szerokosc+' x '+wysokosc+'m';	
 }


if (niepokazuj == 0) {

///////
	var cenapojedyncza = cena;

	if (ilosc) {
		cena=cenapojedyncza*ilosc;
		iloscmetrow=metraz*ilosc;
	}

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
	if ($('input_0').value == 'enseigne') { 
	if (dev <= 1) {
			transport=12.9;
			}
	if ((dev > 1) && (dev < 2.19)) {
			transport=dev*12.9;
			}		
	if (dev > 2.19) {
			transport=16.62+(dev*12.9);
			}
	}
	if ($('input_0').value == 'panneau') {
		if (dev <= 1) {
			transport=12.9;
			}
	if ((dev > 1) && (dev < 2.19)) {
			transport=dev*12.9;
			}		
	if (dev > 2.19) {
			transport=16.62+(dev*12.9);
			}
	}
	var etiquette = $$('#etiquette').collect(function(e){ return e.checked; }).any();
	var etiqdesc = '';
	if (etiquette == true) {
		transport=0;
		etiqdesc = '<br />- retrait colis a l\'atelier';
	}
	
                if (document.getElementById('fedex') && document.getElementById('fedex').checked == true) {
                    etiqdesc += '<br />- Livraison gratuite avec Fedex.';
                    transport = 0;
                }
				
					
	/* /koszty transportu */	


	suma=cena-rabat;
	suma=fixstr(suma);
	suma2 = suma.replace(".", ",");
	var total = document.getElementById("total");
	total.innerHTML=suma2+' &euro;';
	

	var dodajkoszyk = document.getElementById("cart_form");
	dodajkoszyk.innerHTML = '<input type="hidden" name="addtocart" value="addtocart" /><input type="hidden" name="rodzaj" value="'+rodzaj+'" /><input type="hidden" name="opis" value="- '+ktorytyp+'<br />- '+ktorapodstawa+'<br />- '+ktodaje+rozmiar+cedzik+etiqdesc+'" /><input type="hidden" name="ilosc" value="'+ilosc+'" /><input type="hidden" name="prix" value="'+cena2+' &euro;" /><input type="hidden" name="option" value="-" /><input type="hidden" name="remise" value="'+rabat2+'" /><input type="hidden" name="total" value="'+suma2+' &euro;" /><input type="hidden" name="transport" value="'+transport+' &euro;" /><button id="submit_cart" type="submit">Send</button> ';
}
}

}


};