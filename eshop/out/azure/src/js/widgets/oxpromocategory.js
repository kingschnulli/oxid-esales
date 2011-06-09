( function( $ ) {

    oxPromoCategory = {

        _create: function(){

            var self = this;
            var el   = self.element;

             el.hover(function(){
                  var targetObj = $(".viewAllHover", el);
                  targetObj.show();
                  var targetObjMargin = targetObj.width() / 2;
                  targetObj.css("margin-left", "-" + targetObjMargin + "px");
              }, function(){
                  $(".viewAllHover", el).hide();
              });
        }
    }

    $.widget( "ui.oxPromoCategory", oxPromoCategory );

} )( jQuery );
