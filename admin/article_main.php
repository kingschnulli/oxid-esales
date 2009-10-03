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
 * @package admin
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: article_main.php 22897 2009-10-02 11:24:07Z arvydas $
 */

/**
 * Admin article main manager.
 * Collects and updates (on user submit) article base parameters data ( such as
 * title, article No., short Description and etc.).
 * Admin Menu: Manage Products -> Articles -> Main.
 * @package admin
 */
class Article_Main extends oxAdminDetails
{
    /**
     * Saved/active product id
     *
     * @var string
     */
    protected $_sSavedId = null;

    /**
     * Loads article parameters and passes them to Smarty engine, returns
     * name of template file "article_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig = $this->getConfig();
        parent::render();

        $this->_aViewData['edit'] = $oArticle = oxNew( 'oxarticle' );

        $soxId  = oxConfig::getParameter( "oxid" );
        $svoxId = oxConfig::getParameter( "voxid" );
        $soxparentId = oxConfig::getParameter( "oxparentid" );

        // new variant ?
        if ( isset( $svoxId ) && $svoxId == "-1" && isset($soxparentId) && $soxparentId && $soxparentId != "-1") {
            $oParentArticle = oxNew( "oxarticle");
            $oParentArticle->load( $soxparentId);
            $this->_aViewData["parentarticle"] = $oParentArticle;
            $this->_aViewData["oxparentid"] = $soxparentId;

            $this->_aViewData["oxid"] =  $soxId = "-1";
        }

        // check if we right now saved a new entry
        if ( $this->_sSavedId ) {
            $this->_aViewData["oxid"] = $soxId = $this->_sSavedId;;

            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        if (  $soxId && $soxId != "-1") {

            // load object
            $oArticle->loadInLang( $this->_iEditLang, $soxId );


            // load object in other languages
            $oOtherLang = $oArticle->getAvailableInLangs();
            if (!isset($oOtherLang[$this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $oArticle->loadInLang( key($oOtherLang), $soxId );
            }

            // variant handling
            if ( $oArticle->oxarticles__oxparentid->value) {
                $oParentArticle = oxNew( "oxarticle");
                $oParentArticle->load( $oArticle->oxarticles__oxparentid->value);
                $this->_aViewData["parentarticle"] = $oParentArticle;
                $this->_aViewData["oxparentid"]    = $oArticle->oxarticles__oxparentid->value;
                $this->_aViewData["issubvariant"]  = 1;
            }

            // #381A
            $this->_formJumpList($oArticle, $oParentArticle );

            //loading tags
            $oArticle->tags = $oArticle->getTags();

            $aLang = array_diff (oxLang::getInstance()->getLanguageNames(), $oOtherLang);
            if ( count( $aLang))
                $this->_aViewData["posslang"] = $aLang;

            foreach ( $oOtherLang as $id => $language) {
                $oLang= new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] =  clone $oLang;
            }
        }

        $this->_aViewData["editor"] = $this->_generateTextEditor( "100%", 300, $oArticle, "oxarticles__oxlongdesc", "details.tpl.css");
        $this->_aViewData["blUseTimeCheck"] = $myConfig->getConfigParam( 'blUseTimeCheck' );

        return "article_main.tpl";
    }

    /**
     * Saves changes of article parameters.
     *
     * @return null
     */
    public function save()
    {
        $myConfig  = $this->getConfig();
        $myUtilsCount = oxUtilsCount::getInstance();

        $soxId      = oxConfig::getParameter( "oxid" );
        $aParams    = oxConfig::getParameter( "editval" );


        // checkbox handling
        if ( !isset( $aParams['oxarticles__oxactive']))
            $aParams['oxarticles__oxactive'] = 0;

        // default values
        $aParams = $this->addDefaultValues( $aParams);

        // null values
        if ($aParams['oxarticles__oxvat'] === '')
            $aParams['oxarticles__oxvat'] = null;

        // varianthandling
        $soxparentId = oxConfig::getParameter( "oxparentid");
        if ( isset( $soxparentId) && $soxparentId && $soxparentId != "-1")
            $aParams['oxarticles__oxparentid'] = $soxparentId;
        else
            unset( $aParams['oxarticles__oxparentid']);

        $oArticle = oxNew( "oxarticle");

        $oArticle->setLanguage($this->_iEditLang);
        if ( $soxId != "-1")
            $oArticle->loadInLang( $this->_iEditLang, $soxId);
        else {
            $aParams['oxarticles__oxid']        = null;
            $aParams['oxarticles__oxissearch']  = 1;
            $aParams['oxarticles__oxstockflag'] = 1;
                // shopid
                $sShopID = oxSession::getVar( "actshop");
                $aParams['oxarticles__oxshopid'] = $sShopID;
        }

        //article number handling, warns for artnum dublicates
        if ( isset( $aParams['oxarticles__oxartnum']) && strlen($aParams['oxarticles__oxartnum']) > 0 &&
            $myConfig->getConfigParam( 'blWarnOnSameArtNums' ) &&
            $oArticle->oxarticles__oxartnum->value !=  $aParams['oxarticles__oxartnum']
            ) {
            $sSelect  = "select oxid from ".$oArticle->getCoreTableName();
            $sSelect .= " where oxartnum = '".$aParams['oxarticles__oxartnum']."'";
            $sSelect .= " and oxid != '".$aParams['oxarticles__oxid']."'";
            if ($oArticle->assignRecord( $sSelect ))
                $this->_aViewData["errorsavingatricle"] = 1;
        }

            // #905A resetting article count in price categories if price has been changed
            if ( isset($aParams["oxarticles__oxprice"]) && $aParams["oxarticles__oxprice"] != $oArticle->oxarticles__oxprice->value) {
                $this->resetCounter( "priceCatArticle", $oArticle->oxarticles__oxprice->value );
            }

            $aResetIds = array();
            if ( $aParams['oxarticles__oxactive'] != $oArticle->oxarticles__oxactive->value) {
                //check categories
                $oDb = oxDb::getDb();
                $sQ = "select oxcatnid from oxobject2category where oxobjectid = ".$oDb->quote( $oArticle->oxarticles__oxid->value );
                $rs = $oDb->execute($sQ);
                if ( $rs !== false && $rs->recordCount() > 0 ) {
                    while (!$rs->EOF) {
                        $this->resetCounter( "catArticle", $rs->fields[0] );
                        $rs->moveNext();
                    }
                }

                // vendors
                $aResetIds['vendor'][$oArticle->oxarticles__oxvendorid->value] = 1;
                $aResetIds['manufacturer'][$oArticle->oxarticles__oxmanufacturerid->value] = 1;
            }

            // reset vendors
            if ( isset( $aParams["oxarticles__oxvendorid"] ) && $aParams["oxarticles__oxvendorid"] != $oArticle->oxarticles__oxvendorid->value ) {
                $aResetIds['vendor'][$aParams['oxarticles__oxvendorid']] = 1;
                $aResetIds['vendor'][$oArticle->oxarticles__oxvendorid->value] = 1;
            }

            // reset Manufacturers
            if ( isset($aParams["oxarticles__oxmanufacturerid"]) && $aParams["oxarticles__oxmanufacturerid"] != $oArticle->oxarticles__oxmanufacturerid->value) {
                $aResetIds['manufacturer'][$aParams['oxarticles__oxmanufacturerid']] = 1;
                $aResetIds['manufacturer'][$oArticle->oxarticles__oxmanufacturerid->value] = 1;
            }

            // resetting counts
            $this->_resetCounts( $aResetIds );

        $oArticle->setLanguage(0);

        //triming spaces from article title (M:876)
        $aParams['oxarticles__oxtitle'] = trim( $aParams['oxarticles__oxtitle'] );

        $oArticle->assign( $aParams );
        $oArticle->setLanguage($this->_iEditLang);

        $oArticle = oxUtilsFile::getInstance()->processFiles( $oArticle );

        $oArticle->save();

        // set oxid if inserted
        if ( $soxId == "-1") {
            $this->_sSavedId = $oArticle->getId();

            $sFastCat = oxConfig::getParameter( "art_category");

            if ( $sFastCat != "-1") {
                $oNew = oxNew( "oxbase");
                $oNew->init( "oxobject2category" );
                $oNew->oxobject2category__oxtime = new oxField(time());
                $oNew->oxobject2category__oxobjectid = new oxField($oArticle->getId());
                $oNew->oxobject2category__oxcatnid = new oxField($sFastCat);

                $oNew->save();

                    // resetting amount of articles in category
                    $this->resetCounter( "catArticle", $sFastCat );
            }
        }


        $this->_aViewData["updatelist"] = "1";

        //saving tags
        $sTags = $aParams['tags'];
        if (!trim($sTags))
            $sTags = $oArticle->oxarticles__oxsearchkeys->value;
        $oArticle->saveTags($sTags);
    }

