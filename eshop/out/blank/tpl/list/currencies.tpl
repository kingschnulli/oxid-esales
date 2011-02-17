[{if $oView->loadCurrency()}]
<ul class="list currencies">
  [{foreach from=$oxcmp_cur item=_cur}]
  <li><a class="[{if $_cur->selected}]act[{/if}]" href="[{$_cur->link|oxaddparams:$oView->getDynUrlParams()}]" rel="nofollow">[{ $_cur->name }]</a>
  [{/foreach}]
</ul>
[{/if}]