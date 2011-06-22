( function( $ ) {
    /**
     * Details amount price selector
     */
    oxAmountPriceSelect = {

        _create: function()
        {

            var self = this,
                options = self.options,
                el      = self.element;

            $(".pricePopup").css({
                "top": el.position().top - 7,
                "left": el.position().left - 10,
                "width": 220
            });

            el.click(function(){
                var arrow = $(this).children("img");

                $(this).toggleClass("selected");
                if ($(this).hasClass("selected")) {
                    self.hidePriceList( arrow, el.position().left );
                } else {
                    self.showPriceList( arrow );
                }
                return false;
            });

        },

        /**
         * Shows price list box
         *
         * @param object arrow img object
         *
         * @return null
         */
        showPriceList : function( arrow )
        {
            var arrowSrc = $(".selector img").attr("src");
            $("#priceinfo").animate({
                height: 0,
                opacity: 0.1
            }, 300, function(){
                $("#priceinfo").hide().css({
                    height: 'auto',
                    opacity: '1'
                });
                arrow.attr("src", arrowSrc);
            });
        },

        /**
         * Hides price list box
         *
         * @param object arrow img object
         *
         * @return null
         */
        hidePriceList : function( arrow, sLeftPosition )
        {
            var arrowSrc = arrow.attr("src");
            $("#priceinfo").slideDown("normal", function(){
                arrow.attr("src", arrowSrc.replace('selectbutton.png', 'selectbutton-on.png'));
            });
        }

    }

    $.widget( "ui.oxAmountPriceSelect", oxAmountPriceSelect );

} )( jQuery );