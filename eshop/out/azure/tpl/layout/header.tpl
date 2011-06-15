<div id="header" class="clear">
  [{include file="widget/header/languages.tpl"}]
  [{include file="widget/header/currencies.tpl"}]
  [{oxscript include="js/widgets/oxflyoutbox.js" priority=10 }]
  [{oxscript add="$( '#servicesTrigger' ).oxFlyOutBox();"}]
  [{oxid_include_dynamic file="widget/header/servicebox.tpl"}]
  <ul id="topMenu">
    <li class="login flyout[{if $oxcmp_user->oxuser__oxpassword->value}] logged[{/if}]">
       [{include file="widget/header/loginbox.tpl"}]
    </li>
    [{if !$oxcmp_user}]
        <li><a id="registerLink" href="[{ oxgetseourl ident=$oViewConf->getSslSelfLink()|cat:"cl=register" }]" title="[{oxmultilang ident="PAGE_ACCOUNT_REGISTER_REGISTER"}]">[{oxmultilang ident="PAGE_ACCOUNT_REGISTER_REGISTER"}]</a></li>
    [{/if}]
  </ul>
  <a id="logo" href="[{$oViewConf->getHomeLink()}]" title="[{$oxcmp_shop->oxshops__oxtitleprefix->value}]"><img src="[{$oViewConf->getImageUrl()}]logo.png" alt="[{$oxcmp_shop->oxshops__oxtitleprefix->value}]"></a>
    [{include file="widget/header/topcategories.tpl"}]
    [{oxscript include="js/widgets/oxcountdown.js" priority=10 }]
    [{oxscript include="js/widgets/oxminibasket.js" priority=10 }]
    [{oxscript add="$( '#miniBasket' ).oxMiniBasket();"}]
    [{if $oxcmp_basket->getProductsCount() gte 8}]
        [{oxscript include="js/libs/scrollpane/jscrollpane.min.js"}]
        [{oxscript include="js/libs/scrollpane/mousewheel.js"}]
        [{oxscript include="js/libs/scrollpane/mwheelIntent.js"}]
        [{oxstyle include="css/libs/jscrollpane.css"}]
    [{/if}]
    [{oxid_include_dynamic file="widget/minibasket/minibasket.tpl"}]
    [{include file="widget/header/search.tpl"}]
</div>
[{if $oView->getClassName()=='start' && $oView->getBanners()|@count > 0 }]
    <div class="oxSlider">
        [{include file="widget/promoslider.tpl" }]
    </div>
[{/if }]
