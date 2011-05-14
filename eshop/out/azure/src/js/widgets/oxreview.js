( function( $ ) {

    oxReview = {
        options: {
            reviewButton : "#writeNewReview",
            reviewForm   : "#writeReview",
        },

        _create: function() {

            var self    = this;
            var options = self.options;
            var el      = self.element;

            $( options.reviewButton ).click(function(){
                $( options.reviewForm ).slideToggle();
                $( options.reviewButton ).hide();
                return false;
            });
        },
    };

    /**
     * Review widget
     */
    $.widget("ui.oxReview", oxReview );


} )( jQuery );