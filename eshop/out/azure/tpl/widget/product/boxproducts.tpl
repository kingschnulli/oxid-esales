<div class="box" [{if $_boxId}]id="[{$_boxId}]"[{/if}]>
    [{if $_sHeaderIdent}]
        <h3[{if $_sHeaderCssClass}] class="[{$_sHeaderCssClass}]"[{/if}]>[{ oxmultilang ident=$_sHeaderIdent }]
            [{if $rsslinks.topArticles}]
                <a class="rss external" id="rss.topArticles" href="[{$rsslinks.topArticles.link}]" title="[{$rsslinks.topArticles.title}]"><img src="[{$oViewConf->getImageUrl()}]rss.png" alt="[{$rsslinks.topArticles.title}]"><span class="FXgradOrange corners glowShadow">[{$rsslinks.topArticles.title}]</span></a>
            [{/if }]
        </h3>
    [{/if}]
    [{include file="widget/product/boxtopproduct.tpl" _oBoxTopProduct=$_oBoxProducts->current()}]
    <ul class="featuredList">
    [{foreach from=$_oBoxProducts item=_oBoxProduct name=_sProdList}]
        [{include file="widget/product/boxproduct.tpl" _oBoxProduct=$_oBoxProduct}]
    [{/foreach}]
    </ul>
</div>