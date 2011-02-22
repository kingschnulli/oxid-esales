[{capture append="oxidBlock_content"}]

    [{if $oView->getActiveRecommList() }]
        [{assign var="_actvrecommlist" value=$oView->getActiveRecommList() }]
        [{assign var="recommendation_head" value="PAGE_RECOMMENDATIONS_PRODUCTS_LISTBY"|oxmultilangassign}]
        [{assign var="recommendation_head" value=$_actvrecommlist->oxrecommlists__oxtitle->value|cat:" <span>("|cat:$recommendation_head|cat:" "|cat:$_actvrecommlist->oxrecommlists__oxauthor->value|cat:")</span>"}]
        [{if $rsslinks.recommlistarts}]
            [{assign var="recommendation_head" value="`$recommendation_head` <a class=\"rss external\" id=\"rss.recommlistarts\" href=\"`$rsslinks.recommlistarts.link`\" title=\"`$rsslinks.recommlistarts.title`\"></a>"}]
        [{/if}]
        <h1 class="pageHead">[{$recommendation_head}]</h1>
        <div class="listRefine clear bottomRound">
            [{include file="widget/locator/listlocator.tpl" locator=$oView->getPageNavigation()}]
        </div>
        <div >
            <div class="clear">
                <div>
                    [{ $_actvrecommlist->oxrecommlists__oxdesc->value }]
                </div>
                <div class="rating clear">
                    [{include file="widget/reviews/rating.tpl" itemid="recommid="|cat:$_actvrecommlist->getId() sRateUrl=$oViewConf->getSelfLink()|cat:"cl=recommlist"}]
                </div>
            </div>
        </div>
        [{* List types: grid|line *}]
        [{include file="widget/product/list.tpl" type="line" listId="productList" products=$oView->getArticleList() recommid=$_actvrecommlist->getId()}]
        [{include file="widget/locator/listlocator.tpl" locator=$oView->getPageNavigation() place="bottom"}]
        <div class="widgetBox reviews">
            <h4>[{oxmultilang ident="DETAILS_PRODUCTREVIEW"}]</h4>
            [{include file="widget/reviews/reviews.tpl"}]
        </div>
    [{else}]
        [{assign var="hitsfor" value="PAGE_RECOMMENDATIONS_PRODUCTS_HITSFOR"|oxmultilangassign }]
        [{assign var="recommendation_head" value="`$oView->getArticleCount()` `$hitsfor` &quot;"|cat:$oView->getRecommSearch()|cat:"&quot;" }]
        <h1 class="pageHead">[{$recommendation_head}]</h1>
        [{include file="page/recommendations/inc/list.tpl"}]
    [{/if}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]