( function( $ ) {

    oxInnerLabel = {

        options: {
            sDefaultValue : 'innerLabel'
        },

        _create: function(){

            var self = this,
                options = self.options,
                el = self.element;

            el.focus(function() {
                if ( $.trim( el.val() ) == options.sDefaultValue ){
                    el.val('');
                } else {
                    el.select();
                }
            });

            el.closest('form').submit(function() {
                if ($.trim( el.val() ) == options.sDefaultValue ) {
                    el.val('');
                }
            });
        }
    }

    $.widget( "ui.oxInnerLabel", oxInnerLabel );

} )( jQuery );