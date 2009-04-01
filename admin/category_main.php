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
 * $Id: category_main.php 17243 2009-03-16 15:16:57Z arvydas $
 */

/**
 * Admin article main categories manager.
 * There is possibility to change categories description, sorting, range of price
 * and etc.
 * Admin Menu: Manage Products -> Categories -> Main.
 * @package admin
 */
class Category_Main extends oxAdminDetails
{
    /**
     * Loads article category data, passes it to Smarty engine, returns
     * name of template file "category_main.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig  = $this->getConfig();

        parent::render();

        $this->_aViewData["edit"] = $oCategory = oxNew( "oxcategory" );;


        $soxId = oxConfig::getParameter( "oxid");
        $sChosenArtCat = oxConfig::getParameter( "artcat");
        // check if we right now saved a new entry
        $sSavedID = oxConfig::getParameter( "saved_oxid");
        if ( ($soxId == "-1" || !isset( $soxId)) && isset( $sSavedID) ) {
            $soxId = $sSavedID;
            oxSession::deleteVar( "saved_oxid");
            $this->_aViewData["oxid"] =  $soxId;
            // for reloading upper frame
            $this->_aViewData["updatelist"] =  "1";
        }

        if ( $soxId != "-1" && isset( $soxId)) {

            // generating category tree for select list
            $sChosenArtCat = $this->_getCategoryTree( "artcattree", $sChosenArtCat, $soxId );

            // load object
            $oCategory->loadInLang( $this->_iEditLang, $soxId );


            $oOtherLang = $oCategory->getAvailableInLangs();
            if (!isset($oOtherLang[$this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $oCategory->loadInLang( key($oOtherLang), $soxId );
            }

            // remove already created languages
            $aLang = array_diff ( oxLang::getInstance()->getLanguageNames(), $oOtherLang );
            if ( count( $aLang))
                $this->_aViewData["posslang"] = $aLang;

            foreach ( $oOtherLang as $id => $language) {
                $oLang = new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] =  clone $oLang;
            }

            if ( $oCategory->oxcategories__oxparentid->value == 'oxrootid')
                $oCategory->oxcategories__oxparentid->setValue('');

            $this->_getCategoryTree( "cattree", $oCategory->oxcategories__oxparentid->value, $oCategory->oxcategories__oxid->value, true, $oCategory->oxcategories__oxshopid->value);

            $this->_aViewData["defsort"] = $oCategory->oxcategories__oxdefsort->value;
        } else
            $this->_getCategoryTree( "cattree", "", "", true, $myConfig->getShopId());

        $oArticle = oxNew( "oxarticle" );
        $this->_aViewData["pwrsearchfields"] = $oArticle->getSearchableFields();

        if ( oxConfig::getParameter("aoc") ) {

            $aColumns = array();
            include_once 'inc/'.strtolower(__CLASS__).'.inc.php';
            $this->_aViewData['oxajax'] = $aColumns;

            return "popups/category_main.tpl";
        }
        return "category_main.tpl";
    }

    /**
     * Saves article category data.
     *
     * @return mixed
     */
    public function save()
    {
        $myConfig  = $this->getConfig();


        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");

        // checkbox handling
        if ( !isset( $aParams['oxcategories__oxactive']))
            $aParams['oxcategories__oxactive'] = 0;
        if ( !isset( $aParams['oxcategories__oxhidden']))
            $aParams['oxcategories__oxhidden'] = 0;
        if ( !isset( $aParams['oxcategories__oxdefsortmode']))
            $aParams['oxcategories__oxdefsortmode'] = 0;

        // null values
        if ($aParams['oxcategories__oxvat'] === '')
            $aParams['oxcategories__oxvat'] = null;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxcategories__oxshopid'] = $sShopID;
        $oCategory = oxNew( "oxcategory" );

        if ( $soxId != "-1") {
            oxUtilsCount::getInstance()->resetCatArticleCount($soxId);
            $oCategory->load( $soxId);
            $oCategory->loadInLang( $this->_iEditLang, $soxId );
                $myUtilsPic = oxUtilsPic::getInstance();
                // #1173M - not all pic are deleted, after article is removed
                $myUtilsPic->overwritePic( $oCategory, 'oxcategories', 'oxthumb', 'TC', '0', $aParams, $myConfig->getAbsDynImageDir() );
                $myUtilsPic->overwritePic( $oCategory, 'oxcategories', 'oxicon', 'CICO', 'icon', $aParams, $myConfig->getAbsDynImageDir() );

        } else {
            //#550A - if new category is made then is must be default activ
            $aParams['oxcategories__oxactive'] = 1;
            $aParams['oxcategories__oxid'] = null;
        }
        //$aParams = $oCategory->ConvertNameArray2Idx( $aParams);


        $oCategory->setLanguage(0);
        $oCategory->assign( $aParams);

        $oCategory->setLanguage($this->_iEditLang);

        $oCategory = oxUtilsFile::getInstance()->processFiles( $oCategory );
        $oCategory->save();
        $this->_aViewData["updatelist"] = "1";

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oCategory->oxcategories__oxid->value);
    }

    /**
     * Saves article category data to different language (eg. english).
     *
     * @return null
     */
    public function saveinnlang()
    {

        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");
        // checkbox handling
        if ( !isset( $aParams['oxcategories__oxactive']))
            $aParams['oxcategories__oxactive'] = 0;
        if ( !isset( $aParams['oxcategories__oxdefsortmode']))
            $aParams['oxcategories__oxdefsortmode'] = 0;

        // null values
        if ($aParams['oxcategories__oxvat'] === '')
            $aParams['oxcategories__oxvat'] = null;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxcategories__oxshopid'] = $sShopID;

        $oCategory = oxNew( "oxcategory" );

        if ( $soxId != "-1")
            $oCategory->loadInLang( $this->_iEditLang, $soxId );
        else {
            $aParams['oxcategories__oxid'] = null;
        }


        //$aParams = $oCategory->ConvertNameArray2Idx( $aParams);
        $oCategory->setLanguage(0);
        $oCategory->assign( $aParams);

        // apply new language
        $sNewLanguage = oxConfig::getParameter( "new_lang");
        $oCategory->setLanguage( $sNewLanguage);
        $oCategory->save();
        $this->_aViewData["updatelist"] = "1";

        // set for reload
        oxSession::setVar( "new_lang", $sNewLanguage);

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oCategory->oxcategories__oxid->value);
    }
}
