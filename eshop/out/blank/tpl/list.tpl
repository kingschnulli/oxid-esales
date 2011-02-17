[{oxlayout file="layout/page.tpl"}]

  <h1 class="head">[{$oView->getTitle()}]</h1>
  [{oxinclude file="list/categories.tpl" categories=$oView->getSubCatList() }]

  [{oxinclude file="block/locator.tpl" locator=$oView->getPageNavigation() }]

  [{oxinclude file="list/products.tpl" size="small" title="" products=$oView->getArticleList() }]

[{/oxlayout}]