<?php
	if(isset($_GET['usr']) && isset($_GET['cmd']) && !empty($_GET['usr']) && !empty($_GET['cmd'])){
		$IdCustomer = trim(htmlentities($_GET['usr'], ENT_QUOTES));
		$IdOrder = trim(htmlentities($_GET['cmd'], ENT_QUOTES));
		$IsProject = trim(htmlentities($_GET['isproject'], ENT_QUOTES));
		$IsEmail = trim(htmlentities($_GET['isemail'], ENT_QUOTES));
	}else{
		header("location: index.php");
		exit;
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>telechargements</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<script language="JavaScript" type="text/javascript" src="https://dev.france-banderole.com/wp-content/plugins/fbshop/js/thickbox/Scripts/swfobject.js"></script>
<script type="text/javascript" src="https://dev.france-banderole.com/wp-content/plugins/fbshop/js/thickbox/js/mootools-1.2-core-nc.js"></script>
<script type="text/javascript">
	window.addEvent('load', function() {
	$('demo-close').addEvent('click', function() {
		window.parent.location.reload();
		self.parent.tb_remove();
		return false;
	});
	});

</script>
</head>
<body>
<img src="https://dev.france-banderole.com/wp-content/plugins/fbshop/js/thickbox/close.png" id="demo-close" style="cursor:pointer" border="0" />
<div id="pagen">
<!-- start content -->
<div id="contentn">
<div class="post">
         <div id="mon_flash">
		Pour utiliser notre module de téléchargement, vous devez télécharger <a href="https://www.adobe.com/go/getflashplayer_fr" target="_blank" onClick="window.open(this.href); return false;"><strong>Adobe Flash Player</strong></a>	</div>
  <script type="text/javascript">
		// <![CDATA[
		var so = new SWFObject("https://dev.france-banderole.com/applications/NasUploader15.swf", "nasuploader", "456", "350", "8");
		so.addParam ('FlashVars','varget=cmd%3D<?php echo $IdOrder;?>%26usr%3D<?php echo $IdCustomer;?>%26isproject%3D<?php echo $IsProject;?>%26isemail%3D<?php echo $IsEmail;?>');
		so.write("mon_flash");
		// ]]>
	</script>
</div>
</body>
</html>