    /**
     * Copies article (with all parameters) to new articles.
     *
     * @param string $sOldId    old product id (default null)
     * @param string $sNewId    new product id (default null)
     * @param string $sParentId product parent id
     * @param bool
     *
     * @return null
     */
    public function copyArticle( $sOldId = null, $sNewId = null, $sParentId = null )
    {
        $myConfig  = $this->getConfig();

        $sOldId = $sOldId?$sOldId:oxConfig::getParameter( 'oxid' );
        $sNewId = $sNewId?$sNewId:oxUtilsObject::getInstance()->generateUID();

        $oArticle = oxNew( 'oxbase' );
        $oArticle->init( 'oxarticles' );
        if ( $oArticle->load( $sOldId ) ) {

            if ( $myConfig->getConfigParam( 'blDisableDublArtOnCopy' ) ) {
                $oArticle->oxarticles__oxactive->setValue(0);
                $oArticle->oxarticles__oxactivefrom->setValue(0);
                $oArticle->oxarticles__oxactiveto->setValue(0);
            }

            // setting parent id
            if ( $sParentId ) {
                $oArticle->oxarticles__oxparentid->setValue($sParentId);
            }

            $oArticle->setId( $sNewId );
            $oArticle->save();

            //copy categories
            $this->_copyCategories( $sOldId, $sNewId );

            //atributes
            $this->_copyAttributes( $sOldId, $sNewId );

            //sellist
            $this->_copySelectlists( $sOldId, $sNewId );

            //crossseling
            $this->_copyCrossseling( $sOldId, $sNewId );

            //accessoire
            $this->_copyAccessoires( $sOldId, $sNewId );

            // #983A copying staffelpreis info
            $this->_copyStaffelpreis( $sOldId, $sNewId );

            //copy article extends (longdescription, tags)
            $this->_copyArtExtends( $sOldId, $sNewId);

                // resetting
                $aResetIds['vendor'][$oArticle->oxarticles__oxvendorid->value] = 1;
                $aResetIds['manufacturer'][$oArticle->oxarticles__oxmanufacturerid->value] = 1;
                $this->_resetCounts( $aResetIds );


            $myUtilsObject = oxUtilsObject::getInstance();
            $oDb = oxDb::getDb();

            //copy variants
            $sQ = "select oxid from oxarticles where oxparentid = ".$oDb->quote( $sOldId );
            $rs = $oDb->execute($sQ);
            if ( $rs !== false && $rs->recordCount() > 0) {
                while ( !$rs->EOF ) {
                    $this->copyArticle( $rs->fields[0], $myUtilsObject->generateUID(), $sNewId );
                    $rs->moveNext();
                }
            }

            // only for top articles
            if ( !$sParentId ) {

                $this->_sSavedId = $oArticle->getId();

                //article number handling, warns for artnum dublicates
                if ( $myConfig->getConfigParam( 'blWarnOnSameArtNums' ) &&
                     $oArticle->oxarticles__oxartnum->value && oxConfig::getParameter( 'fnc' ) == 'copyArticle' ) {
                    $sSelect = "select oxid from ".$oArticle->getCoreTableName()."
                                where oxartnum = ".$oDb->quote( $oArticle->oxarticles__oxartnum->value )." and oxid != ".$oDb->quote( $sNewId );

                    if ( $oArticle->assignRecord( $sSelect ) ) {
                        $this->_aViewData["errorsavingatricle"] = 1;
                    }
                }
            }
        }
    }

