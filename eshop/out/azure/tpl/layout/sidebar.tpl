[{if $oView->isDemoShop()}]
  [{ include file="widget/sidebar/adminbanner.tpl" }]
[{/if}]

[{if $oxcmp_categories }]
[{capture append="oxidBlock_sidebar" }]
    [{include file="widget/sidebar/categoriestree.tpl" categories=$oxcmp_categories->getClickRoot() act=$oxcmp_categories->getClickCat() deepLevel=0}]
[{/capture}]
[{/if}]

[{if $oView->getClassName() eq "start" && $oView->getTop5ArticleList()}]
[{capture append="oxidBlock_sidebar" }]
    [{include file="widget/product/boxproducts.tpl" _boxId="topBox" _oBoxProducts=$oView->getTop5ArticleList() _sHeaderIdent="BOX_TOPOFTHESHOP_HEADER"}]
[{/capture}]
[{/if}]

[{if $oViewConf->getShowListmania() }]
[{capture append="oxidBlock_sidebar"}]
    [{include file="widget/sidebar/recommendation.tpl"}]
[{/capture}]
[{/if}]

[{if $oView->getClassName() ne "details"}]
    [{if $oView->getTagCloudManager() }]
    [{capture append="oxidBlock_sidebar"}]
        [{include file="widget/sidebar/tags.tpl" oTagsManager=$oView->getTagCloudManager()}]
    [{/capture}]
    [{/if}]
[{/if}]

[{if $oxcmp_news|count }]
[{capture append="oxidBlock_sidebar"}]
    [{include file="widget/sidebar/news.tpl" oNews=$oxcmp_news}]
[{/capture}]
[{/if}]

[{if $oView->isActive('FbFacepile') && $oView->isConnectedWithFb()}]
[{capture append="oxidBlock_sidebar"}]
    [{include file="widget/facebook/facepile.tpl"}]
[{/capture}]
[{/if}]

[{if $oView->getClassName() eq "start"}]
    [{capture append="oxidBlock_sidebar"}]
        [{include file="widget/sidebar/partners.tpl" }]
    [{/capture}]
[{/if}]

[{if $oView->getClassName() eq "start"}]
    [{if $oViewConf->showTs("WIDGET")}]
    [{capture append="oxidBlock_sidebar"}]
        [{include file="widget/trustedshops/ratings.tpl" }]
    [{/capture}]
    [{/if}]
[{/if}]

[{foreach from=$oxidBlock_sidebar item="_block"}]
    [{$_block}]
[{/foreach}]

