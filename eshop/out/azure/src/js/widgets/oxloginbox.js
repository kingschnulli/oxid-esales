( function( $ ) {

    oxLoginBox = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;

            el.click(function(){
                $("#loginBox").show();
                return false;
            });

            $(".altLoginBox .fb_button").live("click", function(){
                $("#loginBox").hide();
            });

            $(document).click( function( e ){
                if( ! $(e.target).parents("div").hasClass("loginBox") ){
                    $("#loginBox").hide();
                }
            });

            $(document).keydown( function( e ) {
               if( e.which == 27) {
                    $("#loginBox").hide();
               }
            });
        }
    }

    $.widget( "ui.oxLoginBox", oxLoginBox );

} )( jQuery );