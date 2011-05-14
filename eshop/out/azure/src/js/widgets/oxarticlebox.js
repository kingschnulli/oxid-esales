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

                    //obening selected
                    $(this).addClass('titleOn');
                    $(this).prev().addClass('showImage')
                    $(this).prev().slideDown(500);
                }
            });
        }
    }

    $.widget( "ui.oxArticleBox", oxArticleBox );

} )( jQuery );
