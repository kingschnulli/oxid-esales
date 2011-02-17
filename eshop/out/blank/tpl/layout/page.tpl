<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="[{ $oView->getActiveLangAbbr() }]">
<head>
  <title>[{$oView->getTitle()}]</title>

  [{oxstyle include="reset.css"}]
  [{oxstyle include="layout.css"}]
  [{oxstyle include="boxes.css"}]
  [{oxstyle include="typography.css"}]

  [{oxstyle}]

  [{$oxid.block.head}]
</head>
<body>
  <div id="page">
    [{oxinclude file="block/header.tpl"}]
    [{*oxinclude file="block/banner.tpl"*}]
    [{oxinclude file="block/sidebar.tpl"}]
    <div id="content">
        [{oxinclude file="list/errors.tpl"}]
        [{$oxid.block.content}]
    </div>
    [{oxinclude file="block/footer.tpl"}]
  </div>
  [{oxscript}]
</body>
</html>