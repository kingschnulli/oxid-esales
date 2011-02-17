[{capture append="oxidBlock_content"}]
[{assign var="search_title" value="PAGE_SEARCH_SEARCH_TITLE"|oxmultilangassign}]
[{assign var="searchparamforhtml" value=$oView->getSearchParamForHtml() }]
[{assign var="template_title" value="$search_title - $searchparamforhtml"}]
[{assign var="search_head" value="PAGE_SEARCH_SEARCH_HITSFOR"|oxmultilangassign}]
[{assign var="search_head" value=$oView->getArticleCount()|cat:" "|cat:$search_head|cat:" &quot;"|cat:$oView->getSearchParamForHtml()|cat:"&quot;"}]
[{if $rsslinks.searchArticles}]
    [{assign var="imgUrl" value=$oViewConf->getImageUrl()|cat:"rss.png"}]
        [{assign var="search_head" value="`$search_head` <a class=\"rss external\" id=\"rss.searchArticles\" href=\"`$rsslinks.searchArticles.link`\" title=\"`$rsslinks.searchArticles.title`\"><img src=\"$imgUrl\" alt=\"`$rsslinks.searchArticles.title`\"><span class=\"FXgradOrange corners glowShadow\">`$rsslinks.searchArticles.title`</span></a>"}]
[{/if}]

  <h1 class="pageHead">[{$search_head}]</h1>
  [{if $oView->getArticleCount() }]
    <div class="listRefine clear bottomRound">
        [{include file="widget/locator/listlocator.tpl"  locator=$oView->getPageNavigationLimitedTop() listDisplayType=true itemsPerPage=true sort=true }]
    </div>
  [{else}]
    <div class="msg">[{ oxmultilang ident="PAGE_SEARCH_SEARCH_NOITEMSFOUND" }]</div>
  [{/if}]
  [{if $oView->getArticleList() }]
    [{foreach from=$oView->getArticleList() name=search item=product}]
      [{include file="widget/product/list.tpl" type=$oView->getListDisplayType() listId="searchList" products=$oView->getArticleList() }]
    [{/foreach}]
  [{/if}]
  [{if $oView->getArticleCount() }]
    [{include file="widget/locator/listlocator.tpl" locator=$oView->getPageNavigationLimitedBottom() place="bottom"}]
  [{/if}]
[{ insert name="oxid_tracker" title=$template_title }]
[{/capture}]
[{assign var="template_title" value="PAGE_SEARCH_SEARCH_TITLE"|oxmultilangassign}]

[{include file="layout/page.tpl" title=$template_title location="PAGE_SEARCH_SEARCH_LOCATION"|oxmultilangassign sidebar="Left"}]