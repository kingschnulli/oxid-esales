[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="theme_main">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

[{if $aTheme}]
<table cellspacing="10" width="100%">
    <tr>
        <td width="20%" valign="top"><img src="[{ $oViewConf->getBaseDir() }]/out/[{$aTheme.id}]/[{$aTheme.thumbnail}]" hspace="20" vspace="10"></td>
        <td width="50%" valign="top">
            <h1 style="color:#000;font-size:25px;">[{$aTheme.title}]</h1>
            <p>[{$aTheme.description}]</p>
            <hr>
            <p style="color:#aaa;">
            <b>[{ oxmultilang ident="THEME_AUTHOR" }]</b> [{$aTheme.author}]<br><br>
            [{ oxmultilang ident="THEME_VERSION" }] [{$aTheme.version}]
            </p>
        </td>
        <td width="1%">
            <img src="[{ $oViewConf->getImageUrl() }]/grayline_vert.gif" width="2" height="270" alt="" border="0">
        </td>
        <td width="19%" valign="top">
            <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
                <p>
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="theme_main">
                <input type="hidden" name="fnc" value="setTheme">
                <input type="hidden" name="oxid" value="[{$aTheme.id}]">
                <input type="submit" value="[{ oxmultilang ident="THEME_ACTIVATE" }]">
                <p>
            </form>
        </td>
    </tr>
</table>
[{/if}]

[{include file="bottomitem.tpl"}]