<div class="list products">
  [{if $head}]<div class="head">[{$head}]</div>[{/if}]
  [{foreach from=$products item=_product}]
  [{include file="block/product.tpl" size=$size product=$_product}]
  [{/foreach}]
</div>