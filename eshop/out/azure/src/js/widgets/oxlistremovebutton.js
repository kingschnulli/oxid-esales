( function( $ ) {

    oxListRemoveButton = {

        _create: function(){

            var self = this;
            var el   = self.element;

            el.click(function(){
                var targetForm = $(this).attr("triggerForm");
                $("#"+targetForm).submit();
                return false;
            });

        }
    }

    $.widget( "ui.oxListRemoveButton", oxListRemoveButton );

} )( jQuery );