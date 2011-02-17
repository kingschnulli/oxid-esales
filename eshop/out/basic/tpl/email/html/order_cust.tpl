[{ assign var="oShop"     value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="oCurrency" value=$oEmailView->getCurrency() }]
[{ assign var="oUser"     value=$oEmailView->getUser() }]
[{ assign var="oDelSet"   value=$oOrder->getDelSet() }]
[{ assign var="oBasket"   value=$oOrder->getBasket() }]
[{ assign var="oPayment"  value=$oOrder->getPayment() }]

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <title>[{ $oShop->oxshops__oxordersubject->value }]</title>
    <meta http-equiv="Content-Type" content="text/html; charset=[{$oEmailView->getCharset()}]">
  </head>
  <body bgcolor="#FFFFFF" link="#355222" alink="#355222" vlink="#355222" style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;">
    <img src="[{$oViewConf->getImageUrl()}]logo_white.gif" border="0" hspace="0" vspace="0" alt="[{ $oShop->oxshops__oxname->value }]" align="texttop"><br><br>
    [{if $oPayment->oxuserpayments__oxpaymentsid->value == "oxempty"}]
      [{oxcontent ident="oxuserordernpemail"}]
    [{else}]
      [{oxcontent ident="oxuserorderemail"}]
    [{/if}]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ORDERNOMBER" }] <b>[{ $oOrder->oxorder__oxordernr->value }]</b><br><br>
    <table border="0" cellspacing="0" cellpadding="0" width="600">
      <tr>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" height="15" width="100">
          &nbsp;&nbsp;<b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PRODUCT" }]</b>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" height="15">
          &nbsp;&nbsp;
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" align="right" width="70">
          <b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_UNITPRICE" }]</b>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" align="right" width="70">
          <b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_QUANTITY" }]</b>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" align="right" width="70">
          <b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_VAT" }]</b>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" align="right" width="70">
          <b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTAL" }]</b>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; background-color: #494949; color: #FFFFFF;" align="right" width="70">
          [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PRODUCTREVIEW" }]
        </td>
      </tr>
    [{assign var="basketitemlist" value=$oBasket->getBasketArticles() }]
    [{foreach key=basketindex from=$oBasket->getContents() item=basketitem}]
    [{assign var="basketproduct" value=$basketitemlist.$basketindex }]
      <tr>
        <td valign="top" style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;">
          <img src="[{$basketproduct->getThumbnailUrl() }]" border="0" hspace="0" vspace="0" alt="[{ $basketproduct->oxarticles__oxtitle->value|strip_tags }]" align="texttop">
            [{if $oViewConf->getShowGiftWrapping() }]
            <br><b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_WRAPPING" }]&nbsp;</b>[{ if !$basketitem->wrapping }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_NONE" }][{else}][{$basketitem->oWrap->oxwrapping__oxname->value}][{/if}]
            [{/if}]
        </td>
        <td valign="top" style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;">
          <b>[{ $basketproduct->oxarticles__oxtitle->value }][{ if $basketproduct->oxarticles__oxvarselect->value}], [{ $basketproduct->oxarticles__oxvarselect->value}][{/if}]</b>
          [{ if $basketitem->chosen_selectlist }],
            [{foreach from=$basketitem->chosen_selectlist item=oList}]
              [{ $oList->name }] [{ $oList->value }]&nbsp;
            [{/foreach}]
          [{/if}]
          [{ if $basketitem->aPersParam }]
            [{foreach key=sVar from=$basketitem->aPersParam item=aParam}]
              ,&nbsp;<em>[{$sVar}] : [{$aParam}]</em>
            [{/foreach}]
          [{/if}]
          <br>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ARTNOMBER" }] [{ $basketproduct->oxarticles__oxartnum->value }]
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;" valign="top" align="right">
          <b>[{if $basketitem->getFUnitPrice() }][{ $basketitem->getFUnitPrice() }] [{ $oCurrency->sign}][{/if}]</b>
          [{if $basketitem->aDiscounts}]<br><br>
            <em style="font-size: 7pt;font-weight: normal;">[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_DISCOUNT" }]
            [{foreach from=$basketitem->aDiscounts item=oDiscount}]
              <br>[{ $oDiscount->sDiscount }]
            [{/foreach}]
            </em>
          [{/if}]
          [{ if $basketproduct->oxarticles__oxorderinfo->value }]
            [{ $basketproduct->oxarticles__oxorderinfo->value }]
          [{/if}]
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;" valign="top" align="right">
          [{$basketitem->dAmount}]
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;" valign="top" align="right">
          [{$basketitem->getVatPercent() }]%
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;" valign="top" align="right">
          <b>[{ $basketitem->getFTotalPrice() }] [{ $oCurrency->sign}]</b>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; padding-top: 10px;" valign="top" align="right">
          <a href="[{ $oViewConf->getBaseDir() }]index.php?shp=[{$oShop->oxshops__oxid->value}]&amp;anid=[{ $basketproduct->oxarticles__oxid->value }]&amp;cl=review&amp;reviewuserhash=[{$oUser->getReviewUserHash( $oUser->getId())}]" style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" target="_blank">[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_REVIEW" }]</a>
        </td>      </tr>
    [{/foreach}]
    <tr>
      <td height="1" bgcolor="#BEBEBE"></td>
      <td height="1" bgcolor="#BEBEBE"></td>
      <td height="1" bgcolor="#BEBEBE"></td>
      <td height="1" bgcolor="#BEBEBE"></td>
      <td height="1" bgcolor="#BEBEBE"></td>
      <td height="1" bgcolor="#BEBEBE"></td>
      <td height="1" bgcolor="#BEBEBE"></td>
    </tr>
  </table>
  <br>

  [{if $oViewConf->getShowGiftWrapping() && $oBasket->oCard }]
    <table border="0" cellspacing="0" cellpadding="2" width="600">
      <tr>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top">
          <b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_YOURGREETINGCARD" }]</b><br>
          <img src="[{$oBasket->oCard->nossl_dimagedir}]/0/[{$oBasket->oCard->oxwrapping__oxpic->value}]" alt="[{$oBasket->oCard->oxwrapping__oxname->value}]" hspace="0" vspace="0" border="0" align="top"><br><br>
        </td>
        <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top">
          [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_YOURMESSAGE" }]<br><br>
          [{$oBasket->giftmessage}]
        </td>
      </tr>
    </table>
    <br>
  [{/if}]


  <table border="0" cellspacing="0" cellpadding="2" width="600">
    <tr>
      <td width="50%" valign="top">
        <table border="0" cellspacing="0" cellpadding="0">
          [{if $oViewConf->getShowVouchers() && $oBasket->dVoucherDiscount }]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_USEDCOUPONS" }]<br>
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_REBATE" }]
              </td>
            </tr>
          [{/if}]
          [{ foreach from=$oOrder->getVoucherList() item=voucher}]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top">
                [{$voucher->oxmodvouchers__oxvouchernr->value}]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top">
                [{$voucher->oxmodvouchers__oxdiscount->value}] [{ if $voucher->oxmodvouchers__oxdiscounttype->value == "absolute"}][{ $oCurrency->sign}][{else}]%[{/if}]
              </td>
            </tr>
          [{/foreach }]
        </table>
      </td>
      <td width="50%" valign="top">
        <table border="0" cellspacing="0" cellpadding="2" width="300">
        [{if !$oBasket->aDiscounts}]
          [{* netto price *}]
          <tr>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALNET" }]
            </td>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right" width="60">
              [{ $oBasket->fproductsnetprice }] [{ $oCurrency->sign}]
            </td>
          </tr>
          [{* VATs *}]
          [{foreach from=$oBasket->aVATs item=VATitem key=key}]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX1" }] [{ $key }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX2" }]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ $VATitem }] [{ $oCurrency->sign}]
              </td>
            </tr>
          [{/foreach}]

          <tr><td height="1"></td><td height="1" bgcolor="#BEBEBE"></td></tr>
          [{/if}]
          [{* brutto price *}]
          <tr>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALGROSS" }]
            </td>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              [{ $oBasket->fproductsprice }] [{ $oCurrency->sign}]
            </td>
          </tr>
          [{* applied discounts *}]
          [{if $oBasket->aDiscounts}]
            <tr><td height="1"></td><td height="1" bgcolor="#BEBEBE"></td></tr>
            [{foreach from=$oBasket->aDiscounts item=oDiscount}]
              <tr>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{if $oDiscount->dDiscount < 0 }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_CHARGE" }][{else}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_DICOUNT" }][{/if}] <em>[{ $oDiscount->sDiscount }]</em> :
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{if $oDiscount->dDiscount < 0 }][{ $oDiscount->fDiscount|replace:"-":"" }][{else}]-[{ $oDiscount->fDiscount }][{/if}] [{ $oCurrency->sign}]
                </td>
              </tr>
            [{/foreach}]
            <tr><td height="1"></td><td height="1" bgcolor="#BEBEBE"></td></tr>
            [{* netto price *}]
                <tr>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TOTALNET" }]
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right" width="60">
                    [{ $oBasket->fproductsnetprice }] [{ $oCurrency->sign}]
                </td>
              </tr>
            [{* VATs *}]
            [{foreach from=$oBasket->aVATs item=VATitem key=key}]
              <tr>
                  <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX1" }] [{ $key }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX2" }]
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ $VATitem }] [{ $oCurrency->sign}]
                </td>
              </tr>
            [{/foreach}]
          [{/if}]
          <tr><td height="1"></td><td height="1" bgcolor="#BEBEBE"></td></tr>
          [{* voucher discounts *}]
          [{if $oViewConf->getShowVouchers() && $oBasket->dVoucherDiscount }]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_COUPON" }]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ if $oBasket->fVoucherDiscount > 0 }]-[{/if}][{ $oBasket->fVoucherDiscount|replace:"-":"" }] [{ $oCurrency->sign}]
              </td>
            </tr>

            <tr><td height="1"></td><td height="1" bgcolor="#BEBEBE"></td></tr>
          [{/if}]
          [{* delivery costs *}]
          [{* delivery VAT (if available) *}]
          [{if $oBasket->dDelVAT > 0}]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGNET" }]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ $oBasket->fdeliverynetcost }] [{ $oCurrency->sign}]
              </td>
            </tr>
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TAX1" }] [{ $oBasket->fDelVATPercent*100 }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TAX2" }]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ $oBasket->fDelVAT }] [{ $oCurrency->sign}]
              </td>
            </tr>
          [{/if}]
          <tr>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGGROSS1" }] [{if $oBasket->dDelVAT > 0}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGGROSS2" }] [{/if}]:
            </td>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              [{ $oBasket->fdeliverycost }] [{ $oCurrency->sign}]
            </td>
          </tr>
          [{* payment sum *}]
          [{ if $oBasket->dAddPaymentSum }]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{if $oBasket->dAddPaymentSum >= 0}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEDISCOUNT1" }][{else}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEDISCOUNT2" }][{/if}] [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEDISCOUNT3" }]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ $oBasket->fAddPaymentNetSum }] [{ $oCurrency->sign}]
              </td>
            </tr>
            [{* payment sum VAT (if available) *}]
            [{ if $oBasket->dAddPaymentSumVAT }]
              <tr>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEVAT1" }] [{ $oBasket->fAddPaymentSumVATPercent}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTCHARGEVAT2" }]
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ $oBasket->fAddPaymentSumVAT }] [{ $oCurrency->sign}]
                </td>
              </tr>
            [{/if}]
          [{/if}]

          [{ if $oBasket->getTsProtectionCosts() }]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TSPROTECTION" }]
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                [{ $oBasket->getTsProtectionNet() }] [{ $oCurrency->sign}]
              </td>
            </tr>
            [{ if $oBasket->getTsProtectionVat() }]
              <tr>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TSPROTECTIONCHARGETAX1" }] [{ $oBasket->getTsProtectionVatPercent()}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TSPROTECTIONCHARGETAX2" }]
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ $oBasket->getTsProtectionVat() }]&nbsp;[{ $oCurrency->sign}]
                </td>
              </tr>
            [{/if}]
          [{/if}]

          [{ if $oViewConf->getShowGiftWrapping() && $oBasket->dWrappingPrice }]
            [{if $oBasket->fWrappingVAT}]
              <tr>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_WRAPPINGNET" }]
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ $oBasket->fWrappingNetto }] [{ $oCurrency->sign}]
                </td>
              </tr>
              <tr>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX21" }] [{ $oBasket->fWrappingVATPercent }][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PLUSTAX22" }]
                </td>
                <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ $oBasket->fWrappingVAT }] [{ $oCurrency->sign}]
                </td>
              </tr>
            [{/if}]
            <tr>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_WRAPPINGANDGREETINGCARD1" }][{if $oBasket->fWrappingVAT}] [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_WRAPPINGANDGREETINGCARD2" }][{/if}] :
              </td>
              <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
                  [{ $oBasket->fWrappingPrice }] [{ $oCurrency->sign}]
              </td>
            </tr>
          [{/if}]

          <tr><td height="1"></td><td height="1" bgcolor="#BEBEBE"></td></tr>
          [{* grand total price *}]
          <tr>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              <b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_GRANDTOTAL" }]</b>
            </td>
            <td style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;" valign="top" align="right">
              <b>[{ $oBasket->fprice }] [{ $oCurrency->sign}]</b>
            </td>
          </tr>
          [{* *}]
        </table>
      </td>
    </tr>
  </table>

  [{ if $oOrder->oxorder__oxremark->value }]
    <br><b>[{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_YOURMESSAGE" }] </b>[{ $oOrder->oxorder__oxremark->value|oxescape }]<br>
  [{/if}]

  <br>
  [{if $oPayment->oxuserpayments__oxpaymentsid->value != "oxempty"}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PAYMENTMETHOD" }] <b>[{ $oPayment->oxpayments__oxdesc->value }] [{ if $oBasket->dAddPaymentSum }]([{ $oBasket->fAddPaymentSum }] [{ $oCurrency->sign}])[{/if}]</b><br>
  [{ $oPayment->oxpayments__oxlongdesc->value }]<br>
  [{/if}]<br>
  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_EMAILADDRESS" }] [{ $oUser->oxuser__oxusername->value }]<br>
  <br>
  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_BILLINGADDRESS" }]  <br>
  [{ $oOrder->oxorder__oxbillcompany->value }]<br>
  [{ $oOrder->oxorder__oxbillsal->value|oxmultilangsal}] [{ $oOrder->oxorder__oxbillfname->value }] [{ $oOrder->oxorder__oxbilllname->value }]<br>
  [{if $oOrder->oxorder__oxbilladdinfo->value }][{ $oOrder->oxorder__oxbilladdinfo->value }]<br>[{/if}]
  [{ $oOrder->oxorder__oxbillstreet->value }] [{ $oOrder->oxorder__oxbillstreetnr->value }]<br>
  [{ $oOrder->oxorder__oxbillstateid->value }]
  [{ $oOrder->oxorder__oxbillzip->value }] [{ $oOrder->oxorder__oxbillcity->value }]<br>
  [{ $oOrder->oxorder__oxbillcountry->value }]<br>
  [{if $oOrder->oxorder__oxbillustid->value}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_VATIDNOMBER" }] [{ $oOrder->oxorder__oxbillustid->value }]<br>[{/if}]
  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_PHONE" }] [{ $oOrder->oxorder__oxbillfon->value }]<br><br>

  [{ if $oOrder->oxorder__oxdellname->value }]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGADDRESS" }]  <br>
    [{ $oOrder->oxorder__oxdelcompany->value }]<br>
    [{ $oOrder->oxorder__oxdelsal->value|oxmultilangsal }] [{ $oOrder->oxorder__oxdelfname->value }] [{ $oOrder->oxorder__oxdellname->value }]<br>
    [{if $oOrder->oxorder__oxdeladdinfo->value }][{ $oOrder->oxorder__oxdeladdinfo->value }]<br>[{/if}]
    [{ $oOrder->oxorder__oxdelstreet->value }] [{ $oOrder->oxorder__oxdelstreetnr->value }]<br>
    [{ $oOrder->oxorder__oxdelstateid->value }]
    [{ $oOrder->oxorder__oxdelzip->value }] [{ $oOrder->oxorder__oxdelcity->value }]<br>
    [{ $oOrder->oxorder__oxdelcountry->value }]<br>
  [{/if}]

  [{if $oPayment->oxuserpayments__oxpaymentsid->value != "oxempty"}][{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_SHIPPINGCARRIER" }] <strong>[{ $oDelSet->oxdeliveryset__oxtitle->value }]</strong><br>[{/if}]

  [{if $oPayment->oxuserpayments__oxpaymentsid->value == "oxidpayadvance"}]
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_BANK" }] [{$oShop->oxshops__oxbankname->value}]<br>
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ROUTINGNOMBER" }] [{$oShop->oxshops__oxbankcode->value}]<br>
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_ACCOUNTNOMBER" }] [{$oShop->oxshops__oxbanknumber->value}]<br>
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_BIC" }] [{$oShop->oxshops__oxbiccode->value}]<br>
    [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_IBAN" }] [{$oShop->oxshops__oxibannumber->value}]
  [{/if}]

  [{ oxcontent ident="oxuserorderemailend" }]

  [{if $oViewConf->showTs("ORDEREMAIL") && $oViewConf->getTsId() }]
  <br><br>
  [{ oxmultilang ident="EMAIL_ORDER_CUST_HTML_TS_RATINGS_RATEUS" }]<br><br>
  <a href="[{ $oViewConf->getTsRatingUrl() }]" target="_blank" title="[{ oxmultilang ident="TS_RATINGS_URL_TITLE" }]">
    <img src="https://www.trustedshops.com/bewertung/widget/img/bewerten_de.gif" border="0" alt="[{ oxmultilang ident="TS_RATINGS_BUTTON_ALT" }]" align="middle">
  </a>
  [{/if}]


    <br><br>
    [{ oxcontent ident="oxemailfooter" }]

  </body>
</html>
