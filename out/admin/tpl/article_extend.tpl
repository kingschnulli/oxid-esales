[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]
[{ if $readonly }]
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

function EditThis( sID)
{
    var oTransfer = parent.edit.document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='article_main';
    
    //forcing edit frame to reload after submit
    top.forceReloadingEditFrame();
            
    var oSearch = parent.list.document.getElementById("search");
    oSearch.actedit.value = 0;
    oSearch.oxid.value=sID;
    oSearch.submit();
}

window.onLoad = top.reloadEditFrame();

//-->
</script>

<form name="transfer" id="transfer" action="[{ $shop->selflink }]" method="post">
    [{ $shop->hiddensid }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="article_extend">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

<form name="myedit" id="myedit" action="[{ $shop->selflink }]" enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="[{$iMaxUploadFileSize}]">
[{ $shop->hiddensid }]
<input type="hidden" name="cl" value="article_extend">
<input type="hidden" name="fnc" value="">
<input type="hidden" name="oxid" value="[{ $oxid }]">
<input type="hidden" name="voxid" value="[{ $oxid }]">
<input type="hidden" name="oxparentid" value="[{ $oxparentid }]">
<input type="hidden" name="editval[article__oxid]" value="[{ $oxid }]">
[{include file="autosave.form.tpl"}]



  <table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
    <tr height="10">
      <td></td><td></td>
    </tr>
    <tr>
      <td width="15"></td>
      <td valign="top" class="edittext">

        <table cellspacing="0" cellpadding="0" border="0">
          [{ if $errorsavingtprice }]
            <tr>
              <td colspan="2">
                [{ if $errorsavingtprice eq 1 }]
                <div class="errorbox">[{ oxmultilang ident="ARTICLE_MAIN_ERRORSAVINGTPRICE" }]</div>
                [{/if}]
              </td>
            </tr>
          [{ /if}]
          [{ if $oxparentid }]
          <tr>
            <td class="edittext" width="120">
              <b>[{ oxmultilang ident="GENERAL_VARIANTE" }]</b>
            </td>
            <td class="edittext">
              <a href="Javascript:EditThis('[{ $parentarticle->oxarticles__oxid->value}]');" class="edittext"><b>[{ $parentarticle->oxarticles__oxartnum->value }] [{ $parentarticle->oxarticles__oxtitle->value }]</b></a>
            </td>
          </tr>
          [{ /if}]
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_WEIGHT" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="10" maxlength="[{$edit->oxarticles__oxweight->fldmax_length}]" name="editval[oxarticles__oxweight]" value="[{$edit->oxarticles__oxweight->value}]" [{ $readonly }]>kg
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_MASS" }]
            </td>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_LENGTH" }]&nbsp;<input type="text" class="editinput" size="3" maxlength="[{$edit->oxarticles__oxlength->fldmax_length}]" name="editval[oxarticles__oxlength]" value="[{$edit->oxarticles__oxlength->value}]" [{ $readonly }]>m
              [{ oxmultilang ident="ARTICLE_EXTEND_WIDTH" }]&nbsp;<input type="text" class="editinput" size="3" maxlength="[{$edit->oxarticles__oxlength->fldmax_width}]" name="editval[oxarticles__oxwidth]" value="[{$edit->oxarticles__oxwidth->value}]" [{ $readonly }]>m
              [{ oxmultilang ident="ARTICLE_EXTEND_HEIGHT" }]&nbsp;<input type="text" class="editinput" size="3" maxlength="[{$edit->oxarticles__oxlength->fldmax_height}]" name="editval[oxarticles__oxheight]" value="[{$edit->oxarticles__oxheight->value}]" [{ $readonly }]>m
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_UNITQUANTITY" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="10" maxlength="[{$edit->oxarticles__oxunitquantity->fldmax_length}]" name="editval[oxarticles__oxunitquantity]" value="[{$edit->oxarticles__oxunitquantity->value}]" [{ $readonly }]>
              &nbsp;&nbsp;&nbsp;&nbsp; [{ oxmultilang ident="ARTICLE_EXTEND_UNITNAME" }]:
              <input type="text" class="editinput" size="10" maxlength="[{$edit->oxarticles__oxunitname->fldmax_length}]" name="editval[oxarticles__oxunitname]" value="[{$edit->oxarticles__oxunitname->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_EXTURL" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="40" maxlength="[{$edit->oxarticles__oxexturl->fldmax_length}]" name="editval[oxarticles__oxexturl]" value="http://[{$edit->oxarticles__oxexturl->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_URLDESC" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="40" maxlength="[{$edit->oxarticles__oxurldesc->fldmax_length}]" name="editval[oxarticles__oxurldesc]" value="[{$edit->oxarticles__oxurldesc->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_URLIMG" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="40" maxlength="[{$edit->oxarticles__oxurlimg->fldmax_length}]" name="editval[oxarticles__oxurlimg]" value="[{$edit->oxarticles__oxurlimg->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_BPRICE" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="8" maxlength="[{$edit->oxarticles__oxbprice->fldmax_length}]" name="editval[oxarticles__oxbprice]" value="[{$edit->oxarticles__oxbprice->value}]" [{ $readonly }]>&nbsp;&nbsp;[{ oxmultilang ident="ARTICLE_EXTEND_TPRICE" }] <input type="text" class="editinput" size="8" maxlength="[{$edit->oxarticles__oxtprice->fldmax_length}]" name="editval[oxarticles__oxtprice]" value="[{$edit->oxarticles__oxtprice->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_FILE" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="25" maxlength="[{$edit->oxarticles__oxfile->fldmax_length}]" name="editval[oxarticles__oxfile]" value="[{$edit->oxarticles__oxfile->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_FILEUPLOAD" }]
            </td>
            <td class="edittext">
              <input class="editinput" name="myfile[FL@oxarticles__oxfile]" type="file" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_TEMPLATE" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="25" maxlength="[{$edit->oxarticles__oxtemplate->fldmax_length}]" name="editval[oxarticles__oxtemplate]" value="[{$edit->oxarticles__oxtemplate->value}]" [{include file="help.tpl" helpid=article_template}] [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_QUESTIONEMAIL" }]
            </td>
            <td class="edittext">
              <input type="text" class="editinput" size="25" maxlength="[{$edit->oxarticles__oxquestionemail->fldmax_length}]" name="editval[oxarticles__oxquestionemail]" value="[{$edit->oxarticles__oxquestionemail->value}]" [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext" width="120">
              [{ oxmultilang ident="ARTICLE_EXTEND_ISSEARCH" }]
            </td>
            <td class="edittext">
              <input class="edittext" type="hidden" name="editval[oxarticles__oxissearch]" value='0'>
              <input class="edittext" type="checkbox" name="editval[oxarticles__oxissearch]" value='1' [{if $edit->oxarticles__oxissearch->value == 1}]checked[{/if}] [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext" width="120">
              [{ oxmultilang ident="ARTICLE_EXTEND_NONMATERIAL" }]
            </td>
            <td class="edittext">
              <input class="edittext" type="hidden" name="editval[oxarticles__oxnonmaterial]" value='0'>
              <input class="edittext" type="checkbox" name="editval[oxarticles__oxnonmaterial]" value='1' [{if $edit->oxarticles__oxnonmaterial->value == 1}]checked[{/if}] [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext" width="120">
              [{ oxmultilang ident="ARTICLE_EXTEND_FREESHIPPING" }]
            </td>
            <td class="edittext">
              <input class="edittext" type="hidden" name="editval[oxarticles__oxfreeshipping]" value='0'>
              <input class="edittext" type="checkbox" name="editval[oxarticles__oxfreeshipping]" value='1' [{if $edit->oxarticles__oxfreeshipping->value == 1}]checked[{/if}] [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_BLFIXEDPRICE" }]
            </td>
            <td class="edittext">
              <input class="edittext" type="checkbox" name="editval[oxarticles__oxblfixedprice]" value='1' [{if $edit->oxarticles__oxblfixedprice->value == 1}]checked[{/if}] [{ $readonly }]>
            </td>
          </tr>
          <tr>
            <td class="edittext" width="140">
              [{ oxmultilang ident="ARTICLE_EXTEND_SKIPDISCOUNTS" }]
            </td>
            <td class="edittext">
              <input type="hidden" name="editval[oxarticles__oxskipdiscounts]" value='0'>
              <input class="edittext" type="checkbox" name="editval[oxarticles__oxskipdiscounts]" value='1' [{if $edit->oxarticles__oxskipdiscounts->value == 1}]checked[{/if}]>
            </td>
          </tr>
          <tr>
            <td class="edittext">
              [{ oxmultilang ident="ARTICLE_EXTEND_ARTEXTRA" }]
            </td>
            <td class="edittext">
              <select name="editval[oxarticles__oxbundleid]" class="editinput" style="width:200px;" [{ $readonly }]>
              [{foreach from=$arttree item=pcat}]
              <option value="[{ $pcat->oxarticles__oxid->value }]" [{ if $pcat->selected}]SELECTED[{/if}]>[{ $pcat->oxarticles__oxartnum->value }] [{ $pcat->oxarticles__oxtitle->value }]</option>
              [{/foreach}]
              </select>
            </td>
          </tr>
          <tr>
            <td class="edittext"></td>
            <td class="edittext">
              <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" ><br>
            </td>
          </tr>
          <tr>
            <td class="edittext" colspan="2"><br>
              [{include file="language.tpl"}]<br>
            </td>
          </tr>
        </table>

      </td>

      <!-- Anfang rechte Seite -->

      <td valign="top" class="edittext" align="left" width="55%" style="table-layout:fixed">

        <input [{ $readonly }] type="button" value="[{ oxmultilang ident="GENERAL_ASSIGNCATEGORIES" }]" class="edittext" onclick="JavaScript:showDialog('?cl=article_extend&aoc=1&oxid=[{ $oxid }]');">


        <p>
          <fieldset title="[{ oxmultilang ident="ARTICLE_EXTEND_MEDIAURLS" }]" style="padding-left: 5px;">
          <legend>[{ oxmultilang ident="ARTICLE_EXTEND_MEDIAURLS" }]</legend><br>

            <table cellspacing="0" cellpadding="0" border="0">
            [{foreach from=$aMediaUrls item=oMediaUrl}]
              <tr>
              [{if $oddclass == 2}]
                [{assign var=oddclass value=""}]
              [{else}]
                [{assign var=oddclass value="2"}]
              [{/if}]
                <td class=listitem[{$oddclass}]>
                  &nbsp;<a href="[{ $oMediaUrl->oxmediaurls__oxurl->value }]" target="_blank">&raquo;&raquo;</a>&nbsp;
                </td>
                <td class=listitem[{$oddclass}]>
                  &nbsp;<a href="[{ $shop->selflink }]?cl=article_extend&amp;mediaid=[{$oMediaUrl->oxmediaurls__oxid->value}]&amp;fnc=deletemedia&amp;oxid=[{$oxid}]&amp;editlanguage=[{ $editlanguage }]" onClick='return confirm("[{ oxmultilang ident="GENERAL_YOUWANTTODELETE" }]")'><img src="[{$shop->imagedir}]/delete_button.gif" border=0></a>&nbsp;
                </td>
                <td class="listitem[{$oddclass}]" width=250>
                  <input style="width:100%" class="edittext" type="text" name="aMediaUrls[[{ $oMediaUrl->oxmediaurls__oxid->value }]][oxmediaurls__oxdesc]" value="[{ $oMediaUrl->oxmediaurls__oxdesc->value }]">
                </td>
              </tr>
            [{/foreach}]

            [{if $aMediaUrls->count()}]
            <tr>
              <td colspan="3" align="right">
                <input class="edittext" type="button" onclick="this.form.fnc.value='updateMedia';this.form.submit();" [{$readonly}] value="[{ oxmultilang ident="ARTICLE_EXTEND_UPDATEMEDIA" }]">
                <br><br>
              </td>
            </tr>
            [{/if}]

            <tr>
              <td colspan="3">
            [{ oxmultilang ident="ARTICLE_EXTEND_DESCRIPTION" }]:<br>
            <input style="width:100%" type="text" name="mediaDesc" class="edittext" [{$readonly}]>
              </td>
            </tr>

            <tr>
              <td colspan="3">
            [{ oxmultilang ident="ARTICLE_EXTEND_ENTERURL" }]:<br>
            <input style="width:100%" type="text" name="mediaUrl" class="edittext" [{$readonly}]>
              </td>
            </tr>

            <tr>
              <td colspan="3">
            [{ oxmultilang ident="ARTICLE_EXTEND_UPLOADFILE" }]:<br>
            <input style="width:100%" type="file" name="mediaFile" class="edittext" [{$readonly}]>
              </td>
            </tr>
            </table>

        </fieldset>
      </td>
      <!-- Ende rechte Seite -->
    </tr>
  </table>


</form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]
