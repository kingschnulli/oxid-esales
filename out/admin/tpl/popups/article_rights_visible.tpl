[{include file="popups/headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
    initAoc = function()
    {
        YAHOO.oxid.container1 = new YAHOO.oxid.aoc( 'container1',
                                                    [ [{ foreach from=$oxajax.container1 item=aItem key=iKey }]
                                                       [{$sSep}][{strip}]{ key:'_[{ $iKey }]', ident: [{if $aItem.4 }]true[{else}]false[{/if}]
                                                       [{if !$aItem.4 }],
                                                       label: '[{ oxmultilang ident="GENERAL_AJAX_SORT_"|cat:$aItem.0|upper }]',
                                                       visible: [{if $aItem.2 }]true[{else}]false[{/if}]
                                                       [{/if}]}
                                                      [{/strip}]
                                                      [{assign var="sSep" value=","}]
                                                      [{ /foreach }] ],
                                                    '[{ $oViewConf->getAjaxLink() }]cmpid=container1&container=article_rights_visible&synchoxid=[{ $oxid }]'
                                                    );

        [{assign var="sSep" value=""}]

        YAHOO.oxid.container2 = new YAHOO.oxid.aoc( 'container2',
                                                    [ [{ foreach from=$oxajax.container2 item=aItem key=iKey }]
                                                       [{$sSep}][{strip}]{ key:'_[{ $iKey }]', ident: [{if $aItem.4 }]true[{else}]false[{/if}]
                                                       [{if !$aItem.4 }],
                                                       label: '[{ oxmultilang ident="GENERAL_AJAX_SORT_"|cat:$aItem.0|upper }]',
                                                       visible: [{if $aItem.2 }]true[{else}]false[{/if}]
                                                       [{/if}]}
                                                      [{/strip}]
                                                      [{assign var="sSep" value=","}]
                                                      [{ /foreach }] ],
                                                    '[{ $oViewConf->getAjaxLink() }]cmpid=container2&container=article_rights_visible&oxid=[{ $oxid }]'
                                                    );

        YAHOO.oxid.container1.getDropAction = function()
        {
            return 'fnc=addgrouptoview';
        }
        YAHOO.oxid.container2.getDropAction = function()
        {
            return 'fnc=removegroupfromview';
        }
    }
    $E.onDOMReady( initAoc );
</script>

    <table width="100%">
        <colgroup>
            <col span="2" width="50%" />
        </colgroup>
        <tr class="edittext">
            <td colspan="2">[{ oxmultilang ident="GENERAL_AJAX_DESCRIPTION" }]<br>[{ oxmultilang ident="GENERAL_FILTERING" }]<br /><br /></td>
        </tr>
        <tr class="edittext">
            <td align="center"><b>[{ oxmultilang ident="ARTICLE_RIGHTS_ALLGROUPS" }]</b></td>
            <td align="center"><b>[{ oxmultilang ident="ARTICLE_RIGHTS_SETGROUPS2" }]</b></td>
        </tr>
        <tr>
            <td valign="top" id="container1"></td>
            <td valign="top" id="container2"></td>
        </tr>
        <tr>
            <td><input type="button" class="edittext oxid-aoc-button" value="[{ oxmultilang ident="GENERAL_AJAX_ASSIGNALL" }]" id="container1_btn"></td>
            <td><input type="button" class="edittext oxid-aoc-button" value="[{ oxmultilang ident="GENERAL_AJAX_UNASSIGNALL" }]" id="container2_btn"></td>
        </tr>
    </table>

</body>
</html>