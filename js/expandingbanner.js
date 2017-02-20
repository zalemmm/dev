function initBanner(){
	var j = jQuery.noConflict();
	var timeout;
	j("#bannercontainer").css("display", "none");
	j("#bannercontainer #banner").css("cursor", "pointer");
	j("#bannercontainer").css("z-index", "1");
	j("#bannercontainer").css("position", "absolute");
	j("#bannercontainer").addClass("widocznyporazpierwszy");

	j("#top_images").each(function () {
 			j("#bannercontainer").slideToggle("normal", function() {
				j("#bannercontainer").addClass("widoczny");
				if (j("#bannercontainer").hasClass("widocznyporazpierwszy")) {
					timeout = setTimeout(function(){ 
						j("#top_images").click();
					}, 13000);
				}
			});
	});

	j("#top_images").click(function () {
		if (j("#bannercontainer").hasClass("widoczny")) {
 			j("#bannercontainer").slideToggle("1000", function() {
				j("#banercursor").hide();
				j("#bannercontainer").removeClass("widoczny");
				if (j("#bannercontainer").hasClass("widocznyporazpierwszy")) {
					j("#bannercontainer").html("<img src='http://"+document.location.host+"/wp-content/plugins/fbshop/images/banerimage.jpg' alt='' />");
				}
				j("#bannercontainer").removeClass("widocznyporazpierwszy");
 				clearTimeout(timeout);
			});
		} else {
 			j("#bannercontainer").slideToggle("normal", function() {
				j("#banercursor").show();
				j("#bannercontainer").addClass("widoczny");
			});
		}
	});
  
}