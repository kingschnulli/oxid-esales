var oxid = {

//
// MD variants --------------------------------------------
//
    mdVariants: {


        // reloading page by selected value in select list
        getMdVariantUrl: function(selId){
            var _mdVar = document.getElementById(selId);

            if (_mdVar) {
                _newUrl = _mdVar.options[_mdVar.selectedIndex].value;
            }

            if (_newUrl) {
                document.location.href = _newUrl;
            }
        },

        mdAttachAll: function(){
            if (!mdVariantSelectIds) {
                mdVariantSelectIds = Array();
            }

            if (!mdRealVariants) {
                mdRealVariants = Array();
            }

            for (var i = 0; i < mdVariantSelectIds.length; i++) {
                if (mdVariantSelectIds[i]) {
                    for (var j = 0; j < mdVariantSelectIds[i].length; j++) {
                        //attach JS handlers
                        var mdSelect = document.getElementById(mdVariantSelectIds[i][j]);
                        if (mdSelect) {
                            mdSelect.onchange = oxid.mdVariants.resetMdVariantSelection;
                        }
                    }
                }
            }
        },

        resetMdVariantSelection: function(e){
            mdSelect = oxid.getEventTarget(e);
            //hide all
            selectedValue = mdSelect.options[mdSelect.selectedIndex].value;
            level = oxid.mdVariants.getSelectLevel(mdSelect.id);
            if (level !== null) {
                oxid.mdVariants.hideAllMdSelect(level + 1);
            }
            //show selection
            var showId = selectedValue;
            while (showId) {
                showSelectId = oxid.mdVariants.getMdSelectNameById(showId);
                oxid.mdVariants.showMdSelect(showSelectId);
                shownSelect = document.getElementById(showSelectId);
                if (shownSelect) {
                    showId = shownSelect.options[shownSelect.selectedIndex].value;
                }
                else {
                    showId = null;
                }
            }

            oxid.mdVariants.showMdRealVariant();
        },

        getMdSelectNameById: function(id){
            var name = 'mdVariantSelect_' + id;
            return name;
        },

        getSelectLevel: function(name){
            for (var i = 0; i < mdVariantSelectIds.length; i++) {
                for (var j = 0; j < mdVariantSelectIds[i].length; j++) {
                    if (mdVariantSelectIds[i][j] == name) {
                        return i;
                    }
                }
            }
            return null;
        },

        showMdSelect: function(id){
            if (document.getElementById(id)) {
                document.getElementById(id).style.display = 'inline';
            }
        },

        hideAllMdSelect: function(level){
            for (var i = level; i < mdVariantSelectIds.length; i++) {
                if (mdVariantSelectIds[i]) {
                    for (var j = 0; j < mdVariantSelectIds[i].length; j++) {
                        if (document.getElementById(mdVariantSelectIds[i][j])) {
                            document.getElementById(mdVariantSelectIds[i][j]).style.display = 'none';
                        }
                    }
                }
            }
        },

        getSelectedMdRealVariant: function(){
            for (var i = 0; i < mdVariantSelectIds.length; i++) {
                for (var j = 0; j < mdVariantSelectIds[i].length; j++) {
                    var mdSelectId = mdVariantSelectIds[i][j];
                    var mdSelect = document.getElementById(mdSelectId);
                    if (mdSelect && mdSelect.style.display == "inline") {
                        var selectedVal = mdSelect.options[mdSelect.selectedIndex].value;
                        if (mdRealVariants[selectedVal])
                            return mdRealVariants[selectedVal];
                    }
                }
            }
        },

        showMdRealVariant: function(){
            document.getElementById('mdVariantBox').innerHTML = '';
            var selectedId = oxid.mdVariants.getSelectedMdRealVariant();
            if (selectedId && document.getElementById('mdVariant_' + selectedId)) {
                document.getElementById('mdVariantBox').innerHTML = document.getElementById('mdVariant_' + selectedId).innerHTML;
            }

        }
    },

//
// MD variants ===============================================
//

//
// ajax ---------------------------------------------
//


    loadingScreen: {
        start : function (target, iconPositionElement) {
            var loadingScreens = Array();
            $(target).each(function() {
                var overlayKeeper = document.createElement("div");
                overlayKeeper.innerHTML = '<div class="loadingfade"></div><div class="loadingicon"></div><div class="loadingiconbg"></div>';
                $('div', overlayKeeper).css({
                        'position' : 'absolute',
                        'left'     : $(this).offset().left-10,
                        'top'      : $(this).offset().top-10,
                        'width'    : $(this).width()+20,
                        'height'   : $(this).height()+20
                    });
                if (iconPositionElement && iconPositionElement.length) {
                    var x = Math.round(
                        iconPositionElement.offset().left // my left
                        - 10 - $(this).offset().left      // relativeness
                        + iconPositionElement.width()/2   // plus half of width to center
                    );
                    var offsetTop = iconPositionElement.offset().top;
                    var y = Math.round(
                        offsetTop                         //my top
                        - 10 - $(this).offset().top       // relativeness
                        + (                               // this requires, that last element in collection, would be the bottom one
                                                          // as it computes last element offset from the first one plus its height
                            iconPositionElement.last().offset().top - offsetTop + iconPositionElement.last().height()
                        )/2
                    );

                    $('div.loadingiconbg,div.loadingicon', overlayKeeper).css({
                        'background-position' : x + "px "+y+"px"
                    });
                }
                $('div.loadingfade', overlayKeeper)
                    .css({'opacity' : 0})
                    .animate({
                        opacity: 0.55
                    }, 200
                    );
                $("body").append(overlayKeeper);
                loadingScreens.push(overlayKeeper);
            });
            return loadingScreens;
        },
        stop : function (loadingScreens) {
          $.each(loadingScreens, function(i, el) {
              $('div', el).not('.loadingfade').remove();
              $('div.loadingfade', el)
                  .stop(true, true)
                  .animate({
                      opacity: 0
                  }, 100, function(){
                      $(el).remove();
                  });
          });
        }
    },


    updatePageErrors : function(errors) {
        if (errors.length) {
            var errlist = $("#content > .status.error");
            if (errlist.length == 0) {
                $("#content").prepend("<div class='status error corners'>");
                errlist = $("#content > .status.error");
            }
            if (errlist) {
                errlist.children().remove();
                var i;
                for (i=0; i<errors.length; i++) {
                    var p = document.createElement('p');
                    $(p).append(document.createTextNode(errors[i]));
                    errlist.append(p);
                }
            }
        } else {
            $("#content > .status.error").remove();
        }
    },

    ajax : function(activator, params) {
        // activator: form or link element
        // params: targetEl, iconPosEl, onSuccess, onError, additionalData
        var inputs = {};
        var action = "";
        var type   = "";
        if (activator[0].tagName == 'FORM') {
            $("input", activator).each(function() {
                inputs[this.name] = this.value;
            });
            action = activator.attr("action");
            type   = activator.attr("method");
        } else if (activator[0].tagName == 'A') {
            action = activator.attr("href");
        }

        if (params['additionalData']) {
            $.each(params['additionalData'], function(i, f) {inputs[i] = f;});
        }

        var loadingScreen = null;
        if (params['targetEl']) {
            loadingScreen = oxid.loadingScreen.start(params['targetEl'], params['iconPosEl']);
        }

        if (!type) {
            type = "get";
        }
        jQuery.ajax({
            data: inputs,
            url: action,
            type: type,
            timeout: 30000,
            error: function(jqXHR, textStatus, errorThrown) {
                if (loadingScreen) {
                    oxid.loadingScreen.stop(loadingScreen);
                }
                if (params['onError']) {
                    params['onError'](jqXHR, textStatus, errorThrown);
                }
            },
            success: function(r) {
                if (loadingScreen) {
                    oxid.loadingScreen.stop(loadingScreen);
                }
                if (r['debuginfo'] != undefined && r['debuginfo']) {
                    $("body").append(r['debuginfo']);
                }
                if   (r['errors'] != undefined
                   && r['errors']['default'] != undefined) {
                    oxid.updatePageErrors(r['errors']['default']);
                } else {
                    oxid.updatePageErrors([]);
                }
                if (params['onSuccess']) {
                    params['onSuccess'](r, inputs);
                }
            }
        });
    },

    evalScripts : function(container){
        try {
            $("script", container).each(function(){
                try {
                    eval(this.innerHTML);
                } catch (e) {
                    // console.error(e);
                }
                $(this).remove();
            });
        } catch (e) {
            // console.error(e);
        }
    },

//
// ajax =============================================
//

//
// selections --------------------------------------------------
//
  /*  selectionDrop : {
        onClick : function ( obj ) {
            // setting new selection
            var oUl = obj.parent( "li" ).parent( "ul" );
            var oP  = oUl.prev( "input" ).prev( "p" );

            oP.addClass( "underlined" );
            $( "span", oP ).html( obj.html() );

            $( "a", oUl ).removeClass('selected');
            obj.addClass( "selected" );

            oUl.prev( "input" ).attr( "value", obj.attr( "rel" ) );
            oUl.hide();
            return false;
        }
    }, */
//
// selections =====================================================
//

//
// variant selection ------------------------------------------
//
    /**
     * Variant selection handler
     */
    variantSelection : {

        /**
         * Resets variant selections
         */
        resetVariantSelections : function()
        {
            var aVarSelections = $( ".oxProductForm input[name^=varselid]" );
            for (var i = 0; i < aVarSelections.length; i++) {
                $( aVarSelections[i] ).attr( "value", "" );
            }
            $( ".oxProductForm input[name=anid]" ).attr( "value", $( ".oxProductForm input[name=parentid]" ).attr( "value" ) );
        }
    },

//
// variant selection ------------------------------------------
//

    initDetailsMain : function () {

     //   oxid.initDropDowns();

        //
        // details page article action links ---------------------------------------
        //


//
// Ammount price -----------------------------------------------------------------
//

//
// Ammount price ==========================================================
//

//
// Price alarm --------------------------------------------------------
//

      /*  $(".priceAlarmLink").click(function() {
            var $tabs = $('.tabbedWidgetBox').tabs();
            $tabs.tabs('select', '#pricealarm');
            return false;
        }); */

//
// Price alarm ==============================================
//

//
// variants select  call ----------------------------------------------
//
        /**
         * Variant selection dropdown
         */
        $('ul.vardrop a').unbind( "click" );
        $("ul.vardrop a").bind( "click", function() {

            var obj = $( this );

            // resetting
            if ( obj.parents().hasClass("oxdisabled") ) {
                oxid.variantSelection.resetVariantSelections();
            } else {
                $( ".oxProductForm input[name=anid]" ).attr( "value", $( ".oxProductForm input[name=parentid]" ).attr( "value" ) );
            }

            // setting new selection
            if ( obj.parents().hasClass("fnSubmit") ){
                obj.parent('li').parent('ul').prev('input').attr( "value", obj.attr("rel") );

                var form = obj.closest("form");
                $('input[name=fnc]', form).val("");
                form.submit();
            }
            return false;
        });

        /**
         * variant reset link
         */
        $('div.variantReset a').click( function () {
            oxid.variantSelection.resetVariantSelections();
            var obj = $( this );
            var form = obj.closest("form");
            $('input[name=fnc]', form).val("");
            form.submit();
            return false;
        } );

        function reloadProductPartially(activator,renderPart,highlightTargets,contentTarget) {
            oxid.ajax(
                activator,
                {//targetEl, onSuccess, onError, additionalData
                    'targetEl'  : highlightTargets,
                    'iconPosEl' : $("#variants .dropDown"),
                    'additionalData' : {'renderPartial' : renderPart},
                    'onSuccess' : function(r) {
                        contentTarget.innerHTML = r['content'];
                        oxid.evalScripts(contentTarget);
                    }
                }
            );
            return false;
        }

        $(".oxProductForm").submit(function () {
            if (!$("input[name='fnc']", this).val()) {
                if (($( "input[name=aid]", this ).val() == $( "input[name=parentid]", this ).val() )) {
                    var aSelectionInputs = $("input[name^=varselid]", this);
                    if (aSelectionInputs.length) {
                        var hash = '';
                        aSelectionInputs.not("*[value='']").each(function(i){
                            hash = hash+i+':'+$(this).val()+"|";
                        });
                        if (oxVariantSelections.indexOf(hash) < 0) {
                            return reloadProductPartially($(".oxProductForm"),'detailsMain',$("#detailsMain"),$("#detailsMain")[0]);
                        }
                    }
                }
                return reloadProductPartially($(".oxProductForm"),'productInfo',$("#productinfo"),$("#productinfo")[0]);
            }
        });
//
// variants  select call =====================================================
//

        //
        // selections call ----------------------------------------------
        //

        /**
         * selection dropdown
         */
       // $('ul.seldrop a').unbind( "click" );
        //$("ul.seldrop a").bind( "click", function() {

           // alert('aa');

        //    return oxid.selectionDrop.onClick( $( this ) );
       // });

        //
        // selections call ==========================================
        //
    },


   // initDetailsRelated : function () {


//
// tags calls ------------------------------
//
        /*$(".tagCloud .tagText").click(oxTag.highTag);
        $("#saveTag").click(oxTag.saveTag);
        $("#cancelTag").click(oxTag.cancelTag);
        $("#editTag").click(oxTag.editTag); */

//
// tags calls =========================================
//

  //  },

//
// Tags --------------------------------------------
//

 /*   highTag : function() {
        var oSelf = $(this);

        $(".tagError").hide();

        oxAjax.ajax(
            $("#tagsForm"),
            {//targetEl, onSuccess, onError, additionalData
                'targetEl' : $("#tags"),
                'additionalData' : {'highTags' : oSelf.prev().text()},
                'onSuccess' : function(response, params) {
                    oSelf.prev().addClass('taggedText');
                    oSelf.hide();
                }
            }
        );
        return false;
    }, */

/*
    saveTag : function() {
        $(".tagError").hide();

        oxAjax.ajax(
            $("#tagsForm"),
            {//targetEl, onSuccess, onError, additionalData
                'targetEl' : $("#tags"),
                'additionalData' : {'blAjax' : '1'},
                'onSuccess' : function(response, params) {
                    if ( response ) {
                        $(".tagCloud").append("<span class='taggedText'>" + params["newTags"] + "</span> ");
                    } else {
                        $(".tagError").show();
                    }
                }
            }
        );
        return false;
    },
*/
/*

    cancelTag : function () {
        oxAjax.ajax(
            $("#tagsForm"),
            {//targetEl, onSuccess, onError, additionalData
                'targetEl' : $("#tags"),
                'additionalData' : {'blAjax' : '1', 'fnc' : 'cancelTags'},
                'onSuccess' : function(response, params) {
                    if ( response ) {
                        $('#tags').html(response);
                        $("#tags #editTag").click(oxid.editTag);
                    }
                }
            }
        );
        return false;
    },

*/

   /* editTag : function() {
        oxAjax.ajax(
            $("#tagsForm"),
            {//targetEl, onSuccess, onError, additionalData
                'targetEl' : $("#tags"),
                'additionalData' : {'blAjax' : '1'},
                'onSuccess' : function(response, params) {
                    if ( response ) {
                        $('#tags').html(response);
                        $("#tags .tagText").click(oxid.highTag);
                        $('#tags #saveTag').click(oxid.saveTag);
                        $('#tags #cancelTag').click(oxid.cancelTag);
                    }
                }
            }
        );
        return false;
    }, */
//
// Tags ===========================================
//

//
// dropDowns ------------------------------------------------------
//

   /* showDropdown : function () {
        oxid.hideDropdown();
        targetObj = $(this);

        targetObj.removeClass('underlined');
        sublist = targetObj.nextAll("ul.drop");

        sublist.prepend("<li class='value'></li>");
        targetObj.clone().appendTo($(".value", sublist));
        sublist.css("width", targetObj.parent().outerWidth());

        if (sublist.length) {
            sublist.slideToggle("fast");
            targetObj.toggleClass("selected");
        }
    },

    hideDropdown: function () {
        $("ul.drop").hide();
        $("ul.drop li.value").remove();
        $(".dropDown p").removeClass("selected");
        $(".dropDown p").addClass("underlined");
    },

    initDropDowns : function () {
        $(document).click( function(e){
            var clickTarget = e.target;
            if (!$(clickTarget).parents().hasClass("dropDown")) {
                $(".drop").hide();
                $(".dropDown p").addClass("underlined");
            }
        });

        $(".dropDown p:not(.oxdisabled)").click(oxid.showDropdown);

        $(".dropDown p").hover(function(){
            $(this).toggleClass("selected");
        });

        $("ul.drop a").click(function(){
            var obj = $(this);
            var objFnIdent = obj.parents().hasClass("fnSubmit");
            if ( objFnIdent ){
                obj.parent('li').parent('ul').prev('input').attr( "value", obj.attr("rel") );
                obj.closest("form").submit();
                return false;
            }
            return null;
        })
    },*/

//
// dropDowns ===============================================
//
}

//
// Other --------------------------------------------
//

$(function(){


//
// box titles ---------------------------------------------
//

        /*
         * Trim title and add ellipsis ...
         */
        function trimTitles(group) {
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

        trimTitles($(".box h3 a"));

//
// box titles ================================================
//
   // oxid.initDropDowns();
});