[{include file="headitem.tpl" box="list"
    title="PRICEALARM_SEND_TITLE"|oxmultilangassign box="list"
    meta_refresh_sec="2"
    meta_refresh_url="`$shop->selflink`&cl=pricealarm_send&iStart=`$iStart`&iAllCnt=`$iAllCnt`"
}]

<script type="text/javascript">
<!--
window.onload = function ()
{
    top.reloadEditFrame();
    [{ if $updatelist == 1}]
        top.oxid.admin.updateList('[{ $oxid }]');
    [{ /if}]
}
//-->
</script>
<body>

<form name="search" id="search" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="cl" value="pricealarm_list">
    <input type="hidden" name="lstrt" value="[{ $lstrt }]">
    <input type="hidden" name="sort" value="[{ $sort }]">
    <input type="hidden" name="actedit" value="[{ $actedit }]">
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="language" value="[{ $actlang }]">
    <input type="hidden" name="editlanguage" value="[{ $actlang }]">
</form>

<div class="liste">
<center>
<h1>[{ oxmultilang ident="PRICEALARM_SEND_SENDED" }] [{ $iStart}] [{ oxmultilang ident="PRICEALARM_SEND_FROM" }] [{$iAllCnt}].</h1>
</center
</div>

[{include file="pagetabsnippet.tpl" noOXIDCheck="true"}]
</body>
</html>