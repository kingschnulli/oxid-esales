<ul class="list news">
  [{foreach from=news item=_nws }]
  <li><a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=news" }]#[{$_nws->oxnews__oxid->value}]">[{ $_nws->oxnews__oxlongdesc->value}]</a></li>
  [{/foreach}]
</ul>
