<?php
function getTplPath($page = false) {
    if ($page) {
        return ABSPATH . 'wp-content/plugins/fbshop/prod_pages/' . $page;
    } else {
        return ABSPATH . 'wp-content/plugins/fbshop/prod_pages/';
    }
}

function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        /*if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }*/
		if(@strpos( $value, $needle ) OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}

function fbshop_head() {
if (is_page('flyers') || is_page('affiches') || is_page('roll-up') || is_page('cartes') || is_page('banderoles') || is_page('vitrophanie')  || is_page('stickers')|| is_page('autocollant')|| is_page('sticker-predecoupe') || is_page('sticker-lettrage-predecoupe') || is_page('oriflammes') || is_page('stand-parapluie') || is_page('kakemonos') || is_page('totem') || is_page('enseignes') || is_page('plv-exterieur')|| is_page('plv-interieur') || is_page('rampe-eclairage-led') || is_page('buraliste') || is_page('accessoires') || is_page('cadre-exterieur-bache') || is_page('mma') || is_page('depliants') || is_page('cadre-exterieur-bache') || is_page('panneaux-akilux-3mm') || is_page('panneaux-akilux-3_5mm') || is_page('panneaux-akilux-10mm') || is_page('panneaux-forex-1mm') || is_page('panneaux-forex-3mm')|| is_page('panneaux-forex-5mm')|| is_page('panneaux-dibond') || is_page('PVC-300-microns') || is_page('panneaux-akilux-5mm')) {
	echo '
	<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/swfobject.js" type="text/javascript"></script>
	<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/expandingbanner.js?v3" type="text/javascript"></script>

	<script type="text/javascript">
    var flashvars = {};
    var params = {};
    params.wmode = "transparent";
	swfobject.embedSWF("'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/banner_pr.swf", "banner", "706", "97", "8.0.0", "'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/expressInstall.swf", flashvars, params);
	$(document).ready(function(){
		initBanner();
	});
	</script>
	';
	echo '
	<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/swfobject.js" type="text/javascript"></script>
	<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/expandingbanner.js?v3" type="text/javascript"></script>

	<script type="text/javascript">
    var flashvars = {};
    var params = {};
    params.wmode = "transparent";
	swfobject.embedSWF("'.get_bloginfo("url").'/wp-content/plugins/fbshop/images/devis.swf", "banner2", "115", "28", "8.0.0", "'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/expressInstall.swf", flashvars, params);

	</script>
	';

}
$user = $_SESSION['loggeduser'];
/*
if (isset($_GET['detail']) && $user->login != 'schizoos' && $user->login != 'pocalypse') {
	$detailp = $_GET['detail'];
	echo '
	<link rel="stylesheet" type="text/css" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/thickbox/thickbox.css" />
	<script language="javascript" type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/thickbox/jquery-latest.js"></script>
	<script language="javascript" type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/thickbox/thickbox.js"></script>
	';
}
*/


/* Si page "votre-panier" alors on affiche si necessaire le formulaire Relais Colis, donc les coodes sources dans le head */
if (is_page('votre-panier')){
	$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);
 	if($relais_colis !== false){
		echo '
<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/js/jquery.js"></script>
<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/js/jquery-ui.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/js/relaisColis.js"></script>
<link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/css/ui.tabs.css" type="text/css" />
<link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/css/ui.dialog.css" type="text/css" />
<link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/relaiscolis/css/tntB2CRelaisColis.css" type="text/css" />
	';
	}
}


	if ((is_page('roll-up')) || (is_page('totem')) || (is_page('banderoles')) || (is_page('oriflammes')) || (is_page('panneaux-akilux-3mm')) || (is_page('autocollant')) || (is_page('vitrophanie')) || (is_page('panneaux-akilux-3_5mm')) || (is_page('panneaux-akilux-5mm')) || (is_page('panneaux-forex-3mm')) || (is_page('panneaux-forex-5mm')) || (is_page('panneaux-dibond')) || (is_page('stickers')) || (is_page('sticker-predecoupe'))  || (is_page('sticker-lettrage-predecoupe'))) {
	echo '<link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/roll.css?v26032013" type="text/css" media="all" />';
}

Else {
	echo '<link rel="stylesheet" href="'.get_bloginfo("url").'/wp-content/plugins/fbshop/style.css?v26032013" type="text/css" media="all" />';
}
	echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/others.js" type="text/javascript"></script>';

if (is_page('cadre-exterieur-bache')) {
echo '
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-cadre.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "01", "operator": "equals", "value": "Flexy-Tens"}], "action": {"field": "03", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "01", "operator": "equals", "value": "IX-Tens"}], "action": {"field": "02", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "02", "operator": "equals", "value": "structure + banderole"}], "action": {"field": "111", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "02", "operator": "equals", "value": "renouvelle banderole"}], "action": {"field": "112", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "03", "operator": "equals", "value": "structure"}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "03", "operator": "equals", "value": "structure + banderole"}], "action": {"field": "34", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "03", "operator": "equals", "value": "banderole"}], "action": {"field": "121", "visibility": "Show"}},




{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "120", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "120", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "equals", "value": "60cm de hauteur"}], "action": {"field": "21a", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "equals", "value": "80cm de hauteur"}], "action": {"field": "22a", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "equals", "value": "100cm de hauteur"}], "action": {"field": "23a", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "equals", "value": "120cm de hauteur"}], "action": {"field": "24a", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "equals", "value": "140cm de hauteur"}], "action": {"field": "25a", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "equals", "value": "160cm de hauteur"}], "action": {"field": "26a", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "112", "operator": "equals", "value": "60cm de hauteur"}], "action": {"field": "21b", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "112", "operator": "equals", "value": "80cm de hauteur"}], "action": {"field": "22b", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "112", "operator": "equals", "value": "100cm de hauteur"}], "action": {"field": "23b", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "112", "operator": "equals", "value": "120cm de hauteur"}], "action": {"field": "24b", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "112", "operator": "equals", "value": "140cm de hauteur"}], "action": {"field": "25b", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "112", "operator": "equals", "value": "160cm de hauteur"}], "action": {"field": "26b", "visibility": "Show"}},



{"type": "field", "link": "All", "terms": [{"field": "120", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "121", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},

{"type": "field", "link": "All", "terms": [{"field": "21b", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "22b", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "23b", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "24b", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "25b", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "26b", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "21b", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "22b", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "23b", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "24b", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "25b", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "26b", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "21a", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "22a", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "23a", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "24a", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "25a", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "26a", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},



{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "31", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "120", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "121", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}


if (is_page('imprimerie-papier')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-papier.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}], "action": {"field": "2", "visibility": "Show"}}, {"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}], "action": {"field": "3", "visibility": "Show"}}, {"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Cartes"}], "action": {"field": "001", "visibility": "Show"}}, {"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Affiches"}], "action": {"field": "221", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "1"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "2"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "3"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "4"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "5"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "6"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "7"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "11", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "8"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "12", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "9"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "13", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "10"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "14", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "11"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "15", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "12"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "16", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "13"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "17", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "14"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "18", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "15"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "19", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "16"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "20", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "17"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "21", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "18"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "22", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers"}, {"field": "2", "operator": "equals", "value": "19"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "23", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "1"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "24", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "2"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "25", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "3"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "26", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "4"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "27", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "5"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "28", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "6"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "29", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "7"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "30", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Dépliants"}, {"field": "3", "operator": "equals", "value": "8"}, {"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "31", "visibility": "Show"}}, {"type": "field", "link": "Any", "terms": [{"field": "001", "operator": "isFilled", "value": false}], "action": {"field": "002", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "001", "operator": "equals", "value": "1"}, {"field": "002", "operator": "isFilled", "value": false}], "action": {"field": "003", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "001", "operator": "equals", "value": "2"}, {"field": "002", "operator": "isFilled", "value": false}], "action": {"field": "004", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "001", "operator": "equals", "value": "3"}, {"field": "002", "operator": "isFilled", "value": false}], "action": {"field": "005", "visibility": "Show"}},{"type": "field", "link": "Any", "terms": [{"field": "221", "operator": "isFilled", "value": false}], "action": {"field": "222", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "1"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "223", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "2"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "224", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "3"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "225", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "4"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "226", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "5"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "227", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "6"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "228", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "7"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "229", "visibility": "Show"}}, {"type": "field", "link": "All", "terms": [{"field": "221", "operator": "equals", "value": "8"}, {"field": "222", "operator": "isFilled", "value": false}], "action": {"field": "2210", "visibility": "Show"}}]);
JotForm.init();
</script>';
}

if (is_page('flyers')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-flyer.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 80g"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 135g"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 170g"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 250g"}], "action": {"field": "24", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 350g"}], "action": {"field": "25", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 120µ"}], "action": {"field": "26", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 270µ"}], "action": {"field": "27", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 350µ"}], "action": {"field": "28", "visibility": "Show"}},

{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 80g"}, {"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "44", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 135g"}, {"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 170g"}, {"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 250g"}, {"field": "24", "operator": "isFilled", "value": false}], "action": {"field": "34", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 350g"}, {"field": "25", "operator": "isFilled", "value": false}], "action": {"field": "35", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 120µ"}, {"field": "26", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 270µ"}, {"field": "27", "operator": "isFilled", "value": false}], "action": {"field": "42", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Flyers 350µ"}, {"field": "28", "operator": "isFilled", "value": false}], "action": {"field": "43", "visibility": "Show"}},




{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "35", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "41", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "42", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "43", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "44", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "101", "visibility": "Show"}}

]);


JotForm.init();
</script>';
}


if (is_page('cartes')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotformcartes.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Cartes 350g"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Cartes 270µ"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Cartes 350µ"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Cartes 350g"}, {"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "3", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Cartes 270µ"}, {"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Cartes 350µ"}, {"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "101", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}


if (is_page('rampe-eclairage-led')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotformeclairage.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "2", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "2", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "2", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}

if (is_page('depliants')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotformdepliants.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "depliants 80g"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "depliants 135g"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "depliants 170g"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "depliants 250g"}], "action": {"field": "24", "visibility": "Show"}},


{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "depliants 80g"}, {"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "42", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "depliants 135g"}, {"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "depliants 170g"}, {"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "depliants 250g"}, {"field": "24", "operator": "isFilled", "value": false}], "action": {"field": "34", "visibility": "Show"}},



{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "41", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "42", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "101", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}
if (is_page('affiches')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotformaffiches.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Affiches 130g"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Affiches 150g"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Affiches 220g"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Affiches 130g"}, {"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Affiches 150g"}, {"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "42", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "Affiches 220g"}, {"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "43", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "41", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "42", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "43", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "100", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "100", "operator": "isFilled", "value": false}], "action": {"field": "101", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}

if (is_page('banderoles')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-banderoles.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "extérieur"}], "action": {"field": "ext", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "intérieur"}], "action": {"field": "int", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "int/ext"}], "action": {"field": "intext", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "int", "operator": "equals", "value": "bache nontissé 150g M1"}], "action": {"field": "81", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "int", "operator": "notEquals", "value": "bache nontissé 150g M1"}, {"field": "int", "operator": "notEquals", "value": ""}], "action": {"field": "21", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "ext", "operator": "equals", "value": "bache nontissé 150g"}], "action": {"field": "81", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "ext", "operator": "notEquals", "value": "bache nontissé 150g"}, {"field": "ext", "operator": "notEquals", "value": ""}], "action": {"field": "21", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "intext", "operator": "equals", "value": "bache nontissé 150g M1"}], "action": {"field": "81", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "intext", "operator": "notEquals", "value": "bache nontissé 150g M1"}, {"field": "intext", "operator": "notEquals", "value": ""}], "action": {"field": "21", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "equals", "value": "sans oeillets"}], "action": {"field": "44", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "equals", "value": "oeillets aux coins"}], "action": {"field": "31", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "equals", "value": "oeillets haut/bas"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "equals", "value": "oeillets gauche/droite"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "equals", "value": "oeillets périmétrique"}], "action": {"field": "24", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "24", "operator": "isFilled", "value": false}], "action": {"field": "34", "visibility": "Show"}},



{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "equals", "value": "sans ourlet"}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "equals", "value": "ourlet de renfort haut/bas"}], "action": {"field": "43", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "equals", "value": "ourlet de renfort gauche/droite"}], "action": {"field": "42", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "equals", "value": "ourlet de renfort périmétrique"}], "action": {"field": "51", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "equals", "value": "sans ourlet"}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "equals", "value": "ourlet de renfort haut/bas"}], "action": {"field": "43", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "equals", "value": "sans ourlet"}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "equals", "value": "ourlet de renfort gauche/droite"}], "action": {"field": "42", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "41", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "44", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "42", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "43", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "51", "operator": "equals", "value": "tendeurs"}], "action": {"field": "52", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "51", "operator": "equals", "value": "rislans"}], "action": {"field": "53", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "51", "operator": "notEquals", "value": "rislans"}, {"field": "51", "operator": "notEquals", "value": "tendeurs"}, {"field": "51", "operator": "notEquals", "value": ""}], "action": {"field": "12", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "81", "operator": "equals", "value": "oeillets haut/bas"}], "action": {"field": "91", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "81", "operator": "equals", "value": "nouettes haut/bas"}], "action": {"field": "92", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "81", "operator": "equals", "value": "fourreaux gauche/droite"}, {"field": "81", "operator": "equals", "value": "pas de finition"}], "action": {"field": "101", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "91", "operator": "isFilled", "value": false}], "action": {"field": "101", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "92", "operator": "isFilled", "value": false}], "action": {"field": "101", "visibility": "Show"}},

{"type": "field", "link": "All", "terms": [{"field": "101", "operator": "isFilled", "value": false}], "action": {"field": "12", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "52", "operator": "isFilled", "value": false}], "action": {"field": "12", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "53", "operator": "isFilled", "value": false}], "action": {"field": "12", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "12", "operator": "isFilled", "value": false}], "action": {"field": "13", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "12", "operator": "isFilled", "value": false}], "action": {"field": "14", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "12", "operator": "isFilled", "value": false}], "action": {"field": "16", "visibility": "Show"}},
]);
JotForm.init();
</script>';
}

