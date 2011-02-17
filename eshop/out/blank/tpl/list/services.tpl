<ul class="list services">
  <li><a href="[{ $oViewConf->getHomeLink()}]">[{ oxmultilang ident="LINK_HOME" }]</a>
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=contact" }]">[{ oxmultilang ident="LINK_CONTACTS" }]</a>
  <li><a href="[{ $oViewConf->getHelpPageLink() }]">[{ oxmultilang ident="LINK_HELP" }]</a>
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=guestbook" }]">[{ oxmultilang ident="LINK_GUESTBOOK" }]</a>
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=links" }]">[{ oxmultilang ident="LINK_LINKS" }]</a>
  [{oxifcontent ident="oximpressum" object="_cont"}]
  <li><a href="[{ $_cont->getLink() }]">[{ $_cont->oxcontents__oxtitle->value }]</a>
  [{/oxifcontent}]
  [{oxifcontent ident="oxagb" object="_cont"}]
  <li><a href="[{ $_cont->getLink() }]" rel="nofollow">[{ $_cont->oxcontents__oxtitle->value }]</a>
  [{/oxifcontent}]
  [{oxhasrights ident="TOBASKET"}]
  <li><a href="[{ oxgetseourl ident=$oViewConf->getBasketLink() }]" rel="nofollow">[{ oxmultilang ident="LINK_BASKET" }]</a>
  [{/oxhasrights}]
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account" }]" rel="nofollow">[{ oxmultilang ident="LINK_ACCOUNT" }]</a>
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account_noticelist" }]" rel="nofollow"> [{ oxmultilang ident="LINK_NOTICELIST" }]</a>
  [{if $oViewConf->getShowWishlist()}]
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account_wishlist" }]" rel="nofollow"> [{ oxmultilang ident="LINK_WISHLIST" }]</a>
  <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=wishlist" params="wishid="|cat:$wishid }]" rel="nofollow">[{ oxmultilang ident="LINK_PUBLICWISHLIST" }]</a>
  [{/if}]
</ul>