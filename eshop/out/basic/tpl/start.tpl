[{include file="_header.tpl" title=$template_title location="START_TITLE"|oxmultilangassign isStart=true usePromotionsCss=$oView->getShowPromotionList()}]

[{if $oView->isDemoShop()}]
    [{include file="inc/admin_banner.tpl"}]
[{/if}]

[{oxifcontent ident="oxstartwelcome" object="oCont"}]
<div class="welcome">[{$oCont->oxcontents__oxcontent->value}]</div>
[{/oxifcontent}]

[{if $oView->getTopArticleList() }]
  [{foreach from=$oView->getTopArticleList() item=actionproduct name=WeekArt}]
    [{include file="inc/product.tpl" product=$actionproduct showMainLink=true head="START_WEEKSPECIAL"|oxmultilangassign testid="WeekSpecial_"|cat:$actionproduct->oxarticles__oxid->value testHeader="WeekSpecial_`$smarty.foreach.WeekArt.iteration`"}]
  [{/foreach}]
[{/if}]

[{if $oView->getFirstArticle() }]
  [{oxifcontent ident="oxfirststart" object="oCont"}]
    [{assign var="oxfirststart_title" value=$oCont->oxcontents__oxtitle->value}]
    [{assign var="oxfirststart_text" value=$oCont->oxcontents__oxcontent->value}]
  [{/oxifcontent}]
  [{assign var="firstarticle" value=$oView->getFirstArticle()}]
  [{include file="inc/product.tpl" size='big' showMainLink=true class='topshop' head=$oxfirststart_title head_desc=$oxfirststart_text product=$firstarticle testid="FirstArticle_"|cat:$firstarticle->oxarticles__oxid->value testHeader=FirstArticle}]
[{/if}]

[{* OXSCPROMOTIONS START *}]
[{if $oView->getShowPromotionList()}]
    <div class="promotionsRow">
      [{foreach from=$oView->getPromoFinishedList() item=promo}]
        <div class="promotion promotionFinished" id="promo[{$promo->getId()}]">
            <div class="finishedText"><img src="[{$oViewConf->getBaseDir()}]out/basic/img/promo_soldout_[{ $oView->getActiveLangAbbr() }].png" /></div>
            [{$promo->getLongDesc()}]
        </div>
      [{/foreach}]
      [{foreach from=$oView->getPromoCurrentList() item=promo}]
        <div class="promotion promotionCurrent" id="promo[{$promo->getId()}]">
            <div class="finishedText"><img src="[{$oViewConf->getBaseDir()}]out/basic/img/promo_soldout_[{ $oView->getActiveLangAbbr() }].png" /></div>
            [{$promo->getLongDesc()}]
            [{if $promo->oxactions__oxactiveto->value && $promo->oxactions__oxactiveto->value != "0000-00-00 00:00:00"}]
                <div class="timeouttext">
                  [{oxmultilang ident="PROMO_WILLENDIN_PREFIX"}]
                  [{if 86400 > $promo->getTimeLeft()}]
                    [{assign var="_timeleft" value=$promo->getTimeLeft() }]
                    [{math equation="x1/x2" x1=$_timeleft x2=60 assign="_minutes"}]
                    [{math equation="x1/x2" x1=$_minutes x2=60 assign="_hours"}]
                    [{math equation="x1%x2" x1=$_minutes x2=60 assign="_minutes"}]
                    [{math equation="x1%x2" x1=$_timeleft x2=60 assign="_seconds"}]
                    <span class="promoTimeout">[{$_hours|floor}]:[{$_minutes|floor}]:[{$_seconds}]</span>
                  [{elseif 172800 > $promo->getTimeLeft()}]
                    [{oxmultilang ident="PROMO_ONEDAY"}]
                  [{else}]
                    [{math equation="x1/x2" x1=$promo->getTimeLeft() x2=86400 assign="_days"}]
                    [{$_days|floor}] [{oxmultilang ident="PROMO_DAYS"}]
                  [{/if}]
                  [{oxmultilang ident="PROMO_WILLENDIN_SUFFIX"}]
                </div>
            [{/if}]
        </div>
      [{/foreach}]
      [{foreach from=$oView->getPromoFutureList() item=promo}]
        <div class="promotion promotionFuture" id="promo[{$promo->getId()}]">
            <div class="finishedText"><img src="[{$oViewConf->getBaseDir()}]out/basic/img/promo_soldout_[{ $oView->getActiveLangAbbr() }].png" /></div>
            <div class="upcomingText"><img src="[{$oViewConf->getBaseDir()}]out/basic/img/promo_upcoming_[{ $oView->getActiveLangAbbr() }].png" /></div>
            [{$promo->getLongDesc()}]
            [{if $promo->oxactions__oxactiveto->value && $promo->oxactions__oxactiveto->value != "0000-00-00 00:00:00"}]
              <div class="timeouttext">[{oxmultilang ident="PROMO_WILLENDIN_PREFIX"}]
                [{if 86400 > $promo->getTimeLeft()}]
                  [{assign var="_timeleft" value=$promo->getTimeLeft() }]
                  [{math equation="x1/x2" x1=$_timeleft x2=60 assign="_minutes"}]
                  [{math equation="x1/x2" x1=$_minutes x2=60 assign="_hours"}]
                  [{math equation="x1%x2" x1=$_timeleft x2=60 assign="_seconds"}]
                  <span class="promoTimeout">[{$_hours|floor}]:[{$_minutes|floor}]:[{$_seconds}]</span>
                [{elseif 172800 > $promo->getTimeLeft()}]
                  [{oxmultilang ident="PROMO_ONEDAY"}]
                [{else}]
                    [{math equation="x1/x2" x1=$promo->getTimeLeft() x2=86400 assign="_days"}]
                    [{$_days|floor}] [{oxmultilang ident="PROMO_DAYS"}]
                [{/if}]
                [{oxmultilang ident="PROMO_WILLENDIN_SUFFIX"}]
              </div>
            [{/if}]
            <div class="activationtext">[{oxmultilang ident="PROMO_WILLSTARTIN_PREFIX"}]
              [{if 86400 > $promo->getTimeUntilStart()}]
                [{assign var="_timeuntilstart" value=$promo->getTimeUntilStart() }]
                [{math equation="x1/x2" x1=$_timeuntilstart x2=60 assign="_minutes"}]
                [{math equation="x1/x2" x1=$_minutes x2=60 assign="_hours"}]
                [{math equation="x1%x2" x1=$_timeuntilstart x2=60 assign="_seconds"}]
                <span class="promoTimeout">[{$_hours|floor}]:[{$_minutes|floor}]:[{$_seconds}]</span>[{oxmultilang ident="PROMO_WILLENDIN_SUFFIX"}]
              [{elseif 172800 > $promo->getTimeUntilStart()}]
                [{oxmultilang ident="PROMO_ONEDAY"}]
              [{else}]
                [{math equation="x1/x2" x1=$promo->getTimeUntilStart() x2=86400 assign="_days"}]
                [{$_days|floor}] [{oxmultilang ident="PROMO_DAYS"}]
              [{/if}]
              [{oxmultilang ident="PROMO_WILLSTARTIN_SUFFIX"}]
            </div>
        </div>
      [{/foreach}]
    </div>
    [{oxscript include="jquery.min.js"}]
    [{oxscript include="promotions.js"}]
