[{if $oView->getTagCloudManager() || ( ( $oView->getTagCloudManager() || $oxcmp_user) && $oDetailsProduct )}]
    [{if $oView->getEditTags()}]
      <p>[{oxmultilang ident="PAGE_DETAILS_TAGS_HIGHLIHGT_INSTRUCTIONS"}]</p>
    [{/if}]

    <p class="tagCloud">
      [{assign var="oCloudManager" value=$oView->getTagCloudManager()}]
      [{foreach from=$oCloudManager->getCloudArray() item=iCount key=sTagTitle}]
        <a class="tagitem_[{$oCloudManager->getTagSize($sTagTitle)}]" href="[{$oCloudManager->getTagLink($sTagTitle)}]">[{$oCloudManager->getTagTitle($sTagTitle)}]</a>
      [{/foreach}]
    </p>

    [{if $oDetailsProduct && $oxcmp_user}]
      <form action="[{$oDetailsProduct->detailslink}]#tags" method="post">
        <div class="tagAdd">
          [{$oViewConf->getHiddenSid()}]
          [{$oViewConf->getNavFormParams()}]
          <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
          <input type="hidden" name="aid" value="[{$oDetailsProduct->oxarticles__oxid->value}]">
          <input type="hidden" name="anid" value="[{$oDetailsProduct->oxarticles__oxnid->value}]">
          [{if $oView->getEditTags()}]
            <input type="hidden" id="tags.input" name="highTags">
            <input type="hidden" name="fnc" value="addTags">
            <label for="newTags">[{oxmultilang ident="PAGE_DETAILS_TAGS_ADD"}]</label>
            <input class="input" type="text" name="newTags" id="newTags">
            <button class="submitButton" id="saveTag" type="submit" title="[{oxmultilang ident="PAGE_DETAILS_TAGS_SUBMIT"}]">[{oxmultilang ident="PAGE_DETAILS_TAGS_SUBMIT"}]</button>
            [{oxscript add="oxid.tags.addSelect('tags.cloud','tags.input');"}]
          [{else}]
            <input type="hidden" name="fnc" value="editTags">
            <button class="submitButton" id="editTag" type="submit" title="[{oxmultilang ident="PAGE_DETAILS_TAGS_EDIT"}]">[{oxmultilang ident="PAGE_DETAILS_TAGS_EDIT"}]</button>
          [{/if}]
        </div>
      </form>
    [{/if}]
[{/if}]