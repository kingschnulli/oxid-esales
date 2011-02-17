<div id="sidebar">

  [{block name="sidebar" }]
  <div class="category box">
    [{oxinclude file="tree/categories.tpl" categories=$oxcmp_categories}]
  </div>
  [{/block}]

  [{block name="sidebar"}]
  <div class="info box">
    [{oxinclude file="list/info.tpl"}]
  </div>
  [{/block}]

  [{block name="sidebar" if=$oxcmp_news|count }]
  <div class="news box">
    [{oxinclude file="list/news.tpl" news=$oxcmp_news}]
  </div>
  [{/block}]

  [{$oxid.block.sidebar}]
</div>