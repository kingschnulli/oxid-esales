[{capture append="oxidBlock_content"}]
    [{if $oView->getActiveRecommList() }]
        [{assign var="_actvrecommlist" value=$oView->getActiveRecommList() }]
        [{assign var="recommendation_head" value=$_actvrecommlist->oxrecommlists__oxtitle->value}]
        [{if $_actvrecommlist && $oView->isSavedList()}]
            [{assign var="_statusMessage" value="PAGE_RECOMMENDATIONS_EDIT_LISTSAVED"|oxmultilangassign}]
            [{include file="message/success.tpl" statusMessage=$_statusMessage}]
        [{/if}]
        <h1 class="pageHead">[{$recommendation_head}]</h1>
        <div class="listmaniaView">
            [{include file="form/recommendation_edit.tpl" actvrecommlist=$_actvrecommlist}]
        </div>
    [{/if}]
[{/capture}]
[{capture append="oxidBlock_sidebar"}]
    [{include file="page/account/inc/account_menu.tpl" active_link="recommendationlist"}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]