    /**
     * Copying category assignments
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copyCategories( $sOldID, $sNewID )
    {
        $myConfig = $this->getConfig();
        $myUtils  = oxUtils::getInstance();
        $oActShop = $myConfig->getActiveShop();
        $myUtilsCount  = oxUtilsCount::getInstance();
        $myUtilsObject = oxUtilsObject::getInstance();
        $oDb = oxDb::getDb();

        $sO2CView = getViewName('oxobject2category');
        $sQ = "select oxcatnid, oxtime from $sO2CView where oxobjectid = ".$oDb->quote( $sOldID );
        $rs = $oDb->execute($sQ);
        if ($rs !== false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                $sUID = $myUtilsObject->generateUID();
                $sCatID = $rs->fields[0];
                $sTime =  $rs->fields[1];

                    $oDb->execute("insert into oxobject2category (oxid, oxobjectid, oxcatnid, oxtime) VALUES (".$oDb->quote( $sUID ).", ".$oDb->quote( $sNewID ).", ".$oDb->quote( $sCatID ).", ".$oDb->quote( $sTime ).") ");
                $rs->moveNext();

                    // resetting article count in category
                    $this->resetCounter( "catArticle", $sCatID );
            }
        }
    }

    /**
     * Copying attributes assignments
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copyAttributes( $sOldID, $sNewID )
    {
        $myUtilsObject = oxUtilsObject::getInstance();
        $oDb = oxDb::getDb();

        $sQ = "select oxid from oxobject2attribute where oxobjectid = ".$oDb->quote( $sOldID );
        $rs = $oDb->Execute($sQ);
        if ($rs !== false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                // #1055A
                $oAttr = oxNew( "oxbase");
                $oAttr->init( "oxobject2attribute" );
                $oAttr->load( $rs->fields[0]);
                $oAttr->setId( $myUtilsObject->generateUID() );
                $oAttr->oxobject2attribute__oxobjectid->setValue($sNewID);
                $oAttr->save();
                $rs->moveNext();
            }
        }
    }

    /**
     * Copying selectlists assignments
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copySelectlists( $sOldID, $sNewID)
    {
        $myUtilsObject = oxUtilsObject::getInstance();
        $oDb = oxDb::getDb();

        $sQ = "select oxselnid from oxobject2selectlist where oxobjectid = ".$oDb->quote( $sOldID );
        $rs = $oDb->Execute($sQ);

        if ($rs !== false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                $sUID = $myUtilsObject->generateUID();
                $sID = $rs->fields[0];
                $oDb->Execute("insert into oxobject2selectlist (oxid, oxobjectid, oxselnid) VALUES (".$oDb->quote( $sUID ).", ".$oDb->quote( $sNewID ).", ".$oDb->quote( $sID ).") ");
                $rs->moveNext();
            }
        }
    }

    /**
     * Copying crossseling assignments
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copyCrossseling( $sOldID, $sNewID )
    {
        $myUtilsObject = oxUtilsObject::getInstance();
        $oDb = oxDb::getDb();

        $sQ = "select oxobjectid from oxobject2article where oxarticlenid = ".$oDb->quote( $sOldID );
        $rs = $oDb->Execute($sQ);
        if ($rs !== false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                $sUID = $myUtilsObject->generateUID();
                $sID = $rs->fields[0];
                $oDb->Execute("insert into oxobject2article (oxid, oxobjectid, oxarticlenid) VALUES (".$oDb->quote( $sUID ).", ".$oDb->quote( $sID ).", ".$oDb->quote( $sNewID )." ) ");
                $rs->moveNext();
            }
        }
    }

    /**
     * Copying accessoires assignments
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copyAccessoires( $sOldID, $sNewID )
    {
        $myUtilsObject = oxUtilsObject::getInstance();
        $oDb = oxDb::getDb();

        $sQ = "select oxobjectid from oxaccessoire2article where oxarticlenid= ".$oDb->quote( $sOldID );
        $rs = $oDb->Execute($sQ);
        if ($rs !== false && $rs->recordCount() > 0) {
            while (!$rs->EOF) {
                $sUID = $myUtilsObject->generateUID();
                $sID = $rs->fields[0];
                $oDb->Execute("insert into oxaccessoire2article (oxid, oxobjectid, oxarticlenid) VALUES (".$oDb->quote( $sUID ).", ".$oDb->quote( $sID ).", ".$oDb->quote( $sNewID ).") ");
                $rs->moveNext();
            }
        }
    }

    /**
     * Copying staffelpreis assignments
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copyStaffelpreis( $sOldID, $sNewID )
    {
        $myConfig = $this->getConfig();
        $sShopID = $myConfig->getShopID();
        $oPriceList = oxNew("oxlist");
        $oPriceList->init( "oxbase", "oxprice2article");
        $sQ = "select * from oxprice2article where oxartid = '$sOldID' and oxshopid = '$sShopID' and (oxamount > 0 or oxamountto > 0) order by oxamount ";
        $oPriceList->selectString($sQ);
        if ($oPriceList->count()) {
            foreach ($oPriceList as $oItem) {
                $oItem->oxprice2article__oxid->setValue($oItem->setId());
                $oItem->oxprice2article__oxartid->setValue($sNewID);
                $oItem->save();
            }
        }
    }

    /**
     * Copying article extends
     *
     * @param $sOldID string Id from old article
     * @param $sNewID string Id from new article
     *
     * @return null
     */
    protected function _copyArtExtends( $sOldID, $sNewID)
    {
        $oExt = oxNew( "oxbase");
        $oExt->init( "oxartextends" );
        $oExt->load( $sOldID);
        $oExt->setId( $sNewID );
        $oExt->save();
    }