if (is_page('stickers')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform3.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "Formes"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "predecoupe"}], "action": {"field": "22", "visibility": "Show"}}, {"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "lettrage-blanc"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "lettrage-couleur"}], "action": {"field": "24", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "covering"}], "action": {"field": "25", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "24", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "25", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}



if (is_page('sticker-predecoupe')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform3.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}



if (is_page('sticker-lettrage-predecoupe')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform3.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "2", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "2", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}

if (is_page('autocollant')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform3.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}


if (is_page('vitrophanie')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform3.js?v3" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}

if (is_page('oriflammes')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>';
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-oriflamme.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "drapeaux"}], "action": {"field": "20", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "oriflamme"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "beachflag"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "windflag"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "20", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "3", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "22", "operator": "isFilled", "value": false}], "action": {"field": "3", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "23", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "equals", "value": "Kit complet"}], "action": {"field": "41", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "equals", "value": "Structure + Voile"}, {"field": "3", "operator": "equals", "value": "Voile seule"}], "action": {"field": "42", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "41", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "42", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "equals", "value": "Structure seule"}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "equals", "value": "Structure seule"}], "action": {"field": "10", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "8", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "8", "operator": "isFilled", "value": false}], "action": {"field": "10", "visibility": "Show"}}]);
JotForm.init();
</script>';
}
if (is_page('stand-parapluie')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform9.js?v5" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "equals", "value": "PLV carton"}], "action": {"field": "1", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "equals", "value": "Stand ExpoBag"}], "action": {"field": "2", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "equals", "value": "Tissu"}], "action": {"field": "50", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "2", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "7", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "0", "operator": "equals", "value": "Stand ExpoBag"}, {"field": "2", "operator": "isFilled", "value": false}, {"field": "7", "operator": "isFilled", "value": false}], "action": {"field": "100", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "50", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "51", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "7", "operator": "isFilled", "value": false}], "action": {"field": "100", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}
if (is_page('kakemonos')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "roll-up"}], "action": {"field": "31", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "x-screen"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "clipit"}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "blizzard"}], "action": {"field": "34", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "L-Banner-Light"}], "action": {"field": "35", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "L-Banner-Prestige"}], "action": {"field": "36", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "roll-up"},{"field": "31", "operator": "notEquals", "value": "minia3"}, {"field": "31", "operator": "notEquals", "value": "minia4"}, {"field": "31", "operator": "notEquals", "value": "200x200"}, {"field": "31", "operator": "isFilled", "value": false}], "action": {"field": "55", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "equals", "value": "minia3"}, {"field": "31", "operator": "equals", "value": "minia4"}, {"field": "31", "operator": "equals", "value": "200x200"}], "action": {"field": "61", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "52", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "16", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "35", "operator": "isFilled", "value": false}], "action": {"field": "53", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "36", "operator": "isFilled", "value": false}], "action": {"field": "53", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "16", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "11", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "52", "operator": "isFilled", "value": false}], "action": {"field": "111", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "53", "operator": "isFilled", "value": false}], "action": {"field": "11", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "51", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "55", "operator": "isFilled", "value": false}], "action": {"field": "11", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "61", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "61", "operator": "isFilled", "value": false}], "action": {"field": "81", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}


if (is_page('roll-up')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-rollup.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "first-line"}], "action": {"field": "21", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "best-line"}], "action": {"field": "22", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "lux-line"}], "action": {"field": "23", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "double"}], "action": {"field": "24", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "mini"}], "action": {"field": "25", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "21", "operator": "isFilled", "value": false}], "action": {"field": "31", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "best-line"},{"field": "22", "operator": "equals", "value": "200x200"}], "action": {"field": "35", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "22", "operator": "equals", "value": "60x200"},{"field": "22", "operator": "equals", "value": "80x200"},{"field": "22", "operator": "equals", "value": "85x200"},{"field": "22", "operator": "equals", "value": "100x200"},{"field": "22", "operator": "equals", "value": "120x200"},{"field": "22", "operator": "equals", "value": "150x200"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "lux-line"},{"field": "23", "operator": "equals", "value": "200x300"}], "action": {"field": "35", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "23", "operator": "equals", "value": "60x200"},{"field": "23", "operator": "equals", "value": "80x200"},{"field": "23", "operator": "equals", "value": "85x200"},{"field": "23", "operator": "equals", "value": "100x200"},{"field": "23", "operator": "equals", "value": "120x200"},{"field": "23", "operator": "equals", "value": "150x200"}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "24", "operator": "isFilled", "value": false}], "action": {"field": "34", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "25", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "35", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}



if (is_page('construction')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "roll-up"}], "action": {"field": "31", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "x-screen"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "clipit"}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "blizzard"}], "action": {"field": "34", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "L-Banner-Light"}], "action": {"field": "35", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "L-Banner-Prestige"}], "action": {"field": "36", "visibility": "Show"}},
{"type": "field", "link": "All", "terms": [{"field": "1", "operator": "equals", "value": "roll-up"},{"field": "31", "operator": "notEquals", "value": "minia3"}, {"field": "31", "operator": "notEquals", "value": "minia4"}, {"field": "31", "operator": "notEquals", "value": "200x200"}, {"field": "31", "operator": "isFilled", "value": false}], "action": {"field": "55", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "31", "operator": "equals", "value": "minia3"}, {"field": "31", "operator": "equals", "value": "minia4"}, {"field": "31", "operator": "equals", "value": "200x200"}], "action": {"field": "61", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "52", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "16", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "35", "operator": "isFilled", "value": false}], "action": {"field": "53", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "36", "operator": "isFilled", "value": false}], "action": {"field": "53", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "16", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "11", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "52", "operator": "isFilled", "value": false}], "action": {"field": "111", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "53", "operator": "isFilled", "value": false}], "action": {"field": "11", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "111", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "51", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "55", "operator": "isFilled", "value": false}], "action": {"field": "11", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "61", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "61", "operator": "isFilled", "value": false}], "action": {"field": "81", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}


if (is_page('totem')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "x-screen"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "clipit"}], "action": {"field": "33", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "blizzard"}], "action": {"field": "34", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "51", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "33", "operator": "isFilled", "value": false}], "action": {"field": "52", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "34", "operator": "isFilled", "value": false}], "action": {"field": "16", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "16", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "52", "operator": "isFilled", "value": false}], "action": {"field": "11", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "11", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "51", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "8", "visibility": "Show"}}
]);
JotForm.init();
</script>';
}


if (is_page('panneaux-akilux-3mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-akilux.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "HD", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "HD", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "oeillets"}], "action": {"field": "oeillets", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "rislans"}], "action": {"field": "rislans", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "crochets"}], "action": {"field": "crochets", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"}, {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "oeillets", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "rislans", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "crochets", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "13", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}

if (is_page('panneaux-akilux-3_5mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-akilux3_5mm.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "HD", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "HD", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "oeillets"}], "action": {"field": "oeillets", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "rislans"}], "action": {"field": "rislans", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "crochets"}], "action": {"field": "crochets", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"}, {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "oeillets", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "rislans", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "crochets", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "13", "visibility": "Show"}}

]);
JotForm.init();
</script>';
}


if (is_page('panneaux-akilux-5mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-akilux5mm.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "HD", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "HD", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "oeillets"}], "action": {"field": "oeillets", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "rislans"}], "action": {"field": "rislans", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "crochets"}], "action": {"field": "crochets", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"}, {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "oeillets", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "rislans", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "crochets", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "13", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}


if (is_page('PVC-300-microns')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-PVC300microns.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "isFilled", "value": false}], "action": {"field": "2", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "2", "operator": "isFilled", "value": false}], "action": {"field": "3", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "3", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}

]);
JotForm.init();
</script>';
}


if (is_page('panneaux-akilux-10mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-akilux10mm.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "1", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "personnalisée"}], "action": {"field": "32perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "60x40"}, {"field": "1", "operator": "equals", "value": "60x80"}, {"field": "1", "operator": "equals", "value": "120x40"}, {"field": "1", "operator": "equals", "value": "120x80"}, {"field": "1", "operator": "equals", "value": "160x60"}, {"field": "1", "operator": "equals", "value": "160x120"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32perso", "operator": "isFilled", "value": false}], "action": {"field": "4perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "isFilled", "value": false}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "isFilled", "value": false}], "action": {"field": "5perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5perso", "operator": "isFilled", "value": false}], "action": {"field": "6perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}



if (is_page('panneaux-forex-1mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-forex-1mm.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "1", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "personnalisée"}], "action": {"field": "32perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "50x20"}, {"field": "1", "operator": "equals", "value": "75x50"}, {"field": "1", "operator": "equals", "value": "150x50"}, {"field": "1", "operator": "equals", "value": "200x75"}, {"field": "1", "operator": "equals", "value": "250x100"}, {"field": "1", "operator": "equals", "value": "300x150"}], "action": {"field": "32", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32perso", "operator": "isFilled", "value": false}], "action": {"field": "4perso", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "perçage"} , {"field": "4", "operator": "equals", "value": "ventouse"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"} , {"field": "4", "operator": "equals", "value": "crochets"} , {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "perçage"} , {"field": "4perso", "operator": "equals", "value": "ventouse"}], "action": {"field": "5perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "double face"} , {"field": "4perso", "operator": "equals", "value": "crochets"} , {"field": "4perso", "operator": "equals", "value": "sans"}], "action": {"field": "6perso", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5perso", "operator": "isFilled", "value": false}], "action": {"field": "6perso", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}


if (is_page('panneaux-forex-3mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-forex-3mm.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "HD", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "HD", "operator": "isFilled", "value": false}], "action": {"field": "1", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "personnalisée"}], "action": {"field": "32perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "60x40"}, {"field": "1", "operator": "equals", "value": "100x50"}, {"field": "1", "operator": "equals", "value": "150x75"}, {"field": "1", "operator": "equals", "value": "200x100"}, {"field": "1", "operator": "equals", "value": "200x150"}, {"field": "1", "operator": "equals", "value": "300x150"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32perso", "operator": "isFilled", "value": false}], "action": {"field": "4perso", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "perçage"} , {"field": "4", "operator": "equals", "value": "ventouse"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"} , {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "perçage"} , {"field": "4perso", "operator": "equals", "value": "ventouse"}], "action": {"field": "5perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "double face"} , {"field": "4perso", "operator": "equals", "value": "sans"}], "action": {"field": "6perso", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5perso", "operator": "isFilled", "value": false}], "action": {"field": "6perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}



if (is_page('panneaux-forex-5mm')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-forex-5mm.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "HD", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "HD", "operator": "isFilled", "value": false}], "action": {"field": "1", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "personnalisée"}], "action": {"field": "32perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "60x40"}, {"field": "1", "operator": "equals", "value": "100x50"}, {"field": "1", "operator": "equals", "value": "150x75"}, {"field": "1", "operator": "equals", "value": "200x100"}, {"field": "1", "operator": "equals", "value": "200x150"}, {"field": "1", "operator": "equals", "value": "300x150"}], "action": {"field": "32", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32perso", "operator": "isFilled", "value": false}], "action": {"field": "4perso", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "perçage"} , {"field": "4", "operator": "equals", "value": "ventouse"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"} , {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "perçage"} , {"field": "4perso", "operator": "equals", "value": "ventouse"}], "action": {"field": "5perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "double face"} , {"field": "4perso", "operator": "equals", "value": "sans"}], "action": {"field": "6perso", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5perso", "operator": "isFilled", "value": false}], "action": {"field": "6perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}


if (is_page('panneaux-dibond')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/cal_kakemono.js?v26032013" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform-dibond.js?v4" type="text/javascript"></script>
<script type="text/javascript">
JotForm.setConditions([

{"type": "field", "link": "Any", "terms": [{"field": "0", "operator": "isFilled", "value": false}], "action": {"field": "HD", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "HD", "operator": "isFilled", "value": false}], "action": {"field": "1", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "personnalisée"}], "action": {"field": "32perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "1", "operator": "equals", "value": "60x40"}, {"field": "1", "operator": "equals", "value": "100x50"}, {"field": "1", "operator": "equals", "value": "150x75"}, {"field": "1", "operator": "equals", "value": "200x100"}, {"field": "1", "operator": "equals", "value": "200x150"}, {"field": "1", "operator": "equals", "value": "300x150"}], "action": {"field": "32", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "32", "operator": "isFilled", "value": false}], "action": {"field": "4", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "32perso", "operator": "isFilled", "value": false}], "action": {"field": "4perso", "visibility": "Show"}},

{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "perçage"} , {"field": "4", "operator": "equals", "value": "ventouse"}], "action": {"field": "5", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4", "operator": "equals", "value": "double face"} , {"field": "4", "operator": "equals", "value": "sans"}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "perçage"} , {"field": "4perso", "operator": "equals", "value": "ventouse"}], "action": {"field": "5perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "4perso", "operator": "equals", "value": "double face"} , {"field": "4perso", "operator": "equals", "value": "sans"}], "action": {"field": "6perso", "visibility": "Show"}},


{"type": "field", "link": "Any", "terms": [{"field": "5", "operator": "isFilled", "value": false}], "action": {"field": "6", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "5perso", "operator": "isFilled", "value": false}], "action": {"field": "6perso", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "9", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6perso", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}},
{"type": "field", "link": "Any", "terms": [{"field": "6", "operator": "isFilled", "value": false}], "action": {"field": "7", "visibility": "Show"}}


]);
JotForm.init();
</script>';
}


if (is_page('inscription') || is_page('order-inscription')) {
echo '<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/prototype.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus.js" type="text/javascript"></script><script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/protoplus-ui.js" type="text/javascript"></script>
<script src="'.get_bloginfo("url").'/wp-content/plugins/fbshop/js/jotform_reg.js?v3" type="text/javascript"></script>';
if (isset($_GET['goback'])) {
echo '<script type="text/javascript">JotForm.init();</script>';
} else {
/*echo '<script type="text/javascript">JotForm.init(function(){ JotForm.initCaptcha(\'input_20\'); $(\'input_20\').hint(\' \'); });</script>
<script src=\'https://www.google.com/recaptcha/api.js\'></script>
';*/
echo '<script type="text/javascript">JotForm.init();</script>
<script src=\'https://www.google.com/recaptcha/api.js\'></script>
';
}
}

}

function is_cart_not_empty()
{
        $count = 0;
        if (isset($_SESSION['fbcart']) && is_array($_SESSION['fbcart']))
        {
            foreach ($_SESSION['fbcart'] as $item)
                $count++;
            return $count;
        }
        else
            return 0;
}