[{/if}]
[{* OXSCPROMOTIONS END *}]

[{if ($oView->getArticleList()|@count)>0 }]
  <strong id="test_LongRunHeader" class="head2">[{ oxmultilang ident="START_LONGRUNNINGHITS"}]</strong>
  [{if ($oView->getArticleList()|@count) is not even  }][{assign var="actionproduct_size" value="big"}][{/if}]
  [{foreach from=$oView->getArticleList() item=actionproduct}]
      [{include file="inc/product.tpl" showMainLink=true product=$actionproduct size=$actionproduct_size testid="LongRun_"|cat:$actionproduct->oxarticles__oxid->value }]
      [{assign var="actionproduct_size" value=""}]
  [{/foreach}]
[{/if}]

[{if ($oView->getNewestArticles()|@count)>0 }]
  <strong id="test_FreshInHeader" class="head2">
    [{ oxmultilang ident="START_JUSTARRIVED"}]

    [{if $rsslinks.newestArticles}]
        <a class="rss" id="rss.newestArticles" href="[{$rsslinks.newestArticles.link}]" title="[{$rsslinks.newestArticles.title}]"></a>
        [{oxscript add="oxid.blank('rss.newestArticles');"}]
    [{/if}]
  </strong>
  [{foreach from=$oView->getNewestArticles() item=actionproduct}]
      [{include file="inc/product.tpl" showMainLink=true product=$actionproduct size="small" testid="FreshIn_"|cat:$actionproduct->oxarticles__oxid->value}]
  [{/foreach}]
[{/if}]

[{if ($oView->getCatOfferArticleList()|@count)>0 }]
  <strong id="test_CategoriesHeader" class="head2">[{ oxmultilang ident="START_CATEGORIES"}]</strong>
  [{if ($oView->getCatOfferArticleList()|@count) is not even  }][{assign var="actionproduct_size" value="big"}][{/if}]
  [{foreach from=$oView->getCatOfferArticleList() item=actionproduct name=CatArt}]
      [{if $actionproduct->getCategory() }]
          [{assign var="oCategory" value=$actionproduct->getCategory()}]
          [{assign var="actionproduct_title" value=$oCategory->oxcategories__oxtitle->value}]
          [{if $oCategory->getNrOfArticles() > 0}][{assign var="actionproduct_title" value=$actionproduct_title|cat:" ("|cat:$oCategory->getNrOfArticles()|cat:")"}][{/if}]
          [{include file="inc/product.tpl" showMainLink=true product=$actionproduct size=$actionproduct_size head=$actionproduct_title head_link=$oCategory->getLink() testid="CatArticle_"|cat:$actionproduct->oxarticles__oxid->value  testHeader="Category_`$smarty.foreach.CatArt.iteration`"}]
          [{assign var="actionproduct_size" value=""}]
      [{/if}]
  [{/foreach}]
[{/if}]

[{include file="inc/tags.tpl"}]

[{ insert name="oxid_tracker" title=$template_title }]
[{include file="_footer.tpl" }]
