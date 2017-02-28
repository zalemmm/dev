/** Javascript B2C Suivi Colis - version 2.0 - 06/07/2010 **/

var pathToImages = "img/";
var tntDomain = "www.tnt.fr";

var tntSCMsgHeaderTitle = "Suivi Colis";
var tntSCMsgSubHeaderTitle = "Suivez votre colis 24h sur 24 et 7 jours sur 7 :";
var tntSCMsgBodyLoading = "Chargement en cours...";
var tntSCMsgBodyInput1 = "Entrez votre r&#233;f&#233;rence d'exp&#233;dition :";
var tntSCMsgBodyInput2 = "Vous pouvez choisir une autre r&#233;f&#233;rence d'exp&#233;dition :";
var tntSCMsgBodyFldRef = "R&#233;f&#233;rence de l'exp&#233;dition :&#160;";
var tntSCMsgBodyFldDtl = "Date de livraison :&#160;";
var tntSCMsgBodyFldDst = "Destination :&#160;";
var tntSCMsgBodyFldSta = "Statut de votre exp&#233;dition :";
var tntSCMsgBodyFldRel = "Relais Colis<sup class='tntSCSup'>&#174;</sup> :";
var tntSCMsgFooterTitle = "Les solutions de livraisons <div class='tntSCTextBold'>TNT 24h chez Moi</div>&#160;et&#160;<div class='tntSCTextBold'>TNT 24h Relais Colis<sup class='tntSCSup'>&#174;</sup></div><BR>sont des offres exclusives TNT Express France.<BR><BR>Pour toute information: <a href='https://www.tnt.fr' class='tntSCTextBold'>www.tnt.fr</a>";
var tntSCMsgErrModulo = "Votre r&#233;f&#233;rence d'exp&#233;dition est invalide, veuillez v&#233;rifier votre saisie"
var tntSCMsgErrConnexion = "Erreur de connexion";
var tntSCMsgErrBtInvalide = tntSCMsgErrModulo;

function getURLParam(name) {
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( window.location.href );
	if( results == null ) return "";
	else return results[1];
};

function getDivInput(lblInput, bonTransport) {
	return ("<table>"+
				"<tr>"+
					"<td width='350px'>" + lblInput + "</td>"+
				 	"<td width='160px'><input type='text' id='tntSCInputBT' class='tntSCInput' maxlength='16' size='16' value='" + bonTransport + "'/></td>"+
					"<td><a href='#' onclick='tntB2CSuiviColisGetDetail();'><img class='tntSCButton' src='" + pathToImages + "bt-OK-2.jpg' onmouseover='this.src=\"" + pathToImages + "bt-OK-1.jpg\"' onmouseout='this.src=\"" + pathToImages + "bt-OK-2.jpg\"'></a></td>" +
				"</tr>"+
			"</table>");
};

function tntB2CSuiviColis() {

	// Test si ID de r�f�rence existe, sinon on ne fait rien
	if (!document.getElementById("tntB2CSuiviColis")) {
		alert("ERREUR: Appel incorrect, objet [tntB2CSuiviColis] manquant !");
		return;
	}

	var bonTransport = getURLParam("bonTransport");

	var jBaseObj = $("#tntB2CSuiviColis");
	jBaseObj.html(
		"<div>"+
			"<div class='tntSCHeader'>"+ tntSCMsgHeaderTitle + "</div>"+
			"<div class='tntSCSubHeader'>" + tntSCMsgSubHeaderTitle + "</div>"+
		"</div>"+
		"<div>"+
			"<div id='tntBodySC' class='tntSCBody'>"+
				"<div class='tntSCGray'>&#160;</div>"+
				"<div id='tntBodyContentSC'>" + getDivInput(tntSCMsgBodyInput1, bonTransport) +	"</div>"+
				"<div id='tntSCLoading' style='display:none;'>" + tntSCMsgBodyLoading + "</div>"+
				"<div id='tntSCError' class='tntSCError' style='display:none;'></div>"+
			"</div>" +
			"<div class='tntSCWhite'>&#160;</div>"+
			"<div id='tntBodySearchSC' class='tntSCBodySearch' style='display:none;'>"+ getDivInput(tntSCMsgBodyInput2, "") + "</div>"+
			"<div class='tntSCWhite'>&#160;</div>"+
		"</div>"+
		"<div>"+
			"<div class='tntSCFooter'>"+
				"<table>"+
					"<tr>"+
						"<td class='tntSCFooterCell1' width='495px'>" + tntSCMsgFooterTitle + "</td>"+
					 	"<td class='tntSCFooterCell2' width='89px'>"+
						"</td>"+
					"</tr>"+
				"</table>"+
			"</div>"+
		"</div>");

	if (bonTransport != "") tntB2CSuiviColisGetDetail();
};

function tntB2CSuiviColisDisplayErreur(msgErreur) {

	$('#tntSCLoading').hide();

	var jBodySC = $("#tntBodySC");
	jBodySC.css("background-image", "none");
	jBodySC.css("height", "auto");

	$("#tntBodySearchSC").hide();
	var bonTransport = $("#tntSCInputBT").val();
	var jBodyContentSC = $("#tntBodyContentSC");
	jBodyContentSC.html(getDivInput(tntSCMsgBodyInput1, bonTransport));

	// Gestion erreur et sortie
	jErreurMsg = $("#tntSCError");
	jErreurMsg.html(msgErreur);
	jErreurMsg.show();

};

