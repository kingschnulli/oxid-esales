[{ assign var="shop"      value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="currency"  value=$oEmailView->getCurrency() }]
[{ assign var="user"      value=$oEmailView->getUser() }]
[{ assign var="oDelSet"   value=$order->getDelSet() }]
[{ assign var="basket"    value=$order->getBasket() }]
[{ assign var="payment"   value=$order->getPayment() }]
[{ assign var="sOrderId"   value=$order->getId() }]
[{ assign var="oOrderFileList"   value=$oEmailView->getOrderFileList($sOrderId) }]

[{block name="email_plain_order_cust_orderemail"}]
[{if $payment->oxuserpayments__oxpaymentsid->value == "oxempty"}]
[{oxcontent ident="oxuserordernpplainemail"}]
[{else}]
[{oxcontent ident="oxuserorderplainemail"}]
[{/if}]
[{/block}]

[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ORDERNUMBER" }] [{ $order->oxorder__oxordernr->value }]

[{block name="email_plain_order_cust_voucherdiscount"}]
[{if $oViewConf->getShowVouchers() }]
[{ foreach from=$order->getVoucherList() item=voucher}]
[{ assign var="voucherseries" value=$voucher->getSerie() }]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_USEDCOUPONS" }] [{$voucher->oxvouchers__oxvouchernr->value}] - [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_DICOUNT" }] [{$voucherseries->oxvoucherseries__oxdiscount->value}] [{ if $voucherseries->oxvoucherseries__oxdiscounttype->value == "absolute"}][{ $currency->sign}][{else}]%[{/if}]
[{/foreach }]
[{/if}]
[{/block}]

[{assign var="basketitemlist" value=$basket->getBasketArticles() }]
[{foreach key=basketindex from=$basket->getContents() item=basketitem}]
[{block name="email_plain_order_cust_basketitem"}]
[{assign var="basketproduct" value=$basketitemlist.$basketindex }]
[{ $basketproduct->oxarticles__oxtitle->getRawValue()|strip_tags }][{ if $basketproduct->oxarticles__oxvarselect->value}], [{ $basketproduct->oxarticles__oxvarselect->value}][{/if}]
[{ if $basketitem->getChosenSelList() }][{foreach from=$basketitem->getChosenSelList() item=oList}]

[{ $oList->name }] [{ $oList->value }]

[{ /foreach }][{ /if }]
[{ if $basketitem->getPersParams() }]
[{ foreach key=sVar from=$basketitem->getPersParams() item=aParam }]

[{ $sVar }] : [{ $aParam }]
[{ /foreach }]
[{ /if }]
[{ if $oViewConf->getShowGiftWrapping() }]
[{ assign var="oWrapping" value=$basketitem->getWrapping() }]

[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_WRAPPING" }] [{ if !$basketitem->getWrappingId() }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_NONE" }][{else}][{$oWrapping->oxwrapping__oxname->value}][{/if}]
[{ /if }]
[{ if $basketproduct->oxarticles__oxorderinfo->value }]
[{ $basketproduct->oxarticles__oxorderinfo->getRawValue() }]
[{ /if }]

