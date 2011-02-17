<div id="header">
  <a class="logo" href="[{$oViewConf->getHomeLink()}]"><img src="[{$oViewConf->getImageUrl()}]logo.png" alt="[{$oxcmp_shop->oxshops__oxtitleprefix->value}]"></a>
  [{oxinclude file="list/currencies.tpl"}]
  [{oxinclude file="list/languages.tpl"}]
  <div class="menu">
    <a href="[{ $oViewConf->getHomeLink()}]" class="link home">[{oxmultilang ident="LINK_HOME"}]</a>
    [{oxinclude file="list/categories.tpl" categories=$oxcmp_categories}]
    <div class="search box">
    [{oxinclude file="form/search.tpl"}]
    </div>
  </div>
  [{$oxid.block.header}]
</div>