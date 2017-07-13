<?php
// création d'une archive zip //////////////////////////////////////////
$zip = new ZipArchive();
$uploadurl = get_bloginfo('url').'/uploaded/'.$number.'/';
if(is_dir($uploadurl))  {
  if($zip->open('archive.zip', ZipArchive::CREATE) == TRUE) {
    $fichiers = scandir($uploadurl);
    unset($fichiers[0], $fichiers[1]);
    foreach($fichiers as $f) {
      // On ajoute chaque fichier à l’archive en spécifiant l’argument optionnel.
      // Pour ne pas créer de dossier dans l’archive.
      if(!$zip->addFile($uploadurl.$f, $f)) {
        echo 'Impossible d&#039;ajouter &quot;'.$f.'&quot;.<br/>';
      }
    }
    // On ferme l’archive.
    $zip->close();
  }else{
  echo 'aucun fichier dans le dossier<br/>';
    // Traitement des erreurs avec un switch(), par exemple.
  }
}else{
  echo 'Le dossier &quot;upload/&quot; n&#039;existe pas.';
}

$archivepath = $uploadurl.'Archive.zip';
echo '<a href="'.$archivepath.'">archive.zip</a>';

////////////////////////////////////////////////////////////////////////////////

$rootPath = realpath(get_bloginfo('url').'/uploaded/'.$number.'/');
// Initialize archive object
$zip = new ZipArchive();
$zip->open('archive.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
// Create recursive directory iterator
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($files as $name => $file) {
    // Skip directories (they would be added automatically)
    if (!$file->isDir()) {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();
$archivepath = $rootPath.'archive.zip';
echo '<a href="'.$archivepath.'">archive.zip</a>';

////////////////////////////////////////////////////////////////////////////////

$the_folder = get_bloginfo('url').'/uploaded/'.$number.'/';
$zip_file_name = 'archive.zip';
class FlxZipArchive extends ZipArchive {
        /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/
    public function addDir($location, $name) {
        $this->addEmptyDir($name);
         $this->addDirDo($location, $name);
     } // EO addDir;

        /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann * @access private   **/
    private function addDirDo($location, $name) {
        $name .= '/';         $location .= '/';
      // Read all Files in Dir
        $dir = opendir ($location);
        while ($file = readdir($dir))    {
            if ($file == '.' || $file == '..') continue;
          // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    }
}

$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);
if($res === TRUE)    {
    $za->addDir($the_folder, basename($the_folder)); $za->close();
}
else  { echo 'Could not create a zip archive';}

$archivepath = get_bloginfo('url').'/uploaded/'.$number.'/archive.zip';
echo '<a href="'.$archivepath.'">archive.zip</a>';


////////////////////////////////////////////////////////////////////////////////
$zip = new ZipArchive;
$download = 'archive.zip';
$zip->open($download, ZipArchive::CREATE);
foreach (glob("get_bloginfo('url').'/uploaded/'.$number.'/*") as $file) { /* Add appropriate path to read content of zip */
    //$zip->addFile($file);
    $zip->addFile($file, ltrim($file, '/'));
}
$zip->close();

$archivepath = get_bloginfo('url').'/uploaded/'.$number.'/archive.zip';
echo '<a href="'.$archivepath.'">archive.zip</a>';


////////////////////////////////////////////////////////////////////////////////
// Create ZIP file
if(isset($_POST['create'])){
 $zip = new ZipArchive();
 $filename = "./archive.zip";
 if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
  exit("cannot open <$filename>\n");
 }
 $dir = get_bloginfo('url').'/uploaded/'.$number.'/';
 // Create zip
 createZip($zip,$dir);
 $zip->close();
}
// Create zip
function createZip($zip,$dir){
 if (is_dir($dir)){
  if ($dh = opendir($dir)){
   while (($file = readdir($dh)) !== false){
    // If file
    if (is_file($dir.$file)) {
     if($file != '' && $file != '.' && $file != '..'){
      $zip->addFile($dir.$file);
     }
    }else{
     // If directory
     if(is_dir($dir.$file) ){
      if($file != '' && $file != '.' && $file != '..'){
       // Add empty directory
       $zip->addEmptyDir($dir.$file);
       $folder = $dir.$file.'/';
       // Read data of the folder
       createZip($zip,$folder);
      }
     }
    }
   }
   closedir($dh);
  }
 }
}
// Download Created Zip file
if(isset($_POST['download'])){
 $filename = "archive.zip";
 if (file_exists($filename)) {
  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Content-Length: ' . filesize($filename));
  flush();
  readfile($filename);
  // delete file
  unlink($filename);
 }
}


////////////////////////////////////////////////////////////////////////////////
  $the_folder = get_bloginfo('url').'/uploaded/'.$number.'/';
  $zip_file_name = $number.'.archive.zip';

  class FlxZipArchive extends ZipArchive {
          /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/
      public function addDir($location, $name) {
          $this->addEmptyDir($name);
           $this->addDirDo($location, $name);
       } // EO addDir;

          /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann * @access private   **/
      private function addDirDo($location, $name) {
          $name .= '/';         $location .= '/';
        // Read all Files in Dir
          $dir = opendir ($location);
          while ($file = readdir($dir))    {
              if ($file == '.' || $file == '..') continue;
            // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
              $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
              $this->$do($location . $file, $name . $file);
          }
      }
  }

  $za = new FlxZipArchive;
  $res = $za->open($zip_file_name, ZipArchive::CREATE);
  if($res === TRUE)    {
      $za->addDir($the_folder, basename($the_folder)); $za->close();
  }
  else  { echo 'Could not create a zip archive';}

  header("Content-type: application/zip");
  header("Content-Disposition: attachment; filename=$zip_file_name");
  header("Content-length: " . filesize($zip_file_name));
  header("Pragma: no-cache");
  header("Expires: 0");
  readfile("$zip_file_name");


  ///////////////Fonction qui marche !//////////////////////////////////////////
  ///////////////////////////////////////////// zip des fichiers utilisateurs //
  $pathfiles = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/';
  // Returns array of files
  $files = scandir($pathfiles);
  // Count number of files and store them to variable..
  $num_files = count($files)-2;
  // s'il y a plus de 2 fichiers dans le dossier client, crée une archive zip
  if(file_exists($pathfiles) && $num_files >=2) {
    ini_set('max_execution_time', 600);
    ini_set('memory_limit','1024M');
    // Start the backup!
    function zipData($source, $destination) {
      if (extension_loaded('zip')) {
        if (file_exists($source)) {
          $zip = new ZipArchive();
          if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
            $source = realpath($source);
            if (is_dir($source)) {
              $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
              foreach ($files as $file) {
                $file = realpath($file);
                if (is_dir($file)) {
                  $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file)) {
                  $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
              }
            } else if (is_file($source)) {
              $zip->addFromString(basename($source), file_get_contents($source));
            }
          }
          return $zip->close();
        }
      }
      return false;
    }
    // create archive
    zipData($_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$number.'/', $_SERVER['DOCUMENT_ROOT'].'/zip/'.$number.'.archive.zip');
    echo '<div class="zipMessage">Plusieurs fichiers client trouvés, une archive a été générée: <a href="'.get_bloginfo('url').'/zip/'.$number.'.archive.zip" class="zipDownload">Download Zip</a></div>';
  }

?>
