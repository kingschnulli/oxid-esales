[{capture append="oxidBlock_content"}]
    [{assign var="_actvrecommlist" value=$oView->getActiveRecommList() }]
    <h1 class="pageHead">[{ oxmultilang ident="PAGE_ACCOUNT_RECOMMENDATIONLIST_TITLE" }]</h1>
    <div class="listmaniaView clear">
        [{include file="form/recommendation_edit.tpl" actvrecommlist=$_actvrecommlist}]
    </div>
    [{if $oView->getActiveRecommList() && $oView->getArticleList()}]
        [{assign var="blEdit" value=true }]
        [{include file="widget/product/list.tpl" type="line" listId="recommendProductList" products=$oView->getArticleList() recommid=$_actvrecommlist->getId() removeFunction="removeArticle"}]
        [{include file="widget/locator/listlocator.tpl" locator=$oView->getPageNavigation() place="bottom"}]
    [{else}]
        [{assign var="blEdit" value=true }]
        [{include file="page/recommendations/inc/list.tpl"}]
    [{/if}]
[{/capture}]
[{capture append="oxidBlock_sidebar"}]
    [{include file="page/account/inc/account_menu.tpl" active_link="recommendationlist"}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]

