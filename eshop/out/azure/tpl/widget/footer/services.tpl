<ul class="list services">
    <li><a href="[{ $oViewConf->getHomeLink()}]">[{ oxmultilang ident="WIDGET_SERVICES_HOME" }]</a></li>
    <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=contact" }]">[{ oxmultilang ident="WIDGET_SERVICES_CONTACTS" }]</a></li>
    <li><a href="[{ $oViewConf->getHelpPageLink() }]">[{ oxmultilang ident="WIDGET_SERVICES_HELP" }]</a></li>
    <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=guestbook" }]">[{ oxmultilang ident="WIDGET_SERVICES_GUESTBOOK" }]</a></li>
    <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=links" }]">[{ oxmultilang ident="WIDGET_SERVICES_LINKS" }]</a></li>
    [{if $oView->isActive('Invitations') }]
        <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=invite" }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_INVITEFRIENDS" }]</a></li>
    [{/if}]
    [{oxifcontent ident="oximpressum" object="_cont"}]
        <li><a href="[{ $_cont->getLink() }]">[{ $_cont->oxcontents__oxtitle->value }]</a></li>
    [{/oxifcontent}]
    [{oxifcontent ident="oxagb" object="_cont"}]
        <li><a href="[{ $_cont->getLink() }]" rel="nofollow">[{ $_cont->oxcontents__oxtitle->value }]</a></li>
    [{/oxifcontent}]
    [{oxhasrights ident="TOBASKET"}]
        <li><a href="[{ oxgetseourl ident=$oViewConf->getBasketLink() }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_BASKET" }]</a></li>
    [{/oxhasrights}]
    <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account" }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_ACCOUNT" }]</a></li>
    <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account_noticelist" }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_NOTICELIST" }]</a></li>
    [{if $oViewConf->getShowWishlist()}]
        <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account_wishlist" }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_MYWISHLIST" }]</a></li>
        <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=wishlist" params="wishid="|cat:$oView->getWishlistUserId() }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_PUBLICWISHLIST" }]</a></li>
    [{/if}]
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
    <li><a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=newsletter" }]" rel="nofollow">[{ oxmultilang ident="WIDGET_SERVICES_NEWSLETTER" }]</a></li>
</ul>