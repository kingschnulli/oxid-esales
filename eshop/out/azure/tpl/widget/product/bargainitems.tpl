[{assign var="currency" value=$oView->getActCurrency()}]
[{foreach from=$oView->getBargainArticleList() item=_product name=bargainList}]
[{if $smarty.foreach.bargainList.first}]
    [{ assign var="sBargainArtTitle" value="`$_product->oxarticles__oxtitle->value` `$_product->oxarticles__oxvarselect->value`" }]
    [{capture name="bargainTitle"}]
        <a id="titleBargain_[{$smarty.foreach.bargainList.iteration}]" href="[{$_product->getMainLink()}]" class="title">[{ $sBargainArtTitle|strip_tags }]</a>
    [{/capture}]
    [{capture name="bargainPic"}]
        <img src="[{$_product->getThumbnailUrl()}]" alt="[{ $sBargainArtTitle|strip_tags }]" class="picture">
    [{/capture}]
    [{capture name="bargainPrice"}]
          <div class="price hoverBox" id="priceBargain_[{$smarty.foreach.bargainList.iteration}]">
              <div class="hoverInfo">
                  [{oxhasrights ident="SHOWARTICLEPRICE"}]
                  [{if $_product->getFPrice()}]
                    [{assign var="currency" value=$oView->getActCurrency() }]
                       <span class="priceValue">[{ $_product->getFPrice() }] [{ $currency->sign}]<a href="#delivery_link" rel="nofollow">*</a></span>
                  [{/if}]
                    [{ if !$_product->isNotBuyable() || !$_product->hasMdVariants() }]
                        <a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=start" params="fnc=tobasket&amp;aid=`$_product->oxarticles__oxid->value`&amp;am=1" }]" class="toCart" title="[{oxmultilang ident="WIDGET_BARGAIN_ITEMS_PRODUCT_ADDTOCART" }]">[{oxmultilang ident="WIDGET_BARGAIN_ITEMS_PRODUCT_ADDTOCART" }]</a>
                        [{oxifcontent ident="oxdeliveryinfo" object="oCont"}]
                        <span class="deliveryInfo">[{ oxmultilang ident="WIDGET_BARGAIN_ITEMS_PRODUCT_PLUSSHIPPING" }]<a href="[{ $oCont->getLink() }]" rel="nofollow">[{ oxmultilang ident="WIDGET_BARGAIN_ITEMS_PRODUCT_PLUSSHIPPING2" }]</a></span>
                        [{/oxifcontent}]

                    [{/if}]
                    [{/oxhasrights}]
                </div>
            </div>
    [{/capture}]
[{/if}]
[{/foreach}]
<div class="specBoxTitles rightShadow">
    <h3>
        <strong>[{ oxmultilang ident="PAGE_SHOP_START_WEEKSPECIAL" }]</strong>
        [{if $rsslinks.bargainArticles}]
            <a class="rss external" id="rss.bargainArticles" href="[{$rsslinks.bargainArticles.link}]" title="[{$rsslinks.bargainArticles.title}]"><img src="[{$oViewConf->getImageUrl()}]rss.png" alt="[{$rsslinks.bargainArticles.title}]"><span class="FXgradOrange corners glowShadow">[{$rsslinks.bargainArticles.title}]</span></a>
        [{/if}]
    </h3>
    [{$smarty.capture.bargainTitle}]
</div>
<div class="specBoxInfo">
    [{$smarty.capture.bargainPrice}]
    [{$smarty.capture.bargainPic}]
</div>