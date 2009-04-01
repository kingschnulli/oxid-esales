[{include file="headitem.tpl" title="CONTENT_MAIN_TITLE"|oxmultilangassign}]

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

function EditThis( sID)
{
    var oTransfer = document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='content_main';
    oTransfer.submit();

    var oSearch = parent.list.document.getElementById("search");
    oSearch.oxid.value=sID;
    oSearch.submit();
}

function UnlockMenue(obj)
{
    if( obj.checked)
    {
        document.getElementById('oxtype1').disabled = true;
        document.getElementById('oxtype2').disabled = true;
        document.getElementById('oxtype3').disabled = true;
    }
    else
    {
        document.getElementById('oxtype1').disabled = false;
        document.getElementById('oxtype2').disabled = false;
        document.getElementById('oxtype3').disabled = false;
    }
}

function ShowMenueFields( iVal)
{

    if( iVal == 2)
    {
        document.getElementById('cattree').style.visibility = 'visible';
    }
    else
    {
        document.getElementById('cattree').style.visibility = 'hidden';
    }

    if( iVal == 3)
    {
        document.getElementById('manuell').style.visibility = 'visible';
    }
    else
    {
        document.getElementById('manuell').style.visibility = 'hidden';
    }
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
    <input type="hidden" name="cl" value="content_main">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

        <table cellspacing="0" cellpadding="0" border="0" width="98%">
          <colgroup><col width="30%"><col width="5%"><col width="65%"></colgroup>
          <form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post" onSubmit="copyLongDesc( 'oxcontents__oxcontent' );">
          [{ $shop->hiddensid }]
          <input type="hidden" name="cl" value="content_main">
          <input type="hidden" name="fnc" value="">
          <input type="hidden" name="oxid" value="[{ $oxid }]">
          <input type="hidden" name="editval[oxcontents__oxid]" value="[{ $oxid }]">
          <input type="hidden" name="folderclass" value="oxcontent">
          <input type="hidden" name="editval[oxcontents__oxcontent]" value="">
          <tr>
            <td valign="top" class="edittext" width="200">
              <table cellspacing="0" cellpadding="0" border="0">

                [{ if $blLoadError }]
                <tr>
                  <td colspan="2">
                    <div class="errorbox">[{ oxmultilang ident="CONTENT_MAIN_ERROR" }] [{ oxmultilang ident="CONTENT_MAIN_USEDIDENTCODE" }]</div>
                  </td>
                </tr>
                [{ /if}]

                <tr>
                  <td class="edittext" width="70">
                  [{ oxmultilang ident="GENERAL_ACTIVE" }]
                  </td>
                  <td class="edittext">
                  <input class="edittext" type="checkbox" name="editval[oxcontents__oxactive]" value='1' [{if $edit->oxcontents__oxactive->value == 1}]checked[{/if}] [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  [{ oxmultilang ident="GENERAL_TITLE" }]
                  </td>
                  <td class="edittext">
                  <input type="text" class="editinput" size="28" maxlength="[{$edit->oxcontents__oxtitle->fldmax_length}]" name="editval[oxcontents__oxtitle]" value="[{$edit->oxcontents__oxtitle->value}]" [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  [{ oxmultilang ident="GENERAL_IDENT" }].
                  </td>
                  <td class="edittext">
                  <input type="text" class="editinput" size="28" maxlength="[{$edit->oxcontents__oxloadid->fldmax_length}]" name="editval[oxcontents__oxloadid]" value="[{$edit->oxcontents__oxloadid->value}]" [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                    [{ oxmultilang ident="GENERAL_INFOLDER" }]
                  </td>
                  <td class="edittext">
                    <select name="editval[oxcontents__oxfolder]" class="folderselect" [{ $readonly }]>
                    [{foreach from=$afolder key=field item=color}]
                    <option value="[{ $field }]" [{ if $edit->oxcontents__oxfolder->value == $field || ($field|replace:"_RR":""=="CMSFOLDER_NONE")&&($edit->oxcontents__oxfolder->value == "")}]SELECTED[{/if}] style="color: [{ $color }];">[{ oxmultilang ident=$field }]</option>
                    [{/foreach}]
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="edittext" colspan="2"><br>
                  [{include file="language_edit.tpl"}]<br>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  [{ oxmultilang ident="CONTENT_MAIN_SNIPPET" }]
                  </td>
                  <td class="edittext">
                  <input type="radio" name="editval[oxcontents__oxtype]" id="oxtype0" value="0" class="edittext" onClick="javascript:ShowMenueFields( 0);" [{if $edit->oxcontents__oxsnippet->value == 1}]CHECKED[{/if}] [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  [{ oxmultilang ident="CONTENT_MAIN_MAINMENU" }]
                  </td>
                  <td class="edittext">
                  <input type="radio" name="editval[oxcontents__oxtype]" id="oxtype1" value="1" class="edittext" onClick="javascript:ShowMenueFields( 1);" [{if $edit->oxcontents__oxtype->value == 1}]CHECKED[{/if}] [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  [{ oxmultilang ident="GENERAL_CATEGORY" }]
                  </td>
                  <td class="edittext">
                  <input type="radio" name="editval[oxcontents__oxtype]" id="oxtype2" value="2" class="edittext" onClick="javascript:ShowMenueFields( 2);" [{if $edit->oxcontents__oxtype->value == 2}]CHECKED[{/if}] [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  [{ oxmultilang ident="GENERAL_MANUEL" }]
                  </td>
                  <td class="edittext">
                  <input type="radio" name="editval[oxcontents__oxtype]" id="oxtype3" value="3" class="edittext" onClick="javascript:ShowMenueFields( 3);" [{if $edit->oxcontents__oxtype->value == 3}]CHECKED[{/if}] [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td style="padding-top:20px;padding-bottom:20px;" colspan="2">
                    <hr>
                  </td>
                </tr>
                <tr id="cattree" [{if $edit->oxcontents__oxtype->value != 2}]style="display:none;"[{/if}]>
                  <td class="edittext">
                  [{ oxmultilang ident="CONTENT_MAIN_INSERTBEFORE" }]
                  </td>
                  <td class="edittext">
                    <select name="editval[oxcontents__oxcatid]" class="editinput" [{ $readonly }]>
                    [{foreach from=$cattree item=pcat}]
                    <option value="[{ $pcat->oxcategories__oxid->value }]" [{ if $pcat->selected}]SELECTED[{/if}]>[{ $pcat->oxcategories__oxtitle->value|oxtruncate:33:"..":true }]</option>
                    [{/foreach}]
                    </select>
                  </td>
                </tr>
                <tr id="manuell" [{if $edit->oxcontents__oxtype->value != 3}]style="display:none;"[{/if}]>
                  <td class="edittext">
                  [{ oxmultilang ident="GENERAL_LINK" }]
                  </td>
                  <td class="edittext">
                  <input type="text" size="28" class="edittext" style="font-size: 7pt;" value="[{ $link }]" [{ $readonly }]>
                  </td>
                </tr>
                <tr>
                  <td class="edittext">
                  </td>
                  <td class="edittext">
                  <input type="submit" class="edittext" name="saveContent" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }]><br>
                  </td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
            <!-- Anfang rechte Seite -->
            <td valign="top" class="edittext" align="left">
                [{ $editor }]
            </td>
            <!-- Ende rechte Seite -->
          </tr>
     </table>
    </form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]
