( function( $ ) {
    /**
     * User shipping address selector
     */
    oxUserShipingAddressSelect = {
        _create: function()
        {
            var self = this,
                options = self.options,
                el = self.element;

            el.change(function() {
                $( ".oxValidate" ).unbind('submit');
                var selectValue = $(this).val();

                if ($("input[name=reloadaddress]")) {
                    $("input[name=reloadaddress]").val(self.getReloadValue(selectValue));
                }
                if (selectValue !== '-1') {
                    self.submitForm();
                } else {
                    self.emptyInputFields();
                }
            });
        },

        /**
         * Clears all shipping address input fields
         *
         * @return null
         */
        emptyInputFields : function()
        {
            $("input:text").filter(function() {
                return this.name.match(/address__/);
            }).val("");
            $('#shippingAddressForm').show();
            $('#shippingAddressText').hide();
            $("select[name='deladr[oxaddress__oxcountryid]']").children("option").attr("selected", null);
            $("select[name='deladr[oxaddress__oxstateid]']").children("option[name='promtString']").attr("selected", "selected");
        },

        /**
         * Sets some form values and submits it
         *
         * @return null
         */
        submitForm : function()
        {
            $("form[name='order'] input[name=cl]").val($("input[name=changeClass]").val());
            $("form[name='order'] input[name=fnc]").val("");
            $("form[name='order']").submit();
        },

        /**
         * Returns reloadaddress value
         *
         * @return integer
         */
        getReloadValue : function( selectValue )
        {
            if (selectValue === '-1') {
                return '1';
            } else {
                return '2';
            }
        }
    }

    $.widget( "ui.oxUserShipingAddressSelect", oxUserShipingAddressSelect );

} )( jQuery );