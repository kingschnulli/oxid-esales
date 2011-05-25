[{oxscript include="js/widgets/oxmodalpopup.js" priority=10 }]
[{oxscript add="$( '.wrappingTrigger' ).oxModalPopup({ target: '.wrapping'});"}]
<div class="wrapping popupBox corners FXgradGreyLight glowShadow overlayPop">
    <img src="[{$oViewConf->getImageUrl()}]x.png" alt="" class="closePop">
    [{assign var="currency" value=$oView->getActCurrency() }]
    <div class="wrappingIntro clear">
        <h3>[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_GIFTOPTION" }]</h3>
        <img src="[{$oViewConf->getImageUrl()}]gift-wrapping.jpg" alt="[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_ADDWRAPPING" }]">
        <div class="introtext">
            [{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_PERSONALMESSAGE" }]
        </div>
    </div>
    <h3 class="blockHead">[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_ADDWRAPPING" }]</h3>

[{ if !$oxcmp_basket->getProductsCount()  }]
    <div class="msg">[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_BASKETEMPTY" }]</div>
[{else}]
    <form name="basket" action="[{ $oViewConf->getSelfActionLink() }]" method="post">
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="wrapping">
        <input type="hidden" name="fnc" value="changewrapping">
        [{ assign var="oWrapList" value=$oView->getWrappingList() }]
        [{if $oWrapList->count() }]
            [{* basket items *}]
            [{assign var="icounter" value="0"}]
            <table class="wrappingData">
                <colgroup>
                    <col width="150">
                    <col width="170">
                    <col width="640">
                </colgroup>
                [{assign var="basketitemlist" value=$oView->getBasketArticles()}]
                [{foreach key=basketindex from=$oxcmp_basket->getContents() item=basketitem name=wrappArt}]
                    [{assign var="basketproduct" value=$basketitemlist.$basketindex }]
                    <tr>
                        <td>
                            <a href="[{ $basketproduct->getLink()}]">
                                <img src="[{$basketproduct->getThumbnailUrl() }]" alt="[{ $basketproduct->oxarticles__oxtitle->value|strip_tags }]">
                            </a>
                        </td>
                        <td>
                            <a rel="nofollow" href="[{ $basketproduct->getLink()}]">[{ $basketproduct->oxarticles__oxtitle->value }][{ if $basketproduct->oxarticles__oxvarselect->value}], [{ $basketproduct->oxarticles__oxvarselect->value}][{/if}]</a>
                        </td>

                        <td>
                            <ul id="wrapp_[{$smarty.foreach.wrappArt.iteration}]">
                                <li>
                                    <input class="radiobox" type="radio" name="wrapping[[{$basketindex}]]" value="0" [{ if !$basketitem->getWrappingId()}]CHECKED[{/if}]>
                                    <label>[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_NONE" }]</label><strong>0,00 [{ $currency->sign}]</strong>
                                </li>
                                [{assign var="ictr" value="1"}]
                                [{foreach from=$oView->getWrappingList() item=wrapping name=Wraps}]
                                    <li>
                                        <input class="radiobox" type="radio" name="wrapping[[{$basketindex}]]" value="[{$wrapping->oxwrapping__oxid->value}]" [{ if $basketitem->getWrappingId() == $wrapping->oxwrapping__oxid->value}]CHECKED[{/if}]>
                                        <span><img src="[{$wrapping->getPictureUrl()}]0/[{$wrapping->oxwrapping__oxpic->value}]" alt="[{$wrapping->oxwrapping__oxname->value}]"></span>
                                        <label>[{$wrapping->oxwrapping__oxname->value}]</label>
                                        <strong>[{$wrapping->getFPrice()}] [{ $currency->sign}]</strong>
                                    </li>
                                    [{assign var="ictr" value="`$ictr+1`"}]
                                [{/foreach}]
                            </ul>
                        </td>
                    </tr>
                    [{assign var="icounter" value="`$icounter+1`"}]
                [{/foreach}]
            </table>
        [{/if}]

        [{assign var="oCardList" value=$oView->getCardList()}]
        [{if $oCardList->count()}]
            <h3 class="blockHead">[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_GREETINGCARD" }]</h3>
            <ul class="wrappingCard clear" id="wrappCard">
                <li>
                    <p class="clear">
                        <input type="radio" class="radiobox" name="chosencard" value="0" [{ if !$oxcmp_basket->getCardId() }]CHECKED[{/if}]>
                        <label>[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_NOGREETINGCARD" }]</label>
                    </p>
                </li>
            [{assign var="icounter" value="0"}]
            [{counter start=0 print=false}]
            [{assign var="icounter" value="0"}]
            [{foreach from=$oCardList item=card name=GreetCards}]
                <li>
                    <p class="clear">
                        <input class="radiobox" type="radio" name="chosencard" value="[{$card->oxwrapping__oxid->value}]" [{ if $oxcmp_basket->getCardId() == $card->oxwrapping__oxid->value}]CHECKED[{/if}]>
                        <label>[{$card->oxwrapping__oxname->value}] <strong>[{$card->getFPrice() }] [{ $currency->sign}]</strong></label>
                    </p>
                    <img src="[{$card->getPictureUrl()}]0/[{$card->oxwrapping__oxpic->value}]" alt="[{$card->oxwrapping__oxname->value}]">
                </li>
            [{assign var="icounter" value="`$icounter+1`"}]
            [{/foreach}]
            </ul>
            <div class="wrappingComment">
                <label>[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_GREETINGMESSAGE" }]</label>
                <textarea cols="102" style="background:#fff; z-index:99999;" rows="5" name="giftmessage" class="areabox">[{$oxcmp_basket->getCardMessage()}]</textarea>
            </div>
        [{/if}]
        <div class="submitForm clear">
            <button type="submit" style="white-space:nowrap;" class="submitButton largeButton">[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_BACKTOORDER" }]</button>
            <button type="submit" class="textButton largeButton closeOverlay">[{ oxmultilang ident="PAGE_CHECKOUT_WRAPPING_CANCEL" }]</button>
        </div>
    </form>
[{/if}]
</div>
[{ insert name="oxid_tracker" title=$template_title }]