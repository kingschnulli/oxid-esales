<ul class="list categories">
  [{foreach from=$categories item=_cat}]
  <li><a href="[{$_cat->getLink()}]" [{if $_cat->expanded}]class="exp"[{/if}]>[{$_cat->oxcategories__oxtitle->value}]</a></li>
  [{/foreach}]
</ul>