[{assign var="currency" value=$oView->getActCurrency()}]
[{if $showMainLink}]
    [{assign var='_productLink' value=$product->getMainLink()}]
[{else}]
    [{assign var='_productLink' value=$product->getLink()}]
[{/if}]
[{if $type eq "grid"}]

        [{capture name=product_price}]
            [{oxhasrights ident="SHOWARTICLEPRICE"}]
                [{if $product->getFTPrice()}]
                <div class="old-price ">
                    <span class="old">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REDUCEDFROM" }] <del>[{ $product->getFTPrice()}] [{ $currency->sign}]</del></span>
                    [{*<span class="only">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_NOWONLY" }]</span>*}]
                </div>
                [{/if}]
                [{if $product->getFPrice()}]
                  <strong>[{ $product->getFPrice() }] [{ $currency->sign}]</strong>
                [{/if}]
            [{/oxhasrights}]
        [{/capture}]

        <div class="listDetails">
            <div class="titleBox">
                <a href="[{$_productLink}]" class="title fx-shadow-top fn" title="[{ $product->oxarticles__oxtitle->value}]">
                    [{ $product->oxarticles__oxtitle->value }]
                </a>
            </div>
            <div class="priceBox bottomShadow">
                [{oxhasrights ident="TOBASKET"}]
                [{ if !$product->isNotBuyable()}]
                    [{$smarty.capture.product_price}]
                    [{if $product->hasMdVariants() || $product->getDispSelList()}]
                        <a href="[{ $_productLink }]" >[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
                    [{else}]
                        [{assign var="actCategory" value=$oView->getActiveCategory()}]
                        [{assign var="listType" value=$oView->getListType()}]
                        <a href="[{$actCategory->getLink()|oxaddparams:"listtype=`$listType`&amp;fnc=tobasket&amp;aid=`$product->oxarticles__oxid->value`&amp;am=1" }]" class="toCart" title="[{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ADDTOCART" }]">[{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ADDTOCART" }]</a>
                    [{/if}]
                    [{oxifcontent ident="oxdeliveryinfo" object="oCont"}]
                            <span class="deliveryInfo">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_PLUSSHIPPING" }]<a href="[{ $oCont->getLink() }]" rel="nofollow">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_PLUSSHIPPING2" }]</a></span>
                    [{/oxifcontent}]
                [{/if}]
                [{/oxhasrights}]
            </div>
        </div>
    <a class="sliderHover" href="[{$_productLink}]"></a>
    <img src="[{$product->getThumbnailUrl()}]" alt="[{ $product->oxarticles__oxtitle->value }]">


