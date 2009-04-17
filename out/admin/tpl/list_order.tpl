[{include file="headitem.tpl" title="SHOWLIST_TITLE"|oxmultilangassign box=" "}]

<script type="text/javascript">
<!--
function EditThis( sID)
{
    [{assign var="shMen" value=1}]

    [{foreach from=$menustructure item=menuholder }]
      [{if $shMen && $menuholder->nodeType == XML_ELEMENT_NODE && $menuholder->childNodes->length }]

        [{assign var="shMen" value=0}]
        [{assign var="mn" value=1}]

        [{foreach from=$menuholder->childNodes item=menuitem }]
          [{if $menuitem->nodeType == XML_ELEMENT_NODE && $menuitem->childNodes->length }]
            [{ if $menuitem->getAttribute('id') == 'mxorders' }]

              [{foreach from=$menuitem->childNodes item=submenuitem }]
                [{if $submenuitem->nodeType == XML_ELEMENT_NODE && $submenuitem->getAttribute('cl') == 'admin_order' }]

                    if ( top && top.navigation && top.navigation.adminnav ) {
                        var _sbli = top.navigation.adminnav.document.getElementById( 'nav-1-[{$mn}]-1' );
                        var _sba = _sbli.getElementsByTagName( 'a' );
                        top.navigation.adminnav._navAct( _sba[0] );
                    }

                [{/if}]
              [{/foreach}]

            [{ /if }]
            [{assign var="mn" value=$mn+1}]

          [{/if}]
        [{/foreach}]
      [{/if}]
    [{/foreach}]

    var oTransfer = document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='admin_order';
    oTransfer.submit();
}

function ChangeListSize()
{
    document.forms.showlist.submit();
}


//-->
</script>

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="list_order">
    <input type="hidden" name="updatelist" value="1">
</form>

[{ if $noresult }]
    <span class="listitem">
        <b>[{ oxmultilang ident="SHOWLIST_NORESULTS" }]</b><br><br>
    </span>
[{/if}]

<div id="liste">

<form name="showlist" id="showlist" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="cl" value="list_order">
    <input type="hidden" name="sort" value="">

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
    <td class="listfilter first">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxorder.oxorderdate]" value="[{ $where->oxorder__oxorderdate|oxformdate }]">
        </div></div>
    </td>
    <td class="listfilter">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxorderarticles.oxartnum]" value="[{ $where->oxorderarticles__oxartnum }]">
        </div></div>
    </td>
    <td class="listfilter">
        <div class="r1"><div class="b1">&nbsp;</div></div>
    </td>
    <td class="listfilter">
        <div class="r1"><div class="b1">
        <input class="listedit" type="text" size="15" maxlength="128" name="where[oxorderarticles.oxtitle]" value="[{ $where->oxorderarticles__oxtitle }]">
        </div></div>
    </td>    
    <td class="listfilter" colspan="2">
        <div class="r1">
          <div class="b1">
          <div class="find">
          <select name="viewListSize" class="editinput" onChange="JavaScript:ChangeListSize()">
            <option value="50" [{ if $viewListSize == 50 }]SELECTED[{/if}]>50</option>
            <option value="100" [{ if $viewListSize == 100 }]SELECTED[{/if}]>100</option>
            <option value="200" [{ if $viewListSize == 200 }]SELECTED[{/if}]>200</option>
          </select>          
          <input class="listedit" type="submit" name="submitit" value="[{ oxmultilang ident="GENERAL_SEARCH" }]">
        </div>
        </div>
      </div>
    </td>
</tr>
<tr>
    <td class="listheader first"><a href="javascript:document.forms.showlist.sort.value='oxorder.oxorderdate';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snporderlistoxorderdate" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxorderarticles.oxartnum';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snporderlistoxartnum" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxorderamount';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snporderlistsum" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxorderarticles.oxtitle';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="snporderlistoxtitle" }]</a></td>
    <td class="listheader"><a href="javascript:document.forms.showlist.sort.value='oxprice';document.forms.showlist.submit();" class="listheader">[{ oxmultilang ident="price" }]</a></td>
</tr>

[{assign var="blWhite" value=""}]
[{assign var="_cnt" value=0}]
[{foreach from=$mylist item=oOrder}]
    [{assign var="_cnt" value=$_cnt+1}]
    <tr id="row.[{$_cnt}]">

    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{ $oOrder->oxorder__oxorderid->value }]');" class="listitem[{ $blWhite }]">[{ $oOrder->oxorder__oxorderdate|oxformdate }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{ $oOrder->oxorder__oxorderid->value }]');" class="listitem[{ $blWhite }]">[{ $oOrder->oxorder__oxartnum->value }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{ $oOrder->oxorder__oxorderid->value }]');" class="listitem[{ $blWhite }]">[{ $oOrder->oxorder__oxorderamount->value }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{ $oOrder->oxorder__oxorderid->value }]');" class="listitem[{ $blWhite }]">[{ $oOrder->oxorder__oxtitle->getRawValue() }]</a></td>
    <td class="listitem[{ $blWhite }]"><a href="Javascript:EditThis( '[{ $oOrder->oxorder__oxorderid->value }]');" class="listitem[{ $blWhite }]">[{ $oOrder->oxorder__oxprice->value }]</a></td>
</tr>
[{if $blWhite == "2"}]
    [{assign var="blWhite" value=""}]
[{else}]
    [{assign var="blWhite" value="2"}]
[{/if}]
[{/foreach}]
[{include file="pagenavisnippet.tpl" colspan="8"}]

</table>
</form>
[{ if $sumresult}]
<span class="listitem">
<b>[{ oxmultilang ident="SHOWLIST_SUM" }]:</b> [{ $sumresult}]<br>
</span>
[{/if}]
</div>

<script type="text/javascript">
if (parent.parent)
{   parent.parent.sShopTitle   = "[{$actshopobj->oxshops__oxname->getRawValue()|oxaddslashes}]";
    parent.parent.sMenuItem    = "";
    parent.parent.sMenuSubItem = "[{ oxmultilang ident="snporderlistheader" }]";
    parent.parent.sWorkArea    = "[{$_act}]";
    parent.parent.setTitle();
}
</script>
</body>
</html>
