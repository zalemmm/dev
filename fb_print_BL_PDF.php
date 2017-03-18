<?php
$pdffile = addslashes($_GET['file']);
$filename = addslashes($_GET['name']); /* Note: Always use .pdf at the end. */
/*echo "Fichier=".$pdffile;
echo "filename=".$filename;
*/

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
//header('Content-Length: ' . filesize($pdffile));
header('Accept-Ranges: bytes');

@readfile($pdffile);
?>