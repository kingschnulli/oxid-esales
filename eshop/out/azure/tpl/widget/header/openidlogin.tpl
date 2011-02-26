<form name="ropenidlogin" action="[{ $oViewConf->getSslSelfLink() }]" method="post">
    <div id="openId" class="popupBox corners FXgradGreyLight openIDLogin">
        <img src="[{$oViewConf->getImageUrl()}]x.png" alt="" class="closePop">
        [{ $oViewConf->getHiddenSid() }]
        [{$_login_additional_form_parameters}]
        <input type="hidden" name="fnc" value="login_noredirect">
        <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
        <input type="hidden" name="pgNr" value="[{$_login_pgnr}]">
        <input type="hidden" name="tpl" value="[{$_login_tpl}]">
        <input type="hidden" name="CustomError" value="openidlogin">
        [{if $oView->getProduct()}]
            [{assign var="product" value=$oView->getProduct() }]
            <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
        [{/if}]
        <label for="lgn_openid"><img src="[{$oViewConf->getImageUrl()}]login-openid-logo.png" width="63" height="20" title="[{ oxmultilang ident="WIDGET_OPENIDLOGIN_LABEL" }]"></label>
        [{foreach from=$Errors.dyn_cmp_openidlogin_right item=oEr key=key }]
            <span class="err">[{ $oEr->getOxMessage()}]</span>
        [{/foreach}]
        <input type="text" name="lgn_openid" id="lgn_openid" value="" class="textbox openid">
        <button type="submit" name="send" class="submitButton">[{ oxmultilang ident="WIDGET_OPENIDLOGIN_SUBMIT" }]</button>
        <button type="submit" class="submitButton closePop">[{ oxmultilang ident="WIDGET_OPENIDLOGIN_CANCEL" }]</button>
    </div>
</form>
