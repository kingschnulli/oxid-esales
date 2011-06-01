( function( $ ) {

     oxModalPopup = {
            options: {
                width         : 687,
                height         : 'auto',
                modal         : true,
                resizable     : true,
                zIndex         : 10000,
                position     : 'center',
                draggable     : true,

                target         : '#popup',
                openDialog     : false,
                loadUrl        : false
            },

            _create: function() {

                var self = this,
                options = self.options,
                el      = self.element;

                if (options.openDialog) {

                    if (options.loadUrl){
                        $(options.target).load(options.loadUrl);
                    }

                    self.openDialog(options.target, options);

                    return false;
                }

                el.click(function(){

                    if (options.loadUrl){
                        $(options.target).load(options.loadUrl);
                    }

                    self.openDialog(options.target, options);

                    return false;
                });

                 $("img.closePop, button.closePop").click(function(){
                    $(options.target).dialog("close");
                    return false;
                 });

            },

             openDialog: function (target, options) {

                $(target).dialog({

                        width         : options.width,
                        height         : options.height,
                        modal         : options.modal,
                        resizable     : options.resizable,
                        zIndex         : options.zIndex,
                        position     : options.position,
                        draggable     : options.draggable,

                        open: function(event, ui) {

                        $('div.ui-dialog-titlebar').css("visibility", "hidden");
                    }
                });
             }
    };

    $.widget("ui.oxModalPopup", oxModalPopup );

} )( jQuery );