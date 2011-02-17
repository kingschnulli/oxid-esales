$(function(){
    $("hr.debugBlocksStart").each(function(){
        var blockTitle = $(this).attr("title");
        var blockId    = $(this).attr("id");
        var endBlock   = $("hr.debugBlocksEnd[title="+blockId+"]");

        var _firstElement = $(this).next();
        var _lastElement  = endBlock.prev();
        while (_firstElement.hasClass('debugBlocksStart')) {
            _firstElement  = _firstElement.prev();
        }
        while (_lastElement.hasClass('debugBlocksEnd')) {
            _lastElement  = _lastElement.prev();
        }
        console.log(_firstElement);
        var divLeft    = Math.min(_firstElement.offset().left, _lastElement.offset().left);
        var divTop     = Math.min(_firstElement.offset().top, _lastElement.offset().top+_lastElement.outerHeight());
        var divHeight  = Math.max(_firstElement.offset().top, (_lastElement.offset().top+_lastElement.outerHeight())) - divTop;
        var divWidth   = Math.max(_firstElement.offset().left+_firstElement.outerWidth(), _lastElement.offset().left+_lastElement.outerWidth()) - divLeft;
        var blockDiv   = $("<div class='tplDebugBlock' style='z-index:1;background-color:rgba(200, 200, 200, 0.2)'>").html("<span id='"+blockId+"_title' style='z-index:3;color:#fff;background-color:#444;background-color:rgba(0, 0, 0, 0.7);padding:2px 6px;'>Block: "+blockTitle+"</span>");

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
            $(this).css('z-index',4);
            $(this).css('background-color', '#000');
            $("#"+blockId+"_border").css({
                'border':'2px solid #f00',
                'padding':'1px 0',
                'z-index': 2
            });
        },function(){
            $(this).css('z-index',3);
            try{
                $(this).css('background-color', 'rgba(0, 0, 0, 0.7)');
            }catch(err){
                $(this).css('background-color', '#444'); // for IE, as rgba will fail
            }

            $("#"+blockId+"_border").css({
                'border':'1px dashed #a33',
                'padding':'2px 1px',
                'z-index': 1
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
            'z-index'    : 4
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
