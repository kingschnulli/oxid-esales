[{oxscript add="$('a.external').attr('target', '_blank');"}]
[{capture append="oxidBlock_content"}]
        [{assign var="actCategory" value=$oView->getActiveCategory()}]

        [{if $actCategory->oxcategories__oxthumb->value }]
            [{if $actCategory->getThumbUrl()}]
                <img src="[{$actCategory->getThumbUrl()}]" alt="[{$actCategory->oxcategories__oxtitle->value}]" class="categoryPicture">
            [{/if}]
        [{/if}]

        [{if $oView->hasVisibleSubCats()}]
            [{assign var="iSubCategoriesCount" value=0}]
            [{oxscript include="js/widgets/oxequalizer.js" priority=10 }]
            [{oxscript add="$(function(){oxEqualizer.equalHeight($( '.subcatList li .content' ));});"}]
            <ul class="subcatList clear">
                <li>
                [{foreach from=$oView->getSubCatList() item=category name=MoreSubCat}]
                    [{ if $category->getContentCats() }]
                        [{foreach from=$category->getContentCats() item=ocont name=MoreCms}]
                            [{assign var="iSubCategoriesCount" value=$iSubCategoriesCount+1}]
                            <div class="box">
                            <h3>
                                <a id="moreSubCms_[{$smarty.foreach.MoreSubCat.iteration}]_[{$smarty.foreach.MoreCms.iteration}]" href="[{$ocont->getLink()}]">[{ $ocont->oxcontents__oxtitle->value }]</a>
                            </h3>
                            <ul class="content"></ul>
                            </div>
                        [{/foreach}]
                    [{/if }]
                    [{if $iSubCategoriesCount%4 == 0}]
                    </li><li>
                    [{/if}]
                    [{if $category->getIsVisible()}]
                        [{assign var="iSubCategoriesCount" value=$iSubCategoriesCount+1}]
                        [{assign var="iconUrl" value=$category->getIconUrl()}]
                            <div class="box">
                                <h3>                                
                                    [{assign var="maxTitleLength" value=19}]    
                                    [{ if $oView->showCategoryArticlesCount() && ($category->getNrOfArticles() > 0) }]                                   
                                        [{assign var="articleNrLength" value=$category->getNrOfArticles|count_characters}]
                                        [{assign var="categoryTitle" value=$category->oxcategories__oxtitle->value|truncate:$maxTitleLength-3-$articleNrLength:'...':true|cat:" ("|cat:$category->getNrOfArticles()|cat:")"}]    
                                    [{else}]    
                                        [{assign var="categoryTitle" value=$category->oxcategories__oxtitle->value|truncate:$maxTitleLength:'...':true}]
                                    [{/if}]                                    
                                    <a id="moreSubCat_[{$smarty.foreach.MoreSubCat.iteration}]" href="[{ $category->getLink() }]">
                                        [{$categoryTitle}]                                    
                                    </a>
                                </h3>
                                [{if $category->getHasVisibleSubCats()}]
                                    <ul class="content">
                                        [{if $iconUrl}]
                                            <li class="subcatPic">
                                                <a href="[{ $category->getLink() }]">
                                                    <img src="[{$category->getIconUrl() }]" alt="[{ $category->oxcategories__oxtitle->value }]">
                                                </a>
                                            </li>
                                        [{/if}]
                                        [{foreach from=$category->getSubCats() item=subcategory}]
                                            [{if $subcategory->getIsVisible() }]
                                                [{ foreach from=$subcategory->getContentCats() item=ocont name=MoreCms}]
                                                    <li>
                                                        <a href="[{$ocont->getLink()}]"><strong>[{ $ocont->oxcontents__oxtitle->value }]</strong></a>
                                                    </li>
                                                [{/foreach }]
                                                <li>
                                                    <a href="[{ $subcategory->getLink() }]">
                                                        <strong>[{ $subcategory->oxcategories__oxtitle->value }]</strong>[{ if $oView->showCategoryArticlesCount() && ($subcategory->getNrOfArticles() > 0) }] ([{ $subcategory->getNrOfArticles() }])[{/if}]
                                                    </a>
                                                </li>
                                             [{/if}]
                                        [{/foreach}]
                                    </ul>
                                [{else}]
                                    <div class="content[{if $iconUrl}] catPicOnly[{/if}]">
                                        [{if $iconUrl}]
                                            <div class="subcatPic">
                                                <a href="[{ $category->getLink() }]">
                                                    <img src="[{$category->getIconUrl() }]" alt="[{ $category->oxcategories__oxtitle->value }]">
                                                </a>
                                            </div>
                                        [{/if}]
                                    </div>
                                [{/if}]
                            </div>
                    [{/if}]
                [{if $iSubCategoriesCount%4 == 0}]
                </li>
                <li>
                [{/if}]
                [{/foreach}]
            </li>
            </ul>
        [{/if}]

    [{if $oView->getArticleList()|@count > 0}]
        <h1 class="pageHead">[{$oView->getTitle()}]
            [{assign var='rsslinks' value=$oView->getRssLinks() }]
            [{ if $rsslinks.activeCategory}]
                <a class="rss external" id="rssActiveCategory" href="[{$rsslinks.activeCategory.link}]" title="[{$rsslinks.activeCategory.title}]"><img src="[{$oViewConf->getImageUrl()}]rss.png" alt="[{$rsslinks.activeCategory.title}]"><span class="FXgradOrange corners glowShadow">[{$rsslinks.activeCategory.title}]</span></a>
            [{/if }]
        </h1>
        <div class="listRefine clear bottomRound">

            [{if $actCategory && $actCategory->oxcategories__oxdesc->value }]
                <div id="catDesc" class="categoryDescription">[{$actCategory->oxcategories__oxdesc->value}]</div>
            [{/if}]

            [{if $actCategory->oxcategories__oxlongdesc->value }]
                <div id="catLongDesc" class="categoryDescription">[{oxeval var=$actCategory->oxcategories__oxlongdesc}]</div>
            [{/if}]

            [{include file="widget/locator/listlocator.tpl" locator=$oView->getPageNavigationLimitedTop() attributes=$oView->getAttributes() listDisplayType=true itemsPerPage=true sort=true }]
        </div>
        [{* List types: grid|line|infogrid *}]
        [{include file="widget/product/list.tpl" type=$oView->getListDisplayType() listId="productList" products=$oView->getArticleList()}]
        [{include file="widget/locator/listlocator.tpl" locator=$oView->getPageNavigationLimitedBottom() place="bottom"}]
    [{/if}]
[{/capture}]
[{include file="layout/page.tpl" sidebar="Left" tree_path=$oView->getTreePath()}]