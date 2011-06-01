( function( $ ) {

    oxArticleBox = {

        _create: function(){

            var self = this;
            var el   = self.element;

            //hide all
            $('.articleImage', el).hide();

            //open first
            $('.articleImage:first', el).show();
            $('.articleImage:first', el).addClass('showImage');

            $('.articleTitle', el).mouseover(function() {

                //if not opened
                if ($(this).prev().is(':hidden') == true) {

                    //closing opened
                    $('.articleTitle', el).removeClass('titleOn');
                    $('.showImage', el).slideUp(500);

                    //opening selected
                    $(this).addClass('titleOn');
                    $(this).prev().addClass('showImage')
                    $(this).prev().slideDown(500);
                }
            });

            self.trimTitles( $( ".box h3 a", el ) );

        },

        trimTitles : function(group) {
            group.each(function(){
                var thisWidth  = $(this).width();
                var thisText   = $.trim($(this).text());
                var parentWidth = $(this).parent().width();
                if (thisWidth > parentWidth) {
                    var thisLength  = thisText.length;
                    while (thisWidth > parentWidth)
                    {
                        thisLength--;
                        $(this).html(thisText.substr(0,thisLength)+'&hellip;');
                        var thisWidth = $(this).width();
                    }
                    $(this).attr('title',thisText);
                }
            });
        }

    }

    $.widget( "ui.oxArticleBox", oxArticleBox );

} )( jQuery );
