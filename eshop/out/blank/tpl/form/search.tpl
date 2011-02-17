<form class="search" action="[{ $oViewConf->getSelfActionLink() }]" method="get">
  <div>
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="cl" value="search">
    <input type="text" name="searchparam" value="[{$searchparamforhtml}]">
    <input type="submit" value="search">
  </div>
</form>