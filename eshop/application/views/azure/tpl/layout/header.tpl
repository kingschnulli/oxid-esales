[{if $oViewConf->getTopActionClassName() != 'clearcookies' && $oViewConf->getTopActionClassName() != 'mallstart'}]
    [{oxid_include_widget cl="oxwBetaNote" nocookie=1}]
    [{oxid_include_widget cl="oxwCookieNote" _parent=$oView->getClassName() nocookie=1}]
[{/if}]
<div id="header" class="clear">
  [{oxid_include_widget cl="oxwLanguageList" lang=$oViewConf->getActLanguageId() _parent=$oView->getClassName() nocookie=1 cnid=$oViewConf->getActCatId() anid=$oViewConf->getActArticleId() listtype=$oViewConf->getActListType() searchparam=$oViewConf->getActSearchParam() searchtag=$oViewConf->getActSearchTag() mnid=$oViewConf->getActManufacturerId()}]
  [{oxid_include_widget cl="oxwCurrencyList" cur=$oViewConf->getActCurrency() _parent=$oView->getClassName() nocookie=1 cnid=$oViewConf->getActCatId() anid=$oViewConf->getActArticleId() listtype=$oViewConf->getActListType() searchparam=$oViewConf->getActSearchParam() searchtag=$oViewConf->getActSearchTag() mnid=$oViewConf->getActManufacturerId()}]

  [{if $oxcmp_user}]
      [{assign var="blAnon" value=0}]
  [{else}]
      [{assign var="blAnon" value=1}]
  [{/if}]

  [{ if $Errors.loginBoxErrors }]
      [{assign var="blLoginError" value="1"}]
  [{else}]
      [{assign var="blLoginError" value="0"}]
  [{/if}]

  [{oxid_include_widget cl="oxwServiceMenu" _parent=$oView->getClassName() cnid=$oViewConf->getActCatId() blLoginError=$blLoginError nocookie=$blAnon anid=$oViewConf->getActArticleId() listtype=$oViewConf->getActListType() searchparam=$oViewConf->getActSearchParam() searchtag=$oViewConf->getActSearchTag() mnid=$oViewConf->getActManufacturerId()}]

  [{assign var="slogoImg" value="logo.png"}]
  <a id="logo" href="[{$oViewConf->getHomeLink()}]" title="[{$oxcmp_shop->oxshops__oxtitleprefix->value}]"><img src="[{$oViewConf->getImageUrl($slogoImg)}]" alt="[{$oxcmp_shop->oxshops__oxtitleprefix->value}]"></a>
    [{oxid_include_widget cl="oxwCategoryTree" cnid=$oView->getCategoryId() sWidgetType="header" _parent=$oView->getClassName() nocookie=1}]

      [{if $oxcmp_basket->getProductsCount()}]
          [{assign var="blAnon" value=0}]
      [{else}]
          [{assign var="blAnon" value=1}]
      [{/if}]
    [{oxid_include_widget cl="oxwMiniBasket" nocookie=$blAnon}]
    [{include file="widget/header/search.tpl"}]
</div>
[{if $oView->getClassName()=='start' && $oView->getBanners()|@count > 0 }]
    <div class="oxSlider">
        [{include file="widget/promoslider.tpl" }]
    </div>
[{/if }]
