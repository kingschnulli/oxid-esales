[{capture append="oxidBlock_content"}]
    <h1 class="pageHead">[{ oxmultilang ident="PAGE_INFO_SUGGEST_TITLE" }]</h1>
    <ul>
        <li>[{ oxmultilang ident="PAGE_INFO_SUGGEST_ENTERYOURADDRESSANDMESSAGE" }]</li>
        <li>[{ oxmultilang ident="PAGE_INFO_SUGGEST_CLICKONSEND" }]</li>
    </ul>
    [{oxifcontent ident="oxsecurityinfo" object="oCont"}]
        <p>[{ oxmultilang ident="PAGE_INFO_SUGGEST_ABOUTDATAPROTECTION" }] <a href="[{ $oCont->getLink() }]" rel="nofollow">[{ $oCont->oxcontents__oxtitle->value }]</a></p>
    [{/oxifcontent}]
    [{include file="form/suggest.tpl"}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Right"}]