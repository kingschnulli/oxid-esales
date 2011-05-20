( function ( $ ) {

    /**
     * Ajax
     */
    oxAjax = {
        options: {
            activator     : "",
            params        : {}
        },

        _create: function() {

            var self = this;
            var options = self.options;
            var blFormActivator = false;
            if (options.activator[0].tagName == 'FORM') {
                var blFormActivator = true;
            }

            action = self.getAction(options.activator);
            inputs = self.getInputData(options.activator,options.params['additionalData']);
            type   = self.getType(options.activator);

            jQuery.ajax({
                data: inputs,
                url: action,
                type: type,
                timeout: 30000,
                error: function(jqXHR, textStatus, errorThrown) {
                    if (params['onError']) {
                        params['onError'](jqXHR, textStatus, errorThrown);
                    }
                },
                success: function(response) {
                    if (params['onSuccess']) {
                        params['onSuccess'](response, inputs);
                    }
                }
            });
        },

        /**
         * Returns action name
         *
         * @return string
         */
        getAction: function( activator )
        {
            var action = "";
            if (activator[0].tagName == 'FORM') {
                action = activator.attr("action");
            } else if (activator[0].tagName == 'A') {
                action = activator.attr("href");
            }
            return action;
        },

        /**
         * Returns input data
         *
         * @return array
         */
        getInputData: function(activator, additionalData)
        {
            var inputs = {};
            if (activator[0].tagName == 'FORM') {
                $("input", activator).each(function() {
                    inputs[this.name] = this.value;
                });
            }
            if (additionalData) {
                $.each(additionalData, function(i, f) {inputs[i] = f;});
            }
            return inputs;
        },

        /**
         * Returns form type
         *
         * @return string
         */
        getType: function(activator)
        {
            if (activator[0].tagName == 'FORM') {
                type   = activator.attr("method");
            } else {
                type = "get";
            }
            return type;
        },

    };

    /**
     * Compare list widget
     */
    $.widget("ui.oxAjax", oxAjax );

})( jQuery )
