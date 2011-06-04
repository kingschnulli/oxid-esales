[{assign var="oDetailsProduct" value=$oView->getProduct()}]
[{assign var="currency" value=$oView->getActCurrency()}]
[{assign var="oPictureProduct" value=$oView->getPicturesProduct()}]

[{if $oViewConf->getFbAppId()}]
    [{oxscript add="$(function(){oxFacebook.initDetailsPagePartial();});"}]
[{/if}]
[{oxscript add="$( '#zoomTrigger' ).oxModalPopup({target:'#zoomModal'});"}]
[{oxscript add="$( '#morePicsContainer' ).oxMorePictures();"}]
[{oxscript add="$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();"}]

[{oxscript add="$( '#productTitle' ).oxArticleActionLinksSelect();"}]
[{oxscript add="$( '#amountPrice' ).oxAmountPriceSelect();"}]
[{oxscript add="$( 'div.dropDown p' ).oxDropDown();"}]
[{oxscript add="$( 'div.tabbedWidgetBox' ).tabs();"}]
[{oxscript add="$( 'a.external' ).attr('target', '_blank');"}]
[{oxscript add="$( '#reviewRating' ).oxRating({openReviewForm: false, hideReviewButton: false});"}]
[{oxscript add="$( '#writeNewReview' ).oxReview();"}]
[{oxscript add="$( 'ul.articleBox' ).oxArticleBox();"}]
[{oxscript add="$( '#variants' ).oxArticleVariant();"}]

[{include file="page/details/inc/productmain.tpl"}]

[{oxscript}]
