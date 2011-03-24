var oxid = {
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
    }
}

function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function deleteCookie(name) {
    setCookie(name,"",-1);
}

$(function(){
        if ($.browser.msie) {
            $("ul.sf-menu li:not(:has(ul))").hover(function(){
                $(this).addClass("sfHover");
            }, function(){
                $("ul.sf-menu li:not(:has(ul))").removeClass("sfHover");
            });
        }

        //Categories menu init
        $("ul.sf-menu").supersubs({
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
        } );


        $("#countdown").countdown(
            function(count, element, container) {
                if (count <= 1) {
                    $(element).parents("#basketFlyout").hide();
                    $("#countValue").replaceWith("0");
                    $("#miniBasket img.minibasketIcon").unbind('mouseenter mouseleave');
                    return container.not(element);
                }
            }
        );
        $(".external").attr("target", "_blank");
        $('input.innerLabel').focus(function() {
            if (this.value == this.defaultValue){
                this.value = '';
            }
            if(this.value != this.defaultValue){
                this.select();
            }
        });

        $('input.innerLabel').blur(function() {
            if ($.trim($(this).val()).length==0) {
                this.value = (this.defaultValue);
            }
        });


        $(".flyout a.trigger").click(function(){
            $(".loginBox").show();
            return false;
        });

        $(document).click( function(e){
            if( $(e.target).parents("div").hasClass("popBox") || $(e.target).parents("div").hasClass("topPopList") ){
            }else{
                $(".popBox,.topPopList .flyoutBox").hide();
            }
        });

        $(document).keydown( function( e ) {
           if( e.which == 27) {
                $(".popBox,.topPopList .flyoutBox").hide();
           }
        });

        $(".selectedValue").click(function(){
            $(".flyoutBox").hide();
            $(this).nextAll(".flyoutBox").show();
            return false;
        });


        $("#checkAll").click(function(){
            toggleChecks(this);
        });


        function toggleChecks(){
            if ($("#checkAll").attr("checked")) {
                $(".basketitems .checkbox input").attr("checked", true);
                $("#checkAll").attr("checked", true);
                return;
            }
                $(".basketitems .checkbox input").attr("checked", false);
                $("#checkAll").attr("checked", false);
        };


        $("#basketRemoveAll").click(function(){
            $("#checkAll").click();
            toggleChecks();
            return false;
        });


        $("#paymentStep #orderStep").click(function(){
            $(".order").attr("submit", true);
        });


        /*
         * Toggling payment info on selecting payment
         */
        $("#payment dl dt input[type=radio]").click(function(){
            $("#payment dd").hide();
            $(this).parents("dl").children("dd").toggle();
        });


        /*
        * Minibasket flyout
        */
        var timeout;
        if ($("#miniBasket ul").length > 0) {
            $("#miniBasket img.minibasketIcon").hover(function(){
                timeout = setTimeout(function(){
                    $(".basketFlyout").show();
                    if ($(".scrollable ul").length > 0) {
                        $('.scrollable ul').jScrollPane({
                            showArrows: true,
                            verticalArrowPositions: 'split'
                        });
                    }
                }, 300);
            }, function(){
                clearTimeout(timeout);
            });
        }

        if ($("#compareDataDiv").length) {
            $("#compareDataDiv").jScrollPane({
                                showArrows: true,
                                horizontalGutter: 0
            });
        }

        $(".closePop").live("click", function(){
            $(".basketFlyout").hide();
            $(".popupBox").hide().dialog("close");
            clearTimeout(timeout);

            return false;
        });

        $(".altLoginBox .fb_button").live("click", function(){
            $("#loginBox").hide();
        });

        /*
         * Show/hide list dropdowns
         */
        function showDropdown(){

            hideDropdown();
            targetObj = $(this);
            sublist = targetObj.nextAll("ul.drop");

            sublist.prepend("<li class='value'></li>");
            targetObj.clone().appendTo(".value", sublist);
            sublist.css("width", targetObj.parent().outerWidth());

            if (sublist.length) {
                //console.log(sublist.length);
                sublist.slideToggle("fast");
                targetObj.toggleClass("selected");
            }
        }


        function hideDropdown(){
            $("ul.drop").hide();
            $("ul.drop li.value").remove();
            $(".dropDown p").removeClass("selected");
        }

        $(".dropDown p").click(showDropdown);

        $(document).click( function(e){
            var clickTarget = e.target;
            if($(clickTarget).parents().hasClass("dropDown")){
            }else{
                $(".drop").hide();
            }
        });

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
        })

        /*
         * Show/hide item details on grid list
         */

         $(".gridView li").hover(function (){
             $(".listDetails", this).show();
         }, function(){
             $(".listDetails", this).hide();
         });

        /*
         *  Overlay popup
         */

         function initOverlay(target, w, h) {
            $(target).dialog({
                    width: w,
                    modal: true,
                    resizable: true,
                    open: function(event, ui) {
                    $('div.ui-dialog-titlebar').css("visibility", "hidden");
                }
            });
         }

         $(".closeOverlay").click(function(){
            $(".overlayPop").dialog("close");
            return false;
         });


         /*
          * Wraping selection, overlayPopup window
          */

         $("#wrapp li, #wrappCard li").click(function(){
            $(this).children("input[type=radio]").attr("checked", true);
         });


        /*$(".wrappingTrigger").click(function(){
            initOverlay(".wrapping", 687);
            return false;
        });*/

        $(".tabbedWidgetBox").tabs();

        $("#writeNewReview").click(function(){
            $("#writeReview").slideToggle();
            $("#writeNewReview").hide();
            return false;
        });

        /*
         * Remove item from list
         */
        $(".removeButton").click(function(){
            var targetForm = $(this).attr("triggerForm");
            $("#"+targetForm).submit();
            return false;
        });


        /*
         * Equalize columns
         */
        function equalHeight(group, target, getAddHeight) {
            var tallest = 0;
            if (target) {
                if (group.height() < target.height()){
                    group.css("height", target.height());
                }
            } else {

                group.each(function(){
                    var thisHeight = $(this).height();
                    if (thisHeight > tallest) {
                        tallest = thisHeight;
                    }
                });
                group.height(tallest);
            }
        }

        equalHeight($("#panel dl"));
        equalHeight($(".sidebarMenu"), $("#content"));
        equalHeight($(".subcatList li .content"));
        equalHeight($(".checkoutOptions .option"));




       /* Show all items hover */
      $(".linkAll").hover(function(){
          var targetObj = $(this).children(".viewAllHover");
          targetObj.show();
          var targetObjMargin = targetObj.width() / 2;
          targetObj.css("margin-left", "-" + targetObjMargin + "px");
      }, function(){
          $(".viewAllHover").hide();
      });

     /* More pictures marker*/

     $(".otherPictures li a").click(function(){
        $(".otherPictures li a").removeClass("selected");
        $(this).addClass("selected");
        return false;
     });

     $("#zoomModal li a").click(function(){
        $("#zoomImg").attr("src", $(this).attr("href"));
        return false;
     });

     $(".cloud-zoom").click(function(){
        return false;
     });

    $("#zoomImg").click(function(){

        var oPaging     = $(".zoomPager");
        var iImgCount   = $(".zoomPager li").size();
        var iCurImgNo   = $(".selected", oPaging).text();

        if ( $(".selected", oPaging).length == 0 ) {
            iCurImgNo = 1;
            $(".zoomPager li:first").children("a").addClass('selected');
        }

        var sFirstImage = $(".zoomPager li:first").children("a").attr("href");
        var sNextImage  = $(".selected", oPaging).parent().next().children("a").attr("href");
        var oCurPage    = $(".selected", oPaging);
        var oNextPage   = $(".selected", oPaging).parent().next().children();
        var oLastPage   = $(".zoomPager li:last").children("a");
        var oFirstPage  = $(".zoomPager li:first").children("a");

        if( iCurImgNo == iImgCount ) {
            $("#zoomImg").attr("src", sFirstImage);
            oLastPage.removeClass('selected');
            oFirstPage.addClass('selected');
        } else {
            $("#zoomImg").attr("src", sNextImage);
            oCurPage.removeClass('selected');
            oNextPage.addClass('selected');
        }

        return false;
     });


     /* Vertical box positioning*/
    $(".specBoxInfo").hover(function(){
        var boxHeight = $(".hoverBox", $(this)).height();
        var boxTarget = $(".hoverInfo", $(this));
        var addHoverPadding = (boxHeight - boxTarget.height()) / 2;
        boxTarget.css("padding-top", addHoverPadding);
    });

    if($("#newItemMsg").length > 0){
        $("#countValue").hide();
        $("#newItemMsg").delay(3000).fadeTo("fast", 0, function(){
            $("#countValue").fadeTo("fast", 1);
            $("#newItemMsg").remove()
        });
    }

    if ($("#productTitle").length > 0) {
        var targetWidth = $("#productTitle span").width();
        if (targetWidth > 220) {
            var linkboxWidth = $("#productTitle span").width();
        }
        else {
            var linkboxWidth = 220;
        }
        var targetHeight = $("#productTitle span").height();


        $(".actionLinks").css({
            "top": $("#productTitle").position().top - 7,
            "left": $("#productTitle").position().left - 10,
            "padding-top": targetHeight + 10,
            "width": linkboxWidth + 50
        });

        var arrowSrc = $(".selector img").attr("src");
        var arrow = $("#productLinks").children("img");
        function showLinks() {
            var arrowOnSrc = arrow.attr("longdesc");
            $(".actionLinks").slideDown("normal", function(){
                arrow.attr("src", arrowOnSrc);
            });
        }
        function hideLinks() {
            $(".actionLinks").animate({
                height: 0,
                opacity: 0.1
            }, 300, function(){
                $(".actionLinks").hide().css({
                    height: 'auto',
                    opacity: '1'
                });
                arrow.attr("src", arrowSrc);
            });
        }

        $("#productLinks").css({
            "top": $("#productTitle").position().top - 3,
            "left": targetWidth + $("#productTitle").position().left + 10
        }).click(function(){
            $(this).toggleClass("selected");
            if ($(this).hasClass("selected")) {
                showLinks();
            }
            else {
                hideLinks();
            }
            return false;
        });
        $("#productLinks").hover(function() {
            showLinks();
        });
        $(".actionLinks").mouseleave( function() {
            hideLinks();
        });
        if ($("#showLinksOnce").length > 0) {
            $(".actionLinks").slideDown('normal').delay(1000).slideUp('normal', function(){
                 setCookie('showlinksonce', 1);
            });
        }
    }

    if ($("#amountPrice").length > 0) {
        $(".pricePopup").css({
            "top": $("#amountPrice").position().top - 7,
            "left": $("#amountPrice").position().left - 10,
            "width": 220
        });

        var arrowSrc = $(".selector img").attr("src");

        $("#amountPrice").click(function(){
            var arrow = $(this).children("img");

            var arrowOnSrc = arrow.attr("longdesc");
            $(this).toggleClass("selected");
            if ($(this).hasClass("selected")) {
                $("#priceinfo").slideDown("normal", function(){
                    arrow.attr("src", arrowOnSrc);
                });
                $(".tobasketFunction .selector").css({
                    "left": $("#amountPrice").position().left,
                    "position": "absolute"
                });
            }
            else {
                $("#priceinfo").animate({
                    height: 0,
                    opacity: 0.1
                }, 300, function(){
                    $("#priceinfo").hide().css({
                        height: 'auto',
                        opacity: '1'
                    });
                    arrow.attr("src", arrowSrc);
                });
                $(".tobasketFunction .selector").css({
                    "position": "static"
                });
            }
            return false;
        });
    }
    var msgCookie = 'msgstatus';
    if (getCookie(msgCookie) != '1') {
        setCookie(msgCookie);
    }

    $(".dismiss").click(function(){
        $("#versionNote").fadeOut("slow", function(){
            $(this).remove();
        });
        setCookie(msgCookie, 1);
    });


    $(".priceAlarmLink").click(function(){
        var $tabs = $('.tabbedWidgetBox').tabs();
        $tabs.tabs('select', '#pricealarm');
    });

    $('#addressId').change(function() {
        $( ".oxValidate" ).unbind('submit');
        var reload = '2';
        var selectValue = $(this).val();
        if (selectValue === '-1') {
            reload = '1';
        }
        if ($("input[name=reloadaddress]")) {
            $("input[name=reloadaddress]").val(reload);
        }
        if (selectValue !== '-1') {
            $("form[name='order'] input[name=cl]").val($("input[name=changeClass]").val());
            $("form[name='order'] input[name=fnc]").val("");
            $("form[name='order']").submit();
        } else {
            $("input:text").filter(function() {
                return this.name.match(/address__/);
            }).val("");
            $('#shippingAddressForm').show();
            $('#shippingAddressText').hide();
            $("select[name='deladr[oxaddress__oxcountryid]']").children("option").attr("selected", null);
            $("select[name='deladr[oxaddress__oxstateid]']").children("option[name='promtString']").attr("selected", "selected");
        }
    });

    $('select[id^=sellist]').change (function() {
        var oSelf = $(this);
        var oNoticeList = $('#linkToNoticeList');
        if ( oNoticeList ) {
            oNoticeList.attr('href', oNoticeList.attr('href') + "&" + oSelf.attr('name') + "&" + oSelf.val());
        }
        var oWishList = $('#linkToWishList');
        if ( oWishList ) {
            oWishList.attr('href', oWishList.attr('href') + "&" + oSelf.attr('name') + "&" + oSelf.val());
        }
    });
    $(".tagCloud #tagText").click(highTag);
    $("#saveTag").click(saveTag);
    $("#cancelTag").click(cancelTag);
    $("#editTag").click(editTag);

    function highTag(){
        var oSelf = $(this);
        $(".tagError").hide();

        url = '', data = {};
        $.each($('#tagsForm').serializeArray(), function(i, f) {data[f.name] = f.value;});
        data['highTags'] = oSelf.prev().text();
        url = $('#tagsForm').attr('action');
        $.ajax({
            url: url, type: 'post', data: data,
            success: function() {
                oSelf.prev().addClass('taggedText');
                oSelf.hide();
            }
        });
        return false;
    };

    function saveTag(){
        var oSelf = $(this);
        $(".tagError").hide();

        url = '', data = {};
        $.each($('#tagsForm').serializeArray(), function(i, f) {data[f.name] = f.value;});
        url = $('#tagsForm').attr('action');
        data["blAjax"] = "1";
        $.ajax({
            url: url, type: 'post', data: data,
            success: function(response) {
                if ( response ) {
                    $(".tagCloud").append("<span class='taggedText'>" + data["newTags"] + "</span> ");
                } else {
                    $(".tagError").show();
                }
            }
        });
        return false;
    };

    function cancelTag(){
        var oSelf = $(this);

        url = '', data = {};
        $.each($('#tagsForm').serializeArray(), function(i, f) {data[f.name] = f.value;});
        url = $('#tagsForm').attr('action');
        data["blAjax"] = "1";
        data["fnc"] = "cancelTags";
        $.ajax({
            url: url, type: 'post', data: data,
            success: function(response) {
                if ( response ) {
                    $('#tags').html(response);
                    $("#tags #editTag").click(editTag);
                }
            }
        });
        return false;
    };

    function editTag(){
        var oSelf = $(this);
        url = '', data = {};
        $.each($('#tagsForm').serializeArray(), function(i, f) {data[f.name] = f.value;});
        url = $('#tagsForm').attr('action');
        data["blAjax"] = "1";
        $.ajax({
            url: url, type: 'post', data: data,
            success: function(response) {
                if ( response ) {
                    $('#tags').html(response);
                    $("#tags #tagText").click(highTag);
                    $('#tags #saveTag').click(saveTag);
                    $('#tags #cancelTag').click(cancelTag);
                }
            }
        });
        return false;
    };

});