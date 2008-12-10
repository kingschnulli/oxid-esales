[{include file="headitem.tpl" title="SHOWLIST_TITLE"|oxmultilangassign box=" "}]

<script type="text/javascript">
<!--
function EditThis( sID)
{
    var oTransfer = document.getElementById( "transfer" );
    oTransfer.oxid.value = sID;
    oTransfer.cl.value = 'admin_user';
    oTransfer.submit();
}

function ChangeLanguage()
{
    var oList = document.getElementById("showlist");
    oList.language.value=oList.changelang.value;
    oList.editlanguage.value=oList.changelang.value;
    oList.submit();
}

//-->
</script>

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="list_user">
    <input type="hidden" name="updatelist" value="1">
    <input type="hidden" name="language" value="[{ $actlang }]">
    <input type="hidden" name="editlanguage" value="[{ $actlang }]">
</form>

[{ if $noresult }]
    <span class="listitem">
        <b>[{ oxmultilang ident="SHOWLIST_NORESULTS" }]</b><br><br>
    </span>
[{/if}]

<div id="liste">


<form name="showlist" id="showlist" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="cl" value="list_user">
    <input type="hidden" name="sort" value="">

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
    <td class="listfilter first">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxuser.oxfname]" value="[{ $where->oxuser__oxfname }]">
        </div></div>
    </td>
    <td class="listfilter">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxuser.oxlname]" value="[{ $where->oxuser__oxlname }]">
        </div></div>
    </td>
    <td class="listfilter">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxuser.oxusername]" value="[{ $where->oxuser__oxusername }]">
        </div></div>
    </td>
    <td class="listfilter">
        <div class="r1"><div class="b1">
        <div class="find"><input class="listedit" type="submit" name="submitit" value="[{ oxmultilang ident="GENERAL_SEARCH" }]"></div>
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxuser.oxregister]" value="[{ $where->oxuser__oxregister|oxformdate }]">
        </div></div>
    </td>
</tr>
<tr>
    <td class="listheader first"><a href="javascript:document.forms.showlist.sort.value='oxuser.oxfname';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snpuserlistoxfname" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxuser.oxlname';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snpuserlistoxlname" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxuser.oxusername';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snpuserlistoxusername" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxuser.oxregister';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snpuserlistoxcreate" }]</a></td>
</tr>

[{assign var="blWhite" value=""}]
[{assign var="_cnt" value=0}]
[{foreach from=$mylist item=oUser}]
    [{assign var="_cnt" value=$_cnt+1}]
    <tr id="row.[{$_cnt}]">
    
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{$oUser->oxuser__oxid->value}]');" class="listitem[{ $blWhite }]">[{ $oUser->oxuser__oxfname->value }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{$oUser->oxuser__oxid->value}]');" class="listitem[{ $blWhite }]">[{ $oUser->oxuser__oxlname->value }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{$oUser->oxuser__oxid->value}]');" class="listitem[{ $blWhite }]">[{ $oUser->oxuser__oxusername->value }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{$oUser->oxuser__oxid->value}]');" class="listitem[{ $blWhite }]">[{ $oUser->oxuser__oxregister|oxformdate }]</a></td>
</tr>
[{if $blWhite == "2"}]
    [{assign var="blWhite" value=""}]
[{else}]
    [{assign var="blWhite" value="2"}]
[{/if}]
[{/foreach}]

</table>
</form>

<script type="text/javascript">
if (parent.parent)
{   parent.parent.sShopTitle   = "[{$actshopobj->oxshops__oxname->value}]";
    parent.parent.sMenuItem    = "";
    parent.parent.sMenuSubItem = "[{ oxmultilang ident="snpuserlistheader" }]";
    parent.parent.sWorkArea    = "[{$_act}]";
    parent.parent.setTitle();
}
</script>
</body>
</html>
