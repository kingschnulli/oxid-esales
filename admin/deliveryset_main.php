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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: deliveryset_main.php 14020 2008-11-06 13:36:42Z arvydas $
 */

/**
 * Admin article main deliveryset manager.
 * There is possibility to change deliveryset name, article, user
 * and etc.
 * Admin Menu: Shop settings -> Shipping & Handling -> Main Sets.
 * @package admin
 */
class DeliverySet_Main extends oxAdminDetails
{
    /**
     * Executes parent method parent::render(), creates deliveryset category tree,
     * passes data to Smarty engine and returns name of template file "deliveryset_main.tpl".
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

        if ( $soxId != "-1" && isset( $soxId)) {
            // load object
            $odeliveryset = oxNew( "oxdeliveryset" );
            $odeliveryset->loadInLang( $this->_iEditLang, $soxId );

            $oOtherLang = $odeliveryset->getAvailableInLangs();

            if (!isset($oOtherLang[$this->_iEditLang])) {
                // echo "language entry doesn't exist! using: ".key($oOtherLang);
                $odeliveryset->loadInLang( key($oOtherLang), $soxId );
            }

            $this->_aViewData["edit"] =  $odeliveryset;


            // remove already created languages
            $aLang = array_diff ( oxLang::getInstance()->getLanguageNames(), $oOtherLang );
            if ( count( $aLang))
                $this->_aViewData["posslang"] = $aLang;

            foreach ( $oOtherLang as $id => $language) {
                $oLang= new oxStdClass();
                $oLang->sLangDesc = $language;
                $oLang->selected = ($id == $this->_iEditLang);
                $this->_aViewData["otherlang"][$id] = clone $oLang;
            }
        }

        if ( oxConfig::getParameter("aoc") ) {

            $aColumns = array();
            include_once 'inc/'.strtolower(__CLASS__).'.inc.php';
            $this->_aViewData['oxajax'] = $aColumns;

            return "popups/deliveryset_main.tpl";
        }

        return "deliveryset_main.tpl";
    }

    /**
     * Saves deliveryset information changes.
     *
     * @return mixed
     */
    public function save()
    {

        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxdeliveryset__oxshopid'] = $sShopID;
        $oDelSet = oxNew( "oxdeliveryset" );

        if ( $soxId != "-1")
            $oDelSet->loadInLang( $this->_iEditLang, $soxId );
        else
            $aParams['oxdeliveryset__oxid'] = null;
        // checkbox handling
        if ( !isset( $aParams['oxdeliveryset__oxactive']))
            $aParams['oxdeliveryset__oxactive'] = 0;


        //$aParams = $oDelSet->ConvertNameArray2Idx( $aParams);
        $oDelSet->setLanguage(0);
        $oDelSet->assign( $aParams);
        $oDelSet->setLanguage($this->_iEditLang);
        $oDelSet = oxUtilsFile::getInstance()->processFiles( $oDelSet );
        $oDelSet->save();
        $this->_aViewData["updatelist"] = "1";

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oDelSet->oxdeliveryset__oxid->value);

        return $this->autosave();
    }

    /**
     * Saves deliveryset data to different language (eg. english).
     *
     * @return null
     */
    public function saveinnlang()
    {
        $soxId      = oxConfig::getParameter( "oxid");
        $aParams    = oxConfig::getParameter( "editval");
        // checkbox handling
        if( !isset( $aParams['oxdeliveryset__oxactive']))
            $aParams['oxdeliveryset__oxactive'] = 0;

            // shopid
            $sShopID = oxSession::getVar( "actshop");
            $aParams['oxdeliveryset__oxshopid'] = $sShopID;
        $oDelSet = oxNew( "oxdeliveryset" );

        if ( $soxId != "-1")
            $oDelSet->loadInLang( $this->_iEditLang, $soxId );
        else
            $aParams['oxdeliveryset__oxid'] = null;
        //$aParams = $oDelSet->ConvertNameArray2Idx( $aParams);

        $oDelSet->setLanguage(0);
        $oDelSet->assign( $aParams);


        // apply new language
        $sNewLanguage = oxConfig::getParameter( "new_lang");
        $oDelSet->setLanguage( $sNewLanguage);
        $oDelSet->save();
        $this->_aViewData["updatelist"] = "1";

        // set for reload
        oxSession::setVar( "new_lang", $sNewLanguage);

        // set oxid if inserted
        if ( $soxId == "-1")
            oxSession::setVar( "saved_oxid", $oDelSet->oxdeliveryset__oxid->value);

        return $this->autosave();
    }
}
