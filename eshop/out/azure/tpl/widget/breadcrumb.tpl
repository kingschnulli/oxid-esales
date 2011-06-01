[{strip}]
[{foreach from=$oView->getBreadCrumb() item=sCrum name=breadcrumb }]    
    [{if $smarty.foreach.breadcrumb.first}]
        <div id="breadCrumb">
            <span>[{ oxmultilang ident="WIDGET_BREADCRUMB_YOUAREHERE" }]:</span>
    [{/if}]        
    &nbsp;/&nbsp;[{if $sCrum.link }]<a href="[{ $sCrum.link }]" title="[{ $sCrum.title}]">[{/if}][{$sCrum.title}][{if $sCrum.link }]</a>[{/if}]
    [{if $smarty.foreach.breadcrumb.last}]
        </div>
        [{if $oView->getClassName() == 'details'  && $sCrum.link}]
            <div id="overviewLink">
                <a href="[{$sCrum.link}]" class="overviewLink">[{ oxmultilang ident="WIDGET_BREADCRUMB_OVERVIEW" }]</a>
            </div>
        [{/if}]                    
    [{/if}]    
[{/foreach}]
[{/strip}]
