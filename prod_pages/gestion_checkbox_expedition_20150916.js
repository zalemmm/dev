// JavaScript Document
    jQuery(function() {
        jQuery('#fedex').click(function() {
            if (document.getElementById('fedex').checked) {
	            if(document.getElementById('tnt')){document.getElementById('tnt').checked = false;}
                if(document.getElementById('rush24')){document.getElementById('rush24').checked = false;}
                if(document.getElementById('rush72')){document.getElementById('rush72').checked = false;}
                if(document.getElementById('relais')){document.getElementById('relais').checked = false;}
                if(document.getElementById('colis')){document.getElementById('colis').checked = false;}
                if(document.getElementById('etiquette')){document.getElementById('etiquette').checked = false;}
            }
        });        
        jQuery('#tnt').click(function() {
            if (document.getElementById('tnt').checked) {
                document.getElementById('fedex').checked = false;
            }else{
	            if(document.getElementById('tnt')){document.getElementById('tnt').checked = false;}
                if(document.getElementById('rush24')){document.getElementById('rush24').checked = false;}
                if(document.getElementById('rush72')){document.getElementById('rush72').checked = false;}
                if(document.getElementById('relais')){document.getElementById('relais').checked = false;}
                if(document.getElementById('colis')){document.getElementById('colis').checked = false;}
                if(document.getElementById('etiquette')){document.getElementById('etiquette').checked = false;}				
			}
        });   		            
        jQuery('#relais, #rush24, #rush72','#colis').change(function() {
            if (document.getElementById('colis').checked == true || document.getElementById('relais').checked == true || document.getElementById('rush24').checked == true || document.getElementById('rush72').checked == true) {
                document.getElementById('fedex').checked = false;
                document.getElementById('tnt').checked = true;
            } else {
                document.getElementById('fedex').checked = true;
                document.getElementById('tnt').checked = false;				
            }
            return false;
        });
    });
	