    /**
     * Saves article parameters in different language.
     *
     * @return null
     */
    public function saveinnlang()
    {
        $myConfig  = $this->getConfig();
        $myUtilsCount = oxUtilsCount::getInstance();

        $soxId   = oxConfig::getParameter( "oxid" );
        $aParams = oxConfig::getParameter( "editval" );

        // checkbox handling
        if ( !isset( $aParams['oxarticles__oxactive'] ) ) {
            $aParams['oxarticles__oxactive'] = 0;
        }

        // default values
        $aParams = $this->addDefaultValues( $aParams);

        // null values
        if ($aParams['oxarticles__oxvat'] === '')
            $aParams['oxarticles__oxvat'] = null;

        // varianthandling
        $soxparentId = oxConfig::getParameter( "oxparentid");
        if ( isset( $soxparentId) && $soxparentId && $soxparentId != "-1")
            $aParams['oxarticles__oxparentid'] = $soxparentId;

        $oArticle = oxNew( "oxarticle");
        $oArticle->setLanguage($this->_iEditLang);

        if ( $soxId != "-1")
            $oArticle->load( $soxId);
        else {
            $aParams['oxarticles__oxid'] = null;
                // shopid
                $sShopID = oxSession::getVar( "actshop");
                $aParams['oxarticles__oxshopid'] = $sShopID;
        }

            // #905A resetting article count in price categories if price has been changed
            if ( isset($aParams["oxarticles__oxprice"]) && $aParams["oxarticles__oxprice"] != $oArticle->oxarticles__oxprice->value) {
                $this->resetCounter( "priceCatArticle", $oArticle->oxarticles__oxprice->value );
            }

            $aResetIds = array();

            if ( $aParams['oxarticles__oxactive'] != $oArticle->oxarticles__oxactive->value) {
                $oDb = oxDb::getDb();
                //check categories
                $sQ = "select oxcatnid from oxobject2category where oxobjectid = ".$oDb->quote( $oArticle->oxarticles__oxid->value );
                $rs = $oDb->Execute($sQ);
                if ($rs !== false && $rs->recordCount() > 0)
                    while (!$rs->EOF) {
                        $this->resetCounter( "catArticle", $rs->fields[0] );
                        $rs->moveNext();
                    }
                // vendors
                $aResetIds['vendor'][$oArticle->oxarticles__oxvendorid->value] = 1;
                $aResetIds['manufacturer'][$oArticle->oxarticles__oxmanufacturerid->value] = 1;
            }

            // vendors
            if ( isset($aParams['oxarticles__oxvendorid']) && $aParams['oxarticles__oxvendorid'] != $oArticle->oxarticles__oxvendorid->value) {
                $aResetIds['vendor'][$aParams['oxarticles__oxvendorid']] = 1;
                $aResetIds['vendor'][$oArticle->oxarticles__oxvendorid->value] = 1;
            }

            // manufacturers
            if ( isset($aParams['oxarticles__oxmanufacturerid']) && $aParams['oxarticles__oxmanufacturerid'] != $oArticle->oxarticles__oxmanufacturerid->value ) {
                $aResetIds['manufacturer'][$aParams['oxarticles__oxmanufacturerid']] = 1;
                $aResetIds['manufacturer'][$oArticle->oxarticles__oxmanufacturerid->value] = 1;
            }

            $this->_resetCounts( $aResetIds );


        //$aParams = $oArticle->ConvertNameArray2Idx( $aParams);

        $oArticle->setLanguage(0);
        $oArticle->assign( $aParams);

        // apply new language
        $sNewLanguage = oxConfig::getParameter( "new_lang");
        $oArticle->setLanguage( $sNewLanguage);
        $oArticle->save();

        // set for reload
        oxSession::setVar( "new_lang", $sNewLanguage );

        // set oxid if inserted
        if ( $soxId == "-1" )
            $this->_sSavedId = $oArticle->getId();
    }

