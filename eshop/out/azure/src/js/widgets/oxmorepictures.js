( function( $ ) {

    oxMorePictures = {

        options: {
            iDefaultIndex  : -1
        },

        _create: function() {

            var self    = this,
                options = self.options,
                el      = self.element;

            $("li a", el).click(function() {

                $("li a", el).removeClass("selected");
                $(this).addClass("selected");

                return false;
            });
        },

        _init: function() {
            var self    = this,
                options = self.options,
                el      = self.element;

            // checking which item should be selected
            if (options.iDefaultIndex != -1 && $("li a.selected", el).parent().index() != options.iDefaultIndex) {
                $("li a:eq("+ options.iDefaultIndex +")", el).trigger("click");
            }
        }
    }

    $.widget( "ui.oxMorePictures", oxMorePictures );

} )( jQuery );
