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
 * @link      http://www.oxid-esales.com
 * @package   core
 * @copyright (C) OXID eSales AG 2003-2012
 * @version OXID eShop CE
 * @version   SVN: $Id: oxattributelist.php 44112 2012-04-20 11:36:00Z linas.kukulskis $
 */

/**
 * Attribute list manager.
 */
class oxAttributeList extends oxList
{
    /**
     * Class constructor
     *
     * @param string $sObjectsInListName Associated list item object type
     *
     * @return null
     */
    public function __construct( $sObjectsInListName = 'oxattribute')
    {
        parent::__construct( 'oxattribute');
    }

    /**
     * Load all attributes by article Id's
     *
     * @param array $aIds article id's
     *
     * @return array $aAttributes;
     */
    public function loadAttributesByIds( $aIds )
    {
        if (!count($aIds)) {
            return;
        }

        foreach ($aIds as $iKey => $sVal) {
            $aIds[$iKey] = mysql_real_escape_string($sVal);
        }

        $sAttrViewName = getViewName( 'oxattribute' );
        $sViewName     = getViewName( 'oxobject2attribute' );

        $sSelect  = "select $sAttrViewName.oxid, $sAttrViewName.oxtitle, {$sViewName}.oxvalue, {$sViewName}.oxobjectid ";
        $sSelect .= "from {$sViewName} left join $sAttrViewName on $sAttrViewName.oxid = {$sViewName}.oxattrid ";
        $sSelect .= "where {$sViewName}.oxobjectid in ( '".implode("','", $aIds)."' ) ";
        $sSelect .= "order by {$sViewName}.oxpos, $sAttrViewName.oxpos";

        return $this->_createAttributeListFromSql( $sSelect);
    }

    /**
     * Fills array with keys and products with value
     *
     * @param string $sSelect SQL select
     *
     * @return array $aAttributes
     */
    protected function _createAttributeListFromSql( $sSelect)
    {
        $aAttributes = array();
        $rs = oxDb::getDb()->execute( $sSelect);
        if ($rs != false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                if ( !isset( $aAttributes[$rs->fields[0]])) {
                    $aAttributes[$rs->fields[0]] = new stdClass();
                }

                $aAttributes[$rs->fields[0]]->title = $rs->fields[1];
                if ( !isset( $aAttributes[$rs->fields[0]]->aProd[$rs->fields[3]])) {
                    $aAttributes[$rs->fields[0]]->aProd[$rs->fields[3]] = new stdClass();
                }
                $aAttributes[$rs->fields[0]]->aProd[$rs->fields[3]]->value = $rs->fields[2];
                $rs->moveNext();
            }
        }
        return $aAttributes;
    }

    /**
     * Load attributes by article Id
     *
     * @param string $sArtId    article id
     * @param string $sParentId article parent id
     *
     * @return null;
     */
    public function loadAttributes( $sArtId, $sParentId = null )
    {
        if ( $sArtId ) {

            $sAttrTableName = getViewName( 'oxattribute' );
            $sObject2AtrrTableName  = getViewName( 'oxobject2attribute' );

            $sSelect  = "SELECT `Attributes`.`oxid`, `Attributes`.`oxtitle`,  ";

            if ( !$sParentId ) {
                $sSelect .= "`ArticleAtrr`.`oxvalue` AS `oxvalue` ";
            } else {
                $sSelect .= "IFNULL( `ArticleAtrr`.`oxvalue`, `ParentAtrr`.`oxvalue` ) AS `oxvalue` ";
            }

            $sSelect .= "FROM {$sAttrTableName} AS `Attributes` ";
            $sSelect .= "LEFT JOIN {$sObject2AtrrTableName} AS `ArticleAtrr` ON `Attributes`.`oxid` = `ArticleAtrr`.`oxattrid` ";
            $sSelect .= ($sParentId) ? "LEFT JOIN {$sObject2AtrrTableName} AS `ParentAtrr` ON `Attributes`.`oxId` = `ParentAtrr`.`oxattrid` " : "";
            $sSelect .= "WHERE 1 ";
            $sSelect .= "AND `ArticleAtrr`.`oxobjectid` = '{$sArtId}' AND `ArticleAtrr`.`oxvalue` != '' ";
            $sSelect .= ($sParentId) ? "OR `ParentAtrr`.`oxobjectid` = '{$sParentId}' AND `ParentAtrr`.`oxvalue` != '' " : "";
            $sSelect .= "ORDER BY ";
            $sSelect .= "`ArticleAtrr`.`oxpos`, ";
            $sSelect .= ($sParentId) ? "`ParentAtrr`.`oxpos`, " : "";
            $sSelect .= "`Attributes`.`oxpos`";

            $this->selectString( $sSelect );
        }
    }

     /**
     * get category attributes by category Id
     *
     * @param string  $sCategoryId category Id
     * @param integer $iLang       language No
     *
     * @return object;
     */

    public function getCategoryAttributes( $sCategoryId, $iLang )
    {
        $aSessionFilter = oxSession::getVar( 'session_attrfilter' );

        $oArtList = oxNew( "oxarticlelist");
        $oArtList->loadCategoryIDs( $sCategoryId, $aSessionFilter );

        // Only if we have articles
        if (count($oArtList) > 0 ) {
            $oDb = oxDb::getDb();
            $sArtIds = '';
            foreach (array_keys($oArtList->getArray()) as $sId ) {
                if ($sArtIds) {
                    $sArtIds .= ',';
                }
                $sArtIds .= $oDb->quote($sId);
            }

            $sActCatQuoted = $oDb->quote( $sCategoryId );
            $sAttTbl = getViewName( 'oxattribute', $iLang );
            $sO2ATbl = getViewName( 'oxobject2attribute', $iLang );
            $sC2ATbl = getViewName( 'oxcategory2attribute', $iLang );

            $sSelect = "SELECT DISTINCT att.oxid, att.oxtitle, o2a.oxvalue ".
                       "FROM $sAttTbl as att, $sO2ATbl as o2a ,$sC2ATbl as c2a ".
                       "WHERE att.oxid = o2a.oxattrid AND c2a.oxobjectid = $sActCatQuoted AND c2a.oxattrid = att.oxid AND o2a.oxvalue !='' AND o2a.oxobjectid IN ($sArtIds) ".
                       "ORDER BY c2a.oxsort , att.oxpos, att.oxtitle, o2a.oxvalue";


            $rs = $oDb->execute( $sSelect );

            if ( $rs != false && $rs->recordCount() > 0 ) {
                while ( !$rs->EOF && list( $sAttId, $sAttTitle, $sAttValue ) = $rs->fields ) {

                    if ( !$this->offsetExists( $sAttId ) ) {

                        $oAttribute = oxNew( "oxattribute" );
                        $oAttribute->setTitle( $sAttTitle );

                        $this->offsetSet( $sAttId, $oAttribute );
                        $iLang = oxLang::getInstance()->getBaseLanguage();
                        if ( isset( $aSessionFilter[$sCategoryId][$iLang][$sAttId] ) ) {
                            $oAttribute->setActiveValue( $aSessionFilter[$sCategoryId][$iLang][$sAttId] );
                        }

                    } else {
                        $oAttribute = $this->offsetGet( $sAttId );
                    }

                    $oAttribute->addValue( $sAttValue );
                    $rs->moveNext();
                }
            }
        }

        return $this;
    }
}
