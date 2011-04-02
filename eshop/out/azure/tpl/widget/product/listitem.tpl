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
            <span class="old-price ">
                <span class="old">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REDUCEDFROM" }] <del>[{ $product->getFTPrice()}] [{ $currency->sign}]</del></span>
            </span>
            [{/if}]
            [{if $product->getFPrice()}]
                <strong>[{ $product->getFPrice() }] [{ $currency->sign}][{if !($product->hasMdVariants() || $product->getDispSelList() || $product->getVariantList())}] *[{/if}]</strong>
            [{/if}]
                    [{ if $product->getPricePerUnit()}]
                        <span id="productPricePerUnit_[{$testid}]" class="pricePerUnit">
                            [{$product->oxarticles__oxunitquantity->value}] [{$product->oxarticles__oxunitname->value}] | [{$product->getPricePerUnit()}] [{ $currency->sign}]/[{$product->oxarticles__oxunitname->value}]
                        </span>
                    [{elseif $product->oxarticles__oxweight->value  }]
                        <span id="productPricePerUnit_[{$testid}]" class="pricePerUnit">
                            <span class="type" title="weight">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ARTWEIGHT" }]</span>
                            <span class="value">[{ $product->oxarticles__oxweight->value }] [{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ARTWEIGHT2" }]</span>
                        </span>
                    [{/if }]
            [{/oxhasrights}]
    [{/capture}]
    <a id="[{$testid}]" href="[{$_productLink}]" class="titleBlock title fn" title="[{ $product->oxarticles__oxtitle->value}]">
        [{ $product->oxarticles__oxtitle->value }]
        <div class="gridPicture"><img src="[{$product->getThumbnailUrl()}]" alt="[{ $product->oxarticles__oxtitle->value }]"></div>
    </a>
    <div class="priceBlock">
        [{oxhasrights ident="TOBASKET"}]
        [{ if !$product->isNotBuyable()}]
            [{$smarty.capture.product_price}]
            [{if $product->hasMdVariants() || $product->getDispSelList() || $product->getVariantList()}]
                <a href="[{ $_productLink }]" class="toCart button">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
            [{else}]
                [{assign var="listType" value=$oView->getListType()}]
                <a href="[{$oView->getLink()|oxaddparams:"listtype=`$listType`&amp;fnc=tobasket&amp;aid=`$product->oxarticles__oxid->value`&amp;am=1" }]" class="toCart button" title="[{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ADDTOCART" }]">[{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ADDTOCART" }]</a>
            [{/if}]
        [{/if}]
        [{/oxhasrights}]
    </div>
    </a>

