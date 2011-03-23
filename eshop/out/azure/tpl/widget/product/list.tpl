[{if $head}]
    [{if $header eq "light"}]
        <h3 class="lightHead sectionHead">[{$head}]</h3>
    [{else}]
        <h2 class="sectionHead clear">
            <span>[{$head}]</span>
            [{if $rsslink}]
                    <a class="rss external" id="[{$rssId}]" href="[{$rsslink.link}]" title="[{$rsslink.title}]"><img src="[{$oViewConf->getImageUrl()}]rss.png" alt="[{$rsslink.title}]"><span class="FXgradOrange corners glowShadow">[{$rsslink.title}]</span></a>
            [{/if}]
        </h2>
    [{/if}]
[{/if}]
[{if $products|@count gt 0}]
    <ul class="[{$type}]View clear" id="[{$listId}]">
        [{foreach from=$products item=_product name=productlist}]
            <li>[{include file="widget/product/listitem.tpl" type=$type product=$_product testid=$listId|cat:"_"|cat:$smarty.foreach.productlist.iteration}]</li>
        [{/foreach}]
    </ul>
[{/if}]