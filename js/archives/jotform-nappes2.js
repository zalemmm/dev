/**
 * JotForm Form object
 */
JotForm = {
    /**
     * @var JotForm domain
     */
    url: "http://jotform.com/", // Will get the correct URL from this.getServerURL() method
    /**
     * @var JotForm request server location
     */
    server: "http://jotform.com/server.php", // Will get the correct URL from this.getServerURL() method
    /**
     * @var All conditions defined on the form
     */
    conditions: {},
    /**
     * @var condValues
     */
    condValues: {},
    /**
     * @var All JotForm forms on the page
     */
    forms: [],

    imageFiles: ["png", "jpg", "jpeg", "ico", "tiff", "bmp", "gif", "apng", "jp2", "jfif"],

    autoCompletes: {},
    /**
     * Find the correct server url from forms action url, if there is no form use the defaults
     */
    getServerURL: function(){
        var form = $$('.jotform-form')[0];
        if (form) {
            var action = form.readAttribute('action');
            if (action) {
                this.server = action.replace('submit.php', 'server.php');
                this.url = action.replace('submit.php', '');
            }
        }
    },

    /*--------------------------------------------------------------------------
     * Initiates the form and all actions
     */
    init: function(callback){
        var ready = function(){
            try {
                this.getServerURL();
                callback && callback();

                this.setConditionEvents();
                this.prePopulations();

                $A(document.forms).each(function(form){
                    if (form.name == "form_" + form.id || form.name == "q_form_" + form.id) {
                        this.forms.push(form);
                    }
                }.bind(this));
                this.validator();
            } catch (err) {
                 //alert(err);
            }
        }.bind(this);

        if(document.readyState == 'complete'){
            ready();
        }else{
            document.ready(ready);
        }
    },


    /*--------------------------------------------------------------------------
     * Fill fields from the get values
     */
    prePopulations: function(){
        $H(document.get).each(function(pair){
            var n = '[name*="_' + pair.key + '"]';
            var input = $$('.form-textbox%s, .form-dropdown%s, .form-textarea%s'.replace(/\%s/gim, n))[0];
            if (input) {
                input.value = pair.value;
            }
            $$('.form-checkbox%s, .form-radio%s'.replace(/\%s/gim, n)).each(function(input){

                input.checked = $A(pair.value.split(',')).include(input.value);
            });
        });
    },


    /*--------------------------------------------------------------------------
     * add the given condition to conditions array to be used in the form
     * @param {Object} qid id of the field
     * @param {Object} condition condition array
     */
    setConditions: function(conditions){
        JotForm.conditions = conditions;
    },

    /*--------------------------------------------------------------------------
     * Shows a field
     * @param {Object} field
     */
    showField: function(field){
        if($('id_'+field).visible()){
          return $('id_'+field);
        }
        return $('id_'+field).show();
    },

    /*--------------------------------------------------------------------------
     * Hides a field
     * @param {Object} field
     */
    hideField: function(field){

        $('id_'+field).select('input, select, textarea').each(function(input){
            if(input.tagName == 'INPUT' && (['checkbox', 'radio'].include(input.readAttribute('type')))){
                input.checked = false;
                JotForm.getContainer(input).run('click');
                return;
            }

            input.clear();
            input.run('keyup').run('change');
        });

        return $('id_'+field).hide();
    },

    /*--------------------------------------------------------------------------
     * Checks the fieldValue by given operator string
     * @param {Object} operator
     * @param {Object} condValue
     * @param {Object} fieldValue
     */
    checkValueByOperator: function(operator, condValue, fieldValue){
        //console.log('if "%s" %s "%s"', fieldValue, operator, condValue);
        switch (operator) {
            case "equals":
                return fieldValue == condValue;
            case "notEquals":
                return fieldValue != condValue;
            case "endsWith":
                return fieldValue.endsWith(condValue);
            case "startsWith":
                return fieldValue.startsWith(condValue);
            case "contains":
                return fieldValue.include(condValue);
            case "notContains":
                return !fieldValue.include(condValue);
            case "greaterThan":
                return (parseInt(fieldValue, 10) || 0) > (parseInt(condValue, 10) || 0);
            case "lassThan":
                return (parseInt(fieldValue, 10) || 0) < (parseInt(condValue, 10) || 0);
            case "isEmpty":
                if(Object.isBoolean(fieldValue)){ return !fieldValue; }
                return fieldValue.empty();
            case "isFilled":
                if(Object.isBoolean(fieldValue)){ return fieldValue; }
                return !fieldValue.empty();
        }
        return false;
    },

    typeCache: {},   // Cahcke the check type results for performance

    /*--------------------------------------------------------------------------
     * @param {Object} id
     */
    getInputType: function(id){
        if(JotForm.typeCache[id]){ return JotForm.typeCache[id]; }
        var type = false;
        if($('input_'+id)){
            type = $('input_'+id).nodeName.toLowerCase() == 'input'? $('input_'+id).readAttribute('type').toLowerCase() : $('input_'+id).nodeName.toLowerCase();
        }else{
            if($$('#id_'+id+' input')[0]){
                type = $$('#id_'+id+' input')[0].readAttribute('type').toLowerCase();
            }
        }
        JotForm.typeCache[id] = type;
        return type;
    },

    /*--------------------------------------------------------------------------
     * @param {Object} condition
     */
    checkCondition: function(condition){
        var any=false, all=true;

        $A(condition.terms).each(function(term){
            try{
                switch(JotForm.getInputType(term.field)){
                    case "checkbox":
                    case "radio":
                        if (['isEmpty', 'isFilled'].include(term.operator)) {
                            var filled = $$('#id_'+term.field+' input').collect(function(e){ return e.checked; }).any();

                            if(JotForm.checkValueByOperator(term.operator, term.value, filled)){
                                any = true;
                            }else{
                                all = false;
                            }

                            return; /* continue; */
                        }

                        $$('#id_'+term.field+' input').each(function(input){
                            var value = input.checked? input.value : '';

                            if(JotForm.checkValueByOperator(term.operator, term.value, value)){

                                any = true;
                            }else{
                                if (input.value == term.value) {
                                    all = false;
                                }
                            }
                        });
                    break;
                    default:
                        var value = $('input_'+term.field).value;
                        if(JotForm.checkValueByOperator(term.operator, term.value, value)){
                            any = true;
                        }else{
                            all = false;
                        }

                        // -----------------------------------Prod visualisation
                        if(JotForm.checkValueByOperator(term.operator, term.value, value)){

              						var preview_info_ul = $("preview_info_ul");
              						var podglad = $("preview");
              						if ($('input_support').value) {
              							var preview_info_title = $("preview_info_title");
              							podglad.style.visibility="visible";
              						}

                          var imag  = $("preview_imag");
                          var imag1 = $("preview_imag1");
                          var imag2 = $("preview_imag2");
                          var imag3 = $("preview_imag3");
                          var imag4 = $("preview_imag4");
                          var imag5 = $("preview_imag5");

                          if ($('input_support').value !== "") {
                            $('container').style.display="none";
                            imag2.style.backgroundImage="none";
                            imag.style.backgroundImage="url(//www.france-banderole.com/wp-content/plugins/fbshop/images/totem/int.png)";
                          }
                          if ($('input_forme').value == 'rectangulaire') {
                            imag2.style.backgroundImage="url(//www.france-banderole.com/wp-content/plugins/fbshop/images/nappe/rect.png)";
                            imag2.style.animation="anim .5s 1";
                          }
                          if ($('input_forme').value == 'ronde') {
                            imag2.style.backgroundImage="url(//www.france-banderole.com/wp-content/plugins/fbshop/images/nappe/rond.png)";
                            imag2.style.animation="anim2 .5s 1";
                          }

                        }
              //
                }
            }catch(e){
                	//console.error(e);
            }
          });

    if(condition.type == 'field'){ // Field Condition
        //console.log("any: %s, all: %s, link: %s", any, all, condition.link.toLowerCase());
        if((condition.link.toLowerCase() == 'any' && any) || (condition.link.toLowerCase() == 'all' && all)){
            if(condition.action.visibility.toLowerCase() == 'show'){
                //console.info('Correct: Show field: '+$('label_'+condition.action.field).innerHTML);
                JotForm.showField(condition.action.field);
            }else{
                //console.info('Correct: Hide field: '+$('label_'+condition.action.field).innerHTML);
                JotForm.hideField(condition.action.field);
            }
        }else{
            if(condition.action.visibility.toLowerCase() == 'show'){
                //console.info('Fail: Hide field: '+$('label_'+condition.action.field).innerHTML);
                JotForm.hideField(condition.action.field);
            }else{
                //console.info('Fail: Show field: '+$('label_'+condition.action.field).innerHTML);
                JotForm.showField(condition.action.field);
            }
        }
    }else{ // Page condition

        //console.log("any: %s, all: %s, link: %s", any, all, condition.link.toLowerCase());
        if (JotForm.nextPage) {
            return;
        }
        if((condition.link.toLowerCase() == 'any' && any) || (condition.link.toLowerCase() == 'all' && all)){

            //console.info('Correct: Skip To: '+condition.action.skipTo);
            var sections = $$('.form-section');
            if(condition.action.skipTo == 'end'){
                JotForm.nextPage = sections[sections.length - 1];
            }else{
                JotForm.nextPage = sections[parseInt(condition.action.skipTo.replace('page-', ''), 10)-1];
            }

        }else{

            //console.info('Fail: Skip To: page-'+JotForm.currentPage+1);

            JotForm.nextPage = false;
        }
    }

    },
    currentPage: false,
    nextPage: false,
    previousPage: false,
    fieldConditions: {},

    setFieldConditions: function(field, event, condition){
        if(!JotForm.fieldConditions[field]){
            JotForm.fieldConditions[field] = {
                event: event,
                conditions:[]
            };
        }
        JotForm.fieldConditions[field].conditions.push(condition);
    },

    /**
     * Sets all events and actions for form conditions
     */
    setConditionEvents: function(){
        try {
            $A(JotForm.conditions).each(function(condition){

                if (condition.type == 'field') {

                    if (condition.action.visibility.toLowerCase() == 'show') {
                        $('id_' + condition.action.field).hide();
                    } else {
                        $('id_' + condition.action.field).show();
                    }

                    // Loop through all rules
                    $A(condition.terms).each(function(term){
                        var id = term.field;

                        switch (JotForm.getInputType(id)) {
                            case "select":
                                JotForm.setFieldConditions('input_' + id, 'change', condition);
                                break;
                            case "checkbox":
                            case "radio":
                                JotForm.setFieldConditions('id_' + id, 'click', condition);
                                break;
                            default: // text, textarea
                               JotForm.setFieldConditions('input_' + id, 'keyup', condition);
                        }
                    });

                } else {
                    $A(condition.terms).each(function(term){
                        var id = term.field;
                        var nextButton = JotForm.getSection($('id_' + id)).select('.form-pagebreak-next')[0];
                        if (!nextButton) {
                            return;
                        }

                        nextButton.observe('mousedown', function(){
                            //console.warn('Checking ' + $('label_' + id).innerHTML);
                            JotForm.checkCondition(condition);
                        });
                    });
                }
            });

            $H(JotForm.fieldConditions).each(function(pair){
                var field = pair.key;
                var event = pair.value.event;
                var conds = pair.value.conditions;

                //console.log(field);
                $(field).observe(event, function(){
                    //console.log('Here');
                    $A(conds).each(function(cond){
                        // console.warn('Checking ' + $('label_' + field.replace(/.*_(\d+)/gim, '$1')).innerHTML);
                        JotForm.checkCondition(cond);
                    });
                }).run(event);
            });
        }catch(e){
        	//console.error(e);
    	}
    },
    /**
     * Calculates the payment total with quantites
     * @param {Object} prices
     */
    countTotal: function(prices){

        var total = 0;
        $H(prices).each(function(pair){
            total = parseFloat(total);
            var price = parseFloat(pair.value.price);

            if ($(pair.key).checked) {
                if ($(pair.value.quantityField)) {
                    price = price * parseInt($(pair.value.quantityField).getSelected().text, 10);
                }
                total += price;
            }

            if (total === 0) {
                total = "0.00";
            }
            if ($("payment_total")) {
                $("payment_total").update(parseFloat(total).toFixed(2));
            }
        });
    },
    /**
     * Sets the events for dynamic total calculation
     * @param {Object} prices
     */
    totalCounter: function(prices){
        $H(prices).each(function(pair){
            $(pair.key).observe('click', function(){
                JotForm.countTotal(prices);
            });
            if ($(pair.value.quantityField)) {
                $(pair.value.quantityField).observe('change', function(){
                    JotForm.countTotal(prices);
                });
            }
        });
    },
    /**
     * Initiates the capctha element
     * @param {Object} id
     */
    initCaptcha: function(id){

        new Ajax.Jsonp(JotForm.server, {
            parameters: {
                action: 'getCaptchaId'
            },
            evalJSON: 'force',
            onComplete: function(t){
                t = t.responseJSON || t;
                if (t.success) {
                    $(id + '_captcha').src = JotForm.url + 'server.php?action=getCaptchaImg&code=' + t.num;
                    $(id + '_captcha_id').value = t.num;
                }
            }
        });

    },
    /**
     * Relads a new image for captcha
     * @param {Object} id
     */
    reloadCaptcha: function(id){
        $(id + '_captcha').src = JotForm.url+'images/blank.gif';
        JotForm.initCaptcha(id);
    },
    /**
     * Zero padding for a given number
     * @param {Object} n
     * @param {Object} totalDigits
     */
    addZeros: function(n, totalDigits){
        n = n.toString();
        var pd = '';
        if (totalDigits > n.length) {
            for (i = 0; i < (totalDigits - n.length); i++) {
                pd += '0';
            }
        }
        return pd + n.toString();
    },
    /**
     * @param {Object} d
     */
    formatDate: function(d){
        var date = d.date;
        var month = JotForm.addZeros(date.getMonth() + 1, 2);
        var day = JotForm.addZeros(date.getDate(), 2);
        var year = date.getYear() < 1000 ? date.getYear() + 1900 : date.getYear();

        var hour = JotForm.addZeros(date.getHours(), 2); // May not need
        var min = JotForm.addZeros(date.getMinutes(), 2); // May not need
        var id = d.dateField.id.replace(/\w+\_/gim, '');
        $('month_' + id).value = month;
        $('day_' + id).value = day;
        $('year_' + id).value = year;
    },
    /**
     * Highlights the lines when an input is focused
     */

    /**
     * Gets the container FORM of the element
     * @param {Object} element
     */
    getForm: function(element){
        element = $(element);
        if (!element.parentNode) {
            return false;
        }
        if (element && element.tagName == "BODY") {
            return false;
        }
        if (element.tagName == "FORM") {
            return $(element);
        }
        return JotForm.getForm(element.parentNode);
    },
    /**
     * Gets the container of the input
     * @param {Object} element
     */
    getContainer: function(element){
        element = $(element);
        if (!element.parentNode) {
            return false;
        }
        if (element && element.tagName == "BODY") {
            return false;
        }
        if (element.hasClassName("form-line")) {
            return $(element);
        }
        return JotForm.getContainer(element.parentNode);
    },

    /**
     * Get the containing section the element
     * @param {Object} element
     */
    getSection: function(element){
        element = $(element);
        if (!element.parentNode) {
            return false;
        }
        if (element && element.tagName == "BODY") {
            return false;
        }
        if (element.hasClassName("form-section-closed") || element.hasClassName("form-section")) {
            return element;
        }
        return JotForm.getSection(element.parentNode);
    },
    /**
     * Get the fields collapse bar
     * @param {Object} element
     */
    getCollapseBar: function(element){
        element = $(element);
        if (!element.parentNode) {
            return false;
        }
        if (element && element.tagName == "BODY") {
            return false;
        }
        if (element.hasClassName("form-section-closed") || element.hasClassName("form-section")) {
            return element.select('.form-collapse-table')[0];
        }
        return JotForm.getCollapseBar(element.parentNode);
    },
    /**
     * Check if the input is collapsed
     * @param {Object} element
     */
    isCollapsed: function(element){
        element = $(element);
        if (!element.parentNode) {
            return false;
        }
        if (element && element.tagName == "BODY") {
            return false;
        }
        if (element.className == "form-section-closed") {
            return true;
        }
        return JotForm.isCollapsed(element.parentNode);
    },
    /**
     * Check if the input is visible
     * @param {Object} element
     */
    isVisible: function(element){
        element = $(element);
        if (!element.parentNode) {
            return false;
        }

        if (element && element.tagName == "BODY") {
            return true;
        }

        if (element.style.display == "none" || element.style.visibility == "hidden") {
            return false;
        }

        return JotForm.isVisible(element.parentNode);
    },
    /**
     * Enables back the buttons
     */
    enableButtons: function(){
        setTimeout(function(){
            $$('.form-submit-button').each(function(b){
                b.enable();
                b.innerHTML = b.oldText;
            });
        }, 60);
    },


    /**
     * Creates description boxes next to input boxes
     * @param {Object} input
     * @param {Object} message
     */
    description: function(input, message){
        // v2 has bugs, v3 has stupid solutions
        if(message == "20"){ return; } // Don't remove this or some birthday pickers will start to show 20 as description

        var lineDescription = false;
        if(!$(input)){
            var id = input.replace(/[^\d]/gim, '');
            if(!$("id_"+id)){ return; /* no element found to display a description */ }
            input = $("id_"+id);
            lineDescription = true;
        }

        var cont = JotForm.getContainer(input);

        var buble = new Element('div', {
            className: 'form-description'
        });
        var arrow = new Element('div', {
            className: 'form-description-arrow'
        });
        var arrowsmall = new Element('div', {
            className: 'form-description-arrow-small'
        });
        var content = new Element('div', {
            className: 'form-description-content'
        });
        content.insert(message);
        buble.insert(arrow).insert(arrowsmall).insert(content).hide();

        this.getContainer(input).insert(buble);

        if(lineDescription){
            $(input).hover(function(){
                cont.setStyle('z-index:10000');
                buble.show();
            }, function(){
                cont.setStyle('z-index:0');
                buble.hide();
            });

        }else{
            $(input).observe('keyup', function(){
                cont.setStyle('z-index:0');
                buble.hide();
            });

            $(input).observe('focus', function(){
                cont.setStyle('z-index:10000');
                buble.show();
            });

            $(input).observe('blur', function(){
                cont.setStyle('z-index:0');
                buble.hide();
            });
        }
    },

    /**
     * do all validations at once and stop on the first error
     * @param {Object} form
     */
    validateAll: function(form){
        var ret = true;

        $$('*[class*="validate"]').each(function(input){
            if (!(!!input.validateInput && input.validateInput())) {
                ret = false;
                throw $break; // stop at the first error
            }
        });

        return ret;
    },

    /**
     * When an input is errored
     * @param {Object} input
     * @param {Object} message
     */
    errored: function(input, message){

        input = $(input);

        if (input.errored) {
            return false;
        }

        if(input.runHint){
            input.runHint();
        }else{
            //input.select();
        }

        if (JotForm.isCollapsed(input)) {

            var collapse = JotForm.getCollapseBar(input);
            if (!collapse.errored) {
                collapse.select(".form-collapse-mid")[0].insert({
                    top: '<img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> '
                }).setStyle({
                    color: 'red'
                });
                collapse.errored = true;
            }
        }
        var container = JotForm.getContainer(input);

        input.errored = true;
        input.addClassName('form-validation-error');
        container.addClassName('form-line-error');

        container.insert(new Element('div', {
            className: 'form-error-message'
        }).insert('<img src="//www.france-banderole.com/wp-content/themes/fb/images/exclamation-octagon.png" class="exclam" alt="attention" /> ' + message));

        return false;
    },

    /**
     * When an input is corrected
     * @param {Object} input
     */
    corrected: function(input){
        JotForm.hideButtonMessage();
        input = $(input);
        input.errored = false;
        if (JotForm.isCollapsed(input)) {
            var collapse = JotForm.getCollapseBar(input);
            if (collapse.errored) {
                collapse.select(".form-collapse-mid")[0].setStyle({
                    color: ''
                }).select('img')[0].remove();
                collapse.errored = false;
            }
        }
        var container = JotForm.getContainer(input);
        container.select(".form-validation-error").invoke('removeClassName', 'form-validation-error');
        container.removeClassName('form-line-error');
        container.select('.form-error-message').invoke('remove');
        return true;
    },

    hideButtonMessage: function(){
        $$('.form-button-error').invoke('remove');
    },

    showButtonMessage: function(){
        this.hideButtonMessage();

        $$('.form-submit-button').each(function(button){
            var errorBox = new Element('div', {className:'form-button-error'});
            errorBox.insert('Il y a des champs obligatoires incomplets. Merci de remplir ces informations.');
            $(button.parentNode).insert(errorBox);
        });
    },

    /**
     * Sets all validations to forms
     */
    validator: function(){

        var reg = {
            email: /[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])/,
            alphanumeric: /^[a-zA-Z0-9]+$/,
            numeric: /^(\d+[\.\,]?)+$/,
            alphabetic: /^[a-zA-Z\s]+$/
        };


        $A(JotForm.forms).each(function(form){ // for each JotForm form on the page
            if (form.validationSet) {
                return; /* continue; */
            }

            form.validationSet = true;
            form.observe('submit', function(e){ // Set on submit validation
                try {
                    if (!JotForm.validateAll(form)) {
                        JotForm.enableButtons();
                        JotForm.showButtonMessage();
                        e.stop();
                    }
                } catch (err) {
                    //console.error(err);
                    //alert(err);
                    e.stop();
                }
            });

            // for each validation element
            $$('*[class*="validate"]').each(function(input){

                var validations = input.className.replace(/.*validate\[(.*)\].*/, '$1').split(/\s*,\s*/);

                input.validateInput = function(){

                	if ( (input.readAttribute('type') == "password") && (input.readAttribute('id')=='input_4') ){
                		var pass1 = $('input_3');
                		var pass2 = $('input_4');
                		if ($(pass1).value == $(pass2).value) {  }
                		else { return JotForm.errored(input, "Please retype password correctly!"); }
                	}

                    if (!JotForm.isVisible(input)) {
                        return true; // if it's hidden then user cannot fill this field then don't validate
                    }

                    JotForm.corrected(input); // First clean the element
                    var vals = validations;

                    if(input.hinted === true){ input.clearHint(); } // Clear hint value if exists

                    if (vals.include("required")) {

                        if (input.tagName == "INPUT" && (input.readAttribute('type') == "radio" || input.readAttribute('type') == "checkbox")) {

                            if (!$A(document.getElementsByName(input.name)).map(function(e){
                                return e.checked;
                            }).any()) {

                                return JotForm.errored(input, "Ce champ est obligatoire.");
                            }
                        } else if (input.name && input.name.include("[")) {

                            try{
                            	var test = $$('*[name=*' + input.name.replace(/\[.*$/, '') + ']');
                                if ($$('*[name=*' + input.name.replace(/\[.*$/, '') + ']').map(function(e){
                                    return !e.value.empty();
                                }).any()) {
                                    return JotForm.errored(input, "Ce champ est obligatoire.");
                                }
                            }catch(e){
                                // This can throw errors on internet explorer
                                return true;
                            }
                        }
                        if (!input.value || input.value.empty()) {

                            return JotForm.errored(input, "Ce champ est obligatoire.");
                        }

                        vals = vals.without("required");

                    } else if (input.value.empty()) {
                        // if field is not required and there is no value
                        // then skip other validations
                        return true;
                    }

                    if (!vals[0]) {
                        return true;
                    }

                    switch (vals[0]) {
                        case "Email":
                            if (!reg.email.test(input.value)) {
                                return JotForm.errored(input, "Enter a valid&thinsp;e-mail address");
                            }
                            break;
                        case "Alphabetic":
                            if (!reg.alphabetic.test(input.value)) {
                                return JotForm.errored(input, "Uniquement chiffres et lettres sans accent sans espace");
                            }
                            break;
                        case "Numeric":
                            if (!reg.numeric.test(input.value)) {
                                return JotForm.errored(input, "Chiffres uniquement");
                            }
                            break;
                        case "AlphaNumeric":
                            if (!reg.alphanumeric.test(input.value)) {
                                return JotForm.errored(input, "Uniquement chiffres et lettres");
                            }
                            break;
                        default:
                            throw ("This validation is not valid (" + vals[0] + ")");
                    }
                    return JotForm.corrected(input);
                };

                input.observe('blur', function(){
                    input.validateInput();
                });
            });

            $$('.form-upload').each(function(upload){

                try {

    	            var required = !!upload.validateInput;
                    var exVal = upload.validateInput || Prototype.K;

                    upload.validateInput = function(){
                        if (exVal() !== false) { // Make sure other validation completed

                            if(!upload.files){ return true; } // If files are not provied then don't do checks

                            var acceptString = upload.readAttribute('accept');
                            var maxsizeString = upload.readAttribute('maxsize');
                            var accept = acceptString.strip().split(/\s*\,\s*/gim);
                            var maxsize = parseInt(maxsizeString, 10) * 1024;

                            var file = upload.files[0];
                            if (!file) {
                                return true;
                            } // No file was selected
                            var ext = JotForm.getFileExtension(file.fileName);

                            if (!accept.include(ext) && !accept.include(ext.toLowerCase())) {
                                return JotForm.errored(upload, 'You can only upload following files: ' + acceptString);
                            }

                            if (file.fileSize > maxsize) {
                                return JotForm.errored(upload, 'File size cannot be bigger than: ' + maxsizeString + 'Kb');
                            }

                            return JotForm.corrected(upload);
                        }
                    };

                    if (!required) {
                        upload.addClassName('validate[upload]');
                        upload.observe('blur', upload.validateInput);
                    }
                } catch (e) {

                	//alert(e);

                }

            });





        });

    }
};