[{elseif $type eq "infogrid"}]

    <form name="tobasket[{$testid}]" action="[{ $oViewConf->getSelfActionLink() }]" method="post">

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

        <a href="[{$_productLink}]" class="gridPicture">
            <img src="[{$product->getThumbnailUrl()}]" alt="[{ $product->oxarticles__oxtitle->value }]">
        </a>
        <div class="listDetails">
            <div class="titleBox">
                <a id="[{$testid}]" href="[{$_productLink}]" class="title fn" title="[{ $product->oxarticles__oxtitle->value}]">
                    [{ $product->oxarticles__oxtitle->value }]
                </a>
            </div>
            <div class="variantBox">
                [{* ====== To Do =============== DEV PLACE ======================= }]
                    <div class="variantSelecors clear">
                         <div class="dropDown" id="aa">
                            <p class="selectorLabel underlined">
                                <label>Color: </label>
                                <span>Red</span>
                            </p>
                            <ul class="drop FXgradGreyLight shadow">
                                    <li><a rel="val0" href="#">[{ oxmultilang ident="WIDGET_PRODUCT_ATTRIBUTES_PLEASECHOOSE" }]</a></li>
                                    <li><a rel="val1" href="#" class="selected" >Red</a></li>
                                    <li><a rel="val2" href="#" >Blue</a></li>
                                    <li class="disabled"><a rel="val3" href="#" >Green</a></li>
                                    <li><a rel="val4" href="#" >Pink</a></li>
                            </ul>
                        </div>
                    </div>
             [{*    ============================================= *}]
            </div>
            <div class="priceBox">
                <div class="content">
                   [{* To do:  place for compare link }]
                      <a class="compare" href="#">VERGLEICHEN</a><br><br>
                   [{* ======================================= *}]
                    [{oxhasrights ident="SHOWARTICLEPRICE"}]
                    [{if $product->getFTPrice()}]
                        <span class="oldPrice">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REDUCEDFROM" }] <del>[{ $product->getFTPrice()}] [{ $currency->sign}]</del></span>
                    [{/if}]
                    [{if $product->getFPrice()}]
                        <span class="price">[{ $product->getFPrice() }] [{ $currency->sign}] [{if !($product->hasMdVariants() || $product->getDispSelList() || $product->getVariantList())}]*[{/if}]</span>
                    [{/if}]
                    [{ if $product->getPricePerUnit()}]
                        <span id="productPricePerUnit_[{$testid}]" class="pricePerUnit">
                            [{$product->oxarticles__oxunitquantity->value}] [{$product->oxarticles__oxunitname->value}] | [{$product->getPricePerUnit()}] [{ $currency->sign}]/[{$product->oxarticles__oxunitname->value}]
                        </span>
                    [{elseif $product->oxarticles__oxweight->value  }]
                        <span id="productPricePerUnit_[{$testid}]" class="pricePerUnit">
                            <span class="type" title="weight">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ARTWEIGHT" }]</span>
                            <span class="value">[{ $product->oxarticles__oxweight->value }] [{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ARTWEIGHT2" }]</span>
                        </span>
                    [{/if }]
                     [{/oxhasrights}]
                </div>

            </div>
            <div class="buttonBox">
                [{oxhasrights ident="TOBASKET"}]
                    [{ if !$product->isNotBuyable()}]
                        [{ if $product->hasMdVariants() || $product->getDispSelList() || $product->getVariantList() }]
                            <a class="submitButton" href="[{ $_productLink }]" >[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
                        [{else}]
                            <button type="submit" class="submitButton largeButton">[{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ADDTOCART" }]</button>
                        [{/if}]
                    [{/if}]
                [{/oxhasrights}]
            </div>
        </div>
    </form>

[{elseif $type eq "line"}]
    <form name="tobasket.[{$testid}]" action="[{ $oViewConf->getSelfActionLink() }]" method="post">
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

        <div class="pictureBox">
            <a href="[{$_productLink}]" class="title" title="[{ $product->oxarticles__oxtitle->value}]">
                <img src="[{$product->getThumbnailUrl()}]" alt="[{ $product->oxarticles__oxtitle->value}]">
            </a>
        </div>

        <div class="infoBox">
            <div class="info">
                <a id="[{$testid}]" href="[{$_productLink}]" class="title" title="[{ $product->oxarticles__oxtitle->value}]">[{ $product->oxarticles__oxtitle->value }]</a>
                [{* ====== To Do : variants md variants selections lists DEV PLACE ======================= }]
                    <div class="variantSelecors clear">
                         <div class="dropDown" id="aa">
                            <p class="selectorLabel underlined">
                                <label>Color: </label>
                                <span>Red</span>
                            </p>
                            <ul class="drop FXgradGreyLight shadow">
                                    <li><a rel="val0" href="#">[{ oxmultilang ident="WIDGET_PRODUCT_ATTRIBUTES_PLEASECHOOSE" }]</a></li>
                                    <li><a rel="val1" href="#" class="selected" >Red</a></li>
                                    <li><a rel="val2" href="#" >Blue</a></li>
                                    <li class="disabled"><a rel="val3" href="#" >Green</a></li>
                                    <li><a rel="val4" href="#" >Pink</a></li>
                            </ul>
                        </div>
                    </div>
                [{* ============================================= *}]

                <div class="variants">

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
                            <select id="varSelect_[{$testid}]" name="aid">
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
                            <select id="selList_[{$testid}]_[{$iSel}]" name="sel[[{$iSel}]]">
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
                [{if $recommid }]
                    <div>[{ $product->text|truncate:160:"..." }]</div>
                [{else}]
                    [{oxhasrights ident="SHOWSHORTDESCRIPTION"}]
                    [{$product->oxarticles__oxshortdesc->value|truncate:160:"..."}]
                [{/oxhasrights}]
                [{/if}]

            </div>
        </div>
        <div class="functions">
               [{* To do:  place for compare link }]
                  <a class="compare" href="#">VERGLEICHEN</a><br>
               [{* ======================================= *}]
               [{oxhasrights ident="SHOWARTICLEPRICE"}]
                    [{if $product->getFTPrice()}]
                        <span class="oldPrice">
                            [{oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REDUCEDFROM"}] <del>[{$product->getFTPrice()}] [{$currency->sign}]</del>
                        </span>
                    [{/if}]
                        <span id="productPrice_[{$testid}]" class="price">
                            [{$product->getFPrice()}] [{$currency->sign}] [{if !($product->hasMdVariants() || $product->getDispSelList() || $product->getVariantList())}]*[{/if}]
                        </span>
                    [{ if $product->getPricePerUnit()}]
                        <span id="productPricePerUnit_[{$testid}]" class="pricePerUnit">
                            [{$product->oxarticles__oxunitquantity->value}] [{$product->oxarticles__oxunitname->value}] | [{$product->getPricePerUnit()}] [{ $currency->sign}]/[{$product->oxarticles__oxunitname->value}]
                        </span>
                    [{elseif $product->oxarticles__oxweight->value  }]
                        <span id="productPricePerUnit_[{$testid}]" class="pricePerUnit">
                            <span class="type" title="weight">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ARTWEIGHT" }]</span>
                            <span class="value">[{ $product->oxarticles__oxweight->value }] [{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_ARTWEIGHT2" }]</span>
                        </span>
                    [{/if }]
                [{/oxhasrights}]
                <div class="tobasketFunction clear">
                    [{oxhasrights ident="TOBASKET"}]
                        [{ if !$product->isNotBuyable() }]
                            [{if $product->getVariantList() }]
                                [{if $product->hasMdVariants()}]
                                    <a class="submitButton" href="[{ $_productLink }]" >[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
                                [{else}]
                                    <input id="amountToBasket_[{$testid}]" type="text" name="am" value="1" size="3" autocomplete="off" class="textbox">
                                    <button id="toBasket_[{$testid}]" type="submit" class="submitButton largeButton" title="[{oxmultilang ident="DETAILS_ADDTOCART"}]">[{oxmultilang ident="DETAILS_ADDTOCART"}]</button>
                                [{/if}]
                            [{else}]
                                <input id="amountToBasket_[{$testid}]" type="text" name="am" value="1" size="3" autocomplete="off" class="textbox">
                                <button id="toBasket_[{$testid}]" type="submit" class="submitButton largeButton" title="[{oxmultilang ident="DETAILS_ADDTOCART"}]">[{oxmultilang ident="DETAILS_ADDTOCART"}]</button>
                            [{/if}]
                        [{/if}]
                    [{/oxhasrights}]
                    [{if $removeFunction && (($owishid && ($owishid==$oxcmp_user->oxuser__oxid->value)) || (($wishid==$oxcmp_user->oxuser__oxid->value)) || $recommid) }]
                        <button triggerForm="remove_[{$removeFunction}][{$testid}]" type="submit" class="submitButton largeButton removeButton" title="[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REMOVE" }]"><span>[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_REMOVE" }]</span></button>
                    [{/if}]
                </div>
           </div>
    </form>
    [{if $removeFunction && (($owishid && ($owishid==$oxcmp_user->oxuser__oxid->value)) || (($wishid==$oxcmp_user->oxuser__oxid->value)) || $recommid) }]
        <form action="[{ $oViewConf->getSelfActionLink() }]" method="post" id="remove_[{$removeFunction}][{$testid}]">
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