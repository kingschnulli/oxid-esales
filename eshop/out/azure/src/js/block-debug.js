$(window).load(function(){
    $("hr.debugBlocksStart").each(function(){
        var blockTitle = $(this).attr("title");
        var blockId    = $(this).attr("id");

        var _firstElement = $(this).next();
        while (_firstElement.hasClass('debugBlocksStart')) {
            _firstElement  = _firstElement.next();
        }

        var divLeft    = _firstElement.offset().left;
        var divRight   = _firstElement.offset().left+_firstElement.outerWidth();
        var divTop     = _firstElement.offset().top;
        var divBottom  = _firstElement.offset().top+_firstElement.outerHeight();

        var walker = function() {
            if (!($(this).hasClass('debugBlocksStart') || $(this).hasClass('debugBlocksEnd'))) {
                divLeft    = Math.min(divLeft,   $(this).offset().left);
                divRight   = Math.max(divRight,  $(this).offset().left+$(this).outerWidth());
                divTop     = Math.min(divTop,    $(this).offset().top);
                divBottom  = Math.max(divBottom, $(this).offset().top+$(this).outerHeight());
                $(this).children(':visible').each(walker);
            }
        };
        $(this).nextUntil("hr.debugBlocksEnd[title="+blockId+"]").filter(":visible").each(walker);

        var divWidth   = divRight - divLeft;
        var divHeight  = divBottom - divTop;
        var blockDiv   = $("<div class='tplDebugBlock' style='z-index:1001;background-color:rgba(200, 200, 200, 0.2)'>").html("<span id='"+blockId+"_title' style='z-index:1003;color:#fff;background-color:#444;background-color:rgba(0, 0, 0, 0.7);padding:2px 6px;'>Block: "+blockTitle+"</span>");

        blockDiv.attr('id', blockId+"_border");
        blockDiv.css({
                'position' : 'absolute',
                'top'      : divTop,
                'left'     : divLeft,
                'width'    : divWidth-4,
                'height'   : divHeight-4,
                'border'   : '1px dashed #a33',
                'padding'  : '2px 1px'
        });
        $("body").append(blockDiv);

        $("#"+blockId+"_title").hover(function(){
            $(this).css('z-index',1004);
            $(this).css('background-color', '#000');
            $("#"+blockId+"_border").css({
                'border':'2px solid #f00',
                'padding':'1px 0',
                'z-index': 1002
            });
        },function(){
            $(this).css('z-index',1003);
            try{
                $(this).css('background-color', 'rgba(0, 0, 0, 0.7)');
            }catch(err){
                $(this).css('background-color', '#444'); // for IE, as rgba will fail
            }

            $("#"+blockId+"_border").css({
                'border':'1px dashed #a33',
                'padding':'2px 1px',
                'z-index': 1001
            });
        });

    });
    $("body")
        .append($("<button>Toggle template debug blocks</button>")
        .css({
            'right'      : 0,
            'top'        : 0,
            'position'   : 'fixed',
            'background' : '#a33',
            'color'      : '#fff',
            'border'     : '1px solid #600',
            'padding'    : '3px 10px',
            'cursor'     : 'pointer',
            'width'      : '230px',
            'z-index'    : 1005
        })
        .click(function(){
            $('div.tplDebugBlock').toggle();
        })
        .hover(function(){
            $(this).css('background', '#533');
        },function(){
            $(this).css('background', '#a33');
        })
    );
});