[{assign var=dRegUnitPrice value=$basketitem->getRegularUnitPrice()}]
[{assign var=dUnitPrice value=$basketitem->getUnitPrice()}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_UNITPRICE" }] [{ $basketitem->getFUnitPrice() }] [{ $currency->name}] [{if !$basketitem->isBundle() }][{if $dRegUnitPrice->getPrice() > $dUnitPrice->getPrice() }] ([{ $basketitem->getFRegularUnitPrice() }] [{ $currency->sign}]) [{/if}][{/if}]

[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_QUANTITY" }] [{$basketitem->getAmount()}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_VAT" }] [{$basketitem->getVatPercent() }]%
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTAL" }] [{ $basketitem->getFTotalPrice() }] [{ $currency->name}]
[{/block}]
[{/foreach}]
------------------------------------------------------------------
[{ if !$basket->getDiscounts()}]
[{block name="email_plain_order_cust_nodiscounttotalnet"}]
[{* netto price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALNET" }] [{ $basket->getProductsNetPrice() }] [{ $currency->name}]
[{/block}]
[{block name="email_plain_order_cust_nodiscountproductvats"}]
[{* VATs *}]
[{foreach from=$basket->getProductVats() item=VATitem key=key}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX1" }] [{ $key }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX2" }] [{ $VATitem }] [{ $currency->name}]
[{/foreach}]
[{/block}]
[{block name="email_plain_order_cust_nodiscounttotalgross"}]
[{* brutto price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALGROSS" }] [{ $basket->getFProductsPrice() }] [{ $currency->name}]
[{/block}]
[{/if}]
[{* applied discounts *}]
[{ if $basket->getDiscounts()}]
[{if $order->isNettoMode() }]
[{block name="email_plain_order_ownerdiscounttotalnet"}]
[{* netto price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALNET" }] [{ $basket->getProductsNetPrice() }] [{ $currency->name}]
[{/block}]
[{else}]
[{block name="email_plain_order_discountownertotalgross"}]
[{* brutto price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALGROSS" }] [{ $basket->getFProductsPrice() }] [{ $currency->name}]
[{/block}]
[{/if}]
[{block name="email_plain_order_cust_discounts"}]
[{foreach from=$basket->getDiscounts() item=oDiscount}]
[{if $oDiscount->dDiscount < 0 }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_CHARGE" }][{else}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_DICOUNT" }][{/if}] [{ $oDiscount->sDiscount }]: [{if $oDiscount->dDiscount < 0 }][{ $oDiscount->fDiscount|replace:"-":"" }][{else}]-[{ $oDiscount->fDiscount }][{/if}] [{ $currency->name}]
[{/foreach}]
[{/block}]
[{if !$order->isNettoMode()}]
[{block name="email_plain_order_cust_totalnet"}]
[{* netto price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALNET" }] [{ $basket->getProductsNetPrice() }] [{ $currency->name}]
[{/block}]
[{/if}]
[{block name="email_plain_order_cust_productvats"}]
[{* VATs *}]
[{foreach from=$basket->getProductVats() item=VATitem key=key}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX1" }] [{ $key }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX2" }] [{ $VATitem }] [{ $currency->name}]
[{/foreach}]
[{/block}]
[{/if}]
[{if $order->isNettoMode()}]
[{block name="email_plain_order_ownertotalgross"}]
[{* brutto price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALGROSS" }] [{ $basket->getFProductsPrice() }] [{ $currency->name}]
[{/block}]
[{/if}]
[{block name="email_plain_order_cust_voucherdiscount"}]
[{* voucher discounts *}]
[{if $oViewConf->getShowVouchers() && $basket->getVoucherDiscValue() }]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_COUPON" }] [{ if $basket->getFVoucherDiscountValue() > 0 }]-[{/if}][{ $basket->getFVoucherDiscountValue()|replace:"-":"" }] [{ $currency->name}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_delcosts"}]
[{* delivery costs *}]
[{if $basket->getDelCostNet() }]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGNET" }] [{ $basket->getDelCostNet() }] [{ $currency->sign}]
    [{if $basket->getDelCostVat() }] [{ oxmultilang ident="BASKET_TOTAL_PLUS_PROPORTIONAL_VAT" }] [{else}] [{ oxmultilang ident="SHIPPING_VAT1" }] [{ $basket->getDelCostVatPercent() }][{ oxmultilang ident="SHIPPING_VAT2" }][{/if}] [{ $basket->getDelCostVat() }] [{ $currency->sign}]
[{elseif $basket->getFDeliveryCosts() }]
    [{ oxmultilang ident="SHIPPING_COST" }] [{ $basket->getFDeliveryCosts() }] [{ $currency->sign}]
[{/if }]
[{/block}]

[{block name="email_plain_order_cust_paymentcosts"}]
[{* payment sum *}]
[{ if $basket->getPayCostNet() }]
    [{if $basket->getPaymentCosts() >= 0}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEDISCOUNT1" }][{else}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEDISCOUNT2" }][{/if}] [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEDISCOUNT3" }] [{ $basket->getPayCostNet() }] [{ $currency->sign}]
    [{ if $basket->getPayCostVat() }]
        [{if $basket->isProportionalCalculationOn() }] [{ oxmultilang ident="BASKET_TOTAL_PLUS_PROPORTIONAL_VAT" }][{else}] [{ oxmultilang ident="SHIPPING_VAT1" }] [{ $basket->getPayCostVatPercent() }][{ oxmultilang ident="SHIPPING_VAT2" }][{/if}] [{ $basket->getPayCostVat() }] [{ $currency->sign}]
    [{/if}]
[{elseif $basket->getFPaymentCosts()}]
    [{ oxmultilang ident="SURCHARGE" }] [{ $basket->getFPaymentCosts() }] [{ $currency->sign}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_ts"}]
[{* Trusted shops protection *}]
[{ if $basket->getTsProtectionCosts() }]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TSPROTECTIONCHARGETAX1" }] [{ $basket->getTsProtectionVatPercent()}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TSPROTECTIONCHARGETAX2" }] [{ $basket->getTsProtectionVat() }] [{ $currency->name}]
    [{ if $basket->getTsProtectionVat() }]
        [{if $basket->isProportionalCalculationOn() }][{ oxmultilang ident="BASKET_TOTAL_PLUS_PROPORTIONAL_VAT" }][{else}] [{ oxmultilang ident="SHIPPING_VAT1" }] [{ $basket->getTsProtectionVatPercent() }][{ oxmultilang ident="SHIPPING_VAT2" }][{/if}]
    [{/if}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_wrappingcosts"}]
[{* Gift wrapping *}]
[{ if $oViewConf->getShowGiftWrapping() }]
    [{if $basket->getWrappCostNet() }]
        [{ oxmultilang ident="BASKET_TOTAL_WRAPPING_COSTS_NET" }] [{ $basket->getWrappCostNet() }] [{ $currency->sign}]
        [{if $basket->getWrappCostVat() }]
            [{ oxmultilang ident="BASKET_TOTAL_PLUS_VAT" }] [{ $basket->getWrappCostVat() }] [{ $currency->sign}]
        [{/if}]
    [{elseif $basket->getFWrappingCosts() }]
        [{ oxmultilang ident="BASKET_TOTAL_WRAPPING_COSTS" }] [{ $basket->getFWrappingCosts() }] [{ $currency->sign}]
    [{/if}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_giftwrapping"}]
[{* Greeting card *}]
[{ if $oViewConf->getShowGiftWrapping() }]
    [{if $basket->getGiftCardCostNet() }]
        [{ oxmultilang ident="BASKET_TOTAL_GIFTCARD_COSTS_NET" }] [{ $basket->getGiftCardCostNet() }] [{ $currency->sign}]
        [{if $basket->getGiftCardCostVat() }]
            [{if $basket->isProportionalCalculationOn() }][{ oxmultilang ident="BASKET_TOTAL_PLUS_PROPORTIONAL_VAT" }][{else}] [{ oxmultilang ident="SHIPPING_VAT1" }] [{ $basket->getGiftCardCostVatPercent() }][{ oxmultilang ident="SHIPPING_VAT2" }][{/if}] [{ $basket->getGiftCardCostVat() }] [{ $currency->sign}]
        [{/if}]
    [{elseif $basket->getFGiftCardCosts() }]
        [{ oxmultilang ident="BASKET_TOTAL_GIFTCARD_COSTS" }] [{ $basket->getFGiftCardCosts() }] [{ $currency->sign}]
    [{/if}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_grandtotal"}]
[{* grand total price *}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_GRANDTOTAL" }] [{ $basket->getFPrice() }] [{ $currency->name}]

[{if $basket->getCard() }]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_YOURGREETINGCARD" }]
    [{$basket->getCardMessage()}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_userremark"}]
[{ if $order->oxorder__oxremark->value }]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_YOURMESSAGE" }] [{ $order->oxorder__oxremark->getRawValue() }]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_download_link"}]
[{ if $oOrderFileList and $oOrderFileList|count }]
    [{ oxmultilang ident="MY_DOWNLOADS_DESC" }]
    [{foreach from=$oOrderFileList item="oOrderFile"}]
      [{if $order->oxorder__oxpaid->value || !$oOrderFile->oxorderfiles__oxpurchasedonly->value}]
        [{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=download" params="sorderfileid="|cat:$oOrderFile->getId()}]
      [{else}]
        [{$oOrderFile->oxorderfiles__oxfilename->value}] [{ oxmultilang ident="DOWNLOADS_PAYMENT_PENDING" }]
      [{/if}]
    [{/foreach}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_paymentinfo"}]
[{if $payment->oxuserpayments__oxpaymentsid->value != "oxempty"}]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTMETHOD" }] [{ $payment->oxpayments__oxdesc->getRawValue() }] [{ if $basket->getPaymentCosts() }]([{ $basket->getFPaymentCosts() }] [{ $currency->sign}])[{/if}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_username"}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_EMAILADDRESS" }] [{ $user->oxuser__oxusername->value }]
[{/block}]

[{block name="email_plain_order_cust_address"}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_BILLINGADDRESS" }]
[{ $order->oxorder__oxbillcompany->getRawValue() }]
[{ $order->oxorder__oxbillsal->value|oxmultilangsal}] [{ $order->oxorder__oxbillfname->getRawValue() }] [{ $order->oxorder__oxbilllname->getRawValue() }]
[{if $order->oxorder__oxbilladdinfo->value }][{ $order->oxorder__oxbilladdinfo->getRawValue() }][{/if}]
[{ $order->oxorder__oxbillstreet->getRawValue() }] [{ $order->oxorder__oxbillstreetnr->value }]
[{ $order->oxorder__oxbillstateid->value }]
[{ $order->oxorder__oxbillzip->value }] [{ $order->oxorder__oxbillcity->getRawValue() }]
[{ $order->oxorder__oxbillcountry->getRawValue() }]
[{if $order->oxorder__oxbillustid->value}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_VATIDNOMBER" }] [{ $order->oxorder__oxbillustid->value }][{/if}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PHONE" }] [{ $order->oxorder__oxbillfon->value }]

[{ if $order->oxorder__oxdellname->value }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGADDRESS" }]
[{ $order->oxorder__oxdelcompany->getRawValue() }]
[{ $order->oxorder__oxdelsal->value|oxmultilangsal }] [{ $order->oxorder__oxdelfname->getRawValue() }] [{ $order->oxorder__oxdellname->getRawValue() }]
[{if $order->oxorder__oxdeladdinfo->value }][{ $order->oxorder__oxdeladdinfo->getRawValue() }][{/if}]
[{ $order->oxorder__oxdelstreet->getRawValue() }] [{ $order->oxorder__oxdelstreetnr->value }]
[{ $order->oxorder__oxdelstateid->getRawValue() }]
[{ $order->oxorder__oxdelzip->value }] [{ $order->oxorder__oxdelcity->getRawValue() }]
[{ $order->oxorder__oxdelcountry->getRawValue() }]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_deliveryinfo"}]
[{if $payment->oxuserpayments__oxpaymentsid->value != "oxempty"}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGCARRIER" }] [{ $order->oDelSet->oxdeliveryset__oxtitle->getRawValue() }]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_paymentinfo"}]
[{if $payment->oxuserpayments__oxpaymentsid->value == "oxidpayadvance"}]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_BANK" }] [{$shop->oxshops__oxbankname->getRawValue()}]<br>
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ROUTINGNOMBER" }] [{$shop->oxshops__oxbankcode->value}]<br>
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ACCOUNTNOMBER" }] [{$shop->oxshops__oxbanknumber->value}]<br>
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_BIC" }] [{$shop->oxshops__oxbiccode->value}]<br>
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_IBAN" }] [{$shop->oxshops__oxibannumber->value}]
[{/if}]
[{/block}]

[{block name="email_plain_order_cust_orderemailend"}]
[{ oxcontent ident="oxuserorderemailendplain" }]
[{/block}]

[{block name="email_plain_order_cust_tsinfo"}]
[{if $oViewConf->showTs("ORDEREMAIL") && $oViewConf->getTsId() }]
[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TS_RATINGS_RATEUS" }]
[{ $oViewConf->getTsRatingUrl() }]
[{/if}]
[{/block}]

[{ oxcontent ident="oxemailfooterplain" }]
