[{oxstyle include="css/checkout.css"}]
[{capture append="oxidBlock_content"}]
[{* ordering steps *}]
[{include file="page/checkout/inc/steps.tpl" active=3 }]
[{assign var="currency" value=$oView->getActCurrency() }]
[{ if $oView->getAllSets() }]
<h3 id="deliveryHeader" class="blockHead">[{ if $oView->getAllSetsCnt() > 1 }][{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_SELECTSHIPPING" }][{else}][{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_SELECTEDSHIPPING" }][{/if}]</h3>
[{assign var="aErrors" value=$oView->getFieldValidationErrors()}]
<form action="[{ $oViewConf->getSslSelfLink() }]" name="shipping" id="shipping" method="post">
    <div>
      [{ $oViewConf->getHiddenSid() }]
      [{ $oViewConf->getNavFormParams() }]
      <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
      <input type="hidden" name="fnc" value="changeshipping">
    </div>
    <ul>
      <li>
          <select name="sShipSet" onChange="JavaScript:document.forms.shipping.submit();">
          [{foreach key=sShipID from=$oView->getAllSets() item=oShippingSet name=ShipSetSelect}]
              <option value="[{$sShipID}]" [{if $oShippingSet->blSelected}]SELECTED[{/if}]>[{ $oShippingSet->oxdeliveryset__oxtitle->value }]</option>
          [{/foreach}]
          </select>
          <noscript>
              <button type="submit" class="submitButton largeButton">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_UPDATESHIPPING" }]</button>
          </noscript>
      </li>
    </ul>
    [{if $oxcmp_basket->getDeliveryCosts() }]
    <div id="shipSetCost">
          <b>[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_CHARGE" }] [{ $oxcmp_basket->getFDeliveryCosts() }] [{ $currency->sign}]</b>
    </div>
    [{/if}]
    <div class="lineBlock"></div>
</form>
[{/if}]

[{assign var="iPayError" value=$oView->getPaymentError() }]
[{ if $iPayError == 1}]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_COMLETEALLFIELDS" }]</div>
[{ elseif $iPayError == 2}]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_AUTHORIZATIONFAILED" }]</div>
[{ elseif $iPayError == 4 }]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_UNAVAILABLESHIPPING" }]</div>
[{ elseif $iPayError == 5 }]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_UNAVAILABLEPAYMENT" }]</div>
[{ elseif $iPayError == 6 }]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_UNAVAILABLETSPROTECTION" }]</div>
[{ elseif $iPayError > 6 }]
    <!--Add custom error message here-->
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_UNAVAILABLEPAYMENT" }]</div>
[{ elseif $iPayError == -1}]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_ERRUNAVAILABLEPAYMENT" }] "[{ $oView->getPaymentErrorText() }]").</div>
[{ elseif $iPayError == -2}]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_NOSHIPPINGFOUND" }]</div>
[{ elseif $iPayError == -3}]
    <div class="status error">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_SELECTANOTHERPAYMENT" }]</div>
[{/if}]

<form action="[{ $oViewConf->getSslSelfLink() }]" class="oxValidate" id="payment" name="order" method="post">
    <div>
        [{ $oViewConf->getHiddenSid() }]
        [{ $oViewConf->getNavFormParams() }]
        <input type="hidden" name="cl" value="[{ $oViewConf->getActiveClassName() }]">
        <input type="hidden" name="fnc" value="validatepayment">
    </div>


    [{if $oView->getPaymentList()}]
        <h3 id="paymentHeader" class="blockHead">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_PAYMENT" }]</h3>
        [{ assign var="inptcounter" value="-1"}]
        [{foreach key=sPaymentID from=$oView->getPaymentList() item=paymentmethod name=PaymentSelect}]
            [{ assign var="inptcounter" value="`$inptcounter+1`"}]
            [{block name="select_payment"}]
                [{if $sPaymentID == "oxidcashondel"}]
                    [{include file="page/checkout/inc/payment_oxidcashondel.tpl"}]
                [{elseif $sPaymentID == "oxidcreditcard"}]
                    [{include file="page/checkout/inc/payment_oxidcreditcard.tpl"}]
                [{elseif $sPaymentID == "oxiddebitnote"}]
                    [{include file="page/checkout/inc/payment_oxiddebitnote.tpl"}]
                [{else}]
                    [{include file="page/checkout/inc/payment_other.tpl"}]
                [{/if}]
            [{/block}]
        [{/foreach}]

        [{* TRUSTED SHOPS BEGIN *}]
        [{include file="page/checkout/inc/trustedshops.tpl"}]
        [{* TRUSTED SHOPS END *}]


        [{if $oView->isLowOrderPrice()}]
            <div class="lineBox clear">
                <div><b>[{ oxmultilang ident="BASKET_MINORDERPRICE" }] [{ $oView->getMinOrderPrice() }] [{ $currency->sign }]</b></div>
            </div>
        [{else}]
            <div class="lineBox clear">
                <a href="[{ oxgetseourl ident=$oViewConf->getOrderLink() }]" class="submitButton largeButton" id="paymentBackStepBottom">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_BACKSTEP" }]</a>
                <button type="submit" name="userform" class="submitButton nextStep largeButton" id="paymentNextStepBottom">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_NEXTSTEP" }]</button>
            </div>
        [{/if}]

    [{elseif $oView->getEmptyPayment()}]
      <div class="lineBlock"></div>
      <h3 id="paymentHeader" class="blockHead">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_INFO" }]</h3>
      [{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_EMPTY_TEXT" }]
        <input type="hidden" name="paymentid" value="oxempty">
        <div class="lineBox clear">
            <button type="submit" name="userform" class="submitButton nextStep largeButton" id="paymentNextStepBottom">[{ oxmultilang ident="PAGE_CHECKOUT_PAYMENT_NEXTSTEP" }]</button>
        </div>
    [{/if}]
</form>
[{insert name="oxid_tracker" title=$template_title }]
[{/capture}]
[{include file="layout/page.tpl"}]