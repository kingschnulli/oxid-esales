[{block name="widget_header_search_form"}]
    [{oxscript include="js/widgets/oxinnerlabel.js" priority=10 }]
    [{assign var="defaulInnerLabel" value="SEARCH_TITLE"|oxmultilangassign|upper}]
    [{oxscript add="$( '#searchParam' ).oxInnerLabel({ sDefaultValue : '`$defaulInnerLabel`'});"}]
    <form class="search" action="[{ $oViewConf->getSelfActionLink() }]" method="get" name="search">
        <div class="searchBox">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="search">
            [{block name="header_search_field"}]
                <input class="textbox" type="text" id="searchParam" name="searchparam" title="[{$defaulInnerLabel|upper}]" value="[{if $oView->getSearchParamForHtml()}][{$oView->getSearchParamForHtml()}][{else}][{$defaulInnerLabel|upper }][{/if}]">
            [{/block}]
            <input class="searchSubmit" type="submit" value="">
        </div>
    </form>
[{/block}]