function tntB2CSuiviColisCheckModulo11(bonTransport) {
	var tabModulo = new Array(16,14,12,10,8,6,4,2,3,5,7,9,11,13,15)
	var tabBonTransport = bonTransport.toString().split("");
	var modulo = 0;
	for ( i = 0; i < 15; i++ ) {
		modulo += Number(tabBonTransport[i]) * tabModulo[i];
	}
	modulo = 11 - (modulo % 11);
	if (modulo == 10) modulo = 0;
	if (modulo == 11) modulo = 5;
	return (modulo == Number(tabBonTransport[15]));
};

function tntB2CSuiviColisGetDetail() {

	$("#tntSCError").hide();

	var bonTransport = $("#tntSCInputBT").val();

	if (bonTransport == "") return;

	// Verification basique de la validit� du num�ro saisi
	if (isNaN(parseInt(bonTransport)) || bonTransport.length != 16 || !tntB2CSuiviColisCheckModulo11(bonTransport)) {
		tntB2CSuiviColisDisplayErreur(tntSCMsgErrModulo);
		return;
	}

	$('#tntSCLoading').show();

	var ajaxUrl;
	var ajaxData;

	ajaxUrl = "https://" + tntDomain + "/public/b2c/suiviColis/rechercheJson.do?bonTransport=" + bonTransport;
	ajaxData = "";

	// Chargement du colis
	$.ajax({
	   type: "GET",
	   url: ajaxUrl,
	   data: ajaxData,
	   dataType: "script",
	   success:function(json){}
	});
};

function tntB2CSuiviColisDisplayDetail(jsondoc) {

	$('#tntSCLoading').hide();

	$("#tntBodySearchSC").show();
	var jBodySC = $("#tntBodySC");
	jBodySC.css("background-image", "url(" + pathToImages + "livreur.gif)");
	jBodySC.css("height", "260px");

	var bonTransport = jsondoc[0];
	var dateLivraison = jsondoc[3];
	var destination = jsondoc[2];
	var messages = "";
	var nomRelais = "";
	var adrRelais = "";
	var cpoRelais = "";
	var vilRelais = "";

	if(jsondoc[6].length != 0){
		var nomRelais = jsondoc[6][0];
		var adrRelais = jsondoc[6][1];
		var cpoRelais = jsondoc[6][2];
		var vilRelais = jsondoc[6][3];
	}

	for (i = 0; i < jsondoc[5].length; i++){
		if (messages == "") messages = jsondoc[5][i];
		else messages += "<br/>" + jsondoc[5][i];
	}

	var titreRelais = "";
	if (nomRelais != "" || adrRelais != "" || cpoRelais != "" || vilRelais != "") titreRelais = tntSCMsgBodyFldRel;

	var jBodyContentSC = $("#tntBodyContentSC");
	jBodyContentSC.html("<table border='0px' cellpadding='4px' width='580px'>"+
								"<tr>"+
									"<td><img src='" + pathToImages + "5-puce-choix-gris2.gif' alt='*'/></td>"+
									"<td colspan='4'>" + tntSCMsgBodyFldRef + "<div class ='tntSCTextOrange'>" + bonTransport + "</div></td>"+
								"</tr>"+
								"<tr>"+
									"<td><img src='" + pathToImages + "5-puce-choix-gris2.gif' alt='*' /></td>"+
									"<td colspan='2'>" + tntSCMsgBodyFldDtl + "<div class ='tntSCTextOrange'>" + dateLivraison + "</div></td>"+
									"<td colspan='2'>" + tntSCMsgBodyFldDst + "<div class ='tntSCTextOrange'>" + destination + "</div></td>"+
								"</tr>"+
								"<tr>"+
									"<td valign='top'><img src='" + pathToImages + "5-puce-choix-gris2.gif' alt='*'/></td>"+
									"<td colspan='4' valign='top'>" + tntSCMsgBodyFldSta + "</td>"+
								"</tr>"+
								"<tr>"+
									"<td></td>"+
									"<td></td>"+
									"<td colspan='2' style='text-align: justify;'><div class='tntSCTextOrange'>" + messages + "</div></td>"+
									"<td></td>"+
								"</tr>"+
								"<tr>"+
									"<td />"+
									"<td colspan='4' valign='top'>" + titreRelais + "</td>"+
								"</tr>"+
								"<tr>"+
									"<td />"+
									"<td />"+
									"<td colspan='2'><div class ='tntSCTextOrange'>" + nomRelais + "<br/>" + adrRelais + "<br/>" + cpoRelais + "&#160;" + vilRelais + "</div></td>"+
									"<td />"+
								"</tr>"+
								"<tr>"+
									"<td width='12px'/>"+
									"<td width='20px'/>"+
									"<td width='210px'/>"+
									"<td width='218px'/>"+
									"<td width='120px'/>"+
								"</tr>"+
						  "</table>");

	// RAZ zone de saisie
	$("#tntSCInputBT").val("");
};

function erreurColis(codeErreur){
	switch (codeErreur) {
		case 1: tntB2CSuiviColisDisplayErreur(tntSCMsgErrConnexion); break;
		case 2: tntB2CSuiviColisDisplayErreur(tntSCMsgErrBtInvalide); break;
		default: tntB2CSuiviColisDisplayErreur(tntSCMsgErrBtInvalide); break;
	}
}

$().ready(tntB2CSuiviColis);