    /**
     * Sets default values for empty article (currently does nothing), returns
     * array with parameters.
     *
     * @param array $aParams Parameters, to set default values
     *
     * @return array
     */
    public function addDefaultValues( $aParams )
    {
        return $aParams;
    }

    /**
     * Function forms article variants jump list.
     *
     * @param object &$oArticle      article object
     * @param object $oParentArticle article parent object
     *
     * @return null
     */
    protected function _formJumpList( $oArticle, $oParentArticle )
    {
        $aJumpList = array();
        //fetching parent article variants
        if ( isset( $oParentArticle ) ) {
            $aJumpList[] = array( $oParentArticle->oxarticles__oxid->value, $this->_getTitle( $oParentArticle ) );
            $oParentVariants = $oParentArticle->getAdminVariants( oxConfig::getParameter( "editlanguage" ) );
            if ( $oParentVariants->count()) {
                foreach ( $oParentVariants as $oVar) {
                    $aJumpList[] = array( $oVar->oxarticles__oxid->value, " - ".$this->_getTitle( $oVar ) );
                    if ( $oVar->oxarticles__oxid->value == $oArticle->oxarticles__oxid->value ) {
                        $oVariants = $oArticle->getAdminVariants(oxConfig::getParameter( "editlanguage"));
                        if ( $oVariants->count() ) {
                            foreach ( $oVariants as $oVVar) {
                                $aJumpList[] = array( $oVVar->oxarticles__oxid->value, " -- ".$this->_getTitle( $oVVar));
                            }
                        }
                    }
                }
            }
        } else {
            $aJumpList[] = array( $oArticle->oxarticles__oxid->value, $this->_getTitle( $oArticle));
            //fetching this article variants data
            $oVariants = $oArticle->getAdminVariants(oxConfig::getParameter( "editlanguage"));
            if ( $oVariants && $oVariants->count())
                foreach ($oVariants as $oVar) {
                    $aJumpList[] = array( $oVar->oxarticles__oxid->value, " - ".$this->_getTitle( $oVar));
                }
        }
        if ( count($aJumpList) > 1)
            $this->_aViewData["thisvariantlist"] = $aJumpList;
    }

