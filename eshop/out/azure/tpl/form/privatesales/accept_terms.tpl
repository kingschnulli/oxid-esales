<div class="col">
    <form name="login" class="oxValidate" action="[{ $oViewConf->getSslSelfLink() }]" method="post">
        <div>
            [{ $oViewConf->getHiddenSid() }]
            [{ $oViewConf->getNavFormParams() }]
            <input type="hidden" name="fnc" value="login_noredirect">
            <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
            <input type="hidden" name="tpl" value="[{$oViewConf->getActTplName()}]">
            [{if $oView->getArticleId()}]
              <input type="hidden" name="aid" value="[{$oView->getArticleId()}]">
            [{/if}]
            [{if $oView->getProduct()}]
              [{assign var="product" value=$oView->getProduct() }]
              <input type="hidden" name="anid" value="[{ $product->oxarticles__oxnid->value }]">
            [{/if}]
            <input type="hidden" name="ord_agb" value="0">
        </div>
        <ul class="clear">
            <li>
                <input type="checkbox" name="ord_agb" value="1">
                <label>[{oxifcontent ident="oxrighttocancellegend" object="oContent"}]
                    [{ $oContent->oxcontents__oxcontent->value }]
                    [{/oxifcontent}]</label>
            </li>

            <li class="formSubmit">
                <button type="submit" class="submitButton largeButton">[{ oxmultilang ident="FORM_LOGIN_ACCOUNT_LOGIN" }]</button>
            </li>
        </ul>
    </form>
</div>