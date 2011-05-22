( function( $ ) {

    oxTopMenu = {

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;


            if ($.browser.msie) {
                $("li:not(:has(ul))", el).hover(function(){
                    $(this).addClass("sfHover");
                }, function(){
                    $(" li:not(:has(ul))", el).removeClass("sfHover");
                });
            }

            //Categories menu init
            el.supersubs({
                minWidth:    12,   // minimum width of sub-menus in em units
                maxWidth:    35,   // maximum width of sub-menus in em units
                extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                                   // due to slight rounding differences and font-family
            }).superfish( {
                 delay : 500,
                 dropShadows : false,
                 onBeforeShow : function() {
                    //adding hover class for active <A> elements
                    $('a:first', this.parent()).addClass($.fn.superfish.op.hoverClass);

                    // horizontaly centering top navigation first level popup accoring its parent
                    activeItem = this.parent()
                    if ( activeItem.parent().hasClass('sf-menu') ) {
                        liWidth = activeItem.width();
                        ulWidth = $('ul:first', activeItem).width();
                        marginWidth = (liWidth - ulWidth) / 2;
                        $('ul:first', activeItem).css("margin-left", marginWidth);
                    }
                },
                onHide : function() {
                    $('a:first-child',this.parent()).removeClass($.fn.superfish.op.hoverClass);
                }
            });
        }
    }

    $.widget( "ui.oxTopMenu", oxTopMenu );

} )( jQuery );