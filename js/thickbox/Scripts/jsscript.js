//lance l'upload ds flash

   

function cherche_navigateur_simple() {
    
    // on crée la variable qui accueillera le message relatif au navigateur
    var navigateur = "";
    
    // Attention, l'ordre de recherche est important !! Parce que IE reprend la mention 'Mozilla' et Opera reprend la mention 'MSIE' !!
    // on teste si on trouve la mention 'Opera...' dans le nom du navigateur
    if ( navigator.userAgent.indexOf('Opera 5') != -1 ) { navigateur = 'type1'; }
    
    // on teste si on trouve la mention 'MSIE' dans le nom du navigateur
    else if ( navigator.userAgent.indexOf('MSIE') != -1 ) { navigateur = 'type2'; }
    else if ( navigator.userAgent.indexOf('Mozilla') != -1 ) { navigateur = 'type3'; }
    
    // si rien n'a été reconnu...
    else { navigateur = 'type4'; }
    
    
    return navigateur;
   // alert (navigateur);
 
}



function goUpload() {
	alert ('debut upload');
	/*ici on est obligé de définir quel navigateur est utilisé pour demander l'appel de la fonction flash goUpload via le bon objet HTML. IE attends cette requete depuis l'objet <object> qui a pour id"FileUploader". Firefox et les autres peuvent le lancer via la balise <embed> qui a pour id="FileUploader_emb" */
	
	if (cherche_navigateur_simple() != 'type2' ) {
	   var elmid = 'FileUploader_emb';
	} else {
	   var elmid = 'FileUploader';
  }
 // alert (elmid);
	document.getElementById(elmid).goUpload();
}

//function lancée par flash une fois l'up fini
function Upload_Finished(param1, param2) {
	alert('upload fini');
	document.getElementById('form_upload').submit();
}   

//exécuté à chaque ajout d'un fichier 
function Update_File(file) {
	alert(file);
	
}
   
  // alert(cherche_navigateur_simple());

