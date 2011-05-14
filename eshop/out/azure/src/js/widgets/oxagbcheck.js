( function( $ ) {

    oxAGBCheck = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;

             el.closest('form').submit(function() {
                if( el.attr('checked') ){
                    return true;
                } else {
                    $("p[name='agbError']").show();
                    return false;
                }

            });

            el.click(function() {
                if( el.attr('checked') ){
                    el.attr('checked', true);
                    $("p[name='agbError']").hide();
                } else {
                    el.attr('checked', false);
                }
            });
        },
    }

    $.widget( "ui.oxAGBCheck", oxAGBCheck );

} )( jQuery );