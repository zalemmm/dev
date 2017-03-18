<?php

$id = $_GET['uid'];
$cur_img = $_GET['img'];
if(!(isset($cur_img))) {
	$cur_img = 0;
}
$suivant = '';
$precedent = '';
$name = $_SERVER['DOCUMENT_ROOT'].'/uploaded/'.$id.'-projects';
if(file_exists($name))
if ($dir = @opendir($name)) {
	$x=0;
	$total=0;
	while(($file = readdir($dir))) {
		if(!is_dir($file) && !in_array($file, array(".",".."))) {
			$total++;
			if($cur_img != 0) {
				$x++;
				if ($x == $cur_img) {
<<<<<<< HEAD
					$img .= '<img src="http://127.0.0.1/wordpress/uploaded/'.$id.'-projects/'.$file.'" />';
				}
			} else if ($x<1) {
				$img .= '<img src="http://127.0.0.1/wordpress/uploaded/'.$id.'-projects/'.$file.'" />';
=======
					$img .= '<img src="https://dev.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
				}
			} else if ($x<1) {
				$img .= '<img src="https://dev.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
>>>>>>> origin/master
				$x++;
			}
		}
	}
	closedir($dir);
}
if($total > 1) {
	if($cur_img > 1) {
		if($cur_img != $total) {
			$suivant = ' - <a style="margin-left:14px;margin-bottom:10px;width:142px;height:19px;background:url(images/but_suiv.png) no-repeat;overflow:hidden;border:none;display:inline-block;margin: auto;" href="val_bat.php?uid='.$id.'&img='. ($cur_img+1) .'"></a>';
		}
		$precedent = '<a style="margin-right:14px;margin-bottom:10px;width:142px;height:19px;background:url(images/but_prec.png) no-repeat;overflow:hidden;border:none;display:inline-block;margin: auto;" href="val_bat.php?uid='.$id.'&img='. ($cur_img-1) .'"></a> - ';
	} else {
		$suivant = ' - <a style="margin-left:14px;margin-bottom:10px;width:142px;height:19px;background:url(images/but_suiv.png) no-repeat;overflow:hidden;border:none;display:inline-block;margin: auto;" href="val_bat.php?uid='.$id.'&img=2"></a>';
	}
}


?>

<html><head></head>
<body>
	<p style="text-align: center;">
		<?php
		echo $img;


		?>
	</p>
	<p style="text-align: center;"><?php echo $precedent; ?>
<<<<<<< HEAD
		<a href="http://127.0.0.1/wordpress/valider-mon-bat?uid=<?php echo $id; ?>&accepte=1" target="_top" style="margin-left:14px;margin-bottom:10px;width:142px;height:19px;background:url(images/but_bat.png) no-repeat;overflow:hidden;border:none;display:inline-block;margin: auto;"></a>
=======
		<a href="https://dev.france-banderole.com/valider-mon-bat?uid=<?php echo $id; ?>&accepte=1" target="_top" style="margin-left:14px;margin-bottom:10px;width:142px;height:19px;background:url(images/but_bat.png) no-repeat;overflow:hidden;border:none;display:inline-block;margin: auto;"></a>
>>>>>>> origin/master
		<?php echo $suivant; ?>
	</p>
</body>
</html>
