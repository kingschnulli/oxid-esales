( function( $ ) {

    oxBasketChecks = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;

            el.click(function(){
                if(el.is('input')){
                    self.toggleChecks( el.attr('checked') );
                    return true;
                } else {
                    self.toggleChecks( self.toggleMainCheck() );
                    return false;
                }
            });
        },

        toggleChecks : function( blChecked ){
            $( ".basketitems .checkbox input" ).attr( "checked", blChecked );
        },

        toggleMainCheck : function(){
            if ( $( "#checkAll" ).attr( "checked" ) ) {
                $( "#checkAll" ).attr( "checked", false );
                return false;
            } else {
                $( "#checkAll" ).attr( "checked", true );
                return true;
            }
        }
    }

    $.widget( "ui.oxBasketChecks", oxBasketChecks );

} )( jQuery );