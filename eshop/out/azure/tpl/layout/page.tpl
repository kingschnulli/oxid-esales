[{capture append="oxidBlock_pageBody"}]
    <div id="page" class="pageLayout[{if $sidebar}] sidebar[{$sidebar}][{/if}]">
    [{include file="layout/header.tpl"}]
    [{if $oView->getClassName() ne "start"}]
        <div id="breadCrumb">[{ include file="widget/breadcrumb.tpl"}]</div>
    [{/if}]
    [{if $sidebar}]
    <div id="sidebar">
        [{include file="layout/sidebar.tpl"}]
     </div>
    [{/if}]
    <div id="content">
        [{include file="message/errors.tpl"}]
        [{foreach from=$oxidBlock_content item="_block"}]
            [{$_block}]
        [{/foreach}]
    </div>
    [{include file="layout/footer.tpl"}]
    </div>
    [{include file="widget/facebook/init.tpl"}]
[{/capture}]
[{include file="layout/base.tpl"}]