[{if $oView->morePics()}]
<div class="otherPictures">
    <div class="shadowLine"></div>
    <ul class="clear">
    [{oxscript add="var aMorePic=new Array();"}]
    [{foreach from=$oView->getIcons() key=iPicNr item=oArtIcon name=sMorePics}]
        <li>
            <a id="morePics_[{$smarty.foreach.sMorePics.iteration}]" rel="useZoom: 'zoom1', smallImage: '[{$oDetailsProduct->getPictureUrl($iPicNr)}]' " class="cloud-zoom-gallery" href="[{$oDetailsProduct->getMasterZoomPictureUrl($iPicNr)}]">
                <span class="marker"><img src="[{$oViewConf->getImageUrl()}]marker.png" alt=""></span>
                <span class="artIcon"><img src="[{$oDetailsProduct->getIconUrl($iPicNr)}]" alt=""></span>

            </a>
        </li>
    [{/foreach}]
    </ul>
    </div>
[{/if}]