[{foreach key=iPage from=$pageNavigation->changePage item=page}]
  [{if $iPage > ($pageNavigation->actPage - 10) && $iPage < ($pageNavigation->actPage + 10)}]
    <a href="[{$page->url}]" [{if $iPage == $pageNavigation->actPage }]class="act"[{/if}]>[{$iPage}]</a>
  [{/if}]
[{/foreach}]