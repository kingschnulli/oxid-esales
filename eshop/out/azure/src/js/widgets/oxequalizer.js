( function ( $ ) {

    /**
     * Equalize columns
     */
    oxEqualizer = {

        /**
         * Gets tallest element value
         *
         * @return integer
         */
        equalHeight: function(group, target)
        {
            var self    = this;

            if (target) {
                if (group.height() < target.height()){
                    group.css("height", target.height());
                }
            } else {
                tallest = self.getTallest(group);
                group.each(function(){
                    if( $(this).hasClass('catPicOnly') && $(this).height() < tallest  ){
                        $(this).height(tallest+20);
                    }else{
                        $(this).height(tallest);

                    }
                });
            }
        },

        /**
         * Gets tallest element value
         *
         * @return integer
         */
        getTallest: function(el)
        {
            var tallest = 0;
            el.each(function(){
                var thisHeight = $(this).height();
                if (thisHeight > tallest) {
                    tallest = thisHeight;
                }
            });
            return tallest;
        }
    };

    /**
     * Equalizer widget
     */
    $.widget("ui.oxEqualizer", oxEqualizer );

})( jQuery )