function generate_page ($page, $pageid) {
$plugin_url=get_bloginfo('url').'/wp-content/plugins/fbshop/';
$view .= get_acces_client();
if ($page=='inscription') {
	$view = get_inscription();
	return $view;
}
if ($page=='inscription2') {
	$view = get_inscription2();
	return $view;
}
if ($page=='accesclient') {
	if (fb_is_logged()) {
		if ( !(isset($_POST['logme'])) && !(isset($_GET['resend'])) ) {
			$view .= 'Jesteś zalogowany!';
		}
	} else {
		if ( !(isset($_GET['resend'])) ) {
			$p = 1;
			$view .= get_acces_panel($p);
		}
	}
	return $view;
}
if ($page=='votre') {
	$view .= get_votre();
	return $view;
}
if ($page=='livredor') {
	$view .= get_rating_page();
	return $view;
}
if ($page=='Devis') {
	$view .= get_devis();
	return $view;
}
if ($page=='verification') {
	//mail("contact@tempopasso.com","TEST Functin get_verification()","AVANT appel de la fonction// POST=".print_r($_POST,true)."///Session=".print_r($_SESSION,true));
	$view .= get_verification();
	return $view;
}

if ($page=='paiement') {
	$view .= get_payement();
	return $view;
}

if ($page=='promotions') {
	$view .= get_promotions();
	return $view;
}

if ($page=='plv') {
	$view .= get_plv();
	return $view;
}

if ($page=='plv_int') {
	$view .= get_plv_int();
	return $view;
}

if ($page=='buraliste') {
	//$view .= get_buraliste();
	$view .= get_buralistes();
	return $view;
}

if ($page=='acc') {
	$view .= get_acc();
	return $view;
}

if ($page=='mma') {
	$view .= get_mma();
	return $view;
}

if ($page=='acc2') {
	$view .= get_acc2();
	return $view;
}

if ($page=='newslett') {
	$view .= get_newsletter_un();
	return $view;
}

if ($page=="valider_BAT") {
	$view .= get_valider_bat();
	return $view;
}


if ($page=='Kakemonos' || $page=='Oriflammes' || $page=='roll-up' || $page=='Stickers' || $page=='Banderoles' || $page=='cartes' || $page=='affiches' || $page=='cadre-exterieur-bache' || $page=='flyers' || $page=='depliants' || $page=='stand-parapluie' || 'enseignes' || $page=='cadre-exterieur-bache' || $page=='rampe-eclairage-led' || $page=='panneaux-akilux-3mm' || $page=='panneaux-akilux-3_5mm' || $page=='panneaux-akilux-10mm' || $page=='panneaux-forex-1mm' || $page=='panneaux-forex-3mm' || $page=='panneaux-forex-5mm' || $page=='panneaux-dibond' || $page=='PVC-300-microns') {


	if ($page=='cadre-exterieur-bache') {
		$h1name='cadre-exterieur-bache';
		$formularz = get_cadre_form();
	}

	if ($page=='flyers') {
		$h1name='Flyers pas cher, impression flyer, Prospectus, tracts, imprimer flyer papier PEFC et FSC';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f4';
		$info_title='Impression rapide flyers pas cher et prospectus';
		$info_info='Support de communication incontournable, du Flyers pas cher A5 au prospectus cartonné 350g couché brillant, nos flyers aux prix le plus bas sont disponibles en petite quantité pour éviter les gaspillages. Flyers pas cher  A3 - A4 - A5 - A6 - A7. Impression rapide de flyers pas cher recto ou recto/verso. Nous étudions également toutes vos demandes spécifiques. <span class="highlight"><b>Délai production livraison en standard : 3/4 jours ouvrés !</b></span>';
		$formularz = get_flyers_form();
	}

	if ($page=='rampe-eclairage-led') {
		$h1name=' RAMPE ECLAIRAGE LED';
		$mini='f21';
		$formularz = get_eclairage_form();
	}

	if ($page=='depliants') {
		$h1name='Depliant flyer publicitaire et livre personnalisés';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f13';
		$info_title='Dépliant et livre personnalisés';
		$info_info='Acheter des depliants 1 pli, 2 plis, 3 plis au meilleur tarif et en petite quantité pour ne payer que ce dont vous avez besoin. Nos impressions numériques sur presses numériques et offset vous permettent aujourd\'hui de profiter de dépliants pas cher et d\'imprimer votre propre livre personnalisé au meilleur prix.';
		$formularz = get_depliants_form();
	}
	if ($page=='stand-parapluie') {
		$h1name='Stand Parapluie - stands parapluie tissu - PLV carton - Presentoirs a montage rapide - Totems - Arches';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f11';
		$info_title='Stand Parapluie et Présentoirs Cartons';
		$info_info='Nos stand parapluie tissu et présentoirs à montage rapide ont été étudiés pour répondre aux besoins de chaque exposant en fonction de son budget.<br />La structure du stand parapluie tissu easy quick est en aluminium ce qui lui confèrent robustesse et légèreté pour assurer un montage rapide et accessible à tous, aussi souvent que vous le souhaitez.<br/><a rel="shadowbox" href="'.get_bloginfo("url").'/aide-stand-parapluie/" target="_blank" title="AIDE STAND PARAPLUIE"><b><span class="highlight">NOTICES TECHNIQUES - AIDE</span></b></a>';
		$formularz = get_parapluie_form();
	}


	if ($page=='panneaux-forex-dibond') {
		$h1name='panneau forex,  panneau dibond, enseignes publicitaires pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f12';
		$info_title='Panneaux Forex Dibond ';
		$info_info='Les meilleurs prix et impressions sur panneaux akilux, forex et dibond pas cher chez France Banderole sont imprimés en UV directement sur le support de 1 à 10.000 exemplaires jusqu à 300x200cm. Rendu panneaux akilux forex dibond brillant ou mat. délai de livraison rapide jusqu a 24/48h! partout en France métropolitaine';

	}


	if ($page=='panneaux-akilux') {
		$h1name='panneaux akilux , panneaux akylux pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux1';
		$info_title='Panneaux Akilux ';
		$info_info='Les meilleurs prix et impressions sur panneaux akilux, forex et dibond pas cher chez France Banderole sont imprimés en UV directement sur le support de 1 à 10.000 exemplaires jusqu à 300x200cm. Rendu panneaux akilux forex dibond brillant ou mat. délai de livraison rapide jusqu a 24/48h! partout en France métropolitaine';

	}





	if ($page=='panneaux-akilux-3mm') {
		$h1name='panneaux akilux pas cher, panneau akylux, panneaux de chantier, Akilux 3mm ou 3,5mm, Akilux 450g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux';
		$info_title='Panneaux Akilux pas cher 3mm';
		$info_info='Les panneaux Akilux au meilleur prix sont fabriquées en Akilux 3mm ou 450g. Impression directe UV sur panneaux akilux. tailles de 60X40cm, 60X80cm, 80X120cm, 120X160cm jusqu à 300X200cm et panneaux akilux personnalisés.<br />Nos panneaux akilux pas cher sont livrés au choix avec oeillet, rainage, crochets, double face... de 1 à 10.000 exemplaires fabriqués en France !';
		$formularz = get_akilux3mm_form();
	}

	if ($page=='panneaux-akilux-3_5mm') {
		$h1name='panneaux akilux, panneau akylux, panneaux de chantier, Akilux 3.5mm, Akilux 600g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux-3_5';
		$info_title='Panneaux Akilux alvéolaire 3.5mm';
		$info_info='Les panneaux Akilux au meilleur tarif sont fabriqués en Akilux 3.5mm. Impression directe UV sur panneaux akilux. De 60X40cm, 60X80cm, 80X120cm, 120X160cm jusqu à 300X200cm et panneaux akilux personnalisés.<br />Nos panneaux akilux pas cher sont livrés au choix avec oeillet, rainage, crochets, double face... de 1 à 10.000 exemplaires fabriqués en France !';
		$formularz = get_akilux3_5mm_form();
	}


	if ($page=='panneaux-akilux-5mm') {
		$h1name='panneaux akilux, panneau akylux, panneaux de chantier, Akilux 5mm, Akilux 900g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux-5mm';
		$info_title='Panneaux Akilux alvéolaire 5mm';
		$info_info='Les panneaux Akilux au meilleur tarif sont fabriqués en Akilux 5mm. Impression directe UV sur panneaux akilux. De 60X40cm, 60X80cm, 80X120cm, 120X160cm jusqu à 300X200cm et panneaux akilux personnalisés.<br />Nos panneaux akilux pas cher sont livrés au choix avec oeillet, rainage, crochets, double face... de 1 à 10.000 exemplaires fabriqués en France !';
		$formularz = get_akilux5mm_form();
	}


	if ($page=='PVC-300-microns') {
		$h1name='PVC 300µ, feuille semi rigide pvc impression PVC 300 Microns';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='PVC-300-microns';
		$info_title='PVC 300 microns semi-rigide';
		$info_info='Les enseignes et panneaux France banderole sont fabriquées en Forex ou Alu-Dibond au choix, avec formes rectangulaires, carrées. la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe en UV, anti reflet, anti rayures pour une protection optimale.<br />Nos enseignes sont livrées en mètre linéaire, emballées et prêtes à monter (hors perçage).';
		$formularz = get_PVC300microns_form();
	}


	if ($page=='panneaux-akilux-10mm') {
		$h1name='panneaux akilux rigide, panneau akylux, panneaux de chantier, Akilux 10mm, akylux 1800g';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='akilux-10mm';
		$info_title='Panneaux Akilux alvéolaire 10mm';
		$info_info='Les panneaux Akilux en Akilux 10mm. Impression directe UV sur panneaux akilux. tailles de 60X40cm, 60X80cm, 80X120cm, 120X160cm et panneaux akilux personnalisés.<br />Nos panneaux akilux sont livrés au choix avec oeillet, rainage, crochets, double face... de 1 à 10.000 exemplaires fabriqués en France !';
		$formularz = get_akilux10mm_form();
	}

	if ($page=='panneaux-forex-1mm') {
		$h1name='Forex 1mm, feuille semi rigide pvc impression forex';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='forex-1mm';
		$info_title='Forex 1mm semi-rigide';
		$info_info='Les enseignes et panneaux France banderole sont fabriquées en Forex ou Alu-Dibond au choix, avec formes rectangulaires, carrées. la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe en UV, anti reflet, anti rayures pour une protection optimale.<br />Nos enseignes sont livrées en mètre linéaire, emballées et prêtes à monter (hors perçage).';
		$formularz = get_forex1mm_form();
	}


	if ($page=='panneaux-forex-3mm') {
		$h1name='Forex 3mm pour publicité intérieure tête de gondole, Plv suspendue';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='forex-3mm';
		$info_title='Forex 3mm semi-rigide pour ILV PLV';
		$info_info='Les enseignes et panneaux France banderole sont fabriquées en Forex ou Alu-Dibond au choix, avec formes rectangulaires, carrées ou personnalisées au choix. la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe UV, anti reflet, anti rayures pour une protection optimale.<br />Nos enseignes sont livrées en mètre linéaire, emballées et prêtes à monter (hors perçage).';
		$formularz = get_forex3mm_form();
	}



	if ($page=='panneaux-forex-5mm') {
		$h1name='Forex 5mm décor interieur plv suspendue rigide';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='forex-5mm';
		$info_title='Forex 5mm rigide';
		$info_info='Les enseignes et panneaux France banderole sont fabriquées en Forex ou Alu Dibond au choix, avec formes rectangulaires, carrées ou personnalisées au choix. la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe UV, anti reflet, anti rayures pour une protection optimale.<br />Nos enseignes sont livrées en mètre linéaire, emballées et prêtes à monter (hors perçage).';
		$formularz = get_forex5mm_form();
	}


	if ($page=='panneaux-dibond') {
		$h1name='Impression sur panneaux Alu Dibond, panneaux rigide dibond 3mm';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='dibond';
		$info_title='Panneaux Alu Didond';
		$info_info='Les enseignes et panneaux France banderole sont fabriquées en Forex ou Dibond au choix, avec formes rectangulaires, carrées ou personnalisées au choix. la durabilité est assurée par un choix de matériau de base résistant ainsi qu\'une impression directe UV, anti reflet, anti rayures pour une protection optimale.<br />Nos enseignes sont livrées en mètre linéaire, emballées et prêtes à monter (hors perçage).';
		$formularz = get_dibond_form();
	}


	if ($page=='affiches') {
		$h1name='Affiches, affiche publicitaire, affiche grand format, Poster, poster XXL';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f5';
		$info_title='Imprimer Affiches Posters petit & grand format';
		$info_info='Imprimer rapidement 10 affiches A1 devient possible avec France Banderole. Nos presses numériques et offset vous permettent d\'acheter 1, 10 ou 10000 affiches ou posters grand format sur papier couché pour un résultat d\'impression avec des couleurs éclatantes. Acheter un poster personnalisé ou une affiche grand format unique pour vous assurer le meilleur prix.';
		$formularz = get_affiches_form();
	}
	if ($page=='cartes') {
		$h1name='Cartes de visite pas cher haut de gamme indechirables - Carte restaurant - Sets de table indéchirable';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f6';
		$info_title='Cartes de Visite & cartes restaurant indéchirables';
		$info_info='La carte de visite pas cher la plus vendue est au format cartes de visite 5,5x8,5cm. c\'est également la plus pratique à ranger dans les portefeuilles. Nous imprimons tous les formats de cartes de restaurant et set de table indéchirables. Les cartes de visite, cartes restaurant et sets de table sont disponibles en petite série dès 100 cartes de visites et 50 sets de table indéchirables. Acheter en petite quantité pour ne plus gâcher !';
		$formularz = get_cartes_form();
	}
	if ($page=='Stickers') {
		$h1name='Autocollants - Stickers adhesifs - Magnets - Vitrophanie - Covering voiture - lettrage prédécoupé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f7';
		$info_title='Autocollants & Stickers';
		$info_info='Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.';

	}

	if ($page=='Sticker-predecoupe') {
		$h1name='Stickers adhesifs prédécoupés - lettrage prédécoupé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='sticker-predecoupe';
		$info_title='Stickers prédécoupés';
		$info_info='Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.';
		$formularz = get_sticker_predecoupe_form();
	}

	if ($page=='Sticker-lettrage-predecoupe') {
		$h1name='Stickers adhesifs prédécoupés - lettrage prédécoupé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='sticker-lettrage';
		$info_title='Stickers lettrages prédécoupés';
		$info_info='Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.';
		$formularz = get_sticker_lettrage_predecoupe_form();
	}


	if ($page=='autocollant') {
		$h1name='Autocollants - Stickers adhesifs - Magnets';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='autocollant';
		$info_title='Autocollants';
		$info_info='Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.';
		$formularz = get_autocollant_form();
	}

	if ($page=='vitrophanie') {
		$h1name='Vitrophanie - Sticker transparent - Vinyle micro-perforé';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='vitrophanie';
		$info_title='Vitrophanie';
		$info_info='Les vinyles adhésifs (stickers) sont imprimés en quadri numérique haute définition et sont livrés coupés au format.<br />Vous pouvez selectionner le matériau de base de votre choix en fonction de son utilisation (vitrine extérieur, vitrophanie, magnétique pour véhicule, etc...).<br />Nos impressions sont garanties 2 ans en extérieur.';
		$formularz = get_vitrophanie_form();
	}


	if ($page=='Oriflammes') {
		$h1name='Oriflamme - Beachflag - Windflag - Drapeaux personnalisés manifestation - flying banner - oriflammes';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f3';
		$info_title='Oriflammes Windflag Beachflag et drapeaux';
		$info_info='Fabricant Oriflamme aile d\'avion, BeachFlag goutte d\'eau ou Windflag rectangulaire. Produit en france, conception robuste, nos oriflammes et drapeaux se distinguent par une finition haut de gamme. Toujours au meilleur prix, les oriflammes s\'utilisent en INT ou EXT et sont un atout majeur pour vos manifestations, salons ou expositions.<br /><u>Délais de livraison en standard :</u> 7 à 9 jours ouvrés.<a rel="shadowbox" href="'.get_bloginfo("url").'/aide-oriflamme/" target="_blank" title="AIDE ORIFLAMME"><b><span class="highlight">NOTICES TECHNIQUES - GABARIT</span></b></a>';
		$formularz = get_oriflammes_form();
	}
	if ($page=='Kakemonos') {
		$h1name='Kakemono Roll-up - Rollup enrouleur - kakemono rolup - kakemono enrouleur -roll-up pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f2';
		$info_title='KAKEMONO ROLL-UP ENROULEUR ';
		$info_info='Le kakemono roll-up ou rollup, un support vertical intérieur de choix de par sa simplicité d’usage et son esthétisme. Son impact visuel fait du roll-up un vecteur de communication idéal pour vos manifestations, salons, expositions, communication interne (accueil, séminaires…). <b>Tous nos roll-up enrouleurs sont livrés GRATUITEMENT avec visuel monté, housse de protection, sac de transport et carton.</b><a rel="shadowbox" href="'.get_bloginfo("url").'/rollup/" target="_blank" title="AIDE KAKEMONO"><b><span class="highlight">NOTICES TECHNIQUES - AIDE</span></b></a>';
		$formularz = get_kakemonos_form();
	}

	if ($page=='roll-up') {
		$h1name='Kakemono Roll-up - Rollup enrouleur - kakemono rolup - kakemono enrouleur - roll-up pas cher';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='roll-up';
		$info_title='KAKEMONO ROLL-UP ENROULEUR';
		$info_info='Le kakemono roll-up ou rollup, un support vertical intérieur de choix de par sa simplicité d’usage et son esthétisme. Son impact visuel fait du roll-up un vecteur de communication idéal pour vos salons, expositions, communication interne (accueil, séminaires…). <b>Tous nos roll-up enrouleurs sont livrés avec visuel monté, housse de protection, sac de transport et carton.</b><a rel="shadowbox" href="'.get_bloginfo("url").'/rollup/" target="_blank" title="AIDE KAKEMONO"><b><span class="highlight">NOTICES TECHNIQUES - AIDE</span></b></a>';
		$formularz = get_rollup_form();
	}


	if ($page=='construction') {
		$h1name='construction';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='totem';
		$info_title='construction ';
		$info_info='construction';
		$formularz = get_construction_form();
	}


	if ($page=='totem') {
		$h1name='Kakemono - Blizzard - clip it - X-screen';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='t';
		$info_title='Kakemono Totem ';
		$info_info='Le kakemono, un support de choix de par sa simplicité d’usage et son esthétisme. Son impact visuel fait du kakemono Totem un vecteur de communication idéal pour vos manifestations, salons, expositions, communication interne (accueil, séminaires…). Tous nos kakemonos enrouleurs sont livrés avec visuel monté, housse de protection, sac de transport et carton.<a rel="shadowbox" href="'.get_bloginfo("url").'/aide-kakemono/" target="_blank" title="AIDE KAKEMONO"><b><span class="highlight">NOTICES TECHNIQUES - AIDE</span></b></a>';
		$formularz = get_totem_form();
	}

	if ($page=='Banderoles') {
		$h1name='Banderole - Banderoles - Banderole Publicitaire - banderole imprimée - impression banderole';
		$imghead1='kakemonos1';
		$imghead2='kakemonos2';
		$imghead3='kakemonos3';
		$mini='f1';
		$info_title='Banderole ';
		$info_info='France Banderole fabricant de banderoles publicitaires, imprimeur numérique grand format. Les bâches publicitaires s’adaptent à toutes vos communications : événementiel, exposition… banderole intérieur (Anti-feu M2,M1) et/ou en extérieur la banderole se positionne facilement. Impression sur baches en qualité photo numérique. Toutes nos banderoles sont recyclables. Chez vous au choix en 24/48H - 72H - 6/8 jours<br /><a rel="shadowbox" href="'.get_bloginfo("url").'/banderole/" target="_blank" title="Banderole : Tout savoir"><span class="highlight"><b>AIDE ET EXPLICATIFS</b></span></a>';
		$formularz = get_banderoles_form();
	}

	if ($page=='cadre-exterieur-bache') {
	$wycena = '<div id="wycena-cadre">
	<div id="wycena-cadre_nag"><span class="wycena-cadre_poz">PRIX UNITAIRE</span><span class="wycena-cadre_poz">TOTAL H.T.</span></div>
	<div id="wycena-cadre_suma"><span class="wycena-cadre_poz" id="prix_unitaire">-</span><span class="wycena-cadre_poz" id="total">-</span></div>
	<div id="dodaj_koszyk-cadre">';
	}
	else if (($page=='panneaux-forex-dibond') || ($page=='panneaux-akilux') || ($page=='Stickers')) {
	$wycena = '';
	} else {
	$wycena = '<div id="wycena">
	<div id="wycena_nag"><span class="wycena_poz">PRIX UNITAIRE</span><span class="wycena_poz">OPTION</span><span class="wycena_poz">REMISE</span><span class="wycena_poz">TOTAL H.T.</span></div>
	<div id="wycena_suma"><span class="wycena_poz" id="prix_unitaire">-</span><span class="wycena_poz" id="option">-</span><span class="wycena_poz" id="remise">-</span><span class="wycena_poz" id="total">-</span></div>
	<div id="dodaj_koszyk">';
	$wycena .= '<div id="livraisonrapide" style="display:none; float:left"><img src="//www.france-banderole.com/wp-content/plugins/fbshop/images/livraison_rapide/liv-rapide.jpg" alt="Impression et livraison le jour meme !" title="Imprimer et livrer le jour-même"/></div>';
	$wycena .= '<form name="cart_form" id="cart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post"></form>';
	$wycena .= '</div></div>';}

	$view .= '<h1>'.$h1name.'</h1><hr />';
	/* $view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>'; */
	if ($page=='cadre-exterieur-bache') {
	$view .= $formularz;
	$view .= $wycena;
}else {$view .= '<div id="top_info"><div class="front"><img class="alignleft size-full" src="'.$plugin_url.'images/'.$mini.'.jpg" alt="" /></div><div id="top_info_info" class="back"><span class="info_nag">'.$info_title.'</span><br />'.$info_info.'</div></div><div id="top_slideshow">'.get_another_images($pageid).'</div>';
	$view .= $formularz;
	$view .= $wycena;
	}

	return $view;
}
}

