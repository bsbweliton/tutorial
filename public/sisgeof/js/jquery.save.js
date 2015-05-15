/**
 * jQuery Plugin save
 *
 * @author Raymond Julin (raymond[dot]julin[at]gmail[dot]com)
 * @author Mads Erik Forberg (mads[at]hardware[dot]no)
 * @author Simen Graaten (simen[at]hardware[dot]no)
 * amended to cope with jQuery 1.6 or later by Simon Battersby (see http://www.simonbattersby.com/blog/using-the-jquery-save-plugin/)
 *
*/

(function($) {
	var vals = {}, form;	  
	//SB added to cope with jQuery 1.6 or later which requires the use of .prop to correctly post radio buttons 
    if (typeof $.fn.prop !== 'function')
    $.fn.prop = function(name, value){
        if (typeof value === 'undefined') {
            return this.attr(name);
        } else {
            return this.attr(name, value);
        }
    };		  
		  
    $.fn.save = function(options) {
        /**
         * Define some needed variables
         * elems is a shortcut for the selected nodes
         * nodes is another shortcut for elems later (wtf)
         * eventName will be used to set what event to connect to
         */
        var elems = $(this), nodes = $(this), eventName;		

        options = $.extend({
            grouped: false,
            send: false, // Callback
            error: false, // Callback
            success: false, // Callback
            dataType: "json" // From ajax return point
        }, options);
        
        /**
         * If the root form is used as selector
         * bind to its submit and find all its
         * input fields and bind to them
         */
        if ($(this).is('form')) {
            /* Group all inputelements in this form */
            options.grouped = true;
            elems = nodes = $(this).find(":input,button");
            // Bind to forms submit
            $.fn.save._makeRequest( nodes, options, $(this));
           
        }
        /**
         * For each element selected (typically a list of form elements
         * that may, or may not, reside in the same form
         * Build a list of these nodes and bind them to some
         * onchange/onblur events for submitting
         */
        elems.each(function(i) {
				//console.log(this.outerHTML);
                $.fn.save._makeRequest( nodes, options, this);
        });
		options.send ? options.send($(this)) : false;
        $.ajax({
            type: options.method,
            data: vals,
            url: options.url,
            dataType: options.dataType,
            success: function(resp) {
                options.success ? options.success(resp) : false;
            },
            error: function(resp) {
                options.error ? options.error(resp) : false;
            }
        });		
        return $(this);
    }
    
    /**
     * Actually make the http request
     * using previously supplied data
     */
    $.fn.save._makeRequest = function( nodes, options, actsOn) {
        // Keep variables from global scope        
        /**
         * Further set default options that require
         * to actually inspect what node save was triggered upon
         * Defaults:
         *  -method: post
         *  -url: Will default to parent form if one is found,
         *        if not it will use the current location
         */
        form = $(actsOn).is('form') ? $(actsOn) : $(actsOn.form);
        options = $.extend({
            url: (form.attr('action'))? form.attr('action') : window.location.href,
            method: (form.attr('method')) ? form.attr('method') : "post"
        }, options);

        /**
         * If options.grouped is true we collect every
         * value from every node
         * But if its false we should only push
         * the one element we are acting on
         */
        if (options.grouped) {
            nodes.each(function (i) {
                /**
                 * Do not include button and input:submit as nodes to 
                 * send, EXCEPT if the button/submit was the explicit
                 * target, aka it was clicked
                 */
                if (!$(this).is('button,:submit')) {
                    if ($(this).is(':radio') && $(this).prop('checked')==false)
                        return;
                    vals[this.name] = $(this).is(':checkbox') ? 
                        $(this).prop('checked') : 
                        $(this).val();
                }
            });
        }
        else {
            vals[actsOn.name] = $(actsOn).is(':checkbox') ? 
                $(actsOn).attr('checked') : 
                $(actsOn).val();
        }
        /**
         * Perform http request and trigger callbacks respectively
         */
        // Callback triggered when ajax sending starts        
    }	
})(jQuery);

/**
 * A default (example) of a visualizer you can use that will
 * put a neat loading image in the nearest <legend>
 * for the element/form you were autosaving.
 * Notice: No default "remover" of this spinner exists
 */
defaultsaveSendVisualizer = function(node) {
    var refNode;
    if (node.is('form'))
        refNode = $(node).find('legend');
    else
        refNode = $(node).parent('fieldset').find('legend');
    // Create spinner
    var spinner = $('<img src="spin.gif" />').css({
        'position':'relative',
        'margin-left':'10px',
        'height': refNode.height(),
        'width': refNode.height()
    });
    spinner.appendTo(refNode);
}
