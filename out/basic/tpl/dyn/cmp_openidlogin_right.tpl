[{foreach from=$Errors.dyn_cmp_openidlogin_right item=oEr key=key }]
  <p class="err">[{ $oEr->getOxMessage()}]</p>
[{/foreach}]
  <form name="ropenidlogin" action="[{ $oViewConf->getSslSelfLink() }]" method="post">
    <div>
        [{ $oViewConf->getHiddenSid() }]
        [{$_login_additional_form_parameters}]
        <input type="hidden" name="fnc" value="login_noredirect">
        <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
        <input type="hidden" name="cnid" value="[{$oViewConf->getActCatId()}]">
        <input type="hidden" name="searchrecomm" value="[{$_login_searchrecomm}]">
        <input type="hidden" name="searchtag" value="[{$_login_searchtag}]">
        <input type="hidden" name="searchparam" value="[{$_login_searchparam}]">
        <input type="hidden" name="searchcnid" value="[{$_login_searchcnid}]">
        <input type="hidden" name="searchvendor" value="[{$_login_searchvendor}]">
        <input type="hidden" name="listtype" value="[{$_login_listtype}]">
        <input type="hidden" name="pgNr" value="[{$_login_pgnr-1}]">
        <input type="hidden" name="tpl" value="[{$_login_tpl}]">
        <input type="hidden" name="CustomError" value='dyn_cmp_openidlogin_right'>
        [{if $oView->getProduct()}]
          [{assign var="product" value=$oView->getProduct() }]
          <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
        [{/if}]
    </div>
    <table class="form">
      <colgroup>
        <col width="30%">
        <col width="70%">
      </colgroup>
	      <tr>
	        <td><label>[{ oxmultilang ident="INC_CMP_LOGIN_RIGHT_OPENID" }]</label></td>
	        <td><input id="test_RightLogin_Email" type="text" name="lgn_openid" value="" class="fullsize openid"></td>
	      </tr>
	      <tr>
	        <td></td>
	        <td><span class="btn"><input id="test_RightLogin_OpenIdLogin" type="submit" name="send" value="[{ oxmultilang ident="INC_CMP_LOGIN_RIGHT_LOGIN" }]" class="btn"></span></td>
	      </tr>
    </table>
  </form>