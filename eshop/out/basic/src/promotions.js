jQuery.fn.countdown = function(start) {
    if(jQuery(this).length == 0) return false;
    var rs = this;
    var go = false;
    var dt = new Date();

    if(start) {
        this.filter(':not(.promotionCurrent .activationtext .promoTimeout)').each(
            function(){
                var ms = this.innerHTML.split(':');
                var sc = Number(ms[0]) * 60 * 60 + Number(ms[1]) * 60 + Number(ms[2]);
                if(sc>1){
                    sc--;
                    dt.setTime(sc*1000);
                    var hh = dt.getUTCHours();   if(hh < 10){hh = '0'+hh;}
                    var mm = dt.getUTCMinutes(); if(mm < 10){mm = '0'+mm;}
                    var ss = dt.getUTCSeconds(); if(ss < 10){ss = '0'+ss;}
                    this.innerHTML = String( hh+":"+mm+":"+ss );
                    go = true;
                    if(sc<1800){
                        $(this).css('font-size', 'large');
                    }
                } else {
                    var promo = $(this).parents('div.promotion');
                    if (promo.hasClass('promotionFuture')) {
                        promo.removeClass( 'promotionFuture' );
                        promo.addClass( 'promotionCurrent' );
                    } else if (promo.hasClass('promotionCurrent')) {
                        promo.removeClass( 'promotionCurrent' );
                        promo.addClass( 'promotionFinished' );
                    }
                }
            }
        );
    }else{
        go = true;
    }
    if(go){
        window.setTimeout( function() {jQuery(rs).countdown(true);}, 1000);
    }
    return this;
};

$(document).ready(function(){
    $('div.promotionsRow .promotion .promoTimeout').countdown();
});
