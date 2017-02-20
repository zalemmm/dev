function sprawdzrejestracje() {
	var e = document.getElementById('sprawdzrejestr');
	var b = document.getElementById('registerform_adresselivraison');
	if (e.checked) {
		b.style.visibility = "visible";
	}
	else {
		b.style.visibility = "hidden";
	}
	
}

function champsReq() {
	
	var groupe = document.getElementById("cl_group").value;
	var div_siret = document.getElementById("siret_pick");
	var div_epub = document.getElementById("epub_pick");
		if (groupe == "COM" || groupe == "TPE" || groupe == "PME")  {
			div_siret.style.visibility = "visible";
			div_siret.style.display = "block";
		} else {
			div_siret.style.visibility = "hidden";
			div_siret.style.display = "none";
		}
		if (groupe == "EPUB")  {
			div_epub.style.visibility = "visible";
			div_epub.style.display = "block";
		} else {
			div_epub.style.visibility = "hidden";
			div_epub.style.display = "none";
		}
}


function fixstr(num) {
	var numv=num-0;
	var sign=(numv>=0?1:-1);
	var numabs=numv*sign;
	var naint=Math.floor(numabs);
	var nacent=Math.round((numabs-naint)*100);
	if (nacent>=100) {nacent=0; naint++;}
	var nais=''+naint;
	var nacs=(nacent<10?'0':'')+nacent;
	if (naint+nacent==0) sign=1;
	return (sign==1?'':'-')+nais+'.'+nacs;
};

function potwierdzregulamin() {
	var e = document.getElementById('reg_confirm');
	var b = document.getElementById('paiements_right');
	if (e.checked) {
		b.style.visibility = "visible";
	}
	else {
		b.style.visibility = "hidden";
	}
	return false;
}


function czyilosc(licznik) {
	if ( !jQuery('#nummo'+licznik).val() ) {
		jQuery('#nummo'+licznik).css('background','#FFAAAA');
		return false;
	} else {
		return true;
	}
}