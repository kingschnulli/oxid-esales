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

function EditThis( sID)
{
    var oTransfer = document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='article_main';
    oTransfer.submit();

    var oSearch = parent.list.document.getElementById("search");
    oSearch.actedit.value = 0;
    oSearch.oxid.value=sID;
    oSearch.submit();
}

function loadLang(obj)
{
    var langvar = document.getElementById("agblang");
    if (langvar != null )
        langvar.value = obj.value;
    document.myedit.submit();
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

        if (sStickerId == "_2")
            document.getElementsByName("defaultButton")[0].disabled = false;
    }
    else
    {
        oSticker.style.display = "none";
        if (sStickerId == "_2")
            document.getElementsByName("defaultButton")[0].disabled = true;
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
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="article_stock">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>



        <table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
        <form name="myedit" id="myedit" action="[{ $shop->selflink }]" method="post">
        <input type="hidden" name="cl" value="article_stock">
        <input type="hidden" name="fnc" value="">
        <input type="hidden" name="oxid" value="[{ $oxid }]">
        <input type="hidden" name="voxid" value="[{ $oxid }]">
        <input type="hidden" name="oxparentid" value="[{ $oxparentid }]">
        <input type="hidden" name="editval[article__oxid]" value="[{ $oxid }]">
        <tr>
          <td valign="top" class="edittext" style="padding-left:10px;width:50%">
            <table cellspacing="0" cellpadding="0" border="0">
              [{ if $oxparentid }]
              <tr>
                <td class="edittext" width="160">
                  <b>[{ oxmultilang ident="GENERAL_VARIANTE" }]</b>
                </td>
                <td class="edittext">
                  <a href="Javascript:EditThis('[{ $parentarticle->oxarticles__oxid->value}]');" class="edittext"><b>[{ $parentarticle->oxarticles__oxartnum->value }] [{ $parentarticle->oxarticles__oxtitle->value }]</b></a>
                </td>
              </tr>
              [{ /if}]
              <tr>
                <td class="edittext">
                  [{ oxmultilang ident="ARTICLE_STOCK_STOCK" }]
                </td>
                <td class="edittext">
                  <input type="text" class="editinput" size="20" maxlength="[{$edit->oxarticles__oxstock->fldmax_length}]" name="editval[oxarticles__oxstock]" value="[{$edit->oxarticles__oxstock->value}]" [{include file="help.tpl" helpid=article_stock}] [{ $readonly }]>
                </td>
              </tr>
              <tr>
                <td class="edittext">
                  [{ oxmultilang ident="ARTICLE_STOCK_STOCKFLAG" }]
                </td>
                <td class="edittext">
                  <select name="editval[oxarticles__oxstockflag]" class="editinput" [{ $readonly }]>
                    <option value="1" [{ if $edit->oxarticles__oxstockflag->value == 1 }]SELECTED[{/if}]>[{ oxmultilang ident="GENERAL_STANDARD" }]</option>
                    <option value="4" [{ if $edit->oxarticles__oxstockflag->value == 4 }]SELECTED[{/if}]>[{ oxmultilang ident="GENERAL_EXTERNALSTOCK" }]</option>
                    <option value="2" [{ if $edit->oxarticles__oxstockflag->value == 2 }]SELECTED[{/if}]>[{ oxmultilang ident="GENERAL_OFFLINE" }]</option>
                    <option value="3" [{ if $edit->oxarticles__oxstockflag->value == 3 }]SELECTED[{/if}]>[{ oxmultilang ident="GENERAL_NONORDER" }]</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="edittext">
                [{ oxmultilang ident="ARTICLE_STOCK_DELIVERY" }]
                </td>
                <td class="edittext">
                  <input type="text" class="editinput" size="20" maxlength="[{$edit->oxarticles__oxdelivery->fldmax_length}]" name="editval[oxarticles__oxdelivery]" value="[{$edit->oxarticles__oxdelivery|oxformdate}]" [{include file="help.tpl" helpid=article_delivery}] [{ $readonly }]>
                </td>
              </tr>
              <tr>
                <td class="edittext">
                  [{ oxmultilang ident="ARTICLE_STOCK_REMINDACTIV" }]
                </td>
                <td class="edittext">
                  <input type="checkbox" class="editinput" name="editval[oxarticles__oxremindactive]" value='[{if $edit->oxarticles__oxremindactive->value }][{ $edit->oxarticles__oxremindactive->value }][{else}]1[{/if}]' [{if $edit->oxarticles__oxremindactive->value }]checked[{/if}] [{ $readonly }]><input type="text" class="editinput" size="20" maxlength="[{$edit->oxarticles__oxremindamount->fldmax_length}]" name="editval[oxarticles__oxremindamount]" value="[{$edit->oxarticles__oxremindamount->value}]" [{ $readonly }]>
                </td>
              </tr>
              <tr>
                <td class="edittext" colspan="2"><br>
                  <fieldset title="[{ oxmultilang ident="GENERAL_ARTICLE_OXSTOCKTEXT" }]" style="padding-left: 5px;">
                  <legend>[{ oxmultilang ident="GENERAL_ARTICLE_OXSTOCKTEXT" }]</legend><br>
                  <table>
                    <tr>
                      <td class="edittext">
                        [{ oxmultilang ident="GENERAL_LANGUAGE" }]
                      </td>
                      <td class="edittext">
                         <select name="editlanguage" id="test_editlanguage" class="editinput" onChange="Javascript:loadLang(this);" [{$readonly}] [{$readonly_fields}]>
                         [{foreach from=$otherlang key=lang item=olang}]
                         <option value="[{ $lang }]"[{ if $olang->selected}]SELECTED[{/if}]>[{ $olang->sLangDesc }]</option>
                         [{/foreach}]
                         </select>
                      </td>
                    </tr>
                    <tr>
                      <td class="edittext">
                        [{ oxmultilang ident="ARTICLE_STOCK_STOCKTEXT" }]
                      </td>
                      <td class="edittext">
                        <input type="text" class="editinput" size="40" maxlength="[{$edit->oxarticles__oxstocktext->fldmax_length}]" name="editval[oxarticles__oxstocktext]" value="[{$edit->oxarticles__oxstocktext->value}]" [{ $readonly }]>
                      </td>
                    </tr>
                    <tr>
                      <td class="edittext">
                        [{ oxmultilang ident="ARTICLE_STOCK_NOSTOCKTEXT" }]
                      </td>
                      <td class="edittext">
                        <input type="text" class="editinput" size="40" maxlength="[{$edit->oxarticles__oxnostocktext->fldmax_length}]" name="editval[oxarticles__oxnostocktext]" value="[{$edit->oxarticles__oxnostocktext->value}]" [{ $readonly }]>
                      </td>
                    </tr>
                  </table>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <td class="edittext" colspan="2"><br><br>
                  <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }]><br>
                </td>
              </tr>
            </table>
          </td>
    <!-- Anfang rechte Seite -->
          <td valign="top" class="edittext" style="padding-top:10px;padding-left:10px;width:50%">
          [{ if $isstaffelpreis }]
            <fieldset title="[{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_TITLE" }]" style="padding-left: 5px; padding-right: 5px;">
            <legend>[{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_TITLE" }]</legend><br>
            <table cellspacing="0" cellpadding="1" border="0" >
            [{assign var=oddclass value="2"}]
            [{foreach from=$amountprices item=amountprice}]
              <tr>
              [{if $oddclass == 2}]
                [{assign var=oddclass value=""}]
              [{else}]
                [{assign var=oddclass value="2"}]
              [{/if}]
                <td class="listitem[{$oddclass}]" nowrap>
                  [{ oxmultilang ident="ARTICLE_STOCK_AMOUNT" }] [{$amountprice->oxprice2article__oxamount->value}]-[{$amountprice->oxprice2article__oxamountto->value}]
                </td>
                <td class="listitem[{$oddclass}]" nowrap>
                  &nbsp;&nbsp;[{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_PRICE" }]
                  [{if $amountprice->oxprice2article__oxaddabs->value}]
                    [{$amountprice->oxprice2article__oxaddabs->value}]
                  [{elseif $amountprice->oxprice2article__oxaddperc->value }]
                    [{$amountprice->oxprice2article__oxaddperc->value}] [{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_DISCOUNT" }]
                  [{/if}]
                </td>
                <td class=listitem[{$oddclass}]>
                  <a href="[{ $shop->selflink }]?cl=article_stock&priceid=[{$amountprice->oxprice2article__oxid->value}]&fnc=deleteprice&oxid=[{$oxid}]" onClick='return confirm("Wollen Sie diesen Eintrag wirklich l�schen ?")' class="delete"></a>
                </td>
              </tr>
            [{/foreach}]
              <tr><td colspan=3><hr></td></tr>
              <tr>
                <td class="edittext" colspan=3>
                  <table>
                    <tr>
                      <td class="edittext">
                        [{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_AMOUNTFROM" }]
                      </td>
                      <td class="edittext">
                        <input class="edittext" type="text" name="editval[oxprice2article__oxamount]">
                      </td>
                      <td class="edittext">
                        [{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_AMOUNTTO" }]
                      </td>
                      <td class="edittext">
                        <input class="edittext" type="text" name="editval[oxprice2article__oxamountto]">
                      </td>
                    </tr>
                    <tr>
                      <td class="edittext">
                        [{ oxmultilang ident="GENERAL_PRICE" }] :
                      </td>
                      <td class="edittext" nowrap colspan=3>
                        <select  class="edittext" name="editval[pricetype]">
                          <option value="oxprice2article__oxaddabs">[{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_ABS" }]
                          <option value="oxprice2article__oxaddperc">[{ oxmultilang ident="ARTICLE_STOCK_AMOUNTPRICE_DISCOUNT" }]
                        </select>
                        <input class="edittext" type="text" name="editval[price]">
                      </td>
                      <td>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan=3><br>
                  <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="ARTICLE_STOCK_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='addprice'""><br><br>
                </td>
              </tr>
            </table>
            [{/if}]
          </td>
        </tr>
        </form>
        </table>

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]