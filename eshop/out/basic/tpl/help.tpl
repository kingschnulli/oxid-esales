[{assign var="template_title" value="HELP_TITLE"|oxmultilangassign}]
[{include file="_header.tpl" title=$template_title location=$template_title}]

<strong id="test_helpHeader" class="boxhead">[{ oxmultilang ident="HELP_HELP" }]</strong>
<div class="box info">
  [{ oxcontent oxid=$oView->getContentId() }]
</div>

[{ insert name="oxid_tracker" title=$template_title }]
[{include file="_footer.tpl"}]