function get_votre() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_order = $prefix."fbs_order";

	/* TEST envoi données */



	if (fb_is_logged()) {
		if (isset($_POST['votrecompte']) && isset($_SESSION['fbcart'])) {
			//mail("contact@tempopasso.com","TEST Functin get_votre()","AVANT ADD TO DB DANS IF isset post votrecompte// POST=".print_r($_POST,true)."///Session=".print_r($_SESSION,true));
			add_to_db();
			$view .= print_votre();
		} else {
			//mail("contact@tempopasso.com","TEST Functin get_votre()","DANS ELSE isset post votrecompte// POST=".print_r($_POST,true)."///Session=".print_r($_SESSION,true));
			$view .= print_votre();
		}
	} else {
		if (!(isset($_POST['logme']))) {
////////////////////////////////////////////////////////
//jesli user dokonal platnosci i wylogowal sie w trakcie
	if (isset($_GET['paid']) && isset($_POST[DATA])) {
	// RÈcupÈration de la variable cryptÈe DATA
	$message="message=".$_POST[DATA];
	$pathfile="pathfile=/home/frbanderolecom/www/sherlock/param/pathfile";
	$path_bin = "/home/frbanderolecom/www/sherlock/bin/response";
	$result=exec("$path_bin $pathfile $message");
	$tableau = explode ("!", $result);

	$code = $tableau[1];
	$error = $tableau[2];
	$merchant_id = $tableau[3];
	$merchant_country = $tableau[4];
	$amount = $tableau[5];
	$transaction_id = $tableau[6];
	$payment_means = $tableau[7];
	$transmission_date= $tableau[8];
	$payment_time = $tableau[9];
	$payment_date = $tableau[10];
	$response_code = $tableau[11];
	$payment_certificate = $tableau[12];
	$authorisation_id = $tableau[13];
	$currency_code = $tableau[14];
	$card_number = $tableau[15];
	$cvv_flag = $tableau[16];
	$cvv_response_code = $tableau[17];
	$bank_response_code = $tableau[18];
	$complementary_code = $tableau[19];
	$complementary_info= $tableau[20];
	$return_context = $tableau[21];
	$caddie = $tableau[22];
	$receipt_complement = $tableau[23];
	$merchant_language = $tableau[24];
	$language = $tableau[25];
	$customer_id = $tableau[26];
	$order_id = $tableau[27];
	$customer_email = $tableau[28];
	$customer_ip_address = $tableau[29];
	$capture_day = $tableau[30];
	$capture_mode = $tableau[31];
	$data = $tableau[32];
	$logfile="/home/frbanderolecom/www/sherlock/log/logfile.log";
	$fp=fopen($logfile, "a");

 	if (( $code == "" ) && ( $error == "" ) ) {
	  	fwrite($fp, "erreur appel response\n");
  		echo "executable response non trouve $path_bin\n";
 	} else if ( $code != 0 ){
        fwrite($fp, " API call error.\n");
        fwrite($fp, "Error message :  $error\n");
 	}
	else {
	fwrite( $fp, "merchant_id : $merchant_id\n");
	fwrite( $fp, "merchant_country : $merchant_country\n");
	fwrite( $fp, "amount : $amount\n");
	fwrite( $fp, "transaction_id : $transaction_id\n");
	fwrite( $fp, "transmission_date: $transmission_date\n");
	fwrite( $fp, "payment_means: $payment_means\n");
	fwrite( $fp, "payment_time : $payment_time\n");
	fwrite( $fp, "payment_date : $payment_date\n");
		fwrite( $fp, "response_code : $response_code\n");
		fwrite( $fp, "payment_certificate : $payment_certificate\n");
		fwrite( $fp, "authorisation_id : $authorisation_id\n");
		fwrite( $fp, "currency_code : $currency_code\n");
		fwrite( $fp, "card_number : $card_number\n");
		fwrite( $fp, "cvv_flag: $cvv_flag\n");
		fwrite( $fp, "cvv_response_code: $cvv_response_code\n");
		fwrite( $fp, "bank_response_code: $bank_response_code\n");
		fwrite( $fp, "complementary_code: $complementary_code\n");
		fwrite( $fp, "complementary_info: $complementary_info\n");
		fwrite( $fp, "return_context: $return_context\n");
		fwrite( $fp, "caddie : $caddie\n");
		fwrite( $fp, "receipt_complement: $receipt_complement\n");
		fwrite( $fp, "merchant_language: $merchant_language\n");
		fwrite( $fp, "language: $language\n");
		fwrite( $fp, "customer_id: $customer_id\n");
		fwrite( $fp, "order_id: $order_id\n");
		fwrite( $fp, "customer_email: $customer_email\n");
		fwrite( $fp, "customer_ip_address: $customer_ip_address\n");
		fwrite( $fp, "capture_day: $capture_day\n");
		fwrite( $fp, "capture_mode: $capture_mode\n");
		fwrite( $fp, "data: $data\n");
		fwrite( $fp, "-------------------------------------------\n");

		fclose ($fp);
		if($bank_response_code=='00') {
			$setorder = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$order_id'");
			if ($setorder->status == '1') {
				$apdejt = $wpdb->query("UPDATE `$fb_tablename_order` SET status='2' WHERE unique_id='$order_id'");
				if (!$apdejt) {
					$view .= 'Erreur appel response. Contactez l\'administrateur.';
				} else {
					$view .= 'Votre paiement est accepté. Merci de vous connecter à votre compte.';
				}
			}
		}
		}

	}
////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
			$view .= get_acces_panel(0);
		}
	}
	return $view;
}

function get_verification() {
	if (fb_is_logged()) {
		$prolog = '<h1>Votre devis: Verification de la commande</h1><hr />';
		if (is_cart_not_empty()) {
			//echo "///Session=";print_r($_SESSION);
			$products = $_SESSION['fbcart'];
			$user = $_SESSION['loggeduser'];
			//echo "1///Session=";print_r($_SESSION);
			//echo "2///User=";print_r($user);
			$prolog .= '<div class="address_tab_name">VOTRE COMMANDE:</div>';
			$epilog_a .= '<a href="'.get_bloginfo("url").'/votre-panier/?cart=clear" id="but_annuler"></a>';
			$epilog_b .= '<a href="'.get_bloginfo("url").'/votre-panier/" id="but_modifier"></a>';
			$epilog_c .= '<form name="validerdevis" id="validerdevis" action="'.get_bloginfo('url').'/vos-devis/" method="post"><input type="hidden" name="votrecompte" /><button id="but_validerdevis" type="submit"></button></form>';
			$epilog_d .= contact_advert();
			$epilog_0 .= '<div id="addresses"><div class="address_tab_name">ADRESSE DE LIVRAISON</div><div class="address_tab_name">ADRESSE DE FACTURATION:</div>';
			$explode = explode('|', $user->f_address);
			$f_address = $explode['0'];
			$f_porte = $explode['1'].'<br />';
			$explode2 = explode('|', $user->l_address);
			$l_address = $explode2['0'];
			$l_porte = $explode2['1'].'<br />';
			if ( ($l_name == '') && ($l_address == '') ) {
				$epilog_0 .= '<div class="address_tab_content">'.$user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city.'</div>';
			} else {
				$epilog_0 .= '<div class="address_tab_content">'.$user->l_name.'<br />'.$user->l_comp.'<br />'.$l_address.'<br />'.$l_porte.$user->l_code.'<br />'.$user->l_city.'</div>';
			}
			$epilog_0 .= '<div class="address_tab_content">'.$user->f_name.'<br />'.$user->f_comp.'<br />'.$f_address.'<br />'.$f_porte.$user->f_code.'<br />'.$user->f_city.'</div></div>';
		}
		if($_SESSION['isburaliste']){
			$lien_catalogue = get_bloginfo("url") . "/buralistes";
		}
		elseif($_SESSION['ismma']){
			$lien_catalogue = get_bloginfo("url") . "/mma";
		}else{
			$lien_catalogue = get_bloginfo("url") . "#tarifs";
		}
		/*$epilog .= $epilog_0.'<div id="fbcart_buttons2">'.$epilog_a.'<a href="'.get_bloginfo("url").'#tarifs" id="but_ajouter"></a>'.$epilog_b.$epilog_c.'</div>'.$epilog_d;*/
		$epilog .= $epilog_0.'<div id="fbcart_buttons2">'.$epilog_a.'<a href="'.$lien_catalogue.'" id="but_ajouter"></a>'.$epilog_b.$epilog_c.'</div>'.$epilog_d;
		$view .= print_devis_verification($products, $prolog, $epilog);
	} else {
		if (!(isset($_POST['logme']))) {
			$view .= get_acces_panel($p);
		}
	}

	//$view .= "22SESSION=".print_r($_SESSION,true);
	//$view .= "///POST=".print_r($_POST,true);

	return $view;
}

