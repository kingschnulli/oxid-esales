[{* Important ! render page head and body to collect scripts and styles *}]
[{capture append="oxidBlock_pageHead"}]

    [{assign var="_sMetaTitlePrefix" value=$oView->getTitlePrefix() }]
    [{assign var="_sMetaTitleSuffix" value=$oView->getTitleSuffix() }]
    [{assign var="_sMetaTitlePageSuffix" value=$oView->getTitlePageSuffix() }]
    [{assign var="_sMetaTitle" value=$oView->getTitle() }]

    <title>[{ $_sMetaTitlePrefix }][{if $_sMetaTitlePrefix && $_sMetaTitle }] | [{/if}][{$_sMetaTitle|strip_tags}][{if $_sMetaTitleSuffix && ($_sMetaTitlePrefix || $_sMetaTitle) }] | [{/if}][{$_sMetaTitleSuffix}] [{if $_sMetaTitlePageSuffix }] | [{ $_sMetaTitlePageSuffix }] [{/if}]</title>
    <meta http-equiv="Content-Type" content="text/html; charset=[{$oView->getCharSet()}]">
    <meta http-equiv="X-UA-Compatible" content="IE=9" >
    [{if $oView->noIndex() == 1 }]
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    [{elseif $oView->noIndex() == 2 }]
        <meta name="ROBOTS" content="NOINDEX, FOLLOW">
    [{/if}]
    [{if $oView->getMetaDescription()}]
        <meta name="description" content="[{$oView->getMetaDescription()}]">
    [{/if}]
    [{if $oView->getMetaKeywords()}]
        <meta name="keywords" content="[{$oView->getMetaKeywords()}]">
    [{/if}]

    [{if $oViewConf->getFbAppId()}]
        <meta property="og:site_name" content="[{$oViewConf->getBaseDir()}]">
        <meta property="fb:app_id" content="[{$oViewConf->getFbAppId()}]">
        <meta property="og:title" content="[{ $_sMetaTitlePrefix }][{if $_sMetaTitlePrefix && $_sMetaTitle }] | [{/if}][{$_sMetaTitle|strip_tags}][{if $_sMetaTitleSuffix && ($_sMetaTitlePrefix || $_sMetaTitle) }] | [{/if}][{$_sMetaTitleSuffix}] [{if $_sMetaTitlePageSuffix }] | [{ $_sMetaTitlePageSuffix }] [{/if}]">
        [{if $oViewConf->getActiveClassName() == 'details' }]
            <meta property="og:type" content="product">
            <meta property="og:image" content="[{$oView->getActPicture()}]">
            <meta property="og:url" content="[{$oView->getCanonicalUrl()}]">
        [{ else }]
            <meta property="og:type" content="website">
            <meta property="og:image" content="[{$oViewConf->getImageUrl()}]basket.png">
            <meta property="og:url" content="[{$oViewConf->getCurrentHomeDir()}]">
        [{/if}]
    [{/if}]


    [{assign var="canonical_url" value=$oView->getCanonicalUrl()}]
    [{if $canonical_url }]
        <link rel="canonical" href="[{ $canonical_url }]">
    [{/if}]
    <link rel="shortcut icon" href="[{ $oViewConf->getImageUrl() }]favicon.ico">

    [{oxstyle include="css/reset.css"}]
    [{oxstyle include="css/typography.css"}]
    [{oxstyle include="css/layout.css"}]
    [{oxstyle include="css/fxstyles.css"}]
    [{oxstyle include="css/elements.css"}]
    [{oxstyle include="css/ie.css" if="lte IE 8"}]

    [{assign var='rsslinks' value=$oView->getRssLinks() }]
    [{if $rsslinks}]
        [{foreach from=$rsslinks item='rssentry'}]
            <link rel="alternate" type="application/rss+xml" title="[{$rssentry.title|strip_tags}]" href="[{$rssentry.link}]">
        [{/foreach}]
    [{/if}]

    [{block name="head_css"}]
        [{foreach from=$oxidBlock_head item="_block"}]
            [{$_block}]
        [{/foreach}]
    [{/block}]

    <base href="[{ $oViewConf->getBaseDir() }]">
[{/capture}]
<!DOCTYPE HTML>
<html lang="[{ $oView->getActiveLangAbbr() }]" [{if $oViewConf->getShowFbConnect() }]xmlns:fb="http://www.facebook.com/2008/fbml"[{/if}]>
<head>
    [{foreach from=$oxidBlock_pageHead item="_block"}]
        [{$_block}]
    [{/foreach}]
    [{oxstyle}]
</head>
<body>
    [{foreach from=$oxidBlock_pageBody item="_block"}]
        [{$_block}]
    [{/foreach}]
    [{foreach from=$oxidBlock_pagePopup item="_block"}]
        [{$_block}]
    [{/foreach}]

    [{oxscript include="js/libs/jquery.min.js" priority=1}]
    [{oxscript include="js/libs/jquery-ui.min.js" priority=1}]
    [{oxscript include='js/libs/superfish/hoverIntent.js'}]
    [{oxscript include='js/libs/superfish/supersubs.js'}]
    [{oxscript include='js/libs/superfish/superfish.js'}]

    [{if $oViewConf->isTplBlocksDebugMode()}]
        [{oxscript include="js/widgets/oxblockdebug.js"}]
        [{oxscript add="$( 'hr.debugBlocksStart' ).oxBlockDebug();"}]
    [{/if}]

    [{oxscript}]
    [{foreach from=$oxidBlock_pageScript item="_block"}]
        [{$_block}]
    [{/foreach}]

    <!--[if (gte IE 6)&(lte IE 8)]>
        <script type="text/javascript" src="[{ $oViewConf->getResourceUrl() }]js/libs/IE9.js"></script>
    <![endif]-->
    <!--[if IE]>
        <script src="[{ $oViewConf->getResourceUrl() }]js/libs/fonteffect.js"></script>
        <script src="[{ $oViewConf->getResourceUrl() }]js/widgets/oxiefontshadow.js"></script>
    <![endif]-->

</body>
</html>