[{if !$oDetailsProduct}] [{assign var="oDetailsProduct" value=$oView->getProduct()}] [{/if}]
[{if !$currency}]        [{assign var="currency" value=$oView->getActCurrency()}]    [{/if}]

[{assign var="aVariantSelections" value=$oView->getVariantSelections()}]

[{oxhasrights ident="TOBASKET"}]
[{if !$oDetailsProduct->isNotBuyable()}]
    <form class="loadVariant oxProductForm" action="[{$oViewConf->getSelfActionLink()}]" method="post">

    [{if $aVariantSelections && $aVariantSelections.rawselections}]
    <script>
        var oxVariantSelections = new Array();
        [{foreach from=$aVariantSelections.rawselections item=oSelectionList key=iKey}]
            oxVariantSelections["[{$iKey}]"] = new Array();
            [{foreach from=$oSelectionList item=oListItem key=iPos}]
                oxVariantSelections["[{$iKey}]"][[{$iPos}]] = [{if $oListItem.name}]"[{$oListItem.hash}]"[{else}]false[{/if}];
            [{/foreach}]
        [{/foreach}]
    </script>
    [{/if}]

    <div>
        [{$oViewConf->getHiddenSid()}]
        [{$oViewConf->getNavFormParams()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="aid" value="[{$oDetailsProduct->oxarticles__oxid->value}]">
        <input type="hidden" name="anid" value="[{$oDetailsProduct->oxarticles__oxnid->value}]">
        <input type="hidden" name="parentid" value="[{if !$oDetailsProduct->oxarticles__oxparentid->value}][{$oDetailsProduct->oxarticles__oxid->value}][{else}][{$oDetailsProduct->oxarticles__oxparentid->value}][{/if}]">
        <input type="hidden" name="panid" value="">
    </div>
[{/if}]
[{/oxhasrights}]

    <div class="detailsInfo clear">

        [{* article picture with zoom *}]
        [{if $oView->showZoomPics()}]
            [{oxscript add="$('#zoomTrigger').oxModalPopup({target:'#zoomModal'});"}]
            <a id="zoomTrigger" alt="[{oxmultilang ident="DETAILS_ZOOM"}]" rel="nofollow" href="#">Zoom</a>
        [{/if}]

        <div class="picture">
            <a href="[{$oDetailsProduct->getMasterZoomPictureUrl(1)}]" class="cloud-zoom" id="zoom1" rel="adjustY:-2, zoomWidth:'354', fixZoomWindow:'390', loadingText:'[{oxmultilang ident="PAGE_DETAILS_ZOOM_LOADING"}]'">
                <img src="[{$oView->getActPicture()}]"  alt="[{$oDetailsProduct->oxarticles__oxtitle->value|strip_tags}] [{$oDetailsProduct->oxarticles__oxvarselect->value|strip_tags}]">
            </a>
        </div>

        [{* article main info block *}]
        <div class="information">
            [{* Product title *}]
            <h1 id="productTitle"><span>[{$oDetailsProduct->oxarticles__oxtitle->value}] [{$oDetailsProduct->oxarticles__oxvarselect->value}]</span></h1>


            [{* Actions select list: to listmania and etc. *}]
            [{if $smarty.cookies.showlinksonce ne "1"}]
                <div id="showLinksOnce"></div>
            [{/if}]
            <a class="selector corners FXgradBlueDark" href="#priceinfo" id="productLinks"><img src="[{$oViewConf->getImageUrl()}]selectbutton.png" longdesc="[{$oViewConf->getImageUrl()}]selectbutton-on.png" alt="Select"></a>
            <ul class="actionLinks corners shadow">
                [{if $oViewConf->getShowCompareList() }]
                    <li><span>[{oxid_include_dynamic file="page/details/inc/compare_links.tpl" testid="" type="compare" aid=$oDetailsProduct->oxarticles__oxid->value anid=$oDetailsProduct->oxarticles__oxnid->value in_list=$oDetailsProduct->isOnComparisonList() page=$oView->getActPage() text_to_id="PAGE_DETAILS_COMPARE" text_from_id="PAGE_DETAILS_REMOVEFROMCOMPARELIST"}]</span></li>
                [{/if}]
                <li>
                    <span><a id="suggest" rel="nofollow" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=suggest" params="anid=`$oDetailsProduct->oxarticles__oxnid->value`"|cat:$oViewConf->getNavUrlParams() }]">[{ oxmultilang ident="PAGE_DETAILS_RECOMMEND" }]</a></span>
                </li>
                [{if $oViewConf->getShowListmania()}]
                <li>
                    <span>
                    [{if $oxcmp_user }]
                        <a id="recommList" rel="nofollow" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=recommadd" params="aid=`$oDetailsProduct->oxarticles__oxnid->value`&amp;anid=`$oDetailsProduct->oxarticles__oxnid->value`"|cat:$oViewConf->getNavUrlParams() }]" class="details">[{ oxmultilang ident="PAGE_DETAILS_ADDTORECOMMLIST" }]</a>
                    [{ else}]
                        <a id="loginToRecommlist" class="reqlogin" rel="nofollow" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account" params="anid=`$oDetailsProduct->oxarticles__oxnid->value`"|cat:"&amp;sourcecl="|cat:$oViewConf->getActiveClassName()|cat:$oViewConf->getNavUrlParams() }]">[{ oxmultilang ident="PAGE_DETAILS_LOGGINTOACCESSRECOMMLIST" }]</a>
                    [{/if}]
                    </span>
                </li>
                [{ /if}]
                [{if $oxcmp_user }]
                    <li><span><a id="linkToNoticeList" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl="|cat:$oViewConf->getActiveClassName() params="aid=`$oDetailsProduct->oxarticles__oxnid->value`&amp;anid=`$oDetailsProduct->oxarticles__oxnid->value`&amp;fnc=tonoticelist&amp;am=1"|cat:$oViewConf->getNavUrlParams() }]" rel="nofollow">[{ oxmultilang ident="PAGE_DETAILS_ADDTONOTICELIST" }]</a></span></li>
                [{else}]
                    <li><span><a id="loginToNotice" class="reqlogin" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account" params="anid=`$oDetailsProduct->oxarticles__oxnid->value`"|cat:"&amp;sourcecl="|cat:$oViewConf->getActiveClassName()|cat:$oViewConf->getNavUrlParams() }]" rel="nofollow">[{ oxmultilang ident="PAGE_DETAILS_LOGGINTOACCESSNOTICELIST" }]</a></span></li>
                [{/if}]
                [{if $oViewConf->getShowWishlist()}]
                    [{if $oxcmp_user }]
                        <li><span><a id="linkToWishList" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl="|cat:$oViewConf->getActiveClassName() params="aid=`$oDetailsProduct->oxarticles__oxnid->value`&anid=`$oDetailsProduct->oxarticles__oxnid->value`&amp;fnc=towishlist&amp;am=1"|cat:$oViewConf->getNavUrlParams() }]" rel="nofollow">[{ oxmultilang ident="PAGE_DETAILS_ADDTOWISHLIST" }]</a></span></li>
                    [{else}]
                        <li><span><a id="loginToWish" class="reqlogin" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account" params="anid=`$oDetailsProduct->oxarticles__oxnid->value`"|cat:"&amp;sourcecl="|cat:$oViewConf->getActiveClassName()|cat:$oViewConf->getNavUrlParams() }]" rel="nofollow">[{ oxmultilang ident="PAGE_DETAILS_LOGGINTOACCESSWISHLIST" }]</a></span></li>
                    [{/if}]
                [{/if}]

                [{oxhasrights ident="TOBASKET"}]
                 [{if $oView->isPriceAlarm() && $oDetailsProduct->isBuyable()}]
                    <li><a id="priceAlarmLink" class="priceAlarmLink" rel="nofollow" href="[{ $oDetailsProduct->getLink()|cat:'#itemTabs'}]">[{oxmultilang ident="DETAILS_PRICEALARM"}]</a></li>
                 [{/if}]
                [{/oxhasrights}]

                <li class="social clear">
                        <label>[{oxmultilang ident="DETAILS_SOCIAL_BOOKMARKS"}]</label>
                        [{include file="widget/facebook/share.tpl"}]
                        [{include file="widget/facebook/like.tpl" width="45"}]
                  </li>

            </ul>

            [{* artickle number *}]
            <span id="productArtnum" class="itemCode">[{oxmultilang ident="DETAILS_ARTNUMBER"}] [{$oDetailsProduct->oxarticles__oxartnum->value}]</span>

            [{* ratings *}]
            <div class="rating clear">
                [{include file="widget/reviews/rating.tpl" itemid="anid=`$oDetailsProduct->oxarticles__oxnid->value`" sRateUrl=$oDetailsProduct->getLink() }]
            </div>

            [{* short description *}]
            [{oxhasrights ident="SHOWSHORTDESCRIPTION"}]
            [{if $oDetailsProduct->oxarticles__oxshortdesc->value}]
                <div class="shortDescription description" id="productShortdesc">[{$oDetailsProduct->oxarticles__oxshortdesc->value}]</div>
            [{/if}]
            [{/oxhasrights}]

            [{assign var="blCanBuy" value=true}]
            [{* variants | md variants *}]
            [{if $aVariantSelections && $aVariantSelections.selections }]
                <div id="variants" class="variantSelecors fnSubmit clear">

                    [{assign var="blHasActiveSelections" value=false}]
                    [{foreach from=$aVariantSelections.selections item=oSelectionList key=iKey}]
                        [{assign var="blCanBuy" value=$oSelectionList->allowsToBuy($blCanBuy)}]
                        <div class="dropDown">

                            <p class="selectorLabel underlined">
                                <label>[{$oSelectionList->getLabel()}]:</label>
                                [{assign var="oActiveSelection" value=$oSelectionList->getActiveSelection()}]
                                [{if $oActiveSelection }]
                                    [{assign var="blHasActiveSelections" value=true}]
                                    <span>[{$oActiveSelection->getName()}]</span>
                                [{else}]
                                    <span>[{ oxmultilang ident="WIDGET_PRODUCT_ATTRIBUTES_PLEASECHOOSE" }]</span>
                                [{/if}]
                            </p>

                            <input type="hidden" name="varselid[[{$iKey}]]" value="[{if $oActiveSelection }][{$oActiveSelection->getValue()}][{/if}]">
                            <ul class="drop vardrop FXgradGreyLight shadow">
                                [{if $oActiveSelection}]
                                    <li><a rel="" href="#">[{ oxmultilang ident="WIDGET_PRODUCT_ATTRIBUTES_PLEASECHOOSE" }]</a></li>
                                [{/if}]
                                [{assign var="aSelections" value=$oSelectionList->getSelections()}]
                                [{foreach from=$aSelections item=oSelection}]
                                    <li class="[{if $oSelection->isDisabled()}]oxdisabled disabled[{/if}]">
                                        <a rel="[{$oSelection->getValue()}]" href="#" class="[{if $oSelection->isActive()}]selected[{/if}]">[{$oSelection->getName()}]</a>
                                    </li>
                                [{/foreach}]
                            </ul>

                        </div>
                    [{/foreach}]

                </div>

                [{if $blHasActiveSelections}]

                    <div class="variantReset">
                        [{* Reset link *}]
                        <a href="" class="reset">[{ oxmultilang ident="DETAILS_VARIANTS_RESETSELECTION" }]</a>

                        [{* Active selections *}]
                        <label>[{ oxmultilang ident="DETAILS_VARIANTS_SELECTEDCOMBINATION" }]</label>
                        [{assign var="sSelectionSep" value=""}]
                        [{strip}]
                            [{foreach from=$aVariantSelections.selections item=oSelectionList name=variantselections}]
                                [{assign var="oActiveSelection" value=$oSelectionList->getActiveSelection()}]
                                [{if $oActiveSelection }]
                                    [{$sSelectionSep}][{$oActiveSelection->getName()}]
                                    [{assign var="sSelectionSep" value=", "}]
                                [{/if}]
                            [{/foreach}]
                        [{/strip}]
                    </div>

                [{/if}]

            [{/if}]

            [{* selection lists *}]
            [{if $oView->getSelectLists() }]
                <div class="selectlist-box">
                    [{include file="page/details/inc/selectlist.tpl"}]
                </div>
            [{/if}]

            <div class="tobasket">

                [{* pers params *}]
                [{if $oView->isPersParam()}]
                <div class="persparamBox clear">
                    <label for="persistentParam">[{ oxmultilang ident="PAGE_DETAILS_PERSPARAM_LABEL" }]</label><input type="text" id="persistentParam" name="persparam[details]" value="[{ $oDetailsProduct->aPersistParam.text }]" size="35">
                </div>
                [{/if}]

                [{oxhasrights ident="SHOWARTICLEPRICE"}]
                    [{if $oDetailsProduct->getFTPrice()}]
                        <p class="oldPrice">
                            <strong>[{oxmultilang ident="DETAILS_REDUCEDFROM"}] <del>[{$oDetailsProduct->getFTPrice()}] [{$currency->sign}]</del></strong>
                            <span>[{oxmultilang ident="DETAILS_REDUCEDTEXT"}]</span>
                        </p>
                    [{/if}]
                [{/oxhasrights}]

                <div class="tobasketFunction clear">
                    [{oxhasrights ident="SHOWARTICLEPRICE"}]
                        [{if $oDetailsProduct->getFPrice()}]
                            <label id="productPrice" class="price">
                                [{if $oDetailsProduct->getFTPrice()}]
                                    [{oxmultilang ident="DETAILS_NOWONLY"}]
                                [{/if}]

                                [{assign var="fPrice" value=$oDetailsProduct->getFPrice()}]
                                [{if !$blCanBuy }]
                                    [{assign var="oParentProduct" value=$oDetailsProduct->getParentArticle()}]
                                    [{if $oParentProduct}]
                                        [{assign var="fPrice" value=$oParentProduct->getFPrice()}]
                                    [{/if}]
                                [{/if}]

                                <strong>[{$fPrice}] [{$currency->sign}]</strong>
                            </label>
                        [{/if}]
                        [{if $oDetailsProduct->loadAmountPriceInfo()}]
                            <a class="selector corners FXgradBlueDark" href="#priceinfo" id="amountPrice"><img src="[{$oViewConf->getImageUrl()}]selectbutton.png" longdesc="[{$oViewConf->getImageUrl()}]selectbutton-on.png" alt="Select"></a>
                            [{include file="page/details/inc/priceinfo.tpl"}]
                        [{/if}]
                    [{/oxhasrights}]

                    [{oxhasrights ident="TOBASKET"}]
                    [{if !$oDetailsProduct->isNotBuyable()}]
                        <input id="amountToBasket" type="text" name="am" value="1" size="3" autocomplete="off" class="textbox">
                        <button id="toBasket" type="submit" name="fnc" value="tobasket" [{if !$blCanBuy}]disabled="disabled"[{/if}] class="submitButton largeButton" title="[{oxmultilang ident="DETAILS_ADDTOCART"}]">[{oxmultilang ident="DETAILS_ADDTOCART"}]</button>
                        [{if $oDetailsProduct->loadAmountPriceInfo()}]
                            [{oxscript add="$( '.ox-details-amount' ).oxSuggest();"}]
                        [{/if}]
                    [{/if}]
                    [{/oxhasrights}]

                </div>
            </div>

            [{* additional info *}]
            <div class="additionalInfo clear">
                [{if $oDetailsProduct->getPricePerUnit()}]
                    <span id="productPriceUnit">[{$oDetailsProduct->getPricePerUnit()}] [{$currency->sign}]/[{$oDetailsProduct->oxarticles__oxunitname->value}]</span>
                [{/if}]
                [{oxifcontent ident="oxdeliveryinfo" object="oCont"}]
                    <span>[{oxmultilang ident="DETAILS_PLUSSHIPPING"}] [{oxmultilang ident="DETAILS_PLUSSHIPPING2"}]</span>
                [{/oxifcontent}]
                [{if $oDetailsProduct->getStockStatus() == -1}]
                    <span class="stockFlag notOnStock">
                        [{if $oDetailsProduct->oxarticles__oxnostocktext->value}]
                            [{$oDetailsProduct->oxarticles__oxnostocktext->value}]
                        [{elseif $oViewConf->getStockOffDefaultMessage()}]
                            [{oxmultilang ident="DETAILS_NOTONSTOCK"}]
                        [{/if}]
                        [{if $oDetailsProduct->getDeliveryDate()}]
                            [{oxmultilang ident="DETAILS_AVAILABLEON"}] [{$oDetailsProduct->getDeliveryDate()}]
                        [{/if}]
                    </span>
                [{elseif $oDetailsProduct->getStockStatus() == 1}]
                    <span class="stockFlag lowStock">[{oxmultilang ident="DETAILS_LOWSTOCK"}]</span>
                [{elseif $oDetailsProduct->getStockStatus() == 0}]
                    <span class="stockFlag onStock">
                        [{if $oDetailsProduct->oxarticles__oxstocktext->value}]
                            [{$oDetailsProduct->oxarticles__oxstocktext->value}]
                        [{elseif $oViewConf->getStockOnDefaultMessage()}]
                            [{oxmultilang ident="DETAILS_READYFORSHIPPING"}]
                        [{/if}]
                    </span>
                [{/if}]
                [{oxhasrights ident="TOBASKET"}]
                [{if !$oDetailsProduct->isNotBuyable()}]
                    [{include file="page/details/inc/deliverytime.tpl"}]
                [{/if}]
                [{/oxhasrights}]
                [{if $oDetailsProduct->oxarticles__oxweight->value}]
                    <span id="productWeight">[{oxmultilang ident="DETAILS_ARTWEIGHT"}] [{$oDetailsProduct->oxarticles__oxweight->value}] [{oxmultilang ident="DETAILS_ARTWEIGHTUNIT"}]</span>
                [{/if}]
              </div>
          </div>
    </div>

[{oxhasrights ident="TOBASKET"}]
[{if !$oDetailsProduct->isNotBuyable()}]
</form>
[{/if}]
[{/oxhasrights}]

[{include file="page/details/inc/morepics.tpl"}]

[{if "detailsMain" == $sRenderPartial}]
    [{oxscript add="$(function(){oxid.initDetailsPagePartial();});"}]
    [{oxscript}]
[{/if}]
[{oxscript add="$(function(){oxid.initDetailsMain();});"}]
