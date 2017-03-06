/*
 * jQuery File Upload Plugin JS Example 7.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function () {
    'use strict';
    // Initialize the jQuery File Upload widget:
//	var folder = '/uploaded/'+$("#cmdID").val()+'';
//	alert(folder);

//	testTbody();
//	$("#fbcart_fileupload3 .files").change(function() {
//		alert();
//	});

    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/uploaded/'
    });

	var hoss = 'http://'+document.location.host+'/wp-content/plugins/fbshop/js/juploader/';
    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        hoss.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    // Load existing files:
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        //$.getJSON($('#file_upload').fileUploadUIX('option', 'url')+'?cmd='+$("#cmdID").val(),
        url: $('#fileupload').fileupload('option', 'url') + '?cmd='+$("#cmdID").val(),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).done(function (result) {
        $(this).fileupload('option', 'done').call(this, null, {result: result});
    });

    // Initialize the theme switcher:
    $('#theme-switcher').change(function () {
        var theme = $('#theme');
        theme.prop(
            'href',
            theme.prop('href').replace(
                /[\w\-]+\/jquery-ui.css/,
                $(this).val() + '/jquery-ui.css'
            )
        );
    });

	$('#fileupload').bind('fileuploaddone', callbackfunc);
	function callbackfunc(e, data) {
    	$.ajax({
            type: "POST",
	        url: "http://"+document.location.host+"/uploaded.php",
            data: "cmdId="+$("#cmdID").val(),
            success: function (response) {
            	if (response == 'ok') {
            	} else {
            		if ($("#commentArea").length > 0) {
	            		$("#commentArea").replaceWith(response);
	            	} else {
	            		$("#fbcart_lastcomment").replaceWith(response);
	            	}
            	}
            },
            error: function (response) {
//            	alert(response);
            }
    	});
	}
});
