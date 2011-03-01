[{assign var="bIsError" value=0 }]
[{capture name=openIdErrors}]
    [{foreach from=$Errors.openidlogin item=oEr key=key }]
        <p id="errorOpenIdLogin" class="errorMsg">[{ $oEr->getOxMessage()}]</>
        [{assign var="bIsError" value=1 }]
    [{/foreach}]
[{/capture}]
<form name="ropenidlogin" action="[{ $oViewConf->getSslSelfLink() }]" method="post">
    <div id="openId" class="popupBox corners FXgradGreyLight openIDLogin" [{if $bIsError}]style="display: block;"[{/if}]>
        <img src="[{$oViewConf->getImageUrl()}]x.png" alt="" class="closePop">
        [{ $oViewConf->getHiddenSid() }]
        [{ $oViewConf->getNavFormParams() }]
        <input type="hidden" name="fnc" value="login_noredirect">
        <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
        <input type="hidden" name="pgNr" value="[{$oView->getActPage()}]">
        <input type="hidden" name="CustomError" value="openidlogin">
        [{if $oView->getProduct()}]
            [{assign var="product" value=$oView->getProduct() }]
            <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
        [{/if}]
        <label for="lgn_openid"><img src="[{$oViewConf->getImageUrl()}]login-openid-logo.png" width="63" height="20" title="[{ oxmultilang ident="WIDGET_OPENIDLOGIN_LABEL" }]"></label>
            <input type="text" name="lgn_openid" id="lgn_openid" value="" class="textbox openid">
        [{$smarty.capture.openIdErrors}]
            <button type="submit" name="send" class="submitButton">[{ oxmultilang ident="WIDGET_OPENIDLOGIN_SUBMIT" }]</button>
            <button type="submit" class="submitButton closePop">[{ oxmultilang ident="WIDGET_OPENIDLOGIN_CANCEL" }]</button>
    </div>
</form>
