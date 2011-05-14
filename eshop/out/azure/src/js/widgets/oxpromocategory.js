( function( $ ) {

    oxPromoCategory = {

        _create: function(){

            var self = this;
            var el   = self.element;

             el.hover(function(){
                  var targetObj = $(this).children(".viewAllHover");
                  targetObj.show();
                  var targetObjMargin = targetObj.width() / 2;
                  targetObj.css("margin-left", "-" + targetObjMargin + "px");
              }, function(){
                  $(".viewAllHover").hide();
              });
        }
    }

    $.widget( "ui.oxPromoCategory", oxPromoCategory );

} )( jQuery );