    /**
     * Returns formed variant title
     *
     * @param object &$oObj product object
     *
     * @return string
     */
    protected function _getTitle( $oObj )
    {
        $sTitle = $oObj->oxarticles__oxtitle->value;
        if ( !strlen( $sTitle ) ) {
            $sTitle = $oObj->oxarticles__oxvarselect->value;
        }

        return $sTitle;
    }

    /**
     * Returns shop manufacturers list
     *
     * @return oxmanufacturerlist
     */
    public function getCategoryList()
    {
        $oCatTree = oxNew( "oxCategoryList");
        $oCatTree->buildList( $this->getConfig()->getConfigParam( 'bl_perfLoadCatTree' ) );
        return $oCatTree;
    }

    /**
     * Returns shop manufacturers list
     *
     * @return oxmanufacturerlist
     */
    public function getVendorList()
    {
        $oVendorlist = oxNew( "oxvendorlist" );
        $oVendorlist->loadVendorList();

        return $oVendorlist;
    }

    /**
     * Returns shop manufacturers list
     *
     * @return oxmanufacturerlist
     */
    public function getManufacturerList()
    {
        $oManufacturerList = oxNew( "oxmanufacturerlist" );
        $oManufacturerList->loadManufacturerList();

        return $oManufacturerList;
    }
}
