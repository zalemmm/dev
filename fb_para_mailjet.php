<?php

	define('FB_MJ_API_KEY','be8a44c6e3fda438fb5723513cf61606');
	define('FB_MJ_API_PRIVATE_KEY','41e491b34be4b96f06f6df84ab7ad3db');
	
	//Fonctions primaires de mise à jour API
	
	function getListId($listname) {
		$listname = urlencode($listname);
		
		$handle = curl_init();
		
		curl_setopt_array($handle, array(
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_VERBOSE         => true,
			CURLOPT_CUSTOMREQUEST 	=> 'GET',
			CURLOPT_HTTPAUTH        => CURLAUTH_ANY,
			CURLOPT_USERPWD         => FB_MJ_API_KEY.':'.FB_MJ_API_PRIVATE_KEY,
			CURLOPT_URL             => 'https://api.mailjet.com/v3/REST/contactslist/?Name='.$listname
			));	

		$response = curl_exec($handle);
		if ($response != false) {
		
			$dec = json_decode($response,true);
			$recipe_id = $dec['Data'][0]['ID'];	
			curl_close($handle);
			
			return $recipe_id;
			
		} else {
			return false;
		}
		
	}
	
	function getListRecipient($user_id,$list_id) {
		
		$handle = curl_init();
		
		curl_setopt_array($handle, array(
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_VERBOSE         => true,
			CURLOPT_CUSTOMREQUEST 	=> 'GET',
			//CURLOPT_HTTPHEADER		=> array('Content-Type: application/json'),
			// CURLOPT_POSTFIELDS 		=> $chaine_donnees,
			CURLOPT_HTTPAUTH        => CURLAUTH_ANY,
			CURLOPT_USERPWD         => FB_MJ_API_KEY.':'.FB_MJ_API_PRIVATE_KEY,
			CURLOPT_URL             => 'https://api.mailjet.com/v3/REST/listrecipient/?Contact='.$user_id.'&ContactsList='.$list_id
			));	

		$response = curl_exec($handle);
		if ($response != false) {
		
			$dec = json_decode($response,true);
			$recipe_id = $dec['Data'][0]['ID'];	
			curl_close($handle);
			
			return $recipe_id;
			
		} else {
			return false;
		}
	
	}
	
	function abonnerListe($user_id,$list_id) {
		$chaine_donnees = "{'ContactID':".$user_id.", 'ListID':".$list_id.", 'IsActive':True}";
				
			$handle = curl_init();
				
				curl_setopt_array($handle, array(
					CURLOPT_RETURNTRANSFER  => true,
					CURLOPT_VERBOSE         => true,
					CURLOPT_CUSTOMREQUEST 	=> 'POST',
					CURLOPT_HTTPHEADER		=> array('Content-Type: application/json','Content-Length: ' . strlen($chaine_donnees)),
					CURLOPT_POSTFIELDS 		=> $chaine_donnees,
					CURLOPT_HTTPAUTH        => CURLAUTH_ANY,
					CURLOPT_USERPWD         => FB_MJ_API_KEY.':'.FB_MJ_API_PRIVATE_KEY,
					CURLOPT_URL             => 'https://api.mailjet.com/v3/REST/listrecipient/'		
				));	

			if(curl_exec($handle) == false) {
				return false;
			} 
				
			curl_close($handle);	
	
	}
	
	
	function desabonnerListe($user_id,$list_id) {
		
		$mj_recipe_id = getListRecipient($user_id,$list_id);
		
		if($mj_recipe_id != false) {
		
		
			$handle = curl_init();
				
					curl_setopt_array($handle, array(
					CURLOPT_RETURNTRANSFER  => true,
					CURLOPT_VERBOSE         => true,
					CURLOPT_CUSTOMREQUEST 	=> 'DELETE',
					CURLOPT_HTTPHEADER		=> array('Content-Type: application/json'),
					// CURLOPT_POSTFIELDS 		=> $chaine_donnees,
					CURLOPT_HTTPAUTH        => CURLAUTH_ANY,
					CURLOPT_USERPWD         => FB_MJ_API_KEY.':'.FB_MJ_API_PRIVATE_KEY,
					CURLOPT_URL             => 'https://api.mailjet.com/v3/REST/listrecipient/'.$mj_recipe_id
				));	

			curl_exec($handle);
				
			curl_close($handle);
		
		}
	
	}
	
	function getIdFromEmail($email) {
		$handle = curl_init();

		curl_setopt_array($handle, array(
			CURLOPT_RETURNTRANSFER  => true,
			CURLOPT_VERBOSE         => true,
			CURLOPT_HTTPAUTH        => CURLAUTH_ANY,
			CURLOPT_USERPWD         => FB_MJ_API_KEY.':'.FB_MJ_API_PRIVATE_KEY,
			CURLOPT_URL             => 'https://api.mailjet.com/v3/REST/contact/'.$email
		));

		$response = curl_exec($handle);
		
		if ($response != false) {		
			$dec = json_decode($response,true);
			return $dec['Data'][0]['ID'];
		} else {
			return false;
		}
	}
	
	
	function createContact($email) {
	
		if(getIdFromEmail($email) == false) {

			$chaine_donnees = '{"Email":"'.$email.'"}';
				
			$handle = curl_init();
				
				curl_setopt_array($handle, array(
					CURLOPT_RETURNTRANSFER  => true,
					CURLOPT_VERBOSE         => true,
					CURLOPT_CUSTOMREQUEST 	=> 'POST',
					CURLOPT_HTTPHEADER		=> array('Content-Type: application/json','Content-Length: ' . strlen($chaine_donnees)),
					CURLOPT_POSTFIELDS 		=> $chaine_donnees,
					CURLOPT_HTTPAUTH        => CURLAUTH_ANY,
					CURLOPT_USERPWD         => FB_MJ_API_KEY.':'.FB_MJ_API_PRIVATE_KEY,
					CURLOPT_URL             => 'https://api.mailjet.com/v3/REST/contact/'		
				));	

			if(curl_exec($handle) == false) {
				return false;
			} 
				
			curl_close($handle);
		
		
		} else {
			return false;
		}
	
	
	}
	

?>