function print_devis_verification($products, $prolog, $epilog) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$view .= $prolog;
	if (is_cart_not_empty()) {
		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth2">Description</th><th>Quantité</th><th>Total</th><th class="nobackground"></th></tr>';
		$licznik = 0;
		$kosztcalosci = 0;
		foreach ( $products as $products => $item ) {
			$licznik++;
			$view .= '
			<tr><td class="lefttd"><span class="name">'.$item[rodzaj].'</span></td><td style="width:120px">'.$item[ilosc].'</td><td>'.$item[total].'</td><td style="width:24px"></td></tr>';
			$koszttotal = str_replace(',', '.', $item[total]);
			$kosztcalosci = $kosztcalosci + $koszttotal;
			$transportcalosci = $transportcalosci + $item[transport];
  		}
  		$view .= '</table>';
//sprawdzanie czy jest rabat dla uzytkownika//
		if (!empty($_SESSION['loggeduser'])) {
			$uid = $_SESSION['loggeduser']->id;
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = '$uid'");
			if ($exist_remise) {
				$client_remise = $exist_remise->att_value;
				if (!empty($client_remise) && $client_remise != '0') {
					$newrabat = $client_remise / 100;
					$wysokoscrabatu = $kosztcalosci * $newrabat;
					$kosztcalosci = $kosztcalosci - $wysokoscrabatu;
			  		$wysokoscrabatu = str_replace('.', ',', number_format($wysokoscrabatu, 2));
					$cremisetd = '<tr><td class="toleft">REMISE ('.$client_remise.'%)</td><td class="toright">'.$wysokoscrabatu.' &euro;</td></tr>';
				}
			}
		}
//koniec//
		$kosztcalosci = $kosztcalosci + $transportcalosci;
  		$podatekcalosci = $kosztcalosci*0.200;
  		$totalcalosci = $kosztcalosci+$podatekcalosci;
  		$kosztcalosci = str_replace('.', ',', number_format($kosztcalosci, 2));
  		$transportcalosci = str_replace('.', ',', number_format($transportcalosci, 2));
  		$podatekcalosci = str_replace('.', ',', number_format($podatekcalosci, 2));
  		$totalcalosci = str_replace('.', ',', number_format($totalcalosci, 2));
		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
		'.$cremisetd.'
		<tr><td class="toleft">Frais de port</td><td class="toright">'.$transportcalosci.' &euro;</td></tr>
		<tr><td class="toleft">Total ht</td><td class="toright">'.$kosztcalosci.' &euro;</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$podatekcalosci.' &euro;</td></tr>
		<tr><td class="toleft" style="height:30px">total ttc</td><td class="toright" style="height:30px"><b>'.$totalcalosci.' &euro;</b></td></tr>
		</table>';
	} else {
		$view .= 'Votre panier est vide !';
	}
	$view .= $epilog;
	return $view;
}



function get_mode_de_livraison(){
	$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);
 	if($relais_colis !== false){
		$retour = '<div class="acces_tab_name_devis noprint">MODE DE LIVRAISON : RELAIS COLIS</div>
		<div style="position:relative; display:block;height:60px;"></div>
			';
		$retour .= '<div id="tntB2CRelaisColis" class="exemplePresentation"></div>
		<div id="map_canvas" class="exemplePresentation" style="width: 250px; height: 200px; margin-left:10px;"></div>';

		$retour .= '
		<form action="" method="post" name="form_adresse_relais_colis" id="form_adresse_relais_colis">

<input type="hidden" id="tntRCSelectedCode" value=""/>
<input type="hidden" id="tntRCSelectedNom" value=""/>
<input type="hidden" id="tntRCSelectedAdresse" value=""/>
<input type="hidden" id="tntRCSelectedCodePostal" value=""/>
<input type="hidden" id="tntRCSelectedCommune" value=""/>


		</form>
<div style="text-align: justify; font-family: arial,helvetica,sans-serif; font-size: 10pt; width: 600px;">


			<div id="exempleIntegration">


				<script type="text/javascript">
				  	function callbackSelectionRelais() {

				  		// Récupération des informations
				  		var codeRelais = $("#tntRCSelectedCode").val();
			  			var nom = $("#tntRCSelectedNom").val();
			  			var adresse = $("#tntRCSelectedAdresse").val();
			  			var codePostal = $("#tntRCSelectedCodePostal").val();
			  			var commune = $("#tntRCSelectedCommune").val();

				  		if (!codeRelais || codeRelais == "") {
				  			alert("Aucun relais n\'a été sélectionné !");
							return false;
				  		}else {
				  			//alert("Info relais sélectionné"+
				  			//	  "\nCode\t\t: " + codeRelais +
				  			//	  "\nNom\t\t: " + nom +
				  			//	  "\nAdresse\t\t: " + adresse +
				  			//	  "\nCode postal\t: " + codePostal +
				  			//	  "\nCommune\t\t: " + commune);

							var formData = {
								  codeRelais : codeRelais,
								  nom : nom,
								  adresse : adresse,
								  codePostal : codePostal,
								  commune : commune
							}

						  	var request = $.ajax({
								  url: "/wp-content/plugins/fbshop/relais_colis_ajax.php",
								  type: "POST",
								  data : formData
					  		});
							return true;
				  		}


				  	}

				  	function callbackSelectionRelaisClick() {
						//alert("1ere instruction");
						if(callbackSelectionRelais()){
							//alert("2nde instruction: dans if");
				  		// Récupération des informations
				  		var codeRelais = $("#tntRCSelectedCode").val();
			  			var nom = $("#tntRCSelectedNom").val();
			  			var adresse = $("#tntRCSelectedAdresse").val();
			  			var codePostal = $("#tntRCSelectedCodePostal").val();
			  			var commune = $("#tntRCSelectedCommune").val();
				  			alert("Info relais sélectionné"+
				  				  "\nCode\t\t: " + codeRelais +
				  				  "\nNom\t\t: " + nom +
				  				  "\nAdresse\t\t: " + adresse +
				  				  "\nCode postal\t: " + codePostal +
				  				  "\nCommune\t\t: " + commune);

							var url2 = "'.get_bloginfo("url").'/verification/";
							$(location).attr(\'href\',url2);
						}else{
							//alert("211Aucun relais n\'a été sélectionné !");
							return false;
						}



						}
				</script>


			</div>
		</div>


		';

	}
	//else $retour = "Pas de relais colis";
	//$retour .= print_r($_SESSION,true);
	return $retour ;
}


function get_devis() {
	$products = $_SESSION['fbcart'];
	$prolog = '<h1 class="noprint">Votre devis: Inscription</h1><hr class="noprint" />';
	$prolog .= get_mode_de_livraison();
	if (is_cart_not_empty()) {
		$prolog .= '<div class="acces_tab_name_devis noprint">MON DEVIS :</div>';
	}
	$epilog = '<div id="fbcart_buttons" class="noprint">';
	if (is_cart_not_empty()) {
		$epilog .= '<a href="'.get_bloginfo("url").'/votre-panier/?cart=clear" id="but_supprimer"></a><a href="javascript:window.print()" id="but_imprimer"></a>';
	}
		if($_SESSION['isburaliste']){
			$lien_catalogue = get_bloginfo("url") . "/buralistes";
		}
		elseif($_SESSION['ismma']){
			$lien_catalogue = get_bloginfo("url") . "/mma";
		}else{
			$lien_catalogue = get_bloginfo("url") . "#tarifs";
		}
	/*$epilog .= '<a href="'.get_bloginfo("url").'#tarifs" id="but_ajouter"></a>';*/
	$epilog .= '<a href="'.$lien_catalogue.'" id="but_ajouter"></a>';
	if (is_cart_not_empty()) {
		//$epilog .= '<a href="'.get_bloginfo("url").'/verification/" id="but_continuer"></a>';
		$relais_colis = recursive_array_search("relais colis", $_SESSION['fbcart']);
 		if($relais_colis !== false){
			$epilog .= '<a href="#" id="but_continuer" onclick="callbackSelectionRelaisClick();return false;"></a>';
		}else{
			$epilog .= '<a href="'.get_bloginfo("url").'/verification/" id="but_continuer"></a>';
		}
	}
	$epilog .= '</div>';
	$epilog .= contact_advert();
	$view .= print_devis($products, $prolog, $epilog);
	return $view;
}
function contact_advert() {
	$plugin_url=get_bloginfo('url').'/wp-content/plugins/fbshop/';
	$view .= '<div id="contact_advert"><img src="'.$plugin_url.'images/contact_info.jpg" alt="contact with us" /></div>';
	return $view;
}

function print_devis($products, $prolog, $epilog) {
	/* fonction de validation du devis */
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";
	$view .= $prolog;
	$images_url=get_bloginfo('url').'/wp-content/plugins/fbshop/images/';
	if (is_cart_not_empty()) {
		$view .= '<div class="print_nag onlyprint"><table class="print_header"><tr><td style="float:left;"><img src="'.$images_url.'printlogo.jpg" width="350" height="200" alt="france banderole" class="logoprint2" /></td><td style="font-size:11px;float:right;text-align:right;margin-top:35px;">&nbsp;</td></tr><tr><td colspan="2" style="text-align:center;padding:20px 0;font-weight:bold;font-size:13px;">Votre devis: Inscription</td></tr></table></div>';
		$view .= '<table id="fbcart_cart" cellspacing="0"><tr><th class="leftth">Description</th><th>Quantité</th><th>Prix  U.</th><th>Option</th><th>Remise</th><th>Total</th><th class="nobackground"></th></tr>';
		$licznik = 0;
		$kosztcalosci = 0;
		foreach ( $products as $products => $item ) {
			$licznik++;
			$view .= '
			<tr><td class="lefttd"><span class="name">'.$item[rodzaj].'</span><br /><span class="therest">'.stripslashes($item[opis]).'</span></td><td>'.$item[ilosc].'</td><td>'.$item[prix].'</td><td>'.$item[option].'</td><td>'.$item[remise].'</td><td>'.$item[total].'</td><td><form name="delcart_form" id="delcart_form" action="'.get_bloginfo('url').'/votre-panier/" method="post"><input type="hidden" name="delfromcart" value="delfromcart" /><input type="hidden" name="rodzaj" value="'.$item[rodzaj].'" /><input type="hidden" name="opis" value="'.$item[opis].'" /><input type="hidden" name="ilosc" value="'.$item[ilosc].'" /><input type="hidden" name="licznik" value="'.$licznik.'" /><button id="delcart" type="submit">DEL</button>
			</form></td></tr>';
			$koszttotal = str_replace(',', '.', $item[total]);
			$kosztcalosci = $kosztcalosci + $koszttotal;
			$transportcalosci = $transportcalosci + $item[transport];
  		}
  		$view .= '</table>';
//vérifier si il ya un rabais pour l'utilisateur//
		if (!empty($_SESSION['loggeduser'])) {
			$uid = $_SESSION['loggeduser']->id;
			$exist_remise = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE att_name = 'client_remise' AND uid = '$uid'");
			if ($exist_remise) {
				$client_remise = $exist_remise->att_value;
				if (!empty($client_remise) && $client_remise != '0') {
					$newrabat = $client_remise / 100;
					$wysokoscrabatu = $kosztcalosci * $newrabat;
					$kosztcalosci = $kosztcalosci - $wysokoscrabatu;
			  		$wysokoscrabatu = str_replace('.', ',', number_format($wysokoscrabatu, 2));
					$cremisetd = '<tr><td class="toleft">REMISE ('.$client_remise.'%)</td><td class="toright">'.$wysokoscrabatu.' &euro;</td></tr>';
				}
			}
		}
//fin//
		$kosztcalosci = $kosztcalosci + $transportcalosci;
  		$podatekcalosci = $kosztcalosci*0.200;
  		$totalcalosci = $kosztcalosci+$podatekcalosci;
  		$kosztcalosci = str_replace('.', ',', number_format($kosztcalosci, 2));
  		$transportcalosci = str_replace('.', ',', number_format($transportcalosci, 2));
  		$podatekcalosci = str_replace('.', ',', number_format($podatekcalosci, 2));
  		$totalcalosci = str_replace('.', ',', number_format($totalcalosci, 2));
		$view .= '<table id="fbcart_check" border="0" cellspacing="0">
		'.$cremisetd.'
		<tr><td class="toleft">Frais de port</td><td class="toright">'.$transportcalosci.' &euro;</td></tr>
		<tr><td class="toleft">Total ht</td><td class="toright">'.$kosztcalosci.' &euro;</td></tr>
		<tr><td class="toleft">Montant Tva (20%)</td><td class="toright">'.$podatekcalosci.' &euro;</td></tr>
		<tr><td class="toleft" style="height:30px">total ttc</td><td class="toright" style="height:30px"><b>'.$totalcalosci.' &euro;</b></td></tr>
		</table>';
		$view .= '<div class="bottomfak onlyprint"><i>Ce devis n\'est donné qu\'à titre indicatif. Il ne saurait se substituer à un devis complet et validé par nos services.<br />Les tarifs applicables sont toujours ceux des devis validés sur notre site web www.france-banderole.com.<br />Si vous souhaitez continuer ce devis gratuit et profiter de ce tarif, merci de bien vouloir vous enregistrer.</i></div>';
	} else {
		$view .= 'Votre panier est vide !';
	}
	$view .= $epilog;
	return $view;
}




