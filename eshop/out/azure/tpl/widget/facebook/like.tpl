[{if $oView->isActive('FbLike') && $oViewConf->getFbAppId()}]
    <fb:like href="[{if $parent != 'footer'}][{$oView->getCanonicalUrl()}][{else}][{$oViewConf->getCurrentHomeDir()}][{/if}]" layout="button_count" style="width:[{if $width}][{$width}][{elseif "en" != $oViewConf->getActLanguageAbbr()}]120[{else}]90[{/if}]px;" action="like" colorscheme="light"></fb:like>
[{/if}]