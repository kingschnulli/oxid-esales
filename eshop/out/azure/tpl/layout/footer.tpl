[{oxscript include="js/widgets/oxequalizer.js" priority=10 }]
[{oxscript add="$(function(){oxEqualizer.equalHeight($( '#panel dl' ));});"}]
<div id="footer">
  <div id="panel" class="corners">
      [{capture append="oxidBlock_footer"}]
      <div class="bar">
          [{if $oView->isActive('FbLike') && $oViewConf->getFbAppId()}]
        <div class="facebook">
          [{include file="widget/facebook/like.tpl" parent="footer"}]
        </div>
        [{/if}]
          [{include file="widget/footer/newsletter.tpl"}]
        <div class="deliveryinfo">
          [{oxifcontent ident="oxdeliveryinfo" object="oCont"}]
            <a href="[{ $oCont->getLink() }]" rel="nofollow">[{ oxmultilang ident="FOOTER_INCLTAXANDPLUSSHIPPING" }]</a>
          [{/oxifcontent}]
        </div>
      </div>
      [{/capture}]

      [{capture append="oxidBlock_footer"}]
      <dl class="services" id="footerServices">
        <dt>[{oxmultilang ident="FOOTER_SERVICES" }]</dt>
        <dd>[{include file="widget/footer/services.tpl"}]</dd>
      </dl>
      [{/capture}]

      [{capture append="oxidBlock_footer"}]
      <dl class="services" id="footerInformation">
        <dt>[{oxmultilang ident="FOOTER_INFORMATION" }]</dt>
        <dd>[{include file="widget/footer/info.tpl"}]</dd>
      </dl>
      [{/capture}]

      [{if $oView->getManufacturerlist()|count}]
          [{capture append="oxidBlock_footer"}]
          <dl id="footerManufacturers">
            <dt>[{oxmultilang ident="FOOTER_MANUFACTURERS" }]</dt>
            <dd>[{include file="widget/footer/manufacturers.tpl" manufacturers=$oView->getManufacturerlist()}]</dd>
          </dl>
          [{/capture}]
      [{/if}]

      [{if $oView->getVendorlist()|count}]
          [{capture append="oxidBlock_footer" }]
          <dl id="footerVendors">
            <dt>[{oxmultilang ident="FOOTER_DISTRIBUTORS" }]</dt>
            <dd>[{include file="widget/footer/vendors.tpl" vendors=$oView->getVendorlist()}]</dd>
          </dl>
          [{/capture}]
      [{/if}]

      [{if $oxcmp_categories }]
          [{capture append="oxidBlock_footer"}]
          <dl class="categories" id="footerCategories">
            <dt>[{oxmultilang ident="FOOTER_CATEGORIES" }]</dt>
            <dd>[{include file="widget/footer/categorieslist.tpl" categories=$oxcmp_categories}]</dd>
          </dl>
          [{/capture}]
      [{/if}]

    [{foreach from=$oxidBlock_footer item="_block"}]
        [{$_block}]
    [{/foreach}]
  </div>
    <div class="copyright">
      <img src="[{$oViewConf->getImageUrl()}]logo_small.png" alt="[{oxmultilang ident="OXID_ESALES_URL_TITLE"}]">
    </div>
    <div class="text">
      [{oxifcontent ident="oxstdfooter" object="oCont"}]
        [{$oCont->oxcontents__oxcontent->value}]
      [{/oxifcontent}]
    </div>
</div>
[{if $oView->isRootCatChanged()}]
    [{oxscript include="js/widgets/oxmodalpopup.js" priority=10 }]
    [{oxscript add="$( '#scRootCatChanged' ).oxModalPopup({ target: '#scRootCatChanged', openDialog: true});"}]
    <div id="scRootCatChanged" class="popupBox corners FXgradGreyLight glowShadow">
        [{include file="form/privatesales/basketexcl.tpl"}]
    </div>
[{/if}]