/*
function get_stickers_form_old() {
	$form = '
<div id="buying">
<form class="jotform-form" action="" method="post" name="form_1060900216" id="1060900216" accept-charset="utf-8" onsubmit="JKakemono.cal_stickers(); return false;">
    <input type="hidden" name="formID" value="1060900216" />
    <div class="form-all">
        <ul class="form-section">
            <li class="form-line" id="id_1">
                <label class="form-label-left" id="label_1" for="input_1">type de stickers:</label>
                    <select class="form-dropdown validate[required]" id="input_1" name="q1_usage" onchange="getElementById(\'preview_info_ul\').innerHTML=\'\'; JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="Stickers">Stickers prédécoupés </option>
                        <option value="Lettrages">Lettrages prédécoupés </option>
                        <option value="Formes">Formes simples </option>
                    </select>
            </li>
            <li class="form-line" id="id_2">
                <label class="form-label-left" id="label_2" for="input_2">support: </label>
                    <select class="form-dropdown validate[required]" id="input_2" name="q2_support2" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir... </option>
                        <option value="vinyle blanc monomère 95μ">vinyle blanc monomère 95μ</option>
                        <option value="vinyle transparent monomère 95μ">vinyle transparent monomère 95μ</option>
                        <option value="vinyle blanc polymère M1 repositionnable 80μ">vinyle blanc polymère M1 repositionnable 80μ</option>
                    </select>
            </li>
            <li class="form-line" id="id_3">
                <label class="form-label-left" id="label_3" for="input_3">support: </label>
                    <select class="form-dropdown validate[required]" id="input_3" name="q3_support3" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir... </option>
                        <option value="vinyle blanc monomère 95μ">vinyle blanc monomère 95μ</option>
                        <option value="vinyle blanc polymère M1 repositionnable 80μ">vinyle blanc polymère M1 repositionnable 80μ</option>
                    </select>
            </li>
            <li class="form-line" id="id_4">
                <label class="form-label-left" id="label_4" for="input_4">support: </label>
                    <select class="form-dropdown validate[required]" id="input_4" name="q4_support4" onchange="JKakemono.czyscpola(); ">
						<option value="">choisir... </option>
                        <option value="vinyle blanc monomère 95μ">vinyle blanc monomère 95μ</option>
                        <option value="vinyle transparent monomère 95μ">vinyle transparent monomère 95μ</option>
                        <option value="vinyle micro-perforè M1 dos noir">vinyle micro-perforé M1 dos noir</option>
                        <option value="vinyle blanc polymère M1 repositionnable 80μ">vinyle blanc polymère M1 repositionnable 80μ</option>
                    </select>
            </li>
            <li class="form-line" id="id_6">
                <label class="form-label-left" id="label_6" for="input_6">maquette:</label>
                    <select class="form-dropdown validate[required]" id="input_6" name="q6_maquette6" onchange="JKakemono.czyscpola(); ">
                        <option value="">choisir...</option>
                        <option value="fb">France banderole crée la maquette</option>
                        <option value="user">j’ai déjà crée la maquette </option>
                    </select>
            </li>
            <li class="form-line" id="id_7">
                <label class="form-label-left" id="label_7" for="input_7">quantité:</label>
                    <input type="text" class="form-textbox validate[required, Numeric]" id="input_7" name="q7_quantite" size="20" value="1" onchange="JKakemono.czyscpola(); " />
            </li>
            <li class="form-line sizehigher" id="id_8">
                <label class="form-label-left" id="label_8" for="input_8">taille (en metre):</label>
                    <input type="text" class="form-textbox validate[required, Numeric]" id="input_8" name="q8_taile" size="20" onchange="JKakemono.czyscpola(); " /><span class="heusepar">x</span><input type="text" class="form-textbox2 validate[required, Numeric]" id="input_9" name="q9_taile" size="20" onchange="JKakemono.czyscpola(); " /><span class="llar">[largeur]</span><span class="lhau">[hauteur]</span>
            </li>
            <li class="form-line" id="id_9a">
                <div class="form-input-wide">
                <div id="form-button-error2"></div>
                        <button id="input_10" type="submit" class="form-submit-button">Submit Form</button>
                </div>
            </li>
            <li style="display:none">
                Should be Empty:
                <input type="text" name="website" value="" />
            </li>
        </ul>
    </div>
    <input type="hidden" id="simple_spc" name="simple_spc" value="1060900216" />
    <script type="text/javascript">
        document.getElementById("simple_spc").value += "-1060900216";
    </script>
</form>
</div>
<div id="preview">
<span id="preview_name">Adhésifs / Stickers sélectionné:</span>
<div id="preview_imag"></div><div id="preview_info"><div id="preview_info_title"></div><ul id="preview_info_ul"><li style="display:none"></li></ul></div>
</div>
';
	return $form;
}
*/




function get_plv() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_plv";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>PLV Exterieur - Intérieur - Stop trottoir - Chevalet - Accessoires pose - Cadre Alu</h1><hr />';
	/* $view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>'; */
	$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/f10.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">PLV Exterieur - Intérieur - Accessoires</span><br />Toutes les PLV extérieures et intérieur de France banderole ont été sélectionnées pour leur simplicité d\'utilisation et leur robustesse.<br />Nos PLV sont livrées complètes et prêtes à monter, avec vos visuels imprimés en quadri haute définition compris dans nos tarifs.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
