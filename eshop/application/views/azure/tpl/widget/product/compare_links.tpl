[{assign var="_additionalParams" value=$oView->getAdditionalParams()}]
[{ if $_compare_in_list}]
  <a class="compare clear" id="removeCmp[{$_compare_testid}]" href="[{$oView->getLink()|oxaddparams:"am=1&amp;removecompare=1&amp;fnc=tocomparelist&amp;aid=`$_compare_aid`&amp;anid=`$_compare_anid`&amp;pgNr=`$_compare_page`&amp;$_additionalParams"}]" rel="nofollow">[{ oxmultilang ident="WIDGET_PRODUCT_REMOVEFROMCOMPARELIST" }]</a>
[{ else }]
  <a class="compare clear" id="toCmp[{$_compare_testid}]" href="[{$oView->getLink()|oxaddparams:"am=1&amp;addcompare=1&amp;fnc=tocomparelist&aid=`$_compare_aid`&amp;anid=`$_compare_anid`&amp;pgNr=`$_compare_page`&amp;$_additionalParams"}]" rel="nofollow">[{ oxmultilang ident="WIDGET_PRODUCT_COMPARE" }]</a>
[{ /if }]

