[{oxlayout file="layout/page.tpl"}]

  <h1 class="head">[{$oContent->oxcontents__oxtitle->value}]</h1>
  <div class="content box hudge">[{ oxcontent oxid=$oView->getContentId() }]</div>

[{/oxlayout}]