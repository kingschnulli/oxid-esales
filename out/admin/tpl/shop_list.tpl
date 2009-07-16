[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign box="list"}]

[{ if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<script type="text/javascript">
<!--
function editThis( sID)
{
    var oTransfer = top.basefrm.edit.document.getElementById( "transfer" );
    oTransfer.oxid.value = sID;
    oTransfer.cl.value = top.oxid.admin.getClass( sID );
    oTransfer.fnc.value = 'chshp';

    //forcing edit frame to reload after submit
    top.forceReloadingEditFrame();

    var oSearch = top.basefrm.list.document.getElementById( "search" );
    oSearch.oxid.value = sID;
    oSearch.submit();
}

function deleteThis( sID)
{
    var currentshop = [{$oxid}];
    var newshop = (sID == currentshop)?1:currentshop;

    blCheck = confirm("[{ oxmultilang ident="SHOP_LIST_YOUWANTTODELETE" }]");
    if( blCheck == true)
    {   var oSearch = top.basefrm.list.document.getElementById( "search" );
        oSearch.delshopid.value = sID;
        oSearch.fnc.value = 'deleteentry';
        oSearch.actedit.value = 0;
        oSearch.submit();

        var oTransfer = top.basefrm.edit.document.getElementById( "transfer" );
        oTransfer.oxid.value = newshop;
        oTransfer.actshop.value = newshop;
        oTransfer.cl.value='[{ $default_edit }]';
        oTransfer.updatenav.value = 1;

        //forcing edit frame to reload after submit
        top.forceReloadingEditFrame();
    }
}

//-->
</script>

<form name="search" id="search" action="[{ $shop->selflink }]" method="post">
[{ $shop->hiddensid }]
<input type="hidden" name="cl" value="shop_list">
<input type="hidden" name="lstrt" value="[{ $lstrt }]">
<input type="hidden" name="sort" value="[{ $sort }]">
<input type="hidden" name="actedit" value="[{ $actedit }]">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="delshopid" value="">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="updatenav" value="">





[{include file="pagetabsnippet.tpl"}]

<script type="text/javascript">
if (parent.parent != null && parent.parent.setTitle )
{   parent.parent.sShopTitle   = "[{$actshopobj->oxshops__oxname->getRawValue()|oxaddslashes}]";
    parent.parent.sMenuItem    = "[{ oxmultilang ident="SHOP_LIST_MENUITEM" }]";
    parent.parent.sMenuSubItem = "[{ oxmultilang ident="SHOP_LIST_MENUSUBITEM" }]";
    parent.parent.sWorkArea    = "[{$_act}]";
    parent.parent.setTitle();
}
</script>
</body>
</html>
