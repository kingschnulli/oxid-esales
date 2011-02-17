<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="[{ $oView->getActiveLangAbbr() }]">
<head>
  <title>[{$oView->getTitle()}]</title>
  [{oxstyle include="reset.css"}]
  [{oxstyle include="layout.css"}]
  [{oxstyle include="typography.css"}]
  [{oxstyle include="debug.css"}]
</head>
<body>
  <div id="page">
    [{$content}]
  </div>
  [{oxscript}]
</body>
</html>