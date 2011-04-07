<div class="dropDown">

    <p class="selectorLabel underlined">
        <label>[{$oSelectionList->getLabel()}]:</label>
        [{assign var="oActiveSelection" value=$oSelectionList->getActiveSelection()}]
        [{if $oActiveSelection }]
            [{assign var="blHasActiveSelections" value=true}]
            <span>[{$oActiveSelection->getName()}]</span>
        [{else}]
            <span>[{ oxmultilang ident="WIDGET_PRODUCT_ATTRIBUTES_PLEASECHOOSE" }]</span>
        [{/if}]
    </p>

    <input type="hidden" name="varselid[[{$iKey}]]" value="[{if $oActiveSelection }][{$oActiveSelection->getValue()}][{/if}]">
    <ul class="drop vardrop FXgradGreyLight shadow">
        [{if $oActiveSelection}]
            <li><a rel="" href="#">[{ oxmultilang ident="WIDGET_PRODUCT_ATTRIBUTES_PLEASECHOOSE" }]</a></li>
        [{/if}]
        [{assign var="aSelections" value=$oSelectionList->getSelections()}]
        [{foreach from=$aSelections item=oSelection}]
            <li class="[{if $oSelection->isDisabled()}]oxdisabled disabled[{/if}]">
                <a rel="[{$oSelection->getValue()}]" href="[{$oSelection->getLink()}]" class="[{if $oSelection->isActive()}]selected[{/if}]">[{$oSelection->getName()}]</a>
            </li>
        [{/foreach}]
    </ul>

</div>