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
                       <span class="priceValue">[{ $_product->getFPrice() }] [{ $currency->sign}] [{ if !( $_product->hasMdVariants() || $_product->getDispSelList() || $_product->getVariantList() ) }]*[{/if}]</span>
                  [{/if}]
                    [{ if !( $_product->hasMdVariants() || $_product->getDispSelList() || $_product->getVariantList() ) }]
                        <a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=start" params="fnc=tobasket&amp;aid=`$_product->oxarticles__oxid->value`&amp;am=1" }]" class="toCart" title="[{oxmultilang ident="WIDGET_BARGAIN_ITEMS_PRODUCT_ADDTOCART" }]">[{oxmultilang ident="WIDGET_BARGAIN_ITEMS_PRODUCT_ADDTOCART" }]</a>
                    [{else}]
                        <a href="[{ $_product->getLink() }]" class="toCart">[{ oxmultilang ident="WIDGET_PRODUCT_PRODUCT_MOREINFO" }]</a>
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
        [{assign var='rsslinks' value=$oView->getRssLinks() }]
        [{if $rsslinks.bargainArticles}]
            <a class="rss external" id="rssBargainProducts" href="[{$rsslinks.bargainArticles.link}]" title="[{$rsslinks.bargainArticles.title}]"><img src="[{$oViewConf->getImageUrl()}]rss.png" alt="[{$rsslinks.bargainArticles.title}]"><span class="FXgradOrange corners glowShadow">[{$rsslinks.bargainArticles.title}]</span></a>
        [{/if}]
    </h3>
    [{$smarty.capture.bargainTitle}]
</div>
<div class="specBoxInfo">
    [{$smarty.capture.bargainPrice}]
    [{$smarty.capture.bargainPic}]
</div>