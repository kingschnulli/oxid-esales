[{capture append="oxidBlock_content"}]
    [{assign var="_actvrecommlist" value=$oView->getActiveRecommList() }]
    <h1 class="pageHead">[{ oxmultilang ident="PAGE_ACCOUNT_RECOMMENDATIONLIST_TITLE" }]</h1>
    [{if  $oView->isSavedList()}]
        [{assign var="_statusMessage" value="PAGE_RECOMMENDATIONS_EDIT_LISTSAVED"|oxmultilangassign}]
        [{include file="message/success.tpl" statusMessage=$_statusMessage}]
    [{/if}]
    <div class="listmaniaView clear">
        [{include file="form/recommendation_edit.tpl" actvrecommlist=$_actvrecommlist}]
    </div>
    [{if !$oView->getActiveRecommList() }]
        [{assign var="blEdit" value=true }]
        [{include file="page/recommendations/inc/list.tpl"}]
    [{/if}]
[{/capture}]
[{capture append="oxidBlock_sidebar"}]
    [{include file="page/account/inc/account_menu.tpl" active_link="recommendationlist"}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]