<script type="text/javascript">
		function rushcheckbox24($type) {
                    var rush24 = document.getElementById("rush24"+$type);
                    var rush72 = document.getElementById("rush72"+$type);
                    var fedex0 = document.getElementById("fedex"+$type);
                    var tnt0 = document.getElementById("tnt"+$type);
                    if (rush72.checked == true) {
                        document.getElementById("rush72"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (rush24.checked == true) {
						document.getElementById("rush72"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (fedex0.checked) {
                        document.getElementById("fedex"+$type).checked = false;
						document.getElementById("tnt"+$type).checked = true;
					}
		}
		function rushcheckbox72($type) {
                    var rush24 = document.getElementById("rush24"+$type);
                    var rush72 = document.getElementById("rush72"+$type);
                    var fedex0 = document.getElementById("fedex"+$type);
                    var tnt0 = document.getElementById("tnt"+$type);
                    if (rush24.checked == true) {
                        document.getElementById("rush24"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (rush72.checked == true) {
						document.getElementById("rush24"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (fedex0.checked) {
                        document.getElementById("fedex"+$type).checked = false;
						document.getElementById("tnt"+$type).checked = true;
					}
		}

                function TNTClick($type) {
                    if (document.getElementById("tnt"+$type).checked) {
                        document.getElementById("fedex"+$type).checked = false;
                    }else{
						document.getElementById("fedex"+$type).checked = true;
					}
                }
                function FEDClick($type) {
                    if (document.getElementById("fedex"+$type).checked) {
                        document.getElementById("colis"+$type).checked = false;
                        document.getElementById("rush24"+$type).checked = false;
                        document.getElementById("rush72"+$type).checked = false;
                        document.getElementById("relais"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = false;
                    }else{
						document.getElementById("tnt"+$type).checked = true;
					}
                }
				function colisrevendeurclick($type){
					 /*if (document.getElementById("colis"+$type).checked) {
					 	document.getElementById("tnt"+$type).checked = true;
						document.getElementById("fedex"+$type).checked = false;
					 }*/
				}
				function refreshBoxs($type){

				}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}

		$view .=
                '<form name="cart_form' . $licznik . '" class="prom_form" action="' . get_bloginfo("url") . '/votre-panier/" method="post" onsubmit="return czyilosc(' . $licznik . ')">
                    <tr>
                        <td class="lefttd"><span class="prom_title"><b>' . $p[name] . '</b></span><br /><span id="desc' . $licznik . '" class="prom_therest">' . stripslashes($subtitle . $p[description]) . '</span></td>
                        <td class="imgtd">' . $viewmini . '<span class="prom_price">a partir de ' . $n_price . '</span></td>
                        <td class="optionstd">
                            <span>OPTIONS:</span>
                            <input type="hidden" name="addtocart2" value="addtocart2" />
                            <input type="hidden" name="rodzaj" value="' . $p[name] . '" />

                            <div class="">
                            </div>
                            <div class="plvoptions">
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="colis' . $licznik . '" name="colis" value="1" onchange="colisrevendeurclick(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_colis' . $licznik . '" for="colis' . $licznik . '">Colis revendeur</label><span class="helpButton" onmouseover="pokazt(\'helpTextcolis' . $licznik . '\');" onmouseout="ukryjt(\'helpTextcolis' . $licznik . '\');"><span class="helpText" id="helpTextcolis' . $licznik . '" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush24' . $licznik . '" name="rush24" value="1" onchange="rushcheckbox24(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush24' . $licznik . '" for="rush24' . $licznik . '">Délai Rush 24/48H</label><span class="helpButton" onmouseover="pokazt(\'helpTextRush24' . $licznik . '\');" onmouseout="ukryjt(\'helpTextRush24' . $licznik . '\');"><span class="helpText" id="helpTextRush24' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush72' . $licznik . '" name="rush72" value="1" onchange="rushcheckbox72(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush72' . $licznik . '" for="rush72' . $licznik . '">Délai Rush 72H</label><span class="helpButton" onmouseover="pokazt(\'helpTextrush72' . $licznik . '\');" onmouseout="ukryjt(\'helpTextrush72' . $licznik . '\');"><span class="helpText" id="helpTextrush72' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="relais' . $licznik . '" name="relais" value="1" onchange="relaisColischeckbox15(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_relais' . $licznik . '" for="relais' . $licznik . '">Dépot en relais colis</label><span class="helpButton" onmouseover="pokazt(\'helpTextrelais' . $licznik . '\');" onmouseout="ukryjt(\'helpTextrelais' . $licznik . '\');"><span class="helpText" id="helpTextrelais' . $licznik . '" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
                                <span class="plvoptionsingle" style="border: 1px solid #9FA3A8; font-weight: 700;"><input type="checkbox" class="form-checkbox" checked="checked" id="fedex' . $licznik . '" name="fedex[]" value="" onclick=" FEDClick(' . $licznik . ');" /><label  class="form-label-left" id="label_fedex' . $licznik . '" for="fedex' . $licznik . '">Livraison avec Fedex</label><span class="helpButton" onmouseover="pokazt(\'helpTextfedex' . $licznik . '\');" onmouseout="ukryjt(\'helpTextfedex' . $licznik . '\');"><span class="helpText" id="helpTextfedex' . $licznik . '" style="visibility:hidden;">Livraison gratuite avec Fedex en 7 à 9 jours ouvrés (non compatible avec les délais Rush, et Relais colis).</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="tnt' . $licznik . '" name="tnt[]" value="" onclick=" TNTClick(' . $licznik . '); " /><label class="form-label-left" id="label_tnt' . $licznik . '" for="tnt' . $licznik . '">Livraison avec TNT</label><span class="helpButton" onmouseover="pokazt(\'helpTexttnt' . $licznik . '\');" onmouseout="ukryjt(\'helpTexttnt' . $licznik . '\');"><span class="helpText" id="helpTexttnt' . $licznik . '" style="visibility:hidden;">Livraison payante avec TNT en 6 à 8 jours ouvrés(non compatible pour un colis hors-norme*)</span></span></span>
                            </div>
                        </td>
                        <td class="righttd">
                            <div class="plvmakcon"><div class="plvmak"><input type="radio" name="projectmak" value="fb" /> France banderole crée la maquette</div><div class="plvmak1"><input type="radio" name="projectmak" value="us" checked="checked" /> j’ai déjà crée la maquette</div></div>
                            <div class="pilosc"><b>Quantite:</b><input type="text" name="ilosc" id="nummo' . $licznik . '" class="inp_ilosc" value="" /></div>
                            <input type="hidden" name="isplv" value="true" />
                            <input type="hidden" name="opis1" value="' . $p[subname] . '" /><input type="hidden" name="opis2" value="' . $p[description] . '" />
                            <input type="hidden" name="prix" value="' . $p[price] . '" />' . $cedd . '<input type="hidden" name="transport" value="' . $p[frais] . ' &euro;" />
                            <button type="submit" class="prom_sub">Ajouter</button>
                        </td>
                    </tr>
                </form>';

	endforeach;

	$view .= '</table>';

	return $view;
}


function get_plv_int() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_plv_int";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>PLV Exterieur - Intérieur - Stop trottoir - Chevalet - Accessoires pose - Cadre Alu</h1><hr />';
	/* $view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>'; */
	$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/f22.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">PLV Intérieur - Accessoires</span><br />Toutes les PLV intérieur de France banderole ont été sélectionnées pour leur simplicité d\'utilisation et leur robustesse.<br />Nos PLV sont livrées complètes et prêtes à monter, avec vos visuels imprimés en quadri haute définition compris dans nos tarifs.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
<script type="text/javascript">
		function rushcheckbox24($type) {
                    var rush24 = document.getElementById("rush24"+$type);
                    var rush72 = document.getElementById("rush72"+$type);
                    var fedex0 = document.getElementById("fedex"+$type);
                    var tnt0 = document.getElementById("tnt"+$type);
                    if (rush72.checked == true) {
                        document.getElementById("rush72"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (rush24.checked == true) {
						document.getElementById("rush72"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (fedex0.checked) {
                        document.getElementById("fedex"+$type).checked = false;
						document.getElementById("tnt"+$type).checked = true;
					}
		}
		function rushcheckbox72($type) {
                    var rush24 = document.getElementById("rush24"+$type);
                    var rush72 = document.getElementById("rush72"+$type);
                    var fedex0 = document.getElementById("fedex"+$type);
                    var tnt0 = document.getElementById("tnt"+$type);
                    if (rush24.checked == true) {
                        document.getElementById("rush24"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (rush72.checked == true) {
						document.getElementById("rush24"+$type).checked = false;
                        document.getElementById("fedex"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = true;
                    }
                    if (fedex0.checked) {
                        document.getElementById("fedex"+$type).checked = false;
						document.getElementById("tnt"+$type).checked = true;
					}
		}

                function TNTClick($type) {
                    if (document.getElementById("tnt"+$type).checked) {
                        document.getElementById("fedex"+$type).checked = false;
                    }else{
						document.getElementById("fedex"+$type).checked = true;
					}
                }
                function FEDClick($type) {
                    if (document.getElementById("fedex"+$type).checked) {
                        document.getElementById("colis"+$type).checked = false;
                        document.getElementById("rush24"+$type).checked = false;
                        document.getElementById("rush72"+$type).checked = false;
                        document.getElementById("relais"+$type).checked = false;
                        document.getElementById("tnt"+$type).checked = false;
                    }else{
						document.getElementById("tnt"+$type).checked = true;
					}
                }
				function colisrevendeurclick($type){
					/* if (document.getElementById("colis"+$type).checked) {
					 	document.getElementById("tnt"+$type).checked = true;
						document.getElementById("fedex"+$type).checked = false;
					 }*/
				}
				function refreshBoxs($type){

				}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/plv/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}
		$view .= '<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')"><tr><td class="lefttd"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>
		<td class="imgtd">'.$viewmini.'<span class="prom_price">a partir de '.$n_price.'</span></td>
		<td class="optionstd">
		<span>OPTIONS:</span>
		<input type="hidden" name="addtocart2" value="addtocart2" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />
		<div class="plvoptions">
			                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="colis' . $licznik . '" name="colis" value="1" onchange="colisrevendeurclick(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_colis' . $licznik . '" for="colis' . $licznik . '">Colis revendeur</label><span class="helpButton" onmouseover="pokazt(\'helpTextcolis' . $licznik . '\');" onmouseout="ukryjt(\'helpTextcolis' . $licznik . '\');"><span class="helpText" id="helpTextcolis' . $licznik . '" style="visibility:hidden;">Vous permet d’avoir une expédition neutre sans étiquetage France banderole.</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush24' . $licznik . '" name="rush24" value="1" onchange="rushcheckbox24(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush24' . $licznik . '" for="rush24' . $licznik . '">Délai Rush 24/48H</label><span class="helpButton" onmouseover="pokazt(\'helpTextRush24' . $licznik . '\');" onmouseout="ukryjt(\'helpTextRush24' . $licznik . '\');"><span class="helpText" id="helpTextRush24' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush72' . $licznik . '" name="rush72" value="1" onchange="rushcheckbox72(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_rush72' . $licznik . '" for="rush72' . $licznik . '">Délai Rush 72H</label><span class="helpButton" onmouseover="pokazt(\'helpTextrush72' . $licznik . '\');" onmouseout="ukryjt(\'helpTextrush72' . $licznik . '\');"><span class="helpText" id="helpTextrush72' . $licznik . '" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="relais' . $licznik . '" name="relais" value="1" onchange="relaisColischeckbox15(' . $licznik . ');refreshBoxs(' . $licznik . ');" /><label class="form-label-left" id="label_relais' . $licznik . '" for="relais' . $licznik . '">Dépot en relais colis</label><span class="helpButton" onmouseover="pokazt(\'helpTextrelais' . $licznik . '\');" onmouseout="ukryjt(\'helpTextrelais' . $licznik . '\');"><span class="helpText" id="helpTextrelais' . $licznik . '" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
                                <span class="plvoptionsingle" style="border: 1px solid #9FA3A8; font-weight: 700;"><input type="checkbox" class="form-checkbox" checked="checked" id="fedex' . $licznik . '" name="fedex[]" value="" onclick=" FEDClick(' . $licznik . ');" /><label  class="form-label-left" id="label_fedex' . $licznik . '" for="fedex' . $licznik . '">Livraison avec Fedex</label><span class="helpButton" onmouseover="pokazt(\'helpTextfedex' . $licznik . '\');" onmouseout="ukryjt(\'helpTextfedex' . $licznik . '\');"><span class="helpText" id="helpTextfedex' . $licznik . '" style="visibility:hidden;">Livraison gratuite avec Fedex en 7 à 9 jours ouvrés (non compatible avec les délais Rush, et Relais colis).</span></span></span>
                                <span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="tnt' . $licznik . '" name="tnt[]" value="" onclick=" TNTClick(' . $licznik . '); " /><label class="form-label-left" id="label_tnt' . $licznik . '" for="tnt' . $licznik . '">Livraison avec TNT</label><span class="helpButton" onmouseover="pokazt(\'helpTexttnt' . $licznik . '\');" onmouseout="ukryjt(\'helpTexttnt' . $licznik . '\');"><span class="helpText" id="helpTexttnt' . $licznik . '" style="visibility:hidden;">Livraison payante avec TNT en 6 à 8 jours ouvrés(non compatible pour un colis hors-norme*)</span></span></span>
		</div>
		</td>
		<td class="righttd">
		<div class="plvmakcon">
			<div class="plvmak"><input type="radio" name="projectmak" value="fb" /> France banderole crée la maquette</div>
			<div class="plvmak1"><input type="radio" name="projectmak" value="us" checked="checked" /> j’ai déjà crée la maquette</div>
		</div>
		<div class="pilosc"><b>Quantite:</b><input type="text" name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" /></div>
		<input type="hidden" name="isplv" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_sub">Ajouter</button>
		</td></tr></form>';
	endforeach;

	$view .= '</table>';

	return $view;
}


function Change() {
				if (document.getElementById("fb").checked) {
				'document.getElementById("madiv").style.display="block"';
				}
				else {
				'document.getElementById("madiv").style.display="none"';
				}
				if (document.getElementById("us").checked) {
				'document.getElementById("madiv").style.display="none"';
				}
			}


function get_buralistes() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_buraliste";

	//$view .= '<h1>Buraliste</h1><hr />';
	//$view .= '<img src="http://www.france-banderole.com/wp-content/uploads/shopfiles/buraliste/slide.jpg"/>';


	//$view .= '<table id="promotions_table" cellspacing="0">';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC LIMIT 50", ARRAY_A);
	$licznik = 0;

	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';
		$change ='';

		//print_r($p[photo]);

		//print_r($p);
		if($p[ruban_couleur]!="" && $p[ruban_texte]!=""){
			$ruban_decla = '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('stylesheet_directory').'/ruban/css/3d-corner-ribbons.css" />';
			$ruban = '
			<div class="ribbon '.$p[ruban_couleur].'">
			    <div class="banner">
			        <div class="text">'.$p[ruban_texte].'</div>
			    </div>
			</div>
			';
		}else{
			$ruban_decla = '';
			$ruban = "";
		}




		if ($p[photo]) {
			$viewmini1 = '<a rel="shadowbox" width="100%" href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/'.$p[photo].'" alt="'.$p[name].'" width="309px" height="225px;" /></a>';
		}


		if ($p[photo_mini]) {
				$viewmini2 = '<a rel="shadowbox" width="100%" href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/'.$p[photo_mini].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/'.$p[photo_mini].'" alt="'.$p[name].'" width="309px" height="225px;" /></a>';
		}

		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}

		$view .= '

				'.$ruban_decla.'


		<div class="m-row">

		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/buralistes/" method="post" onsubmit="return czyilosc('.$licznik.')">
		<div class="m-lft">
			<h1>'.$p[name].'</h1><p>'.$subtitle.stripslashes($p[description]).'</p>

			<div class="m-img-area" style="position:relative;">
							'.$ruban.'

				<div class="m-img-lft">
				'.$viewmini1.'</div>
				<div class="m-img-rgt">'.$viewmini2.'</div>
				<div class="cb"></div>
			</div>
		</div>
		<div class="m-rgt">
			<h2><span>'.$n_price.'</span><br>frais de port inclus</h2>'.(($p[reduc]!=""&& $p[reduc]>0)?"<h3> ".$p[reduc]."€ d&rsquo;économie*</h3>":"").'
			<div class="choice">
				<h4>Je choisis :</h4>

				<input type="hidden" name="addtocart3" value="addtocart3" />
				<input type="hidden" name="rodzaj" value="'.$p[name].'" />

				<td class="rightburaliste">
				<div class="buralistemakcon">
					<div class="buralistemak">
					<input type="radio" name="projectmak" value="us" checked="checked" id="us" /> <span>Visuel ci-contre</span>
					</div>
					<div class="buralistemak1" >
						<input type="radio" name="projectmak" value="fb" id="fb" /> <span>Créer votre visuel <span id="madiv'.$licznik.'" style="display:inline-block;">(+27,50 € HT)</span></span>
						<br><p>Modification du visuel ou création d’un visuel. Un téléconseiller vous contactera sous 72H max</p>
					</div>

				</div>


				<div class="pilosc"><b>Quantité :</b>
					<select name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>

				</div>
				<input type="hidden" name="isburaliste" value="true" />
				<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.strip_shortcodes($p[description]).'" />
				<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
				<input type="submit" class="prom_sub2" value="Ajouter au panier"></input>


				</form><div class="cb"></div>';

				/*$view .= '<form action="'.get_bloginfo("url").'/votre-panier/" method="post">
				<div class="final">
				<p><a href="/votre-panier/" title="Finaliser votre commande" style="color: #be1700;font-size: 14px;" /><img src="'.get_template_directory_uri().'/img/play.png">Finaliser la commande</a></p>
				</div>

			</div>
		</div>
		<div class="cb"></div></div>';*/

				$view .= '<div class="final">
				<p><a href="/votre-panier/" title="Finaliser votre commande" style="color: #be1700;font-size: 14px;" /><img src="'.get_template_directory_uri().'/img/play.png">Finaliser la commande</a></p>
				</div>

			</div>
		</div>
		<div class="cb"></div></div>';





	endforeach;

	//$view .= '</table>';

	return $view;
}




function get_buraliste() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_buraliste";

	$view .= '<h1>Buraliste</h1><hr />';
	$view .= '<img src="//www.france-banderole.com/wp-content/uploads/shopfiles/buraliste/slide.jpg"/>';


	$view .= '<table id="promotions_table" cellspacing="0">';

	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';
		$change ='';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a rel="shadowbox" width="75%" href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/buraliste/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}

		$view .= '

		<tr><td class="lefttd"><form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/buraliste/" method="post" onsubmit="return czyilosc('.$licznik.')"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>
		<td class="imgburaliste">'.$viewmini.'<span class="prom_price2">Avec visuel ci-contre : '.$n_price.' HT (frais de port inclus)</span></td>

		<input type="hidden" name="addtocart3" value="addtocart3" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />

		<td class="rightburaliste">
		<div class="buralistemakcon">
			<div class="buralistemak"><input type="radio" name="projectmak" value="us" checked="checked" onclick="Change()" id="us" /> Visuel ci-contre</div>
			<div class="buralistemak1" ><input type="radio" name="projectmak" value="fb" onclick="Change()" id="fb" /> Créer votre Visuel</div>
			<div id="madiv"  style="display:none"><p>+ 27,50€</p></div>
			<script type="text/javascript">
Change()
</script>

		</div>

		<div class="pilosc"><b>Quantite:</b><input type="text" name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" /></div>
		<input type="hidden" name="isburaliste" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_sub2">Ajouter</button>
		</form>';
		$view .= '<form action="'.get_bloginfo("url").'/votre-panier/" method="post">
		<button type="submit" class="prom_sub3">voir panier</button></td></tr></form>';
	endforeach;

	$view .= '</table>';

	return $view;
}




function get_acc() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>Promotions kit banderole publicitaire et mini banderole</h1><hr />';
	/* $view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>'; */
	$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/facc.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">PROMOTIONS</span><br />Les offres promotionnelles présentées ont été étudiées pour répondre à vos besoins de communication à petite et grande échelle. Nous avons selectionnés les produits correspondants aux demandes récurrentes de nos clients dans le meilleur rapport qualité/prix. toutes les offres sont entendues : imprimées quadri recto.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
		<script type="text/javascript">
		function rushcheckbox24($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush72.checked == true) {
				rush72.checked = false;
			}
		}
		function rushcheckbox72($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush24.checked == true) {
				rush24.checked = false;
			}
		}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}
		$view .= '<tr><td class="lefttd2"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>
		<td class="imgtd">'.$viewmini.'<span class="prom_price">Tarif : '.$n_price.'</span></td>
		<td class="righttd2">
		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')">
		<input type="hidden" name="addtocart2" value="addtocart2" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />

		<div class="pilosc2"><b>Quantite:</b>
		<select name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" size="1">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
		</div>
		<input type="hidden" name="isplv" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_sub2">Ajouter au panier</button>
		</form></td></tr>';

		endforeach;

	$view .= '</table>';

	return $view;
}

function get_mma() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_mma";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>Banderole MMA</h1><hr />';
	/* $view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>'; */
	/*$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/facc.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">PROMOTIONS</span><br />Les offres promotionnelles présentées ont été étudiées pour répondre à vos besoins de communication à petite et grande échelle. Nous avons selectionnés les produits correspondants aux demandes récurrentes de nos clients dans le meilleur rapport qualité/prix. toutes les offres sont entendues : imprimées quadri recto.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';*/

	$view .= '<table id="promotions_tablemma" cellspacing="0">';
	$view .= '
		<script type="text/javascript">
		function rushcheckbox24($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush72.checked == true) {
				rush72.checked = false;
			}
		}
		function rushcheckbox72($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush24.checked == true) {
				rush24.checked = false;
			}
		}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC LIMIT 50", ARRAY_A);
	$licznik = 0;
	$compteur = 0;
	/* $promotions = explode(' ', $p[name]); */
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/mma/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/mma/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/mma/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}

    	if(ereg('200x70',$p[name])) { $style = 'background-color:#cbd0d9';}
		if(ereg('300x80',$p[name])) { $style = 'background-color:#e1e8f2'; }
		if(ereg('500x100',$p[name])) { $style = 'background-color:#cbd0d9';}
		if(ereg('85x308',$p[name])) { $style = 'background-color:#e1e8f2'; }
		if(ereg('85x351',$p[name])) { $style = 'background-color:#cbd0d9';}
		if(ereg('A4',$p[name])) { $style = 'background-color:#e1e8f2'; }
		if(ereg('80x200',$p[name])) { $style = 'background-color:#cbd0d9';}


		if (($n_price == 22.00) || ($n_price == 17.00) || (($p[name] == 'Banderole 440g/m² <br/><i> 300x80</i>') && ($n_price == 33.00)) || (($p[name] == 'Kakémono <br/><i> 80x200</i> ') && ($n_price == 50.00)) || (($p[name] == 'Oriflamme aile d\'avion <br/><i> 85x308</i> ') && ($n_price == 93.00))  || (($p[name] == 'Banderole 550g/m²<br/><i> 200x70</i> ') && ($n_price == 33.00))|| ($n_price == 62.00)|| ($n_price == 46.00)  || ($n_price == 115.00) || ($n_price == 105.00) || ($n_price == 130.00) || ($n_price == 154.00) || ($n_price == 139.00) || ($n_price == 85.00) || ($n_price == 24.00) || ($n_price == 73.00) || ($n_price == 46.00) || ($n_price == 38.00) ) {
		$view .= '<tr style="float:left; margin-right:5px; margin-left:5px"><td style="'.$style.'" class="lefttdmma"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>

		<td style="'.$style.'" class="righttdmma">
		<div class="imgtdmma">'.$viewmini.'<span class="prom_pricemma">Tarif : '.$n_price.'</span></div>
		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/mma/" method="post" onsubmit="return czyilosc('.$licznik.')">
		<input type="hidden" name="addtocartmma" value="addtocartmma" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />
		<div class="piloscmma"><b>Quantite:</b>
		<select name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" size="1">
  <option value="1">1</option>
</select>
		</div>
		<input type="hidden" name="isplv" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_submma">Ajouter au panier</button>
		<div><a href="/votre-panier/" title="Finaliser votre commande" class="prom_submma2" /></a></p>
		</form></td>
		</tr>

		';
		}

		if (($n_price == 16.00) || ($n_price == 25.00) || ($n_price == 15.00) || ($n_price == 78.00) || ($n_price == 47.00) || ($n_price == 116.00) || ($n_price == 140.00) || ($n_price == 102.00) || ($n_price == 125.00) ||  ($n_price == 68.00) || ($n_price == 28.00) || ($n_price == 41.00) || ($n_price == 78.00) || ($n_price == 20.00) || ($n_price == 41.00) || (($p[name] == 'Banderole 550g/m² <br/><i> 300x80</i> ') && ($n_price == 33.00)) || (($p[name] == 'Banderole 440g/m² <br/><i> 500x100</i> ') && ($n_price == 50.00)) || (($p[name] == 'Oriflamme aile d\'avion <br/><i> 85x351</i> ') && ($n_price == 93.00)) ) {
		$view .= '<tr style="float:left; margin-right:5px; margin-left:5px"><td style="'.$style.'" class="lefttdmma"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>
		<td style="'.$style.'" class="righttdmma">
		<div class="imgtdmma">'.$viewmini.'<span class="prom_pricemma">Tarif : '.$n_price.'</span></div>
		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/mma/" method="post" onsubmit="return czyilosc('.$licznik.')">
		<input type="hidden" name="addtocartmma" value="addtocartmma" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />
		<div class="piloscmma"><b>Quantite:</b>
		<select name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" size="1">
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
		</div>
		<input type="hidden" name="mma" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_submma">Ajouter au panier</button>
		<div style="display:none">
  		<input name="colis[]" type="checkbox" class="form-checkbox" id="colis" onchange="JKakemono.czyscpola(); " value="" checked="checked" />
		</div>
		<div><a href="/votre-panier/" title="Finaliser votre commande" class="prom_submma2" /></a></p>
		</form></td></tr>';
		}


		endforeach;


	$view .= '</table>';



	return $view;

}


function get_acc2() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc2";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>Promotions kit banderole publicitaire et mini banderole</h1><hr />';
	$view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>';
	$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/facc.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">PROMOTIONS</span><br />Les offres promotionnelles présentées ont été étudiées pour répondre à vos besoins de communication à petite et grande échelle. Nous avons selectionnés les produits correspondants aux demandes récurrentes de nos clients dans le meilleur rapport qualité/prix. toutes les offres sont entendues : imprimées quadri recto.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
		<script type="text/javascript">
		function rushcheckbox24($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush72.checked == true) {
				rush72.checked = false;
			}
		}
		function rushcheckbox72($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush24.checked == true) {
				rush24.checked = false;
			}
		}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc2/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc2/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc2/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}
		$view .= '<tr><td class="lefttd2"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>
		<td class="imgtd">'.$viewmini.'<span class="prom_price">Tarif : '.$n_price.'</span></td>
		<td class="righttd2">
		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')">
		<input type="hidden" name="addtocart2" value="addtocart2" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />

		<div class="pilosc2"><b>Quantite:</b>
		<select name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" size="1">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
		</div>
		<input type="hidden" name="isplv" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_sub2">Ajouter au panier</button>
		</form></td></tr>';

		endforeach;

	$view .= '</table>';

	return $view;
}


/* function get_acc() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_acc";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';
	$view .= '<h1>Promotions kit banderole publicitaire et mini banderole</h1><hr />';
	$view .= '<div id="top_images">
	<img src="'.$plugin_url.'images/slidebaner.jpg" alt=""  style="position:absolute;top:0;left:0;cursor:pointer;" />
	<div id="banercursor" style="position:absolute;left:0;top:0;width:706px;height:97px;cursor:pointer;z-index:10;"></div>
	<div id="bannercontainer">
		<div id="banner">
    	    <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a>
    	</div>
	</div></div>';
	$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/facc.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">PROMOTIONS</span><br />Les offres promotionnelles présentées ont été étudiées pour répondre à vos besoins de communication à petite et grande échelle. Nous avons selectionnés les produits correspondants aux demandes récurrentes de nos clients dans le meilleur rapport qualité/prix. toutes les offres sont entendues : imprimées quadri recto.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';

	$view .= '<table id="promotions_table" cellspacing="0">';
	$view .= '
		<script type="text/javascript">
		function rushcheckbox24($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush72.checked == true) {
				rush72.checked = false;
			}
		}
		function rushcheckbox72($type) {
			var rush24 = document.getElementById("rush24"+$type);
			var rush72 = document.getElementById("rush72"+$type);
			if (rush24.checked == true) {
				rush24.checked = false;
			}
		}
		</script>
	';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo` ORDER BY `order` ASC", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo_mini]) {
			if ($p[photo]) {
				$viewmini = '<a href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/'.$p[photo].'" target="_blank"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
			} else {
				$viewmini = '<img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/acc/mini/'.$p[photo_mini].'" alt="'.$p[name].'" />';
			}
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}
		$view .= '<tr><td class="lefttd"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.stripslashes($subtitle.$p[description]).'</span></td>
		<td class="imgtd">'.$viewmini.'<span class="prom_price">a partir de '.$n_price.'</span></td>
		<td class="optionstd">
		<span>OPTIONS:</span>
		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post" onsubmit="return czyilosc('.$licznik.')">
		<input type="hidden" name="addtocart2" value="addtocart2" />
		<input type="hidden" name="rodzaj" value="'.$p[name].'" />
		<div class="plvoptions">
			<span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush24'.$licznik.'" name="rush24" value="1" onchange="rushcheckbox24('.$licznik.');" /><label class="form-label-left" id="label_rush24'.$licznik.'" for="rush24'.$licznik.'">Délai Rush 24/48H</label><span class="helpButton" onmouseover="pokazt(\'helpTextRush24'.$licznik.'\');" onmouseout="ukryjt(\'helpTextRush24'.$licznik.'\');"><span class="helpText" id="helpTextRush24'.$licznik.'" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré le lendemain ou surlendemain avant 13h00 par TNT Express à l’adresse indiquée par le client.</span></span></span>
			<span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="rush72'.$licznik.'" name="rush72" value="1" onchange="rushcheckbox72('.$licznik.');" /><label class="form-label-left" id="label_rush72'.$licznik.'" for="rush72'.$licznik.'">Délai Rush 72H</label><span class="helpButton" onmouseover="pokazt(\'helpTextrush72'.$licznik.'\');" onmouseout="ukryjt(\'helpTextrush72'.$licznik.'\');"><span class="helpText" id="helpTextrush72'.$licznik.'" style="visibility:hidden;">Pour toute commande passée et réglée avant midi du lundi au jeudi, le colis sera livré 72H après par TNT Express à l’adresse indiquée par le client.</span></span></span>
			<span class="plvoptionsingle"><input type="checkbox" class="form-checkbox" id="relais'.$licznik.'" name="relais" value="1" /><label class="form-label-left" id="label_relais'.$licznik.'" for="relais'.$licznik.'">Dépot en relais colis</label><span class="helpButton" onmouseover="pokazt(\'helpTextrelais'.$licznik.'\');" onmouseout="ukryjt(\'helpTextrelais'.$licznik.'\');"><span class="helpText" id="helpTextrelais'.$licznik.'" style="visibility:hidden;">Vous ne souhaitez pas être livré à une adresse professionnelle ou personnelle. Votre commande sera déposée dans le relais colis le plus proche de l adresse souhaitée. Vous serez informé du nom et de l adresse du point de dépot dans votre accès client la veille de l expedition.</span></span></span>
		</div>
		</td>
		<td class="righttd">
		<div class="plvmakcon">
			<div class="plvmak"><input type="radio" name="projectmak" value="fb" /> France banderole crée la maquette</div>
			<div class="plvmak1"><input type="radio" name="projectmak" value="us" checked="checked" /> j’ai déjà crée la maquette</div>
		</div>
		<div class="pilosc"><b>Quantite:</b><input type="text" name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" /></div>
		<input type="hidden" name="isplv" value="true" />
		<input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" />
		<input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" />
		<button type="submit" class="prom_sub">Ajouter</button>
		</form></td></tr>';

		endforeach;

	$view .= '</table>';

	return $view;
} */
function get_promotions() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_promo = $prefix."fbs_promo";
	$plugin_url = get_bloginfo("url").'/wp-content/plugins/fbshop/';

	$view .= '<h1>Nos Promotions</h1><hr />';
	$view .= '<div id="top_info"><img class="alignleft" src="'.$plugin_url.'images/f8.jpg" alt="" /><div id="top_info_info2"><span class="info_nag">Nos Promotions</span><br />Vous trouverez ci-dessous des promotions exceptionnelles étudiées pour le marketing en milieu urbain et évenementiels.</div><div id="top_slideshow">'.get_another_images($pageid).'</div></div>';
	$view .= '<table id="promotions_table" cellspacing="0">';
	$promotions = $wpdb->get_results("SELECT * FROM `$fb_tablename_promo`", ARRAY_A);
	$licznik = 0;
	foreach ($promotions as $p) :
		$licznik++;
		$n_price = str_replace('.', ',',  number_format($p[price], 2)).' &euro;';
		$n_ceddre = str_replace('.', ',', $p[ceddre]).' &euro;';
		$viewmini = '';
		$cedd = '';
		$subtitle = '';
		$sname = '';

		if ($p[photo]) {
			$viewmini = '<a rel="shadowbox" href="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/promotions/'.$p[photo].'"><img src="'.get_bloginfo("url").'/wp-content/uploads/shopfiles/promotions/mini/'.$p[photo_mini].'" alt="'.$p[name].'" /></a>';
		}
		if ($p[ceddre] != '') {
			$cedd = '<div class="prom_box"><label class="prom_box_label">RECYCLER LES BACHES</label><input class="prom_box_box" type="checkbox" name="ceddre" value="'.$p[ceddre].'" /></div>';
		}
		if ($p[subname] != '') {
			$p[subname] = str_replace('"', '&ldquo;', $p[subname]);
			$subtitle = '<span class="subtitle">'.$p[subname].'<br /></span>';
			$sname = $p[subname].'<br />';
		}
		$view .= '<tr><td class="lefttd"><span class="prom_title"><b>'.$p[name].'</b></span><br /><span id="desc'.$licznik.'" class="prom_therest">'.$subtitle.$p[description].'</span></td><td><span class="prom_price">'.$n_price.'</span></td><td class="imgtd">'.$viewmini.'</td><td class="righttd">

		<form name="cart_form'.$licznik.'" class="prom_form" action="'.get_bloginfo("url").'/votre-panier/" method="post"><input type="hidden" name="addtocart2" value="addtocart2" /><input type="hidden" name="rodzaj" value="'.$p[name].'" /><b>quantite:</b><input type="text" name="ilosc" id="nummo'.$licznik.'" class="inp_ilosc" value="" /><input type="hidden" name="opis1" value="'.$p[subname].'" /><input type="hidden" name="opis2" value="'.$p[description].'" /><input type="hidden" name="prix" value="'.$p[price].'" />'.$cedd.'<input type="hidden" name="transport" value="'.$p[frais].' &euro;" /><button type="submit" class="prom_sub" onclick="if (czyilosc('.$licznik.')) {return true;} return false;">Ajouter</button></form></td></tr>';
	endforeach;

	$view .= '</table>';

	return $view;
}

function get_valider_bat() {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$fb_tablename_users = $prefix."fbs_users";
	$fb_tablename_order = $prefix."fbs_order";
	$fb_tablename_catprods = $prefix."fbs_catprods";
	$fb_tablename_topic = $prefix."fbs_topic";
	$fb_tablename_comments = $prefix."fbs_comments";
	$fb_tablename_users_cf = $prefix."fbs_users_cf";

	$order_id = $_GET['uid'];



	if(isset($_GET['accepte'])) {
	//On enregistre le message

	$mess_obj = $wpdb->get_row("SELECT * FROM `$fb_tablename_topic` WHERE id = 56");
	$sujet = $mess_obj->topic;
	$message = $mess_obj->content;
	$date = date('Y-m-d H:i:s');
	$user = $_SESSION['loggeduser'];
	$user_name = $user->f_name;

	$order_data = $wpdb->get_row("SELECT * FROM `$fb_tablename_order` WHERE unique_id = '$order_id'");
	$user_type = $wpdb->get_row("SELECT * FROM `$fb_tablename_users_cf` WHERE uid = '".$user->id."' AND att_name = 'client_type' AND att_value = 'grand compte'");

	$wpdb->query("INSERT INTO `$fb_tablename_comments` VALUES (not null, '".$order_id."', '".$sujet."', '".$date."', '".$user_name."', '".$message."')");

	//Selon le statut de la commande ou le type d'utilisateur, on redirige soit sur la page de paiement, soit sur la page de récapitulatif de commande
	if (($user_type) OR ($order_data->status == 2) OR ($order_data->status == 7)) {
		echo '<script type="text/javascript">
				window.location.replace("'.get_bloginfo("url").'/vos-devis/?detail='.$order_id.'");
			</script>';
	} else {
		echo '<script type="text/javascript">
				window.location.replace("'.get_bloginfo("url").'/paiement/?pay='.$order_id.'");
			</script>';
	}



	}



	$view .= '<h1>Validation de mon BAT - Commande n°'.$order_id.'</h1>';
	$view .= '<div id="valid_bat">';
	$view .= '<div id="valid_bat_left"><div id="valid_bat_left_tit">Valider mon BAT</div>
	<div id="valid_bat_left_con"><form method="post"><input type="checkbox" name="accepte" id="bat_confirm" /><label for="accepte" class="checkbox2">En cochant cette case, je reconnais avoir visualisé mon ou mes BAT et demande le lancement de la production</label><button id="suivant_reg" type="submit">Suivant</button></form></div>
	</div></div>';

}

function get_affiches_form() {
    $form = file_get_contents(getTplPath('affiches.php'));
    return $form;
}

function get_akilux3mm_form() {
    $form = file_get_contents(getTplPath('akilux3mm.php'));
    return $form;
}
function get_akilux3_5mm_form() {
    $form = file_get_contents(getTplPath('akilux3_5mm.php'));
    return $form;
}
function get_akilux5mm_form() {
    $form = file_get_contents(getTplPath('akilux5mm.php'));
    return $form;
}
function get_akilux10mm_form() {
    $form = file_get_contents(getTplPath('akilux10mm.php'));
    return $form;
}

function get_PVC300microns_form() {
    $form = file_get_contents(getTplPath('PVC300microns.php'));
    return $form;
}

function get_forex1mm_form() {
    $form = file_get_contents(getTplPath('forex1mm.php'));
    return $form;
}

function get_forex3mm_form() {
    $form = file_get_contents(getTplPath('forex3mm.php'));
    return $form;
}

function get_forex5mm_form() {
    $form = file_get_contents(getTplPath('forex5mm.php'));
    return $form;
}

function get_dibond_form() {
    $form = file_get_contents(getTplPath('dibond.php'));
    return $form;
}

function get_banderoles_form() {
    $form = file_get_contents(getTplPath('banderoles.php'));
    return $form;
}

function get_cadre_form() {
    $form = file_get_contents(getTplPath('cadres.php'));
    return $form;
}

function get_cartes_form() {
    $form = file_get_contents(getTplPath('cartes.php'));
    return $form;
}

function get_depliants_form() {
    $form = file_get_contents(getTplPath('depliants.php'));
    return $form;
}

function get_eclairage_form() {
    $form = file_get_contents(getTplPath('eclairages.php'));
    return $form;
}

function get_enseignes_form() {
    $form = file_get_contents(getTplPath('enseignes.php'));
    return $form;
}

function get_flyers_form() {
    $form = file_get_contents(getTplPath('flyers.php'));
    return $form;
}

function get_kakemonos_form() {
    $form = file_get_contents(getTplPath('kakemonos.php'));
    return $form;
}

function get_construction_form() {
    $form = file_get_contents(getTplPath('construction.php'));
    return $form;
}

function get_totem_form() {
    $form = file_get_contents(getTplPath('totem.php'));
    return $form;
}


function get_parapluie_form() {
    $form = file_get_contents(getTplPath('parapluie.php'));
    return $form;
}

function get_stickers_form() {
    $form = file_get_contents(getTplPath('stickers.php'));
    return $form;
}

function get_sticker_predecoupe_form() {
    $form = file_get_contents(getTplPath('sticker-predecoupe.php'));
    return $form;
}

function get_sticker_lettrage_predecoupe_form() {
    $form = file_get_contents(getTplPath('sticker-lettrage-predecoupe.php'));
    return $form;
}


function get_autocollant_form() {
    $form = file_get_contents(getTplPath('autocollant.php'));
    return $form;
}

function get_vitrophanie_form() {
    $form = file_get_contents(getTplPath('vitrophanie.php'));
    return $form;
}

function get_rollup_form() {
    $form = file_get_contents(getTplPath('roll-up.php'));
    return $form;
}

function get_oriflammes_form() {
	$form = file_get_contents(getTplPath('oriflammes.php'));
	return $form;
}


?>