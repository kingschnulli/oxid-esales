[{capture append="oxidBlock_content"}]

<strong class="boxhead">[{ oxmultilang ident="PAGE_ACCOUNT_REGISTER_SUCCESS_WELCOME" }]</strong>
<div class="box info">
  [{if $oView->getRegistrationStatus() == 1}]
    [{ oxmultilang ident="PAGE_ACCOUNT_REGISTER_SUCCESS_EMAILCONFIRMATION" }]
  [{elseif $oView->getRegistrationStatus() == 2}]
    [{ oxmultilang ident="PAGE_ACCOUNT_REGISTER_SUCCESS_ACTIVATIONEMAIL" }]
  [{/if}]

  [{if $oView->getRegistrationError() == 4}]
    <div class="errorbox inbox">
      [{ oxmultilang ident="PAGE_ACCOUNT_REGISTER_SUCCESS_NOTABLETOSENDEMAIL" }]
    </div>
  [{/if}]
</div>

[{/capture}]
[{include file="layout/page.tpl"}]