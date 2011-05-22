( function( $ ) {
    /**
     * Details article action links selector
     */
    oxArticleActionLinksSelect = {

        _create: function()
        {
            var self = this,
                options = self.options,
                el      = self.element;

            var targetWidth  = $("span", el).width();
            var linkboxWidth = self.getLinkboxWidth( targetWidth, $("span", el));
            var targetHeight = $("span", el).height();

            $(".actionLinks").css({
                "top": el.position().top - 7,
                "left": el.position().left - 10,
                "padding-top": targetHeight + 10,
                "width": linkboxWidth + 50
            });

            var arrowSrc = $(".selector img").attr("src");
            var arrow = $("#productLinks").children("img");

            $("#productLinks").css({
                "top": el.position().top - 3,
                "left": targetWidth + el.position().left + 10
            }).click(function(){
                if ( $(this).hasClass("selected") ) {
                    self.hideLinks(arrow, arrowSrc);
                } else {
                    self.showLinks(arrow);
                }
                return false;
            });

            $("#productLinks").mouseenter(function() {
                if (! $(this).hasClass("selected") ) {
                    self.showLinks(arrow);
                }
                return false;
            });

            $(".actionLinks").mouseleave( function() {
                self.hideLinks(arrow, arrowSrc);
                return false;
            });

            //if user comes first time to details shows action links box
            //and sets to cookie, not to show it later
            if ($("#showLinksOnce").length > 0) {
                $(".actionLinks").slideDown('normal').delay(2000).slideUp('normal', function(){
                     document.cookie = "showlinksonce=1; path=/";
                });
            }

            $('select[id^=sellist]').change (function() {
                var oSelf = $(this);
                var oNoticeList = $('#linkToNoticeList');
                if ( oNoticeList ) {
                    oNoticeList.attr('href', oNoticeList.attr('href') + "&" + oSelf.attr('name') + "&" + oSelf.val());
                }
                var oWishList = $('#linkToWishList');
                if ( oWishList ) {
                    oWishList.attr('href', oWishList.attr('href') + "&" + oSelf.attr('name') + "&" + oSelf.val());
                }
            });

        },

        /**
         * Shows action links list box in details
         *
         * @param object arrow img object
         *
         * @return null
         */
        showLinks : function( arrow )
        {
            var arrowOnSrc = arrow.attr("longdesc");
            $(".actionLinks").slideDown("normal", function(){
                arrow.attr("src", arrowOnSrc);
                $('#productLinks').toggleClass("selected");
            });
        },

        /**
         * Hides action links list box in details
         *
         * @param object arrow    img object of selector
         * @param object arrowSrc img object of product links
         *
         * @return null
         */
        hideLinks : function( arrow, arrowSrc )
        {
            $(".actionLinks").animate({
                height: 0,
                opacity: 0.1
            }, 300, function(){
                $(".actionLinks").hide().css({
                    height: 'auto',
                    opacity: '1'
                });
                arrow.attr("src", arrowSrc);
                $('#productLinks').toggleClass("selected");
            });
        },

        /**
         * Shows action links list box in details
         *
         * @param integer iTargetWidth terget width
         * @param object oObject      object to set width
         *
         * @return integer
         */
        getLinkboxWidth : function( iTargetWidth, oObject )
        {
            if (iTargetWidth > 220) {
                return oObject.width();
            } else {
                return 220;
            }
        }
    }

    $.widget( "ui.oxArticleActionLinksSelect", oxArticleActionLinksSelect );

} )( jQuery );