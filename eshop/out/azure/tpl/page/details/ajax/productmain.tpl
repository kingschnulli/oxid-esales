[{assign var="oDetailsProduct" value=$oView->getProduct()}]
[{assign var="currency" value=$oView->getActCurrency()}]
[{assign var="oPictureProduct" value=$oView->getPicturesProduct()}]

[{if $oViewConf->getFbAppId()}]
    [{oxscript add="$(function(){oxFacebook.initDetailsPagePartial();});"}]
[{/if}]
[{if $oView->showZoomPics()}]
    [{oxscript add="$( '#zoomTrigger' ).oxModalPopup({target:'#zoomModal'});"}]
    [{oxscript add="$( '#morePicsContainer' ).oxMorePictures();"}]
    [{oxscript add="$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();"}]
[{/if}]
[{oxscript add="$( '#productTitle' ).oxArticleActionLinksSelect();"}]
[{oxscript add="$( '#amountPrice' ).oxAmountPriceSelect();"}]
[{oxscript add="$( 'div.dropDown p' ).oxDropDown();"}]
[{oxscript add="$( 'div.tabbedWidgetBox' ).tabs();"}]
[{oxscript add="$( 'a.js-external' ).attr('target', '_blank');"}]
[{oxscript add="$( '#reviewRating' ).oxRating({openReviewForm: false, hideReviewButton: false});"}]
[{oxscript add="$( '#writeNewReview' ).oxReview();"}]
[{oxscript add="$( '#variants' ).oxArticleVariant();"}]
[{oxscript add="$( 'ul.js-articleBox' ).oxArticleBox();"}]

[{include file="page/details/inc/productmain.tpl"}]

[{oxscript}]
