[{capture append="oxidBlock_content"}]

    [{* ordering steps *}]
    [{include file="page/checkout/inc/steps.tpl" active=5 }]

    [{block name="checkout_thankyou_main"}]
        [{assign var="order" value=$oView->getOrder()}]
        [{assign var="basket" value=$oView->getBasket()}]

        <div id="thankyouPage">
            <h3 class="blockHead">[{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_TITLE" }]</h3>

            [{block name="checkout_thankyou_info"}]
                [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_THANKYOU1" }] [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_THANKYOU2" }] [{ $oxcmp_shop->oxshops__oxname->value }]. <br>
                [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_REGISTEREDYOUORDERNO1" }] [{ $order->oxorder__oxordernr->value }] [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_REGISTEREDYOUORDERNO2" }]<br>
                [{if !$oView->getMailError() }]
                    [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_YOURECEIVEDORDERCONFIRM" }]<br>
                [{else}]<br>
                    [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_CONFIRMATIONNOTSUCCEED" }]<br>
                [{/if}]
                <br>
                [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_WEWILLINFORMYOU" }]<br><br>
            [{/block}]

            [{block name="checkout_thankyou_proceed"}]
                [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_YOUCANGO" }]
                <a id="backToShop" rel="nofollow" href="[{ oxgetseourl ident=$oViewConf->getHomeLink() }]" class="link">[{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_BACKTOSHOP" }]</a>
                [{if $oxcmp_user->oxuser__oxpassword->value }]
                    [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_OR" }]
                    <a id="orderHistory" rel="nofollow" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account_order" }]" class="link">[{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_ORDERHISTORY" }]</a>.
                [{/if}]
            [{/block}]

            [{block name="checkout_thankyou_ts"}]
                [{if $oViewConf->showTs("THANKYOU") && $oViewConf->getTsId() }]
                    [{assign var="sTSRatingImg" value="https://www.trustedshops.com/bewertung/widget/img/bewerten_"|cat:$oView->getActiveLangAbbr()|cat:".gif"}]
                    <h3 class="blockHead">[{ oxmultilang ident="TS_RATINGS" }]</h3>
                    [{ oxmultilang ident="TS_RATINGS_RATEUS" }]
                    <div class="etrustTsRatingButton">
                        <a href="[{ $oViewConf->getTsRatingUrl() }]" target="_blank" title="[{ oxmultilang ident="TS_RATINGS_URL_TITLE" }]">
                            <img src="[{$sTSRatingImg}]" border="0" alt="[{ oxmultilang ident="TS_RATINGS_BUTTON_ALT" }]" align="middle">
                        </a>
                    </div>
                [{/if}]
            [{/block}]

            [{block name="checkout_thankyou_partners"}]
                [{if ( $oView->getTrustedShopId()) }]
                    <h3 class="blockHead">[{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_PARTNERFROM" }]</h3>
                    [{if $oView->getTrustedShopId()}]
                        <div class="etrustlogocol">
                            <a href="https://www.trustedshops.com/shop/certificate.php?shop_id=[{$oView->getTrustedShopId()}]" target="_blank">
                                <img src="[{$oViewConf->getImageUrl('trustedshops_m.gif')}]" title="[{ oxmultilang ident="INC_TRUSTEDSHOPS_ITEM_IMGTITLE" }]">
                            </a>
                        </div>
                        <form id="formTsShops" name="formTShops" method="post" action="https://www.trustedshops.com/shop/protection.php" target="_blank">
                          <div>
                              <input type="hidden" name="_charset_">
                              <input name="shop_id" type=hidden value="[{$oView->getTrustedShopId()}]">
                              <input name="email" type="hidden" value="[{ $oxcmp_user->oxuser__oxusername->value }]">
                              <input name="amount" type=hidden value="[{ $order->getTotalOrderSum() }]">
                              <input name="curr" type=hidden value="[{ $order->oxorder__oxcurrency->value }]">
                              <input name="payment" type=hidden value="">
                              <input name="KDNR" type="hidden" value="[{ $oxcmp_user->oxuser__oxcustnr->value }]">
                              <input name="ORDERNR" type="hidden" value="[{ $order->oxorder__oxordernr->value }]">
                              [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_TRUSTEDSHOPMESSAGE" }]<br><br>
                              <span><input type="submit" id="btnProtect" name="btnProtect" value="[{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_LOGGIN" }]"></span>
                          </div>
                        </form>
                        <div class="clear"></div>
                    [{/if}]
                [{/if}]
            [{/block}]

            [{if $oView->getAlsoBoughtTheseProducts()}]
                <br><br>
                <h1 class="pageHead">
                     [{ oxmultilang ident="PAGE_CHECKOUT_THANKYOU_ALSOBOUGHT" }]
                </h1>
                [{include file="widget/product/list.tpl" type=$oView->getListDisplayType() listId="alsoBoughtThankyou" products=$oView->getAlsoBoughtTheseProducts() blDisableToCart=true}]
            [{/if}]
        </div>
    [{/block}]
    [{insert name="oxid_tracker" title=$template_title }]
[{/capture}]
[{include file="layout/page.tpl"}]