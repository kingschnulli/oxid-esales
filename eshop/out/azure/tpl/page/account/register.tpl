[{capture append="oxidBlock_content"}]
    <h1 id="openAccHeader" class="pageHead">[{ oxmultilang ident="PAGE_ACCOUNT_REGISTER_OPENACCOUNT" }]</h1>
    [{include file="form/register.tpl"}]
[{/capture}]
[{if $oView->isActive('PsLogin') }]
    [{include file="layout/popup.tpl"}]
[{else}]
    [{include file="layout/page.tpl" sidebar="Right"}]
[{/if}]