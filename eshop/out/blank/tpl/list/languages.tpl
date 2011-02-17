[{if $oView->isLanguageLoaded()}]
<ul class="list languages">
  [{foreach from=$oxcmp_lang item=_lng}]
  <li><a class="flag [{$_lng->abbr }] [{if $_lng->selected}]act[{/if}]" href="[{$_lng->link|oxaddparams:$oView->getDynUrlParams()}]" hreflang="[{$_lng->abbr }]">[{$_lng->name}]</a></li>
  [{/foreach}]
</ul>
[{/if}]