[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]
[{ if $readonly }]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]
[{assign var="edit" value=$oView->getArticle()}]

[{oxscript include="js/libs/jquery.min.js"}]

<script type="text/javascript">
<!--
window.onload = function ()
{
    [{ if $updatelist == 1}]
        top.oxid.admin.updateList('[{ $oxid }]');
    [{ /if}]
    top.reloadEditFrame();
}
function editThis( sID )
{
    var oTransfer = top.basefrm.edit.document.getElementById( "transfer" );
    oTransfer.oxid.value = sID;
    oTransfer.cl.value = top.basefrm.list.sDefClass;

    //forcing edit frame to reload after submit
    top.forceReloadingEditFrame();

    var oSearch = top.basefrm.list.document.getElementById( "search" );
    oSearch.oxid.value = sID;
    oSearch.actedit.value = 0;
    oSearch.submit();
}
function _groupExp(el) {
    var _cur = el.parentNode;

    if (_cur.className == "exp") _cur.className = "";
      else _cur.className = "exp";
}
//-->
</script>

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="article_files">
    <input type="hidden" name="editlanguage" value="[{ $editlanguage }]">
</form>

<table cellspacing="0" cellpadding="0" border="0" width="98%">
    <colgroup>
        <col width="50%">
        <col width="50%">
    </colgroup>
    <tr>
      <td valign="top" class="edittext">
        <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
        [{$oViewConf->getHiddenSid()}]
          <input type="hidden" name="cl" value="article_files">
          <input type="hidden" name="fnc" value="">
          <input type="hidden" name="oxid" value="[{ $oxid }]">
          <input type="hidden" name="editval[article__oxid]" value="[{ $oxid }]">
          <input type="hidden" name="voxid" value="[{ $oxid }]">
          <input type="hidden" name="oxparentid" value="[{ $oxparentid }]">

          [{assign var="oFiles" value=$edit->getArticleFiles()}]
          [{if count( $oFiles )}]
                <p><b>[{ oxmultilang ident="ARTICLE_FILES_TABLE_UPLOADEDFILES" }]</b></p>
                [{foreach from=$oFiles item=oArticleFile}]

                  [{ if $readonly || !$oArticleFile->isUploaded() }]
                    [{assign var="readonlyRename" value="readonly disabled"}]
                  [{else}]
                    [{assign var="readonlyRename" value=""}]
                  [{/if}]

                    [{block name="admin_article_downloads_filelist"}]
                    <div class="groupExp">
                        <div>
                            <a class="delete" href="[{$oViewConf->getSelfLink()}]&cl=article_files&amp;fileid=[{$oArticleFile->getId()}]&amp;fnc=deletefile&amp;oxid=[{$oxid}]&amp;editlanguage=[{ $editlanguage }]" onClick='return confirm("[{ oxmultilang ident="GENERAL_YOUWANTTODELETE" }]")'></a>
                            <a href="#" onclick="_groupExp(this);return false;" class="rc"><b>[{$oArticleFile->oxfiles__oxfilename->value}]</b></a>
                             <dl>
                                <dt>
                                    <input type="text" class="editinput" size="30" maxlength="[{$oArticleFile->oxfiles__oxfilename->fldmax_length}]" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxfilename]" value="[{$oArticleFile->oxfiles__oxfilename->value}]" [{ $readonlyRename }]>
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_TABLE_FILENAME" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="ARTICLE_FILES_TABLE_FILENAME" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                             <dl>
                                <dt>
                                    <input class="edittext" type="hidden" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxpurchasedonly]" value='0'>
                                    <input class="edittext" type="checkbox" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxpurchasedonly]" value='1' [{if $oArticleFile->oxfiles__oxpurchasedonly->value == 1}]checked[{/if}] [{ $readonly }]>
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_TABLE_PURCHASEDONLY" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="ARTICLE_FILES_TABLE_PURCHASEDONLY" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                             <dl>
                                <dt>
                                    <input type=text class="txt" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxmaxdownloads]" value="[{$oView->getConfigOptionValue($oArticleFile->oxfiles__oxmaxdownloads->value)}]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_MAX_DOWNLOADS_COUNT" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_MAX_DOWNLOADS_COUNT" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>

                            <dl>
                                <dt>
                                    <input type=text class="txt" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxlinkexptime]"  value="[{$oView->getConfigOptionValue($oArticleFile->oxfiles__oxlinkexptime->value)}]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_LINK_EXPIRATION_TIME" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_LINK_EXPIRATION_TIME" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>

                            <dl>
                                <dt>
                                    <input type=text class="txt" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxdownloadexptime]"  value="[{$oView->getConfigOptionValue($oArticleFile->oxfiles__oxdownloadexptime->value)}]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_DOWNLOAD_EXPIRATION_TIME" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_DOWNLOAD_EXPIRATION_TIME" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>

                            <dl>
                                <dt>
                                    <input type=text class="txt" name="article_files[[{$oArticleFile->getId()}]][oxfiles__oxmaxunregdownloads]"  value="[{$oView->getConfigOptionValue($oArticleFile->oxfiles__oxmaxunregdownloads->value)}]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_LINK_EXPIRATION_TIME_UNREGISTERED" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_LINK_EXPIRATION_TIME_UNREGISTERED" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                         </div>
                    </div>
                    [{/block}]
                [{/foreach}]
                <input type="submit" class="saveButton" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'">

            [{/if}]
        </form>
     </td>
     <td valign="top" class="edittext" align="right">
          <form name="newFileUpload" id="newFileUpload" action="[{ $oViewConf->getSelfLink() }]" enctype="multipart/form-data" method="post">
          <input type="hidden" name="MAX_FILE_SIZE" value="[{$iMaxUploadFileSize}]">
          [{$oViewConf->getHiddenSid()}]
          <input type="hidden" name="cl" value="article_files">
          <input type="hidden" name="fnc" value="">
          <input type="hidden" name="oxid" value="[{ $oxid }]">
          <input type="hidden" name="voxid" value="[{ $oxid }]">
          <input type="hidden" name="oxparentid" value="[{ $oxparentid }]">
          <input type="hidden" name="editval[article__oxid]" value="[{ $oxid }]">
          <fieldset title="New file upload" style="padding-left: 5px;width:120px;">
          <p align="left"><b>[{ oxmultilang ident="ARTICLE_FILES_NEW_TITLE" }] ([{ oxmultilang ident="GENERAL_MAX_FILE_UPLOAD"}] [{$sMaxFormattedFileSize}])</b></p>
            <table cellspacing="0" cellpadding="0" border="0" width="120">
              [{block name="admin_article_downloads_newform"}]
                  <tr>
                    <td class="edittext" width="120">
                      [{ oxmultilang ident="ARTICLE_FILES_NEW_PURCHASEDONLY" }]
                    </td>
                    <td class="edittext">
                      <input class="edittext" type="hidden" name="newfile[oxfiles__oxpurchasedonly]" value='0'>
                      <input class="edittext" type="checkbox" checked name="newfile[oxfiles__oxpurchasedonly]" value='1' [{ $readonly }]>
                    </td>
                  </tr>

                  <tr>
                    <td class="edittext" width="120">
                      [{ oxmultilang ident="ARTICLE_FILES_NEW_FILE" }]
                    </td>
                    <td class="edittext">
                      <input type="file" name="newArticleFile" class="edittext" [{$readonly}]>
                    </td>
                  </tr>

                  <tr>
                    <td class="edittext" width="120">
                      [{ oxmultilang ident="ARTICLE_FILES_OR_FILENAME" }]
                    </td>
                    <td class="edittext">
                      <input class="edittext" type="text" name="newfile[oxfiles__oxfilename]" class="edittext" [{$readonly}]>
                    </td>
                  </tr>
              [{/block}]
              [{block name="admin_article_downloads_newform_options"}]
              <tr>
                <td colspan="2">
                    <div class="groupExp">
                        <div>
                            <a href="#" onclick="_groupExp(this);return false;" class="rc"><b>[{ oxmultilang ident="ARTICLE_OTHER_OPTIONS" }]</b></a>
                             <dl>
                                <dt>
                                    <input type=text class="txt" name="newfile[oxfiles__oxmaxdownloads]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_MAX_DOWNLOADS_COUNT" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_MAX_DOWNLOADS_COUNT" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>

                            <dl>
                                <dt>
                                    <input type=text class="txt" name="newfile[oxfiles__oxlinkexptime]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_LINK_EXPIRATION_TIME" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_LINK_EXPIRATION_TIME" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>

                            <dl>
                                <dt>
                                    <input type=text class="txt" name="newfile[oxfiles__oxdownloadexptime]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_DOWNLOAD_EXPIRATION_TIME" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_DOWNLOAD_EXPIRATION_TIME" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>

                            <dl>
                                <dt>
                                    <input type=text class="txt" name="newfile[oxfiles__oxmaxunregdownloads]">
                                    [{ oxinputhelp ident="HELP_ARTICLE_FILES_LINK_EXPIRATION_TIME_UNREGISTERED" }]
                                </dt>
                                <dd>
                                    [{ oxmultilang ident="GENERAL_LINK_EXPIRATION_TIME_UNREGISTERED" }]
                                </dd>
                                <div class="spacer"></div>
                            </dl>
                         </div>
                    </div>
                  </td>
                </tr>
              [{/block}]
                <tr>
                  <td colspan="2">
                    <input type="submit" class="edittext" value="[{ oxmultilang ident="ARTICLE_FILES_NEW_UPLOAD" }]" onclick="Javascript:document.newFileUpload.fnc.value='upload'">
                  </td>
                </tr>
            </table>
          </fieldset>
        </form>
    </td>
  </tr>
</table>
[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]
