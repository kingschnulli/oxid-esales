[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
<!--
[{ if $updatelist == 1}]
    UpdateList('[{ $oxid }]');
[{ /if}]

function UpdateList( sID)
{
    var oSearch = parent.list.document.getElementById("search");
    oSearch.oxid.value=sID;
    oSearch.submit();
}
function SetSticker( sStickerId, oObject)
{
    if ( oObject.selectedIndex != -1)
    {   oSticker = document.getElementById(sStickerId);
        oSticker.style.display = "";
        oSticker.style.backgroundColor = "#FFFFCC";
        oSticker.style.borderWidth = "1px";
        oSticker.style.borderColor = "#000000";
        oSticker.style.borderStyle = "solid";
        oSticker.innerHTML         = oObject.item(oObject.selectedIndex).innerHTML;
    }
    else
        oSticker.style.display = "none";
}
//-->
</script>

[{ if $readonly }]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="attribute_main">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

<form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post">
[{ $shop->hiddensid }]
<input type="hidden" name="cl" value="attribute_main">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="editval[oxattribute__oxid]" value="[{ $oxid }]">

<table cellspacing="0" cellpadding="0" border="0" width="98%">
<tr>
    <td valign="top" class="edittext">

        <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td class="edittext" width="120">
            [{ oxmultilang ident="GENERAL_NAME" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="20" maxlength="[{$edit->oxattribute__oxtitle->fldmax_length}]" name="editval[oxattribute__oxtitle]" value="[{$edit->oxattribute__oxtitle->value}]" [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext" width="120">
            [{ oxmultilang ident="ATTRIBUTE_MAIN_SORTING" }]
            </td>
            <td class="edittext">
            <input type="text" class="editinput" size="20" maxlength="[{$edit->oxattribute__oxpos->fldmax_length}]" name="editval[oxattribute__oxpos]" value="[{$edit->oxattribute__oxpos->value}]" [{ $readonly }]>
            </td>
        </tr>
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
                [{include file="language_edit.tpl"}]
            </td>
        </tr>
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
            <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }]><br>
            </td>
        </tr>
        </table>
    </td>
    <!-- Anfang rechte Seite -->
    <td valign="top" class="edittext" align="left" width="50%">
    [{ if $oxid != "-1"}]
        <input [{ $readonly }] type="button" value="[{ oxmultilang ident="GENERAL_ASSIGNARTICLES" }]" class="edittext" onclick="JavaScript:showDialog('?cl=attribute_main&aoc=1&oxid=[{ $oxid }]');">
    [{ /if}]

    </td>
    <!-- Ende rechte Seite -->
    </tr>
</table>

</form>

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]
