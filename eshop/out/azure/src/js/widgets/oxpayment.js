( function( $ ) {
    oxPayment = {
        _create: function(){
            var self = this,
                options = self.options,
                el = self.element;

            $("dl dt input[type=radio]", el).click(function(){
                $("#payment dd").hide();
                $(this).parents("dl").children("dd").toggle();
            });
        }
    }

    $.widget( "ui.oxPayment", oxPayment );

} )( jQuery );