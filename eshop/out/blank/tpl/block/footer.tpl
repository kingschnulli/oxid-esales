<div id="footer">
  [{block name="footer"}]
  <dl class="services">
    <dt>[{oxmultilang ident="SHOP_SERVICES" }]</dt>
    <dd>[{oxinclude file="list/services.tpl"}]</dd>
  </dl>
  [{/block}]

  [{block name="footer" if=$oView->getManufacturerlist()|count}]
  <dl class="manufacturers">
    <dt>[{oxmultilang ident="SHOP_MANUFACTURERS" }]</dt>
    <dd>[{oxinclude file="list/manufacturers.tpl" manufacturers=$oView->getManufacturerlist()}]</dd>
  </dl>
  [{/block}]

  [{block name="footer" if=$oView->getVendorlist()|count}]
  <dl class="vendors">
    <dt>[{oxmultilang ident="SHOP_VENDORS" }]</dt>
    <dd>[{oxinclude file="list/vendors.tpl" vendors=$oView->getVendorlist()}]</dd>
  </dl>
  [{/block}]

  [{block name="footer" if=$oxcmp_categories|count}]
  <dl class="categories">
    <dt>[{oxmultilang ident="SHOP_CATEGORIES" }]</dt>
    <dd>[{oxinclude file="list/categories.tpl" categories=$oxcmp_categories}]</dd>
  </dl>
  [{/block}]

  [{$oxid.block.footer}]
</div>