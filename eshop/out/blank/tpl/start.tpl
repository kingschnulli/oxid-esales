[{oxlayout file="layout/page.tpl"}]

  [{oxinclude file="block/content.tpl" size="hudge" ident="oxstartwelcome"}]

  [{oxinclude file="block/product.tpl" size="large" product=$oView->getFirstArticle()}]

  [{oxinclude file="list/products.tpl" size="small" head="Top Article List" products=$oView->getTopArticleList()}]

  [{oxinclude file="list/products.tpl" size="small" head="Article List" products=$oView->getArticleList()}]

  [{oxinclude file="list/products.tpl" size="small" head="Newest Articles" products=$oView->getNewestArticles()}]

  [{oxinclude file="list/products.tpl" size="small" head="Cat Offer Article List" products=$oView->getCatOfferArticleList()}]

[{/oxlayout}]