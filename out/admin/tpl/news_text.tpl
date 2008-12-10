[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

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

function loadLang(obj)
{
    var langvar = document.getElementById("catlang");
    if (langvar != null )
        langvar.value = obj.value;
    document.myedit.submit();
}

//-->
</script>

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="news_text">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

        <form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post" onSubmit="copyLongDesc( 'oxnews__oxlongdesc' );">
        [{ $shop->hiddensid }]
        <input type="hidden" name="cl" value="news_text">
        <input type="hidden" name="fnc" value="">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="voxid" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxnews__oxid]" value="[{ $oxid }]">
        <input type="hidden" name="editval[oxnews__oxlongdesc]" value="">
        [{include file="autosave.form.tpl"}]

        [{ $editor }]


        <br>
        [{if $languages}]<b>[{ oxmultilang ident="GENERAL_LANGUAGE" }]</b>
        <select name="newslang" class="editinput" onchange="Javascript:loadLang(this)" [{ $readonly }]>
        [{foreach key=key item=item from=$languages}]
          <option value="[{$key}]"[{if $newslang == $key}] SELECTED[{/if}]>[{$item->name}]</option>
        [{/foreach}]
        </select>
        [{/if}]
        <br>
        <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'" [{ $readonly }]>

</form>
[{include file="bottomnaviitem.tpl"}]
<
[{include file="bottomitem.tpl"}]
