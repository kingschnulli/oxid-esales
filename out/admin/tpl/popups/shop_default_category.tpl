[{include file="popups/headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
    initAoc = function()
    {

        YAHOO.oxid.container1 = new YAHOO.oxid.aoc( 'container1',
                                                    [ [{ foreach from=$oxajax.container1 item=aItem key=iKey }]
                                                       [{$sSep}][{strip}]{ key:'_[{ $iKey }]', ident: [{if $aItem.4 }]true[{else}]false[{/if}]
                                                       [{if !$aItem.4 }],
                                                       label: '[{ oxmultilang ident="GENERAL_AJAX_SORT_"|cat:$aItem.0|oxupper }]',
                                                       visible: [{if $aItem.2 }]true[{else}]false[{/if}]
                                                       [{/if}]}
                                                      [{/strip}]
                                                      [{assign var="sSep" value=","}]
                                                      [{ /foreach }] ],
                                                    '[{ $oViewConf->getAjaxLink() }]cmpid=container1&container=shop_default_category&synchoxid=[{ $oxid }]',
                                                     { selectionMode: "single" }
                                                    );

        YAHOO.oxid.container1.modRequest = function( sRequest )
        {
            return sRequest;
        }
        YAHOO.oxid.container1.onSave = function()
        {
            var aSelRows= YAHOO.oxid.container1.getSelectedRows();
            if ( aSelRows.length ) {
                oParam = YAHOO.oxid.container1.getRecord(aSelRows[0]);
                $('defcat_title').innerHTML  = oParam._oData._0;
                $('remBtn').disabled = false;
                $D.setStyle( $('_defcat'), 'visibility', '' );
            }
        }
        YAHOO.oxid.container1.assignCat = function()
        {
            var callback = {
                success: YAHOO.oxid.container1.onSave,
                failure: YAHOO.oxid.container1.onFailure,
                scope:   YAHOO.oxid.container1
            };
            var aSelRows= YAHOO.oxid.container1.getSelectedRows();
            if ( aSelRows.length ) {
                oParam = YAHOO.oxid.container1.getRecord(aSelRows[0]);
                sRequest = '&oxcatid=' + oParam._oData._2;
            }
            YAHOO.util.Connect.asyncRequest( 'GET', '[{ $oViewConf->getAjaxLink() }]&cmpid=container1&container=shop_default_category&fnc=assignCat&oxid=[{ $oxid }]'+sRequest, callback );

        }
        YAHOO.oxid.container1.onRemove = function()
        {
            $('defcat_title').innerHTML  = '';
            $('remBtn').disabled = true;
            $D.setStyle( $('_defcat'), 'visibility', 'hidden' );
        }
        YAHOO.oxid.container1.onFailure = function() { /* currently does nothing */ }
        YAHOO.oxid.container1.unassignCat = function()
        {
            var callback = {
                success: YAHOO.oxid.container1.onRemove,
                failure: YAHOO.oxid.container1.onFailure,
                scope:   YAHOO.oxid.container1
            };
            YAHOO.util.Connect.asyncRequest( 'GET', '[{ $oViewConf->getAjaxLink() }]&cmpid=container1&container=shop_default_category&fnc=unassignCat&oxid=[{ $oxid }]', callback );

        }
        // subscribint event listeners on buttons
        $E.addListener( $('remBtn'), "click", YAHOO.oxid.container1.unassignCat, $('remBtn') );
        $E.addListener( $('saveBtn'), "click", YAHOO.oxid.container1.assignCat, $('saveBtn') );
    }
    $E.onDOMReady( initAoc );
</script>

    <table width="100%">
        <tr class="edittext">
            <td >[{ oxmultilang ident="GENERAL_FILTERING" }]<br /><br /></td>
        </tr>
        <tr class="edittext">
            <td align="center"><b>[{ oxmultilang ident="SHOP_CONFIG_ACTIVECATEGORYBYSTART" }]</b></td>
        </tr>
        <tr>
            <td valign="top" id="container1"></td>
        </tr>
        <tr>
            <td>
                <input id="saveBtn" type="button" class="edittext oxid-aoc-button" value="[{ oxmultilang ident="SHOP_CONFIG_ASSIGNDEFAULTCAT" }]">
                <input id="remBtn" type="button" class="edittext oxid-aoc-button" value="[{ oxmultilang ident="SHOP_CONFIG_UNASSIGNDEFAULTCAT" }]" [{if !$defcat }] disabled [{/if}]>
            </td>
        </tr>
        <tr>
            <td valign="top" class="edittext" id="_defcat" [{if !$defcat }] style="visibility:hidden" [{/if}]>
              <b>[{ oxmultilang ident="SHOP_CONFIG_ASSIGNEDDEFAULTCAT" }]</b>
              <b id="defcat_title">[{ $defcat->oxcategories__oxtitle->value }]</b>
            </td>
        </tr>
    </table>

</body>
</html>
