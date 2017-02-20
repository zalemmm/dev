<?php
	if(isset($_GET['usr']) && isset($_GET['cmd']) && !empty($_GET['usr']) && !empty($_GET['cmd'])){
		$IdCustomer = trim(htmlentities($_GET['usr']), ENT_QUOTES);
		$IdOrder = trim(htmlentities($_GET['cmd']), ENT_QUOTES);
	}else{
		header("location: index.php");
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>T�l�charger des fichers</title>

	<!-- FancyUpload2 Styles-->
    <link rel="stylesheet" type="text/css" href="./css/funcystyle.css" media="screen, projection" />

    <!-- FancyUpload2-->
	<script type="text/javascript" src="./js/mootools-1.2-core-nc.js"></script>
	<script type="text/javascript" src="./js/Swiff.Uploader.js"></script>
	<script type="text/javascript" src="./js/Fx.ProgressBar.js"></script>
	<script type="text/javascript" src="./js/FancyUpload2.js"></script>

	<script type="text/javascript">
		/* <![CDATA[ */

	window.addEvent('load', function() {

	// For testing, showing the user the current Flash version.
	//document.getElement('h3 + p').appendText(' Detected Flash ' + Browser.Plugins.Flash.version + '!');

	var swiffy = new FancyUpload2($('demo-status'), $('demo-list'), {
		url: $('form-demo').action,
		fieldName: 'photoupload',
		path: 'swf/Swiff.Uploader.swf',
                'data': $('form-demo'),
		limitSize: 10 * 1024 * 1024, // 2Mb
		onLoad: function() {
			$('demo-status').removeClass('hide');
			$('demo-fallback').destroy();
		},
		// The changed parts!
		debug: true, // enable logs, uses console.log
		target: 'demo-browse' // the element for the overlay (Flash 10 only)
	});

	/**
	 * Various interactions
	 */

	$('demo-browse').addEvent('click', function() {
		/**
		 * Doesn't work anymore with Flash 10: swiffy.browse();
		 * FancyUpload moves the Flash movie as overlay over the link.
		 * (see opeion "target" above)
		 */
		swiffy.browse();
		return false;
	});

	/**
	 * The *NEW* way to set the typeFilter, since Flash 10 does not call
	 * swiffy.browse(), we need to change the type manually before the browse-click.
	 */
	/*$('demo-select-images').addEvent('change', function() {
		var filter = null;
		if (this.checked) {
			filter = {'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'};
		}
		swiffy.options.typeFilter = filter;
	});*/

	$('demo-clear').addEvent('click', function() {
		swiffy.removeFile();
		return false;
	});

	$('demo-upload').addEvent('click', function() {
		swiffy.upload();
		return false;
	});
	$('demo-close').addEvent('click', function() {
		self.parent.tb_remove();
		return false;
	});

});
		/* ]]> */
	</script>

    <style type="text/css">
<!--
.Style1 {color: #FFFFFF}
-->
    </style>
</head>
<body>
<img src="./images/Close.png" id="demo-close" border="0" />
<div class="container" id="container" style="text-align:center;">
<div class="" id="content" style="text-align:center;">
<div id="demo" style="text-align:center;">
<form action="./actuploader.php" method="post" enctype="multipart/form-data" id="form-demo">
	<input type="hidden" name="IdCustomer" value="<?php echo $IdCustomer;?>">
	<input type="hidden" name="IdOrder" value="<?php echo $IdOrder;?>">
	<fieldset id="demo-fallback">
	</fieldset>
	<div id="demo-status" ><span class="Style1"></span>
    <p>
			<font color="#000"><strong>ATTENTION : </strong>Ce module fonctionne avec </font><a href="http://get.adobe.com/fr/flashplayer/trigger/2/" target="_blank" ><img src="images/afp.png" alt="t�l�charger Adobe Flash Player" width="112" align="absmiddle" border="0"/></a><br />
			<strong><span class="highlight">T�L�CHARGEMENT DE FICHIERS : Maxi 10 Mo/Fichier</span></strong></p>
			<input id="demo-browse" type="button" name="browse" value="S�lectionnez vos fichiers" />
			<input id="demo-upload" type="button" name="upload" value="Lancer le t�l�chargement" /><br />
			<input id="demo-clear" type="button" name="clear" value="Effacer la liste" class="hide"/>
		<div>
			<strong class="overall-title">Progression totale</strong><br />
			<img src="./images/bar.gif" class="progress overall-progress" />		</div>
		<div>
			<strong class="current-title">Progression fichier</strong><br />
			<img src="./images/bar.gif" class="progress current-progress" />		</div>
		<div class="current-text"></div>

		<hr size="5" color="#E50000" />
		<div style="height:250px;overflow:auto;">
			<ul id="demo-list"></ul>
		</div>
	</div>

</form>
</div>
<!-- fin div demo -->

</div>
	</body>
</html>

<!-- This page took 0.32646703720093 seconds to process -->
