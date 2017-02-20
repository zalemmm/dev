<?php 
$path = $_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/shopfiles/';
$uploadfile = $path . basename($_FILES[’Filedata’][’name’]);
		if (!is_dir($path)) {
			if (!mkdir($path, 0777, true)) {
				$view .= 'Failed to create folders...';
			}
		}
if (move_uploaded_file($_FILES[’Filedata’][’tmp_name’], $uploadfile)) {
echo basename($_FILES[’Filedata’][’name’]);
} else {
// nada … it didn’t work!
}

?>