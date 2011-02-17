<form class="oxValidate" name="login" action="[{ $oViewConf->getSslSelfLink() }]" method="post">
[{assign var="aErrors" value=$oView->getFieldValidationErrors()}]
    <ul class="form">
        <li>
            [{ $oViewConf->getHiddenSid() }]
            [{ $oViewConf->getNavFormParams() }]
            <input type="hidden" name="fnc" value="login_noredirect">
            <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
            <label>[{ oxmultilang ident="WIDGET_LOGINBOX_EMAIL_ADDRESS" }]</label>
            <input type="text" name="lgn_usr" class="textbox oxValidate oxValidate_notEmpty">
            <p class="oxValidateError">
                <br><br><br><br>
                <span class="oxError_notEmpty">[{ oxmultilang ident="EXCEPTION_INPUT_NOTALLFIELDS" }]</span>
            </p>
        </li>
        <li>
            <label>[{ oxmultilang ident="WIDGET_LOGINBOX_PASSWORD" }]</label>
            <input type="password" name="lgn_pwd" class="textbox oxValidate oxValidate_notEmpty">
            <p class="oxValidateError">
                <span class="oxError_notEmpty">[{ oxmultilang ident="EXCEPTION_INPUT_NOTALLFIELDS" }]</span>
            </p>
        </li>
        <li><button type="submit" class="submitButton">[{ oxmultilang ident="WIDGET_LOGINBOX_LOGIN" }]</button></li>
    </ul>
</form>