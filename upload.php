<?php

		$upload_email_reporting = true ; 	// true or false (false turns email reporting off)	
		$upload_notify_email = $_POST['usermail'] ;  	// enter your valid email address
		$upload_directory = '' ; // leave blank for default
		
		# DEFINING $upload_directory
		# Must point to a PHP writable directory
		# See http://www.onlamp.com/pub/a/php/2003/02/06/php_foundations.html for dealing with PHP permissions
		
		/*
		The default directory for this script is set to "uploads" directory 
		in the same directory as the index.php of the SWFUpload demo files:
		
			# SWFUpload v2.1.0 Beta.zip (SWFUpload package)
				# swfupload/demos/uploads
				
		This 'uploads' directory may not exist with the SWFUploads package and may need created (with PHP write permissions).
		In any case, this script will send an email message concerning the status of the upload directory.
		*/
		
		
	#	PHP Email Configuration Test
	#	---------------	
		# Set to "true" to test if your server's PHP mail() function configuration works, by attempting to upload one file.
		# A simple email will be sent per upload attempt, letting you know PHP's mail() funciton is working.
		$test_php_mail_config = false ; // true or false
		




	$zamowienie = $_POST['orderid'];


	#	---------------
	#	NO MODIFICATIONS REQUIRED BELOW THIS LINE
	#	---------------

	#	CREATE DEFAULT UPLOAD DIRECTY LOCATION
	#	---------------	
		If ( !$upload_directory ) {
			$upload_directory = 'uploads' ; 
			$parent_dir = array_pop(explode(DIRECTORY_SEPARATOR, dirname(__FILE__)));

			$upload_directory = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/'.$zamowienie.'/';
			if (!is_dir($upload_directory)) {
				if (!mkdir($upload_directory, 0777, true)) {

				}
			}
		}

			
	#	---------------	
	#	TEST UPLOAD DIRECTORY

		If ( !file_exists($upload_directory) ) {	
			$msg = "The assigned SWFUpload directory, \"$upload_directory\" does not exist."; 
//			send_mail("SWFUpload Directory Not Found: $upload_directory",$msg);
			$upload_email_reporting = false ;
		}
		if ( $upload_email_reporting == true ) {
			$uploadfile = $upload_directory. DIRECTORY_SEPARATOR . basename($_FILES['Filedata']['name']);   
			if ( !is_writable($upload_directory) ) {
				$msg = "The directory, \"$upload_directory\" is not writable by PHP. Permissions must be changed to upload files."; 
//				send_mail("SWFUpload Directory Unwritable: $upload_directory",$msg);
				$upload_directory_writable = false ;
			} else {
				$upload_directory_writable = true ;
			}
		}
	

	// Work-around for setting up a session because Flash Player doesn't send the cookies
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}
	session_start();



	if ( !isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
		
		#	---------------	
		#	UPLOAD FAILURE REPORT
			if ( $upload_email_reporting == true ) {
				switch ($_FILES['Filedata']["error"]) {	
					case 1: $error_msg = 'File exceeded maximum server upload size of '.ini_get('upload_max_filesize').'.'; break;
					case 2: $error_msg = 'File exceeded maximum file size.'; break;
					case 3: $error_msg = 'File only partially uploaded.'; break;
					case 4: $error_msg = 'No file uploaded.'; break; 
				}
			}
			
	
		echo "There was a problem with the upload";
		exit(0);

	} else {
	

		#	---------------	
		#	COPY UPLOAD SUCCESS/FAILURE REPORT
			if ( $upload_email_reporting == true AND $upload_directory_writable == true ) {
				if ( move_uploaded_file( $_FILES['Filedata']['tmp_name'] , $uploadfile ) ) {
					$letter = "Bonjour,\r\n\r\nNous avons bien reçu votre ou vos fichiers. Ils vont être vérifiés par notre service infographie dans les plus brefs délais pour vous donner accès au module de paiement.\r\n\r\nAmicalement,\r\nL’équipe FRANCE BANDEROLE";
					$lettert = "Client crée la maquette et a envoyé son (ses) fichier(s)";
					$header .= 'Content-type: text/html; charset=utf-8\r\n '; 
					$header .= 'Content-Transfer-Encodin: 8bit\r\n ';
				    //mail($upload_notify_email, $lettert, $letter, "From: FRANCE BANDEROLE <info@france-banderole.fr>", $header);
				    wp_mail($upload_notify_email, $lettert, $letter);
				}else{
					$letter = "Bonjour,\r\n\r\nThere was a problem with your upload. Please contact france-banderole.com";
					$lettert = "Error: Client crée la maquette et a envoyé son (ses) fichier(s)";
					$header .= 'Content-type: text/html; charset=utf-8\r\n '; 
					$header .= 'Content-Transfer-Encodin: 8bit\r\n ';
				    //mail($upload_notify_email, $lettert, $letter, "From: FRANCE BANDEROLE <info@france-banderole.fr>", $header);
				    wp_mail($upload_notify_email, $lettert, $letter);
				}
			}


		echo "Flash requires that we output something or it won't fire the uploadSuccess event";
	}	


	#	---------------	
	#	MAIL FUNCTION
		function send_mail($subject="Email Notify",$message="") { 
			global $upload_notify_email ; 
			$from = 'SWFUpload@mailinator.com' ; 
			$return_path = '-f '.$from ;
			mail($upload_notify_email,$subject,$message,"From: $from\nX-Mailer: PHP/ . $phpversion()");
		}

	
	
?>