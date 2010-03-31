[{assign var="template_title" value="REGISTER_SUCCESS_MYACCOUNT"|oxmultilangassign}]
[{include file="_header.tpl" title=$template_title location=$template_title}]

<strong class="boxhead">[{ oxmultilang ident="REGISTER_SUCCESS_WELCOME" }]</strong>
<div class="box info">
  [{if $oView->getRegistrationStatus() == 1}]
    [{ oxmultilang ident="REGISTER_SUCCESS_EMAILCONFIRMATION" }]
  [{elseif $oView->getRegistrationStatus() == 2}]
    [{ oxmultilang ident="REGISTER_SUCCESS_ACTIVATIONEMAIL" }]
  [{/if}]

  [{if $oView->getRegistrationError() == 4}]
    <div class="errorbox inbox">
      [{ oxmultilang ident="REGISTER_SUCCESS_NOTABLETOSENDEMAIL" }]
    </div>
  [{/if}]
</div>

<div class="bar prevnext">
    <form action="[{ $oViewConf->getSelfActionLink() }]" name="order" method="post">
      <div>
          [{ $oViewConf->getHiddenSid() }]
          <input type="hidden" name="cl" value="start">
          <div class="right">
              <input id="test_BackToShop" type="submit" value="[{ oxmultilang ident="ACCOUNT_LOGIN_BACKTOSHOP" }]">
          </div>
      </div>
    </form>
</div>

[{ insert name="oxid_tracker" title=$template_title }]
[{include file="_footer.tpl"}]
