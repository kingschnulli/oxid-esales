( function( $ ) {

    oxManufacturerSlider = {
            options: {
                classButtonNext    : '.nextItem',
                classButtonPrev    : '.prevItem'
            },

            _create: function() {

                var self = this,
                options = self.options,
                el         = self.element;

                 el.jCarouselLite({
                     btnNext: options.classButtonNext,
                     btnPrev: options.classButtonPrev,
                   visible: 6,
                   scroll: 1
                });
            }
    };

    $.widget("ui.oxManufacturerSlider", oxManufacturerSlider );

} )( jQuery );