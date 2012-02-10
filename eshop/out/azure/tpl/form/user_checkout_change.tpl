[{oxscript include="js/widgets/oxinputvalidator.js" priority=10 }]
[{oxscript add="$('form.js-oxValidate').oxInputValidator();"}]
[{block name="user_checkout_change"}]
    <form class="js-oxValidate" action="[{ $oViewConf->getSslSelfLink() }]" name="order" method="post">
    [{block name="user_checkout_change_form"}]
        [{assign var="aErrors" value=$oView->getFieldValidationErrors()}]
        [{ $oViewConf->getHiddenSid() }]
        [{ $oViewConf->getNavFormParams() }]
        <input type="hidden" name="cl" value="user">
        <input type="hidden" name="option" value="[{$oView->getLoginOption()}]">
        <input type="hidden" name="fnc" value="changeuser">
        <input type="hidden" name="lgn_cook" value="0">
        <input type="hidden" name="blshowshipaddress" value="1">

        <div class="lineBox clear">
            <a href="[{ oxgetseourl ident=$oViewConf->getBasketLink() }]" class="prevStep submitButton largeButton" id="userBackStepTop">[{ oxmultilang ident="FORM_USER_CHECKOUT_CHANGE_BACKSTEP" }]</a>
            <button id="userNextStepTop" class="submitButton largeButton nextStep" name="userform" type="submit">[{ oxmultilang ident="FORM_USER_CHECKOUT_CHANGE_NEXTSTEP" }]</button>
        </div>

        <div class="checkoutCollumns clear">
            <div class="collumn">
                <h3 class="blockHead">
                    [{ oxmultilang ident="FORM_REGISTER_BILLINGADDRESS" }]
                    <button id="userChangeAddress" class="submitButton largeButton" name="changeBillAddress" type="submit">[{ oxmultilang ident="PAGE_CHECKOUT_BASKET_CHANGE" }]</button>
                </h3>
                <ul class="form" style="display: none;" id="addressForm">
                    [{ include file="form/fieldset/user_billing.tpl" noFormSubmit=true blSubscribeNews=true blOrderRemark=true}]
                </ul>
                <ul class="form" id="addressText">
                    <li>
                        [{include file="widget/address/billing_address.tpl" noFormSubmit=true blSubscribeNews=true blOrderRemark=true}]
                    </li>
                </ul>
                [{oxscript add="$('#userChangeAddress').click( function() { $('#addressForm').show();$('#addressText').hide();$('#userChangeAddress').hide();return false;});"}]
            </div>
            <div class="collumn">
                <h3 class="blockHead">[{ oxmultilang ident="FORM_REGISTER_SHIPPINGADDRESS" }]
                    [{if $oView->showShipAddress() and $oxcmp_user->getSelectedAddress()}]
                        <button id="userChangeShippingAddress" class="submitButton largeButton" name="changeShippingAddress" type="submit" [{if !$oView->showShipAddress() and $oxcmp_user->getSelectedAddress()}] style="display: none;" [{/if}]>[{ oxmultilang ident="PAGE_CHECKOUT_BASKET_CHANGE" }]</button>
                    [{/if}]
                </h3>
                <p><input type="checkbox" name="blshowshipaddress" id="showShipAddress" [{if !$oView->showShipAddress()}]checked[{/if}] value="0"><label for="showShipAddress">[{ oxmultilang ident="FORM_REGISTER_USE_BILLINGADDRESS_FOR_SHIPPINGADDRESS" }]</label></p>
                <ul id="shippingAddress" class="form" [{if !$oView->showShipAddress()}]style="display: none;"[{/if}]>
                    [{ include file="form/fieldset/user_shipping.tpl" noFormSubmit=true onChangeClass='user'}]
                </ul>
                <ul class="form">
                    <li>
                        [{include file="form/fieldset/order_newsletter.tpl" blSubscribeNews=true}]
                        [{include file="form/fieldset/order_remark.tpl" blOrderRemark=true}]
                    </li>
                </ul>
            </div>
        </div>

        [{oxscript add="$('#showShipAddress').change( function() { $('#shippingAddress').toggle($(this).is(':not(:checked)')); $('#userChangeShippingAddress').toggle($(this).is(':not(:checked)')); });"}]

        <div class="lineBox clear">
            <a href="[{ oxgetseourl ident=$oViewConf->getBasketLink() }]" class="prevStep submitButton largeButton" id="userBackStepBottom">[{ oxmultilang ident="FORM_USER_CHECKOUT_CHANGE_BACKSTEP" }]</a>
            <button id="userNextStepBottom" class="submitButton largeButton nextStep" name="userform" type="submit">[{ oxmultilang ident="FORM_USER_CHECKOUT_CHANGE_NEXTSTEP" }]</button>
        </div>
    [{/block}]
    </form>
[{/block}]