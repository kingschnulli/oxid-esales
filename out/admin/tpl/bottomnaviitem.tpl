</div>

<div class="actions">
[{strip}]

<ul>

    [{ assign var="allowSharedEdit" value=true}]

[{if !$disablenew}]

[{* user *}]
[{if $bottom_buttons->user_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=user_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWUSER" }]</a> |</li>
[{/if}]
[{if $bottom_buttons->user_newremark && $oxid != "-1" }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.newremark" href="#" onClick="Javascript:parent.list.document.search.actedit.value=3;parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=user_remark&oxid=[{$oxid}]';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWREMARK" }]</a> |</li>
[{/if}]
[{if $bottom_buttons->user_newaddress && $oxid != "-1" }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.newaddress" href="#" onClick="Javascript:parent.list.document.search.actedit.value=4;parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=user_address&oxaddressid=-1&oxid=[{$oxid}]';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWADDRESS" }]</a> |</li>
[{ /if }]
[{* payment *}]
  [{if $bottom_buttons->payment_new }]
  <li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=payment_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWPAYMENT" }]</a> |</li>
  [{/if}]
[{* newsletter *}]
[{if $bottom_buttons->newsletter_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=newsletter_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWNEWSLETTER" }]</a> |</li>
[{/if}]
[{* shop *}]
[{if $bottom_buttons->shop_new && $ismall && $malladmin == 1 }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=shop_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWSHOP" }]</a> |</li>
[{/if}]
[{* usergroups *}]
[{if $bottom_buttons->usergroup_new && $allowSharedEdit }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=usergroup_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWUSERGROUP" }]</a> |</li>
[{/if}]
[{* category *}]
  [{if $bottom_buttons->category_new }]
  <li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=category_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWCATEGORY" }]</a> |</li>
  [{/if}]
[{if $bottom_buttons->category_refresh }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.refresh" href="#" onClick="Javascript:var agree=confirm('[{ oxmultilang ident="BOTTOMNAVIITEM_ATTENTION" }]');if (agree){parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=category_main';popupWin=window.open('[{$shop->selflink}]?cl=category_update', 'remote', 'scrollbars=yes,width=500,height=400')}" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWCATTREE" }]</a> |</li>
[{/if}]
[{if $bottom_buttons->category_resetnrofarticles }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.resetnrofarticles" href="#" onClick="Javascript:document.myedit.fnc.value='resetNrOfCatArticles';document.myedit.submit();" target="edit">[{ oxmultilang ident="TOOLTIPS_RESETNROFARTICLESINCAT" }]</a> |</li>
[{/if}]
[{* article *}]
  [{if $bottom_buttons->article_new }]
  <li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=article_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWARTICLE" }]</a> |</li>
  [{/if}]
[{if $bottom_buttons->article_preview && $oxid != -1 }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.preview" href="[{if $edit}][{$edit->getLink()}][{else}][{$shop->basedir}]?cl=details&anid=[{$oxid}][{/if}]&amp;preview=1" target="new">[{ oxmultilang ident="TOOLTIPS_ARTICLEREVIEW" }]</a> |</li>
[{/if}]
[{* attribute *}]
[{if $bottom_buttons->attribute_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=attribute_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWITEMS" }]</a> |</li>
[{/if}]
[{* statistic *}]
[{if $bottom_buttons->statistic_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=statistic_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWSTATISTIC" }]</a> |</li>
[{/if}]
[{* selectlist *}]
[{if $bottom_buttons->selectlist_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=selectlist_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWSELECTLIST" }]</a> |</li>
[{/if}]
[{* discount *}]
[{if $bottom_buttons->discount_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=discount_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWDISCOUNT" }]</a> |</li>
[{/if}]
[{* delivery *}]
[{if $bottom_buttons->delivery_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=delivery_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWDELIVERY" }]</a> |</li>
[{/if}]
[{* deliveryset *}]
[{if $bottom_buttons->deliveryset_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=deliveryset_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWDELIVERYSET" }]</a> |</li>
[{/if}]
[{* vat *}]
[{if $bottom_buttons->vat_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=vat_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWMWST" }]</a> |</li>
[{/if}]
[{* news *}]
[{if $bottom_buttons->news_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=news_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWNEWS" }]</a> |</li>
[{/if}]
[{* links *}]
[{if $bottom_buttons->links_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=adminlinks_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWLINK" }]</a> |</li>
[{/if}]
[{* voucher *}]
[{if $bottom_buttons->voucher_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=voucherserie_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWVOUCHER" }]</a> |</li>
[{/if}]
[{* order *}]
[{if $bottom_buttons->order_newremark && $oxid!=-1 }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.newremark" href="#" onClick="Javascript:parent.list.document.search.actedit.value=4;parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=order_remark&oxid=[{$oxid}]';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWREMARK" }]</a> |</li>
[{/if}]
[{* imex *}]
[{* country *}]
[{if $bottom_buttons->country_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=country_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWCOUNTRY" }]</a> |</li>
[{/if}]
[{* vendor *}]
[{if $bottom_buttons->vendor_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=vendor_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWVENDOR" }]</a> |</li>
[{/if}]
[{if $bottom_buttons->vendor_resetnrofarticles }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.resetnrofarticles" href="#" onClick="Javascript:document.myedit.fnc.value='resetNrOfVendorArticles';document.myedit.submit();" target="edit">[{ oxmultilang ident="TOOLTIPS_RESETNROFARTICLESINVND" }]</a> |</li>
[{/if}]
[{* manufacturer *}]
[{if $bottom_buttons->manufacturer_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=manufacturer_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWMANUFACTURER" }]</a> |</li>
[{/if}]
[{if $bottom_buttons->manufacturer_resetnrofarticles }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.resetnrofarticles" href="#" onClick="Javascript:document.myedit.fnc.value='resetNrOfManufacturerArticles';document.myedit.submit();" target="edit">[{ oxmultilang ident="TOOLTIPS_RESETNROFARTICLESINMAN" }]</a> |</li>
[{/if}]
[{* wrapping *}]
[{if $bottom_buttons->wrapping_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=wrapping_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWWRAPPING" }]</a> |</li>
[{/if}]
[{* actions *}]
[{*
<a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=actions_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWACTIONS" }]</a> |</li>
*}]
[{* content *}]
[{if $bottom_buttons->content_new }]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.new" href="#" onClick="Javascript:parent.list.document.search.oxid.value='-1'; parent.list.document.search.submit();document.location='[{$shop->selflink}]?cl=content_main';return false" target="edit">[{ oxmultilang ident="TOOLTIPS_NEWCONTENT" }]</a> |</li>
[{/if}]


[{/if}]

[{include file="bottomnavicustom.tpl"}]

[{ if $sHelpURL }]
[{* HELP *}]
<li><a [{if !$firstitem}]class="firstitem"[{assign var="firstitem" value="1"}][{/if}] id="btn.help" href="[{ $sHelpURL }]/[{ $shop->cl|lower }].html" OnClick="window.open('[{ $sHelpURL }]/[{ $shop->cl|lower }].html','OXID_Help','width=800,height=600,resizable=no,scrollbars=yes');return false;">[{ oxmultilang ident="TOOLTIPS_OPENHELP" }]</a></li>
[{/if}]
</ul>
[{/strip}]
</div>