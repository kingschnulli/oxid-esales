<ul class="list info">
  [{oxifcontent ident="oxsecurityinfo" object="oCont"}]
  <li><a href="[{ $oCont->getLink() }]" rel="nofollow">[{ $oCont->oxcontents__oxtitle->value }]</a></li>
  [{/oxifcontent}]
  [{oxifcontent ident="oxdeliveryinfo" object="oCont"}]
  <li><a href="[{ $oCont->getLink() }]" rel="nofollow">[{ $oCont->oxcontents__oxtitle->value }]</a></li>
  [{/oxifcontent}]
  [{oxifcontent ident="oxrightofwithdrawal" object="oCont"}]
  <li><a href="[{ $oCont->getLink() }]" rel="nofollow">[{ $oCont->oxcontents__oxtitle->value }]</a></li>
  [{/oxifcontent}]
  [{oxifcontent ident="oxorderinfo" object="oCont"}]
  <li><a href="[{ $oCont->getLink() }]" rel="nofollow">[{ $oCont->oxcontents__oxtitle->value }]</a></li>
  [{/oxifcontent}]
  [{oxifcontent ident="oxcredits" object="oCont"}]
  <li><a href="[{ $oCont->getLink() }]" rel="nofollow">[{ $oCont->oxcontents__oxtitle->value }]</a></li>
  [{/oxifcontent}]
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=newsletter" }]" rel="nofollow">[{ oxmultilang ident="LINK_NEWSLETTER" }]</a></li>
</ul>