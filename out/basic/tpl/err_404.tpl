[{assign var="template_title" value="ERR_404TITLE"|oxmultilangassign}]
[{include file="_header.tpl" title=$template_title location=$template_title}]
[{if $sUrl}]
    [{ oxmultilang ident="ERR_404_PREURL" }] <i><strong>'[{$sUrl}]'</strong></i> [{ oxmultilang ident="ERR_404_POSTURL" }]
[{else}]
    [{ oxmultilang ident="ERR_404" }]
[{/if}]

[{include file="_footer.tpl"}]
