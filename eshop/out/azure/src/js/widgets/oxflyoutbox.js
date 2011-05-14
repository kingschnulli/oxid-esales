( function( $ ) {

    oxFlyOutBox = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;



            $(document).click( function( e ){
                if( $(e.target).parents("div").hasClass("topPopList") ){
                }else{
                    $("div.flyoutBox").hide();
                }
            });

            $(document).keydown( function( e ) {
               if( e.which == 27) {
                    $("div.flyoutBox").hide();
               }
            });

            el.click(function(){
                $("div.flyoutBox").hide();
                $(this).nextAll("div.flyoutBox").show();
                return false;
            });

        },
    }

    $.widget( "ui.oxFlyOutBox", oxFlyOutBox );

} )( jQuery );