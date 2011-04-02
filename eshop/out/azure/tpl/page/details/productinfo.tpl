[{if !$oDetailsProduct}] [{assign var="oDetailsProduct" value=$oView->getProduct()}] [{/if}]
[{if !$currency}]        [{assign var="currency" value=$oView->getActCurrency()}]    [{/if}]

[{if "productInfo" == $sRenderPartial}]
    [{oxscript add="$(function(){oxid.initDetailsPagePartial();});"}]
[{/if}]

<div id="detailsMain">
    [{include file="page/details/detailsmain.tpl"}]
</div>
<div id="detailsRelated" class="detailsRelated clear">
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

    [{oxscript add="$(function(){oxid.initDetailsRelated();});"}]
</div>

[{if "productInfo" == $sRenderPartial}]
    [{oxscript}]
[{/if}]