[{elseif $type eq "infogrid"}]


    [{capture name=product_price}]
        [{oxhasrights ident="SHOWARTICLEPRICE"}]
            [{if $product->getFTPrice()}]
            <div class="old-price ">
                <span class="old">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REDUCEDFROM" }] <del>[{ $product->getFTPrice()}] [{ $currency->sign}]</del></span>
            </div>
            [{/if}]
            [{if $product->getFPrice()}]
                <strong>[{ $product->getFPrice() }] [{ $currency->sign}]</strong>
            [{/if}]
        [{/oxhasrights}]
    [{/capture}]


    <a href="[{$_productLink}]" class="gridPicture">
        <img src="[{$product->getThumbnailUrl()}]" alt="[{ $product->oxarticles__oxtitle->value }]">
    </a>

    <form name="tobasket[{$testid}]" action="[{ $oViewConf->getSelfActionLink() }]" method="post">
        <div class="listDetails">
            [{oxhasrights ident="TOBASKET"}]
                [{ if !$product->isNotBuyable()}]
            [{ $oViewConf->getHiddenSid() }]
            [{ $oViewConf->getNavFormParams() }]
            <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
            [{if $owishid}]
                <input type="hidden" name="owishid" value="[{$owishid}]">
            [{/if}]
            [{if $toBasketFunction}]
                <input type="hidden" name="fnc" value="[{$toBasketFunction}]">
            [{else}]
              <input type="hidden" name="fnc" value="tobasket">
            [{/if}]
            <input type="hidden" name="aid" value="[{ $product->oxarticles__oxid->value }]">
            [{if $altproduct}]
                <input type="hidden" name="anid" value="[{ $altproduct }]">
            [{else}]
                <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
            [{/if}]
            [{if $recommid}]
                <input type="hidden" name="recommid" value="[{ $recommid }]">
            [{/if}]
            <input type="hidden" name="pgNr" value="[{ $oView->getActPage() }]">
            <input type="hidden" name="am" value="1">
            [{/if}]
        [{/oxhasrights}]
            <div class="titleBox">
                <a href="[{$_productLink}]" class="title fn" title="[{ $product->oxarticles__oxtitle->value}]">
                    [{ $product->oxarticles__oxtitle->value }]
                </a>
            </div>
            <div class="priceBox">
                        [{$smarty.capture.product_price}]
                        [{oxhasrights ident="TOBASKET"}]
                [{ if !$product->isNotBuyable()}]
                    [{ if $product->hasMdVariants() || $product->getDispSelList() }]
                        <a class="submitButton" href="[{ $_productLink }]" >[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
                    [{else}]
                        <button type="submit" class="submitButton largeButton">[{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ADDTOCART" }]</button>
                    [{/if}]

                    [{oxifcontent ident="oxdeliveryinfo" object="oCont"}]
                        <br>
                        <span class="deliveryInfo">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_PLUSSHIPPING" }]<a href="[{ $oCont->getLink() }]" rel="nofollow">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_PLUSSHIPPING2" }]</a></span>
                    [{/oxifcontent}]
                [{/if}]
                        [{/oxhasrights}]
            </div>
        </div>
    </form>

[{elseif $type eq "line"}]
    <form name="tobasket.[{$testid}]" action="[{ $oViewConf->getSelfActionLink() }]" method="post">
        <div class="pictureBox">
            <a href="[{$_productLink}]" class="title" title="[{ $product->oxarticles__oxtitle->value}]">
                <img src="[{$product->getThumbnailUrl()}]" alt="[{ $product->oxarticles__oxtitle->value}]">
            </a>
        </div>
        <div class="infoBox">
            <div class="info">
                <a href="[{$_productLink}]" class="title" title="[{ $product->oxarticles__oxtitle->value}]">[{ $product->oxarticles__oxtitle->value }]</a>
                <span class="productNr">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_NR" }] [{ $product->oxarticles__oxartnum->value }]</span>
                [{if $recommid }]
                    <div>[{ $product->text }]</div>
                [{/if}]
                <div class="variants">
                    [{oxhasrights ident="TOBASKET"}]
                        [{ if !$product->isNotBuyable()}]
                    [{ $oViewConf->getHiddenSid() }]
                    [{ $oViewConf->getNavFormParams() }]
                    <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
                    [{if $owishid}]
                        <input type="hidden" name="owishid" value="[{$owishid}]">
                    [{/if}]
                    [{if $toBasketFunction}]
                        <input type="hidden" name="fnc" value="[{$toBasketFunction}]">
                    [{else}]
                        <input type="hidden" name="fnc" value="tobasket">
                    [{/if}]
                    <input type="hidden" name="aid" value="[{ $product->oxarticles__oxid->value }]">
                    [{if $altproduct}]
                        <input type="hidden" name="anid" value="[{ $altproduct }]">
                    [{else}]
                        <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
                    [{/if}]
                    [{if $recommid}]
                        <input type="hidden" name="recommid" value="[{ $recommid }]">
                    [{/if}]
                    <input type="hidden" name="pgNr" value="[{ $oView->getActPage() }]">
                    <input id="am_[{$testid}]" type="hidden" name="am" value="1">
                        [{/if}]
                    [{/oxhasrights}]
                    [{if $product->getVariantList()}]
                        <label>[{ $product->oxarticles__oxvarname->value }]:</label>
                        [{if $product->hasMdVariants() }]
                            <select id="mdVariant_[{$testid}]" name="mdVariant_[{$testid}]">
                                [{if !$product->isParentNotBuyable()}]
                                    <option value="[{$product->getId()}]">[{ $product->oxarticles__oxvarselect->value }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $product->getFPrice() }] [{ $currency->sign|strip_tags}]*[{/oxhasrights}]</option>
                                [{/if}]
                                [{foreach from=$product->getMdSubvariants() item=mdVariant}]
                                    <option value="[{$mdVariant->getLink()}]">[{ $mdVariant->getName() }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $mdVariant->getFPrice()|strip_tags }]* [{/oxhasrights}]</option>
                                [{/foreach}]
                            </select>
                        [{else}]
                            <select id="varSelect-[{$testid}]" name="aid">
                                [{if !$product->isParentNotBuyable()}]
                                    <option value="[{$product->getId()}]">[{ $product->oxarticles__oxvarselect->value }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $product->getFPrice() }] [{ $currency->sign|strip_tags}]*[{/oxhasrights}]</option>
                                [{/if}]
                                [{foreach from=$product->getVariantList() item=variant}]
                                    <option value="[{$variant->getId()}]">[{ $variant->oxarticles__oxvarselect->value }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $variant->getFPrice() }] [{ $currency->sign|strip_tags}]* [{/oxhasrights}]</option>
                                [{/foreach}]
                            </select>
                        [{/if}]
                    [{elseif $product->getDispSelList()}]
                        [{foreach key=iSel from=$product->getDispSelList() item=oList}]
                            <label>[{ $oList.name }]:</label>
                            <select id="sellist-[{$testid}]_[{$iSel}]" name="sel[[{$iSel}]]">
                                [{foreach key=iSelIdx from=$oList item=oSelItem}]
                                    [{ if $oSelItem->name }]
                                        <option value="[{$iSelIdx}]"[{if $oSelItem->selected }]SELECTED[{/if }]>[{ $oSelItem->name }]</option>
                                    [{/if}]
                                [{/foreach}]
                            </select>
                        [{/foreach}]
                    [{/if}]
                </div>
            </div>
            <div class="description">
                [{oxhasrights ident="SHOWSHORTDESCRIPTION"}]
                [{$product->oxarticles__oxshortdesc->value|truncate:160:"..."}]
                [{/oxhasrights}]
            </div>
        </div>
        <div class="functions">
                [{oxhasrights ident="SHOWARTICLEPRICE"}]
                    [{if $product->getFTPrice()}]
                        <p class="oldPrice">
                            <strong>[{oxmultilang ident="DETAILS_REDUCEDFROM"}] <del>[{$product->getFTPrice()}] [{$currency->sign}]</del></strong>
                            <span>[{oxmultilang ident="DETAILS_REDUCEDTEXT"}]</span>
                        </p>
                    [{/if}]
                [{/oxhasrights}]
                <div class="tobasketFunction clear">
                    [{oxhasrights ident="SHOWARTICLEPRICE"}]
                    <label id="productPrice-[{$testid}]" class="price">
                        [{if $product->getFTPrice()}]
                            [{oxmultilang ident="DETAILS_NOWONLY"}]
                        [{/if}]
                        <strong>[{$product->getFPrice()}] [{$currency->sign}]</strong>
                    </label>
                    [{/oxhasrights}]
                    [{oxhasrights ident="TOBASKET"}]
                    [{ if !$product->isNotBuyable() }]
                        [{if $product->getVariantList() }]
                            [{if $product->hasMdVariants()}]
                                <a class="submitButton" href="[{ $_productLink }]" >[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
                            [{else}]
                                <input id="amountToBasket-[{$testid}]" type="text" name="am" value="1" size="3" autocomplete="off" class="textbox">
                                <button id="toBasket-[{$testid}]" type="submit" class="submitButton largeButton" title="[{oxmultilang ident="DETAILS_ADDTOCART"}]">[{oxmultilang ident="DETAILS_ADDTOCART"}]</button>
                            [{/if}]
                        [{else}]
                            <input id="amountToBasket-[{$testid}]" type="text" name="am" value="1" size="3" autocomplete="off" class="textbox">
                            <button id="toBasket-[{$testid}]" type="submit" class="submitButton largeButton" title="[{oxmultilang ident="DETAILS_ADDTOCART"}]">[{oxmultilang ident="DETAILS_ADDTOCART"}]</button>
                        [{/if}]
                    [{/if}]
                    [{/oxhasrights}]
                    [{if $removeFunction && (($owishid && ($owishid==$oxcmp_user->oxuser__oxid->value)) || (($wishid==$oxcmp_user->oxuser__oxid->value)) || $recommid) }]
                        <button triggerForm="remove-[{$removeFunction}][{$testid}]" type="submit" class="submitButton largeButton removeButton" title="[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REMOVE" }]"><span>[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REMOVE" }]</span></button>
                    [{/if}]
                </div>
                </div>
    </form>
    [{if $removeFunction && (($owishid && ($owishid==$oxcmp_user->oxuser__oxid->value)) || (($wishid==$oxcmp_user->oxuser__oxid->value)) || $recommid) }]
        <form action="[{ $oViewConf->getSelfActionLink() }]" method="post" id="remove-[{$removeFunction}][{$testid}]">
            <div>
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
                <input type="hidden" name="fnc" value="[{$removeFunction}]">
                <input type="hidden" name="aid" value="[{$product->oxarticles__oxid->value}]">
                <input type="hidden" name="am" value="0">
                <input type="hidden" name="itmid" value="[{$product->getItemKey()}]">
                [{if $recommid}]
                    <input type="hidden" name="recommid" value="[{$recommid}]">
                [{/if}]
            </div>
        </form>
    [{/if}]
[{/if}]