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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: article_extend.inc.php 13619 2008-10-24 09:40:23Z sarunas $
 */

$aColumns = array( 'container1' => array(    // field , table,         visible, multilanguage, ident
                                        array( 'oxtitle', 'oxcategories', 1, 1, 0 ),
                                        array( 'oxdesc',  'oxcategories', 1, 1, 0 ),
                                        array( 'oxid',    'oxcategories', 0, 0, 1 )
                                        ),
                     'container2' => array(
                                        array( 'oxtitle', 'oxcategories', 1, 1, 0 ),
                                        array( 'oxdesc',  'oxcategories', 1, 1, 0 ),
                                        array( 'oxid',    'oxobject2category', 0, 0, 1 ),
                                        array( 'oxtime',  'oxobject2category', 0, 0, 1 ),
                                        array( 'oxid',    'oxcategories',      0, 0, 1 )
                                        ),
                   );
/**
 * Class controls article assignment to category
 */
class ajaxcomponent extends ajaxlistcomponent
{
    /**
     * Returns SQL query for data to fetc
     *
     * @return string
     */
    protected function _getQuery()
    {
        $sCategoriesTable = getViewName( 'oxcategories' );
        $sO2CView = getViewName( 'oxobject2category' );

        $sOxid      = oxConfig::getParameter( 'oxid' );
        $sSynchOxid = oxConfig::getParameter( 'synchoxid' );

        if ( $sOxid ) {
            // all categories article is in
            $sQAdd  = " from $sO2CView left join $sCategoriesTable on $sCategoriesTable.oxid=$sO2CView.oxcatnid ";
            $sQAdd .= " where $sO2CView.oxobjectid = '$sOxid' and $sCategoriesTable.oxid is not null ";
        } else {
            $sQAdd  = " from $sCategoriesTable where $sCategoriesTable.oxid not in ( ";
            $sQAdd .= " select $sCategoriesTable.oxid from $sO2CView left join $sCategoriesTable on $sCategoriesTable.oxid=$sO2CView.oxcatnid ";
            $sQAdd .= " where $sO2CView.oxobjectid = '$sSynchOxid' and $sCategoriesTable.oxid is not null ) ";
        }

        return $sQAdd;
    }

    /**
     * Removes article from chosen category
     *
     * @return null
     */
    public function removecat()
    {
        $myConfig   = $this->getConfig();
        $aRemoveCat = $this->_getActionIds( 'oxobject2category.oxid' );
        $soxId      = oxConfig::getParameter( 'oxid' );
        $sShopID    = $myConfig->getShopId();
        $sO2CView = getViewName( 'oxobject2category' );

        // removing all
        if ( oxConfig::getParameter( 'all' ) ) {

            $sQ = $this->_addFilter( "delete $sO2CView.* ".$this->_getQuery() );
            oxDb::getDb()->Execute( $sQ );

        } elseif ( is_array( $aRemoveCat ) && count( $aRemoveCat ) ) {

            $sQ = 'delete from oxobject2category where oxid in ("' . implode( '", "', $aRemoveCat ) . '")';
            oxDb::getDb()->Execute( $sQ );

        }
    }

    /**
     * Adds article to chosen category
     *
     * @return null
     */
    public function addcat()
    {
        $myConfig = $this->getConfig();
        $aAddCat = $this->_getActionIds( 'oxcategories.oxid' );
        $soxId   = oxConfig::getParameter( 'synchoxid' );
        $sShopID = $myConfig->getShopId();
        $sO2CView = getViewName('oxobject2category');

        // adding
        if ( oxConfig::getParameter( 'all' ) ) {
            $sCategoriesTable = getViewName( 'oxcategories' );
            $aAddCat = $this->_getAll( $this->_addFilter( "select $sCategoriesTable.oxid ".$this->_getQuery() ) );
        }

        if ( isset( $aAddCat) && is_array($aAddCat)) {


            $oNew = oxNew( 'oxbase' );
            $oNew->init( 'oxobject2category' );

            foreach ( $aAddCat as $sAdd ) {

                // check, if it's already in, then don't add it again
                $sSelect = 'select 1 from ' . $sO2CView . ' as oxobject2category where oxobject2category.oxcatnid="' . $sAdd . '" and oxobject2category.oxobjectid ="' . $soxId . '"';
                if ( oxDb::getDb()->getOne( $sSelect ) )
                    continue;

                $oNew->oxobject2category__oxid       = new oxField($oNew->setId( oxUtilsObject::getInstance()->generateUID() ));
                $oNew->oxobject2category__oxobjectid = new oxField($soxId);
                $oNew->oxobject2category__oxcatnid   = new oxField($sAdd);
                $oNew->oxobject2category__oxtime     = new oxField(time());


                $oNew->save();
            }
        }
    }

    /**
     * Sets selected category as a default
     *
     * @return null
     */
    public function setAsDefault()
    {
        $myConfig = $this->getConfig();
        $sDefCat = oxConfig::getParameter( "defcat" );
        $soxId   = oxConfig::getParameter( "oxid" );
        $sShopId = $myConfig->getShopId();

        $sShopCheck = "";

        $sQ = "update oxobject2category set oxtime = oxtime + 10 where oxobjectid = '$soxId' $sShopCheck ";
        oxDb::getInstance()->getDb()->Execute($sQ);
        $sQ = "update oxobject2category set oxtime = 0 where oxobjectid = '$soxId' and oxcatnid = '".$sDefCat."' $sShopCheck ";
        oxDb::getInstance()->getDb()->Execute($sQ);
    }
}
