<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.oxid-esales.com
 * @package inc
 * @copyright (C) OXID eSales AG 2003-2009
 * $Id: payment_main.inc.php 16302 2009-02-05 10:18:49Z rimvydas.paskevicius $
 */

$aColumns = array( 'container1' => array(    // field , table,  visible, multilanguage, ident
                                        array( 'oxtitle',  'oxgroups', 1, 0, 0 ),
                                        array( 'oxid',     'oxgroups', 0, 0, 0 ),
                                        array( 'oxid',     'oxgroups', 0, 0, 1 ),
                                        ),
                     'container2' => array(
                                        array( 'oxtitle',  'oxgroups', 1, 0, 0 ),
                                        array( 'oxid',     'oxgroups', 0, 0, 0 ),
                                        array( 'oxid',     'oxobject2group', 0, 0, 1 ),
                                        )
                    );

/**
 * Class manages payment user groups
 */
class ajaxComponent extends ajaxListComponent
{
    /**
     * Returns SQL query for data to fetc
     *
     * @return string
     */
    protected function _getQuery()
    {
        // looking for table/view
        $sGroupTable   = getViewName('oxgroups');
        $sGroupId      = oxConfig::getParameter( 'oxid' );
        $sSynchGroupId = oxConfig::getParameter( 'synchoxid' );

        // category selected or not ?
        if ( !$sGroupId)
            $sQAdd  = " from $sGroupTable ";
        else {
            $sQAdd  = " from $sGroupTable, oxobject2group where ";
            $sQAdd .= " oxobject2group.oxobjectid = '$sGroupId' and oxobject2group.oxgroupsid = $sGroupTable.oxid ";
        }

        if ( !$sSynchGroupId )
            $sSynchGroupId = oxConfig::getParameter('oxajax_synchfid');
        if ( $sSynchGroupId && $sSynchGroupId != $sGroupId) {
            if ( !$sGroupId )
                $sQAdd .= 'where ';
            else
                $sQAdd .= 'and ';
            $sQAdd .= " $sGroupTable.oxid not in ( select $sGroupTable.oxid from $sGroupTable, oxobject2group where ";
            $sQAdd .= " oxobject2group.oxobjectid = '$sSynchGroupId' and oxobject2group.oxgroupsid = $sGroupTable.oxid ) ";
        }

        return $sQAdd;
    }

     /**
     * Removes group of users that may pay using selected method(s).
     *
     * @return null
     */
    public function removepaygroup()
    {
        $aRemoveGroups = $this->_getActionIds( 'oxobject2group.oxid' );
        if ( oxConfig::getParameter( 'all' ) ) {

            $sQ = $this->_addFilter( "delete oxobject2group.* ".$this->_getQuery() );
            oxDb::getDb()->Execute( $sQ );

        } elseif ( $aRemoveGroups && is_array( $aRemoveGroups ) ) {
            $sQ = "delete from oxobject2group where oxobject2group.oxid in ('" . implode( "', '", $aRemoveGroups ) . "') ";
            oxDb::getDb()->Execute( $sQ );
        }
    }

    /**
     * Adds group of users that may pay using selected method(s).
     *
     * @return null
     */
    public function addpaygroup()
    {
        $aAddGroups = $this->_getActionIds( 'oxgroups.oxid' );
        $soxId      = oxConfig::getParameter( 'synchoxid');

        if ( oxConfig::getParameter( 'all' ) ) {
            $sGroupTable   = getViewName('oxgroups');
            $aAddGroups = $this->_getAll( $this->_addFilter( "select $sGroupTable.oxid ".$this->_getQuery() ) );
        }
        if ( $soxId && $soxId != "-1" && is_array( $aAddGroups ) ) {
            foreach ($aAddGroups as $sAddgroup) {
                $oNewGroup = oxNew( "oxobject2group" );
                $oNewGroup->oxobject2group__oxobjectid = new oxField($soxId);
                $oNewGroup->oxobject2group__oxgroupsid = new oxField($sAddgroup);
                $oNewGroup->save();
            }
        }
    }
}
