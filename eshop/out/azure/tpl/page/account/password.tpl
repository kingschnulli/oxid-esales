[{capture append="oxidBlock_content"}]
[{if $oView->isPasswordChanged() }]
     <div class="status success corners">
      [{ oxmultilang ident="PAGE_ACCOUNT_PASSWORD_PASSWORDCHANGED" }]
     </div>
[{/if}]
<h1 id="personalSettingsHeader" class="pageHead">[{ oxmultilang ident="PAGE_ACCOUNT_PASSWORD_PERSONALSETTINGS" }]</h1>
    [{if $oView->hasPassword() }]
       [{include file="form/user_password.tpl"}]
    [{else }]
      <div>
        <a id="loginLostPwd" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=forgotpwd" }]" class="link" rel="nofollow">[{ oxmultilang ident="PAGE_ACCOUNT_PASSWORD_CHANGEPASSWORD" }]</a>
      </div>
    [{/if }]
[{/capture}]
[{capture append="oxidBlock_sidebar"}]
    [{include file="page/account/inc/account_menu.tpl" active_link="password"}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]
