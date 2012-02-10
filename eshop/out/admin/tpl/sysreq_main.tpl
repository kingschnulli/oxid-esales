[{include file="headitem.tpl" title="SYSREQ_MAIN_TITLE"|oxmultilangassign}]

[{ if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<ul class="req">
    <h3>[{ oxmultilang ident="SYSREQ_DESCRIPTION_REQ" }]:</h3>
    [{foreach from=$aInfo item=aModules key=sGroupName}]
    <li class='group'>[{ oxmultilang ident="SYSREQ_"|cat:$sGroupName|oxupper }]
        [{foreach from=$aModules item=iModuleState key=sModule}]
            <ul>
                [{assign var="class" value=$oView->getModuleClass($iModuleState)}]
                [{if $sModule == "memory_limit" }]
