<form class="search" action="[{ $oViewConf->getSelfActionLink() }]" method="get">
    <div class="searchBox">
        [{ $oViewConf->getHiddenSid() }]
        <input type="hidden" name="cl" value="search">
        <input class="textbox innerLabel" type="text" id="searchparam" name="searchparam" title="[{ oxmultilang ident="SEARCH_TITLE" }]" value="[{if $oView->getSearchParamForHtml()}][{$oView->getSearchParamForHtml()}][{else}][{ oxmultilang ident="SEARCH_TITLE" }][{/if}]">
        [{* <input type="submit" value="search"> *}]
    </div>
</form>