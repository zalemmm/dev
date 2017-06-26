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
					$img .= '<img src="https://www.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
				}
			} else if ($x<1) {
				$img .= '<img src="https://www.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
				$x++;
			}
		}
	}
	closedir($dir);
}
if($total > 1) {
	if($cur_img > 1) {
		if($cur_img != $total) {
			$suivant = '<a class="bt-suiv" href="val_bat.php?uid='.$id.'&img='. ($cur_img+1) .'">Suivant <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
		}
		$precedent = '<a class="bt-prev" href="val_bat.php?uid='.$id.'&img='. ($cur_img-1) .'"><i class="fa fa-caret-left" aria-hidden="true"></i> Précédent</a> ';
	} else {
		$suivant = '<a class="bt-prev" href="val_bat.php?uid='.$id.'&img=2">Suivant <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
	}
}


?>

<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--librairie d'icones css-->
	<style>
	  a {
	  	text-decoration: none;
	  }

		.bt-suiv,
		.bt-prev,
		.bt-validBAT {
			box-sizing: border-box;
			position: relative;
			width: 150px;
			height: 40px;
			margin: 0 0 10px 0;
			padding: .7rem .5rem .5rem;
			display: inline-block;
			cursor: pointer;
			box-shadow: 1px 2px 2px 0px rgba(0, 0, 0, 0.2);
			background: #32A1CC;
			border: 1px solid #2b8aaf;
			border-radius: 3px;
			color: #fff;
			font-family: "Source Sans Pro", sans-serif;
			font-size: .8rem;
			line-height: .8rem;
			font-weight: normal;
			text-align: center;
			text-transform: uppercase;
			vertical-align: middle;
		}

		.bt-validBAT {
			background: #74c012;
			border: 1px solid #609f0f;
		}

		.bt-suiv:hover,
		.bt-prev:hover,
		.bt-validBAT:hover {
			background-color: #EA2A6A;
		  border: 1px solid #db1657;
		  transition: .2s;
		}

		.btnbar {
			border-bottom: 1px solid rgba(246, 246, 246, .2);
			padding-top: 10px;
			padding-bottom: 5px;
			text-align: center;
		}

	</style>
</head>
<body>
	<div class="btnbar">
		<?php echo $precedent; ?>
		<a href="https://www.france-banderole.com/valider-mon-bat?uid=<?php echo $id; ?>&accepte=1" target="_top" class="bt-validBAT"><i class="fa fa-check" aria-hidden="true"></i> Valider mon BAT</a>
		<?php echo $suivant; ?>
	</div>


	<p style="text-align: center;">
		<?php
		echo $img;
		?>
	</p>

</body>
</html>
