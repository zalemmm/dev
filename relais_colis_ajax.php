<?php
session_start();
//mail("contact@tempopasso.com","TEST1 FB Ajax","POST=".print_r($_POST,true)."///Session=".print_r($_SESSION,true));
/*echo '<p>Hi I am some random ' . rand() .' output from the server.</p>';*/
/*$_SESSION['rc_codeRelais'] = $_POST['codeRelais'];
$_SESSION['rc_nom'] = $_POST['nom'];
$_SESSION['rc_adresse'] = $_POST['adresse'];
$_SESSION['rc_codePostal'] = $_POST['codePostal'];
$_SESSION['rc_commune'] = $_POST['commune'];
*/
//$_SESSION['rc_'] = $_POST[''];
//$_SESSION['rc_'] = $_POST[''];

//if($_SESSION['loggeduser']->changement_relais_colis == "1er_passage"){
	
			/*if($_SESSION['loggeduser']->l_name!="") 
				$_SESSION['loggeduser']->l_comp = "1Pour: ". $_SESSION['loggeduser']->l_name;
			else 
				$_SESSION['loggeduser']->l_comp = "2Pour: ". $_SESSION['loggeduser']->f_name;
*/
			//$_SESSION['loggeduser']->l_comp = "Pour: ". $_SESSION['loggeduser']->f_name;
			//$_SESSION['loggeduser']->l_comp .= " TEL:". $_SESSION['loggeduser']->f_phone;
			/*if($_SESSION['loggeduser']->l_phone!="") 
				$_SESSION['loggeduser']->l_comp .= " 1TEL:". $_SESSION['loggeduser']->l_phone;
			else 
				$_SESSION['loggeduser']->l_comp .= " 2TEL:". $_SESSION['loggeduser']->f_phone;		
*/
		
			$_SESSION['loggeduser']->code_client_dest = $_POST['codeRelais'];
			$_SESSION['loggeduser']->l_name = "RELAIS COLIS (".$_POST['codeRelais'].")";
            $_SESSION['loggeduser']->l_address = $_POST['nom'];
			$_SESSION['loggeduser']->l_comp = $_POST['adresse'];
            $_SESSION['loggeduser']->l_code = $_POST['codePostal']; 
            $_SESSION['loggeduser']->l_city = $_POST['commune'];
			$_SESSION['loggeduser']->l_country = "France";			
			//$_SESSION['loggeduser']->changement_relais_colis = "2nd_passage";
			$_SESSION['loggeduser']->relais_colis = "yes";	
			$_SESSION['loggeduser']->code_relais_colis = $_POST['codeRelais'];
			
			/*
			
}else{
			$_SESSION['loggeduser']->l_comp = "XXXXX"; /* le complément d'dresse avec Nom et TEL de l'utilisateur sera mis à jour après connexion.*/
            //$_SESSION['loggeduser']->l_name = $_POST['nom']." ( ". $_POST['codeRelais']." )";
			/*$_SESSION['loggeduser']->l_name = $_SESSION['loggeduser']->f_name;
            $_SESSION['loggeduser']->l_address = $_POST['adresse'];
            $_SESSION['loggeduser']->l_code = $_POST['codePostal']; 
            $_SESSION['loggeduser']->l_city = $_POST['commune'];
			$_SESSION['loggeduser']->changement_relais_colis = "1er_passage";	
			$_SESSION['loggeduser']->relais_colis = "yes";
			$_SESSION['loggeduser']->code_relais_colis = $_POST['codeRelais'];	
			
	
}
	*/
//mail("contact@tempopasso.com","TEST2 FB Ajax","POST=".print_r($_POST,true)."///Session=".print_r($_SESSION,true));


?>