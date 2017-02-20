	jQuery("#rafir a.one-star").click(function() {jQuery("#rafir li.current-rating").css("width", "20px"); jQuery("#ratin1").val("1"); return false;});
	jQuery("#rafir a.two-stars").click(function() {jQuery("#rafir li.current-rating").css("width", "40px"); jQuery("#ratin1").val("2"); return false;});
	jQuery("#rafir a.three-stars").click(function() {jQuery("#rafir li.current-rating").css("width", "60px"); jQuery("#ratin1").val("3"); return false;});
	jQuery("#rafir a.four-stars").click(function() {jQuery("#rafir li.current-rating").css("width", "80px"); jQuery("#ratin1").val("4"); return false;});
	jQuery("#rafir a.five-stars").click(function() {jQuery("#rafir li.current-rating").css("width", "100px"); jQuery("#ratin1").val("5"); return false;});

	jQuery("#rasec a.one-star").click(function() {jQuery("#rasec li.current-rating").css("width", "20px"); jQuery("#ratin2").val("1"); return false;});
	jQuery("#rasec a.two-stars").click(function() {jQuery("#rasec li.current-rating").css("width", "40px"); jQuery("#ratin2").val("2"); return false;});
	jQuery("#rasec a.three-stars").click(function() {jQuery("#rasec li.current-rating").css("width", "60px"); jQuery("#ratin2").val("3"); return false;});
	jQuery("#rasec a.four-stars").click(function() {jQuery("#rasec li.current-rating").css("width", "80px"); jQuery("#ratin2").val("4"); return false;});
	jQuery("#rasec a.five-stars").click(function() {jQuery("#rasec li.current-rating").css("width", "100px"); jQuery("#ratin2").val("5"); return false;});

	jQuery("#rathr a.one-star").click(function() {jQuery("#rathr li.current-rating").css("width", "20px"); jQuery("#ratin3").val("1"); return false;});
	jQuery("#rathr a.two-stars").click(function() {jQuery("#rathr li.current-rating").css("width", "40px"); jQuery("#ratin3").val("2"); return false;});
	jQuery("#rathr a.three-stars").click(function() {jQuery("#rathr li.current-rating").css("width", "60px"); jQuery("#ratin3").val("3"); return false;});
	jQuery("#rathr a.four-stars").click(function() {jQuery("#rathr li.current-rating").css("width", "80px"); jQuery("#ratin3").val("4"); return false;});
	jQuery("#rathr a.five-stars").click(function() {jQuery("#rathr li.current-rating").css("width", "100px"); jQuery("#ratin3").val("5"); return false;});
function validaterating() {
	jQuery("#raele1").css("border","1px solid #e1e8f2");
	jQuery("#raele2").css("border","1px solid #e1e8f2");
	jQuery("#raele3").css("border","1px solid #e1e8f2");
	jQuery("#textarearating").css("border","1px solid #afb9c7");
	var blad = 0;
	if (jQuery("#ratin1").val() == "0") {
		jQuery("#raele1").css("border","1px solid red");
		blad = 1;
	}
	if (jQuery("#ratin2").val() == "0") {
		jQuery("#raele2").css("border","1px solid red");
		blad = 1;
	}
	if (jQuery("#ratin3").val() == "0") {
		jQuery("#raele3").css("border","1px solid red");
		blad = 1;
	}
	if (jQuery("#textarearating").val() == "") {
		jQuery("#textarearating").css("border","1px solid red");
		blad = 1;
	}
	if (blad == 1) {
		jQuery(".form-error-message-rating").css("display","block");
		return false;
	}
}