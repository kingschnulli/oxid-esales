[{ if $_compare_in_list}]
  <a id="test_removeCmp[{$_compare_testid}]" class="[{$_compare_class}]" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl="|cat:$oViewConf->getActiveClassName() params="am=1&amp;removecompare=1&amp;fnc=tocomparelist&amp;aid=`$_compare_aid`&amp;anid=`$_compare_anid`&amp;pgNr=`$_compare_page`"|cat:$oViewConf->getNavUrlParams() }]" rel="nofollow">[{ oxmultilang ident=$_compare_text_from_id }]</a>
[{ else }]
  <a id="test_toCmp[{$_compare_testid}]" class="[{$_compare_class}]" href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl="|cat:$oViewConf->getActiveClassName() params="am=1&amp;addcompare=1&amp;fnc=tocomparelist&aid=`$_compare_aid`&amp;anid=`$_compare_anid`&amp;pgNr=`$_compare_page`"|cat:$oViewConf->getNavUrlParams() }]" rel="nofollow">[{ oxmultilang ident=$_compare_text_to_id }]</a>
[{ /if }]