[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="category_pictures">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>


<table cellspacing="0" cellpadding="0" border="0" width="98%">
<tr>
    <td valign="top" class="edittext">
      [{$edit->oxcategories__oxtitle->value }] [{ oxmultilang ident="GENERAL_THUMB" }]
      [{if $edit->oxcategories__oxthumb->value }]
        :<br><br>
        <img src="[{$shop->dimagedir}]/0/[{$edit->oxcategories__oxthumb->value }]" border="0" hspace="0" vspace="0">
      [{/if}]
    </td>
    <td valign="top" class="edittext">
      [{$edit->oxcategories__oxtitle->value }] [{ oxmultilang ident="GENERAL_ICON" }]
      [{if $edit->oxcategories__oxicon->value }]
        :<br><br>
        <img src="[{$shop->dimagedir}]/icon/[{$edit->oxcategories__oxicon->value }]" border="0" hspace="0" vspace="0">
      [{/if}]
    </td>
</tr>
</table>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]