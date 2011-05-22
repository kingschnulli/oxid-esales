( function ( $ ) {

    /**
     * Equalize columns
     */
    oxDropDown = {

        options: {
            sNotClickable      : ".oxdisabled",
            sSelectedClass     : "selected",
            sUnselectedClass   : "underlined",
            sDropBoxElement    : "ul.drop",
            sMainDropBoxClass  : ".drop",
            sMainDropDownClass : "dropDown",
            sSubmitClass       : "fnSubmit"
        },

        _create: function(){

            var self = this,
                options = self.options,
                el      = self.element;

            el.not(options.sNotClickable).click(function() {
                self.showDropdown($(this));
            });

            el.hover(function(){
                $(this).toggleClass(options.sSelectedClass);
            });

            $("a", options.sDropBoxElement).click(function(){
                var obj = $(this);
                var objFnIdent = obj.parents().hasClass(options.sSubmitClass);
                if ( objFnIdent ) {
                    obj.parent('li').parent('ul').prev('input').attr( "value", obj.attr("rel") );
                    obj.closest("form").submit();
                    return false;
                }
                return null;
            });

            $(document).click( function(e) {
                if (!$(e.target).parents().hasClass(options.sMainDropDownClass)) {
                    $(options.sMainDropBoxClass).hide();
                    el.addClass(options.sUnselectedClass);
                }
            });

        },

        showDropdown : function (targetObj)
        {
            options = this.options;
            this.hideDropdown();

            targetObj.removeClass(options.sUnselectedClass);
            sublist = targetObj.nextAll(options.sDropBoxElement);

            sublist.prepend("<li class='value'></li>");
            targetObj.clone().appendTo($(".value", sublist));
            sublist.css("width", targetObj.parent().outerWidth());

            if (sublist.length) {
                sublist.slideToggle("fast");
                targetObj.toggleClass(this.options.sSelectedClass);
            }
        },

        hideDropdown: function ()
        {
            el      = this.element;
            options = this.options;
            $(options.sDropBoxElement).hide();
            $("li.value", options.sDropBoxElement).remove();
            el.removeClass(options.sSelectedClass);
            el.addClass(options.sUnselectedClass);
        }
    };

    /**
     * Equalizer widget
     */
    $.widget("ui.oxDropDown", oxDropDown );

})( jQuery )
