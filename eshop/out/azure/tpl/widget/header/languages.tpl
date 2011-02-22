[{if $oView->isLanguageLoaded()}]
<div class="topPopList">
    [{capture name="languageList"}]
        [{foreach from=$oxcmp_lang item=_lng}]
        [{if $_lng->selected}]
            [{capture name="languageSelected"}]
                <a class="flag [{$_lng->abbr }]" href="[{$_lng->link|oxaddparams:$oView->getDynUrlParams()}]" hreflang="[{$_lng->abbr }]"><span>[{$_lng->name}]</span></a>
            [{/capture}]
        [{/if}]
            <li><a class="flag [{$_lng->abbr }] [{if $_lng->selected}]selected[{/if}]" href="[{$_lng->link|oxaddparams:$oView->getDynUrlParams()}]" hreflang="[{$_lng->abbr }]"><span>[{$_lng->name}]</span></a></li>
        [{/foreach}]
    [{/capture}]  
    <p id="languageTrigger" class="selectedValue">
        [{$smarty.capture.languageSelected}]
    </p>
    <div class="flyoutBox">
    <ul id="languages" class="corners">
        <li class="active">[{$smarty.capture.languageSelected}]</li>
        [{$smarty.capture.languageList}]
    </ul>
    </div>
</div>
[{/if}]