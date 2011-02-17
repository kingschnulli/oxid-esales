<div class="locator">
  <strong>[{oxmultilang ident="LOCATOR_PAGE" }] [{ $locator->actPage  }] / [{ $locator->NrOfPages  }]</strong>

  [{if $locator->previousPage }]
    <a class="prev" href="[{$locator->previousPage}]">[{oxmultilang ident="LOCATOR_PREV"}]</a>
  [{/if}]

  [{foreach key=iPage from=$locator->changePage item=page}]
    [{if $iPage > ($locator->actPage - 10) && $iPage < ($locator->actPage + 10)}]
      <a href="[{$page->url}]" class="page [{if $iPage == $locator->actPage }]act[{/if}]">[{$iPage}]</a>
    [{/if}]
  [{/foreach}]

  [{if $locator->nextPage }]
    <a class="next" href="[{$locator->nextPage}]">[{oxmultilang ident="LOCATOR_NEXT"}]</a>
  [{/if}]

  [{foreach from=$oViewConf->getNrOfCatArticles() item=iArtPerPage}]
    <a href="[{$oViewConf->getSelfLink()}]tpl=[{$tpl}]&amp;_artperpage=[{$iArtPerPage}]&amp;[{$oView->getAdditionalParams()}]" class="per [{if $oViewConf->getArtPerPageCount() == $iArtPerPage }]act[{/if}]" rel="nofollow">[{$iArtPerPage}]</a>
  [{/foreach}]
</div>