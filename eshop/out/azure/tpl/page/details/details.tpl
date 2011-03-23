[{capture append="oxidBlock_content"}]
  [{assign var="oDetailsProduct" value=$oView->getProduct()}]
  [{assign var="currency" value=$oView->getActCurrency()}]
  [{capture append="oxidBlock_pagePopup"}]
    <div>
      [{include file="page/details/inc/zoompopup.tpl"}]
    </div>
  [{/capture}]

[{if $oView->getPriceAlarmStatus() == 1}]
    [{assign var="_statusMessage1" value="PAGE_DETAILS_THANKYOUMESSAGE1"|oxmultilangassign|cat:" "|cat:$oxcmp_shop->oxshops__oxname->value}]
    [{assign var="_statusMessage2" value="PAGE_DETAILS_THANKYOUMESSAGE2"|oxmultilangassign|cat:" "}]
    [{assign var="_statusMessage3" value="PAGE_DETAILS_THANKYOUMESSAGE3"|oxmultilangassign|cat:" "|cat:$oView->getBidPrice()|cat:" "|cat:$currency->sign|cat:" "}]
    [{assign var="_statusMessage4" value="PAGE_DETAILS_THANKYOUMESSAGE4"|oxmultilangassign}]
    [{include file="message/success.tpl" statusMessage=`$_statusMessage1``$_statusMessage2``$_statusMessage3``$_statusMessage4`}]
[{elseif $oView->getPriceAlarmStatus() == 2}]
    [{assign var="_statusMessage" value="PAGE_DETAILS_WRONGVERIFICATIONCODE"|oxmultilangassign}]
    [{include file="message/error.tpl" statusMessage=$_statusMessage}]
[{elseif $oView->getPriceAlarmStatus() === 0}]
    [{assign var="_statusMessage1" value="PAGE_DETAILS_NOTABLETOSENDEMAIL"|oxmultilangassign|cat:"<br> "}]
    [{assign var="_statusMessage2" value="PAGE_DETAILS_VERIFYYOUREMAIL"|oxmultilangassign}]
    [{include file="message/error.tpl" statusMessage=`$_statusMessage1``$_statusMessage2`}]
[{/if}]

<div id="details" class="hreview-aggregate hproduct">
[{ if $oView->getSearchTitle() }]
  [{ assign var="detailsLocation" value=$oView->getSearchTitle()}]
[{else}]
  [{foreach from=$oView->getCatTreePath() item=oCatPath name="detailslocation"}]
  [{if $smarty.foreach.detailslocation.last}]

    [{assign var="detailsLocation" value=$oCatPath->oxcategories__oxtitle->value}]
    [{/if}]
  [{/foreach}]
[{/if }]


[{* details locator  *}]
<h2 class="pageHead category">[{$detailsLocation}]</h2>

[{assign var="actCategory" value=$oView->getActiveCategory()}]
<div class="detailsParams listRefine bottomRound">
    <div class="pager refineParams clear" id="detailsItemsPager">
        [{if $actCategory->prevProductLink}]<a id="linkPrevArticle" class="prev" href="[{$actCategory->prevProductLink}]">[{oxmultilang ident="DETAILS_LOCATOR_PREVIUOSPRODUCT"}]</a>[{/if}]
        <span class="page">
           [{oxmultilang ident="DETAILS_LOCATOR_PRODUCT"}] [{$actCategory->iProductPos}] [{oxmultilang ident="DETAILS_LOCATOR_FROM"}] [{$actCategory->iCntOfProd}]
        </span>
        [{if $actCategory->nextProductLink}]<a id="linkNextArticle" href="[{$actCategory->nextProductLink}]" class="next">[{oxmultilang ident="DETAILS_LOCATOR_NEXTPRODUCT"}]</a>[{/if}]
    </div>
</div>


    [{oxhasrights ident="TOBASKET"}]
[{if !$oDetailsProduct->isNotBuyable()}]
    <form class="loadVariant" action="[{$oViewConf->getSelfActionLink()}]" method="post">
    <div>
        [{$oViewConf->getHiddenSid()}]
        [{$oViewConf->getNavFormParams()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="tobasket">
        <input type="hidden" name="aid" value="[{$oDetailsProduct->oxarticles__oxid->value}]">
        <input type="hidden" name="anid" value="[{$oDetailsProduct->oxarticles__oxnid->value}]">
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

            [{* variants | md variants *}]
            [{if $oView->getVariantList()}]

                <div id="variants">
                    <div id="mdVariantBox"></div>

                    [{oxscript add="oxid.mdVariants.mdAttachAll();"}]
                    [{oxscript add="oxid.mdVariants.showMdRealVariant();" }]

                    [{ oxscript add="$( '.md_select_variant' ).oxLoadArticleVariant();" }]

                    <label>[{ $oDetailsProduct->oxarticles__oxvarname->value }]:</label><br>
                    [{oxvariantselect value=$oDetailsProduct->getMdVariants() separator=" " artid=$oDetailsProduct->getId()}]
                </div>

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
                                <strong>[{$oDetailsProduct->getFPrice()}] [{$currency->sign}]</strong>
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
                        <button id="toBasket" type="submit" class="submitButton largeButton" title="[{oxmultilang ident="DETAILS_ADDTOCART"}]">[{oxmultilang ident="DETAILS_ADDTOCART"}]</button>
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
        [{* more pics *}]
        [{include file="page/details/inc/morepics.tpl"}]
        <div class="detailsRelated clear">
            <div class="relatedInfo[{if !$oView->getSimilarProducts() && !$oView->getCrossSelling() && !$oView->getAccessoires()}] relatedInfoFull[{/if}]">
                [{include file="page/details/inc/tabs.tpl"}]
                [{if $oView->getAlsoBoughtTheseProducts()}]
                    [{include file="widget/product/list.tpl" type="grid" listId="alsoBought" header="light" head="PAGE_DETAILS_CUSTOMERS_ALSO_BOUGHT"|oxmultilangassign products=$oView->getAlsoBoughtTheseProducts()}]
                [{/if}]
                <div class="widgetBox reviews">
                    <h4>[{oxmultilang ident="DETAILS_PRODUCTREVIEW"}]</h4>
                    [{include file="widget/reviews/reviews.tpl"}]
                </div>
            </div>
            [{ include file="page/details/inc/related_products.tpl" }]
        </div>
</div>
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]