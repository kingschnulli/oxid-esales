( function( $ ) {

    oxBargainItem = {

        _create: function(){

            var self = this;
            var el   = self.element;

            el.hover(function(){
                var boxHeight = $(".hoverBox", $(this)).height();
                var boxTarget = $(".hoverInfo", $(this));
                var addHoverPadding = (boxHeight - boxTarget.height()) / 2;
                boxTarget.css("padding-top", addHoverPadding);
            });

        }
    }

    $.widget( "ui.oxBargainItem", oxBargainItem );

} )( jQuery );
