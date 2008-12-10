[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly }]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="1">
    <input type="hidden" name="cl" value="">
</form>

        <table cellspacing="0" cellpadding="0" border="0">
        <form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post">
        [{ $shop->hiddensid }]
        <input type="hidden" name="cl" value="dyn_etracker">
        <input type="hidden" name="fnc" value="">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxshops__oxid]" value="[{ $oxid }]">
    		<tr>
      		 <td valign="top" class="edittext">
      		  	[{ oxmultilang ident="DYN_ETRACKER_SECURECODE" }]&nbsp;&nbsp;
      		 </td>
      		 <td valign="top" class="edittext">
      			<input type=text class="editinput" style="width:270px" name=confstrs[iShopID_etracker] value="[{$confstrs.iShopID_etracker}]" [{ $readonly }]>
      		 </td>
    		</tr>
        <tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
      		 <input type="submit" class="confinput" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }]>
            </td>
        </tr>
            </form>
        </table>

[{include file="bottomnaviitem.tpl" }]
[{include file="bottomitem.tpl"}]
