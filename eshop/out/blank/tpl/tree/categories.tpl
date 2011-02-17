<ul class="tree categories">
[{defun name="tree" categories=$categories}]
  [{foreach from=$categories item=_cat}]
  <li>
    <a href="[{$_cat->getLink()}]" [{if $_cat->expanded}]class="exp"[{/if}]>[{$_cat->oxcategories__oxtitle->value}]</a>
    [{if $_cat->getSubCats() && $_cat->expanded}]
    <ul>
      [{fun name="tree" categories=$_cat->getSubCats()}]
    </ul>
    [{/if}]
  </li>
  [{/foreach}]
[{/defun}]
</ul>