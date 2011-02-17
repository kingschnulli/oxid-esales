<div class="search">
  <form action="[{$oViewConf->getSelfActionLink()}]" method="get" class="search" id="f.search">
  [{$oViewConf->getHiddenSid()}]
  <input type="hidden" name="cl" value="search">
  <lable for="f.search.param">[{oxmultilang ident="SEARCH_TITLE"}]</label>
  <input type="text" name="searchparam" value="[{$searchparamforhtml}]" id="f.search.param">
  <input type="submit" value="[{oxmultilang ident="SEARCH_GO"}]">
</div>