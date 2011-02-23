<div class="compareItem">
    [{assign var="currency" value=$oView->getActCurrency()}]
    [{if $showMainLink}]
        [{assign var='_productLink' value=$product->getMainLink()}]
    [{else}]
        [{assign var='_productLink' value=$product->getLink()}]
    [{/if}]

    <a href="[{ $_productLink }]" class="picture url" rel="product[{if $oView->noIndex() }] nofollow[{/if}]">
      <img class="photo" src="[{if $size=='big'}][{$product->getPictureUrl(1) }][{elseif $size=='thinest'}][{$product->getIconUrl() }][{else}][{ $product->getThumbnailUrl() }][{/if}]" alt="[{ $product->oxarticles__oxtitle->value|strip_tags }] [{ $product->oxarticles__oxvarselect->value|default:'' }]">
    </a>

    <strong class="title">
        <a class="fn" href="[{ $_productLink }]" rel="product[{if $oView->noIndex() }] nofollow[{/if}]">[{$product->oxarticles__oxtitle->value}] [{$product->oxarticles__oxvarselect->value}]</a>
    </strong>
    <span class="identifier">
        [{if $product->oxarticles__oxweight->value }]
            <div>
                <span class="type" title="weight">[{ oxmultilang ident="PAGE_PRODUCT_INC_PRODUCT_ARTWEIGHT" }]</span>
                <span class="value">[{ $product->oxarticles__oxweight->value }] [{ oxmultilang ident="PAGE_PRODUCT_INC_PRODUCT_ARTWEIGHT2" }]</span>
            </div>
        [{/if}]
        <span class="type" title="sku">[{ oxmultilang ident="PAGE_PRODUCT_INC_PRODUCT_ARTNOMBER2" }]</span>
        <span class="value">[{ $product->oxarticles__oxartnum->value }]</span>
    </span>

    [{if $size=='thin' || $size=='thinest'}]
        <span class="flag [{if $product->getStockStatus() == -1}]red[{elseif $product->getStockStatus() == 1}]orange[{elseif $product->getStockStatus() == 0}]green[{/if}]">&nbsp;</span>
    [{/if}]

    <form name="tobasket.[{$testid}]" action="[{ $oViewConf->getSelfActionLink() }]" method="post">
        <div class="variants">
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

            [{ if $product->getVariantList()}]
              <label>[{ $product->oxarticles__oxvarname->value }]:</label>
              [{ if $product->hasMdVariants() }]
              <select id="mdVariant_[{$testid}]" name="mdVariant_[{$testid}]">
                [{ if !$product->isParentNotBuyable()}]
                  <option value="[{$product->getId()}]">[{ $product->oxarticles__oxvarselect->value }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $product->getFPrice() }] [{ $currency->sign|strip_tags}]*[{/oxhasrights}]</option>
                [{/if}]
                [{foreach from=$product->getMdSubvariants() item=mdVariant}]
                  <option value="[{$mdVariant->getLink()}]">[{ $mdVariant->getName() }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $mdVariant->getFPrice()|strip_tags }]* [{/oxhasrights}]</option>
                [{/foreach}]
              </select>
              [{else}]
              <select id="varSelect_[{$testid}]" name="aid">
                [{ if !$product->isParentNotBuyable()}]
                  <option value="[{$product->getId()}]">[{ $product->oxarticles__oxvarselect->value }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $product->getFPrice() }] [{ $currency->sign|strip_tags}]*[{/oxhasrights}]</option>
                [{/if}]
                [{foreach from=$product->getVariantList() item=variant}]
                  <option value="[{$variant->getId()}]">[{ $variant->oxarticles__oxvarselect->value }] [{oxhasrights ident="SHOWARTICLEPRICE"}] [{ $variant->getFPrice() }] [{ $currency->sign|strip_tags}]* [{/oxhasrights}]</option>
                [{/foreach}]
              </select>
              [{/if}]

            [{elseif $product->getDispSelList()}]

              [{foreach key=iSel from=$product->getDispSelList() item=oList}]
                <label>[{ $oList.name }] :</label>
                <select id="sellist_[{$testid}]_[{$iSel}]" name="sel[[{$iSel}]]">
                  [{foreach key=iSelIdx from=$oList item=oSelItem}]
                    [{ if $oSelItem->name }]
                      <option value="[{$iSelIdx}]"[{if $oSelItem->selected }]SELECTED[{/if }]>[{ $oSelItem->name }]</option>
                    [{/if}]
                  [{/foreach}]
                </select>
              [{/foreach}]
            [{/if}]
        </div>

        <div class="tobasket">
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
                    <label id="productPrice" class="price">
                        [{if $product->getFTPrice()}]
                            [{oxmultilang ident="DETAILS_NOWONLY"}]
                        [{/if}]
                        <strong>[{$product->getFPrice()}] [{$currency->sign}]</strong>
                    </label>
                    [{if $product->loadAmountPriceInfo()}]
                        <a class="selector corners FXgradBlueDark" href="#priceinfo"><img src="[{$oViewConf->getImageUrl()}]selectbutton.png" alt="Select"></a>
                    [{/if}]
                [{/oxhasrights}]
                [{if !$product->isNotBuyable()}]
                <p class="fn clear">
                    <input type="text" name="am" value="1" size="3" autocomplete="off" class="textbox" title="[{ oxmultilang ident="DETAILS_QUANTITY" }]">
                    <button type="submit" class="submitButton largeButton" title="[{oxmultilang ident="PAGE_PRODUCT_INC_PRODUCT_ADDTOCARD2"}]">[{oxmultilang ident="PAGE_PRODUCT_INC_PRODUCT_ADDTOCARD2"}]</button>
                    [{if $product->loadAmountPriceInfo()}]
                        [{oxscript add="$( '.ox-details-amount' ).oxSuggest();"}]
                    [{/if}]
                </p>
                [{/if}]
            </div>
        </div>
        [{if $product->hasMdVariants() }]
        <span >
            <a id="variantMoreInfo_[{$testid}]" class="submitButton" href="[{ $_productLink }]" onclick="oxid.mdVariants.getMdVariantUrl('mdVariant_[{$testid}]'); return false;">[{ oxmultilang ident="PAGE_PRODUCT_INC_PRODUCT_VARIANTS_MOREINFO" }]</a>
        </span>
        [{/if}]
    </form>
</div>