[{capture append="oxidBlock_content"}]
[{assign var="template_title" value=""}]

[{* ordering steps *}]
[{include file="page/checkout/inc/steps.tpl" active=2 }]

[{if !$oxcmp_user && !$oView->getLoginOption() }]
    [{include file="page/checkout/inc/options.tpl"}]
[{/if}]

[{if !$oxcmp_user && $oView->getLoginOption() == 1}]
    [{include file="form/user_checkout_noregistration.tpl"}]
[{/if}]

[{if !$oxcmp_user && $oView->getLoginOption() == 3}]
    [{include file="form/user_checkout_registration.tpl"}]
[{/if}]

[{if $oxcmp_user}]
    [{include file="form/user_checkout_change.tpl"}]
[{/if}]
[{ insert name="oxid_tracker" title=$template_title }]
[{/capture}]
[{include file="layout/page.tpl"}]