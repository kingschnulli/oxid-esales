( function( $ ) {

    oxMiniBasket = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;

            var timeout;

            // show on hover after some time
            $("img.minibasketIcon", el).hover(function(){
                timeout = setTimeout(function(){
                    self.showMiniBasket();
                }, 2000);
            }, function(){
                clearTimeout(timeout);
            });

            // show on click
            $("img.minibasketIcon", el).click(function(){
                self.showMiniBasket();
            });

            // close basket
            $(".closePop").click(function(){
                $(".basketFlyout").hide();
                clearTimeout(timeout);
                return false;
            });

            // show / hide added article message
            if($("#newItemMsg").length > 0){
                $("#countValue").hide();
                $("#newItemMsg").delay(3000).fadeTo("fast", 0, function(){
                    $("#countValue").fadeTo("fast", 1);
                    $("#newItemMsg").remove()
                });
            }

            $("#countdown").countdown(
                function(count, element, container) {
                    if (count <= 1) {
                        $(element).parents("#basketFlyout").hide();
                        $("#countValue").replaceWith("0");
                        $("#miniBasket img.minibasketIcon").unbind('mouseenter mouseleave');
                        return container.not(element);
                    }
                    return null;
                }
            );

        },

        showMiniBasket : function(){
            $("#basketFlyout").show();
            if ($(".scrollable ul").length > 0) {
                $('.scrollable ul').jScrollPane({
                    showArrows: true,
                    verticalArrowPositions: 'split'
                });
            }
        }
    }

    $.widget( "ui.oxMiniBasket", oxMiniBasket );

} )( jQuery );