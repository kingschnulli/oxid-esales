<div class="select">
  <ul class="select">
    [{foreach key=iSel from=$oView->getSelectLists() item=oList}]
      <li class="label ox-select">
        <span>[{ $oList.name }]:</span>
        <a class="ox-select-link" href="#sel-[{$iSel}]">[{ $oFirstSelItem->name }]</a>
        <select id="selectList_[{$oDetailsProduct->oxarticles__oxid->value}]_[{$iSel}]" name="sel[[{$iSel}]]">
            [{foreach key=iSelIdx from=$oList item=oSelItem}]
              [{ if $oSelItem->name }]
                <option value="[{$iSelIdx}]">[{ $oSelItem->name }]</option>
              [{/if}]
            [{/foreach}]
        </select>
      </li>
      [{assign var='oFirstSelItem' value=null}]
    [{/foreach}]
  </ul>
</div>