[{capture append="oxidBlock_content"}]
    [{assign var="template_title" value="MY_DOWNLOADS'"|oxmultilangassign }]
    <h1 class="pageHead">[{ oxmultilang ident="MY_DOWNLOADS" }]</h1>
    [{if $oView->getOrderFilesList()|count }]
    <ul class="downloadList">
      [{foreach from=$oView->getOrderFilesList() item="oOrderArticle"}]
        <li>
          <dl>
                <dt>
                    <strong>[{ $oOrderArticle.oxarticletitle }] - [{ oxmultilang ident="ORDER_NUMBER" }]: [{ $oOrderArticle.oxordernr }], [{ $oOrderArticle.oxorderdate}]</strong>
                </dt>
                [{foreach from=$oOrderArticle.oxorderfiles item="oOrderFile"}]
                <dd>
                   [{if $oOrderFile->isPaid() || !$oOrderFile->oxorderfiles__oxpurchasedonly->value  }]
                         [{if $oOrderFile->isValid() }]
                           <a class="downloadableFile" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=download" params="sorderfileid="|cat:$oOrderFile->getId() }]" rel="nofollow">[{$oOrderFile->oxorderfiles__oxfilename->value}]</a>
                            [{if $oOrderFile->oxorderfiles__oxdownloadcount->value == 0 && $oOrderFile->getValidUntil() != "0000-00-00 00:00"  }]
                                [{if $oOrderFile->oxorderfiles__oxlinkexpirationtime->value || $oOrderFile->oxorderfiles__oxdownloadxpirationtime->value }]
                                    [{ oxmultilang ident="START_DOWNLOADING_UNTIL" }] [{$oOrderFile->getValidUntil()}]
                                [{/if}]
                                [{if $oOrderFile->oxorderfiles__oxmaxdownloadcount->value != 0 }]
                                    [{ oxmultilang ident="LEFT_DOWNLOADS" }] : [{ $oOrderFile->getLeftDownloadCount() }]
                                [{/if}]
                            [{else}]
                                [{if $oOrderFile->getValidUntil() != "0000-00-00 00:00"  }]
                                    [{if $oOrderFile->oxorderfiles__oxlinkexpirationtime->value || $oOrderFile->oxorderfiles__oxdownloadxpirationtime->value }]
                                        [{ oxmultilang ident="LINK_VALID_UNTIL" }] : [{ $oOrderFile->getValidUntil() }].
                                    [{/if}]
                                [{/if}]
                                [{if $oOrderFile->oxorderfiles__oxmaxdownloadcount->value != 0 }]
                                    [{ oxmultilang ident="LEFT_DOWNLOADS" }] : [{ $oOrderFile->getLeftDownloadCount() }]
                                [{/if}]
                            [{/if}]
                        [{else}]
                            [{$oOrderFile->oxorderfiles__oxfilename->value}]
                                [{oxmultilang ident="DOWNLOAD_LINK_EXPIRED_OR_MAX_COUNT_RECEIVED"}]
                        [{/if}]
                  [{else}]
                    <span class="downloadableFile pending">[{$oOrderFile->oxorderfiles__oxfilename->value}]</span>
                    <strong>[{ oxmultilang ident="DOWNLOADS_PAYMENT_PENDING" }]</strong>
                  [{/if}]
                </dd>
                [{/foreach}]
          </dl>
        </li>
      [{/foreach}]
    </ul>
    [{else}]
        <div class="box info">
          [{ oxmultilang ident="DOWNLOADS_EMPTY" }]
        </div>
    [{/if}]

    [{insert name="oxid_tracker" title=$template_title }]
[{/capture}]
[{capture append="oxidBlock_sidebar"}]
    [{include file="page/account/inc/account_menu.tpl" active_link="downloads"}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left"}]