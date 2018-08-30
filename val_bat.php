<?php

$id = $_GET['uid'];
$rev = $_GET['rev'];
$cur_img = $_GET['img'];
$valid = $_GET['valid'];

if(!(isset($cur_img))) {
	$cur_img = 0;
}
$suivant = '';
$precedent = '';
$filename = '';
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
					$filename = $file;
				}
			} else if ($x<1) {
				$img .= '<img src="https://www.france-banderole.com/uploaded/'.$id.'-projects/'.$file.'" />';
				$filename = $file;
				$x++;
			}
		}
	}
	closedir($dir);
}
if($total > 1) {
	if($cur_img > 1) {
		if($cur_img != $total) {
			$suivant = '<a class="bt-suiv" href="val_bat.php?valid='.$valid.'&uid='.$id.'&img='. ($cur_img+1) .'"><span class="dis0">Suivant</span> <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
		}
		$precedent = '<a class="bt-prev" href="val_bat.php?valid='.$valid.'&uid='.$id.'&img='. ($cur_img-1) .'"><i class="fa fa-caret-left" aria-hidden="true"></i> <span class="dis0">Précédent</span></a> ';
	} else {
		$suivant = '<a class="bt-suiv" href="val_bat.php?valid='.$valid.'&uid='.$id.'&img=2"><span class="dis0">Suivant</span>  <i class="fa fa-caret-right" aria-hidden="true"></i></a><p class="helptext"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> votre commande comprend plusieurs maquettes, cliquez sur<br />suivant pour vérifier chaque fichier avant de valider votre BAT <i class="fa fa-caret-right" aria-hidden="true"></i></p>';
	}
}


?>

<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<?php if ($rev==0) {	// pour les clients non revendeurs, script pour interdire le clic droit ?>
		<script>
		$(document).ready(function() {
	    $("img").on("contextmenu",function(){
	       return false;
	    });
		});
		</script>
	<?php } ?>


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

		.helptext {
			margin: 0;
			color: #fff;
			font-family: "Source Sans Pro", sans-serif;
			font-size: .75rem;
			line-height: 1rem;
			text-transform: uppercase;
			text-align: right;
			margin-right: 15px;
			float: left;
		}

		.prevnext {
			display: block;
			margin: 0 auto;
			float: right;
			margin-right: 30px;
		}

		.bt-suiv,
		.bt-prev,
		.bt-validBAT,
		.bt-printBAT {
			box-sizing: border-box;
			position: relative;
			width: 150px;
			height: 32px;
			margin: 0 0 10px 0;
			padding: .5rem .5rem .5rem;
			display: inline-block;
			cursor: pointer;
			background: #32A1CC;
			border: 1px solid #2b8aaf;
			border-radius: 20px;
			color: #fff;
			font-family: "Source Sans Pro", sans-serif;
			font-size: .75rem;
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

		.bt-suiv,
		.bt-prev,
		.bt-printBAT {
			background-color: transparent;
			border: 1px solid #fff;
		}
		.bt-printBAT {
			margin-left: 10px;
		}

		.bt-suiv:hover,
		.bt-prev:hover,
		.bt-printBAT:hover,
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
			margin-top: 63px;
			margin-left: -10px;
			z-index: 20;
		}
		.filename {
			color: #fff;
			position: fixed;
			font-family: "Source Sans Pro", sans-serif;
			font-size: .75rem;
			top: 40px;
			z-index:999;
		}
		@media(max-width: 780px) {
			.dis0 {
				display: none;
			}
			.bt-suiv,
			.bt-prev {
				width: 40px;
			}
		}

		@media(max-width: 640px) {
			.helptext {
				display: none;
			}
		}

		@media print {
		 .noprint {
			 display: none;
		 }
		 .print {
			 display: block;
		 }
		}

	</style>
</head>
<body>
	<div class="btnbar noprint">
		<div class="prevnext"><?php echo $precedent; ?>	<?php echo $suivant; ?></div>

		<?php if ($valid == 0) { ?>
			<a href="https://www.france-banderole.com/valider-mon-bat?uid=<?php echo $id; ?>&accepte=1" target="_top" class="bt-validBAT"><i class="fa fa-check" aria-hidden="true"></i> Valider mon BAT</a>
		<?php } ?>

		<a href="javascript:window.print()" title="imprimer" class="bt-printBAT"><i class="fa fa-print"></i> Imprimer</a>
		<p class="filename print"><?php	echo $filename; ?></p>
	</div>

	<div id="main" class="main">
		<?php	echo $img; ?>
	</div>


</body>
</html>
