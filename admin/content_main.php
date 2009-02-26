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
 * $Id: content_main.php 16589 2009-02-18 11:23:47Z arvydas $
 */

/**
 * Admin content manager.
 * There is possibility to change content description, enter page text etc.
 * Admin Menu: Customerinformations -> Content.
 * @package admin
 */
class Content_Main extends oxAdminDetails
{
    /**
     * Loads contents info, passes it to Smarty engine and
     * returns name of template file "content_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig = $this->getConfig();

        parent::render();

        $soxId = oxConfig::getParameter( "oxid");
        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( ($soxId == "-1" || !isset( $soxId)) && isset( $sSavedID) ) {
            $soxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $soxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        // categorie tree
        $oCatTree = oxNew( "oxCategoryList" );
        $oCatTree->buildList($myConfig->getConfigParam( 'bl_perfLoadCatTree' ));

        $oContent = oxNew( "oxcontent" );
        if ( $soxId != "-1" && isset( $soxId)) {
            // load object
            $oContent->loadInLang( $this->_iEditLang, $soxId );

            $oOtherLang = $oContent->getAvailableInLangs();
            if (!isset($oOtherLang[$this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $oContent->loadInLang( key($oOtherLang), $soxId );
            }

            // remove already created languages
            $aLang = array_diff ( oxLang::getInstance()->getLanguageNames(), $oOtherLang );
            if ( count( $aLang))
                $this->_aViewData["posslang"] = $aLang;
            foreach ( $oOtherLang as $id => $language) {
                $oLang= new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] =  clone $oLang;
            }
            // mark selected
            if (  $oContent->oxcontents__oxcatid->value && isset( $oCatTree[$oContent->oxcontents__oxcatid->value] ) ) {
                $oCatTree[$oContent->oxcontents__oxcatid->value]->selected = 1;
            }

        } else {
                // create ident to make life easier
                $sUId = oxUtilsObject::getInstance()->generateUId();
                $oContent->oxcontents__oxloadid = new oxField( $sUId );
        }

        $this->_aViewData["edit"] = $oContent;
        $this->_aViewData["link"] = "[{ oxgetseourl ident=&quot;".$oContent->oxcontents__oxloadid->value."&quot; type=&quot;oxcontent&quot; }]";
        $this->_aViewData["cattree"] = $oCatTree;

        // generate editor
        $sCSS = "content.tpl.css";
        if ( $oContent->oxcontents__oxsnippet->value == '1') {
            $sCSS = null;
        }

        $this->_aViewData["editor"]  = $this->_generateTextEditor( "100%", 300, $oContent, "oxcontents__oxcontent", $sCSS);
        $this->_aViewData["afolder"] = $myConfig->getConfigParam( 'aCMSfolder' );

        return "content_main.tpl";
    }

    /**
     * Saves content contents.
     *
     * @return mixed
     */
    public function save()
    {
        $myConfig = $this->getConfig();


        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");

        if ( isset( $aParams['oxcontents__oxloadid'] ) ) {
            $aParams['oxcontents__oxloadid'] = $this->_prepareIdent( $aParams['oxcontents__oxloadid'] );
        }

        // check if loadid is unique
        if ( $soxId == "-1") {
            if ( $this->_checkIdent( $aParams['oxcontents__oxloadid'] )) {
                // loadid already used, display error message
                $this->_aViewData["blLoadError"] =  true;
                $oContent = oxNew( "oxcontent" );
                //$aParams = $oContent->ConvertNameArray2Idx( $aParams);
                $oContent->assign( $aParams);
                $this->_aViewData["edit"] =  $oContent;
                return;
            }
        }

        // checkbox handling
        if ( !isset( $aParams['oxcontents__oxactive']))
            $aParams['oxcontents__oxactive'] = 0;

        // special treatment
        if ( $aParams['oxcontents__oxtype'] == 0)
            $aParams['oxcontents__oxsnippet'] = 1;
        else
            $aParams['oxcontents__oxsnippet'] = 0;

        //Updates object folder parameters
        if ( $aParams['oxcontents__oxfolder'] == 'CMSFOLDER_NONE' ) {
            $aParams['oxcontents__oxfolder'] = '';
        }

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxcontents__oxshopid'] = $sShopID;
        $oContent = oxNew( "oxcontent" );

        if ( $soxId != "-1")
            $oContent->loadInLang( $this->_iEditLang, $soxId );
        else
            $aParams['oxcontents__oxid'] = null;

        //$aParams = $oContent->ConvertNameArray2Idx( $aParams);

        $oContent->setLanguage(0);
        $oContent->assign( $aParams);
        $oContent->setLanguage($this->_iEditLang);
        $oContent->save();
        $this->_aViewData["updatelist"] = "1";

        // set oxid if inserted
        if( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oContent->oxcontents__oxid->value);

        return $this->autosave();
    }

    /**
     * Saves content data to different language (eg. english).
     *
     * @return null
     */
    public function saveinnlang()
    {
        $myConfig  = $this->getConfig();


        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");

        if ( isset( $aParams['oxcontents__oxloadid'] ) ) {
            $aParams['oxcontents__oxloadid'] = $this->_prepareIdent( $aParams['oxcontents__oxloadid'] );
        }

        // checkbox handling
        if ( !isset( $aParams['oxcontents__oxactive']))
            $aParams['oxcontents__oxactive'] = 0;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxcontents__oxshopid'] = $sShopID;

        $oContent = oxNew( "oxcontent" );

        if ( $soxId != "-1")
            $oContent->loadInLang( $this->_iEditLang, $soxId );
        else
            $aParams['oxcontents__oxid'] = null;

        $oContent->setLanguage(0);
        $oContent->assign( $aParams);

        // apply new language
        $sNewLanguage = oxConfig::getParameter( "new_lang");
        $oContent->setLanguage( $sNewLanguage);
        $oContent->save();
        $this->_aViewData["updatelist"] = "1";

        // set for reload
        oxSession::setVar( "new_lang", $sNewLanguage);

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oContent->oxcontents__oxid->value);
    }

    /**
     * Prepares ident (removes bad chars, leaves only thoose that fits in a-zA-Z0-9_ range)
     *
     * @param string $sIdent ident to filter
     *
     * @return string
     */
    protected function _prepareIdent( $sIdent )
    {
        if ( $sIdent ) {
            return preg_replace( "/[^a-zA-Z0-9_]*/u", "", $sIdent );
        }
    }

    /**
    * Check if ident is unique
    *
    * @param string $sIdent ident
    *
    * @return null
    */
    protected function _checkIdent( $sIdent )
    {
        // null not allowed
        if ( !strlen( $sIdent ) )
            return true;

        $sID = oxDb::getDb()->GetOne( "select oxid from oxcontents where oxloadid = '$sIdent'" );

        if ( $sID )
            return true;
        else
            return false;
    }
}
