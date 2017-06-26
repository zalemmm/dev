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
					$img .= '<img src="https://dev.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
				}
			} else if ($x<1) {
				$img .= '<img src="https://dev.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
				$x++;
			}
		}
	}
	closedir($dir);
}
if($total > 1) {
	if($cur_img > 1) {
		if($cur_img != $total) {
			$suivant = '<a class="bt-suiv" href="val_bat.php?uid='.$id.'&img='. ($cur_img+1) .'"><span class="dis0">Suivant</span> <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
		}
		$precedent = '<a class="bt-prev" href="val_bat.php?uid='.$id.'&img='. ($cur_img-1) .'"><i class="fa fa-caret-left" aria-hidden="true"></i> <span class="dis0">Précédent</span></a> ';
	} else {
		$suivant = '<a class="bt-suiv" href="val_bat.php?uid='.$id.'&img=2"><span class="dis0">Suivant</span>  <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
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

		.btnbar {
			width: 100%;
			position: fixed;
			top: 0;
			left:0;
			height: 40px;
			background: rgba(1,1,1,.5);
			z-index: 100;
			border-bottom: 1px solid rgba(246, 246, 246, .2);
			padding-left: 15px;
			padding-top: 15px;
			padding-bottom: 15px;
			text-align: left;
		}

		.prevnext {
			display: block;
			margin: 0 auto;
			float: right;
			margin-right: 30px;
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
			float: left;
			background: #74c012;
			border: 1px solid #609f0f;
			display: block;
		}

		.bt-suiv:hover,
		.bt-prev:hover,
		.bt-validBAT:hover {
			background-color: #EA2A6A;
		  border: 1px solid #db1657;
		  transition: .2s;
		}

		.main{
			text-align: center;
		}
		.main img {
			position: relative;
			margin-top: 80px;
			z-index: 20;
		}

		@media(max-width: 650px) {
			.dis0 {
				display: none;
			}
			.bt-suiv,
			.bt-prev {
				width: 40px;
			}
		}

	</style>
</head>
<body>
	<div class="btnbar">
		<div class="prevnext"><?php echo $precedent; ?>	<?php echo $suivant; ?></div>
		<a href="https://dev.france-banderole.com/valider-mon-bat?uid=<?php echo $id; ?>&accepte=1" target="_top" class="bt-validBAT"><i class="fa fa-check" aria-hidden="true"></i> Valider mon BAT</a>
	</div>

	<div class="main">
		<?php	echo $img; ?>
	</div>


</body>
</html>
